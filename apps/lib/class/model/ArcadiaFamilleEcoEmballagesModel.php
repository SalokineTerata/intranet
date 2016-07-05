<?php

/**
 * Description of ArcadiaFamilleEcoEmballagesModel 
 * @author franckwastaken
 */
class ArcadiaFamilleEcoEmballagesModel extends AbstractModel {

    const TABLENAME = 'arcadia_famille_eco_emballages';
    const KEYNAME = 'id_arcadia_famille_eco_emballages';
    const FIELDNAME_NOM_ARCADIA_MARQUE = 'nom_arcadia_famille_eco_emballages';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}

?>