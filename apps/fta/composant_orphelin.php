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
   //$page_action=$page_default."_post.php";
   $page_action=$page_default.".php";
   $page_pdf=$page_default."_pdf.php";
   $action = 'valider';                       //Action proposée à la page _post.php
   $method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
   $html_table = "table "              //Permet d'harmoniser les tableaux
               . "border=1 "
               . "width=100% "
               . "class=contenu "
               ;
   $HTML_summary="";            //Récap des FTA ayant des composants orphelins

/*
    Récupération des données MySQL
*/
//Exemple: mysql_table_load('nom_de_ma_table');

  //Parcours des FTA ayant des produits devant être associés
  /* $req = "SELECT `access_arti2`.`CODE_ARTICLE` "
       . ", `access_arti2`.`LIBELLE` "
       . ", `access_arti2`.`actif` "
       . ", `access_arti2`.`id_fta` "
       . ", COUNT( `fta_composition`.`id_fta_nomenclature` ) AS `nb_composant` "
       . ", `fta_composition`.`id_fta_nomenclature` "
       . "FROM `fta_composition`, `access_arti2`, `fta` "
       . "WHERE ( `fta_composition`.`id_fta` = `access_arti2`.`id_fta` "
       . "AND `fta`.`id_fta` = `access_arti2`.`id_fta` "
       . "AND `fta`.`id_access_arti2` = `access_arti2`.`id_access_arti2` ) "
       . "GROUP BY `access_arti2`.`CODE_ARTICLE` "
       . ", `access_arti2`.`LIBELLE` "
       . ", `access_arti2`.`actif` "
       . ", `fta_composition`.`id_fta_nomenclature` "
       . ", `access_arti2`.`id_fta` "
       . "HAVING ( `access_arti2`.`CODE_ARTICLE` IS NOT NULL "
       . "AND `access_arti2`.`actif` = - 1 "
       . "AND `fta_composition`.`id_fta_nomenclature` = 0 )"
       ; */

//Etat en cours de parcours
if(!$id_fta_etat)
{
  $id_fta_etat=3;    //FTA Validée
}
$nom_liste="id_fta_etat";
$req_etat = "SELECT id_fta_etat, nom_fta_etat "
       . "FROM fta_etat "
       . "ORDER BY nom_fta_etat "
       ;
$id_defaut=$id_fta_etat;
$liste_etat = afficher_requete_en_liste_deroulante($req_etat , $id_defaut, $nom_liste);


  //Parcours des Articles Validés ayant une composition
/*  $req_valide = "SELECT DISTINCT `access_arti2`.`CODE_ARTICLE` "
       . ", `access_arti2`.`LIBELLE` "
       . ", `access_arti2`.`actif` "
       . ", `access_arti2`.`id_fta` "
       . "FROM `fta_nomenclature`, `access_arti2`, fta_composition "
       . "WHERE `fta_nomenclature`.`id_fta` = `access_arti2`.`id_fta` "
       //. "AND `fta`.`id_fta` = `access_arti2`.`id_fta` "
       //. "AND `fta`.`id_access_arti2` = `access_arti2`.`id_access_arti2` ) "
       . "AND fta_composition.id_fta=access_arti2.id_fta "
       . "GROUP BY `access_arti2`.`CODE_ARTICLE` "
       . ", `access_arti2`.`LIBELLE` "
       . ", `access_arti2`.`actif` "
       //. ", `fta_nomenclature`.`id_fta_nomenclature` "
       . ", `access_arti2`.`id_fta` "
       . "HAVING ( `access_arti2`.`CODE_ARTICLE` IS NOT NULL "
       . "AND `access_arti2`.`actif` = - 1 )"
       //. "AND `fta_composition`.`id_fta_nomenclature` = 0 )"
       ;
*/

  //Parcours des FTA en cours de composition
  $req = "SELECT DISTINCT `access_arti2`.`CODE_ARTICLE` "
       . ", `access_arti2`.`LIBELLE` "
       . ", `access_arti2`.`actif` "
       . ", `access_arti2`.`id_fta` "
       . ", `fta`.`id_fta_etat` "
       . "FROM `fta_nomenclature`, `access_arti2`, fta_composition, fta "
       . "WHERE `fta_nomenclature`.`id_fta` = `access_arti2`.`id_fta` "
       . "AND `fta`.`id_fta` = `access_arti2`.`id_fta` "
       //. "AND `fta`.`id_access_arti2` = `access_arti2`.`id_access_arti2` ) "
       . "AND fta_composition.id_fta=access_arti2.id_fta "
       . "GROUP BY `access_arti2`.`CODE_ARTICLE` "
       . ", `access_arti2`.`LIBELLE` "
       . ", `access_arti2`.`actif` "
       . ", `fta`.`id_fta_etat` "
       //. ", `fta_nomenclature`.`id_fta_nomenclature` "
       . ", `access_arti2`.`id_fta` "
       . "HAVING ( `fta`.`id_fta_etat`=".$id_fta_etat." )"
       //. "HAVING ( `access_arti2`.`CODE_ARTICLE` IS NOT NULL "
       //. "AND `access_arti2`.`actif` = - 1 )"
       //. "AND `fta_composition`.`id_fta_nomenclature` = 0 )"
       ;

  $result=DatabaseOperation::query($req);
  $num = mysql_num_rows($result);
  $total=0;
  if($num)
  {
      while($rows=mysql_fetch_array($result))
      {

            //Recherche des produits qui doivent être associés à un composant
            $req = "SELECT id_fta_nomenclature, fta_nomenclature.id_fta "
                 . "FROM fta_nomenclature, annexe_agrologic_article_codification, access_arti2 "
                 . "WHERE fta_nomenclature.id_fta='".$rows["id_fta"]."' "
                 . "AND access_arti2.id_fta=fta_nomenclature.id_fta "
                 . "AND annexe_agrologic_article_codification.id_annexe_agrologic_article_codification=fta_nomenclature.id_annexe_agrologic_article_codification "
                 . "AND ("
                 .      "( Site_de_production<>'3' "
                 .      "AND "
                 .         "( "
                 .         "(prefixe_annexe_agrologic_article_codification='02' AND site_production_fta_nomenclature<>'3' )"
//                 .         "OR "
//                 .         "(prefixe_annexe_agrologic_article_codification='01' AND site_production_fta_nomenclature='3' )"
                 .         ") "
                 .      ") "
                 .      " OR "
                 .      "( Site_de_production='3' "
                 .      "AND "
                 .         "( "
//                 .         "(prefixe_annexe_agrologic_article_codification='02' AND site_production_fta_nomenclature<>'3' )"
//                 .         "OR "
                 .         "(prefixe_annexe_agrologic_article_codification='01' AND site_production_fta_nomenclature='3' )"
                 .         ") "
                 .      ") "
                 .     ") "
                 ;
            $result1=DatabaseOperation::query($req);
            $nb=0;    //Mise à zéro du compteur des produits orphelins de cette FTA
            while($rows_nomenclature=mysql_fetch_array($result1))
            {
                //Recherche d'un composant associé à ce produit pour cette FTA
                $req = "SELECT id_fta_composition "
                     . "FROM fta_composition "
                     . "WHERE fta_composition.id_fta='".$rows_nomenclature["id_fta"]."' "
                     . "AND fta_composition.id_fta_nomenclature='".$rows_nomenclature["id_fta_nomenclature"]."' "
                     ;

                //Si il n'y en a pas, le produit est orphelin
                if(!mysql_num_rows(DatabaseOperation::query($req)))
                {
                    $nb++;
                }
            }

          //Si il y a au moins 1 produit orphelin
          if($nb)
          {
            $total++;
            $HTML_summary.= "<a href=composant_orphelin_detail.php?id_fta=".$rows["id_fta"].">"
                          . $rows["CODE_ARTICLE"]." - ".$rows["LIBELLE"]."</a><br>"
                          . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                          . "Nombre de produit orphelin: ".$nb
                          . "<br><br>"
                          ;

          }//Fin de l'affichage de la FTA
      }//Fin de parcours des FTA
  }//Fin du controle de l'existance de FTA

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

                 Correction des Produits Orphelins<br>
                 Cette page permet de rattacher un composant (<i>point de vue Qualité</i>) à son correspondant produit (<i>point de vue Gestion</i>)<br>
                 Seules les FTA en état $liste_etat sont concernées. <input type=submit value='Mettre à jour'><br>
                 <br>
                 Il y a actuellement <b>$total FTA à traiter</b>
             </td></tr>
             <tr><td>

                 $HTML_summary

             </td></tr>
             <tr><td>

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