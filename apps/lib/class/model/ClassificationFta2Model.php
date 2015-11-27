<?php

/**
 * Description of ClassificationFtaModel
 * Table de classification Fta2
 *
 * @author franckwastaken
 */
class ClassificationFta2Model extends AbstractModel {

    const TABLENAME = 'classification_fta2';
    const KEYNAME = 'id_fta_classification2';
    const FIELDNAME_ID_PROPRIETAIRE_GROUPE = 'id_Proprietaire_Groupe';
    const FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE = 'id_Proprietaire_Enseigne';
    const FIELDNAME_ID_MARQUE = 'id_Marque';
    const FIELDNAME_ID_ACTIVITE = 'id_Activite';
    const FIELDNAME_ID_RAYON = 'id_Rayon';
    const FIELDNAME_ID_ENVIRONNEMENT = 'id_Environnement';
    const FIELDNAME_ID_RESEAU = 'id_Reseau';
    const FIELDNAME_ID_SAISONNALITE = 'id_Saisonnalite';

    protected static $idProprietaireGroupe;
    protected static $idProprietaireEnseigne;
    protected static $idMarque;
    protected static $idActivite;
    protected static $idRayon;
    protected static $idEnvironnement;
    protected static $idReseau;
    protected static $idSaisonnalite;

    protected function setDefaultValues() {
        
    }

    public static function initClassification($paramProprietaireGroupe, $paramProprietaireEnseigne, $paramMarque
    , $paramActivite, $paramRayon, $paramEnvironnement, $paramReseau, $paramSaisonnalite) {
        self::$idProprietaireGroupe = $paramProprietaireGroupe;
        self::$idProprietaireEnseigne = $paramProprietaireEnseigne;
        self::$idMarque = $paramMarque;
        self::$idActivite = $paramActivite;
        self::$idRayon = $paramRayon;
        self::$idEnvironnement = $paramEnvironnement;
        self::$idReseau = $paramReseau;
        self::$idSaisonnalite = $paramSaisonnalite;
    }

    /**
     * On obtient le nom des classifications sur le module classifications
     * @param int $paramIdClassification
     * @return string
     */
    public static function getNameClassification($paramIdClassification) {
        $arrayNomClassification = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU
                        . ' FROM ' . ClassificationArborescenceArticleCategorieContenuModel::TABLENAME
                        . ' WHERE  ' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME . '=' . $paramIdClassification
        );

        foreach ($arrayNomClassification as $rowsNomClassification) {
            $NomClassification = $rowsNomClassification[ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU];
        }
        return $NomClassification;
    }

    /**
     * Classification groupe pour la page index du module classifiation
     * @param int $paramIdDefaut
     * @param boolean $isEditable
     * @return string
     */
    public static function getListeClassificationProprietaireGroupe($paramIdDefaut, $isEditable) {
        $req = 'SELECT ' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME . ',' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU
                . ' FROM ' . ClassificationArborescenceArticleCategorieContenuModel::TABLENAME
                . ' WHERE ' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE . '=' . '1'
                . ' AND ' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME . '<>' . '0'
                . ' ORDER BY ' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU;

        $paramNomDefaut = 'selection_proprietaire1';

        return AccueilFta::afficherRequeteEnListeDeroulante($req, $paramIdDefaut, $paramNomDefaut, $isEditable, TRUE);
    }

    /**
     * Classification groupe avec label pour la page modification_fiche
     * @param int $paramIdDefaut
     * @param boolean $paramIsEditable
     * @return string
     */
    public static function getListeClassificationProprietaireGroupeLabel($paramIdDefaut, $paramIsEditable) {
        $req = 'SELECT ' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME . ',' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU
                . ' FROM ' . ClassificationArborescenceArticleCategorieContenuModel::TABLENAME
                . ' WHERE ' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE . '=' . '1'
                . ' AND ' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME . '<>' . '0'
                . ' ORDER BY ' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU;

        $paramNomDefaut = 'selection_proprietaire1';
        $listeClassification = '<td class=contenu >' . DatabaseDescription::getFieldDocLabel(ClassificationFta2Model::TABLENAME, ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE)
                . '</td><td class=contenu width=75% >'
                . AccueilFta::afficherRequeteEnListeDeroulante($req, $paramIdDefaut, $paramNomDefaut, $paramIsEditable, TRUE) . '</tr>';

        return $listeClassification;
    }

    /**
     * Classification groupe avec label pour la page ajout_classification
     * @param int $paramIdDefaut
     * @param boolean $paramIsEditable
     * @return string
     */
    public static function getListeClassificationProprietaireGroupeLabel2($paramIdDefaut, $paramIsEditable) {
        $req = 'SELECT ' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME . ',' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU
                . ' FROM ' . ClassificationArborescenceArticleCategorieContenuModel::TABLENAME
                . ' WHERE ' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE . '=' . '1'
                . ' AND ' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME . '<>' . '0'
                . ' ORDER BY ' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU;

        $paramNomDefaut = 'selection_proprietaire12';
        $listeClassification = '<td class=contenu >' . DatabaseDescription::getFieldDocLabel(ClassificationFta2Model::TABLENAME, ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE)
                . '</td><td class=contenu>'
                . AccueilFta::afficherRequeteEnListeDeroulante($req, $paramIdDefaut, $paramNomDefaut, $paramIsEditable, TRUE) . '</tr>';

        return $listeClassification;
    }

    /**
     * Gestion de l'affichage de la classification
     * @param int $paramAscendent
     * @param int $paramIdDefaut
     * @param int $paramSelect
     * @param int $paramOrig
     * @param string $paramNomDefaut
     * @param boolean $isEditable
     * @param int $paramMarque2
     * @return string
     */
    public static function getListeClassification($paramAscendent, $paramIdDefaut, $paramSelect, $paramOrig, $paramNomDefaut, $isEditable, $paramMarque2 = NULL) {
        if ($paramAscendent <> NULL) {
            $req = 'SELECT DISTINCT ' . $paramSelect
                    . ' FROM  ' . ClassificationFta2Model::TABLENAME
                    . ' WHERE  ' . $paramOrig . ' = ' . $paramAscendent;

            if (self::$idProprietaireGroupe) {
                $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE . ' = ' . self::$idProprietaireGroupe;
            }
            if (self::$idProprietaireEnseigne <> NULL) {
                $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE . ' = ' . self::$idProprietaireEnseigne;
            }
            if (self::$idMarque) {
                $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_MARQUE . ' = ' . self::$idMarque;
            }
            if (self::$idActivite) {
                $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_ACTIVITE . ' = ' . self::$idActivite;
            }
            if (self::$idRayon) {
                $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_RAYON . ' = ' . self::$idRayon;
            }
            if (self::$idEnvironnement) {
                $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT . ' = ' . self::$idEnvironnement;
            }
            if (self::$idSaisonnalite) {
                $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE . ' = ' . self::$idSaisonnalite;
            }

            $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);

            foreach ($array as $value) {
                $return[] = $value[$paramSelect];
            }
        }
        $reqListe = 'SELECT ' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME . ',' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU
                . ' FROM ' . ClassificationArborescenceArticleCategorieContenuModel::TABLENAME
                . ' WHERE ( 0 ' . ClassificationFta2Model::AddIdClassificationArborescenceArticleCategorieContenu($return)
                . ') ORDER BY ' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU;

        $Liste .= AccueilFta::afficherRequeteEnListeDeroulante($reqListe, $paramIdDefaut, $paramNomDefaut, $isEditable, TRUE);
        return $Liste;
    }

    private static function AddIdClassificationArborescenceArticleCategorieContenu($paramArrayIdClassificationArborescenceArticleCategorieContenu) {
        if ($paramArrayIdClassificationArborescenceArticleCategorieContenu) {
            foreach ($paramArrayIdClassificationArborescenceArticleCategorieContenu as $value) {
                $req .= ' OR ' . ClassificationArborescenceArticleCategorieContenuModel::TABLENAME . '.' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME . '=' . $value . ' ';
            }
        }
        return $req;
    }

    /**
     * Tableau de la classification
     * @return array
     */
    public static function getArrayListeClassification() {
        $req = 'SELECT ' . ClassificationFta2Model::FIELDNAME_ID_ACTIVITE
                . ',' . ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT
                . ',' . ClassificationFta2Model::FIELDNAME_ID_MARQUE
                . ',' . ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE
                . ',' . ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE
                . ',' . ClassificationFta2Model::FIELDNAME_ID_RAYON
                . ',' . ClassificationFta2Model::FIELDNAME_ID_RESEAU
                . ',' . ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE
                . ',' . ClassificationFta2Model::KEYNAME
                . ' FROM ' . ClassificationFta2Model::TABLENAME
                . ' WHERE 1';

        if (self::$idProprietaireGroupe) {
            $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE . ' = ' . self::$idProprietaireGroupe;
        }
        if (self::$idProprietaireEnseigne) {
            $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE . ' = ' . self::$idProprietaireEnseigne;
        }
        if (self::$idMarque) {
            $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_MARQUE . ' = ' . self::$idMarque;
        }
        if (self::$idActivite) {
            $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_ACTIVITE . ' = ' . self::$idActivite;
        }
        if (self::$idRayon) {
            $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_RAYON . ' = ' . self::$idRayon;
        }
        if (self::$idEnvironnement) {
            $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT . ' = ' . self::$idEnvironnement;
        }
        if (self::$idSaisonnalite) {
            $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE . ' = ' . self::$idSaisonnalite;
        }

        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
        return $array;
    }

    /**
     * On obtien l'identifiant de la classificationFta
     * @param int $paramidProprietaireGroupe
     * @param int $paramidProprietaireEnseigne
     * @param int $paramidMarque
     * @param int $paramidActivite
     * @param int $paramidRayon
     * @param int $paramidEnvironnement
     * @param int $paramidSaisonnalite
     * @return int
     */
    public static function getIdFtaClassification2($paramidProprietaireGroupe, $paramidProprietaireEnseigne, $paramidMarque, $paramidActivite, $paramidRayon, $paramidEnvironnement, $paramidReseau, $paramidSaisonnalite) {

        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . ClassificationFta2Model::KEYNAME
                        . ' FROM ' . ClassificationFta2Model::TABLENAME
                        . ' WHERE ' . ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE . ' = ' . $paramidProprietaireGroupe
                        . ' AND ' . ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE . ' = ' . $paramidProprietaireEnseigne
                        . ' AND ' . ClassificationFta2Model::FIELDNAME_ID_MARQUE . ' = ' . $paramidMarque
                        . ' AND ' . ClassificationFta2Model::FIELDNAME_ID_ACTIVITE . ' = ' . $paramidActivite
                        . ' AND ' . ClassificationFta2Model::FIELDNAME_ID_RAYON . ' = ' . $paramidRayon
                        . ' AND ' . ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT . ' = ' . $paramidEnvironnement
                        . ' AND ' . ClassificationFta2Model::FIELDNAME_ID_RESEAU . ' = ' . $paramidReseau
                        . ' AND ' . ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE . ' = ' . $paramidSaisonnalite);

        foreach ($array as $rows) {
            $idFtaClassification = $rows[ClassificationFta2Model::KEYNAME];
        }
        return $idFtaClassification;
    }

    /**
     * On obtient le droit de modification pour le module Classification de l'utilisateur connecté
     * @param int $paramIdUser
     * @return int
     */
    public static function getClassificationModification($paramIdUser) {
        $arrayModification = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        ' SELECT ' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES
                        . ' FROM ' . IntranetDroitsAccesModel::TABLENAME
                        . ' WHERE ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdUser
                        . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . '=' . '2'
                        . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES . '=18'
        );
        foreach ($arrayModification as $rowsModifications) {
            $fta_modification = $rowsModifications[IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES];
        }
        return $fta_modification;
    }

    /**
     * Generation de liste déroulante selon le type de classification
     * @param int $paramIdDefaut
     * @param int $paramIdTypeClassification
     * @param string $paramNomDefaut
     * @return string
     */
    public static function getClassificationListeSansDependance($paramIdDefaut, $paramIdTypeClassification, $paramNomDefaut, $paramIsEditable) {
        $req = ' SELECT ' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME
                . ',' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU
                . ' FROM ' . ClassificationArborescenceArticleCategorieContenuModel::TABLENAME
                . ' WHERE ' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE . '=' . $paramIdTypeClassification
                . ' ORDER BY ' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU
        ;

        return AccueilFta::afficherRequeteEnListeDeroulante($req, $paramIdDefaut, $paramNomDefaut, $paramIsEditable);
    }

    /**
     * Création d'une nouvelle classification et retourn sont identifiant
     * @return int
     */
    public static function InsertClassification() {
        $pdo = DatabaseOperation::executeComplete(
                        'INSERT INTO ' . ClassificationFta2Model::TABLENAME
                        . ' VALUES (NULL ,  \'\',  \'\',  \'\',  \'\',  \'\',  \'\',  \'\',  \'\')'
        );

        $key = $pdo->lastInsertId();

        return $key;
    }

    /**
     * Suppression d'une classification
     * @param int $paramIdClassification2
     */
    public static function SuppressionClassification($paramIdClassification2) {
        DatabaseOperation::execute(
                'DELETE FROM ' . ClassificationFta2Model::TABLENAME
                . ' WHERE ' . ClassificationFta2Model::KEYNAME . '=' . $paramIdClassification2
        );
    }

    /**
     * Liste déroulante de la classification pour la page modification_fiche
     * @param boolean$ paramIsEditable
     * @return string
     */
    public static function ShowListeDeroulanteClassification($paramIsEditable) {


        $bloc.= ClassificationFta2Model::getListeClassificationProprietaireGroupeLabel(self::$idProprietaireGroupe, $paramIsEditable);

        if (self::$idProprietaireGroupe) {

            $bloc.= ClassificationFta2Model::getListeClassificationLabel(self::$idProprietaireGroupe, self::$idProprietaireEnseigne
                            , ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE
                            , ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE
                            , 'selection_proprietaire2'
                            , $paramIsEditable
                            , self::$idMarque
            );

            if (self::$idProprietaireEnseigne <> NULL) {
                $bloc.= ClassificationFta2Model::getListeClassificationLabel(self::$idProprietaireEnseigne, self::$idMarque
                                , ClassificationFta2Model::FIELDNAME_ID_MARQUE
                                , ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE
                                , 'selection_marque'
                                , $paramIsEditable
                );
                if (self::$idMarque) {
                    $bloc.=ClassificationFta2Model::getListeClassificationLabel(self::$idMarque, self::$idActivite
                                    , ClassificationFta2Model::FIELDNAME_ID_ACTIVITE
                                    , ClassificationFta2Model::FIELDNAME_ID_MARQUE
                                    , 'selection_activite'
                                    , $paramIsEditable
                    );
                    if (self::$idActivite) {
                        $bloc.=ClassificationFta2Model::getListeClassificationLabel(self::$idActivite, self::$idRayon
                                        , ClassificationFta2Model::FIELDNAME_ID_RAYON
                                        , ClassificationFta2Model::FIELDNAME_ID_ACTIVITE
                                        , 'selection_rayon'
                                        , $paramIsEditable
                        );
                        if (self::$idRayon) {
                            $bloc.=ClassificationFta2Model::getListeClassificationLabel(self::$idRayon, self::$idEnvironnement
                                            , ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT
                                            , ClassificationFta2Model::FIELDNAME_ID_RAYON
                                            , 'selection_environnement'
                                            , $paramIsEditable
                            );
                            if (self::$idEnvironnement) {
                                $bloc.= ClassificationFta2Model::getListeClassificationLabel(self::$idEnvironnement, self::$idReseau
                                                , ClassificationFta2Model::FIELDNAME_ID_RESEAU
                                                , ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT
                                                , 'selection_reseau'
                                                , $paramIsEditable
                                );
                                if (self::$idReseau) {
                                    $bloc.=ClassificationFta2Model::getListeClassificationLabel(self::$idReseau, self::$idSaisonnalite
                                                    , ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE
                                                    , ClassificationFta2Model::FIELDNAME_ID_RESEAU
                                                    , 'selection_saisonnalite'
                                                    , $paramIsEditable
                                    );
                                }
                            }
                        }
                    }
                }
            }
        }
        return $bloc;
    }

    /**
     * Liste déroulante de la classification pour la page ajout_classification
     * @param boolean$ paramIsEditable
     * @return string
     */
    public static function ShowListeDeroulanteClassification2($paramIsEditable) {


        $bloc.= ClassificationFta2Model::getListeClassificationProprietaireGroupeLabel2(self::$idProprietaireGroupe, $paramIsEditable);

        if (self::$idProprietaireGroupe) {

            $bloc.= ClassificationFta2Model::getListeClassificationLabel(self::$idProprietaireGroupe, self::$idProprietaireEnseigne
                            , ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE
                            , ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE
                            , 'selection_proprietaire22'
                            , $paramIsEditable
                            , self::$idMarque
            );

            if (self::$idProprietaireEnseigne <> NULL) {
                $bloc.= ClassificationFta2Model::getListeClassificationLabel(self::$idProprietaireEnseigne, self::$idMarque
                                , ClassificationFta2Model::FIELDNAME_ID_MARQUE
                                , ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE
                                , 'selection_marque2'
                                , $paramIsEditable
                );
                if (self::$idMarque) {
                    $bloc.=ClassificationFta2Model::getListeClassificationLabel(self::$idMarque, self::$idActivite
                                    , ClassificationFta2Model::FIELDNAME_ID_ACTIVITE
                                    , ClassificationFta2Model::FIELDNAME_ID_MARQUE
                                    , 'selection_activite2'
                                    , $paramIsEditable
                    );
                    if (self::$idActivite) {
                        $bloc.=ClassificationFta2Model::getListeClassificationLabel(self::$idActivite, self::$idRayon
                                        , ClassificationFta2Model::FIELDNAME_ID_RAYON
                                        , ClassificationFta2Model::FIELDNAME_ID_ACTIVITE
                                        , 'selection_rayon2'
                                        , $paramIsEditable
                        );
                        if (self::$idRayon) {
                            $bloc.=ClassificationFta2Model::getListeClassificationLabel(self::$idRayon, self::$idEnvironnement
                                            , ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT
                                            , ClassificationFta2Model::FIELDNAME_ID_RAYON
                                            , 'selection_environnement2'
                                            , $paramIsEditable
                            );
                            if (self::$idEnvironnement) {
                                $bloc.= ClassificationFta2Model::getListeClassificationLabel(self::$idEnvironnement, self::$idReseau
                                                , ClassificationFta2Model::FIELDNAME_ID_RESEAU
                                                , ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT
                                                , 'selection_reseau2'
                                                , $paramIsEditable
                                );
                                if (self::$idReseau) {
                                    $bloc.=ClassificationFta2Model::getListeClassificationLabel(self::$idReseau, self::$idSaisonnalite
                                                    , ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE
                                                    , ClassificationFta2Model::FIELDNAME_ID_RESEAU
                                                    , 'selection_saisonnalite2'
                                                    , $paramIsEditable
                                    );
                                }
                            }
                        }
                    }
                }
            }
        }
        return $bloc;
    }

    public static function getListeClassificationLabel($paramAscendent, $paramIdDefaut, $paramSelect, $paramOrig, $paramNomDefaut, $paramIsEditable, $paramMarque2 = NULL) {
        if ($paramAscendent <> NULL) {
            $req = 'SELECT DISTINCT ' . $paramSelect
                    . ' FROM  ' . ClassificationFta2Model::TABLENAME
                    . ' WHERE  ' . $paramOrig . ' = ' . $paramAscendent;

            if (self::$idProprietaireGroupe) {
                $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE . ' = ' . self::$idProprietaireGroupe;
            }
            if (self::$idProprietaireEnseigne <> NULL) {
                $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE . ' = ' . self::$idProprietaireEnseigne;
            }
            if (self::$idMarque) {
                $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_MARQUE . ' = ' . self::$idMarque;
            }
            if (self::$idActivite) {
                $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_ACTIVITE . ' = ' . self::$idActivite;
            }
            if (self::$idRayon) {
                $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_RAYON . ' = ' . self::$idRayon;
            }
            if (self::$idEnvironnement) {
                $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT . ' = ' . self::$idEnvironnement;
            }
            if (self::$idSaisonnalite) {
                $req .= ' AND ' . ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE . ' = ' . self::$idSaisonnalite;
            }

            $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);

            foreach ($array as $value) {
                $return[] = $value[$paramSelect];
            }
        }
        $reqClassification = 'SELECT ' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME . ',' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU
                . ' FROM ' . ClassificationArborescenceArticleCategorieContenuModel::TABLENAME
                . ' WHERE ( 0 ' . ClassificationFta2Model::AddIdClassificationArborescenceArticleCategorieContenu($return)
                . ') ORDER BY ' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU
        ;

        $listeClassification = '<tr><td class=contenu >' . DatabaseDescription::getFieldDocLabel(ClassificationFta2Model::TABLENAME, $paramSelect)
                . '</td><td class=contenu width=75%>'
                . AccueilFta::afficherRequeteEnListeDeroulante($reqClassification, $paramIdDefaut, $paramNomDefaut, $paramIsEditable, TRUE) . '</tr>';

        return $listeClassification;
    }

}
