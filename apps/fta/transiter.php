<?php

//Redirection vers la page par défaut du module
//header ('Location: indexft.php');

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */

//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);

/*
  Si la page peut être appelée depuis n'importe quel module,
  décommentez la ligne suivante
 */

//   $module='fta';

/* * *******
  Inclusions
 * ******* */
//include ('../lib/session.php');         //Récupération des variables de sessions
//include ('../lib/debut_page.php');      //Affichage des éléments commun à l'Intranet
require_once '../inc/main.php';
print_page_begin($disable_full_page, $menu_file);
flush();



//if (isset($menu))                       //Si existant, utilisation du menu demandé
//   {include ('./$menu');}               //en variable
//else
//   {include ('./menu_principal.inc');}  //Sinon, menu par défaut


/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER['PHP_SELF'], '/'), '1', '-4');
$page_query = $_SERVER['QUERY_STRING'];
$page_action = $page_default . '_post.php';
//   $action = '';                       //Action proposée à la page _post.php
$method = 'method=POST';             //Pour une url > 2000 caractères, utiliser POST
$html_table = 'table '              //Permet d'harmoniser les tableaux
        . 'border=1 '
        . 'width=100% '
        . 'class=contenu '
;

/*
  Récupération des données MySQL
 */

$idFta = Lib::getParameterFromRequest('id_fta');
$comeback = Lib::getParameterFromRequest('comeback');

/**
 * Initialisation du bouton de retour de synthèse
 */
if ($comeback) {
    $_SESSION["comeback_url"] = $_SERVER["HTTP_REFERER"];
}
$action = Lib::getParameterFromRequest('action');
$demande_abreviation_fta_transition = Lib::getParameterFromRequest('demande_abreviation_fta_transition');
$syntheseAction = Lib::getParameterFromRequest('synthese_action');
$checkPost = Lib::getParameterFromRequest('checkPost');


/*
 * Initinalisation du modele Fta
 * 
 */
$ftaModel = new FtaModel($idFta);
$globalConfig = new GlobalConfig();
UserModel::checkUserSessionExpired($globalConfig);

$idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
$idFtaWorkflow = $ftaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
$arrayIdFtaRoleAcces = FtaRoleModel::getArrayIdFtaRoleByIdUserAndWorkflow($idUser, $idFtaWorkflow);
$idFtaRole = $arrayIdFtaRoleAcces["0"];

/**
 * Affichage commentaire à modifier
 */
$NOM_commentaire_maj_fta = $ftaModel->getHtmlCommentaireMajFta();

//$NOM_commentaire_maj_fta = str_replace('<>');

/**
 * Recupération des élement de la Fta en cours
 */
$arrayFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                'SELECT ' . FtaModel::FIELDNAME_DOSSIER_FTA
                . ',' . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE
                . ',' . FtaModel::FIELDNAME_COMMENTAIRE_MAJ_FTA
                . ',' . FtaModel::FIELDNAME_LIBELLE
                . ',' . FtaEtatModel::FIELDNAME_NOM_FTA_ETAT
                . ',' . FtaEtatModel::FIELDNAME_ABREVIATION
                . ',' . FtaModel::FIELDNAME_WORKFLOW
                . ',' . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA
                . ' FROM ' . FtaModel::TABLENAME . ',' . FtaEtatModel::TABLENAME
                . ' WHERE ' . FtaModel::KEYNAME . '=' . $idFta
                . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_ID_FTA_ETAT
                . '=' . FtaEtatModel::TABLENAME . '.' . FtaEtatModel::KEYNAME
);
//Information de la fiche sélectionnée
foreach ($arrayFta as $rowsFta) {
    $idDossierFta = $rowsFta[FtaModel::FIELDNAME_DOSSIER_FTA];                       //Identifiant de toutes les fiches de cette matière
    $idDossierVersionFta = $rowsFta[FtaModel::FIELDNAME_VERSION_DOSSIER_FTA];                       //Identifiant de version
    $nomFtaEtat = $rowsFta[FtaEtatModel::FIELDNAME_NOM_FTA_ETAT];                         //Etat actuel de la fiche
    $designationCommercialeFta = $rowsFta[FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE];          //Nom
    $commentaireMajFta = $rowsFta[FtaModel::FIELDNAME_COMMENTAIRE_MAJ_FTA];                  //Historiques des commentaire de mise à jour
    $LIBELLE = $rowsFta[FtaModel::FIELDNAME_LIBELLE];
    $abreviationFtaEtat = $rowsFta[FtaEtatModel::FIELDNAME_ABREVIATION];
    $idFtaWorkflow = $rowsFta[FtaModel::FIELDNAME_WORKFLOW];
}



$taux_temp = FtaSuiviProjetModel::getArrayFtaTauxValidation($ftaModel, FALSE);
$recap[$idFta] = round($taux_temp['0'] * FtaProcessusDelaiModel::TAUX_100, '0') . '%';



/*
  Création des objets HTML (listes déroulante, cases à cocher ...etc.)
 */

//Tableau des transitions disponibles pour cette fiches techniques
$tableau_transition = '<select name=action onChange=lien_selection_chapitre()>';

$req = 'SELECT ' . FtaTransitionModel::FIELDNAME_NOM_USUEL_FTA_TRANSITION . ', ' . FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_TRANSITION
        . ' FROM ' . FtaTransitionModel::TABLENAME
        . ' WHERE ' . FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_ETAT . '=\'' . $abreviationFtaEtat . '\' '
        /**
         * Désactivation du changement d'eapace de travail au meme moment que le changement d'état
         */
        . ' AND ' . FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_TRANSITION . '<>\'' . FtaEtatModel::ETAT_ABREVIATION_VALUE_WORKFLOW . '\''
;
if ($demande_abreviation_fta_transition) {
    $req.= ' AND ' . FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_TRANSITION . '=\'' . $demande_abreviation_fta_transition . '\' ';
}
//1+ La Fta peut être validé, 0 La Fta n'est pas à 100%
if ($recap[$idFta] <> FtaProcessusDelaiModel::TAUX_100) {
    $req.= ' AND ' . FtaTransitionModel::FIELDNAME_PROCESSUS_PROPRIETAIRE_FTA_TRANSITION . '=0';
}
//if ($idFtaRole == FtaRoleModel::ID_FTA_ROLE_SITE) {
//    $req.= ' AND ' . FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_TRANSITION . '<>\'' . FtaEtatModel::ETAT_ABREVIATION_VALUE_WORKFLOW . '\'';
//}
if (!FtaRoleModel::isGestionnaire($idFtaRole)) {
    $req.= ' AND ' . FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_TRANSITION . '<>\'' . FtaEtatModel::ETAT_ABREVIATION_VALUE_RETIRE . '\''
            . ' AND ' . FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_TRANSITION . '<>\'' . FtaEtatModel::ETAT_ABREVIATION_VALUE_ARCHIVE . '\'';
}

$req .=' ORDER BY ' . FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_TRANSITION . ' ASC';
$arrayFtaTransition = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);

$flag_selection_chapitre = 0;    //Peut-on sélectionner un chapitre à mettre à jour ?


foreach ($arrayFtaTransition as $rowsFtaTransition) {
    //Si l'utilisateur est autorisé à utiliser cette transition, alors affichage de l'option

    if ($action == $rowsFtaTransition[FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_TRANSITION]) {
        $selected = ' selected';
    } else {
        $selected = '';
    }
    /**
     * Si une action n'est pas renseigné alors on affiche la première action possible
     */
    if (!$action) {
        $action = $rowsFtaTransition[FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_TRANSITION];
    }

    $tableau_transition .='<option value=\'' . $rowsFtaTransition[FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_TRANSITION] . '\' ' . $selected . '>'
            . $rowsFtaTransition[FtaTransitionModel::FIELDNAME_NOM_USUEL_FTA_TRANSITION] . '</option>'
    ;

    //Dans le cas de la possibilité d'activer la mise à jour,
    //l'option de selection des chapitres est aussi activé
    /* if ($rows['abreviation_fta_transition']=='I')
      {
      $flag_selection_chapitre=1;
      } */
}
$tableau_transition.='</select>';

//Tableau des chapitres
if ($action == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION or $action == 'W') {
    /**
     * Changement de la page d'action
     */
    if (!$checkPost) {
        $page_action = "transiter_fiche.php";
    } else {
        $affichageCommentaire = " <tr>
            <td class=titre_principal>
                Historiques des commentaire de mise à jour
            </td>
        </tr>
        <tr  class=contenu>
     
           " . $NOM_commentaire_maj_fta . "

        </tr>";
    }
    /**
     * Affichage de la date d'échéances
     */
    $ftaModel->setIsEditable(Chapitre::EDITABLE);
    $dateEcheanceFtaHtml = $ftaModel->getHtmlDateEcheance(TRUE);
    $tableau_chapitre = '<' . $html_table . '>'
            . '<tr class=titre><td>' . UserInterfaceLabel::FR_TRANSITION_MODIFICATION . '</td></tr>'
            . '<tr><td><' . $html_table . '>'
    ;
    if (!FtaRoleModel::isGestionnaire($idFtaRole)) {
        $reqRestrictionListeChapitre = ' AND ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE . '=' . $idFtaRole;
    }
    if ($action == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION and $abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_RETIRE) {
        $reqRestrictionListeChapitre = ' AND ' . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE . '=' . FtaChapitreModel::ID_CHAPITRE_IDENTITE;
    }

    $reqListesChapitre = 'SELECT ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
            . ',' . FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE
            . ' FROM ' . FtaChapitreModel::TABLENAME . ',' . FtaWorkflowStructureModel::TABLENAME
            . ' WHERE ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
            . '=' . FtaChapitreModel::TABLENAME . '.' . FtaChapitreModel::KEYNAME
            . ' AND ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . $idFtaWorkflow
            . ' AND ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS . '<>' . FtaProcessusModel::PROCESSUS_PUBLIC
            . $reqRestrictionListeChapitre
            . ' ORDER BY ' . FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE;
    $arrrayFtaChapitre = DatabaseOperation::convertSqlStatementWithoutKeyToArray($reqListesChapitre
    );
    /**
     * On attribut un code couleur selon les éléments sélectionner à dévalider     * 
     */
    foreach ($arrrayFtaChapitre as $rowsChapitre) {
        if (Lib::getParameterFromRequest(FtaChapitreModel::FIELDNAME_NOM_CHAPITRE . '_' . $rowsChapitre[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE]) == 1) {
            /**
             * Elements sélectionner par l'utilisateur
             */
            $checked = 'checked';
            $bgcolor = TableauFicheView::HTML_CELL_BGCOLOR_VALIDATE;
            $din = "";
        } elseif (Lib::getParameterFromRequest(FtaChapitreModel::FIELDNAME_NOM_CHAPITRE . '_' . $rowsChapitre[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE]) == 2) {
            /**
             * Elements grisé en conséquence de la sélection par l'utilisateur
             */
            $checked = 'checked';
            $din = TableauFicheView::HTML_TEXT_COLOR_DIN;
            $bgcolor = TableauFicheView::HTML_CELL_BGCOLOR_DEFAULT;
        } else {
            $checked = "";
            $bgcolor = "";
            $din = "";
        }
        $tableau_chapitre.= '<tr>'
                . '<td><input type=checkbox   name=' . FtaChapitreModel::FIELDNAME_NOM_CHAPITRE . '_' . $rowsChapitre[FtaChapitreModel::KEYNAME] . ' value=1  ' . $checked . '/></td>'
                . '<td ' . $bgcolor . '><font  ' . $din . '>' . $rowsChapitre[FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE] . '</font></td>'
                . '</tr>'
        ;
    }
    $tableau_chapitre.= $dateEcheanceFtaHtml . '</table></td></tr>'
            . '</table>'
    ;
}
//Tableau des chapitres espace de travail
//if ($action == 'W') {
//    $listeDesWorkflow = '<' . $html_table . '>'
//            . '<tr class=titre><td>Liste des espaces de travail pouvant être mis à jour</td></tr>'
//            . '<tr><td><' . $html_table . '>'
//    ;
//
//    /*
//     * Worflow de FTA
//     */
//    $listeDesWorkflow.=$ftaView->ListeWorkflowByAcces($idUser, TRUE, $idFta, $idFtaRole);
//}
//Validation_matiere_premiere
//Boris 2005-09-15: risque de mettre une date antérieure à la dernière date de mise à jour
//$nom_date = 'date_derniere_maj_fta';
////$nom_date='date_dernier_changement_etat_new';
//$nom_liste = 'selection_' . $nom_date;
//$date_defaut = date('d-m-Y');
//$$nom_liste = selection_date_pour_mysql($nom_date, $date_defaut);
//$selection_date_derniere_maj_fta;

/* * *********
  Fin Code PHP
 * ********* */

/* * ************
  Début Code HTML
 * ************ */
echo '

<form ' . $method . ' action=\'' . $page_action . '\' name=\'form_action\'>
     <!input type=hidden name=action value=' . $action . '>
     <input type=hidden name=current_page value=' . $page_default . '.php >
     <input type=hidden name=current_query value=' . $page_query . ' >
     <input type=hidden name=abreviation_fta_etat value=' . $abreviationFtaEtat . '>
     <input type=hidden name=id_fta value=' . $idFta . '>
     <input type=hidden name=id_fta_role value=' . $idFtaRole . '>
     <input type=hidden name=id_fta_workflow value=' . $idFtaWorkflow . '>
     <input type=hidden name=id_dossier_fta value=' . $idDossierFta . '>
     <input type=hidden name=' . FtaModel::TABLENAME . '_' . FtaModel::FIELDNAME_COMMENTAIRE_MAJ_FTA . '_' . $idFta . ' value=`' . $commentaireMajFta . '`>
     <input type=hidden name=demande_abreviation_fta_transition value=' . $demande_abreviation_fta_transition . '>
     <input type=hidden name=synthese_action value=' . $syntheseAction . '>
    <' . $html_table . '>
        <tr class=titre_principal>
            <td>

                ' . UserInterfaceMessage::FR_TRANSITION_FTA_TITLE . '

            </td>
        </tr>
        <tr>
            <td>

                <img src=../lib/images/transiter.png>
                &nbsp&nbsp&nbsp&nbsp
               ' . UserInterfaceMessage::FR_TRANSITION_FTA . '
            </td>
        </tr>
        <tr class=titre_principal>
            <td>

                Information de la fiche en cours de transition d\'état

            </td>
        </tr>
        <tr>
            <td>

    <' . $html_table . '>
        <tr>
            <td>

             Identifiant de la Fiche Technique Article: ' . $idFta . '<br>
             Identifiant du Dossier Technique: ' . $idDossierFta . 'v' . $idDossierVersionFta . '<br>
             Etat actuel de la fiche: ' . $nomFtaEtat . '<br>
             Désignation Commerciale: ' . $designationCommercialeFta . '<br>
             Désignation Interne Normaliée (DIN): ' . $LIBELLE . '<br>

            </td>
        </tr>
    </table>

            </td>
        </tr>
        <tr class=titre_principal>
            <td>

                Transition disponible

            </td>
        </tr>
        <tr>
            <td>

    <' . $html_table . '>
        <tr>
            <td>
                 ' . $tableau_transition . '
            </td>
            <td>
                 ' . $tableau_chapitre . ' ' . $listeDesWorkflow . '
            </td>
        </tr>
    </table>
       ' . $affichageCommentaire . '
        <tr>
            <td>
          <center>
         <input type=submit value=\'Enregistrer\'>
         </center>
            </td>
        </tr>   
    </table>

</form>
     ';

/* * **********
  Fin Code HTML
 * ********** */

/* * *********************
  Inclusion de fin de page
 * ********************* */
include ('../lib/fin_page.inc');
?>

