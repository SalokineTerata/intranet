<?php

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */

//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);
//
//
////Inclusions
//include ("../lib/session.php");
//include ("../lib/functions.php");
////include ("../lib/functions.php");
////include ("../lib/functions.js");
//include ("./functions.php");
////include ("./functions.js");
require_once '../inc/main.php';

$nom_annexe_emballage_groupe = Lib::getParameterFromRequest(AnnexeEmballageGroupeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE);
$id_annexe_emballage_groupe_type = Lib::getParameterFromRequest(AnnexeEmballageGroupeTypeModel::KEYNAME);
$id_annexe_emballage_groupe = Lib::getParameterFromRequest(AnnexeEmballageGroupeModel::KEYNAME);
$action = Lib::getParameterFromRequest("action");
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

    case "ajout":

        $idAnnexeEmballageGroupe = AnnexeEmballageGroupeModel::createNewRecordset(
                        array(AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION => $id_annexe_emballage_groupe_type)
        );

        $annexeEmbalalgeGroupeModel = new AnnexeEmballageGroupeModel($idAnnexeEmballageGroupe);
        $annexeEmbalalgeGroupeModel->getDataField(AnnexeEmballageGroupeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE)->setFieldValue($nom_annexe_emballage_groupe);
        $annexeEmbalalgeGroupeModel->saveToDatabase();
        header("Location: liste_type.php");
        break;

    case "supprimer":

        //Avant de supprimer, vérification qu'il n'y ait plus de FTE utilisant ce groupe
        $req = "SELECT " . AnnexeEmballageModel::KEYNAME . "," . AnnexeEmballageModel::FIELDNAME_REFERENCE_FOURNISSEUR_ANNEXE_EMBALLAGE
                . " FROM " . AnnexeEmballageModel::TABLENAME
                . " WHERE " . AnnexeEmballageModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE . "=" . $id_annexe_emballage_groupe;
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
        if ($array) {
            //Ce groupe est encore utilisé et ne peut donc pas être supprimé.
            //Liste des modèles concernés
            $liste = "";
            foreach ($array as $rows) {
                $liste.= $rows[AnnexeEmballageModel::FIELDNAME_REFERENCE_FOURNISSEUR_ANNEXE_EMBALLAGE] . "<br>";
            }

            //Averissement
            $titre = "Suppression d'un groupe de modèle";
            $message = "Vous ne pouvez pas supprimer ce groupe de modèle d'emballage.<br>"
                    . "En effet, il est encore utilisé dans certaines Fiches Techniques Emballages.<br><br>"
                    . "<b><u><i>Liste des modèles:</b></u></i><br>"
                    . $liste
            ;
            afficher_message($titre, $message, $redirection);
        } else {
            //Supprimer le groupe
            $annexeEmbalalgeGroupeModel = new AnnexeEmballageGroupeModel($id_annexe_emballage_groupe);
            $annexeEmbalalgeGroupeModel->deleteAnnexeEmballageGroupe();
            header("Location: liste_type.php");
        }

        break;

    /*     * **********
      Fin de switch
     * ********** */
}
//include ("./action_bs.php");
//include ("./action_sm.php");
?>

