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

    public static function getFtaProcessusNonValidePrecedent($paramIdFta, $paramProcessusEncours,$paramIdWorkflowEncours) {
        /*
         * Nombres total de processus précedent pour le processus en cours
         */
        $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . "," . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                        . " FROM " . FtaWorkflowStructureModel::TABLENAME . "," . FtaProcessusModel::TABLENAME
                        . "," . FtaProcessusCycleModel::TABLENAME
                        . " WHERE " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                        . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                        . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                        . "=" . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                        . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                        . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                        . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME . "=" . $paramProcessusEncours
                        . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW . "=" . $paramIdWorkflowEncours
        );

        $nombre_total_processus_precedent = count($array);
        if ($array) {
            /*
             * Vérifie si tous les processus précédent du processus en cours a des chapitres non validé
             */
            foreach ($array as $rows) {
                $tauxValidationProcessusEncours = 0;
                $tauxValidationProcessus += FtaProcessusModel::getValideProcessusEncours($paramIdFta, $rows[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT], $rows[FtaProcessusCycleModel::FIELDNAME_WORKFLOW]);
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

        $arrayProcessusTotal = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS . " FROM " . FtaWorkflowStructureModel::TABLENAME . "," . FtaProcessusModel::TABLENAME
                        . " WHERE " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                        . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME  //Jointure                
                        . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                        . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE  //Jointure                        
                        . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . "=" . $paramIdWorkflow
                        . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE . "=" . $paramIdRole
        );

        $nombreTotalProcessus = count($arrayProcessusTotal);


        $arrayProcessusValide = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS . " FROM " . FtaModel::TABLENAME . "," . FtaSuiviProjetModel::TABLENAME
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
        $nombreValideProcessus = count($arrayProcessusValide);

        //Calcul du taux de validation du processus
        $taux_validation_processus = 0;
        if ($nombreTotalProcessus != 0) {
            $taux_validation_processus = $nombreValideProcessus / $nombreTotalProcessus;
        }

        return $taux_validation_processus;
    }

    public static function getValideProcessusEncours($paramIdFta, $paramProcessusEncours, $paramIdWorkflow) {
        $arrayNombreTotalChapitre = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT " . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                        . " FROM " . FtaWorkflowStructureModel::TABLENAME . "," . FtaProcessusModel::TABLENAME
                        . " WHERE " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                        . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                        . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . "=" . $paramIdWorkflow              //Workflow en cours
                        . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME . "=" . $paramProcessusEncours
        );
        $nombreTotalChapitre = count($arrayNombreTotalChapitre);

        $arrayNombreTotalChapitreValide = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                        . " FROM " . FtaModel::TABLENAME . "," . FtaSuiviProjetModel::TABLENAME
                        . "," . FtaWorkflowStructureModel::TABLENAME . "," . FtaProcessusModel::TABLENAME
                        . " WHERE " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
                        . " = " . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA                        //Jointure
                        . " AND " . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE                        //Jointure
                        . "= " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                        . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                        . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME  //Jointure
                        . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . "=" . $paramIdWorkflow              //Workflow en cours
                        . " AND " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME . "= " . $paramIdFta                                  //FTA en cours
                        . " AND " . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0 "         //Chapitre validé
                        . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME . "=" . $paramProcessusEncours         //Processus en cours de balayage
        );
        if ($arrayNombreTotalChapitreValide) {
            $nombreChapitreValide = count($arrayNombreTotalChapitreValide);
        } else {
            $nombreChapitreValide = 0;
        }
        //Calcul du taux de validation du processus
        $taux_validation_processus = 0;
        if ($nombreTotalChapitre != 0) {
            $taux_validation_processus = $nombreChapitreValide / $nombreTotalChapitre;
        }
        $return = $taux_validation_processus;

        return $return;
    }

}

?>
