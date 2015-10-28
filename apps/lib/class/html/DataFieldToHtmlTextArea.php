
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataFieldToHtmlTextArea
 *
 * @author bs4300280
 */
class DataFieldToHtmlTextArea extends HtmlTextArea {

    use TraitDataFieldToHtml;

    function __construct(DatabaseDataField $paramDataField) {

        $this->setDataField($paramDataField);

        //Déclaration des propriétés générique (classe parent)
        parent::__construct();
        $this->initObject(
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
    }

}

?>
