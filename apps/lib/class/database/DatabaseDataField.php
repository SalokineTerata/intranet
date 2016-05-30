<?php

/**
 * Cet objet représente une données d'un recordset.
 * Elle reprend toute les caractéristiques de DatabaseDescriptionField
 * en y ajoutat la notion de données lié au Recorset (par référence)
 *
 * @author salokine.terata@gmail.com
 * @license see LICENSE.TXT at the root of this project
 * @version 1.0
 */
class DatabaseDataField extends DatabaseDescriptionField {

    /**
     * Référence au recordset associé à ce champs
     * @var DatabaseRecord
     */
    protected $recordsetRef = NULL;

    /**
     * Personnalisation du label
     * @var mixed
     */
    private $labelCustom;

    /**
     * Le dataField en cours respect-il ces règles de validation associées
     * @var boolean
     */
    private $dataValidationSuccessful;

    /**
     * Le dataField en cours ne respect pas ces règles de validation associées
     * alors on affiche un message sur l'interface
     * @var boolean
     */
    private $dataWarningMessage;

    /**
     * Le dataField en cours est-elle verrouillé ?
     * @var boolean
     */
    private $isFieldLock;

    /**
     * Lien du changment d'état d'un champ verrouillé/déverrouillé
     * @var string
     */
    private $linkFieldLock;

    /**
     * Création de l'objet
     * @param string $paramFieldName Nom du champs
     * @param DatabaseRecord $paramRecordset Référence au recordset
     */
    public function __construct($paramFieldName, DatabaseRecord &$paramRecordsetRef) {
        $this->setRecordsetRef($paramRecordsetRef);
        parent::setFieldName($paramFieldName);
        parent::__construct($this->getRecordsetRef()->getTableDescription(), $this->getFieldName());
    }

    /**
     * Référence au Recorset
     * @return DatabaseRecord
     */
    public function &getRecordsetRef() {
        return $this->recordsetRef;
    }

    /**
     * Définit la référence au Recordset
     * @param DatabaseRecord $recordset
     */
    public function setRecordsetRef(DatabaseRecord &$recordsetRef) {
        $this->recordsetRef = $recordsetRef;
    }

    /**
     * Retourne la valeur du champs
     * @return mixed
     */
    public function getFieldValue() {
        return $this->getRecordsetRef()->getFieldValue(parent::getFieldName());
    }

    /**
     * Définit la valeur du champs
     * @param mixed $paramFieldValue
     */
    public function setFieldValue($paramFieldValue) {
        $this->getRecordsetRef()->setFieldValue(parent::getFieldName(), $paramFieldValue);
    }

    /**
     * return $this->getRecordSetOfFta()->isFieldDiff(self::FIELDNAME_NOM_DEMANDEUR);
     */
    public function isFieldDiff() {
        return $this->getRecordsetRef()->isFieldDiff(parent::getFieldName());
    }

    /**
     * Initialisation de la vérification des règles de validation
     */
    public function checkValidationRules() {
        /**
         * Vérification du champ initialisé
         */
        $this->getRecordsetRef()->checkValidationRules($this->getFieldValue(), parent::getTagsValidationRules());
        /**
         * Inialisation du résultat et du message
         */
        $this->setDataValidationSuccessful();
        $this->setDataWarningMessage();
    }

  
    /**
     * Initialisation de la vérification du verrouillage du champs
     * @param FtaModel $paramFtaModel
     * @param boolean $paramIsEditable
     */
    public function checkLockField(FtaModel $paramFtaModel,$paramIsEditable) {
        /**
         * Vérification du champ initialisé
         */
        $isFieldLock = FtaVerrouillageChampsModel::isFieldLock($this, $paramFtaModel);
        /**
         * Génération du lien pour verrouillé/déverrouillé
         */
        $linkFieldLock = FtaVerrouillageChampsModel::linkFieldLock($isFieldLock, $this, $paramFtaModel,$paramIsEditable);
        /**
         * Inialisation du résultat
         */
        $this->setIsFieldLock($isFieldLock);
        $this->setLinkFieldLock($linkFieldLock);
    }

    function getDataValidationSuccessful() {
        return $this->dataValidationSuccessful;
    }

    function setDataValidationSuccessful() {
        $this->dataValidationSuccessful = $this->getRecordsetRef()->getDataValidationSuccessful();
    }

    function getDataWarningMessage() {
        return $this->dataWarningMessage;
    }

    function setDataWarningMessage() {
        $this->dataWarningMessage = $this->getRecordsetRef()->getDataWarningMessage();
    }

    function getIsFieldLock() {
        return $this->isFieldLock;
    }

    function setIsFieldLock($isLockField) {
        $this->isFieldLock = $isLockField;
    }

    function getLinkFieldLock() {
        return $this->linkFieldLock;
    }

    function setLinkFieldLock($linkFieldLock) {
        $this->linkFieldLock = $linkFieldLock;
    }

    /**
     * Retourne le label personnalisé pour le champ
     * @return mixed
     */
    private function getLabelCustom() {
        return $this->labelCustom;
    }

    /**
     * Personnalise le label du champs
     * @param mixed $paramLabelCustom
     */
    public function setLabelCustom($paramLabelCustom) {
        $this->labelCustom = $paramLabelCustom;
    }

    /**
     * Retourne le label pour le champ.
     * Si il n'y a pas de champs personnalisé de défini, le label par défaut
     * configuré en base de donnée sera utilisé.
     * @return mixed
     */
    public function getFieldLabel() {
        $return = NULL;

        if ($this->getLabelCustom() != NULL) {
            $return = $this->getLabelCustom();
        } else {
            $return = parent::getFieldLabel();
        }

        return $return;
    }

    /**
     * Nom de la clef associée la table dans laquelle il y a ce champs
     * @return string
     */
    public function getKeyName() {
        return $this->getRecordsetRef()->getKeyName();
    }

    /**
     * Valeur de la clef associée l'enregistrement dans lequel il y a ce champs
     * @return string
     */
    public function getKeyValue() {
        return $this->getRecordsetRef()->getKeyValue();
    }

}

?>
