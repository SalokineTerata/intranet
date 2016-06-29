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
    const FIELDNAME_IS_ENABLED_INTRANET_DESCRIPTION = 'is_enabled_intranet_description';
    const FIELDNAME_IS_ENABLED_INTRANET_HISTORIQUE = 'is_enabled_intranet_historique';
    const FIELDNAME_ID_LISTE_CHAPITRE_HISTORIQUE = 'id_liste_chapitre_historique';
    const FIELDNAME_UPLOAD_NAME_FILE = 'upload_name_file';
    const DEFAULT_FIELD_TO_LOCK_FOR_PRIMARY_FTA_VALUES = '1';
    const DEFAULT_FIELD_NOT_TO_LOCK_FOR_PRIMARY_FTA_VALUES = '2';
    const DEFAULT_MESSAGE = "Aucune explication communiquée par le responsable de cette information.";
    const HREF_POPUP = "../lib/popup-mysql_field_desc.php";
    const HREF_JAVASCRIPT_BEGIN = "javascript:; onClick=MM_openBrWindow('";
    const HREF_JAVASCRIPT_END = "','pop','scrollbars=no,width=510,height=550')";
    const IS_ENABLED_INTRANET_HISTORIQUE_TRUE = '1';
    const IS_ENABLED_INTRANET_HISTORIQUE_FALSE = '0';
    const IS_ENABLED_INTRANET_DESCRIPTION_TRUE = '1';
    const IS_ENABLED_INTRANET_DESCRIPTION_FALSE = '0';

    public function __construct($paramId = NULL, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist = AbstractModel::DEFAULT_IS_CREATE_RECORDSET_IN_DATABASE_IF_KEY_DOESNT_EXIST) {
        parent::__construct($paramId, $paramIsCreateRecordsetInDatabaseIfKeyDoesntExist);
    }

    protected function setDefaultValues() {
        
    }

    /**
     * Suppression d'un fichier d'un champ
     */
    function suppressionFile() {

        $link = ModuleConfigLib::CHEMIN_ACCES_UPLOAD . $this->getDataField(self::FIELDNAME_UPLOAD_NAME_FILE)->getFieldValue();
        if (file_exists($link)) {
            unlink($link);
        }

        DatabaseOperation::execute(
                ' UPDATE ' . self::TABLENAME . ' SET ' . self::FIELDNAME_UPLOAD_NAME_FILE . '=\'\''
                . ' WHERE ' . self::KEYNAME . '=' . $this->getKeyValue()
        );
    }

    /**
     * Tableau donnant la liste des champs verrouillé par défaut
     * @return array
     */
    public static function getArrayDefaultLockField() {
        $arrayIntranetColumInfoLockField = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT DISTINCT " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
                        . "," . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
                        . "," . IntranetColumnInfoModel::FIELDNAME_DEFAULT_FIELD_TO_LOCK_FOR_PRIMARY_FTA
                        . " FROM " . IntranetColumnInfoModel::TABLENAME
                        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_DEFAULT_FIELD_TO_LOCK_FOR_PRIMARY_FTA . "=" . IntranetColumnInfoModel::DEFAULT_FIELD_TO_LOCK_FOR_PRIMARY_FTA_VALUES
                        . " OR " . IntranetColumnInfoModel::FIELDNAME_DEFAULT_FIELD_TO_LOCK_FOR_PRIMARY_FTA . "=" . IntranetColumnInfoModel::DEFAULT_FIELD_NOT_TO_LOCK_FOR_PRIMARY_FTA_VALUES
        );

        return $arrayIntranetColumInfoLockField;
    }

    /**
     * On récupère le label un champ
     * @param string $paramTableName
     * @param string $paramColumnName
     * @return string
     */
    public static function getLabelByTableNameAndColummName($paramTableName, $paramColumnName) {
        $arrayIntranetColumnLabel = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        "SELECT DISTINCT " . IntranetColumnInfoModel::FIELDNAME_LABEL_INTRANET_COLUMN_INFO
                        . " FROM " . IntranetColumnInfoModel::TABLENAME
                        . " WHERE " . IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO . "='" . $paramTableName
                        . "' AND " . IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO . "='" . $paramColumnName . "'"
        );
        if ($arrayIntranetColumnLabel) {
            foreach ($arrayIntranetColumnLabel as $rowsIntranetColumnLabel) {
                $label = $rowsIntranetColumnLabel[IntranetColumnInfoModel::FIELDNAME_LABEL_INTRANET_COLUMN_INFO];
            }
        }

        return $label;
    }

    /**
     * Récupération de la description d'un champ
     * @param string $paramNameTable
     * @param string $paramNameVariable
     * @param string $paramLabel
     * @param object $paramHtmlObject
     * @return string
     */
    public static function getFieldDesc($paramNameTable, $paramNameVariable, $paramLabel, $paramHtmlObject) {
        //Recherche des informations d'aide en ligne (format Pop-up)

        $req_explication = "SELECT " . self::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
                . "," . self::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
                . "," . self::FIELDNAME_EXPLICATION_INTRANET_COLUMN_INFO
                . "," . self::FIELDNAME_IS_ENABLED_INTRANET_DESCRIPTION
                . "," . self::FIELDNAME_UPLOAD_NAME_FILE
                . "," . self::KEYNAME
                . " FROM " . self::TABLENAME
                . " WHERE " . self::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO . "='" . $paramNameTable . "' "
                . "AND " . self::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO . "='" . $paramNameVariable . "' "
        ;
        $arrayIntranetDescription = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req_explication);

        if ($arrayIntranetDescription) {
            foreach ($arrayIntranetDescription as $rowsIntranetDescription) {
                $id_intranet_column_info = $rowsIntranetDescription[self::KEYNAME];
                $explication_intranet_description = $rowsIntranetDescription[self::FIELDNAME_EXPLICATION_INTRANET_COLUMN_INFO];
                $show_help = $rowsIntranetDescription[self::FIELDNAME_IS_ENABLED_INTRANET_DESCRIPTION];
                $file = $rowsIntranetDescription[self::FIELDNAME_UPLOAD_NAME_FILE];
            }
        } else {
            $id_intranet_column_info = self::insertIntranetDescription($paramNameTable, $paramNameVariable);
            $show_help = self::IS_ENABLED_INTRANET_DESCRIPTION_TRUE;
        }
        if ($file) {
            $paperClipLink = Html::DEFAULT_HTML_IMAGE_PIECE_JOINTE;
            $paramHtmlObject->setShowImage("<div align=right width=25% ><a href=" . ModuleConfigLib::CHEMIN_ACCES_UPLOAD . $file . " onclick=\"window.open(this.href); return false;\" >" . $paperClipLink . "</a>");
        }

        $paramHtmlObject->setShowHelp($show_help);
        if ($show_help) {
            //Ajout des liens hypertextes
            $return .="<a title=\"" . $explication_intranet_description . "\" "
                    . " href="
                    . self::HREF_JAVASCRIPT_BEGIN
                    . self::HREF_POPUP
                    . "?id_intranet_column_info=" . $id_intranet_column_info
                    . self::HREF_JAVASCRIPT_END
                    . "  CLASS=link1 />"
                    . $paramLabel
                    . "</a>"
            ;
        }

        return $return;
    }

    /**
     * Ajout d'une Description
     * @param string $paramNameTable
     * @param string $paramNameVariable
     * @return int
     */
    public static function insertIntranetDescription($paramNameTable, $paramNameVariable) {
        $pdo = DatabaseOperation::executeComplete(
                        "INSERT INTO " . self::TABLENAME
                        . "(" . self::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO
                        . "," . self::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INO
                        . "," . self::FIELDNAME_EXPLICATION_INTRANET_COLUMN_INFO
                        . ")"
                        . "VALUES ('" . $paramNameTable
                        . "','" . $paramNameVariable
                        . "','" . self::DEFAULT_MESSAGE
                        . "')"
        );
        $key = $pdo->lastInsertId();
        return $key;
    }

    public static function setOwner($paramIsOwner) {
        $_SESSION["Owner"] = $paramIsOwner;
    }

    public static function getOwner() {
        return $_SESSION["Owner"];
    }

}
