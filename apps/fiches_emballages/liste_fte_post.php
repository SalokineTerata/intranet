<?php
/*
Module d'appartenance (valeur obligatoire)
Par défaut, le nom du module est le répetoire courant
*/

//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);
//
//
////Inclusions
//include ("../lib/session.php");
//include ("../lib/functions.php");
////include ("../lib/functions.php");
////include ("../lib/functions.js");
//include ("./functions.php");
////include ("./functions.js");

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

     case "supprimer":

          //Cette FTE est-elle encore utilisée par d'autres FTA ?
          $req = "SELECT id_fta_conditionnement FROM fta_conditionnement "
               . "WHERE id_annexe_emballage=".$id_annexe_emballage." "
               ;
          $result=DatabaseOperation::query($req);
          if(mysql_num_rows($result))
          {
               //Averissement
               $titre = "Suppression d'une Fiche Technique Emballage";
               $message = "Vous ne pouvez pas supprimer cette Fiche Technique Emballage.<br><br>"
                        . "En effet, elle est encore utilisée dans certaines Fiches Techniques Articles.<br><br>"
                        ;
               afficher_message($titre, $message, $redirection);
          }else
          {
              $id_annexe_emballage;      //URL
              $selection_groupe;         //URL
              $selection_fournisseur;    //URL

              //Suppression de la FTE
              mysql_table_operation("annexe_emballage", "delete");

              //Redirection
              header ("Location: liste_fte.php?selection_groupe=$selection_groupe&selection_fournisseur=$selection_fournisseur");
          }
     break;


/************
Fin de switch
************/

}
//include ("./action_bs.php");
//include ("./action_sm.php");

?>

