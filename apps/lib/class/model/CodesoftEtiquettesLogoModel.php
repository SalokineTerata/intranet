<?php

class CodesoftEtiquettesLogoModel extends AbstractModel {

    const TABLENAME = 'codesoft_etiquettes_logo';
    const KEYNAME = 'id';
    const FIELDNAME_LOGO_NAME = 'logo_name';
    const FIELDNAME_LOGO_LABEL = 'logo_label';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

}
