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

/**
 * Description of StaticStandardModel
 *
 * @author franckwastaken
 */
class StaticStandardModel {

    const PRIMARY_KEY = "PRI";
    const KEY = "Key";
    const FIELD = "Field";
    const LAST = "last";
    const FALSE = FALSE;

    /**
     * On return le nom de la clé primaire d'une table donnée
     * @param string $paramTable
     * @return string
     */
    public static function getPrimaryFieldName(

    $paramTable) {
    $arrayKeyField = DatabaseOperation::convertSqlStatementWithoutKeyToArray("DESC " . $paramTable);
    foreach ($arrayKeyField as $value) {
        if ($value[self::KEY] == self::PRIMARY_KEY) {
            $primaryFieldName = $value[self::FIELD];
        }
    }
    return $primaryFieldName;
}

/**
 * Retourn la nouvelle clé de l'engregistrement.
 * @param string $paramTable
 * @param string $paramId
 * @return int
 */
public static function duplicateRowsById($paramTable, $paramId) {
    $primaryFieldName = self::getPrimaryFieldName($paramTable);


    $arrayField = DatabaseOperation::getArrayFiledsNamesTable($paramTable);
    $separation = "";
    foreach ($arrayField as $nomColumn) {
        if ($nomColumn <> $primaryFieldName) {
            $tableListe .= $separation . $nomColumn;
            $separation = ",";
        }
    }
    $req = " INSERT INTO " . $paramTable . " (" . $tableListe . ") "
            . " SELECT " . $tableListe
            . " FROM " . $paramTable
            . " WHERE " . $primaryFieldName . "=" . $paramId;

    $pdo = DatabaseOperation::executeComplete($req);

    $key = $pdo->lastInsertId();

    return $key;
}

/**
 * Duplique la table résultat de la clé étrangère
 * @param string $paramTable
 * @param string $paramId
 * @return int
 */
public static function duplicateRowsByIdReplaceLast($paramTable, $paramIdOLD, $paramIdNew) {
    
    /**
     * On récupère le nom du champ primaire de la table
     */
    $primaryFieldName = self::getPrimaryFieldName($paramTable);


    $arrayField = DatabaseOperation::getArrayFiledsNamesTable($paramTable);
    $separation = "";
    $separation2 = "";
    foreach ($arrayField as $nomColumn) {
        if ($nomColumn <> $primaryFieldName) {
            $tableListeInsert .= $separation . $nomColumn;
            $separation = ",";
        }
        if (stripos($nomColumn, self::LAST) === self::FALSE) {
            if ($nomColumn == FtaModel::KEYNAME) {
                $nomColumn = $paramIdNew;
            }
            $tableListeSelect .= $separation2 . $nomColumn;
            $separation2 = ",";
        }
    }
    $req = " INSERT INTO " . $paramTable . " (" . $tableListeInsert . ") "
            . " SELECT " . $tableListeSelect
            . " FROM " . $paramTable
            . " WHERE " . FtaModel::KEYNAME . "=" . $paramIdOLD;

    DatabaseOperation::executeComplete($req);
}

}
