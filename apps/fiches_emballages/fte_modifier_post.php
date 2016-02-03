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
$poids_annexe_emballage = lib::getParameterFromRequest('poids_annexe_emballage');
$actif_annexe_emballage = lib::getParameterFromRequest('actif_annexe_emballage');
$epaisseur_annexe_emballage = lib::getParameterFromRequest('epaisseur_annexe_emballage');
$hauteur_annexe_emballage = lib::getParameterFromRequest('hauteur_annexe_emballage');
$id_annexe_emballage = lib::getParameterFromRequest('id_annexe_emballage');
$largeur_annexe_emballage = lib::getParameterFromRequest('largeur_annexe_emballage');
$liste_fta = lib::getParameterFromRequest('liste_fta');
$longueur_annexe_emballage = lib::getParameterFromRequest('longueur_annexe_emballage');
$nom_annexe_emballage_groupe = lib::getParameterFromRequest('nom_annexe_emballage_groupe');
$nom_fte_fournisseur = lib::getParameterFromRequest('nom_fte_fournisseur');
$nombre_couche_annexe_emballage = lib::getParameterFromRequest('nombre_couche_annexe_emballage');
$quantite_par_couche_annexe_emballage = lib::getParameterFromRequest('quantite_par_couche_annexe_emballage');
$reference_fournisseur_annexe_emballage = lib::getParameterFromRequest('reference_fournisseur_annexe_emballage');
$selection_groupe = lib::getParameterFromRequest('selection_groupe');
$selection_fournisseur = lib::getParameterFromRequest('selection_fournisseur');

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

    case "supprimer":

        //Suppression de la FTE
        if (Acl::getValueAccesRights($module . "_modification") <> 1) {
            AnnexeEmballageModel::deleteAnnexeEmballage($id_annexe_emballage);
        }
        //Redirection
        header("Location: liste_fte.php?selection_groupe=$selection_groupe&selection_fournisseur=$selection_fournisseur");

        break;

    case "insert":
    case "rewrite":

        //echo "id_fte_fournisseur: ".$id_fte_fournisseur;

        if (!$actif_annexe_emballage) {
            $actif_annexe_emballage = 0;
        }


        //Ajout ou réécriture de la FTE
        if (Acl::getValueAccesRights($module . "_modification") == 1 and $id_annexe_emballage) {
            $annexeEmballageModel = new AnnexeEmballageModel($id_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_POIDS_ANNEXE_EMBALLAGE)->setFieldValue($poids_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_ACTIF_ANNEXE_EMBALLAGE)->setFieldValue($actif_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_EPAISSEUR_ANNEXE_EMBALLAGE)->setFieldValue($epaisseur_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_HAUTEUR_ANNEXE_EMBALLAGE)->setFieldValue($hauteur_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_LARGEUR_ANNEXE_EMBALLAGE)->setFieldValue($largeur_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_LONGUEUR_ANNEXE_EMBALLAGE)->setFieldValue($longueur_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_NOMBRE_COUCHE_ANNEXE_EMBALLAGE)->setFieldValue($nombre_couche_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_QUANTITE_PAR_COUCHE_ANNEXE_EMBALLAGE)->setFieldValue($quantite_par_couche_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_REFERENCE_FOURNISSEUR_ANNEXE_EMBALLAGE)->setFieldValue($reference_fournisseur_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_DATE_MAJ_ANNEXE_EMBALLAGE)->setFieldValue(date("Y-m-d"));
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE)->setFieldValue($nom_annexe_emballage_groupe);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_ID_FTE_FOURNISSEUR)->setFieldValue($nom_fte_fournisseur);
            $annexeEmballageModel->saveToDatabase();
        } else {
            $id_annexe_emballage = AnnexeEmballageModel::createNewRecordset(
                            array(FteFournisseurModel::KEYNAME => $nom_fte_fournisseur)
            );
            $annexeEmballageModel = new AnnexeEmballageModel($id_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_POIDS_ANNEXE_EMBALLAGE)->setFieldValue($poids_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_ACTIF_ANNEXE_EMBALLAGE)->setFieldValue($actif_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_EPAISSEUR_ANNEXE_EMBALLAGE)->setFieldValue($epaisseur_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_HAUTEUR_ANNEXE_EMBALLAGE)->setFieldValue($hauteur_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_LARGEUR_ANNEXE_EMBALLAGE)->setFieldValue($largeur_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_LONGUEUR_ANNEXE_EMBALLAGE)->setFieldValue($longueur_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_NOMBRE_COUCHE_ANNEXE_EMBALLAGE)->setFieldValue($nombre_couche_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_QUANTITE_PAR_COUCHE_ANNEXE_EMBALLAGE)->setFieldValue($quantite_par_couche_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_REFERENCE_FOURNISSEUR_ANNEXE_EMBALLAGE)->setFieldValue($reference_fournisseur_annexe_emballage);
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_DATE_MAJ_ANNEXE_EMBALLAGE)->setFieldValue(date("Y-m-d"));
            $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE)->setFieldValue($nom_annexe_emballage_groupe);

            $annexeEmballageModel->saveToDatabase();
        }



        //Redirection
        header("Location: liste_fte.php?selection_groupe=$selection_groupe&selection_fournisseur=$selection_fournisseur");


        break;



    /*     * **********
      Fin de switch
     * ********** */
}
//include ("./action_bs.php");
//include ("./action_sm.php");
?>

