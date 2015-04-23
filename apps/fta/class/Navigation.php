<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of navigation
 *
 * @author tp4300008
 */
class Navigation {

    /**
     *
     * FPDF@var <ObjectFta>
     */
    protected static $id_fta;

    /**
     * Objet FTA
     * @var ObjectFta 
     */
    protected static $comeback;
    protected static $html_navigation_bar;
    protected static $html_navigation_core;
    //protected static $id_fta_chapitre;
    protected static $id_fta_chapitre_encours;
    protected static $objectFta;
    protected static $synthese_action;
    //protected static $id_fta_processus;
    //protected static $id_intranet_actions;
    //protected static $recordIntranetActions;
    //protected static $recordProcessus;

    public static function initNavigation($id_fta, $id_fta_chapitre_encours, $synthese_action, $comeback) {

        self::$id_fta = $id_fta;
        //self::$id_fta_chapitre = $id_fta_chapitre;
        self::$id_fta_chapitre_encours = $id_fta_chapitre_encours;
        self::$synthese_action = $synthese_action;
        self::$comeback = $comeback;

        self::$objectFta = new ObjectFta(self::$id_fta);
        /* self::$objectFta->loadCurrentSuiviProjectByChapter(self::$id_fta_chapitre);
          self::$recordChapitre = new DatabaseRecord(
          $table_name = "fta_chapitre", $key_value = self::$id_fta_chapitre_encours
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
          
          self::$html_suivi_dossier = self::buildSuiviDossier(); */
        self::$html_navigation_core = self::buildNavigationCore();
        self::$html_navigation_bar = self::buildNavigationAll();
    }

    public static function getHtmlNavigationBar() {
        return self::$html_navigation_bar;
    }

    // Elément html réuni et contruie de la barre de navigation
    protected static function buildNavigationAll() {

        $return = self::$html_navigation_core
               
        ;
        return $return;
    }

    protected static function buildNavigationCore() {
        
        //faire par étape tous en visuelle 
        
        return ;
    }

}
