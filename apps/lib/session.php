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

session_start();

$conf = $_SESSION["conf"];

//Debug
if ($conf->session_debug == true) {
    session_destroy();
}

//if ($_SESSION["session_init"] == "ok") {
if ($_SESSION["session_init"] == "false") {

    //La session a déjé été initialisé
    //echo "INIT OK";
    //var_dump($_SESSION);
} else {

    //echo "INIT EN COURS";
    $_SESSION["session_init"] = "variable";

    /*
      Initialisation des variables de sessions et de connexions:
     */

//    $conf = new conf();
//    $conf->ldap_server_adress = "ldap05401.grpldc.com";
//    $_SESSION["conf"]=$conf;
    $conf = new GlobalConfig();

    //$environment = simplexml_load_file("../conf/environment.xml");
    //Variables communes à tous les environnements:
    $conf->ldap_server_adress = "ldap05401.grpldc.com";
    $conf->mysql_database_name = "intranet_V3_0";
    $conf->mysql_table_authentification = "salaries";
    $conf->project_name_simple = "intranet";
    $conf->project_version = "3.0";
    $conf->site = $_SERVER['SERVER_NAME'];
    $conf->smtp_developemnent_email_info_redirection = "administrateurs.fta@ldc.fr";
    $conf->smtp_developemnent_email_user_redirection = "utilisateurs.fta@ldc.fr";
    $conf->smtp_server_adress = "smtp05401.grpldc.com";

//Variables relatives aux environnements:
    switch ($conf->site) {
        //Environnement Développeur
        //Case $environment->conf[0]->server:
        Case GlobalConfig::SITE_COD:

            $conf->mysql_database_name = $conf->mysql_database_name . "_DEV";
            $conf->session_debug = false;
            $conf->exec_debug = false;
            $conf->exec_environnement = GlobalConfig::ENV_COD;
            $conf->ldap_service_enable = false;
            $conf->mysql_database_host = "localhost";
            $conf->mysql_database_user_name = "root";
            $conf->mysql_database_user_password = "";
            $conf->site_subdir = "/" . $conf->project_name_simple . "-" . $conf->project_version;
            $conf->site_webroot = "http://" . $conf->site . $conf->site_subdir;
            $conf->smtp_service_enable = FALSE;

            break;

        //Environnement Développement
        Case GlobalConfig::SITE_DEV:

            $conf->session_debug = false;
            $conf->exec_debug = true;
            $conf->exec_environnement = GlobalConfig::ENV_DEV;
            $conf->ldap_service_enable = true;
            $conf->mysql_database_host = "localhost";
            $conf->mysql_database_user_name = "ftaadm";
            $conf->mysql_database_user_password = "psH36aN";
            $conf->site_subdir = "";
            $conf->site_webroot = "http://" . $conf->site . "/";
            $conf->smtp_service_enable = true;

            break;

        //Environnement Production
        Case GlobalConfig::SITE_PRD:

            $conf->session_debug = false;
            $conf->exec_debug = false;
            $conf->exec_environnement = GlobalConfig::ENV_PRD;
            $conf->ldap_service_enable = true;
            $conf->mysql_database_host = "localhost";
            $conf->mysql_database_user_name = "ftaadm";
            $conf->mysql_database_user_password = "psH36aN";
            $conf->site_subdir = "";
            $conf->site_webroot = "http://" . $conf->site . "/";
            $conf->smtp_service_enable = true;

            break;
        default:
            echo "L'environnement d'exécution n'a pas pu être trouvé. Configurez le fichier conf/environment.xml";
    }


    //Enregistremenbt de la configuration dans la session:

    $_SESSION["conf"] = $conf;
}//Fin de l'initialisation de la session
//A chaque ouverture de script:

if ($conf->exec_debug) {
    $_SESSION["exec_debug_time_start"] = microtime(true);
}

/*
  Ouverture de la connexion MySQL
 */
$mysql_connect = mysql_connect($conf->mysql_database_host
        , $conf->mysql_database_user_name
        , $conf->mysql_database_user_password
        , ""
        , MYSQL_CLIENT_COMPRESS)
;
$mysql_select_db = mysql_select_db($conf->mysql_database_name);
mysql_query("SET NAMES utf8");


if ($_SESSION["session_init"] == "variable") {

    $_SESSION["session_init"] = "ok";


    /*     * ****************************************************
     * Information de session public
     * **************************************************** */

//Liste des modules public:
    $req = "SELECT * FROM intranet_modules "
            . "WHERE public_intranet_modules='1' "
            . "ORDER BY classement_intranet_modules DESC"
    ;
    $_SESSION["intranet_module_public"] = DatabaseOperation::query($req, "table");
//    $i = 0;
//    while ($rows = mysql_fetch_array($result, MYSQL_ASSOC)) {
//        $_SESSION["intranet_module_public"][$i] = $rows;
//        //$_SESSION["intranet_module_public"][$i]["nom_usuel_intranet_modules"] = $rows["nom_usuel_intranet_modules"];
//        $i = $i + 1;
//    }
//
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
} //Fin des enregistrement MySQL en session

function identification1($mysql_table_authentification, $login, $pass, $conf = null) {
    $DEBUG = GlobalConfig::LDAP_DEBUG;
    $return = true;      //On part du principe que l'authentification doit fonctionner
    $mysql_passwd = "";   //On part du principe que l'authentification MySQL ne sera pas nécessaire.
    if ($conf == null) {
        $conf = $_SESSION["conf"];
    }
    $ldap_active = $conf->ldap_service_enable;
    $ldap_server = $conf->ldap_server_adress;
    $ldap_context = array("Comptes", "ldcseg");  //Liste des contextes LDAP supportés
    $ldap_result = false;

    //Authentification LDAP
    if ($DEBUG)
        echo "ldap_active=$ldap_active<br>";
    if ($ldap_active) {
        $ldap_connect = ldap_connect($ldap_server);  // doit être un serveur LDAP valide !
        $result_LDAP_OPT_PROTOCOL_VERSION = ldap_set_option($ldap_connect, LDAP_OPT_PROTOCOL_VERSION, 3);
        if ($DEBUG)
            echo "result_LDAP_OPT_PROTOCOL_VERSION=$result_LDAP_OPT_PROTOCOL_VERSION<br>";
        if ($DEBUG)
            $get_LDAP_OPT_PROTOCOL_VERSION = 0;
        if ($DEBUG)
            ldap_get_option($ldap_connect, "LDAP_OPT_PROTOCOL_VERSION", $get_LDAP_OPT_PROTOCOL_VERSION);
        if ($DEBUG)
            echo "LDAP_OPT_PROTOCOL_VERSION=$get_LDAP_OPT_PROTOCOL_VERSION<br>";
        if ($DEBUG)
            echo "ldap_connect = $ldap_connect<br>";
        if ($ldap_connect) {
            if ($DEBUG) {
                $ldap_result = ldap_bind($ldap_connect, "uid=" . $login . ",ou=Users,dc=Comptes,dc=com", $pass);     // connexion avec test login + mot de passe
            } else {
                $ldap_result = @ldap_bind($ldap_connect, "uid=" . $login . ",ou=Users,dc=Comptes,dc=com", $pass);     // connexion avec test login + mot de passe
            }
            if ($DEBUG)
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

//Fin de la fonctoin d'identification
//function lib_isset($variable_name, $variable_default_value = null) {
//    $result = (isset($_REQUEST[$variable_name]) && $_REQUEST["$variable_name"] != '') ? $_REQUEST["$variable_name"] : "$variable_default_value";
//    return $result;
//}
?>
