<?php

/**
 * Description of DataSyncTransfertModel
 * @author franckwastaken
 */
class DataSyncTransfertModel extends AbstractModel {

    const TABLENAME = 'ip_datasync_serveur';
    const KEYNAME = 'id_datasync_transfert';
    const FIELDNAME_NOM_DATASYNC_SERVEUR_ORIGINE = 'nom_datasync_serveur_origine';
    const FIELDNAME_NOM_FICHIER = 'nom_fichier';
    const FIELDNAME_NOM_DATASYNC_SERVEUR_DESTINATION = 'nom_datasync_serveur_destination';
    const FIELDNAME_COPIE_SAUVEGARDE = 'copie_sauvegarde';
    const FIELDNAME_FREQUENCE_SYNCHRONISATION = 'frequence_synchronisation';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

}
