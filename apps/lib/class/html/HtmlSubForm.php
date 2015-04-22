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
class HtmlSubForm extends AbstractHtmlGlobalElement {

    /**
     * Tableau PHP stockant le résultat de la requête sur laquelle est basée
     * le sous-formulaire.
     * @var array 
     */
    private $arrayContent = NULL;

    /**
     * Nom de la classe désignat le model de base de données utilisé
     * @var mixed 
     */
    private $subFormModelClassName = NULL;

    /**
     * Quels sont les éléments du sous formulaire qui sont vérrouillés ?
     *   - Si l'attribut $isEditable du sous-formulaire est FALSE,
     *     Cet attribut n'apporte aucune modification car tous les champs du
     *     sous-formulaire sont déjà vérouillés.
     *   - Si l'attribut $isEditable du sous-formulaire est TRUE,
     *     Cet attribut de type tableau contient la liste des champs qu'il faut
     *     tout de même vérouiller.
     * @var array
     */
    private $arrayContentLocked;

    function __construct($paramArrayContent, $paramSubFormModelClassName, $paramLabel) {
        parent::__construct();
        parent::setLabel($paramLabel);
        $this->setArrayContent($paramArrayContent);
        $this->setSubFormModelClassName($paramSubFormModelClassName);
    }

    function getArrayContentLocked() {
        return $this->arrayContentLocked;
    }

    function setArrayContentLocked($arrayContentLocked) {
        $this->arrayContentLocked = $arrayContentLocked;
    }

    private function getHtmlResultSubForm() {
        $return = NULL;
        $return .= "<table><tr><td>";
        $return .="<table>";
        $subFormModelClassName = $this->getSubFormModelClassName();
        foreach ($this->getArrayContent() as $key => $valueArray) {


            $modelSubForm = new $subFormModelClassName($key);
            $valueArrayKeys = array_keys($valueArray);

            $return.= "<tr class=contenu>";
            foreach ($valueArrayKeys as $fieldName) {
                $dataField = $modelSubForm->getDataField($fieldName);
                $dataField->setLabelCustom(NULL);
                $htmlField = Html::getHtmlObjectFromDataField($dataField);

                //Si le sous-formulaire est modifiable par l'utilisateur
                //et que le champs ne fait pas partie de la liste des champs
                //vérrouillés, alors le champs sera modifiable par l'utilisateur.
                if (parent::getIsEditable() && !in_array($fieldName, $this->getArrayContentLocked())) {
                    //Le champs est modifiable.
                    $htmlField->setIsEditable(TRUE);
                } else {
                    //Le champs n'est pas modifiable.
                    $htmlField->setIsEditable(FALSE);
                }
                $htmlField->setHtmlRenderToTable();
                $htmlField->getAttributesGlobal()->setIsIconNextEnabledToTrue();
                $return.=$htmlField->getHtmlResult();
            }
            $return.= "</tr>";
        }
        if (parent::getIsEditable()) {

            $return.="<tr><td>"
                    . $this->getAttributesGlobal()->getIconAddToHtml()
                    . "<a href=\"...\" title=\"Not implemented\"> Ajouter</a></td></tr>"
            ;
        }
        $return .= "</table>";
        $return .= "</div></td></tr></table>";
        return $return;
    }

    function getArrayContent() {
        return $this->arrayContent;
    }

    function getSubFormModelClassName() {
        return $this->subFormModelClassName;
    }

    function setArrayContent($arrayContent) {
        $this->arrayContent = $arrayContent;
    }

    function setSubFormModelClassName($subFormModelClassName) {
        $this->subFormModelClassName = $subFormModelClassName;
    }

    public function getHtmlEditableContent() {
        return $this->getHtmlResultSubForm();
    }

    public function getHtmlViewedContent() {
        return $this->getHtmlResultSubForm();
    }

}
