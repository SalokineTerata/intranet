<?php

/*
 * Copyright (C) 2014 Boris Sanègre <boris.sanegre@ldc.fr>
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
 * Element select
 * @link http://www.w3schools.com/tags/tag_select.asp description
 * @author Boris Sanègre <boris.sanegre@ldc.fr>
 * @license see LICENSE.TXT at the root of this project
 */
class HtmlStandardTagSelect extends AbstractAllHtmlParameters implements InterfaceHtmlStandardTag {

    const TAG_NAME = "select";

    /**
     *
     * @var AttributeAutofocus 
     */
    private $autofocus;

    /**
     *
     * @var AttributeDisabled
     */
    private $disabled;

    /**
     *
     * @var AttributeForm
     */
    private $form;

    /**
     * 
     * @var AttributeMultiple
     */
    private $multiple;

    /**
     *
     * @var AttributeName
     */
    private $name;

    /**
     *
     * @var AttributeRequired
     */
    private $required;

    /**
     * 
     * @var AttributeSize
     */
    private $size;

    function __construct() {
        $this->setAutofocus(new AttributeAutofocus());
        $this->setDisabled(new AttributeDisabled());
        $this->setForm(new AttributeForm());
        $this->setMultiple(new AttributeMultiple());
        $this->setName(new AttributeName());
        $this->setRequired(new AttributeRequired());
        $this->setSize(new AttributeSize);
    }

    public function getAllHtmlParameters() {
        return $this->getAutofocus()->getToHtml()
                . $this->getDisabled()->getToHtml()
                . $this->getForm()->getToHtml()
                . $this->getMultiple()->getToHtml()
                . $this->getName()->getToHtml()
                . $this->getRequired()->getToHtml()
                . $this->getSize()->getToHtml()
        ;
    }

    public function getTagName() {
        return self::TAG_NAME;
    }

    public function getAutofocus() {
        return $this->autofocus;
    }

    public function getDisabled() {
        return $this->disabled;
    }

    public function getForm() {
        return $this->form;
    }

    public function getMultiple() {
        return $this->multiple;
    }

    public function getName() {
        return $this->name;
    }

    public function getRequired() {
        return $this->required;
    }

    public function getSize() {
        return $this->size;
    }

    public function setAutofocus(AttributeAutofocus $autofocus) {
        $this->autofocus = $autofocus;
    }

    public function setDisabled(AttributeDisabled $disabled) {
        $this->disabled = $disabled;
    }

    public function setForm(AttributeForm $form) {
        $this->form = $form;
    }

    public function setMultiple(AttributeMultiple $multiple) {
        $this->multiple = $multiple;
    }

    public function setName(AttributeName $name) {
        $this->name = $name;
    }

    public function setRequired(AttributeRequired $required) {
        $this->required = $required;
    }

    public function setSize(AttributeSize $size) {
        $this->size = $size;
    }

}
