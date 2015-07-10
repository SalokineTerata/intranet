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

    const VALUE_0 = 0;
    const VALUE_1 = 1;
    const VALUE_2 = 2;
    const VALUE_3 = 3;
    const VALUE_4 = 4;
    const VALUE_5 = 5;
    const VALUE_6 = 6;
    const VALUE_7 = 7;
    const VALUE_8 = 8;
    const VALUE_9 = 9;
    const VALUE_10 = 10;
    const VALUE_11 = 11;
    const VALUE_12 = 12;

    protected static $abrevationFtaEtat;
    protected static $arrayFtaEtat;
    protected static $arrayFtaRole;
    protected static $arrayFtaWorkflow;
    protected static $arrayIdFtaAndIdWorkflow;
    protected static $arrayIdFtaByUserAndWorkflow;
    protected static $arraNameSiteByWorkflow;
    protected static $idFtaRole;
    protected static $idFtaEtat;
    protected static $idUser;
    protected static $lieuGeo;
    protected static $nombreFta;
    protected static $orderBy;
    protected static $syntheseAction;

    public static function initAccueil($id_user, $idFtaEtat, $abrevationFtaEtat, $syntheseAction, $IdFtaRole, $OrderBy, $lieuGeo) {

        self::$idUser = $id_user;
        self::$abrevationFtaEtat = $abrevationFtaEtat;
        self::$syntheseAction = $syntheseAction;
        self::$idFtaRole = $IdFtaRole;
        self::$idFtaEtat = $idFtaEtat;
        self::$orderBy = $OrderBy;
        self::$lieuGeo = $lieuGeo;

        /*
         * On recherche les roles auxquelles l'utilisateur à les droits d'acces
         */

        self::$arrayFtaRole = FtaRoleModel::getIdFtaRoleByIdUser(self::$idUser);

        /*
         * Selon le role  nous cherchons ces etats. 
         * 
         */
        self::$arrayFtaEtat = FtaEtatModel::getFtaEtatAndNameByRole(self::$idFtaRole);

        /*
         * $arrayIdFtaAndIdWorkflow[1] sont les id_fta
         * $arrayIdFtaAndIdWorkflow[2] sont les nom des workflows correspondant aux  id_fta
         */
        self::$arrayIdFtaAndIdWorkflow = FtaEtatModel::getIdFtaByEtatAvancement(self::$syntheseAction, self::$abrevationFtaEtat, self::$idFtaRole, self::$idUser, self::$lieuGeo);

        self::$arrayIdFtaByUserAndWorkflow = UserModel::getIdFtaByUserAndWorkflow(self::$arrayIdFtaAndIdWorkflow[AccueilFta::VALUE_1], self::$orderBy);

        self::$arraNameSiteByWorkflow = IntranetActionsModel::getNameSiteByWorkflow(self::$idUser, self::$arrayIdFtaAndIdWorkflow[AccueilFta::VALUE_2]);

        self::$nombreFta = count(self::$arrayIdFtaByUserAndWorkflow);
    }

    public static function getTableauSythese() {

        $tableau_synthese = AccueilFta::getHtmlTableauSythese(self::$arrayFtaRole, self::$arrayFtaEtat, self::$abrevationFtaEtat, self::$idFtaRole, self::$syntheseAction);
        $tableau_syntheseWorkflow = AccueilFta::getHtmlTableauSytheseWorkflow(self::$arrayIdFtaAndIdWorkflow[AccueilFta::VALUE_2], self::$arraNameSiteByWorkflow);
        $tableau_synthese.=$tableau_syntheseWorkflow;
        return $tableau_synthese;
    }

    private static function getLienByEtatFta($paramAbrevation1, $paramAbrevation2) {
        if ($paramAbrevation1 == "I" or $paramAbrevation2 == "P") {
            $tableau_synthese .= "encours>";
        } else {
            $tableau_synthese .= "all>";
        }
        return $tableau_synthese;
    }

    private static function getHtmlTableauSythese($paramRole, $paramEtat, $paramNomEtat, $paramIdFtaRole, $paramSyntheseAction) {

        $idKeyNameFtaEtat = AccueilFta::VALUE_0;
        $tableau_synthese = "";

        switch (self::$syntheseAction) {
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ATTENTE:
                $nombreFta1 = " (" . self::$nombreFta . ")";

                break;
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS:
                $nombreFta2 = " (" . self::$nombreFta . ")";
                break;
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES:
                $nombreFta3 = " (" . self::$nombreFta . ")";
                break;

            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ALL:
                $nombreFta4 = " (" . self::$nombreFta . ")";
                break;
        }

        switch ($paramNomEtat) {
            case FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION:
                $lien[AccueilFta::VALUE_0] = "<a href=index.php?id_fta_etat=" . $paramEtat[$idKeyNameFtaEtat][FtaEtatModel::KEYNAME]
                        . "&nom_fta_etat=" . $paramEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION]
                        . "&id_fta_role=" . $paramIdFtaRole
                        . "&synthese_action=attente >En attente$nombreFta1</a>";
                $lien[AccueilFta::VALUE_1] = " <a href=index.php?id_fta_etat=" . $paramEtat[$idKeyNameFtaEtat][FtaEtatModel::KEYNAME]
                        . "&nom_fta_etat=" . $paramEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION]
                        . "&id_fta_role=" . $paramIdFtaRole
                        . "&synthese_action=encours >En cours$nombreFta2</a>";
                $lien[AccueilFta::VALUE_2] = "<a href=index.php?id_fta_etat=" . $paramEtat[$idKeyNameFtaEtat][FtaEtatModel::KEYNAME]
                        . "&nom_fta_etat=" . $paramEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION]
                        . "&id_fta_role=" . $paramIdFtaRole
                        . "&synthese_action=correction >Effectuées$nombreFta3</a>";
                break;
            case FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE:
                $lien[AccueilFta::VALUE_0] = "<a href=index.php?id_fta_etat=" . $paramEtat[$idKeyNameFtaEtat][FtaEtatModel::KEYNAME]
                        . "&nom_fta_etat=" . $paramEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION]
                        . "&id_fta_role=" . $paramIdFtaRole
                        . "&synthese_action=all >Voir$nombreFta4</a>";
                $lien[AccueilFta::VALUE_1] = "";
                $lien[AccueilFta::VALUE_2] = "";
                break;
            case FtaEtatModel::ETAT_ABREVIATION_VALUE_ARCHIVE:
                $$lien[AccueilFta::VALUE_0] = "<a href=index.php?id_fta_etat=" . $paramEtat[$idKeyNameFtaEtat][FtaEtatModel::KEYNAME]
                        . "&nom_fta_etat=" . $paramEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION]
                        . "&id_fta_role=" . $paramIdFtaRole
                        . "&synthese_action=all >Voir$nombreFta4</a>";
                $lien[AccueilFta::VALUE_1] = "";
                $lien[AccueilFta::VALUE_2] = "";
                break;
            case FtaEtatModel::ETAT_ABREVIATION_VALUE_RETIRE:
                $lien[AccueilFta::VALUE_0] = "<a href=index.php?id_fta_etat=" . $paramEtat[$idKeyNameFtaEtat][FtaEtatModel::KEYNAME]
                        . "&nom_fta_etat=" . $paramEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION]
                        . "&id_fta_role=" . $paramIdFtaRole
                        . "&synthese_action=all >Voir$nombreFta4</a>";
                $lien[AccueilFta::VALUE_1] = "";
                $lien[AccueilFta::VALUE_2] = "";
                break;
            case FtaEtatModel::ETAT_ABREVIATION_VALUE_PRESENTATION:
                $lien[AccueilFta::VALUE_0] = "<a href=index.php?id_fta_etat=" . $paramEtat[$idKeyNameFtaEtat][FtaEtatModel::KEYNAME]
                        . "&nom_fta_etat=" . $paramEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION]
                        . "&id_fta_role=" . $paramIdFtaRole
                        . "&synthese_action=attente >En attente$nombreFta1</a>";
                $lien[AccueilFta::VALUE_1] = " <a href=index.php?id_fta_etat=" . $paramEtat[$idKeyNameFtaEtat][FtaEtatModel::KEYNAME]
                        . "&nom_fta_etat=" . $paramEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION]
                        . "&id_fta_role=" . $paramIdFtaRole
                        . "&synthese_action=encours >En cours$nombreFta2</a>";
                $lien[AccueilFta::VALUE_2] = "<a href=index.php?id_fta_etat=" . $paramEtat[$idKeyNameFtaEtat][FtaEtatModel::KEYNAME]
                        . "&nom_fta_etat=" . $paramEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION]
                        . "&id_fta_role=" . $paramIdFtaRole
                        . "&synthese_action=correction >Effectuées$nombreFta3</a>";

                break;
        }



        $tableau_synthese = "<table  class = contenu width = 100% border = 0>"
                /*
                 * Entête de la barre de navigation de la page d'accueil
                 */
                . "<TR>"
                . "<TH>Role </TH> <TH>Etat FTA</TH> <TH>Etat d'Avancement</TH>"
                . "</TR>";
        /*
         * Données du tableau
         */
        $tableau_synthese .= self::getLineSynthese($paramRole, $paramEtat, $paramIdFtaRole, $paramNomEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole = AccueilFta::VALUE_0, $idKeyNameFtaEtat = AccueilFta::VALUE_0, $idKeyValueFtaEtatAvancement = AccueilFta::VALUE_0);
        $tableau_synthese .= self::getLineSynthese($paramRole, $paramEtat, $paramIdFtaRole, $paramNomEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole = AccueilFta::VALUE_1, $idKeyNameFtaEtat = AccueilFta::VALUE_1, $idKeyValueFtaEtatAvancement = AccueilFta::VALUE_1);
        $tableau_synthese .= self::getLineSynthese($paramRole, $paramEtat, $paramIdFtaRole, $paramNomEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole = AccueilFta::VALUE_2, $idKeyNameFtaEtat = AccueilFta::VALUE_2, $idKeyValueFtaEtatAvancement = AccueilFta::VALUE_2);
        $tableau_synthese .= self::getLineSynthese($paramRole, $paramEtat, $paramIdFtaRole, $paramNomEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole = AccueilFta::VALUE_3, $idKeyNameFtaEtat = AccueilFta::VALUE_3, $idKeyValueFtaEtatAvancement = AccueilFta::VALUE_3);
        $tableau_synthese .= self::getLineSynthese($paramRole, $paramEtat, $paramIdFtaRole, $paramNomEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole = AccueilFta::VALUE_4, $idKeyNameFtaEtat = AccueilFta::VALUE_4, $idKeyValueFtaEtatAvancement = AccueilFta::VALUE_3);
        $tableau_synthese .= self::getLineSynthese($paramRole, $paramEtat, $paramIdFtaRole, $paramNomEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole = AccueilFta::VALUE_5, $idKeyNameFtaEtat = AccueilFta::VALUE_5, $idKeyValueFtaEtatAvancement = AccueilFta::VALUE_3);

        return $tableau_synthese;
    }

    private static function getHtmlTableauSytheseWorkflow($paramWorkflow, $paramNameSiteByWorkflow) {
        $bgcolor = "bgcolor = #3CDA31 ";

        /*
         * Debut de la ligne
         */
        $tableau_synthese = "<TABLE $bgcolor width=100%>"
                . "<TR   >"
                . "<td> Espace de Travail :</td>";

        /*
         * Infobulle affichant le noms des sites de production des fta par workflow
         */
        $paramNameSite0 = self::getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite = AccueilFta::VALUE_0);
        $paramNameSite1 = self::getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite = AccueilFta::VALUE_1);
        $paramNameSite2 = self::getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite = AccueilFta::VALUE_2);
        $paramNameSite3 = self::getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite = AccueilFta::VALUE_3);
        $paramNameSite4 = self::getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite = AccueilFta::VALUE_4);
        $paramNameSite5 = self::getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite = AccueilFta::VALUE_5);

        $paramNameSite = array_merge($paramNameSite0, $paramNameSite1, $paramNameSite2, $paramNameSite3, $paramNameSite4, $paramNameSite5);

        /**
         * Element de la ligne
         */
        $tableau_synthese .=self::getLineSyntheseWorkflow($paramWorkflow, $idKeyNameFtaWorkflow = AccueilFta::VALUE_0, $paramNameSite, $idKeyNameFtaSite = AccueilFta::VALUE_0);
        $tableau_synthese .=self::getLineSyntheseWorkflow($paramWorkflow, $idKeyNameFtaWorkflow = AccueilFta::VALUE_1, $paramNameSite, $idKeyNameFtaSite = AccueilFta::VALUE_1);
        $tableau_synthese .=self::getLineSyntheseWorkflow($paramWorkflow, $idKeyNameFtaWorkflow = AccueilFta::VALUE_2, $paramNameSite, $idKeyNameFtaSite = AccueilFta::VALUE_2);
        $tableau_synthese .=self::getLineSyntheseWorkflow($paramWorkflow, $idKeyNameFtaWorkflow = AccueilFta::VALUE_3, $paramNameSite, $idKeyNameFtaSite = AccueilFta::VALUE_3);
        $tableau_synthese .=self::getLineSyntheseWorkflow($paramWorkflow, $idKeyNameFtaWorkflow = AccueilFta::VALUE_4, $paramNameSite, $idKeyNameFtaSite = AccueilFta::VALUE_4);
        $tableau_synthese .=self::getLineSyntheseWorkflow($paramWorkflow, $idKeyNameFtaWorkflow = AccueilFta::VALUE_5, $paramNameSite, $idKeyNameFtaSite = AccueilFta::VALUE_5);
        $tableau_synthese .= "<TR >"
                . "</TABLE>";

        return $tableau_synthese;
    }

    /*
     * fonction de mise e forme recuperant tous les nom des site dont l'utilisateur à les droits d'accès par workflow
     */

    private static function getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite) {
        $codeSautDeLigne = "&#013";
        if ($paramNameSiteByWorkflow[$idKeyNameFtaSite]) {
            $paramNameSiteByWorkflow = $paramNameSiteByWorkflow[$idKeyNameFtaSite];
        } else {
            $paramNameSiteByWorkflow;
        }
        for ($i = 0; $i < count($paramNameSiteByWorkflow); $i++) {
            $paramNameSite[$idKeyNameFtaSite] .= $paramNameSiteByWorkflow[$i][IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS] . $codeSautDeLigne;
        }
        return $paramNameSite;
    }

    private static function getLineSyntheseWorkflow($paramArrayWorkflow, $idKeyNameFtaWorkflow, $paramNameSiteByWorkflow, $idKeyNameFtaSite) {

        return "<td>"
                . "<a href=#"
                . $paramArrayWorkflow[$idKeyNameFtaWorkflow][FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW]
                . " title= " . $paramNameSiteByWorkflow[$idKeyNameFtaSite] . " >"
                . $paramArrayWorkflow[$idKeyNameFtaWorkflow][FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW]
                . "</a>"
                . "</td>"

        ;
    }

    private static function getLineSynthese(
    $paramArrayRole, $paramArrayEtat, $idFtaRole, $nomFtaEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole, $idKeyNameFtaEtat, $idKeyValueFtaEtatAvancement
    ) {
        $color = "";
        $color1 = "";
        $color2 = "";


        if ($paramArrayRole[$idFieldNomFtaRole][FtaRoleModel::KEYNAME] == $idFtaRole) {
            $color = "bgcolor=#AAAAFF";
        }

        if ($paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION] == $nomFtaEtat) {
            $color1 = "bgcolor=#AAAAFF";
        }


        switch ($idKeyValueFtaEtatAvancement) {
            case AccueilFta::VALUE_0:
                $ligneEtatAvancement = "attente";
                if ($lien[AccueilFta::VALUE_2] == NULL) {
                    $ligneEtatAvancement = "all";
                }
                break;

            case AccueilFta::VALUE_1:
                $ligneEtatAvancement = "encours";
                break;

            case AccueilFta::VALUE_2:
                $ligneEtatAvancement = "correction";
                break;
        }
        if ($paramSyntheseAction == $ligneEtatAvancement) {
            $color2 = "bgcolor=#AAAAFF";
        }


        return "<TR>"
                . "<td $color w id='" . $paramArrayRole[$idFieldNomFtaRole][FtaRoleModel::FIELDNAME_NOM_FTA_ROLE] . "'> "
                . "<a href=index.php?id_fta_etat=" . $paramArrayEtat[AccueilFta::VALUE_0][FtaEtatModel::KEYNAME]
                . "&nom_fta_etat=" . $paramArrayEtat[AccueilFta::VALUE_0][FtaEtatModel::FIELDNAME_ABREVIATION]
                . "&id_fta_role=" . $paramArrayRole[$idFieldNomFtaRole][FtaRoleModel::KEYNAME]
                . "&synthese_action="
                . AccueilFta::getLienByEtatFta($paramArrayEtat[AccueilFta::VALUE_0][FtaEtatModel::FIELDNAME_ABREVIATION], $paramArrayEtat [AccueilFta::VALUE_0][FtaEtatModel::FIELDNAME_ABREVIATION])
                . $paramArrayRole[$idFieldNomFtaRole][FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE]
                . "</a>"
                . "</td>"
                . "<td $color1 id='" . $paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION] . "'>  "
                . "<a href=index.php?id_fta_etat=" . $paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::KEYNAME]
                . "&nom_fta_etat=" . $paramArrayEtat[AccueilFta::VALUE_0][FtaEtatModel::FIELDNAME_ABREVIATION]
                . "&id_fta_role=" . $idFtaRole
                . "&synthese_action="
                . AccueilFta::getLienByEtatFta($paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION], $paramArrayEtat [$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION])
                . $paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_NOM_FTA_ETAT]
                . "</a>"
                . "</td>"
                . "<td $color2 >" . $lien[$idKeyValueFtaEtatAvancement]
                . "</td>"
                . "</TR>"
        ;
    }

    public static function getHtmlTableauFiche() {


        $largeur_html_C1 = "width=15%"; // largeur cellule type
        $largeur_html_C3 = "width=16%"; // largeur cellule type
        $compteur_ligne = 1;
        $selection_width = "1%";

        $tableauFiche = "";
        $tableauFiche = "<table id=tableauFiche  align=middle class=titre width=100% >"
                . "<thead><tr class=titre_principal><th></th>"
        ;

        //Contrôle pour savoir si on est sur l'index du module
        $URL = $_SERVER["REQUEST_URI"];

        switch (self::$syntheseAction) {
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ATTENTE:
                $URL = substr($URL, AccueilFta::VALUE_0, strpos($URL, self::$syntheseAction) + AccueilFta::VALUE_7);

                break;
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS:
                $URL = substr($URL, AccueilFta::VALUE_0, strpos($URL, self::$syntheseAction) + AccueilFta::VALUE_7);
                break;
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES:
                $URL = substr($URL, AccueilFta::VALUE_0, strpos($URL, self::$syntheseAction) + AccueilFta::VALUE_10);
                break;

            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ALL:
                $URL = substr($URL, AccueilFta::VALUE_0, strpos($URL, self::$syntheseAction) + AccueilFta::VALUE_3);
                break;
        }
        if (substr($URL, -2) == "in") {
            $URL = $URL . "tranet/apps/fta/index.php?";
        }
        $tableauFiche .= "<th><a href=" . $URL . "&order_common=Site_de_production><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
                . "Site"
                . "</th><th>"
                . "<a href=" . $URL . "&order_common=id_fta><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
                . "Client"
                . "</th><th>"
                . "<a href=" . $URL . "&order_common=suffixe_agrologic_fta><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
                . "Class."
                . "</th><th>"
                . "<a href=" . $URL . "&order_common=designation_commerciale_fta><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
                . "Produits"
                . "</th><th>"
                . "<a href=" . $URL . "&order_common=id_dossier_fta><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
                . "Dossier FTA"
                . "</th><th>"
                . "<a href=" . $URL . "&order_common=code_article_ldc><img src=../lib/images/order-AZ.png title=\"mini_fleche_centre\"  border=\"0\" /></a>"
                . "Code Arcadia"
                . "</th><th>"
                . "Echéance de validation"
                . "</th><th>"
                . "% Avancement FTA"
                . "</th><th>"
                . "Service"
                . "</th><th>"
                . "Actions"
                . "</th><th>"
                . "Commentaires"
                . "</th>";

        $tmp = null;
        if (self::$arrayIdFtaByUserAndWorkflow) {
            $createurTmp = null;
            foreach (self::$arrayIdFtaByUserAndWorkflow as $rowsDetail) {
                $workflowDescription = $rowsDetail[FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW];
                $workflowName = $rowsDetail[FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW];

                if ($tmp <> $workflowDescription) {
                    $nombreDeCellule = AccueilFta::VALUE_12;
                    $tableauFiche .= "<tbody  id='" . $workflowName . "' >"
                            . "<tr class=contenu>"
                            . "<td  class=titre COLSPAN=" . $nombreDeCellule . ">" . $workflowDescription . "</td>"
                            . "</tr>";
                    $tmp = $rowsDetail[FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW];
                }

                $din = null;
                //Chargement manuel des données pour optimiser les performances
                $idFta = $rowsDetail[FtaModel::KEYNAME];
                $abreviationFtaEtat = $rowsDetail[FtaEtatModel::FIELDNAME_ABREVIATION];
                $LIBELLE = $rowsDetail[FtaModel::FIELDNAME_LIBELLE];
                $suffixeAgrologicFta = $rowsDetail[FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA];
                $designationCommercialeFta = $rowsDetail[FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE];
                $idDossierFta = $rowsDetail[FtaModel::FIELDNAME_DOSSIER_FTA];
                $idVersionDossierFta = $rowsDetail[FtaModel::FIELDNAME_VERSION_DOSSIER_FTA];
                $codeArticleLdc = $rowsDetail[FtaModel::FIELDNAME_CODE_ARTICLE_LDC];
                $dateEcheanceFta = $rowsDetail[FtaModel::FIELDNAME_DATE_ECHEANCE_FTA];
                $createurFta = $rowsDetail[FtaModel::FIELDNAME_CREATEUR];
                $siteProduction = $rowsDetail[FtaModel::FIELDNAME_SITE_ASSEMBLAGE];
                $idWorkflowFtaEncours = $rowsDetail[FtaModel::FIELDNAME_WORKFLOW];

                /*
                 * Initialisation des valeurs pour un 
                 */
                $ftaModel = new FtaModel($idFta);
                $commentaireDataField = $ftaModel->getDataField(FtaModel::FIELDNAME_COMMENTAIRE);
                $htmlField = html::getHtmlObjectFromDataField($commentaireDataField);
                $htmlField->setHtmlRenderToTable();

                /*
                 * Récuperation du nom de site de production
                 */
                $arrayNomSiteProduction = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT " . GeoModel::FIELDNAME_GEO
                                . " FROM " . GeoModel::TABLENAME
                                . " WHERE " . GeoModel::FIELDNAME_ID_SITE
                                . "= '" . $siteProduction
                                . "'"
                );
                if ($arrayNomSiteProduction) {
                    foreach ($arrayNomSiteProduction as $rowsNomSiteProduction) {
                        $nomSiteProduction = $rowsNomSiteProduction[GeoModel::FIELDNAME_GEO];
                    }
                }

                /*
                 * Récupération du nom du créateur de la fta
                 */

                $arrayNomCreateur = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT " . UserModel::FIELDNAME_NOM . "," . UserModel::FIELDNAME_PRENOM
                                . " FROM " . UserModel::TABLENAME
                                . " WHERE " . UserModel::KEYNAME . "='" . $createurFta . "' "
                );

                if ($arrayNomCreateur) {
                    foreach ($arrayNomCreateur as $rowsNomCreateur) {
                        $createurNom = $rowsNomCreateur[UserModel::FIELDNAME_NOM];
                        $createurPrenom = $rowsNomCreateur[UserModel::FIELDNAME_PRENOM];
                    }
                }

                /*
                 * Definition de la couleur de la cellule selon l'état d'avancement
                 */
                switch (self::$syntheseAction) {
                    case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ATTENTE:
                        $ok = AccueilFta::VALUE_0;
                        $bgcolor = "bgcolor=#A5A5CE ";

                        break;
                    case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS:
                        $ok = AccueilFta::VALUE_1;
                        $bgcolor = "";

                        break;
                    case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES:
                        $ok = AccueilFta::VALUE_2;
                        $bgcolor = "bgcolor=#AFFF5A";
                        break;

                    case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ALL:
                        $bgcolor = "bgcolor=#AFFF5A";
                        break;
                }
                $HTML_date_echeance_fta = FtaProcessusDelaiModel::getFtaDelaiAvancement($idFta);
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
                    case AccueilFta::VALUE_1:
                        $bgcolor_header = $bgcolor;
                        $icon_header = "<img src=../lib/images/exclamation.png title='Certaines échéances sont dépassées !' width=30 height=27 border=0 />";
                        break;
                    case AccueilFta::VALUE_2:
                        $bgcolor_header = "class=couleur_rouge";
                        $icon_header = "<img src=../lib/images/exclamation.png title='Certaines échéances sont dépassées !' width=30 height=27 border=0 />";
                        break;
                    default:
                        //$bgcolor_header = $bgcolor;
                        $icon_header = "";
                }

                /*
                 * Recuperation du proprietaire
                 */

                $id_element = 1;    //Propriétaire
                $extension[0] = 1;
                $temp = recherche_element_classification_fta($idFta, $id_element, $extension);
                //  $temp = ClassificationFtaModel::getElementClassificationFta($idFta, $id_element, $extension);
                //Récupération de la marque
                $id_element = 2;  //Marque
                $extension[0] = 1;
                $temp2 = recherche_element_classification_fta($idFta, $id_element, $extension);
                // $temp2 = ClassificationFtaModel::getElementClassificationFta($idFta, $id_element, $extension);


                /*
                 * Designation commerciale
                 */
                if (strlen($designationCommercialeFta) > 55) {
                    $designationCommercialeFta = substr($designationCommercialeFta, AccueilFta::VALUE_0, 52) . "...";
                }
                if ($LIBELLE) {
                    $din = $LIBELLE;
                } else {
                    $din = "<font size=\"1\" color=\"#808080\"><i>$designationCommercialeFta</i></font>";
                }

                /*
                 * Classification
                 */

                $classification = $temp2[2];


                /*
                 * Nom de l'assistante de projet responsable:
                 */
                $createur_link = "\"Géré par $createurPrenom $createurNom\"";


                /*
                 * Calcul d'etat d'avancement
                 */

                $taux_temp = FtaSuiviProjetModel::getFtaTauxValidation($idFta);
                $recap[$idFta] = round($taux_temp[AccueilFta::VALUE_0] * 100, AccueilFta::VALUE_0) . "%";

                /*
                 * Droit de consultation standard HTML
                 */
                $actions = "";
                if (
                        ($_SESSION["fta_modification"])
                        or ( $_SESSION["fta_consultation"] and $abreviationFtaEtat == "V" )
                )
                    $actions = "<a "
                            . "href=modification_fiche.php"
                            . "?id_fta=$idFta"
                            . "&synthese_action=" . self::$syntheseAction
                            . "&comeback=1"
                            . " /><img src=../lib/images/next.png alt=\"\" title=\"Voir la FTA\" width=\"30\" height=\"25\" border=\"0\" />"
                            . "</a>"
                    ;

                /*
                 * Export PDF
                 */
                if (
                        ($_SESSION["fta_impression"] and ( $abreviationFtaEtat == "V" or $abreviationFtaEtat == "P"))
                        or ( $_SESSION["mode_debug"] == 1)
                ) {

                    $actions .= "  "
                            . "<a "
                            . "href=pdf.php?id_fta=" . $idFta . "&mode=client "
                            . "target=_blank"
                            . "><img src=./images/pdf.png alt=\"\" title=\"Exportation PDF\" width=\"30\" height=\"25\" border=\"0\" />"
                            . "</a>"
                    ;
                }
                /*
                 * Transiter
                 */
                if (
                        ($_SESSION["fta_definition"]) and (
                        $abreviationFtaEtat == 'V' or
                        $abreviationFtaEtat == 'A' or
                        $abreviationFtaEtat == 'R' or
                        $abreviationFtaEtat == 'P'
                        )
                        or ( $ok == AccueilFta::VALUE_2 and $_SESSION["fta_article"]) and (
                        $abreviationFtaEtat == 'I' or
                        $abreviationFtaEtat == 'M'
                        )or ( $ok == AccueilFta::VALUE_2 and $_SESSION["fta_referentiel"]) and (
                        $abreviationFtaEtat == 'I' or
                        $abreviationFtaEtat == 'M'
                        )
                ) {
                    $actions .= "<a "
                            . "href=transiter.php"
                            . "?id_fta=" . $idFta
                            . "><img src=./images/transiter.png alt=\"\" title=\"Transiter\" width=\"30\" height=\"30\" border=\"0\" />"
                            . "</a>"
                    ;

                    if (self::$syntheseAction == "correction") {
                        $selection = "<input type=\"checkbox\" name=selection_fta[] value=\"" . $idFta . "\" checked />";
                        $traitement_masse = 1;
                        $selection_width = "2%";
                    }
                }
                /*
                 * Action que seul les Chefs de projet peuvent faire
                 */
                /*
                 * Retirer une FTA en cours de modification
                 */
                if ($_SESSION["fta_definition"]) {
                    $actions .= "<a "
                            . "href=# "
                            . "onClick=confirmation_correction_fta" . $idFta . "(); "
                            . "/>"
                            . "<img src=../lib/images/supprimer.png alt=\"Retirer cette FTA\" width=\"25\" height=\"25\" border=\"0\" />"
                            . "</a>"
                    ;
                    $javascript.="
                           <SCRIPT LANGUAGE=JavaScript>
                                   function confirmation_correction_fta" . $idFta . "()
                                   {
                                   if(confirm('Etes vous certain de vouloir retirer cette Fiche Technique ? Les autres fiches du dossier resteront indem.'))
                                   {
                                       location.href =\"transiter.php?id_fta=" . $idFta . "&id_fta_chapitre_encours=$idFtaChapitreEncours&synthese_action=" . self::$syntheseAction . "&action=correction&demande_abreviation_fta_transition=R\"
                                   }
                                    else{}
                                   }
                           </SCRIPT>
                           ";
                }
                /*
                 * Actions systématiques pour le chef de projet
                 */
                if ($_SESSION["fta_definition"]) {
                    $actions .= "<a "
                            . "href=creer_fiche.php"
                            . "?action=dupliquer_fiche"
                            . "&id_fta=" . $idFta
                            . "><img src=../lib/images/copie.png alt=\"\" title=\"Dupliquer\" width=\"30\" height=\"30\" border=\"0\" />"
                            . "</a>"
                    ;
                }

                /*
                 * Noms des services dans lequel la Fta se trouve
                 */

                $arrayService = FtaRoleModel::getNameRoleEncoursByIdFta($idFta, $idWorkflowFtaEncours);
                if ($arrayService) {
                    foreach ($arrayService as $rowsService) {
                        $service .= $rowsService[FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE] . "<br>";
                    }
                }

                if (self::$idUser == $createurFta) {
                    /*
                     * Commentaire de la Fta
                     */

                    /*
                     * @TODO caractères spéciaux de l'encodage ajax
                     */
                    $htmlField->setIsEditable(TRUE);
                    $commentaire = $htmlField->getHtmlResult();

                    if ($createurFta <> $createurTmp) {

                        $tableauFiche .= "<tr class=contenu>"
                                . "<td COLSPAN=" . $nombreDeCellule . " ><font size=2 >" . $createurPrenom . " " . $createurNom . " </td>"
                                . "</tr>"
                                . "<tr class=contenu >"
                                . "<td $bgcolor_header width=\"" . $selection_width . "\" > $icon_header $selection</td>"//Ordre de priorisation
                                . "<td $bgcolor width=8%>" . $nomSiteProduction . "</td>"//Site
                                . "<td $bgcolor width=6%>" . $classification . "</td>"//Client
                                . "<td $bgcolor width=6%>" . $suffixeAgrologicFta . "</td>"//Class.
                                . "<td $bgcolor $largeur_html_C1><a title=$createur_link />" . $din . "</a></td>"// Produits
                                . "<td $bgcolor width=3%>" . $idDossierFta . "v" . $idVersionDossierFta . "</td>"//Dossier Fta
                                . "<td $bgcolor width=\"6%\"> <b><font size=\"2\" color=\"#0000FF\">" . $codeArticleLdc . "</font></b></td>"; //Code regate

                        if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                            $tableauFiche.="<td $bgcolor $largeur_html_C3 align=center>" . $dateEcheanceFta . "</td>"; //échance de validation
                        } else {
                            $tableauFiche.="<td></td>";
                        }
                        $tableauFiche .= "<td $bgcolor width=10% align=center>$recap[$idFta]</td>"//% Avancement FTA
                                . "<td $bgcolor align=center >$service</td>" //Service               
                                . "<td $bgcolor align=center >$actions</td>"// Actions
                                . "$commentaire</tr >"; // Commentaires
                        $createurTmp = $createurFta;
                    } else {
                        $tableauFiche .= "<tr class=contenu >"
                                . "<td $bgcolor_header width=\"" . $selection_width . "\" > $icon_header $selection</td>"//Ordre de priorisation
                                . "<td $bgcolor width=8%>" . $nomSiteProduction . "</td>"//Site
                                . "<td $bgcolor width=6%>" . $classification . "</td>"//Client
                                . "<td $bgcolor width=6%>" . $suffixeAgrologicFta . "</td>"//Class.
                                . "<td $bgcolor $largeur_html_C1><a title=$createur_link />" . $din . "</a></td>"// Produits
                                . "<td $bgcolor width=3%>" . $idDossierFta . "v" . $idVersionDossierFta . "</td>"//Dossier Fta
                                . "<td $bgcolor width=\"6%\"> <b><font size=\"2\" color=\"#0000FF\">" . $codeArticleLdc . "</font></b></td>"; //Code regate

                        if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                            $tableauFiche.="<td $bgcolor $largeur_html_C3 align=center>" . $HTML_date_echeance_fta["HTML_synthese"] . "</td>"; //échance de validation
                        } else {
                            $tableauFiche.="<td></td>";
                        }
                        $tableauFiche .= "<td $bgcolor width=10% align=center>$recap[$idFta]</td>"//% Avancement FTA
                                . "<td $bgcolor align=center >$service</td>" //Service               
                                . "<td $bgcolor align=center >$actions</td>"// Actions
                                . "$commentaire</tr >"; // Commentaires
                    }
                } else {
                    if ($createurFta != $createurTmp) {
                        /*
                         * Commentaire de la Fta
                         */

                        $htmlField->setIsEditable(FALSE);
                        $commentaire = $htmlField->getHtmlResult();

                        /*
                         * Nouvelle ligne pour créateur
                         */
                        $tableauFicheTmp .= "<tr class=contenu>"
                                . "<td COLSPAN=" . $nombreDeCellule . " > <font size=2 >" . $createurPrenom . " " . $createurNom . " </td>"
                                . "</tr>"
                                . "<tr class=contenu >"
                                . "<td $bgcolor_header width=\"" . $selection_width . "\" > $icon_header $selection</td>"//Ordre de priorisation
                                . "<td $bgcolor width=8%>" . $nomSiteProduction . "</td>"//Site
                                . "<td $bgcolor width=6%>" . $classification . "</td>"//Client
                                . "<td $bgcolor width=6%>" . $suffixeAgrologicFta . "</td>"//Class
                                . "<td $bgcolor $largeur_html_C1><a title=$createur_link />" . $din . "</a></td>"// Produits
                                . "<td $bgcolor width=3%>" . $idDossierFta . "v" . $idVersionDossierFta . "</td>"//Dossier Fta
                                . "<td $bgcolor width=\"6%\"> <b><font size=\"2\" color=\"#0000FF\">" . $codeArticleLdc . "</font></b></td>"; //Code regate

                        if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                            $tableauFicheTmp.="<td $bgcolor $largeur_html_C3 align=center>" . $HTML_date_echeance_fta["HTML_synthese"] . "</td>"; //% d'avancement
                        } else {
                            $tableauFicheTmp.="<td></td>";
                        }
                        $tableauFicheTmp .= "<td $bgcolor width=10% align=center>$recap[$idFta]</td>"//% Avancement FTA
                                . "<td $bgcolor align=center >$service</td>" //Service               
                                . "<td $bgcolor align=center >$actions</td>"// Actions
                                . "$commentaire</tr >"; // Commentaires
                        $createurTmp = $createurFta;
                    } else {
                        $tableauFicheTmp .= "<tr class=contenu >"
                                . "<td $bgcolor_header width=\"" . $selection_width . "\" > $icon_header $selection</td>"//Ordre de priorisation
                                . "<td $bgcolor width=8% >" . $nomSiteProduction . "</td>"//Site
                                . "<td $bgcolor width=6%>" . $classification . "</td>"//Client
                                . "<td $bgcolor width=6%>" . $suffixeAgrologicFta . "</td>"//Class
                                . "<td $bgcolor $largeur_html_C1><a title=$createur_link />" . $din . "</a></td>"// Produits
                                . "<td $bgcolor width=3%>" . $idDossierFta . "v" . $idVersionDossierFta . "</td>"//Dossier Fta
                                . "<td $bgcolor width=\"6%\"> <b><font size=\"2\" color=\"#0000FF\">" . $codeArticleLdc . "</font></b></td>"; //Code regate

                        if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                            $tableauFicheTmp.="<td $bgcolor $largeur_html_C3 align=center>" . $HTML_date_echeance_fta["HTML_synthese"] . "</td>"; //% d'avancement
                        } else {
                            $tableauFicheTmp.="<td></td>";
                        }
                        $tableauFicheTmp .= "<td $bgcolor width=10% align=center>$recap[$idFta]</td>"//% Avancement FTA
                                . "<td $bgcolor align=center>$service</td>" //Service               
                                . "<td $bgcolor align=center >$actions</td>"// Actions
                                . "$commentaire</tr >"; // Commentaires
                    }
                }

                $tableauFiche.=$tableauFicheTmp;
                $tableauFicheTmp = NULL;
                $service = NULL;
            }
        } else {
            $tableauFiche .= "<tr class=contenu><td>Aucune Fta identifié</td></tr>";
        }

        $tableauFiche .= $javascript . "</tbody></table>";

        return $tableauFiche;
    }

    public static function getFileAriane() {

        switch (self::$syntheseAction) {
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ATTENTE:

                $EtatAvancement = "En attente";

                break;
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS:
                $EtatAvancement = "En cours";

                break;
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES:
                $EtatAvancement = "Effectuées";
                break;

            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ALL:
                $EtatAvancement = "Voir";
                break;
        }

        $fileAriane = "<table class=titre width=100%  ><tr>"
                . "<td>" . FtaRoleModel::getNameRoleByIdRole(self::$idFtaRole) . "</td>"
                . "<td> > </td>"
                . "<td>" . FtaEtatModel::getNameEtatByIdEtat(self::$idFtaEtat) . "</td>"
                . "<td> > </td>"
                . "<td>" . $EtatAvancement . "</td>"
                . "</tr></table>";

        return $fileAriane;
    }

    //function visualiser_fiches */
}
