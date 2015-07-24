<?php

/**
 * Description of ClassificationArborescenceArticleCategorieContenuModel
 * Table de classification arborescence des articles par categorie
 *
 * @author franckwastaken
 */
class ClassificationArborescenceArticleCategorieContenuModel extends AbstractModel {

    const TABLENAME = "classification_arborescence_article_categorie_contenu";
    const KEYNAME = "id_classification_arborescence_article_categorie_contenu";
    const FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU = "id_classification_arborescence_article_categorie";
    const FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU = "nom_classification_arborescence_article_categorie_contenu";

    public static function getElementClassificationFta($paramIdClassif) {
        $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT " . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU
                        . " FROM " . ClassificationArborescenceArticleCategorieContenuModel::TABLENAME
                        . " WHERE " . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME . "=" . $paramIdClassif
        );
        if ($array) {
            foreach ($array as $rows) {
                $value = $rows[ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU];
            }
        }
        return $value;
    }

}
