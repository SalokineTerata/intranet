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
//        //Inclusions
//        include ("../lib/session.php");         //Récupération des variables de sessions
//        include ("../lib/debut_page.php");      //Construction d'une nouvelle
//        if (isset($menu))                       //Si existant, utilisation du menu demandé
//        {                                       //en variable
//           include ("./$menu");
//        }
//        else
//        {
//           include ("./menu_principal.inc");    //Sinon, menu par défaut
//        }
      require_once '../inc/main.php';
      print_page_begin($disable_full_page, $menu_file);
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
   $action = 'ajout';                       //Action proposée à la page _post.php
   $method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
   $html_table = "table "              //Permet d'harmoniser les tableaux
               . "border=1 "
               . "width=100% "
               . "class=contenu "
               ;

/*
    Récupération des données MySQL
*/

     //Liste des types de modèle
     $bloc="<$html_table>";
     $message="?";
     $url="index.php";

     $req = "SELECT `annexe_emballage_groupe`.*, `annexe_emballage_groupe_type`.*, `annexe_emballage_groupe_type`.`id_annexe_emballage_groupe_type` "
          . "FROM `annexe_emballage_groupe_type`, `annexe_emballage_groupe` "
          . "WHERE ( `annexe_emballage_groupe_type`.`id_annexe_emballage_groupe_type` = `annexe_emballage_groupe`.`id_annexe_emballage_groupe_configuration` ) "
          . "ORDER BY `annexe_emballage_groupe_type`.`id_annexe_emballage_groupe_type` ASC "
          ;
     $result=DatabaseOperation::query($req);
     while($rows=mysql_fetch_array($result))
     {
         $bloc.= "<tr><td>".$rows["nom_annexe_emballage_groupe"]
                ."</td><td>"
                . $rows["nom_annexe_emballage_groupe_type"]
                ."</td><td>"
                ."<a href=liste_type_post.php?action=supprimer&id_annexe_emballage_groupe=".$rows["id_annexe_emballage_groupe"]
                . " />"
                . "<img src=\"../lib/images/supprimer.png\" width=\"24\" height=\"24\" border=\"0\" alt=\"\" />"
                . "</a>"
                ."</td></tr>"
                ;
     }
     $bloc.="</table>";

     //Ajout d'un nouveau type
     $ajout="";
     $ajout=mysql_field_desc("annexe_emballage_groupe", "nom_annexe_emballage_groupe")."<input type=text name=nom_annexe_emballage_groupe size=20 />";
     $req_liste_type = "SELECT id_annexe_emballage_groupe_type, nom_annexe_emballage_groupe_type "
                  . "FROM annexe_emballage_groupe_type "
                  . "ORDER BY ordre_emballage_groupe_type "
                  ;
     $ajout .= afficher_requete_en_liste_deroulante($req_liste_type, $id_defaut, "id_annexe_emballage_groupe_type");

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

                 Listes des types d'emballages

             </td></tr>
             <tr><td>

                  $bloc

             </td></tr>
             <tr><td align=\"center\">

                  $ajout
                 <input type=submit value='Ajouter'>
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