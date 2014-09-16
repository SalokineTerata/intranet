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
//   $page_action=$page_default."_post.php";
   $page_action="derogation_duree_vie_post.php";
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

//Récupération des Informations Articles
//$CODE_ARTICLE=$id_article_agrologic_fta_derogation_duree_vie;
//$req = "SELECT id_access_arti2 FROM access_arti2 WHERE CODE_ARTICLE=$CODE_ARTICLE";
//$result=DatabaseOperation::query($req);
//$id_access_arti2=mysql_result($result, 0, "id_access_arti2");
//echo $id_access_arti2;
mysql_table_load("access_arti2");

switch ($type_derogation)
{
  case 1:

       $title="Réduction de la Durée de Vie Production";
       
  break;
  case 2:
       $title="Augmentation de la Durée de Vie Production";
  break;
}

//Récupération des Informations Produits
/* $req = "SELECT * FROM fta_composition, fta_nomenclature, annexe_agrologic_article_codification "
     . "WHERE fta_composition.id_fta=$id_fta "
     . "AND fta_composition.id_fta_nomenclature=fta_nomenclature.id_fta_nomenclature "
     . "AND fta_nomenclature.id_annexe_agrologic_article_codification=annexe_agrologic_article_codification.id_annexe_agrologic_article_codification "
     ;
 */
  $req = "SELECT * FROM fta_composant, annexe_agrologic_article_codification "
     . "WHERE fta_composant.id_fta=$id_fta "
     . "AND fta_composant.id_annexe_agrologic_article_codification=annexe_agrologic_article_codification.id_annexe_agrologic_article_codification "
  ;
  $result_produit = DatabaseOperation::query($req);

//Création de la liste de sélection des produits
//$liste_produit="<select name=id_fta_composition size=5>";
$liste_produit="<select name=id_fta_composant size=5>";
while($rows_produit=mysql_fetch_array($result_produit))
{

//   $liste_produit.= "<OPTION value=".$rows_produit["id_fta_composition"].">"
   $liste_produit.= "<OPTION value=".$rows_produit["id_fta_composant"].">"
                  . $rows_produit["prefixe_annexe_agrologic_article_codification"].$rows_produit["code_produit_agrologic_fta_nomenclature"]
                  . " - ".$rows_produit["nom_fta_nomenclature"]
                  . " (".$rows_produit["duree_vie_technique_fta_composition"]." jours)"
                  . "</OPTION>"
                  ;
}
$liste_produit.="</select>";
$bloc = "<$html_table><tr class=titre_principal><td>"
      . $title
      . "<br>Informations Article"
      . "</td></tr>"
      . "<tr><td>"
        . "<$html_table>"
        . "<tr><td>"
          . mysql_field_desc("access_arti2", "LIBELLE").": "
          . $LIBELLE."<br>"
          . mysql_field_desc("access_arti2", "Durée_de_vie_technique").": "
          . $Durée_de_vie_technique."<br>"
        . "</td></tr>"
        . "</table>"
      . "</td></tr>"
      . "</table>"
      .  "<$html_table><tr class=titre_principal><td>"
      . "Sélection du Produits"
      . "</td></tr>"
      . "<tr><td>"
        . "<$html_table><tr><td align=\"center\">"
        . $liste_produit
        . "</td></tr>"
        . "<tr><td>"
          . "<$html_table>"
          . "<tr><td width=\"50%\" align=\"right\">"
            . "Forcer la ". mysql_field_desc("fta_derogation_duree_vie", "duree_vie_production_fta_derogation_duree_vie")." à : "
            . "</td><td>"
            . "<input type=\"text\" name=\"duree_vie_production_fta_derogation_duree_vie\" size=\"5\""
          . "</td></tr>"
          . "<tr><td width=\"50%\" align=\"right\">"
            . mysql_field_desc("fta_derogation_duree_vie", "lot_fta_derogation_duree_vie")." : "
            . "</td><td>"
            . "<input type=\"text\" name=\"lot_fta_derogation_duree_vie\" size=\"10\" />"
          . "</td></tr>"
          . "<tr><td width=\"50%\" align=\"right\">"
            . mysql_field_desc("fta_derogation_duree_vie", "commentaire_fta_derogation_duree_vie")." : "
            . "</td><td>"
            . "<input type=\"text\" name=\"commentaire_fta_derogation_duree_vie\" size=\"50\" />"
          . "</td></tr>"
          . "</table>"
        . "</td></tr>"
        . "</td></tr></table>"
      . "</td></tr>"
      . "</table>"
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

        echo "
             <form method=$method action=$page_action>
             <input type=hidden name=action value=$action>
             <input type=hidden name=date_fta_derogation_duree_vie value=$date_fta_derogation_duree_vie>
             <input type=hidden name=createur_fta_derogation_duree_vie value=$createur_fta_derogation_duree_vie>
             <input type=hidden name=CODE_ARTICLE value=$CODE_ARTICLE>
             <input type=hidden name=id_access_arti2 value=$id_access_arti2>
             <input type=hidden name=type_derogation value=$type_derogation>

                 $bloc

                 <center>
                 <input type=submit value='Suivant >>'>
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