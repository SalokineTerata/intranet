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
 * Description of TableRelationshipToHtmlSubform
 *
 * @author bs4300280
 */
class DataFieldToHtmlSubform extends HtmlSubForm {

    public function __construct($paramSubFormModelClassName
    , $paramLabel
    , $tableNameRN
    , $tableNameR1
    , $foreignKeyValue
    , $arrayFieldsNameToDisplay
    , $arrayFieldsNameToLock = NULL
    , $arrayFieldsNameOrder = NULL
    , $isEditable = TRUE
    , $rightToAdd = TRUE
    , $statusValidation = FALSE
    ) {
        $paramArrayContent = DatabaseOperation::getArrayFieldsNameFromForeignKeyRelationNtoOne(
                        $tableNameRN
                        , $tableNameR1
                        , $foreignKeyValue
                        , $arrayFieldsNameToDisplay
                        , $arrayFieldsNameOrder
        );
        parent::__construct($paramArrayContent, $paramSubFormModelClassName, $paramLabel);
        $this->setArrayContentLocked($arrayFieldsNameToLock);
        $this->setIsEditable($isEditable);
    }

}
