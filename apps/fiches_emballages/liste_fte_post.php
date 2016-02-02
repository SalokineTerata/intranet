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
$action = lib::getParameterFromRequest('action');
$id_annexe_emballage = lib::getParameterFromRequest('id_annexe_emballage');
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

        //Cette FTE est-elle encore utilisée par d'autres FTA ?
        $req = "SELECT id_fta_conditionnement FROM fta_conditionnement "
                . "WHERE id_annexe_emballage=" . $id_annexe_emballage . " "
        ;
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
        if ($array) {

            //Averissement
            $titre = UserInterfaceMessage::FR_WARNING_EMBALLAGE_SUPPRESION_TITLE;
            $message = UserInterfaceMessage::FR_WARNING_EMBALLAGE_SUPPRESION;
            afficher_message($titre, $message, $redirection);
        } else {

            //Suppression de la FTE
            if (Acl::getValueAccesRights($module . "_modification") == 1) {
                AnnexeEmballageModel::deleteAnnexeEmballage($id_annexe_emballage);
            }

            //Redirection
            header("Location: liste_fte.php?selection_groupe=$selection_groupe&selection_fournisseur=$selection_fournisseur");
        }
        break;


    /*     * **********
      Fin de switch
     * ********** */
}
//include ("./action_bs.php");
//include ("./action_sm.php");
?>

