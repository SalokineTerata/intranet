<?php

/**
 * Description of FtaConditionnementModel
 * Table des FtaConditionnementModel
 *
 * @author franckwastaken
 */
class FtaConditionnementModel extends AbstractModel {

    const TABLENAME = "fta_conditionnement";
    const KEYNAME = "id_fta_conditionnement";
    const FIELDNAME_ID_FTA = "id_fta";
    const FIELDNAME_HAUTEUR_EMBALLAGE_FTA_CONDITIONNEMENT = "hauteur_emballage_fta_conditionnement";
    const FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT = "hauteur_fta_conditionnement";
    const FIELDNAME_ID_ANNEXE_EMBALLAGE = "id_annexe_emballage";
    const FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE = "id_annexe_emballage_groupe";
    const FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE = "id_annexe_emballage_groupe_type";
    const FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT = "largeur_fta_conditionnement";    
    const FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT = "longueur_fta_conditionnement";
    const FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT = "nombre_couche_fta_conditionnement";
    const FIELDNAME_PCB_FTA_CONDITIONNEMENT = "pcb_fta_conditionnement";
    const FIELDNAME_POIDS_FTA_CONDITIONNEMENT = "poids_fta_conditionnement";
    const FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT = "quantite_par_couche_fta_conditionnement";

    
    
    private function getArrayEmballages($paramgroupetype) {

        //Les calculs pour Emballages
        //$array = DatabaseOperation::convertSqlResultKeyAndOneFieldToArray(
        $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT  * FROM " . FtaConditionnementModel::TABLENAME . "," . AnnexeEmballageGroupeModel::TABLENAME . "," . AnnexeEmballageGroupeType::TABLENAME . " "
                        . "WHERE " . FtaConditionnementModel::FIELDNAME_ID_FTA . "=" . FtaModel::KEYNAME . " "
                        . "AND " . AnnexeEmballageGroupeType::TABLENAME . "." . AnnexeEmballageGroupeType::KEYNAME . "=" . $paramgroupetype . " "
                        . "AND " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . "=" . AnnexeEmballageGroupeModel::TABLENAME . "." . AnnexeEmballageGroupeModel::KEYNAME . " "
                        . "AND ( "
                        . "( " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . " IS NOT NULL AND " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . "=" . AnnexeEmballageGroupeType::TABLENAME . "." . AnnexeEmballageGroupeType::KEYNAME . ")"
                        . " OR "
                        . "( " . FtaConditionnementModel::TABLENAME . "." . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_TYPE . " IS NULL AND " . AnnexeEmballageGroupeModel::TABLENAME . "." . AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION . "=" . AnnexeEmballageGroupeType::TABLENAME . "." . AnnexeEmballageGroupeType::KEYNAME . ")"
                        . "    ) "
                        . " ORDER BY " . AnnexeEmballageGroupeType::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE
        );

        foreach ($array as $rows) {
            //Calcul du poids de l'emballage  par UVC            
            $return[FtaModel::UVC_EMBALLAGE] = $rows[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT] * $rows[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT] * $rows[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT];

            //Calcul des dimension de l'emballage par UVC  (on recherche la taille la plus grande
            if ($return[FtaModel::UVC_EMBALLAGE_DIMENSION_HAUTEUR] < $rows[FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT]) {
                $return[FtaModel::UVC_EMBALLAGE_DIMENSION_HAUTEUR] = $rows[FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT];
            }
            if ($return[FtaModel::UVC_EMBALLAGE_DIMENSION_LONGEUR] < $rows[FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT]) {
                $return[FtaModel::UVC_EMBALLAGE_DIMENSION_LONGEUR] = $rows[FtaConditionnementModel::FIELDNAME_LONGUEUR_FTA_CONDITIONNEMENT];
            }
            if ($return[FtaModel::UVC_EMBALLAGE_DIMENSION_LARGEUR] < $rows[FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT]) {
                $return[FtaModel::UVC_EMBALLAGE_DIMENSION_LARGEUR] = $rows[FtaConditionnementModel::FIELDNAME_LARGEUR_FTA_CONDITIONNEMENT];
            }

            //Calcul du poids de Emballages du Colis
            $return[FtaModel::COLIS_EMBALLAGE] = $rows[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT] * $rows[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT] * $rows[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT];

            //Calcul de la hauteur par palette
            $return[FtaModel::PALETTE_EMBALLAGE_HAUTEUR] = (($rows[FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT] * $return[FtaModel::PALETTE_NOMBRE_DE_COUCHE]) + $rows[FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT]) / 1000;

            //Calcul du nombre de colis par couche
            $return[FtaModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE] = $rows[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT];

            //Calcul du nombre de couche par palette
            $return[FtaModel::PALETTE_NOMBRE_DE_COUCHE] = $rows[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT];

            //Calcul du poids de l'emballage par palette
            $return[FtaModel::PALETTE_EMBALLAGE] = ($rows[FtaConditionnementModel::FIELDNAME_POIDS_FTA_CONDITIONNEMENT] / 1000) * $return[FtaModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE] * $return[FtaModel::PALETTE_NOMBRE_DE_COUCHE];
            $return[FtaModel::PALETTE_EMBALLAGE] = $return[FtaModel::PALETTE_EMBALLAGE] * ($rows[FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT] * $rows[FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT]);
        }

        //Calcul des dimension de l'emballage par UVC 
        $return[FtaModel::UVC_EMBALLAGE_DIMENSION] = $return[FtaModel::UVC_EMBALLAGE_DIMENSION_LONGEUR] . "x" . $return[FtaModel::UVC_EMBALLAGE_DIMENSION_LARGEUR];

        //Si la hauteur n'est pas nulle, on l'intègre.
        if ($return[FtaModel::UVC_EMBALLAGE_DIMENSION_HAUTEUR]) {
            $return[FtaModel::UVC_EMBALLAGE_DIMENSION] = $return[FtaModel::UVC_EMBALLAGE_DIMENSION] . "x" . $return[FtaModel::UVC_EMBALLAGE_DIMENSION_HAUTEUR];
        }

        //Calcul du poids brut par UVC en g
        $return[FtaModel::UVC_EMBALLAGE_BRUT] = $return[FtaModel::UVC_EMBALLAGE_NET] + $return[FtaModel::UVC_EMBALLAGE];


        //Calcul du poids de Emballages du Colis
        $return[FtaModel::COLIS_EMBALLAGE] = $return[FtaModel::COLIS_EMBALLAGE] * $return[FtaModel::FIELDNAME_PCB];

        //Calcul du poids brut du Colis en Kg
        $return[FtaModel::COLIS_EMBALLAGE_BRUT] = $return[FtaModel::COLIS_EMBALLAGE_NET] + ($return[FtaModel::COLIS_EMBALLAGE] / 1000);

        //Calcul Poids Brut  d'une Palette en Kg
        $return[FtaModel::PALETTE_EMBALLAGE_BRUT] = $return[FtaModel::PALETTE_EMBALLAGE_NET] + $return[FtaModel::PALETTE_EMBALLAGE];

        //Calcul du nombre total de Carton par palette:
        $return[FtaModel::PALETTE_NOMBRE_TOTAL_PAR_CARTON] = $return[FtaModel::PALETTE_NOMBRE_COLIS_PAR_COUCHE] * $return[FtaModel::PALETTE_NOMBRE_DE_COUCHE];
    }

    
    public function getArrayConditionnement() {

        //Les calculs pour la table conditionnment
        $array = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray("SELECT " . FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT . " FROM " . FtaConditionnementModel::TABLENAME
                        . "WHERE " . FtaConditionnementModel::FIELDNAME_ID_FTA . "=" . FtaModel::KEYNAME
        );

        foreach ($array as $rows) {
            
        $return[FtaModel::COLIS_EMBALLAGE_HAUTEUR] = $rows[FtaConditionnementModel::FIELDNAME_HAUTEUR_FTA_CONDITIONNEMENT];
        }
    }
    
}



?>