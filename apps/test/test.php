<?php
require_once '../inc/main.php';
print_page_begin($disable_full_page, $menu_file);
flush();

//
//$arrayValue = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
//                "SELECT " . FtaComposantModel::KEYNAME . "," . "etiquette_fta_composition"
//                . " FROM " . FtaComposantModel::TABLENAME
//                . " WHERE " . FtaModel::KEYNAME . "=" . "14871"
//);
//$nombreValue = count($arrayValue);
//$i = 0;
//foreach ($arrayValue as $value) {
//    $arrayIdFtaComposantSecondaire = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
//                    "SELECT " . FtaComposantModel::KEYNAME . "," . "etiquette_fta_composition"
//                    . " FROM " . FtaComposantModel::TABLENAME
//                    . " WHERE " . FtaModel::KEYNAME . "=" . "14864"
//    );
//
//
//
//    
//
//    $i++;
//}


//$reqFamilleBudget = "SELECT DISTINCT " . ArcadiaFamilleBudgetModel::KEYNAME . "," . ArcadiaFamilleBudgetModel::KEYNAME
//        . " FROM " . ArcadiaFamilleBudgetModel::TABLENAME
//        . " ORDER BY " . ArcadiaFamilleBudgetModel::KEYNAME;
//$statementreseult = DatabaseOperation::queryPDO($reqFamilleBudget);
//$arrayClassificationArcadiaFamilleBudget = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray($reqFamilleBudget);
//$id = "150";
//foreach ($arrayClassificationArcadiaFamilleBudget as $key => $value) {
//    if()
//}
//$result = in_array($id, $arrayClassificationArcadiaFamilleBudget);
//if ($result) {
//
//    $franck = "franck";
//}

echo "
<form>
    <label for=search>Pays:</label>
    <input onclick=test() type=text id=recherche />
</form>
";

/* * *********************
  Inclusion de fin de page
 * ********************* */
include ('../lib/fin_page.inc');