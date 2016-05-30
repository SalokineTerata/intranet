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
print_page_begin($disable_full_page, $menu_file);
flush();
/*
  Initialisation des variables
 */
$page_action = "modification_fta_primaire_post.php";
$action = 'valider';                       //Action proposée à la page _post.php
$method = 'POST';
$html_table = "table "                     //Permet d'harmoniser les tableaux
        . "border=1 "
        . "width=100% "
        . "class=contenu ";

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
$modeDeRecherche = Lib::getParameterFromRequest('modeDeRecherche');
$paramIdFta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
$paramIdFtaChapitreEncours = Lib::getParameterFromRequest('id_fta_chapitre_encours');
$paramSyntheseAction = Lib::getParameterFromRequest('synthese_action');
$idFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$abreviationFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::FIELDNAME_ABREVIATION);
$comeback = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$codePrimaire = Lib::getParameterFromRequest(FtaModel::FIELDNAME_DOSSIER_FTA_PRIMAIRE);
/**
 * Initialisation
 */
/*
 * Déclaration des variables locales
 */
$largeur_html_C1 = TableauFicheView::HTML_CELL_WIDTH_C1; // largeur cellule type
$largeur_html_C3 = TableauFicheView::HTML_CELL_WIDTH_C3; // largeur cellule type
$selection_width = TableauFicheView::HTML_CELL_WIDTH_SELECTION;
/**
 * Contrôle
 */
if (!$codePrimaire) {
    $titre = UserInterfaceMessage::FR_WARNING_DATA_DOSSIER_FTA_TITLE;
    $message = UserInterfaceMessage::FR_WARNING_DATA_DOSSIER_FTA_NON_SAISIE;
    Lib::showMessage($titre, $message, $redirection);
}

switch ($modeDeRecherche) {


    case FtaModel::FIELDNAME_DOSSIER_FTA:


        /**
         * On vérifie si le dossier Fta saisi existe
         */
        $arrayDossierFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT DISTINCT " . FtaModel::KEYNAME . "," . FtaModel::FIELDNAME_ID_FTA_ETAT
                        . "," . FtaModel::FIELDNAME_DOSSIER_FTA . "," . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA
                        . "," . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE . "," . FtaModel::FIELDNAME_LIBELLE
                        . "," . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE . "," . FtaModel::FIELDNAME_POIDS_ELEMENTAIRE
                        . "," . FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON . "," . FtaModel::FIELDNAME_CODE_ARTICLE_LDC
                        . " FROM " . FtaModel::TABLENAME
                        . " WHERE " . FtaModel::FIELDNAME_DOSSIER_FTA . "=\"" . $codePrimaire
                        . "\" ORDER BY " . FtaModel::FIELDNAME_ID_FTA_ETAT . "," . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA . " DESC"
        );


        break;

    case FtaModel::FIELDNAME_CODE_ARTICLE_LDC:
        /**
         * On vérifie si le code Article Arcadia existe
         */
        $arrayDossierFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT DISTINCT " . FtaModel::KEYNAME . "," . FtaModel::FIELDNAME_ID_FTA_ETAT
                        . "," . FtaModel::FIELDNAME_DOSSIER_FTA . "," . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA
                        . "," . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE . "," . FtaModel::FIELDNAME_LIBELLE
                        . "," . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE . "," . FtaModel::FIELDNAME_POIDS_ELEMENTAIRE
                        . "," . FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON . "," . FtaModel::FIELDNAME_CODE_ARTICLE_LDC
                        . " FROM " . FtaModel::TABLENAME
                        . " WHERE " . FtaModel::FIELDNAME_CODE_ARTICLE_LDC . "=\"" . $codePrimaire
                        . "\" ORDER BY " . FtaModel::FIELDNAME_ID_FTA_ETAT . "," . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA . " DESC"
        );


        break;

    /*     * **********
      Fin de switch
     * ********** */
}

if ($arrayDossierFta) {


    foreach ($arrayDossierFta as $rowsDossierFta) {
        $idFta = $rowsDossierFta[FtaModel::KEYNAME];
        /**
         * Contrôle
         */
        if ($idFta == $paramIdFta) {
            $message = UserInterfaceMessage::FR_WARNING_ARTICLE_PRIMAIRE;
            $titre = UserInterfaceMessage::FR_WARNING_ARTICLE_PRIMAIRE_TITLE;
            Lib::showMessage($titre, $message);
        }
        $ftaCheckModel = new FtaModel($idFta);
        $dossierPrimaireCheck = $ftaCheckModel->getDossierPrimaire();
        if ($dossierPrimaireCheck) {
            $message = UserInterfaceMessage::FR_WARNING_ARTICLE_SECONDAIRE;
            $titre = UserInterfaceMessage::FR_WARNING_ARTICLE_SECONDAIRE_TITLE;
            Lib::showMessage($titre, $message);
        }
        $designation_commerciale_fta = $rowsDossierFta[FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE];
        $id_dossier_fta = $rowsDossierFta[FtaModel::FIELDNAME_DOSSIER_FTA];
        $id_version_dossier_fta = $rowsDossierFta[FtaModel::FIELDNAME_VERSION_DOSSIER_FTA];
        $code_article_ldc = $rowsDossierFta[FtaModel::FIELDNAME_CODE_ARTICLE_LDC];
        $LIBELLE = $rowsDossierFta[FtaModel::FIELDNAME_LIBELLE];
        $NB_UNIT_ELEM = $rowsDossierFta[FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON];
        $Poids_ELEM = $rowsDossierFta[FtaModel::FIELDNAME_POIDS_ELEMENTAIRE];
        $abreviation_fta_etat = FtaEtatModel::getAbreviationEtatByIdEtat($rowsDossierFta[FtaModel::FIELDNAME_ID_FTA_ETAT]);

        //Désignation commerciale
        $din = TableauFicheView::getStringDINCompacted($designation_commerciale_fta, $LIBELLE, $NB_UNIT_ELEM, $Poids_ELEM);
        //Etat de la Fta
        $nomEtat = FtaEtatModel::getNameEtatByIdEtat($rowsDossierFta[FtaModel::FIELDNAME_ID_FTA_ETAT]);
        if (!$use) {
            $conseille = "(conseillé)";
            $use = "1";
        } else {
            $conseille = "";
        }
        /*
         * Attribution des couleurs de fonds suivant l'état de la FTA
         */
        $bgcolor = TableauFicheView::getHtmlCellBgColor($abreviation_fta_etat);

        $selection = '<input type=\'radio\' name=selection_fta value=\'' . $idFta . '\'  />' . $conseille
                . "<input type=\"hidden\" name=\"id_dossier_fta\" id=\"id_dossier_fta\" value=\"" . $id_dossier_fta . "\" />";

        $tableau_fiches.= "<tr class=contenu>
                              <td $bgcolor_header " . $selection_width . " > $icon_header $selection</td>
                              ";

        $tableau_fiches.="<td align=center $bgcolor $largeur_html_C1>" . $din . " (" . $nomEtat . ") " . "</a></td>"
                . "<td $bgcolor width=3%>" . $id_dossier_fta . "v" . $id_version_dossier_fta . "</td>";

        $tableau_fiches.="<td $bgcolor width=\"1%\"> <b><font size=\"2\" color=\"#0000FF\">" . $code_article_ldc . "</font></b></td>";
        $tableau_fiches.="</tr>";
    }
} else {
    $titre = UserInterfaceMessage::FR_WARNING_DATA_DOSSIER_FTA_TITLE;
    $message = UserInterfaceMessage::FR_WARNING_DATA_DOSSIER_FTA;
    Lib::showMessage($titre, $message, $redirection);
}
$bouton_submit = FtaView::getHtmlButtonSubmit();
$bouton_retour_vers_fta = FtaView::getHtmlButtonReturnFta($paramIdFta, $paramIdFtaChapitreEncours, $paramSyntheseAction, $idFtaEtat, $abreviationFtaEtat, FtaRoleModel::ID_FTA_ROLE_COMMUN);
$titre = "Sélectionner la Fta à  associer";
/* * ************
  Début Code HTML
 * ************ */

echo
$navigue . "
     <form " . $method . " action=" . $page_action . " name=form_action>
     <input type=hidden name=id_fta id=id_fta value=" . $paramIdFta . ">
     <input type=\"hidden\" name=\"synthese_action\" id=\"synthese_action\" value=\"" . $paramSyntheseAction . "\" />
     <input type=\"hidden\" name=\"abreviation_fta_etat\" id=\"abreviation_fta_etat\" value=\"" . $abreviationFtaEtat . "\" />
     <input type=\"hidden\" name=\"id_fta_etat\" id=\"id_fta_etat\" value=\"" . $idFtaEtat . "\" />
     <input type=\"hidden\" name=\"id_fta_role\" id=\"id_fta_role\" value=\"" . FtaRoleModel::ID_FTA_ROLE_COMMUN . "\" />
     <input type=\"hidden\" name=\"comeback\" id=\"comeback\" value=\"" . $comeback . "\" />     
     <input type=\"hidden\" name=\"id_fta_chapitre_encours\" id=\"id_fta_chapitre_encours\" value=\"" . $paramIdFtaChapitreEncours . "\" />
     

     <" . $html_table . ">
         
     <tr class=titre_principal><td colspan=4>

        " . $titre . "

     </td>
         
     </tr>
    

       $tableau_fiches
     </tr>
    <tr>
         
         $bouton_retour_vers_fta
             $bouton_submit
       </tr>
   
     </table>

     </form>
     ";


/* * **********
  Fin Code HTML
 * ********** */

/* * *********************
  Inclusion de fin de page
 * ********************* */
include ("../lib/fin_page.inc");
?>

