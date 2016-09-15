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
class DataFieldToHtmlInputCalendar extends HtmlInputCalendar {

    use TraitDataFieldToHtml;

    function __construct(DatabaseDataField $paramDataField) {

        $this->setDataField($paramDataField);

        //Déclaration des propriétés générique (classe parent)
        parent::__construct();
        parent::initAbstractHtmlInput(
                $this->getHtmlName()
                , $this->getDataField()->getFieldLabel()
                , $this->getDataField()->getFieldValue()
                , $this->getDataField()->isFieldDiff()
        );
        $this->getEventsForm()->setOnChangeWithAjaxAutoSave(
                $this->getDataField()->getTableName()
                , $this->getDataField()->getKeyName()
                , $this->getDataField()->getKeyValue()
                , $this->getDataField()->getFieldName()
        );
        $this->setHtmlResultOnClick();
        /**
         * Détermine si le datafield encours doit être non éditiable
         */
        $this->setContentLocked($paramDataField->getFieldsToLock());
    }

}

?>
