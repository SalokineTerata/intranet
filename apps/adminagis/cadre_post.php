<?php
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
     case 'update_pma_column_info':

     $mysql_database_exploitation;   //cf. session.php
     $mysql_database_developpement;  //cf. session.php

     //Changement de base de données
     mysql_select_db("phpmyadmin");

     //Suppression des étiquettes d'exploitation
     $req = "DELETE FROM pma_column_info "
          . "WHERE db_name='$mysql_database_exploitation' "
          ;
     DatabaseOperation::query($req);

     //Migration des nouvelles etiquettes
     $req = "SELECT * FROM pma_column_info "
          . "WHERE db_name='$mysql_database_developpement' "
          ;
     $result=DatabaseOperation::query($req);
     while ($rows=mysql_fetch_array($result))
     {

           //Insertion de l'étiquette dans la base d'exploitation
           $req1 = "INSERT INTO pma_column_info "
                 . "("
                 . "id,"
                 . "db_name,"
                 . "table_name,"
                 . "column_name,"
                 . "comment,"
                 . "mimetype,"
                 . "transformation,"
                 . "transformation_options"
                 . ") VALUES ('"
                 . "','"
                 . $mysql_database_exploitation. "','"
                 . $rows["table_name"]. "','"
                 . $rows["column_name"]. "','"
                 . addslashes($rows["comment"]). "','"
                 . $rows["mimetype"]. "','"
                 . $rows["transformation"]. "','"
                 . $rows["transformation_options"]. "')"
                 ;

     $mysql_database_exploitation;   //cf. session.php
           DatabaseOperation::query($req1);
     }

     //Retour dans la base en cours
     mysql_select_db($conf->mysql_database_name);


     //Redirection
     header ("Location: cadre.php");

     break;


     //Récupération d'un table MySQL de la base d'exploitation vers la base de développement
     //Si la table cible exsiste, elle est sauvegardé sous la forme nom_table-AAAA-MM-JJ-version
     case "reverse_import_table":

       $mysql_database_exploitation;   //cf. session.php
       $mysql_database_developpement;  //cf. session.php
       $reverse_import_table_name;     //cf. URL, nom de la table à importer
       $simulate;                      //cf. URL, 1=simulation
       $version=0;                     //Version de la sauvegarde de la table
       $save_name="";                  //Nom de la table de sauvegarde

       //echo $simulate;
       if($simulate)
       {
           echo "MODE SIMULATION<br><br>";
       }

       //Sauvegarde de la table existante dans le dev

              //Changement de base de données
              mysql_select_db($mysql_database_developpement);

              //Cette table existe-elle déjà dans le dev ?
              $req="SHOW TABLES LIKE '".$reverse_import_table_name."' ";
              $result=DatabaseOperation::query($req);

              //Si c'est le cas, on la sauvegarde
              if(mysql_num_rows($result))
              {
                  //Nom de la table de sauvegarde
                  $save_name = $reverse_import_table_name."-".date("Y-m-d");

                  //Cette table existe-elle déjà dans le dev ?
                  $req="SHOW TABLES LIKE '".$save_name."' ";
                  $result=DatabaseOperation::query($req);

                  //Si c'est le cas, on la sauvegarde en mode versionning
                  if(mysql_num_rows($result))
                  {
                      $save_name=$save_name."-";
                      $version=1;
                      $exist=1;

                      //Parcours des versionning déjà existants
                      while ($exist==1)
                      {
                           $req="SHOW TABLES LIKE '".$save_name.$version."' ";
                           $result=DatabaseOperation::query($req);

                           //Si ce nom est disponible, affactation du nom à la copie de la table
                           if(!mysql_num_rows($result))
                           {
                               $save_name=$save_name.$version;
                               $exist=0;
                           }//Fin de l'affectation
                           else
                           {
                               $version=$version+1;
                               //echo ": ".$version."<br>";
                           }
                      }//Fin du parcours des tables existantes
                  }//Fin du mode versionning

                  //Sauvegarde de la table
                  $req = "RENAME TABLE `$mysql_database_developpement`.`$reverse_import_table_name` TO `$mysql_database_developpement`.`$save_name`";
                  if(!$simulate)
                  {
                      $result=DatabaseOperation::query($req);
                  }
                  echo "Table de développement sauvegardée: \"$req\" <br>";
              }

              //Importation de la nouvelle table
              $req = "CREATE TABLE IF NOT EXISTS `$mysql_database_developpement`.`$reverse_import_table_name` SELECT * FROM `$mysql_database_exploitation`.`$reverse_import_table_name` ";
              if(!$simulate)
              {
                  $result=DatabaseOperation::query($req);
              }
              echo "Table d'exploitation importée: \"$req\" <br>";
              //Comparaison des structures
              if($save_name)
              {
                  if(!$simulate)
                  {
                     $req = "DESCRIBE `$mysql_database_developpement`.`$save_name`";

                  }else
                  {
                     $req = "DESCRIBE `$mysql_database_developpement`.`$reverse_import_table_name`";
                  }
                  $result_save=DatabaseOperation::query($req);
                  $i=0;
                  while ($rows=mysql_fetch_array($result_save))
                  {     
                      $tab_save["Field"][$i] = $rows["Field"];
                      $tab_save["Type"][$i] = $rows["Type"];
                      $tab_save["Null"][$i] = $rows["Null"];
                      $tab_save["Key"][$i] = $rows["Key"];
                      $tab_save["Default"][$i] = $rows["Default"];
                      $tab_save["Extra"][$i] = $rows["Extra"];
                      $i++;
                  }
                  //echo "<br>".print_r($tab_save)."<br>";

                  if(!$simulate)
                  {
                      $req = "DESCRIBE `$mysql_database_developpement`.`$reverse_import_table_name`";
                  }else
                  {
                      $req = "DESCRIBE `$mysql_database_exploitation`.`$reverse_import_table_name`";
                  }
                  $result_new=DatabaseOperation::query($req);
                  $i=0;
                  while ($rows=mysql_fetch_array($result_new))
                  {     
                      $tab_new["Field"][$i] = $rows["Field"];
                      $tab_new["Type"][$i] = $rows["Type"];
                      $tab_new["Null"][$i] = $rows["Null"];
                      $tab_new["Key"][$i] = $rows["Key"];
                      $tab_new["Default"][$i] = $rows["Default"];
                      $tab_new["Extra"][$i] = $rows["Extra"];
                      $i++;
                  }
                  //echo "<br>".print_r($tab_new)."<br>";

                  //Champ présent dans la table d'origine et absente dans le nouvelle table
                  echo"<pre>";
                  echo "Comparaison des structures perdues:<br>";
                  $champ="Field";
                  $result = array_diff($tab_save[$champ], $tab_new[$champ]);
                  if (count($result))
                  {
                  echo $champ.": ".print_r($result)."<br>";
                  }

                  $champ="Type";
                  $result = array_diff($tab_save[$champ], $tab_new[$champ]);
                  if (count($result))
                  {
                  echo $champ.": ".print_r($result)."<br>";
                  }

                  $champ="Null";
                  $result = array_diff($tab_save[$champ], $tab_new[$champ]);
                  if (count($result))
                  {
                  echo $champ.": ".print_r($result)."<br>";
                  }

                  $champ="Default";
                  $result = array_diff($tab_save[$champ], $tab_new[$champ]);
                  if (count($result))
                  {
                  echo $champ.": ".print_r($result)."<br>";
                  }

                  $champ="Extra";
                  $result = array_diff($tab_save[$champ], $tab_new[$champ]);
                  if (count($result))
                  {
                  echo $champ.": ".print_r($result)."<br>";
                  }

                  //Champ préent dans la table d'origine et absente dans le nouvelle table
                  echo "Structure Ajoutée:<br>";
                  $champ="Field";
                  $result = array_diff($tab_new[$champ], $tab_save[$champ]);
                  if (count($result))
                  {
                  echo $champ.": ".print_r($result)."<br>";
                  }

                  $champ="Type";
                  $result = array_diff($tab_new[$champ], $tab_save[$champ]);
                  if (count($result))
                  {
                  echo $champ.": ".print_r($result)."<br>";
                  }

                  $champ="Null";
                  $result = array_diff($tab_new[$champ], $tab_save[$champ]);
                  if (count($result))
                  {
                  echo $champ.": ".print_r($result)."<br>";
                  }

                  $champ="Default";
                  $result = array_diff($tab_new[$champ], $tab_save[$champ]);
                  if (count($result))
                  {
                  echo $champ.": ".print_r($result)."<br>";
                  }

                  $champ="Extra";
                  $result = array_diff($tab_new[$champ], $tab_save[$champ]);
                  if (count($result))
                  {
                  echo $champ.": ".print_r($result)."<br>";
                  }

                  echo"<pre>";
             }
     break;

     case "import_data":
          header ("Location: import_data.php");
     break;

     case "test_mail":
          $sujetmail="Test de messagerie";
          $text="Message permettant de valider le bon fonctionnement de la messagerie Intranet";
          $destinataire=$adresse_email;
          $expediteur="boris.sanegre@agis-sa.fr";
          envoismail($sujetmail,$text,$destinataire,$expediteur);
          header ("Location: cadre.php");
     break;

     default:
         header ("Location: cadre.php");
     break;

/************
Fin de switch
************/

}
//include ("./action_bs.php");
//include ("./action_sm.php");

?>

