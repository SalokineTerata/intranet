<?php

/**
 * Description of ServicesModel
 * @author franckwastaken
 */
class ServicesModel extends AbstractModel {

    const TABLENAME = 'services';
    const KEYNAME = 'id_service';
    const FIELDNAME_INTITULE_SER = 'intitule_ser';
    const FIELDNAME_ID_GROUPE = 'id_groupe';
    const FIELDNAME_FAX_SERVICES = 'fax_services';

    protected function setDefaultValues() {
        
    }

}
