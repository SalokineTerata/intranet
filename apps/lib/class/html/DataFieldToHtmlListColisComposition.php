<?php

/**
 * Description of HtmlList
 *
 * @author tp4300008
 */
class DataFieldToHtmlListColisComposition extends HtmlListColisComposition {

    use TraitDataFieldToHtml;

    function __construct(DatabaseDataField $paramDataField) {

        $this->setDataField($paramDataField);

        parent::__construct();
        parent::initAbstractHtmlSelect(
                $this->getHtmlName()
                , $this->getDataField()->getFieldLabel()
                , $this->getDataField()->getFieldValue()
                , $this->getDataField()->isFieldDiff()
                , HtmlListColisComposition::getArrayListContentColisComposition()
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
        switch ($this->selected_value) {
            case
            $return = Html::showValue(self::NO_LABEL);
                break;
            case
            $return = Html::showValue(self::COLIS_LABEL);
                break;
            case
            $return = Html::showValue(self::COMPOSITION_LABEL);
                break;
            case
            $return = Html::showValue(self::BOTH_LABEL);
                break;
        }
        return $return;
    }

}
