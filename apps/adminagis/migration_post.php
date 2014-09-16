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

switch($action)
{
  case "suppression_acces_vacant":

  //Suppression des accès des utilisateurs inexistants
echo       $req = "DELETE `intranet_droits_acces` "
            . "FROM `intranet_droits_acces` LEFT JOIN `salaries` "
            . "ON `intranet_droits_acces`.`id_user` = `salaries`.`id_user` "
            . "WHERE (`salaries`.`id_user` IS NULL)"
            ;
       $result = DatabaseOperation::query($req);

echo "<br>";

  //Suppression des accès des utilisateurs inexistants
echo       $req = "DELETE `intranet_droits_acces` "
            . "FROM `intranet_droits_acces` "
            . "WHERE (niveau_intranet_droits_acces=0)"
            ;
       $result = DatabaseOperation::query($req);
  break;



}


/************
Fin de switch
************/


//include ("./action_bs.php");
//include ("./action_sm.php");
//echo "</pre>";
?>


