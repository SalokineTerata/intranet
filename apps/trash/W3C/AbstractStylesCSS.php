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
 * Description of AbstractW3CStylesCSS
 * 
 * @link http://www.w3schools.com/jsref/dom_obj_style.asp description
 * @author Boris Sanègre <boris.sanegre@ldc.fr>
 * @license see LICENSE.TXT at the root of this project
 */
abstract class AbstractStylesCSS {

    const DELIM_MIDDLE = ":";
    const DELIM_END = ";";
    const STYLE_ATTRIBUTE = "style";

    /**
     * Sets or returns an element's display type
     * @link http://www.w3schools.com/jsref/prop_style_display.asp description
     * @var string 
     */
    private $propertyDisplay;

    const DISPLAY_NAME = "display";
    const DISPLAY_DEFAULT_VALUE = self::DISPLAY_VALUE_INLINE;
    const DISPLAY_VALUE_INLINE = "inline";
    const DISPLAY_VALUE_NONE = "none";

    public function getDisplay() {
        return $this->propertyDisplay;
    }

    public function getStyleAttribute() {
        $return = self::STYLE_ATTRIBUTE . "=\""
                . $this->getDisplayForStyleAttribute()
                . "\" "
        ;
        return $return;
    }

    private function getDisplayForStyleAttribute() {
        $return = NULL;
        if ($this->getDisplay() != NULL) {
            $return = self::DISPLAY_NAME . self::DELIM_MIDDLE . $this->getDisplay() . self::DELIM_END;
        }
        return $return;
    }

    private function setDisplay($propertyDisplay) {
        $this->propertyDisplay = $propertyDisplay;
    }

    public function setDisplayToInline() {
        $this->setDisplay(self::DISPLAY_VALUE_INLINE);
    }

    public function setDisplayToNone() {
        $this->setDisplay(self::DISPLAY_VALUE_NONE);
    }

    public function unsetDisplay() {
        $this->setDisplay(NULL);
    }

}
