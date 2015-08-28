<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EnvironmentCod
 *
 * @author salokine
 */
class EnvironmentCod extends EnvironmentAbstract {

    const APPLICATION_HTML_MESSAGE_BEGIN = '<CENTER><BR><FONT SIZE=4><marquee>Environnement développeur</marquee></FONT>';
    const APPLICATION_HTML_MESSAGE_END = '</CENTER>';
    const APPLICATION_LOGO = 'logo_developpeur.gif';
    const APPLICATION_NAME = 'intranet';
    const EXECUTION_ENVIRONMENT = EnvironmentConf::ENV_COD;

    /**
     * Temps maximal en seconde avant de le script s'arrête
     */
    const EXECUTION_TIME_LIMIT = 60;
    const IS_DEBUG_EXEC_ENVIRONMENT_ENABLED = FALSE;

    /**
     * Force l'initialisation systématique de la session à chaque 
     * exécution de script.
     * L'activation de la cette fonctionnalité impact lourdement les
     * performances du site.
     * TRUE: Initialisation systématique.
     * FALSE: l'initialisation n'est réalisée qu'une seule fois pas session.
     */
    const IS_DEBUG_SESSION_ENABLED = FALSE;
    const IS_SERVICE_LDAP_ENABLED = FALSE;
    const IS_SERVICE_SMTP_ENABLED = FALSE;
    const LDAP_SERVER_NAME = EnvironmentConf::LDAP_SERVER_NAME;
    const MYSQL_AUTHENTIFICATION_PASSWORD = '8ale!ne';
    const MYSQL_AUTHENTIFICATION_TABLE_NAME = 'salaries';
    const MYSQL_AUTHENTIFICATION_USER_NAME = 'root';
    const MYSQL_DATABASE_NAME = 'intranet_v3_0_dev';
    const MYSQL_SERVER_NAME = 'dev-intranet.agis.fr';
    const SITE_TITLE = EnvironmentConf::SITE_TITLE;
    const SMTP_EMAIL_REDIRECTION_ADMIN = 'administrateurs.fta@ldc.fr';
    const SMTP_EMAIL_REDIRECTION_USER = 'utilisateurs.fta@ldc.fr';
    const SMTP_SERVER_NAME = 'smtp05401.grpldc.com';
    const URL_PROTOCOL = 'http';
    const URL_ROOT_DIR = 'dev-intranet';
    const URL_SERVEUR_NAME = EnvironmentConf::SITE_COD;
    const URL_SUBDIR = 'apps';

    function __construct() {

        /*
         * Partie 1 :
         */
        $this->setConf(new EnvironmentConf);
        set_time_limit(self::EXECUTION_TIME_LIMIT);

        /*
         * Partie 2 : Bloc de variables pouvant être
         * directement utilisée dans la Partie 3
         */
        $this->getConf()->setUrlProtocol(self::URL_PROTOCOL);
        $this->getConf()->setUrlServer(self::URL_SERVEUR_NAME);
        $this->getConf()->setUrlRootDir(self::URL_ROOT_DIR);
        $this->getConf()->setUrlSubdir(self::URL_SUBDIR);

        /**
         * Partie 3 :
         */
        $this->getConf()->setApplicationName(self::APPLICATION_NAME);
        $this->getConf()->setApplicationTitle(self::SITE_TITLE);
        $this->getConf()->setApplicationLogo(self::APPLICATION_LOGO);
        $this->getConf()->setApplicationLogoMessage(self::APPLICATION_HTML_MESSAGE_BEGIN . $this->getConf()->getHtmlUrlDoc() . self::APPLICATION_HTML_MESSAGE_END);
        $this->getConf()->setExecEnvironmentDebugEnable(self::IS_DEBUG_EXEC_ENVIRONMENT_ENABLED);
        $this->getConf()->setExecEnvironnement(self::EXECUTION_ENVIRONMENT);
        $this->getConf()->setLdapServerName(self::LDAP_SERVER_NAME);
        $this->getConf()->setLdapServiceEnable(self::IS_SERVICE_LDAP_ENABLED);
        $this->getConf()->setMysqlServerName(self::MYSQL_SERVER_NAME);
        $this->getConf()->setMysqlDatabaseName(self::MYSQL_DATABASE_NAME);
        $this->getConf()->setMysqlDatabaseAuthentificationUsername(self::MYSQL_AUTHENTIFICATION_USER_NAME);
        $this->getConf()->setMysqlDatabaseAuthentificationPassword(self::MYSQL_AUTHENTIFICATION_PASSWORD);
        $this->getConf()->setMysqlDatabaseAuthentificationTableName(self::MYSQL_AUTHENTIFICATION_TABLE_NAME);
        $this->getConf()->setSessionDebugEnable(self::IS_DEBUG_SESSION_ENABLED);
        $this->getConf()->setSmtpServerName(self::SMTP_SERVER_NAME);
        $this->getConf()->setSmtpServiceEnable(self::IS_SERVICE_SMTP_ENABLED);
        $this->getConf()->setSmtpEmailRedirectionAdmin(self::SMTP_EMAIL_REDIRECTION_ADMIN);
        $this->getConf()->setSmtpEmailRedirectionUser(self::SMTP_EMAIL_REDIRECTION_USER);
    }

}
