<?php

//Include des fonctions thématiques

/* Arret de l'utilisation de "fonction_mail"
  Cette fonctionalité a été remplacer par htmlMimeMail qui est baeucoup plus riche en fonctionnalité,
  et qui est un projet OpenSource en activité (contrairement au script perso "fonction_mail")

  Attention au répercution sur les modules utilisant l'ancienne version,
  il y aura du débuggage/migration à apporter sur les "include" dédiés aux fonctions Mails
 */

/*
  include("../fonction_mail/");
  include("../fonction_mail/class.html.mime.mail.inc");
  //include("../fonction_mail/class.smtp.inc");
  //include("../fonction_mail/mimepart.php");
 */

//Nouvelles fonctions plus performante.
//include("../lib/htmlMimeMail-2.5.1/htmlMimeMail.php");
//Fonctions diverses
//Autorisation de consulter le module:
//En effet cette page est chargee par toutes les page de ce module
/*
  if (nom_du_module==0)
  {
  header ("Location: none.php");
  }
 */

/*
  Initialisation des variables globales du modules:
  ----------------------------------------------- */

/* -----------------------------------------------------
  Determination du profil de l'utilisateur pour ce module
  ----------------------------------------------------- */

/*
  Dictionnaire des variables:
  ---------------------------
 */

/* ---------------------------------------------
  FONCTIONS GLOBALES DE TOUS LES MODULE INTRANET
  --------------------------------------------- */

/*
  Exemple de declaration de fonctions
 * **********************************
 */

/* function fonction1($variable1,$variable2, $variable3, $variable4)

  /*
  Dictionnaire des variables:
 * **************************
 */

/*
  {
  //Corps de la fonction

  }
 */

/*
 * ******************************************************************************
 *                            DEBUT DES FONCTIONS                              *
 * ******************************************************************************
 */

/*
  Fonction simplifié et qui permet de conserver une compatibilité avec l'ancien
  Script situé dans "fonction_mail/" tout en utilisant le nouveau
  Script situé dans "lib/htmlMimeMail-2.5.1/htmlMimeMail.php"
 */

function envoismail($sujetmail, $text, $destinataire, $expediteur, $paramTypeMail = null, $conf = null) {

    if ($conf == null) {
        $globalConfig = new GlobalConfig();
    }

    $logMail = new Logger('../'.$globalConfig->getConf()->getUrlRoot().'/log/');


    if ($globalConfig->getConf()->getSmtpServiceEnable() == False) {

        /*
         * Dans le l'environnement développement, 
         * Toutes les adresses emails sont redirigées vers utilisateurs.fta@ldc.fr
         */
        if ($globalConfig->getConf()->getExecEnvironment() == EnvironmentConf::ENV_DEV) {
            $destinataire_orig = $destinataire;
            $destinataire = $globalConfig->getConf()->getSmtpEmailRedirectionUser();

            $sujetmail_orig = $sujetmail;
            $sujetmail = "[Environnement " . $globalConfig->getConf()->getExecEnvironment() . "] " . $sujetmail_orig;

            $text_orig = $text;
            $text = explode(",", $destinataire_orig) . "\n" . $text_orig;
        }
        //Création du mail
        $mail = new htmlMimeMail();
        //$mail->addAttachment($tmp_pdf, $tmp_filename, 'application/pdf');
        //$mail->setFrom($mail_user);
        $mail->setFrom($expediteur);
        //$mail->setSubject("Agis: Fiche Technique Matière Première");
        $mail->setSubject($sujetmail);
        $mail->setText($text);
        //$result = $mail->send(array($adresse_to), 'smtp');
        //$result = $mail->send(array($destinataire), 'smtp');

        switch ($paramTypeMail) {

            case "mail-transactions" :
                /**
                 * Enregistrement des envoies de transactions mail dans le fichier log
                 * 
                 * "date heure : $login : $module : $expediteur : $destinataire : $sujetmail
                 * 
                 */
                $logMail->log("fta", $text, $paramTypeMail, $expediteur, $destinataire, $sujetmail, 1);

                /**
                 * Enregistrement de l'historique des mails dans le fichier log
                 * 
                 * "========================================================="
                 * "date heure : $login : $module : $expediteur : $destinataire : $sujetmail"
                 * "$text"
                 * 
                 */
                $logMail->log("fta", $text, "historique", $expediteur, $destinataire, $sujetmail, 0);
                break;

            case "Correction" :

                /**
                 * Enregistrement des envoies de correction des mails dans le fichier log
                 * 
                 * "========================================================="
                 * "date heure : $login : $module : $expediteur : $destinataire : $sujetmail"
                 * "$text"
                 * 
                 */
                $logMail->log("fta", $text, $paramTypeMail, $expediteur, $destinataire, $sujetmail, 1);
                /**
                 * Enregistrement de l'historique des mails dans le fichier log
                 * 
                 * "========================================================="
                 * "date heure : $login : $module : $expediteur : $destinataire : $sujetmail"
                 * "$text"
                 * 
                 */
                $logMail->log("fta", $text, "historique", $expediteur, $destinataire, $sujetmail, 0);
                break;

            case "Validation" :

                /**
                 * Enregistrement des envoies de validation des mails dans le fichier log
                 * 
                 * "========================================================="
                 * "date heure : $login : $module : $expediteur : $destinataire : $sujetmail"
                 * "$text"
                 * 
                 */
                $logMail->log("fta", $text, $paramTypeMail, $expediteur, $destinataire, $sujetmail, 1);
                /**
                 * Enregistrement de l'historique des mails dans le fichier log
                 * 
                 * "========================================================="
                 * "date heure : $login : $module : $expediteur : $destinataire : $sujetmail"
                 * "$text"
                 * 
                 */
                $logMail->log("fta", $text, "historique", $expediteur, $destinataire, $sujetmail, 0);
                break;
        }



        /**
         * L'envoi réel du mail n'est pas réalisé en environnement Codeur
         */
//        if ($globalConfig->getConf()->getExecEnvironment() != EnvironmentConf::ENV_COD) {
//            $result = $mail->send(array($destinataire), 'smtp');
//        }


        if (!$result) {
            print_r($mail->errors);
        }
        /*
          else
          {
          $titre="Envoi Réussi !";
          $message="Votre mail à bien été envoyé à:<br>$adresse_to";
          $redirection="";
          afficher_message($titre, $message, $redirection);
          //echo 'Mail sent!';
          }//echo $GLOBALS['smtp_ip'];
         */
    }
}

function envoismail_CC($sujetmail, $text, $destinataire, $expediteur, $destinataireCc, $destinataireCCC) {
// rajout de la possibilité d'envoyer le mail en CC ou en copie masqué
    //Création du mail
    $mail = new htmlMimeMail();
    //$mail->addAttachment($tmp_pdf, $tmp_filename, 'application/pdf');
    //$mail->setFrom($mail_user);
    $mail->setFrom($expediteur);
    $mail->setCc($destinataireCc);
    $mail->setBcc($destinataireCCC);
    //$mail->setSubject("Agis: Fiche Technique Matière Première");
    $mail->setSubject($sujetmail);
    $mail->setText($text);
    //$result = $mail->send(array($adresse_to), 'smtp');
    //$result = $mail->send(array($destinataire), 'smtp');
    $result = $mail->send(array($destinataireCC), 'smtp');

    if (!$result) {
        print_r($mail->errors);
        return(0);
    } else {
        return(1);
        /* $titre="Envoi Réussi !";
          $message="Votre mail à bien été envoyé à:<br>$adresse_to";
          $redirection="";
          afficher_message($titre, $message, $redirection);
          //echo 'Mail sent!';
         */
    }//echo $GLOBALS['smtp_ip'];
}

?>