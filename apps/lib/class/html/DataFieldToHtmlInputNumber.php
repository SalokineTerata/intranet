
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataFieldToHtmlInputText
 *
 * @author bs4300280
 */
class DataFieldToHtmlInputNumber extends HtmlInputNumber {

    use TraitDataFieldToHtml;

    function __construct(DatabaseDataField $paramDataField) {

        $this->setDataField($paramDataField);

        //Déclaration des propriétés générique (classe parent)
        parent::__construct();
        $this->initAbstractHtmlInput(
                $this->getHtmlName()
                , $this->getDataField()->getFieldLabel()
                , $this->getDataField()->getFieldValue()
                , $this->getDataField()->isFieldDiff()
                , $this->getDataField()->getDataValidationSuccessful()
                , $this->getDataField()->getDataWarningMessage()
                , $this->getDataField()->getIsFieldLock()
                , $this->getDataField()->getLinkFieldLock()
        );
        $this->getEventsForm()->setOnChangeWithAjaxAutoSave(
                $this->getDataField()->getTableName()
                , $this->getDataField()->getKeyName()
                , $this->getDataField()->getKeyValue()
                , $this->getDataField()->getFieldName()
        );
    }

}

?>
