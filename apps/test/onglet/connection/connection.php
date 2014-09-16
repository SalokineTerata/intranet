<?php
$hostname_connect = "localhost";//nom du serveur MySQL de connection � la base de donn�e
$database_connect = "fta";//nom de la base de donn�e sur votre serveur MySQL
$username_connect = "root";//login de la base MySQL
$password_connect = "";//mot de passe de la base MySQL
$connect = mysql_pconnect($hostname_connect, $username_connect, $password_connect) or trigger_error(mysql_error(),E_USER_ERROR);//connection � la base de donn�e si sa echoue sa retourne une erreur. 
?>