<?php

/**
 * Description of HtmlList
 *
 * @author bs4300280
 */
class DataFieldToHtmlListSelect extends HtmlListSelect {

    use TraitDataFieldToHtml;

    function __construct(DatabaseDataField $paramDataField) {

        $this->setDataField($paramDataField);

        parent::__construct();
        parent::initAbstractHtmlSelect(
                $this->getHtmlName()
                , $this->getDataField()->getFieldLabel()
                , $this->getDataField()->getFieldValue()
                , $this->getDataField()->isFieldDiff()
                , $this->getDataField()->getFieldContentArray()
                , $this->getDataField()->getDataValidationSuccessful()
                , $this->getDataField()->getDataWarningMessage()
        );

        $this->getEventsForm()->setOnChangeWithAjaxAutoSave(
                $this->getDataField()->getTableName()
                , $this->getDataField()->getKeyName()
                , $this->getDataField()->getKeyValue()
                , $this->getDataField()->getFieldName()
        );
    
        $this->setContentLocked($paramDataField->getFieldsToLock());

    }
        
}

?>
