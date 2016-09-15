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
$paramFieldName = Lib::getParameterFromRequest('FieldName');
$string = substr(strrchr($_SERVER["HTTP_REFERER"], '?'), '1');


/**
 * Initialisation
 */
$ftaModel = new FtaModel($paramIdFta);
$idFtaDossier = $ftaModel->getDataField(FtaModel::FIELDNAME_DOSSIER_FTA)->getFieldValue();
if ($idFtaDossier) {

    $idFtaVerrrouillageChamps = FtaVerrouillageChampsModel::getIdFtaVerrouillageChamps($idFtaDossier, $paramFieldName);
    $ftaVerrouillageChampsModel = new FtaVerrouillageChampsModel($idFtaVerrrouillageChamps);
   $ftaVerrouillageChampsModel->changeStateFieldLock();

    //Redirection
    header('Location: modification_fiche.php?' . $string);
} else {
    $titre = UserInterfaceMessage::FR_WARNING_DATA_VERROUILLAGE_TITLE;
    $message = UserInterfaceMessage::FR_WARNING_DATA_VERROUILLAGE;
    Lib::showMessage($titre, $message, $redirection);
}
?>

