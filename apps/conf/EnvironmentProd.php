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
class EnvironmentProd extends EnvironmentAbstract {

    function __construct() {

        $this->setConf(new EnvironmentConf);

        $this->getConf()->setApplicationName('intranet');
        $this->getConf()->setApplicationTitle(EnvironmentConf::SITE_TITLE);
        $this->getConf()->setApplicationLogo('logo_exploitation.png');
        $this->getConf()->setApplicationLogoMessage('');
        $this->getConf()->setExecEnvironmentDebugEnable(FALSE);
        $this->getConf()->setExecEnvironnement(EnvironmentConf::ENV_COD);
        $this->getConf()->setLdapServerName(EnvironmentConf::LDAP_SERVER_NAME);
        $this->getConf()->setLdapServiceEnable(FALSE);
        $this->getConf()->setMysqlServerName('localhost');
        $this->getConf()->setMysqlDatabaseName('intranet_V3_0');
        $this->getConf()->setMysqlDatabaseAuthentificationUsername('root');
        $this->getConf()->setMysqlDatabaseAuthentificationPassword('');
        $this->getConf()->setMysqlDatabaseAuthentificationTableName('salaries');
        $this->getConf()->setSessionDebugEnable(FALSE);
        $this->getConf()->setSmtpServerName('smtp05401.grpldc.com');
        $this->getConf()->setSmtpServiceEnable(FALSE);
        $this->getConf()->setSmtpEmailRedirectionAdmin('administrateurs.fta@ldc.fr');
        $this->getConf()->setSmtpEmailRedirectionUser('utilisateurs.fta@ldc.fr');
        $this->getConf()->setUrlProtocol('http');
        $this->getConf()->setUrlServer('127.0.0.1');
        $this->getConf()->setUrlRootDir('dev-intranet');
        $this->getConf()->setUrlSubdir('apps');
    }

}
