<?php

class CodesoftEtiquettesModel extends AbstractModel {

    const TABLENAME = 'codesoft_etiquettes';
    const KEYNAME = 'k_etiquette';
    const FIELDNAME_K_SITE = 'k_site';
    const FIELDNAME_K_TYPE_ETIQUETTE_CODESOFT_ETIQUETTES = 'k_type_etiquette_codesoft_etiquettes';
    const FIELDNAME_ETIQUETTE_NOM = 'etiq_nom';
    const FIELDNAME_ETIQUETTE_NOM_REQUETE = 'etiq_nom_requete';
    const FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES = 'designation_codesoft_etiquettes';
    const FIELDNAME_CONFIGURATION_MANUELLE_CODESOFT_ETIQUETTES = 'configuration_manuelle_codesoft_etiquettes';
    const FIELDNAME_AIDE_CONFIGURATION_MANUELLE_CODESOFT_ETIQUETTES = 'aide_configuration_manuelle_codesoft_etiquettes';
    const FIELDNAME_IS_ENABLED_FTA = 'is_enabled_fta';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

    static public function getListeCodesoftEtiquettes($paramIdFta, $paramIsEditable) {
        $HtmlList = new HtmlListSelect();
        $ftaModel = new FtaModel($paramIdFta);
        $SiteDeProduction = $ftaModel->getDataField(FtaModel::FIELDNAME_SITE_ASSEMBLAGE)->getFieldValue();


//        $arrayEtiquette = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
//                        'SELECT DISTINCT ' . CodesoftEtiquettesModel::KEYNAME . ',' . CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES
//                        . ' FROM ' . CodesoftEtiquettesModel::TABLENAME
//                        . ' WHERE (' . CodesoftEtiquettesModel::FIELDNAME_K_SITE . '=' . $SiteDeProduction
//                        . ' OR ' . CodesoftEtiquettesModel::FIELDNAME_K_SITE . '=0)'
//                        . ' AND (' . CodesoftEtiquettesModel::FIELDNAME_K_TYPE_ETIQUETTE_CODESOFT_ETIQUETTES . '=2'
//                        . ' OR ' . CodesoftEtiquettesModel::FIELDNAME_K_TYPE_ETIQUETTE_CODESOFT_ETIQUETTES . '=0' . ')'
//                        . ' AND ' . CodesoftEtiquettesModel::FIELDNAME_IS_ENABLED_FTA . '=1'
//                        . ' ORDER BY ' . CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES
//        );

         $arrayEtiquette = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                        'SELECT DISTINCT ' . CodesoftEtiquettesModel::KEYNAME . ',' . CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES
                        . ' FROM ' . CodesoftEtiquettesModel::TABLENAME
                        . ' WHERE (' . CodesoftEtiquettesModel::FIELDNAME_K_SITE . '=' . $SiteDeProduction
                        . ' OR ' . CodesoftEtiquettesModel::FIELDNAME_K_SITE . '=0)'
                        . ' AND (' . CodesoftEtiquettesModel::FIELDNAME_K_TYPE_ETIQUETTE_CODESOFT_ETIQUETTES . '<>2)'
                        . ' ORDER BY ' . CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES
        );
        $HtmlList->setArrayListContent($arrayEtiquette);

        $HtmlTableName = FtaModel::TABLENAME
                . '_'
                . FtaModel::FIELDNAME_ETIQUETTE_CODESOFT
                . '_'
                . $paramIdFta
        ;
        $HtmlList->getAttributes()->getName()->setValue(FtaModel::FIELDNAME_ETIQUETTE_CODESOFT);
        $HtmlList->setLabel(DatabaseDescription::getFieldDocLabel(CodesoftEtiquettesModel::TABLENAME, CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES));
        $HtmlList->setIsEditable($paramIsEditable);
        $HtmlList->initAbstractHtmlSelect(
                $HtmlTableName, $HtmlList->getLabel(), $ftaModel->getDataField(FtaModel::FIELDNAME_ETIQUETTE_CODESOFT)->getFieldValue(), NULL, $HtmlList->getArrayListContent());
        $HtmlList->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaModel::TABLENAME, FtaModel::KEYNAME, $paramIdFta, FtaModel::FIELDNAME_ETIQUETTE_CODESOFT);
        $listeCodesoftEtiquettes = $HtmlList->getHtmlResult();

        return $listeCodesoftEtiquettes;
    }

}
