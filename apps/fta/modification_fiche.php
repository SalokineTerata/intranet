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





/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER['PHP_SELF'], '/'), '1', '-4');
$page_action = $page_default . '_post.php';
$page_pdf = $page_default . '_pdf.php';
$action = 'valider';                       //Action proposée à la page _post.php
$method = 'method=post';                   //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = 'table '                     //Permet d'harmoniser les tableaux
        . 'border=0 '
        . 'width=100% '
        . 'class=titre '
;
//$html_image_modif = '&nbsp;<img src=../lib/images/exclamation.png alt=\'\' title=\'Information mise à jour\' width=\'20\' height=\'18\' border=\'0\' />';
//$html_color_modif = 'bgcolor=#B0FFFE';
$version_modif = 1;                        //Activer la visualisation des modifications effectuées depuis la version précédente
$show_help = 1;                              //Activer l'aide en ligne Pop-up
//Barre de Navigation d'une Fiche Technique Article
//include ('./menu_navigation.inc');
//echo $synthese_action;
/* $comeback;
  echo $comeback=($_SERVER['QUERY_STRING']);
  echo '<br>';
  echo htmlspecialchars($comeback);
 */



//Paramètre d'URL
$idFta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
//$module_consultation = $_SESSION['module'] . '_consultation';
////Sécurisation du chapitre Tarif
//if ($module_consultation <> 1 and $nom_fta_chapitre_encours == 'tarif') {
//    include ('../lib/acces_interdit.php');
//}
if ($idFta) {

    /**
     * Récupérations des paramètres
     */
    $id_fta_chapitre_encours = Lib::getParameterFromRequest('id_fta_chapitre_encours', '1');
    $synthese_action = Lib::isDefined('synthese_action');
    $comeback = Lib::isDefined('comeback');
    $idFtaEtat = Lib::isDefined(FtaEtatModel::KEYNAME);
    $abreviationFtaEtat = Lib::isDefined(FtaEtatModel::FIELDNAME_ABREVIATION);
    $idFtaRole = Lib::isDefined(FtaRoleModel::KEYNAME);
    $ftaModification = Acl::getValueAccesRights('fta_modification');
    $id_fta_chapitre = $id_fta_chapitre_encours;
    $ftaModel = new FtaModel($idFta);

    /**
     * Verification des droits d'accès sur une Fta en modification
     */
    if ($idFtaEtat == "1" and ! $ftaModification) {
        $titre = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS_TITLE;
        $message = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS;
        $redirection = "index.php";
        afficher_message($titre, $message, $redirection);
    }


    /**
     * Récuparation des données pour la classification
     */
    $idFtaClassification2 = $ftaModel->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue();
    $selection_proprietaire1 = Lib::getParameterFromRequest('selection_proprietaire1');
    $selection_proprietaire2 = Lib::getParameterFromRequest('selection_proprietaire2');
    $selection_marque = Lib::getParameterFromRequest('selection_marque');
    $selection_activite = Lib::getParameterFromRequest('selection_activite');
    $selection_rayon = Lib::getParameterFromRequest('selection_rayon');
    $selection_environnement = Lib::getParameterFromRequest('selection_environnement');
    $selection_reseau = Lib::getParameterFromRequest('selection_reseau');
    $selection_saisonnalite = Lib::getParameterFromRequest('selection_saisonnalite');
    $checkIdFtaClasssification = Lib::getParameterFromRequest('checkIdFtaClasssification');

    /**
     * Verification pour la classification
     */
    if ($idFtaClassification2 and ! $checkIdFtaClasssification) {
        $ClassificationFta2Model = new ClassificationFta2Model($idFtaClassification2);
        $selection_proprietaire1 = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE)->getFieldValue();
        $selection_proprietaire2 = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE)->getFieldValue();
        $selection_marque = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_MARQUE)->getFieldValue();
        $selection_activite = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_ACTIVITE)->getFieldValue();
        $selection_rayon = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_RAYON)->getFieldValue();
        $selection_environnement = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT)->getFieldValue();
        $selection_reseau = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_RESEAU)->getFieldValue();
        $selection_saisonnalite = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE)->getFieldValue();
    }


    if ($ftaModification and $idFtaRole == FtaRoleModel::ID_FTA_ROLE_COMMUN and $abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {

        $globalConfig = new GlobalConfig();
        $idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
        $idFtaWorkflow = $ftaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
        $idFtaRoleAcces = FtaRoleModel::getIdFtaRoleByIdUserAndWorkflow($idUser, $idFtaWorkflow);
        if (!$idFtaRoleAcces) {
            $titre = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS_TITLE;
            $message = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS;
            $redirection = "";
            afficher_message($titre, $message, $redirection);
        } else {
            $idFtaRole = $idFtaRoleAcces["0"];
        }
    }



//$navigue = afficher_navigation($id_fta, $id_fta_chapitre_encours, $synthese_action, $comeback);
    $affichgeDesChapitres = TRUE;

    Navigation::initNavigation($idFta, $id_fta_chapitre_encours, $synthese_action, $comeback, $idFtaEtat, $abreviationFtaEtat, $idFtaRole, $affichgeDesChapitres);

    $navigue = Navigation::getHtmlNavigationBar();

    /*
      Création des Fonctions JavaScript
     */
//document.form_action.correction_fta_suivi_projet.value
//Etes vous certain de vouloir corriger ce chapitre ?
    $javascript = '
<SCRIPT LANGUAGE=JavaScript>
        function confirmation_correction_fta()
        {
        i = document.form_action.correction_fta_suivi_projet.value.replace(/\n/g, \'<br/>\');
        if(confirm(\'Etes vous certain de vouloir corriger ce chapitre ?\'))
        {
            location.href = \'modification_fiche_post.php?id_fta=' . $idFta . '&id_fta_chapitre_encours=' . $id_fta_chapitre_encours . '&synthese_action=' . $synthese_action . '&action=correction&new_correction_fta_suivi_projet=\' + i
             
        }
         else{}
        }
</SCRIPT>
';

    ClassificationFta2Model::initClassification($selection_proprietaire1, $selection_proprietaire2, $selection_marque
            , $selection_activite, $selection_rayon, $selection_environnement, $selection_reseau, $selection_saisonnalite);

    Chapitre::initChapitre($idFta, $id_fta_chapitre, $synthese_action, $comeback, $idFtaEtat, $abreviationFtaEtat, $idFtaRole);

    $bloc.= Chapitre::getHtmlChapitreAll();
} else {
    $titre = UserInterfaceMessage::FR_WARNING_PARAM_ID_FTA_TITLE;
    $message = UserInterfaceMessage::FR_WARNING_PARAM_ID_FTA;
    $redirection = "index.php";
    afficher_message($titre, $message, $redirection);
}

echo '
     ' . $navigue . '
     <form ' . $method . ' action=\'' . $page_action . '\' name=\'form_action\' method=\'post\'>
     <input type=hidden name=action value=' . $action . '>
     <input type=hidden name=id_fta id=id_fta value=' . $idFta . '>
     <input type=hidden name=abreviation_fta_etat id=abreviation_fta_etat value=' . $abreviationFtaEtat . '>
     <input type=hidden name=id_fta_chapitre_encours id=id_fta_chapitre_encours value=' . $id_fta_chapitre_encours . '>
     <input type=hidden name=id_fta_chapitre  id=id_fta_chapitre value=' . $id_fta_chapitre . '>
     <input type=hidden name=id_fta_role id=id_fta_role value=' . $idFtaRole . '>
     <input type=hidden name=id_fta_etat id=id_fta_etat value=' . $idFtaEtat . '>
     <input type=hidden name=id_fta_suivi_projet value=' . $id_fta_suivi_projet . '>    
     <input type=\'hidden\' name=\'synthese_action\' id=synthese_action value=\'' . $synthese_action . '\' />
     <input type=\'hidden\' name=\'nom_fta_chapitre_encours\' value=\'' . $nom_fta_chapitre_encours . '\' />
     <input type=\'hidden\' name=\'comeback\' id=comeback value=\'' . $comeback . '\' />
    
     ' . $javascript . '
     <' . $html_table . '>
     <tr><td>

        ' . $bloc . '

     </td></tr>
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

