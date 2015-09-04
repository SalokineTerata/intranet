<?php
/*
Module d'appartenance (valeur obligatoire)
Par défaut, le nom du module est le répetoire courant
*/
//   $module = substr(strrchr(`pwd`, '/'), 1);
//   $module=trim($module);

/*
Si la page peut être appelée depuis n'importe quel module,
décommentez la ligne suivante
*/

//   $module='';

/*********
Inclusions
*********/
//include ("../lib/session.php");         //Récupération des variables de sessions
////include ("../lib/functions.php");         //Timeout de déconnexion
//include ("../lib/debut_page.php");      //Affichage des éléments commun à l'Intranet
//
//if (isset($menu))                       //Si existant, utilisation du menu demandé
//   {include ("./$menu");}               //en variable
//else
//   {include ("./menu_principal.inc");}  //Sinon, menu par défaut

require_once '../inc/main.php';
print_page_begin($disable_full_page, $menu_file);
/*************
Début Code PHP
*************/

/*
    Initialisation des variables
*/
   $action = '';                       //Action proposée à la page action.php
   $method = 'method=post';             //Pour une url > 2000 caractères, utiliser POST
   $html_table = "table "              //Permet d'harmoniser les tableaux
               . "border=1 "
               . "width=100% "
               . "class=contenu "
               ;

/*
    Récupération des données MySQL
*/


/*
    Création des objets HTML (listes déroulante, cases à cocher ...etc.)
*/

// parcours de la table des liens pour affichage

   $req1 = "SELECT chemin_extranets_table_des_liens,nom_logo_extranets_table_des_liens,nom_site_extranets_table_des_liens FROM extranets_table_des_liens "
        . "WHERE actif_extranets_table_des_liens = 1 "
        . "ORDER BY code_regroupement_extranets_table_des_liens ASC "
        ;

$result=DatabaseOperation::convertSqlStatementWithoutKeyToArray($req1);

if($result)
{

    foreach  ($result as $rows)
    {

      $tableau .= "<tr><td>

                      <a href=$rows[chemin_extranets_table_des_liens]>
                         <img src=images/$rows[nom_logo_extranets_table_des_liens] border=0 width=90 height=30 />
                         $rows[nom_site_extranets_table_des_liens]
                      </a>

                   </td></tr>
                  ";
    }

}



/***********
Fin Code PHP
***********/


/**************
Début Code HTML
**************/
echo "
     <form $method action=action.php>
     <input type=hidden name=action value=$action>

     <$html_table>
     <tr class=titre_principal><td>

         Sommaire des liens EXTRANETS <br>

     </td></tr>
     $tableau
     </table>

     </form>
     ";

/************
Fin Code HTML
************/

/***********************
Inclusion de fin de page
***********************/
include ("../lib/fin_page.inc");
?>

