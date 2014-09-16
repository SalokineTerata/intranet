<?php

/*
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

/**
 * Description of CustomGlobalEventsForm
 *
 * @author Boris Sanègre <boris.sanegre@ldc.fr>
 * @license see LICENSE.TXT at the root of this project
 */
class EventsForm extends HtmlStandardEventsForm {

    const AJAX_SCRIPT_UPDATE_DATA = './ajax_update_data.php';

    /**
     * Nom de la fonction JavaScript à exécuter après 
     * les traitements de mise à jour de la liste
     * @var string
     */
    private $callbackJavaScriptFunctionOnChange;

    /**
     * Paramètre de la fonction JavaScript à exécuter après 
     * les traitements de mise à jour de la liste
     * @var string
     */
    private $callbackJavaScriptFunctionOnChangeParameters;
    private $AjaxAutoSaveTableName;
    private $AjaxAutoSaveFieldName;
    private $AjaxAutoSaveKeyName;
    private $AjaxAutoSaveKeyValue;

    public function setOnChangeWithAjaxAutoSave($paramTableName
    , $paramKeyName
    , $paramKeyValue
    , $paramFieldName
    ) {
        //Neutralisation de la mise à jour automatique de "OnChange"
        $paramUpdateOnChange = TRUE;

        //Mise à jour des attributs
        $this->setAjaxAutoSaveTableName($paramTableName, $paramUpdateOnChange);
        $this->setAjaxAutoSaveKeyName($paramKeyName, $paramUpdateOnChange);
        $this->setAjaxAutoSaveKeyValue($paramKeyValue, $paramUpdateOnChange);
        $this->setAjaxAutoSaveFieldName($paramFieldName, $paramUpdateOnChange);

        //Lancement manuel de la mise à jour en une fois.
        $this->updateOnChangeWithAjaxAutoSave();
    }

    private function updateOnChangeWithAjaxDoAction(
    $paramIdTag
    , $paramCallFile
    , $paramURL
    , $paramCallbackFunction
    , $paramCallbackFunctionParameters
    ) {

        $AjaxParameters = "'" . $paramIdTag
                . "','" . $paramCallFile
                . "','" . $paramURL
                . "','" . $paramCallbackFunction
                . "','" . $paramCallbackFunctionParameters
                . "'"
        ;
        $onChange = HtmlStandardEventsForm::EVENT_ONCHANGE
                . "=\""
                . Html::JS_SCRIPTNAME_DOACTION
                . "(" . $AjaxParameters . "); return false;\" "
        ;
        $this->setOnChange($onChange);
    }

    private function updateOnChangeWithAjaxAutoSave() {

        $paramIdTag = $this->getAjaxAutoSaveTableName() . "_" . $this->getAjaxAutoSaveFieldName() . "_" . $this->getAjaxAutoSaveKeyValue();
        $paramCallFile = self::AJAX_SCRIPT_UPDATE_DATA;
        $paramURL = "TableName=" . $this->getAjaxAutoSaveTableName()
                . "&KeyName=" . $this->getAjaxAutoSaveKeyName()
                . "&KeyValue=" . $this->getAjaxAutoSaveKeyValue()
                . "&FieldName=" . $this->getAjaxAutoSaveFieldName()
        ;
        $paramCallbackFunction = $this->getCallbackJavaScriptFunctionOnChange();
        $paramCallbackFunctionParameters = $this->getCallbackJavaScriptFunctionOnChangeParameters();

        $this->updateOnChangeWithAjaxDoAction(
                $paramIdTag
                , $paramCallFile
                , $paramURL
                , $paramCallbackFunction
                , $paramCallbackFunctionParameters
        );
    }

    public function getCallbackJavaScriptFunctionOnChange() {
        return $this->callbackJavaScriptFunctionOnChange;
    }

    public function getCallbackJavaScriptFunctionOnChangeParameters() {
        return $this->callbackJavaScriptFunctionOnChangeParameters;
    }

    public function setCallbackJavaScriptFunctionOnChange($callbackJavaScriptFunctionOnChange, $paramUpdateOnChange = TRUE) {
        $this->callbackJavaScriptFunctionOnChange = $callbackJavaScriptFunctionOnChange;
        if ($paramUpdateOnChange) {
            $this->updateOnChangeWithAjaxAutoSave();
        }
    }

    public function setCallbackJavaScriptFunctionOnChangeParameters($callbackJavaScriptFunctionOnChangeParameters, $paramUpdateOnChange = TRUE) {
        $this->callbackJavaScriptFunctionOnChangeParameters = $callbackJavaScriptFunctionOnChangeParameters;
        if ($paramUpdateOnChange) {
            $this->updateOnChangeWithAjaxAutoSave();
        }
    }

    private function getAjaxAutoSaveTableName() {
        return $this->AjaxAutoSaveTableName;
    }

    private function getAjaxAutoSaveFieldName() {
        return $this->AjaxAutoSaveFieldName;
    }

    private function getAjaxAutoSaveKeyName() {
        return $this->AjaxAutoSaveKeyName;
    }

    private function getAjaxAutoSaveKeyValue() {
        return $this->AjaxAutoSaveKeyValue;
    }

    private function setAjaxAutoSaveTableName($AjaxAutoSaveTableName, $paramUpdateOnChange = TRUE) {
        $this->AjaxAutoSaveTableName = $AjaxAutoSaveTableName;
        if ($paramUpdateOnChange) {
            $this->updateOnChangeWithAjaxAutoSave();
        }
    }

    private function setAjaxAutoSaveFieldName($AjaxAutoSaveFieldName, $paramUpdateOnChange = TRUE) {
        $this->AjaxAutoSaveFieldName = $AjaxAutoSaveFieldName;
        if ($paramUpdateOnChange) {
            $this->updateOnChangeWithAjaxAutoSave();
        }
    }

    private function setAjaxAutoSaveKeyName($AjaxAutoSaveKeyName, $paramUpdateOnChange = TRUE) {
        $this->AjaxAutoSaveKeyName = $AjaxAutoSaveKeyName;
        if ($paramUpdateOnChange) {
            $this->updateOnChangeWithAjaxAutoSave();
        }
    }

    private function setAjaxAutoSaveKeyValue($AjaxAutoSaveKeyValue, $paramUpdateOnChange = TRUE) {
        $this->AjaxAutoSaveKeyValue = $AjaxAutoSaveKeyValue;
        if ($paramUpdateOnChange) {
            $this->updateOnChangeWithAjaxAutoSave();
        }
    }

}
