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
   $action="valider";
   $method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
   $html_table = "table "              //Permet d'harmoniser les tableaux
               . "border=1 "
               . "width=100% "
               . "class=contenu "
               ;

/*
    Récupération des données MySQL
*/

$bloc=""; //Bloc de saisie


    //Tableau récapitulatif des Durées de vie validées
    $recap_duree = "<tr><td>
                        <$html_table>
                        <tr class=titre>
                            <td>

                            </td>
                            <td>
                            ".mysql_field_desc("fta_duree_vie", "designation_fta_duree_vie")."
                            </td>
                            <td>
                            ".mysql_field_desc("fta_duree_vie", "client_fta_duree_vie")."
                            </td>
                            <td>
                            ".mysql_field_desc("fta_duree_vie", "technique_fta_duree_vie")."
                            </td>
                        ";
         $recap_duree.="</tr>";

         //Récupération des Durée de vie déjà saisies
         $req = "SELECT id_fta_duree_vie "
              . "FROM fta_duree_vie "
              . "ORDER BY client_fta_duree_vie, technique_fta_duree_vie, designation_fta_duree_vie "
              ;
         $result=DatabaseOperation::query($req);
         while($rows=mysql_fetch_array($result))
         {
             $id_fta_duree_vie=$rows["id_fta_duree_vie"];
             mysql_table_load("fta_duree_vie");

             //Case à cocher pour sélection
             $champ="id_fta_duree_vie";
             $recap_duree .="<tr align=right bgcolor=$bgcolor><td>"
                          . "<input type=radio name=$champ value=$id_fta_duree_vie />"
                          . "</td>"
                          ;

             //Commentaire
             $champ="designation_fta_duree_vie";
             $recap_duree .= "<td align=left>". html_view_txt(${$champ})."</td>";

             //Durée de Vie Garantie au Client
             $champ="client_fta_duree_vie";
             $recap_duree .= "<td>${$champ}</td>";

             //Durée de Vie Garantie Technique
             $champ="technique_fta_duree_vie";
             $recap_duree .= "<td>${$champ}</td>";


         }
         $recap_duree.="</tr></table>";
         $bloc.= $recap_duree;



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
             <input type=hidden name=id_fta_conditionnement value=$id_fta_conditionnement>
             <input type=hidden name=id_fta_chapitre_encours value=$id_fta_chapitre_encours>
             <input type=\"hidden\" name=\"synthese_action\" value=\"$synthese_action\" />

             <$html_table>
             <tr class=titre_principal><td>

                 Sélection d'une durée de vie client

             </td></tr>
             </table>
             <$html_table>

                 $bloc

             </table>
             <$html_table>
             <tr><td>

                 <center>
                 <input type=submit value='Sélectionner cette Durée de Vie'>
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