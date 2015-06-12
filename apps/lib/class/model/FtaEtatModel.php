<?php

/**
 * Description of FtaEtatModel
 * Table des états d'une FTA
 *
 * @author salokine
 */
class FtaEtatModel extends AbstractModel {

    const TABLENAME = "fta_etat";
    const KEYNAME = "id_fta_etat";
    const FIELDNAME_ABREVIATION = "abreviation_fta_etat";
    const FIELDNAME_NOM_FTA_ETAT = "nom_fta_etat";

    public static function getFtaEtatAndNameByRole($paramIdFtaRole) {

        $arrayFtaEtatAndName = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT DISTINCT " . FtaEtatModel::FIELDNAME_NOM_FTA_ETAT
                        . "," . FtaEtatModel::FIELDNAME_ABREVIATION
                        . " FROM " . FtaEtatModel::TABLENAME
                        . "," . FtaRoleModel::TABLENAME . "," . FtaModel::TABLENAME
                        . "," . FtaWorkflowModel::TABLENAME . "," . FtaWorkflowStructureModel::TABLENAME
                        . " WHERE " . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME . "=" . $paramIdFtaRole
                        . " AND " . FtaRoleModel::TABLENAME . "." . FtaRoleModel::KEYNAME
                        . "=" . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_ROLE
                        . " AND " . FtaWorkflowStructureModel::TABLENAME . "." . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW
                        . "=" . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                        . " AND " . FtaWorkflowModel::TABLENAME . "." . FtaWorkflowModel::KEYNAME
                        . "=" . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_WORKFLOW
                        . " AND " . FtaModel::TABLENAME . "." . FtaModel::FIELDNAME_ID_FTA_ETAT . "=" . FtaEtatModel::TABLENAME . "." . FtaEtatModel::KEYNAME
        );
        foreach ($arrayFtaEtatAndName as $rowsFtaEtatAndName) {
            $value[FtaEtatModel::FIELDNAME_ABREVIATION] = $rowsFtaEtatAndName[FtaEtatModel::FIELDNAME_ABREVIATION];
            $value[FtaEtatModel::FIELDNAME_NOM_FTA_ETAT] = $rowsFtaEtatAndName[FtaEtatModel::FIELDNAME_NOM_FTA_ETAT];

            for ($i = 1; $i <= sizeof($arrayFtaEtatAndName); $i++) {
                $arrayFtaEtat = array(
                    $i => $value
                );
            }
        }



        return $arrayFtaEtat;
    }

}

?>
