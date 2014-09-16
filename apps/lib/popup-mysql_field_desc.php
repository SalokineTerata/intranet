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
//Sélection du mode de visualisation de la page
switch ($output) {

    case 'visualiser':
        //Inclusions
        //include ("../lib/session.php");         //Récupération des variables de sessions
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
        //include ("../lib/session.php");         //Récupération des variables de sessions
        $module_save = $module;
        require_once ("../lib/debut_page.php");      //Construction d'une nouvelle
        $module = $module_save;
        //include ("../lib/functions.php");       //On inclus seulement les fonctions sans construire de page
        if (isset($menu)) {                       //Si existant, utilisation du menu demandé                                       //en variable
            include ("./$menu");
        } else {
            //include ("./popup-mysql_field_desc-menu_principal.inc");    //Sinon, menu par défaut
        }
}//Fin de la sélection du mode d'affichage de la page

/* * ***********
  Début Code PHP
 * *********** */
//echo $_REQUEST["id_intranet_description"];

$id_intranet_description = Lib::getParameterFromRequest("id_intranet_description");    //Fourni par URL
/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
$page_action = $page_default . ".php"
        . "?edit_allow=$edit_allow"
        . "&id_intranet_description=$id_intranet_description"
        . "&module=$module"
        . "&champ_intranet_description=$champ_intranet_description"
        . "&nom_intranet_actions=$nom_intranet_actions"
        . "&disable_full_page=1"
;
$page_pdf = $page_default . "_pdf.php";
//$action = '';                              //Action proposée à la page _post.php
$method = 'POST';                          //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = "table "                     //Permet d'harmoniser les tableaux
        . "border=1 "
        . "width=100% "
        . "class=contenu "
;
$edit_mode;                                //Si =1, alors mode edition de l'aide en ligne
$edit_allow = $GLOBALS{$module . "_" . $nom_intranet_actions};   //L'utilisateur a-t-il la permission de modifier le manuel ?
$table_intranet_column = "intranet_column_info";

require_once ("./popup-mysql_field_desc-menu_principal.inc");
if ($action == "record") {
    $id_intranet_description;
    $explication_intranet_description = Lib::getParameterFromRequest("explication_intranet_description");
    $request = "UPDATE $table_intranet_column "
            . "SET `explication_intranet_column_info`='" . $explication_intranet_description . "' "
            . "WHERE `id_intranet_column_info`='" . $id_intranet_description . "' ";
    DatabaseOperation::query($request);
    $action = '';
}
if ($edit_mode) {

    $action = 'record';
}
/*
  Récupération des données MySQL
 */
//   Exemple: mysql_table_load('nom_de_ma_table');
//echo   $GLOBALS{$module."_".$nom_intranet_actions};

$id_intranet_column_info = $id_intranet_description;
$request = "SELECT * FROM $table_intranet_column "
        . "WHERE `id_intranet_column_info`='" . $id_intranet_description . "' ";
$result = DatabaseOperation::query($request);
$explication_intranet_description = mysql_result($result, 0,  "explication_intranet_column_info");
$nom_table = mysql_result($result, 0, "table_name_intranet_column_info");
$nom_variable = mysql_result($result, 0, "column_name_intranet_column_info");
$show_help = 0;
$title = DatabaseDescription::getColumnLabel($nom_table, $nom_variable);

$content = html_view_txt($explication_intranet_description);
$bouton_record = "";
if ($edit_mode) {
    $bouton_record = "<tr><td>
                   <center>
                   <input type=submit value='Enregistrer'>
                   </center>
                   ";
    $content = "<textarea name=explication_intranet_description rows=24 cols=57>$explication_intranet_description</textarea>";
}


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




    /****************
      Début Code HTML
     * ************ */
    default:

        echo "
             <form method=$method action=$page_action>
             <input type=hidden name=explication_intranet_description; value=$explication_intranet_description;>
             <input type=hidden name=table_intranet_description value=$table_intranet_description>
             <input type=hidden name=$champ_intranet_description value=$champ_intranet_description>
             <input type=hidden name=id_intranet_description value=$id_intranet_description>
             <input type=hidden name=module value=$module>
             <input type=hidden name=action value=$action>
             <!input type=hidden name=edit_mode value=$edit_mode>

             <$html_table>
             <tr class=titre_principal><td>

                 $title 

             </td></tr>
             <tr><td>
                 <br><br>
                 $content
                 <br><br>
             </td></tr>
            <tr><td align=right>

                <i><small>$nom_table.$nom_variable</small></i>

             </td></tr>

                 $bouton_record

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