<?php

/*
 * Copyright (C) 2015 tp4300001
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

class AccueilFta {

    public static function getTableauSythese($paramWhere) {

        /*
         * Initilisation
         */
        $globalConfig = new GlobalConfig();
        $id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();
        $userModel = new UserModel($id_user);
        $lieuGeo = $userModel->getDataField(UserModel::FIELDNAME_LIEU_GEO)->getFieldValue();
        //L'utilisateur possède-t-il au moins un processus monosite ?
        if ($id_user) {
            $arrayDroitAcces = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                            "SELECT DISTINCT " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_USER
                            . " FROM " . IntranetModulesModel::TABLENAME
                            . ", " . IntranetDroitsAccesModel::TABLENAME
                            . ", " . IntranetActionsModel::TABLENAME
                            . ", " . FtaProcessusModel::TABLENAME
                            . ", " . FtaActionRoleModel::TABLENAME
                            . ", " . FtaWorkflowStructureModel::TABLENAME
                            . " WHERE ( " . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME
                            . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
                            . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                            . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                            . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                            . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                            . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                            . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                            . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                            . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                            . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                            . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS . " ) "
                            . " AND ( ( " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_USER
                            . "=" . $id_user . " "
                            . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS . "= 0 "
                            . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . " > 0 ) )"
            );

            /*
             * a tester avec la qualité
             */
            //Si ce n'est pas le cas, la vision de l'utilisateur est restreint à son site de rattachement.
            if (!$arrayDroitAcces) {
                $arrayIdSite = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT " . GeoModel::FIELDNAME_ID_SITE
                                . " WHERE " . GeoModel::KEYNAME . "=" . $lieuGeo
                );
                foreach ($arrayIdSite as $rowsIsSite) {
                    $paramWhere .= " AND (" . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_SITE_ASSEMBLAGE . "=" . $rowsIsSite . " OR " . FtaModel::FIELDNAME_SITE_ASSEMBLAGE . " = 0 ";

                    //Ajout des délégations de processus cf. fta_processus_multisite
                    //Selection des processus multisite où l'utilisateur à accès
                    $arrayDeleg = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                    "SELECT id_site_assemblage_fta_processus_multisite "
                                    . " FROM " . IntranetModulesModel::TABLENAME
                                    . ", " . IntranetDroitsAccesModel::TABLENAME
                                    . ", " . IntranetActionsModel::TABLENAME
                                    . ", " . FtaProcessusModel::TABLENAME
                                    . ", " . FtaActionRoleModel::TABLENAME
                                    . ", " . FtaWorkflowStructureModel::TABLENAME
                                    . ", " . FtaProcessusMultisiteModel::TABLENAME
                                    . "WHERE ( " . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME
                                    . " = " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
                                    . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                    . " = " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                                    . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                                    . " = " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                                    . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                    . " = " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                                    . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                                    . " = " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                    . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                    . " = " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS . ") "
                                    . " AND ( ( " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_USER
                                    . "=" . $id_user . " "
                                    . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS . "= 0 "
                                    . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . " > 0 ) )"
                                    . " AND " . FtaProcessusMultisiteModel::TABLENAME . "." . FtaProcessusMultisiteModel::FIELDNAME_ID_PROCESSUS_FTA_PROCESSUS_MULTISITE . "=" . FtaProcessusModel::KEYNAME
                                    . " AND id_site_processus_fta_processus_multisite =" . $rowsIsSite
                    );
                    foreach ($arrayDeleg as $rowsFta) {
                        $paramWhere .= "OR " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_SITE_ASSEMBLAGE . "=" . $rowsFta["id_site_assemblage_fta_processus_multisite"] . " ";
                    }

                    $paramWhere .= " ) ";
                }
            }

            /*
             * @todo: filtrer par catégorie de FTA
             */
            /*
             * Liste des fta dont l'utilisateur à accès selon ces droits et sa position géographique
             */

            /*
             * requete fausse v2 nous devons avoir le nombre total de fta que l'utilisateur peut voir
             */
            $arrayFta = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                            //  "SELECT COUNT( DISTINCT " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT . " ) AS nombre_fiche "
                            "SELECT COUNT( DISTINCT " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME . " ) AS nombre_fiche "
                            . "," . FtaEtatModel::FIELDNAME_ABREVIATION . "," . FtaEtatModel::FIELDNAME_NOM_FTA_ETAT
                            . "," . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT . "," . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_SITE_ASSEMBLAGE
                            . " FROM " . FtaModel::TABLENAME
                            . "," . FtaEtatModel::TABLENAME
                            . "," . FtaWorkflowModel::TABLENAME
                            . "," . GeoModel::TABLENAME
                            . "," . FtaActionSiteModel::TABLENAME
                            . "," . IntranetActionsModel::TABLENAME
                            . " WHERE " . FtaEtatModel::TABLENAME . "." . FtaEtatModel::KEYNAME
                            . "=" . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT
                            . " AND " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                            . "=" . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                            . " AND " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
                            . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS
                            . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                            . "=" . FtaActionSiteModel::TABLENAME . "." . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                            . " AND " . GeoModel::TABLENAME . "." . GeoModel::FIELDNAME_ID_SITE
                            . "=" . FtaActionSiteModel::TABLENAME . "." . FtaActionSiteModel::FIELDNAME_ID_SITE
//                            . " AND " . GeoModel::TABLENAME . "." . GeoModel::FIELDNAME_ID_SITE
//                            . "=" . $lieuGeo
                            . "$paramWhere"
                            . " GROUP BY " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT
            );

            $compteur = 1; //permet de tester si on est sur le premier enregistrement de la requète

            $tableau_synthese = "<table class = contenu width = 100% border = 0>";
            if ($arrayFta) {
                foreach ($arrayFta as $rowsFta) {
                    //construction du lien d'action visualisation
                    $lien = "<a "
                            . "href=index.php"
                            . "?id_fta_etat=" . $rowsFta[FtaEtatModel::KEYNAME]
                            . "&nom_fta_etat=" . $rowsFta[FtaEtatModel::FIELDNAME_ABREVIATION]
                            . "&synthese_action=encours"
                            . ">En cours"
                            . "</a>"
                    ;
                    //Cet etat, a-t-il un cycle de vie
                    $arrayCycle = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                    "SELECT " . FtaProcessusCycleModel::KEYNAME . " FROM " . FtaProcessusCycleModel::TABLENAME
                                    . " WHERE " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . " = '" . $rowsFta[FtaEtatModel::FIELDNAME_ABREVIATION] . "' "
                    );
                    if ($arrayCycle) {
                        $lien .= " / <a "
                                . "href=index.php"
                                . "?id_fta_etat=" . $rowsFta[FtaEtatModel::KEYNAME]
                                . "&nom_fta_etat=" . $rowsFta[FtaEtatModel::FIELDNAME_ABREVIATION]
                                . "&synthese_action=attente"
                                . ">En attente"
                                . "</a>"
                                . " / <a "
                                . "href=index.php"
                                . "?id_fta_etat=" . $rowsFta[FtaEtatModel::KEYNAME]
                                . "&nom_fta_etat=" . $rowsFta[FtaEtatModel::FIELDNAME_ABREVIATION]
                                . "&synthese_action=correction"
                                . ">Effectuées"
                                . "</a>"
                        ;
                    } else {
                        $lien = "<a "
                                . "href=index.php"
                                . "?id_fta_etat=" . $rowsFta[FtaEtatModel::KEYNAME]
                                . "&nom_fta_etat=" . $rowsFta[FtaEtatModel::FIELDNAME_ABREVIATION]
                                . "&synthese_action=all"
                                . "&isLimit = 30"
                                . ">Voir"
                                . "</a>"
                        ;
                    }

                    //construction des lignes et des colonnes
                    if ($compteur == 1) {
                        $tableau_synthese .="<tr> <td> A ce jour, il y a : </td> <td> <b>";

                        //Difficulté à mettre à oeuvre pour le Cas I (demande beaucoup de calcul et reisque de ralentissement alors que ce n'est pas vital)
                        //if($rows["abreviation_fta_etat"]<> "I") {
                        $tableau_synthese .=$rowsFta["nombre_fiche"];

                        $tableau_synthese .= "</b> fiches en état "
                                . $rowsFta[FtaEtatModel::FIELDNAME_NOM_FTA_ETAT]
                                . " <td> &nbsp &nbsp &nbsp $lien </td></td></tr>"
                        ;
                        $compteur = 2;
                    } else {
                        $tableau_synthese .="<tr> <td> </td> <td> <b>"
                                . $rowsFta["nombre_fiche"]
                                . " </b> fiches en état "
                                . $rowsFta[FtaEtatModel::FIELDNAME_NOM_FTA_ETAT]
                                . " <td> &nbsp &nbsp &nbsp $lien </td></td></tr>"
                        ;
                    }
                }
            } //fin tant que tableau_synthese
            //Recherche des fiches incorrectes
            $arrayFtaFalse = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                            "SELECT COUNT(" . FtaModel::KEYNAME . ") AS fiche_incorrecte "
                            . " FROM " . FtaModel::TABLENAME
                            . " WHERE " . FtaModel::FIELDNAME_ID_FTA_ETAT . " = 0 "
            );

            foreach ($arrayFtaFalse as $rowsFtaFalse) {
                if ($rowsFtaFalse['fiche_incorrecte']) {
                    $tableau_synthese .="<tr><td></td><td bgColor = #FF0000 align=center valign=middle><center><h3><b><b>"
                            . $rowsFtaFalse['fiche_incorrecte']
                            . " fiche(s) incorrecte(s) "
                            . " <br>Contacter le service informatique</b></h3></td></td></tr>"
                    ;
                }
            }
            $tableau_synthese.="</table>";
        }

        return $tableau_synthese;
    }

    public static function getTableauFiche($id_fta_etat, $choix, $isLimit, $order_common) {



//Déclaration de variables
        $largeur_html_C1 = "width=34%"; // largeur cellule type
        $largeur_html_C3 = "width=16%"; // largeur cellule type
        $compteur_ligne = 1;
        $selection_width = "1%";
        $id_fta_chapitre_encours = Lib::isDefined("id_fta_chapitre_encours");
        $javascript = Lib::isDefined("javascript");

//echo $_SESSION["id_fta"]=$id_fta;
        /*
         * Initilisation
         */
        $globalConfig = new GlobalConfig();
        $id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();
        $userModel = new UserModel($id_user);
        $lieuGeo = $userModel->getDataField(UserModel::FIELDNAME_LIEU_GEO)->getFieldValue();
        $synthese_action = Lib::isDefined("synthese_action");

        $id_fta_etat;    //Attention, double signification, si choix = 0 ou -1, alors il s'agit en fait de $id_fta

        if ($isLimit) {
            $limit = " LIMIT 0,$isLimit ";
        } else {
            $limit = "";
        }
//$_SESSION["id_fta"]=$id_fta_etat;
//mysql_table_load("fta_etat");
        $abreviation_fta_etat = $_SESSION["abreviation_fta_etat"];

        $modelfta = new FtaModel("4");



        /*
          Sélection de la requête source en fonction du choix de visualisation
          --------------------------------------------------------------------
         */

        switch ($choix) {
            //Synthèse des fiches
            case 1:

                //Récupération du site d'attachement de l'utilisateur
                $arrayIdSite = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT " . GeoModel::FIELDNAME_ID_SITE
                                . " FROM " . GeoModel::TABLENAME
                                . " WHERE " . GeoModel::KEYNAME . "=" . $lieuGeo
                );
                foreach ($arrayIdSite as $rowsIsSite) {
                    $id_site = $rowsIsSite[GeoModel::FIELDNAME_ID_SITE];

                    //Liste des suivis de projet que doit gérer l'utilisateur suivant l'état
                    $_SESSION["id_fta_etat"] = $id_fta_etat;
                    //switch($abreviation_etat)
                    //Premier processus ?
                    if ($_SESSION["fta_definition"]) {
                        $having = "";
                    } else {
                        $having = " HAVING MIN(suivi_precedent." . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . ")<>0 ";
                    }

                    //Récupération des listes des processus que gère l'utilisateur
                    $where_processus = " AND ( ";
                    $where_processus_cycle = " AND ( ";
                    $where_processus_OP = "";    //Opérateur SQL

                    $where_Site_de_production = "( " . FtaModel::FIELDNAME_SITE_ASSEMBLAGE . "=$id_site "
                            //. "OR Site_de_production IS NULL "
                            . " OR " . FtaModel::FIELDNAME_SITE_ASSEMBLAGE . "=0 "
                    //. "OR Site_de_production=\"\" "
                    ;
                    $where_Site_de_production_OP = "";    //Opérateur SQL
//************* Version 2.4.0 buggée
                    //$where_Site_de_production_OK=0;


                    $arrayProcessusDroitsAcces = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                    "SELECT DISTINCT " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME . "," . FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS
                                    . " FROM " . IntranetModulesModel::TABLENAME
                                    . ", " . IntranetDroitsAccesModel::TABLENAME
                                    . ", " . IntranetActionsModel::TABLENAME
                                    . ", " . FtaProcessusModel::TABLENAME
                                    . ", " . FtaActionRoleModel::TABLENAME
                                    . ", " . FtaWorkflowStructureModel::TABLENAME
                                    . " WHERE ( " . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME
                                    . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES //Liaison
                                    . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                                    . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                                    . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                    . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                                    . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                                    . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                                    . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                                    . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS . " ) "
                                    . " AND ( ( " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_USER
                                    . "=" . $id_user . " "
                                    . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . " > 0 ) )"
                    );


                    //L'utilisateur gère-t-il des processus ?
                    if ($arrayProcessusDroitsAcces) {
                        //echo "test";
                        foreach ($arrayProcessusDroitsAcces as $rowsProcessusDroitsAcces) {
                            $where_processus .= "$where_processus_OP chapitre_encours." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS . "=" . $rowsProcessusDroitsAcces[FtaProcessusModel::KEYNAME] . " ";
                            $where_processus_OP_before = " AND";    //Opérateur SQL
                            $where_processus_before .= $where_processus_OP_before . " chapitre_precedent." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS . "<>" . $rowsProcessusDroitsAcces[FtaProcessusModel::KEYNAME] . " ";
                            $where_processus_cycle .= "$where_processus_OP " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT . "=" . $rowsProcessusDroitsAcces[FtaProcessusModel::KEYNAME] . " ";
                            $where_processus_OP = " OR";    //Opérateur SQL

                            $isMonoSite = 0;       //Permet de savoir si il y a aumoins un processus mono site
                            //echo $test;
                            //echo "test1: ".$rows["multisite_fta_processus"]." / ".$isMonoSite."<br>";
                            //Dans le cas d'un processus multisite, récupération des déléguations de site
                            //Récupération des sites gérés par l'utilisateur
                            if ($rowsProcessusDroitsAcces["multisite_fta_processus"] == 1 and $isMonoSite == 0) {
                                //echo "test1: ".$rows["multisite_fta_processus"]." / ".$isMonoSite."<br>";
                                //$where_Site_de_production_OK=1;
                                $req = "SELECT id_site_assemblage_fta_processus_multisite "
                                        . " FROM fta_processus_multisite "
                                        . " WHERE id_processus_fta_processus_multisite=" . $rowsProcessusDroitsAcces["id_fta_processus"] . " "
                                        . " AND id_site_processus_fta_processus_multisite=" . $id_site
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
                                        $where_Site_de_production_OP = " OR";    //Opérateur SQL
                                        $where_Site_de_production .= " $where_Site_de_production_OP Site_de_production=" . $current_site . " ";
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
                        //Ajout des délégations de processus cf. fta_processus_multisite
                        //Selection des processus multisite où l'utilisateur à accès
                        $req_deleg = "SELECT id_site_assemblage_fta_processus_multisite "
                                . " FROM `intranet_modules`, `intranet_droits_acces`, `intranet_actions`, `fta_processus`, "
                                . " fta_processus_multisite "
                                . " WHERE ( `intranet_modules`.`id_intranet_modules` = `intranet_droits_acces`.`id_intranet_modules` "
                                . " AND `intranet_actions`.`id_intranet_actions` = `intranet_droits_acces`.`id_intranet_actions` "
                                . " AND `intranet_actions`.`id_intranet_actions` = `fta_processus`.`id_intranet_actions` ) "
                                . " AND ( ( `intranet_droits_acces`.`id_user` = " . $_SESSION["id_user"] . " "
                                . " AND `fta_processus`.`multisite_fta_processus` = 1 "
                                . " AND `intranet_droits_acces`.`niveau_intranet_droits_acces` > 0 ) )"
                                . " AND id_processus_fta_processus_multisite=id_fta_processus "
                                . " AND id_site_processus_fta_processus_multisite= $id_site "
                        ;
                        $result_deleg = DatabaseOperation::query($req_deleg);
                        while ($rows = mysql_fetch_array($result_deleg)) {
                            $where_Site_de_production.= " OR fta.Site_de_production = " . $rows["id_site_assemblage_fta_processus_multisite"] . " ";
                        }

                        $where_processus.= "1";
                        $where_processus_cycle.= "1";
                    }
                }//Fin de la recherche des processus
                //Finalisation de la mise en forme de la clause WHERE
                $where_processus.= ")";
                $where_processus_cycle.= ")";
                $where_Site_de_production.=") ";

                $AND_where_Site_de_production = " AND " . $where_Site_de_production;
                $OR_where_Site_de_production = " OR " . $where_Site_de_production;





                //Composant commun des requêtes
                $select_common = " ";
                $from_common = "fta, fta_etat, fta_processus_cycle LEFT JOIN classification_fta ON classification_fta.id_fta=id_fta ";
                $where_common = " AND fta.id_fta_etat=fta_etat.id_fta_etat "
                        . " AND fta.id_fta_etat=\"" . $id_fta_etat . "\" "
                        . " AND `fta`.`id_fta_workflow`=`fta_processus_cycle`.`id_fta_workflow` "
                        . " AND `fta_processus_cycle`.`id_init_fta_processus`=`fta_processus`.`id_fta_processus` "
                ;
                //Classement
                if (!$order_common) { //Classement demandé par l'utlisateur
                    $order_common = "suffixe_agrologic_fta, id_article_agrologic, id_classification_arborescence_article";
                }


                switch ($synthese_action) {

                    case "encours":
                        $ok = 1;
                        $bgcolor = "";
                        //echo $_SESSION["abreviation_fta_etat"];
                        //Récupération des suivis de projet gérés par l'utilisateur et pas encore validé
                        $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                        "SELECT DISTINCT " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME . " AS " . FtaModel::KEYNAME
                                        . $select_common
                                        . " FROM " . FtaSuiviProjetModel::TABLENAME . " as suivi_encours"
                                        . ", " . FtaWorkflowStructureModel::TABLENAME . " as chapitre_encours"
                                        . ", " . FtaSuiviProjetModel::TABLENAME . " as suivi_precedent "
                                        . ", " . FtaWorkflowStructureModel::TABLENAME . " as chapitre_precedent "
                                        . ", " . FtaProcessusModel::TABLENAME
                                        . ", " . $from_common
                                        . " WHERE suivi_encours." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE . "=chapitre_encours." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE    //Liaison
                                        . " AND suivi_encours." . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                        . "=" . FtaModel::TABLENAME . "." . FtaModel::KEYNAME                               //Liaison
                                        . " AND suivi_precedent." . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                        . "=" . FtaModel::TABLENAME . "." . FtaModel::KEYNAME                                 //Liaison
                                        . " AND suivi_precedent." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . "=chapitre_precedent." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE  //Liaison
                                        . " $where_common "
                                        . " $where_processus "                                                   //Appartenant à un Processus géré par l'utilisateur
                                        . " $AND_where_Site_de_production "
                                        . " $where_processus_cycle "
                                        . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . "=chapitre_precedent." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                        . " AND suivi_encours." . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "=0 "                                //Chapitre pas encore validé
                                        . " AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT
                                        . "=\"" . $modelfta->getModelFtaEtat()->getDataField(FtaEtatModel::FIELDNAME_ABREVIATION)->getFieldValue() . "\" "             //Cycle Initialisation par défaut
                                        . " AND (1 $where_processus_before)"
                                        . " GROUP BY " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
                                        . $having
                                        . " ORDER BY $order_common "
                        );

                        break;

                    case "attente":
                        $ok = 0;
                        $bgcolor = "bgcolor=#A5A5CE ";

                        //Distinction entre le En cours et le En attente
                        //Par rapport aux suivi de projets gérés, récupération des processus
                        $where_processus;

                        //Par rapport à ces processus, récupération des processus précédents
                        //et vérification qu'au moins un des chapitres précédent n'est pas validé
                        $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                        "SELECT DISTINCT " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME . " AS " . FtaModel::KEYNAME
                                        . $select_common
                                        . " FROM " . FtaSuiviProjetModel::TABLENAME
                                        . " , " . FtaWorkflowStructureModel::TABLENAME
                                        . " , " . FtaProcessusModel::TABLENAME
                                        . " , $from_common "
                                        . " WHERE " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "=\"I\" "                                //Cycle Initialisation par défaut
                                        . " AND " . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                        . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE      //Liaison
                                        . " AND " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                                        . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS                //Liaison
                                        . " AND " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
                                        . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA                                 //Liaison
                                        . $where_common
                                        . " $where_processus_cycle "
                                        . " $AND_where_Site_de_production "
                                        . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "=0 "                                //Chapitre pas encore validé donc FTA en attente
                                        . " ORDER BY $order_common "
                        );
                        break;

                    case "correction":

                        //Récupération des suivi de projet
                        //Récupération des chapitres gérés
                        //Pour un chapitre donné --> Voir le processus lié
                        //Pour le processus donné, voir l'accès

                        $ok = 2;
                        $bgcolor = "bgcolor=#AFFF5A";

                        /*
                         *Les FTA dont les chapitres sont tous validés et surlesquels on peut faire une correction 
                         * ainsi celle effecuées
                         */
                        //FTA dont les chapitres sont tous validés et surlesquels on peut faire une correction
                        //Par rapport aux suivi de projets gérés, récupération des processus
                        $where_processus;

                        //Par rapport à ces processus, récupération des processus précédents
                        //et vérification qu'au moins un des chapitres précédent n'est pas validé


                        $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                        "SELECT DISTINCT " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME . " AS " . FtaModel::KEYNAME
                                        . $select_common
                                        . " FROM " . FtaProcessusModel::TABLENAME . " LEFT JOIN `fta_processus_multisite` "
                                        . " ON " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME . "=" . FtaProcessusMultisiteModel::TABLENAME . "." . FtaProcessusMultisiteModel::KEYNAME
                                        . ", " . FtaWorkflowStructureModel::TABLENAME . " as chapitre_encours, " . FtaSuiviProjetModel::TABLENAME
                                        . ", $from_common "
                                        . " WHERE `chapitre_encours`." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                                        . "= " . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE
                                        . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                                        . " = `chapitre_encours`." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                        . " AND " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
                                        . " = " . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA
                                        . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT
                                        . "=" . FtaEtatModel::TABLENAME . "." . FtaEtatModel::KEYNAME
                                        . " $where_processus "                                                   //Appartenant à un Processus géré par l'utilisateur
                                        . $where_common                                                   //Appartenant à un Processus géré par l'utilisateur
                                        . " AND (" . FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS . "=0 "
                                        . " $OR_where_Site_de_production )"
                                        . " GROUP BY " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
                                        . " HAVING MIN(" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . ")<>0 "
                                        . " ORDER BY $order_common "
                        );
                        break;


                    case "all": //Toutes les fiches de l'état sélectionné

                        $bgcolor = "bgcolor=#AFFF5A";

                        $select = "SELECT DISTINCT " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME . " AS " . FtaModel::KEYNAME
                                . "," . FtaModel::FIELDNAME_DATE_DERNIERE_MAJ_FTA;
                        $from = " FROM " . FtaProcessusModel::TABLENAME 
                                . " , " . $from_common;
                        $where = " WHERE 1 "     //Liaison
                                . $where_common
                                . $AND_where_Site_de_production
                        ;
                        $order = " ORDER BY $order_common ";
                        $limit;

                        $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                        $select . $from . $where . $order . $limit
                        );
                        break;
                }

                break;

            //Moteur de recherche
            case -1:
            case 0:
                $id_fta = $id_fta_etat;    //Attention, double signification, si choix = 0 ou -1, alors il s'agit en fait de $id_fta
                $where = "fta.id_fta = '$id_fta' ";
                $synthese_action = "all";

                $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME . " AS " . FtaModel::KEYNAME
                                . " FROM " . FtaModel::TABLENAME . ", " . FtaEtatModel::TABLENAME
                                . " WHERE $where "
                                . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT
                                . "=" . FtaEtatModel::TABLENAME . "." . FtaEtatModel::KEYNAME
                                . " ORDER BY " . FtaModel::FIELDNAME_ARTICLE_AGROLOGIC . "," . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE . " ASC "
                );
                //echo $req;
                $bgcolor = -1;  //Déconfiguration du bgcolor, pour forcer sa redéfinition par la suite
                break;
        }
//MASTER REQUETE !!!!!!!!!!!!!
        $_SESSION["visualiser_fiche_total_fta"] = count($array);

        /*
          boucle d'affichage des éléments du tableau
          ------------------------------------------
         */

        $tableau_fiches = "<table class=titre width=100% border=0>"
                . "<tr class=titre_principal><td></td><td>"
        ;

        //Définition des en-têtes de tableau
        switch ($choix) {
            case 1:
            case 0:

                //Définition des fonctionnalité de classement
                //Par N°de Dossier - version
                $order_common = "id_fta";

                //Contrôle pour savoir si on est sur l'index du module
                $URL = $_SERVER["REQUEST_URI"];
                if (substr($URL, -1) == "/") {
                    $URL = $URL . "index.php?";
                }

                $tableau_fiches.= "<a href=" . $URL . "&order_common=id_fta><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
                        . "Id"
                        . "</td><td>"
                        . "<a href=" . $URL . "&order_common=code_article_ldc><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
                        . "Regate"
                        . "</td><td>"
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
        //Parcours des fiches techniques
        if ($array) {
            foreach ($array as $rows) {

                //Chargement des données
                $arrayDetail = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME . " as " . FtaModel::KEYNAME
                                . ", " . FtaEtatModel::FIELDNAME_ABREVIATION . ", " . FtaModel::FIELDNAME_LIBELLE
                                . ", " . FtaModel::FIELDNAME_PCB . ", " . FtaModel::FIELDNAME_POIDS_ELEMENTAIRE
                                . ", " . FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA . ", " . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE
                                . ", " . FtaModel::FIELDNAME_DOSSIER_FTA . ", " . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA
                                . ", " . FtaModel::FIELDNAME_ARTICLE_AGROLOGIC . ", " . FtaModel::FIELDNAME_CODE_ARTICLE_LDC
                                . ", " . FtaModel::FIELDNAME_DATE_ECHEANCE_FTA . ", " . FtaModel::FIELDNAME_CREATEUR
                                . " FROM " . FtaModel::TABLENAME . ", " . FtaEtatModel::TABLENAME
                                . " WHERE " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME . "=" . $rows[FtaModel::KEYNAME]
                                . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT
                                . "=" . FtaEtatModel::TABLENAME . "." . FtaEtatModel::KEYNAME
                );

                foreach ($arrayDetail as $rowsDetail) {
                    //Chargement manuel des données pour optimiser les performances
                    $id_fta = $rowsDetail[FtaModel::KEYNAME];
                    $abreviation_fta_etat = $rowsDetail[FtaEtatModel::FIELDNAME_ABREVIATION];
                    $LIBELLE = $rowsDetail[FtaModel::FIELDNAME_LIBELLE];
                    $NB_UNIT_ELEM = $rowsDetail[FtaModel::FIELDNAME_PCB];
                    $Poids_ELEM = $rowsDetail[FtaModel::FIELDNAME_POIDS_ELEMENTAIRE];
                    $suffixe_agrologic_fta = $rowsDetail[FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA];
                    $designation_commerciale_fta = $rowsDetail[FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE];
                    $id_dossier_fta = $rowsDetail[FtaModel::FIELDNAME_DOSSIER_FTA];
                    $id_version_dossier_fta = $rowsDetail[FtaModel::FIELDNAME_VERSION_DOSSIER_FTA];
                    $id_article_agrologic = $rowsDetail[FtaModel::FIELDNAME_ARTICLE_AGROLOGIC];
                    $code_article_ldc = $rowsDetail[FtaModel::FIELDNAME_CODE_ARTICLE_LDC];
                    $date_echeance_fta = $rowsDetail[FtaModel::FIELDNAME_DATE_ECHEANCE_FTA];
                    $createur_fta = $rowsDetail[FtaModel::FIELDNAME_CREATEUR];

                    //Récupération du nom du création
                    $arrayNomCreateur = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                    "SELECT " . UserModel::FIELDNAME_NOM . "," . UserModel::FIELDNAME_PRENOM
                                    . " FROM " . UserModel::TABLENAME
                                    . " WHERE " . UserModel::KEYNAME . "='" . $createur_fta . "' "
                    );

                    if ($arrayNomCreateur) {
                        foreach ($arrayNomCreateur as $rowsNomCreateur) {
                            $createur_nom = $rowsNomCreateur[UserModel::FIELDNAME_NOM];
                            $createur_prenom = $rowsNomCreateur[UserModel::FIELDNAME_PRENOM];
                        }
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

                    //Calcul préalable et Etat d'avancement
                    if ($abreviation_fta_etat == "I") {
                        $taux_temp = fta_taux_validation_fast($id_fta);
                        $recap[$id_fta] = round($taux_temp[0] * 100, 0) . "%";
                        $lien .= "<h5>" . $recap[$id_fta] . "<a "
                                . "href=historique.php"
                                . "?id_fta=$id_fta"
                                . "><img src=./images/graphique.png alt=\"\" title=\"Etat d'avancement\" width=\"30\" height=\"25\" border=\"0\" />"
                                . "</a>"
                        ;

                        //Gestion des délais
                        //La fonctionnalité n'est active qu'à partir du moment où un date d'échéance est saisie
                        {
                            $HTML_date_echeance_fta = fta_processus_delai_etat($id_fta);
                            //$return["status"]
                            //    0: Aucun dépassement des échéances
                            //    1: Au moins un processus en cours a dépassé son échéance
                            //    2: La date d'échéance de validation de la FTA est dépassée
                            //    3: Il n'y a pas de date d'échéance de validation FTA saisie
                            //    Renvoi un tableau associatif contenant:
                            //    - la listes des processus en cours ayant dépassé leur échéance
                            //    - leur date d'échéance
                            //    Contient le code source HTML utilisé pour la fonction visualiser_fiches()
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
                    }

                    //Droit de consultation standard HTML
                    if (
                            ($_SESSION["fta_modification"])
                            or ( $_SESSION["fta_consultation"] and $abreviation_fta_etat == "V" )
                    ) {
                        $lien .= "<a "
                                . "href=modification_fiche.php"
                                . "?id_fta=$id_fta"
                                . "&synthese_action=$synthese_action"
                                . "&comeback=1"
                                . " /><img src=../lib/images/next.png alt=\"\" title=\"Voir la FTA\" width=\"30\" height=\"25\" border=\"0\" />"
                                . "</a>"
                        ;
                    }
                    //Export PDF
//echo "test".$rows["abreviation_fta_etat"];
                    if (
                            ($_SESSION["fta_impression"] and ( $abreviation_fta_etat == "V" or $abreviation_fta_etat == "P"))
                            or ( $_SESSION["mode_debug"] == 1)
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
                            ($_SESSION["fta_definition"]) and (
                            $abreviation_fta_etat == 'V' or
                            $abreviation_fta_etat == 'A' or
                            $abreviation_fta_etat == 'R' or
                            $abreviation_fta_etat == 'P'
                            )
                            or ( $ok == 2 and $_SESSION["fta_article"]) and (
                            $abreviation_fta_etat == 'I' or
                            $abreviation_fta_etat == 'M' or
                            $abreviation_fta_etat == 'T'
                            )
                            or ( $ok == 2 and $_SESSION["fta_referentiel"]) and (
                            $abreviation_fta_etat == 'I' or
                            $abreviation_fta_etat == 'M' or
                            $abreviation_fta_etat == 'T'
                            )
                    ) {
                        $lien .= "<a "
                                . "href=transiter.php"
                                . "?id_fta=" . $id_fta
                                . "><img src=./images/transiter.png alt=\"\" title=\"Transiter\" width=\"30\" height=\"30\" border=\"0\" />"
                                . "</a>"
                        ;

                        if ($synthese_action == "correction") {
                            $selection = "<input type=\"checkbox\" name=selection_fta[] value=\"" . $id_fta . "\" checked />";
                            $traitement_masse = 1;
                            $selection_width = "2%";
                        }
                    }

                    //Seul le Chef de projet peut retirer une FTA en cours de modification
                    if ($_SESSION["fta_definition"]) {
                        $lien .= "<a "
                                . "href=# "
                                . "onClick=confirmation_correction_fta" . $id_fta . "(); "
                                . "/>"
                                . "<img src=../lib/images/supprimer.png alt=\"Retirer cette FTA\" width=\"25\" height=\"25\" border=\"0\" />"
                                . "</a>"
                        ;
                        $javascript.="
                           <SCRIPT LANGUAGE=JavaScript>
                                   function confirmation_correction_fta" . $id_fta . "()
                                   {
                                   if(confirm('Etes vous certain de vouloir retirer cette Fiche Technique ? Les autres fiches du dossier resteront indem.'))
                                   {
                                       location.href =\"transiter.php?id_fta=" . $id_fta . "&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action&action=correction&demande_abreviation_fta_transition=R\"
                                   }
                                    else{}
                                   }
                           </SCRIPT>
                           ";
                    }

                    //Actions systématiques pour le chef de projet
                    if ($_SESSION["fta_definition"]) {
                        $lien .= "<a "
                                . "href=creer_fiche.php"
                                . "?action=dupliquer_fiche"
                                . "&id_fta=" . $id_fta
                                . "><img src=../lib/images/copie.png alt=\"\" title=\"Dupliquer\" width=\"30\" height=\"30\" border=\"0\" />"
                                . "</a>"
                        ;
                    }


                    //construction des lignes et des colonnes
                    //Si accès la fiche
                    //Récupération du propriétaire
                    $id_element = 1;    //Propriétaire
                    $extension[0] = 1;
                    $temp = recherche_element_classification_fta($id_fta, $id_element, $extension);

                    //Récupération de la marque
                    $id_element = 2;  //Marque
                    $extension[0] = 1;
                    $temp2 = recherche_element_classification_fta($id_fta, $id_element, $extension);

                    //Désignation commerciale
                    $designation_commerciale_fta = $designation_commerciale_fta;
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

                    //Classification
                    if ($suffixe_agrologic_fta) {
                        $classification = $suffixe_agrologic_fta;
                    } else {
                        $classification = $temp2[2];
                    }

                    //Nom de l'assistante de projet responsable:
                    $createur_link = "\"Géré par $createur_prenom $createur_nom\"";

                    $tableau_fiches.= "<tr class=contenu>
                              <td $bgcolor_header width=\"" . $selection_width . "\" > $icon_header $selection</td>
                              ";
                    $tableau_fiches.="<td $bgcolor width=3%>" . $id_dossier_fta . "<br>v" . $id_version_dossier_fta . "</td>";
                    $tableau_fiches.="<td $bgcolor width=\"6%\"> <b><font size=\"2\" color=\"#0000FF\">" . $code_article_ldc . "</font></b></td>";
                    $tableau_fiches.="<td $bgcolor $largeur_html_C1><a title=$createur_link />" . $din . "</a></td>";
                    if ($abreviation_fta_etat == "I") {
                        $tableau_fiches.="<td $bgcolor $largeur_html_C3 align=center>" . $HTML_date_echeance_fta["HTML_synthese"] . "</td>";
                    }
                    $tableau_fiches.="<td $bgcolor $largeur_html_C3 align=\"right\" valign=\"middle\">$lien</td>";
                    $tableau_fiches.="</tr>";
                    $compteur_ligne++;
                }//fin tant que tableau_origine
                $tableau_fiches = $javascript . $tableau_fiches;
            }
            $tableau_fiches.= "</table>";
            //Ajoute de la fonction de traitement de masse
            if ($traitement_masse) {

                $requete = "SELECT " . FtaTransition::FIELDNAME_ABREVIATION_FTA_ETAT . ", " . FtaEtatModel::FIELDNAME_NOM_FTA_ETAT
                        . " FROM " . FtaTransition::TABLENAME . ", " . FtaEtatModel::TABLENAME
                        . " WHERE " . FtaTransition::TABLENAME . "." . FtaTransition::FIELDNAME_ABREVIATION_FTA_ETAT
                        . "='" . $_SESSION["abreviation_fta_etat"] . "' "
                        . " AND " . FtaEtatModel::TABLENAME . "." . FtaEtatModel::FIELDNAME_ABREVIATION
                        . "=" . FtaTransition::TABLENAME . "." . FtaTransition::FIELDNAME_ABREVIATION_FTA_ETAT   //Liaison
                ;
                $nom_defaut = FtaTransition::FIELDNAME_ABREVIATION_FTA_ETAT;
                $id_defaut = "V";
                $liste_action_groupe = afficher_requete_en_liste_deroulante($requete, $id_defaut, $nom_defaut);

                $tableau_fiches.= "&nbsp;<img src=../lib/images/fleche_gauche_et_haut.png width=38 height=22 border=0 />
                         <i>Transitions groupées</i>:
                         $liste_action_groupe
                         <input type=\"text\" name=\"subject\" size=\"20\" />
                         <input type=image src=images/transiter.png width=20 height=20 />
                         <input type=hidden name=action value=transition_groupe>
                         ";
            }
        } else {
            $tableau_fiches.= "<tr class=contenu><td>Aucune Fta identifié</td></tr>";
        }
        return $tableau_fiches;
    }

    //function visualiser_fiches */
}
