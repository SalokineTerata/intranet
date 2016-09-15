<?php

/**
 * Description of FtaModel
 * Table des FTA
 *
 * @author salokine
 */
class FtaProcessusCycleModel extends AbstractModel {

    const TABLENAME = 'fta_processus_cycle';
    const KEYNAME = 'id_fta_processus_cycle';
    const FIELDNAME_PROCESSUS_INIT = 'id_init_fta_processus';
    const FIELDNAME_PROCESSUS_NEXT = 'id_next_fta_processus';
    const FIELDNAME_FTA_ETAT = 'id_etat_fta_processus_cycle';
    const FIELDNAME_WORKFLOW = 'id_fta_workflow';
    const FIELDNAME_DELAI = 'delai_semaine_depuis_origine';

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

    protected function setDefaultValues() {
        
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

    /**
     * Liste des processus pouvant être validé
     * @param int $paramIdWorkflow
     * @return array
     */
    public static function getArrayProcessusValidationFTA($paramIdWorkflow) {
        $arrayProcessusValidation = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT t1 .' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                        . ' FROM ' . FtaProcessusCycleModel::TABLENAME . ' as t1'
                        . ' LEFT OUTER JOIN ' . FtaProcessusCycleModel::TABLENAME . ' as t2'
                        . ' ON  t1 .' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                        . '= t2 .' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                        . ' WHERE  t2 .' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT . ' IS NULL'
                        . ' AND  t1 .' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT . ' IS NULL'
                        . ' AND  t1 .' . FtaProcessusCycleModel::FIELDNAME_WORKFLOW . '=' . $paramIdWorkflow
        );
        foreach ($arrayProcessusValidation as $rowsProcessusValidation) {
            $idProcessus[] = $rowsProcessusValidation[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT];
        }
        return $idProcessus;
    }

    /**
     * On obtient le proceesus suivant pour un processus donné selon son espace de travail 
     * @param int $paramIdFta
     * @param int $paramIdFtaWorkflow
     * @param string $paramAbreviationFtaEtat
     * @param int $paramIdFtaProcessus
     * @return array
     */
    public static function getArrayProccusNextValidateFromIdFta($paramIdFta, $paramIdFtaWorkflow, $paramAbreviationFtaEtat, $paramIdFtaProcessus) {
        //Recherches des processus suivants
        $arrayProcessusCycle = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT . ',' . FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS
                        . ' FROM ' . FtaProcessusCycleModel::TABLENAME . ',' . FtaProcessusModel::TABLENAME
                        . ',' . FtaSuiviProjetModel::TABLENAME . ',' . FtaWorkflowStructureModel::TABLENAME
                        . ' WHERE ' . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . '=\'' . $paramAbreviationFtaEtat . '\' '
                        . ' AND ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME
                        . '=' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                        . '=' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                        . '=' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                        . '=' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                        . ' AND ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . '=\'' . $paramIdFtaProcessus . '\' '
                        . ' AND ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT . ' IS NOT NULL'
                        . ' AND ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . ' <> 0'
                        . ' AND ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA . '=' . $paramIdFta
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . $paramIdFtaWorkflow
        );

        return $arrayProcessusCycle;
    }

}
