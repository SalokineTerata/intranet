<?php

//

/*
 * Copyright (C) 2015 tp4300001
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

/* * *******
  Inclusions
 * ******* */

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
/*
  Récupération des données MySQL
 */
$action = Lib::getParameterFromRequest('action');
$paramIdFta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
$paramIdFtaChapitreEncours = Lib::getParameterFromRequest('id_fta_chapitre_encours');
$paramSyntheseAction = Lib::getParameterFromRequest('synthese_action');
/**
 * One ne le récupère pas pour le cas de des rôle chef de projet et site
 */
//$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);
$idFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$abreviationFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::FIELDNAME_ABREVIATION);
$comeback = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$idFtaWorkflowOLD = Lib::getParameterFromRequest(FtaWorkflowModel::KEYNAME);
$idFtaWorkflowNEW = Lib::getParameterFromRequest(FtaWorkflowModel::TABLENAME . '_' . FtaWorkflowModel::KEYNAME);
/**
 * Initialisation
 */
$globalConfig = new GlobalConfig();
$idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
$nomPrenomConnect = $globalConfig->getAuthenticatedUser()->getPrenomNom();

$ftaWorflowModelOLD = new FtaWorkflowModel($idFtaWorkflowOLD);
$ftaWorflowModelNEW = new FtaWorkflowModel($idFtaWorkflowNEW);
$nomWorkflowOLD = $ftaWorflowModelOLD->getDataField(FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW)->getFieldValue();
$nomWorkflowNEW = $ftaWorflowModelNEW->getDataField(FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW)->getFieldValue();
$commentaire = FtaController::getCommentWorkflowChange($nomWorkflowOLD, $nomWorkflowNEW, $nomPrenomConnect);











switch ($action) {

    /*
      S'il n'y a pas d'actions défini
     */
    case 'valider':
        if ($idFtaWorkflowOLD <> $idFtaWorkflowNEW) {

            $modelFta = new FtaModel($paramIdFta);
            $idDossierFta = $modelFta->getDossierFta();

            /**
             * Liste des IdFta changeant d'espace de travail
             */
            $arrayIdFtaChange = FtaModel::getArrayIdFtaByIdDossierFta($idDossierFta);


            foreach ($arrayIdFtaChange as $rowsIdFtaChange) {
                $idFta = $rowsIdFtaChange [FtaModel::KEYNAME];
                $idFtaEtatChange = $rowsIdFtaChange [FtaModel::FIELDNAME_ID_FTA_ETAT];
                $ftaEtatModel = new FtaEtatModel($idFtaEtatChange);
                $arbreviationFta = $ftaEtatModel->getDataField(FtaEtatModel::FIELDNAME_ABREVIATION)->getFieldValue();
                /**
                 * Changement de l'espace de travail
                 */
                $ftaModel = new FtaModel($idFta);
                $ftaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->setFieldValue($idFtaWorkflowNEW);
                $oldComment = $ftaModel->getDataField(FtaModel::FIELDNAME_COMMENTAIRE_MAJ_FTA)->getFieldValue();
                $ftaModel->getDataField(FtaModel::FIELDNAME_COMMENTAIRE_MAJ_FTA)->setFieldValue($commentaire . $oldComment);
                $ftaModel->saveToDatabase();

                FtaSuiviProjetModel::createNewChapitresFromNewWorkflow($idFta, $idFtaWorkflowNEW, $arbreviationFta, $idUser);
                /**
                 * Suppression des chapitres de l'ancien espace de travail
                 */
                FtaSuiviProjetModel::deleteOldChapitreFromOldWorkflow($idFta, $idFtaWorkflowNEW);
            }
            //Redirection
            header('Location: modification_fiche.php?id_fta=' . $paramIdFta . '&id_fta_chapitre_encours=' . $paramIdFtaChapitreEncours . '&synthese_action=' . $paramSyntheseAction . '&id_fta_etat=' . $idFtaEtat . '&abreviation_fta_etat=' . $abreviationFtaEtat . '&id_fta_role=' . FtaRoleModel::ID_FTA_ROLE_COMMUN);
        } else {
            $titre = UserInterfaceMessage::FR_WARNING_DATA_ESPACE_DE_TRAVAIL_TITLE;
            $message = UserInterfaceMessage::FR_WARNING_DATA_ESPACE_DE_TRAVAIL_CHANGEMENT;
            Lib::showMessage($titre, $message, $redirection);
        }

        break;


    /*     * **********
      Fin de switch
     * ********** */
}
?>

