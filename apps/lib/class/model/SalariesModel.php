<?php

/**
 * Description of SalariesModel
 * Table des SalariesModel
 *
 * @author franckwastaken
 */
class SalariesModel extends AbstractModel {

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

    /*
     * ratée
     */

    //Utilisateur actuellement connecté
    public function getConnectUserId() {
        return $this->getDataField(SalariesModel::KEYNAME)->getFieldValue();
    }
    public function getLieuGeo() {
        return $this->getDataField(SalariesModel::FIELDNAME_LIEU_GEO)->getFieldValue();
    }

}
?>


