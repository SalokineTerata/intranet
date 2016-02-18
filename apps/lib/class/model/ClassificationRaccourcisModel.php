<?php

/**
 * Description of ClassificationRaccourcisModel
 * Tables des raccourcis de classification 
 * @author tp4300001
 */
class ClassificationRaccourcisModel extends AbstractModel {

    const TABLENAME = 'classification_raccourcis';
    const KEYNAME = 'id_classification_raccourcis';
    const FIELDNAME_NOM_CLASSIFICATION_RACCOURCIS = 'nom_classification_raccourcis';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}
