<?php

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */

//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);
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
$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);
$id_fta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
$idFtaWorkflow = Lib::getParameterFromRequest(FtaWorkflowModel::KEYNAME);
$designationCommercialeFta = Lib::getParameterFromRequest(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE);
$abreviationFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::FIELDNAME_ABREVIATION);
$siteDeProduction = Lib::getParameterFromRequest(GeoModel::KEYNAME);

/**
 * Vérification de la sélection d'un site de production et d'un espace de travail
 */
if ($idFtaWorkflow == FtaWorkflowModel::ID_FTA_WORKFLOW_NON_DEFINI) {
    //Averissement
    $titre = UserInterfaceMessage::FR_WARNING_DATA_ESPACE_DE_TRAVAIL_TITLE;
    $message = UserInterfaceMessage::FR_WARNING_DATA_ESPACE_DE_TRAVAIL;
    afficher_message($titre, $message, $redirection);
}
if ($siteDeProduction == GeoModel::ID_SITE_NON_DEFINIE) {
    //Averissement
    $titre = UserInterfaceMessage::FR_WARNING_DATA_SITE_DE_PRODUCTION_TITLE;
    $message = UserInterfaceMessage::FR_WARNING_DATA_SITE_DE_PRODUCTION;
    afficher_message($titre, $message, $redirection);
}
if (!$designationCommercialeFta) {
    //Averissement
    $titre = UserInterfaceMessage::FR_WARNING_DATA_DESIGNATION_COMMERCIALE_TITLE;
    $message = UserInterfaceMessage::FR_WARNING_DATA_DESIGNATION_COMMERCIALE;
    afficher_message($titre, $message, $redirection);
}

If ($idFtaWorkflow == '2' and $idFtaRole == FtaRoleModel::ID_FTA_ROLE_CHEF_DE_PROJET) {
    $idFtaRole = FtaRoleModel::ID_FTA_ROLE_SITE;
}

switch ($action) {

    /*
      S'il n'y a pas d'actions défini
     */
    case 1: //Création d'une FTA Vierge
//        $idFta = null;

        $arrayIdEtat = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . FtaEtatModel::KEYNAME
                        . ' FROM ' . FtaEtatModel::TABLENAME
                        . ' WHERE ' . FtaEtatModel::FIELDNAME_ABREVIATION . '=\'' . $abreviationFtaEtat . '\' '
        );

        foreach ($arrayIdEtat as $rowsIdEtat) {
            $idFtaEtat = $rowsIdEtat[FtaEtatModel::KEYNAME];
        }

        /*
         * Initialisation de l'enregistrement de la Table FTA
         */
        $globalConfig = new GlobalConfig();
        UserModel::checkUserSessionExpired($globalConfig);

        $idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();

        $idFta = FtaModel::createFta($idUser, $idFtaEtat, $idFtaWorkflow, $designationCommercialeFta, date('d-m-Y'), $siteDeProduction);

        DatabaseOperation::execute(
                'UPDATE ' . FtaModel::TABLENAME
                . ' SET ' . FtaModel::FIELDNAME_DOSSIER_FTA . '=' . $idFta
                . ' WHERE ' . FtaModel::KEYNAME . '=' . $idFta
        );


        FtaSuiviProjetModel::initFtaSuiviProjet($idFta);

        //Cas d'une fiche Présentation 
        /**
         * Ce cas n'est plus utiliser puisque l'espasce de travail Présentation,
         * regroupe tous les chapitres nécéssaire
         */
        if ($abreviationFtaEtat == 'P') {
            //Condition where
            $where = '';

            //Récupération des chapitres concernés par ce cycle de vie
            $arrayChapitreCycle = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT ' . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT
                            . ', ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                            . ', ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                            . ' FROM ' . FtaProcessusCycleModel::TABLENAME
                            . ' WHERE ' . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . ' = \'' . $abreviationFtaEtat
                            . '\' AND ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT . ' IS NOT NULL'
            );

            foreach ($arrayChapitreCycle as $rowsChapitreCycle) {
                $where .= ' AND ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME . ' <> ' . $rowsChapitreCycle[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT];
            }

            //Récupération des chapitres à vérrouiller
            $arrayChapitreVerrou = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT DISTINCT ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                            . ' FROM ' . FtaProcessusModel::TABLENAME . ', ' . FtaWorkflowStructureModel::TABLENAME
                            . ' WHERE ( ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME
                            . ' = ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS . ' ) '
                            . ' AND ( ( ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME . ' <>1 ' . $where . ' ) )'
            );

            foreach ($arrayChapitreVerrou as $rowsChapitreVerrou) {
                //Le suivi existe-il déjà ?
                $arrayFtaSuiviProjet = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT ' . FtaSuiviProjetModel::KEYNAME
                                . ' FROM ' . FtaSuiviProjetModel::TABLENAME
                                . ' WHERE ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA . '=\'' . $idFta
                                . '\' AND ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . '=\'' . $rowsChapitreVerrou[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE] . '\' '
                );
                if ($arrayFtaSuiviProjet) {
                    //Mise à jour de l'existant
                    foreach ($arrayFtaSuiviProjet as $rowsFtaSuiviProjet) {
                        $idFtaSuiviProjet = $rowsFtaSuiviProjet[FtaSuiviProjetModel::KEYNAME];
                        $req = 'UPDATE ' . FtaSuiviProjetModel::KEYNAME
                                . ' SET ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . '=' . -1
                                . ' WHERE ' . FtaSuiviProjetModel::KEYNAME . '=\'' . $idFtaSuiviProjet . '\' '
                        ;
                        DatabaseOperation::execute($req);
                    }
                } else {
                    //Création des suivi
                    $req = 'INSERT ' . FtaSuiviProjetModel::TABLENAME
                            . ' SET ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . '=\'' . $rowsChapitreVerrou[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE]
                            . '\', ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA . '=\'' . $idFta
                            . '\', ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . '=' . -1
                    ;
                    DatabaseOperation::execute($req);
                }
            }
        }

        //Redirection
        header('Location: modification_fiche.php?id_fta=' . $idFta
                . '&synthese_action=encours&id_fta_etat=' . $idFtaEtat
                . '&abreviation_fta_etat=' . $abreviationFtaEtat
                . '&id_fta_role=' . $idFtaRole);
        /**
         * Version avec le module rewrite
         * suppresion du comeback dans les URL
         */
//        header('Location: modification_fiche-' . $idFta
//                . '-encours-1-' . $idFtaEtat
//                . '-' . $abreviationFtaEtat
//                . '-' . $idFtaRole . '.html');

        break;

    case 2: //Duplication d'une Fiche Technique Article

        if ($id_fta) {
            $arrayFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT DISTINCT ' . FtaModel::KEYNAME
                            . ' FROM ' . FtaModel::TABLENAME
                            . ' WHERE ( ' . FtaModel::KEYNAME . ' = ' . $id_fta . ' ) '
            );
        } else {
            //Averissement
            $titre = "Manque de donnée id_fta";
            $message = "Veuillez saisir un id_fta existant à dupliquer .<br><br>"
            ;
            afficher_message($titre, $message, $redirection);
        }
        if ($arrayFta) {
            //Redirection
            header('Location: duplication_fiche.php?'
                    . 'id_fta=' . $id_fta
                    . '&synthese_action=modification&abreviation_etat_destination=' . $abreviationFtaEtat
                    . '&new_designation_commerciale_fta=' . $designationCommercialeFta
                    . '&site_de_production=' . $siteDeProduction
                    . '&id_fta_role=' . $idFtaRole
                    . '&id_fta_workflow=' . $idFtaWorkflow);
        } else {
            //Averissement
            $titre = UserInterfaceMessage::FR_WARNING_DATA_ID_FTA_TITLE;
            $message = UserInterfaceMessage::FR_WARNING_DATA_ID_FTA;
            afficher_message($titre, $message, $redirection);
        }
        break;


    /*     * **********
      Fin de switch
     * ********** */
}
?>

