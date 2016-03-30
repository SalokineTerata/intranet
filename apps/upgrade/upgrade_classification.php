<?php

require_once '../inc/php.php';

$arrayClassifIncomplete = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT " . FtaModel::FIELDNAME_DOSSIER_FTA . "," . FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2
                . " FROM " . FtaModel::TABLENAME
                . " WHERE " . FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2 . " IS NOT NULL " 
                . " GROUP BY " . FtaModel::FIELDNAME_DOSSIER_FTA 
);
if($arrayClassifIncomplete){
foreach ($arrayClassifIncomplete as $rowsClassifInComplete) {
    $idDossierFta = $rowsClassifInComplete[FtaModel::FIELDNAME_DOSSIER_FTA];
    $IdFtaClassification2 = $rowsClassifInComplete[FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2];
    $validation = DatabaseOperation::execute(
                    "UPDATE " . FtaModel::TABLENAME
                    . " SET " . FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2 . "=" . $IdFtaClassification2
                    . " WHERE " . FtaModel::FIELDNAME_DOSSIER_FTA . "=" . $idDossierFta
                    . " AND " . FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2 . " IS NULL ");
    if ($validation) {
        echo FtaModel::FIELDNAME_DOSSIER_FTA . "=" . $idDossierFta . " OK ";
    } else {
        echo FtaModel::FIELDNAME_DOSSIER_FTA . "=" . $idDossierFta . " FAILDED ";
    }
}}else{
   echo "Vous vennez d'executer un script interdit <br> CONTACTEZ IMMEDIATEMENT L'ADMINISTRATEUR DU SITE!!!!!!!!!!!!!";
}

?>
