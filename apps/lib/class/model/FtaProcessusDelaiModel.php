<?php

/**
 * Description of UserModel
 * Table des utilisateurs
 *
 * @author salokine
 */
class FtaProcessusDelaiModel extends AbstractModel {

    const TABLENAME = "fta_processus_delai";
    const KEYNAME = "id_fta_processus_delai";
    const FIELDNAME_ID_FTA = "id_fta";
    const FIELDNAME_ID_FTA_PROCESSUS = "id_fta_processus";
    const FIELDNAME_DATE_ECHEANCE_PROCESSUS = "date_echeance_processus";
    const FIELDNAME_VALIDE = "valide_fta_processus_delai";

    /**
     * FTA associée
     * @var FtaModel
     */
    private $modelFta;

    /**
     * Processus associée
     * @var FtaProcessusModel
     */
    private $modelFtaProcessus;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);

        $this->setModelFtaById($this->getDataField(self::FIELDNAME_ID_FTA)->getFieldValue());
        $this->setModelFtaProcessusById($this->getDataField(self::FIELDNAME_ID_FTA_PROCESSUS)->getFieldValue());
    }

    /**
     * Retourne la FTA
     * @return FtaModel
     */
    public function getModelFta() {
        return $this->modelFta;
    }

    /**
     * Retourne le processus
     * @return FtaProcessusModel
     */
    public function getModelFtaProcessus() {
        return $this->modelFtaProcessus;
    }

    /**
     * Défini la FTA
     * @param FtaModel 
     */
    private function setModelFta(FtaModel $modelFta) {
        $this->modelFta = $modelFta;
    }

    /**
     * Défini le Processus
     * @param FtaProcessusModel
     */
    private function setModelFtaProcessus(FtaProcessusModel $modelFtaProcessus) {
        $this->modelFtaProcessus = $modelFtaProcessus;
    }

    /**
     * Défini la FTA par son Id
     * @param mixed 
     */
    public function setModelFtaById($id) {
        $this->getDataField(self::FIELDNAME_ID_FTA)->setFieldValue($id);
        $this->setModelFta(
                new FtaModel($this->getDataField(self::FIELDNAME_ID_FTA)->getFieldValue(), DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
    }

    /**
     * Défini le Processus par son Id
     * @param mixed 
     */
    public function setModelFtaProcessusById($id) {
        $this->getDataField(self::FIELDNAME_ID_FTA_PROCESSUS)->setFieldValue($id);
        $this->setModelFtaProcessus(
                new FtaProcessusModel($this->getDataField(self::FIELDNAME_ID_FTA_PROCESSUS)->getFieldValue(), DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
    }

    public static function getFtaDelaiAvancement($paramIdFta) {
        /*         * *****************************************************************************
          Informe de l'état des délais et donc du respect des échéances

          Retour de fonction:
         * ******************
          $return["status"]
          0: Aucun dépassement des échéances
          1: Au moins un processus en cours a dépassé son échéance
          2: La date d'échéance de validation de la FTA est dépassée
          3: Il n'y a pas de date d'échéance de validation FTA saisie
          $return["liste_processus_depasses"][$id_processus]
          Renvoi un tableau associatif contenant:
          - la listes des processus en cours ayant dépassé leur échéance
          - leur date d'échéance
          $return["HTML_synthese"]
          Contient le code source HTML utilisé pour la fonction visualiser_fiches()

         * ***************************************************************************** */

        $return = NULL;
        $HTML_fta = "";                                                      //Partie HTML dédiée à la fta
        //  $HTML_processus = "";                                                //Partie HTML dédiée aux processus
        // $HTML_processus_begin = "<font size=\"1\" color=\"#808080\"><i>";    //Partie HTML dédiée aux processus (warning)
        // $HTML_processus_end = "</i></font>";                                 //Partie HTML dédiée aux processus (warning)
        /*
         * Liste des rôles non validés qui ont dépassé leur échéances 
         */
        $arrayFtaDateProcessus = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT " . FtaProcessusModel::KEYNAME
                        . ", " . FtaProcessusDelaiModel::FIELDNAME_DATE_ECHEANCE_PROCESSUS
                        . "," . FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE
                        . " FROM " . FtaProcessusDelaiModel::TABLENAME . ", " . FtaProcessusModel::TABLENAME . "," . FtaRoleModel::TABLENAME
                        . "WHERE " . FtaProcessusDelaiModel::FIELDNAME_ID_FTA . "='" . $paramIdFta . "' "
                        . "AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                        . "=" . FtaProcessusDelaiModel::TABLENAME . "." . FtaProcessusDelaiModel::FIELDNAME_ID_FTA_PROCESSUS
                        . "AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                        . "=" . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME
                        . " AND " . FtaProcessusDelaiModel::FIELDNAME_DATE_ECHEANCE_PROCESSUS . " < CURDATE()  k"
                        . " AND " . FtaProcessusDelaiModel::FIELDNAME_VALIDE . "=0  "
                        . "ORDER BY " . FtaProcessusDelaiModel::FIELDNAME_DATE_ECHEANCE_PROCESSUS
        );
        if ($arrayFtaDateProcessus) {
            $return["status"] = 1;
            /*  foreach ($arrayFtaDateProcessus as $rowsFtaDateProcessus) {
              $return["liste_processus_depasses"][$rows["id_fta_processus"]] = $rows["date_echeance_processus"];
              $HTML_processus .= "<br>" . $rows["nom_fta_processus"] . " - " . $return["liste_processus_depasses"][$rows["id_fta_processus"]];
              }
              $HTML_processus = $HTML_processus_begin . $HTML_processus . $HTML_processus_end; */
        } else {
            $return["status"] = 0;
//            $HTML_processus = "";
        }

        /*
         * Recherche du dépassement de la date d'échéance de validation de fta
         */
        $arrayIdFtaDate = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT " . FtaModel::FIELDNAME_DATE_ECHEANCE_FTA
                        . " FROM " . FtaModel::TABLENAME
                        . " WHERE " . FtaModel::KEYNAME . "='" . $paramIdFta . "' ");
        if ($arrayIdFtaDate) {

            foreach ($arrayIdFtaDate as $rowsIdFtaDate) {
                $dateEcheanceFta = $rowsIdFtaDate[FtaModel::FIELDNAME_DATE_ECHEANCE_FTA];
            }
            if ($dateEcheanceFta == "0000-00-00" or $dateEcheanceFta == "") {
                $return["status"] = 3;
            } else {
                if ($dateEcheanceFta < date("Y-m-d")) {
                    $return["status"] = 2;
                }
                $HTML_fta .= $dateEcheanceFta;
            }
        } else {
            $return["status"] = 3;
        }

        $return["HTML_synthese"] = $HTML_fta;
        return $return;
    }

}

?>
