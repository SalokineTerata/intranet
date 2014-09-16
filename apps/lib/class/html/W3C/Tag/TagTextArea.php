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

namespace W3C;

/**
 * Element textarea
 * @link http://www.w3schools.com/tags/tag_textarea.asp description
 * @author Boris Sanègre <boris.sanegre@ldc.fr>
 * @license see LICENSE.TXT at the root of this project
 */
class TagTextArea extends AbstractGlobalAttributes {

    /**
     *
     * @var AttributeAutofocus 
     */
    private $autofocus;

    /**
     *
     * @var AttributeCols
     */
    private $cols;

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
     * @var AttributeMaxLength
     */
    private $maxLength;

    /**
     *
     * @var AttributeName
     */
    private $name;

    /**
     *
     * @var AttributePlaceHolder
     */
    private $placeHolder;

    /**
     *
     * @var AttributePlaceHolder
     */
    private $readOnly;

    /**
     *
     * @var AttributeRequired
     */
    private $required;

    /**
     *
     * @var AttributeRows
     */
    private $rows;

    /**
     *
     * @var AttributeWrap
     */
    private $wrap;

    function __construct() {
        parent::__construct();
        $this->setAutofocus(new \W3C\AttributeAutofocus());
        $this->setDisabled(new \W3C\AttributeDisabled());
        $this->setCols(new W3C\AttributeCols());
        $this->setForm(new W3C\AttributeForm());
        $this->setMaxLength(new W3C\AttributeMaxLength());
        $this->setName(new W3C\AttributeName());
        $this->setPlaceHolder(new W3C\AttributePlaceHolder());
        $this->setReadOnly(new W3C\AttributeReadOnly());
        $this->setRequired(new W3C\AttributeRequired());
        $this->setWrap(new W3C\AttributeWrap());
    }

    public function getAllHtmlParameters() {
        return $this->getAutofocus()->getToHtml()
                . $this->getCols()->getToHtml()
                . $this->getDisabled()->getToHtml()
                . $this->getForm()->getToHtml()
                . $this->getMaxlength()->getToHtml()
                . $this->getName()->getToHtml()
                . $this->getPlaceholder()->getToHtml()
                . $this->getReadonly()->getToHtml()
                . $this->getRequired()->getToHtml()
                . $this->getRows()->getToHtml()
                . $this->getWrap()->getToHtml()
        ;
    }

    public function getAutofocus() {
        return $this->autofocus;
    }

    public function getCols() {
        return $this->cols;
    }

    public function getDisabled() {
        return $this->disabled;
    }

    public function getForm() {
        return $this->form;
    }

    public function getMaxLength() {
        return $this->maxLength;
    }

    public function getName() {
        return $this->name;
    }

    public function getPlaceHolder() {
        return $this->placeHolder;
    }

    public function getReadOnly() {
        return $this->readOnly;
    }

    public function getRequired() {
        return $this->required;
    }

    public function getRows() {
        return $this->rows;
    }

    public function getWrap() {
        return $this->wrap;
    }

    public function setAutofocus(AttributeAutofocus $autofocus) {
        $this->autofocus = $autofocus;
    }

    public function setCols(AttributeCols $cols) {
        $this->cols = $cols;
    }

    public function setDisabled(AttributeDisabled $disabled) {
        $this->disabled = $disabled;
    }

    public function setForm(AttributeForm $form) {
        $this->form = $form;
    }

    public function setMaxLength(AttributeMaxLength $maxLength) {
        $this->maxLength = $maxLength;
    }

    public function setName(AttributeName $name) {
        $this->name = $name;
    }

    public function setPlaceHolder(AttributePlaceHolder $placeHolder) {
        $this->placeHolder = $placeHolder;
    }

    public function setReadOnly(AttributePlaceHolder $readOnly) {
        $this->readOnly = $readOnly;
    }

    public function setRequired(AttributeRequired $required) {
        $this->required = $required;
    }

    public function setRows(AttributeRows $rows) {
        $this->rows = $rows;
    }

    public function setWrap(AttributeWrap $wrap) {
        $this->wrap = $wrap;
    }

}
