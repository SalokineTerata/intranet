<?php
//Barre de navigation du module

//Récupération des droits d'accès necessaire
$module_consultation = $module. "_consultation";
$module_modification = $module. "_modification";

//Construction de la page des tables annexes
$page="../lib/gestion_table.php?modules=$module&menu=menu_principal.inc";

/*
Menu accessible pour les utilisateurs ayant les droits
en consultation sur ce module
*/
if ($_SESSION[$module_consultation])
{
   /*
   //Exemple d'un menu
   echo "<br>";
   echo "<a href=./index.php target=_top>Index du module</a>";
   echo "<br>";
   */
   echo "<br>";
   echo "<a href=consultation.php><img src=../lib/images/bouton_creation.gif  border=0></a>";
   echo "<br>";
}
   echo "...";

/*
Menu accessible pour les utilisateurs ayant les droits
en modifications sur ce module
*/
if ($_SESSION[$module_modification])
{
   //Exemple d'un menu
   echo "<br>";
   echo "<a href=./index.php target=_top>Menu Avancé</a>";
   echo "<br>";

}
   echo "...";

echo "</td>";

//Génération du cadre de droite contenant la page .php
echo "<td width=100%>";
?>