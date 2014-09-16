<?php

/**
 * Description of FtaSuiviProjetModel
 * Table des FtaSuiviProjetModel
 *
 * @author salokine
 * @todo finir la table FtaSuiviProjet
 */
class FtaSuiviProjetModel extends AbstractModel {

    const TABLENAME = "fta_suivi_projet";
    const KEYNAME = "id_fta_suivi_projet";
    const FIELDNAME_ID_FTA = "id_fta";
    const FIELDNAME_ID_FTA_CHAPITRE = "id_fta_chapitre";
    const FIELDNAME_COMMENTAIRE_SUIVI_PROJET = "commentaire_suivi_projet";
    const FIELDNAME_DATE_VALIDATION_SUIVI_PROJET = "date_validation_suivi_projet";
    const FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET = "signature_validation_suivi_projet";
    const FIELDNAME_DATE_DEMARRAGE_CHAPITRE_FTA_SUIVI_PROJET = "date_demarrage_chapitre_fta_suivi_projet";
    const FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET = "notification_fta_suivi_projet";
    const FIELDNAME_CORRECTION_FTA_SUIVI_PROJET = "correction_fta_suivi_projet";

    /**
     * Processus initial
     * @var FtaProcessusModel
     */
    private $modelProcessusInit;

    /**
     * Processus suivant
     * @var FtaProcessusModel
     */
    private $modelProcessusNext;

    /**
     * Etat de la FTA
     * @var FtaEtatModel
     */
    private $modelFtaEtat;

    /**
     * Etat de la FTA
     * @var FtaCategorieModel
     */
    private $modelFtaCategorie;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);

        $this->setModelProcessusInit(
                new FtaProcessusModel(
                $this->getDataField(self::FIELDNAME_PROCESSUS_INIT)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST
                )
        );
        $this->setModelProcessusNext(
                new FtaProcessusModel(
                $this->getDataField(self::FIELDNAME_PROCESSUS_NEXT)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST
                )
        );
        $this->setModelFtaEtat(
                new FtaEtatModel(
                $this->getDataField(self::FIELDNAME_FTA_ETAT)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST
                )
        );
        $this->setModelFtaCategorie(
                new FtaCategorieModel(
                $this->getDataField(self::FIELDNAME_CATEGORIE)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST
                )
        );
    }

    public function getModelProcessusInit() {
        return $this->modelProcessusInit;
    }

    public function getModelProcessusNext() {
        return $this->modelProcessusNext;
    }

    public function getModelFtaEtat() {
        return $this->modelFtaEtat;
    }

    public function getModelFtaCategorie() {
        return $this->modelFtaCategorie;
    }

    private function setModelProcessusInit(FtaProcessusModel $modelProcessusInit) {
        $this->modelProcessusInit = $modelProcessusInit;
    }

    private function setModelProcessusNext(FtaProcessusModel $modelProcessusNext) {
        $this->modelProcessusNext = $modelProcessusNext;
    }

    private function setModelFtaEtat(FtaEtatModel $modelFtaEtat) {
        $this->modelFtaEtat = $modelFtaEtat;
    }

    private function setModelFtaCategorie(FtaCategorieModel $modelFtaCategorie) {
        $this->modelFtaCategorie = $modelFtaCategorie;
    }

}
