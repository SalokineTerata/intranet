<?php

class AnnexeModeEtiquetteModel extends AbstractModel {

    const TABLENAME = 'annexe_mode_etiquette';
    const KEYNAME = 'id_mode_etiquette';
    const FIELDNAME_MODE_ETIQUETTE_NOM = 'mode_etiquette_nom';
    const FIELDNAME_MODE_ETIQUETTE_LABEL = 'mode_etiquette_label';
    const FIELDNAME_ETIQUETTE_ACTIF = 'etiquette_actif';
    const PAS_DETIQUETTE = "-1";

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}
