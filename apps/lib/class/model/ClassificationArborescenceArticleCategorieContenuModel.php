<?php

/**
 * Description of ClassificationArborescenceArticleCategorieContenuModel
 * Table de classification arborescence des articles par categorie
 *
 * @author franckwastaken
 */
class ClassificationArborescenceArticleCategorieContenuModel extends AbstractModel {

    const TABLENAME = 'classification_arborescence_article_categorie_contenu';
    const KEYNAME = 'id_classification_arborescence_article_categorie_contenu';
    const FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE = 'id_classification_arborescence_article_categorie';
    const FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU = 'nom_classification_arborescence_article_categorie_contenu';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    public static function getElementClassificationFta($paramIdClassif, $paramSelect) {
        if ($paramIdClassif) {
            $classificationFta2 = new ClassificationFta2Model($paramIdClassif);
            $idType = $classificationFta2->getDataField($paramSelect)->getFieldValue();
            $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT ' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU
                            . ' FROM ' . ClassificationArborescenceArticleCategorieContenuModel::TABLENAME
                            . ' WHERE ' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME . '=' . addslashes($idType)
            );
            if ($array) {
                foreach ($array as $rows) {
                    $value = $rows[ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU];
                }
            }
        }
        return $value;
    }

}
