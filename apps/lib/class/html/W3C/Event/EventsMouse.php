<?php

/**
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
 * Evènements globaux HTML
 * @link http://www.w3schools.com/tags/ref_eventattributes.asp Documentation
 * @author salokine@gmail.com
 * @license see LICENSE.TXT at the root of this project
 * @version 1.0
 */
class EventsMouse {

    /**
     * Valeur à définir lorsqu'on souhaite désactiver un attribut
     */
    const UNSET_VALUE = NULL;

    /**
     * Form Event onclick
     * Fires on a mouse click on the element
     * @link http://www.w3schools.com/tags/ev_onclick.asp Documentation
     * @var mixed script
     */
    protected $OnClick;

    const EVENT_ONCLICK = "onclick";

    /**
     * Retourne le nom de script défini pour l'évènement onclick
     * @return mixed
     */
    public function getOnClick(
    ) {
        return $this->OnClick;
    }

    /**
     * Défini le nom du script utilisé pour l'évènement onclick
     * @param mixed $paramOnClick
     */
    public function setOnClick($paramOnClick) {
        $this->OnClick = $paramOnClick;
    }

}
?>






















