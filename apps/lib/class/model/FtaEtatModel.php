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
    const ETAT_ABREVIATION_VALUE_ARCHIVE = "A";
    const ETAT_ABREVIATION_VALUE_MODIFICATION = "I";
    const ETAT_ABREVIATION_VALUE_PRESENTATION = "P";
    const ETAT_ABREVIATION_VALUE_RETIRE = "R";
    const ETAT_ABREVIATION_VALUE_VALIDE = "V";
    const ETAT_AVANCEMENT_VALUE_ALL = "all";
    const ETAT_AVANCEMENT_VALUE_ATTENTE = "attente";
    const ETAT_AVANCEMENT_VALUE_EFFECTUES = "correction";
    const ETAT_AVANCEMENT_VALUE_EN_COURS = "encours";

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

    public static function getIdFtaByEtatAvancement($paramSyntheseAction, $paramEtat, $paramRole, $paramIdUser, $paramLieuGeo) {

        switch ($paramSyntheseAction) {

            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ATTENTE:

                //Distinction entre le En cours et le En attente
                //Par rapport aux suivi de projets gérés, récupération des processus
                /*
                 * Marche pour tous les cas sauf qualité
                 * Nous recupérons les Fta en attente selon son rôle et workflow
                 */
                $arrayTmp = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT DISTINCT " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
                                . "," . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                                . " FROM " . FtaSuiviProjetModel::TABLENAME . "," . FtaWorkflowStructureModel::TABLENAME
                                . ", " . FtaProcessusCycleModel::TABLENAME . ", " . FtaModel::TABLENAME
                                . " , " . GeoModel::TABLENAME . " , " . FtaActionSiteModel::TABLENAME
                                . " , " . IntranetActionsModel::TABLENAME
                                . " WHERE " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . " in (SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                                . " FROM " . FtaProcessusCycleModel::TABLENAME . " , " . FtaProcessusModel::TABLENAME
                                . " , " . FtaWorkflowStructureModel::TABLENAME
                                . " , " . IntranetActionsModel::TABLENAME . " , " . IntranetDroitsAccesModel::TABLENAME
                                . " , " . IntranetModulesModel::TABLENAME . " , " . FtaActionRoleModel::TABLENAME
                                . " , " . FtaSuiviProjetModel::TABLENAME
                                . " WHERE " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                                . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                                . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                                . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                                . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE . "=$paramRole" // Nous recuperons le type de role pour l'utilisateur
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_WROKFLOW
                                . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
                                . "=" . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME
                                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . " =" . $paramIdUser
                                . " AND " . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=1"
                                . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0)"
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "=0" // On recherche les Fta non Validé
                                . " AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='" . $paramEtat
                                . "' AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . " AND " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                                . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . " AND " . FtaActionSiteModel::TABLENAME . "." . FtaActionSiteModel::FIELDNAME_ID_SITE . "=" . GeoModel::KEYNAME
                                . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . " AND " . FtaActionSiteModel::TABLENAME . "." . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . " AND " . FtaActionSiteModel::TABLENAME . "." . FtaActionSiteModel::FIELDNAME_ID_SITE . "=" . $paramLieuGeo // Nous recuperons la localisation de l'utilisateur
                                . " AND " . GeoModel::KEYNAME . "=" . FtaModel::FIELDNAME_SITE_ASSEMBLAGE
                );

                if ($arrayTmp) {
                    foreach ($arrayTmp as $rows) {
                        $tauxDeValidadation = FtaProcessusModel::getNonValideIdFtaByRoleWorkflowProcessus($rows[FtaModel::KEYNAME], $paramRole, $rows[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW]);
                        if ($tauxDeValidadation == 1) {
                            $idFtaEffectue[] = $rows[FtaModel::KEYNAME];
                        }
                    }
                }
                $req = "SELECT DISTINCT " . FtaModel::KEYNAME . " FROM " . FtaModel::TABLENAME . " WHERE ( 0 ";

                $req .= FtaModel::AddIdFTaValidProcess($idFtaEffectue);

                $req .= ")";


                $array[AccueilFta::VALUE_1] = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);

                $req = "SELECT DISTINCT " . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
                        . "," . FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW
                        . "," . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                        . " FROM " . FtaModel::TABLENAME . "," . FtaWorkflowModel::TABLENAME
                        . " WHERE ( 0 ";

                $req .= FtaModel::AddIdFTaValidProcess($idFtaEffectue);

                $req .= ")";

                $req .= " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                        . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME;

                $array[AccueilFta::VALUE_2] = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);

                break;


            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS:

                //Récupération des suivis de projet gérés par l'utilisateur et non validé


                $arrayTmp = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT DISTINCT " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
                                . "," . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . "," . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                                . " FROM " . FtaSuiviProjetModel::TABLENAME . ", " . FtaWorkflowStructureModel::TABLENAME
                                . ", " . FtaProcessusCycleModel::TABLENAME . ", " . FtaModel::TABLENAME
                                . " , " . GeoModel::TABLENAME . " , " . FtaActionSiteModel::TABLENAME
                                . " , " . IntranetActionsModel::TABLENAME
                                . " WHERE " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . " in (SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                                . " FROM " . FtaProcessusCycleModel::TABLENAME . ", " . FtaProcessusModel::TABLENAME
                                . ", " . FtaWorkflowStructureModel::TABLENAME
                                . ", " . IntranetActionsModel::TABLENAME . ", " . IntranetDroitsAccesModel::TABLENAME . ", " . IntranetModulesModel::TABLENAME
                                . ", " . FtaActionRoleModel::TABLENAME
                                . ", " . FtaSuiviProjetModel::TABLENAME
                                . " WHERE " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                                . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                                . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                                . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                                . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE . "=$paramRole" // Nous recuperons le type de role pour l'utilisateur
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_WROKFLOW
                                . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
                                . "=" . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME
                                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $paramIdUser // L'utilisateur connecté
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=1"
                                . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0)"
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "=0"
                                . " AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='" . $paramEtat
                                . "' AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . " AND " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                                . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . " AND " . FtaActionSiteModel::TABLENAME . "." . FtaActionSiteModel::FIELDNAME_ID_SITE . "=" . GeoModel::KEYNAME
                                . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . " AND " . FtaActionSiteModel::TABLENAME . "." . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . " AND " . FtaActionSiteModel::TABLENAME . "." . FtaActionSiteModel::FIELDNAME_ID_SITE . "=" . $paramLieuGeo // Nous recuperons la localisation de l'utilisateur
                                . " AND " . GeoModel::KEYNAME . "=" . FtaModel::FIELDNAME_SITE_ASSEMBLAGE
                );
                if ($arrayTmp) {
                    foreach ($arrayTmp as $rows) {
                        $tauxDeValidadation = FtaProcessusModel::getFtaProcessusNonValidePrecedent($rows[FtaModel::KEYNAME], $rows[FtaProcessusModel::KEYNAME], $rows[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW]);
                        if ($tauxDeValidadation == 1) {
                            $idFtaEffectue[] = $rows[FtaModel::KEYNAME];
                        }
                    }
                }
                $req = "SELECT DISTINCT " . FtaModel::KEYNAME . " FROM fta WHERE ( 0 ";

                $req .= FtaModel::AddIdFTaValidProcess($idFtaEffectue);

                $req .= ")";

                $array[AccueilFta::VALUE_1] = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);


                $req = "SELECT DISTINCT " . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
                        . "," . FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW
                        . "," . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                        . " FROM " . FtaModel::TABLENAME . "," . FtaWorkflowModel::TABLENAME
                        . " WHERE ( 0 ";

                $req .= FtaModel::AddIdFTaValidProcess($idFtaEffectue);

                $req .= ")";

                $req .= " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                        . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME;

                $array[AccueilFta::VALUE_2] = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);

                break;



            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES:

                //Récupération de la liste fta pour le role concernés 

                $arrayTmp = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT DISTINCT " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
                                . "," . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . "," . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                                . " FROM " . FtaSuiviProjetModel::TABLENAME . ", " . FtaWorkflowStructureModel::TABLENAME
                                . ", " . FtaProcessusCycleModel::TABLENAME . ", " . FtaModel::TABLENAME
                                . " , " . GeoModel::TABLENAME . " , " . FtaActionSiteModel::TABLENAME
                                . " , " . IntranetActionsModel::TABLENAME
                                . " WHERE " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . " in (SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                                . " FROM " . FtaProcessusCycleModel::TABLENAME . ", " . FtaProcessusModel::TABLENAME
                                . ", " . FtaWorkflowStructureModel::TABLENAME
                                . ", " . IntranetActionsModel::TABLENAME . ", " . IntranetDroitsAccesModel::TABLENAME . ", " . IntranetModulesModel::TABLENAME
                                . ", " . FtaActionRoleModel::TABLENAME . ", " . FtaRoleModel::TABLENAME
                                . ", " . FtaSuiviProjetModel::TABLENAME
                                . " WHERE " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                                . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                                . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                                . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                                . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME                       //  type de role pour l'utilisateur  peut etre plusieur ainsi il doit vedrifier le quel il choisit
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE . "=$paramRole" // Nous recuperons le type de role pour l'utilisateur 
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_WROKFLOW
                                . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
                                . "=" . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME
                                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $paramIdUser // L'utilisateur connecté
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=1"
                                . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0)"
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0"
                                . " AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='" . $paramEtat
                                . "' AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . " AND " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                                . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . " AND " . FtaActionSiteModel::TABLENAME . "." . FtaActionSiteModel::FIELDNAME_ID_SITE . "=" . GeoModel::KEYNAME
                                . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . " AND " . FtaActionSiteModel::TABLENAME . "." . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . " AND " . FtaActionSiteModel::TABLENAME . "." . FtaActionSiteModel::FIELDNAME_ID_SITE . "=" . $paramLieuGeo // Nous recuperons la localisation de l'utilisateur
                                . " AND " . GeoModel::KEYNAME . "=" . FtaModel::FIELDNAME_SITE_ASSEMBLAGE
                );

                /*
                 * On obtient les fta à vérifié dont tous les chapitres sont validés
                 */
                if ($arrayTmp) {
                    foreach ($arrayTmp as $rows) {
                        $tauxDeValidadation = FtaProcessusModel::getValideIdFtaByRoleWorkflowProcessus($rows[FtaModel::KEYNAME], $paramRole, $rows[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW]);
                        if ($tauxDeValidadation == 1) {
                            $idFtaEffectue[] = $rows[FtaModel::KEYNAME];
                        }
                    }
                }
                $req = "SELECT DISTINCT " . FtaModel::KEYNAME . " FROM " . FtaModel::TABLENAME . " WHERE ( 0 ";

                $req .= FtaModel::AddIdFTaValidProcess($idFtaEffectue);

                $req .= ")";

                $array[AccueilFta::VALUE_1] = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);

                $req = "SELECT DISTINCT " . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
                        . "," . FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW
                        . "," . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                        . " FROM " . FtaModel::TABLENAME . "," . FtaWorkflowModel::TABLENAME
                        . " WHERE ( 0 ";

                $req .= FtaModel::AddIdFTaValidProcess($idFtaEffectue);

                $req .= ")";

                $req .= " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                        . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME;

                $array[AccueilFta::VALUE_2] = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);


                break;


            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ALL: //Toutes les fiches de l'état sélectionné

                $array[AccueilFta::VALUE_1] = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT DISTINCT " . FtaModel::KEYNAME
                                . " FROM " . FtaModel::TABLENAME
                                . " WHERE " . FtaModel::FIELDNAME_ID_FTA_ETAT . "=" . $paramEtat   //Liaison
                );


                $array[AccueilFta::VALUE_2] = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT DISTINCT " . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
                                . "," . FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW
                                . "," . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                                . " FROM " . FtaModel::TABLENAME . "," . FtaWorkflowModel::TABLENAME
                                . " WHERE " . FtaModel::FIELDNAME_ID_FTA_ETAT . "=" . $paramEtat
                                . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                                . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME//Liaison
                );
                break;
        }

        return $array;
    }

    public static function getNameEtatByIdEtat($paramIdEtat) {
        $arrayIdEtat = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT " . FtaEtatModel::FIELDNAME_NOM_FTA_ETAT
                        . " FROM " . FtaEtatModel::TABLENAME
                        . " WHERE " . FtaEtatModel::KEYNAME . "=" . $paramIdEtat
        );


        return $arrayIdEtat[0][FtaEtatModel::FIELDNAME_NOM_FTA_ETAT];
    }

}

?>
