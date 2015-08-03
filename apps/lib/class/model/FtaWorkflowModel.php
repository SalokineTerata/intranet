<?php

/**
 * Description of FtaWorkflowModel
 * Table des workflows
 *
 * @author franckwastaken
 */
class FtaWorkflowModel extends AbstractModel {

    const TABLENAME = "fta_workflow";
    const KEYNAME = "id_fta_workflow";
    const FIELDNAME_DESCRIPTION_FTA_WORKFLOW = "description_fta_workflow";
    const FIELDNAME_ID_INTRANET_ACTIONS = "id_intranet_actions";
    const FIELDNAME_NOM_FTA_WORKFLOW = "nom_fta_workflow";

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

    function getModelIntranetActions() {
        return $this->modelIntranetActions;
    }

    function setModelIntranetActions(IntranetActionsModel $modelIntranetActions) {
        $this->modelIntranetActions = $modelIntranetActions;
    }

    public static function ShowListeDeroulanteNomWorkflowByAcces($paramIdUser) {
        $requete = "SELECT DISTINCT " . FtaWorkflowModel::KEYNAME . "," . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
                . " FROM " . FtaWorkflowModel::TABLENAME
                . ", " . IntranetDroitsAccesModel::TABLENAME
                . " WHERE " . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW . "<>''"
                . " AND " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $paramIdUser // L'utilisateur connecté
                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=1"
                . " ORDER BY " . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
        ;
        $nom_defaut = FtaWorkflowModel::KEYNAME;
        $id_defaut = FtaWorkflowModel::KEYNAME;
        $listeSiteWorkflow = DatabaseDescription::getFieldDocLabel(FtaWorkflowModel::TABLENAME, FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW)
                . "</td><td>"
                . AccueilFta::afficherRequeteEnListeDeroulante($requete, $id_defaut, $nom_defaut);

        return $listeSiteWorkflow;
    }

}
