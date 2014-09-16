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
class HtmlInputCalendar extends HtmlInputText {



    function setHtmlResultOnClick() {
        $fieldName = $this->getAttributes()->getName()->getValue();
        $htmlResultOnClick = "onclick=\"displayCalendar(document.forms['form_action']." . $fieldName . ",'yyyy-mm-dd',this)\" ";
        $this->getEventsMouse()->setOnClick($htmlResultOnClick);
    }

}
