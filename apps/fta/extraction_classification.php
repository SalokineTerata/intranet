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
 * Tableau de retour:
 * 
 * array(
 *      "bofrost(propriétaire)" => array(
 *                                      "bofrost (marque)" => array(
 *                                                                 asiatique => ...,
 *                                                                 traiteur => ..
 *                                      "TDA" (marque)" => array(
 *                                                                 ...
 *      "Carrefour" => array (...etc                        
 */

/**
 * Code * 
 */
//Mise en forme du tableau

class HtmlResult {

    private $htmlResult;
    private $idArborescence;
    private $proprietaire;
    private $proprietaire2;
    private $marque;
    private $activite;
    private $rayon;
    private $reseau;
    private $environnement;
    private $saisonalite;
    private $export;
    private $tmp;

    function getProprietaire() {
        return $this->proprietaire;
    }

    function getMarque() {
        return $this->marque;
    }

    function getActivite() {
        return $this->activite;
    }

    function getRayon() {
        return $this->rayon;
    }

    function getReseau() {
        return $this->reseau;
    }

    function getEnvironnement() {
        return $this->environnement;
    }

    function getSaisonalite() {
        return $this->saisonalite;
    }

    function setProprietaire($proprietaire) {
        if ($this->getTmp() != $proprietaire) {
            if ($this->getProprietaire() === $this->getTmp() & $this->getProprietaire() == !NULL ) {
                $this->setProprietaire2($proprietaire);
            } elseif ($this->getProprietaire() != $proprietaire) {
                if ($this->getProprietaire() != NULL) {
                    if ($this->getProprietaire() === $this->getTmp()) {
                        $this->setProprietaire2($proprietaire);
                    }
                    $this->setTmp($proprietaire);
                    if ($this->getProprietaire2() === NULL) {
                        $this->proprietaire = $this->getTmp();
                    }
                } elseif ($this->getProprietaire() != $this->getTmp()) {
                    $this->proprietaire = $this->getTmp();
                }
                if ($this->getProprietaire() == NULL) {
                    $this->proprietaire = $proprietaire;
                }
            }
        }
    }

    function setMarque($marque) {
        $this->marque = $marque;
    }

    function setActivite($activite) {
        $this->activite = $activite;
    }

    function setRayon($rayon) {
        $this->rayon = $rayon;
    }

    function setReseau($reseau) {
        $this->reseau = $reseau;
    }

    function setEnvironnement($environnement) {
        $this->environnement = $environnement;
    }

    function setSaisonalite($saisonalite) {
        $this->saisonalite = $saisonalite;
    }

    function getIdArborescence() {
        return $this->idArborescence;
    }

    function setIdArborescence($idArborescence) {
        $this->idArborescence = $idArborescence;
    }

    function getProprietaire2() {
        return $this->proprietaire2;
    }

    function setProprietaire2($proprietaire2) {
        $this->proprietaire2 = $proprietaire2;
    }

    function getExport() {
        return $this->export;
    }

    function setExport($export) {
        $this->export = $export;
    }

    function getTmp() {
        return $this->tmp;
    }

    function setTmp($tmp) {
        $this->tmp = $tmp;
    }

//    function getHtmlResult() {
//        $html_result = "";
//        $propri = $this->getProprietaire();
//        $marq = $this->getMarque();
//        $activ = $this->getActivite();
//        $rayon = $this->getRayon();
//        $reseau = $this->getReseau();
//        $enviro = $this->getEnvironnement();
//        $saison = $this->getSaisonalite();
//
//
//        $html_result .= "<tr>" . "<td>" . $propri . "</td>"
//                . "<td>" . $marq . "</td>"
//                . "<td>" . $activ . "</td>"
//                . "<td>" . $rayon . "</td>"
//                . "<td>" . $reseau . "</td>"
//                . "<td>" . $enviro . "</td>"
//                . "<td>" . $saison . "</td>"
//                . "</tr>";
//
//        return $html_result;
//    }

    function getHtmlResult() {
        return $this->htmlResult;
    }

    function setHtmlResult($htmlResult) {
        $this->htmlResult = $htmlResult;
    }

}

function getQuery($paramStartValue) {
    return $reqTableClassifRoot = "SELECT classification_arborescence_article.id_classification_arborescence_article, "
            . "ascendant_classification_arborescence_article_categorie_contenu, nom_classification_arborescence_article_categorie_contenu, "
            . "nom_classification_arborescence_article_categorie "
            . "FROM classification_arborescence_article, classification_arborescence_article_categorie_contenu, "
            . "classification_arborescence_article_categorie "
            . "WHERE classification_arborescence_article.id_classification_arborescence_article_categorie_contenu = "
            . "classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie_contenu "
            . "AND classification_arborescence_article_categorie.id_classification_arborescence_article_categorie = "
            . "classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie "
            . "AND ascendant_classification_arborescence_article_categorie_contenu = $paramStartValue "
            . "ORDER BY classification_arborescence_article.id_classification_arborescence_article "
    ;
}

//Démarrage
//Initialisation première boucle:
$i = 0;
$startValue = 1;
$return = array();

$HtmlResult = new HtmlResult();

$returnFull = recursifOne($paramStartValue = $startValue, $HtmlResult);

/**
 * 
 * @param mixed $paramStartValue
 * @param HtmlResult $htmlResult
 * @return mixed
 */
function recursifOne($paramStartValue, $htmlResult) {
    $reqTableClassifRoot = getQuery($paramStartValue);

    $resultTableClassifRoot = DatabaseOperation::query($reqTableClassifRoot);
    $arrayTableClassifRoot = DatabaseOperation::convertSqlResultWithoutKeyToArray($resultTableClassifRoot);

    if ($arrayTableClassifRoot != NULL) {
        foreach ($arrayTableClassifRoot as $value) {

            $id_fils = $value["id_classification_arborescence_article"];
            $id_pere = $value["ascendant_classification_arborescence_article_categorie_contenu"];
            $nom_contenu = $value["nom_classification_arborescence_article_categorie_contenu"];
            $nom_type = $value["nom_classification_arborescence_article_categorie"];

            switch ($nom_type) {
//& $htmlResult->getProprietaire() != "Carrefour(Groupe)"
                case "Propriétaire":

                    $htmlResult->setProprietaire($nom_contenu);

                    ;
                    break;
                case "Marque":
                    $htmlResult->setMarque($nom_contenu);
                    break;
                case "Activité":
                    $htmlResult->setActivite($nom_contenu);
                    break;
                case "Rayon":
                    $htmlResult->setRayon($nom_contenu);
                    break;
                case "Environnement":
                    $htmlResult->setEnvironnement($nom_contenu);
                    break;
                case "Réseau":
                    $htmlResult->setReseau($nom_contenu);
                    break;
                case "Saisonalité":
                    $htmlResult->setSaisonalite($nom_contenu);
                    break;
                case "Export":
                    $htmlResult->setExport($nom_contenu);
                    break;

                //....

                default:
                    break;
            }

            $j = $nom_type . $i++;
            $return[$j] = array(
                $nom_type => $nom_contenu,
                "id" . $nom_type => $id_fils
            );
            $subReturn = recursifOne($id_fils, $htmlResult);
            if ($subReturn != NULL) {
                $return[$j][] = $subReturn;
            } else {
                $htmlResult->setHtmlResult("<tr>" . "<td>" . $htmlResult->getProprietaire() . " / " . $htmlResult->getProprietaire2() . "</td>"
                        . "<td>" . $htmlResult->getMarque() . "</td>"
                        . "<td>" . $htmlResult->getActivite() . "</td>"
                        . "<td>" . $htmlResult->getRayon() . "</td>"
                        . "<td>" . $htmlResult->getEnvironnement() . "</td>"
                        . "<td>" . $htmlResult->getReseau() . "</td>"
                        . "<td>" . $htmlResult->getSaisonalite() . "</td>"
                        . "<td>" . $htmlResult->getExport() . "</td>"
                        . "<td>" . $htmlResult->getIdArborescence() . "</td>"
                        . "</tr>"
                );
                $htmlResult->setIdArborescence($id_fils);
                return $htmlResult->getHtmlResult();
            }
        }
        return $return;
    } else {
        return NULL;
    }
}

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
$bloc.= "<pre>";
$bloc.= print_r($returnFull);
$bloc.= "</pre>";

//$bloc.= "<table>" . $HtmlResult->getHtlkResult() . "</table>";


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

