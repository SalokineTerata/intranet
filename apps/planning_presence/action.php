<?php

//Inclusions
//include ("../lib/session.php");
//include ("../lib/functions.php");
//include ("./functions.php");
require_once '../inc/main.php';
$planning_presence_modification = Lib::isDefined('planning_presence_modification');
$id_salaries = Lib::isDefined('id_salaries');

$id_groupe = Lib::getParameterFromRequest('id_groupe');
$semaine_en_cours = Lib::getParameterFromRequest('semaine_en_cours');
$annee_en_cours = Lib::getParameterFromRequest('annee_en_cours');
$action = Lib::getParameterFromRequest('action');
$radio_type_jour = Lib::isDefined('radio_type_jour');
$liste_id_user = Lib::getParameterFromRequest('liste_id_user');
$id_jour = Lib::getParameterFromRequest('id_jour');
$lieu = Lib::getParameterFromRequest('lieu');
$lieu1 = Lib::getParameterFromRequest('lieu1');
$lieu2 = Lib::getParameterFromRequest('lieu2');
$toute_semaine = Lib::getParameterFromRequest('toute_semaine');
$supprimer = Lib::getParameterFromRequest('supprimer');
$etat_semaine_visible = Lib::getParameterFromRequest('etat_semaine_visible');
$recuperer_liste_utilisateur = Lib::getParameterFromRequest('recuperer_liste_utilisateur');
$recuperer_planning_utilisateur = Lib::getParameterFromRequest('recuperer_planning_utilisateur');
$selection_semaine_en_cours = Lib::getParameterFromRequest('selection_semaine_en_cours');
$annee_a_creer = Lib::getParameterFromRequest('annee_a_creer');
$semaine_a_creer = Lib::getParameterFromRequest('semaine_a_creer');
/*
  -----------------
  ACTION A TRAITER
  -----------------
  -----------------------------------
  Détermination de l'action en cours
  -----------------------------------

  Cette page est appelé pour effectuer un traitement particulier
  en fonction de la variable "$action". Ensuite elle redige le
  résultat vers une autre page.

  Le plus souvent, le traitement est délocalisé sous forme de
  fonction situé dans le fichier "functions.php"

 */


//Suppression d'un utilisateur de la semaine en cours
switch ($action) {
    case "suppression":
        $f1 = suppression_utilisateur_semaine($semaine_en_cours, $annee_en_cours, $id_salaries);
        header("Location: index.php?semaine_en_cours=$semaine_en_cours&annee_en_cours=$annee_en_cours");
        break;


//Mise à jour de l'état de la semaine (Consultable ou non)
    case"etat_semaine_visible":
        $f1 = mise_a_jour_etat_semaine_visible($semaine_en_cours, $annee_en_cours, $etat_semaine_visible);
        header("Location: index.php?semaine_en_cours=$semaine_en_cours&annee_en_cours=$annee_en_cours");
        break;


//Mise à jour du planning d'un salarié
    case"validation_modification_lieu_salarie":
        $f1 = mise_a_jour_lieu_salarie($id_salaries, $id_jour, $semaine_en_cours, $annee_en_cours, $radio_type_jour, $lieu, $lieu1, $lieu2, $supprimer, $toute_semaine);
        header("Location: index.php?$f1");
        break;

//Ajout_la liste des salariés_dans la semaine_en_cours
    case'ajout_salarie_semaine_en_cours':
        /*
          Dictionnaire des variables:
          ---------------------------
          $semaine_en_cours:         Numéro de la semaine sur lequel la fonction va travailler (entre 1 et 52)
          $annee_en_cours:           Année sur lequel travail la fonction
          $id_salaries:              Numéro identifiant du salariés (cf table 'salaries' / champ 'id_user')
          $id_jour:                  1=Lundi, 2=Mardi ...etc.
          $radio_type_jour:          0=Journée Complète et 1=Deux demi-journée
          $lieu:                     Lieu pour une journée complète
          $lieu1:                    Lieu pour un matinée
          $lieu2:                    Lieu pour un Après-midi
          $supprimer:                La journée sera initialisé avec tous les lieux à '?' et $radio_type_jour=0
          $toute_semaine:            Effectue le traitement pour l'ensemble de la semaine
         */
        $req1 = "SELECT geo FROM salaries, geo ";
        $req1.= "WHERE salaries.lieu_geo=geo.id_geo";
        $result1 = mysql_query($req1);
        $lieu = mysql_result($result1, 0, geo);
        //Paramétrage de la fonction
        $radio_type_jour = 0; //Toutes la journée
        $lieu1 = $lieu;
        $supprimer = 0; //Oui
        $toute_semaine = 1; //Oui

        if ($liste_id_user) {
            while (list(, $id_salaries) = each($liste_id_user)) {
                //Recherche du lieu géographique de l'utilisateur
                $req1 = "SELECT geo FROM salaries, geo ";
                $req1.= "WHERE salaries.lieu_geo=geo.id_geo ";
                $req1.= "AND id_user=$id_salaries";
                $result1 = mysql_query($req1);
                $lieu = mysql_result($result1, 0, geo);

                //Paramétrage de la fonction
                $radio_type_jour = 0; //Toutes la journée
                $supprimer = 1; //Oui
                $toute_semaine = 1; //Oui

                $f1 = mise_a_jour_lieu_salarie($id_salaries, $id_jour, $semaine_en_cours, $annee_en_cours, $radio_type_jour, $lieu, $lieu1, $lieu2, $supprimer, $toute_semaine);
            }
        }
        header("Location: index.php?" . $f1);
        break;

//Création d'un semaine
    case 'creer_semaine':
        $f1 = creer_semaine($semaine_a_creer, $annee_a_creer, $selection_semaine_en_cours, $recuperer_liste_utilisateur, $recuperer_planning_utilisateur, $planning_presence_modification);
        header("Location: index.php?$f1");
        break;


//Suppression d'une semaine
    case'supprimer_semaine':
        $f1 = supprimer_semaine($selection_semaine_en_cours, $planning_presence_modification);
        header("Location: suppression_planning_semaine.php");
        break;
}
?>

