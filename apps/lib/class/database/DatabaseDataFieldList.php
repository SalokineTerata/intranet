<?php

/**
 * Présentation de la classe
 *
 * @author salokine@gmail.com
 * @license see LICENSE.TXT at the root of this project
 * @version 1.0
 */
class DatabaseDataFieldList {

    /**
     * Liste de champs de type DatabaseDataField
     * Structuré de la manière suivante:
     * [Nom de la table][Nom du champ]=DatabaseDataField
     * @var array
     */
    protected $arrayDatabaseDataField = array();

    /**
     * Constructeur
     */
    public function __construct() {
        ;
    }

    /**
     * Enregistre un DatabaseDataField
     * @param DatabaseDataField $paramDatabaseDataField
     */
    public function setDatabaseDataField(DatabaseDataField $paramDatabaseDataField) {

        $this->arrayDatabaseDataField[$paramDatabaseDataField->getTableName()]
                [$paramDatabaseDataField->getFieldName()] = $paramDatabaseDataField;
    }

    public function getDatabaseDataFieldByName($paramTableName, $paramFieldName) {
        return $this->arrayDatabaseDataField[$paramTableName][$paramFieldName];
    }

    public function getDatabaseDataFieldByDataField(DatabaseDataField $paramDatabaseDataField) {
        return $this->arrayDatabaseDataField[$paramDatabaseDataField->getTableName()]
                [$paramDatabaseDataField->getFieldName()];
    }

}

?>
