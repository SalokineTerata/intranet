<?php

/**
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
 * Evènements globaux HTML
 * @link http://www.w3schools.com/tags/ref_eventattributes.asp Documentation
 * @author salokine@gmail.com
 * @license see LICENSE.TXT at the root of this project
 * @version 1.0
 */
class HtmlStandardEventsForm extends AbstractAllHtmlParameters {

    /**
     * Valeur à définir lorsqu'on souhaite désactiver un attribut
     */
    const UNSET_VALUE = NULL;

    /**
     * Form Event onblur
     * Fires the moment that the element loses focus
     * @link http://www.w3schools.com/tags/ev_onblur.asp Documentation
     * @var mixed script
     */
    protected $OnBlur;

    const EVENT_ONBLUR = 'onblur';

    /**
     * Form Event onchange
     * Fires the moment when the value of the element is changed
     * @link http://www.w3schools.com/tags/ev_onchange.asp Documentation
     * @var mixed script
     * 
     */
    protected $OnChange;

    const EVENT_ONCHANGE = 'onchange';

    /**
     * Form Event oncontextmenu
     * Supported: HTML5
     * Script to be run when a context menu is triggered
     * @link http://www.w3schools.com/tags/ref_eventattributes.asp Documentation
     * @var mixed script
     */
    protected $OnContextMenu;

    const EVENT_ONCONTEXTMENU = 'oncontextmenu';

    /**
     * Form Event onfocus
     * Fires the moment when the element gets focus
     * @link http://www.w3schools.com/tags/ev_onfocus.asp Documentation
     * @var mixed script
     */
    protected $OnFocus;

    const EVENT_ONFOCUS = 'onfocus';

    /**
     * Form Event onformchange
     * Supported: HTML5
     * Script to be run when a form changes
     * @link http://www.w3schools.com/tags/ref_eventattributes.asp Documentation
     * @var mixed script
     */
    protected $OnFormChange;

    const EVENT_ONFORMCHANGE = 'onformchange';

    /**
     * Form Event onforminput
     * Supported: HTML5
     * Script to be run when a form gets user input
     * @link http://www.w3schools.com/tags/ref_eventattributes.asp Documentation
     * @var mixed script
     */
    protected $OnFormInput;

    const EVENT_ONFORMINPUT = 'onforminput';

    /**
     * Form Event oninput
     * Supported: HTML5
     * Script to be run when an element gets user input
     * @link http://www.w3schools.com/tags/ref_eventattributes.asp Documentation
     * @var mixed script
     */
    protected $OnInput;

    const EVENT_ONINPUT = 'oninput';

    /**
     * Form Event onivalid
     * Support: HTML5
     * Script to be run when an element is invalid
     * @link http://www.w3schools.com/tags/ref_eventattributes.asp Documentation
     * @var mixed script
     */
    protected $OnInvalid;

    const EVENT_ONINVALID = 'oninvalid';

    /**
     * Form Event onselect
     * Fires after some text has been selected in an element
     * The onselect attribute can be used within: <input type='file'>,
     * <input type='password'>, <input type='text'>, <keygen>, and <textarea>
     * @link http://www.w3schools.com/tags/ev_onselect.asp Documentation
     * @var mixed script
     */
    protected $OnSelect;

    const EVENT_ONSELECT = 'onselect';

    /**
     * Form Event onsubmit
     * Fires when a form is submitted
     * @link http://www.w3schools.com/tags/ev_onsubmit.asp Documentation
     * @var mixed script
     */
    protected $OnSubmit;

    const EVENT_ONSUBMIT = 'onsubmit';

    public function getAllHtmlParameters() {

        return $this->getOnBlur()
                . $this->getOnChange()
                . $this->getOnContextMenu()
                . $this->getOnFocus()
                . $this->getOnFormChange()
                . $this->getOnFormInput()
                . $this->getOnInput()
                . $this->getOnInvalid()
                . $this->getOnSelect()
                . $this->getOnSubmit()
        ;
    }

    /**
     * Retourne le nom de script défini pour l'évènement onblur
     * @return mixed
     */
    public function getOnBlur() {
        return $this->OnBlur;
    }

    /**
     * Défini le nom du script utilisé pour l'évènement onblur
     * @param mixed $paramOnBlur
     */
    public function setOnBlur($paramOnBlur) {
        $this->OnBlur = $paramOnBlur;
    }

    /**
     * Désactive l'évènement onblur
     */
    public function unsetOnBlur() {
        $this->OnBlur = self::UNSET_VALUE;
    }

    /**
     * Retourne le nom de script défini pour l'évènement onchange
     * @return mixed
     */
    public function getOnChange() {
        return $this->OnChange;
    }

    /**
     * Défini le nom du script utilisé pour l'évènement onchange
     * @param mixed $paramOnChange
     */
    public function setOnChange($paramOnChange) {
        $this->OnChange = $paramOnChange;
    }

    /**
     * Désactive l'évènement onchange
     */
    public function unsetOnChange() {
        $this->OnChange = self::UNSET_VALUE;
    }

    /**
     * Retourne le nom de script défini pour l'évènement oncontextmenu
     * @return mixed
     */
    public function getOnContextMenu() {
        return $this->OnContextMenu;
    }

    /**
     * Défini le nom du script utilisé pour l'évènement oncontextmenu
     * @param mixed $paramOnContextMenu
     */
    public function setOnContextMenu($paramOnContextMenu) {
        $this->OnContextMenu = $paramOnContextMenu;
    }

    /**
     * Désactive l'évènement oncontextmenu
     */
    public function unsetOnContextMenu() {
        $this->OnContextMenu = self::UNSET_VALUE;
    }

    /**
     * Retourne le nom de script défini pour l'évènement onfocus
     * @return mixed
     */
    public function getOnFocus() {
        return $this->OnFocus;
    }

    /**
     * Défini le nom du script utilisé pour l'évènement onfocus
     * @param mixed $paramOnFocus
     */
    public function setOnFocus($paramOnFocus) {
        $this->OnFocus = $paramOnFocus;
    }

    /**
     * Désactive l'évènement onfocus
     */
    public function unsetOnFocus() {
        $this->OnFocus = self::UNSET_VALUE;
    }

    /**
     * Retourne le nom de script défini pour l'évènement onformchange
     * @return mixed
     */
    public function getOnFormChange() {
        return $this->OnFormChange;
    }

    /**
     * Défini le nom du script utilisé pour l'évènement onformchange
     * @param mixed $paramOnFormChange
     */
    public function setOnFormChange($paramOnFormChange) {
        $this->OnFormChange = $paramOnFormChange;
    }

    /**
     * Désactive l'évènement onformchange
     */
    public function unsetOnFormChange() {
        $this->OnFormChange = self::UNSET_VALUE;
    }

    /**
     * Retourne le nom de script défini pour l'évènement onforminput
     * @return mixed
     */
    public function getOnFormInput() {
        return $this->OnFormInput;
    }

    /**
     * Défini le nom du script utilisé pour l'évènement onforminput
     * @param mixed $paramOnFormInput
     */
    public function setOnFormInput($paramOnFormInput) {
        $this->OnFormInput = $paramOnFormInput;
    }

    /**
     * Désactive l'évènement onforminput
     */
    public function unsetOnFormInput() {
        $this->OnFormInput = self::UNSET_VALUE;
    }

    /**
     * Retourne le nom de script défini pour l'évènement oninput
     * @return mixed
     */
    public function getOnInput() {
        return $this->OnInput;
    }

    /**
     * Défini le nom du script utilisé pour l'évènement oninput
     * @param mixed $paramOnInput
     */
    public function setOnInput($paramOnInput) {
        $this->OnInput = $paramOnInput;
    }

    /**
     * Désactive l'évènement oninput
     */
    public function unsetOnInput() {
        $this->OnInput = self::UNSET_VALUE;
    }

    /**
     * Retourne le nom de script défini pour l'évènement oninvalid
     * @return mixed
     */
    public function getOnInvalid() {
        return $this->OnInvalid;
    }

    /**
     * Défini le nom du script utilisé pour l'évènement oninvalid
     * @param mixed $paramOnInvalid
     */
    public function setOnInvalid($paramOnInvalid) {
        $this->OnInvalid = $paramOnInvalid;
    }

    /**
     * Désactive l'évènement oninvalid
     */
    public function unsetOnInvalid() {
        $this->OnInvalid = self::UNSET_VALUE;
    }

    /**
     * Retourne le nom de script défini pour l'évènement onselect
     * @return mixed
     */
    public function getOnSelect() {
        return $this->OnSelect;
    }

    /**
     * Défini le nom du script utilisé pour l'évènement onselect
     * @param mixed $paramOnSelect
     */
    public function setOnSelect($paramOnSelect) {
        $this->OnSelect = $paramOnSelect;
    }

    /**
     * Désactive l'évènement onselect
     */
    public function unsetOnSelect() {
        $this->OnSelect = self::UNSET_VALUE;
    }

    /**
     * Retourne le nom de script défini pour l'évènement onsubmit
     * @return mixed
     */
    public function getOnSubmit() {
        return $this->OnSubmit;
    }

    /**
     * Défini le nom du script utilisé pour l'évènement onsubmit
     * @param mixed $paramOnSubmit
     */
    public function setOnSubmit($paramOnSubmit) {
        $this->OnSubmit = $paramOnSubmit;
    }

    /**
     * Désactive l'évènement onsubmit
     */
    public function unsetOnSubmit() {
        $this->OnSubmit = self::UNSET_VALUE;
    }

}

?>
