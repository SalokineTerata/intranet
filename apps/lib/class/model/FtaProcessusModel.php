<?php

/**
 * Description of UserModel
 * Table des utilisateurs
 *
 * @author salokine
 */
class FtaProcessusModel extends AbstractModel {

    const TABLENAME = "fta_processus";
    const KEYNAME = "id_fta_processus";
    const FIELDNAME_NOM = "nom_fta_processus";
    const FIELDNAME_DELAI = "delai_fta_processus";
    const FIELDNAME_INFO_CHEF_PROJET = "information_service_chef_projet_fta_processus";
    const FIELDNAME_SERVICE = "service_fta_processus";
    const FIELDNAME_ID_FTA_ROLE = "id_fta_role";
    const FIELDNAME_MULTISITE_FTA_PROCESSUS = "multisite_fta_processus";
    const PROCESSUS_PUBLIC = 0;

}

?>
