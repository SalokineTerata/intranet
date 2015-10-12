<?php
//Barre de navigation du module
$planning_presence_modification = Lib::isDefined('planning_presence_modification');
//Consulter
echo "<br>";
echo "<a href=./index.php>Consulter le planning des presences</a>";
echo "<br>";

if ($planning_presence_modification)
{
  //Créer
  echo "<br>";
  echo "<a href=./creation_planning_semaine.php>Créer une nouvelle semaine</a>";
  echo "<br>";

  //Supprimer
  echo "<br>";
  echo "<a href=./suppression_planning_semaine.php>Supprimer une semaine</a>";
  echo "<br>";
}
echo "</td>";
echo "<td width=100%>";
?>