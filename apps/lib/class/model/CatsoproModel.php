<?php

/**
 * Description of CatsoproModel
 * @author franckwastaken
 */
class CatsoproModel extends AbstractModel {

    const TABLENAME = 'catsopro';
    const KEYNAME = 'id_catsopro';
    const FIELDNAME_INTITULE_CAT = 'intitule_cat';
    const FIELDNAME_NIVO_GLO = 'nivo_glo';
    const FIELDNAME_NIVO_PRO = 'nivo_pro';

       public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }
}
