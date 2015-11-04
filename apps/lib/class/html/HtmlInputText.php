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
class HtmlInputText extends AbstractHtmlInput {

    const DEFAULT_SIZE = 25;

    public function __construct() {
        parent::__construct();
        parent::getAttributes()->getInputType()->setText();
        parent::getAttributes()->getSize()->setValue(self::DEFAULT_SIZE);
    }

}
