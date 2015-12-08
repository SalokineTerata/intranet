<?php

/**
 * Description of FtaRoleModel
 * Table des rôles
 *
 * @author franckwastaken
 */
class FtaRoleModel extends AbstractModel {

    const TABLENAME = 'fta_role';
    const KEYNAME = 'id_fta_role';
    const FIELDNAME_DESCRIPTION_FTA_ROLE = 'description_fta_role';
    const FIELDNAME_NOM_FTA_ROLE = 'nom_fta_role';
    const FIELDNAME_IS_GESTIONNAIRE = 'is_gestionnaire';
    const ID_FTA_ROLE_CHEF_DE_PROJET = '1';
    const ID_FTA_ROLE_COMMUN = '0';
    const ID_FTA_ROLE_EMBALLAGE = '4';
    const ID_FTA_ROLE_INFORMATIQUE_GESTION = '5';
    const ID_FTA_ROLE_QUALITE = '3';
    const ID_FTA_ROLE_RD = '2';
    const ID_FTA_ROLE_SITE = '6';

    protected function setDefaultValues() {
        
    }

    /**
     * On obtient l'id du rôle le plus en amot dans le cycle de validation
     * @param int $paramIdUser
     * @return array
     */
    public static function getKeyNameOfFirstRoleByIdUser($paramIdUser) {

        $arrayFtaRole = FtaRoleModel::getIdFtaRoleByIdUser($paramIdUser);
        return $arrayFtaRole['0'][FtaRoleModel::KEYNAME];
    }

    /**
     * On obtient la liste des rôles auxquelles l'utilisateur connecté à les accès
     * @param int $paramIdUser
     * @return array
     */
    public static function getIdFtaRoleByIdUser($paramIdUser) {
        $arrayIdFtaRole = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . FtaRoleModel::TABLENAME . '.' . FtaRoleModel::KEYNAME
                        . ',' . FtaRoleModel::FIELDNAME_NOM_FTA_ROLE
                        . ',' . FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE
                        . ' FROM ' . FtaActionRoleModel::TABLENAME . ',' . UserModel::TABLENAME
                        . ',' . IntranetDroitsAccesModel::TABLENAME . ',' . IntranetActionsModel::TABLENAME
                        . ',' . FtaRoleModel::TABLENAME
                        . ' WHERE ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME . '=' . $paramIdUser
                        . ' AND ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME
                        . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_USER
                        . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                        . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                        . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                        . '=' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' AND ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                        . '=' . FtaRoleModel::TABLENAME . '.' . FtaRoleModel::KEYNAME
                        . ' ORDER BY ' . FtaRoleModel::TABLENAME . '.' . FtaRoleModel::KEYNAME
        );

        return $arrayIdFtaRole;
    }

    /**
     * On obtient la liste des rôles auxquelles l'utilisateur connecté à les accès selon un workflow
     * @param int $paramIdUser
     * @param int $paramIdFtaWorkflow
     * @return array
     */
    public static function getIdFtaRoleByIdUserAndWorkflow($paramIdUser, $paramIdFtaWorkflow) {
        $arrayIdFtaRole = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . FtaRoleModel::TABLENAME . '.' . FtaRoleModel::KEYNAME
                        . ',' . FtaRoleModel::FIELDNAME_NOM_FTA_ROLE
                        . ',' . FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE
                        . ' FROM ' . FtaActionRoleModel::TABLENAME . ',' . UserModel::TABLENAME
                        . ',' . IntranetDroitsAccesModel::TABLENAME . ',' . IntranetActionsModel::TABLENAME
                        . ',' . FtaRoleModel::TABLENAME
                        . ' WHERE ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME . '=' . $paramIdUser
                        . ' AND ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME
                        . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_USER
                        . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                        . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                        . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                        . '=' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' AND ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                        . '=' . FtaRoleModel::TABLENAME . '.' . FtaRoleModel::KEYNAME
                        . ' AND ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_WROKFLOW . '=' . $paramIdFtaWorkflow
        );
        if ($arrayIdFtaRole) {
            foreach ($arrayIdFtaRole as $rowsIdFtaRole) {
                $IdFtaRole[] = $rowsIdFtaRole[FtaRoleModel::KEYNAME];
            }
        }

        return $IdFtaRole;
    }

    /**
     * On enregistre le niveau auxquelles la Fta se situe
     * @param int $paramIdFta
     * @param int $paramIdWorkflow
     * @return string
     */
    public static function getListeIdFtaRoleEncoursByIdFta($paramIdFta, $paramIdWorkflow) {
        $processusLISTE = array();
        $arrayIdRoleListe = array();
        /*
         * Nous récuperons les processus en cours.
         */

        $arrayProcessusEncours = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                        . ',' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                        . ' FROM ' . FtaWorkflowStructureModel::TABLENAME
                        . ', ' . FtaProcessusCycleModel::TABLENAME
                        . ',' . FtaModel::TABLENAME
                        . ' WHERE ' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                        . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                        . ' AND ' . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . '=\'I\''
                        . ' AND ' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                        . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW        //Jointure                            
                        . ' AND ' . FtaModel::KEYNAME . '=' . $paramIdFta
                        . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW . '=' . $paramIdWorkflow
                        . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                        . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW        //Jointure                            
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
                $checkProcessus = in_array($rowsProcessusEncours[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS], $processusLISTE);
                if (!$checkProcessus) {
                    /*
                     * Nous verifions si tous les processus précedents du chapitre que l'utilisateur à les droits d'accès
                     * sont validé ou non et donc visible ou non
                     */
                    $processusLISTE[] = $rowsProcessusEncours[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS];
                    $taux_validation_processus = FtaProcessusModel::getFtaProcessusNonValidePrecedent($paramIdFta, $rowsProcessusEncours[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS], $rowsProcessusEncours[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW]);
                    if ($taux_validation_processus == '1' or $taux_validation_processus === NULL) {
                        /*
                         * Nous récupérons tous les processus validé pour vérifier plus tard si nous devons les affichers
                         */
                        $taux_validation_processus = FtaProcessusModel::getValideProcessusEncours($paramIdFta, $rowsProcessusEncours[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS], $rowsProcessusEncours[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW]);
                        if ($taux_validation_processus <> '1') {
                            $arrayIdRole = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                            'SELECT DISTINCT ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                                            . ' FROM ' . FtaWorkflowStructureModel::TABLENAME
                                            . ' WHERE ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                            . '=' . $rowsProcessusEncours[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS]
                                            . ' AND ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                            . '=' . $rowsProcessusEncours[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW]
                            );
                            if ($arrayIdRole) {
                                foreach ($arrayIdRole as $rowsIdRole) {
                                    $checkListeIdFtaRole = in_array($rowsIdRole[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE], $arrayIdRoleListe);
                                    if (!$checkListeIdFtaRole) {
                                        $arrayIdRoleListe[] = $rowsIdRole[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE];
                                        $listeIdRole .= $rowsIdRole[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE] . ";";
                                    }
                                }
                            }
                        }
                    }
                }
            }

            return $listeIdRole;
        }
    }

    public static function getNameServiceEncours($listeIdFtaRole) {
        if ($listeIdFtaRole) {
            $arrayService = explode(";", $listeIdFtaRole);
            if ($arrayService) {
                foreach ($arrayService as $rowsService) {
                    if ($rowsService) {
                        $ftaRole = new FtaRoleModel($rowsService);
                        $service .= $ftaRole->getDataField(FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE)->getFieldValue() . '<br>';
                    }
                }
            }
        } else {
            $service = "";
        }
        return $service;
    }

    /**
     * 
     * @param int $paramIdRole
     * @return string
     */
    private static function AddIdRole($paramIdRole) {
        if ($paramIdRole) {
            foreach ($paramIdRole as $value) {
                $req .= ' OR ' . ' ' . FtaRoleModel::KEYNAME . '=' . $value . ' ';
            }
        }
        return $req;
    }

    /**
     * On obtient le nom des rôles
     * @param int $paramIdRole
     * @return array
     */
    public static function getNameRoleByIdRole($paramIdRole) {
        $arrayRole = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE
                        . ' FROM ' . FtaRoleModel::TABLENAME
                        . ' WHERE ' . FtaRoleModel::KEYNAME . '=' . $paramIdRole
        );


        return $arrayRole[0][FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE];
    }

    /**
     * On vérifie selon le role de l'utilisateur connecté 
     * si il a accès aux boutoon transition en permanence
     * @param int $paramIdRole
     * @return int
     */
    public static function getValueIsGestionnaire($paramIdRole) {
        $arrayIsGestionnaire = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . FtaRoleModel::FIELDNAME_IS_GESTIONNAIRE
                        . ' FROM ' . FtaRoleModel::TABLENAME
                        . ' WHERE ' . FtaRoleModel::KEYNAME . '=' . $paramIdRole
        );
        foreach ($arrayIsGestionnaire as $rowsIsGestionnaire) {
            $valueIsGestionnaire = $rowsIsGestionnaire[FtaRoleModel::FIELDNAME_IS_GESTIONNAIRE];
        }

        return $valueIsGestionnaire;
    }

}
