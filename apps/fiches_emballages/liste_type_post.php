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

     case "ajout":

          $nom_annexe_emballage_groupe;        //Fourni en URL
          $id_annexe_emballage_groupe_type;    //Fourni en URL
          mysql_table_operation("annexe_emballage_groupe", "insert");
          header ("Location: liste_type.php");
     break;

     case "supprimer":

          $id_annexe_emballage_groupe;        //Fourni en URL

          //Avant de supprimer, vérification qu'il n'y ait plus de FTE utilisant ce groupe
          $req = "SELECT * FROM annexe_emballage WHERE id_annexe_emballage_groupe=$id_annexe_emballage_groupe";
          $result=DatabaseOperation::query($req);
          if(mysql_num_rows($result))
          {
               //Ce groupe est encore utilisé et ne peut donc pas être supprimé.
               //Liste des modèles concernés
               $liste="";
               while($rows=mysql_fetch_array($result))
               {
                    $liste.= $rows["reference_fournisseur_annexe_emballage"]."<br>";
               }

               //Averissement
               $titre = "Suppression d'un groupe de modèle";
               $message = "Vous ne pouvez pas supprimer ce groupe de modèle d'emballage.<br>"
                        . "En effet, il est encore utilisé dans certaines Fiches Techniques Emballages.<br><br>"
                        . "<b><u><i>Liste des modèles:</b></u></i><br>"
                        . $liste
                        ;
               afficher_message($titre, $message, $redirection);

         }
         else
         {
               //Supprimer le groupe
               mysql_table_operation("annexe_emballage_groupe", "delete");
               header ("Location: liste_type.php");
         }

     break;

/************
Fin de switch
************/

}
//include ("./action_bs.php");
//include ("./action_sm.php");

?>

