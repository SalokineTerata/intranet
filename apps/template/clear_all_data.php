<?php
/*
Module d'appartenance (valeur obligatoire)
Par défaut, le nom du module est le répertoire courant
*/
   $module = substr(strrchr(`pwd`, '/'), 1);

/*
Si la page peut être appelée depuis n'importe quel module,
décommentez la ligne suivante
*/

/*********
Inclusions
*********/
include ("../lib/session.php");         //Récupération des variables de sessions
//include ("../lib/functions.php");         //Timeout de déconnexion
include ("../lib/debut_page.php");      //Affichage des éléments commun à l'Intranet

if (isset($menu))                       //Si existant, utilisation du menu demandé
   {include ("./$menu");}               //en variable
else
   {include ("./menu_principal.inc");}  //Sinon, menu par défaut


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
   $NIV = 0;                           //Niveau du mot de passe necessaire pour exécuter ce script
   $password;                          //Mot de passe donné par l'utilisateur

/*
    Récupération des données MySQL
*/
       //Récupération de nom de table
       $liste_table=file('table_data.list');




       //Récupération de mot de passe de vérification
       $nom_table = 'intranet_password';
       $id_intranet_password = $NIV;
       mysql_table_load($nom_table);
       $real_password=$valeur_intranet_password;


       //Vérification du mot de passe
       if ($password==$real_password)
       {
           foreach ($liste_table as $value)
           {
              if ( substr($value,0,1)<>'#')
              {
                 DatabaseOperation::query("DELETE FROM $value");
              }
           }
           $message = "le module $module a été initialisé.<br>";

       }else{
           $message = "Mot de passe incorrect !<br>"
                    . "Syntaxe: nom_de_la_page.php?password=<i>votre_mot_de_passe</i><br>"
                    ;
       }

/*
    Création des objets HTML (listes déroulante, cases à cocher ...etc.)
*/


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

         ATTENTION CETTE PAGE VA PROVOQUER UNE PERTE DE DONNEES<br>
         Site concerné: $site<br>
         Module concerné: $module<br>

     </td></tr>
     <tr><td>

         $message

     </td></tr>
     <tr><td>

         <center>
         <input type=submit value='Ok'>
         </center>

     </td></tr>
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

