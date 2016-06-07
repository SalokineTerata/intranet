<?php

/**
 * Description of navigation
 *
 * @author tp4300008
 */
class Navigation {

    const FONT_COLOR_CHAPITRE_NON_ACCESSIBLE = "#000000";
    const FONT_COLOR_CHAPITRE_AUTRE_ROLE = "#AAAAAA";
    const FONT_COLOR_CHAPITRE_ENCOURS = "#1D3FDA";
    const FONT_COLOR_CHAPITRE_PUBLIC = "#CC33CC";
    const FONT_COLOR_CHAPITRE_NON_VALIDEE = "#FF0000";
    const FONT_COLOR_CHAPITRE_COMMENTAIRE = "#2A2A2A";
    const FONT_COLOR_CHAPITRE_VALIDEE = "#009400";
//    const FONT_COLOR_CHAPITRE_VALIDEE = "#00CC00";
    const FONT_SIZE_CHAPITRE_ENCOURS = "3";
    const FONT_SIZE_ROLE_ENCOURS = "3";
    const FONT_SIZE_DEFAULT = "2";

    protected static $abreviation_etat;
    protected static $id_fta;
    protected static $id_fta_etat;
    protected static $id_fta_role;
    protected static $comeback;
    protected static $comeback_url;
    protected static $ftaConsultation;
    protected static $ftaModel;
    protected static $ftaModification;
    protected static $ftaImpression;
    protected static $html_navigation_bar;
    protected static $html_navigation_core;
    //protected static $id_fta_chapitre;
    protected static $id_fta_chapitre_encours;
    protected static $synthese_action;
    protected static $id_fta_processus;
    protected static $id_fta_workflow;
    protected static $id_parent_intranet_actions;

    public static function getHtmlNavigationBar() {
        return self::$html_navigation_bar;
    }

    public static function initNavigation($id_fta, $id_fta_chapitre_encours, $synthese_action, $comeback, $id_fta_etat, $abrevation_etat, $id_fta_role, $paramActivationComplete) {

        /**
         * Modification
         */
        self::$ftaModification = Acl::getValueAccesRights(Acl::ACL_FTA_MODIFICATION);

        /**
         * Consultation
         */
        self::$ftaConsultation = Acl::getValueAccesRights(Acl::ACL_FTA_CONSULTATION);



        self::$id_fta = $id_fta;
        self::$id_fta_chapitre_encours = $id_fta_chapitre_encours;
        self::$synthese_action = $synthese_action;
        if ($id_fta_etat == FtaEtatModel::ID_VALUE_MODIFICATION) {
            self::$synthese_action = FtaEtatModel::ETAT_AVANCEMENT_VALUE_EN_COURS;
        }
        self::$comeback = $comeback;
        self::$id_fta_etat = $id_fta_etat;
        self::$abreviation_etat = $abrevation_etat;
        self::$id_fta_role = $id_fta_role;
        self::$ftaModel = new FtaModel(self::$id_fta);
        self::$id_fta_workflow = self::$ftaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
        $ftaWorkflowModel = new FtaWorkflowModel(self::$id_fta_workflow);
        self::$id_parent_intranet_actions = $ftaWorkflowModel->getDataField(FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS)->getFieldValue();

        self::$html_navigation_bar = self::buildNavigationBar($paramActivationComplete);
    }

    /**
     * Barre de naviagtion de la Fta
     * @param type $paramActivationComplete
     * @return string
     */
    protected static function buildNavigationBar($paramActivationComplete) {
        //Variables

        $globalConfig = new GlobalConfig();
        UserModel::checkUserSessionExpired($globalConfig);
        $idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();

        $html_table = 'table '              //Permet d'harmoniser les tableaux
                . 'border=1 '
                . 'width=100% '
                . 'class=contenu '
        ;
        if (self::$id_fta) {
            $checkIdFta = self::$ftaModel->getDataField(FtaModel::KEYNAME)->getFieldValue();
            if (!$checkIdFta) {
                $titre = UserInterfaceMessage::FR_WARNING_PARAM_ID_FTA_TITLE;
                $message = UserInterfaceMessage::FR_WARNING_PARAM_ID_FTA_NOT_EXISTANT;
                $redirection = "index.php";
                Lib::showMessage($titre, $message, $redirection);
            }
        } else {
            $titre = UserInterfaceMessage::FR_WARNING_PARAM_ID_FTA_TITLE;
            $message = UserInterfaceMessage::FR_WARNING_PARAM_ID_FTA;
            $redirection = "index.php";
            Lib::showMessage($titre, $message, $redirection);
        }
        //Récupère la page en cours
        $arrayFtaEtatAndFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . FtaModel::KEYNAME . ', ' . FtaModel::FIELDNAME_CREATEUR
                        . ', ' . FtaModel::FIELDNAME_ARTICLE_AGROLOGIC . ', ' . FtaModel::FIELDNAME_DOSSIER_FTA
                        . ', ' . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA . ', ' . FtaModel::FIELDNAME_LIBELLE
                        . ', ' . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE . ', ' . FtaModel::FIELDNAME_CODE_ARTICLE_LDC
                        . ', ' . FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW
                        . ', ' . FtaModel::FIELDNAME_COMMENTAIRE
                        . ' FROM ' . FtaModel::TABLENAME . ',' . FtaEtatModel::TABLENAME . ',' . FtaWorkflowModel::TABLENAME
                        . ' WHERE ' . FtaModel::KEYNAME . '=' . self::$id_fta
                        . ' AND ' . FtaEtatModel::TABLENAME . '.' . FtaEtatModel::KEYNAME
                        . '=' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_ID_FTA_ETAT
                        . ' AND ' . FtaWorkflowModel::TABLENAME . '.' . FtaWorkflowModel::KEYNAME
                        . '=' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_WORKFLOW
        );
        /**
         * Liste des Rôles auxquelles l'utilisateur à accès pour un workflow donnée
         */
        $arrayRoleWorkflow = FtaRoleModel::getArrayIdFtaRoleByIdUserAndWorkflow($idUser, self::$id_fta_workflow);
        if (count($arrayRoleWorkflow) > "1") {
            $RoleNavigation = FtaRoleModel::getRolesNavigationBar($idUser, self::$id_fta_workflow, self::$ftaModel, self::$synthese_action, self::$id_fta_chapitre_encours, self::$id_fta_role);
        } else {
            $ftaRoleModel = new FtaRoleModel(self::$id_fta_role);
        }
        $siteDeProduction = self::$ftaModel->getDataField(FtaModel::FIELDNAME_SITE_PRODUCTION)->getFieldValue();
        $geoModel = new GeoModel($siteDeProduction);
        foreach ($arrayFtaEtatAndFta as $rowsFtaEtatAndFta) {
            //Récupération des informations préalables
            //Nom de l'assistante de projet responsable:
            $userModel = new UserModel($rowsFtaEtatAndFta[FtaModel::FIELDNAME_CREATEUR]);
            $createur = $userModel->getPrenomNom();

            //Construction du Menu
            $menu_navigation = self::buildMenu($arrayRoleWorkflow, $rowsFtaEtatAndFta, $html_table, $RoleNavigation, $geoModel, $createur, $ftaRoleModel);
        }
        if ($paramActivationComplete) {
            //Si une action est donnée, alors construction du menu des chapitres    
            $menu_navigation .= self::CheckSyntheseAction();
        }
        //Lien de retour rapide

        /**
         * Version avec le rewrite
         */
//        self::$comeback_url = 'index-' . self::$id_fta_etat . '-' . self::$abreviation_etat . '-' . self::$id_fta_role . '-' . self::$synthese_action . '.html';

        if (self::$comeback == "1") {
//                   self::$comeback_url = 'index.php?id_fta_etat=' . self::$id_fta_etat . '&nom_fta_etat=' . self::$abreviation_etat . '&id_fta_role=' . self::$id_fta_role . '&synthese_action=' . self::$synthese_action;
            $_SESSION["comeback_url"] = $_SERVER["HTTP_REFERER"];
        } elseif ($_SESSION["comeback_url"] == "") {
            $_SESSION["comeback_url"] = 'index.php?id_fta_etat=' . self::$id_fta_etat . '&nom_fta_etat=' . self::$abreviation_etat . '&id_fta_role=' . self::$id_fta_role . '&synthese_action=' . self::$synthese_action;
        }
        $menu_navigation.= '</tr><tr><td colspan=6 >
    <a href=' . $_SESSION["comeback_url"] . '><img src=../lib/images/bouton_retour.png alt=\'\' title=\'Retour\' width=\'18\' height=\'15\' border=\'0\' /> Retour</a> |
    ';
        if ($paramActivationComplete) {
            //Corps du menu
            $accesTransitionButton = FtaTransitionModel::isAccesTransitionButton(self::$id_fta_role, self::$id_fta_workflow);
            $idIntranetActionsSiteDeProduction = FtaActionSiteModel::getArrayIdIntranetActionByWorkflowAndSiteDeProduction(self::$id_fta_workflow, $siteDeProduction);
            $checkAccesButtonBySiteProd = IntranetActionsModel::isAccessFtaActionByIdUserFtaWorkflowAndSiteDeProduction($idUser, self::$id_fta_workflow, $idIntranetActionsSiteDeProduction);
            $tauxRound = FtaSuiviProjetModel::getPourcentageFtaTauxValidation(self::$ftaModel);
            $transition = TableauFicheView::getHmlLinkTransiter(self::$id_fta, self::$id_fta_role, self::$abreviation_etat, $checkAccesButtonBySiteProd
                            , $accesTransitionButton, self::$synthese_action, $tauxRound,"18");
            if($transition){
                $transition =  " | ". $transition;
            }
            $menu_navigation.='
                    <a href=historique-' . self::$id_fta
                    . '-' . self::$id_fta_chapitre_encours
                    . '-' . self::$id_fta_etat
                    . '-' . self::$abreviation_etat
                    . '-' . self::$id_fta_role
                    . '-' . self::$synthese_action
//                    . '-1'
                    . '.html ><img src=./images/graphique.png alt=\'\' title=\'Etat d\'avancement\' width=\'18\' height=\'15\' border=\'0\' /> Etat d\'avancement</a>'
                    . $transition .
            '
                       </td></tr>                       
                       </table>
                       ';
        }
        return $menu_navigation;
        //return $return raplacera menu_navigation;
    }

    /**
     * Verification de l''état d'avancement.
     * @return String
     */
    protected static function CheckSyntheseAction() {
        $nbProcessusPreceValide = "0";
        $ProcessusEncoursVisible = array();
        $ProcessusPrecedentVisible = array();
        $ProcessusValide = array();
        $ProcessusEnLecture = array();
        $globalConfig = new GlobalConfig();
        UserModel::checkUserSessionExpired($globalConfig);

        $id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();
        $idFtaRole = self::$id_fta_role;
        /**
         * Cette partie n'est plus utilisé car le but était de récupérer le rôle corespondant à l'utilisateur connecter
         * mais désormais id_fta_role est récupé dans l'URL
         */
        /*
         * $modelFta = new FtaModel(self::$id_fta);
         * $id_fta_workflow = $modelFta->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
         * $ftaWorkflowModel = new FtaWorkflowModel($id_fta_workflow);
         * $id_parent_intranet_actions = $ftaWorkflowModel->getDataField(FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS)->getFieldValue();
         * $id_intranet_actions[] = IntranetActionsModel::getIdIntranetActionsRoleFromIdParentActionNavigation($id_parent_intranet_actions);
         * $id_actions_role = FtaActionRoleModel::getIdFtaActionRoleFromIdIntranetAtions($id_intranet_actions);
         * $ftaActionRoleModel = new FtaActionRoleModel($id_actions_role);
         */

        /*
         * Si une action est donnée, alors construction du menu des chapitres
         */
        if (self::$synthese_action) {
            /*
             * Nous récuperons les processus en cours.
             */
            $arrayAllProcessus = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT DISTINCT ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                            . ' FROM ' . FtaWorkflowStructureModel::TABLENAME
                            . ' WHERE ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . self::$id_fta_workflow
            );
            /**
             * On récupère tous les processus
             */
            foreach ($arrayAllProcessus as $rowsAllProcessus) {
                $ProcessusComplet[] = $rowsAllProcessus[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS];
            }


            /*
             * Etat d'avancement de la FTA et Recherche des processus validés (et donc en lecture-seule)             * 
             */


            /*
             * Nous récuperons les processus en cours.
             */
            $req = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT DISTINCT ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                            . ' FROM ' . FtaWorkflowStructureModel::TABLENAME
                            . ', ' . FtaProcessusCycleModel::TABLENAME
                            . ',' . IntranetActionsModel::TABLENAME
                            . ',' . IntranetDroitsAccesModel::TABLENAME
                            . ',' . IntranetModulesModel::TABLENAME
                            . ',' . FtaActionRoleModel::TABLENAME
                            . ' WHERE ' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                            . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                            . ' AND ' . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . '=\'' . FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION . '\''
                            . ' AND ' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                            . '=' . self::$id_fta_workflow       //Jointure
                            . ' AND ' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                            . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW        //Jointure                            
                            . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                            . '=' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE  //Jointure  
                            . ' AND ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                            . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                            . ' AND ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                            . '=' . $idFtaRole
                            . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                            . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS  //Jointure
                            . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
                            . '=' . IntranetModulesModel::TABLENAME . '.' . IntranetModulesModel::KEYNAME  //Jointure
                            . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $id_user //Utilisateur actuellement connecté
                            . ' AND ' . IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES . '=\'' . FtaModel::TABLENAME
                            . '\' AND ' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE  //L'utilisateur est propriétaire
            );

            /**
             * On ne récuère que les processus d'init validé
             */
//            $arrayProcessusValide = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
//                            'SELECT DISTINCT ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . ' as ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
//                            . ' FROM ' . FtaProcessusCycleModel::TABLENAME
//                            . ' WHERE ' . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . '=\'' . FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION . '\''
//                            . ' AND ' . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
//                            . '=\'' . self::$id_fta_workflow . '\' '
            /**
             * On récuère les processus validé
             */
            $arrayProcessusValide = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT DISTINCT ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                            . ' FROM ' . FtaWorkflowStructureModel::TABLENAME
                            . ' WHERE ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . '=\'' . self::$id_fta_workflow . '\''
                            . ' AND ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS . '<>\'' . FtaProcessusModel::PROCESSUS_PUBLIC . '\''
            );
            if ($req AND $arrayProcessusValide) {
                /*
                 * Nous récupérons les processus précédent du processus en cours si ils sont tous validé
                 */
                foreach ($req as $rows) {
                    /*
                     * Nous verifions si tous les processus précedents du chapitre que l'utilisateur à les droits d'accès
                     * sont validé ou non et donc visible ou non
                     */
                    $taux_validation_processus = FtaProcessusModel::getFtaProcessusNonValidePrecedent(self::$id_fta, $rows[FtaProcessusModel::KEYNAME], self::$id_fta_workflow);

                    //Liste des processus visible(lecture-seule)
                    if ($taux_validation_processus == 1 or $taux_validation_processus === NULL) {
                        $ProcessusPrecedentVisible[] = $rows[FtaProcessusModel::KEYNAME];
                        /*
                         * Il s'agit du controle des processus multisite,
                         * les droits d'accès à cette Fta étatn controlé précédement je désactive la focntion
                         */

//                        foreach ($ProcessusPrecedentVisible as $rowsProcessusVisible) {
//                            $multisite_fta_processus = FtaProcessusModel::CheckProcessusMultiSite($rowsProcessusVisible);
//
//                            if ($multisite_fta_processus) {
//                                //Oui, il s'agit d'un Processus répartie sur les sites d'assemblage
//                                $ProcessusPrecedentVisibleTmp[] = self::CheckMultiSite($rowsProcessusVisible);
//                                $ProcessusPrecedentVisible = $ProcessusPrecedentVisibleTmp;
//                            }
//                        }
                    }
                }//Fin du balayage
//                if ($ProcessusPrecedentVisible) {
                /*
                 * Nous récupérons tous les processus validé pour vérifier plus tard si nous devons les affichers
                 */
                foreach ($arrayProcessusValide as $rowsProcessusValide) {
                    $taux_validation_processus = FtaProcessusModel::getValideProcessusEncours(self::$id_fta, $rowsProcessusValide[FtaProcessusModel::KEYNAME], self::$id_fta_workflow);
                    if ($taux_validation_processus == 1) {

                        $ProcessusValide[] = $rowsProcessusValide[FtaProcessusModel::KEYNAME];
                    }
                }
//                }
            }
            /*
             * Nous récuperons la liste des processus non valider  qui sont en cours
             * par la vérification des droits d'accès de l'utilisateur en cours par Workflow par role 
             * et un balayage  des cycles des processus
             */
            $arrayNext = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT DISTINCT ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                            . ' FROM ' . FtaProcessusCycleModel::TABLENAME
                            . ',' . FtaWorkflowStructureModel::TABLENAME
                            . ',' . IntranetActionsModel::TABLENAME
                            . ',' . IntranetDroitsAccesModel::TABLENAME
                            . ',' . IntranetModulesModel::TABLENAME
                            . ',' . FtaActionRoleModel::TABLENAME
                            . ',' . FtaSuiviProjetModel::TABLENAME
                            . ' WHERE ' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                            . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS        //Jointure
                            . ' AND ' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                            . '=' . self::$id_fta_workflow       //Jointure
                            . ' AND ' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                            . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW        //Jointure                            
                            . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                            . '=' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                            . ' AND ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                            . '=' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                            . ' AND ' . FtaActionRoleModel::TABLENAME . '.' . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                            . '=' . $idFtaRole
                            . ' AND ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::KEYNAME
                            . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS  //Jointure
                            . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
                            . '=' . IntranetModulesModel::TABLENAME . '.' . IntranetModulesModel::KEYNAME  //Jointure
                            . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $id_user //Utilisateur actuellement connecté
                            . ' AND ' . IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES . '=\'' . FtaModel::TABLENAME
                            . '\' AND ' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . IntranetNiveauAccesModel::NIVEAU_GENERIC_TRUE   //L'utilisateur est propriétaire
                            . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                            . '=' . FtaSuiviProjetModel::TABLENAME . '.' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE  //Jointure
                            . ' AND ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . '<>' . FtaSuiviProjetModel::SIGNATURE_VALIDATION_SUIVI_PROJET_FALSE //chapitre validé
            );
            if ($arrayNext) {
                foreach ($arrayNext as $rowsNext) {

                    //Pour chaque processus, on vérifie que tous ces précédents sont validés
                    $req = 'SELECT ' . FtaProcessusCycleModel::KEYNAME . ' FROM ' . FtaProcessusCycleModel::TABLENAME
                            . ' WHERE ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                            . '=' . $rowsNext[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT]
                            . ' AND ( ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . '=0 '
                    ;

                    //Ajout de la restriction des processus validé
                    $req .=self::AddValidProcess($ProcessusValide);

                    //Recherche dans le cycle correspondant à l'état en cours de la fiche
                    $req_etat = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                    'SELECT ' . FtaEtatModel::TABLENAME . '.' . FtaEtatModel::FIELDNAME_ABREVIATION
                                    . ' FROM ' . FtaEtatModel::TABLENAME . ',' . FtaModel::TABLENAME
                                    . ' WHERE ' . FtaEtatModel::TABLENAME . '.' . FtaEtatModel::KEYNAME
                                    . '=' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_ID_FTA_ETAT
                                    . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME
                                    . '= ' . self::$id_fta
                    );

                    foreach ($req_etat as $rowsEtat) {
                        $abreviation_fta_etat = $rowsEtat[FtaEtatModel::FIELDNAME_ABREVIATION];
                    }

                    $req .= ') AND ' . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT
                            . '=\'' . $abreviation_fta_etat
                            . '\' AND ' . FtaProcessusCycleModel::FIELDNAME_WORKFLOW . ' = ' . self::$id_fta_workflow;

                    //Filtrage par catégorie
                    //Finalisation de la requête
                    //Si la requête a un résultat c'est que tous les processus précédents sont validés
                    /*
                     * Nous récupérons tous les processus que l'utilisateur verra en lecture(seule) 
                     * afin qu'ils puissent remplir les données des champs de leurs chapitres
                     */
                    $arrayIdFtaProcessusCyle = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
                    if ($arrayIdFtaProcessusCyle) {
                        foreach ($arrayIdFtaProcessusCyle as $rowsIdFtaProcessusCycle) {
                            $idFtaProcessusCyle = $rowsIdFtaProcessusCycle[FtaProcessusCycleModel::KEYNAME];
                            $ftaProcessusCycleModel = new FtaProcessusCycleModel($idFtaProcessusCyle);
                            $ProcessusEnLecture[] = $ftaProcessusCycleModel->getDataField(FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT)->getFieldValue();
                        }
                    }
                    /*
                     * Nombres total de processus précedent pour le processus en cours
                     */
                    $arrayInit = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                    'SELECT DISTINCT ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                                    . ' FROM ' . FtaWorkflowStructureModel::TABLENAME . ',' . FtaProcessusModel::TABLENAME
                                    . ',' . FtaProcessusCycleModel::TABLENAME
                                    . ' WHERE ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                    . '=' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME
                                    . ' AND ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME
                                    . '=' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                                    . ' AND ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                                    . '=' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                                    . ' AND ' . FtaProcessusModel::TABLENAME . '.' . FtaProcessusModel::KEYNAME . '=' . $rowsNext[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT]
                                    . ' AND ' . FtaProcessusCycleModel::TABLENAME . '.' . FtaProcessusCycleModel::FIELDNAME_WORKFLOW . ' = ' . self::$id_fta_workflow
                    );

                    if ($arrayInit) {
                        /*
                         * Vérifie si tous les processus précédent du processus en cours a des chapitres non validé
                         */
                        $nbProcessusPrece = count($arrayInit);
                        foreach ($arrayInit as $rowsInit) {

                            $tauxValidationProcessus = FtaProcessusModel::getValideProcessusEncours(self::$id_fta, $rowsInit[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT], self::$id_fta_workflow);
                            if ($tauxValidationProcessus != 0) {
                                $nbProcessusPreceValide = $nbProcessusPreceValide + 1;
                                //Enregistrement du processus en tant que processus en cours
                                if ($tauxValidationProcessus == "1" and $nbProcessusPreceValide == $nbProcessusPrece) {
                                    $ProcessusEnLecture[] = $rowsInit[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT];
                                    $ProcessusEncoursVisible[] = $rowsNext[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT];
                                }
//                            }
                            }
                        }

                        /*
                         * Désactivation des check de multisite voir FtaProcessusmodel::CheckMultisite
                         */
                        /*
                          //Ce processus en cours, est-il du type repartie ou centralisé ?
                          $reqType = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                          'SELECT ' . FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS
                          . ' FROM ' . FtaProcessusModel::TABLENAME
                          . ' WHERE ' . FtaProcessusModel::KEYNAME
                          . '=' . $rows[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT]
                          );
                          if ($reqType) {
                          foreach ($reqType as $rowsType) {
                          $multisite_fta_processus = $rowsType[FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS];
                          }
                          if ($multisite_fta_processus) {
                          //Oui, il s'agit d'un Processus répartie sur les sites d'assemblage
                          $ProcessusEncoursVisible[] = self::CheckMultiSite($rows[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT]);
                          } else {
                         */

//                        }
                    }
                }//Fin du balayage des processus non-validés
            }
            //Recherche des processus valide ayant un lien dans processus cycle
            foreach ($ProcessusValide as $rowsProcessusValide2) {
                //Pour chaque processus, on vérifie que tous ces précédents sont validés
                $req = 'SELECT ' . FtaProcessusCycleModel::KEYNAME . ' FROM ' . FtaProcessusCycleModel::TABLENAME
                        . ' WHERE ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                        . '=' . $rowsProcessusValide2
                        . ' AND ( ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . '=0 '
                ;

                //Ajout de la restriction des processus validé
                $req .=self::AddValidProcess($ProcessusValide);

                //Recherche dans le cycle correspondant à l'état en cours de la fiche
                $req_etat = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT ' . FtaEtatModel::TABLENAME . '.' . FtaEtatModel::FIELDNAME_ABREVIATION
                                . ' FROM ' . FtaEtatModel::TABLENAME . ',' . FtaModel::TABLENAME
                                . ' WHERE ' . FtaEtatModel::TABLENAME . '.' . FtaEtatModel::KEYNAME
                                . '=' . FtaModel::TABLENAME . '.' . FtaModel::FIELDNAME_ID_FTA_ETAT
                                . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME
                                . '= ' . self::$id_fta
                );

                foreach ($req_etat as $rowsEtat) {
                    $abreviation_fta_etat = $rowsEtat[FtaEtatModel::FIELDNAME_ABREVIATION];
                }

                $req .= ') AND ' . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT
                        . '=\'' . $abreviation_fta_etat
                        . '\' AND ' . FtaProcessusCycleModel::FIELDNAME_WORKFLOW . ' = ' . self::$id_fta_workflow;

                //Filtrage par catégorie
                //Finalisation de la requête
                //Si la requête a un résultat c'est que tous les processus précédents sont validés
                /*
                 * Nous récupérons tous les processus que l'utilisateur verra en lecture(seule) 
                 * afin qu'ils puissent remplir les données des champs de leurs chapitres
                 */
                $arrayIdFtaProcessusCyle = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
                if ($arrayIdFtaProcessusCyle) {
                    foreach ($arrayIdFtaProcessusCyle as $rowsIdFtaProcessusCycle) {
                        $idFtaProcessusCyle = $rowsIdFtaProcessusCycle[FtaProcessusCycleModel::KEYNAME];
                        $ftaProcessusCycleModel = new FtaProcessusCycleModel($idFtaProcessusCyle);
                        $ProcessusEnLecture[] = $ftaProcessusCycleModel->getDataField(FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT)->getFieldValue();
                    }
                }
            }

            if (self::$id_fta_etat == '1') {

                //Création de la liste des processus dans la barre de navigation          
                $t_liste_processus = array_merge($ProcessusEncoursVisible, $ProcessusPrecedentVisible, $ProcessusEnLecture, $ProcessusValide);
            } else {
                $arrayProcessusByWorkflow = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT DISTINCT ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                                . ' FROM ' . FtaWorkflowStructureModel::TABLENAME
                                . ' WHERE ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                                . '=' . self::$id_fta_workflow
                );
                foreach ($arrayProcessusByWorkflow as $rowsProcessusByWorkflow) {
                    $t_liste_processus[] .=$rowsProcessusByWorkflow[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS];
                }
            }
            self::$id_fta_processus = $t_liste_processus;

            //Récupération des Chapitres accessible dans le menu de naviguation
            $menu_navigation = self::RecupChapitre($ProcessusComplet);
            //Fin du controle de $synthese_action
        }
        return $menu_navigation;
    }

    protected static function RecupChapitre($paramT_Liste_Processus) {
        $page_default = "modification_fiche";
        $first = "";
        /*
         *  Nous récupérons les chapitres obligatoirement présent ce qui implique que les autre chapitres doivent être attribués.
         */
        $reqRecup = 'SELECT ' . FtaChapitreModel::TABLENAME . '.' . FtaChapitreModel::KEYNAME
                . ', ' . FtaChapitreModel::TABLENAME . '.' . FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE
                . ', ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                . ', ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                . ' FROM ' . FtaChapitreModel::TABLENAME . ' LEFT JOIN ' . FtaWorkflowStructureModel::TABLENAME
                . ' ON ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                . '=' . FtaChapitreModel::TABLENAME . '.' . FtaChapitreModel::KEYNAME
                . ' WHERE ( '
                . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE . ' =' . FtaRoleModel::ID_FTA_ROLE_COMMUN                          //Chapitre public
        ;
        foreach ($paramT_Liste_Processus as $value) {
            $reqRecup .= ' OR ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                    . '=\'' . $value . '\'';
        }
        $reqRecup .=' ) AND ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . self::$id_fta_workflow
                . ' ORDER BY ' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                . ',' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                . ',' . FtaChapitreModel::TABLENAME . '.' . FtaChapitreModel::KEYNAME
        ;
        $arrayRecup = DatabaseOperation::convertSqlStatementWithoutKeyToArray($reqRecup);

        //Balyage des chapitres trouvés
        foreach ($arrayRecup as $rowsRecup) {
            $id_fta_chapitre = $rowsRecup[FtaChapitreModel::KEYNAME];
            $nom_usuel_fta_chapitre = $rowsRecup[FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE];
            $idFtaProcessus = $rowsRecup[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS];
            $idFtaRole = $rowsRecup[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE];

            //Dans le cas où il n'y a pas de chapitre sélectionné, sélection du chapitre identité
            if (!self::$id_fta_chapitre_encours) {
                self::$id_fta_chapitre_encours = $id_fta_chapitre;
            }
            if (self::$id_fta_chapitre_encours == $id_fta_chapitre) {
                $font_size = "size=" . self::FONT_SIZE_CHAPITRE_ENCOURS;
                $font_flash_color = "color=" . self::FONT_COLOR_CHAPITRE_ENCOURS;
                $font_flash = "<font " . $font_size . " " . $font_flash_color . "><b>";
                $image_flash1 = $font_flash . '[  ' . "</font>";
                $image_flash2 = $font_flash . '  ]' . "</font>";
                $num = 1;
            } else {
                $font_size = "";
                $image_flash1 = '-  ';
                $image_flash2 = '  -';
            }



            //Ce chapitre est-il public?
            if ($idFtaProcessus == 0) {
                $font_color = "color=" . self::FONT_COLOR_CHAPITRE_PUBLIC;
                $link = TRUE;
                $num = 1;
            } else {
                //Le chapitre est-il validé ?
                $req1 = 'SELECT ' . FtaSuiviProjetModel::KEYNAME
                        . ' FROM ' . FtaSuiviProjetModel::TABLENAME
                        . ' WHERE ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA . '=' . self::$id_fta
                        . ' AND ' . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . '=' . $id_fta_chapitre
                        . ' AND ' . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . '<> ' . FtaSuiviProjetModel::SIGNATURE_VALIDATION_SUIVI_PROJET_FALSE
                ;
                $result1 = DatabaseOperation::queryPDO($req1);
                $num = DatabaseOperation::getSqlNumRows($result1);
                switch ($num) {
                    case 0:
                        /**
                         * Chapitre pas encore validé
                         *  - Chapitre encours en rouge 
                         *  - Chapitre non accessible  en noir
                         */
                        if (in_array($idFtaProcessus, self::$id_fta_processus)) {
                            $font_color = "color=" . self::FONT_COLOR_CHAPITRE_NON_VALIDEE;
                            $link = TRUE;
                            $i = "";
                            $iEnd = "";
                        } elseif (self::$id_fta_role == $idFtaRole) {
                            $font_color = "color=" . self::FONT_COLOR_CHAPITRE_NON_ACCESSIBLE;
                            $link = FALSE;
                            $i = "";
                            $iEnd = "";
                        } else {
                            $font_color = "color=" . self::FONT_COLOR_CHAPITRE_AUTRE_ROLE;
                            $i = " <i> ";
                            $iEnd = " </i> ";
                            $link = FALSE;
                        }
                        break;

                    case 1:  //Chapitre validé
                        $font_color = "color=" . self::FONT_COLOR_CHAPITRE_VALIDEE;
                        $link = TRUE;
                        $i = "";
                        $iEnd = "";
                        break;

                    default: //Anomalie
                        $titre = 'Erreur Grave !';
                        $message = 'La fonction afficher_navigation() vient de trouver des doublons de validation des chapitres dans la table fta_suivi_projet';
                        Lib::showMessage($titre, $message, $redirection);
                        break;
                }
            }//Fin du test public
            //}//Fin de la colorisation

            if ($num == 0 and self::$synthese_action === 'attente') {
                
            } else {
                $b = $i . "<font " . $font_size . " " . $font_color . ">";
                $menu_navigation .= $image_flash1;
                if ($link) {
                    $menu_navigation .= '<a href=' . $page_default . '.php?'
                            . 'id_fta=' . self::$id_fta
                            . '&id_fta_chapitre_encours=' . $id_fta_chapitre
                            . '&synthese_action=' . self::$synthese_action
                            . '&id_fta_etat=' . self::$id_fta_etat
                            . '&abreviation_fta_etat=' . self::$abreviation_etat
                            . '&id_fta_role=' . self::$id_fta_role
                            . '>';
                }
                $menu_navigation .= $b . ' ' . $nom_usuel_fta_chapitre;
                $menu_navigation .= '</a>';
                $menu_navigation .= '</b></font> ' . $iEnd . $image_flash2
                ;
                /**
                 * Mise en forme des chapitres de la barre de navigation regroupé par Rôle
                 */
                if ($idFtaRoleTmp == $idFtaRole or ! $first) {
                    $roleMenu .= $menu_navigation;
                    $menu_navigation = "";
                    $idFtaRoleTmp = $idFtaRole;
                    $first = "1";
                } else {
                    $color = FtaRoleModel::getColorByRole($idFtaRoleTmp);
                    $roleMenuFinal .="<td style='border-style:solid; border-bottom-width: 10px; border-color: " . $color . "' >" . $roleMenu . "</td>";
                    $roleMenu = $menu_navigation;
                    $menu_navigation = "";
                    $idFtaRoleTmp = $idFtaRole;
                }
            }
        }
        $color = FtaRoleModel::getColorByRole($idFtaRoleTmp);
        $roleMenuFinal .="<td style='border-style:solid; border-bottom-width: 10px; border-color: " . $color . "' >" . $roleMenu . "</td>";
        return $roleMenuFinal;
    }

//Fin de la création des chapitres
    //Suppression des processus déjà validé
    protected static function DeleteValidProcess($paramProcessusVisible) {
        if ($paramProcessusVisible) {
            foreach ($paramProcessusVisible as $value) {
                $req .= ' AND ' . ' ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT . '<>' . $value . ' ';
            }
        }
        return $req;
    }

//Ajout de la restriction des processus validé
    protected static function AddValidProcess($paramProcessusVisible) {
        if ($paramProcessusVisible) {
            foreach ($paramProcessusVisible as $value) {
                $req .= ' OR ' . ' ' . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . '=' . $value . ' ';
            }
        }
        return $req;
    }

    /*
     * Il s'agit du controle des processus multisite,
     * les droits d'accès à cette Fta étatn controlé précédement je désactive la focntion
     */
    /* protected static function CheckMultiSite($paramRows) {
      $globalconfig = new GlobalConfig();
      $paramLieuGeo = $globalconfig->getAuthenticatedUser()->getLieuGeo();
      //Existe-il une configuration de gestion forcée pour ce processus et ce site d'assemblage ?
      $arrayGestion = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
      'SELECT ' . FtaProcessusMultisiteModel::FIELDNAME_ID_SITE_PROCESSUS_FTA_PROCESSUS_MULTISITE
      . ' FROM ' . FtaProcessusMultisiteModel::TABLENAME
      . ',' . FtaModel::TABLENAME
      . ' WHERE ' . FtaProcessusMultisiteModel::FIELDNAME_ID_SITE_ASSEMBLAGE_FTA_PROCESSUS_MULTISITE
      . '=' . FtaModel::FIELDNAME_SITE_ASSEMBLAGE
      . ' AND ' . FtaProcessusMultisiteModel::FIELDNAME_ID_SITE_PROCESSUS_FTA_PROCESSUS_MULTISITE
      . '= '' . $paramRows . '' '
      . ' AND ' . FtaModel::KEYNAME . '=' . self::$id_fta
      );

      if ($arrayGestion) {
      foreach ($arrayGestion as $rowsGestion) {
      $id_geo = $rowsGestion[FtaProcessusMultisiteModel::FIELDNAME_ID_SITE_PROCESSUS_FTA_PROCESSUS_MULTISITE];
      }
      } else {
      //Sinon, Vérification de l'égalité entre le site d'assemblage de la FTA et le site de Localisation de l'utilisateur
      $arrayEgalite = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
      'SELECT ' . GeoModel::KEYNAME
      . ' FROM ' . FtaModel::TABLENAME
      . ',' . GeoModel::TABLENAME
      . ' WHERE ' . FtaModel::KEYNAME
      . '=' . self::$id_fta
      . ' AND ' . FtaModel::FIELDNAME_SITE_ASSEMBLAGE
      . '=' . GeoModel::FIELDNAME_ID_SITE
      );

      if ($arrayEgalite) {
      foreach ($arrayEgalite as $rowsEgalite) {
      $id_geo = $rowsEgalite [GeoModel::KEYNAME];
      }
      }
      if ($id_geo == $paramLieuGeo) {
      //L'égalité est respecté, donc ce processus est bien en cours
      $paramT_Processus_Encours = $paramRows;
      } else {
      $paramT_Processus_Encours = 0;
      }
      }
      return $paramT_Processus_Encours;
      } */

    /**
     * Construction du Menu
     * @param array $paramArrayRoleWorkflow
     * @param array $paramRowsFtaEtatAndFta
     * @param string $paramHtmlTable
     * @param string $paramRoleNavigation
     * @param GeoModel $paramGeoModel
     * @param string $paramCreateur
     * @param FtaRoleModel $paramFtaRoleModel
     * @return string
     */
    private static function buildMenu($paramArrayRoleWorkflow, $paramRowsFtaEtatAndFta, $paramHtmlTable, $paramRoleNavigation, GeoModel $paramGeoModel, $paramCreateur, FtaRoleModel $paramFtaRoleModel = NULL) {
        if ($paramRowsFtaEtatAndFta[FtaModel::FIELDNAME_CODE_ARTICLE_LDC]) {
            $identifiant = '<b><font size=\'2\' color=\'#0000FF\'>' . $paramRowsFtaEtatAndFta[FtaModel::FIELDNAME_CODE_ARTICLE_LDC] . '</font></b>';
        } else {
            $identifiant = '<b><font size=\'2\' color=\'' . self::FONT_COLOR_CHAPITRE_NON_VALIDEE . '\'>' . $paramRowsFtaEtatAndFta[FtaModel::FIELDNAME_DOSSIER_FTA] . 'v' . $paramRowsFtaEtatAndFta[FtaModel::FIELDNAME_VERSION_DOSSIER_FTA] . '</font></b>';
        }
        if ($paramRowsFtaEtatAndFta[FtaModel::FIELDNAME_COMMENTAIRE]) {
            $commentaire = '<br><b><font size=\'2\' color=\'' . self::FONT_COLOR_CHAPITRE_COMMENTAIRE . '\'>' . $paramRowsFtaEtatAndFta[FtaModel::FIELDNAME_COMMENTAIRE] . '</font></b>';
        } else {
            $commentaire = '';
        }
        if ($paramRowsFtaEtatAndFta[FtaModel::FIELDNAME_LIBELLE]) {
            $nom = $paramRowsFtaEtatAndFta[FtaModel::FIELDNAME_LIBELLE];
        } else {
            $nom = $paramRowsFtaEtatAndFta[FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE];
        }
        if (count($paramArrayRoleWorkflow) > "1") {
            $menu_navigation = '<' . $paramHtmlTable . '><tr><td class=titre_principal> <div align=\'left\'>
                            ' . $identifiant . ' - ' . $nom . ' &nbsp;&nbsp;&nbsp;&nbsp;<i>(gérée par ' . $paramCreateur . ')</i></div>'
                    . '<div align=\'left\'>' . $commentaire . '</div></td>'
                    . '<td width=25% class=titre_principal>';
            if (self::$abreviation_etat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                $menu_navigation .= $paramRoleNavigation;
            }
            $menu_navigation .= '<br>  Site de Production : ' . $paramGeoModel->getDataField(GeoModel::FIELDNAME_GEO)->getFieldValue()
                    . '<br>  Espace de Travail : ' . $paramRowsFtaEtatAndFta[FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW]
                    . '</td></tr></table>
                     <' . $paramHtmlTable . '>
                           <tr class = titre>';
        } else {
            $menu_navigation = '<' . $paramHtmlTable . '><tr><td class=titre_principal> <div align=\'left\'>
                            ' . $identifiant . '- ' . $nom . ' &nbsp;&nbsp;&nbsp;&nbsp;<i>(gérée par ' . $paramCreateur . ')</i></div>'
                    . '<div>' . $commentaire . '</div></td>'
                    . '<td width=25% class=titre_principal>';
            if (self::$abreviation_etat == FtaEtatModel::ETAT_ABREVIATION_VALUE_MODIFICATION) {
                $menu_navigation .= '  Rôle : ' . $paramFtaRoleModel->getDataField(FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE)->getFieldValue();
            }

            $menu_navigation .= '<br>  Site de Production : ' . $paramGeoModel->getDataField(GeoModel::FIELDNAME_GEO)->getFieldValue()
                    . '<br>  Espace de Travail : ' . $paramRowsFtaEtatAndFta[FtaWorkflowModel::FIELDNAME_DESCRIPTION_FTA_WORKFLOW]
                    . '</td></tr></table>
                    <' . $paramHtmlTable . '>
                           <tr class = titre>';
        }

        return $menu_navigation;
    }

}
