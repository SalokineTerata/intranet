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

	     //echo $taille_police_ingredient_fta_composition;

//echo $id_fta."<br>";
//echo $etiquette_fta_composition;
          mysql_table_load("fta");
//echo $id_fta."<br>";

          mysql_table_load("access_arti2");
//echo $id_fta."<br>";

          //Mise à jour des données et règles de gestion
/*
          switch($mode_etiquette_fta_composition)
          {
              case 0: //Pas d'étiquette composition
             //case 3: //Etiquette regroupé sur un autre composant
                 $etiquette_fta_composition="";
                 $etiquette_supplementaire_fta_composition="";
                 $etiquette_poids_fta_composition=="";
                 $etiquette_id_fta_composition=0;
             break;
             case 1: //Contenu de l'etiquette identique à la liste des ingrédients
                 $etiquette_fta_composition=$ingredient_fta_composition;
                 $etiquette_supplementaire_fta_composition=$ingredient_fta_composition1;
                 $etiquette_poids_fta_composition=$poids_fta_composition/1000;  //Attention, unité en (g), donc conversion en (Kg)
                 $etiquette_duree_vie_fta_composition=$duree_vie_technique_fta_composition;
                 $etiquette_id_fta_composition=0;
             break;
             case 2: //Etiquette à composition regroupée
                 $etiquette_poids_fta_composition=$Poids_ELEM; //Attention unité en (Kg)
                 $etiquette_duree_vie_fta_composition=${"Durée_de_vie_technique"};
                 $etiquette_id_fta_composition=0;
             break;
             case 4: //Forcer le regroupement de tous les composant vers ce composant
                 $etiquette_duree_vie_fta_composition=${"Durée_de_vie_technique"};
                 $etiquette_poids_fta_composition=$Poids_ELEM; //Attention unité en (Kg)
                 //echo $id_fta_composition."\n";
                 //echo $id_fta."\n";

                   $req = "UPDATE fta_composant "
                      . "SET etiquette_fta_composition='' "
                      . ", etiquette_supplementaire_fta_composition='' "
                      . ", etiquette_poids_fta_composition='' "
                      . ", etiquette_id_fta_composition=$id_fta_composant "
                      . ", mode_etiquette_fta_composition=3 "
                      . "WHERE id_fta=$id_fta "
                      . "AND id_fta_composant<>$id_fta_composant "
                      ;
                   DatabaseOperation::query($req);
//echo $id_fta."<br>";

             default:
             //case 14:
                 $checked_0="checked";
                 //echo $id_fta."<br>";
             break;
          }
*/
//echo $etiquette_poids_fta_composition;

          //Insertion ou mise à jour d'un composant ?
          if($creation)
          {
              //Création

              //Le composant sera géré par la composition
              $is_composition_fta_composant = 1;

              //En revanche, un composant créé au niveau de la composition n'intervient pas dans la nomenclature
              $is_nomenclature_fta_composant = 0;

              //mysql_table_operation("fta_composition", "insert");
              mysql_table_operation("fta_composant", "insert");

          }
          else
          {

              //Mise à jour
//echo $nom_fta_composition;
              //mysql_table_operation("fta_composition", "update");
              mysql_table_operation("fta_composant", "update");
              
          }
//echo $id_fta."<br>";

          //Renvoi sur la page des nomenclature
          if($valider_saisie)
          {
            header ("Location: modification_fiche.php"
                   ."?id_fta=$id_fta"
                   . "&id_access_recette_recette=$id_access_recette_recette"
                   . "&id_fta_chapitre_encours=$id_fta_chapitre_encours"
                   . "&synthese_action=$synthese_action"
                   );
          }
          else
          {
            header ("Location: modifier_composition.php"
                   ."?id_fta=$id_fta"
                   //."&id_fta_composition=$id_fta_composition"
                   ."&id_fta_composant=$id_fta_composant"
                   . "&id_fta_chapitre_encours=$id_fta_chapitre_encours"
                   . "&synthese_action=$synthese_action"
                   . "&proprietaire=$proprietaire"
                   );
          }
     break;

     case 'consulter':
//echo $id_fta."<br>";
          //Renvoi sur la FTA
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

