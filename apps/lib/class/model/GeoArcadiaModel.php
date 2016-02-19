<?php

/**
 * Description of GeoArcadiaModel
 * Table GeoArcadiaModel
 *
 * @author franckwastaken
 */
class GeoArcadiaModel extends AbstractModel {

    const TABLENAME = 'geo_arcadia';
    const KEYNAME = 'id_geo_arcadia';
    const FIELDNAME_ID_GEO = 'id_geo';
    const FIELDNAME_FILE_PREP = 'file_prep';
    const FIELDNAME_METHODE_PREP = 'methode_prep';

    protected function setDefaultValues() {
        
    }

}

?>