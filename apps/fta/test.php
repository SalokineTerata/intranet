<?php

$_SESSION["session_init"] = false;

require_once "../inc/main.php";

/**
 * Code PHP de test
 */
$array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "Select " . FtaModel::KEYNAME . "," . FtaModel::FIELDNAME_ID_FTA_ETAT . " FROM " . FtaModel::TABLENAME
);
foreach ($array as $value) {
    $idFta = $value[FtaModel::KEYNAME];
    $idFtaEtat = $value[FtaModel::FIELDNAME_ID_FTA_ETAT];
    if ($idFtaEtat == "3") {
        $req = "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_POURCENTAGE_AVANCEMENT . "='" . "100%" . "' "
                . " WHERE " . FtaModel::KEYNAME . "='" . $idFta . "' "
        ;
        DatabaseOperation::execute($req);
    }
}
/**
 * Code HTML
 */
echo "<!DOCTYPE html><html><body>";
echo "Page de test";
echo $listHtlm;
echo "</body></html>";
?>
