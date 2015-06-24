<?php

/**
 * Description of FtaModel
 * Table des FTA
 *
 * @author salokine
 */
class FtaModel extends AbstractModel {

    const TABLENAME = "fta";
    const KEYNAME = "id_fta";
    const KEYNAME_CREATEUR = "id_user";
    const FIELDNAME_ACTIVATION_CODESOFT = "activation_codesoft_arti2";
    const FIELDNAME_ARCADIA_EMBALLAGE_TYPE = "id_arcadia_emballage_type";
    const FIELDNAME_ARTICLE_AGROLOGIC = "id_article_agrologic";
    const FIELDNAME_BESOIN_FICHE_TECHNIQUE = "besoin_fiche_technique";
    const FIELDNAME_CALIBRE_DEFAUT = "calibre_defaut";
    const FIELDNAME_CIRCUIT_CLIENT = "id_arcadia_client_circuit";
    const FIELDNAME_CODE_ARTICLE_CLIENT = "code_article_client";
    const FIELDNAME_CODE_ARTICLE_LDC = "code_article_ldc";
    const FIELDNAME_CODE_DOUANE_FTA = "code_douane_fta";
    const FIELDNAME_CODE_DOUANE_LIBELLE_FTA = "code_douane_libelle_fta";
    const FIELDNAME_COMMENTAIRE = "commentaire";
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
    const FIELDNAME_DESCRIPTION_DU_PRODUIT = "synoptique_valide_fta";
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
    const FIELDNAME_ID_FTA_ETAT = "id_fta_etat";
    const FIELDNAME_LIBELLE = "LIBELLE";
    const FIELDNAME_LIBELLE_CLIENT = "LIBELLE_CLIENT";
    const FIELDNAME_LIBELLE_CODE_ARTICLE_CLIENT = "libelle_code_article_client";
    const FIELDNAME_LIBELLE_MULTILANGUE = "libelle_multilangue";
    const FIELDNAME_LISTE_ALLERGENE = "allergenes_matiere_fta";
    const FIELDNAME_LOGO_ECO_EMBALLAGE = "image_eco_emballage";
    const FIELDNAME_NOM_CLIENT_DEMANDEUR = "nom_client_demandeur";
    const FIELDNAME_NOM_ABREGE = "nom_abrege_fta";
    const FIELDNAME_NOM_DEMANDEUR = "nom_demandeur_fta";
    const FIELDNAME_NOMBRE_PORTION_FTA = "nombre_portion_fta";
    const FIELDNAME_NOMBRE_UVC_PAR_CARTON = "NB_UNIT_ELEM";
    const FIELDNAME_ORIGINE_MATIERE_PREMIERE = "origine_matiere_fta";
    const FIELDNAME_PCB = "NB_UNIT_ELEM";
    const FIELDNAME_PERIODE_DE_COMMERCIALISATION = "periode_commercialisation_fta";
    const FIELDNAME_POIDS_ELEMENTAIRE = "Poids_ELEM";
    const FIELDNAME_POIDS_BRUT_UVC = "poids_brut_uvc_fta";
    const FIELDNAME_POIDS_EMBALLAGES_UVC = "poids_emballages_uvc_fta";
    const FIELDNAME_POIDS_NET_UVC = "poids_net_uvc_fta";
    const FIELDNAME_PRODUIT_TRANSFORME = "origine_transformation_fta";
    const FIELDNAME_PVC_ARTICLE = "pvc_article";
    const FIELDNAME_PVC_ARTICLE_KG = "pvc_article_kg";
    const FIELDNAME_QUANTITE_HEBDOMADAIRE_ESTIMEE_COMMANDE = "quantite_hebdomadaire_estime_commande";
    const FIELDNAME_REFERENCE_EXTERNES = "reference_externe_fta";
    const FIELDNAME_REMARQUE = "remarque_fta";
    const FIELDNAME_RESEAU_CLIENT = "id_arcadia_client_reseau";
    const FIELDNAME_SEGMENT_CLIENT = "id_arcadia_client_segment";
    const FIELDNAME_SERVICE_CONSOMMATEUR = "id_service_consommateur";
    const FIELDNAME_SITE_ASSEMBLAGE = "Site_de_production";
    const FIELDNAME_SITE_EXPEDITION_FTA = "site_expedition_fta";
    const FIELDNAME_SOCIETE_DEMANDEUR = "societe_demandeur_fta";
    const FIELDNAME_SUFFIXE_AGROLOGIC_FTA = "suffixe_agrologic_fta";
    const FIELDNAME_UNITE_AFFICHAGE = "unite_affichage_fta";
    const FIELDNAME_UNITE_FACTURATION = "id_annexe_unite_facturation";
    const FIELDNAME_VERROUILLAGE_LIBELLE_ETIQUETTE = "verrouillage_libelle_etiquette_fta";
    const FIELDNAME_VERSION_DOSSIER_FTA = "id_version_dossier_fta";
    const FIELDNAME_VIRTUAL_FTA_COMPOSANT = "VIRTUAL_fta_composant";
    const FIELDNAME_VIRTUAL_FTA_PROCESSUS_DELAI = "VIRTUAL_fta_processus_delai";
    const FIELDNAME_WORKFLOW = "id_fta_workflow";
    const ID_POIDS_VARIABLE = "3";

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
    private $donneeEmballageUVC;
    private $donneeEmballageParColis;
    private $donneeEmballageDuColis;
    private $donneeEmballagePallette;

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
                        $this->getModelFtaCategorie()->getKeyValue()
        );

        //Sélection de tous les processus appartenant au cycle de vie de la FTA
        return DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
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

        return DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT " . FtaProcessusDelaiModel::FIELDNAME_ID_FTA_PROCESSUS . " FROM " . FtaProcessusDelaiModel::TABLENAME . " "
                        . "WHERE " . FtaProcessusDelaiModel::FIELDNAME_ID_FTA . "=" . $sqlDataIdFtaValue . " "
        );
    }

    public function getEcheanceByIdProcessus($paramIdProcessus) {

        //Sélection de tous les processus appartenant au cycle de vie de la FTA
        $sqlDataIdFtaValue = $this->getKeyValue();

        $returnArray = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
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

        //Les calculs pour Emballages
        $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT " . FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT
                        . ", " . FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT
                        . ", " . FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT . ", " . FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT
                        . "  FROM " . FtaConditionnementModel::TABLENAME . ", " . AnnexeEmballageGroupeModel::TABLENAME . ", " . AnnexeEmballageGroupeTypeModel::TABLENAME . " "
                        . " WHERE " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_FTA . "=" . $this->getKeyValue() . " "//peut etre remplacer par new objetfta, qui fait appelle à la fonction getIdFta
                        . " AND " . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . "=" . $paramGroupeType . " "
                        . " AND " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE . "=" . AnnexeEmballageGroupeModel::TABLENAME . "." . AnnexeEmballageGroupeModel::KEYNAME . " "
                        . " AND ( "
                        . "( " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . " IS NOT NULL AND " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . "=" . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . ")"
                        . " OR "
                        . "( " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . " IS NULL AND " . AnnexeEmballageGroupeModel::TABLENAME . "." . AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION . "=" . AnnexeEmballageGroupeTypeModel::TABLENAME . "." . AnnexeEmballageGroupeTypeModel::KEYNAME . ")"
                        . "    ) "
                        . " ORDER BY " . AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE
        );

        if ($array) {
            foreach ($array as $rows) {

                // Calcul du poids de l'emballage  par UVC  
                $return[FtaConditionnementModel::UVC_EMBALLAGE] = FtaConditionnementModel::getCalculPoidsEmballage(
                                $rows[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT]
                                , $rows[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT]
                                , $rows[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT]
                );

                //Calcul des dimensions de l'emballage par UVC 
                $return[FtaConditionnementModel::UVC_EMBALLAGE_DIMENSION] = FtaConditionnementModel::getCalculDimensionEmballageUvc(
                                $return[FtaConditionnementModel::UVC_EMBALLAGE_DIMENSION_HAUTEUR] = 0
                                , $rows[FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT]
                                , $return[FtaConditionnementModel::UVC_EMBALLAGE_DIMENSION_LONGEUR] = 0
                                , $rows[FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT]
                                , $return[FtaConditionnementModel::UVC_EMBALLAGE_DIMENSION_LARGEUR] = 0
                                , $rows[FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT]
                );

                //Les Calculs de la table fta
                $arrayFta = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT DISTINCT " . FtaModel::FIELDNAME_PCB . "," . FtaModel::FIELDNAME_POIDS_ELEMENTAIRE
                                . " FROM " . FtaModel::TABLENAME . " "
                                . " WHERE " . FtaModel::KEYNAME . "=" . $this->getKeyValue()
                );

                foreach ($arrayFta as $rowsFta) {

                    //Calcul du Poids net par UVC
                    $return[FtaConditionnementModel::UVC_EMBALLAGE_NET] = $rowsFta[FtaModel::FIELDNAME_POIDS_ELEMENTAIRE];

                    //Calcul du PCB du colis
                    $return[FtaModel::FIELDNAME_PCB] = $rowsFta[FtaModel::FIELDNAME_PCB];
                }
                //Calcul du poids brut par UVC en g
                $return[FtaConditionnementModel::UVC_EMBALLAGE_BRUT] = FtaConditionnementModel::getCalculPoidsBrutEmballage(
                                $return[FtaConditionnementModel::UVC_EMBALLAGE_NET]
                                , $return[FtaConditionnementModel::UVC_EMBALLAGE]
                );

                //Calcul du poids de Emballages du Colis
                $return[FtaConditionnementModel::COLIS_EMBALLAGE] = FtaConditionnementModel::getCalculPoidsEmballage(
                                $rows[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT]
                                , $rows[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT]
                                , $rows[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT]
                );

                //Calcul du poids de Emballages du Colis
                $return[FtaConditionnementModel::COLIS_EMBALLAGE] = $return[FtaConditionnementModel::COLIS_EMBALLAGE] * $return[FtaModel::FIELDNAME_PCB];

                //Les Calculs de la table composant        
                $arrayComposant = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT " . FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION . "," . FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT . "," . FtaComposantModel::FIELDNAME_POIDS_UNITAIRE_CODIFICATION . " FROM " . FtaComposantModel::TABLENAME
                                . " WHERE " . FtaComposantModel::FIELDNAME_ID_FTA . "=" . $this->getKeyValue()
                                . " AND " . FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT . "=" . FtaConditionnementModel::EMBALLAGES_UVC
                );

                if ($arrayComposant) {
                    foreach ($arrayComposant as $rowsComposant) {

                        // Calcul du Poids net du colis
                        $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET] = FtaConditionnementModel::getCalculGenericMultiplication(
                                        $rowsComposant[FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION]
                                        , $rowsComposant[FtaComposantModel::FIELDNAME_POIDS_UNITAIRE_CODIFICATION]
                        );
                    }
                } else {
                    $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET] = 0;
                }

                // Calcul du Poids net du colis
                $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET] = $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET] / 1000; //Conversion en g --> Kg
                if (!$return[FtaConditionnementModel::COLIS_EMBALLAGE_NET]) {
                    $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET] = FtaConditionnementModel::getCalculGenericMultiplication(
                                    $rowsFta[FtaModel::FIELDNAME_POIDS_ELEMENTAIRE]
                                    , $rowsFta[FtaModel::FIELDNAME_PCB]
                    );
                }

                //Calcul du poids brut du Colis en Kg
                $return[FtaConditionnementModel::COLIS_EMBALLAGE_BRUT] = FtaConditionnementModel::getCalculPoidsBrutEmballageColis(
                                $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET]
                                , $return[FtaConditionnementModel::COLIS_EMBALLAGE]
                );

                //Hauteur du colis
                $return[FtaConditionnementModel::COLIS_EMBALLAGE_HAUTEUR] = $rows[FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT];


                //Calcul du nombre de colis par couche
                $return[FtaConditionnementModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE] = $rows[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT];


                //Calcul du nombre de couche par palette
                $return[FtaConditionnementModel::PALETTE_NOMBRE_DE_COUCHE] = $rows[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT];

                //Calcul du poids de l'emballage par palette

                $return[FtaConditionnementModel::PALETTE_EMBALLAGE] = FtaConditionnementModel::getCalculPoidsEmballagePalette(
                                $rows[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT]
                                , $return[FtaConditionnementModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE]
                                , $return[FtaConditionnementModel::PALETTE_NOMBRE_DE_COUCHE]
                                , $rows[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT]
                                , $rows[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT]
                );


                //Calcul du Poids net par Palette
                $return[FtaConditionnementModel::PALETTE_EMBALLAGE_NET] = FtaConditionnementModel::getCalculPoidsEmballage(
                                $return[FtaConditionnementModel::COLIS_EMBALLAGE_NET]
                                , $rows[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT]
                                , $rows[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT])
                ;

                //Calcul Poids Brut  d'une Palette en Kg
                $return[FtaConditionnementModel::PALETTE_EMBALLAGE_BRUT] = FtaConditionnementModel::getCalculPoidsBrutEmballage(
                                $return[FtaConditionnementModel::PALETTE_EMBALLAGE_NET]
                                , $return[FtaConditionnementModel::PALETTE_EMBALLAGE]
                );

                //Calcul de la hauteur par palette
                $return[FtaConditionnementModel::PALETTE_EMBALLAGE_HAUTEUR] = FtaConditionnementModel::getCalculHauteurEmballagePalette(
                                $rows[FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT]
                                , $return[FtaConditionnementModel::PALETTE_NOMBRE_DE_COUCHE]
                );

                //Calcul du nombre total de Carton par palette:
                $return[FtaConditionnementModel::PALETTE_NOMBRE_TOTAL_PAR_CARTON] = FtaConditionnementModel::getCalculGenericMultiplication(
                                $return[FtaConditionnementModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE]
                                , $return[FtaConditionnementModel::PALETTE_NOMBRE_DE_COUCHE]
                );
            }
        }
        return $return;
    }

    public static function AddIdFTaValidProcess($paramIdEffectue) {
        if ($paramIdEffectue) {
            foreach ($paramIdEffectue as $value) {
                $req .= " OR " . " " . FtaModel::KEYNAME . "=" . $value . " ";
            }
        }
        return $req;
    }

    public static function getIdFtaAndIdWorkflowByIdFtaRoleAndEtatAvancement($paramRole, $paramEtatAvancement) {
        $globalConfig = new GlobalConfig();
        $id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();

        switch ($paramEtatAvancement) {
            case "I";

                $arrayTmp = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT DISTINCT " . FtaModel::KEYNAME . "," . FtaProcessusModel::KEYNAME
                                . " FROM " . FtaSuiviProjetModel::TABLENAME . ", " . FtaWorkflowStructureModel::TABLENAME
                                . ", " . FtaProcessusCycleModel::TABLENAME
                                . " WHERE " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . " in (SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                                . " FROM " . FtaProcessusCycleModel::TABLENAME . ", " . FtaProcessusModel::TABLENAME
                                . ", " . FtaWorkflowModel::TABLENAME . ", " . FtaWorkflowStructureModel::TABLENAME
                                . ", " . IntranetActionsModel::TABLENAME . ", " . IntranetDroitsAccesModel::TABLENAME . ", " . IntranetModulesModel::TABLENAME
                                . ", " . FtaActionRoleModel::TABLENAME . ", " . FtaRoleModel::TABLENAME
                                . ", " . FtaSuiviProjetModel::TABLENAME . ", " . FtaModel::TABLENAME
                                . " WHERE " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                                . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                                . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW . "=1 " // nous déterminons le type de workflow qu'il s'agit pour le moment par défaut v3 test
                                . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                                . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                                . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                                . "=" . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME
                                . " AND " . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME
                                . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE . "=" . $paramRole // Nous recuperons le type de role pour l'utilisateur
                                . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
                                . "=" . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME
                                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $id_user // L'utilisateur connecté
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=1"
                                . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0)"
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0"
                                . " AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='" . $paramEtatAvancement
                                . "' AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                );

                if ($arrayTmp) {
                    foreach ($arrayTmp as $rows) {
                        $tauxDeValidadation = FtaProcessusModel::getFtaProcessusNonValideSuivant($rows[FtaModel::KEYNAME], $rows[FtaProcessusModel::KEYNAME]);
                        if ($tauxDeValidadation <> 1) {
                            $idFtaEffectue[] = $rows[FtaModel::KEYNAME];
                        }
                    }
                }
                $req = "SELECT DISTINCT " . FtaModel::KEYNAME
                        . "," . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
                        . "," . FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW
                        . " FROM " . FtaModel::TABLENAME . "," . FtaWorkflowModel::TABLENAME
                        . " WHERE ( 0 ";

                $req .= FtaModel::AddIdFTaValidProcess($idFtaEffectue);

                $req .= ")";

                $req .= " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                        . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME;


                $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);


                break;
            case "V":
                /*
                 * Recuperer la requete pour des fta attente 
                 */
                break;
            case "A":
                break;
            case "R":
                break;
            case "P":


                $arrayTmp = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT DISTINCT " . FtaModel::KEYNAME . "," . FtaProcessusModel::KEYNAME
                                . " FROM " . FtaSuiviProjetModel::TABLENAME . ", " . FtaWorkflowStructureModel::TABLENAME
                                . ", " . FtaProcessusCycleModel::TABLENAME
                                . " WHERE " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . " in (SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                                . " FROM " . FtaProcessusCycleModel::TABLENAME . ", " . FtaProcessusModel::TABLENAME
                                . ", " . FtaWorkflowModel::TABLENAME . ", " . FtaWorkflowStructureModel::TABLENAME
                                . ", " . IntranetActionsModel::TABLENAME . ", " . IntranetDroitsAccesModel::TABLENAME . ", " . IntranetModulesModel::TABLENAME
                                . ", " . FtaActionRoleModel::TABLENAME . ", " . FtaRoleModel::TABLENAME
                                . ", " . FtaSuiviProjetModel::TABLENAME . ", " . FtaModel::TABLENAME
                                . " WHERE " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                                . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                                . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                                . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                                . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                                . "=" . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME
                                . " AND " . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME
                                . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE . "=" . $paramRole // Nous recuperons le type de role pour l'utilisateur
                                . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
                                . "=" . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME
                                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $id_user // L'utilisateur connecté
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=1"
                                . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0)"
                                . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0"
                                . " AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='" . $paramEtatAvancement
                                . "' AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                );

                if ($arrayTmp) {
                    foreach ($arrayTmp as $rows) {
                        $tauxDeValidadation = FtaProcessusModel::getFtaProcessusNonValideSuivant($rows[FtaModel::KEYNAME], $rows[FtaProcessusModel::KEYNAME]);
                        if ($tauxDeValidadation <> 1) {
                            $idFtaEffectue[] = $rows[FtaModel::KEYNAME];
                        }
                    }
                }
                $req = "SELECT DISTINCT " . FtaModel::KEYNAME
                        . "," . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
                        . "," . FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW
                        . "," . FtaWorkflowModel::KEYNAME
                        . " FROM " . FtaModel::TABLENAME . "," . FtaWorkflowModel::TABLENAME
                        . " WHERE ( 0 ";

                $req .= FtaModel::AddIdFTaValidProcess($idFtaEffectue);

                $req .= ")";

                $req .= " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                        . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME;

                $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);

                break;
        }


        return $array;
    }

}
