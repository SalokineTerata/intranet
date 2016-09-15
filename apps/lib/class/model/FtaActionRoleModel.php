<?php

/**
 * Description of FtaActionRoleModel
 * Table des utilisateurs
 *
 * @author franckwastaken
 */
class FtaActionRoleModel extends AbstractModel {

    const TABLENAME = 'fta_action_role';
    const KEYNAME = 'id_fta_action_role';
    const FIELDNAME_ID_FTA_ROLE = 'id_fta_role';
    const FIELDNAME_ID_INTRANET_ACTIONS = 'id_intranet_actions';
    const FIELDNAME_ID_FTA_WORKFLOW = 'id_fta_workflow';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

    /**
     * 
     * @param int $paramIdIntranetActions
     * @return array
     */
    public static function getIdFtaActionRoleFromIdIntranetAtions($paramIdIntranetActions) {
        if ($paramIdIntranetActions) {
            foreach ($paramIdIntranetActions as $rowsIdIntranetActions) {
                if ($rowsIdIntranetActions) {
                    $arrayIdFtaActionRole = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                    'SELECT ' . self::KEYNAME
                                    . ' FROM  ' . self::TABLENAME
                                    . ' WHERE ' . self::FIELDNAME_ID_INTRANET_ACTIONS . '=' . $rowsIdIntranetActions
                    );
                }
            }
            if ($arrayIdFtaActionRole) {
                foreach ($arrayIdFtaActionRole as $value) {
                    $result = $value[self::KEYNAME];
                }
                return $result;
            }
        }
    }

    /**
     * On obtient le tableau des id intranet action gestionnaire pour un espace de travail donné
     * @param int $paramWorkflow
     * @return array
     */
    public static function getArrayIdIntranetActionsByWorkflowAndGestionnaire($paramWorkflow) {
        $arrayIdIntranetActions = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . self::TABLENAME . '.' . self::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' FROM ' . FtaRoleModel::TABLENAME . ', ' . self::TABLENAME
                        . ' WHERE ' . self::TABLENAME . '.' . self::FIELDNAME_ID_FTA_WORKFLOW . '=' . $paramWorkflow
                        . ' AND ' . FtaRoleModel::TABLENAME . '.' . FtaRoleModel::FIELDNAME_IS_GESTIONNAIRE . '=' . FtaRoleModel::IS_GESTIONNAIRE_TRUE
                        . ' AND ' . self::TABLENAME . '.' . self::FIELDNAME_ID_FTA_ROLE
                        . '=' . FtaRoleModel::TABLENAME . '.' . FtaRoleModel::KEYNAME
        );

        if ($arrayIdIntranetActions) {
            foreach ($arrayIdIntranetActions as $value) {
                $result[] = $value[self::FIELDNAME_ID_INTRANET_ACTIONS];
            }
            return $result;
        }
    }

}
