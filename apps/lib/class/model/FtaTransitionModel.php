<?php

class FtaTransitionModel {

    const TABLENAME = "fta_transition";
    const FIELDNAME_ABREVIATION_FTA_ETAT = "abreviation_fta_etat";
    const FIELDNAME_ABREVIATION_FTA_TRANSITION = "abreviation_fta_transition";
    const FIELDNAME_NOM_USUEL_FTA_TRANSITION = "nom_usuel_fta_transition";
    const FIELDNAME_PROCESSUS_PROPRIETAIRE_FTA_TRANSITION = "processus_proprietaire_fta_transition";

    /**
     * Fonction transitant une fiche vers un etat donné
     * @param type $paramIdFta
     * @param type $paramAbreviationFtaTransition
     * @param type $paramCommentaireMajFta
     * @param type $paramIdWorkflow
     * @param type $paramListeChapitres
     * @return array
     */
    public static function BuildTransitionFta($paramIdFta, $paramAbreviationFtaTransition, $paramCommentaireMajFta, $paramIdWorkflow, $paramListeChapitres) {
        /*
         * Codes de retour de la fonction:
         */
        /*
          0: FTA correctement transitée
          1: FTA non transité car risque de doublon
          3: Erreur autre
         */
        $return["0"] = "0";

        /*
         * Chargement de l'enregistrement
         */
        $ftaModel = new FtaModel($paramIdFta);
        $idFtaEtatByIdFta = $ftaModel->getDataField(FtaModel::FIELDNAME_ID_FTA_ETAT)->getFieldValue();
        $idDossierFta = $ftaModel->getDataField(FtaModel::FIELDNAME_DOSSIER_FTA)->getFieldValue();
        $idArticleAgrologic = $ftaModel->getDataField(FtaModel::FIELDNAME_ARTICLE_AGROLOGIC)->getFieldValue();
        $siteDeProduction = $ftaModel->getDataField(FtaModel::FIELDNAME_SITE_ASSEMBLAGE)->getFieldValue();
        $ftaEtatModel = new FtaEtatModel($idFtaEtatByIdFta);
        $initial_abreviation_fta_etat = $ftaEtatModel->getDataField(FtaEtatModel::FIELDNAME_ABREVIATION)->getFieldValue();
        $globalConfig = new GlobalConfig();
        $idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
        $userModel = new UserModel($idUser);
        $login = $userModel->getDataField(UserModel::FIELDNAME_LOGIN)->getFieldValue();
        /*
         * Préparation des données
         */
        $nouveau_maj_fta = "\n\n"
                . "==============================\n"
                . "==============================\n"
                . "Date: " . date('Y-m-d') . "\n"
                . "Login du modificateur: " . $login . "\n\n"
                . $paramCommentaireMajFta
        ;

        /*         * *****************************************************************************
          Pré-traitement spécifique
         * ***************************************************************************** */
        switch (TRUE) {
            case $paramAbreviationFtaTransition == FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE: //Passer en Validée
                //Retirer les versions obsolètes
                $req = "UPDATE " . FtaModel::TABLENAME
                        . " SET " . FtaModel::FIELDNAME_ID_FTA_ETAT . "='6'" //Identifiant de "retirer"
                        . " WHERE " . FtaModel::FIELDNAME_DOSSIER_FTA . "='" . $idDossierFta . "' "
                        . " AND " . FtaModel::KEYNAME . "='" . $paramIdFta . "' "
                ;
                $result = DatabaseOperation::execute($req);

                //Mise à jour de la date de validation
                $ftaModel->getDataField(FtaModel::FIELDNAME_DATE_DERNIERE_MAJ_FTA)->setFieldValue(date('Y-m-d'));


                //Suppression du vérrou pour qu'on puisse à nouveau modifier cette fiche - DEBUGGER
                //$verrou_transite_fta=0;
                //Pas de commentaire pour une validation
                $nouveau_maj_fta = "";

                break;
//            case $paramAbreviationFtaTransition == FtaEtatModel::ETAT_ABREVIATION_VALUE_WORKFLOW:
//                //Dans le cas d'une mise à jour, récupération des Chapitres à corriger.
//
//                $liste_chapitre_maj_fta = ";";
//                //Mise à  jour de la table Fta_suivie_projet
//                FtaSuiviProjetModel::initFtaSuiviProjet($paramIdFta);
//                foreach ($paramListeChapitres as $rowsChapitre) {
//                    //Parcours des chapitres
//                    //Si le chapitre a été sélectionné, on l'enregistre dans le tableau de résultat
//                    $liste_chapitre_maj_fta.=$rowsChapitre . ";";
//                    //Correction des chapitres
//                    $paramOption["no_message_ecran"] = "1";
//                    $paramOption["correction_fta_suivi_projet"] = $nouveau_maj_fta;
//                    FtaChapitreModel::BuildCorrectionChapitre($paramIdFta, $rowsChapitre, $paramOption);
//                }
//                $paramAbreviationFtaTransition = FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION;
//                break;

            case $paramAbreviationFtaTransition == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION: //Passer en Initialisation
                //Vérification que le dossier n'a pas une fiche déjà en Mise à jour
                $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                "SELECT " . FtaModel::KEYNAME
                                . " FROM " . FtaModel::TABLENAME . "," . FtaEtatModel::TABLENAME
                                . " WHERE " . FtaModel::FIELDNAME_DOSSIER_FTA . "=" . $idDossierFta . " "
                                . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT
                                . "=" . FtaEtatModel::TABLENAME . "." . FtaEtatModel::KEYNAME     //Liaison
                                . " AND (" . FtaEtatModel::FIELDNAME_ABREVIATION . "<>'" . FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE
                                . "' AND " . FtaEtatModel::FIELDNAME_ABREVIATION . "<>'" . FtaEtatModel::ETAT_ABREVIATION_VALUE_RETIRE
                                . "' AND " . FtaEtatModel::FIELDNAME_ABREVIATION . "<>'" . FtaEtatModel::ETAT_ABREVIATION_VALUE_ARCHIVE . "') "
                );
                $verrou = count($array);
                if ($verrou and ! $_SESSION["mode_debug"]) {
                    $titre = "Action vérrouillée";
                    $message = "Cette fiche est déjà en cours de modification.";
                    $redirection = "";
                    afficher_message($titre, $message, $redirection);
                    $return["0"] = "1";
                    return $return;
                    exit;
                }

                //Dans le cas d'une mise à jour, récupération des Chapitres à corriger.

                $liste_chapitre_maj_fta = ";";
                foreach ($paramListeChapitres as $rowsChapitre) {
                    //Parcours des chapitres
                    //Si le chapitre a été sélectionné, on l'enregistre dans le tableau de résultat
                    $liste_chapitre_maj_fta.=$rowsChapitre . ";";
                }



                // Retirer la FTA de présentation avant de créer la nouvelle version en modification.
                if ($initial_abreviation_fta_etat == FtaEtatModel::ETAT_ABREVIATION_VALUE_PRESENTATION) {
                    //Retirer la version de présentation
                    $req = "UPDATE " . FtaModel::TABLENAME
                            . " SET " . FtaModel::FIELDNAME_ID_FTA_ETAT . "='6'" //Identifiant de "retirer"
                            . "WHERE id_fta='" . $paramIdFta . "' "
                    ;
                    $result = DatabaseOperation::execute($req);
                }

                //Duplication de la fiche
                $nouveau_maj_fta = addslashes($nouveau_maj_fta);
                $id_fta_original = $paramIdFta;
                $action_duplication = "version";
                $option_duplication["abreviation_etat_destination"] = $paramAbreviationFtaTransition;
                $option_duplication["selection_chapitre"] = $paramListeChapitres;
                $option_duplication["nouveau_maj_fta"] = $nouveau_maj_fta;
                $option_duplication["site_de_production"] = $siteDeProduction;
                $idFtaNew = FtaModel::BuildDuplicationFta($id_fta_original, $action_duplication, $option_duplication, $paramIdWorkflow);
                $ftaModel = new FtaModel($idFtaNew);
                $idArticleAgrologic = $ftaModel->getDataField(FtaModel::FIELDNAME_ARTICLE_AGROLOGIC)->getFieldValue();
                $paramIdFta = $idFtaNew;
                break;

            default;

                break;
        }//Fin Pré-traitement spécifique

        /*         * *****************************************************************************
          Traitement Commun
         * ***************************************************************************** */

        //Récupération du nouvel état de la fiche
        $arrayIdFtaEtat = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . FtaEtatModel::KEYNAME
                        . " FROM " . FtaEtatModel::TABLENAME
                        . " WHERE " . FtaEtatModel::FIELDNAME_ABREVIATION . "='$paramAbreviationFtaTransition'"
        );
        foreach ($arrayIdFtaEtat as $value) {
            $idFtaEtat = $value[FtaEtatModel::KEYNAME];
        }

        //$_SESSION["signature_validation_fta"] = $_SESSION["id_user"];
        $req = "UPDATE " . FtaModel::TABLENAME
                . " SET " . FtaModel::FIELDNAME_ID_FTA_ETAT . "=" . $idFtaEtat //Identifiant de "retirer"
                . ", " . FtaModel::FIELDNAME_COMMENTAIRE_MAJ_FTA . "='" . $nouveau_maj_fta //Identifiant de "retirer"
                . "' WHERE " . FtaModel::KEYNAME . "='" . $paramIdFta . "' "
        ;
        DatabaseOperation::execute($req);
        //Fin Traitement Commun

        /*         * *****************************************************************************
          Post-traitement
         * ***************************************************************************** */

        switch ($paramAbreviationFtaTransition) {
            case 'I':
                //Enregistrement des chapitres concernés par la mise à jour
                $req = "UPDATE " . FtaModel::TABLENAME
                        . " SET " . FtaModel::FIELDNAME_LISTE_CHAPITRE_MAJ_FTA . "='" . $liste_chapitre_maj_fta . "' "
                        . " WHERE " . FtaModel::KEYNAME . "='" . $paramIdFta . "' "
                ;
                DatabaseOperation::execute($req);
            case 'V':

                //Désactivation de l'ancien Code Article Agrologic
                $req = "UPDATE " . FtaModel::TABLENAME
                        . " SET " . FtaModel::FIELDNAME_CODE_ARTICLE . "=NULL"
                        . " WHERE " . FtaModel::FIELDNAME_CODE_ARTICLE . "='" . $idArticleAgrologic . "' "
                        . " AND " . FtaModel::KEYNAME . "='" . $paramIdFta . "' "
                ;
                DatabaseOperation::execute($req);

                //Activation du nouvel Article
                $req = "UPDATE " . FtaModel::TABLENAME
                        . " SET " . FtaModel::FIELDNAME_CODE_ARTICLE . "='" . $idArticleAgrologic . "', actif='-1' "
                        . " WHERE " . FtaModel::KEYNAME . "='" . $paramIdFta . "' "
                ;
                DatabaseOperation::execute($req);

                break;

            case 'A':
            case 'R':

                $req = "UPDATE " . FtaModel::TABLENAME
                        . " SET " . FtaModel::FIELDNAME_ACTIF . "=0"
                        . " WHERE " . FtaModel::KEYNAME . "='" . $paramIdFta . "' "
                ;
                DatabaseOperation::execute($req);


                break;
        }
        $return["id_fta_new"] = $paramIdFta;
        $return[FtaEtatModel::KEYNAME] = $idFtaEtat;
        $return[FtaEtatModel::FIELDNAME_ABREVIATION] = $paramAbreviationFtaTransition;

        return $return;
    }

    /**
     * Définit la liste de diffusion après la transition de "I" vers "V" d'une FTA données
     * 
     * Cette fonction retourne une liste d'adresse email distinctes sous la
     * forme du tableau suivant:
     * $return[mail]:       adresse email
     * $return[prenom_nom]: prénom et nom du destinataire
     * @param int $id_fta
     * @return array
     */
    public static function BuildListeDiffusionTransition($id_fta) {

        $logTransition = "";
//Déclaration des variables
//Chargement des données Articles
        $req = "SELECT " . FtaModel::FIELDNAME_LISTE_CHAPITRE_MAJ_FTA
                . ", " . FtaModel::FIELDNAME_WORKFLOW
                . ", " . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA
                . ", " . FtaModel::KEYNAME
                . ", " . FtaModel::FIELDNAME_SITE_ASSEMBLAGE
                . " FROM " . FtaModel::TABLENAME . ",  " . FtaEtatModel::TABLENAME
                . " WHERE " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME . "='" . $id_fta . "' "
                . " AND " . FtaEtatModel::TABLENAME . "." . FtaEtatModel::KEYNAME
                . "=" . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT        //Liaison
        ;
        $logTransition .= "\n\nLISTE DIFFUSION\n" . $req . "\n";
        $arrayFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);

        foreach ($arrayFta as $rowsFta) {

            $rowsFta["liste_chapitre_maj_fta"];    //Liste des chapitres ayant été coché pour effectuer la mise à jour de la fta
            $ok = 0;

            if ($rowsFta[FtaModel::FIELDNAME_LISTE_CHAPITRE_MAJ_FTA]) {
                //Détermination des chapitres du processus Initiateur du cycle de vie "I"
                $req = "SELECT DISTINCT " . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                        . " FROM " . FtaProcessusCycleModel::TABLENAME . " LEFT JOIN " . FtaProcessusCycleModel::TABLENAME . " as precedent "
                        . " ON precedent." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT . "=" . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                        . ", " . FtaWorkflowStructureModel::TABLENAME
                        . " WHERE precedent." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT . " IS NULL "
                        . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='I' "
                        . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . "=" . $rowsFta[FtaModel::FIELDNAME_WORKFLOW]
                        . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                        . "=" . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                        . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                        . "=" . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                ;
                $logTransition.="\n\n" . $req . "\n";
                $arrayIdChapitreInitiateur = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);

                //L'un des chapitres initiateurs est-il dans la liste des chapitres mis à jour sur la fta ?
                foreach ($arrayIdChapitreInitiateur as $rowsInitiateur) {
                    if (strstr($rowsFta[FtaModel::FIELDNAME_LISTE_CHAPITRE_MAJ_FTA], $rowsInitiateur[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE] . ";")) {
                        $ok = 1;
                    }
                }
            } else {
                $ok = 1; //Diffusion globale
            }

            if ($rowsFta[FtaModel::FIELDNAME_VERSION_DOSSIER_FTA] == 0 or $ok == 1) {
                //Log de la diffusion globale
                $logTransition.="\n\nDiffusion Globale Activée";
            } else {
                //Log de la diffusion globale
                $logTransition.="\n\nDiffusion Globale Désactivée";
            }



            $arrayIdIntranetActions = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            ' SELECT ' . FtaActionSiteModel::TABLENAME . '.' . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                            . ' FROM ' . FtaActionSiteModel::TABLENAME
                            . ' WHERE ' . FtaActionSiteModel::FIELDNAME_ID_SITE . '=' . $rowsFta[FtaModel::FIELDNAME_SITE_ASSEMBLAGE]
                            . ' AND ' . FtaActionSiteModel::FIELDNAME_ID_FTA_WROKFLOW . ' =' . $rowsFta[FtaModel::FIELDNAME_WORKFLOW]
            );

            if ($arrayIdIntranetActions) {
                foreach ($arrayIdIntranetActions as $rowsIdIntranetActions) {
                    $IdIntranetActions[] = $rowsIdIntranetActions[IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS];
                }
            }


            /**
             * Il est impératif d'avoir une condition Where dans le requête de diffusion
             * Si ce n'est pas le cas, la diffusion s'étend à l'ensemble des utiisateurs du système Intranet !
             * Il est necessaire d'interdire celà.
             */
            if ($IdIntranetActions) {
                /**
                 * Liste des utilisateur ayant le droits de diffusion sur le module Fta
                 */
                $arrayListeDiffusion = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                "SELECT DISTINCT " . UserModel::TABLENAME . "." . UserModel::KEYNAME
                                . " FROM " . UserModel::TABLENAME
                                . ", " . IntranetDroitsAccesModel::TABLENAME
                                . " WHERE " . UserModel::TABLENAME . "." . UserModel::KEYNAME
                                . " = " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_USER
                                . " AND " . UserModel::TABLENAME . "." . UserModel::FIELDNAME_ACTIF . " ='oui' "
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES . " = 19"
                                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . " = 1 "
                                . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . '=' . '3'
                );
                foreach ($arrayListeDiffusion as $value) {
                    $idUser[] = $value[UserModel::KEYNAME];
                }

                //Création de la liste des destinataires
                $req = "SELECT DISTINCT " . UserModel::TABLENAME . "." . UserModel::KEYNAME . ", " . UserModel::FIELDNAME_NOM . ", " . UserModel::FIELDNAME_PRENOM . ", " . UserModel::FIELDNAME_MAIL
                        . " FROM " . UserModel::TABLENAME
                        . ", " . IntranetDroitsAccesModel::TABLENAME
                        . ", " . IntranetModulesModel::TABLENAME
                        . ", " . IntranetActionsModel::TABLENAME
                        //Début Droits d'accès de diffusion
                        . " WHERE " . UserModel::TABLENAME . "." . UserModel::KEYNAME
                        . " = " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_USER
                        . " AND " . UserModel::TABLENAME . "." . UserModel::FIELDNAME_ACTIF . " ='oui' "
                        . " AND ( 0 " . UserModel::AddIdUser($idUser) . ')'
                        . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . " = " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME      //Liaison
                        . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . " = 1 "
                        . ' AND ( 0 ' . IntranetActionsModel::AddIdIntranetAction($IdIntranetActions) . ')'


                ;
                $logTransition.="\n\n" . $req . "\nFIN DIFFUSION\n";
                $r_liste_destinataire = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
                foreach ($r_liste_destinataire as $rows_destinataire) {
                    $return[$rows_destinataire[UserModel::KEYNAME]]["mail"] = $rows_destinataire[UserModel::FIELDNAME_MAIL];
                    $return[$rows_destinataire[UserModel::KEYNAME]]["prenom_nom"] = $rows_destinataire[UserModel::FIELDNAME_NOM] . " " . $rows_destinataire[UserModel::FIELDNAME_PRENOM];
                }
            } else {
                //Erreur critique, risque de diffusion généralisée à l'ensemble de l'Intranet
                $titre = "Erreur critique dans la liste de diffusion";
                $message = "L'ensemble des utilisateurs de l'Intranet était visé par cette diffusion.<br>"
                        . "L'envoi des mails d'information vient d'être avorté mais"
                        . "Le reste du traitement continue.<br><br>"
                        . "<pre>"
                        . $logTransition
                        . "</pre>"
                ;
                $redirection = "";
                afficher_message($titre, $message, $redirection);
                $return = 0;
            }
        }
        return $return;
    }

    /**
     * Envoi un mail d'information détaillé (pour une FTA uniquement)
     * @param type $paramIdFta
     * @param type $paramListeDiffusion
     * @param type $paramCommentaire
     */
    public static function BuildEnvoiMailDetail($paramIdFta, $paramListeDiffusion, $paramCommentaire) {

        /**
         * Initilisation
         */
        $ftamodel = new FtaModel($paramIdFta);
        $SiteDeProduction = $ftamodel->getDataField(FtaModel::FIELDNAME_SITE_ASSEMBLAGE)->getFieldValue();
        $CodeArticle = $ftamodel->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE)->getFieldValue();
        $Libelle = $ftamodel->getDataField(FtaModel::FIELDNAME_LIBELLE)->getFieldValue();
        $UniteFacturation = $ftamodel->getDataField(FtaModel::FIELDNAME_UNITE_FACTURATION)->getFieldValue();
        $globalConfig = new GlobalConfig();
        $idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
        $userModel = new UserModel($idUser);
        $nom = $userModel->getDataField(UserModel::FIELDNAME_NOM)->getFieldValue();
        $prenom = $userModel->getDataField(UserModel::FIELDNAME_PRENOM)->getFieldValue();
        $mail = $userModel->getDataField(UserModel::FIELDNAME_MAIL)->getFieldValue();
        /*
         * Récupération de la notification d'un chapitre
         */
        $arrayFtaSuiviProjetNoti = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET
                        . " FROM " . FtaSuiviProjetModel::TABLENAME
                        . " WHERE " . FtaSuiviProjetModel::FIELDNAME_ID_FTA . " = " . $paramIdFta
        );
        foreach ($arrayFtaSuiviProjetNoti as $rowsFtaSuiviProjetNoti) {
            $notificationSuiviProjet = $rowsFtaSuiviProjetNoti[FtaSuiviProjetModel::FIELDNAME_NOTIFICATION_FTA_SUIVI_PROJET];
        }


        /*
         * Récupération du nom du site d'assemblage
         */
        $arrayGeoSite = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . GeoModel::FIELDNAME_LIBELLE_SITE_AGIS
                        . " FROM " . GeoModel::TABLENAME
                        . " WHERE " . GeoModel::KEYNAME . " = " . $SiteDeProduction
        );
        foreach ($arrayGeoSite as $rowsGeoSite) {
            $libelleSiteAgis = $rowsGeoSite[GeoModel::FIELDNAME_LIBELLE_SITE_AGIS];
        }
        /*
         * Récupération de la liste des produits (nomenclatures)
         */

        $req = "SELECT " . FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE
                . "," . AnnexeAgrologicArticleCodificationModel::FIELDNAME_PREFIXE_ANNEXE_AGRO_ART_COD
                . " FROM " . FtaComposantModel::TABLENAME . ", " . AnnexeAgrologicArticleCodificationModel::TABLENAME
                . " WHERE " . FtaComposantModel::TABLENAME . "." . FtaComposantModel::FIELDNAME_ID_FTA . "=" . $paramIdFta
                . " AND " . FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT . "=1 "
                . " AND " . FtaComposantModel::TABLENAME . "." . FtaComposantModel::FIELDNAME_ID_ANNEXE_AGRO_ART_CODIFICATION
                . "=" . AnnexeAgrologicArticleCodificationModel::TABLENAME . "." . AnnexeAgrologicArticleCodificationModel::KEYNAME
                . " ORDER BY " . AnnexeAgrologicArticleCodificationModel::FIELDNAME_PREFIXE_ANNEXE_AGRO_ART_COD . " ASC, " . FtaComposantModel::FIELDNAME_DESIGNATION_CODIFICATION . ""
        ;
        $logTransition = "\n\n" . $req;
        $arrayProd = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
        if ($arrayProd) {
            $text_prod = "";
            foreach ($arrayProd as $rowsProd) {
                /*
                 * Chargement du code de codification
                 */
                $text_prod.= $rowsProd[AnnexeAgrologicArticleCodificationModel::FIELDNAME_PREFIXE_ANNEXE_AGRO_ART_COD]
                        . $rowsProd[FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE]
                        . ", "
                ;
            }
        }//Fin de la récupération de la liste des produits
//Contenu du message d'information conernant la validation de la FTA
        $sujetmail = "FTA/Validée: \"" . $CodeArticle . " - " . $Libelle . "\"";
        $text = "La Fiche Technique Article \"" . $CodeArticle . " - " . $Libelle . "\" "
                . "vient d'être validée.\n"
                . "Cet Article est maintenant actif et disponible dans l'ensemble de notre système informatique.\n"
                . "\n"
                . "INFORMATIONS PRINCIPALES:\n"
                . $ftamodel->getDataField(FtaModel::FIELDNAME_SITE_ASSEMBLAGE)->getFieldLabel() . ": " . $libelleSiteAgis . "\n"
                . "Identifiant dans Agrologic: " . $CodeArticle . "\n"
                . "\n"
                . "Listes des produits créés:\n"
                . $text_prod . "\n"
                . "\n"
                . "INFORMATIONS SUPPLEMENTAIRES:\n"
                . $ftamodel->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldLabel() . ": " . $ftamodel->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue() . "\n"
                . $ftamodel->getDataField(FtaModel::FIELDNAME_EAN_UVC)->getFieldLabel() . ": " . $ftamodel->getDataField(FtaModel::FIELDNAME_EAN_UVC)->getFieldValue() . "\n"
                . $ftamodel->getDataField(FtaModel::FIELDNAME_EAN_COLIS)->getFieldLabel() . ": " . $ftamodel->getDataField(FtaModel::FIELDNAME_EAN_COLIS)->getFieldValue() . "\n"
                . $ftamodel->getDataField(FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON)->getFieldLabel() . ": " . $ftamodel->getDataField(FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON)->getFieldValue() . "\n"
                . $ftamodel->getDataField(FtaModel::FIELDNAME_POIDS_ELEMENTAIRE)->getFieldLabel() . ": " . $ftamodel->getDataField(FtaModel::FIELDNAME_POIDS_ELEMENTAIRE)->getFieldValue() . "\n"
                . "Identifiant du Dossier Technique: " . $ftamodel->getDataField(FtaModel::FIELDNAME_DOSSIER_FTA)->getFieldValue()
                . "-v" . $ftamodel->getDataField(FtaModel::FIELDNAME_VERSION_DOSSIER_FTA)->getFieldValue() . "\n"
        ;
        switch ($UniteFacturation) {
            case 2: //Pièce
                $temp = "Pièce";
                break;
            case 3: //Kilo
                $temp = "Kilo";
                break;
        }
        $text.= $ftamodel->getDataField(FtaModel::FIELDNAME_UNITE_FACTURATION)->getFieldLabel() . ": " . $temp . "\n"
                . $ftamodel->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE)->getFieldLabel() . ": " . $ftamodel->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE)->getFieldValue() . "\n"
                . $ftamodel->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION)->getFieldLabel() . ": " . $ftamodel->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION)->getFieldValue() . "\n"
                . $ftamodel->getDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE)->getFieldLabel() . ": " . $ftamodel->getDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE)->getFieldValue() . "\n"
                . "\n"
                . "\n"
        ;
        if ($paramCommentaire) {
            $text.= "COMMENTAIRE:\n"
                    . stripslashes($paramCommentaire)
                    . "\n"
                    . "\n"
            ;
        }
        $text.= "Bonne journée à tous.\n"
                . "Ce message a été envoyé automatiquement par le module Intranet - Fiche Technique Article.\n"
        ;
        $typeMail = "Validation";

        /*
         * Envoi du mail d'information
         */
        foreach ($paramListeDiffusion as $mail_validation) {

            $destinataire = $mail_validation["mail"];
            $liste_destinataire .=$mail_validation["prenom_nom"]
                    . ": "
                    . $destinataire
                    . "\n"
            ;
            $expediteur = $prenom . " " . $nom . " <" . $mail . ">";
            if ($notificationSuiviProjet) {
                envoismail($sujetmail, $text, $destinataire, $expediteur, $typeMail);
            }
        }

        /*
         * Envoi du mail de contrôle
         */
        $sujetmail = "FTA/Information \"" . $CodeArticle . " - " . $Libelle . "\"";
        $corp = "DESTINATAIRES:\n"
                . $liste_destinataire . "\n"
                . "\n"
                . "Message envoyé:\n"
                . "\n"
                . $text
                . "\n"
                . "INFORMATIONS DE DEBUGGAGE:\n"
                . $logTransition
        ; {
            $expediteur = $prenom . " " . $nom . " <" . $mail . ">";
            envoismail($sujetmail, $corp, $mail, $expediteur, $typeMail);
        }
    }

    /**
     * Ajoute de la fonction de traitement de masse
     * @param type $paramAbreviationFtaEtat
     * @return string
     */
    public static function getListeFtaGrouper($paramAbreviationFtaEtat) {
        $requete = 'SELECT ' . FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_TRANSITION . ',' . FtaEtatModel::FIELDNAME_NOM_FTA_ETAT
                . ' FROM ' . FtaTransitionModel::TABLENAME . ',' . FtaEtatModel::TABLENAME
                . ' WHERE ' . FtaTransitionModel::TABLENAME . '.' . FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_ETAT
                . '=\'' . $paramAbreviationFtaEtat . '\' '
                . ' AND ' . FtaEtatModel::TABLENAME . '.' . FtaEtatModel::FIELDNAME_ABREVIATION
                . '=' . FtaTransitionModel::TABLENAME . '.' . FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_TRANSITION    //Liaison
        ;
        $nom_defaut = FtaTransitionModel::FIELDNAME_ABREVIATION_FTA_TRANSITION;
        $id_defaut = FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE;
        return $liste_action_groupe = AccueilFta::afficherRequeteEnListeDeroulante($requete, $id_defaut, $nom_defaut, TRUE);
    }

//Fin de la vérification que la FTA est bien validé
}
