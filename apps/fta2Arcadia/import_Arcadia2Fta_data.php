<?php

//require_once './../../config.ini';
/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$nameOfBDDTarget = $argv[1];


//$hostname_connect = "dev-intranet.agis.fr"; //nom du serveur MySQL de connection � la base de donn�e
$hostname_connect = $argv[2]; //nom du serveur MySQL de connection � la base de donn�e
//$username_connect = "root"; //login de la base MySQL
$username_connect = $argv[3]; //login de la base MySQL
//$password_connect = "8ale!ne"; //mot de passe de la base MySQL
$password_connect = $argv[4];
//mot de passe de la base MySQL

$linkFolder = $argv[5];
$linkFolderOK = $argv[6];
$linkFolderBegin = $argv[7];

/* * *******
  Inclusions
 * ******* */
require __DIR__ . '/../inc/php_cli.php';
$initFile = parse_ini_file($linkFolderBegin . "config.ini", TRUE);
//
//$donnee = mysql_pconnect($hostname_connect, $username_connect, $password_connect);
//mysql_select_db($nameOfBDDTarget);
//mysql_query('SET NAMES utf8');

/**
 * Class gérant l'actualisation des données Arcadia2Fta
 */
$arcadia2Fta = new Arcadia2FtaController($nameOfBDDTarget, $hostname_connect, $username_connect, $password_connect, $linkFolder, $initFile, $linkFolderOK);

$arcadia2Fta->updateBDDFtaFromArcadiaData();
$debut = date("H:i:s");

echo"Debut :" . $debut . " Fin :" . date("H:i:s") . "\n";
?>