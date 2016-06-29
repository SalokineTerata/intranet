<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HtmlInputCalendar
 *
 * @author bs4300280
 */
class HtmlInputCalendar extends AbstractHtmlInput {

    const DEFAULT_SIZE = 10;

    public function __construct() {
        parent::__construct();
        parent::getAttributes()->getInputType()->setText();
        parent::getAttributes()->getSize()->setValue(self::DEFAULT_SIZE);
    }

    function setHtmlResultOnClick() {
        $fieldName = $this->getAttributes()->getName()->getValue();
        $htmlResultOnClick = "onclick=\"displayCalendar(document.forms['form_action']." . $fieldName . ",'yyyy-mm-dd',this)\" ";
        $this->getEventsMouse()->setOnClick($htmlResultOnClick);
    }

}
