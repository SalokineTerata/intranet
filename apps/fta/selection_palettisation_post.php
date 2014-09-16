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
     case 'etape1': //Une palettisation à été selectionnée

          $id_selection;                           //Modèle de palettisation sélectionnée et à utiliser
          $id_fta_sauvegarde=$id_fta;              //Sauvegarde de l'id_fta car il va être supprimé
          $id_fta_conditionnement=$id_selection;   //Préparation pour chargement des valeurs

          //Chargement des valeurs du modèle
          mysql_table_load("fta_conditionnement");

          $id_fta=$id_fta_sauvegarde;              //Affectation de l'id_fta
          $id_fta_conditionnement="";              //Suppression de l'id_fta_conditionnement pour création d'un nouvel enregistrement

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

          //Enregsitrement de la palettisation pour la FTA en cours
          mysql_table_operation("fta_conditionnement", "insert");

          //Renvoi sur la page d'ajout avec cette nouvelle information de groupe d'emballage sélectionné
          header ("Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours");

     break;

     case 'suppression_modele_palettisation':

       //Variables passées en URL
       $id_fta;
       $id_fta_conditionnement;
       mysql_table_operation("fta_conditionnement", "delete");

     header ("Location: selection_palettisation.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours");
     break;


/************
Fin de switch
************/

}
//include ("./action_bs.php");
//include ("./action_sm.php");

?>

