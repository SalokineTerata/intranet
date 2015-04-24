<?php

/*
 * Copyright (C) 2015 bs4300280
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
 * Description of AbstractHtmlList
 * Eléments commun aux objets HTML ayant une représentation de list
 * 
 * @author bs4300280
 */
abstract class AbstractHtmlList extends AbstractHtmlGlobalElement {

    /**
     * A-t-on le droit d'ajouter un nouvel élément dans la liste ?
     * @var boolean 
     */
    private $isRightToAdd = NULL;

    function getIsRightToAdd() {
        return $this->isRightToAdd;
    }

    protected function setIsRightToAdd($paramIsRightToAdd) {
        return $this->isRightToAdd = $paramIsRightToAdd;
    }

    function setIsRightToAddToFalse() {
        $this->isRightToAdd = FALSE;
    }

    function setIsRightToAddToTrue() {
        $this->isRightToAdd = TRUE;
    }

    public function __construct() {
        parent::__construct();

        /**
         * Par défaut il est interdit de rajouter un éléments dans la liste
         */
        $this->setIsRightToAddToFalse();
    }

}
