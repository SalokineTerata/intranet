<?php

/**
 * Description of UserModel
 * Table des utilisateurs
 *
 * @author salokine
 */
class UserModel extends AbstractModel {

    const TABLENAME = 'salaries';
    const KEYNAME = 'id_user';
    const FIELDNAME_ACTIF = 'actif';
    const FIELDNAME_NOM = 'nom';
    const FIELDNAME_PRENOM = 'prenom';
    const FIELDNAME_ID_CATSOPRO = 'id_catsopro';
    const FIELDNAME_ID_SERVICE = 'id_service';
    const FIELDNAME_ID_TYPE = 'id_type';
    const FIELDNAME_LOGIN = 'login';
    const FIELDNAME_PASSWORD = 'pass';
    const FIELDNAME_MAIL = 'mail';
    const FIELDNAME_ECRITURE = 'ecriture';
    const FIELDNAME_MEMBRE_CE = 'membre_ce';
    const FIELDNAME_NEWSDEFIL = 'newsdefil';
    const FIELDNAME_BLOCAGE = 'blocage';
    const FIELDNAME_DATE_CREATION_SALARIES = 'date_creation_salaries';
    const FIELDNAME_ASENDANT_ID_SALARIES = 'ascendant_id_salaries';
    const FIELDNAME_PORTAIL_WIKI_SALARIES = 'portail_wiki_salaries';
    const FIELDNAME_LIEU_GEO = 'lieu_geo';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    public function getPrenomNom() {
        $prenom = $this->getDataField(UserModel::FIELDNAME_PRENOM)->getFieldValue();
        $nom = $this->getDataField(UserModel::FIELDNAME_NOM)->getFieldValue();
        $value = $prenom . ' ' . strtoupper($nom);
        return $value;
    }

    public function getLieuGeo() {
        return $this->getDataField(UserModel::FIELDNAME_LIEU_GEO)->getFieldValue();
    }

    /**
     * 
     * @param type $paramArrayIdFta
     * @param type $paramOrderBy
     * @return type
     */
    public static function getIdFtaByUserAndWorkflow($paramArrayIdFta, $paramOrderBy, $paramSytheseAction) {


        if ($paramArrayIdFta) {
            foreach ($paramArrayIdFta as $rowsArrayIdFta) {
                $idFta[] = $rowsArrayIdFta[FtaModel::KEYNAME];
            }

            $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT DISTINCT ' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME
                            . ', ' . FtaEtatModel::FIELDNAME_ABREVIATION . ', ' . FtaModel::FIELDNAME_LIBELLE
                            . ', ' . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW . ', ' . FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW
                            . ', ' . FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON . ', ' . FtaModel::FIELDNAME_POIDS_ELEMENTAIRE
                            . ', ' . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . ', ' . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE
                            . ', ' . FtaModel::FIELDNAME_DOSSIER_FTA . ', ' . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA
                            . ', ' . FtaModel::FIELDNAME_ARTICLE_AGROLOGIC . ', ' . FtaModel::FIELDNAME_CODE_ARTICLE_LDC
                            . ', ' . FtaModel::FIELDNAME_DATE_ECHEANCE_FTA . ', ' . FtaModel::FIELDNAME_CREATEUR
                            . ', ' . FtaModel::FIELDNAME_CLASSIFICATION_PROPRIETAIRE
                            . ', ' . FtaModel::FIELDNAME_SITE_ASSEMBLAGE . ', ' . FtaModel::TABLENAME . '. ' . FtaModel::FIELDNAME_WORKFLOW
                            . ' FROM ' . FtaModel::TABLENAME . ',' . UserModel::TABLENAME
                            . ', ' . FtaEtatModel::TABLENAME
                            . ', ' . FtaWorkflowModel::TABLENAME
                            . ' WHERE ( 0 ' . FtaModel::AddIdFTaValidProcess($idFta) . ')'
                            . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_CREATEUR
                            . '=' . UserModel::TABLENAME . '.' . UserModel::KEYNAME
                            . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_ID_FTA_ETAT
                            . '=' . FtaEtatModel::TABLENAME . '.' . FtaEtatModel::KEYNAME
                            . ' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::KEYNAME
                            . '=' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                            . ' ORDER BY ' . $paramOrderBy
                            . ',' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
                            . ',' . UserModel::FIELDNAME_PRENOM . ' ASC'
                            . ',' . FtaModel::FIELDNAME_DATE_ECHEANCE_FTA
            );

            return $array;
        }
    }

    /**
     * Suppression d'un salarié de l'intranet
     * @param type $paramIdSalaries
     */
    public static function suppressionIntranetUtilisateur($paramIdSalaries) {
        DatabaseOperation::execute(
                'DELETE FROM ' . ModesModel::TABLENAME
                . ' WHERE ' . ModesModel::FIELDNAME_ID_USER . '=' . $paramIdSalaries
        );
        DatabaseOperation::execute(
                'DELETE FROM ' . DroitftModel::TABLENAME
                . ' WHERE ' . DroitftModel::FIELDNAME_ID_USER . '=' . $paramIdSalaries
        );
        DatabaseOperation::execute(
                'DELETE FROM ' . UserModel::TABLENAME
                . ' WHERE ' . UserModel::KEYNAME . '=' . $paramIdSalaries
        );
        DatabaseOperation::execute(
                'DELETE FROM ' . IntranetDroitsAccesModel::TABLENAME
                . ' WHERE ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdSalaries
        );
        DatabaseOperation::execute(
                'DELETE FROM ' . LuModel::TABLENAME
                . ' WHERE ' . LuModel::FILEDNAME_ID_USER . '=' . $paramIdSalaries);
        DatabaseOperation::execute(
                'DELETE FROM ' . PlanningPresenceDetailModel::TABLENAME
                . ' WHERE ' . PlanningPresenceDetailModel::FILEDNAME_ID_USER . '=' . $paramIdSalaries);
        DatabaseOperation::execute(
                'DELETE FROM ' . PersoModel::TABLENAME
                . ' WHERE ' . PersoModel::KEYNAME . '=' . $paramIdSalaries);
    }

    /**
     * Verification du bon droits d'utilisateur pour les pages admin
     * @param type $paramTypePag
     * @param type $paramIdType
     */
    public static function securadmin($paramTypePag, $paramIdType) {
        if ($paramTypePag > $paramIdType) {
            header('Location: ../index.php?action=delog');
        }
        if (!$paramIdType) {
            header('Location: ../index.php?action=delog');
        }
    }
    /**
     * Liste des utilisateur à ajouter
     * @param array $paramIdUser
     * @return string
     */
    public static function AddIdUser($paramIdUser) {
        if ($paramIdUser) {
            foreach ($paramIdUser as $value) {
                $req .= ' OR ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME . '=' . $value . ' ';
            }
        }
        return $req;
    }

}

?>
