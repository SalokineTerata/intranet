<?php

/**
 * Description of navigation
 *
 * @author tp4300008
 */
class Navigation {

    protected static $abrevation_etat;
    protected static $id_fta;
    protected static $id_fta_etat;
    protected static $id_fta_role;
    protected static $comeback;
    protected static $comeback_url;
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

    public static function initNavigation($id_fta, $id_fta_chapitre_encours, $synthese_action, $comeback, $id_fta_etat, $abrevation_etat, $id_fta_role) {

        self::$id_fta = $id_fta;
        self::$id_fta_chapitre_encours = $id_fta_chapitre_encours;
        self::$synthese_action = $synthese_action;
        self::$comeback = $comeback;
        self::$id_fta_etat = $id_fta_etat;
        self::$abrevation_etat = $abrevation_etat;
        self::$id_fta_role = $id_fta_role;
        $ftaModel = new FtaModel(self::$id_fta);
        self::$id_fta_workflow = $ftaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
        $ftaWorkflowModel = new FtaWorkflowModel(self::$id_fta_workflow);
        self::$id_parent_intranet_actions = $ftaWorkflowModel->getDataField(FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS)->getFieldValue();

        self::$html_navigation_bar = self::buildNavigationBar();
    }

    protected static function buildNavigationBar() {
        //Barre de navigation de la Fiche Tehnique Article
        //Variables

        $html_table = "table "              //Permet d'harmoniser les tableaux
                . "border=1 "
                . "width=100% "
                . "class=contenu "
        ;
        //Récupère la page en cours
        $arrayFtaEtatAndFta = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT " . FtaModel::KEYNAME . ", " . FtaModel::FIELDNAME_CREATEUR
                        . ", " . FtaModel::FIELDNAME_ARTICLE_AGROLOGIC . ", " . FtaModel::FIELDNAME_DOSSIER_FTA
                        . ", " . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA . ", " . FtaModel::FIELDNAME_LIBELLE
                        . ", " . FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE . ", " . FtaModel::FIELDNAME_CODE_ARTICLE_LDC
                        . " FROM " . FtaModel::TABLENAME . "," . FtaEtatModel::TABLENAME
                        . " WHERE " . FtaModel::KEYNAME . "=" . self::$id_fta
                        . " AND " . FtaEtatModel::TABLENAME . "." . FtaEtatModel::KEYNAME
                        . "=" . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT
        );

        foreach ($arrayFtaEtatAndFta as $rowsFtaEtatAndFta) {
            //Récupération des informations préalables
//            $rowsFtaEtatAndFta[FtaModel::KEYNAME] = self::$id_fta;
            //Nom de l'assistante de projet responsable:
            $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                            "SELECT " . UserModel::FIELDNAME_PRENOM . "," . UserModel::FIELDNAME_NOM
                            . " FROM " . UserModel::TABLENAME
                            . " WHERE " . UserModel::KEYNAME
                            . "='" . $rowsFtaEtatAndFta[FtaModel::FIELDNAME_CREATEUR] . "' ");
            foreach ($array as $rows) {
                $createur = $rows[UserModel::FIELDNAME_PRENOM] . " " . $rows[UserModel::FIELDNAME_NOM];
            }

            //Construction du Menu
            if ($rowsFtaEtatAndFta[FtaModel::FIELDNAME_ARTICLE_AGROLOGIC]) {
                $identifiant = $rowsFtaEtatAndFta[FtaModel::FIELDNAME_ARTICLE_AGROLOGIC];
            } else {
                $identifiant = $rowsFtaEtatAndFta[FtaModel::FIELDNAME_DOSSIER_FTA] . "v" . $rowsFtaEtatAndFta[FtaModel::FIELDNAME_VERSION_DOSSIER_FTA];
            }
            if ($rowsFtaEtatAndFta[FtaModel::FIELDNAME_LIBELLE]) {
                $nom = $rowsFtaEtatAndFta[FtaModel::FIELDNAME_LIBELLE];
            } else {
                $nom = $rowsFtaEtatAndFta[FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE];
            }
            $menu_navigation = "
                     <$html_table>
                     <tr><td class=titre_principal> <div align=\"left\">
                           $identifiant (LDC: <b><font size=\"2\" color=\"#0000FF\">" . $rowsFtaEtatAndFta[FtaModel::FIELDNAME_CODE_ARTICLE_LDC] . "</font></b>) - $nom &nbsp;&nbsp;&nbsp;&nbsp;<i>(gérée par $createur)</i>
                           </div>
                     </td></tr>
                     <tr class=titre><td>
                     ";
        }
        //Si une action est donnée, alors construction du menu des chapitres    
        $menu_navigation .= self::CheckSyntheseAction();
        //Lien de retour rapide

        self::$comeback_url = "index.php?id_fta_etat=" . self::$id_fta_etat . "&nom_fta_etat=" . self::$abrevation_etat . "&id_fta_role=" . self::$id_fta_role . "&synthese_action=" . self::$synthese_action;

        $menu_navigation.= "</td></tr><tr><td>
    <a href=" . self::$comeback_url . "><img src=../lib/images/bouton_retour.png alt=\"\" title=\"Retour à la synthèse\" width=\"18\" height=\"15\" border=\"0\" /> Retour vers la synthèse</a> |
    ";
        //Corps du menu
        $menu_navigation.="
                    <a href=historique.php?id_fta=" . self::$id_fta . "><img src=./images/graphique.png alt=\"\" title=\"Etat d'avancement\" width=\"18\" height=\"15\" border=\"0\" /> Etat d'avancement</a>
                       </td></tr>
                       </table>
                       ";
        return $menu_navigation;
        //return $return raplacera menu_navigation;
    }

    protected static function CheckSyntheseAction() {

        $ProcessusEncoursVisible = array();
        $ProcessusPrecedentVisible = array();
        $ProcessusValide = array();
        $ProcessusEnLecture = array();
        $globalconfig = new GlobalConfig();
        $id_user = $globalconfig->getAuthenticatedUser()->getKeyValue();
        $modelFta = new FtaModel(self::$id_fta);
        $id_fta_workflow = $modelFta->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
        $ftaWorkflowModel = new FtaWorkflowModel($id_fta_workflow);
        $id_parent_intranet_actions = $ftaWorkflowModel->getDataField(FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS)->getFieldValue();
        $id_intranet_actions[] = IntranetActionsModel::getIdIntranetActionsRoleFromIdParentActionNavigation($id_parent_intranet_actions);
        $id_actions_role = FtaActionRoleModel::getIdFtaActionRoleFromIdIntranetAtions($id_intranet_actions);
        $ftaActionRoleModel = new FtaActionRoleModel($id_actions_role);

        //Si une action est donnée, alors construction du menu des chapitres
        if (self::$synthese_action) {
            /*
             * Etat d'avancement de la FTA et Recherche des processus validés (et donc en lecture-seule)             * 
             */


            /*
             * Nous récuperons les processus en cours.
             */
            $req = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                            "SELECT DISTINCT " . FtaProcessusModel::TABLENAME
                            . ".* FROM " . FtaProcessusModel::TABLENAME
                            . ", " . FtaProcessusCycleModel::TABLENAME
                            . "," . FtaWorkflowModel::TABLENAME
                            . "," . IntranetActionsModel::TABLENAME
                            . "," . IntranetDroitsAccesModel::TABLENAME
                            . "," . IntranetModulesModel::TABLENAME
                            . "," . FtaActionRoleModel::TABLENAME
                            . " WHERE " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                            . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                            . " AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='I'"
                            . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                            . "=" . self::$id_fta_workflow       //Jointure
                            . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                            . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME        //Jointure                            
                            . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                            . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE  //Jointure  
                            . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                            . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                            . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                            . "=" . $ftaActionRoleModel->getDataField(FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE)->getFieldValue()
                            . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                            . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS  //Jointure
                            . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
                            . "=" . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME  //Jointure
                            . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $id_user //Utilisateur actuellement connecté
                            . " AND " . IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES . "='" . FtaModel::TABLENAME
                            . "' AND " . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=1"  //L'utilisateur est propriétaire
            );

            $arrayProcessusValide = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                            "SELECT DISTINCT " . FtaProcessusModel::TABLENAME
                            . ".* FROM " . FtaProcessusModel::TABLENAME
                            . ", " . FtaProcessusCycleModel::TABLENAME
                            . " WHERE " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                            . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                            . " AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='I'"
                            . " AND " . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                            . "='" . self::$id_fta_workflow . "' "
            );
            if ($req AND $arrayProcessusValide) {
                /*
                 * Nous récupérons les processus précédent du processus en cours si ils sont tous validé
                 */
                foreach ($req as $rows) {
                    self::$id_fta_processus = $rows[FtaProcessusModel::KEYNAME];
                    /*
                     * Nous verifions si tous les processus précedents du chapitre que l'utilisateur à les droits d'accès
                     * sont validé ou non et donc visible ou non
                     */
                    $taux_validation_processus = FtaProcessusModel::getFtaProcessusNonValidePrecedent(self::$id_fta, self::$id_fta_processus, self::$id_fta_workflow);

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


                if ($ProcessusPrecedentVisible) {
                    /*
                     * Nous récupérons tous les processus validé pour vérifier plus tard si nous devons les affichers
                     */
                    foreach ($arrayProcessusValide as $rowsProcessusValide) {
                        self::$id_fta_processus = $rowsProcessusValide[FtaProcessusModel::KEYNAME];
                        $taux_validation_processus = FtaProcessusModel::getValideProcessusEncours(self::$id_fta, self::$id_fta_processus, self::$id_fta_workflow);
                        if ($taux_validation_processus == 1) {

                            $ProcessusValide[] = $rowsProcessusValide[FtaProcessusModel::KEYNAME];
                        }
                    }
                }
            }
            /*
             * Nous récuperons la liste des processus non valider  qui sont en cours
             * par la vérification des droits d'accès de l'utilisateur en cours par Workflow par role 
             * et un balayage  des cycles des processus
             */
            $req = "SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                    . " FROM " . FtaProcessusCycleModel::TABLENAME
                    . "," . FtaProcessusModel::TABLENAME
                    . "," . FtaWorkflowModel::TABLENAME
                    . "," . FtaWorkflowStructureModel::TABLENAME
                    . "," . IntranetActionsModel::TABLENAME
                    . "," . IntranetDroitsAccesModel::TABLENAME
                    . "," . IntranetModulesModel::TABLENAME
                    . "," . FtaActionRoleModel::TABLENAME
                    . "," . FtaRoleModel::TABLENAME
                    . "," . FtaSuiviProjetModel::TABLENAME
                    . " WHERE " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                    . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME        //Jointure
                    . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                    . "=" . self::$id_fta_workflow       //Jointure
                    . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                    . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME        //Jointure                            
                    . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                    . "=" . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME        //Jointure
                    . " AND " . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME
                    . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                    . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_INTRANET_ACTIONS
                    . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                    . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                    . "=" . $ftaActionRoleModel->getDataField(FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE)->getFieldValue()
                    . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
                    . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS  //Jointure
                    . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
                    . "=" . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME  //Jointure
                    . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $id_user //Utilisateur actuellement connecté
                    . " AND " . IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES . "='" . FtaModel::TABLENAME
                    . "' AND " . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=1"  //L'utilisateur est propriétaire
                    . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                    . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE  //Jointure
                    . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0" //chapitre validé
            ;

            //Finalisation de la requête
            $req .="";

            $result = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);
            if ($result) {
                foreach ($result as $rows) {

                    //Pour chaque processus, on vérifie que tous ces précédents sont validés
                    $req = "SELECT " . FtaProcessusCycleModel::KEYNAME . " FROM " . FtaProcessusCycleModel::TABLENAME
                            . " WHERE " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                            . "=" . $rows[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT]
                            . " AND ( " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . "=0 "
                    ;

                    //Ajout de la restriction des processus validé
                    $req .=self::AddValidProcess($ProcessusValide);

                    //Recherche dans le cycle correspondant à l'état en cours de la fiche
                    $req_etat = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                    "SELECT " . FtaEtatModel::TABLENAME . "." . FtaEtatModel::FIELDNAME_ABREVIATION
                                    . " FROM " . FtaEtatModel::TABLENAME . "," . FtaModel::TABLENAME
                                    . " WHERE " . FtaEtatModel::TABLENAME . "." . FtaEtatModel::KEYNAME
                                    . "=" . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT
                                    . " AND " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
                                    . "= '" . self::$id_fta . "'"
                    );

                    foreach ($req_etat as $rowsEtat) {
                        $abreviation_fta_etat = $rowsEtat[FtaEtatModel::FIELDNAME_ABREVIATION];
                    }

                    $req .= ") AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT
                            . "='" . $abreviation_fta_etat
                            . "' AND " . FtaProcessusCycleModel::FIELDNAME_WORKFLOW . " = " . self::$id_fta_workflow;

                    //Filtrage par catégorie
                    //Finalisation de la requête
                    //Si la requête a un résultat c'est que tous les processus précédents sont validés
                    /*
                     * Nous récupérons tous les processus que l'utilisateur verra en lecture(seule) 
                     * afin qu'ils puissent remplir les données des champs de leurs chapitres
                     */
                    $arrayIdFtaProcessusCyle = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);
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
                    $req = "SELECT DISTINCT " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                            . " FROM " . FtaWorkflowStructureModel::TABLENAME . "," . FtaProcessusModel::TABLENAME
                            . "," . FtaProcessusCycleModel::TABLENAME
                            . " WHERE " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                            . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                            . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                            . "=" . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                            . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                            . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                            . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME . "=" . $rows[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT]
                            . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW . " = " . self::$id_fta_workflow;
                    $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);

                    if ($array) {
                        /*
                         * Vérifie si tous les processus précédent du processus en cours a des chapitres non validé
                         */
                        foreach ($array as $rows) {

                            $tauxValidationProcessus = FtaProcessusModel::getValideProcessusEncours(self::$id_fta, $rows[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT], self::$id_fta_workflow);
                            if ($tauxValidationProcessus != 0) {
                                $ProcessusEnLecture[] = $rows[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT];
                            }
                        }

                        /*
                         * Désactivation des check de multisite voir FtaProcessusmodel::CheckMultisite
                         */
//                        //Ce processus en cours, est-il du type repartie ou centralisé ?
//                        $reqType = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
//                                        "SELECT " . FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS
//                                        . " FROM " . FtaProcessusModel::TABLENAME
//                                        . " WHERE " . FtaProcessusModel::KEYNAME
//                                        . "=" . $rows[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT]
//                        );
//                        if ($reqType) {
//                            foreach ($reqType as $rowsType) {
//                                $multisite_fta_processus = $rowsType[FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS];
//                            }
//                            if ($multisite_fta_processus) {
//                                //Oui, il s'agit d'un Processus répartie sur les sites d'assemblage
//                                $ProcessusEncoursVisible[] = self::CheckMultiSite($rows[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT]);
//                            } else {
                        //Enregistrement du processus en tant que processus en cours
                        $ProcessusEncoursVisible[] = $rows[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT];
//                            }
//                        }
                    }
                }//Fin du balayage des processus non-validés
            }
            //Recherche des processus valide ayant un lien dans processus cycle
            foreach ($ProcessusValide as $rowsProcessusValide2) {
                //Pour chaque processus, on vérifie que tous ces précédents sont validés
                $req = "SELECT " . FtaProcessusCycleModel::KEYNAME . " FROM " . FtaProcessusCycleModel::TABLENAME
                        . " WHERE " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                        . "=" . $rowsProcessusValide2
                        . " AND ( " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . "=0 "
                ;

                //Ajout de la restriction des processus validé
                $req .=self::AddValidProcess($ProcessusValide);

                //Recherche dans le cycle correspondant à l'état en cours de la fiche
                $req_etat = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT " . FtaEtatModel::TABLENAME . "." . FtaEtatModel::FIELDNAME_ABREVIATION
                                . " FROM " . FtaEtatModel::TABLENAME . "," . FtaModel::TABLENAME
                                . " WHERE " . FtaEtatModel::TABLENAME . "." . FtaEtatModel::KEYNAME
                                . "=" . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT
                                . " AND " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
                                . "= '" . self::$id_fta . "'"
                );

                foreach ($req_etat as $rowsEtat) {
                    $abreviation_fta_etat = $rowsEtat[FtaEtatModel::FIELDNAME_ABREVIATION];
                }

                $req .= ") AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT
                        . "='" . $abreviation_fta_etat
                        . "' AND " . FtaProcessusCycleModel::FIELDNAME_WORKFLOW . " = " . self::$id_fta_workflow;

                //Filtrage par catégorie
                //Finalisation de la requête
                //Si la requête a un résultat c'est que tous les processus précédents sont validés
                /*
                 * Nous récupérons tous les processus que l'utilisateur verra en lecture(seule) 
                 * afin qu'ils puissent remplir les données des champs de leurs chapitres
                 */
                $arrayIdFtaProcessusCyle = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($req);
                if ($arrayIdFtaProcessusCyle) {
                    foreach ($arrayIdFtaProcessusCyle as $rowsIdFtaProcessusCycle) {
                        $idFtaProcessusCyle = $rowsIdFtaProcessusCycle[FtaProcessusCycleModel::KEYNAME];
                        $ftaProcessusCycleModel = new FtaProcessusCycleModel($idFtaProcessusCyle);
                        $ProcessusEnLecture[] = $ftaProcessusCycleModel->getDataField(FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT)->getFieldValue();
                    }
                }
            }


            //Création de la liste des processus dans la barre de navigation          
            $t_liste_processus = array_merge($ProcessusEncoursVisible, $ProcessusPrecedentVisible, $ProcessusEnLecture);

            //Récupération des Chapitres accessible dans le menu de naviguation
            $menu_navigation = self::RecupChapitre($t_liste_processus);
            //Fin du controle de $synthese_action
        }
        return $menu_navigation;
    }

    protected static function RecupChapitre($paramT_Liste_Processus) {
        $page_default = "modification_fiche";
        /*
         *  Nous récupérons les chapitres obligatoirement présent ce qui implique que les autre chapitres doivent être attribués.
         */
        $reqRecup = "SELECT " . FtaChapitreModel::TABLENAME . "." . FtaChapitreModel::KEYNAME
                . ", " . FtaChapitreModel::TABLENAME . "." . FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE
                . ", " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                . " FROM " . FtaChapitreModel::TABLENAME . " LEFT JOIN " . FtaWorkflowStructureModel::TABLENAME
                . " ON " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                . "=" . FtaChapitreModel::TABLENAME . "." . FtaChapitreModel::KEYNAME
                . " WHERE ( "
                . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS . " =0"                          //Chapitre public
        ;
        foreach ($paramT_Liste_Processus as $value) {
            $reqRecup .= " OR " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                    . "=" . $value . " ";
        }
        $reqRecup .=" ) AND " . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . "=" . self::$id_fta_workflow
                . " ORDER BY " . FtaChapitreModel::TABLENAME . "." . FtaChapitreModel::KEYNAME;
        $arrayRecup = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($reqRecup);

        //Balyage des chapitres trouvés
        foreach ($arrayRecup as $rowsRecup) {
            $id_fta_chapitre = $rowsRecup[FtaChapitreModel::KEYNAME];
            $nom_usuel_fta_chapitre = $rowsRecup[FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE];

            //Dans le cas où il n'y a pas de chapitre sélectionné, sélection du premier
            if (!self::$id_fta_chapitre_encours) {
                self::$id_fta_chapitre_encours = $id_fta_chapitre;
            }
            if (self::$id_fta_chapitre_encours == $id_fta_chapitre) {
                $b = "<font size = 3 color = #5494EE><b>";
                $image1 = "[>";
                $image2 = "<]";
                $num = 1;
            } else {
                $image1 = "[>";
                $image2 = "<]";
                //Ce chapitre est-il public?
                if ($rowsRecup[FtaProcessusModel::KEYNAME] == 0) {
                    $b = "<font color=\"#8977A9\">";
                    $num = 1;
                } else {
                    //Le chapitre est-il validé ?
                    $req1 = "SELECT " . FtaSuiviProjetModel::KEYNAME
                            . " FROM " . FtaSuiviProjetModel::TABLENAME
                            . " WHERE " . FtaSuiviProjetModel::FIELDNAME_ID_FTA . "=" . self::$id_fta
                            . " AND " . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE . "=" . $id_fta_chapitre
                            . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0 "
                    ;
                    $result1 = DatabaseOperation::query($req1);
                    $num = DatabaseOperation::getSqlNumRows($result1);
                    switch ($num) {
                        case 0:  //Chapiter pas encore validé
                            $b = "<font color=\"#FF0000\">";
                            break;

                        case 1:  //Chapitre validé
                            $b = "<font color=\"#00B300\">";
                            break;

                        default: //Anomalie
                            $titre = "Erreur Grave !";
                            $message = "La fonction afficher_navigation() vient de trouver des doublons de validation des chapitres dans la table fta_suivi_projet";
                            afficher_message($titre, $message, $redirection);
                            break;
                    }
                }//Fin du test public
            }//Fin de la colorisation

            if ($num == 0 and self::$synthese_action === "attente") {
                
            } else {
                $menu_navigation .= "<a href=$page_default.php?id_fta=" . self::$id_fta . "&id_fta_chapitre_encours=$id_fta_chapitre&synthese_action=" . self::$synthese_action . "&id_fta_etat=" . self::$id_fta_etat
                            . "&abrevation_fta_etat=" . self::$abrevation_etat
                            . "&id_fta_role=" . self::$id_fta_role .">$b"
                        . $image1 . $nom_usuel_fta_chapitre . $image2
                        . "</a>"
                        . "</b></font> "
                ;
            }
        }
        return $menu_navigation;
    }

//Fin de la création des chapitres
    //Suppression des processus déjà validé
    protected static function DeleteValidProcess($paramProcessusVisible) {
        if ($paramProcessusVisible) {
            foreach ($paramProcessusVisible as $value) {
                $req .= " AND " . " " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT . "<>" . $value . " ";
            }
        }
        return $req;
    }

//Ajout de la restriction des processus validé
    protected static function AddValidProcess($paramProcessusVisible) {
        if ($paramProcessusVisible) {
            foreach ($paramProcessusVisible as $value) {
                $req .= " OR " . " " . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT . "=" . $value . " ";
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
      "SELECT " . FtaProcessusMultisiteModel::FIELDNAME_ID_SITE_PROCESSUS_FTA_PROCESSUS_MULTISITE
      . " FROM " . FtaProcessusMultisiteModel::TABLENAME
      . "," . FtaModel::TABLENAME
      . " WHERE " . FtaProcessusMultisiteModel::FIELDNAME_ID_SITE_ASSEMBLAGE_FTA_PROCESSUS_MULTISITE
      . "=" . FtaModel::FIELDNAME_SITE_ASSEMBLAGE
      . " AND " . FtaProcessusMultisiteModel::FIELDNAME_ID_SITE_PROCESSUS_FTA_PROCESSUS_MULTISITE
      . "= '" . $paramRows . "' "
      . " AND " . FtaModel::KEYNAME . "=" . self::$id_fta
      );

      if ($arrayGestion) {
      foreach ($arrayGestion as $rowsGestion) {
      $id_geo = $rowsGestion[FtaProcessusMultisiteModel::FIELDNAME_ID_SITE_PROCESSUS_FTA_PROCESSUS_MULTISITE];
      }
      } else {
      //Sinon, Vérification de l'égalité entre le site d'assemblage de la FTA et le site de Localisation de l'utilisateur
      $arrayEgalite = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
      "SELECT " . GeoModel::KEYNAME
      . " FROM " . FtaModel::TABLENAME
      . "," . GeoModel::TABLENAME
      . " WHERE " . FtaModel::KEYNAME
      . "=" . self::$id_fta
      . " AND " . FtaModel::FIELDNAME_SITE_ASSEMBLAGE
      . "=" . GeoModel::FIELDNAME_ID_SITE
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
}
