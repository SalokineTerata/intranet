<?php

//Barre de navigation du module
//Récupération des droits d'accès necessaire
$module_consultation = $module . "_consultation";
$module_modification = $module . "_modification";

//Construction de la page des tables annexes
$page = "../lib/gestion_table.php?module=fiches_emballages&menu=menu_principal.inc";


/*
  Menu accessible pour les utilisateurs ayant les droits
  en consultation sur ce module
 */
if (Acl::getValueAccesRights($module_consultation)) {
    echo "<br>";
    echo "<a href=recapitulatif_droits_module.php><img src=\"../lib/images/bouton_aide_point_interrogation.gif\" border=\"0\" alt=\"R&eacute;capitulatif des Droits d'acc&egrave;s\" /></a>";

    echo "<br>";
    //echo "<a href=$page&nom_table=annexe_emballage_groupe&consultation=1 target=_top>Types d'emballage</a>";
    echo "<a href=../$module/liste_fte.php target=_top>Fiches Techniques Emballages</a>";
    echo "<br>";
}
echo "...";

/*
  Menu accessible pour les utilisateurs ayant les droits
  en modifications sur ce module
 */


if (Acl::getValueAccesRights($module_modification)) {
    //Ajouter une nouvelle FTE
    echo "<br>";
    echo "<a href=../" . $module . "/fte_modifier.php target=_top>Créer une nouvelle FTE</a>";


    //Gestion des données annexes
    //Fiches Techniques Emballages (FTE)
    echo "<br>";
    //echo "<a href=$page&nom_table=annexe_emballage target=_top>Fiches Techniques Emballages</a>";
    echo "<a href=../" . $module . "/liste_type.php target=_top>Types d'emballage</a>";

    //Fournisseurs
    echo "<br>";
    echo "<a href=gestion_fournisseurs.php target=_top>Ajout de Fournisseurs</a>";
    echo "<br>";
}
echo "...";

echo "</td>";

//Génération du cadre de droite contenant la page .php
echo "<td width=100%>";
?>