<?php

/**
 * Description of ArcadiaFamilleVenteModel
 * Table des ArcadiaFamilleVenteModel
 *
 * @author franckwastaken
 */
class ArcadiaFamilleVenteModel extends AbstractModel {

    const TABLENAME = 'arcadia_famille_vente';
    const KEYNAME = 'id_arcadia_famille_vente';
    const FIELDNAME_NOM_ARCADIA_FAMILLE_VENTE= 'nom_arcadia_famille_vente';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}

?>