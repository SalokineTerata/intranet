<?php

header('Content-type: text/html; charset=utf-8');

// page utilisée pour les modules developpés par Blue Item afin d'avoir la version du module lors de la navigation
// dans l'intranet.

require_once ('../lib/session.php');
require_once('../lib/functions.php');

$title = 'Intranet Agis';

if ($module) {
    //include ('../$module/functions.php');
    //include ('../$module/functions.js');

    $req = 'SELECT * FROM intranet_modules '
            . 'WHERE nom_intranet_modules=\'' . $module . '\'';
    ;
    $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);

    foreach ($array as $rows) {
        $nom_usuel_intranet_modules = $rows[IntranetModulesModel::FIELDNAME_NOM_USUEL_INTRANET_MODULES];
        $version_intranet_modules = $rows[IntranetModulesModel::FIELDNAME_VERSION_INTRANET_MODULES];
    }

    $title .= ' - $nom_usuel_intranet_modules - Version $version_intranet_modules';
}

//Intégrer le $printable dans le <body> de la page
if (!${$module . '_impression'})
    $printable = 'class=display_none';

//echo '<body $printable>';
//echo '<body >';
?>