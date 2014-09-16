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
        //include ("../lib/debut_page.php");      //Construction d'une nouvelle
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
   $action="valider";  //L'action sera de sélectionner un groupe d'emballage
   $method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
   $html_table = "table "              //Permet d'harmoniser les tableaux
               . "border=0 "
               . "width=100% "
               . "class=titre "
               ;

/*
    Récupération des données MySQL
*/
$id_fta_chapitre=$id_fta_chapitre_encours;
mysql_table_load("fta_chapitre");
//Mode Création/Modification d'une nomenclature
//if ($id_fta_nomenclature)
if ($id_fta_composant)
{
   $creation = 0;
   mysql_table_load("fta_composant");
   mysql_table_load("annexe_agrologic_article_codification");
   }
   else
   {
   $creation = 1;

}


//Chargement des données de la FTA
mysql_table_load("fta");
mysql_table_load("access_arti2");

//Chargement de la recette si existante
/* if($id_access_recette_recette)
{
    $nomenclature_orpheline = 0;
    mysql_table_load("access_recettes_recette");
    $recette_racine=recette_racine($id_access_recette_recette);
    }
    else
    {
    $nomenclature_orpheline = 1;
}
 */

//echo $id_annexe_agrologic_article_codification;

$bloc=""; //Bloc de saisie

//Partie commune aux Recettes Racine et aux Sous-Recettes

if(!$creation and $id_access_recette_recette)
{
        //Désignation
        $champ="INTITULE_RECETTE";
        $bloc.= "<tr class=titre_principal><td>"
              . "Informations sur la recette associée"
              . "</td></tr>"
              . "<tr><td>"
              . "<$html_table>"
              . "<tr><td>"
              . ${'NOM_'.$champ}
              .":</td><td>"
              . $$champ
              . "</td></tr>"
              ;

        //Identification
        $bloc.= "<tr><td>"
              . "N°Dossier de la Recette"
              .":</td><td>"
              . $site_recette
              . "-"
              . $CLE_RECETTE
              . "</td></tr>"
              ;
        //Environnement de conservation
        $nom_liste="etat_access_recettes_recette";
        $bloc .= "<tr><td>${'NOM_'.$nom_liste}:</td><td>";
        $nom_table = "annexe_environnement_conservation_groupe";
        $champ = "nom_annexe_environnement_conservation_groupe";
        $id_defaut=$$nom_liste;
        $bloc .= afficher_table_en_liste_deroulante($nom_table, $champ, $id_defaut, $nom_liste);
        $bloc.="</td></tr>";

        //Poids
        $champ="POIDS_TOTAL";
        $bloc.= "<tr><td>"
              . ${'NOM_'.$champ}
              .":</td><td>"
              . $$champ
              . " "
              . $Unité
              . "</td></tr>"
              ;

        //Liste des ingrédients
        if($recette_racine)
        {
            $champ="liste_ingredient_defaut";
            if ($$champ)
            {
               $value = nl2br($$champ);
               $color = "";
               }
               else
               {
               $value = "<i>Vide</i>";
               $color = " bgcolor=#FF0000 ";
            }
            $bloc.= "<tr><td>"
                  . ${'NOM_'.$champ}
                  .":</td><td $color>"
                  . $value
                  . "</td></tr>"
                  ;
        }

        //Fin des informations Recettes
        $bloc.= "</table>"
              . "</td></tr>"
              ;
}//Fin de la partie recette associée


        //Désignation
        $bloc.= "<tr class=titre_principal><td>"
              . "Informations sur les produits de la nomenclature"
              . "</td></tr>"
              . "<tr><td>"
              . "<$html_table>"
              ;

        //Site de production de la nomenclature
        $nom_liste="site_production_fta_nomenclature";
        $bloc .="<tr class=contenu><td width=\"20%\">"
              . mysql_field_desc("fta_composant", "$nom_liste")
              . "</td><td>"
              ;
        //echo $site_production_fta_nomenclature;

        $req_liste_site_assemblage = "SELECT id_geo, geo "
               . "FROM geo "
               . "WHERE assemblage = 1 "
               . "ORDER BY geo "
               ;
        if (!$site_production_fta_nomenclature)
        {
          //Récupération du site d'assemblage
          //ATTENTION !!!!! Gestion spécifique de la clef
          $req = "SELECT id_geo FROM geo WHERE id_site='".$Site_de_production."' ";
          $result=DatabaseOperation::query($req);
          $id_geo=mysql_result($result, 0, "id_geo");
          $id_defaut=$id_geo;
        }else
        {
           $id_defaut = $site_production_fta_nomenclature;
        }
        $bloc .= afficher_requete_en_liste_deroulante($req_liste_site_assemblage, $id_defaut, $nom_liste);
        $bloc.="</td></tr>";


        //Codification Agrologic
        $nom_liste="id_annexe_agrologic_article_codification";
        $bloc .= "<tr class=contenu><td>"
              . mysql_field_desc("annexe_agrologic_article_codification", "id_annexe_agrologic_article_codification")
              . "</td><td>"
              ;
/*         if($prefixe_annexe_agrologic_article_codification<>"02")
        { */
            $req_liste = "SELECT id_annexe_agrologic_article_codification"
                                       . ", CONCAT_WS(' - ', prefixe_annexe_agrologic_article_codification, nom_annexe_agrologic_article_codification) "
                                       . "FROM annexe_agrologic_article_codification "
                                       . "WHERE prefixe_annexe_agrologic_article_codification<>'00' "
                                       . "ORDER BY prefixe_annexe_agrologic_article_codification "
                                       ;
            $id_defaut=$$nom_liste;
            $bloc .= afficher_requete_en_liste_deroulante($req_liste, $id_defaut, $nom_liste);
/*         }else

        $bloc .= $prefixe_annexe_agrologic_article_codification." - ".$nom_annexe_agrologic_article_codification;
 */
        $bloc.="</td></tr>";

        //Désignation Nomenclature
        $champ="nom_fta_nomenclature";
        $bloc .= "<tr class=contenu><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
        $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=50/>";
        $bloc.="</td></tr>";

        //Raccourcis de classification
        $champ="suffixe_agrologic_fta_nomenclature";
        $bloc .= "<tr class=contenu><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
        if(!${$champ})
        {
            ${$champ}="Générique";
        }
        $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=10/>"
              . "<a href=../.data/grille_codification_article.sxc target=_blank>"
              . "<img src=../lib/images/bouton_aide_point_interrogation.gif width=25 height=26 border=0 /> </a>"
              ;
        $bloc.="</td></tr>";

        //Poids unitaire de la nomenclature
        $champ="poids_fta_nomenclature";
        $bloc .= "<tr class=contenu><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
        $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=50/>";
        $bloc.="</td></tr>";

        //Unité du Poids de la nomenclature
        $champ="id_annexe_unite";
        $nom_table="annexe_unite";
        $nom_liste=$champ;
        $id_defaut=$$champ;
        if(!$id_defaut){$id_defaut="g";}
        $bloc .= "<tr class=contenu><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
        $bloc .= afficher_table_en_liste_deroulante($nom_table, $champ, $id_defaut, $nom_liste);
        $bloc.="</td></tr>";

        //Environnement de conservation
        //Environnement de conservation
        $champ="etat_fta_nomenclature";
        $bloc .= "<tr class=contenu><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
        $nom_table = "annexe_environnement_conservation_groupe";
        $champ = "nom_annexe_environnement_conservation_groupe";
        if($etat_fta_nomenclature)
        {
          $id_defaut=$etat_fta_nomenclature;

          }
          else  //Environnement de conservation de l'article
          {
          $id_defaut=$K_etat;
        }
        $bloc .= afficher_table_en_liste_deroulante($nom_table, $champ, $id_defaut, "etat_fta_nomenclature");
        $bloc.="</td></tr>";

        //Quantité de pièce par Carton (cas des surgelé)
        //if($quantite_piece_par_carton) //Cas du Surgelé
        {
          $champ="quantite_piece_par_carton";
          $bloc .= "<tr class=contenu><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
          $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=50/>";
          $bloc.="</td></tr>";

          $champ="poids_total_carton_vrac_fta_nomenclature";
          $bloc .= "<tr class=contenu><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
          $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=50/>";
          $bloc.="</td></tr>";
        }


//echo $nom_fta_chapitre;
if($nom_fta_chapitre=="activation_produit")
{

        //Code Agrologic
        $champ="code_produit_agrologic_fta_nomenclature";
        $bloc.= "<tr class=titre_principal><td>"
              . ${'NOM_'.$champ}
              . "</td><td>"
              . "$prefixe_annexe_agrologic_article_codification + <input type=text name=".$champ." value=`".${$champ}."` size=3 maxlength=5/>"
              . "</td></tr>"
              ;


}//Fin de la partie Activation Informatique





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
             <form method=\"post\" action=\"$page_action\" name=\"action\">
             <input type=hidden name=action value=$action>
             <input type=hidden name=id_fta value=$id_fta>
             <input type=hidden name=id_fta_chapitre_encours value=$id_fta_chapitre_encours>
             <input type=hidden name=id_access_recette_recette value=$id_access_recette_recette>
             <input type=hidden name=id_fta_composant value=$id_fta_composant>
             <input type=hidden name=creation value=$creation>
             <input type=\"hidden\" name=\"synthese_action\" value=\"$synthese_action\" />

             <$html_table>
             <tr class=titre_principal><td>

                 Ajout d'une Nomenclature

             </td></tr>
             </table>
             <$html_table>
             <tr><td>

                 $lien_mode_selection

             </td></tr>

                 $bloc

             </td></tr>
             </table>
             <$html_table>
             <tr><td>

                 <center>
                 <input type=submit value='Enregistrer'>
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