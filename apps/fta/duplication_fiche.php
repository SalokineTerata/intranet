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
               . "border=1 "
               . "width=100% "
               . "class=contenu "
               ;

/*
    Récupération des données MySQL
*/
mysql_table_load('fta');
//echo $id_fta;
//echo $id_access_arti2;
//mysql_table_load('access_arti2');



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

default:
/*
    Création des objets HTML (listes déroulante, cases à cocher ...etc.)
*/

$bloc="";

//Marque
$id_element="2"; //Recherche de la Marque
$extension[0]=1; //Passage en mode recherche d'une catégorie
$champ = recherche_element_classification_fta($id_fta, $id_element, $extension);
$champ[2];
$bloc .= "Marque(s) <i>(anciennement gamme)</i>:";
$bloc .= "$champ[2]";
$bloc.="<br>";

//Activité
$id_element="3"; //Recherche de l'Activité
$extension[0]=1; //Passage en mode recherche d'une catégorie
$champ = recherche_element_classification_fta($id_fta, $id_element, $extension);
$champ[2];
$bloc .= "Activité(s) <i>(anciennement ségment)</i>:";
$bloc .= "$champ[2]";
$bloc.="<br>";


/**************
Début Code HTML
**************/


        echo "
             <form method=$method action=$page_action>
             <input type=\"hidden\" name=\"id_fta\" value=\"$id_fta\" />
             <input type=\"hidden\" name=\"abreviation_etat_destination\" value=\"$abreviation_etat_destination\" />
             <input type=\"hidden\" name=\"new_designation_commerciale_fta\" value=\"$new_designation_commerciale_fta\" />
             <$html_table>
             <tr><td>

                 &nbsp&nbsp&nbsp&nbsp
                 Attention, vous êtes sur le point de dupliquer la Fiche Technique Article suivante:<br>
                 <br>
                     <$html_table>
                     <tr class=titre_principal><td align=left>
                         <br>
                         $NOM_designation_commerciale_fta: $designation_commerciale_fta<br>
                         <br>
                         $bloc

                     </td></tr>
                     </table>
                 <br>
                 Dès que vous aurez cliqué sur le bouton Dupliquer, <br>
                 un double de l'ensemble de la fiche technique article sera créée sous le nom <b>$new_designation_commerciale_fta</b>.<br>
                 Cette opération est irreversible<br>
                 <br>
                 <br>

             </td></tr>
             <tr><td>

                 <input type=\"radio\" name=\"action\" value=\"totale\" checked /> Nouveau Dossier à l'aide d'une duplication Totale<br>
                 <input type=\"radio\" name=\"action\" value=\"selective\" disabled /> Nouveau Dossier à l'aide d'une duplication sélective<br>
                 <input type=\"radio\" name=\"action\" value=\"version\" disabled  /> Nouvelle version de la Fiche Technique Article<br>
         

             </td></tr>
             <tr><td>

                 <center>
                 <input type=submit value='Dupliquer !'>
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