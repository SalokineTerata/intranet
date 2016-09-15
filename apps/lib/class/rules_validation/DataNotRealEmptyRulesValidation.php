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
 * Description of DataNotRealEmptyRulesValidation
 *
 * @author franckwastken
 */
class DataNotRealEmptyRulesValidation extends AbstractRulesValidation {

    const WARNING_MESSAGE = UserInterfaceMessage::FR_WARNING_VALIDATION_RULES_DATA_NOT_EMPTY;
    const VALUE_0 = "0";

    public function __construct($paramValueToTest = NULL) {
        parent::__construct($paramValueToTest);
        $this->setWarningMessage(self::WARNING_MESSAGE);
    }

    /**
     * On vérifie si la valeur n'est pas vide 
     * Ce qui suit est considéré comme étant vide :
     *
     *  "" (une chaîne vide)
     *  NULL
     *  FALSE
     * array() (un tableau vide)
     *  $var; (une variable déclarée, mais sans valeur)
     * @return boolean
     */
    function isValide() {
        $result = FALSE;
        $valueToTest = $this->getValueTotest();
        $checkCaractereNumber = empty($valueToTest);
        $checkCaractereNumberFor0 = self::exceptionForValue0($valueToTest);
        if (!$checkCaractereNumber or $checkCaractereNumberFor0) {
            $result = TRUE;
        }
        return $result;
    }

    /**
     * Exception pour la valeur 0
     * @param type $paramValueTest
     * @return boolean
     */
    private static function exceptionForValue0($paramValueTest) {
        $result = FALSE;
        if ($paramValueTest === self::VALUE_0) {
            $result = TRUE;
        }
        return $result;
    }

}
