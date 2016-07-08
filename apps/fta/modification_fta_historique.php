<?php

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répertoire courant
 */
//   $module=substr(strrchr(`pwd`, '/'), 1);
//   $module=trim($module);


/*
  Si la page peut être appelée depuis n'importe quel module,
  décommentez la ligne suivante
 */

//   $module='';
//Sélection du mode de visualisation de la page
switch ($output) {

    case 'visualiser':
        //Inclusions
        include ('../lib/session.php');         //Récupération des variables de sessions
        include ('../lib/functions.php');       //On inclus seulement les fonctions sans construire de page
        include ('functions.php');              //Fonctions du module
        echo '
            <link rel=stylesheet type=text/css href=../lib/css/intra01.css />
            <link rel=stylesheet type=text/css href=visualiser.css />
       ';

    //break;
    case 'pdf':
        break;

    default:
        //Inclusions
//        include ('../lib/session.php');         //Récupération des variables de sessions
//        include ('../lib/debut_page.php');      //Construction d'une nouvelle
        require_once '../inc/main.php';
        print_page_begin($disable_full_page, $menu_file);
        flush();


//        if (isset($menu))                       //Si existant, utilisation du menu demandé
//        {                                       //en variable
//           include ('./$menu');
//        }
//        else
//        {
//           include ('./menu_principal.inc');    //Sinon, menu par défaut
//        }
}//Fin de la sélection du mode d'affichage de la page

$id_fta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
$synthese_action = Lib::getParameterFromRequest('synthese_action');
$id_fta_chapitre_encours = Lib::getParameterFromRequest('id_fta_chapitre_encours', '1');
$comeback = Lib::getParameterFromRequest('comeback');
$idFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$abreviationFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::FIELDNAME_ABREVIATION);
$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);

/**
 * Initialisation
 */
$ftaModel = new FtaModel($id_fta);
$dossierFta = $ftaModel->getDossierFta();
$idFtaWorkflow = $ftaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
$globalConfig = new GlobalConfig();

if ($globalConfig->getAuthenticatedUser()) {
    $idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
} else {
    $titre = UserInterfaceMessage::FR_WARNING_DECONNECTION_TITLE;
    $message = UserInterfaceMessage::FR_WARNING_DECONNECTION;
    Lib::showMessage($titre, $message, $redirection);
}
$idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
/**
 * Contrôle du rôle attribué
 */
if ($idFtaRole == FtaRoleModel::ID_FTA_ROLE_COMMUN) {
    if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
        $synthese_action = FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS;
    }
    $arrayIdFtaRoleAcces = FtaRoleModel::getArrayIdFtaRoleByIdUserAndWorkflow($idUser, $idFtaWorkflow);
    $idFtaRole = $arrayIdFtaRoleAcces["0"];
    if (!$idFtaRole) {
        $idFtaRole = FtaRoleModel::ID_FTA_ROLE_COMMUN;
    }
}
$id_fta_chapitre = $id_fta_chapitre_encours;

/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER['PHP_SELF'], '/'), '1', '-4');
$page_action = 'modification_fiche.php';
$page_pdf = $page_default . '_pdf.php';
$action = 'valider';                       //Action proposée à la page _post.php
$method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = 'table '              //Permet d'harmoniser les tableaux
        . 'width=100% '
        . 'class=titre_principal '
;
$detail_id_fta;              //Identifiant de la fiche sur laquelle on souhaite un détail

/*
  Récupération des données MySQL
 */

Navigation::initNavigation($id_fta, $id_fta_chapitre, $synthese_action, $comeback, $idFtaEtat, $abreviationFtaEtat, $idFtaRole, TRUE, TRUE);
$navigue = Navigation::getHtmlNavigationBar();


/**
 * Affichage du tableau
 */
$tableauFiche = FtaEtatHistoriqueModel::getHtmlHistoriqueFta($dossierFta, $idFtaWorkflow);

/*
  Sélection du mode d'affichage
 */
switch ($output) {

    /*     * ***********
      Début Code PDF
     * *********** */
    case 'pdf':
        //Constructeur
        $pdf = new XFPDF();

        //Déclaration des variables de formatages
        $police_standard = 'Arial';
        $t1_police = $police_standard;
        $t1_style = 'B';
        $t1_size = '12';

        $t2_police = $police_standard;
        $t2_style = 'B';
        $t2_size = '11';

        $t3_police = $police_standard;
        $t3_style = 'BIU';
        $t3_size = '10';

        $contenu_police = $police_standard;
        $contenu_style = '';
        $contenu_size = '8';

        $chapitre = 0;
        $section = 0;
        include($page_pdf);
        //$pdf->SetProtection(array('print', 'copy'));
        $pdf->Output(); //Read the FPDF.org manual to know the other options

        break;
    /*     * *********
      Fin Code PDF
     * ********* */


    /*
      Création des objets HTML (listes déroulante, cases à cocher ...etc.)
     */




    /*     * ************
      Début Code HTML
     * ************ */
    default:

        echo $navigue . '
             <form name=navigation method=' . $method . ' action=' . $page_action . '>
             <input type=hidden name=action value=' . $action . '>

             <' . $html_table . '>
            <tr>
                ' . $tableauFiche . '
            </tr>
             </table>
             </form>
             ';



        /*         * *********************
          Inclusion de fin de page
         * ********************* */
        include ('../lib/fin_page.inc');

    /*     * **********
      Fin Code HTML
     * ********** */
}//Fin du switch de sélection du mode d'affichage
?>
