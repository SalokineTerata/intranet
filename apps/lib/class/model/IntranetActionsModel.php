<?php

/**
 * Description of IntranetActionsModel
 * Table des utilisateurs
 *
 * @author tp4300001
 */
class IntranetActionsModel extends AbstractModel {

    const TABLENAME = "intranet_actions";
    const KEYNAME = "id_intranet_actions";
    const FIELDNAME_NOM_INTRANET_ACTIONS = "nom_intranet_actions";
    const FIELDNAME_MODULE_INTRANET_ACTIONS = "module_intranet_actions";
    const FIELDNAME_DESCRIPTION_INTRANET_ACTIONS = "description_intranet_actions";
    const FIELDNAME_TAG_INTRANET_ACTIONS = "tag_intranet_actions";
    const FIELDNAME_PARENT_INTRANET_ACTIONS = "parent_intranet_actions";
    const VALUE_ROLE = "role";
    const VALUE_SITE = "site";

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    /*
     * Nous obtenons les id intranet actions selon son identifiant parents
     *  dont l'ulisateur est le propiétaire .
     */

    public static function getIdIntranetActionsFromIdParentAction($paramIdParent, $paramChapitre, $paramFtaWorkflow) {
        $globalconfig = new GlobalConfig();
        $id_user = $globalconfig->getAuthenticatedUser()->getKeyValue();

        $arrayIdActions = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                        . " FROM " . IntranetActionsModel::TABLENAME . "," . FtaWorkflowModel::TABLENAME
                        . " WHERE " . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS
                        . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . " AND " . IntranetActionsModel::FIELDNAME_TAG_INTRANET_ACTIONS . "='" . IntranetActionsModel::VALUE_ROLE
                        . "' AND " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS . "=" . $paramIdParent
        );
        if ($arrayIdActions) {
            foreach ($arrayIdActions as $rowsIdActions) {

                $arrayIdAction = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . " FROM " . IntranetActionsModel::TABLENAME . ", " . FtaWorkflowStructureModel::TABLENAME
                                . ", " . IntranetDroitsAccesModel::TABLENAME . "," . FtaActionRoleModel::TABLENAME
                                . " WHERE " . FtaWorkflowStructureModel::TABLENAME
                                . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE . "=" . $paramChapitre
                                . " AND " . FtaWorkflowStructureModel::TABLENAME
                                . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . "=" . $paramFtaWorkflow
                                . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                                . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_WROKFLOW
                                . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . "=" . $rowsIdActions[IntranetActionsModel::KEYNAME]
                                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER
                                . "=" . $id_user
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES
                                . "=1"
                );
                if ($arrayIdAction) {
                    foreach ($arrayIdAction as $idAction) {


                        return $idAction[IntranetActionsModel::KEYNAME];
                    }
                }
            }
        }
    }

    /*
     * Nous obtenons les id intranet actions role selon son identifiant parents.
     */

    public static function getIdIntranetActionsRoleFromIdParentActionNavigation($paramIdParent) {
        $globalconfig = new GlobalConfig();
        $id_user = $globalconfig->getAuthenticatedUser()->getKeyValue();

        $arrayIdActions = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                        . " FROM " . IntranetActionsModel::TABLENAME . "," . FtaWorkflowModel::TABLENAME
                        . " WHERE " . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS
                        . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . " AND " . IntranetActionsModel::FIELDNAME_TAG_INTRANET_ACTIONS . "='" . IntranetActionsModel::VALUE_ROLE
                        . "' AND " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS . "=" . $paramIdParent
        );
        if ($arrayIdActions) {
            foreach ($arrayIdActions as $rowsIdActions) {
                $arrayIdAction = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . " FROM " . IntranetActionsModel::TABLENAME . ", " . IntranetDroitsAccesModel::TABLENAME
                                . " WHERE " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . "=" . $rowsIdActions[IntranetActionsModel::KEYNAME]
                                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER
                                . "=" . $id_user
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES
                                . "=1"
                );

                if ($arrayIdAction) {
                    foreach ($arrayIdAction as $idAction) {
                        return $idAction[IntranetActionsModel::KEYNAME];
                    }
                }
            }
        }
    }

    public static function getIdIntranetActionsSiteFromIdParentActionNavigation($paramIdParent) {
        $globalconfig = new GlobalConfig();
        $id_user = $globalconfig->getAuthenticatedUser()->getKeyValue();

        $arrayIdActions = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                        . " FROM " . IntranetActionsModel::TABLENAME . "," . FtaWorkflowModel::TABLENAME
                        . " WHERE " . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS
                        . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . " AND " . IntranetActionsModel::FIELDNAME_TAG_INTRANET_ACTIONS . "= '" . IntranetActionsModel::VALUE_SITE
                        . "' AND " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS . "=" . $paramIdParent
        );
        if ($arrayIdActions) {
            foreach ($arrayIdActions as $rowsIdActions) {
                $arrayIdAction = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . " FROM " . IntranetActionsModel::TABLENAME . ", " . IntranetDroitsAccesModel::TABLENAME
                                . " WHERE " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . "=" . $rowsIdActions[IntranetActionsModel::KEYNAME]
                                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER
                                . "=" . $id_user
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES
                                . "=1"
                );

                if ($arrayIdAction) {
                    foreach ($arrayIdAction as $idAction) {
                        $idActionT[] = $idAction[IntranetActionsModel::KEYNAME];
                    }
                }
            }
        }
        return $idActionT;
    }

    public static function AddIdIntranetAction($paramIdIntranetActions) {
        if ($paramIdIntranetActions) {
            foreach ($paramIdIntranetActions as $value) {
                $req .= " OR " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME . "=" . $value . " ";
            }
        }
        return $req;
    }

    public static function getNameSiteByWorkflow($paramIdUser, $paramArrayIdWorkflow) {
        if ($paramArrayIdWorkflow) {
            foreach ($paramArrayIdWorkflow as $rowsIdWorkflow) {
                $IdIntranetActionByWorkflow = $rowsIdWorkflow[FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS];

                $idIntranetActions = IntranetActionsModel::getIdIntranetActionsSiteFromIdParentActionNavigation($IdIntranetActionByWorkflow);


                $req = "SELECT " . IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS
                        . " FROM " . IntranetActionsModel::TABLENAME . "," . IntranetDroitsAccesModel::TABLENAME
                        . " WHERE " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                        . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $paramIdUser // L'utilisateur connecté
                        . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=1 "
                        . "AND ( 0 ";

                $req.= IntranetActionsModel::AddIdIntranetAction($idIntranetActions);

                $req .= ")";

                $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);

                $arrayFull[] = $array;
            }
        } else {
            $arrayFull = 0;
        }

        return $arrayFull;
    }

}
