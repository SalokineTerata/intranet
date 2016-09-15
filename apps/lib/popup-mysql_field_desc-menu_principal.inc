<?php
//Barre de navigation du module

//Récupération des droits d'accès necessaire
$fta_consultation = Acl::getValueAccesRights('fta_consultation');
$fta_modification = Acl::getValueAccesRights('fta_modification');
$owner = IntranetColumnInfoModel::getOwner();
$QUERY_STRING = $_SERVER['QUERY_STRING'];

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
if ($fta_consultation)
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
if ($fta_modification AND $owner )
{
   //Exemple d'un menu
   echo "<td align=\"right\">";
   echo "<a href=popup-mysql_field_desc.php?$QUERY_STRING&edit_mode=1><img src=\"../lib/images/stylo.jpeg\" width=\"30\" height=\"45\" border=\"0\" alt=\"\" /><br>Editer</a>";
   echo "</td>";

}
echo "</tr></table>";

//Génération du cadre de droite contenant la page .php
echo "<td width=100%>";
?>