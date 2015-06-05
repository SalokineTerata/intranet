<?php

//Redirection vers la page par défaut du module
//header ("Location: indexft.php");

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */
//include ("../lib/session.php");         //Récupération des variables de sessions
//$module."<br>".$_SERVER["REQUEST_URI"];

/*
  Si la page peut être appelée depuis n'importe quel module,
  décommentez la ligne suivante
 */

//   $module='fta';

/* * *******
  Inclusions
 * ******* */
//include ("../lib/debut_page.php");      //Affichage des éléments commun à l'Intranet
require_once '../inc/main.php';
print_page_begin($disable_full_page, $menu_file);



/*
 * Initilisation
 */
$globalConfig = new GlobalConfig();
$id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();

/* * ***********
  Début Code PHP
 * *********** */
if ($id_user) {
    /*
      Initialisation des variables
     */
    $page_default = substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
//   $page_action=$page_default."_post.php";
    $page_action = "transiter_post.php";
    $page_pdf = $page_default . "_pdf.php";
    $action = 'valider';                       //Action proposée à la page _post.php
    $method = 'method=post';             //Pour une url > 2000 caractères, utiliser POST
    $html_table = "table "              //Permet d'harmoniser les tableaux
            . "border=1 "
            . "width=100% "
            . "class=contenu "
    ;
    $isIndex = 0;                //Variable booléenne disant si oui ou non on est sur l'index

    $abreviation_fta_etat = Lib::isDefined("abreviation_fta_etat");
    $fta_consultation = Lib::isDefined("fta_consultation");
    $fta_modification = Lib::isDefined("fta_modification");
    $id_fta_etat = Lib::isDefined("id_fta_etat");
    $isLimit = $_SESSION["limit_affichage_fta_index"];
    $nom_fta_etat = Lib::isDefined("nom_fta_etat");
    $nombre_fiche = Lib::isDefined("nombre_fiche");
    $requete_resultat = Lib::isDefined("requete_resultat");
    $synthese_action = Lib::isDefined("synthese_action");
    $tableau_fiche = Lib::isDefined("tableau_fiche");
    $visualiser_fiche_total_fta = Lib::isDefined("visualiser_fiche_total_fta");
    $order_common = Lib::isDefined("order_common");


    /*
      Récupération des données MySQL
     */
    //2008-07-28 - BS Par défaut, les utilisateurs participant aux processus arrivent sur leur page "Fiche En cours"
    //Par défaut, tout le monde arrive sur la liste des FTA en cours de modification.
    //id_fta_etat=1&nom_fta_etat=I&synthese_action=encours
    if (!$id_fta_etat) {
        $isIndex = 1;  //On est sur l'index donc chargement des vues par défaut suivant le profile utilisateur
        $id_fta_etat = "1";
        $nom_fta_etat = "I";
        $abreviation_fta_etat = $nom_fta_etat;
        if ($fta_modification) {
            $synthese_action = "encours";
        } else {
            $synthese_action = "attente";
        }
    }

//echo "id_fta_etat=$id_fta_etat / nom_fta_etat=$nom_fta_etat / synthese_action=$synthese_action <br>";

    /*
      Création des objets HTML (listes déroulante, cases à cocher ...etc.)
     */


    /*     * *********
      Fin Code PHP
     * ********* */


    /*     * ************
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


    $id_fta_etat_encours = $id_fta_etat;
    $ftaEtatModel = new FtaEtatModel($id_fta_etat);

//$receivedKey["id_fta_etat"] = $id_fta_etat;
//$record_fta_etat = new Database("fta_etat", $receivedKey);
//$nom_fta_etat=$record_fta_etat->getValue("nom_fta_etat");
    $nom_fta_etat_encours = $ftaEtatModel->getDataField(FtaEtatModel::FIELDNAME_NOM_FTA_ETAT)->getFieldValue();

//echo $nom_fta_etat;
//Suivant le droit d'acces de l'utilisateur
//Si l'utilisateur  des droits d'acces defini pout ce module
//if($fta_consultation or $fta_modification)
//{
    $req_where = " AND (fta_etat.abreviation_fta_etat='V' OR fta_etat.abreviation_fta_etat='A' OR fta_etat.abreviation_fta_etat='I') ";

    //Si l'utilisateur a les droits de modification, il voit l'ensemble des etats
    if ($fta_modification) {
        $req_where = "";
    }
    /*******************************************************************************
      TABLEAU DE SYNTHESE
     ****************************************************************************** */

    $tableau_synthese.=AccueilFta::getTableauSythese($req_where);





    //Tableau des FTA
    //Suivant si on est sur l'index ou pas, on charge une vue différentes,
    //et dans le cas des utilisateurs n'ayant que les droits en consultation
    //Ainsi, ils voient les fiches en cours et les 10 dernières FTA Validée
    /*
      if($isIndex and $synthese_action=="attente") //Dans le cas de l'index,
      {
      //Chargement de la vue dédiée:

      }
      else
     */ {
        $choix = 1;
        if ($synthese_action) {
            //echo $id_fta_etat;
            $tableau_fiche = visualiser_fiches($id_fta_etat, $choix, $isLimit, $order_common);
        }

        if ($isLimit) {
            $titre_tableau = "<h4>Listes des " . $_SESSION["visualiser_fiche_total_fta"] . " dernières fiches en état $nom_fta_etat_encours </h4><br>"
                    . "<i><a href=index.php"
                    . "?id_fta_etat=$id_fta_etat"
                    . "&nom_fta_etat=$abreviation_fta_etat"
                    . "&synthese_action=all"
                    . "&isLimit=0"
                    . ">Voir toutes les fiches"
                    . "</a></i><br>"
            ;
        } else {
            $titre_tableau = "Listes des fiches : état $nom_fta_etat_encours <br>Il a actuellement " . $_SESSION["visualiser_fiche_total_fta"] . " fiches";
        }
    }


//Construction de la page <td>&nbsp</td>
    echo "
    <form method=post action=$page_action>
        <input type=hidden name=id_fta_etat value=$id_fta_etat_encours>
        <input type=hidden name=nom_fta_etat value=$nom_fta_etat_encours>
        <table width=100% border=1 valign=top cellspacing=0>
            <tr>
                <td class=titre_principal> <br>
                        <img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;
                        <br>
                        <br>
                        Index des Fiches Techniques Articles (FTA)
                        <br>
                        <br>
                        <img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;<img src=../lib/images/s7.gif>&nbsp;

                         <br><br></td>
            </tr>
            <tr>
                <td> $tableau_synthese </td>
            </tr>
        </table>
";

    if ($synthese_action and ! $requete_resultat) {
        echo "
          <table width=100% border=1>
              <tr>
                  <td class=titre_principal> <br> $titre_tableau <br></td>
              </tr>
              <tr><td valign=\"middle\">  $tableau_fiche </td></tr>
          </table>
          ";
    }
    echo "
    </form>
";

    /*     * **********
      Fin Code HTML
     * ********** */
}
/* * *********************
  Inclusion de fin de page
 * ********************* */
include ("../lib/fin_page.inc");
?>

