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
         * Nombres total de processus précedent pour le processus en cours
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
         * Nombres total de processus suivant pour le processus en cours
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
                        "SELECT * FROM " . FtaWorkflowStructureModel::TABLENAME . "," . FtaProcessusModel::TABLENAME
                        . " WHERE " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                        . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME  //Jointure                
                        . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                        . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE  //Jointure                        
                        . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . "=" . $paramIdWorkflow
                        . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE . "=" . $paramIdRole
        );

        $nombreTotalProcessus = count($arrayChapitreTotal);

        $arrayChapitreValide = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT * FROM " . FtaModel::TABLENAME . "," . FtaSuiviProjetModel::TABLENAME
                        . "," . FtaWorkflowStructureModel::TABLENAME . "," . FtaProcessusModel::TABLENAME
                        . " WHERE " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
                        . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA            //Jointure
                        . " AND " . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                        . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE     //Jointure
                        . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                        . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS  //Jointure
                        . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . "=" . $paramIdWorkflow              //Workflow en cours
                        . " AND " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME . "=" . $paramIdFta                                    //FTA en cours
                        . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "=0 "         //Chapitre validé
                        . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE . "=" . $paramIdRole        //Processus en cours de balayage
        );
        $nombreValideProcessus = count($arrayChapitreValide);

        //Calcul du taux de validation du processus
        $taux_validation_processus = 0;
        if ($nombreTotalProcessus != 0) {
            $taux_validation_processus = $nombreValideProcessus / $nombreTotalProcessus;
        }

        return $taux_validation_processus;
    }

    public static function getValideIdFtaByRoleWorkflowProcessus($paramIdFta, $paramIdRole, $paramIdWorkflow) {

        $arrayChapitreTotal = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT * FROM " . FtaWorkflowStructureModel::TABLENAME . "," . FtaProcessusModel::TABLENAME
                        . " WHERE " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                        . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME  //Jointure                
                        . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                        . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE  //Jointure                        
                        . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . "=" . $paramIdWorkflow
                        . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE . "=" . $paramIdRole
        );

        $nombreTotalProcessus = count($arrayChapitreTotal);


        $arrayChapitreValide = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT * FROM " . FtaModel::TABLENAME . "," . FtaSuiviProjetModel::TABLENAME
                        . "," . FtaWorkflowStructureModel::TABLENAME . "," . FtaProcessusModel::TABLENAME
                        . " WHERE " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
                        . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA            //Jointure
                        . " AND " . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                        . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE     //Jointure
                        . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                        . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS  //Jointure
                        . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . "=" . $paramIdWorkflow              //Workflow en cours
                        . " AND " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME . "=" . $paramIdFta                                    //FTA en cours
                        . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0 "         //Chapitre validé
                        . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE . "=" . $paramIdRole        //Processus en cours de balayage
        );
        $nombreValideProcessus = count($arrayChapitreValide);

        //Calcul du taux de validation du processus
        $taux_validation_processus = 0;
        if ($nombreTotalProcessus != 0) {
            $taux_validation_processus = $nombreValideProcessus / $nombreTotalProcessus;
        }

        return $taux_validation_processus;
    }

}

?>
