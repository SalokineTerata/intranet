<?php
//http://stackoverflow.com/questions/2071024/treating-warnings-as-errors
function stacktrace_error_handler($errno, $message, $file, $line, $context) {
    if ($errno === E_WARNING) {
        debug_print_backtrace();
    }
    return false; // to execute the regular error handler
}

set_error_handler("stacktrace_error_handler");

require_once("../inc/php.php");
?>
