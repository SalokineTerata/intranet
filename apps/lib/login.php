<?php

//Inclusion
//La déconnexion s'effectue dans session.php
//include ("functions.php");
//include ("../lib/session.php");
require_once '../inc/php.php';


//Variables:

$page = $_SERVER["HTTP_REFERER"];     //Page qui a demandé l'authentification
$_SERVER["REQUEST_METHOD"];   //Méthode d'envoi des informations: la méthode GET n'est pas recommandée car
//on voit le login et le mot de passe dans la barre d'adresse !!
//Variables envoyées par la page d'appel
$bdd = $globalConfig->getConf()->getMysqlDatabaseName();
$id_user = Lib::isDefined("id_user");
$login = Lib::getParameterFromRequest("login");
$num_log = Lib::isDefined("num_log");
$pass = Lib::getParameterFromRequest("pass");
$position = Lib::isDefined("position");
$session = Lib::isDefined("session");
$session_id = session_id();
$tentative = Lib::isDefined("tentative");
$identite = Lib::isDefined("identite ");
$globalConfig = new GlobalConfig();
$mysql_table_authentification = $globalConfig->getConf()->getMysqlDatabaseAuthentificationTableName();

//Démarrage de la session si celle-ci n'a pas été démarrée.
if (empty($session_id))
    session_start();


/* ---------------------------------
  destruction de la session
  --------------------------------- */

if ($session == "logout") {

    DatabaseOperation::execute("update log set date = now() where ((num_log='$num_log') and (id_user='$id_user'))");
    $pass = "";
    $id_user = "";
    $login = "";
    session_destroy();
    header("Location: ../index.php");
    /* effacement des fichiers creer dans la session */
}




/* ------------------------------------------------
  fonction de recherche du pass par session ou log
  ------------------------------------------------- */
if ($login) {
    // on redirige avec une variable qui informe qu'on navigue sans identification en niveau 1
    /*
      $req_authentification = "SELECT * FROM salaries WHERE ( "
      . "(login = '$login') AND "
      . "(pass = PASSWORD('$pass')) AND "
      . "(blocage='non') AND "
      . "(actif='oui') "
      . ")"
      ;
      $q1 = DatabaseOperation::query($req_authentification);
      $nb1 = mysql_numrows($q1);
     */

    if (!identification1($mysql_table_authentification, $login, $pass)) {
        /* nouvelle fonction de test des tentatives */
        if ($tentative == 0) {
            $tentative = 1;
        }
        if ($identite == "$login") {
            $tentative++;
            if ($tentative >= 3) {
                $unique = DatabaseOperation::convertSqlStatementWithoutKeyToArray("SELECT * FROM salaries WHERE login='$identite' AND blocage='oui'");
                $reponse = count($unique);
                if ($reponse != 1) {

                    /* envois du mail d'information à l'utilisateur concerné */
                    $corpsmail = "Votre compte pour l'intranet Agis a été bloqué suite à trois tentatives de connexion <br>";
                    $corpsmail.="avec un mot de passe invalide.<br>";
                    $corpsmail.="Contactez un Administrateur pour réactiver votre compte.<br>";

                    $arrayMailAdmin = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                    "SELECT " . UserModel::FIELDNAME_MAIL
                                    . " FROM " . UserModel::TABLENAME
                                    . " WHERE " . UserModel::FIELDNAME_ID_TYPE . " =4"
                                    . " AND " . UserModel::FIELDNAME_ACTIF . " ='oui'");
                    foreach ($arrayMailAdmin as $rowsmail) {
                        $corpsmail.=" - " . $rowsmail[UserModel::FIELDNAME_MAIL] . " <br>";
                    }

                    $adrfrom = "postmaster@agis-sa.fr";
                    $recupmail = DatabaseOperation::convertSqlStatementWithoutKeyToArray("select mail from salaries where login='$identite'");
                    foreach ($recupmail as $colonnemail) {
                        $adrTo = $colonnemail[UserModel::FIELDNAME_MAIL];
                    }
                    $sujet = "connexion intranet Agis";
                    /* Constition du corps du mail */
                    $rep = envoismail($sujet, $corpsmail, $adrTo, $adrfrom);
                    $titou = DatabaseOperation::execute("update salaries set blocage='oui' where (login='$identite')");
                }
            }
        } else {
            $identite = "$login";
            $tentative = 1;
            $_SESSION["identite"];
            $_SESSION["tentative"];
        }

        /* fin nouvelles fonctions tests tentatives */
        header("Location: $page");
    } else {

        //Création des variables une fois l'authentification terminé
        if (!$id_user) {

            $arrayR1 = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            "SELECT * FROM salaries WHERE ( "
                            . "(login = '$login') AND "
                            . "(blocage='non') AND "
                            . "(actif='oui') "
                            . ")");
            foreach ($arrayR1 as $rows) {
                $prenom = $rows["prenom"];
                $id_user = $rows["id_user"];
                $id_catsopro = $rows["id_catsopro"];
                $id_service = $rows["id_service"];
                $nom_type = $rows["id_type"];
                $nom_famille_ses = $rows["nom"];
                $mail_user = $rows["mail"];
                $lieu_geo = $rows["lieu_geo"];
                $portail_wiki_salaries = $rows["portail_wiki_salaries"];
            }

            $_SESSION["pass"] = $pass;
            $_SESSION["nom_famille_ses"] = $nom_famille_ses;
            $_SESSION["login"] = $login;
            $_SESSION["prenom"] = $prenom;
            $_SESSION["id_user"] = $id_user;
            $_SESSION["id_catsopro"] = $id_catsopro;
            $_SESSION["id_service"] = $id_service;
            $_SESSION["id_type"] = $nom_type;
            $_SESSION["num_log"] = $num_log;
            $_SESSION["position"] = $position;
            //$_SESSION["bdd"]=$bdd;
            $_SESSION["mail_user"] = $mail_user;
            $_SESSION["lieu_geo"] = $lieu_geo;
            $_SESSION["portail_wiki_salaries"] = $portail_wiki_salaries;

            /**
             * Enregistrement de l'utilisateur authentifié
             */
            $authenticatedUser = new UserModel($id_user);
            $globalConfig = new GlobalConfig();
            $globalConfig->setAuthenticatedUser($authenticatedUser);
            GlobalConfig::saveGlobalConfToPhpSession($globalConfig);

            /* --------------------------------------------------------------
              Appel de la page qui définit les droits d'accès de l'utilisateur
              dans l'ensemble des pages des modules
              -------------------------------------------------------------- */
            include ("droits_acces.php");

            /* -------------------------------------------------------------
              Variables définissant que l'utilisateur est sur l'Intranet Agis
              cette variable est utile lorsque l'utilisateur utilie des
              applications autres
              ------------------------------------------------------------- */
            //Permet à phpMyAdmin d'identifier l'Intranet
            $application_courante = 'intranet.agis.fr';
            //session_register( 'application_courante' );
            $mysql_user;      //voir session.php
            $bdpass;          //Mot de passe NIV I - voir session.php
            $mysql_database;  //voir session.php

            /* session_register('mysql_user');
              session_register('bdpass');
              session_register('mysql_database');
             */
            /* --------------------------------------------
              Utilisé pour renvoyer un code d'erreur général
              --------------------------------------------/*
              session_register('erreur');
              $erreur=0;
             */
            /* creation de la ligne user dans la table log */
            $req = DatabaseOperation::query("insert into log (id_user, date) values('$id_user', NOW())");
            //$ng=DatabaseOperation::query("select * from log");
            //$num_log=mysql_num_rows($ng);
            $num_log = mysql_insert_id();
            /* --- redirection si ok sur groupe et service propre --- */
            //$q1 = DatabaseOperation::query("SELECT * FROM $mysql_table_authentification WHERE ((login = '$login') AND (pass = '$pass'))");
            //Page par défaut après un login réussi
            header("Location: $page");
        }
    }
}
?>
