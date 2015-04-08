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
 * Description of HtmlSubForm
 * 
 * Permet de créer un sous formulaire dans un formulaire HTML.
 * Le sous formulaire est basé sur une requête dont le résultat retourne
 * 3 champs:
 * - 1er champs = clef unique qui ne sera pas visible sur l'interface utilisateur
 * - 2ème champs = intitulé de la ligne
 * - 3ème champs = champs à gérer et pouvant être modifié par l'utilisateur
 *
 * @author bs4300280
 */
class HtmlSubForm3Fields {

    /**
     * Tableau PHP stockant le résultat de la requête sur laquelle est basée
     * le sous-formulaire.
     * @var array 
     */
    private $arrayContent = NULL;

    /**
     * Titre du sous formulaire.
     * @var mixed
     */
    private $title = NULL;

    /**
     * Identifiant de la balise HTML <DIV>
     * @var mixed 
     */
    private $divId = NULL;

    /**
     * Nom de la classe désignat le model de base de données utilisé
     * @var mixed 
     */
    private $subFormModelClassName = NULL;

    function __construct($paramArrayContent, $paramSubFormModelClassName, $paramTitle = NULL, $paramDivId = NULL) {

        $this->setArrayContent($paramArrayContent);
        $this->setSubFormModelClassName($paramSubFormModelClassName);
        $this->setTitle($paramTitle);
        $this->setDivId($paramDivId);
    }

    function getHtmlResult() {
        $return = NULL;
        $return .= "<table><tr><td><fieldset>";
        $return .= "<legend>" . $this->getTitle() . "</legend>";
        $return .= "<div id=\"" . $this->getDivId() . "\">";
        $return .="<table>";
        foreach ($this->getArrayContent() as $key => $valueArray) {

            $subFormModelClassName = $this->getSubFormModelClassName();
            $modelSubForm = new $subFormModelClassName($key);
            $valueArrayKeys = array_keys($valueArray);

            $dataField = $modelSubForm->getDataField($valueArrayKeys[2]);
            $dataField->setLabelCustom($valueArray[$valueArrayKeys[1]]);
            $htmlField = Html::convertDataFieldToHtml($dataField, TRUE);

            $return.=$htmlField;
        }
        $return .= "</table>";
        $return .= "</div></fieldset></td></tr></table>";
        return $return;
    }

    function getArrayContent() {
        return $this->arrayContent;
    }

    function getTitle() {
        return $this->title;
    }

    function getDivId() {
        return $this->divId;
    }

    function getSubFormModelClassName() {
        return $this->subFormModelClassName;
    }

    function setArrayContent($arrayContent) {
        $this->arrayContent = $arrayContent;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setDivId($divId) {
        $this->divId = $divId;
    }

    function setSubFormModelClassName($subFormModelClassName) {
        $this->subFormModelClassName = $subFormModelClassName;
    }

}
