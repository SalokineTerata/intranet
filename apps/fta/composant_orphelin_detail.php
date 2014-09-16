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


/*
    Récupération des données MySQL
*/

//Traiteùment de mise à jour

   //Association
   if($id_fta_composition and $id_fta_nomenclature)
   {
     $req = "UPDATE fta_composition SET id_fta_nomenclature=$id_fta_nomenclature WHERE id_fta_composition=$id_fta_composition";
     DatabaseOperation::query($req);
   }

   //Désassociation
   if($delete_id_fta_composition)
   {
      $req = "UPDATE fta_composition SET id_fta_nomenclature=0 WHERE id_fta_composition=$delete_id_fta_composition";
      DatabaseOperation::query($req);
      $delete_id_fta_composition="";
   }

   //Initialisation des associations
   if($clean)
   {
      $req = "UPDATE fta_composition SET id_fta_nomenclature=0 WHERE id_fta=$id_fta";
      DatabaseOperation::query($req); 
   }

  //Lien de réinitialisation des associations des nomenclatures dans les composants
  $initialiser_asssociation = "<a href=$page_action?clean=1&id_fta=$id_fta>Initialiser les associations</a>";

  //Lien de retour
  $comeback = "<a href=http://intranet.agis.fr/fta/composant_orphelin.php>Retour</a>";


$id_fta;   //Fourni en URL
mysql_table_load('fta');
mysql_table_load('access_arti2');

  //Récupération des Composants Orphelins
  $HTML_composant="<$html_table>";
  $req = "SELECT * FROM fta_composition WHERE id_fta=$id_fta and id_fta_nomenclature=0";
  $result=DatabaseOperation::query($req);
  while($rows=mysql_fetch_array($result))
  {
      $HTML_composant.= "<tr>"
                      . "<td><input type=\"radio\" name=\"id_fta_composition\" value=\"".$rows["id_fta_composition"]."\" /></td>"
                      . "<td>".$rows["nom_fta_composition"]."</td>"
                      . "<td>".$rows["quantite_fta_composition"]." par colis</td>"
                      . "<td>".$rows["poids_fta_composition"]."g</td>"
                      . "</tr>"
                      ;
  }
  $HTML_composant.="</table>";
  
  //Récupération des Produits Orphelins
  //Attention, seuls les semi-fini (code en 02) sont concernés
  $HTML_produits="<$html_table>";
  $is_current=0;
  $req = "SELECT * FROM fta_nomenclature, annexe_agrologic_article_codification, access_arti2 "
       . "WHERE fta_nomenclature.id_fta=$id_fta "
       . "AND access_arti2.id_fta=fta_nomenclature.id_fta "
       . "AND ( "
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
       . "AND annexe_agrologic_article_codification.id_annexe_agrologic_article_codification=fta_nomenclature.id_annexe_agrologic_article_codification "
       ;
  $result=DatabaseOperation::query($req);
  while($rows=mysql_fetch_array($result))
  {
      //Recherche pour savoir si ce produit est bien orphelin
      $req = "SELECT * FROM fta_composition WHERE id_fta=$id_fta and id_fta_nomenclature=".$rows["id_fta_nomenclature"]." ";
      $result_orphelin=DatabaseOperation::query($req);

      //Si il n'est affecté à aucun composant, il est orphelin
      if(!mysql_num_rows($result_orphelin))
      {
          $is_current=1;
          $HTML_produits.= "<tr>"
                          . "<td><input type=\"radio\" name=\"id_fta_nomenclature\" value=\"".$rows["id_fta_nomenclature"]."\" /></td>"
                          . "<td>".$rows["prefixe_annexe_agrologic_article_codification"].$rows["code_produit_agrologic_fta_nomenclature"]."</td>"
                          . "<td>".$rows["nom_fta_nomenclature"]."</td>"
                          . "<td>".$rows["quantite_fta_composition"]." par colis</td>"
                          . "<td>".$rows["poids_fta_nomenclature"].$rows["id_annexe_unite"]."</td>"
                          . "</tr>"
                          ;
       }
  }
  $HTML_produits.="</table>";

  //Tableau des Composants associés
  $HTML_recap="<$html_table>";
  $req = "SELECT * "
       . "FROM `fta_nomenclature`, `fta_composition`, `annexe_agrologic_article_codification` "
       . "WHERE `fta_nomenclature`.`id_fta_nomenclature` = `fta_composition`.`id_fta_nomenclature` "
       . "AND `fta_nomenclature`.`id_annexe_agrologic_article_codification` = `annexe_agrologic_article_codification`.`id_annexe_agrologic_article_codification` "
       . "AND fta_nomenclature.id_fta=$id_fta "
       ;
  $result=DatabaseOperation::query($req);
  while($rows=mysql_fetch_array($result))
  {
    $HTML_recap.= "<tr>"
                    . "<td>".$rows["prefixe_annexe_agrologic_article_codification"].$rows["code_produit_agrologic_fta_nomenclature"]."</td>"
                    . "<td>".$rows["nom_fta_composition"]." <--> ".$rows["nom_fta_nomenclature"]."</td>"
                    . "<td><a href=".$page_default.".php?delete_id_fta_composition=".$rows["id_fta_composition"]."&id_fta=$id_fta>Annuler</a></td>"
                    . "</tr>"
                    ;
  }
  $HTML_recap.="</table>";

  //Bouton de validation
  if($is_current)
  {
      $bouton_label="Associer";
  }
  else
  {
      $bouton_label="Revenir sur le liste des Articles";
      $page_action="composant_orphelin.php";
  }


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
             <input type=\"hidden\" name=\"id_fta\" value=\"$id_fta\" />

             <$html_table>
             <tr class=titre_principal><td>

                 Correction des Composants Orphelins<br>
                 Cette page permet de rattacher un composant (<i>point de vue Qualité</i>) à son correspondant produit (<i>point de vue Gestion</i>)<br>
                 Seules les FTA Validées sont concernées: Avec un code Agrologic dans access_arti2 et actives)

             </td></tr>
             <tr><td>
                 $CODE_ARTICLE - $LIBELLE ($comeback)
             </td></tr>
             <tr><td>
                 <table>
                     <tr>
                         <td>
                         Composants Orphelins ($initialiser_asssociation):
                         </td>
                         <td>
                         Produits Orphelins:
                         </td>
                     </tr>
                     <tr>
                         <td>
                         $HTML_composant
                         </td>
                         <td>
                         $HTML_produits
                         </td>
                     </tr>
                 </table>
             </td></tr>
             <tr><td>

                 <center>
                 <input type=submit value='$bouton_label'>
                 </center>

             </td></tr>
             <tr><td>
                 Composants Associés
                 $HTML_recap
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