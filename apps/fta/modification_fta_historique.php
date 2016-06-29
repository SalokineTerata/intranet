<?php

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répertoire courant
 */
//   $module=substr(strrchr(`pwd`, '/'), 1);
//   $module=trim($module);


/*
  Si la page peut être appelée depuis n'importe quel module,
  décommentez la ligne suivante
 */

//   $module='';
//Sélection du mode de visualisation de la page
switch ($output) {

    case 'visualiser':
        //Inclusions
        include ('../lib/session.php');         //Récupération des variables de sessions
        include ('../lib/functions.php');       //On inclus seulement les fonctions sans construire de page
        include ('functions.php');              //Fonctions du module
        echo '
            <link rel=stylesheet type=text/css href=../lib/css/intra01.css />
            <link rel=stylesheet type=text/css href=visualiser.css />
       ';

    //break;
    case 'pdf':
        break;

    default:
        //Inclusions
//        include ('../lib/session.php');         //Récupération des variables de sessions
//        include ('../lib/debut_page.php');      //Construction d'une nouvelle
        require_once '../inc/main.php';
        print_page_begin($disable_full_page, $menu_file);
        flush();


//        if (isset($menu))                       //Si existant, utilisation du menu demandé
//        {                                       //en variable
//           include ('./$menu');
//        }
//        else
//        {
//           include ('./menu_principal.inc');    //Sinon, menu par défaut
//        }
}//Fin de la sélection du mode d'affichage de la page

$id_fta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
$synthese_action = Lib::getParameterFromRequest('synthese_action');
$id_fta_chapitre_encours = Lib::getParameterFromRequest('id_fta_chapitre_encours', '1');
$comeback = Lib::getParameterFromRequest('comeback');
$idFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$abreviationFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::FIELDNAME_ABREVIATION);
$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);

/**
 * Initialisation
 */
$ftaModel = new FtaModel($id_fta);
$dossierFta = $ftaModel->getDossierFta();
$idFtaWorkflow = $ftaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
$globalConfig = new GlobalConfig();
$idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
/**
 * Contrôle du rôle attribué
 */
if ($idFtaRole == FtaRoleModel::ID_FTA_ROLE_COMMUN) {
    if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
        $synthese_action = FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS;
    }
    $arrayIdFtaRoleAcces = FtaRoleModel::getArrayIdFtaRoleByIdUserAndWorkflow($idUser, $idFtaWorkflow);
    $idFtaRole = $arrayIdFtaRoleAcces["0"];
}
$id_fta_chapitre = $id_fta_chapitre_encours;

/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER['PHP_SELF'], '/'), '1', '-4');
$page_action = 'modification_fiche.php';
$page_pdf = $page_default . '_pdf.php';
$action = 'valider';                       //Action proposée à la page _post.php
$method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = 'table '              //Permet d'harmoniser les tableaux
        . 'width=100% '
        . 'class=titre_principal '
;
$detail_id_fta;              //Identifiant de la fiche sur laquelle on souhaite un détail

/*
  Récupération des données MySQL
 */

Navigation::initNavigation($id_fta, $id_fta_chapitre, $synthese_action, $comeback, $idFtaEtat, $abreviationFtaEtat, $idFtaRole, TRUE);
$navigue = Navigation::getHtmlNavigationBar();

/**
 * Historisation des changement d'état initialisé en modification
 */
$arrayHistoValidationFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT DISTINCT " . FtaEtatHistoriqueModel::FIELDNAME_ID_DOSSIER_FTA
                . "," . FtaEtatHistoriqueModel::FIELDNAME_ID_DOSSIER_VERSION_FTA . "," . FtaEtatHistoriqueModel::FIELDNAME_ID_FTA_ETAT_DEST
                . "," . UserModel::FIELDNAME_NOM . "," . UserModel::FIELDNAME_PRENOM
                . "," . FtaEtatHistoriqueModel::FIELDNAME_STATE_CHANGE_DATE
                . " FROM " . FtaEtatHistoriqueModel::TABLENAME . "," . UserModel::TABLENAME
                . " WHERE " . FtaEtatHistoriqueModel::TABLENAME . "." . FtaEtatHistoriqueModel::FIELDNAME_ID_USER
                . "=" . UserModel::TABLENAME . "." . UserModel::KEYNAME
                . " AND " . FtaEtatHistoriqueModel::FIELDNAME_ID_DOSSIER_FTA . "=" . $dossierFta
                . " ORDER BY " . FtaEtatHistoriqueModel::FIELDNAME_STATE_CHANGE_DATE . " DESC "
);

if ($arrayHistoValidationFta) {
    foreach ($arrayHistoValidationFta as $rowsHistoValidationFta) {
        $ftaEtatModel = new FtaEtatModel($rowsHistoValidationFta[FtaEtatHistoriqueModel::FIELDNAME_ID_FTA_ETAT_DEST]);
        $nomFtaEtat = $ftaEtatModel->getDataField(FtaEtatModel::FIELDNAME_NOM_FTA_ETAT)->getFieldValue();
        $versionEncours = "V" . $rowsHistoValidationFta[FtaEtatHistoriqueModel::FIELDNAME_ID_DOSSIER_VERSION_FTA];
        $nomSignataire = $rowsUserName[UserModel::FIELDNAME_PRENOM] . " " . $rowsUserName[UserModel::FIELDNAME_NOM];
        $dateValidation = $rowsUserName[FtaEtatHistoriqueModel::FIELDNAME_STATE_CHANGE_DATE];
        $arrayHistoModif[] = array("date" => $dateValidation
            , "nom" => $nomSignataire
            , "version" => $versionEncours
            , "etat" => $nomFtaEtat
            , "oldValue" => $oldValue
            , "newValue" => $newValue
        );
    }
}
/**
 * Listes des tables Fta à vérifier
 */
$arrayTableCheck = array(FtaModel::TABLENAME, FtaComposantModel::TABLENAME, FtaConditionnementModel::TABLENAME);
/**
 * Historiques des changement de données par les utilisateurs
 */
foreach ($arrayTableCheck as $rowsTableCheck) {

    /**
     * Tableau des Fta selon le dossier encours
     */
    $arrayIdFta = FtaModel::getArrayIdFtaByIdDossierFta($dossierFta);
    foreach ($arrayIdFta as $rowsIdFta) {
        $idFtaEncours = $rowsIdFta[FtaModel::KEYNAME];
        $ftaModelEncours = new FtaModel($idFtaEncours);
        $versionFta = "V" . $ftaModelEncours->getDataField(FtaModel::FIELDNAME_VERSION_DOSSIER_FTA)->getFieldValue();
        /**
         * Listes des noms des champs avec le label de la table encours
         */
        if ($rowsTableCheck == FtaModel::TABLENAME) {
            $model = new FtaModel($idFtaEncours);
            $model->setDataFtaTableToCompare();

            $arrayChamps = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            "SELECT DISTINCT " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
                            . "," . IntranetColumnInfoModel::FIELDNAME_LABEL_INTRANET_COLUMN_INFO
                            . "," . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE
                            . " FROM " . IntranetColumnInfoModel::TABLENAME
                            . " WHERE " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO . "='" . $rowsTableCheck . "'"
                            . " AND " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "=" . IntranetColumnInfoModel::IS_ENABLED_INTRANET_HISTORIQUE_TRUE
            );
            foreach ($arrayChamps as $rowsChamps) {

                $check = $model->getDataField($rowsChamps[IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO])->isFieldDiff();

                if ($check) {
                    $oldValue = $model->getDataToCompare()->getFieldValue($rowsChamps[IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO]);
                    $newValue = $model->getDataField($rowsChamps[IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO])->getFieldValue();
                    $label = $rowsChamps[IntranetColumnInfoModel::FIELDNAME_LABEL_INTRANET_COLUMN_INFO];
                    $idFtaChapitreTmp = $rowsChamps[IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE];
                    $idFtaChapitreArray = explode(',', $idFtaChapitreTmp);
                    $idFtaChapitre = FtaWorkflowStructureModel::getIdFtaChapitreBetweenArrayByWorkflowAndArrayByColumn($idFtaWorkflow, $idFtaChapitreArray);
                    if ($idFtaChapitre) {
                        $nomSignataire = FtaSuiviProjetModel::getUserNameByIdFtaChapitreAndIdFta($idFtaEncours, $idFtaChapitre);
                        $dateValidation = FtaSuiviProjetModel::getValidationDateByIdFtaChapitreAndIdFta($idFtaEncours, $idFtaChapitre);

                        $arrayHistoModif[] = array("date" => $dateValidation
                            , "nom" => $nomSignataire
                            , "version" => $versionFta
                            , "etat" => $label
                            , "oldValue" => $oldValue
                            , "newValue" => $newValue
                        );
                    }
                }
            }
        } elseif ($rowsTableCheck == FtaComposantModel::TABLENAME) {
            /**
             * On récupère la liste des composants
             */
            $arraIdFtaComposant = FtaComposantModel::getArrayIdFtaComposantTable($idFtaEncours);
            if ($arraIdFtaComposant) {
                foreach ($arraIdFtaComposant as $rowsIdFtaComposant) {
                    $idFtaComposant = $rowsIdFtaComposant[FtaComposantModel::KEYNAME];

                    $model = new FtaComposantModel($idFtaComposant);
                    $model->setDataFtaComposantTableToCompare();

                    $arrayChamps = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                    "SELECT DISTINCT " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
                                    . "," . IntranetColumnInfoModel::FIELDNAME_LABEL_INTRANET_COLUMN_INFO
                                    . "," . IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE
                                    . " FROM " . IntranetColumnInfoModel::TABLENAME
                                    . " WHERE " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO . "='" . $rowsTableCheck . "'"
                                    . " AND " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "=" . IntranetColumnInfoModel::IS_ENABLED_INTRANET_HISTORIQUE_TRUE
                    );
                    foreach ($arrayChamps as $rowsChamps) {

                        $check = $model->getDataField($rowsChamps[IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO])->isFieldDiff();

                        if ($check) {                           
                            $oldValue = $model->getDataToCompare()->getFieldValue($rowsChamps[IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO]);
                            $newValue = $model->getDataField($rowsChamps[IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO])->getFieldValue();
                            $label = $rowsChamps[IntranetColumnInfoModel::FIELDNAME_LABEL_INTRANET_COLUMN_INFO];
                            $idFtaChapitreTmp = $rowsChamps[IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE];
                            $idFtaChapitreArray = explode(',', $idFtaChapitreTmp);
                            $idFtaChapitre = FtaWorkflowStructureModel::getIdFtaChapitreBetweenArrayByWorkflowAndArrayByColumn($idFtaWorkflow, $idFtaChapitreArray);
                            if ($idFtaChapitre) {
                                $nomSignataire = FtaSuiviProjetModel::getUserNameByIdFtaChapitreAndIdFta($idFtaEncours, $idFtaChapitre);
                                $dateValidation = FtaSuiviProjetModel::getValidationDateByIdFtaChapitreAndIdFta($idFtaEncours, $idFtaChapitre);

                                $arrayHistoModif[] = array("date" => $dateValidation
                                    , "nom" => $nomSignataire
                                    , "version" => $versionFta
                                    , "etat" => $label
                                    , "oldValue" => $oldValue
                                    , "newValue" => $newValue
                                );
                            }
                        }
                    }
                }
            }
        } elseif ($rowsTableCheck == FtaConditionnementModel::TABLENAME) {
            $arraIdFtaConditionnment = FtaConditionnementModel::getArrayIdFtaConditionnement($idFtaEncours);
            /**
             * On récupère la liste des embalalges
             */
            if ($arraIdFtaConditionnment) {
                foreach ($arraIdFtaConditionnment as $rowsIdFtaConditionnment) {
                    $idFtaConditionnement = $rowsIdFtaConditionnment[FtaConditionnementModel::KEYNAME];

                    $model = new FtaConditionnementModel($idFtaConditionnement);
                    /**
                     * On vérifie si l'un des champs de l'emballage encours est différents de la version précedentes
                     */
                    $model->setDataFtaConditionnementTableToCompare();

                    /**
                     * restraiendre la liste des champs
                     */
                    $arrayChamps = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                    "SELECT DISTINCT " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
                                    . "," . IntranetColumnInfoModel::FIELDNAME_LABEL_INTRANET_COLUMN_INFO
                                    . " FROM " . IntranetColumnInfoModel::TABLENAME
                                    . " WHERE " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO . "='" . $rowsTableCheck . "'"
                                    . " AND " . IntranetColumnInfoModel::FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE . "=" . IntranetColumnInfoModel::IS_ENABLED_INTRANET_HISTORIQUE_TRUE
                    );
                    foreach ($arrayChamps as $rowsChamps) {


                        $check = $model->getDataField($rowsChamps[IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO])->isFieldDiff();

                        if ($check) {
                            $oldValue = $model->getDataToCompare()->getFieldValue($rowsChamps[IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO]);
                            $newValue = $model->getDataField($rowsChamps[IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO])->getFieldValue();
                            $label = $rowsChamps[IntranetColumnInfoModel::FIELDNAME_LABEL_INTRANET_COLUMN_INFO];
                            $idFtaChapitreTmp = $rowsChamps[IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE];
                            $idFtaChapitreArray = explode(',', $idFtaChapitreTmp);
                            $idFtaChapitre = FtaWorkflowStructureModel::getIdFtaChapitreBetweenArrayByWorkflowAndArrayByColumn($idFtaWorkflow, $idFtaChapitreArray);
                            if ($idFtaChapitre) {
                                $nomSignataire = FtaSuiviProjetModel::getUserNameByIdFtaChapitreAndIdFta($idFtaEncours, $idFtaChapitre);
                                $dateValidation = FtaSuiviProjetModel::getValidationDateByIdFtaChapitreAndIdFta($idFtaEncours, $idFtaChapitre);

                                $arrayHistoModif[] = array("date" => $dateValidation
                                    , "nom" => $nomSignataire
                                    , "version" => $versionFta
                                    , "etat" => $label
                                    , "oldValue" => $oldValue
                                    , "newValue" => $newValue
                                );
                            }
                        }
                    }
                }
            }
        }
    }
}
if (is_array($arrayHistoModif)) {
    FtaController::arraySortByColumn($arrayHistoModif, "date");

    $tableauFiche .= '<th>'
            . 'Date'
            . '</th><th>'
            . 'Ultilisateur'
            . '</th><th>'
            . 'Version du dossier FTA'
            . '</th><th>'
            . 'Colonne'
            . '</th><th>'
            . 'Ancienne valeur'
            . '</th><th>'
            . 'Nouvelle valeur'
            . '</th>';

    foreach ($arrayHistoModif as $rowsHistoModif) {

        $tableauFiche .= '<tr class=contenu >'
                . '<td width=8%> ' . $rowsHistoModif["date"] . '</td>'//Date de modif
                . '<td >' . $rowsHistoModif["nom"] . '</td>'//Utilisateur ayant fait la modification
                . '<td >' . $rowsHistoModif["version"] . '</td>'//Version du dossier Fta
                . '<td >' . $rowsHistoModif["etat"] . '</td>'// Etat de la Fta ou nom de la colonne
                . '<td >' . $rowsHistoModif["oldValue"] . '</td>'// Ancienne valeur de la Fta
                . '<td >' . $rowsHistoModif["newValue"] . '</td>'// Nouvelle valeur de la Fta
                . '</tr >';
    }
}
/**
 * Affichage du tableau
 * Rechercher une page similaire
 */
/*
  Sélection du mode d'affichage
 */
switch ($output) {

    /*     * ***********
      Début Code PDF
     * *********** */
    case 'pdf':
        //Constructeur
        $pdf = new XFPDF();

        //Déclaration des variables de formatages
        $police_standard = 'Arial';
        $t1_police = $police_standard;
        $t1_style = 'B';
        $t1_size = '12';

        $t2_police = $police_standard;
        $t2_style = 'B';
        $t2_size = '11';

        $t3_police = $police_standard;
        $t3_style = 'BIU';
        $t3_size = '10';

        $contenu_police = $police_standard;
        $contenu_style = '';
        $contenu_size = '8';

        $chapitre = 0;
        $section = 0;
        include($page_pdf);
        //$pdf->SetProtection(array('print', 'copy'));
        $pdf->Output(); //Read the FPDF.org manual to know the other options

        break;
    /*     * *********
      Fin Code PDF
     * ********* */


    /*
      Création des objets HTML (listes déroulante, cases à cocher ...etc.)
     */




    /*     * ************
      Début Code HTML
     * ************ */
    default:

        echo $navigue . '
             <form name=navigation method=' . $method . ' action=' . $page_action . '>
             <input type=hidden name=action value=' . $action . '>

             <' . $html_table . '>
            <tr>
                ' . $tableauFiche . '
            </tr>
             </table>
             </form>
             ';



        /*         * *********************
          Inclusion de fin de page
         * ********************* */
        include ('../lib/fin_page.inc');

    /*     * **********
      Fin Code HTML
     * ********** */
}//Fin du switch de sélection du mode d'affichage
?>