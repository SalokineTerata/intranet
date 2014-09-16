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

    public function __construct() {
        parent::__construct();
        parent::getAttributes()->getInputType()->setText();
    }

}
