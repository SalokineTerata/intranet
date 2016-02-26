<?php

/**
 * Description of GeoArcadiaModel
 * Table GeoArcadiaModel
 *
 * @author franckwastaken
 */
class GeoArcadiaModel extends AbstractModel {

    const TABLENAME = 'geo_arcadia';
    const KEYNAME = 'id_geo';
    const FIELDNAME_FILE_PREP = 'file_prep';
    const FIELDNAME_METHODE_PREP = 'methode_prep';
    const FIELDNAME_CODE_POSTE_ARCADIA = 'code_poste_arcadia';
    const CODE_TYPE_PRODUIT_PLATEFORME = '50';
    const CODE_TYPE_PRODUIT_PLB_AGIS = '3';
    const CODE_TYPE_PRODUIT_PLB_MARIE_TDA = '2';
    const CODE_ATELIER = '1';

     public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
        
     }
    
    
    protected function setDefaultValues() {
        
    }

}

?>