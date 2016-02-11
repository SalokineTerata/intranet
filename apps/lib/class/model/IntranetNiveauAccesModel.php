<?php

/**
 * Description of IntranetModulesModel
 * Table des utilisateurs
 *
 * @author tp4300001
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

    protected function setDefaultValues() {
        
    }

}
