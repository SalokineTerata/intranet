<?php

/**
 * Description of FtaWorkflowModel
 * Table des workflows
 *
 * @author franckwastaken
 */
class FtaWorkflowModel extends AbstractModel {

    const TABLENAME = 'fta_workflow';
    const KEYNAME = 'id_fta_workflow';
    const FIELDNAME_DESCRIPTION_FTA_WORKFLOW = 'description_fta_workflow';
    const FIELDNAME_ID_INTRANET_ACTIONS = 'id_intranet_actions';
    const FIELDNAME_NOM_FTA_WORKFLOW = 'nom_fta_workflow';

    /**
     * Site d'expedition de la FTA
     * @var IntranetActionsModel
     */
    private $modelIntranetActions;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);

        $this->setModelIntranetActions(
                new IntranetActionsModel(
                $this->getDataField(self::FIELDNAME_ID_INTRANET_ACTIONS)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST
                )
        );
    }

    protected function setDefaultValues() {
        
    }

    function getModelIntranetActions() {
        return $this->modelIntranetActions;
    }

    function setModelIntranetActions(IntranetActionsModel $modelIntranetActions) {
        $this->modelIntranetActions = $modelIntranetActions;
    }

    /**
     * Affiche la liste des espaces de travail pour lesquel l'utilisateur connecté à les droits d'accès
     * @param int $paramIdUser
     * @param HtmlListSelectTagName $paramObjetList
     * @param boolean $paramIsEditable
     * @param int $paramIdDefault
     * @return string
     */
    public static function showListeDeroulanteNomWorkflowByAcces($paramIdUser,  HtmlListSelectTagName $paramObjetList, $paramIsEditable, $paramIdRole, $paramIdDefault = NULL) {

        $arrayWorkflow = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::KEYNAME . ',' . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
                        . ' FROM ' . FtaWorkflowModel::TABLENAME
                        . ', ' . IntranetDroitsAccesModel::TABLENAME
                        . ', ' . FtaWorkflowStructureModel::TABLENAME
                        . ' WHERE ' . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW . '<>\'\''
                        . ' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE . '=' . $paramIdRole
                        . ' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::KEYNAME
                        . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                        . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdUser // L'utilisateur connecté
                        . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                        . ' ORDER BY ' . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
        );
        $paramObjetList->setArrayListContent($arrayWorkflow);
        $paramObjetList->getAttributes()->getName()->setValue(FtaWorkflowModel::KEYNAME);
        $paramObjetList->setLabel(DatabaseDescription::getFieldDocLabel(FtaWorkflowModel::TABLENAME, FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW));
        $paramObjetList->setIsEditable($paramIsEditable);
        $paramObjetList->setSelectedValue($paramIdDefault);

        $listeSiteWorkflow = $paramObjetList->getHtmlResult();

        return $listeSiteWorkflow;
    }

    /**
     * Affiche la liste des espaces de travail pour lesquel l'utilisateur connecté à les droits d'accès
     * et l'identifiant de la Fta en cours
     * @param int $paramIdUser
     * @param HtmlListSelect $paramObjetList
     * @param boolean $paramIsEditable
     * @param int $paramIdFta
     * @return string
     */
    public static function showListeDeroulanteNomWorkflowByAccesAndIdFta($paramIdUser, $paramObjetList, $paramIsEditable, $paramIdFta, $paramIdRole) {

        $ftaModel = new FtaModel($paramIdFta);
        $arrayWorkflow = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::KEYNAME . ',' . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
                        . ' FROM ' . FtaWorkflowModel::TABLENAME
                        . ', ' . IntranetDroitsAccesModel::TABLENAME
                        . ', ' . FtaWorkflowStructureModel::TABLENAME
                        . ' WHERE ' . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW . '<>\'\''
                        . ' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE . '=' . $paramIdRole
                        . ' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::KEYNAME
                        . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                        . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdUser // L'utilisateur connecté
                        . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                        . ' ORDER BY ' . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
        );

        $paramObjetList->setArrayListContent($arrayWorkflow);
        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_WORKFLOW
                . '_'
                . $paramIdFta
        ;
        $paramObjetList->getAttributes()->getName()->setValue(FtaModel::FIELDNAME_WORKFLOW);
        $paramObjetList->setLabel(DatabaseDescription::getFieldDocLabel(FtaWorkflowModel::TABLENAME, FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW));
        $paramObjetList->setIsEditable($paramIsEditable);
        $paramObjetList->initAbstractHtmlSelect(
                $HtmlTableName, $paramObjetList->getLabel(), $ftaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue(), NULL, $paramObjetList->getArrayListContent());
        $paramObjetList->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $paramIdFta, FtaModel::FIELDNAME_WORKFLOW);

        $listeSiteWorkflow = $paramObjetList->getHtmlResult();

        return $listeSiteWorkflow;
    }

    /**
     * Affiche la liste des espaces de travail
     * @param int $paramIdFtaWorkflow
     * @param HtmlListSelect $paramObjetList
     * @return string
     */
    public static function showListeDeroulanteNomWorkflow($paramIdFtaWorkflow, HtmlListSelect $paramObjetList) {

        $arrayWorkflow = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::KEYNAME . ',' . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
                        . ' FROM ' . FtaWorkflowModel::TABLENAME
                        . ' ORDER BY ' . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
        );

        $paramObjetList->setArrayListContent($arrayWorkflow);
        $HtmlTableName = FtaWorkflowModel::TABLENAME
                . '_'
                . FtaWorkflowModel::KEYNAME
        ;
        $paramObjetList->getAttributes()->getName()->setValue(FtaModel::FIELDNAME_WORKFLOW);
        $paramObjetList->setLabel(DatabaseDescription::getFieldDocLabel(FtaWorkflowModel::TABLENAME, FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW));
        $paramObjetList->setIsEditable(TRUE);
        $paramObjetList->initAbstractHtmlSelect(
                $HtmlTableName, $paramObjetList->getLabel(), $paramIdFtaWorkflow, NULL, $paramObjetList->getArrayListContent());

        $listeSiteWorkflow = $paramObjetList->getHtmlResult();

        return $listeSiteWorkflow;
    }

}
