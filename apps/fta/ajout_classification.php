<?php

/*
 * Copyright (C) 2016 tp4300001
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
print_page_begin($disable_full_page, $menu_file);
flush();


/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER['PHP_SELF'], '/'), '1', '-4');
$page_action = $page_default . '_post.php';
$page_pdf = $page_default . '_pdf.php';
$action = 'valider';                       //Action proposée à la page _post.php
$method = 'method=post';                   //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = 'table '                     //Permet d'harmoniser les tableaux
        . 'border=0 '
        . 'width=100% '
        . 'class=titre '
;
/**
 * Initilisation
 */
$globalConfig = new GlobalConfig();
$idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
$numeroDePageCourante = Lib::getParameterFromRequest('numeroPage', '1');
$arrayIdFtaRoleAcces = FtaRoleModel::getArrayIdFtaRoleByIdUser($idUser);
$idFtaRole = $arrayIdFtaRoleAcces["0"][FtaRoleModel::KEYNAME];

if (!FtaRoleModel::isGestionnaire($idFtaRole)) {
    $titre = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS_TITLE;
    $message = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS;
    $redirection = "index.php";
    afficher_message($titre, $message, $redirection, TRUE);
}

$bloc .= "<" . $html_table . "><tr class=titre>"
        . "<td>Espace de travail</td>"
        . "<td width=10% >Dossier FTA</td>"
        . "<td>Code Article</td>"
        . "<td>Désignation Commerciale</td>"
        . "<td>Classification actuelle</td>"
        . "<td>Ajouter une classification</td>"
        . "</tr>";
/**
 * On récupère le tableau complet des dossier Fta n'ayant pas de classification
 */
$arrayDossierComplet = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT DISTINCT " . FtaModel::FIELDNAME_DOSSIER_FTA
                . " FROM " . FtaModel::TABLENAME . " , " . FtaActionSiteModel::TABLENAME
                . " , " . FtaWorkflowModel::TABLENAME . " , " . IntranetDroitsAccesModel::TABLENAME
                . " , " . IntranetActionsModel::TABLENAME . " , " . ClassificationFta2Model::TABLENAME
                . " WHERE " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                . " = " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2 . " IS NULL "
                . " AND " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS
                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                . " AND " . FtaActionSiteModel::TABLENAME . "." . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                . " IN (" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME . ")"
                . ' AND ( 0 ' . IntranetActionsModel::addIdIntranetAction($_SESSION[Acl::ACL_INTRANET_ACTIONS_VALIDE]) . ")"
                . " AND " . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=" . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $idUser
                . " GROUP BY " . FtaModel::FIELDNAME_DOSSIER_FTA
);
$nbDeResulta = count($arrayDossierComplet);

$nbMaxParPage = "200";
/**
 *  Calcul des enregistrements à afficher
 */
$debut = ($numeroDePageCourante - '1') * $nbMaxParPage;
$pagination = AccueilFta::paginerClassification($nbMaxParPage, $numeroDePageCourante, '4', '4', '1', '1', $nbDeResulta);

/**
 * On récupère le tableau limité des dossier Fta n'ayant pas de classification
 */
$arrayDossier = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT DISTINCT " . FtaModel::FIELDNAME_DOSSIER_FTA
                . " FROM " . FtaModel::TABLENAME . " , " . FtaActionSiteModel::TABLENAME
                . " , " . FtaWorkflowModel::TABLENAME . " , " . IntranetDroitsAccesModel::TABLENAME
                . " , " . IntranetActionsModel::TABLENAME . " , " . ClassificationFta2Model::TABLENAME
                . " WHERE " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                . " = " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2 . " IS NULL "
                . " AND " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS
                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                . " AND " . FtaActionSiteModel::TABLENAME . "." . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                . " IN (" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME . ")"
                . ' AND ( 0 ' . IntranetActionsModel::addIdIntranetAction($_SESSION[Acl::ACL_INTRANET_ACTIONS_VALIDE]) . ")"
                . " AND " . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=" . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $idUser
                . " GROUP BY " . FtaModel::FIELDNAME_DOSSIER_FTA
                . " ORDER BY " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                . "," . FtaModel::FIELDNAME_ID_FTA_ETAT
                . "," . FtaModel::FIELDNAME_CODE_ARTICLE_LDC
                . "," . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE
                . " LIMIT " . $nbMaxParPage . " OFFSET " . $debut
);
/**
 * On récupère la dernièer version
 */
foreach ($arrayDossier as $rowsDossier) {
    $idDossierFta = $rowsDossier[FtaModel::FIELDNAME_DOSSIER_FTA];
    $arrayContenu = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                    "SELECT  DISTINCT " . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
                    . "," . FtaModel::FIELDNAME_DOSSIER_FTA
                    . "," . FtaModel::FIELDNAME_CODE_ARTICLE_LDC . "," . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE
                    . " FROM " . FtaModel::TABLENAME
                    . " , " . FtaActionSiteModel::TABLENAME
                    . " , " . FtaWorkflowModel::TABLENAME . " , " . IntranetDroitsAccesModel::TABLENAME
                    . " , " . IntranetActionsModel::TABLENAME . " , " . ClassificationFta2Model::TABLENAME
                    . " WHERE " . FtaModel::FIELDNAME_DOSSIER_FTA . "=" . $idDossierFta
                    . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                    . " = " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                    . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2 . " IS NULL "
                    . " AND " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                    . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS
                    . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                    . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                    . " AND " . FtaActionSiteModel::TABLENAME . "." . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                    . " IN (" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME . ")"
                    . ' AND ( 0 ' . IntranetActionsModel::addIdIntranetAction($_SESSION[Acl::ACL_INTRANET_ACTIONS_VALIDE]) . ")"
                    . " AND " . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=" . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                    . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $idUser
                    . " GROUP BY " . FtaModel::FIELDNAME_DOSSIER_FTA
    );

    if ($arrayContenu) {
        foreach ($arrayContenu as $rowsContenu) {
            $descriptionFtaWorkflow = $rowsContenu[FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW];
            $idDossier = $rowsContenu[FtaModel::FIELDNAME_DOSSIER_FTA];
            $codeArticleLdc = $rowsContenu[FtaModel::FIELDNAME_CODE_ARTICLE_LDC];
            $designationCommercialeFta = $rowsContenu[FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE];


            /**
             * Mise en forme du tableau
             */
            $bloc.= "<tr  class=contenu ><td>" . $descriptionFtaWorkflow . "</td>"
                    . "<td>" . $idDossier . "</td>"
                    . "<td>" . $codeArticleLdc . "</td>"
                    . "<td>" . $designationCommercialeFta . "</td>"
                    . "<td>" . $classificationGroupe
                    . "</td>"
                    . "<td>  <a href="
                    . "ajout_classification_chemin.php?id_fta=" . $idDossier
                    . "&id_fta_chapitre_encours=1"
                    . "&synthese_action=encours"
                    . "&id_fta_etat=1"
                    . "&abreviation_fta_etat=I"
                    . "&id_fta_role=1" . $idFtaRole
                    . "&gestionnaire=2 > Ajouter une classification</td></tr>"

            ;
        }
    }
}




echo "
             <form name=recherche_groupe method=" . $method . " action=" . $page_action . ">
             <input type=hidden name=action value=" . $action . ">

             <" . $html_table . ">
             <tr class=titre_principal><td>

                 Classification par code article LDC

             </td></tr>
             <tr><td>

                 Ce module permet de centraliser et d'harmoniser la classification des différents éléments suivants:<br>
                 <br>
               </td></tr>
             <tr><td>
            " . $bloc . "

             </td></tr>
                
        </table>

        </form>
        " . $pagination;


/* * *********************
  Inclusion de fin de page
 * ********************* */
include ("../lib/fin_page.inc");
