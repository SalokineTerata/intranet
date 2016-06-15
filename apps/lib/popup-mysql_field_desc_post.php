<?php

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */

//Inclusions
require_once '../inc/main.php';
$action = Lib::getParameterFromRequest("action");
$idIntranetColumnInfo = Lib::getParameterFromRequest(IntranetColumnInfoModel::KEYNAME);
$explication_intranet_description = Lib::getParameterFromRequest(IntranetColumnInfoModel::FIELDNAME_EXPLICATION_INTRANET_COLUMN_INFO);

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
    case 'record':

        /**
         * Ennregistrement de la nouvelle description du champs
         */
        $request = "UPDATE " . IntranetColumnInfoModel::TABLENAME
                . " SET " . IntranetColumnInfoModel::FIELDNAME_EXPLICATION_INTRANET_COLUMN_INFO . "=\"" . $explication_intranet_description . "\" "
                . " WHERE " . IntranetColumnInfoModel::KEYNAME . "='" . $idIntranetColumnInfo . "' ";
        DatabaseOperation::execute($request);



        //Redirection
        header("Location: popup-mysql_field_desc.php?id_intranet_column_info=" . $idIntranetColumnInfo."&action=");

        break;



    /*     * **********
      Fin de switch
     * ********** */
}
//include ("./action_bs.php");
//include ("./action_sm.php");
?>

