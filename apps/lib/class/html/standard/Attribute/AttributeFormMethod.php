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
 * Attribut formmethod
 * Supported: HTML 5
 * Defines the HTTP method for sending data to the action URL
 * (for type="submit" and type="image")
 * @link http://www.w3schools.com/tags/att_input_formmethod.asp description
 * @author Boris Sanègre <boris.sanegre@ldc.fr>
 * @license see LICENSE.TXT at the root of this project
 */
class AttributeFormMethod extends AbstractAttributeTypeGenericValue {

    const NAME = "formmethod";
    const GET_VALUE = "get";
    const POST_VALUE = "post";

    public function getName() {
        return self::NAME;
    }

    public function setGet() {
        $this->setValue(self::GET_VALUE);
    }

    public function setPost() {
        $this->setValue(self::POST_VALUE);
    }

}
