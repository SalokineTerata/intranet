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


IntranetActionsModel::getNameSiteByWorkflow($paramIdUser, $paramArrayIdWorkflow);
if (!FtaRoleModel::isGestionnaire($idFtaRole)) {
    $titre = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS_TITLE;
    $message = UserInterfaceMessage::FR_WARNING_ACCES_RIGHTS;
    $redirection = "index.php";
    afficher_message($titre, $message, $redirection, TRUE);
}

$bloc .= "<" . $html_table . "><tr class=titre>"
        . "<td>Espace de travail</td>"
        . "<td width=10% >Etat - N°version</td>"
        . "<td>Code Article</td>"
        . "<td>Désignation Commerciale</td>"
        . "<td>Classification actuelle</td>"
        . "<td>Modifier une classification</td>"
        . "</tr>";

$arrayDossierComplet = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT DISTINCT " . FtaModel::FIELDNAME_DOSSIER_FTA
                . " FROM " . FtaModel::TABLENAME . " , " . FtaActionSiteModel::TABLENAME
                . " , " . FtaWorkflowModel::TABLENAME . " , " . IntranetDroitsAccesModel::TABLENAME
                . " , " . IntranetActionsModel::TABLENAME . " , " . ClassificationFta2Model::TABLENAME
                . " WHERE " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                . " = " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2
                . "=" . ClassificationFta2Model::TABLENAME . "." . ClassificationFta2Model::KEYNAME
                . " AND " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS
                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                . " AND " . FtaActionSiteModel::TABLENAME . "." . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                . " IN (" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME . ")"
                . ' AND ( 0 ' . IntranetActionsModel::addIdIntranetAction($_SESSION[Acl::ACL_INTRANET_ACTIONS_VALIDE]) . ")"
                . " AND " . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=" . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $idUser                                                  // Nous recuperons l'identifiant de l'utilisateur connecté
);
$nbDeResulta = count($arrayDossierComplet);

$nbMaxParPage = "200";
/**
 *  Calcul des enregistrements à afficher
 */
$debut = ($numeroDePageCourante - '1') * $nbMaxParPage;
$pagination = AccueilFta::paginerClassification($nbMaxParPage, $numeroDePageCourante, '4', '4', '1', '1', $nbDeResulta);

$arrayDossier = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT DISTINCT " . FtaModel::FIELDNAME_DOSSIER_FTA
                . " FROM " . FtaModel::TABLENAME . " , " . FtaActionSiteModel::TABLENAME
                . " , " . FtaWorkflowModel::TABLENAME . " , " . IntranetDroitsAccesModel::TABLENAME
                . " , " . IntranetActionsModel::TABLENAME . " , " . ClassificationFta2Model::TABLENAME
                . " WHERE " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                . " = " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2
                . "=" . ClassificationFta2Model::TABLENAME . "." . ClassificationFta2Model::KEYNAME
                . " AND " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS
                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                . " AND " . FtaActionSiteModel::TABLENAME . "." . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                . " IN (" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME . ")"
                . ' AND ( 0 ' . IntranetActionsModel::addIdIntranetAction($_SESSION[Acl::ACL_INTRANET_ACTIONS_VALIDE]) . ")"
                . " AND " . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=" . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE
                . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $idUser                                                  // Nous recuperons l'identifiant de l'utilisateur connecté
                . " ORDER BY " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                . "," . ClassificationFta2Model::TABLENAME . "." . ClassificationFta2Model::KEYNAME
                . "," . FtaModel::FIELDNAME_ID_FTA_ETAT
                . "," . FtaModel::FIELDNAME_CODE_ARTICLE_LDC
                . "," . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE
                . " LIMIT " . $nbMaxParPage . " OFFSET " . $debut
);
foreach ($arrayDossier as $rowsDossier) {
    $idDossierFta = $rowsDossier[FtaModel::FIELDNAME_DOSSIER_FTA];
    $arrayVersionDossier = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                    "SELECT  MAX( " . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA . " ) as " . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA
                    . " FROM " . FtaModel::TABLENAME . " WHERE id_dossier_fta=" . $idDossierFta
    );
    foreach ($arrayVersionDossier as $rowsVersionDossier) {
        $idVersionDossierFta = $rowsVersionDossier[FtaModel::FIELDNAME_VERSION_DOSSIER_FTA];
    }

    $arrayContenu = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                    " SELECT DISTINCT " . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW . "," . FtaEtatModel::FIELDNAME_NOM_FTA_ETAT
                    . "," . FtaModel::FIELDNAME_DOSSIER_FTA . "," . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA
                    . "," . FtaModel::FIELDNAME_CODE_ARTICLE_LDC . "," . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE
                    . "," . ClassificationFta2Model::TABLENAME . "." . ClassificationFta2Model::KEYNAME
                    . "," . FtaModel::KEYNAME . "," . FtaEtatModel::TABLENAME . "." . FtaEtatModel::KEYNAME
                    . "," . FtaEtatModel::FIELDNAME_ABREVIATION
                    . " FROM " . FtaModel::TABLENAME . "," . ClassificationFta2Model::TABLENAME
                    . "," . FtaWorkflowModel::TABLENAME . "," . FtaEtatModel::TABLENAME
                    . " WHERE " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2
                    . "=" . ClassificationFta2Model::TABLENAME . "." . ClassificationFta2Model::KEYNAME
                    . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT
                    . "=" . FtaEtatModel::TABLENAME . "." . FtaEtatModel::KEYNAME
                    . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                    . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                    . " AND " . FtaModel::FIELDNAME_DOSSIER_FTA . "=" . $idDossierFta
                    . " AND " . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA . "=" . $idVersionDossierFta
    );
    foreach ($arrayContenu as $rowsContenu) {
        $descriptionFtaWorkflow = $rowsContenu[FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW];
        $nomFtaEtat = $rowsContenu[FtaEtatModel::FIELDNAME_NOM_FTA_ETAT];
        $idFtaEtat = $rowsContenu[FtaEtatModel::KEYNAME];
        $abrviationFtaEtat = $rowsContenu[FtaEtatModel::FIELDNAME_ABREVIATION];
        $idDossier = $rowsContenu[FtaModel::FIELDNAME_DOSSIER_FTA];
        $idVersionDossier = $rowsContenu[FtaModel::FIELDNAME_VERSION_DOSSIER_FTA];
        $codeArticleLdc = $rowsContenu[FtaModel::FIELDNAME_CODE_ARTICLE_LDC];
        $designationCommercialeFta = $rowsContenu[FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE];
        $idClassificationFta2 = $rowsContenu[ClassificationFta2Model::KEYNAME];
        $idFta = $rowsContenu[FtaModel::KEYNAME];

        $classificationGroupe = ClassificationArborescenceArticleCategorieContenuModel::getElementClassificationFta($idClassificationFta2, ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE);
        $classificationEnseigne = ClassificationArborescenceArticleCategorieContenuModel::getElementClassificationFta($idClassificationFta2, ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE);
        $classificationMarque = ClassificationArborescenceArticleCategorieContenuModel::getElementClassificationFta($idClassificationFta2, ClassificationFta2Model::FIELDNAME_ID_MARQUE);
        $classificationActivite = ClassificationArborescenceArticleCategorieContenuModel::getElementClassificationFta($idClassificationFta2, ClassificationFta2Model::FIELDNAME_ID_ACTIVITE);
        $classificationRayon = ClassificationArborescenceArticleCategorieContenuModel::getElementClassificationFta($idClassificationFta2, ClassificationFta2Model::FIELDNAME_ID_RAYON);
        $classificationEnvironnement = ClassificationArborescenceArticleCategorieContenuModel::getElementClassificationFta($idClassificationFta2, ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT);
        $classificationReseau = ClassificationArborescenceArticleCategorieContenuModel::getElementClassificationFta($idClassificationFta2, ClassificationFta2Model::FIELDNAME_ID_RESEAU);
        $classificationSaisonalite = ClassificationArborescenceArticleCategorieContenuModel::getElementClassificationFta($idClassificationFta2, ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE);


        $bloc.= "<tr  class=contenu ><td>" . $descriptionFtaWorkflow . "</td>"
                . "<td>" . $nomFtaEtat . " - V" . $idVersionDossier . "</td>"
                . "<td>" . $codeArticleLdc . "</td>"
                . "<td>" . $designationCommercialeFta . "</td>"
                . "<td>" . $classificationGroupe
                . "/" . $classificationEnseigne
                . "/" . $classificationMarque
                . "/" . $classificationActivite
                . "/" . $classificationRayon
                . "/" . $classificationEnvironnement
                . "/" . $classificationReseau
                . "/" . $classificationSaisonalite
                . "</td>"
                . "<td>  <a href="
                . "ajout_classification_chemin.php?id_fta=" . $idFta
                . "&id_fta_chapitre_encours=1"
                . "&synthese_action=encours"
                . "&id_fta_etat=" . $idFtaEtat
                . "&abreviation_fta_etat=" . $abrviationFtaEtat
                . "&id_fta_role=" . $idFtaRole
                . "&id_fta_classification2=" . $idClassificationFta2
                . "&gestionnaire=1 > Modifier une classification</td></tr>"

        ;
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
