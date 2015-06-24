public function getHtmlEcheancesProcessus() {
        if ($this->getModel()->getDataField(FtaModel::FIELDNAME_DATE_ECHEANCE_FTA)) {

            /**
             * Informations d'entrées
             * ----------------------
             */
            $paramSubFormModelClassName = "FtaProcessusDelaiModel";
            $tableNameRN = FtaProcessusDelaiModel::TABLENAME;
            $tableNameR1 = FtaModel::TABLENAME;
            $foreignKeyValue = $this->getModel()->getKeyValue();
            $arrayFieldsNameToDisplay = array(FtaProcessusDelaiModel::FIELDNAME_ID_FTA_PROCESSUS
                , FtaProcessusDelaiModel::FIELDNAME_DATE_ECHEANCE_PROCESSUS);
            $arrayFieldsNameToLock = array(FtaProcessusDelaiModel::FIELDNAME_ID_FTA_PROCESSUS);
            $arrayFieldsNameOrder = array(FtaProcessusDelaiModel::FIELDNAME_DATE_ECHEANCE_PROCESSUS);

            $isEditable = $this->getIsEditable();
            $rightToAdd = FALSE;
            $statusValidation = FALSE;

            $paramTitle = "Echéances des processus";

            $subFormDateEcheance = new DataFieldToHtmlSubform(
                    $paramSubFormModelClassName
                    , $paramTitle
                    , $tableNameRN
                    , $tableNameR1
                    , $foreignKeyValue
                    , $arrayFieldsNameToDisplay
                    , $arrayFieldsNameToLock
                    , $arrayFieldsNameOrder
                    , $isEditable
                    , $rightToAdd
                    , $statusValidation
            );
            $bloc = $subFormDateEcheance->getHtmlResult();
        }
        return $bloc;
    }
  <?php  
    
                //foreach ($req as $rowsProcessusEncours) {
            // $idFtaEncours = $rowsProcessusEncours[FtaProcessusModel::KEYNAME];
            $arrayProcessusVisible = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                            "SELECT DISTINCT " . FtaProcessusModel::TABLENAME
                            . ".* FROM " . FtaProcessusModel::TABLENAME
                            . ", " . FtaProcessusCycleModel::TABLENAME
                            . " WHERE " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                            . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                            . " AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='I'"
                            . " AND " . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                            . "='" . self::$id_fta_workflow . "' "
//                                . " AND " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
//                                . "='" . $idFtaEncours . "' "
//                );
//                            "SELECT DISTINCT " . FtaProcessusModel::TABLENAME
//                            . ".* FROM " . FtaProcessusModel::TABLENAME
//                            . ", " . FtaProcessusCycleModel::TABLENAME
//                            . " WHERE " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
//                            . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
//                            . " AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='I'"
//                            . " AND " . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
//                            . "='" . self::$id_fta_workflow . "' "
            );
            if ($req AND $arrayProcessusVisible) {
                //Balayage de tous les processus
                foreach ($arrayProcessusVisible as $rowsProcessusVisible) {
                    self::$id_fta_processus = $rowsProcessusVisible[FtaProcessusModel::KEYNAME];
                    $taux_validation_processus = fta_processus_validation(self::$id_fta, self::$id_fta_processus);
                    if ($taux_validation_processus == 1) {
                        //foreach ($req as $rowsProcessusEncours) {
                        //$idFtaEncours = $rowsProcessusEncours[FtaProcessusModel::KEYNAME];
                        /*
                         * Nous verifions si tous les processus précedents du chapitre que l'utilisateur à les droits d'accès
                         * sont validé et donc visible -- erreur pour le cas de codification les proceesus sontvisible dès qu'il sont valide
                         */
                        foreach ($req as $rowsProcessusEncours) {
                            $idFtaEncours = $rowsProcessusEncours[FtaProcessusModel::KEYNAME];
                            $arrayDonnees = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                            "SELECT id_init_fta_processus "
                                            . "FROM fta_processus_cycle "
                                            . "WHERE id_next_fta_processus = " . $idFtaEncours
                            );
                        }
//                            $idDonnees = $donnees[0];
//                            $idDonnees = $idDonnees[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT];
//                            $idDonnees1 = $donnees[1];
//                            $idDonnees1 = $idDonnees1[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT];
//                            $idDonnees2 = $donnees[2];
//                            $idDonnees2 = $idDonnees2[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT];
//                            $idDonnees3 = $donnees[3];
//                            $idDonnees3 = $idDonnees3[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT];
//                            if ($rowsProcessusVisible[FtaProcessusModel::KEYNAME] == $idDonnees
//                                    and $rowsProcessusVisible[FtaProcessusModel::KEYNAME] == $idDonnees1
//                                    and $rowsProcessusVisible[FtaProcessusModel::KEYNAME] == $idDonnees2
//                                    and $rowsProcessusVisible[FtaProcessusModel::KEYNAME] == $idDonnees3) {

                        if ($arrayProcessusVisible[FtaProcessusModel::KEYNAME] == $arrayDonnees[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT]) {
                            $t_processus_visible[] = $rowsProcessusVisible[FtaProcessusModel::KEYNAME];
                        }
                    }
                }
            }