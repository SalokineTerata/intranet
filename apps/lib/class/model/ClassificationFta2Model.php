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

    public static function getListeClassificationProprietaireGroupe($paramIdDefaut) {
        $req = 'SELECT ' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME . ',' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU
                . ' FROM ' . ClassificationArborescenceArticleCategorieContenuModel::TABLENAME
                . ' WHERE ' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE . '=' . AccueilFta::VALUE_1
                . ' AND ' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME . '<>' . AccueilFta::VALUE_0
                . ' ORDER BY ' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU;

        $paramNomDefaut = 'selection_proprietaire1';

        return AccueilFta::afficherRequeteEnListeDeroulante($req, $paramIdDefaut, $paramNomDefaut);
    }

    public static function getListeClassification($paramAscendent, $paramIdDefaut, $paramSelect, $paramOrig, $paramNomDefaut, $paramMarque2 = NULL) {
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

        $Liste .= AccueilFta::afficherRequeteEnListeDeroulante($reqListe, $paramIdDefaut, $paramNomDefaut);
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
     * On obtient le droit de modification pour le module Classification de l'utilisateur connecté
     * @param int $paramIdUser
     * @return int
     */
    public static function getClassificationModification($paramIdUser) {
        $arrayModification = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        ' SELECT ' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES
                        . ' FROM ' . IntranetDroitsAccesModel::TABLENAME
                        . ' WHERE ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $paramIdUser
                        . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . '=' . AccueilFta::VALUE_2
                        . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES . '=18'
        );
        foreach ($arrayModification as $rowsModifications) {
            $fta_modification = $rowsModifications[IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES];
        }
        return $fta_modification;
    }

    public static function getClassificationListeSansDependance($paramIdDefaut, $paramIdTypeClassification, $paramNomDefaut) {
        $req = ' SELECT ' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME
                . ',' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU
                . ' FROM ' . ClassificationArborescenceArticleCategorieContenuModel::TABLENAME
                . ' WHERE ' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE . '=' . $paramIdTypeClassification
                . ' ORDER BY ' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU
        ;

        return AccueilFta::afficherRequeteEnListeDeroulante($req, $paramIdDefaut, $paramNomDefaut);
    }

    public static function InsertClassification() {
        $pdo = DatabaseOperation::execute(
                        'INSERT INTO ' . ClassificationFta2Model::TABLENAME
        );
        $key = $pdo->lastInsertId();

        return $key;
    }

    public static function SuppressionClassification($paramIdClassification2) {
        DatabaseOperation::execute(
                'DELETE FROM ' . ClassificationFta2Model::TABLENAME
                . ' WHERE ' . ClassificationFta2Model::KEYNAME . '=' . $paramIdClassification2
        );
    }

}
