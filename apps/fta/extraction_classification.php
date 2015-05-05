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

    const ROOT_VALUE = 1;
    const ID_ARBORESCENCE = "IdArborescence";
    const PROPRIETAIRE = "Proprietaire";
    const MARQUE = "Marque";
    const ACTIVITE = "Activite";
    const RAYON = "Rayon";
    const RESEAU = "Reseau";
    const ENVIRONNEMENT = "Environnement";
    const SAISONALITE = "Saisonnalite";

    private $isProprietaireEnd;
    private $arrayResult;
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

    function getIsProprietaireEnd() {
        return $this->isProprietaireEnd;
    }

    function setIsProprietaireEndToTrue() {
        $this->isProprietaireEnd = TRUE;
    }

    function setIsProprietaireEndToFalse() {
        $this->isProprietaireEnd = FALSE;
    }

    function unsetProprietaire() {
        $this->proprietaire = NULL;
    }

    function cleanAll() {

        $this->idArborescence = NULL;
        $this->proprietaire = NULL;
        $this->marque = NULL;
        $this->activite = NULL;
        $this->rayon = NULL;
        $this->reseau = NULL;
        $this->environnement = NULL;
        $this->saisonalite = NULL;
        $this->export = NULL;
    }

    function getArrayResult() {
        return $this->arrayResult;
    }

    function setArrayResult($arrayResult) {
        $this->arrayResult = $arrayResult;
    }

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

    function removeLastProprietaire() {
        array_pop($this->proprietaire);
    }

    function setProprietaire($proprietaire) {


//        if ($this->getIsProprietaireEnd() == TRUE) {
//            array_pop($this->proprietaire);
//            $this->setIsProprietaireEndToFalse();
//        }
        $this->proprietaire[] = $proprietaire;
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
//Initialisation première boucle:3
$i = 0;

$startValue = HtmlResult::ROOT_VALUE;
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
    $i = 0;

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
                    break;
                case "Marque":
                    $htmlResult->setMarque($nom_contenu);
                    //$htmlResult->setIsProprietaireEndToTrue();

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

                /**
                 * Post-traitement récursif
                 */
                switch ($nom_type) {
                    case "Propriétaire":
                        $htmlResult->removeLastProprietaire();
                        break;
                    case "Marque":
                        break;
                    case "Activité":
                        break;
                    case "Rayon":
                        break;
                    case "Environnement":
                        break;
                    case "Réseau":
                        break;
                    case "Saisonalité":
                        break;
                    case "Export":
                        break;
                    default:
                        break;
                }
            } else {

                $htmlResult->setIdArborescence($id_fils);

                $arrayResult = $htmlResult->getArrayResult();

                $arrayResult[$id_fils] = array(
                    "IdArborescence" => $htmlResult->getIdArborescence(),
                    "Proprietaire" => $htmlResult->getProprietaire(),
                    "Marque" => $htmlResult->getMarque(),
                    "Activite" => $htmlResult->getActivite(),
                    "Rayon" => $htmlResult->getRayon(),
                    "Environnement" => $htmlResult->getEnvironnement(),
                    "Reseau" => $htmlResult->getReseau(),
                    "Saisonnalite" => $htmlResult->getSaisonalite(),
                    "Export" => $htmlResult->getExport(),
                );
                $htmlResult->setArrayResult($arrayResult);
                //$htmlResult->cleanAll();
                return $htmlResult;
            }
        }
        return $htmlResult->getArrayResult();
    } else {
        return NULL;
    }
}

//                $htmlResult->setHtmlResult("<tr>" . "<td>" . $htmlResult->getProprietaire() . " / " . $htmlResult->getProprietaire2() . "</td>"
//                        . "<td>" . $htmlResult->getMarque() . "</td>"
//                        . "<td>" . $htmlResult->getActivite() . "</td>"
//                        . "<td>" . $htmlResult->getRayon() . "</td>"
//                        . "<td>" . $htmlResult->getEnvironnement() . "</td>"
//                        . "<td>" . $htmlResult->getReseau() . "</td>"
//                        . "<td>" . $htmlResult->getSaisonalite() . "</td>"
//                        . "<td>" . $htmlResult->getExport() . "</td>"
//                        . "<td>" . $htmlResult->getIdArborescence() . "</td>"
//                        . "</tr>"
//                );

$hostname_connect = "dev-intranet.agis.fr"; //nom du serveur MySQL de connection � la base de donn�e
$database_connect = "intranet_v3_0_dev"; //nom de la base de donn�e sur votre serveur MySQL
$username_connect = "root"; //login de la base MySQL
$tablename_connect = "salaries"; //table login de la base MySQL
$password_connect = "8ale!ne"; //mot de passe de la base MySQL
//$connect = new PDO($hostname_connect, $username_connect, $password_connect); //connection � la base de donn�e si sa echoue sa retourne une erreur. 

$donnee = mysql_pconnect($hostname_connect, $username_connect, $password_connect) or die("connexion impossible");

foreach ($returnFull as $value) {
    $idArborescence = $value[HtmlResult::ID_ARBORESCENCE];
    $proprietaire = implode("/", $value["Proprietaire"]);
    $marque = $value[HtmlResult::MARQUE];
    $activite = $value[HtmlResult::ACTIVITE];
    $rayon = $value[HtmlResult::RAYON];
    $environnement = $value[HtmlResult::ENVIRONNEMENT];
    $reseau = $value[HtmlResult::RESEAU];
    $saisonalite = $value[HtmlResult::SAISONALITE];

    $sql_inter = "INSERT INTO  `intranet_v3_0_dev`
    .`migration_V2_vers_V3_classification_fta` (
    `Proprietaire` ,
    `Marque` ,
    `Activite` ,
    `Rayon` ,
    `Environnement` ,
    `Reseau` ,
    `Saisonnalite` ,
    `id_fta`)
    VALUES ('$proprietaire',  '$marque',  '$activite',  '$rayon',  '$environnement',  '$reseau',  '$saisonalite',  '$idArborescence'
)";

    mysql_query("SET NAMES 'utf8'");
    $resultquery = mysql_query($sql_inter);
}

mysql_close();

$bloc .="Vous avez bien envoyer les données dans la table :  migration_V2_vers_V3_classification_fta";

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

