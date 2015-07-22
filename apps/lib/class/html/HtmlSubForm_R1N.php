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
 * Description of HtmlSubForm_R1N
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
class HtmlSubForm_R1N extends HtmlSubForm {

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

    function __construct($paramArrayContent, $paramSubFormModelClassName, $paramLabel) {
        parent::__construct();
        parent::setLabel($paramLabel);
        $this->setArrayContent($paramArrayContent);
        $this->setSubFormModelClassName($paramSubFormModelClassName);
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
        if ($this->getArrayContent()) {
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
                 * Récupération de l'icone pour accéder à l'enregistrement de la
                 * sous-table.
                 * Ce flag permet de ne récupérer que le premier champs.
                 */
                $isFirstField = TRUE;

                /**
                 * Contenu HTML du lien pointant vers le détail de la sous-table.
                 */
                $htmlUrlToSubFormDetail = NULL;


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

                    /**
                     * Dans le cas du premier champ de la ligne, on récupère
                     * le lien pointant vers le détail du sous-formulaire
                     */
                    if ($isFirstField) {
                        $htmlField->getAttributesGlobal()->setIsIconNextEnabledToTrue();
                        /**
                         * Création du lien de détail
                         */
                        $htmlUrlToSubFormDetail = $htmlField->getAttributesGlobal()->getIconNextToHtml();
                        $isFirstField = FALSE;
                    }
                    $htmlField->getAttributesGlobal()->setIsIconNextEnabledToFalse();

                    $htmlField->setHtmlRenderToTable();

                    /**
                     * Si le sous-formulaire est modifiable par l'utilisateur
                     * et que le champs ne fait pas partie de la liste des champs
                     * vérrouillés, alors le champs sera modifiable par l'utilisateur.
                     */
                    if (parent::getIsEditable() && !in_array($fieldName, $this->getContentLocked())) {

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
                 * Ajout du lien d'accès au détail du sous-formulaire
                 */
                $return.="<td>" . $htmlUrlToSubFormDetail . "</td>";
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

    public function getHtmlAddContent() {
        return;
    }

    public function getHtmlViewedContent() {
        return $this->getHtmlResultSubFormBegin()
                . $this->getHtmlResultSubFormMiddle()
                . $this->getHtmlResultSubFormEnd()
        ;
    }

}
