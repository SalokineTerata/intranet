<?php

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */

//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);
//
//
////Inclusions
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


$action = Lib::getParameterFromRequest('action');
$idAnnexeEmballageGroupeType = Lib::getParameterFromRequest('id_annexe_emballage_groupe_type');
$idFta = Lib::getParameterFromRequest('id_fta'); //Identifiant de la fiche technique article
$idAnnexeEmballageGroupe = Lib::getParameterFromRequest('id_annexe_emballage_groupe');
$idAnnexeEmballage = Lib::getParameterFromRequest('id_annexe_emballage'); //Identifiant de l'emballage
$idFtaChapitreEncours = Lib::getParameterFromRequest('id_fta_chapitre');
$syntheseAction = Lib::getParameterFromRequest('synthese_action');
$abreviationFtaEtat = Lib::getParameterFromRequest('abreviation_fta_etat');
$idFtaEtat = Lib::getParameterFromRequest('id_fta_etat');
$idFtaRole = Lib::getParameterFromRequest('id_fta_role');
$comeback = Lib::getParameterFromRequest('comeback');
switch ($action) {

    /*
      S'il n'y a pas d'actions défini
     */
    case '':
        //Redirection
        header('Location: index.php');
         /**
          * Version avec le rewrite
          */
//        header('Location: index.html');

        break;
    case 'etape1': //Un groupe d'emballage a été sélectionné
        //Renvoi sur la page d'ajout avec cette nouvelle information de groupe d'emballage sélectionné
        header('Location: ajout_conditionnement.php?id_fta=' . $idFta
                . '&id_annexe_emballage_groupe_type=' . $idAnnexeEmballageGroupeType
                . '&id_annexe_emballage_groupe=' . $idAnnexeEmballageGroupe
                . '&action=etape2&id_fta_chapitre=' . $idFtaChapitreEncours
                . '&synthese_action=' . $syntheseAction
                . '&comeback=' . $comeback
                . '&id_fta_etat=' . $idFtaEtat
                . '&abreviation_fta_etat=' . $abreviationFtaEtat
                . '&id_fta_role=' . $idFtaRole);
        /**
         * jQuery
         */
//        header('Location: ajout_conditionnement.php?id_fta=' . $idFta
//                . '&id_annexe_emballage_groupe_type=' . $idAnnexeEmballageGroupeType
//                . '&id_annexe_emballage=' . $idAnnexeEmballage
//                . '&action=etape3&id_fta_chapitre=' . $idFtaChapitreEncours
//                . '&synthese_action=' . $syntheseAction
//                . '&comeback=' . $comeback
//                . '&id_fta_etat=' . $idFtaEtat
//                . '&abreviation_fta_etat=' . $abreviationFtaEtat
//                . '&id_fta_role=' . $idFtaRole);

        break;

    case 'etape2': //Un emballage précis a été sélectionné
        //Renvoi sur la page d'ajout avec cette nouvelle information de groupe d'emballage sélectionné
        header('Location: ajout_conditionnement.php?id_fta=' . $idFta
                . '&id_annexe_emballage_groupe_type=' . $idAnnexeEmballageGroupeType
                . '&id_annexe_emballage_groupe=' . $idAnnexeEmballageGroupe
                . '&id_annexe_emballage=' . $idAnnexeEmballage
                . '&action=etape3&id_fta_chapitre=' . $idFtaChapitreEncours
                . '&synthese_action=' . $syntheseAction
                . '&comeback=' . $comeback
                . '&id_fta_etat=' . $idFtaEtat
                . '&abreviation_fta_etat=' . $abreviationFtaEtat
                . '&id_fta_role=' . $idFtaRole);

//        break;

    case 'etape3': //Un emballage a été sélectionné
    case 'saisie_manuel':

        /*
         * Initialisation du modele
         */
        $annexeEmballageModel = new AnnexeEmballageModel($idAnnexeEmballage);
        /*
         * Enregistrement de l'emballage affecter à cette FTA
         */
        //Récuperation des données
        $nbCoucheFtaConditionnement = Lib::getParameterFromRequest(FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT); //Une seule couche par UVC
        $hauteurFtaConditionnement = $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_HAUTEUR_ANNEXE_EMBALLAGE)->getFieldValue();
        $longeurFtaConditionnement = $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_LONGUEUR_ANNEXE_EMBALLAGE)->getFieldValue();
        $largeurFtaConditionnement = $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_LARGEUR_ANNEXE_EMBALLAGE)->getFieldValue();
        $poidsFtaConditionnement = $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_POIDS_ANNEXE_EMBALLAGE)->getFieldValue();             //Poids des emballages qui ont peuvent varier selon les articles (comme des films)
        $qteCoucheFtaConditionnement = Lib::getParameterFromRequest(FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT); //Quantité par UVC
        if ($idAnnexeEmballageGroupeType == 3) {
            $qteCoucheFtaConditionnement = $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_QUANTITE_PAR_COUCHE_ANNEXE_EMBALLAGE)->getFieldValue();
            $nbCoucheFtaConditionnement = $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_NOMBRE_COUCHE_ANNEXE_EMBALLAGE)->getFieldValue();
        }


        FtaConditionnementModel::addFtaConditionnement($idFta, $idAnnexeEmballage, $idAnnexeEmballageGroupe, $idAnnexeEmballageGroupeType, $hauteurFtaConditionnement, $longeurFtaConditionnement
                , $largeurFtaConditionnement, $poidsFtaConditionnement, $nbCoucheFtaConditionnement, $qteCoucheFtaConditionnement);




        header('Location: modification_fiche.php?id_fta=' . $idFta . '&id_fta_chapitre_encours=' . $idFtaChapitreEncours . '&synthese_action=encours'. '&id_fta_etat=' . $idFtaEtat . '&abreviation_fta_etat=' . $abreviationFtaEtat. '&id_fta_role=' . $idFtaRole);
         /**
          * Version avec le rewrite
          */
//        header('Location: modification_fiche-' . $idFta . '-' . $idFtaChapitreEncours . '-encours'. '-' . $idFtaEtat . '-' . $abreviationFtaEtat.'-' . $comeback  . '-' . $idFtaRole .'.html');
        break;


    /*     * **********
      Fin de switch
     * ********** */
}
//include ('./action_bs.php');
//include ('./action_sm.php');
?>

