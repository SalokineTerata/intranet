<?php
include('./connection/connection.php');//inclu les paramètres de connection à la base de donnée
    if (!$connect)//si pas connecter a la base de donnée déclenche une érreur SQL
       die("Erreur de connection à MySQL: ".mysql_error());	   
if (!mysql_select_db($database_connect, $connect))//si base non trouvée déclenche une erreur SQL
       die("Erreur base de donnée non trouvée: ".mysql_error());   
if($HTTP_GET_VARS['page'])//pour soucis de compatibilité de test en local ou sur site distant verifie la présence de la variable dans l'url
{
	$contenu=$HTTP_GET_VARS['page'];//récupère la variable de la méthode GET
}else{
	$contenu=$_GET['page'];//idem pour la récupération en local
}
$select= "SELECT * FROM multionglet";//sélectionne la table pour la gestion du contenu
$Requete_Contenu=mysql_query($select,$connect) or die("Erreur table non trouvée:".mysql_error());//déclenche une erreur si la table n'est pas trouvé
while ($row = mysql_fetch_object($Requete_Contenu)){//boucle pour parcourir la table multionglet
	if ($row->onglet==$contenu)//verifie si la variable est identique a celle touver dans la base de donnée
		{
				echo "<br/>".mb_convert_encoding($row->contenu, "UTF-8", "ISO-8859-1")."<br/><br/>";//affichage du contenu qui sera retourner par la requete AJAX
		}
}
mysql_close($connect);//fermeture de la connection SQL
?>
