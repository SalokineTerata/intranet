<?php

/**
 * Description of FtaEtatModel
 * Table des états d'une FTA
 *
 * @author salokine
 */
class FtaEtatModel extends AbstractModel {

    const TABLENAME = "fta_etat";
    const KEYNAME = "id_fta_etat";
    const FIELDNAME_ABREVIATION = "abreviation_fta_etat";
    const FIELDNAME_NOM_FTA_ETAT = "nom_fta_etat";

    public static function getFtaEtatAndNameByRole($paramIdFtaRole) {

        $arrayFtaEtatAndName = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT DISTINCT " . FtaEtatModel::FIELDNAME_NOM_FTA_ETAT
                        . "," . FtaEtatModel::FIELDNAME_ABREVIATION
                        . "," . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT
                        . " FROM " . FtaEtatModel::TABLENAME
                        . "," . FtaRoleModel::TABLENAME . "," . FtaModel::TABLENAME
                        . "," . FtaWorkflowModel::TABLENAME . "," . FtaWorkflowStructureModel::TABLENAME
                        . " WHERE " . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME . "=" . $paramIdFtaRole
                        . " AND " . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME
                        . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                        . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                        . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                        . " AND " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                        . "=" . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                        . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT . "=" . FtaEtatModel::TABLENAME . "." . FtaEtatModel::KEYNAME
        );
        return $arrayFtaEtatAndName;
    }

    public static function getIdFtaByEtatAvancement($paramSyntheseAction, $paramEtat, $paramRole) {
        $globalConfig = new GlobalConfig();
        $id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();


        switch ($paramSyntheseAction) {

            case "attente":

                //Distinction entre le En cours et le En attente
                //Par rapport aux suivi de projets gérés, récupération des processus
                /*
                 * Marche pour tous les cas sauf qualité
                 * Nous recupérons les Fta en attente selon son rôle et workflow
                 */
                $arrayTmp = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT DISTINCT " . FtaModel::KEYNAME . "," . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . " FROM " . FtaSuiviProjetModel::TABLENAME . "," . FtaWorkflowStructureModel::TABLENAME
                                . ", " . FtaProcessusCycleModel::TABLENAME
                                . " WHERE " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . " in (SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                                . " FROM " . FtaProcessusCycleModel::TABLENAME . " , " . FtaProcessusModel::TABLENAME
                                . " , " . FtaWorkflowStructureModel::TABLENAME
                                . " , " . IntranetActionsModel::TABLENAME . " , " . IntranetDroitsAccesModel::TABLENAME
                                . " , " . IntranetModulesModel::TABLENAME . " , " . FtaActionRoleModel::TABLENAME
                                . " , " . FtaSuiviProjetModel::TABLENAME . " , " . FtaModel::TABLENAME
                                . " WHERE " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                                . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                                . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                                . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                                . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE . "=$paramRole" // Nous recuperons le type de role pour l'utilisateur
                                . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
                                . "=" . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME
                                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . " =" . $id_user
                                . " AND " . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=1"
                                . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0)"
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "=0" // On recherche les Fta non Validé
                                . " AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='" . $paramEtat
                                . "' AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                );

                if ($arrayTmp) {
                    foreach ($arrayTmp as $rows) {
                        $tauxDeValidadation = FtaProcessusModel::getNonValideIdFtaByRoleWorkflowProcessus($rows[FtaModel::KEYNAME], $paramRole, $rows[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW]);
                        if ($tauxDeValidadation == 1) {
                            $idFtaEffectue[] = $rows[FtaModel::KEYNAME];
                        }
                    }
                }
                $req = "SELECT DISTINCT " . FtaModel::KEYNAME . " FROM fta WHERE ( 0 ";

                $req .= FtaModel::AddIdFTaValidProcess($idFtaEffectue);

                $req .= ")";

                $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);



                break;


            case "encours":

                //Récupération des suivis de projet gérés par l'utilisateur et non validé


                $arrayTmp = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT DISTINCT " . FtaModel::KEYNAME . "," . FtaProcessusModel::KEYNAME
                                . " FROM " . FtaSuiviProjetModel::TABLENAME . ", " . FtaWorkflowStructureModel::TABLENAME
                                . ", " . FtaProcessusCycleModel::TABLENAME
                                . " WHERE " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . " in (SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                                . " FROM " . FtaProcessusCycleModel::TABLENAME . ", " . FtaProcessusModel::TABLENAME
                                . ", " . FtaWorkflowStructureModel::TABLENAME
                                . ", " . IntranetActionsModel::TABLENAME . ", " . IntranetDroitsAccesModel::TABLENAME . ", " . IntranetModulesModel::TABLENAME
                                . ", " . FtaActionRoleModel::TABLENAME
                                . ", " . FtaSuiviProjetModel::TABLENAME . ", " . FtaModel::TABLENAME
                                . " WHERE " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                                . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                                . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                                . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                                . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE . "=$paramRole" // Nous recuperons le type de role pour l'utilisateur
                                . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
                                . "=" . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME
                                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $id_user // L'utilisateur connecté
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=1"
                                . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0)"
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "=0"
                                . " AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='" . $paramEtat
                                . "' AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                );
                if ($arrayTmp) {
                    foreach ($arrayTmp as $rows) {
                        $tauxDeValidadation = FtaProcessusModel::getFtaProcessusNonValidePrecedent($rows[FtaModel::KEYNAME], $rows[FtaProcessusModel::KEYNAME]);
                        if ($tauxDeValidadation == 1) {
                            $idFtaEffectue[] = $rows[FtaModel::KEYNAME];
                        }
                    }
                }
                $req = "SELECT DISTINCT " . FtaModel::KEYNAME . " FROM fta WHERE ( 0 ";

                $req .= FtaModel::AddIdFTaValidProcess($idFtaEffectue);

                $req .= ")";

                $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);


                break;



            case "correction":

                //Récupération de la liste fta pour le role concernés 

                $arrayTmp = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT DISTINCT " . FtaModel::KEYNAME . "," . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . " FROM " . FtaSuiviProjetModel::TABLENAME . ", " . FtaWorkflowStructureModel::TABLENAME
                                . ", " . FtaProcessusCycleModel::TABLENAME
                                . " WHERE " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . " in (SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                                . " FROM " . FtaProcessusCycleModel::TABLENAME . ", " . FtaProcessusModel::TABLENAME
                                 . ", " . FtaWorkflowStructureModel::TABLENAME
                                . ", " . IntranetActionsModel::TABLENAME . ", " . IntranetDroitsAccesModel::TABLENAME . ", " . IntranetModulesModel::TABLENAME
                                . ", " . FtaActionRoleModel::TABLENAME . ", " . FtaRoleModel::TABLENAME
                                . ", " . FtaSuiviProjetModel::TABLENAME . ", " . FtaModel::TABLENAME
                                . " WHERE " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                                . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                                . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                                . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                                . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME                       //  type de role pour l'utilisateur  peut etre plusieur ainsi il doit vedrifier le quel il choisit
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE . "=$paramRole" // Nous recuperons le type de role pour l'utilisateur 
                                . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES . "=" . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME
                                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $id_user // L'utilisateur connecté
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=1"
                                . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0)"
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0"
                                . " AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='" . $paramEtat
                                . "' AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                );

                /*
                 * On obtient les fta à vérifié dont tous les chapitres sont validés
                 */
                if ($arrayTmp) {
                    foreach ($arrayTmp as $rows) {
                        $tauxDeValidadation = FtaProcessusModel::getValideIdFtaByRoleWorkflowProcessus($rows[FtaModel::KEYNAME], $paramRole, $rows[FtaModel::FIELDNAME_WORKFLOW]);
                        if ($tauxDeValidadation == 1) {
                            $idFtaEffectue[] = $rows[FtaModel::KEYNAME];
                        }
                    }
                }
                $req = "SELECT DISTINCT " . FtaModel::KEYNAME . " FROM fta WHERE ( 0 ";

                $req .= FtaModel::AddIdFTaValidProcess($idFtaEffectue);

                $req .= ")";

                $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);


                break;


            case "all": //Toutes les fiches de l'état sélectionné

                $select = "SELECT DISTINCT " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME . " AS " . FtaModel::KEYNAME
                        . "," . FtaModel::FIELDNAME_DATE_DERNIERE_MAJ_FTA;
                $from = " FROM " . FtaProcessusModel::TABLENAME
                        . " , " . $from_common;
                $where = " WHERE 1 "     //Liaison
                        . $where_common
                        . $AND_where_Site_de_production
                ;
                $order = " ORDER BY $order_common ";
                $limit;

                $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                $select . $from . $where . $order . $limit
                );
                break;
        }

        return $array;
    }

}

?>
