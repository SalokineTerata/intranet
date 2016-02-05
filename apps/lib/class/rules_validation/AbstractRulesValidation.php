<?php

/*
 * Copyright (C) 2016 tp4300001
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
 * Description of AbstractRulesValidation
 *
 * @author tp4300001
 */
class AbstractRulesValidation {

    private $warningMessage;
    private $valueTotest;

    public function __construct($paramValueToTest = NULL) {

        $this->setValueTotest($paramValueToTest);
    }

    function getValueTotest() {
        return $this->valueTotest;
    }

    function setValueTotest($valueTotest) {
        $this->valueTotest = $valueTotest;
    }

    function isValide() {
        
    }

    function getWarningMessage() {
        return $this->warningMessage;
    }

    function setWarningMessage($warningMessage) {
        $this->warningMessage = $warningMessage;
    }

}
