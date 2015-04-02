<?php

header('Content-type: text/html; charset=utf-8');
//require_once("../lib/conf.php");
/*
  Récupération de la session PHP
 */
//Attention à bien laisser l'option 'nocache'
//Sinon le cache du navigateur ne se rafraichira pas systématiquement.
session_cache_limiter('nocache');     // Configure le délai d'expiration à X minutes du cache du navigateur
//session_cache_expire (180);

/**
 * Reprise de la session
 */
session_start();

/**
 * Restauration de la session si précédemment initialisée
 */
$globalConfig = new GlobalConfig();
if ($globalConfig->getConfIsInitialized()) {
    /**
     * Si le mode Debug de session est activé, on reconstruit systématiquement la session
     */
    if ($globalConfig->getConf()->getSessionDebugEnable()) {
        session_destroy();
    }
}

/**
 * Si la session a déjà était initialisé, on ne la reconfigure pas à nouveau.
 */
if ($_SESSION["session_init"] == "false") {

    //La session a déjà été initialisé
    //echo "INIT OK";
    //var_dump($_SESSION);
} else {

    //echo "INIT EN COURS";
    $_SESSION["session_init"] = "variable";

    /*
      Initialisation des variables de sessions et de connexions:
     */

    //Variables relatives aux environnements:
    $server = $_SERVER['SERVER_NAME'];
    switch ($server) {

        //Environnement Codeur
        case EnvironmentConf::SITE_COD:

            $envToInit = new EnvironmentCod();
            break;

        //Environnement Développement
        Case EnvironmentConf::SITE_DEV:

            $envToInit = null;
            break;

        //Environnement Production
        Case EnvironmentConf::SITE_PRD:

            $envToInit = null;
            break;

        default:
            echo "L'environnement d'exécution n'a pas pu être trouvé. Vérifiez les fichiers conf/Environment*.php";
            $confToInit = null;
    }
    //Initialisation de la configuration
    $globalConfig->setConf($envToInit->getConf());

    //Sauvegarde de la configuration dans la session:
    $_SESSION["globalConfig"] = $globalConfig;
}//Fin de l'initialisation de la session


/**
 * A chaque ouverture de script et si le paramètre de debug est activé,
 * Chronométrage du temps d'exécution du script.
 */
if ($globalConfig->getConf()->getExecDebugEnable()) {
    $_SESSION["exec_debug_time_start"] = microtime(true);
}

/**
 * Ouverture de la connexion MySQL  
 */
$mysql_connect = mysql_connect($globalConfig->getConf()->getMysqlServerName()
        , $globalConfig->getConf()->getMysqlDatabaseAuthentificationUsername()
        , $globalConfig->getConf()->getMysqlDatabaseAuthentificationPassword()
        , ""
        , MYSQL_CLIENT_COMPRESS)
;
$mysql_select_db = mysql_select_db($globalConfig->getConf()->getMysqlDatabaseName());
mysql_query("SET NAMES utf8");

/**
 * On indique qu'on a terminé l'étape de configuration des variables.
 * La session est prête à être utilisée.
 */
if ($_SESSION["session_init"] == "variable") {


    $_SESSION["session_init"] = "ok";

    /**
     * Information de session public
     */
    //Liste des modules public:
    $req = "SELECT * FROM intranet_modules "
            . "WHERE public_intranet_modules='1' "
            . "ORDER BY classement_intranet_modules DESC"
    ;
    $_SESSION["intranet_module_public"] = DatabaseOperation::query($req);

    //Chargement des méta-données des tables et champs
    DatabaseDescription::buildDatabaseDescription();

    $req = "SELECT * FROM intranet_modules";
    $result = DatabaseOperation::query($req);
    while ($rows = mysql_fetch_array($result)) {
        $_SESSION["intranet_modules"][$rows["nom_intranet_modules"]]["id_intranet_modules"] = $rows["id_intranet_modules"];
        $_SESSION["intranet_modules"][$rows["nom_intranet_modules"]]["nom_intranet_modules"] = $rows["nom_intranet_modules"];
        $_SESSION["intranet_modules"][$rows["nom_intranet_modules"]]["nom_usuel_intranet_modules"] = $rows["nom_usuel_intranet_modules"];
        $_SESSION["intranet_modules"][$rows["nom_intranet_modules"]]["version_intranet_modules"] = $rows["version_intranet_modules"];
        $_SESSION["intranet_modules"][$rows["nom_intranet_modules"]]["visible_intranet_modules"] = $rows["visible_intranet_modules"];
        $_SESSION["intranet_modules"][$rows["nom_intranet_modules"]]["classement_intranet_modules"] = $rows["classement_intranet_modules"];
        $_SESSION["intranet_modules"][$rows["nom_intranet_modules"]]["public_intranet_modules"] = $rows["public_intranet_modules"];
        $_SESSION["intranet_modules"][$rows["nom_intranet_modules"]]["css_intranet_module"] = $rows["css_intranet_module"];
    }
} //Fin des enregistrements MySQL en session

function identification1($mysql_table_authentification, $login, $pass, GlobalConfig $globalConfig = null) {
    $debug = EnvironmentConf::LDAP_DEBUG;
    $return = TRUE;         //On part du principe que l'authentification doit fonctionner
    $mysql_passwd = "";     //On part du principe que l'authentification MySQL ne sera pas nécessaire.
    if ($globalConfig == null) {
        $globalConfig = $_SESSION["globalConfig"];
    }
    $ldap_active = $globalConfig->getConf()->getLdapServiceEnable();
    $ldap_server = $globalConfig->getConf()->getLdapServerName();
    $ldap_context = array("Comptes", "ldcseg");  //Liste des contextes LDAP supportés
    $ldap_result = false;

    //Authentification LDAP
    if ($debug)
        echo "ldap_active=$ldap_active<br>";
    if ($ldap_active) {
        $ldap_connect = ldap_connect($ldap_server);  // doit être un serveur LDAP valide !
        $result_LDAP_OPT_PROTOCOL_VERSION = ldap_set_option($ldap_connect, LDAP_OPT_PROTOCOL_VERSION, 3);
        if ($debug)
            echo "result_LDAP_OPT_PROTOCOL_VERSION=$result_LDAP_OPT_PROTOCOL_VERSION<br>";
        if ($debug)
            $get_LDAP_OPT_PROTOCOL_VERSION = 0;
        if ($debug)
            ldap_get_option($ldap_connect, "LDAP_OPT_PROTOCOL_VERSION", $get_LDAP_OPT_PROTOCOL_VERSION);
        if ($debug)
            echo "LDAP_OPT_PROTOCOL_VERSION=$get_LDAP_OPT_PROTOCOL_VERSION<br>";
        if ($debug)
            echo "ldap_connect = $ldap_connect<br>";
        if ($ldap_connect) {
            if ($debug) {
                $ldap_result = ldap_bind($ldap_connect, "uid=" . $login . ",ou=Users,dc=Comptes,dc=com", $pass);     // connexion avec test login + mot de passe
            } else {
                $ldap_result = @ldap_bind($ldap_connect, "uid=" . $login . ",ou=Users,dc=Comptes,dc=com", $pass);     // connexion avec test login + mot de passe
            }
            if ($debug)
                echo "ldap_result=$ldap_result<br>";
            ldap_close($ldap_connect);
        } else {
            echo "Connexion au serveur LDAP impossible...";
        }
    }

    //Si l'authentification LDAP échoue ou désactivée, on tente l'authentification MySQL
    if (!$ldap_result or $pass == "") {
        $mysql_passwd = "AND (pass=PASSWORD('$pass'))";
        $req_authentification_main = "SELECT * FROM " . $mysql_table_authentification . " WHERE "
                . "(login = '$login') "
                . "AND (blocage='non') "
                . "AND (actif='oui') "
        ;
        $req_authentification = $req_authentification_main . $mysql_passwd;

        $q1 = mysql_query($req_authentification);
        $mysql_result = mysql_numrows($q1);
        if (!$mysql_result) {

            $mysql_passwd = "AND (pass=OLD_PASSWORD('$pass'))";
            $req_authentification = $req_authentification_main . $mysql_passwd;
            $q1 = mysql_query($req_authentification);
            $mysql_result = mysql_numrows($q1);
            if (!$mysql_result) {
                $return = 0;
            }
        }
    }

    return $return;
}

?>
