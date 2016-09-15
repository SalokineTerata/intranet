<?php

/**
 * Description of IntranetDescriptionModel
 * @author franckwastaken
 */
class IntranetDescriptionModel extends AbstractModel {

    const TABLENAME = 'intranet_description';
    const KEYNAME = 'id_intranet_description';
    const FIELDNAME_TABLE_NAME_INTRANET_DESCRIPTION = 'table_intranet_description';
    const FIELDNAME_CHAMP_NAME_INTRANET_DESCRIPTION = 'champ_intranet_description';
    const FIELDNAME_EXPLICATION_INTRANET_DESCRIPTION = 'explication_intranet_description';
    const FIELDNAME_IS_ENABLED_INTRANET_DESCRIPTION = 'is_enabled_intranet_description';
    const IS_ENABLED_TRUE = '1';
    const IS_ENABLED_FALSE = '0';
    const DEFAULT_MESSAGE = "Aucune explication communiquée par le responsable de cette information.";
    const HREF_POPUP = "../lib/popup-mysql_field_desc.php";
    const HREF_JAVASCRIPT_BEGIN = "javascript:; onClick=MM_openBrWindow('";
    const HREF_JAVASCRIPT_END = "','pop','scrollbars=no,width=510,height=550')";

    protected function setDefaultValues() {
        
    }

    

    /**
     * Récupération de la description d'un champ
     * @param string $paramNameTable
     * @param string $paramNameVariable
     * @param string $paramLabel
     * @param boolean $paramIsEditable
     * @param object $paramHtmlObject
     * @return string
     */
    public static function getFieldDesc($paramNameTable, $paramNameVariable, $paramLabel, $paramIsEditable, $paramHtmlObject) {
        //Recherche des informations d'aide en ligne (format Pop-up)

        $req_explication = "SELECT " . self::FIELDNAME_TABLE_NAME_INTRANET_DESCRIPTION
                . "," . self::FIELDNAME_CHAMP_NAME_INTRANET_DESCRIPTION
                . "," . self::FIELDNAME_EXPLICATION_INTRANET_DESCRIPTION
                . "," . self::FIELDNAME_IS_ENABLED_INTRANET_DESCRIPTION
                . "," . self::KEYNAME
                . " FROM " . self::TABLENAME
                . " WHERE " . self::FIELDNAME_TABLE_NAME_INTRANET_DESCRIPTION . "='" . $paramNameTable . "' "
                . "AND " . self::FIELDNAME_CHAMP_NAME_INTRANET_DESCRIPTION . "='" . $paramNameVariable . "' "
        ;
        $arrayIntranetDescription = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req_explication);

        if ($arrayIntranetDescription) {
            foreach ($arrayIntranetDescription as $rowsIntranetDescription) {
                $id_intranet_description = $rowsIntranetDescription[self::KEYNAME];
                $explication_intranet_description = $rowsIntranetDescription[self::FIELDNAME_EXPLICATION_INTRANET_DESCRIPTION];
                $show_help = $rowsIntranetDescription[self::FIELDNAME_IS_ENABLED_INTRANET_DESCRIPTION];
            }
        } else {
            $id_intranet_description = self::insertIntranetDescription($paramNameTable, $paramNameVariable);
            $show_help = self::IS_ENABLED_TRUE;
        }
        $paramHtmlObject->setShowHelp($show_help);
        if ($show_help) {
            //Ajout des liens hypertextes
            $return .="<a title=\"" . $explication_intranet_description . "\" "
                    . "href="
                    . self::HREF_JAVASCRIPT_BEGIN
                    . self::HREF_POPUP
                    . "?id_intranet_description=" . $id_intranet_description
                    . "&disable_full_page=1"
                    . "&isEditable=" . $paramIsEditable
                    . "&champ_intranet_description=$paramNameVariable"
                    . self::HREF_JAVASCRIPT_END
                    . "  CLASS=link1 />"
                    . $paramLabel
                    . "</a>"
            ;
        }

        return $return;
    }

}
