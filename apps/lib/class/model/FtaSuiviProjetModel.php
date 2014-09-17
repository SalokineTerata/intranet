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
     * Fta
     * @var FtaModel
     */
    private $modelFta;

    /**
     * Chapitre concerné par le suivi
     * @var FtaChapitreModel
     */
    private $modelFtaChapitre;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);

        //Tables filles
        $this->setModelFta(
                new FtaModel(
                $this->getDataField(self::FIELDNAME_ID_FTA)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST
                )
        );
        $this->setModelFtaChapitre(
                new FtaChapitreModel(
                $this->getDataField(self::FIELDNAME_ID_FTA_CHAPITRE)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST
                )
        );
    }

    static public function getIdFtaSuiviProjetByIdFtaAndIdChapitre($paramIdFta, $paramIdChapitre) {

        //Récupération du tableau de résultat
        $keyName = FtaSuiviProjetModel::KEYNAME;
        $tableName = FtaSuiviProjetModel::TABLENAME;
        $idFtaName = FtaSuiviProjetModel::FIELDNAME_ID_FTA;
        $idFtaChapitreName = FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE;
        $sql = "SELECT " . $keyName . " "
                . "FROM " . $tableName . " "
                . "WHERE " . $idFtaName . "=" . $paramIdFta . " "
                . "AND " . $idFtaChapitreName . "=" . $paramIdChapitre . " "
        ;
        $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($sql);

        //Retourne uniquement la première valeur
        return $array[0];
    }

    public function getModelFta() {
        return $this->modelFta;
    }

    public function getModelFtaChapitre() {
        return $this->modelFtaChapitre;
    }

    private function setModelFta(FtaModel $modelFta) {
        $this->modelFta = $modelFta;
    }

    private function setModelFtaChapitre(FtaChapitreModel $modelFtaChapitre) {
        $this->modelFtaChapitre = $modelFtaChapitre;
    }

}
