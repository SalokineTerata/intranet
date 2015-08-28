<script language='php'>

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HtmlInputKg
 *
 * @author bs4300280
 */
class HtmlInputKg extends HtmlInputNumber {

    function getHtmlEditableContent() {
        return '<input type=text name=' . $this->fieldName . ' value=' . Html::inputValue($this->attributeValue) . ' />' . $this->getHtmlValueToGramme($this->attributeValue);
    }

    function getHtmlViewedContent() {
        return Html::showValue($this->attributeValue) . $this->getHtmlValueToGramme($this->attributeValue);
    }

    function getHtmlValueToGramme($value) {
        return '&nbsp;&nbsp;&nbsp; (soit ' . $value * 1000 . 'g)';
    }

}
</script>
