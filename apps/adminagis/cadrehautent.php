<table width="770" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="150" valign="top">
            <?php
            if ($id_type == 4) {
                include("menuent.php");
            }
            ?>
            <?php
            /*
             * Charge tous les fichiers JavaScript
             */
            require_once("../lib/functions_js.php");
            Lib::includeJS("../plugins/dhtmlgoodies_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js");
            require_once("functions_js.php");
            ?>
        </td>
        <td valign="top">