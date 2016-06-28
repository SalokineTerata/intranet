<?php
/**
 * Description of CodesoftEtiquettesModel
 * @author franckwastaken
 */
class CodesoftEtiquettesModel extends AbstractModel {

    const TABLENAME = 'codesoft_etiquettes';
    const KEYNAME = 'k_etiquette';
    const FIELDNAME_K_SITE = 'k_site';
    const FIELDNAME_K_TYPE_ETIQUETTE_CODESOFT_ETIQUETTES = 'k_type_etiquette_codesoft_etiquettes';
    const FIELDNAME_ETIQUETTE_NOM = 'etiq_nom';
    const FIELDNAME_ETIQUETTE_NOM_REQUETE = 'etiq_nom_requete';
    const FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES = 'designation_codesoft_etiquettes';
    const FIELDNAME_CONFIGURATION_MANUELLE_CODESOFT_ETIQUETTES = 'configuration_manuelle_codesoft_etiquettes';
    const FIELDNAME_AIDE_CONFIGURATION_MANUELLE_CODESOFT_ETIQUETTES = 'aide_configuration_manuelle_codesoft_etiquettes';
    const FIELDNAME_IS_ENABLED_FTA = 'is_enabled_fta';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

 

}
