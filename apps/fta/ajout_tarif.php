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


//Enseigne
$req_liste_client = "SELECT id_classification_arborescence_article_categorie_contenu, nom_classification_arborescence_article_categorie_contenu "
                  . "FROM classification_arborescence_article_categorie_contenu "
                  . "WHERE id_classification_arborescence_article_categorie = 1 " //Niveau Propriétaire
                  //. "AND ascendant_classification_arborescence_client IS NULL "
                  . "ORDER BY nom_classification_arborescence_article_categorie_contenu "
                  ;
$id_defaut="0"; //Tarif général par défaut
$nom_defaut="";
$liste_client = afficher_requete_en_liste_deroulante($req_liste_client, $id_defaut, $nom_defaut);

//   Exemple: mysql_table_load('nom_de_ma_table');


                     //Conditions Commerciale



/*
    Création des objets HTML (listes déroulante, cases à cocher ...etc.)
*/


         //Début de la période du tarif
         $champ="date_debut_fta_tarif";
         $bloc .= "<tr class=contenu><td  width=\"40%\">".mysql_field_desc("fta_tarif", "date_debut_fta_tarif")."</td><td>";
         $bloc .= selection_date_pour_mysql($champ, ${$champ})."&nbsp;<i>Laissez vide pour que le tarif soit appliqué immédiatement</i>";
         $bloc.="</td></tr>";

         //Fin de la période du tarif
         $champ="date_fin_fta_tarif";
         $bloc .= "<tr class=contenu><td  width=\"40%\">".mysql_field_desc("fta_tarif", "date_fin_fta_tarif")."</td><td>";
         $bloc .= selection_date_pour_mysql($champ, ${$champ})."&nbsp;<i>Laissez vide pour que le tarif soit appliqué jusqu'à la fin de l'année</i>";
         $bloc.="</td></tr>";

         //echo "TEST".$bloc;

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
             <input type=\"hidden\" name=\"synthese_action\" value=\"$synthese_action\" />

             <$html_table>
             <tr class=titre_principal><td>

                 Ajout d'un nouveau tarif

             </td></tr>
             </table>
             <$html_table>
             <tr><td>

                 Enseigne:
                 </td>
                 <td>
                 $liste_client

             </td></tr>
             <tr><td>

                 ".mysql_field_desc("fta_tarif", "prix_fta_tarif").":
                 </td>
                 <td>
                 <input type=text name=prix_fta_tarif value='' size=20/>

             </td></tr>
             <tr><td>

                 ".mysql_field_desc("fta_tarif", "conditions_commerciales_fta_tarif").":
                 </td>
                 <td>
                 <input type=radio name=conditions_commerciales_fta_tarif value=1> Oui<hr>
                 <input type=\"radio\" name=\"conditions_commerciales_fta_tarif\" value=\"0\" checked /> Non

             </td></tr>
             <tr><td>
                 Ristournable:
                 </td>
                 <td>
                 <input type=radio name=ristournable_fta_tarif value=1> Oui<hr>
                 <input type=\"radio\" name=\"ristournable_fta_tarif\" value=\"0\" checked /> Non

             </td></tr>
                  $bloc
             </table>
             <$html_table>
             <tr><td>

                 <center>
                 <input type=submit value='Ajouter ce Tarif'>
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