<?php

/**
 * Description of ClassificationMarqueArcadiaModel
 * @author franckwastaken
 */
class ClassificationMarqueArcadiaModel extends AbstractModel {

    const TABLENAME = 'classification_marque_arcadia';
    const KEYNAME = 'id_classification_marque_arcadia';
    const FIELDNAME_ID_MARQUE = 'id_Marque';
    const FIELDNAME_ID_ARCADIA_MARQUE = 'id_arcadia_marque';
    const VIRTUAL_FIELDNAME_NOM_CLASSIFICATION_MARQUE = 'VIRTUAL_nom_classification_marque';
    const LABEL_CLASSIFICATION_MARQUE = 'Marque Arcadia';
    const AJOUTER = 'ajouter';
    const SUPPRIMER = 'supprimer';
    const TYPE_MARQUE = 'marque';

    private $nameDataTableToCompare;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
        $this->setNameDataTableToCompare();
    }

    protected function setDefaultValues() {
        
    }

    function getNameDataTableToCompare() {
        return $this->nameDataTableToCompare;
    }

    function setNameDataTableToCompare() {
        $this->nameDataTableToCompare = NULL;
    }

    /**
     * Affiche le tableau d'ajout d'une Marque arcadia à une marque de classification
     * @param string $paramIdMarque
     * @return string
     */
    public static function getHtmlTableClassificationMarqueArcadia($paramIdMarque) {
        $ClassificationMarqueArcadia = self::getArrayIdClassificationMarqueArcadiaByIdMarque($paramIdMarque);

        if ($ClassificationMarqueArcadia) {
            $arrayClassificationMarquetmp = array();
            $tablesNameAndIdForeignKeyOfMarqueArcadiatmp = array();

            foreach ($ClassificationMarqueArcadia as $rowsClassificationMarqueArcadia) {
                $idClassificationMarqueArcadia = $rowsClassificationMarqueArcadia[self::KEYNAME];

                $arrayIdClassificationMarqueArcadia[] = $idClassificationMarqueArcadia;


                $ClassificationMarqueArcadiaModel = new ClassificationMarqueArcadiaModel($idClassificationMarqueArcadia);

                /*
                 * Tableau de données
                 */
                $arrayClassificationMarqueTmp = $ClassificationMarqueArcadiaModel->getArrayClassificationMarqueArcadia();

                $arrayClassificationMarqueArcadia = array_replace_recursive($arrayClassificationMarquetmp, $arrayClassificationMarqueTmp);

                $arrayClassificationMarquetmp = $arrayClassificationMarqueArcadia;

                /*
                 * Cette array doit être utilisé de cette manière 
                 * Array (
                 * nom de table,
                 * clé étrangère de la table présenté
                 * valeur de la clé étrangère);
                 */
                $tablesNameAndIdForeignKeyOfClassificationMarqueArcadiaTmp = $ClassificationMarqueArcadiaModel->getTablesNameAndIdForeignkeyOfClassificationMarqueArcadia();


                $tablesNameAndIdForeignKeyOfClassificationMarqueArcadia = ($tablesNameAndIdForeignKeyOfMarqueArcadiatmp + $tablesNameAndIdForeignKeyOfClassificationMarqueArcadiaTmp);
                $tablesNameAndIdForeignKeyOfMarqueArcadiatmp = $tablesNameAndIdForeignKeyOfClassificationMarqueArcadia;
                /*
                 * Vérifie si pour la Fta en cours les données ClassificationGammeFamilleBudgett sont renseigné
                 */
                if ($arrayClassificationMarqueArcadia) {
                    $rightToAdd = Chapitre::NOT_EDITABLE;
                } else {
                    $rightToAdd = Chapitre::EDITABLE;
                }
            }
            /**
             * Labels
             */
            $className = $ClassificationMarqueArcadiaModel->getClassName();
            $label = $ClassificationMarqueArcadiaModel->getDataField(self::FIELDNAME_ID_ARCADIA_MARQUE)->getFieldLabel();


            /**
             * Initilisation du tableau html
             */
            $htmlClassificationActiviteFamilleVentesArcadia = new HtmlSubForm_RNN($arrayClassificationMarqueArcadia, $className, $label, $tablesNameAndIdForeignKeyOfClassificationMarqueArcadia);
            $htmlClassificationActiviteFamilleVentesArcadia->setIsEditable(Chapitre::EDITABLE);
            $htmlClassificationActiviteFamilleVentesArcadia->setRightToAdd($rightToAdd);
            $htmlClassificationActiviteFamilleVentesArcadia->setLienAjouter(self::getAddLinkAfterClassificationMarqueArcadia($paramIdMarque));
            $htmlClassificationActiviteFamilleVentesArcadia->setLien(self::getAddLinkBeforeClassificationMarqueArcadia($paramIdMarque));
            $htmlClassificationActiviteFamilleVentesArcadia->setLienSuppression(self::getDeleteLinkClassificationMarqueArcadia($paramIdMarque, $arrayIdClassificationMarqueArcadia));
            $htmlClassificationActiviteFamilleVentesArcadia->setTableLabel($ClassificationMarqueArcadiaModel->getTableClassificationMarqueArcadiaLabel());
            $return .= $htmlClassificationActiviteFamilleVentesArcadia->getHtmlResult();
        } else {
            /*
             * Initialisation des modèles 
             */
            $label = self::LABEL_CLASSIFICATION_MARQUE;

            $htmlClassificationActiviteFamilleVentesArcadia = new HtmlSubForm_RNN($arrayClassificationMarqueArcadia, $className, $label, $tablesNameAndIdForeignKeyOfClassificationMarqueArcadia);
            $htmlClassificationActiviteFamilleVentesArcadia->setIsEditable(Chapitre::EDITABLE);
            $htmlClassificationActiviteFamilleVentesArcadia->setRightToAdd(Chapitre::EDITABLE);
            $htmlClassificationActiviteFamilleVentesArcadia->setLien(self::getAddLinkBeforeClassificationMarqueArcadia($paramIdMarque));
            $return .= $htmlClassificationActiviteFamilleVentesArcadia->getHtmlResult();
        }
        return $return;
    }

    /**
     * Retour la liste des IdClassificationMarque pour une marque donnée
     * @param int $paramIdMarque
     * @return array
     */
    private static function getArrayIdClassificationMarqueArcadiaByIdMarque($paramIdMarque) {

        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . self::KEYNAME
                        . " FROM " . self::TABLENAME
                        . " WHERE " . self::FIELDNAME_ID_MARQUE . "=" . $paramIdMarque
        );

        return $array;
    }

    /**
     * Tableau de données, convertie le nom des champs des données aux noms des champs virtuel qui leur corresponds
     * @return int
     */
    function getArrayClassificationMarqueArcadia() {
        $arrayTmp = DatabaseOperation::convertSqlStatementWithKeyAsFirstFieldToArray(
                        'SELECT ' . self::KEYNAME . ',' . self::FIELDNAME_ID_ARCADIA_MARQUE
                        . ' FROM ' . self::TABLENAME
                        . ' WHERE ' . self::KEYNAME . '=' . $this->getKeyValue());

        if ($arrayTmp) {
            foreach ($arrayTmp as $key => $rows) {
                $array[$key] = array(
                    self::VIRTUAL_FIELDNAME_NOM_CLASSIFICATION_MARQUE => $rows[self::FIELDNAME_ID_ARCADIA_MARQUE],
                );
            }
        } else {
            $array = 0;
        }
        return $array;
    }

    /**
     * Valeurs par défaut en cas de création
     * d'un nouvel enregistrement
     * @return mixed
     */
    static public function createNewRecordset($paramForeignKeysValuesArray = NULL) {


        $pdo = DatabaseOperation::executeComplete(
                        'INSERT INTO ' . self::TABLENAME
                        . '(' . self::FIELDNAME_ID_MARQUE . ')'
                        . 'VALUES (' . $paramForeignKeysValuesArray[self::FIELDNAME_ID_MARQUE] . ')'
        );
        $key = $pdo->lastInsertId();
        return $key;
    }

    function deleteClassificationMarqueArcadia() {
        DatabaseOperation::executeComplete(
                'DELETE FROM ' . self::TABLENAME
                . ' WHERE ' . self::KEYNAME . '=' . $this->getKeyValue()
        );
    }

    /**
     * On identifie les clé étrangères de la table classification Marque
     * Cette array doit être utilisé de cette manière 
     * Array (
     * nom de table,
     * clé étrangère de la table présenté
     * valeur de la clé étrangère);
     * @return array
     */
    function getTablesNameAndIdForeignkeyOfClassificationMarqueArcadia() {
        $tablesNameAndIdForeignKeyOfClassificationRaccourcisAssociation[$this->getKeyValue()] = array(
            array(ClassificationFta2Model::TABLENAME, ClassificationFta2Model::FIELDNAME_ID_MARQUE, $this->getDataField(self::FIELDNAME_ID_MARQUE)->getFieldValue()),
            array(ArcadiaMarqueModel::TABLENAME, ArcadiaMarqueModel::KEYNAME, $this->getDataField(self::FIELDNAME_ID_ARCADIA_MARQUE)->getFieldValue()),
        );

        return $tablesNameAndIdForeignKeyOfClassificationRaccourcisAssociation;
    }

    /**
     * Affiche le label du tableau d'une Marque arcadia à une marque de classification
     * @return string
     */
    function getTableClassificationMarqueArcadiaLabel() {
        $border = "style=\"border:1px solid #000;\"";
        return '<tr class=titre_tableau  align=center >' .
                '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_ID_ARCADIA_MARQUE)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>Actions</td>'
                . '</tr>';
    }

    /**
     *  Lien d'ajout d'une Marque arcadia à une marque de classification
     * @param string $paramIdClassificationFta2
     * @return string
     */
    private static function getAddLinkBeforeClassificationMarqueArcadia($paramIdClassificationFta2) {
        return 'modification_marque.php?'
                . self::FIELDNAME_ID_MARQUE . '=' . $paramIdClassificationFta2
                . '&action=' . self::AJOUTER
                . '&type=' . self::TYPE_MARQUE

        ;
    }

    /**
     * Lien de suppression d'une Marque arcadia à une marque de classificationion
     * @param int $paramIdMarque
     * @param array $paramArrayIdClassificationMarque
     * @return string
     */
    private static function getDeleteLinkClassificationMarqueArcadia($paramIdMarque, $paramArrayIdClassificationMarque) {

        foreach ($paramArrayIdClassificationMarque as $rows) {
            $return[$rows] = '<a href=modification_marque.php?'
                    . self::FIELDNAME_ID_MARQUE . '=' . $paramIdMarque
                    . '&' . self::KEYNAME . '=' . $rows
                    . '&action=' . self::SUPPRIMER . '>
                                <img src=../lib/images/supprimer.png width=22  border=0/>
                                </a><br>';
        }

        return $return;
    }

    /**
     * Lien d'ajout d'une Marque arcadia à une marque de classification après une autre  Marque Arcadia
     * @param int $paramIdActivite
     * @return string
     */
    private static function getAddLinkAfterClassificationMarqueArcadia($paramIdActivite) {
        return '<a href=modification_marque.php?'
                . self::FIELDNAME_ID_MARQUE . '=' . $paramIdActivite
                . '&action=' . self::AJOUTER . '&type=' . self::TYPE_MARQUE . '><img src=../lib/images/plus.png width=22  border=0 valign=middle halign=right />'
                . '</a><br>';
    }

    /**
     * On affiche la liste des Marques arcadia à une marque de classification
     * @param object $paramFtaModel
     * @param int $paramIdClassificationFta2
     * @param boolean $paramIsEditable
     * @return string
     */
    public static function getHtmlListeClassificationMarqueArcadia(FtaModel $paramFtaModel, $paramIdClassificationFta2, $paramIsEditable) {
        $htmlList = new HtmlListSelect();


        $paramFtaModel->setDataFtaTableToCompare();

        $idMarque = ClassificationFta2Model::getIdClassificationTypeByTypeNameAndIdClassificationFta2($paramIdClassificationFta2, ClassificationFta2Model::FIELDNAME_ID_MARQUE);
        $dataFieldIdArcadiaMarqueTMP = $paramFtaModel->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_MARQUE);
        $arrayClassificationMarqueArcadia = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . ArcadiaMarqueModel::TABLENAME . '.' . ArcadiaMarqueModel::KEYNAME
                        . ', CONCAT_WS(  \' - \',' . ArcadiaMarqueModel::TABLENAME . '.' . ArcadiaMarqueModel::KEYNAME
                        . ',' . ArcadiaMarqueModel::TABLENAME . '.' . ArcadiaMarqueModel::FIELDNAME_NOM_ARCADIA_MARQUE
                        . ') FROM ' . ArcadiaMarqueModel::TABLENAME . ',' . self::TABLENAME
                        . ' WHERE ' . ArcadiaMarqueModel::TABLENAME . '.' . ArcadiaMarqueModel::KEYNAME
                        . ' = ' . self::TABLENAME . '.' . self::FIELDNAME_ID_ARCADIA_MARQUE
                        . ' AND ' . self::FIELDNAME_ID_MARQUE . '=' . $idMarque
                        . ' ORDER BY ' . ArcadiaMarqueModel::FIELDNAME_NOM_ARCADIA_MARQUE
        );

//        /**
//         * Si le chapitre est editable alors on vérifie si 
//         * pour une classification nous avons plusieurs raccourcis de classification associé
//         * Si nous avons plusieur résultat alors on affiche la liste déroulante 
//         * sinon on enregistre l'unique  résutat 
//         */
//        if ($paramIsEditable == Chapitre::EDITABLE) {
//            if (count($arrayClassificationMarqueArcadia) > "1") {
//                $paramIsEditable = Chapitre::EDITABLE;
//            } else {
//                /**
//                 * Enregistrement de la donnée raccourcis de classification
//                 */
//                if ($arrayClassificationMarqueArcadia) {
//                    foreach ($arrayClassificationMarqueArcadia as $key => $value) {
//                        $ftaModel->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_MARQUE)->setFieldValue($key);
//                        $ftaModel->saveToDatabase();
//                    }
//                }
//            }
//        }
        $htmlList->setArrayListContent($arrayClassificationMarqueArcadia);

        /**
         * On vérifie si la donnée en BDD se trouve dans le tableau
         * Sinon alors on vide la donnée de la BDD
         */
        $dataFieldIdArcadiaMarque = FtaController::checkDataInArrayKeyList($dataFieldIdArcadiaMarqueTMP, $arrayClassificationMarqueArcadia);


        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_ID_ARCADIA_MARQUE
                . '_'
                . $paramFtaModel->getKeyValue()
        ;


        /**
         * Vérification des règle de validation
         */
        $dataFieldIdArcadiaMarque->checkValidationRules();

        if ($dataFieldIdArcadiaMarque->getDataValidationSuccessful() == TRUE) {
            $htmlList->setIsWarningMessage($dataFieldIdArcadiaMarque->getDataValidationSuccessful());
            $paramFtaModel->setDataValidationSuccessfulToTrue();
        } else {
            $htmlList->setIsWarningMessage($dataFieldIdArcadiaMarque->getDataValidationSuccessful());
            $htmlList->setWarningMessage($dataFieldIdArcadiaMarque->getDataWarningMessage());
            $paramFtaModel->setDataValidationSuccessfulToFalse();
        }


        $htmlList->getAttributes()->getName()->setValue(FtaModel::FIELDNAME_ID_ARCADIA_MARQUE);
        $htmlList->setLabel(DatabaseDescription::getFieldDocLabel(self::TABLENAME, self::FIELDNAME_ID_ARCADIA_MARQUE));
        $htmlList->setIsEditable($paramIsEditable);
        $htmlList->initAbstractHtmlSelect(
                $HtmlTableName
                , $htmlList->getLabel()
                , $dataFieldIdArcadiaMarque->getFieldValue()
                , $dataFieldIdArcadiaMarque->isFieldDiff()
                , $htmlList->getArrayListContent()
                , $htmlList->getIsWarningMessage()
                , $htmlList->getWarningMessage()
        );
        $htmlList->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $paramFtaModel->getKeyValue(), FtaModel::FIELDNAME_ID_ARCADIA_MARQUE);

        /**
         * Description d'un champ
         */
        $htmlList->setHelp(IntranetColumnInfoModel::getFieldDesc($dataFieldIdArcadiaMarque->getTableName(), $dataFieldIdArcadiaMarque->getFieldName()
                        , $dataFieldIdArcadiaMarque->getFieldLabel(), $htmlList
        ));


        $listeClassificationRaccourcis = $htmlList->getHtmlResult();

        return $listeClassificationRaccourcis;
    }

}
