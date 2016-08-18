<?php

/*
 * Copyright (C) 2016 fa4301632
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once '../inc/main.php';
$idFta= Lib::getParameterFromRequest(FtaModel::KEYNAME);



$term = Lib::getParameterFromRequest("term");
//$companies = array(
//    array("label" => "JAVA", "value" => "1"),
//    array("label" => "DATA IMAGE PROCESSING", "value" => "2"),
//    array("label" => "JAVASCRIPT", "value" => "3"),
//    array("label" => "DATA MANAGEMENT SYSTEM", "value" => "4"),
//    array("label" => "COMPUTER PROGRAMMING", "value" => "5"),
//    array("label" => "SOFTWARE DEVELOPMENT LIFE CYCLE", "value" => "6"),
//    array("label" => "LEARN COMPUTER FUNDAMENTALS", "value" => "7"),
//    array("label" => "IMAGE PROCESSING USING JAVA", "value" => "8"),
//    array("label" => "CLOUD COMPUTING", "value" => "9"),
//    array("label" => "DATA MINING", "value" => "10"),
//    array("label" => "DATA WAREHOUSE", "value" => "11"),
//    array("label" => "E-COMMERCE", "value" => "12"),
//    array("label" => "DBMS", "value" => "13"),
//    array("label" => "HTTP", "value" => "14")
//);

$requete = 'SELECT ' . AnnexeEmballageGroupeModel::KEYNAME . ',' . AnnexeEmballageGroupeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE
        . ' FROM ' . AnnexeEmballageGroupeModel::TABLENAME
        . ' WHERE ' . AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION . $op . $idAnnexeEmballageGroupeType //Emballage Primaire et UVC
        . ' ORDER BY ' . AnnexeEmballageGroupeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE
;

$arrayTmp = DatabaseOperation::convertSqlStatementWithKeyAsFirstFieldToArray($requete);

if ($arrayTmp) {
    foreach ($arrayTmp as $key => $rows) {
        $companies[] = array(
            "label" => $rows[AnnexeEmballageGroupeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE],
            "value" => $key,
        );
    }
} else {
    $companies = 0;
}




$result = array();
foreach ($companies as $company) {
//    $companyLabel = $company["label"];
    $companyLabel = $company["label"];

    if (strpos(strtoupper($companyLabel), strtoupper($term)) !== false) {
        array_push($result, $company);
    }
}
$franck = $result;
echo json_encode($result);

