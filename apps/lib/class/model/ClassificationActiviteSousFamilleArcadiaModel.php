<?php

/**
 * Description of ClassificationActiviteSousFamilleArcadiaModel
 * @author franckwastaken
 */
class ClassificationActiviteSousFamilleArcadiaModel extends AbstractModel {

    const TABLENAME = 'classification_activite_sous_famille_arcadia';
    const KEYNAME = 'id_classification_activite_sous_famille_arcadia';
    const FIELDNAME_ID_ACTIVITE = 'id_Activite';
    const FIELDNAME_ID_ARCADIA_SOUS_FAMILLE = 'id_arcadia_sous_famille';
    const VIRTUAL_FIELDNAME_NOM_CLASSIFICATION_SOUS_FAMILLE = 'VIRTUAL_nom_classification_sous_famille';
    const LABEL_CLASSIFICATION_ACTIVITE_SOUS_FAMILLE = 'Sous Famille';
    const AJOUTER = 'ajouter';
    const SUPPRIMER = 'supprimer';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

    /**
     * Affiche le tableau d'ajout d'une sous famille à une activité de classification
     * @param string $paramIdActivite
     * @return string
     */
    public static function getHtmlTableClassificationActiviteSousFamilleArcadia($paramIdActivite) {
        $ClassificationActiviteSousFamilleArcadia = self::getArrayIdClassificationActiviteSousFamilleArcadiaByIdActivite($paramIdActivite);

        if ($ClassificationActiviteSousFamilleArcadia) {
            $arrayClassificationActiviteSousFamilleArcadiatmp = array();
            $tablesNameAndIdForeignKeyOfActiviteSousFamilleArcadiatmp = array();

            foreach ($ClassificationActiviteSousFamilleArcadia as $rowsClassificationActiviteSousFamilleArcadia) {
                $idClassificationActiviteSousFamilleArcadia = $rowsClassificationActiviteSousFamilleArcadia[self::KEYNAME];

                $arrayIdClassificationActiviteSousFamilleArcadia[] = $idClassificationActiviteSousFamilleArcadia;


                $ClassificationActiviteSousFamilleArcadiaModel = new ClassificationActiviteSousFamilleArcadiaModel($idClassificationActiviteSousFamilleArcadia);

                /*
                 * Tableau de données
                 */
                $arrayClassificationActiviteSousFamilleArcadiaTmp = $ClassificationActiviteSousFamilleArcadiaModel->getArrayClassificationActiviteSousFamilleArcadia();

                $arrayClassificationActiviteSousFamilleArcadia = array_replace_recursive($arrayClassificationActiviteSousFamilleArcadiatmp, $arrayClassificationActiviteSousFamilleArcadiaTmp);

                $arrayClassificationActiviteSousFamilleArcadiatmp = $arrayClassificationActiviteSousFamilleArcadia;

                /*
                 * Cette array doit être utilisé de cette manière 
                 * Array (
                 * nom de table,
                 * clé étrangère de la table présenté
                 * valeur de la clé étrangère);
                 */
                $tablesNameAndIdForeignKeyOfClassificationActiviteFamilleVentesArcadiaTmp = $ClassificationActiviteSousFamilleArcadiaModel->getTablesNameAndIdForeignkeyOfClassificationActiviteSousFamilleArcadia();


                $tablesNameAndIdForeignKeyOfClassificationActiviteFamilleVentesArcadia = ($tablesNameAndIdForeignKeyOfActiviteSousFamilleArcadiatmp + $tablesNameAndIdForeignKeyOfClassificationActiviteFamilleVentesArcadiaTmp);
                $tablesNameAndIdForeignKeyOfActiviteSousFamilleArcadiatmp = $tablesNameAndIdForeignKeyOfClassificationActiviteFamilleVentesArcadia;
                /*
                 * Vérifie si pour la Fta en cours les données ClassificationGammeFamilleBudgett sont renseigné
                 */
                if ($arrayClassificationActiviteSousFamilleArcadia) {
                    $rightToAdd = Chapitre::NOT_EDITABLE;
                } else {
                    $rightToAdd = Chapitre::EDITABLE;
                }
            }
            /**
             * Labels
             */
            $className = $ClassificationActiviteSousFamilleArcadiaModel->getClassName();
            $label = $ClassificationActiviteSousFamilleArcadiaModel->getDataField(self::FIELDNAME_ID_ARCADIA_SOUS_FAMILLE)->getFieldLabel();


            /**
             * Initilisation du tableau html
             */
            $htmlClassificationActiviteFamilleVentesArcadia = new HtmlSubForm_RNN($arrayClassificationActiviteSousFamilleArcadia, $className, $label, $tablesNameAndIdForeignKeyOfClassificationActiviteFamilleVentesArcadia);
            $htmlClassificationActiviteFamilleVentesArcadia->setIsEditable(Chapitre::EDITABLE);
            $htmlClassificationActiviteFamilleVentesArcadia->setRightToAdd($rightToAdd);
            $htmlClassificationActiviteFamilleVentesArcadia->setLienAjouter(self::getAddLinkAfterClassificationActiviteSousFamilleArcadia($paramIdActivite));
            $htmlClassificationActiviteFamilleVentesArcadia->setLien(self::getAddLinkBeforeClassificationActiviteSousFamilleArcadia($paramIdActivite));
            $htmlClassificationActiviteFamilleVentesArcadia->setLienSuppression(self::getDeleteLinkClassificationActiviteSousFamilleArcadia($paramIdActivite, $arrayIdClassificationActiviteSousFamilleArcadia));
            $htmlClassificationActiviteFamilleVentesArcadia->setTableLabel($ClassificationActiviteSousFamilleArcadiaModel->getTableClassificationActiviteSousFamilleArcadiaLabel());
            $return .= $htmlClassificationActiviteFamilleVentesArcadia->getHtmlResult();
        } else {
            /*
             * Initialisation des modèles 
             */
            $label = self::LABEL_CLASSIFICATION_ACTIVITE_SOUS_FAMILLE;

            $htmlClassificationActiviteFamilleVentesArcadia = new HtmlSubForm_RNN($arrayClassificationActiviteSousFamilleArcadia, $className, $label, $tablesNameAndIdForeignKeyOfClassificationActiviteFamilleVentesArcadia);
            $htmlClassificationActiviteFamilleVentesArcadia->setIsEditable(Chapitre::EDITABLE);
            $htmlClassificationActiviteFamilleVentesArcadia->setRightToAdd(Chapitre::EDITABLE);
            $htmlClassificationActiviteFamilleVentesArcadia->setLien(self::getAddLinkBeforeClassificationActiviteSousFamilleArcadia($paramIdActivite));
            $return .= $htmlClassificationActiviteFamilleVentesArcadia->getHtmlResult();
        }
        return $return;
    }

    /**
     * Retour la liste des IdClassificationActiviteSousFamille pour une activite donnée
     * @param int $paramIdActivite
     * @return array
     */
    private static function getArrayIdClassificationActiviteSousFamilleArcadiaByIdActivite($paramIdActivite) {

        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . self::KEYNAME
                        . " FROM " . self::TABLENAME
                        . " WHERE " . self::FIELDNAME_ID_ACTIVITE . "=" . $paramIdActivite
        );

        return $array;
    }

    /**
     * Tableau de données, convertie le nom des champs des données aux noms des champs virtuel qui leur corresponds
     * @return int
     */
    function getArrayClassificationActiviteSousFamilleArcadia() {
        $arrayTmp = DatabaseOperation::convertSqlStatementWithKeyAsFirstFieldToArray(
                        'SELECT ' . self::KEYNAME . ',' . self::FIELDNAME_ID_ARCADIA_SOUS_FAMILLE
                        . ' FROM ' . self::TABLENAME
                        . ' WHERE ' . self::KEYNAME . '=' . $this->getKeyValue());

        if ($arrayTmp) {
            foreach ($arrayTmp as $key => $rows) {
                $array[$key] = array(
                    self::VIRTUAL_FIELDNAME_NOM_CLASSIFICATION_SOUS_FAMILLE => $rows[self::FIELDNAME_ID_ARCADIA_SOUS_FAMILLE],
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
                        . '(' . self::FIELDNAME_ID_ACTIVITE . ')'
                        . 'VALUES (' . $paramForeignKeysValuesArray[self::FIELDNAME_ID_ACTIVITE] . ')'
        );
        $key = $pdo->lastInsertId();
        return $key;
    }

    function deleteClassificationActiviteSousFamilleArcadia() {
        DatabaseOperation::executeComplete(
                'DELETE FROM ' . self::TABLENAME
                . ' WHERE ' . self::KEYNAME . '=' . $this->getKeyValue()
        );
    }

    /**
     * On identifie les clé étrangères de la table classification activite sous famille
     * Cette array doit être utilisé de cette manière 
     * Array (
     * nom de table,
     * clé étrangère de la table présenté
     * valeur de la clé étrangère);
     * @return array
     */
    function getTablesNameAndIdForeignkeyOfClassificationActiviteSousFamilleArcadia() {
        $tablesNameAndIdForeignKeyOfClassificationRaccourcisAssociation[$this->getKeyValue()] = array(
            array(ClassificationFta2Model::TABLENAME, ClassificationFta2Model::FIELDNAME_ID_ACTIVITE, $this->getDataField(self::FIELDNAME_ID_ACTIVITE)->getFieldValue()),
            array(ArcadiaSousFamilleModel::TABLENAME, ArcadiaSousFamilleModel::KEYNAME, $this->getDataField(self::FIELDNAME_ID_ARCADIA_SOUS_FAMILLE)->getFieldValue()),
        );

        return $tablesNameAndIdForeignKeyOfClassificationRaccourcisAssociation;
    }

    /**
     * Affiche le label du tableau d'une sous famille à une activité de classification
     * @return string
     */
    function getTableClassificationActiviteSousFamilleArcadiaLabel() {
        $border = "style=\"border:1px solid #000;\"";
        return '<tr class=titre_tableau  align=center >' .
                '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_ID_ARCADIA_SOUS_FAMILLE)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>Actions</td>'
                . '</tr>';
    }

    /**
     *  Lien d'ajout d'une sous famille à une activité de classification
     * @param string $paramIdClassificationFta2
     * @return string
     */
    private static function getAddLinkBeforeClassificationActiviteSousFamilleArcadia($paramIdClassificationFta2) {
        return 'modification_sous_famille.php?'
                . self::FIELDNAME_ID_ACTIVITE . '=' . $paramIdClassificationFta2
                . '&action=' . self::AJOUTER

        ;
    }

    /**
     * Lien de suppression d'une sous famille à une activité de classification
     * @param int $paramIdActivite
     * @param array $paramArrayIdClassificationSousFamilleArcadia
     * @return string
     */
    private static function getDeleteLinkClassificationActiviteSousFamilleArcadia($paramIdActivite, $paramArrayIdClassificationSousFamilleArcadia) {

        foreach ($paramArrayIdClassificationSousFamilleArcadia as $rows) {
            $return[$rows] = '<a href=modification_sous_famille.php?'
                    . self::FIELDNAME_ID_ACTIVITE . '=' . $paramIdActivite
                    . '&' . self::KEYNAME . '=' . $rows
                    . '&action=' . self::SUPPRIMER . '>
                                <img src=../lib/images/supprimer.png width=22  border=0/>
                                </a><br>';
        }

        return $return;
    }

    /**
     * Lien d'ajout d'une sous famille à une activité de classification après une autre Sous famille
     * @param int $paramIdActivite
     * @return string
     */
    private static function getAddLinkAfterClassificationActiviteSousFamilleArcadia($paramIdActivite) {
        return '<a href=modification_sous_famille.php?'
                . self::FIELDNAME_ID_ACTIVITE . '=' . $paramIdActivite
                . '&action=' . self::AJOUTER . '><img src=../lib/images/plus.png width=22  border=0 valign=middle halign=right />'
                . '</a><br>';
    }

    /**
     * On affiche la liste des sous famille à une activité de classification
     * @param objet $paramFtaModel
     * @param int $paramIdClassificationFta2
     * @param boolean $paramIsEditable
     * @return string
     */
    public static function getHtmlListeClassificationActiviteSousFamilleArcadia(FtaModel $paramFtaModel, $paramIdClassificationFta2, $paramIsEditable) {
        $htmlList = new HtmlListSelect();


        $paramFtaModel->setDataFtaTableToCompare();

        $idActivite = ClassificationFta2Model::getIdClassificationTypeByTypeNameAndIdClassificationFta2($paramIdClassificationFta2, ClassificationFta2Model::FIELDNAME_ID_ACTIVITE);

        $dataFieldIdArcadiaSousFamilleTMP = $paramFtaModel->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_SOUS_FAMILLE);

        $arrayClassificationActiviteSousFamilleArcadia = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . ArcadiaSousFamilleModel::TABLENAME . '.' . ArcadiaSousFamilleModel::KEYNAME
                        . ', CONCAT_WS(  \' - \',' . ArcadiaSousFamilleModel::TABLENAME . '.' . ArcadiaSousFamilleModel::KEYNAME
                        . ',' . ArcadiaSousFamilleModel::TABLENAME . '.' . ArcadiaSousFamilleModel::FIELDNAME_NOM_ARCADIA_SOUS_FAMILLE
                        . ') FROM ' . ArcadiaSousFamilleModel::TABLENAME . ',' . self::TABLENAME
                        . ' WHERE ' . ArcadiaSousFamilleModel::TABLENAME . '.' . ArcadiaSousFamilleModel::KEYNAME
                        . ' = ' . self::TABLENAME . '.' . self::FIELDNAME_ID_ARCADIA_SOUS_FAMILLE
                        . ' AND ' . self::FIELDNAME_ID_ACTIVITE . '=' . $idActivite
                        . ' ORDER BY ' . ArcadiaSousFamilleModel::FIELDNAME_NOM_ARCADIA_SOUS_FAMILLE
        );

        /**
         * Si le chapitre est editable alors on vérifie si 
         * pour une classification nous avons plusieurs raccourcis de classification associé
         * Si nous avons plusieur résultat alors on affiche la liste déroulante 
         * sinon on enregistre l'unique  résutat 
         */
//        if ($paramIsEditable == Chapitre::EDITABLE) {
//            if (count($arrayClassificationActiviteSousFamilleArcadia) > "1") {
//                $paramIsEditable = Chapitre::EDITABLE;
//            } else {
//                /**
//                 * Enregistrement de la donnée raccourcis de classification
//                 */
//                if ($arrayClassificationActiviteSousFamilleArcadia) {
//                    foreach ($arrayClassificationActiviteSousFamilleArcadia as $key => $value) {
//                        $ftaModel->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_SOUS_FAMILLE)->setFieldValue($key);
//                        $ftaModel->saveToDatabase();
//                    }
//                }
//                $paramIsEditable = Chapitre::NOT_EDITABLE;
//            }
//        }
        $htmlList->setArrayListContent($arrayClassificationActiviteSousFamilleArcadia);

        /**
         * On vérifie si la donnée en BDD se trouve dans le tableau
         * Sinon alors on vide la donnée de la BDD
         */
        $dataFieldIdArcadiaSousFamille = FtaController::checkDataInArrayKeyList($dataFieldIdArcadiaSousFamilleTMP, $arrayClassificationActiviteSousFamilleArcadia);


        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_ID_ARCADIA_SOUS_FAMILLE
                . '_'
                . $paramFtaModel->getKeyValue()
        ;


        /**
         * Vérification des règle de validation
         */
        $dataFieldIdArcadiaSousFamille->checkValidationRules();

        if ($dataFieldIdArcadiaSousFamille->getDataValidationSuccessful() == TRUE) {
            $htmlList->setIsWarningMessage($dataFieldIdArcadiaSousFamille->getDataValidationSuccessful());
            $paramFtaModel->setDataValidationSuccessfulToTrue();
        } else {
            $htmlList->setIsWarningMessage($dataFieldIdArcadiaSousFamille->getDataValidationSuccessful());
            $htmlList->setWarningMessage($dataFieldIdArcadiaSousFamille->getDataWarningMessage());
            $paramFtaModel->setDataValidationSuccessfulToFalse();
        }
        $htmlList->getAttributes()->getName()->setValue(FtaModel::FIELDNAME_ID_ARCADIA_SOUS_FAMILLE);
        $htmlList->setLabel(DatabaseDescription::getFieldDocLabel(self::TABLENAME, self::FIELDNAME_ID_ARCADIA_SOUS_FAMILLE));
        $htmlList->setIsEditable($paramIsEditable);
        $htmlList->initAbstractHtmlSelect(
                $HtmlTableName
                , $htmlList->getLabel()
                , $dataFieldIdArcadiaSousFamille->getFieldValue()
                , $dataFieldIdArcadiaSousFamille->isFieldDiff()
                , $htmlList->getArrayListContent()
                , $htmlList->getIsWarningMessage()
                , $htmlList->getWarningMessage()
        );
        $htmlList->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $paramFtaModel->getKeyValue(), FtaModel::FIELDNAME_ID_ARCADIA_SOUS_FAMILLE);

        /**
         * Description d'un champ
         */
        $htmlList->setHelp(IntranetColumnInfoModel::getFieldDesc($dataFieldIdArcadiaSousFamille->getTableName(), $dataFieldIdArcadiaSousFamille->getFieldName()
                        , $dataFieldIdArcadiaSousFamille->getFieldLabel(), $htmlList
        ));

        $listeClassificationSousFamilleArcadia = $htmlList->getHtmlResult();

        return $listeClassificationSousFamilleArcadia;
    }

}
