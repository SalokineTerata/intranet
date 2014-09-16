<?php

//Redirection vers la page par défaut du module
//header ("Location: indexft.php");

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */

//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);

/*
  Si la page peut être appelée depuis n'importe quel module,
  décommentez la ligne suivante
 */

//   $module='fta';

/* * *******
  Inclusions
 * ******* */
//include ("../lib/session.php");         //Récupération des variables de sessions
//include ("../lib/debut_page.php");      //Affichage des éléments commun à l'Intranet
require_once '../inc/main.php';
print_page_begin();


//if (isset($menu)) {                       //Si existant, utilisation du menu demandé
//    include ("./$menu");
//}               //en variable
//else {
//    include ("./menu_principal.inc");
//}  //Sinon, menu par défaut


/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$action = '';                       //Action proposée à la page action.php
$method = 'method=post';             //Pour une url > 2000 caractères, utiliser POST
$html_table = "table "              //Permet d'harmoniser les tableaux
        . "border=1 "
        . "width=100% "
        . "class=contenu "
;

$url_page_depart = Lib::isDefined("url_page_depart");
$QUERY_STRING = Lib::isDefined("QUERY_STRING");
$PHP_SELF = Lib::isDefined("PHP_SELF");
$nbligne = Lib::isDefined("nbligne");
$nbcol = Lib::isDefined("nbcol");
$champ_recherche = Lib::isDefined("champ_recherche");
$operateur_recherche = Lib::isDefined("operateur_recherche");
$texte_recherche = Lib::isDefined("texte_recherche");
$champ_courant = Lib::isDefined("champ_courant");
$operateur_courant = Lib::isDefined("operateur_courant");
$texte_courant = Lib::isDefined("texte_courant");
$nb_col_courant = Lib::isDefined("nb_col_courant");
$ajout_col = Lib::isDefined("ajout_col");
$requete_resultat = Lib::isDefined("requete_resultat");
$tab_resultat = Lib::isDefined("tab_resultat");

/*
  Récupération des données MySQL
 */


/*
  Création des objets HTML (listes déroulante, cases à cocher ...etc.)
 */


/* * *********
  Fin Code PHP
 * ********* */


/* * ************
  Début Code HTML
 * ************ */

/*
 * *******************************************************************************
  MOTEUR DE RECHERCHE
 * ***************************************************************************** */

$module = "fta";
$module_table = $module;
$etat_table = "fta_etat";
$id_recherche = "id_fta";
$id_recherche_etat = "id_fta_etat";
$abreviation_recherche_etat = "abreviation_fta_etat";
$nom_recherche_recherche_etat = "nom_fta_etat";
$champ_retour = 'fta.id_fta';

$image_bordure = "../lib/images/s7.gif";
$image_recherche = "../lib/images/search.gif";
$nb_limite_resultat = 1000;





$html_search = afficher_moteur_recherche(
                $module,
                $id_recherche,
                $etat_table,
                $id_recherche_etat,
                $abreviation_recherche_etat,
                $nom_recherche_recherche_etat,
                $image_bordure,
                $image_recherche,
                $champ_retour,
                $nb_limite_resultat,
                $url_page_depart,
                $QUERY_STRING,
                $PHP_SELF,
                $nbligne,
                $nbcol,
                $champ_recherche,
                $operateur_recherche,
                $texte_recherche,
                $champ_courant,
                $operateur_courant,
                $texte_courant,
                $nb_col_courant,
                $ajout_col,
                $requete_resultat,
                $tab_resultat
);
echo $html_search;



/* * *****************************************************************************
  TABLEAU DE SYNTHESE
 * ***************************************************************************** */


/* * **********
  Fin Code HTML
 * ********** */

/* * *********************
  Inclusion de fin de page
 * ********************* */
include ("../lib/fin_page.inc");
?>

