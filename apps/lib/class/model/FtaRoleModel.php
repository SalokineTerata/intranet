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

    public static function getKeyNameOfFirstRoleByIdUser($paramIdUser) {

        $arrayFtaRole = FtaRoleModel::getIdFtaRoleByIdUser($paramIdUser);
        return $arrayFtaRole[0][FtaRoleModel::KEYNAME];
    }

    public static function getIdFtaRoleByIdUser($paramIdUser) {
        $arrayIdFtaRole = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT DISTINCT " . FtaRoleModel::TABLENAME . ".*"
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

        return $arrayIdFtaRole;
    }

    public static function getNameRoleEncoursByIdFta($paramIdFta) {

        /*
         * Nous récuperons les processus en cours.
         */



        $arrayProcessusEncours = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT DISTINCT " . FtaProcessusModel::TABLENAME
                        . ".* FROM " . FtaProcessusModel::TABLENAME
                        . ", " . FtaProcessusCycleModel::TABLENAME
                        . "," . FtaWorkflowModel::TABLENAME
                        . "," . FtaModel::TABLENAME
                        . "," . FtaActionRoleModel::TABLENAME
                        . "," . FtaRoleModel::TABLENAME
                        . " WHERE " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                        . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                        . " AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='I'"
                        . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                        . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME        //Jointure                            
                        . " AND " . FtaModel::KEYNAME . "=" . $paramIdFta
                        . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                        . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME        //Jointure                            
                        . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                        . "=" . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME        //Jointure
                        . " AND " . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME
                        . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
        );

        /*
         * Liste des rôles en cours
         */

        if ($arrayProcessusEncours) {
            /**
             * Nous vérififions si tous les processus des rôle sont validé 
             * si les processus de chaque sont validé alors il est effectués sinon il est en cours
             */
            foreach ($arrayProcessusEncours as $rowsProcessusEncours) {
                /*
                 * Nous verifions si tous les processus précedents du chapitre que l'utilisateur à les droits d'accès
                 * sont validé ou non et donc visible ou non
                 */
                $taux_validation_processus = FtaProcessusModel::getFtaProcessusNonValidePrecedent($paramIdFta, $rowsProcessusEncours[FtaProcessusModel::KEYNAME]);
                if ($taux_validation_processus == 1 or $taux_validation_processus === NULL) {
                    /*
                     * Nous récupérons tous les processus validé pour vérifier plus tard si nous devons les affichers
                     */
                    $taux_validation_processus = fta_processus_validation($paramIdFta, $rowsProcessusEncours[FtaProcessusModel::KEYNAME]);
                    if ($taux_validation_processus <> 1) {
                        $arrayIdRole = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                        "SELECT DISTINCT " . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME
                                        . " FROM " . FtaProcessusModel::TABLENAME . "," . FtaRoleModel::TABLENAME
                                        . " WHERE " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                                        . "=" . $rowsProcessusEncours[FtaProcessusModel::KEYNAME]
                                        . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                                        . "=" . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME
                        );
                        foreach ($arrayIdRole as $rowsIdRole) {
                            $IdRole[] = $rowsIdRole[FtaRoleModel::KEYNAME];
                        }
                    }
                }
            }
        }
        $req = "SELECT DISTINCT " . FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE . " FROM " . FtaRoleModel::TABLENAME . " WHERE ( 0 ";

        $req .= FtaRoleModel::AddIdRole($IdRole);

        $req .= ")";

        $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);

        return $array;
    }

    public static function AddIdRole($paramIdRole) {
        if ($paramIdRole) {
            foreach ($paramIdRole as $value) {
                $req .= " OR " . " " . FtaRoleModel::KEYNAME . "=" . $value . " ";
            }
        }
        return $req;
    }
    public static function getNameRoleByIdRole($paramIdRole) {
        $arrayRole = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                            "SELECT " . FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE
                            . " FROM " . FtaRoleModel::TABLENAME
                            . " WHERE " . FtaRoleModel::KEYNAME . "=" . $paramIdRole
            );
        
        
        return $arrayRole[0][FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE];
    }
    

}
