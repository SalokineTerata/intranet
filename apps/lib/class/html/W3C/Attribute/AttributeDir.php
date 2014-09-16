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

namespace W3C;

/**
 * Attribut dir
 * Specifies the text direction for the content in an element
 * @link http://www.w3schools.com/tags/att_global_dir.asp Documentation
 * @author Boris Sanègre <boris.sanegre@ldc.fr>
 * @license see LICENSE.TXT at the root of this project
 */
class AttributeDir extends AbstractAttributeTypeGenericValue {

    const NAME = "dir";
    const LTR_VALUE = "ltr";
    const TRL_VALUE = "rtl";
    const AUTO_VALUE = "auto";

    public function getName() {
        return self::NAME;
    }

    public function setLtr() {
        parent::setValue(self::LTR_VALUE);
    }

    public function setTrl() {
        parent::setValue(self::TRL_VALUE);
    }

    public function setAuto() {
        parent::setValue(self::AUTO_VALUE);
    }

}
