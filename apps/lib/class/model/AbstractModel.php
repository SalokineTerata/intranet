<?php

/**
 * Description of Model
 * Classe abstraite définissant le modèle de table en base de données
 *
 * @author salokine
 */
abstract class AbstractModel implements AbstractModelInterface {

    const TABLENAME = 'undefined';
    const KEYNAME = 'undefined';
    const DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST = DatabaseRecord::DEFAULT_IS_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST;

    private $keyvalue;
    private $record;
    private $isEditable;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = self::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {

        $this->setRecord(new DatabaseRecord(static::TABLENAME, $paramId, NULL, NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist));
        $this->setKeyValue($this->getRecord()->getKeyValue());

        /**
         * Si il s'agit d'un nouvel enregistrement,
         * alors on charge les valeurs par défaut
         * définies dans la classe fille.
         */
        if ($paramId == NULL) {
            $this->setDefaultValues();
        }
    }

    /**
     * Définition des valeurs par défaut
     */
    protected abstract function setDefaultValues();

    /**
     * Créé et réserve un nouvel enresgitrement dans la table
     * @return mixed
     */
 
    public static function createNewRecordset($paramForeignKeysValuesArray = NULL) {
        
    }

    public static function getClassName() {
        return get_called_class();
    }

    public function getIsEditable() {
        return $this->isEditable;
    }

    public function setIsEditable($isEditable) {
        $this->isEditable = $isEditable;
    }

    public function getKeyValue() {
        return $this->keyvalue;
    }

    /**
     * Retourne le records
     * @return DatabaseRecord
     */
    private function getRecord() {
        return $this->record;
    }

    private function setKeyValue($paramKeyValue) {
        $this->keyvalue = $paramKeyValue;
    }

    /**
     * 
     * @param DatabaseRecord $paramRecord
     */
    private function setRecord(DatabaseRecord $paramRecord) {
        $this->record = $paramRecord;
    }

    /**
     * Champ au format DataField
     * @return DatabaseDataField
     */
    public function getDataField($paramFieldName) {
        return $this->getRecord()->getDataFieldByFieldName($paramFieldName);
    }

    public function saveToDatabase() {
        $this->getRecord()->saveToDatabase();
    }

    public function getHtmlDataField($paramFieldName) {
        return Html::convertDataFieldToHtml(
                        $this->getDataField($paramFieldName)
                        , $this->getIsEditable()
        );
    }

}
