<?php
/*
Module d'appartenance (valeur obligatoire)
Par défaut, le nom du module est le répetoire courant
*/

//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);
//
////Inclusions
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
     case 'etape1': //Un groupe d'emballage a été sélectionné

          //Renvoi sur la page d'ajout avec cette nouvelle information de groupe d'emballage sélectionné
          header ("Location: ajout_palettisation.php?id_fta=$id_fta&id_annexe_emballage_groupe=$id_annexe_emballage_groupe&action=etape1&id_fta_chapitre_encours=$id_fta_chapitre_encours");
     break;
     case 'etape2': //Un emballage a été sélectionné

          //Enregistrement du nouveau modèle de palettisation
          $id_fta_conditionnement;
          $id_annexe_emballage;              //Identifiant de l'emballage
          $id_fta_sauvegarde=$id_fta;        //Sauvegarde de l'id_fta en cours
          $id_fta=0;                         //Suppression de l'id_fta pour faire de ce conditionnement un modèle pour les FTA
          $nombre_couche_fta_conditionnement;
          $quantite_par_couche_fta_conditionnement;
          mysql_table_operation("fta_conditionnement", "insert");

          //Resturation des valeurs
          $id_fta=$id_fta_sauvegarde;        //Restauration de l'id_fta en cours


          //Renvoi sur la page d'ajout avec cette nouvelle information de groupe d'emballage sélectionné
          header ("Location: ajout_palettisation.php?id_fta=$id_fta&id_fta_conditionnement=$id_fta_conditionnement&action=etape2&id_fta_chapitre_encours=$id_fta_chapitre_encours");
     break;
     case 'etape3': //Les informations sont toutes saisie

          //Enregistrement du modèle
          $id_fta_conditionnement;
          $id_annexe_emballage;              //Identifiant de l'emballage
          $id_fta_sauvegarde=$id_fta;        //Sauvegarde de l'id_fta en cours
          $id_fta=0;                         //Suppression de l'id_fta pour faire de ce conditionnement un modèle pour les FTA
          $hauteur_emballage_fta_conditionnement; //L'informations peut-être modifier
          mysql_table_operation("fta_conditionnement", "update");
          mysql_table_load("fta_conditionnement");

          //Resturation des valeurs
          $id_fta=$id_fta_sauvegarde;        //Restauration de l'id_fta en cours
          $id_fta_conditionnement="";        //Suppression de l'id

          //Suppression de la palettisation précédement sélectionnée
          $req = "SELECT id_fta_conditionnement "
              . "FROM fta_conditionnement, annexe_emballage_groupe, annexe_emballage "
              . "WHERE fta_annexe_emballage_groupe=3 "
              . "AND id_fta=$id_fta "
              . "AND fta_conditionnement.id_annexe_emballage=annexe_emballage.id_annexe_emballage "
              . "AND annexe_emballage.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
              . "ORDER BY reference_fournisseur_annexe_emballage "
              ;
         $result=DatabaseOperation::query($req);
         while($rows=mysql_fetch_array($result))
         {
             $id_fta_conditionnement=$rows["id_fta_conditionnement"];
             mysql_table_operation("fta_conditionnement", "delete");
         }

          //Affectation de ce modèle à la FTA en cours
          $id_fta_conditionnement="";        //Suppression de l'id
          mysql_table_operation("fta_conditionnement", "insert");

          //Renvoi sur la page d'ajout avec cette nouvelle information de groupe d'emballage sélectionné
          header ("Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours");
     break;


/************
Fin de switch
************/

}
//include ("./action_bs.php");
//include ("./action_sm.php");

?>

