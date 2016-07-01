<?php

/**
 * Description of FtaModel
 * Table des FTA
 *
 * @author salokine
 */
class FtaModel extends AbstractModel {

    const CHECK_DATE_ECHANCE = "00-00-0000";
    const CHECK_DATE_ECHANCE2 = "0000-00-00";
    const TABLENAME = "fta";
    const KEYNAME = "id_fta";
    const KEYNAME_CREATEUR = "id_user";
    const FIELDNAME_ACTIF = "actif";
    const FIELDNAME_ACTIVATION_CODESOFT = "activation_codesoft_arti2";
    const FIELDNAME_ARCADIA_EMBALLAGE_TYPE = "id_arcadia_emballage_type";
    const FIELDNAME_ARTICLE_AGROLOGIC = "id_article_agrologic";
    const FIELDNAME_BESOIN_FICHE_TECHNIQUE = "besoin_fiche_technique";
    const FIELDNAME_CALIBRE_DEFAUT = "calibre_defaut";
    const FIELDNAME_CIRCUIT_CLIENT = "id_arcadia_client_circuit";
    const FIELDNAME_CODE_ARTICLE = "CODE_ARTICLE";
    const FIELDNAME_CODE_ARTICLE_CLIENT = "code_article_client";
    const FIELDNAME_CODE_ARTICLE_LDC = "code_article_ldc";
    const FIELDNAME_CODE_ARTICLE_LDC_MERE = "code_article_ldc_mere";
    const FIELDNAME_CODE_DOUANE_FTA = "code_douane_fta";
    const FIELDNAME_CODE_DOUANE_LIBELLE_FTA = "code_douane_libelle_fta";
    const FIELDNAME_COMMENTAIRE = "commentaire";
    const FIELDNAME_COMMENTAIRE_MAJ_FTA = "commentaire_maj_fta";
    const FIELDNAME_COMPOSITION1 = "Composition";
    const FIELDNAME_COMPOSITION2 = "composition1";
    const FIELDNAME_CONDITION_SOUS_ATMOSPHERE = "atmosphere_protectrice";
    const FIELDNAME_CONSEIL_APRES_OUVERTURE = "apres_ouverture_fta";
    const FIELDNAME_CONSEIL_DE_RECHAUFFAGE = "conseil_rechauffage_valide_fta";
    const FIELDNAME_CONSEIL_DE_RECHAUFFAGE_DEVELOPPEMENT = "conseil_rechauffage_experimentale_fta";
    const FIELDNAME_CONSEIL_DE_PRESENTATION = "presentation_fta";
    const FIELDNAME_CREATEUR = "createur_fta";
    const FIELDNAME_DATE_CREATION = "date_creation";
    const FIELDNAME_DATE_DEMANDEUR = "date_demandeur_fta";
    const FIELDNAME_DATE_DERNIERE_MAJ_FTA = "date_derniere_maj_fta";
    const FIELDNAME_DATE_DE_VALIDATION_FTA = "date_de_validation_fta";
    const FIELDNAME_DATE_ECHEANCE_FTA = "date_echeance_fta";
    const FIELDNAME_DATE_PREVISONNELLE_TRANSFERT_INDUSTRIEL = "date_transfert_industriel";
    const FIELDNAME_DESCRIPTION_DU_PRODUIT = "OLD_synoptique_valide_fta";
    const FIELDNAME_DESCRIPTION_TECHNIQUE_INTERNE = "synoptique_experimental_fta";
    const FIELDNAME_DESCRIPTION_EMBALLAGE = "description_emballage";
    const FIELDNAME_DESIGNATION_COMMERCIALE = "designation_commerciale_fta";
    const FIELDNAME_DOSSIER_FTA = "id_dossier_fta";
    const FIELDNAME_DOSSIER_FTA_PRIMAIRE = "dossier_fta_primaire";
    const FIELDNAME_DUREE_DE_VIE = "Duree_de_vie";
    const FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION = "Duree_de_vie_technique";
    const FIELDNAME_DUREE_DE_VIE_TECHNIQUE_MAXIMALE = "duree_vie_technique_fta";
    const FIELDNAME_EAN_COLIS = "EAN_COLIS";
    const FIELDNAME_EAN_PALETTE = "EAN_PALETTE";
    const FIELDNAME_EAN_UVC = "EAN_UVC";
    const FIELDNAME_ECHEANCE_DEMANDEUR = "echeance_demandeur";
    const FIELDNAME_ENVIRONNEMENT_CONSERVATION = "K_etat";
    const FIELDNAME_ENVIRONNEMENT_CONSERVATION_GROUPE = "id_annexe_environnement_conservation_groupe";
    const FIELDNAME_ETIQUETTE_CODESOFT = "id_etiquette_codesoft_arti2";
    const FIELDNAME_ETUDE_PRIX_FTA = "etude_prix_fta";
    const FIELDNAME_FREQUENCE_HEBDOMADAIRE_ESTIMEE_COMMANDE = "frequence_hebdomadaire_estime_commande";
    const FIELDNAME_GESTION_ETIQUETTE_RECTO = "gestion_etiquette_recto";
    const FIELDNAME_GESTION_ETIQUETTE_VERSO = "gestion_etiquette_verso";
    const FIELDNAME_ID_ARCADIA_CATEGEORIE_PRODUIT_OPTIVENTES = "id_arcadia_categeorie_produit_optiventes";
    const FIELDNAME_ID_ARCADIA_FAMILLE_BUDGET = "id_arcadia_famille_budget";
    const FIELDNAME_ID_ARCADIA_FAMILLE_VENTE = "id_arcadia_famille_vente";
    const FIELDNAME_ID_ARCADIA_MARQUE = "id_arcadia_marque";
    const FIELDNAME_ID_ARCADIA_GAMME_COOP = "id_arcadia_gamme_coop";
    const FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET = "id_arcadia_gamme_famille_budget";
    const FIELDNAME_ID_ARCADIA_SOUS_FAMILLE = "id_arcadia_sous_famille";
    const FIELDNAME_ID_CLASSIFICATION_RACCOURCIS = "id_classification_raccourcis";
    const FIELDNAME_ID_FTA_CLASSIFICATION2 = "id_fta_classification2";
    const FIELDNAME_ID_FTA_ETAT = "id_fta_etat";
    const FIELDNAME_IS_DUREE_DE_VIE_CALCULATE = "is_duree_de_vie_calculate";
    const FIELDNAME_LIBELLE = "LIBELLE";
    const FIELDNAME_LIBELLE_CLIENT = "LIBELLE_CLIENT";
    const FIELDNAME_LIBELLE_CODE_ARTICLE_CLIENT = "libelle_code_article_client";
    const FIELDNAME_LIBELLE_MULTILANGUE = "libelle_multilangue";
    const FIELDNAME_LISTE_ALLERGENE = "allergenes_matiere_fta";
    const FIELDNAME_LISTE_CHAPITRE_MAJ_FTA = "liste_chapitre_maj_fta";
    const FIELDNAME_LISTE_ID_FTA_ROLE = "liste_id_fta_role";
    const FIELDNAME_LOGO_ECO_EMBALLAGE = "image_eco_emballage";
    const FIELDNAME_NOM_CLIENT_DEMANDEUR = "nom_client_demandeur";
    const FIELDNAME_NOM_ABREGE = "OLD_nom_abrege_fta";
    const FIELDNAME_NOM_DEMANDEUR = "nom_demandeur_fta";
    const FIELDNAME_NOMBRE_PORTION_FTA = "nombre_portion_fta";
    const FIELDNAME_NOMBRE_UVC_PAR_CARTON = "NB_UNIT_ELEM";
    const FIELDNAME_ORIGINE_MATIERE_PREMIERE = "origine_matiere_fta";
    const FIELDNAME_PERIODE_DE_COMMERCIALISATION = "periode_commercialisation_fta";
    const FIELDNAME_POIDS_ELEMENTAIRE = "Poids_ELEM";
    const FIELDNAME_POIDS_BRUT_UVC = "poids_brut_uvc_fta";
    const FIELDNAME_POIDS_EMBALLAGES_UVC = "poids_emballages_uvc_fta";
    const FIELDNAME_POIDS_NET_UVC = "poids_net_uvc_fta";
    const FIELDNAME_PRODUIT_TRANSFORME = "origine_transformation_fta";
    const FIELDNAME_PVC_ARTICLE = "pvc_article";
    const FIELDNAME_PVC_ARTICLE_KG = "pvc_article_kg";
    const FIELDNAME_POURCENTAGE_AVANCEMENT = "pourcentage_avancement";
    const FIELDNAME_QUANTITE_HEBDOMADAIRE_ESTIMEE_COMMANDE = "quantite_hebdomadaire_estime_commande";
    const FIELDNAME_REFERENCE_EXTERNES = "reference_externe_fta";
    const FIELDNAME_REMARQUE = "remarque_fta";
    const FIELDNAME_RESEAU_CLIENT = "id_arcadia_client_reseau";
    const FIELDNAME_SEGMENT_CLIENT = "id_arcadia_client_segment";
    const FIELDNAME_SERVICE_CONSOMMATEUR = "id_service_consommateur";
    const FIELDNAME_SITE_PRODUCTION = "Site_de_production";
    const FIELDNAME_SITE_EXPEDITION_FTA = "site_expedition_fta";
    const FIELDNAME_SOCIETE_DEMANDEUR = "societe_demandeur_fta";
    const FIELDNAME_SUFFIXE_AGROLOGIC_FTA = "suffixe_agrologic_fta";
    const FIELDNAME_UNITE_AFFICHAGE = "unite_affichage_fta";
    const FIELDNAME_UNITE_FACTURATION = "id_annexe_unite_facturation";
    const FIELDNAME_VERROUILLAGE_LIBELLE_ETIQUETTE = "verrouillage_libelle_etiquette_fta";
    const FIELDNAME_VERSION_DOSSIER_FTA = "id_version_dossier_fta";
    const FIELDNAME_VIRTUAL_FTA_COMPOSANT = "VIRTUAL_fta_composant";
    const FIELDNAME_VIRTUAL_FTA_COMPOSANT_RD = "VIRTUAL_fta_composant_rd";
    const FIELDNAME_VIRTUAL_FTA_PROCESSUS_DELAI = "VIRTUAL_fta_processus_delai";
    const FIELDNAME_WORKFLOW = "id_fta_workflow";
    const ID_POIDS_VARIABLE = "3";
    const DUREE_DE_VIE_CALCULATE_AUTO = "1";
    const ETIQUETTE_COLIS_VERROUILLAGE_TRUE = "1";
    const ETIQUETTE_COLIS_VERROUILLAGE_NON = "Non";
    const DUREE_DE_VIE_CALCULATE_AUTO_OUI = "Oui";
    const MESSAGE_DATA_MISSING = UserInterfaceMessage::FR_WARNING_DATA_MISSING_TITLE;
    const MESSAGE_DATA_VALIDATION_CLASSIFICATION = UserInterfaceMessage::FR_WARNING_DATA_CLASIFICATION;
    const MESSAGE_DATA_VALIDATION_CODE_LDC = UserInterfaceMessage::FR_WARNING_DATA_VALIDATION_FTA_CODE_LDC;
    const MESSAGE_DATA_VALIDATION_DATE_ECHEANCE = UserInterfaceMessage::FR_WARNING_DATA_DATE_ECHEANCE;
    const MESSAGE_DATA_VALIDATION_DATE_ECHEANCE_INCOHERENCE = UserInterfaceMessage::FR_WARNING_DATA_DATE_ECHEANCE_INCOHERENCE;
    const VALEUR_CHECK_EN_KG = "1";
    const CONVERSION_KG_EN_G = "1000";
    const FTA_PRIMAIRE = '1';
    const FTA_SECONDAIRE = '2';
    const FTA_NORMAL = '0';
    const FTA_DOSSIER_VERSION_0 = '0';

    /**
     * Utilisateur ayant créé la FTA
     * @var UserModel
     */
    private $modelCreateur;

    /**
     * Etat de la FTA
     * @var FtaEtatModel
     */
    private $modelFtaEtat;

    /**
     * Catégorie de la FTA
     * @var FtaWorkflowModel
     */
    private $modelFtaWorkflow;

    /**
     * Model de donnée d'une FTA
     * @var FtaProcessusDelaiModel
     */
    private $modelFtaProcessusDelai;

    /**
     * Site d'expedition de la FTA
     * @var GeoModel
     */
    private $modelSiteExpedition;

    /**
     * Site d'expedition de la FTA
     * @var GeoArcadiaModel
     */
    private $modelGeoArcadiaExpe;

    /**
     * Site d'expedition de la FTA
     * @var GeoArcadiaModel
     */
    private $modelGeoArcadiaProd;

    /**
     * Classification de la FTA
     * @var ClassificationFta2
     */
    private $modelClassificationFta2;

    /**
     * Catégorie Produit Optiventes
     * @var ArcadiaCategorieProduitOptiventesModel
     */
    private $modelArcadiaCategorieProduitOptiventes;

    /**
     *
     * @var AnnexeUniteFacturationModel 
     */
    private $modelAnnexeUniteFacturation;

    /**
     *
     * @var AnnexeEnvironnementConservationGroupeModel 
     */
    private $modelAnnexeEnvironnementConservationGroupe;

    /**
     * Classification Raccourcis
     * @var ClassificationRaccourcisModel 
     */
    private $modelClassificationRacourcis;

    /**
     * Site de production de la FTA
     * @var GeoModel
     */
    private $modelSiteProduction;
    private $donneeEmballageUVC;
    private $donneeEmballageParColis;
    private $donneeEmballageDuColis;
    private $donneeEmballagePallette;
    private $messageErreurDataValidation;
    private $dataValidationSuccessful;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);

        // Tables filles (Relation 1:N, la clef étrangère dans la table actuelle)
        $this->setModelCreateur(
                new UserModel($this->getDataField(self::FIELDNAME_CREATEUR)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
        $this->setModelFtaEtat(
                new FtaEtatModel($this->getDataField(self::FIELDNAME_ID_FTA_ETAT)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
        $this->setModelFtaWorkflow(
                new FtaWorkflowModel($this->getDataField(self::FIELDNAME_WORKFLOW)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );

        $this->setModelSiteExpedition(
                new GeoModel($this->getDataField(self::FIELDNAME_SITE_EXPEDITION_FTA)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
        $this->setModelSiteProduction(
                new GeoModel($this->getDataField(self::FIELDNAME_SITE_PRODUCTION)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
        $this->setModelAnnexeUniteFacturation(
                new AnnexeUniteFacturationModel($this->getDataField(self::FIELDNAME_UNITE_FACTURATION)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
        $this->setModelArcadiaCategorieProduitOptiventes(
                new ArcadiaCategorieProduitOptiventesModel($this->getDataField(self::FIELDNAME_ID_ARCADIA_CATEGEORIE_PRODUIT_OPTIVENTES)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
        $this->setModelAnnexeEnvironnementConservationGroupe(
                new AnnexeEnvironnementConservationGroupeModel($this->getDataField(self::FIELDNAME_ENVIRONNEMENT_CONSERVATION)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
        $this->setModelGeoArcadiaExpe(
                new GeoArcadiaModel($this->getDataField(self::FIELDNAME_SITE_EXPEDITION_FTA)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
        $this->setModelGeoArcadiaProd(
                new GeoArcadiaModel($this->getDataField(self::FIELDNAME_SITE_PRODUCTION)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
        $this->setModelClassificationFta2(
                new ClassificationFta2Model($this->getDataField(self::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );

        $this->setModelClassificationRacourcis(
                new ClassificationRaccourcisModel($this->getDataField(self::FIELDNAME_ID_CLASSIFICATION_RACCOURCIS)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
        /**
         * Initialisation de la Fta à comparer
         */
        $this->setDataFtaTableToCompare();
    }

    /**
     * On récupère l'id carton arcadia associé à un emballage du colis 
     * @return type
     */
    function getIdArcadiaTypeCarton() {
        $idArcadiaTypeCarton = "";
        $idFta = $this->getKeyValue();

        $arrayIdAnnexeEmballageGroupeDuColis = AnnexeEmballageGroupeModel::getArrayIdAnnexeEmballageGroupe(AnnexeEmballageGroupeTypeModel::EMBALLAGE_DU_COLIS);
        $arrayIdAnnexeEmballageDuColis = AnnexeEmballageModel::getArrayIdAnnexeEmballage($arrayIdAnnexeEmballageGroupeDuColis);
        $arrayIdFtaConditionnemntDuColis = FtaConditionnementModel::getIdFtaConditionnementByArrayIdAnnexeEmballageAndIdFtaAndIdEmballageGroupeType($arrayIdAnnexeEmballageDuColis, $idFta, AnnexeEmballageGroupeTypeModel::EMBALLAGE_DU_COLIS);
        if ($arrayIdFtaConditionnemntDuColis) {
            foreach ($arrayIdFtaConditionnemntDuColis as $key => $paramId) {
                $ftaConditionnmentModel = new FtaConditionnementModel($paramId);
                $idArcadiaTypeCarton = $ftaConditionnmentModel->getModelAnnexeEmballage()->getDataField(AnnexeEmballageModel::FIELDNAME_ID_ARCADIA_TYPE_CARTON)->getFieldValue();
                $ftaConditionnmentModel->getDataField(FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE)->isFieldDiff();
            }
        }
        return $idArcadiaTypeCarton;
    }

    /**
     * On vérifie si l'emballage du colis a été modifié
     * @return bolean
     */
    function checkEmballageDuColisIsDiff() {
        $checkdiff = "";
        $idFta = $this->getKeyValue();

        $arrayIdAnnexeEmballageGroupeDuColis = AnnexeEmballageGroupeModel::getArrayIdAnnexeEmballageGroupe(AnnexeEmballageGroupeTypeModel::EMBALLAGE_DU_COLIS);
        $arrayIdAnnexeEmballageDuColis = AnnexeEmballageModel::getArrayIdAnnexeEmballage($arrayIdAnnexeEmballageGroupeDuColis);
        $arrayIdFtaConditionnemntDuColis = FtaConditionnementModel::getIdFtaConditionnementByArrayIdAnnexeEmballageAndIdFtaAndIdEmballageGroupeType($arrayIdAnnexeEmballageDuColis, $idFta, AnnexeEmballageGroupeTypeModel::EMBALLAGE_DU_COLIS);
        if ($arrayIdFtaConditionnemntDuColis) {
            foreach ($arrayIdFtaConditionnemntDuColis as $key => $paramId) {
                $ftaConditionnmentModel = new FtaConditionnementModel($paramId);
                $checkdiff = $ftaConditionnmentModel->getDataField(FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE)->isFieldDiff();
            }
        }
        return $checkdiff;
    }

    /**
     * On vérifie si l'emballage du colis qui devrait être unique
     * à une correspondance sur arcadia sinon alors on affiche une message d'avertissement 
     * pour un cas non communiqué
     */
    function checkEmballageColisValide() {
        $return = "";
        $idFta = $this->getKeyValue();

        $arrayIdAnnexeEmballageGroupeDuColis = AnnexeEmballageGroupeModel::getArrayIdAnnexeEmballageGroupe(AnnexeEmballageGroupeTypeModel::EMBALLAGE_DU_COLIS);
        $arrayIdAnnexeEmballageDuColis = AnnexeEmballageModel::getArrayIdAnnexeEmballage($arrayIdAnnexeEmballageGroupeDuColis);
        $arrayIdFtaConditionnemntDuColis = FtaConditionnementModel::getIdFtaConditionnementByArrayIdAnnexeEmballageAndIdFtaAndIdEmballageGroupeType($arrayIdAnnexeEmballageDuColis, $idFta, AnnexeEmballageGroupeTypeModel::EMBALLAGE_DU_COLIS);
        if ($arrayIdFtaConditionnemntDuColis) {
            foreach ($arrayIdFtaConditionnemntDuColis as $key => $paramId) {
                $ftaConditionnmentModel = new FtaConditionnementModel($paramId);
                $idCartonArcadia = $ftaConditionnmentModel->getModelAnnexeEmballage()->getDataField(AnnexeEmballageModel::FIELDNAME_ID_ARCADIA_TYPE_CARTON)->getFieldValue();
                if ($idCartonArcadia == ArcadiaTypeCartonModel::ID_CARTON_NON_COMUNIQUE) {
                    $return = "<tr class=contenu><td bgcolor=#FFAA55 align=\"center\" valign=\"middle\">";
                    $return.=UserInterfaceMessage::FR_WARNING_TITLE;
                    $return.="</td><td bgcolor=#FFAA55 align=\"center\" valign=\"middle\">"
                            . "<h4>" . UserInterfaceMessage::FR_WARNING_EMBALLAGE_COLIS_ARCADIA . "</h4></td></tr>";
                }
            }
        }

        return $return;
    }

    /**
     * Accès à la page de modification du gestionnaire de la Fta
     * @param HtmlListSelect $paramObjetList
     * @param int $paramGestionaireFta
     * @return string
     */
    function getListeUserGestionnaire(HtmlListSelect $paramObjetList, $paramGestionaireFta) {
        /*
         * Gestionnaire FTA
         */
        $arrayUserGestionnaire = $this->getArrayUserGestionnaire();
        $paramObjetList->setArrayListContent($arrayUserGestionnaire);

        $HtmlTableName = self::TABLENAME
                . '_'
                . self::FIELDNAME_CREATEUR
        ;
        $paramObjetList->getAttributes()->getName()->setValue(FtaModel::FIELDNAME_CREATEUR);
        $paramObjetList->setLabel(DatabaseDescription::getFieldDocLabel(self::TABLENAME, self::FIELDNAME_CREATEUR));
        $paramObjetList->setIsEditable(TRUE);
        $paramObjetList->initAbstractHtmlSelect(
                $HtmlTableName, $paramObjetList->getLabel(), $paramGestionaireFta, NULL, $paramObjetList->getArrayListContent());

        $listeUserGestionnaire = $paramObjetList->getHtmlResult();

        return $listeUserGestionnaire;
    }

    /**
     * Récupère la liste des gestionnaires possibles de la Fta
     * @return array
     */
    private function getArrayUserGestionnaire() {

        $idFtaWorkflow = $this->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
        $SiteDeProduction = $this->getDataField(FtaModel::FIELDNAME_SITE_PRODUCTION)->getFieldValue();

        $array = UserModel::getArrayIdUserBySiteProdAndWorkflow($SiteDeProduction, $idFtaWorkflow);

        return$array;
    }

    /**
     * Les données de la FTA sont-elles validées ?
     * Ce test vérifie le renseignement des données obligatoires.
     * @return boolean     
     */
    public function isFtaDataValidationSuccess() {
        $return = "0";

        /*
         * Liste des Contrôles 
         */
//        if ($paramIdFtaChapitre == FtaChapitreModel::ID_CHAPITRE_IDENTITE) {
        $return += $this->checkDataValidationClassification();
//        }
        /**
         * Si la Fta est un création (v0) alors la date d'échéance est obligatoire
         */
        if ($this->getDataField(FtaModel::FIELDNAME_VERSION_DOSSIER_FTA)->getFieldValue() == "0") {
            $return += $this->checkDataValidationDateEcheance();
        }
        $return += $this->checkDataValidationCodeLDC();


        if ($return != "0") {
            $titre = self::MESSAGE_DATA_MISSING;
            $message = $this->getMessageErreurDataValidation();
            Lib::showMessage($titre, $message, $redirection);
        }

        return $return;
    }

    /**
     * Vérification de la classification 
     * @return boolean
     */
    private function checkDataValidationClassification() {
        $return = TRUE;

        if (!$this->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->getFieldValue()) {
            $newErrorMessage = self::MESSAGE_DATA_VALIDATION_CLASSIFICATION;
            $return = "1";
        } else {
            $return = "0";
        }

        if ($return != "0") {
            //Ajout de la raison de l'echec du contrôle dans le message d'information utilisateur.
            $this->addMessageErreurDataValidation($newErrorMessage);
        }
        return $return;
    }

    /**
     * Vérification de la classification 
     * @return boolean
     */
    private function checkDataValidationDateEcheance() {
        $return = TRUE;

        switch (TRUE) {
            /**
             * Si aucune date d'échance est renseigné, erreur
             */
            case!$this->getDataField(FtaModel::FIELDNAME_DATE_ECHEANCE_FTA)->getFieldValue():

            /**
             * Si la date d'échacne est égal à 0000-00-00, erreur
             */
            case $this->getDataField(FtaModel::FIELDNAME_DATE_ECHEANCE_FTA)->getFieldValue() == self::CHECK_DATE_ECHANCE
            or $this->getDataField(FtaModel::FIELDNAME_DATE_ECHEANCE_FTA)->getFieldValue() == self::CHECK_DATE_ECHANCE2:
                $return = "1";
                $newErrorMessage = self::MESSAGE_DATA_VALIDATION_DATE_ECHEANCE;

                break;
            /**
             * Si la date d'échance est infèrieur à la date d'aujourd'hui , erreur
             */
//            case $this->getDataField(FtaModel::FIELDNAME_DATE_ECHEANCE_FTA)->getFieldValue() < date("Y-m-d"):
//                $return = "1";
//                $newErrorMessage = self::MESSAGE_DATA_VALIDATION_DATE_ECHEANCE_INCOHERENCE;
//
//                break;

            default :

                $return = "0";

                break;
        }
        if ($return != "0") {
            //Ajout de la raison de l'echec du contrôle dans le message d'information utilisateur.
            $this->addMessageErreurDataValidation($newErrorMessage);
        }
        return $return;
    }

    /**
     * Cohérence du Code LDC
     * Si le code est déjà affecté à une autre FTA, on informe et on suppirme l'affectation sur la FTA en cours
     * @return boolean
     */
    private function checkDataValidationCodeLDC() {
        $return = TRUE;

        if ($this->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue() and ModuleConfig::CODE_LDC_UNIQUE) {
            //if($code_article_ldc and false)
            $arrayCoherenceLDC = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT ' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME
                            . ' FROM ' . FtaModel::TABLENAME . ',' . FtaEtatModel::TABLENAME
                            . ' WHERE ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_DOSSIER_FTA . ' <> \'' . $this->getDataField(FtaModel::FIELDNAME_DOSSIER_FTA)->getFieldValue() . '\' '
                            . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_CODE_ARTICLE_LDC . ' = \'' . $this->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue() . '\' '
                            . ' AND ' . FtaEtatModel::TABLENAME . '.' . FtaEtatModel::KEYNAME . '=' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_ID_FTA_ETAT
                            . ' AND ' . FtaEtatModel::FIELDNAME_ABREVIATION . '<>\'' . FtaEtatModel::ETAT_ABREVIATION_VALUE_RETIRE . '\' '
            );


            if ($arrayCoherenceLDC) {
                foreach ($arrayCoherenceLDC as $rowsCoherenceLDC) {
                    $newErrorMessage = self::MESSAGE_DATA_VALIDATION_CODE_LDC;
                    $this->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->setFieldValue(null);
                }
                $return = "1";
            } else {
                $return = "0";
            }
        } else {
            $return = "0";
        }


        if ($return != "0") {
            //Ajout de la raison de l'echec du contrôle dans le message d'information utilisateur.
            $this->addMessageErreurDataValidation($newErrorMessage);
        }
        return $return;
    }

    private function addMessageErreurDataValidation($paramNewErrorMessage) {
        $this->setMessageErreurDataValidation($this->getMessageErreurDataValidation() . "\n" . $paramNewErrorMessage);
    }

    function getMessageErreurDataValidation() {
        return $this->messageErreurDataValidation;
    }

    function setMessageErreurDataValidation($paramMessageErreurDataValidation) {
        $this->messageErreurDataValidation = $paramMessageErreurDataValidation;
    }

    protected function setDefaultValues() {
        
    }

    public function isDataValidationSuccessful() {
        return $this->dataValidationSuccessful;
    }

    function setDataValidationSuccessful($paramDataValidationSuccessful) {
        $this->dataValidationSuccessful += $paramDataValidationSuccessful;
    }

    function setDataValidationSuccessfulToTrue() {
        $this->setDataValidationSuccessful("0");
    }

    function setDataValidationSuccessfulToFalse() {
        $this->setDataValidationSuccessful("1");
    }

    /**
     * 
     * @return GeoModel
     */
    function getModelSiteExpedition() {
        return $this->modelSiteExpedition;
    }

    function setModelSiteExpedition(GeoModel $modelSiteExpedition) {
        $this->modelSiteExpedition = $modelSiteExpedition;
    }

    /**
     * Lien vers la table geoArcadia avec le site d'expedition
     * @return GeoArcadiaModel
     */
    function getModelGeoArcadiaExpe() {
        return $this->modelGeoArcadiaExpe;
    }

    function setModelGeoArcadiaExpe(GeoArcadiaModel $modelGeoArcadia) {
        $this->modelGeoArcadiaExpe = $modelGeoArcadia;
    }

    /**
     * Lien vers la table geoArcadia avec le site de production
     * @return GeoArcadiaModel
     */
    function getModelGeoArcadiaProd() {
        return $this->modelGeoArcadiaProd;
    }

    function setModelGeoArcadiaProd(GeoArcadiaModel $modelGeoArcadiaProd) {
        $this->modelGeoArcadiaProd = $modelGeoArcadiaProd;
    }

    /**
     * Lien vers la table geoArcadia
     * @return ClassificationFta2Model
     */
    function getModelClassificationFta2() {
        return $this->modelClassificationFta2;
    }

    function setModelClassificationFta2(ClassificationFta2Model $modelClassificationFta2) {
        $this->modelClassificationFta2 = $modelClassificationFta2;
    }

    /**
     * Lien vers la table classsification Raccourcis
     * @return ClassificationRaccourcisModel
     */
    function getModelClassificationRacourcis() {
        return $this->modelClassificationRacourcis;
    }

    function setModelClassificationRacourcis(ClassificationRaccourcisModel $modelClassificationRacourcis) {
        $this->modelClassificationRacourcis = $modelClassificationRacourcis;
    }

    /**
     * 
     * @return GeoModel
     */
    function getModelSiteProduction() {
        return $this->modelSiteProduction;
    }

    function setModelSiteProduction(GeoModel $modelSiteProduction) {
        $this->modelSiteProduction = $modelSiteProduction;
    }

    /**
     * 
     * @return FtaProcessusDelaiModel
     */
    public function getModelFtaProcessusDelai() {
        return $this->modelFtaProcessusDelai;
    }

    public function setModelFtaProcessusDelai(FtaProcessusDelaiModel $modelFtaProcessusDelai) {
        $this->modelFtaProcessusDelai = $modelFtaProcessusDelai;
    }

    /**
     * Retourne le créateur de la FTA
     * @return UserModel
     */
    public function getModelCreateur() {
        return $this->modelCreateur;
    }

    /**
     * Retourne l'état de la FTA
     * @return FtaEtatModel
     */
    public function getModelFtaEtat() {
        return $this->modelFtaEtat;
    }

    /**
     * Défini le créateur de la FTA
     * @param UserModel 
     */
    private function setModelCreateur(UserModel $modelCreateur) {
        $this->modelCreateur = $modelCreateur;
    }

    /**
     * Défini l'état de la FTA
     * @param FtaEtatModel 
     */
    private function setModelFtaEtat(FtaEtatModel $modelFtaEtat) {
        $this->modelFtaEtat = $modelFtaEtat;
    }

    function getModelAnnexeUniteFacturation() {
        return $this->modelAnnexeUniteFacturation;
    }

    function setModelAnnexeUniteFacturation(AnnexeUniteFacturationModel $modelAnnexeUniteFacturation) {
        $this->modelAnnexeUniteFacturation = $modelAnnexeUniteFacturation;
    }

    function getModelFtaWorkflow() {
        return $this->modelFtaWorkflow;
    }

    function setModelFtaWorkflow(FtaWorkflowModel $modelFtaWorkflow) {
        $this->modelFtaWorkflow = $modelFtaWorkflow;
    }

    function getDonneeEmballageUVC() {
        return $this->donneeEmballageUVC;
    }

    function getDonneeEmballageParColis() {
        return $this->donneeEmballageParColis;
    }

    function getDonneeEmballageDuColis() {
        return $this->donneeEmballageDuColis;
    }

    function getDonneeEmballagePallette() {
        return $this->donneeEmballagePallette;
    }

    function setDonneeEmballageUVC($donneeEmballageUVC) {
        $this->donneeEmballageUVC = $donneeEmballageUVC;
    }

    function setDonneeEmballageParColis($donneeEmballageParColis) {
        $this->donneeEmballageParColis = $donneeEmballageParColis;
    }

    function setDonneeEmballageDuColis($donneeEmballageDuColis) {
        $this->donneeEmballageDuColis = $donneeEmballageDuColis;
    }

    function setDonneeEmballagePallette($donneeEmballagePallette) {
        $this->donneeEmballagePallette = $donneeEmballagePallette;
    }

    function getModelArcadiaCategorieProduitOptiventes() {
        return $this->modelArcadiaCategorieProduitOptiventes;
    }

    function setModelArcadiaCategorieProduitOptiventes(ArcadiaCategorieProduitOptiventesModel $modelArcadiaCategorieProduitOptiventes) {
        $this->modelArcadiaCategorieProduitOptiventes = $modelArcadiaCategorieProduitOptiventes;
    }

    function getModelAnnexeEnvironnementConservationGroupe() {
        return $this->modelAnnexeEnvironnementConservationGroupe;
    }

    function setModelAnnexeEnvironnementConservationGroupe(AnnexeEnvironnementConservationGroupeModel $modelAnnexeEnvironnementConservationGroupe) {
        $this->modelAnnexeEnvironnementConservationGroupe = $modelAnnexeEnvironnementConservationGroupe;
    }

    /**
     * Tableau de DatabaseRecord contenant les processus de cycle de vie
     * de la FTA
     * @return array
     */
    public function getArrayIdProcessusFromFtaCycleDeVie() {

        $sqlDataEtatAbreviationValue = DatabaseOperation::convertDataForQuery(
                        $this->getModelFtaEtat()->getDataField(FtaEtatModel::FIELDNAME_ABREVIATION)->getFieldValue()
        );
        $sqlDataIdFtaCategorieValue = DatabaseOperation::convertDataForQuery(
                        $this->getModelFtaWorkflow()->getKeyValue()
        );

        //Sélection de tous les processus appartenant au cycle de vie de la FTA
        return DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . " AS " . FtaProcessusModel::KEYNAME . " "
                        . ", " . FtaProcessusCycleModel::FIELDNAME_DELAI . " "
                        . "FROM " . FtaProcessusCycleModel::TABLENAME . ", " . FtaProcessusModel::TABLENAME . " "
                        . "WHERE " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "=" . $sqlDataEtatAbreviationValue . " "
                        . "AND " . FtaWorkflowModel::KEYNAME . "=" . $sqlDataIdFtaCategorieValue . " "
                        . "AND " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . "=" . FtaProcessusModel::KEYNAME . " "
                        . "ORDER BY " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
        );
    }

    public function getArrayIdProcessusFromFtaProcessusDelai() {

        //Sélection de tous les processus appartenant au cycle de vie de la FTA
        $sqlDataIdFtaValue = $this->getKeyValue();

        return DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . FtaProcessusDelaiModel::FIELDNAME_ID_FTA_PROCESSUS . " FROM " . FtaProcessusDelaiModel::TABLENAME . " "
                        . "WHERE " . FtaProcessusDelaiModel::FIELDNAME_ID_FTA . "=" . $sqlDataIdFtaValue . " "
        );
    }

    public function getEcheanceByIdProcessus($paramIdProcessus) {

        //Sélection de tous les processus appartenant au cycle de vie de la FTA
        $sqlDataIdFtaValue = $this->getKeyValue();

        $returnArray = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . FtaProcessusDelaiModel::FIELDNAME_DATE_ECHEANCE_PROCESSUS . " FROM " . FtaProcessusDelaiModel::TABLENAME . " "
                        . "WHERE " . FtaProcessusDelaiModel::FIELDNAME_ID_FTA . "=" . $sqlDataIdFtaValue . " "
                        . "AND " . FtaProcessusDelaiModel::FIELDNAME_ID_FTA_PROCESSUS . "=" . $paramIdProcessus . " "
        );
        return $returnArray[0][FtaProcessusDelaiModel::FIELDNAME_DATE_ECHEANCE_PROCESSUS];
    }

    public function getArrayModelFtaProcessusDelaiByIdProcessus() {

        $arrayReturn = NULL;
        $arrayIdProcessusFromFtaProcessusDelai = $this->getArrayIdProcessusFromFtaProcessusDelai();

        if ($arrayIdProcessusFromFtaProcessusDelai != NULL) {
            //Parcours de tous les processus dont un délai a déjà été resenseigné
            foreach ($arrayIdProcessusFromFtaProcessusDelai as $rows) {

                //Extraction des données du tableau PHP
                $idFtaProcessus = $rows[FtaProcessusModel::KEYNAME];

                //Stockage dans un tableau où la clef est l'ID du processus
                $arrayModelFtaProcessusDelaiByIdProcessus[$idFtaProcessus] = new FtaProcessusDelaiModel($idFtaProcessus);
            }
            $arrayReturn = $arrayModelFtaProcessusDelaiByIdProcessus;
        }
        return $arrayReturn;
    }

    public function getArrayDataFieldEcheancesForProcessusCycle() {

        $dateEcheanceFta = $this->getDataField(FtaModel::FIELDNAME_DATE_ECHEANCE_FTA)->getFieldValue();


        $isEcheanceForThisFtaExist = NULL;

        //Date par processus
        $annee_date_echeance_fta = substr($dateEcheanceFta, 0, 4);
        $mois_date_echeance_fta = substr($dateEcheanceFta, 5, 2);
        $jour_date_echeance_fta = substr($dateEcheanceFta, 8, 2);

        $arrayModelFtaProcessusDelaiByIdProcessus = $this->getArrayModelFtaProcessusDelaiByIdProcessus();


        //Sélection de tous les processus appartenant au cycle de vie de la FTA
        $arrayIdProcessusFromFtaCycleDeVie = $this->getArrayIdProcessusFromFtaCycleDeVie();

        foreach ($arrayIdProcessusFromFtaCycleDeVie as $rows) {

            //Extraction des données du tableau PHP
            $idFtaProcessus = $rows[FtaProcessusModel::KEYNAME];
            $WeekSinceFirstProcessus = $rows[FtaProcessusCycleModel::FIELDNAME_DELAI];

            //Processus défini pour ce cycle de vie
            $modelFtaProcessusForCycle = new FtaProcessusModel($idFtaProcessus);

            //La FTA a-t-elle une échéance de renseignée pour ce processus ?
            if ($arrayModelFtaProcessusDelaiByIdProcessus != NULL) {
                $isEcheanceForThisFtaExist = array_key_exists(
                        $modelFtaProcessusForCycle->getKeyValue()
                        , $arrayModelFtaProcessusDelaiByIdProcessus
                );
            }

            if ($isEcheanceForThisFtaExist) {
                //Si il existe, on récupère ce délai

                $modelFtaProcessusDelai = $arrayModelFtaProcessusDelaiByIdProcessus[$modelFtaProcessusForCycle->getKeyValue()];
            } else {
                //Si il n'existe pas, il faut initialiser l'échéance

                $modelFtaProcessusDelai = new FtaProcessusDelaiModel();
                $modelFtaProcessusDelai->setModelFtaById($this->getKeyValue());
                $modelFtaProcessusDelai->setModelFtaProcessusById($modelFtaProcessusForCycle->getKeyValue());

                //Mise à jour du tableau
                $arrayModelFtaProcessusDelaiByIdProcessus[
                        $modelFtaProcessusForCycle->getDataField(FtaProcessusDelaiModel::FIELDNAME_ID_FTA_PROCESSUS)->getFieldValue()
                        ] = $modelFtaProcessusDelai;
            }

            //Récupération de la date d'échéance de la FTA définie pour ce processus
            if (($dateEcheanceFta == NULL or $dateEcheanceFta == "0000-00-00") and parent::getIsEditable()) {
                $modelFtaProcessusDelai->getDataField(FtaProcessusDelaiModel::FIELDNAME_DATE_ECHEANCE_PROCESSUS)->setFieldValue("");
            } else {

                $delai_jour = $WeekSinceFirstProcessus * ModuleConfig::DELAI_ECHEANCE_PROCESSUS_JOUR;
                $timestamp_date_echeance_fta = mktime(0, 0, 0, $mois_date_echeance_fta, $jour_date_echeance_fta - $delai_jour, $annee_date_echeance_fta);
                $dateDefaultEcheance = date("d-m-Y", $timestamp_date_echeance_fta);
                $modelFtaProcessusDelai->getDataField(FtaProcessusDelaiModel::FIELDNAME_DATE_ECHEANCE_PROCESSUS)->setFieldValue($dateDefaultEcheance);
            }

            $modelFtaProcessusDelai->saveToDatabase();

//            $arrayDataFieldEcheancesForProcessusCycle[] = $modelFtaProcessusDelai->getDataField(FtaProcessusDelaiModel::FIELDNAME_DATE_ECHEANCE_PROCESSUS);
            $arrayDataFieldEcheancesForProcessusCycle[] = $modelFtaProcessusDelai;
            //Construction des objets HTML de date
//            $labelEcheance = "Echéance pour " . $modelFtaProcessusDelai->getModelFtaProcessus()->getDataField(FtaProcessusModel::FIELDNAME_SERVICE)->getFieldValue() . ": ";
//            $dataFieldEcheance = $modelFtaProcessusDelai->getDataField(FtaProcessusDelaiModel::FIELDNAME_DATE_ECHEANCE_PROCESSUS);
//            $dataFieldEcheance->setLabelCustom($labelEcheance);
//
//            $HtmlElementEcheance = new DataFieldToHtmlInputCalendar($dataFieldEcheance);
//
//            $blocEcheanceLignes .= $HtmlElementEcheance->getHtmlResult();
        }

        return $arrayDataFieldEcheancesForProcessusCycle;
    }

    public function getArrayEmballageTypeUVC() {
        $this->setDonneeEmballageUVC($this->arrayEmballages(FtaConditionnementModel::EMBALLAGES_UVC));
    }

    public function getArrayEmballageTypeParColis() {
        $this->setDonneeEmballageParColis($this->arrayEmballages(FtaConditionnementModel::EMBALLAGES_PAR_COLIS));
    }

    public function getArrayEmballageTypeDuColis() {
        $this->setDonneeEmballageDuColis($this->arrayEmballages(FtaConditionnementModel::EMBALLAGES_DU_COLIS));
    }

    public function getArrayEmballageTypePalette() {
        $this->setDonneeEmballagePallette($this->arrayEmballages(FtaConditionnementModel::EMBALLAGES_PALETTE));
    }

    public function buildArrayEmballageTypeUVC() {
        if (!$this->getDonneeEmballageUVC()) {
            $this->getArrayEmballageTypeUVC();
        }
        return $this->getDonneeEmballageUVC();
    }

    public function buildArrayEmballageTypeParColis() {
        if (!$this->getDonneeEmballageParColis()) {
            $this->getArrayEmballageTypeParColis();
        }
        return $this->getDonneeEmballageParColis();
    }

    public function buildArrayEmballageTypeDuColis() {
        if (!$this->getDonneeEmballageDuColis()) {
            $this->getArrayEmballageTypeDuColis();
        }
        return $this->getDonneeEmballageDuColis();
    }

    public function buildArrayEmballageTypePalette() {
        if (!$this->getDonneeEmballagePallette()) {
            $this->getArrayEmballageTypePalette();
        }
        return $this->getDonneeEmballagePallette();
    }

    public function arrayEmballages($paramGroupeType) {
        $return = $this->poidsDesEmballagesColis();


        //Les calculs pour Emballages
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT
                        . ", " . FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT
                        . ", " . FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT
                        . "  FROM " . FtaConditionnementModel::TABLENAME . ", " . AnnexeEmballageGroupeModel::TABLENAME . ", " . AnnexeEmballageGroupeTypeModel::TABLENAME . " "
                        . " WHERE " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_FTA . "=" . $this->getKeyValue() . " "
                        . " AND " . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . "=" . $paramGroupeType . " "
                        . " AND " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE
                        . "=" . AnnexeEmballageGroupeModel::TABLENAME . "." . AnnexeEmballageGroupeModel::KEYNAME . " "
                        . " AND ( "
                        . "( " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                        . " IS NOT NULL AND " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE .
                        "=" . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . ")"
                        . " OR "
                        . "( " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                        . " IS NULL AND " . AnnexeEmballageGroupeModel::TABLENAME . "." . AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION
                        . "=" . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . ")"
                        . "    ) "
                        . " ORDER BY " . AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE
        );


        if ($paramGroupeType == AnnexeEmballageGroupeTypeModel::EMBALLAGE_DU_COLIS) {
            if (count($array) > 1) {
                $titre = UserInterfaceMessage::FR_WARNING_NOT_HANDLE_TITLE;
                $message = UserInterfaceMessage::FR_WARNING_EMBALLAGE_COLIS;
                Lib::showMessage($titre, $message, $redirection, TRUE);
            }
        }
        if ($paramGroupeType == AnnexeEmballageGroupeTypeModel::EMBALLAGE_PALETTE) {
            if (count($array) > 1) {
                $titre = UserInterfaceMessage::FR_WARNING_NOT_HANDLE_TITLE;
                $message = UserInterfaceMessage::FR_WARNING_EMBALLAGE_PALETTE;
                Lib::showMessage($titre, $message, $redirection, TRUE);
            }
        }


        if ($array) {
            foreach ($array as $rows) {

                // Calcul du poids de l'emballage  par UVC  
                $return[FtaConditionnementModel::UVC_EMBALLAGE] += FtaConditionnementModel::getCalculPoidsEmballage(
                                $rows[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT]
                                , $rows[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT]
                                , $rows[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT]
                );

                //Calcul des dimensions de l'emballage par UVC 
                $return[FtaConditionnementModel::UVC_EMBALLAGE_DIMENSION] = FtaConditionnementModel::getCalculDimensionEmballageUvc(
                                $return[FtaConditionnementModel::UVC_EMBALLAGE_DIMENSION_HAUTEUR]
                                , $rows[FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT]
                                , $return[FtaConditionnementModel::UVC_EMBALLAGE_DIMENSION_LONGEUR]
                                , $rows[FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT]
                                , $return[FtaConditionnementModel::UVC_EMBALLAGE_DIMENSION_LARGEUR]
                                , $rows[FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT]
                );
                $return[FtaConditionnementModel::UVC_EMBALLAGE_DIMENSION_HAUTEUR] = $rows[FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT];
                $return[FtaConditionnementModel::UVC_EMBALLAGE_DIMENSION_LONGEUR] = $rows[FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT];
                $return[FtaConditionnementModel::UVC_EMBALLAGE_DIMENSION_LARGEUR] = $rows[FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT];

                //Les Calculs de la table fta
                $arrayFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                "SELECT DISTINCT " . FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON . "," . FtaModel::FIELDNAME_POIDS_ELEMENTAIRE
                                . " FROM " . FtaModel::TABLENAME . " "
                                . " WHERE " . FtaModel::KEYNAME . "=" . $this->getKeyValue()
                );

                foreach ($arrayFta as $rowsFta) {

                    //Calcul du Poids net par UVC
                    $return[FtaConditionnementModel::UVC_EMBALLAGE_NET] = $rowsFta[FtaModel::FIELDNAME_POIDS_ELEMENTAIRE] * 1000;

                    //Calcul du PCB du colis
                    $return[FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON] = $rowsFta[FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON];
                }
                //Calcul du poids brut par UVC en g
                $return[FtaConditionnementModel::UVC_EMBALLAGE_BRUT] = FtaConditionnementModel::getCalculPoidsBrutEmballage(
                                $return[FtaConditionnementModel::UVC_EMBALLAGE_NET]
                                , $return[FtaConditionnementModel::UVC_EMBALLAGE]
                );

                //Calcul du poids de Emballages du Colis
//                $return[FtaConditionnementModel::COLIS_EMBALLAGE_TYPE_2] += FtaConditionnementModel::getCalculPoidsEmballage(
//                                $rows[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT]
//                                , $rows[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT]
//                                , $rows[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT]
//                );
                //Les calculs pour Emballages
                $arrayUVC1 = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                "SELECT " . FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT
                                . ", " . FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT
                                . ", " . FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT
                                . "  FROM " . FtaConditionnementModel::TABLENAME . ", " . AnnexeEmballageGroupeModel::TABLENAME . ", " . AnnexeEmballageGroupeTypeModel::TABLENAME . " "
                                . " WHERE " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_FTA . "=" . $this->getKeyValue() . " "
                                . " AND " . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . "=" . AnnexeEmballageGroupeTypeModel::EMBALLAGE_UVC . " "
                                . " AND " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE
                                . "=" . AnnexeEmballageGroupeModel::TABLENAME . "." . AnnexeEmballageGroupeModel::KEYNAME . " "
                                . " AND ( "
                                . "( " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                                . " IS NOT NULL AND " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE .
                                "=" . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . ")"
                                . " OR "
                                . "( " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                                . " IS NULL AND " . AnnexeEmballageGroupeModel::TABLENAME . "." . AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION
                                . "=" . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . ")"
                                . "    ) "
                                . " ORDER BY " . AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE
                );
                if ($arrayUVC1) {
                    foreach ($arrayUVC1 as $rowsUVC1) {
                        // Calcul du poids de l'emballage  par UVC  
                        $return[FtaConditionnementModel::UVC_EMBALLAGE_TYPE_1] += FtaConditionnementModel::getCalculPoidsEmballage(
                                        $rowsUVC1[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT]
                                        , $rowsUVC1[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT]
                                        , $rowsUVC1[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT]
                        );
                    }
                }



                //Les Calculs de la table composant        
                $arrayComposant = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                "SELECT " . FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION
                                . "," . FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION
                                . " FROM " . FtaComposantModel::TABLENAME
                                . " WHERE " . FtaComposantModel::FIELDNAME_ID_FTA . "=" . $this->getKeyValue()
                                . " AND " . FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT
                                . "=" . FtaConditionnementModel::EMBALLAGES_UVC
                );

                if ($arrayComposant) {
                    foreach ($arrayComposant as $rowsComposant) {

                        // Calcul du Poids net du colis
                        $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET] += FtaConditionnementModel::getCalculGenericMultiplication(
                                        $rowsComposant[FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION]
                                        , $rowsComposant[FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION]
                        );
                    }
                } else {
                    $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET] = "0";
                }

                // Calcul du Poids net du colis
                $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET] = $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET] / "1000"; //Conversion en g --> Kg
                if (!$return[FtaConditionnementModel::COLIS_EMBALLAGE_NET]) {
                    $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET] = FtaConditionnementModel::getCalculGenericMultiplication(
                                    $rowsFta[FtaModel::FIELDNAME_POIDS_ELEMENTAIRE]
                                    , $rowsFta[FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON]
                    );
                }



                //Les calculs pour Emballages
                $array3 = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                "SELECT " . FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT
                                . ", " . FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT
                                . ", " . FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT
                                . "  FROM " . FtaConditionnementModel::TABLENAME . ", " . AnnexeEmballageGroupeModel::TABLENAME . ", " . AnnexeEmballageGroupeTypeModel::TABLENAME . " "
                                . " WHERE " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_FTA . "=" . $this->getKeyValue() . " "
                                . " AND " . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . "=" . AnnexeEmballageGroupeTypeModel::EMBALLAGE_DU_COLIS . " "
                                . " AND " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE
                                . "=" . AnnexeEmballageGroupeModel::TABLENAME . "." . AnnexeEmballageGroupeModel::KEYNAME . " "
                                . " AND ( "
                                . "( " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                                . " IS NOT NULL AND " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE .
                                "=" . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . ")"
                                . " OR "
                                . "( " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                                . " IS NULL AND " . AnnexeEmballageGroupeModel::TABLENAME . "." . AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION
                                . "=" . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . ")"
                                . "    ) "
                                . " ORDER BY " . AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE
                );
                if ($array3) {
                    foreach ($array3 as $rows3) {
                        //Calcul du nombre de colis par couche
                        $return[FtaConditionnementModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE] = $rows3[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT];


                        //Calcul du nombre de couche par palette
                        $return[FtaConditionnementModel::PALETTE_NOMBRE_DE_COUCHE] = $rows3[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT];

                        //Hauteur du colis
                        $return[FtaConditionnementModel::COLIS_EMBALLAGE_HAUTEUR] = $rows3[FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT];

//                        $return[FtaConditionnementModel::COLIS_EMBALLAGE_TYPE_3] += $rows3[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT];
                    }
                }


                //Calcul du poids brut du Colis en Kg
                $return[FtaConditionnementModel::COLIS_EMBALLAGE_BRUT] = FtaConditionnementModel::getCalculPoidsBrutEmballageColis(
                                $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET]
                                , $return[FtaConditionnementModel::COLIS_EMBALLAGE]
                );


                //Calcul du Poids net par Palette
                $return[FtaConditionnementModel::PALETTE_EMBALLAGE_NET] = FtaConditionnementModel::getCalculPoidsEmballage(
                                $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET]
                                , $return[FtaConditionnementModel::PALETTE_NOMBRE_DE_COUCHE]
                                , $return[FtaConditionnementModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE])
                ;



                //Calcul de la hauteur par palette
                $return[FtaConditionnementModel::PALETTE_EMBALLAGE_HAUTEUR] = FtaConditionnementModel::getCalculHauteurEmballagePalette(
                                $return[FtaConditionnementModel::COLIS_EMBALLAGE_HAUTEUR]
                                , $return[FtaConditionnementModel::PALETTE_NOMBRE_DE_COUCHE]
                                , $rows[FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT]
                );

                //Calcul du nombre total de Carton par palette:
                $return[FtaConditionnementModel::PALETTE_NOMBRE_TOTAL_PAR_CARTON] = FtaConditionnementModel::getCalculGenericMultiplication(
                                $return[FtaConditionnementModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE]
                                , $return[FtaConditionnementModel::PALETTE_NOMBRE_DE_COUCHE]
                );
//                $return[FtaConditionnementModel::COLIS_EMBALLAGE] += FtaConditionnementModel::getCalculPoidsEmballage(
//                                $rows[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT]
//                                , $rows[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT]
//                                , $rows[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT]
//                );
                $return[FtaConditionnementModel::PALETTE_EMBALLAGE] += ($rows[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT] / "1000");
                //Calcul du poids de l'emballage par palette
                $return[FtaConditionnementModel::PALETTE_EMBALLAGE] += ($return[FtaConditionnementModel::COLIS_EMBALLAGE] / "1000") * ($return[FtaConditionnementModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE] * $return[FtaConditionnementModel::PALETTE_NOMBRE_DE_COUCHE] );
            }

            //Calcul Poids Brut  d'une Palette en Kg
            $return[FtaConditionnementModel::PALETTE_EMBALLAGE_BRUT] = FtaConditionnementModel::getCalculPoidsBrutEmballage(
                            $return[FtaConditionnementModel::PALETTE_EMBALLAGE_NET]
                            , $return[FtaConditionnementModel::PALETTE_EMBALLAGE]
            );
        } else {
            //Les Calculs de la table composant        
            $arrayComposant = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            "SELECT " . FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION
                            . "," . FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION
                            . " FROM " . FtaComposantModel::TABLENAME
                            . " WHERE " . FtaComposantModel::FIELDNAME_ID_FTA . "=" . $this->getKeyValue()
                            . " AND " . FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT
                            . "=" . FtaConditionnementModel::EMBALLAGES_UVC
            );

            if ($arrayComposant) {
                foreach ($arrayComposant as $rowsComposant) {

                    // Calcul du Poids net du colis
                    $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET] += FtaConditionnementModel::getCalculGenericMultiplication(
                                    $rowsComposant[FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION]
                                    , $rowsComposant[FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION]
                    );
                }
            } else {
                $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET] = "0";
            }

            // Calcul du Poids net du colis
            $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET] = $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET] / "1000"; //Conversion en g --> Kg
            if (!$return[FtaConditionnementModel::COLIS_EMBALLAGE_NET]) {
                $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET] = FtaConditionnementModel::getCalculGenericMultiplication(
                                $return[FtaModel::FIELDNAME_POIDS_ELEMENTAIRE]
                                , $return[FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON]
                );
            }

            //Les calculs pour Emballages
            $array3 = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            "SELECT " . FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT
                            . ", " . FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT
                            . ", " . FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT
                            . "  FROM " . FtaConditionnementModel::TABLENAME . ", " . AnnexeEmballageGroupeModel::TABLENAME . ", " . AnnexeEmballageGroupeTypeModel::TABLENAME . " "
                            . " WHERE " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_FTA . "=" . $this->getKeyValue() . " "
                            . " AND " . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . "=" . AnnexeEmballageGroupeTypeModel::EMBALLAGE_DU_COLIS . " "
                            . " AND " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE
                            . "=" . AnnexeEmballageGroupeModel::TABLENAME . "." . AnnexeEmballageGroupeModel::KEYNAME . " "
                            . " AND ( "
                            . "( " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                            . " IS NOT NULL AND " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE .
                            "=" . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . ")"
                            . " OR "
                            . "( " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                            . " IS NULL AND " . AnnexeEmballageGroupeModel::TABLENAME . "." . AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION
                            . "=" . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . ")"
                            . "    ) "
                            . " ORDER BY " . AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE
            );
            if ($array3) {
                foreach ($array3 as $rows3) {
                    //Calcul du nombre de colis par couche
                    $return[FtaConditionnementModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE] = $rows3[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT];


                    //Calcul du nombre de couche par palette
                    $return[FtaConditionnementModel::PALETTE_NOMBRE_DE_COUCHE] = $rows3[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT];

                    //Hauteur du colis
                    $return[FtaConditionnementModel::COLIS_EMBALLAGE_HAUTEUR] = $rows3[FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT];

//                        $return[FtaConditionnementModel::COLIS_EMBALLAGE_TYPE_3] += $rows3[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT];
                }
            }
            //Calcul du poids brut du Colis en Kg
            $return[FtaConditionnementModel::COLIS_EMBALLAGE_BRUT] = FtaConditionnementModel::getCalculPoidsBrutEmballageColis(
                            $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET]
                            , $return[FtaConditionnementModel::COLIS_EMBALLAGE]
            );


            //Calcul du Poids net par Palette
            $return[FtaConditionnementModel::PALETTE_EMBALLAGE_NET] = FtaConditionnementModel::getCalculPoidsEmballage(
                            $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET]
                            , $return[FtaConditionnementModel::PALETTE_NOMBRE_DE_COUCHE]
                            , $return[FtaConditionnementModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE])
            ;



            //Calcul de la hauteur par palette
            $return[FtaConditionnementModel::PALETTE_EMBALLAGE_HAUTEUR] = FtaConditionnementModel::getCalculHauteurEmballagePalette(
                            $return[FtaConditionnementModel::COLIS_EMBALLAGE_HAUTEUR]
                            , $return[FtaConditionnementModel::PALETTE_NOMBRE_DE_COUCHE]
                            , $rows[FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT]
            );

            //Calcul du nombre total de Carton par palette:
            $return[FtaConditionnementModel::PALETTE_NOMBRE_TOTAL_PAR_CARTON] = FtaConditionnementModel::getCalculGenericMultiplication(
                            $return[FtaConditionnementModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE]
                            , $return[FtaConditionnementModel::PALETTE_NOMBRE_DE_COUCHE]
            );
//                $return[FtaConditionnementModel::COLIS_EMBALLAGE] += FtaConditionnementModel::getCalculPoidsEmballage(
//                                $rows[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT]
//                                , $rows[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT]
//                                , $rows[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT]
//                );
            //Calcul du poids de l'emballage par palette
            $return[FtaConditionnementModel::PALETTE_EMBALLAGE] += ($return[FtaConditionnementModel::COLIS_EMBALLAGE] / "1000") * ($return[FtaConditionnementModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE] * $return[FtaConditionnementModel::PALETTE_NOMBRE_DE_COUCHE] );

            //Calcul Poids Brut  d'une Palette en Kg
            $return[FtaConditionnementModel::PALETTE_EMBALLAGE_BRUT] = FtaConditionnementModel::getCalculPoidsBrutEmballage(
                            $return[FtaConditionnementModel::PALETTE_EMBALLAGE_NET]
                            , $return[FtaConditionnementModel::PALETTE_EMBALLAGE]
            );
        }
        return $return;
    }

    public function poidsDesEmballagesColis() {
        //Les Calculs de la table fta
        $arrayFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT DISTINCT " . FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON . "," . FtaModel::FIELDNAME_POIDS_ELEMENTAIRE
                        . " FROM " . FtaModel::TABLENAME . " "
                        . " WHERE " . FtaModel::KEYNAME . "=" . $this->getKeyValue()
        );

        foreach ($arrayFta as $rowsFta) {

            //Calcul du Poids net par UVC
            $return[FtaConditionnementModel::UVC_EMBALLAGE_NET] = $rowsFta[FtaModel::FIELDNAME_POIDS_ELEMENTAIRE] * "1000";

            //Calcul du PCB du colis
            $return[FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON] = $rowsFta[FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON];
        }

        //Les calculs pour Emballages
        $arrayUVC1 = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT
                        . ", " . FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT
                        . ", " . FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT
                        . "  FROM " . FtaConditionnementModel::TABLENAME . ", " . AnnexeEmballageGroupeModel::TABLENAME . ", " . AnnexeEmballageGroupeTypeModel::TABLENAME . " "
                        . " WHERE " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_FTA . "=" . $this->getKeyValue() . " "
                        . " AND " . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . "=" . 1 . " "
                        . " AND " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE
                        . "=" . AnnexeEmballageGroupeModel::TABLENAME . "." . AnnexeEmballageGroupeModel::KEYNAME . " "
                        . " AND ( "
                        . "( " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                        . " IS NOT NULL AND " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE .
                        "=" . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . ")"
                        . " OR "
                        . "( " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                        . " IS NULL AND " . AnnexeEmballageGroupeModel::TABLENAME . "." . AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION
                        . "=" . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . ")"
                        . "    ) "
                        . " ORDER BY " . AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE
        );
        if ($arrayUVC1) {
            foreach ($arrayUVC1 as $rowsUVC1) {
                // Calcul du poids de l'emballage  par UVC  
                $return[FtaConditionnementModel::UVC_EMBALLAGE_TYPE_1] += FtaConditionnementModel::getCalculPoidsEmballage(
                                $rowsUVC1[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT]
                                , $rowsUVC1[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT]
                                , $rowsUVC1[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT]
                );
            }
        }

        //Les calculs pour Emballages
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT
                        . ", " . FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT
                        . ", " . FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT
                        . "  FROM " . FtaConditionnementModel::TABLENAME . ", " . AnnexeEmballageGroupeModel::TABLENAME . ", " . AnnexeEmballageGroupeTypeModel::TABLENAME . " "
                        . " WHERE " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_FTA . "=" . $this->getKeyValue() . " "
                        . " AND " . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . "=" . 2 . " "
                        . " AND " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE
                        . "=" . AnnexeEmballageGroupeModel::TABLENAME . "." . AnnexeEmballageGroupeModel::KEYNAME . " "
                        . " AND ( "
                        . "( " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                        . " IS NOT NULL AND " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE .
                        "=" . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . ")"
                        . " OR "
                        . "( " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                        . " IS NULL AND " . AnnexeEmballageGroupeModel::TABLENAME . "." . AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION
                        . "=" . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . ")"
                        . "    ) "
                        . " ORDER BY " . AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE
        );
        if ($array) {
            foreach ($array as $rows) {
                $return[FtaConditionnementModel::COLIS_EMBALLAGE] += FtaConditionnementModel::getCalculPoidsEmballage(
                                $rows[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT]
                                , $rows[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT]
                                , $rows[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT]
                );
            }
        }

        $return[FtaConditionnementModel::COLIS_EMBALLAGE] += $return[FtaConditionnementModel::UVC_EMBALLAGE_TYPE_1] * $return[FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON];

//Les calculs pour Emballages
        $array3 = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT
                        . ", " . FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT
                        . ", " . FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT
                        . "  FROM " . FtaConditionnementModel::TABLENAME . ", " . AnnexeEmballageGroupeModel::TABLENAME . ", " . AnnexeEmballageGroupeTypeModel::TABLENAME . " "
                        . " WHERE " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_FTA . "=" . $this->getKeyValue() . " "
                        . " AND " . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . "=" . 3 . " "
                        . " AND " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE
                        . "=" . AnnexeEmballageGroupeModel::TABLENAME . "." . AnnexeEmballageGroupeModel::KEYNAME . " "
                        . " AND ( "
                        . "( " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                        . " IS NOT NULL AND " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE .
                        "=" . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . ")"
                        . " OR "
                        . "( " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                        . " IS NULL AND " . AnnexeEmballageGroupeModel::TABLENAME . "." . AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION
                        . "=" . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . ")"
                        . "    ) "
                        . " ORDER BY " . AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE
        );
        if ($array3) {
            foreach ($array3 as $rows3) {
                $return[FtaConditionnementModel::COLIS_EMBALLAGE] += $rows3[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT];
            }
        }


        return $return;
    }

    public static function addIdFta($paramIdEffectue) {
        if ($paramIdEffectue) {
            foreach ($paramIdEffectue as $value) {
                $req .= " OR " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME . "='" . $value . "' ";
            }
        }
        return $req;
    }

    public static function addIdFtaLabel($paramIdEffectue) {
        if ($paramIdEffectue) {
            foreach ($paramIdEffectue as $value) {
                $req .= " OR " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME . "=" . $value[FtaModel::KEYNAME] . " ";
            }
        }
        return $req;
    }

    /**
     * On vérifie la valeur que le chef de projet à sélectionner con
     * @return boolean
     */
    function checkEtiquetteVerso() {
        $check = $this->getDataField(FtaModel::FIELDNAME_GESTION_ETIQUETTE_VERSO)->getFieldValue();
        if ($check) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Gestion des etiquette recto par le chef de projet
     * Si Aucun alors verrouiller sur Aucun au niveau de la qualité (étiquette composition)
     * Si A définir par l'étiquette composition alors les choix est libre à la qualité 
     * Si étiquette sélectionner alors verrouiller sur l'étiquette au niveau de la qualité
     * @return string 
     * 
     */
    function getHtmlGestionEtiquetteRecto() {
        $HtmlList = new HtmlListSelect();

        $arrayEtiquette = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . CodesoftEtiquettesModel::KEYNAME . ',' . CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES
                        . ' FROM ' . CodesoftEtiquettesModel::TABLENAME
                        . ' WHERE (' . CodesoftEtiquettesModel::FIELDNAME_K_SITE . '=' . $this->getDataField(FtaModel::FIELDNAME_SITE_PRODUCTION)->getFieldValue()
                        . ' OR ' . CodesoftEtiquettesModel::FIELDNAME_K_SITE . '=0)'
                        . ' AND (' . CodesoftEtiquettesModel::FIELDNAME_K_TYPE_ETIQUETTE_CODESOFT_ETIQUETTES . '=2'
                        . ' OR ' . CodesoftEtiquettesModel::FIELDNAME_K_TYPE_ETIQUETTE_CODESOFT_ETIQUETTES . '=0' . ')'
                        . ' AND ' . CodesoftEtiquettesModel::FIELDNAME_IS_ENABLED_FTA . '=1'
                        . ' ORDER BY ' . CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES
        );

        $arrayEtiquetteGestion = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . AnnexeGestionEtiquetteRectoVersoModel::KEYNAME . ',' . AnnexeGestionEtiquetteRectoVersoModel::FIELDNAME_NOM_ANNEXE_ETIQUETTE_RECTO_VERSO
                        . ' FROM ' . AnnexeGestionEtiquetteRectoVersoModel::TABLENAME
        );

        $arrayComplete = $arrayEtiquetteGestion + $arrayEtiquette;

        $HtmlList->setArrayListContent($arrayComplete);

        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_GESTION_ETIQUETTE_RECTO
                . '_'
                . $this->getKeyValue()
        ;

        /**
         * Champ verrouillable condition
         */
        /**
         * Vérification du champ initialisé
         */
        $isFieldLock = FtaVerrouillageChampsModel::isFieldLock(FtaModel::FIELDNAME_GESTION_ETIQUETTE_RECTO, $this);
        /**
         * Génération du lien pour verrouillé/déverrouillé
         */
        $linkFieldLock = FtaVerrouillageChampsModel::linkFieldLock($isFieldLock, FtaModel::FIELDNAME_GESTION_ETIQUETTE_RECTO, $this, $this->getIsEditable());

        /**
         * Affectation de la modification d'un champ ou non
         */
        $isEditable = FtaVerrouillageChampsModel::isEditableLockField($isFieldLock, $this->getIsEditable());

        $gestionEtiquetteRectoDataField = $this->getDataField(FtaModel::FIELDNAME_GESTION_ETIQUETTE_RECTO);

        $HtmlList->getAttributes()->getName()->setValue(FtaModel::FIELDNAME_GESTION_ETIQUETTE_RECTO);
        $HtmlList->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_GESTION_ETIQUETTE_RECTO));
        $HtmlList->setIsEditable($isEditable);
        $HtmlList->initAbstractHtmlSelect(
                $HtmlTableName
                , $HtmlList->getLabel()
                , $gestionEtiquetteRectoDataField->getFieldValue()
                , $gestionEtiquetteRectoDataField->isFieldDiff()
                , $HtmlList->getArrayListContent()
                , NULL
                , NULL
                , $isFieldLock
                , $linkFieldLock
        );
        $HtmlList->getEventsForm()->setOnChangeWithAjaxAutoSave(
                FtaModel::TABLENAME
                , FtaModel::KEYNAME
                , $this->getKeyValue()
                , FtaModel::FIELDNAME_GESTION_ETIQUETTE_RECTO
        );

        /**
         * Description d'un champ
         */
        $HtmlList->setHelp(IntranetColumnInfoModel::getFieldDesc($gestionEtiquetteRectoDataField->getTableName(), $gestionEtiquetteRectoDataField->getFieldName()
                        , $gestionEtiquetteRectoDataField->getFieldLabel(), $HtmlList
        ));

        $listeCodesoftEtiquettes = $HtmlList->getHtmlResult();

        return $listeCodesoftEtiquettes;
    }

    /**
     * Gestion des etiquette recto par le chef de projet
     * Si Auncun alors verrouiller sur Auncun au niveau de la qualité (étiquette composition)
     * Si A définir par l'étiquette composition alors les choix est libre à la qualité 
     * Si étiquette sélectionner alors verrouiller sur l'étiquette au niveau de la qualité
     * @return string 
     * 
     */
    function getHtmlGestionEtiquetteVerso() {
        $HtmlList = new HtmlListSelect();


        $arrayEtiquette = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . CodesoftEtiquettesModel::KEYNAME . ',' . CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES
                        . ' FROM ' . CodesoftEtiquettesModel::TABLENAME
                        . ' WHERE (' . CodesoftEtiquettesModel::FIELDNAME_K_SITE . '=' . $this->getDataField(FtaModel::FIELDNAME_SITE_PRODUCTION)->getFieldValue()
                        . ' OR ' . CodesoftEtiquettesModel::FIELDNAME_K_SITE . '=0)'
                        . ' AND (' . CodesoftEtiquettesModel::FIELDNAME_K_TYPE_ETIQUETTE_CODESOFT_ETIQUETTES . '=3'
                        . ' OR ' . CodesoftEtiquettesModel::FIELDNAME_K_TYPE_ETIQUETTE_CODESOFT_ETIQUETTES . '=0' . ')'
                        . ' AND ' . CodesoftEtiquettesModel::FIELDNAME_IS_ENABLED_FTA . '=1'
                        . ' ORDER BY ' . CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES
        );

        $arrayEtiquetteGestion = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . AnnexeGestionEtiquetteRectoVersoModel::KEYNAME . ',' . AnnexeGestionEtiquetteRectoVersoModel::FIELDNAME_NOM_ANNEXE_ETIQUETTE_RECTO_VERSO
                        . ' FROM ' . AnnexeGestionEtiquetteRectoVersoModel::TABLENAME
        );

        $arrayComplete = $arrayEtiquetteGestion + $arrayEtiquette;

        $HtmlList->setArrayListContent($arrayComplete);

        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_GESTION_ETIQUETTE_VERSO
                . '_'
                . $this->getKeyValue()
        ;
        /**
         * Champ verrouillable condition
         */
        /**
         * Vérification du champ initialisé
         */
        $isFieldLock = FtaVerrouillageChampsModel::isFieldLock(FtaModel::FIELDNAME_GESTION_ETIQUETTE_VERSO, $this);
        /**
         * Génération du lien pour verrouillé/déverrouillé
         */
        $linkFieldLock = FtaVerrouillageChampsModel::linkFieldLock($isFieldLock, FtaModel::FIELDNAME_GESTION_ETIQUETTE_VERSO, $this, $this->getIsEditable());

        /**
         * Affectation de la modification d'un champ ou non
         */
        $isEditable = FtaVerrouillageChampsModel::isEditableLockField($isFieldLock, $this->getIsEditable());

        $gestionEtiquetteVersoDataField = $this->getDataField(FtaModel::FIELDNAME_GESTION_ETIQUETTE_VERSO);

        $HtmlList->getAttributes()->getName()->setValue(FtaModel::FIELDNAME_GESTION_ETIQUETTE_VERSO);
        $HtmlList->setLabel(DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_GESTION_ETIQUETTE_VERSO));
        $HtmlList->setIsEditable($isEditable);
        $HtmlList->initAbstractHtmlSelect(
                $HtmlTableName
                , $HtmlList->getLabel()
                , $gestionEtiquetteVersoDataField->getFieldValue()
                , $gestionEtiquetteVersoDataField->isFieldDiff()
                , $HtmlList->getArrayListContent()
                , NULL
                , NULL
                , $isFieldLock
                , $linkFieldLock
        );
        $HtmlList->getEventsForm()->setOnChangeWithAjaxAutoSave(
                FtaModel::TABLENAME
                , FtaModel::KEYNAME
                , $this->getKeyValue()
                , FtaModel::FIELDNAME_GESTION_ETIQUETTE_VERSO
        );

        /**
         * Description d'un champ
         */
        $HtmlList->setHelp(IntranetColumnInfoModel::getFieldDesc($gestionEtiquetteVersoDataField->getTableName(), $gestionEtiquetteVersoDataField->getFieldName()
                        , $gestionEtiquetteVersoDataField->getFieldLabel(), $HtmlList
        ));


        $listeCodesoftEtiquettes = $HtmlList->getHtmlResult();

        return $listeCodesoftEtiquettes;
    }

    /**
     * Cette fonction permet de dupliquer une Fiche Technique Article pour faire les actions suivantes:

      $action
      -------
      "totale":       Créer un nouveau dossier en recopiant l'intégralité de la fiche d'origine
      "selective":(pas géré)    Créer un nouveau dossier en ne recopiant que certains processus
      "version":      Créer une nouvelle fiche au sein du même dossier

      $option:
      --------
      - Dans le cas d'une duplication "selective", cette variable contient le tableau des id_processus des processus sélectionnés
      - Dans le cas d'une duplication "version", cette variable contient le nouvel état de la FTA (I, A, ...).
      Si vide, alors l'état par défaut sera de type I, initialisation

      Retour de la fonction:
      ----------------------
      La fonction renvoi l'id_fta nouvellement créé.
     * @param int $paramIdFta
     * @param string $paramAction
     * @param array $paramOption
     * @param int $paramIdFtaWorkflow
     * @return int
     */
    public static function buildDuplicationFta($paramIdFta, $paramAction, $paramOption, $paramIdFtaWorkflow) {

        /*         * ****************************************
          Déclaration et initialisation des variables
         * **************************************** */
        $globalConfig = new GlobalConfig();
        UserModel::checkUserSessionExpired($globalConfig);

        $idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
        $ftaModelOrig = new FtaModel($paramIdFta);              //Identifiant de la fiche technique article à dupliquer
        if ($paramOption["id_version_dossier_fta"]) {
            $idFtaVersion = $paramOption["id_version_dossier_fta"];
        } else {
            $idFtaVersion = $ftaModelOrig->getDataField(FtaModel::FIELDNAME_VERSION_DOSSIER_FTA)->getFieldValue();
        }
        $idFtaOriginal = $paramIdFta;                //Sauvegarde de la clef initiale.
        $paramOption["abreviation_etat_destination"]; //Etat vers lequel doit aller la FTA
        $paramOption["selection_chapitre"];           //Tableau contenant les id_fta_chapitre des chapitres à corriger
        $paramOption["designation_commerciale_fta"];  //Nouveau nom commerciale de la FTA
        $paramOption["site_de_production"];  //Nouveau site de production de la FTA
        $paramOption["nouveau_maj_fta"];              //Nouveau commentaire de la nouvelle FTA
        $paramOption["id_version_dossier_fta"];              //Id dossier version maximun

        switch ($paramAction) {
            case "version":

                //récupération de l'identifiant de l'état
                if ($paramOption["abreviation_etat_destination"] == "") {
                    //Si aucun Etat n'a été donné, l'état   Intialisation est choisi par défaut
                    $paramOption["abreviation_etat_destination"] = "I";
                }
                $arrayIdFtaEtat = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                "SELECT " . FtaEtatModel::KEYNAME
                                . " FROM " . FtaEtatModel::TABLENAME
                                . " WHERE " . FtaEtatModel::FIELDNAME_ABREVIATION . "='" . $paramOption["abreviation_etat_destination"] . "'"
                );
                foreach ($arrayIdFtaEtat as $value) {
                    $idFtaEtatNew = $value[FtaEtatModel::KEYNAME];
                }
        }

        /*         * *****************************************************************************
          Traitement Principal
         * ****************************************************************************** */



        /*         * *************************
          Traitement de la table "fta"
         * ************************* */


        $idFtaNew = FtaModel::duplicationIdFta($paramIdFta);                                                                                    //Récupération de la nouvelle clef
        /*
         * Enregsitrement des mises à jour
         */

        if (!$paramOption["site_de_production"]) {
            $paramOption["site_de_production"] = "NULL";
        }
        DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_DATE_CREATION . "='" . date("Y-m-d")                                                               //Date de la création de cet Article
                . "', " . FtaModel::FIELDNAME_ACTIF . "=" . 0                                                                                   //Tant que la fiche n'est pas activée, la flag reste à 0.
                . ", " . FtaModel::FIELDNAME_CODE_ARTICLE . "=" . 'NULL'                                                                       //Le Code Article Agrologic ne peut être présent 2 fois (index unique)               
                . ", " . FtaModel::FIELDNAME_WORKFLOW . "=" . $paramIdFtaWorkflow
                . ", " . FtaModel::FIELDNAME_SITE_PRODUCTION . "=" . $paramOption["site_de_production"]
                . " WHERE " . FtaModel::KEYNAME . "=" . $idFtaNew
        );
        switch ($paramAction) {                                                                                                                 //Suivant l'action, certaines données sont à mettre à jour
            /*
             * //Création d'un nouveau dossier
             */
            case "totale":

                DatabaseOperation::execute(
                        "UPDATE " . FtaModel::TABLENAME
                        . " SET " . FtaModel::FIELDNAME_DOSSIER_FTA . "=" . $idFtaNew                                                           //Dans le cas d'un nouveau dossier, son identifiant correspond à l'identifiant de sa première FTA
                        . ", " . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA . "=" . 0                                                              //La première FTA commence en version "0"
                        . ", " . FtaModel::FIELDNAME_ID_FTA_ETAT . "=" . 1                                                                      //La première FTA commence en état "Initialisation"  (cf. table fta_etat)
                        . ", " . FtaModel::FIELDNAME_ARTICLE_AGROLOGIC . "=" . 0
                        . ", " . FtaModel::FIELDNAME_DATE_ECHEANCE_FTA . "=" . "0000-00-00"                                                                   //La date d'échéance sera définie sur la page de transition
                        . ", " . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE . "=\"" . $paramOption["designation_commerciale_fta"]                //Renommage de la nouvelle FTA
                        . "\", " . FtaModel::FIELDNAME_NOM_ABREGE . "=" . "NULL"                                                                  //Le nom abrégé est réinitilisé
                        . ", " . FtaModel::FIELDNAME_LIBELLE . "=" . "NULL"                                                                       //Dans le cas d'un nouveau dossier, son identifiant correspond à l'identifiant de sa première FTA
                        . ", " . FtaModel::FIELDNAME_CODE_ARTICLE_LDC . "=" . "0"                                                              //Suppression Code LDC
                        . ", " . FtaModel::FIELDNAME_EAN_COLIS . "=" . "0"                                                                     //Suppression EAN Colis
                        . ", " . FtaModel::FIELDNAME_EAN_UVC . "=" . "0"                                                                       //Suppression EAN Article
                        . ", " . FtaModel::FIELDNAME_EAN_PALETTE . "=" . "0"                                                                   //Suppression EAN Palette
                        . ", " . FtaModel::FIELDNAME_POURCENTAGE_AVANCEMENT . "=" . "\"0%\""                                                                   //Suppression EAN Palette
                        . ", " . FtaModel::FIELDNAME_CREATEUR . "=" . $idUser
                        . ", " . FtaModel::FIELDNAME_LISTE_ID_FTA_ROLE . "=" . "NULL"
                        . " WHERE " . FtaModel::KEYNAME . "=" . $idFtaNew
                );
                break;
            /*
             *  //Création d'une nouvelle version de la FTA
             */
            case "version":
                $idFtaVersion = $idFtaVersion + 1;
                DatabaseOperation::execute(
                        "UPDATE " . self::TABLENAME
                        . " SET " . self::FIELDNAME_VERSION_DOSSIER_FTA . "=\"" . $idFtaVersion                                                       //La première FTA commence en version "0"
                        . "\", " . self::FIELDNAME_ID_FTA_ETAT . "=\"" . $idFtaEtatNew                                                          //Nouvel éta de la FTA données par l'argument $option de la fonction (cf. table fta_etat)
                        . "\", " . self::FIELDNAME_DATE_ECHEANCE_FTA . "=\"" . $paramOption["date_echeance_fta"]
                        //Nouvel éta de la FTA données par l'argument $option de la fonction (cf. table fta_etat)
                        . "\" WHERE " . self::KEYNAME . "=" . $idFtaNew
                );
                break;
        }




        /*         * ***************************
          Traitement des tables esclaves
         * *************************** */

        /*         * ******************************************************************************************
          Les tables esclaves sont des tables contenant le champ "id_fta" dans la liste de leurs champs
         * ****************************************************************************************** */

        FtaComposantModel::duplicateFtaComposantByIdFta($idFtaOriginal, $idFtaNew);
        FtaConditionnementModel::duplicateFtaConditionnementByIdFta($idFtaOriginal, $idFtaNew);
        FtaSuiviProjetModel::duplicateFtaSuiviProjetByIdFta($idFtaOriginal, $idFtaNew);
        // ClassificationFtaModel::DuplicateFtaClassificationByIdFta($idFtaOriginal, $idFtaNew);


        /*
          - Récupérér les composants de la nouvelle FTA
          - Pour chaque produit (id_fta_nomenclature)
          - Récupérer l'identifiant de la version précédente (noté: [last_id_fta_nomenclature])
          - Sur la FTA précédente, retrouver l'identifiant composant associé à cette ancienne version du produit (noté: [last_id_fta_composant])
          - Sur le nouvelle FTA, retrouver l'identifiant composant associé à ce [last_id_fta_composant]
          - Sur ce nouveau composant, remplacer l'association nomenclature par [id_fta_nomenclature]
         */

        /*         * *****************************************************************************
          Traitement POST
         * ****************************************************************************** */
        switch ($paramAction) {
            case "version":
                $newAbreviationFtaEtat = $paramOption["abreviation_etat_destination"]; //Nouvel état
                //Récupération de la liste des chapitres a dévalider
                $selection_chapitre = $paramOption["selection_chapitre"];
                $paramOption["no_message_ecran"] = 1;
                $paramOption["mail_gestionnaire"] = 1;
                if ($selection_chapitre) {
                    foreach ($selection_chapitre as $id_fta_chapitre) {

                        //Correction des chapitres

                        $paramOption["correction_fta_suivi_projet"] = $paramOption["nouveau_maj_fta"];
                        FtaChapitreModel::buildCorrectionChapitre($idFtaNew, $id_fta_chapitre, $paramOption);
                    }
                }

                /*
                 * Cette fonction est mise en pause car elle nécessite la création de processus cycle pour chaque workflow,
                 * questionnement à boris.
                 */
                if ($newAbreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION and ! $selection_chapitre) {//Suppression des validations
                    //Recherche des chapitres affectés au cycle de vie correspondant à l'état
                    $arrayCycle = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                    "SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . "," . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                    . " FROM " . FtaProcessusCycleModel::TABLENAME . ", " . FtaWorkflowStructureModel::TABLENAME
                                    . " WHERE " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='" . $newAbreviationFtaEtat               //Etat du cycle
                                    . "' AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                    . "=" . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT   //Jointure
                                    . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                    . "=" . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW     //Jointure
                                    . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . "=" . $paramIdFtaWorkflow
                    );

                    if ($arrayCycle) {  //Si ce cycle de vie necessite l'intervention de processus, alors                            //On supprime la validation du suivi de projet des processus concernés
                        $req = "DELETE FROM " . FtaSuiviProjetModel::TABLENAME . " WHERE ";
                        $or = " ";
                        foreach ($arrayCycle as $rowsCycle) {

                            //Vérification qu'il ne s'agissent pas du processus initiateur du nouveau cycle de vie
                            $arrayFirst = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                            "SELECT " . FtaSuiviProjetModel::KEYNAME
                                            . " FROM " . FtaProcessusCycleModel::TABLENAME . ", " . FtaWorkflowStructureModel::TABLENAME . ", " . FtaSuiviProjetModel::TABLENAME
                                            . " WHERE " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='" . $newAbreviationFtaEtat        //Etat du cycle
                                            . "' AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                            . "=" . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT     //Jointure
                                            . " AND " . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                            . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE              //Jointure
                                            . " AND " . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA . "='" . $idFtaNew . "' "                                  //Nouvelle FTA
                                            . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT . "='" . $rowsCycle[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT] . "' "//Est-ce le premier processus ?
                            );

                            if ($arrayFirst) {//Si il ne s'agit pas du chapitre appartenant au processus initial, on supprime
                                $req.=$or . "(" . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . "='" . $rowsCycle[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE]
                                        . "' AND " . FtaSuiviProjetModel::FIELDNAME_ID_FTA . "='" . $idFtaNew . "') ";
                                $or = " OR ";
                            } else {

                                //Sinon, Supprimer uniquement la validation et on notifie les chapitres
                                $req_update = "UPDATE " . FtaSuiviProjetModel::TABLENAME
                                        . " SET " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "=''"
                                        . ", " . FtaSuiviProjetModel::FIELDNAME_DATE_VALIDATION_SUIVI_PROJET . "=''"
                                        . ", " . FtaSuiviProjetModel::FIELDNAME_DATE_DEMARRAGE_CHAPITRE_FTA_SUIVI_PROJET . "=''"
                                        . ", " . FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET . "='1' "
                                        . " WHERE (" . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . "='" . $rowsCycle[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE]
                                        . "' AND " . FtaSuiviProjetModel::FIELDNAME_ID_FTA . "='" . $idFtaNew . "') "
                                ;
                                DatabaseOperation::execute($req_update);
                            }
                        }
                        DatabaseOperation::execute($req);
                    }
                    //Fin de Recherche des notifications relatives aux processus trouvées
                }//Fin de la dévalidation suite à une initialisation
                //Vérrouillage des chapitre ne correspondant pas au cycle de vie.
                if ($newAbreviationFtaEtat == "P") {
                    //Condition where
                    $where = "";

                    //Récupération des chapitres concernés par ce cycle de vie
                    $arrayCycle2 = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                    "SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                                    . " FROM " . FtaProcessusCycleModel::TABLENAME
                                    . " WHERE " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . " = '" . $newAbreviationFtaEtat . "' "
                    );

                    foreach ($arrayCycle2 as $rowsCycle2) {
                        $where .= " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME . " <> " . $rowsCycle2[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT];
                    }

                    //Récupération des chapitres à vérrouiller
                    $arrayChapitreVerrouiller = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                    "SELECT DISTINCT  " . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                    . " FROM " . FtaProcessusModel::TABLENAME . ", " . FtaWorkflowStructureModel::TABLENAME
                                    . " WHERE ( " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                                    . " = " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE . " ) "
                                    . " AND ( (  " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                                    . " <>1 $where ) )"
                                    . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . " = " . $paramIdFtaWorkflow
                    );

                    foreach ($arrayChapitreVerrouiller as $rowsChapitreVerrouiller) {
                        //Le suivi existe-il déjà ?
                        $arrayFtaSuiviProjet = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                        "SELECT " . FtaSuiviProjetModel::KEYNAME . ", " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET
                                        . " FROM " . FtaSuiviProjetModel::TABLENAME
                                        . " WHERE " . FtaSuiviProjetModel::FIELDNAME_ID_FTA . "='" . $idFtaNew
                                        . "' AND " . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . "='" . $rowsChapitreVerrouiller[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE] . "' "
                        );

                        if ($arrayFtaSuiviProjet) {
                            //Mise à jour de l'existant si il n'y a pas de vérrou existant
                            foreach ($arrayFtaSuiviProjet as $rowsFtaSuiviProjet) {
                                if (!$rowsFtaSuiviProjet[FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET]) {
                                    $idFtaSuiviProjet = $rowsFtaSuiviProjet[FtaSuiviProjetModel::KEYNAME];
                                    $req = "UPDATE " . FtaSuiviProjetModel::TABLENAME
                                            . "SET " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "='-1' "
                                            . "WHERE " . FtaSuiviProjetModel::KEYNAME . "='" . $idFtaSuiviProjet . "' "
                                    ;
                                    DatabaseOperation::execute($req);
                                }
                            }
                        } else {

                            //Création des suivi
                            $req = "INSERT " . FtaSuiviProjetModel::TABLENAME
                                    . " SET " . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . "='" . $rowsChapitreVerrouiller[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE]
                                    . "', " . FtaSuiviProjetModel::FIELDNAME_ID_FTA . "='" . $idFtaNew
                                    . "', " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "='-1' "
                            ;
                            DatabaseOperation::execute($req);
                        }
                    }
                }

                break;
//Fin du post-traitement dans le cas d'une duplication de type "version"

            case "totale":

                $newAbreviationFtaEtat = $paramOption["abreviation_etat_destination"]; //Nouvel état
                //Suppression de tout le suivi de dossier
                $req = "DELETE FROM " . FtaSuiviProjetModel::TABLENAME
                        . " WHERE " . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA . "='" . $idFtaNew . "' "                                  //Nouvelle FTA
                ;
                DatabaseOperation::execute($req);

                break;
        }//Fin du post-traitement dans le cas d'une duplication de type "totale"
        return $idFtaNew;
    }

    /**
     * Duplication d'une Fta
     * @param int $paramIdFta
     * @return int
     */
    public static function duplicationIdFta($paramIdFta) {

        $key = FtaController::duplicateId(self::TABLENAME, $paramIdFta);

        return $key;
    }

    /**
     * Cette fonction retourne le nom DIN, Désignation Interne Normalisée d'une FTA
     * @param type $paramIdFta
     * @return type
     */
    public static function showDin($paramIdFta) {

        /*
         * Déclaration des variables
         */
        $ftaModel = new FtaModel($paramIdFta);
        $codeArticleLDC = $ftaModel->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue();
        $IdDossierFta = $ftaModel->getDataField(FtaModel::FIELDNAME_DOSSIER_FTA)->getFieldValue();
        $IdVersionDossierFta = $ftaModel->getDataField(FtaModel::FIELDNAME_VERSION_DOSSIER_FTA)->getFieldValue();
        $Libelle = $ftaModel->getDataField(FtaModel::FIELDNAME_LIBELLE)->getFieldValue();
        $designationCommercialeFta = $ftaModel->getDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE)->getFieldValue();


        /*
         * Règle d'intégrité
         */
        $din = "";

        /*
         * Code
         */
        if ($codeArticleLDC) {
            $din.= $codeArticleLDC;
        } else {
            $din.= $IdDossierFta . "v" . $IdVersionDossierFta;
        }

        $din.=" - ";

        /*
         * Désignation
         */
        if (!$Libelle) {
            /*
             * Il manque des informaions necessaires à la construction du DIN
             */
            $din.= $designationCommercialeFta;
        } else {
            /*
             * DIN - Désignation Interne Normalisée
             */
            $din.= $Libelle;
        }

        return $din;
    }

    /**
     * On calcule la durée de vie client en fonction de la durée de vie en production
     * enrondie à l'entier inférieur 
     * @return string
     */
    function getDureeDeVieClientByDureeDeVieProduction() {
        $dureeDeVieProductionValue = $this->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION)->getFieldValue();
        if ($dureeDeVieProductionValue) {
            $dureeDeVieProductionValue = FtaController::getTwoOfThreeValue($dureeDeVieProductionValue);
        } else {
            $dureeDeVieProductionValue = UserInterfaceMessage::FR_CALCUL_DUREE_DE_VIE_EN_ATTENTE;
        }
        return $dureeDeVieProductionValue;
    }

    /**
     * Fonction d"insertion d'une Fta
     * @param int $paramIdCreateur
     * @param int $paramIdFtaEtat
     * @param int $paramIdFtaWorkflow
     * @param string $paramDesignationCommerciale
     * @param date $paramDateCreation
     * @param int $paramSiteDeProduction
     * @return int
     */
    public static function createFta($paramIdCreateur, $paramIdFtaEtat, $paramIdFtaWorkflow, $paramDesignationCommerciale, $paramDateCreation, $paramSiteDeProduction) {
        $Id = DatabaseOperation::executeComplete(
                        "INSERT INTO " . FtaModel::TABLENAME
                        . " ( " . FtaModel::FIELDNAME_CREATEUR
                        . "," . FtaModel::FIELDNAME_ID_FTA_ETAT
                        . "," . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE
                        . "," . FtaModel::FIELDNAME_DATE_CREATION
                        . "," . FtaModel::FIELDNAME_SITE_PRODUCTION
                        . "," . FtaModel::FIELDNAME_WORKFLOW . ")"
                        . " VALUES (" . $paramIdCreateur
                        . ", " . $paramIdFtaEtat
                        . ", '" . addslashes($paramDesignationCommerciale)
                        . "', " . $paramDateCreation
                        . ", " . $paramSiteDeProduction
                        . ", " . $paramIdFtaWorkflow . ")"
        );
        $key = $Id->lastInsertId();
        return $key;
    }

    /**
     * Mise à jour du pourcentage d'avancement d'un Fta
     */
    public function updateAvancementFta() {

        $idFta = $this->getKeyValue();
        $idFtaWorkflow = $this->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
        /**
         * Recalcul + stockage % Avancement
         */
        $taux_temp = FtaSuiviProjetModel::getArrayFtaTauxValidation($this, FALSE);
        $recap[$idFta] = round($taux_temp['0'] * '100', '0') . '%';
        $this->getDataField(FtaModel::FIELDNAME_POURCENTAGE_AVANCEMENT)->setFieldValue($recap[$idFta]);

        /**
         * Recalcul + stockage liste des services
         */
        $listeIdRole = FtaRoleModel::getListeIdFtaRoleEncoursByIdFta($idFta, $idFtaWorkflow);
        $this->getDataField(FtaModel::FIELDNAME_LISTE_ID_FTA_ROLE)->setFieldValue($listeIdRole);
        $this->saveToDatabase();
    }

    /**
     * Tableau des idFta et de l'id de l'etat selon le dossier Fta
     * @param int $paramIdDossierFta
     * @return array
     */
    public static function getArrayIdFtaByIdDossierFta($paramIdDossierFta) {
        $arrayIdFtaChange = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . FtaModel::KEYNAME
                        . "," . FtaModel::FIELDNAME_ID_FTA_ETAT
                        . " FROM " . FtaModel::TABLENAME
                        . " WHERE " . FtaModel::FIELDNAME_DOSSIER_FTA . "=" . $paramIdDossierFta
        );
        return $arrayIdFtaChange;
    }

    /**
     * Tableau des idFta et de l'id de l'etat selon le dossier primaire Fta
     * @param int $paramIdDossierPrimaireFta
     * @return array
     */
    public static function getArrayIdFtaByIdDossierPrimaryFta($paramIdDossierPrimaireFta) {
        $arrayIdFtaChange = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . FtaModel::KEYNAME
                        . "," . FtaModel::FIELDNAME_ID_FTA_ETAT
                        . " FROM " . FtaModel::TABLENAME
                        . " WHERE " . FtaModel::FIELDNAME_DOSSIER_FTA_PRIMAIRE . "=" . $paramIdDossierPrimaireFta
        );
        return $arrayIdFtaChange;
    }

    /**
     * Affiche le commentaire d'un changement d'état de la Fta
     * @return string
     */
    function getHtmlCommentaireMajFta() {
        $HtmlTableName = self::TABLENAME
                . '_'
                . self::FIELDNAME_COMMENTAIRE_MAJ_FTA
                . '_'
                . $this->getKeyValue()
        ;
        $htmlTextAreaResult = "<td><textarea id=\"" . $HtmlTableName
                . "\" cols=\"140\" rows=\"10\" name=\"" . $HtmlTableName
                . "\" rows=15></textarea></td>";
        return $htmlTextAreaResult;
    }

    /**
     * Affiche la date d'échéance
     * @param boolean $paramUpdateFta
     * @return string
     */
    function getHtmlDateEcheance($paramUpdateFta) {
        $htmlInputCalendar = new HtmlInputCalendar();
        $dataFieldDateEcheance = $this->getDataField(self::FIELDNAME_DATE_ECHEANCE_FTA);
        /**
         * Contrôle de la date d'échéance
         */
        $dateEcheValue = $this->checkDateEcheance($paramUpdateFta);

        /**
         * Changement du format de date
         */
        if (!$this->getIsEditable()) {
            $dateEcheValue = FtaController::changementDuFormatDeDateFR($dateEcheValue);
        }
        /**
         * Mise en forme
         */
        $HtmlTableName = self::TABLENAME
                . '_'
                . self::FIELDNAME_DATE_ECHEANCE_FTA
                . '_'
                . $this->getKeyValue()
        ;
        $htmlInputCalendar->setIsEditable($this->getIsEditable());

        $htmlInputCalendar->initAbstractHtmlInput(
                $HtmlTableName
                , $dataFieldDateEcheance->getFieldLabel()
                , $dateEcheValue
                , $dataFieldDateEcheance->isFieldDiff()
        );
        $htmlInputCalendar->getEventsForm()->setOnChangeWithAjaxAutoSave(
                $dataFieldDateEcheance->getTableName()
                , $dataFieldDateEcheance->getKeyName()
                , $dataFieldDateEcheance->getKeyValue()
                , $dataFieldDateEcheance->getFieldName()
        );
        $htmlInputCalendar->setHtmlResultOnClick();

        return $htmlInputCalendar->getHtmlResult();
    }

    /**
     * Contrôle de la date d'échéance
     * @param boolean $paramUpdateFta
     * @return string
     */
    function checkDateEcheance($paramUpdateFta) {
        $dataFieldDateEcheance = $this->getDataField(self::FIELDNAME_DATE_ECHEANCE_FTA);
        /**
         * Contrôle de la date d'échéance
         */
        $dateEcheanceValue = $dataFieldDateEcheance->getFieldValue();

        if ($this->getIsEditable() and ( $dateEcheanceValue == self::CHECK_DATE_ECHANCE2 or $dateEcheanceValue == self::CHECK_DATE_ECHANCE or ! $dateEcheanceValue or $paramUpdateFta)) {
            switch ($this->getDataField(self::FIELDNAME_VERSION_DOSSIER_FTA)->getFieldValue()) {
                case "0":
                    $nbJours = ModuleConfig::VALUE_DATE_PLUS_CREATION;
                    break;
                default :
                    $nbJours = ModuleConfig::VALUE_DATE_PLUS_MISE_A_JOUR;
                    break;
            }
            $dateEcheanceValue = date("Y-m-d", strtotime(date("Y-m-d") . " +" . $nbJours . " days"));
        }
        $dataFieldDateEcheance->setFieldValue($dateEcheanceValue);
        $this->saveToDatabase();
        return $dateEcheanceValue;
    }

    /**
     * On initialise le DataRecord à comparer 
     * @param DatabaseRecord $paramRecordToCompare
     */
    function setDataToCompare($paramRecordToCompare) {
        parent::setDataToCompare($paramRecordToCompare);
    }

    /**
     * On récupère le DataRecord à comparer 
     * @param DatabaseRecord $paramRecordToCompare
     */
    function getDataToCompare() {
        return parent::getDataToCompare();
    }

    /**
     * Type d'action create ou update pour Fta2Arcadia
     * @return string
     */
    function getActionProposal() {
        $action = Fta2ArcadiaController::CREATE;
        $earlierIdFtaVersionCodeArticleArcadia = $this->getDataToCompare()->getFieldValue(self::FIELDNAME_CODE_ARTICLE_LDC);
        /**
         * Dans le cas où la Fta en cours est une version 0 alors Creation
         * Dans le cas où la Fta en cours n'est pas une version 0
         * et que la version précedente à la Fta n'a pas de Code Article Arcadia alors  Creation
         * Sinon il s'agit d'un update.
         */
        if (!$this->getVersionDossierFta() == self::FTA_DOSSIER_VERSION_0 AND ! $earlierIdFtaVersionCodeArticleArcadia) {

            $action = Fta2ArcadiaController::UPDATE;
        }
        return $action;
    }

    /**
     * On récupère l'id de la Fta de la version précedente en cours
     * @return string
     */
    function getEarlierIdFtaVersion() {
        if (!$this->getVersionDossierFta() == self::FTA_DOSSIER_VERSION_0) {
            $return = $this->getDataToCompare()->getFieldValue(self::KEYNAME);
        } else {
            $return = self::FTA_DOSSIER_VERSION_0;
        }
        return $return;
    }

    /**
     * On initialise l'idFta à comparer de la version actuelle du FtaModel 
     */
    function setDataFtaTableToCompare() {

        $idFtaToCompare = $this->getIdFtaToCompare();

        $DataRecord = new DatabaseRecord(self::TABLENAME, $idFtaToCompare);

        $this->setDataToCompare($DataRecord);
    }

    function getIdFtaToCompare() {
        $currentIdFta = $this->getKeyValue();

        $arrayIdFtaDossierAndVersion = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . self::FIELDNAME_VERSION_DOSSIER_FTA . "," . self::FIELDNAME_DOSSIER_FTA
                        . " FROM " . self::TABLENAME
                        . " WHERE " . self::KEYNAME . "=" . $currentIdFta
        );
        foreach ($arrayIdFtaDossierAndVersion as $rowsIdFtaDossierAndVersion) {
            $idFtaVersion = $rowsIdFtaDossierAndVersion[self::FIELDNAME_VERSION_DOSSIER_FTA];
            $idFtaDossier = $rowsIdFtaDossierAndVersion[self::FIELDNAME_DOSSIER_FTA];
        }
        if ($idFtaVersion <> "0") {
            $idFtaVersion = $idFtaVersion - "1";

            $arrayIdFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            "SELECT " . self::KEYNAME
                            . " FROM " . self::TABLENAME
                            . " WHERE " . self::FIELDNAME_VERSION_DOSSIER_FTA . "=" . $idFtaVersion
                            . " AND " . self::FIELDNAME_DOSSIER_FTA . "=" . $idFtaDossier
            );
            if ($arrayIdFta) {
                foreach ($arrayIdFta as $rowsIdFta) {
                    $idFtaToCompare = $rowsIdFta[self::KEYNAME];
                }
            } else {
                $idFtaToCompare = $currentIdFta;
            }
        } else {
            $idFtaToCompare = $currentIdFta;
        }

        return $idFtaToCompare;
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
         * Datafield site de production
         */
        $dataFieldSiteDeProduction = $this->getDataField(FtaModel::FIELDNAME_SITE_PRODUCTION);

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

            $idFtaWorkflow = $this->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
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

        /**
         * On vérifie si le champ est verrouillable
         */
        $dataFieldSiteDeProduction->checkLockField($this, $paramIsEditable);


        /**
         * On autorise la modification selon l'état de champs verrouillable
         */
        $isEditable = FtaVerrouillageChampsModel::isEditableLockField($dataFieldSiteDeProduction->getIsFieldLock(), $paramIsEditable);



        /**
         * Verification des règles de validation
         */
        $dataFieldSiteDeProduction->checkValidationRules();

        if ($dataFieldSiteDeProduction->getDataValidationSuccessful() == TRUE) {
            $this->setDataValidationSuccessfulToTrue();
        } else {
            $this->setDataValidationSuccessfulToFalse();
        }
        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_SITE_PRODUCTION
                . '_'
                . $this->getKeyValue()
        ;
        $paramHtmlObjet->getAttributes()->getName()->setValue(FtaModel::FIELDNAME_SITE_PRODUCTION);
        $paramHtmlObjet->setLabel(DatabaseDescription::getFieldDocLabel(GeoModel::TABLENAME, GeoModel::FIELDNAME_GEO));
        $paramHtmlObjet->setIsEditable($isEditable);
        $paramHtmlObjet->initAbstractHtmlSelect(
                $HtmlTableName
                , $paramHtmlObjet->getLabel()
                , $dataFieldSiteDeProduction->getFieldValue()
                , $dataFieldSiteDeProduction->isFieldDiff()
                , $paramHtmlObjet->getArrayListContent()
                , $dataFieldSiteDeProduction->getDataValidationSuccessful()
                , $dataFieldSiteDeProduction->getDataWarningMessage()
                , $dataFieldSiteDeProduction->getIsFieldLock()
                , $dataFieldSiteDeProduction->getLinkFieldLock());
        $paramHtmlObjet->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $this->getKeyValue(), FtaModel::FIELDNAME_SITE_PRODUCTION);

        /**
         * Description d'un champ
         */
        $paramHtmlObjet->setHelp(IntranetColumnInfoModel::getFieldDesc($dataFieldSiteDeProduction->getTableName(), $dataFieldSiteDeProduction->getFieldName()
                        , $dataFieldSiteDeProduction->getFieldLabel(), $paramHtmlObjet
        ));

        $listeSiteProduction = $paramHtmlObjet->getHtmlResult();

        return $listeSiteProduction;
    }

//    private function checkValidationRules($paramFieldName) {
//        $this->getDataField($paramFieldName)->;

    /*
      Au niveau DataField:
      $this->getRulesValidation()->checkAllRules();


      checkRules
      --> récupérer d'intranet_colum_info, les règles à tester
     * --> boucle parcourant les règles
     *      --> Pour chaque règle getWarningMessage()
     *      --> Récupération du message propre à la règle et enregistrement
     *          dans l'attribut warningMessageListe du DataField
     * 
     * 
     * 
     * 
     * Au niveau du HtmlDataField
     * --> Getteur de l'attribut warningMessageListe
     * --> Si valeur existante alors affichage.
     */
//    }

    /**
     * Vérification que les champs arcadia déduit de la classifcation
     * sont correcte
     * @param type $paramIdClassificationFta2
     */
    function checkArcadiaClassifData($paramIdClassificationFta2) {
        /**
         * Famille Budget
         */
        $idArcadiaFamilleBudget = $this->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_FAMILLE_BUDGET)->getFieldValue();

        if ($idArcadiaFamilleBudget) {
            $reqFamilleBudget = "SELECT DISTINCT " . ArcadiaFamilleBudgetModel::KEYNAME . "," . ArcadiaFamilleBudgetModel::KEYNAME
                    . " FROM " . ArcadiaFamilleBudgetModel::TABLENAME
                    . " ORDER BY " . ArcadiaFamilleBudgetModel::KEYNAME;
            $arrayClassificationArcadiaFamilleBudget = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray($reqFamilleBudget);

            if (!in_array($idArcadiaFamilleBudget, $arrayClassificationArcadiaFamilleBudget)) {
                $this->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_FAMILLE_BUDGET)->setFieldValue(" ");
            }
        }


        /**
         * Famille de Ventes
         */
        $idArcadiaFamilleVente = $this->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_FAMILLE_VENTE)->getFieldValue();
        if ($idArcadiaFamilleVente) {
            $idActivite = ClassificationFta2Model::getIdClassificationTypeByTypeNameAndIdClassificationFta2($paramIdClassificationFta2, ClassificationFta2Model::FIELDNAME_ID_ACTIVITE);

            $arrayClassificationFamilleVenteArcadia = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                            'SELECT DISTINCT ' . ArcadiaFamilleVenteModel::TABLENAME . '.' . ArcadiaFamilleVenteModel::KEYNAME
                            . ',' . ArcadiaFamilleVenteModel::TABLENAME . '.' . ArcadiaFamilleVenteModel::KEYNAME
                            . ' FROM ' . ArcadiaFamilleVenteModel::TABLENAME . ',' . ClassificationActiviteFamilleVentesArcadiaModel::TABLENAME
                            . ' WHERE ' . ArcadiaFamilleVenteModel::TABLENAME . '.' . ArcadiaFamilleVenteModel::KEYNAME
                            . ' = ' . ClassificationActiviteFamilleVentesArcadiaModel::TABLENAME . '.' . ClassificationActiviteFamilleVentesArcadiaModel::FIELDNAME_ID_ARCADIA_FAMILLE_VENTE
                            . ' AND ' . ClassificationActiviteFamilleVentesArcadiaModel::FIELDNAME_ID_ACTIVITE . '=' . $idActivite
                            . ' ORDER BY ' . ArcadiaFamilleVenteModel::FIELDNAME_NOM_ARCADIA_FAMILLE_VENTE
            );

            if (!in_array($idArcadiaFamilleVente, $arrayClassificationFamilleVenteArcadia)) {
                $this->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_FAMILLE_VENTE)->setFieldValue(" ");
            }
        }

        /**
         * Gamme Coop
         */
        $idArcadiaGammeCoop = $this->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_GAMME_COOP)->getFieldValue();

        if ($idArcadiaGammeCoop) {
            $reqGammeCoop = "SELECT DISTINCT " . ArcadiaGammeCoopModel::KEYNAME . "," . ArcadiaGammeCoopModel::KEYNAME
                    . " FROM " . ArcadiaGammeCoopModel::TABLENAME
                    . " ORDER BY " . ArcadiaGammeCoopModel::KEYNAME;
            $arrayClassificationArcadiaGammeCoop = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray($reqGammeCoop);

            if (!in_array($idArcadiaGammeCoop, $arrayClassificationArcadiaGammeCoop)) {
                $this->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_GAMME_COOP)->setFieldValue(" ");
            }
        }

        /**
         * Gamme Famille Budget
         */
        $idArcadiaGammeFamilleBudget = $this->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET)->getFieldValue();

        if ($idArcadiaGammeFamilleBudget) {
            $arrayGammeFamilleBudget = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                            'SELECT DISTINCT ' . ArcadiaGammeFamilleBudgetModel::TABLENAME . '.' . ArcadiaGammeFamilleBudgetModel::KEYNAME
                            . ',' . ArcadiaGammeFamilleBudgetModel::TABLENAME . '.' . ArcadiaGammeFamilleBudgetModel::KEYNAME
                            . ' FROM ' . ArcadiaGammeFamilleBudgetModel::TABLENAME . ',' . ClassificationGammeFamilleBudgetArcadiaModel::TABLENAME
                            . ' WHERE ' . ArcadiaGammeFamilleBudgetModel::TABLENAME . '.' . ArcadiaGammeFamilleBudgetModel::KEYNAME
                            . ' = ' . ClassificationGammeFamilleBudgetArcadiaModel::TABLENAME . '.' . ClassificationGammeFamilleBudgetArcadiaModel::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET
                            . ' AND ' . ClassificationGammeFamilleBudgetArcadiaModel::FIELDNAME_ID_FTA_CLASSIFICATION2 . '=' . $paramIdClassificationFta2
                            . ' ORDER BY ' . ArcadiaGammeFamilleBudgetModel::KEYNAME
            );
            if (!in_array($idArcadiaGammeFamilleBudget, $arrayGammeFamilleBudget)) {
                $this->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_GAMME_FAMILLE_BUDGET)->setFieldValue(" ");
            }
        }

        /**
         * Arcadia Marque
         */
        $idArcadiaMarque = $this->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_MARQUE)->getFieldValue();

        if ($idArcadiaMarque) {
            $idMarque = ClassificationFta2Model::getIdClassificationTypeByTypeNameAndIdClassificationFta2($paramIdClassificationFta2, ClassificationFta2Model::FIELDNAME_ID_MARQUE);
            $arrayClassificationMarqueArcadia = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                            'SELECT DISTINCT ' . ArcadiaMarqueModel::TABLENAME . '.' . ArcadiaMarqueModel::KEYNAME
                            . ',' . ArcadiaMarqueModel::TABLENAME . '.' . ArcadiaMarqueModel::KEYNAME
                            . ' FROM ' . ArcadiaMarqueModel::TABLENAME . ',' . ClassificationMarqueArcadiaModel::TABLENAME
                            . ' WHERE ' . ArcadiaMarqueModel::TABLENAME . '.' . ArcadiaMarqueModel::KEYNAME
                            . ' = ' . ClassificationMarqueArcadiaModel::TABLENAME . '.' . ClassificationMarqueArcadiaModel::FIELDNAME_ID_ARCADIA_MARQUE
                            . ' AND ' . ClassificationMarqueArcadiaModel::FIELDNAME_ID_MARQUE . '=' . $idMarque
                            . ' ORDER BY ' . ArcadiaMarqueModel::FIELDNAME_NOM_ARCADIA_MARQUE
            );
            if (!in_array($idArcadiaMarque, $arrayClassificationMarqueArcadia)) {
                $this->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_MARQUE)->setFieldValue(" ");
            }
        }

        /**
         * Sous Famille
         */
        $idArcadiaSousFamille = $this->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_SOUS_FAMILLE)->getFieldValue();
        if ($idArcadiaSousFamille) {
            $idActivite = ClassificationFta2Model::getIdClassificationTypeByTypeNameAndIdClassificationFta2($paramIdClassificationFta2, ClassificationFta2Model::FIELDNAME_ID_ACTIVITE);

            $arrayClassificationActiviteSousFamilleArcadia = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                            'SELECT DISTINCT ' . ArcadiaSousFamilleModel::TABLENAME . '.' . ArcadiaSousFamilleModel::KEYNAME
                            . ',' . ArcadiaSousFamilleModel::TABLENAME . '.' . ArcadiaSousFamilleModel::KEYNAME
                            . ' FROM ' . ArcadiaSousFamilleModel::TABLENAME . ',' . ClassificationActiviteSousFamilleArcadiaModel::TABLENAME
                            . ' WHERE ' . ArcadiaSousFamilleModel::TABLENAME . '.' . ArcadiaSousFamilleModel::KEYNAME
                            . ' = ' . ClassificationActiviteSousFamilleArcadiaModel::TABLENAME . '.' . ClassificationActiviteSousFamilleArcadiaModel::FIELDNAME_ID_ARCADIA_SOUS_FAMILLE
                            . ' AND ' . ClassificationActiviteSousFamilleArcadiaModel::FIELDNAME_ID_ACTIVITE . '=' . $idActivite
                            . ' ORDER BY ' . ArcadiaSousFamilleModel::FIELDNAME_NOM_ARCADIA_SOUS_FAMILLE
            );

            if (!in_array($idArcadiaSousFamille, $arrayClassificationActiviteSousFamilleArcadia)) {
                $this->getDataField(FtaModel::FIELDNAME_ID_ARCADIA_SOUS_FAMILLE)->setFieldValue(" ");
            }
        }
    }

    /**
     * On vérifie si le dossier Fta est utilisé comme dossier Primaire
     * @return boolean
     */
    function isDossierFtaPrimary() {
        $arrayFta = $this->getArrayIdFtaFromDossierFtaPrimary();

        if ($arrayFta) {
            $isDosssierFtaPrimary = TRUE;
        } else {
            $isDosssierFtaPrimary = FALSE;
        }

        return $isDosssierFtaPrimary;
    }

    /**
     * Identification automatique de la Fta à traité
     * @param type $paramDossierFtaPrimaire
     */
    function getIdFtaFromDossierFtaPrimary($paramDossierFtaPrimaire) {
        $arrayDossierFtaModification = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . FtaModel::KEYNAME
                        . " FROM " . FtaModel::TABLENAME
                        . " WHERE " . FtaModel::FIELDNAME_DOSSIER_FTA . "=" . $paramDossierFtaPrimaire
                        . " AND " . FtaModel::FIELDNAME_ID_FTA_ETAT . "=" . FtaEtatModel::ID_VALUE_MODIFICATION
        );
        $arrayDossierFtaValide = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . FtaModel::KEYNAME
                        . " FROM " . FtaModel::TABLENAME
                        . " WHERE " . FtaModel::FIELDNAME_DOSSIER_FTA . "=" . $paramDossierFtaPrimaire
                        . " AND " . FtaModel::FIELDNAME_ID_FTA_ETAT . "=" . FtaEtatModel::ID_VALUE_VALIDE
        );
        $arrayDossierFtaLastVersion = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . FtaModel::FIELDNAME_DOSSIER_FTA . ", MAX(" . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA . ")"
                        . " FROM " . FtaModel::TABLENAME
                        . " WHERE " . FtaModel::FIELDNAME_DOSSIER_FTA . "=" . $paramDossierFtaPrimaire
        );
        if ($arrayDossierFtaModification) {
            foreach ($arrayDossierFtaModification as $rowsDossierFtaModification) {
                $idFtaPrimaire = $rowsDossierFtaModification[FtaModel::KEYNAME];
            }
        } elseif ($arrayDossierFtaValide) {
            foreach ($arrayDossierFtaValide as $rowsDossierFtaValide) {
                $idFtaPrimaire = $rowsDossierFtaValide[FtaModel::KEYNAME];
            }
        } else {
            foreach ($arrayDossierFtaLastVersion as $rowsDossierFtaLastVersion) {
                $arrayDossierFtaLastVersionFinal = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                "SELECT " . FtaModel::KEYNAME
                                . " FROM " . FtaModel::TABLENAME
                                . " WHERE " . FtaModel::FIELDNAME_DOSSIER_FTA . "=" . $rowsDossierFtaLastVersion[FtaModel::FIELDNAME_DOSSIER_FTA]
                                . " AND " . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA . "=" . $rowsDossierFtaLastVersion[FtaModel::FIELDNAME_VERSION_DOSSIER_FTA]
                );
                foreach ($arrayDossierFtaLastVersionFinal as $rowsDossierFtaLastVersionFinal) {
                    $idFtaPrimaire = $rowsDossierFtaLastVersionFinal[FtaModel::KEYNAME];
                }
            }
        }

        return $idFtaPrimaire;
    }

    /**
     * Affiche le lien vers la Fta primaire ou le lien d'ajout
     * @param int $paramIdFtaChapitre
     * @param string $paramSyntheseAction
     * @param int $paramComeback
     * @param int $paramIdFtaEtat
     * @param string $paramAbrevationEtat
     * @param int $paramIdFtaRole
     * @param array $paramDossierFtaPrimaire
     * @param int $paramIdFtaSecondaireEncours
     * @param boolean $paramIsEditable
     * @return string
     */
    function getLinkToPrimaryFta($paramIdFtaChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbrevationEtat, $paramIdFtaRole, $paramDossierFtaPrimaire, $paramIdFtaSecondaireEncours, $paramIsEditable) {

        if ($paramDossierFtaPrimaire) {
            /**
             * On vérifie si le code Article Arcadia est renseigné
             * si oui on l'affiche 
             * sinon on affiche le dossier avec la version
             */
            if ($this->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue()) {
                $valueLink = $this->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue();
            } else {
                $valueLink = $this->getDataField(FtaModel::FIELDNAME_DOSSIER_FTA)->getFieldValue() . "v" . $this->getDataField(FtaModel::FIELDNAME_VERSION_DOSSIER_FTA)->getFieldValue();
            }
            /**
             * Lien de modification d'un Fta Primaire
             */
            $link = "<tr ><td class=\"contenu\"> " . UserInterfaceLabel::FR_FTA_PRIMAIRE . "</td ><td class=\"contenu\" width=75% >"
                    . "<a href="
                    . "modification_fiche.php?"
                    . "id_fta=" . $this->getKeyValue()
                    . "&id_fta_chapitre_encours=" . $paramIdFtaChapitre
                    . "&synthese_action=" . $paramSyntheseAction
                    . "&comeback=" . $paramComeback
                    . "&id_fta_etat=" . $this->getDataField(self::FIELDNAME_ID_FTA_ETAT)->getFieldValue()
                    . "&abreviation_fta_etat=" . $this->getModelFtaEtat()->getDataField(FtaEtatModel::FIELDNAME_ABREVIATION)->getFieldValue()
                    . "&id_fta_role=" . $paramIdFtaRole
                    . ">" . $valueLink . "</a>";
            if ($paramIsEditable) {
                $link .=" - <a href="
                        . "modification_fta_primaire.php?"
                        . "id_fta=" . $paramIdFtaSecondaireEncours
                        . "&id_fta_chapitre_encours=" . $paramIdFtaChapitre
                        . "&synthese_action=" . $paramSyntheseAction
                        . "&comeback=" . $paramComeback
                        . "&id_fta_etat=" . $paramIdFtaEtat
                        . "&abreviation_fta_etat=" . $paramAbrevationEtat
                        . "&id_fta_role=" . $paramIdFtaRole
                        . ">Modifier Code Primaire</a>";
                $link .=' - <a href=#'
                        . ' onclick="desactivationLockFields(\'' . $paramIdFtaSecondaireEncours . '\',\'' . $paramIdFtaChapitre . '\',\'' . $paramSyntheseAction
                        . '\', \'' . $paramComeback . '\', \'' . $paramIdFtaEtat
                        . '\', \'' . $paramAbrevationEtat . '\', \'' . $paramIdFtaRole . '\' )"'
                        . " >Désactiver le Code Primaire</a>";
            }

            $link .= "</td></tr>";
        } else {
            /**
             * Lien d'ajout d'une Fta primaire
             */
            $link = "<tr ><td class=\"contenu\"> " . UserInterfaceLabel::FR_FTA_PRIMAIRE . "</td ><td class=\"contenu\" width=75% >"
                    . "<a href="
                    . "modification_fta_primaire.php?"
                    . "id_fta=" . $paramIdFtaSecondaireEncours
                    . "&id_fta_chapitre_encours=" . $paramIdFtaChapitre
                    . "&synthese_action=" . $paramSyntheseAction
                    . "&comeback=" . $paramComeback
                    . "&id_fta_etat=" . $paramIdFtaEtat
                    . "&abreviation_fta_etat=" . $paramAbrevationEtat
                    . "&id_fta_role=" . $paramIdFtaRole
                    . ">Cliquez ici</a></td></tr>";
        }
        return $link;
    }

    /**
     * Tableau des IdFta correspondant à un dossier Fta primaire
     * @return array
     */
    function getArrayIdFtaFromDossierFtaPrimary() {
        $arrayFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . FtaModel::KEYNAME
                        . " FROM " . FtaModel::TABLENAME
                        . " WHERE " . FtaModel::FIELDNAME_DOSSIER_FTA_PRIMAIRE . "=" . $this->getDataField(FtaModel::FIELDNAME_DOSSIER_FTA)->getFieldValue()
        );

        return $arrayFta;
    }

    /**
     * Affiche le lien vers les Fta secondaires
     * @param int $paramIdFtaChapitre
     * @param string $paramSyntheseAction
     * @param int $paramComeback  
     * @param int $paramIdFtaRole
     * @return string
     */
    function getLinkToSecondaryFta($paramIdFtaChapitre, $paramSyntheseAction, $paramComeback, $paramIdFtaRole) {
        $arraySecondaryFta = $this->getArrayIdFtaFromDossierFtaPrimary();
        $separator = " ";
        $link = "<tr ><td class=\"contenu\"> " . UserInterfaceLabel::FR_FTA_SECONDAIRE . "</td ><td class=\"contenu\" width=75% >";
        foreach ($arraySecondaryFta as $rowsSecondaryFta) {

            $ftaModelSecond = new FtaModel($rowsSecondaryFta[self::KEYNAME]);
            /**
             * On vérifie si le code Article Arcadia est renseigné
             * si oui on l'affiche 
             * sinon on affiche le dossier avec la version
             */
            if ($ftaModelSecond->getDataField(self::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue()) {
                $valueLink = $ftaModelSecond->getDataField(self::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue();
            } else {
                $valueLink = $ftaModelSecond->getDataField(self::FIELDNAME_DOSSIER_FTA)->getFieldValue() . "v" . $ftaModelSecond->getDataField(FtaModel::FIELDNAME_VERSION_DOSSIER_FTA)->getFieldValue();
            }

            $link .=$separator . "<a href="
                    . "modification_fiche.php?"
                    . "id_fta=" . $ftaModelSecond->getKeyValue()
                    . "&id_fta_chapitre_encours=" . $paramIdFtaChapitre
                    . "&synthese_action=" . $paramSyntheseAction
                    . "&comeback=" . $paramComeback
                    . "&id_fta_etat=" . $ftaModelSecond->getDataField(self::FIELDNAME_ID_FTA_ETAT)->getFieldValue()
                    . "&abreviation_fta_etat=" . $ftaModelSecond->getModelFtaEtat()->getDataField(FtaEtatModel::FIELDNAME_ABREVIATION)->getFieldValue()
                    . "&id_fta_role=" . $paramIdFtaRole
                    . ">" . $valueLink . "</a>";

            $separator = " - ";
        }
        $link .="</td></tr>";


        return $link;
    }

    /**
     * Désactivation du code Primaire
     * @return int
     */
    function disabledCodePrimaire() {
        $dossierFtaPrimaire = $this->getDossierPrimaire();

        /**
         * Désactivation du code Primaire
         */
        $this->getDataField(FtaModel::FIELDNAME_DOSSIER_FTA_PRIMAIRE)->setFieldValue(" ");

        $this->saveToDatabase();

        /**
         * On vérifie si le dossier Primaire est toujours utilisé comme code Primaire
         */
        $arrayIdFtaByIdDossierPrimaryFta = FtaModel::getArrayIdFtaByIdDossierPrimaryFta($dossierFtaPrimaire);

        if (!$arrayIdFtaByIdDossierPrimaryFta) {
            FtaVerrouillageChampsModel::deletePrimaryFolder($dossierFtaPrimaire);
        }
    }

    /**
     * On récupère le dossier Fta Primaire d'une Fta Secondaire
     * @return int
     */
    function getDossierPrimaire() {
        $dossierFtaPriamire = $this->getDataField(self::FIELDNAME_DOSSIER_FTA_PRIMAIRE)->getFieldValue();
        return $dossierFtaPriamire;
    }

    /**
     * On vérifie si la Fta en cours est une primaire ou une secondaire
     * ou encore aucune des deux
     */
    function checkFtaPrimaireSecondaire($paramDataFieldName = NULL) {


        $dossierFtaPrimaire = $this->getDossierPrimaire();
        $dossierFta = $this->getDossierFta();
        $arrayFtaDossierChampsVerrouiller = FtaVerrouillageChampsModel::getArrayFtaLockByPrimaryFolder($dossierFta);

        /**
         * Si un dossier Fta primaire est renseigné sur la Fta il s'agit d'une Fta secondaire
         */
        if ($dossierFtaPrimaire) {
            $ftaValue = self::FTA_SECONDAIRE;
            /**
             * Condition pour un champ
             */
            if ($paramDataFieldName) {
                $verrouillable = FtaVerrouillageChampsModel::checkFieldNameVerrouillable($paramDataFieldName, $dossierFtaPrimaire);
                if (!$verrouillable) {
                    $ftaValue = self::FTA_NORMAL;
                }
            }
        } elseif ($arrayFtaDossierChampsVerrouiller) {
            /**
             * Si le dossier Fta de la Fta encours est utilisé dans la table FtaVerrouillageChamps
             *  il s'agit d'une Fta primaire
             */
            $ftaValue = self::FTA_PRIMAIRE;
            /**
             * Condition pour un champ
             */
            if ($paramDataFieldName) {
                $verrouillable = FtaVerrouillageChampsModel::checkFieldNameVerrouillable($paramDataFieldName, $dossierFta);
                if (!$verrouillable) {
                    $ftaValue = self::FTA_NORMAL;
                }
            }
        } else {
            $ftaValue = self::FTA_NORMAL;
        }

        return $ftaValue;
    }

    /**
     * Tableau de l'état (verrouillé/déverrouillé) selon le dossier Fta primaire
     * @return array
     */
    function getArrayFtaVerrouillerByIdFtaDossierPrimaire() {
        $dossierFtaPrimaire = $this->getDossierPrimaire();

        $arrayFtaDossierChampsVerrouiller = FtaVerrouillageChampsModel::getArrayFtaLockByPrimaryFolder($dossierFtaPrimaire);

        return $arrayFtaDossierChampsVerrouiller;
    }

    /**
     * Tableau de l'état (verrouillable/déverrouillable) selon le dossier Fta 
     * @return array
     */
    function getArrayFtaVerrouillerByIdFtaDossier() {
        $dossierFta = $this->getDossierFta();
        $arrayFtaDossierChampsVerrouiller = FtaVerrouillageChampsModel::getArrayFtaLockByPrimaryFolder($dossierFta);

        return $arrayFtaDossierChampsVerrouiller;
    }

    /**
     * Tableau des idFta secondaires validé ou modifié de la Fta primaire en cours 
     * ordonné par dossier Fta puis par l'état de la Fta 
     * @return array
     */
    function getArrayIdFtaSecondaireByDossierPrimaire($paramTypeSynchro) {
        $dossierFta = $this->getDossierFta();
        if ($paramTypeSynchro == FtaEtatModel::ID_VALUE_VALIDE) {
            $paramTypeSynchro = " ( " . self::FIELDNAME_ID_FTA_ETAT . "=" . $paramTypeSynchro
                    . " OR " . self::FIELDNAME_ID_FTA_ETAT . "=" . FtaEtatModel::ID_VALUE_MODIFICATION . " ) ";
        } else {
            $paramTypeSynchro = self::FIELDNAME_ID_FTA_ETAT . "=" . $paramTypeSynchro;
        }

        $arrayIdFtaSeondaire = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . self::KEYNAME . "," . self::FIELDNAME_DOSSIER_FTA
                        . " FROM " . self::TABLENAME
                        . " WHERE " . self::FIELDNAME_DOSSIER_FTA_PRIMAIRE . "=" . $dossierFta
                        . " AND " . $paramTypeSynchro
                        . " ORDER BY " . self::FIELDNAME_DOSSIER_FTA . ", " . self::FIELDNAME_ID_FTA_ETAT
        );

        return $arrayIdFtaSeondaire;
    }

    /**
     * On récupère l'id du dossier Fta en cours
     * @return int
     */
    function getDossierFta() {
        $dossierFta = $this->getDataField(self::FIELDNAME_DOSSIER_FTA)->getFieldValue();

        return $dossierFta;
    }

    /**
     * On récupère l'id de la version du dossier Fta en cours
     * @return int
     */
    function getVersionDossierFta() {
        $versionDossierFta = $this->getDataField(self::FIELDNAME_VERSION_DOSSIER_FTA)->getFieldValue();

        return $versionDossierFta;
    }

    /**
     * On gère les conditions des Codes Articles Primaires et Secondaires
     * Dans le cas d'une validation d'un Fta Priamire, on synchronise les données de la Fta Primaires avec toutes les Secondaire
     * La mise à jour est faîte sur la Fta Modifié > Validé
     * FtaEtatModel::ID_VALUE_MODIFICATION - synchronisation que des fta modifié
     * FtaEtatModel::ID_VALUE_VALIDE - synchronisation que des fta validé
     * @param string $paramTypeSynchro
     */
    function manageFtaPrimaireSecondaire($paramTypeSynchro, $paramState = NULL) {
        /**
         * Vérification de l'état de la Fta
         */
        $ftaValue = $this->checkFtaPrimaireSecondaire();

        switch ($ftaValue) {
            case FtaModel::FTA_PRIMAIRE:
                //Synchronisation des données de la Fta primaire avec les secondaires
                $arrayIdFtaSeondaire = $this->getArrayIdFtaSecondaireByDossierPrimaire($paramTypeSynchro);
                if ($arrayIdFtaSeondaire) {
                    foreach ($arrayIdFtaSeondaire as $rowsIdFtaSeondaire) {
                        $dossierTmp = $rowsIdFtaSeondaire[self::FIELDNAME_DOSSIER_FTA];
                        /**
                         * On effectue la synchronisation des données en priorité sur les Fta Secondaires en modifiation 
                         * Sinon elle seront faîte sur les Fta Validé
                         * Ordonnance du tableau permet ce traitement
                         */
                        if ($dossierUse <> $dossierTmp) {
                            FtaVerrouillageChampsModel::dataSynchronizeFtaPrimarySecondary($this->getKeyValue(), $rowsIdFtaSeondaire[self::KEYNAME], $this->getDossierFta(), $paramState);
                            $dossierUse = $dossierTmp;
                        }
                    }
                    switch ($paramState) {
                        /**
                         * Changement de l'état afin de synchroniser les données avec les Fta validées
                         */
                        case FtaVerrouillageChampsModel::CHANGE_STATE_FALSE:
                            $check = $paramState;
                            $changeState = FtaVerrouillageChampsModel::CHANGE_STATE_TRUE_VALIDATION_CHAPITRE;
                            break;
                        /**
                         * Changement de l'état afin de les considérés les données avec les Fta validées synchronisé
                         */
                        case FtaVerrouillageChampsModel::CHANGE_STATE_TRUE_VALIDATION_CHAPITRE:
                            $check = $paramState
                                    . " OR " . FtaVerrouillageChampsModel::FIELDNAME_FIELD_CHANGE_STATE . "=" . FtaVerrouillageChampsModel::CHANGE_STATE_FALSE;
                            $changeState = FtaVerrouillageChampsModel::CHANGE_STATE_TRUE_VALIDATION_FTA;
                            break;
                    }

                    $arrayKeyFtaVerrouillage = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                    "SELECT DISTINCT " . FtaVerrouillageChampsModel::KEYNAME
                                    . " FROM " . FtaVerrouillageChampsModel::TABLENAME
                                    . " WHERE " . FtaVerrouillageChampsModel::FIELDNAME_DOSSIER_FTA_PRIMAIRE . "=" . $this->getDossierFta()
                                    . " AND " . FtaVerrouillageChampsModel::FIELDNAME_FIELD_CHANGE_STATE . "=" . $check
                    );

                    if ($arrayKeyFtaVerrouillage) {
                        DatabaseOperation::execute(
                                "UPDATE " . FtaVerrouillageChampsModel::TABLENAME
                                . " SET " . FtaVerrouillageChampsModel::FIELDNAME_FIELD_CHANGE_STATE . "='" . $changeState
                                . "' WHERE " . FtaVerrouillageChampsModel::FIELDNAME_DOSSIER_FTA_PRIMAIRE . "=" . $this->getDossierFta()
                                . " AND " . FtaVerrouillageChampsModel::FIELDNAME_FIELD_CHANGE_STATE . "=" . $check
                        );
                    }
                }
                /**
                 * Réinitialisation du changement d'état
                 */
//                FtaVerrouillageChampsModel::resetChangeStateFieldLock($this->getDossierFta());


                break;
            case FtaModel::FTA_SECONDAIRE:
            case FtaModel::FTA_NORMAL:
                //Aucun traitement sur les Fta Secondaires et normaux

                break;
        }
    }

}
