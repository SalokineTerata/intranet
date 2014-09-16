<?php
/*
Module d'appartenance (valeur obligatoire)
Par défaut, le nom du module est le répetoire courant
*/

//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);
//
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


     case 'valider': //Enregistrement du nouveau tarif

          //Date de début de période
          $nom_date="date_debut_fta_tarif";
          $txt1="jour_date_".$nom_date;
          $jour_date=$$txt1;
          $txt1="mois_date_".$nom_date;
          $mois_date=$$txt1;
          $txt1="annee_date_".$nom_date;
          $annee_date=$$txt1;
          $$nom_date=recuperation_date_pour_mysql($jour_date,$mois_date, $annee_date, $nom_date);

              //Si pas de date saisie, par défaut Date du jour
              if ($$nom_date=="0000-00-00")
              {
                 $$nom_date=date("Y-m-d");
              }

          //Date de fin de période
          $nom_date="date_fin_fta_tarif";
          $txt1="jour_date_".$nom_date;
          $jour_date=$$txt1;
          $txt1="mois_date_".$nom_date;
          $mois_date=$$txt1;
          $txt1="annee_date_".$nom_date;
          $annee_date=$$txt1;
          $$nom_date=recuperation_date_pour_mysql($jour_date,$mois_date, $annee_date, $nom_date);

              //Si pas de date saisie, par défaut 31/12 de l'année en cours
              if ($$nom_date=="0000-00-00")
              {
                 $$nom_date=date("Y-12-31");
              }


          $id_fta;
          mysql_table_operation("fta_tarif", "insert");


     header ("Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action");
     break;


/************
Fin de switch
************/

}
//include ("./action_bs.php");
//include ("./action_sm.php");

?>

