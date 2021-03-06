<?php

/**
 * Description of FtaVerrouillageChampsModel
 * Table des FtaVerrouillageChampsModel
 *
 * @author franckwastaken
 */
class FtaVerrouillageChampsModel extends AbstractModel {

    const TABLENAME = 'fta_verrouillage_champs';
    const KEYNAME = 'id_fta_verrouillage_champs	';
    const FIELDNAME_TABLE_NAME = 'table_name';
    const FIELDNAME_FIELD_NAME = 'field_name';
    const FIELDNAME_DOSSIER_FTA_PRIMAIRE = 'dossier_fta_primaire';
    const FIELDNAME_FIELD_LOCK = 'field_lock';
    const FIELDNAME_FIELD_CHANGE_STATE = 'field_change_state';

    /**
     * Si un chanmp verrouillé a été modifié actualiser l'information sur les Fta Secondaires validées
     */
    const CHANGE_STATE_TRUE_VALIDATION_FTA = '2';

    /**
     * Si un chanmp verrouillé a été modifié actualiser l'information sur les Fta Secondaires modifiées
     */
    const CHANGE_STATE_TRUE_VALIDATION_CHAPITRE = '1';

    /**
     * Champ non traité qui doit être synchronisé
     */
    const CHANGE_STATE_FALSE = '0';
    const FIELD_LOCK_TRUE = '1';
    const FIELD_LOCK_FALSE = '0';
    const FIELD_LOCK_PRIMARY_TRUE = '2';
    const FIELD_LOCK_PRIMARY_FALSE = '1';
    const FIELD_LOCK_SECONDARY_TRUE = '4';
    const FIELD_LOCK_SECONDARY_FALSE = '3';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

    /**
     * Suivant l'état actuelle du champs à verrouillé/déverrouillé
     * On modifie l'etat de celui-ci
     */
    function changeStateFieldLock() {
        $lockState = $this->getDataField(FtaVerrouillageChampsModel::FIELDNAME_FIELD_LOCK)->getFieldValue();

        switch ($lockState) {
            case FtaVerrouillageChampsModel::FIELD_LOCK_TRUE:
                $lockState = FtaVerrouillageChampsModel::FIELD_LOCK_FALSE;

                break;
            case FtaVerrouillageChampsModel::FIELD_LOCK_FALSE:
                $lockState = FtaVerrouillageChampsModel::FIELD_LOCK_TRUE;

                break;
        }
        $this->getDataField(FtaVerrouillageChampsModel::FIELDNAME_FIELD_LOCK)->setFieldValue($lockState);

        $this->saveToDatabase();
    }

    /**
     * On récupère l'id du champs et du dossier primaire en cours
     * @param int $paramIdFtaDossierPriamaire
     * @param string $paramFieldName
     * @return int
     */
    public static function getIdFtaVerrouillageChamps($paramIdFtaDossierPriamaire, $paramFieldName) {
        $arrayId = DatabaseOperation::convertSqlStatementWithoutKeyToArrayComplete(
                        "SELECT " . self::KEYNAME
                        . " FROM " . self::TABLENAME
                        . " WHERE " . self::FIELDNAME_DOSSIER_FTA_PRIMAIRE . "=" . $paramIdFtaDossierPriamaire
                        . " AND " . self::FIELDNAME_FIELD_NAME . "=\"" . $paramFieldName . "\""
        );

        if ($arrayId) {
            foreach ($arrayId as $rowsId) {
                $keyValue = $rowsId;
            }
        } else {
            $titre = UserInterfaceMessage::FR_WARNING_DATA_VERROUILLAGE_TITLE;
            $message = UserInterfaceMessage::FR_WARNING_DATA_VERROUILLAGE;
            Lib::showMessage($titre, $message, $redirection);
        }
        return $keyValue;
    }

    /**
     * Retour le tableau donnant la liste de champs  verrouillable
     * @param int $paramIdFtaDossierPrimaire
     */
    public static function getArrayFtaLockByPrimaryFolder($paramIdFtaDossierPrimaire) {
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT DISTINCT " . self::FIELDNAME_TABLE_NAME
                        . "," . self::FIELDNAME_FIELD_NAME
                        . "," . self::FIELDNAME_DOSSIER_FTA_PRIMAIRE
                        . "," . self::FIELDNAME_FIELD_LOCK
                        . " FROM " . self::TABLENAME
                        . " WHERE " . self::FIELDNAME_DOSSIER_FTA_PRIMAIRE . "=" . $paramIdFtaDossierPrimaire
                        . " ORDER BY " . self::FIELDNAME_TABLE_NAME
        );


        return $array;
    }

    /**
     * Suppresion d'un dossier Primaire
     * @param int $paramIdFtaDossierPrimaire
     */
    public static function deletePrimaryFolder($paramIdFtaDossierPrimaire) {
        DatabaseOperation::execute(
                "DELETE FROM " . self::TABLENAME
                . " WHERE " . self::FIELDNAME_DOSSIER_FTA_PRIMAIRE . "=" . $paramIdFtaDossierPrimaire);
    }

    /**
     * Retour le tableau donnant la liste de champs verrouillable lié à ceux par défaut
     * @param int $paramIdFtaDossierPrimaire
     * @return array
     */
    public static function getArrayFtaLockDefaultByPrimaryFolder($paramIdFtaDossierPrimaire) {
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT DISTINCT " . self::FIELDNAME_TABLE_NAME
                        . "," . self::FIELDNAME_FIELD_NAME
                        . "," . self::FIELDNAME_DOSSIER_FTA_PRIMAIRE
                        . "," . self::FIELDNAME_FIELD_LOCK
                        . " FROM " . self::TABLENAME . "," . IntranetColumnInfoModel::TABLENAME
                        . " WHERE " . self::FIELDNAME_DOSSIER_FTA_PRIMAIRE . "=" . $paramIdFtaDossierPrimaire
                        . " AND " . self::FIELDNAME_FIELD_NAME . "=" . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
                        . " AND " . self::FIELDNAME_TABLE_NAME . "=" . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
                        . " AND " . IntranetColumnInfoModel::FIELDNAME_DEFAULT_FIELD_TO_LOCK_FOR_PRIMARY_FTA . "=" . IntranetColumnInfoModel::DEFAULT_FIELD_TO_LOCK_FOR_PRIMARY_FTA_VALUES
                        . " ORDER BY " . self::FIELDNAME_TABLE_NAME
        );

        return $array;
    }

    /**
     * Retour le tableau donnant la liste de champs verrouillés
     * @param int $paramIdFtaDossierPrimaire
     */
    public static function getArrayFtaLockedByPrimaryFolder($paramIdFtaDossierPrimaire) {
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT DISTINCT " . self::FIELDNAME_TABLE_NAME
                        . "," . self::FIELDNAME_FIELD_NAME
                        . "," . self::FIELDNAME_DOSSIER_FTA_PRIMAIRE
                        . "," . self::FIELDNAME_FIELD_LOCK
                        . " FROM " . self::TABLENAME
                        . " WHERE " . self::FIELDNAME_DOSSIER_FTA_PRIMAIRE . "=" . $paramIdFtaDossierPrimaire
                        . " AND " . self::FIELDNAME_FIELD_LOCK . "=" . self::FIELD_LOCK_TRUE
                        . " ORDER BY " . self::FIELDNAME_TABLE_NAME . " DESC"
        );

        return $array;
    }

    /**
     * Retour le tableau donnant la liste de champs à verrouillable
     * @param int $paramIdFtaDossierPrimaire
     */
    public static function getArrayFtaLockChangeStateByPrimaryFolder($paramIdFtaDossierPrimaire, $paramState = NULL) {

        if ($paramState == FtaVerrouillageChampsModel::CHANGE_STATE_TRUE_VALIDATION_CHAPITRE) {
            $paramState = $paramState
                    . " OR " . FtaVerrouillageChampsModel::FIELDNAME_FIELD_CHANGE_STATE . "=" . FtaVerrouillageChampsModel::CHANGE_STATE_FALSE;
        }

        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT DISTINCT " . self::FIELDNAME_TABLE_NAME
                        . "," . self::FIELDNAME_FIELD_NAME
                        . "," . self::FIELDNAME_DOSSIER_FTA_PRIMAIRE
                        . "," . self::FIELDNAME_FIELD_LOCK
                        . " FROM " . self::TABLENAME
                        . " WHERE " . self::FIELDNAME_DOSSIER_FTA_PRIMAIRE . "=" . $paramIdFtaDossierPrimaire
                        . " AND " . self::FIELDNAME_FIELD_CHANGE_STATE . "=" . $paramState
                        . " ORDER BY " . self::FIELDNAME_TABLE_NAME . " DESC"
        );

        return $array;
    }

    /**
     * Retourne l'id_fta de la version validée d'une FTA pour un dossier FTA donné.
     * @param type $paramFtaDossierPrimaire
     * @return type
     */
    private static function getIdFtaValideFromPrimaryDirectory($paramFtaDossierPrimaire) {

        $sql = "SELECT " . FtaModel::KEYNAME . " FROM " . FtaModel::TABLENAME
                . " WHERE " . FtaModel::FIELDNAME_DOSSIER_FTA . " = " . $paramFtaDossierPrimaire
                . " AND " . FtaModel::FIELDNAME_ID_FTA_ETAT . " = " . FtaEtatModel::ID_VALUE_VALIDE
        ;
        $arrayIdFtaValide = DatabaseOperation::convertSqlStatementWithoutKeyToArray($sql);
        switch (count($arrayIdFtaValide)) {
            case 0:
                /**
                 * Ce dossier FTA ne contient aucune version valdiée
                 */
                $return = NULL;
                break;
            case 1:
                /**
                 * Il existe bien une version en état valdié dans ce dosseir FTA
                 */
                $return = $arrayIdFtaValide[0][FtaModel::KEYNAME];
                break;
            default :
                /**
                 * Il existe plusieurs version validée dans ce dossier FTA (impossible)
                 */
                $return = NULL;
        }
        return $return;
    }

    /**
     * Synchronise les données verrouillées de la FTA primaire validée vers les FTA secondaires validées
     * @param int $paramIdFtaPrimaire
     * @param int $paramIdFtaSecondaire
     * @param int $paramFtaDossierPrimaire
     * @param int $paramState
     */
    public static function dataSynchronizeFtaPrimarySecondary($paramIdFtaPrimaire, $paramIdFtaSecondaire, $paramFtaDossierPrimaire, $paramState = NULL) {

        /**
         * Récupération de l'id_fta de la version validée.
         */
        $idFtaPrimaire = self::getIdFtaValideFromPrimaryDirectory($paramFtaDossierPrimaire);

        /**
         * Récupération de la listes des champs verrouillés
         */
        $arrayFtaDossierChampsVerrouiller = self::getArrayFtaLockedByPrimaryFolder($paramFtaDossierPrimaire);

        /**
         * Parcours de chaque champ verrouillé
         */
        if ($arrayFtaDossierChampsVerrouiller and $idFtaPrimaire != NULL) {
            foreach ($arrayFtaDossierChampsVerrouiller as $rowsFtaDossierChampsVerrouiller) {
                $tableName = $rowsFtaDossierChampsVerrouiller[self::FIELDNAME_TABLE_NAME];
                $columnName = $rowsFtaDossierChampsVerrouiller[self::FIELDNAME_FIELD_NAME];
                $fieldLock = $rowsFtaDossierChampsVerrouiller[self::FIELDNAME_FIELD_LOCK];

                /**
                 * On récupère la donnée de la fta primaire
                 */
                switch ($tableName) {
                    case FtaModel::TABLENAME:
                        $arrayValue = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                        "SELECT " . $columnName
                                        . " FROM " . $tableName
                                        . " WHERE " . FtaModel::KEYNAME . "=" . $idFtaPrimaire
                        );
                        break;

                    case FtaComposantModel::TABLENAME:

                        /**
                         * Liste des composants primaires ayant un code semi-fini
                         * et donc à synchroniser.
                         */
                        $arrayListeComposantPrimaire = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                        "SELECT " . FtaComposantModel::KEYNAME . "," . $columnName . "," . FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE
                                        . " FROM " . $tableName
                                        . " WHERE " . FtaModel::KEYNAME . "=" . $idFtaPrimaire
                                        . " AND " . FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE . " IS NOT NULL"
                                        . " AND " . FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE . " != ''"
                        );

                        /**
                         * Liste des composants secondaires ayant un code semi-fini
                         * et donc à synchroniser.
                         */
                        $arrayIdFtaComposantSecondaire = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                        "SELECT " . FtaComposantModel::KEYNAME . "," . $columnName . "," . FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE
                                        . " FROM " . $tableName
                                        . " WHERE " . FtaModel::KEYNAME . "=" . $paramIdFtaSecondaire
                                        . " AND " . FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE . " IS NOT NULL"
                                        . " AND " . FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE . " != ''"
                        );

                        /**
                         * Listes des composants à synchroniser
                         * $arrayFtaComposantToSync[id_fta_composant Primaire] = id_fta_composant Secondaire
                         */
                        $arrayIdFtaComposantToSync = array();

                        /**
                         * Listes des composants à ajouter
                         * $arrayFtaComposantToAdd[id_fta_composant Primaire] = id_fta_composant Secondaire
                         */
                        $arrayIdFtaComposantToAdd = array();
                        $arrayIsCodeProduitSecondaireFoundInPrimaire = array();

                        /**
                         * Parcours des composants primaires à synchroniser
                         */
                        foreach ($arrayListeComposantPrimaire as $keyFtaComposantPrimaire => $valueFtaComposantPrimaire) {

                            /**
                             * Récupération du code produit semi-fini
                             */
                            $codeProduitAgrologicFtaNomenclaturePrimaire = $valueFtaComposantPrimaire[FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE];
                            $isCodeProduitPrimaireFoundInSecondaire = FALSE;

                            /**
                             * Parcours des composants secondaires à synchroniser
                             */
                            foreach ($arrayIdFtaComposantSecondaire as $valueFtaComposantSecondaire) {

                                /**
                                 * Liste des semi-finis secondaires qui seraient inexistant dans la FTA primaires
                                 * Si le code n'a pas encore été recherché, alors on le déclare comme introuvable dans la primaire par défaut.
                                 */
                                if (array_key_exists($valueFtaComposantSecondaire[FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE], $arrayIsCodeProduitSecondaireFoundInPrimaire) == FALSE) {
                                    $arrayIsCodeProduitSecondaireFoundInPrimaire[$valueFtaComposantSecondaire[FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE]] = FALSE;
                                }

                                /**
                                 * Si le même code produit finis est trouvé, alors il faut synchroniser
                                 */
                                if ($valueFtaComposantSecondaire[FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE] == $codeProduitAgrologicFtaNomenclaturePrimaire) {
                                    /**
                                     * Ajout du couple de données Id composant secondaire + valeur à mettre à jour
                                     */
                                    $temp[FtaComposantModel::KEYNAME] = $valueFtaComposantSecondaire[FtaComposantModel::KEYNAME];
                                    $temp[$columnName] = $valueFtaComposantPrimaire[$columnName];

                                    /**
                                     * Actualisation de la liste des composants à synchroniser
                                     */
                                    $arrayIdFtaComposantToSync[$valueFtaComposantPrimaire[FtaComposantModel::KEYNAME]] = $temp;

                                    /**
                                     * Ce composant existant dans la FTA primaire ne sera donc pas à ajouter dans la FTA secondaire
                                     */
                                    $isCodeProduitPrimaireFoundInSecondaire = TRUE;

                                    /**
                                     * Inversement, le code de la FTA secondaire, existe bien dans la FTA primaire et ne sera donc pas à supprimer
                                     */
                                    $arrayIsCodeProduitSecondaireFoundInPrimaire[$valueFtaComposantSecondaire[FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE]] = TRUE;
                                }
                            }

                            /**
                             * Si après avoir parcourus tous les composants du secondaire, le code produit n'a pas été trouvé alors il faudra ajouter le composant
                             */
                            if ($isCodeProduitPrimaireFoundInSecondaire == FALSE) {
                                $arrayIdFtaComposantToAdd[] = $valueFtaComposantPrimaire[FtaComposantModel::KEYNAME];
                            }
                        }

                        /**
                         * Ajout des composants manquants dans la FTA secondaire
                         */
                        foreach ($arrayIdFtaComposantToAdd as $value) {

                            $idFtaComposantAdd = $value;

                            /**
                             * Création d'un composant dans les secondaires car ajouter dans le primaires.
                             */
                            $newIdFtaComposant = FtaComposantModel::duplicationIdFtaComposant($idFtaComposantAdd);

                            /**
                             * On remplace l'id du primaire par le nouveau
                             */
                            DatabaseOperation::execute(
                                    "UPDATE " . $tableName
                                    . " SET " . FtaModel::KEYNAME . "=\"" . $paramIdFtaSecondaire
                                    . "\" WHERE " . FtaComposantModel::KEYNAME . "=" . $newIdFtaComposant
                            );
                        }

                        /**
                         * Suppression des composants en trop dans la FTA secondaire
                         */
                        foreach ($arrayIsCodeProduitSecondaireFoundInPrimaire as $keyCodeProduitSecondaireFoundInPrimaire => $valueCodeProduitSecondaireFoundInPrimaire) {

                            /**
                             * Le code produit semi-fini de la secondaire est-il introuvable dans la FTA primaire ?
                             */
                            if ($valueCodeProduitSecondaireFoundInPrimaire == FALSE) {

                                $paramWhereClause = FtaComposantModel::FIELDNAME_ID_FTA . "=" . $paramIdFtaSecondaire
                                        . " AND " . FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE . "=" . $keyCodeProduitSecondaireFoundInPrimaire
                                ;
                                /**
                                 * Suppression du composant dans la FTA secondaire
                                 */
                                DatabaseOperation::doSqlDelete($tableName, $paramWhereClause);
                            }
                        }
                        break;
//                    default :
//                        $arrayValue = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
//                                        "SELECT " . $columnName
//                                        . " FROM " . $tableName
//                                        . " WHERE " . FtaModel::KEYNAME . "=" . $paramIdFtaPrimaire
//                        );
//                        break;
                }

                /**
                 * Ecrasement des valeurs vérrouillées de la secondaire par les valeurs de la primaire.
                 */
                if ($columnName <> FtaComposantModel::KEYNAME) {


                    /**
                     * On synchronise la donnée de la fta primaire avec la secondaire
                     */
                    if ($fieldLock) {

                        switch ($tableName) {
                            case FtaModel::TABLENAME:

                                foreach ($arrayValue as $value) {

                                    $columnValue = $value[$columnName];
                                    DatabaseOperation::execute(
                                            "UPDATE " . $tableName
                                            . " SET " . $columnName . "=\"" . $columnValue
                                            . "\" WHERE " . FtaModel::KEYNAME . "=" . $paramIdFtaSecondaire
                                    );
                                }
                                break;

                            case FtaComposantModel::TABLENAME:

                                foreach ($arrayIdFtaComposantToSync as $dataFtaComposantToSyncSecondaire) {
                                    $columnValue = $dataFtaComposantToSyncSecondaire[$columnName];
                                    $idFtaComposant = $dataFtaComposantToSyncSecondaire[FtaComposantModel::KEYNAME];

                                    DatabaseOperation::execute(
                                            "UPDATE " . $tableName
                                            . " SET " . $columnName . "=\"" . $columnValue
                                            . "\" WHERE " . FtaComposantModel::KEYNAME . "=" . $idFtaComposant
                                    );
                                }
                                break;
                        }
                    }
                }
            }
        }
    }

    /**
     * On insert les champs à verrouiller par défaut
     * @param int $paramFtaDossierPrimaire
     */
    public static function insertDefaultFieldToLock($paramFtaDossierPrimaire) {

        $arrayIntranetColumInfoLockField = IntranetColumnInfoModel::getArrayDefaultLockField();

        if ($arrayIntranetColumInfoLockField) {
            foreach ($arrayIntranetColumInfoLockField as $rowIntranetColumInfoLockField) {

                $lockValueIntranet = $rowIntranetColumInfoLockField[IntranetColumnInfoModel::FIELDNAME_DEFAULT_FIELD_TO_LOCK_FOR_PRIMARY_FTA];

                /**
                 * On vérifie si il s'agit un champ à verrouilé par défaut ou pas.
                 */
                switch ($lockValueIntranet) {
                    case IntranetColumnInfoModel::DEFAULT_FIELD_TO_LOCK_FOR_PRIMARY_FTA_VALUES:
                        $lockValue = self::FIELD_LOCK_TRUE;

                        break;
                    case IntranetColumnInfoModel::DEFAULT_FIELD_NOT_TO_LOCK_FOR_PRIMARY_FTA_VALUES:
                        $lockValue = self::FIELD_LOCK_FALSE;
                        break;
                }
                DatabaseOperation::execute(
                        "INSERT INTO " . self::TABLENAME
                        . " ( " . self::FIELDNAME_TABLE_NAME
                        . ", " . self::FIELDNAME_FIELD_NAME
                        . ", " . self::FIELDNAME_DOSSIER_FTA_PRIMAIRE
                        . ", " . self::FIELDNAME_FIELD_LOCK
                        . ", " . self::FIELDNAME_FIELD_CHANGE_STATE
                        . " ) VALUES ( \"" . $rowIntranetColumInfoLockField[IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO]
                        . "\", \"" . $rowIntranetColumInfoLockField[IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO]
                        . "\", \"" . $paramFtaDossierPrimaire
                        . "\", \"" . $lockValue
                        . "\", \"" . self::CHANGE_STATE_TRUE_VALIDATION_FTA . "\" ) "
                );
            }
        } else {
            $titre = UserInterfaceMessage::FR_WARNING_VERROUILLAGE_CHAMPS_TITLE;
            $message = UserInterfaceMessage::FR_WARNING_VERROUILLAGE_CHAMPS;
            Lib::showMessage($titre, $message);
        }
    }

    /**
     * On récupère l'etat du champs
     *  1 déverrouillé modifiable(primaire)
     *  2 vérrouilléé modifiable(primaire)
     *  3 déverouillé non-modifiable(secondaires)
     *  4 verrouillé non-modifiable(secondaires)
     *  0 champ normal
     * @param $paramDataFieldFieldName
     * @param FtaModel $paramFtaModel
     */
    public static function isFieldLock($paramDataFieldFieldName, FtaModel $paramFtaModel) {
        $isFieldLock = FALSE;
        $ftaValue = $paramFtaModel->isFtaPrimaireOrSecondaire($paramDataFieldFieldName);

        switch ($ftaValue) {
            case FtaModel::FTA_PRIMAIRE:
                $isFieldLock = self::isFieldNameLock($paramFtaModel, $paramDataFieldFieldName, FtaModel::FTA_PRIMAIRE);

                break;
            case FtaModel::FTA_SECONDAIRE:
                $isFieldLock = self::isFieldNameLock($paramFtaModel, $paramDataFieldFieldName, FtaModel::FTA_SECONDAIRE);

                break;
            case FtaModel::FTA_NORMAL:


                break;
        }
        return $isFieldLock;
    }

    /**
     * On récupère l'etat du champ 
     * @param FtaModel $paramFtaModel
     * @param string $paramFieldName
     * @return boolean
     */
    public static function isFieldNameLock(FtaModel $paramFtaModel, $paramFieldName, $paramFtaValue) {
        /**
         * On récupère la liste de champs verrouillé pour le dossier primaire
         */
        if ($paramFtaValue == FtaModel::FTA_PRIMAIRE) {
            $arrayFtaDossierChampsVerrouiller = $paramFtaModel->getArrayFtaVerrouillerByIdFtaDossier();
            $isLock = self::FIELD_LOCK_PRIMARY_FALSE;
            $isLockTrue = self::FIELD_LOCK_PRIMARY_TRUE;
        } elseif ($paramFtaValue == FtaModel::FTA_SECONDAIRE) {
            $arrayFtaDossierChampsVerrouiller = $paramFtaModel->getArrayFtaVerrouillerByIdFtaDossierPrimaire();
            $isLock = self::FIELD_LOCK_SECONDARY_FALSE;
            $isLockTrue = self::FIELD_LOCK_SECONDARY_TRUE;
        }
        /**
         * On récupère l'état du champ
         */
        foreach ($arrayFtaDossierChampsVerrouiller as $rowsFtaDossierChampsVerrouiller) {
            $fieldName = $rowsFtaDossierChampsVerrouiller[self::FIELDNAME_FIELD_NAME];
            if ($fieldName == $paramFieldName) {
                $isLockValue = $rowsFtaDossierChampsVerrouiller[self::FIELDNAME_FIELD_LOCK];
                if ($isLockValue) {
                    $isLock = $isLockTrue;
                }
            }
        }

        return $isLock;
    }

    /**
     * On vérifie si le champ en cours est verrouillable
     * @param string $paramFieldName
     * @param int $paramDossierFta
     * @return boolean
     */
    public static function checkFieldNameVerrouillable($paramFieldName, $paramDossierFta) {
        $value = FALSE;

        $arrayFtaLockField = self::getArrayFtaLockByPrimaryFolder($paramDossierFta);

        foreach ($arrayFtaLockField as $rowsFtaLockField) {
            $fieldName = $rowsFtaLockField[self::FIELDNAME_FIELD_NAME];
            $isLock = $rowsFtaLockField[self::FIELDNAME_FIELD_LOCK];
            if ($fieldName == $paramFieldName and ( $isLock == self::FIELD_LOCK_FALSE OR $isLock == self::FIELD_LOCK_TRUE)) {
                $value = TRUE;
            }
        }

        return $value;
    }

    /**
     * Géneration du lien ou non des cadenas pour les champs verrouillé/déverrouillé
     * @param int $paramIsFieldLock
     * @param $paramDataFieldFieldName
     * @param FtaModel $paramFtaModel
     * @param boolean $paramIsEditable
     * @return string
     */
    public static function linkFieldLock($paramIsFieldLock, $paramDataFieldFieldName, FtaModel $paramFtaModel, $paramIsEditable) {
        switch ($paramIsFieldLock) {
            /**
             * Cadenas déverrouillé modifiable
             */
            case self::FIELD_LOCK_PRIMARY_FALSE:
                $image_locked = Html::DEFAULT_HTML_IMAGE_DEVERROUILLE_MODIFIABLE;
                if ($paramIsEditable) {
                    $linkJavaScriptLock = '<a href="#" onclick="lockFields(\'' . $paramDataFieldFieldName . '\',\'' . $paramFtaModel->getKeyValue() . '\')" >';
                }
                break;
            /**
             * Cadenas verrouillé modifiable
             */
            case self::FIELD_LOCK_PRIMARY_TRUE:
                $image_locked = Html::DEFAULT_HTML_IMAGE_VERROUILLE_MODIFIABLE;
                if ($paramIsEditable) {
                    $linkJavaScriptLock = '<a href="#" onClick="lockFields(\'' . $paramDataFieldFieldName
                            . '\',\'' . $paramFtaModel->getKeyValue() . '\')" >';
                }
                break;
            /**
             * Cadenas déverrouillé non-modifiable
             */
            case self::FIELD_LOCK_SECONDARY_FALSE:
                $image_locked = Html::DEFAULT_HTML_IMAGE_DEVERROUILLE_NON_MODIFIABLE;

                break;
            /**
             * Cadenas verrouillé non-modifiable
             */
            case self::FIELD_LOCK_SECONDARY_TRUE:
                $image_locked = Html::DEFAULT_HTML_IMAGE_VERROUILLE_NON_MODIFIABLE;

                break;
            /**
             * Aucun cadenas
             */
            default:
                $image_locked = "";
                break;
        }
        $linkFieldLock = '<div align=right width="25%" >' . $linkJavaScriptLock . $image_locked . '</a></div>';

        return $linkFieldLock;
    }

    /**
     * Réinitialisation du changement d'état
     * @param int $paramIdDossierPrimaire
     */
    public static function resetChangeStateFieldLock($paramIdDossierPrimaire) {
        $arrayFtaDossierChampsVerrouiller = self::getArrayFtaLockChangeStateByPrimaryFolder($paramIdDossierPrimaire);

        foreach ($arrayFtaDossierChampsVerrouiller as $rowsFtaDossierChampsVerrouiller) {
            $fieldName = $rowsFtaDossierChampsVerrouiller[self::FIELDNAME_FIELD_NAME];
            $tableName = $rowsFtaDossierChampsVerrouiller[self::FIELDNAME_TABLE_NAME];

            //Réinitialisation du changement d'état
            $req = "UPDATE " . self::TABLENAME
                    . " SET " . self::FIELDNAME_FIELD_CHANGE_STATE . "=" . self::CHANGE_STATE_FALSE
                    . " WHERE " . self::FIELDNAME_DOSSIER_FTA_PRIMAIRE . "='" . $paramIdDossierPrimaire . "' "
                    . " AND " . self::FIELDNAME_TABLE_NAME . "='" . $tableName . "' "
                    . " AND " . self::FIELDNAME_FIELD_NAME . "='" . $fieldName . "' "
            ;
            DatabaseOperation::execute($req);
        }
    }

    /**
     * On autorise la modification selon l'état de champs verrouillable
     * @param $paramIsLockValue
     * @return boolean
     */
    public static function isEditableLockField($paramIsLockValue, $isEditable) {

        switch ($paramIsLockValue) {
            case FtaVerrouillageChampsModel::FIELD_LOCK_PRIMARY_FALSE:
            case FtaVerrouillageChampsModel::FIELD_LOCK_SECONDARY_FALSE:
            case FtaVerrouillageChampsModel::FIELD_LOCK_PRIMARY_TRUE:


                break;

            case FtaVerrouillageChampsModel::FIELD_LOCK_SECONDARY_TRUE:

                $isEditable = FALSE;

                break;
        }
        return $isEditable;
    }

    /**
     * Actualise l'état d'un champ verrouillé si le champ à était mise à jour.
     * @param string $paramTableName
     * @param string $paramKeyValue
     * @param string $paramFieldName
     */
    public static function doUpdateLockField($paramTableName, $paramKeyValue, $paramFieldName) {
        $mondelName = ModelTableAssociation::getModelName($paramTableName);

        $model = new $mondelName($paramKeyValue);

        $idFta = $model->getDataField(FtaModel::KEYNAME)->getFieldValue();
        if ($idFta) {
            $modelFta = new FtaModel($idFta);
            $idFtaDossier = $modelFta->getDossierFta();
        }
        $arrayFieldToLockChap = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . self::KEYNAME
                        . " FROM " . self::TABLENAME
                        . " WHERE " . self::FIELDNAME_TABLE_NAME . "=\"" . $paramTableName
                        . "\" AND " . self::FIELDNAME_FIELD_NAME . "=\"" . $paramFieldName
                        . "\" AND " . self::FIELDNAME_DOSSIER_FTA_PRIMAIRE . "=\"" . $idFtaDossier
                        . "\" AND " . self::FIELDNAME_FIELD_LOCK . "=" . self::FIELD_LOCK_TRUE
        );
        if ($arrayFieldToLockChap) {
            DatabaseOperation::execute(
                    "UPDATE " . self::TABLENAME
                    . " SET " . self::FIELDNAME_FIELD_CHANGE_STATE . "=" . self::CHANGE_STATE_FALSE
                    . " WHERE " . self::FIELDNAME_TABLE_NAME . "=\"" . $paramTableName
                    . "\" AND " . self::FIELDNAME_FIELD_NAME . "=\"" . $paramFieldName
                    . "\" AND " . self::FIELDNAME_DOSSIER_FTA_PRIMAIRE . "=\"" . $idFtaDossier . "\""
            );
        }
    }

}

?>