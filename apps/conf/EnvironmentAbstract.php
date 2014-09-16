<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of confEnvironmentCod
 *
 * @author salokine
 */
class EnvironmentAbstract {

    const ENV_COD = "developpeur";
    const ENV_DEV = "developpement";
    const ENV_REC = "recette";
    const ENV_PRD = "production";
    const SITE_COD = "localhost";
    const SITE_DEV = "dev-fta05401.grpldc.com";
    const SITE_REC = "rec-fta05401.grpldc.com";
    const SITE_PRD = "prd-fta05401.grpldc.com";
    const SITE_TITLE = "Intranet Groupe LDC";
    const LDAP_DEBUG = false;

    //Variables
    //A classer par ordre alphabérique
    protected $applicationName = null;
    private $applicationTitle = null;
    private $execDebugEnable = null;
    private $execEnvironnement = null;
    private $ldapServerName = null;
    private $ldapServiceEnable = null;
    private $mysqlDatabaseName = null;
    private $mysqlDatabaseAuthentificationPassword = null; //Suivant environnement
    private $mysqlDatabaseAuthentificationTableName = null;
    private $mysqlDatabaseAuthentificationUsername = null; //Suivant environnement
    private $mysqlServerName = null;  //Suivant environnement
    private $sessionDebugEnable = null;
    private $smtpEmailRedirectionAdmin = null;
    private $smtpEmailRedirectionUser = null;
    private $smtpServerName = null;
    private $smtpServiceEnable = null; //Suivant environnement
    private $urlRoot = null;       //Suivant environnement
    private $urlServer = null;
    private $urlSubdir = null;

    public function getApplicationName() {
        return $this->applicationName;
    }

    public function getApplicationTitle() {
        return $this->applicationTitle;
    }

    public function getExecDebugEnable() {
        return $this->execDebugEnable;
    }

    public function getExecEnvironment() {
        return $this->execEnvironnement;
    }

    public function getLdapServerName() {
        return $this->ldapServerName;
    }

    public function getLdapServiceEnable() {
        return $this->ldapServiceEnable;
    }

    public function getMysqlDatabaseAuthentificationPassword() {
        return $this->mysqlDatabaseAuthentificationPassword;
    }

    public function getMysqlDatabaseAuthentificationTableName() {
        return $this->mysqlDatabaseAuthentificationTableName;
    }

    public function getMysqlDatabaseAuthentificationUsername() {
        return $this->mysqlDatabaseAuthentificationUsername;
    }

    public function getMysqlDatabaseName() {
        return $this->mysqlDatabaseName;
    }

    public function getMysqlServerName() {
        return $this->mysqlServerName;
    }

    public function getSessionDebugEnable() {
        return $this->sessionDebugEnable;
    }

    public function getSmtpEmailRedirectionAdmin() {
        return $this->smtpEmailRedirectionAdmin;
    }

    public function getSmtpEmailRedirectionUser() {
        return $this->smtpEmailRedirectionUser;
    }

    public function getSmtpServerName() {
        return $this->smtpServerName;
    }

    public function getSmtpServiceEnable() {
        return $this->smtpServiceEnable;
    }

    public function getUrlRoot() {
        return $this->urlRoot;
    }

    public function getUrlServer() {
        return $this->urlServer;
    }

    public function getUrlSubdir() {
        return $this->urlSubdir;
    }

}

?>
