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
        require_once '../inc/main.php';
        print_page_begin($disable_full_page, $menu_file);
        //include ("../lib/debut_page.php");      //Construction d'une nouvelle
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
   $action="valider";  //L'action sera de sélectionner un groupe d'emballage
   $method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
   $html_table = "table "              //Permet d'harmoniser les tableaux
               . "border=1 "
               . "width=100% "
               . "class=contenu "
               ;

/*
    Récupération des données MySQL
*/

//Chargement de la recette si existante
if ($id_access_recette_recette){
   mysql_table_load("access_recettes_recette");
}

$bloc=""; //Bloc de saisie
switch($mode_selection) //Possiblité de choisir par liste ou par saisie directe de l'identifiant
{
case 1: //Sélection par liste

    //On reviendra sur cette même page, mais avec le N°dossier pré-saisie
    $page_action=$page_default.".php";
    $mode_selection=0;

    //Création de la liste déroulante des recette
    //Qui sont recettes racines et qui sont les dernières versions

    $liste_recette = "Liste des recettes racines</td><td><select name=id_access_recette_recette>";

    $req = "SELECT * "
         . "FROM access_recettes_recette "
         . "ORDER BY INTITULE_RECETTE, INDICE DESC "
         ;
    $result=DatabaseOperation::query($req);
    while ($rows1=mysql_fetch_array($result))
    {
          //Est'ce une recette racine ?
//echo $rows1["id_access_recette_recette"]."<br>";
          if (recette_racine($rows1["id_access_recette_recette"]))
          {
             if($rows1["id_access_recette_recette"]==$id_access_recette_recette)
             {
                 $selected="selected";
             }
             else
             {
                 $selected="";
             }
             //Dans ce cas on l'intègre dans la liste
             $liste_recette .="<option value=".$rows1["id_access_recette_recette"]." $selected>"
                            . $rows1["INTITULE_RECETTE"]
                            ."(".$rows1["INDICE"].")"
                            . "</option>"
                            ;
           
          }

    }
    $liste_recette .="</select>";
   /* $nom_liste ="";
   $requete = "SELECT id_access_recette_recette, INTITULE_RECETTE "
             . "FROM access_recettes_recette "
             . "WHERE liste_ingredient_defaut IS NOT NULL "
             . "ORDER BY INTITULE_RECETTE "
             ;
    $id_defaut = $id_access_recette_recette;
    $nom_defaut ="";
    $liste_recette = mysql_field_desc("access_recettes_recette", "id_access_recette_recette")
                  . "</td><td>"
                  . afficher_requete_en_liste_deroulante($requete, $id_defaut, $nom_defaut)
                  ; */
    $bloc.=$liste_recette;

break;

default: //Sélection par saisie de l'identifiant


        //Identifiant Recette
        $bloc .= "<tr><td>Identifiant Recette:</td><td>";
        $bloc .= "<input type=text name=site_recette value=`".$site_recette."` size=2/> - ";
        $bloc .= "<input type=text name=CLE_RECETTE value=`".$CLE_RECETTE."` size=20/>";
        $bloc .="</td></tr>";

}//Fin de la création du bloc de saisie



//Lien permettant de basculer entre la sélection par liste ou par saisie directe de l'identifiant
$lien_mode_selection = "Méthode de sélection de la recette</td><td>"
                     . "<a href=".$page_default.".php"
                     . "?id_fta=$id_fta"
                     . "&id_fta_chapitre_encours=$id_fta_chapitre_encours"
                     . "&mode_selection=1"
                     . ">Liste de toutes les recettes</a>"
                     . "<hr>"
                     . "<a href=".$page_default.".php"
                     . "?id_fta=$id_fta"
                     . "&id_fta_chapitre_encours=$id_fta_chapitre_encours"
                     . "&mode_selection=0"
                     . ">Saisie de l'Identifiant Recette</a>"
                     ;
             



//Nombre de conditionnement dans cet ascendant



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
//echo $id_fta;
        echo "
             <form method=$method action=$page_action>
             <input type=hidden name=action value=$action>
             <input type=hidden name=id_fta value=$id_fta>
             <input type=hidden name=id_fta_chapitre_encours value=$id_fta_chapitre_encours>
             <input type=hidden name=id_access_recette_recette value=$id_access_recette_recette>

             <$html_table>
             <tr class=titre_principal><td>

                 Ajout d'une nouvelle Recettes

             </td></tr>
             </table>
             <$html_table>
             <tr><td>

                 $lien_mode_selection

             </td></tr>
             <tr><td>

                 $bloc

             </td></tr>
             </table>
             <$html_table>
             <tr><td>

                 <center>
                 <input type=submit value='Ajouter cette Recette'>
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