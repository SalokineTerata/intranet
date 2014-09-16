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

/**
 * Attribut dropzone
 * Supported: HTML 5
 * Specifies whether the dragged data is copied, moved, or linked, when dropped
 * @link http://www.w3schools.com/tags/att_global_dropzone.asp description
 * @author Boris Sanègre <boris.sanegre@ldc.fr>
 * @license see LICENSE.TXT at the root of this project
 */
class AttributeDropZone extends AbstractAttributeTypeGenericValue {

    const NAME = "dropzone";
    const COPY_VALUE = "copy";
    const MOVE_VALUE = "move";
    const LINK_VALUE = "link";

    public function getName() {
        return self::NAME;
    }

    public function setCopy() {
        parent::setValue(self::COPY_VALUE);
    }

    public function setMove() {
        parent::setValue(self::MOVE_VALUE);
    }

    public function setLink() {
        parent::setValue(self::LINK_VALUE);
    }

}
