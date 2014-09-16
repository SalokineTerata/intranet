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
 * Attribut formtarget
 * Supported: HTML 5
 * Specifies where to display the response that is received after submitting
 * the form (for type="submit" and type="image")
 * @link http://www.w3schools.com/tags/att_input_formtarget.asp description
 * @author Boris Sanègre <boris.sanegre@ldc.fr>
 * @license see LICENSE.TXT at the root of this project
 */
class AttributeFormTarget extends AbstractAttributeTypeGenericValue {

    const NAME = "formtarget";
    const BLANK_VALUE = "_blank";
    const SELF_VALUE = "_self";
    const PARENT_VALUE = "_parent";
    const TOP_VALUE = "_top";

    public function getName() {
        return self::NAME;
    }

    public function setBlank() {
        $this->setValue(self::BLANK_VALUE);
    }

    public function setSelf() {
        $this->setValue(self::SELF_VALUE);
    }

    public function setParent() {
        $this->setValue(self::PARENT_VALUE);
    }

    public function setTop() {
        $this->setValue(self::TOP_VALUE);
    }

    public function setFrameName($value) {
        parent::setValue($value);
    }

}
