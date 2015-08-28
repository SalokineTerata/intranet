<?php

/*
 * Copyright (C) 2015 tp4300001
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
 * Description of TableRelationshipToHtmlSubform_RNN
 *
 * @author tp4300001
 */
class DataFieldToHtmlSubform_RNN extends HtmlSubForm_RNN {

    /**
     * Créé un sous-formulaire HTML à partir d'un DataField
     * @param DatabaseDataField $paramDataField
     * @param $paramSecondaryTableNamesAndIdKeyValue
     */
    public function __construct(DatabaseDataField $paramDataField, $paramSecondaryTableNamesAndIdKeyValue) {
        $paramArrayContent = DatabaseOperation::getArrayFieldsNameFromForeignKeyRelationNtoN(
                        $paramDataField->getTableName()
                        , $paramSecondaryTableNamesAndIdKeyValue
                        , $paramDataField->getFieldsToDisplay()
                        , explode(',', $paramDataField->getFieldsToOrder())//Modifiable
        );
        parent::__construct($paramArrayContent
                , ModelTableAssociation::getModelName($paramDataField->getTableName())
                , $paramDataField->getFieldLabel()
                , $paramSecondaryTableNamesAndIdKeyValue
        );
        $this->setIsRightToAdd($paramDataField->getRightToAdd());
    }

}
