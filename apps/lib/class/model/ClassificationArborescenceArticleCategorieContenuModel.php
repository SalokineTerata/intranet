<?php

/**
 * Description of ClassificationArborescenceArticleCategorieContenuModel
 * Table de classification arborescence des articles par categorie
 *
 * @author franckwastaken
 */
class ClassificationArborescenceArticleCategorieContenuModel extends AbstractModel {

    const TABLENAME = 'classification_arborescence_article_categorie_contenu';
    const KEYNAME = 'id_classification_arborescence_article_categorie_contenu';
    const FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE = 'id_classification_arborescence_article_categorie';
    const FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU = 'nom_classification_arborescence_article_categorie_contenu';
    const VIRTUAL_FIELDNAME_NOM_CLASSIFICATION_ELEMENT = 'VIRTUAL_nom_classification_element';
    const LABEL_CLASSIFICATION_ACTIVITE_FAMILLE_VENTES = 'Catégorie';
    const AJOUTER = 'ajouter';
    const SUPPRIMER = 'supprimer';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    /**
     * Recuperation de l'id Propriétaire Groupe de la Fta pour la page d'accueil
     * @param int $paramIdClassif
     * @param string $paramSelect
     * @return int
     */
    public static function getElementClassificationFta($paramIdClassif, $paramSelect) {
        if ($paramIdClassif) {
            $classificationFta2 = new ClassificationFta2Model($paramIdClassif);
            $idType = $classificationFta2->getIdClassificationByTypeName($paramSelect);
            $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT ' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU
                            . ' FROM ' . ClassificationArborescenceArticleCategorieContenuModel::TABLENAME
                            . ' WHERE ' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME . '=' . addslashes($idType)
            );
            if ($array) {
                foreach ($array as $rows) {
                    $value = $rows[ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU];
                }
            }
        }
        return $value;
    }

    protected function setDefaultValues() {
        
    }

    /**
     * Affiche le tableau d'ajout d'une famille de ventes à une activité de classification
     * @param string $paramIdElement
     * @return string
     */
    public static function getHtmlTableClassificationElement($paramIdElement) {
        $ClassificationElement = self::getArrayIdClassificationElementByIdElement($paramIdElement);

        if ($ClassificationElement) {
            $arrayClassificationElementtmp = array();
            $tablesNameAndIdForeignKeyOfElementtmp = array();

            foreach ($ClassificationElement as $rowsClassificationElement) {
                $idClassificationElements = $rowsClassificationElement[self::KEYNAME];

                $arrayIdClassificationElements[] = $idClassificationElements;


                $ClassificationArborescenceArticleCategorieContenuModel = new ClassificationArborescenceArticleCategorieContenuModel($idClassificationElements);

                /*
                 * Tableau de données
                 */
                $arrayClassificationElementTmp = $ClassificationArborescenceArticleCategorieContenuModel->getArrayClassificationElements();

                $arrayClassificationElements = array_replace_recursive($arrayClassificationElementtmp, $arrayClassificationElementTmp);

                $arrayClassificationElementtmp = $arrayClassificationElements;

                /*
                 * Cette array doit être utilisé de cette manière 
                 * Array (
                 * nom de table,
                 * clé étrangère de la table présenté
                 * valeur de la clé étrangère);
                 */
                $tablesNameAndIdForeignKeyOfClassificationElementTmp = $ClassificationArborescenceArticleCategorieContenuModel->getTablesNameAndIdForeignkeyOfClassificatioElements();


                $tablesNameAndIdForeignKeyOfClassificationElement = ($tablesNameAndIdForeignKeyOfElementtmp + $tablesNameAndIdForeignKeyOfClassificationElementTmp);
                $tablesNameAndIdForeignKeyOfElementtmp = $tablesNameAndIdForeignKeyOfClassificationElement;
                /*
                 * Vérifie si pour la Fta en cours les données ClassificationGammeFamilleBudgett sont renseigné
                 */
                if ($arrayClassificationElements) {
                    $rightToAdd = Chapitre::NOT_EDITABLE;
                } else {
                    $rightToAdd = Chapitre::EDITABLE;
                }
            }
            /**
             * Labels
             */
            $className = $ClassificationArborescenceArticleCategorieContenuModel->getClassName();
            $label = $ClassificationArborescenceArticleCategorieContenuModel->getDataField(self::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE)->getFieldLabel();


            /**
             * Initilisation du tableau html
             */
            $htmlClassificationElements = new HtmlSubForm_RNN($arrayClassificationElements, $className, $label, $tablesNameAndIdForeignKeyOfClassificationElement);
            $htmlClassificationElements->setIsEditable(Chapitre::EDITABLE);
            $htmlClassificationElements->setRightToAdd($rightToAdd);
            $htmlClassificationElements->setLienAjouter(self::getAddLinkAfterClassificationElements($paramIdElement));
            $htmlClassificationElements->setLien(self::getAddLinkBeforeClassificationElements($paramIdElement));
            $htmlClassificationElements->setLienSuppression(self::getDeleteLinkClassificationElements($paramIdElement, $arrayIdClassificationElements));
            $htmlClassificationElements->setTableLabel($ClassificationArborescenceArticleCategorieContenuModel->getTableClassificationElementsLabel());
            $return .= $htmlClassificationElements->getHtmlResult();
        } else {
            /*
             * Initialisation des modèles 
             */
            $label = self::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE;

            $htmlClassificationElements = new HtmlSubForm_RNN($arrayClassificationElements, $className, $label, $tablesNameAndIdForeignKeyOfClassificationElement);
            $htmlClassificationElements->setIsEditable(Chapitre::EDITABLE);
            $htmlClassificationElements->setRightToAdd(Chapitre::EDITABLE);
            $htmlClassificationElements->setLien(self::getAddLinkBeforeClassificationElements($paramIdElement));
            $return .= $htmlClassificationElements->getHtmlResult();
        }
        return $return;
    }

    /**
     * Retour la liste des IdClassificationElement pour un elemnt donnée
     * @param int $paramIdElement
     * @return array
     */
    private static function getArrayIdClassificationElementByIdElement($paramIdElement) {

        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . self::KEYNAME
                        . " FROM " . self::TABLENAME
                        . " WHERE " . self::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE . "=" . $paramIdElement
        );

        return $array;
    }

    /**
     * Tableau de données, convertie le nom des champs des données aux noms des champs virtuel qui leur corresponds
     * @return int
     */
    function getArrayClassificationElements() {
        $arrayTmp = DatabaseOperation::convertSqlStatementWithKeyAsFirstFieldToArray(
                        'SELECT ' . self::KEYNAME . ',' . self::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE
                        . ' FROM ' . self::TABLENAME
                        . ' WHERE ' . self::KEYNAME . '=' . $this->getKeyValue());

        if ($arrayTmp) {
            foreach ($arrayTmp as $key => $rows) {
                $array[$key] = array(
                    self::VIRTUAL_FIELDNAME_NOM_CLASSIFICATION_ELEMENT => $rows[self::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE],
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
                        . '(' . self::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE . ')'
                        . 'VALUES (' . $paramForeignKeysValuesArray[self::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE] . ')'
        );
        $key = $pdo->lastInsertId();
        return $key;
    }

    function deleteClassificationElements() {
        $this->checkClassificationUsed();
        DatabaseOperation::executeComplete(
                'DELETE FROM ' . self::TABLENAME
                . ' WHERE ' . self::KEYNAME . '=' . $this->getKeyValue()
        );
    }

    /**
     * On vérifie si la l'element qui va être supprimé est utilisé
     */
    function checkClassificationUsed() {
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT DISTINCT " . FtaModel::FIELDNAME_CODE_ARTICLE_LDC . "," . FtaModel::FIELDNAME_LIBELLE
                        . " FROM " . ClassificationFta2Model::TABLENAME . "," . FtaModel::TABLENAME
                        . " WHERE (" . ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE . "=" . $this->getKeyValue()
                        . " OR " . ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE . "=" . $this->getKeyValue()
                        . " OR " . ClassificationFta2Model::FIELDNAME_ID_ACTIVITE . "=" . $this->getKeyValue()
                        . " OR " . ClassificationFta2Model::FIELDNAME_ID_MARQUE . "=" . $this->getKeyValue()
                        . " OR " . ClassificationFta2Model::FIELDNAME_ID_RAYON . "=" . $this->getKeyValue()
                        . " OR " . ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT . "=" . $this->getKeyValue()
                        . " OR " . ClassificationFta2Model::FIELDNAME_ID_RESEAU . "=" . $this->getKeyValue()
                        . " OR " . ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE . "=" . $this->getKeyValue() . ")"
                        . " AND " . ClassificationFta2Model::TABLENAME . "." . ClassificationFta2Model::KEYNAME . "=" . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2
                        . " ORDER BY " .FtaModel::FIELDNAME_CODE_ARTICLE_LDC
        );

        if ($array) {
            //Liste des modèles concernés
            $liste = "";
            foreach ($array as $rows) {
                $liste.= $rows[FtaModel::FIELDNAME_CODE_ARTICLE_LDC] . " " . $rows[FtaModel::FIELDNAME_LIBELLE] . "<br>";
            }
            //Averissement
            $titre = UserInterfaceMessage::FR_WARNING_CLASSIFICATION_ELEMENT_TITLE;
            $message = UserInterfaceMessage::FR_WARNING_CLASSIFICATION_ELEMENT
                    . $liste
            ;
            Lib::showMessage($titre, $message, $redirection);
        }
    }

    /**
     * On identifie les clé étrangères de la table classification arborescence article categorie contenu
     * Cette array doit être utilisé de cette manière 
     * Array (
     * nom de table,
     * clé étrangère de la table présenté
     * valeur de la clé étrangère);
     * @return array
     */
    function getTablesNameAndIdForeignkeyOfClassificatioElements() {
        $tablesNameAndIdForeignKeyOfClassificationRaccourcisAssociation[$this->getKeyValue()] = array(
            array(ClassificationArborescenceArticleCategorieModel::TABLENAME, ClassificationArborescenceArticleCategorieModel::KEYNAME, $this->getDataField(self::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE)->getFieldValue()),
        );

        return $tablesNameAndIdForeignKeyOfClassificationRaccourcisAssociation;
    }

    /**
     * Affiche le label du tableau d'une famille de ventes à une activité de classification
     * @return string
     */
    function getTableClassificationElementsLabel() {
        $border = "style=\"border:1px solid #000;\"";
        return '<tr class=titre_tableau  align=center >' .
                '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>Actions</td>'
                . '</tr>';
    }

    /**
     *  Lien d'ajout d'un element d'une classification
     * @param string $paramIdClassificationElement
     * @return string
     */
    private static function getAddLinkBeforeClassificationElements($paramIdClassificationElement) {
        return 'modification_classification_element.php?'
                . self::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE . '=' . $paramIdClassificationElement
                . '&action=' . self::AJOUTER

        ;
    }

    /**
     * Lien de suppression d'un element de classification
     * @param int $paramIdElements
     * @param array $paramArrayIdClassificationArticleGategorieContenue
     * @return string
     */
    private static function getDeleteLinkClassificationElements($paramIdElements, $paramArrayIdClassificationArticleGategorieContenue) {

        foreach ($paramArrayIdClassificationArticleGategorieContenue as $rows) {
            $return[$rows] = '<a href=modification_classification_element.php?'
                    . self::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE . '=' . $paramIdElements
                    . '&' . self::KEYNAME . '=' . $rows
                    . '&action=' . self::SUPPRIMER . '>
                                <img src=../lib/images/supprimer.png width=22  border=0/>
                                </a><br>';
        }

        return $return;
    }

    /**
     * Lien d'ajout d'un elements de classification après une autre element
     * @param int $paramIdElements
     * @return string
     */
    private static function getAddLinkAfterClassificationElements($paramIdElements) {
        return '<a href=modification_classification_element.php?'
                . self::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE . '=' . $paramIdElements
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
    function getHtmlAddClassificationElements() {
        $htmlInputText = new HtmlInputText();


        $dataFieldIdNomClassificationElement = $this->getDataField(self::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU);


        $HtmlTableName = self::TABLENAME
                . '_'
                . self::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU
                . '_'
                . $this->getKeyValue()
        ;


        $htmlInputText->getAttributes()->getName()->setValue(self::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU);
        $htmlInputText->setLabel(DatabaseDescription::getFieldDocLabel(self::TABLENAME, self::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE));
        $htmlInputText->setIsEditable($this->getIsEditable());
        $htmlInputText->initAbstractHtmlInput(
                $HtmlTableName
                , $htmlInputText->getLabel()
                , $dataFieldIdNomClassificationElement->getFieldValue()
                , $dataFieldIdNomClassificationElement->isFieldDiff()
        );
        $htmlInputText->getEventsForm()->setOnChangeWithAjaxAutoSave(self::TABLENAME, self::KEYNAME, $this->getKeyValue(), self::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU);

        $listeClassificationElements = $htmlInputText->getHtmlResult();

        return $listeClassificationElements;
    }

}
