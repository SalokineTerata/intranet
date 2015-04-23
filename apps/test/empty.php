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