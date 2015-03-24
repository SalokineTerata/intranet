<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of conf
 *
 * @author bs4300280
 */
class GlobalConfig {

    /**
     *
     * @var EnvironmentConf
     */
    private $conf = null;

    function __construct() {
        if (gettype($_SESSION["globalConfig"]) == "object") {
            $this->setConf($_SESSION["globalConfig"]->getConf());
        }
    }

    function getConf() {
        return $this->conf;
    }

    function setConf(EnvironmentConf $conf) {
        $this->conf = $conf;
    }

    //Constantes
//    const ENV_COD = "developpeur";
//    const ENV_DEV = "developpement";
//    const ENV_REC = "recette";
//    const ENV_PRD = "production";
//    const SITE_COD = "127.0.0.1"; //Parfois "localhost", parfois "127.0.0.1" ...
//    const SITE_DEV = "dev-fta05401.grpldc.com";
//    const SITE_REC = "rec-fta05401.grpldc.com";
//    const SITE_PRD = "prd-fta05401.grpldc.com";
//    const SITE_TITLE = "Intranet Groupe LDC";
//    const LDAP_DEBUG = false;
//    const DOC_APIGEN_DIR = "doc/apigen";
    //Variables
    //A classer par ordre alphabérique
//    public $session_debug = false;
//    public $exec_debug = false;
//    public $exec_environnement = null;
//    public $intranet_title = null;
//    public $ldap_server_adress = null;
//    public $ldap_service_enable = null;
//    public $mysql_database_name = null;
//    public $mysql_database_user_name = null; //Suivant environnement
//    public $mysql_database_user_password = null; //Suivant environnement
//    public $mysql_database_host = null;  //Suivant environnement
//    public $mysql_table_authentification = null;
//    public $project_name_simple = null;
//    public $site = null;
//    public $site_webroot = null;       //Suivant environnement
//    public $site_subdir = null;
//    public $smtp_developemnent_email_info_redirection = null;
//    public $smtp_developemnent_email_user_redirection = null;
//    public $smtp_server_adress = null;
//    public $smtp_service_enable = null; //Suivant environnement
}

?>
