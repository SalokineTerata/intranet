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
 * Description of HtmlInputAttributes
 *
 * @author Boris Sanègre <boris.sanegre@ldc.fr>
 * @license see LICENSE.TXT at the root of this project
 */
class HtmlStandardTagInput extends AbstractAllHtmlParameters implements InterfaceHtmlStandardTag {

    const TAG_NAME = "input";

    /**
     *
     * @var AttributeAccept 
     */
    private $accept;

    /**
     *
     * @var AttributeAlt 
     */
    private $alt;

    /**
     *
     * @var AttributeAutocomplete 
     */
    private $autocomplete;

    /**
     *
     * @var AttributeAutofocus 
     */
    private $autofocus;

    /**
     *
     * @var AttributeChecked 
     */
    private $checked;

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
     * @var AttributeFormAction 
     */
    private $formAction;

    /**
     *
     * @var AttributeFormEncType
     */
    private $formEncType;

    /**
     *
     * @var AttributeFormMethod
     */
    private $formMethod;

    /**
     *
     * @var AttributeFormNoValidate
     */
    private $formNoValidate;

    /**
     *
     * @var AttributeFormTarget
     */
    private $formTarget;

    /**
     *
     * @var AttributeHeight
     */
    private $height;

    /**
     *
     * @var AttributeList
     */
    private $list;

    /**
     *
     * @var AttributeMax
     */
    private $max;

    /**
      /**
     *
     * @var AttributeMax
     */
    private $maxLength;

    /**
     *
     * @var AttributeMin
     */
    private $min;

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
     * @var AttributePattern
     */
    private $pattern;

    /**
     *
     * @var AttributePlaceHolder
     */
    private $placeHolder;

    /**
     *
     * @var AttributeReadOnly
     */
    private $readOnly;

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

    /**
     *
     * @var AttributeSrc
     */
    private $src;

    /**
     *
     * @var AttributeStep
     */
    private $step;

    /**
     *
     * @var AttributeInputType
     */
    private $inputType;

    /**
     *
     * @var AttributeValue
     */
    private $value;

    /**
     *
     * @var AttributeWidth
     */
    private $width;

    function __construct() {

        $this->setAccept(new AttributeAccept());
        $this->setAlt(new AttributeAlt());
        $this->setAutocomplete(new AttributeAutocomplete());
        $this->setAutofocus(new AttributeAutofocus());
        $this->setChecked(new AttributeChecked());
        $this->setDisabled(new AttributeDisabled());
        $this->setForm(new AttributeForm());
        $this->setFormAction(new AttributeFormAction());
        $this->setFormEncType(new AttributeFormEncType());
        $this->setFormMethod(new AttributeFormMethod());
        $this->setFormNoValidate(new AttributeFormNoValidate());
        $this->setFormTarget(new AttributeFormTarget());
        $this->setHeight(new AttributeHeight());
        $this->setList(new AttributeList());
        $this->setMax(new AttributeMax());
        $this->setMaxLength(new AttributeMaxLength());
        $this->setMin(new AttributeMin());
        $this->setMultiple(new AttributeMultiple());
        $this->setName(new AttributeName());
        $this->setPattern(new AttributePattern());
        $this->setPlaceHolder(new AttributePlaceHolder());
        $this->setReadOnly(new AttributeReadOnly());
        $this->setRequired(new AttributeRequired());
        $this->setSize(new AttributeSize());
        $this->setSrc(new AttributeSrc());
        $this->setStep(new AttributeStep());
        $this->setInputType(new AttributeInputType());
        $this->setValue(new AttributeValue);
        $this->setWidth(new AttributeWidth());
    }

    public function getAllHtmlParameters() {
        return $this->getAccept()->getToHtml()
                . $this->getAlt()->getToHtml()
                . $this->getAutocomplete()->getToHtml()
                . $this->getAutofocus()->getToHtml()
                . $this->getChecked()->getToHtml()
                . $this->getDisabled()->getToHtml()
                . $this->getForm()->getToHtml()
                . $this->getFormAction()->getToHtml()
                . $this->getFormEncType()->getToHtml()
                . $this->getFormMethod()->getToHtml()
                . $this->getFormNoValidate()->getToHtml()
                . $this->getFormTarget()->getToHtml()
                . $this->getHeight()->getToHtml()
                . $this->getList()->getToHtml()
                . $this->getMax()->getToHtml()
                . $this->getMaxLength()->getToHtml()
                . $this->getMin()->getToHtml()
                . $this->getMultiple()->getToHtml()
                . $this->getName()->getToHtml()
                . $this->getPattern()->getToHtml()
                . $this->getPlaceHolder()->getToHtml()
                . $this->getReadOnly()->getToHtml()
                . $this->getRequired()->getToHtml()
                . $this->getSize()->getToHtml()
                . $this->getSrc()->getToHtml()
                . $this->getStep()->getToHtml()
                . $this->getInputType()->getToHtml()
                . $this->getValue()->getToHtml()
                . $this->getWidth()->getToHtml()
        ;
    }

    public function getTagName() {
        return self::TAG_NAME;
    }

    /**
     * 
     * @return AttributeAccept
     */
    public function getAccept() {
        return $this->accept;
    }

    /**
     * 
     * @return AttributeAlt
     */
    public function getAlt() {
        return $this->alt;
    }

    /**
     * 
     * @return AttributeAutocomplete
     */
    public function getAutocomplete() {
        return $this->autocomplete;
    }

    /**
     * 
     * @return AttributeAutofocus
     */
    public function getAutofocus() {
        return $this->autofocus;
    }

    /**
     * 
     * @return AttributeChecked
     */
    public function getChecked() {
        return $this->checked;
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
     * @return AttributeForm
     */
    public function getForm() {
        return $this->form;
    }

    /**
     * 
     * @return AttributeFormAction
     */
    public function getFormAction() {
        return $this->formAction;
    }

    /**
     * 
     * @return AttributeFormEncType
     */
    public function getFormEncType() {
        return $this->formEncType;
    }

    /**
     * 
     * @return AttributeFormMethod
     */
    public function getFormMethod() {
        return $this->formMethod;
    }

    /**
     * 
     * @return AttributeFormNoValidate
     */
    public function getFormNoValidate() {
        return $this->formNoValidate;
    }

    /**
     * 
     * @return AttributeFormTarget
     */
    public function getFormTarget() {
        return $this->formTarget;
    }

    /**
     * 
     * @return AttributeHeight
     */
    public function getHeight() {
        return $this->height;
    }

    /**
     * 
     * @return AttributeList
     */
    public function getList() {
        return $this->list;
    }

    /**
     * 
     * @return AttributeMax
     */
    public function getMax() {
        return $this->max;
    }

    /**
     * 
     * @return AttributeMaxLength
     */
    public function getMaxLength() {
        return $this->maxLength;
    }

    /**
     * 
     * @return AttributeMin
     */
    public function getMin() {
        return $this->min;
    }

    /**
     * 
     * @return AttributeMultiple
     */
    public function getMultiple() {
        return $this->multiple;
    }

    /**
     * 
     * @return AttributeName
     */
    public function getName() {
        return $this->name;
    }

    /**
     * 
     * @return AttributePattern
     */
    public function getPattern() {
        return $this->pattern;
    }

    /**
     * 
     * @return AttributePlaceHolder
     */
    public function getPlaceHolder() {
        return $this->placeHolder;
    }

    /**
     * 
     * @return AttributeReadOnly
     */
    public function getReadOnly() {
        return $this->readOnly;
    }

    /**
     * 
     * @return AttributeRequired
     */
    public function getRequired() {
        return $this->required;
    }

    /**
     * 
     * @return AttributeSize
     */
    public function getSize() {
        return $this->size;
    }

    /**
     * 
     * @return AttributeSrc
     */
    public function getSrc() {
        return $this->src;
    }

    /**
     * 
     * @return AttributeStep
     */
    public function getStep() {
        return $this->step;
    }

    /**
     * 
     * @return AttributeInputType
     */
    public function getInputType() {
        return $this->inputType;
    }

    /**
     * 
     * @return AttributeValue
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * 
     * @return AttributeWidth
     */
    public function getWidth() {
        return $this->width;
    }

    private function setAccept(AttributeAccept $accept) {
        $this->accept = $accept;
    }

    private function setAlt(AttributeAlt $alt) {
        $this->alt = $alt;
    }

    private function setAutocomplete(AttributeAutocomplete $autocomplete) {
        $this->autocomplete = $autocomplete;
    }

    private function setAutofocus(AttributeAutofocus $autofocus) {
        $this->autofocus = $autofocus;
    }

    private function setChecked(AttributeChecked $checked) {
        $this->checked = $checked;
    }

    private function setDisabled(AttributeDisabled $disabled) {
        $this->disabled = $disabled;
    }

    private function setForm(AttributeForm $form) {
        $this->form = $form;
    }

    private function setFormAction(AttributeFormAction $formAction) {
        $this->formAction = $formAction;
    }

    private function setFormEncType(AttributeFormEncType $formEncType) {
        $this->formEncType = $formEncType;
    }

    private function setFormMethod(AttributeFormMethod $formMethod) {
        $this->formMethod = $formMethod;
    }

    private function setFormNoValidate(AttributeFormNoValidate $formNoValidate) {
        $this->formNoValidate = $formNoValidate;
    }

    private function setFormTarget(AttributeFormTarget $formTarget) {
        $this->formTarget = $formTarget;
    }

    private function setHeight(AttributeHeight $height) {
        $this->height = $height;
    }

    private function setList(AttributeList $list) {
        $this->list = $list;
    }

    private function setMax(AttributeMax $max) {
        $this->max = $max;
    }

    private function setMaxLength(AttributeMaxLength $maxLength) {
        $this->maxLength = $maxLength;
    }

    private function setMin(AttributeMin $min) {
        $this->min = $min;
    }

    private function setMultiple(AttributeMultiple $multiple) {
        $this->multiple = $multiple;
    }

    private function setName(AttributeName $name) {
        $this->name = $name;
    }

    private function setPattern(AttributePattern $pattern) {
        $this->pattern = $pattern;
    }

    private function setPlaceHolder(AttributePlaceHolder $placeHolder) {
        $this->placeHolder = $placeHolder;
    }

    private function setReadOnly(AttributeReadOnly $readOnly) {
        $this->readOnly = $readOnly;
    }

    private function setRequired(AttributeRequired $required) {
        $this->required = $required;
    }

    private function setSize(AttributeSize $size) {
        $this->size = $size;
    }

    private function setSrc(AttributeSrc $src) {
        $this->src = $src;
    }

    private function setStep(AttributeStep $step) {
        $this->step = $step;
    }

    private function setInputType(AttributeInputType $type) {
        $this->inputType = $type;
    }

    private function setValue(AttributeValue $value) {
        $this->value = $value;
    }

    private function setWidth(AttributeWidth $width) {
        $this->width = $width;
    }

}
