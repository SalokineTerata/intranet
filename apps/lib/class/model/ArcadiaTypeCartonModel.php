<?php

/**
 * Description of ArcadiaTypeCartonModel
 * Table ArcadiaTypeCartonModel
 *
 * @author franckwastaken
 */
class ArcadiaTypeCartonModel extends AbstractModel {

    const TABLENAME = 'arcadia_type_carton';
    const KEYNAME = 'id_arcadia_type_carton';
    const FIELDNAME_NOM_ARCADIA_TYPE_CARTON = 'nom_arcadia_type_carton';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}

?>