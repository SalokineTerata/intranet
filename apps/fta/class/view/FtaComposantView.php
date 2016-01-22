<?php

/**
 * Description of FtaComposantView
 *
 * @author franckwastaken
 */
class FtaComposantView {

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
        return Html::convertDataFieldToHtml(
                        $this->getFtaComposantModel()->getDataField($paramFieldName)
                        , $this->getIsEditable()
        );
    }

    /**
     * Affiche la liste déroulante des sites de production pour les composants et compositions
     * @param HtmlListSelect $paramObjet
     * @param boolean $paramIsEditable
     * @param boolean $paramLabelSiteDeProduction
     * @return string
     */
    function showListeDeroulanteSiteProdForComposant(HtmlListSelect $paramObjet, $paramIsEditable, $paramLabelSiteDeProduction) {

//        $ftaModel = new FtaModel($paramIdFta);
//        $siteDeProductionFta = $ftaModel->getDataField(FtaModel::FIELDNAME_SITE_ASSEMBLAGE)->getFieldValue();
        $arraySite = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . GeoModel::KEYNAME . ',' . GeoModel::FIELDNAME_GEO
                        . ' FROM ' . GeoModel::TABLENAME
                        . ' WHERE ' . GeoModel::FIELDNAME_TAG_APPLICATION_GEO . ' LIKE  \'%fta%\''
                        . ' ORDER BY ' . GeoModel::FIELDNAME_GEO
        );

        $paramObjet->setArrayListContent($arraySite);

        $HtmlTableName = FtaComposantModel::TABLENAME
                . '_'
                . $paramLabelSiteDeProduction
                . '_'
                . $this->getFtaComposantModel()->getKeyValue()
        ;
        $arraySiteComposant = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . $paramLabelSiteDeProduction
                        . ' FROM ' . FtaComposantModel::TABLENAME
                        . ' WHERE ' . FtaComposantModel::KEYNAME . '=' . $this->getFtaComposantModel()->getKeyValue()
        );
        foreach ($arraySiteComposant as $value) {
            $SiteDeProduction = $value[$paramLabelSiteDeProduction];
        }

        if ($SiteDeProduction) {
            $paramObjet->setDefaultValue($SiteDeProduction);
        }
//        else {
//            $paramObjet->setDefaultValue($siteDeProductionFta);
//        }
        $paramObjet->getAttributes()->getName()->setValue($paramLabelSiteDeProduction);
        $paramObjet->setLabel(DatabaseDescription::getFieldDocLabel(GeoModel::TABLENAME, GeoModel::FIELDNAME_GEO));
        $paramObjet->setIsEditable($paramIsEditable);
        $paramObjet->initAbstractHtmlSelect(
                $HtmlTableName
                , $paramObjet->getLabel()
                , $this->getFtaComposantModel()->getDataField($paramLabelSiteDeProduction)->getFieldValue()
                , $this->getFtaComposantModel()->getDataField($paramLabelSiteDeProduction)->isFieldDiff()
                , $paramObjet->getArrayListContent()
        );
        $paramObjet->getEventsForm()->setOnChangeWithAjaxAutoSave(
                FtaComposantModel::TABLENAME
                , FtaComposantModel::KEYNAME
                , $this->getFtaComposantModel()->getKeyValue()
                , $paramLabelSiteDeProduction);
        $listeSiteProduction = $paramObjet->getHtmlResult();

        return $listeSiteProduction;
    }

    /**
     * Liste des étiqettes recto
     * @param boolean $paramIsEditable
     * @return string
     */
    function getListeCodesoftEtiquettesRecto($paramIsEditable) {

        $HtmlList = new HtmlListSelect();

        $arrayEtiquette = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . CodesoftEtiquettesModel::KEYNAME . ',' . CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES
                        . ' FROM ' . CodesoftEtiquettesModel::TABLENAME
                        . ' WHERE (' . CodesoftEtiquettesModel::FIELDNAME_K_SITE . '=' . $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_SITE_PRODUCTION)->getFieldValue()
                        . ' OR ' . CodesoftEtiquettesModel::FIELDNAME_K_SITE . '=0)'
                        . ' AND (' . CodesoftEtiquettesModel::FIELDNAME_K_TYPE_ETIQUETTE_CODESOFT_ETIQUETTES . '=2'
                        . ' OR ' . CodesoftEtiquettesModel::FIELDNAME_K_TYPE_ETIQUETTE_CODESOFT_ETIQUETTES . '=0' . ')'
                        . ' AND ' . CodesoftEtiquettesModel::FIELDNAME_IS_ENABLED_FTA . '=1'
                        . ' ORDER BY ' . CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES
        );

        $HtmlList->setArrayListContent($arrayEtiquette);

        $HtmlTableName = FtaComposantModel::TABLENAME
                . '_'
                . FtaComposantModel::FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION
                . '_'
                . $this->getFtaComposantModel()->getKeyValue()
        ;
        $HtmlList->getAttributes()->getName()->setValue(FtaComposantModel::FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION);
        $HtmlList->setLabel(DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION));
        $HtmlList->setIsEditable($paramIsEditable);
        $HtmlList->initAbstractHtmlSelect(
                $HtmlTableName
                , $HtmlList->getLabel()
                , $this->getFtaComposantModel()->getDataField(FtaComposantModel::FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION)->getFieldValue()
                , $this->getFtaComposantModel()->getDataField(FtaComposantModel::FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION)->isFieldDiff()
                , $HtmlList->getArrayListContent());
        $HtmlList->getEventsForm()->setOnChangeWithAjaxAutoSave(
                FtaComposantModel::TABLENAME
                , FtaComposantModel::KEYNAME
                , $this->getFtaComposantModel()->getKeyValue()
                , FtaComposantModel::FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION
        );
        $listeCodesoftEtiquettes = $HtmlList->getHtmlResult();

        return $listeCodesoftEtiquettes;
    }

    /**
     * Liste des étiqettes verso 
     * @param boolean $paramIsEditable
     * @return string
     */
    function getListeCodesoftEtiquettesVerso($paramIsEditable) {
        $HtmlList = new HtmlListSelect();

        $arrayEtiquette = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . CodesoftEtiquettesModel::KEYNAME . ',' . CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES
                        . ' FROM ' . CodesoftEtiquettesModel::TABLENAME
                        . ' WHERE (' . CodesoftEtiquettesModel::FIELDNAME_K_SITE . '=' . $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_SITE_PRODUCTION)->getFieldValue()
                        . ' OR ' . CodesoftEtiquettesModel::FIELDNAME_K_SITE . '=0)'
                        . ' AND (' . CodesoftEtiquettesModel::FIELDNAME_K_TYPE_ETIQUETTE_CODESOFT_ETIQUETTES . '=3'
                        . ' OR ' . CodesoftEtiquettesModel::FIELDNAME_K_TYPE_ETIQUETTE_CODESOFT_ETIQUETTES . '=0' . ')'
                        . ' AND ' . CodesoftEtiquettesModel::FIELDNAME_IS_ENABLED_FTA . '=1'
                        . ' ORDER BY ' . CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES
        );

        $HtmlList->setArrayListContent($arrayEtiquette);

        $HtmlTableName = FtaComposantModel::TABLENAME
                . '_'
                . FtaComposantModel::FIELDNAME_K_ETIQUETTE_VERSO_FTA_COMPOSITION
                . '_'
                . $this->getFtaComposantModel()->getKeyValue()
        ;
        $HtmlList->getAttributes()->getName()->setValue(FtaComposantModel::FIELDNAME_K_ETIQUETTE_VERSO_FTA_COMPOSITION);
        $HtmlList->setLabel(DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_K_ETIQUETTE_VERSO_FTA_COMPOSITION));
        $HtmlList->setIsEditable($paramIsEditable);
        $HtmlList->initAbstractHtmlSelect(
                $HtmlTableName
                , $HtmlList->getLabel()
                , $this->getFtaComposantModel()->getDataField(FtaComposantModel::FIELDNAME_K_ETIQUETTE_VERSO_FTA_COMPOSITION)->getFieldValue()
                , $this->getFtaComposantModel()->getDataField(FtaComposantModel::FIELDNAME_K_ETIQUETTE_VERSO_FTA_COMPOSITION)->isFieldDiff()
                , $HtmlList->getArrayListContent());
        $HtmlList->getEventsForm()->setOnChangeWithAjaxAutoSave(
                FtaComposantModel::TABLENAME
                , FtaComposantModel::KEYNAME
                , $this->getFtaComposantModel()->getKeyValue()
                , FtaComposantModel::FIELDNAME_K_ETIQUETTE_VERSO_FTA_COMPOSITION);
        $listeCodesoftEtiquettes = $HtmlList->getHtmlResult();

        return $listeCodesoftEtiquettes;
    }

    /**
     * Liste des options étiqettes
     * @param boolean $paramIsEditable
     * @return string
     */
    function getListeModeEtiquette($paramIsEditable) {
        $HtmlList = new HtmlListSelect();
        $activationCodification = $this->getFtaModel()->getDataField(FtaModel::FIELDNAME_ACTIVATION_CODESOFT)->getFieldValue();
        $codePSFValue = $this->getFtaComposantModel()->getDataField(FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE)->getFieldValue();
        if (($activationCodification == "2" or $activationCodification == "3") and $codePSFValue) {
            $sqlCondi = " ";
        } else {
            $sqlCondi = " WHERE " . AnnexeModeEtiquetteModel::FIELDNAME_ETIQUETTE_ACTIF . "=0 ";
        }
        $sql = "SELECT " . AnnexeModeEtiquetteModel::KEYNAME . "," . AnnexeModeEtiquetteModel::FIELDNAME_MODE_ETIQUETTE_LABEL
                . " FROM " . AnnexeModeEtiquetteModel::TABLENAME
                . $sqlCondi
                . "  ORDER BY " . AnnexeModeEtiquetteModel::FIELDNAME_MODE_ETIQUETTE_NOM . "";
        $arrayModeEtiquette = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        $sql
        );

        $HtmlList->setArrayListContent($arrayModeEtiquette);

        $HtmlTableName = FtaComposantModel::TABLENAME
                . '_'
                . FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION
                . '_'
                . $this->getFtaComposantModel()->getKeyValue()
        ;
        $HtmlList->getAttributes()->getName()->setValue(FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION);
        $HtmlList->setLabel(DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION));
        $HtmlList->setIsEditable($paramIsEditable);
        $HtmlList->initAbstractHtmlSelect(
                $HtmlTableName
                , $HtmlList->getLabel()
                , $this->getFtaComposantModel()->getDataField(FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION)->getFieldValue()
                , $this->getFtaComposantModel()->getDataField(FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION)->isFieldDiff()
                , $HtmlList->getArrayListContent());
        $HtmlList->getEventsForm()->setOnChangeWithAjaxAutoSave(
                FtaComposantModel::TABLENAME
                , FtaComposantModel::KEYNAME
                , $this->getFtaComposantModel()->getKeyValue()
                , FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION);
        $listeModeEtiquettes = $HtmlList->getHtmlResult();

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
        $codePSF->setLabel(DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE));
        $codePSF->getAttributes()->getValue()->setValue($codePSFValue);
        $codePSF->getAttributes()->getPattern()->setValue("[0-9]{1,6}");
        $codePSF->getAttributes()->getMaxLength()->setValue("6");
        $codePSF->setIsEditable($this->getIsEditable());
        $codePSF->initAbstractHtmlInput(
                $HtmlTableName
                , $codePSF->getLabel()
                , $codePSFValue
                , $this->getFtaComposantModel()->getDataField(FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE)->isFieldDiff()
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
