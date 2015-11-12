<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Html
 *
 * @author bs4300280
 */
class Html {

    const DEFAULT_HTML_IMAGE_FAILED = AttributesGlobal::DEFAULT_HTML_IMAGE_FAILED;
    const DEFAULT_HTML_IMAGE_LOADING = AttributesGlobal::DEFAULT_HTML_IMAGE_LOADING;
    const DEFAULT_HTML_IMAGE_OK = AttributesGlobal::DEFAULT_HTML_IMAGE_OK;
    const DEFAULT_HTML_IMAGE_UNDO = AttributesGlobal::DEFAULT_HTML_IMAGE_UNDO;
    const DEFAULT_HTML_WARNING_UPDATE_IMAGE = "<img src=../lib/images/exclamation.png alt=\"\" title=\"Information mise à jour\" width=\"20\" height=\"18\" border=\"0\" />";
    const DEFAULT_HTML_WARNING_UPDATE_BGCOLOR = "background-color:#B0FFFE;";
    const DEFAULT_HTML_TABLE_TITRE = "table border=0 width=100% class=titre";
    const DEFAULT_HTML_TABLE_CONTENU = "table border=0 width=100% class=titre";
    const PREFIXE_ID_ROW = AttributesGlobal::PREFIXE_ID_ROW;
    const PREFIXE_ID_DATA = AttributesGlobal::PREFIXE_ID_DATA;
    const PREFIXE_ID_ICON_STATUS = AttributesGlobal::PREFIXE_ID_ICON_STATUS;
    const PREFIXE_ID_ICON_UNDO = AttributesGlobal::PREFIXE_ID_ICON_UNDO;
    const TYPE_OF_OBJECT_BOOLEAN = "BOOLEAN";
    const TYPE_OF_OBJECT_CALENDAR = "CALENDAR";
    const TYPE_OF_OBJECT_COLIS_COMPOSITION = "COLISCOMPOSITION";
    const TYPE_OF_OBJECT_INPUTTEXT = "INPUTTEXT";
    const TYPE_OF_OBJECT_INPUTNUMBER = "INPUTNUMBER";
    const TYPE_OF_OBJECT_LIST = "LIST";
    const TYPE_OF_OBJECT_SUBFORM_R1N = "SUBFORM_R1N";
    const TYPE_OF_OBJECT_SUBFORM_RNN = "SUBFORM_RNN";
    const TYPE_OF_OBJECT_TEXTAREA = "TEXTAREA";
    const TYPE_OF_OBJECT_UNITE_AFFICHAGE = "UNITEAFFICHAGE";
    const TYPE_OF_OBJECT_UNITE_FACTURATION = "UNITEFACTURATION";
    const JS_SCRIPTNAME_AUTOSAVE = "ajaxAutosave";
    const JS_SCRIPTNAME_DOACTION = "ajaxDoAction";

    /**
     * Retourne un attribut HTML pour être inséré dans du code HTML
     * @param mixed $paramName
     * @param mixed $paramValue
     * @return string Code HTML
     */
    public static function getHtmlParameter($paramName, $paramValue) {
        $return = NULL;
        if ($paramValue != NULL) {
            $return = " " . $paramName . " = \"" . self::showValue($paramValue) . "\"";
        }
        return $return;
    }

    public static function inputValue($value) {
        return '\'' . htmlspecialchars($value) . '\'';
    }

    public static function showValue($value) {
        return htmlspecialchars($value);
    }

    public static function popup($paramPopupName
    , $paramPopupContent
    , $ParamLink
    , $paramSpecialPage = null
    , $paramJavascriptOption = "scrollbars=yes,width=810,height=550,resizable=yes"
    ) {
        /**
         * @todo Peut-on se passer de la session ?
         */
        $_SESSION["popup_content"] = $paramPopupContent;

        $hrefPopup = "../lib/popup.php";
        $hrefJavascriptBegin = "javascript:; onClick=MM_openBrWindow('";
        $hrefJavascriptEnd = "','pop','$paramJavascriptOption')";

        return "<a title=\"$title\" "
                . "href="
                . $hrefJavascriptBegin
                . $hrefPopup
                . "?popup_name=" . $paramPopupName
                . "&edit_allow=false"
                . "&title=" . $title
                . "&special_page=" . $paramSpecialPage
                . $hrefJavascriptEnd
                . "  CLASS=link1 />"
                . $ParamLink
                . "</a>"
        ;
    }

    public static function getColumnInfoLabelWithHelp($table_name, $field_name, $show_help = true) {

        /*
          Dictionnaire des variables:
         * **************************
         */
//$conf = new conf();
//$conf = $_SESSION["globalConfig"];
        $bdd = $_SESSION["globalConfig"]->mysql_database_name;            //Variable Globale definissant le nom de la base de donnees MySQL
        $module = $_SESSION["module"];
        $nom_intranet_actions = Lib::isDefined("nom_intranet_actions");
        $comment = "";
        $show_help;                        //0=Pas d'aide, 1=Aide HTML popup activée
        $nom_table = $table_name;                        //Nom de la table du champ à charger
        $nom_variable = $field_name;                     //Nom du champ à charger
        $href_popup = "../lib/popup-mysql_field_desc.php";
        $href_javascript_begin = "javascript:; onClick=MM_openBrWindow('";
        $href_javascript_end = "','pop','scrollbars=no,width=510,height=550')";
        $default_message = "Aucune explication communiquée par le responsable de cette information.";


        //Corps de la fonction
        $id_intranet_description = DatabaseDescription::getColumnHelpId($nom_table, $nom_variable);
        $comment = DatabaseDescription::getColumnLabel($nom_table, $nom_variable);

        //Recherche des informations d'aide en ligne (format Pop-up)F
        $result_explication = DatabaseDescription::getColumnHelp($nom_table, $nom_variable);
        if ($result_explication == "") {
            //Génération du manuel
            $explication_intranet_description = $default_message;
            $request = "UPDATE " . $nom_table
                    . " SET `explication_intranet_column_info`='" . $explication_intranet_description . "' "
                    . " WHERE `id_intranet_column_info`='" . $id_intranet_description . "' ";
            DatabaseOperation::execute($request);
        }
        //Ajout des liens hypertextes
        $return .="<a title=\"" . $explication_intranet_description . "\" "
                . "href="
                . $href_javascript_begin
                . $href_popup
                . "?id_intranet_description=" . $id_intranet_description
                . "&disable_full_page=1"
                . "&nom_intranet_actions=" . $nom_intranet_actions
                . "&module=" . $module
                . "&champ_intranet_description=" . $nom_variable
                . $href_javascript_end
                . "  CLASS=link1 />"
                . $comment
                . "</a>"
        ;
        return $return;
    }

    /**
     * Retourne l'objet Html associé au champ DataField
     * @param DatabaseDataField $paramDataField
     * @param  $param
     * @return AbstractHtmlGlobalElement
     */
    public static function getHtmlObjectFromDataField(DatabaseDataField $paramDataField, $param = FALSE, $param2 = FALSE) {
        $htmlObject = NULL;
        $TypeOfHtmlObject = $paramDataField->getFieldTypeOfHtmlObject();

        switch ($TypeOfHtmlObject) {

            case Html::TYPE_OF_OBJECT_CALENDAR:
                $htmlObject = new DataFieldToHtmlInputCalendar($paramDataField);
                break;

            case Html::TYPE_OF_OBJECT_INPUTTEXT:
                $htmlObject = new DataFieldToHtmlInputText($paramDataField);
                break;

            case Html::TYPE_OF_OBJECT_LIST:
                $htmlObject = new DataFieldToHtmlListSelect($paramDataField);
                break;

            case Html::TYPE_OF_OBJECT_BOOLEAN:
                $htmlObject = new DataFieldToHtmlListBoolean($paramDataField);
                break;

            case Html::TYPE_OF_OBJECT_TEXTAREA:
                $htmlObject = new DataFieldToHtmlTextArea($paramDataField);
                break;

            case Html::TYPE_OF_OBJECT_SUBFORM_R1N:
                $htmlObject = new DataFieldToHtmlSubform_R1N($paramDataField);
                break;

            case Html::TYPE_OF_OBJECT_SUBFORM_RNN:
                $htmlObject = new DataFieldToHtmlSubform_RNN($paramDataField, $param,$param2);
                break;
            case Html::TYPE_OF_OBJECT_INPUTNUMBER:
                $htmlObject = new DataFieldToHtmlInputNumber($paramDataField);
                break;

            default:
                afficher_message("Erreur", "Type d'objet <b>" . $TypeOfHtmlObject . "</b> inconnu." . " Champs concerné:" . $paramDataField->getFieldName() . " ", $redirection);
//                throw new Exception();
        }

        return $htmlObject;
    }

    /**
     * Retourne le code HTML représentant le champs de la base de données
     * @param DatabaseDataField $paramDataField
     * @param type $paramIsEditable
     */
    public static function convertDataFieldToHtml(DatabaseDataField $paramDataField, $paramIsEditable) {

        $htmlObject = self::getHtmlObjectFromDataField($paramDataField);
        $htmlObject->setIsEditable($paramIsEditable);       

        return $htmlObject->getHtmlResult();
    }

}

?>
