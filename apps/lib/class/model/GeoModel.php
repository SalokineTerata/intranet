<?php

/**
 * Description of GeoModel
 * Table des GeoModel
 *
 * @author franckwastaken
 */
class GeoModel extends AbstractModel {

    const TABLENAME = 'geo';
    const KEYNAME = 'id_geo';
    const FIELDNAME_GEO = 'geo';
    const FIELDNAME_LETTRE = 'lettre';
    const FIELDNAME_ID_SITE_AGIS = 'id_site_agis';
    const FIELDNAME_ID_SITE_GROUPE = 'id_site_groupe';
    const FIELDNAME_LIBELLE_SITE_AGIS = 'libelle_site_agis';
    const FIELDNAME_RACCOURCI_SITE_AGIS = 'raccourci_site_agis';
    const FIELDNAME_SITE_ACTIF = 'site_actif';
    const FIELDNAME_ADRESSE_GEO = 'adresse_geo';
    const FIELDNAME_TELEPHONE_GEO = 'telephone_geo';
    const FIELDNAME_FAX_GEO = 'fax_geo';
    const FIELDNAME_FAX_COMMERCIAL_GEO = 'fax_commercial_geo';
    const FIELDNAME_GEO_CNUD_PREPARER_PAR = 'geo_cnud_preparer_par';
    const FIELDNAME_ID_SITE = 'OLD_id_site';
    const FIELDNAME_ASSEMBLAGE = 'assemblage';
    const FIELDNAME_SITE_CODE_EMBALLEUR = 'site_code_emballeur';
    const FIELDNAME_SITE_AGREMENT_CE = 'site_agrement_ce';
    const FIELDNAME_ID_IP_GEO = 'id_ip_geo';
    const FIELDNAME_ORDRE_PLANNING_PRESENCE_GEO = 'ordre_planning_presence_geo';
    const FIELDNAME_NOM_DNS_COMPLET = 'nom_dns_complet';
    const FIELDNAME_K_SOCIETE = 'k_societe';
    const FIELDNAME_TAG_APPLICATION_GEO = 'tag_application_geo';
    const ID_SITE_NON_DEFINIE = '-1';
    const ID_SITE_PLB = '20';
    const ID_SITE_CORNER = '54';
    const ID_SITE_ROEZE_SUR_SARTHE = '12';
    const ID_SITE_REGALETTE = '13';
    const ID_SITE_KIRN = '335';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

    /*
     * Récuperation du nom de site de production
     */

    public static function getProductionSiteName($paramIdSite) {
        $arrayNomSiteProduction = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . GeoModel::FIELDNAME_GEO
                        . ' FROM ' . GeoModel::TABLENAME
                        . ' WHERE ' . GeoModel::KEYNAME
                        . '= \'' . $paramIdSite . '\''
        );
        if ($arrayNomSiteProduction) {
            foreach ($arrayNomSiteProduction as $rowsNomSiteProduction) {
                $nomSiteProduction = $rowsNomSiteProduction[GeoModel::FIELDNAME_GEO];
            }
        }
        return $nomSiteProduction;
    }

    /*
     * Vérifie si le lieu géographique est un site de production
     */

    public static function isLieuGeoSiteDeProduction($paramLieuGeo) {
        $trueSiteDeProd = FALSE;
        $arrayNomSiteProduction = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . GeoModel::FIELDNAME_ASSEMBLAGE
                        . ' FROM ' . GeoModel::TABLENAME
                        . ' WHERE ' . GeoModel::KEYNAME
                        . '= \'' . $paramLieuGeo . '\''
        );
        if ($arrayNomSiteProduction) {
            foreach ($arrayNomSiteProduction as $rowsNomSiteProduction) {
                $siteDeProdValue = $rowsNomSiteProduction[GeoModel::FIELDNAME_ASSEMBLAGE];
                if ($siteDeProdValue) {
                    $trueSiteDeProd = TRUE;
                }
            }
        }
        return $trueSiteDeProd;
    }

    /**
     * Affiche la liste des site de production pour lesquel l'utilisateur connecté à les droits d'accès
     * @param int $paramIdUser
     * @param HtmlListSelectTagName $paramObjet
     * @param boolean $paramIsEditable
     * @param int $paramIdDefault
     * @return string
     */
    public static function showListeDeroulanteSiteProdByAcces($paramIdUser, HtmlListSelectTagName $paramObjet, $paramIsEditable, $paramIdDefault) {
        $arraySite = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . GeoModel::KEYNAME . ',' . GeoModel::FIELDNAME_GEO
                        . ' FROM ' . GeoModel::TABLENAME
                        . ', ' . FtaActionSiteModel::TABLENAME
                        . ', ' . IntranetActionsModel::TABLENAME
                        . ', ' . IntranetDroitsAccesModel::TABLENAME
                        . ' WHERE ' . GeoModel::FIELDNAME_GEO . '<>\'\''
                        . ' AND ' . FtaActionSiteModel::TABLENAME . '.' . FtaActionSiteModel::FIELDNAME_ID_SITE . '=' . GeoModel::KEYNAME
                        . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                        . ' AND ' . FtaActionSiteModel::TABLENAME . '.' . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                        . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                        . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdUser // L'utilisateur connecté
                        . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                        . ' ORDER BY ' . GeoModel::FIELDNAME_GEO
        );

        $paramObjet->setArrayListContent($arraySite);
        $paramObjet->getAttributes()->getName()->setValue(GeoModel::KEYNAME);
        $paramObjet->setLabel(DatabaseDescription::getFieldDocLabel(GeoModel::TABLENAME, GeoModel::FIELDNAME_GEO));
        $paramObjet->setIsEditable($paramIsEditable);
        $paramObjet->setSelectedValue($paramIdDefault);
        $listeSiteProduction = $paramObjet->getHtmlResult();

        return $listeSiteProduction;
    }

}
?>


