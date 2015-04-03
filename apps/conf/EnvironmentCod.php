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

    function __construct() {

        /*
         * Partie 1 :
         */
        $this->setConf(new EnvironmentConf);

        /*
         * Partie 2 : Bloc de variables pouvant être
         * directement utilisée dans la Partie 3
         */
        $this->getConf()->setUrlProtocol("http");
        $this->getConf()->setUrlServer(EnvironmentConf::SITE_COD);
        $this->getConf()->setUrlRoot("dev-intranet");
        $this->getConf()->setUrlSubdir("apps");

        /**
         * Partie 3 :
         */
        $this->getConf()->setApplicationName("intranet");
        $this->getConf()->setApplicationTitle(EnvironmentConf::SITE_TITLE);
        $this->getConf()->setApplicationLogo("logo_developpeur.gif");
        $this->getConf()->setApplicationLogoMessage("<BR><FONT SIZE=4><marquee>Environnement développeur</marquee></FONT>" . $this->getConf()->getHtmlUrlDoc() . "</CENTER>");
        $this->getConf()->setExecDebugEnable(FALSE);
        $this->getConf()->setExecEnvironnement(EnvironmentConf::ENV_COD);
        $this->getConf()->setLdapServerName(EnvironmentConf::LDAP_SERVER_NAME);
        $this->getConf()->setLdapServiceEnable(FALSE);
        $this->getConf()->setMysqlServerName("dev-intranet.agis.fr");
        $this->getConf()->setMysqlDatabaseName("intranet_v3_0_dev");
        $this->getConf()->setMysqlDatabaseAuthentificationUsername("root");
        $this->getConf()->setMysqlDatabaseAuthentificationPassword("8ale!ne");
        $this->getConf()->setMysqlDatabaseAuthentificationTableName("salaries");
        $this->getConf()->setSessionDebugEnable(FALSE);
        $this->getConf()->setSmtpServerName("smtp05401.grpldc.com");
        $this->getConf()->setSmtpServiceEnable(FALSE);
        $this->getConf()->setSmtpEmailRedirectionAdmin("administrateurs.fta@ldc.fr");
        $this->getConf()->setSmtpEmailRedirectionUser("utilisateurs.fta@ldc.fr");
    }

}
