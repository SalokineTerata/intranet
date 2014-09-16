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
mysql_table_load('intranet_modules');

//Lister les actions possibles sur le module
$req = "SELECT * FROM intranet_actions "
     . "WHERE module_intranet_actions = '0' "
     . "OR module_intranet_actions = '".$id_intranet_modules."' "
     . "ORDER BY module_intranet_actions, nom_intranet_actions "
     ;
$result_action=DatabaseOperation::query($req);
$bloc="";
while ($rows_action=mysql_fetch_array($result_action))
{
      $bloc.= "<$html_table><tr class=titre_principal><td>"
            . $rows_action["description_intranet_actions"]
            . "</td></tr>"
            ;

      //Pour chaque niveaux, lister les utilisateur concernés
      $req = "SELECT DISTINCT * FROM intranet_droits_acces, salaries, intranet_modules , intranet_actions "
           . "WHERE ( `intranet_droits_acces`.`id_user` = `salaries`.`id_user` "                               //Liaison
           . "AND `intranet_droits_acces`.`id_intranet_modules` = `intranet_modules`.`id_intranet_modules` "   //liaison
           . "AND `intranet_droits_acces`.`id_intranet_actions` = `intranet_actions`.`id_intranet_actions` "   //liaison
           . "AND `intranet_actions`.`id_intranet_actions` = '".$rows_action["id_intranet_actions"]."' "
           . "AND `intranet_modules`.`id_intranet_modules` = '".$id_intranet_modules."' "
           . "AND `intranet_droits_acces`.`niveau_intranet_droits_acces` <> 0 "
           . ")"
           . "ORDER BY niveau_intranet_droits_acces, login "
           ;
      $result_user=DatabaseOperation::query($req);
      while ($rows_user=mysql_fetch_array($result_user))
      {
            $bloc .= "<tr><td>".$rows_user["login"]."</td>";

            if($rows_user["niveau_intranet_droits_acces"]<>1)
            {
                $bloc .= "<td>Niveau = ".$rows_user["niveau_intranet_droits_acces"]."</<td></tr>";
            }
      }

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

             <$html_table>
             <tr class=titre_principal><td>

                 Liste des utilisateurs ayants accès au module $nom_usuel_intranet_modules.

             </td></tr>
             <tr><td>

                 $bloc

             </td></tr>
             <tr><td>

                 <center>
                 <!input type=submit value='Enregistrer'>
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