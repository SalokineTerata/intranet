<?php

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */

//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);
//Inclusions
//include ('../lib/session.php');
//include ('../lib/functions.php');
//include ('./functions.php');

require_once '../inc/main.php';


/*
  -----------------
  ACTION A TRAITER
  -----------------
  -----------------------------------
  Détermination de l'action en cours
  -----------------------------------

  Cette page est appelée pour effectuer un traitement particulier
  en fonction de la variable '$action'. Ensuite elle redirige le
  résultat vers une autre page.

  Le plus souvent, le traitement est délocalisé sous forme de
  fonction située dans le fichier 'functions.php'

 */

/**
 * Valeurs récupérées
 */
$action = Lib::getParameterFromRequest('action');
$new_correction_fta_suivi_projet = Lib::getParameterFromRequest('new_correction_fta_suivi_projet');
$paramIdFta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
$paramIdFtaChapitreEncours = Lib::getParameterFromRequest('id_fta_chapitre_encours');
$temp_colis_activation_codesoft_arti2 = Lib::getParameterFromRequest('temp_colis_activation_codesoft_arti2');
$temp_composition_activation_codesoft_arti2 = Lib::getParameterFromRequest('temp_composition_activation_codesoft_arti2');
$conditionnement_expedition = Lib::getParameterFromRequest('conditionnement_expedition');
$paramSyntheseAction = Lib::getParameterFromRequest('synthese_action');
$societe_demandeur_fta = Lib::getParameterFromRequest('societe_demandeur_fta');
//$id_classification_fta = Lib::getParameterFromRequest('id_classification_fta');
$paramSignatureValidationSuiviProjet = Lib::getParameterFromRequest(FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET);
$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);
$idFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$comeback = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$is_data_validation_successful = Lib::getParameterFromRequest("is_data_validation_successful");
$selection_proprietaire1 = Lib::getParameterFromRequest('selection_proprietaire1');
$selection_proprietaire2 = Lib::getParameterFromRequest('selection_proprietaire2');
$selection_marque = Lib::getParameterFromRequest('selection_marque');
$selection_activite = Lib::getParameterFromRequest('selection_activite');
$selection_rayon = Lib::getParameterFromRequest('selection_rayon');
$selection_environnement = Lib::getParameterFromRequest('selection_environnement');
$selection_reseau = Lib::getParameterFromRequest('selection_reseau');
$selection_saisonnalite = Lib::getParameterFromRequest('selection_saisonnalite');
/**
 * Initialisation
 */
$modelFta = new FtaModel($paramIdFta);
$abreviationFtaEtat = $modelFta->getModelFtaEtat()->getDataField(FtaEtatModel::FIELDNAME_ABREVIATION)->getFieldValue();
switch ($action) {

    /*
      S'il n'y a pas d'actions défini
     */
    case '':

        //Redirection
        header('Location: index.php');
        /**
         * Version avec le module rewrite
         */
//        header('Location: index.html');

        break;

    //Gestion des Erreurs
    case 'correction':

        if ($new_correction_fta_suivi_projet) {
            $paramIdFtaChapitre = $paramIdFtaChapitreEncours;
            $option[FtaSuiviProjetModel::FIELDNAME_CORRECTION_FTA_SUIVI_PROJET] = $new_correction_fta_suivi_projet;
            $noredirection = FtaChapitreModel::buildCorrectionChapitre($paramIdFta, $paramIdFtaChapitre, $option);
        } else {
            $titre = 'Informations manquantes';
            $message = 'Vous devez spécifier l\'objet de votre correction.';
            Lib::showMessage($titre, $message);
            $noredirection = 1;
        }
        break;

    case 'suppression_classification_chemin':

        //Suppresion du chemin
        //$id_classification_fta;             //From URL
        //$id_fta;                            //From URL
        //mysql_table_operation('classification_fta', 'delete');
        ObjectFta::deleteClassification();
        break;

    case 'valider':

        if ($is_data_validation_successful) {

            /**
             * Initialisation
             */
            $idFtaSuiviProjet = FtaSuiviProjetModel::getIdFtaSuiviProjetByIdFtaAndIdChapitre($paramIdFta, $paramIdFtaChapitreEncours);
            $modelFtaSuiviProjet = new FtaSuiviProjetModel($idFtaSuiviProjet);
            $modeChapitre = new FtaChapitreModel($paramIdFtaChapitreEncours);
            $idFtaWorkflowStruture = FtaWorkflowStructureModel::getIdFtaWorkflowStructureByIdFtaAndIdChapitre($paramIdFta, $paramIdFtaChapitreEncours);
            $modelFtaWorkflowStruture = new FtaWorkflowStructureModel($idFtaWorkflowStruture);


            /**
             * Actualisation de la durée de vie garantie client
             */
            $nomFtaWorkflow = $modelFtaWorkflowStruture->getModelFtaWorkflow()->getDataField(FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW)->getFieldValue();
            $nomFtaChapitre = $modelFtaWorkflowStruture->getModelFtaChapitre()->getDataField(FtaChapitreModel::FIELDNAME_NOM_CHAPITRE)->getFieldValue();
            FtaController::refreshDureeDeVieMDD($nomFtaWorkflow, $nomFtaChapitre, $modelFtaSuiviProjet->getModelFta());


            /*             * q
             * Enregistrement de la signature
             */
            $isFtaDataValidationSuccess = $modelFtaSuiviProjet->getModelFta()->isFtaDataValidationSuccess($paramIdFtaChapitreEncours);


            if ($paramSignatureValidationSuiviProjet and $isFtaDataValidationSuccess == "0") {
                $modelFtaSuiviProjet->getDataField(FtaSuiviProjetModel::FIELDNAME_DATE_VALIDATION_SUIVI_PROJET)->setFieldValue(date("Y-m-d"));
                $modelFtaSuiviProjet->setSigned($paramSignatureValidationSuiviProjet);
                $modelFtaSuiviProjet->saveToDatabase();
            }
        } else {
            $titre = 'Informations';
            $message = 'Vous ne pouvez pas valider le chapitre une information est manquante ou incorrecte,<br>'
                    . 'mise en évidence en Rouge.';
            Lib::showMessage($titre, $message);
        }

        break;

    case 'suppression_tarif':

//Variables passées en URL
        $id_fta_tarif;
        $paramIdFta;
        mysql_table_operation('fta_tarif', 'delete');

//header ('Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action');
        break;

    case 'suppression_conditionnement':

//Variables passées en URL
        $id_fta_conditionnement = Lib::getParameterFromRequest(FtaConditionnementModel::KEYNAME);

        /*
         * Suppression du conditionnement
         */

        FtaConditionnementModel::deleteFtaConditionnement($id_fta_conditionnement);

        break;

    case 'suppression_palettisation':

//Variables passées en URL
//        $paramIdFta;
//        $id_fta_conditionnement;
//        mysql_table_operation('fta_conditionnement', 'delete');
//header ('Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action');
        break;

    case 'suppression_nomenclature':

//Suppression de la nomenclature
//$id_fta_nomenclature;
//recette_nomenclature_suppression($id_fta_nomenclature);
//        mysql_table_operation('fta_composant', 'delete');
//header ('Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action');
        break;

    case 'suppression_composant':

//Suppression de la nomenclature
//$id_fta_composition;
        $id_fta_composant = Lib::getParameterFromRequest(FtaComposantModel::KEYNAME);

        /*
         * Suppression du conditionnement
         */

        FtaComposantModel::deleteFtaComposant($id_fta_composant);

//header ('Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action');
        break;
    /*     * **********
      Fin de switch
     * ********** */
}

//if(!$erreur and !$noredirection) header ('Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action');
if (!$erreur) {
    header('Location: modification_fiche.php?id_fta=' . $paramIdFta . '&id_fta_chapitre_encours=' . $paramIdFtaChapitreEncours . '&synthese_action=' . $paramSyntheseAction . '&id_fta_etat=' . $idFtaEtat . '&abreviation_fta_etat=' . $abreviationFtaEtat . '&id_fta_role=' . $idFtaRole);
    /**
     * Version avec le module rewrite
     */
//    header('Location: modification_fiche-' . $paramIdFta . '-' . $paramIdFtaChapitreEncours . '-' . $paramSyntheseAction . '-' . $idFtaEtat . '-' . $abreviationFtaEtat . '-' . $comeback . '-' . $idFtaRole . '.html');
}
//include ('./action_bs.php');
//include ('./action_sm.php');


