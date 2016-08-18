<?php

/**
 * Description of DatabaseDataJquery
 * Cette classe regroupe les accès à la base de données par jQuery 
 * selon un paramettre instacié.
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

    //Donnée de test
    const TEST = "test";
    //Noms des identifiant utilisé pour l'autocompletion
    const LABEL = "label";
    const VALUE = "value";

    //Initialisation de la class jQuery afin de récupérer les données en JSON de la BDD
    function __construct($paramValue, $paramTerm) {

        $this->setParamValue($paramValue);
        $this->setParamTerm($paramTerm);
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


                break;

            default:
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
         *          array("label" => "JAVA", "value" => "1"),
         *          array("label" => "DATA IMAGE PROCESSING", "value" => "2"),
         *          etc...,
         *      );
         */
        if ($arrayTmp) {
            foreach ($arrayTmp as $key => $rows) {
                $companies[] = array(
                    self::LABEL => $rows[AnnexeEmballageGroupeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE],
                    self::VALUE => $key,
                );
            }
        } else {
            $companies = 0;
        }




        $result = array();
        foreach ($companies as $company) {
//    $companyLabel = $company["label"];
            $companyLabel = $company[self::LABEL];

            /**
             * Vérification si la valeur saisi par l'utilisateur
             * trouve une correspondance avec les données de BDD
             */
            if (strpos(strtoupper($companyLabel), strtoupper($this->getParamTerm())) !== false) {
                array_push($result, $company);
            }
        }

        // Envoi du retour (on renvoi le tableau $retour encodé en JSON)
        $this->setReturnJSON(json_encode($result));
    }

}
