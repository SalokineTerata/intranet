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
 * Description of Fta2ArcadiaTransactionModel
 *
 * @author franckwastaken
 */
class Fta2ArcadiaTransactionModel extends AbstractModel {

    const TABLENAME = 'fta2arcadia_transaction';
    const KEYNAME = 'id_arcadia_transaction';
    const FIELDNAME_CODE_ARTICLE_LDC = 'code_article_ldc';
    const FIELDNAME_TAG_TYPE_TRANSACTION = 'tag_type_transaction';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

    /**
     * Valeurs par défaut en cas de création
     * d'un nouvel enregistrement
     * @param type $paramForeignKeysValuesArray
     * @return type
     */
    static public function createNewRecordset($paramForeignKeysValuesArray = NULL) {
        $pdo = DatabaseOperation::executeComplete(
                        'INSERT INTO ' . self::TABLENAME
                        . '(' . self::KEYNAME
                        . ',' . self::FIELDNAME_CODE_ARTICLE_LDC
                        . ',' . self::FIELDNAME_TAG_TYPE_TRANSACTION
                        . ')'
                        . 'VALUES (' . "\"NULL\""
                        . ',' . "\"" . $paramForeignKeysValuesArray . "\""
                        . ',' . "\"" . "\""
                        . ')'
        );
        $key = $pdo->lastInsertId();
        return $key;
    }

}
