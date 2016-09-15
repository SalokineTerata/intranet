<?php

/**
 * Description of DatabaseDataJquery
 * Cette classe regroupe les accès à la base de données par jQuery 
 * selon les paramèttre instaciés au format JSON afin d'être traité en javascript.
 *
 * @author franckwastaken
 */
class DatabaseDataJquery {

    /**
     * Détermine les données de BDD a utilisées
     * @var string 
     */
    private $paramValue;

    /**
     * Valeur saisi par utilisateur pour l'autocompletion
     * @var string 
     */
    private $paramTerm;

    /**
     * Envoi du retour en JSON
     * @var string 
     */
    private $returnJSON;

    /**
     * Paramètre variable 1
     * @var string 
     */
    private $param1;

    /**
     * Paramètre variable 2
     * @var string 
     */
    private $param2;

    //Donnée de test
    const TEST = "test";
    //Liste des emballages
    const LISTE_EMBALLAGE = "listeEmballage";
    //Liste des paramètres possible
    const PARAM1 = "param1";
    const PARAM2 = "param2";
    //Noms des identifiant utilisé pour l'autocompletion
    const LABEL = "label";
    const ID = "id";
    const VALUE = "value";
    const TERM = "term";

    //Initialisation de la class jQuery afin de récupérer les données en JSON de la BDD
    function __construct($paramValue, $paramTerm, $param1 = NULL, $param2 = NULL) {

        $this->setParamValue($paramValue);
        $this->setParamTerm($paramTerm);
        $this->setParam1($param1);
        $this->setParam2($param2);
        $this->checkDataToUse();
    }

    /**
     * Paramètre variable 1
     * @var string 
     */
    function getParam1() {
        return $this->param1;
    }

    /**
     * Paramètre variable 2
     * @var string 
     */
    function getParam2() {
        return $this->param2;
    }

    function setParam1($param1) {
        $this->param1 = $param1;
    }

    function setParam2($param2) {
        $this->param2 = $param2;
    }

    /**
     * Valeur saisi par utilisateur pour l'autocompletion
     * @var string 
     */
    function getParamTerm() {
        return $this->paramTerm;
    }

    function setParamTerm($paramTerm) {
        $this->paramTerm = $paramTerm;
    }

    /**
     * Détermine les données de BDD a utilisées
     * @var string 
     */
    function getParamValue() {
        return $this->paramValue;
    }

    function setParamValue($paramValue) {
        $this->paramValue = $paramValue;
    }

    /**
     * Envoi du retour en JSON
     * @var string 
     */
    function getReturnJSON() {
        return $this->returnJSON;
    }

    function setReturnJSON($returnJSON) {
        $this->returnJSON = $returnJSON;
    }

    /**
     * Determination des données de BDD a utilisées.
     */
    function checkDataToUse() {

        switch ($this->getParamValue()) {
            case self::TEST:
                $this->test();

                break;
            case self::LISTE_EMBALLAGE:
                $this->listEmballage();

                break;
        }
    }

    /**
     * Function de test pour la création d'un moteur de recherche proposant des résultat possible
     */
    function test() {

        $requete = 'SELECT ' . AnnexeEmballageGroupeModel::KEYNAME . ',' . AnnexeEmballageGroupeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE
                . ' FROM ' . AnnexeEmballageGroupeModel::TABLENAME
                . ' WHERE ' . AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION . $op . $idAnnexeEmballageGroupeType //Emballage Primaire et UVC
                . ' ORDER BY ' . AnnexeEmballageGroupeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE
        ;

        $arrayTmp = DatabaseOperation::convertSqlStatementWithKeyAsFirstFieldToArray($requete);

        /**
         * Mise en forme du tableau sous la forme suivant
         *  array(  
         *          array("id" => "1","label" => "JAVA", "value" => "JAVA"),
         *          array("id" => "2","label" => "DATA IMAGE PROCESSING", "value" => "DATA IMAGE PROCESSING"),
         *          etc...,
         *      );
         */
        if ($arrayTmp) {
            foreach ($arrayTmp as $key => $rows) {
                $arrayTestTable[] = array(
                    self::ID => $key,
                    self::LABEL => $rows[AnnexeEmballageGroupeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE],
                    self::VALUE => $rows[AnnexeEmballageGroupeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE]
                );
            }
        } else {
            $arrayTestTable = 0;
        }

        $result = array();
        foreach ($arrayTestTable as $rowsTable) {
            $testLabel = $rowsTable[self::LABEL];

            /**
             * Vérification si la valeur saisi par l'utilisateur
             * trouve une correspondance avec les données de BDD
             */
            if (strpos(strtoupper($testLabel), strtoupper($this->getParamTerm())) !== false) {
                array_push($result, $rowsTable);
            }
        }

        // Envoi du retour (on renvoi le tableau $retour encodé en JSON)
        $this->setReturnJSON(json_encode($result));
    }

    function listEmballage() {
        //Dans le cas d'emballage UVC, on peut avoir de l'emballage primaire
        if ($this->getParam1() == 2) {
            $op = '<=';
        } else {
            $op = '=';
        }
        //Type d'emballage
        $common_select = 'SELECT DISTINCT ' . AnnexeEmballageModel::TABLENAME . '.' . AnnexeEmballageModel::KEYNAME
                . ', CONCAT_WS(\'\', ' . FteFournisseurModel::FIELDNAME_NOM_FTE_FOURNISSEUR . ', \' : \',' . AnnexeEmballageModel::FIELDNAME_REFERENCE_FOURNISSEUR_ANNEXE_EMBALLAGE
                . ',\' (\', ' . AnnexeEmballageModel::FIELDNAME_LONGUEUR_ANNEXE_EMBALLAGE
                . ', \'x\', ' . AnnexeEmballageModel::FIELDNAME_LARGEUR_ANNEXE_EMBALLAGE
                . ', \'x\', ' . AnnexeEmballageModel::FIELDNAME_HAUTEUR_ANNEXE_EMBALLAGE . ', \')\' ) AS INTITULE '
        ;
        $common_from = ' FROM ' . AnnexeEmballageModel::TABLENAME
                . ',' . FteFournisseurModel::TABLENAME
                . ',' . AnnexeEmballageGroupeModel::TABLENAME
        ;
        $common_where = ' WHERE ' . AnnexeEmballageModel::TABLENAME . '.' . AnnexeEmballageModel::FIELDNAME_ID_FTE_FOURNISSEUR
                . '=' . FteFournisseurModel::TABLENAME . '.' . FteFournisseurModel::KEYNAME
                . ' AND ' . AnnexeEmballageGroupeModel::TABLENAME . '.' . AnnexeEmballageGroupeModel::KEYNAME
                . '=' . AnnexeEmballageModel::TABLENAME . '.' . AnnexeEmballageModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE
                . ' AND ' . AnnexeEmballageGroupeModel::TABLENAME . '.' . AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION
                . $op . $this->getParam1()
                . ' AND ' . AnnexeEmballageModel::TABLENAME . '.' . AnnexeEmballageModel::FIELDNAME_ACTIF_ANNEXE_EMBALLAGE
                . "=1"  
        ;
        $common_order = ' ORDER BY ' . FteFournisseurModel::FIELDNAME_NOM_FTE_FOURNISSEUR . ',' . AnnexeEmballageModel::FIELDNAME_REFERENCE_FOURNISSEUR_ANNEXE_EMBALLAGE;


        $req_liste_emballage = $common_select
                . $common_from
                . $common_where
                . $common_order
        ;

        $arrayTmp = DatabaseOperation::convertSqlStatementWithKeyAsFirstFieldToArray($req_liste_emballage);

        /**
         * Mise en forme du tableau sous la forme suivant
         *  array(  
         *          array("id" => "1","label" => "JAVA", "value" => "JAVA"),
         *          array("id" => "2","label" => "DATA IMAGE PROCESSING", "value" => "DATA IMAGE PROCESSING"),
         *          etc...,
         *      );
         */
        if ($arrayTmp) {
            foreach ($arrayTmp as $key => $rows) {
                $arrayListeEmballage[] = array(
                    self::ID => $key,
                    self::LABEL => $rows["INTITULE"],
                    self::VALUE => $rows["INTITULE"]
                );
            }
        } else {
            $arrayListeEmballage = 0;
        }

        $result = array();
        foreach ($arrayListeEmballage as $rowsListeEmballage) {
            $testLabel = $rowsListeEmballage[self::LABEL];

            /**
             * Vérification si la valeur saisi par l'utilisateur
             * trouve une correspondance avec les données de BDD
             */
            if (strpos(strtoupper($testLabel), strtoupper($this->getParamTerm())) !== false) {
                array_push($result, $rowsListeEmballage);
            }
        }

        // Envoi du retour (on renvoi le tableau $retour encodé en JSON)
        $this->setReturnJSON(json_encode($result));
    }

}
