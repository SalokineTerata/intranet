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
     * L'élément est-il modifiable ?
     * @var boolean
     */
    private $isEditable;

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
     * Image à afficher en cas de modification de valeur
     * @var mixed 
     */
    private $ChangedImage;

    public function __construct() {
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

    public function getHtmlResult() {

        //Définition des variables locales
        $image_modif = "";
        $color_modif = "";
        $html_result = "";
        $label = $this->getLabel();
        $idRow = $this->getAttributesGlobal()->getIdRowToHtml();
        $style = $this->getStyleCSS()->getStyleAttribute();

        //Traitement du Warning Update
        if ($this->getIsWarningUpdate()) {
            $image_modif = Html::DEFAULT_HTML_WARNING_UPDATE_IMAGE;
            $color_modif = Html::DEFAULT_HTML_WARNING_UPDATE_BGCOLOR;
        }

        //Rendu HTML
        $html_result .= "<tr " . $idRow . " " . $style . "class=contenu>"
                . "<td style=\"$color_modif\">$label</td>"
                . "<td style=\"$color_modif\">"
        ;
        if ($this->getIsEditable()) {
            $html_result .= $this->getHtmlEditableContent();
        } else {
            $html_result .= $this->getHtmlViewedContent();
        }
        if ($this->getAdditionnalTextInfo() != null) {
            $html_result.= "<i>&nbsp;" . Html::showValue($this->getAdditionnalTextInfo()) . "</i>";
        }

        $html_result.= $image_modif . "</td></tr>";
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
