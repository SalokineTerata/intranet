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
    const FIELDNAME_ID_FTA = 'id_fta';
    const FIELDNAME_CODE_ARTICLE_LDC = 'code_article_ldc';
    const FIELDNAME_TAG_TYPE_TRANSACTION = 'tag_type_transaction';
    const FIELDNAME_CODE_REPLY = 'code_reply';
    const FIELDNAME_ACTIF = 'actif';
    const FIELDNAME_DATE_ENVOI = 'date_envoi';
    const FIELDNAME_ID_USER = 'id_user';
    const FIELDNAME_DATE_RETOUR = 'date_retour';
    const FIELDNAME_NOTIFICATION_MAIL = 'notification_mail';
    const OUI = '1';
    const NON = '0';
    const CONSOMME = '0';
    const REJET_TASKS = '1';
    const REFUSE = '2';
    const CLOTURE_AUTO = '4';
    const XML = 'XML';
    const SUMMARY_PAGE = 'summary_page';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

    /**
     * Valeurs par défaut en cas de création
     * d'un nouvel enregistrement
     * @param array $paramForeignKeysValuesArray
     * @return int
     */
    static public function createNewRecordset($paramForeignKeysValuesArray = NULL) {
        $pdo = DatabaseOperation::executeComplete(
                        'INSERT INTO ' . self::TABLENAME
                        . '(' . self::KEYNAME
                        . ',' . self::FIELDNAME_ID_FTA
                        . ',' . self::FIELDNAME_CODE_ARTICLE_LDC
                        . ',' . self::FIELDNAME_TAG_TYPE_TRANSACTION
                        . ',' . self::FIELDNAME_ACTIF
                        . ',' . self::FIELDNAME_DATE_ENVOI
                        . ',' . self::FIELDNAME_ID_USER
                        . ')'
                        . 'VALUES (' . "\"NULL\""
                        . ',' . "\"" . $paramForeignKeysValuesArray[self::FIELDNAME_ID_FTA] . "\""
                        . ',' . "\"" . $paramForeignKeysValuesArray[self::FIELDNAME_CODE_ARTICLE_LDC] . "\""
                        . ',' . "\"" . "\""
                        . ',' . "\"" . self::OUI . "\""
                        . ',' . "\"" . $paramForeignKeysValuesArray[self::FIELDNAME_DATE_ENVOI] . "\""
                        . ',' . "\"" . $paramForeignKeysValuesArray[self::FIELDNAME_ID_USER] . "\""
                        . ')'
        );
        $key = $pdo->lastInsertId();
        return $key;
    }

    /**
     * On vérifie si l'utilisateur connecter est le propriétaire de la transaction en cours.
     * @return boolean
     */
    function isEditableNotificationMail() {
        $globalConf = new GlobalConfig();
        $idUser = $globalConf->getAuthenticatedUser()->getKeyValue();
        $idUserRegister = $this->getDataField(self::FIELDNAME_ID_USER)->getFieldValue();

        if ($idUser == $idUserRegister) {
            $isEditable = Chapitre::EDITABLE;
        } else {
            $isEditable = Chapitre::NOT_EDITABLE;
        }
        return $isEditable;
    }

    /**
     * On vérifie si pour l'id Fta en cours un id Transaction existe
     * @param int $paramIdFta
     * @return int
     */
    public static function checkIdArcadiaTransaction($paramIdFta) {
        $arrayCheck = DatabaseOperation::convertSqlStatementWithoutKeyToArrayComplete(
                        "SELECT " . self::KEYNAME
                        . " FROM " . self::TABLENAME
                        . " WHERE " . self::FIELDNAME_ID_FTA . "=" . $paramIdFta
                        . " AND " . self::FIELDNAME_ACTIF . "=" . self::OUI
                        . " ORDER BY " . self::KEYNAME . " DESC "
        );

        if ($arrayCheck) {
            $key = $arrayCheck["0"];
            self::updateIdArcadiaTransaction($paramIdFta, $key);
        } else {
            $key = NULL;
        }

        return $key;
    }

    /**
     * On vérifie si il y a une transaction actif et on retour l'information
     * @param int $paramIdFta
     * @return string
     */
    public static function isIdArcadiaTransactionActif($paramIdFta) {
        $checkArcadiaData = "";
        $keyValue = Fta2ArcadiaTransactionModel::checkIdArcadiaTransaction($paramIdFta);
        if ($keyValue) {
            $fta2ArcadiaTransactionModel = new Fta2ArcadiaTransactionModel($keyValue);
            $codeReply = $fta2ArcadiaTransactionModel->getDataField(self::FIELDNAME_CODE_REPLY)->getFieldValue();
            if ($codeReply == NULL or $codeReply == self::CONSOMME) {
                $checkArcadiaData = "ok";
            }
        }
        return $checkArcadiaData;
    }

    /**
     * On retourne le code reply de la transaction en cours
     * @param int $paramIdFta
     * @return boolean
     */
    public static function getCodeReplyByIdFta($paramIdFta) {
        $key = self::checkIdArcadiaTransaction($paramIdFta);
        if ($key) {
            $fta2ArcadiaTransactionModel = new Fta2ArcadiaTransactionModel($key);
            $codeReply = $fta2ArcadiaTransactionModel->getDataField(self::FIELDNAME_CODE_REPLY)->getFieldValue();
        } else {
            $codeReply = FALSE;
        }
        return $codeReply;
    }

    /**
     * On désactive pour l'id Fta en cours son id Transaction
     * @param int $paramIdFta
     */
    public static function cancelIdArcadiaTransaction($paramIdFta) {
        $arrayCheck = DatabaseOperation::convertSqlStatementWithoutKeyToArrayComplete(
                        "SELECT " . self::KEYNAME
                        . " FROM " . self::TABLENAME
                        . " WHERE " . self::FIELDNAME_ID_FTA . "=" . $paramIdFta
                        . " AND " . self::FIELDNAME_ACTIF . "=" . self::OUI
                        . " ORDER BY " . self::KEYNAME . " DESC "
        );

        if ($arrayCheck) {
            $key = $arrayCheck["0"];
            DatabaseOperation::execute(
                    "UPDATE " . self::TABLENAME
                    . " SET " . self::FIELDNAME_ACTIF . "=" . self::NON
                    . " WHERE " . self::KEYNAME . "=" . $key
            );
        }
    }

    /**
     * Désactivation des anciennes transactions
     * @param int  $paramIdFta
     * @param int $paramIdArcadiaTransaction
     */
    public static function updateIdArcadiaTransaction($paramIdFta, $paramIdArcadiaTransaction) {
        $arrayCheck = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . self::KEYNAME
                        . " FROM " . self::TABLENAME
                        . " WHERE " . self::FIELDNAME_ID_FTA . "=" . $paramIdFta
                        . " AND " . self::KEYNAME . "<>" . $paramIdArcadiaTransaction
                        . " ORDER BY " . self::KEYNAME . " DESC "
        );

        if ($arrayCheck) {
            foreach ($arrayCheck as $rowsCheck) {
                $sql = "UPDATE " . self::TABLENAME
                        . " SET " . self::FIELDNAME_ACTIF . "=" . self::NON
                        . " WHERE " . self::KEYNAME . "=" . $rowsCheck[self::KEYNAME];
                DatabaseOperation::execute($sql);
            }
        }
    }

    /**
     * Retour la  requète SQL MAJ la transaction en cours
     * @param string $paramNameOfBDDTarget
     * @param string $paramCodeReply
     * @param string $paramCodeArticleArcadia
     * @param string $paramIdFta
     * @param string $paramIdTransaction
     * @return string
     */
    public static function getSQLUpdateFta2ArcadiaTransaction(
    $paramNameOfBDDTarget, $paramCodeReply, $paramCodeArticleArcadia, $paramIdFta, $paramIdTransaction) {
        $req = "UPDATE " . "`" . $paramNameOfBDDTarget . "`" . "." . self::TABLENAME
                . " SET " . self::FIELDNAME_CODE_REPLY . "='" . $paramCodeReply
                . "', " . self::FIELDNAME_CODE_ARTICLE_LDC . "='" . $paramCodeArticleArcadia
                . "', " . self::FIELDNAME_DATE_RETOUR . "='" . date("Y-m-d H:i:s")
                . "' WHERE " . self::FIELDNAME_ID_FTA . "='" . $paramIdFta
                . "' AND " . self::KEYNAME . "='" . $paramIdTransaction . "'";

        return $req;
    }

    /**
     * On vérifie si la transaction en cours est actif
     * @param string $paramNameOfBDDTarget
     * @param string $paramIdTransaction
     * @return string
     */
    public static function getSQLIdUserMailNotifFta2ArcadiaTransaction(
    $paramNameOfBDDTarget, $paramIdTransaction) {
        $req = "SELECT DISTINCT " . self::FIELDNAME_ACTIF
                . ", " . self::FIELDNAME_NOTIFICATION_MAIL
                . ", " . self::FIELDNAME_ID_USER
                . " FROM " . "`" . $paramNameOfBDDTarget . "`" . "." . self::TABLENAME
                . " WHERE " . self::KEYNAME . "= '" . $paramIdTransaction . "'";

        return $req;
    }

}
