<?php

/*
 * To change this template, choose Tools | Templates
 */

/**
 * Description of HtmlTextArea
 *
 * @author bs4300280
 */
class HtmlTextarea extends AbstractHtmlGlobalElement {

    const DEFAULT_ROWS_SIZE = 15;
    const DEFAULT_COLS_SIZE = 60;

    /**
     * Object manipulant les attributs possible pour cet élément HTML
     * @var AttributesTextArea
     */
    private $attributesTextarea;

    /**
     * 
     * @return AttributesInput
     */
    public function getAttributesTextarea() {
        return $this->attributesTextarea;
    }

    public function setAttributesTextarea(AttributesTextArea $paramAttributesTextarea) {
        $this->attributesTextarea = $paramAttributesTextarea;
    }

    public function __construct() {
        parent::__construct();
        $this->setAttributesTextarea(new AttributesTextArea());
        $this->getAttributesTextarea()->setCols(self::DEFAULT_COLS_SIZE);
        $this->getAttributesTextarea()->setRows(self::DEFAULT_ROWS_SIZE);
    }

//    function __construct(
//    $field, $table, $value = null, $is_editable = false, $warning_update = null, $rows_size = null, $cols_size = null, $label = null, $viewed_content = null) {
//
//        //Définition des propriété spécifique à cette classe
//        $this->setRowsSize($rows_size);
//        $this->setColsSize($cols_size);
//
//        //Déclaration des propriétés générique (classe parent)
//        //parent::initObject($field, $table, $value, $is_editable, $warning_update, $label, $viewed_content);
//    }
//    public function setRowsSize($rows_size = null) {
//        if ($rows_size == null)
//            $rows_size = self::$DEFAULT_ROWS_SIZE;
//        $this->rows_size = $rows_size;
//        return $this->rows_size;
//    }
//
//    public function setColsSize($cols_size = null) {
//        if ($cols_size == null)
//            $cols_size = self::$DEFAULT_COLS_SIZE;
//        $this->cols_size = $cols_size;
//        return $this->cols_size;
//    }
//    function getHtmlEditableContent() {
//        $return = "<textarea name=" . $this->fieldName . " rows=" . $this->rows_size . " cols=" . $this->cols_size . ">" . Html::showValue($this->attributeValue) . "</textarea>";
//
//
//
//        return $return;
//    }
    function getHtmlEditableContent() {

        $name = $this->getAttributesInput()->getName();
        $value = $this->getAttributesInput()->getValue();
        $size = $this->getAttributesInput()->getSize();
        $maxlength = $this->getAttributesInput()->getMaxLength();

        $id = $this->getIdToHtmlData();
        $htmlIconMenu = $this->getHtmlIconMenu();
        $htmlOnChange = $this->getEventsForm()->getOnChange();
        $htmlOnClick = $this->getEventsMouse()->getOnClick();

        return "<input type=text "
                . $id . " "
                . $htmlOnChange . " "
                . $htmlOnClick . " "
                . "name=" . $name . " "
                . "value=" . Html::inputValue($value) . " "
                . "size=" . $size . " "
                . "maxlength=" . $maxlength . " "
                . "/>"
                . $htmlIconMenu
        ;
    }

    public function getHtmlViewedContent() {
        
    }

}

?>
