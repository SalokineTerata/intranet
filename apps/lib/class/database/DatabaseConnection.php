<?php

class DatabaseConnection extends PDO {

    /**
     * PdoObjet
     * 
     */
    private $PdoObjet;

    function __construct() {
        $globalConfig = new GlobalConfig();
        try {
            parent::__construct(GlobalConfig::MYSQL_HOST . $globalConfig->getConf()->getMysqlServerName()
                    . GlobalConfig::MYSQL_DBNAME . $globalConfig->getConf()->getMysqlDatabaseName()
                    , $globalConfig->getConf()->getMysqlDatabaseAuthentificationUsername()
                    , $globalConfig->getConf()->getMysqlDatabaseAuthentificationPassword()
                    /**
                     *  Les connexions persistantes ne sont pas fermées à la fin du script,mais sont mises en cache 
                     *  et réutilisées lorsqu'un autre script demande une connexion en utilisant les mêmes paramètres
                     */
                    , array(PDO::ATTR_PERSISTENT => true)
            );
            /**
             * PDO définit simplement le code d'erreur à inspecter
             * et il émettra un message E_WARNING traditionnel
             */
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->exec('SET NAMES utf8');
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }

        //  $this->setPdoObjet($globalConfig->getDatabaseConnexion());
    }

    function getPdoObjet() {
        return $this->PdoObjet;
    }

    function setPdoObjet($PdoObjet) {
        $this->PdoObjet = $PdoObjet;
    }

}
