<?php
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

     case 'valider':
          //Enregistrement du nouvel éléments de classification
          $ascendant_classification_arborescence_article_categorie_contenu=$id_classification_arborescence_article;
          $id_classification_arborescence_article_categorie_contenu;
          $id_classification_arborescence_article="";

          mysql_table_operation("classification_arborescence_article", "insert");

     //Redirection
     header ("Location: index.php?liste_id=$liste_id");

     break;

     case 'modifier':
//        echo $FAMILLE_ARTICLE;
//          echo $FAMILLE_MKTG;
          mysql_table_operation("classification_arborescence_article", "update");

     //Redirection
     header ("Location: index.php?liste_id=$liste_id");

     break;


/************
Fin de switch
************/

}
//include ("./action_bs.php");
//include ("./action_sm.php");

?>

