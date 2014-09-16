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
print_page_begin($disable_full_page, $menu_file);

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
          $site_recette; //Site de gestion de la recette
          $CLE_RECETTE;  //Identifiant dans la base Access/Recette

          //Recherche de l'identifiant "id_recette" si il n'a pas été communiqué directement
          if (!$id_access_recette_recette)
          {
            $req = "SELECT id_access_recette_recette "
                 . "FROM access_recettes_recette "
                 . "WHERE site_recette='$site_recette' "
                 . "AND CLE_RECETTE='$CLE_RECETTE' "
                 ;
            $result=DatabaseOperation::query($req);
            $num=mysql_num_rows($result);

            switch ($num)
            {
            case 0: //Aucune recette ne correspond à la recherche

                 $erreur=1;

            break;
            case 1: //Une recette correspond à la recherche et on récupère l'identifiant MySQL

                 $erreur=0;
                 $id_access_recette_recette=mysql_result($result, "id_access_recette_recette", 0);

                 //Ajout de la recette racine dans la nomenclature
                 //$id_id_fta_nomenclature=mysql_table_operation("access_recettes_recette", "insert");


            break;
            default:
                    
                  $erreur=2;

            }
          }//Fin de la recherche à partir du numéro de dossier utilisateur


          switch ($erreur)
          {
          case 0:

              //Sauvegarde de la clef avant d'utiliser la fonction "recette_nomenclature_ajout"
              $id_access_recette_recette_sauvegarde=$id_access_recette_recette;

                  //Ajout des Recettes dans la nomenclature
                  $id_fta;
                  $ascendant_fta_nomenclature;
                  $id_fta_nomenclature=recette_nomenclature_ajout($id_access_recette_recette, $id_fta, $ascendant_fta_nomenclature);

                  if(!$id_fta_nomenclature)
                  {
                      $erreur=1;
                      }
                      else
                      {
                      $erreur=0;
                  }

              //Restauration de la clef après l'utilisation de la fonction "recette_nomenclature_ajout"
              $id_access_recette_recette=$id_access_recette_recette_sauvegarde;

              if(!$erreur)
              {
                //Renvoi sur la page des nomenclature
                header ("Location: modification_fiche.php"
                       ."?id_fta=$id_fta"
                       . "&id_access_recette_recette=$id_access_recette_recette"
                       . "&id_fta_chapitre_encours=$id_fta_chapitre_encours"
                       );
              }

          break;
          case 1:
              $titre = "Le Moteur de Recherche Intranet vous informe:";
                     $message = "Aucune recette ne correspond au Dossier Recette $site_recette-$CLE_RECETTE\n"
                            . "Peut-être devriez-vous utiliser la liste déroulante pour sélectionner\n"
                            . "votre recette manuellement."
                            ;
                     afficher_message($titre, $message, $redirection);
          break;
          case 2:

              $titre = "Erreur Grave du Système";
                     $message = "Merci de contacter le Service Informatique.";
                     afficher_message($titre, $message, $redirection);
          break;
          }



     break;



/************
Fin de switch
************/

}
//include ("./action_bs.php");
//include ("./action_sm.php");

?>

