<?php

class AnnexeEnvironnementConservationGroupeModel extends AbstractModel {

    const TABLENAME = 'annexe_environnement_conservation_groupe';
    const KEYNAME = 'id_annexe_environnement_conservation_groupe';
    const FIELDNAME_NOM_ANNEXE_ENVIRONNEMENT_CONSERVATION_GROUPE = 'nom_annexe_environnement_conservation_groupe';
    const FIELDNAME_TEXTE_LEGAL_ANNEXE_ENVIRONNEMENT_CONSERVATION_GROUPE = 'texte_legal_annexe_environnement_conservation_groupe';
    const FIELDNAME_TEMPERATURE_PAR_DEFAUT_ANNEXE_ENVIRONNEMENT_CONSERVATION_GROUPE = 'temperature_par_defaut_annexe_environnement_conservation_groupe';
    const FIELDNAME_ID_CLASSIFICATION_ARBORESCENCE_ARTICLE_CATEGORIE_CONTENU = 'id_classification_arborescence_article_categorie_contenu';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}
