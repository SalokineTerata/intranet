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

namespace W3C;

/**
 * HTML Global Attributes
 * The global attributes below can be used on any HTML element.
 * @link http://www.w3schools.com/tags/ref_standardattributes.asp description
 * @author Boris Sanègre <boris.sanegre@ldc.fr>
 * @license see LICENSE.TXT at the root of this project
 */
abstract class AbstractGlobalAttributes {

    /**
     *
     * @var AttributeAccessKey 
     */
    private $accessKey;

    /**
     *
     * @var AttributeClass 
     */
    private $class;

    /**
     *
     * @var AttributeContentEditable 
     */
    private $contentEditable;

    /**
     *
     * @var AttributeContextMenu 
     */
    private $contextMenu;

    /**
     *
     * @var AttributeDir 
     */
    private $dir;

    /**
     *
     * @var AttributeDraggable
     */
    private $draggable;

    /**
     *
     * @var AttributeDropZone
     */
    private $dropzone;

    /**
     *
     * @var AttributeHidden
     */
    private $hidden;

    /**
     *
     * @var AttributeId
     */
    private $id;

    /**
     *
     * @var AttributeLang
     */
    private $lang;

    /**
      /**
     *
     * @var AttributeSpellCheck
     */
    private $spellCheck;

    /**
     *
     * @var AttributeStyle
     */
    private $style;

    /**
     *
     * @var AttributeTabIndex
     */
    private $tabIndex;

    /**
     *
     * @var AttributeTitle
     */
    private $title;

    /**
     *
     * @var AttributeTranslate
     */
    private $translate;

    public function getAllHtmlParametersWithSpaceBefore() {
        $return = NULL;

        if ($this->getHtmlParameters() != NULL) {
            $return = " " . $this->getHtmlParameters();
        }
        return $return;
    }

    abstract public function getAllHtmlParameters();

    public function getAllParametersWithSpaceBefore() {

        $data = $this->getAllGlobalHtmlParameters();
        $return = NULL;
        if ($data != NULL) {
            $return = " " . $data;
        }

        return $return;
    }

    public function getAllGlobalAttributes() {

        return $this->getAccessKey()
                . $this->getClassForHtmlParameter()
                . $this->getContentEditableForHtmlParameter()
                . $this->getContextMenuForHtmlParameter()
                . $this->getDirForHtmlParameter()
                . $this->getDraggableForHtmlParameter()
                . $this->getDropZoneForHtmlParameter()
                . $this->getHiddenForHtmlParameter()
                . $this->getIdForHtmlParameter()
                . $this->getLangForHtmlParameter()
                . $this->getSpellCheckForHtmlParameter()
                . $this->getStyleForHtmlParameter()
                . $this->getTabIndexForHtmlParameter()
                . $this->getTitleForHtmlParameter()
                . $this->getTranslateForHtmlParameter()
        ;
    }

    /**
     * 
     * @return AttributeAccessKey
     */
    public function getAccessKey() {
        return $this->accessKey;
    }

    /**
     * 
     * @return AttributeClass
     */
    public function getClass() {
        return $this->class;
    }

    /**
     * 
     * @return AttributeContentEditable
     */
    public function getContentEditable() {
        return $this->contentEditable;
    }

    /**
     * 
     * @return AttributeContextMenu
     */
    public function getContextMenu() {
        return $this->contextMenu;
    }

    /**
     * 
     * @return AttributeDir
     */
    public function getDir() {
        return $this->dir;
    }

    /**
     * 
     * @return AttributeDraggable
     */
    public function getDraggable() {
        return $this->draggable;
    }

    /**
     * 
     * @return AttributeDropZone
     */
    public function getDropzone() {
        return $this->dropzone;
    }

    /**
     * 
     * @return AttributeHidden
     */
    public function getHidden() {
        return $this->hidden;
    }

    /**
     * 
     * @return AttributeId
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * @return AttributeLang
     */
    public function getLang() {
        return $this->lang;
    }

    /**
     * 
     * @return AttributeSpellCheck
     */
    public function getSpellCheck() {
        return $this->spellCheck;
    }

    /**
     * 
     * @return AttributeStyle
     */
    public function getStyle() {
        return $this->style;
    }

    /**
     * 
     * @return AttributeTabIndex
     */
    public function getTabIndex() {
        return $this->tabIndex;
    }

    /**
     * 
     * @return AttributeTitle
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * 
     * @return AttributeTranslate
     */
    public function getTranslate() {
        return $this->translate;
    }

    public function setAccessKey(AttributeAccessKey $accessKey) {
        $this->accessKey = $accessKey;
    }

    public function setClass(AttributeClass $class) {
        $this->class = $class;
    }

    public function setContentEditable(AttributeContentEditable $contenteditable) {
        $this->contentEditable = $contenteditable;
    }

    public function setContextMenu(AttributeContextMenu $contextmenu) {
        $this->contextMenu = $contextmenu;
    }

    public function setDir(AttributeDir $dir) {
        $this->dir = $dir;
    }

    public function setDraggable(AttributeDraggable $draggable) {
        $this->draggable = $draggable;
    }

    public function setDropzone(AttributeDropZone $dropzone) {
        $this->dropzone = $dropzone;
    }

    public function setHidden(AttributeHidden $hidden) {
        $this->hidden = $hidden;
    }

    public function setId(AttributeId $id) {
        $this->id = $id;
    }

    public function setLang(AttributeLang $lang) {
        $this->lang = $lang;
    }

    public function setSpellCheck(AttributeSpellCheck $spellCheck) {
        $this->spellCheck = $spellCheck;
    }

    public function setStyle(AttributeStyle $style) {
        $this->style = $style;
    }

    public function setTabIndex(AttributeTabIndex $tabIndex) {
        $this->tabIndex = $tabIndex;
    }

    public function setTitle(AttributeTitle $title) {
        $this->title = $title;
    }

    public function setTranslate(AttributeTranslate $translate) {
        $this->translate = $translate;
    }

}
