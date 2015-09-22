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
print_page_begin($disable_full_page, $menu_file);


$periode_debut = Lib::isDefined('periode_debut');
$periode_fin = Lib::isDefined('periode_fin');
$all_classification = Lib::isDefined('all_classification');
//if (isset($menu))                       //Si existant, utilisation du menu demandé
//   {include ("./$menu");}               //en variable
//else
//   {include ("./menu_principal.inc");}  //Sinon, menu par défaut


/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
$page_action = $page_default . ".php";
//   $page_action="transiter_post.php";
$page_pdf = $page_default . "_pdf.php";
$action = 'valider';                       //Action proposée à la page _post.php
$method = 'method=post';             //Pour une url > 2000 caractères, utiliser POST
$html_table = "table "              //Permet d'harmoniser les tableaux
        . "border=1 "
        . "width=100% "
        . "class=contenu "
;
$isIndex = 0;                //Variable booléenne disant si oui ou non on est sur l'index

/*
  Récupération des données MySQL
 */

/*
  Création des objets HTML (listes déroulante, cases à cocher ...etc.)
 */

//Création de l'entête de recherche
$HTML_entete = "";

//Période de recherche (Début)
$champ = "periode_debut";
if (!$periode_debut) { //Par défaut, début d'année en cours
    $periode_debut = date("Y") . "-01-01";
}
$HTML_entete.="<tr><td>Début de la période</td><td>" . calendrier($champ, $periode_debut) . "</td></tr>";

//Période de recherche (Début)
$champ = "periode_fin";
if (!$periode_fin) { //Par défaut, début d'année en cours
    $periode_fin = date("Y") . "-12-31";
}
$HTML_entete.="<tr><td>Fin de la période</td><td>" . calendrier($champ, $periode_fin) . "</td></tr>";

//Raccourcis de Classification fta.suffixe_agrologic_fta

$name_case = "all_classification";
if ($all_classification) {
    $checked = "checked";
    $liste_suffixe_agrologic_fta = "<input type=checkbox name=$name_case value=1 $checked/> Tous";
} else {
    $checked = "";
    //Recherche des classifications existantes
    $req = "SELECT DISTINCT suffixe_agrologic_fta, suffixe_agrologic_fta  "
            . "FROM fta, fta_etat "
            . "WHERE fta.id_fta_etat=fta_etat.id_fta_etat "
            . "AND abreviation_fta_etat='V' "
            . "AND suffixe_agrologic_fta IS NOT NULL "
            . "ORDER BY suffixe_agrologic_fta "
    ;
    $requete = $req;
    $id_defaut = $suffixe_agrologic_fta;
    $nom_defaut = "suffixe_agrologic_fta";
    $liste_suffixe_agrologic_fta = afficher_requete_en_liste_deroulante($requete, $id_defaut, $nom_defaut) . " - <input type=checkbox name=$name_case value=1 $checked/> Tous";
}
$HTML_entete.="<tr><td>Liste des raccourcis de classification</td><td>$liste_suffixe_agrologic_fta</td></tr>";


//Enseigne (du chapitre tarif)
//Enseigne


$name_case = "all_client";
if ($all_client) {
    $checked = "checked";
    $liste_client = "<input type=checkbox name=$name_case value=1 $checked/> Tous";
} else {
    $checked = "";
    $req_liste_client = "SELECT id_classification_arborescence_article_categorie_contenu, nom_classification_arborescence_article_categorie_contenu "
            . "FROM classification_arborescence_article_categorie_contenu "
            . "WHERE id_classification_arborescence_article_categorie = 1 " //Niveau Propriétaire
            //. "AND ascendant_classification_arborescence_client IS NULL "
            . "ORDER BY nom_classification_arborescence_article_categorie_contenu "
    ;
    if (!$id_classification_arborescence_article_categorie_contenu) {
        $id_defaut = "0"; //Tarif général par défaut
    } else {
        $id_defaut = $id_classification_arborescence_article_categorie_contenu;
    }
    $nom_defaut = "id_classification_arborescence_article_categorie_contenu";
    $liste_client = afficher_requete_en_liste_deroulante($req_liste_client, $id_defaut, $nom_defaut) . " - <input type=checkbox name=$name_case value=1 $checked/> Tous";
}

$HTML_entete.="<tr><td>Liste des clients</td><td>$liste_client</td></tr>";

//Création du tableau de résultat

$HTML_result = "";

$HTML_result .= "<tr class=titre><td>" . DatabaseDescription::getFieldDocLabel("fta", "LIBELLE", 1)
        . "</td><td>" . DatabaseDescription::getFieldDocLabel("fta", "Poids_ELEM", 1)
        . "</td><td>" . DatabaseDescription::getFieldDocLabel("fta", "CODE_ARTICLE", 1)
        . "</td><td>" . DatabaseDescription::getFieldDocLabel("fta", "Site_de_production", 1)
        . "</td><td>" . DatabaseDescription::getFieldDocLabel("fta", "EAN_UVC", 1)
        . "</td><td>" . DatabaseDescription::getFieldDocLabel("fta", "NB_UNIT_ELEM", 1)
        . "</td><td>" . DatabaseDescription::getFieldDocLabel("fta_tarif", "prix_fta_tarif", 1)
        . "</td><td>Périodes"
        . "</td></tr>"
;

//Requête principale
$req = "SELECT LIBELLE, Poids_ELEM, CODE_ARTICLE, Site_de_production, EAN_UVC,NB_UNIT_ELEM, prix_fta_tarif, date_debut_fta_tarif, date_fin_fta_tarif  "
        . "FROM  fta, fta_etat, fta_tarif, geo "
        . "WHERE  fta.id_fta_etat=fta_etat.id_fta_etat "      //Liaison
        . "AND fta_tarif.id_fta=fta.id_fta "               //Liaison
        . "AND geo.id_site=fta.Site_de_production " //Liaison
        //. "AND fta_tarif.id_classification_arborescence_article_categorie_contenu='".$id_classification_arborescence_article_categorie_contenu."' "
        //. "AND fta.suffixe_agrologic_fta='".$suffixe_agrologic_fta."' "
        . "AND ( ( ( date_debut_fta_tarif < '$periode_debut' ) AND ( date_fin_fta_tarif > '$periode_debut' ) ) "
        . "OR ( ( date_debut_fta_tarif < '$periode_fin'   ) AND ( date_fin_fta_tarif > '$periode_fin'   ) ) "
        . "OR ( ( date_debut_fta_tarif > '$periode_debut' ) AND ( date_fin_fta_tarif < '$periode_fin'   ) ) "
        . " ) "
        . "AND date_debut_fta_tarif<>'0000-00-00' "
        . "AND date_fin_fta_tarif<>'0000-00-00' "
;
//Critères additionnels
if ($suffixe_agrologic_fta) { //Un raccourcis de classification a été sélectionné
    $req.="AND fta.suffixe_agrologic_fta='" . $suffixe_agrologic_fta . "' ";
}
if ($id_classification_arborescence_article_categorie_contenu) { //Un client a été sélectionné
    $req.="AND fta_tarif.id_classification_arborescence_article_categorie_contenu='" . $id_classification_arborescence_article_categorie_contenu . "' ";
}

//Finalisation de la requête
$req.="ORDER BY CODE_ARTICLE ";

//echo "<br><br>".$req;
$array = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
foreach ($array as $rows) {
    $HTML_result .= "<tr class=contenu><td>" . $rows["LIBELLE"] . "</td><td>" . $rows["Poids_ELEM"] . "</td><td>" . $rows["CODE_ARTICLE"]
            . "</td><td>" . $rows["Site_de_production"]
            . "</td><td>" . $rows["EAN_UVC"]
            . "</td><td>" . $rows["NB_UNIT_ELEM"]
            . "</td><td>" . $rows["prix_fta_tarif"]
            . "</td><td>" . $rows["date_debut_fta_tarif"] . "<br>" . $rows["date_fin_fta_tarif"]
            . "</td></tr>"
    ;
}


/* * *********
  Fin Code PHP
 * ********* */


/* * ************
  Début Code HTML
 * ************ */


echo "
     $navigue
     <form $method action=\"$page_action\" name=\"form_action\" method=\"post\">
     <$html_table>
              $HTML_entete

     </table>
     <br>
     <center>
     <input type=submit value='Actualiser'>
     </center>
     <br>
     <$html_table>

      $HTML_result

     </table>

     </form>
     ";
/* * **********
  Fin Code HTML
 * ********** */

/* * *********************
  Inclusion de fin de page
 * ********************* */
include ("../lib/fin_page.inc");
?>

