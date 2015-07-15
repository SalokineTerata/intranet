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
 * Description of AbstractHtmlObject
 *
 * @author Boris Sanègre <boris.sanegre@ldc.fr>
 */
abstract class AbstractHtmlGlobalElement {

    /**
     * Par défaut, l'objet n'est pas éditable
     */
    const DEFAULT_IS_EDITABLE = FALSE;

    /**
     * Type de représentation lors du rendu HTML
     * form = Formulaire.
     *      - La représentation sera de type formulaire.
     *      - Le label précèdera la données.
     * 
     * table = Table.
     *      - La représentation sera de type table.
     *      - Le label ne sera pas affiché.
     */
    const HTML_RENDER_TO_FORM = "form";
    const HTML_RENDER_TO_TABLE = "table";

    /**
     * L'élément est-il modifiable ?
     * @var boolean
     */
    private $isEditable;

    /**
     * Sous quel forme l'élément doit-il être présenté ?
     * @var self::HTML_RENDER_TO_FORM | self::HTML_RENDER_TO_TABLE
     */
    private $htmlRender = NULL;

    /**
     * Object manipulant les évènements JavaScript possible sur le rendu HTML
     * @var EventsForm
     */
    private $eventsForm;

    /**
     * Object manipulant les évènements JavaScript possible sur le rendu HTML
     * @var EventsMouse
     */
    private $eventsMouse;

    /**
     *
     * @var AttributesGlobal
     */
    private $attributeGlobal;

    /**
     * CSS Properties.
     * @link http://www.w3schools.com/cssref/default.asp description
     * @var CustomStyleCSS
     */
    private $styleCSS;

    /**
     * Doit-on informer qu'il y a eu une mise à jour de la donnée ?
     * @var boolean 
     */
    private $isWarningUpdate;

    /**
     * Information complémentaire affichée après l'objet HTML
     * @var String
     */
    private $additionnalTextInfo;

    /**
     * Label pour un élément HTML.
     * Attention, ici nous personnalisation cette notion qui n'a rien à voir
     * avec http://www.w3schools.com/tags/tag_label.asp
     * @var string
     */
    private $label;

    /**
     * Doit-on affiche le label ?
     * @var boolean
     */
    private $showLabel;

    /**
     * Peut-on ajouter une donnée ?
     * @var boolean
     */
    private $rightToAdd;

    /**
     * Image à afficher en cas de modification de valeur
     * @var mixed 
     */
    private $ChangedImage;

    public function __construct() {
        /**
         * Par défaut l'élément est représenté sous forme de formulaire.
         */
        $this->setHtmlRenderToForm();
        $this->setShowLabelToTrue();
        $this->setEventsForm(new EventsForm());
        $this->setEventsMouse(new EventsMouse());
        $this->setStyleCSS(new CustomStyleCSS());
        $this->setAttributesGlobal(new AttributesGlobal());
    }

    protected function initAbstractHtmlGlobalElement(
    $paramId
    , $paramLabel
    , $paramIsWarningUpdate
    ) {

        $this->setLabel($paramLabel);
        $this->setIsWarningUpdate($paramIsWarningUpdate);
        $this->getAttributesGlobal()->getId()->setValue($paramId);
    }

    function getShowLabel() {
        return $this->showLabel;
    }

    function setShowLabelToFalse() {
        $this->showLabel = FALSE;
    }

    function setShowLabelToTrue() {
        $this->showLabel = TRUE;
    }

    /**
     * Retourne de la forme sous laquelle l'élément HTML sera représenté.
     * @return self::HTML_RENDER_TO_*
     */
    function getHtmlRender() {
        return $this->htmlRender;
    }

    /**
     * L'élément HTML sera représenté sous forme de formluaire.
     * @return mixed
     */
    function setHtmlRenderToForm() {
        $this->htmlRender = self::HTML_RENDER_TO_FORM;
    }

    /**
     * L'élément HTML sera représenté sous forme de formluaire.
     * @return mixed
     */
    function setHtmlRenderToTable() {
        $this->htmlRender = self::HTML_RENDER_TO_TABLE;
    }

    /**
     * 
     * @return AttributesGlobal
     */
    public function getAttributesGlobal() {
        return $this->attributeGlobal;
    }

    public function setAttributesGlobal(StandardGlobalAttributes $attributeGlobal) {
        $this->attributeGlobal = $attributeGlobal;
    }

    /**
     * Implémente le contenu HTML de l'objet lorsqu'il est éditable
     * Exemple de valeur de retour:
     */
    abstract public function getHtmlEditableContent();

    /**
     * Implémente le contenu HTML de l'objet lorsqu'il n'y a pas de donnée
     */
    abstract public function getHtmlAddContent();

    /**
     * Implémente le contenu HTML de l'objet lorsqu'il n'est pas éditable
     */
    abstract public function getHtmlViewedContent();

    /**
     * 
     * @return EventsMouse
     */
    public function getEventsMouse() {
        return $this->eventsMouse;
    }

    private function setEventsMouse(HtmlStandardEventsMouse $paramEventsMouse) {
        $this->eventsMouse = $paramEventsMouse;
    }

    /**
     * 
     * @return EventsForm
     */
    public function getEventsForm() {
        return $this->eventsForm;
    }

    private function setEventsForm(HtmlStandardEventsForm $paramEventsForm) {
        $this->eventsForm = $paramEventsForm;
    }

    /**
     * L'objet HTML est-il éditable ?
     * @param boolean $paramIsEditable
     */
    public function setIsEditable($paramIsEditable) {
        $this->isEditable = $paramIsEditable;
    }

    /**
     * 
     * @return boolean
     */
    public function getIsEditable() {
        return $this->isEditable;
    }

    /**
     * 
     * @return boolean
     */
    public function getIsWarningUpdate() {
        return $this->isWarningUpdate;
    }

    public function setIsWarningUpdate($paramIsWarningUpdate) {
        $this->isWarningUpdate = $paramIsWarningUpdate;
    }

    public function getAdditionnalTextInfo() {
        return $this->additionnalTextInfo;
    }

    public function setAdditionnalTextInfo($paramAdditionnalTextInfo) {
        $this->additionnalTextInfo = $paramAdditionnalTextInfo;
    }

    public function getLabel() {
        return $this->label;
    }

    public function setLabel($paramLabel) {
        $this->label = $paramLabel;
    }

    function getRightToAdd() {
        return $this->rightToAdd;
    }

    function setRightToAdd($rightToAdd) {
        $this->rightToAdd = $rightToAdd;
    }

    public function getHtmlResult() {

        //Définition des variables locales
        $image_modif = "";
        $color_modif = "";
        $html_result = "";
        $label = NULL;
        $idRow = $this->getAttributesGlobal()->getIdRowToHtml();
        $style = $this->getStyleCSS()->getStyleAttribute();

        /**
         * Doit-on afficher le label ?
         */
        if ($this->getShowLabel()) {
            $label = $this->getLabel();
        }

        //Traitement du Warning Update
        if ($this->getIsWarningUpdate()) {
            $image_modif = Html::DEFAULT_HTML_WARNING_UPDATE_IMAGE;
            $color_modif = Html::DEFAULT_HTML_WARNING_UPDATE_BGCOLOR;
        }

        //Rendu HTML - début encapsulation
        switch ($this->getHtmlRender()) {
            case self::HTML_RENDER_TO_FORM:
                $html_result .= "<tr " . $idRow . " " . $style . "class=contenu>";
                $html_result .= "<td style=\"$color_modif\">$label</td>";
                break;

            case self::HTML_RENDER_TO_TABLE:
                break;
        }
        $html_result .= "<td style=\"$color_modif\">";

        //Contenu
        if ($this->getIsEditable()) {
            if ($this->getRightToAdd()) {
                $html_result .= $this->getHtmlAddContent();
            } else {
                $html_result .= $this->getHtmlEditableContent();
            }
        } else {
            $html_result .= $this->getHtmlViewedContent();
        }
        if ($this->getAdditionnalTextInfo() != null) {
            $html_result.= "<i>&nbsp;" . Html::showValue($this->getAdditionnalTextInfo()) . "</i>";
        }

        //Rendu HTML - fin encapsulation
        switch ($this->getHtmlRender()) {
            case self::HTML_RENDER_TO_FORM:
                $html_result.= $image_modif . "</td></tr>";
                break;

            case self::HTML_RENDER_TO_TABLE:
                $html_result.= $image_modif . "</td>";
                break;
        }

        return $html_result;
    }

    /**
     * 
     * @return HtmlStandardStylesCSS
     */
    public function getStyleCSS() {
        return $this->styleCSS;
    }

    private function setStyleCSS(CustomStyleCSS $styleCSS) {
        $this->styleCSS = $styleCSS;
    }

}
