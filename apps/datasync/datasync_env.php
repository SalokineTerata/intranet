<?php

include '../inc/php.php';

$globalConfig = new GlobalConfig();

/**
 * Identification du type de sycnhronication
 * -d Copy de la journée 
 * -w Copy de la semaine
 */
$type = $argv[1];

/**
 * Détermination de l'environnement
 */
$env = $globalConfig->getConf()->getExecEnvironment();

switch ($env) {
    case EnvironmentConf::ENV_COD_NAME:
        echo exec('./cli/datasync_cod.sh ' . $type);

        break;
    case EnvironmentConf::ENV_DEV_NAME:

        echo exec('./cli/datasync_dev.sh ' . $type);
        break;
    case EnvironmentConf::ENV_PRD_NAME:

        echo exec('./cli/datasync_prd.sh ' . $type);
        break;
}