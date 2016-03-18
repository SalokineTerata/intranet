<?php

/**
 * Description of ClassificationRaccourcisModel
 * Tables des raccourcis de classification 
 * @author tp4300001
 */
class ClassificationRaccourcisModel extends AbstractModel {

    const TABLENAME = 'classification_raccourcis';
    const KEYNAME = 'id_classification_raccourcis';
    const FIELDNAME_NOM_CLASSIFICATION_RACCOURCIS = 'nom_classification_raccourcis';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

    /**
     * Affiche le raccourcis de classification
     * @return string
     */
    function getNameRaccourcisClassif() {
        $raccourcisValue = $this->getDataField(self::FIELDNAME_NOM_CLASSIFICATION_RACCOURCIS)->getFieldValue();
        return $raccourcisValue;
    }

    /**
     *    On récupère le nom de la classification
     * @param type $paramIdClassificationRaccourcis
     */
    public static function getNameRaccroucisClassifById($paramIdClassificationRaccourcis) {

        if ($paramIdClassificationRaccourcis) {
            $classificationRaccoucisModel = new ClassificationRaccourcisModel($paramIdClassificationRaccourcis);
            $suffixeAgrologicFta = $classificationRaccoucisModel->getNameRaccourcisClassif();
        } else {
            $suffixeAgrologicFta = "";
        }

        return $suffixeAgrologicFta;
    }

}
