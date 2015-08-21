<?php

/**
 * Description of FtaProcessusModel
 * Table des utilisateurs
 *
 * @author tp4300001
 */
class IntranetDroitsAccesModel {

    const TABLENAME = "intranet_droits_acces";
    const FIELDNAME_ID_INTRANET_MODULES = "id_intranet_modules";
    const FIELDNAME_ID_USER = "id_user";
    const FIELDNAME_ID_INTRANET_ACTIONS = "id_intranet_actions";
    const FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES = "niveau_intranet_droits_acces";

    public static function getIdIntranetActionsByRoleANDSiteFromUser($paramIdUser, $paramIdFtaRole) {
        $arrayIdIntranetActions = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . " FROM " . IntranetDroitsAccesModel::TABLENAME . ", " . FtaActionRoleModel::TABLENAME
                        . " WHERE " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . " = " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE . "=" . $paramIdFtaRole
                        . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $paramIdUser
                        . " AND " . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . " =1"
                        . " UNION SELECT " . FtaActionSiteModel::TABLENAME . "." . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . " FROM " . IntranetDroitsAccesModel::TABLENAME . ", " . FtaActionSiteModel::TABLENAME
                        . " WHERE " . FtaActionSiteModel::TABLENAME . "." . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . " = " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $paramIdUser
                        . " AND " . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . " =1"
        );

        if ($arrayIdIntranetActions) {
            foreach ($arrayIdIntranetActions as $rowsIdIntranetActions) {
                $IdIntranetActions[] = $rowsIdIntranetActions[IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS];
            }
        }
        return $IdIntranetActions;
    }

    /**
     * Construction des droits d'accès pour tous les modules:
     * Boris Sanègre 2003.03.25
     * Franck Amofa 2015.08.07
     * @param type $paramSalUser
     */
    public static function BuildHtmlDroitsAcces($paramSalUser = NULL) {
        echo "<br>";
        echo "</center>";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        echo "</div>";
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo "<br>";
        echo "</td>";
        echo "</tr>";

        $arrayModule = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . IntranetModulesModel::KEYNAME . "," . IntranetModulesModel::FIELDNAME_NOM_USUEL_INTRANET_MODULES
                        . " FROM " . IntranetModulesModel::TABLENAME
                        . " ORDER BY " . IntranetModulesModel::FIELDNAME_NOM_USUEL_INTRANET_MODULES . " ASC");
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
            if ($idIntranetModules == 19) {
                echo "<br>";
                echo "<table width=500 border=1 cellspacing=1 cellpadding=3 align=center>";

                // Nom du module
                echo "<tr>";
                echo "<td bgcolor=\"#FF8000\">";
                echo "<center>";
                echo "<h3>" . $nomUsuelIntranetModules . "";
                echo "</center>";
                echo "</td>";
                echo "</tr><td>";



                /*
                 * Droits d'accès du module
                 * Recherche des droits d'accès par workflow
                 */

                $arrayActionsWorkflow = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                "SELECT DISTINCT " . IntranetActionsModel::KEYNAME
                                . "," . IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS
                                . "," . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS
                                . " FROM " . IntranetActionsModel::TABLENAME
                                . " WHERE " . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS . "=" . $idIntranetModules
                                . " AND " . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS . "=0"
                );

                foreach ($arrayActionsWorkflow as $rowsActionsWorkflow) {
                    $arrayActions = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                    "SELECT DISTINCT " . IntranetActionsModel::KEYNAME
                                    . ", " . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS
                                    . ", " . IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS
                                    . ", " . IntranetActionsModel::FIELDNAME_TAG_INTRANET_ACTIONS
                                    . " FROM " . IntranetActionsModel::TABLENAME
                                    . " WHERE " . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS . "=" . $rowsActionsWorkflow[IntranetActionsModel::KEYNAME]
                    );
                    $idWorkflow[] = $rowsActionsWorkflow[IntranetActionsModel::KEYNAME];

                    $SiteDeProduction = NULL;
                    $Role = NULL;
                    if ($arrayActions) {

                        $checked = IntranetDroitsAccesModel::CheckValueByNiveauAcces($paramSalUser, $rowsActionsWorkflow[IntranetActionsModel::KEYNAME]);


                        $ftaDroitsAcces .= "<table border=1 width=500 ><td class=id_fta_workflow style=visibility:hidden align=left width=100><input type=checkbox name=" . $rowsActionsWorkflow[IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS] . "_" . $rowsActionsWorkflow[IntranetActionsModel::KEYNAME]
                                . " value=1 $checked />" . $rowsActionsWorkflow[IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS] . "</td>"
                                . "<td align=left class=site  style=visibility:hidden ><table >";

                        foreach ($arrayActions as $rowsActions) {
                            if ($rowsActions[IntranetActionsModel::FIELDNAME_TAG_INTRANET_ACTIONS] == "site") {
                                $checked = IntranetDroitsAccesModel::CheckValueByNiveauAcces($paramSalUser, $rowsActions[IntranetActionsModel::KEYNAME]);
                                $SiteDeProduction .="<tr  align=left><td  class=loginFFFFFFdroit valign=top width=172>"
                                        . "<input type=checkbox name=" . $rowsActions[IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS] . "_" . $rowsActions[IntranetActionsModel::KEYNAME]
                                        . " value=1 $checked />" . $rowsActions[IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS] . "</td></tr></td>";
                            } else {
                                $checked = IntranetDroitsAccesModel::CheckValueByNiveauAcces($paramSalUser, $rowsActions[IntranetActionsModel::KEYNAME]);
                                $Role .= "<tr align=left><td  class=loginFFFFFFdroit valign=top width=172><input type=checkbox name=" . $rowsActions[IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS] . "_" . $rowsActions[IntranetActionsModel::KEYNAME]
                                        . " value=1  $checked />" . $rowsActions[IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS] . "</td></tr></td>";
                            }
                        }
                        $ftaDroitsAcces .=$SiteDeProduction . "</table></td><td class=role style=visibility:hidden ><table >" . $Role . "</table></td></table>";
                    }
                }
                /*
                 * Recherche des droits d'accès globaux
                 */
                $arrayActionsGlobaux = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                "SELECT DISTINCT " . IntranetActionsModel::KEYNAME
                                . ", " . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS
                                . ", " . IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS
                                . ", " . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS
                                . " FROM " . IntranetActionsModel::TABLENAME
                                . " WHERE " . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS . "='0'"
                );
                $ftaDroitsAccesGlobaux = "<table width=500 border=1>";
                foreach ($arrayActionsGlobaux as $rowsActionsGlobaux) {

                    $checked = IntranetDroitsAccesModel::CheckValueByNiveauAcces($paramSalUser, $rowsActionsGlobaux[IntranetActionsModel::KEYNAME]);
                    $ftaDroitsAccesGlobaux .="<td  align=left width=100><input type=checkbox onclick=Change()"
                            . " id=" . $rowsActionsGlobaux[IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS]
                            . " name=" . $rowsActionsGlobaux[IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS] . "_" . $rowsActionsGlobaux[IntranetActionsModel::KEYNAME]
                            . " value=1 $checked />" . $rowsActionsGlobaux[IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS] . "</td>"
                    ;
                }

                $ftaDroitsAccesGlobaux.= "</table>";

                echo $ftaDroitsAccesGlobaux . $ftaDroitsAcces . "</td>";
            } else {

                /*
                 * Construction du tableau
                 */
                echo "<br>";
                echo "<table width=500 border=1 cellspacing=1 cellpadding=3 align=center>";

                // Nom du module
                echo "<tr>";
                echo "<td bgcolor=\"#FF8000\">";
                echo "<center>";
                echo "<h3>" . $nomUsuelIntranetModules . "";
                echo "</center>";
                echo "</td>";
                echo "</tr>";

                //Droits d'accès du module
                //Recherche des droits d'accès globaux
                $arrayActions = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                "SELECT DISTINCT " . IntranetActionsModel::KEYNAME
                                . ", " . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS
                                . ", " . IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS
                                . " FROM " . IntranetModulesModel::TABLENAME . "," . IntranetActionsModel::TABLENAME
                                . " WHERE " . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME
                                . "=" . $idIntranetModules
                                . " AND (" . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS . "='0'"
                                . " OR " . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS . "=$idIntranetModules)"
                );


                /*
                 * Tableau de définitions des droits d'accès
                 */
                echo "<tr align=center><td><table border=0><tr>";
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
                                    "SELECT " . IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_NIVEAU_ACCES
                                    . "," . IntranetNiveauAccesModel::FIELDNAME_NOM_INTRANET_NIVEAU_ACCES
                                    . " FROM " . IntranetNiveauAccesModel::TABLENAME
                                    . " WHERE " . IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_MODULES . "=" . $idIntranetModules
                                    . " AND " . IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . "=" . $idIntranetActions
                    );

                    $compte_niveau_specifique = count($arrayNiveauSpecAcces);
                    if ($compte_niveau_specifique) {
                        /*
                         * S'il existe des niveaux personnalisés, alors ceux-ci sont utilisés
                         */
                        $arrayNiveauAcces = $arrayNiveauSpecAcces;
                    } else {

                        $arrayNiveauAcces = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                        "SELECT " . IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_NIVEAU_ACCES
                                        . "," . IntranetNiveauAccesModel::FIELDNAME_NOM_INTRANET_NIVEAU_ACCES
                                        . " FROM " . IntranetNiveauAccesModel::TABLENAME
                                        . " WHERE " . IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_MODULES . "=0"
                                        . " AND " . IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . "=0");
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
                            echo "</tr><tr>";
                            $current_colonne = 0;
                        }
                        $current_colonne++;
                        echo "<td class=loginFFFFFFdroit valign=top width=172>";
                        echo "<center>";
                        echo "$descriptionIntranetActions<br>";

                        $list1 = "<select name=module" . $idIntranetModules . "_action" . $idIntranetActions . ">";
                        foreach ($arrayNiveauAcces as $rowsNiveau) {
                            /*
                             * Création des variables necessaires à la liste
                             */
                            $idIntranetNiveauAcces = $rowsNiveau[IntranetNiveauAccesModel::FIELDNAME_ID_INTRANET_NIVEAU_ACCES];
                            $nomIntranetNiveauAcces = $rowsNiveau[IntranetNiveauAccesModel::FIELDNAME_NOM_INTRANET_NIVEAU_ACCES];

                            /*
                              Si l'utilisateur n'existe pas (lors d'une création)
                              alors on prend les droits de
                              l'utilisateur système: "template"
                             */

//                            if (!$paramSalUser) {
//                                $arrayUser = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
//                                                "SELECT " . UserModel::KEYNAME
//                                                . " FROM " . UserModel::TABLENAME
//                                                . " WHERE " . UserModel::FIELDNAME_PRENOM . "='template'"
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
                                                "SELECT " . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                                . " FROM " . IntranetDroitsAccesModel::TABLENAME
                                                . " WHERE " . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES . "=" . $idIntranetModules
                                                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . "= " . $idIntranetActions
                                                . " AND " . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=" . $idIntranetNiveauAcces
                                                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $paramSalUser
                                );

                                /*
                                 * Si oui, alors il est pris par défaut
                                 */
                                if ($arrayDroitsAcces) {
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                            }
                            //Création de la liste
                            $list1.="<option value=$idIntranetNiveauAcces $selected>";
                            $list1.="$nomIntranetNiveauAcces";
                            $list1.="</option>";
                        }
                        $list1.="</select>";
                        echo $list1;
                        echo "<br>";
                        echo "</center>";
                        echo "</td>";
                    }//Fin de la liste déroulante
                }
                echo "</td></tr></table></tr>";
                echo "</table>";
            }
        }
        echo "<br>";
    }

    /**
     * On verifie si l'utilisateur à le droits d'accès sur cette une actions donnée
     * @param type $paramIdUser
     * @param type $paramIdIntranetActions
     * @return string
     */
    private static function CheckValueByNiveauAcces($paramIdUser, $paramIdIntranetActions) {
        $arrayNiveauAcces = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        " SELECT " . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES
                        . " FROM " . IntranetDroitsAccesModel::TABLENAME
                        . " WHERE " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $paramIdUser
                        . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . "=" . $paramIdIntranetActions
        );
        if ($arrayNiveauAcces) {
            foreach ($arrayNiveauAcces as $rowsNiveauAcces) {
                $niveauAcces = $rowsNiveauAcces[IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES];
            }
        } else {
            $niveauAcces = 0;
        }

        if ($niveauAcces == 1) {
            $checked = "checked";
        } else {
            $checked = "";
        }
        return $checked;
    }

}
