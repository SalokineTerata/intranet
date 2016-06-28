<?php

/**
 * Description of IntranetModulesModel *
 * @author franckwastaken
 */
class IntranetModulesModel extends AbstractModel {

    const TABLENAME = 'intranet_modules';
    const KEYNAME = 'id_intranet_modules';
    const FIELDNAME_CLASSEMENT_INTRANET_MODULES = 'classement_intranet_modules';
    const FIELDNAME_NOM_INTRANET_MODULES = 'nom_intranet_modules';
    const FIELDNAME_NOM_USUEL_INTRANET_MODULES = 'nom_usuel_intranet_modules';
    const FIELDNAME_VERSION_INTRANET_MODULES = 'version_intranet_modules';
    const FIELDNAME_VISIBLE_INTRANET_MODULES = 'visible_intranet_modules';
    const FIELDNAME_PUBLIC_INTRANET_MODULES = 'public_intranet_modules';
    const FIELDNAME_CSS_INTRANET_MODULES = 'css_intranet_module';
    const FIELDNAME_ADMINISTRATION_MODULE = 'administration_module';
    const ADMINISTRATION_MODULE_TRUE = '1';
    const ADMINISTRATION_MODULE_FALSE = '0';
    const ID_MODULES_FTA = '19';

    protected function setDefaultValues() {
        
    }

}
