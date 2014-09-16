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
 * Attribut spellcheck
 * Supported: HTML5
 * Specifies whether the element is to have its spelling and
 * grammar checked or not
 * 
 * The spellcheck attribute specifies whether the element is
 *  to have its spelling and grammar checked or not.
 * The following can be spellchecked:
 * - Text values in input elements (not password)
 * - Text in <textarea> elements
 * - Text in editable elements
 * 
 * @link http://www.w3schools.com/tags/att_global_spellcheck.asp Documentation
 * @author Boris Sanègre <boris.sanegre@ldc.fr>
 * @license see LICENSE.TXT at the root of this project
 */
class AttributeSpellCheck extends AbstractAttributeTypeTrueFalse {

    const NAME = "spellcheck";

    public function getName() {
        return self::NAME;
    }

}
