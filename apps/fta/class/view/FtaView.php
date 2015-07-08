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

    public function getHtmlCreateurFta() {

        $htmlObject = new htmlInputText();
        $htmlObject->setLabel($this->getModel()->getDataField(FtaModel::FIELDNAME_CREATEUR)->getFieldLabel());
        $htmlObject->getAttributes()->getValue()->setValue($this->getModel()->getModelCreateur()->getPrenomNom());
        $htmlObject->setIsEditable(FALSE);
        return $htmlObject->getHtmlResult();
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

    public function getHtmlEmballageParUVC() {
        $annexeEmballageGroupeTypeModel = new AnnexeEmballageGroupeTypeModel();
        $idFtaConditionnment = $annexeEmballageGroupeTypeModel->getEmballageGroupeUVC();
        $ftaConditionnmentModel = new FtaConditionnementModel($idFtaConditionnment);
        $franck = $annexeEmballageGroupeTypeModel->getEmballageGroupeUVC();
        $htmlEmballageUVC = new HtmlSubForm();

        $htmlEmballageUVC->setArrayContent($idFtaConditionnment);


        return $htmlEmballageUVC->getHtmlViewedContent()
        ;
    }
    public function getHtmlEmballagePalette() {
        $annexeEmballageGroupeTypeModel = new AnnexeEmballageGroupeTypeModel(4);
        $idFtaConditionnment = $annexeEmballageGroupeTypeModel->getEmballageGroupePalette();
        $ftaConditionnmentModel = new FtaConditionnementModel($idFtaConditionnment);
        $className=$ftaConditionnmentModel->getClassName();
        $label=$annexeEmballageGroupeTypeModel->getDataField(AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE)->getFieldValue();
        $htmlEmballagePalette = new HtmlSubForm($idFtaConditionnment,$className,$label);



        return $htmlEmballagePalette->getHtmlViewedContent()
        ;
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
                        $this->getModel()->getModelSiteExpedition()->getDataField(GeoModel::FIELDNAME_GEO_CNUD_PREPARER_PAR)
                        , false
        );
    }

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

    function getHtmlPoidsEmballageUVC() {

        $return = $this->getModel()->buildArrayEmballageTypeUVC();

        $htmlPoidsUVC = new HtmlInputText();

        $htmlPoidsUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_POIDS_EMBALLAGES_UVC));
        $htmlPoidsUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::UVC_EMBALLAGE]);
        $htmlPoidsUVC->setIsEditable(FALSE);
        return $htmlPoidsUVC->getHtmlResult();
    }

    function getHtmlPoidsNetEmballageUVC() {

        $return = $this->getModel()->buildArrayEmballageTypeUVC();

        $htmlPoidsNetUVC = new HtmlInputText();

        $htmlPoidsNetUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_POIDS_NET_UVC));
        $htmlPoidsNetUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::UVC_EMBALLAGE_NET]);
        $htmlPoidsNetUVC->setIsEditable(FALSE);

        return $htmlPoidsNetUVC->getHtmlResult();
    }

    function getHtmlPoidsBrutEmballageUVC() {

        $return = $this->getModel()->buildArrayEmballageTypeUVC();

        $htmlPoidsBrutUVC = new HtmlInputText();

        $htmlPoidsBrutUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_POIDS_BRUT_UVC));
        $htmlPoidsBrutUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::UVC_EMBALLAGE_BRUT]);
        $htmlPoidsBrutUVC->setIsEditable(FALSE);

        return $htmlPoidsBrutUVC->getHtmlResult();
    }

    function getHtmlDimensionEmballageUVC() {

        $return = $this->getModel()->buildArrayEmballageTypeUVC();

        $htmlDimensionUVC = new HtmlInputText();

        $htmlDimensionUVC->setLabel(FtaConditionnementModel::UVC_EMBALLAGE_DIMENSION_LABEL);
        $htmlDimensionUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::UVC_EMBALLAGE_DIMENSION]);
        $htmlDimensionUVC->setIsEditable(FALSE);


        return $htmlDimensionUVC->getHtmlResult();
    }

    function getHtmlNombreColisUVC() {

        $return = $this->getModel()->buildArrayEmballageTypeDuColis();

        $htmlNombreColisUVC = new HtmlInputText();

        $htmlNombreColisUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON));
        $htmlNombreColisUVC->getAttributes()->getValue()->setValue($return[FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON]);
        $htmlNombreColisUVC->setIsEditable(FALSE);

        return $htmlNombreColisUVC->getHtmlResult();
    }

    function getHtmlPoidsColisUVC() {

        $return = $this->getModel()->buildArrayEmballageTypeDuColis();

        $htmlPoidColisUVC = new HtmlInputText();

        $htmlPoidColisUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_POIDS_EMBALLAGES_UVC));
        $htmlPoidColisUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::COLIS_EMBALLAGE]);
        $htmlPoidColisUVC->setIsEditable(FALSE);

        return $htmlPoidColisUVC->getHtmlResult();
    }

    function getHtmlPoidsNetColisUVC() {

        $return = $this->getModel()->buildArrayEmballageTypeDuColis();

        $htmlPoidsNetColisUVC = new HtmlInputText();

        $htmlPoidsNetColisUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON));
        $htmlPoidsNetColisUVC->getAttributes()->getValue()->setValue($return["colis_net"]);
        $htmlPoidsNetColisUVC->setIsEditable(FALSE);

        return $htmlPoidsNetColisUVC->getHtmlResult();
    }

    function getHtmlPoidsBrutColisUVC() {

        $return = $this->getModel()->buildArrayEmballageTypeDuColis();

        $htmlPoidsBrutColisUVC = new HtmlInputText();

        $htmlPoidsBrutColisUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_POIDS_BRUT_UVC));
        $htmlPoidsBrutColisUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::COLIS_EMBALLAGE_BRUT]);
        $htmlPoidsBrutColisUVC->setIsEditable(FALSE);

        return $htmlPoidsBrutColisUVC->getHtmlResult();
    }

    function getHtmlHauteurColisUVC() {

        $return = $this->getModel()->buildArrayEmballageTypeDuColis();

        $htmlHauteurColisUVC = new HtmlInputText();

        $htmlHauteurColisUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaConditionnementModel::TABLENAME, FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT));
        $htmlHauteurColisUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::COLIS_EMBALLAGE_HAUTEUR]);
        $htmlHauteurColisUVC->setIsEditable(FALSE);

        return $htmlHauteurColisUVC->getHtmlResult();
    }

    function getHtmlPoidsNetPaletteUVC() {

        //Calcul du poids de Emballages par Palette

        $return = $this->getModel()->buildArrayEmballageTypePalette();

        $htmlPoidsNetPalettisationUVC = new HtmlInputText();

        $htmlPoidsNetPalettisationUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON));
        $htmlPoidsNetPalettisationUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::PALETTE_EMBALLAGE_NET]);
        $htmlPoidsNetPalettisationUVC->setIsEditable(FALSE);

        return $htmlPoidsNetPalettisationUVC->getHtmlResult();
    }

    function getHtmlPoidsBrutPaletteUVC() {

        $return = $this->getModel()->buildArrayEmballageTypePalette();

        $htmlPoidsBrutPalettisationUVC = new HtmlInputText();

        $htmlPoidsBrutPalettisationUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_POIDS_BRUT_UVC));
        $htmlPoidsBrutPalettisationUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::PALETTE_EMBALLAGE_BRUT]);
        $htmlPoidsBrutPalettisationUVC->setIsEditable(FALSE);

        return $htmlPoidsBrutPalettisationUVC->getHtmlResult();
    }

    function getHtmlHauteurPaletteUVC() {

        $return = $this->getModel()->buildArrayEmballageTypePalette();

        $htmlHauteurPalettisationUVC = new HtmlInputText();

        $htmlHauteurPalettisationUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaConditionnementModel::TABLENAME, FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT));
        $htmlHauteurPalettisationUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::PALETTE_EMBALLAGE_HAUTEUR]);
        $htmlHauteurPalettisationUVC->setIsEditable(FALSE);

        return $htmlHauteurPalettisationUVC->getHtmlResult();
    }

    function getHtmlNombrePaletteUVC() {

        $return = $this->getModel()->buildArrayEmballageTypePalette();

        $htmlCouchePalettisationUVC = new HtmlInputText();

        $htmlCouchePalettisationUVC->setLabel(FtaConditionnementModel::PALETTE_EMBALLAGE_HAUTEUR_LABEL);
        $htmlCouchePalettisationUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::PALETTE_NOMBRE_DE_COUCHE]);
        $htmlCouchePalettisationUVC->setIsEditable(FALSE);

        return $htmlCouchePalettisationUVC->getHtmlResult();
    }

    function getHtmlColisCouchePaletteUVC() {

        $return = $this->getModel()->buildArrayEmballageTypePalette();

        $htmlColisCouchePalettisationUVC = new HtmlInputText();

        $htmlColisCouchePalettisationUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaConditionnementModel::TABLENAME, FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT));
        $htmlColisCouchePalettisationUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE]);
        $htmlColisCouchePalettisationUVC->setIsEditable(FALSE);

        return $htmlColisCouchePalettisationUVC->getHtmlResult();
    }

    function getHtmlColisTotalUVC() {

        $return = $this->getModel()->buildArrayEmballageTypePalette();

        $htmlTotalColisPalettisationUVC = new HtmlInputText();

        $htmlTotalColisPalettisationUVC->setLabel(FtaConditionnementModel::PALETTE_NOMBRE_TOTAL_PAR_CARTON_LABEL);
        $htmlTotalColisPalettisationUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::PALETTE_NOMBRE_TOTAL_PAR_CARTON]);
        $htmlTotalColisPalettisationUVC->setIsEditable(FALSE);

        return $htmlTotalColisPalettisationUVC->getHtmlResult();
    }

}
