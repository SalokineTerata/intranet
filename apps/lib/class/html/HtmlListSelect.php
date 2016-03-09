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
 * Description of HtmlListSelect
 * Représentation HTML de la balise <SELECT>
 * 
 * @author bs4300280
 */
class HtmlListSelect extends AbstractHtmlList {

    /**
     * Object manipulant les attributs possible pour cet élément HTML
     * @var AttributesSelect
     */
    private $attributes;

    /**
     * Tableau de tag option
     * @var array tableau d'objet de type HtmlTagOption
     */
    private $arrayHtmlTagOption;

    /**
     * Valeur sélectionnée dans la liste
     * @var mixed $selectValue
     */
    private $selectedValue;

    /**
     * Tableau clef/valeur représentant le contenu de la liste déroulante
     * @var type 
     */
    private $arrayListContent;

    /**
     * Valeur par défaut de la liste déroulante
     * @var mixed $defaultValue
     */
    private $defaultValue;

    const LIST_EMPTY_VALUE = -1;
    const LIST_EMPTY_MESSAGE = 'Aucun élément présent dans cette liste.';
    const LIST_NO_VALID_SELECTION_MESSAGE = 'Aucun élément sélectionné dans cette liste.';
    const LIST_NO_SELECTION_VALUE = '<i>Aucune valeur sélectionnée</i>';

    public function __construct() {
        parent::__construct();
        $this->setAttributes(new AttributesSelect());
    }

    public function initAbstractHtmlSelect(
    $paramName
    , $paramLabel
    , $paramValue
    , $paramIsWarningUpdate
    , $paramArrayListContent
    , $paramIsWarningMessage = NULL
    , $paramWarningMessage = NULL
    ) {
        $id = $paramName;
        parent::initAbstractHtmlGlobalElement(
                $id
                , $paramLabel
                , $paramIsWarningUpdate
                , $paramIsWarningMessage
                , $paramWarningMessage
        );

        $this->getAttributes()->getName()->setValue($paramName);
        $this->setSelectedValue($paramValue);
        $this->setArrayListContent($paramArrayListContent);
    }

    /**
     * Retourne le code HTML pour présenter la liste en mode consultation
     */
    public function getHtmlViewedContent() {
        if ($this->getSelectedValue()) {
            $return = $this->getSelectedContent();
        } else {
            $return = self::LIST_NO_SELECTION_VALUE;
        }
        return $return;
    }

    public function getHtmlAddContent() {

        return;
    }

    public function getHtmlEditableContent() {

        $oneSelected = FALSE;
        if ($this->getArrayListContent()) {
            $return .= '<' . $this->getAttributes()->getTagName()
                    . parent::getAttributesGlobal()->getAllHtmlParametersWithSpaceBefore()
                    . parent::getEventsForm()->getAllHtmlParametersWithSpaceBefore()
                    . $this->getAttributes()->getAllHtmlParametersWithSpaceBefore()
                    . '/>'
            ;

            //Création du contenu de la liste
            foreach ($this->getArrayListContent() as $optionKey => $optionValue) {
                $option = new HtmlTagOption();
                $option->getAttributes()->getValue()->setValue($optionKey);
                $option->setDiplayValue($optionValue);

                if ($optionKey == $this->getSelectedValue()) {

                    $option->getAttributes()->getSelected()->setTrue();
                    $oneSelected = TRUE;
                } else {
                    $option->getAttributes()->getSelected()->setFalse();
                }

                $return .= '<'
                        . $option->getAttributes()->getTagName()
                        . $option->getAttributes()->getAllHtmlParametersWithSpaceBefore() . '>'
                        . $option->getDiplayValueToHtml()
                        . '</' . $option->getAttributes()->getTagName() . '>';
            }
            if ($oneSelected == FALSE) {
                $option = new HtmlTagOption();
                $option->getAttributes()->getValue()->setValue(self::LIST_EMPTY_VALUE);
                $option->setDiplayValue(self::LIST_NO_VALID_SELECTION_MESSAGE);
                $option->getAttributes()->getSelected()->setTrue();
                $return .= '<'
                        . $option->getAttributes()->getTagName()
                        . $option->getAttributes()->getAllHtmlParametersWithSpaceBefore() . '>'
                        . $option->getDiplayValueToHtml()
                        . '</' . $option->getAttributes()->getTagName() . '>';
            }
            $return .= '</' . $this->getAttributes()->getTagName() . '>';
//                    . parent::getAttributesGlobal()->getIconMenuToHtml();
        } else {
            $return .= '<i>' . Html::showValue(self::LIST_EMPTY_MESSAGE) . '</i>';
        }
        return $return;
    }

    /**
     * Retourne la valeur par défaut de la liste
     * @return mixed
     */
    public function getDefaultValue() {
        return $this->defaultValue;
    }

    /**
     * Défini la valeur par défaut de la liste déroulante
     * @param mixed $paramDefaultValue
     */
    public function setDefaultValue($paramDefaultValue) {
        $this->defaultValue = $paramDefaultValue;
    }

    /**
     * Défini le tableau (2 colonnes) du contenu de la liste déroulante
     */
    public function setArrayListContent($paramArrayListContent) {
        $this->arrayListContent = $paramArrayListContent;
    }

    /**
     * Tableau clef/valeur du contenu de la liste
     * @return array
     */
    public function getArrayListContent() {
        return $this->arrayListContent;
    }

    /**
     * Défini la valeur sélectionné dans la liste déroulante.
     * Si il n'y a pas de valeur sélectionnée, la valeur par défaut est utilisée
     * @param mixed $paramSelectedValue
     */
    public function setSelectedValue($paramSelectedValue = NULL) {
        if ($paramSelectedValue == NULL) {
            $this->selectedValue = $this->getDefaultValue();
        } else {
            $this->selectedValue = $paramSelectedValue;
        }
    }

    /**
     * Retourne la valeur sélectionnée dans la liste
     * @return mixed
     */
    public function getSelectedValue() {
        return $this->selectedValue;
    }

    /**
     * Retourne le libellé de la valeur sélectionnée dans la liste
     * @return mixed
     */
    public function getSelectedContent() {
        $arrayContent = $this->getArrayListContent();
        return $arrayContent[$this->getSelectedValue()];
    }

    /**
     * 
     * @return AttributesSelect
     */
    public function getAttributes() {
        return $this->attributes;
    }

    public function setAttributes(AttributesSelect $attributesSelect) {
        $this->attributes = $attributesSelect;
    }

    /**
     * Retourne le tableau d'objet HtmlTagOption
     * @return array HtmlTagOption
     */
    public function getArrayHtmlTagOption() {
        return $this->arrayHtmlTagOption;
    }

    /**
     * Défini le tableau d'objet HtmlTagOption
     * @param array $arrayHtmlTagOption tableau d'objet HtmlTagOption
     */
    public function setArrayHtmlTagOption($arrayHtmlTagOption) {
        $this->arrayHtmlTagOption = $arrayHtmlTagOption;
    }

    /**
     * Défini le tableau d'objet HtmlTagOption à partir d'un simple tableau PHP
     * @param array $arrayHtmlTagOptionFromPhpArray
     */
    public function setArrayHtmlTagOptionFromPhpArray($arrayHtmlTagOptionFromPhpArray) {
        foreach ($arrayHtmlTagOptionFromPhpArray as $key => $value) {
            $htmlTagOption = new HtmlTagOption();
            $htmlTagOption->getAttributes()->getValue()->setValue($key);
            $htmlTagOption->getAttributes()->getLabel()->setValue($value);
            $this->addHtmlTagOption($htmlTagOption);
        }
    }

    /**
     * Désactive le tableau d'objet HtmlTagOption
     */
    public function unsetArrayHtmlTagOption() {
        $this->arrayHtmlTagOption = self::UNSET_VALUE;
    }

    /**
     * Ajoute un tag <option> dans la liste <select>
     * @param HtmlTagOption $paramHtmlTagOption
     */
    public function addHtmlTagOption(HtmlTagOption $paramHtmlTagOption) {

        /**
         * Récupération du tableau actuel
         * Si il n'y a pas de valeur actuellement dans le tableau, 
         * celui-ci est NULL
         * On le force dans ce cas en tant que tableau
         */
        if ($this->getArrayHtmlTagOption() != NULL) {
            $array = $this->getArrayHtmlTagOption();
        } else {
            $array = array();
        }

        /**
         * Ajout du nouvel élément
         */
        $array[] = $paramHtmlTagOption;

        /**
         * Reclassement alphabétique
         */
        asort($array);
        /**
         * Enregistrement du tableau
         */
        $this->setArrayHtmlTagOption($array);
    }

}
