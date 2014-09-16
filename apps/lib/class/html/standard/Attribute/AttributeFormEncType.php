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
 * Attribut formenctype
 * Specifies how the form-data should be encoded when submitting it to
 * the server (for type="submit" and type="image")
 * @link http://www.w3schools.com/tags/att_input_formenctype.asp description
 * @author Boris Sanègre <boris.sanegre@ldc.fr>
 * @license see LICENSE.TXT at the root of this project
 */
class AttributeFormEncType extends AbstractAttributeTypeGenericValue {

    const NAME = "formenctype";
    const URLENCODED_VALUE = "application/x-www-form-urlencoded";
    const FORM_DATA_VALUE = "multipart/form-data";
    const TEXT_PLAIN_VALUE = "text/plain";

    public function getName() {
        return self::NAME;
    }

    public function setUrlEncoded() {
        $this->setValue(self::URLENCODED_VALUE);
    }

    public function setFormData() {
        $this->setValue(self::FORM_DATA_VALUE);
    }

    public function setPlainText() {
        $this->setValue(self::TEXT_PLAIN_VALUE);
    }

}
