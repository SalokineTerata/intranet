<?php

/**
 * Description of FtaSuiviProjetModel
 * Table des FtaSuiviProjetModel
 *
 * @author franwastaken
 */


class GeoModel extends AbstractModel {
    
    const TABLENAME = "geo";
    const KEYNAME = "id_geo";
    const FELDNAME_GEO = "geo";
    const FIELDNAME_LETTRE = "lettre";
    const FIELDNAME_ID_SITE_AGIS = "id_site_agis";
    const FIELDNAME_ID_SITE_GROUPE = "id_site_groupe";
    const FIELDNAME_LIBELLE_SITE_AGIS = "libelle_site_agis";
    const FIELDNAME_RACCOURCI_SITE_AGIS = "raccourci_site_agis";
    const FIELDNAME_SITE_ACTIF = "site_actif";
    const FIELDNAME_ADRESSE_GEO = "adresse_geo";
    const FIELDNAME_TELEPHONE_GEO = "telephone_geo";
    const FIELDNAME_FAX_GEO = "fax_geo";
    const FIELDNAME_FAX_COMMERCIAL_GEO = "fax_commercial_geo";
    const FIELDNAME_GEO_CNUD_PREPARER_PAR = "geo_cnud_preparer_par";
    const FIELDNAME_ID_SITE = "is_site";
    const FIELDNAME_ASSEMBLAGE = "assemblage";
    const FIELDNAME_SITE_CODE_EMBALLEUR = "site_code_emballeur";
    const FIELDNAME_SITE_AGREMENT_CE = "site_agrement_ce";
    const FIELDNAME_ID_IP_GEO = "id_ip_geo";
    const FIELDNAME_ORDRE_PLANNING_PRESENCE_GEO = "ordre_planning_presence_geo";
    const FIELDNAME_NOM_DNS_COMPLET = "nom_dns_complet";
    const FIELDNAME_K_SOCIETE= "k_societe";
    const FIELDNAME_TAG_APPLICATION_GEO = "tag_application_geo";

           /**
     * Model de donnée d'une FTA
     * @var FtaSiteExpModel
     */
    
    private $ModelSiteExp;
    
    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    
    $this->setModelSiteExp(
                new GeoModel($this->getDataField(self::FIELDNAME_ID_SITE)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
                );
    
    }    
    function getModelSiteExp() {
        return $this->modelSiteExp;
    }

    function setModelSiteExp(FtaSiteExpModel $modelSiteExp) {
        $this->modelSiteExp = $modelSiteExp;
    }
 
    
}

?>


