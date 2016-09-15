<?php

/**
 * Description of ArcadiaCelluleArticleModel 
 * @author franckwastaken
 */
class ArcadiaCelluleArticleModel extends AbstractModel {

    const TABLENAME = 'arcadia_cellule_article';
    const KEYNAME = 'id_arcadia_cellule_article';
    const FIELDNAME_NOM_ARCADIA_CELLULE_ARTICLE = 'nom_arcadia_cellule_article';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}

?>