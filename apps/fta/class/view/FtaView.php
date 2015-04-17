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
    
        $return = $this->getModel()->getArrayComposant();

        $htmlPoidsUVC = new HtmlInputText();

        $htmlPoidsUVC->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_POIDS_EMBALLAGES_UVC));
        $htmlPoidsUVC->getAttributes()->getValue()->setValue($return[FtaConditionnementModel::UVC_EMBALLAGE]);
        $htmlPoidsUVC->setIsEditable(FALSE);
        return $htmlPoidsUVC->getHtmlResult();
    }

    function getHtmlPoidsNetEmballageUVC() {
        //Calcul du Poid Net Emballage (g)        
        $req = "SELECT * FROM " . FtaModel::TABLENAME;
        $result = DatabaseOperation::query($req);

        //Remplacer par getHtmlValueToGramme($value)
        $return["uvc_net"] = mysql_result($result, 0, "Poids_ELEM") * 1000;

        $htmlPoidsNetUVC = new HtmlInputText();

        $htmlPoidsNetUVC->setLabel(DatabaseDescription::getFieldDocLabel("fta", "poids_net_uvc_fta"));
        $htmlPoidsNetUVC->getAttributes()->getName()->setValue("Poids_Net_UVC");
        $htmlPoidsNetUVC->getAttributes()->getValue()->setValue($return["uvc_net"]);
        $htmlPoidsNetUVC->setIsEditable(FALSE);

        return $htmlPoidsNetUVC->getHtmlResult();
    }

   function getHtmlPoidsBrutEmballageUVC() {
        //Calcul du Poid Net Emballage (g)        
        $req = "SELECT * FROM fta";
        $result = DatabaseOperation::query($req);

        //Remplacer par getHtmlValueToGramme($value)
        $return["uvc_net"] = mysql_result($result, 0, "Poids_ELEM") * 1000;


        $req = "SELECT  * FROM " . FtaConditionnementModel::TABLENAME . "," . AnnexeEmballageGroupeModel::TABLENAME . "," . AnnexeEmballageGroupeType::TABLENAME . " "
                . "WHERE " . FtaConditionnementModel::FIELDNAME_ID_FTA . "="
                . FtaModel::KEYNAME . " "
                . "AND " . AnnexeEmballageGroupeType::KEYNAME . "=" . $paramgroupetype . " "
                . "AND " . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . "=" . AnnexeEmballageGroupeModel::KEYNAME . " "
                . "AND ( "
                . "( " . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . " IS NOT NULL AND " . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . "=" . AnnexeEmballageGroupeType::KEYNAME . ")"
                . " OR "
                . "( " . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . " IS NULL AND " . AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION . "=" . AnnexeEmballageGroupeType::KEYNAME . ")"
                . "    ) "
                . " ORDER BY " . AnnexeEmballageGroupeType::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE
        ;



        $result = DatabaseOperation::query($req);
        if (mysql_num_rows($result)) {
            while ($rows = mysql_fetch_array($result)) {
                //Calcul du poids
                $return[FtaModel::UVC_EMBALLAGE] = $rows[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT] * $rows[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT] * $rows[FtaConditionnement::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT];

                //Calcul des dimension (on recherche la taille la plus grande
                if ($return[FtaModel::UVC_EMBALLAGE_DIMENSION_HAUTEUR] < $rows[FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT]) {
                    $return[FtaModel::UVC_EMBALLAGE_DIMENSION_HAUTEUR] = $rows[FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT];
                }
                if ($return[FtaModel::UVC_EMBALLAGE_DIMENSION_LONGEUR] < $rows[FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT]) {
                    $return[FtaModel::UVC_EMBALLAGE_DIMENSION_LONGEUR] = $rows[FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT];
                }
                if ($return[FtaModel::UVC_EMBALLAGE_DIMENSION_LARGEUR] < $rows[FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT]) {
                    $return[FtaModel::UVC_EMBALLAGE_DIMENSION_LARGEUR] = $rows[FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT];
                }
            }
        }

        $return[FtaModel::UVC_EMBALLAGE_BRUT] = $return[FtaModel::UVC_EMBALLAGE_NET] + $return[FtaModel::UVC_EMBALLAGE];
        $htmlPoidsBrutUVC = new HtmlInputText();

        $htmlPoidsBrutUVC->setLabel(DatabaseDescription::getFieldDocLabel("fta", "poids_brut_uvc_fta"));
        $htmlPoidsBrutUVC->getAttributes()->getName()->setValue("Poids_Brut_UVC");
        $htmlPoidsBrutUVC->getAttributes()->getValue()->setValue($return["uvc_brut"]);
        $htmlPoidsBrutUVC->setIsEditable(FALSE);

        return $htmlPoidsBrutUVC->getHtmlResult();
    }

    function getHtmlDimensionEmballageUVC() {

        $req = "SELECT  * FROM " . FtaConditionnement::TABLENAME . "," . AnnexeEmballageGroupeModel::TABLENAME . "," . AnnexeEmballageGroupeType::TABLENAME . " "
                . "WHERE " . FtaConditionnement::FIELDNAME_ID_FTA . "="
                . FtaModel::KEYNAME . " "
                . "AND " . AnnexeEmballageGroupeType::KEYNAME . "=" . $paramgroupetype . " "
                . "AND " . FtaConditionnement::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . "=" . AnnexeEmballageGroupeModel::KEYNAME . " "
                . "AND ( "
                . "( " . FtaConditionnement::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . " IS NOT NULL AND " . FtaConditionnement::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . "=" . AnnexeEmballageGroupeType::KEYNAME . ")"
                . " OR "
                . "( " . FtaConditionnement::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . " IS NULL AND " . AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION . "=" . AnnexeEmballageGroupeType::KEYNAME . ")"
                . "    ) "
                . " ORDER BY " . AnnexeEmballageGroupeType::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE
        ;



        $result = DatabaseOperation::query($req);
        if (mysql_num_rows($result)) {
            while ($rows = mysql_fetch_array($result)) {
                //Calcul du poids
                $return[FtaModel::UVC_EMBALLAGE] = $rows[FtaConditionnement::FIELDNAME_POIDS_FTA_CONDITIONNEMENT] * $rows[FtaConditionnement::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT] * $rows[FtaConditionnement::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT];

                //Calcul des dimension (on recherche la taille la plus grande
                if ($return[FtaModel::UVC_EMBALLAGE_DIMENSION_HAUTEUR] < $rows[FtaConditionnement::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT]) {
                    $return[FtaModel::UVC_EMBALLAGE_DIMENSION_HAUTEUR] = $rows[FtaConditionnement::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT];
                }
                if ($return[FtaModel::UVC_EMBALLAGE_DIMENSION_LONGEUR] < $rows[FtaConditionnement::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT]) {
                    $return[FtaModel::UVC_EMBALLAGE_DIMENSION_LONGEUR] = $rows[FtaConditionnement::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT];
                }
                if ($return[FtaModel::UVC_EMBALLAGE_DIMENSION_LARGEUR] < $rows[FtaConditionnement::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT]) {
                    $return[FtaModel::UVC_EMBALLAGE_DIMENSION_LARGEUR] = $rows[FtaConditionnement::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT];
                }
            }
        }
        $return[FtaModel::UVC_EMBALLAGE_DIMENSION] = $return[FtaModel::UVC_EMBALLAGE_DIMENSION_LONGEUR] . "x" . $return[FtaModel::UVC_EMBALLAGE_DIMENSION_LARGEUR];

        //Si la hauteur n'est pas nulle, on l'intègre.
        if ($return[FtaModel::UVC_EMBALLAGE_DIMENSION_HAUTEUR]) {
            $return[FtaModel::UVC_EMBALLAGE_DIMENSION] = $return[FtaModel::UVC_EMBALLAGE_DIMENSION] . "x" . $return[FtaModel::UVC_EMBALLAGE_DIMENSION_HAUTEUR];
        }

        $htmlDimensionUVC = new HtmlInputText();

        $htmlDimensionUVC->setLabel("Dimension de l'UVC (en mm): (Longueur x Largeur x Hauteur)");
        $htmlDimensionUVC->getAttributes()->getName()->setValue("Dimension_UVC");
        $htmlDimensionUVC->getAttributes()->getValue()->setValue($return["dimension_uvc"]);
        $htmlDimensionUVC->setIsEditable(FALSE);


        return $htmlDimensionUVC->getHtmlResult();
    }

    function getHtmlNombreColisUVC() {

        //Calcul du PCB
        $req = "SELECT * FROM fta";
        $result = DatabaseOperation::query($req);
        $return["pcb"] = mysql_result($result, 0, "NB_UNIT_ELEM");

        $htmlNombreColisUVC = new HtmlInputText();

        $htmlNombreColisUVC->setLabel(DatabaseDescription::getFieldDocLabel("fta", "NB_UNIT_ELEM"));
        $htmlNombreColisUVC->getAttributes()->getName()->setValue("Nombre_UVC_par_colis");
        $htmlNombreColisUVC->getAttributes()->getValue()->setValue($return["pcb"]);
        $htmlNombreColisUVC->setIsEditable(FALSE);

        return $htmlNombreColisUVC->getHtmlResult();
    }

    function getHtmlPoidsColisUVC() {

        //Calcul du PCB
        $req = "SELECT * FROM fta";
        $result = DatabaseOperation::query($req);
        $return["pcb"] = mysql_result($result, 0, "NB_UNIT_ELEM");

        //Calcul du poids de Emballages par Colis
        $req = "SELECT  * 
                    FROM fta_conditionnement, annexe_emballage_groupe, annexe_emballage_groupe_type 
                    WHERE id_fta="
                . FtaModel::KEYNAME . " "
                . "AND annexe_emballage_groupe_type.id_annexe_emballage_groupe_type=" . 2 . " "
                . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
                . "AND ( "
                . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NOT NULL AND fta_conditionnement.id_annexe_emballage_groupe_type=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
                . " OR "
                . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NULL AND annexe_emballage_groupe.id_annexe_emballage_groupe_configuration=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
                . "    ) "
                . "ORDER BY nom_annexe_emballage_groupe_type "
        ;

        $result = DatabaseOperation::query($req);
        if (mysql_num_rows($result)) {
            while ($rows = mysql_fetch_array($result)) {
                //Calcul du poids

                $return["colis_emballage"] = $rows["poids_fta_conditionnement"] * $rows["quantite_par_couche_fta_conditionnement"] * $rows["nombre_couche_fta_conditionnement"];
            }
        }

        $return["colis_emballage"] = $return["colis_emballage"] * $return["pcb"];


        $htmlPoidColisUVC = new HtmlInputText();

        $htmlPoidColisUVC->setLabel(DatabaseDescription::getFieldDocLabel("fta", "poids_emballages_uvc_fta"));
        $htmlPoidColisUVC->getAttributes()->getName()->setValue("Poids_UVC_par_colis");
        $htmlPoidColisUVC->getAttributes()->getValue()->setValue($return["colis_emballage"]);
        $htmlPoidColisUVC->setIsEditable(FALSE);

        return $htmlPoidColisUVC->getHtmlResult();
    }

    function getHtmlPoidsNetColisUVC() {

        //Calcul du poids net du colis en Kg
        $req = "SELECT * FROM fta_composant WHERE id_fta='" . FtaModel::KEYNAME . "' AND is_composition_fta_composant=1 ";
        $result = DatabaseOperation::query($req);

        //Remplacer par getHtmlValueToGramme($value)
        while ($rows = mysql_fetch_array($result)) {
            $return["colis_net"] = $return["colis_net"] + ($rows["quantite_fta_composition"] * $rows["poids_fta_composition"]);
        }
        $return["colis_net"] = $return["colis_net"] / 1000; //Conversion en g --> Kg
        if (!$return["colis_net"]) {
            $req = "SELECT * FROM fta ";
            $result = mysql_query($req);
            $return["colis_net"] = mysql_result($result, 0, "Poids_ELEM") * mysql_result($result, 0, "NB_UNIT_ELEM");
        }


        $htmlPoidsNetColisUVC = new HtmlInputText();

        $htmlPoidsNetColisUVC->setLabel(DatabaseDescription::getFieldDocLabel("fta", "Poids_ELEM"));
        $htmlPoidsNetColisUVC->getAttributes()->getName()->setValue("Poids_Net_UVC");
        $htmlPoidsNetColisUVC->getAttributes()->getValue()->setValue($return["colis_net"]);
        $htmlPoidsNetColisUVC->setIsEditable(FALSE);

        return $htmlPoidsNetColisUVC->getHtmlResult();
    }

    function getHtmlPoidsBrutColisUVC() {

        //Calcul du PCB
        $req = "SELECT * FROM fta";
        $result = DatabaseOperation::query($req);
        $return["pcb"] = mysql_result($result, 0, "NB_UNIT_ELEM");

        //Calcul du poids de Emballages par Colis
        $req = "SELECT  * 
                    FROM fta_conditionnement, annexe_emballage_groupe, annexe_emballage_groupe_type 
                    WHERE id_fta="
                . FtaModel::KEYNAME . " "
                . "AND annexe_emballage_groupe_type.id_annexe_emballage_groupe_type=" . 3 . " "
                . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
                . "AND ( "
                . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NOT NULL AND fta_conditionnement.id_annexe_emballage_groupe_type=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
                . " OR "
                . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NULL AND annexe_emballage_groupe.id_annexe_emballage_groupe_configuration=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
                . "    ) "
                . "ORDER BY nom_annexe_emballage_groupe_type "
        ;

        $result = DatabaseOperation::query($req);
        if (mysql_num_rows($result)) {
            while ($rows = mysql_fetch_array($result)) {
                //Calcul du poids d'emballage par colis
                $return[FtaModel::COLIS_EMBALLAGE] = $rows[FtaConditionnement::FIELDNAME_POIDS_FTA_CONDITIONNEMENT] * $rows[FtaConditionnement::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT] * $rows[FtaConditionnement::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT];
            }
        }

        $return[FtaModel::COLIS_EMBALLAGE] = $return[FtaModel::COLIS_EMBALLAGE] * $return[FtaModel::FIELDNAME_PCB];

        //Calcul du poids net du colis en Kg
        $req = "SELECT * FROM fta_composant WHERE id_fta='" . FtaModel::KEYNAME . "' AND is_composition_fta_composant=1 ";
        $result = DatabaseOperation::query($req);

        //Remplacer par getHtmlValueToGramme($value)
        while ($rows = mysql_fetch_array($result)) {
            $return["colis_net"] = $return["colis_net"] + ($rows["quantite_fta_composition"] * $rows["poids_fta_composition"]);
        }
        $return["colis_net"] = $return["colis_net"] / 1000; //Conversion en g --> Kg
        if (!$return["colis_net"]) {
            $req = "SELECT * FROM fta ";
            $result = mysql_query($req);
            $return["colis_net"] = mysql_result($result, 0, "Poids_ELEM") * mysql_result($result, 0, "NB_UNIT_ELEM");
        }

        //Calcul du poids brut du Colis en Kg
        $return["colis_brut"] = $return["colis_net"] + ($return["colis_emballage"] / 1000);

        $htmlPoidsBrutColisUVC = new HtmlInputText();

        $htmlPoidsBrutColisUVC->setLabel(DatabaseDescription::getFieldDocLabel("fta", "poids_brut_uvc_fta"));
        $htmlPoidsBrutColisUVC->getAttributes()->getName()->setValue("Poids_Brut_UVC");
        $htmlPoidsBrutColisUVC->getAttributes()->getValue()->setValue($return["colis_brut"]);
        $htmlPoidsBrutColisUVC->setIsEditable(FALSE);

        return $htmlPoidsBrutColisUVC->getHtmlResult();
    }

    function getHtmlHauteurColisUVC() {

        //Calcul de la hauteur en mm du Colis
        $req = "SELECT * FROM fta_conditionnement WHERE id_fta=" . FtaModel::KEYNAME;
        $result = DatabaseOperation::query($req);
        $return["hauteur_colis"] = mysql_result($result, 0, "hauteur_fta_conditionnement");


        $htmlHauteurColisUVC = new HtmlInputText();

        $htmlHauteurColisUVC->setLabel(DatabaseDescription::getFieldDocLabel("fta_conditionnement", "hauteur_fta_conditionnement"));
        $htmlHauteurColisUVC->getAttributes()->getName()->setValue("Hauteur_UVC");
        $htmlHauteurColisUVC->getAttributes()->getValue()->setValue($return["hauteur_colis"]);
        $htmlHauteurColisUVC->setIsEditable(FALSE);

        return $htmlHauteurColisUVC->getHtmlResult();
    }

    function getHtmlPoidsNetPaletteUVC() {

        //Calcul du poids de Emballages par Palette

        $req = "SELECT  * 
                    FROM fta_conditionnement, annexe_emballage_groupe, annexe_emballage_groupe_type 
                    WHERE id_fta="
                . FtaModel::KEYNAME . " "
                . "AND annexe_emballage_groupe_type.id_annexe_emballage_groupe_type=" . 4 . " "
                . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
                . "AND ( "
                . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NOT NULL AND fta_conditionnement.id_annexe_emballage_groupe_type=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
                . " OR "
                . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NULL AND annexe_emballage_groupe.id_annexe_emballage_groupe_configuration=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
                . "    ) "
                . "ORDER BY nom_annexe_emballage_groupe_type "
        ;

        $result = DatabaseOperation::query($req);
        if (mysql_num_rows($result)) {
            while ($rows = mysql_fetch_array($result)) {
                //Calcul du poids de l'emballage par palette
                $return[FtaModel::PALETTE_NOMBRE_DE_COUCHE] = $rows[FtaConditionnement::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT];
                $return[FtaModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE] = $rows[FtaConditionnement::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT];
                $return[FtaModel::PALETTE_EMBALLAGE] = ($rows[FtaConditionnement::FIELDNAME_POIDS_FTA_CONDITIONNEMENT] / 1000) * $return[FtaModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE] * $return[FtaModel::PALETTE_NOMBRE_DE_COUCHE];
                $return[FtaModel::PALETTE_EMBALLAGE_HAUTEUR] = (($rows[FtaConditionnement::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT] * $return[FtaModel::PALETTE_NOMBRE_DE_COUCHE]) + $rows[FtaConditionnement::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT]) / 1000;
            }
        }

        $return[FtaModel::PALETTE_EMBALLAGE] = $return[FtaModel::PALETTE_EMBALLAGE] * ($rows[FtaConditionnement::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT] * $rows[FtaConditionnement::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT]);



        //Calcul Poids Net (en Kg) d'une Palette:
        $return["palette_net"] = $return["colis_net"] * ($rows["quantite_par_couche_fta_conditionnement"] * $rows["nombre_couche_fta_conditionnement"]);

        $htmlPoidsNetPalettisationUVC = new HtmlInputText();

        $htmlPoidsNetPalettisationUVC->setLabel(DatabaseDescription::getFieldDocLabel("fta", "Poids_ELEM"));
        $htmlPoidsNetPalettisationUVC->getAttributes()->getName()->setValue("Poids_Net_Palette");
        $htmlPoidsNetPalettisationUVC->getAttributes()->getValue()->setValue($return["palette_net"]);
        $htmlPoidsNetPalettisationUVC->setIsEditable(FALSE);

        return $htmlPoidsNetPalettisationUVC->getHtmlResult();
    }

    function getHtmlPoidsBrutPaletteUVC() {

        //Calcul du poids de Emballages par Palette

        $req = "SELECT  * 
                    FROM fta_conditionnement, annexe_emballage_groupe, annexe_emballage_groupe_type 
                    WHERE id_fta="
                . FtaModel::KEYNAME . " "
                . "AND annexe_emballage_groupe_type.id_annexe_emballage_groupe_type=" . 4 . " "
                . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
                . "AND ( "
                . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NOT NULL AND fta_conditionnement.id_annexe_emballage_groupe_type=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
                . " OR "
                . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NULL AND annexe_emballage_groupe.id_annexe_emballage_groupe_configuration=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
                . "    ) "
                . "ORDER BY nom_annexe_emballage_groupe_type "
        ;

        $result = DatabaseOperation::query($req);
        if (mysql_num_rows($result)) {
            while ($rows = mysql_fetch_array($result)) {
                //Calcul du poids
                $return["couche_palette"] = $rows["nombre_couche_fta_conditionnement"];
                $return["colis_couche"] = $rows["quantite_par_couche_fta_conditionnement"];
                $return["palette_emballage"] = ($rows["poids_fta_conditionnement"] / 1000) * $return["colis_couche"] * $return["couche_palette"];
                $return["hauteur_palette"] = (($rows["hauteur_fta_conditionnement"] * $return["couche_palette"]) + $rows["hauteur_fta_conditionnement"]) / 1000;
            }
        }

        $return["palette_emballage"] = $return["palette_emballage"] * ($rows["quantite_par_couche_fta_conditionnement"] * $rows["nombre_couche_fta_conditionnement"]);

        //Calcul Poids Net (en Kg) d'une Palette:
        $return["palette_net"] = $return["colis_net"] * ($rows["quantite_par_couche_fta_conditionnement"] * $rows["nombre_couche_fta_conditionnement"]);

        //Calcul Poids Brut (en Kg) d'une Palette:
        $return[FtaModel::PALETTE_EMBALLAGE_BRUT] = $return[FtaModel::PALETTE_EMBALLAGE_NET] + $return[FtaModel::PALETTE_EMBALLAGE];

        $htmlPoidsBrutPalettisationUVC = new HtmlInputText();

        $htmlPoidsBrutPalettisationUVC->setLabel(DatabaseDescription::getFieldDocLabel("fta", "poids_brut_uvc_fta"));
        $htmlPoidsBrutPalettisationUVC->getAttributes()->getName()->setValue("Poids_Brut_Palette");
        $htmlPoidsBrutPalettisationUVC->getAttributes()->getValue()->setValue($return["palette_brut"]);
        $htmlPoidsBrutPalettisationUVC->setIsEditable(FALSE);

        return $htmlPoidsBrutPalettisationUVC->getHtmlResult();
    }

    function getHtmlHauteurPaletteUVC() {

        //Calcul du poids de Emballages par Palette

        $req = "SELECT  * 
                    FROM fta_conditionnement, annexe_emballage_groupe, annexe_emballage_groupe_type 
                    WHERE id_fta="
                . FtaModel::KEYNAME . " "
                . "AND annexe_emballage_groupe_type.id_annexe_emballage_groupe_type=" . 4 . " "
                . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
                . "AND ( "
                . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NOT NULL AND fta_conditionnement.id_annexe_emballage_groupe_type=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
                . " OR "
                . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NULL AND annexe_emballage_groupe.id_annexe_emballage_groupe_configuration=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
                . "    ) "
                . "ORDER BY nom_annexe_emballage_groupe_type "
        ;

        $result = DatabaseOperation::query($req);
        if (mysql_num_rows($result)) {
            while ($rows = mysql_fetch_array($result)) {
                //Calcul du poids
                $return["couche_palette"] = $rows["nombre_couche_fta_conditionnement"];
                $return["colis_couche"] = $rows["quantite_par_couche_fta_conditionnement"];
                $return["palette_emballage"] = ($rows["poids_fta_conditionnement"] / 1000) * $return["colis_couche"] * $return["couche_palette"];
                $return["hauteur_palette"] = (($rows["hauteur_fta_conditionnement"] * $return["couche_palette"]) + $rows["hauteur_fta_conditionnement"]) / 1000;
            }
        }

        $htmlHauteurPalettisationUVC = new HtmlInputText();

        $htmlHauteurPalettisationUVC->setLabel(DatabaseDescription::getFieldDocLabel("fta_conditionnement", "hauteur_fta_conditionnement"));
        $htmlHauteurPalettisationUVC->getAttributes()->getName()->setValue("Hauteur_Palette");
        $htmlHauteurPalettisationUVC->getAttributes()->getValue()->setValue($return["hauteur_palette"]);
        $htmlHauteurPalettisationUVC->setIsEditable(FALSE);

        return $htmlHauteurPalettisationUVC->getHtmlResult();
    }

    function getHtmlNombrePaletteUVC() {

        //Calcul du poids de Emballages par Palette

        $req = "SELECT  * 
                    FROM fta_conditionnement, annexe_emballage_groupe, annexe_emballage_groupe_type 
                    WHERE id_fta="
                . FtaModel::KEYNAME . " "
                . "AND annexe_emballage_groupe_type.id_annexe_emballage_groupe_type=" . 4 . " "
                . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
                . "AND ( "
                . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NOT NULL AND fta_conditionnement.id_annexe_emballage_groupe_type=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
                . " OR "
                . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NULL AND annexe_emballage_groupe.id_annexe_emballage_groupe_configuration=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
                . "    ) "
                . "ORDER BY nom_annexe_emballage_groupe_type "
        ;

        $result = DatabaseOperation::query($req);
        if (mysql_num_rows($result)) {
            while ($rows = mysql_fetch_array($result)) {
                //Calcul du poids
                $return["couche_palette"] = $rows["nombre_couche_fta_conditionnement"];
                $return["colis_couche"] = $rows["quantite_par_couche_fta_conditionnement"];
                $return["palette_emballage"] = ($rows["poids_fta_conditionnement"] / 1000) * $return["colis_couche"] * $return["couche_palette"];
                $return["hauteur_palette"] = (($rows["hauteur_fta_conditionnement"] * $return["couche_palette"]) + $rows["hauteur_fta_conditionnement"]) / 1000;
            }
        }

        $htmlCouchePalettisationUVC = new HtmlInputText();

        $htmlCouchePalettisationUVC->setLabel(DatabaseDescription::getFieldDocLabel("fta_conditionnement", "nombre_couche_fta_conditionnement"));
        $htmlCouchePalettisationUVC->getAttributes()->getName()->setValue("Hauteur_Palette");
        $htmlCouchePalettisationUVC->getAttributes()->getValue()->setValue($return["couche_palette"]);
        $htmlCouchePalettisationUVC->setIsEditable(FALSE);

        return $htmlCouchePalettisationUVC->getHtmlResult();
    }

    function getHtmlColisCouchePaletteUVC() {

        //Calcul du poids de Emballages par Palette

        $req = "SELECT  * 
                    FROM fta_conditionnement, annexe_emballage_groupe, annexe_emballage_groupe_type 
                    WHERE id_fta="
                . FtaModel::KEYNAME . " "
                . "AND annexe_emballage_groupe_type.id_annexe_emballage_groupe_type=" . 4 . " "
                . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
                . "AND ( "
                . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NOT NULL AND fta_conditionnement.id_annexe_emballage_groupe_type=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
                . " OR "
                . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NULL AND annexe_emballage_groupe.id_annexe_emballage_groupe_configuration=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
                . "    ) "
                . "ORDER BY nom_annexe_emballage_groupe_type "
        ;

        $result = DatabaseOperation::query($req);
        if (mysql_num_rows($result)) {
            while ($rows = mysql_fetch_array($result)) {
                //Calcul du poids
                $return["couche_palette"] = $rows["nombre_couche_fta_conditionnement"];
                $return["colis_couche"] = $rows["quantite_par_couche_fta_conditionnement"];
                $return["palette_emballage"] = ($rows["poids_fta_conditionnement"] / 1000) * $return["colis_couche"] * $return["couche_palette"];
                $return["hauteur_palette"] = (($rows["hauteur_fta_conditionnement"] * $return["couche_palette"]) + $rows["hauteur_fta_conditionnement"]) / 1000;
            }
        }
        $htmlColisCouchePalettisationUVC = new HtmlInputText();

        $htmlColisCouchePalettisationUVC->setLabel(DatabaseDescription::getFieldDocLabel("fta_conditionnement", "quantite_par_couche_fta_conditionnement"));
        $htmlColisCouchePalettisationUVC->getAttributes()->getName()->setValue("Quantite_Palette");
        $htmlColisCouchePalettisationUVC->getAttributes()->getValue()->setValue($return["colis_couche"]);
        $htmlColisCouchePalettisationUVC->setIsEditable(FALSE);

        return $htmlColisCouchePalettisationUVC->getHtmlResult();
    }

    function getHtmlColisTotalUVC() {

        //Calcul du poids de Emballages par Palette

        $req = "SELECT  * 
                    FROM fta_conditionnement, annexe_emballage_groupe, annexe_emballage_groupe_type 
                    WHERE id_fta="
                . FtaModel::KEYNAME . " "
                . "AND annexe_emballage_groupe_type.id_annexe_emballage_groupe_type=" . 4 . " "
                . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
                . "AND ( "
                . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NOT NULL AND fta_conditionnement.id_annexe_emballage_groupe_type=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
                . " OR "
                . "( fta_conditionnement.id_annexe_emballage_groupe_type IS NULL AND annexe_emballage_groupe.id_annexe_emballage_groupe_configuration=annexe_emballage_groupe_type.id_annexe_emballage_groupe_type )"
                . "    ) "
                . "ORDER BY nom_annexe_emballage_groupe_type "
        ;

        $result = DatabaseOperation::query($req);
        if (mysql_num_rows($result)) {
            while ($rows = mysql_fetch_array($result)) {
                //Calcul du poids
                $return["couche_palette"] = $rows["nombre_couche_fta_conditionnement"];
                $return["colis_couche"] = $rows["quantite_par_couche_fta_conditionnement"];
                $return["palette_emballage"] = ($rows["poids_fta_conditionnement"] / 1000) * $return["colis_couche"] * $return["couche_palette"];
                $return["hauteur_palette"] = (($rows["hauteur_fta_conditionnement"] * $return["couche_palette"]) + $rows["hauteur_fta_conditionnement"]) / 1000;
            }
        }

        //Calcul du nombre total de Carton par palette:
        $return[FtaModel::PALETTE_NOMBRE_TOTAL_PAR_CARTON] = $return[FtaModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE] * $return[FtaModel::PALETTE_NOMBRE_DE_COUCHE];

        $htmlTotalColisPalettisationUVC = new HtmlInputText();

        $htmlTotalColisPalettisationUVC->setLabel("Nombre total de Carton par palette");
        $htmlTotalColisPalettisationUVC->getAttributes()->getName()->setValue("total_Palette");
        $htmlTotalColisPalettisationUVC->getAttributes()->getValue()->setValue($return["total_colis"]);
        $htmlTotalColisPalettisationUVC->setIsEditable(FALSE);

        return $htmlTotalColisPalettisationUVC->getHtmlResult();
    }

}

?>
