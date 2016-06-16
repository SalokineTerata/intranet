<?php

/**
 * Description of ClassificationRaccourcisAssociationModel
 * Tables d'association 
 * @author tp4300001
 */
class ClassificationRaccourcisAssociationModel extends AbstractModel {

    const TABLENAME = 'classification_raccourcis_association';
    const KEYNAME = 'id_classification_raccourcis_association';
    const FIELDNAME_ID_FTA_CLASSIFICATION2 = 'id_fta_classification2';
    const FIELDNAME_ID_CLASSIFICATION_RACCOURCIS = 'id_classification_raccourcis';
    const VIRTUAL_FIELDNAME_NOM_CLASSIFICATION_RACCOURCIS = 'VIRTUAL_nom_classification_raccourcis';
    const AJOUTER = 'ajout';
    const SUPPRIMER = 'suppression';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

    /**
     * Valeurs par défaut en cas de création
     * d'un nouvel enregistrement
     * @return mixed
     */
    static public function createNewRecordset($paramForeignKeysValuesArray = NULL) {


        $pdo = DatabaseOperation::executeComplete(
                        'INSERT INTO ' . self::TABLENAME
                        . '(' . self::FIELDNAME_ID_FTA_CLASSIFICATION2 . ')'
                        . 'VALUES (' . $paramForeignKeysValuesArray[self::FIELDNAME_ID_FTA_CLASSIFICATION2] . ')'
        );
        $key = $pdo->lastInsertId();
        return $key;
    }

    function deleteClassificationRaccourcisAssociation() {
        DatabaseOperation::executeComplete(
                'DELETE FROM ' . self::TABLENAME
                . ' WHERE ' . self::KEYNAME . '=' . $this->getKeyValue()
        );
    }

    /**
     * On identifie les clé étrangères de la table classification raccourcis association
     * Cette array doit être utilisé de cette manière 
     * Array (
     * nom de table,
     * clé étrangère de la table présenté
     * valeur de la clé étrangère);
     * @return array
     */
    function getTablesNameAndIdForeignkeyOfClassificationRaccourcisAssociation() {
        $tablesNameAndIdForeignKeyOfClassificationRaccourcisAssociation[$this->getKeyValue()] = array(
            array(ClassificationFta2Model::TABLENAME, ClassificationFta2Model::KEYNAME, $this->getDataField(self::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue()),
            array(ClassificationRaccourcisModel::TABLENAME, ClassificationRaccourcisModel::KEYNAME, $this->getDataField(self::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS)->getFieldValue()),
        );

        return $tablesNameAndIdForeignKeyOfClassificationRaccourcisAssociation;
    }

    /**
     * Tableau de données, convertie le nom des champs des données aux noms des champs virtuel qui leur corresponds
     * @return int
     */
    function getArrayClassificationRaccourcisAssociation() {
        $arrayTmp = DatabaseOperation::convertSqlStatementWithKeyAsFirstFieldToArray(
                        'SELECT ' . self::KEYNAME . ',' . self::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS
                        . ' FROM ' . self::TABLENAME
                        . ' WHERE ' . self::KEYNAME . '=' . $this->getKeyValue());

        if ($arrayTmp) {
            foreach ($arrayTmp as $key => $rows) {
                $array[$key] = array(
                    self::VIRTUAL_FIELDNAME_NOM_CLASSIFICATION_RACCOURCIS => $rows[self::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS],
                );
            }
        } else {
            $array = 0;
        }
        return $array;
    }

    /**
     * Affiche le label du tableau de Raccoucis de classification
     * @return string
     */
    function getTableClassificationRaccourcisAssociationLabel() {
        $border = "style=\"border:1px solid #000;\"";
        return '<tr class=titre_tableau  align=center >' .
                '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>Actions</td>'
                . '</tr>';
    }

    /**
     * Retour la liste des idClassificationRaccourcis pour une classifcation donnée
     * @param int $paramIdClassificationFta2
     * @return array
     */
    public static function getArrayIdClassificationRaccourcisAssociationByIdClassificationFta2($paramIdClassificationFta2) {
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . self::KEYNAME . "," . self::FIELDNAME_ID_FTA_CLASSIFICATION2 . "," . self::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS
                        . " FROM " . self::TABLENAME
                        . " WHERE " . self::FIELDNAME_ID_FTA_CLASSIFICATION2 . "=" . $paramIdClassificationFta2
        );

        return $array;
    }

    /**
     *  Lien d'ajout d'un raccourcis de classification associé à une classification
     * @param string $paramAction
     * @return string
     */
    public static function getAddLinkBeforeClassificationRaccourcisAssociation($paramIdClassificationFta2, $paramAction) {
        return 'modification_raccourcis_classification.php?'
                . 'id_fta_classification2=' . $paramIdClassificationFta2
                . '&action=' . $paramAction
                . '&actionClassifcation=' . self::AJOUTER

        ;
    }

    /**
     *  Lien de suppression d'un raccourcis de classification associé à une classification
     * @param int $paramIdClassificationFta2
     * @param string $paramAction
     * @return string
     */
    public static function getDeleteLinkClassificationRaccourcisAssociation($paramIdClassificationFta2, $paramAction, $paramArrayIdClassificationRaccourcisAssociation) {

        foreach ($paramArrayIdClassificationRaccourcisAssociation as $rows) {
            $return[$rows] = '<a href=modification_raccourcis_classification.php?'
                    . 'id_fta_classification2=' . $paramIdClassificationFta2
                    . '&id_classification_raccourcis_association=' . $rows
                    . '&action=' . $paramAction
                    . '&actionClassifcation=' . self::SUPPRIMER . '>
                                <img src=../lib/images/supprimer.png width=22  border=0/>
                                </a><br>';
        }

        return $return;
    }

    /**
     * Lien d'ajout d'un raccourcis de classification associé à une classification après une autre  Gamme Famille Budget
     * @param int $paramIdClassificationFta2
     * @param string $paramAction
     * @return string
     */
    public static function getAddLinkAfterClassificationRaccourcisAssociation($paramIdClassificationFta2, $paramAction) {
        return '<a href=modification_raccourcis_classification.php?'
                . 'id_fta_classification2=' . $paramIdClassificationFta2
                . '&action=' . $paramAction
                . '&actionClassifcation=' . self::AJOUTER . '><img src=../lib/images/plus.png width=22  border=0 valign=middle halign=right />'
                . '</a><br>';
    }

    /**
     * On affiche la liste des raccourcis de classification associé à une classification
     * @param objet $paramFtaModel
     * @param int $paramIdClassificationFta2
     * @param boolean $paramIsEditable
     * @return string
     */
    public static function getHtmlClassificationRaccourcisAssociation(FtaModel $paramFtaModel, $paramIdClassificationFta2, $paramIsEditable) {
        $htmlList = new HtmlListSelect();

        $paramFtaModel->setDataFtaTableToCompare();

        $dataFieldIdClassificationRaccourcisTMP = $paramFtaModel->getDataField(FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS);
        $arrayClassificationRaccourcis = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . ClassificationRaccourcisModel::TABLENAME . '.' . ClassificationRaccourcisModel::KEYNAME
                        . ',' . ClassificationRaccourcisModel::TABLENAME . '.' . ClassificationRaccourcisModel::FIELDNAME_NOM_CLASSIFICATION_RACCOURCIS
                        . ' FROM ' . ClassificationRaccourcisModel::TABLENAME . ',' . self::TABLENAME
                        . ' WHERE ' . ClassificationRaccourcisModel::TABLENAME . '.' . ClassificationRaccourcisModel::KEYNAME
                        . ' = ' . self::TABLENAME . '.' . self::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS
                        . ' AND ' . self::FIELDNAME_ID_FTA_CLASSIFICATION2 . '=' . $paramIdClassificationFta2
                        . ' ORDER BY ' . ClassificationRaccourcisModel::FIELDNAME_NOM_CLASSIFICATION_RACCOURCIS
        );

        /**
         * Si le chapitre est editable alors on vérifie si 
         * pour une classification nous avons plusieurs raccourcis de classification associé
         * Si nous avons plusieur résultat alors on affiche la liste déroulante 
         * sinon on enregistre l'unique  résutat 
         */
//        if ($paramIsEditable == Chapitre::EDITABLE) {
//            if (count($arrayClassificationRaccourcis) > "1") {
//                $paramIsEditable = Chapitre::EDITABLE;
//            } else {
//                /**
//                 * Enregistrement de la donnée raccourcis de classification
//                 */
//                if ($arrayClassificationRaccourcis) {
//                    foreach ($arrayClassificationRaccourcis as $key => $value) {
//                        $ftaModel->getDataField(FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS)->setFieldValue($key);
//                        $ftaModel->saveToDatabase();
//                    }
//                }
//                $paramIsEditable = Chapitre::NOT_EDITABLE;
//            }
//        }


        $htmlList->setArrayListContent($arrayClassificationRaccourcis);

        /**
         * On vérifie si la donnée en BDD se trouve dans le tableau
         * Sinon alors on vide la donnée de la BDD
         */
        $dataFieldIdClassificationRaccourcis = FtaController::checkDataInArrayKeyList($dataFieldIdClassificationRaccourcisTMP, $arrayClassificationRaccourcis);



        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS
                . '_'
                . $paramFtaModel->getKeyValue()
        ;
        /**
         * Vérification des règle de validation
         */
        $dataFieldIdClassificationRaccourcis->checkValidationRules();

        if ($dataFieldIdClassificationRaccourcis->getDataValidationSuccessful() == TRUE) {
            $htmlList->setIsWarningMessage($dataFieldIdClassificationRaccourcis->getDataValidationSuccessful());
            $paramFtaModel->setDataValidationSuccessfulToTrue();
        } else {
            $htmlList->setIsWarningMessage($dataFieldIdClassificationRaccourcis->getDataValidationSuccessful());
            $htmlList->setWarningMessage($dataFieldIdClassificationRaccourcis->getDataWarningMessage());
            $paramFtaModel->setDataValidationSuccessfulToFalse();
        }


        $htmlList->setSelectedValue($dataFieldIdClassificationRaccourcis->getFieldValue());
        $htmlList->getAttributes()->getName()->setValue(FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS);
        $htmlList->setLabel(DatabaseDescription::getFieldDocLabel(ClassificationRaccourcisAssociationModel::TABLENAME, ClassificationRaccourcisAssociationModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS));
        $htmlList->setIsEditable($paramIsEditable);
        $htmlList->initAbstractHtmlSelect(
                $HtmlTableName
                , $htmlList->getLabel()
                , $dataFieldIdClassificationRaccourcis->getFieldValue()
                , $dataFieldIdClassificationRaccourcis->isFieldDiff()
                , $htmlList->getArrayListContent()
                , $htmlList->getIsWarningMessage()
                , $htmlList->getWarningMessage()
        );
        $htmlList->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $paramFtaModel->getKeyValue(), FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS);

        /**
         * Description d'un champ
         */
        $htmlList->setHelp(IntranetColumnInfoModel::getFieldDesc($dataFieldIdClassificationRaccourcis->getTableName(), $dataFieldIdClassificationRaccourcis->getFieldName()
                        , $dataFieldIdClassificationRaccourcis->getFieldLabel(), $htmlList
        ));

        $listeClassificationRaccourcis = $htmlList->getHtmlResult();

        return $listeClassificationRaccourcis;
    }

}
