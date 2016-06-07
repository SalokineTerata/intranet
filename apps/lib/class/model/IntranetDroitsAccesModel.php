<?php

/**
 * Description of IntranetDroitsAccesModel
 * Table des utilisateurs
 *
 * @author tp4300001
 */
class IntranetDroitsAccesModel extends AbstractModel {

    const TABLENAME = 'intranet_droits_acces';
    const KEYNAME = 'id_intranet_droits_acces';
    const FIELDNAME_ID_INTRANET_MODULES = 'id_intranet_modules';
    const FIELDNAME_ID_USER = 'id_user';
    const FIELDNAME_ID_INTRANET_ACTIONS = 'id_intranet_actions';
    const FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES = 'niveau_intranet_droits_acces';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

    /**
     * On vérifie si l'utilisateur à les droits d'accès sur id intranet actions parent
     * @param int $paramIdUser
     * @param int $paramIdIntranetModule
     * @param int $paramIdIntranetAction
     * @return boolean
     */
    public static function checkUserHaveRightsAcces($paramIdUser, $paramIdIntranetModule, $paramIdIntranetAction) {
        $haveRightsAcces = FALSE;

        $arrayHaveRightsAcces = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . self::FIELDNAME_ID_INTRANET_ACTIONS
                        . " FROM  " . self::TABLENAME
                        . " WHERE " . self::FIELDNAME_ID_INTRANET_MODULES . " =" . $paramIdIntranetModule
                        . " AND  " . self::FIELDNAME_ID_USER . " =" . $paramIdUser
                        . " AND  " . self::FIELDNAME_ID_INTRANET_ACTIONS . " =" . $paramIdIntranetAction
                        . " AND  " . self::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . " =" . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE);
        if ($arrayHaveRightsAcces) {
            $haveRightsAcces = TRUE;
        }
        return $haveRightsAcces;
    }

    /**
     * On supprime les droits sur id intranet actions de l'utilisateur connecté 
     * correspondants à l'id intranet actions parents
     * @param int $paramIdUser
     * @param int $paramIdIntranetModule
     * @param int $paramIdIntranetAction
     */
    public static function eraseUserRightsAcces($paramIdUser, $paramIdIntranetModule, $paramIdIntranetAction) {
        $arrayEraseRightsAcces = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . self::KEYNAME
                        . " FROM  " . self::TABLENAME . "," . IntranetActionsModel::TABLENAME
                        . " WHERE " . self::FIELDNAME_ID_INTRANET_MODULES . " =" . $paramIdIntranetModule
                        . " AND " . self::FIELDNAME_ID_USER . " =" . $paramIdUser
                        . " AND " . self::TABLENAME . "." . self::FIELDNAME_ID_INTRANET_ACTIONS . " =" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                        . " AND " . self::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . " =" . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                        . " AND " . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS . " =" . $paramIdIntranetAction);
        if ($arrayEraseRightsAcces) {
            foreach ($arrayEraseRightsAcces as $rowsEraseRightsAcces) {
                DatabaseOperation::execute(
                        'DELETE FROM ' . self::TABLENAME
                        . ' WHERE ' . self::KEYNAME . '=' . $rowsEraseRightsAcces[self::KEYNAME]
                );
            }
        }
    }

    /**
     * Récupération de Id intranet actions par utilisateur et par site
     * @param type $paramIdUser
     * @param type $paramIdFtaRole
     * @return type
     */
    public static function getIdIntranetActionsByRoleANDSiteFromUser($paramIdUser, $paramIdFtaRole) {
        $arrayIdIntranetActions = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' FROM ' . self::TABLENAME . ', ' . FtaActionRoleModel::TABLENAME
                        . ' WHERE ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' = ' . self::TABLENAME . '.' . self::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' AND ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE . '=' . $paramIdFtaRole
                        . ' AND ' . self::FIELDNAME_ID_USER . '=' . $paramIdUser
                        . ' AND ' . self::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . ' =' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                        . ' UNION SELECT ' . FtaActionSiteModel::TABLENAME . '.' . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' FROM ' . self::TABLENAME . ', ' . FtaActionSiteModel::TABLENAME
                        . ' WHERE ' . FtaActionSiteModel::TABLENAME . '.' . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' = ' . self::TABLENAME . '.' . self::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' AND ' . self::FIELDNAME_ID_USER . '=' . $paramIdUser
                        . ' AND ' . self::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . ' =' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
        );

        if ($arrayIdIntranetActions) {
            foreach ($arrayIdIntranetActions as $rowsIdIntranetActions) {
                $IdIntranetActions[] = $rowsIdIntranetActions[self::FIELDNAME_ID_INTRANET_ACTIONS];
            }
        } else {
            $IdIntranetActions = array();
        }
        return $IdIntranetActions;
    }

    /**
     * On récupère les droits d'accès de l'utilisateur sur l'intranet
     * @param int $paramIdUser
     * @param int $paramIdFtaRole
     * @return array
     */
    public static function checkIdIntranetActionsByRoleANDSiteFromUser($paramIdUser, $paramIdFtaRole) {
        if ($paramIdFtaRole <> "0") {
            $arrayIdIntranetActionsParent = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT DISTINCT ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS
                            . ' FROM ' . self::TABLENAME . ', ' . FtaActionRoleModel::TABLENAME
                            . ', ' . IntranetActionsModel::TABLENAME
                            . ' WHERE ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                            . ' = ' . self::TABLENAME . '.' . self::FIELDNAME_ID_INTRANET_ACTIONS
                            . ' AND ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE . '=' . $paramIdFtaRole
                            . ' AND ' . self::FIELDNAME_ID_USER . '=' . $paramIdUser
                            . ' AND ' . self::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . ' =' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                            . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                            . ' = ' . self::TABLENAME . '.' . self::FIELDNAME_ID_INTRANET_ACTIONS
            );
        } else {
            $arrayIdIntranetActionsParent = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT DISTINCT ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS
                            . ' FROM ' . self::TABLENAME . ', ' . IntranetActionsModel::TABLENAME
                            . ' WHERE ' . self::FIELDNAME_ID_USER . '=' . $paramIdUser
                            . ' AND ' . self::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . ' =' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                            . ' AND ' . self::FIELDNAME_ID_INTRANET_MODULES . ' =' . IntranetModulesModel::ID_MODULES_FTA
                            . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                            . ' = ' . self::TABLENAME . '.' . self::FIELDNAME_ID_INTRANET_ACTIONS
            );
        }
        if ($arrayIdIntranetActionsParent) {
            foreach ($arrayIdIntranetActionsParent as $rowsIdIntranetActionsParent) {
                $IdIntranetActionsParent[] = $rowsIdIntranetActionsParent[IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS];
            }
            $arrayIdIntranetActions = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT DISTINCT ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                            . ' FROM ' . IntranetActionsModel::TABLENAME
                            . ' WHERE ( 0 ' . IntranetActionsModel::addIdIntranetActionParent($IdIntranetActionsParent) . ' )');

            if ($arrayIdIntranetActions) {
                foreach ($arrayIdIntranetActions as $rowsIdIntranetActions) {
                    $IdIntranetActions[] = $rowsIdIntranetActions[self::FIELDNAME_ID_INTRANET_ACTIONS];
                }
            } else {
                $IdIntranetActions = array("0");
            }
        } else {
            $IdIntranetActions = array("0");
        }
        return $IdIntranetActions;
    }

    /**
     * Construction des droits d'accès pour tous les modules:
     * Boris Sanègre 2003.03.25
     * Franck Amofa 2015.08.07
     * @param int $paramSalUser
     */
    public static function buildHtmlDroitsAcces($paramSalUser = NULL) {
        echo '<br>';
        echo '</center>';
        echo '</td>';
        echo '</tr>';
        echo '</table>';
        echo '</div>';
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo '<br>';
        echo '</td>';
        echo '</tr>';

        $arrayModule = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . IntranetModulesModel::KEYNAME . ',' . IntranetModulesModel::FIELDNAME_NOM_USUEL_INTRANET_MODULES
                        . ' FROM ' . IntranetModulesModel::TABLENAME
                        . ' WHERE ' . IntranetModulesModel::FIELDNAME_ADMINISTRATION_MODULE . '=' . IntranetModulesModel::ADMINISTRATION_MODULE_TRUE
                        . ' ORDER BY ' . IntranetModulesModel::FIELDNAME_NOM_USUEL_INTRANET_MODULES . ' ASC');
        $colonne = 6;

        foreach ($arrayModule as $rowsModules) {
            /*
             * Préparation des variables
             */
            $nomUsuelIntranetModules = $rowsModules[IntranetModulesModel::FIELDNAME_NOM_USUEL_INTRANET_MODULES];
            $idIntranetModules = $rowsModules[IntranetModulesModel::KEYNAME];

            /*
             * Contruction du tableau pour les Fta
             */
            if ($idIntranetModules == IntranetModulesModel::ID_MODULES_FTA) {
                echo '<br>';
                echo '<table width=500 border=1 cellspacing=1 cellpadding=3 align=center>';

                // Nom du module
                echo '<tr>';
                echo '<td bgcolor=\'#FF8000\'>';
                echo '<center>';
                echo '<h3>' . $nomUsuelIntranetModules . '';
                echo '</center>';
                echo '</td>';
                echo '</tr><td>';



                /*
                 * Droits d'accès du module
                 * Recherche des droits d'accès par workflow
                 */

                $arrayActionsWorkflow = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT DISTINCT ' . IntranetActionsModel::KEYNAME
                                . ',' . IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS
                                . ',' . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS
                                . ' FROM ' . IntranetActionsModel::TABLENAME
                                . ' WHERE ' . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS . '=' . $idIntranetModules
                                . ' ORDER BY ' . IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS
                );

                foreach ($arrayActionsWorkflow as $rowsActionsWorkflow) {
                    $arrayActions = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                    'SELECT DISTINCT ' . IntranetActionsModel::KEYNAME
                                    . ', ' . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS
                                    . ', ' . IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS
                                    . ', ' . IntranetActionsModel::FIELDNAME_TAG_INTRANET_ACTIONS
                                    . ' FROM ' . IntranetActionsModel::TABLENAME
                                    . ' WHERE ' . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS . '=' . $rowsActionsWorkflow[IntranetActionsModel::KEYNAME]
                    );
                    $idWorkflow[] = $rowsActionsWorkflow[IntranetActionsModel::KEYNAME];

                    $SiteDeProduction = NULL;
                    $Role = NULL;
                    if ($arrayActions) {
                        if ($paramSalUser) {
                            $checked = self::checkValueByNiveauAcces($paramSalUser, $rowsActionsWorkflow[IntranetActionsModel::KEYNAME], $idIntranetModules);
                        }
                        if ($checked) {
                            $visible = 'visibility';
                        } else {
                            $visible = 'hidden';
                        }


                        $ftaDroitsAcces .= '<table border=1 width=500 ><td class=id_fta_workflow style=' . $visible . ' align=left width=100><input type=checkbox name=' . $rowsActionsWorkflow[IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS] . '_' . $rowsActionsWorkflow[IntranetActionsModel::KEYNAME]
                                . ' value=1 ' . $checked . '/>' . $rowsActionsWorkflow[IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS] . '</td>'
                                . '<td align=left class=site  style=' . $visible . ' ><table >';

                        foreach ($arrayActions as $rowsActions) {
                            if ($rowsActions[IntranetActionsModel::FIELDNAME_TAG_INTRANET_ACTIONS] == 'site') {
                                if ($paramSalUser) {
                                    $checked = self::checkValueByNiveauAcces($paramSalUser, $rowsActions[IntranetActionsModel::KEYNAME], $idIntranetModules);
                                }
                                if ($checked) {
                                    $visible = 'visibility';
                                } else {
                                    $visible = 'hidden';
                                }
                                $SiteDeProduction .= '<tr  align=left><td  class=loginFFFFFFdroit valign=top width=172>'
                                        . '<input type=checkbox name=' . $rowsActions[IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS] . '_' . $rowsActions[IntranetActionsModel::KEYNAME]
                                        . ' value=1 ' . $checked . '/>' . $rowsActions[IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS] . '</td></tr></td>';
                            } else {
                                if ($paramSalUser) {
                                    $checked = self::checkValueByNiveauAcces($paramSalUser, $rowsActions[IntranetActionsModel::KEYNAME], $idIntranetModules);
                                }
                                if ($checked) {
                                    $visible = 'visibility';
                                } else {
                                    $visible = 'hidden';
                                }
                                $Role .= '<tr align=left><td  class=loginFFFFFFdroit valign=top width=172><input type=checkbox name=' . $rowsActions[IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS] . '_' . $rowsActions[IntranetActionsModel::KEYNAME]
                                        . ' value=1 ' . $checked . '/>' . $rowsActions[IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS] . '</td></tr></td>';
                            }
                        }

                        $ftaDroitsAcces .=$SiteDeProduction . '</table></td><td class=role style=' . $visible . ' ><table >' . $Role . '</table></td></table>';
                    }
                }
                /*
                 * Recherche des droits d'accès globaux
                 */
                $arrayActionsGlobaux = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT DISTINCT ' . IntranetActionsModel::KEYNAME
                                . ', ' . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS
                                . ', ' . IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS
                                . ', ' . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS
                                . ' FROM ' . IntranetActionsModel::TABLENAME
                                . ' WHERE ' . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS . '=' . '0'
                );
                $ftaDroitsAccesGlobaux = '<table width=500 border=1>';
                foreach ($arrayActionsGlobaux as $rowsActionsGlobaux) {
                    if ($paramSalUser) {
                        $checked = self::checkValueByNiveauAcces($paramSalUser, $rowsActionsGlobaux[IntranetActionsModel::KEYNAME], $idIntranetModules);
                    }
                    $ftaDroitsAccesGlobaux .='<td  align=left width=100><input type=checkbox onclick=Change()'
                            . ' id=' . $rowsActionsGlobaux[IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS]
                            . ' name=' . $rowsActionsGlobaux[IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS] . '_' . $rowsActionsGlobaux[IntranetActionsModel::KEYNAME]
                            . ' value=1 ' . $checked . ' />' . $rowsActionsGlobaux[IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS] . '</td>'
                    ;
                }

                $ftaDroitsAccesGlobaux.= '</table>';

                /**
                 * Drois d'accès au module Fta
                 */
                echo '<table>';
                echo '<tr>';
                $arrayActionsAccesModuleFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT DISTINCT ' . IntranetActionsModel::KEYNAME
                                . ', ' . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS
                                . ', ' . IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS
                                . ', ' . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS
                                . ' FROM ' . IntranetActionsModel::TABLENAME
                                . ' WHERE ' . IntranetActionsModel::FIELDNAME_TAG_INTRANET_ACTIONS . '=\'' . IntranetActionsModel::VALUE_FTA . '\''
                );

                self::getHtmlListeAccesFta($arrayActionsAccesModuleFta, $idIntranetModules, $paramSalUser);
                $arrayActionsDiffusionImpression = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT DISTINCT ' . IntranetActionsModel::KEYNAME
                                . ', ' . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS
                                . ', ' . IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS
                                . ' FROM ' . IntranetModulesModel::TABLENAME . ',' . IntranetActionsModel::TABLENAME
                                . ' WHERE ' . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS . '=' . '0'
                                . ' AND ' . IntranetActionsModel::KEYNAME . '<>\'' . IntranetNiveauAccesModel::NIVEAU_FTA_CONSULTATION . '\''
                                . ' AND ' . IntranetActionsModel::KEYNAME . '<>\'' . IntranetNiveauAccesModel::NIVEAU_FTA_MODIFICATION . '\''
                );

                self::getHtmlListeAccesFta($arrayActionsDiffusionImpression, $idIntranetModules, $paramSalUser);

                $arrayActionsAccesDiffusionFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT DISTINCT ' . IntranetActionsModel::KEYNAME
                                . ', ' . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS
                                . ', ' . IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS
                                . ', ' . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS
                                . ' FROM ' . IntranetActionsModel::TABLENAME
                                . ' WHERE ' . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS . '=\'' . IntranetActionsModel::NAME_DIFFUSION_FTA . '\''
                );

                self::getHtmlListeAccesFta($arrayActionsAccesDiffusionFta, $idIntranetModules, $paramSalUser);

                echo '</tr>';
                echo '</table>';

//                echo $ftaDroitsAccesGlobaux . $ftaDroitsAcces . '</td>';
                /**
                 * On détermine l'affichage des droits d'acces sur l'espace de travail
                 */
                $acccesModuleFta = self::getAccesModuleFtaValue($paramSalUser);
                $style = self::getStyleAdministrationBouttonByAccesModuleFtaValue($acccesModuleFta, IntranetActionsModel::NAME_DROIT_MODIFICATION);

                
                echo '<div id=' . IntranetActionsModel::NAME_DROIT_MODIFICATION . ' ' . $style . '>' . $ftaDroitsAcces . '</div></td>';
            } else {

                /*
                 * Construction du tableau
                 */
                echo '<br>';
                echo '<table width=500 border=1 cellspacing=1 cellpadding=3 align=center>';

                // Nom du module
                echo '<tr>';
                echo '<td bgcolor=\'#FF8000\'>';
                echo '<center>';
                echo '<h3>' . $nomUsuelIntranetModules . '';
                echo '</center>';
                echo '</td>';
                echo '</tr>';

                //Droits d'accès du module
                //Recherche des droits d'accès globaux
                $arrayActions = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT DISTINCT ' . IntranetActionsModel::KEYNAME
                                . ', ' . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS
                                . ', ' . IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS
                                . ' FROM ' . IntranetModulesModel::TABLENAME . ',' . IntranetActionsModel::TABLENAME
                                . ' WHERE ' . IntranetModulesModel::TABLENAME . '.' . IntranetModulesModel::KEYNAME
                                . '=' . $idIntranetModules
                                . ' AND (' . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS . '=' . '0'
                                . ' OR ' . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS . '=' . $idIntranetModules . ')'
                );


                /*
                 * Tableau de définitions des droits d'accès
                 */
                echo '<tr align=center><td><table border=0><tr>';
                $current_colonne = 0;
                foreach ($arrayActions as $rowsActions) {
                    //Préparation des variables
                    $idIntranetActions = $rowsActions[IntranetActionsModel::KEYNAME];
                    $descriptionIntranetActions = $rowsActions[IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS];



                    /*
                     * Construction de la liste déroulante des niveaux d'accès
                     */
                    /*
                     * Recherche de niveaux spécifiques
                     */
                    $arrayNiveauSpecAcces = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                    'SELECT ' . IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_NIVEAU_ACCES
                                    . ',' . IntranetNiveauAccesModel::FIELDNAME_NOM_INTRANET_NIVEAU_ACCES
                                    . ' FROM ' . IntranetNiveauAccesModel::TABLENAME
                                    . ' WHERE ' . IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_MODULES . '=' . $idIntranetModules
                                    . ' AND ' . IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . '=' . $idIntranetActions
                    );

                    $compte_niveau_specifique = count($arrayNiveauSpecAcces);
                    if ($compte_niveau_specifique) {
                        /*
                         * S'il existe des niveaux personnalisés, alors ceux-ci sont utilisés
                         */
                        $arrayNiveauAcces = $arrayNiveauSpecAcces;
                    } else {

                        $arrayNiveauAcces = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                        'SELECT ' . IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_NIVEAU_ACCES
                                        . ',' . IntranetNiveauAccesModel::FIELDNAME_NOM_INTRANET_NIVEAU_ACCES
                                        . ' FROM ' . IntranetNiveauAccesModel::TABLENAME
                                        . ' WHERE ' . IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_MODULES . '=0'
                                        . ' AND ' . IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . '=0');
                    }

                    /*
                     * Liste déroulante montrant les différents niveaux d'accès pour le droit d'accès
                     */
                    $nb = count($arrayNiveauAcces);
                    if ($nb > 1) { /*
                     * Si il y a plus d'une possibilité, alors liste déroulante
                     * Construction du tableau
                     */
                        if ($current_colonne == $colonne) {
                            echo '</tr><tr>';
                            $current_colonne = 0;
                        }
                        $current_colonne++;
                        echo '<td class=loginFFFFFFdroit valign=top width=172>';
                        echo '<center>';
                        echo $descriptionIntranetActions . '<br>';

                        $list1 = '<select name=module' . $idIntranetModules . '_action' . $idIntranetActions . '>';
                        foreach ($arrayNiveauAcces as $rowsNiveau) {
                            /*
                             * Création des variables necessaires à la liste
                             */
                            $idIntranetNiveauAcces = $rowsNiveau[IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_NIVEAU_ACCES];
                            $nomIntranetNiveauAcces = $rowsNiveau[IntranetNiveauAccesModel::FIELDNAME_NOM_INTRANET_NIVEAU_ACCES];

                            /*
                              Si l'utilisateur n'existe pas (lors d'une création)
                              alors on prend les droits de
                              l'utilisateur système: 'template'
                             */

//                            if (!$paramSalUser) {
//                                $arrayUser = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
//                                                'SELECT ' . UserModel::KEYNAME
//                                                . ' FROM ' . UserModel::TABLENAME
//                                                . ' WHERE ' . UserModel::FIELDNAME_PRENOM . '='template''
//                                );
//                                if ($arrayUser) {
//                                    foreach ($arrayUser as $value) {
//                                        $idUser = $value[UserModel::KEYNAME];
//                                    }
//                                }
//                            }
                            //Est-ce que l'utilisateur à ce niveau d'accès
                            if
                            (
                                    isset($idIntranetModules)
                                    and isset($idIntranetActions)
                                    and isset($idIntranetNiveauAcces)
                                    and isset($paramSalUser)
                            ) {

                                $arrayDroitsAcces = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                                'SELECT ' . self::FIELDNAME_ID_INTRANET_ACTIONS
                                                . ' FROM ' . self::TABLENAME
                                                . ' WHERE ' . self::FIELDNAME_ID_INTRANET_MODULES . '=' . $idIntranetModules
                                                . ' AND ' . self::FIELDNAME_ID_INTRANET_ACTIONS . '= ' . $idIntranetActions
                                                . ' AND ' . self::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . $idIntranetNiveauAcces
                                                . ' AND ' . self::FIELDNAME_ID_USER . '=' . $paramSalUser
                                );

                                /*
                                 * Si oui, alors il est pris par défaut
                                 */
                                if ($arrayDroitsAcces) {
                                    $selected = 'selected';
                                } else {
                                    $selected = '';
                                }
                            }
                            //Création de la liste
                            $list1.='<option value=' . $idIntranetNiveauAcces . ' ' . $selected . '> ';
                            $list1.=$nomIntranetNiveauAcces;
                            $list1.=' </option>';
                        }
                        $list1.='</select>';
                        echo $list1;
                        echo '<br>';
                        echo '</center>';
                        echo '</td>';
                    }//Fin de la liste déroulante
                }
                echo '</td></tr></table></tr>';
                echo '</table>';
            }
        }
        echo '<br>';
    }

    /**
     * On verifie si l'utilisateur à le droits d'accès sur cette une actions donnée
     * @param type $paramIdUser
     * @param type $paramIdIntranetActions
     * @return string
     */
    private static function checkValueByNiveauAcces($paramIdUser, $paramIdIntranetActions, $paramIdIntranetModule) {
        $arrayNiveauAcces = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        ' SELECT ' . self::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES
                        . ' FROM ' . self::TABLENAME
                        . ' WHERE ' . self::FIELDNAME_ID_USER . '=' . $paramIdUser
                        . ' AND ' . self::FIELDNAME_ID_INTRANET_ACTIONS . '=' . $paramIdIntranetActions
                        . ' AND ' . self::FIELDNAME_ID_INTRANET_MODULES . '=' . $paramIdIntranetModule
        );
        if ($arrayNiveauAcces) {
            foreach ($arrayNiveauAcces as $rowsNiveauAcces) {
                $niveauAcces = $rowsNiveauAcces[self::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES];
            }
        } else {
            $niveauAcces = IntranetNiveauAccesModel::NIVEAU_GENERIC_FALSE;
        }

        if ($niveauAcces == IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE) {
            $checked = 'checked';
        } else {
            $checked = '';
        }
        return $checked;
    }

    /**
     * On obtient le droit de impression pour le module Fta de l'utilisateur connecté
     * @param type $paramIdUser
     * @return type
     */
    public static function getFtaImpression($paramIdUser) {
        $arrayImpression = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        ' SELECT ' . self::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES
                        . ' FROM ' . self::TABLENAME
                        . ' WHERE ' . self::FIELDNAME_ID_USER . '=' . $paramIdUser
                        . ' AND ' . self::FIELDNAME_ID_INTRANET_ACTIONS . '=' . '7'
                        . ' AND ' . self::FIELDNAME_ID_INTRANET_MODULES . '=' . IntranetModulesModel::ID_MODULES_FTA
        );
        foreach ($arrayImpression as $rowsImpression) {
            $fta_impression = $rowsImpression[self::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES];
        }
        return $fta_impression;
    }

    /**
     * On obtient le droit de consultation pour le module Fta de l'utilisateur connecté
     * @param type $paramIdUser
     * @return type
     */
    public static function getFtaConsultation($paramIdUser) {
        $arrayConsultation = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        ' SELECT ' . self::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES
                        . ' FROM ' . self::TABLENAME
                        . ' WHERE ' . self::FIELDNAME_ID_USER . '=' . $paramIdUser
                        . ' AND ' . self::FIELDNAME_ID_INTRANET_ACTIONS . '=' . '1'
                        . ' AND ' . self::FIELDNAME_ID_INTRANET_MODULES . '=' . IntranetModulesModel::ID_MODULES_FTA
        );
        foreach ($arrayConsultation as $rowsConsultation) {
            $fta_consultation = $rowsConsultation[self::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES];
        }
        return $fta_consultation;
    }

    /**
     * On obtient le droit de modification pour le module Fta de l'utilisateur connecté
     * @param int $paramIdUser
     * @return int
     */
    public static function getFtaModification($paramIdUser) {
        $arrayModification = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        ' SELECT ' . self::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES
                        . ' FROM ' . self::TABLENAME
                        . ' WHERE ' . self::FIELDNAME_ID_USER . '=' . $paramIdUser
                        . ' AND ' . self::FIELDNAME_ID_INTRANET_ACTIONS . '=' . '2'
                        . ' AND ' . self::FIELDNAME_ID_INTRANET_MODULES . '=' . IntranetModulesModel::ID_MODULES_FTA
        );
        foreach ($arrayModification as $rowsModifications) {
            $fta_modification = $rowsModifications[self::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES];
        }
        return $fta_modification;
    }

    public static function isIdUserHaveRightsOnSiteProdByWorkflow($paramIdUser, $paramIdFtaWorkflow, $paramIdFtaSiteDeProduction) {
        $isIdUserHaveRightsOnSiteProd = FALSE;
        /**
         * On obtient IdintranetAction du site de production
         */
        $idIntranetActionsSiteDeProduction = FtaActionSiteModel::getArrayIdIntranetActionByWorkflowAndSiteDeProduction($paramIdFtaWorkflow, $paramIdFtaSiteDeProduction);
        /**
         * On verifie si selon le workflow  et site de production en cours l'utilisateur connecté à les droits d'accès.
         * Puisqu'un utilisateur ne doit pas avoir accès aux boutons :
         * historique, transition, retirer, duplication et pourcentage d'avancement
         * si il n'a pas les accès aux site de production.
         */
        $checkAccesButtonBySiteProd = IntranetActionsModel::isAccessFtaActionByIdUserFtaWorkflowAndSiteDeProduction($paramIdUser, $paramIdFtaWorkflow, $idIntranetActionsSiteDeProduction);

        if ($checkAccesButtonBySiteProd) {
            $isIdUserHaveRightsOnSiteProd = TRUE;
        }

        return $isIdUserHaveRightsOnSiteProd;
    }

    /**
     * Affiche le tableau de récapitulatif des droits d'accès sur le module Fta
     * @return string
     */
    public static function getHtmlArrayAccesRightUser() {

        /**
         * Entête du tableau
         */
        $bloc.= "<" . "table " . "border=1 " . "width=100% " . "class=contenu " . ">"
                . "<th>" . "Utilisateurs" . "</th><th>" . "Accès général" . "</th><th>" . "Diffusion" . "</th><th>" . "Impression" . "</th><th>" . "Espace de travail <br>(Mettre la souris sur un espace de travail pour voir le détail) " . "</th>";

//lister les utilisateurs concernés

        $arrayUser = self::getArrayUserWithAccesRightsToFta();
        foreach ($arrayUser as $rowsUser) {
            $lienWorkflow = "";
            $listeRole = "";
            $virgule = "";
            $virgule2 = "";
            //Tableau des id intranet actions Fta
            $arrayAction = self::getArrayIdIntranetActionWithAccesRightsToFtaByUser($rowsUser[UserModel::KEYNAME]);


            $bloc.= "<tr class=contenu><td>"
                    . $rowsUser[UserModel::FIELDNAME_PRENOM] . " " . $rowsUser[UserModel::FIELDNAME_NOM]
                    . "</td>"
            ;
            /**
             * Vérification des droits d'accès généraux
             */
            $checkModification = FtaController::isValueInArray(IntranetNiveauAccesModel::NIVEAU_FTA_MODIFICATION, $arrayAction);
            $checkConsultation = FtaController::isValueInArray(IntranetNiveauAccesModel::NIVEAU_FTA_CONSULTATION, $arrayAction);
            $checkDiffusion = FtaController::isValueInArray(IntranetNiveauAccesModel::NIVEAU_FTA_DIFFUSION, $arrayAction);
            $checkImpression = FtaController::isValueInArray(IntranetNiveauAccesModel::NIVEAU_FTA_IMPRESSION, $arrayAction);

            /**
             * Si accès Fta Modif
             */
            if ($checkModification) {
                $accesGeneralValue = "Modification";
                $diffusion = "Voir espaces de Travail";
                /**
                 * Identification des Id intranet action workflow
                 */
                $arrayIdIntranetParents = DatabaseOperation::convertSqlStatementWithoutKeyToArrayComplete(
                                " SELECT " . IntranetActionsModel::KEYNAME
                                . " FROM  " . IntranetActionsModel::TABLENAME
                                . " WHERE " . IntranetActionsModel::FIELDNAME_TAG_INTRANET_ACTIONS . "='" . IntranetActionsModel::VALUE_WORKFLOW . "' "
                );

                $arrayIdActionWorkflow = array_intersect($arrayIdIntranetParents, $arrayAction);

                if ($arrayIdActionWorkflow) {
                    foreach ($arrayIdActionWorkflow as $rowsIdActionWorkflow) {
                        $listeRole = "";
                        $virgule2 = "";
                        /**
                         * Identification du workflow
                         */
                        $arrayIdIntranetParents = DatabaseOperation::convertSqlStatementWithoutKeyToArrayComplete(
                                        " SELECT " . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
                                        . " FROM  " . FtaWorkflowModel::TABLENAME
                                        . " WHERE " . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS . "=" . $rowsIdActionWorkflow
                        );
                        /**
                         * Identification des Id intranet action  role du workflow
                         */
                        $arrayIdIntranetRole = DatabaseOperation::convertSqlStatementWithoutKeyToArrayComplete(
                                        " SELECT " . IntranetActionsModel::KEYNAME
                                        . " FROM  " . IntranetActionsModel::TABLENAME
                                        . " WHERE " . IntranetActionsModel::FIELDNAME_TAG_INTRANET_ACTIONS . "='" . IntranetActionsModel::VALUE_ROLE . "' "
                                        . " AND " . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS . "=" . $rowsIdActionWorkflow
                        );
                        $arrayIdActionRole = array_intersect($arrayIdIntranetRole, $arrayAction);
                        if ($arrayIdActionRole) {
                            foreach ($arrayIdActionRole as $rowsIdActionRole) {
                                /**
                                 * Liste des rôles attribué pour le workflow
                                 */
                                $arrayRole = DatabaseOperation::convertSqlStatementWithoutKeyToArrayComplete(
                                                " SELECT " . FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE
                                                . " FROM  " . FtaRoleModel::TABLENAME . "," . FtaActionRoleModel::TABLENAME
                                                . " WHERE " . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS . "=" . $rowsIdActionRole
                                                . " AND " . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                );
                                $listeRole .= $virgule2 . $arrayRole["0"];
                                $virgule2 = ", ";
                            }
                        }
                        $lienWorkflow .= $virgule . "<span title=\" " . $listeRole . " \" >" . $arrayIdIntranetParents["0"] . "</span>";
                        $virgule = ", ";
                    }
                }
                /**
                 * Si accès Fta Consultation
                 */
            } elseif ($checkConsultation) {
                $accesGeneralValue = "Consultation";
                /**
                 * Droits de difussion
                 */
                if ($checkDiffusion) {
                    $geoModel = new GeoModel($rowsUser[UserModel::FIELDNAME_LIEU_GEO]);
                    $diffusion = $geoModel->getDataField(GeoModel::FIELDNAME_GEO)->getFieldValue();
                } else {
                    $diffusion = "Non";
                }
                /**
                 * Droits de difussion
                 */
            } else {
                $accesGeneralValue = "Non";
                if ($checkDiffusion) {
                    $geoModel = new GeoModel($rowsUser[UserModel::FIELDNAME_LIEU_GEO]);
                    $diffusion = $geoModel->getDataField(GeoModel::FIELDNAME_GEO)->getFieldValue();
                } else {
                    $diffusion = "Non";
                }
            }
            /**
             * Droits d'impression
             */
            if ($checkImpression) {
                $impression = "Oui";
            } else {
                $impression = "Non";
            }
            $bloc.="<td>" . $accesGeneralValue . "</td>"
                    . "<td>" . $diffusion . "</td>"
                    . "<td>" . $impression . "</td>"
                    . "<td>" . $lienWorkflow . "</td></tr>"
            ;
        }

        return $bloc;
    }

    /**
     * On récupère le tableau des utilisateurs par l'id, le nom, prenom, lieu géographique ayant accès aux module FTA
     * @return array
     */
    public static function getArrayUserWithAccesRightsToFta() {
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT DISTINCT " . UserModel::TABLENAME . "." . UserModel::KEYNAME
                        . "," . UserModel::FIELDNAME_NOM
                        . "," . UserModel::FIELDNAME_PRENOM
                        . "," . UserModel::FIELDNAME_LIEU_GEO
                        . " FROM " . IntranetDroitsAccesModel::TABLENAME . ", " . UserModel::TABLENAME
                        . " WHERE " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_USER . " = " . UserModel::TABLENAME . "." . UserModel::KEYNAME                              //Liaison
                        . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES . " = '" . IntranetModulesModel::ID_MODULES_FTA . "' "   //liaison
                        . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . " <>'" . IntranetNiveauAccesModel::NIVEAU_GENERIC_FALSE . "'"
                        . " AND " . UserModel::TABLENAME . "." . UserModel::FIELDNAME_ACTIF . " = '" . UserModel::USER_ACTIF
                        . "' ORDER BY " . UserModel::FIELDNAME_NOM . "," . UserModel::FIELDNAME_PRENOM
        );

        return $array;
    }

    /**
     * On récupère le tableau la liste des id intranet Action  ayant accès aux module FTA par utilsateur
     * @return array
     */
    public static function getArrayIdIntranetActionWithAccesRightsToFtaByUser($paramIdUser) {
        $arrayAction = DatabaseOperation::convertSqlStatementWithoutKeyToArrayComplete(
                        "SELECT DISTINCT " . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . " FROM " . IntranetDroitsAccesModel::TABLENAME
                        . " WHERE " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_USER . " = " . $paramIdUser                          //Liaison
                        . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES . " = '" . IntranetModulesModel::ID_MODULES_FTA . "' "   //liaison
                        . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . " <>'" . IntranetNiveauAccesModel::NIVEAU_GENERIC_FALSE . "'"
        );

        return $arrayAction;
    }

    /**
     * Droits globaux pour le module Fta
     * @param type $paramArrayIdIntranetAcces
     */
    private static function getHtmlListeAccesFta($paramArrayIdIntranetAcces, $paramIdIntranetModules, $paramSalUser) {

        if ($paramArrayIdIntranetAcces) {
            /**
             * On récupère la valeur de l'accès au module Fta
             */
            foreach ($paramArrayIdIntranetAcces as $rowsActionsAccesModuleFta) {
                $idIntranetActions = $rowsActionsAccesModuleFta[IntranetActionsModel::KEYNAME];
                $descriptionIntranetActions = $rowsActionsAccesModuleFta[IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS];
                $nomIntranetActions = $rowsActionsAccesModuleFta[IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS];
                
                /**
                 * On détermine l'affichage des droits globaux du module Fta
                 */
                $acccesModuleFta = self::getAccesModuleFtaValue($paramSalUser);
                $style = self::getStyleAdministrationBouttonByAccesModuleFtaValue($acccesModuleFta, $nomIntranetActions);

                /*
                 * Recherche de niveaux spécifiques
                 */
                $arrayNiveauSpecAcces = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT ' . IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_NIVEAU_ACCES
                                . ',' . IntranetNiveauAccesModel::FIELDNAME_NOM_INTRANET_NIVEAU_ACCES
                                . ' FROM ' . IntranetNiveauAccesModel::TABLENAME
                                . ' WHERE ' . IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_MODULES . '=' . $paramIdIntranetModules
                                . ' AND ' . IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . '=' . $idIntranetActions
                );
                if (!$arrayNiveauSpecAcces) {
                    $arrayNiveauSpecAcces = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                    'SELECT ' . IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_NIVEAU_ACCES
                                    . ',' . IntranetNiveauAccesModel::FIELDNAME_NOM_INTRANET_NIVEAU_ACCES
                                    . ' FROM ' . IntranetNiveauAccesModel::TABLENAME
                                    . ' WHERE ' . IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_MODULES . '=0'
                                    . ' AND ' . IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . '=0');
                    $nomIntranetActions = $nomIntranetActions . "_" . $idIntranetActions;
                }
                /**
                 * Si le droit d'acces encours est acces_module_fta alors on ajoute la fonction js 
                 * afin de gérer l'affichage des autres droits d'accès
                 */
                if ($nomIntranetActions == IntranetActionsModel::NAME_ACCES_MODULE_FTA) {
                    $java = 'onchange=\'changeFta()\'';
                    $accesModuleFta = 'id=' . IntranetActionsModel::NAME_ACCES_MODULE_FTA;
                } else {
                    $java = "";
                    $accesModuleFta = "";
                }
                /**
                 * On détermine id de la cellule afin de gérer l'affichage du drtois d'accès
                 */
                $idNomIntranetActions = $nomIntranetActions;
                /**
                 * On enlève l'id acces_module_fta pour la cellue pour ne pas avoir de doublon avec la liste déroulante
                 */
                if ($accesModuleFta) {
                    $idNomIntranetActions = "";
                }

                echo '<td class=loginFFFFFFdroit valign=top width=172 id=' . $idNomIntranetActions . ' ' . $style . ' >';
                echo '<div >';
                echo '<center>';
                echo $descriptionIntranetActions . '<br>';
                $list1 = '<select ' . $accesModuleFta . ' ' . $java . ' name=' . $nomIntranetActions . '>';
                foreach ($arrayNiveauSpecAcces as $rowsNiveau) {
                    /*
                     * Création des variables necessaires à la liste
                     */
                    $idIntranetNiveauAcces = $rowsNiveau[IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_NIVEAU_ACCES];
                    $nomIntranetNiveauAcces = $rowsNiveau[IntranetNiveauAccesModel::FIELDNAME_NOM_INTRANET_NIVEAU_ACCES];
                    if
                    (
                            isset($paramIdIntranetModules)
                            and isset($idIntranetActions)
                            and isset($idIntranetNiveauAcces)
                            and isset($paramSalUser)
                    ) {

                        $arrayDroitsAcces = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                        'SELECT ' . self::FIELDNAME_ID_INTRANET_ACTIONS
                                        . ' FROM ' . self::TABLENAME
                                        . ' WHERE ' . self::FIELDNAME_ID_INTRANET_MODULES . '=' . $paramIdIntranetModules
                                        . ' AND ' . self::FIELDNAME_ID_INTRANET_ACTIONS . '= ' . $idIntranetActions
                                        . ' AND ' . self::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . $idIntranetNiveauAcces
                                        . ' AND ' . self::FIELDNAME_ID_USER . '=' . $paramSalUser
                        );

                        /*
                         * Si oui, alors il est pris par défaut
                         */
                        if ($arrayDroitsAcces) {
                            $selected = 'selected';
                        } else {
                            $selected = '';
                        }
                    }
                    //Création de la liste
                    $list1.='<option value=' . $idIntranetNiveauAcces . ' ' . $selected . '> ';
                    $list1.=$nomIntranetNiveauAcces;
                    $list1.=' </option>';
                }
                $list1.='</select>';
                echo $list1;
                echo '<br>';
                echo '</center>';
                echo '</div>';
                echo '</td>';
            }
        }
    }

    /**
     * Gestion des droits d'accès pour les droits spécifique acces_module_fta et diffusion_fta
     * @param int $paramIdUser
     */
    public static function manageAccesRightToFta($paramIdUser) {
        $arrayActionsAccesModuleFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . IntranetActionsModel::KEYNAME
                        . ', ' . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS
                        . ', ' . IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS
                        . ', ' . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS
                        . ' FROM ' . IntranetActionsModel::TABLENAME
                        . ' WHERE (' . IntranetActionsModel::FIELDNAME_TAG_INTRANET_ACTIONS . '=\'' . IntranetActionsModel::VALUE_FTA . '\''
                        . ' OR ' . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS . '=\'' . IntranetActionsModel::NAME_DIFFUSION_FTA . '\')'
        );
        foreach ($arrayActionsAccesModuleFta as $rowsActionsAccesModuleFta) {
            $nom_niveau_intranet_droits_acces = $rowsActionsAccesModuleFta[IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS];

            $niveau_intranet_droits_acces = Lib::getParameterFromRequest($nom_niveau_intranet_droits_acces);
            $consultation = "consultation_" . IntranetNiveauAccesModel::NIVEAU_FTA_CONSULTATION;
            $modification = "modification_" . IntranetNiveauAccesModel::NIVEAU_FTA_MODIFICATION;
            $diffusion = "diffusion_" . IntranetNiveauAccesModel::NIVEAU_FTA_DIFFUSION;
            $impression = "impression_" . IntranetNiveauAccesModel::NIVEAU_FTA_IMPRESSION;
            if ($nom_niveau_intranet_droits_acces == IntranetActionsModel::NAME_ACCES_MODULE_FTA) {
                switch ($niveau_intranet_droits_acces) {
                    /**
                     * Aucun accès au module Fta
                     */
                    case IntranetNiveauAccesModel::NIVEAU_GENERIC_FALSE:

                        Lib::setParameterFromRequest($consultation, IntranetNiveauAccesModel::NIVEAU_GENERIC_FALSE);
                        Lib::setParameterFromRequest($modification, IntranetNiveauAccesModel::NIVEAU_GENERIC_FALSE);
                        Lib::setParameterFromRequest($diffusion, IntranetNiveauAccesModel::NIVEAU_GENERIC_FALSE);
                        Lib::setParameterFromRequest($impression, IntranetNiveauAccesModel::NIVEAU_GENERIC_FALSE);

                        break;
                    /**
                     * Accès en consultation
                     */
                    case IntranetNiveauAccesModel::NIVEAU_FTA_CONSULTATION:
                        Lib::setParameterFromRequest($consultation, IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE);
                        Lib::setParameterFromRequest($modification, IntranetNiveauAccesModel::NIVEAU_GENERIC_FALSE);


                        break;
                    /**
                     * Accès en modification
                     */
                    case IntranetNiveauAccesModel::NIVEAU_FTA_MODIFICATION:
                        Lib::setParameterFromRequest($consultation, IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE);
                        Lib::setParameterFromRequest($modification, IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE);


                        break;
                }
            }
            /*
             * Enregistrement/Suppression du droit d'accès
             */
            $id_intranet_modules = $rowsActionsAccesModuleFta[IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS];
            $id_intranet_actions = $rowsActionsAccesModuleFta[IntranetActionsModel::KEYNAME];

            /*
             * Suppression des anciens accès
             */
            DatabaseOperation::execute(
                    'DELETE FROM ' . IntranetDroitsAccesModel::TABLENAME
                    . ' WHERE ' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES . '=' . $id_intranet_modules
                    . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdUser
                    . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . '=' . $id_intranet_actions
            );

            /*
             * Réécriture du droits d'accès
             */
            DatabaseOperation::execute(
                    'INSERT INTO ' . IntranetDroitsAccesModel::TABLENAME
                    . ' SET ' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES . '=' . $id_intranet_modules
                    . ', ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdUser
                    . ', ' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . '=' . $id_intranet_actions
                    . ', ' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . $niveau_intranet_droits_acces
            );
        }
    }

    /**
     * Récupération des droits d'accès faisable dans l'Intranet
     * @param int $paramIdUser
     * @param boolean $paramCheck
     * @param int $paramConsultation
     * @param int $paramModification
     */
    public static function manageAccesRightToIntranet($paramIdUser, $paramCheck, $paramConsultation = NULL, $paramModification = NULL) {
        $arrayModule = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . IntranetModulesModel::TABLENAME . '.*'
                        . ', ' . IntranetActionsModel::TABLENAME . '.*'
                        . ' FROM ' . IntranetActionsModel::TABLENAME . ', ' . IntranetModulesModel::TABLENAME
                        . ' WHERE (' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS
                        . '=' . IntranetModulesModel::TABLENAME . '.' . IntranetModulesModel::KEYNAME
                        . ' OR ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS . '=0 )'
                        . ' AND ' . IntranetActionsModel::FIELDNAME_TAG_INTRANET_ACTIONS . '<>\'' . IntranetActionsModel::VALUE_FTA . '\''
                        . ' AND ' . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS . '<>\'' . IntranetActionsModel::NAME_DIFFUSION_FTA . '\''
        );
        foreach ($arrayModule as $rowsModule) {
            /*
             * Déclaration du droits d'accès fourni par droits_acces.inc et récupération de son niveau d'accès
             */
            if ($rowsModule[IntranetModulesModel::KEYNAME] <> IntranetModulesModel::ID_MODULES_FTA) {
                $nom_niveau_intranet_droits_acces = 'module' . $rowsModule[IntranetModulesModel::KEYNAME] . '_action' . $rowsModule[IntranetActionsModel::KEYNAME];
            } else {
                $nom_niveau_intranet_droits_acces = $rowsModule[IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS] . '_' . $rowsModule[IntranetActionsModel::KEYNAME];

                /**
                 * Devons-nous vérifier l'incohérence de l'attribution des droits d'accès
                 */
                if ($paramCheck) {
                    if (!$paramModification) {
                        if ($rowsModule[IntranetActionsModel::FIELDNAME_TAG_INTRANET_ACTIONS] == IntranetActionsModel::VALUE_ROLE) {
                            $nom_niveau_intranet_droits_acces = Null;
                        }
                        if ($rowsModule[IntranetActionsModel::FIELDNAME_TAG_INTRANET_ACTIONS] == IntranetActionsModel::VALUE_SITE) {
                            $nom_niveau_intranet_droits_acces = Null;
                        }
                        if ($rowsModule[IntranetActionsModel::FIELDNAME_TAG_INTRANET_ACTIONS] == IntranetActionsModel::VALUE_WORKFLOW) {
                            $nom_niveau_intranet_droits_acces = Null;
                        }
                        if ($paramConsultation) {
                            if ($nom_niveau_intranet_droits_acces == "diffusion_" . IntranetNiveauAccesModel::NIVEAU_FTA_DIFFUSION) {
                                $nom_niveau_intranet_droits_acces = Null;
                            }
                        }
                    }
                }
            }
            $niveau_intranet_droits_acces = Lib::getParameterFromRequest($nom_niveau_intranet_droits_acces);


            /*
             * Enregistrement/Suppression du droit d'accès
             */
            $id_intranet_modules = $rowsModule[IntranetModulesModel::KEYNAME];
            $id_intranet_actions = $rowsModule[IntranetActionsModel::KEYNAME];
            /*
             * Suppression des anciens accès
             */
            DatabaseOperation::execute(
                    'DELETE FROM ' . IntranetDroitsAccesModel::TABLENAME
                    . ' WHERE ' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES . '=' . $id_intranet_modules
                    . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdUser
                    . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . '=' . $id_intranet_actions
            );

            if ($niveau_intranet_droits_acces) {
                /*
                 * Réécriture du droits d'accès
                 */
                DatabaseOperation::execute(
                        'INSERT INTO ' . IntranetDroitsAccesModel::TABLENAME
                        . ' SET ' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES . '=' . $id_intranet_modules
                        . ', ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdUser
                        . ', ' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . '=' . $id_intranet_actions
                        . ', ' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . $niveau_intranet_droits_acces
                );
            }
        }
    }

    /**
     * On récupère le niveau du droits d'accès acces module fta
     * 0 NON
     * 1 Consultation
     * 2 Modification
     * @param int $paramIdUser
     * @return int
     */
    public static function getAccesModuleFtaValue($paramIdUser = NULL) {
        if ($paramIdUser) {
            $arrayDroitsAcces = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT ' . self::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES
                            . ' FROM ' . self::TABLENAME .','. IntranetActionsModel::TABLENAME
                            . ' WHERE ' . self::FIELDNAME_ID_INTRANET_MODULES . '=' . IntranetModulesModel::ID_MODULES_FTA
                            . ' AND ' . self::TABLENAME . '.' . self::FIELDNAME_ID_INTRANET_ACTIONS
                            . ' = ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                            . ' AND ' . self::TABLENAME . '.' . self::FIELDNAME_ID_INTRANET_MODULES
                            . ' = ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS
                            . ' AND ' . self::FIELDNAME_ID_USER . '=' . $paramIdUser
                            . ' AND ' . IntranetActionsModel::FIELDNAME_TAG_INTRANET_ACTIONS . '=\'' . IntranetActionsModel::VALUE_FTA . '\''
            );

            if ($arrayDroitsAcces) {
                foreach ($arrayDroitsAcces as $rowsDroitsAcces) {
                    $value = $rowsDroitsAcces[self::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES];
                }
            }
        } else {
            $value = IntranetNiveauAccesModel::ACCES_MODULE_FTA_NON_VALUE;
        }
        return $value;
    }

    /**
     * On détermine l'affichage des droits d'accès.
     * @param int $paramAccesModuleFtaValue
     * @param strng $paramNom
     * @return string
     */
    public static function getStyleAdministrationBouttonByAccesModuleFtaValue($paramAccesModuleFtaValue, $paramNom) {
        $style = "";

        switch ($paramNom) {
            case IntranetActionsModel::NAME_IMPRESSION:
                if ($paramAccesModuleFtaValue <> IntranetNiveauAccesModel::ACCES_MODULE_FTA_NON_VALUE) {
                    $style = "";
                } else {
                    $style = "style=display:none;";
                }

                break;
            case IntranetActionsModel::NAME_DIFFUSION:
                if ($paramAccesModuleFtaValue == IntranetNiveauAccesModel::ACCES_MODULE_FTA_MODIFICATION_VALUE) {
                    $style = "";
                } else {
                    $style = "style=display:none;";
                }

                break;
            case IntranetActionsModel::NAME_DIFFUSION_FTA:
                if ($paramAccesModuleFtaValue == IntranetNiveauAccesModel::ACCES_MODULE_FTA_CONSULTATION_VALUE) {
                    $style = "";
                } else {
                    $style = "style=display:none;";
                }

                break;
            case IntranetActionsModel::NAME_DROIT_MODIFICATION:
                if ($paramAccesModuleFtaValue == IntranetNiveauAccesModel::ACCES_MODULE_FTA_MODIFICATION_VALUE) {
                    $style = "";
                } else {
                    $style = "style=display:none;";
                }

                break;
        }

        return $style;
    }

}
