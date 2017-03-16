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
class FtaView extends AbstractView {

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
     * du champs verrouillage_libelle_etiquette_fta
     */
    const JAVASCRIPT_CALLBACK_VERROUILLAGE_ETIQ = "displayVerrouEtiq";

    /**
     * Fonction JavaScript appelée pour actualiser l'édition
     * du champs Duree_de_vie
     */
    const JAVASCRIPT_CALLBACK_DUREE_DE_VIE = "disabledDureeDeVie";
    const CALLBACK_LINK_TO_FTA_VALUE = "Retour vers la Fta";
    const LINK_TO_FTA_XML_FILE = "Envoie de données vers Arcadia";
    const LINK_TO_FTA_XML_FILE_AGAIN = "Réenvoyer les données vers Arcadia";
    const LINK_TO_FTA_XML_FILE_CANCEL = "Annuler la transaction en cours vers Arcadia";

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

        /**
         * On vérifie si le champ est verrouillable
         */
        $dataField->checkLockField($this->getModel(), $this->getIsEditable());

        /**
         * On autorise la modification selon l'état de champs verrouillable
         */
        $isEditable = $this->isEditableLockField($dataField->getIsFieldLock());
        /**
         * On vérifie les Règles de validation du champ
         */
        $dataField->checkValidationRules();

        if ($dataField->getDataValidationSuccessful() == TRUE) {
            $this->setDataValidationSuccessfulToTrue();
        } else {
            $this->setDataValidationSuccessfulToFalse();
        }

        return Html::convertDataFieldToHtml(
                        $dataField
                        , $isEditable
        );
    }

    /**
     * On autorise la modification selon l'état de champs verrouillable
     * @param $paramIsLockValue
     * @return boolean
     */
    function isEditableLockField($paramIsLockValue) {
        $isEditable = $this->getIsEditable();
        switch ($paramIsLockValue) {
            case FtaVerrouillageChampsModel::FIELD_LOCK_PRIMARY_FALSE:
            case FtaVerrouillageChampsModel::FIELD_LOCK_SECONDARY_FALSE:
            case FtaVerrouillageChampsModel::FIELD_LOCK_PRIMARY_TRUE:


                break;
            case FtaVerrouillageChampsModel::FIELD_LOCK_SECONDARY_TRUE:

                $isEditable = FALSE;

                break;
        }
        return $isEditable;
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
     * Bouton affichant le lien générant le fichier xml
     */
    function generateXmlFile() {
        return '<td class="contenu"><center>'
                . '<a href=generate_xml.php?'
                . 'id_fta=' . $this->getModel()->getKeyValue()
                . '>' . self::LINK_TO_FTA_XML_FILE . '</a></center></td>';
    }

    /**
     * Stade 1 
     * On affiche l'option de préchargement des données vers arcadia 
     * @return string
     */
    function getHtmlLinkGenerateXmlFile() {
        $lienFta2Arcadia = null;
        /**
         * Par défaut on ne peut pas valider le chapitre
         */
        $this->setDataValidationSuccessfulToTrue();
        if ($this->getIsEditable()) {

            /**
             * On vérifie si le fichier à déja été envoyé
             */
            $keyValue = Fta2ArcadiaTransactionModel::checkIdArcadiaTransaction($this->getModel()->getKeyValue());
            if ($keyValue) {
                $checkArcadiaData = "ok";
                $Fta2ArcadiaTransactionModel = new Fta2ArcadiaTransactionModel($keyValue);
                $isEditable = $Fta2ArcadiaTransactionModel->isEditableNotificationMail();
                $codeReply = $Fta2ArcadiaTransactionModel->getDataField(Fta2ArcadiaTransactionModel::FIELDNAME_CODE_REPLY)->getFieldValue();
                /**
                 * On peut valider le chapitre si la transaction en cours est actif,
                 * tant que le fichier de retour n'a pas été récupéré NULL
                 * et que le fichier de retour ne soit pas en Erreur (1,2,3,4)
                 */
                if ($codeReply <> Fta2ArcadiaTransactionModel::CONSOMME) {
                    $this->setDataValidationSuccessfulToFalse();
                }
                $message = $this->getMessageArcadiaInfo($codeReply, $keyValue);
                $Fta2ArcadiaTransactionModel->setIsEditable($isEditable);
                $notificationMail = $Fta2ArcadiaTransactionModel->getHtmlDataField(Fta2ArcadiaTransactionModel::FIELDNAME_NOTIFICATION_MAIL);
            }

            if (!$checkArcadiaData) {
                $lienFta2Arcadia = $this->generateXmlFile();
                /**
                 * On peut valider le chapitre si il n'y a pas de transaction
                 */
            } else {
                $lienFta2Arcadia = $this->getMessageSendDataToArcadia($Fta2ArcadiaTransactionModel);
            }
        }
        return $lienFta2Arcadia . $message . $notificationMail;
    }

    /**
     * Affiche une message de confirmation que les données ont bien été envoyé
     * @param Fta2ArcadiaTransactionModel $paramFta2ArcadiaTransactionModel
     * @return string
     */
    function getMessageSendDataToArcadia(Fta2ArcadiaTransactionModel $paramFta2ArcadiaTransactionModel) {
        /**
         * Utilisateur ayant envoyer la donnée
         */
        $idUser = $paramFta2ArcadiaTransactionModel->getDataField(Fta2ArcadiaTransactionModel::FIELDNAME_ID_USER)->getFieldValue();
        $userModel = new UserModel($idUser);
        $prenomNom = $userModel->getPrenomNom();
        /**
         * Date d'envoie du fichier
         */
        $dateEnvoitmp = $paramFta2ArcadiaTransactionModel->getDataField(Fta2ArcadiaTransactionModel::FIELDNAME_DATE_ENVOI)->getFieldValue();
        $dateEnvoi = FtaController::changementDuFormatDeDateFR($dateEnvoitmp);
        $message = '<td class="contenu"><center>' . UserInterfaceMessage::FR_ARCADIA_SEND_DATA_MESSAGE
                . ' par ' . $prenomNom
                . ' le ' . $dateEnvoi
                . ' </center></td>' . $this->getMessageSendDataToArcadiaAgainAndCancel();
        return $message;
    }

    /**
     * Lien de renvoi du fichier XML et de désactivation
     * @return string
     */
    function getMessageSendDataToArcadiaAgainAndCancel() {
        return '<td class="contenu"><center>'
                . '<a href=#'
                . ' onclick=confirmationNouvelleEnvoiArcadia(' . $this->getModel()->getKeyValue()
                . ') >' . self::LINK_TO_FTA_XML_FILE_AGAIN . '</a>'
                . '  --  <a href=generate_xml.php?'
                . 'id_fta=' . $this->getModel()->getKeyValue()
                . '&desactivation=' . Fta2ArcadiaTransactionModel::OUI
                . '>' . self::LINK_TO_FTA_XML_FILE_CANCEL . '</a>'
                . '</center></td>';
    }

    /**
     * Retourne le message sur le traitement d'envoie et de récupération entre Arcadia et Fta
     * @param string $paramCodeReply
     * @return string
     */
    function getMessageArcadiaInfo($paramCodeReply, $paramIdTransaction) {
        $start = "<tr><td class=contenu><center>Informations Arcadia</center></td>";
        switch ($paramCodeReply) {
            case Fta2ArcadiaTransactionModel::CONSOMME:
                $message = $start . "<td " . TableauFicheView::HTML_CELL_BGCOLOR_ARCADIA_OK . " ><center>" . UserInterfaceMessage::FR_ARCADIA_CONSOMME_DATA_MESSAGE . " (" . $paramIdTransaction . ") " . "</center></td></tr>";

                break;
            case Fta2ArcadiaTransactionModel::REJET_TASKS:
                $message = $start . "<td " . TableauFicheView::HTML_CELL_BGCOLOR_ARCADIA_ERREUR . " ><center>" . UserInterfaceMessage::FR_ARCADIA_REJET_TASKS_DATA_MESSAGE . " (" . $paramIdTransaction . ") " . "</center></td></tr>";

                break;
            case Fta2ArcadiaTransactionModel::REFUSE:
                $message = $start . "<td " . TableauFicheView::HTML_CELL_BGCOLOR_ARCADIA_ERREUR . " ><center>" . UserInterfaceMessage::FR_ARCADIA_REFUSE_DATA_MESSAGE . " (" . $paramIdTransaction . ") " . "</center></td></tr>";

                break;
            case Fta2ArcadiaTransactionModel::CLOTURE_AUTO:
                $message = $start . "<td " . TableauFicheView::HTML_CELL_BGCOLOR_ARCADIA_ERREUR . " ><center>" . UserInterfaceMessage::FR_ARCADIA_CLOTURE_AUTO_DATA_MESSAGE . " (" . $paramIdTransaction . ") " . "</center></td></tr>";
                break;
            default :
                $message = $start . "<td " . TableauFicheView::HTML_CELL_BGCOLOR_ARCADIA_ATTENTE . " ><center>" . UserInterfaceMessage::FR_ARCADIA_PROCESSING_DATA_MESSAGE . " (" . $paramIdTransaction . ") " . "</center></td></tr>";

                break;
        }

        return $message;
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
     * On vérifie si l'emballage du colis qui devrait être unique
     * à une correspondance sur arcadia sinon alors on affiche une message d'avertissement 
     * pour un cas non communiqué
     */
    function checkEmballageColisValide() {
        $return = $this->getModel()->checkEmballageColisValide();

        return $return;
    }

    /**
     * Affichage Html du nom abrégé
     * @return string
     */
    function getHtmlNomAbrege() {
        $nomAbregeValue = $this->getModel()->getDataField(FtaModel::FIELDNAME_NOM_ABREGE)->getFieldValue();
        if (!$nomAbregeValue) {
            $DesignationCommerciale = $this->getModel()->getDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE)->getFieldValue();

            $nomAbregeValue = strtoupper($DesignationCommerciale);

            $this->getModel()->getDataField(FtaModel::FIELDNAME_NOM_ABREGE)->setFieldValue($nomAbregeValue);
            $this->getModel()->saveToDatabase();
            $return = $this->getHtmlDataField(FtaModel::FIELDNAME_NOM_ABREGE);
        } else {
            $return = $this->getHtmlDataField(FtaModel::FIELDNAME_NOM_ABREGE);
        }

        return $return;
    }

    /**
     * Affichage Html de la DIN
     * @return string
     */
    function getHtmlDesignationInterneAgis() {
        $DIN = $this->getModel()->getDataField(FtaModel::FIELDNAME_LIBELLE)->getFieldValue();
        if (!$DIN) {
            $nomAbregeValue = $this->getModel()->getDataField(FtaModel::FIELDNAME_NOM_ABREGE)->getFieldValue();

            $suffixeAgrologicFta = $this->getModel()->getModelClassificationRacourcis()->getNameRaccourcisClassif();
            $NB_UNIT_ELEM = $this->getModel()->getDataField(FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON)->getFieldValue();
            $poidAffichage = $this->getModel()->getDataField(FtaModel::FIELDNAME_POIDS_ELEMENTAIRE)->getFieldValue();
            $valeurUnite = "kg";

            if ($poidAffichage < FtaModel::VALEUR_CHECK_EN_KG) {
                $poidAffichage = $poidAffichage * FtaModel::CONVERSION_KG_EN_G;
                $valeurUnite = "g";
            }

            $DIN = $nomAbregeValue . " " . $suffixeAgrologicFta . " " . $NB_UNIT_ELEM . "X" . $poidAffichage . $valeurUnite;

            $DIN = strtoupper($DIN);
            $this->getModel()->getDataField(FtaModel::FIELDNAME_LIBELLE)->setFieldValue($DIN);
            if (!$this->getModel()->getDataField(FtaModel::FIELDNAME_VERROUILLAGE_LIBELLE_ETIQUETTE)->getFieldValue()) {
                $this->getModel()->getDataField(FtaModel::FIELDNAME_LIBELLE_CLIENT)->setFieldValue($DIN);
            }
            $this->getModel()->saveToDatabase();
            $return = $this->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE);
        } else {
            $return = $this->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE);
            /**
             * Si le chef de projet laisse l'informatique de gestion gérer l'etiquette colis et qu'elle est vide alors on renseigne la DIN
             */
            if (!$this->getModel()->getDataField(FtaModel::FIELDNAME_VERROUILLAGE_LIBELLE_ETIQUETTE)->getFieldValue()) {
                $this->getModel()->getDataField(FtaModel::FIELDNAME_LIBELLE_CLIENT)->setFieldValue($DIN);
                $this->getModel()->saveToDatabase();
            }
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
     * Affichage de la liste déroulante de gestion des etiquette recto
     * @return string
     */
    function getHtmlGestionEtiquetteRecto() {

        $htmlGetionEtiquetteRecto = $this->getModel()->getHtmlGestionEtiquetteRecto();
        return $htmlGetionEtiquetteRecto;
    }

    /**
     * Affichage de la liste déroulante de gestion des etiquette verso
     * @return string
     */
    function getHtmlGestionEtiquetteVerso() {

        $htmlGetionEtiquetteRecto = $this->getModel()->getHtmlGestionEtiquetteVerso();
        return $htmlGetionEtiquetteRecto;
    }

    /**
     * Affichage Html de l'ean article
     * @return string
     */
    function getHtmlEANArticle() {
        $id_fta = $this->getModel()->getKeyValue();
        $eanArticleDataField = $this->getModel()->getDataField(FtaModel::FIELDNAME_EAN_UVC);
        $eanArticleValue = $eanArticleDataField->getFieldValue();

        /**
         * On vérifie si le champ est verrouillable
         */
        $eanArticleDataField->checkLockField($this->getModel(), $this->getIsEditable());

        /**
         * On autorise la modification selon l'état de champs verrouillable
         */
        $isEditable = $this->isEditableLockField($eanArticleDataField->getIsFieldLock());


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
        $eanArticle->setIsEditable($isEditable);
        $eanArticle->initAbstractHtmlInput(
                $HtmlTableName
                , $eanArticle->getLabel()
                , $eanArticleValue
                , $eanArticleDataField->isFieldDiff()
                , NULL
                , NULL
                , $eanArticleDataField->getIsFieldLock()
                , $eanArticleDataField->getLinkFieldLock()
        );
        $eanArticle->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $id_fta, FtaModel::FIELDNAME_EAN_UVC);

        /**
         * Description d'un champ
         */
        $eanArticle->setHelp(IntranetColumnInfoModel::getFieldDesc($eanArticleDataField->getTableName(), $eanArticleDataField->getFieldName()
                        , $eanArticleDataField->getFieldLabel(), $eanArticle
        ));


        return $eanArticle->getHtmlResult();
    }

    /**
     * Gestionnaire de l'affichage Html du code article arcadia primaire
     * et les codes articles arcadia secondaires
     * @return string
     */
    function getHtmlCodeArticleArcadiaPrimaireSecondaire($paramIsEditable, $paramIdFtaChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbrevationEtat, $paramIdFtaRole) {
        $idFtaSecondary = $this->getModel()->getKeyValue();
        /**
         * On vérifie si le dossier de la Fta encours  est utilisé comme dossier primaire
         */
        $isDossierFtaPrimary = $this->getModel()->isDossierFtaPrimary();

        /**
         * Si oui alors on affiche la liste des Fta secondaires
         */
        if ($isDossierFtaPrimary) {
            $html = $this->getModel()->getLinkToSecondaryFta($paramIdFtaChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaRole);
        } else {
            /**
             * Sinon on vérifie si elle est rattachée à un dossier primaire (donc si il s'agis d'une secondaire)
             */
            $dossierFtaPrimaire = $this->getModel()->getDataField(FtaModel::FIELDNAME_DOSSIER_FTA_PRIMAIRE)->getFieldValue();
            /**
             * Si oui on affiche le lien vers la Fta primaire  
             */
            if ($dossierFtaPrimaire) {
                $idFtaPrimaireValue = $this->getModel()->getIdFtaFromDossierFtaPrimary($dossierFtaPrimaire);
                $ftaModelPrimaire = new FtaModel($idFtaPrimaireValue);
                $html = $ftaModelPrimaire->getLinkToPrimaryFta($paramIdFtaChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbrevationEtat, $paramIdFtaRole, $dossierFtaPrimaire, $idFtaSecondary, $paramIsEditable);
            } elseif ($paramIsEditable) {
                /**
                 * Sinon on propose d'ajouter un lien avec une Fta Primaire
                 */
                $html = $this->getModel()->getLinkToPrimaryFta($paramIdFtaChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbrevationEtat, $paramIdFtaRole, $dossierFtaPrimaire, $idFtaSecondary, $paramIsEditable);
            }
        }
        return $html;
    }

    /**
     * Affichage Html de l'ean colis
     * @return string
     */
    function getHtmlEANColis() {
        $id_fta = $this->getModel()->getKeyValue();
        $dataFieldEanColis = $this->getModel()->getDataField(FtaModel::FIELDNAME_EAN_COLIS);
        $eanColisValue = $dataFieldEanColis->getFieldValue();
        $eanColis = new HtmlInputText();
        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_EAN_COLIS
                . '_'
                . $id_fta
        ;
        /**
         * On initie la vérification des data validation
         */
        $dataFieldEanColis->checkValidationRules();

        if ($dataFieldEanColis->getDataValidationSuccessful()) {
            $this->setDataValidationSuccessfulToTrue();
        } else {
            $this->setDataValidationSuccessfulToFalse();
        }
        $eanColis->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_EAN_COLIS));
        $eanColis->getAttributes()->getValue()->setValue($eanColisValue);
        $eanColis->getAttributes()->getPattern()->setValue("[0-9]{1,14}");
        $eanColis->getAttributes()->getMaxLength()->setValue("14");
        $eanColis->setIsEditable($this->getIsEditable());
        $eanColis->initAbstractHtmlInput(
                $HtmlTableName
                , $eanColis->getLabel()
                , $eanColisValue
                , $dataFieldEanColis->isFieldDiff()
                , $dataFieldEanColis->getDataValidationSuccessful()
                , $dataFieldEanColis->getDataWarningMessage()
        );
        $eanColis->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $id_fta, FtaModel::FIELDNAME_EAN_COLIS);

        /**
         * Description d'un champ
         */
        $eanColis->setHelp(IntranetColumnInfoModel::getFieldDesc($dataFieldEanColis->getTableName(), $dataFieldEanColis->getFieldName()
                        , $dataFieldEanColis->getFieldLabel(), $eanColis
        ));



        return $eanColis->getHtmlResult();
    }

    /**
     * Affichage Html de l'ean palette
     * @return string
     */
    function getHtmlEANPalette() {
        $id_fta = $this->getModel()->getKeyValue();
        $dataFieldEanPalette = $this->getModel()->getDataField(FtaModel::FIELDNAME_EAN_PALETTE);
        $eanPaletteValue = $dataFieldEanPalette->getFieldValue();
        $eanPalette = new HtmlInputText();
        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_EAN_PALETTE
                . '_'
                . $id_fta
        ;

        /**
         * On initie la vérification des data validation
         */
        $dataFieldEanPalette->checkValidationRules();

        if ($dataFieldEanPalette->getDataValidationSuccessful()) {
            $this->setDataValidationSuccessfulToTrue();
        } else {
            $this->setDataValidationSuccessfulToFalse();
        }
        $eanPalette->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_EAN_PALETTE));
        $eanPalette->getAttributes()->getValue()->setValue($eanPaletteValue);
        $eanPalette->getAttributes()->getPattern()->setValue("[0-9]{1,14}");
        $eanPalette->getAttributes()->getMaxLength()->setValue("14");
        $eanPalette->setIsEditable($this->getIsEditable());
        $eanPalette->initAbstractHtmlInput(
                $HtmlTableName
                , $eanPalette->getLabel()
                , $eanPaletteValue
                , $dataFieldEanPalette->isFieldDiff()
                , $dataFieldEanPalette->getDataValidationSuccessful()
                , $dataFieldEanPalette->getDataWarningMessage()
        );
        $eanPalette->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $id_fta, FtaModel::FIELDNAME_EAN_PALETTE);
        /**
         * Description d'un champ
         */
        $eanPalette->setHelp(IntranetColumnInfoModel::getFieldDesc($dataFieldEanPalette->getTableName(), $dataFieldEanPalette->getFieldName()
                        , $dataFieldEanPalette->getFieldLabel(), $eanPalette
        ));

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
     * Affiche les champs "Voulez-vous imposer le libellé étiquette colis ?" et Libellé etiquette carton
     * En fonction du résultat du champs Forcer libellé étiquette colis ? fais apparaitre ou non l'autre champ
     * @return string
     */
    public function getHtmlVerrouillageEtiquetteWithEtiquetteColis() {
        //Initialisation des variables locales
        $htmlReturn = NULL;

        $dataFieldVerrouillageLibelleEtiquette = $this->getModel()->getDataField(FtaModel::FIELDNAME_VERROUILLAGE_LIBELLE_ETIQUETTE);
        $dataFieldLibelleColis = $this->getModel()->getDataField(FtaModel::FIELDNAME_LIBELLE_CLIENT);

        /**
         * On vérifie si le champ est verrouillable
         */
        $dataFieldVerrouillageLibelleEtiquette->checkLockField($this->getModel(), $this->getIsEditable());
        $dataFieldLibelleColis->checkLockField($this->getModel(), $this->getIsEditable());

        /**
         * On autorise la modification selon l'état de champs verrouillable
         */
        $isEditableVerrouillageLibelleEtiquette = $this->isEditableLockField($dataFieldVerrouillageLibelleEtiquette->getIsFieldLock());
        $isEditableLibelleColis = $this->isEditableLockField($dataFieldLibelleColis->getIsFieldLock());

        /**
         * Initialisation des objets
         */
        $htmlObjectVerrouillageEtiquette = new DataFieldToHtmlListSelect(
                $dataFieldVerrouillageLibelleEtiquette
        );
        $htmlObjectEtiquetteColis = new DataFieldToHtmlInputText(
                $dataFieldLibelleColis
        );

        $htmlObjectVerrouillageEtiquette->setIsEditable($isEditableVerrouillageLibelleEtiquette);
        $htmlObjectVerrouillageEtiquette->getEventsForm()->setCallbackJavaScriptFunctionOnChange(self::JAVASCRIPT_CALLBACK_VERROUILLAGE_ETIQ);
        $callbackJavaScriptFunctionOnChangeParameters = $htmlObjectVerrouillageEtiquette->getAttributesGlobal()->getId()->getValue()
                . ","
                . $htmlObjectEtiquetteColis->getAttributesGlobal()->getId()->getValue()
        ;
        $htmlObjectVerrouillageEtiquette->getEventsForm()->setCallbackJavaScriptFunctionOnChangeParameters($callbackJavaScriptFunctionOnChangeParameters);

        /**
         * Description d'un champ
         */
        $htmlObjectVerrouillageEtiquette->setHelp(IntranetColumnInfoModel::getFieldDesc($dataFieldVerrouillageLibelleEtiquette->getTableName(), $dataFieldVerrouillageLibelleEtiquette->getFieldName()
                        , $dataFieldVerrouillageLibelleEtiquette->getFieldLabel(), $htmlObjectVerrouillageEtiquette
        ));

        $htmlReturn.=$htmlObjectVerrouillageEtiquette->getHtmlResult();

        $htmlObjectEtiquetteColis->setIsEditable($isEditableLibelleColis);

        if ($htmlObjectVerrouillageEtiquette->getDataField()->getFieldValue() === FtaModel::ETIQUETTE_COLIS_VERROUILLAGE_TRUE) {
            /**
             * Si l'utilisateur souhaite renseigné son étiquette colis 
             * alors on l'affiche afin qu'il puisse la modifier
             */
            $htmlObjectEtiquetteColis->getStyleCSS()->unsetDisplay();
            /**
             * Si l'étiquette colis n'est pas renseigné alors on récupère la DIN 
             */
            if (!$htmlObjectEtiquetteColis->getDataField()->getFieldValue()) {
                $dinValue = $this->getModel()->getDataField(FtaModel::FIELDNAME_LIBELLE)->getFieldValue();
                $htmlObjectEtiquetteColis->getDataField()->setFieldValue($dinValue);
                $htmlObjectEtiquetteColis->getDataField()->getRecordsetRef()->saveToDatabase();
            }
        } else {
            /**
             * Sinon on n'affiche pas le libellé etiquette colis
             */
            $htmlObjectEtiquetteColis->getStyleCSS()->setDisplayToNone();
            /**
             * De plus on récupère la DIN 
             */
            $dinValue = $this->getModel()->getDataField(FtaModel::FIELDNAME_LIBELLE)->getFieldValue();
            $dataFieldLibelleColis->setFieldValue($dinValue);
            $dataFieldLibelleColis->getRecordsetRef()->saveToDatabase();
        }

        /**
         * Description d'un champ
         */
        $htmlObjectEtiquetteColis->setHelp(IntranetColumnInfoModel::getFieldDesc($dataFieldLibelleColis->getTableName(), $dataFieldLibelleColis->getFieldName()
                        , $dataFieldLibelleColis->getFieldLabel(), $htmlObjectEtiquetteColis
        ));

        $htmlReturn.=$htmlObjectEtiquetteColis->getHtmlResult();
        return $htmlReturn;
    }

    /**
     * Affiche les champs "Voulez-vous imposer le libellé étiquette colis ?" et Libellé etiquette carton
     * En fonction du résultat du champs Forcer libellé étiquette colis ? fais apparaitre ou non l'autre champ
     * @return string
     */
    public function getHtmlIsDureeDeVieCalculateWithDureeDeVieClient() {
        //Initialisation des variables locales
        $htmlReturn = NULL;
        $dataIsDureeDeVieCalculate = $this->getModel()->getDataField(FtaModel::FIELDNAME_IS_DUREE_DE_VIE_CALCULATE);
        $dataIsDureeDeVie = $this->getModel()->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE);
        $htmlObjectIsDureeDeVieCalculate = new DataFieldToHtmlListBoolean($dataIsDureeDeVieCalculate);
        $htmlObjectDureeDeVieClient = new DataFieldToHtmlInputText($dataIsDureeDeVie);

        /**
         * Vérification que les règle de validation sont respecter
         * non présent 
         */
        $dataIsDureeDeVieCalculate->checkValidationRules();
        $dataIsDureeDeVie->checkValidationRules();

        if ($dataIsDureeDeVieCalculate->getDataValidationSuccessful() == TRUE and $dataIsDureeDeVie->getDataValidationSuccessful() == TRUE) {
            $this->setDataValidationSuccessfulToTrue();
        } else {
            $this->setDataValidationSuccessfulToFalse();
        }

        // is duree de vie calculate
        $htmlObjectIsDureeDeVieCalculate->setIsEditable($this->getIsEditable());
        $htmlObjectIsDureeDeVieCalculate->getEventsForm()->setCallbackJavaScriptFunctionOnChange(self::JAVASCRIPT_CALLBACK_DUREE_DE_VIE);
        $callbackJavaScriptFunctionOnChangeParameters = $htmlObjectIsDureeDeVieCalculate->getAttributesGlobal()->getId()->getValue()
                . ","
                . $htmlObjectDureeDeVieClient->getAttributesGlobal()->getId()->getValue()
        ;
        $htmlObjectIsDureeDeVieCalculate->getEventsForm()->setCallbackJavaScriptFunctionOnChangeParameters($callbackJavaScriptFunctionOnChangeParameters);

        /**
         * Description d'un champ
         */
        $htmlObjectIsDureeDeVieCalculate->setHelp(IntranetColumnInfoModel::getFieldDesc($dataIsDureeDeVieCalculate->getTableName(), $dataIsDureeDeVieCalculate->getFieldName()
                        , $dataIsDureeDeVieCalculate->getFieldLabel(), $htmlObjectIsDureeDeVieCalculate
        ));


        $htmlReturn.=$htmlObjectIsDureeDeVieCalculate->getHtmlResult();

        // durée de vie garantie client
        $htmlObjectDureeDeVieClient->setIsEditable($this->getIsEditable());

        if ($htmlObjectIsDureeDeVieCalculate->getDataField()->getFieldValue() === FtaModel::DUREE_DE_VIE_CALCULATE_AUTO) {
            /**
             * Si l'utilisateur souhaite calculé la durée de vie garantie client en automatique
             */
            $htmlObjectDureeDeVieClient->getAttributes()->getDisabled()->setTrue();
            /**
             * Si la durré de vie client n'est pas renseigné alors on récupère 
             * on calcul de 2/3 de la Durré de vie de production
             */
            if (!$htmlObjectDureeDeVieClient->getDataField()->getFieldValue()) {
                $dureeDeVieProductionValue = $this->getModel()->getDureeDeVieClientByDureeDeVieProduction();
                if (is_float($dureeDeVieProductionValue)) {
                    $htmlObjectDureeDeVieClient->getDataField()->setFieldValue($dureeDeVieProductionValue);
                    $htmlObjectDureeDeVieClient->getDataField()->getRecordsetRef()->saveToDatabase();
                } else {
                    $message = "<tr class=contenu><td align=\"center\" valign=\"middle\">"
                            . " Informations "
                            . "</td><td  align=\"center\" valign=\"middle\">"
                            . "<h4>$dureeDeVieProductionValue</h4></td></tr>";
                }
            }
        } else {
            /**
             * Sinon on n'affiche pas le libellé etiquette colis
             */
            $htmlObjectDureeDeVieClient->getAttributes()->getDisabled()->setFalse();
        }


        /**
         * Description d'un champ
         */
        $htmlObjectDureeDeVieClient->setHelp(IntranetColumnInfoModel::getFieldDesc($dataIsDureeDeVie->getTableName(), $dataIsDureeDeVie->getFieldName()
                        , $dataIsDureeDeVie->getFieldLabel(), $htmlObjectDureeDeVieClient
        ));
        $htmlReturn.=$htmlObjectDureeDeVieClient->getHtmlResult() . $message;
        return $htmlReturn;
    }

    /**
     * On affiche les données d'arcadia si une classification est saisi
     * Suivant la classification les champs apparaisant ne sont pas éditables
     */
    public function getHtmlArcadiaDataNotEditable() {

        //Initialisation des variables locales
        $htmlReturn = NULL;
        $idClassificationFta2 = $this->getModel()->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue();
        if ($idClassificationFta2) {
            /**
             * Enregistrement de la donnée catégorie produit optiventes
             */
            $classificationFta2Model = new ClassificationFta2Model($idClassificationFta2);
            $categorieProduitOptiventesValue = $classificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_CATEGORIE_PRODUIT_OPTIVENTES)->getFieldValue();
            $this->getModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_CATEGEORIE_PRODUIT_OPTIVENTES)->setFieldValue($categorieProduitOptiventesValue);

            /**
             * On vérrifie si l'article est soumis à un eco emballage
             * suivant la classification
             */
            $idRayon = ClassificationFta2Model::getIdClassificationTypeByTypeNameAndIdClassificationFta2($idClassificationFta2, ClassificationFta2Model::FIELDNAME_ID_RAYON);
            if ($idRayon == ClassificationFta2Model::ID_CLASSIFICATION_LIBRE_SERVICE) {
                $this->getModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_SOUMIS_ECO_EMBALLAGE)->setFieldValue(Fta2ArcadiaController::OUI);
            } else {
                $this->getModel()->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_SOUMIS_ECO_EMBALLAGE)->setFieldValue(Fta2ArcadiaController::NON);
            }
            $this->getModel()->saveToDatabase();

            /**
             * Affichage Html
             */
            $htmlCodeProduitOptiv = $this->getHtmlDataField(FtaModel::FIELDNAME_ID_ARCADIA_CATEGEORIE_PRODUIT_OPTIVENTES);
            $htmlSoumisEcoEmball = $this->getHtmlDataField(FtaModel::FIELDNAME_ID_ARCADIA_SOUMIS_ECO_EMBALLAGE);
            $htmlReturn = '<tr class=titre_principal><td class>Classification ARCADIA</td></tr>';
            $htmlReturn .= $htmlCodeProduitOptiv . $htmlSoumisEcoEmball;
        }
        return $htmlReturn;
    }

    /**
     * On affiche le raccourcis de classification
     */
    public function getHtmlClassificationRaccourcisView() {
        $htmlClassificationRaccourcis = "";
        $idClassificationFta2 = $this->getModel()->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue();
        if ($idClassificationFta2) {
            $htmlClassificationRaccourcis = $this->getHtmlClassificationRaccourcis();

            /**
             * On initie la vérification des data validation
             */
            if ($this->getModel()->isDataValidationSuccessful()) {
                $this->setDataValidationSuccessfulToFalse();
            } else {
                $this->setDataValidationSuccessfulToTrue();
            }
        }
        return $htmlClassificationRaccourcis;
    }

    /**
     * On affiche les données d'arcadia si une classification est saisi
     * Suivant la classification les champs apparaisant ne sont pas toujours éditables
     */
    function getHtmlArcadiaDataVariableEditable() {

        //Initialisation des variables locales
        $htmlReturn = NULL;
        $idClassificationFta2 = $this->getModel()->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue();
        if ($idClassificationFta2) {
            $htmlFamilleBudget = $this->getHtmlDataField(FtaModel::FIELDNAME_ID_ARCADIA_FAMILLE_BUDGET);
            $htmlGammeCoop = $this->getHtmlDataField(FtaModel::FIELDNAME_ID_ARCADIA_GAMME_COOP);
            $htmlArcadiaMarque = $this->getHtmlArcadiaMarque();
            $htmlArcadiaFamilleVente = $this->getHtmlArcadiaFamilleVenteArcadia();
            $htmlArcadiaSousFamille = $this->getHtmlArcadiaSousFamille();
            $htmlArcadiaGammeFamileBudget = $this->getHtmlArcadiaGammeFamileBudget();

            /**
             * On initie la vérification des data validation
             */
            if ($this->getModel()->isDataValidationSuccessful()) {
                $this->setDataValidationSuccessfulToFalse();
            } else {
                $this->setDataValidationSuccessfulToTrue();
            }


            $htmlReturn = $htmlArcadiaMarque
                    . $htmlArcadiaFamilleVente
                    . $htmlArcadiaSousFamille
                    . $htmlGammeCoop
                    . $htmlFamilleBudget
                    . $htmlArcadiaGammeFamileBudget

            ;
        }
        return $htmlReturn;
    }

    /**
     * On affiche le ou les choix de gamme famille budget si une classification est renseigné
     * @return string
     */
    function getHtmlArcadiaGammeFamileBudget() {
        $htmlReturn = NULL;
        $idClassificationFta2 = $this->getModel()->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue();
        if ($idClassificationFta2) {
            $htmlReturn = ClassificationGammeFamilleBudgetArcadiaModel::getHtmlClassificationGammeFamilleBudget($this->getModel(), $idClassificationFta2, $this->getIsEditable());
        }
        return $htmlReturn;
    }

    /**
     * On affiche le ou les choix de raccourcis si une classification est renseigné
     * @return string
     */
    function getHtmlClassificationRaccourcis() {
        $htmlReturn = NULL;
        $idClassificationFta2 = $this->getModel()->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue();
        if ($idClassificationFta2) {
            $htmlReturn = ClassificationRaccourcisAssociationModel::getHtmlClassificationRaccourcisAssociation($this->getModel(), $idClassificationFta2, $this->getIsEditable());
        }
        return $htmlReturn;
    }

    /**
     * On affiche le ou les choix de sous famille si une classification est renseigné
     * @return string
     */
    function getHtmlArcadiaSousFamille() {
        $htmlReturn = NULL;
        $idClassificationFta2 = $this->getModel()->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue();
        if ($idClassificationFta2) {
            $htmlReturn = ClassificationActiviteSousFamilleArcadiaModel::getHtmlListeClassificationActiviteSousFamilleArcadia($this->getModel(), $idClassificationFta2, $this->getIsEditable());
        }
        return $htmlReturn;
    }

    /**
     * On affiche le ou les choix de  famille de ventes si une classification est renseigné
     * @return string
     */
    function getHtmlArcadiaFamilleVenteArcadia() {
        $htmlReturn = NULL;
        $idClassificationFta2 = $this->getModel()->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue();
        if ($idClassificationFta2) {
            $htmlReturn = ClassificationActiviteFamilleVentesArcadiaModel::getHtmlListeClassificationActiviteFamilleVentesArcadia($this->getModel(), $idClassificationFta2, $this->getIsEditable());
        }
        return $htmlReturn;
    }

    /**
     * On affiche le ou les choix de marque si une classification est renseigné
     * @return string
     */
    function getHtmlArcadiaMarque() {
        $htmlReturn = NULL;
        $idClassificationFta2 = $this->getModel()->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue();
        if ($idClassificationFta2) {
            $htmlReturn = ClassificationMarqueArcadiaModel::getHtmlListeClassificationMarqueArcadia($this->getModel(), $idClassificationFta2, $this->getIsEditable());
        }
        return $htmlReturn;
    }

    /**
     * 
     * @return type
     */
    public function getHtmlCreateurFta() {

        $dataFieldCreateur = $this->getModel()->getDataField(FtaModel::FIELDNAME_CREATEUR);

        $htmlObject = new htmlInputText();
        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_CREATEUR
                . '_'
                . $this->getModel()->getKeyValue()
        ;
        $htmlObject->setLabel($dataFieldCreateur->getFieldLabel());
        $htmlObject->initAbstractHtmlInput($HtmlTableName, $htmlObject->getLabel()
                , $this->getModel()->getModelCreateur()->getPrenomNom()
                , $dataFieldCreateur->isFieldDiff());
        $htmlObject->setIsEditable(FALSE);
        $htmlObject->setHelp(IntranetColumnInfoModel::getFieldDesc($dataFieldCreateur->getTableName(), $dataFieldCreateur->getFieldName()
                        , $dataFieldCreateur->getFieldLabel(), $htmlObject
        ));
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

        $listeSiteProduction = $this->getModel()->showListeDeroulanteSiteProdByAccesAndIdFta($paramIdUser, $paramHtmlObjet, $paramIsEditable);

        /**
         * Initialisation du reésultat des règles de validation
         */
        $this->setDataValidationSuccessful($this->getModel()->isDataValidationSuccessful());

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
     * @param string $paramIdFtaChapitre
     * @param string $paramSyntheseAction
     * @param string $paramComeback
     * @param string $paramIdFtaEtat
     * @param string $paramAbrevationEtat
     * @param string $paramIdFtaRole
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
        /**
         * Champ verrouillable condition
         */
        /**
         * Vérification du champ initialisé
         */
        $isFieldLock = FtaVerrouillageChampsModel::isFieldLock(FtaModel::FIELDNAME_ETIQUETTE_CODESOFT, $this->getModel());
        /**
         * Génération du lien pour verrouillé/déverrouillé
         */
        $linkFieldLock = FtaVerrouillageChampsModel::linkFieldLock($isFieldLock, FtaModel::FIELDNAME_ETIQUETTE_CODESOFT, $this->getModel(), $paramIsEditable);

        /**
         * Affectation de la modification d'un champ ou non
         */
        $isEditable = FtaVerrouillageChampsModel::isEditableLockField($isFieldLock, $paramIsEditable);

        $etiquetteCodesoftDataField = $this->getModel()->getDataField(FtaModel::FIELDNAME_ETIQUETTE_CODESOFT);

        $HtmlList->getAttributes()->getName()->setValue(FtaModel::FIELDNAME_ETIQUETTE_CODESOFT);
        $HtmlList->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_ETIQUETTE_CODESOFT));
        $HtmlList->setIsEditable($isEditable);
        $HtmlList->initAbstractHtmlSelect(
                $HtmlTableName
                , $HtmlList->getLabel()
                , $paramEtiqetteCodesoft
                , $etiquetteCodesoftDataField->isFieldDiff()
                , $HtmlList->getArrayListContent()
                , NULL
                , NULL
                , $isFieldLock
                , $linkFieldLock
        );
        $HtmlList->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $this->getModel()->getKeyValue(), FtaModel::FIELDNAME_ETIQUETTE_CODESOFT);

        /**
         * Description d'un champ
         */
        $HtmlList->setHelp(IntranetColumnInfoModel::getFieldDesc($etiquetteCodesoftDataField->getTableName(), $etiquetteCodesoftDataField->getFieldName()
                        , $etiquetteCodesoftDataField->getFieldLabel(), $HtmlList
        ));


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
    public function getHtmlEmballageUVC($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole) {
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
                $arrayFtaConditionnementTmp = $ftaConditionnmentModel->getArrayFtaConditonnement();

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
            $ftaConditionnmentModel->setIsEditable($this->getIsEditable());

            $htmlEmballageUVC = new HtmlSubForm_RNN($arrayFtaConditionnement, $className, $label, $tablesNameAndIdForeignKeyOfFtaConditionnement, FtaConditionnementModel::FONCTIONNAME_VERSIONNING);
            $htmlEmballageUVC->setIsEditable($this->getIsEditable());
            $htmlEmballageUVC->setRightToAdd($rightToAdd);
            $htmlEmballageUVC->setLienAjouter(FtaConditionnementModel::getAddLinkAfterConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_UVC, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageUVC->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_UVC, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageUVC->setLienSuppression(FtaConditionnementModel::getDeleteLinkConditionnement($paramIdFta, $paramChapitre, $arrayIdFtaCondtionnement, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageUVC->setTableLabel($ftaConditionnmentModel->getTableConditionnementLabel(AnnexeEmballageGroupeTypeModel::EMBALLAGE_UVC));
            $return .= $htmlEmballageUVC->getHtmlResult();
        } else {
            /*
             * Initialisation des modèles 
             */
            $annexeEmballageGroupeTypeModel2 = new AnnexeEmballageGroupeTypeModel('1');
            $label = $annexeEmballageGroupeTypeModel2->getDataField(AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE)->getFieldValue();

            $htmlEmballageUVC = new HtmlSubForm_RNN($arrayFtaConditionnement, $className, $label, $tablesNameAndIdForeignKeyOfFtaConditionnement, FtaConditionnementModel::FONCTIONNAME_VERSIONNING);
            $htmlEmballageUVC->setIsEditable($this->getIsEditable());
            $htmlEmballageUVC->setRightToAdd(TRUE);
            $htmlEmballageUVC->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_UVC, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $return .= $htmlEmballageUVC->getHtmlResult();
        }

        /**
         * Initialisation du reésultat des règles de validation
         */
        $this->setDataValidationSuccessful($htmlEmballageUVC->isDataValidationSuccessful());

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
    public function getHtmlEmballageParColis($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole) {
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
                $arrayFtaConditionnementTmp = $ftaConditionnmentModel->getArrayFtaConditonnement();

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
            $ftaConditionnmentModel->setIsEditable($this->getIsEditable());

            $htmlEmballageParColis = new HtmlSubForm_RNN($arrayFtaConditionnement, $className, $label, $tablesNameAndIdForeignKeyOfFtaConditionnement, FtaConditionnementModel::FONCTIONNAME_VERSIONNING);
            $htmlEmballageParColis->setIsEditable($this->getIsEditable());
            $htmlEmballageParColis->setRightToAdd($rightToAdd);
            $htmlEmballageParColis->setLienAjouter(FtaConditionnementModel::getAddLinkAfterConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_PAR_COLIS, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageParColis->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_PAR_COLIS, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageParColis->setLienSuppression(FtaConditionnementModel::getDeleteLinkConditionnement($paramIdFta, $paramChapitre, $arrayIdFtaCondtionnement, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageParColis->setTableLabel($ftaConditionnmentModel->getTableConditionnementLabel(AnnexeEmballageGroupeTypeModel::EMBALLAGE_PAR_COLIS));
            $return .= $htmlEmballageParColis->getHtmlResult();
        } else {
            /*
             * Initialisation des modèles 
             */
            $annexeEmballageGroupeTypeModel2 = new AnnexeEmballageGroupeTypeModel(AnnexeEmballageGroupeTypeModel::EMBALLAGE_PAR_COLIS);
            $label = $annexeEmballageGroupeTypeModel2->getDataField(AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE)->getFieldValue();

            $htmlEmballageParColis = new HtmlSubForm_RNN($arrayFtaConditionnement, $className, $label, $tablesNameAndIdForeignKeyOfFtaConditionnement, FtaConditionnementModel::FONCTIONNAME_VERSIONNING);
            $htmlEmballageParColis->setIsEditable($this->getIsEditable());
            $htmlEmballageParColis->setRightToAdd(TRUE);
            $htmlEmballageParColis->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_PAR_COLIS, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $return .= $htmlEmballageParColis->getHtmlResult();
        }
        /**
         * Initialisation du reésultat des règles de validation
         */
        $this->setDataValidationSuccessful($htmlEmballageParColis->isDataValidationSuccessful());

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
    public function getHtmlEmballageDuColis($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole) {
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
                $arrayFtaConditionnementTmp = $ftaConditionnmentModel->getArrayFtaConditonnementDuColis();

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
            $ftaConditionnmentModel->setIsEditable($this->getIsEditable());

            $htmlEmballageDuColis = new HtmlSubForm_RNN($arrayFtaConditionnement, $className, $label, $tablesNameAndIdForeignKeyOfFtaConditionnement, FtaConditionnementModel::FONCTIONNAME_VERSIONNING);
            $htmlEmballageDuColis->setIsEditable($this->getIsEditable());
            $htmlEmballageDuColis->setRightToAdd($rightToAdd);
            $htmlEmballageDuColis->setLienAjouter(FtaConditionnementModel::getAddLinkAfterConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_DU_COLIS, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageDuColis->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_DU_COLIS, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageDuColis->setLienSuppression(FtaConditionnementModel::getDeleteLinkConditionnement($paramIdFta, $paramChapitre, $arrayIdFtaCondtionnement, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballageDuColis->setTableLabel($ftaConditionnmentModel->getTableConditionnementLabelDuColis());
            /**
             * Vérrouille tous les champs du tableau emballage colis 
             * quand une données est renseigné
             */
            $htmlEmballageDuColis->setContentLocked(TRUE);
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

            $htmlEmballageDuColis = new HtmlSubForm_RNN($arrayFtaConditionnement, $className, $label, $tablesNameAndIdForeignKeyOfFtaConditionnement, FtaConditionnementModel::FONCTIONNAME_VERSIONNING);
            $htmlEmballageDuColis->setIsEditable($this->getIsEditable());
            $htmlEmballageDuColis->setRightToAdd(TRUE);
            $htmlEmballageDuColis->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_DU_COLIS, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $return .= $htmlEmballageDuColis->getHtmlResult();
        }


        /**
         * Initialisation du résultat des règles de validation
         */
        $this->setDataValidationSuccessful($htmlEmballageDuColis->isDataValidationSuccessful());
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
    public function getHtmlEmballagePalette($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole) {
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
                $arrayFtaConditionnementTmp = $ftaConditionnmentModel->getArrayFtaConditonnement();

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
            $ftaConditionnmentModel->setIsEditable($this->getIsEditable());

            $htmlEmballagePalette = new HtmlSubForm_RNN($arrayFtaConditionnement, $className, $label, $tablesNameAndIdForeignKeyOfFtaConditionnement, FtaConditionnementModel::FONCTIONNAME_VERSIONNING);
            $htmlEmballagePalette->setIsEditable($this->getIsEditable());
            $htmlEmballagePalette->setRightToAdd($rightToAdd);
            $htmlEmballagePalette->setLienAjouter(FtaConditionnementModel::getAddLinkAfterConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_PALETTE, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballagePalette->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_PALETTE, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballagePalette->setLienSuppression(FtaConditionnementModel::getDeleteLinkConditionnement($paramIdFta, $paramChapitre, $arrayIdFtaCondtionnement, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEmballagePalette->setTableLabel($ftaConditionnmentModel->getTableConditionnementLabel(AnnexeEmballageGroupeTypeModel::EMBALLAGE_PALETTE));
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

            $htmlEmballagePalette = new HtmlSubForm_RNN($arrayFtaConditionnement, $className, $label, $tablesNameAndIdForeignKeyOfFtaConditionnement, FtaConditionnementModel::FONCTIONNAME_VERSIONNING);
            $htmlEmballagePalette->setIsEditable($this->getIsEditable());
            $htmlEmballagePalette->setRightToAdd(TRUE);
            $htmlEmballagePalette->setLien(FtaConditionnementModel::getAddLinkBeforeConditionnement($paramIdFta, $paramChapitre, AnnexeEmballageGroupeTypeModel::EMBALLAGE_PALETTE, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $return .= $htmlEmballagePalette->getHtmlResult();
        }

        /**
         * Initialisation du reésultat des règles de validation
         */
        $this->setDataValidationSuccessful($htmlEmballagePalette->isDataValidationSuccessful());

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
    public function getHtmlEtiquetteComposition($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $paramEditable) {

        /*
         * Récuperation des élements clé de la table fta_composant
         */
        if ($paramEditable) {
            $proprietaire = '1';
            $isRightToAdd = TRUE;
            $isRightToDel = TRUE;
        } else {
            $proprietaire = '0';
            $isRightToAdd = FALSE;
            $isRightToDel = FALSE;
        }

        $ftaModel = new FtaModel($paramIdFta);

        if ($ftaModel->isFtaPrimaireOrSecondaire() == FtaModel::FTA_SECONDAIRE) {
            $isRightToAdd = FALSE;
            $isRightToDel = FALSE;
        }

        $FtaComposant = FtaComposantModel::getIdFtaComposition($paramIdFta);
        if ($FtaComposant) {
            foreach ($FtaComposant as $rowsFtaComposant) {
                $idFtaComposant = $rowsFtaComposant[FtaComposantModel::KEYNAME];
                $isComposant = $rowsFtaComposant[FtaComposantModel::FIELDNAME_IS_NOMENCLATURE_FTA_COMPOSANT];
                $arrayIdFtaComposant[$idFtaComposant] = $isComposant;
            }

            $htmlEtiquetteComposant = Html::getHtmlObjectFromDataField($this->getModel()->getDataField(FtaModel::FIELDNAME_VIRTUAL_FTA_COMPOSANT));
            $htmlEtiquetteComposant->setIsEditable($isRightToAdd);
            if ($isRightToAdd) {
                $htmlEtiquetteComposant->setLienAjouter(FtaComposantModel::getAddAfterLinkComposition($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            }
            $htmlEtiquetteComposant->setLienDetail(FtaComposantModel::getDetailLinkComposition($paramIdFta, $paramChapitre, $arrayIdFtaComposant, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            if ($isRightToDel) {
                $htmlEtiquetteComposant->setLienSuppression(FtaComposantModel::getDeleteLinkComposition($paramIdFta, $paramChapitre, $arrayIdFtaComposant, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            }
            $htmlEtiquetteComposant->setTableLabel(FtaComposantModel::getTableCompositionLabel($idFtaComposant));
            $return .= $htmlEtiquetteComposant->getHtmlResult();
        } else {
            $htmlEtiquetteComposant = Html::getHtmlObjectFromDataField($this->getModel()->getDataField(FtaModel::FIELDNAME_VIRTUAL_FTA_COMPOSANT));
            $htmlEtiquetteComposant->setIsEditable($proprietaire);
            $htmlEtiquetteComposant->setRightToAdd($isRightToAdd);
            $htmlEtiquetteComposant->getAttributesGlobal()->setHrefAjoutValue(FtaComposantModel::getAddLinkComposition($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $htmlEtiquetteComposant->setLien(FtaComposantModel::getAddLinkComposition($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $return .= $htmlEtiquetteComposant->getHtmlResult();
        }

        /**
         * Initialisation du reésultat des règles de validation
         */
        $this->setDataValidationSuccessful($htmlEtiquetteComposant->isDataValidationSuccessful());

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
    public function getHtmlEtiquetteRD($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $paramEditable) {

        /*
         * Récuperation des élements clé de la table fta_composant
         */
        if ($paramEditable) {
            $proprietaire = '1';
        } else {
            $proprietaire = '0';
        }

        $ftaModel = new FtaModel($paramIdFta);

        if ($ftaModel->isFtaPrimaireOrSecondaire() == FtaModel::FTA_SECONDAIRE) {
            $proprietaire = '0';
        }

        $FtaComposant = FtaComposantModel::getIdFtaComposant($paramIdFta);
        if ($FtaComposant) {
            foreach ($FtaComposant as $rowsFtaComposant) {
                $idFtaComposant = $rowsFtaComposant[FtaComposantModel::KEYNAME];
                $arrayIdFtaComposant[] = $idFtaComposant;
            }

            $htmlEtiquetteComposant = Html::getHtmlObjectFromDataField($this->getModel()->getDataField(FtaModel::FIELDNAME_VIRTUAL_FTA_COMPOSANT_RD));
            $htmlEtiquetteComposant->setIsEditable($proprietaire);
            $htmlEtiquetteComposant->setLienAjouter(FtaComposantModel::getAddLinkComposant($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $htmlEtiquetteComposant->setLienDetail(FtaComposantModel::getDetailLinkComposant($paramIdFta, $paramChapitre, $arrayIdFtaComposant, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $htmlEtiquetteComposant->setLienSuppression(FtaComposantModel::getDeleteLinkComposant($paramIdFta, $paramChapitre, $arrayIdFtaComposant, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole));
            $htmlEtiquetteComposant->setTableLabel(FtaComposantModel::getTableComposantLabel($idFtaComposant));
            $return .= $htmlEtiquetteComposant->getHtmlResult();
        } else {
            $htmlEtiquetteComposant = Html::getHtmlObjectFromDataField($this->getModel()->getDataField(FtaModel::FIELDNAME_VIRTUAL_FTA_COMPOSANT_RD));
            $htmlEtiquetteComposant->setIsEditable($proprietaire);
            $htmlEtiquetteComposant->setRightToAdd($proprietaire);
            $htmlEtiquetteComposant->getAttributesGlobal()->setHrefAjoutValue(FtaComposantModel::getAddLinkComposant($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $htmlEtiquetteComposant->setLien(FtaComposantModel::getAddLinkComposant($paramIdFta, $paramChapitre, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole, $proprietaire));
            $return .= $htmlEtiquetteComposant->getHtmlResult();
        }

        /**
         * Initialisation du reésultat des règles de validation
         */
        $this->setDataValidationSuccessful($htmlEtiquetteComposant->isDataValidationSuccessful());

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
                        $this->getModel()->getModelSiteProduction()->getDataField(GeoModel::FIELDNAME_SITE_AGREMENT_CE)
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

        $return = $this->getModel()->poidsDesEmballagesColis();

        $htmlPoidColisUVC = new HtmlInputText();

        $htmlPoidColisUVC->setLabel(FtaConditionnementModel::UVC_EMBALLAGE_EMBALLAGE_POIDS_LABEL);
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
            $returnColis = $this->getModel()->buildArrayEmballageTypeDuColis();
            $colis_pds_net = $returnColis[FtaConditionnementModel::COLIS_EMBALLAGE_NET];
            /**
             * Calcul type emballage Colis
             */
            $returnUVC = $this->getModel()->buildArrayEmballageTypeUVC();
            $uvc_net = $returnUVC[FtaConditionnementModel::UVC_EMBALLAGE_NET];
            $tabEmballagesColis = $this->getModel()->poidsDesEmballagesColis();
            $pcb = $tabEmballagesColis[FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON];

            $check1 = strval($uvc_net * $pcb / "1000");
            $check2 = strval($colis_pds_net);
            if ($check1 <> $check2) {
                $html_warning = "ATTENTION, poids net du Colis est différent de la multiplication défini dans les chapitres PCB et Identité pour la gestion de l'unité de facturation<img src=../lib/images/exclamation.png width=15 height=15 border=0/><br><br>";
                $bgcolor = "#FFAA55";
            } else {
                $bgcolor = "#AFFF5A";
                $html_warning = "";
            }

            $bloc.= "<tr class=contenu><td bgcolor=$bgcolor align=\"center\" valign=\"middle\">";
            $bloc.="Contrôle du Poids net du Colis (en Kg): ";
            $bloc.="</td><td bgcolor=$bgcolor align=\"center\" valign=\"middle\">"
                    . "<h4><br>$check2</h4><br>$html_warning</td></tr>";
        } else {
            $bloc = "";
        }
        return $bloc;
    }

    /**
     * Affiche le bouton de retour vers la Fta
     * @return string
     */
    public static function getHtmlButtonReturnTransition($paramIdFta, $paramAction, $paramIdFtaRole, $paramSyntheseAction, $paramDemandeAbreviationFtaEtat) {
        return '<td><center>'
                . '<a href=transiter.php?'
                . 'id_fta=' . $paramIdFta
                . '&action=' . $paramAction
                . '&id_fta_role=' . $paramIdFtaRole
                . '&synthese_action=' . $paramSyntheseAction
                . '&demande_abreviation_fta_transition=' . $paramDemandeAbreviationFtaEtat
                . '>' . FtaController::CALLBACK_LINK_TO_TRANSITER_PAGE . '</a></center></td>';
    }

    /**
     * Affiche le bouton de retour vers la Fta
     * @return string
     */
    public static function getHtmlButtonConfirmationTransition($paramIdFta, $paramAction, $paramIdFtaRole, $paramChapitresSelectionne, $paramChapitres) {
        return '<td><center>'
                . '<a href=transiter.php?'
                . 'id_fta=' . $paramIdFta
                . '&action=' . $paramAction
                . '&id_fta_role=' . $paramIdFtaRole
                . '&checkPost=1'
                . $paramChapitresSelectionne
                . $paramChapitres
                . '>' . FtaController::CALLBACK_LINK_TO_TRANSITER_PAGE_VALIDATE . '</a></center></td>';
    }

}
