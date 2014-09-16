<?php

/**
 * Tag HTML option
 * 
 * http://www.w3schools.com/tags/tag_option.asp
 *
 * @author salokine.terata@gmail.com
 * @license see LICENSE.TXT at the root of this project
 * @version 1.0
 */
class HtmlTagOption {

    /**
     * Valeur à définir lorsqu'on souhaite désactiver un attribut
     */
    const UNSET_VALUE = NULL;

    /**
     * Object manipulant les attributs possible pour cet élément HTML
     * @var AttributesOption
     */
    private $attributes;

    /**
     *
     * @var mixed 
     */
    private $diplayValue;

    function __construct() {
        $this->setAttributes(new AttributesOption());
    }

    /**
     * 
     * @return AttributesOption
     */
    public function getAttributes() {
        return $this->attributes;
    }

    public function setAttributes(AttributesOption $attributes) {
        $this->attributes = $attributes;
    }

    public function getDiplayValue() {
        return $this->diplayValue;
    }

    public function getDiplayValueToHtml() {
        return Html::showValue($this->diplayValue);
    }

    public function setDiplayValue($diplayValue) {
        $this->diplayValue = $diplayValue;
    }

}

?>
