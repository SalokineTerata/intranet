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
$serverName = file_get_contents("/etc/hosts");
if (stripos($serverName, "cod-intranet.agis.fr")) {
    echo exec('./cli/datasync_cod.sh ' . $type);
} elseif (stripos($serverName, "dev-intranet.agis.fr")) {
    echo exec('./cli/datasync_dev.sh ' . $type);
} elseif (stripos($serverName, "fta05401.grpldc.com")) {
    echo exec('./cli/datasync_prd.sh ' . $type);
} else {
    echo $serverName;
}

