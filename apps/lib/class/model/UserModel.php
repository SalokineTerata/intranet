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

    public function getPrenomNom() {
        $prenom = $this->getDataField(UserModel::FIELDNAME_PRENOM)->getFieldValue();
        $nom = $this->getDataField(UserModel::FIELDNAME_NOM)->getFieldValue();
        $value = $prenom . " " . strtoupper($nom);
        return $value;
    }

    public function getIdConnectUser() {
        return $this->getKeyValue();
    }

    public function getLieuGeo() {
        $value = $this->getDataField(UserModel::FIELDNAME_LIEU_GEO)->getFieldValue();
        return $value;
    }

}

?>
