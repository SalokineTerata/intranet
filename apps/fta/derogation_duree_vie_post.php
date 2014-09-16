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
     case '':

     //Redirection
     header ("Location: index.php");

     break;

     case "etape1":

          /* echo $date_fta_derogation_duree_vie."<br>";
          echo $createur_fta_derogation_duree_vie."<br>";
          echo $id_agrologic_fta_derogation_duree_vie."<br>";
          echo $lot_fta_derogation_duree_vie."<br>";
          echo $duree_vie_production_fta_derogation_duree_vie."<br>";
          echo $utilise_fta_derogation_duree_vie."<br>";
 */       //$lot_fta_derogation_duree_vie= strtoupper($lot_fta_derogation_duree_vie);
          //mysql_table_operation("fta_derogation_duree_vie", "insert");
          //header ("Location: derogation_duree_vie.php");

          /* $nom_annexe_emballage_groupe;        //Fourni en URL
          $id_annexe_emballage_groupe_type;    //Fourni en URL
          mysql_table_operation("annexe_emballage_groupe", "insert");
          header ("Location: liste_type.php"); */
          //echo "TEST";
          header ("Location: derogation_duree_vie_produit.php?id_article_agrologic_fta_derogation_duree_vie=$id_article_agrologic_fta_derogation_duree_vie");
     break;

     case "valider":

          //Dérogation au niveau Composition
/*
          echo $date_fta_derogation_duree_vie."<br>";
          echo $createur_fta_derogation_duree_vie."<br>";
          echo $CODE_ARTICLE."<br>";
          echo $lot_fta_derogation_duree_vie."<br>";
          echo $duree_vie_production_fta_derogation_duree_vie."<br>";
          echo $utilise_fta_derogation_duree_vie."<br>";
*/
          $redirection="derogation_duree_vie.php";
          //Préparation des données
          //if(!$id_fta_composition)
          if(!$id_fta_composant)
          {
              /*
              $titre="Information manquante";
              $message="Vous avez oublié de sélectionner un produit.";
              $redirection="derogation_duree_vie.php";
              afficher_message($titre, $message, $redirection);
              break;
              */
          }
          else
          {
              $id_access_arti2;
              //$id_fta_composition;
              $id_fta_composant;
              //mysql_table_load("fta_composition");
              mysql_table_load("fta_composant");

              switch ($type_derogation)
              {

              case 1: //Cas d'une diminution de la DVT
                  if ($duree_vie_production_fta_derogation_duree_vie<$duree_vie_technique_fta_composition)
                  {
                    $lot_fta_derogation_duree_vie=strtoupper($lot_fta_derogation_duree_vie);
                    $type_fta_derogation_duree_vie=1;
                    mysql_table_operation("fta_derogation_duree_vie", "insert");
                  }
                  else
                  {
                      $titre="Ce que vous demandez et contradictoire";
                      $message ="Vous avez demandé une dérogation pour diminution la durée de vie de votre composant.<br>"
                               ."Pourtant vous venez de saisir une durée de vie supérieure.";
                      afficher_message($titre, $message, $redirection);
                      $error=1;
                  }
              break;

              case 2: //Cas d'une augmentation de la DVT
                      //(à optimiser car normalement, il faudrait déclencher automatiquement des dérogations
                      //pour les autres composants de DVT inférieure)
                  //echo "$duree_vie_production_fta_derogation_duree_vie, $duree_vie_technique_fta_composition";
                  if ($duree_vie_production_fta_derogation_duree_vie>$duree_vie_technique_fta_composition)
                  {
                    $lot_fta_derogation_duree_vie=strtoupper($lot_fta_derogation_duree_vie);
                    $type_fta_derogation_duree_vie=1;
                    mysql_table_operation("fta_derogation_duree_vie", "insert");
                  }
                  else
                  {
                      $titre="Ce que vous demandez et contradictoire";
                      $message ="Vous avez demandé une dérogation pour augmenter la durée de vie de votre composant.<br>"
                               ."Pourtant vous venez de saisir une durée de vie inférieure.";
                      afficher_message($titre, $message, $redirection);
                      $error=1;
                  }
                   
              break;

              }

          }
          //Dérogation au niveau Article
          //echo $id_access_arti2."<br>";
          mysql_table_load("access_arti2");
          switch ($type_derogation)
          {

          case 1:
                if($duree_vie_production_fta_derogation_duree_vie<$Durée_de_vie_technique)
                {//Si la durée de vie du composant passe en dessous de celle de l'Article
                 //Ou qu'on se situe dans le cadre d'une augmentation de la Durée de Vie
                 //Génération d'une dérogation pour le Colis
                 //$id_fta_composition="";
                 $id_fta_composant="";
                 $id_access_arti2;
                 $type_fta_derogation_duree_vie=0;
                 mysql_table_operation("fta_derogation_duree_vie", "insert");
                }
                else
                {
                    $titre="Ce que vous demandez et contradictoire";
                    $message ="Vous avez demandé une dérogation pour diminuer la durée de vie de votre composant.<br>"
                             ."Pourtant vous venez de saisir une durée de vie supérieure.";
                    afficher_message($titre, $message, $redirection);
                    $error=1;
                }//header ("Location: derogation_duree_vie.php");

          break;
          case 2:
                if($duree_vie_production_fta_derogation_duree_vie>$Durée_de_vie_technique)
                {//Si la durée de vie du composant passe en dessous de celle de l'Article
                 //Ou qu'on se situe dans le cadre d'une augmentation de la Durée de Vie
                 //Génération d'une dérogation pour le Colis
                 //$id_fta_composition="";
                 $id_fta_composant="";
                 $id_access_arti2;
                 $type_fta_derogation_duree_vie=0;
                 mysql_table_operation("fta_derogation_duree_vie", "insert");
                }
                else
                {
                    $titre="Ce que vous demandez et contradictoire";
                    $message ="Vous avez demandé une dérogation pour augmenter la durée de vie de votre composant.<br>"
                             ."Pourtant vous venez de saisir une durée de vie inférieure.";
                    afficher_message($titre, $message, $redirection);
                    $error=1;
                }//header ("Location: derogation_duree_vie.php");
          break;
          }
          /* $nom_annexe_emballage_groupe;     //Fourni en URL
          $id_annexe_emballage_groupe_type;    //Fourni en URL
          mysql_table_operation("annexe_emballage_groupe", "insert");
          header ("Location: liste_type.php"); */
          if(!$error)
          {
              header ("Location: derogation_duree_vie.php");
          }
     break;

     case "supprimer":

               //Supprimer le groupe
               mysql_table_operation("fta_derogation_duree_vie", "delete");
               //header ("Location: liste_type.php");
               header ("Location: derogation_duree_vie.php");

     break;

/************
Fin de switch
************/

}
//header ("Location: derogation_duree_vie.php");
//include ("./action_bs.php");
//include ("./action_sm.php");

?>

