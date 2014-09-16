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


     case 'valider':

     $suffixe_agrologic_fta_nomenclature=strtoupper($suffixe_agrologic_fta_nomenclature);
     $nom_fta_nomenclature=strtoupper($nom_fta_nomenclature);
//echo $id_annexe_unite;
//echo $etat_fta_nomenclature;


          //Règle de gestion des données

          mysql_table_load("annexe_agrologic_article_codification");
          
          //Les Produits toujours en Kg
          if( $prefixe_annexe_agrologic_article_codification=="06"
           or $prefixe_annexe_agrologic_article_codification=="07"
            )
          {
              $id_annexe_unite="kg";
          }

          //Les Produits toujours en L
          if( $prefixe_annexe_agrologic_article_codification=="05")
          {
              $id_annexe_unite="L";
          }

          //Insertion d'une nomenclature orpheline
          //ou mise à jour d'une recette associée à une nomenclature
          //echo $creation;
          $is_nomenclature_fta_composant = 1;

          if($creation)
          {
              $operation="insert";
          }else
          {
              $operation="update";
          }


              //Création de la nomenclature orpheline
              //mysql_table_operation("fta_nomenclature", "insert");
              mysql_table_load("annexe_agrologic_article_codification");
              if(
                  (//Cas Général (sauf Tarare)
                  $prefixe_annexe_agrologic_article_codification=="02"
                  and $_SESSION["site_production_fta_nomenclature"]<>"3"
                  )
                  or
                  (//Cas Tarare)
                  $prefixe_annexe_agrologic_article_codification=="01"
                  and $_SESSION["site_production_fta_nomenclature"]=="3"
                  )
              )
              {
                  //Valeur par défaut
                  if($creation)
                  {
                      $_SESSION["ingredient_fta_composition"]=$_SESSION["liste_ingredient_defaut"];
                      $_SESSION["nom_fta_composition"]=$_SESSION["nom_fta_nomenclature"];
                      $_SESSION["id_geo"]=$_SESSION["site_production_fta_nomenclature"];
                      $_SESSION["poids_fta_composition"]=$_SESSION["poids_fta_nomenclature"];
                      $_SESSION["quantite_fta_composition"]="1";
                  }
                  $is_composition_fta_composant = 1;

                  //Ajout
                  //mysql_table_operation("fta_composition", "insert");
                  //mysql_table_operation("fta_composant", "insert");
              }
              else
              {
                  $is_composition_fta_composant = 0;
              }
              //Ce composant sera géré dans la nomenclature
              mysql_table_operation("fta_composant", $operation);


          //Renvoi sur la page des nomenclature
          header ("Location: modification_fiche.php"
                 ."?id_fta=$id_fta"
                 . "&id_access_recette_recette=$id_access_recette_recette"
                 . "&id_fta_chapitre_encours=$id_fta_chapitre_encours"
                 . "&synthese_action=$synthese_action"
                 );
     break;



/************
Fin de switch
************/

}
//include ("./action_bs.php");
//include ("./action_sm.php");

?>

