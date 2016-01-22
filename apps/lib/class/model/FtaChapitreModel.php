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
    const ID_CHAPITRE_IDENTITE = '1';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
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

        $globalConfig = new GlobalConfig();
        UserModel::checkUserSessionExpired($globalConfig);
        //Récupération des informations préalables
        //Nom de l'assistante de projet responsable:
        $mailExpediteur = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_MAIL)->getFieldValue();
        $nomPrenom = $globalConfig->getAuthenticatedUser()->getPrenomNom();
        $idFtaWorkflowStructure = FtaWorkflowStructureModel::getIdFtaWorkflowStructureByIdFtaAndIdChapitre(
                        $paramIdFta, $paramIdChapitre);
        $ftaWorkflowStructureModel = new FtaWorkflowStructureModel($idFtaWorkflowStructure, $paramIdChapitre);
        $idFtaProcessus = $ftaWorkflowStructureModel->getDataField(FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS)->getFieldValue();
        $idFtaWorkflow = $ftaWorkflowStructureModel->getDataField(FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW)->getFieldValue();


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
        if ($current_correction_fta_suivi_projet and $option[FtaSuiviProjetModel::FIELDNAME_CORRECTION_FTA_SUIVI_PROJET]) {
            $fullComment = $option[FtaSuiviProjetModel::FIELDNAME_CORRECTION_FTA_SUIVI_PROJET] . '\n\n' . $current_correction_fta_suivi_projet;
            $newCorrectionFtaSuiviProjet = FtaController::getComment("Correction d'une Fta", $nomPrenom, $fullComment);
        }
//        $newCorrectionFtaSuiviProjet = mysql_real_escape_string($newCorrectionFtaSuiviProjet);
        $newCorrectionFtaSuiviProjet = str_replace("<br/>", "\n", $newCorrectionFtaSuiviProjet);

        //Dévalidation du chapitre en cours
        $reqDevelidationChapitre = " UPDATE " . FtaSuiviProjetModel::TABLENAME
                . " SET " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "=0, "
                . FtaSuiviProjetModel::FIELDNAME_CORRECTION_FTA_SUIVI_PROJET . "=\"" . $newCorrectionFtaSuiviProjet . "\" "
                . " WHERE " . FtaModel::KEYNAME . "=" . $paramIdFta
                . " AND " . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . "=" . $paramIdChapitre
        ;
        DatabaseOperation::execute($reqDevelidationChapitre);


        /*
         * Mise à jour de la validation de l'échéance du processus
         * fonction non utilisé
         */

        // FtaProcessusDelaiModel::BuildFtaProcessusValidationDelai($paramIdFta, $idFtaProcessus, $idFtaWorkflow);
        //Dévalidation des processus suivants
        $return = FtaChapitreModel::BuildDevalidationChapitre($paramIdFta, $idFtaProcessus, $HtmlResult);

        /**
         * Actualisation du pourcentage de validation de la Fta
         */
        $idFtaSuiviProjet = FtaSuiviProjetModel::getIdFtaSuiviProjetByIdFtaAndIdChapitre($paramIdFta, $paramIdChapitre);
        $modelFtaSuiviProjet = new FtaSuiviProjetModel($idFtaSuiviProjet);
        $modelFtaSuiviProjet->unsetSigned();
        $modelFtaSuiviProjet->saveToDatabase();

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
                                . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . $idFtaWorkflow
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
            $show_din = FtaModel::showDin($paramIdFta);
            $name = $show_din;

            if ($return['mail']) {
                $return['mail'] = array_unique($return['mail']);
                foreach ($return['mail'] as $mail) {
                    $sujetmail = 'FTA/Correction: ' . $name;
                    $destinataire = $mail;
                    $expediteur = $nomPrenom . ' <' . $mailExpediteur . '>';
                    $text = 'Vos chapitres viennent d\'être dévalidés suite à une correction apportée par '
                            . $nomPrenom . '.\n\n'
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
                . ' AND ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . $id_fta_workflow
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
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                        . '=' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                        . '=' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                        . ' AND ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . '=\'' . $paramIdProcessus . '\' '
                        . ' AND ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT . ' IS NOT NULL'
                        . ' AND ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . ' <> 0'
                        . ' AND ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA . '=' . $paramIdFta
                        . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . $id_fta_workflow
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
                        . ' AND ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . $id_fta_workflow
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
                            . ' AND ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . $id_fta_workflow
                            . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA . ' = \'' . $paramIdFta . '\' ) )'
                    ;
                    DatabaseOperation::execute($reqDenotification);

                    /**
                     * Récuparation des adresses emails
                     */
                    $req = 'SELECT  ' . UserModel::FIELDNAME_MAIL
                            . ' FROM ' . IntranetActionsModel::TABLENAME
                            . ',' . IntranetDroitsAccesModel::TABLENAME
                            . ',' . UserModel::TABLENAME
                            . ',' . FtaWorkflowStructureModel::TABLENAME
                            . ',' . FtaSuiviProjetModel::TABLENAME//                
                            . ',' . FtaActionRoleModel::TABLENAME
                            . ' WHERE ( ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                            . '=' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                            . ' AND ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_WORKFLOW
                            . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                            . ' AND ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                            . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                            . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                            . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS  //Liaison
                            . ' AND ' . UserModel::TABLENAME . '.' . UserModel::KEYNAME
                            . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_USER                               //Liaison
                            . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                            . '= \'' . $paramIdProcessus . '\' '               //Liaison
                            . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                            . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE . ') '
                            . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . ' = ' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                            . ' AND ' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA . ' = \'' . $paramIdFta . '\'  '
                            . ' GROUP BY ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_MAIL
                    ;
                    /**
                     * Enregistrement de la liste des utilisateur à informer
                     */
                    $arrayMail = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
                    if ($arrayMail) {
                        foreach ($arrayMail as $rowsMail) {
                            if ($rowsMail[UserModel::FIELDNAME_MAIL]) {
                                $return[UserModel::FIELDNAME_MAIL][] = $rowsMail[UserModel::FIELDNAME_MAIL];
                            }
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
