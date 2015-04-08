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
 * Attribut contextmenu
 * Supported: HTML 5
 * Specifies a context menu for an element. The context menu appears when
 * a user right-clicks on the element
 * @link http://www.w3schools.com/tags/att_global_contextmenu.asp Documentation
 * @author Boris Sanègre <boris.sanegre@ldc.fr>
 * @license see LICENSE.TXT at the root of this project
 */
class AttributeContextMenu extends AbstractAttributeTypeUnique {

    const NAME = "contextmenu";

    public function getName() {
        return self::NAME;
    }

}