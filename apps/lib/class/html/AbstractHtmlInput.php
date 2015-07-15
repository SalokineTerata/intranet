<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractHtmlInputObject
 *
 * @author bs4300280
 */
abstract class AbstractHtmlInput extends AbstractHtmlGlobalElement {

    /**
     * Object manipulant les attributs possible pour cet élément HTML
     * @var AttributesInput
     */
    private $attributes;

    /**
     * 
     * @return AttributesInput
     */
    public function getAttributes() {
        return $this->attributes;
    }

    public function setAttributes(AttributesInput $paramAttributesInput) {
        $this->attributes = $paramAttributesInput;
    }

    public function __construct() {
        parent::__construct();
        $this->setAttributes(new AttributesInput());
    }

    protected function initAbstractHtmlInput(
    $paramName
    , $paramLabel
    , $paramValue
    , $paramIsWarningUpdate
    ) {
        $id = $paramName;
        parent::initAbstractHtmlGlobalElement(
                $id
                , $paramLabel
                , $paramIsWarningUpdate
        );

        $this->getAttributes()->getName()->setValue($paramName);
        $this->getAttributes()->getValue()->setValue($paramValue);
    }

    public function getHtmlViewedContent() {
        return Html::showValue($this->getAttributes()->getValue()->getValue());
    }
    public function getHtmlAddContent() {
        return ;
    }

    function getHtmlEditableContent() {


        return "<" . $this->getAttributes()->getTagName()
                . parent::getAttributesGlobal()->getAllHtmlParametersWithSpaceBefore()
                . parent::getEventsForm()->getAllHtmlParametersWithSpaceBefore()
                . parent::getEventsMouse()->getAllHtmlParametersWithSpaceBefore()
                . $this->getAttributes()->getAllHtmlParametersWithSpaceBefore()
                . "/>"
                . parent::getAttributesGlobal()->getIconMenuToHtml()

        ;
    }

}
