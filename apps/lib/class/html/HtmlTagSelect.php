<?php

/**
 * Objet représentant une liste déroulante HTML <select>
 *
 * @author salokine@gmail.com
 * @license see LICENSE.TXT at the root of this project
 * @version 1.0
 */
class HtmlTagSelect  {

    /**
     * Valeur à définir lorsqu'on souhaite désactiver un attribut
     */
    const UNSET_VALUE = NULL;

    /**
     * Attribut autofocus
     * Supported: HTML 5
     * Specifies that the drop-down list should automatically
     * get focus when the page loads
     * @link http://www.w3schools.com/tags/att_select_autofocus.asp Documentation
     * @var mixed autofocus="autofocus" | ""
     */
    protected $attributeAutofocus;

    const ATTRIBUTE_AUTOFOCUS_NAME = "autofocus";
    const ATTRIBUTE_AUTOFOCUS_VALUE = "autofocus";

    /**
     * Attribut disabled 
     * Specifies that a drop-down list should be disabled
     * @link http://www.w3schools.com/tags/att_select_disabled.asp Documentation
     * @var mixed disabled="disabled" | ""
     */
    protected $attributeDisabled;

    const ATTRIBUTE_DISABLED_NAME = "disabled";
    const ATTRIBUTE_DISABLED_VALUE = "disabled";

    /**
     * Attribut form
     * Supported: HTML 5
     * Defines one or more forms the select field belongs to
     * @link http://www.w3schools.com/tags/att_select_form.asp Documentation
     * @var mixed Specifies a space-separated list of id's to one or more forms the drop-down list belongs to
     */
    protected $attributeForm;

    const ATTRIBUTE_FORM_NAME = "form";

    /**
     * Attribut multiple
     * Specifies that multiple options can be selected at once
     * @link http://www.w3schools.com/tags/att_select_multiple.asp Documentation
     * @var mixed multiple="multiple" | ""
     */
    protected $attributeMultiple;

    const ATTRIBUTE_MULTIPLE_NAME = "multiple";
    const ATTRIBUTE_MULTIPLE_VALUE = "multiple";

    /**
     * Attribut name
     * Defines a name for the drop-down list
     * @link http://www.w3schools.com/tags/att_select_name.asp Documentation
     * @var mixed text
     */
    protected $attributeName;

    const ATTRIBUTE_NAME_NAME = "name";

    /**
     * Attribut Required
     * Supported: HTML 5
     * Specifies that the user is required to select a value before
     * submitting the form
     * @link http://www.w3schools.com/tags/att_select_required.asp Documentation
     * @var mixed required="required" | ""
     */
    protected $attributeRequired;

    const ATTRIBUTE_REQUIRED_NAME = "required";
    const ATTRIBUTE_REQUIRED_VALUE = "required";

    /**
     * Attribut size
     * Defines the number of visible options in a drop-down list
     * @link http://www.w3schools.com/tags/att_select_size.asp Documentation
     * @var mixed size="number" | ""
     */
    protected $attributeSize;

    const ATTRIBUTE_SIZE_NAME = "size";

    /**
     * Tableau de tag option
     * @var array tableau d'objet de type HtmlTagOption
     */
    protected $arrayHtmlTagOption;

    /**
     * Retourne le code HTML de la balise Select
     */
    public function getHtmlResult() {

        $return = "<select ";
        $return .= parent::getAllGlobalHtmlParameters();
        $return .= $this->getAllHtmlParameters();
        $return .= ">";

        $value = new HtmlTagOption();
        foreach ($this->getArrayHtmlTagOption() as $value) {
            $return.= $value->getHtmlResult();
        }
        $return .= "</select>";
        return $return;
    }

    /**
     * Ajoute un tag <option> dans la liste <select>
     * @param HtmlTagOption $paramHtmlTagOption
     */
    public function addHtmlTagOption(HtmlTagOption $paramHtmlTagOption) {

        /**
         * Récupération du tableau actuel
         * Si il n'y a pas de valeur actuellement dans le tableau, 
         * celui est NULL
         * On le force dans ce cas en tant que tableau
         */
        if ($this->getArrayHtmlTagOption() != NULL) {
            $array = $this->getArrayHtmlTagOption();
        } else {
            $array = array();
        }

        /**
         * Ajout du nouvel élément
         */
        $array[] = $paramHtmlTagOption;

        /**
         * Reclassement alphabétique et enregistrement du tableau
         */
        asort($array);
        /**
         * Reclassement alphabétique et enregistrement du tableau
         */
        $this->setArrayHtmlTagOption($array);
    }

    public function getAllHtmlParametersWithSpaceBefore() {
        $data = $this->getAllHtmlParameters();
        $return = NULL;
        if ($data != NULL) {
            $return = " " . $data;
        }

        return $return;
    }

    public function getAllHtmlParameters() {
        return $this->getAutofocusForHtmlParameter()
                . $this->getDisabledForHtmlParameter()
                . $this->getFormForHtmlParameter()
                . $this->getMultipleForHtmlParameter()
                . $this->getNameForHtmlParameter()
                . $this->getRequiredForHtmlParameter()
                . $this->getSizeForHtmlParameter()
        ;
    }

    /**
     * Retourne la valeur de l'attibut autofocus
     * @return mixed
     */
    public function getAttributeAutofocus() {
        return $this->attributeAutofocus;
    }

    /**
     * Retourne l'attribut autofocus pour être inséré dans du code HTML
     * @return mixed name="value"
     */
    public function getAutofocusForHtmlParameter() {
        return Html::getHtmlParameter(self::ATTRIBUTE_AUTOFOCUS_NAME, $this->getAttributeAutofocus());
    }

    /**
     * Active l'attribut autofocus
     */
    public function setAttributeAutofocus() {
        $this->attributeAutofocus = self::ATTRIBUTE_AUTOFOCUS_VALUE;
    }

    /**
     * Désactive l'attribut autofocus
     */
    public function unsetAttributeAutofocus() {
        $this->attributeAutofocus = self::UNSET_VALUE;
    }

    /**
     * Retourne la valeur de l'attribut disabled
     * @return mixed
     */
    public function getAttributeDisabled() {
        return $this->attributeDisabled;
    }

    /**
     * Retourne l'attribut disabled pour être inséré dans du code HTML
     * @return mixed name="value"
     */
    public function getDisabledForHtmlParameter() {
        return Html::getHtmlParameter(self::ATTRIBUTE_DISABLED_NAME, $this->getAttributeDisabled());
    }

    /**
     * Active l'attribut disabled
     */
    public function setAttributeDisabled() {
        $this->attributeDisabled = self::ATTRIBUTE_DISABLED_VALUE;
    }

    /**
     * Désactive l'attribut disabled
     */
    public function unsetAttributeDisabled() {
        $this->attributeDisabled = self::UNSET_VALUE;
    }

    /**
     * Retourne la valeur de l'attribut form
     * @return mixed form_id
     */
    public function getAttributeForm() {
        return $this->attributeForm;
    }

    /**
     * Retourne l'attribut forme pour être inséré dans du code HTML
     * @return mixed name="value"
     */
    public function getFormForHtmlParameter() {
        return Html::getHtmlParameter(self::ATTRIBUTE_FORM_NAME, $this->getAttributeForm());
    }

    /**
     * Défini la valeur de l'attribut form
     * @param mixed $attributeForm
     */
    public function setAttributeForm($attributeForm) {
        $this->attributeForm = $attributeForm;
    }

    /**
     * Désactive l'attribut form
     */
    public function unsetAttributeForm() {
        $this->attributeForm = self::UNSET_VALUE;
    }

    /**
     * Retourne la veleur de l'attribut multiple
     * @return mixed "multiple" | ""
     */
    public function getAttributeMultiple() {
        return $this->attributeMultiple;
    }

    /**
     * Retourne l'attribut muliple pour être inséré dans du code HTML
     * @return mixed name="value"
     */
    public function getMultipleForHtmlParameter() {
        return Html::getHtmlParameter(self::ATTRIBUTE_MULTIPLE_NAME, $this->getAttributeMultiple());
    }

    /**
     * Active l'attribut multiple
     */
    public function setAttributeMultiple() {
        $this->attributeMultiple = self::ATTRIBUTE_MULTIPLE_VALUE;
    }

    /**
     * Désactive l'attribut multiple
     */
    public function unsetAttributeMultiple() {
        $this->attributeMultiple = self::UNSET_VALUE;
    }

    /**
     * Retourne la valeur de l'attribut name
     * @return mixed
     */
    public function getAttributeName() {
        return $this->attributeName;
    }

    /**
     * Retourne l'attribut name pour être inséré dans du code HTML
     * @return mixed name="value"
     */
    public function getNameForHtmlParameter() {
        return Html::getHtmlParameter(self::ATTRIBUTE_NAME_NAME, $this->getAttributeName());
    }

    /**
     * Défini la valeur de l'attribut name
     * @param string $paramAttributeName
     */
    public function setAttributeName($paramAttributeName) {

        if (is_string($paramAttributeName)) {
            $this->attributeName = $paramAttributeName;
        }else {
            trigger_error("L'attribut \"name\" doit être de type String.", E_USER_ERROR);
        }
            
    }

    /**
     * Désactive l'attribut name
     */
    public function unsetAttributeName() {
        $this->attributeName = self::UNSET_VALUE;
    }

    /**
     * Retourne la valeur de l'attribut required
     * @return mixed "required" | ""
     */
    public function getAttributeRequired() {
        return $this->attributeRequired;
    }

    /**
     * Retourne l'attribut required pour être inséré dans du code HTML
     * @return mixed name="value"
     */
    public function getRequiredForHtmlParameter() {
        return Html::getHtmlParameter(self::ATTRIBUTE_REQUIRED_NAME, $this->getAttributeRequired());
    }

    /**
     * Active l'attribut required
     */
    public function setAttributeRequired() {
        $this->attributeRequired = self::ATTRIBUTE_REQUIRED_VALUE;
    }

    /**
     * Désactive l'attribut required
     */
    public function unsetAttributeRequired() {
        $this->attributeRequired = self::UNSET_VALUE;
    }

    /**
     * Retourne la valeur de l'attribut size
     * @return mixed
     */
    public function getAttributeSize() {
        return $this->attributeSize;
    }

    /**
     * Retourne l'attribut size pour être inséré dans du code HTML
     * @return mixed name="value"
     */
    public function getSizeForHtmlParameter() {
        return Html::getHtmlParameter(self::ATTRIBUTE_SIZE_NAME, $this->getAttributeSize());
    }

    /**
     * Défini la valeur de l'attribut size
     * @param mixed $paramAttributeSize
     */
    public function setAttributeSize($paramAttributeSize) {
        $this->attributeSize = $paramAttributeSize;
    }

    /**
     * Désactive l'attribut size
     */
    public function unsetAttributeSize() {
        $this->attributeSize = self::UNSET_VALUE;
    }

    /**
     * Retourne le tableau d'objet HtmlTagOption
     * @return array HtmlTagOption
     */
    public function getArrayHtmlTagOption() {
        return $this->arrayHtmlTagOption;
    }

    /**
     * Défini le tableau d'objet HtmlTagOption
     * @param array $arrayHtmlTagOption tableau d'objet HtmlTagOption
     */
    public function setArrayHtmlTagOption($arrayHtmlTagOption) {
        $this->arrayHtmlTagOption = $arrayHtmlTagOption;
    }

    /**
     * Défini le tableau d'objet HtmlTagOption à partir d'un simple tableau PHP
     * @param array $arrayHtmlTagOptionFromPhpArray
     */
    public function setArrayHtmlTagOptionFromPhpArray($arrayHtmlTagOptionFromPhpArray) {
        foreach ($arrayHtmlTagOptionFromPhpArray as $key => $value) {
            $htmlTagOption = new HtmlTagOption();
            $htmlTagOption->setAttributeValue($key);
            $htmlTagOption->setAttributeLabel($value);
            $this->addHtmlTagOption($htmlTagOption);
        }
    }

    /**
     * Désactive le tableau d'objet HtmlTagOption
     */
    public function unsetArrayHtmlTagOption() {
        $this->arrayHtmlTagOption = self::UNSET_VALUE;
    }

}

?>
