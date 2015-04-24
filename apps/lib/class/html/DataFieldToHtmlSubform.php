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

    /**
     * Créé un sous-formulaire HTML à partir d'un DataField
     * @param DatabaseDataField $paramDataField
     */
    public function __construct(DatabaseDataField $paramDataField) {
        $paramArrayContent = DatabaseOperation::getArrayFieldsNameFromForeignKeyRelationNtoOne(
                        $paramDataField->getReferencedTableName()
                        , $paramDataField->getTableName()
                        , $paramDataField->getFieldValue()
                        , explode(",", $paramDataField->getFieldsToDisplay())
                        , explode(",", $paramDataField->getFieldsToOrder())
        );
        parent::__construct($paramArrayContent
                , DatabaseTableModelAssociation::getModelName($paramDataField->getReferencedTableName())
                , $paramDataField->getFieldLabel()
        );
        $this->setArrayContentLocked(explode(",", $paramDataField->getFieldsToLock()));
        $this->setIsRightToAdd($paramDataField->getRightToAdd());
    }

}
