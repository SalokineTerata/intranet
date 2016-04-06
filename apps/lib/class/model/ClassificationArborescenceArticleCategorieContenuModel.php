<?php

/**
 * Description of ClassificationArborescenceArticleCategorieContenuModel
 * Table de classification arborescence des articles par categorie
 *
 * @author franckwastaken
 */
class ClassificationArborescenceArticleCategorieContenuModel extends AbstractModel {

    const TABLENAME = 'classification_arborescence_article_categorie_contenu';
    const KEYNAME = 'id_classification_arborescence_article_categorie_contenu';
    const FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE = 'id_classification_arborescence_article_categorie';
    const FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU = 'nom_classification_arborescence_article_categorie_contenu';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    /**
     * Recuperation de l'id Propriétaire Groupe de la Fta pour la page d'accueil
     * @param int $paramIdClassif
     * @param string $paramSelect
     * @return int
     */
    public static function getElementClassificationFta($paramIdClassif, $paramSelect) {
        if ($paramIdClassif) {
            $classificationFta2 = new ClassificationFta2Model($paramIdClassif);
            $idType = $classificationFta2->getIdClassificationByTypeName($paramSelect);
            $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT ' . ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU
                            . ' FROM ' . ClassificationArborescenceArticleCategorieContenuModel::TABLENAME
                            . ' WHERE ' . ClassificationArborescenceArticleCategorieContenuModel::KEYNAME . '=' . addslashes($idType)
            );
            if ($array) {
                foreach ($array as $rows) {
                    $value = $rows[ClassificationArborescenceArticleCategorieContenuModel::FIELDNAME_NOM_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU];
                }
            }
        }
        return $value;
    }

    protected function setDefaultValues() {
        
    }

    /**
     * Affiche le tableau d'ajout d'une famille de ventes à une activité de classification
     * @param string $paramIdElement
     * @return string
     */
    public static function getHtmlTableClassificationElement($paramIdElement) {
        $ClassificationElement = self::getArrayIdClassificationElementByIdElement($paramIdElement);

        if ($ClassificationElement) {
            $arrayClassificationElementtmp = array();
            $tablesNameAndIdForeignKeyOfElementtmp = array();

            foreach ($ClassificationElement as $rowsClassificationElement) {
                $idClassificationElements = $rowsClassificationElement[self::KEYNAME];

                $arrayIdClassificationElements[] = $idClassificationElements;


                $ClassificationArborescenceArticleCategorieContenuModel = new ClassificationArborescenceArticleCategorieContenuModel($idClassificationElements);

                /*
                 * Tableau de données
                 */
                $arrayClassificationElementTmp = $ClassificationArborescenceArticleCategorieContenuModel->getArrayClassificationActiviteFamilleVentesArcadia();

                $arrayClassificationElements = array_replace_recursive($arrayClassificationElementtmp, $arrayClassificationElementTmp);

                $arrayClassificationElementtmp = $arrayClassificationElements;

                /*
                 * Cette array doit être utilisé de cette manière 
                 * Array (
                 * nom de table,
                 * clé étrangère de la table présenté
                 * valeur de la clé étrangère);
                 */
                $tablesNameAndIdForeignKeyOfClassificationElementTmp = $ClassificationArborescenceArticleCategorieContenuModel->getTablesNameAndIdForeignkeyOfClassificationActiviteFamilleVentesArcadia();


                $tablesNameAndIdForeignKeyOfClassificationElement = ($tablesNameAndIdForeignKeyOfElementtmp + $tablesNameAndIdForeignKeyOfClassificationElementTmp);
                $tablesNameAndIdForeignKeyOfElementtmp = $tablesNameAndIdForeignKeyOfClassificationElement;
                /*
                 * Vérifie si pour la Fta en cours les données ClassificationGammeFamilleBudgett sont renseigné
                 */
                if ($arrayClassificationElements) {
                    $rightToAdd = Chapitre::NOT_EDITABLE;
                } else {
                    $rightToAdd = Chapitre::EDITABLE;
                }
            }
            /**
             * Labels
             */
            $className = $ClassificationArborescenceArticleCategorieContenuModel->getClassName();
            $label = $ClassificationArborescenceArticleCategorieContenuModel->getDataField(self::FIELDNAME_ID_ARCADIA_FAMILLE_VENTE)->getFieldLabel();


            /**
             * Initilisation du tableau html
             */
            $htmlClassificationActiviteFamilleVentesArcadia = new HtmlSubForm_RNN($arrayClassificationElements, $className, $label, $tablesNameAndIdForeignKeyOfClassificationElement);
            $htmlClassificationActiviteFamilleVentesArcadia->setIsEditable(Chapitre::EDITABLE);
            $htmlClassificationActiviteFamilleVentesArcadia->setRightToAdd($rightToAdd);
            $htmlClassificationActiviteFamilleVentesArcadia->setLienAjouter(self::getAddLinkAfterClassificationActiviteFamilleVentesArcadia($paramIdActivite));
            $htmlClassificationActiviteFamilleVentesArcadia->setLien(self::getAddLinkBeforeClassificationActiviteFamilleVentesArcadia($paramIdActivite));
            $htmlClassificationActiviteFamilleVentesArcadia->setLienSuppression(self::getDeleteLinkClassificationActiviteFamilleVentesArcadia($paramIdActivite, $arrayIdClassificationElements));
            $htmlClassificationActiviteFamilleVentesArcadia->setTableLabel($ClassificationArborescenceArticleCategorieContenuModel->getTableClassificationActiviteFamilleVentesArcadiaLabel());
            $return .= $htmlClassificationActiviteFamilleVentesArcadia->getHtmlResult();
        } else {
            /*
             * Initialisation des modèles 
             */
            $label = self::LABEL_CLASSIFICATION_ACTIVITE_FAMILLE_VENTES;

            $htmlClassificationActiviteFamilleVentesArcadia = new HtmlSubForm_RNN($arrayClassificationElements, $className, $label, $tablesNameAndIdForeignKeyOfClassificationElement);
            $htmlClassificationActiviteFamilleVentesArcadia->setIsEditable(Chapitre::EDITABLE);
            $htmlClassificationActiviteFamilleVentesArcadia->setRightToAdd(Chapitre::EDITABLE);
            $htmlClassificationActiviteFamilleVentesArcadia->setLien(self::getAddLinkBeforeClassificationActiviteFamilleVentesArcadia($paramIdActivite));
            $return .= $htmlClassificationActiviteFamilleVentesArcadia->getHtmlResult();
        }
        return $return;
    }

    /**
     * Retour la liste des IdClassificationElement pour un elemnt donnée
     * @param int $paramIdElement
     * @return array
     */
    private static function getArrayIdClassificationElementByIdElement($paramIdElement) {

        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . self::KEYNAME
                        . " FROM " . self::TABLENAME
                        . " WHERE " . self::FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE . "=" . $paramIdElement
        );

        return $array;
    }

}
