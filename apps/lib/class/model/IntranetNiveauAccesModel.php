<?php

/**
 * Description of IntranetNiveauAccesModel
 * @author franckwastaken
 */
class IntranetNiveauAccesModel extends AbstractModel {

    const TABLENAME = 'intranet_niveau_acces';
    const FIELDNAME_ID_INTRANET_MODULES = 'id_intranet_modules';
    const FIELDNAME_ID_INTRANET_ACTIONS = 'id_intranet_actions';
    const FIELDNAME_ID_INTRANET_NIVEAU_ACCES = 'id_intranet_niveau_acces';
    const FIELDNAME_NOM_INTRANET_NIVEAU_ACCES = 'nom_intranet_niveau_acces';
    const NIVEAU_GENERIC_FALSE = '0';
    const NIVEAU_GENERIC_TRUE = '1';
    const NIVEAU_FTA_DIFFUSION = '3';
    const NIVEAU_FTA_CONSULTATION = '1';
    const NIVEAU_FTA_MODIFICATION = '2';
    const NIVEAU_FTA_IMPRESSION = '7';
    const ACCES_MODULE_FTA_NON_VALUE = '0';
    const ACCES_MODULE_FTA_CONSULTATION_VALUE = '1';
    const ACCES_MODULE_FTA_MODIFICATION_VALUE = '2';
    const DIFFUSION_FTA_NON_VALUE = '0';
    const DIFFUSION_FTA_OUI_LIEU_RATTACHEMENT_VALUE = '1';
    const DIFFUSION_FTA_OUI_TOUT_VALUE = '2';

    protected function setDefaultValues() {
        
    }

}
