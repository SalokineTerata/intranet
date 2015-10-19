<?php

/**
 * Page d'accueil
 * 
 * @author Franckwastaken
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
    const VALUE_100 = 100;
    const VALUE_100_POURCENTAGE = '100%';
    const VALUE_MAX_PAR_PAGE = 15;

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
    protected static $ftaModification;
    protected static $ftaConsultation;
    protected static $ftaImpression;

    /**
     * Initialisation des données de la page d'accueil
     * @param type $id_user
     * @param type $idFtaEtat
     * @param type $abrevationFtaEtat
     * @param type $syntheseAction
     * @param type $IdFtaRole
     * @param type $OrderBy
     * @param type $lieuGeo
     */
    public static function initAccueil($id_user, $idFtaEtat, $abrevationFtaEtat, $syntheseAction, $IdFtaRole, $OrderBy, $lieuGeo, $debut) {

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

        /**
         * Modification
         */
        self::$ftaModification = IntranetDroitsAccesModel::getFtaModification(self::$idUser);

        /**
         * Consultation
         */
        self::$ftaConsultation = IntranetDroitsAccesModel::getFtaConsultation(self::$idUser);

        /**
         * Impression
         */
        self::$ftaImpression = IntranetDroitsAccesModel::getFtaImpression(self::$idUser);
        /*
         * Selon le role  nous cherchons ces etats. 
         * 
         */
        self::$arrayFtaEtat = FtaEtatModel::getFtaEtatAndNameByRole(self::$idFtaRole, self::$ftaModification);

        /*
         * $arrayIdFtaAndIdWorkflow[1] sont les id_fta
         * $arrayIdFtaAndIdWorkflow[2] sont les nom des workflows correspondant aux  id_fta
         */
        self::$arrayIdFtaAndIdWorkflow = FtaEtatModel::getIdFtaByEtatAvancement(self::$syntheseAction, self::$abrevationFtaEtat, self::$idFtaRole, self::$idUser, self::$idFtaEtat);

        self::$arrayIdFtaByUserAndWorkflow = UserModel::getIdFtaByUserAndWorkflow(self::$arrayIdFtaAndIdWorkflow, self::$orderBy, $debut);

        self::$arraNameSiteByWorkflow = IntranetActionsModel::getNameSiteByWorkflow(self::$idUser, self::$arrayIdFtaByUserAndWorkflow['3']);

        self::$nombreFta = self::$arrayIdFtaByUserAndWorkflow['2'];
    }

    public static function getTableauSythese() {

        $tableau_synthese = AccueilFta::getHtmlTableauSythese(self::$arrayFtaRole, self::$arrayFtaEtat, self::$abrevationFtaEtat, self::$idFtaRole, self::$syntheseAction);
        $tableau_syntheseWorkflow = AccueilFta::getHtmlTableauSytheseWorkflow(self::$arrayIdFtaByUserAndWorkflow['3'], self::$arraNameSiteByWorkflow);
        $tableau_synthese.=$tableau_syntheseWorkflow;
        return $tableau_synthese;
    }

    /**
     * Fonction de pagination des résultats
     *
     * Retourne le code HTML des liens de pagination
     *    
     * @param integer nombre de résultats par page
     * @param integer numéro de la page courante
     * @param integer nombre de pages avant la page courante
     * @param integer nombre de pages après la page courante
     * @param integer afficher le lien vers la première page (1=oui / 0=non)
     * @param integer afficher le lien vers la dernière page (1=oui / 0=non)
     * @return string code HTML des liens de pagination
     * */
    public static function paginer($nb_results_p_page, $numero_page_courante, $nb_avant, $nb_apres, $premiere, $derniere) {
// Initialisation de la variable a retourner
        $resultat = '';

// nombre total de pages
        $nb_pages = ceil(self::$nombreFta / $nb_results_p_page);
// nombre de pages avant
        $avant = $numero_page_courante > ($nb_avant + 1) ? $nb_avant : $numero_page_courante - 1;
// nombre de pages apres
        $apres = $numero_page_courante <= $nb_pages - $nb_apres ? $nb_apres : $nb_pages - $numero_page_courante;

// premiere page
        if ($premiere && $numero_page_courante - $avant > 1) {
            $resultat .= '<a href="' . htmlspecialchars($_SERVER['PHP_SELF']) . '?numeroPage=1'
                    . '&id_fta_etat=' . self::$idFtaEtat
                    . '&nom_fta_etat=' . self::$abrevationFtaEtat
                    . '&id_fta_role=' . self::$idFtaRole
                    . '&synthese_action=' . self::$syntheseAction . '" title="Première page">&laquo;&laquo;</a>&nbsp;';
        }

// page precedente
        if ($numero_page_courante > 1) {
            $resultat .= '<a href="' . htmlspecialchars($_SERVER['PHP_SELF']) . '?numeroPage=' . ($numero_page_courante - 1)
                    . '&id_fta_etat=' . self::$idFtaEtat
                    . '&nom_fta_etat=' . self::$abrevationFtaEtat
                    . '&id_fta_role=' . self::$idFtaRole
                    . '&synthese_action=' . self::$syntheseAction . '" title="Page précédente ' . ($numero_page_courante - 1) . '">&laquo;</a>&nbsp;';
        }

// affichage des numeros de page
        for ($i = $numero_page_courante - $avant; $i <= $numero_page_courante + $apres; $i++) {
// page courante
            if ($i == $numero_page_courante) {
                $resultat .= '&nbsp;[<strong>' . $i . '</strong>]&nbsp;';
            } else {
                $resultat .= '&nbsp;[<a href="' . htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES) . '?numeroPage=' . $i
                        . '&id_fta_etat=' . self::$idFtaEtat
                        . '&nom_fta_etat=' . self::$abrevationFtaEtat
                        . '&id_fta_role=' . self::$idFtaRole
                        . '&synthese_action=' . self::$syntheseAction . '" title="Consulter la page ' . $i . '">' . $i . '</a>]&nbsp;';
            }
        }

// page suivante
        if ($numero_page_courante < $nb_pages) {
            $resultat .= '<a href="' . htmlspecialchars($_SERVER['PHP_SELF']) . '?numeroPage=' . ($numero_page_courante + 1) . '&id_fta_etat=' . self::$idFtaEtat
                    . '&nom_fta_etat=' . self::$abrevationFtaEtat
                    . '&id_fta_role=' . self::$idFtaRole
                    . '&synthese_action=' . self::$syntheseAction . '" title="Consulter la page ' . ($numero_page_courante + 1) . ' !">&raquo;</a>&nbsp;';
        }

// derniere page     
        if ($derniere && ($numero_page_courante + $apres) < $nb_pages) {
            $resultat .= '<a href="' . htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES) . '?numeroPage=' . $nb_pages
                    . '&id_fta_etat=' . self::$idFtaEtat
                    . '&nom_fta_etat=' . self::$abrevationFtaEtat
                    . '&id_fta_role=' . self::$idFtaRole
                    . '&synthese_action=' . self::$syntheseAction . '" title="Dernière page">&raquo;&raquo;</a>&nbsp;';
        }

// On retourne le resultat
        return $resultat;
    }

    /**
     * 
     * @param type $paramAbrevation1
     * @param type $paramAbrevation2
     * @return string
     */
    private static function getLienByEtatFta($paramAbrevation1, $paramAbrevation2) {
        if ($paramAbrevation1 == 'I' or $paramAbrevation2 == 'P') {
            $tableau_synthese .= 'encours>';
        } else {
            $tableau_synthese .= 'all>';
        }
        return $tableau_synthese;
    }

    /**
     * Affichage HTTML de la barre de navigation du la page d'accueil
     * @param type $paramRole
     * @param type $paramEtat
     * @param type $paramNomEtat
     * @param type $paramIdFtaRole
     * @param type $paramSyntheseAction
     * @return type
     */
    private static function getHtmlTableauSythese($paramRole, $paramEtat, $paramNomEtat, $paramIdFtaRole, $paramSyntheseAction) {

        $idKeyNameFtaEtat = '0';
        $tableau_synthese = '';

        if (!self::$nombreFta) {
            self::$nombreFta = '0';
        }
        switch (self::$syntheseAction) {
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ATTENTE:
                $nombreFta1 = ' (' . self::$nombreFta . ')';

                break;
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS:
                $nombreFta2 = ' (' . self::$nombreFta . ')';
                break;
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES:
                $nombreFta3 = ' (' . self::$nombreFta . ')';
                break;

            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ALL:
                $nombreFta4 = ' (' . self::$nombreFta . ')';
                break;
        }

        switch ($paramNomEtat) {
            case FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION:
                $lien['0'] = '<a href=index.php?id_fta_etat=1'
                        . '&nom_fta_etat=' . FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION
                        . '&id_fta_role=' . $paramIdFtaRole
                        . '&synthese_action=attente >En attente' . $nombreFta1 . '</a>';
                $lien['1'] = ' <a href=index.php?id_fta_etat=1'
                        . '&nom_fta_etat=' . FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION
                        . '&id_fta_role=' . $paramIdFtaRole
                        . '&synthese_action=encours >En cours' . $nombreFta2 . '</a>';
                $lien['2'] = '<a href=index.php?id_fta_etat=1'
                        . '&nom_fta_etat=' . FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION
                        . '&id_fta_role=' . $paramIdFtaRole
                        . '&synthese_action=correction >Effectuées' . $nombreFta3 . '</a>';
                break;
            case FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE:
                $lien['0'] = '<a href=index.php?id_fta_etat=3'
                        . '&nom_fta_etat=' . FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE
                        . '&id_fta_role=' . $paramIdFtaRole
                        . '&synthese_action=all >Voir' . $nombreFta4 . '</a>';
                $lien['1'] = '';
                $lien['2'] = '';
                break;
            case FtaEtatModel::ETAT_ABREVIATION_VALUE_ARCHIVE:
                $lien['0'] = '<a href=index.php?id_fta_etat=5'
                        . '&nom_fta_etat=' . FtaEtatModel::ETAT_ABREVIATION_VALUE_ARCHIVE
                        . '&id_fta_role=' . $paramIdFtaRole
                        . '&synthese_action=all >Voir' . $nombreFta4 . '</a>';
                $lien['1'] = '';
                $lien['2'] = '';
                break;
            case FtaEtatModel::ETAT_ABREVIATION_VALUE_RETIRE:
                $lien['0'] = '<a href=index.php?id_fta_etat=6'
                        . '&nom_fta_etat=' . FtaEtatModel::ETAT_ABREVIATION_VALUE_RETIRE
                        . '&id_fta_role=' . $paramIdFtaRole
                        . '&synthese_action=all >Voir' . $nombreFta4 . '</a>';
                $lien['1'] = '';
                $lien['2'] = '';
                break;
        }



        $tableau_synthese = '<table  class = contenu width = 100% border = 0>'
                /*
                 * Entête de la barre de navigation de la page d'accueil
                 */
                . '<TR>'
                . '<TH>Role </TH> <TH>Etat FTA</TH> <TH>Etat d\'Avancement</TH>'
                . '</TR>';
        /*
         * Données du tableau
         */
        $tableau_synthese .= self::getLineSynthese($paramRole, $paramEtat, $paramIdFtaRole, $paramNomEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole = '0', $idKeyNameFtaEtat = '0', $idKeyValueFtaEtatAvancement = '0');
        $tableau_synthese .= self::getLineSynthese($paramRole, $paramEtat, $paramIdFtaRole, $paramNomEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole = '1', $idKeyNameFtaEtat = '1', $idKeyValueFtaEtatAvancement = '1');
        $tableau_synthese .= self::getLineSynthese($paramRole, $paramEtat, $paramIdFtaRole, $paramNomEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole = '2', $idKeyNameFtaEtat = '2', $idKeyValueFtaEtatAvancement = '2');
        $tableau_synthese .= self::getLineSynthese($paramRole, $paramEtat, $paramIdFtaRole, $paramNomEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole = '3', $idKeyNameFtaEtat = '3', $idKeyValueFtaEtatAvancement = '3');
        $tableau_synthese .= self::getLineSynthese($paramRole, $paramEtat, $paramIdFtaRole, $paramNomEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole = '4', $idKeyNameFtaEtat = '4', $idKeyValueFtaEtatAvancement = '3');
        $tableau_synthese .= self::getLineSynthese($paramRole, $paramEtat, $paramIdFtaRole, $paramNomEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole = AccueilFta::VALUE_5, $idKeyNameFtaEtat = AccueilFta::VALUE_5, $idKeyValueFtaEtatAvancement = '3');

        return $tableau_synthese;
    }

    /**
     * Tableau Html affichant les noms des espaces de travail auxquel l'utilisateur aura les droits d'accès 
     * et le noms des sites de production correspondant en info-bulles
     * @param type $paramWorkflow
     * @param type $paramNameSiteByWorkflow
     * @return string
     */
    private static function getHtmlTableauSytheseWorkflow($paramWorkflow, $paramNameSiteByWorkflow) {
        $bgcolor = 'bgcolor = #3CDA31 ';

        /*
         * Debut de la ligne
         */
        $tableau_synthese = '<TABLE ' . $bgcolor . ' width=100%>'
                . '<TR>'
                . '<td> Espace de Travail :</td>';

        /*
         * Infobulle affichant le noms des sites de production des fta par workflow
         */
        $paramNameSite0 = self::getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite = '0');
        $paramNameSite1 = self::getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite = '1');
        $paramNameSite2 = self::getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite = '2');
        $paramNameSite3 = self::getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite = '3');
        $paramNameSite4 = self::getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite = '4');
        $paramNameSite5 = self::getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite = AccueilFta::VALUE_5);

        $paramNameSite = array_merge($paramNameSite0, $paramNameSite1, $paramNameSite2, $paramNameSite3, $paramNameSite4, $paramNameSite5);

        /**
         * Element de la ligne
         */
        $tableau_synthese .=self::getLineSyntheseWorkflow($paramWorkflow, $idKeyNameFtaWorkflow = '0', $paramNameSite, $idKeyNameFtaSite = '0');
        $tableau_synthese .=self::getLineSyntheseWorkflow($paramWorkflow, $idKeyNameFtaWorkflow = '1', $paramNameSite, $idKeyNameFtaSite = '1');
        $tableau_synthese .=self::getLineSyntheseWorkflow($paramWorkflow, $idKeyNameFtaWorkflow = '2', $paramNameSite, $idKeyNameFtaSite = '2');
        $tableau_synthese .=self::getLineSyntheseWorkflow($paramWorkflow, $idKeyNameFtaWorkflow = '3', $paramNameSite, $idKeyNameFtaSite = '3');
        $tableau_synthese .=self::getLineSyntheseWorkflow($paramWorkflow, $idKeyNameFtaWorkflow = '4', $paramNameSite, $idKeyNameFtaSite = '4');
        $tableau_synthese .=self::getLineSyntheseWorkflow($paramWorkflow, $idKeyNameFtaWorkflow = AccueilFta::VALUE_5, $paramNameSite, $idKeyNameFtaSite = AccueilFta::VALUE_5);
        $tableau_synthese .= '<TR >'
                . '</TABLE><TABLE>';

        return $tableau_synthese;
    }

    /*
     * fonction de mise e forme recuperant tous les nom des site dont l'utilisateur à les droits d'accès par workflow
     */

    /**
     * Mise en forme des noms de site auxquel l'utilisateur aura les drotis d'accès en info-bulle
     * @param type $paramNameSiteByWorkflow
     * @param type $idKeyNameFtaSite
     * @return string
     */
    private static function getNameSiteByWorkflow($paramNameSiteByWorkflow, $idKeyNameFtaSite) {
        $codeSautDeLigne = '&#013';
        if ($paramNameSiteByWorkflow[$idKeyNameFtaSite]) {
            $paramNameSiteByWorkflow = $paramNameSiteByWorkflow[$idKeyNameFtaSite];
        }
        for ($i = 0; $i < count($paramNameSiteByWorkflow); $i++) {
            $paramNameSite[$idKeyNameFtaSite] .= $paramNameSiteByWorkflow[$i][IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS] . $codeSautDeLigne;
        }
        return $paramNameSite;
    }

    /**
     * Affiche les lignes concernant les worflows de la barre de navigation de la page d'accueil
     * @param type $paramArrayWorkflow
     * @param type $idKeyNameFtaWorkflow
     * @param type $paramNameSiteByWorkflow
     * @param type $idKeyNameFtaSite
     * @return type
     */
    private static function getLineSyntheseWorkflow($paramArrayWorkflow, $idKeyNameFtaWorkflow, $paramNameSiteByWorkflow, $idKeyNameFtaSite) {

        return '<td>'
                . '<a href=#'
                . $paramArrayWorkflow[$idKeyNameFtaWorkflow][FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW]
                . ' title= ' . $paramNameSiteByWorkflow[$idKeyNameFtaSite] . ' >'
                . $paramArrayWorkflow[$idKeyNameFtaWorkflow][FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW]
                . '</a>'
                . '</td>'

        ;
    }

    /**
     * Affiches les lignes de la barre de navigation de la page d'accueil
     * @param array $paramArrayRole
     * @param array $paramArrayEtat
     * @param type $idFtaRole
     * @param type $nomFtaEtat
     * @param type $paramSyntheseAction
     * @param type $lien
     * @param type $idFieldNomFtaRole
     * @param type $idKeyNameFtaEtat
     * @param type $idKeyValueFtaEtatAvancement
     * @return string
     */
    private static function getLineSynthese(
    $paramArrayRole, $paramArrayEtat, $idFtaRole, $nomFtaEtat, $paramSyntheseAction, $lien, $idFieldNomFtaRole, $idKeyNameFtaEtat, $idKeyValueFtaEtatAvancement
    ) {
        $color = '';
        $color1 = '';
        $color2 = '';


        if ($paramArrayRole[$idFieldNomFtaRole][FtaRoleModel::KEYNAME] == $idFtaRole) {
            $color = 'bgcolor=#AAAAFF';
        }

        if ($paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION] == $nomFtaEtat) {
            $color1 = 'bgcolor=#AAAAFF';
        }


        switch ($idKeyValueFtaEtatAvancement) {
            case '0':
                $ligneEtatAvancement = 'attente';
                if ($lien['2'] == NULL) {
                    $ligneEtatAvancement = 'all';
                }
                break;

            case '1':
                $ligneEtatAvancement = 'encours';
                break;

            case '2':
                $ligneEtatAvancement = 'correction';
                break;
        }
        if ($paramSyntheseAction == $ligneEtatAvancement) {
            $color2 = 'bgcolor=#AAAAFF';
        }


        return '<TR>'
                . '<td ' . $color . '  id=\'' . $paramArrayRole[$idFieldNomFtaRole][FtaRoleModel::FIELDNAME_NOM_FTA_ROLE] . '\'> '
                . '<a href=index.php?id_fta_etat=' . $paramArrayEtat['0'][FtaEtatModel::KEYNAME]
                . '&nom_fta_etat=' . $paramArrayEtat['0'][FtaEtatModel::FIELDNAME_ABREVIATION]
                . '&id_fta_role=' . $paramArrayRole[$idFieldNomFtaRole][FtaRoleModel::KEYNAME]
                . '&synthese_action='
                . AccueilFta::getLienByEtatFta($paramArrayEtat['0'][FtaEtatModel::FIELDNAME_ABREVIATION], $paramArrayEtat ['0'][FtaEtatModel::FIELDNAME_ABREVIATION])
                . $paramArrayRole[$idFieldNomFtaRole][FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE]
                . '</a>'
                . '</td>'
                . '<td ' . $color1 . ' id=\'' . $paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION] . '\'>  '
                . '<a href=index.php?id_fta_etat=' . $paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::KEYNAME]
                . '&nom_fta_etat=' . $paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION]
                . '&id_fta_role=' . $idFtaRole
                . '&synthese_action='
                . AccueilFta::getLienByEtatFta($paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION], $paramArrayEtat [$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_ABREVIATION])
                . $paramArrayEtat[$idKeyNameFtaEtat][FtaEtatModel::FIELDNAME_NOM_FTA_ETAT]
                . '</a>'
                . '</td>'
                . '<td ' . $color2 . ' >' . $lien[$idKeyValueFtaEtatAvancement]
                . '</td>'
                . '</TR>'
        ;
    }

    /**
     * Tableau Html affichant la liste des Fta
     * @return string
     */
    public static function getHtmlTableauFiche() {

        $tableauFicheN = '';
        $tableauFicheNWork = '';
        $tableauFicheTrWork = '';
        $largeur_html_C1 = ' width=15% '; // largeur cellule type
        $largeur_html_C3 = ' width=16% '; // largeur cellule type
        $selection_width = '1%';

        $tableauFiche = '';
        $tableauFicheTr = '';
        $tableauFiche = '<table id=tableauFiche  align=middle class=titre width=100% >'
                . '<thead><tr class=titre_principal><th></th>'
        ;

//Contrôle pour savoir si on est sur l'index du module
        $URL = $_SERVER['REQUEST_URI'];

        switch (self::$syntheseAction) {
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ATTENTE:
                $URL = substr($URL, '0', strpos($URL, self::$syntheseAction) + '7');

                break;
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS:
                $URL = substr($URL, '0', strpos($URL, self::$syntheseAction) + '7');
                break;
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES:
                $URL = substr($URL, '0', strpos($URL, self::$syntheseAction) + '10');
                break;

            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ALL:
                $URL = substr($URL, '0', strpos($URL, self::$syntheseAction) + '3');
                break;
        }
        if (substr($URL, -2) == 'in') {
            $URL = $URL . 'tranet/apps/fta/index.php?';
        }
        $tableauFiche .= '<th><a href=' . $URL . '&order_common=Site_de_production><img src=../lib/images/order-AZ.png title=\'Ordonné par Nom de Site de Production\'  border=\'0\' /></a>'
                . 'Site'
                . '</th><th>'
                . '<a href=' . $URL . '&order_common=id_fta><img src=../lib/images/order-AZ.png title=\'Ordonné par Nom du Propriétaire\'  border=\'0\' /></a>'
                . 'Client'
                . '</th><th>'
                . '<a href=' . $URL . '&order_common=suffixe_agrologic_fta><img src=../lib/images/order-AZ.png title=\'Ordonné par Nom de Classification\'  border=\'0\' /></a>'
                . 'Class.'
                . '</th><th>'
                . '<a href=' . $URL . '&order_common=designation_commerciale_fta><img src=../lib/images/order-AZ.png title=\'Ordonné par Noms du Produit\'  border=\'0\' /></a>'
                . 'Produits'
                . '</th><th>'
                . '<a href=' . $URL . '&order_common=id_dossier_fta><img src=../lib/images/order-AZ.png title=\'Ordonné par code Fta\'  border=\'0\' /></a>'
                . 'Dossier FTA'
                . '</th><th>'
                . '<a href=' . $URL . '&order_common=code_article_ldc><img src=../lib/images/order-AZ.png title=\'Ordonné par code arcadia\'  border=\'0\' /></a>'
                . 'Code Arcadia'
                . '</th><th>'
                . '<a href=' . $URL . '&order_common=date_echeance_fta><img src=../lib/images/order-AZ.png title=\'Ordonné par Date\'  border=\'0\' /></a>'
                . 'Echéance de validation'
                . '</th><th>'
                . '% Avancement FTA'
                . '</th><th>'
                . 'Service'
                . '</th><th>'
                . 'Actions'
                . '</th><th>'
                . 'Commentaires'
                . '</th>';

        $tmp = null;
        if (self::$arrayIdFtaByUserAndWorkflow['1']) {
            $createurNTmp = null;
            $createurTrTmp = null;
            foreach (self::$arrayIdFtaByUserAndWorkflow['1'] as $rowsDetail) {
                $workflowDescription = $rowsDetail[FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW];
                $workflowName = $rowsDetail[FtaWorkflowModel::FIELDNAME_NOM_FTA_WORKFLOW];


                /**
                 * Droits d'actions
                 */
                $valueIsGestionnaire = FtaRoleModel::getValueIsGestionnaire(self::$idFtaRole);


                /**
                 * Liste des processus pouvant être validé
                 */
                $arrayProcessusValidation = FtaProcessusCycleModel::getArrayProcessusValidationFTA($rowsDetail[FtaModel::FIELDNAME_WORKFLOW]);


                /**
                 * Listes des processus auxquel l'utilisateur connecté à les droits d'accès
                 */
                $arrayProcessusAcces = FtaWorkflowStructureModel::getArrayProcessusByRoleAndWorkflow(self::$idFtaRole, $rowsDetail[FtaModel::FIELDNAME_WORKFLOW]);
                $accesTransitionButton = is_null(array_intersect($arrayProcessusValidation, $arrayProcessusAcces));
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
                $idclassification = $rowsDetail[FtaModel::FIELDNAME_ID_FTA_CLASSIFICATION2];

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

                $nomSiteProduction = GeoModel::getProductionSiteName($siteProduction);


                /*
                 * Récupération du nom du créateur de la fta
                 */

                $arrayNomCreateur = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT ' . UserModel::FIELDNAME_NOM . ',' . UserModel::FIELDNAME_PRENOM
                                . ' FROM ' . UserModel::TABLENAME
                                . ' WHERE ' . UserModel::KEYNAME . '=\'' . $createurFta . '\' '
                );

                if ($arrayNomCreateur) {
                    foreach ($arrayNomCreateur as $rowsNomCreateur) {
                        $createurNom = $rowsNomCreateur[UserModel::FIELDNAME_NOM];
                        $createurPrenom = $rowsNomCreateur[UserModel::FIELDNAME_PRENOM];
                    }
                }




                /*
                 * Recuperation du proprietaire
                 * à modifier
                 */

                if ($idclassification) {
                    $classification = ClassificationArborescenceArticleCategorieContenuModel::getElementClassificationFta($idclassification, ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE);
                }

                /*
                 * Designation commerciale
                 */
                if (strlen($designationCommercialeFta) > '55') {
                    $designationCommercialeFta = substr($designationCommercialeFta, '0', '52') . '...';
                }
                if ($LIBELLE) {
                    $din = $LIBELLE;
                } else {
                    $din = '<font size=\'1\' color=\'#808080\'><i>' . $designationCommercialeFta . '</i></font>';
                }

                /*
                 * Nom de l'assistante de projet responsable:
                 */
                $createur_link = '\'Géré par ' . $createurPrenom . ' ' . $createurNom . '\'';


                /*
                 * Calcul d'etat d'avancement
                 */

                $taux_temp = FtaSuiviProjetModel::getFtaTauxValidation($idFta);
                $recap[$idFta] = round($taux_temp['0'] * '100', '0') . '%';

                /*
                 * Definition de la couleur de la cellule selon l'état d'avancement
                 */

                switch (self::$syntheseAction) {
                    case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ATTENTE:
                        $ok = '0';
                        $bgcolor = 'bgcolor=#A5A5CE ';

                        break;
                    case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS:
                        $ok = '1';
                        $bgcolor = '';

                        break;
                    case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES:
                        $ok = '2';
                        if ($recap[$idFta] == AccueilFta::VALUE_100_POURCENTAGE) {
                            $bgcolor = 'bgcolor=#AFFF5A';
                        } else {
                            $bgcolor = 'bgcolor=#A5A5CE ';
                        }
                        break;

                    case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ALL:
                        $bgcolor = 'bgcolor=#AFFF5A';
                        break;
                }

                $HTML_date_echeance_fta = FtaProcessusDelaiModel::getFtaDelaiAvancement($idFta);
//$return['status']
//    0: Aucun dépassement des échéances
//    1: Au moins un processus en cours a dépassé son échéance
//    2: La date d'échéance de validation de la FTA est dépassée
//    3: Il n'y a pas de date d'échéance de validation FTA saisie
//$return['liste_processus_depasses'][$id_processus]
//    Renvoi un tableau associatif contenant:
//    - la listes des processus en cours ayant dépassé leur échéance
//    - leur date d'échéance
//$return['HTML_synthese']
//    Contient le code source HTML utilisé pour la fonction visualiser_fiches()
//echo $HTML_date_echeance_fta['status'];
                switch ($HTML_date_echeance_fta['status']) {
                    case '1':
                        $bgcolor_header = $bgcolor;
                        $icon_header = '<img src=../lib/images/exclamation.png title=\'Certaines échéances sont dépassées !\' width=30 height=27 border=0 />';
                        break;
                    case '2':
                        $bgcolor_header = 'class=couleur_rouge';
                        $icon_header = '<img src=../lib/images/exclamation.png title=\'Certaines échéances sont dépassées !\' width=30 height=27 border=0 />';
                        break;
                    default:
//$bgcolor_header = $bgcolor;
                        $icon_header = '';
                }

                /*
                 * Droit de consultation standard HTML
                 */
                $actions = '';



                if (
                        (self::$ftaModification)
                        or ( self::$ftaConsultation and self::$abrevationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE )
                )
                    $actions = '<a '
                            . 'href=modification_fiche.php'
                            . '?id_fta=' . $idFta
                            . '&synthese_action=' . self::$syntheseAction
                            . '&comeback=1'
                            . '&id_fta_etat=' . self::$idFtaEtat
                            . '&abreviation_fta_etat=' . self::$abrevationFtaEtat
                            . '&id_fta_role=' . self::$idFtaRole
                            . ' /><img src=../lib/images/next.png alt=\'\' title=\'Voir la FTA\' width=\'30\' height=\'25\' border=\'0\' />'
                            . '</a>'
                    ;

                /*
                 * Export PDF
                 */
                if (
                        (self::$ftaImpression and ( $abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_VALIDE))
                        or ( $_SESSION['mode_debug'] == '1') or ( $workflowName == 'presentation')
                ) {

                    $actions .= '  '
                            . '<a '
                            . 'href=pdf.php?id_fta=' . $idFta . '&mode=client '
                            . 'target=_blank'
                            . '><img src=./images/pdf.png alt=\'\' title=\'Exportation PDF\' width=\'30\' height=\'25\' border=\'0\' />'
                            . '</a>'
                    ;
                }
                /*
                 * Transiter
                 */
                if (
                        (
//$ok == '2' and
                        self::$idFtaRole == '1' and $recap[$idFta] == '100%'
//                        and ( $abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION )
                        )or ( $ok == '2' and $accesTransitionButton == FALSE && $recap[$idFta] == '100%') and (
                        self::$abrevationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION
                        ) or ( self::$syntheseAction == FtaEtatModel::ETAT_AVANCEMENT_VALUE_ALL ) and self::$ftaModification
                        or ( self::$idFtaRole == '1' and self::$syntheseAction == FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES)
                ) {
                    $actions .= '<a '
                            . 'href=transiter.php'
                            . '?id_fta=' . $idFta
                            . '&id_fta_role=' . self::$idFtaRole
                            . '><img src=./images/transiter.png alt=\'\' title=\'Transiter\' width=\'30\' height=\'30\' border=\'0\' />'
                            . '</a>'
                    ;

                    if (self::$syntheseAction == FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES and $recap[$idFta] == '100%') {
                        $selection = '<input type=\'checkbox\' name=selection_fta value=\'' . $idFta . '\' checked />';
                        $traitementDeMasse = '1';
                        $selection_width = '2%';
                        $StringFta .= $idFta . ',';
                        $tableauFiche .= '<input type=hidden name=arrayFta value=' . $StringFta . '>';
                    }
                }

                /*
                 * Action que seul les Chefs de projet peuvent faire
                 */
                /*
                 * Retirer une FTA en cours de modification
                 */
                if ($valueIsGestionnaire == '1') {
                    if ($abreviationFtaEtat <> FtaEtatModel::ETAT_ABREVIATION_VALUE_RETIRE) {
                        $actions .= '<a '
                                . 'href=# '
                                . 'onClick=confirmation_correction_fta' . $idFta . '(); '
                                . '/>'
                                . '<img src=../lib/images/supprimer.png alt=\'Retirer cette FTA\' width=\'25\' height=\'25\' border=\'0\' />'
                                . '</a>'
                        ;
                        $javascript.='
                           <SCRIPT LANGUAGE=JavaScript>
                                   function confirmation_correction_fta' . $idFta . '()
                                   {
                                   if(confirm(\'Etes vous certain de vouloir retirer cette Fiche Technique ? Les autres fiches du dossier resteront indem.\'))
                                   {
                                       location.href =\'transiter.php?id_fta=' . $idFta . '&id_fta_chapitre_encours=' . $idFtaChapitreEncours . '&synthese_action=' . self::$syntheseAction . '&action=correction&demande_abreviation_fta_transition=R\'
                                   }
                                    else{}
                                   }
                           </SCRIPT>
                           ';
                    }

                    $actions .= '<a '
                            . 'href=creer_fiche.php'
                            . '?action=dupliquer_fiche'
                            . '&id_fta=' . $idFta
                            . '&id_fta_role=' . self::$idFtaRole
                            . '><img src=../lib/images/copie.png alt=\'\' title=\'Dupliquer\' width=\'30\' height=\'30\' border=\'0\' />'
                            . '</a>'
                    ;
                }


                /*
                 * Noms des services dans lequel la Fta se trouve
                 */
                $arrayService = FtaRoleModel::getNameRoleEncoursByIdFta($idFta, $idWorkflowFtaEncours);
                if ($arrayService) {
                    foreach ($arrayService as $rowsService) {
                        $service .= $rowsService[FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE] . '<br>';
                    }
                }
                if ($recap[$idFta] <> '100%') {
                    $createurFtaTr = $createurFta;
                    $workflowTR = $workflowDescription;
                    $diffWorkflowTr = $workflowTR <> $workflowTrTmp;
                    if ($diffWorkflowTr) {
                        $tableauFicheTr2 .= $tableauFicheTrWork . $tableauFicheTr;
                        $nombreDeCellule = '12';
                        $tableauFicheTrWork = '<tbody  id=\'' . $workflowName . '\' >'
                                . '<tr class=contenu>'
                                . '<td  class=titre COLSPAN=' . $nombreDeCellule . '>' . $workflowDescription . '</td>'
                                . '</tr>';
                        $workflowTrTmp = $rowsDetail[FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW];
                        $tableauFicheTr = NULL;
                        $tmp = $rowsDetail[FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW];
                    }
                } else {
                    $createurFtaN = $createurFta;
                    $workflowN = $workflowDescription;
                    $diffWorkflowN = $workflowN <> $workflowNTmp;
                    if ($diffWorkflowN) {
                        $tableauFicheN2.= $tableauFicheNWork . $tableauFicheN;
                        $nombreDeCellule = '12';
                        $tableauFicheNWork = '<tbody  id=\'' . $workflowName . '\' >'
                                . '<tr class=contenu>'
                                . '<td  class=titre COLSPAN=' . $nombreDeCellule . '>' . $workflowDescription . '</td>'
                                . '</tr>';
                        $workflowNTmp = $rowsDetail[FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW];
                        $tableauFicheN = NULL;
                        $tmp = $rowsDetail[FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW];
                    }
                }
                /**
                 * TableauN les idFta à 100% et tableauTr les autres
                 * Tableau avec Tmp sont les lignes sans le noms du créateur
                 * Conditions :
                 * - l'utilisateur connecté est il le créateur de la Fta
                 * - l'utilisateur précedent est il le même créateur de la Fta actuel
                 * - la Fta actuel est-elle à 100%
                 * - Avons-nous changer de workflow ?
                 * - Les fta créer par l'utilisateur connectée doivent vu en priorité
                 */
                if (self::$idUser == $createurFta) {
                    /*
                     * Commentaire de la Fta
                     */
                    /*
                     * @TODO caractères spéciaux de l'encodage ajax
                     */
                    $htmlField->setIsEditable(TRUE);
                    $commentaire = $htmlField->getHtmlResult();
                    if ($recap[$idFta] == '100%') {
                        if ($createurFtaN <> $createurNTmp or $diffWorkflowN) {
                            $tableauFicheN = '<tr class=contenu>'
                                    . '<td COLSPAN=' . $nombreDeCellule . ' ><font size=2 >' . $createurPrenom . ' ' . $createurNom . ' </td>'
                                    . '</tr>'
                                    . '<tr class=contenu >'
                                    . '<td ' . $bgcolor_header . ' width=\'' . $selection_width . '\' > ' . $icon_header . $selection . '</td>'//Ordre de priorisation
                                    . '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '</td>'//Site
                                    . '<td ' . $bgcolor . ' width=6%>' . $classification . '</td>'//Client
                                    . '<td ' . $bgcolor . ' width=6%>' . $suffixeAgrologicFta . '</td>'// Raccourcie Class.
                                    . '<td ' . $bgcolor . $largeur_html_C1 . '><a title=' . $createur_link . '/>' . $din . '</a></td>'// Produits
                                    . '<td ' . $bgcolor . ' width=3%>' . $idDossierFta . 'v' . $idVersionDossierFta . '</td>'//Dossier Fta
                                    . '<td ' . $bgcolor . ' width=\'6%\'> <b><font size=\'2\' color=\'#0000FF\'>' . $codeArticleLdc . '</font></b></td>'; //Code regate

                            if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                                $tableauFicheN.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
                            } else {
                                $tableauFicheN.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
                            }
                            $tableauFicheN .= '<td ' . $bgcolor . ' width=10% align=center>' . $recap[$idFta] . '</td>'//% Avancement FTA
                                    . '<td ' . $bgcolor . ' align=center >' . $service . '</td>' //Service               
                                    . '<td ' . $bgcolor . ' align=center >' . $actions . '</td>'// Actions
                                    . $commentaire . '</tr >'; // Commentaires
                            $createurNTmp = $createurFtaN;
                        } else {
                            $tableauFicheN .= '<tr class=contenu >'
                                    . '<td ' . $bgcolor_header . ' width=\'' . $selection_width . '\' >' . $icon_header . $selection . '</td>'//Ordre de priorisation
                                    . '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '</td>'//Site
                                    . '<td ' . $bgcolor . ' width=6%>' . $classification . '</td>'//Client
                                    . '<td ' . $bgcolor . ' width=6%>' . $suffixeAgrologicFta . '</td>'// Raccourcie Class.
                                    . '<td ' . $bgcolor . $largeur_html_C1 . '><a title=' . $createur_link . '/>' . $din . '</a></td>'// Produits
                                    . '<td ' . $bgcolor . ' width=3%>' . $idDossierFta . 'v' . $idVersionDossierFta . '</td>'//Dossier Fta
                                    . '<td ' . $bgcolor . ' width=\'6%\'> <b><font size=\'2\' color=\'#0000FF\'>' . $codeArticleLdc . '</font></b></td>'; //Code regate

                            if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                                $tableauFicheN.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
                            } else {
                                $tableauFicheN.='<td ' . $bgcolor . '></td>';
                            }
                            $tableauFicheN .= '<td ' . $bgcolor . ' width=10% align=center>' . $recap[$idFta] . '</td>'//% Avancement FTA
                                    . '<td ' . $bgcolor . ' align=center >' . $service . '</td>' //Service               
                                    . '<td ' . $bgcolor . ' align=center >' . $actions . '</td>'// Actions
                                    . $commentaire . '</tr >'; // Commentaires
                        }
                    } else {
                        if ($createurFtaTr <> $createurTrTmp or $diffWorkflowTr) {
                            $tableauFicheTr .= '<tr class=contenu>'
                                    . '<td COLSPAN=' . $nombreDeCellule . ' ><font size=2 >' . $createurPrenom . ' ' . $createurNom . ' </td>'
                                    . '</tr>'
                                    . '<tr class=contenu >'
                                    . '<td ' . $bgcolor_header . ' width=\'' . $selection_width . '\' >' . $icon_header . $selection . '</td>'//Ordre de priorisation
                                    . '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '</td>'//Site
                                    . '<td ' . $bgcolor . ' width=6%>' . $classification . '</td>'//Client
                                    . '<td ' . $bgcolor . ' width=6%>' . $suffixeAgrologicFta . '</td>'/// Raccourcie Class.
                                    . '<td ' . $bgcolor . $largeur_html_C1 . '><a title=' . $createur_link . '/>' . $din . '</a></td>'// Produits
                                    . '<td ' . $bgcolor . ' width=3%>' . $idDossierFta . 'v' . $idVersionDossierFta . '</td>'//Dossier Fta
                                    . '<td ' . $bgcolor . ' width=\'6%\'> <b><font size=\'2\' color=\'#0000FF\'>' . $codeArticleLdc . '</font></b></td>'; //Code regate

                            if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                                $tableauFicheTr.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
                            } else {
                                $tableauFicheTr.='<td ' . $bgcolor . '></td>';
                            }
                            $tableauFicheTr .= '<td ' . $bgcolor . ' width=10% align=center>' . $recap[$idFta] . '</td>'//% Avancement FTA
                                    . '<td ' . $bgcolor . ' align=center >' . $service . '</td>' //Service               
                                    . '<td ' . $bgcolor . ' align=center >' . $actions . '</td>'// Actions
                                    . $commentaire . '</tr >'; // Commentaires
                            $createurTrTmp = $createurFtaTr;
                        } else {
                            $tableauFicheTr .= '<tr class=contenu >'
                                    . '<td ' . $bgcolor_header . ' width=\'' . $selection_width . '\' >' . $icon_header . $selection . '</td>'//Ordre de priorisation
                                    . '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '</td>'//Site
                                    . '<td ' . $bgcolor . ' width=6%>' . $classification . '</td>'//Client
                                    . '<td ' . $bgcolor . ' width=6%>' . $suffixeAgrologicFta . '</td>'// Raccourcie Class.
                                    . '<td ' . $bgcolor . $largeur_html_C1 . '><a title=' . $createur_link . '/>' . $din . '</a></td>'// Produits
                                    . '<td ' . $bgcolor . ' width=3%>' . $idDossierFta . 'v' . $idVersionDossierFta . '</td>'//Dossier Fta
                                    . '<td ' . $bgcolor . ' width=\'6%\'> <b><font size=\'2\' color=\'#0000FF\'>' . $codeArticleLdc . '</font></b></td>'; //Code regate

                            if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                                $tableauFicheTr.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
                            } else {
                                $tableauFicheTr.='<td ' . $bgcolor . ' ></td>';
                            }
                            $tableauFicheTr .= '<td ' . $bgcolor . ' width=10% align=center>' . $recap[$idFta] . '</td>'//% Avancement FTA
                                    . '<td ' . $bgcolor . ' align=center >' . $service . '</td>' //Service               
                                    . '<td ' . $bgcolor . ' align=center >' . $actions . '</td>'// Actions
                                    . $commentaire . '</tr >'; // Commentaires
                        }
                    }
                } else {
                    /*
                     * Commentaire de la Fta
                     */

                    $htmlField->setIsEditable(FALSE);
                    $commentaire = $htmlField->getHtmlResult();

                    /*
                     * Nouvelle ligne pour créateur
                     */
                    if ($recap[$idFta] == '100%') {
                        if ($createurFtaN <> $createurNTmp or $diffWorkflowN) {
                            $tableauFicheTmp .= '<tr class=contenu>'
                                    . '<td COLSPAN=' . $nombreDeCellule . ' > <font size=2 >' . $createurPrenom . ' ' . $createurNom . ' </td>'
                                    . '</tr>'
                                    . '<tr class=contenu >'
                                    . '<td ' . $bgcolor_header . ' width=\'' . $selection_width . '\' >' . $icon_header . $selection . '</td>'//Ordre de priorisation
                                    . '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '</td>'//Site
                                    . '<td ' . $bgcolor . ' width=6%>' . $classification . '</td>'//Client
                                    . '<td ' . $bgcolor . ' width=6%>' . $suffixeAgrologicFta . '</td>'// Raccourcie Class.
                                    . '<td ' . $bgcolor . $largeur_html_C1 . '><a title=' . $createur_link . '/>' . $din . '</a></td>'// Produits
                                    . '<td ' . $bgcolor . ' width=3%>' . $idDossierFta . 'v' . $idVersionDossierFta . '</td>'//Dossier Fta
                                    . '<td ' . $bgcolor . ' width=\'6%\'> <b><font size=\'2\' color=\'#0000FF\'>' . $codeArticleLdc . '</font></b></td>'; //Code regate

                            if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                                $tableauFicheTmp.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
                            } else {
                                $tableauFicheTmp.='<td ' . $bgcolor . ' ></td>';
                            }
                            $tableauFicheTmp .= '<td ' . $bgcolor . ' width=10% align=center>' . $recap[$idFta] . '</td>'//% Avancement FTA
                                    . '<td ' . $bgcolor . ' align=center >' . $service . '</td>' //Service               
                                    . '<td ' . $bgcolor . ' align=center >' . $actions . '</td>'// Actions
                                    . $commentaire . '</tr >'; // Commentaires
                            $createurNTmp = $createurFtaN;
                        } else {
                            $tableauFicheTmp .= '<tr class=contenu >'
                                    . '<td ' . $bgcolor_header . ' width=\'' . $selection_width . '\' >' . $icon_header . $selection . '</td>'//Ordre de priorisation
                                    . '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '</td>'//Site
                                    . '<td ' . $bgcolor . ' width=6%>' . $classification . '</td>'//Client
                                    . '<td ' . $bgcolor . ' width=6%>' . $suffixeAgrologicFta . '</td>'// Raccourcie Class.
                                    . '<td ' . $bgcolor . $largeur_html_C1 . '><a title=' . $createur_link . '/>' . $din . '</a></td>'// Produits
                                    . '<td ' . $bgcolor . ' width=3%>' . $idDossierFta . 'v' . $idVersionDossierFta . '</td>'//Dossier Fta
                                    . '<td ' . $bgcolor . ' width=\'6%\'> <b><font size=\'2\' color=\'#0000FF\'>' . $codeArticleLdc . '</font></b></td>'; //Code regate


                            if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                                $tableauFicheTmp.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
                            } else {
                                $tableauFicheTmp.='<td ' . $bgcolor . ' ></td>';
                            }
                            $tableauFicheTmp .='<td ' . $bgcolor . ' width=10% align=center>' . $recap[$idFta] . '</td>'//% Avancement FTA
                                    . '<td ' . $bgcolor . ' align=center >' . $service . '</td>' //Service               
                                    . '<td ' . $bgcolor . ' align=center >' . $actions . '</td>'// Actions
                                    . $commentaire . '</tr >'; // Commentaires
                        }
                    } else {
                        if ($createurFtaTr <> $createurTrTmp or $diffWorkflowTr) {
                            $tableauFicheTrTmp .= '<tr class=contenu>'
                                    . '<td COLSPAN=' . $nombreDeCellule . ' > <font size=2 >' . $createurPrenom . ' ' . $createurNom . ' </td>'
                                    . '</tr>'
                                    . '<tr class=contenu >'
                                    . '<td ' . $bgcolor_header . ' width=\'' . $selection_width . '\' >' . $icon_header . $selection . '</td>'//Ordre de priorisation
                                    . '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '</td>'//Site
                                    . '<td ' . $bgcolor . ' width=6%>' . $classification . '</td>'//Client
                                    . '<td ' . $bgcolor . ' width=6%>' . $suffixeAgrologicFta . '</td>'// Raccourcie Class.
                                    . '<td ' . $bgcolor . $largeur_html_C1 . '><a title=' . $createur_link . '/>' . $din . '</a></td>'// Produits
                                    . '<td ' . $bgcolor . ' width=3%>' . $idDossierFta . 'v' . $idVersionDossierFta . '</td>'//Dossier Fta
                                    . '<td ' . $bgcolor . ' width=\'6%\'> <b><font size=\'2\' color=\'#0000FF\'>' . $codeArticleLdc . '</font></b></td>'; //Code regate


                            if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                                $tableauFicheTrTmp.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
                            } else {
                                $tableauFicheTrTmp.='<td ' . $bgcolor . ' ></td>';
                            }
                            $tableauFicheTrTmp .= '<td ' . $bgcolor . ' width=10% align=center>' . $recap[$idFta] . '</td>'//% Avancement FTA
                                    . '<td ' . $bgcolor . ' align=center >' . $service . '</td>' //Service               
                                    . '<td ' . $bgcolor . ' align=center >' . $actions . '</td>'// Actions
                                    . $commentaire . '</tr >'; // Commentaires
                            $createurTrTmp = $createurFtaTr;
                        } else {
                            $tableauFicheTrTmp .= '<tr class=contenu >'
                                    . '<td ' . $bgcolor_header . ' width=\'' . $selection_width . '\' >' . $icon_header . $selection . '</td>'//Ordre de priorisation
                                    . '<td ' . $bgcolor . ' width=8%>' . $nomSiteProduction . '</td>'//Site
                                    . '<td ' . $bgcolor . ' width=6%>' . $classification . '</td>'//Client
                                    . '<td ' . $bgcolor . ' width=6%>' . $suffixeAgrologicFta . '</td>'// Raccourcie Class.
                                    . '<td ' . $bgcolor . $largeur_html_C1 . '><a title=' . $createur_link . '/>' . $din . '</a></td>'// Produits
                                    . '<td ' . $bgcolor . ' width=3%>' . $idDossierFta . 'v' . $idVersionDossierFta . '</td>'//Dossier Fta
                                    . '<td ' . $bgcolor . ' width=\'6%\'> <b><font size=\'2\' color=\'#0000FF\'>' . $codeArticleLdc . '</font></b></td>'; //Code regate

                            if ($abreviationFtaEtat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                                $tableauFicheTrTmp.='<td ' . $bgcolor . $largeur_html_C3 . ' align=center>' . $dateEcheanceFta . '</td>'; //échance de validation
                            } else {
                                $tableauFicheTrTmp.='<td ' . $bgcolor . ' ></td>';
                            }
                            $tableauFicheTrTmp .='<td ' . $bgcolor . ' width=10% align=center>' . $recap[$idFta] . '</td>'//% Avancement FTA
                                    . '<td ' . $bgcolor . ' align=center >' . $service . '</td>' //Service               
                                    . '<td ' . $bgcolor . ' align=center >' . $actions . '</td>'// Actions
                                    . $commentaire . '</tr >'; // Commentaires
                        }
                    }
                }

                $tableauFicheN.= $tableauFicheTmp;
                $tableauFicheTr .= $tableauFicheTrTmp;
                $tableauFicheTrTmp = NULL;
                $tableauFicheTmp = NULL;
                $service = NULL;
                $icon_header = NULL;
                $classification = NULL;
                $selection = NULL;
                $bgcolor_header = NULL;
            }
        } else {
            $tableauFiche .= '<tr class=contenu><td>Aucune Fta identifié</td></tr>';
        }
//        $tableauFiche2.= $tableauFicheN . $tableauFicheTr;
//        $tableauFiche .= $tableauFiche2 . $javascript . '</tbody></table>';
        $tableauFicheN2.= $tableauFicheNWork . $tableauFicheN;
        $tableauFicheTr2 .= $tableauFicheTrWork . $tableauFicheTr;
        $tableauFiche .= $tableauFicheN2 . $tableauFicheTr2 . $javascript . '</tbody></table>';

//Ajoute de la fonction de traitement de masse
        if ($traitementDeMasse) {
            $liste_action_groupe = FtaTransitionModel::getListeFtaGrouper(self::$abrevationFtaEtat);

            $tableauFiche.= '&nbsp;
            <img src = ../lib/images/fleche_gauche_et_haut.png width = 38 height = 22 border = 0 />
            <i>Transitions groupées</i>:
            ' . $liste_action_groupe . '
            <input type = \'text\' name=\'subject\' size=\'20\' />
                         <input type=image src=images/transiter.png width=20 height=20 />
                         <input type=hidden name=action value=transition_groupe>
                         ';
        }

        return $tableauFiche;
    }

    /**
     * Génère le file d'ariane en entête de la page d'accueil
     * @return string
     */
    public static function getFileAriane() {

        switch (self::$syntheseAction) {
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ATTENTE:

                $EtatAvancement = 'En attente';

                break;
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS:
                $EtatAvancement = 'En cours';

                break;
            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_EFFECTUES:
                $EtatAvancement = 'Effectuées';
                break;

            case FtaEtatModel::ETAT_AVANCEMENT_VALUE_ALL:
                $EtatAvancement = 'Voir';
                break;
        }

        $fileAriane = '<table class=titre width=100%  ><tr>'
                . '<td>' . FtaRoleModel::getNameRoleByIdRole(self::$idFtaRole) . '</td>'
                . '<td> > </td>'
                . '<td>' . FtaEtatModel::getNameEtatByIdEtat(self::$idFtaEtat) . '</td>'
                . '<td> > </td>'
                . '<td>' . $EtatAvancement . '</td>'
                . '</tr></table>';

        return $fileAriane;
    }

    /**
     * Fonction de création d'une liste déroulante basée sur une requete SQL
      le premier champ retourné par la requête est désigné comme Clef de la liste
      le second alimente le contenu de la liste déroulante
     * @param string $paramRequeteSQL
     * @param int $paramIdDefaut
     * @param string $paramNomDefaut
     * @param boolean $paramIsEditable
     * @return string
     */
    public static function afficherRequeteEnListeDeroulante($paramRequeteSQL, $paramIdDefaut, $paramNomDefaut, $paramIsEditable, $paramTous = NULL) {
//Recherche de la clef
        $table = DatabaseOperation::convertSqlStatementKeyAndOneFieldToArray($paramRequeteSQL);
        if (!$table) {//Si la liste est vide
            $html_liste = '<i>(vide)</i>';
//            $html_liste = '<select name=' . $paramNomDefaut . ' onChange=' . $paramNomDefaut . '_js()>';
//            if (!$paramIdDefaut) {
//                $html_liste .='<option value=-1 >Aucun</option>';
//                $html_liste .= '</select>';
//            }
        } else {
            if ($paramIsEditable <> FALSE) {
                $key = array_keys($table);
                if (!$paramNomDefaut) {
                    $paramNomDefaut = $key['1'];
                }

//Création de la liste déroulante
                $html_liste = '<select name=' . $paramNomDefaut . ' onChange=' . $paramNomDefaut . '_js()>';
                if ($paramTous) {
                    $html_liste .='<option value=0 >Tous</option>';
                }

                /*
                 * PDO::FETCH_BOTH
                 * Retourne la ligne suivante en tant qu'un tableau indexé par le nom et le numéro de la colonne
                 */
//Création du contenu de la liste
                $array = DatabaseOperation::convertSqlStatementKeyAndOneFieldToArray($paramRequeteSQL);
                foreach ($array as $rows) {
                    if ($rows['0'] == $paramIdDefaut) {
                        $selected = ' selected';
                    } else {
                        $selected = '';
                    }

                    $html_liste .= '<option value=' . $rows['0'] . '  ' . $selected . '>' . $rows['1'] . '</option>';
                }
                $html_liste .= '</select>';
            } else {
                $array = DatabaseOperation::convertSqlStatementKeyAndOneFieldToArray($paramRequeteSQL);
                foreach ($array as $rows) {
                    if ($rows['0'] == $paramIdDefaut) {
                        $html_listeTMP = $rows['1'];
                    } else {
                        $html_liste = NULL;
                    }
                    if (!$html_liste) {
                        $html_liste = $html_listeTMP;
                    }
                }
            }//Fin de la construction de la liste
        }
        return $html_liste;
    }

}
