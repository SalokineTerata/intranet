<?php

/**
 * Description of ArcadiaCategorieProduitOptiventesModel 
 * @author franckwastaken
 */
class ArcadiaCategorieProduitOptiventesModel extends AbstractModel {

    const TABLENAME = 'arcadia_categorie_produit_optiventes';
    const KEYNAME = 'id_arcadia_categorie_produit_optiventes';
    const FIELDNAME_NOM_ARCADIA_CATEGORIE_PRODUITS_OPTIVENTES = 'nom_arcadia_categorie_produit_optiventes';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}

?>