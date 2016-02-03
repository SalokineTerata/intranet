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
        $dateCreationtmp = $rowsdate[FtaModel::FIELDNAME_DATE_CREATION];
        $dateDerniereMajFtatmp = $rowsdate[FtaModel::FIELDNAME_DATE_DERNIERE_MAJ_FTA];
        if (FtaController::isCheckDateFormat($dateEcheanceFtatmp)
                or FtaController::isCheckDateFormat($dateCreationtmp)
                or FtaController::isCheckDateFormat($dateDerniereMajFtatmp)) {
            $idFta = $rowsdate[FtaModel::KEYNAME];
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
}
$arraydatesuivieprojet = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT " . FtaSuiviProjetModel::FIELDNAME_DATE_VALIDATION_SUIVI_PROJET
                . "," . FtaSuiviProjetModel::KEYNAME
                . " FROM " . FtaSuiviProjetModel::TABLENAME
);
if ($arraydatesuivieprojet) {
    foreach ($arraydatesuivieprojet as $rowsdatesuivieprojet) {
        $dateValidationFtatmp = $rowsdatesuivieprojet[FtaSuiviProjetModel::FIELDNAME_DATE_VALIDATION_SUIVI_PROJET];
        if (FtaController::isCheckDateFormat($dateValidationFtatmp)) {
            $idFtaSuiviProjet = $rowsdatesuivieprojet[FtaSuiviProjetModel::KEYNAME];
            $dateValidationFta = correctionDateBDD($dateValidationFtatmp);
            $validation = DatabaseOperation::execute(
                            "UPDATE " . FtaSuiviProjetModel::TABLENAME
                            . " SET " . FtaSuiviProjetModel::FIELDNAME_DATE_VALIDATION_SUIVI_PROJET . "=\"" . $dateValidationFta
                            . "\" WHERE " . FtaModel::KEYNAME . "=" . $idFtaSuiviProjet);
            if ($validation) {
                echo FtaSuiviProjetModel::KEYNAME . "=" . $idFtaSuiviProjet . " OK ";
            } else {
                echo FtaSuiviProjetModel::KEYNAME . "=" . $idFtaSuiviProjet . " FAILDED ";
            }
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
