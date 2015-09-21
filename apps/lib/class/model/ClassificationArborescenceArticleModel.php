<?php

/**
 * Description of ClassificationArborescenceArticleModel
 * Table de classification arborescence des articles
 *
 * @author franckwastaken
 */
class ClassificationArborescenceArticleModel extends AbstractModel {

    const TABLENAME = 'classification_arborescence_article';
    const KEYNAME = 'id_classification_arborescence_article';
    const FIELDNAME_ASCENDANT_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU = 'ascendant_classification_arborescence_article_categorie_contenu';
    const FIELDNAME_FAMILLE_ARTICLE = 'FAMILLE_ARTICLE';
    const FIELDNAME_FAMILLE_MKTG = 'FAMILLE_MKTG';
    const FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU = 'id_classification_arborescence_article_categorie_contenu';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }
    
    

}
