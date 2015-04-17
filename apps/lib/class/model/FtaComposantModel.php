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
    const FIELDNAME_DESIGNATION_CODIFICATION = "nom_fta_nomenclature";
    const FIELDNAME_ENVIRONNEMENT_DE_CONSERVATION_CODIFICATION = "poids_fta_nomenclature";
    const FIELDNAME_ETAT_FTA_CODIFICATION = "etat_fta_nomenclature";
    const FIELDNAME_ID_ANNEXE_AGRO_ART_CODIFICATION = "id_annexe_agrologic_article_codification";
    const FIELDNAME_ID_CODIFICATION = "id_fta_nomenclature";
    const FIELDNAME_ID_FTA = "id_fta";
    const FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT = "is_composition_fta_composant";
    const FIELDNAME_POIDS_UNITAIRE_CODIFICATION = "poids_fta_nomenclature";
    const FIELDNAME_QUANTITE_FTA_COMPOSITION = "quantite_fta_composition";
    const FIELDNAME_SITE_PRODUCTION_FTA_CODIFICATION = "site_production_fta_nomenclature";
    
    
    /**
     * Site d'expedition de la FTA
     * @var GeoModel
     */
    
    private $modelSiteExpediton;
    
    public function getArrayComposant() {

        //Les Calculs de la table composant        
        $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT " . FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION . "," . FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT . "," . FtaComposantModel::FIELDNAME_POIDS_UNITAIRE_CODIFICATION . " FROM " . FtaComposantModel::TABLENAME
                        . "WHERE " . FtaComposantModel::FIELDNAME_ID_FTA . "=" . FtaModel::KEYNAME
                        . " AND " . FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT . "=" . FtaModel::EMBALLAGES_UVC
        );

        foreach ($array as $rows) {

            //Calcul du Poids net par Palette
            $return[FtaModel::PALETTE_EMBALLAGE_NET] = $return[FtaModel::COLIS_EMBALLAGE_NET] * ($rows[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT] * $rows[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT]);

            // Calcul du Poids net du colis
            $return[FtaModel::COLIS_EMBALLAGE_NET] = $return[FtaModel::COLIS_EMBALLAGE_NET] + ($rows[FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION] * $rows[FtaComposantModel::FIELDNAME_POIDS_UNITAIRE_CODIFICATION]);
        }

        // Calcul du Poids net du colis
        $return[FtaModel::COLIS_EMBALLAGE_NET] = $return[FtaModel::COLIS_EMBALLAGE_NET] / 1000; //Conversion en g --> Kg
        if (!$return[FtaModel::COLIS_EMBALLAGE_NET]) {
            $return = "SELECT ". FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION . "," . FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT . "," . FtaComposantModel::FIELDNAME_POIDS_UNITAIRE_CODIFICATION . " FROM " . FtaComposantModel::TABLENAME . "WHERE " . FtaComposantModel::FIELDNAME_ID_FTA . "=" . FtaModel::KEYNAME . " AND " . FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT . "=" . FtaModel::EMBALLAGES_UVC;
            $return[FtaModel::COLIS_EMBALLAGE_NET] = $array[FtaModel::FIELDNAME_POIDS_ELEMENTAIRE] * $array[FtaModel::FIELDNAME_PCB];
        }
    }
    
    
    
}

?>
