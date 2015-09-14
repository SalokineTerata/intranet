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
    const FIELDNAME_PCB_FTA_CONDITIONNEMENT = 'pcb_fta_conditionnement';
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
    const EMBALLAGES_UVC = '1';
    const EMBALLAGES_PAR_COLIS = '2';
    const EMBALLAGES_DU_COLIS = '3';
    const EMBALLAGES_PALETTE = '4';
    const UVC_EMBALLAGE = 'uvc_emballage';
    const UVC_EMBALLAGE_NET = 'uvc_net';
    const UVC_EMBALLAGE_BRUT = 'uvc_brut';
    const UVC_EMBALLAGE_DIMENSION = 'dimension_uvc';
    const UVC_EMBALLAGE_DIMENSION_HAUTEUR = 'dimension_uvc_hauteur';
    const UVC_EMBALLAGE_DIMENSION_LONGEUR = 'dimension_uvc_longueur';
    const UVC_EMBALLAGE_DIMENSION_LARGEUR = 'dimension_uvc_largeur';
    const UVC_EMBALLAGE_DIMENSION_LABEL = 'Dimension de l\'UVC (en mm):';
    const COLIS_EMBALLAGE = 'colis_emballage';
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

    /**
     * FTA associée
     * @var FtaModel
     */
    private $modelFta;

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);

        $this->setModelFtaById(
                $this->getDataField(self::FIELDNAME_ID_FTA)->getFieldValue());
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
        return $paramDimensionEmballageLongueur . 'x' . $paramDimensionEmballageLargeur . 'x' . $paramDimensionEmballageHauteur . ' (Longueur x Largeur x Hauteur)';
    }

    /**
     * Calcul de la hauteur de l'emballage  par Palette
     * @param type $paramHauteurFtaConditionnement
     * @param type $paramCouchePalette
     * @return type
     */
    static function getCalculHauteurEmballagePalette($paramHauteurFtaConditionnement, $paramCouchePalette) {
        return (($paramHauteurFtaConditionnement * $paramCouchePalette) + $paramHauteurFtaConditionnement ) / 1000;
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
     * @param type $paramPoidsFta
     * @param type $paramNombreColisCouche
     * @param type $paramNombreCouchePalette
     * @param type $paramQuantiteCouche
     * @param type $paramNombreCouche
     * @return type
     */
    static function getCalculPoidsEmballagePalette($paramPoidsFta, $paramNombreColisCouche, $paramNombreCouchePalette, $paramQuantiteCouche, $paramNombreCouche) {
        return ($paramPoidsFta / 1000) * $paramNombreColisCouche * $paramNombreCouchePalette * ($paramQuantiteCouche * $paramNombreCouche);
    }

    /**
     * Multiplication
     * @param type $param
     * @param type $paramb
     * @return type
     */
    static function getCalculGenericMultiplication($param, $paramb) {
        return $param * $paramb;
    }

    /**
     * On obtient les id Fta Conditionnement selon le type d'emballage
     * @param type $paramIdAnnexeEmballage
     * @param type $paramIdFta
     * @return int
     */
    public static function getIdFtaConditionnement($paramIdAnnexeEmballage, $paramIdFta, $paramIdEmballageGroupeType) {

        $req = 'SELECT DISTINCT ' . FtaConditionnementModel::KEYNAME
                . ' FROM ' . FtaConditionnementModel::TABLENAME
                . ' WHERE ( 0 ';

        $req .=AnnexeEmballageModel::AddIdAnnexeEmballage($paramIdAnnexeEmballage);

        $req .= ') AND ' . FtaConditionnementModel::FIELDNAME_ID_FTA . '=' . $paramIdFta
                . ' AND ' . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . '=' . $paramIdEmballageGroupeType
        ;

        $arrayIdFtaConditionnement = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
        if ($arrayIdFtaConditionnement) {
            foreach ($arrayIdFtaConditionnement as $rowsIdFtaConditionnement) {
                $IdFtaConditionnement[] = $rowsIdFtaConditionnement[FtaConditionnementModel::KEYNAME];
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

        $req = 'SELECT DISTINCT ' . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE
                . ' FROM ' . FtaConditionnementModel::TABLENAME
                . ' WHERE ' . FtaConditionnementModel::KEYNAME . '=' . $paramIdFtaConditionnement
                . '  AND ' . FtaConditionnementModel::FIELDNAME_ID_FTA . '=' . $paramIdFta
        ;

        $arrayIdAnnexeEmballage = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
        if ($arrayIdAnnexeEmballage) {
            foreach ($arrayIdAnnexeEmballage as $rowsIdAnnexeEmballage) {
                $IdAnnexeEmballage = $rowsIdAnnexeEmballage[FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE];
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

        $req = 'SELECT DISTINCT ' . FtaConditionnementModel::KEYNAME
                . ',' . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE
                . ',' . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                . ' FROM ' . FtaConditionnementModel::TABLENAME
                . ' WHERE ( 0 ' . FtaConditionnementModel::addIdFtaConditionnement($paramIdFtaConditionnement)
                . ' ) AND ' . FtaConditionnementModel::FIELDNAME_ID_FTA . '=' . $paramIdFta
        ;

        $arrayIdAnnexeEmballageGroupe = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);

        return $arrayIdAnnexeEmballageGroupe;
    }

    /**
     * Tableau de données, convertie le nom des champs des données aux noms des champs virtuel qui leur corresponds
     * @param type $paramIdFtaConditionnement
     * @return int
     */
    public static function getArrayFtaConditonnement($paramIdFtaConditionnement) {

        $arrayTmp = DatabaseOperation::convertSqlStatementWithKeyAsFirstFieldToArray(
                        'SELECT ' . FtaConditionnementModel::KEYNAME
                        . ',' . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE
                        . ',' . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE
                        . ',' . FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT
                        . ',' . FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT
                        . ',' . FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT
                        . ',' . FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT
                        . ',' . FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT
                        . ' FROM ' . FtaConditionnementModel::TABLENAME
                        . ' WHERE ' . FtaConditionnementModel::KEYNAME . '=' . $paramIdFtaConditionnement);

        if ($arrayTmp) {
            foreach ($arrayTmp as $key => $rows) {
                $array[$key] = array(
                    FtaConditionnementModel::FIELDNAME_VIRTUAL_NOM_FTA_CONDITIONNEMENT_GROUPE => $rows[FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE],
                    FtaConditionnementModel::FIELDNAME_VIRTUAL_REFERENCE_FOURNISSEUR_FTA_CONDITIONNEMENT => $rows[FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE],
                    FtaConditionnementModel::FIELDNAME_VIRTUAL_HAUTEUR_FTA_CONDITIONNEMENT => $rows[FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT],
                    FtaConditionnementModel::FIELDNAME_VIRTUAL_LONGUEUR_FTA_CONDITIONNEMENT => $rows[FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT],
                    FtaConditionnementModel::FIELDNAME_VIRTUAL_LARGEUR_FTA_CONDITIONNEMENT => $rows[FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT],
                    FtaConditionnementModel::FIELDNAME_VIRTUAL_POIDS_FTA_CONDITIONNEMENT => $rows[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT],
                    FtaConditionnementModel::FIELDNAME_VIRTUAL_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT => $rows[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT]
                );
            }
        } else {
            $array = 0;
        }
        return $array;
    }

    /**
     * 
     * @param int $paramIdFta
     * @param int $paramIdAnnexeEmballage
     * @param int $paramIdAnnexeEmballageGroupeType
     * @param int $paramIdFtaConditionnement
     * @return array
     */
    public static function getTablesNameAndIdForeignKeyOfFtaConditionnement($paramIdFta, $paramIdAnnexeEmballage, $paramIdAnnexeEmballageGroupeType, $paramIdFtaConditionnement) {
        $tablesNameAndIdForeignKeyOfFtaConditionnement[$paramIdFtaConditionnement] = array(
            array(AnnexeEmballageModel::TABLENAME, FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE, $paramIdAnnexeEmballage),
            array(AnnexeEmballageGroupeTypeModel::TABLENAME, FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE, $paramIdAnnexeEmballageGroupeType),
            array(FtaModel::TABLENAME, FtaConditionnementModel::FIELDNAME_ID_FTA, $paramIdFta),
        );

        return $tablesNameAndIdForeignKeyOfFtaConditionnement;
    }

    public static function getTableConditionnementLabel($paramIdFtaConditionnment) {
        $ftaCondtionnementModel = new FtaConditionnementModel($paramIdFtaConditionnment);

        return '<tr class=titre_tableau  align=center >' .
                '<td>' . $ftaCondtionnementModel->getDataField(FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE)->getFieldLabel() . '</td>'
                . '<td>' . $ftaCondtionnementModel->getDataField(FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE)->getFieldLabel() . '</td>'
                . '<td>' . $ftaCondtionnementModel->getDataField(FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . '<td>' . $ftaCondtionnementModel->getDataField(FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . '<td>' . $ftaCondtionnementModel->getDataField(FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . '<td>' . $ftaCondtionnementModel->getDataField(FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . '<td>' . $ftaCondtionnementModel->getDataField(FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>' . '</tr>';
    }

    public static function getTableConditionnementLabelDuColis($paramIdFtaConditionnment) {
        $ftaCondtionnementModel = new FtaConditionnementModel($paramIdFtaConditionnment);

        return '<tr class=titre_tableau >' .
                '<td>' . $ftaCondtionnementModel->getDataField(FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE)->getFieldLabel() . '</td>'
                . '<td>' . $ftaCondtionnementModel->getDataField(FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE)->getFieldLabel() . '</td>'
                . '<td>' . $ftaCondtionnementModel->getDataField(FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . '<td>' . $ftaCondtionnementModel->getDataField(FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . '<td>' . $ftaCondtionnementModel->getDataField(FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . '<td>' . $ftaCondtionnementModel->getDataField(FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . '<td>' . $ftaCondtionnementModel->getDataField(FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . '<td>' . $ftaCondtionnementModel->getDataField(FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT)->getFieldLabel() . '</td>'
                . '</tr>';
    }

    /**
     * Tableau de données, convertie le nom des champs des données aux noms des champs virtuel qui leur corresponds
     * @param type $paramIdFtaConditionnement
     * @return int
     */
    public static function getArrayFtaConditonnementDuColis($paramIdFtaConditionnement) {

        $arrayTmp = DatabaseOperation::convertSqlStatementWithKeyAsFirstFieldToArray(
                        'SELECT ' . FtaConditionnementModel::KEYNAME
                        . ',' . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE
                        . ',' . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE
                        . ',' . FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT
                        . ',' . FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT
                        . ',' . FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT
                        . ',' . FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT
                        . ',' . FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT
                        . ',' . FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT
                        . ' FROM ' . FtaConditionnementModel::TABLENAME
                        . ' WHERE ' . FtaConditionnementModel::KEYNAME . '=' . $paramIdFtaConditionnement);

        if ($arrayTmp) {
            foreach ($arrayTmp as $key => $rows) {
                $array[$key] = array(
                    FtaConditionnementModel::FIELDNAME_VIRTUAL_NOM_FTA_CONDITIONNEMENT_GROUPE => $rows[FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE],
                    FtaConditionnementModel::FIELDNAME_VIRTUAL_REFERENCE_FOURNISSEUR_FTA_CONDITIONNEMENT => $rows[FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE],
                    FtaConditionnementModel::FIELDNAME_VIRTUAL_HAUTEUR_FTA_CONDITIONNEMENT => $rows[FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT],
                    FtaConditionnementModel::FIELDNAME_VIRTUAL_LONGUEUR_FTA_CONDITIONNEMENT => $rows[FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT],
                    FtaConditionnementModel::FIELDNAME_VIRTUAL_LARGEUR_FTA_CONDITIONNEMENT => $rows[FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT],
                    FtaConditionnementModel::FIELDNAME_VIRTUAL_POIDS_FTA_CONDITIONNEMENT => $rows[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT],
                    FtaConditionnementModel::FIELDNAME_VIRTUAL_NOMBRE_COUCHE_FTA_CONDITIONNEMENT => $rows[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT],
                    FtaConditionnementModel::FIELDNAME_VIRTUAL_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT => $rows[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT]
                );
            }
        } else {
            $array = 0;
        }
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
                        'INSERT INTO ' . FtaConditionnementModel::TABLENAME
                        . '(' . FtaConditionnementModel::FIELDNAME_ID_FTA
                        . ', ' . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE
                        . ', ' . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE
                        . ', ' . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                        . ', ' . FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT
                        . ', ' . FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT
                        . ', ' . FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT
                        . ', ' . FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT
                        . ', ' . FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT
                        . ', ' . FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT
                        . ') VALUES (' . $paramIdFta
                        . ', ' . $paramIdAnnexeEmballage
                        . ', ' . $paramIdAnnexeEmballageGroupe
                        . ', ' . $paramIdAnnexeEmballageGroupeType
                        . ', ' . $paramHauteurFtaConditionnement
                        . ', ' . $paramLongeurFtaConditionnement
                        . ', ' . $paramLargeurFtaConditionnement
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
                        ' DELETE FROM ' . FtaConditionnementModel::TABLENAME . ' WHERE ' .
                        FtaConditionnementModel::KEYNAME . '=' . $paramIdFtaConditionnement);
    }

    /**
     * 
     * @param type $paramIdFtaConditionnement
     * @return string
     */
    public static function addIdFtaConditionnement($paramIdFtaConditionnement) {
        if ($paramIdFtaConditionnement) {
            foreach ($paramIdFtaConditionnement as $value) {
                $req .= ' OR ' . FtaConditionnementModel::TABLENAME . '.' . FtaConditionnementModel::KEYNAME . '=' . $value . ' ';
            }
        }
        return $req;
    }

    /**
     * 
     * @param type $paramIdFta
     */
    public static function DuplicateFtaConditionnementByIdFta($paramIdFtaOrig, $paramIdFtaNew) {
        DatabaseOperation::execute(
                ' INSERT INTO ' . FtaConditionnementModel::TABLENAME
                . ' (' . FtaConditionnementModel::FIELDNAME_HAUTEUR_EMBALLAGE_FTA_CONDITIONNEMENT
                . ', ' . FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT
                . ', ' . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE
                . ', ' . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE
                . ', ' . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                . ', ' . FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT
                . ', ' . FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT
                . ', ' . FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT
                . ', ' . FtaConditionnementModel::FIELDNAME_PCB_FTA_CONDITIONNEMENT
                . ', ' . FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT
                . ', ' . FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT
                . ', ' . FtaConditionnementModel::FIELDNAME_LAST_ID_FTA_CONDITIONNEMENT
                . ', ' . FtaConditionnementModel::FIELDNAME_ID_FTA . ')'
                . ' SELECT ' . FtaConditionnementModel::FIELDNAME_HAUTEUR_EMBALLAGE_FTA_CONDITIONNEMENT
                . ', ' . FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT
                . ', ' . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE
                . ', ' . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE
                . ', ' . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE
                . ', ' . FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT
                . ', ' . FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT
                . ', ' . FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT
                . ', ' . FtaConditionnementModel::FIELDNAME_PCB_FTA_CONDITIONNEMENT
                . ', ' . FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT
                . ', ' . FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT
                . ', ' . FtaConditionnementModel::KEYNAME
                . ', ' . $paramIdFtaNew
                . ' FROM ' . FtaConditionnementModel::TABLENAME
                . ' WHERE ' . FtaConditionnementModel::FIELDNAME_ID_FTA . '=' . $paramIdFtaOrig
        );
    }

    /**
     *  Lien d'ajout d'un Emballage de Conditionnment
     * @param int $paramIdFta
     * @param int $paramIdChapitre
     * @param int $paramTypeEmballage
     * @param string $paramSyntheseAction
     * @param int $paramComeback
     * @param int $paramIdFtaEtat
     * @param string $paramAbreviationEtat
     * @param int $paramIdFtaRole
     * @return string
     */
    public static function getAddLinkBeforeConditionnement($paramIdFta, $paramIdChapitre, $paramTypeEmballage, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole) {
        return 'ajout_conditionnement.php?'
                . 'id_fta=' . $paramIdFta
                . '&id_annexe_emballage_groupe_type=' . $paramTypeEmballage
                . '&id_fta_chapitre=' . $paramIdChapitre
                . '&synthese_action=' . $paramSyntheseAction
                . '&comeback=' . $paramComeback
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
     * @param int $paramComeback
     * @param int $paramIdFtaEtat
     * @param string $paramAbreviationEtat
     * @param int $paramIdFtaRole
     * @return string
     */
    public static function getAddLinkAfterConditionnement($paramIdFta, $paramIdChapitre, $paramTypeEmballage, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole) {
        return '<a href=ajout_conditionnement.php?'
                . 'id_fta=' . $paramIdFta
                . '&id_annexe_emballage_groupe_type=' . $paramTypeEmballage
                . '&id_fta_chapitre=' . $paramIdChapitre
                . '&synthese_action=' . $paramSyntheseAction
                . '&comeback=' . $paramComeback
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
     * @param int $paramComeback
     * @param int $paramIdFtaEtat
     * @param string $paramAbreviationEtat
     * @param int $paramIdFtaRole
     * @return string
     */
    public static function getDeleteLinkConditionnement($paramIdFta, $paramIdChapitre, $paramIdFtaConditionnement, $paramSyntheseAction, $paramComeback, $paramIdFtaEtat, $paramAbreviationEtat, $paramIdFtaRole) {
        foreach ($paramIdFtaConditionnement as $rows) {
            $return[$rows] = '<a href=modification_fiche_post.php?'
                    . 'id_fta=' . $paramIdFta
                    . '&id_fta_conditionnement=' . $rows
                    . '&action=suppression_conditionnement'
                    . '&id_fta_chapitre_encours=' . $paramIdChapitre
                    . '&synthese_action=' . $paramSyntheseAction
                    . '&comeback=' . $paramComeback
                    . '&id_fta_etat=' . $paramIdFtaEtat
                    . '&abreviation_fta_etat=' . $paramAbreviationEtat
                    . '&id_fta_role=' . $paramIdFtaRole . '>
                                <img src=../lib/images/supprimer.png width=22  border=0/>
                                </a><br>';
        }

        return $return;
    }

}

?>