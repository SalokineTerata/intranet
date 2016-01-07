<?php

require_once '../inc/php.php';

$arrayClassifIncomplete = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT " . FtaModel::KEYNAME . "," . FtaModel::FIELDNAME_ID_FTA_ETAT
                . " FROM " . FtaModel::TABLENAME
                . " WHERE " . FtaModel::FIELDNAME_WORKFLOW . "=" . "6"
);
if ($arrayClassifIncomplete) {
    foreach ($arrayClassifIncomplete as $rowsClassifInComplete) {
        $idFta = $rowsClassifInComplete[FtaModel::KEYNAME];
        $IdFtaEtat = $rowsClassifInComplete[FtaModel::FIELDNAME_ID_FTA_ETAT];

        /**
         * Initailisation du nouveau chapitre
         */
        FtaSuiviProjetModel::initFtaSuiviProjet($idFta);

        if ($IdFtaEtat <> FtaEtatModel::ID_VALUE_MODIFICATION) {
            $validation = DatabaseOperation::execute(
                            "UPDATE " . FtaSuiviProjetModel::TABLENAME
                            . " SET " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "=" . FtaSuiviProjetModel::SIGNATURE_VALIDATION_SUIVI_PROJET_AUTO
                            . " WHERE " . FtaSuiviProjetModel::FIELDNAME_ID_FTA . "=" . $idFta
                            . " AND " . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . "=" . "41"
            );
            if ($validation) {
                echo FtaSuiviProjetModel::FIELDNAME_ID_FTA . "=" . $idFta . " OK <br>";
            } else {
                echo FtaSuiviProjetModel::FIELDNAME_ID_FTA . "=" . $idFta . " FAILDED <br>";
            }
        } else {
            echo "Cette Id " . $idFta . " Fta n'est pas à validé<br>";
        }
    }
} else {
    echo "<br>Vous vennez d'executer un script interdit <br> CONTACTEZ IMMEDIATEMENT L'ADMINISTRATEUR DU SITE!!!!!!!!!!!!!<br>";
}
