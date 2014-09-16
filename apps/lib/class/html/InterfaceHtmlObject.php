<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author bs4300280
 */
interface InterfaceHtmlObject {

    /**
     * L'objet HTML est-il éditable ?
     * @param boolean $paramIsEditable
     */
    public function setIsEditable($paramIsEditable);

    /**
     * Retourne le rendu HTML de l'objet
     * @return string Code HTML
     */
    public function getHtmlResult();

    public function getEditableContent();

    public function getViewedContent();
}
