<?php

/**
 * Description of AnnexeEmballage
 * Table des AnnexeEmballage
 *
 * @author franckwastaken
 */
class AnnexeEmballageModel extends AbstractModel {

    const TABLENAME = 'annexe_emballage';
    const KEYNAME = 'id_annexe_emballage';
    const FIELDNAME_ID_FTE_FOURNISSEUR = 'id_fte_fournisseur';
    const FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE = 'id_annexe_emballage_groupe';
    const FIELDNAME_ID_ARCADIA_TYPE_CARTON = 'id_arcadia_type_carton';
    const FIELDNAME_REFERENCE_FOURNISSEUR_ANNEXE_EMBALLAGE = 'reference_fournisseur_annexe_emballage';
    const FIELDNAME_POIDS_ANNEXE_EMBALLAGE = 'poids_annexe_emballage';
    const FIELDNAME_LONGUEUR_ANNEXE_EMBALLAGE = 'longueur_annexe_emballage';
    const FIELDNAME_LARGEUR_ANNEXE_EMBALLAGE = 'largeur_annexe_emballage';
    const FIELDNAME_HAUTEUR_ANNEXE_EMBALLAGE = 'hauteur_annexe_emballage';
    const FIELDNAME_EPAISSEUR_ANNEXE_EMBALLAGE = 'epaisseur_annexe_emballage';
    const FIELDNAME_ACTIF_ANNEXE_EMBALLAGE = 'actif_annexe_emballage';
    const FIELDNAME_QUANTITE_PAR_COUCHE_ANNEXE_EMBALLAGE = 'quantite_par_couche_annexe_emballage';
    const FIELDNAME_NOMBRE_COUCHE_ANNEXE_EMBALLAGE = 'nombre_couche_annexe_emballage';
    const FIELDNAME_DATE_MAJ_ANNEXE_EMBALLAGE = 'date_maj_annexe_emballage';
    const ID_ANNEXE_EMBALLAGE_PALETTE = '126';

    /**
     * ArcadiaTypeCarton associée
     * @var ArcadiaTypeCartonModel
     */
    private $modelArcadiaTypeCarton;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);


        $this->setModelArcadiaTypeCarton(
                new ArcadiaTypeCartonModel($this->getDataField(self::FIELDNAME_ID_ARCADIA_TYPE_CARTON)->getFieldValue()));
    }

    /**
     * 
     * @return ArcadiaTypeCartonModel
     */
    function getModelArcadiaTypeCarton() {
        return $this->modelArcadiaTypeCarton;
    }

    /**
     * 
     * @param ArcadiaTypeCartonModel $modelArcadiaTypeCarton
     */
    function setModelArcadiaTypeCarton(ArcadiaTypeCartonModel $modelArcadiaTypeCarton) {
        $this->modelArcadiaTypeCarton = $modelArcadiaTypeCarton;
    }

    protected function setDefaultValues() {
        
    }

      
    /**
     * On récupère IdAnnexeEmballage en fonction de l'emballage groupe
     * @param int $paramIdEmballageGroupe
     * @return array
     */
    public static function getArrayIdAnnexeEmballage($paramIdEmballageGroupe) {

        $req = 'SELECT DISTINCT ' . AnnexeEmballageModel::TABLENAME . '.' . AnnexeEmballageModel::KEYNAME
                . ' FROM ' . AnnexeEmballageGroupeModel::TABLENAME . ',' . AnnexeEmballageModel::TABLENAME . ' WHERE ( 0 ';

        $req .= AnnexeEmballageGroupeModel::AddIdAnnexeEmballageGroupe($paramIdEmballageGroupe);

        $req .= ') AND ' . AnnexeEmballageGroupeModel::TABLENAME . '.' . AnnexeEmballageGroupeModel::KEYNAME
                . '=' . AnnexeEmballageModel::TABLENAME . '.' . AnnexeEmballageModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE;

        $arrayIdAnnexeEmballage = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
        if ($arrayIdAnnexeEmballage) {
            foreach ($arrayIdAnnexeEmballage as $rowsIdAnnexeEmballage) {
                $arrayidAnnexeEmballage[] = $rowsIdAnnexeEmballage[AnnexeEmballageModel::KEYNAME];
            }
        } else {
            $arrayidAnnexeEmballage = 0;
        }

        return $arrayidAnnexeEmballage;
    }

    /**
     * On obtient le tableau des emballage en fonction de son groupe
     * @param int $paramIdEmballageGroupe
     * @return array
     */
    public static function getArrayAnnexeEmballage($paramIdEmballageGroupe) {

        $req = 'SELECT DISTINCT ' . AnnexeEmballageModel::KEYNAME
                . ',' . AnnexeEmballageModel::FIELDNAME_LARGEUR_ANNEXE_EMBALLAGE
                . ',' . AnnexeEmballageModel::FIELDNAME_HAUTEUR_ANNEXE_EMBALLAGE
                . ',' . AnnexeEmballageModel::FIELDNAME_NOMBRE_COUCHE_ANNEXE_EMBALLAGE
                . ',' . AnnexeEmballageModel::FIELDNAME_POIDS_ANNEXE_EMBALLAGE
                . ',' . AnnexeEmballageModel::TABLENAME . '.' . AnnexeEmballageModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE
                . ',' . AnnexeEmballageModel::FIELDNAME_QUANTITE_PAR_COUCHE_ANNEXE_EMBALLAGE
                . ' FROM ' . AnnexeEmballageGroupeModel::TABLENAME . ',' . AnnexeEmballageModel::TABLENAME . ' WHERE ( 0 ';

        $req .= AnnexeEmballageGroupeModel::AddIdAnnexeEmballageGroupe($paramIdEmballageGroupe);

        $req .= ') AND ' . AnnexeEmballageGroupeModel::TABLENAME . '.' . AnnexeEmballageGroupeModel::KEYNAME
                . '=' . AnnexeEmballageModel::TABLENAME . '.' . AnnexeEmballageModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE;


        $array = DatabaseOperation::convertSqlStatementWithKeyAsFirstFieldToArray($req);

        return $array;
    }

    public static function AddIdAnnexeEmballage($paramIdEmballage) {
        if ($paramIdEmballage) {
            foreach ($paramIdEmballage as $value) {
                $req .= ' OR ' . AnnexeEmballageModel::KEYNAME . '=' . $value . ' ';
            }
        }
        return $req;
    }

    /**
     * Valeurs par défaut en cas de création
     * d'un nouvel enregistrement
     * @return mixed
     */
    static public function createNewRecordset($paramForeignKeysValuesArray = NULL) {


        $pdo = DatabaseOperation::executeComplete(
                        'INSERT INTO ' . AnnexeEmballageModel::TABLENAME
                        . '(' . AnnexeEmballageModel::FIELDNAME_ID_FTE_FOURNISSEUR . ')'
                        . 'VALUES (' . $paramForeignKeysValuesArray[AnnexeEmballageModel::FIELDNAME_ID_FTE_FOURNISSEUR] . ')'
        );
        $key = $pdo->lastInsertId();
        return $key;
    }

    /**
     * Suppression d'une donnée de la table Annexe emballage par son identifiant
     * @param type $paramIdAnnexeEmballage
     * @return type
     */
    public static function deleteAnnexeEmballage($paramIdAnnexeEmballage) {
        return DatabaseOperation::execute(
                        ' DELETE FROM ' . self::TABLENAME . ' WHERE ' .
                        self::KEYNAME . '=' . $paramIdAnnexeEmballage);
    }

}

?>