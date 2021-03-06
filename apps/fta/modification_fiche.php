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
$page_query = $_SERVER['QUERY_STRING'];
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
/**
 * Vérification des droits d'accès
 */
/*
 * Initilisation
 */
$globalConfig = new GlobalConfig();

if ($globalConfig->getAuthenticatedUser()) {
    $idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
} else {
    $titre = UserInterfaceMessage::FR_WARNING_DECONNECTION_TITLE;
    $message = UserInterfaceMessage::FR_WARNING_DECONNECTION;
    Lib::showMessage($titre, $message, $redirection);
}

$fta_consultation = Acl::getValueAccesRights('fta_consultation');
$fta_modification = Acl::getValueAccesRights('fta_modification');

if (!$fta_consultation) {
    $titre = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS_TITLE;
    $message = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS
            . " Veuillez vous déconnecter et contactez l'administrateur de l'intranet";
    $redirection = "index.php";
    Lib::showMessage($titre, $message, $redirection, TRUE);
} elseif ($fta_modification) {
    $idFtaRoleEncoursDefault = FtaRoleModel::getKeyNameOfFirstRoleByIdUser($idUser);
    if (!$idFtaRoleEncoursDefault) {
        $titre = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS_TITLE;
        $message = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS_ROLES;
        $redirection = "index.php";
        Lib::showMessage($titre, $message, $redirection);
    }
}

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
    $checkArcadiaData = Fta2ArcadiaTransactionModel::isIdArcadiaTransactionActif($idFta);
    $id_fta_chapitre_encours = Lib::getParameterFromRequest('id_fta_chapitre_encours', '1');
    $synthese_action = Lib::isDefined('synthese_action');
    $comeback = Lib::isDefined('comeback');
    $idFtaEtat = Lib::isDefined(FtaEtatModel::KEYNAME);
    $abreviationFtaEtat = Lib::isDefined(FtaEtatModel::FIELDNAME_ABREVIATION);
    $idFtaRole = Lib::isDefined(FtaRoleModel::KEYNAME);
    $ftaModification = Acl::getValueAccesRights('fta_modification');
    $id_fta_chapitre = $id_fta_chapitre_encours;
    /**
     * Initilisation
     */
    $ftaModel = new FtaModel($idFta); //Rien ne garantie que l'utilisateur est mis un idFta existant
    $idWorkflowFtaEncours = $ftaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
    $idSiteDeProduction = $ftaModel->getDataField(FtaModel::FIELDNAME_SITE_PRODUCTION)->getFieldValue();
    /**
     * Ticket 49823 en 3.1 activation/désactivation d'un workflow
     */
//    FtaWorkflowModel::checkActifWorkflow($idWorkflowFtaEncours);

    /**
     * Verification des droits d'accès sur une Fta en modification
     */
    if ($idFtaEtat == FtaEtatModel::ID_VALUE_MODIFICATION and ! $ftaModification) {
        $titre = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS_TITLE;
        $message = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS;
        $redirection = "index.php";
        Lib::showMessage($titre, $message, $redirection);
    }



//    $selection_proprietaire1 = Lib::getParameterFromRequest('selection_proprietaire1');
//    $selection_proprietaire2 = Lib::getParameterFromRequest('selection_proprietaire2');
//    $selection_marque = Lib::getParameterFromRequest('selection_marque');
//    $selection_activite = Lib::getParameterFromRequest('selection_activite');
//    $selection_rayon = Lib::getParameterFromRequest('selection_rayon');
//    $selection_environnement = Lib::getParameterFromRequest('selection_environnement');
//    $selection_reseau = Lib::getParameterFromRequest('selection_reseau');
//    $selection_saisonnalite = Lib::getParameterFromRequest('selection_saisonnalite');
//    $checkIdFtaClasssification = Lib::getParameterFromRequest('checkIdFtaClasssification');



    /**
     * On vérifie si l'utilisateur à les droits d'accès sur une Fta en état de modification
     */
    if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION and $ftaModification) {
        if ($idFtaRole == FtaRoleModel::ID_FTA_ROLE_COMMUN) {
            $arrayIdFtaRoleAcces = FtaRoleModel::getArrayIdFtaRoleByIdUserAndWorkflow($idUser, $idWorkflowFtaEncours);
        }
        $checkAccesButtonBySiteProd = IntranetDroitsAccesModel::isIdUserHaveRightsOnSiteProdByWorkflow($idUser, $idWorkflowFtaEncours, $idSiteDeProduction);

        if ((!$arrayIdFtaRoleAcces and ! $checkAccesButtonBySiteProd) or ! $checkAccesButtonBySiteProd) {
            $titre = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS_TITLE;
            $message = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS;
            $redirection = "index.php";
            Lib::showMessage($titre, $message, $redirection);
        } else {
            /**
             * On affecte un IdFtaRole seulement dans le cas ou on est vient de la page de recherche
             */
            if ($idFtaRole == FtaRoleModel::ID_FTA_ROLE_COMMUN) {
                $idFtaRole = $arrayIdFtaRoleAcces["0"];
            }
        }
    } elseif ($ftaModification) {
        /**
         * On affecte un IdFtaRole seulement dans le cas ou on est vient de la page de recherche
         */
        if ($idFtaRole == FtaRoleModel::ID_FTA_ROLE_COMMUN) {
            $arrayIdFtaRoleAcces = FtaRoleModel::getArrayIdFtaRoleByIdUserAndWorkflow($idUser, $idWorkflowFtaEncours);
            $idFtaRole = $arrayIdFtaRoleAcces["0"];
            if (!$arrayIdFtaRoleAcces and $idFtaEtat == FtaEtatModel::ID_VALUE_MODIFICATION) {
                $titre = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS_TITLE;
                $message = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS_WORKFLOW;
                $redirection = "index.php";
                Lib::showMessage($titre, $message, $redirection);
            } elseif (!$arrayIdFtaRoleAcces) {
                $idFtaRole = FtaRoleModel::ID_FTA_ROLE_COMMUN;
            }
        }
    }

    $affichgeDesChapitres = TRUE;

    Navigation::initNavigation($idFta, $id_fta_chapitre_encours, $synthese_action, $comeback, $idFtaEtat, $abreviationFtaEtat, $idFtaRole, $affichgeDesChapitres, FALSE, FALSE);

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

    Chapitre::initChapitre($idFta, $id_fta_chapitre, $synthese_action, $comeback, $idFtaEtat, $abreviationFtaEtat, $idFtaRole, $checkArcadiaData);

    $bloc.= Chapitre::getHtmlChapitreAll();
} else {
    $titre = UserInterfaceMessage::FR_WARNING_PARAM_ID_FTA_TITLE;
    $message = UserInterfaceMessage::FR_WARNING_PARAM_ID_FTA;
    $redirection = "index.php";
    Lib::showMessage($titre, $message, $redirection);
}

echo '
     ' . $navigue . '
     <form ' . $method . ' action=\'' . $page_action . '\' name=\'form_action\' method=\'post\'>
     <input type=hidden name=action value=' . $action . '>
     <input type=hidden name=current_page value=' . $page_default . '.php >
     <input type=hidden name=current_query value=' . $page_query . ' >
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

