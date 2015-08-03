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
////include ("../lib/functions.php");
////include ("../lib/functions.js");
//include ("./functions.php");
//include ("./functions.js");
require_once '../inc/main.php';

$id_fta = Lib::getParameterFromRequest("id_fta");
$idFtaRole = Lib::getParameterFromRequest("id_fta_role");

$idFtaWorkflow = Lib::getParameterFromRequest("id_fta_workflow");
$abreviation_etat_destination = Lib::getParameterFromRequest("abreviation_etat_destination");
$new_designation_commerciale_fta = Lib::getParameterFromRequest("new_designation_commerciale_fta");
$siteDeProduction = Lib::getParameterFromRequest("site_de_production");
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

if ($action) {

    //Préparation à la duplication
    switch ($action) {

        /*
          S'il n'y a pas d'actions défini
         */
        case 'totale':

            //Duplication totale
            //echo $id_fta;
            //Redirection
            //header ("Location: index.php");

            break;



        /*         * **********
          Fin de switch
         * ********** */
    }

//Traitement de la duplication
    $option["abreviation_etat_destination"] = $abreviation_etat_destination;
    $option["designation_commerciale_fta"] = $new_designation_commerciale_fta;
    $option["site_de_production"] = $siteDeProduction;
    $action;
    $id_fta_old = $id_fta;
    /**
      echo "
      abreviation_etat_destination=$abreviation_etat_destination <br>
      option[abreviation_etat_destination]=".$option["abreviation_etat_destination"]."<br>
      option[designation_commerciale_fta]=".$option["designation_commerciale_fta"]."<br>
      action=$action <br>
      id_fta_old=$id_fta_old <br>
      ";
      /* */
    $id_fta_new = FtaModel::BuildDuplicationFta($id_fta, $action, $option, $idFtaWorkflow);
    FtaSuiviProjetModel::initFtaSuiviProjet($id_fta_new);


//echo $id_fta_new."<br>";
    //Redirection
    header("Location: duplicate.php?id_fta_original=$id_fta_old&id_fta_new=$id_fta_new&id_fta_role=$idFtaRole");
}
//include ("./action_bs.php");
//include ("./action_sm.php");
?>

