<?php

/**
 * Description of UserView
 *
 * @author franckwastaken
 */
class UserView  {

    /**
     * Model de donnée d'un Salarie
     * @var UserModel
     */
    private $UserModel;
    
     /**
     * La vue est-elle modifiable par l'utilisateur (saisie) ou simplement
     * en consultation ?
     * @var boolean
     */
    private $isEditable;

    /**
     * 
     * @param UserModel $ParamUserModel
     */
    public function __construct(UserModel $ParamUserModel) {
        $this->setUserModel($ParamUserModel);
    }

    function getUserModel() {
        return $this->UserModel;
    }

    function setUserModel(UserModel $UserModel) {
        if ($UserModel instanceof UserModel) {
            $this->UserModel = $UserModel;
        }
    }
    function getIsEditable() {
        return $this->isEditable;
    }

    function setIsEditable($isEditable) {
        $this->isEditable = $isEditable;
    }

        
    public function getHtmlDataField($paramFieldName) {
        return Html::convertDataFieldToHtml(
                        $this->getUserModel()->getDataField($paramFieldName)
                        , $this->getIsEditable()
        );
    }

}
