<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FtaView
 *
 * @author salokine
 */
class FtaView {

    /**
     * Fonction JavaScript appelée pour actualiser la visibilité
     * du champs Poids_ELEM
     */
    const JAVASCRIPT_CALLBACK_POIDS_ELEM = "displayPoidsElem";

    /**
     * Model de donnée d'une FTA
     * @var FtaModel 
     */
    private $ftaModel;

    /**
     * La vue est-elle modifiable par l'utilisateur (saisie) ou simplement
     * en consultation ?
     * @var boolean
     */
    private $isEditable;

    /**
     * Vue des échéances par processus de la FTA
     * @var FtaProcessusDelaiView Description
     */
    private $ftaProcessusDelaiView;

    /**
     * Chapitre à afficher dans la vue.
     * @var FtaChapitreModel
     */
    private $ftaChapitreModel;

    /**
     * Model de donnée d'une FTA
     * @var GeoModel 
     */
    private $GeoModel;

    /**
     * Model de donnée d'une FTA
     * @var FtaConditionnementModel
     */
    private $ftaConditionnementModel;

    /**
     * 
     * @param FtaModel $ParamFtaModel
     */
    public function __construct(FtaModel $ParamFtaModel) {
        $this->setModel($ParamFtaModel);
        $this->setFtaProcessusDelaiView(new FtaProcessusDelaiView($this->getModel()));
    }

    private function getFtaChapitreModel() {
        return $this->ftaChapitreModel;
    }

    private function setFtaChapitreModel(FtaChapitreModel $ftaChapitreModel) {
        $this->ftaChapitreModel = $ftaChapitreModel;
    }

    public function setFtaChapitreModelById($paramIdChapitre) {
        $this->setFtaChapitreModel(new FtaChapitreModel($paramIdChapitre));
    }

    private function getFtaProcessusDelaiView() {
        return $this->ftaProcessusDelaiView;
    }

    private function setFtaProcessusDelaiView(FtaProcessusDelaiView $ftaProcessusDelaiView) {
        $this->ftaProcessusDelaiView = $ftaProcessusDelaiView;
    }

    /*
     * Gettteur setteur pour l'affichage d'un champ
     * d'une sous table avec la table geo
     */
    /* private function getGeoModel() {
      return $this->GeoModel;
      }

      private function  setGeoModel(GeoModel $ParamGeoModel) {
      if ($ParamGeoModel instanceof GeoModel) {
      $this->GeoModel = $ParamGeoModel;
      }
      }
     */

    private function getModel() {
        return $this->ftaModel;
    }

    private function setModel(FtaModel $ParamFtaModel) {
        if ($ParamFtaModel instanceof FtaModel) {
            $this->ftaModel = $ParamFtaModel;
        }
    }

    public function getIsEditable() {
        return $this->isEditable;
    }

    public function setIsEditable($isEditable) {
        $this->getModel()->setIsEditable($isEditable);
        $this->isEditable = $isEditable;
    }

    public function getHtmlDataField($paramFieldName) {
        return Html::convertDataFieldToHtml(
                        $this->getModel()->getDataField($paramFieldName)
                        , $this->getIsEditable()
        );
    }

    /**
     * 
     * @return type
     */
    public function getHtmlUniteFacturationWithPoidsElementaire() {

        //Initialisation des variables locales
        $htmlReturn = NULL;
        $htmlObjectUniteFacturation = new DataFieldToHtmlListSelect(
                $this->getModel()->getDataField(FtaModel::FIELDNAME_UNITE_FACTURATION)
        );
        $htmlObjectPoidsElementaire = new DataFieldToHtmlInputText(
                $this->getModel()->getDataField(FtaModel::FIELDNAME_POIDS_ELEMENTAIRE)
        );



        //Unité de facturation
        $htmlObjectUniteFacturation->setIsEditable($this->getIsEditable());
        $htmlObjectUniteFacturation->getEventsForm()->setCallbackJavaScriptFunctionOnChange(self::JAVASCRIPT_CALLBACK_POIDS_ELEM);
        $callbackJavaScriptFunctionOnChangeParameters = $htmlObjectUniteFacturation->getAttributesGlobal()->getId()->getValue()
                . ","
                . $htmlObjectPoidsElementaire->getAttributesGlobal()->getId()->getValue()
        ;
        $htmlObjectUniteFacturation->getEventsForm()->setCallbackJavaScriptFunctionOnChangeParameters($callbackJavaScriptFunctionOnChangeParameters);

        $htmlReturn.=$htmlObjectUniteFacturation->getHtmlResult();

        //Poids élémentaire
        $htmlObjectPoidsElementaire->setIsEditable($this->getIsEditable());

        if ($htmlObjectUniteFacturation->getDataField()->getFieldValue() == FtaModel::ID_POIDS_VARIABLE) {
            $htmlObjectPoidsElementaire->getStyleCSS()->setDisplayToNone();
            $htmlObjectPoidsElementaire->getDataField()->setFieldValue("0");
            $htmlObjectPoidsElementaire->getDataField()->getRecordsetRef()->saveToDatabase();
        } else {
            $htmlObjectPoidsElementaire->getStyleCSS()->unsetDisplay();
        }
        $htmlReturn.=$htmlObjectPoidsElementaire->getHtmlResult();
        return $htmlReturn;
    }

    /**
     * 
     * @return type
     */
    public function getHtmlCreateurFta() {

        $htmlObject = new htmlInputText();
        $htmlObject->setLabel($this->getModel()->getDataField(FtaModel::FIELDNAME_CREATEUR)->getFieldLabel());
        $htmlObject->getAttributes()->getValue()->setValue($this->getModel()->getModelCreateur()->getPrenomNom());
        $htmlObject->setIsEditable(FALSE);
        return $htmlObject->getHtmlResult();
    }

    /**
     * 
     * @return type
     */
    public function showDatesEcheanceProcessus() {

        //Variables locales
        $blocEcheanceLignes = "";
        $modelFtaProcessusDelai = new FtaProcessusDelaiModel();

        //Parcours et construction de toutes les échéances
        foreach ($this->getModel()->getArrayDataFieldEcheancesForProcessusCycle() as $modelFtaProcessusDelai) {

            //Construction des objets HTML de date
            $recordsetProcessus = new FtaProcessusModel($modelFtaProcessusDelai->getDataField(FtaProcessusDelaiModel::FIELDNAME_ID_FTA_PROCESSUS)->getFieldValue());
            $labelEcheance = "Echéance pour " . $recordsetProcessus->getDataField(FtaProcessusModel::FIELDNAME_NOM)->getFieldValue() . ": ";
            $dataFieldEcheance = $modelFtaProcessusDelai->getDataField(FtaProcessusDelaiModel::FIELDNAME_DATE_ECHEANCE_PROCESSUS);
            $dataFieldEcheance->setLabelCustom($labelEcheance);

            $HtmlElementEcheance = new DataFieldToHtmlInputCalendar($dataFieldEcheance);

            $blocEcheanceLignes .= $HtmlElementEcheance->getHtmlResult();
        }
        return $blocEcheanceLignes;
    }

    /**
     * Affiche la liste des espaces de travail pour lesquel l'utilisateur connecté à les droits d'accès
     * @param int $paramIdUser
     * @param bolean $paramIsEditable
     * @param int $paramIdFta
     * @return string
     */
    public function ListeWorkflowByAcces($paramIdUser, $paramIsEditable, $paramIdFta, $paramIdFtaRole) {
        $HtmlList = new HtmlListSelect();

        /*
         * Worflow de FTA
         */
        return FtaWorkflowModel::ShowListeDeroulanteNomWorkflowByAccesAndIdFta($paramIdUser, $HtmlList, $paramIsEditable, $paramIdFta, $paramIdFtaRole);
    }

    /**
     * Affiche la liste des site de production pour lesquel l'utilisateur connecté à les droits d'accès
     * @param int $paramIdUser
     * @param bolean $paramIsEditable
     * @param int $paramIdFta
     * @return string
     */
    public function ListeSiteByAcces($paramIdUser, $paramIsEditable, $paramIdFta) {
        $HtmlList = new HtmlListSelect();

        /*
         * Site de production FTA
         */
        return GeoModel::ShowListeDeroulanteSiteProdByAccesAndIdFta($paramIdUser, $HtmlList, $paramIsEditable, $paramIdFta);
    }

    /**
     *    
     * @param type $paramIsEditable
     * @return type
     */
    public function ListeClassification($paramIsEditable, $paramIdFtaChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbrevationEtat, $paramIdFtaRole) {
        $idFtaClassification2 = $this->getModel()->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue();
        $idFta = $this->getModel()->getKeyValue();
        /*
         * Classification FTA
         */
        if ($paramIsEditable and ! $idFtaClassification2) {

            $ListeCLassification = "<tr ><td class=\"contenu\">Ajouter une classification</td ><td class=\"contenu\">"
                    . "<a href="
                    . "ajout_classification_chemin.php?"
                    . "id_fta=" . $idFta
                    . "&id_fta_chapitre_encours=" . $paramIdFtaChapitre
                    . "&synthese_action=" . $paramSyntheseAction
                    . "&comeback=" . $paramComeback
                    . "&id_fta_etat=" . $paramIdFtaEtat
                    . "&abreviation_fta_etat=" . $paramAbrevationEtat
                    . "&id_fta_role=" . $paramIdFtaRole
                    . ">Cliquez ici</a></td></tr>";
        } else {
            $ListeCLassification = ClassificationFta2Model::ShowListeDeroulanteClassification(FALSE);
            if ($paramIsEditable) {
                $ListeCLassification .= "<tr ><td class=\"contenu\">Modifier la classification</td ><td class=\"contenu\">"
                        . "<a href="
                        . "ajout_classification_chemin.php?"
                        . "id_fta=" . $idFta
                        . "&id_fta_chapitre_encours=" . $paramIdFtaChapitre
                        . "&synthese_action=" . $paramSyntheseAction
                        . "&comeback=" . $paramComeback
                        . "&id_fta_etat=" . $paramIdFtaEtat
                        . "&abreviation_fta_etat=" . $paramAbrevationEtat
                        . "&id_fta_role=" . $paramIdFtaRole
                        . "&id_fta_classification2=" . $idFtaClassification2
                        . ">Cliquez ici</a></td></tr>";
            }
        }

        return $ListeCLassification;
    }

    public function ListeCodesoftEtiquettes($paramIdFta, $paramIsEditable) {

        $listeCodesoftEtiquettes = CodesoftEtiquettesModel::getListeCodesoftEtiquettes($paramIdFta, $paramIsEditable);

        return $listeCodesoftEtiquettes;
    }

    /**
     * Tableau des emballages par UVC
     * @param int $paramIdFta
     * @param int $paramChapitre
     * @param string $paramSyntheseAction
     * @param int $paramComeback
     * @param int $paramIdFtaEtat
     * @param string $paramAbreviationEtat
     * @param int $paramIdFtaRole
     * @return string
     */
    public function getHtmlEmballageUVC($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole) {
        $annexeEmballageGroupeTypeModel = new AnnexeEmballageGroupeTypeModel('1');

        /*
         * Récuperation des élements clé de la table fta_conditionnement
         */
        $FtaConditionnement = $annexeEmballageGroupeTypeModel->getIdAnnexeEmballageGroupeTypeUVCFromFtaConditionnement();
        if ($FtaConditionnement) {
            $arrayFtaConditionnementtmp = array();
            $tablesNameAndIdForeignKeyOfFtaConditionnementtmp = array();

            foreach ($FtaConditionnement as $rowsFtaConditionnement) {
                $idFtaCondtionnement = $rowsFtaConditionnement[FtaConditionnementModel::KEYNAME];
                $idAnnexeEmballage = $rowsFtaConditionnement[FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE];
                $idAnnexeEmballageGroupeType = $rowsFtaConditionnement[FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE];

                $arrayIdFtaCondtionnement[] = $idFtaCondtionnement;
                /*
                 * Initialisation des modèles 
                 */

                $annexeEmballageGroupeTypeModel2 = new AnnexeEmballageGroupeTypeModel('1');

                $ftaConditionnmentModel = new FtaConditionnementModel($idFtaCondtionnement);

                /*
                 * Tableau de données
                 */
                $arrayFtaConditionnementTmp = FtaConditionnementModel::getArrayFtaConditonnement($idFtaCondtionnement);

//                $arrayFtaConditionnement = array_replace_recursive($arrayFtaConditionnementtmp, $arrayFtaConditionnementTmp);
                $arrayFtaConditionnement = ($arrayFtaConditionnementtmp + $arrayFtaConditionnementTmp);

                $arrayFtaConditionnementtmp = $arrayFtaConditionnement;
                /*
                 * Cette array doit être utilisé de cette manière 
                 * Array (
                 * nom de table,
                 * clé étrangère de la table présenté
                 * valeur de la clé étrangère);
                 */
                $tablesNameAndIdForeignKeyOfFtaConditionnementTmp = FtaConditionnementModel::getTablesNameAndIdForeignKeyOfFtaConditionnement($paramIdFta, $idAnnexeEmballage, $idAnnexeEmballageGroupeType, $idFtaCondtionnement);

                $tablesNameAndIdForeignKeyOfFtaConditionnement = ($tablesNameAndIdForeignKeyOfFtaConditionnementtmp + $tablesNameAndIdForeignKeyOfFtaConditionnementTmp);
                $tablesNameAndIdForeignKeyOfFtaConditionnementtmp = $tablesNameAndIdForeignKeyOfFtaConditionnement;


                /*
                 * Vérifie si pour la Fta en cours les données Fta conditionement sont renseigné
                 */
                if ($arrayFtaConditionnement && $idAnnexeEmballageGroupeType == '1') {
                    $rightToAdd = FALSE;
                } else {
                    $rightToAdd = TRUE;
                }
            }
            $className = $ftaConditionnmentModel->getClassName();
            $label = $annexeEmballageGroupeTypeModel2->getDataField(AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE)->getFieldValue();


            $htmlEmballageUVC = new HtmlSubForm_RNN($arrayFtaConditionnement, $className, $label, $tablesNameAndIdForeignKeyOfFtaConditionnement);
            $htmlEmballageUVC->setIsEditable($this->getIsEditable());
            $htmlEmballageUVC->setRightToAdd($rightToAdd);
            $htmlEmballageUVC->setLienAjouter(FtaConditionnementModel::getAddLinkAfterConditionnement($paramIdFta, $paramChapitre, '1', $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageUVC->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, '1', $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageUVC->setLienSuppression(FtaConditionnementModel::getDeleteLinkConditionnement($paramIdFta, $paramChapitre, $arrayIdFtaCondtionnement, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageUVC->setTableLabel(FtaConditionnementModel::getTableConditionnementLabel($idFtaCondtionnement));
            $return .= $htmlEmballageUVC->getHtmlResult();
        } else {
            /*
             * Initialisation des modèles 
             */
            $annexeEmballageGroupeTypeModel2 = new AnnexeEmballageGroupeTypeModel('1');
            $label = $annexeEmballageGroupeTypeModel2->getDataField(AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE)->getFieldValue();

            $htmlEmballageUVC = new HtmlSubForm_RNN($arrayFtaConditionnement, $className, $label, $tablesNameAndIdForeignKeyOfFtaConditionnement);
            $htmlEmballageUVC->setIsEditable($this->getIsEditable());
            $htmlEmballageUVC->setRightToAdd(TRUE);
            $htmlEmballageUVC->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, '1', $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $return .= $htmlEmballageUVC->getHtmlResult();
        }
        return $return;
    }

    /**
     * Tableau des emballages par Colis
     * @param int $paramIdFta
     * @param int $paramChapitre
     * @param string $paramSyntheseAction
     * @param int $paramComeback
     * @param int $paramIdFtaEtat
     * @param string $paramAbreviationEtat
     * @param int $paramIdFtaRole
     * @return string
     */
    public function getHtmlEmballageParColis($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole) {
        $annexeEmballageGroupeTypeModel = new AnnexeEmballageGroupeTypeModel('2');
        /*
         * Récuperation des élements clé de la table fta_conditionnement
         */
        $FtaConditionnement = $annexeEmballageGroupeTypeModel->getIdAnnexeEmballageGroupeTypeParColisFromFtaConditionnement();
        if ($FtaConditionnement) {
            $arrayFtaConditionnementtmp = array();
            $tablesNameAndIdForeignKeyOfFtaConditionnementtmp = array();

            foreach ($FtaConditionnement as $rowsFtaConditionnement) {
                $idFtaCondtionnement = $rowsFtaConditionnement[FtaConditionnementModel::KEYNAME];
                $idAnnexeEmballage = $rowsFtaConditionnement[FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE];
                $idAnnexeEmballageGroupeType = $rowsFtaConditionnement[FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE];

                $arrayIdFtaCondtionnement[] = $idFtaCondtionnement;

                /*
                 * Initialisation des modèles 
                 */
                $annexeEmballageGroupeTypeModel2 = new AnnexeEmballageGroupeTypeModel('2');


                $ftaConditionnmentModel = new FtaConditionnementModel($idFtaCondtionnement);
                /*
                 * Tableau de données
                 */
                $arrayFtaConditionnementTmp = FtaConditionnementModel::getArrayFtaConditonnement($idFtaCondtionnement);

                $arrayFtaConditionnement = array_replace_recursive($arrayFtaConditionnementtmp, $arrayFtaConditionnementTmp);

                $arrayFtaConditionnementtmp = $arrayFtaConditionnement;
                /*
                 * Cette array doit être utilisé de cette manière 
                 * Array (
                 * nom de table,
                 * clé étrangère de la table présenté
                 * valeur de la clé étrangère);
                 */
                $tablesNameAndIdForeignKeyOfFtaConditionnementTmp = FtaConditionnementModel::getTablesNameAndIdForeignKeyOfFtaConditionnement($paramIdFta, $idAnnexeEmballage, $idAnnexeEmballageGroupeType, $idFtaCondtionnement);

                $tablesNameAndIdForeignKeyOfFtaConditionnement = ($tablesNameAndIdForeignKeyOfFtaConditionnementtmp + $tablesNameAndIdForeignKeyOfFtaConditionnementTmp);
                $tablesNameAndIdForeignKeyOfFtaConditionnementtmp = $tablesNameAndIdForeignKeyOfFtaConditionnement;
                /*
                 * Vérifie si pour la Fta en cours les données Fta conditionement sont renseigné
                 */
                if ($arrayFtaConditionnement) {
                    $rightToAdd = FALSE;
                } else {
                    $rightToAdd = TRUE;
                }
            }
            $className = $ftaConditionnmentModel->getClassName();
            $label = $annexeEmballageGroupeTypeModel2->getDataField(AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE)->getFieldValue();


            $htmlEmballageParColis = new HtmlSubForm_RNN($arrayFtaConditionnement, $className, $label, $tablesNameAndIdForeignKeyOfFtaConditionnement);
            $htmlEmballageParColis->setIsEditable($this->getIsEditable());
            $htmlEmballageParColis->setRightToAdd($rightToAdd);
            $htmlEmballageParColis->setLienAjouter(FtaConditionnementModel::getAddLinkAfterConditionnement($paramIdFta, $paramChapitre, '2', $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageParColis->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, '2', $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageParColis->setLienSuppression(FtaConditionnementModel::getDeleteLinkConditionnement($paramIdFta, $paramChapitre, $arrayIdFtaCondtionnement, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageParColis->setTableLabel(FtaConditionnementModel::getTableConditionnementLabel($idFtaCondtionnement));
            $return .= $htmlEmballageParColis->getHtmlResult();
        } else {
            /*
             * Initialisation des modèles 
             */
            $annexeEmballageGroupeTypeModel2 = new AnnexeEmballageGroupeTypeModel('2');
            $label = $annexeEmballageGroupeTypeModel2->getDataField(AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE)->getFieldValue();

            $htmlEmballageParColis = new HtmlSubForm_RNN($arrayFtaConditionnement, $className, $label, $tablesNameAndIdForeignKeyOfFtaConditionnement);
            $htmlEmballageParColis->setIsEditable($this->getIsEditable());
            $htmlEmballageParColis->setRightToAdd(TRUE);
            $htmlEmballageParColis->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, '2', $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $return .= $htmlEmballageParColis->getHtmlResult();
        }
        return $return;
    }

    /**
     * Tableau des emballages du Colis
     * @param int $paramIdFta
     * @param int $paramChapitre
     * @param string $paramSyntheseAction
     * @param int $paramComeback
     * @param int $paramIdFtaEtat
     * @param string $paramAbreviationEtat
     * @param int $paramIdFtaRole
     * @return string
     */
    public function getHtmlEmballageDuColis($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole) {
        $annexeEmballageGroupeTypeModel = new AnnexeEmballageGroupeTypeModel('3');

        /*
         * Récuperation des élements clé de la table fta_conditionnement
         */
        $FtaConditionnement = $annexeEmballageGroupeTypeModel->getIdAnnexeEmballageGroupeTypeDuColisFromFtaConditionnement();
        if ($FtaConditionnement) {
            $arrayFtaConditionnementtmp = array();
            $tablesNameAndIdForeignKeyOfFtaConditionnementtmp = array();

            foreach ($FtaConditionnement as $rowsFtaConditionnement) {
                $idFtaCondtionnement = $rowsFtaConditionnement[FtaConditionnementModel::KEYNAME];
                $idAnnexeEmballage = $rowsFtaConditionnement[FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE];
                $idAnnexeEmballageGroupeType = $rowsFtaConditionnement[FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE];
                $arrayIdFtaCondtionnement[] = $idFtaCondtionnement;

                /*
                 * Initialisation des modèles 
                 */
                $annexeEmballageGroupeTypeModel2 = new AnnexeEmballageGroupeTypeModel('3');

                $ftaConditionnmentModel = new FtaConditionnementModel($idFtaCondtionnement);


                /*
                 * Tableau de données
                 */
                $arrayFtaConditionnementTmp = FtaConditionnementModel::getArrayFtaConditonnementDuColis($idFtaCondtionnement);

                $arrayFtaConditionnement = array_replace_recursive($arrayFtaConditionnementtmp, $arrayFtaConditionnementTmp);

                $arrayFtaConditionnementtmp = $arrayFtaConditionnement;
                /*
                 * Cette array doit être utilisé de cette manière 
                 * Array (
                 * nom de table,
                 * clé étrangère de la table présenté
                 * valeur de la clé étrangère);
                 */
                $tablesNameAndIdForeignKeyOfFtaConditionnementTmp = FtaConditionnementModel::getTablesNameAndIdForeignKeyOfFtaConditionnement($paramIdFta, $idAnnexeEmballage, $idAnnexeEmballageGroupeType, $idFtaCondtionnement);

                $tablesNameAndIdForeignKeyOfFtaConditionnement = ($tablesNameAndIdForeignKeyOfFtaConditionnementtmp + $tablesNameAndIdForeignKeyOfFtaConditionnementTmp);
                $tablesNameAndIdForeignKeyOfFtaConditionnementtmp = $tablesNameAndIdForeignKeyOfFtaConditionnement;
                /*

                  /*
                 * Vérifie si pour la Fta en cours les données Fta conditionement sont renseigné
                 */
                if ($arrayFtaConditionnement) {
                    $rightToAdd = FALSE;
                } else {
                    $rightToAdd = TRUE;
                }
            }
            $className = $ftaConditionnmentModel->getClassName();
            $label = $annexeEmballageGroupeTypeModel2->getDataField(AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE)->getFieldValue();


            $htmlEmballageDuColis = new HtmlSubForm_RNN($arrayFtaConditionnement, $className, $label, $tablesNameAndIdForeignKeyOfFtaConditionnement);
            $htmlEmballageDuColis->setIsEditable($this->getIsEditable());
            $htmlEmballageDuColis->setRightToAdd($rightToAdd);
            $htmlEmballageDuColis->setLienAjouter(FtaConditionnementModel::getAddLinkAfterConditionnement($paramIdFta, $paramChapitre, '3', $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageDuColis->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, '3', $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageDuColis->setLienSuppression(FtaConditionnementModel::getDeleteLinkConditionnement($paramIdFta, $paramChapitre, $arrayIdFtaCondtionnement, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageDuColis->setTableLabel(FtaConditionnementModel::getTableConditionnementLabelDuColis($idFtaCondtionnement));

            $return .= $htmlEmballageDuColis->getHtmlResult();
        } else {
            /*
             * Initialisation des modèles 
             */
            $annexeEmballageGroupeTypeModel2 = new AnnexeEmballageGroupeTypeModel('3');
            $label = $annexeEmballageGroupeTypeModel2->getDataField(AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE)->getFieldValue();

            $htmlEmballageDuColis = new HtmlSubForm_RNN($arrayFtaConditionnement, $className, $label, $tablesNameAndIdForeignKeyOfFtaConditionnement);
            $htmlEmballageDuColis->setIsEditable($this->getIsEditable());
            $htmlEmballageDuColis->setRightToAdd(TRUE);
            $htmlEmballageDuColis->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, '3', $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $return .= $htmlEmballageDuColis->getHtmlResult();
        }
        return $return;
    }

    /**
     * Tableau des emballages par Palette
     * @param int $paramIdFta
     * @param int $paramChapitre
     * @param string $paramSyntheseAction
     * @param int $paramComeback
     * @param int $paramIdFtaEtat
     * @param string $paramAbreviationEtat
     * @param int $paramIdFtaRole
     * @return string
     */
    public function getHtmlEmballagePalette($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole) {
        $annexeEmballageGroupeTypeModel = new AnnexeEmballageGroupeTypeModel();
        /*
         * Récuperation des élements clé de la table fta_conditionnement
         */
        $FtaConditionnement = $annexeEmballageGroupeTypeModel->getIdAnnexeEmballageGroupeTypePaletteFromFtaConditionnement();
        if ($FtaConditionnement) {
            $arrayFtaConditionnementtmp = array();
            $tablesNameAndIdForeignKeyOfFtaConditionnementtmp = array();
            foreach ($FtaConditionnement as $rowsFtaConditionnement) {
                $idFtaCondtionnement = $rowsFtaConditionnement[FtaConditionnementModel::KEYNAME];
                $idAnnexeEmballage = $rowsFtaConditionnement[FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE];
                $idAnnexeEmballageGroupeType = $rowsFtaConditionnement[FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE];
                $arrayIdFtaCondtionnement[] = $idFtaCondtionnement;

                /*
                 * Initialisation des modèles 
                 */

                $annexeEmballageGroupeTypeModel2 = new AnnexeEmballageGroupeTypeModel('4');


                $ftaConditionnmentModel = new FtaConditionnementModel($idFtaCondtionnement);
                /*
                 * Tableau de données
                 */
                $arrayFtaConditionnementTmp = FtaConditionnementModel::getArrayFtaConditonnement($idFtaCondtionnement);

                $arrayFtaConditionnement = array_replace_recursive($arrayFtaConditionnementtmp, $arrayFtaConditionnementTmp);

                $arrayFtaConditionnementtmp = $arrayFtaConditionnement;
                /*
                 * Cette array doit être utilisé de cette manière 
                 * Array (
                 * nom de table,
                 * clé étrangère de la table présenté
                 * valeur de la clé étrangère);
                 */
                $tablesNameAndIdForeignKeyOfFtaConditionnementTmp = FtaConditionnementModel::getTablesNameAndIdForeignKeyOfFtaConditionnement($paramIdFta, $idAnnexeEmballage, $idAnnexeEmballageGroupeType, $idFtaCondtionnement);

                $tablesNameAndIdForeignKeyOfFtaConditionnement = ($tablesNameAndIdForeignKeyOfFtaConditionnementtmp + $tablesNameAndIdForeignKeyOfFtaConditionnementTmp);
                $tablesNameAndIdForeignKeyOfFtaConditionnementtmp = $tablesNameAndIdForeignKeyOfFtaConditionnement;


                /*
                 * Vérifie si pour la Fta en cours les données Fta conditionement sont renseigné
                 */
                if ($arrayFtaConditionnement) {
                    $rightToAdd = FALSE;
                } else {
                    $rightToAdd = TRUE;
                }
            }
            $className = $ftaConditionnmentModel->getClassName();
            $label = $annexeEmballageGroupeTypeModel2->getDataField(AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE)->getFieldValue();


            $htmlEmballagePalette = new HtmlSubForm_RNN($arrayFtaConditionnement, $className, $label, $tablesNameAndIdForeignKeyOfFtaConditionnement);
            $htmlEmballagePalette->setIsEditable($this->getIsEditable());
            $htmlEmballagePalette->setRightToAdd($rightToAdd);
            $htmlEmballagePalette->setLienAjouter(FtaConditionnementModel::getAddLinkAfterConditionnement($paramIdFta, $paramChapitre, '4', $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballagePalette->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, '4', $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballagePalette->setLienSuppression(FtaConditionnementModel::getDeleteLinkConditionnement($paramIdFta, $paramChapitre, $arrayIdFtaCondtionnement, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballagePalette->setTableLabel(FtaConditionnementModel::getTableConditionnementLabel($idFtaCondtionnement));
            $return .= $htmlEmballagePalette->getHtmlResult();
        } else {
            /*
             * Initialisation des modèles 
             */
            $annexeEmballageGroupeTypeModel2 = new AnnexeEmballageGroupeTypeModel('4');
            $label = $annexeEmballageGroupeTypeModel2->getDataField(AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE)->getFieldValue();

            $htmlEmballagePalette = new HtmlSubForm_RNN($arrayFtaConditionnement, $className, $label, $tablesNameAndIdForeignKeyOfFtaConditionnement);
            $htmlEmballagePalette->setIsEditable($this->getIsEditable());
            $htmlEmballagePalette->setRightToAdd(TRUE);
            $htmlEmballagePalette->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, '4', $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $return .= $htmlEmballagePalette->getHtmlResult();
        }
        return $return;
    }

    /**
     * Tableau d'étiquette composition
     * @param type $paramIdFta
     * @param type $paramChapitre
     * @param type $paramSyntheseAction
     * @param type $paramComeback
     * @param type $paramIdFtaEtat
     * @param type $paramAbreviationEtat
     * @param type $paramIdFtaRole
     * @param type $paramEditable
     * @return type
     */
    public function getHtmlEtiquetteComposition($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $paramEditable) {

        /*
         * Récuperation des élements clé de la table fta_composant
         */
        if ($paramEditable) {
            $proprietaire = '1';
        } else {
            $proprietaire = '0';
        }
        $FtaComposant = FtaComposantModel::getIdFtaComposition($paramIdFta);
        if ($FtaComposant) {
            foreach ($FtaComposant as $rowsFtaComposant) {
                $idFtaComposant = $rowsFtaComposant[FtaComposantModel::KEYNAME];
                $arrayIdFtaComposant[] = $idFtaComposant;
            }

            $htmlEtiquetteComposant = Html::getHtmlObjectFromDataField($this->getModel()->getDataField(FtaModel::FIELDNAME_VIRTUAL_FTA_COMPOSANT));
            $htmlEtiquetteComposant->setIsEditable($this->getIsEditable());
            $htmlEtiquetteComposant->setLienAjouter(FtaComposantModel::getAddAfterLinkComposition($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $htmlEtiquetteComposant->setLienDetail(FtaComposantModel::getDetailLinkComposition($paramIdFta, $paramChapitre, $arrayIdFtaComposant, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $htmlEtiquetteComposant->setLienSuppression(FtaComposantModel::getDeleteLinkComposition($paramIdFta, $paramChapitre, $arrayIdFtaComposant, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEtiquetteComposant->setTableLabel(FtaComposantModel::getTableCompositionLabel($idFtaComposant));
            $return .= $htmlEtiquetteComposant->getHtmlResult();
        } else {
            $htmlEtiquetteComposant = Html::getHtmlObjectFromDataField($this->getModel()->getDataField(FtaModel::FIELDNAME_VIRTUAL_FTA_COMPOSANT));
            $htmlEtiquetteComposant->setIsEditable($this->getIsEditable());
            $htmlEtiquetteComposant->setRightToAdd(TRUE);
            $htmlEtiquetteComposant->getAttributesGlobal()->setHrefAjoutValue(FtaComposantModel::getAddLinkComposition($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $htmlEtiquetteComposant->setLien(FtaComposantModel::getAddLinkComposition($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $return .= $htmlEtiquetteComposant->getHtmlResult();
        }
        return $return;
    }

    /**
     * Tableau d'étiquette composant
     * @param type $paramIdFta
     * @param type $paramChapitre
     * @param type $paramSyntheseAction
     * @param type $paramComeback
     * @param type $paramIdFtaEtat
     * @param type $paramAbreviationEtat
     * @param type $paramIdFtaRole
     * @param type $paramEditable
     * @return type
     */
    public function getHtmlEtiquetteRD($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $paramEditable) {

        /*
         * Récuperation des élements clé de la table fta_composant
         */
        if ($paramEditable) {
            $proprietaire = '1';
        } else {
            $proprietaire = '0';
        }
        $FtaComposant = FtaComposantModel::getIdFtaComposant($paramIdFta);
        if ($FtaComposant) {
            foreach ($FtaComposant as $rowsFtaComposant) {
                $idFtaComposant = $rowsFtaComposant[FtaComposantModel::KEYNAME];
                $arrayIdFtaComposant[] = $idFtaComposant;
            }

            $htmlEtiquetteComposant = Html::getHtmlObjectFromDataField($this->getModel()->getDataField(FtaModel::FIELDNAME_VIRTUAL_FTA_COMPOSANT_RD));
            $htmlEtiquetteComposant->setIsEditable($this->getIsEditable());
            $htmlEtiquetteComposant->setLienAjouter(FtaComposantModel::getAddLinkComposant($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $htmlEtiquetteComposant->setLienDetail(FtaComposantModel::getDetailLinkComposant($paramIdFta, $paramChapitre, $arrayIdFtaComposant, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $htmlEtiquetteComposant->setLienSuppression(FtaComposantModel::getDeleteLinkComposition($paramIdFta, $paramChapitre, $arrayIdFtaComposant, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEtiquetteComposant->setTableLabel(FtaComposantModel::getTableComposantLabel($idFtaComposant));
            $return .= $htmlEtiquetteComposant->getHtmlResult();
        } else {
            $htmlEtiquetteComposant = Html::getHtmlObjectFromDataField($this->getModel()->getDataField(FtaModel::FIELDNAME_VIRTUAL_FTA_COMPOSANT_RD));
            $htmlEtiquetteComposant->setIsEditable($this->getIsEditable());
            $htmlEtiquetteComposant->setRightToAdd(TRUE);
            $htmlEtiquetteComposant->getAttributesGlobal()->setHrefAjoutValue(FtaComposantModel::getAddLinkComposant($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $htmlEtiquetteComposant->setLien(FtaComposantModel::getAddLinkComposant($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $return .= $htmlEtiquetteComposant->getHtmlResult();
        }
        return $return;
    }

    /**
     * 
     * @return type
     */
    public function getHtmlCommentaireChapitre() {
        $return = NULL;

        $idFtaSuiviProjet = FtaSuiviProjetModel::getIdFtaSuiviProjetByIdFtaAndIdChapitre(
                        $this->ftaModel->getDataField(FtaModel::KEYNAME)->getFieldValue()
                        , 1
        );
        $recordsetIdFtaSuiviProjet = new FtaSuiviProjetModel($idFtaSuiviProjet);
        $HtmlSuiviProjet = new DataFieldToHtmlTextArea(
                $recordsetIdFtaSuiviProjet->getDataField(
                        FtaSuiviProjetModel::FIELDNAME_COMMENTAIRE_SUIVI_PROJET
                )
        );
        $HtmlSuiviProjet->setIsEditable($this->getIsEditable());

        $return .= $HtmlSuiviProjet->getHtmlResult();
        return $return;
    }

    /**
     * 
     * @return type
     */
    public function getHtmlCorrectionChapitre() {
        $return = NULL;


        $idFtaSuiviProjet = FtaSuiviProjetModel::getIdFtaSuiviProjetByIdFtaAndIdChapitre(
                        $this->ftaModel->getDataField(FtaModel::KEYNAME)->getFieldValue()
                        , 1
        );
        $recordsetIdFtaSuiviProjet = new FtaSuiviProjetModel($idFtaSuiviProjet);
        $HtmlSuiviProjet = new DataFieldToHtmlTextArea(
                $recordsetIdFtaSuiviProjet->getDataField(
                        FtaSuiviProjetModel::FIELDNAME_CORRECTION_FTA_SUIVI_PROJET
                )
        );
        $HtmlSuiviProjet->setIsEditable($this->getIsEditable());

        $return .= $HtmlSuiviProjet->getHtmlResult();
        return $return;
    }

    /**
     * 
     * @return \FtaSuiviProjetModel
     */
    function getFtaSuiviProjetModel($paramIsEditable) {

        $idFtaChapitre = $this->getFtaChapitreModel()->getKeyValue();
        $idFtaSuiviProjet = FtaSuiviProjetModel::getIdFtaSuiviProjetByIdFtaAndIdChapitre(
                        $this->getModel()->getKeyValue(), $idFtaChapitre
        );
        $ftaSuiviProjetModel = new FtaSuiviProjetModel($idFtaSuiviProjet);
        $ftaSuiviProjetModel->setIsEditable($paramIsEditable);
        return $ftaSuiviProjetModel;
    }

    /**
     * 
     * @return type
     */
    function getHtmlCNUDPreparerPar() {

        return Html::convertDataFieldToHtml(
                        $this->getModel()->getModelSiteExpedition()->getDataField(GeoModel::FIELDNAME_GEO_CNUD_PREPARER_PAR)
                        , false
        );
    }

    /**
     * 
     * @return type
     */
    function getHtmlSiteAgrement() {

        return Html::convertDataFieldToHtml(
                        $this->getModel()->getModelSiteExpedition()->getDataField(GeoModel::FIELDNAME_SITE_AGREMENT_CE)
                        , false
        );
    }

    /**
     * 
     * @return FtaConditionnementModel
     */
    //similaire à getModel
    public function getFtaConditionnementModel() {
        return $this->ftaConditionnementModel;
    }

    function setFtaConditionnementModel(FtaConditionnementModel $ftaConditonnementModel) {
        if ($ftaConditonnementModel instanceof FtaConditionnementModel) {
            $this->ftaConditionnementModel = $ftaConditonnementModel;
        }
    }

    /**
     * 
     * @return type
     */
    function getHtmlPoidsEmballageUVC() {

        $return = $this->getModel()->buildArrayEmballageTypeUVC();

        $htmlPoidsUVC = new HtmlInputText();

        $htmlPoidsUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_POIDS_EMBALLAGES_UVC));
        $htmlPoidsUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::UVC_EMBALLAGE]);
        $htmlPoidsUVC->setIsEditable(FALSE);
        return $htmlPoidsUVC->getHtmlResult();
    }

    /**
     * 
     * @return type
     */
    function getHtmlPoidsNetEmballageUVC() {

        $return = $this->getModel()->buildArrayEmballageTypeUVC();

        $htmlPoidsNetUVC = new HtmlInputText();

        $htmlPoidsNetUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_POIDS_NET_UVC));
        $htmlPoidsNetUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::UVC_EMBALLAGE_NET]);
        $htmlPoidsNetUVC->setIsEditable(FALSE);

        return $htmlPoidsNetUVC->getHtmlResult();
    }

    /**
     * 
     * @return type
     */
    function getHtmlPoidsBrutEmballageUVC() {

        $return = $this->getModel()->buildArrayEmballageTypeUVC();

        $htmlPoidsBrutUVC = new HtmlInputText();

        $htmlPoidsBrutUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_POIDS_BRUT_UVC));
        $htmlPoidsBrutUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::UVC_EMBALLAGE_BRUT]);
        $htmlPoidsBrutUVC->setIsEditable(FALSE);

        return $htmlPoidsBrutUVC->getHtmlResult();
    }

    /**
     * 
     * @return type
     */
    function getHtmlDimensionEmballageUVC() {

        $return = $this->getModel()->buildArrayEmballageTypeUVC();

        $htmlDimensionUVC = new HtmlInputText();

        $htmlDimensionUVC->setLabel(FtaConditionnementModel::UVC_EMBALLAGE_DIMENSION_LABEL);
        $htmlDimensionUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::UVC_EMBALLAGE_DIMENSION]);
        $htmlDimensionUVC->setIsEditable(FALSE);


        return $htmlDimensionUVC->getHtmlResult();
    }

    /**
     * 
     * @return type
     */
    function getHtmlNombreColisUVC() {

        $return = $this->getModel()->buildArrayEmballageTypeDuColis();

        $htmlNombreColisUVC = new HtmlInputText();

        $htmlNombreColisUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON));
        $htmlNombreColisUVC->getAttributes()->getValue()->setValue($return[FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON]);
        $htmlNombreColisUVC->setIsEditable(FALSE);

        return $htmlNombreColisUVC->getHtmlResult();
    }

    /**
     * 
     * @return type
     */
    function getHtmlPoidsColisUVC() {

        $return = $this->getModel()->buildArrayEmballageTypeDuColis();

        $htmlPoidColisUVC = new HtmlInputText();

        $htmlPoidColisUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_POIDS_EMBALLAGES_UVC));
        $htmlPoidColisUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::COLIS_EMBALLAGE]);
        $htmlPoidColisUVC->setIsEditable(FALSE);

        return $htmlPoidColisUVC->getHtmlResult();
    }

    /**
     * 
     * @return type
     */
    function getHtmlPoidsNetColisUVC() {

        $return = $this->getModel()->buildArrayEmballageTypeDuColis();

        $htmlPoidsNetColisUVC = new HtmlInputText();

        $htmlPoidsNetColisUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON));
        $htmlPoidsNetColisUVC->getAttributes()->getValue()->setValue($return["colis_net"]);
        $htmlPoidsNetColisUVC->setIsEditable(FALSE);

        return $htmlPoidsNetColisUVC->getHtmlResult();
    }

    /**
     * 
     * @return type
     */
    function getHtmlPoidsBrutColisUVC() {

        $return = $this->getModel()->buildArrayEmballageTypeDuColis();

        $htmlPoidsBrutColisUVC = new HtmlInputText();

        $htmlPoidsBrutColisUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_POIDS_BRUT_UVC));
        $htmlPoidsBrutColisUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::COLIS_EMBALLAGE_BRUT]);
        $htmlPoidsBrutColisUVC->setIsEditable(FALSE);

        return $htmlPoidsBrutColisUVC->getHtmlResult();
    }

    /**
     * 
     * @return type
     */
    function getHtmlHauteurColisUVC() {

        $return = $this->getModel()->buildArrayEmballageTypeDuColis();

        $htmlHauteurColisUVC = new HtmlInputText();

        $htmlHauteurColisUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaConditionnementModel::TABLENAME, FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT));
        $htmlHauteurColisUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::COLIS_EMBALLAGE_HAUTEUR]);
        $htmlHauteurColisUVC->setIsEditable(FALSE);

        return $htmlHauteurColisUVC->getHtmlResult();
    }

    /**
     * 
     * @return type
     */
    function getHtmlPoidsNetPaletteUVC() {

        //Calcul du poids de Emballages par Palette

        $return = $this->getModel()->buildArrayEmballageTypePalette();

        $htmlPoidsNetPalettisationUVC = new HtmlInputText();

        $htmlPoidsNetPalettisationUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON));
        $htmlPoidsNetPalettisationUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::PALETTE_EMBALLAGE_NET]);
        $htmlPoidsNetPalettisationUVC->setIsEditable(FALSE);

        return $htmlPoidsNetPalettisationUVC->getHtmlResult();
    }

    /**
     * 
     * @return type
     */
    function getHtmlPoidsBrutPaletteUVC() {

        $return = $this->getModel()->buildArrayEmballageTypePalette();

        $htmlPoidsBrutPalettisationUVC = new HtmlInputText();

        $htmlPoidsBrutPalettisationUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_POIDS_BRUT_UVC));
        $htmlPoidsBrutPalettisationUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::PALETTE_EMBALLAGE_BRUT]);
        $htmlPoidsBrutPalettisationUVC->setIsEditable(FALSE);

        return $htmlPoidsBrutPalettisationUVC->getHtmlResult();
    }

    /**
     * 
     * @return type
     */
    function getHtmlHauteurPaletteUVC() {

        $return = $this->getModel()->buildArrayEmballageTypePalette();

        $htmlHauteurPalettisationUVC = new HtmlInputText();

        $htmlHauteurPalettisationUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaConditionnementModel::TABLENAME, FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT));
        $htmlHauteurPalettisationUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::PALETTE_EMBALLAGE_HAUTEUR]);
        $htmlHauteurPalettisationUVC->setIsEditable(FALSE);

        return $htmlHauteurPalettisationUVC->getHtmlResult();
    }

    /**
     * 
     * @return type
     */
    function getHtmlNombrePaletteUVC() {

        $return = $this->getModel()->buildArrayEmballageTypePalette();

        $htmlCouchePalettisationUVC = new HtmlInputText();

        $htmlCouchePalettisationUVC->setLabel(FtaConditionnementModel::PALETTE_EMBALLAGE_HAUTEUR_LABEL);
        $htmlCouchePalettisationUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::PALETTE_NOMBRE_DE_COUCHE]);
        $htmlCouchePalettisationUVC->setIsEditable(FALSE);

        return $htmlCouchePalettisationUVC->getHtmlResult();
    }

    /**
     * 
     * @return type
     */
    function getHtmlColisCouchePaletteUVC() {

        $return = $this->getModel()->buildArrayEmballageTypePalette();

        $htmlColisCouchePalettisationUVC = new HtmlInputText();

        $htmlColisCouchePalettisationUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaConditionnementModel::TABLENAME, FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT));
        $htmlColisCouchePalettisationUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE]);
        $htmlColisCouchePalettisationUVC->setIsEditable(FALSE);

        return $htmlColisCouchePalettisationUVC->getHtmlResult();
    }

    /**
     * 
     * @return type
     */
    function getHtmlColisTotalUVC() {

        $return = $this->getModel()->buildArrayEmballageTypePalette();

        $htmlTotalColisPalettisationUVC = new HtmlInputText();

        $htmlTotalColisPalettisationUVC->setLabel(FtaConditionnementModel::PALETTE_NOMBRE_TOTAL_PAR_CARTON_LABEL);
        $htmlTotalColisPalettisationUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::PALETTE_NOMBRE_TOTAL_PAR_CARTON]);
        $htmlTotalColisPalettisationUVC->setIsEditable(FALSE);

        return $htmlTotalColisPalettisationUVC->getHtmlResult();
    }

}
