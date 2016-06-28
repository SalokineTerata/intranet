<?php

/**
 * Description of FtaEtatHistoriqueModel
 * Table de l'historique des changements d'états des Fta 
 *
 * @author franckwastaken
 */
class FtaEtatHistoriqueModel extends AbstractModel {

    const TABLENAME = 'fta_etat_historique';
    const KEYNAME = 'id_fta_etat_historique';
    const FIELDNAME_ID_FTA = 'id_fta';
    const FIELDNAME_ID_DOSSIER_FTA = 'id_dossier_fta';
    const FIELDNAME_ID_DOSSIER_VERSION_FTA = 'id_version_dossier_fta';
    const FIELDNAME_ID_FTA_ETAT_INIT = 'id_fta_etat_init';
    const FIELDNAME_ID_FTA_ETAT_DEST = 'id_fta_etat_dest';
    const FIELDNAME_ID_USER = 'id_user';
    const FIELDNAME_STATE_CHANGE_DATE = 'state_change_date';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

    /**
     * Valeurs par défaut en cas de création
     * d'un nouvel enregistrement
     * @return mixed
     */
    static public function createNewRecordset($paramForeignKeysValuesArray = NULL) {


        $pdo = DatabaseOperation::executeComplete(
                        'INSERT INTO ' . self::TABLENAME
                        . '(' . self::FIELDNAME_ID_FTA . ')'
                        . 'VALUES (' . $paramForeignKeysValuesArray[self::FIELDNAME_ID_FTA] . ')'
        );
        $key = $pdo->lastInsertId();
        return $key;
    }

    /**
     * Historisation du changement d'état de la Fta
     * @param int $paramIdFta
     * @param int $paramIdFtaDossier
     * @param int $paramIdDossierVersion
     * @param int $paramInitEtat
     * @param int $paramDestEtat
     * @param int $paramIdUser
     * @param string $paramInitAbreviationFta
     */
    public static function setFtaEtatHistorique($paramIdFta, $paramIdFtaDossier,$paramIdDossierVersion, $paramInitEtat, $paramDestEtat, $paramIdUser, $paramInitAbreviationFta) {

        if ($paramInitAbreviationFta == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
            $idFtaEtatHistorique = self::createNewRecordset(
                            array(self::FIELDNAME_ID_FTA => $paramIdFta)
            );

            $ftaEtatHistoriqueModel = new FtaEtatHistoriqueModel($idFtaEtatHistorique);
            $ftaEtatHistoriqueModel->getDataField(self::FIELDNAME_ID_DOSSIER_FTA)->setFieldValue($paramIdFtaDossier);
            $ftaEtatHistoriqueModel->getDataField(self::FIELDNAME_ID_DOSSIER_VERSION_FTA)->setFieldValue($paramIdDossierVersion);
            $ftaEtatHistoriqueModel->getDataField(self::FIELDNAME_ID_FTA_ETAT_INIT)->setFieldValue($paramInitEtat);
            $ftaEtatHistoriqueModel->getDataField(self::FIELDNAME_ID_FTA_ETAT_DEST)->setFieldValue($paramDestEtat);
            $ftaEtatHistoriqueModel->getDataField(self::FIELDNAME_ID_USER)->setFieldValue($paramIdUser);
            $ftaEtatHistoriqueModel->getDataField(self::FIELDNAME_STATE_CHANGE_DATE)->setFieldValue(date("Y-m-d H:i:s"));
            $ftaEtatHistoriqueModel->saveToDatabase();
        }
    }

}
