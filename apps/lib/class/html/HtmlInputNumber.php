<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HtmlInputNumber
 *
 * @author bs4300280
 */
class HtmlInputNumber extends AbstractHtmlInput {

    private $size;
    private $maxlength;
    private static $DEFAULT_SIZE = 20;

    public function initGlobalElement(
    $field, $table, $value = null, $is_editable = false, $warning_update = null, $size = null, $maxlength = null, $label = null, $viewed_content = null) {

        //Définition des propriété spécifique à cette classe
        $this->setSize($size);
        $this->setMaxLength($maxlength);

        //Déclaration des propriétés générique (classe parent)
        parent::initHtmlObject($field_name, $label, $default_value, $warning_update);
    }

    public function setSize($size = null) {
        if ($size == null)
            $size = self::$DEFAULT_SIZE;
        $this->size = $size;
        return $this->size;
    }

    public function setMaxLength($maxlength = null) {
        if ($maxlength == null)
            $maxlength = $this->size;
        $this->maxlength = $maxlength;
        return $this->maxlength;
    }

    function getHtmlEditableContent() {
        return '<input type=text name=' . $this->fieldName . ' value=' . Html::inputValue($this->attributeValue) . ' />';
    }

}

?>
