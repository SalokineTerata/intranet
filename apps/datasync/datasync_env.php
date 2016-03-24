<?php


/**
 * Identification du type de sycnhronication
 * -d Copy de la journée 
 * -w Copy de la semaine
 */
$type = $argv[1];

/**
 * Détermination de l'environnement
 */
$serverName = exec(`hostname`);

switch ($serverName) {
    case "cod-intranet.agis.fr":
        echo exec('./cli/datasync_cod.sh ' . $type);

        break;
    case "dev-intranet.agis.fr":

        echo exec('./cli/datasync_dev.sh ' . $type);
        break;
    case "fta05401.grpldc.com":

        echo exec('./cli/datasync_prd.sh ' . $type);
        break;
    
    default :
        echo $serverName;
}