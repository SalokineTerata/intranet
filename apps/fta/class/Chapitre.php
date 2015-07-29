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
 * Description of Chapitre
 * Génère toute la partie HTML des chapitres.
 *
 * @author bs4300280
 */
class Chapitre {

    const NOT_EDITABLE = false;
    const ID_CHAPITRE_IDENTITE = 1;

    /**
     * Valeur de la clef de l'enregistrement FTA
     * @var mixed 
     */
    protected static $id_fta;

    /**
     * 
     * @var FtaModel 
     */
    protected static $ftaModel;

    /**
     * 
     * @var FtaChapitreModel 
     */
    protected static $ftaChapitreModel;

    /**
     * 
     * @var FtaSuiviProjetModel 
     */
    protected static $ftaSuiviProjetModel;

    /**
     * 
     * @var FtaWorkflowModel 
     */
    protected static $ftaWorkflowModel;

    /**
     * 
     * @var FtaWorkflowStructureModel 
     */
    protected static$abrevation_etat;
    protected static$comeback;
    protected static $ftaWorkflowStructureModel;
    protected static $html_chapitre_activation_des_produits;
    protected static $html_chapitre_all;
    protected static $html_chapitre_codification;
    protected static $html_chapitre_codification_externe;
    protected static $html_chapitre_codification_w1;
    protected static $html_chapitre_commentaire;
    protected static $html_chapitre_commerce;
    protected static $html_chapitre_composition;
    protected static $html_chapitre_conditionnement_decoupe;
    protected static $html_chapitre_conditionnement_piece_entiere;
    protected static $html_chapitre_core;
    protected static $html_chapitre_decoupe;
    protected static $html_chapitre_dictionnaire_de_donnees;
    protected static $html_chapitre_donnees_clients_w1;
    protected static $html_chapitre_duree_de_vie;
    protected static $html_chapitre_emballage;
    protected static $html_chapitre_emballage_colis;
    protected static $html_chapitre_etiquette;
    protected static $html_chapitre_etiquette_article;
    protected static $html_chapitre_etiquette_article_MDDAvecEtiq;
    protected static $html_chapitre_etiquette_article_FEAvecEtiq;
    protected static $html_chapitre_etiquette_client;
    protected static $html_chapitre_etiquette_client_MDDAvecEtiq;
    protected static $html_chapitre_etiquette_client_FEAvecEtiq;
    protected static $html_chapitre_etiquette_composant;
    protected static $html_chapitre_etiquette_composant_MDDAvecEtiq;
    protected static $html_chapitre_etiquette_composant_FEAvecEtiq;
    protected static $html_chapitre_etiquette_r_d;
    protected static $html_chapitre_expedition;
    protected static $html_chapitre_exigence_client;
    protected static $html_chapitre_identite;
    protected static $html_chapitre_need_rebuild;
    protected static $html_chapitre_nomenclature;
    protected static $html_chapitre_palettisation;
    protected static $html_chapitre_pcb;
    protected static $html_chapitre_production;
    protected static $html_chapitre_qualite;
    protected static $html_chapitre_site_expedition;
    protected static $html_chapitre_site_production;
    protected static $html_correct_button;
    protected static $html_submit_button;
    protected static $html_suivi_dossier;
    protected static $id_fta_chapitre;
    protected static$id_fta_etat;
    protected static $id_fta_processus;
    protected static$id_fta_role;
    protected static $id_fta_workflow;
    protected static $id_fta_workflow_structure;
    protected static $id_intranet_actions;
    protected static $is_correctable;
    protected static $is_editable;
    protected static $is_owner;

    /**
     * 
     * @var IntranetActionsModel 
     */
    protected static $moduleIntranetActionsModel;

    /**
     * Objet FTA
     * @var ObjectFta 
     */
    protected static $objectFta;
    protected static $synthese_action;
    protected static $taux_validation_processus;

    private static function NOT_IMPLEMENTED_initObject($id_fta) {

        self::$objectFta = new ObjectFta($id_fta);
    }

    public static function NOT_IMPLEMENTED_saveObject() {

        $_SESSION["Chapitre"]["objectFta"] = self::$objectFta;
        $_SESSION["Chapitre"]["html_chapitre_identite"] = self::$html_chapitre_identite;
        $_SESSION["Chapitre"]["html_chapitre_need_rebuild"] = self::$html_chapitre_need_rebuild;
    }

    public static function NOT_IMPLEMENTED_restoreObject() {
        self::$objectFta = $_SESSION["Chapitre"]["objectFta"];
        self::$html_chapitre_identite = $_SESSION["Chapitre"]["html_chapitre_identite"];
        self::$html_chapitre_need_rebuild = $_SESSION["Chapitre"]["html_chapitre_need_rebuild"];
    }

    public static function NOT_IMPLEMENTED_buildHtml($id_fta, $synthese_action, $is_editable = false, $need_rebuild = true) {

        self::$html_chapitre_need_rebuild = $need_rebuild;
        if (self::$html_chapitre_need_rebuild) {
            self::initObject($id_fta);
            self::$html_chapitre_identite = self::buildChapitreIdentitie($id_fta, $synthese_action, $is_editable);
            self::saveObject();
        } else {
            self::restoreObject();
        }
        return self::$html_chapitre_identite;
    }

    public static function getHtmlChapitreIdentite() {
        return self::$html_chapitre_identite;
    }

    public static function getHtmlChapitreAll() {
        return self::$html_chapitre_all;
    }

    public static function initChapitre($id_fta, $id_fta_chapitre, $synthese_action, $comeback, $idFtaEtat, $abreviationFtaEtat, $idFtaRole) {

        self::$id_fta = $id_fta;
        self::$comeback = $comeback;
        self::$id_fta_etat = $idFtaEtat;
        self::$abrevation_etat = $abreviationFtaEtat;
        self::$id_fta_role = $idFtaRole;
        self::$id_fta_chapitre = $id_fta_chapitre;
        self::$ftaModel = new FtaModel(self::$id_fta);
        self::$ftaChapitreModel = new FtaChapitreModel(self::$id_fta_chapitre);
        self::$id_fta_workflow = self::$ftaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
        self::$ftaWorkflowModel = new FtaWorkflowModel(self::$id_fta_workflow);
        self::$synthese_action = $synthese_action;

        self::$objectFta = new ObjectFta(self::$id_fta); //cela genère un id fta_suivie projet de trop
        self::$objectFta->loadCurrentSuiviProjectByChapter(self::$id_fta_chapitre);

        self::$id_fta_workflow_structure = FtaWorkflowStructureModel::getIdFtaWorkflowStructureByIdFtaAndIdChapitre(
                        self::$id_fta, self::$id_fta_chapitre);
        self::$ftaWorkflowStructureModel = new FtaWorkflowStructureModel(self::$id_fta_workflow_structure);
        self::$id_fta_processus = self::$ftaWorkflowStructureModel->getDataField(FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS)->getFieldValue();
        self::$id_intranet_actions = IntranetActionsModel::getIdIntranetActionsFromIdParentAction(
                        self::$ftaWorkflowModel->getDataField(FtaWorkflowModel::FIELDNAME_ID_INTRANET_ACTIONS)->getFieldValue()
                        , self::$id_fta_chapitre, self::$id_fta_workflow);
        self::$moduleIntranetActionsModel = new IntranetActionsModel(self::$id_intranet_actions);

        self::$is_owner = self::buildIsOwner();
        self::$is_editable = self::buildIsEditable();
        self::$is_correctable = self::buildIsCorrectable();
        self::$taux_validation_processus = self::buildTauxValidationProcessus();
        self::$html_submit_button = self::buildHtmlSubmitButton();
        self::$html_correct_button = self::buildHtmlCorrectButton();
        self::$html_chapitre_core = self::buildChapitreCore();
        self::$html_suivi_dossier = self::buildSuiviDossier();
        self::$html_chapitre_all = self::buildChapitreAll();
    }

    protected static function buildTauxValidationProcessus() {
//Taux de validation du processus
        $return = "";
        if (self::$id_fta_processus != 0) {
            $return = FtaProcessusModel::getValideProcessusEncours(self::$id_fta, self::$id_fta_processus, self::$id_fta_workflow);
        }
        return $return;
    }

    protected static function buildChapitreAll() {

        $return = self::$html_submit_button
                . self::$html_chapitre_core
                . self::$html_submit_button
                . self::$html_suivi_dossier
                . self::$html_submit_button
                . self::$html_correct_button
        ;
        return $return;
    }

    protected static function buildChapitreCore() {
        $return = "";
        switch (self::$ftaChapitreModel->getDataField(FtaChapitreModel::FIELDNAME_NOM_CHAPITRE)->getFieldValue()) {
            case "identite":
                self::$html_chapitre_identite = self::buildChapitreIdentite();
                $return = self::$html_chapitre_identite;
                break;
            case "commerce":
                self::$html_chapitre_commerce = self::buildChapitreCommerce();
                $return = self::$html_chapitre_commerce;
                break;
            case "production":
                self::$html_chapitre_production = self::buildChapitreProduction();
                $return = self::$html_chapitre_production;
                break;
            case "qualite":
                self::$html_chapitre_qualite = self::buildChapitreQualite();
                $return = self::$html_chapitre_qualite;
                break;
            case "decoupe":
                self::$html_chapitre_decoupe = self::buildChapitreDecoupe();
                $return = self::$html_chapitre_decoupe;
                break;
            case "conditionnement_piece_entiere":
                self::$html_chapitre_conditionnement_piece_entiere = self::buildChapitreConditionnementPieceEntiere();
                $return = self::$html_chapitre_conditionnement_piece_entiere;
                break;
            case "conditionnement_decoupe":
                self::$html_chapitre_conditionnement_decoupe = self::buildChapitreConditionnementDecoupe();
                $return = self::$html_chapitre_conditionnement_decoupe;
                break;
            case "codification":
                self::$html_chapitre_codification = self::buildChapitreCodification();
                $return = self::$html_chapitre_codification;
                break;
            case "codification_externe":
                self::$html_chapitre_codification_externe = self::buildChapitreCodificationExterne();
                $return = self::$html_chapitre_codification_externe;
                break;
            case "etiquette":
                self::$html_chapitre_etiquette = self::buildChapitreEtiquette();
                $return = self::$html_chapitre_etiquette;
                break;
            case "expedition":
                self::$html_chapitre_expedition = self::buildChapitreExpedition();
                $return = self::$html_chapitre_expedition;
                break;
            case "composition":
                self::$html_chapitre_composition = self::buildChapitreComposition();
                $return = self::$html_chapitre_composition;
                break;
            case "activation_des_produits":
                self::$html_chapitre_activation_des_produits = self::buildChapitreActivationDesProduits();
                $return = self::$html_chapitre_activation_des_produits;
                break;
            case "nomenclature":
                self::$html_chapitre_nomenclature = self::buildChapitreNomenclature();
                $return = self::$html_chapitre_nomenclature;
                break;
            case "commentaire":
                self::$html_chapitre_commentaire = self::buildChapitreCommentaire();
                $return = self::$html_chapitre_commentaire;
                break;
            case "palettisation":
                self::$html_chapitre_palettisation = self::buildChapitrePalettisation();
                $return = self::$html_chapitre_palettisation;
                break;
            case "dictionnaire_de_donnees":
                self::$html_chapitre_dictionnaire_de_donnees = self::buildChapitreDictionnaireDeDonnees();
                $return = self::$html_chapitre_dictionnaire_de_donnees;
                break;
            default:
            case "site_expedition":
                self::$html_chapitre_site_expedition = self::buildChapitreSiteExpedition();
                $return = self::$html_chapitre_site_expedition;
                break;
            default:
            case "site_production":
                self::$html_chapitre_site_production = self::buildChapitreSiteProduction();
                $return = self::$html_chapitre_site_production;
                break;
            default:
            case "exigence_client":
                self::$html_chapitre_exigence_client = self::buildChapitreExigenceClient();
                $return = self::$html_chapitre_exigence_client;
                break;
            default:
            case "etiquette_client":
                self::$html_chapitre_etiquette_client = self::buildChapitreEtiquetteClient();
                $return = self::$html_chapitre_etiquette_client;
                break;
            default:
            case "etiquette_client_FEAvecEtiq":
                self::$html_chapitre_etiquette_client_FEAvecEtiq = self::buildChapitreEtiquetteClient_FEAvecEtiq();
                $return = self::$html_chapitre_etiquette_client_FEAvecEtiq;
                break;
            default:
            case "etiquette_client_MDDAvecEtiq":
                self::$html_chapitre_etiquette_client_MDDAvecEtiq = self::buildChapitreEtiquetteClient_MDDAvecEtiq();
                $return = self::$html_chapitre_etiquette_client_MDDAvecEtiq;
                break;
            default:
            case "pcb":
                self::$html_chapitre_pcb = self::buildChapitrePcb();
                $return = self::$html_chapitre_pcb;
                break;
            default:
            case "emballage":
                self::$html_chapitre_emballage = self::buildChapitreEmballage();
                $return = self::$html_chapitre_emballage;
                break;
            default:
            case "emballage_colis":
                self::$html_chapitre_emballage_colis = self::buildChapitreEmballageDuColis();
                $return = self::$html_chapitre_emballage_colis;
                break;
            default:
            case "etiquette_r_d":
                self::$html_chapitre_etiquette_r_d = self::buildChapitreEtiquetteRD();
                $return = self::$html_chapitre_etiquette_r_d;
                break;
            default:
            case "etiquette_article":
                self::$html_chapitre_etiquette_article = self::buildChapitreEtiquetteArticle();
                $return = self::$html_chapitre_etiquette_article;
                break;
            default:
            case "etiquette_article_FEAvecEtiq":
                self::$html_chapitre_etiquette_article_FEAvecEtiq = self::buildChapitreEtiquetteArticle_FEAvecEtiq();
                $return = self::$html_chapitre_etiquette_article_FEAvecEtiq;
                break;
            default:
            case "etiquette_article_MDDAvecEtiq":
                self::$html_chapitre_etiquette_article_MDDAvecEtiq = self::buildChapitreEtiquetteArticle_MDDAvecEtiq();
                $return = self::$html_chapitre_etiquette_article_MDDAvecEtiq;
                break;
            default:
            case "etiquette_composant":
                self::$html_chapitre_etiquette_composant = self::buildChapitreEtiquetteComposant();
                $return = self::$html_chapitre_etiquette_composant;
                break;
            default:
            case "etiquette_composant_FEAvecEtiq":
                self::$html_chapitre_etiquette_composant_FEAvecEtiq = self::buildChapitreEtiquetteComposant_FEAvecEtiq();
                $return = self::$html_chapitre_etiquette_composant_FEAvecEtiq;
                break;
            default:
            case "etiquette_composant_MDDAvecEtiq":
                self::$html_chapitre_etiquette_composant_MDDAvecEtiq = self::buildChapitreEtiquetteComposant_MDDAvecEtiq();
                $return = self::$html_chapitre_etiquette_composant_MDDAvecEtiq;
                break;
            default:
            case "donnees_clients":
                self::$html_chapitre_donnees_clients_w1 = self::buildChapitreCommerce();
                $return = self::$html_chapitre_donnees_clients_w1;
                break;
            default:
            case "codification":
                self::$html_chapitre_codification_w1 = self::buildChapitreCodification();
                $return = self::$html_chapitre_codification_w1;
                break;
            default:
            case "duree_de_vie":
                self::$html_chapitre_duree_de_vie = self::buildChapitreDureeDeVie();
                $return = self::$html_chapitre_duree_de_vie;
                break;
            default:
        }
        return $return;
    }

    public static function buildChapitreIdentiteTraiteur() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $is_editable = self::$is_editable;

        $is_editable_false = false;

//        if ($is_editable) {
//            $bloc .= self::$html_submit_button;
//        }
//Classification
        $bloc .= ObjectFta::showClassification(
                        $id_fta, $id_version_dossier_fta = self::$objectFta->getFieldValue(
                        ObjectFta::TABLE_FTA_NAME, "id_version_dossier_fta"
                        ), $last_id_fta = self::$objectFta->getFieldValue(
                        ObjectFta::TABLE_FTA_NAME, "last_id_fta"
                        ), $FAMILLE_ARTICLE = self::$objectFta->getFieldValue(
                        ObjectFta::TABLE_ARTI_NAME, "FAMILLE_ARTICLE"
                        ), $FAMILLE_MKTG = self::$objectFta->getFieldValue(
                        ObjectFta::TABLE_ARTI_NAME, "FAMILLE_MKTG"
                        ), $id_access_familles_gammes = self::$objectFta->getFieldValue(
                        ObjectFta::TABLE_ARTI_NAME, "id_access_familles_gammes"
                        ), $is_editable, $synthese_action
        );

        //Type de FTA
        $htmlObject = new OldHtmlList(
                $data_field = self::$objectFta->getFieldDescription(
                ObjectFta::TABLE_FTA_NAME, "id_fta_categorie"
                ), $content_label_field = self::$objectFta->getFieldDescription(
                ObjectFta::TABLE_WORKFLOW_NAME, "nom_fta_categorie"
                ), $default_value = 1, $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResultSubForm();

        //Désignation Commerciale de l'Article
        $htmlObject = new htmlInputText(
                $field_name = "designation_commerciale_fta", $table_name = ObjectFta::TABLE_FTA_NAME, $value = self::$objectFta->getFieldValue($table_name, $field_name), $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name], $size = 110, $maxlength = 150
        );
        $bloc.=$htmlObject->getHtmlResult();

        //Poids élémentaire
        $htmlObject = new htmlInputKg(
                $field_name = "Poids_ELEM", $table_name = ObjectFta::TABLE_ARTI_NAME, $value = self::$objectFta->getFieldValue($table_name, $field_name), $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name], $size = 20, $maxlength = 150
        );
        $bloc.=$htmlObject->getHtmlResult();

        //PCB
        $htmlObject = new htmlInputText(
                $field_name = "NB_UNIT_ELEM", $table_name = ObjectFta::TABLE_ARTI_NAME, $value = self::$objectFta->getFieldValue($table_name, $field_name), $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

        //Durée de vie Garantie Client
        $htmlObject = new htmlInputNumber(
                $field_name = "Duree_de_vie", $table_name = ObjectFta::TABLE_ARTI_NAME, $value = self::$objectFta->getFieldValue($table_name, $field_name), $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

        //Créateur
        $htmlObject = new htmlInputText(
                $field_name = "createur_fta", $table_name = ObjectFta::TABLE_CREATEUR_NAME, $value = self::$objectFta->getFieldValue($table_name, "prenom") . " " . strtoupper(self::$objectFta->getFieldValue($table_name, "nom")), $is_editable_false, $warning_update = ${"diff_" . $table_name}[$field_name], $size = 110, $maxlength = 150
        );
        $bloc.=$htmlObject->getHtmlResult();

        //Date d'échéance de la FTA
        $htmlObject = new HtmlInputCalendar(
                $field_name = "date_echeance_fta", $table_name = ObjectFta::TABLE_FTA_NAME, $value = self::$objectFta->getFieldValue($table_name, $field_name), $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc .= $htmlObject->getHtmlResult();

        //Date d'échéance des processus
        $bloc .= ObjectFta::showDatesEcheanceProcessus(
                        $id_fta, $abreviation_fta_etat = self::$objectFta->getFieldValue(
                        ObjectFta::TABLE_ETAT_NAME, "abreviation_fta_etat"
                        ), $date_echeance_fta = self::$objectFta->getFieldValue(
                        ObjectFta::TABLE_FTA_NAME, "date_echeance_fta"
                        ), $is_editable
        );
        $bloc .= "</table>";
        return $bloc;
    }

    public static function buildChapitreIdentite() {
        return self::buildChapitreIdentiteVolaille();
    }

    public static function buildChapitreCommentaire() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;
        //$isEditable = TRUE;
        //
        //Identifiant FTA
        $idFta = $id_fta;
        $ftaModel = new FtaModel($idFta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);

        $bloc.="<tr class=titre_principal><td class>Commentaire</td></tr>";

        //Liste des corrections apportées
        $bloc.="<tr class=titre_principal><td>Récapitulatif des corrections</td></tr>";

        $bloc.=$ftaView->getHtmlCorrectionChapitre();

        //Liste de tous les commentaires des chapitres
        $bloc.="<tr class=titre_principal><td>Récapitulatif des commentaires</td></tr>";

        $bloc.=$ftaView->getHtmlCommentaireChapitre();

        //Historique des mises à jour de la FTA
        $bloc.="<tr class=titre_principal><td>Historique des actions effectuées sur le Fiche Technique Article</td></tr>";

        $bloc.=$ftaModel->getHtmlDataField(FtaModel::FIELDNAME_COMMENTAIRE_MAJ_FTA);

        return $bloc;
    }

    public static function buildChapitreCommerce() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;
        //$isEditable = TRUE;
        //
        //Identifiant FTA
        $idFta = $id_fta;
        $ftaModel = new FtaModel($idFta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);

        //Unité de Facturation
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_UNITE_FACTURATION);

        //Gencod EAN Article
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_EAN_COLIS);

        //Gencod EAN Colis
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_EAN_COLIS);

        //Gencod EAN Palette
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_EAN_PALETTE);
        return $bloc;
    }

    public static function buildChapitreComposition() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;
        //$isEditable = TRUE;
        //Identifiant FTA
        $idFta = $id_fta;
        $ftaModel = new FtaModel($idFta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);

        $bloc.="<tr class=titre_principal><td class>Composition</td></tr>";

        //Liste des composants
        $bloc.= $ftaView->getHtmlDataField(FtaModel::FIELDNAME_VIRTUAL_FTA_COMPOSANT);

        //Agrément CE
        $bloc.=$ftaView->getHtmlSiteAgrement();


        //Produit Transformé en France
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_PRODUIT_TRANSFORME);

        //Environnement de conservation
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ENVIRONNEMENT_CONSERVATION);


        //Conditionné sous atmosphère protectrice
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CONDITION_SOUS_ATMOSPHERE);


        //Logo éco-emballage
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LOGO_ECO_EMBALLAGE);

        //
        //Remarque
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_REMARQUE);

        //Origine des Matières Premières
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ORIGINE_MATIERE_PREMIERE);

        //Listes des Allergènes
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LISTE_ALLERGENE);

        //Conseil après ouverture
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CONSEIL_APRES_OUVERTURE);

        //Conseil de Réchauffage Validé
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CONSEIL_DE_RECHAUFFAGE);

        //Durée de vie Production (en jours)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION);

        //Durée de Vie Maximale (en jour)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_MAXIMALE);

        //Référence Externe
        //(N°Trace One, emplacement du fichier ...etc)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_REFERENCE_EXTERNES);

        //Code douane
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CODE_DOUANE_FTA);

        //Libellé du code douane:
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CODE_DOUANE_LIBELLE_FTA);


        return $bloc;
    }

    public static function buildChapitreProduction() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $is_editable = self::$is_editable;
        $is_editable_false = false;

        $bloc.="<tr class=titre_principal><td class>Demandeur</td></tr>";

        //$bloc .= "</table>";
        return $bloc;
    }

    public static function buildChapitreQualite() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $is_editable = self::$is_editable;
        $is_editable_false = false;

        $bloc.="<tr class=titre_principal><td class>Demandeur</td></tr>";

        //Durée de vie Garantie Client
        $htmlObject = new htmlInputNumber(
                $field_name = "Duree_de_vie", $table_name = ObjectFta::TABLE_ARTI_NAME, $value = self::$objectFta->getFieldValue($table_name, $field_name), $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

        //Durée de vie Production
        $htmlObject = new htmlInputNumber(
                $field_name = "duree_vie_technique_fta", $table_name = ObjectFta::TABLE_FTA_NAME, $value = self::$objectFta->getFieldValue($table_name, $field_name), $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

        //Liste des ingrédients
        $htmlObject = new HtmlTextArea(
                $field = "Composition", $table = ObjectFta::TABLE_ARTI_NAME, $value = self::$objectFta->getFieldValue($table, $field), $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc .= $htmlObject->getHtmlResult();


        //Température de conservation
//        $force_content_request = "SELECT id_annexe_environnement_conservation_groupe, CONCAT(nom_annexe_environnement_conservation_groupe, ': ', temperature_par_defaut_annexe_environnement_conservation_groupe)"
//                . "FROM annexe_environnement_conservation_groupe "
//                . "ORDER BY CONCAT(nom_annexe_environnement_conservation_groupe, temperature_par_defaut_annexe_environnement_conservation_groupe) ";


        $htmlObject = new OldHtmlList(
                $data_field = self::$objectFta->getFieldDescription(
                ObjectFta::TABLE_ARTI_NAME, "K_etat"
                ), $content_label_field = new DatabaseDescriptionField(
                $field_table = "annexe_environnement_conservation_groupe", $field_name = "temperature_par_defaut_annexe_environnement_conservation_groupe", $field_value = $data_field->getValue()
                ), $default_value = 1, $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();


        //$bloc .= "</table>";
        return $bloc;
    }

    public static function buildChapitreSiteExpedition() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;

        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);

        //Site d'expedition
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_SITE_EXPEDITION_FTA);

        return $bloc;
    }

    public static function buildChapitreSiteProduction() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;

        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);

        //Site d'assemblage
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_SITE_ASSEMBLAGE);

        return $bloc;
    }

    public static function buildChapitreExigenceClient() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;

        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);

        //Durée de vie garantie client (en jours)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DUREE_DE_VIE);

        return $bloc;
    }

    public static function buildChapitrePcb() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;

        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);

        //Poids net de l’UVF
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_POIDS_ELEMENTAIRE);

        //Nombre d’UVC par colis
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON);

        return $bloc;
    }

    public static function buildChapitreEmballage() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;
        $idChapitre = self::$id_fta_chapitre;
        AnnexeEmballageGroupeTypeModel::initEmballage($id_fta);

        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);

        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DESCRIPTION_EMBALLAGE);

        //Emballages par UVC
        $bloc.="<tr class=titre_principal><td class>Emballages par UVC</td></tr>";
        $bloc.=$ftaView->getHtmlEmballageUVC($id_fta, $idChapitre, $synthese_action, self::$comeback, self::$id_fta_etat, self::$abrevation_etat, self::$id_fta_role);

        //Emballages par Colis
        $bloc.="<tr class=titre_principal><td class>Emballages par Colis</td></tr>";
        $bloc.=$ftaView->getHtmlEmballageParColis($id_fta, $idChapitre, $synthese_action, self::$comeback, self::$id_fta_etat, self::$abrevation_etat, self::$id_fta_role);

        //Palette
        $bloc.="<tr class=titre_principal><td class>Emballages Palette</td></tr>";
        $bloc.=$ftaView->getHtmlEmballagePalette($id_fta, $idChapitre, $synthese_action, self::$comeback, self::$id_fta_etat, self::$abrevation_etat, self::$id_fta_role);

        return $bloc;
    }

    public static function buildChapitreEmballageDuColis() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;
        $idChapitre = self::$id_fta_chapitre;
        AnnexeEmballageGroupeTypeModel::initEmballage($id_fta);


        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);

        //Emballages du Colis
        $bloc.="<tr class=titre_principal><td class>Emballages du Colis</td></tr>";
        $bloc.=$ftaView->getHtmlEmballageDuColis($id_fta, $idChapitre, $synthese_action, self::$comeback, self::$id_fta_etat, self::$abrevation_etat, self::$id_fta_role);

        return $bloc;
    }

    public static function buildChapitreEtiquetteClient() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;

        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);


        //Libellé du code article chez le client
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE_CODE_ARTICLE_CLIENT);


        //Valeur du code article chez le client
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CODE_ARTICLE_CLIENT);

        //PVC de l'article:
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_PVC_ARTICLE);

        //Nombre de portion
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_NOMBRE_PORTION_FTA);

        //Service consommateur
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_SERVICE_CONSOMMATEUR);

        //Produit Transformé en France
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_PRODUIT_TRANSFORME);

        //Logo éco-emballage
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LOGO_ECO_EMBALLAGE);


        $bloc.="<tr> <td>Logo spécifique étiquette manquant choix possible en dessous ?</td></tr>";

        //Libellé etiquette carton:
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE_CLIENT);

        //Modèle d'étiquette
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ETIQUETTE_CODESOFT);



        return $bloc;
    }

    public static function buildChapitreEtiquetteClient_FEAvecEtiq() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;

        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);


        //Libellé du code article chez le client
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE_CODE_ARTICLE_CLIENT);


        //Valeur du code article chez le client
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CODE_ARTICLE_CLIENT);

        //Prix de ventes consommateur
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_PVC_ARTICLE);

        //Nombre de portion
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_NOMBRE_PORTION_FTA);

        //Service consommateur
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_SERVICE_CONSOMMATEUR);

        //Produit Transformé en France
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_PRODUIT_TRANSFORME);

        //Logo éco-emballage
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LOGO_ECO_EMBALLAGE);


        $bloc.="<tr> <td>Logo spécifique étiquette manquant choix possible en dessous ?</td></tr>";

        //Libellé etiquette carton:
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE_CLIENT);

        //Modèle d'étiquette
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ETIQUETTE_CODESOFT);


        $bloc.="<tr> <td>Masque étiquette UVC recto</td></tr>";


        $bloc.="<tr> <td>Masque étiquette UVC verso</td></tr>";


        $bloc.="<tr> <td>Masque colis</td></tr>";


        return $bloc;
    }

    public static function buildChapitreEtiquetteClient_MDDAvecEtiq() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;

        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);

        //Service consommateur
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_SERVICE_CONSOMMATEUR);

        //Produit Transformé en France
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_PRODUIT_TRANSFORME);


        //Logo éco-emballage
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LOGO_ECO_EMBALLAGE);

        $bloc.="<tr> <td>Logo spécifique étiquette manquant choix possible en dessous ?</td></tr>";

        //Libellé etiquette carton:
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE_CLIENT);

        //Modèle d'étiquette
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ETIQUETTE_CODESOFT);

        //Libellé du code article chez le client
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE_CODE_ARTICLE_CLIENT);


        $bloc.="<tr> <td>Masque étiquette UVC recto</td></tr>";


        $bloc.="<tr> <td>Masque colis</td></tr>";

        return $bloc;
    }

    public static function buildChapitreEtiquetteRD() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;

        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);

        //Conseil de Réchauffage Validé
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CONSEIL_DE_RECHAUFFAGE);

        return $bloc;
    }

    public static function buildChapitreEtiquetteArticle() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;

        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);


        //Origine des Matières Premières
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ORIGINE_MATIERE_PREMIERE);

        //Listes des Allergènes
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LISTE_ALLERGENE);

        //Conseil après ouverture
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CONSEIL_APRES_OUVERTURE);

        //Conditionné sous atmosphère protectrice
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CONDITION_SOUS_ATMOSPHERE);

        return $bloc;
    }

    public static function buildChapitreEtiquetteArticle_MDDAvecEtiq() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;

        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);


        //Origine des Matières Premières
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ORIGINE_MATIERE_PREMIERE);

        //Listes des Allergènes
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LISTE_ALLERGENE);

        //Conseil après ouverture
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CONSEIL_APRES_OUVERTURE);

        //Forcer libellé étiquette colis
        $bloc.="<tr> <td>Forcer libellé étiquette colis ?</td></tr>";

        //Conditionné sous atmosphère protectrice
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CONDITION_SOUS_ATMOSPHERE);

        return $bloc;
    }

    public static function buildChapitreEtiquetteArticle_FEAvecEtiq() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;

        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);


        //Origine des Matières Premières
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ORIGINE_MATIERE_PREMIERE);

        //Listes des Allergènes
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LISTE_ALLERGENE);

        //Conseil après ouverture
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CONSEIL_APRES_OUVERTURE);

        //Conditionné sous atmosphère protectrice
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CONDITION_SOUS_ATMOSPHERE);

        return $bloc;
    }

    public static function buildChapitreEtiquetteComposant() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;

        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);


        $bloc.="<tr> <td>Lequelle choisir  pour la durré de vie ?</td></tr>";

        //Durée de vie Production (en jours)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION);

        //Durée de Vie Maximale (en jour)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_MAXIMALE);

        $bloc.="<tr> <td>Poids net étiqueté</td></tr>";

        $bloc.="<tr> <td>Quantité par colis</td></tr>";

        $bloc.="<tr> <td>Dénomination commerciale de ventes</td></tr>";

        $bloc.="<tr> <td>Dénomination légale de ventes</td></tr>";

        //Composition Etiquette (1er paragraphe)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_COMPOSITION1);

        //Composition Etiquette (2nd paragraphe)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_COMPOSITION2);


        //Information complémentaire recto
        $bloc.="<tr> <td>Information complémentaire recto ? Possible choix remarque ?</td></tr>";
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_REMARQUE);

        $bloc.="<tr> <td>Décomposition du poids</td></tr>";

        $bloc.="<tr> <td>Taille des ingrédients</td></tr>";

        $bloc.="<tr> <td>Valeurs nutrionnelles</td></tr>";

        return $bloc;
    }

    public static function buildChapitreEtiquetteComposant_FEAvecEtiq() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;

        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);


        $bloc.="<tr> <td>Lequelle choisir  pour la durré de vie ?</td></tr>";

        //Durée de vie Production (en jours)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION);

        //Durée de Vie Maximale (en jour)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_MAXIMALE);

        $bloc.="<tr> <td>Poids net étiqueté</td></tr>";

        $bloc.="<tr> <td>Quantité par colis</td></tr>";

        $bloc.="<tr> <td>Dénomination commerciale de ventes</td></tr>";

        $bloc.="<tr> <td>Dénomination légale de ventes</td></tr>";

        //Composition Etiquette (1er paragraphe)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_COMPOSITION1);

        //Composition Etiquette (2nd paragraphe)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_COMPOSITION2);


        //Information complémentaire recto
        $bloc.="<tr> <td>Information complémentaire recto ? Possible choix remarque ?</td></tr>";
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_REMARQUE);

        $bloc.="<tr> <td>Décomposition du poids</td></tr>";

        $bloc.="<tr> <td>Taille des ingrédients</td></tr>";

        $bloc.="<tr> <td>Valeurs nutrionnelles</td></tr>";

        return $bloc;
    }

    public static function buildChapitreEtiquetteComposant_MDDAvecEtiq() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;

        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);


        $bloc.="<tr> <td>Lequelle choisir  pour la durré de vie ?</td></tr>";

        //Durée de vie Production (en jours)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION);

        //Durée de Vie Maximale (en jour)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_MAXIMALE);

        $bloc.="<tr> <td>Poids net étiqueté</td></tr>";

        $bloc.="<tr> <td>Quantité par colis</td></tr>";

        $bloc.="<tr> <td>Dénomination commerciale de ventes</td></tr>";

        $bloc.="<tr> <td>Dénomination légale de ventes</td></tr>";

        //Composition Etiquette (1er paragraphe)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_COMPOSITION1);

        //Composition Etiquette (2nd paragraphe)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_COMPOSITION2);


        //Information complémentaire recto
        $bloc.="<tr> <td>Information complémentaire recto ? Possible choix remarque ?</td></tr>";
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_REMARQUE);

        $bloc.="<tr> <td>Décomposition du poids</td></tr>";

        $bloc.="<tr> <td>Taille des ingrédients</td></tr>";

        $bloc.="<tr> <td>Valeurs nutrionnelles</td></tr>";

        return $bloc;
    }

    public static function buildChapitreDecoupe() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $is_editable = self::$is_editable;
        $is_editable_false = false;

        $bloc.="<tr class=titre_principal><td class>Demandeur</td></tr>";

        //Nom du demandeur
        $htmlObject = new htmlInputText(
                $field_name = "type_minerai", $table_name = ObjectFta::TABLE_FTA_NAME, $value = self::$objectFta->getFieldValue($table_name, $field_name), $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

        //Besoin de la fiche technique ?
        $htmlObject = new HtmlListBoolean(
                $data_field = self::$objectFta->getFieldDescription(
                ObjectFta::TABLE_FTA_NAME, "bon_fabrication_atelier"), $default_value = HtmlListBoolean::NO_VALUE, $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

        //Calibre
        $htmlObject = new OldHtmlList(
                $data_field = self::$objectFta->getFieldDescription(
                ObjectFta::TABLE_FTA_NAME, "id_arcadia_type_calibre"
                ), $content_label_field = new DatabaseDescriptionField(
                $field_table = "arcadia_type_calibre", $field_name = "nom_arcadia_type_calibre", $field_value = $data_field->getValue()
                ), $default_value = 1, $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

        //Nom du demandeur
        $htmlObject = new htmlInputText(
                $field_name = "calibre_defaut", $table_name = ObjectFta::TABLE_FTA_NAME, $value = self::$objectFta->getFieldValue($table_name, $field_name), $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

        //Besoin de la fiche technique ?
        $htmlObject = new HtmlListBoolean(
                $data_field = self::$objectFta->getFieldDescription(
                ObjectFta::TABLE_FTA_NAME, "besoin_fiche_rendement"), $default_value = HtmlListBoolean::NO_VALUE, $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

        //$bloc .= "</table>";
        return $bloc;
    }

    public static function buildChapitreDictionnaireDeDonnees() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;
        //$isEditable = TRUE;
        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);

        $bloc.="<tr class=titre_principal><td class>Activation des Produits</td></tr>";

        //Codification
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA);

        $bloc.="<tr class=titre_principal><td class>Logistique</td></tr>";

        //Site d'assemblage
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_SITE_ASSEMBLAGE);

        //Site d'expedition
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_SITE_EXPEDITION_FTA);

        //Code Douane 
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CODE_DOUANE_FTA);

        $bloc.="<tr class=titre_principal><td class>Palettisasion</td></tr>";

        $bloc.="<tr class=titre_principal><td class>Informations Générales de l'UVC</td></tr>";

        $bloc.=$ftaView->getHtmlPoidsEmballageUVC();

        //Poids Net UVC (en g):
        $bloc.=$ftaView->getHtmlPoidsNetEmballageUVC();

        //Poids Brut UVC (en g):

        $bloc.=$ftaView->getHtmlPoidsBrutEmballageUVC();

        //Dimension de l'UVC (en mm):

        $bloc.=$ftaView->getHtmlDimensionEmballageUVC();

        $bloc.="<tr class=titre_principal> <td>Informations Générales du Colis</td></tr>";

        //Nombre d'UVC du colis:

        $bloc.=$ftaView->getHtmlNombreColisUVC();


        //Poids des Emballages du Colis (en g):

        $bloc.=$ftaView->getHtmlPoidsColisUVC();


        //Poids Net (en Kg) du Colis:

        $bloc.=$ftaView->getHtmlPoidsNetColisUVC();


        //Poids Brut (en Kg) du Colis:

        $bloc.=$ftaView->getHtmlPoidsBrutColisUVC();

        //Hauteur (en mm) du Colis

        $bloc.=$ftaView->getHtmlHauteurColisUVC();

        $bloc.="<tr class=titre_principal> <td>Informations Générales d'une Palette</td></tr>";

        //Poids Net (en Kg) d'une Palette:

        $bloc.=$ftaView->getHtmlPoidsNetPaletteUVC();

        //Poids Brut (en Kg) d'une Palette:

        $bloc.=$ftaView->getHtmlPoidsBrutPaletteUVC();


        //Hauteur (en m) d'une Palette:

        $bloc.=$ftaView->getHtmlHauteurPaletteUVC();


        //Nombre de couche par palette:

        $bloc.=$ftaView->getHtmlNombrePaletteUVC();


        //Nombre de colis par couche:

        $bloc.=$ftaView->getHtmlColisCouchePaletteUVC();

        //Nombre total de Carton par palette:

        $bloc.=$ftaView->getHtmlColisTotalUVC();

        $bloc.="<tr class=titre_principal><td class>Composition</td></tr>";

        //Agrément CE
        $bloc.=$ftaView->getHtmlSiteAgrement();

        //Produit Transformé en France
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_PRODUIT_TRANSFORME);

        //Environnement de conservation
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ENVIRONNEMENT_CONSERVATION);


        //Conditionné sous atmosphère protectrice
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CONDITION_SOUS_ATMOSPHERE);


        //Logo éco-emballage
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LOGO_ECO_EMBALLAGE);

        //
        //Remarque
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_REMARQUE);

        //Origine des Matières Premières
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ORIGINE_MATIERE_PREMIERE);

        //Listes des Allergènes
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LISTE_ALLERGENE);

        //Conseil après ouverture
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CONSEIL_APRES_OUVERTURE);

        //Conseil de Réchauffage Validé
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CONSEIL_DE_RECHAUFFAGE);

        //Durée de vie Production (en jours)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_PRODUCTION);

        //Code douane
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CODE_DOUANE_FTA);

        $bloc.="<tr class=titre_principal><td class>Codification Standard Externe</td></tr><tr><td>";

        //Gencod EAN Article
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_EAN_COLIS);

        //Gencod EAN Colis
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_EAN_COLIS);

        //Gencod EAN Palette
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_EAN_PALETTE);

        $bloc.="<tr class=titre_principal><td class>Codification</td></tr>";

        //Unité de Poids d'affichage:
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_UNITE_AFFICHAGE);

        //Désignation Abrégée
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_NOM_ABREGE);

        //Désignation Interne Agis
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE);

        //Désignation Etiquette
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE_CLIENT);

        //Code Article LDC
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC);


        $bloc.="<tr class=titre_principal><td class>Etiquettes</td></tr>";

        $bloc.="<tr class=titre_principal><td class>Gestion des étiquettes</td></tr>";


        //Activer le système d'impression Base Etiquette Codesoft
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ACTIVATION_CODESOFT);

        $bloc.="<tr class=titre_principal><td class>Etiquettes Colis</td></tr>";

        //Laisser l'informatique gérer la désignation ?:
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_VERROUILLAGE_LIBELLE_ETIQUETTE);

        //Libellé etiquette carton:
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE_CLIENT);

        //Modèle d'étiquette
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ETIQUETTE_CODESOFT);

        $bloc.="<tr class=titre_principal><td class>Etiquettes Composition</td></tr>";

        //Composition Etiquette (1er paragraphe)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_COMPOSITION1);

        //Composition Etiquette (2nd paragraphe)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_COMPOSITION2);

        //Libellé Code Douane 
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE_MULTILANGUE);

        $bloc.="<tr class=titre_principal><td class>Identité</td></tr>";

        $bloc.="<tr class=titre_principal><td class>Demandeur</td></tr>";

        //Nom du demandeur
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_NOM_DEMANDEUR);

        //Société du demandeur
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_SOCIETE_DEMANDEUR);

        //Date de la demande
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DATE_DEMANDEUR);

        //Echéance du demandeur
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ECHEANCE_DEMANDEUR);

        $bloc.="<tr class=titre_principal><td class>Classification</td></tr>";

        //Nom du client du demandeur
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_NOM_CLIENT_DEMANDEUR);

        //Circuit du client
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CIRCUIT_CLIENT);

        //Réseau du client
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_RESEAU_CLIENT);


        //Segment du client
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_SEGMENT_CLIENT);

        $bloc.="<tr class=titre_principal><td class>Estimations</td></tr>";


        //Quantité estimée en poids ou pièce par semaine
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_QUANTITE_HEBDOMADAIRE_ESTIMEE_COMMANDE);

        //Fréquence estimée de commande par semaine
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_FREQUENCE_HEBDOMADAIRE_ESTIMEE_COMMANDE);


        $bloc.="<tr class=titre_principal><td class>Caractéristiques générales du produit</td></tr>";

        //Désignation commerciale
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE);

        //Environnement de conservation
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ENVIRONNEMENT_CONSERVATION_GROUPE);

        //Type d'emballage

        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ARCADIA_EMBALLAGE_TYPE);

        //Unité de facturation et Poids élémentaire
        $bloc.=$ftaView->getHtmlUniteFacturationWithPoidsElementaire();



        /*
         * todo manque la correction du PCB
         */

        $bloc.="<tr class=titre_principal><td class>Caractéristiques FTA</td></tr>";

        //Créateur
        $bloc.=$ftaView->getHtmlCreateurFta();

        //Catégorie de FTA
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_WORKFLOW);

        //Besoin de la fiche technique ?
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_BESOIN_FICHE_TECHNIQUE);

        //Etude de prix ?
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ETUDE_PRIX_FTA);

        //Calibre par défaut
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CALIBRE_DEFAUT);

        $bloc.="<tr class=titre_principal><td class>Echéances</td></tr>";

        //Date d'échéance des processus
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_VIRTUAL_FTA_PROCESSUS_DELAI);


        $bloc.="<tr class=titre_principal><td class>Commerce</td></tr>";

        /**
         * @todo Non implementé
         */
        //Remise sur factures
        //"fta_tarif", "conditions_commerciales_fta_tarif"
        $bloc.="<tr> <td>Remise sur factures</td><td> not implement(sous table)</td></tr>";

        //Libellé du code article chez le client
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE_CODE_ARTICLE_CLIENT);

        //Valeur du code article chez le client
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CODE_ARTICLE_CLIENT);

        //PVC de l'article:
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_PVC_ARTICLE);

        //Prix / KG
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_PVC_ARTICLE_KG);

        //Durée de vie garantie client (en jours)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DUREE_DE_VIE);

        //Nombre de portion
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_NOMBRE_PORTION_FTA);

        //Service consommateur
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_SERVICE_CONSOMMATEUR);

        return $bloc;
    }

    public static function buildChapitreConditionnementPieceEntiere() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $is_editable = self::$is_editable;
        $is_editable_false = false;

        $bloc.="<tr class=titre_principal><td class>Demandeur</td></tr>";

        //Poste
        $htmlObject = new OldHtmlList(
                $data_field = self::$objectFta->getFieldDescription(
                ObjectFta::TABLE_FTA_NAME, "id_arcadia_poste"
                ), $content_label_field = new DatabaseDescriptionField(
                $field_table = "arcadia_poste", $field_name = "nom_arcadia_poste", $field_value = $data_field->getValue()
                ), $default_value = 1, $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResultSubForm();

        //Atelier
        $htmlObject = new OldHtmlList(
                $data_field = self::$objectFta->getFieldDescription(
                ObjectFta::TABLE_FTA_NAME, "id_arcadia_atelier"
                ), $content_label_field = new DatabaseDescriptionField(
                $field_table = "arcadia_atelier", $field_name = "nom_arcadia_atelier", $field_value = $data_field->getValue()
                ), $default_value = 1, $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResultSubForm();

        //Machine
        $htmlObject = new htmlInputText(
                $field_name = "nom_machine_fta", $table_name = ObjectFta::TABLE_FTA_NAME, $value = self::$objectFta->getFieldValue($table_name, $field_name), $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

        //Tare
        $htmlObject = new htmlInputKg(
                $field_name = "tare_fta", $table_name = ObjectFta::TABLE_FTA_NAME, $value = self::$objectFta->getFieldValue($table_name, $field_name), $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name], $size = 20, $maxlength = 150
        );
        $bloc.=$htmlObject->getHtmlResult();

        //Besoin de la fiche productivité ?
        $htmlObject = new HtmlListBoolean(
                $data_field = self::$objectFta->getFieldDescription(
                ObjectFta::TABLE_FTA_NAME, "besoin_fiche_productivite_fta"), $default_value = HtmlListBoolean::NO_VALUE, $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

        //perte_matiere_fta
        $htmlObject = new HtmlListBoolean(
                $data_field = self::$objectFta->getFieldDescription(
                ObjectFta::TABLE_FTA_NAME, "perte_matiere_fta"), $default_value = HtmlListBoolean::NO_VALUE, $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

        //Longueur
        $htmlObject = new htmlInputText(
                $field_name = "longueur_dimension_fta", $table_name = ObjectFta::TABLE_FTA_NAME, $value = self::$objectFta->getFieldValue($table_name, $field_name), $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

        //Largeur
        $htmlObject = new htmlInputText(
                $field_name = "largeur_dimension_fta", $table_name = ObjectFta::TABLE_FTA_NAME, $value = self::$objectFta->getFieldValue($table_name, $field_name), $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

        //Hauteur
        $htmlObject = new htmlInputText(
                $field_name = "hauteur_dimension_fta", $table_name = ObjectFta::TABLE_FTA_NAME, $value = self::$objectFta->getFieldValue($table_name, $field_name), $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

        //$bloc .= "</table>";
        return $bloc;
    }

    public static function buildChapitreConditionnementDecoupe() {

        $bloc = self::buildChapitreConditionnementPieceEntiere();
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $is_editable = self::$is_editable;
        $is_editable_false = false;

        //$bloc.="<tr class=titre_principal><td class>Demandeur</td></tr>";
        //Type Marinade
        $htmlObject = new htmlInputText(
                $field_name = "type_marinade_fta", $table_name = ObjectFta::TABLE_FTA_NAME, $value = self::$objectFta->getFieldValue($table_name, $field_name), $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

        //$bloc .= "</table>";
        return $bloc;
    }

    public static function buildChapitreActivationDesProduits() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;
        //$isEditable = TRUE;
        //
        //Identifiant FTA
        $idFta = $id_fta;
        $ftaModel = new FtaModel($idFta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);

        $bloc.="<tr class=titre_principal><td class>Activation des Produits</td></tr>";

        //Codification
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_SUFFIXE_AGROLOGIC_FTA);

        //Code Produit Agrologic
        //  $bloc.=$ftaView->getHtmlDataField(FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE);

        $bloc.="<tr> <td>Code Produit Agrologic</td><td> not implement(sous table)</td></tr>";

        //Désignation (Format DIN)
        //   $bloc.=$ftaView->getHtmlDataField(FtaComposantModel::FIELDNAME_DESIGNATION_CODIFICATION);

        $bloc.="<tr> <td>Désignation (Format DIN)</td><td> not implement(sous table)</td></tr>";

        //Site de Production
        //  $bloc.=$ftaView->getHtmlDataField(FtaComposantModel::FIELDNAME_SITE_PRODUCTION_FTA_CODIFICATION);

        $bloc.="<tr> <td>Site de Production</td><td> not implement(sous table)</td></tr>";

        //Environnement de conservation
        //  $bloc.=$ftaView->getHtmlDataField(FtaComposantModel::FIELDNAME_ETAT_FTA_CODIFICATION);

        $bloc.="<tr> <td>Environnement de conservation</td><td> not implement(sous table)</td></tr>";

        //Recap Mail

        $bloc.="<tr> <td>Recap Mail</td><td> not implement(sous table)</td></tr>";

        return $bloc;
    }

    public static function buildChapitreCodification() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;
        //$isEditable = TRUE;
        //
        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);

        $bloc.="<tr class=titre_principal><td class>Codification</td></tr>";

        //Désignation Interne Agis
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE);

        //Code Article LDC, code arcadia
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CODE_ARTICLE_LDC);

        return $bloc;
    }

    public static function buildChapitreDureeDeVie() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;
        //$isEditable = TRUE;
        //
        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);


        //Durée de vie totale
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DUREE_DE_VIE_TECHNIQUE_MAXIMALE);

        return $bloc;
    }

    public static function buildChapitreCodificationExterne() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;
        //$isEditable = FALSE;
        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);

        $bloc.="<tr class=titre_principal><td class>Codification Standard Externe</td></tr><tr><td>";

        //Gencod EAN Article
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_EAN_COLIS);

        //Gencod EAN Colis
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_EAN_COLIS);

        //Gencod EAN Palette
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_EAN_PALETTE);

        return $bloc;
    }

    public static function buildChapitreExpedition() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;
        //$isEditable = TRUE;

        $bloc.="<tr class=titre_principal><td class>Logistique</td></tr>";

        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);

        //Site d'assemblage
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_SITE_ASSEMBLAGE);

        //Site d'expedition
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_SITE_EXPEDITION_FTA);


        //CNUD PREPARER PAR
        $bloc.=$ftaView->getHtmlCNUDPreparerPar();

        //Code Douane 
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CODE_DOUANE_FTA);

        //Libellé Code Douane 
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CODE_DOUANE_LIBELLE_FTA);


        return $bloc;
    }

    public static function buildChapitreEtiquette() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;
        //$isEditable = TRUE;
        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);

        $bloc.="<tr class=titre_principal><td class>Etiquettes</td></tr>";

        $bloc.="<tr class=titre_principal><td class>Gestion des étiquettes</td></tr>";


        //Activer le système d'impression Base Etiquette Codesoft
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ACTIVATION_CODESOFT);

        $bloc.="<tr class=titre_principal><td class>Etiquettes Colis</td></tr>";

        //Laisser l'informatique gérer la désignation ?:
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_VERROUILLAGE_LIBELLE_ETIQUETTE);

        //Libellé etiquette carton:
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE_CLIENT);

        //Modèle d'étiquette
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ETIQUETTE_CODESOFT);

        $bloc.="<tr class=titre_principal><td class>Etiquettes Composition</td></tr>";

        //Composition Etiquette (1er paragraphe)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_COMPOSITION1);

        //Composition Etiquette (2nd paragraphe)
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_COMPOSITION2);

        //Libellé Code Douane 
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_LIBELLE_MULTILANGUE);


        return $bloc;
    }

    private static function buildChapitreTemplate() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $is_editable = self::$is_editable;
        $is_editable_false = false;

        $bloc.="<tr class=titre_principal><td class>Demandeur</td></tr>";

        //$bloc .= "</table>";
        return $bloc;
    }

    public static function buildChapitreIdentiteVolaille() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;


        //$objectFta = new ObjectFta($id_fta);
        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);


        $bloc.="<tr class=titre_principal><td class>Classification</td></tr>";

        /*
         * @todo Ajax : n'affiche pas les valeurs de la liste déroulante
         */

        //Propriétaire
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CLASSIFICATION_PROPRIETAIRE);

        //Marque
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CLASSIFICATION_MARQUE);

        //Activité
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CLASSIFICATION_ACTIVITE);

        //Rayon
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CLASSIFICATION_RAYON);

        //Reseau
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CLASSIFICATION_RESEAU);

        //Environnement
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CLASSIFICATION_ENVIRONNEMENT);

        //Saisonnalité
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CLASSIFICATION_SAISONNALITE);


        $bloc.="<tr class=titre_principal><td class>Caractéristiques générales du produit</td></tr>";

        //Désignation commerciale
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE);


        $bloc.="<tr class=titre_principal><td class>Caractéristiques FTA</td></tr>";

        //Créateur
        $bloc.=$ftaView->getHtmlCreateurFta();

        //Workflow de FTA
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_WORKFLOW);

        //Date d'échéance des processus
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_VIRTUAL_FTA_PROCESSUS_DELAI);
        /**        */
        return $bloc;
    }

    public static function buildChapitreNomenclature() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;
        //$isEditable = TRUE;
        //
        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);

        $bloc.="<tr class=titre_principal><td class>Nomenclature</td></tr>";

        /**
         * @todo Non implementé
         */
        //Codification /Désignation /Poids Unitaire /Unité du poids /Site de Production	/Carton Vrac
        $bloc.="<tr> <td>Codification | Désignation | Poids Unitaire | Unité du poids | Site de Production | Carton Vrac</td><td> not implement(sous table)</td></tr>";

        //Description technique interne
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DESCRIPTION_TECHNIQUE_INTERNE);


        //Conseil de Réchauffage de développement
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CONSEIL_DE_RECHAUFFAGE_DEVELOPPEMENT);


        //Date prévisionnelle du transfert Industriel
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_DATE_PREVISONNELLE_TRANSFERT_INDUSTRIEL);


        return $bloc;
    }

    public static function buildChapitrePalettisation() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $isEditable = self::$is_editable;


        //Identifiant FTA
        $ftaModel = new FtaModel($id_fta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);

        $bloc.="<tr class=titre_principal><td class>Palettisasion</td></tr>";

        $bloc.="<tr class=titre_principal><td class>Informations Générales de l'UVC</td></tr>";

        $bloc.=$ftaView->getHtmlPoidsEmballageUVC();

        //Poids Net UVC (en g):
        $bloc.=$ftaView->getHtmlPoidsNetEmballageUVC();

        //Poids Brut UVC (en g):

        $bloc.=$ftaView->getHtmlPoidsBrutEmballageUVC();

        //Dimension de l'UVC (en mm):

        $bloc.=$ftaView->getHtmlDimensionEmballageUVC();

        $bloc.="<tr class=titre_principal> <td>Informations Générales du Colis</td></tr>";

        //Nombre d'UVC du colis:

        $bloc.=$ftaView->getHtmlNombreColisUVC();


        //Poids des Emballages du Colis (en g):

        $bloc.=$ftaView->getHtmlPoidsColisUVC();


        //Poids Net (en Kg) du Colis:

        $bloc.=$ftaView->getHtmlPoidsNetColisUVC();


        //Poids Brut (en Kg) du Colis:

        $bloc.=$ftaView->getHtmlPoidsBrutColisUVC();

        //Hauteur (en mm) du Colis

        $bloc.=$ftaView->getHtmlHauteurColisUVC();

        $bloc.="<tr class=titre_principal> <td>Informations Générales d'une Palette</td></tr>";

        //Poids Net (en Kg) d'une Palette:

        $bloc.=$ftaView->getHtmlPoidsNetPaletteUVC();

        //Poids Brut (en Kg) d'une Palette:

        $bloc.=$ftaView->getHtmlPoidsBrutPaletteUVC();


        //Hauteur (en m) d'une Palette:

        $bloc.=$ftaView->getHtmlHauteurPaletteUVC();


        //Nombre de couche par palette:

        $bloc.=$ftaView->getHtmlNombrePaletteUVC();


        //Nombre de colis par couche:

        $bloc.=$ftaView->getHtmlColisCouchePaletteUVC();

        //Nombre total de Carton par palette:

        $bloc.=$ftaView->getHtmlColisTotalUVC();


        return $bloc;
    }

    public static function buildSuiviDossier() {

        $isEditable = self::$is_editable;
        $idFta = self::$id_fta;
        $ftaModel = new FtaModel($idFta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::$id_fta_chapitre);
        $id_fta_chapitre = self::$id_fta_chapitre;
//        if (self::$id_fta_processus == NULL) {
//            self::$id_fta_processus = 0;
//        }
        $id_fta_processus = self::$id_fta_processus;
        $is_editable = self::$is_editable;
        $taux_validation_processus = self::$taux_validation_processus;
        $proprietaire = $is_editable;
        self::$objectFta->loadCurrentSuiviProjectByChapter($id_fta_chapitre);
        $bloc_suivi = "";

        //Si le chapitre en cours n'est pas public
        $bloc_suivi .= "<" . Html::DEFAULT_HTML_TABLE_CONTENU . ">"
                . "<tr class=titre_principal><td class>"
                . "Suivi de dossier"
                . "</td></tr><tr><td><" . Html::DEFAULT_HTML_TABLE_CONTENU . ">"
        ;
        if ($id_fta_processus <> FtaProcessusModel::PROCESSUS_PUBLIC) {

            //Commentaire sur le Chapitre
            //$bloc_suivi .= $ftaView->getHtmlCommentaireChapitre();
            $bloc_suivi .= $ftaView->getFtaSuiviProjetModel()->getHtmlDataField(FtaSuiviprojetmodel::FIELDNAME_COMMENTAIRE_SUIVI_PROJET);
            if (!$value) {
                $value = date("Y-m-d");
            }
        }
        $bloc_suivi.="</td></tr>";

        //Date d'échéance
        $champ = "date_echeance_processus";
        //$id_fta_processus = $id_fta_processus_encours;
        $req = "SELECT date_echeance_processus "
                . "FROM fta_processus_delai "
                . "WHERE id_fta='" . self::$objectFta->getIdFta() . "' AND id_fta_processus='" . $id_fta_processus . "' "
        ;
        $result = DatabaseOperation::query($req);
        if (mysql_num_rows($result)) {
            $$champ = mysql_result($result, 0, "date_echeance_processus");
        }
        if ($proprietaire and ( $$champ < date("Y-m-d"))) {
            $bgcolor = "class=couleur_rouge";
            $blod = "<b>";
            $blod_end = "</b>";
        } else {
            $bgcolor = "";
            $blod = "";
            $blod_end = "";
        }
        $bloc_suivi .= "<tr class=contenu><td>" . DatabaseDescription::getFieldDocLabel("fta_processus_delai", $champ) . "</td><td $bgcolor>";
        //$bloc_suivi .="$blod ${$champ} $blod_end";
        $bloc_suivi .="$blod " . $ftaModel->getEcheanceByIdProcessus($id_fta_processus) . " $blod_end";
        $bloc_suivi .="<input type=hidden name=$champ value=${$champ}>";
        $bloc_suivi.="</td></tr>";

        //$bloc_suivi .= $ftaView->getFtaSuiviProjetModel()->getDataField(FtaSuiviprojetmodel::FIELDNAME_DATE_VALIDATION_SUIVI_PROJET)->getFieldValue();
        $bloc_suivi .= $ftaView->getFtaSuiviProjetModel()->getHtmlDataField(FtaSuiviprojetmodel::FIELDNAME_DATE_VALIDATION_SUIVI_PROJET);

//        $htmlObject = new HtmlInputCalendar(
//                $field_name = "date_validation_suivi_projet", $table_name = "fta_suivi_projet", $value = self::$objectFta->getFieldValue($table_name, $field_name), $is_editable_false, $warning_update = ${"diff_" . $table_name}[$field_name]
//        );
//        $bloc_suivi .= $htmlObject->getHtmlResult();
//Date de validation
//        $champ = "date_validation_suivi_projet";
//        $bloc_suivi .= "<tr class=contenu><td>" . DatabaseDescription::getFieldDocLabel("fta_suivi_projet", $champ) . "</td><td>";
//        if ($proprietaire) {
//
//            //$bloc_suivi .= calendrier($champ, ${$champ});
//            ${$champ} = date("Y-m-d");
//        } else {
//            $bloc_suivi .="${$champ}";
//            $bloc_suivi .="<input type=hidden name=$champ value=${$champ}>";
//        }
//        $bloc_suivi.="</td></tr>";
//        $field_name = "date_validation_suivi_projet";
//        $table_name = "fta_suivi_projet";
//        if ($is_editable) {
//            $value = date("Y-m-d");
//        } else {
//            $value = self::$objectFta->getFieldValue($table_name, $field_name);
//        }
//
//        $htmlObject = new HtmlInputCalendar(
//                $field_name, $table_name, $value, $is_editable_false, $warning_update = ${"diff_" . $table_name}[$field_name]
//        );
//        $bloc_suivi .= $htmlObject->getHtmlResult();
        //Signature / Vérrouillage
        $field_name = "signature_validation_suivi_projet";
        $table_name = "fta_suivi_projet";
        if (self::$objectFta->getFieldValue($table_name, $field_name)) {
            $checked = "checked";
        } else {
            $checked = "";
        }
        if ($taux_validation_processus == 1) {
            $disabled = "disabled";
        } else {
            $disabled = "";
        }
        if ($proprietaire) {
            $bloc_suivi .= "<tr class=contenu><td>" . DatabaseDescription::getFieldDocLabel("fta_suivi_projet", $field_name) . "</td><td>";
            $bloc_suivi .= "<input type=checkbox name=$field_name value=" . $_SESSION["id_user"] . " $checked $disabled/>";
        } else {

            //Recherche de la personnes ayant signé ce chapitre
            if (self::$objectFta->getFieldValue($table_name, $field_name)) { //Le chapitre est signé
                $req = "SELECT prenom, nom FROM salaries WHERE id_user=" . self::$objectFta->getFieldValue($table_name, $field_name);
                $result = DatabaseOperation::query($req);
                if (mysql_num_rows($result)) {
                    $validateur = mysql_result($result, 0, "prenom")
                            . " "
                            . mysql_result($result, 0, "nom")
                    ;
                }
//Mode Debug
//if($conf->exec_debug or (${$module."_".$nom_intranet_actionss} and $synthese_action=="modification" and $signature_validation_suivi_projet))
//                if($conf->exec_debug)
//                {
//                    $temp_disabled="";
//                    //$deverouillage="<input type=submit value='Corriger'";
//                }else
//                {
                $deverouillage = "";
                $temp_disabled = "disabled";
//                }

                $bloc_suivi .= "<tr class=contenu><td>" . DatabaseDescription::getFieldDocLabel("fta_suivi_projet", $champ) . "</td><td>";
                $bloc_suivi .= "<input type=checkbox name=$champ value=$$champ $checked $temp_disabled/>$validateur";
            }
        }
        $champ = "signature_validation_suivi_projet";
        $bloc_suivi.="</td></tr>";

        $bloc_suivi .="</table>";
        return $bloc_suivi;
    }

    protected static function buildIsEditable() {
        $idFtaSuiviProjet = FtaSuiviProjetModel::getIdFtaSuiviProjetByIdFtaAndIdChapitre(self::$id_fta, self::$id_fta_chapitre);
        self::$ftaSuiviProjetModel = new FtaSuiviProjetModel($idFtaSuiviProjet);
        //Recherche du droit d'accès correspondant
        if (
                self::$is_owner == true and (
                (self::$ftaSuiviProjetModel->getDataField(FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET)->getFieldValue() == 0 )
                or ( self::$ftaSuiviProjetModel->getDataField(FtaSuiviProjetModel::FIELDNAME_SIGNATURE_VALIDATION_SUIVI_PROJET)->getFieldValue() == null)
                )
        ) {
            $is_editable = true;
//            $data_readonly = "";
//            $data_disabled = "";
//            $edit_allow = 1;    //Permet de modifier
        } else {
            $is_editable = false;
//            $data_readonly = "readonly";
//            $data_disabled = "disabled";
        }

        return $is_editable;
    }

    protected static function buildIsOwner() {

        //Recherche du droit d'accès correspondant
        if (
                $_SESSION["fta_" . self::$moduleIntranetActionsModel->getDataField(IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS)->getFieldValue()]
        ) {
            $return = true;
        } else {
            $return = false;
        }

        return $return;
    }

    protected static function buildHtmlSubmitButton() {
        $return = "";
        if (self::$is_editable == true) {
            $return = "<table><tr><td><center><input type=submit value=\"Enregistrer les informations saisies\"></center></td></tr></table>";
        }
        return $return;
    }

    protected static function buildHtmlCorrectButton() {
        $return = "";
        if (self::$is_correctable == true) {
            $return = "<br><br><br><br><br><table width=\"30%\" align=\"right\"><tr align=\"right\"><td class=titre_principal>"
                    . DatabaseDescription::getFieldDocLabel("fta_suivi_projet", "correction_fta_suivi_projet") . "</td></tr><tr align=\"right\"><td>"
                    . "<textarea name=correction_fta_suivi_projet rows=3 cols=40></textarea></td></tr><tr align=\"right\"><td>"
                    . "<a "
                    . "href=# "
                    . "onClick=confirmation_correction_fta(); "
                    . "/>"
                    . "<img src=../lib/images/correction.png alt=\"Gérer une Erreur\" width=\"50\" height=\"47\" border=\"0\" />"
                    . "Corriger une erreur"
                    . "</a>"
                    . "</td></tr>"
                    . "</table>"
            ;
        }
        return $return;
    }

    protected static function buildIsCorrectable() {

        $return = false;
//Recherche du droit d'accès correspondant
        $req = "SELECT `fta_workflow_structure`.`id_fta_chapitre`, `fta_processus_cycle`.`id_etat_fta_processus_cycle` "
                . "FROM `fta_processus`, `fta_workflow_structure`, `fta_processus_cycle` "
                . "WHERE ( `fta_processus`.`id_fta_processus` = `fta_workflow_structure`.`id_fta_processus` "
                . "AND `fta_processus_cycle`.`id_init_fta_processus` = `fta_processus`.`id_fta_processus` ) "
                . "AND ( ( `fta_workflow_structure`.`id_fta_chapitre` ='" . self::$id_fta_chapitre . "' "
                . "AND `fta_processus_cycle`.`id_etat_fta_processus_cycle` = '" . self::$objectFta->getFieldValue(ObjectFta::TABLE_ETAT_NAME, "abreviation_fta_etat") . "' ) ) "
        ;
        $cycle_en_cours = mysql_num_rows(DatabaseOperation::query($req));
        if (self::$is_owner == true and self::$is_editable == false and $cycle_en_cours) {
            $return = true;
        }


        return $return;
    }

}

?>
