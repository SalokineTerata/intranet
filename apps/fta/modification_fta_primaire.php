<?php

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
$page_default = substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
$page_action = $page_default . "_post.php";
$page_pdf = $page_default . "_pdf.php";
$action = 'valider';                       //Action proposée à la page _post.php
$method = 'POST';
$html_table = "table "                     //Permet d'harmoniser les tableaux
        . "border=1 "
        . "width=100% "
        . "class=contenu ";

/*
  Récupération des données MySQL
 */
$idFta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
$id_fta_chapitre_encours = Lib::getParameterFromRequest('id_fta_chapitre_encours');
$syntheseAction = Lib::getParameterFromRequest('synthese_action');
$comeback = Lib::getParameterFromRequest('comeback');
$idFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$abreviationFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::FIELDNAME_ABREVIATION);
$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);
$modeDeRecherche = Lib::getParameterFromRequest("modeDeRecherche");



/**
 * Contrôle
 */
$ftaModel = new FtaModel($idFta);
$arrayIdFtaSeondaire = $ftaModel->getArrayIdFtaSecondaireByDossierPrimaire(FtaEtatModel::ID_VALUE_MODIFICATION);
$arrayIdFtaSeondaire2 = $ftaModel->getArrayIdFtaSecondaireByDossierPrimaire(FtaEtatModel::ID_VALUE_VALIDE);

/**
 * On vérifie qu'il ne s'agit pas d'une Fta primaire
 */
if ($arrayIdFtaSeondaire or $arrayIdFtaSeondaire2) {
    $message = UserInterfaceMessage::FR_WARNING_ARTICLE_PRIMAIRE_CHECK;
    $titre = UserInterfaceMessage::FR_WARNING_ARTICLE_PRIMAIRE_TITLE;
    Lib::showMessage($titre, $message);
}



switch ($modeDeRecherche) {
    case FtaModel::FIELDNAME_DOSSIER_FTA:
        $label = FtaModel::FIELDNAME_DOSSIER_FTA;
        $titre = UserInterfaceLabel::FR_SAISI_DOSSIER_FTA;
        break;
    case FtaModel::FIELDNAME_CODE_ARTICLE_LDC:
        $titre = UserInterfaceLabel::FR_SAISI_CODE_ARTICLE_ARCADIA;
        $label = FtaModel::FIELDNAME_CODE_ARTICLE_LDC;
        break;

    default:


        //Bouton Radio sélectionnant le mode de recherche de la Fta Primaire
        $page_action = $page_default . ".php";
        $titre = "Sélectionner le mode de recherche de la Fta Primaire";
        $selection = "<td>
<INPUT type= \"radio\" name=\"modeDeRecherche\" value=\"id_dossier_fta\"> DOSSIER FTA
<INPUT type= \"radio\" name=\"modeDeRecherche\" value=\"code_article_ldc\"> CODE ARTICLE ARCADIA
</td>
	
";
        break;
}
if ($modeDeRecherche) {

    $listeGestionnaire = "<tr class=contenu><td>" . DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, $label) . "</td><td><INPUT type=number name=" . FtaModel::FIELDNAME_DOSSIER_FTA_PRIMAIRE . " ></td></tr>";

    $page_action = "modification_fta_primaire_fiche.php";
}


//$listeGestionnaire = $ftaModel->getListeUserGestionnaire($HtmlList, $gestionnaireFta);
//commentaire_maj_fta



$bouton_submit = FtaView::getHtmlButtonSubmit();
$bouton_retour_vers_fta = FtaView::getHtmlButtonReturnFta($idFta, $id_fta_chapitre_encours, $syntheseAction, $idFtaEtat, $abreviationFtaEtat, FtaRoleModel::ID_FTA_ROLE_COMMUN);











/* * *********
  Fin Code PHP
 * ********* */


/* * ************
  Début Code HTML
 * ************ */

echo
$navigue . "
     <form " . $method . " action=" . $page_action . " name=form_action>
     <input type=hidden name=action value=" . $action . ">
     <input type=hidden name=id_fta id=id_fta value=" . $idFta . ">
     <input type=\"hidden\" name=\"synthese_action\" id=\"synthese_action\" value=\"" . $syntheseAction . "\" />
     <input type=\"hidden\" name=\"abreviation_fta_etat\" id=\"abreviation_fta_etat\" value=\"" . $abreviationFtaEtat . "\" />
     <input type=\"hidden\" name=\"id_fta_etat\" id=\"id_fta_etat\" value=\"" . $idFtaEtat . "\" />
     <input type=\"hidden\" name=\"id_fta_role\" id=\"id_fta_role\" value=\"" . $idFtaRole . "\" />
     <input type=\"hidden\" name=\"comeback\" id=\"comeback\" value=\"" . $comeback . "\" />     
     <input type=\"hidden\" name=\"id_fta_chapitre_encours\" id=\"id_fta_chapitre_encours\" value=\"" . $id_fta_chapitre_encours . "\" />
     <input type=\"hidden\" name=\"modeDeRecherche\" id=\"modeDeRecherche\" value=\"" . $modeDeRecherche . "\" />
     <br><br><br><br><br><br><br><br><br><br><br>
     <" . $html_table . ">
         
     <tr class=titre_principal><td>

        " . $titre . "

     </td>
    
     </tr>
    

        $listeGestionnaire

        $selection
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
