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
<form method=get action=test_post.php>
    <label for=search>TEST:</label>
    <input onclick=test() type=text id=recherche name=recherche />
    <input type=hidden name=rechercheid id=rechercheid />
    <input name=submit type=submit value=valider>
    <br>
    <label >Liste des toutes les Fiches Techniques Emballages (FTE): </label>
    <input onclick=listeEmballage() type=text id=emballage name=emballage />
    <input type=hidden name=emballageid id=emballageid />
    <input name=submit type=submit value=valider>
</form>
";

/* * *********************
  Inclusion de fin de page
 * ********************* */
include ('../lib/fin_page.inc');