<?php

/*
 * Copyright (C) 2014 salokine
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Description of HtmlStandardTagOption
 *
 * @author salokine
 */
class HtmlStandardTagOption extends AbstractAllHtmlParameters implements InterfaceHtmlStandardTag {

    const TAG_NAME = 'option';

    /**
     *
     * @var AttributeDisabled 
     */
    private $disabled;

    /**
     *
     * @var AttributeLabel
     */
    private $label;

    /**
     *
     * @var AttributeSelected
     */
    private $selected;

    /**
     *
     * @var AttributeValue
     */
    private $value;

    function __construct() {

        $this->setDisabled(new AttributeDisabled);
        $this->setLabel(new AttributeLabel());
        $this->setSelected(new AttributeSelected());
        $this->setValue(new AttributeValue());
    }

    public function getAllHtmlParameters() {
        return $this->getDisabled()->getToHtml()
                . $this->getLabel()->getToHtml()
                . $this->getSelected()->getToHtml()
                . $this->getValue()->getToHtml()
        ;
    }

    public function getTagName() {
        return self::TAG_NAME;
    }

    /**
     * 
     * @return AttributeDisabled
     */
    public function getDisabled() {
        return $this->disabled;
    }

    /**
     * 
     * @return AttributeLabel
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * 
     * @return AttributeSelected
     */
    public function getSelected() {
        return $this->selected;
    }

    /**
     * 
     * @return AttributeValue
     */
    public function getValue() {
        return $this->value;
    }

    public function setDisabled(AttributeDisabled $disabled) {
        $this->disabled = $disabled;
    }

    public function setLabel(AttributeLabel $label) {
        $this->label = $label;
    }

    public function setSelected(AttributeSelected $selected) {
        $this->selected = $selected;
    }

    public function setValue(AttributeValue $value) {
        $this->value = $value;
    }

}
