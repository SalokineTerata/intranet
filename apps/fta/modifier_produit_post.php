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

/*
          //Règle de gestion des données
          if ($etat_access_recettes_recette=2) //Cas du Surgelé
          {
             $quantite_piece_par_carton="";
          }
 */
          //Insertion d'une nomenclature orpheline
          //ou mise à jour d'une recette associée à une nomenclature
          //echo $creation;
          if($creation)
          {
              //Création de la nomenclature orpheline
              //mysql_table_operation("fta_nomenclature", "insert");
              mysql_table_operation("fta_composant", "insert");
              mysql_table_load("annexe_agrologic_article_codification");
              if($prefixe_annexe_agrologic_article_codification=="02")    //Correspondant au codification de Type 2
              {
                  //Valeur par défaut
                  $_SESSION["ingredient_fta_composition"]=$_SESSION["liste_ingredient_defaut"];
                  $_SESSION["nom_fta_composition"]=$_SESSION["nom_fta_nomenclature"];
                  $_SESSION["id_geo"]=$_SESSION["site_production_fta_nomenclature"];
                  $_SESSION["poids_fta_composition"]=$_SESSION["poids_fta_nomenclature"];
                  $_SESSION["quantite_fta_composition"]="1";

                  //Ajout
                  //mysql_table_operation("fta_composition", "insert");
                  mysql_table_operation("fta_composant", "insert");
              }
          }
          else
          {

              //Mise à jour de la recette associée à sa nomenclature
              $N_INFOLOGIC=$code_produit_agrologic_fta_nomenclature;
              $id_fta_nomenclature;
              //mysql_table_operation("fta_nomenclature", "update");
              mysql_table_operation("fta_composant", "update");


              /* //Suppression des composants associés
              $req = "DELETE FROM fta_composition "
                   . "WHERE id_fta_nomenclature=".$_SESSION["id_fta_nomenclature"]." "
                   ;
              DatabaseOperation::query($req);


              //Dans le cas d'une recette, Ajout du composant associé ainsi que ses valeurs par défaut
              if($id_access_recettes_recette)
              {
                 //Valeur par défaut
                 $_SESSION["ingredient_fta_composition"]=$_SESSION["liste_ingredient_defaut"];
                 $_SESSION["nom_fta_composition"]=$_SESSION["nom_fta_nomenclature"];
                 $_SESSION["id_geo"]=$_SESSION["site_production_fta_nomenclature"];
                 $_SESSION["poids_fta_composition"]=$_SESSION["poids_fta_nomenclature"];
                 $_SESSION["quantite_fta_composition"]="1";

                 //Ajout
                 mysql_table_operation("fta_composition", "insert");
              } */
          }

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

