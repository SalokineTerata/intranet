<?php
/*
Module d'appartenance (valeur obligatoire)
Par défaut, le nom du module est le répetoire courant
*/

//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);


//Inclusions
//include ("../lib/session.php");
//include ("../lib/functions.php");
//include ("./functions.php");
      require_once '../inc/main.php';




/*
-----------------
 ACTION A TRAITER
-----------------
-----------------------------------
 Détermination de l'action en cours
-----------------------------------

 Cette page est appelée pour effectuer un traitement particulier
 en fonction de la variable "$action". Ensuite elle redirige le
 résultat vers une autre page.

 Le plus souvent, le traitement est délocalisé sous forme de
 fonction située dans le fichier "functions.php"

*/
switch ($action)
{

 /*
 S'il n'y a pas d'actions défini
 */
     case '':

          //Redirection
          header ("Location: index.php");

     break;
     case 'valider': //Une palettisation à été selectionnée


          //Chargement des valeurs du modèle
          $id_fta_duree_vie;

          mysql_table_load("fta_duree_vie");

          //Mise à jour des valeurs
          $Durée_de_vie=$client_fta_duree_vie;
          $Durée_de_vie_technique=$technique_fta_duree_vie;

          //Mise à jour de la FTA
          $id_fta;
          mysql_table_load("fta");
          $id_access_arti2;
          mysql_table_operation("access_arti2","update");

          //Renvoi sur la page d'ajout avec cette nouvelle information de groupe d'emballage sélectionné
          header ("Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action");

     break;

     case 'suppression_modele_palettisation':

       //Variables passées en URL
       $id_fta;
       $id_fta_conditionnement;
       mysql_table_operation("fta_conditionnement", "delete");

     header ("Location: selection_palettisation.php?id_fta=$id_fta&id_fta_chapitre_encours=6");
     break;


/************
Fin de switch
************/

}
//include ("./action_bs.php");
//include ("./action_sm.php");

?>

