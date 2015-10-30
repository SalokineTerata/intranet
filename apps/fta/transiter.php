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
$page_action = substr(strrchr($_SERVER['PHP_SELF'], '/'), '1', '-4') . '_post.php';
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
$idFtaRole = Lib::getParameterFromRequest('id_fta_role');
$action = Lib::getParameterFromRequest('action');
$demande_abreviation_fta_transition = Lib::getParameterFromRequest('demande_abreviation_fta_transition');

/*
 * Initinalisation du modele Fta
 * 
 */
$ftaModel = new FtaModel($idFta);
$globalConfig = new GlobalConfig();
$idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
$ftaView = new FtaView($ftaModel);
$dataFieldCommentaire = $ftaModel->getDataField(FtaModel::FIELDNAME_COMMENTAIRE_MAJ_FTA);
$htmlFieldCommentaire = Html::getHtmlObjectFromDataField($dataFieldCommentaire);
$htmlFieldCommentaire->getAttributesGlobal()->setIsIconNextEnabledToFalse();
$htmlFieldCommentaire->setHtmlRenderToTable();
$htmlFieldCommentaire->setIsEditable(TRUE);
$NOM_commentaire_maj_fta = $htmlFieldCommentaire->getHtmlResult();
//$NOM_commentaire_maj_fta = str_replace('<>');
/**
 * Affichage commentaire à modifier
 */
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



$ftaModel = new FtaModel($id_fta);
$taux_temp = FtaSuiviProjetModel::getFtaTauxValidation($ftaModel);
$recap[$idFta] = round($taux_temp['0'] * '100%', '0') . '%';



/*
  Création des objets HTML (listes déroulante, cases à cocher ...etc.)
 */

//Tableau des transitions disponibles pour cette fiches techniques
$tableau_transition = '<select name=action onChange=lien_selection_chapitre()>'
;

$req = 'SELECT ' . FtaTransitionModel::FIELDNAME_NOM_USUEL_FTA_TRANSITION . ', ' . FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_TRANSITION
        . ' FROM ' . FtaTransitionModel::TABLENAME
        . ' WHERE ' . FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_ETAT . '=\'' . $abreviationFtaEtat . '\' '
;
if ($demande_abreviation_fta_transition) {
    $req.= ' AND ' . FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_TRANSITION . '=\'' . $demande_abreviation_fta_transition . '\' ';
}
//1+ La Fta peut être validé, 0 La Fta n'est pas à 100%
if ($recap[$idFta] <> '100%') {
    $req.= ' AND ' . FtaTransitionModel::FIELDNAME_PROCESSUS_PROPRIETAIRE_FTA_TRANSITION . '=0';
}
$req .=' ORDER BY ' . FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_TRANSITION . ' DESC ';
$arrayFtaTransition = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);

$flag_selection_chapitre = 0;    //Peut-on sélectionner un chapitre à mettre à jour ?

foreach ($arrayFtaTransition as $rowsFtaTransition) {
    //Si l'utilisateur est autorisé à utiliser cette transition, alors affichage de l'option

    if ($action == $rowsFtaTransition[FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_TRANSITION]) {
        $selected = ' selected';
    } else {
        $selected = '';
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
if ($action == 'I' or $action == 'W') {
    $tableau_chapitre = '<' . $html_table . '>'
            . '<tr class=titre><td>Liste des Chapitres pouvant être mis à jour</td></tr>'
            . '<tr><td><' . $html_table . '>'
    ;

    $arrrayFtaChapitre = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                    'SELECT ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE . ',' . FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE
                    . ' FROM ' . FtaChapitreModel::TABLENAME . ',' . FtaWorkflowStructureModel::TABLENAME
                    . ' WHERE ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                    . '=' . FtaChapitreModel::TABLENAME . '.' . FtaChapitreModel::KEYNAME
                    . ' AND ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . $idFtaWorkflow
                    . ' AND ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS . '<>0'
                    . ' ORDER BY ' . FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE
    );
    foreach ($arrrayFtaChapitre as $rowsChapitre) {
        $tableau_chapitre.= '<tr>'
                . '<td><input type=checkbox name=' . FtaChapitreModel::FIELDNAME_NOM_CHAPITRE . '-' . $rowsChapitre[FtaChapitreModel::KEYNAME] . ' value=1 /></td>'
                . '<td>' . $rowsChapitre[FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE] . '</td>'
                . '</tr>'
        ;
    }
    $tableau_chapitre.= '</table></td></tr>'
            . '</table>'
    ;
}
//Tableau des chapitres
if ($action == 'W') {
    $listeDesWorkflow = '<' . $html_table . '>'
            . '<tr class=titre><td>Liste des espaces de travail pouvant être mis à jour</td></tr>'
            . '<tr><td><' . $html_table . '>'
    ;

    /*
     * Worflow de FTA
     */
    $listeDesWorkflow.=$ftaView->ListeWorkflowByAcces($idUser, TRUE, $idFta);
}


//Validation_matiere_premiere
//Boris 2005-09-15: risque de mettre une date antérieure à la dernière date de mise à jour
$nom_date = 'date_derniere_maj_fta';
//$nom_date='date_dernier_changement_etat_new';
$nom_liste = 'selection_' . $nom_date;
$date_defaut = date('Y-m-d');
$$nom_liste = selection_date_pour_mysql($nom_date, $date_defaut);
$selection_date_derniere_maj_fta;

/* * *********
  Fin Code PHP
 * ********* */

/* * ************
  Début Code HTML
 * ************ */
echo '

<form ' . $method . ' action=\'' . $page_action . '\' name=\'form_action\'>
     <!input type=hidden name=action value=' . $action . '>
     <input type=hidden name=abreviation_fta_etat value=' . $abreviationFtaEtat . '>
     <input type=hidden name=id_fta value=' . $idFta . '>
     <input type=hidden name=id_fta_role value=' . $idFtaRole . '>
     <input type=hidden name=id_fta_workflow value=' . $idFtaWorkflow . '>
     <input type=hidden name=id_dossier_fta value=' . $idDossierFta . '>
     <input type=hidden name=commentaire_maj_fta value=`' . $commentaireMajFta . '`>
    <' . $html_table . '>
        <tr class=titre_principal>
            <td>

                Transiter l\'Etat d\'une Fiche Technique Article

            </td>
        </tr>
        <tr>
            <td>

                <img src=../lib/images/transiter.png>
                &nbsp&nbsp&nbsp&nbsp
                La transition de l\'état d\'une fiche permet de changer son état tout en laissant le système contrôler la cohérence et la version de la fiche.<br>
                <br>
                Suivant l\'état de votre fiche, seuls certains états sont accessibles. Vous pouvez considérer la transition de l\'état d\'une fiche comme un contrôle sur son cycle de vie.<br>
                <br>

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
        <tr>
            <td class=titre_principal>
                Historiques des commentaire de mise à jour
            </td>
        </tr>
        <tr>
     
           ' . $NOM_commentaire_maj_fta . '

        </tr>
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

