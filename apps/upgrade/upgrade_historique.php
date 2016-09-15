<?php

require_once '../inc/php.php';
/**
 * Identité
 */
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='1'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='1'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_POIDS_ELEMENTAIRE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='1'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_COMMENTAIRE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='1'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_WORKFLOW . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='1'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2 . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='1'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_ID_ARCADIA_GAMME_COOP . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='1'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_ID_ARCADIA_FAMILLE_BUDGET . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_SQL_REQUEST_CONTENT_INTRANET_COLUMN_INFO . "='SELECT id_arcadia_marque,nom_arcadia_marque FROM arcadia_marque '"
        . ", " . IntranetColumnInfoModel::FIELDNAME_TYPE_OF_HTML_OBJECT_INTRANET_COLUMN_INFO . "='LIST'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_ID_ARCADIA_MARQUE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_SQL_REQUEST_CONTENT_INTRANET_COLUMN_INFO . "='SELECT id_classification_raccourcis,nom_classification_raccourcis FROM classification_raccourcis '"
        . ", " . IntranetColumnInfoModel::FIELDNAME_TYPE_OF_HTML_OBJECT_INTRANET_COLUMN_INFO . "='LIST'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_SQL_REQUEST_CONTENT_INTRANET_COLUMN_INFO . "='SELECT id_arcadia_sous_famille,nom_arcadia_sous_famille FROM arcadia_sous_famille '"
        . ", " . IntranetColumnInfoModel::FIELDNAME_TYPE_OF_HTML_OBJECT_INTRANET_COLUMN_INFO . "='LIST'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_ID_ARCADIA_SOUS_FAMILLE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_SQL_REQUEST_CONTENT_INTRANET_COLUMN_INFO . "='SELECT id_arcadia_famille_vente,nom_arcadia_famille_vente FROM arcadia_famille_vente '"
        . ", " . IntranetColumnInfoModel::FIELDNAME_TYPE_OF_HTML_OBJECT_INTRANET_COLUMN_INFO . "='LIST'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_ID_ARCADIA_FAMILLE_VENTE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_SQL_REQUEST_CONTENT_INTRANET_COLUMN_INFO . "='SELECT id_arcadia_gamme_famille_budget,nom_arcadia_gamme_famille_budget FROM arcadia_gamme_famille_budget '"
        . ", " . IntranetColumnInfoModel::FIELDNAME_TYPE_OF_HTML_OBJECT_INTRANET_COLUMN_INFO . "='LIST'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);


/**
 * Activation cody
 */
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='41'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_ACTIVATION_CODESOFT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='41'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_GESTION_ETIQUETTE_RECTO . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='41'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_GESTION_ETIQUETTE_VERSO . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);

/**
 * Etiquette Client
 */
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='20,37,34'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_LOGO_ECO_EMBALLAGE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='20,37,34'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_PRODUIT_TRANSFORME . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='20,37'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_NOMBRE_PORTION_FTA . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='34,37'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_SERVICE_CONSOMMATEUR . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='34,37'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_LIBELLE_CODE_ARTICLE_CLIENT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='34,37'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_CODE_ARTICLE_CLIENT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='37'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_PVC_ARTICLE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='37'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_PVC_ARTICLE_KG . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
/**
 * PCB
 */
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='23'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
/**
 * Exigence client
 */
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='42,19'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_DUREE_DE_VIE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
/**
 * Site de production
 */
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='42,19'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_SITE_PRODUCTION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
/**
 * ExpeditionEtEANS
 */
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='42,19'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_SITE_EXPEDITION_FTA . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='42,19'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_UNITE_FACTURATION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='21'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_EAN_UVC . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='21'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_EAN_COLIS . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='21'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_EAN_PALETTE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
/**
 * Nomenclature
 */
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='27'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_CONSEIL_DE_RECHAUFFAGE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='27'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_ID_ANNEXE_AGRO_ART_CODIFICATION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='27'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_ID_ANNEXE_UNITE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='27'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_ETAT_FTA_CODIFICATION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='27'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_SITE_PRODUCTION_FTA_CODIFICATION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='27'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_DESIGNATION_CODIFICATION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='27'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_POIDS_UNITAIRE_CODIFICATION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='27'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_QUANTITE_PIECE_PAR_CARTON . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='27'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_POIDS_TOTAL_CARTON_VRAC_FTA_NOMENCLATURE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);

/**
 * Etiquette Article
 */
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='29,35,38'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_VERROUILLAGE_LIBELLE_ETIQUETTE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='29,35,38'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_ORIGINE_MATIERE_PREMIERE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='29,35,38'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_LISTE_ALLERGENE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);

DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='29,35,38'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_CONSEIL_APRES_OUVERTURE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='29,35,38'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_LIBELLE_CLIENT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='29,35,38'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_SQL_REQUEST_CONTENT_INTRANET_COLUMN_INFO
        . "='SELECT DISTINCT k_etiquette,designation_codesoft_etiquettes FROM codesoft_etiquettes '"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_ETIQUETTE_CODESOFT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);

/**
 * Durrée de vie
 */
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='28'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='28'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_CODE_DOUANE_FTA . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);

/**
 * Etiquette Composition
 */
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_REMARQUE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_ENVIRONNEMENT_CONSERVATION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_SQL_REQUEST_CONTENT_INTRANET_COLUMN_INFO . "='SELECT " . AnnexeModeEtiquetteModel::KEYNAME . "," . AnnexeModeEtiquetteModel::FIELDNAME_MODE_ETIQUETTE_LABEL
                . " FROM " . AnnexeModeEtiquetteModel::TABLENAME ."'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_TYPE_OF_HTML_OBJECT_INTRANET_COLUMN_INFO . "='LIST'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_ID_GEO . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_TAILLE_POLICE_INGREDIENT_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_K_STYLE_PARAGRAPHE_INGREDIENT_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_K_ETIQUETTE_VERSO_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_K_CODESOFT_ETIQUETTE_LOGO . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION1 . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_DUREE_VIE_TECHNIQUE_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_ORDRE_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_LEGAL_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_ETIQUETTE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_ETIQUETTE_SUPPLEMENTAIRE_FTA_COMPOSIITON . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_ETIQUETTE_INFORMATION_COMPLEMENTAIRE_RECTO_FTA_COMPOSANT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_ETIQUETTE_DUREE_VIE_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_ETIQUETTE_POIDS_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_ETIQUETTE_DECOMPOSITION_POIDS_FTA_COMPOSANT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_VAL_NUT_KJ . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_VAL_NUT_KCAL . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_VAL_MAT_GRASSE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_VAL_ACIDE_GRAS . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_VAL_GLUCIDE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_VAL_SUCRE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_VAL_PROTEINE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::FIELDNAME_VAL_SEL . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);

/**
 * Emballage primaire
 */
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='24,26'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_DESCRIPTION_EMBALLAGE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='24,26'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='24,26'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='24,26'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='24,26'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='24,26'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='24,26'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='24,26'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='24,26'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::TABLENAME."'"
);

/**
 * Codification
 */
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='33'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_CODE_ARTICLE_LDC . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='33'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_LIBELLE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='33'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::FIELDNAME_NOM_ABREGE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
?>
