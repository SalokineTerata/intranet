<?php

require_once '../inc/php.php';

$arraydate = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT " . FtaModel::FIELDNAME_DATE_ECHEANCE_FTA . "," . FtaModel::KEYNAME
                . "," . FtaModel::FIELDNAME_DATE_CREATION
                . "," . FtaModel::FIELDNAME_DATE_DERNIERE_MAJ_FTA
                . " FROM " . FtaModel::TABLENAME
);
if ($arraydate) {
    foreach ($arraydate as $rowsdate) {
        $dateEcheanceFtatmp = $rowsdate[FtaModel::FIELDNAME_DATE_ECHEANCE_FTA];
        $idFta = $rowsdate[FtaModel::KEYNAME];
        $dateCreationtmp = $rowsdate[FtaModel::FIELDNAME_DATE_CREATION];
        $dateDerniereMajFtatmp = $rowsdate[FtaModel::FIELDNAME_DATE_DERNIERE_MAJ_FTA];

        $dateEcheanceFta = correctionDateBDD($dateEcheanceFtatmp);
        $dateCreation = correctionDateBDD($dateCreationtmp);
        $dateDerniereMajFta = correctionDateBDD($dateDerniereMajFtatmp);

        $validation = DatabaseOperation::execute(
                        "UPDATE " . FtaModel::TABLENAME
                        . " SET " . FtaModel::FIELDNAME_DATE_ECHEANCE_FTA . "=\"" . $dateEcheanceFta
                        . "\"," . FtaModel::FIELDNAME_DATE_CREATION . "=\"" . $dateCreation
                        . "\"," . FtaModel::FIELDNAME_DATE_DERNIERE_MAJ_FTA . "=\"" . $dateDerniereMajFta
                        . "\" WHERE " . FtaModel::KEYNAME . "=" . $idFta);
        if ($validation) {
            echo FtaModel::KEYNAME . "=" . $idFta . " OK ";
        } else {
            echo FtaModel::KEYNAME . "=" . $idFta . " FAILDED ";
        }
    }
}

function correctionDateBDD($paramValeurDate) {
    $checkValue = FtaController::isCheckDateFormat($paramValeurDate);
    if ($checkValue) {
        /**
         * Extraction de l'année
         * Format Français
         */
        $annee = substr($paramValeurDate, 6, 9);
        $mois = substr($paramValeurDate, 3, 2);
        $jours = substr($paramValeurDate, 0, 2);
    } else {
        /**
         * Extraction de l'année
         * Format Anglais
         */
        $annee = substr($paramValeurDate, 0, 4);
        $mois = substr($paramValeurDate, 5, 2);
        $jours = substr($paramValeurDate, 8, 2);
    }
    $return = $annee . "-" . $mois . "-" . $jours;
    return $return;
}
