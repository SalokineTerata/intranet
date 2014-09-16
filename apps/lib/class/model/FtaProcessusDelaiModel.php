<?php

/**
 * Description of UserModel
 * Table des utilisateurs
 *
 * @author salokine
 */
class FtaProcessusDelaiModel extends AbstractModel {

    const TABLENAME = "fta_processus_delai";
    const KEYNAME = "id_fta_processus_delai";
    const FIELDNAME_ID_FTA = "id_fta";
    const FIELDNAME_ID_FTA_PROCESSUS = "id_fta_processus";
    const FIELDNAME_DATE_ECHEANCE_PROCESSUS = "date_echeance_processus";
    const FIELDNAME_VALIDE = "valide_fta_processus_delai";

    /**
     * FTA associée
     * @var FtaModel
     */
    private $modelFta;

    /**
     * Processus associée
     * @var FtaProcessusModel
     */
    private $modelFtaProcessus;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);

        $this->setModelFtaById($this->getDataField(self::FIELDNAME_ID_FTA)->getFieldValue());
        $this->setModelFtaProcessusById($this->getDataField(self::FIELDNAME_ID_FTA_PROCESSUS)->getFieldValue());
    }

    /**
     * Retourne la FTA
     * @return FtaModel
     */
    public function getModelFta() {
        return $this->modelFta;
    }

    /**
     * Retourne le processus
     * @return FtaProcessusModel
     */
    public function getModelFtaProcessus() {
        return $this->modelFtaProcessus;
    }

    /**
     * Défini la FTA
     * @param FtaModel 
     */
    private function setModelFta(FtaModel $modelFta) {
        $this->modelFta = $modelFta;
    }

    /**
     * Défini le Processus
     * @param FtaProcessusModel
     */
    private function setModelFtaProcessus(FtaProcessusModel $modelFtaProcessus) {
        $this->modelFtaProcessus = $modelFtaProcessus;
    }

    /**
     * Défini la FTA par son Id
     * @param mixed 
     */
    public function setModelFtaById($id) {
        $this->getDataField(self::FIELDNAME_ID_FTA)->setFieldValue($id);
        $this->setModelFta(
                new FtaModel($this->getDataField(self::FIELDNAME_ID_FTA)->getFieldValue(), DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
    }

    /**
     * Défini le Processus par son Id
     * @param mixed 
     */
    public function setModelFtaProcessusById($id) {
        $this->getDataField(self::FIELDNAME_ID_FTA_PROCESSUS)->setFieldValue($id);
        $this->setModelFtaProcessus(
                new FtaProcessusModel($this->getDataField(self::FIELDNAME_ID_FTA_PROCESSUS)->getFieldValue(), DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
    }

}

?>
