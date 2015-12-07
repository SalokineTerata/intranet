<?php
//Barre de navigation du module

//Récupération des droits d'accès necessaire
$module_consultation = $module. "_consultation";
$module_modification = $module. "_modification";

//Construction de la page des tables annexes
$page="../lib/gestion_table.php?module=$module&menu=menu_principal.inc";


/*
Menu accessible pour les utilisateurs ayant les droits
en consultation sur ce module
*/
if (Acl::getValueAccesRights($module_consultation))
{
   echo "<br>
        <a href=./doc/manuel_utilisateur.odt target=_top>Manuel Utilisateur</a>
        <br>
        ";


}
   echo "...";

/*
Menu accessible pour les utilisateurs ayant les droits
en modifications sur ce module
*/
if (Acl::getValueAccesRights($module_modification))
{

   //Catégorie de classification
   echo "<br>";
   echo "<a href=$page&nom_table=classification_arborescence_article_categorie target=_top>Catégories</a>";

   //Eléments de Classifications
   echo "<br>";
   echo "<a href=$page&nom_table=classification_arborescence_article_categorie_contenu target=_top>Eléments</a>";
   echo "<br>";

}
   echo "...";

echo "</td>";

//Génération du cadre de droite contenant la page .php
echo "<td width=100% valign=top>";
?>