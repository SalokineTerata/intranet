<?php

/*
 * Copyright (C) 2016 fa4301632
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
 * Description of Less255CaractereRulesValidation
 *
 * @author franckwastken
 */
class Less255CaractereRulesValidation extends AbstractRulesValidation {

    const WARNING_MESSAGE = UserInterfaceMessage::FR_WARNING_VALIDATION_RULES_LESS255;
    const CHECK_VALUE = "255";

    public function __construct($paramValueToTest = NULL) {
        parent::__construct($paramValueToTest);
        $this->setWarningMessage(self::WARNING_MESSAGE);
    }

    /**
     * On vérifie si la valeur saisi à au maximun 8 caractère
     * @return boolean
     */
    function isValide() {
        $result = FALSE;
        $valueToTest = $this->getValueTotest();
        $checkCaractereNumber = strlen($valueToTest);
        if ($checkCaractereNumber <= self::CHECK_VALUE) {
            $result = TRUE;
        }
        return $result;
    }

}
