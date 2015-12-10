<?php

/**
 * Description of UserModel
 * Table des utilisateurs
 *
 * @author salokine
 */
class FtaProcessusDelaiModel extends AbstractModel {

    const TABLENAME = 'fta_processus_delai';
    const KEYNAME = 'id_fta_processus_delai';
    const FIELDNAME_ID_FTA = 'id_fta';
    const FIELDNAME_ID_FTA_PROCESSUS = 'id_fta_processus';
    const FIELDNAME_DATE_ECHEANCE_PROCESSUS = 'date_echeance_processus';
    const FIELDNAME_VALIDE = 'valide_fta_processus_delai';
    const KEYWORD_DELAI_AVANCEMENT_STATUS = "status";
    const KEYWORD_DELAI_AVANCEMENT_HTML_SYNTHESE = "HTML_synthese";
    const VALUE_DELAI_AVANCEMENT_OK = 0;
    const VALUE_DELAI_AVANCEMENT_ONE_PROCESSUS_EXPIRED = 1;
    const VALUE_DELAI_AVANCEMENT_ALL_FTA_EXPIRED = 2;
    const VALUE_DELAI_AVANCEMENT_NO_DATE = 3;

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

    protected function setDefaultValues() {
        
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

    public static function getFtaDelaiAvancementStatus($paramIdFta) {
        $return = getArraytFtaDelaiAvancement($paramIdFta);
        return $return[self::KEYWORD_DELAI_AVANCEMENT_STATUS];
    }

    /**
     * Informe de l'état des délais et donc du respect des échéances
     * Retour de fonction:
     * $return['status']
     * 0: Aucun dépassement des échéances
     * 1: Au moins un processus en cours a dépassé son échéance
     * 2: La date d'échéance de validation de la FTA est dépassée
     * 3: Il n'y a pas de date d'échéance de validation FTA saisie
     * $return['liste_processus_depasses'][$id_processus]
     * Renvoi un tableau associatif contenant:
     * - la listes des processus en cours ayant dépassé leur échéance
     * - leur date d'échéance
     * $return['HTML_synthese']
     * Contient le code source HTML utilisé pour la fonction visualiser_fiches()
     * @param type $paramIdFta
     * @return array
     */
    public static function getArraytFtaDelaiAvancement($paramIdFta) {

        $return = NULL;

        /*
         * Recherche du dépassement de la date d'échéance de validation de fta
         */
        $arrayIdFtaDate = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . FtaModel::FIELDNAME_DATE_ECHEANCE_FTA
                        . ' FROM ' . FtaModel::TABLENAME
                        . ' WHERE ' . FtaModel::KEYNAME . '=\'' . $paramIdFta . '\' ');
        if ($arrayIdFtaDate) {

            foreach ($arrayIdFtaDate as $rowsIdFtaDate) {
                $dateEcheanceFta = $rowsIdFtaDate[FtaModel::FIELDNAME_DATE_ECHEANCE_FTA];
                $jour_restant = ((strtotime($dateEcheanceFta) - strtotime(date('Y-m-d')))) / 86400;
            }
            /**
             * @todo Revoir les notifications de date d'échances
             */
            if ($dateEcheanceFta == '0000-00-00' or $dateEcheanceFta == '') {
                $return[self::KEYWORD_DELAI_AVANCEMENT_STATUS] = self::VALUE_DELAI_AVANCEMENT_NO_DATE;
            } else if (($jour_restant <= "0") OR ( $jour_restant <= ModuleConfig::VALUE_DATE_NOTIFICATION2)) {
                $return[self::KEYWORD_DELAI_AVANCEMENT_STATUS] = self::VALUE_DELAI_AVANCEMENT_ALL_FTA_EXPIRED;
            } else if ($jour_restant <= ModuleConfig::VALUE_DATE_NOTIFICATION) {
                $return[self::KEYWORD_DELAI_AVANCEMENT_STATUS] = self::VALUE_DELAI_AVANCEMENT_ONE_PROCESSUS_EXPIRED;
            }
            $return[self::KEYWORD_DELAI_AVANCEMENT_HTML_SYNTHESE] .= $dateEcheanceFta;
        } else {
            $return[self::KEYWORD_DELAI_AVANCEMENT_STATUS] = self::VALUE_DELAI_AVANCEMENT_NO_DATE;
        }

        return $return;
    }

    /**
     * Contrôle et corrige l'état de validation de l'échéance fixé à un processus
     * Si le processus à validé tous ses chapitre, le délai est validé
     * Sinon, le délai reste en attente de réalisation
     * Fonction n'est plus utilisé
     * Retour de la fonction:
     * 0: Rien n'a été fait car le processus ne dispose pas d'enregistrement d'échéance
     * 1: Mise à jour effecftuée
     * @param type $paramIdFta
     * @param type $paramIdFtaProcessus
     * @return int
     */
    public static function BuildFtaProcessusValidationDelai($paramIdFta, $paramIdFtaProcessus, $paramIdFtaWorkflow) {
        $valideFtaProcessusDelai = NULL;       //L'échéance est-elle validée ? (Oui=1, Non=0)
        $return = '0';
        $etatEcheance = FtaProcessusModel::getValideProcessusEncours($paramIdFta, $paramIdFtaProcessus, $paramIdFtaWorkflow);
        switch ($etatEcheance) {
            case 1: //Le processus à validé tous ses chapitres
                $valideFtaProcessusDelai = '1';
                break;
            default://Sinon, il reste encore des chapitres à valider
                $valideFtaProcessusDelai = '0';
        }

        //Existe-il déjà un enregistrement sur ce délai ?
        //Recherche d'enregistrement déjà existant pour mise à jour, sinon insertion
        $arrayProcessusDelai = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . FtaProcessusDelaiModel::KEYNAME . ', ' . FtaProcessusDelaiModel::FIELDNAME_VALIDE
                        . ' FROM ' . FtaProcessusDelaiModel::TABLENAME
                        . ' WHERE ' . FtaProcessusDelaiModel::FIELDNAME_ID_FTA . '=\'' . $paramIdFta
                        . '\' AND ' . FtaProcessusDelaiModel::FIELDNAME_ID_FTA_PROCESSUS . ' = \'' . $paramIdFtaProcessus . '\' '
        );

        if ($arrayProcessusDelai) {   //Si l'enregistrement existe, alors mise à jour des informations
            //Si l'état enregistré en différent de celui contrôlé, alors mise à jour
            foreach ($arrayProcessusDelai as $rowsProcessusDelai) {
                $valideFtaProcessusDelaiRecorded = $rowsProcessusDelai[FtaProcessusDelaiModel::FIELDNAME_VALIDE];
                if ($valideFtaProcessusDelai <> $valideFtaProcessusDelaiRecorded) {
                    //Récupération de l'identifiant pour permettre la mise à jour de celui-ci
                    $idFtaProcessusDelai = $rowsProcessusDelai[FtaProcessusDelaiModel::KEYNAME];
                    $req = 'UPDATE ' . FtaProcessusDelaiModel::TABLENAME
                            . 'SET ' . FtaProcessusDelaiModel::FIELDNAME_VALIDE . ' = \'' . $valideFtaProcessusDelai . '\' '
                            . 'WHERE ' . FtaProcessusDelaiModel::KEYNAME . ' =\'' . $idFtaProcessusDelai . '\' '
                    ;
                    DatabaseOperation::query($req);
                    $return = '1';
                }
            }
        }
        return $return;
    }

}

?>
