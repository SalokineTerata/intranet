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
        include ("../lib/session.php");         //Récupération des variables de sessions
        include ("../lib/functions.php");       //On inclus seulement les fonctions sans construire de page
        include ("functions.php");              //Fonctions du module
        echo "
            <link rel=stylesheet type=text/css href=../lib/css/intra01.css />
            <link rel=stylesheet type=text/css href=visualiser.css />
       ";

    //break;
    case 'pdf':
        break;

    default:
        //Inclusions
//        include ("../lib/session.php");         //Récupération des variables de sessions
        //include ("../lib/debut_page.php");      //Construction d'une nouvelle
        require_once '../inc/main.php';
        print_page_begin($disable_full_page, $menu_file);
        flush();


//        if (isset($menu))                       //Si existant, utilisation du menu demandé
//        {                                       //en variable
//           include ("./$menu");
//        }
//        else
//        {
//           include ("./menu_principal.inc");    //Sinon, menu par défaut
//        }
}//Fin de la sélection du mode d'affichage de la page


/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
$page_action = $page_default . "_post.php";
$page_pdf = $page_default . "_pdf.php";
$action = "valider";  //L'action sera de sélectionner un groupe d'emballage
$method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = "table "              //Permet d'harmoniser les tableaux
        . "border=0 "
        . "width=100% "
        . "class=titre "
;

/*
  Récupération des données MySQL
 */
$id_fta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
$id_fta_composant = Lib::getParameterFromRequest(FtaComposantModel::KEYNAME);
$id_fta_chapitre = Lib::getParameterFromRequest('id_fta_chapitre_encours');
$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);
$idFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$abreviationFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::FIELDNAME_ABREVIATION);
$comeback = Lib::getParameterFromRequest('comeback');
$syntheseAction = Lib::getParameterFromRequest('synthese_action');
$proprietaire = Lib::getParameterFromRequest('proprietaire');
$globalConfig = new GlobalConfig();
$id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();
$HtmlList = new HtmlListSelect();

//Mode Création/Modification d'une nomenclature
//if ($id_fta_nomenclature)
if ($proprietaire) {
    $isEditable = TRUE;
    $bouton_action = 'Enregistrer';
} else {
    $isEditable = FALSE;
    $bouton_action = 'Revenir sur la Fta';
}
if ($id_fta_composant) {
    $creation = 0;
    $ftaComposantModel = new FtaComposantModel($id_fta_composant);
    $ftaComposantView = new FtaComposantView($ftaComposantModel);
    $ftaComposantView->setIsEditable($isEditable);
} else {
    $creation = 1;
    $id_fta_composant = FtaComposantModel::InsertFtaComposant($id_fta);
    $ftaComposantModel = new FtaComposantModel($id_fta_composant);
    $ftaComposantView = new FtaComposantView($ftaComposantModel);
    $ftaComposantView->setIsEditable($isEditable);
}


//Chargement des données de la FTA
//$ftaModel = new FtaModel($id_fta);

$bloc = ""; //Bloc de saisie
//Désignation
$bloc.= "<tr class=titre_principal><td>"
        . "Informations sur les produits du composant"
        . "</td></tr>"
        . "<tr><td>"
        . "<$html_table>"
;
// Prefixe code PSF
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_ID_ANNEXE_AGRO_ART_CODIFICATION);
//$bloc .=FtaComposantModel::ShowListeDeroulantePrefixeForComposant($HtmlList, $isEditable, $id_fta_composant);


//Code PSF Arcadia
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE);


//Désignation Nomenclature
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_DESIGNATION_CODIFICATION);


//Poids unitaire de la nomenclature
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_POIDS_UNITAIRE_CODIFICATION);

//Unité du Poids de la nomenclature
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_ID_ANNEXE_UNITE);


//Site de production du composant
$bloc .= FtaComposantModel::ShowListeDeroulanteSiteProdForComposant($HtmlList, $isEditable, $id_fta, $id_fta_composant, FtaComposantModel::FIELDNAME_SITE_PRODUCTION_FTA_CODIFICATION);

//Environnement de conservation
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_ETAT_FTA_CODIFICATION);


//Quantité de pièce par Carton (cas des surgelé)

$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_QUANTITE_PIECE_PAR_CARTON);
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_POIDS_TOTAL_CARTON_VRAC_FTA_NOMENCLATURE);

/*
  Sélection du mode d'affichage
 */
switch ($output) {

    /*     * ***********
      Début Code PDF
     * *********** */
    case "pdf":
        //Constructeur
        $pdf = new XFPDF();

        //Déclaration des variables de formatages
        $police_standard = "Arial";
        $t1_police = $police_standard;
        $t1_style = "B";
        $t1_size = "12";

        $t2_police = $police_standard;
        $t2_style = "B";
        $t2_size = "11";

        $t3_police = $police_standard;
        $t3_style = "BIU";
        $t3_size = "10";

        $contenu_police = $police_standard;
        $contenu_style = "";
        $contenu_size = "8";

        $chapitre = 0;
        $section = 0;
        include($page_pdf);
        //$pdf->SetProtection(array("print", "copy"));
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
//echo $id_fta;
        echo "
             <form method=\"post\" action=\"" . $page_action . "\" name=\"action\">
             <input type=hidden name=action value=" . $action . ">
             <input type=hidden name=id_fta value=" . $id_fta . ">
             <input type=hidden name=id_fta_chapitre_encours value=" . $id_fta_chapitre . ">
             <input type=hidden name=id_fta_composant value=" . $id_fta_composant . ">
             <input type=hidden name=creation value=$creation>
              <input type=hidden name=id_fta_role value=" . $idFtaRole . ">
             <input type=hidden name=abreviation_fta_etat value=" . $abreviationFtaEtat . ">
             <input type=hidden name=id_fta_etat value=" . $idFtaEtat . ">
             <input type=hidden name=comeback value=" . $comeback . ">
             <input type=\"hidden\" name=\"synthese_action\" value=\"" . $syntheseAction . "\" />
             <input type=\"hidden\" name=\"proprietaire\" value=\"" . $proprietaire . "\" />

             <" . $html_table . ">
             <tr class=titre_principal><td>

                 Ajout d'un Composant

             </td></tr>
             </table>
             <" . $html_table . ">
             

                 $bloc

             </td></tr>
             </table>
             <" . $html_table . ">
             <tr><td>

                 <center>
                 <input type=submit value='" . $bouton_action . "'>
                 </center>

             </td></tr>
             </table>

             </form>
             ";



        /*         * *********************
          Inclusion de fin de page
         * ********************* */
        include ("../lib/fin_page.inc");

    /*     * **********
      Fin Code HTML
     * ********** */
}//Fin du switch de sélection du mode d'affichage
?>