<?php

/**
 * Description of FtaComposantView
 *
 * @author franckwastaken
 */
class FtaComposantView  {

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

}
