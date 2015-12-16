<?php

//require_once '../inc/main.php';
//print_page_begin($disable_full_page, $menu_file);

echo "<h1><table>";
foreach ($_SERVER as $key => $value) {

    echo "<tr><td>$key</td><td>$value</td></tr>";
}
echo "</table></h1>";
;
$fp = fsockopen("172.20.3.11", 25, $errno, $errstr, 5);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    $out = "GET / HTTP/1.1\r\n";
    $out .= "Host: www.example.com\r\n";
    $out .= "Connection: Close\r\n\r\n";

    echo "$out";
}