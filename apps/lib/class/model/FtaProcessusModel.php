<?php

/**
 * Description of UserModel
 * Table des utilisateurs
 *
 * @author salokine
 */
class FtaProcessusModel extends AbstractModel {

    const TABLENAME = "fta_processus";
    const KEYNAME = "id_fta_processus";
    const FIELDNAME_NOM = "nom_fta_processus";
    const FIELDNAME_DELAI = "delai_fta_processus";
    const FIELDNAME_INFO_CHEF_PROJET = "information_service_chef_projet_fta_processus";
    const FIELDNAME_SERVICE = "service_fta_processus";
    const FIELDNAME_ID_FTA_ROLE = "id_fta_role";
    const FIELDNAME_MULTISITE_FTA_PROCESSUS = "multisite_fta_processus";
    const PROCESSUS_PUBLIC = 0;

    public static function getFtaProcessusNonValidePrecedent($paramIdFta, $paramProcessusEncours) {
        /*
         * Nombres total de processus précedent pour le chapitre en cours
         */
        $req = "SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                . " FROM " . FtaWorkflowStructureModel::TABLENAME . "," . FtaProcessusModel::TABLENAME
                . "," . FtaProcessusCycleModel::TABLENAME
                . " WHERE " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                . "=" . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME . "=" . $paramProcessusEncours;
        $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);

        $nombre_total_processus_precedent = DatabaseOperation::getSqlNumRows(DatabaseOperation::query($req));
        if ($array) {
            /*
             * Vérifie si tous les processus précédent du processus en cours a des chapitres non validé
             */
            foreach ($array as $rows) {
                $tauxValidationProcessusEncours = 0;
                $tauxValidationProcessus += fta_processus_validation($paramIdFta, $rows[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT]);
                if ($tauxValidationProcessus != 0) {
                    $tauxValidationProcessusEncours = $tauxValidationProcessus / $nombre_total_processus_precedent;
                }
            }
        }
        $return = $tauxValidationProcessusEncours;

        return $return;
    }

    public static function getFtaProcessusNonValideSuivant($paramIdFta, $paramProcessusEncours) {
        /*
         * Nombres total de processus précedent pour le chapitre en cours
         */
        $req = "SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                . " FROM " . FtaWorkflowStructureModel::TABLENAME . "," . FtaProcessusModel::TABLENAME
                . "," . FtaProcessusCycleModel::TABLENAME
                . " WHERE " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                . "=" . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME . "=" . $paramProcessusEncours;
        $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);

        $nombre_total_processus_precedent = DatabaseOperation::getSqlNumRows(DatabaseOperation::query($req));
        if ($array) {
            /*
             * Vérifie si tous les processus précédent du processus en cours a des chapitres non validé
             */
            foreach ($array as $rows) {
                $tauxValidationProcessusEncours = 0;
                $tauxValidationProcessus += fta_processus_validation($paramIdFta, $rows[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT]);
                if ($tauxValidationProcessus != 0) {
                    $tauxValidationProcessusEncours = $tauxValidationProcessus / $nombre_total_processus_precedent;
                }
            }
        }
        $return = $tauxValidationProcessusEncours;

        return $return;
    }

    public static function getNonValideIdFtaByRoleWorkflowProcessus($paramIdFta, $paramIdRole, $paramIdWorkflow) {

        $arrayChapitreTotal = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT * FROM fta_workflow_structure, fta_processus "
                        . "WHERE fta_workflow_structure.id_fta_processus=fta_processus.id_fta_processus "  //Jointure
                        . " AND fta_workflow_structure.id_fta_role=fta_processus.id_fta_role "
                        . " AND fta_workflow_structure.id_fta_workflow=" . $paramIdWorkflow
                        . " AND fta_processus.id_fta_role=" . $paramIdRole
        );

        $nombre_total_chapitre_processus = count($arrayChapitreTotal);

        $arrayChapitreValide = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT * FROM fta, fta_suivi_projet, fta_workflow_structure, fta_processus "
                        . " WHERE fta.id_fta=fta_suivi_projet.id_fta "                          //Jointure
                        . " AND fta_suivi_projet.id_fta_chapitre=fta_workflow_structure.id_fta_chapitre " //Jointure
                        . " AND fta_workflow_structure.id_fta_processus=fta_processus.id_fta_processus "  //Jointure
                        . " AND fta_workflow_structure.id_fta_workflow=" . $paramIdWorkflow              //Workflow en cours
                        . " AND fta.id_fta=" . $paramIdFta . " "                                        //FTA en cours
                        . " AND fta_suivi_projet.signature_validation_suivi_projet=0 "         //Chapitre validé
                        . " AND fta_processus.id_fta_role=" . $paramIdRole        //Processus en cours de balayage
        );
        $nombre_valide_chapitre_processus = count($arrayChapitreValide);

        //Calcul du taux de validation du processus
        $taux_validation_processus = 0;
        if ($nombre_total_chapitre_processus != 0) {
            $taux_validation_processus = $nombre_valide_chapitre_processus / $nombre_total_chapitre_processus;
        }

        return $taux_validation_processus;
    }

}

?>
