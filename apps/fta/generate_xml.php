<?php

/*
 * Copyright (C) 2016 franckwastaken
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

require_once '../inc/main.php';
$paramIdFta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
$paramDesactivation = Lib::getParameterFromRequest("desactivation");

switch ($paramDesactivation) {
    case Fta2ArcadiaTransactionModel::OUI:
        Fta2ArcadiaTransactionModel::cancelIdArcadiaTransaction($paramIdFta);
        break;

    default:
        $ftaModel = new FtaModel($paramIdFta);
        $ftaModel->setDataFtaTableToCompare();
        $fta2ArcadiaContoller = new Fta2ArcadiaController($ftaModel, Fta2ArcadiaTransactionModel::XML);
        break;
}

header("Location: modification_fiche.php?id_fta=" . $paramIdFta . "&id_fta_chapitre_encours=33&synthese_action=encours&id_fta_etat=1&abreviation_fta_etat=I&id_fta_role=5");
//// Instance de la class DomDocumen
//$xml = new DOMDocument();
//
//// Definition du prologue :  la version et l'encodage
//$xml->version = "1.0";
//$xml->encoding = "UTF-8";
//https://openclassrooms.com/forum/sujet/creer-un-fichier-xml-puis-demander-de-l-enregistrer-14428