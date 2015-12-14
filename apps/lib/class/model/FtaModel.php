<?php

/**
 * Description of FtaModel
 * Table des FTA
 *
 * @author salokine
 */
class FtaModel extends AbstractModel {

    const CHECK_DATE_ECHANCE = "0000-00-00";
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
    const FIELDNAME_DATE_ECHEANCE_FTA = "date_echeance_fta";
    const FIELDNAME_DATE_PREVISONNELLE_TRANSFERT_INDUSTRIEL = "date_transfert_industriel";
    const FIELDNAME_DESCRIPTION_DU_PRODUIT = "OLD_synoptique_valide_fta";
    const FIELDNAME_DESCRIPTION_TECHNIQUE_INTERNE = "synoptique_experimental_fta";
    const FIELDNAME_DESCRIPTION_EMBALLAGE = "description_emballage";
    const FIELDNAME_DESIGNATION_COMMERCIALE = "designation_commerciale_fta";
    const FIELDNAME_DOSSIER_FTA = "id_dossier_fta";
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
    const FIELDNAME_ID_FTA_CLASSIFICATION2 = "id_fta_classification2";
    const FIELDNAME_ID_FTA_ETAT = "id_fta_etat";
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
    const MESSAGE_DATA_MISSING = UserInterfaceMessage::FR_WARNING_DATA_MISSING_TITLE;
    const MESSAGE_DATA_VALIDATION_CLASSIFICATION = UserInterfaceMessage::FR_WARNING_DATA_CLASIFICATION;
    const MESSAGE_DATA_VALIDATION_CODE_LDC = UserInterfaceMessage::FR_WARNING_DATA_VALIDATION_FTA_CODE_LDC;
    const MESSAGE_DATA_VALIDATION_DATE_ECHEANCE = UserInterfaceMessage::FR_WARNING_DATA_DATE_ECHEANCE;

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
     * Site de production de la FTA
     * @var GeoModel
     */
    private $modelSiteProduction;
    private $donneeEmballageUVC;
    private $donneeEmballageParColis;
    private $donneeEmballageDuColis;
    private $donneeEmballagePallette;
    private $messageErreurDataValidation;

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
        $return += $this->checkDataValidationClassification();
        $return += $this->checkDataValidationDateEcheance();
        $return += $this->checkDataValidationCodeLDC();


        if ($return != "0") {
            $titre = self::MESSAGE_DATA_MISSING;
            $message = $this->getMessageErreurDataValidation();
            afficher_message($titre, $message, $redirection);
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

        if (!$this->getDataField(FtaModel::FIELDNAME_DATE_ECHEANCE_FTA)->getFieldValue() or $this->getDataField(FtaModel::FIELDNAME_DATE_ECHEANCE_FTA)->getFieldValue() == self::CHECK_DATE_ECHANCE) {
            $newErrorMessage = self::MESSAGE_DATA_VALIDATION_DATE_ECHEANCE;
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
            } {
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
    private function setModelCreateur($modelCreateur) {
        $this->modelCreateur = $modelCreateur;
    }

    /**
     * Défini l'état de la FTA
     * @param FtaEtatModel 
     */
    private function setModelFtaEtat(FtaEtatModel $modelFtaEtat) {
        $this->modelFtaEtat = $modelFtaEtat;
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
                $dateDefaultEcheance = date("Y-m-d", $timestamp_date_echeance_fta);
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
        $this->setDonneeEmballageUVC($this->ArrayEmballages(FtaConditionnementModel::EMBALLAGES_UVC));
    }

    public function getArrayEmballageTypeParColis() {
        $this->setDonneeEmballageParColis($this->ArrayEmballages(FtaConditionnementModel::EMBALLAGES_PAR_COLIS));
    }

    public function getArrayEmballageTypeDuColis() {
        $this->setDonneeEmballageDuColis($this->ArrayEmballages(FtaConditionnementModel::EMBALLAGES_DU_COLIS));
    }

    public function getArrayEmballageTypePalette() {
        $this->setDonneeEmballagePallette($this->ArrayEmballages(FtaConditionnementModel::EMBALLAGES_PALETTE));
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

    public function ArrayEmballages($paramGroupeType) {
        $return = $this->PoidsDesEmballagesColis();


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
                afficher_message($titre, $message, $redirection);
            }
        }
        if ($paramGroupeType == AnnexeEmballageGroupeTypeModel::EMBALLAGE_PALETTE) {
            if (count($array) > 1) {
                $titre = UserInterfaceMessage::FR_WARNING_NOT_HANDLE_TITLE;
                $message = UserInterfaceMessage::FR_WARNING_EMBALLAGE_PALETTE;
                afficher_message($titre, $message, $redirection);
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
                                "SELECT " . FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION_UVC
                                . "," . FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION
                                . " FROM " . FtaComposantModel::TABLENAME
                                . " WHERE " . FtaComposantModel::FIELDNAME_ID_FTA . "=" . $this->getKeyValue()
                                . " AND " . FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT
                                . "=" . FtaConditionnementModel::EMBALLAGES_UVC
                );

                if ($arrayComposant) {
                    foreach ($arrayComposant as $rowsComposant) {

                        // Calcul du Poids net du colis
                        $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET] = FtaConditionnementModel::getCalculGenericMultiplication(
                                        $rowsComposant[FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION_UVC]
                                        , $rowsComposant[FtaComposantModel::FIELDNAME_POIDS_UNITAIRE_CODIFICATION]
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
                            "SELECT " . FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION_UVC
                            . "," . FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION
                            . " FROM " . FtaComposantModel::TABLENAME
                            . " WHERE " . FtaComposantModel::FIELDNAME_ID_FTA . "=" . $this->getKeyValue()
                            . " AND " . FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT
                            . "=" . FtaConditionnementModel::EMBALLAGES_UVC
            );

            if ($arrayComposant) {
                foreach ($arrayComposant as $rowsComposant) {

                    // Calcul du Poids net du colis
                    $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET] = FtaConditionnementModel::getCalculGenericMultiplication(
                                    $rowsComposant[FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION_UVC]
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

    public function PoidsDesEmballagesColis() {
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

    public static function AddIdFta($paramIdEffectue) {
        if ($paramIdEffectue) {
            foreach ($paramIdEffectue as $value) {
                $req .= " OR " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME . "='" . $value . "' ";
            }
        }
        return $req;
    }

    public static function AddIdFtaLabel($paramIdEffectue) {
        if ($paramIdEffectue) {
            foreach ($paramIdEffectue as $value) {
                $req .= " OR " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME . "=" . $value[FtaModel::KEYNAME] . " ";
            }
        }
        return $req;
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
    public static function BuildDuplicationFta($paramIdFta, $paramAction, $paramOption, $paramIdFtaWorkflow) {

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


        $idFtaNew = FtaModel::DuplicationIdFta($paramIdFta);                                                                                    //Récupération de la nouvelle clef
        /*
         * Enregsitrement des mises à jour
         */

        if (!$paramOption["site_de_production"]) {
            $paramOption["site_de_production"] = "NULL";
        }
        DatabaseOperation::execute(
                "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_DATE_ECHEANCE_FTA . "=" . "0000-00-00"                                                                   //La date d'échéance sera à redéfinir
                . ", " . FtaModel::FIELDNAME_DATE_CREATION . "='" . date("Y-m-d")                                                               //Date de la création de cet Article
                . "', " . FtaModel::FIELDNAME_ACTIF . "=" . 0                                                                                   //Tant que la fiche n'est pas activée, la flag reste à 0.
                . ", " . FtaModel::FIELDNAME_CODE_ARTICLE . "=" . 'NULL'                                                                         //Le Code Article Agrologic ne peut être présent 2 fois (index unique)
                . ", " . FtaModel::FIELDNAME_CREATEUR . "=" . $idUser
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
                        . ", " . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE . "=\"" . $paramOption["designation_commerciale_fta"]                //Renommage de la nouvelle FTA
                        . "\", " . FtaModel::FIELDNAME_NOM_ABREGE . "=" . "NULL"                                                                  //Le nom abrégé est réinitilisé
                        . ", " . FtaModel::FIELDNAME_LIBELLE . "=" . "NULL"                                                                       //Dans le cas d'un nouveau dossier, son identifiant correspond à l'identifiant de sa première FTA
                        . ", " . FtaModel::FIELDNAME_CODE_ARTICLE_LDC . "=" . "0"                                                              //Suppression Code LDC
                        . ", " . FtaModel::FIELDNAME_EAN_COLIS . "=" . "0"                                                                     //Suppression EAN Colis
                        . ", " . FtaModel::FIELDNAME_EAN_UVC . "=" . "0"                                                                       //Suppression EAN Article
                        . ", " . FtaModel::FIELDNAME_EAN_PALETTE . "=" . "0"                                                                   //Suppression EAN Palette
                        . " WHERE " . FtaModel::KEYNAME . "=" . $idFtaNew
                );
                break;
            /*
             *  //Création d'une nouvelle version de la FTA
             */
            case "version":
                $idFtaVersion = $idFtaVersion + 1;
                DatabaseOperation::execute(
                        "UPDATE " . FtaModel::TABLENAME
                        . " SET " . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA . "=" . $idFtaVersion                                                       //La première FTA commence en version "0"
                        . ", " . FtaModel::FIELDNAME_ID_FTA_ETAT . "=" . $idFtaEtatNew                                                          //Nouvel éta de la FTA données par l'argument $option de la fonction (cf. table fta_etat)
                        . " WHERE " . FtaModel::KEYNAME . "=" . $idFtaNew
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
                if ($selection_chapitre) {
                    foreach ($selection_chapitre as $id_fta_chapitre) {

                        //Correction des chapitres

                        $paramOption["correction_fta_suivi_projet"] = $paramOption["nouveau_maj_fta"];
                        FtaChapitreModel::BuildCorrectionChapitre($idFtaNew, $id_fta_chapitre, $paramOption);
                    }
                }

                /*
                 * Cettefonction est mise en pause car elle nécessite la création de processus cycle pour chaque workflow,
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
    public static function DuplicationIdFta($paramIdFta) {
        $pdo = DatabaseOperation::executeComplete(
                        " INSERT INTO " . FtaModel::TABLENAME . " (id_access_arti2, OLD_numft, id_fta_workflow,
 commentaire, OLD_id_fta_palettisation, id_dossier_fta, id_version_dossier_fta,
 OLD_champ_maj_fta, id_fta_etat, createur_fta, date_derniere_maj_fta,
 commentaire_maj_fta, date_echeance_fta, OLD_duree_apres_dernier_processus_fta, OLD_periode_commercialisation_fta,
 code_douane_fta, OLD_code_douane_libelle_fta, poids_emballages_uvc_fta, poids_brut_uvc_fta,
 poids_net_uvc_fta, suffixe_agrologic_fta, OLD_synoptique_valide_fta, origine_transformation_fta,
 remarque_fta, OLD_presentation_fta, apres_ouverture_fta, conseil_rechauffage_valide_fta,
 reference_externe_fta, OLD_duree_vie_technique_fta, designation_commerciale_fta, OLD_nom_abrege_fta,
 site_expedition_fta, conseil_rechauffage_experimentale_fta, OLD_synoptique_experimental_fta, OLD_unite_affichage_fta,
 OLD_signature_validation_fta, OLD_old_gamdesc, OLD_old_segdesc, OLD_old_condition,
 OLD_old_conservation, id_article_agrologic, OLD_id_annexe_environnement_conservation, origine_matiere_fta,
 allergenes_matiere_fta, description_emballage, OLD_date_transfert_industriel, liste_chapitre_maj_fta,
 verrouillage_libelle_etiquette_fta, nombre_portion_fta, OLD_last_id_fta, OLD_id_arcadia_type_calibre,
 OLD_nom_client_demandeur, OLD_besoin_fiche_technique, OLD_echeance_demandeur, OLD_besoin_compostage_fta,
 OLD_calibre_defaut, OLD_id_arcadia_emballage_type, OLD_id_arcadia_client_segment, OLD_quantite_hebdomadaire_estime_commande,
 OLD_nom_machine_fta, OLD_frequence_hebdomadaire_estime_commande, OLD_tare_fta, OLD_perte_matiere_fta,
 OLD_besoin_fiche_rendement, OLD_nom_demandeur_fta, OLD_id_arcadia_atelier, OLD_id_arcadia_client_circuit,
 OLD_id_annexe_environnement_conservation_groupe, OLD_societe_demandeur_fta, OLD_type_marinade_fta, OLD_besoin_fiche_productivite_fta,
 OLD_id_arcadia_poste, OLD_date_demandeur_fta, id_annexe_unite_facturation, OLD_type_minerai,
 OLD_id_arcadia_client_reseau, OLD_id_arcadia_maquette_etiquette, OLD_etude_prix_fta, OLD_bon_fabrication_atelier,
 date_creation, CODE_ARTICLE, code_article_client, code_article_ldc,
 LIBELLE, LIBELLE_CLIENT, NB_UNIT_ELEM, OLD_NB_UV_PAR_US1,
 Poids_ELEM, OLD_REGROUPEMENT, OLD_UL2, OLD_RGR2,
 OLD_Unite_Facturation, Rayon, actif, Site_de_production,
 Duree_de_vie, Duree_de_vie_technique, OLD_code_barre_specifique, OLD_transfert_PF,
 OLD_Zone_picking, OLD_fiche_palette_specifique, OLD_TARIF, pvc_article,
 OLD_pvc_article_kg, OLD_FAMILLE_BUDGET, OLD_FAMILLE_ARTICLE, OLD_id_access_familles_gammes,
 OLD_Cout_Denree, OLD_Cout_Emballage, OLD_Cout_Autre, OLD_Cout_PF,
 OLD_FAMILLE_MKTG, Composition, composition1, libelle_multilangue,
 K_etat, EAN_UVC, EAN_COLIS, EAN_PALETTE,
 OLD_nouvel_article, OLD_k_gestion_lot, activation_codesoft_arti2, id_etiquette_codesoft_arti2,
 atmosphere_protectrice, image_eco_emballage, libelle_code_article_client, id_service_consommateur,
 nom_societe, id_fta_classification2,pourcentage_avancement, liste_id_fta_role)"
                        . " SELECT id_access_arti2, OLD_numft, id_fta_workflow,
 commentaire, OLD_id_fta_palettisation, id_dossier_fta, id_version_dossier_fta,
 OLD_champ_maj_fta, id_fta_etat, createur_fta, date_derniere_maj_fta,
 commentaire_maj_fta, date_echeance_fta, OLD_duree_apres_dernier_processus_fta, OLD_periode_commercialisation_fta,
 code_douane_fta, OLD_code_douane_libelle_fta, poids_emballages_uvc_fta, poids_brut_uvc_fta,
 poids_net_uvc_fta, suffixe_agrologic_fta, OLD_synoptique_valide_fta, origine_transformation_fta,
 remarque_fta, OLD_presentation_fta, apres_ouverture_fta, conseil_rechauffage_valide_fta,
 reference_externe_fta, OLD_duree_vie_technique_fta, designation_commerciale_fta, OLD_nom_abrege_fta,
 site_expedition_fta, conseil_rechauffage_experimentale_fta, OLD_synoptique_experimental_fta, OLD_unite_affichage_fta,
 OLD_signature_validation_fta, OLD_old_gamdesc, OLD_old_segdesc, OLD_old_condition,
 OLD_old_conservation, id_article_agrologic, OLD_id_annexe_environnement_conservation, origine_matiere_fta,
 allergenes_matiere_fta, description_emballage, OLD_date_transfert_industriel, liste_chapitre_maj_fta,
 verrouillage_libelle_etiquette_fta, nombre_portion_fta, OLD_last_id_fta, OLD_id_arcadia_type_calibre,
 OLD_nom_client_demandeur, OLD_besoin_fiche_technique, OLD_echeance_demandeur, OLD_besoin_compostage_fta,
 OLD_calibre_defaut, OLD_id_arcadia_emballage_type, OLD_id_arcadia_client_segment, OLD_quantite_hebdomadaire_estime_commande,
 OLD_nom_machine_fta, OLD_frequence_hebdomadaire_estime_commande, OLD_tare_fta, OLD_perte_matiere_fta,
 OLD_besoin_fiche_rendement, OLD_nom_demandeur_fta, OLD_id_arcadia_atelier, OLD_id_arcadia_client_circuit,
 OLD_id_annexe_environnement_conservation_groupe, OLD_societe_demandeur_fta, OLD_type_marinade_fta, OLD_besoin_fiche_productivite_fta,
 OLD_id_arcadia_poste, OLD_date_demandeur_fta, id_annexe_unite_facturation, OLD_type_minerai,
 OLD_id_arcadia_client_reseau, OLD_id_arcadia_maquette_etiquette, OLD_etude_prix_fta, OLD_bon_fabrication_atelier,
 date_creation, CODE_ARTICLE, code_article_client, code_article_ldc,
 LIBELLE, LIBELLE_CLIENT, NB_UNIT_ELEM, OLD_NB_UV_PAR_US1,
 Poids_ELEM, OLD_REGROUPEMENT, OLD_UL2, OLD_RGR2,
 OLD_Unite_Facturation, Rayon, actif, Site_de_production,
 Duree_de_vie, Duree_de_vie_technique, OLD_code_barre_specifique, OLD_transfert_PF,
 OLD_Zone_picking, OLD_fiche_palette_specifique, OLD_TARIF, pvc_article,
 OLD_pvc_article_kg, OLD_FAMILLE_BUDGET, OLD_FAMILLE_ARTICLE, OLD_id_access_familles_gammes,
 OLD_Cout_Denree, OLD_Cout_Emballage, OLD_Cout_Autre, OLD_Cout_PF,
 OLD_FAMILLE_MKTG, Composition, composition1, libelle_multilangue,
 K_etat, EAN_UVC, EAN_COLIS, EAN_PALETTE,
 OLD_nouvel_article, OLD_k_gestion_lot, activation_codesoft_arti2, id_etiquette_codesoft_arti2,
 atmosphere_protectrice, image_eco_emballage, libelle_code_article_client, id_service_consommateur,
 nom_societe, id_fta_classification2 ,pourcentage_avancement, liste_id_fta_role"
                        . " FROM " . FtaModel::TABLENAME
                        . " WHERE " . FtaModel::KEYNAME . "=" . $paramIdFta
        );
        $key = $pdo->lastInsertId();
        return $key;
    }

    /**
     * Cette fonction retourne le nom DIN, Désignation Interne Normalisée d'une FTA
     * @param type $paramIdFta
     * @return type
     */
    public static function ShowDin($paramIdFta) {

        /*
         * Déclaration des variables
         */
        $ftaModel = new FtaModel($paramIdFta);
        $IdArticleAgrocologic = $ftaModel->getDataField(FtaModel::FIELDNAME_ARTICLE_AGROLOGIC)->getFieldValue();
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
        if ($IdArticleAgrocologic) {
            $din.= $IdArticleAgrocologic;
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
     * Fonction d"insertion d'une Fta
     * @param int $paramIdCreateur
     * @param int $paramIdFtaEtat
     * @param int $paramIdFtaWorkflow
     * @param string $paramDesignationCommerciale
     * @param date $paramDateCreation
     * @param int $paramSiteDeProduction
     * @return int
     */
    public static function CreateFta($paramIdCreateur, $paramIdFtaEtat, $paramIdFtaWorkflow, $paramDesignationCommerciale, $paramDateCreation, $paramSiteDeProduction) {
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

    public static function getArrayIdFtaByIdDossierFta($paramIdDossierFta) {
        $arrayIdFtaChange = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . FtaModel::KEYNAME
                        . "," . FtaModel::FIELDNAME_ID_FTA_ETAT
                        . " FROM " . FtaModel::TABLENAME
                        . " WHERE " . FtaModel::FIELDNAME_DOSSIER_FTA . "=" . $paramIdDossierFta
        );
        return $arrayIdFtaChange;
    }

}
