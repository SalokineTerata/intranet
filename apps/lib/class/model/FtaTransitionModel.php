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
     * @param type $paramIdRole
     * @param type $paramIdWorkflow
     * @param type $paramListeChapitres
     * @return int
     */
    public static function BuildTransitionFta($paramIdFta, $paramAbreviationFtaTransition, $paramCommentaireMajFta, $paramIdRole, $paramIdWorkflow, $paramListeChapitres) {
        /*
         * Codes de retour de la fonction:
         */
        /*
          0: FTA correctement transitée
          1: FTA non transité car risque de doublon
          3: Erreur autre
         */
        $return = 0;

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

            case $paramAbreviationFtaTransition == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION: //Passer en Initialisation
            case $paramAbreviationFtaTransition == FtaEtatModel::ETAT_ABREVIATION_VALUE_PRESENTATION: //Passer en Fiche Présentation
                //Vérification que le dossier n'a pas une fiche déjà en Mise à jour
                $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                "SELECT " . FtaModel::KEYNAME
                                . " FROM " . FtaModel::TABLENAME . "," . FtaEtatModel::TABLENAME
                                . " WHERE " . FtaModel::FIELDNAME_DOSSIER_FTA . "=" . $idDossierFta . " "
                                . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT
                                . "=" . FtaEtatModel::TABLENAME . "." . FtaEtatModel::KEYNAME     //Liaison
                                . " AND (" . FtaEtatModel::FIELDNAME_ABREVIATION . "<>'" . FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE
                                . "' AND " . FtaEtatModel::FIELDNAME_ABREVIATION . "<>'" . FtaEtatModel::ETAT_ABREVIATION_VALUE_RETIRE
                                . "' AND " . FtaEtatModel::FIELDNAME_ABREVIATION . "<>'" . FtaEtatModel::ETAT_ABREVIATION_VALUE_PRESENTATION
                                . "' AND " . FtaEtatModel::FIELDNAME_ABREVIATION . "<>'" . FtaEtatModel::ETAT_ABREVIATION_VALUE_ARCHIVE . ") "
                );
                $verrou = count($array);
                if ($verrou and ! $_SESSION["mode_debug"]) {
                    $titre = "Action vérrouillée";
                    $message = "Cette fiche est déjà en cours de modification.";
                    $redirection = "";
                    afficher_message($titre, $message, $redirection);
                    $return = 1;
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
                $id_fta_original = $paramIdFta;
                $action_duplication = "version";
                $option_duplication["abreviation_etat_destination"] = $paramAbreviationFtaTransition;
                $option_duplication["selection_chapitre"] = $paramListeChapitres;
                $option_duplication["nouveau_maj_fta"] = $nouveau_maj_fta;
                $option_duplication["site_de_production"] = $siteDeProduction;
                $idFtaNew = FtaModel::BuildDuplicationFta($id_fta_original, $action_duplication, $option_duplication, $paramIdRole, $paramIdWorkflow);
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

        return $return;
    }

    /**
     * Définit la liste de diffusion après la transition de "I" vers "V" d'une FTA données
     * 
     * Cette fonction retourne une liste d'adresse email distinctes sous la
     * forme du tableau suivant:
     * $return[mail]:       adresse email
     * $return[prenom_nom]: prénom et nom du destinataire
     * @param type $id_fta
     * @return int
     */
    public static function BuildListeDiffusionTransition($id_fta) {

        $logTransition = "";
//Déclaration des variables
//Chargement des données Articles
        $req = "SELECT *"
                . " FROM " . FtaModel::TABLENAME . ",  " . FtaEtatModel::TABLENAME
                . " WHERE " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME . "='" . $id_fta . "' "
                . " AND " . FtaEtatModel::TABLENAME . "." . FtaEtatModel::KEYNAME
                . "=" . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT        //Liaison
        ;
        $logTransition .= "\n\nLISTE DIFFUSION\n" . $req;
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
                $logTransition.="\n\n" . $req;
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

                //Diffusion dans le cadre d'une création (version =v0) ou processus initiateur du cycle de vie modifié
                //Ce réfère à la requête de diffusion suivante:
                $where_chapitre = "";

                //Ajout des services et sites supplémentaires liés à une diffusion globale
                $where_supplementaire = " geo.raccourci_site_agis='PF' "     //Plateforme
                        //. "OR geo.raccourci_site_agis='SGE' " //Siège
                        . " OR id_service=38  "                //Compta
                        . " OR id_service=66  "                //Approvisionnement
                        . " OR id_service=40  "                //Expédition
                ;
            } else {
                //Log de la diffusion globale
                $logTransition.="\n\nDiffusion Globale Désactivée";

                //Diffusion dans le cadre d'une mise à jour (>v0)
                //N'informe que les chapitres étant à l'origine de la mise à jour. (cf. fta.liste_chapitre_maj_fta)
                //Détermination des chapitres concernés
                $tab_liste_chapitre = explode(";", $rowsFta[FtaModel::FIELDNAME_LISTE_CHAPITRE_MAJ_FTA]);
                $where_chapitre = " AND (";
                $where_chapitre_tmp = "";
                $where_chapitre_operator = "";
                foreach ($tab_liste_chapitre as $id_chapitre) {
                    if ($id_chapitre) {
                        $where_chapitre_tmp.=$where_chapitre_operator . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                . "='" . $id_chapitre . "' ";
                        $where_chapitre_operator = " OR ";
                    }
                }
                if ($where_chapitre_tmp) {
                    $where_chapitre.=$where_chapitre_tmp . ") ";
                } else {
                    $where_chapitre = "";
                }

                //Ajout des services et sites supplémentaires liés à une diffusion de mise à jour
                //$where_supplementaire="";
                $where_supplementaire = " id_service=66 "                    //Approvisionnement
                        . " OR id_service=40  "                //Expédition
                //. "OR geo.raccourci_site_agis='SGE' " //Siège
                //. "OR id_service=38  "                //Compta
                ;
            }


            //Récupération de la liste des services (et sites) étant intervenu sur la validation de la FTA
            //et qu'il faut donc inclure dans la liste de diffusion
            $req = "SELECT " . UserModel::FIELDNAME_ID_SERVICE . ", " . UserModel::FIELDNAME_LIEU_GEO . ", MIN(" . FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS . ") as min_multisite_fta_processus "
                    . " FROM " . FtaSuiviProjetModel::TABLENAME . " "
                    . ", " . UserModel::TABLENAME . " "
                    . ", access_materiel_service "
                    . ", " . FtaWorkflowStructureModel::TABLENAME
                    . ", " . FtaProcessusModel::TABLENAME
                    . " WHERE " . FtaSuiviProjetModel::FIELDNAME_ID_FTA . "='" . $rowsFta[FtaModel::KEYNAME] . "' "
                    . " AND " . UserModel::FIELDNAME_ACTIF . " ='oui' "                                                   //maj 2007-08-13 sm sélection des salariés actifs uniquement
                    . " AND " . UserModel::KEYNAME . "=" . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET               //Liaison
                    . " AND " . UserModel::FIELDNAME_ID_SERVICE . "=K_service "                                           //Liaison
                    . " AND " . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                    . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE   //Liaison
                    . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                    . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME   //Liaison
                    . $where_chapitre                                                       //Restriction dans le cas d'une mise à jour
                    . " GROUP BY " . UserModel::FIELDNAME_ID_SERVICE . ", " . UserModel::FIELDNAME_LIEU_GEO
            ;
            $logTransition.="\n\n" . $req;
            $arrayServiceFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
            $where = " AND ( ";
            $where_operator = "";

            if ($arrayServiceFta) {
                $where = " AND ( ";
                foreach ($arrayServiceFta as $rowsServiceFta) {
                    $where.= $where_operator . "(" . UserModel::FIELDNAME_ID_SERVICE . "='" . $rowsServiceFta[UserModel::FIELDNAME_ID_SERVICE] . "' ";


                    //Dans le cas de processus multisite on n'intègre que les personnes du site concerné
                    if ($rowsServiceFta["min_multisite_fta_processus"]) {
                        $where.=" AND " . UserModel::FIELDNAME_LIEU_GEO . "='" . $rowsServiceFta[UserModel::FIELDNAME_LIEU_GEO] . "' ) ";
                    } else {
                        $where.=")";
                    }
                    $where_operator = " OR ";
                }
                //Ajout des services et sites supplémentaires liés à une diffusion globale
                if ($where_supplementaire) {
                    $where.=$where_operator . $where_supplementaire;
                }
                $where.=")";
            } else {
                //Ne doit pas arriver !
                $where = "";
            }
            /**
             * Il est impératif d'avoir une condition Where dans le requête de diffusion
             * Si ce n'est pas le cas, la diffusion s'étend à l'ensemble des utiisateurs du système Intranet !
             * Il est necessaire d'interdire celà.
             */
            if ($where) {
                //Création de la liste des destinataires
                $req = "SELECT " . UserModel::TABLENAME . "." . UserModel::KEYNAME . ", " . UserModel::FIELDNAME_NOM . ", " . UserModel::FIELDNAME_PRENOM . ", " . UserModel::FIELDNAME_MAIL
                        . " FROM " . UserModel::TABLENAME
                        . ", " . IntranetDroitsAccesModel::TABLENAME
                        . ", " . IntranetModulesModel::TABLENAME
                        . ", " . IntranetActionsModel::TABLENAME
                        . ", " . GeoModel::TABLENAME
                        //Début Droits d'accès de diffusion
                        . " WHERE " . UserModel::TABLENAME . "." . UserModel::KEYNAME
                        . " = " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_USER                                     //Liaison
                        . " AND " . UserModel::TABLENAME . "." . UserModel::FIELDNAME_ACTIF . " ='oui' "                                                                     //maj 2007-08-13 sm sélection des salariés actifs uniquement         . "AND `intranet_droits_acces`.`id_intranet_modules` = `intranet_modules`.`id_intranet_modules` "      //Liaison
                        . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . " = " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME      //Liaison
                        . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS . " = 'diffusion' "                                       //Droits de diffusion
                        . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . " = 1 "                                    //Droits de diffusion
                        . " AND " . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES . " = 'fta' "                                             //Module FTA
                        . " AND " . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME
                        . " = " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES      //Lien entre le module et les droits
                        . " AND " . GeoModel::TABLENAME . "." . GeoModel::KEYNAME
                        . "=" . UserModel::TABLENAME . "." . UserModel::FIELDNAME_LIEU_GEO
                        //Début Droits d'accès de diffusion
                        . $where                                  //Restriction au niveau du service et site de rattachement
                ;
                $logTransition.="\n\n" . $req . "\nFIN DIFFUSION";
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
                        . " WHERE " . GeoModel::FIELDNAME_ID_SITE . " = " . $SiteDeProduction
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

//Fin de la vérification que la FTA est bien validé
}
