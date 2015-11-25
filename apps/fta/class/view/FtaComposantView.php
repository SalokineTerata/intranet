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
     * 
     * @param FtaComposantModel $ParamFtaComposantModel
     */
    public function __construct(FtaComposantModel $ParamFtaComposantModel) {
        $this->setFtaComposantModel($ParamFtaComposantModel);
    }

    private function getFtaComposantModel() {
        return $this->FtaComposantModel;
    }

    private function setFtaComposantModel(FtaComposantModel $FtaComposantModel) {
        if ($FtaComposantModel instanceof FtaComposantModel) {
            $this->FtaComposantModel = $FtaComposantModel;
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

    public function getHtmlCodePSF() {
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
        $codePSF->initAbstractHtmlInput($HtmlTableName, $codePSF->getLabel(), $codePSFValue, NULL);
        $codePSF->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaComposantModel::TABLENAME, FtaComposantModel::KEYNAME, $id_fta_composant, FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE);
        return $codePSF->getHtmlResult();
    }

}
