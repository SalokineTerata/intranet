<?php

/**
 * Description of AnnexeListeAllergeneDicoModel 
 * @author franckwastaken
 */
class AnnexeListeAllergeneDicoModel extends AbstractModel {

    const AJOUTER = 'ajouter';
    const SUPPRIMER = 'supprimer';
    const TABLENAME = 'annexe_liste_allergene_dico';
    const KEYNAME = 'id_annexe_liste_allergene_dico';
    const FIELDNAME_NOM_ANNEXE_LISTE_ALLERGENE_DICO = 'nom_annexe_liste_allergene_dico';
    const VIRTUAL_LISTE_ALLERGENE = 'VIRTUAL_liste_allergene';

    private $nameDataTableToCompare;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
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
     * Retour la liste des IdAnnexeListeAllergeneDico
     * @return array
     */
    private static function getArrayIdAnnexeListeAllergeneDico() {

        $arrayTmp = DatabaseOperation::convertSqlStatementWithKeyAsFirstFieldToArray(
                        "SELECT " . self::KEYNAME . ',' . self::FIELDNAME_NOM_ANNEXE_LISTE_ALLERGENE_DICO
                        . " FROM " . self::TABLENAME
        );

        if ($arrayTmp) {
            foreach ($arrayTmp as $key => $rows) {
                $array[$key] = array(
                    self::VIRTUAL_LISTE_ALLERGENE => $rows[self::FIELDNAME_NOM_ANNEXE_LISTE_ALLERGENE_DICO],
                );
            }
        } else {
            $array = 0;
        }
        return $array;
    }

    /**
     * Affiche le tableau d'ajout d'un allergene 
     * @return string
     */
    public static function getHtmlTableListeAllergene() {
        $ListeAllergenes = self::getArrayIdAnnexeListeAllergeneDico();

        if ($ListeAllergenes) {
            /*
             * Vérifie si pour la Fta en cours les données ClassificationGammeFamilleBudgett sont renseigné
             */

            $rightToAdd = Chapitre::NOT_EDITABLE;
            /**
             * Labels
             */
            $className = "AnnexeListeAllergeneDicoModel";
            $label = DatabaseDescription::getFieldDocLabel(self::TABLENAME, self::KEYNAME);


            /**
             * Initilisation du tableau html
             */
            $htmlClassificationElements = new HtmlSubForm_RNN($ListeAllergenes, $className, $label);
            $htmlClassificationElements->setIsEditable(Chapitre::EDITABLE);
            $htmlClassificationElements->setRightToAdd($rightToAdd);
            $htmlClassificationElements->setLienAjouter(self::getAddLinkAfterAllergene());
            $htmlClassificationElements->setLienSuppression(self::getDeleteLinkAllergene($ListeAllergenes));
            $htmlClassificationElements->setTableLabel(DatabaseDescription::getFieldDocLabel(self::TABLENAME, self::FIELDNAME_NOM_ANNEXE_LISTE_ALLERGENE_DICO));
            $return .= $htmlClassificationElements->getHtmlResult();
        } else {
            /*
             * Initialisation des modèles 
             */
            $label =  DatabaseDescription::getFieldDocLabel(self::TABLENAME, self::KEYNAME);

            $htmlClassificationElements = new HtmlSubForm_RNN($ListeAllergenes, $className, $label);
            $htmlClassificationElements->setIsEditable(Chapitre::EDITABLE);
            $htmlClassificationElements->setRightToAdd(Chapitre::EDITABLE);
            $htmlClassificationElements->setLien(self::getAddLinkBeforeAllergene());
            $return .= $htmlClassificationElements->getHtmlResult();
        }
        return $return;
    }

    /**
     *  Lien d'ajout d'un allergène
     * @param string $paramIdClassificationElement
     * @return string
     */
    private static function getAddLinkBeforeAllergene() {
        return 'ajout_allergene.php?'
                . 'action=' . self::AJOUTER

        ;
    }

    /**
     * Lien de suppression d'un allergène
     * @param array $paramArrayIdClassificationArticleGategorieContenue
     * @return string
     */
    private static function getDeleteLinkAllergene($paramArrayIdClassificationArticleGategorieContenue) {

        foreach ($paramArrayIdClassificationArticleGategorieContenue as $key => $rows) {
            $return[$key] = '<a href=ajout_allergene.php?'                
                     . self::KEYNAME . '=' . $key
                    . '&action=' . self::SUPPRIMER . '>
                                <img src=../lib/images/supprimer.png width=22  border=0/>
                                </a><br>';
        }
        return $return;
    }

    /**
     * Lien d'ajout d'un allergène
     * @param int $paramIdElements
     * @return string
     */
    private static function getAddLinkAfterAllergene() {
        return '<a href=ajout_allergene.php?'
                . 'action=' . self::AJOUTER . '><img src=../lib/images/plus.png width=22  border=0 valign=middle halign=right />'
                . '</a><br>';
    }

    /**
     * Valeurs par défaut en cas de création
     * d'un nouvel enregistrement
     * @return mixed
     */
    static public function createNewRecordset($paramForeignKeysValuesArray = NULL) {
        $pdo = DatabaseOperation::executeComplete(
                        'INSERT INTO ' . self::TABLENAME
                        . '(' . self::KEYNAME . ',' . self::FIELDNAME_NOM_ANNEXE_LISTE_ALLERGENE_DICO . ')'
                        . 'VALUES ( NULL,\'\' )'
        );
        $key = $pdo->lastInsertId();
        return $key;
    }

    /**
     * Suppression d'un allergene
     */
    function deleteAllergeneElements() {
        DatabaseOperation::executeComplete(
                'DELETE FROM ' . self::TABLENAME
                . ' WHERE ' . self::KEYNAME . '=' . $this->getKeyValue()
        );
    }

    /**
     * On ajoute une allergene à la liste
     * @return string
     */
    function getHtmlAddAllergeneDico() {
        $htmlInputText = new HtmlInputText();


        $dataFieldIdNomAnnexeListeAllergeneDico = $this->getDataField(self::FIELDNAME_NOM_ANNEXE_LISTE_ALLERGENE_DICO);


        $HtmlTableName = self::TABLENAME
                . '_'
                . self::FIELDNAME_NOM_ANNEXE_LISTE_ALLERGENE_DICO
                . '_'
                . $this->getKeyValue()
        ;


        $htmlInputText->getAttributes()->getName()->setValue(self::FIELDNAME_NOM_ANNEXE_LISTE_ALLERGENE_DICO);
        $htmlInputText->setLabel(DatabaseDescription::getFieldDocLabel(self::TABLENAME, self::FIELDNAME_NOM_ANNEXE_LISTE_ALLERGENE_DICO));
        $htmlInputText->setIsEditable($this->getIsEditable());
        $htmlInputText->initAbstractHtmlInput(
                $HtmlTableName
                , $htmlInputText->getLabel()
                , $dataFieldIdNomAnnexeListeAllergeneDico->getFieldValue()
                , $dataFieldIdNomAnnexeListeAllergeneDico->isFieldDiff()
        );
        $htmlInputText->getEventsForm()->setOnChangeWithAjaxAutoSave(self::TABLENAME, self::KEYNAME, $this->getKeyValue(), self::FIELDNAME_NOM_ANNEXE_LISTE_ALLERGENE_DICO);

        $allergeneElements = $htmlInputText->getHtmlResult();

        return $allergeneElements;
    }

}
