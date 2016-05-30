<?php

/**
 * Description of IntranetColumnInfoModel
 * Table des utilisateurs
 *
 * @author franckwastaken
 */
class IntranetColumnInfoModel extends AbstractModel {

    const TABLENAME = 'intranet_column_info';
    const KEYNAME = 'id_intranet_column_info';
    const FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO = 'table_name_intranet_column_info';
    const FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO = 'column_name_intranet_column_info';
    const FIELDNAME_TYPE_OF_STORAGE = 'type_of_storage';
    const FIELDNAME_LABEL_INTRANET_COLUMN_INFO = 'label_intranet_column_info';
    const FIELDNAME_EXPLICATION_INTRANET_COLUMN_INFO = 'explication_intranet_column_info';
    const FIELDNAME_SQL_REQUEST_CONTENT_INTRANET_COLUMN_INFO = 'sql_request_content_intranet_column_info';
    const FIELDNAME_TYPE_OF_HTML_OBJECT_INTRANET_COLUMN_INFO = 'type_of_html_object_intranet_column_info';
    const FIELDNAME_SIZE_OF_HTML_OBJECT_INTRANET_COLUMN_INFO = 'size_of_html_object_intranet_column_info';
    const FIELDNAME_REFERENCED_TABLE_NAME = 'referenced_table_name';
    const FIELDNAME_REFERENCED_COLUMN_NAME = 'referenced_column_name';
    const FIELDNAME_FIELDS_TO_DISPLAY = 'fields_to_display';
    const FIELDNAME_FIELDS_TO_LOCK = 'fields_to_lock';
    const FIELDNAME_FIELDS_TO_ORDER = 'fields_to_order';
    const FIELDNAME_RIGHT_TO_ADD = 'right_to_add';
    const FIELDNAME_SQL_CONDITION_CONTENT_INTRANET_COLUMN_INFO = 'sql_condition_content_intranet_column_info';
    const FIELDNAME_TAGS_VALIDATION_RULES_INTRANET_COLUMN_INFO = 'tags_validation_rules_intranet_column_info';
    const FIELDNAME_DEFAULT_FIELD_TO_LOCK_FOR_PRIMARY_FTA = 'default_field_to_lock_for_primary_fta';
    const DEFAULT_FIELD_TO_LOCK_FOR_PRIMARY_FTA_VALUES = '1';
    const DEFAULT_FIELD_NOT_TO_LOCK_FOR_PRIMARY_FTA_VALUES = '2';

    protected function setDefaultValues() {
        
    }

    /**
     * Tableau donnant la liste des champs verrouillé par défaut
     * @return array
     */
    public static function getArrayDefaultLockField() {
        $arrayIntranetColumInfoLockField = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT DISTINCT " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
                        . "," . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
                        . "," . IntranetColumnInfoModel::DEFAULT_FIELD_TO_LOCK_FOR_PRIMARY_FTA_VALUES
                        . " FROM " . IntranetColumnInfoModel::TABLENAME
                        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_DEFAULT_FIELD_TO_LOCK_FOR_PRIMARY_FTA . "=" . IntranetColumnInfoModel::DEFAULT_FIELD_TO_LOCK_FOR_PRIMARY_FTA_VALUES
                        . " OR " . IntranetColumnInfoModel::FIELDNAME_DEFAULT_FIELD_TO_LOCK_FOR_PRIMARY_FTA . "=" . IntranetColumnInfoModel::DEFAULT_FIELD_NOT_TO_LOCK_FOR_PRIMARY_FTA_VALUES
        );

        return $arrayIntranetColumInfoLockField;
    }

}
