<?php

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */

//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);
//Inclusions
//include ("../lib/session.php");
//include ("../lib/functions.php");
//include ("./functions.php");

require_once '../inc/main.php';


/*
  -----------------
  ACTION A TRAITER
  -----------------
  -----------------------------------
  Détermination de l'action en cours
  -----------------------------------

  Cette page est appelée pour effectuer un traitement particulier
  en fonction de la variable "$action". Ensuite elle redirige le
  résultat vers une autre page.

  Le plus souvent, le traitement est délocalisé sous forme de
  fonction située dans le fichier "functions.php"

 */

/**
 * Valeurs récupérées
 */
$action = Lib::getParameterFromRequest("action");
$new_correction_fta_suivi_projet = Lib::getParameterFromRequest("new_correction_fta_suivi_projet");
$paramIdFta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
$paramIdFtaChapitreEncours = Lib::getParameterFromRequest("id_fta_chapitre_encours");
$temp_colis_activation_codesoft_arti2 = Lib::getParameterFromRequest("temp_colis_activation_codesoft_arti2");
$temp_composition_activation_codesoft_arti2 = Lib::getParameterFromRequest("temp_composition_activation_codesoft_arti2");
$conditionnement_expedition = Lib::getParameterFromRequest("conditionnement_expedition");
$paramSyntheseAction = Lib::getParameterFromRequest("synthese_action");
$societe_demandeur_fta = Lib::getParameterFromRequest("societe_demandeur_fta");
//$id_classification_fta = Lib::getParameterFromRequest("id_classification_fta");
$paramSignatureValidationSuiviProjet = Lib::getParameterFromRequest(FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET);
$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);
$idFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$comeback = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);

switch ($action) {

    /*
      S'il n'y a pas d'actions défini
     */
    case '':

        //Redirection
        header("Location: index.php");

        break;

    //Gestion des Erreurs
    case 'correction':

        if ($new_correction_fta_suivi_projet) {
            $paramIdFtaChapitre = $paramIdFtaChapitreEncours;
            $option[FtaSuiviProjetModel::FIELDNAME_CORRECTION_FTA_SUIVI_PROJET] = $new_correction_fta_suivi_projet;
            $noredirection = FtaChapitreModel::BuildCorrectionChapitre($paramIdFta, $paramIdFtaChapitre, $option);
        } else {
            $titre = "Informations manquantes";
            $message = "Vous devez spécifier l'objet de votre correction.";
            Lib::showMessage($titre, $message);
            $noredirection = 1;
        }
        break;

    case 'suppression_classification_chemin':

        //Suppresion du chemin
        //$id_classification_fta;             //From URL
        //$id_fta;                            //From URL
        //mysql_table_operation("classification_fta", "delete");
        ObjectFta::deleteClassification();
        break;

    case 'valider':


        $modelFta = new FtaModel($paramIdFta);
        $modelFta->saveToDatabase();


        /**
         * Enregistrement de la signature
         */
        $idFtaSuiviProjet = FtaSuiviProjetModel::getIdFtaSuiviProjetByIdFtaAndIdChapitre($paramIdFta, $paramIdFtaChapitreEncours);
        $modelFtaSuiviProjet = new FtaSuiviProjetModel($idFtaSuiviProjet);
        $modeChapitre = new FtaChapitreModel($paramIdFtaChapitreEncours);
        $idFtaWorkflowStruture = FtaWorkflowStructureModel::getIdFtaWorkflowStructureByIdFtaAndIdChapitre($paramIdFta, $paramIdFtaChapitreEncours);
        $modelFtaWorkflowStruture = new FtaWorkflowStructureModel($idFtaWorkflowStruture);

        $modelFtaSuiviProjet->getDataField(FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET)->setFieldValue($paramSignatureValidationSuiviProjet);

        $date_echeance_fta = $modelFta->getDataField(FtaModel::FIELDNAME_DATE_ECHEANCE_FTA)->getFieldValue();

        $abreviationFtaEtat = $modelFta->getModelFtaEtat()->getDataField(FtaEtatModel::FIELDNAME_ABREVIATION)->getFieldValue();

        $idFtaProcessusEncours = $modelFtaWorkflowStruture->getDataField(FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS)->getFieldValue();
        $idFtaWorkflowEncours = $modelFtaWorkflowStruture->getDataField(FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW)->getFieldValue();

        $nom_fta_chapitre_encours = $modeChapitre->getDataField(FtaChapitreModel::FIELDNAME_NOM_CHAPITRE)->getFieldValue();

        /**
         * Cette condition n'est plus à verifier puisque seul la date echande de processus est utilisé
         * Gestion des délais (Attention, uniquement sur le chapitre identité)
         */
        /**
          if ($nom_fta_chapitre_encours == "identite") {
          // //Si oui, dans ce cas, Récupération de la liste des processus affectés
          $arrayFtaProcessusAndCycle = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
          "SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . ", " . FtaProcessusModel::FIELDNAME_NOM . ", " . FtaProcessusModel::FIELDNAME_DELAI
          . " FROM " . FtaProcessusCycleModel::TABLENAME . ", " . FtaProcessusModel::TABLENAME
          . " WHERE " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='" . $abreviationFtaEtat . "'"
          . " AND " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . "=" . FtaProcessusModel::KEYNAME
          . " ORDER BY " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
          );



          $date_echeance_processus_last = $date_echeance_fta;
          foreach ($arrayFtaProcessusAndCycle as $rowsArrayFtaProcessusAndCycle) {

          //Construction de la liste de processus
          $html_date.="";
          $champ_date_echeance_processus = "date_echeance_processus_" . $rowsArrayFtaProcessusAndCycle[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT];

          //Une date d'échéance pour la FTA a-t-elle été saisie ?
          if ($date_echeance_fta) {
          //Dans ce cas on cherche à renregistrer la date d'échéance des processus
          $$champ_date_echeance_processus = Lib::getParameterFromRequest($champ_date_echeance_processus);

          //Une date a-t-elle été saisie ?
          if ($$champ_date_echeance_processus) {
          //Controle de cohérence
          //Récupération de la liste des processus précédent pour ce cycle de vie
          $arrayFtaProcessusAndCyclePrecedent = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
          "SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . ", " . FtaProcessusModel::FIELDNAME_NOM . ", " . FtaProcessusModel::FIELDNAME_DELAI
          . " FROM " . FtaProcessusCycleModel::TABLENAME . ", " . FtaProcessusModel::TABLENAME
          . " WHERE " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='" . $abreviationFtaEtat . "'"
          . " AND " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . "=" . FtaProcessusModel::KEYNAME
          . "AND " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT . "=" . $rowsArrayFtaProcessusAndCycle[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT] . " "
          . " ORDER BY " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
          );

          if ($arrayFtaProcessusAndCyclePrecedent) {
          foreach ($arrayFtaProcessusAndCyclePrecedent as $rowsArrayFtaProcessusAndCyclePrecedent) {
          $champ_previous = "date_echeance_processus_" . $rowsArrayFtaProcessusAndCyclePrecedent[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT];
          if ($$champ_previous > $$champ_date_echeance_processus) {
          //echo ": ".$rows_last_processus["nom_fta_processus"]."=".$$champ_previous." vs ".$rows["nom_fta_processus"]."=".$$champ."<br>";
          $titre = "Erreur de date d'échéance";
          $message = "Date d'échéance pour " . $rowsArrayFtaProcessusAndCycle[FtaProcessusModel::FIELDNAME_NOM] . "=" . $$champ_date_echeance_processus
          . "<br>Date d'échéance pour " . $rowsArrayFtaProcessusAndCyclePrecedent[FtaProcessusModel::FIELDNAME_NOM] . "=" . $$champ_previous
          . "<br><br>Le processus " . $rowsArrayFtaProcessusAndCycle[FtaProcessusModel::FIELDNAME_NOM] . " doit être validé <b>APRES</b> le processus " . $rowsArrayFtaProcessusAndCyclePrecedent[FtaProcessusModel::FIELDNAME_NOM]
          ;
          afficher_message($titre, $message, $redirection);
          }
          }
          } else {
          //Il s'agit du dernier processus, controler directement avec la date d'échéanc de la FTA
          if ($$champ_date_echeance_processus > $date_echeance_fta) {
          $titre = "Erreur de date d'échéance";
          $message = "La date d'échéance pour le processus " . $rowsArrayFtaProcessusAndCycle[FtaProcessusModel::FIELDNAME_NOM] . " est trop courte";
          afficher_message($titre, $message, $redirection);
          }
          }
          } else {
          //Calculer les dates théoriques automatiquement à partir de la date d'échéance de validation

          $annee_date_echeance_fta = substr($date_echeance_fta, 0, 4);
          $mois_date_echeance_fta = substr($date_echeance_fta, 5, 2);
          $jour_date_echeance_fta = substr($date_echeance_fta, 8, 2);
          $delai_jour = $rowsArrayFtaProcessusAndCycle[FtaProcessusModel::FIELDNAME_DELAI] * 7;
          $timestamp_date_echeance_fta = mktime(0, 0, 0, $mois_date_echeance_fta, $jour_date_echeance_fta - $delai_jour, $annee_date_echeance_fta);
          $$champ_date_echeance_processus = date("Y-m-d", $timestamp_date_echeance_fta);
          //echo  ${$champ}."<br>";
          }
          } else {
          //Si il n'y a pas de date d'échéance de validation de la FTA, on efface les éventuelles anciennes saisies
          $$champ_date_echeance_processus = "0000-00-00";
          }
          //Enregistrement des délais de processus
          //Recherche d'enregistrement déjà existant pour mise à jour, sinon insertion
          $arrayFtaProcessusDelai = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray("SELECT " . FtaProcessusDelaiModel::KEYNAME
          . " FROM " . FtaProcessusDelaiModel::TABLENAME
          . " WHERE " . FtaModel::KEYNAME . "='" . $paramIdFta . "'"
          . " AND " . FtaProcessusModel::KEYNAME . "= '" . $rowsArrayFtaProcessusAndCycle[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT] . "' "
          );

          if ($arrayFtaProcessusDelai) {
          foreach ($arrayFtaProcessusDelai as $rowsArrayFtaProcessusDelai) {
          //Si l'enregistrement existe, alors mise à jour des informations
          $operation = "update";

          //Récupération de l'identifiant pour permettre la mise à jour de celui-ci
          $id_fta_processus_delai = $rowsArrayFtaProcessusDelai[FtaProcessusDelaiModel::KEYNAME];
          }
          } else {
          //Sinon insertion d'un nouvel enregistrement
          $operation = "insert";
          }
          //Opération d'enregistrement des informations
          $id_fta_processus = $rowsArrayFtaProcessusAndCycle[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT];
          $date_echeance_processus = $$champ_date_echeance_processus;
          $table = "fta_processus_delai";
          mysql_table_operation($table, $operation);
          FtaProcessusDelaiModel::BuildFtaProcessusValidationDelai($paramIdFta, $id_fta_processus, $idFtaWorkflowEncours);

          }//Fin du parcours des échéances par processus
          }//Si non, désactivation de la gestion des échéances au niveau processus
         * */
         
//Enregistrement des informations
//        $paramIdFta; //Valeur donnée en URL
//        $operation = "update";
//        $table = "fta";
////$objectFta->setFieldValue(ObjectFta::TABLE_FTA_NAME, "societe_demandeur_fta", $societe_demandeur_fta);
//        mysql_table_operation($table, $operation);

//Suivi de dossier
//        if ($id_fta_suivi_projet) {
//            $operation = "update";
//        } else {
//            $operation = "insert";
//        }
//        $id_fta_chapitre = $paramIdFtaChapitreEncours;
        if (!$paramSignatureValidationSuiviProjet) {
            $paramSignatureValidationSuiviProjet = 0;
        }
//        $table = "fta_suivi_projet";
//        mysql_table_operation($table, $operation);

//Controle des donnée et access_arti2
        if ($modelFta->getDataField(FtaModel::FIELDNAME_LIBELLE)->getFieldValue()) {
            $modelFta->getDataField(FtaModel::FIELDNAME_LIBELLE)->setFieldValue(
                    mb_convert_case(
                            stripslashes(
                                    $modelFta->getDataField(
                                            FtaModel::FIELDNAME_LIBELLE)->getFieldValue()
                            ), MB_CASE_UPPER, "utf-8")
            );
        }

//Nom de l'étiquette par défaut si on enregistre sur le chapitre Gestion des articles (cf. table fta_chapitre)
        if (($modelFta->getDataField(FtaModel::FIELDNAME_LIBELLE_CLIENT)->getFieldValue() == null) and ( $nom_fta_chapitre == "activation_article")) {
            $modelFta->getDataField(FtaModel::FIELDNAME_LIBELLE_CLIENT)->setFieldValue($modelFta->getDataField(FtaModel::FIELDNAME_LIBELLE)->getFieldValue());
        }
//        $table = "fta";
//        $operation = "update";
//        mysql_table_operation($table, $operation);

//Cohérence des durées de vie (restrictino du message uniquement au niveau du processus Qualité)
        if ($modelFta->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_MAXIMALE)->getFieldValue() < $modelFta->getDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION)->getFieldValue() and ( $paramIdFtaChapitreEncours == 100)) {

            $titre = "Différences dans les Durées de vie";
            $message = "Votre <b>" . mysql_field_desc(FtaModel::TABLENAME, FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_MAXIMALE) . "</b> est inférieure à la <b>" . mysql_field_desc("access_arti2", "Durée_de_vie_technique") . "</b>.<br>"
            ;
            afficher_message($titre, $message, $redirection);
            $erreur = 1;
        }

//Cohérence du Code LDC
// ************** GESTION MULTI PCB POUR MEME CODE GROUPE
        if ($modelFta->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->getFieldValue() and ModuleConfig::CODE_LDC_UNIQUE) {
            //if($code_article_ldc and false)
            $arrayCoherenceLDC = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            "SELECT " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
                            . " FROM " . FtaModel::TABLENAME . "," . FtaEtatModel::TABLENAME
                            . " WHERE " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_DOSSIER_FTA . " <> '" . $modelFta->getDataField(FtaModel::FIELDNAME_DOSSIER_FTA)->getFieldValue() . "' "
                            . " AND " . FtaEtatModel::TABLENAME . "." . FtaEtatModel::KEYNAME . "=" . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT
                            . "AND " . FtaEtatModel::FIELDNAME_ABREVIATION . "<>'R' "
            );


            if ($arrayCoherenceLDC) {//Si le code est déjà affecté à une autre FTA, on informe, et on suppime l'affectation sur la FTA en cours
                foreach ($arrayCoherenceLDC as $rowsCoherenceLDC) {
                    $titre = "Code Article déjà affecté";
                    $message = "Attention, le code LDC est déjà affecté à la FTA n°" . $rowsCoherenceLDC[FtaModel::KEYNAME] . "<br>"
                            . "Votre code ne sera pas enregistré."
                    ;
                    afficher_message($titre, $message, $redirection);
                    $modelFta->getDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC)->setFieldValue(null);
                    $erreur = 1;
                }
            }
        }

//Cohérence du Code Agrologic
        if ($modelFta->getDataField(FtaModel::FIELDNAME_ARTICLE_AGROLOGIC)->getFieldValue()) {
            $arrayCoherenceCodeAgro = DatabaseOperation::convertSqlStatementWithoutKeyToArray("SELECT " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
                            . " FROM " . FtaModel::TABLENAME
                            . " WHERE " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ARTICLE_AGROLOGIC . "= '" . $modelFta->getDataField(FtaModel::FIELDNAME_ARTICLE_AGROLOGIC)->getFieldValue() . "' "
                            . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_DOSSIER_FTA . " <> '" . $modelFta->getDataField(FtaModel::FIELDNAME_DOSSIER_FTA)->getFieldValue() . "' "
                            . " AND (" . FtaModel::TABLENAME . "." . FtaModel::KEYNAME . "=1 OR " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT . "=3) "
            );

            if ($arrayCoherenceCodeAgro) {//Si le code est déjà affecté à une autre FTA, on informe, et on suppime l'affectation sur la FTA en cours
                foreach ($arrayCoherenceCodeAgro as $rowsCoherenceCodeAgro) {
                    $titre = "Code Article Agrologic déjà affecté";
                    $message = "Attention, le code Agrologic est déjà affecté à la FTA n°" . $rowsCoherenceCodeAgro[FtaModel::KEYNAME] . "<br>"
                            . "Votre code ne sera pas enregistré."
                    ;
                }
                afficher_message($titre, $message, $redirection);

                $modelFta->getDataField(FtaModel::FIELDNAME_ARTICLE_AGROLOGIC)->setFieldValue(null);
                $erreur = 1;
            }
        }

        if (!$erreur) {
            //Mise à jour de la validation de l'échéance
            $paramIdFta;
            $id_fta_processus = $idFtaProcessusEncours;

            /*
             * Fonction non utilisé
             */
            //FtaProcessusDelaiModel::BuildFtaProcessusValidationDelai($paramIdFta, $id_fta_processus, $idFtaWorkflowEncours);
            //Notification de l'état d'Avancement de la FTA
            //afficher_message("Information de l'état d'avancement du Projet", "Les intervenants ont été informer du nouvel état d'avancement.", "");
            $liste_user = FtaSuiviProjetModel::getListeUsersAndNotificationSuiviProjet($paramIdFta, $paramIdFtaChapitreEncours);

            if ($liste_user) {
                $noredirection = 1;
            }
        } else {
            $modelFtaSuiviProjet->getDataField(FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET)->setFieldValue(0);
        }

//Sauvegarde des enregistrements dans la base de données.
        $modelFtaSuiviProjet->saveToDatabase();

        break;

    case 'suppression_tarif':

//Variables passées en URL
        $id_fta_tarif;
        $paramIdFta;
        mysql_table_operation("fta_tarif", "delete");

//header ("Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action");
        break;

    case 'suppression_conditionnement':

//Variables passées en URL
        $paramIdFta = Lib::getParameterFromRequest("id_fta");
        $id_fta_conditionnement = Lib::getParameterFromRequest(FtaConditionnementModel::KEYNAME);

        /*
         * Suppression du conditionnement
         */

        FtaConditionnementModel::deleteFtaConditionnement($id_fta_conditionnement);

        break;

    case 'suppression_palettisation':

//Variables passées en URL
        $paramIdFta;
        $id_fta_conditionnement;
        mysql_table_operation("fta_conditionnement", "delete");

//header ("Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action");
        break;

    case 'suppression_nomenclature':

//Suppression de la nomenclature
//$id_fta_nomenclature;
//recette_nomenclature_suppression($id_fta_nomenclature);
        mysql_table_operation("fta_composant", "delete");


//header ("Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action");
        break;

    case 'suppression_composant':

//Suppression de la nomenclature
//$id_fta_composition;
        $id_fta_composant;
        mysql_table_operation("fta_composant", "delete");

//header ("Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action");
        break;
    /*     * **********
      Fin de switch
     * ********** */
}

//if(!$erreur and !$noredirection) header ("Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action");
if (!$erreur) {
    header("Location: modification_fiche.php?id_fta=$paramIdFta&id_fta_chapitre_encours=$paramIdFtaChapitreEncours&synthese_action=$paramSyntheseAction&comeback=$comeback&id_fta_etat=$idFtaEtat&abreviation_fta_etat=$abreviationFtaEtat&id_fta_role=$idFtaRole");
}
//include ("./action_bs.php");
//include ("./action_sm.php");


