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
 * Description of AbstractW3CAttribute
 *
 * @author Boris Sanègre <boris.sanegre@ldc.fr>
 * @license see LICENSE.TXT at the root of this project
 */
abstract class AbstractAttributeTypeGenericValue {

    private $value;

    abstract protected function getName();

    public function getValue() {
        return $this->value;
    }

    public function getToHtml() {
        return Html::getHtmlParameter($this->getName(), $this->getValue());
    }

    protected function setValue($value) {
        $this->value = $value;
    }

    public function unsetValue() {
        $this->setValue(NULL);
    }

}
