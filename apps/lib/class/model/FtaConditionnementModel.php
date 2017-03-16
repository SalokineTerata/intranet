<?php

/**
 * Description of FtaConditionnementModel
 * Table des FtaConditionnementModel
 *
 * @author franckwastaken
 */
class FtaConditionnementModel extends AbstractModel {

    const TABLENAME = 'fta_conditionnement';
    const KEYNAME = 'id_fta_conditionnement';
    const FIELDNAME_ID_FTA = 'id_fta';
    const FIELDNAME_LAST_ID_FTA_CONDITIONNEMENT = 'last_id_fta_conditionnement';
    const FIELDNAME_HAUTEUR_EMBALLAGE_FTA_CONDITIONNEMENT = 'hauteur_emballage_fta_conditionnement';
    const FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT = 'hauteur_fta_conditionnement';
    const FIELDNAME_ID_ANNEXE_EMBALLAGE = 'id_annexe_emballage';
    const FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE = 'id_annexe_emballage_groupe';
    const FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE = 'id_annexe_emballage_groupe_type';
    const FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT = 'largeur_fta_conditionnement';
    const FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT = 'longueur_fta_conditionnement';
    const FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT = 'nombre_couche_fta_conditionnement';
    const FIELDNAME_POIDS_FTA_CONDITIONNEMENT = 'poids_fta_conditionnement';
    const FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT = 'quantite_par_couche_fta_conditionnement';
    const FIELDNAME_VIRTUAL_HAUTEUR_FTA_CONDITIONNEMENT = 'VIRTUAL_hauteur_fta_conditionnement';
    const FIELDNAME_VIRTUAL_LARGEUR_FTA_CONDITIONNEMENT = 'VIRTUAL_largeur_fta_conditionnement';
    const FIELDNAME_VIRTUAL_LONGUEUR_FTA_CONDITIONNEMENT = 'VIRTUAL_longueur_fta_conditionnement';
    const FIELDNAME_VIRTUAL_NOMBRE_COUCHE_FTA_CONDITIONNEMENT = 'VIRTUAL_nombre_couche_fta_conditionnement';
    const FIELDNAME_VIRTUAL_POIDS_FTA_CONDITIONNEMENT = 'VIRTUAL_poids_fta_conditionnement';
    const FIELDNAME_VIRTUAL_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT = 'VIRTUAL_quantite_par_couche_fta_conditionnement';
    const FIELDNAME_VIRTUAL_REFERENCE_FOURNISSEUR_FTA_CONDITIONNEMENT = 'VIRTUAL_reference_fournisseur_fta_conditionnement';
    const FIELDNAME_VIRTUAL_NOM_FTA_CONDITIONNEMENT_GROUPE = 'VIRTUAL_nom_fta_conditionnement_groupe';
    const EMBALLAGES_UVF = '1';
    const EMBALLAGES_PAR_COLIS = '2';
    const EMBALLAGES_DU_COLIS = '3';
    const EMBALLAGES_PALETTE = '4';
    const UVC_EMBALLAGE = 'uvc_emballage';
    const UVC_EMBALLAGE_TYPE_1 = 'uvc_emballage_1';
    const UVC_EMBALLAGE_NET = 'uvc_net';
    const UVC_EMBALLAGE_BRUT = 'uvc_brut';
    const UVC_EMBALLAGE_DIMENSION = 'dimension_uvc';
    const UVC_EMBALLAGE_DIMENSION_HAUTEUR = 'dimension_uvc_hauteur';
    const UVC_EMBALLAGE_DIMENSION_LONGUEUR = 'dimension_uvc_longueur';
    const UVC_EMBALLAGE_DIMENSION_LARGEUR = 'dimension_uvc_largeur';
    const UVC_EMBALLAGE_DIMENSION_LABEL = 'Dimension de l\'UVF (en mm):';
    const UVC_EMBALLAGE_EMBALLAGE_POIDS_LABEL = 'Poids des Emballages (en g)';
    const COLIS_EMBALLAGE = 'colis_emballage';
    const COLIS_EMBALLAGE_TYPE_2 = 'colis_emballage_2';
    const COLIS_EMBALLAGE_TYPE_3 = 'colis_emballage_3';
    const COLIS_EMBALLAGE_NET = 'colis_net';
    const COLIS_EMBALLAGE_BRUT = 'colis_brut';
    const COLIS_EMBALLAGE_HAUTEUR = 'hauteur_colis';
    const PALETTE_EMBALLAGE = 'palette_emballage';
    const PALETTE_EMBALLAGE_NET = 'palette_net';
    const PALETTE_EMBALLAGE_BRUT = 'palette_brut';
    const PALETTE_EMBALLAGE_HAUTEUR = 'hauteur_palette';
    const PALETTE_EMBALLAGE_HAUTEUR_LABEL = 'Hauteur (en m)';
    const PALETTE_NOMBRE_DE_COUCHE = 'couche_palette';
    const PALETTE_NOMBRE_COLIS_PAR_COUCHE = 'colis_couche';
    const PALETTE_NOMBRE_TOTAL_PAR_CARTON = 'total_colis';
    const PALETTE_NOMBRE_TOTAL_PAR_CARTON_LABEL = 'Nombre total de Carton par palette';
    const FONCTIONNAME_VERSIONNING = 'setDataFtaConditionnementTableToCompare';

    /**
     * FTA associée
     * @var FtaModel
     */
    private $modelFta;

    /**
     * AnnexEmballage associée
     * @var AnnexeEmballageModel
     */
    private $modelAnnexeEmballage;

    /**
     * Nom de la fonction de gestion des versions
     */
    private $nameDataTableToCompare;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);

        $this->setModelFtaById(
                $this->getDataField(self::FIELDNAME_ID_FTA)->getFieldValue());
        $this->setModelAnnexeEmballage(
                new AnnexeEmballageModel($this->getDataField(self::FIELDNAME_ID_ANNEXE_EMBALLAGE)->getFieldValue()));

        $this->setNameDataTableToCompare();
    }

    protected function setDefaultValues() {
        
    }

    function getNameDataTableToCompare() {
        return $this->nameDataTableToCompare;
    }

    function setNameDataTableToCompare() {
        $this->nameDataTableToCompare = self::FONCTIONNAME_VERSIONNING;
    }

    /**
     * 
     * @return AnnexeEmballageModel
     */
    function getModelAnnexeEmballage() {
        return $this->modelAnnexeEmballage;
    }

    /**
     * 
     * @param AnnexeEmballageModel $modelAnnexeEmballage
     */
    function setModelAnnexeEmballage(AnnexeEmballageModel $modelAnnexeEmballage) {
        $this->modelAnnexeEmballage = $modelAnnexeEmballage;
    }

    public function setModelFtaById($id) {
        $this->getDataField(self::FIELDNAME_ID_FTA)->setFieldValue($id);
        $this->setModelFta(
                new FtaModel(
                $this->getDataField(self::FIELDNAME_ID_FTA)->getFieldValue()
                , DatabaseRecord::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST)
        );
    }

    function getModelFta() {
        return $this->modelFta;
    }

    function setModelFta(FtaModel $modelFta) {
        $this->modelFta = $modelFta;
    }

    /**
     * On récupère le DataRecord à comparer 
     * @param DatabaseRecord $paramRecordToCompare
     */
    function setDataToCompare($paramRecordToCompare) {
        parent::setDataToCompare($paramRecordToCompare);
    }

    /**
     * On initialise l'idFta à comparer de la version actuelle du FtaModel 
     */
    function setDataFtaConditionnementTableToCompare() {

        $idFtaConditionnmentToCompare = $this->getIdFtaConditionnementToCompare();

        $DataRecord = new DatabaseRecord(self::TABLENAME, $idFtaConditionnmentToCompare);

        $this->setDataToCompare($DataRecord);
    }

    function getIdFtaConditionnementToCompare() {
        $currentIdFtaConditionnement = $this->getKeyValue();

        $currentIdFta = $this->getModelFta()->getKeyValue();
        $arrayIdFtaDossierAndVersion = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT " . FtaModel::FIELDNAME_VERSION_DOSSIER_FTA . "," . FtaModel::FIELDNAME_DOSSIER_FTA
                        . " FROM " . FtaModel::TABLENAME
                        . " WHERE " . FtaModel::KEYNAME . "=" . $currentIdFta
        );
        foreach ($arrayIdFtaDossierAndVersion as $rowsIdFtaDossierAndVersion) {
            $idFtaVersion = $rowsIdFtaDossierAndVersion[FtaModel::FIELDNAME_VERSION_DOSSIER_FTA];
        }
        if ($idFtaVersion <> "0") {
            $arrayIdFta = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            "SELECT " . self::FIELDNAME_LAST_ID_FTA_CONDITIONNEMENT
                            . " FROM " . self::TABLENAME
                            . " WHERE " . self::KEYNAME . "=" . $currentIdFtaConditionnement
            );

            foreach ($arrayIdFta as $rowsIdFta) {
                $idFtaConditionnementToCompare = $rowsIdFta[self::FIELDNAME_LAST_ID_FTA_CONDITIONNEMENT];
            }
        } else {
            $idFtaConditionnementToCompare = $currentIdFtaConditionnement;
        }

        return $idFtaConditionnementToCompare;
    }

    /**
     * On obtient la liste des emballages
     * @param int $paramIdFta
     * @return array
     */
    public static function getArrayIdFtaConditionnement($paramIdFta) {
        $arrayIdFtaConditionnement = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . self::KEYNAME
                        . ' FROM ' . self::TABLENAME
                        . ' WHERE ' . self::FIELDNAME_ID_FTA . '=' . $paramIdFta
        );
        return $arrayIdFtaConditionnement;
    }

    /**
     * Calcul du poids de l'emballage  par UVC
     * @param type $paramPoidsEmballageUnitaire
     * @param type $paramQuantiteCouche
     * @param type $paramNombreCouche
     * @return type
     */
    static function getCalculPoidsEmballage($paramPoidsEmballageUnitaire, $paramQuantiteCouche, $paramNombreCouche) {
        return $paramPoidsEmballageUnitaire * $paramQuantiteCouche * $paramNombreCouche;
    }

    /**
     * Calcul des dimensions de l'emballage  par UVC
     * @param type $paramDimensionEmballageHauteur
     * @param type $paramDimensionEmballageHauteurRow
     * @param type $paramDimensionEmballageLongueur
     * @param type $paramDimensionEmballageLongueurRow
     * @param type $paramDimensionEmballageLargeur
     * @param type $paramDimensionEmballageLargeurRow
     * @return type
     */
    static function getCalculDimensionEmballageUvc($paramDimensionEmballageHauteur, $paramDimensionEmballageHauteurRow, $paramDimensionEmballageLongueur, $paramDimensionEmballageLongueurRow, $paramDimensionEmballageLargeur, $paramDimensionEmballageLargeurRow) {

        //Calcul des dimension de l'emballage par UVC  (on recherche la taille la plus grande)
        if ($paramDimensionEmballageHauteur < $paramDimensionEmballageHauteurRow) {
            $paramDimensionEmballageHauteur = $paramDimensionEmballageHauteurRow;
        }
        if ($paramDimensionEmballageLongueur < $paramDimensionEmballageLongueurRow) {
            $paramDimensionEmballageLongueur = $paramDimensionEmballageLongueurRow;
        }
        if ($paramDimensionEmballageLargeur < $paramDimensionEmballageLargeurRow) {
            $paramDimensionEmballageLargeur = $paramDimensionEmballageLargeurRow;
        }
        return $paramDimensionEmballageLongueur . 'x' . $paramDimensionEmballageLargeur . 'x' . $paramDimensionEmballageHauteur;
    }

    /**
     * Calcul de la hauteur de l'emballage  par Palette
     * @param type $paramHauteurFtaConditionnement
     * @param type $paramCouchePalette
     * @return type
     */
    static function getCalculHauteurEmballagePalette($paramHauteurFtaConditionnement, $paramCouchePalette, $paramHauteurFtaConditionnementPalette) {
        return (($paramHauteurFtaConditionnement * $paramCouchePalette ) + $paramHauteurFtaConditionnementPalette ) / 1000;
    }

    /**
     * Calcul du poids brut de l'emballage
     * @param type $paramPoidsNet
     * @param type $paramPoidsEmballage
     * @return type
     */
    static function getCalculPoidsBrutEmballage($paramPoidsNet, $paramPoidsEmballage) {
        return $paramPoidsNet + $paramPoidsEmballage;
    }

    /**
     * Calcul du poids brut de l'emballage Colis
     * @param type $paramPoidsNet
     * @param type $paramPoidsEmballage
     * @return type
     */
    static function getCalculPoidsBrutEmballageColis($paramPoidsNet, $paramPoidsEmballage) {
        return $paramPoidsNet + ($paramPoidsEmballage / 1000);
    }

    /**
     * Calcul du poids de l'emballage par palette
     * @param int $paramPoidsFta
     * @param int $paramNombreColisCouche
     * @param int $paramNombreCouchePalette
     * @param int $paramQuantiteCouche
     * @param int $paramNombreCouche
     * @return string
     */
    static function getCalculPoidsEmballagePalette($paramPoidsFta, $paramNombreColisCouche, $paramNombreCouchePalette, $paramQuantiteCouche, $paramNombreCouche) {
        return ($paramPoidsFta / 1000) * $paramNombreColisCouche * $paramNombreCouchePalette * ($paramQuantiteCouche * $paramNombreCouche);
    }

    /**
     * Multiplication
     * @param int $param
     * @param int $paramb
     * @return string
     */
    static function getCalculGenericMultiplication($param, $paramb) {
        return $param * $paramb;
    }

    /**
     * On obtient les id Fta Conditionnement selon le type d'emballage par emballage type et annexe emballage type
     * @param type $paramArrayIdAnnexeEmballage
     * @param type $paramIdFta
     * @return int
     */
    public static function getIdFtaConditionnementByArrayIdAnnexeEmballageAndIdFtaAndIdEmballageGroupeType($paramArrayIdAnnexeEmballage, $paramIdFta, $paramIdEmballageGroupeType) {

        $req = 'SELECT DISTINCT ' . self::KEYNAME
                . ' FROM ' . self::TABLENAME
                . ' WHERE ( 0 ';

        $req .=AnnexeEmballageModel::AddIdAnnexeEmballage($paramArrayIdAnnexeEmballage);

        $req .= ') AND ' . self::FIELDNAME_ID_FTA . '=' . $paramIdFta
                . ' AND ' . self::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . '=' . $paramIdEmballageGroupeType
        ;

        $arrayIdFtaConditionnement = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
        if ($arrayIdFtaConditionnement) {
            foreach ($arrayIdFtaConditionnement as $rowsIdFtaConditionnement) {
                $IdFtaConditionnement[] = $rowsIdFtaConditionnement[self::KEYNAME];
            }
        } else {
            $IdFtaConditionnement = 0;
        }

        return $IdFtaConditionnement;
    }

    /**
     *  On obtient l' id Annexe Emballage de type UVC selon l'id fta et id fta conditionnement
     * @param type $paramIdFtaConditionnement
     * @param type $paramIdFta
     * @return int
     */
    public static function getIdAnnexeEmballageFromFtaConditionnement($paramIdFtaConditionnement, $paramIdFta) {

        $req = 'SELECT DISTINCT ' . self::FIELDNAME_ID_ANNEXE_EMBALLAGE
                . ' FROM ' . self::TABLENAME
                . ' WHERE ' . self::KEYNAME . '=' . $paramIdFtaConditionnement
                . '  AND ' . self::FIELDNAME_ID_FTA . '=' . $paramIdFta
        ;

        $arrayIdAnnexeEmballage = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
        if ($arrayIdAnnexeEmballage) {
            foreach ($arrayIdAnnexeEmballage as $rowsIdAnnexeEmballage) {
                $IdAnnexeEmballage = $rowsIdAnnexeEmballage[self::FIELDNAME_ID_ANNEXE_EMBALLAGE];
            }
        } else {
            $IdAnnexeEmballage = 0;
        }

        return $IdAnnexeEmballage;
    }

    /**
     * On obtient l' id Annexe Emballage groupe type de type UVC selon l'id fta et id fta conditionnement
     * @param type $paramIdFtaConditionnement
     * @param type $paramIdFta
     * @return int
     */
    public static function getIdAnnexeEmballageAndGroupeTypeAndGroupeAndIdFtaConditionnementFromFtaConditionnement($paramIdFtaConditionnement, $paramIdFta) {

        $req = 'SELECT DISTINCT ' . self::KEYNAME
                . ',' . self::FIELDNAME_ID_ANNEXE_EMBALLAGE
                . ',' . self::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                . ' FROM ' . self::TABLENAME
                . ' WHERE ( 0 ' . self::addIdFtaConditionnement($paramIdFtaConditionnement)
                . ' ) AND ' . self::FIELDNAME_ID_FTA . '=' . $paramIdFta
        ;

        $arrayIdAnnexeEmballageGroupe = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);

        return $arrayIdAnnexeEmballageGroupe;
    }

    /**
     * Tableau de données, convertie le nom des champs des données aux noms des champs virtuel qui leur corresponds
     * @param type $paramIdFtaConditionnement
     * @return int
     */
    function getArrayFtaConditonnement() {

        $array[$this->getKeyValue()] = array(
            self::FIELDNAME_VIRTUAL_NOM_FTA_CONDITIONNEMENT_GROUPE => $this->getDataField(self::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE)->getFieldValue(),
            self::FIELDNAME_VIRTUAL_REFERENCE_FOURNISSEUR_FTA_CONDITIONNEMENT => $this->getDataField(self::FIELDNAME_ID_ANNEXE_EMBALLAGE),
            self::FIELDNAME_VIRTUAL_LONGUEUR_FTA_CONDITIONNEMENT => $this->getDataField(self::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT)->getFieldValue(),
            self::FIELDNAME_VIRTUAL_LARGEUR_FTA_CONDITIONNEMENT => $this->getDataField(self::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT)->getFieldValue(),
            self::FIELDNAME_VIRTUAL_HAUTEUR_FTA_CONDITIONNEMENT => $this->getDataField(self::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT)->getFieldValue(),
            self::FIELDNAME_VIRTUAL_POIDS_FTA_CONDITIONNEMENT => $this->getDataField(self::FIELDNAME_POIDS_FTA_CONDITIONNEMENT)->getFieldValue(),
            self::FIELDNAME_VIRTUAL_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT => $this->getDataField(self::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT)->getFieldValue()
        );

        return $array;
    }

    /*

     */

    /**
     * On identifie les clé étrangères sur lesquelle on veut enregistrer les donnée cad FtaConditionnement
     * Cette array doit être utilisé de cette manière 
     * Array (
     * nom de table,
     * clé étrangère de la table présenté
     * valeur de la clé étrangère);
     * @param int $paramIdFta
     * @param int $paramIdAnnexeEmballage
     * @param int $paramIdAnnexeEmballageGroupeType
     * @param int $paramIdFtaConditionnement
     * @return array
     */
    public static function getTablesNameAndIdForeignKeyOfFtaConditionnement($paramIdFta, $paramIdAnnexeEmballage, $paramIdAnnexeEmballageGroupeType, $paramIdFtaConditionnement) {
        $tablesNameAndIdForeignKeyOfFtaConditionnement[$paramIdFtaConditionnement] = array(
            array(AnnexeEmballageModel::TABLENAME, self::FIELDNAME_ID_ANNEXE_EMBALLAGE, $paramIdAnnexeEmballage),
            array(AnnexeEmballageGroupeTypeModel::TABLENAME, self::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE, $paramIdAnnexeEmballageGroupeType),
            array(FtaModel::TABLENAME, self::FIELDNAME_ID_FTA, $paramIdFta),
        );

        return $tablesNameAndIdForeignKeyOfFtaConditionnement;
    }

    /**
     * Affiche le label du tableau Embalage
     * @param int $paramTypeQuant
     * @return string
     */
    function getTableConditionnementLabel($paramTypeQuant) {
        $border = "style=\"border:1px solid #000;\"";

        if ($this->getIsEditable()) {
            $action = '<td ' . $border . '>Actions</td>';
        } else {
            $action = '';
        }
        switch ($paramTypeQuant) {
            case AnnexeEmballageGroupeTypeModel::EMBALLAGE_UVC:
                $quantite = "Quantité par UVF";

                break;
            case AnnexeEmballageGroupeTypeModel::EMBALLAGE_PAR_COLIS:
                $quantite = "Quantité par Colis";

                break;
            case AnnexeEmballageGroupeTypeModel::EMBALLAGE_PALETTE:
                $quantite = "Quantité";

                break;
        }

        return '<tr class=titre_tableau  align=center >' .
                '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_ID_ANNEXE_EMBALLAGE)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_POIDS_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>' . $quantite . '</td>'
                . $action
                . '</tr>';
    }

    /**
     * Affiche le label de l'emballage colis
     * @param int $paramIdFtaConditionnment
     * @return string
     */
    function getTableConditionnementLabelDuColis() {
        $border = "style=\"border:1px solid #000;\"";

        if ($this->getIsEditable()) {
            $action = '<td ' . $border . '>Actions</td>';
        } else {
            $action = '';
        }


        return '<tr class=titre_tableau >' .
                '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_ID_ANNEXE_EMBALLAGE)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_POIDS_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . '<td ' . $border . '>' . $this->getDataField(self::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . $action
                . '</tr>';
    }

    /**
     * Tableau de données, convertie le nom des champs des données aux noms des champs virtuel qui leur corresponds
     * @param type $paramIdFtaConditionnement
     * @return int
     */
    function getArrayFtaConditonnementDuColis() {


        $array[$this->getKeyValue()] = array(
            self::FIELDNAME_VIRTUAL_NOM_FTA_CONDITIONNEMENT_GROUPE => $this->getDataField(self::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE)->getFieldValue(),
            self::FIELDNAME_VIRTUAL_REFERENCE_FOURNISSEUR_FTA_CONDITIONNEMENT => $this->getDataField(self::FIELDNAME_ID_ANNEXE_EMBALLAGE)->getFieldValue(),
            self::FIELDNAME_VIRTUAL_LONGUEUR_FTA_CONDITIONNEMENT => $this->getDataField(self::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT)->getFieldValue(),
            self::FIELDNAME_VIRTUAL_LARGEUR_FTA_CONDITIONNEMENT => $this->getDataField(self::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT)->getFieldValue(),
            self::FIELDNAME_VIRTUAL_HAUTEUR_FTA_CONDITIONNEMENT => $this->getDataField(self::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT)->getFieldValue(),
            self::FIELDNAME_VIRTUAL_POIDS_FTA_CONDITIONNEMENT => $this->getDataField(self::FIELDNAME_POIDS_FTA_CONDITIONNEMENT)->getFieldValue(),
            self::FIELDNAME_VIRTUAL_NOMBRE_COUCHE_FTA_CONDITIONNEMENT => $this->getDataField(self::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT)->getFieldValue(),
            self::FIELDNAME_VIRTUAL_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT => $this->getDataField(self::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT)->getFieldValue()
        );


        return $array;
    }

    /**
     * Fonction qui ajoute un nouvel conditionnement
     * @param type $paramIdFta
     * @param type $paramIdAnnexeEmballage
     * @param type $paramIdAnnexeEmballageGroupe
     * @param type $paramIdAnnexeEmballageGroupeType
     * @param type $paramHauteurFtaConditionnement
     * @param type $paramLongeurFtaConditionnement
     * @param type $paramLargeurFtaConditionnement
     * @param type $paramPoidsFtaConditionnement
     * @param type $paramNbCoucheFtaConditionnement
     * @param type $paramQteCoucheFtaConditionnement
     * @return type
     */
    public static function addFtaConditionnement($paramIdFta, $paramIdAnnexeEmballage, $paramIdAnnexeEmballageGroupe, $paramIdAnnexeEmballageGroupeType, $paramHauteurFtaConditionnement, $paramLongeurFtaConditionnement, $paramLargeurFtaConditionnement, $paramPoidsFtaConditionnement, $paramNbCoucheFtaConditionnement, $paramQteCoucheFtaConditionnement) {

        return DatabaseOperation::execute(
                        'INSERT INTO ' . self::TABLENAME
                        . '(' . self::FIELDNAME_ID_FTA
                        . ', ' . self::FIELDNAME_ID_ANNEXE_EMBALLAGE
                        . ', ' . self::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE
                        . ', ' . self::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                        . ', ' . self::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT
                        . ', ' . self::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT
                        . ', ' . self::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT
                        . ', ' . self::FIELDNAME_POIDS_FTA_CONDITIONNEMENT
                        . ', ' . self::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT
                        . ', ' . self::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT
                        . ') VALUES (' . $paramIdFta
                        . ', ' . $paramIdAnnexeEmballage
                        . ', ' . $paramIdAnnexeEmballageGroupe
                        . ', ' . $paramIdAnnexeEmballageGroupeType
                        . ', ' . $paramLongeurFtaConditionnement
                        . ', ' . $paramLargeurFtaConditionnement
                        . ', ' . $paramHauteurFtaConditionnement
                        . ', ' . $paramPoidsFtaConditionnement
                        . ', ' . $paramNbCoucheFtaConditionnement
                        . ', ' . $paramQteCoucheFtaConditionnement . ' )'
        );
    }

    /**
     * Suppression d'une donnée de la table Fta conditionnement par son identifiant
     * @param type $paramIdFtaConditionnement
     * @return type
     */
    public static function deleteFtaConditionnement($paramIdFtaConditionnement) {
        return DatabaseOperation::execute(
                        ' DELETE FROM ' . self::TABLENAME . ' WHERE ' .
                        self::KEYNAME . '=' . $paramIdFtaConditionnement);
    }

    /**
     * 
     * @param type $paramIdFtaConditionnement
     * @return string
     */
    public static function addIdFtaConditionnement($paramIdFtaConditionnement) {
        if ($paramIdFtaConditionnement) {
            foreach ($paramIdFtaConditionnement as $value) {
                $req .= ' OR ' . self::TABLENAME . '.' . self::KEYNAME . '=' . $value . ' ';
            }
        }
        return $req;
    }

    /**
     * 
     * @param type $paramIdFta
     */
    public static function duplicateFtaConditionnementByIdFta($paramIdFtaOrig, $paramIdFtaNew) {
        FtaController::duplicateWithNewId(self::TABLENAME, $paramIdFtaOrig, $paramIdFtaNew);
    }

    /**
     *  Lien d'ajout d'un Emballage de Conditionnment
     * @param int $paramIdFta
     * @param int $paramIdChapitre
     * @param int $paramTypeEmballage
     * @param string $paramSyntheseAction
     * @param int $paramIdFtaEtat
     * @param string $paramAbreviationEtat
     * @param int $paramIdFtaRole
     * @return string
     */
    public static function getAddLinkBeforeConditionnement($paramIdFta, $paramIdChapitre, $paramTypeEmballage, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole) {
        return 'ajout_conditionnement.php?'
                . 'id_fta=' . $paramIdFta
                . '&id_annexe_emballage_groupe_type=' . $paramTypeEmballage
                . '&id_fta_chapitre=' . $paramIdChapitre
                . '&synthese_action=' . $paramSyntheseAction
//                . '&comeback=' . $paramComeback
                . '&id_fta_etat=' . $paramIdFtaEtat
                . '&abreviation_fta_etat=' . $paramAbreviationEtat
                . '&id_fta_role=' . $paramIdFtaRole
        ;
    }

    /**
     * Lien d'ajout d'un Emballage de Conditionnment après un autre emballage
     * @param int $paramIdFta
     * @param int $paramIdChapitre
     * @param int $paramTypeEmballage
     * @param string $paramSyntheseAction

     * @param int $paramIdFtaEtat
     * @param string $paramAbreviationEtat
     * @param int $paramIdFtaRole
     * @return string
     */
    public static function getAddLinkAfterConditionnement($paramIdFta, $paramIdChapitre, $paramTypeEmballage, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole) {
        return '<a href=ajout_conditionnement.php?'
                . 'id_fta=' . $paramIdFta
                . '&id_annexe_emballage_groupe_type=' . $paramTypeEmballage
                . '&id_fta_chapitre=' . $paramIdChapitre
                . '&synthese_action=' . $paramSyntheseAction
//                . '&comeback=' . $paramComeback
                . '&id_fta_etat=' . $paramIdFtaEtat
                . '&abreviation_fta_etat=' . $paramAbreviationEtat
                . '&id_fta_role=' . $paramIdFtaRole . '><img src=../lib/images/plus.png width=22  border=0 valign=middle halign=right />'
                . '</a><br>';
    }

    /**
     * Lien se supression d'un Emballage de Conditionnment
     * @param int $paramIdFta
     * @param int $paramIdChapitre
     * @param array $paramIdFtaConditionnement
     * @param string $paramSyntheseAction
     * @param int $paramIdFtaEtat
     * @param string $paramAbreviationEtat
     * @param int $paramIdFtaRole
     * @return string
     */
    public static function getDeleteLinkConditionnement($paramIdFta, $paramIdChapitre, $paramIdFtaConditionnement, $paramSyntheseAction, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole) {
        foreach ($paramIdFtaConditionnement as $rows) {
            $return[$rows] = '<a href=modification_fiche_post.php?'
                    . 'id_fta=' . $paramIdFta
                    . '&id_fta_conditionnement=' . $rows
                    . '&action=suppression_conditionnement'
                    . '&id_fta_chapitre_encours=' . $paramIdChapitre
                    . '&synthese_action=' . $paramSyntheseAction
//                    . '&comeback=' . $paramComeback
                    . '&id_fta_etat=' . $paramIdFtaEtat
                    . '&abreviation_fta_etat=' . $paramAbreviationEtat
                    . '&id_fta_role=' . $paramIdFtaRole . '>
                                <img src=../lib/images/supprimer.png width=22  border=0/>
                                </a><br>';
        }

        return $return;
    }

    /**
     * Création d'une palette
     * @param int $paramIdFta
     */
    public static function createPalette($paramIdFta) {
        /*
         * Initialisation du modele
         */
        $annexeEmballageModel = new AnnexeEmballageModel(AnnexeEmballageModel::ID_ANNEXE_EMBALLAGE_PALETTE);
        /*
         * Enregistrement de l'emballage affecter à cette FTA
         */
        //Récuperation des données
        $nbCoucheFtaConditionnement = "1"; //Une seule couche par UVC
        $hauteurFtaConditionnement = $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_HAUTEUR_ANNEXE_EMBALLAGE)->getFieldValue();
        $longeurFtaConditionnement = $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_LONGUEUR_ANNEXE_EMBALLAGE)->getFieldValue();
        $largeurFtaConditionnement = $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_LARGEUR_ANNEXE_EMBALLAGE)->getFieldValue();
        $poidsFtaConditionnement = $annexeEmballageModel->getDataField(AnnexeEmballageModel::FIELDNAME_POIDS_ANNEXE_EMBALLAGE)->getFieldValue();             //Poids des emballages qui ont peuvent varier selon les articles (comme des films)
        $qteCoucheFtaConditionnement = "1"; //Quantité par UVC

        self::addFtaConditionnement($paramIdFta, AnnexeEmballageModel::ID_ANNEXE_EMBALLAGE_PALETTE, AnnexeEmballageGroupeModel::ID_ANNEXE_EMBALLAGE_GROUPE_PALETTE
                , AnnexeEmballageGroupeTypeModel::EMBALLAGE_PALETTE, $hauteurFtaConditionnement, $longeurFtaConditionnement
                , $largeurFtaConditionnement, $poidsFtaConditionnement, $nbCoucheFtaConditionnement, $qteCoucheFtaConditionnement);
    }

}

?>