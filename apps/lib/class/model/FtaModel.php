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
    const EMBALLAGES_UVC = "1";
    const EMBALLAGES_PAR_COLIS = "2";
    const EMBALLAGES_DU_COLIS = "3";
    const EMBALLAGES_PALETTE = "4";
    const FIELDNAME_ACTIVATION_CODESOFT = "activation_codesoft_arti2";
    const FIELDNAME_ARCADIA_EMBALLAGE_TYPE = "id_arcadia_emballage_type";
    const FIELDNAME_BESOIN_FICHE_TECHNIQUE = "besoin_fiche_technique";
    const FIELDNAME_CALIBRE_DEFAUT = "calibre_defaut";
    const FIELDNAME_CATEGORIE_FTA = "id_fta_categorie";
    const FIELDNAME_CIRCUIT_CLIENT = "id_arcadia_client_circuit";
    const FIELDNAME_CODE_ARTICLE_CLIENT = "code_article_client";
    const FIELDNAME_CODE_ARTICLE_LDC = "code_article_ldc";
    const FIELDNAME_CODE_DOUANE_FTA = "code_douane_fta";
    const FIELDNAME_CODE_DOUANE_LIBELLE_FTA = "code_douane_libelle_fta";
    const FIELDNAME_COMPOSITION1 = "Composition";
    const FIELDNAME_COMPOSITION2 = "composition1";
    const FIELDNAME_CONDITION_SOUS_ATMOSPHERE = "atmosphere_protectrice";
    const FIELDNAME_CONSEIL_APRES_OUVERTURE = "apres_ouverture_fta";
    const FIELDNAME_CONSEIL_DE_RECHAUFFAGE = "conseil_rechauffage_valide_fta";
    const FIELDNAME_CONSEIL_DE_RECHAUFFAGE_DEVELOPPEMENT = "conseil_rechauffage_experimentale_fta";
    const FIELDNAME_CONSEIL_DE_PRESENTATION = "presentation_fta";
    const FIELDNAME_CREATEUR = "createur_fta";
    const FIELDNAME_DATE_DEMANDEUR = "date_demandeur_fta";
    const FIELDNAME_DATE_ECHEANCE_FTA = "date_echeance_fta";
    const FIELDNAME_DATE_PREVISONNELLE_TRANSFERT_INDUSTRIEL = "date_transfert_industriel";
    const FIELDNAME_DESCRIPTION_DU_PRODUIT = "synoptique_valide_fta";
    const FIELDNAME_DESCRIPTION_TECHNIQUE_INTERNE = "synoptique_experimental_fta";
    const FIELDNAME_DESCRIPTION_EMBALLAGE = "description_emballage";
    const FIELDNAME_DESIGNATION_COMMERCIALE = "designation_commerciale_fta";
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
    const FIELDNAME_UNITE_AFFICHAGE = "unite_affichage_fta";
    const FIELDNAME_UNITE_FACTURATION = "id_annexe_unite_facturation";
    const FIELDNAME_VERROUILLAGE_LIBELLE_ETIQUETTE = "verrouillage_libelle_etiquette_fta";
    const ID_POIDS_VARIABLE = "3";
    const UVC_EMBALLAGE = "uvc_emballage";
    const UVC_EMBALLAGE_NET = "uvc_net";
    const UVC_EMBALLAGE_BRUT = "uvc_brut";
    const UVC_EMBALLAGE_DIMENSION = "dimension_uvc";
    const UVC_EMBALLAGE_DIMENSION_HAUTEUR = "dimension_uvc_hauteur";
    const UVC_EMBALLAGE_DIMENSION_LONGEUR = "dimension_uvc_longueur";
    const UVC_EMBALLAGE_DIMENSION_LARGEUR = "dimension_uvc_largeur";
    const COLIS_EMBALLAGE = "colis_emballage";
    const COLIS_EMBALLAGE_NET = "colis_net";
    const COLIS_EMBALLAGE_BRUT = "colis_brut";
    const COLIS_EMBALLAGE_HAUTEUR = "hauteur_colis";
    const PALETTE_EMBALLAGE = "palette_emballage";
    const PALETTE_EMBALLAGE_NET = "palette_net";
    const PALETTE_EMBALLAGE_BRUT = "palette_brut";
    const PALETTE_EMBALLAGE_HAUTEUR = "hauteur_palette";
    const PALETTE_NOMBRE_DE_COUCHE = "couche_palette";
    const PALETTE_NOMBRE_COLIS_PAR_COUCHE = "colis_couche";
    const PALETTE_NOMBRE_TOTAL_PAR_CARTON = "total_colis";

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
     * @var FtaCategorieModel
     */
    private $modelFtaCategorie;

    /**
     * Site d'expédition de la FTA
     * @var GeoModel
     */
    private $modelSiteExpedition;

    /**
     * Model de donnée d'une FTA
     * @var FtaProcessusDelaiModel
     */
    private $modelFtaProcessusDelai;

    /**
     * Site d'expedition de la FTA
     * @var GeoModel
     */
    private $modelSiteExpediton;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);

        // Tables filles
        $this->setModelCreateur(
                new UserModel($this->getDataField(self::FIELDNAME_CREATEUR)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
        $this->setModelFtaEtat(
                new FtaEtatModel($this->getDataField(self::FIELDNAME_ID_FTA_ETAT)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
        $this->setModelFtaCategorie(
                new FtaCategorieModel($this->getDataField(self::FIELDNAME_CATEGORIE_FTA)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );

        $this->setModelSiteExpediton(
                new GeoModel($this->getDataField(self::FIELDNAME_SITE_EXPEDITION_FTA)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
    }

    /**
     * 
     * @return GeoModel
     */
    function getModelSiteExpediton() {
        return $this->modelSiteExpediton;
    }

    function setModelSiteExpediton(GeoModel $modelSiteExpediton) {
        $this->modelSiteExpediton = $modelSiteExpediton;
    }

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

    public function getModelFtaCategorie() {
        return $this->modelFtaCategorie;
    }

    private function setModelFtaCategorie(FtaCategorieModel $modelFtaCategorie) {
        $this->modelFtaCategorie = $modelFtaCategorie;
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
                        . "AND " . FtaCategorieModel::KEYNAME . "=" . $sqlDataIdFtaCategorieValue . " "
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

        return $this->getArrayEmballages(FtaModel::EMBALLAGES_UVC);
    }

    public function getArrayEmballageTypeParColis() {

        return $this->getArrayEmballages(FtaModel::EMBALLAGES_PAR_COLIS);
    }

    public function getArrayEmballageTypeDuColis() {

        return $this->getArrayEmballages(FtaModel::EMBALLAGES_DU_COLIS);
    }

    public function getArrayEmballageTypePalette() {

        return $this->getArrayEmballages(FtaModel::EMBALLAGES_PALETTE);
    }

    private function getArrayEmballages($paramgroupetype) {

        //Les calculs pour Emballages
        $array = DatabaseOperation::convertSqlResultKeyAndOneFieldToArray(
                        "SELECT  * FROM " . FtaConditionnement::TABLENAME . "," . AnnexeEmballageGroupe::TABLENAME . "," . AnnexeEmballageGroupeType::TABLENAME . " "
                        . "WHERE " . FtaConditionnement::FIELDNAME_ID_FTA . "=" . FtaModel::KEYNAME . " "
                        . "AND " . AnnexeEmballageGroupeType::KEYNAME . "=" . $paramgroupetype . " "
                        . "AND " . FtaConditionnement::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . "=" . AnnexeEmballageGroupe::KEYNAME . " "
                        . "AND ( "
                        . "( " . FtaConditionnement::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . " IS NOT NULL AND " . FtaConditionnement::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . "=" . AnnexeEmballageGroupeType::KEYNAME . ")"
                        . " OR "
                        . "( " . FtaConditionnement::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . " IS NULL AND " . AnnexeEmballageGroupe::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION . "=" . AnnexeEmballageGroupeType::KEYNAME . ")"
                        . "    ) "
                        . " ORDER BY " . AnnexeEmballageGroupeType::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE
        );

        foreach ($array as $rows) {
            //Calcul du poids de l'emballage  par UVC            
            $return[FtaModel::UVC_EMBALLAGE] = $rows[FtaConditionnement::FIELDNAME_POIDS_FTA_CONDITIONNEMENT] * $rows[FtaConditionnement::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT] * $rows[FtaConditionnement::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT];

            //Calcul des dimension de l'emballage par UVC  (on recherche la taille la plus grande
            if ($return[FtaModel::UVC_EMBALLAGE_DIMENSION_HAUTEUR] < $rows[FtaConditionnement::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT]) {
                $return[FtaModel::UVC_EMBALLAGE_DIMENSION_HAUTEUR] = $rows[FtaConditionnement::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT];
            }
            if ($return[FtaModel::UVC_EMBALLAGE_DIMENSION_LONGEUR] < $rows[FtaConditionnement::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT]) {
                $return[FtaModel::UVC_EMBALLAGE_DIMENSION_LONGEUR] = $rows[FtaConditionnement::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT];
            }
            if ($return[FtaModel::UVC_EMBALLAGE_DIMENSION_LARGEUR] < $rows[FtaConditionnement::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT]) {
                $return[FtaModel::UVC_EMBALLAGE_DIMENSION_LARGEUR] = $rows[FtaConditionnement::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT];
            }

            //Calcul du poids de Emballages par Colis
            $return[FtaModel::COLIS_EMBALLAGE] = $rows[FtaConditionnement::FIELDNAME_POIDS_FTA_CONDITIONNEMENT] * $rows[FtaConditionnement::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT] * $rows[FtaConditionnement::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT];

            //Calcul de la hauteur par palette
            $return[FtaModel::PALETTE_EMBALLAGE_HAUTEUR] = (($rows[FtaConditionnement::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT] * $return[FtaModel::PALETTE_NOMBRE_DE_COUCHE]) + $rows[FtaConditionnement::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT]) / 1000;

            //Calcul du nombre de colis par couche
            $return[FtaModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE] = $rows[FtaConditionnement::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT];

            //Calcul du nombre de couche par palette
            $return[FtaModel::PALETTE_NOMBRE_DE_COUCHE] = $rows[FtaConditionnement::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT];

            //Calcul du poids de l'emballage par palette
            $return[FtaModel::PALETTE_EMBALLAGE] = ($rows[FtaConditionnement::FIELDNAME_POIDS_FTA_CONDITIONNEMENT] / 1000) * $return[FtaModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE] * $return[FtaModel::PALETTE_NOMBRE_DE_COUCHE];
            $return[FtaModel::PALETTE_EMBALLAGE] = $return[FtaModel::PALETTE_EMBALLAGE] * ($rows[FtaConditionnement::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT] * $rows[FtaConditionnement::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT]);
        }

        //Calcul des dimension de l'emballage par UVC 
        $return[FtaModel::UVC_EMBALLAGE_DIMENSION] = $return[FtaModel::UVC_EMBALLAGE_DIMENSION_LONGEUR] . "x" . $return[FtaModel::UVC_EMBALLAGE_DIMENSION_LARGEUR];

        //Si la hauteur n'est pas nulle, on l'intègre.
        if ($return[FtaModel::UVC_EMBALLAGE_DIMENSION_HAUTEUR]) {
            $return[FtaModel::UVC_EMBALLAGE_DIMENSION] = $return[FtaModel::UVC_EMBALLAGE_DIMENSION] . "x" . $return[FtaModel::UVC_EMBALLAGE_DIMENSION_HAUTEUR];
        }

        //Calcul du poids brut par UVC en g
        $return[FtaModel::UVC_EMBALLAGE_BRUT] = $return[FtaModel::UVC_EMBALLAGE_NET] + $return[FtaModel::UVC_EMBALLAGE];


        //Calcul du poids de Emballages par Colis
        $return[FtaModel::COLIS_EMBALLAGE] = $return[FtaModel::COLIS_EMBALLAGE] * $return[FtaModel::FIELDNAME_PCB];

        //Calcul du poids brut du Colis en Kg
        $return[FtaModel::COLIS_EMBALLAGE_BRUT] = $return[FtaModel::COLIS_EMBALLAGE_NET] + ($return[FtaModel::COLIS_EMBALLAGE] / 1000);

        //Calcul Poids Brut  d'une Palette en Kg
        $return[FtaModel::PALETTE_EMBALLAGE_BRUT] = $return[FtaModel::PALETTE_EMBALLAGE_NET] + $return[FtaModel::PALETTE_EMBALLAGE];

        //Calcul du nombre total de Carton par palette:
        $return[FtaModel::PALETTE_NOMBRE_TOTAL_PAR_CARTON] = $return[FtaModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE] * $return[FtaModel::PALETTE_NOMBRE_DE_COUCHE];
    }

    public function getArrayFta() {

        //Les Calculs de la table fta
        $array = DatabaseOperation::convertSqlResultKeyAndOneFieldToArray(
                        "SELECT * FROM" . FtaModel::TABLENAME
        );

        /**
         * @todo Remplacer par getDataoperation?($value)
         */
        //Calcul du Poids net par UVC
        $return[FtaModel::UVC_EMBALLAGE_NET] = mysql_result($array, 0, FtaModel::FIELDNAME_POIDS_ELEMENTAIRE) * 1000;

        //Calcul du PCB
        $return[FtaModel::FIELDNAME_PCB] = mysql_result($array, 0, FtaModel::FIELDNAME_PCB);
    }

    public function getArrayComposant() {

        //Les Calculs de la table composant        
        $array = DatabaseOperation::convertSqlResultKeyAndOneFieldToArray(
                        "SELECT * FROM " . FtaComposantModel::TABLENAME
                        . "WHERE " . FtaComposantModel::FIELDNAME_ID_FTA . "=" . FtaModel::KEYNAME
                        . " AND " . FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT . "=" . FtaModel::EMBALLAGES_UVC
        );

        foreach ($array as $rows) {

            //Calcul du Poids net par Palette
            $return[FtaModel::PALETTE_EMBALLAGE_NET] = $return[FtaModel::COLIS_EMBALLAGE_NET] * ($rows[FtaConditionnement::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT] * $rows[FtaConditionnement::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT]);

            // Calcul du Poids net par colis
            $return[FtaModel::COLIS_EMBALLAGE_NET] = $return[FtaModel::COLIS_EMBALLAGE_NET] + ($rows[FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION] * $rows[FtaComposantModel::FIELDNAME_POIDS_UNITAIRE_CODIFICATION]);
        }
        /**
         * @todo Remplacer par getDataoperation?($value)
         */
        // Calcul du Poids net par colis
        $return[FtaModel::COLIS_EMBALLAGE_NET] = $return[FtaModel::COLIS_EMBALLAGE_NET] / 1000; //Conversion en g --> Kg
        if (!$return[FtaModel::COLIS_EMBALLAGE_NET]) {
            $return = "SELECT * FROM " . FtaComposantModel::TABLENAME . "WHERE " . FtaComposantModel::FIELDNAME_ID_FTA . "=" . FtaModel::KEYNAME . " AND " . FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT . "=" . FtaModel::EMBALLAGES_UVC;
            $return[FtaModel::COLIS_EMBALLAGE_NET] = mysql_result($array, 0, FtaModel::FIELDNAME_POIDS_ELEMENTAIRE) * mysql_result($array, 0, FtaModel::FIELDNAME_PCB);
        }
    }

    public function getArrayConditionnement() {

        //Les calculs pour la table conditionnment
        $array = DatabaseOperation::convertSqlResultKeyAndOneFieldToArray("SELECT * FROM " . FtaConditionnement::TABLENAME
                        . "WHERE " . FtaConditionnement::FIELDNAME_ID_FTA . "=" . FtaModel::KEYNAME
        );

        /**
         * @todo Remplacer par getDataoperation?($value)
         */
        $return[FtaModel::COLIS_EMBALLAGE_HAUTEUR] = mysql_result($array, 0, FtaConditionnement::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT);
    }

}

?>
