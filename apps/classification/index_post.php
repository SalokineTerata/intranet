<?php
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
$id_fta_classification2 = Lib::getParameterFromRequest(ClassificationFta2Model::KEYNAME);

if ($id_fta_classification2) {

    $ClassificationFta2Model = new ClassificationFta2Model($id_fta_classification2);
}

//include ("./action_bs.php");
//include ("./action_sm.php");

?>

