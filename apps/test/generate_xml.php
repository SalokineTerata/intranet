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
$arrayFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT " . FtaModel::KEYNAME
                . ", " . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE
                . ", " . FtaModel::FIELDNAME_LIBELLE
                . ", " . FtaModel::FIELDNAME_CODE_ARTICLE_LDC
                . " FROM " . FtaModel::TABLENAME
                . " WHERE " . FtaModel::KEYNAME . "=" . $paramIdFta
);
$xmlstr = '<?xml version="1.0" encoding="UTF-8" ?>' . $sautDeLigne . $espace;
foreach ($arrayFta as $value) {
    $xmlstr .= "<Transaction id=\"" . $value[FtaModel::KEYNAME] . "\" version=\"1\" type=\"result\">" . $sautDeLigne
            . $tabulation . "<Parameters>"
            . $tabulation . $tabulation . "<IdArcadia>" . $value[FtaModel::FIELDNAME_CODE_ARTICLE_LDC] . "</IdArcadia><!-- Code article dans Arcadia -->" . $sautDeLigne
            . $tabulation . $tabulation . "<IdFta>" . $value[FtaModel::KEYNAME] . "</IdFta><!-- N° de la FTA -->" . $sautDeLigne
            . $tabulation . "</Parameters>" . $sautDeLigne
            . "</Transaction>" . $sautDeLigne
            . $sautDeLigne;
}



file_put_contents("fta2arcadia-40-" . $value[FtaModel::KEYNAME] . "-" . $value[FtaModel::KEYNAME] . ".xml", $xmlstr);




