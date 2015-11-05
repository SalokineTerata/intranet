<?php
/*
 * Pied de page de l'Intranet
 * Cet include doit être inclus dans l'ensemble des pages sous la forme:
 *
 * include ('../inc/footer.php');
 */
require_once '../inc/footer.php';
$globalConfig = new GlobalConfig();

if ($globalConfig->getConf()->getExecDebugEnable()) {
    $exec_debug_time_stop = microtime(true);
    $exec_debug_time_show = round($exec_debug_time_stop - $_SESSION['exec_debug_time_start'], 4) . ' seconds';

    $show_queries_info_popup = DatabaseOperation::showPopupForQueriesInfo();
    $message = print_r($_SESSION['mysql_column_info'], true);
    $show_php_session = popup('popup_php_session', $message, 'PHP' . ' - ' . $exec_debug_time_show);
    foreach ($_SESSION['queriesInfo'] as $value) {
        $time = $value['time_complete'];
    }

    $debug_info = ' | ' . $show_queries_info_popup . ' | ' . $show_php_session . ' | ' . $time;
}



echo '</td>';
echo '</tr>';
echo '</table>';
echo ' <table width=100% height=100%>
        <tr align=right>
            <td>
                <small>
                    <a href=#>Haut de page.' . $debug_info . '></a>
                </small>
            </td>
        </tr>
        <tr align=right>
            <td>
                <small>Intranet LDC - 2015 </small>
            </td>
        </tr>

    </table></div>';
echo '</body>';
echo '</html>';
?>



</html>

