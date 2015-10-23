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
switch($output)
{

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
//        include ("../lib/debut_page.php");      //Construction d'une nouvelle
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
               . "border=0 "
               . "width=100% "
               . "class=contenu "
               ;

/*
    Récupération des données MySQL
*/
//   Exemple: mysql_table_load('nom_de_ma_table');

//Recherche des désgnations comerciales



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
        echo "
             <form method=$method action=$page_action>
             <input type=hidden name=action value=$action>

             <$html_table>
             <tr class=titre_principal><td>

                 Corrections diverses

             </td></tr>
             <tr><td>
                  <input type=\"radio\" name=\"action\" value=\"correction_cout_pf\" disabled /> Corriger les coûts Plateforme


             </td></tr>
             <tr><td>
                  <input type=\"radio\" name=\"action\" value=\"regeneration\" disabled /> Régénérer les FTA manquantes


             </td></tr>
             <tr><td>
                  <input type=\"radio\" name=\"action\" value=\"search_long_name\" disabled /> Rechercher les Désignations Commerciales trop longues


             </td></tr>
             <tr><td>
                 <hr />
                 Version 2.4.0:
             </td></tr>
             <tr><td>
                  <input type=\"radio\" name=\"action\" value=\"2_4_0_doublon_emballage_UVC\" /> Doublon dans les emballage UVC
             </td></tr>

             <tr><td>
                 <hr />
                 Version 2.3.0:
             </td></tr>
             <tr><td>
                  <input type=\"radio\" name=\"action\" value=\"2_3_0_archivage_fta\" disabled /> Archivage des FTA Validées, non classées et non vendu dans Agrologic
             </td></tr>
             <tr><td>
                  <input type=\"radio\" name=\"action\" value=\"2_3_0_epuration_nomenclature\" disabled /> Préparation des nomenclatures à importer d'Agrologic
             </td></tr>
             <tr><td>
                  <input type=\"radio\" name=\"action\" value=\"2_3_0_maj_nomenclature\" disabled /> Création des nomenclatures manquantes des FTA à partir des nomenclatures Agrologic (Traitement: 10 min.)
             </td></tr>
             <tr><td>
                  <input type=\"radio\" name=\"action\" value=\"2_3_0_composant_orphelin\" /> Correction des composants orphelins
             </td></tr>
             <tr><td>
                  <input type=\"radio\" name=\"action\" value=\"2_3_0_recreation_din_nomenclature\" disabled /> Recréer les DIN des nomenclatures
             </td></tr>
             </table>

             <br><br>

             <$html_table>
             <tr class=titre_principal><td>

                 <center>
                 <input type=submit value='Lancer le traitement'>
                 </center>

             </td></tr>
             </table>

             </form>
             ";



/***********************
Inclusion de fin de page
***********************/
include ("../lib/fin_page.inc");

/************
Fin Code HTML
************/

}//Fin du switch de sélection du mode d'affichage

?>