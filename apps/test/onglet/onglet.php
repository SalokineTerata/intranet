<?php
/*
*********************************************
*			Script créé par DJMMIX			*
*			   version 1 final				*
*   pour toute sugestion envoyer un mail à  *
*			djmmixonly@gmail.com			*
*********************************************
*/
include('./connection/connection.php');//inclu les paramètres de connection à la base de donnée
    if (!$connect)//si pas connecter a la base de donnée déclenche une érreur SQL
       die("Erreur de connection à MySQL: " . mysql_error());	   
if (!mysql_select_db($database_connect, $connect))//si base non trouvée déclenche une erreur SQL
       die("Erreur base de donnée non trouvée: " . mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="./onglet.css" rel="stylesheet" type="text/css" />
<?php
echo "<script type=\"text/javascript\">\n";//génération du des paramètre pour le javascript qui seron utilisé par le script AJAX
echo "<!--\n";
$requete='SELECT * FROM multionglet';//sélectionne la table pour la gestion du contenu
$requeteongletjs= mysql_query($requete, $connect) or die("Erreur table non trouvée:".mysql_error());//déclenche une erreur si la table n'est pas trouvé
$ongletjs = mysql_fetch_object($requeteongletjs);//sélectionne le premier enregistrement de la table
$tabonglet=array(0 => array("onglet"=>$ongletjs->onglet,"titre"=>$ongletjs->titre,"contenu"=>$ongletjs->contenu));//stock dans un tableau a 2 dimension les donnée de la table
$compteur=1;//variable qui stock le nombre d'onglet a afficher
$valeur="'".$ongletjs->onglet."'";//stock dans la variable l'ID des onglets
while ($ongletjs = mysql_fetch_object($requeteongletjs))//requete pour lister toute la table
{
	$valeur=$valeur.",'".$ongletjs->onglet."'";
	$tabonglet[]=array("onglet"=>$ongletjs->onglet,"titre"=>$ongletjs->titre,"contenu"=>$ongletjs->contenu);
	$compteur++;
}
echo"compteur=".$compteur.";\n";//variable transformer en javascript pour utilisation avec le script AJAX pour avoir le nombre d'onglet
echo "tabu=[".$valeur."];\n";//variable qui va stocker toute les ID transmit pour le script AJAX
echo "//-->\n";
echo "</script>\n";
?>
<script type="text/javascript" src="onglet.js"></script>
<title>onglet</title>
</head>
<body>
<table border="0" width="400" align="center">
  <tr>
  	<td>
<?php

echo "		<ol id=\"tabnav\">\n";
echo "			<li><a href=\"javascript:onglet('".$tabonglet[0]["onglet"]."');\" class=\"active\" id=\"".$tabonglet[0]["onglet"]."\">".$tabonglet[0]["titre"]."</a></li>\n";//génère l'onglet actif
$i=1;
	while ($i<$compteur) 
		{
					echo "			<li><a href=\"javascript:onglet('".$tabonglet[$i]["onglet"]."');\" id=\"".$tabonglet[$i]["onglet"]."\">".$tabonglet[$i]["titre"]."</a></li>\n";//génère les autres onglets
					$i++;
		}
echo "		</ol>\n";
echo "		<div id=\"contenu\" class=\"tabtour\"><br/>".$tabonglet[0]["contenu"]."<br/><br/></div>\n";//génère le div qui va contenir les données de l'onglet
?>
	</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_close($connect);//fermeture de la connection SQL
?>