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
class EnvironmentInit extends EnvironmentAbstract {

    const APPLICATION_HTML_MESSAGE_BEGIN = '<CENTER><BR><FONT SIZE=4><marquee>Environnement ';
    const APPLICATION_HTML_MESSAGE_END = '</marquee></FONT></CENTER>';
    const APPLICATION_LOGO = "APPLICATION_LOGO";
    const APPLICATION_NAME = "APPLICATION_NAME";
    const EXECUTION_ENVIRONMENT_NAME = "EXECUTION_ENVIRONMENT_NAME";
    const EXECUTION_TIME_LIMIT = "EXECUTION_TIME_LIMIT";
    const IS_DEBUG_EXEC_ENVIRONMENT_ENABLED = "IS_DEBUG_EXEC_ENVIRONMENT_ENABLED";
    const IS_DEBUG_SESSION_ENABLED = "IS_DEBUG_SESSION_ENABLED";
    const IS_SERVICE_LDAP_ENABLED = "IS_SERVICE_LDAP_ENABLED";
    const IS_SERVICE_SMTP_ENABLED = "IS_SERVICE_SMTP_ENABLED";
    const LDAP_SERVER_NAME = "LDAP_SERVER_NAME";
    const MYSQL_AUTHENTIFICATION_PASSWORD = "MYSQL_AUTHENTIFICATION_PASSWORD";
    const MYSQL_AUTHENTIFICATION_TABLE_NAME = "MYSQL_AUTHENTIFICATION_TABLE_NAME";
    const MYSQL_AUTHENTIFICATION_USER_NAME = "MYSQL_AUTHENTIFICATION_USER_NAME";
    const IS_MYSQL_USING_OLD_CONNECTION = "IS_MYSQL_USING_OLD_CONNECTION";
    const MYSQL_DATABASE_NAME = "MYSQL_DATABASE_NAME";
    const MYSQL_SERVER_NAME = "MYSQL_SERVER_NAME";
    const SITE_TITLE = "SITE_TITLE";
    const SITE_VERSION = "SITE_VERSION";
    const SMTP_EMAIL_REDIRECTION_ADMIN = "SMTP_EMAIL_REDIRECTION_ADMIN";
    const SMTP_EMAIL_REDIRECTION_USER = "SMTP_EMAIL_REDIRECTION_USER";
    const SMTP_SERVER_NAME = "SMTP_SERVER_NAME";
    const URL_PROTOCOL = "URL_PROTOCOL";
    const URL_ROOT_DIR = "URL_ROOT_DIR";
    const URL_SERVER_NAME = "URL_SERVER_NAME";
    const URL_SUBDIR = "URL_SUBDIR";

    function __construct($paramEnvName, $paramInit) {


        /*
         * Partie 1 :
         */
        $this->setConf(new EnvironmentConf);
        set_time_limit($paramInit[self::EXECUTION_TIME_LIMIT][$paramEnvName]);

        /*
         * Partie 2 : Bloc de variables pouvant être
         * directement utilisée dans la Partie 3
         */
        $this->getConf()->setUrlProtocol($paramInit[self::URL_PROTOCOL][$paramEnvName]);
        $this->getConf()->setUrlServer(filter_input(INPUT_SERVER, 'SERVER_NAME'));
        $this->getConf()->setUrlRootDir($paramInit[self::URL_ROOT_DIR][$paramEnvName]);
        $this->getConf()->setUrlSubdir($paramInit[self::URL_SUBDIR][$paramEnvName]);

        /**
         * Partie 3 :
         */
        $this->getConf()->setApplicationVersion($paramInit[self::SITE_VERSION][$paramEnvName]);
        $this->getConf()->setApplicationName($paramInit[self::APPLICATION_NAME][$paramEnvName]);
        $this->getConf()->setApplicationTitle($paramInit[self::SITE_TITLE][$paramEnvName]);
        $this->getConf()->setApplicationLogo($paramInit[self::APPLICATION_LOGO][$paramEnvName]);
        $this->getConf()->setApplicationLogoMessage(
                self::APPLICATION_HTML_MESSAGE_BEGIN
                . $paramInit[self::EXECUTION_ENVIRONMENT_NAME][$paramEnvName]
                . self::APPLICATION_HTML_MESSAGE_END
        );
        $this->getConf()->setExecEnvironmentDebugEnable($paramInit[self::IS_DEBUG_EXEC_ENVIRONMENT_ENABLED][$paramEnvName]);
        $this->getConf()->setExecEnvironnement($paramInit[self::EXECUTION_ENVIRONMENT_NAME][$paramEnvName]);
        $this->getConf()->setLdapServerName($paramInit[self::LDAP_SERVER_NAME][$paramEnvName]);
        $this->getConf()->setLdapServiceEnable($paramInit[self::IS_SERVICE_LDAP_ENABLED][$paramEnvName]);
        $this->getConf()->setMysqlServerName($paramInit[self::MYSQL_SERVER_NAME][$paramEnvName]);
        $this->getConf()->setMysqlDatabaseName($paramInit[self::MYSQL_DATABASE_NAME][$paramEnvName]);
        $this->getConf()->setMysqlDatabaseAuthentificationUsername($paramInit[self::MYSQL_AUTHENTIFICATION_USER_NAME][$paramEnvName]);
        $this->getConf()->setMysqlDatabaseAuthentificationPassword($paramInit[self::MYSQL_AUTHENTIFICATION_PASSWORD][$paramEnvName]);
        $this->getConf()->setMysqlDatabaseAuthentificationTableName($paramInit[self::MYSQL_AUTHENTIFICATION_TABLE_NAME][$paramEnvName]);
        $this->getConf()->setMysqlDatabaseConnectionOldMethode($paramInit[self::IS_MYSQL_USING_OLD_CONNECTION][$paramEnvName]);
        $this->getConf()->setSessionDebugEnable($paramInit[self::IS_DEBUG_SESSION_ENABLED][$paramEnvName]);
        $this->getConf()->setSmtpServerName($paramInit[self::SMTP_SERVER_NAME][$paramEnvName]);
        $this->getConf()->setSmtpServiceEnable($paramInit[self::IS_SERVICE_SMTP_ENABLED][$paramEnvName]);
        $this->getConf()->setSmtpEmailRedirectionAdmin($paramInit[self::SMTP_EMAIL_REDIRECTION_ADMIN][$paramEnvName]);
        $this->getConf()->setSmtpEmailRedirectionUser($paramInit[self::SMTP_EMAIL_REDIRECTION_USER][$paramEnvName]);
    }

}
