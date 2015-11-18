<?php

//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);
//Inclusions
//include ("../lib/session.php");
//include ("../inc/php.php");
//include ("../lib/functions.php");
//include ("../lib/functions.js");
//include ("./functions.php");
//include ("./functions.js");
require_once '../inc/main.php';

$globalConfig = new GlobalConfig();
UserModel::ConnexionFalse($globalConfig);

if ($globalConfig->getAuthenticatedUser()) {
    $id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();
}
$fta_modification = AclClass::getValueAccesRights('fta_modification');

$recherche = Lib::getParameterFromRequest("recherche");
$type_recherche = Lib::getParameterFromRequest("type_recherche");

$search_table = Lib::isDefined("search_table");
$search_id = Lib::isDefined("search_id");
$search_req = Lib::isDefined("search_req");
$operateur_recherche = Lib::isDefined("operateur_recherche");
$champ_recherche = Lib::isDefined("champ_recherche");
$idFtaRoleEncoursDefault = FtaRoleModel::getKeyNameOfFirstRoleByIdUser($id_user);
if ($fta_modification) {
    
} else {
    $synthese_action = FtaEtatModel::ETAT_AVANCEMENT_VALUE_ALL;
    $idFtaRoleEncoursDefault = '0';
}
$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME, $idFtaRoleEncoursDefault);


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

//echo $type_recherche;
//http://intranet.dev.agis.fr/fta/recherche.php?url_page_depart=(/fta/recherche.php)&requete_resultat=SELECT+DISTINCT+fta.id_fta+FROM+fta+WHERE+fta.id_article_agrologic%3D%27666%27&nb_limite_resultat=1000&champ_recherche=4||1||&operateur_recherche=1||4||&texte_recherche=666||666||&nbcol=1&nbligne=2&nb_col_courant=0&nb_ligne_courant=1&ajout_col=0
if (is_numeric($recherche)) {
    switch ($type_recherche) {
        case "regate":
            //Recherche du code Regate
            $search_table = "fta";
            $search_id = "fta.id_fta";
            $search_req = "fta.code_article_ldc%3D%27" . $recherche . "%27+";
            //SELECT+DISTINCT+fta.id_fta+FROM+access_arti2%2Cfta+WHERE+access_arti2.code_article_ldc%3D%2742099%27+AND+access_arti2.id_access_arti2%3Dfta.id_access_arti2%0D%0A+AND++1&nb_limite_resultat=1000&champ_recherche=6&operateur_recherche=4&texte_recherche=42099&nbcol=1&nbligne=1&nb_col_courant=0&nb_ligne_courant=0&ajout_col=0
            $champ_recherche = 6;
            break;
        case "agrologic":
            //Recherche du code Agrologic
            $search_table = "fta";
            $search_id = "$search_table.id_fta";
            $search_req = "fta.id_article_agrologic%3D%27" . $recherche . "%27+";
            $champ_recherche = 1;
            break;
    }
    $operateur_recherche = 4;
} else {
    if ($recherche) {
        //Recherche dans la désignation Commerciale
        $search_table = "fta";
        $search_id = "$search_table.id_fta";
        $search_req = "fta.designation_commerciale_fta++LIKE+%28+%27%25" . $recherche . "%25%27+%29+";
        $operateur_recherche = 1;
        $champ_recherche = 4;
    } else {
        $message = "Veuillez saisir un code article arcadia";
        afficher_message("Erreur", $message, $redirection);
    }
}
header("Location: ./recherche.php?url_page_depart=(/dev-intranet/apps/fta/recherche.php)&requete_resultat=SELECT+DISTINCT+$search_id+FROM+$search_table+WHERE+$search_req&nb_limite_resultat=1000&champ_recherche=$champ_recherche&operateur_recherche=$operateur_recherche&texte_recherche=$recherche&nbcol=1&nbligne=1&nb_col_courant=0&nb_ligne_courant=1&ajout_col=0&id_fta_role=$idFtaRole");


/* * **********
  Fin de switch
 * ********** */

//include ("./action_bs.php");
//include ("./action_sm.php");
?>

