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
//include ("./functions.js");
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
     case 'valider':
          
          $id_classification_arborescence_article;  //From URL
          $id_fta;                                  //From URL

          //Enregistrement du chemin dans la classification de la fiche technique
          mysql_table_load("classification_arborescence_article");
          mysql_table_operation("classification_fta", "insert");

          //Mise à jour de la table access_arti2
          $id_fta;
          mysql_table_load("fta");
          $id_element="51"; //Environnement de conservation
          $extension[0]=1;
          $exist=recherche_element_classification_fta($id_fta, $id_element, $extension);

          //Identifiant id_classification_arborescence_article_categorie_contenu
          $id_classification_arborescence_article_categorie_contenu = $exist[1];

          //Récupération de l'identifiant id_annexe_environnement_conservation_groupe
          if($id_classification_arborescence_article_categorie_contenu)
          {
             $req = "SELECT id_annexe_environnement_conservation_groupe "
                  . "FROM annexe_environnement_conservation_groupe "
                  . "WHERE id_classification_arborescence_article_categorie_contenu='".$id_classification_arborescence_article_categorie_contenu."' "
                  ;
             $result=DatabaseOperation::query($req);
             if(mysql_num_rows($result))
             {
               $id_annexe_environnement_conservation_groupe=mysql_result($result, 0, "id_annexe_environnement_conservation_groupe");
               $K_etat=$id_annexe_environnement_conservation_groupe;
             }
             else
             {
                 $error=1;
             }
          }
          else
          {
              $error=1;
          }
          if($error)
          {
             $titre="Erreur dans la Classification";
             $message="Environnement de conservation introuvable.";
             afficher_message($titre, $message, $redirection);
          }
          else
          {
             mysql_table_operation("access_arti2", "update");
          }
          //Redirection
          header ("Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=1&synthese_action=$synthese_action");

     break;



/************
Fin de switch
************/
             
}
//include ("./action_bs.php");
//include ("./action_sm.php");

?>

