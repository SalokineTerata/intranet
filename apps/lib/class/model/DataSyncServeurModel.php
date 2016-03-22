<?php

/**
 * Description of DataSyncServeurModel
 * @author franckwastaken
 */
class DataSyncServeurModel extends AbstractModel {

    const TABLENAME = 'datasync_serveur';
    const KEYNAME = 'ip_datasync_serveur';
    const FIELDNAME_NOM_DATASYNC_SERVEUR = 'nom_datasync_serveur';
    const FIELDNAME_ACTIVE_DATASYNC_SERVEUR = 'active_datasync_serveur';
    const FIELDNAME_OS_SERVEUR_DATASYNC_SERVEUR = 'os_serveur_datasync_serveur';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}
