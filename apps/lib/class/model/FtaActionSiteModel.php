<?php

/**
 * Description of FtaActionSiteModel
 * Table des utilisateurs
 *
 * @author tp4300001
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


        $req = 'SELECT ' . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                . ' FROM ' . FtaActionSiteModel::TABLENAME
                . ' WHERE ' . FtaActionSiteModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . $paramIdFtaWorkflow;
        /**
         * on ne verifie que l'espace de travail pour les site non défiie
         */
        if ($paramIdFtaSiteDeProduction != GeoModel::ID_SITE_NON_DEFINIE) {
            $req.= ' AND ' . FtaActionSiteModel::FIELDNAME_ID_SITE . '=' . $paramIdFtaSiteDeProduction;
        } 
        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);
        if ($array) {
            foreach ($array as $value) {
                $idIntranetActions[] = $value[FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS];
            }
        }

        return $idIntranetActions;
    }

}
