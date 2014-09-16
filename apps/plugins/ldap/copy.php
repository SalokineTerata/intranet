#!/usr/bin/php
<?php
//Changement de répertoire courant vers le répertoire contenant cette page web
//Inutile via Interface Web
chdir (dirname($argv[0]));

//Récupération des variables globales dans le cas d'une navigation
ini_set("session.use_cookies",0);
//include("../session.php");
/**
 * Copies a given object to create a new one.
 *
 * Vars that come in as POST vars
 *  - source_dn (rawurlencoded)
 *  - new_dn (form element)
 *  - server_id
 *
 * @package phpLDAPadmin
 */
/**
 */


//require './common.php';
      //Tout si le script est lancé via CGI ou CLI
/*
      if($mode){
        $argument_1=$mode;              //Variable passée en URL
        $SHELL="/bin/sh";               //Shell utilisé
        $SCRIPTNAME="cli/netcopy.sh";   //Script généré
        $SCRIPTEXE=0;                   //Exécuter le script shell après sa génération ?
      }else{
        $argument_1=$argv[1];           //Premier argument donné en ligne de commande
      }
*/
// LDAP variables
$ldaphost = "10.143.7.3";  // votre serveur LDAP
$ldapport = 389;                 // votre port de serveur LDAP

// Connexion LDAP
$ldapconn = ldap_connect($ldaphost, $ldapport)
          or die("Impossible de se connecter au serveur LDAP $ldaphost");

// Eléments d'authentification LDAP
$ldaprdn  = 'cn=Manager,dc=com';     // DN ou RDN LDAP
$ldappass = '1secret2-';  // Mot de passe associé

if ($ldapconn) {

    // Connexion au serveur LDAP
    $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

    // Vérification de l'authentification
    if ($ldapbind) {
        echo "Connexion LDAP réussie...";
    } else {
        echo "Connexion LDAP échouée...";
    }

}
?>