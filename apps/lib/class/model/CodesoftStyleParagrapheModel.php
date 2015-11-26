<?php

class CodesoftStyleParagrapheModel extends AbstractModel {

    const TABLENAME = 'codesoft_style_paragraphe';
    const KEYNAME = 'k_codesoft_style_paragraphe';
    const FIELDNAME_LIBELLE_CODESOFT_STYLE_PARAGRAPHE = 'libelle_codesoft_style_paragraphe';
    const FIELDNAME_VALEUR_CODESOFT_STYLE_PARAGRAPHE = 'valeur_codesoft_style_paragraphe';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}
