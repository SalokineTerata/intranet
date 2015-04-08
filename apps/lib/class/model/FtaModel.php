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
    const FIELDNAME_ARCADIA_EMBALLAGE_TYPE = "id_arcadia_emballage_type";
    const FIELDNAME_BESOIN_FICHE_TECHNIQUE = "besoin_fiche_technique";
    const FIELDNAME_CALIBRE_DEFAUT = "calibre_defaut";
    const FIELDNAME_CATEGORIE_FTA = "id_fta_categorie";
    const FIELDNAME_CIRCUIT_CLIENT = "id_arcadia_client_circuit";
    const FIELDNAME_CREATEUR = "createur_fta";
    const FIELDNAME_DATE_DEMANDEUR = "date_demandeur_fta";
    const FIELDNAME_DATE_ECHEANCE_FTA = "date_echeance_fta";
    const FIELDNAME_DESIGNATION_COMMERCIALE = "designation_commerciale_fta";
    const FIELDNAME_ECHEANCE_DEMANDEUR = "echeance_demandeur";
    const FIELDNAME_ENVIRONNEMENT_CONSERVATION_GROUPE = "id_annexe_environnement_conservation_groupe";
    const FIELDNAME_ETUDE_PRIX_FTA = "etude_prix_fta";
    const FIELDNAME_FREQUENCE_HEBDOMADAIRE_ESTIMEE_COMMANDE = "frequence_hebdomadaire_estime_commande";
    const FIELDNAME_ID_FTA_ETAT = "id_fta_etat";
    const FIELDNAME_NOM_CLIENT_DEMANDEUR = "nom_client_demandeur";
    const FIELDNAME_NOM_DEMANDEUR = "nom_demandeur_fta";
    const FIELDNAME_PCB = "NB_UNIT_ELEM";
    const FIELDNAME_POIDS_ELEMENTAIRE = "Poids_ELEM";
    const FIELDNAME_QUANTITE_HEBDOMADAIRE_ESTIMEE_COMMANDE = "quantite_hebdomadaire_estime_commande";
    const FIELDNAME_RESEAU_CLIENT = "id_arcadia_client_reseau";
    const FIELDNAME_SEGMENT_CLIENT = "id_arcadia_client_segment";
    const FIELDNAME_SOCIETE_DEMANDEUR = "societe_demandeur_fta";
    const FIELDNAME_UNITE_FACTURATION = "id_annexe_unite_facturation";
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
    
        $this->setModelFtaCategorie(
                new FtaCategorieModel($this->getDataField(self::FIELDNAME_CATEGORIE_FTA)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
    
        
        
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

}

?>
