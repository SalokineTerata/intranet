<?php

/**
 * Description of ClassificationActiviteFamilleVentesArcadiaModel
 * @author tp4300001
 */
class ClassificationActiviteFamilleVentesArcadiaModel extends AbstractModel {

    const TABLENAME = 'classification_activite_famille_ventes_arcadia';
    const KEYNAME = 'id_classification_activite_famille_ventes_arcadia';
    const FIELDNAME_ID_ACTIVITE = 'id_Activite';
    const FIELDNAME_ID_ARCADIA_FAMILLE_VENTE = 'id_arcadia_famille_vente';
    const VIRTUAL_FIELDNAME_NOM_CLASSIFICATION_FAMILLE_VENTES = 'VIRTUAL_nom_classification_famille_ventes';
    const LABEL_CLASSIFICATION_ACTIVITE_FAMILLE_VENTES = 'Famille de ventes';
    const AJOUTER = 'ajouter';
    const SUPPRIMER = 'supprimer';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

    /**
     * Affiche le tableau d'ajout d'une famille de ventes à une activité de classification
     * @param string $paramIdActivite
     * @return string
     */
    public static function getHtmlTableClassificationActiviteFamilleVentesArcadia($paramIdActivite) {
        $ClassificationActiviteFamilleVentesArcadia = self::getArrayIdClassificationActiviteFamilleVentesArcadiaByIdActivite($paramIdActivite);

        if ($ClassificationActiviteFamilleVentesArcadia) {
            $arrayClassificationActiviteFamilleVentesArcadiatmp = array();
            $tablesNameAndIdForeignKeyOfActiviteFamilleVentesArcadiatmp = array();

            foreach ($ClassificationActiviteFamilleVentesArcadia as $rowsClassificationActiviteFamilleVentesArcadia) {
                $idClassificationActiviteFamilleVentesArcadia = $rowsClassificationActiviteFamilleVentesArcadia[self::KEYNAME];

                $arrayIdClassificationActiviteFamilleVentesArcadia[] = $idClassificationActiviteFamilleVentesArcadia;


                $ClassificationActiviteFamilleVentesArcadiaModel = new ClassificationActiviteFamilleVentesArcadiaModel($idClassificationActiviteFamilleVentesArcadia);

                /*
                 * Tableau de données
                 */
                $arrayClassificationRaccourcisAssociationTmp = $ClassificationActiviteFamilleVentesArcadiaModel->getArrayClassificationActiviteFamilleVentesArcadia();

                $arrayClassificationActiviteFamilleVentesArcadia = array_replace_recursive($arrayClassificationActiviteFamilleVentesArcadiatmp, $arrayClassificationRaccourcisAssociationTmp);

                $arrayClassificationActiviteFamilleVentesArcadiatmp = $arrayClassificationActiviteFamilleVentesArcadia;

                /*
                 * Cette array doit être utilisé de cette manière 
                 * Array (
                 * nom de table,
                 * clé étrangère de la table présenté
                 * valeur de la clé étrangère);
                 */
                $tablesNameAndIdForeignKeyOfClassificationActiviteFamilleVentesArcadiaTmp = $ClassificationActiviteFamilleVentesArcadiaModel->getTablesNameAndIdForeignkeyOfClassificationActiviteFamilleVentesArcadia();


                $tablesNameAndIdForeignKeyOfClassificationActiviteFamilleVentesArcadia = ($tablesNameAndIdForeignKeyOfActiviteFamilleVentesArcadiatmp + $tablesNameAndIdForeignKeyOfClassificationActiviteFamilleVentesArcadiaTmp);
                $tablesNameAndIdForeignKeyOfActiviteFamilleVentesArcadiatmp = $tablesNameAndIdForeignKeyOfClassificationActiviteFamilleVentesArcadia;
                /*
                 * Vérifie si pour la Fta en cours les données ClassificationGammeFamilleBudgett sont renseigné
                 */
                if ($arrayClassificationActiviteFamilleVentesArcadia) {
                    $rightToAdd = Chapitre::NOT_EDITABLE;
                } else {
                    $rightToAdd = Chapitre::EDITABLE;
                }
            }
            /**
             * Labels
             */
            $className = $ClassificationActiviteFamilleVentesArcadiaModel->getClassName();
            $label = $ClassificationActiviteFamilleVentesArcadiaModel->getDataField(self::FIELDNAME_ID_ARCADIA_FAMILLE_VENTE)->getFieldLabel();


            /**
             * Initilisation du tableau html
             */
            $htmlClassificationActiviteFamilleVentesArcadia = new HtmlSubForm_RNN($arrayClassificationActiviteFamilleVentesArcadia, $className, $label, $tablesNameAndIdForeignKeyOfClassificationActiviteFamilleVentesArcadia);
            $htmlClassificationActiviteFamilleVentesArcadia->setIsEditable(Chapitre::EDITABLE);
            $htmlClassificationActiviteFamilleVentesArcadia->setRightToAdd($rightToAdd);
            $htmlClassificationActiviteFamilleVentesArcadia->setLienAjouter(self::getAddLinkAfterClassificationActiviteFamilleVentesArcadia($paramIdActivite));
            $htmlClassificationActiviteFamilleVentesArcadia->setLien(self::getAddLinkBeforeClassificationActiviteFamilleVentesArcadia($paramIdActivite));
            $htmlClassificationActiviteFamilleVentesArcadia->setLienSuppression(self::getDeleteLinkClassificationActiviteFamilleVentesArcadia($paramIdActivite, $arrayIdClassificationActiviteFamilleVentesArcadia));
            $htmlClassificationActiviteFamilleVentesArcadia->setTableLabel($ClassificationActiviteFamilleVentesArcadiaModel->getTableClassificationActiviteFamilleVentesArcadiaLabel());
            $return .= $htmlClassificationActiviteFamilleVentesArcadia->getHtmlResult();
        } else {
            /*
             * Initialisation des modèles 
             */
            $label = self::LABEL_CLASSIFICATION_ACTIVITE_FAMILLE_VENTES;

            $htmlClassificationActiviteFamilleVentesArcadia = new HtmlSubForm_RNN($arrayClassificationActiviteFamilleVentesArcadia, $className, $label, $tablesNameAndIdForeignKeyOfClassificationActiviteFamilleVentesArcadia);
            $htmlClassificationActiviteFamilleVentesArcadia->setIsEditable(Chapitre::EDITABLE);
            $htmlClassificationActiviteFamilleVentesArcadia->setRightToAdd(Chapitre::EDITABLE);
            $htmlClassificationActiviteFamilleVentesArcadia->setLien(self::getAddLinkBeforeClassificationActiviteFamilleVentesArcadia($paramIdActivite));
            $return .= $htmlClassificationActiviteFamilleVentesArcadia->getHtmlResult();
        }
        return $return;
    }

    /**
     * Retour la liste des IdClassificationActiviteFamilleVentes pour une activite donnée
     * @param int $paramIdActivite
     * @return array
     */
    private static function getArrayIdClassificationActiviteFamilleVentesArcadiaByIdActivite($paramIdActivite) {

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
    function getArrayClassificationActiviteFamilleVentesArcadia() {
        $arrayTmp = DatabaseOperation::convertSqlStatementWithKeyAsFirstFieldToArray(
                        'SELECT ' . self::KEYNAME . ',' . self::FIELDNAME_ID_ARCADIA_FAMILLE_VENTE
                        . ' FROM ' . self::TABLENAME
                        . ' WHERE ' . self::KEYNAME . '=' . $this->getKeyValue());

        if ($arrayTmp) {
            foreach ($arrayTmp as $key => $rows) {
                $array[$key] = array(
                    self::VIRTUAL_FIELDNAME_NOM_CLASSIFICATION_FAMILLE_VENTES => $rows[self::FIELDNAME_ID_ARCADIA_FAMILLE_VENTE],
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

    function deleteClassificationActiviteFamilleVentesArcadia() {
        DatabaseOperation::executeComplete(
                'DELETE FROM ' . self::TABLENAME
                . ' WHERE ' . self::KEYNAME . '=' . $this->getKeyValue()
        );
    }

    /**
     * On identifie les clé étrangères de la table classification activite famille vente 
     * Cette array doit être utilisé de cette manière 
     * Array (
     * nom de table,
     * clé étrangère de la table présenté
     * valeur de la clé étrangère);
     * @return array
     */
    function getTablesNameAndIdForeignkeyOfClassificationActiviteFamilleVentesArcadia() {
        $tablesNameAndIdForeignKeyOfClassificationRaccourcisAssociation[$this->getKeyValue()] = array(
            array(ClassificationFta2Model::TABLENAME, ClassificationFta2Model::FIELDNAME_ID_ACTIVITE, $this->getDataField(self::FIELDNAME_ID_ACTIVITE)->getFieldValue()),
            array(ArcadiaFamilleVenteModel::TABLENAME, ArcadiaFamilleVenteModel::KEYNAME, $this->getDataField(self::FIELDNAME_ID_ARCADIA_FAMILLE_VENTE)->getFieldValue()),
        );

        return $tablesNameAndIdForeignKeyOfClassificationRaccourcisAssociation;
    }

    /**
     * Affiche le label du tableau d'une famille de ventes à une activité de classification
     * @return string
     */
    function getTableClassificationActiviteFamilleVentesArcadiaLabel() {
        $border = "style=\"border:1px solid #000;\"";
        return '<tr class=titre_tableau  align=center >' .
                '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_ID_ARCADIA_FAMILLE_VENTE)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>Actions</td>'
                . '</tr>';
    }

    /**
     *  Lien d'ajout d'une famille de ventes à une activité de classification
     * @param string $paramIdClassificationFta2
     * @return string
     */
    private static function getAddLinkBeforeClassificationActiviteFamilleVentesArcadia($paramIdClassificationFta2) {
        return 'modification_famille_ventes.php?'
                . self::FIELDNAME_ID_ACTIVITE . '=' . $paramIdClassificationFta2
                . '&action=' . self::AJOUTER

        ;
    }

    /**
     * Lien de suppression d'une famille de ventes à une activité de classification
     * @param int $paramIdActivite
     * @param array $paramArrayIdClassificationFamilleVentesArcadia
     * @return string
     */
    private static function getDeleteLinkClassificationActiviteFamilleVentesArcadia($paramIdActivite, $paramArrayIdClassificationFamilleVentesArcadia) {

        foreach ($paramArrayIdClassificationFamilleVentesArcadia as $rows) {
            $return[$rows] = '<a href=modification_famille_ventes.php?'
                    . self::FIELDNAME_ID_ACTIVITE . '=' . $paramIdActivite
                    . '&' . self::KEYNAME . '=' . $rows
                    . '&action=' . self::SUPPRIMER . '>
                                <img src=../lib/images/supprimer.png width=22  border=0/>
                                </a><br>';
        }

        return $return;
    }

    /**
     * Lien d'ajout dd'une famille de ventes à une activité de classification après une autre Famille de ventes
     * @param int $paramIdActivite
     * @return string
     */
    private static function getAddLinkAfterClassificationActiviteFamilleVentesArcadia($paramIdActivite) {
        return '<a href=modification_famille_ventes.php?'
                . self::FIELDNAME_ID_ACTIVITE . '=' . $paramIdActivite
                . '&action=' . self::AJOUTER . '><img src=../lib/images/plus.png width=22  border=0 valign=middle halign=right />'
                . '</a><br>';
    }

    /**
     * On affiche la liste des familles de ventes à une activité de classification
     * @param int $paramIdFta
     * @param int $paramIdClassificationFta2
     * @param boolean $paramIsEditable
     * @return string
     */
    public static function getHtmlListeClassificationActiviteFamilleVentesArcadia($paramIdFta, $paramIdClassificationFta2, $paramIsEditable) {
        $htmlList = new HtmlListSelect();

        $ftaModel = new FtaModel($paramIdFta);
        $idActivite = ClassificationFta2Model::getIdClassificationTypeByTypeNameAndIdClassificationFta2($paramIdClassificationFta2, ClassificationFta2Model::FIELDNAME_ID_ACTIVITE);
        $dataFieldIdArcadiaFamilleVente = $ftaModel->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_FAMILLE_VENTE);
        $arrayClassificationFamilleVenteArcadia = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . ArcadiaFamilleVenteModel::TABLENAME . '.' . ArcadiaFamilleVenteModel::KEYNAME
                        . ', CONCAT_WS(  \' - \',' . ArcadiaFamilleVenteModel::TABLENAME . '.' . ArcadiaFamilleVenteModel::KEYNAME
                        . ',' . ArcadiaFamilleVenteModel::TABLENAME . '.' . ArcadiaFamilleVenteModel::FIELDNAME_NOM_ARCADIA_FAMILLE_VENTE
                        . ') FROM ' . ArcadiaFamilleVenteModel::TABLENAME . ',' . self::TABLENAME
                        . ' WHERE ' . ArcadiaFamilleVenteModel::TABLENAME . '.' . ArcadiaFamilleVenteModel::KEYNAME
                        . ' = ' . self::TABLENAME . '.' . self::FIELDNAME_ID_ARCADIA_FAMILLE_VENTE
                        . ' AND ' . self::FIELDNAME_ID_ACTIVITE . '=' . $idActivite
                        . ' ORDER BY ' . ArcadiaFamilleVenteModel::FIELDNAME_NOM_ARCADIA_FAMILLE_VENTE
        );

        /**
         * Si le chapitre est editable alors on vérifie si 
         * pour une classification nous avons plusieurs raccourcis de classification associé
         * Si nous avons plusieur résultat alors on affiche la liste déroulante 
         * sinon on enregistre l'unique  résutat 
         */
//        if ($paramIsEditable == Chapitre::EDITABLE) {
//            if (count($arrayClassificationFamilleVenteArcadia) > "1") {
//                $paramIsEditable = Chapitre::EDITABLE;
//            } else {
//                /**
//                 * Enregistrement de la donnée raccourcis de classification
//                 */
//                if ($arrayClassificationFamilleVenteArcadia) {
//                    foreach ($arrayClassificationFamilleVenteArcadia as $key => $value) {
//                        $ftaModel->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_FAMILLE_VENTE)->setFieldValue($key);
//                        $ftaModel->saveToDatabase();
//                    }
//                }
//                $paramIsEditable = Chapitre::NOT_EDITABLE;
//            }
//        }
        $htmlList->setArrayListContent($arrayClassificationFamilleVenteArcadia);


        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_ID_ARCADIA_FAMILLE_VENTE
                . '_'
                . $paramIdFta
        ;

        /**
         * Vérification des règle de validation
         */
        $dataFieldIdArcadiaFamilleVente->checkValidationRules();

        if ($dataFieldIdArcadiaFamilleVente->getDataValidationSuccessful() == TRUE) {
            $htmlList->setIsWarningMessage($dataFieldIdArcadiaFamilleVente->getDataValidationSuccessful());
        } else {
            $htmlList->setIsWarningMessage($dataFieldIdArcadiaFamilleVente->getDataValidationSuccessful());
            $htmlList->setWarningMessage($dataFieldIdArcadiaFamilleVente->getDataWarningMessage());
        }

        $htmlList->getAttributes()->getName()->setValue(FtaModel::FIELDNAME_ID_ARCADIA_FAMILLE_VENTE);
        $htmlList->setLabel(DatabaseDescription::getFieldDocLabel(self::TABLENAME, self::FIELDNAME_ID_ARCADIA_FAMILLE_VENTE));
        $htmlList->setIsEditable($paramIsEditable);
        $htmlList->initAbstractHtmlSelect(
                $HtmlTableName
                , $htmlList->getLabel()
                , $dataFieldIdArcadiaFamilleVente->getFieldValue()
                , $dataFieldIdArcadiaFamilleVente->isFieldDiff()
                , $htmlList->getArrayListContent()
                , $htmlList->getIsWarningMessage()
                , $htmlList->getWarningMessage()
        );
        $htmlList->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $paramIdFta, FtaModel::FIELDNAME_ID_ARCADIA_FAMILLE_VENTE);

        $listeClassificationRaccourcis = $htmlList->getHtmlResult();

        return $listeClassificationRaccourcis;
    }

}
