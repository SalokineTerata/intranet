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

    $exec_debug_time_start = GlobalConfig::getExecDebugTimeStart();
    $exec_debug_time_stop = microtime(true);
    $exec_debug_time_elapsed = $exec_debug_time_stop - $exec_debug_time_start;
    $exec_debug_time_show = round($exec_debug_time_elapsed, 3) . ' seconde(s)';

    $show_queries_info_popup = DatabaseOperation::showPopupForQueriesInfo();
    $message = print_r($_SESSION['mysql_column_info'], true);
    $show_php_session = popup('popup_php_session', $message, 'PHP: ' . $exec_debug_time_show);
    $hrefApiGen = "<a href=" . $globalConfig->getConf()->getUrlApiGen() . ">Documentation ApiGen</a>";

    $debug_info = $show_queries_info_popup . '<br>' . $show_php_session . '<br>' . $hrefApiGen;
}



echo '</td>';
echo '</tr>';
echo '</table>';
echo ' <table width=100% height=100%>
        <tr align=right>
            <td>
                <small>
                    Intranet LDC - 2015 | <a href=#>Haut de page</a><br><br>' . $debug_info . '
                </small>
            </td>
        </tr>
    </table></div>';
echo '</body>';
echo '</html>';
?>



</html>

