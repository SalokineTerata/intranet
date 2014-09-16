<?php
//Barre de navigation du module

//Récupération des droits d'accès necessaire
$module_consultation = $module. "_consultation";
$module_modification = $module. "_modification";

//Construction de la page des tables annexes
//$page="../lib/gestion_table.php?module=$module&menu=menu_principal.inc";

/*   echo "<table border=0 cellspacing=0 cellpadding=0 height=534>";
  echo "<tr>";
  echo "
       <td valign=top  align=center>
       <div id=menu class=display_none>
  "; */

  echo "<$html_table>";
  echo "<tr class=\"contenu\">
  ";
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
}

/*
Menu accessible pour les utilisateurs ayant les droits
en modifications sur ce module
*/
if ($_SESSION[$module_modification])
{
   //Exemple d'un menu
   echo "<td align=\"right\">";
   echo "<a href=$page_action&edit_mode=1><img src=\"../lib/images/stylo.jpeg\" width=\"30\" height=\"45\" border=\"0\" alt=\"\" /><br>Editer</a>";
   echo "</td>";

}
echo "</tr></table>";

//Génération du cadre de droite contenant la page .php
echo "<td width=100%>";
?>