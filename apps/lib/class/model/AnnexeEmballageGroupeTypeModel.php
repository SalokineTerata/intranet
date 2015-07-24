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
    const FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE = "nom_annexe_emballage_groupe_type";
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
        self::$arrayAnnexeEmballageUVC = AnnexeEmballageModel::getArrayAnnexeEmballage(self::$idAnnexeEmballageGroupeUVC);
        /*
         * On obtient les id emballages par Colis
         * 
         */
        self::$idAnnexeEmballageParColis = AnnexeEmballageModel::getIdAnnexeEmballage(self::$idAnnexeEmballageGroupeParColis);
        self::$arrayAnnexeEmballageParColis = AnnexeEmballageModel::getArrayAnnexeEmballage(self::$idAnnexeEmballageGroupeParColis);
        /*
         * On obtient les id emballages du Colis
         * 
         */
        self::$idAnnexeEmballageDuColis = AnnexeEmballageModel::getIdAnnexeEmballage(self::$idAnnexeEmballageGroupeDuColis);
        self::$arrayAnnexeEmballageDuColis = AnnexeEmballageModel::getArrayAnnexeEmballage(self::$idAnnexeEmballageGroupeDuColis);
        /*
         * On obtient les id emballages de type Palette
         * 
         */
        self::$idAnnexeEmballagePalette = AnnexeEmballageModel::getIdAnnexeEmballage(self::$idAnnexeEmballageGroupePalette);
        self::$arrayAnnexeEmballagePalette = AnnexeEmballageModel::getArrayAnnexeEmballage(self::$idAnnexeEmballageGroupePalette);


        /*
         * On obtient les id Fta Conditionnement de type UVC
         * On obtient l' id Annexe Emballage de type UVC selon l'id fta et id fta conditionnement
         * On obtient l' id Annexe Emballage groupe type de type UVC selon l'id fta et id fta conditionnement
         */
        self::$idFtaConditionnemntUVC = FtaConditionnementModel::getIdFtaConditionnement(self::$idAnnexeEmballageUVC, $paramIdFta, self::$emballageUVC);
        self::$idAnnexeEmballageGroupeTypeUVCByIdFtaConditionnement = FtaConditionnementModel::getIdAnnexeEmballageAndGroupeTypeAndGroupeAndIdFtaConditionnementFromFtaConditionnement(self::$idFtaConditionnemntUVC, $paramIdFta);

        /*
         * On obtient les id Fta Conditionnement par Colis
         * On obtient l' id Annexe Emballagepar Colis selon l'id fta et id fta conditionnement
         * On obtient l' id Annexe Emballage groupe type par Colis selon l'id fta et id fta conditionnement
         */
        self::$idFtaConditionnemntParColis = FtaConditionnementModel::getIdFtaConditionnement(self::$idAnnexeEmballageParColis, $paramIdFta, self::$emballageParColis);
        self::$idAnnexeEmballageGroupeTypeParColisByIdFtaConditionnement = FtaConditionnementModel::getIdAnnexeEmballageAndGroupeTypeAndGroupeAndIdFtaConditionnementFromFtaConditionnement(self::$idFtaConditionnemntParColis, $paramIdFta);


        /*
         * On obtient les id Fta Conditionnement du Colis
         * On obtient l' id Annexe Emballage du Colisselon l'id fta et id fta conditionnement
         * On obtient l' id Annexe Emballage groupe type du Colis selon l'id fta et id fta conditionnement
         */
        self::$idFtaConditionnemntDuColis = FtaConditionnementModel::getIdFtaConditionnement(self::$idAnnexeEmballageDuColis, $paramIdFta, self::$emballageDuColis);
        self::$idAnnexeEmballageGroupeTypeDuColisByIdFtaConditionnement = FtaConditionnementModel::getIdAnnexeEmballageAndGroupeTypeAndGroupeAndIdFtaConditionnementFromFtaConditionnement(self::$idFtaConditionnemntDuColis, $paramIdFta);

        /*
         * On obtient les id Fta Conditionnement de type Palette
         * On obtient l' id Annexe Emballage de type Palette selon l'id fta et id fta conditionnement
         * On obtient l' id Annexe Emballage groupe type de type Palette selon l'id fta et id fta conditionnement
         */
        self::$idFtaConditionnemntPalette = FtaConditionnementModel::getIdFtaConditionnement(self::$idAnnexeEmballagePalette, $paramIdFta, self::$emballagePalette);
        self::$idAnnexeEmballageGroupeTypePaletteByIdFtaConditionnement = FtaConditionnementModel::getIdAnnexeEmballageAndGroupeTypeAndGroupeAndIdFtaConditionnementFromFtaConditionnement(self::$idFtaConditionnemntPalette, $paramIdFta);
    }

    public static function getAddLinkBeforeConditionnement($paramIdFta, $paramIdChapitre, $paramTypeEmballage, $paramSyntheseAction,$paramComeback,$paramIdFtaEtat,$paramAbreviationEtat,$paramIdFtaRole) {
        return "ajout_conditionnement.php?"
                . "id_fta=" . $paramIdFta
                . "&id_annexe_emballage_groupe_type=" . $paramTypeEmballage
                . "&id_fta_chapitre=" . $paramIdChapitre
                . "&synthese_action=" . $paramSyntheseAction
                . "&comeback=" . $paramComeback
                . "&id_fta_etat=" . $paramIdFtaEtat
                . "&abrevation_fta_etat=" . $paramAbreviationEtat
                . "&id_fta_role=" . $paramIdFtaRole
        ;
    }

    public static function getAddLinkAfterConditionnement($paramIdFta, $paramIdChapitre, $paramTypeEmballage, $paramSyntheseAction,$paramComeback,$paramIdFtaEtat,$paramAbreviationEtat,$paramIdFtaRole) {
        return "<a href=ajout_conditionnement.php?"
                . "id_fta=" . $paramIdFta
                . "&id_annexe_emballage_groupe_type=" . $paramTypeEmballage
                . "&id_fta_chapitre=" . $paramIdChapitre
                . "&synthese_action=" . $paramSyntheseAction
                . "&comeback=" . $paramComeback
                . "&id_fta_etat=" . $paramIdFtaEtat
                . "&abrevation_fta_etat=" . $paramAbreviationEtat
                . "&id_fta_role=" . $paramIdFtaRole . "><img src=../lib/images/plus.png width=22  border=0 valign=middle halign=right />"
                . "</a><br>";
    }

    public static function getDeleteLinkConditionnement($paramIdFta, $paramIdChapitre, $paramIdFtaConditionnement, $paramSyntheseAction) {
        return "<a href=modification_fiche_post.php?"
                . "id_fta=$paramIdFta"
                . "&id_fta_conditionnement=$paramIdFtaConditionnement"
                . "&action=suppression_conditionnement"
                . "&id_fta_chapitre_encours=$paramIdChapitre"
                . "&synthese_action=$paramSyntheseAction>
                                <img src=../lib/images/supprimer.png width=22  border=0/>
                                </a><br>";
    }

}

?>