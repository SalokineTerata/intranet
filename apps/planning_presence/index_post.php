<?php

/*
 * Copyright (C) 2016 fa4301632
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

////Inclusions
require_once '../inc/main.php';

$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);
$semaineEnCours = Lib::getParameterFromRequest("semaine_en_cours");
$anneeEnCours = Lib::getParameterFromRequest("annee_en_cours");

$maximum_jours = "5";

/**
 * Vérification si le données nécéssaire ont bien été récupéré
 */
if (!$semaineEnCours) {
    //Averissement
    $titre = "Donnée";
    $message = "La donnée semaine en cours est manquante";
    Lib::showMessage($titre, $message, $redirection);
}

if (!$anneeEnCours) {
    //Averissement
    $titre = "Donnée";
    $message = "La donnée année en cours est manquante";
    Lib::showMessage($titre, $message, $redirection);
}

/**
 * Enregistrement des données
 */
//Affichage des différents groupes
$req1 = "SELECT " . GeoModel::FIELDNAME_GEO . "," . GeoModel::KEYNAME
        . " FROM " . GeoModel::TABLENAME
        . " WHERE " . GeoModel::FIELDNAME_ORDRE_PLANNING_PRESENCE_GEO . "<>0"
        . " AND " . GeoModel::FIELDNAME_SITE_ACTIF . "=1"
        . " ORDER BY " . GeoModel::FIELDNAME_ORDRE_PLANNING_PRESENCE_GEO . " ASC";
$result1 = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req1);
echo "<table class=contenu width=100% border=1>";
if ($result1) {
    foreach ($result1 as $rows1) {
//Affichage des différents services
        $req3 = "SELECT `access_materiel_service`.`K_service`, `access_materiel_service`.`nom_service` "
                . "FROM `access_materiel_service`, `salaries`, `geo`, planning_presence_detail "
                . "WHERE ( `access_materiel_service`.`K_service` = `salaries`.`id_service` "
                . "AND `geo`.`id_geo` = `salaries`.`lieu_geo` ) "
                . "AND ( ( `geo`.`id_geo` = " . $rows1["id_geo"] . " ) ) "
                . "AND salaries.id_user=planning_presence_detail.id_salaries "
                . "AND id_planning_presence_semaine_visible='" . $semaineEnCours . "' "
                . "AND annee_planning_presence_semaine_visible='" . $anneeEnCours . "' "
                . "GROUP BY `access_materiel_service`.`K_service`, `access_materiel_service`.`nom_service`"
        ;
        $result3 = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req3);
        if ($result3) {
            foreach ($result3 as $rows3) {
                /**
                 * Récuparation des utilisateurs
                 */
                $result4 = tableau_planning_selectionne($semaineEnCours, $anneeEnCours, $rows3["K_service"], $rows1["id_geo"]);
                if ($result4) {
                    foreach ($result4 as $rows4) {
                        //Balayages des jours de la semaine
                        for ($i = 1; $i <= $maximum_jours; $i++) {
                            //Détermination des lieux par journée
                            $name = "Id_user" . $rows4[PlanningPresenceDetailModel::FIELDNAME_ID_USER] . "_IdAnnee" . $anneeEnCours
                                    . "_IdSemaine" . $semaineEnCours . "_IdJours" . $i;
                            $lieu = Lib::getParameterFromRequest($name);

                            $lieuBDD = PlanningPresenceDetailModel::getLieuPlanningPresenceDetail($rows4[PlanningPresenceDetailModel::FIELDNAME_ID_USER], $semaineEnCours, $anneeEnCours, $i);
                            /**
                             * Si la donnée saisi est différente de celle enregistrer en BDD
                             * on effectue la MAJ
                             */
                            if ($lieuBDD <> $lieu) {
                                /**
                                 * Mise à jour du lieu 
                                 */
                                $majResult = PlanningPresenceDetailModel::updateLieuPlanningPresenceDetail($rows4[PlanningPresenceDetailModel::FIELDNAME_ID_USER], $semaineEnCours, $anneeEnCours, $i, $lieu);
                            }
                        }
                    }
                }
            }
        }
    }
}

//Redirection
header("Location: index.php");
