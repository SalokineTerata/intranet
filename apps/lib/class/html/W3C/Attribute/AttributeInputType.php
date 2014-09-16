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
 * Attribut type
 * Specifies the type <input> element to display
 * @link http://www.w3schools.com/tags/att_input_type.asp description
 * @author Boris Sanègre <boris.sanegre@ldc.fr>
 * @license see LICENSE.TXT at the root of this project
 */
class AttributeInputType extends AbstractAttributeTypeGenericValue {

    const NAME = "type";
    const TYPE_BUTTON = "button";
    const TYPE_CHECKBOX = "checkbox";
    const TYPE_COLOR = "color";
    const TYPE_DATE = "date";
    const TYPE_DATETIME = "datetime";
    const TYPE_DATETIME_LOCAL = "datetime-local";
    const TYPE_EMAIL = "email";
    const TYPE_FILE = "file";
    const TYPE_HIDDEN = "hidden";
    const TYPE_IMAGE = "image";
    const TYPE_MONTH = "month";
    const TYPE_NUMBER = "number";
    const TYPE_PASSWORD = "password";
    const TYPE_RADIO = "radio";
    const TYPE_RANGE = "range";
    const TYPE_SEARCH = "search";
    const TYPE_SUBMIT = "submit";
    const TYPE_TEL = "tel";
    const TYPE_TEXT = "text";
    const TYPE_TIME = "time";
    const TYPE_URL = "url";
    const TYPE_WEEK = "week";

    public function getName() {
        return self::NAME;
    }

    public function setButton() {
        $this->setValue(self::TYPE_BUTTON);
    }

    public function setCheckbox() {
        $this->setValue(self::TYPE_CHECKBOX);
    }

    public function setColor() {
        $this->setValue(self::TYPE_COLOR);
    }

    public function setDate() {
        $this->setValue(self::TYPE_DATE);
    }

    public function setDateTime() {
        $this->setValue(self::TYPE_DATETIME);
    }

    public function setDateTimeLocal() {
        $this->setValue(self::TYPE_DATETIME_LOCAL);
    }

    public function setEmail() {
        $this->setValue(self::TYPE_EMAIL);
    }

    public function setFile() {
        $this->setValue(self::TYPE_FILE);
    }

    public function setHidden() {
        $this->setValue(self::TYPE_HIDDEN);
    }

    public function setImage() {
        $this->setValue(self::TYPE_IMAGE);
    }

    public function setMonth() {
        $this->setValue(self::TYPE_MONTH);
    }

    public function setNumber() {
        $this->setValue(self::TYPE_NUMBER);
    }

    public function setPassword() {
        $this->setValue(self::TYPE_PASSWORD);
    }

    public function setRadio() {
        $this->setValue(self::TYPE_RADIO);
    }

    public function setRange() {
        $this->setValue(self::TYPE_RANGE);
    }

    public function setSearch() {
        $this->setValue(self::TYPE_SEARCH);
    }

    public function setSubmit() {
        $this->setValue(self::TYPE_SUBMIT);
    }

    public function setTel() {
        $this->setValue(self::TYPE_TEL);
    }

    public function setText() {
        $this->setValue(self::TYPE_TEXT);
    }

    public function setTime() {
        $this->setValue(self::TYPE_TIME);
    }

    public function setUrl() {
        $this->setValue(self::TYPE_URL);
    }

    public function setWeek() {
        $this->setValue(self::TYPE_WEEK);
    }

}
