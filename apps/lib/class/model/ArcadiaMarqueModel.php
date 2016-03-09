<?php

/**
 * Description of ArcadiaMarqueModel
 * Table des ArcadiaMarqueModel
 *
 * @author franckwastaken
 */
class ArcadiaMarqueModel extends AbstractModel {

    const TABLENAME = 'arcadia_marque';
    const KEYNAME = 'id_arcadia_marque';
    const FIELDNAME_NOM_ARCADIA_MARQUE = 'nom_arcadia_marque';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}

?>