<?php

/**
 * Description of AnnexeUniteFacturationModel 
 * Table gérant les données d'untité de facturation et 
 * les données d'arcadia suivant le type d'unité
 * @author franckwastaken
 */
class AnnexeUniteFacturationModel extends AbstractModel {

    const TABLENAME = 'annexe_unite_facturation';
    const KEYNAME = 'id_annexe_unite_facturation';
    const FIELDNAME_NOM_ANNEXE_UNITE_FACTURATION = 'nom_annexe_unite_facturation';
    const FIELDNAME_ID_ARCADIA_UNITE_FACTURATION = 'id_arcadia_unite_facturation';
    const FIELDNAME_ID_ARCADIA_METHODE_DE_PREPARATION = 'id_arcadia_methode_de_preparation';
    const FIELDNAME_ID_ARCADIA_TYPE_PREPA_ACQUISITION = 'id_arcadia_type_prepa_acquisition';
    const ID_KG_POIDS_VARIABLE = '4';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}
