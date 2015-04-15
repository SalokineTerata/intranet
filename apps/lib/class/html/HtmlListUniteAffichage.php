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
class HtmlListUniteAffichage extends HtmlList {

    const KILO_LABEL = "Kilogramme";
    const KILO_VALUE = 1;
    const GRAM_LABEL = "Gramme";
    const GRAM_VALUE = 2;

    public function __construct() {
        parent::__construct();
        parent::setArrayHtmlTagOptionFromPhpArray(self::getArrayListContentUniteAffichage());
    }

    public function getHtmlViewedContent() {
        $return = "";
        if ($this->selected_value) {
            $return = Html::showValue(self::KILO_LABEL);
        } else {
            $return = Html::showValue(self::GRAM_LABEL);
        }
        return $return;
    }

    static public function getArrayListContentUniteAffichage() {
        return array(
            self::KILO_VALUE => self::KILO_LABEL,
            self::GRAM_VALUE => self::GRAM_LABEL
        );
    }

}

?>