<?php

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */

//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);
//Inclusions
//include ("../lib/session.php");
//include ("../lib/functions.php");
//include ("./functions.php");
//include ("./functions.js");
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
$action = Lib::getParameterFromRequest('action');
$paramIdFta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
$paramIdFtaChapitreEncours = Lib::getParameterFromRequest('id_fta_chapitre_encours');
$paramSyntheseAction = Lib::getParameterFromRequest('synthese_action');
$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);
$idFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$comeback = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$selection_proprietaire1 = Lib::getParameterFromRequest('selection_proprietaire12');
$selection_proprietaire2 = Lib::getParameterFromRequest('selection_proprietaire22');
$selection_marque = Lib::getParameterFromRequest('selection_marque2');
$selection_activite = Lib::getParameterFromRequest('selection_activite2');
$selection_rayon = Lib::getParameterFromRequest('selection_rayon2');
$selection_environnement = Lib::getParameterFromRequest('selection_environnement2');
$selection_reseau = Lib::getParameterFromRequest('selection_reseau2');
$selection_saisonnalite = Lib::getParameterFromRequest('selection_saisonnalite2');

switch ($action) {

    /*
      S'il n'y a pas d'actions défini
     */
    case 'valider':

        $modelFta = new FtaModel($paramIdFta);
        if ($selection_saisonnalite) {
            //Enregistrement du nouvel éléments de classification
            $idClassification2 = ClassificationFta2Model::getIdFtaClassification2(
                            $selection_proprietaire1, $selection_proprietaire2
                            , $selection_marque, $selection_activite
                            , $selection_rayon, $selection_environnement
                            , $selection_reseau, $selection_saisonnalite);
            $modelFta->getDataField(FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2)->setFieldValue($idClassification2);
        }
        $abreviationFtaEtat = $modelFta->getModelFtaEtat()->getDataField(FtaEtatModel::FIELDNAME_ABREVIATION)->getFieldValue();

        $modelFta->saveToDatabase();
        //Redirection
        header('Location: modification_fiche.php?id_fta=' . $paramIdFta . '&id_fta_chapitre_encours=' . $paramIdFtaChapitreEncours . '&synthese_action=' . $paramSyntheseAction . '&id_fta_etat=' . $idFtaEtat . '&abreviation_fta_etat=' . $abreviationFtaEtat . '&id_fta_role=' . $idFtaRole);

        break;



    /*     * **********
      Fin de switch
     * ********** */
}
//include ("./action_bs.php");
//include ("./action_sm.php");
?>

