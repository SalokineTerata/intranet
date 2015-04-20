<?php

/**
 * Cette classe récupère l'ensemble de le description de la base de données.<br>
 * Son résultat est stocké dans la session PHP $_SESSION[getclass()]<br>
 * Les données sont structurées de la manière suivantes (format print_r()):<br>
 * <pre>
 * $_SESSION[getclass()] => Array
 * (
 *    ["Nom de la table"] => Array                   (Ex: access_arti2)
 *    (
 *        [Key] = "Nom du champ représentant la clef de la table"
 *        [Fields] => Array
 *        (
 *            ["Nom du champ"] => Array              (Ex: id_access_arti2)
 *            (
 *                [Sql] => Array                     //Caractéristiques SQL Standards
 *                (
 *                    [Field]  => "Nom du champ"     (Ex: id_access_arti2)
 *                    [Type]   => "type de donnée"   (Ex: int(11))
 *                    [Null]   => "Peut-il être Nul?"(Ex: NO)
 *                    [Key]    => "Type de clef"     (Ex: PRI) 
 *                    [Default]=> "Valeur par défaut (Ex: -1)
 *                    [Extra]  => "Supplément"       (Ex: auto_increment)
 *                )
 *                [Doc] => Array                      //Caractéristiques Personnalisés
 *                (
 *                    [IdDoc]  => "Id Désignation"   (Ex: 2452)
 *                    [Label]  => "Désignation"      (Ex: Clef de la table)
 *                    [Help]   => "Aide"             (Ex: Cette clef est unique)                  
 *                    [ContentSql]   => Requête liste(Ex: "SELECT * FROM TABLE1;")
 *                    [ContentArray] => Array        (Ex: array("clef1" => "donnee1", "clef2" => "donnee2")
 *                    [TypeOfHtmlObject] => type HTML(Ex: CALENDAR, INPUTTEXT, LIST, SUBFORM ...)
 *                    [ForeignKey] => jointure SQL   (Ex: "fta_processus_delai.id_fta=fta.id_fta")
 *                    [ForeignTable] => Table jointe (Ex: "fta")
 *                )
 *        )
 *    )
 * )
 * </pre>
 * @author Salokine Terata
 * @license see LICENSE.TXT at the root of this project
 * @version 2.0
 * @todo Gestion de table multi-clef
 */
class DatabaseDescription {

    /**
     * Nom du tableau contenant la documentation d'un champ
     */
    const ARRAY_NAME_DOC = "Doc";

    /**
     * Nom du tableau contenant les caractéristiques SQL d'un champ
     */
    const ARRAY_NAME_SQL = "Sql";

    /**
     * Nom du tableau contenant la liste des champs d'une table
     */
    const ARRAY_NAME_FIELDS = "Fields";

    /**
     * Nom de la variable contenant le nom de la clef d'une table
     */
    const ARRAY_NAME_KEY = "Key";

    /**
     * Nom de la variable contenant la clef de la documentation du champ
     */
    const ARRAY_NAME_DOC_KEY = "IdDoc";

    /**
     * Nom de la variable contenant le label du champ
     */
    const ARRAY_NAME_DOC_LABEL = "Label";

    /**
     * Nom de la variable contenant l'aide relative au champ
     */
    const ARRAY_NAME_DOC_HELP = "Help";

    /**
     * Nom de la variable contenant la requête SQL à exécuter pour fournir la
     * liste des choix dans le cas des listes déroulantes.
     */
    const ARRAY_NAME_DOC_CONTENT_SQL = "ContentSql";

    /**
     * Nom de la variable contenant le résultat de la requête SQL qui fourni la
     * liste des choix dans le cas des listes déroulantes.
     */
    const ARRAY_NAME_DOC_CONTENT_ARRAY = "ContentArray";

    /**
     * Type d'objet HTML à utiliser pour le rendu écran
     * Voir Html::TYPE_OF_OBJECT_*
     */
    const ARRAY_NAME_DOC_TYPE_OF_HTML_OBJECT = "TypeOfHtmlObject";

    /**
     * Nom de la clé étrangère dans la table étrangère
     */
    const ARRAY_NAME_DOC_FOREIGN_KEY = "ForeignKey";

    /**
     * Nom de la table étrangère
     */
    const ARRAY_NAME_DOC_FOREIGN_TABLE = "ForeignTable";

    /**
     * Nom de la variable contenant le nom du champ (défini par MySQL)
     */
    const ARRAY_NAME_SQL_FIELDNAME = "Field";

    /**
     * Nom de la variable contenant le type du champ (défini par MySQL)
     */
    const ARRAY_NAME_SQL_TYPE = "Type";

    /**
     * Nom de la variable contenant l'information comme quoi
     * le champ peut être de valeur null (défini par MySQL)
     */
    const ARRAY_NAME_SQL_ISNULL = "Null";

    /**
     * Nom de la variable contenant l'information comme quoi
     * le champ peut être une clef (défini par MySQL)
     */
    const ARRAY_NAME_SQL_KEY = "Key";

    /**
     * Nom de la variable contenant la valeur par défaut (défini par MySQL)
     */
    const ARRAY_NAME_SQL_DEFAULT = "Default";

    /**
     * Nom de la variable contenant les inforamtions
     * complémentaires (défini par MySQL)
     */
    const ARRAY_NAME_SQL_EXTRA = "Extra";

    /**
     * Tableau de résultat stocké dans $_SESSION
     * @var array 
     * @static
     */
    private static $resultInSession = array();

    /**
     * Nom de la base de données
     * @var mixed 
     */
    private static $databaseName = NULL;

    /**
     * Régénère la description de la base de données dans $_SESSION
     * @param mixed $paramDatabaseName
     */
    public static function buildDatabaseDescription($paramDatabaseName) {

        /**
         * Récupération de la configuration de la base de données
         */
        self::setDatabaseName($paramDatabaseName);

        /**
         * Dans le cas où l'objet est sauvegardé dans la session, destruction de cet objet
         */
        if (isset($_SESSION[get_class()])) {
            unset($_SESSION[get_class()]);
        }

        /**
         * Récupération des caractéristiques SQL de chaque champs de chaque table
         */
        $result = DatabaseOperation::query("SHOW TABLES");
        while ($rowsTables = mysql_fetch_array($result)) {
            $tableName = $rowsTables[0];
            $tableDescription = DatabaseOperation::convertSqlResultWithoutKeyToArray(
                            DatabaseOperation::query("DESC " . DatabaseOperation::convertNameToSqlClause($tableName))
            );

            /**
             * Enregistrement des caractéristiques SQL de chaque champs
             * Parcours de chaque champs de la table en cours d'analyse.
             */
            foreach ($tableDescription as $rowsField) {

                if ($rowsField["Key"] == "PRI") {
                    /**
                     * Enregistrement du l'information de la clef dans le résultat final:
                     */
                    self::$resultInSession[$tableName][self::ARRAY_NAME_KEY] = $rowsField["Field"];
                }

                /**
                 * Enregistrement du champs dans le résultat final: 
                 */
                self::$resultInSession[$tableName][self::ARRAY_NAME_FIELDS]
                        [$rowsField["Field"]][self::ARRAY_NAME_SQL] = $rowsField;

                /**
                 * Est-ce que ce champ est une clef ?
                 * @todo Gestion de tables multi-clefs non implémentée
                 */
            }//Fin WHILE de parcours des champs
        }//Fin WHILE de parcours des tables

        /**
         * Recherche de la documentation des champs
         */
        $resultDoc = DatabaseOperation::query("SELECT id_intranet_column_info, table_name_intranet_column_info, "
                        . "column_name_intranet_column_info, "
                        . "label_intranet_column_info, explication_intranet_column_info, sql_request_content_intranet_column_info, type_of_html_object_intranet_column_info "
                        . "FROM  `intranet_column_info` ");
        /**
         * Parcours du résultat de la recherche
         */
        while ($rowsDoc = mysql_fetch_array($resultDoc)) {
            $tableName = $rowsDoc["table_name_intranet_column_info"];
            $columnName = $rowsDoc["column_name_intranet_column_info"];
            $label = $rowsDoc["label_intranet_column_info"];
            $help = $rowsDoc["explication_intranet_column_info"];
            $idDoc = $rowsDoc["id_intranet_column_info"];
            $contentSql = $rowsDoc["sql_request_content_intranet_column_info"];
            $contentArray = DatabaseOperation::convertSqlResultKeyAndOneFieldToArray(
                            DatabaseOperation::query($contentSql)
            );
            $TypeOfHtmlObject = $rowsDoc["type_of_html_object_intranet_column_info"];


            /**
             * Enregistrement dans le résultat final:
             */
            self::$resultInSession[$tableName][self::ARRAY_NAME_FIELDS]
                    [$columnName][self::ARRAY_NAME_DOC] = array(
                self::ARRAY_NAME_DOC_KEY => $idDoc,
                self::ARRAY_NAME_DOC_LABEL => $label,
                self::ARRAY_NAME_DOC_HELP => $help,
                self::ARRAY_NAME_DOC_CONTENT_SQL => $contentSql,
                self::ARRAY_NAME_DOC_CONTENT_ARRAY => $contentArray,
                self::ARRAY_NAME_DOC_TYPE_OF_HTML_OBJECT => $TypeOfHtmlObject
            );
        }

        /**
         * Récupération des relations des tables
         */
        $tableRelationship = self::getArrayAllForeignKey();

        foreach ($tableRelationship as $value) {

            $paramTableName = $value["TABLE_NAME"];
            $paramFieldName = $value["COLUMN_NAME"];
            $paramForeignKey = $value["REFERENCED_COLUMN_NAME"];
            $paramForeignTable = $value["REFERENCED_TABLE_NAME"];
            self::$resultInSession[$paramTableName][self::ARRAY_NAME_FIELDS]
                    [$paramFieldName][self::ARRAY_NAME_DOC][self::ARRAY_NAME_DOC_FOREIGN_KEY] = $paramForeignKey;
            self::$resultInSession[$paramTableName][self::ARRAY_NAME_FIELDS]
                    [$paramFieldName][self::ARRAY_NAME_DOC][self::ARRAY_NAME_DOC_FOREIGN_TABLE] = $paramForeignTable;
        }


        /**
         * Enregistrement du résultat final en session PHP $_SESSION
         */
        $_SESSION[get_class()] = self::$resultInSession;
    }

    /**
     * Le champs est-il de type clef primaire ?
     * @param mixed $paramTableName
     * @param mixed $paramFieldName
     * @return boolean
     */
    public static function isFieldPrimaryKey($paramTableName, $paramFieldName) {
        $return = false;
        if (DatabaseDescription::getTableKeyName($paramTableName) == $paramFieldName) {
            $return = true;
        }
        return $return;
    }

    /**
     * Retourne le nom de la base de données.
     * @return mixed
     */
    public static function getDatabaseName() {
        return self::$databaseName;
    }

    /**
     * Défini le nom de la base de données.
     * @param mixed $paramDatabaseName
     */
    public static function setDatabaseName($paramDatabaseName) {
        self::$databaseName = $paramDatabaseName;
    }

    /**
     * Retourne le nom de la clef de la table
     * @param string $paramTableName
     * @return string Nom du champs
     */
    public static function getTableKeyName($paramTableName) {
        return $_SESSION[get_class()][$paramTableName][self::ARRAY_NAME_KEY];
    }

    /**
     * Retourne le nom du champ dans la table étrangère
     * @param string $paramTableName Nom de la table
     * @param string $paramFieldName Nom du champs
     * @return string Label du champ
     */
    public static function getFieldDocForeignKey($paramTableName, $paramFieldName) {
        return $_SESSION[get_class()][$paramTableName][self::ARRAY_NAME_FIELDS]
                [$paramFieldName][self::ARRAY_NAME_DOC][self::ARRAY_NAME_DOC_FOREIGN_KEY];
    }

    /**
     * Retourne de la table étrangère
     * @param string $paramTableName Nom de la table
     * @param string $paramFieldName Nom du champs
     * @return string Label du champ
     */
    public static function getFieldDocForeignTable($paramTableName, $paramFieldName) {
        return $_SESSION[get_class()][$paramTableName][self::ARRAY_NAME_FIELDS]
                [$paramFieldName][self::ARRAY_NAME_DOC][self::ARRAY_NAME_DOC_FOREIGN_TABLE];
    }

    /**
     * Retourne le label (nom applicatif) d'un champs
     * @param string $paramTableName Nom de la table
     * @param string $paramFieldName Nom du champs
     * @return string Label du champ
     */
    public static function getFieldDocLabel($paramTableName, $paramFieldName) {
        return $_SESSION[get_class()][$paramTableName][self::ARRAY_NAME_FIELDS]
                [$paramFieldName][self::ARRAY_NAME_DOC][self::ARRAY_NAME_DOC_LABEL];
    }

    /**
     * Retourne la requête SQL construisant la liste de choix possible pour
     * le champs
     * @param string $paramTableName Nom de la table
     * @param string $paramFieldName Nom du champs
     * @return string Requête SQL
     */
    public static function getFieldDocContentSQL($paramTableName, $paramFieldName) {
        return $_SESSION[get_class()][$paramTableName][self::ARRAY_NAME_FIELDS]
                [$paramFieldName][self::ARRAY_NAME_DOC][self::ARRAY_NAME_DOC_CONTENT_SQL];
    }

    /**
     * Retourne le type d'objet HTML à utiliser pour représenter graphiquement
     * le champs
     * @param string $paramTableName Nom de la table
     * @param string $paramFieldName Nom du champs
     * @return string Type d'objet HTML
     */
    public static function getFieldDocTypeOfHtmlObject($paramTableName, $paramFieldName) {
        return $_SESSION[get_class()][$paramTableName][self::ARRAY_NAME_FIELDS]
                [$paramFieldName][self::ARRAY_NAME_DOC][self::ARRAY_NAME_DOC_TYPE_OF_HTML_OBJECT];
    }

    /**
     * Retourne le résultat de la requête SQL construisant la liste de 
     * choix possible pour le champs
     * @param string $paramTableName Nom de la table
     * @param string $paramFieldName Nom du champs
     * @return array Résultat SQL sous forme d'un tableau à 2 colonnnes
     */
    public static function getFieldDocContentArray($paramTableName, $paramFieldName) {
        return $_SESSION[get_class()][$paramTableName][self::ARRAY_NAME_FIELDS]
                [$paramFieldName][self::ARRAY_NAME_DOC][self::ARRAY_NAME_DOC_CONTENT_ARRAY];
    }

    /**
     * Le champs existe-il dans cette table ?
     * @param string $paramTableName
     * @param string $paramFieldName
     * @return boolean
     */
    public static function isFieldExistInThisTable($paramTableName, $paramFieldName) {
        $result = FALSE;

        if ($_SESSION[get_class()][$paramTableName][self::ARRAY_NAME_FIELDS]
                [$paramFieldName][self::ARRAY_NAME_SQL][self::ARRAY_NAME_SQL_FIELDNAME]) {
            $result = TRUE;
        }

        return $result;
    }

    /**
     * Retourne l'aide en ligne relative à ce champs
     * @param string $paramTableName Nom de la table
     * @param string $paramFieldName Nom du champs
     * @return string aide en ligne
     */
    public static function getFieldDocHelp($paramTableName, $paramFieldName) {
        return $_SESSION[get_class()][$paramTableName][self::ARRAY_NAME_FIELDS]
                [$paramFieldName][self::ARRAY_NAME_DOC][self::ARRAY_NAME_DOC_HELP];
    }

    /**
     * Retourne l'identifiant de la documentation du champs
     * @param string $paramTableName Nom de la table
     * @param string $paramFieldName Nom du champs
     * @return mixed valeur de la clef
     */
    public static function getFieldDocKey($paramTableName, $paramFieldName) {
        return $_SESSION[get_class()][$paramTableName][self::ARRAY_NAME_FIELDS]
                [$paramFieldName][self::ARRAY_NAME_DOC][self::ARRAY_NAME_DOC_KEY];
    }

    /**
     * Retourne un tableau d'objet DatabaseDescriptionField
     * @param string $paramTableName Nom de la table
     * @return array Tableau d'objet DatabaseDescriptionField
     */
    public static function getArrayFieldsNameOfTable($paramTableName) {
        $arrayFieldsName = array();
        foreach ($_SESSION[get_class()][$paramTableName][self::ARRAY_NAME_FIELDS] as $key => $value) {
            $arrayFieldsName[] = $key;
        }
        return $arrayFieldsName;
    }

    /**
     * Retourne un tableau [nom du champs => Objet DatabaseDescriptionField]
     * @param string $paramTableName
     * @return array [nom du champs => Objet DatabaseDescriptionField]
     */
    public static function getArrayFieldsOfTable($paramTableName) {
        $arrayFieldsName = self::getArrayFieldsNameOfTable($paramTableName);
        $table = new DatabaseDescriptionTable($paramTableName);
        $arrayResult = array();

        foreach ($arrayFieldsName as $fieldName) {
            $arrayResult[$fieldName] = new DatabaseDescriptionField($table, $fieldName);
        }
        return $arrayResult;
    }

    public static function getArrayAllForeignKey() {
        $paramSql = "SELECT k.TABLE_NAME, "
                . "k.COLUMN_NAME, k.REFERENCED_TABLE_NAME, "
                . "k.REFERENCED_COLUMN_NAME "
                . "FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE AS k "
                . "INNER JOIN INFORMATION_SCHEMA.TABLE_CONSTRAINTS AS c ON "
                . "k.CONSTRAINT_SCHEMA = c.CONSTRAINT_SCHEMA "
                . "AND k.CONSTRAINT_NAME = c.CONSTRAINT_NAME "
                . "WHERE c.CONSTRAINT_TYPE =  'FOREIGN KEY' AND k.CONSTRAINT_SCHEMA = '" . self::getDatabaseName() . "'"
        ;

        return DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray($paramSql);
    }

}

?>
