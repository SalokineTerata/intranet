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
require_once '../inc/main.php';
//Barre de Navigation d'une Fiche Technique Article
//include ("./menu_navigation.inc");
//echo $synthese_action;
/* $comeback;
  echo $comeback=($_SERVER["QUERY_STRING"]);
  echo "<br>";
  echo htmlspecialchars($comeback);
 */

//$hostname_connect2 = "admin.agis.fr"; //nom du serveur MySQL de connection � la base de donn�e
//$database_connect2 = "agis"; //nom de la base de donn�e sur votre serveur MySQL
//$username_connect2 = "root"; //login de la base MySQL
//$tablename_connect2 = "salaries"; //table login de la base MySQL
//$password_connect2 = "8ale!ne"; //mot de passe de la base MySQL
//$donnee2 = mysql_pconnect($hostname_connect2, $username_connect2, $password_connect2) or die("connexion impossible");

$nameOfBDDTarget = "intranet_v3_0_dev";
$nameOfBDDOrigin = "intranet_v2_0_prod_dev";
$nameOfBDDStructure = "intranet_v3_0_model";


/**
 * Code * 
 */
//Mise en forme du tableau
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 1800);

function getQuery($paramStartValue) {
    $nameOfBDDOrigin = 'intranet_v2_0_prod_dev';

    return $reqTableClassifRoot = "SELECT classification_arborescence_article.id_classification_arborescence_article, "
            . "ascendant_classification_arborescence_article_categorie_contenu, nom_classification_arborescence_article_categorie_contenu, "
            . "nom_classification_arborescence_article_categorie,classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie_contenu "
            . "FROM " . $nameOfBDDOrigin . ".classification_arborescence_article, " . $nameOfBDDOrigin . ".classification_arborescence_article_categorie_contenu, "
            . "" . $nameOfBDDOrigin . ".classification_arborescence_article_categorie "
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

$returnFullTMP = recursifOne($paramStartValue = $startValue, $HtmlResult);
$returnFull = $returnFullTMP->getArrayResult();

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
            $id = $value["id_classification_arborescence_article_categorie_contenu"];

            $nom_contenu = $value["nom_classification_arborescence_article_categorie_contenu"];
            $nom_type = $value["nom_classification_arborescence_article_categorie"];

            switch ($nom_type) {
                //& $htmlResult->getProprietaire() != "Carrefour(Groupe)"
                case "Propriétaire":
                    $htmlResult->setProprietaire($nom_contenu);
                    $htmlResult->setIdproprietaire($id);
                    break;
                case "Marque":
                    $htmlResult->setMarque($nom_contenu);
                    $htmlResult->setIdmarque($id);

                    //$htmlResult->setIsProprietaireEndToTrue();

                    break;
                case "Activité":
                    $htmlResult->setActivite($nom_contenu);
                    $htmlResult->setIdactivite($id);
                    break;
                case "Rayon":
                    $htmlResult->setRayon($nom_contenu);
                    $htmlResult->setIdrayon($id);

                    break;
                case "Environnement":
                    $htmlResult->setEnvironnement($nom_contenu);
                    $htmlResult->setIdenvironnement($id);

                    break;
                case "Réseau":
                    $htmlResult->setReseau($nom_contenu);
                    $htmlResult->setIdreseau($id);

                    break;
                case "Saisonalité":
                    $htmlResult->setSaisonalite($nom_contenu);
                    $htmlResult->setIdsaisonalite($id);

                    break;
                case "Export":
                    $htmlResult->setExport($nom_contenu);
                    $htmlResult->setIdexport($id);

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
                        $htmlResult->removeLastIdProprietaire();

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
                    "IdProprietaire" => $htmlResult->getIdproprietaire(),
                    "Marque" => $htmlResult->getMarque(),
                    "IdMarque" => $htmlResult->getIdmarque(),
                    "Activite" => $htmlResult->getActivite(),
                    "IdActivite" => $htmlResult->getIdactivite(),
                    "Rayon" => $htmlResult->getRayon(),
                    "IdRayon" => $htmlResult->getIdrayon(),
                    "Environnement" => $htmlResult->getEnvironnement(),
                    "IdEnvironnement" => $htmlResult->getIdenvironnement(),
                    "Reseau" => $htmlResult->getReseau(),
                    "IdReseau" => $htmlResult->getIdreseau(),
                    "Saisonnalite" => $htmlResult->getSaisonalite(),
                    "IdSaisonnalite" => $htmlResult->getIdsaisonalite(),
                    "Export" => $htmlResult->getExport(),
                    "IdExport" => $htmlResult->getIdexport(),
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
$database_connect = $nameOfBDDTarget; //nom de la base de donn�e sur votre serveur MySQL
$username_connect = "root"; //login de la base MySQL
$tablename_connect = "salaries"; //table login de la base MySQL
$password_connect = "8ale!ne"; //mot de passe de la base MySQL
//$connect = new PDO($hostname_connect, $username_connect, $password_connect); //connection � la base de donn�e si sa echoue sa retourne une erreur. 

$donnee = mysql_pconnect($hostname_connect, $username_connect, $password_connect) or die("connexion impossible");


DatabaseOperation::execute(
        "CREATE TABLE " . $nameOfBDDTarget . ".classification_fta2 LIKE  " . $nameOfBDDStructure . ".classification_fta2;"
);
foreach ($returnFull as $value) {
//    $idArborescence = $value[HtmlResult::ID_ARBORESCENCE];
//    $proprietaire = implode("/", $value[HtmlResult::PROPRIETAIRE]);
//    $marque = $value[HtmlResult::MARQUE];
//    $activite = $value[HtmlResult::ACTIVITE];
//    $rayon = $value[HtmlResult::RAYON];
//    $environnement = $value[HtmlResult::ENVIRONNEMENT];
//    $reseau = $value[HtmlResult::RESEAU];
//    $saisonalite = $value[HtmlResult::SAISONALITE];
    $idArborescence = $value[HtmlResult::ID_ARBORESCENCE];
    $proprietaire_groupe = $value['IdProprietaire'][0];
    $proprietaire_enseige = $value['IdProprietaire'][1];
    if (!$proprietaire_enseige) {
        $proprietaire_enseige = 0;
    }
    $marque = $value['IdMarque'];
    $activite = $value['IdActivite'];
    $rayon = $value['IdRayon'];
    $environnement = $value['IdEnvironnement'];
    $reseau = $value['IdReseau'];
    $saisonalite = $value['IdSaisonnalite'];

    $sql_inter = "INSERT INTO  `" . $nameOfBDDTarget . "`
    .`classification_fta2` (
    `id_fta_classification2` ,
    `id_Proprietaire_Groupe` ,
    `id_Proprietaire_Enseigne` ,
    `id_Marque` ,
    `id_Activite` ,
    `id_Rayon` ,
    `id_Environnement` ,
    `id_Reseau` ,
    `id_Saisonnalite` ,
    `id_arborescence` 
    )
    VALUES ('','$proprietaire_groupe',  '$proprietaire_enseige', '$marque',  '$activite',  '$rayon',  '$environnement',  '$reseau',  '$saisonalite',   '$idArborescence')";

    mysql_query("SET NAMES 'utf8'");
    $resultquery = DatabaseOperation::execute($sql_inter);
}

mysql_close();

echo "FIN de TRAITEMENT";
/**
 * Rendu HTML
 */
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

