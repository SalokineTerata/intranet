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
flush();



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

$url_page_depart = Lib::getParameterFromRequest("url_page_depart");
$QUERY_STRING = Lib::getParameterFromServer("QUERY_STRING");
$PHP_SELF = Lib::getParameterFromServer("PHP_SELF");
$nbligne = Lib::getParameterFromRequest('nbligne');                           // Nombre de lignes totales
$nbcol = Lib::getParameterFromRequest('nbcol');                             // nombre de colonnes de la ligne courante
$champ_recherche = Lib::getParameterFromRequest('champ_recherche');         //tableau des identifiants des champs choisis
$operateur_recherche = Lib::getParameterFromRequest('operateur_recherche'); //tableau des identifiants des operateurs choisis
$texte_recherche = Lib::getParameterFromRequest('texte_recherche');         //table au des valeurs entrées par l'utilisateur
$champ_courant = Lib::getParameterFromRequest('champ_courant');             // Valeur de l'identifiant du champ qui vient juste d'etre saisie par l'utilisateur
$operateur_courant = Lib::getParameterFromRequest('operateur_courant');     // Valeur de l'identifiant de l'operateur qui vient juste d'etre saisie par l'utilisateur
$texte_courant = Lib::getParameterFromRequest('texte_courant');             // Valeur du texte qui vient juste d'etre saisie par l'utilisateur
$nb_col_courant = Lib::getParameterFromRequest('nb_col_courant');           // numero de la colonne courante
$nb_ligne_courant = Lib::getParameterFromRequest("nb_ligne_courant");       // numero de la ligne courante
$ajout_col = Lib::getParameterFromRequest('ajout_col');                     //si $ajout_col = 1 : ajout d'une colonne dans la ligne courante
$requete_resultat = Lib::getParameterFromRequest("requete_resultat");
$tab_resultat = Lib::getParameterFromRequest("tab_resultat");

$module_table = Lib::getParameterFromRequest('module_table');               // nom du module auquel appartient la table
$champ_retour = Lib::getParameterFromRequest('champ_retour');                // nom du champ reponse de la requete

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
if (!$module_table) {
    $module_table = $module;
}
$etat_table = "fta_etat";
$id_recherche = "id_fta";
$id_recherche_etat = "id_fta_etat";
$abreviation_recherche_etat = "abreviation_fta_etat";
$nom_recherche_recherche_etat = "nom_fta_etat";
if (!$champ_retour) {
    $champ_retour = 'fta.id_fta';
}
$image_bordure = "../lib/images/s7.gif";
$image_recherche = "../lib/images/search.gif";
$nb_limite_resultat = 1000;





$html_search = MoteurDeRecherche::afficherMoteurDeRecherche(
                $module, $id_recherche, $etat_table
                , $id_recherche_etat, $abreviation_recherche_etat
                , $nom_recherche_recherche_etat, $image_bordure
                , $image_recherche, $champ_retour, $nb_limite_resultat
                , $url_page_depart, $QUERY_STRING, $PHP_SELF, $nbligne
                , $nbcol, $champ_recherche, $operateur_recherche
                , $texte_recherche, $champ_courant, $operateur_courant
                , $texte_courant, $nb_col_courant, $ajout_col
                , $requete_resultat, $tab_resultat, $module_table
                , $nb_ligne_courant
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

