<?php

/**
 * Représente la description d'une table
 *
 * @author salokine
 * @license see LICENSE.TXT at the root of this project
 * @version 1.0
 */
class DatabaseDescriptionTable {

    /**
     * Nom de la table
     * @var string
     */
    private $tableName;

    /**
     * Construit un objet de type DatabaseDescriptionTable
     * @param string $paramTableName nom de la table
     */
    public function __construct($paramTableName) {
        $this->setTableName($paramTableName);
    }

    /**
     * Retourne le nom de la table
     * @return string Nom de la table
     */
    public function getTableName() {
        return $this->tableName;
    }

    /**
     * Retourne le nom de la table formatée pour des instructions SQL
     * @return string nom de la table au format SQL
     */
    public function getTableNameForSqlClause() {
        return DatabaseOperation::convertTableNameToSqlClause($this->getTableName());
    }

    /**
     * Définit le nom de la table
     * @param strinf $paramTableName nom de la table
     */
    public function setTableName($paramTableName) {
        $this->tableName = $paramTableName;
    }

    /**
     * Retourne le nom de la clef
     * @return string Nom de la clef
     */
    public function getKeyName() {
        return DatabaseDescription::getTableKeyName($this->getTableName());
    }

    /**
     * Retourne la liste des noms des champs de la table
     * @return array Tableau d'objet DatabaseDescriptionField
     */
    public function getFieldsNameArray() {
        return DatabaseDescription::getArrayFieldsNameOfTable($this->getTableName());
    }

    /**
     * Retourne la liste des champs de la table sous forme d'un tableau Php
     * @return array liste des champs de type DatabaseDescriptionField
     */
    public function getFieldsArray() {
        return DatabaseDescription::getArrayFieldsOfTable($this->getTableName());
    }

    /**
     * Vérifie si le nom du champs transmis correspond effectivement à la clef
     * @param string $paramFieldName
     * @return boolean
     */
    public function isKeyName($paramFieldName) {

        $return = false;
        if (self::getKeyName() == $paramFieldName) {
            $return = true;
        }
        return $return;
    }

    /**
     * Le champs existe-il dans cette table ?
     * @param string $paramFieldName
     * @return boolean
     */
    public function isFieldNameExist($paramFieldName) {
        return DatabaseDescription::isFieldExistInThisTable($this->getTableName(), $paramFieldName);
    }

}

?>
