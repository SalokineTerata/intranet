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

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    public static function getIdIntranetActionsFromIdParentAction($paramIdParent) {
        $globalconfig = new GlobalConfig();
        $id_user = $globalconfig->getAuthenticatedUser()->getKeyValue();

        $arrayIdActions = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT intranet_actions.id_intranet_actions "
                        . " FROM `intranet_actions`, fta_workflow "
                        . " WHERE `parent_intranet_actions`=fta_workflow.id_intranet_actions "
                        . " AND tag_intranet_actions =  'role' "
                        . " AND fta_workflow.id_intranet_actions=$paramIdParent "
        );
        if ($arrayIdActions) {
            foreach ($arrayIdActions as $rowsIdActions) {
                $arrayIdAction = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT intranet_actions.id_intranet_actions "
                                . "FROM intranet_actions, intranet_droits_acces"
                                . " WHERE intranet_droits_acces.id_intranet_actions = intranet_actions.id_intranet_actions "
                                . " AND intranet_droits_acces.id_intranet_actions = " . $rowsIdActions["id_intranet_actions"] 
                                . " AND niveau_intranet_droits_acces='1' "
                                . " AND id_user=" . $id_user
                );
                if ($arrayIdAction) {
                    foreach ($arrayIdAction as $idAction) {
                        return $idAction["id_intranet_actions"];
                    }
                }
            }
        }
    }

}
