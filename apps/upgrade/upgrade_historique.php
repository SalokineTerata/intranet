<?php

require_once '../inc/php.php';
/**
 * Identité
 */
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='1'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='1'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_POIDS_ELEMENTAIRE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='1'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_COMMENTAIRE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
/**
 * Etiquette Client
 */
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='20,37'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_NOMBRE_PORTION_FTA . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='34,37'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_LIBELLE_CODE_ARTICLE_CLIENT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='34,37'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_CODE_ARTICLE_CLIENT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='37'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_PVC_ARTICLE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='37'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
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
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
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
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_DUREE_DE_VIE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
/**
 * ExpeditionEtEANS
 */
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='21'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_EAN_UVC . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='21'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_EAN_COLIS . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='21'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
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
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_CONSEIL_DE_RECHAUFFAGE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='27'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_DESIGNATION_CODIFICATION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='27'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_POIDS_UNITAIRE_CODIFICATION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='27'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_QUANTITE_PIECE_PAR_CARTON . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='27'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
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
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_ORIGINE_MATIERE_PREMIERE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='29,35,38'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_LISTE_ALLERGENE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);

DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='29,35,38'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_CONSEIL_APRES_OUVERTURE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='29,35,38'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_LIBELLE_CLIENT . "'"
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
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='28'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
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
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_REMARQUE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION1 . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_DUREE_VIE_TECHNIQUE_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_ORDRE_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_LEGAL_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_ETIQUETTE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_ETIQUETTE_SUPPLEMENTAIRE_FTA_COMPOSIITON . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_ETIQUETTE_INFORMATION_COMPLEMENTAIRE_RECTO_FTA_COMPOSANT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_ETIQUETTE_DUREE_VIE_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_ETIQUETTE_POIDS_FTA_COMPOSITION . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_ETIQUETTE_DECOMPOSITION_POIDS_FTA_COMPOSANT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_VAL_NUT_KJ . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_VAL_NUT_KCAL . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_VAL_MAT_GRASSE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_VAL_ACIDE_GRAS . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_VAL_GLUCIDE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_VAL_SUCRE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaComposantModel::FIELDNAME_VAL_PROTEINE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaComposantModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='30,36,39'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
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
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_DESCRIPTION_EMBALLAGE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='24,26'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='24,26'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='24,26'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='24,26'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='24,26'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaConditionnementModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='24,26'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
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
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_CODE_ARTICLE_LDC . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='33'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_LIBELLE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
DatabaseOperation::execute(
        "UPDATE " . IntranetColumnInfoModel::TABLENAME
        . " SET " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "='1'"
        . ", " . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE . "='33'"
        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
        . "='" . FtaModel::FIELDNAME_NOM_ABREGE . "'"
        . " AND " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
        . "='" . FtaModel::TABLENAME."'"
);
?>
