<?php

/**
 * Description of FtaVerrouillageChampsModel
 * Table des FtaVerrouillageChampsModel
 *
 * @author franckwastaken
 */
class FtaVerrouillageChampsModel extends AbstractModel {

    const TABLENAME = 'fta_verrouillage_champs';
    const KEYNAME = 'id_fta_verrouillage_champs	';
    const FIELDNAME_TABLE_NAME = 'table_name';
    const FIELDNAME_FIELD_NAME = 'field_name';
    const FIELDNAME_DOSSIER_FTA_PRIMAIRE = 'dossier_fta_primaire';
    const FIELDNAME_FIELD_LOCK = 'field_lock';
    const FIELDNAME_FIELD_CHANGE_STATE = 'field_change_state';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}

?>