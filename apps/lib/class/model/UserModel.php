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

}

?>
