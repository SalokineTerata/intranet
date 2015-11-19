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

    /**
     * On obtient l'id intranet action selon l'espace de travail et le site de production
     * @param int $paramIdFtaWorkflow
     * @param int $paramIdFtaSiteDeProduction
     * @return array
     */
    public static function getIdIntranetActionByWorkflowAndSiteDeProduction($paramIdFtaWorkflow, $paramIdFtaSiteDeProduction) {

        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS
                        . ' FROM ' . FtaActionSiteModel::TABLENAME
                        . ' WHERE ' . FtaActionSiteModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . $paramIdFtaWorkflow
                        . ' AND ' . FtaActionSiteModel::FIELDNAME_ID_SITE . '=' . $paramIdFtaSiteDeProduction
        );
        if ($array) {
            foreach ($array as $value) {
                $idIntranetActions[] = $value[FtaActionSiteModel::FIELDNAME_ID_INTRANET_ACTIONS];
            }
        }

        return $idIntranetActions;
    }

}
