<?php

/**
 * Description of FtaSuiviProjetModel
 * Table des FtaSuiviProjetModel
 *
 * @author salokine
 * @todo finir la table FtaSuiviProjet
 */
class FtaSuiviProjetModel extends AbstractModel {

    const TABLENAME = 'fta_suivi_projet';
    const KEYNAME = 'id_fta_suivi_projet';
    const FIELDNAME_ID_FTA = 'id_fta';
    const FIELDNAME_ID_FTA_CHAPITRE = 'id_fta_chapitre';
    const FIELDNAME_COMMENTAIRE_SUIVI_PROJET = 'commentaire_suivi_projet';
    const FIELDNAME_DATE_VALIDATION_SUIVI_PROJET = 'date_validation_suivi_projet';
    const FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET = 'signature_validation_suivi_projet';
    const FIELDNAME_DATE_DEMARRAGE_CHAPITRE_FTA_SUIVI_PROJET = 'date_demarrage_chapitre_fta_suivi_projet';
    const FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET = 'notification_fta_suivi_projet';
    const FIELDNAME_CORRECTION_FTA_SUIVI_PROJET = 'correction_fta_suivi_projet';

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

    /**
     * Duplication des données d'un Fta dans la table Suivi de Projet
     * @param type $paramIdFtaOrig
     * @param type $paramIdFtaNew
     */
    public static function DuplicateFtaSuiviProjetByIdFta($paramIdFtaOrig, $paramIdFtaNew) {
        DatabaseOperation::execute(
                ' INSERT INTO ' . FtaSuiviProjetModel::TABLENAME
                . ' (' . FtaSuiviProjetModel::FIELDNAME_COMMENTAIRE_SUIVI_PROJET
                . ', ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                . ', ' . FtaSuiviProjetModel::FIELDNAME_DATE_VALIDATION_SUIVI_PROJET
                . ', ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET
                . ', ' . FtaSuiviProjetModel::FIELDNAME_DATE_DEMARRAGE_CHAPITRE_FTA_SUIVI_PROJET
                . ', ' . FtaSuiviProjetModel::FIELDNAME_CORRECTION_FTA_SUIVI_PROJET
                . ', ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                . ', ' . FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET . ')'
                . ' SELECT ' . FtaSuiviProjetModel::FIELDNAME_COMMENTAIRE_SUIVI_PROJET
                . ', ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                . ', ' . FtaSuiviProjetModel::FIELDNAME_DATE_VALIDATION_SUIVI_PROJET
                . ', ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET
                . ', ' . FtaSuiviProjetModel::FIELDNAME_DATE_DEMARRAGE_CHAPITRE_FTA_SUIVI_PROJET
                . ', ' . FtaSuiviProjetModel::FIELDNAME_CORRECTION_FTA_SUIVI_PROJET
                . ', ' . $paramIdFtaNew
                . ', ' . FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET
                . ' FROM ' . FtaSuiviProjetModel::TABLENAME
                . ' WHERE ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA . '=' . $paramIdFtaOrig
        );
    }

    /**
     * 
     * @param type $paramIdFta
     * @param type $paramIdChapitre
     * @return array
     */
    static public function getIdFtaSuiviProjetByIdFtaAndIdChapitre($paramIdFta, $paramIdChapitre) {

        //Récupération du tableau de résultat
        $keyName = FtaSuiviProjetModel::KEYNAME;
        $tableName = FtaSuiviProjetModel::TABLENAME;
        $idFtaName = FtaSuiviProjetModel::FIELDNAME_ID_FTA;
        $idFtaChapitreName = FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE;
        $sql = 'SELECT ' . $keyName . ' '
                . 'FROM ' . $tableName . ' '
                . 'WHERE ' . $idFtaName . '=' . $paramIdFta . ' '
                . 'AND ' . $idFtaChapitreName . '=' . $paramIdChapitre . ' '
        ;
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray($sql);

        //Retourne uniquement la première valeur
        return $array[0][$keyName];
    }

    /**
     * Cette fonction notifie les processus en fonction de l'état d'avancement du suivi du projet.
     * Cet état d'avancement est géré par la table fta_suivi_projet
     * Elle ne fait que de l'information, et ne modifie pas l'état de la fiche mais uniquement son suivi
     * @param type $paramIdFta
     * @param type $paramIdChapitre
     * @return string
     */
    public static function getListeUsersAndNotificationSuiviProjet($paramIdFta, $paramIdChapitre) {

        $idFtaSuiviProjet = FtaSuiviProjetModel::getIdFtaSuiviProjetByIdFtaAndIdChapitre($paramIdFta, $paramIdChapitre);
        $modelFtaSuiviProjet = new FtaSuiviProjetModel($idFtaSuiviProjet, $paramIdChapitre);
        $modelFta = new FtaModel($paramIdFta, $paramIdChapitre);

        $id_fta_workflow = $modelFta->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
        $ftaWorkflowModel = new FtaWorkflowModel($id_fta_workflow);
        $id_parent_intranet_actions = $ftaWorkflowModel->getDataField(FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS)->getFieldValue();
        //Récupération des Processus
        $arrayProcessus = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME . ', ' . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ', ' . FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS . ', ' . FtaProcessusModel::FIELDNAME_INFO_CHEF_PROJET
                        . ', ' . FtaProcessusModel::FIELDNAME_NOM
                        . ' FROM ' . FtaProcessusModel::TABLENAME . ',' . FtaWorkflowStructureModel::TABLENAME . ',' . FtaWorkflowModel::TABLENAME
                        . ' WHERE ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                        . '=' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::KEYNAME
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                        . '=' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                        . '=' . $id_fta_workflow
        );

        foreach ($arrayProcessus as $rowsProcessus) {

            //Si l'utilisateur appartient au processus, il n'est pas necessaire d'informer tous son service par mail
            $arrayIntranetActionProcessus = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT ' . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS
                            . ' FROM ' . IntranetActionsModel::TABLENAME
                            . ' WHERE ' . IntranetActionsModel::KEYNAME . '=\'' . $rowsProcessus[FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS] . '\' '
            );
            if ($arrayIntranetActionProcessus) {
                foreach ($arrayIntranetActionProcessus as $rowsIntranetActionProcessus) {
                    $nom_intranet_actions = $rowsIntranetActionProcessus[IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS];
                }
            }
//echo      'fta_'.$nom_intranet_actions.': '.$GLOBALS{'fta_'.$nom_intranet_actions}.'<br>';
            if (AclClass::getValueAccesRights('fta_' . $nom_intranet_actions)) {
                $no_mail = 1; //Désactivation du mail pour ce processus
            } else {
                $no_mail = 0; //Activation du mail
            }


            //Ce processus est-il un processus en cours ?
            if (FtaProcessusModel::getValideProcessusEncours($paramIdFta, $rowsProcessus[FtaProcessusModel::KEYNAME], $id_fta_workflow) <> 0
                    AND FtaProcessusModel::getValideProcessusEncours($paramIdFta, $rowsProcessus[FtaProcessusModel::KEYNAME], $id_fta_workflow) <> 1) {

                //Activation du mail
                //$no_mail=0;
                //Recherche des Notifications des chapitres
                $arraySuiviProjetChapitreProcessus = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT ' . FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET
                                . ' FROM ' . FtaSuiviProjetModel::TABLENAME . ', ' . FtaChapitreModel::TABLENAME
                                . ', ' . FtaProcessusModel::TABLENAME . ', ' . FtaWorkflowStructureModel::TABLENAME
                                . ' WHERE (' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . '=' . FtaChapitreModel::TABLENAME . '.' . FtaChapitreModel::KEYNAME          //jointure
                                . ' AND ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME
                                . ' = ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS //jointure
                                . ' AND ' . FtaChapitreModel::TABLENAME . '.' . FtaChapitreModel::KEYNAME
                                . ' = ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE //jointure
                                . ') AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . '=' . $rowsProcessus[FtaProcessusModel::KEYNAME] . ' '
                                . 'AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                . '=' . $paramIdFta . ' '
                );



                //L'ensemble des chapitres a-t-il été entièrement notifié ?
                // -1 = le suivi doit etre créé et le processus doit être informé
                //  0 = ce processus doit être informé
                //  1 = ce processus a déjà était informé
                if ($arraySuiviProjetChapitreProcessus) {
                    foreach ($arraySuiviProjetChapitreProcessus as $rowsSuiviProjetChapitreProcessus) {
                        $notification = 1 * $rowsSuiviProjetChapitreProcessus[FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET];
                    }
                } else {
                    $notification = -1;
                }

                //Si au moins un des chapitres n'a pas été notifié ou qu'il n' y a pas encore de suivi
                if ($notification <= 0 and $rowsProcessus[FtaProcessusModel::KEYNAME] <> 1) {


                    //Initialisation du tableau des destinataires (mail + identifiant)
                    $liste_mail = '';
                    $liste_user = '';

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
                                     * Pour cette requête le chapitre clé est test identité le 1
                                     */
                                    $arraySuiviProjetSalaries = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                                    'SELECT ' . UserModel::FIELDNAME_ID_SERVICE
                                                    . ' FROM ' . FtaSuiviProjetModel::TABLENAME . ', ' . UserModel::TABLENAME
                                                    . ' WHERE (' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET
                                                    . '=' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_ID_SERVICE
                                                    . ') AND ( (' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                                    . '= ' . $paramIdFta
                                                    . 'AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . '= 1 ) ) '
                                    );
                                    foreach ($arraySuiviProjetSalaries as $rowsSuiviProjetSalaries) {
                                        $where = ' AND ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_ID_SERVICE . '=' . $rowsSuiviProjetSalaries[UserModel::FIELDNAME_ID_SERVICE];
                                    }
                                    //Désactivation de l'envoi du mail dans ce cas de figure.
                                    $no_mail = 1;
                                }

                                //tableau des utilisateurs selon leur accès aux processus
                                $arraySalarieProcessusMono = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                                'SELECT DISTINCT ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME . ', ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_MAIL
                                                . ', ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_LOGIN . ', ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_NOM
                                                . ', ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_PRENOM . ', ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME
                                                . ' FROM ' . UserModel::TABLENAME . ',' . IntranetActionsModel::TABLENAME
                                                . ', ' . IntranetModulesModel::TABLENAME . ',' . IntranetDroitsAccesModel::TABLENAME
                                                . ', ' . FtaProcessusModel::TABLENAME . ', ' . FtaActionRoleModel::TABLENAME
                                                . ' WHERE ( ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME
                                                . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_USER                                   //Liaison
                                                . ' AND ' . UserModel::FIELDNAME_ACTIF . '= \'oui\' '                                                                      //maj 2007-08-13 sm                                            . 'AND `intranet_droits_acces`.`id_intranet_modules` = `intranet_modules`.`id_intranet_modules` '        //Liaison
                                                . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                                                . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS        //Liaison
                                                . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                                                . '=' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS . ') '              //Liaison
                                                . ' AND ( ( ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . ' <> 0 '                                 //Obtention du droit d'accès
                                                . ' AND ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME . ' = ' . $rowsProcessus[FtaProcessusModel::KEYNAME]                  //Processus en cours
                                                . ' AND ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS . ' = 0 '                                 //Processus Monosite
                                                . ' AND ' . IntranetModulesModel::TABLENAME . '.' . IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES . ' = \'fta\' ) )'
                                                . ' AND ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME . '<>\'' . $modelFta->getModelCreateur()->getDataField(UserModel::KEYNAME)->getFieldValue() . '\''
                                                . $where
                                );
                                if ($arraySalarieProcessusMono) {
                                    foreach ($arraySalarieProcessusMono as $rowsSalarieProcessusMono) {
                                        //Remplissage du tableau des destinataires (mail + identifiant)
                                        $liste_mail[] = $rowsSalarieProcessusMono[UserModel::FIELDNAME_MAIL];
                                        $liste_user[] = '- ' . $rowsSalarieProcessusMono[UserModel::FIELDNAME_PRENOM] . ' ' . $rowsSalarieProcessusMono[UserModel::FIELDNAME_NOM];
                                    }
                                }
                                break;

                            case 1:
                                //2. Cas de processus multi-site
                                //------------------------------
                                //Existe-t-il un processus d'un autre site qui gère ce site d'assemblage ?
                                $arrayMultisiteProcessus = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                                'SELECT ' . FtaProcessusMultisiteModel::FIELDNAME_ID_SITE_PROCESSUS_FTA_PROCESSUS_MULTISITE
                                                . ' FROM  ' . FtaProcessusMultisiteModel::TABLENAME
                                                . ' WHERE ' . FtaProcessusMultisiteModel::FIELDNAME_ID_SITE_ASSEMBLAGE_FTA_PROCESSUS_MULTISITE . '=' . $modelFta->getDataField(FtaModel::FIELDNAME_SITE_ASSEMBLAGE)->getFieldValue()
                                                . ' AND ' . FtaProcessusMultisiteModel::FIELDNAME_ID_PROCESSUS_FTA_PROCESSUS_MULTISITE . '=' . $rowsProcessus[FtaProcessusModel::KEYNAME]
                                );

                                if ($arrayMultisiteProcessus) {
                                    foreach ($arrayMultisiteProcessus as $rowsMultisiteProcessus) {
                                        $site_gestionnaire = $rowsMultisiteProcessus[FtaProcessusMultisiteModel::FIELDNAME_ID_SITE_PROCESSUS_FTA_PROCESSUS_MULTISITE];
                                    }
                                } else {
                                    $site_gestionnaire = $modelFta->getDataField(FtaModel::FIELDNAME_SITE_ASSEMBLAGE)->getFieldValue();
                                }

                                $arraySalarieProcessusMulti = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                                'SELECT DISTINCT ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME . ', ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_MAIL
                                                . ', ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_LOGIN . ', ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_NOM
                                                . ', ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_PRENOM . ', ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME
                                                . ' FROM ' . UserModel::TABLENAME . ',' . IntranetActionsModel::TABLENAME
                                                . ', ' . IntranetModulesModel::TABLENAME . ',' . IntranetDroitsAccesModel::TABLENAME
                                                . ', ' . FtaProcessusModel::TABLENAME . ', ' . GeoModel::TABLENAME
                                                . ' WHERE ( ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME
                                                . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_USER                                   //Liaison
                                                . ' AND ' . UserModel::FIELDNAME_ACTIF . '= \'oui\' '                                                                      //maj 2007-08-13 sm                                            . 'AND `intranet_droits_acces`.`id_intranet_modules` = `intranet_modules`.`id_intranet_modules` '        //Liaison
                                                . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                                                . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS             //Liaison
                                                . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                                                . '=' . IntranetActionsModel::getIdIntranetActionsRoleFromIdParentActionNavigation($id_parent_intranet_actions)            //Liaison                                                
                                                . ' AND ' . GeoModel::TABLENAME . '.' . GeoModel::KEYNAME . '=' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_LIEU_GEO . ') '                                                         //Liaison
                                                . ' AND ( ( ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . ' <> 0 '                                 //Obtention du droit d'accès
                                                . ' AND ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME . ' = ' . $rowsProcessus[FtaProcessusModel::KEYNAME]                  //Processus en cours
                                                . ' AND ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS . ' = 1 '                                     //Processus Multisite
                                                . ' AND ' . GeoModel::TABLENAME . '.' . GeoModel::KEYNAME . '= \'' . $site_gestionnaire . '\' '                                                       //Site d'assemblage
                                                . ' AND ' . IntranetModulesModel::TABLENAME . '.' . IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES . ' = \'fta\' ) )'
                                                . ' AND ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME . '<>\'' . $modelFta->getModelCreateur()->getDataField(UserModel::KEYNAME)->getFieldValue() . '\''
                                );

                                //echo $rows_processus['multisite_fta_processus'].'<br>'.$req.'<br><br>';
                                if ($arraySalarieProcessusMulti) {
                                    foreach ($arraySalarieProcessusMulti as $rowsSalarieProcessusMulti) {
                                        //Remplissage du tableau des destinataires (mail + identifiant)
                                        $liste_mail[] = $rowsSalarieProcessusMulti[UserModel::FIELDNAME_MAIL];
                                        $liste_user[] = '- ' . $rowsSalarieProcessusMulti[UserModel::FIELDNAME_PRENOM] . ' ' . $rowsSalarieProcessusMulti[UserModel::FIELDNAME_NOM];
                                    }
                                }
                                break;
                        }//Fin de la recherche des utilisateurs à informer
                    }//Fin du controle de désactivation de mail
                    //Envoi du mail de notification

                    if ($liste_mail and ! $no_mail) {
                        foreach ($liste_mail as $adresse_email) {
                            $sujetmail = 'FTA/' . $modelFta->getDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE)->getFieldValue();
                            $text = 'Démarrage du processus: ' . $rowsProcessus[FtaProcessusModel::FIELDNAME_NOM] . '\n'
                                    . 'Etat de la FTA: ' . $modelFta->getModelFtaEtat()->getDataField(FtaEtatModel::FIELDNAME_NOM_FTA_ETAT)->getFieldValue() . '\n\n'
                                    . 'Vous pouvez consulter l\'Etat d\'avancenement du dossier directement sur le site http://intranet.agis.fr .\n'
                                    . '\n'
                                    . 'Bonne journée.\n'
                                    . 'Intranet - Fiche Technique Article.'
                            ;
                            $destinataire = $adresse_email;
                            //$expediteur = $_SESSION['prenom'] . ' ' . $_SESSION['nom_famille_ses'] . ' <' . $_SESSION['mail_user'] . '>';
                            $expediteur = $modelFta->getModelCreateur()->getDataField(UserModel::FIELDNAME_PRENOM)->getFieldValue()
                                    . ' ' . $modelFta->getModelCreateur()->getDataField(UserModel::FIELDNAME_NOM)->getFieldValue()
                                    . ' <' . $modelFta->getModelCreateur()->getDataField(UserModel::FIELDNAME_MAIL)->getFieldValue() . '>';
                            $typeMail = 'mail-transactions';
                            //if ($_SESSION['notification_fta_suivi_projet']) {
                            if ($modelFtaSuiviProjet->getDataField(FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET)->getFieldValue()) {
                                envoismail($sujetmail, $text, $destinataire, $expediteur, $typeMail);
                            }
                        }
                    }//Fin des envois de mail
                    //Enregistrement de la réalisation de la notification du processus
                    switch ($notification) {
                        case 0: //Mise à jour du suivi
                            $update = 'UPDATE ' . FtaWorkflowStructureModel::TABLENAME . ',' . FtaSuiviProjetModel::TABLENAME
                                    . ' SET ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET . '=1'
                                    . ' WHERE ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                    . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                    . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                    . '=' . $rowsProcessus[FtaProcessusModel::KEYNAME]
                                    . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA . '=' . $paramIdFta
                            ;
                            DatabaseOperation::execute($update);
                            break;

                        case -1: //Création du suivi
                            //Récupération des chapitres du processus
                            $arrayChapitre = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                            'SELECT ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                            . ' FROM ' . FtaWorkflowStructureModel::TABLENAME
                                            . ' WHERE ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                            . '= \'' . $rowsProcessus[FtaProcessusModel::KEYNAME] . '\' '
                            );

                            foreach ($arrayChapitre as $rowsChapitre) {
                                $insert = 'INSERT ' . FtaSuiviProjetModel::TABLENAME
                                        . ' SET ' . FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET . '=1'
                                        . ', ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA . '=\'' . $paramIdFta . '\''
                                        . ', ' . FtaChapitreModel::KEYNAME . '=' . $rowsChapitre[FtaChapitreModel::KEYNAME];
                                ;
                                DatabaseOperation::execute($insert);
                            }

                            break;
                    }
                }//Fin de la vérification par chapitre et du traitement de la notification
            }//Fin de la vérification des processus validés
        }//Fin du parcours des processsu
        //Retour de la fonction
        return $liste_user;
    }

    static public function initFtaSuiviProjet($paramIdFta) {

        $ftaModel = new FtaModel($paramIdFta);
        $idFtaWorkflow = $ftaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
        if ($idFtaWorkflow) {
            $arrayChapitre = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                            . ', ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                            . ' FROM ' . FtaWorkflowStructureModel::TABLENAME
                            . ' WHERE ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                            . '=' . $idFtaWorkflow
            );


            foreach ($arrayChapitre as $rowsChapitre) {
                $arrayCheckIdSuiviProjet = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT ' . FtaSuiviProjetModel::KEYNAME
                                . ' FROM ' . FtaSuiviProjetModel::TABLENAME
                                . ' WHERE ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                . '=' . $paramIdFta
                                . ' AND ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . '=' . $rowsChapitre[FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE]
                );
                if (!$arrayCheckIdSuiviProjet) {
                    if ($rowsChapitre[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS] == 0) {
                        DatabaseOperation::execute(
                                'INSERT INTO ' . FtaSuiviProjetModel::TABLENAME
                                . '(' . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                . ', ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . ', ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET
                                . ') VALUES (' . $paramIdFta
                                . ', ' . $rowsChapitre[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE]
                                . ', 1 )'
                        );
                    } else {
                        DatabaseOperation::execute(
                                'INSERT INTO ' . FtaSuiviProjetModel::TABLENAME
                                . '(' . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                . ', ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . ', ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET
                                . ') VALUES (' . $paramIdFta
                                . ', ' . $rowsChapitre[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE]
                                . ', 0 )'
                        );
                    }
                }
            }
        }
    }

    static public function initFtaSuiviProjetV2VersV3($paramIdFta, $paramIdFtaEtat, $paramCreateurFta) {

        $arrayIdFtaWorkflow = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT DISTINCT " . FtaModel::FIELDNAME_WORKFLOW
                        . " FROM intranet_v3_0_dev.fta "
                        . " WHERE id_fta = " . $paramIdFta
        );

        foreach ($arrayIdFtaWorkflow as $rowIdFtaWorkflow) {
            $idFtaWorkflow = $rowIdFtaWorkflow[FtaModel::FIELDNAME_WORKFLOW];
        }
        if ($idFtaWorkflow) {
            $arrayChapitre = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                            . ', ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                            . ' FROM intranet_v3_0_dev.' . FtaWorkflowStructureModel::TABLENAME
                            . ' WHERE ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                            . '=' . $idFtaWorkflow
            );


            foreach ($arrayChapitre as $rowsChapitre) {
                $arrayCheckIdSuiviProjet = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT ' . FtaSuiviProjetModel::KEYNAME
                                . ' FROM intranet_v3_0_dev.' . FtaSuiviProjetModel::TABLENAME
                                . ' WHERE ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                . '=' . $paramIdFta
                                . ' AND ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . '=' . $rowsChapitre[FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE]
                );
                if (!$arrayCheckIdSuiviProjet) {
                    if ($rowsChapitre[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS] == 0) {
                        DatabaseOperation::execute(
                                'INSERT INTO intranet_v3_0_dev.' . FtaSuiviProjetModel::TABLENAME
                                . '(' . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                . ', ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . ', ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET
                                . ') VALUES (' . $paramIdFta
                                . ', ' . $rowsChapitre[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE]
                                . ', 1 )'
                        );
                    } else {
                        switch ($paramIdFtaEtat) {
                            case '1':
                                DatabaseOperation::execute(
                                        'INSERT INTO intranet_v3_0_dev.' . FtaSuiviProjetModel::TABLENAME
                                        . '(' . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                        . ', ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                        . ', ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET
                                        . ') VALUES (' . $paramIdFta
                                        . ', ' . $rowsChapitre[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE]
                                        . ', 0 )'
                                );
                                break;
                            case '3':
                            case '5':
                            case '6':
                                DatabaseOperation::execute(
                                        'INSERT INTO intranet_v3_0_dev.' . FtaSuiviProjetModel::TABLENAME
                                        . '(' . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                        . ', ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                        . ', ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET
                                        . ') VALUES (' . $paramIdFta
                                        . ', ' . $rowsChapitre[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE]
                                        . ', ' . $paramCreateurFta . ' )'
                                );
                                break;
                        }
                    }
                }
            }
        }
    }

    public function setSigned($paramSignatureValidationSuiviProjet) {

        //Enregistrer base de données la signature
        $this->getDataField(FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET)->setFieldValue($paramSignatureValidationSuiviProjet);
        $reqValidationChapitre = ' UPDATE ' . FtaSuiviProjetModel::TABLENAME
                . ' SET ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . '=' . $paramSignatureValidationSuiviProjet
                . ' WHERE ' . FtaModel::KEYNAME . '=' . $this->getDataField(FtaSuiviProjetModel::FIELDNAME_ID_FTA)->getFieldValue()
                . ' AND ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . '=' . $this->getDataField(FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE)->getFieldValue()
        ;
        DatabaseOperation::execute($reqValidationChapitre);
        $this->updateAvancement();
    }

    public function unsetSigned() {
        //Enlever de la base de données la signature
        $signatureValidationSuiviProjet = '0';
        $this->getDataField(FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET)->setFieldValue($signatureValidationSuiviProjet);
        $this->updateAvancement();
    }

    private function updateAvancement() {
        $this->getModelFta()->updateAvancementFta();
    }

    static public function updatetFtaSuiviProjet($paramIdFta) {
        /*
         * Changement de workflow fais par la chef de projet
         */

        $ftaModel = new FtaModel($paramIdFta);
        $idFtaWorlflow = $ftaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();

        $arrayChapitre = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                        . ', ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                        . ' FROM ' . FtaWorkflowStructureModel::TABLENAME
                        . ' WHERE ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                        . '=' . $idFtaWorlflow
        );

        /*
         * On supprime de la table fta_suivi_projet tous les chapitres de l'ancien workflow 
         * sauf les chapitres du processus identidé.
         */
        DatabaseOperation::execute(
                'DELETE FROM ' . FtaSuiviProjetModel::TABLENAME
                . ' WHERE ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA . '=' . $paramIdFta
                . ' AND ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . '<>1'
                . ' AND ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . '<>21'
                . ' AND ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . '<>22'
                . ' AND ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . '<>23'
                . ' AND ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . '<>32'
        );
        foreach ($arrayChapitre as $rowsChapitre) {
            if ($rowsChapitre[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS] == 0) {
                DatabaseOperation::execute(
                        'INSERT INTO ' . FtaSuiviProjetModel::TABLENAME
                        . '(' . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                        . ', ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                        . ', ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET
                        . ') VALUES (' . $paramIdFta
                        . ', ' . $rowsChapitre[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE]
                        . ', 1 )'
                );
            } else {
                $arrayCheckIdSuiviProjet = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT ' . FtaSuiviProjetModel::KEYNAME
                                . ' FROM ' . FtaSuiviProjetModel::TABLENAME
                                . ' WHERE ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                . '=' . $paramIdFta
                                . ' AND ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                . '=' . $rowsChapitre[FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE]
                );
                if (!$arrayCheckIdSuiviProjet) {
                    DatabaseOperation::execute(
                            'INSERT INTO ' . FtaSuiviProjetModel::TABLENAME
                            . '(' . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                            . ', ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                            . ', ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET
                            . ') VALUES (' . $paramIdFta
                            . ', ' . $rowsChapitre[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE]
                            . ', 0 )'
                    );
                }
            }
        }
    }

    public static function getFtaTauxValidation($paramFtaModel, $paramTableauProcessus) {

//Dictionnaire des données
        $return['0'];     //Pourcentage globale de la validation
        $return['1'];     //Tableau de résultat par id_fta_processus des taux de validation
        $return['2'];     //Tableau de résultat par id_fta_processus des état des processus (Terminé, En cours, En attente)
        /*
         * Récupération du l'état de la FTA pour connatire le cycle de vie en cours
         */
        $idFta = $paramFtaModel->getDataField(FtaModel::KEYNAME)->getFieldValue();
        $idFtaEtat = $paramFtaModel->getDataField(FtaModel::FIELDNAME_ID_FTA_ETAT)->getFieldValue();

        /*
          Corps de la fonction
         */

        /*
         * Sélection des processus contenu dans le cycle de vie de l'état de la FTA
         */

        $arrayChapitre = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                        . ' FROM ' . FtaSuiviProjetModel::TABLENAME . ',' . FtaWorkflowStructureModel::TABLENAME
                        . ' WHERE ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA . '=' . $idFta
                        . ' AND ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . '<>0 '
                        . ' AND ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS . '<>0 '
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                        . '=' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                        . '=\'' . $paramFtaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue() . '\' '
        );
        $currentChapitre = count($arrayChapitre);

        /**
         * Liste complète des chapitres de ce cycle pour cette catégorie
         */
        $arrayChapitreTotal = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                        . ' FROM ' . FtaWorkflowStructureModel::TABLENAME
                        . ' WHERE  ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                        . '=\'' . $paramFtaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue() . '\' '
                        . ' AND ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS . '<>0 '
        );
        $totalChapitre = count($arrayChapitreTotal);
        if ($currentChapitre) {
            $return['0'] = $currentChapitre / $totalChapitre;
        } else {
            $return['0'] = '0';
        }
        if ($paramTableauProcessus) {
            $arrayCycle = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT DISTINCT ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                            . ' FROM ' . FtaProcessusCycleModel::TABLENAME . ', ' . FtaEtatModel::TABLENAME
                            . ' WHERE ' . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . '=' . FtaEtatModel::FIELDNAME_ABREVIATION
                            . ' AND ' . FtaProcessusCycleModel::FIELDNAME_WORKFLOW . '=' . $paramFtaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue()
                            . ' AND ' . FtaEtatModel::KEYNAME . '=\'' . $idFtaEtat . '\''
            );
            foreach ($arrayCycle as $rowsCycle) {
                $id_fta_processus = $rowsCycle[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT];
                $taux_validation_processus = FtaProcessusModel::getValideProcessusEncours($idFta, $id_fta_processus, $paramFtaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue());

                //Détail par processus
                $return[1][$id_fta_processus] = $taux_validation_processus;
            }//Fin du balayage
        }

        return $return;
    }

    public static function checkChapitreV2toV3($paramIdFtaChapitre, $paramIdFtaWorkflow) {
        switch ($paramIdFtaChapitre) {
            case '20':
                $paramIdFtaChapitre = '32';
                break;
            case '40' :
                $paramIdFtaChapitre = '21';
                break;
            case '80' :
                $paramIdFtaChapitre = '27';
                break;
            case '60' :
                $paramIdFtaChapitre = '24';
                break;
            case '101' :
                switch ($paramIdFtaWorkflow) {
                    case '3':
                    case '5':
                        $paramIdFtaChapitre = '35';
                        break;
                    case '6':
                    case '7':
                        $paramIdFtaChapitre = '38';
                        break;
                    default :
                        $paramIdFtaChapitre = '29';
                        break;
                }
                break;
            case '100':
                switch ($paramIdFtaWorkflow) {
                    case '3':
                    case '5':
                        $paramIdFtaChapitre = '36';
                        break;
                    case '6':
                    case '7':
                        $paramIdFtaChapitre = '39';
                        break;
                    default :
                        $paramIdFtaChapitre = '30';
                        break;
                }

                break;
            case '111' :
                $paramIdFtaChapitre = '33';
                break;
            case '70' :
                $paramIdFtaChapitre = '17';
                break;
            case '112' :
            case '90' :
                $paramIdFtaChapitre = '40';
                break;
        }
        return $paramIdFtaChapitre;
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

}

class HtmlResult2 {

    private $processus;
    private $mail;
    private $arrayResult;
    private $htmlResult;

    function getProcessus() {
        return $this->processus;
    }

    function setProcessus($processus) {
        $this->processus = $processus;
    }

    function getMail() {
        return $this->mail;
    }

    function setMail($mail) {
        $this->mail = $mail;
    }

    function getArrayResult() {
        return $this->arrayResult;
    }

    function setArrayResult($arrayResult) {
        $this->arrayResult = $arrayResult;
    }

    function getHtmlResult() {
        return $this->htmlResult;
    }

    function setHtmlResult($htmlResult) {
        $this->htmlResult = $htmlResult;
    }

}
