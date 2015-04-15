<?php

/* 
 * Copyright (C) 2015 tp4300008
 *<?php

/**
 * Description of HtmlList
 *
 * @author tp4300008
 */
class DataFieldToHtmlListUniteAffichage extends HtmlListUniteAffichage {

    use TraitDataFieldToHtml;

    function __construct(DatabaseDataField $paramDataField) {

        $this->setDataField($paramDataField);

        parent::__construct();
        parent::initAbstractHtmlSelect(
                $this->getHtmlName()
                , $this->getDataField()->getFieldLabel()
                , $this->getDataField()->getFieldValue()
                , $this->getDataField()->isFieldDiff()
                , HtmlListUniteAffichage::getArrayListContentUniteAffichage()
        );

        $this->getEventsForm()->setOnChangeWithAjaxAutoSave(
                $this->getDataField()->getTableName()
                , $this->getDataField()->getKeyName()
                , $this->getDataField()->getKeyValue()
                , $this->getDataField()->getFieldName()
        );
    }

    public function getHtmlViewedContent() {
        $return = "";
        if ($this->selected_value) {
            $return = Html::showValue(self::KILO_LABEL);
        } else {
            $return = Html::showValue(self::GRAM_LABEL);
        }
        return $return;
    }

}


