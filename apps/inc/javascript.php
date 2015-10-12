<?php

/*
 * Charge tous les fichiers JavaScript
 */
require_once('../lib/functions_js.php');
Lib::includeJS('../plugins/dhtmlgoodies_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js');

if ($module != 'lib') {
    //include ('../$module/functions.js');
    //echo '<script type=\'text/javascript\' src=\''.'../$module/functions.js'.'\'></script>';
    if ($module == 'php') {
        $module = 'fta';
    }
    if (Lib::getModule() == 'php') {
        Lib::getModule() = 'fta';
    }
    require_once('../' . Lib::getModule() . '/functions_js.php');

    //Lib::includeJS('../'.Lib::getModule().'/functions_js.php');
}
?>
