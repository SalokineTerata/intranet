<?php

/**
 * Description of FtaConditionnementModel
 * Table des FtaConditionnementModel
 *
 * @author franckwastaken
 */
class FtaConditionnementModel extends AbstractModel {

    const TABLENAME = "fta_conditionnement";
    const KEYNAME = "id_fta_conditionnement";
    const FIELDNAME_ID_FTA = "id_fta";
    const FIELDNAME_HAUTEUR_EMBALLAGE_FTA_CONDITIONNEMENT = "hauteur_emballage_fta_conditionnement";
    const FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT = "hauteur_fta_conditionnement";
    const FIELDNAME_ID_ANNEXE_EMBALLAGE = "id_annexe_emballage";
    const FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE = "id_annexe_emballage_groupe";
    const FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE = "id_annexe_emballage_groupe_type";
    const FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT = "largeur_fta_conditionnement";
    const FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT = "longueur_fta_conditionnement";
    const FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT = "nombre_couche_fta_conditionnement";
    const FIELDNAME_PCB_FTA_CONDITIONNEMENT = "pcb_fta_conditionnement";
    const FIELDNAME_POIDS_FTA_CONDITIONNEMENT = "poids_fta_conditionnement";
    const FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT = "quantite_par_couche_fta_conditionnement";
    const EMBALLAGES_UVC = "1";
    const EMBALLAGES_PAR_COLIS = "2";
    const EMBALLAGES_DU_COLIS = "3";
    const EMBALLAGES_PALETTE = "4";
    const UVC_EMBALLAGE = "uvc_emballage";
    const UVC_EMBALLAGE_NET = "uvc_net";
    const UVC_EMBALLAGE_BRUT = "uvc_brut";
    const UVC_EMBALLAGE_DIMENSION = "dimension_uvc";
    const UVC_EMBALLAGE_DIMENSION_HAUTEUR = "dimension_uvc_hauteur";
    const UVC_EMBALLAGE_DIMENSION_LONGEUR = "dimension_uvc_longueur";
    const UVC_EMBALLAGE_DIMENSION_LARGEUR = "dimension_uvc_largeur";
    const UVC_EMBALLAGE_DIMENSION_LABEL = "Dimension de l'UVC (en mm):";
    const COLIS_EMBALLAGE = "colis_emballage";
    const COLIS_EMBALLAGE_NET = "colis_net";
    const COLIS_EMBALLAGE_BRUT = "colis_brut";
    const COLIS_EMBALLAGE_HAUTEUR = "hauteur_colis";
    const PALETTE_EMBALLAGE = "palette_emballage";
    const PALETTE_EMBALLAGE_NET = "palette_net";
    const PALETTE_EMBALLAGE_BRUT = "palette_brut";
    const PALETTE_EMBALLAGE_HAUTEUR = "hauteur_palette";
    const PALETTE_EMBALLAGE_HAUTEUR_LABEL = "Hauteur (en m)";
    const PALETTE_NOMBRE_DE_COUCHE = "couche_palette";
    const PALETTE_NOMBRE_COLIS_PAR_COUCHE = "colis_couche";
    const PALETTE_NOMBRE_TOTAL_PAR_CARTON = "total_colis";
    const PALETTE_NOMBRE_TOTAL_PAR_CARTON_LABEL = "Nombre total de Carton par palette";

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
    static function getCalculPoidsEmballage($paramPoidsEmballageUnitaire, $paramQuantiteCouche, $paramNombreCouche) {
        return $paramPoidsEmballageUnitaire * $paramQuantiteCouche * $paramNombreCouche;
    }

    static function getCalculDimensionEmballageUvc($paramDimensionEmballageHauteur, $paramDimensionEmballageHauteurRow, $paramDimensionEmballageLongueur, $paramDimensionEmballageLongueurRow, $paramDimensionEmballageLargeur, $paramDimensionEmballageLargeurRow) {

        //Calcul des dimension de l'emballage par UVC  (on recherche la taille la plus grande)
        if ($paramDimensionEmballageHauteur < $paramDimensionEmballageHauteurRow) {
            $paramDimensionEmballageHauteur = $paramDimensionEmballageHauteurRow;
        }
        if ($paramDimensionEmballageLongueur < $paramDimensionEmballageLongueurRow) {
            $paramDimensionEmballageLongueur = $paramDimensionEmballageLongueurRow;
        }
        if ($paramDimensionEmballageLargeur < $paramDimensionEmballageLargeurRow) {
            $paramDimensionEmballageLargeur = $paramDimensionEmballageLargeurRow;
        }
        return $paramDimensionEmballageLongueur . "x" . $paramDimensionEmballageLargeur . "x" . $paramDimensionEmballageHauteur . " (Longueur x Largeur x Hauteur)";
    }

    static function getCalculHauteurEmballagePalette($paramHauteurFtaConditionnement, $paramCouchePalette) {
        return (($paramHauteurFtaConditionnement * $paramCouchePalette) + $paramHauteurFtaConditionnement ) / 1000;
    }

    static function getCalculPoidsBrutEmballage($paramPoidsNet, $paramPoidsEmballage) {
        return $paramPoidsNet + $paramPoidsEmballage;
    }

    static function getCalculPoidsBrutEmballageColis($paramPoidsNet, $paramPoidsEmballage) {
        return $paramPoidsNet + ($paramPoidsEmballage / 1000);
    }

    static function getCalculPoidsEmballagePalette($paramPoidsFta, $paramNombreColisCouche, $paramNombreCouchePalette, $paramQuantiteCouche, $paramNombreCouche) {
        return ($paramPoidsFta / 1000) * $paramNombreColisCouche * $paramNombreCouchePalette * ($paramQuantiteCouche * $paramNombreCouche);
    }

    static function getCalculGenericMultiplication($param, $paramb) {
        return $param * $paramb;
    }

    public function getArrayConditionnement() {

        //Les calculs pour la table conditionnment
        $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray("SELECT " . FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT . " FROM " . FtaConditionnementModel::TABLENAME
                        . "WHERE " . FtaConditionnementModel::FIELDNAME_ID_FTA . "=" . FtaModel::KEYNAME
        );

        foreach ($array as $rows) {

            $return[FtaModel::COLIS_EMBALLAGE_HAUTEUR] = $rows[FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT];
        }
    }

}

?>