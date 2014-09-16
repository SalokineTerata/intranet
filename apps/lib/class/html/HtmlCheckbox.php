<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HtmlInputText
 *
 * @author bs4300280
 */
class HtmlCheckbox extends AbstractHtmlInput {

    protected $is_checked;
    protected $is_disabled;
    protected $html_checked;
    protected $html_disabled;

    const CHECKED = "checked";
    const DISABLED = "disabled";

    public function initHtmlCheckbox(
    $field_name, $table_name, $default_value = null, $is_editable = false, $warning_update = null, $is_checked = null, $label = null, $viewed_content = null) {

        //Définition des propriété spécifique à cette classe
        $this->setChecked($is_checked);
        $this->setDisabled($is_editable);

        //Déclaration des propriétés générique (classe parent)
        parent::initAbstractHtmlInput($field_name, $label, $default_value, $warning_update);
    }

    public function setChecked($is_checked = null, $value = null) {
        $this->is_checked = $is_checked;
        if ($this->is_checked) {
            $this->html_checked = self::CHECKED;
        } else {
            $this->html_checked = "";
        }

        return $this->is_checked;
    }

    function setDisabled($is_editable = null) {
        if ($is_editable) {
            $this->is_disabled = false;
        } else {
            $this->is_disabled = true;
        }

        if ($this->is_disabled) {
            $this->html_disabled = self::DISABLED;
        } else {
            $this->html_disabled = "";
        }

        return $this->is_disabled;
    }

    function getHtmlEditableContent() {
        //return "<textarea name=" . $this->field . " rows=" . $this->rows_size . " cols=" . $this->cols_size . ">" . Html::showValue($this->value) . "</textarea>";
        return "<input type=checkbox name=" . $this->fieldName . " value=" . Html::showValue($this->attributeValue) . " $this->html_checked $this->html_disabled/>";
    }

}

?>
