<?php

/**
 * Description of ClassificationArborescenceArticleCategorieModel
 * Table de classification arborescence des articles par categorie
 *
 * @author franckwastaken
 */
class ClassificationArborescenceArticleCategorieModel extends AbstractModel {

    const TABLENAME = 'classification_arborescence_article_categorie';
    const KEYNAME = 'id_classification_arborescence_article_categorie';
    const FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE = 'nom_classification_arborescence_article_categorie';
    const FIELDNAME_SUIVANT_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE = 'suivant_classification_arborescence_article_categorie';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}
