<?php

/**
 * Description of ClassificationGammeFamilleBudgetArcadiaModel
 * Table des ClassificationGammeFamilleBudgetArcadiaModel
 * qui corresponds aux liens entres les classification et la gamme famille budget 
 *
 * @author franckwastaken
 */
class ClassificationGammeFamilleBudgetArcadiaModel extends AbstractModel {

    const TABLENAME = 'classification_gamme_famille_budget_arcadia';
    const KEYNAME = 'id_classification_gamme_famille_budget_arcadia';
    const FIELDNAME_ID_FTA_CLASSIFICATION2 = 'id_fta_classification2';
    const FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET = 'id_arcadia_gamme_famille_budget';
    const FIELDNAME_ID_MARQUE = 'id_Marque';
    const VIRTUAL_FIELDNAME_NOM_ARCADIA_GAMME_FAMILLE_BUDGET = 'VIRTUAL_nom_arcadia_gamme_famille_budget';
    const VIRTUAL_FIELDNAME_NOM_ARCADIA_GAMME_FAMILLE_BUDGET_MARQUE = 'VIRTUAL_nom_arcadia_gamme_famille_budget_marque';
    const LABEL_CLASSIFICATION_GAMME_FAMILLE_BUDGET = 'Gamme Famille Budget';
    const AJOUTER = 'ajouter';
    const SUPPRIMER = 'supprimer';
    const TYPE_GAMME = 'gamme';

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

    /**
     * Valeurs par défaut en cas de création
     * d'un nouvel enregistrement
     * @return mixed
     */
    static public function createNewRecordsetGammeMarque($paramForeignKeysValuesArray = NULL) {


        $pdo = DatabaseOperation::executeComplete(
                        'INSERT INTO ' . self::TABLENAME
                        . '(' . self::FIELDNAME_ID_MARQUE . ')'
                        . 'VALUES (' . $paramForeignKeysValuesArray[self::FIELDNAME_ID_MARQUE] . ')'
        );
        $key = $pdo->lastInsertId();
        return $key;
    }

    function deleteClassificationGammeFamilleBudget() {
        DatabaseOperation::executeComplete(
                'DELETE FROM ' . self::TABLENAME
                . ' WHERE ' . self::KEYNAME . '=' . $this->getKeyValue()
        );
    }

    /**
     * On identifie les clé étrangères de la table classification gamme famille budget
     * Cette array doit être utilisé de cette manière 
     * Array (
     * nom de table,
     * clé étrangère de la table présenté
     * valeur de la clé étrangère);
     * @return array
     */
    function getTablesNameAndIdForeignkeyOfClassificationGammeFamilleBudget() {
        $tablesNameAndIdForeignKeyOfClassificationGammeFamilleBudget[$this->getKeyValue()] = array(
            array(ClassificationFta2Model::TABLENAME, ClassificationFta2Model::KEYNAME, $this->getDataField(self::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue()),
            array(ArcadiaGammeFamilleBudgetModel::TABLENAME, ArcadiaGammeFamilleBudgetModel::KEYNAME, $this->getDataField(self::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET)->getFieldValue()),
        );

        return $tablesNameAndIdForeignKeyOfClassificationGammeFamilleBudget;
    }

    /**
     * Tableau de données, convertie le nom des champs des données aux noms des champs virtuel qui leur corresponds
     * @return int
     */
    function getArrayClassificationGammeFamilleBudget() {
        $arrayTmp = DatabaseOperation::convertSqlStatementWithKeyAsFirstFieldToArray(
                        'SELECT ' . self::KEYNAME . ',' . self::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET
                        . ' FROM ' . self::TABLENAME
                        . ' WHERE ' . self::KEYNAME . '=' . $this->getKeyValue());

        if ($arrayTmp) {
            foreach ($arrayTmp as $key => $rows) {
                $array[$key] = array(
                    self::VIRTUAL_FIELDNAME_NOM_ARCADIA_GAMME_FAMILLE_BUDGET => $rows[self::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET],
                );
            }
        } else {
            $array = 0;
        }
        return $array;
    }

    /**
     * Affiche le label du tableau GammeFamilleBudget
     * @return string
     */
    function getTableGammeFamilleBudgetLabel() {
        $border = "style=\"border:1px solid #000;\"";
        return '<tr class=titre_tableau  align=center >' .
                '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>Actions</td>'
                . '</tr>';
    }

    /**
     * Retour la liste des idClassificationGammeFamilleBudget pour une classifcation donnée
     * @param inr $paramIdClassificationFta2
     * @return array
     */
    public static function getArrayIdClassificationGammeFamilleBudgetByIdClassificationFta2($paramIdClassificationFta2) {
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . self::KEYNAME . "," . self::FIELDNAME_ID_FTA_CLASSIFICATION2 . "," . self::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET
                        . " FROM " . self::TABLENAME
                        . " WHERE " . self::FIELDNAME_ID_FTA_CLASSIFICATION2 . "=" . $paramIdClassificationFta2
        );

        return $array;
    }

    /**
     *  Lien d'ajout d'une Gamme Famille Budget
     * @param int $paramIdClassificationFta2
     * @param string $paramAction
     * @return string
     */
    public static function getAddLinkBeforeClassificationGammeFamilleBudget($paramIdClassificationFta2, $paramAction) {
        return 'modification_gamme_famille_budget.php?'
                . 'id_fta_classification2=' . $paramIdClassificationFta2
                . '&action=' . $paramAction
                . '&actionClassifcation=' . self::AJOUTER

        ;
    }

    /**
     *  Lien de suppression d'une Gamme Famille Budget
     * @param int $paramIdClassificationFta2
     * @param string $paramAction
     * @return string
     */
    public static function getDeleteLinkClassificationGammeFamilleBudget($paramIdClassificationFta2, $paramAction, $paramArrayIdClassificationGammeFamilleBudget) {

        foreach ($paramArrayIdClassificationGammeFamilleBudget as $rows) {
            $return[$rows] = '<a href=modification_gamme_famille_budget.php?'
                    . 'id_fta_classification2=' . $paramIdClassificationFta2
                    . '&id_classification_gamme_famille_budget_arcadia=' . $rows
                    . '&action=' . $paramAction
                    . '&actionClassifcation=' . self::SUPPRIMER . '>
                                <img src=../lib/images/supprimer.png width=22  border=0/>
                                </a><br>';
        }

        return $return;
    }

    /**
     * Lien d'ajout d'une Gamme Famille Budget après une autre  Gamme Famille Budget
     * @param int $paramIdClassificationFta2
     * @param string $paramAction
     * @return string
     */
    public static function getAddLinkAfterClassificationGammeFamilleBudget($paramIdClassificationFta2, $paramAction) {
        return '<a href=modification_gamme_famille_budget.php?'
                . 'id_fta_classification2=' . $paramIdClassificationFta2
                . '&action=' . $paramAction
                . '&actionClassifcation=' . self::AJOUTER . '><img src=../lib/images/plus.png width=22  border=0 valign=middle halign=right />'
                . '</a><br>';
    }

    /**
     * On affiche la liste des gammes famille budget associé à une classification
     * @param object $paramFtaModel FtaModel
     * @param int $paramIdClassificationFta2
     * @param boolean $paramIsEditable
     * @return string
     */
    public static function getHtmlClassificationGammeFamilleBudget(FtaModel $paramFtaModel, $paramIdClassificationFta2, $paramIsEditable) {
        $htmlList = new HtmlListSelect();


        $paramFtaModel->setDataFtaTableToCompare();
        $idMarque = ClassificationFta2Model::getIdClassificationTypeByTypeNameAndIdClassificationFta2($paramIdClassificationFta2, ClassificationFta2Model::FIELDNAME_ID_MARQUE);
        $dataFieldIdArcadiaGammeFamilleBudgetTMP = $paramFtaModel->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET);
        $arrayGammeFamilleBudget = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . ArcadiaGammeFamilleBudgetModel::TABLENAME . '.' . ArcadiaGammeFamilleBudgetModel::KEYNAME
                        . ', CONCAT_WS(  \' - \',' . ArcadiaGammeFamilleBudgetModel::TABLENAME
                        . '.' . ArcadiaGammeFamilleBudgetModel::KEYNAME . ',' . ArcadiaGammeFamilleBudgetModel::FIELDNAME_NOM_ARCADIA_GAMME_FAMILLE_BUDGET
                        . ') FROM ' . ArcadiaGammeFamilleBudgetModel::TABLENAME . ',' . self::TABLENAME
                        . ' WHERE ' . ArcadiaGammeFamilleBudgetModel::TABLENAME . '.' . ArcadiaGammeFamilleBudgetModel::KEYNAME
                        . ' = ' . self::TABLENAME . '.' . self::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET
                        . ' AND ' . self::FIELDNAME_ID_MARQUE . '=' . $idMarque
                        . ' ORDER BY ' . ArcadiaGammeFamilleBudgetModel::KEYNAME
        );

        /**
         * Si le chapitre est editable alors on vérifie si 
         * pour une classification nous avons plusieurs gamme famille budget associé
         * Si nous avons plusieur résultat alors on affiche la liste déroulante 
         * sinon on enregistre l'unique  résutat 
         */
//        if ($paramIsEditable == Chapitre::EDITABLE) {
//            if (count($arrayGammeFamilleBudget) > "1") {
//                $paramIsEditable = Chapitre::EDITABLE;
//            } else {
//                /**
//                 * Enregistrement de la donnée gamme famille budget
//                 */
//                if ($arrayGammeFamilleBudget) {
//                    foreach ($arrayGammeFamilleBudget as $key => $value) {
//                        $ftaModel->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET)->setFieldValue($key);
//                        $ftaModel->saveToDatabase();
//                    }
//                }
//                $paramIsEditable = Chapitre::NOT_EDITABLE;
//            }
//        }
        $htmlList->setArrayListContent($arrayGammeFamilleBudget);

        /**
         * On vérifie si la donnée en BDD se trouve dans le tableau
         * Sinon alors on vide la donnée de la BDD
         */
        $dataFieldIdArcadiaGammeFamilleBudget = FtaController::checkDataInArrayKeyList($dataFieldIdArcadiaGammeFamilleBudgetTMP, $arrayGammeFamilleBudget);



        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET
                . '_'
                . $paramFtaModel->getKeyValue()
        ;
        /**
         * Vérification des règle de validation
         */
        $dataFieldIdArcadiaGammeFamilleBudget->checkValidationRules();

        if ($dataFieldIdArcadiaGammeFamilleBudget->getDataValidationSuccessful() == TRUE) {
            $htmlList->setIsWarningMessage($dataFieldIdArcadiaGammeFamilleBudget->getDataValidationSuccessful());
            $paramFtaModel->setDataValidationSuccessfulToTrue();
        } else {
            $htmlList->setIsWarningMessage($dataFieldIdArcadiaGammeFamilleBudget->getDataValidationSuccessful());
            $htmlList->setWarningMessage($dataFieldIdArcadiaGammeFamilleBudget->getDataWarningMessage());
            $paramFtaModel->setDataValidationSuccessfulToFalse();
        }

        $htmlList->getAttributes()->getName()->setValue(FtaModel::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET);
        $htmlList->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET));
        $htmlList->setIsEditable($paramIsEditable);
        $htmlList->initAbstractHtmlSelect(
                $HtmlTableName
                , $htmlList->getLabel()
                , $dataFieldIdArcadiaGammeFamilleBudget->getFieldValue()
                , $dataFieldIdArcadiaGammeFamilleBudget->isFieldDiff()
                , $htmlList->getArrayListContent()
                , $htmlList->getIsWarningMessage()
                , $htmlList->getWarningMessage()
        );
        $htmlList->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $paramFtaModel->getKeyValue(), FtaModel::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET);

        /**
         * Description d'un champ
         */
        $htmlList->setHelp(IntranetColumnInfoModel::getFieldDesc($dataFieldIdArcadiaGammeFamilleBudget->getTableName(), $dataFieldIdArcadiaGammeFamilleBudget->getFieldName()
                        , $dataFieldIdArcadiaGammeFamilleBudget->getFieldLabel(), $htmlList
        ));

        $listeGammeFamilleBudget = $htmlList->getHtmlResult();

        return $listeGammeFamilleBudget;
    }

    /**
     * Affiche le tableau d'ajout d'une Marque arcadia à une gamme Famille Budget
     * @param string $paramIdMarque
     * @return string
     */
    public static function getHtmlTableClassificationGammeFamilleBudgetArcadia($paramIdMarque) {
        $ClassificationGammeFamilleBudgetArcadia = self::getArrayidClassificationGammeFamilleBudgetArcadiaByIdMarque($paramIdMarque);

        if ($ClassificationGammeFamilleBudgetArcadia) {
            $arrayClassificationGammeFamilleBudgetArcadiatmp = array();
            $tablesNameAndIdForeignKeyOfGammeFamilleBudgetArcadiatmp = array();

            foreach ($ClassificationGammeFamilleBudgetArcadia as $rowsClassificationGammeFamilleBudgetArcadia) {
                $idClassificationGammeFamilleBudgetArcadia = $rowsClassificationGammeFamilleBudgetArcadia[self::KEYNAME];

                $arrayIdClassificationGammeFamilleBudgetArcadia[] = $idClassificationGammeFamilleBudgetArcadia;


                $ClassificationGammeFamilleBudgetArcadiaModel = new ClassificationGammeFamilleBudgetArcadiaModel($idClassificationGammeFamilleBudgetArcadia);

                /*
                 * Tableau de données
                 */
                $arrayClassificationGammeFamilleBudgetArcadiaTmp = $ClassificationGammeFamilleBudgetArcadiaModel->getArrayClassificationGammeFamilleBudgetArcadia();

                $arrayClassificationGammeFamilleBudgetArcadia = array_replace_recursive($arrayClassificationGammeFamilleBudgetArcadiatmp, $arrayClassificationGammeFamilleBudgetArcadiaTmp);

                $arrayClassificationGammeFamilleBudgetArcadiatmp = $arrayClassificationGammeFamilleBudgetArcadia;

                /*
                 * Cette array doit être utilisé de cette manière 
                 * Array (
                 * nom de table,
                 * clé étrangère de la table présenté
                 * valeur de la clé étrangère);
                 */
                $tablesNameAndIdForeignKeyOfClassificationGammeFamilleBudgetArcadiaTmp = $ClassificationGammeFamilleBudgetArcadiaModel->getTablesNameAndIdForeignkeyOfClassificationGammeFamilleBudgetArcadia();


                $tablesNameAndIdForeignKeyOfClassificationGammeFamilleBudgetArcadia = ($tablesNameAndIdForeignKeyOfGammeFamilleBudgetArcadiatmp + $tablesNameAndIdForeignKeyOfClassificationGammeFamilleBudgetArcadiaTmp);
                $tablesNameAndIdForeignKeyOfGammeFamilleBudgetArcadiatmp = $tablesNameAndIdForeignKeyOfClassificationGammeFamilleBudgetArcadia;
                /*
                 * Vérifie si pour la Fta en cours les données ClassificationGammeFamilleBudgett sont renseigné
                 */
                if ($arrayClassificationGammeFamilleBudgetArcadia) {
                    $rightToAdd = Chapitre::NOT_EDITABLE;
                } else {
                    $rightToAdd = Chapitre::EDITABLE;
                }
            }
            /**
             * Labels
             */
            $className = $ClassificationGammeFamilleBudgetArcadiaModel->getClassName();
            $label = $ClassificationGammeFamilleBudgetArcadiaModel->getDataField(self::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET)->getFieldLabel();


            /**
             * Initilisation du tableau html
             */
            $htmlClassificationGammeFamilleBudgetArcadia = new HtmlSubForm_RNN($arrayClassificationGammeFamilleBudgetArcadia, $className, $label, $tablesNameAndIdForeignKeyOfClassificationGammeFamilleBudgetArcadia);
            $htmlClassificationGammeFamilleBudgetArcadia->setIsEditable(Chapitre::EDITABLE);
            $htmlClassificationGammeFamilleBudgetArcadia->setRightToAdd($rightToAdd);
            $htmlClassificationGammeFamilleBudgetArcadia->setLienAjouter(self::getAddLinkAfterClassificationGammeFamilleBudgetArcadia($paramIdMarque));
            $htmlClassificationGammeFamilleBudgetArcadia->setLien(self::getAddLinkBeforeClassificationGammeFamilleBudgetArcadia($paramIdMarque));
            $htmlClassificationGammeFamilleBudgetArcadia->setLienSuppression(self::getDeleteLinkClassificationGammeFamilleBudgetArcadia($paramIdMarque, $arrayIdClassificationGammeFamilleBudgetArcadia));
            $htmlClassificationGammeFamilleBudgetArcadia->setTableLabel($ClassificationGammeFamilleBudgetArcadiaModel->getTableClassificationGammeFamilleBudgetArcadiaLabel());
            $return .= $htmlClassificationGammeFamilleBudgetArcadia->getHtmlResult();
        } else {
            /*
             * Initialisation des modèles 
             */
            $label = self::LABEL_CLASSIFICATION_GAMME_FAMILLE_BUDGET;

            $htmlClassificationGammeFamilleBudgetArcadia = new HtmlSubForm_RNN($arrayClassificationGammeFamilleBudgetArcadia, $className, $label, $tablesNameAndIdForeignKeyOfClassificationGammeFamilleBudgetArcadia);
            $htmlClassificationGammeFamilleBudgetArcadia->setIsEditable(Chapitre::EDITABLE);
            $htmlClassificationGammeFamilleBudgetArcadia->setRightToAdd(Chapitre::EDITABLE);
            $htmlClassificationGammeFamilleBudgetArcadia->setLien(self::getAddLinkBeforeClassificationGammeFamilleBudgetArcadia($paramIdMarque));
            $return .= $htmlClassificationGammeFamilleBudgetArcadia->getHtmlResult();
        }
        return $return;
    }

    /**
     * Retour la liste des idClassificationGammeFamilleBudgetArcadia pour une marque donnée
     * @param int $paramIdMarque
     * @return array
     */
    private static function getArrayidClassificationGammeFamilleBudgetArcadiaByIdMarque($paramIdMarque) {

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
    function getArrayClassificationGammeFamilleBudgetArcadia() {
        $arrayTmp = DatabaseOperation::convertSqlStatementWithKeyAsFirstFieldToArray(
                        'SELECT ' . self::KEYNAME . ',' . self::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET
                        . ' FROM ' . self::TABLENAME
                        . ' WHERE ' . self::KEYNAME . '=' . $this->getKeyValue());

        if ($arrayTmp) {
            foreach ($arrayTmp as $key => $rows) {
                $array[$key] = array(
                    self::VIRTUAL_FIELDNAME_NOM_ARCADIA_GAMME_FAMILLE_BUDGET_MARQUE => $rows[self::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET],
                );
            }
        } else {
            $array = 0;
        }
        return $array;
    }

    /**
     * On identifie les clé étrangères de la table classification GammeFamilleBudget
     * Cette array doit être utilisé de cette manière 
     * Array (
     * nom de table,
     * clé étrangère de la table présenté
     * valeur de la clé étrangère);
     * @return array
     */
    function getTablesNameAndIdForeignkeyOfClassificationGammeFamilleBudgetArcadia() {
        $tablesNameAndIdForeignKeyOfClassificationRaccourcisAssociation[$this->getKeyValue()] = array(
            array(ClassificationFta2Model::TABLENAME, ClassificationFta2Model::FIELDNAME_ID_MARQUE, $this->getDataField(self::FIELDNAME_ID_MARQUE)->getFieldValue()),
            array(ArcadiaGammeFamilleBudgetModel::TABLENAME, ArcadiaGammeFamilleBudgetModel::KEYNAME, $this->getDataField(self::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET)->getFieldValue()),
        );

        return $tablesNameAndIdForeignKeyOfClassificationRaccourcisAssociation;
    }

    /**
     * Affiche le label du tableau d'une GammeFamilleBudget arcadia à une marque de classification
     * @return string
     */
    function getTableClassificationGammeFamilleBudgetArcadiaLabel() {
        $border = "style=\"border:1px solid #000;\"";
        return '<tr class=titre_tableau  align=center >' .
                '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>Actions</td>'
                . '</tr>';
    }

    /**
     *  Lien d'ajout d'une GammeFamilleBudget arcadia à une marque de classification
     * @param string $paramIdClassificationFta2
     * @return string
     */
    private static function getAddLinkBeforeClassificationGammeFamilleBudgetArcadia($paramIdClassificationFta2) {
        return 'modification_marque.php?'
                . self::FIELDNAME_ID_MARQUE . '=' . $paramIdClassificationFta2
                . '&action=' . self::AJOUTER
                . '&type=' . self::TYPE_GAMME

        ;
    }

    /**
     * Lien de suppression d'une GammeFamilleBudget arcadia à une marque de classificationion
     * @param int $paramIdMarque
     * @param array $paramArrayIdClassificationMarque
     * @return string
     */
    private static function getDeleteLinkClassificationGammeFamilleBudgetArcadia($paramIdMarque, $paramArrayIdClassificationMarque) {

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
     * Lien d'ajout d'une GammeFamilleBudget arcadia à une marque de classification après une autre  GammeFamilleBudget Arcadia
     * @param int $paramIdActivite
     * @return string
     */
    private static function getAddLinkAfterClassificationGammeFamilleBudgetArcadia($paramIdActivite) {
        return '<a href=modification_marque.php?'
                . self::FIELDNAME_ID_MARQUE . '=' . $paramIdActivite
                . '&action=' . self::AJOUTER . '&type=' . self::TYPE_GAMME . '><img src=../lib/images/plus.png width=22  border=0 valign=middle halign=right />'
                . '</a><br>';
    }

    function deleteClassificationGammeFamilleBudgetArcadia() {
        DatabaseOperation::executeComplete(
                'DELETE FROM ' . self::TABLENAME
                . ' WHERE ' . self::KEYNAME . '=' . $this->getKeyValue()
        );
    }

}

?>