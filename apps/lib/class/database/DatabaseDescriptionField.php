<?php

/**
 * Cette classe permet d'accéder aux informations relative à un champs
 * un base de données
 *
 * @author salokine.terata@gmail.com
 * @license see LICENSE.TXT at the root of this project
 * @version 1.0
 */
class DatabaseDescriptionField {

    /**
     * Nom du champ SQL
     * @var string 
     */
    private $fieldName;

    /**
     * Objet représentant la table
     * @var DatabaseDescriptionTable 
     */
    private $table;

    /**
     * Liste des règles de validation
     * @var DatabaseDescriptionTable 
     */
    private $tagsValidationRules;

    /**
     * Boolean verrouillage d'un champ
     * @var DatabaseDescriptionTable 
     */
    private $defaultFieldLockPrimaryFta;

    /**
     * Construit un champs
     * @param DatabaseDescriptionTable $paramTable Table du champs
     * @param string $paramFieldName Nom du champs
     */
    public function __construct(DatabaseDescriptionTable $paramTable, $paramFieldName) {
        $this->setTable($paramTable);
        $this->setFieldName($paramFieldName);
        $this->setTagsValidationRules();
        $this->setDefaultFieldLockPrimaryFta();
    }

    /**
     * Défini la table à laquelle est rattachée le champ
     * @param DatabaseDescriptionTable $paramTable
     * @return DatabaseDescriptionTable
     */
    private function setTable(DatabaseDescriptionTable $paramTable) {
        return $this->table = $paramTable;
    }

    /**
     * Défini le nom du champ pour lequel on souhaite obtenir de la 
     * description.
     * @param string $paramFieldName
     * @return type
     */
    protected function setFieldName($paramFieldName) {
        return $this->fieldName = $paramFieldName;
    }

    /**
     * Retourne l'aide en ligne relative à ce champs.
     * @return string
     */
    public function getFieldHelp() {
        return DatabaseDescription::getFieldDocHelp(
                        $this->getTableName(), $this->getFieldName());
    }

    /**
     * Renvoi le nom du champs
     * @return string
     */
    public function getFieldName() {
        return $this->fieldName;
    }

    /**
     * Le champs est-il la clef primaire ?
     * @return boolean Oui ou Non
     */
    public function isPrimaryKey() {
        return DatabaseDescription::isFieldPrimaryKey($this->getTableName(), $this->getFieldName());
    }

    private function getTable() {
        return $this->table;
    }

    /**
     * Renvoi le nom de la table à laquelle appartient le champs
     * @return string
     */
    public function getTableName() {
        return $this->getTable()->getTableName();
    }

    function getTagsValidationRules() {
        return $this->tagsValidationRules;
    }

    function setTagsValidationRules() {
        $this->tagsValidationRules = DatabaseDescription::getTagsValidationRules
                        ($this->getTableName(), $this->getFieldName());
    }

    /*     * *
     * Return un boolean déterminant si le champs doit être verrouilé par défaut
     */

    function getDefaultFieldLockPrimaryFta() {
        return $this->defaultFieldLockPrimaryFta;
    }

    function setDefaultFieldLockPrimaryFta() {
        $this->defaultFieldLockPrimaryFta = DatabaseDescription::getDefaultFieldLockPrimaryFta
                        ($this->getTableName(), $this->getFieldName());
    }

    /**
     * Nom du champs d'un point de vue applicatif (son label) tel que
     * défini par défaut en base de données.
     * @return string
     */
    public function getFieldLabel() {
        return DatabaseDescription::getFieldDocLabel
                        ($this->getTableName(), $this->getFieldName());
    }

    /**
     * Requête SQL construisant la liste de choix possible pour le champs
     * @return string
     */
    public function getFieldContentSQL() {
        return DatabaseDescription::getFieldDocContentSQL
                        ($this->getTableName(), $this->getFieldName());
    }

    /**
     * Retourne la taille de l'objet HTML à utiliser pour représenter graphiquement
     * le champs
     * @return string
     */
    public function getFieldSizeOfHtmlObject() {
        return DatabaseDescription::getFieldDocSizeOfHtmlObject
                        ($this->getTableName(), $this->getFieldName());
    }

    /**
     * Retourne le type d'objet HTML à utiliser pour représenter graphiquement
     * le champs
     * @return string
     */
    public function getFieldTypeOfHtmlObject() {
        return DatabaseDescription::getFieldDocTypeOfHtmlObject
                        ($this->getTableName(), $this->getFieldName());
    }

    /**
     * Résultat de la requête SQL construisant la liste de choix possible 
     * pour le champs 
     * @return array
     */
    public function getFieldContentArray() {
        return DatabaseDescription::getFieldDocContentArray
                        ($this->getTableName(), $this->getFieldName());
    }

    public function getHtmlPropertyId() {
        return AbstractHtmlGlobalElement::HTML_PROPERTY_NAME_ID
                . '='
                . Html::$PREFIXE_ID_DATA
                . '_'
                . $this->getDataField()->getTableName()
                . '_'
                . $this->getDataField()->getFieldName()
        ;
    }

    public function getReferencedTableName() {
        return DatabaseDescription::getFieldDocForeignTable
                        ($this->getTableName(), $this->getFieldName());
    }

    public function getReferencedFieldName() {
        return DatabaseDescription::getFieldDocForeignKey
                        ($this->getTableName(), $this->getFieldName());
    }

    public function getFieldsToDisplay() {
        return DatabaseDescription::getFieldsToDisplay
                        ($this->getTableName(), $this->getFieldName());
    }

    public function getFieldsToLock() {
        return DatabaseDescription::getFieldsToLock
                        ($this->getTableName(), $this->getFieldName());
    }

    public function getFieldsToOrder() {
        return DatabaseDescription::getFieldsToOrder
                        ($this->getTableName(), $this->getFieldName());
    }

    public function getRightToAdd() {
        return DatabaseDescription::getRightToAdd
                        ($this->getTableName(), $this->getFieldName());
    }

    public function getConditionSql() {
        return DatabaseDescription::getConditionSql
                        ($this->getTableName(), $this->getFieldName());
    }

}
