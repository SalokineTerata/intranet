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
     * @param objet $paramObjetList
     * @param boolean $paramIsEditable
     * @param int $paramIdDefault
     * @return string
     */
    public static function ShowListeDeroulanteNomWorkflowByAcces($paramIdUser, $paramObjetList, $paramIsEditable, $paramIdRole, $paramIdDefault = NULL) {

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
     * @param objet $paramObjetList
     * @param boolean $paramIsEditable
     * @param int $paramIdFta
     * @return string
     */
    public static function ShowListeDeroulanteNomWorkflowByAccesAndIdFta($paramIdUser, $paramObjetList, $paramIsEditable, $paramIdFta, $paramIdRole) {

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

    static public function MigrationIntranetWorkflowAttribution($paramSitedeProduction, $paramIdFtaEtat, $paramCreateurFta) {
        if ($paramIdFtaEtat <> '8') {
            if ($paramSitedeProduction == '1' or $paramSitedeProduction == '3'or $paramSitedeProduction == '6' or $paramSitedeProduction == '11' or $paramSitedeProduction == '0') {
                switch ($paramCreateurFta) {
                    //identifiant de l'utilisateur 
                    case '-2':
                    case '-1':
                    case '43':
                    case '48':
                    case '58':
                    case '71':
                    case '207':
                    case '237':
                    case '292':
                    case '318':
                    case '426':
                    case '492':
                    case '493':
                    case '521':
                    case '534':
                    case '544':
                    case '556':
                    case '557':
                    case '558':
                    case '559':
                    case '560':
                    case '572':
                        $idFtaWorkflow = '6';
                        break;
                    case '196':
                    case '278':
                    case '371':
                    case '379':
                    case '445':
                    case '457':
                    case '473':
                    case '474':
                    case '484':
                    case '487':
                    case '501':
                    case '512':
                    case '562':
                    case '563':
                        $idFtaWorkflow = '2';
                        break;
                    case '262':
                    case '361':
                        $idFtaWorkflow = '3';
                        break;
                }
            } else {
                $idFtaWorkflow = '8';
            }
        } else {
            $idFtaWorkflow = '9';
        }

        return $idFtaWorkflow;
    }

}
