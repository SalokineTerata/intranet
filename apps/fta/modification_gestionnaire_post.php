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
$createurFtaOLD = Lib::getParameterFromRequest('createur_fta');
$createurFtaNEW = Lib::getParameterFromRequest(FtaModel::TABLENAME . '_' . FtaModel::FIELDNAME_CREATEUR);
/**
 * Initialisation
 */
$globalConfig = new GlobalConfig();
$idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
$nomPrenomConnect = $globalConfig->getAuthenticatedUser()->getPrenomNom();

$userModelOLD = new UserModel($createurFtaOLD);
$userModelNEW = new UserModel($createurFtaNEW);
$nomWorkflowOLD = $userModelOLD->getPrenomNom();
$nomWorkflowNEW = $userModelNEW->getPrenomNom();
$commentaire = "\n" . FtaController::getCommentGestionnaireChange($nomWorkflowOLD, $nomWorkflowNEW, $nomPrenomConnect) ;


switch ($action) {

    /*
      S'il n'y a pas d'actions défini
     */
    case 'valider':
        if ($createurFtaOLD <> $createurFtaNEW) {

            $modelFta = new FtaModel($paramIdFta);

            /**
             * Commentaire de modification du gestionnaire de la Fta
             */
            $commentaire_maj_fta = $modelFta->getDataField(FtaModel::FIELDNAME_COMMENTAIRE_MAJ_FTA)->getFieldValue();
            $modelFta->getDataField(FtaModel::FIELDNAME_COMMENTAIRE_MAJ_FTA)->setFieldValue($commentaire . $commentaire_maj_fta);
            $modelFta->getDataField(FtaModel::FIELDNAME_CREATEUR)->setFieldValue($createurFtaNEW);
            $modelFta->saveToDatabase();
            //Redirection
            header('Location: modification_fiche.php?id_fta=' . $paramIdFta . '&id_fta_chapitre_encours=' . $paramIdFtaChapitreEncours . '&synthese_action=' . $paramSyntheseAction . '&id_fta_etat=' . $idFtaEtat . '&abreviation_fta_etat=' . $abreviationFtaEtat . '&id_fta_role=' . FtaRoleModel::ID_FTA_ROLE_COMMUN);
        } else {
            $titre = UserInterfaceMessage::FR_WARNING_DATA_GESTIONNAIRE_TITLE;
            $message = UserInterfaceMessage::FR_WARNING_DATA_GESTIONNAIRE;
            afficher_message($titre, $message, $redirection);
        }

        break;


    /*     * **********
      Fin de switch
     * ********** */
}
?>

