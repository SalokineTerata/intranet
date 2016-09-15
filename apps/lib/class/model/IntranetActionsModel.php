<?php

/**
 * Description of IntranetActionsModel
 * Table des utilisateurs
 *
 * @author franckwastaken
 */
class IntranetActionsModel extends AbstractModel {

    const TABLENAME = 'intranet_actions';
    const KEYNAME = 'id_intranet_actions';
    const FIELDNAME_NOM_INTRANET_ACTIONS = 'nom_intranet_actions';
    const FIELDNAME_MODULE_INTRANET_ACTIONS = 'module_intranet_actions';
    const FIELDNAME_DESCRIPTION_INTRANET_ACTIONS = 'description_intranet_actions';
    const FIELDNAME_TAG_INTRANET_ACTIONS = 'tag_intranet_actions';
    const FIELDNAME_PARENT_INTRANET_ACTIONS = 'parent_intranet_actions';
    const NAME_DIFFUSION_FTA= 'diffusion_fta';
    const VALUE_FTA= 'fta';
    const VALUE_ROLE = 'role';
    const VALUE_SITE = 'site';
    const VALUE_WORKFLOW = 'workflow';
    const NAME_ACCES_MODULE_FTA = 'acces_module_fta';
    const NAME_CONSULTATION= 'consultation';
    const NAME_MODIFICATION= 'modification';
    const NAME_IMPRESSION= 'impression';
    const NAME_DIFFUSION= 'diffusion';
    const NAME_DROIT_MODIFICATION= 'droit_modification';
    

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

    /**
     * On obitient le tableau des id intranet parents 
     * @return array
     */
    public static function getArrayIdIntranetActionParentWithIdModule() {
        $arrayIdIntranetParents = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        " SELECT " . self::FIELDNAME_MODULE_INTRANET_ACTIONS . ", " . self::FIELDNAME_PARENT_INTRANET_ACTIONS
                        . " FROM  " . self::TABLENAME
                        . " WHERE " . self::FIELDNAME_PARENT_INTRANET_ACTIONS . " IS NOT NULL"
                        . " GROUP BY  " . self::FIELDNAME_PARENT_INTRANET_ACTIONS);
        return $arrayIdIntranetParents;
    }

    /**
     * Nous obtenons les id intranet actions selon l'identifiant parents
     *  dont l'ulisateur est le propiétaire .
     * @param int $paramIdParent
     * @param int $paramChapitre
     * @param int $paramFtaWorkflow
     * @param int $paramIdFtaRole
     * @return array
     */
    public static function getIdIntranetActionsFromIdParentAction($paramIdParent, $paramChapitre, $paramFtaWorkflow, $paramIdFtaRole) {
        $globalConfig = new GlobalConfig();
        UserModel::checkUserSessionExpired($globalConfig);

        $id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();

        $arrayIdActions = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . self::TABLENAME . '.' . self::KEYNAME
                        . ' FROM ' . self::TABLENAME . ',' . FtaWorkflowModel::TABLENAME
                        . ' WHERE ' . self::FIELDNAME_PARENT_INTRANET_ACTIONS
                        . '=' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' AND ' . self::FIELDNAME_TAG_INTRANET_ACTIONS . '=\'' . self::VALUE_ROLE
                        . '\' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS . '=' . $paramIdParent
        );
        if ($arrayIdActions) {
            foreach ($arrayIdActions as $rowsIdActions) {

                $arrayIdAction = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . ' FROM ' . self::TABLENAME . ', ' . FtaWorkflowStructureModel::TABLENAME
                                . ', ' . IntranetDroitsAccesModel::TABLENAME . ',' . FtaActionRoleModel::TABLENAME
                                . ' WHERE ' . FtaWorkflowStructureModel::TABLENAME
                                . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE . '=' . $paramChapitre
                                . ' AND ' . FtaWorkflowStructureModel::TABLENAME
                                . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . $paramFtaWorkflow
                                . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                                . '=' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                . ' AND ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                . '=' . $paramIdFtaRole
                                . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . '=' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_WORKFLOW
                                . ' AND ' . self::TABLENAME . '.' . self::KEYNAME
                                . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . '=' . $rowsIdActions[self::KEYNAME]
                                . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER
                                . '=' . $id_user
                                . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES
                                . '=1'
                );
                if ($arrayIdAction) {
                    foreach ($arrayIdAction as $idAction) {


                        return $idAction[self::KEYNAME];
                    }
                }
            }
        }
    }

    /**
     * Nous obtenons les id intranet actions role selon son identifiant parents.
     * @param int $paramIdParent
     * @return type
     */
    public static function getIdIntranetActionsRoleFromIdParentActionNavigation($paramIdParent) {
        $globalConfig = new GlobalConfig();
        UserModel::checkUserSessionExpired($globalConfig);

        $id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();

        $arrayIdActions = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . self::TABLENAME . '.' . self::KEYNAME
                        . ' FROM ' . self::TABLENAME . ',' . FtaWorkflowModel::TABLENAME
                        . ' WHERE ' . self::FIELDNAME_PARENT_INTRANET_ACTIONS
                        . '=' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' AND ' . self::FIELDNAME_TAG_INTRANET_ACTIONS . '=\'' . self::VALUE_ROLE
                        . '\' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS . '=' . $paramIdParent
        );
        if ($arrayIdActions) {
            foreach ($arrayIdActions as $rowsIdActions) {
                $arrayIdAction = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT ' . self::TABLENAME . '.' . self::KEYNAME
                                . ' FROM ' . self::TABLENAME . ', ' . IntranetDroitsAccesModel::TABLENAME
                                . ' WHERE ' . self::TABLENAME . '.' . self::KEYNAME
                                . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . '=' . $rowsIdActions[self::KEYNAME]
                                . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER
                                . '=' . $id_user
                                . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES
                                . '=1'
                );

                if ($arrayIdAction) {
                    foreach ($arrayIdAction as $idAction) {
                        return $idAction[self::KEYNAME];
                    }
                }
            }
        }
    }

    /**
     * On obtient les id_intranet_action de 'site' pour un workflow selon les droits d'accès d'un utilisateur
     * @param int $paramIdParent
     * @param int $paramIdUser
     * @return array
     */
    public static function getIdIntranetActionsSiteFromIdParentActionNavigation($paramIdParent, $paramIdUser) {
        $arrayIdActions = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . self::TABLENAME . '.' . self::KEYNAME
                        . ' FROM ' . self::TABLENAME . ',' . FtaWorkflowModel::TABLENAME
                        . ' WHERE ' . self::FIELDNAME_PARENT_INTRANET_ACTIONS
                        . '=' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' AND ' . self::FIELDNAME_TAG_INTRANET_ACTIONS . '= \'' . self::VALUE_SITE
                        . '\' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS . '=' . $paramIdParent
        );
        if ($arrayIdActions) {
            foreach ($arrayIdActions as $rowsIdActions) {
                $arrayIdAction = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT ' . self::TABLENAME . '.' . self::KEYNAME
                                . ' FROM ' . self::TABLENAME . ', ' . IntranetDroitsAccesModel::TABLENAME
                                . ' WHERE ' . self::TABLENAME . '.' . self::KEYNAME
                                . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . '=' . $rowsIdActions[self::KEYNAME]
                                . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdUser
                                . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES
                                . '=1'
                );

                if ($arrayIdAction) {
                    foreach ($arrayIdAction as $idAction) {
                        $idActionT[] = $idAction[self::KEYNAME];
                    }
                }
            }
        }
        return $idActionT;
    }

    /**
     * Ajout d'une liste d'intranet actions avec la conddition or
     * @param array $paramIdIntranetActions
     * @return string
     */
    public static function addIdIntranetAction($paramIdIntranetActions) {
        if ($paramIdIntranetActions) {
            foreach ($paramIdIntranetActions as $value) {
                $req .= ' OR ' . self::TABLENAME . '.' . self::KEYNAME . '=' . $value . ' ';
            }
        }
        return $req;
    }

    /**
     * Ajout d'une liste d'intranet actions parent
     * @param array $paramIdIntranetActionsParent
     * @return string
     */
    public static function addIdIntranetActionParent($paramIdIntranetActionsParent) {
        if ($paramIdIntranetActionsParent) {
            foreach ($paramIdIntranetActionsParent as $value) {
                $req .= ' OR ' . self::TABLENAME . '.' . self::FIELDNAME_PARENT_INTRANET_ACTIONS . '=\'' . $value . '\' ';
            }
        }
        return $req;
    }

    /**
     * On récupère le nom des sites qu'un utilisateur a selon sont workflow
     * @param int $paramIdUser
     * @param array $paramArrayIdWorkflow
     * @return array
     */
    public static function getNameSiteByWorkflow($paramIdUser, $paramArrayIdWorkflow) {
        if ($paramArrayIdWorkflow) {
            foreach ($paramArrayIdWorkflow as $rowsIdWorkflow) {
                $IdIntranetActionByWorkflow = $rowsIdWorkflow[FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS];

                $idIntranetActions = self::getIdIntranetActionsSiteFromIdParentActionNavigation($IdIntranetActionByWorkflow, $paramIdUser);

                $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT ' . self::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS
                                . ' FROM ' . self::TABLENAME . ',' . IntranetDroitsAccesModel::TABLENAME
                                . ' WHERE ' . self::TABLENAME . '.' . self::KEYNAME
                                . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdUser // L'utilisateur connecté
                                . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '= ' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                                . ' AND ( 0 ' . self::addIdIntranetAction($idIntranetActions) . ')'
                );

                $arrayFull[] = $array;
            }
        } else {
            $arrayFull = 0;
        }

        return $arrayFull;
    }

    /**
     * On verifie si selon le workflow  et site de production en cours l'utilisateur connecté à les droits d'accès.
     * @param int $paramIdUser
     * @param int $paramIdFtaWorkflow
     * @param array $paramIdIntranetActionSiteDeProduction
     * @return array
     */
    public static function getArrayIdIntranetActionByIdUserFtaWorkflowAndSiteDeProduction($paramIdUser, $paramIdFtaWorkflow, $paramIdIntranetActionSiteDeProduction) {
        /**
         * Vérification de l'accès utilisateur: action du site de prod / espace de travail
         */
        $arrayAcl = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . self::TABLENAME . '.' . self::KEYNAME
                        . ' FROM ' . self::TABLENAME . ',' . FtaWorkflowModel::TABLENAME . ',' . IntranetDroitsAccesModel::TABLENAME
                        . ' WHERE ' . self::TABLENAME . '.' . self::KEYNAME
                        . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdUser // L'utilisateur connecté
                        . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '= ' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                        . ' AND ' . self::TABLENAME . '.' . self::FIELDNAME_PARENT_INTRANET_ACTIONS
                        . '=' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::KEYNAME . '=' . $paramIdFtaWorkflow // L'utilisateur connecté
                        . ' AND ( 0 ' . self::addIdIntranetAction($paramIdIntranetActionSiteDeProduction) . ')');


        return $arrayAcl;
    }

    public static function isAccessFtaActionByIdUserFtaWorkflowAndSiteDeProduction($paramIdUser
    , $paramIdFtaWorkflow, $paramIdIntranetActionSiteDeProduction) {
        $result = FALSE;

        if (self::getArrayIdIntranetActionByIdUserFtaWorkflowAndSiteDeProduction(
                        $paramIdUser, $paramIdFtaWorkflow, $paramIdIntranetActionSiteDeProduction)) {
            $result = TRUE;
        }

        return $result;
    }

    /**
     * Tableau des id intranet actions gestionnaire selon l'espace de travail et le site de production  
     * @param int $paramWorkflow
     * @param int $paramSiteDeProd
     * @return array
     */
    public static function getArrayIdIntranetActionByWorkflowAndSiteDeProdAndGestionnaire($paramWorkflow, $paramSiteDeProd) {
        /**
         *  Nous recuperons le tableau des id intranet actions selon l'espace de travail  et le role (gestionnaire) 
         */
        $arrayIdIntranetActionsGestionnaire = FtaActionRoleModel::getArrayIdIntranetActionsByWorkflowAndGestionnaire($paramWorkflow);
        /**
         * Nous recuperons le tableau des id intranet actions selon l'espace de travail et le site de production
         */
        $arrayIdIntranetActionsSiteDeProd = FtaActionSiteModel::getArrayIdIntranetActionsByWorkflowAndSiteDeProd($paramWorkflow, $paramSiteDeProd);

        $arrayIdIntranetActions = array_merge($arrayIdIntranetActionsGestionnaire, $arrayIdIntranetActionsSiteDeProd);


        return $arrayIdIntranetActions;
    }

}
