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
class EnvironmentConf {

    const ENV_COD = "codeur";
    const ENV_DEV = "developpement";
    const ENV_REC = "recette";
    const ENV_PRD = "production";
    const SITE_COD = "127.0.0.1";
    const SITE_DEV = "dev-intranet.agis.fr";
    const SITE_REC = "rec-fta05401.grpldc.com";
    const SITE_PRD = "prd-fta05401.grpldc.com";
    const SITE_TITLE = "Intranet Groupe LDC";
    const LDAP_SERVER_NAME = "ldap05401.grpldc.com";
    const LDAP_DEBUG = false;
    const URL_PROTOCOL = "http";
    const DOC_APIGEN_DIR = "doc/apigen";
    const URL_EASYPHP = "http://127.0.0.1/home";

    //Variables
    //A classer par ordre alphabérique
    private $applicationName = null;
    private $applicationTitle = null;
    private $applicationLogo = null;
    private $applicationLogoMessage = null;
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
    private $urlProtocol = null;
    private $urlRoot = null;       //Suivant environnement
    private $urlServer = null;
    private $urlSubdir = null;

    function getApplicationLogoMessage() {
        return $this->applicationLogoMessage;
    }

    function setApplicationLogoMessage($applicationLogoMessage) {
        $this->applicationLogoMessage = $applicationLogoMessage;
    }

    function getApplicationLogo() {
        return $this->applicationLogo;
    }

    function setApplicationLogo($applicationLogo) {
        $this->applicationLogo = $applicationLogo;
    }

    public function getUrlFullRoot() {
        return $this->getUrlProtocol() . "://"
                . $this->getUrlServer() . "/"
                . $this->getUrlRoot() . "/"
                . $this->getUrlSubdir()
        ;
    }

    public function getUrlProtocol() {
        return $this->urlProtocol;
    }

    public function setUrlProtocol($urlProtocol) {
        $this->urlProtocol = $urlProtocol;
    }

    public function getHtmlUrlDoc() {
        return "<a href=\"" . $this->getUrlFullRoot() . "/"
                . self::DOC_APIGEN_DIR . "\" target=\"_blank\"><img src=../lib/images/apigen.jpeg width=15  border=0> - Doc ApiGen</a>"
                . "<br>"
                . "<a href=\"" 
                . self::URL_EASYPHP . "\" target=\"_blank\"><img src=../lib/images/pma_icone.png width=15  border=0> - Administration EasyPHP</a>"
        ;
    }

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

    public function setApplicationName($applicationName) {
        $this->applicationName = $applicationName;
    }

    public function setApplicationTitle($applicationTitle) {
        $this->applicationTitle = $applicationTitle;
    }

    public function setExecDebugEnable($execDebugEnable) {
        $this->execDebugEnable = $execDebugEnable;
    }

    public function setExecEnvironnement($execEnvironnement) {
        $this->execEnvironnement = $execEnvironnement;
    }

    public function setLdapServerName($ldapServerName) {
        $this->ldapServerName = $ldapServerName;
    }

    public function setLdapServiceEnable($ldapServiceEnable) {
        $this->ldapServiceEnable = $ldapServiceEnable;
    }

    public function setMysqlDatabaseName($mysqlDatabaseName) {
        $this->mysqlDatabaseName = $mysqlDatabaseName;
    }

    public function setMysqlDatabaseAuthentificationPassword($mysqlDatabaseAuthentificationPassword) {
        $this->mysqlDatabaseAuthentificationPassword = $mysqlDatabaseAuthentificationPassword;
    }

    public function setMysqlDatabaseAuthentificationTableName($mysqlDatabaseAuthentificationTableName) {
        $this->mysqlDatabaseAuthentificationTableName = $mysqlDatabaseAuthentificationTableName;
    }

    public function setMysqlDatabaseAuthentificationUsername($mysqlDatabaseAuthentificationUsername) {
        $this->mysqlDatabaseAuthentificationUsername = $mysqlDatabaseAuthentificationUsername;
    }

    public function setMysqlServerName($mysqlServerName) {
        $this->mysqlServerName = $mysqlServerName;
    }

    public function setSessionDebugEnable($sessionDebugEnable) {
        $this->sessionDebugEnable = $sessionDebugEnable;
    }

    public function setSmtpEmailRedirectionAdmin($smtpEmailRedirectionAdmin) {
        $this->smtpEmailRedirectionAdmin = $smtpEmailRedirectionAdmin;
    }

    public function setSmtpEmailRedirectionUser($smtpEmailRedirectionUser) {
        $this->smtpEmailRedirectionUser = $smtpEmailRedirectionUser;
    }

    public function setSmtpServerName($smtpServerName) {
        $this->smtpServerName = $smtpServerName;
    }

    public function setSmtpServiceEnable($smtpServiceEnable) {
        $this->smtpServiceEnable = $smtpServiceEnable;
    }

    public function setUrlRoot($urlRoot) {
        $this->urlRoot = $urlRoot;
    }

    public function setUrlServer($urlServer) {
        $this->urlServer = $urlServer;
    }

    public function setUrlSubdir($urlSubdir) {
        $this->urlSubdir = $urlSubdir;
    }

}

?>
