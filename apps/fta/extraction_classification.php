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




/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
$page_action = $page_default . "_post.php";
$page_pdf = $page_default . "_pdf.php";
$action = 'valider';                       //Action proposée à la page _post.php
$method = 'method=post';                   //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = "table "                     //Permet d'harmoniser les tableaux
        . "border=0 "
        . "width=100% "
        . "class=titre "
;
//$html_image_modif = "&nbsp;<img src=../lib/images/exclamation.png alt=\"\" title=\"Information mise à jour\" width=\"20\" height=\"18\" border=\"0\" />";
//$html_color_modif = "bgcolor=#B0FFFE";
$version_modif = 1;                        //Activer la visualisation des modifications effectuées depuis la version précédente
$show_help = 1;                              //Activer l'aide en ligne Pop-up
$bloc = "";
$fieldProprietaire = "";
$fieldMarque = "";
$fieldActivite = "";
$fieldRayon = "";
$fieldReseau = "";
$fieldEnvironnement = "";
$fieldSaisonalite = "";
$fieldExport = "";

//Barre de Navigation d'une Fiche Technique Article
//include ("./menu_navigation.inc");
//echo $synthese_action;
/* $comeback;
  echo $comeback=($_SERVER["QUERY_STRING"]);
  echo "<br>";
  echo htmlspecialchars($comeback);
 */

/**
 * Code * 
 */
//Démarrage

$reqTableClassifRoot = "SELECT classification_arborescence_article.id_classification_arborescence_article, ascendant_classification_arborescence_article_categorie_contenu, nom_classification_arborescence_article_categorie_contenu, nom_classification_arborescence_article_categorie "
        . "FROM classification_arborescence_article, classification_arborescence_article_categorie_contenu, classification_arborescence_article_categorie "
        . "WHERE classification_arborescence_article.id_classification_arborescence_article_categorie_contenu = classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie_contenu "
;

$resultTableClassifRoot = DatabaseOperation::query($reqTableClassifRoot);
$arrayTableClassifRoot = DatabaseOperation::convertSqlResultWithoutKeyToArray($resultTableClassifRoot);
foreach ($arrayTableClassifRoot as $value) {
    $rootValue = 1;
    $id_pere = $value["ascendant_classification_arborescence_article_categorie_contenu"];
    $id_fils = $value["id_classification_arborescence_article"];
    $id_nom = $value["nom_classification_arborescence_article_categorie_contenu"];
    $id_type = $value["nom_classification_arborescence_article_categorie"];
    $return = recursif2($rootValue, $id_fils, $return, $fieldProprietaire, $fieldMarque, $fieldActivite, $fieldRayon, $fieldReseau, $fieldEnvironnement, $fieldSaisonalite, $fieldExport);
}

//$return = recursif2($rootValue, $fieldProprietaire, $fieldMarque, $fieldActivite, $fieldRayon, $fieldReseau, $fieldEnvironnement, $fieldSaisonalite, $fieldExport, $return);

/*
 * structure du résultat
 * 
 * $return
 *          $[idClassification]
 * 
 *              $[propriétaire] => "LDC , truc "
 * 
 *              $[marque] => "rouge"
 * 
 *              $[...] => ".."
 * 
 * 
 * 
 */


//Récurrsive
//function recursif2($paramRootValue, $fieldProprietaire, $fieldMarque, $fieldActivite, $fieldRayon, $fieldReseau, $fieldEnvironnement, $fieldSaisonalite, $fieldExport, $return) {
function recursif2($paramPere, $paramFils, $paramReturn, $paramfieldProprietaire, $paramfieldMarque, $paramfieldActivite, $paramfieldRayon, $paramfieldReseau, $paramfieldEnvironnement, $paramfieldSaisonalite, $paramfieldExport) {


    /**
     * SELECT classification_arborescence_article.id_classification_arborescence_article,ascendant_classification_arborescence_article_categorie_contenu,nom_classification_arborescence_article_categorie_contenu,nom_classification_arborescence_article_categorie  FROM classification_arborescence_article,classification_arborescence_article_categorie_contenu,classification_arborescence_article_categorie WHERE classification_arborescence_article.id_classification_arborescence_article_categorie_contenu=classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie_contenu 

      AND ascendant_classification_arborescence_article_categorie_contenu=31
      AND classification_arborescence_article_categorie.id_classification_arborescence_article_categorie =classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie

      ORDER BY `classification_arborescence_article`.`ascendant_classification_arborescence_article_categorie_contenu` ASC
     */
    if ($paramPere == NULL) {
        $paramPere = $paramFils;
    }


    $reqTableClassif = "SELECT classification_arborescence_article.id_classification_arborescence_article, ascendant_classification_arborescence_article_categorie_contenu, nom_classification_arborescence_article_categorie_contenu,nom_classification_arborescence_article_categorie "
            . "FROM classification_arborescence_article, classification_arborescence_article_categorie_contenu,classification_arborescence_article_categorie "
            . "WHERE classification_arborescence_article.id_classification_arborescence_article_categorie_contenu = classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie_contenu "
            . "AND classification_arborescence_article_categorie.id_classification_arborescence_article_categorie =classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie "
            . "AND ascendant_classification_arborescence_article_categorie_contenu=" . $paramPere . " ";


    $resultTableClassif = DatabaseOperation::query($reqTableClassif);
    $arrayTableClassif = DatabaseOperation::convertSqlResultWithoutKeyToArray($resultTableClassif);
   // $nb_ligne = mysql_num_rows($resultTableClassif);
   // while ($i < ($nb_ligne)) {
        foreach ($arrayTableClassif as $value) {

            //Est-ce qu'il est propriétaire ?
            //si Oui
            if ($value["nom_classification_arborescence_article_categorie"] == "Propriétaire") {
                $paramfieldProprietaire .= $value["nom_classification_arborescence_article_categorie_contenu"];
                ;
            } else {
                if ($value["nom_classification_arborescence_article_categorie"] == "Marque") {
                    $paramfieldMarque .= $value["nom_classification_arborescence_article_categorie_contenu"];
                    ;
                } else {
                    if ($value["nom_classification_arborescence_article_categorie"] == "Activité") {
                        $paramfieldActivite .= $value["nom_classification_arborescence_article_categorie_contenu"];
                        ;
                    } else {
                        if ($value["nom_classification_arborescence_article_categorie"] == "Rayon") {
                            $paramfieldRayon .= $value["nom_classification_arborescence_article_categorie_contenu"];
                            ;
                        } else {
                            if ($value["nom_classification_arborescence_article_categorie"] == "Réseau") {
                                $paramfieldReseau .= $value["nom_classification_arborescence_article_categorie_contenu"];
                                ;
                            } else {
                                if ($value["nom_classification_arborescence_article_categorie"] == "Environnement") {
                                    $paramfieldEnvironnement .= $value["nom_classification_arborescence_article_categorie_contenu"];
                                } else {
                                    if ($value["nom_classification_arborescence_article_categorie"] == "Saisonalité") {
                                        $paramfieldSaisonalite .= $value["nom_classification_arborescence_article_categorie_contenu"];
                                    } else {
                                        if ($value["nom_classification_arborescence_article_categorie"] == "Export") {
                                            $paramfieldExport .= $value["nom_classification_arborescence_article_categorie_contenu"];
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            ///Au passage définitivement au champs marque
            //appel récursif , mai start value  $value["id_classification_arborescence_article"];
            $paramPere = $paramFils;
            $paramFils = $value["id_classification_arborescence_article"];
            $fieldProprietaire = $paramfieldProprietaire;
            $fieldMarque = $paramfieldMarque;
            $fieldActivite = $paramfieldActivite;
            $fieldRayon = $paramfieldRayon;
            $fieldReseau = $paramfieldReseau;
            $fieldEnvironnement = $paramfieldEnvironnement;
            $fieldSaisonalite = $paramfieldSaisonalite;
            $fieldExport = $paramfieldExport;

            $paramReturn .= "<table> <caption>Classification Agis</caption>

        <thead> <!-- En-tête du tableau -->
            <tr>
                <th>Id Classification arborescence</th>
                <th>Propriétaire</th>
                <th>Marque</th>
                <th>Activité</th>
                <th>Rayon</th>
                <th>Réseau</th>
                <th>Environnement</th>
                <th>Saisonalité</th>
                <th>Export</th>
            </tr>
        </thead>

        
                <tr><td>" . $paramFils . " </td> <td> " . $paramfieldProprietaire . " </td> <td> " . $paramfieldMarque . " </td> <td> " . $paramfieldActivite . " </td><td> " . $paramfieldRayon . "</td> <td> " . $paramfieldReseau . "</td> <td> " . $paramfieldEnvironnement . "</td> <td> " . $paramfieldSaisonalite . "</td> <td> " . $paramfieldExport . "</td></tr></table>";
        };
        $paramReturn = recursif2($paramPere, $paramFils, $paramReturn, $fieldProprietaire, $fieldMarque, $fieldActivite, $fieldRayon, $fieldReseau, $fieldEnvironnement, $fieldSaisonalite, $fieldExport);
 //   }


    return $paramReturn;
}

$bloc = "Résultat<br>";


/**
 * Rendu HTML
 */
echo "
     $navigue
     <form $method action=\"$page_action\" name=\"form_action\" method=\"post\">
     <input type=hidden name=action value=$action>
     <input type=hidden name=id_fta value=$id_fta>
     <input type=hidden name=abreviation_fta_etat value=$abreviation_fta_etat>
     <input type=hidden name=id_fta_chapitre_encours value=$id_fta_chapitre_encours>
     <input type=hidden name=id_fta_chapitre value=$id_fta_chapitre>
     <input type=hidden name=id_fta_suivi_projet value=$id_fta_suivi_projet>
     <input type=\"hidden\" name=\"synthese_action\" value=\"$synthese_action\" />
     <input type=\"hidden\" name=\"nom_fta_chapitre_encours\" value=\"$nom_fta_chapitre_encours\" />
     <input type=\"hidden\" name=\"comeback\" value=\"$comeback\" />

     $javascript
     <$html_table>
     <tr><td>

         $bloc

     </td></tr>
     </table>
     </form>
     ";

//$recordSetFta = new FtaModel($id_fta);
//$test = $recordSetFta->getFieldNomDemandeur();
//
//echo "<pre>";
//print_r ($_SESSION);
////print_r($recordSetFta);
//echo "</pre>";

/* * **********
  Fin Code HTML
 * ********** */

/* * *********************
  Inclusion de fin de page
 * ********************* */
include ("../lib/fin_page.inc");

