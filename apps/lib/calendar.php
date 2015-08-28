<?php
/* $Id: calendar.php,v 2.5 2004/09/07 11:45:46 nijel Exp $ */

/* require_once('./libraries/grab_globals.lib.php');
require_once('./libraries/common.lib.php');
require_once('./libraries/header_http.inc.php');
 */

//require_once('../lib/phpmyadmin/grab_globals.lib.php');
//require_once('../lib/phpmyadmin/common.lib.php');
//require_once('../lib/phpmyadmin/header_http.inc.php');
require_once ('../lib/phpmyadmin/tbl_change.js');

$month=array(1, 2, 3);
$day_of_week=array(1, 2, 3);

$HTML = ' <script type=text/javascript>'
. '<!--'
//. 'var month_names = new Array('.implode('','', $month).');'
//. 'var day_names = new Array('.implode('','', $day_of_week).');'
. '//-->'
. '</script>'
. '<head>'
. '<link rel=stylesheet href=../lib/phpmyadmin/phpmyadmin.css type=text/css>'
. '</head>'
. '<body onload=initCalendar();>'
. '<div id=calendar_data></div>'
. '<div id=clock_data></div>'
//. '<br><a href=javascript:reload() />Actualiser</a>'
. '</body>'
. '</html>'
;

echo $HTML;
?>