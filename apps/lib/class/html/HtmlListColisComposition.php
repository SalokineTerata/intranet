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
class HtmlListColisComposition extends HtmlList {

    const NO_LABEL = "Aucun des deux";
    const NO_VALUE = 0;
    const COLIS_LABEL = "Colis";
    const COLIS_VALUE = 1;
    const COMPOSITION_LABEL = "Composition";
    const COMPOSITION_VALUE = 2;
    const BOTH_LABEL = "Composition et Colis";
    const BOTH_VALUE = 3;

    public function __construct() {
        parent::__construct();
        parent::setArrayHtmlTagOptionFromPhpArray(self::getArrayListContentColisComposition());
    }

    public function getHtmlViewedContent() {
        $return = "";
        switch ($this->selected_value) {
            case
            $return = Html::showValue(self::NO_LABEL);
                break;
            case
            $return = Html::showValue(self::COLIS_LABEL);
                break;
            case
            $return = Html::showValue(self::COMPOSITION_LABEL);
                break;
            case
            $return = Html::showValue(self::BOTH_LABEL);
                break;
        }
        return $return;
    }

    static public function getArrayListContentColisComposition() {
        return array(
            self::NO_VALUE => self::NO_LABEL,
            self::COLIS_VALUE => self::COLIS_LABEL,
            self::COMPOSITION_VALUE => self::COMPOSITION_LABEL,
            self::BOTH_VALUE => self::BOTH_LABEL
        );
    }

}

?>
