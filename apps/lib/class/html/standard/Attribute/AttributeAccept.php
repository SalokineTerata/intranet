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
 * Attribut accept
 * Specifies the types of files that the server accepts (only for type="file")
 * @link http://www.w3schools.com/tags/att_input_accept.asp description
 * @author Boris Sanègre <boris.sanegre@ldc.fr>
 * @license see LICENSE.TXT at the root of this project
 */
class AttributeAccept extends AbstractAttributeTypeGenericValue {

    const NAME = "accept";
    const AUDIO_VALUE = "audio/*";
    const VIDEO_VALUE = "video/*";
    const IMAGE_VALUE = "image/*";

    public function getName() {
        return self::NAME;
    }

    public function setAudio() {
        $this->setValue(self::AUDIO_VALUE);
    }

    public function setVideo() {
        $this->setValue(self::VIDEO_VALUE);
    }

    public function setImage() {
        $this->setValue(self::IMAGE_VALUE);
    }

    public function setMime($value) {
        parent::setValue($value);
    }

}
