
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
class DataFieldToHtmlInputText extends HtmlInputText {

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
        );
        $this->getEventsForm()->setOnChangeWithAjaxAutoSave(
                $this->getDataField()->getTableName()
                , $this->getDataField()->getKeyName()
                , $this->getDataField()->getKeyValue()
                , $this->getDataField()->getFieldName()
        );
       
        /**
         * Taille spécifique du champs si renseignée.
         */
        $this->setSpecificFieldSize();
    }

    /**
     * Si une taille de champs a été précisée dans intranet_column_info
     * Alors, on utilise cette valeur au lieu de la valeur 
     * par défaut HtmlInputText::DEFAULT_SIZE
     */
    public function setSpecificFieldSize() {
        if ($this->getDataField()->getFieldSizeOfHtmlObject()) {
            $this->getAttributes()->getSize()->setValue($this->getDataField()->getFieldSizeOfHtmlObject());
        }
    }

}
