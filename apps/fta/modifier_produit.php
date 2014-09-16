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


$bloc=""; //Bloc de saisie


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
        $id_geo=$$nom_liste;
        mysql_table_load("geo");
        $bloc .= $geo;
        $bloc.="</td></tr>";

        //Environnement de conservation
        $champ="etat_fta_nomenclature";
        $bloc .= "<tr class=contenu><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
        $id_annexe_environnement_conservation_groupe=$etat_fta_nomenclature;
        mysql_table_load("annexe_environnement_conservation_groupe");
        $bloc .= $nom_annexe_environnement_conservation_groupe;
        $bloc.="</td></tr>";

        //Codification Agrologic
        $bloc .= "<tr class=contenu><td>"
              . mysql_field_desc("annexe_agrologic_article_codification", "id_annexe_agrologic_article_codification")
              . "</td><td>"
              ;
        $id_annexe_agrologic_article_codification;
        mysql_table_load("annexe_agrologic_article_codification");
        $bloc .= $nom_annexe_agrologic_article_codification;
        $bloc.="</td></tr>";

        //Poids unitaire de la nomenclature
        $champ="poids_fta_nomenclature";
        $bloc .= "<tr class=contenu><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
        $bloc .= $poids_fta_nomenclature." ".$id_annexe_unite ;
        $bloc.="</td></tr>";

        //Quantité de pièce par Carton (cas des surgelé)
        if($quantite_piece_par_carton) //Cas du Surgelé
        {
          $champ="quantite_piece_par_carton";
          $bloc .= "<tr class=contenu><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
          $bloc .= ${$champ};
          $bloc.="</td></tr>";

          $champ="poids_total_carton_vrac_fta_nomenclature";
          $bloc .= "<tr class=contenu><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
          $bloc .= ${$champ};
          $bloc.="</td></tr>";
        }

/*
   Informations pouvant être modifié par le processus Gestion des produits
*/

        //Désignation Nomenclature
        $champ="nom_fta_nomenclature";
        $bloc .= "<tr class=contenu><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
        $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=50/>";
        $bloc.="</td></tr>";

        //Raccourcis de classification
        $champ="suffixe_agrologic_fta_nomenclature";
        $bloc .= "<tr class=contenu><td>".mysql_field_desc("fta_composant", $champ)."</td><td>";
        $bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=10/>"
              . "<a href=../.data/grille_codification_article.sxc target=_blank>"
              . "<img src=../lib/images/bouton_aide_point_interrogation.gif width=25 height=26 border=0 /> </a>"
              ;
        $bloc.="</td></tr>";


        //Code Agrologic
        $champ="code_produit_agrologic_fta_nomenclature";
        $bloc.= "<tr class=contenu><td>"
              . ${'NOM_'.$champ}
              . "</td><td>"
              . "<font size=\"3\"><b>$prefixe_annexe_agrologic_article_codification + </font></b><input type=text name=".$champ." value=`".${$champ}."` size=3 maxlength=5/>"
              . "</td></tr>"
              ;








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
             <input type=hidden name=id_fta_composant value=$id_fta_composant>
             <input type=hidden name=creation value=$creation>
             <input type=\"hidden\" name=\"synthese_action\" value=\"$synthese_action\" />

             <$html_table>
             <tr class=titre_principal><td>

                 Modification d'un Produit

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