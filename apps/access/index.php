<?
/*
Module d'appartenance (valeur obligatoire)
Par défaut, le nom du module est le répetoire courant
*/
   $module = substr(strrchr(`pwd`, '/'), 1);
   $module = trim($module);

/*
Si la page peut être appelée depuis n'importe quel module,
décommentez la ligne suivante
*/

//   $module='';

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

/*
    Récupération des données MySQL
*/


/*
    Création des objets HTML (listes déroulante, cases à cocher ...etc.)
*/

//Recherches des bases Access accessible par l'utilisateur

   $req1 = "SELECT * FROM intranet_actions, intranet_droits_acces "
        . "WHERE intranet_actions.id_intranet_actions=intranet_droits_acces.id_intranet_actions "
        . "AND intranet_actions.module_intranet_actions=intranet_droits_acces.id_intranet_modules "
        . "AND intranet_droits_acces.id_intranet_modules=13 "
        . "AND intranet_droits_acces.niveau_intranet_droits_acces>=1 "
        . "AND intranet_droits_acces.id_user=$id_user "
        . "ORDER BY nom_intranet_actions ASC "
        ;

$result=mysql_query($req1);

if($result){


    if ($site_dev){

       $extension="mdb";

    }
    else{

       $extension="agismde";

    }
    $extension_local=$extension;
      


    while ($rows=mysql_fetch_array($result))
    {
      //Chemin
      if ($rows[chemin_acces_intranet_actions]){

         $chemin=$rows[chemin_acces_intranet_actions];
         //Retour au mdb, meme en exploitation !!!
         //$extension_local="mdb";

      }
      else{

         $chemin="base_".$rows[nom_intranet_actions];

      }

      //Fichier
      if ($rows[file_acces_intranet_actions]){

         $file=$rows[file_acces_intranet_actions];
      }
      else{
         $file=$rows[nom_intranet_actions].".".$extension_local;

      }


      $tableau .= "<tr><td>

                      <a href=".$chemin."/".$file.">
                         <img src=base_$rows[nom_intranet_actions]/bouton.png border=0 width=34 height=34 />
                         $rows[description_intranet_actions]
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

         Sommaire des applications Access disponibles <br>

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

