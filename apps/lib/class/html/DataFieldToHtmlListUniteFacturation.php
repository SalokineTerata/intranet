<?php

/**
 * Description of HtmlList
 *
 * @author tp4300008
 */
class DataFieldToHtmlListUniteFacturation extends HtmlListUniteFacturation {

    use TraitDataFieldToHtml;

    function __construct(DatabaseDataField $paramDataField) {

        $this->setDataField($paramDataField);

        parent::__construct();
        parent::initAbstractHtmlSelect(
                $this->getHtmlName()
                , $this->getDataField()->getFieldLabel()
                , $this->getDataField()->getFieldValue()
                , $this->getDataField()->isFieldDiff()
                , HtmlListUniteFacturation::getArrayListContentUniteFacturation()
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
            $return = Html::showValue(self::PIECE_LABEL);
        } else {
            $return = Html::showValue(self::KG_LABEL);
        }
        return $return;
    }

}
