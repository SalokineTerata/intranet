<?php

$_SESSION["session_init"] = false;

require_once "../inc/main.php";

/**
 * Code PHP de test
 */
$return = NULL;
DatabaseOperation::createDatabaseConnection();

/**
 * Code HTML
 */
echo "<!DOCTYPE html><html><body>";
echo "Page de test";
echo $listHtlm;
echo "</body></html>";
?>
