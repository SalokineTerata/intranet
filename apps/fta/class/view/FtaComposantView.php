<?php

/**
 * Description of FtaComposantView
 *
 * @author franckwastaken
 */
class FtaComposantView extends AbstractView {

    /**
     * Model de donnée d'un composant
     * @var FtaComposantModel
     */
    private $FtaComposantModel;

    /**
     * La vue est-elle modifiable par l'utilisateur (saisie) ou simplement
     * en consultation ?
     * @var boolean
     */
    private $isEditable;

    /**
     * Model de donnée d'une FTA
     * @var FtaModel 
     */
    private $ftaModel;

    /**
     * Model de donnée d'une AnnexeAgrologicArticleCodification
     * @var AnnexeAgrologicArticleCodificationModel 
     */
    private $annexeAgrologicArticleCodificationModel;

    /**
     * 
     * @param FtaComposantModel $ParamFtaComposantModel
     */
    public function __construct(FtaComposantModel $ParamFtaComposantModel) {
        $this->setFtaComposantModel($ParamFtaComposantModel);
        $this->setFtaModel(
                new FtaModel($ParamFtaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ID_FTA)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
        $this->setAnnexeAgrologicArticleCodificationModel(
                new AnnexeAgrologicArticleCodificationModel($ParamFtaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ID_ANNEXE_AGRO_ART_CODIFICATION)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
    }

    private function getFtaComposantModel() {
        return $this->FtaComposantModel;
    }

    private function setFtaComposantModel(FtaComposantModel $FtaComposantModel) {
        if ($FtaComposantModel instanceof FtaComposantModel) {
            $this->FtaComposantModel = $FtaComposantModel;
        }
    }

    function getFtaModel() {
        return $this->ftaModel;
    }

    function setFtaModel(FtaModel $ftaModel) {
        if ($ftaModel instanceof FtaModel) {
            $this->ftaModel = $ftaModel;
        }
    }

    function getAnnexeAgrologicArticleCodificationModel() {
        return $this->annexeAgrologicArticleCodificationModel;
    }

    function setAnnexeAgrologicArticleCodificationModel(AnnexeAgrologicArticleCodificationModel $annexeAgrologicArticleCodificationModel) {
        if ($annexeAgrologicArticleCodificationModel instanceof AnnexeAgrologicArticleCodificationModel) {
            $this->annexeAgrologicArticleCodificationModel = $annexeAgrologicArticleCodificationModel;
        }
    }

    public function getIsEditable() {
        return $this->isEditable;
    }

    public function setIsEditable($isEditable) {
        $this->getFtaComposantModel()->setIsEditable($isEditable);
        $this->isEditable = $isEditable;
    }

    public function getHtmlDataField($paramFieldName) {

        $dataField = $this->getFtaComposantModel()->getDataField($paramFieldName);

        /**
         * On vérifie si le champ est verrouillable
         */
        $dataField->checkLockField($this->getFtaModel(), $this->getIsEditable());

        /**
         * On autorise la modification selon l'état de champs verrouillable
         */
        $isEditable = $this->isEditableLockField($dataField);
        /**
         * On vérifie les Règles de validation du champ
         */
        $dataField->checkValidationRules();

        if ($dataField->getDataValidationSuccessful() == TRUE) {
            $this->setDataValidationSuccessfulToTrue();
        } else {
            $this->setDataValidationSuccessfulToFalse();
        }

        return Html::convertDataFieldToHtml(
                        $dataField
                        , $isEditable
        );
    }

    /**
     * On autorise la modification selon l'état de champs verrouillable
     * @param DatabaseDataField $paramDataField
     * @return boolean
     */
    function isEditableLockField(DatabaseDataField $paramDataField) {
        $isLockValue = $paramDataField->getIsFieldLock();
        $isEditable = $this->getIsEditable();
        switch ($isLockValue) {
            case FtaVerrouillageChampsModel::FIELD_LOCK_PRIMARY_FALSE:
            case FtaVerrouillageChampsModel::FIELD_LOCK_SECONDARY_FALSE:
            case FtaVerrouillageChampsModel::FIELD_LOCK_PRIMARY_TRUE:


                break;
            case FtaVerrouillageChampsModel::FIELD_LOCK_SECONDARY_TRUE:

                $isEditable = FALSE;

                break;
        }
        return $isEditable;
    }

    /**
     * Affiche la liste déroulante des sites de production pour les composants et compositions
     * @param HtmlListSelect $paramObjet
     * @param boolean $paramIsEditable
     * @param boolean $paramLabelSiteDeProduction
     * @return string
     */
    function showListeDeroulanteSiteProdForComposant(HtmlListSelect $paramObjet, $paramIsEditable, $paramLabelSiteDeProduction) {

        $listeSiteProduction = $this->getFtaComposantModel()->showListeDeroulanteSiteProdForComposant($paramObjet, $paramIsEditable, $paramLabelSiteDeProduction);

        return $listeSiteProduction;
    }

    /**
     * Liste des étiqettes recto
     * @param boolean $paramIsEditable
     * @return string
     */
    function getListeCodesoftEtiquettesRecto($paramIsEditable) {

        $listeCodesoftEtiquettes = $this->getFtaComposantModel()->getListeCodesoftEtiquettesRecto($paramIsEditable);

        return $listeCodesoftEtiquettes;
    }

    /**
     * Liste des étiqettes verso 
     * @param boolean $paramIsEditable
     * @return string
     */
    function getListeCodesoftEtiquettesVerso($paramIsEditable) {
        $listeCodesoftEtiquettes = $this->getFtaComposantModel()->getListeCodesoftEtiquettesVerso($paramIsEditable);

        return $listeCodesoftEtiquettes;
    }

    /**
     * Liste des options étiqettes
     * @param boolean $paramIsEditable
     * @return string
     */
    function getListeModeEtiquette($paramIsEditable) {

        $listeModeEtiquettes = $this->getFtaComposantModel()->getListeModeEtiquette($paramIsEditable);

        return $listeModeEtiquettes;
    }

    function getHtmlCodePSF() {
        $id_fta_composant = $this->getFtaComposantModel()->getKeyValue();
        $codePSFValue = $this->getFtaComposantModel()->getDataField(FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE)->getFieldValue();
        $codePSF = new HtmlInputText();
        $HtmlTableName = FtaComposantModel::TABLENAME
                . '_'
                . FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE
                . '_'
                . $id_fta_composant
        ;

        /**
         * Champ verrouillable condition
         */
        /**
         * Vérification du champ initialisé
         */
        $isFieldLock = FtaVerrouillageChampsModel::isFieldLock(FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE, $this->getFtaModel());
        /**
         * Génération du lien pour verrouillé/déverrouillé
         */
        $linkFieldLock = FtaVerrouillageChampsModel::linkFieldLock($isFieldLock, FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE, $this->getFtaModel(), $this->getIsEditable());

        /**
         * Affectation de la modification d'un champ ou non
         */
        $isEditable = FtaVerrouillageChampsModel::isEditableLockField($isFieldLock, $this->getIsEditable());

        $codePSF->setLabel(DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE));
        $codePSF->getAttributes()->getValue()->setValue($codePSFValue);
        $codePSF->getAttributes()->getPattern()->setValue("[0-9]{1,6}");
        $codePSF->getAttributes()->getMaxLength()->setValue("6");
        $codePSF->setIsEditable($isEditable);
        $codePSF->initAbstractHtmlInput(
                $HtmlTableName
                , $codePSF->getLabel()
                , $codePSFValue
                , $this->getFtaComposantModel()->getDataField(FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE)->isFieldDiff()
                , NULL
                , NULL
                , $isFieldLock
                , $linkFieldLock
        );
        $codePSF->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaComposantModel::TABLENAME, FtaComposantModel::KEYNAME, $id_fta_composant, FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE);
        return $codePSF->getHtmlResult();
    }

    /**
     * Liste des étiqettes recto
     * @param boolean $paramIsEditable
     * @return string
     */
    function listeCodesoftEtiquettesRecto($paramIsEditable) {

        $listeCodesoftEtiquettesRecto = $this->getListeCodesoftEtiquettesRecto($paramIsEditable);

        return $listeCodesoftEtiquettesRecto;
    }

    /**
     * Liste des étiqettes verso
     * @param boolean $paramIsEditable
     * @return string
     */
    function listeCodesoftEtiquettesVerso($paramIsEditable) {

        $listeCodesoftEtiquettesVerso = $this->getListeCodesoftEtiquettesVerso($paramIsEditable);

        return $listeCodesoftEtiquettesVerso;
    }

    /**
     * Liste des modes etiquettes
     * @param boolean $paramIsEditable
     * @return string
     */
    function listeModeEtiquette($paramIsEditable) {

        $listeModeEtiquettes = $this->getListeModeEtiquette($paramIsEditable);

        return $listeModeEtiquettes;
    }

    /**
     * Affiche le le COde PSF avec le prefixe
     * @return string
     */
    function getHtmlPrefixeIdCodePSF() {
        $id_fta_composant = $this->getFtaComposantModel()->getKeyValue();
        $prefixe = $this->getAnnexeAgrologicArticleCodificationModel()->getDataField(AnnexeAgrologicArticleCodificationModel::FIELDNAME_PREFIXE_ANNEXE_AGRO_ART_COD)->getFieldValue();

        $codePSFValue = $this->getFtaComposantModel()->getDataField(FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE)->getFieldValue();
        $completeCode = $prefixe . $codePSFValue;
        $codePSF = new HtmlInputText();
        $HtmlTableName = FtaComposantModel::TABLENAME
                . '_'
                . FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE
                . '_'
                . $id_fta_composant
        ;
        $codePSF->setLabel(DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE));
        $codePSF->getAttributes()->getValue()->setValue($completeCode);
        $codePSF->getAttributes()->getPattern()->setValue("[0-9]{1,6}");
        $codePSF->getAttributes()->getMaxLength()->setValue("6");
        $codePSF->setIsEditable(FALSE);
        $codePSF->initAbstractHtmlInput(
                $HtmlTableName
                , $codePSF->getLabel()
                , $completeCode
                , $this->getFtaComposantModel()->getDataField(FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE)->isFieldDiff()
        );
        $codePSF->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaComposantModel::TABLENAME, FtaComposantModel::KEYNAME, $id_fta_composant, FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE);
        return $codePSF->getHtmlResult();
    }

}
