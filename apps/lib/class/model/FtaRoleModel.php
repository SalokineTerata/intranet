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
     * On obtient l'id du rôle le plus en amont dans le cycle de validation
     * @param int $paramIdUser
     * @return array
     */
    public static function getKeyNameOfFirstRoleByIdUser($paramIdUser) {
        /**
         * Si l'utilisateur n'a aucun rôle on lui affecte le rôle commun
         */
        $return = self::ID_FTA_ROLE_COMMUN;
        $arrayFtaRole = self::getArrayIdFtaRoleByIdUser($paramIdUser);
        if ($arrayFtaRole != NULL) {
            $return = $arrayFtaRole['0'][self::KEYNAME];
        }
        return $return;
    }

    /**
     * On obtient la liste des rôles auxquelles l'utilisateur connecté à les accès
     * @param int $paramIdUser
     * @return array
     */
    public static function getArrayIdFtaRoleByIdUser($paramIdUser) {
        $arrayIdFtaRole = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . self::TABLENAME . '.' . self::KEYNAME
                        . ',' . self::FIELDNAME_NOM_FTA_ROLE
                        . ',' . self::FIELDNAME_DESCRIPTION_FTA_ROLE
                        . ' FROM ' . FtaActionRoleModel::TABLENAME . ',' . UserModel::TABLENAME
                        . ',' . IntranetDroitsAccesModel::TABLENAME . ',' . IntranetActionsModel::TABLENAME
                        . ',' . self::TABLENAME
                        . ' WHERE ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME . '=' . $paramIdUser
                        . ' AND ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME
                        . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_USER
                        . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                        . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                        . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                        . '=' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' AND ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                        . '=' . self::TABLENAME . '.' . self::KEYNAME
                        . ' ORDER BY ' . self::TABLENAME . '.' . self::KEYNAME
        );

        return $arrayIdFtaRole;
    }

    /**
     * On obtient la liste des rôles auxquelles l'utilisateur connecté à les accès selon un workflow
     * @param int $paramIdUser
     * @param int $paramIdFtaWorkflow
     * @return array
     */
    public static function getArrayIdFtaRoleByIdUserAndWorkflow($paramIdUser, $paramIdFtaWorkflow) {
        $arrayIdFtaRole = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . self::TABLENAME . '.' . self::KEYNAME
                        . ',' . self::FIELDNAME_NOM_FTA_ROLE
                        . ',' . self::FIELDNAME_DESCRIPTION_FTA_ROLE
                        . ' FROM ' . FtaActionRoleModel::TABLENAME . ',' . UserModel::TABLENAME
                        . ',' . IntranetDroitsAccesModel::TABLENAME . ',' . IntranetActionsModel::TABLENAME
                        . ',' . self::TABLENAME
                        . ' WHERE ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME . '=' . $paramIdUser
                        . ' AND ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME
                        . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_USER
                        . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                        . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                        . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                        . '=' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' AND ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                        . '=' . self::TABLENAME . '.' . self::KEYNAME
                        . ' AND ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_WROKFLOW . '=' . $paramIdFtaWorkflow
        );
        if ($arrayIdFtaRole) {
            foreach ($arrayIdFtaRole as $rowsIdFtaRole) {
                $IdFtaRole[] = $rowsIdFtaRole[self::KEYNAME];
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
                        $ftaRole = new self($rowsService);
                        $service .= $ftaRole->getDataField(self::FIELDNAME_DESCRIPTION_FTA_ROLE)->getFieldValue() . '<br>';
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
                $req .= ' OR ' . ' ' . self::KEYNAME . '=' . $value . ' ';
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
                        'SELECT ' . self::FIELDNAME_DESCRIPTION_FTA_ROLE
                        . ' FROM ' . self::TABLENAME
                        . ' WHERE ' . self::KEYNAME . '=' . $paramIdRole
        );


        return $arrayRole[0][self::FIELDNAME_DESCRIPTION_FTA_ROLE];
    }

    /**
     * On vérifie selon le role de l'utilisateur connecté 
     * si il a accès aux bouton de transition, de duplication et retirer
     * @param int $paramIdRole
     * @return boolean
     */
    public static function isGestionnaire($paramIdRole) {
        $valueIsGestionnaire = 0;
        $return = FALSE;
        $arrayIsGestionnaire = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . self::FIELDNAME_IS_GESTIONNAIRE
                        . ' FROM ' . self::TABLENAME
                        . ' WHERE ' . self::KEYNAME . '=' . $paramIdRole
        );
        foreach ($arrayIsGestionnaire as $rowsIsGestionnaire) {
            $valueIsGestionnaire = $rowsIsGestionnaire[self::FIELDNAME_IS_GESTIONNAIRE];
        }
        if ($valueIsGestionnaire != 0) {
            $return = TRUE;
        }

        return $return;
    }

    public static function isIdRoleRightsAccesByWorkflow($paramIdUser, $paramWorkflow) {
        $isIdRoleRightsAcces = FALSE;
        $arrayIdFtaRoleAcces = FtaRoleModel::getArrayIdFtaRoleByIdUserAndWorkflow($paramIdUser, $paramWorkflow);

        if ($arrayIdFtaRoleAcces) {
            $isIdRoleRightsAcces = TRUE;
        }

        return $isIdRoleRightsAcces;
    }

}
