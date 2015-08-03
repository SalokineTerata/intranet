<?php

/**
 * Description of FtaEtatModel
 * Table des états d'une FTA
 *
 * @author franckwastaken
 */
class FtaComposantModel extends AbstractModel {

    const TABLENAME = "fta_composant";
    const KEYNAME = "id_fta_composant";
    const FIELDNAME_ASCENDANT_FTA_NOMENCLATURE = "ascendant_fta_nomenclature";
    const FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE = "code_produit_agrologic_fta_nomenclature";
    const FIELDNAME_DESIGNATION_CODIFICATION = "nom_fta_nomenclature";
    const FIELDNAME_DIN_FTA_NOMENCLATURE = "din_fta_nomenclature";
    const FIELDNAME_DUREE_VIE_TECHNIQUE_FTA_COMPOSITION = "duree_vie_technique_fta_composition";
    const FIELDNAME_ETAT_FTA_CODIFICATION = "etat_fta_nomenclature";
    const FIELDNAME_ETIQUETTE = "etiquette_fta_composition";
    const FIELDNAME_ETIQUETTE_DUREE_VIE_FTA_COMPOSITION = "etiquette_duree_vie_fta_composition";
    const FIELDNAME_ETIQUETTE_ID_FTA_COMPOSITION = "etiquette_id_fta_composition";
    const FIELDNAME_ETIQUETTE_LIBELLE_FTA_COMPOSITION = "etiquette_libelle_fta_composition";
    const FIELDNAME_ETIQUETTE_POIDS_FTA_COMPOSITION = "etiquette_poids_fta_composition";
    const FIELDNAME_ETIQUETTE_QUANTITE_FTA_COMPOSITION = "etiquette_quantite_fta_composition";
    const FIELDNAME_ETIQUETTE_SUPPLEMENTAIRE_FTA_COMPOSIITON = "etiquette_supplementaire_fta_composition";
    const FIELDNAME_ID_ACCESS_RECETTE_RECETTE = "id_access_recette_recette";
    const FIELDNAME_ID_ANNEXE_AGRO_ART_CODIFICATION = "id_annexe_agrologic_article_codification";
    const FIELDNAME_ID_ANNEXE_UNITE = "id_annexe_unite";
    const FIELDNAME_ID_CODIFICATION = "id_fta_nomenclature";
    const FIELDNAME_ID_FTA = "id_fta";
    const FIELDNAME_ID_FTA_COMPOSTION = "id_fta_composition";
    const FIELDNAME_ID_GEO = "id_geo";
    const FIELDNAME_INGREDIENT_FTA_COMPOSITION = "ingredient_fta_composition";
    const FIELDNAME_INGREDIENT_FTA_COMPOSITION1 = "ingredient_fta_composition1";
    const FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT = "is_composition_fta_composant";
    const FIELDNAME_IS_NOMENCLATURE_FTA_COMPOSANT = "is_nomenclature_fta_composant";
    const FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION = "k_etiquette_fta_composition";
    const FIELDNAME_K_STYLE_PARAGRAPHE_INGREDIENT_FTA_COMPOSITION = "k_style_paragraphe_ingredient_fta_composition";
    const FIELDNAME_LAST_ID_FTA_COMPOSANT = "last_id_fta_composant";
    const FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION = "mode_etiquette_fta_composition";
    const FIELDNAME_NOM_FTA_COMPOSITION = "nom_fta_composition";
    const FIELDNAME_ORDRE_FTA_COMPOSITION = "ordre_fta_composition";
    const FIELDNAME_POIDS_FTA_COMPOSITION = "poids_fta_composition";
    const FIELDNAME_POIDS_TOTAL_CARTON_VRAC_FTA_NOMENCLATURE = "poids_total_carton_vrac_fta_nomenclature";
    const FIELDNAME_POIDS_UNITAIRE_CODIFICATION = "poids_fta_nomenclature";
    const FIELDNAME_QUANTITE_FTA_COMPOSITION = "quantite_fta_composition";
    const FIELDNAME_QUANTITE_PIECE_PAR_CARTON = "quantite_piece_par_carton";
    const FIELDNAME_SITE_PRODUCTION_FTA_CODIFICATION = "site_production_fta_nomenclature";
    const FIELDNAME_SUFFIXE_AGROLOGIC_FTA_NOMENCLATURE = "suffixe_agrologic_fta_nomenclature";
    const FIELDNAME_TAILLE_POLICE_INGREDIENT_FTA_COMPOSITION = "taille_police_ingredient_fta_composition";
    const FIELDNAME_TAILLE_POLICE_NOM_FTA_COMPOSITION = "taille_police_nom_fta_composition";
    const FIELDNAME_VERSION = "_VERSION";

    /**
     * FTA associée
     * @var FtaModel
     */
    private $modelFta;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);

        $this->setModelFtaById($this->getDataField(self::FIELDNAME_ID_FTA)->getFieldValue());
    }

    public function setModelFtaById($id) {
        $this->getDataField(self::FIELDNAME_ID_FTA)->setFieldValue($id);
        $this->setModelFta(
                new FtaModel($this->getDataField(self::FIELDNAME_ID_FTA)->getFieldValue(), DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
    }

    function getModelFta() {
        return $this->modelFta;
    }

    function setModelFta(FtaModel $modelFta) {
        $this->modelFta = $modelFta;
    }

    /**
     * 
     * @param type $paramIdFta
     */
    public static function DuplicateFtaComposantByIdFta($paramIdFtaOrig, $paramIdFtaNew) {
        DatabaseOperation::query(
                " INSERT INTO " . FtaComposantModel::TABLENAME
                . " (" . FtaComposantModel::FIELDNAME_ASCENDANT_FTA_NOMENCLATURE
                . ", " . FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE
                . ", " . FtaComposantModel::FIELDNAME_DESIGNATION_CODIFICATION
                . ", " . FtaComposantModel::FIELDNAME_DIN_FTA_NOMENCLATURE
                . ", " . FtaComposantModel::FIELDNAME_DUREE_VIE_TECHNIQUE_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_ETAT_FTA_CODIFICATION
                . ", " . FtaComposantModel::FIELDNAME_ETIQUETTE
                . ", " . FtaComposantModel::FIELDNAME_ETIQUETTE_DUREE_VIE_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_ETIQUETTE_ID_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_ETIQUETTE_POIDS_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_ETIQUETTE_QUANTITE_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_ETIQUETTE_SUPPLEMENTAIRE_FTA_COMPOSIITON
                . ", " . FtaComposantModel::FIELDNAME_ID_ACCESS_RECETTE_RECETTE
                . ", " . FtaComposantModel::FIELDNAME_ID_ANNEXE_AGRO_ART_CODIFICATION
                . ", " . FtaComposantModel::FIELDNAME_ID_ANNEXE_UNITE
                . ", " . FtaComposantModel::FIELDNAME_ID_CODIFICATION
                . ", " . FtaComposantModel::FIELDNAME_ID_FTA_COMPOSTION
                . ", " . FtaComposantModel::FIELDNAME_ID_GEO
                . ", " . FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION1
                . ", " . FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT
                . ", " . FtaComposantModel::FIELDNAME_IS_NOMENCLATURE_FTA_COMPOSANT
                . ", " . FtaComposantModel::FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_K_STYLE_PARAGRAPHE_INGREDIENT_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_ORDRE_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_POIDS_TOTAL_CARTON_VRAC_FTA_NOMENCLATURE
                . ", " . FtaComposantModel::FIELDNAME_POIDS_UNITAIRE_CODIFICATION
                . ", " . FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_QUANTITE_PIECE_PAR_CARTON
                . ", " . FtaComposantModel::FIELDNAME_SITE_PRODUCTION_FTA_CODIFICATION
                . ", " . FtaComposantModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA_NOMENCLATURE
                . ", " . FtaComposantModel::FIELDNAME_TAILLE_POLICE_INGREDIENT_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_TAILLE_POLICE_NOM_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_VERSION
                . ", " . FtaComposantModel::FIELDNAME_LAST_ID_FTA_COMPOSANT
                . ", " . FtaComposantModel::FIELDNAME_ID_FTA . ")"
                . " SELECT " . FtaComposantModel::FIELDNAME_ASCENDANT_FTA_NOMENCLATURE
                . ", " . FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE
                . ", " . FtaComposantModel::FIELDNAME_DESIGNATION_CODIFICATION
                . ", " . FtaComposantModel::FIELDNAME_DIN_FTA_NOMENCLATURE
                . ", " . FtaComposantModel::FIELDNAME_DUREE_VIE_TECHNIQUE_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_ETAT_FTA_CODIFICATION
                . ", " . FtaComposantModel::FIELDNAME_ETIQUETTE
                . ", " . FtaComposantModel::FIELDNAME_ETIQUETTE_DUREE_VIE_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_ETIQUETTE_ID_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_ETIQUETTE_POIDS_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_ETIQUETTE_QUANTITE_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_ETIQUETTE_SUPPLEMENTAIRE_FTA_COMPOSIITON
                . ", " . FtaComposantModel::FIELDNAME_ID_ACCESS_RECETTE_RECETTE
                . ", " . FtaComposantModel::FIELDNAME_ID_ANNEXE_AGRO_ART_CODIFICATION
                . ", " . FtaComposantModel::FIELDNAME_ID_ANNEXE_UNITE
                . ", " . FtaComposantModel::FIELDNAME_ID_CODIFICATION
                . ", " . FtaComposantModel::FIELDNAME_ID_FTA_COMPOSTION
                . ", " . FtaComposantModel::FIELDNAME_ID_GEO
                . ", " . FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION1
                . ", " . FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT
                . ", " . FtaComposantModel::FIELDNAME_IS_NOMENCLATURE_FTA_COMPOSANT
                . ", " . FtaComposantModel::FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_K_STYLE_PARAGRAPHE_INGREDIENT_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_ORDRE_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_POIDS_TOTAL_CARTON_VRAC_FTA_NOMENCLATURE
                . ", " . FtaComposantModel::FIELDNAME_POIDS_UNITAIRE_CODIFICATION
                . ", " . FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_QUANTITE_PIECE_PAR_CARTON
                . ", " . FtaComposantModel::FIELDNAME_SITE_PRODUCTION_FTA_CODIFICATION
                . ", " . FtaComposantModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA_NOMENCLATURE
                . ", " . FtaComposantModel::FIELDNAME_TAILLE_POLICE_INGREDIENT_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_TAILLE_POLICE_NOM_FTA_COMPOSITION
                . ", " . FtaComposantModel::FIELDNAME_VERSION
                . ", " . FtaComposantModel::KEYNAME
                . ", " . $paramIdFtaNew
                . " FROM " . FtaComposantModel::TABLENAME
                . " WHERE " . FtaComposantModel::FIELDNAME_ID_FTA . "=" . $paramIdFtaOrig
        );
    }

}

?>
