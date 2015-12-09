<?php

/*
 * Copyright (C) 2015 bs4300280
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Description of TableauFicheView
 *
 * @author bs4300280
 */
class TableauFicheView {

    const HTML_CELL_WIDTH_C1 = " width=34%";
    const HTML_CELL_WIDTH_C3 = " width=16%";
    const HTML_CELL_WIDTH_SELECTION = " width=1%";
    const DEFAULT_RESULT_LIMIT_BY_PAGE = "1000";

    static public function getHtmlTable($paramIdFtaEtat, $paramChoix, $paramResultLimitByPage = self::DEFAULT_RESULT_LIMIT_BY_PAGE, $paramOrderCommon = NULL) {

        //Attention, double signification, si choix = 0 ou -1, alors il s'agit en fait de $id_fta
        $paramIdFtaEtat;


        /*
         * Déclaration de variables
         */
        $largeur_html_C1 = self::HTML_CELL_WIDTH_C1; // largeur cellule type
        $largeur_html_C3 = self::HTML_CELL_WIDTH_C3; // largeur cellule type
        $compteur_ligne = 1;
        $selection_width = self::HTML_CELL_WIDTH_SELECTION;
        //$id_fta_chapitre_encours = Lib::isDefined("id_fta_chapitre_encours");
        //$javascript = Lib::isDefined("javascript");
        //$synthese_action = Lib::isDefined("synthese_action");
        //$abreviation_fta_etat = $_SESSION["abreviation_fta_etat"];

        /*
         * Initilisation
         */
        $globalConfig = new GlobalConfig();
        UserModel::checkUserSessionExpired($globalConfig);
        $idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
        $idFtaRole = FtaRoleModel::getKeyNameOfFirstRoleByIdUser($idUser);

        if ($idFtaRole == NULL) {
            $idFtaRole = FtaRoleModel::ID_FTA_ROLE_COMMUN;
        }

//        if ($paramResultLimitByPage != NULL) {
//            $limit = "LIMIT 0,$paramResultLimitByPage";
//        } else {
//            $limit = "";
//        }

        $modelfta = new FtaModel("4");



        /*
          Sélection de la requête source en fonction du choix de visualisation
          --------------------------------------------------------------------
         */

        switch ($paramChoix) {
            //Synthèse des fiches
            case 1:

                //Récupération du site d'attachement de l'utilisateur
                //                $_SESSION["id_geo"] = $_SESSION["lieu_geo"];
                //                $id_geo = $_SESSION["id_geo"];
                //mysql_table_load("geo");
                //$recordsetGeo = new DatabaseRecordset("geo", $id_geo);
                //ToDo: voir pourquoi lors du premier passage, $id_site est vide !!
                //$id_site=Lib::isDefined("id_site",$_SESSION["id_geo"]);
                //$id_site = Lib::isDefined("id_site");
                $id_site = $modelfta->getModelSiteExpedition()->getDataField(GeoModel::KEYNAME)->getFieldValue();



                //Liste des suivis de projet que doit gérer l'utilisateur suivant l'état
                //$_SESSION["id_fta_etat"] = $paramIdFtaEtat;
                //switch($abreviation_etat)
                //Premier processus ?
                //if ($_SESSION["fta_definition"]) {
                //$having = "";
                //} else {
                //$having = "HAVING MIN(suivi_precedent.signature_validation_suivi_projet)<>0 ";
                //}
                //Récupération des listes des processus que gère l'utilisateur
                $where_processus = "AND ( ";
                $where_processus_cycle = "AND ( ";
                $where_processus_OP = "";    //Opérateur SQL

                $where_Site_de_production = "( Site_de_production=$id_site "
                        //. "OR Site_de_production IS NULL "
                        . "OR Site_de_production=0 "
                //. "OR Site_de_production=\"\" "
                ;
                $where_Site_de_production_OP = "";    //Opérateur SQL

                /*
                  $req = "SELECT DISTINCT fta_processus.id_fta_processus, multisite_fta_processus "
                  . "FROM `intranet_modules`, `intranet_droits_acces`, `intranet_actions`, `fta_processus` , fta_action_role, fta_workflow_structure "
                  . "WHERE ( `intranet_modules`.`id_intranet_modules` = `intranet_droits_acces`.`id_intranet_modules` " //Liaison
                  . "AND `fta_workflow_structure`.`id_fta_role` = `fta_processus`.`id_fta_role` "
                  . "AND `fta_workflow_structure`.`id_fta_processus` = `fta_processus`.`id_fta_processus` "
                  . "AND `fta_workflow_structure`.`id_fta_role` = `fta_action_role`.`id_fta_role` "
                  . "AND `intranet_actions`.`id_intranet_actions` = `fta_action_role`.`id_intranet_actions` ) "       //Liaison
                  . "AND ( ( `intranet_droits_acces`.`id_user` = " . $idUser . " "
                  . "AND `intranet_droits_acces`.`niveau_intranet_droits_acces` > 0 ))"
                  ;
                 */
                //echo $req;
                //$result_processus = DatabaseOperation::query($req);
                $result_processus = FtaProcessusModel::getSqlResultAuthorizedProcessusByUser($idUser);

                //L'utilisateur gère-t-il des processus ?
                if (mysql_num_rows($result_processus)) {
                    //echo "test";
                    while ($rows = mysql_fetch_array($result_processus)) {
                        $where_processus .= "$where_processus_OP chapitre_encours.id_fta_processus=" . $rows["id_fta_processus"] . " ";
                        $where_processus_OP_before = "AND";    //Opérateur SQL
                        $where_processus_before .= $where_processus_OP_before . " chapitre_precedent.id_fta_processus<>" . $rows["id_fta_processus"] . " ";
                        $where_processus_cycle .= "$where_processus_OP id_next_fta_processus=" . $rows["id_fta_processus"] . " ";
                        $where_processus_OP = "OR";    //Opérateur SQL

                        $isMonoSite = 0;       //Permet de savoir si il y a aumoins un processus mono site
//echo $test;
//echo "test1: ".$rows["multisite_fta_processus"]." / ".$isMonoSite."<br>";
//Dans le cas d'un processus multisite, récupération des déléguations de site
//Récupération des sites gérés par l'utilisateur
                        if ($rows["multisite_fta_processus"] == 1 and $isMonoSite == 0) {
//echo "test1: ".$rows["multisite_fta_processus"]." / ".$isMonoSite."<br>";
//$where_Site_de_production_OK=1;
                            $req = "SELECT id_site_assemblage_fta_processus_multisite "
                                    . "FROM fta_processus_multisite "
                                    . "WHERE id_processus_fta_processus_multisite=" . $rows["id_fta_processus"] . " "
                                    . "AND id_site_processus_fta_processus_multisite=" . $id_site
                            ;
//echo $req;
                            $result_site = DatabaseOperation::query($req);

//Existe-il au moins un site ?
                            if (mysql_num_rows($result_site)) {
//Récupération de la liste dans un tableau
                                while ($rows_site = mysql_fetch_array($result_site)) {
                                    $tab_site[] = $rows_site["id_site_assemblage_fta_processus_multisite"];
                                }

//Analyse et mise en forme du tableau de site pour une exploitation en tant que critère de clause WHERE
                                $tab_site = array_unique($tab_site);
                                foreach ($tab_site as $current_site) {
                                    $where_Site_de_production_OP = "OR";    //Opérateur SQL
                                    $where_Site_de_production .= "$where_Site_de_production_OP Site_de_production=" . $current_site . " ";
                                }
                            } else { //Sinon, c'est qu'il n'y a pas de site de production supplémentaire
                            }//Fin d'existe-il au moins un site ?
                        } else { //Il s'agit d'un processus mono-site
                            $isMonoSite = 1;

//Dans ce cas, l'utilisateur voit tous les sites.
                            $where_Site_de_production = " ( 1 ";
                        }//Fin des processus multisite
                    }//Fin des processus
                } else { //Sinon, c'est que l'utilisateur ne gère aucun processus (cas d'utilisateur en mode consultation)
//Vision de l'utilisateur est restreint à son site de rattachement (+ site délégué)
//             $_SESSION["id_geo"]=$_SESSION["lieu_geo"];
//             mysql_table_load("geo");
//             $id_site=$_SESSION["id_site"];
//             //$where_Site_de_production .= " AND (access_arti2.Site_de_production = $id_site ";
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
                        $where_Site_de_production.= "OR fta.Site_de_production = " . $rows["id_site_assemblage_fta_processus_multisite"] . " ";
                    }

                    $where_processus.= "1";
                    $where_processus_cycle.= "1";
                }//Fin de la recherche des processus
//Finalisation de la mise en forme de la clause WHERE
                $where_processus.= ")";
                $where_processus_cycle.= ")";
                $where_Site_de_production.=") ";

                $AND_where_Site_de_production = "AND " . $where_Site_de_production;
                $OR_where_Site_de_production = "OR " . $where_Site_de_production;





//Composant commun des requêtes
//$select_common=", id_classification_arborescence_article, fta_etat.*, access_arti2.*";
                /*
                  $select_common = ", abreviation_fta_etat, LIBELLE, NB_UNIT_ELEM, Poids_ELEM, suffixe_agrologic_fta, designation_commerciale_fta, "
                  . "id_dossier_fta, id_version_dossier_fta, id_article_agrologic "
                  ;
                 */
                $select_common = "";
                $from_common = "fta LEFT JOIN classification_fta ON classification_fta.id_fta=fta.id_fta, fta_etat, fta_processus_cycle ";
//$from_common="fta LEFT JOIN classification_fta ON classification_fta.id_fta=fta.id_fta, access_arti2";
                $where_common = "AND fta.id_fta_etat=fta_etat.id_fta_etat "
//. "AND fta.id_fta=access_arti2.id_fta "
                        . "AND fta.id_fta_etat=\"" . $_SESSION["id_fta_etat"] . "\" "
                        . "AND `fta`.`id_fta_workflow`=`fta_processus_cycle`.`id_fta_workflow` "
                        . "AND `fta_processus_cycle`.`id_init_fta_processus`=`fta_processus`.`id_fta_processus` "
                ;
//$where_common="fta.id_fta=access_arti2.id_fta";
//Classement
                if (!$paramOrderCommon) { //Classement demandé par l'utlisateur
                    $paramOrderCommon = "suffixe_agrologic_fta, id_article_agrologic, id_classification_arborescence_article";
                }


                switch ($synthese_action) {

                    case "encours":
                        $ok = 1;
                        $bgcolor = "";
//echo $_SESSION["abreviation_fta_etat"];
//Récupération des suivis de projet gérés par l'utilisateur et pas encore validé
                        $req = "SELECT DISTINCT fta.id_fta AS id_fta "
                                . $select_common
//. ", fta.*, access_arti2.* "
//. ", fta.* "
//. ", suivi_encours.id_fta_suivi_projet "
//. ", suivi_precedent.id_fta_suivi_projet "
//. ", MIN(suivi_precedent.signature_validation_suivi_projet) "
//. ", suivi_precedent.signature_validation_suivi_projet "
//. ", suivi_encours.* "
//. ", suivi_precedent.* "
//. ",id_next_fta_processus "
                                . "FROM fta_suivi_projet as suivi_encours, "
                                . "fta_chapitre as chapitre_encours, "
                                . "fta_suivi_projet as suivi_precedent, "
                                . "fta_workflow_structure as chapitre_precedent, "
                                . "`fta_processus`, "
//. "access_arti2, "
//. "fta_processus_cycle "
//. ", fta_etat "
                                . " $from_common "
                                . "WHERE suivi_encours.id_fta_chapitre=chapitre_encours.id_fta_chapitre "    //Liaison
//. "AND suivi_encours.id_fta=access_arti2.id_fta "                        //liaison
                                . "AND suivi_encours.id_fta=fta.id_fta "                                 //Liaison
                                . "AND suivi_precedent.id_fta=fta.id_fta "                                 //Liaison
                                . "AND suivi_precedent.id_fta_chapitre=chapitre_precedent.id_fta_chapitre "  //Liaison
//. "AND fta.id_fta_etat=fta_etat.id_fta_etat "                                //Liaison
                                . "$where_common "
                                . "$where_processus "                                                   //Appartenant à un Processus géré par l'utilisateur
                                . "$AND_where_Site_de_production "
                                . "$where_processus_cycle "
                                . "AND fta_processus_cycle.id_init_fta_processus=chapitre_precedent.id_fta_processus "
                                . "AND suivi_encours.signature_validation_suivi_projet=0 "                                //Chapitre pas encore validé
                                . "AND id_etat_fta_processus_cycle=\"" . $modelfta->getModelFtaEtat()->getDataField(FtaEtatModel::FIELDNAME_ABREVIATION)->getFieldValue() . "\" "             //Cycle Initialisation par défaut
//. "AND abreviation_fta_etat=\"".$_SESSION["abreviation_fta_etat"]."\" "
//. "AND suivi_encours.id_fta_suivi_projet=suivi_precedent.id_fta_suivi_projet "
//. "AND suivi_precedent.signature_validation_suivi_projet<>0 "
                                . "AND (1 $where_processus_before)"
                                . "GROUP BY fta.id_fta  "
                                . $having
//. "GROUP BY suivi_encours.id_fta_suivi_projet "
//. "OR chapitre_encours.id_fta_processus=1 "
//. "OR suivi_precedent.id_fta_suivi_projet IS NULL"
                                . "ORDER BY $paramOrderCommon "
                        ;

                        $result_liste = DatabaseOperation::query($req);
//echo $req;
                        break;

                    case "attente":
                        $ok = 0;
                        $bgcolor = "bgcolor=#A5A5CE ";

//Distinction entre le En cours et le En attente
//Par rapport aux suivi de projets gérés, récupération des processus
                        $where_processus;

//Par rapport à ces processus, récupération des processus précédents
//et vérification qu'au moins un des chapitres précédent n'est pas validé
//$req = "SELECT DISTINCT fta.*, fta.id_fta AS id_fta "
                        $req = "SELECT DISTINCT fta.id_fta AS id_fta "
                                . $select_common
                                . "FROM fta_suivi_projet, fta_chapitre, `fta_processus` "
                                . ", $from_common "
                                . "WHERE id_etat_fta_processus_cycle=\"I\" "                                //Cycle Initialisation par défaut
                                . "AND fta_suivi_projet.id_fta_chapitre=fta_chapitre.id_fta_chapitre "      //Liaison
                                . "AND id_init_fta_processus=fta_chapitre.id_fta_processus "                //Liaison
                                . "AND fta.id_fta=fta_suivi_projet.id_fta "                                 //Liaison
//. "AND access_arti2.id_fta=fta_suivi_projet.id_fta "                        //Liaison
                                . $where_common
                                . "$where_processus_cycle "
                                . "$AND_where_Site_de_production "
                                . "AND signature_validation_suivi_projet=0 "                                //Chapitre pas encore validé donc FTA en attente
//. "AND abreviation_fta_etat=\"".$_SESSION["abreviation_fta_etat"]."\" "
                                . "ORDER BY $paramOrderCommon "
                        ;
                        $result_liste = DatabaseOperation::query($req);
                        break;

                    case "correction":

//Récupération des suivi de projet
//Récupération des chapitres gérés
//Pour un chapitre donné --> Voir le processus lié
//Pour le processus donné, voir l'accès

                        $ok = 2;
                        $bgcolor = "bgcolor=#AFFF5A";

//FTA dont les chapitres sont tous validés et surlesquels on peut faire une correction
//Par rapport aux suivi de projets gérés, récupération des processus
                        $where_processus;

//Par rapport à ces processus, récupération des processus précédents
//et vérification qu'au moins un des chapitres précédent n'est pas validé
                        /* $req = "SELECT fta.id_fta AS id_fta "
                          . ", fta.*, access_arti2.* "
                          . ", $select_common "
                          //. ", fta_suivi_projet.signature_validation_suivi_projet "
                          //. ", fta_suivi_projet.* "
                          //. ", MIN(fta_suivi_projet.signature_validation_suivi_projet) "
                          . "FROM fta_suivi_projet, fta_chapitre as chapitre_encours, access_arti2 "
                          . ", $from_common "
                          . "WHERE fta_suivi_projet.id_fta_chapitre=chapitre_encours.id_fta_chapitre "      //Liaison
                          . "AND fta.id_fta=fta_suivi_projet.id_fta "                                 //Liaison
                          . "AND access_arti2.id_fta=fta_suivi_projet.id_fta "                        //Liaison
                          . "AND $where_common "
                          . "$where_processus "
                          . "$where_Site_de_production "                                              //Appartenant à un site géré par l'utilisateur
                          . "AND abreviation_fta_etat=\"I\" "
                          . "GROUP BY fta.id_fta "
                          //. "GROUP BY suivi_encours.id_fta_suivi_projet "
                          . "HAVING MIN(fta_suivi_projet.signature_validation_suivi_projet)<>0 "
                          . "ORDER BY $order_common "
                          ; */

                        $req = "SELECT DISTINCT fta.id_fta AS id_fta "
//. ", fta.* "
                                . $select_common
//. ", fta_suivi_projet.* "
//. ", fta_processus_multisite.* "
                                . "FROM `fta_processus` LEFT JOIN `fta_processus_multisite` "
                                . "ON `fta_processus`.`id_fta_processus` = `fta_processus_multisite`.`id_processus_fta_processus_multisite` "
                                . ", `fta_chapitre` as chapitre_encours, `fta_suivi_projet` "
                                . ", $from_common "
                                . "WHERE `chapitre_encours`.`id_fta_chapitre` = `fta_suivi_projet`.`id_fta_chapitre` "
                                . "AND `fta_processus`.`id_fta_processus` = `chapitre_encours`.`id_fta_processus` "
                                . "AND `fta`.`id_fta` = `fta_suivi_projet`.`id_fta` "
//. "AND `access_arti2`.`id_access_arti2` = `fta`.`id_access_arti2`  "
                                . "AND fta_etat.id_fta_etat=fta.id_fta_etat "
                                . "$where_processus "                                                   //Appartenant à un Processus géré par l'utilisateur
                                . $where_common                                                   //Appartenant à un Processus géré par l'utilisateur
//. "AND abreviation_fta_etat=\"".$_SESSION["abreviation_fta_etat"]."\" "
                                . "AND (multisite_fta_processus=0 "
                                . "$OR_where_Site_de_production)"
//. "AND `fta_suivi_projet`.`id_fta` = 1233 "
                                . "GROUP BY fta.id_fta "
                                . "HAVING MIN(fta_suivi_projet.signature_validation_suivi_projet)<>0 "
                                . "ORDER BY $paramOrderCommon "
                        ;
                        $result_liste = DatabaseOperation::query($req);
                        break;


                    case "all": //Toutes les fiches de l'état sélectionné

                        $bgcolor = "bgcolor=#AFFF5A";

                        /*
                          switch($_SESSION["abreviation_fta_etat"])
                          {
                          case "V":
                          $order_common = "date_derniere_maj_fta DESC, suffixe_agrologic_fta, id_article_agrologic, id_classification_arborescence_article";
                          break;

                          default:
                          //$limit = "";
                          }
                         */

//$req = "SELECT fta.id_fta AS id_fta "
                        $select = "SELECT fta.id_fta AS id_fta, date_derniere_maj_fta ";
                        $from = " FROM " . " $from_common ";
                        $where = "WHERE access_arti2.id_fta=fta.id_fta "     //Liaison
                                . $where_common
                                . $AND_where_Site_de_production
                        ;
                        $order = "ORDER BY $paramOrderCommon ";
                        $limit;

                        $req = $select . $from . $where . $order . $limit;

                        $result_liste = DatabaseOperation::query($req);
                        break;
                }

                break;

//Moteur de recherche
            case -1:
            case 0:
                $id_fta = $paramIdFtaEtat;    //Attention, double signification, si choix = 0 ou -1, alors il s'agit en fait de $id_fta
                $ftaModel = new FtaModel($id_fta);
                $paramIdFtaEtat = $ftaModel->getDataField(FtaModel::FIELDNAME_ID_FTA_ETAT)->getFieldValue();
                $where = "fta.id_fta = '$id_fta' ";
                $_SESSION["synthese_action"] = "all";
                $synthese_action = $_SESSION["synthese_action"];

//$req = "SELECT *, fta.id_fta AS id_fta FROM fta, fta_etat, access_arti2 "
                $req = "SELECT fta.id_fta AS id_fta FROM fta, fta_etat "
                        . "WHERE $where "
                        . "AND fta.id_fta_etat = fta_etat.id_fta_etat "
                        . "ORDER BY id_article_agrologic, designation_commerciale_fta ASC "
                ;
//echo $req;
                $result_liste = DatabaseOperation::query($req);
                $bgcolor = -1;  //Déconfiguration du bgcolor, pour forcer sa redéfinition par la suite
                break;
        }
//MASTER REQUETE !!!!!!!!!!!!!
//echo $req."<br><br>";
        $_SESSION["visualiser_fiche_total_fta"] = mysql_num_rows($result_liste);

        /*
          boucle d'affichage des éléments du tableau
          ------------------------------------------
         */

        $tableau_fiches = "<table class=titre width=100% border=0>"
                . "<tr class=titre_principal><td></td><td>"
        ;

//Si aucune demande de classement a été demandé, on sauvegarde L'url initiale
        /* if(!$_GET["isOrdering"])
          {
          $initial_URI = $_SERVER[REQUEST_URI];
          //echo "<br>isOrdering:".$_GET["isOrdering"];
          //echo "<br>order_common:".$_GET["order_common"];

          }
          else //Sinon, on met à jour l'URL avec les critères de tris
          {

          $initial_URI = $_GET["initial_URI"];
          } */
        /*
          print_r($_SERVER);
          echo "<br>";
          echo $_SERVER[REQUEST_URI]."<br>";
          echo $_GET['order_common']."<br>";
          $_GET['order_common']="test";
          $_REQUEST['order_common']="test";
          echo $_GET['order_common']."<br>";
          echo $_SERVER[REQUEST_URI]."<br>";
          print_r($_SERVER);
          echo "<br>";
         */

//Définition des en-têtes de tableau
        switch ($paramChoix) {
            case 1:
            case 0:

//Définition des fonctionnalité de classement
//Par N°de Dossier - version
                $paramOrderCommon = "id_fta";

//Contrôle pour savoir si on est sur l'index du module
                $URL = $_SERVER["REQUEST_URI"];
                if (substr($URL, -1) == "/") {
                    $URL = $URL . "index.php?";
                }

                $tableau_fiches.= "<a href=" . $URL . "&order_common=id_fta><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
                        . "Id"
                        . "</td><td>"
//                      . "<a href=".$URL."&order_common=id_fta><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
//                      . "Class."
//                      . "</td><td>"
//                      . "<a href=".$URL."&order_common=CODE_ARTICLE><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
//                      . "Agrologic"
//                      . "</td><td>"
                        . "<a href=" . $URL . "&order_common=code_article_ldc><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
                        . "Regate"
                        . "</td><td>"
                        /* . "<a href=".$URL."&order_common=designation_commerciale_fta><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
                          . mysql_field_desc("fta", "designation_commerciale_fta")
                          . "</td><td>"
                         */
                        . "<a href=" . $URL . "&order_common=LIBELLE><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
                        . "Désignation"
                ;
                if ($abreviation_fta_etat == "I") {
                    $tableau_fiches .="</td><td>"
                            . "<a href=" . $URL . "&order_common=date_echeance_fta><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
                            . mysql_field_desc("fta", "date_echeance_fta")
                    ;
                }
                $tableau_fiches.= "</td>"
                        . "<td> Actions"
                        . "</td></tr>"
                ;
                break;
            case -1:
                break;
        }
        /**
         * Droits d'actions
         */
        if ($idFtaRole == '1' or $idFtaRole == '6') {
            $valueIsGestionnaire = FtaRoleModel::getValueIsGestionnaire($idFtaRole);
        }


//Parcours des fiches techniques
        while ($rows = mysql_fetch_array($result_liste)) {

//Chargement des données
//$id_fta=$rows["id_fta"];
//$_SESSION["id_fta"]=$id_fta;
//mysql_table_load("fta");
            $req_detail = "SELECT fta.id_fta as id_fta, abreviation_fta_etat, LIBELLE, NB_UNIT_ELEM, Poids_ELEM, suffixe_agrologic_fta, designation_commerciale_fta, "
                    . "id_dossier_fta, id_version_dossier_fta, id_article_agrologic,id_fta_classification2,liste_id_fta_role, "
                    . "code_article_ldc, date_echeance_fta, createur_fta, nom_fta_workflow,fta.id_fta_workflow,geo.geo,Site_de_production "
                    . " FROM fta, fta_etat,fta_workflow,geo "
                    . " WHERE fta.id_fta=" . $rows["id_fta"] . " "
//. "AND fta.id_fta=access_arti2.id_fta "
                    . " AND fta_etat.id_fta_etat=fta.id_fta_etat "
                    . " AND fta_workflow.id_fta_workflow=fta.id_fta_workflow "
                    . " AND geo.id_geo=fta.Site_de_production "
//. "AND fta.createur_fta=salaries.id_user"
            ;
            $result_detail = DatabaseOperation::query($req_detail);

//Chargement manuel des données pour optimiser les performances
            $id_fta = mysql_result($result_detail, 0, "id_fta");
            $abreviation_fta_etat = mysql_result($result_detail, 0, "abreviation_fta_etat");
            $LIBELLE = mysql_result($result_detail, 0, "LIBELLE");
            $NB_UNIT_ELEM = mysql_result($result_detail, 0, "NB_UNIT_ELEM");
            $Poids_ELEM = mysql_result($result_detail, 0, "Poids_ELEM");
            $suffixe_agrologic_fta = mysql_result($result_detail, 0, "suffixe_agrologic_fta");
            $designation_commerciale_fta = mysql_result($result_detail, 0, "designation_commerciale_fta");
            $id_dossier_fta = mysql_result($result_detail, 0, "id_dossier_fta");
            $id_version_dossier_fta = mysql_result($result_detail, 0, "id_version_dossier_fta");
            $id_article_agrologic = mysql_result($result_detail, 0, "id_article_agrologic");
            $code_article_ldc = mysql_result($result_detail, 0, "code_article_ldc");
            $dateEcheanceFta = mysql_result($result_detail, 0, "date_echeance_fta");
            $createur_fta = mysql_result($result_detail, 0, "createur_fta");
            $workflowName = mysql_result($result_detail, 0, FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW);
            $idWorkflowFtaEncours = mysql_result($result_detail, 0, FtaWorkflowModel::KEYNAME);
            $nomSiteProduction = mysql_result($result_detail, 0, GeoModel::FIELDNAME_GEO);
            $idclassification = mysql_result($result_detail, 0, FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2);
            $listeIdFtaRole = mysql_result($result_detail, 0, FtaModel::FIELDNAME_LISTE_ID_FTA_ROLE);
            $idSiteDeProduction = mysql_result($result_detail, 0, FtaModel::FIELDNAME_SITE_ASSEMBLAGE);

            /**
             * On obtient IdintranetAction du site de production
             */
            $idIntranetActionsSiteDeProduction = FtaActionSiteModel::getIdIntranetActionByWorkflowAndSiteDeProduction($idWorkflowFtaEncours, $idSiteDeProduction);

            $checkAccesButton = IntranetActionsModel::getIdFtaWorkflowAndSiteDeProduction($idUser, $idWorkflowFtaEncours, $idIntranetActionsSiteDeProduction);

            /**
             * Liste des processus pouvant être validé
             */
            $arrayProcessusValidation = FtaProcessusCycleModel::getArrayProcessusValidationFTA($idWorkflowFtaEncours);


            /**
             * Listes des processus auxquel l'utilisateur connecté à les droits d'accès
             */
            $arrayProcessusAcces = FtaWorkflowStructureModel::getArrayProcessusByRoleAndWorkflow($idFtaRole, $idWorkflowFtaEncours);
            $accesTransitionButton = is_null(array_intersect($arrayProcessusValidation, $arrayProcessusAcces));

//Récupération du nom du création
            $req = "SELECT prenom, nom FROM salaries WHERE id_user='" . $createur_fta . "' ";
            $result_createur_fta = DatabaseOperation::query($req);
            if (mysql_num_rows($result_createur_fta)) {
                $createur_nom = mysql_result($result_createur_fta, 0, "nom");
                $createur_prenom = mysql_result($result_createur_fta, 0, "prenom");
            }

//if ($choix ==1)

            $lien = "";

//Redéfinition du bgcolor si demandé
            if ($bgcolor == -1) {
                switch ($abreviation_fta_etat) {
                    case "I":
                        $bgcolor = "";
                        break;
                    case "V":
                        $bgcolor = "bgcolor=#AFFF5A";
                        break;
                    default:
                        $bgcolor = "bgcolor=#A5A5CE ";
                }
            }
            $bgcolor_header = "";

            /*
              Analyse des Processus en cours et détermination du flag de controle $ok
              -----------------------------------------------------------------------
              0: En attente, Il reste au moins un processus en cours, mais l'utilisateur n'en est pas propriétaire
              1: En cours, Il reste au moins un processus en cours, et l'utilsiateur en est propriétaire
              2: Effectué, Il n'y a plus de processus en cours en donc la FTA est prête à être transité
             */
//echo "test".$id_fta;

            /* if(//Doit-on afficher cette fiche ?
              ($_SESSION["synthese_action"]=="attente" and $ok==0) or
              ($_SESSION["synthese_action"]=="correction" ) or
              ($_SESSION["synthese_action"]=="encours" and $ok<>0) or
              ($_SESSION["synthese_action"]=="all")
              )
              { */
//Calcul préalable et Etat d'avancement
//if($_SESSION["synthese_action"]<>"all")
            $ftaModel = new FtaModel($id_fta);
            $taux_temp = FtaSuiviProjetModel::getFtaTauxValidation($ftaModel, FALSE);
            $recap[$id_fta] = round($taux_temp[0] * 100, 0) . "%";
//            $lien .= "<h5>" . $recap[$id_fta] . "<a "
//                    . "href=historique.php"
//                    . "?id_fta=$id_fta"
//                    . "&synthese_action=$synthese_action"
//                    . "&id_fta_etat=" . $id_fta_etat
//                    . "&abreviation_fta_etat=" . $abreviation_fta_etat
//                    . "&id_fta_role=" . $idFtaRole
//                    . "&comeback=1"
//                    . "><img src=./images/graphique.png alt=\"\" title=\"Etat d'avancement\" width=\"30\" height=\"25\" border=\"0\" />"
//                    . "</a>"
//            ;
            /**
             * Lien vers l'historique de la Fta
             */
            if ($abreviation_fta_etat <> FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                $lienHistorique = ' <a href=historique-' . $id_fta
                        . '-1'
                        . '-' . $paramIdFtaEtat
                        . '-' . $abreviation_fta_etat
                        . '-' . $idFtaRole
                        . '-' . $synthese_action
                        . '-1'
                        . '.html >' . $recap[$id_fta] . '</a>';
            } else {
                if ($checkAccesButton) {
                    $lienHistorique = ' <a href=historique-' . $id_fta
                            . '-1'
                            . '-' . $paramIdFtaEtat
                            . '-' . $abreviation_fta_etat
                            . '-' . $idFtaRole
                            . '-' . $synthese_action
                            . '-1'
                            . '.html >' . $recap[$id_fta] . '</a>';
                }
            }
//Gestion des délais
            if ($abreviation_fta_etat == "I") { {
                    $HTML_date_echeance_fta = FtaProcessusDelaiModel::getFtaDelaiAvancement($id_fta);
//$return["status"]
//    0: Aucun dépassement des échéances
//    1: Au moins un processus en cours a dépassé son échéance
//    2: La date d'échéance de validation de la FTA est dépassée
//    3: Il n'y a pas de date d'échéance de validation FTA saisie
//$return["liste_processus_depasses"][$id_processus]
//    Renvoi un tableau associatif contenant:
//    - la listes des processus en cours ayant dépassé leur échéance
//    - leur date d'échéance
//$return["HTML_synthese"]
//    Contient le code source HTML utilisé pour la fonction visualiser_fiches()
//echo $HTML_date_echeance_fta["status"];

                    switch ($HTML_date_echeance_fta["status"]) {
                        case 1:
                            $bgcolor_header = $bgcolor;
                            $icon_header = "<img src=../lib/images/exclamation.png title='Certaines échéances sont dépassées !' width=30 height=27 border=0 />";
                            break;
                        case 2:
                            $bgcolor_header = "class=couleur_rouge";
                            $icon_header = "<img src=../lib/images/exclamation.png title='Certaines échéances sont dépassées !' width=30 height=27 border=0 />";
                            break;
                        default:
//$bgcolor_header = $bgcolor;
                            $icon_header = "";
                    }
                }
                /* else
                  {
                  $bgcolor_header = $bgcolor;
                  $icon_header = "";
                  } */
            }

//Droit de consultation standard HTML
            if (
                    (Acl::getValueAccesRights("fta_modification"))
                    or ( Acl::getValueAccesRights("fta_consultation") and $abreviation_fta_etat == FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE )
            ) {
                if ($abreviation_fta_etat <> FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                    $lien .= '<a '
//                            . 'href=#'
                            . 'href=modification_fiche.php'
                            . '?id_fta=' . $id_fta
                            . '&synthese_action=' . $synthese_action
                            . '&comeback=1'
                            . '&id_fta_etat=' . $paramIdFtaEtat
                            . '&abreviation_fta_etat=' . $abreviation_fta_etat
                            . '&id_fta_role=' . FtaRoleModel::ID_FTA_ROLE_COMMUN
                            . ' /><img src=../lib/images/next.png alt=\'\' title=\'Voir la FTA\' width=\'30\' height=\'25\' border=\'0\' />'
                            . '</a>'
                    ;
                } else {
                    if ($checkAccesButton) {
                        $lien .= '<a '
//                            . 'href=#'
                                . 'href=modification_fiche.php'
                                . '?id_fta=' . $id_fta
                                . '&synthese_action=' . $synthese_action
                                . '&comeback=1'
                                . '&id_fta_etat=' . $paramIdFtaEtat
                                . '&abreviation_fta_etat=' . $abreviation_fta_etat
                                . '&id_fta_role=' . FtaRoleModel::ID_FTA_ROLE_COMMUN
                                . ' /><img src=../lib/images/next.png alt=\'\' title=\'Voir la FTA\' width=\'30\' height=\'25\' border=\'0\' />'
                                . '</a>'
                        ;
                    }
                }
                /**
                 * Version avec le module rewrite
                 */
//                    $lien .= '<a '
////                            . 'href=#'
//                            . 'href=modification_fiche'
//                            . '-' . $id_fta
//                            . '-' . $synthese_action
//                            . '-1'
//                            . '-' . $id_fta_etat
//                            . '-' . $abreviation_fta_etat
//                            . '-' . $idFtaRole
////                            . ' onClick=\'modification_fiche_' . $idFta . '();\' '
//                            . '.html /><img src=../lib/images/next.png alt=\'\' title=\'Voir la FTA\' width=\'30\' height=\'25\' border=\'0\' />'
//                            . '</a>'
                ;
            }



//Export PDF
//echo "test".$rows["abreviation_fta_etat"];
            if (
                    (Acl::getValueAccesRights("fta_impression") and ( $abreviation_fta_etat == FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE ))
                    or ( $_SESSION["mode_debug"] == 1)or ( $workflowName == 'presentation')
            ) {

                $lien .= "  "
                        . "<a "
                        . "href=pdf.php?id_fta=" . $id_fta . "&mode=client "
                        . "target=_blank"
                        . "><img src=./images/pdf.png alt=\"\" title=\"Exportation PDF\" width=\"30\" height=\"25\" border=\"0\" />"
                        . "</a>"
                ;
            }
//echo $taux_temp[0]." ".$_SESSION["fta_article"]."<br>";
//Transiter

            if (
                    (($idFtaRole == '1' or $idFtaRole == '6' ) and $recap[$id_fta] == '100%' and $checkAccesButton )
                    and Acl::getValueAccesRights("fta_modification") and ( $abreviation_fta_etat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION)
                    or ( $ok == '2' and $accesTransitionButton == FALSE && $recap[$id_fta] == '100%' and $checkAccesButton )
                    or ( $synthese_action == FtaEtatModel::ETAT_AVANCEMENT_VALUE_ALL AND ( $idFtaRole == '1' or $idFtaRole == '6' ) and $checkAccesButton and $abreviation_fta_etat <> FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION )
                    or ( ($idFtaRole == '1' or $idFtaRole == '6' ) and $synthese_action == FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES and $checkAccesButton )
            ) {
                $lien .= '<a '
                        . 'href=transiter.php'
                        . '?id_fta=' . $id_fta
                        . '&id_fta_role=' . $idFtaRole
                        . '><img src=./images/transiter.png alt=\'\' title=\'Transiter\' width=\'30\' height=\'30\' border=\'0\' />'
                        . '</a>'
                ;
                if ($synthese_action == FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES and $recap[$id_fta] == '100%') {
                    $selection = '<input type=\'checkbox\' name=selection_fta value=\'' . $id_fta . '\' checked />';
                    $traitementDeMasse = '1';
                    $selection_width = '2%';
                    $StringFta .= $id_fta . ',';
                    $tableau_fiches .= '<input type=hidden name=arrayFta value=' . $StringFta . '>';
                }
//<a target="_parent" href="index"></a>
            }



            /* //Modifier les processus en cours
              if($ok<>2)
              {
              $lien .= "<a "
              . "href=modification_fiche.php"
              . "?id_fta=".$rows["id_fta"]
              . "&synthese_action=$synthese_action"
              . "><img src=../lib/images/next.png alt=\"\" title=\"Modifier le Dossier Technique\" width=\"25\" height=\"25\" border=\"0\" />"
              . "</a>"
              ;
              } */

            /*
             * Action que seul les Chefs de projet peuvent faire
             */
            /*
             * Retirer une FTA en cours de modification
             */
            if ($valueIsGestionnaire == '1') {
                if ($checkAccesButton) {
                    if ($abreviation_fta_etat <> FtaEtatModel::ETAT_ABREVIATION_VALUE_RETIRE) {
                        $lien .= '<a '
                                . 'href=# '
                                . 'onClick=confirmation_correction_fta' . $id_fta . '(); '
                                . '/>'
                                . '<img src=../lib/images/supprimer.png alt=\'Retirer cette FTA\' width=\'25\' height=\'25\' border=\'0\' />'
                                . '</a>'
                        ;
                        $javascript.='
                           <SCRIPT LANGUAGE=JavaScript>
                                   function confirmation_correction_fta' . $id_fta . '()
                                   {
                                   if(confirm(\'Etes vous certain de vouloir retirer cette Fiche Technique ? Les autres fiches du dossier resteront indem.\'))
                                   {
                                       location.href =\'transiter.php?id_fta=' . $id_fta . '&id_fta_role=' . $idFtaRole . '&synthese_action=' . $synthese_action . '&action=correction&demande_abreviation_fta_transition=R\'
                                   }
                                    else{}
                                   }
                           </SCRIPT>
                           ';
                    }
                }
                if ($abreviation_fta_etat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                    if ($checkAccesButton) {
                        $lien .= '<a '
                                . 'href=creer_fiche.php'
                                . '?action=dupliquer_fiche'
                                . '&id_fta=' . $id_fta
                                . '&id_fta_role=' . $idFtaRole
                                . '><img src=../lib/images/copie.png alt=\'\' title=\'Dupliquer\' width=\'30\' height=\'30\' border=\'0\' />'
                                . '</a>'
                        ;
                    }
                } else {
                    $lien .= '<a '
                            . 'href=creer_fiche.php'
                            . '?action=dupliquer_fiche'
                            . '&id_fta=' . $id_fta
                            . '&id_fta_role=' . $idFtaRole
                            . '><img src=../lib/images/copie.png alt=\'\' title=\'Dupliquer\' width=\'30\' height=\'30\' border=\'0\' />'
                            . '</a>'
                    ;
                }
            }


//construction des lignes et des colonnes
//if($ok)
//Si accès la fiche
//Récupération du propriétaire
//$id_fta=$rows["id_fta"];
//        $id_element = 1;    //Propriétaire
//        $extension[0] = 1;
//        $temp = recherche_element_classification_fta($id_fta, $id_element, $extension);
//Récupération de la marque
//        $id_element = 2;  //Marque
//        $extension[0] = 1;
//        $temp2 = recherche_element_classification_fta($id_fta, $id_element, $extension);
//Désignation commerciale
            if (strlen($designation_commerciale_fta) > 55) {
                $designation_commerciale_fta = substr($designation_commerciale_fta, 0, 52) . "...";
            }
            if ($LIBELLE) {
                $din = $LIBELLE;
            } else {
                $din = $designation_commerciale_fta;

                if ($temp2[2]) {
                    $din .= " (" . $temp[2] . " " . $NB_UNIT_ELEM . " x " . $Poids_ELEM . "Kg)";
                }
                $din = "<font size=\"1\" color=\"#808080\"><i>$din</i></font>";
            }
//        /*
//         * Initialisation des valeurs pour un commentaire
//         */
//        $ftaModel = new FtaModel($id_fta);
//        $commentaireDataField = $ftaModel->getDataField(FtaModel::FIELDNAME_COMMENTAIRE);
//        $htmlField = html::getHtmlObjectFromDataField($commentaireDataField);
//        $htmlField->setHtmlRenderToTable();
//        $htmlField->setIsEditable(TRUE);
//        $commentaire = $htmlField->getHtmlResult();

            /*
             * Noms des services dans lequel la Fta se trouve
             */
//                $service = FtaRoleModel::getListeIdFtaRoleEncoursByIdFta($idFta, $idWorkflowFtaEncours);

            if ($abreviation_fta_etat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                if ($checkAccesButton) {
                    $service = FtaRoleModel::getNameServiceEncours($listeIdFtaRole);
                }
            } else {
                $service = FtaRoleModel::getNameServiceEncours($listeIdFtaRole);
            }
            /**
             * Calssification
             */
            if ($idclassification) {
                $classification = ClassificationArborescenceArticleCategorieContenuModel::getElementClassificationFta($idclassification, ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE);
            }

//Nom de l'assistante de projet responsable:
            $createur_link = "\"Géré par $createur_prenom $createur_nom\"";

            $tableau_fiches.= "<tr class=contenu>
                              <td $bgcolor_header " . $selection_width . " > $icon_header $selection</td>
                              ";
            $tableau_fiches.= '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '</td>'//Site
                    . '<td ' . $bgcolor . ' width=6%>' . $classification . '</td>'//Client
                    . '<td ' . $bgcolor . ' width=6%>' . $suffixe_agrologic_fta . '</td>'; // Raccourcie Class.
//$tableau_fiches.="<td $bgcolor $largeur_html_C1>".stripslashes($designation_commerciale_fta)."</td>";
            $tableau_fiches.="<td $bgcolor $largeur_html_C1><a title=$createur_link />" . $din . "</a></td>"
                    . "<td $bgcolor width=3%>" . $id_dossier_fta . "<br>v" . $id_version_dossier_fta . "</td>";

            $tableau_fiches.="<td $bgcolor width=\"6%\"> <b><font size=\"2\" color=\"#0000FF\">" . $code_article_ldc . "</font></b></td>";
            if ($abreviation_fta_etat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                $tableau_fiches.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
            } else {
                $tableau_fiches.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
            }
            $tableau_fiches .= '<td ' . $bgcolor . ' width=5% align=center >' . $lienHistorique . '</td>'//% Avancement FTA
                    . '<td ' . $bgcolor . $largeur_html_C3 . ' align=center >' . $service . '</td>' //Service               
                    . '<td ' . $bgcolor . ' width=10%px ' . ' align=center >' . $lien . '</td>'; // Actions
//        $tableau_fiches.="<td $bgcolor $largeur_html_C3 align=\"right\" valign=\"middle\">$lien</td>";
            $tableau_fiches.="</tr>";
            $compteur_ligne++;
        }//fin tant que tableau_origine
        $tableau_fiches = $javascript . $tableau_fiches . "</table>";

//Ajoute de la fonction de traitement de masse
        if ($traitementDeMasse) {
            $liste_action_groupe = FtaTransitionModel::getListeFtaGrouper($abreviation_fta_etat);

            $tableau_fiches.= '&nbsp;
            <img src = ../lib/images/fleche_gauche_et_haut.png width = 38 height = 22 border = 0 />
            <i>Transitions groupées</i>:
            ' . $liste_action_groupe . '
            <input type = \'text\' name=\'subject\' size=\'20\' />
            <input type=image src=images/transiter.png width=20 height=20 />
            <input type=hidden name=action value=transition_groupe>
                         ';
        }

        return $tableau_fiches;
    }

}
