<?php

/**
 * Description of AnnexeEmballageGroupeTypeModel
 * Table des AnnexeEmballageGroupeTypeModel
 *
 * @author franckwastaken
 */
class AnnexeEmballageGroupeTypeModel extends AbstractModel {

    const TABLENAME = 'annexe_emballage_groupe_type';
    const KEYNAME = 'id_annexe_emballage_groupe_type';
    const FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE = 'nom_annexe_emballage_groupe_type';
    const FIELDNAME_ORDRE_ANNEXE_EMBALLAGE_GROUPE_TYPE = 'ordre_emballage_groupe_type';
    const EMBALLAGE_UVC = '1';
    const EMBALLAGE_PAR_COLIS = '2';
    const EMBALLAGE_DU_COLIS = '3';
    const EMBALLAGE_PALETTE = '4';

    protected static $idAnnexeEmballageGroupeUVC;
    protected static $idAnnexeEmballageGroupeParColis;
    protected static $idAnnexeEmballageGroupeDuColis;
    protected static $idAnnexeEmballageGroupePalette;
    protected static $arrayAnnexeEmballageUVC;
    protected static $arrayAnnexeEmballageParColis;
    protected static $arrayAnnexeEmballageDuColis;
    protected static $arrayAnnexeEmballagePalette;
    protected static $idAnnexeEmballageUVC;
    protected static $idAnnexeEmballageParColis;
    protected static $idAnnexeEmballageDuColis;
    protected static $idAnnexeEmballagePalette;
    protected static $idAnnexeEmballageGroupeTypeUVCByIdFtaConditionnement;
    protected static $idAnnexeEmballageGroupeTypeParColisByIdFtaConditionnement;
    protected static $idAnnexeEmballageGroupeTypeDuColisByIdFtaConditionnement;
    protected static $idAnnexeEmballageGroupeTypePaletteByIdFtaConditionnement;
    protected static $idFtaConditionnemntUVC;
    protected static $idFtaConditionnemntParColis;
    protected static $idFtaConditionnemntDuColis;
    protected static $idFtaConditionnemntPalette;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

    function getEmballageGroupeUVC() {
        return self::$idFtaConditionnemntUVC;
    }

    function getEmballageGroupeParColis() {
        return self::$idFtaConditionnemntParColis;
    }

    function getEmballageGroupeDuColis() {
        return self::$idFtaConditionnemntDuColis;
    }

    function getEmballageGroupePalette() {
        return self::$idFtaConditionnemntPalette;
    }

    function getArrayEmballageGroupeUVC() {
        return self::$arrayAnnexeEmballageUVC;
    }

    function getArrayEmballageGroupeParColis() {
        return self::$arrayAnnexeEmballageParColis;
    }

    function getArrayEmballageGroupeDuColis() {
        return self::$arrayAnnexeEmballageDuColis;
    }

    function getArrayEmballageGroupePalette() {
        return self::$arrayAnnexeEmballagePalette;
    }

    function getClassNameAnnexeEmballage() {
        return self::$classNameAnnexeEmballage;
    }

    function getIdAnnexeEmballageGroupeTypeUVCFromFtaConditionnement() {
        return self::$idAnnexeEmballageGroupeTypeUVCByIdFtaConditionnement;
    }

    function getIdAnnexeEmballageGroupeTypeParColisFromFtaConditionnement() {
        return self::$idAnnexeEmballageGroupeTypeParColisByIdFtaConditionnement;
    }

    function getIdAnnexeEmballageGroupeTypeDuColisFromFtaConditionnement() {
        return self::$idAnnexeEmballageGroupeTypeDuColisByIdFtaConditionnement;
    }

    function getIdAnnexeEmballageGroupeTypePaletteFromFtaConditionnement() {
        return self::$idAnnexeEmballageGroupeTypePaletteByIdFtaConditionnement;
    }

    public static function initEmballage($paramIdFta) {

        /*
         * On obtient les id groupes d'emballages de type UVC
         */

        self::$idAnnexeEmballageGroupeUVC = AnnexeEmballageGroupeModel::getArrayIdAnnexeEmballageGroupe(self::EMBALLAGE_UVC);
        /*
         * On obtient les id groupes d'emballages par Colis 
         */

        self::$idAnnexeEmballageGroupeParColis = AnnexeEmballageGroupeModel::getArrayIdAnnexeEmballageGroupe(self::EMBALLAGE_PAR_COLIS);
        /*
         * On obtient les id groupes d'emballages du Colis
         */

        self::$idAnnexeEmballageGroupeDuColis = AnnexeEmballageGroupeModel::getArrayIdAnnexeEmballageGroupe(self::EMBALLAGE_DU_COLIS);
        /*
         * On obtient les id groupes d'emballages de type Palette
         */

        self::$idAnnexeEmballageGroupePalette = AnnexeEmballageGroupeModel::getArrayIdAnnexeEmballageGroupe(self::EMBALLAGE_PALETTE);


        /*
         * On obtient les id emballages de type UVC
         * 
         */
        self::$idAnnexeEmballageUVC = AnnexeEmballageModel::getArrayIdAnnexeEmballage(self::$idAnnexeEmballageGroupeUVC);
        self::$arrayAnnexeEmballageUVC = AnnexeEmballageModel::getArrayAnnexeEmballage(self::$idAnnexeEmballageGroupeUVC);
        /*
         * On obtient les id emballages par Colis
         * 
         */
        self::$idAnnexeEmballageParColis = AnnexeEmballageModel::getArrayIdAnnexeEmballage(self::$idAnnexeEmballageGroupeParColis);
        self::$arrayAnnexeEmballageParColis = AnnexeEmballageModel::getArrayAnnexeEmballage(self::$idAnnexeEmballageGroupeParColis);
        /*
         * On obtient les id emballages du Colis
         * 
         */
        self::$idAnnexeEmballageDuColis = AnnexeEmballageModel::getArrayIdAnnexeEmballage(self::$idAnnexeEmballageGroupeDuColis);
        self::$arrayAnnexeEmballageDuColis = AnnexeEmballageModel::getArrayAnnexeEmballage(self::$idAnnexeEmballageGroupeDuColis);
        /*
         * On obtient les id emballages de type Palette
         * 
         */
        self::$idAnnexeEmballagePalette = AnnexeEmballageModel::getArrayIdAnnexeEmballage(self::$idAnnexeEmballageGroupePalette);
        self::$arrayAnnexeEmballagePalette = AnnexeEmballageModel::getArrayAnnexeEmballage(self::$idAnnexeEmballageGroupePalette);


        /*
         * On obtient les id Fta Conditionnement de type UVC
         * On obtient l' id Annexe Emballage de type UVC selon l'id fta et id fta conditionnement
         * On obtient l' id Annexe Emballage groupe type de type UVC selon l'id fta et id fta conditionnement
         */
        self::$idFtaConditionnemntUVC = FtaConditionnementModel::getIdFtaConditionnementByArrayIdAnnexeEmballageAndIdFtaAndIdEmballageGroupeType(self::$idAnnexeEmballageUVC, $paramIdFta, self::EMBALLAGE_UVC);
        self::$idAnnexeEmballageGroupeTypeUVCByIdFtaConditionnement = FtaConditionnementModel::getIdAnnexeEmballageAndGroupeTypeAndGroupeAndIdFtaConditionnementFromFtaConditionnement(self::$idFtaConditionnemntUVC, $paramIdFta);

        /*
         * On obtient les id Fta Conditionnement par Colis
         * On obtient l' id Annexe Emballagepar Colis selon l'id fta et id fta conditionnement
         * On obtient l' id Annexe Emballage groupe type par Colis selon l'id fta et id fta conditionnement
         */
        self::$idFtaConditionnemntParColis = FtaConditionnementModel::getIdFtaConditionnementByArrayIdAnnexeEmballageAndIdFtaAndIdEmballageGroupeType(self::$idAnnexeEmballageParColis, $paramIdFta, self::EMBALLAGE_PAR_COLIS);
        self::$idAnnexeEmballageGroupeTypeParColisByIdFtaConditionnement = FtaConditionnementModel::getIdAnnexeEmballageAndGroupeTypeAndGroupeAndIdFtaConditionnementFromFtaConditionnement(self::$idFtaConditionnemntParColis, $paramIdFta);


        /*
         * On obtient les id Fta Conditionnement du Colis
         * On obtient l' id Annexe Emballage du Colisselon l'id fta et id fta conditionnement
         * On obtient l' id Annexe Emballage groupe type du Colis selon l'id fta et id fta conditionnement
         */
        self::$idFtaConditionnemntDuColis = FtaConditionnementModel::getIdFtaConditionnementByArrayIdAnnexeEmballageAndIdFtaAndIdEmballageGroupeType(self::$idAnnexeEmballageDuColis, $paramIdFta, self::EMBALLAGE_DU_COLIS);
        self::$idAnnexeEmballageGroupeTypeDuColisByIdFtaConditionnement = FtaConditionnementModel::getIdAnnexeEmballageAndGroupeTypeAndGroupeAndIdFtaConditionnementFromFtaConditionnement(self::$idFtaConditionnemntDuColis, $paramIdFta);

        /*
         * On obtient les id Fta Conditionnement de type Palette
         * On obtient l' id Annexe Emballage de type Palette selon l'id fta et id fta conditionnement
         * On obtient l' id Annexe Emballage groupe type de type Palette selon l'id fta et id fta conditionnement
         */
        self::$idFtaConditionnemntPalette = FtaConditionnementModel::getIdFtaConditionnementByArrayIdAnnexeEmballageAndIdFtaAndIdEmballageGroupeType(self::$idAnnexeEmballagePalette, $paramIdFta, self::EMBALLAGE_PALETTE);
        self::$idAnnexeEmballageGroupeTypePaletteByIdFtaConditionnement = FtaConditionnementModel::getIdAnnexeEmballageAndGroupeTypeAndGroupeAndIdFtaConditionnementFromFtaConditionnement(self::$idFtaConditionnemntPalette, $paramIdFta);
    }

}

?>