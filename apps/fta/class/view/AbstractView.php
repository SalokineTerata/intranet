<?php

/*
 * Copyright (C) 2014 salokine
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
 * Description of AbstractView
 *
 * @author salokine
 */
abstract class AbstractView {

    /**
     * La vue est-elle modifiable par l'utilisateur (saisie) ou simplement
     * en consultation ?
     * @var boolean
     */
    private $isEditable;
    private $dataValidationSuccessful;

    public function getHtmlDataField($paramFieldName) {
        return Html::convertDataFieldToHtml(
                        $this->getModel()->getDataField($paramFieldName)
                        , $this->getIsEditable()
        );
    }

    public function getIsEditable() {
        return $this->isEditable;
    }

    public function setIsEditable($isEditable) {
        $this->isEditable = $isEditable;
    }

    public function isDataValidationSuccessful() {
        return $this->dataValidationSuccessful;
    }

    function setDataValidationSuccessful($paramDataValidationSuccessful) {
        $this->dataValidationSuccessful += $paramDataValidationSuccessful;
    }

    function setDataValidationSuccessfulToTrue() {
        $this->setDataValidationSuccessful("0");
    }

    function setDataValidationSuccessfulToFalse() {
        $this->setDataValidationSuccessful("1");
    }

//    /**
//     * @return type Description
//     */
//    abstract public function getModel();
//
//    /**
//     * 
//     */
//    abstract public function setModel(FtaSuiviProjetModel $model);
}
