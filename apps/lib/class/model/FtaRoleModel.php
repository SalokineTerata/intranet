<?php

/**
 * Description of FtaRoleModel
 * Table des rôles
 *
 * @author franckwastaken
 */
class FtaRoleModel extends AbstractModel {

    const TABLENAME = "fta_role";
    const KEYNAME = "id_fta_role";
    const FIELDNAME_DESCRIPTION_FTA_ROLE = "description_fta_role";
    const FIELDNAME_NOM_FTA_ROLE = "nom_fta_role";

    public static function getIdFtaRoleByIdUser($paramIdUser) {
        $arrayIdFtaRole = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT DISTINCT " . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME . "," . FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE
                        . " FROM " . FtaActionRoleModel::TABLENAME . "," . UserModel::TABLENAME
                        . "," . IntranetDroitsAccesModel::TABLENAME . "," . IntranetActionsModel::TABLENAME
                        . "," . FtaRoleModel::TABLENAME
                        . " WHERE " . UserModel::TABLENAME . "." . UserModel::KEYNAME . "=" . $paramIdUser
                        . " AND " . UserModel::TABLENAME . "." . UserModel::KEYNAME
                        . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_USER
                        . " AND " . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=1"
                        . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                        . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                        . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                        . "=" . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME
        );

        foreach ($arrayIdFtaRole as $rowsIdFtaRole) {
            $value[FtaRoleModel::KEYNAME] = $rowsIdFtaRole[FtaRoleModel::KEYNAME];
            $value[FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE] = $rowsIdFtaRole[FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE];
        }
        return $value;
    }

}
