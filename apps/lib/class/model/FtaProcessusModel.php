<?php

/**
 * Description of UserModel
 * Table des utilisateurs
 *
 * @author salokine
 */
class FtaProcessusModel extends AbstractModel {

    const TABLENAME = 'fta_processus';
    const KEYNAME = 'id_fta_processus';
    const FIELDNAME_NOM = 'nom_fta_processus';
    const FIELDNAME_DELAI = 'delai_fta_processus';
    const FIELDNAME_INFO_CHEF_PROJET = 'information_service_chef_projet_fta_processus';
    const FIELDNAME_SERVICE = 'service_fta_processus';
    const FIELDNAME_ID_FTA_ROLE = 'id_fta_role';
    const FIELDNAME_MULTISITE_FTA_PROCESSUS = 'multisite_fta_processus';
    const PROCESSUS_PUBLIC = 0;

    /**
     * Selon le proccessus en cours nous verifions si les proceesus suivant sont validés
     * @param type $paramIdFta
     * @param type $paramProcessusEncours
     * @param type $paramIdWorkflowEncours
     * @return type
     */
    public static function getNonValideProcessusSuivant($paramIdFta, $paramProcessusEncours, $paramIdWorkflowEncours) {

        /*
         * Nombres total de processus suivant pour le processus en cours
         */
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT . ',' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                        . ' FROM ' . FtaProcessusCycleModel::TABLENAME
                        . ' WHERE ' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . '=' . $paramProcessusEncours
                        . ' AND ' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_WORKFLOW . '=' . $paramIdWorkflowEncours
        );

        $nombre_total_processus_precedent = count($array);
        if ($array) {
            $tauxValidationProcessus = 0;
            /*
             * Vérifie si tous les processus précédent du processus en cours a des chapitres non validé
             */
            foreach ($array as $rows) {
                $tauxValidationProcessusEncours = 0;
                $tauxValidationProcessus += FtaProcessusModel::getValideProcessusEncours($paramIdFta, $rows[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT], $rows[FtaProcessusCycleModel::FIELDNAME_WORKFLOW]);
                if ($tauxValidationProcessus != 0) {
                    $tauxValidationProcessusEncours = $tauxValidationProcessus / $nombre_total_processus_precedent;
                }
            }
        }
        $return = $tauxValidationProcessusEncours;

        return $return;
    }

    /**
     * 
     * @param type $paramIdFta
     * @param type $paramProcessusEncours
     * @param type $paramIdWorkflowEncours
     * @return type
     */
    public static function getFtaProcessusNonValidePrecedent($paramIdFta, $paramProcessusEncours, $paramIdWorkflowEncours) {
        /*
         * Nombres total de processus précedent pour le processus en cours
         */
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . ',' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                        . ' FROM ' . FtaProcessusCycleModel::TABLENAME
                        . ' WHERE ' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT . '=' . $paramProcessusEncours
                        . ' AND ' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_WORKFLOW . '=' . $paramIdWorkflowEncours
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

    /**
     * 
     * @param type $paramIdFta
     * @param type $paramIdRole
     * @param type $paramIdWorkflow
     * @return type
     */
    public static function getNonValideIdFtaByRoleWorkflowProcessus($paramIdFta, $paramIdRole, $paramIdWorkflow) {

        $arrayChapitreTotal = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                        . ' FROM ' . FtaWorkflowStructureModel::TABLENAME
                        . ' WHERE ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . $paramIdWorkflow
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE . '=' . $paramIdRole
        );

        $nombreTotalProcessus = count($arrayChapitreTotal);

        $arrayChapitreValide = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                        . ' FROM ' . FtaModel::TABLENAME . ',' . FtaSuiviProjetModel::TABLENAME
                        . ',' . FtaWorkflowStructureModel::TABLENAME
                        . ' WHERE ' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME
                        . '=' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA            //Jointure
                        . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                        . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE     //Jointure
                        . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                        . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW  //Jointure
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . $paramIdWorkflow              //Workflow en cours
                        . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME . '=' . $paramIdFta                                    //FTA en cours
                        . ' AND ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . '=0 '         //Chapitre validé
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE . '=' . $paramIdRole        //Processus en cours de balayage
        );
        $nombreValideProcessus = count($arrayChapitreValide);

        //Calcul du taux de validation du processus
        $taux_validation_processus = 0;
        if ($nombreTotalProcessus != 0) {
            $taux_validation_processus = $nombreValideProcessus / $nombreTotalProcessus;
        }

        return $taux_validation_processus;
    }

    /**
     * 
     * @param type $paramIdFta
     * @param type $paramIdRole
     * @param type $paramIdWorkflow
     * @return type
     */
    public static function getValideIdFtaByRoleWorkflowProcessus($paramIdFta, $paramIdRole, $paramIdWorkflow) {

        $arrayProcessusTotal = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                        . ' FROM ' . FtaWorkflowStructureModel::TABLENAME
                        . ' WHERE ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . $paramIdWorkflow
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE . '=' . $paramIdRole
        );

        $nombreTotalProcessus = count($arrayProcessusTotal);


        $arrayProcessusValide = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                        . ' FROM ' . FtaModel::TABLENAME . ',' . FtaSuiviProjetModel::TABLENAME
                        . ',' . FtaWorkflowStructureModel::TABLENAME
                        . ' WHERE ' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME
                        . '=' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA            //Jointure
                        . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                        . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE     //Jointure
                        . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                        . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW     //Jointure
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . $paramIdWorkflow              //Workflow en cours
                        . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME . '=' . $paramIdFta                                    //FTA en cours
                        . ' AND ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . '<>0 '         //Chapitre validé
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE . '=' . $paramIdRole        //Processus en cours de balayage
        );
        $nombreValideProcessus = count($arrayProcessusValide);

        //Calcul du taux de validation du processus
        $taux_validation_processus = 0;
        if ($nombreTotalProcessus != 0) {
            $taux_validation_processus = $nombreValideProcessus / $nombreTotalProcessus;
        }

        return $taux_validation_processus;
    }

    /**
     * Fonction informe de l'état de validation d'un processus sur une Fiche Technique Article
     * @param type $paramIdFta
     * @param type $paramProcessusEncours
     * @param type $paramIdWorkflow
     * @return type
     */
    public static function getValideProcessusEncours($paramIdFta, $paramProcessusEncours, $paramIdWorkflow) {
        $arrayNombreTotalChapitre = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                        . ' FROM ' . FtaWorkflowStructureModel::TABLENAME
                        . ' WHERE ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . $paramIdWorkflow              //Workflow en cours
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS . '=' . $paramProcessusEncours
        );
        $nombreTotalChapitre = count($arrayNombreTotalChapitre);

        $arrayNombreTotalChapitreValide = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT  DISTINCT ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                        . ' FROM ' . FtaModel::TABLENAME . ',' . FtaSuiviProjetModel::TABLENAME
                        . ',' . FtaWorkflowStructureModel::TABLENAME
                        . ' WHERE ' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME
                        . ' = ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA                        //Jointure
                        . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE                        //Jointure
                        . '= ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                        . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                        . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW     //Jointure
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . $paramIdWorkflow              //Workflow en cours
                        . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME . '= ' . $paramIdFta                                  //FTA en cours
                        . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . '<>0 '         //Chapitre validé
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS . '=' . $paramProcessusEncours         //Processus en cours de balayage
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

    /**
     * Il s'agit du controle des processus multisite,
     * les droits d'accès à cette Fta étatn controlé précédement je désactive la focntion
     * @param type $paramRows
     * @return type
     */
    public static function CheckProcessusMultiSite($paramRows) {

        //Ce processus en cours, est-il du type repartie ou centralisé ?
        $reqType = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS
                        . ' FROM ' . FtaProcessusModel::TABLENAME
                        . ' WHERE ' . FtaProcessusModel::KEYNAME
                        . '=' . $paramRows
        );

        foreach ($reqType as $rowsType) {
            $multisiteFtaProcessus = $rowsType[FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS];
        }
        return $multisiteFtaProcessus;
    }

    /**
     * Il s'agit du controle des processus multisite,
     * les droits d'accès à cette Fta étatn controlé précédement je désactive la focntion
     * Cette focntion est imcomplète, il manque la notion de controle des processus
     * @param type $paramRows
     * @param type $paramIdFta
     * @return int
     */
    public static function CheckProcessusSiteOrSociete($paramRows, $paramIdFta) {
        $globalconfig = new GlobalConfig();
        $idUser = $globalconfig->getAuthenticatedUser()->getKeyValue();
        $paramLieuGeo = $globalconfig->getAuthenticatedUser()->getLieuGeo();
//Existe-il une configuration de gestion forcée pour ce processus et ce site d'assemblage ?

        foreach ($paramRows as $rowsSiteSociete) {
            $arrayGestion = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                            . ' FROM ' . GeoModel::TABLENAME
                            . ',' . FtaModel::TABLENAME
                            . ',' . FtaActionSiteModel::TABLENAME
                            . ',' . IntranetActionsModel::TABLENAME
                            . ',' . FtaWorkflowStructureModel::TABLENAME
                            . ' WHERE ' . GeoModel::KEYNAME . '=' . FtaModel::FIELDNAME_SITE_ASSEMBLAGE
                            . ' AND ' . FtaActionSiteModel::FIELDNAME_ID_SITE . '=' . GeoModel::KEYNAME
                            . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                            . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                            . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
                            . '=' . IntranetModulesModel::TABLENAME . '.' . IntranetModulesModel::KEYNAME
                            . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . ' =' . $idUser
                            . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=1'
                            . ' AND ' . FtaActionSiteModel::TABLENAME . '.' . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                            . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                            . ' AND ' . FtaActionSiteModel::TABLENAME . '.' . FtaActionSiteModel::FIELDNAME_ID_SITE . '=' . $paramLieuGeo // Nous recuperons la localisation de l'utilisateur
                            . ' AND ' . FtaModel::KEYNAME . '=' . $paramIdFta
            );

            if ($arrayGestion) {
                foreach ($arrayGestion as $rowsGestion) {
                    $id_geo = $rowsGestion[FtaProcessusMultisiteModel::FIELDNAME_ID_SITE_PROCESSUS_FTA_PROCESSUS_MULTISITE];
                }

                if ($id_geo == $paramLieuGeo) {
                    //L'égalité est respecté, donc ce processus est bien en cours
                    $paramT_Processus_Encours = $paramRows;
                } else {
                    $paramT_Processus_Encours = 0;
                }
            }
        }
        return $paramT_Processus_Encours;
    }

}

?>
