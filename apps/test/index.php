<?php

//require_once '../inc/main.php';
//print_page_begin($disable_full_page, $menu_file);

echo "<h1><table>";
foreach ($_SERVER as $key => $value) {

    echo "<tr><td>$key</td><td>$value</td></tr>";
}
echo "</table></h1>";
;
