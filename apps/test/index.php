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


$donnee = mysql_pconnect("cod-intranet.agis.fr", "root", "8ale!ne");
mysql_select_db("intranet_v3_0_cod");
mysql_query('SET NAMES utf8');
$sqlversion = "SELECT  MAX( id_version_dossier_fta ) as id_version_dossier_fta FROM fta WHERE id_dossier_fta=8228";
                       
        $resultVersionFta =mysql_query($sqlversion);  
        
        $lastVersionDossierFta = mysql_result($resultVersionFta, 0, "id_version_dossier_fta");
 
        $sqldetail = "SELECT id_fta, id_fta_etat, createur_fta, Site_de_production FROM ".$nameOfBDDTarget.".fta WHERE id_dossier_fta=8228 AND id_version_dossier_fta=".$lastVersionDossierFta
               ;
        $resultDossierFtaDetail =mysql_query($sqldetail);
        
         $idfta = mysql_result($resultDossierFtaDetail, 0, "id_fta");
         $idfta2 = mysql_result($resultDossierFtaDetail, 0, "id_fta_etat");
