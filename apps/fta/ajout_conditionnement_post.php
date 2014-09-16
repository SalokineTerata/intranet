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
switch ($action) {

    /*
      S'il n'y a pas d'actions défini
     */
    case '':
        //Redirection
        header("Location: index.php");

        break;
    case 'etape1': //Un groupe d'emballage a été sélectionné
        //Renvoi sur la page d'ajout avec cette nouvelle information de groupe d'emballage sélectionné
        header("Location: ajout_conditionnement.php?id_fta=$id_fta&type_emballage_groupe=$type_emballage_groupe&id_annexe_emballage_groupe=$id_annexe_emballage_groupe&action=etape2&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action");
        break;

    case 'etape2': //Un emballage précis a été sélectionné
        //Renvoi sur la page d'ajout avec cette nouvelle information de groupe d'emballage sélectionné
        header("Location: ajout_conditionnement.php?id_fta=$id_fta&type_emballage_groupe=$type_emballage_groupe&id_annexe_emballage_groupe=$id_annexe_emballage_groupe&id_annexe_emballage=$id_annexe_emballage&action=etape3&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action");
        break;

    case 'etape3': //Un emballage a été sélectionné
    case 'saisie_manuel':

        //Enregistrement de l'emballage affecter à cette FTA
        $_SESSION["id_fta_conditionnement"] = Lib::getParameterFromRequest("id_fta_conditionnement");
        $_SESSION["id_annexe_emballage"] = Lib::getParameterFromRequest("id_annexe_emballage");                   //Identifiant de l'emballage
        $_SESSION["id_fta"] = Lib::getParameterFromRequest("id_fta");                                 //Identifiant de la fiche technique article
        $_SESSION["nombre_couche_fta_conditionnement"] = Lib::getParameterFromRequest("nombre_couche_fta_conditionnement");      //Une seule couche par UVC
        $_SESSION["hauteur_fta_conditionnement"] = Lib::getParameterFromRequest("hauteur_fta_conditionnement");
        $_SESSION["longueur_fta_conditionnement"] = Lib::getParameterFromRequest("longueur_fta_conditionnement");
        $_SESSION["largeur_fta_conditionnement"] = Lib::getParameterFromRequest("largeur_fta_conditionnement");
        $_SESSION["poids_fta_conditionnement"] = Lib::getParameterFromRequest("poids_fta_conditionnement");               //Poids des emballages qui ont peuvent varier selon les articles (comme des films)
        $_SESSION["quantite_par_couche_fta_conditionnement"] = Lib::getParameterFromRequest("quantite_par_couche_fta_conditionnement");  //Quantité par UVC
        $_SESSION["pcb_fta_conditionnement"] = Lib::getParameterFromRequest("pcb_fta_conditionnement");  //Quantité par UVC
        $_SESSION["dimension_uvc_fta_confitionnement"] = Lib::getParameterFromRequest("dimension_uvc_fta_confitionnement");        //Dimension du conditionnement=Dimension de l'UVC ?
        $_SESSION["id_annexe_emballage_groupe_type"] = Lib::getParameterFromRequest("id_annexe_emballage_groupe_type");
        $_SESSION["id_annexe_emballage_groupe"] = Lib::getParameterFromRequest("id_annexe_emballage_groupe");

        //Si ce conditionnement est utilisé pour définir la dimension de l'UVC,
        /* if($dimension_uvc_fta_confitionnement)
          {

          //on désactive les autres conditionnements de la FTA
          $req = "UPDATE fta_conditionnement "
          . "SET dimension_uvc_fta_confitionnement=0 "
          . "WHERE id_fta=$id_fta "
          ;
          DatabaseOperation::query($req);

          //on actualise la table access_arti2
          $id_fta;
          mysql_table_load("fta");
          mysql_table_load("access_arti2");
          $id_access_arti2; //Clef récupérée

          $req = "UPDATE access_arti2 "
          . "SET NB_UNIT_ELEM=$quantite_par_couche_fta_conditionnement "
          . "WHERE id_access_arti2=$id_access_arti2; "
          ;
          DatabaseOperation::query($req);
          } */

        //Si ce conditionnement est de type Colis, il ne peut y en avoir plus d'un
        /* if($id_annexe_emballage_groupe_type==3 or $id_annexe_emballage_groupe_type==4)
          {
          $req = "DELETE fta_conditionnement FROM fta_conditionnement, annexe_emballage_groupe "
          . "WHERE id_fta=$id_fta AND id_annexe_emballage_groupe_type=$id_annexe_emballage_groupe_type "
          . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
          ;
          DatabaseOperation::query($req);

          } */
        if ($id_fta_conditionnement) {//Cas d'une modification
            $operation = "update";
        } else { //Cas d'une création
            $operation = "insert";
        }
        mysql_table_operation("fta_conditionnement", $operation);

        //Mise à jour des poids de l'UVC
        //calcul_poids_fta($id_fta);
        //Renvoi sur la page d'ajout avec cette nouvelle information de groupe d'emballage sélectionné
        header("Location: modification_fiche.php?id_fta=$id_fta&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=modification");
        break;


    /*     * **********
      Fin de switch
     * ********** */
}
//include ("./action_bs.php");
//include ("./action_sm.php");
?>

