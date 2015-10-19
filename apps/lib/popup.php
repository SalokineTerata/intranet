<?php

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répertoire courant
 */
/*    $module=substr(strrchr(`pwd`, '/'), 1);
  $module=trim($module);
 */

//Founi en URL
//echo "TEST:".$_SERVER["QUERY_STRING"];

/*
  Si la page peut être appelée depuis n'importe quel module,
  décommentez la ligne suivante
 */

//   $module='';
//include ("../lib/functions.php");       //On inclus seulement les fonctions sans construire de page
//echo "
//            <link rel=stylesheet type=text/css href=../lib/css/intra01.css />
//            <link rel=stylesheet type=text/css href=visualiser.css />
//       ";

require_once '../inc/main.php';
//Sélection du mode de visualisation de la page
//switch($output)
//{
//
//  case 'visualiser':
//       //Inclusions
//       include ("../lib/session.php");         //Récupération des variables de sessions
//       include ("functions.php");              //Fonctions du module
//       echo "
//            <link rel=stylesheet type=text/css href=../lib/css/intra01.css />
//            <link rel=stylesheet type=text/css href=visualiser.css />
//       ";
//
//  //break;
//  case 'pdf':
//  break;
//
//  default:
//        //Inclusions
//        include ("../lib/session.php");         //Récupération des variables de sessions
//        include ("../lib/debut_page.php");      //Construction d'une nouvelle
//        if (isset($menu))                       //Si existant, utilisation du menu demandé
//        {                                       //en variable
//           include ("./$menu");
//        }
//        else
//        {
//           //include ("./popup-mysql_field_desc-menu_principal.inc");    //Sinon, menu par défaut
//        }
//
//}//Fin de la sélection du mode d'affichage de la page

/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$default_message = Lib::isDefined("default_message");
$popup_name = Lib::getParameterFromRequest("popup_name");
$popup_content = $_SESSION[$popup_name];
$edit_allow = Lib::getParameterFromRequest("edit_allow");
$title = Lib::getParameterFromRequest("title");
$special_page = Lib::getParameterFromRequest("special_page");

$page_default = substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
$page_action = $page_default . ".php"
        . "?edit_allow=$edit_allow"
        . "&default_message=$default_message"
        . "&disable_full_page=1"
;
//$page_pdf = $page_default . "_pdf.php";
//$action = '';                              //Action proposée à la page _post.php
$method = 'POST';                          //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = "table "                     //Permet d'harmoniser les tableaux
        . "border=1 "
        . "width=100% "
        . "class=contenu "
;
$edit_mode;                                //Si =1, alors mode edition de l'aide en ligne
//$edit_allow = $GLOBALS{$module . "_" . $nom_intranet_actions};   //L'utilisateur a-t-il la permission de modifier le manuel ?
//include ("./popup-mysql_field_desc-menu_principal.inc");
//if ($action == "record") {
//    //echo $explication_intranet_description;
//    mysql_table_operation("intranet_description", "rewrite");
//    $action = '';
//}
//if ($edit_mode) {
//
//    $action = 'record';
//}
/*
  Récupération des données MySQL
 */
//   Exemple: mysql_table_load('nom_de_ma_table');
//echo   $GLOBALS{$module."_".$nom_intranet_actions};
//$id_intranet_description;    //Fourni par URL
//mysql_table_load('intranet_description');
//$explication_intranet_description;
//$nom_table = $table_intranet_description;
//$nom_variable = $champ_intranet_description;
//$show_help = 0;
//$title = mysql_field_desc($nom_table, $nom_variable, $show_help);

$content = $popup_content;
$bouton_record = "";
ini_set('memory_limit', '-1');
if ($edit_mode) {
    $bouton_record = "<tr><td>
                   <center>
                   <input type=submit value='Enregistrer'>
                   </center>
                   ";
    $content = "<textarea name=content rows=24 cols=57>$content</textarea>";
}

switch ($special_page) {
    case "MYSQL_QUERIES":
        $popup_content = print_r($_SESSION['queriesInfo'], true);
        $content = $popup_content;
}


/*
  Sélection du mode d'affichage
 */
//switch ($output) {
//
//    /*     * ***********
//      Début Code PDF
//     * *********** */
//    case "pdf":
//        //Constructeur
//        $pdf = new XFPDF();
//
//        //Déclaration des variables de formatages
//        $police_standard = "Arial";
//        $t1_police = $police_standard;
//        $t1_style = "B";
//        $t1_size = "12";
//
//        $t2_police = $police_standard;
//        $t2_style = "B";
//        $t2_size = "11";
//
//        $t3_police = $police_standard;
//        $t3_style = "BIU";
//        $t3_size = "10";
//
//        $contenu_police = $police_standard;
//        $contenu_style = "";
//        $contenu_size = "8";
//
//        $chapitre = 0;
//        $section = 0;
//        include($page_pdf);
//        //$pdf->SetProtection(array("print", "copy"));
//        $pdf->Output(); //Read the FPDF.org manual to know the other options
//
//        break;
/* * *********
  Fin Code PDF
 * ********* */


/*
  Création des objets HTML (listes déroulante, cases à cocher ...etc.)
 */




/* * ************
  Début Code HTML
 * ************ */
//default:

echo "
             <form method=" . $method . " action=" . $page_action . ">
             <input type=hidden name=action value=" . $action . ">
             <!input type=hidden name=edit_mode value=" . $edit_mode . ">

             <" . $html_table . ">
             <tr class=titre_principal><td>

                " . $title . "

             </td></tr>
             <tr><td>

                 <pre>" . $content . "</pre>

             </td></tr>

                 " . $bouton_record . "

             </td></tr>
             </table>

             </form>
             ";



/* * *********************
  Inclusion de fin de page
 * ********************* */
include ("../lib/fin_page.inc");

/* * **********
  Fin Code HTML
 * ********** */
//}//Fin du switch de sélection du mode d'affichage
?>