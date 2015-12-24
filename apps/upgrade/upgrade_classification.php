<?php

require_once '../inc/php.php';

$arrayClassifIncomplete = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT " . ClassificationFta2Model::KEYNAME
                . " FROM " . ClassificationFta2Model::TABLENAME
                . " WHERE " . ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE . "=" . "0"
);

foreach ($arrayClassifIncomplete as $rowsClassifInComplete){
    
}
?>
