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

    public function getHtmlUniteFacturationWithPoidsElementaire() {

        //Initialisation des variables locales
        $htmlReturn = NULL;
        $htmlObjectUniteFacturation = new DataFieldToHtmlList(
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

    public function getHtmlCreateurFta() {

        $htmlObject = new htmlInputText();
        $htmlObject->setLabel($this->getModel()->getDataField(FtaModel::FIELDNAME_CREATEUR)->getFieldLabel());
        $htmlObject->getAttributes()->getValue()->setValue($this->getModel()->getModelCreateur()->getPrenomNom());
        $htmlObject->setIsEditable(FALSE);
        return $htmlObject->getHtmlResult();
    }

    public function getHtmlEcheancesProcessus() {
        if ($this->getModel()->getDataField(FtaModel::FIELDNAME_DATE_ECHEANCE_FTA)) {

            //Date d'échéance de la FTA
            $dataField = $this->getModel()->getDataField(FtaModel::FIELDNAME_DATE_ECHEANCE_FTA);
            $htmlElement = new DataFieldToHtmlInputCalendar($dataField);
            $htmlElement->setIsEditable($this->getIsEditable());

            $bloc .=$htmlElement->getHtmlResult();
            $bloc .= self::showDatesEcheanceProcessus();

            $bloc = "";

            $req = "SELECT id_fta_processus_delai, nom_fta_processus, date_echeance_processus FROM `fta_processus_delai`, fta_processus WHERE `id_fta` ="
                    . $this->getModel()->getKeyValue() . " "
                    . "AND fta_processus_delai.id_fta_processus=fta_processus.id_fta_processus "
                    . "ORDER BY date_echeance_processus "
            ;

            $paramTitle = "Echéances des processus";
            $paramDivId = "echeance_processus";
            $paramSubFormModelClassName = "FtaProcessusDelaiModel";

            $paramArrayContent = DatabaseOperation::convertSqlResultWithKeyAsFirstFieldToArray(
                            DatabaseOperation::query($req)
            );

            $subFormDateEcheance = new HtmlSubForm3Fields($paramArrayContent, $paramSubFormModelClassName, $paramTitle, $paramDivId);
            $bloc = $subFormDateEcheance->getHtmlResult();
        }
        return $bloc;
    }

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
        $HtmlSuiviProjet->setIsEditable(TRUE);

        $return .= $HtmlSuiviProjet->getHtmlResult();
        return $return;
    }

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
        $HtmlSuiviProjet->setIsEditable(TRUE);

        $return .= $HtmlSuiviProjet->getHtmlResult();
        return $return;
    }

    function getFtaSuiviProjetModel() {

        $idFtaChapitre = $this->getFtaChapitreModel()->getKeyValue();
        $idFtaSuiviProjet = FtaSuiviProjetModel::getIdFtaSuiviProjetByIdFtaAndIdChapitre(
                        $this->getModel()->getKeyValue(), $idFtaChapitre
        );
        $ftaSuiviProjetModel = new FtaSuiviProjetModel($idFtaSuiviProjet);
        $ftaSuiviProjetModel->setIsEditable($this->getIsEditable());
        return $ftaSuiviProjetModel;
    }

    function getHtmlCNUDPreparerPar() {

        return Html::convertDataFieldToHtml(
                        $this->getModel()->getModelSiteExpediton()->getDataField(GeoModel::FIELDNAME_GEO_CNUD_PREPARER_PAR)
                        , false
        );
    }

    function getHtmlSiteAgrement() {

        return Html::convertDataFieldToHtml(
                        $this->getModel()->getModelSiteExpediton()->getDataField(GeoModel::FIELDNAME_SITE_AGREMENT_CE)
                        , false
        );
    }

}

?>
