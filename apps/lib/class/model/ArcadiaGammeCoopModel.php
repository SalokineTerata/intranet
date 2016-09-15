<?php

/**
 * Description of ArcadiaGammeCoopModel 
 * @author franckwastaken
 */
class ArcadiaGammeCoopModel extends AbstractModel {

    const TABLENAME = 'arcadia_gamme_coop';
    const KEYNAME = 'id_arcadia_gamme_coop';
    const FIELDNAME_NOM_ARCADIA_GAMME_COOP = 'nom_arcadia_gamme_coop';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}

?>