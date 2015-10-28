<?php

/*
  Inclusion
 */

require_once '../inc/main.php';


/*
 * Entête neutralisant le système de mise en cache du navigateur.
 * AJAX ne doit pas être mis en cache.
 */
header('Content-type: text/html; charset=utf-8');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

/*
 * Récupération des variables nécessaires au traitement de mise à jour.
 */
$tableName = Lib::getParameterFromRequest("TableName");
$keyName = Lib::getParameterFromRequest("KeyName");
$keyValue = Lib::getParameterFromRequest("KeyValue");
$fieldName = Lib::getParameterFromRequest("FieldName");
$fieldValue = Lib::getParameterFromRequest("FieldValue");

/*
 * Mise à jour de la donnée demandée.
 */
Logger::AddDebug($fieldValue, __FILE__);
DatabaseOperation::doSqlUpdateFromOneField($tableName, $keyName, $keyValue, $fieldName, addslashes($fieldValue));


