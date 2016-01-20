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
     * Valeur de confirmation, pour un bouton de validation
     */
    const BUTTON_TYPE_SUBMIT_VALUE = "Confirmer";

    /**
     * Fonction JavaScript appelée pour actualiser la visibilité
     * du champs Poids_ELEM
     */
    const JAVASCRIPT_CALLBACK_POIDS_ELEM = "displayPoidsElem";

    /**
     * Fonction JavaScript appelée pour actualiser la visibilité
     * du champs Poids_ELEM
     */
    const CALLBACK_LINK_TO_FTA_VALUE = "Retour vers la Fta";

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
        
        $dataField = $this->getModel()->getDataField($paramFieldName);

        if ($dataField->isDataValidationSuccessful() == FALSE){
            $this->setDataValidationSuccessfulToFalse();
        }
        
        return Html::convertDataFieldToHtml(
                        $dataField
                        , $this->getIsEditable()
        );
    }

    /**
     * Affiche la date d'échéance
     * @return string
     */
    function getHtmlDateEcheance() {
        $this->getModel()->setIsEditable($this->getIsEditable());
        return $this->getModel()->getHtmlDateEcheance(FALSE);
    }

    /**
     * Affiche le bouton de validation
     * @return string
     */
    public static function getHtmlButtonSubmit() {
        return ' <td><input type=submit value=\'' . self::BUTTON_TYPE_SUBMIT_VALUE . '\'></td>';
    }

    /**
     * Affiche le bouton de retour vers la Fta
     * @return string
     */
    public static function getHtmlButtonReturnFta($paramIdFta, $paramIdFtaChapitreEncours, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationFtaEtat, $paramIdFtaRole) {
        return '<td><center>'
                . '<a href=modification_fiche.php?'
                . 'id_fta=' . $paramIdFta
                . '&id_fta_chapitre_encours=' . $paramIdFtaChapitreEncours
                . '&synthese_action=' . $paramSyntheseAction
//                . '&comeback=' . $paramComeback
                . '&id_fta_etat=' . $paramIdFtaEtat
                . '&abreviation_fta_etat=' . $paramAbreviationFtaEtat
                . '&id_fta_role=' . $paramIdFtaRole
                . '>' . self::CALLBACK_LINK_TO_FTA_VALUE . '</a></center></td>';
    }

    /**
     * Affichage Html de la DIN
     * @return string
     */
    public function getHtmlDesignationInterneAgis() {
        $DIN = $this->getModel()->getDataField(FtaModel::FIELDNAME_LIBELLE)->getFieldValue();
        if ($this->getModel()->getDataField(FtaModel::FIELDNAME_LIBELLE)->isDataValidationSuccessful() == FALSE){
            $this->setDataValidationSuccessfulToFalse();
        }
        if (!$DIN) {
            $DesignationCommerciale = $this->getModel()->getDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE)->getFieldValue();
            $suffixeAgrologicFta = $this->getModel()->getDataField(FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA)->getFieldValue();
            $NB_UNIT_ELEM = $this->getModel()->getDataField(FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON)->getFieldValue();
            $poidAffichage = $this->getModel()->getDataField(FtaModel::FIELDNAME_POIDS_ELEMENTAIRE)->getFieldValue();
            $valeurUnite = "kg";
            if ($poidAffichage < FtaModel::VALEUR_CHECK_EN_KG) {
                $poidAffichage = $poidAffichage * FtaModel::CONVERSION_KG_EN_G;
                $valeurUnite = "g";
            }
            $DIN = $DesignationCommerciale . " " . $suffixeAgrologicFta . " " . $NB_UNIT_ELEM . "X" . $poidAffichage . $valeurUnite;


            $DIN = strtoupper($DIN);
            $this->getModel()->getDataField(FtaModel::FIELDNAME_LIBELLE)->setFieldValue($DIN);
            $this->getModel()->saveToDatabase();
            $return = $this->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE);
        } else {
            $return = $this->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE);
        }

        return $return;
    }

    /**
     * Affichage Html du poids net uvf
     * @return string
     */
    public function getHtmlPoidNetUVF() {
        $id_fta = $this->getModel()->getKeyValue();
        $PoidNetUVFValue = $this->getModel()->getDataField(FtaModel::FIELDNAME_POIDS_ELEMENTAIRE)->getFieldValue();
        $PoidNetUVF = new HtmlInputText();
        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_POIDS_ELEMENTAIRE
                . '_'
                . $id_fta
        ;
        $PoidNetUVF->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_POIDS_ELEMENTAIRE));
        $PoidNetUVF->getAttributes()->getValue()->setValue($PoidNetUVFValue);
        $PoidNetUVF->getAttributes()->getSize()->setValue("8");
        $PoidNetUVF->setIsEditable($this->getIsEditable());
        $PoidNetUVF->initAbstractHtmlInput($HtmlTableName, $PoidNetUVF->getLabel(), $PoidNetUVFValue, NULL);
        $PoidNetUVF->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $id_fta, FtaModel::FIELDNAME_POIDS_ELEMENTAIRE);
        return $PoidNetUVF->getHtmlResult();
    }

    /**
     * Affichage Html de la désignation commerciale
     * @return string
     */
    public function getHtmlDesignationCommerciale() {
        $id_fta = $this->getModel()->getKeyValue();
        $DesignationCommercialeValue = $this->getModel()->getDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE)->getFieldValue();
        $DesignationCommerciale = new HtmlInputText();
        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE
                . '_'
                . $id_fta
        ;
        $DesignationCommerciale->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE));
        $DesignationCommerciale->getAttributes()->getValue()->setValue($DesignationCommercialeValue);
        $DesignationCommerciale->getAttributes()->getSize()->setValue("70");
        $DesignationCommerciale->setIsEditable($this->getIsEditable());
        $DesignationCommerciale->initAbstractHtmlInput(
                $HtmlTableName
                , $DesignationCommerciale->getLabel()
                , $DesignationCommercialeValue
                , NULL);
        $DesignationCommerciale->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $id_fta, FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE);
        return $DesignationCommerciale->getHtmlResult();
    }

    /**
     * Affichage Html de l'ean article
     * @return string
     */
    function getHtmlEANArticle() {
        $id_fta = $this->getModel()->getKeyValue();
        $eanArticleValue = $this->getModel()->getDataField(FtaModel::FIELDNAME_EAN_UVC)->getFieldValue();
        $eanArticle = new HtmlInputText();
        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_EAN_UVC
                . '_'
                . $id_fta
        ;
        $eanArticle->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_EAN_UVC));
        $eanArticle->getAttributes()->getValue()->setValue($eanArticleValue);
        $eanArticle->getAttributes()->getPattern()->setValue("[0-9]{1,13}");
        $eanArticle->getAttributes()->getMaxLength()->setValue("13");
        $eanArticle->setIsEditable($this->getIsEditable());
        $eanArticle->initAbstractHtmlInput(
                $HtmlTableName
                , $eanArticle->getLabel()
                , $eanArticleValue
                , $this->getModel()->getDataField(FtaModel::FIELDNAME_EAN_UVC)->isFieldDiff()
        );
        $eanArticle->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $id_fta, FtaModel::FIELDNAME_EAN_UVC);
        return $eanArticle->getHtmlResult();
    }

    /**
     * Affichage Html de l'ean colis
     * @return string
     */
    function getHtmlEANColis() {
        $id_fta = $this->getModel()->getKeyValue();
        $eanColisValue = $this->getModel()->getDataField(FtaModel::FIELDNAME_EAN_COLIS)->getFieldValue();
        $eanColis = new HtmlInputText();
        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_EAN_COLIS
                . '_'
                . $id_fta
        ;
        $eanColis->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_EAN_COLIS));
        $eanColis->getAttributes()->getValue()->setValue($eanColisValue);
        $eanColis->getAttributes()->getPattern()->setValue("[0-9]{1,14}");
        $eanColis->getAttributes()->getMaxLength()->setValue("14");
        $eanColis->setIsEditable($this->getIsEditable());
        $eanColis->initAbstractHtmlInput(
                $HtmlTableName
                , $eanColis->getLabel()
                , $eanColisValue
                , $this->getModel()->getDataField(FtaModel::FIELDNAME_EAN_COLIS)->isFieldDiff()
        );
        $eanColis->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $id_fta, FtaModel::FIELDNAME_EAN_COLIS);
        return $eanColis->getHtmlResult();
    }

    /**
     * Affichage Html de l'ean palette
     * @return string
     */
    function getHtmlEANPalette() {
        $id_fta = $this->getModel()->getKeyValue();
        $eanPaletteValue = $this->getModel()->getDataField(FtaModel::FIELDNAME_EAN_PALETTE)->getFieldValue();
        $eanPalette = new HtmlInputText();
        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_EAN_PALETTE
                . '_'
                . $id_fta
        ;
        $eanPalette->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_EAN_PALETTE));
        $eanPalette->getAttributes()->getValue()->setValue($eanPaletteValue);
        $eanPalette->getAttributes()->getPattern()->setValue("[0-9]{1,14}");
        $eanPalette->getAttributes()->getMaxLength()->setValue("14");
        $eanPalette->setIsEditable($this->getIsEditable());
        $eanPalette->initAbstractHtmlInput(
                $HtmlTableName
                , $eanPalette->getLabel()
                , $eanPaletteValue
                , $this->getModel()->getDataField(FtaModel::FIELDNAME_EAN_PALETTE)->isFieldDiff()
        );
        $eanPalette->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $id_fta, FtaModel::FIELDNAME_EAN_PALETTE);
        return $eanPalette->getHtmlResult();
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
        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_CREATEUR
                . '_'
                . $this->getModel()->getKeyValue()
        ;
        $htmlObject->setLabel($this->getModel()->getDataField(FtaModel::FIELDNAME_CREATEUR)->getFieldLabel());
        $htmlObject->initAbstractHtmlInput($HtmlTableName, $htmlObject->getLabel()
                , $this->getModel()->getModelCreateur()->getPrenomNom()
                , $this->getModel()->getDataField(FtaModel::FIELDNAME_CREATEUR)->isFieldDiff());
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
    public function listeWorkflowByAcces($paramIdUser, $paramIsEditable, $paramIdFta, $paramIdFtaRole) {
        $HtmlList = new HtmlListSelect();

        /*
         * Worflow de FTA
         */
        return FtaWorkflowModel::showListeDeroulanteNomWorkflowByAccesAndIdFta($paramIdUser, $HtmlList, $paramIsEditable, $paramIdFta, $paramIdFtaRole);
    }

    /**
     * Affiche la liste des site de production pour lesquel l'utilisateur connecté à les droits d'accès
     * @param int $paramIdUser
     * @param bolean $paramIsEditable
     * @return string
     */
    public function listeSiteByAcces($paramIdUser, $paramIsEditable) {
        $HtmlList = new HtmlListSelect();

        /*
         * Site de production FTA
         */
        return $this->showListeDeroulanteSiteProdByAccesAndIdFta($paramIdUser, $HtmlList, $paramIsEditable);
    }

    /**
     * Affiche la liste des site de production pour lesquel l'utilisateur connecté à les droits d'accès 
     * et l'identifiant de la Fta en cours
     * @param int $paramIdUser
     * @param HtmlListSelect $paramHtmlObjet
     * @param boolean $paramIsEditable
     * @return string
     */
    function showListeDeroulanteSiteProdByAccesAndIdFta($paramIdUser, HtmlListSelect $paramHtmlObjet, $paramIsEditable) {

        /**
         * Modification
         */
        $ftaModification = IntranetDroitsAccesModel::getFtaModification($paramIdUser);

        /**
         * Consultation
         */
        $ftaConsultation = IntranetDroitsAccesModel::getFtaConsultation($paramIdUser);

        /**
         * Si l'utilisateur a les droits en consultation sur le module et pas en modification
         * Transmettre à $paramHtmlObjet la liste de tous les sites taggés "fta".
         * 
         * Si il a accès en consultation et modification alors
         */
        if ($ftaConsultation and $ftaModification) {

            $idFtaWorkflow = $this->getModel()->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
            $arraySite = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                            'SELECT DISTINCT ' . GeoModel::KEYNAME . ',' . GeoModel::FIELDNAME_GEO
                            . ' FROM ' . GeoModel::TABLENAME
                            . ', ' . FtaActionSiteModel::TABLENAME
                            . ', ' . IntranetActionsModel::TABLENAME
                            . ', ' . IntranetDroitsAccesModel::TABLENAME
                            . ', ' . FtaWorkflowModel::TABLENAME
                            . ' WHERE ' . FtaActionSiteModel::TABLENAME . '.' . FtaActionSiteModel::FIELDNAME_ID_SITE . '=' . GeoModel::KEYNAME
                            . ' AND ' . FtaActionSiteModel::TABLENAME . '.' . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                            . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                            . ' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                            . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS
                            . ' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::KEYNAME
                            . '=' . $idFtaWorkflow
                            . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                            . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                            . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdUser // L'utilisateur connecté
                            . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                            . ' ORDER BY ' . GeoModel::FIELDNAME_GEO
            );
        } elseif ($ftaConsultation) {
            $arraySite = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                            'SELECT DISTINCT ' . GeoModel::KEYNAME . ',' . GeoModel::FIELDNAME_GEO
                            . ' FROM ' . GeoModel::TABLENAME
                            . ' WHERE ' . GeoModel::FIELDNAME_TAG_APPLICATION_GEO . ' LIKE \'%fta%\''
                            . ' ORDER BY ' . GeoModel::FIELDNAME_GEO
            );
        }

        $paramHtmlObjet->setArrayListContent($arraySite);

        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_SITE_PRODUCTION
                . '_'
                . $this->getModel()->getKeyValue()
        ;
        $paramHtmlObjet->getAttributes()->getName()->setValue(FtaModel::FIELDNAME_SITE_PRODUCTION);
        $paramHtmlObjet->setLabel(DatabaseDescription::getFieldDocLabel(GeoModel::TABLENAME, GeoModel::FIELDNAME_GEO));
        $paramHtmlObjet->setIsEditable($paramIsEditable);
        $paramHtmlObjet->initAbstractHtmlSelect(
                $HtmlTableName, $paramHtmlObjet->getLabel()
                , $this->getModel()->getDataField(FtaModel::FIELDNAME_SITE_PRODUCTION)->getFieldValue()
                , $this->getModel()->getDataField(FtaModel::FIELDNAME_SITE_PRODUCTION)->isFieldDiff()
                , $paramHtmlObjet->getArrayListContent());
        $paramHtmlObjet->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $this->getModel()->getKeyValue(), FtaModel::FIELDNAME_SITE_PRODUCTION);
        $listeSiteProduction = $paramHtmlObjet->getHtmlResult();

        return $listeSiteProduction;
    }

    /**
     * Accès à la page de modification de la classification
     * @param boolean $paramIsEditable
     * @return string
     */
    public function listeClassification($paramIsEditable, $paramIdFtaChapitre, $paramSyntheseAction, $paramIdFtaEtat, $paramAbrevationEtat, $paramIdFtaRole) {
        $idFtaClassification2 = $this->getModel()->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue();
        $idFta = $this->getModel()->getKeyValue();
        /*
         * Classification FTA
         */
        if ($paramIsEditable and ! $idFtaClassification2) {

            $ListeCLassification = "<tr ><td class=\"contenu\">Ajouter une classification</td ><td class=\"contenu\" width=75% >"
                    . "<a href="
                    . "ajout_classification_chemin.php?"
                    . "id_fta=" . $idFta
                    . "&id_fta_chapitre_encours=" . $paramIdFtaChapitre
                    . "&synthese_action=" . $paramSyntheseAction
//                    . "&comeback=" . $paramComeback
                    . "&id_fta_etat=" . $paramIdFtaEtat
                    . "&abreviation_fta_etat=" . $paramAbrevationEtat
                    . "&id_fta_role=" . $paramIdFtaRole
                    . ">Cliquez ici</a></td></tr>";
        } else {
            /**
             * Les données sont initalisation de la classification
             */
            $this->initClassificationFta();
            $ListeCLassification = ClassificationFta2Model::showListeDeroulanteClassification(FALSE);
            if ($paramIsEditable) {
                $ListeCLassification .= "<tr ><td class=\"contenu\">Modifier la classification</td ><td class=\"contenu\" width=75% >"
                        . "<a href="
                        . "ajout_classification_chemin.php?"
                        . "id_fta=" . $idFta
                        . "&id_fta_chapitre_encours=" . $paramIdFtaChapitre
                        . "&synthese_action=" . $paramSyntheseAction
//                        . "&comeback=" . $paramComeback
                        . "&id_fta_etat=" . $paramIdFtaEtat
                        . "&abreviation_fta_etat=" . $paramAbrevationEtat
                        . "&id_fta_role=" . $paramIdFtaRole
                        . "&id_fta_classification2=" . $idFtaClassification2
                        . ">Cliquez ici</a></td></tr>";
            }
        }

        return $ListeCLassification;
    }

    function initClassificationFta() {
        /**
         * Récuparation des données pour la classification
         */
        $idFtaClassification2 = $this->getModel()->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue();
        /**
         * Vérification si la Fta est une v0
         */
        if ($this->getModel()->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue()) {
            /**
             * Si oui on vérifie si la classification est différente de la version précédente
             */
            $warningUpdate = $this->getModel()->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->isFieldDiff();
        }
        /**
         * Verification pour la classification
         */
        if ($idFtaClassification2) {
            $ClassificationFta2Model = new ClassificationFta2Model($idFtaClassification2);
            $selection_proprietaire1 = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE)->getFieldValue();
            $selection_proprietaire2 = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE)->getFieldValue();
            $selection_marque = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_MARQUE)->getFieldValue();
            $selection_activite = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_ACTIVITE)->getFieldValue();
            $selection_rayon = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_RAYON)->getFieldValue();
            $selection_environnement = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT)->getFieldValue();
            $selection_reseau = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_RESEAU)->getFieldValue();
            $selection_saisonnalite = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE)->getFieldValue();
        }
        ClassificationFta2Model::initClassification($selection_proprietaire1, $selection_proprietaire2, $selection_marque
                , $selection_activite, $selection_rayon, $selection_environnement, $selection_reseau, $selection_saisonnalite, $warningUpdate);
    }

    /**
     * Accès à la page de modification de l'espace de travail
     * @param boolean $paramIsEditable
     * @return string
     */
    public function workflowChangeList($paramIsEditable, $paramIdFtaChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbrevationEtat, $paramIdFtaRole) {
        $idFtaWorkflow = $this->getModel()->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
        $idFta = $this->getModel()->getKeyValue();
        /*
         * Classification FTA
         */
        if ($paramIsEditable) {
            $ListeCLassification .= "<tr ><td class=\"contenu\"> " . UserInterfaceLabel::FR_MODIFICATION_ESPACE_DE_TRAVAIL . "</td ><td class=\"contenu\" width=75% >"
                    . "<a href="
                    . "modification_workflow.php?"
                    . "id_fta=" . $idFta
                    . "&id_fta_chapitre_encours=" . $paramIdFtaChapitre
                    . "&synthese_action=" . $paramSyntheseAction
                    . "&comeback=" . $paramComeback
                    . "&id_fta_etat=" . $paramIdFtaEtat
                    . "&abreviation_fta_etat=" . $paramAbrevationEtat
                    . "&id_fta_role=" . $paramIdFtaRole
                    . "&id_fta_workflow=" . $idFtaWorkflow
                    . ">Cliquez ici</a></td></tr>";
        }

        return $ListeCLassification;
    }

    /**
     * Accès à la page de modification du gestionnaire de la Fta
     * @param boolean $paramIsEditable
     * @return string
     */
    function gestionnaireChangeList($paramIsEditable, $paramIdFtaChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbrevationEtat, $paramIdFtaRole) {

        $idFta = $this->getModel()->getKeyValue();
        /*
         * Gestionnaire FTA
         */
        if ($paramIsEditable) {
            $ListeGestionnaire .= "<tr ><td class=\"contenu\"> " . UserInterfaceLabel::FR_MODIFICATION_GESTIONNAIRE_FTA . "</td ><td class=\"contenu\" width=75% >"
                    . "<a href="
                    . "modification_gestionnaire.php?"
                    . "id_fta=" . $idFta
                    . "&id_fta_chapitre_encours=" . $paramIdFtaChapitre
                    . "&synthese_action=" . $paramSyntheseAction
                    . "&comeback=" . $paramComeback
                    . "&id_fta_etat=" . $paramIdFtaEtat
                    . "&abreviation_fta_etat=" . $paramAbrevationEtat
                    . "&id_fta_role=" . $paramIdFtaRole
                    . ">Cliquez ici</a></td></tr>";
        }

        return $ListeGestionnaire;
    }

    function listeCodesoftEtiquettes() {
        $SiteDeProduction = $this->getModel()->getDataField(FtaModel::FIELDNAME_SITE_PRODUCTION)->getFieldValue();
        $etiqetteCodesoft = $this->getModel()->getDataField(FtaModel::FIELDNAME_ETIQUETTE_CODESOFT)->getFieldValue();
        $IsEditable = $this->getIsEditable();
        $listeCodesoftEtiquettes = $this->getListeCodesoftEtiquettesColis($IsEditable, $SiteDeProduction, $etiqetteCodesoft);

        return $listeCodesoftEtiquettes;
    }

    /**
     * Liste des étiqettes colis     
     * @param type $paramIsEditable
     * @param type $paramSiteDeProduction
     * @param type $paramEtiqetteCodesoft
     * @return type
     */
    function getListeCodesoftEtiquettesColis($paramIsEditable, $paramSiteDeProduction, $paramEtiqetteCodesoft) {
        $HtmlList = new HtmlListSelect();

        $arrayEtiquette = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . CodesoftEtiquettesModel::KEYNAME . ',' . CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES
                        . ' FROM ' . CodesoftEtiquettesModel::TABLENAME
                        . ' WHERE (' . CodesoftEtiquettesModel::FIELDNAME_K_SITE . '=' . $paramSiteDeProduction
                        . ' OR ' . CodesoftEtiquettesModel::FIELDNAME_K_SITE . '=0)'
                        . ' AND (' . CodesoftEtiquettesModel::FIELDNAME_K_TYPE_ETIQUETTE_CODESOFT_ETIQUETTES . '=1'
                        . ' OR ' . CodesoftEtiquettesModel::FIELDNAME_K_TYPE_ETIQUETTE_CODESOFT_ETIQUETTES . '=0' . ')'
                        . ' AND ' . CodesoftEtiquettesModel::FIELDNAME_IS_ENABLED_FTA . '=1'
                        . ' ORDER BY ' . CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES
        );

        $HtmlList->setArrayListContent($arrayEtiquette);

        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_ETIQUETTE_CODESOFT
                . '_'
                . $this->getModel()->getKeyValue()
        ;
        $HtmlList->getAttributes()->getName()->setValue(FtaModel::FIELDNAME_ETIQUETTE_CODESOFT);
        $HtmlList->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_ETIQUETTE_CODESOFT));
        $HtmlList->setIsEditable($paramIsEditable);
        $HtmlList->initAbstractHtmlSelect(
                $HtmlTableName, $HtmlList->getLabel()
                , $paramEtiqetteCodesoft
                , $this->getModel()->getDataField(FtaModel::FIELDNAME_ETIQUETTE_CODESOFT)->isFieldDiff()
                , $HtmlList->getArrayListContent()
        );
        $HtmlList->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $this->getModel()->getKeyValue(), FtaModel::FIELDNAME_ETIQUETTE_CODESOFT);
        $listeCodesoftEtiquettes = $HtmlList->getHtmlResult();

        return $listeCodesoftEtiquettes;
    }

    /**
     * Tableau des emballages par UVC
     * @param int $paramIdFta
     * @param int $paramChapitre
     * @param string $paramSyntheseAction
     * @param int $paramIdFtaEtat
     * @param string $paramAbreviationEtat
     * @param int $paramIdFtaRole
     * @return string
     */
    public function getHtmlEmballageUVC($paramIdFta, $paramChapitre, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole) {
        $annexeEmballageGroupeTypeModel = new AnnexeEmballageGroupeTypeModel(AnnexeEmballageGroupeTypeModel::EMBALLAGE_UVC);

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

                $annexeEmballageGroupeTypeModel2 = new AnnexeEmballageGroupeTypeModel(AnnexeEmballageGroupeTypeModel::EMBALLAGE_UVC);

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
                if ($arrayFtaConditionnement && $idAnnexeEmballageGroupeType == AnnexeEmballageGroupeTypeModel::EMBALLAGE_UVC) {
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
            $htmlEmballageUVC->setLienAjouter(FtaConditionnementModel::getAddLinkAfterConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_UVC, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageUVC->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_UVC, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageUVC->setLienSuppression(FtaConditionnementModel::getDeleteLinkConditionnement($paramIdFta, $paramChapitre, $arrayIdFtaCondtionnement, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
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
            $htmlEmballageUVC->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_UVC, $paramSyntheseAction,$paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $return .= $htmlEmballageUVC->getHtmlResult();
        }
        return $return;
    }

    /**
     * Tableau des emballages par Colis
     * @param int $paramIdFta
     * @param int $paramChapitre
     * @param string $paramSyntheseAction
     * @param int $paramIdFtaEtat
     * @param string $paramAbreviationEtat
     * @param int $paramIdFtaRole
     * @return string
     */
    public function getHtmlEmballageParColis($paramIdFta, $paramChapitre, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole) {
        $annexeEmballageGroupeTypeModel = new AnnexeEmballageGroupeTypeModel(AnnexeEmballageGroupeTypeModel::EMBALLAGE_PAR_COLIS);
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
                $annexeEmballageGroupeTypeModel2 = new AnnexeEmballageGroupeTypeModel(AnnexeEmballageGroupeTypeModel::EMBALLAGE_PAR_COLIS);


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
            $htmlEmballageParColis->setLienAjouter(FtaConditionnementModel::getAddLinkAfterConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_PAR_COLIS, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageParColis->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_PAR_COLIS, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageParColis->setLienSuppression(FtaConditionnementModel::getDeleteLinkConditionnement($paramIdFta, $paramChapitre, $arrayIdFtaCondtionnement, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageParColis->setTableLabel(FtaConditionnementModel::getTableConditionnementLabel($idFtaCondtionnement));
            $return .= $htmlEmballageParColis->getHtmlResult();
        } else {
            /*
             * Initialisation des modèles 
             */
            $annexeEmballageGroupeTypeModel2 = new AnnexeEmballageGroupeTypeModel(AnnexeEmballageGroupeTypeModel::EMBALLAGE_PAR_COLIS);
            $label = $annexeEmballageGroupeTypeModel2->getDataField(AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE)->getFieldValue();

            $htmlEmballageParColis = new HtmlSubForm_RNN($arrayFtaConditionnement, $className, $label, $tablesNameAndIdForeignKeyOfFtaConditionnement);
            $htmlEmballageParColis->setIsEditable($this->getIsEditable());
            $htmlEmballageParColis->setRightToAdd(TRUE);
            $htmlEmballageParColis->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_PAR_COLIS, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $return .= $htmlEmballageParColis->getHtmlResult();
        }
        return $return;
    }

    /**
     * Tableau des emballages du Colis
     * @param int $paramIdFta
     * @param int $paramChapitre
     * @param string $paramSyntheseAction
     * @param int $paramIdFtaEtat
     * @param string $paramAbreviationEtat
     * @param int $paramIdFtaRole
     * @return string
     */
    public function getHtmlEmballageDuColis($paramIdFta, $paramChapitre, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole) {
        $annexeEmballageGroupeTypeModel = new AnnexeEmballageGroupeTypeModel(AnnexeEmballageGroupeTypeModel::EMBALLAGE_DU_COLIS);

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
                $annexeEmballageGroupeTypeModel2 = new AnnexeEmballageGroupeTypeModel(AnnexeEmballageGroupeTypeModel::EMBALLAGE_DU_COLIS);

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
            $htmlEmballageDuColis->setLienAjouter(FtaConditionnementModel::getAddLinkAfterConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_DU_COLIS, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageDuColis->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_DU_COLIS, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageDuColis->setLienSuppression(FtaConditionnementModel::getDeleteLinkConditionnement($paramIdFta, $paramChapitre, $arrayIdFtaCondtionnement, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageDuColis->setTableLabel(FtaConditionnementModel::getTableConditionnementLabelDuColis($idFtaCondtionnement));

            $return .= $htmlEmballageDuColis->getHtmlResult();
            if (count($FtaConditionnement) > "1") {
                $return.= "<tr class=contenu><td bgcolor=#FFAA55 align=\"center\" valign=\"middle\">";
                $return.=UserInterfaceMessage::FR_WARNING_NOT_HANDLE_TITLE;
                $return.="</td><td bgcolor=#FFAA55 align=\"center\" valign=\"middle\">"
                        . "<h4>" . UserInterfaceMessage::FR_WARNING_EMBALLAGE_COLIS . "</h4></td></tr>";
            }
        } else {
            /*
             * Initialisation des modèles 
             */
            $annexeEmballageGroupeTypeModel2 = new AnnexeEmballageGroupeTypeModel('3');
            $label = $annexeEmballageGroupeTypeModel2->getDataField(AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE)->getFieldValue();

            $htmlEmballageDuColis = new HtmlSubForm_RNN($arrayFtaConditionnement, $className, $label, $tablesNameAndIdForeignKeyOfFtaConditionnement);
            $htmlEmballageDuColis->setIsEditable($this->getIsEditable());
            $htmlEmballageDuColis->setRightToAdd(TRUE);
            $htmlEmballageDuColis->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_DU_COLIS, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $return .= $htmlEmballageDuColis->getHtmlResult();
        }
        return $return;
    }

    /**
     * Tableau des emballages par Palette
     * @param int $paramIdFta
     * @param int $paramChapitre
     * @param string $paramSyntheseAction
     * @param int $paramIdFtaEtat
     * @param string $paramAbreviationEtat
     * @param int $paramIdFtaRole
     * @return string
     */
    public function getHtmlEmballagePalette($paramIdFta, $paramChapitre, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole) {
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

                $annexeEmballageGroupeTypeModel2 = new AnnexeEmballageGroupeTypeModel(AnnexeEmballageGroupeTypeModel::EMBALLAGE_PALETTE);


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
            $htmlEmballagePalette->setLienAjouter(FtaConditionnementModel::getAddLinkAfterConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_PALETTE, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballagePalette->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_PALETTE, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballagePalette->setLienSuppression(FtaConditionnementModel::getDeleteLinkConditionnement($paramIdFta, $paramChapitre, $arrayIdFtaCondtionnement, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballagePalette->setTableLabel(FtaConditionnementModel::getTableConditionnementLabel($idFtaCondtionnement));
            $return .= $htmlEmballagePalette->getHtmlResult();
            if (count($FtaConditionnement) > "1") {
                $return.= "<tr class=contenu><td bgcolor=#FFAA55 align=\"center\" valign=\"middle\">";
                $return.=UserInterfaceMessage::FR_WARNING_NOT_HANDLE_TITLE;
                $return.="</td><td bgcolor=#FFAA55 align=\"center\" valign=\"middle\">"
                        . "<h4>" . UserInterfaceMessage::FR_WARNING_EMBALLAGE_PALETTE . "</h4></td></tr>";
            }
        } else {
            /*
             * Initialisation des modèles 
             */
            $annexeEmballageGroupeTypeModel2 = new AnnexeEmballageGroupeTypeModel(AnnexeEmballageGroupeTypeModel::EMBALLAGE_PALETTE);
            $label = $annexeEmballageGroupeTypeModel2->getDataField(AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE)->getFieldValue();

            $htmlEmballagePalette = new HtmlSubForm_RNN($arrayFtaConditionnement, $className, $label, $tablesNameAndIdForeignKeyOfFtaConditionnement);
            $htmlEmballagePalette->setIsEditable($this->getIsEditable());
            $htmlEmballagePalette->setRightToAdd(TRUE);
            $htmlEmballagePalette->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_PALETTE, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $return .= $htmlEmballagePalette->getHtmlResult();
        }
        return $return;
    }

    /**
     * Tableau d'étiquette composition
     * @param type $paramIdFta
     * @param type $paramChapitre
     * @param type $paramSyntheseAction
     * @param type $paramIdFtaEtat
     * @param type $paramAbreviationEtat
     * @param type $paramIdFtaRole
     * @param type $paramEditable
     * @return type
     */
    public function getHtmlEtiquetteComposition($paramIdFta, $paramChapitre, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $paramEditable) {

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
                $isComposant = $rowsFtaComposant[FtaComposantModel::FIELDNAME_IS_NOMENCLATURE_FTA_COMPOSANT];
                $arrayIdFtaComposant[$idFtaComposant] = $isComposant;
            }

            $htmlEtiquetteComposant = Html::getHtmlObjectFromDataField($this->getModel()->getDataField(FtaModel::FIELDNAME_VIRTUAL_FTA_COMPOSANT));
            $htmlEtiquetteComposant->setIsEditable($this->getIsEditable());
            $htmlEtiquetteComposant->setLienAjouter(FtaComposantModel::getAddAfterLinkComposition($paramIdFta, $paramChapitre, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $htmlEtiquetteComposant->setLienDetail(FtaComposantModel::getDetailLinkComposition($paramIdFta, $paramChapitre, $arrayIdFtaComposant, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $htmlEtiquetteComposant->setLienSuppression(FtaComposantModel::getDeleteLinkComposition($paramIdFta, $paramChapitre, $arrayIdFtaComposant, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEtiquetteComposant->setTableLabel(FtaComposantModel::getTableCompositionLabel($idFtaComposant));
            $return .= $htmlEtiquetteComposant->getHtmlResult();
        } else {
            $htmlEtiquetteComposant = Html::getHtmlObjectFromDataField($this->getModel()->getDataField(FtaModel::FIELDNAME_VIRTUAL_FTA_COMPOSANT));
            $htmlEtiquetteComposant->setIsEditable($this->getIsEditable());
            $htmlEtiquetteComposant->setRightToAdd(TRUE);
            $htmlEtiquetteComposant->getAttributesGlobal()->setHrefAjoutValue(FtaComposantModel::getAddLinkComposition($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $htmlEtiquetteComposant->setLien(FtaComposantModel::getAddLinkComposition($paramIdFta, $paramChapitre, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $return .= $htmlEtiquetteComposant->getHtmlResult();
        }
        return $return;
    }

    /**
     * Tableau d'étiquette composant
     * @param type $paramIdFta
     * @param type $paramChapitre
     * @param type $paramSyntheseAction
     * @param type $paramIdFtaEtat
     * @param type $paramAbreviationEtat
     * @param type $paramIdFtaRole
     * @param type $paramEditable
     * @return type
     */
    public function getHtmlEtiquetteRD($paramIdFta, $paramChapitre, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $paramEditable) {

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
            $htmlEtiquetteComposant->setLienAjouter(FtaComposantModel::getAddLinkComposant($paramIdFta, $paramChapitre, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $htmlEtiquetteComposant->setLienDetail(FtaComposantModel::getDetailLinkComposant($paramIdFta, $paramChapitre, $arrayIdFtaComposant, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $htmlEtiquetteComposant->setLienSuppression(FtaComposantModel::getDeleteLinkComposant($paramIdFta, $paramChapitre, $arrayIdFtaComposant, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEtiquetteComposant->setTableLabel(FtaComposantModel::getTableComposantLabel($idFtaComposant));
            $return .= $htmlEtiquetteComposant->getHtmlResult();
        } else {
            $htmlEtiquetteComposant = Html::getHtmlObjectFromDataField($this->getModel()->getDataField(FtaModel::FIELDNAME_VIRTUAL_FTA_COMPOSANT_RD));
            $htmlEtiquetteComposant->setIsEditable($this->getIsEditable());
            $htmlEtiquetteComposant->setRightToAdd(TRUE);
            $htmlEtiquetteComposant->getAttributesGlobal()->setHrefAjoutValue(FtaComposantModel::getAddLinkComposant($paramIdFta, $paramChapitre, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $htmlEtiquetteComposant->setLien(FtaComposantModel::getAddLinkComposant($paramIdFta, $paramChapitre, $paramSyntheseAction,  $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
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
     * Affiche les commentaires de chaque chapitres pour la Fta concerné
     * @return string
     */
    public function getHtmlCommentaireAllChapitres($paramIdFtaWorkflow) {
        return FtaSuiviProjetModel::getAllCommentsFromChapitres($this->getModel()->getKeyValue(), $paramIdFtaWorkflow);
    }

    /**
     *  Affiche les commentaires de chaque chapitres pour la Fta concerné*
     * @return string
     */
    public function getHtmlCorrectionAllChapitres($paramIdFtaWorkflow) {
        return FtaSuiviProjetModel::getAllCorrectionsFromChapitres($this->getModel()->getKeyValue(), $paramIdFtaWorkflow);
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
        $htmlDimensionUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::UVC_EMBALLAGE_DIMENSION] . ' (Longueur x Largeur x Hauteur)');
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

        $return = $this->getModel()->PoidsDesEmballagesColis();

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

        $htmlPoidsNetColisUVC->setLabel("Poids Net (en Kg):");
        $htmlPoidsNetColisUVC->getAttributes()->getValue()->setValue(round($return["colis_net"], 2));
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

        $htmlPoidsBrutColisUVC->setLabel("Poids Brut (en Kg):");
        $htmlPoidsBrutColisUVC->getAttributes()->getValue()->setValue(round($return[FtaConditionnementModel::COLIS_EMBALLAGE_BRUT], 2));
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

        $htmlPoidsNetPalettisationUVC->setLabel("Poids Net (en Kg):");
        $htmlPoidsNetPalettisationUVC->getAttributes()->getValue()->setValue(round($return[FtaConditionnementModel::PALETTE_EMBALLAGE_NET], 2));
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

        $htmlPoidsBrutPalettisationUVC->setLabel("Poids Brut (en Kg):");
        $htmlPoidsBrutPalettisationUVC->getAttributes()->getValue()->setValue(round($return[FtaConditionnementModel::PALETTE_EMBALLAGE_BRUT], 2));
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
        $htmlHauteurPalettisationUVC->getAttributes()->getValue()->setValue(round($return[FtaConditionnementModel::PALETTE_EMBALLAGE_HAUTEUR], 2));
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

        $htmlCouchePalettisationUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaConditionnementModel::TABLENAME, FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT));
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

    function getHtmlColisControle() {
        $FtaComposant = FtaComposantModel::getIdFtaComposition($this->getModel()->getKeyValue());
        if ($FtaComposant) {
            /**
             * Calcul type emballage UVC
             */
            $returnUVC = $this->getModel()->buildArrayEmballageTypeUVC();
            $pcb = $returnUVC[FtaConditionnementModel::UVC_EMBALLAGE_NET];
            $uvc_net = $returnUVC[FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON];

            /**
             * Calcul type emballage Colis
             */
            $returnCOLIS = $this->getModel()->buildArrayEmballageTypeDuColis();
            $colisNet = $returnCOLIS["colis_net"];
            $check1 = strval($colisNet * "1000");
            $check2 = strval($uvc_net * $pcb);
            if ($check1 <> $check2) {
                $html_warning = "ATTENTION, poids net du colis différents de celui défini dans le chapitre \"Indentié\" <img src=../lib/images/exclamation.png width=15 height=15 border=0/><br><br>";
                $bgcolor = "#FFAA55";
            } else {
                $bgcolor = "#AFFF5A";
                $html_warning = "";
            }
            if ($colisNet) {
                $bloc.= "<tr class=contenu><td bgcolor=$bgcolor align=\"center\" valign=\"middle\">";
                $bloc.="Poids net du colis (en Kg): ";
                $bloc.="</td><td bgcolor=$bgcolor align=\"center\" valign=\"middle\">"
                        . "<h4><br>$colisNet</h4><br>$html_warning</td></tr>";
            } else {
                $bloc = "";
            }
        } else {
            $bloc = "";
        }
        return $bloc;
    }

}
