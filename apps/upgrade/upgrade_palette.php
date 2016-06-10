<?php

require_once '../inc/php.php';

$arrayPalette = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT " . FtaModel::KEYNAME
                . " FROM " . FtaModel::TABLENAME
                . " WHERE " . FtaModel::KEYNAME . " NOT IN "
                . " (SELECT " . FtaModel::KEYNAME
                . " FROM " . FtaConditionnementModel::TABLENAME
                . " WHERE " . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE . "=" . "126)"
                
);
if ($arrayPalette) {
    foreach ($arrayPalette as $rowsClassifInComplete) {
        $idFta = $rowsClassifInComplete[FtaModel::KEYNAME];
        FtaConditionnementModel::createPalette($idFta);
    }
} else {
    echo "Vous vennez d'executer un script interdit <br> CONTACTEZ IMMEDIATEMENT L'ADMINISTRATEUR DU SITE!!!!!!!!!!!!!";
}
?>
