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
    const ID_CATEGORIE_ACTIVITE = '3';
    const ID_CATEGORIE_MARQUE = '2';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

    /**
     * Affiche la liste déroulante des elements d'arborescence d'une classification
     * @param type $paramIdClaasifElement
     * @param type $paramIsEditable
     * @return string
     */
    public static function getListeDeroulanteClassifElement($paramIdClaasifElement, $paramIsEditable) {
        //Contenu
        $nom_liste = self::KEYNAME;
        $reqListeActivite = "SELECT " . self::KEYNAME
                . ", " . self::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE
                . " FROM " . self::TABLENAME
                . " ORDER BY " . self::KEYNAME
        ;
        $id_defaut = $paramIdClaasifElement;

        $listeDesClassifElement = AccueilFta::afficherRequeteEnListeDeroulante($reqListeActivite, $id_defaut, $nom_liste, $paramIsEditable);

        return $listeDesClassifElement;
    }

}
