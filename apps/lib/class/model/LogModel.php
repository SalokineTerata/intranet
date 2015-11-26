<?php

/**
 * Description of LogModel
 * Table des log
 *
 * @author franckwastaken
 */
class LogModel extends AbstractModel {

    const TABLENAME = 'log';
    const KEYNAME = 'num_log';
    const FIELDNAME_CONTENT_LOG = 'content_log';
    const FIELDNAME_DATE = 'date';
    const FIELDNAME_ID_INTRANET_MODULES_LOG = 'id_intranet_modules_log';
    const FIELDNAME_ID_USER = 'id_user';
    const FIELDNAME_LECT_ART = 'lect_art';
    const FIELDNAME_REDAC_COM = 'redac_com';

    protected function setDefaultValues() {
        
    }

}
