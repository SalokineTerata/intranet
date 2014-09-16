<?php

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */

//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);
//
////Inclusions
//include ("../lib/session.php");
//include ("../lib/functions.php");
//include ("./functions.php");
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
$action = Lib::getParameterFromRequest("action");
$id_fta = Lib::getParameterFromRequest("id_fta");
$id_fta_categorie = Lib::getParameterFromRequest("id_fta_categorie");
$designation_commerciale_fta = Lib::getParameterFromRequest("designation_commerciale_fta");
$abreviation_fta_etat = Lib::getParameterFromRequest("abreviation_fta_etat");

$_SESSION["id_fta"] = $id_fta;
$_SESSION["id_fta_categorie"] = $id_fta_categorie;
$_SESSION["designation_commerciale_fta"] = $designation_commerciale_fta;
$_SESSION["createur_fta"] = $_SESSION["id_user"];
$_SESSION["abreviation_fta_etat"] = $abreviation_fta_etat;

switch ($action) {

    /*
      S'il n'y a pas d'actions défini
     */
    case 1: //Création d'une FTA Vierge

        $_SESSION["id_access_arti2"] = null;
        $_SESSION["id_fta"] = null;
        
        $req = "SELECT id_fta_etat FROM fta_etat WHERE abreviation_fta_etat='" . $_SESSION["abreviation_fta_etat"] . "' ";
        $result = mysql_query($req);
        $_SESSION["id_fta_etat"] = mysql_result($result, 0, "id_fta_etat");

        //Initialisation de l'enregistrement de la Table FTA
        $_SESSION["id_fta"] = null;
        mysql_table_operation("fta", "insert");
        $test = $_SESSION["id_fta"];

        //Initialisation de l'enregistrement de la Table access_arti2
        $_SESSION["date_creation"] = date("Y-m-d");
        mysql_table_operation("access_arti2", "insert");
        $test = $_SESSION["id_access_arti2"];

        //Actualisation des données FTA
        $_SESSION["id_dossier_fta"] = $_SESSION["id_fta"];
        $_SESSION["id_access_arti2"];           //Connexion entre FTA et ARTI2
        mysql_table_operation("fta", "update");

        //Création de la palette par défaut
        $test = $_SESSION["id_fta"];
        $_SESSION["id_annexe_emballage_groupe"] = 10;
        $_SESSION["id_annexe_emballage_groupe_type"] = 4;
        $_SESSION["quantite_par_couche_fta_conditionnement"] = 1;
        $_SESSION["nombre_couche_fta_conditionnement"] = 1;
        $_SESSION["poids_fta_conditionnement"] = 23000;
        $_SESSION["dimension_uvc_fta_confitionnement"] = 0;
        $_SESSION["longueur_fta_conditionnement"] = 1200;
        $_SESSION["largeur_fta_conditionnement"] = 800;
        $_SESSION["hauteur_fta_conditionnement"] = 150;
        $_SESSION["id_annexe_emballage"] = 126;    //Correspond à la palette EUROPE
        mysql_table_operation("fta_conditionnement", "insert");

        //Initialisation des notifications pour le suivi de projet
//        $id_fta;
//        $notification_fta_suivi_projet = 1;
//
//        //Chapitre Identité
//        $id_fta_chapitre = 1;
//        mysql_table_operation("fta_suivi_projet", "insert");
//
//        //Chapitre Logistique
//        $id_fta_chapitre = 40;
//        mysql_table_operation("fta_suivi_projet", "insert");
        //Cas d'une fiche Présentation
        if ($_SESSION["abreviation_fta_etat"] == "P") {
            //Condition where
            $where = "";

            //Récupération des chapitres concernés par ce cycle de vie
            $req = "SELECT `id_etat_fta_processus_cycle`, `id_init_fta_processus`, `id_next_fta_processus` "
                    . "FROM `fta_processus_cycle` "
                    . "WHERE `id_etat_fta_processus_cycle` = '" . $_SESSION["abreviation_fta_etat"] . "' AND id_next_fta_processus IS NOT NULL"
            ;
            $result = DatabaseOperation::query($req);
            while ($rows = mysql_fetch_array($result)) {
                $where .= " AND fta_processus.id_fta_processus <> " . $rows["id_next_fta_processus"] . " ";
            }

            //Récupération des chapitres à vérrouiller
            $req = "SELECT DISTINCT id_fta_chapitre "
                    . "FROM `fta_processus`, `fta_chapitre` "
                    . "WHERE ( `fta_processus`.`id_fta_processus` = `fta_chapitre`.`id_fta_processus` ) "
                    . "AND ( ( fta_processus.id_fta_processus <>1 $where ) )"
            ;
            $result = DatabaseOperation::query($req);
            while ($rows = mysql_fetch_array($result)) {
                //Le suivi existe-il déjà ?
                $req = "SELECT id_fta_suivi_projet FROM fta_suivi_projet "
                        . "WHERE id_fta='" . $_SESSION["id_fta"] . "' AND id_fta_chapitre='" . $rows["id_fta_chapitre"] . "' "
                ;
                //echo "<br>".$req;
                $result_existe = DatabaseOperation::query($req);
                if (mysql_num_rows($result_existe)) {
                    //Mise à jour de l'existant
                    $id_fta_suivi_projet = mysql_result($result_existe, 0, "id_fta_suivi_projet");
                    $rows["id_fta_chapitre"];
                    $_SESSION["id_fta"];
                    $req = "UPDATE fta_suivi_projet "
                            . "SET signature_validation_suivi_projet='-1' "
                            . "WHERE id_fta_suivi_projet='" . $_SESSION["id_fta_suivi_projet"] . "' "
                    ;
                    //echo "<br>".$req;
                    DatabaseOperation::query($req);
                } else {

                    //Création des suivi
                    $rows["id_fta_chapitre"];
                    $id_fta;
                    $req = "INSERT fta_suivi_projet "
                            . "SET id_fta_chapitre='" . $rows["id_fta_chapitre"] . "', "
                            . "id_fta='" . $_SESSION["id_fta"] . "', "
                            . "signature_validation_suivi_projet='-1' "
                    ;
                    //echo "<br>".$req;
                    DatabaseOperation::query($req);
                }
            }
        }

        //Redirection
        header("Location: modification_fiche.php?id_fta=" . $_SESSION["id_fta"] . "&synthese_action=modification");

        break;

    case 2: //Duplication d'une Fiche Technique Article
        //Redirection
        header("Location: duplication_fiche.php?id_fta=" . $_SESSION["id_fta"] . "&synthese_action=modification&abreviation_etat_destination=" . $_SESSION["abreviation_fta_etat"] . "&new_designation_commerciale_fta=" . $_SESSION["designation_commerciale_fta"] . " ");

        break;


    /*     * **********
      Fin de switch
     * ********** */
}
?>

