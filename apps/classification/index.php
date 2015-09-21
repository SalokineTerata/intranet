<?php

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répertoire courant
 */
//   $module=substr(strrchr(`pwd`, '/'), 1);
//   $module=trim($module);


/*
  Si la page peut être appelée depuis n'importe quel module,
  décommentez la ligne suivante
 */

//   $module='';
//Sélection du mode de visualisation de la page
switch ($output) {

    case 'visualiser':
        //Inclusions
        include ("../lib/session.php");         //Récupération des variables de sessions
        include ("../lib/functions.php");       //On inclus seulement les fonctions sans construire de page
        include ("functions.php");              //Fonctions du module
        echo "
            <link rel=stylesheet type=text/css href=../lib/css/intra01.css />
            <link rel=stylesheet type=text/css href=visualiser.css />
       ";

    //break;
    case 'pdf':
        break;

    default:
        //Inclusions
//        include ("../lib/session.php");         //Récupération des variables de sessions
//        include ("../lib/debut_page.php");      //Construction d'une nouvelle
//        if (isset($menu))                       //Si existant, utilisation du menu demandé
//        {                                       //en variable
//           include ("./$menu");
//        }
//        else
//        {
//           include ("./menu_principal.inc");    //Sinon, menu par défaut
//        }
        require_once '../inc/main.php';
        print_page_begin($disable_full_page, $menu_file);
}//Fin de la sélection du mode d'affichage de la page


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
$method = 'POST';                          //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = "table "                     //Permet d'harmoniser les tableaux
        . "border=1 "
        . "width=100% "
        . " "
;


/*
  Récupération des données MySQL
 */
//   Exemple: mysql_table_load('nom_de_ma_table');

$table = 'classification_arborescence_article,classification_arborescence_article_categorie_contenu';                                      //nom de la table contenant l'association "Père" / "Fils"
$champ_valeur = 'nom_classification_arborescence_article_categorie_contenu';                            //nom du champ contenant la valeur à afficher (sans le "underscore" et le nom de la table)
$champ_id_fils = 'id_classification_arborescence_article';         //nom du champ fils contenant l'id (sans le "underscore" et le nom de la table)
$champ_id_pere = 'ascendant_classification_arborescence_article_categorie_contenu';  //nom du champ père contenant l'id (sans le "underscore" et le nom de la table)
$id_racine = 1;                                                                     //Identifiant de l'enregistrement père racine (le premier)
if (!$liste_id) {
    $liste_id = "," . $id_racine . ",";
}
if ($add_id) {
    $liste_id.=$add_id . ",";
}
//echo    $liste_id;
//echo    $_GET;
//    print_r(parse_url($url));
$sql_where = "classification_arborescence_article.id_classification_arborescence_article_categorie_contenu=classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie_contenu";                //Permet de personnaliser la clause SQL "WHERE" comme pour insérer une jointure par exemple

$extension[0] = "&nbsp<a href=index.php?liste_id=" . $liste_id . "&add_id=";         //Lien HTML
$extension[1] = 1;                //Termine le lien par l'id de l'objet de l'arborescence
$extension[2] = "><img src=../lib/images/plus.png width=10 height=10 border=0></a>";           //2ème bout de code rajouter en fin de ligne
$extension[3] = $liste_id;        //Liste des id à développer, si NULL, alors tout est développé
$extension[4] = "ajout.php?liste_id=" . $liste_id . "&id_classification_arborescence_article=";     //Lien lorsqu'on clique sur un element de classification
//    $arbo=arborescence_construction( $table,
//                                     $champ_valeur,
//                                     $champ_id_fils,
//                                     $champ_id_pere,
//                                     $id_racine,
//                                     $sql_where,
//                                     $extension
//                                     );
//Présentation Texte
$arbo[2];

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

$bloc = "<" . $html_table . "><tr class=titre>"
        . "<td>" . HtmlResult::PROPRIETAIRE . "</td>"
        . "<td>" . HtmlResult::PROPRIETAIRE . "</td>"
        . "<td>" . HtmlResult::MARQUE . "</td>"
        . "<td>" . HtmlResult::ACTIVITE . "</td>"
        . "<td>" . HtmlResult::RAYON . "</td>"
        . "<td>" . HtmlResult::ENVIRONNEMENT . "</td>"
        . "<td>" . HtmlResult::RESEAU . "</td>"
        . "<td>" . HtmlResult::SAISONALITE . "</td>"
        . "</tr>";

//Démarrage
//Initialisation première boucle:3
$i = 0;

$startValue = AccueilFta::VALUE_1;
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

$array = $HtmlResult->getArrayResult();

foreach ($array as $key => $rows) {

    $bloc .="<tr class=\"contenu\" name=id_classification_arborescence_article value=" . $key . ">";


    $bloc.= "<td >" . $rows[HtmlResult::PROPRIETAIRE][0] . "</td>";
    $bloc.= "<td>" . $rows[HtmlResult::PROPRIETAIRE][1] . "</td>";



    $bloc.= "<td>" . $rows[HtmlResult::MARQUE] . "</td>"
            . "<td>" . $rows[HtmlResult::ACTIVITE] . "</td>"
            . "<td>" . $rows[HtmlResult::RAYON] . "</td>"
            . "<td>" . $rows[HtmlResult::ENVIRONNEMENT] . "</td>"
            . "<td>" . $rows[HtmlResult::RESEAU] . "</td>"
            . "<td>" . $rows[HtmlResult::SAISONALITE] . "</td>"
    ;
    $bloc .="</tr>";
}

/*
  Sélection du mode d'affichage
 */
switch ($output) {

    /*     * ***********
      Début Code PDF
     * *********** */
    case "pdf":
        //Constructeur
        $pdf = new XFPDF();

        //Déclaration des variables de formatages
        $police_standard = "Arial";
        $t1_police = $police_standard;
        $t1_style = "B";
        $t1_size = "12";

        $t2_police = $police_standard;
        $t2_style = "B";
        $t2_size = "11";

        $t3_police = $police_standard;
        $t3_style = "BIU";
        $t3_size = "10";

        $contenu_police = $police_standard;
        $contenu_style = "";
        $contenu_size = "8";

        $chapitre = 0;
        $section = 0;
        include($page_pdf);
        //$pdf->SetProtection(array("print", "copy"));
        $pdf->Output(); //Read the FPDF.org manual to know the other options

        break;
    /*     * *********
      Fin Code PDF
     * ********* */


    /*
      Création des objets HTML (listes déroulante, cases à cocher ...etc.)
     */




    /*     * ************
      Début Code HTML
     * ************ */
    default:

        echo "
             <form method=" . $method . " action=" . $page_action . ">
             <input type=hidden name=action value=" . $action . ">

             <" . $html_table . ">
             <tr class=titre_principal><td>

                 Module de classification Agis

             </td></tr>
             <tr><td>

                 Ce module permet de centraliser et d'harmoniser la classification des différents éléments suivants:<br>
                 <br>
                 - Articles
             </td></tr>
             <tr><td>
             Articles:<a href=ajout.php?id_classification_arborescence_article=1><img src=\"../lib/images/plus.png\"/\" alt=\"\" width=\"10\" height=\"10\" border=\"0\" /></a>
            " . $bloc . "

             </td></tr>
             <tr><td>

                 <center>
                 <input type=submit value='Enregistrer'>
                 </center>

             </td></tr>
             </table>

             </form>
             ";



        /*         * *********************
          Inclusion de fin de page
         * ********************* */
        include ("../lib/fin_page.inc");

    /*     * **********
      Fin Code HTML
     * ********** */
}//Fin du switch de sélection du mode d'affichage
?>