<?php

/**
 * Entête HTML
 */
header('Content-type: text/html; charset=utf-8');

/**
  Récupération de la session PHP
  Attention à bien laisser l'option 'nocache'
  Sinon le cache du navigateur ne se rafraichira pas systématiquement.
 */
session_cache_limiter('nocache');     // Configure le délai d'expiration à X minutes du cache du navigateur

/**
 * Reprise de la session ou création si inexsitante.
 */
session_start();

/**
 * Restauration de la session si précédemment initialisée
 * Ou l'initialise.
 */
$globalConfig = new GlobalConfig();

/**
 * Sauvegarde la GlobalConfig en session PHP
 */
GlobalConfig::saveGlobalConfToPhpSession($globalConfig);

/**
 * Ouverture de la connexion à la base de données.
 */
$globalConfig->openDatabaseConnexion();

/**
 * Construction de la description de la base de données et 
 * stockage en session PHP
 */
$globalConfig->buildDatabaseDescription();

