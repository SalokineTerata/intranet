<?php

/**
 * Description of UserModel
 * Table des utilisateurs
 *
 * @author salokine
 */
class UserModel extends AbstractModel {

    const TABLENAME = "salaries";
    const KEYNAME = "id_user";
    const FIELDNAME_ACTIF = "actif";
    const FIELDNAME_NOM = "nom";
    const FIELDNAME_PRENOM = "prenom";
    const FIELDNAME_ID_SERVICE = "id_service";
    const FIELDNAME_LOGIN = "login";
    const FIELDNAME_PASSWORD = "pass";
    const FIELDNAME_MAIL = "mail";
    const FIELDNAME_DATE_CREATION_SALARIES = "date_creation_salaries";
    const FIELDNAME_ASENDANT_ID_SALARIES = "ascendant_id_salaries";
    const FIELDNAME_PORTAIL_WIKI_SALARIES = "portail_wiki_salaries";
    const FIELDNAME_LIEU_GEO = "lieu_geo";

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    public function getPrenomNom() {
        $prenom = $this->getDataField(UserModel::FIELDNAME_PRENOM)->getFieldValue();
        $nom = $this->getDataField(UserModel::FIELDNAME_NOM)->getFieldValue();
        $value = $prenom . " " . strtoupper($nom);
        return $value;
    }

    public function getLieuGeo() {
        return $this->getDataField(UserModel::FIELDNAME_LIEU_GEO)->getFieldValue();
    }

    public static function getIdFtaByUserAndWorkflow($paramArrayIdFta, $paramOrderBy) {


        if ($paramArrayIdFta) {
            foreach ($paramArrayIdFta as $rowsArrayIdFta) {
                $idFta[] = $rowsArrayIdFta[FtaModel::KEYNAME];
            }


            $req = "SELECT DISTINCT " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
                    . ", " . FtaEtatModel::FIELDNAME_ABREVIATION . ", " . FtaModel::FIELDNAME_LIBELLE
                    . ", " . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW . ", " . FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW
                    . ", " . FtaModel::FIELDNAME_PCB . ", " . FtaModel::FIELDNAME_POIDS_ELEMENTAIRE
                    . ", " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . ", " . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE
                    . ", " . FtaModel::FIELDNAME_DOSSIER_FTA . ", " . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA
                    . ", " . FtaModel::FIELDNAME_ARTICLE_AGROLOGIC . ", " . FtaModel::FIELDNAME_CODE_ARTICLE_LDC
                    . ", " . FtaModel::FIELDNAME_DATE_ECHEANCE_FTA . ", " . FtaModel::FIELDNAME_CREATEUR
                    . ", " . FtaModel::FIELDNAME_SITE_ASSEMBLAGE
                    . " FROM " . FtaModel::TABLENAME . "," . UserModel::TABLENAME
                    . ", " . FtaEtatModel::TABLENAME
                    . ", " . FtaWorkflowModel::TABLENAME
                    . " WHERE ( 0 ";

            $req .= FtaModel::AddIdFTaValidProcess($idFta);

            $req .= ")";

            $req .= " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_CREATEUR
                    . "=" . UserModel::TABLENAME . "." . UserModel::KEYNAME
                    . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT
                    . "=" . FtaEtatModel::TABLENAME . "." . FtaEtatModel::KEYNAME
                    . " AND " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                    . "=" . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                    . " ORDER BY ". FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                    . "," . FtaModel::FIELDNAME_DATE_ECHEANCE_FTA
                    . "," . UserModel::FIELDNAME_PRENOM . " ASC," . $paramOrderBy 
            ;


            $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);

            return $array;
        }
    }

}

?>
