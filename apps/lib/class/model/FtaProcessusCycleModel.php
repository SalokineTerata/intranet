<?php

/**
 * Description of FtaModel
 * Table des FTA
 *
 * @author salokine
 */
class FtaProcessusCycleModel extends AbstractModel {

    const TABLENAME = "fta_processus_cycle";
    const KEYNAME = "id_fta_processus_cycle";
    const FIELDNAME_PROCESSUS_INIT = "id_init_fta_processus";
    const FIELDNAME_PROCESSUS_NEXT = "id_next_fta_processus";
    const FIELDNAME_FTA_ETAT = "id_etat_fta_processus_cycle";
    const FIELDNAME_WORKFLOW = "id_fta_workflow";
    const FIELDNAME_DELAI = "delai_semaine_depuis_origine";

    /**
     * Processus initial
     * @var FtaProcessusModel
     */
    private $modelProcessusInit;

    /**
     * Processus suivant
     * @var FtaProcessusModel
     */
    private $modelProcessusNext;

    /**
     * Etat de la FTA
     * @var FtaEtatModel
     */
    private $modelFtaEtat;

    /**
     * Etat de la FTA
     * @var FtaWorkflowModel
     */
    private $modelFtaWorkflowModel;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);

        $this->setModelProcessusInit(
                new FtaProcessusModel(
                $this->getDataField(self::FIELDNAME_PROCESSUS_INIT)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST
                )
        );
        $this->setModelProcessusNext(
                new FtaProcessusModel(
                $this->getDataField(self::FIELDNAME_PROCESSUS_NEXT)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST
                )
        );
        $this->setModelFtaEtat(
                new FtaEtatModel(
                $this->getDataField(self::FIELDNAME_FTA_ETAT)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST
                )
        );
        $this->setModelFtaWorkflowModel(
                new FtaWorkflowModel(
                $this->getDataField(self::FIELDNAME_WORKFLOW)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST
                )
        );
    }

    public function getModelProcessusInit() {
        return $this->modelProcessusInit;
    }

    public function getModelProcessusNext() {
        return $this->modelProcessusNext;
    }

    public function getModelFtaEtat() {
        return $this->modelFtaEtat;
    }

    function getModelFtaWorkflowModel() {
        return $this->modelFtaWorkflowModel;
    }

    private function setModelProcessusInit(FtaProcessusModel $modelProcessusInit) {
        $this->modelProcessusInit = $modelProcessusInit;
    }

    private function setModelProcessusNext(FtaProcessusModel $modelProcessusNext) {
        $this->modelProcessusNext = $modelProcessusNext;
    }

    private function setModelFtaEtat(FtaEtatModel $modelFtaEtat) {
        $this->modelFtaEtat = $modelFtaEtat;
    }

    function setModelFtaWorkflowModel(FtaWorkflowModel $modelFtaWorkflowModel) {
        $this->modelFtaWorkflowModel = $modelFtaWorkflowModel;
    }

}
