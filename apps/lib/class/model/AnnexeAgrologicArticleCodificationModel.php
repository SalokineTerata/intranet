<?php

/**
 * Description of AnnexeAgrologicArticleCodificationModel
 * Table des AnnexeAgrologicArticleCodification
 *
 * @author franckwastaken
 */
class AnnexeAgrologicArticleCodificationModel extends AbstractModel {

    const TABLENAME = 'annexe_agrologic_article_codification';
    const KEYNAME = 'id_annexe_agrologic_article_codification';
    const FIELDNAME_PREFIXE_ANNEXE_AGRO_ART_COD = 'prefixe_annexe_agrologic_article_codification';
    const FIELDNAME_NOM_ANNEXE_AGRO_ART_COD = 'nom_annexe_agrologic_article_codification';
    const FIELDNAME_ABREVATION_ANNEXE_AGRO_ART_COD = 'abreviation_annexe_agrologic_article_codification';
    const FIELDNAME_IS_COMPOSITION = 'is_composition';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}

?>