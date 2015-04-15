<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractHtmlList
 *
 * @author bs4300280
 */
class HtmlListBoolean extends HtmlList {

    const YES_LABEL = "Oui";
    const YES_VALUE = 1;
    const NO_LABEL = "Non";
    const NO_VALUE = 0;

    public function __construct() {
        parent::__construct();
        parent::setArrayHtmlTagOptionFromPhpArray(self::getArrayListContentBoolean());
    }

    public function getHtmlViewedContent() {
        $return = "";
        if ($this->selected_value) {
            $return = Html::showValue(self::YES_LABEL);
        } else {
            $return = Html::showValue(self::NO_LABEL);
        }
        return $return;
    }

    static public function getArrayListContentBoolean() {
        return array(
            self::NO_VALUE => self::NO_LABEL,
            self::YES_VALUE => self::YES_LABEL
        );
    }

}

?>