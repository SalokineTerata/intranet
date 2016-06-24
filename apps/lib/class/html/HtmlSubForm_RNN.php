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
     * Tableau PHP stockant le résultat de la requête sur laquelle est basée
     * le sous-formulaire.
     * @var array 
     */
    private $arrayPrimaryContentLines = NULL;

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

    /**
     * Lien de supresssion
     * @var string
     */
    private $LienDetail;

    /**
     * Ajout du label du tableau
     */
    private $tableLabel;

    /**
     * Nom de la fonction de gestion des versions
     */
    private $nameDataTableToCompare;

    const VIRTUAL = 'VIRTUAL';

    function __construct($paramArrayPrimaryContent = NULL, $paramSubFormPrimaryModelClassName = NULL, $paramPrimaryLabel = NULL, $secondaryTableNamesAndIdKeyValue = NULL, $NameDataFtaConditionnementTableToCompare = NULL) {
        parent::__construct();
        parent::setLabel($paramPrimaryLabel);
        $this->setArrayPrimaryContent($paramArrayPrimaryContent);
        $this->setSubFormPrimaryModelClassName($paramSubFormPrimaryModelClassName);
        $this->setSecondaryTableNamesAndIdKeyValue($secondaryTableNamesAndIdKeyValue);
        $this->setNameDataTableToCompare($NameDataFtaConditionnementTableToCompare);
    }

    function getNameDataTableToCompare() {
        return $this->nameDataTableToCompare;
    }

    function setNameDataTableToCompare($nameDataTableToCompare) {
        $this->nameDataTableToCompare = $nameDataTableToCompare;
    }

    function getTableLabel() {
        return $this->tableLabel;
    }

    function setTableLabel($tableLabel) {
        $this->tableLabel = $tableLabel;
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

    function getLienDetail() {
        return $this->LienDetail;
    }

    function setLienDetail($LienDetail) {
        $this->LienDetail = $LienDetail;
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
                 * Création de la ligne de label du tableau
                 */
                $return .= $this->getTableLabel();
                $this->setTableLabel(NULL);


                /**
                 * Création de la ligne HTML
                 */
                $return.= "<tr>";

                /**
                 * Chargement de l'enregistrement
                 */
                $modelSubForm = new $subFormModelClassName($key);

                /**
                 * On récupère le nom de la fonction gérant la gestion des versions
                 */
                if (!$this->getNameDataTableToCompare()) {
                    $NameDataTableToCompare = $modelSubForm->getNameDataTableToCompare();
                } else {
                    $NameDataTableToCompare = $this->getNameDataTableToCompare();
                }
                if ($NameDataTableToCompare) {
                    $modelSubForm->$NameDataTableToCompare();
                }

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
                     * Verification des règles de validation
                     */
                    $dataField->checkValidationRules();

                    if ($dataField->getDataValidationSuccessful() == TRUE) {
                        $this->setDataValidationSuccessfulToTrue();
                    } else {
                        $this->setDataValidationSuccessfulToFalse();
                    }

                    /**
                     * Conversion du DataField en HtmlField
                     */
                    $htmlField = Html::getHtmlObjectFromDataField($dataField, $this->getSecondaryTableNamesAndIdKeyValue(), $key);

                    /**
                     * Dans le cas du premier champ de la ligne, on récupère
                     * le lien pointant vers le détail du sous-formulaire
                     */
                    if ($isFirstField) {
                        $htmlField->getAttributesGlobal()->setIsIconNextEnabledToTrue();
                        $isFirstField = FALSE;
                    }
                    $htmlField->getAttributesGlobal()->setIsIconNextEnabledToFalse();
                    /**
                     * Ajout de style fonctionnel mais mauvaise mise en forme sur d'autre éléments
                     */
//                    $attrbuteStyleModel = new AttributeStyle();
//                    $attrbuteStyleModel->setValue("border:1px solid #009dd1;");
//                    $htmlField->getAttributesGlobal()->setStyle($attrbuteStyleModel);


                    $htmlField->setHtmlRenderToTable();
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
                    /**
                     * On vérifie si le champ en cours est différents de la version précédente
                     */
                    $check = strstr($fieldName, "VIRTUAL_");
                    if (!$check) {
                        $htmlField->setIsWarningUpdate($modelSubForm->getDataField($fieldName)->isFieldDiff());
                    }
                    $return.=$htmlField->getHtmlResult();
                }

                if (parent::getIsEditable()) {
                    /**
                     * Ajout d'un lien de suppression
                     */
                    if ($this->getLienSuppression()) {
                        foreach ($this->getLienSuppression() as $key2 => $rows) {
                            if ($key2 == $key) {
                                $lienDeSupression = $rows;
                            }
                        }
                    }
                    /**
                     * Ajout d'un lien de détail
                     */
                    if ($this->getLienDetail()) {
                        foreach ($this->getLienDetail() as $key2 => $rows) {
                            if ($key2 == $key) {
                                $lienDetail = $rows;
                            }
                        }
                    }
                    /**
                     * Mise en forme du lien de detail (modification)
                     */
                    if ($lienDetail) {
                        $return.="<td>" . $lienDetail . "</td>";
                    }
                    /**
                     * Mise en forme du lien de suppression
                     */
                    if ($lienDeSupression) {
                        $return.="<td>" . $lienDeSupression . "</td>";
                    }
                    /**
                     * Ajout d'un lien d'ajout
                     */
                    if ($this->getLienAjouter()) {
                        $return.="<td>" . $this->getLienAjouter() . "</td>";
                    }
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
