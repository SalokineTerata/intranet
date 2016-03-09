<?php

/**
 * Description of ArcadiaSousFamilleModel
 * Table des ArcadiaSousFamilleModel
 *
 * @author franckwastaken
 */
class ArcadiaSousFamilleModel extends AbstractModel {

    const TABLENAME = 'arcadia_sous_famille';
    const KEYNAME = 'id_arcadia_sous_famille';
    const FIELDNAME_NOM_ARCADIA_SOUS_FAMILLE= 'nom_arcadia_sous_famille';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}

?>