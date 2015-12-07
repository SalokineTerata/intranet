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

    const CONFIG_INI_FILE = "../../config.ini";
    const ENV_COD = 'ENV_COD';
    const ENV_DEV = 'ENV_DEV';
    const ENV_REC = 'ENV_REC';
    const ENV_PRD = 'ENV_PRD';
//    const SITE_COD = '127.0.0.1';
//    const SITE_DEV = 'dev-intranet.agis.fr';
//    const SITE_REC = 'rec-fta05401.grpldc.com';
//    const SITE_PRD = 'prd-fta05401.grpldc.com';
//    const SITE_TITLE = 'Intranet Groupe LDC';
//    const LDAP_SERVER_NAME = 'ldap05401.grpldc.com';
//    const LDAP_DEBUG = false;
//    const URL_PROTOCOL = 'http';
    const DOC_APIGEN_DIR = 'doc/apigen';
    const URL_EASYPHP = 'http://127.0.0.1/home';
    const ENVIRONMENT_DONT_EXIST_MESSAGE = 'L\'environnement d\'exécution n\'a pas pu être trouvé. Vérifiez les fichiers conf/Environment*.php';

    //Variables
    //A classer par ordre alphabérique
    private $applicationVersion = null;
    private $applicationName = null;
    private $applicationTitle = null;
    private $applicationLogo = null;
    private $applicationLogoPDF = null;
    private $applicationLogoMessage = null;
    private $execDebugEnable = null;
    private $execEnvironnement = null;
    private $ldapServerName = null;
    private $ldapServiceEnable = null;
    private $mysqlDatabaseName = null;
    private $mysqlDatabaseAuthentificationPassword = null; //Suivant environnement
    private $mysqlDatabaseAuthentificationTableName = null;
    private $mysqlDatabaseAuthentificationUsername = null; //Suivant environnement

    /**
     * A-t-on le droit d'utiliser l'ancienne méthode de connexion MySQL ?
     * @var boolean 
     */
    private $mysqlDatabaseConnectionOldMethode = null;
    private $mysqlServerName = null;  //Suivant environnement
    private $sessionDebugEnable = null;
    private $smtpEmailRedirectionAdmin = null;
    private $smtpEmailRedirectionUser = null;
    private $smtpServerName = null;
    private $smtpServiceEnable = null; //Suivant environnement
    private $urlProtocol = null;
    private $urlRoot = null;       //Suivant environnement
    private $urlServer = null;
    private $reverseProxyName = null;
    private $urlSubdir = null;
    private $cssBackgroundValue = null;
    private $cssContentValue = null;
    private $cssFta = null;
    private $cssTitleValue = null;

    /**
     * Lien vers la documentation internet ApiGen du projet Intranet
     * @return type
     */
    function getUrlApiGen() {
        return $this->getUrlFullRoot() . "/" . self::DOC_APIGEN_DIR;
    }

    /**
     * A-t-on le droit d'utiliser l'ancienne méthode de connexion MySQL ?
     * @var boolean 
     */
    function getMysqlDatabaseConnectionOldMethode() {
        return $this->mysqlDatabaseConnectionOldMethode;
    }

    function setMysqlDatabaseConnectionOldMethode($mysqlDatabaseConnectionOldMethode) {
        $this->mysqlDatabaseConnectionOldMethode = $mysqlDatabaseConnectionOldMethode;
    }

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

    function getApplicationLogoPDF() {
        return $this->applicationLogoPDF;
    }

    function setApplicationLogoPDF($applicationLogoPDF) {
        $this->applicationLogoPDF = $applicationLogoPDF;
    }

    public function getUrlFullRoot() {
        $UrlFullRoot = $this->getUrlProtocol() . '://'
                . $this->getUrlServer() . '/'
                . $this->getUrlRoot() . '/'
                . $this->getUrlSubdir()
        ;
        return $UrlFullRoot;
    }

    public function getUrlProtocol() {
        return $this->urlProtocol;
    }

    public function setUrlProtocol($urlProtocol) {
        $this->urlProtocol = $urlProtocol;
    }

    public function getHtmlUrlDoc() {
        return '<a href=\'' . $this->getUrlFullRoot() . '/'
                . self::DOC_APIGEN_DIR . '\' target=\'_blank\'><img src=../lib/images/apigen.jpeg width=15  border=0> - Doc ApiGen</a>'
                . '<br>'
                . '<a href=\''
                . self::URL_EASYPHP . '\' target=\'_blank\'><img src=../lib/images/pma_icone.png width=15  border=0> - Administration EasyPHP</a>'
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

    private function getUrlServerClient() {
        if ($this->getReverseProxyName() == "") {
            $urlServer = $this->urlServer;
        } else {
            $urlServer = $this->getReverseProxyName();
        }
        return $urlServer;
    }

    public function getUrlServer() {
        return $this->getUrlServerClient();
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

    public function setExecEnvironmentDebugEnable($execDebugEnable) {
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

    public function setUrlRootDir($urlRoot) {
        $this->urlRoot = $urlRoot;
    }

    public function setUrlServer($urlServer) {
        $this->urlServer = $urlServer;
    }

    public function setUrlSubdir($urlSubdir) {
        $this->urlSubdir = $urlSubdir;
    }

    public function getApplicationVersion() {
        return $this->applicationVersion;
    }

    public function setApplicationVersion($applicationVersion) {
        $this->applicationVersion = $applicationVersion;
    }

    function getReverseProxyName() {
        return $this->reverseProxyName;
    }

    function setReverseProxyName($reverseProxyName) {
        $this->reverseProxyName = $reverseProxyName;
    }

    function getCssFta() {
        return $this->cssFta;
    }

    function setCssFta($cssFta) {
        $this->cssFta = $cssFta;
    }

    function getCssBackgroundValue() {
        return $this->cssBackgroundValue;
    }

    function getCssContentValue() {
        return $this->cssContentValue;
    }

    function getCssTitleValue() {
        return $this->cssTitleValue;
    }

    function setCssBackgroundValue($cssBackgroundValue) {
        $this->cssBackgroundValue = $cssBackgroundValue;
    }

    function setCssContentValue($cssContentValue) {
        $this->cssContentValue = $cssContentValue;
    }

    function setCssTitleValue($cssTitleValue) {
        $this->cssTitleValue = $cssTitleValue;
    }

}

?>
