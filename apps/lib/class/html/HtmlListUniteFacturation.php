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
class HtmlListUniteFacturation extends HtmlList {

    const PIECE_LABEL = "Pièce";
    const PIECE_VALUE = 1;
    const KG_LABEL = "Kilo";
    const KG_VALUE = 2;

    public function __construct() {
        parent::__construct();
        parent::setArrayHtmlTagOptionFromPhpArray(self::getArrayListContentUniteFacturation());
    }

    public function getHtmlViewedContent() {
        $return = "";
        if ($this->selected_value) {
            $return = Html::showValue(self::PIECE_LABEL);
        } else {
            $return = Html::showValue(self::KG_LABEL);
        }
        return $return;
    }

    static public function getArrayListContentUniteFacturation() {
        return array(
            self::KG_VALUE => self::KG_LABEL,
            self::PIECE_VALUE => self::PIECE_LABEL
        );
    }

}

?>