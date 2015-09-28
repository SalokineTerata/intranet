<?php

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */
//
//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);
//Inclusions
//include ("../lib/session.php");
//include ("../lib/functions.php");
////include ("../lib/functions.php");
////include ("../lib/functions.js");
//include ("./functions.php");
//include ("./functions.js");
require_once '../inc/main.php';
$action = lib::getParameterFromRequest('action');
$id_fta_classification2 = Lib::getParameterFromRequest('id_fta_classification2');
$idProprietaireGroupe = Lib::getParameterFromRequest(ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE);
$idProprietaireEnseigne = Lib::getParameterFromRequest(ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE);
$idMarque = Lib::getParameterFromRequest(ClassificationFta2Model::FIELDNAME_ID_MARQUE);
$idActivite = Lib::getParameterFromRequest(ClassificationFta2Model::FIELDNAME_ID_ACTIVITE);
$idRayon = Lib::getParameterFromRequest(ClassificationFta2Model::FIELDNAME_ID_RAYON);
$idEnvironnement = Lib::getParameterFromRequest(ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT);
$idReseau = Lib::getParameterFromRequest(ClassificationFta2Model::FIELDNAME_ID_RESEAU);
$idSaisonalite = Lib::getParameterFromRequest(ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE);


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
switch ($action) {

    /*
      S'il n'y a pas d'actions défini
     */
    case '':

        //Redirection
        header("Location: index.php");

        break;

    case 'ajout':
        //Enregistrement du nouvel éléments de classification
        $idClassification2 = ClassificationFta2Model::InsertClassification();
        $ClassificationFta2Model = new ClassificationFta2Model($idClassification2);
        $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE)->setFieldValue($idProprietaireGroupe);
        $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE)->setFieldValue($idProprietaireEnseigne);
        $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_MARQUE)->setFieldValue($idMarque);
        $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_ACTIVITE)->setFieldValue($idActivite);
        $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_RAYON)->setFieldValue($idRayon);
        $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT)->setFieldValue($idEnvironnement);
        $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_RESEAU)->setFieldValue($idReseau);
        $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE)->setFieldValue($idSaisonalite);

        $ClassificationFta2Model->saveToDatabase();

        //Redirection
        header("Location: index.php");

        break;

    case 'modifier':
        if ($id_fta_classification2) {

            $ClassificationFta2Model = new ClassificationFta2Model($id_fta_classification2);
            $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE)->setFieldValue($idProprietaireGroupe);
            $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE)->setFieldValue($idProprietaireEnseigne);
            $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_MARQUE)->setFieldValue($idMarque);
            $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_ACTIVITE)->setFieldValue($idActivite);
            $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_RAYON)->setFieldValue($idRayon);
            $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT)->setFieldValue($idEnvironnement);
            $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_RESEAU)->setFieldValue($idReseau);
            $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE)->setFieldValue($idSaisonalite);

            $ClassificationFta2Model->saveToDatabase();
        }
        //Redirection
        header("Location: index.php");

        break;

    case 'supprimer':
        if ($id_fta_classification2) {
            ClassificationFta2Model::SuppressionClassification($id_fta_classification2);
        }

        //Redirection
        header("Location: index.php");

        break;
}



/* * **********
  Fin de switch
 * ********** */

//include ("./action_bs.php");
//include ("./action_sm.php");
?>

