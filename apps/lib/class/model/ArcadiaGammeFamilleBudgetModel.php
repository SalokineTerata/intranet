<?php

/**
 * Description of ArcadiaGammeFamilleBudgetModel 
 * @author franckwastaken
 */
class ArcadiaGammeFamilleBudgetModel extends AbstractModel {

    const TABLENAME = 'arcadia_gamme_famille_budget';
    const KEYNAME = 'id_arcadia_gamme_famille_budget';
    const FIELDNAME_NOM_ARCADIA_GAMME_FAMILLE_BUDGET = 'nom_arcadia_gamme_famille_budget';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}

?>