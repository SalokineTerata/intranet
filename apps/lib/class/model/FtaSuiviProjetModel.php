<?php

/**
 * Description of FtaSuiviProjetModel
 * Table des FtaSuiviProjetModel
 *
 * @author salokine
 * @todo finir la table FtaSuiviProjet
 */
class FtaSuiviProjetModel extends AbstractModel {

    const TABLENAME = "fta_suivi_projet";
    const KEYNAME = "id_fta_suivi_projet";
    const FIELDNAME_ID_FTA = "id_fta";
    const FIELDNAME_ID_FTA_CHAPITRE = "id_fta_chapitre";
    const FIELDNAME_COMMENTAIRE_SUIVI_PROJET = "commentaire_suivi_projet";
    const FIELDNAME_DATE_VALIDATION_SUIVI_PROJET = "date_validation_suivi_projet";
    const FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET = "signature_validation_suivi_projet";
    const FIELDNAME_DATE_DEMARRAGE_CHAPITRE_FTA_SUIVI_PROJET = "date_demarrage_chapitre_fta_suivi_projet";
    const FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET = "notification_fta_suivi_projet";
    const FIELDNAME_CORRECTION_FTA_SUIVI_PROJET = "correction_fta_suivi_projet";

    /**
     * Fta
     * @var FtaModel
     */
    private $modelFta;

    /**
     * Chapitre concerné par le suivi
     * @var FtaChapitreModel
     */
    private $modelFtaChapitre;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);

        //Tables filles
        $this->setModelFta(
                new FtaModel(
                $this->getDataField(self::FIELDNAME_ID_FTA)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST
                )
        );
        $this->setModelFtaChapitre(
                new FtaChapitreModel(
                $this->getDataField(self::FIELDNAME_ID_FTA_CHAPITRE)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST
                )
        );
    }

    static public function getIdFtaSuiviProjetByIdFtaAndIdChapitre($paramIdFta, $paramIdChapitre) {

        //Récupération du tableau de résultat
        $keyName = FtaSuiviProjetModel::KEYNAME;
        $tableName = FtaSuiviProjetModel::TABLENAME;
        $idFtaName = FtaSuiviProjetModel::FIELDNAME_ID_FTA;
        $idFtaChapitreName = FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE;
        $sql = "SELECT " . $keyName . " "
                . "FROM " . $tableName . " "
                . "WHERE " . $idFtaName . "=" . $paramIdFta . " "
                . "AND " . $idFtaChapitreName . "=" . $paramIdChapitre . " "
        ;
        $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($sql);

        //Retourne uniquement la première valeur
        return $array[0][$keyName];
    }

    public function getModelFta() {
        return $this->modelFta;
    }

    public function getModelFtaChapitre() {
        return $this->modelFtaChapitre;
    }

    private function setModelFta(FtaModel $modelFta) {
        $this->modelFta = $modelFta;
    }

    private function setModelFtaChapitre(FtaChapitreModel $modelFtaChapitre) {
        $this->modelFtaChapitre = $modelFtaChapitre;
    }

    function notificationSuiviProjet($paramIdFta, $paramIdChapitre) {

        /*
          Cette fonction notifie les processus en fonction de l'état d'avancement du suivi du projet.
          Cet état d'avancement est géré par la table fta_suivi_projet
          Elle ne fait que de l'information, et ne modifie pas l'état de la fiche mais uniquement son suivi
         */
        $modelFta = new FtaModel($paramIdFta);

        //Récupération des Processus
        $arrayProcessus = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT * "
                        . " FROM " . FtaProcessusModel::TABLENAME);

        foreach ($arrayProcessus as $rowsProcessus) {

            //Si l'utilisateur appartient au processus, il n'est pas necessaire d'informer tous son service par mail
            $arrayIntranetActionProcessus = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                            "SELECT " . IntranetActionsModel::FIELDNAME_NOM_INTRANET_MODULES
                            . " FROM " . IntranetActionsModel::TABLENAME
                            . "WHERE " . IntranetActionsModel::KEYNAME . "='" . $rowsProcessus[FtaProcessusModel::FIELDNAME_ID_INTRANET_ACTIONS] . "' "
            );
            foreach ($arrayIntranetActionProcessus as $rowsIntranetActionProcessus) {
                $nom_intranet_actions = $rowsIntranetActionProcessus[IntranetActionsModel::FIELDNAME_NOM_INTRANET_MODULES];
            }
//echo      "fta_".$nom_intranet_actions.": ".$GLOBALS{"fta_".$nom_intranet_actions}."<br>";
            if ($GLOBALS{"fta_" . $nom_intranet_actions}) {
                $no_mail = 1; //Désactivation du mail pour ce processus
            } else {
                $no_mail = 0; //Activation du mail
            }


            //Ce processus est-il un processus en cours ?
            if (fta_processus_etat($paramIdFta, $rowsProcessus["id_fta_processus"]) == 2) {

                //Activation du mail
                //$no_mail=0;
                //Recherche des Notifications des chapitres
                $arraySuiviProjetChapitreProcessus = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT " . FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET
                                . " FROM " . FtaSuiviProjetModel::TABLENAME . ", " . FtaChapitreModel::TABLENAME
                                . ", " . FtaProcessusModel::TABLENAME
                                . " WHERE (" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "=" . FtaChapitreModel::TABLENAME . "." . FtaChapitreModel::KEYNAME          //jointure
                                . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                                . " = " . FtaChapitreModel::TABLENAME . "." . FtaChapitreModel::FIELDNAME_ID_PROCESSUS //jointure
                                . ") AND " . FtaChapitreModel::TABLENAME . "." . FtaChapitreModel::FIELDNAME_ID_PROCESSUS
                                . "=" . $rowsProcessus["id_fta_processus"] . " "
                                . "AND " . FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                . "=" . $paramIdFta . " "
                );

                foreach ($arraySuiviProjetChapitreProcessus as $rowsSuiviProjetChapitreProcessus) {

                    //L'ensemble des chapitres a-t-il été entièrement notifié ?
                    // -1 = le suivi doit etre créé et le processus doit être informé
                    //  0 = ce processus doit être informé
                    //  1 = ce processus a déjà était informé
                    if ($rowsSuiviProjetChapitreProcessus) {
                        $notification = 1 * $rowsSuiviProjetChapitreProcessus[FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET];
                    } else {
                        $notification = -1;
                    }
                }
                //Si au moins un des chapitres n'a pas été notifié ou qu'il n' y a pas encore de suivi
                if ($notification <= 0 and $rowsProcessus[FtaProcessusModel::KEYNAME] <> 1) {


                    //Initialisation du tableau des destinataires (mail + identifiant)
                    $liste_mail = "";
                    $liste_user = "";

                    //Si le mail reste actif, on construit la listes des utilisateurs à informer
                    if (!$no_mail) {
                        //Recherche de la liste des utilisateurs à informer
                        switch ($rowsProcessus[FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS]) {
                            case 0:
                                //1. Cas de processus mono-site
                                //-----------------------------
                                //Est-ce que seul le service du chef de projet doit être informé ?
                                if ($rowsProcessus[FtaProcessusModel::FIELDNAME_INFO_CHEF_PROJET]) {

                                    //Rechercher du service du chef de projet
                                    /**
                                     * Pour cette requête le chapitre clé est test identité le 32
                                     */
                                    $arraySuiviProjetSalaries = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                                    "SELECT " . UserModel::FIELDNAME_ID_SERVICE
                                                    . " FROM " . FtaSuiviProjetModel::TABLENAME . ", " . UserModel::TABLENAME
                                                    . " WHERE (" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET
                                                    . "=" . UserModel::TABLENAME . "." . UserModel::FIELDNAME_ID_SERVICE
                                                    . ") AND ( (" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                                    . "= " . $paramIdFta
                                                    . "AND " . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . "= 31 ) ) "
                                    );
                                    foreach ($arraySuiviProjetSalaries as $rowsSuiviProjetSalaries) {
                                        $id_service = $rowsSuiviProjetSalaries[UserModel::FIELDNAME_ID_SERVICE];
                                        $where = " AND " . UserModel::TABLENAME . "." . UserModel::FIELDNAME_ID_SERVICE . "=" . $id_service;
                                    }



                                    //Désactivation de l'envoi du mail dans ce cas de figure.
                                    $no_mail = 1;
                                }
                                //tableau des utilisateurs selon leur accès aux processus
                                $arraySalarieProcessus = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray("SELECT DISTINCT " . UserModel::TABLENAME . "." . UserModel::KEYNAME . ", " . UserModel::TABLENAME . "." . UserModel::FIELDNAME_MAIL
                                                . ", " . UserModel::TABLENAME . "." . UserModel::FIELDNAME_LOGIN . ", " . UserModel::TABLENAME . "." . UserModel::FIELDNAME_NOM
                                                . ", " . UserModel::TABLENAME . "." . UserModel::FIELDNAME_PRENOM . ", " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                                                . " FROM " . UserModel::TABLENAME . "," . IntranetActionsModel::TABLENAME
                                                . ", " . IntranetModulesModel::TABLENAME . "," . IntranetDroitsAccesModel::TABLENAME . ", " . FtaProcessusModel::TABLENAME
                                                . " WHERE ( " . UserModel::TABLENAME . "." . UserModel::KEYNAME
                                                . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_USER                                   //Liaison
                                                . " AND " . UserModel::FIELDNAME_ACTIF . "= 'oui' "                                                                      //maj 2007-08-13 sm                                            . "AND `intranet_droits_acces`.`id_intranet_modules` = `intranet_modules`.`id_intranet_modules` "        //Liaison
                                                . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                                . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS        //Liaison
                                                . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                                . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_INTRANET_ACTIONS . ") "              //Liaison
                                                . " AND ( ( " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . " <> 0 "                                 //Obtention du droit d'accès
                                                . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME . " = " . $rowsProcessus[FtaProcessusModel::KEYNAME]                  //Processus en cours
                                                . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS . " = 0 "
                                                . " AND " . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES . "` = 'fta' ) )"
                                                . " AND " . UserModel::TABLENAME . "." . UserModel::KEYNAME . "<>'" . $modelFta->getModelCreateur()->getDataField(UserModel::KEYNAME)->getFieldValue() . "'"
                                                . $where
                                );

                                foreach ($arraySalarieProcessus as $rowsSalarieProcessus) {
                                    if ($rowsSalarieProcessus) {
                                        //Remplissage du tableau des destinataires (mail + identifiant)
                                        $liste_mail[] = $rowsSalarieProcessus[UserModel::FIELDNAME_MAIL];
                                        $liste_user[] = "- " . $rowsSalarieProcessus[UserModel::FIELDNAME_PRENOM] . " " . $rowsSalarieProcessus[UserModel::FIELDNAME_NOM];
                                    }
                                }
                                break;

                            case 1:
                                //2. Cas de processus multi-site
                                //------------------------------
                                //Existe-t-il un processus d'un autre site qui gère ce site d'assemblage ?
                                $req = "SELECT * FROM fta_processus_multisite "
                                        . "WHERE id_site_assemblage_fta_processus_multisite = " . $_SESSION["Site_de_production"] . " "
                                        . "AND id_processus_fta_processus_multisite = " . $rowsProcessus["id_fta_processus"] . " "
                                ;
                                $result_autre_site = DatabaseOperation::query($req);
                                if (mysql_num_rows($result_autre_site)) {
                                    $site_gestionnaire = mysql_result($result_autre_site, 0, "id_site_processus_fta_processus_multisite");
                                } else {

                                    $site_gestionnaire = $_SESSION["Site_de_production"];
                                }
                                $req = "SELECT DISTINCT `salaries`.`id_user`, `salaries`.`mail`, `salaries`.`login`, `salaries`.`nom`, `salaries`.`prenom`, `fta_processus`.`id_fta_processus` "
                                        . "FROM `salaries`, `intranet_droits_acces`, `intranet_modules`, `intranet_actions`, `fta_processus`, geo "
                                        . "WHERE ( `salaries`.`id_user` = `intranet_droits_acces`.`id_user` "                                    //Liaison
                                        . "AND `salaries`.`actif` = 'oui' "                                                                      //maj 2007-08-13 sm                                            . "AND `intranet_droits_acces`.`id_intranet_modules` = `intranet_modules`.`id_intranet_modules` "        //Liaison
                                        . "AND `intranet_actions`.`id_intranet_actions` = `intranet_droits_acces`.`id_intranet_actions` "        //Liaison
                                        . "AND `intranet_actions`.`id_intranet_actions` = `fta_processus`.`id_intranet_actions` "                //Liaison
                                        . "AND `geo`.`id_geo` = `salaries`.`lieu_geo`) "                                                         //Liaison
                                        . "AND ( ( `intranet_droits_acces`.`niveau_intranet_droits_acces` <> 0 "               //Obtention du droit d'accès
                                        . "AND `fta_processus`.`id_fta_processus` = " . $rowsProcessus["id_fta_processus"] . " " //Processus en cours
                                        . "AND fta_processus.multisite_fta_processus = 1 "                                     //Processus Multisite
                                        . "AND `geo`.`id_site` = '" . $site_gestionnaire . "' "                                                       //Site d'assemblage
                                        . "AND `intranet_modules`.`nom_intranet_modules` = 'fta' ) )"
                                        . "AND salaries.id_user<>'" . $_SESSION["id_user"] . "' "

                                ;

                                //echo $rows_processus["multisite_fta_processus"]."<br>".$req."<br><br>";

                                $result_mail = DatabaseOperation::query($req);
                                while ($rowsSalarieProcessus = mysql_fetch_array($result_mail)) {

                                    //Remplissage du tableau des destinataires (mail + identifiant)
                                    $liste_mail[] = $rowsSalarieProcessus["mail"];
                                    $liste_user[] = "- " . $rowsSalarieProcessus["prenom"] . " " . $rowsSalarieProcessus["nom"];
                                }
                                break;
                        }//Fin de la recherche des utilisateurs à informer
                    }//Fin du controle de désactivation de mail
                    //Envoi du mail de notification
                    $idFtaSuiviProjet = FtaSuiviProjetModel::getIdFtaSuiviProjetByIdFtaAndIdChapitre($paramIdFta, $paramIdChapitre);
                    $modelFtaSuiviProjet = new FtaSuiviProjetModel($idFtaSuiviProjet);
                    $modelFta = new FtaModel($paramIdFta);
                    if ($liste_mail and ! $no_mail) {
                        foreach ($liste_mail as $adresse_email) {
                            $sujetmail = "FTA/" . $modelFta->getDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE)->getFieldValue();
                            $text = "Démarrage du processus: " . $rowsProcessus["nom_fta_processus"] . "\n"
                                    . "Etat de la FTA: " . $modelFta->getModelFtaEtat()->getDataField(FtaEtatModel::FIELDNAME_NOM_FTA_ETAT)->getFieldValue() . "\n\n"
                                    . "Vous pouvez consulter l'Etat d'avancenement du dossier directement sur le site http://intranet.agis.fr .\n"
                                    . "\n"
                                    . "Bonne journée.\n"
                                    . "Intranet - Fiche Technique Article."
                            ;
                            $destinataire = $adresse_email;
                            $expediteur = $_SESSION["prenom"] . " " . $_SESSION["nom_famille_ses"] . " <" . $_SESSION["mail_user"] . ">";
                            //if ($_SESSION["notification_fta_suivi_projet"]) {
                            if ($modelFtaSuiviProjet->getDataField(FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET)->getFieldValue()) {
                                envoismail($sujetmail, $text, $destinataire, $expediteur);
                            }
                        }
                    }//Fin des envois de mail
                    //Enregistrement de la réalisation de la notification du processus
                    switch ($notification) {
                        case 0: //Mise à jour du suivi
                            $req = "UPDATE fta_chapitre, fta_suivi_projet "
                                    . "SET fta_suivi_projet.notification_fta_suivi_projet=1 "
                                    . "WHERE fta_suivi_projet.id_fta_chapitre=fta_chapitre.id_fta_chapitre "
                                    . "AND fta_chapitre.id_fta_processus=" . $rowsProcessus["id_fta_processus"] . " "
                                    . "AND fta_suivi_projet.id_fta=" . $paramIdFta . " "
                            ;
                            DatabaseOperation::query($req);
                            break;

                        case -1: //Création du suivi
                            //Récupération des chapitres du processus
                            $req = "SELECT id_fta_chapitre FROM fta_chapitre "
                                    . "WHERE id_fta_processus = '" . $rowsProcessus["id_fta_processus"] . "' "
                            ;
                            $result_chapitre = DatabaseOperation::query($req);
                            while ($rows_chapitre = mysql_fetch_array($result_chapitre)) {
                                $req = "INSERT fta_suivi_projet "
                                        . "SET notification_fta_suivi_projet=1 "
                                        . ", id_fta='" . $paramIdFta . "' "
                                        . ", id_fta_chapitre='" . $rows_chapitre["id_fta_chapitre"] . "' ";
                                ;
                                DatabaseOperation::query($req);
                            }

                            break;
                    }
                    //echo $req;
                    //echo "<br>";
                }//Fin de la vérification par chapitre et du traitement de la notification
            }//Fin de la vérification des processus validés
        }//Fin du parcours des processsu
        //Message d'Information
        if ($liste_user) {
            $liste_user_html = implode("<br>", $liste_user);
            $titre = "Information communiquée par Mail";
            $message = "Les personnes suivantes viennent d'être informées par mail de la validation de tous vos chapitres."
                    . "<br><br>" . $liste_user_html;
            afficher_message($titre, $message, $redirection);
        }


        //Retour de la fonction
        return $liste_user;
    }

}
