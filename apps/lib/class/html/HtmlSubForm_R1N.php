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

    function __construct($paramArrayContent, $paramSubFormModelClassName, $paramLabel) {
        parent::__construct();
        parent::setLabel($paramLabel);
        $this->setArrayContent($paramArrayContent);
        $this->setSubFormModelClassName($paramSubFormModelClassName);
    }

    function getTableLabel() {
        return $this->tableLabel;
    }

    function setTableLabel($tableLabel) {
        $this->tableLabel = $tableLabel;
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
        $subFormModelClassName = $this->getSubFormModelClassName();

        /**
         * Parcours de la liste des clefs à représenter
         */
        if ($this->getArrayContent()) {
            foreach ($this->getArrayContent() as $key => $valueArray) {

                /**
                 * Création de la ligne de label du tableau
                 */
                $return .= $this->getTableLabel();
                $this->setTableLabel(NULL);

                /**
                 * Création de la ligne HTML
                 */
                $return.= '<tr class=contenu>';

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
                 * Contenu HTML du lien pointant vers le détail de la sous-table.
                 */
                $htmlUrlToSubFormAjout = NULL;
                /**
                 * Contenu HTML du lien pointant vers le détail de la sous-table.
                 */
                $htmlUrlToSubFormSuppression = NULL;


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
                         * Ajout d'un lien de suppression
                         */
                        if ($this->getLienSuppression()) {
                            foreach ($this->getLienSuppression() as $key2 => $rows) {
                                if ($key2 == $key) {
                                    $htmlField->getAttributesGlobal()->setHrefDeleteValue($rows);
                                }
                            }
                        }
                        /**
                         * Ajout d'un lien de détail
                         */
                        if ($this->getLienDetail()) {
                            foreach ($this->getLienDetail() as $key2 => $rows) {
                                if ($key2 == $key) {
                                    $htmlField->getAttributesGlobal()->setHrefNextValue($rows);
                                }
                            }
                        }
                        $htmlField->getAttributesGlobal()->setHrefAjoutValue($this->getLienAjouter());
                        $htmlUrlToSubFormAjout = $htmlField->getAttributesGlobal()->getIconAddToHtml();
                        $htmlUrlToSubFormDetail = $htmlField->getAttributesGlobal()->getIconNextToHtml();
                        $htmlUrlToSubFormSuppression = $htmlField->getAttributesGlobal()->getIconDeleteToHtml();
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
                    if (parent::getIsEditable() && $this->getContentLocked() == NULL) {

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
                $return.='<td>' . $htmlUrlToSubFormDetail . '</td>';
                if (parent::getIsEditable()) {
                    /**
                     * Ajout du lien d'accès au détail du sous-formulaire
                     */
                    $return.='<td>' . $htmlUrlToSubFormAjout . '</td>';
                    /**
                     * Ajout du lien d'accès au détail du sous-formulaire
                     */
                    $return.='<td>' . $htmlUrlToSubFormSuppression . '</td>';
                }
            }
            /**
             * Fermeture de la ligne HTML
             */
            $return.= '</tr>';
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
