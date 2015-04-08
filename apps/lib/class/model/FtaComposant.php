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
    const FIELDNAME_POIDS_UNITAIRE_CODIFICATION = "poids_fta_nomenclature";
    const FIELDNAME_SITE_PRODUCTION_FTA_CODIFICATION = "site_production_fta_nomenclature";
    
    
    /**
     * Site d'expedition de la FTA
     * @var GeoModel
     */
    
    private $modelSiteExpediton;
    
    
}

?>
