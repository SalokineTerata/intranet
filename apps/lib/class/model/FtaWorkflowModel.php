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

    public static function getNameWorkflowByIdFtaRoleAndEtatAvancement($paramRole, $paramEtatAvancement) {
        $globalConfig = new GlobalConfig();
        $id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();

        switch ($paramEtatAvancement) {
            case "I";

                $arrayTmp = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT DISTINCT " . FtaModel::KEYNAME . "," . FtaProcessusModel::KEYNAME
                                . " FROM " . FtaSuiviProjetModel::TABLENAME . ", " . FtaWorkflowStructureModel::TABLENAME
                                . ", " . FtaProcessusCycleModel::TABLENAME
                                . " WHERE " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . " in (SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                                . " FROM " . FtaProcessusCycleModel::TABLENAME . ", " . FtaProcessusModel::TABLENAME
                                . ", " . FtaWorkflowModel::TABLENAME . ", " . FtaWorkflowStructureModel::TABLENAME
                                . ", " . IntranetActionsModel::TABLENAME . ", " . IntranetDroitsAccesModel::TABLENAME . ", " . IntranetModulesModel::TABLENAME
                                . ", " . FtaActionRoleModel::TABLENAME . ", " . FtaRoleModel::TABLENAME
                                . ", " . FtaSuiviProjetModel::TABLENAME . ", " . FtaModel::TABLENAME
                                . " WHERE " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                                . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                                . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW . "=1 " // nous déterminons le type de workflow qu'il s'agit pour le moment par défaut v3 test
                                . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                                . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                                . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                                . "=" . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME
                                . " AND " . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME
                                . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE . "=" . $paramRole // Nous recuperons le type de role pour l'utilisateur
                                . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
                                . "=" . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME
                                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $id_user // L'utilisateur connecté
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=1"
                                . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0)"
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0"
                                . " AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='" . $paramEtatAvancement
                                . "' AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                );

                if ($arrayTmp) {
                    foreach ($arrayTmp as $rows) {
                        $tauxDeValidadation = FtaProcessusModel::getFtaProcessusNonValideSuivant($rows[FtaModel::KEYNAME], $rows[FtaProcessusModel::KEYNAME]);
                        if ($tauxDeValidadation <> 1) {
                            $idFtaEffectue[] = $rows[FtaModel::KEYNAME];
                        }
                    }
                }
                $req = "SELECT DISTINCT " . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW . "," . FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW
                        . " FROM " . FtaModel::TABLENAME . "," . FtaWorkflowModel::TABLENAME
                        . " WHERE ( 0 ";

                $req .= FtaModel::AddIdFTaValidProcess($idFtaEffectue);

                $req .= ")";

                $req .= " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                        . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME;

                $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);


                break;
            case "V":
                /*
                 * Recuperer la requete pour des fta attente 
                 */
                break;
            case "A":
                break;
            case "R":
                break;
            case "P":


                $arrayTmp = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT DISTINCT " . FtaModel::KEYNAME . "," . FtaProcessusModel::KEYNAME
                                . " FROM " . FtaSuiviProjetModel::TABLENAME . ", " . FtaWorkflowStructureModel::TABLENAME
                                . ", " . FtaProcessusCycleModel::TABLENAME
                                . " WHERE " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . " in (SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                                . " FROM " . FtaProcessusCycleModel::TABLENAME . ", " . FtaProcessusModel::TABLENAME
                                . ", " . FtaWorkflowModel::TABLENAME . ", " . FtaWorkflowStructureModel::TABLENAME
                                . ", " . IntranetActionsModel::TABLENAME . ", " . IntranetDroitsAccesModel::TABLENAME . ", " . IntranetModulesModel::TABLENAME
                                . ", " . FtaActionRoleModel::TABLENAME . ", " . FtaRoleModel::TABLENAME
                                . ", " . FtaSuiviProjetModel::TABLENAME . ", " . FtaModel::TABLENAME
                                . " WHERE " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                                . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                                . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                                . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                                . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                                . "=" . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME
                                . " AND " . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME
                                . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE . "=" . $paramRole // Nous recuperons le type de role pour l'utilisateur
                                . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
                                . "=" . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME
                                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $id_user // L'utilisateur connecté
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=1"
                                . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0)"
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0"
                                . " AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='" . $paramEtatAvancement
                                . "' AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                );

                if ($arrayTmp) {
                    foreach ($arrayTmp as $rows) {
                        $tauxDeValidadation = FtaProcessusModel::getFtaProcessusNonValideSuivant($rows[FtaModel::KEYNAME], $rows[FtaProcessusModel::KEYNAME]);
                        if ($tauxDeValidadation <> 1) {
                            $idFtaEffectue[] = $rows[FtaModel::KEYNAME];
                        }
                    }
                }
                $req = "SELECT DISTINCT " . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW 
                        . "," . FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW
                        . "," . FtaWorkflowModel::KEYNAME
                        . " FROM " . FtaModel::TABLENAME . "," . FtaWorkflowModel::TABLENAME
                        . " WHERE ( 0 ";

                $req .= FtaModel::AddIdFTaValidProcess($idFtaEffectue);

                $req .= ")";

                $req .= " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                        . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME;

                $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);

                break;
        }


        return $array;
    }

}
