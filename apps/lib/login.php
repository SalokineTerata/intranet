<?php

//Inclusion
//La déconnexion s'effectue dans session.php
//include ('functions.php');
//include ('../lib/session.php');
require_once '../inc/php.php';


//Variables:

$page = $_SERVER['HTTP_REFERER'];     //Page qui a demandé l'authentification
$_SERVER['REQUEST_METHOD'];   //Méthode d'envoi des informations: la méthode GET n'est pas recommandée car
//on voit le login et le mot de passe dans la barre d'adresse !!
//Variables envoyées par la page d'appel
$globalConfig = new GlobalConfig();
$bdd = $globalConfig->getConf()->getMysqlDatabaseName();
$id_user = Lib::isDefined('id_user');
$login = Lib::isDefined('login');
$num_log = Lib::isDefined('num_log');
$pass = Lib::isDefined('pass');
$position = Lib::isDefined('position');
$session = Lib::isDefined('session');
$session_id = session_id();
$tentative = Lib::isDefined('tentative');
$identite = Lib::isDefined('identite');
$mysql_table_authentification = $globalConfig->getConf()->getMysqlDatabaseAuthentificationTableName();

//Démarrage de la session si celle-ci n'a pas été démarrée.
if (empty($session_id)) {
    session_start();
}


/* ---------------------------------
  destruction de la session
  --------------------------------- */

if ($session == 'logout') {
    if ($id_user) {
        DatabaseOperation::execute(
                'UPDATE ' . LogModel::TABLENAME . ' SET ' . LogModel::FIELDNAME_DATE . ' = now()'
                . ' WHERE ((' . LogModel::KEYNAME . '=\'' . $num_log . '\')'
                . ' AND (' . LogModel::FIELDNAME_ID_USER . '=' . $id_user . '))'
        );
    }
    $pass = '';
    $id_user = '';
    $login = '';



//    session_destroy;
    Acl::cancelValueAccesRights();
    Acl::cancelUserInfos();
    $globalConfig->setAuthenticatedUser(NULL);
    GlobalConfig::saveGlobalConfToPhpSession($globalConfig);
    header('Location: ../index.php');
    /* effacement des fichiers creer dans la session */
}




/* ------------------------------------------------
  fonction de recherche du pass par session ou log
  ------------------------------------------------- */
if ($login) {
    // on redirige avec une variable qui informe qu'on navigue sans identification en niveau 1
    /*
      $req_authentification = 'SELECT * FROM salaries WHERE ( '
      . '(login = '$login') AND '
      . '(pass = PASSWORD('$pass')) AND '
      . '(blocage='non') AND '
      . '(actif='oui') '
      . ')'
      ;
      $q1 = DatabaseOperation::query($req_authentification);
      $nb1 = mysql_numrows($q1);
     */

    $remplacements = array("OR" => "",
        "SELECT" => "",
        "'" => "",
        '"' => "");
    $login = strtr($login, $remplacements);

    if (!$pass) {
        $titre = "Accès aux modules de l'Intranet";
        $message = "Veuillez saisir votre mot de passe.<br><br>"
        ;
        Lib::showMessage($titre, $message, $redirection);
    }

    if (!identification1($mysql_table_authentification, $login, $pass, TRUE)) {

        if ($identite == $login) {
            $tentative++;
            if ($tentative >= 3) {
                /**
                 * On verifie si l'identifiant utiliser existe dans la base de données
                 */
                $uniqueCheck = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT id_user FROM salaries WHERE login=\'' . $login . '\''
                );
                $reponseCheck = count($uniqueCheck);
                if ($reponseCheck == 1) {
//                    $unique = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
//                                    'SELECT id_user FROM salaries WHERE login=\'' . $identite . '\' AND blocage=\'oui\''
//                    );
//                    $reponse = count($unique);
                    $reponse = 0;
                    if ($reponse != 1) {

                        /* envois du mail d'information à l'utilisateur concerné */
                        $corpsmail = 'Votre compte ' . $login . ' de l\'intranet Agis a été bloqué à ' . date("H:m:s") . ' le ' . date("d/m/Y") . ' suite à trois tentatives de connexion avec un mot de passe invalide.
Contactez un Administrateur pour réactiver votre compte.';

                        $arrayMailAdmin = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                        'SELECT ' . UserModel::FIELDNAME_MAIL
                                        . ' FROM ' . UserModel::TABLENAME
                                        . ' WHERE ' . UserModel::FIELDNAME_ID_TYPE . ' =4'
                                        . ' AND ' . UserModel::FIELDNAME_ACTIF . ' =\'' . UserModel::USER_ACTIF . '\'');
                        foreach ($arrayMailAdmin as $rowsmail) {
                            $corpsmail.=' - ' . $rowsmail[UserModel::FIELDNAME_MAIL];
                        }

                        $adrfrom = 'postmaster@agis-sa.fr';
                        $recupmail = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                        'SELECT ' . UserModel::FIELDNAME_MAIL
                                        . ' FROM ' . UserModel::TABLENAME
                                        . ' WHERE ' . UserModel::FIELDNAME_LOGIN . '=\'' . $identite . '\''
                        );
                        foreach ($recupmail as $colonnemail) {
                            $adrTo = $colonnemail[UserModel::FIELDNAME_MAIL];
                        }
                        $sujet = 'connexion intranet Agis';
                        $typeDeMail = 'CompteBloquer';
                        /* Constition du corps du mail */
                        $rep = envoismail($sujet, $corpsmail, $adrTo, $adrfrom, $typeDeMail);
                        $titou = DatabaseOperation::execute(
                                        'UPDATE ' . UserModel::TABLENAME
                                        . ' SET ' . UserModel::FIELDNAME_BLOCAGE . '=\'oui\''
                                        . ' , ' . UserModel::FIELDNAME_DATE_BLOCAGE . '=\'' . date("Y-m-d H:i:s") . '\''
                                        . ' WHERE ' . UserModel::FIELDNAME_LOGIN . '=\'' . $identite . '\''
                        );
                        //Averissement
                        $titre = "Accès aux modules de l'Intranet";
                        $message = UserInterfaceMessage::FR_LOGIN_PROCESS_ACCOUNT_LOCKED;
                        Lib::showMessage($titre, $message, $redirection);
                    }
                } else {
                    $_SESSION['tentative'] = "0";
                    $titre = "Erreur d'identification ";
                    $message = "L'identifiant $login n'existe pas dans la base de données.<br><br>"
                    ;
                    Lib::showMessage($titre, $message, $redirection);
                }
            } else {
                $_SESSION['identite'] = $login;
                $_SESSION['tentative'] = $tentative;
            }
        } else {
            /**
             * On verifie si l'identifiant utiliser existe dans la base de données
             */
            $unique = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT id_user FROM salaries WHERE login=\'' . $login . '\''
            );
            $reponse = count($unique);
            if ($reponse == 1) {
                if ($tentative == 0) {
                    $tentative = 1;
                } else {
                    $tentative++;
                }
                $_SESSION['identite'] = $login;
                $_SESSION['tentative'] = $tentative;
            } else {
                $_SESSION['tentative'] = "0";
                $titre = "Erreur d'identification ";
                $message = "L'identifiant $login n'existe pas dans la base de données.<br><br>"
                ;
                Lib::showMessage($titre, $message, $redirection);
            }
        }

        /* fin nouvelles fonctions tests tentatives */
        header('Location: ' . $page);
    } else {

        //Création des variables une fois l'authentification terminé
        if (!$id_user) {

            $arrayR1 = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT prenom'
                            . ',id_catsopro'
                            . ',id_user'
                            . ',id_catsopro'
                            . ',id_service'
                            . ',id_type'
                            . ',nom'
                            . ',mail'
                            . ',lieu_geo'
                            . ',portail_wiki_salaries'
                            . ' FROM salaries WHERE ( '
                            . '(login = \'' . $login . '\') AND '
                            . '(blocage=\'non\') AND '
                            . '(actif=\'oui\') '
                            . ')');
            if ($arrayR1) {
                foreach ($arrayR1 as $rows) {
                    $prenom = $rows['prenom'];
                    $id_user = $rows[UserModel::KEYNAME];
                    $id_catsopro = $rows['id_catsopro'];
                    $id_service = $rows['id_service'];
                    $nom_type = $rows['id_type'];
                    $nom_famille_ses = $rows['nom'];
                    $mail_user = $rows['mail'];
                    $lieu_geo = $rows['lieu_geo'];
                    $portail_wiki_salaries = $rows['portail_wiki_salaries'];
                }

                $_SESSION[UserModel::FIELDNAME_PASSWORD] = $pass;
                $_SESSION['nom_famille_ses'] = $nom_famille_ses;
                $_SESSION[UserModel::FIELDNAME_LOGIN] = $login;
                $_SESSION[UserModel::FIELDNAME_PRENOM] = $prenom;
                $_SESSION[UserModel::KEYNAME] = $id_user;
                $_SESSION[UserModel::FIELDNAME_ID_CATSOPRO] = $id_catsopro;
                $_SESSION[UserModel::FIELDNAME_ID_SERVICE] = $id_service;
                $_SESSION[UserModel::FIELDNAME_ID_TYPE] = $nom_type;
                $_SESSION['num_log'] = $num_log;
                $_SESSION['position'] = $position;
                //$_SESSION['bdd']=$bdd;
                $_SESSION["mail_user"] = $mail_user;
                $_SESSION[UserModel::FIELDNAME_LIEU_GEO] = $lieu_geo;
                $_SESSION[UserModel::FIELDNAME_PORTAIL_WIKI_SALARIES] = $portail_wiki_salaries;

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
                include ('droits_acces.php');

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
                $req = DatabaseOperation::executeComplete('insert into log (id_user, date) values( ' . $id_user . ', NOW())');
                //$ng=DatabaseOperation::query('select * from log');
                //$num_log=mysql_num_rows($ng);
                $num_log = $req->lastInsertId();
                /* --- redirection si ok sur groupe et service propre --- */
                //$q1 = DatabaseOperation::query('SELECT * FROM $mysql_table_authentification WHERE ((login = '$login') AND (pass = '$pass'))');
                //Page par défaut après un login réussi
            } else {
                $message = UserInterfaceMessage::FR_WARNING_CONNEXION;
                $titre = UserInterfaceMessage::FR_WARNING_CONNEXION_TITLE;
                Lib::showMessage($titre, $message, $redirection);
            }
            header('Location: ' . $page);
        }
    }
}
?>
