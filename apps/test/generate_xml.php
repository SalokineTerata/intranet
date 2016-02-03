<?php

/*
 * Copyright (C) 2016 tp4300001
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
$paramIdFta = "14790";
$sautDeLigne = "\n";
$tabulation = "\t";
$espace = "\r";
$action = "update";
//$arrayFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
//                "SELECT " . FtaModel::KEYNAME
//                . ", " . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE
//                . ", " . FtaModel::FIELDNAME_LIBELLE
//                . ", " . FtaModel::FIELDNAME_CODE_ARTICLE_LDC
//                . " FROM " . FtaModel::TABLENAME
//                . " WHERE " . FtaModel::KEYNAME . "=" . $paramIdFta
//);
/**
 * Historique en BDD
 */
//$keyProposal = Fta2ArcadiaTransactionModel::createNewRecordset($value[FtaModel::FIELDNAME_CODE_ARTICLE_LDC]);
//$fta2ArcadiaTrasactionModel = new Fta2ArcadiaTransactionModel($keyProposal);
//$fta2ArcadiaTrasactionModel->getDataField(Fta2ArcadiaTransactionModel::FIELDNAME_TAG_TYPE_TRANSACTION)->setFieldValue($action);
//$fta2ArcadiaTrasactionModel->saveToDatabase();

$xmlstr = '<?xml version="1.0" encoding="UTF-8" ?>' . $sautDeLigne . $espace;
//foreach ($arrayFta as $value) {
//    $xmlstr .= "<Transaction id=\"" . $keyProposal . "\" version=\"1.1\" type=\"proposal\">" . $sautDeLigne
//            . $tabulation . "<Parameters>" . $sautDeLigne
//            . $tabulation . $tabulation . "<IdFirm>40" . "</IdFirm><!-- Agis -->" . $sautDeLigne
//            . $tabulation . $tabulation . "<IdArcadia>" . $value[FtaModel::FIELDNAME_CODE_ARTICLE_LDC] . "</IdArcadia><!-- Code article dans Arcadia -->" . $sautDeLigne
//            . $tabulation . $tabulation . "<IdFta>" . $value[FtaModel::KEYNAME] . "</IdFta><!-- N° de la FTA -->" . $sautDeLigne
//            . $tabulation . "</Parameters>" . $sautDeLigne
//            . $tabulation . "<Tables>" . $sautDeLigne
//            . $tabulation . $tabulation . "<ARTICLE_REF>" . $sautDeLigne
//            . $tabulation . $tabulation . $tabulation . "<DataToImport>" . $sautDeLigne
//            . $tabulation . $tabulation . $tabulation . $tabulation . "<Recordset id=\"1\" action=\"" . $action . "\">" . $sautDeLigne
//            . $espace . $sautDeLigne
//            . $tabulation . $tabulation . $tabulation . $tabulation . $tabulation . "<!-- Entête -->" . $sautDeLigne
//            . $tabulation . $tabulation . $tabulation . $tabulation . $tabulation . "<NO_ART key=\"TRUE\">" . $value[FtaModel::FIELDNAME_CODE_ARTICLE_LDC] . "</NO_ART>" . $sautDeLigne
//            . $tabulation . $tabulation . $tabulation . $tabulation . $tabulation . "<LIB_CCIAL><![CDATA[" . $value[FtaModel::FIELDNAME_LIBELLE] . "]]></LIB_CCIAL><!-- DIN de la FTA -->" . $sautDeLigne
//            . $tabulation . $tabulation . $tabulation . $tabulation . $tabulation . "<LIB_PRODUCTION><![CDATA[" . $value[FtaModel::FIELDNAME_LIBELLE] . "]]></LIB_PRODUCTION><!-- DIN de la FTA -->" . $sautDeLigne
//            . $espace . $sautDeLigne
//            . $tabulation . $tabulation . $tabulation . $tabulation . "</Recordset>" . $sautDeLigne
//            . $tabulation . $tabulation . $tabulation . "</DataToImport>" . $sautDeLigne
//            . $tabulation . $tabulation . "</ARTICLE_REF>" . $sautDeLigne
//            . $tabulation . "</Tables>" . $sautDeLigne
//            . "</Transaction>" . $sautDeLigne
//            . $sautDeLigne;
//}



//file_put_contents("../../eai/export/fta2arcadia-40-" . $keyProposal . "-" . $value[FtaModel::FIELDNAME_CODE_ARTICLE_LDC] . "-proposal.xml", $xmlstr);
$ftaModel = new FtaModel($paramIdFta);
$fta2ArcadiaContoller = new Fta2ArcadiaController($ftaModel, $action);

//// Instance de la class DomDocumen
//$xml = new DOMDocument();
//
//// Definition du prologue :  la version et l'encodage
//$xml->version = "1.0";
//$xml->encoding = "UTF-8";
//https://openclassrooms.com/forum/sujet/creer-un-fichier-xml-puis-demander-de-l-enregistrer-14428