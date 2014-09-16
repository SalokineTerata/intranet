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


/* * ***********
  Début Code PHP
 * *********** */
if ($_SESSION["id_user"]) {
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
    $recordsetFtaEtat = new DatabaseRecord("fta_etat", $id_fta_etat);

//$receivedKey["id_fta_etat"] = $id_fta_etat;
//$record_fta_etat = new Database("fta_etat", $receivedKey);
//$nom_fta_etat=$record_fta_etat->getValue("nom_fta_etat");
    $nom_fta_etat_encours = $recordsetFtaEtat->getFieldValue("nom_fta_etat");

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

    //L'utilisateur possède-t-il au moins un processus monosite ?
    if ($_SESSION["id_user"]) {
        $req_multisite = "SELECT `intranet_droits_acces`.`id_user` "
                . "FROM `intranet_modules`, `intranet_droits_acces`, `intranet_actions`, `fta_processus` "
                . "WHERE ( `intranet_modules`.`id_intranet_modules` = `intranet_droits_acces`.`id_intranet_modules` "
                . "AND `intranet_actions`.`id_intranet_actions` = `intranet_droits_acces`.`id_intranet_actions` "
                . "AND `intranet_actions`.`id_intranet_actions` = `fta_processus`.`id_intranet_actions` ) "
                . "AND ( ( `intranet_droits_acces`.`id_user` = " . $_SESSION["id_user"] . " "
                . "AND `fta_processus`.`multisite_fta_processus` = 0 "
                . "AND `intranet_droits_acces`.`niveau_intranet_droits_acces` > 0 ) )"
        ;
        $result_multisite = DatabaseOperation::query($req_multisite);

        //Si ce n'est pas le cas, la vision de l'utilisateur est restreint à son site de rattachement.
        if (!mysql_num_rows($result_multisite)) {
            $_SESSION["id_geo"] = $_SESSION["lieu_geo"];
            mysql_table_load("geo");
            $id_site = $_SESSION["id_site"];
            $req_where .= " AND (access_arti2.Site_de_production = $id_site OR Site_de_production=0 ";

            //Ajout des délégations de processus cf. fta_processus_multisite
            //Selection des processus multisite où l'utilisateur à accès
            $req_deleg = "SELECT id_site_assemblage_fta_processus_multisite "
                    . "FROM `intranet_modules`, `intranet_droits_acces`, `intranet_actions`, `fta_processus`, "
                    . "fta_processus_multisite "
                    . "WHERE ( `intranet_modules`.`id_intranet_modules` = `intranet_droits_acces`.`id_intranet_modules` "
                    . "AND `intranet_actions`.`id_intranet_actions` = `intranet_droits_acces`.`id_intranet_actions` "
                    . "AND `intranet_actions`.`id_intranet_actions` = `fta_processus`.`id_intranet_actions` ) "
                    . "AND ( ( `intranet_droits_acces`.`id_user` = " . $_SESSION["id_user"] . " "
                    . "AND `fta_processus`.`multisite_fta_processus` = 1 "
                    . "AND `intranet_droits_acces`.`niveau_intranet_droits_acces` > 0 ) )"
                    . "AND id_processus_fta_processus_multisite=id_fta_processus "
                    . "AND id_site_processus_fta_processus_multisite= $id_site "
            ;
            $result_deleg = DatabaseOperation::query($req_deleg);
            while ($rows = mysql_fetch_array($result_deleg)) {
                $req_where .= "OR access_arti2.Site_de_production = " . $rows["id_site_assemblage_fta_processus_multisite"] . " ";
            }

            $req_where .= ") ";
        }
    }


    /*
     * @todo: filtrer par catégorie de FTA
     */

    $req = "SELECT COUNT(fta.id_fta) AS nombre_fiche, abreviation_fta_etat, "
            . "nom_fta_etat, fta.id_fta_etat, access_arti2.Site_de_production "
            . "FROM fta, fta_etat, access_arti2 "
            . "WHERE fta_etat.id_fta_etat=fta.id_fta_etat "
            . "AND fta.id_fta=access_arti2.id_fta "
            . "$req_where"
            . "GROUP BY fta.id_fta_etat"
    ;

//}

    $result = DatabaseOperation::query($req);
    $compteur = 1; //permet de tester si on est sur le premier enregistrement de la requète

    $tableau_synthese = "<table class=contenu   width=100% border=0>";
    while ($rows = mysql_fetch_array($result)) {
        //construction du lien d'action visualisation
        $lien = "<a "
                . "href=index.php"
                . "?id_fta_etat=" . $rows["id_fta_etat"]
                . "&nom_fta_etat=" . $rows["abreviation_fta_etat"]
                . "&synthese_action=encours"
                . ">En cours"
                . "</a>"
        ;
        //Cet etat, a-t-il un cycle de vie
        $req = "SELECT id_etat_fta_processus_cycle FROM fta_processus_cycle "
                . "WHERE id_etat_fta_processus_cycle='" . $rows["abreviation_fta_etat"] . "' "
        ;
        $result_cycle = DatabaseOperation::query($req);
        if (mysql_num_rows($result_cycle)) {
            $lien .= " / <a "
                    . "href=index.php"
                    . "?id_fta_etat=" . $rows["id_fta_etat"]
                    . "&nom_fta_etat=" . $rows["abreviation_fta_etat"]
                    . "&synthese_action=attente"
                    . ">En attente"
                    . "</a>"
                    . " / <a "
                    . "href=index.php"
                    . "?id_fta_etat=" . $rows["id_fta_etat"]
                    . "&nom_fta_etat=" . $rows["abreviation_fta_etat"]
                    . "&synthese_action=correction"
                    . ">Effectuées"
                    . "</a>"
            ;
        } else {
            $lien = "<a "
                    . "href=index.php"
                    . "?id_fta_etat=" . $rows["id_fta_etat"]
                    . "&nom_fta_etat=" . $rows["abreviation_fta_etat"]
                    . "&synthese_action=all"
                    . "&isLimit=30"
                    . ">Voir"
                    . "</a>"
            ;
        }

        //construction des lignes et des colonnes
        if ($compteur == 1) {
            $tableau_synthese .="<tr>  <td> A ce jour, il y a :  </td> <td> <b>";

            //Difficulté à mettre à oeuvre pour le Cas I (demande beaucoup de calcul et reisque de ralentissement alors que ce n'est pas vital)
            //if($rows["abreviation_fta_etat"]<> "I") {
            $tableau_synthese .=$rows["nombre_fiche"];

            $tableau_synthese .= "</b> fiches en état "
                    . $rows["nom_fta_etat"]
                    . " <td> &nbsp &nbsp &nbsp $lien </td></td></tr>"
            ;
            $compteur = 2;
        } else {
            $tableau_synthese .="<tr>  <td>                      </td> <td> <b>"
                    . $rows["nombre_fiche"]
                    . " </b> fiches en état "
                    . $rows["nom_fta_etat"]
                    . " <td> &nbsp &nbsp &nbsp $lien </td></td></tr>"
            ;
        }
    } //fin tant que tableau_synthese
    //Recherche des fiches incorrectes
    $req = "SELECT COUNT(id_fta) AS fiche_incorrecte "
            . "FROM fta "
            . "WHERE id_fta_etat=0 "
    ;
    $nombre_incorrecte = DatabaseOperation::query($req);
    while ($rows = mysql_fetch_array($nombre_incorrecte)) {
        if ($rows['fiche_incorrecte']) {
            $tableau_synthese .="<tr><td></td><td bgColor=#FF0000 align=center valign=middle><center><h3><b><b>"
                    . $rows['fiche_incorrecte']
                    . " fiche(s) incorrecte(s) "
                    . " <br>Contacter le service informatique</b></h3></td></td></tr>"
            ;
        }
    }
    $tableau_synthese.="</table>";



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

    if ($synthese_action and !$requete_resultat) {
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

