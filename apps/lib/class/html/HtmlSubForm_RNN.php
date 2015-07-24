<?php

/*
 * Copyright (C) 2015 tp4300001
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
 * 3 type de champs:
 * - 1er champs = clef unique qui ne sera pas visible sur l'interface utilisateur
 * - 2ème champs = intitulé de la ligne
 * - 3ème champs = champs à gérer et pouvant être modifié par l'utilisateur
 * 
 * @author tp4300001
 */
class HtmlSubForm_RNN extends HtmlSubForm {

    /**
     * Tableau PHP stockant le résultat de la requête sur laquelle est basée
     * le sous-formulaire.
     * @var array 
     */
    private $arrayPrimaryContent = NULL;

    /**
     * Nom de la classe désignat le model de base de données utilisé
     * @var mixed 
     */
    private $subFormPrimaryModelClassName = NULL;

    /**
     * Liste des noms de tables et clés étrangères du model de base de données utilisé et l'id Fta encours
     * @var array 
     */
    private $secondaryTableNamesAndIdKeyValue = NULL;

    /**
     * Lien ajouter en début d'édition
     * @var string
     */
    private $Lien;

    /**
     * Lien ajouter en fin d'édition
     * @var string
     */
    private $LienAjouter;

    /**
     * Lien de supresssion
     * @var string
     */
    private $LienSuppression;

    const VIRTUAL = "VIRTUAL";

    function __construct($paramArrayPrimaryContent = NULL, $paramSubFormPrimaryModelClassName = NULL, $paramPrimaryLabel = NULL, $secondaryTableNamesAndIdKeyValue = NULL) {
        parent::__construct();
        parent::setLabel($paramPrimaryLabel);
        $this->setArrayPrimaryContent($paramArrayPrimaryContent);
        $this->setSubFormPrimaryModelClassName($paramSubFormPrimaryModelClassName);
        $this->setSecondaryTableNamesAndIdKeyValue($secondaryTableNamesAndIdKeyValue);
    }

    function getArrayPrimaryContent() {
        return $this->arrayPrimaryContent;
    }

    function getSubFormPrimaryModelClassName() {
        return $this->subFormPrimaryModelClassName;
    }

    function getSecondaryTableNamesAndIdKeyValue() {
        return $this->secondaryTableNamesAndIdKeyValue;
    }

    function setArrayPrimaryContent($arrayPrimaryContent) {
        $this->arrayPrimaryContent = $arrayPrimaryContent;
    }

    function setSubFormPrimaryModelClassName($subFormPrimaryModelClassName) {
        $this->subFormPrimaryModelClassName = $subFormPrimaryModelClassName;
    }

    function setSecondaryTableNamesAndIdKeyValue($secondaryTableNamesAndIdKeyValue) {
        $this->secondaryTableNamesAndIdKeyValue = $secondaryTableNamesAndIdKeyValue;
    }

    function getLienAjouter() {
        return $this->LienAjouter;
    }

    function setLienAjouter($LienAjouter) {
        $this->LienAjouter = $LienAjouter;
    }

    function getLien() {
        return $this->Lien;
    }

    function setLien($Lien) {
        $this->Lien = $Lien;
    }

    function getLienSuppression() {
        return $this->LienSuppression;
    }

    function setLienSuppression($LienSuppression) {
        $this->LienSuppression = $LienSuppression;
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
        $subFormModelClassName = $this->getSubFormPrimaryModelClassName();


        /**
         * Parcours de la liste des clefs à représenter
         */
        if ($this->getArrayPrimaryContent()) {
            foreach ($this->getArrayPrimaryContent() as $key => $valueArray) {

                /**
                 * Création de la ligne HTML
                 */
                $return.= "<tr >";

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
                    $htmlField = Html::getHtmlObjectFromDataField($dataField, $this->getSecondaryTableNamesAndIdKeyValue());

                    /**
                     * Dans le cas du premier champ de la ligne, on récupère
                     * le lien pointant vers le détail du sous-formulaire
                     */
                    if ($isFirstField) {
                        $htmlField->getAttributesGlobal()->setIsIconNextEnabledToTrue();
                        $isFirstField = FALSE;
                    }
                    $htmlField->getAttributesGlobal()->setIsIconNextEnabledToFalse();


                    $htmlField->setHtmlRenderToTableLabel();
                    /**
                     * Si le sous-formulaire est modifiable par l'utilisateur
                     * et que le champs ne fait pas partie de la liste des champs
                     * vérrouillés, alors le champs sera modifiable par l'utilisateur.
                     */
                    if (parent::getIsEditable() && $htmlField->getContentLocked() == NULL) {

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

                if (parent::getIsEditable()) {
                    /**
                     * Ajout d'un lien de suppression
                     */
                    $return.="<td>" . $this->getLienSuppression() . "</td>";
                    /**
                     * Ajout d'un lien d'ajout
                     */
                    $return.="<td>" . $this->getLienAjouter() . "</td>";
                }

                /**
                 * Fermeture de la ligne HTML
                 */
                $return.= "</tr>";
            }
        }
        return $return;
    }

    public function getHtmlEditableContent() {
        return $this->getHtmlResultSubFormBegin()
                . $this->getHtmlResultSubFormMiddle()
                . $this->getHtmlResultSubFormAddNewLine()
                . $this->getHtmlResultSubFormEnd()
        ;
    }

    public function getHtmlAddContent() {
        return $this->getHtmlResultSubFormBegin()
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
