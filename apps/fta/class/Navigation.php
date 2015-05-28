<?php

/**
 * Description of navigation
 *
 * @author tp4300008
 */
class Navigation {

    protected static $id_fta;
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

    public static function initNavigation($id_fta, $id_fta_chapitre_encours, $synthese_action, $comeback) {

        self::$id_fta = $id_fta;
        self::$id_fta_chapitre_encours = $id_fta_chapitre_encours;
        self::$synthese_action = $synthese_action;
        self::$comeback = $comeback;
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
                        . " AND " . FtaEtatModel::TABLENAME . "." . FtaEtatModel::KEYNAME . "=" . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
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
        if (self::$comeback == 1) {
            self::$comeback_url = $_SERVER["HTTP_REFERER"];
        }
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

        $t_processus_encours = array();
        $t_processus_visible = array();
        $globalconfig = new GlobalConfig();
        $modelFta = new FtaModel(self::$id_fta);
        $id_user = $globalconfig->getAuthenticatedUser()->getKeyValue();
        $id_fta_workflow = $modelFta->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
        $ftaWorkflowModel = new FtaWorkflowModel($id_fta_workflow);
        $id_parent_intranet_actions = $ftaWorkflowModel->getDataField(FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS)->getFieldValue();
        $id_intranet_actions[] = IntranetActionsModel::getIdIntranetActionsFromIdParentAction($id_parent_intranet_actions);
        $id_actions_role = FtaActionRoleModel::getIdFtaActionRoleFromIdIntranetAtions($id_intranet_actions);
        $ftaActionRoleModel = new FtaActionRoleModel($id_actions_role);




        //Si une action est donnée, alors construction du menu des chapitres
        if (self::$synthese_action) {
            //Etat d'avancement de la FTA et Recherche des processus validés (et donc en lecture-seule)
            // //Vérification que l'utilisateur à les droits d'accès sur les processus visibles 
            /*
             * erreur
             */
            $req = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                            "SELECT DISTINCT " . FtaProcessusModel::TABLENAME
                            . ".* FROM " . FtaProcessusModel::TABLENAME
                            . ", " . FtaProcessusCycleModel::TABLENAME . "," . FtaWorkflowModel::TABLENAME
                            . "," . FtaWorkflowStructureModel::TABLENAME
                            . "," . IntranetActionsModel::TABLENAME
                            . "," . IntranetDroitsAccesModel::TABLENAME
                            . "," . IntranetModulesModel::TABLENAME
                            . "," . FtaActionRoleModel::TABLENAME
                            . "," . FtaRoleModel::TABLENAME
                            . " WHERE " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT
                            . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                            . " AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='I'"
                            . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                            . "='" . self::$id_fta_workflow . "' "
                            . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                            . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME        //Jointure
                            . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                            . "=" . self::$id_fta_workflow       //Jointure
                            . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                            . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME        //Jointure                            
                            . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                            . "=" . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME        //Jointure
                            . " AND " . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME
                            . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                            . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
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

            if ($req) {
                //Balayage de tous les processus
                foreach ($req as $rows) {
                    self::$id_fta_processus = $rows[FtaProcessusModel::KEYNAME];
                    $taux_validation_processus = fta_processus_validation(self::$id_fta, self::$id_fta_processus);

                    //Liste des processus visible(lecture-seule)
                    if ($taux_validation_processus == 1) {
                        $t_processus_visible[] = $rows[FtaProcessusModel::KEYNAME];
                    }
                }//Fin du balayage
            }

            //Recherche des processus en cours
            //Balayage des cycles des processus (en excluant les processus déjà validés)


            /*
             * Sur ce niveau un processus doit selectionner le premier chapitre du groupe / la notion de rôle doit e^tre implement auparavant
             * car cela gènère des erreurs ou faute dans ma requete sql car 
             * quand je valide un chap d'un processus cela débloque tous les chapitre du meme role 
             * alors quil manque d'autre chapitre a valider pour valider le processus
             * 
             * 2: Sur cette requete nous tentons d'obtenir la liste des processus non valider par workflow  et par role 
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
                    //. "," . FtaSuiviProjetModel::TABLENAME
                    //. "," . FtaModel::TABLENAME                    
                    //. "," . FtaChapitreModel::TABLENAME
                    . " WHERE 1 AND ( 1 "
            ;

            //Suppression des processus déjà validé
            $req .= self::DeleteValidProcess($t_processus_visible);

            //Vérification des droits d'accès de l'utilisateur en cours par Workflow par role
            $req .=") "
                    . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                    . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME        //Jointure
                    . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                    . "=" . self::$id_fta_workflow       //Jointure
                    . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
                    . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME        //Jointure                            
                    . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
                    . "=" . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME        //Jointure
                    . " AND " . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME
                    . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
                    . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
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
//                    . " AND " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
//                    . "=" . self::$id_fta_workflow       //Jointure
//                    . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $id_user //Utilisateur actuellement connecté
//                    . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
//                    . "=" . IntranetActionsModel::getIdIntranetActionsFromIdParentAction(self::$id_parent_intranet_actions)          //Jointure
//                    . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS          //Jointure
//                    . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
//                    . " AND " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
//                    . "=" . self::$id_parent_intranet_actions          //Jointure
//                    
//                    . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
            // . "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE  //Jointure
            // . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0" //chapitre validé
            ;
            //                    . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
//                    . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME        //Jointure
//                    . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
//                    . "=" . self::$id_fta_workflow       //Jointure
//                    . " AND " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS
//                    . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS          //Jointure
//                    . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
//                    . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS  //Jointure
//                    . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
//                    . "=" . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME  //Jointure
//                    // . " AND " . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
//                    //. "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA  //Jointure
//                    //. " AND " . FtaChapitreModel::TABLENAME . "." . FtaChapitreModel::KEYNAME
//                    //. "=" . FtaSuiviProjetModel::TABLENAME . "." . FtaSuiviProjetModel::FIELDNAME_ID_FTA_CHAPITRE  //Jointure
//                    // . " AND " . FtaChapitreModel::TABLENAME . "." . FtaChapitreModel::FIELDNAME_ID_PROCESSUS
//                    // . "=" . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_INIT  //Jointure
//                    // . " AND " . FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET . "<>0" //chapitre validé
//                    . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $id_user //Utilisateur actuellement connecté
//                    . " AND " . IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES . "='" . FtaModel::TABLENAME
//                    . "' AND " . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=1"  //L'utilisateur est propriétaire
//            // . " AND " . FtaProcessusCycleModel::FIELDNAME_FTA_ETAT . "='" . $modelFta->getModelFtaEtat()->getDataField(FtaEtatModel::FIELDNAME_ABREVIATION)->getFieldValue() . "' "
//            // . " AND " . FtaModel::FIELDNAME_CATEGORIE_FTA . "= '" . $modelFta->getDataField(FtaModel::FIELDNAME_CATEGORIE_FTA)->getFieldValue(). "' "
//            ;
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
                    $req .=self::AddValidProcess($t_processus_visible);

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
                    //Il est donc un Processus en cours
                    $req_temp = DatabaseOperation::query($req);

                    if (DatabaseOperation::getSqlNumRows($req_temp)) {
                        //Ce processus en cours, est-il du type repartie ou centralisé ?
                        $reqType = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                        "SELECT " . FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS
                                        . " FROM " . FtaProcessusModel::TABLENAME
                                        . " WHERE " . FtaProcessusModel::KEYNAME
                                        . "=" . $rows[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT]
                        );
                        foreach ($reqType as $rowsType) {
                            $multisite_fta_processus = $rowsType[FtaProcessusModel::FIELDNAME_MULTISITE_FTA_PROCESSUS];
                        }
                        if ($multisite_fta_processus) {
                            //Oui, il s'agit d'un Processus répartie sur les sites d'assemblage
                            $t_processus_encours = self::CheckMultiSite($rows, $t_processus_encours);
                        } else {
                            //Enregistrement du processus en tant que processus en cours
                            $t_processus_encours[] = $rows[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT];
                        }
                    }
                }//Fin du balayage des processus non-validés
            }
            //Recherche des processus Publics
            //Création de la liste des processus dans la barre de navigation          
            $t_liste_processus = array_merge($t_processus_encours, $t_processus_visible);
            //ceete requête de focntionne plus puisqu'elle ne prends pas en compte les workflows
            //
            //Ajout des processus n'ayant pas de précédents et donc obligatoirement présent dans le menu de navigation
            $resultAddProces = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                            "SELECT " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME . " FROM " . FtaProcessusModel::TABLENAME
                            . " LEFT JOIN " . FtaProcessusCycleModel::TABLENAME
                            . " ON " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME
                            . "=" . FtaProcessusCycleModel::TABLENAME
                            . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
                            . " WHERE " . FtaProcessusCycleModel::TABLENAME
                            . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT . " IS NULL"
                            //. " AND " . FtaProcessusCycleModel::FIELDNAME_WORKFLOW . "=" . self::$id_fta_workflow
            );
            //j'obtient le 12 et le 13 mais il faudrait que j'ai le 12 seulement que
            "            SELECT fta_processus_cycle.id_init_fta_processus "
                    . "FROM fta_processus_cycle LEFT JOIN  fta_processus "
                    . "ON fta_processus.id_fta_processus=fta_processus_cycle.id_next_fta_processus "
                    . "WHERE fta_processus.id_fta_role = 1 "
                    . "AND 	id_fta_workflow=1";
            //J'obtient les autres processus du role 1 dans le workflows 1 le processus 13,14,15 (12 est identité) 
            "            SELECT fta_processus.id_fta_processus "
                    . "FROM fta_processus_cycle LEFT JOIN  fta_processus "
                    . "ON fta_processus.id_fta_processus=fta_processus_cycle.id_next_fta_processus "
                    . "WHERE fta_processus.id_fta_role = 1 "
                    . "AND 	id_fta_workflow=1";
            if ($resultAddProces) {
                foreach ($resultAddProces as $rowsAddProcess) {
                    //   $t_liste_processus[] = $rowsAddProcess[FtaProcessusModel::KEYNAME];
                }
            }
            //Récupération des Chapitres accessible dans le menu de naviguation
            $menu_navigation = self::RecupChapitre($t_liste_processus);
        }//Fin du controle de $synthese_action

        return $menu_navigation;
    }

    protected static function RecupChapitre($paramT_Liste_Processus) {
        $page_default = "modification_fiche";
        // Requete pour récuperer les chapitres auto ce qui implique que les autre chapitres doivent être attribués.
        $reqRecup = "SELECT " . FtaChapitreModel::TABLENAME . "." . FtaChapitreModel::KEYNAME
                . ", " . FtaChapitreModel::TABLENAME . "." . FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE
                . ", " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS
                . " FROM " . FtaChapitreModel::TABLENAME . " LEFT JOIN " . FtaWorkflowStructureModel::TABLENAME
                . " ON " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
                . "=" . FtaChapitreModel::TABLENAME . "." . FtaChapitreModel::KEYNAME
                . " WHERE ( "
                . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE . " IS NULL"                          //Chapitre public
        //. " AND " .  FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . "=" . self::$id_fta_workflow                          //Chapitre public
        ;
        foreach ($paramT_Liste_Processus as $value) {
            $reqRecup .= " OR " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS . "=" . $value . " ";
        }
        $reqRecup .=" ) ORDER BY " . FtaChapitreModel::TABLENAME . "." . FtaChapitreModel::KEYNAME;
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
                $menu_navigation .= "<a href=$page_default.php?id_fta=" . self::$id_fta . "&id_fta_chapitre_encours=$id_fta_chapitre&synthese_action=" . self::$synthese_action . ">$b"
                        . $image1 . $nom_usuel_fta_chapitre . $image2
                        . "</a>"
                        . "</b></font> "
                ;
            }
        }
        return $menu_navigation;
    }

//Fin de la création des chapitres
//    public static function getProcessusVisibleByCheckingDroitsAcces($paramProcessusVisible) {
//
//        $arrayProcessusVisible = . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT
//        . "=" . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::KEYNAME        //Jointure
//        . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
//        . "=" . self::$id_fta_workflow       //Jointure
//        . " AND " . FtaProcessusCycleModel::TABLENAME . "." . FtaProcessusCycleModel::FIELDNAME_WORKFLOW
//        . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME        //Jointure                            
//        . " AND " . FtaProcessusModel::TABLENAME . "." . FtaProcessusModel::FIELDNAME_ID_FTA_ROLE
//        . "=" . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME        //Jointure
//        . " AND " . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME
//        . "=" . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
//        . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
//        . "=" . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
//        . " AND " . FtaActionRoleModel::TABLENAME . "." . FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE
//        . "=" . $ftaActionRoleModel->getDataField(FtaActionRoleModel::FIELDNAME_ID_FTA_ROLE)->getFieldValue()
//        . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME
//        . "=" . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS  //Jointure
//        . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
//        . "=" . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME  //Jointure
//        . " AND " . IntranetDroitsAccesModel::FIELDNAME_ID_USER . "=" . $id_user //Utilisateur actuellement connecté
//        . " AND " . IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES . "='" . FtaModel::TABLENAME
//        . "' AND " . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . "=1"  //L'utilisateur est propriétaire;
//
//        return $paramProcessusVisible;
//    }
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

    protected static function CheckMultiSite($paramRows, $paramT_Processus_Encours) {
        $globalconfig = new GlobalConfig();
        $paramLieuGeo = $globalconfig->getAuthenticatedUser()->getLieuGeo();
//Existe-il une configuration de gestion forcée pour ce processus et ce site d'assemblage ?
        $resultGestion = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT " . FtaProcessusMultisiteModel::FIELDNAME_ID_SITE_PROCESSUS_FTA_PROCESSUS_MULTISITE
                        . "FROM " . FtaProcessusMultisiteModel::TABLENAME
                        . "," . FtaModel::TABLENAME
                        . "WHERE " . FtaProcessusMultisiteModel::FIELDNAME_ID_SITE_ASSEMBLAGE_FTA_PROCESSUS_MULTISITE
                        . "=" . FtaModel::FIELDNAME_SITE_ASSEMBLAGE
                        . "AND " . FtaProcessusMultisiteModel::FIELDNAME_ID_SITE_PROCESSUS_FTA_PROCESSUS_MULTISITE
                        . "= '" . $paramRows[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT] . "' "
                        . "AND " . FtaModel::KEYNAME . "=" . self::$id_fta
        );
        foreach ($resultGestion as $rowsGestion) {
            if ($rowsGestion == TRUE) {
                $id_geo = $rowsGestion[FtaProcessusMultisiteModel::FIELDNAME_ID_SITE_PROCESSUS_FTA_PROCESSUS_MULTISITE];
            } else {
                //Sinon, Vérification de l'égalité entre le site d'assemblage de la FTA et le site de Localisation de l'utilisateur
                $resultEgalite = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                "SELECT " . GeoModel::KEYNAME . " FROM " . FtaModel::TABLENAME
                                . "," . GeoModel::TABLENAME
                                . " WHERE " . FtaModel::KEYNAME
                                . "=" . self::$id_fta
                                . " AND " . FtaModel::FIELDNAME_SITE_ASSEMBLAGE
                                . "=" . GeoModel::FIELDNAME_ID_SITE
                );
                foreach ($resultEgalite as $rowsEgalite) {
                    if ($rowsEgalite) {
                        $id_geo = $rowsEgalite [GeoModel::KEYNAME];
                    }
                }
            }
            if ($id_geo == $paramLieuGeo) {
                //L'égalité est respecté, donc ce processus est bien en cours
                $paramT_Processus_Encours[] = $paramRows[FtaProcessusCycleModel::FIELDNAME_PROCESSUS_NEXT];
            }
        }
        return $paramT_Processus_Encours;
    }

}
