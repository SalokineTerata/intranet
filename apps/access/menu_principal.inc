<?php
//Barre de navigation du module
$module_consultation=Acl::getValueAccesRights('access_consultation');
$module_modification=Acl::getValueAccesRights('access_modification');
//Récupération des droits d'accès necessaire
$$module_consultation = $module_consultation
                          . "_consultation"
                          ;
$$module_modification = $module_modification
                          . "_modification"
                          ;
/*
Menu accessible pour les utilisateurs ayant les droits
en consultation sur ce module
*/
if ($module_consultation)
{
   //Exemple d'un menu
   echo "<br>";
   echo "<a href=./index.php target=_top>Index du module</a>";
   echo "<br>";
}
   echo "...";

/*
Menu accessible pour les utilisateurs ayant les droits
en modifications sur ce module
*/
if ($module_modification)
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
