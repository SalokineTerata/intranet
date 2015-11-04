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

If ($idFtaWorkflow == '2' and $idFtaRole == '1') {
    $idFtaRole = '6';
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
        $idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();

        $idFta = FtaModel::CreateFta($idUser, $idFtaEtat, $idFtaWorkflow, $designationCommercialeFta, date('Y-m-d'), $siteDeProduction);

        DatabaseOperation::execute(
                'UPDATE ' . FtaModel::TABLENAME
                . ' SET ' . FtaModel::FIELDNAME_DOSSIER_FTA . '=' . $idFta
                . ' WHERE ' . FtaModel::KEYNAME . '=' . $idFta
        );


        FtaSuiviProjetModel::initFtaSuiviProjet($idFta);

        //Cas d'une fiche Présentation
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
        header('Location: modification_fiche-' . $idFta
                . '-encours-1-' . $idFtaEtat
                . '-' . $abreviationFtaEtat
                . '-' . $idFtaRole . '.html');

        break;

    case 2: //Duplication d'une Fiche Technique Article
        //Redirection
        header('Location: duplication_fiche.php?'
                . 'id_fta=' . $id_fta
                . '&synthese_action=modification&abreviation_etat_destination=' . $abreviationFtaEtat
                . '&new_designation_commerciale_fta=' . $designationCommercialeFta
                . '&site_de_production=' . $siteDeProduction
                . '&id_fta_role=' . $idFtaRole
                . '&id_fta_workflow=' . $idFtaWorkflow);

        break;


    /*     * **********
      Fin de switch
     * ********** */
}
?>

