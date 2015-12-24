<?php

require_once '../inc/php.php';

$arrayClassifIncomplete = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT " . ClassificationFta2Model::KEYNAME . "," . ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE
                . " FROM " . ClassificationFta2Model::TABLENAME
                . " WHERE " . ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE . "=" . "0"
);
if($arrayClassifIncomplete){
foreach ($arrayClassifIncomplete as $rowsClassifInComplete) {
    $idProprietaireGroupe = $rowsClassifInComplete[ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE];
    $IdFtaClassification2 = $rowsClassifInComplete[ClassificationFta2Model::KEYNAME];
    $validation = DatabaseOperation::execute(
                    "UPDATE " . ClassificationFta2Model::TABLENAME
                    . " SET " . ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE . "=" . $idProprietaireGroupe
                    . " WHERE " . ClassificationFta2Model::KEYNAME . "=" . $IdFtaClassification2);
    if ($validation) {
        echo ClassificationFta2Model::KEYNAME . "=" . $IdFtaClassification2 . " OK ";
    } else {
        echo ClassificationFta2Model::KEYNAME . "=" . $IdFtaClassification2 . " FAILDED ";
    }
}}else{
   echo "Vous vennez d'executer un script interdit <br> CONTACTEZ IMMEDIATEMENT L'ADMINISTRATEUR DU SITE!!!!!!!!!!!!!";
}

?>
