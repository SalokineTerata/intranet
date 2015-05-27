<?php

/**
 * Description of FtaWorkflowModel
 * Structure des workflows
 *
 * @author franckwastaken
 */
class FtaWorkflowStructureModel extends AbstractModel {

    const TABLENAME = "fta_workflow_structure";
    const KEYNAME = "id_fta_workflow_structure";
    const FIELDNAME_ID_FTA_CHAPITRE = "id_fta_chapitre";
    const FIELDNAME_ID_FTA_PROCESSUS = "id_fta_processus";
    const FIELDNAME_ID_FTA_ROLE = "id_fta_role";
    const FIELDNAME_ID_FTA_WORKFLOW = "id_fta_workflow";

    /**
     * Chapitre du workflow de la FTA
     * @var FtaChapitre
     */
    private $modelFtaChapitre;

    /**
     * Processus du workflow de la FTA
     * @var FtaProcessus
     */
    private $modelFtaProcessus;

    /**
     * Rôle du workflow de la FTA
     * @var FtaRole
     */
    private $modelFtaRole;

    /**
     * Workflow de la fta
     * * @var FtaWorkflowModel
     */
    private $modelFtaWorkflow;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
//
//        // Tables filles (Relation 1:N, la clef étrangère dans la table actuelle)
//        $this->setModelFtaChapitre(
//                new FtaChapitreModel($this->getDataField(self::FIELDNAME_ID_FTA_CHAPITRE)->getFieldValue()
//                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
//        );
//        $this->setModelFtaProcessus(
//                new FtaProcessusModel($this->getDataField(self::FIELDNAME_ID_FTA_PROCESSUS)->getFieldValue()
//                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
//        );
//        $this->setModelFtaRole(
//                new FtaRoleModel($this->getDataField(self::FIELDNAME_ID_FTA_ROLE)->getFieldValue()
//                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
//        );
//
//        $this->setModelFtaWorkflow(
//                new FtaWorkflowModel($this->getDataField(self::FIELDNAME_ID_FTA_WORKFLOW)->getFieldValue()
//                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
//        );s
    }
    
    static public function getIdFtaWorkflowStructureByIdFtaAndIdChapitre($paramIdFta, $paramIdChapitre) {

        //Géneration de id_fta_workflow
        $modelFta = new FtaModel($paramIdFta);
        $idFtaWorkflow = $modelFta->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
        
        //Récupération du tableau de résultat
        $keyName = FtaWorkflowStructureModel::KEYNAME;
        $tableName = FtaWorkflowStructureModel::TABLENAME;
        $idFtaWorkflowName = FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW;
        $idFtaChapitreName = FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE;
        $sql = "SELECT " . $keyName . " "
                . "FROM " . $tableName . " "
                . "WHERE " . $idFtaWorkflowName . "=" . $idFtaWorkflow . " "
                . "AND " . $idFtaChapitreName . "=" . $paramIdChapitre . " "
        ;
        $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($sql);

        //Retourne uniquement la première valeur
        return $array[0][$keyName];
    }

    function getModelFtaWorkflow() {
        return $this->modelFtaWorkflow;
    }

    function getModelFtaRole() {
        return $this->modelFtaRole;
    }

    function getModelFtaProcessus() {
        return $this->modelFtaProcessus;
    }

    function getModelFtaChapitre() {
        return $this->modelFtaChapitre;
    }

    function setModelFtaWorkflow($modelFtaWorkflow) {
        $this->modelFtaWorkflow = $modelFtaWorkflow;
    }

    function setModelFtaRole(FtaRole $modelFtaRole) {
        $this->modelFtaRole = $modelFtaRole;
    }

    function setModelFtaProcessus(FtaProcessus $modelFtaProcessus) {
        $this->modelFtaProcessus = $modelFtaProcessus;
    }

    function setModelFtaChapitre(FtaChapitre $modelFtaChapitre) {
        $this->modelFtaChapitre = $modelFtaChapitre;
    }

}
