<?php

/**
 * Description of FtaActionSiteModel
 * Table des utilisateurs
 *
 * @author franckwastaken
 */
class FtaActionSiteModel extends AbstractModel {

    const TABLENAME = 'fta_action_site';
    const KEYNAME = 'id_fta_action_site';
    const FIELDNAME_ID_SITE = 'id_site';
    const FIELDNAME_ID_INTRANET_ACTIONS = 'id_intranet_actions';
    const FIELDNAME_ID_FTA_WORKFLOW = 'id_fta_workflow';

    protected function setDefaultValues() {
        
    }

    /**
     * On obtient l'id intranet action selon l'espace de travail et le site de production
     * @param int $paramIdFtaWorkflow
     * @param int $paramIdFtaSiteDeProduction
     * @return array
     */
    public static function getArrayIdIntranetActionByWorkflowAndSiteDeProduction($paramIdFtaWorkflow, $paramIdFtaSiteDeProduction) {


        $req = 'SELECT ' . self::FIELDNAME_ID_INTRANET_ACTIONS
                . ' FROM ' . self::TABLENAME
                . ' WHERE ' . self::FIELDNAME_ID_FTA_WORKFLOW . '=' . $paramIdFtaWorkflow;
        /**
         * on ne verifie que l'espace de travail pour les site non défiie
         */
        if ($paramIdFtaSiteDeProduction != GeoModel::ID_SITE_NON_DEFINIE) {
            $req.= ' AND ' . self::FIELDNAME_ID_SITE . '=' . $paramIdFtaSiteDeProduction;
        }
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
        if ($array) {
            foreach ($array as $value) {
                $idIntranetActions[] = $value[self::FIELDNAME_ID_INTRANET_ACTIONS];
            }
        }

        return $idIntranetActions;
    }

    /**
     * On obtient le tableau des id intranet action du site de rpooduction
     * pour un espace de travail donné
     * @param int $paramWorkflow
     * @param int $paramSiteDeProd
     * @return array
     */
    public static function getArrayIdIntranetActionsByWorkflowAndSiteDeProd($paramWorkflow, $paramSiteDeProd) {
        $arrayIdIntranetActions = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . self::TABLENAME . '.' . self::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' FROM ' . self::TABLENAME
                        . ' WHERE ' . self::TABLENAME . '.' . self::FIELDNAME_ID_FTA_WORKFLOW . '=' . $paramWorkflow
                        . ' AND ' . self::TABLENAME . '.' . self::FIELDNAME_ID_SITE . '=' . $paramSiteDeProd
        );

        if ($arrayIdIntranetActions) {
            foreach ($arrayIdIntranetActions as $value) {
                $result[] = $value[self::FIELDNAME_ID_INTRANET_ACTIONS];
            }
            return $result;
        }
    }

}
