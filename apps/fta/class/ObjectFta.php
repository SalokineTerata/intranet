<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ObjectFta
 *
 * @todo A terminer pour utilisation au lieu d'utiliser directement les objets DatabaseRecordSet
 * @author bs4300280
 */
class ObjectFta {
    /*
     * Propriétés
     */

    /**
     *
     * array(TABLE_NAME => recordset);
     * @var <array> Tableaux des recordsets composants l'objet
     */
    protected $records = array();
    protected $collections = array();

    const TABLE_FTA_NAME = "fta";
    const ID_FTA_NAME = "id_fta";

    protected $id_fta_value;
    protected $last_id_fta_value;

    const TABLE_ARTI_NAME = "access_arti2";
    const ID_ARTI_NAME = "id_access_arti2";

    protected $id_arti_value;

    const TABLE_CREATEUR_NAME = "salaries";
    const ID_CREATEUR_NAME = "id_user";
    const TABLE_CATEGORIE_NAME = "fta_categorie";
    const ID_CATEGORIE_NAME = "id_fta_categorie";
    const TABLE_ETAT_NAME = "fta_etat";
    const ID_ETAT_NAME = "id_fta_etat";
    const TABLE_SUIVI_PROJET_NAME = "fta_suivi_projet";
    const ID_SUIVI_PROJET_NAME = "id_fta_suivi_projet";
    const TABLE_CHAPITRE_NAME = "fta_chapitre";
    const ID_CHAPITRE_NAME = "id_fta_chapitre";
    const TABLE_GEO_NAME = "geo";
    const ID_GEO_NAME = "id_geo";

    protected $fields_value_in_sql_clause;
    protected $keys_value_in_sql_clause;
    protected $current_id_fta_suivi_projet;
    protected $diff_enable;

    public function __construct($id = null) {

        //Chargement d'une fta existante
        //$this->id_fta_value = &$this->id_object_session;
        if ($id) {
            $this->id_fta_value = $id;
            $this->records[self::TABLE_FTA_NAME] = new DatabaseRecord(
                    self::TABLE_FTA_NAME, $this->id_fta_value
            );
            //$this->records[self::TABLE_FTA_NAME] = $recordFta;
            $this->id_arti_value = $this->records[self::TABLE_FTA_NAME]->getFieldValue(self::ID_ARTI_NAME);
            $this->records[self::TABLE_ARTI_NAME] = new DatabaseRecord(
                    self::TABLE_ARTI_NAME, $this->id_arti_value
            );
            $this->records[self::TABLE_CREATEUR_NAME] = new DatabaseRecord(
                    self::TABLE_CREATEUR_NAME, $this->records[self::TABLE_FTA_NAME]->getFieldValue("createur_fta")
            );
            $this->records[self::TABLE_CATEGORIE_NAME] = new DatabaseRecord(
                    self::TABLE_CATEGORIE_NAME, $this->records[self::TABLE_FTA_NAME]->getFieldValue(self::ID_CATEGORIE_NAME)
            );
            $this->records[self::TABLE_ETAT_NAME] = new DatabaseRecord(
                    self::TABLE_ETAT_NAME, $this->records[self::TABLE_FTA_NAME]->getFieldValue(self::ID_ETAT_NAME)
            );

            //Recherche du suivi de dossiers (si déjà renseigné)
            $req = "SELECT " . self::ID_SUIVI_PROJET_NAME . " "
                    . "FROM " . self::TABLE_SUIVI_PROJET_NAME . " "
                    . "WHERE id_fta=" . $this->id_fta_value . " "
            ;
            $result = DatabaseOperation::query($req);
            while ($rows = mysql_fetch_array($result)) {
                $this->collections[self::TABLE_SUIVI_PROJET_NAME][$rows[self::ID_SUIVI_PROJET_NAME]] = new DatabaseRecord(
                        self::TABLE_SUIVI_PROJET_NAME, $rows[self::ID_SUIVI_PROJET_NAME]
                );
            }
            if ($this->getFieldValue(self::TABLE_FTA_NAME, "id_version_dossier_fta") == 0) {  //Dans le cas d'un version 0, il n'y a pas de FTA précédente, donc le versionning est désactivé
                $this->diff_enable = false;
            } else {
                $this->diff_enable = true;
            }
        } else {
            //ToDo: A implémenter
            /**
             * Création d'une nouvelle FTA vierge
             */
            //Création des enregsitrement dans la base de donnée
//            $this->id_fta_value = Database::reserveKeyDatabase(self::TABLE_FTA_NAME);
//            $this->recordFta = new DatabaseRecordSet(self::TABLE_FTA_NAME,  $this->id_fta_value);
//            $this->id_arti_value = Database::reserveKeyDatabase(self::TABLE_ARTI_NAME);
//            $this->recordArti = new DatabaseRecordSet(self::TABLE_ARTI_NAME,  $this->id_arti_value);
//
//            //Mise à jour des clefs étrangères
//            $this->recordFta->setFieldValue(self::ID_ARTI_NAME, $this->id_arti_value);
//            $this->recordArti->setFieldValue(self::ID_FTA_NAME, $this->id_fta_value);
        }
        $this->keys_value_in_sql_clause = $this->getKeyToSqlStatement();
        $this->last_id_fta_value = $this->buildLastIdFta();
        $this->fields_value_in_sql_clause = $this->getFieldsToSqlClauseSet();
        $this->current_id_fta_suivi_projet = $this->loadCurrentSuiviProjectByChapter($_REQUEST[self::ID_CHAPITRE_NAME]);


        //ToDo: A implémenter
        //$this->buildFieldsDiff();
    }

    public function getIdFta() {
        return $this->id_fta_value;
    }

    protected function getKeyToSqlStatement() {
        return DatabaseOperation::convertArrayToSqlClauseWhere(self::TABLE_FTA_NAME, array(self::ID_FTA_NAME => $this->id_fta_value));
    }

    protected function buildLastIdFta() {
        //Dans le cas d'un version 0, il n'y a pas de FTA précédente, donc le versionning est désactivé
        $return = null;
        if ($this->records[self::TABLE_FTA_NAME]->getFieldValue("id_version_dossier_fta") != 0) {

            //Recherche de la FTA précédente
            $last_id_version_dossier_fta = $this->records[self::TABLE_FTA_NAME]->getFieldValue("id_version_dossier_fta") - 1;
            $last_id_dossier_fta = $this->records[self::TABLE_FTA_NAME]->getFieldValue("id_dossier_fta");
            $req = "SELECT id_fta FROM fta "
                    . "WHERE id_version_dossier_fta=$last_id_version_dossier_fta "
                    . "AND id_dossier_fta=$last_id_dossier_fta "
            ;
            $result = DatabaseOperation::query($req);
            $return = mysql_result($result, 0, "id_fta");
        }
        return $return;
    }

    public function getLastIdFta() {
        return $this->last_id_fta_value;
    }

    protected function buildFieldsDiff() {
        //ToDo: A implémenter
        if ($this->last_id_fta) {

            //Récupération du différentiel de version
            $id_1 = $this->id_fta_value;
            $id_2 = $this->last_id_fta_value;
            $this->fields_diff = diff_record(self::TABLE_FTA_NAME, $id_1, self::TABLE_FTA_NAME, $id_2);
            return true;
        } else {
            return false;
        }
    }

    public static function deleteClassification() {
        $request = "DELETE FROM classification_fta WHERE `id_fta`='" . $this->getIdFta() . "'";
        return DatabaseOperation::query($request);
    }

    public static function deleteConditionnement($id_fta_conditionnement) {
        $request = "DELETE FROM fta_conditionnement WHERE `id_fta_conditionnement`='$id_fta_conditionnement'";
        $result = DatabaseOperation::query($request);
    }

    protected function getFieldsToSqlClauseSet() {

        return
                $this->records[self::TABLE_FTA_NAME]->getFieldsToSqlStatement()
                . DatabaseOperation::SQL_SEPARATOR_LIST
               // . $this->records[self::TABLE_ARTI_NAME]->getFieldsToSqlStatement()
        ;
    }

    public function getFieldsToSqlClauseWhere() {
        return $this->fields_value_in_sql_clause;
    }

    public function getTablesToSqlStatement() {
        return "`" . self::TABLE_FTA_NAME . "`, `" . self::TABLE_ARTI_NAME . "`";
    }

    public function getKeysForSqlClause() {
        return $this->keys_value_in_sql_clause;
    }

    public function getFieldValue($table_name, $field_name) {
        $return = "";
        if ($this->records[$table_name] != null) {
            $return = $this->records[$table_name]->getFieldValue($field_name);
        } else {
            $return = null;
        }
        return $return;
    }

    public function loadCurrentSuiviProjectById($id_fta_suivi_projet) {
        $this->current_id_fta_suivi_projet = $id_fta_suivi_projet;
        if ($this->current_id_fta_suivi_projet == null) {
            $this->records[self::TABLE_SUIVI_PROJET_NAME] = null;
        }
        $this->records[self::TABLE_SUIVI_PROJET_NAME] = &$this->collections[self::TABLE_SUIVI_PROJET_NAME][$this->current_id_fta_suivi_projet];
    }

    public function loadCurrentSuiviProjectByChapter($id_fta_chapitre) {
        $request = "SELECT " . self::ID_SUIVI_PROJET_NAME . " FROM " . self::TABLE_SUIVI_PROJET_NAME . " "
                . "WHERE `" . self::ID_FTA_NAME . "`='" . $this->getIdFta() . "' "
                . "AND `" . self::ID_CHAPITRE_NAME . "`='" . $id_fta_chapitre . "' "
        ;
        $result = DatabaseOperation::query($request);
        if (mysql_num_rows($result)) {
            $this->loadCurrentSuiviProjectById(mysql_result($result, 0, self::ID_SUIVI_PROJET_NAME));
        } else {
            $req = "INSERT " . self::TABLE_SUIVI_PROJET_NAME . " "
                    . "SET `" . self::ID_FTA_NAME . "`='" . $this->getIdFta() . "', "
                    . "`" . self::ID_CHAPITRE_NAME . "`='" . $id_fta_chapitre . "' "
            ;
            $result = DatabaseOperation::query($req);
            $this->loadCurrentSuiviProjectByChapter($id_fta_chapitre);
        }
    }

    public function getFieldDescription($table_name, $field_name) {
        return $this->records[$table_name]->getFieldDescriptionByName($field_name);
    }

    public function setFieldValue($table_name, $field_name, $field_value) {
        $this->records[$table_name]->setFieldValue($field_name, $field_value);
    }

    public function updatePropertiesAndDatabase($values) {
        $this->updatePropertiesOnly($values);
        $this->updateDatabaseOnly();
    }

    public function updatePropertiesOnly($values) {

        $return = false;
        $this->records[self::TABLE_FTA_NAME]->updateInDatabase($values);
        $this->records[self::TABLE_ARTI_NAME]->updateInDatabase($values);
        $this->records[self::TABLE_SUIVI_PROJET_NAME]->updateInDatabase($values);
        //$this->collections[self::TABLE_SUIVI_PROJET_NAME][$values[self::ID_SUIVI_PROJET_NAME]]->updatePropertiesOnly($values);

        $this->fields_value_in_sql_clause = $this->getFieldsToSqlClauseSet();
        return $return;
    }

    public function updateDatabaseOnly() {
        //Mise à jour des recordsets
        $this->records[self::TABLE_FTA_NAME]->saveToDatabase();
        //  $this->records[self::TABLE_ARTI_NAME]->saveToDatabase();
       // $this->collections[self::TABLE_SUIVI_PROJET_NAME][11]->saveToDatabase();
        $this->records[self::TABLE_SUIVI_PROJET_NAME]->saveToDatabase();
    }

    public function updatePropertiesFromHttpRequest($httpRequest = null) {
        if ($httpRequest == null) {
            $httpRequest = $_REQUEST;
        }
        $this->loadCurrentSuiviProjectByChapter($httpRequest[self::ID_CHAPITRE_NAME]);
        $this->updatePropertiesOnly($httpRequest);
    }

    /**
     * ToDo
     * @return <type> 
     */
    public function deleteInDatabase() {
        $req_delete = "DELETE FROM " . $this->getTablesToSqlStatement() . " ";
        $req_where = $this->getKeysForSqlClause();
        $req = $req_delete . " " . $req_where;
        $return = DatabaseOperation::query($req);
        return $return;
    }

    /**
     * ToDo
     * @return <type>
     */
    public function copy() {
        
    }

    /**
     * ToDo
     * @return <type>
     */
    public function rewrite($keys_value) {
        $this->deleteInDatabase();
        $return = $this->copy($keys_value);
        return $return;
    }

    /**
     * ToDo
     * @return <type>
     */
    public function isFieldDiff($field_name) {
        echo "Not implemented";
    }

    public static function &restoreSession($id_fta_value) {
        return $_SESSION["ObjectFta"][$id_fta_value];
    }

    public function saveSession() {
        $_SESSION["ObjectFta"][$this->id_fta_value] = $this;
    }

    public function checkMandatoryFields($nom_fta_chapitre) {
        $recordFta = &$this->records[self::TABLE_FTA_NAME];
   //     $recordArti = &$this->records[self::TABLE_ARTI_NAME];
        $nom_fta_chapitre_encours = $nom_fta_chapitre;
        $return = false; //false = echec du contrôle / true = réussite du contrôle
        //Vérification des saisies obligatoires avant validation du chapitre
        $erreur_saisie_obligatoire = false;
        $req = "SELECT * FROM fta_saisie_obligatoire "
                . "WHERE nom_chapitre_fta_saisie_obligatoire='" . $nom_fta_chapitre_encours . "' "
        ;
        $result = DatabaseOperation::query($req);
        if (mysql_numrows($result)) {
            while ($rows = mysql_fetch_array($result)) {
                $record = null;
                $table_name = $rows["nom_table_fta_saisie_obligatoire"];
                $field_name = $rows["nom_champ_fta_saisie_obligatoire"];
                switch ($table_name) {
                    case "access_arti2":
                        $record = $recordArti;
                        break;
                    case "fta":
                        $record = $recordFta;
                        break;
                }
                if ($record->getFieldValue($field_name) == null) {
                    $erreur_saisie_obligatoire = true;
                    $message_saisie_obligatoire.="- " . DatabaseDescription::getColumnLabel($table_name, $field_name) . "<br>";
                }
            }
        }

        if ($erreur_saisie_obligatoire) {
            $titre = "Informations manquantes";
            $message = "Certaines informations sont obligatoire pour permettre la validation du chapitre:<br><br>" . $message_saisie_obligatoire;
            afficher_message($titre, $message, $redirection);
            $noredirection = 1;
        } else {
            $return = true;
        }
        return $return;
    }

    public function buildNbUvParUs1() {
        $Unite_Facturation = $this->records[self::TABLE_ARTI_NAME]->getFieldValue("Unite_Facturation");
        $NB_UNIT_ELEM = $this->records[self::TABLE_ARTI_NAME]->getFieldValue("NB_UNIT_ELEM");
        $Poids_ELEM = $this->records[self::TABLE_ARTI_NAME]->getFieldValue("Poids_ELEM");


        //Determination de NB_UV_PAR_US1
        if ($Unite_Facturation) {
            switch ($Unite_Facturation) {
                case 2:
                    $NB_UV_PAR_US1 = $NB_UNIT_ELEM;
                    break;
                case 3:
                    $NB_UV_PAR_US1 = $Poids_ELEM * $NB_UNIT_ELEM;
                    break;
            }

            $this->setFieldValue(ObjectFta::TABLE_ARTI_NAME, "NB_UV_PAR_US1", $NB_UV_PAR_US1);
            return $NB_UV_PAR_US1;
        }
    }


    public static function showClassification(
    $id_fta, $id_version_dossier_fta, $last_id_fta, $FAMILLE_ARTICLE, $FAMILLE_MKTG, $id_access_familles_gammes, $is_editable, $synthese_action
    ) {

        //Variables locales
        $bloc = "";
        $image_modif = "";
        $color_modif = "";
        $html_table = Html::$DEFAULT_HTML_TABLE_CONTENU;
        $version_modif = ModuleConfig::ENABLE_SHOW_DIFF_FTA;
        $proprietaire = $is_editable;

        //Classification
        //Rechercher de versionning si existant
        if ($id_version_dossier_fta) {
            //Classification en cours
            $req = "SELECT id_classification_fta FROM classification_fta WHERE id_fta=$id_fta";
            $result = DatabaseOperation::query($req);
            $current_id_classification_fta = mysql_result($result, 0, "id_classification_fta");

            //Classification précédente
            $req = "SELECT id_classification_fta FROM classification_fta WHERE id_fta=$last_id_fta";
            $result = DatabaseOperation::query($req);
            if (mysql_num_rows($result)) {
                $last_id_classification_fta = mysql_result($result, 0, "id_classification_fta");
            }
            //Récupération du différenciel de version
            $table_name_1 = "classification_fta";
            $id_1 = $current_id_classification_fta;
            $table_name_2 = "classification_fta";
            $id_2 = $last_id_classification_fta;
            $debug = 0;
            ${"diff_" . $table_name_1} = diff_record($table_name_1, $id_1, $table_name_2, $id_2, $debug);

            $image_modif = "";
            $color_modif = "";
            if ($diff_classification_fta["id_classification_arborescence_article"]) {
                $image_modif = Html::$DEFAULT_HTML_WARNING_UPDATE_IMAGE;
                $color_modif = Html::$DEFAULT_HTML_WARNING_UPDATE_BGCOLOR;
            }
        }//Fin de la recherche de différenciel

        $bloc.=" <tr class=titre_principal><td width=\"20%\">Classification:</td>";

        $tab = affichage_classification_article($id_fta);

        if ($tab[0]) {   //Cet article est classé car il y a au moins un chemin
            if ($proprietaire) {
                $bloc.="<td $color_modif>$image_modif</td></tr><tr><td>";
            }

            //Tableau de données
            foreach ($tab as $chemin) {
                if ($chemin[0]) {
                    $bloc.= "<tr class=contenu><td width=\"50%\"><$html_table><tr><td width=\"100\">" . $chemin[1] . "";

                    $bloc .="</td>"
                            . "</tr>"
                            . "</table>"
                    ;
                    if ($proprietaire) {
                        $bloc.= "</td><td align=\"center\" valign=\"middle\" width=\"5%\">"
                                . "<a href=modification_fiche_post.php?id_fta=$id_fta&id_classification_fta=$chemin[0]&action=suppression_classification_chemin&synthese_action=$synthese_action>"
                                . "<img src=../lib/images/supprimer.png width=15 height=15 border=0/>"
                        ;
                        //$i++;
                    }
                }
            }
            $bloc.="</table><$html_table>";

            //Marque
            $id_element = "2"; //Recherche de la Marque
            $extension[0] = 1; //Passage en mode recherche d'une catégorie
            $field = recherche_element_classification_fta($id_fta, $id_element, $extension);
            if ($version_modif) {
                $field_last = recherche_element_classification_fta($last_id_fta, $id_element, $extension);
                //Versionning
                $image_modif = "";
                $color_modif = "";
                if ($field <> $field_last) {
                    $image_modif = Html::$DEFAULT_HTML_WARNING_UPDATE_IMAGE;
                    $color_modif = Html::$DEFAULT_HTML_WARNING_UPDATE_BGCOLOR;
                }
            }
            $field[2];
            $bloc .= "<tr class=contenu><td width=30% $color_modif>Marque(s) <i>(anciennement gamme)</i>:</td><td $color_modif>";
            $bloc .= "$field[2]";
            $bloc.="$image_modif</td></tr>";

            //Activité
            $id_element = "3"; //Recherche de l'Activité
            $extension[0] = 1; //Passage en mode recherche d'une catégorie
            $field = recherche_element_classification_fta($id_fta, $id_element, $extension);
            if ($version_modif) {
                $field_last = recherche_element_classification_fta($last_id_fta, $id_element, $extension);

                //Versionning
                $image_modif = "";
                $color_modif = "";
                if ($field <> $field_last) {
                    $image_modif = Html::$DEFAULT_HTML_WARNING_UPDATE_IMAGE;
                    $color_modif = Html::$DEFAULT_HTML_WARNING_UPDATE_BGCOLOR;
                }
            }
            $field[2];
            $bloc .= "<tr class=contenu><td $color_modif>Activité(s) <i>(anciennement ségment)</i>:</td><td $color_modif>";
            $bloc .= "$field[2]";
            $bloc.="$image_modif</td></tr>";

            //mysql_table_load("access_arti2");
            //Code de regroupement controle de gestion
            if ($FAMILLE_ARTICLE) {
                $field = "FAMILLE_ARTICLE";
                $table = "access_arti2";

                //Versionning
                $image_modif = "";
                $color_modif = "";
                if (${"diff_" . $table}[$field]) {
                    $image_modif = Html::$DEFAULT_HTML_WARNING_UPDATE_IMAGE;
                    $color_modif = Html::$DEFAULT_HTML_WARNING_UPDATE_BGCOLOR;
                }
                $bloc .= "<tr class=contenu><td $color_modif>Code contrôle de gestion - FAMILLE ARTICLE:</td><td $color_modif>";
                $bloc .= "$FAMILLE_ARTICLE";
                $bloc.="$image_modif</td></tr>";
            }

            //Code de regroupement controle de gestion
            if ($FAMILLE_MKTG) {
                $field = "FAMILLE_MKTG";
                $table = "access_arti2";

                //Versionning
                $image_modif = "";
                $color_modif = "";
                if (${"diff_" . $table}[$field]) {
                    $image_modif = Html::$DEFAULT_HTML_WARNING_UPDATE_IMAGE;
                    $color_modif = Html::$DEFAULT_HTML_WARNING_UPDATE_BGCOLOR;
                }
                $bloc .= "<tr class=contenu><td $color_modif>Code contrôle de gestion - FAMILLE MARKETING:</td><td $color_modif>";
                $bloc .= "$FAMILLE_MKTG";
                $bloc.="$image_modif</td></tr>";
            }

            //Code Gamme famille budget
            //if ($id_access_familles_gammes) {
            $field = "id_access_familles_gammes";
            $table = "access_arti2";

            //Versionning
            $image_modif = "";
            $color_modif = "";
            if (${"diff_" . $table}[$field]) {
                $image_modif = Html::$DEFAULT_HTML_WARNING_UPDATE_IMAGE;
                $color_modif = Html::$DEFAULT_HTML_WARNING_UPDATE_BGCOLOR;
            }
            $bloc .= "<tr class=contenu><td $color_modif>Code contrôle de gestion - Gamme famille budget:</td><td $color_modif>";
            $bloc .= $id_access_familles_gammes;
            $bloc.="$image_modif</td></tr>";
            //}
        } else {
            if ($proprietaire) {
                $lien = "<a href=ajout_classification_chemin.php?id_fta=$id_fta&synthese_action=$synthese_action&id_classification_arborescence_article=1>"
                        . "<h4>Ajouter un nouveau chemin de classification</h4>"
                        . "</a>"
                ;
            } else {
                $lien = "";
            }


            $bloc.="</tr><tr class=contenu><td class=couleur_rouge>Cet Article n'est pas classé: "
                    . $lien
                    . "</td>"
            ;
            //Exist-t-il une ancienne classification de substitution ?
//            if ($old_gamdesc or $old_segdesc) {
//                $bloc.="<td><u><b>Ancienne Classification:</b></u><br>Gamme=$old_gamdesc<br>Segment=$old_segdesc</td>";
//            }
            $bloc.="</tr>";
        }//Fin de la classification
        return $bloc;
    }

}

?>
