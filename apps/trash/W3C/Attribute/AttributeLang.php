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
 * Attribut Lang
 * Specifies the language of the element's content ISO 639-1
 * @link http://www.w3schools.com/tags/att_global_lang.asp Documentation
 * @link http://www.w3schools.com/tags/ref_language_codes.asp Code ISO 639-1
 * @author Boris Sanègre <boris.sanegre@ldc.fr>
 * @license see LICENSE.TXT at the root of this project
 */
class AttributeLang extends AbstractAttributeTypeGenericValue {

    const NAME = "lang";

    /**
     * Liste des codes de références
     * @link http://www.w3schools.com/tags/ref_language_codes.asp description
     */
    const VALUE_ENGLISH = "en";
    const VALUE_FRENCH = "fr";

    public function getName() {
        return self::NAME;
    }

    public function setEnglish() {
        parent::setValue(self::VALUE_ENGLISH);
    }

    public function setFrench() {
        parent::setValue(self::VALUE_FRENCH);
    }

}
