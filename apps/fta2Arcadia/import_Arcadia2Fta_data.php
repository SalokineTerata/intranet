<?php

//require_once './../../config.ini';
/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */

/**
 * Nom de la base de données
 */
$nameOfBDDTarget = $argv[1];

/**
 * Nom du serveur de base de données
 */
$hostname_connect = $argv[2];

/**
 * Utilisateur de la base de données
 */
$username_connect = $argv[3];

/**
 * Mot de passe de l'utilisateur de la base de données.
 */
$password_connect = $argv[4];

/**
 * Répertoire EAI d'importation des données
 */
$linkFolder = $argv[5];

/**
 * Répertoire EAI de vérification de l'importation des données
 */
$linkFolderOK = $argv[6];

/**
 * Répertoire racine
 */
$linkFolderBegin = $argv[7];

/* * *******
  Inclusions
 * ******* */
require __DIR__ . '/../inc/php_cli.php';
$initFile = parse_ini_file($linkFolderBegin . "/config.ini", TRUE);

/**
 * Class gérant l'actualisation des données Arcadia2Fta
 */
$arcadia2Fta = new Arcadia2FtaController($nameOfBDDTarget, $hostname_connect, $username_connect, $password_connect, $linkFolder, $initFile, $linkFolderOK);

$arcadia2Fta->updateBDDFtaFromArcadiaData();
$debut = date("H:i:s");

echo"Debut :" . $debut . " Fin :" . date("H:i:s") . "\n";
?>