<?php

/**
 * Description of AnnexeEmballageGroupeTypeModel
 * Table des AnnexeEmballageGroupeTypeModel
 *
 * @author franckwastaken
 */
class AnnexeEmballageGroupeTypeModel extends AbstractModel {

    const TABLENAME = "annexe_emballage_groupe_type";
    const KEYNAME = "id_annexe_emballage_groupe_type";
    const FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE = "nom_annexe_emballage_groupe";
    const FIELDNAME_ORDRE_ANNEXE_EMBALLAGE_GROUPE_TYPE = "ordre_emballage_groupe_type";

    protected static $emballageUVC = 1;
    protected static $emballageParColis = 2;
    protected static $emballageDuColis = 3;
    protected static $emballagePalette = 4;
    protected static $idAnnexeEmballageGroupeUVC;
    protected static $idAnnexeEmballageGroupeParColis;
    protected static $idAnnexeEmballageGroupeDuColis;
    protected static $idAnnexeEmballageGroupePalette;
    protected static $arrayAnnexeEmballageUVC;
    protected static $arrayAnnexeEmballageParColis;
    protected static $arrayAnnexeEmballageDuColis;
    protected static $arrayAnnexeEmballagePalette;
    protected static $classNameAnnexeEmballage;
    protected static $idAnnexeEmballageUVC;
    protected static $idAnnexeEmballageParColis;
    protected static $idAnnexeEmballageDuColis;
    protected static $idAnnexeEmballagePalette;
    protected static $idFtaConditionnemntUVC;
    protected static $idFtaConditionnemntParColis;
    protected static $idFtaConditionnemntDuColis;
    protected static $idFtaConditionnemntPalette;

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

    public static function initEmballage($paramIdFta) {

        /*
         * On obtient les id groupes d'emballages de type UVC
         */

        self::$idAnnexeEmballageGroupeUVC = AnnexeEmballageGroupeModel::getIdAnnexeEmballageGroupe(self::$emballageUVC);
        /*
         * On obtient les id groupes d'emballages par Colis 
         */

        self::$idAnnexeEmballageGroupeParColis = AnnexeEmballageGroupeModel::getIdAnnexeEmballageGroupe(self::$emballageParColis);
        /*
         * On obtient les id groupes d'emballages du Colis
         */

        self::$idAnnexeEmballageGroupeDuColis = AnnexeEmballageGroupeModel::getIdAnnexeEmballageGroupe(self::$emballageDuColis);
        /*
         * On obtient les id groupes d'emballages de type Palette
         */

        self::$idAnnexeEmballageGroupePalette = AnnexeEmballageGroupeModel::getIdAnnexeEmballageGroupe(self::$emballagePalette);
        

        /*
         * On obtient les id emballages de type UVC
         * 
         */
        self::$idAnnexeEmballageUVC = AnnexeEmballageModel::getIdAnnexeEmballage(self::$idAnnexeEmballageGroupeUVC);
        self::$arrayAnnexeEmballageUVC = AnnexeEmballageModel::getIdAnnexeEmballage2(self::$idAnnexeEmballageGroupeUVC);
        /*
         * On obtient les id emballages par Colis
         * 
         */
        self::$idAnnexeEmballageParColis = AnnexeEmballageModel::getIdAnnexeEmballage(self::$idAnnexeEmballageGroupeParColis);
        self::$arrayAnnexeEmballageParColis = AnnexeEmballageModel::getIdAnnexeEmballage2(self::$idAnnexeEmballageGroupeParColis);
        /*
         * On obtient les id emballages du Colis
         * 
         */
        self::$idAnnexeEmballageDuColis = AnnexeEmballageModel::getIdAnnexeEmballage(self::$idAnnexeEmballageGroupeDuColis);
        self::$arrayAnnexeEmballageDuColis = AnnexeEmballageModel::getIdAnnexeEmballage2(self::$idAnnexeEmballageGroupeDuColis);
        /*
         * On obtient les id emballages de type Palette
         * 
         */
        self::$idAnnexeEmballagePalette = AnnexeEmballageModel::getIdAnnexeEmballage(self::$idAnnexeEmballageGroupePalette);
        $annexeEmballageModel= new AnnexeEmballageModel(self::$idAnnexeEmballagePalette);
         self::$classNameAnnexeEmballage = $annexeEmballageModel->getClassName();
        self::$arrayAnnexeEmballagePalette = AnnexeEmballageModel::getIdAnnexeEmballage2(self::$idAnnexeEmballageGroupePalette);


        /*
         * On obtient les id Fta Conditionnement de type UVC
         * 
         */
        self::$idFtaConditionnemntUVC = FtaConditionnementModel::getIdFtaConditionnement(self::$idAnnexeEmballageUVC, $paramIdFta);
        /*
         * On obtient les id Fta Conditionnement par Colis
         * 
         */
        self::$idFtaConditionnemntParColis = FtaConditionnementModel::getIdFtaConditionnement(self::$idAnnexeEmballageParColis, $paramIdFta);
        /*
         * On obtient les id Fta Conditionnement du Colis
         * 
         */
        self::$idFtaConditionnemntDuColis = FtaConditionnementModel::getIdFtaConditionnement(self::$idAnnexeEmballageDuColis, $paramIdFta);
        /*
         * On obtient les id Fta Conditionnement de type Palette
         * 
         */
        self::$idFtaConditionnemntPalette = FtaConditionnementModel::getIdFtaConditionnement(self::$idAnnexeEmballagePalette, $paramIdFta);
    }

}

?>