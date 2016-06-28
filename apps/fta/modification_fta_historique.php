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
$versionFta = "V" . $ftaModel->getVersionDossierFta();
$ftaView = new FtaView($ftaModel);
$ftaView->setIsEditable(Chapitre::NOT_EDITABLE);
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

foreach ($arrayHistoValidationFta as $rowsHistoValidationFta) {
    $ftaEtatModel = new FtaEtatModel($rowsHistoValidationFta[FtaEtatHistoriqueModel::FIELDNAME_ID_FTA_ETAT_DEST]);
    $nomFtaEtat = $ftaEtatModel->getDataField(FtaEtatModel::FIELDNAME_NOM_FTA_ETAT)->getFieldValue();
    $versionEncours =  "V" .$rowsHistoValidationFta[FtaEtatHistoriqueModel::FIELDNAME_ID_DOSSIER_VERSION_FTA];
    $nomSignataire =  $rowsUserName[UserModel::FIELDNAME_PRENOM] . " " . $rowsUserName[UserModel::FIELDNAME_NOM];
    $dateValidation =  $rowsUserName[FtaEtatHistoriqueModel::FIELDNAME_STATE_CHANGE_DATE] ;
     $arrayHistoModif[] = array("date"=> $dateValidation
                        ,"nom"=> $nomSignataire 
                        ,"version"=> $versionEncours 
                        ,"etat"=> $nomFtaEtat 
                        ,"oldValue"=> $oldValue
        ,"newValue"=> $newValue 
                        );
}

/**
 * Listes des tables Fta à vérifier
 */
$arrayTableCheck = array(FtaModel::TABLENAME, FtaComposantModel::TABLENAME, FtaConditionnementModel::TABLENAME);

foreach ($arrayTableCheck as $rowsTableCheck) {
    /**
     * Listes des noms des champs avec le label de la table encours
     */
    if ($rowsTableCheck == FtaModel::TABLENAME) {
        $model = new FtaModel($id_fta);
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
                $versionFta;
                $label = $rowsChamps[IntranetColumnInfoModel::FIELDNAME_LABEL_INTRANET_COLUMN_INFO];
                $idFtaChapitreTmp = $rowsChamps[IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE];
                $idFtaChapitreArray = explode(',', $idFtaChapitreTmp);
                $idFtaChapitre = FtaWorkflowStructureModel::getIdFtaChapitreBetweenArrayByWorkflowAndArrayByColumn($idFtaWorkflow, $idFtaChapitreArray);
                $nomSignataire = FtaSuiviProjetModel::getUserNameByIdFtaChapitreAndIdFta($id_fta, $idFtaChapitre);
                $dateValidation = FtaSuiviProjetModel::getValidationDateByIdFtaChapitreAndIdFta($id_fta, $idFtaChapitre);
                $arrayHistoModif[] = array("date" => $dateValidation
                    , "nom" => $nomSignataire
                    , "version" => $versionFta
                    , "etat" => $label
                    , "oldValue" => $oldValue
                    , "newValue" => $newValue
                );
            }
        }
    } elseif ($rowsTableCheck == FtaComposantModel::TABLENAME) {
        /**
         * On récupère la liste des composants
         */
        $arraIdFtaComposant = FtaComposantModel::getArrayIdFtaComposantTable($id_fta);
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
                        $versionFta;
                        $label = $rowsChamps[IntranetColumnInfoModel::FIELDNAME_LABEL_INTRANET_COLUMN_INFO];
                        $idFtaChapitreTmp = $rowsChamps[IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE];
                        $idFtaChapitreArray = explode(',', $idFtaChapitreTmp);
                        $idFtaChapitre = FtaWorkflowStructureModel::getIdFtaChapitreBetweenArrayByWorkflowAndArrayByColumn($idFtaWorkflow, $idFtaChapitreArray);
                        $nomSignataire = FtaSuiviProjetModel::getUserNameByIdFtaChapitreAndIdFta($id_fta, $idFtaChapitre);
                        $dateValidation = FtaSuiviProjetModel::getValidationDateByIdFtaChapitreAndIdFta($id_fta, $idFtaChapitre);
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
    } elseif ($rowsTableCheck == FtaConditionnementModel::TABLENAME) {
        $arraIdFtaConditionnment = FtaConditionnementModel::getArrayIdFtaConditionnement($id_fta);
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
                        $versionFta;
                        $label = $rowsChamps[IntranetColumnInfoModel::FIELDNAME_LABEL_INTRANET_COLUMN_INFO];
                        $idFtaChapitreTmp = $rowsChamps[IntranetColumnInfoModel::FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE];
                        $idFtaChapitreArray = explode(',', $idFtaChapitreTmp);
                        $idFtaChapitre = FtaWorkflowStructureModel::getIdFtaChapitreBetweenArrayByWorkflowAndArrayByColumn($idFtaWorkflow, $idFtaChapitreArray);
                        $nomSignataire = FtaSuiviProjetModel::getUserNameByIdFtaChapitreAndIdFta($id_fta, $idFtaChapitre);
                        $dateValidation = FtaSuiviProjetModel::getValidationDateByIdFtaChapitreAndIdFta($id_fta, $idFtaChapitre);

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

FtaController::arraySortByColumn($arrayHistoModif,"date" );

$arrayHistoModif;
//Données lié à arcadia 
$bloc.= $ftaView->getHtmlArcadiaDataNotEditable();
$bloc.=$ftaView->getHtmlArcadiaDataVariableEditable();

//Désignation commerciale
$bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE);

//Poids net de l’UVF
$bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_POIDS_ELEMENTAIRE);

/**
 * Site de production
 */
$bloc.="<td align=center>Site de production</td>" . $ftaView->listeSiteByAcces($idUser, $isEditable);


/**
 * Expédition, EANS, Facturation
 */
//Site d'expedition
$bloc.="<td align=center>Expédition, EANS, Facturation</td>" . $ftaView->getHtmlDataField(FtaModel::FIELDNAME_SITE_EXPEDITION_FTA);

//Unité de Facturation
$bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_UNITE_FACTURATION);

//Gencod EAN Article
$bloc.=$ftaView->getHtmlEANArticle();

//Gencod EAN Colis
$bloc.=$ftaView->getHtmlEANColis();

//Gencod EAN Palette
$bloc.=$ftaView->getHtmlEANPalette();


/**
 * Exigence client
 */
$bloc.="<td align=center>Exigence client</td>";
if ($idFtaWorkflow == FtaWorkflowModel::ID_WORKFLOW_MDD_AVEC or $idFtaWorkflow == FtaWorkflowModel::ID_WORKFLOW_MDD_SANS) {
    //Durée de vie garantie client (en jours)
    $bloc.=$ftaView->getHtmlIsDureeDeVieCalculateWithDureeDeVieClient();
} else {
    //Durée de vie garantie client (en jours)
    $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DUREE_DE_VIE);
}


/**
 * PCB
 */
//Nombre d’UVC par colis
$bloc.="<td align=center>PCB</td>" . $ftaView->getHtmlDataField(FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON);


/**
 * Emballages du Colis
 */
$bloc.="<td align=center>Emballages du Colis</td>" . $ftaView->getHtmlEmballageDuColis($id_fta, $idChapitre, $synthese_action, $idFtaEtat, $abreviationFtaEtat, $idFtaRole);

//Vérification que l'enballage sélectionner soit existant sur Arcadia
$bloc.=$ftaView->checkEmballageColisValide();

//Palette
$bloc.=$ftaView->getHtmlEmballagePalette($id_fta, $idChapitre, $synthese_action, $idFtaEtat, $abreviationFtaEtat, $idFtaRole);

/**
 * Codification
 */
//Désignation Abrégée
$bloc.="<td >Codification</td>" . $ftaView->getHtmlNomAbrege();

//Désignation Interne Agis
//        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE);
$bloc.=$ftaView->getHtmlDesignationInterneAgis();

//Code Article LDC, code Article arcadia
$bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC);

$fta2ArcadiaController = new Fta2ArcadiaController($ftaModel, TRUE);
$ficherXML = $fta2ArcadiaController->showExportXmlFile();

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
                ' . $bloc
        . $ficherXML . '
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