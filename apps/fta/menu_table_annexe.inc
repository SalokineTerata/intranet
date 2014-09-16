<?php
//Barre de navigation du module

if ($fta_consultation)
{

}

//Construction de la page
$page="../lib/gestion_table.php?module=fta&menu=menu_table_annexe.inc";

if (${$module."_composition"})//Tables Annexes gérées par le processus "qualite"
{
   //Gestion des données annexes
   //Prestataires
   echo "<br>";

   echo "<a href=$page&nom_table=fta_duree_vie  target=_top>Durées de Vie Article</a>";
   echo "<br>";

/*    echo "<a href=$page&nom_table=matiere_premiere_client target=_top>Clients</a>";
   echo "<br>";

   echo "<a href=$page&nom_table=matiere_premiere_fournisseur target=_top>Fournisseurs</a>";
   echo "<br>";

   echo "...";

   //Allergènes
   echo "<br>";

   echo "<a href=$page&nom_table=annexe_allergene_origine target=_top>Origines des Allergènes</a>";
   echo "<br>";

   echo "<a href=$page&nom_table=annexe_allergene_famille target=_top>Familles des Allergènes</a>";
   echo "<br>";

   echo "<a href=$page&nom_table=annexe_allergene target=_top>Allergènes</a>";
   echo "<br>";

   echo "<a href=$page&nom_table=matiere_premiere_contaminant target=_top>Contaminants</a>";
   echo "<br>";

   echo "...";

   //Lieux
   echo "<br>";

   echo "<a href=$page&nom_table=annexe_pays target=_top>Pays</a>";
   echo "<br>";

   echo "<a href=$page&nom_table=matiere_premiere_zone_fao target=_top>Zones FAO</a>";
   echo "<br>";

   echo "...";

   //Caractéristiques Scientifiques
   echo "<br>";

   echo "<a href=$page&nom_table=annexe_caracteristique_scientifique_groupe target=_top>Groupes de Caractéristiques Scientifiques</a>";
   echo "<br>";

   echo "<a href=$page&nom_table=annexe_caracteristique_scientifique target=_top>Caractéristiques Scientifiques</a>";
   echo "<br>";


   echo "...";

   //Additifs
   echo "<br>";
   echo "<a href=$page&nom_table=annexe_additif_groupe target=_top>Groupes d'Additif</a>";
   echo "<br>";

   echo "<a href=$page&nom_table=annexe_additif target=_top>Additifs</a>";
   echo "<br>";

   echo "...";

   //Arômes
   echo "<br>";
   echo "<a href=$page&nom_table=annexe_arome_categorie target=_top>Catégories d'Arôme</a>";
   echo "<br>";

   echo "...";

   //Autres
   echo "<br>";

   echo "<a href=$page&nom_table=matiere_premiere_filiere target=_top>Filières</a>";
   echo "<br>";

   echo "<a href=$page&nom_table=matiere_premiere_conditionnement target=_top>Conditionnement</a>";
   echo "<br>";

   echo "<a href=$page&nom_table=annexe_environnement_conservation target=_top>Conservation</a>";
   echo "<br>";
 */
}
echo "</td>";
echo "<td width=100%>";
?>