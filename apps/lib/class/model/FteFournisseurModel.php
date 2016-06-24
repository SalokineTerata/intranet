<?php

/**
 * Description of GeoModel
 * Table FteFournisseurModel
 *
 * @author franckwastaken
 */
class FteFournisseurModel extends AbstractModel {

    const TABLENAME = 'fte_fournisseur';
    const KEYNAME = 'id_fte_fournisseur';
    const FIELDNAME_NOM_FTE_FOURNISSEUR = 'nom_fte_fournisseur';
    const VIRTUAL_FIELDNAME_NOM_FTE_FOURNISSEUR = 'VIRTUAL_nom_fte_fournisseur';
    const LABEL_CLASSIFICATION_ACTIVITE_FAMILLE_VENTES = 'Catégorie';
    const AJOUTER = 'ajouter';
    const SUPPRIMER = 'supprimer';

    /**
     * Nom de la fonction de gestion des versions
     */
    private $nameDataTableToCompare;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    function getNameDataTableToCompare() {
        return $this->nameDataTableToCompare;
    }

    function setNameDataTableToCompare() {
        $this->nameDataTableToCompare = NULL;
    }

    protected function setDefaultValues() {
        
    }

    /**
     * Affiche le tableau d'ajout d'une famille de ventes à une activité de classification
     * @return string
     */
    public static function getHtmlTableFteElement() {
        $FteElement = self::getArrayIdFteElement();

        if ($FteElement) {
            foreach ($FteElement as $rowsFteElement) {
                $idFteFournisseur = $rowsFteElement[self::KEYNAME];

                $arrayFteElement[] = $idFteFournisseur;
            }
            $arrayTableFteFournisseur = self::getArrayTableFteFournisseur();


            $fteFournisseurModel = new FteFournisseurModel($idFteFournisseur);
            $rightToAdd = Chapitre::NOT_EDITABLE;

            /**
             * Labels
             */
            $className = $fteFournisseurModel->getClassName();
            $label = $fteFournisseurModel->getDataField(self::KEYNAME)->getFieldLabel();


            /**
             * Initilisation du tableau html
             */
            $htmlClassificationElements = new HtmlSubForm_RNN($arrayTableFteFournisseur, $className, $label);
            $htmlClassificationElements->setIsEditable(Chapitre::EDITABLE);
            $htmlClassificationElements->setRightToAdd($rightToAdd);
            $htmlClassificationElements->setLienAjouter(self::getAddLinkAfterFteFournisseurs());
            $htmlClassificationElements->setLien(self::getAddLinkBeforeFteFournisseurs());
            $htmlClassificationElements->setLienSuppression(self::getDeleteLinkFteFournisseurs($arrayFteElement));
            $htmlClassificationElements->setTableLabel($fteFournisseurModel->getTableFteFournisseurLabel());
            $return .= $htmlClassificationElements->getHtmlResult();
        } else {
            /*
             * Initialisation des modèles 
             */
            $label = self::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE;

            $htmlClassificationElements = new HtmlSubForm_RNN($arrayTableFteFournisseur, $className, $label);
            $htmlClassificationElements->setIsEditable(Chapitre::EDITABLE);
            $htmlClassificationElements->setRightToAdd(Chapitre::EDITABLE);
            $htmlClassificationElements->setLien(self::getAddLinkBeforeFteFournisseurs());
            $return .= $htmlClassificationElements->getHtmlResult();
        }
        return $return;
    }

    /**
     * Retour la liste des fournisseurs
     * @return array
     */
    private static function getArrayIdFteElement() {

        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . self::KEYNAME
                        . " FROM " . self::TABLENAME
        );

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
                        . '(' . self::FIELDNAME_NOM_FTE_FOURNISSEUR . ')'
                        . 'VALUES (NULL)'
        );
        $key = $pdo->lastInsertId();
        return $key;
    }

    /**
     * Suppression d'un fournisseur 
     */
    function deleteFteFournisseurs() {

        $this->checkFteFournisseurUsed();
        DatabaseOperation::executeComplete(
                'DELETE FROM ' . self::TABLENAME
                . ' WHERE ' . self::KEYNAME . '=' . $this->getKeyValue()
        );
    }

    /**
     * On vérifie si la Fte qui va e^tre supprimé est utilisé
     */
    function checkFteFournisseurUsed() {
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT DISTINCT " . AnnexeEmballageModel::KEYNAME . "," . AnnexeEmballageModel::FIELDNAME_REFERENCE_FOURNISSEUR_ANNEXE_EMBALLAGE
                        . " FROM " . AnnexeEmballageModel::TABLENAME
                        . " WHERE " . AnnexeEmballageModel::FIELDNAME_ID_FTE_FOURNISSEUR . "=" . $this->getKeyValue()
                        . " ORDER BY " . AnnexeEmballageModel::FIELDNAME_REFERENCE_FOURNISSEUR_ANNEXE_EMBALLAGE
        );

        if ($array) {
            //Liste des modèles concernés
            $liste = "";
            foreach ($array as $rows) {
                $liste.= $rows[AnnexeEmballageModel::FIELDNAME_REFERENCE_FOURNISSEUR_ANNEXE_EMBALLAGE] . "<br>";
            }
            //Averissement
            $titre = UserInterfaceMessage::FR_WARNING_FTE_FOURNISSEUR_TITLE;
            $message = UserInterfaceMessage::FR_WARNING_FTE_FOURNISSEUR
                    . $liste
            ;
            Lib::showMessage($titre, $message, $redirection);
        }
    }

    /**
     * Affiche le label du tableau d'une famille de ventes à une activité de classification
     * @return string
     */
    function getTableFteFournisseurLabel() {
        $border = "style=\"border:1px solid #000;\"";
        return '<tr class=titre_tableau  align=center >' .
                '<td ' . $border . '>' . $this->getDataField(self::KEYNAME)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>Actions</td>'
                . '</tr>';
    }

    /**
     *  Lien d'ajout d'un element d'une classification
     * @return string
     */
    private static function getAddLinkBeforeFteFournisseurs() {
        return 'modification_fte_fournisseurs.php?'
                . '&action=' . self::AJOUTER

        ;
    }

    /**
     * Lien de suppression d'un element de classification
     * @param array $paramArrayIdFteFournisseurs
     * @return string
     */
    private static function getDeleteLinkFteFournisseurs($paramArrayIdFteFournisseurs) {

        foreach ($paramArrayIdFteFournisseurs as $rows) {
            $return[$rows] = '<a href=modification_fte_fournisseurs.php?'
                    . self::KEYNAME . '=' . $rows
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
    private static function getAddLinkAfterFteFournisseurs() {
        return '<a href=modification_fte_fournisseurs.php?'
                . 'action=' . self::AJOUTER . '><img src=../lib/images/plus.png width=22  border=0 valign=middle halign=right />'
                . '</a><br>';
    }

    public static function getArrayTableFteFournisseur() {
        $arrayTmp = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . self::KEYNAME
                        . ' FROM ' . self::TABLENAME
                        . ' ORDER BY ' . self::FIELDNAME_NOM_FTE_FOURNISSEUR
        );

        if ($arrayTmp) {
            foreach ($arrayTmp as $rows) {
                $array[$rows[self::KEYNAME]] = array(
                    self::VIRTUAL_FIELDNAME_NOM_FTE_FOURNISSEUR => $rows[self::KEYNAME],
                );
            }
        } else {
            $array = 0;
        }
        return $array;
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

?>