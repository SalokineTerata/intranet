<?php
//echo "test";
//header ("Location: http://scanvaegt.tarare.agis.fr/webmonitor/");
//header ("Location: http://131.1.7.1/applications.html");

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
//switch($output)
//{
//
//  case 'visualiser':
//       //Inclusions
//       include ("../lib/session.php");         //Récupération des variables de sessions
//       include ("../lib/functions.php");       //On inclus seulement les fonctions sans construire de page
//       include ("functions.php");              //Fonctions du module
//       echo "
//            <link rel=stylesheet type=text/css href=../lib/css/intra01.css />
//            <link rel=stylesheet type=text/css href=visualiser.css />
//       ";
//
//  //break;
//  case 'pdf':
//  break;
//       //Inclusions
//       include ("../lib/session.php");         //Récupération des variables de sessions
//       include ("../lib/functions.php");       //On inclus seulement les fonctions sans construire de page
//       include ("functions.php");              //Fonctions du module
//       echo "
//            <link rel=stylesheet type=text/css href=../lib/css/intra01.css />
//            <link rel=stylesheet type=text/css href=visualiser.css />
//       ";
//  default:
//        //Inclusions
//        include ("../lib/session.php");         //Récupération des variables de sessions
//  //      include ("../lib/debut_page.php");      //Construction d'une nouvelle
//        if (isset($menu))                       //Si existant, utilisation du menu demandé
//        {                                       //en variable
//
//        }
//        else
//        {
//           $menu="menu_principal.inc";    //Sinon, menu par défaut
//        }
//
 //       include ("./$menu");
//}//Fin de la sélection du mode d'affichage de la page

header ("Location: http://131.1.7.1/applications.html");

require_once '../inc/main.php';
print_page_begin($disable_full_page, $menu_file);


/*************
Début Code PHP
*************/

/*
    Initialisation des variables
*/
   $page_default=substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
   $page_action=$page_default."_post.php";
   $page_pdf=$page_default."_pdf.php";
   $action = 'valider';                       //Action proposée à la page _post.php
   $method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
   $html_table = "table "              //Permet d'harmoniser les tableaux
               . "border=1 "
               . "width=100% "
               . "class=contenu "
               ;

/*
    Récupération des données MySQL
*/
//   Exemple: mysql_table_load('nom_de_ma_table');


/*
     Sélection du mode d'affichage
*/
switch ($output)
{

/*************
Début Code PDF
*************/
case "pdf":
         //Constructeur
         $pdf=new XFPDF();

         //Déclaration des variables de formatages
         $police_standard="Arial";
         $t1_police=$police_standard;
         $t1_style="B";
         $t1_size="12";

         $t2_police=$police_standard;
         $t2_style="B";
         $t2_size="11";

         $t3_police=$police_standard;
         $t3_style="BIU";
         $t3_size="10";

         $contenu_police=$police_standard;
         $contenu_style="";
         $contenu_size="8";

         $chapitre=0;
         $section=0;
         include($page_pdf);
         //$pdf->SetProtection(array("print", "copy"));
         $pdf->Output(); //Read the FPDF.org manual to know the other options

break;
/***********
Fin Code PDF
***********/


/*
    Création des objets HTML (listes déroulante, cases à cocher ...etc.)
*/




/**************
Début Code HTML
**************/
default:

header ("Location: http://131.1.7.1/applications.html");

/**
	echo
"
     <frameset border=0 frameborder=0 framespacing=0 COLS=150,*>
        <frame NAME=g SRC=../lib/frame_gauche.php?module=$module&menu=$menu NORESIZE>
  <frameset border=0 frameborder=0 framespacing=0>
        <frame NAME=d_b SRC=http://131.1.7.1/applications.html NORESIZE>
	";

	**/

/*      <frameset rows=58,* border=1 frameborder=0 framespacing=0>
               <frame name=top scrolling=yes noresize src=../lib/debut_page.php>
               <frame name=main scrolling=yes src=http://131.1.7.1/applications.html>
     </frameset>
    ";
 */


/***********************
Inclusion de fin de page
***********************/
include ("../lib/fin_page.inc");

/************
Fin Code HTML
************/

}//Fin du switch de sélection du mode d'affichage

?>
