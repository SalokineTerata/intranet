<?php

/*
 * Copyright (C) 2014 salokine
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Description of FtaChapitreModel
 *
 * @author salokine
 */
class FtaChapitreModel extends AbstractModel {

    const TABLENAME = 'fta_chapitre';
    const KEYNAME = 'id_fta_chapitre';
    const FIELDNAME_NOM_CHAPITRE = 'nom_fta_chapitre';
    const FIELDNAME_NOM_USUEL_CHAPITRE = 'nom_usuel_fta_chapitre';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    /**
     * Correction d'une FTA
     * Pour une FTA données, correction d'un chapitre et dévalidation des processus suivants
     * @param type $paramIdFta
     * @param type $paramIdChapitre
     * @param type $option
     * @return int
     */
    public static function BuildCorrectionChapitre($paramIdFta, $paramIdChapitre, $option) {
        $option['no_message_ecran'];                       //0=affichage à l'ecran, 1=rien
        $option['correction_fta_suivi_projet'];            //Commentaire justifiant la correction du chapitre
        $HtmlResult = new HtmlResult2();

        $globalconfig = new GlobalConfig();
        $idUser = $globalconfig->getAuthenticatedUser()->getKeyValue();
        $idFtaWorkflowStructure = FtaWorkflowStructureModel::getIdFtaWorkflowStructureByIdFtaAndIdChapitre(
                        $paramIdFta, $paramIdChapitre);
        $ftaWorkflowStructureModel = new FtaWorkflowStructureModel($idFtaWorkflowStructure, $paramIdChapitre);
        $idFtaProcessus = $ftaWorkflowStructureModel->getDataField(FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS)->getFieldValue();


        //Récupération des informations préalables
        //Nom de l'assistante de projet responsable:
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . UserModel::FIELDNAME_PRENOM . ',' . UserModel::FIELDNAME_NOM
                        . ', ' . UserModel::FIELDNAME_MAIL
                        . ' FROM ' . UserModel::TABLENAME
                        . ' WHERE ' . UserModel::KEYNAME
                        . '=\'' . $idUser . '\' ');
        foreach ($array as $rows) {
            $prenom = $rows[UserModel::FIELDNAME_PRENOM];
            $nom = $rows[UserModel::FIELDNAME_NOM];
            $mail = $rows[UserModel::FIELDNAME_MAIL];
        }

        $arrayFtaSuiviCorrection = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . FtaSuiviProjetModel::FIELDNAME_CORRECTION_FTA_SUIVI_PROJET . ',' . FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET
                        . ' FROM ' . FtaSuiviProjetModel::TABLENAME
                        . ' WHERE ' . FtaModel::KEYNAME . '=' . $paramIdFta
                        . ' AND ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . '=' . $paramIdChapitre . ' '
        );
        if ($arrayFtaSuiviCorrection) {
            foreach ($arrayFtaSuiviCorrection as $rowsFtaSuiviCorrection) {
                $current_correction_fta_suivi_projet = $rowsFtaSuiviCorrection[FtaSuiviProjetModel::FIELDNAME_CORRECTION_FTA_SUIVI_PROJET];
                $notificationFtaSuiviProjet = $rowsFtaSuiviCorrection[FtaSuiviProjetModel::FIELDNAME_CORRECTION_FTA_SUIVI_PROJET];
            }
        }
        //Intégration du commentaire de la correction
        $newCorrectionFtaSuiviProjet.= $current_correction_fta_suivi_projet . '\n\n' . date('Y-m-d') . ': '
                . $prenom . ' ' . $nom . ': '//table salaries
                . $option[FtaSuiviProjetModel::FIELDNAME_CORRECTION_FTA_SUIVI_PROJET]
        ;
        $newCorrectionFtaSuiviProjet = mysql_real_escape_string($newCorrectionFtaSuiviProjet);

        //Dévalidation du chapitre en cours
        $reqDevelidationChapitre = ' UPDATE ' . FtaSuiviProjetModel::TABLENAME
                . ' SET ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . '=0, '
                . FtaSuiviProjetModel::FIELDNAME_CORRECTION_FTA_SUIVI_PROJET . '=\'' . $newCorrectionFtaSuiviProjet . '\' '
                . ' WHERE ' . FtaModel::KEYNAME . '=' . $paramIdFta
                . ' AND ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . '=' . $paramIdChapitre
        ;
        DatabaseOperation::execute($reqDevelidationChapitre);

        /**
         * Actualisation du pourcentage de validation de la Fta
         */
        $idFtaSuiviProjet = FtaSuiviProjetModel::getIdFtaSuiviProjetByIdFtaAndIdChapitre($paramIdFta, $paramIdChapitre);
        $modelFtaSuiviProjet = new FtaSuiviProjetModel($idFtaSuiviProjet);
        $modelFtaSuiviProjet->unsetSigned();
        $modelFtaSuiviProjet->saveToDatabase();

        /*
         * Mise à jour de la validation de l'échéance du processus
         * fonction non utilisé
         */

        // FtaProcessusDelaiModel::BuildFtaProcessusValidationDelai($paramIdFta, $idFtaProcessus, $idFtaWorkflow);
        //Dévalidation des processus suivants
        $return = FtaChapitreModel::BuildDevalidationChapitre($paramIdFta, $idFtaProcessus, $HtmlResult);
        //print_r($return['mail']);      //Tableau contenant les adresses emails des personnes concernées par la dévalidation
        if (count($return) > 1) {
            $return['processus'] = array_unique($return['processus']);   //Tableau contenant les identifiants des processus dévalidés unique     
        }
        if (is_string($return['processus'])) {
            $return['processus'] = array(
                'processus' => $return['processus']
            );
        }

        //Informations
        if ($return['processus']) {
            foreach ($return['processus'] as $id_Fta_Processus) {
                $idFtaProcessus = $id_Fta_Processus;
                $arrayFtaProcessus = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT DISTINCT ' . FtaProcessusModel::FIELDNAME_NOM
                                . ' FROM ' . FtaProcessusModel::TABLENAME
                                . ', ' . FtaWorkflowStructureModel::TABLENAME
                                . ' WHERE ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . '=' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME
                                . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS . '=' . $idFtaProcessus
                );
                if ($arrayFtaProcessus) {
                    foreach ($arrayFtaProcessus as $rowsFtaProcessus) {
                        $message.=$rowsFtaProcessus[FtaProcessusModel::FIELDNAME_NOM] . '<br>';
                    }
                }
            }
            if (!$message) {
                $message = 'Aucun processus n\'a été dévalidé.';
            }
            $titre = 'Liste des Processus dévalidés';
            if (!$option['no_message_ecran']) {
                afficher_message($titre, $message, $redirection);
            }

            //Envoi des mails
            $show_din = FtaModel::ShowDin($paramIdFta);
            $name = $show_din;

            if ($return['mail']) {
                foreach ($return['mail'] as $mail) {
                    $sujetmail = 'FTA/Correction: $name';
                    $destinataire = $mail;
                    $expediteur = $prenom . ' ' . $nom . ' <' . $mail . '>';
                    $text = 'Vos chapitres viennent d\'être dévalidés suite à une correction apportée par '
                            . $prenom
                            . ' '
                            . $nom . '.\n\n'
                            . 'OBJET DE LA CORRECTION:\n'
                            . '\t' . stripslashes($option[FtaSuiviProjetModel::FIELDNAME_CORRECTION_FTA_SUIVI_PROJET])
                    ;
                    $typeMail = 'Correction';
                    if ($notificationFtaSuiviProjet) {
                        envoismail($sujetmail, $text, $destinataire, $expediteur, $typeMail);
                    }
                }
            }
        }//Fin du traitement des processus suivants

        return 1;
    }

    /**
     * Devalidation d'un chapitre
     * @param type $paramIdFta
     * @param type $paramIdProcessus
     * @param type $htmlResult
     * @return type
     */
    public static function BuildDevalidationChapitre($paramIdFta, $paramIdProcessus, $htmlResult) {
        //Déclarion des variables
        $modelFta = new FtaModel($paramIdFta);
        $id_fta_workflow = $modelFta->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
        $ftaWorkflowModel = new FtaWorkflowModel($id_fta_workflow);
        $id_parent_intranet_actions = $ftaWorkflowModel->getDataField(FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS)->getFieldValue();
        $id_intranet_actions[] = IntranetActionsModel::getIdIntranetActionsRoleFromIdParentActionNavigation($id_parent_intranet_actions);
        $id_actions_role = FtaActionRoleModel::getIdFtaActionRoleFromIdIntranetAtions($id_intranet_actions);
        $ftaActionRoleModel = new FtaActionRoleModel($id_actions_role);

        $return[UserModel::FIELDNAME_MAIL];        //Tableau contenant les adresses email des utilisateurs concerné par la dévalidation.
        $return['processus'];   //Tableau contenant la liste des identifiants des processus dévalidés
        //Récupération des données
        $arrayFtaEtatAndFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . FtaEtatModel::FIELDNAME_ABREVIATION
                        . ' FROM ' . FtaModel::TABLENAME . ',' . FtaEtatModel::TABLENAME
                        . ' WHERE ' . FtaModel::KEYNAME . '=' . $paramIdFta
                        . ' AND ' . FtaEtatModel::TABLENAME . '.' . FtaEtatModel::KEYNAME
                        . '=' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_ID_FTA_ETAT
        );

        foreach ($arrayFtaEtatAndFta as $rowsFtaEtatAndFta) {
            $abreviation_fta_etat = $rowsFtaEtatAndFta[FtaEtatModel::FIELDNAME_ABREVIATION];
        }


        //Dénotification des chapitres en cours
        $reqDenotification = 'UPDATE ' . FtaWorkflowStructureModel::TABLENAME . ',' . FtaSuiviProjetModel::TABLENAME
                . ' SET ' . FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET . '=0 '
                . ' WHERE ( ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                . '=' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . ' ) '
                . ' AND ( ( ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                . ' = \'' . $paramIdProcessus . '\' '
                . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA . ' = \'' . $paramIdFta . '\' ) )'
        ;
        DatabaseOperation::execute($reqDenotification);

        //Recherches des processus suivants
        $arrayProcessusCycle = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT . ',' . FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS
                        . ' FROM ' . FtaProcessusCycleModel::TABLENAME . ',' . FtaProcessusModel::TABLENAME
                        . ',' . FtaSuiviProjetModel::TABLENAME . ',' . FtaWorkflowStructureModel::TABLENAME
                        . ' WHERE ' . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . '=\'' . $abreviation_fta_etat . '\' '
                        . ' AND ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME
                        . '=' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                        . '=' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                        . '=' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                        . ' AND ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . '=\'' . $paramIdProcessus . '\' '
                        . ' AND ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT . ' IS NOT NULL'
                        . ' AND ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . ' <> 0'
                        . ' AND ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA . '=' . $paramIdFta
        );

        //Enregistrement du processus
        $htmlResult->setProcessus($paramIdProcessus);

        if ($htmlResult->getHtmlResult() == NULL) {
            $array = array(
                'processus' => $htmlResult->getProcessus(),
            );
            $htmlResult->setHtmlResult($array);
        } else {
            $array = $htmlResult->getHtmlResult();
            $arrayTmp = array(
                'processus' => $htmlResult->getProcessus(),
            );
            $array3 = array_merge_recursive($arrayTmp, $array);
            $htmlResult->setHtmlResult($array3);
        }
        //Parcour des processus suivants
        if ($arrayProcessusCycle != NULL) {
            foreach ($arrayProcessusCycle as $rowsProcessusCycle) {
                //Recherche et Dévalidation des chapitres dans le suivi de projet
                $paramIdProcessus = $rowsProcessusCycle[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT];

                $multisite_fta_processus = $rowsProcessusCycle[FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS];
                $reqDevalidation = 'UPDATE ' . FtaWorkflowStructureModel::TABLENAME . ',' . FtaSuiviProjetModel::TABLENAME
                        . ' SET ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . '=0 '
                        . ' WHERE ( ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                        . '=' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . ' ) '
                        . ' AND ( ( ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                        . ' = \'' . $paramIdProcessus . '\' '
                        . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA . ' = \'' . $paramIdFta . '\' ) )'
                ;
                DatabaseOperation::execute($reqDevalidation);

                if ($reqDevalidation) { //Si le processus a été dévalidé, alors on informe
                    //Dénotification
                    $reqDenotification = 'UPDATE ' . FtaWorkflowStructureModel::TABLENAME . ',' . FtaSuiviProjetModel::TABLENAME
                            . ' SET ' . FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET . '=0 '
                            . ' WHERE ( ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                            . '=' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . ' ) '
                            . ' AND ( ( ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                            . ' = \'' . $paramIdProcessus . '\' '
                            . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA . ' = \'' . $paramIdFta . '\' ) )'
                    ;
                    DatabaseOperation::execute($reqDenotification);

                    //echo 'Dévalidation FTA n°'.$id_fta.' / Processus n°'.$id_fta_processus.'... OK.<br>';
                    //Récupération de l'adresse mail de la dévalidation du processus (en fonction d'un processus multisite)
                    switch ($multisite_fta_processus) { //Récuparation des adresses emails
                        case 0: //Processus centralisé
                            $req = 'SELECT ' . UserModel::FIELDNAME_MAIL
                                    . ' FROM ' . IntranetActionsModel::TABLENAME
                                    . ',' . FtaProcessusModel::TABLENAME
                                    . ',' . IntranetDroitsAccesModel::TABLENAME
                                    . ',' . UserModel::TABLENAME
                                    . ',' . FtaWorkflowStructureModel::TABLENAME
                                    . ',' . FtaSuiviProjetModel::TABLENAME
                                    . ',' . FtaActionRoleModel::TABLENAME
                                    . ',' . FtaRoleModel::TABLENAME
                                    . ' WHERE ( ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                                    . '=' . FtaRoleModel::TABLENAME . '.' . FtaRoleModel::KEYNAME        //Jointure
                                    . ' AND ' . FtaRoleModel::TABLENAME . '.' . FtaRoleModel::KEYNAME
                                    . '=' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                    . ' AND ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                                    . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                                    . ' AND ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                    . '=' . $ftaActionRoleModel->getDataField(FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE)->getFieldValue()       //Liaison
                                    . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                                    . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS  //Liaison
                                    . ' AND ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME
                                    . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_USER                              //Liaison
                                    . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                    . '=' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME                    //Liaison
                                    . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                    . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE . ') '                       //Liaison
                                    . 'AND ( ( ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME . '= \'' . $paramIdProcessus . '\' '
                                    . 'AND ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS . '= \'' . $multisite_fta_processus . '\' '
                                    . 'AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . ' = 1 '
                                    . 'AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA . ' = \'' . $paramIdFta . '\' ) ) '
                                    . 'GROUP BY ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_MAIL
                            ;
                            break;

                        case 1: //Processus multisite
                            $req = 'SELECT  ' . UserModel::FIELDNAME_MAIL
                                    . ' FROM ' . IntranetActionsModel::TABLENAME
                                    . ',' . FtaProcessusModel::TABLENAME
                                    . ',' . IntranetDroitsAccesModel::TABLENAME
                                    . ',' . UserModel::TABLENAME
                                    . ',' . FtaWorkflowStructureModel::TABLENAME
                                    . ',' . FtaSuiviProjetModel::TABLENAME
                                    . ',' . FtaModel::TABLENAME
                                    . ',' . GeoModel::TABLENAME
                                    . ',' . FtaActionRoleModel::TABLENAME
                                    . ',' . FtaRoleModel::TABLENAME
                                    . ' WHERE ( ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                                    . '=' . FtaRoleModel::TABLENAME . '.' . FtaRoleModel::KEYNAME        //Jointure
                                    . ' AND ' . FtaRoleModel::TABLENAME . '.' . FtaRoleModel::KEYNAME
                                    . '=' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                    . ' AND ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                                    . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                                    . ' AND ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                    . '=' . $ftaActionRoleModel->getDataField(FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE)->getFieldValue()       //Liaison
                                    . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                                    . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS  //Liaison
                                    . ' AND ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME
                                    . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_USER                               //Liaison
                                    . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                    . '=' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME                    //Liaison
                                    . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                    . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                    . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                    . '=' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME
                                    . ' AND ' . GeoModel::TABLENAME . '.' . GeoModel::KEYNAME
                                    . '=' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_SITE_ASSEMBLAGE
                                    . ' AND ' . GeoModel::TABLENAME . '.' . GeoModel::KEYNAME
                                    . '=' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_LIEU_GEO . ') '
                                    . ' AND ( ( ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME . '= \'' . $paramIdProcessus . '\' '
                                    . ' AND ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS . '= \'' . $multisite_fta_processus . '\' '
                                    . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . ' = 1 '
                                    . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA . ' = \'' . $paramIdFta . '\' ) ) '
                                    . ' GROUP BY ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_MAIL
                            ;
                            break;
                    }
                    //Enregistrement de la liste des utilisateur à informer
                    $arrayMail = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
                    if ($arrayMail) {
                        foreach ($arrayMail as $rowsMail) {
                            $return[UserModel::FIELDNAME_MAIL][] = $rowsMail[UserModel::FIELDNAME_MAIL];
                        }
                        $htmlResult->setMail($return[UserModel::FIELDNAME_MAIL]);
                        $array = $htmlResult->getHtmlResult();
                        $arrayTmp[UserModel::FIELDNAME_MAIL] = $htmlResult->getMail();
                        $array3 = array_merge_recursive($arrayTmp, $array);
                        $htmlResult->setHtmlResult($array3);
                    }
                }//Fin de l'information de la dévalidation
                //Mise à jour de la validation de l'échéance du processus
                BuildFtaProcessusValidationDelai($paramIdFta, $paramIdProcessus);

                //Appel récursif de la fonction pour continuer à dévalider les processus suivants
                FtaChapitreModel::BuildDevalidationChapitre($paramIdFta, $paramIdProcessus, $htmlResult);
            }
        }
        //Retour de la fonction
        return $htmlResult->getHtmlResult();
    }

    public static function getChapitreDefautByWorkflow($paramId) {
        $ftaModel = new FtaModel($paramId);
        $IdWorkflow = $ftaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
        /*
         * Non fonctionnelle
         */
        $rarrayChapitreDefaut = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT DISTINCT ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME
                        . ' FROM ' . FtaProcessusModel::TABLENAME
                        . 'LEFT JOIN ' . FtaProcessusCycleModel::TABLENAME
                        . ' ON ' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                        . '=' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME
                        . ' WHERE ' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                        . '=' . $IdWorkflow      //Jointure
        );

        foreach ($rarrayChapitreDefaut as $rowsChapitreDefaut) {
            return $rowsChapitreDefaut[FtaProcessusModel::KEYNAME];
        }
    }

}
