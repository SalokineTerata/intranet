<?php

/**
 * Description of FtaActionRoleModel
 * Table des utilisateurs
 *
 * @author tp4300001
 */
class FtaActionRoleModel extends AbstractModel {

    const TABLENAME = "fta_action_role";
    const KEYNAME = "id_fta_action_role";
    const FIELDNAME_ID_FTA_ROLE = "id_fta_role";
    const FIELDNAME_ID_INTRANET_ACTIONS = "id_intranet_actions";
    const FIELDNAME_ID_FTA_WROKFLOW = "id_fta_workflow";

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    public static function getIdFtaActionRoleFromIdIntranetAtions($paramIdIntranetActions) {
        foreach ($paramIdIntranetActions as $rowsIdIntranetActions) {
            $arrayIdFtaActionRole = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            "SELECT " . FtaActionRoleModel::KEYNAME
                            . " FROM  " . FtaActionRoleModel::TABLENAME
                            . " WHERE " . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS . "=" . $rowsIdIntranetActions 
            );
        }
        if ($arrayIdFtaActionRole) {
            foreach ($arrayIdFtaActionRole as $value) {
                return $value[FtaActionRoleModel::KEYNAME];
            }
        }
    }

}
