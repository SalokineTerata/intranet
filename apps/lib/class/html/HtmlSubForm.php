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
class HtmlSubForm extends AbstractHtmlList {

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

    private function getHtmlResultSubFormBegin() {
        return "<table><tr><td><table>";
    }

    private function getHtmlResultSubFormEnd() {
        return "</table></td></tr></table>";
    }

    private function getHtmlResultSubFormAddNewLine() {
        $return = NULL;
        if ($this->getIsRightToAdd()) {
            $return = "<tr><td>"
                    . $this->getAttributesGlobal()->getIconAddToHtml()
                    . "<a href=\"...\" title=\"Not implemented\"> Ajouter</a>"
                    . "</td></tr>"
            ;
        }
        return $return;
    }

    /**
     * Retourne le rendu HTML du coeur du sous-formulaire
     * @return string
     */
    private function getHtmlResultSubFormMiddle() {

        /**
         * Récupération du model de table à utiliser pour représenter
         * les données du sous-formulaire.
         */
        $subFormModelClassName = $this->getSubFormModelClassName();

        /**
         * Parcours de la liste des clefs à représenter
         */
        foreach ($this->getArrayContent() as $key => $valueArray) {

            /**
             * Création de la ligne HTML
             */
            $return.= "<tr class=contenu>";

            /**
             * Chargement de l'enregistrement
             */
            $modelSubForm = new $subFormModelClassName($key);

            /**
             * Récupération de la liste des champs à représenter
             */
            $valueArrayKeys = array_keys($valueArray);

            /**
             * Parcours des nom des champs à afficher
             */
            foreach ($valueArrayKeys as $fieldName) {

                /**
                 * Chargement du DataField correspondant au champs concerné.
                 */
                $dataField = $modelSubForm->getDataField($fieldName);

                /**
                 * Conversion du DataField en HtmlField
                 */
                $htmlField = Html::getHtmlObjectFromDataField($dataField);
                $htmlField->setHtmlRenderToTable();
                $htmlField->getAttributesGlobal()->setIsIconNextEnabledToTrue();

                /**
                 * Si le sous-formulaire est modifiable par l'utilisateur
                 * et que le champs ne fait pas partie de la liste des champs
                 * vérrouillés, alors le champs sera modifiable par l'utilisateur.
                 */
                if (parent::getIsEditable() && !in_array($fieldName, $this->getArrayContentLocked())) {

                    /**
                     * Le champs est modifiable.
                     */
                    $htmlField->setIsEditable(TRUE);
                } else {

                    /**
                     * Le champs n'est pas modifiable.
                     */
                    $htmlField->setIsEditable(FALSE);
                }
                $return.=$htmlField->getHtmlResult();
            }
            /**
             * Fermeture de la ligne HTML
             */
            $return.= "</tr>";
        }
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
        return $this->getHtmlResultSubFormBegin()
                . $this->getHtmlResultSubFormMiddle()
                . $this->getHtmlResultSubFormAddNewLine()
                . $this->getHtmlResultSubFormEnd()
        ;
    }

    public function getHtmlViewedContent() {
        return $this->getHtmlResultSubFormBegin()
                . $this->getHtmlResultSubFormMiddle()
                . $this->getHtmlResultSubFormEnd()
        ;
    }

}
