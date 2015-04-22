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
 * Description of AttributesGlobal
 *
 * @author salokine
 */
class AttributesGlobal extends StandardGlobalAttributes {

    const DEFAULT_HTML_IMAGE_ADD = "<img src=../lib/images/plus.png width=22  border=0 valign=middle halign=right />";
    const DEFAULT_HTML_IMAGE_FAILED = "<img src=../lib/images/bouton_croix_rouge.png width=22  border=0 valign=middle halign=right />";
    const DEFAULT_HTML_IMAGE_LOADING = "<img src=../lib/images/loading.gif width=22  border=0 valign=middle halign=right />";
    const DEFAULT_HTML_IMAGE_NEXT = "<img src=../lib/images/next.png width=22  border=0 valign=middle halign=right />";
    const DEFAULT_HTML_IMAGE_OK = "<img src=../lib/images/bouton_valide.png width=22  border=0 valign=middle halign=right />";
    const DEFAULT_HTML_IMAGE_UNDO = "<img src=../lib/images/undo.png width=22  border=0 valign=middle halign=right />";
    const PREFIXE_ID_ROW = "ROW";
    const PREFIXE_ID_DATA = "DATA";
    const PREFIXE_ID_ICON_ADD = "ADD";
    const PREFIXE_ID_ICON_NEXT = "NEXT";
    const PREFIXE_ID_ICON_STATUS = "STATUS";
    const PREFIXE_ID_ICON_UNDO = "ICON_UNDO";

    /**
     * Le bouton d'ajout est-il activé ?
     * @var boolean 
     */
    private $isIconAddEnabled;

    /**
     * Le bouton "suivant" est-il activé ?
     * @var boolean 
     */
    private $isIconNextEnabled;

    public function __construct() {
        parent::__construct();
        $this->setIsIconAddEnabledToFalse();
        $this->setIsIconNextEnabledToFalse();
    }

    function getIsIconAddEnabled() {
        return $this->isIconAddEnabled;
    }

    function setIsIconAddEnabledToTrue() {
        $this->isIconAddEnabled = TRUE;
    }

    function setIsIconAddEnabledToFalse() {
        $this->isIconAddEnabled = FALSE;
    }

    function getIsIconNextEnabled() {
        return $this->isIconNextEnabled;
    }

    function setIsIconNextEnabledToTrue() {
        $this->isIconNextEnabled = TRUE;
    }

    function setIsIconNextEnabledToFalse() {
        $this->isIconNextEnabled = FALSE;
    }

    public function getIdData() {
        return self::PREFIXE_ID_DATA . "_" . $this->getId()->getValue();
    }

    public function getIdRow() {
        return self::PREFIXE_ID_ROW . "_" . $this->getId()->getValue();
    }

    public function getIdAdd() {
        return self::PREFIXE_ID_ICON_ADD . "_" . $this->getId()->getValue();
    }

    public function getIdNext() {
        return self::PREFIXE_ID_ICON_NEXT . "_" . $this->getId()->getValue();
    }

    public function getIdStatus() {
        return self::PREFIXE_ID_ICON_STATUS . "_" . $this->getId()->getValue();
    }

    public function getIdUndo() {
        return self::PREFIXE_ID_ICON_UNDO . "_" . $this->getId()->getValue();
    }

    public function getIdDataToHtml() {
        return Html::getHtmlParameter(
                        $this->getId()->getName()
                        , $this->getIdData()
        );
    }

    public function getIdRowToHtml() {
        return Html::getHtmlParameter(
                        $this->getId()->getName()
                        , $this->getIdRow()
        );
    }

    public function getIdAddToHtml() {
        return Html::getHtmlParameter(
                        $this->getId()->getName()
                        , $this->getIdAdd()
        );
    }

    public function getIdNextToHtml() {
        return Html::getHtmlParameter(
                        $this->getId()->getName()
                        , $this->getIdNext()
        );
    }

    public function getIdStatusToHtml() {
        return Html::getHtmlParameter(
                        $this->getId()->getName()
                        , $this->getIdStatus()
        );
    }

    public function getIdUndoToHtml() {
        return Html::getHtmlParameter(
                        $this->getId()->getName()
                        , $this->getIdUndo()
        );
    }

    /**
     * Retourne le code HTML affichant les icones d'action en fin de champs de saisie.
     * @param string
     */
    public function getIconAddToHtml() {
        return "<a href=\"...\" title=\"Not implemented\">"
                . "<span " . $this->getIdAddToHtml() . ">" . self::DEFAULT_HTML_IMAGE_ADD . "</span>"
                . "</a>"
        ;
    }

    public function getIconNextToHtml() {
        return "<a href=\"...\" title=\"Not implemented\">"
                . "<span " . $this->getIdNextToHtml() . ">" . self::DEFAULT_HTML_IMAGE_NEXT . "</span>"
                . "</a>"
        ;
    }

    public function getIconMenuToHtml() {

        $return = "<span " . $this->getIdStatusToHtml() . ">" . self::DEFAULT_HTML_IMAGE_OK . "</span>";
        if ($this->getIsIconAddEnabled()) {
            $return.=$this->getIconAddToHtml();
        }
        if ($this->getIsIconNextEnabled()) {
            $return.=$this->getIconNextToHtml();
        }

        return $return;
    }

}
