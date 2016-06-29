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

class HtmlSubForm extends AbstractHtmlList {

    private $dataValidationSuccessful;

    public function getHtmlResultSubFormBegin() {
        return '<table width=\'100%\' ><tr>';
    }

    public function getHtmlResultSubFormEnd() {
        return '</tr></table>';
    }

    public function getHtmlResultSubFormAddNewLine() {
        $return = NULL;
        if ($this->getRightToAdd()) {
            $return = '<td>'
                    . $this->getAttributesGlobal()->getIconAddToHtml()
                    . '<a href=' . $this->getLien() . ' > Ajouter</a>'
                    . '</td>'
            ;
        }
        $this->setDataValidationSuccessfulToTrue();
        return $return;
    }

    public function getHtmlEditableContent() {
        return $this->getHtmlEditableContent()
        ;
    }

    /**
     * Retourne le contenu brut du DataField
     */
    public function getRawContent() {
        
    }

    public function getHtmlAddContent() {
        return $this->getHtmlAddContent();
    }

    public function getHtmlViewedContent() {
        return $this->getHtmlViewedContent();
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

}
