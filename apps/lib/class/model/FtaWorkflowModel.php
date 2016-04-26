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
    const FIELDNAME_WORKFLOW_ACTIF = 'actif_fta_workflow';
    const ID_WORKFLOW_PRESENTATION = '9';
    const ID_WORKFLOW_COUPE_FE = '6';
    const ID_WORKFLOW_INTERF = '8';
    const NOM_FTA_WORKFLOW_SOUS_TRAI = 'sous_traitance_industrielle';
    const NOM_FTA_WORKFLOW_MDD_SANS = 'MDD_sans_etiquetage_interne';
    const NOM_FTA_WORKFLOW_MDD_AVEC = 'MDD_avec_etiquetage_interne';
    const NOM_FTA_WORKFLOW_FE_AVEC = 'coupe_et_frais_emballe_avec_etiquetage_interne';
    const NOM_FTA_WORKFLOW_FE_SANS = 'coupe_et_frais_emballe_sans_etiquetage_interne';
    const NOM_FTA_WORKFLOW_INTERF = 'interfiliale';
    const NOM_FTA_WORKFLOW_PRESENT = 'presentation';
    const ID_FTA_WORKFLOW_NON_DEFINI = '-1';
    const WORKFLOW_ACTIF_FALSE = '0';
    const WORKFLOW_ACTIF_TRUE = '1';
    const WORKFLOW_NON_ACTIF_1 = UserInterfaceMessage::FR_WARNING_WORKFLOW_INACTIF_1;
    const WORKFLOW_NON_ACTIF_2 = UserInterfaceMessage::FR_WARNING_WORKFLOW_INACTIF_2;
    const WORKFLOW_NON_ACTIF_TITLE = UserInterfaceMessage::FR_WARNING_WORKFLOW_INACTIF_TITLE;

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
     * On récupère les espaces de travail actif
     * @return string
     */
    public static function checkActifWorkflowSQL() {
        $req = " AND " . self::TABLENAME . "." . self::KEYNAME
                . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                . " AND " . self::FIELDNAME_WORKFLOW_ACTIF . "=" . self::WORKFLOW_ACTIF_TRUE;
        return $req;
    }

    public static function checkActifWorkflow($paramIdFtaWorkflow) {

        $arrayActifWorkflow = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        " SELECT " . self::TABLENAME . "." . self::FIELDNAME_WORKFLOW_ACTIF
                        . "," . self::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
                        . " FROM " . self::TABLENAME
                        . " WHERE  " . self::KEYNAME . "=" . $paramIdFtaWorkflow);
        foreach ($arrayActifWorkflow as $rowsActifWorkflow) {
            $actif = $rowsActifWorkflow[self::FIELDNAME_WORKFLOW_ACTIF];
            $nom = $rowsActifWorkflow[self::FIELDNAME_DESCRIPTION_FTA_WORKFLOW];
            if (!$actif) {
                $titre = self::WORKFLOW_NON_ACTIF_TITLE;
                $message = self::WORKFLOW_NON_ACTIF_1 . $nom . self::WORKFLOW_NON_ACTIF_2;
                $redirection = "";
                Lib::showMessage($titre, $message, $redirection);
            }
        }
    }

    /**
     * Affiche la liste des espaces de travail pour lesquel l'utilisateur connecté à les droits d'accès
     * @param int $paramIdUser
     * @param HtmlListSelectTagName $paramObjetList
     * @param boolean $paramIsEditable
     * @param int $paramIdDefault
     * @return string
     */
    public static function showListeDeroulanteNomWorkflowByAcces($paramIdUser, HtmlListSelectTagName $paramObjetList, $paramIsEditable, $paramIdRole, $paramIdDefault = NULL) {

        $arrayWorkflow = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . self::TABLENAME . '.' . self::KEYNAME . ',' . self::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
                        . ' FROM ' . self::TABLENAME
                        . ', ' . IntranetDroitsAccesModel::TABLENAME
                        . ', ' . FtaWorkflowStructureModel::TABLENAME
                        . ' WHERE ' . self::FIELDNAME_DESCRIPTION_FTA_WORKFLOW . '<>\'\''
                        . ' AND ' . self::TABLENAME . '.' . self::FIELDNAME_ID_INTRANET_ACTIONS
                        . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE . '=' . $paramIdRole
                        . ' AND ' . self::TABLENAME . '.' . self::KEYNAME
                        . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                        . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdUser // L'utilisateur connecté
                        . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                        /**
                         * Ticket 49823 en 3.1 activation/désactivation d'un workflow
                         */
//                        . ' AND ' . self::FIELDNAME_WORKFLOW_ACTIF . '=' . self::WORKFLOW_ACTIF_TRUE
                        . ' ORDER BY ' . self::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
        );
        $paramObjetList->setArrayListContent($arrayWorkflow);
        $paramObjetList->getAttributes()->getName()->setValue(self::KEYNAME);
        $paramObjetList->setLabel(DatabaseDescription::getFieldDocLabel(self::TABLENAME, self::FIELDNAME_DESCRIPTION_FTA_WORKFLOW));
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
                        'SELECT DISTINCT ' . self::TABLENAME . '.' . self::KEYNAME . ',' . self::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
                        . ' FROM ' . self::TABLENAME
                        . ', ' . IntranetDroitsAccesModel::TABLENAME
                        . ', ' . FtaWorkflowStructureModel::TABLENAME
                        . ' WHERE ' . self::FIELDNAME_DESCRIPTION_FTA_WORKFLOW . '<>\'\''
                        . ' AND ' . self::TABLENAME . '.' . self::FIELDNAME_ID_INTRANET_ACTIONS
                        . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE . '=' . $paramIdRole
                        . ' AND ' . self::TABLENAME . '.' . self::KEYNAME
                        . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                        . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdUser // L'utilisateur connecté
                        . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                        . ' ORDER BY ' . self::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
        );

        $paramObjetList->setArrayListContent($arrayWorkflow);
        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_WORKFLOW
                . '_'
                . $paramIdFta
        ;
        $paramObjetList->getAttributes()->getName()->setValue(FtaModel::FIELDNAME_WORKFLOW);
        $paramObjetList->setLabel(DatabaseDescription::getFieldDocLabel(self::TABLENAME, self::FIELDNAME_DESCRIPTION_FTA_WORKFLOW));
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
                        'SELECT DISTINCT ' . self::TABLENAME . '.' . self::KEYNAME . ',' . self::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
                        . ' FROM ' . self::TABLENAME
                        . ' WHERE ' . self::FIELDNAME_WORKFLOW_ACTIF . '=' . self::WORKFLOW_ACTIF_TRUE
                        . ' ORDER BY ' . self::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
        );

        $paramObjetList->setArrayListContent($arrayWorkflow);
        $HtmlTableName = self::TABLENAME
                . '_'
                . self::KEYNAME
        ;
        $paramObjetList->getAttributes()->getName()->setValue(FtaModel::FIELDNAME_WORKFLOW);
        $paramObjetList->setLabel(DatabaseDescription::getFieldDocLabel(self::TABLENAME, self::FIELDNAME_DESCRIPTION_FTA_WORKFLOW));
        $paramObjetList->setIsEditable(TRUE);
        $paramObjetList->initAbstractHtmlSelect(
                $HtmlTableName, $paramObjetList->getLabel(), $paramIdFtaWorkflow, NULL, $paramObjetList->getArrayListContent());

        $listeSiteWorkflow = $paramObjetList->getHtmlResult();

        return $listeSiteWorkflow;
    }

}
