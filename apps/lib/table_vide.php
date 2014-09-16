<?php
//Inclusions
include ("../lib/session.php");         //Récupération des variables de sessions
include ("../lib/functions.php");         //Timeout de déconnexion
//include ("../$module/functions.php");//Récupération des functions de ce module
include ("../lib/debut_page.php");    //Affichage des éléments de commun à l'Intranet
include ("../$module/options.inc");  //Affichage du menu d'option de ce module

//Corps de la page
echo
"
    <center>
    <div class=txtproduction>
    Aucune Données dans cette table.
    </div>
    </center>
";
//Fin de page
include ("../lib/fin_page.inc");
?>

