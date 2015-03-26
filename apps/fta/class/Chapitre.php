<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of chapitre
 *
 * @author bs4300280
 */
class Chapitre {

    const NOT_EDITABLE = false;
    const ID_CHAPITRE_IDENTITE = 1;

    /**
     *
     * FPDF@var <ObjectFta>
     */
    protected static $id_fta;

    /**
     * Objet FTA
     * @var ObjectFta 
     */
    protected static $objectFta;
    protected static $id_fta_chapitre;
    protected static $recordChapitre;
    protected static $id_fta_processus;
    protected static $recordProcessus;
    protected static $id_intranet_actions;
    protected static $recordIntranetActions;
    protected static $html_chapitre_identite;
    protected static $html_chapitre_commerce;
    protected static $html_chapitre_production;
    protected static $html_chapitre_qualite;
    protected static $html_chapitre_emballage;
    protected static $html_chapitre_decoupe;
    protected static $html_chapitre_conditionnement_piece_entiere;
    protected static $html_chapitre_conditionnement_decoupe;
    protected static $html_chapitre_codification;
    protected static $html_chapitre_expedition;
    protected static $html_chapitre_need_rebuild;
    protected static $html_submit_button;
    protected static $is_editable;
    protected static $is_owner;
    protected static $is_correctable;
    protected static $taux_validation_processus;
    protected static $synthese_action;
    protected static $html_correct_button;
    protected static $html_chapitre_core;
    protected static $html_suivi_dossier;
    protected static $html_chapitre_all;

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

    public static function initChapitre($id_fta, $id_fta_chapitre, $synthese_action) {

        self::$id_fta = $id_fta;
        self::$id_fta_chapitre = $id_fta_chapitre;
        self::$synthese_action = $synthese_action;

        self::$objectFta = new ObjectFta(self::$id_fta);
        self::$objectFta->loadCurrentSuiviProjectByChapter(self::$id_fta_chapitre);
        self::$recordChapitre = new DatabaseRecord(
                $table_name = "fta_chapitre", $key_value = self::$id_fta_chapitre
        );
        self::$id_fta_processus = self::$recordChapitre->getFieldValue("id_fta_processus");
        self::$recordProcessus = new DatabaseRecord(
                $table_name = "fta_processus", $key_value = self::$id_fta_processus
        );
        self::$id_intranet_actions = self::$recordProcessus->getFieldValue("id_intranet_actions");
        self::$recordIntranetActions = new DatabaseRecord(
                $table_name = "intranet_actions", $key_value = self::$id_intranet_actions
        );
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
            $return = fta_processus_validation(self::$id_fta, self::$id_fta_processus);
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
        switch (self::$recordChapitre->getFieldValue("nom_fta_chapitre")) {
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
            case "emballage":
                self::$html_chapitre_qualite = self::buildChapitreEmballage();
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
            case "expedition":
                self::$html_chapitre_expedition = self::buildChapitreExpedition();
                $return = self::$html_chapitre_expedition;
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
                ObjectFta::TABLE_CATEGORIE_NAME, "nom_fta_categorie"
                ), $default_value = 1, $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

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

    public static function buildChapitreCommerce() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $is_editable = self::$is_editable;
        $is_editable_false = false;

        $bloc.="<tr class=titre_principal><td class>Demandeur</td></tr>";

        //$bloc .= "</table>";
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
        $bloc.=$htmlObject->getHtmlResult();

        //Atelier
        $htmlObject = new OldHtmlList(
                $data_field = self::$objectFta->getFieldDescription(
                ObjectFta::TABLE_FTA_NAME, "id_arcadia_atelier"
                ), $content_label_field = new DatabaseDescriptionField(
                $field_table = "arcadia_atelier", $field_name = "nom_arcadia_atelier", $field_value = $data_field->getValue()
                ), $default_value = 1, $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

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

    public static function buildChapitreCodification() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $is_editable = self::$is_editable;
        $is_editable_false = false;

        $bloc.="<tr class=titre_principal><td class>Demandeur</td></tr>";

        //Nom du demandeur
        $htmlObject = new htmlInputText(
                $field_name = "code_article_ldc", $table_name = ObjectFta::TABLE_ARTI_NAME, $value = self::$objectFta->getFieldValue($table_name, $field_name), $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

        //$bloc .= "</table>";
        return $bloc;
    }

    public static function buildChapitreEmballage() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $is_editable = self::$is_editable;
        $is_editable_false = false;
        $id_fta_chapitre_encours = self::$id_fta_chapitre;

        $bloc.="<tr class=titre_principal><td class>Demandeur</td></tr>";

        //Selection de tous les types de groupe d'emballage
        $req = "SELECT * FROM annexe_emballage_groupe_type ORDER BY ordre_emballage_groupe_type";
        //$req = "SELECT * FROM annexe_emballage_groupe_type WHERE `id_annexe_emballage_groupe_type`='1' ORDER BY ordre_emballage_groupe_type";
        $result1 = DatabaseOperation::query($req);
        while ($rows1 = mysql_fetch_array($result1)) {


            //Sélection du bon groupe d'emballage
            $type_emballage_groupe = $rows1["id_annexe_emballage_groupe_type"]; //Emballe pour l'UVC
            $id_annexe_emballage_groupe_type = $type_emballage_groupe;
            $titre = $rows1["nom_annexe_emballage_groupe_type"];

            $bloc.="<tr><td><br></td></tr><" . Html::$DEFAULT_HTML_TABLE_CONTENU . "><tr class=titre_principal><td align=left>$titre";

            //Ajouter un nouveau Conditionement
            if ($is_editable) {
                if ($type_emballage_groupe == 2) {
                    $dimension_uvc_fta_confitionnement = 1;
                }
                $bloc.= "
                   <a href=ajout_conditionnement.php?id_fta=$id_fta&type_emballage_groupe=$type_emballage_groupe&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action&dimension_uvc_fta_confitionnement=$dimension_uvc_fta_confitionnement>
                   (Ajouter)
                   </a>
                   ";
            }
            $bloc.= "</td></tr>";

            //Intitulé des quantité
            $intitule_quantite = "Quantité par ";
            switch ($id_annexe_emballage_groupe_type) {
                case 1: $intitule_quantite .= "UVC";
                    break;
                case 2: $intitule_quantite .= "Colis";
                    break;
                case 3: $intitule_quantite .= "Palette";
                    break;
                case 4: $intitule_quantite = "Quantité";
                    break;
            }
            //Tableau récapitulatif du conditionnement
            $recap_conditionnement = "
                        <" . Html::$DEFAULT_HTML_TABLE_CONTENU . ">
                        <tr class=contenu>
                            <td>
                            Type
                            </td>
                            <td>
                            Longeur x Largeur x Hauteur (en mm)
                            </td>
                            <td>
                            Poids (en g)
                            </td>
                            <td>
                            $intitule_quantite
                            </td>";
            if ($id_annexe_emballage_groupe_type == 3) {
                $recap_conditionnement .="<td>PCB</td>";
            }
            if ($is_editable) {
                $recap_conditionnement.="<td><small><i>Actions</i></small></td>";
            }
            $recap_conditionnement.="</tr>";

            $req = "SELECT id_fta_conditionnement, fta_conditionnement.id_annexe_emballage_groupe "
                    . "FROM fta_conditionnement, annexe_emballage_groupe "
                    . "WHERE id_fta=$id_fta "
                    . "AND ( "
                    . "id_annexe_emballage_groupe_type=$type_emballage_groupe "
                    //. "OR ( fta_conditionnement.id_annexe_emballage_groupe = annexe_emballage_groupe.id_annexe_emballage_groupe "
                    //. "AND id_annexe_emballage_groupe_configuration =$type_emballage_groupe )"
                    . " )"
                    . "AND fta_conditionnement.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
                    . "ORDER BY nom_annexe_emballage_groupe, poids_fta_conditionnement "
            ;

            $result = DatabaseOperation::query($req);
            if (mysql_num_rows($result)) {
                while ($rows = mysql_fetch_array($result)) {
                    $id_fta_conditionnement = $rows["id_fta_conditionnement"];
                    $last_id_fta_conditionnement = $rows["last_id_fta_conditionnement"];
                    //$table = "fta_conditionnement";
//                    mysql_table_load($table);
//                    mysql_table_load("annexe_emballage");
//                    mysql_table_load("annexe_emballage_groupe");
                    $recordConditionnement = new DatabaseRecord(
                            "fta_conditionnement", $id_fta_conditionnement)
                    ;
                    $recordEmballage = new DatabaseRecord(
                            "annexe_emballage", $recordConditionnement->getFieldValue("id_annexe_emballage"))
                    ;
                    $recordEmballageGroupe = new DatabaseRecord(
                            "annexe_emballage_groupe", $recordEmballage->getFieldValue("id_annexe_emballage_groupe"))
                    ;

                    //Récupération du différenciel de version
                    $table = "fta_conditionnement";
                    $table_name_1 = $table;
                    $id_1 = $id_fta_conditionnement;
                    $table_name_2 = $table;
                    $id_2 = $last_id_fta_conditionnement;
                    //$debug=1;
                    ${"diff_" . $table_name_1} = DatabaseOperation::getArrayFieldsNameForDiffRecords($table_name_1, $id_1, $id_2);
                    $image_modif = "";

                    //Groupe d'emballage
                    //$champ = "id_annexe_emballage_groupe";
                    //$table = "fta_conditionnement";
                    //Versionning
                    $color_modif = "";
                    if (${"diff_" . $table}[$champ]) {
                        $image_modif = $html_image_modif;
                        $color_modif = $html_color_modif;
                    }
                    //$champ = "nom_annexe_emballage_groupe";
                    $recap_conditionnement .= "<tr class=contenu ><td $color_modif width=\"20%\">" . $recordEmballageGroupe->getFieldValue("nom_annexe_emballage_groupe") . "<br>&nbsp;&nbsp;" . $recordEmballage->getFieldValue("reference_fournisseur_annexe_emballage") . "</td>";

                    //Dimensions
                    $color_modif = "";
                    $table = "fta_conditionnement";

                    //Versionning
                    //$champ="hauteur_fta_conditionnement";
                    if (${"diff_" . $table}["hauteur_fta_conditionnement"] or $ {"diff_" . $table}["longueur_fta_conditionnement"] or $ {"diff_" . $table}["largeur_fta_conditionnement"]
                    ) {
                        $image_modif = $html_image_modif;
                        $color_modif = $html_color_modif;
                    }

                    $champ = "Longeur x Largeur x Hauteur (en mm)";
                    $recap_conditionnement .= "<td $color_modif width=\"20%\">"
                            . $recordConditionnement->getFieldValue("longueur_fta_conditionnement")
                            . " x "
                            . $recordConditionnement->getFieldValue("largeur_fta_conditionnement")
                            . " x "
                            . $recordConditionnement->getFieldValue("hauteur_fta_conditionnement")
                            . "</td>"
                    ;

                    //Poids
//                    $champ = "poids_fta_conditionnement";
//                    $table = "fta_conditionnement";
                    //Versionning
                    $color_modif = "";
                    if (${"diff_" . $table}[$champ]) {
                        $image_modif = $html_image_modif;
                        $color_modif = $html_color_modif;
                    }
                    $recap_conditionnement .= "<td $color_modif width=\"20%\">" . $recordConditionnement->getFieldValue("poids_fta_conditionnement") . "</td>";

                    //Versionning
                    $champ = "quantite_par_couche_fta_conditionnement";
                    $table = "fta_conditionnement";
                    $color_modif = "";
                    if (${"diff_" . $table}[$champ]) {
                        $image_modif = $html_image_modif;
                        $color_modif = $html_color_modif;
                    }

                    if ($recordConditionnement->getFieldValue("nombre_couche_fta_conditionnement") == 1) {

                        $recap_conditionnement .= "<td $color_modif width=\"20%\" align=\"center\">" . $recordConditionnement->getFieldValue("quantite_par_couche_fta_conditionnement") . "</td>";
                    } else {
                        //Versionning
                        $champ = "nombre_couche_fta_conditionnement";
                        $table = "fta_conditionnement";
                        //$color_modif="";
                        if (${"diff_" . $table}[$champ]) {
                            $image_modif = $html_image_modif;
                            $color_modif = $html_color_modif;
                        }
                        $recap_conditionnement .= "<td $color_modif width=\"20%\">" . $recordConditionnement->getFieldValue("quantite_par_couche_fta_conditionnement") . " colis x " . $recordConditionnement->getFieldValue("nombre_couche_fta_conditionnement") . " couches</td>";
                        $recap_conditionnement .= "<td $color_modif width=\"20%\"><big><b>" . $recordConditionnement->getFieldValue("pcb_fta_conditionnement") . "</b></big></td>";
                    }



                    //Action
                    $color_modif = "";
                    if ($image_modif) {
                        $color_modif = $html_color_modif;
                    }
                    $recap_conditionnement .= "<td $color_modif width=\"1%\">";
                    if ($is_editable) {
                        $recap_conditionnement .= "
                                <a href=modification_fiche_post.php?id_fta=$id_fta&id_fta_conditionnement=$id_fta_conditionnement&action=suppression_conditionnement&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action>
                                <img src=../lib/images/supprimer.png width=15 height=15 border=0/>
                                </a><br>
                                <a href=ajout_conditionnement.php?id_fta=$id_fta&id_fta_conditionnement=$id_fta_conditionnement&action=etape3&id_fta_chapitre_encours=$id_fta_chapitre_encours&synthese_action=$synthese_action>
                                <img src=../lib/images/next.png width=15 height=15 border=0/></a>
                                ";
                    }
                    $recap_conditionnement.="$image_modif</td>";
                }//Fin du While
            }//Fin du If

            $recap_conditionnement.="</tr>";
            $bloc.= $recap_conditionnement;
        }

//        $bloc.="</table><".Html::$DEFAULT_HTML_TABLE_CONTENU.">";
//
//        //Synoptic
//        $champ = "description_emballage";
//        $table = "fta";
//
//        //Versionning
//        $color_modif = "";
//        if (${"diff_" . $table}[$champ]) {
//            $image_modif = $html_image_modif;
//            $color_modif = $html_color_modif;
//        }
//        $bloc .= "<tr class=contenu><td $color_modif>" . mysql_field_desc("fta", $champ) . "</td><td $color_modif>";
//        if ($is_editable) {
//            $bloc .= "<textarea name=" . $champ . " rows=8 cols=75>${$champ}</textarea>";
//        } else {
//            $bloc .=html_view_txt(${$champ});
//        }
//        $bloc.="$image_modif</td></tr>";
        //$bloc .= "</table>";
        return $bloc;
    }

    public static function buildChapitreExpedition() {

        $bloc = "";
        $id_fta = self::$id_fta;
        $synthese_action = self::$synthese_action;
        $is_editable = self::$is_editable;
        $is_editable_false = false;

        $bloc.="<tr class=titre_principal><td class>Demandeur</td></tr>";

        //Besoin compostage ?
        $htmlObject = new HtmlListBoolean(
                $data_field = self::$objectFta->getFieldDescription(
                ObjectFta::TABLE_FTA_NAME, "besoin_compostage_fta"), $default_value = HtmlListBoolean::NO_VALUE, $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

        //Maquette étiquette
        $htmlObject = new OldHtmlList(
                $data_field = self::$objectFta->getFieldDescription(
                ObjectFta::TABLE_FTA_NAME, "id_arcadia_maquette_etiquette"
                ), $content_label_field = new DatabaseDescriptionField(
                $field_table = "arcadia_maquette_etiquette", $field_name = "nom_arcadia_maquette_etiquette", $field_value = $data_field->getValue()
                ), $default_value = null, $is_editable, $warning_update = ${"diff_" . $table_name}[$field_name]
        );
        $bloc.=$htmlObject->getHtmlResult();

        //$bloc .= "</table>";
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
        $is_editable = self::$is_editable;
        $isEditable = $is_editable;
        //$is_editable_false = false;


        $bloc.="<tr class=titre_principal><td class>Demandeur</td></tr>";
        //$objectFta = new ObjectFta($id_fta);

        $idFta = $id_fta;
        $ftaModel = new FtaModel($idFta);
        $ftaView = new FtaView($ftaModel);
        $ftaView->setIsEditable($isEditable);
        $ftaView->setFtaChapitreModelById(self::ID_CHAPITRE_IDENTITE);


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


        //PCB
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_PCB);


        $bloc.="<tr class=titre_principal><td class>Caractéristiques FTA</td></tr>";

        //Créateur
        $bloc.=$ftaView->getHtmlCreateurFta();

        //Catégorie de FTA
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CATEGORIE_FTA);

        //Besoin de la fiche technique ?
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_BESOIN_FICHE_TECHNIQUE);

        //Etude de prix ?
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_ETUDE_PRIX_FTA);

        //Calibre par défaut
        $bloc.=$ftaView->getHtmlDataField(FtaModel::FIELDNAME_CALIBRE_DEFAUT);

        $bloc.="<tr class=titre_principal><td class>Echéances</td></tr>";

        //Date d'échéance des processus
        $bloc.=$ftaView->getHtmlEcheancesProcessus();
        /**        */
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

        //Recherche du droit d'accès correspondant
        if (
                self::$is_owner == true and (
                (self::$objectFta->getFieldValue(ObjectFta::TABLE_SUIVI_PROJET_NAME, "signature_validation_suivi_projet") == 0 ) or ( self::$objectFta->getFieldValue(ObjectFta::TABLE_SUIVI_PROJET_NAME, "signature_validation_suivi_projet") == null)
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
                $_SESSION["fta_" . self::$recordIntranetActions->getFieldValue("nom_intranet_actions")]
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
        $req = "SELECT `fta_chapitre`.`id_fta_chapitre`, `fta_processus_cycle`.`id_etat_fta_processus_cycle` "
                . "FROM `fta_processus`, `fta_chapitre`, `fta_processus_cycle` "
                . "WHERE ( `fta_processus`.`id_fta_processus` = `fta_chapitre`.`id_fta_processus` "
                . "AND `fta_processus_cycle`.`id_init_fta_processus` = `fta_processus`.`id_fta_processus` ) "
                . "AND ( ( `fta_chapitre`.`id_fta_chapitre` ='" . self::$id_fta_chapitre . "' "
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
