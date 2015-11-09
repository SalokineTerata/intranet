<?php

/*
 * To change this template, choose Tools | Templates
 */

/**
 * Description of HtmlTextArea
 *
 * @author bs4300280
 */
class HtmlTextArea extends AbstractHtmlGlobalElement {

    const DEFAULT_ROWS_SIZE = 15;
    const DEFAULT_COLS_SIZE = 60;

    /**
     * Contenu du TextArea
     * @var mixed
     */
    private $textAreaContent;

    /**
     * Object manipulant les attributs possible pour cet élément HTML
     * @var AttributesTextArea
     */
    private $attributes;

    public function __construct() {
        parent::__construct();
        $this->setAttributes(new AttributesTextArea());
        $this->getAttributes()->getCols()->setValue(self::DEFAULT_COLS_SIZE);
        $this->getAttributes()->getRows()->setValue(self::DEFAULT_ROWS_SIZE);
    }

    protected function initObject(
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
        $this->setTextAreaContent($paramValue);
    }

    /**
     * 
     * @return AttributesTextArea
     */
    public function getAttributes() {
        return $this->attributes;
    }

    public function setAttributes(AttributesTextArea $paramAttributesTextarea) {
        $this->attributes = $paramAttributesTextarea;
    }

    public function getTextAreaContent() {
        return $this->textAreaContent;
    }

    public function setTextAreaContent($textAreaContent) {
        $this->textAreaContent = $textAreaContent;
    }

    function getHtmlEditableContent() {

        return '<' . $this->getAttributes()->getTagName()
                . parent::getAttributesGlobal()->getAllHtmlParametersWithSpaceBefore()
                . parent::getEventsForm()->getAllHtmlParametersWithSpaceBefore()
                . parent::getEventsMouse()->getAllHtmlParametersWithSpaceBefore()
                . $this->getAttributes()->getAllHtmlParametersWithSpaceBefore()
                . '/>'
                . $this->getTextAreaContent()
                . '</' . $this->getAttributes()->getTagName() . '>'
//                . parent::getAttributesGlobal()->getIconMenuToHtml()
        ;
    }

    public function getHtmlViewedContent() {
        return nl2br(Html::showValue($this->getTextAreaContent()));
    }
    public function getHtmlAddContent() {
        return ;
    }

}

?>
