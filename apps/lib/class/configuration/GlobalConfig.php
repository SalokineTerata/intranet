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
     * Nom du script PHP chargé de répartir les post-traitements.
     */
    const DISPATCHER_SCRIPTNAME = 'dispatcher';
    const DISPATCHER_VARNAME = 'dispatcher';
    const DISPATCHER_ACTION_VIEW_RECORD = 'view_record';
    const INITIALIZED_TRUE = TRUE;
    const INITIALIZED_FALSE = FALSE;
    const MYSQL_HOST = 'mysql:host=';
    const MYSQL_DBNAME = ';dbname=';
    const VARNAME_DATABASE_CONNEXION = 'DatabaseConnexion';
    const VARNAME_EXEC_DEBUG_TIME_START = 'exec_debug_time_start';
    const VARNAME_GLOBALCONFIG_IN_PHP_SESSION = 'globalConfig';
    const VARNAME_IS_GLOBALCONFIG_INITIALIZED = 'isGlobalConfigInitialized';
    const VARNAME_IS_DATABASE_INITIALIZED = 'isDatabaseInitialized';
    const APPS_LOG_DIR = 'log';
    const APPS_LOG_FILE_MAIL_TRANSACTION = 'mail-transactions';
    const APPS_LOG_HISTORY_DIR = 'log/history';
    
   
    /**
     * Le fichier est sous la forme 'mail-S' + N°de la semaine du 2 digit + '.log'
     */
    const APPS_LOG_HISTORY_FILE_MAIL = 'mail';

    /**
     * Temps en début de script
     * @var mixed
     */
    static private $execDebugTimeStart = NULL;

    /**
     * @var EnvironmentConf
     */
    private $conf = NULL;
    private $needBuildConf = NULL;

    /**
     * Utilisateur actuellement authentifié sur le site.
     * @var UserModel 
     */
    private $authenticatedUser = NULL;

    /**
     * Connexion à la base de donnée
     * 
     */
    private $databaseconnexion;

    function __construct($paramEnvExec = NULL) {

        /**
         * Par défaut, on estime qu'il n'est pas nécessaire de reconstruire la 
         * configuration de la session.
         */
        $this->setNeedBuildConf(FALSE);
        
        /**
         * Si la GlobalConfig n'existe pas en session PHP, alors il faut
         * la reconstruire.
         */
        if (!self::getIsGlobalConfigExistInPhpSession()) {
            $this->setNeedBuildConf(TRUE);
        } else {
            /**
             * Sinon, on restaure la Configuration précédemment sauvegardée
             * dans la session PHP
             */
            $this->setConf($_SESSION[self::VARNAME_GLOBALCONFIG_IN_PHP_SESSION]->getConf());

            if ($_SESSION[self::VARNAME_GLOBALCONFIG_IN_PHP_SESSION]->getAuthenticatedUser() == NULL) {

//                $this->setAuthenticatedUser(new UserModel);
            } else {
                $this->setAuthenticatedUser($_SESSION[self::VARNAME_GLOBALCONFIG_IN_PHP_SESSION]->getAuthenticatedUser());
            }

            /**
             * Si le mode Debug de session est activé, on reconstruit
             * tout de même la configuration de l'environnement.
             */
            if ($this->getConf()->getSessionDebugEnable()) {
                $this->setNeedBuildConf(TRUE);
            }
        }

        /**
         * Si il s'est précédemment révélé nécessaire de reconstruire
         * la configuration de l'environnement, alors on le réalise.
         */
        if ($this->getNeedBuildConf()) {
            $this->buildEnvironmentConf($paramEnvExec);
        }
    }

    /**
     * Sauvegarde de la GlobalConfig dans la session PHP
     * @param GlobalConfig $paramGlobalConfig
     */
    static function saveGlobalConfToPhpSession(GlobalConfig $paramGlobalConfig) {
        $_SESSION[GlobalConfig::VARNAME_GLOBALCONFIG_IN_PHP_SESSION] = $paramGlobalConfig;
    }

    /**
     * Sauvegarde de la connexion à la base de donnée dans la session PHP
     * @param type $paramDatabaseConnexion
     */
    static function saveDatabaseConnexionToPhpSession($paramDatabaseConnexion) {
        $_SESSION[GlobalConfig::VARNAME_DATABASE_CONNEXION] = $paramDatabaseConnexion;
    }

    /**
     * Ouverture de la connexion MySQL  
     */
    function openDatabaseConnexion() {

        mysql_connect($this->getConf()->getMysqlServerName()
                , $this->getConf()->getMysqlDatabaseAuthentificationUsername()
                , $this->getConf()->getMysqlDatabaseAuthentificationPassword()
                , ''
                , MYSQL_CLIENT_COMPRESS)
        ;
        mysql_select_db($this->getConf()->getMysqlDatabaseName());
        mysql_query('SET NAMES utf8');
    }

    /**
     * Chargement de la description de la base de données en mémoire.
     * Attention, cette partie coûte du temps d'exécution.
     * Elle ne sera exécutée qu'une seule fois par session
     * La connexion à la base MySQL est prérequise.
     */
    function buildDatabaseDescription() {

        if (GlobalConfig::getDatabaseDescriptionIsInitialized() == NULL) {
            DatabaseDescription::buildDatabaseDescription($this->getConf()->getMysqlDatabaseName());

            /**
             * Liste des modules public
             */
            $_SESSION['intranet_module_public'] = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT ' . IntranetModulesModel::FIELDNAME_NOM_USUEL_INTRANET_MODULES
                            . ', ' . IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES
                            . ' FROM ' . IntranetModulesModel::TABLENAME
                            . ' WHERE ' . IntranetModulesModel::FIELDNAME_PUBLIC_INTRANET_MODULES . '=' . '1' . ' '
                            . ' ORDER BY ' . IntranetModulesModel::FIELDNAME_CLASSEMENT_INTRANET_MODULES . ' DESC'
            );

            $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT ' . IntranetModulesModel::FIELDNAME_NOM_USUEL_INTRANET_MODULES
                            . ', ' . IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES
                            . ', ' . IntranetModulesModel::FIELDNAME_CLASSEMENT_INTRANET_MODULES
                            . ', ' . IntranetModulesModel::FIELDNAME_PUBLIC_INTRANET_MODULES
                            . ', ' . IntranetModulesModel::FIELDNAME_VERSION_INTRANET_MODULES
                            . ', ' . IntranetModulesModel::FIELDNAME_VISIBLE_INTRANET_MODULES
                            . ', ' . IntranetModulesModel::FIELDNAME_CSS_INTRANET_MODULES
                            . ', ' . IntranetModulesModel::FIELDNAME_ADMINISTRATION_MODULE
                            . ', ' . IntranetModulesModel::KEYNAME
                            . ' FROM ' . IntranetModulesModel::TABLENAME);
            foreach ($array as $rows) {
                $_SESSION[IntranetModulesModel::TABLENAME][$rows[IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES]][IntranetModulesModel::KEYNAME] = $rows[IntranetModulesModel::KEYNAME];
                $_SESSION[IntranetModulesModel::TABLENAME][$rows[IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES]][IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES] = $rows[IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES];
                $_SESSION[IntranetModulesModel::TABLENAME][$rows[IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES]][IntranetModulesModel::FIELDNAME_NOM_USUEL_INTRANET_MODULES] = $rows[IntranetModulesModel::FIELDNAME_NOM_USUEL_INTRANET_MODULES];
                $_SESSION[IntranetModulesModel::TABLENAME][$rows[IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES]][IntranetModulesModel::FIELDNAME_VERSION_INTRANET_MODULES] = $rows[IntranetModulesModel::FIELDNAME_VERSION_INTRANET_MODULES];
                $_SESSION[IntranetModulesModel::TABLENAME][$rows[IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES]][IntranetModulesModel::FIELDNAME_VISIBLE_INTRANET_MODULES] = $rows[IntranetModulesModel::FIELDNAME_VISIBLE_INTRANET_MODULES];
                $_SESSION[IntranetModulesModel::TABLENAME][$rows[IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES]][IntranetModulesModel::FIELDNAME_CLASSEMENT_INTRANET_MODULES] = $rows[IntranetModulesModel::FIELDNAME_CLASSEMENT_INTRANET_MODULES];
                $_SESSION[IntranetModulesModel::TABLENAME][$rows[IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES]][IntranetModulesModel::FIELDNAME_PUBLIC_INTRANET_MODULES] = $rows[IntranetModulesModel::FIELDNAME_PUBLIC_INTRANET_MODULES];
                $_SESSION[IntranetModulesModel::TABLENAME][$rows[IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES]][IntranetModulesModel::FIELDNAME_CSS_INTRANET_MODULES] = $rows[IntranetModulesModel::FIELDNAME_CSS_INTRANET_MODULES];
                $_SESSION[IntranetModulesModel::TABLENAME][$rows[IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES]][IntranetModulesModel::FIELDNAME_ADMINISTRATION_MODULE] = $rows[IntranetModulesModel::FIELDNAME_ADMINISTRATION_MODULE];
            }
            $this->setDatabaseIsInitializedToTrue();
        } //Fin des enregistrements MySQL en session
    }

    /**
     * Actualisation d'une table de la description de la base de données en memoire 
     * @param type $paramTableName
     */
    function refreshTableInDatabaseDescription($paramTableName) {
        DatabaseDescription::reBuildDatabaseDescription($paramTableName);
    }
    
    function buildEnvironmentConf($paramExec = NULL) {
        /*
          Initialisation des variables de sessions et de connexions:
         */

        /*
         * Chargement de la configuration
         */
        if (!$paramExec) {
            $envConfig = EnvironmentConf::CONFIG_INI_FILE_NAVIGATEUR;
        } else {
            $envConfig = EnvironmentConf::CONFIG_INI_FILE_SHELL;
        }
        $initFile = parse_ini_file($envConfig, TRUE);
        //print_r($initFile);

        /*
         * Serveur provenant de l'URL en cours de navigation par le client
         */
        $serverNameReal = filter_input(INPUT_SERVER, 'HTTP_X_FORWARDED_HOST');
        if ($serverNameReal == NULL) {
            $serverNameReal = filter_input(INPUT_SERVER, 'SERVER_NAME');
        }

        /*
         * Tableau de configuration du paramètres URL_SERVER_NAME 
         */
        $urlServerNameConfig = $initFile[EnvironmentInit::URL_SERVER_NAME];

        /*
         * A-t-on trouvé un environnement ?
         * Par défaut, non.
         */
        $isEnvFound = FALSE;

        /*
         * Recherche du serveur en cours dans la configuration
         */
        foreach ($urlServerNameConfig as $envKey => $serverNameListConfig) {
            /*
             * Transformation de la liste de serveur possibles en tableau PHP
             */
            $serverNameArrayConfig = explode(" ", $serverNameListConfig);

            /*
             * Si le serveur en cours de navigation fait partie des serveurs de 
             * la configuration, alors on charge l'environnement correspondant
             */
            if (in_array(strtolower($serverNameReal), array_map('strtolower', $serverNameArrayConfig))) {
                $envToInit = new EnvironmentInit($envKey, $initFile);
                $isEnvFound = TRUE;
            }
        }

        if ($isEnvFound == FALSE) {
            echo EnvironmentConf::ENVIRONMENT_DONT_EXIST_MESSAGE;
            print_r($urlServerNameConfig);
            $envToInit = null;
        }


        //Initialisation de la configuration
        $this->setConf($envToInit->getConf());


        //Sauvegarde de la configuration dans la session:
        $this->setConfIsInitializedToTrue();
    }

    /**
     * 
     * @return UserModel
     */
    function getAuthenticatedUser() {
        return $this->authenticatedUser;
    }

    /**
     * 
     * @param UserModel $authenticatedUser
     */
    function setAuthenticatedUser(UserModel $authenticatedUser = NULL) {
        $this->authenticatedUser = $authenticatedUser;
    }

    function getNeedBuildConf() {
        return $this->needBuildConf;
    }

    function setNeedBuildConf($needBuildConf) {
        $this->needBuildConf = $needBuildConf;
    }

    /**
     * Ouverture de la connexion MySQL  
     */
    private static function openDatabaseConnexion2($paramGlobalConfig) {
        try {
            $db = new PDO(GlobalConfig::MYSQL_HOST . $paramGlobalConfig->getConf()->getMysqlServerName()
                    . GlobalConfig::MYSQL_DBNAME . $paramGlobalConfig->getConf()->getMysqlDatabaseName()
                    , $paramGlobalConfig->getConf()->getMysqlDatabaseAuthentificationUsername()
                    , $paramGlobalConfig->getConf()->getMysqlDatabaseAuthentificationPassword()
            );
            /**
             * PDO définit simplement le code d'erreur à inspecter
             * et il émettra un message E_WARNING traditionnel
             */
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->exec('SET NAMES utf8');
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
        return $db;
    }

    static function getDatabaseConnexion() {
        $globalConfig = new GlobalConfig();
        return GlobalConfig::openDatabaseConnexion2($globalConfig);
    }

    static function getIsGlobalConfigExistInPhpSession() {
        /**
         * La configuration globale est-elle initialisée ?
         * On récupère cette information stockée dans la session PHP.
         */
        return gettype($_SESSION[self::VARNAME_GLOBALCONFIG_IN_PHP_SESSION]) == 'object';
    }

    static function getConfIsInitialized() {
        /**
         * La configuration globale est-elle initialisée ?
         * On récupère cette information stockée dans la session PHP.
         */
        return $_SESSION[self::VARNAME_IS_GLOBALCONFIG_INITIALIZED];
    }

    function setConfIsInitialized($confIsInitialized) {
        $_SESSION[self::VARNAME_IS_GLOBALCONFIG_INITIALIZED] = $confIsInitialized;
    }

    function setConfIsInitializedToTrue() {
        $this->setConfIsInitialized(self::INITIALIZED_TRUE);
    }

    function setConfIsInitializedToFalse() {
        $this->setConfIsInitialized(self::INITIALIZED_FALSE);
    }

    static function getDatabaseDescriptionIsInitialized() {
        /**
         * La configuration base de données est-elle initialisée ?
         * On récupère cette information stockée dans la session PHP.
         */
        return $_SESSION[self::VARNAME_IS_DATABASE_INITIALIZED];
    }

    function setDatabaseIsInitialized($databaseIsInitialized) {
        $_SESSION[self::VARNAME_IS_DATABASE_INITIALIZED] = $databaseIsInitialized;
    }

    function setDatabaseIsInitializedToTrue() {
        $this->setDatabaseIsInitialized(self::INITIALIZED_TRUE);
    }

    function setDatabaseIsInitializedToFalse() {
        $this->setDatabaseIsInitialized(self::INITIALIZED_FALSE);
    }

    function getConf() {
        return $this->conf;
    }

    function setConf(EnvironmentConf $conf) {
        $this->conf = $conf;
    }

    static function getExecDebugTimeStart() {
        return self::$execDebugTimeStart;
    }

    static function setExecDebugTimeStart() {
        self::$execDebugTimeStart = microtime(true);
    }

//    static public function setExecDebugTimeStart() {
//    }
//Constantes
//    const ENV_COD = 'developpeur';
//    const ENV_DEV = 'developpement';
//    const ENV_REC = 'recette';
//    const ENV_PRD = 'production';
//    const SITE_COD = '127.0.0.1'; //Parfois 'localhost', parfois '127.0.0.1' ...
//    const SITE_DEV = 'dev-fta05401.grpldc.com';
//    const SITE_REC = 'rec-fta05401.grpldc.com';
//    const SITE_PRD = 'prd-fta05401.grpldc.com';
//    const SITE_TITLE = 'Intranet Groupe LDC';
//    const LDAP_DEBUG = false;
//    const DOC_APIGEN_DIR = 'doc/apigen';
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
