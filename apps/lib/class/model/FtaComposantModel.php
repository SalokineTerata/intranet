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
    const FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE = "code_produit_agrologic_fta_nomenclature";
    const FIELDNAME_DESIGNATION_CODIFICATION = "nom_fta_nomenclature";
    const FIELDNAME_ENVIRONNEMENT_DE_CONSERVATION_CODIFICATION = "poids_fta_nomenclature";
    const FIELDNAME_ETAT_FTA_CODIFICATION = "etat_fta_nomenclature";
    const FIELDNAME_ETIQUETTE = "etiquette_fta_composition";
    const FIELDNAME_ETIQUETTE_LIBELLE_FTA_COMPOSITION = "etiquette_libelle_fta_composition";
    const FIELDNAME_ETIQUETTE_POIDS_FTA_COMPOSITION = "etiquette_poids_fta_composition";
    const FIELDNAME_ID_ANNEXE_AGRO_ART_CODIFICATION = "id_annexe_agrologic_article_codification";
    const FIELDNAME_ID_ANNEXE_UNITE = "id_annexe_unite";
    const FIELDNAME_ID_CODIFICATION = "id_fta_nomenclature";
    const FIELDNAME_ID_FTA = "id_fta";
    const FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT = "is_composition_fta_composant";
    const FIELDNAME_POIDS_UNITAIRE_CODIFICATION = "poids_fta_nomenclature";
    const FIELDNAME_QUANTITE_FTA_COMPOSITION = "quantite_fta_composition";
    const FIELDNAME_SITE_PRODUCTION_FTA_CODIFICATION = "site_production_fta_nomenclature";
    
    
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

       //Calcul du poids de l'emballage  par UVC
    static function getCalculPoidsNetEmballageDuColis($paramPoidsEmballageUnitaire, $paramQuantiteCouche, $paramNombreCouche) {
        return $paramPoidsEmballageUnitaire * $paramQuantiteCouche * $paramNombreCouche;
    }

}

?>
