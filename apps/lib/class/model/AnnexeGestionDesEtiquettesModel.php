<?php

class AnnexeGestionDesEtiquettesModel extends AbstractModel {

    const ACTIVATION_ETIQUETTE_COLIS = "1";
    const ACTIVATION_ETIQUETTE_COMPOSITION = "2";
    const ACTIVATION_ETIQUETTE_COLIS_ET_COMPOSITION = "3";
    const TABLENAME = 'annexe_gestion_des_etiquettes';
    const KEYNAME = 'id_annexe_gestion_des_etiquettes';
    const FIELDNAME_NOM_ANNEXE_GESTION_DES_ETIQUETTES = 'nom_annexe_gestion_des_etiquettes';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}
