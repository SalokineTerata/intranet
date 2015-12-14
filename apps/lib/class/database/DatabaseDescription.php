<?php

/**
 * Cette classe récupère l'ensemble de le description de la base de données.<br>
 * Son résultat est stocké dans la session PHP $_SESSION[getclass()]<br>
 * Les données sont structurées de la manière suivantes (format print_r()):<br>
 * <pre>
 * $_SESSION[getclass()] => Array
 * (
 *    ['Nom de la table'] => Array                   (Ex: access_arti2)
 *    (
 *        [Key] = 'Nom du champ représentant la clef de la table'
 *        [Fields] => Array
 *        (
 *            ['Nom du champ'] => Array              (Ex: id_access_arti2)
 *            (
 *                [Sql] => Array                     //Caractéristiques SQL Standards
 *                (
 *                    [Field]  => 'Nom du champ'     (Ex: id_access_arti2)
 *                    [Type]   => 'type de donnée'   (Ex: int(11))
 *                    [Null]   => 'Peut-il être Nul?'(Ex: NO)
 *                    [Key]    => 'Type de clef'     (Ex: PRI) 
 *                    [Default]=> 'Valeur par défaut (Ex: -1)
 *                    [Extra]  => 'Supplément'       (Ex: auto_increment)
 *                )
 *                [Doc] => Array                      //Caractéristiques Personnalisés
 *                (
 *                    [IdDoc]  => 'Id Désignation'   (Ex: 2452)
 *                    [Label]  => 'Désignation'      (Ex: Clef de la table)
 *                    [Help]   => 'Aide'             (Ex: Cette clef est unique)                  
 *                    [ContentSql]   => Requête liste(Ex: 'SELECT * FROM TABLE1;')
 *                    [ContentArray] => Array        (Ex: array('clef1' => 'donnee1', 'clef2' => 'donnee2')
 *                    [TypeOfHtmlObject] => type HTML(Ex: CALENDAR, INPUTTEXT, LIST, SUBFORM ...)
 *                    [ForeignKey] => champs joint   (Ex: 'id_fta' si on se situe sur la table fta_processus_delai)
 *                    [ForeignTable] => Table jointe (Ex: 'fta'  si on se situe sur la table fta_processus_delai)
 *                    [FieldsToDisplay] => liste de champs (Ex: 'id_fta_processus,date_echeance_processus')
 *                    [FieldsToLock] => liste de champs    (Ex: 'id_fta_processus')
 *                    [FieldsToOrder] => liste de champs   (Ex: 'date_echeance_processus')
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
     * Nom du tableau contenant les caractéristiques de schéma
     */
    const ARRAY_NAME_SCHEMA = "Schema";

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
     * Nom de la variable contenant la requête SQL à exécuter pour fournir la
     * liste des choix dans le cas des listes déroulantes.
     */
    const ARRAY_NAME_DOC_SIZE_OF_HTML_OBJECT = "SizeOfHtmlObject";

    /**
     * Type de stockage de la donnée.
     * La donnée peut être réellement stockée en base de données : REAL
     * Elle peut etre virtuelle dans le cas de sous-table : VIRTUAL
     * Elle peut être calculée : CALCULATE.
     */
    const ARRAY_NAME_DOC_TYPE_OF_STORAGE = "TypeOfStorage";
    const TYPE_OF_STORAGE_REAL = "REAL";
    const TYPE_OF_STORAGE_VIRTUAL = "VIRTUAL";
    const TYPE_OF_STORAGE_CALCULATE = "CALCULATE";

    /**
     * Nom de la clé étrangère dans la table étrangère
     */
    const ARRAY_NAME_DOC_FOREIGN_KEY = "ForeignKey";

    /**
     * Nom de la table étrangère
     */
    const ARRAY_NAME_DOC_FOREIGN_TABLE = "ForeignTable";

    /**
     * Dans le cas d'une liste, champs à afficher
     */
    const ARRAY_NAME_DOC_FIELDS_TO_DISPLAY = "FieldsToDisplay";

    /**
     * Dans le cas d'une liste, champs à verrouiller
     */
    const ARRAY_NAME_DOC_FIELDS_TO_LOCK = "FieldsToLock";

    /**
     * Dans le cas d'une liste, classement des colonnes
     */
    const ARRAY_NAME_DOC_FIELDS_TO_ORDER = "FieldsToOrder";

    /**
     * Dans le cas d'une liste, droit d'ajouter une nouvelle ligne
     */
    const ARRAY_NAME_DOC_RIGHT_TO_ADD = "RightsToAdd";

    /**
     * Dans le cas d'une liste, droit d'ajouter une nouvelle ligne
     */
    const ARRAY_NAME_DOC_CONDITION_SQL = "ConditionSQL";

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
     * Nom de la variable contenant les informations
     * complémentaires (défini par MySQL)
     */
    const ARRAY_NAME_SQL_EXTRA = "Extra";

    /**
     * Nom de la variable contenant les informations du schéma relationnel
     * Nom de la table
     */
    const MYSQL_INFORMATION_SCHEMA_KEY_COLUMN_USAGE_TABLE_NAME = "TABLE_NAME";

    /**
     * Nom de la variable contenant les informations du schéma relationnel
     * Nom du champs
     */
    const MYSQL_INFORMATION_SCHEMA_KEY_COLUMN_USAGE_COLUMN_NAME = "COLUMN_NAME";

    /**
     * Nom de la variable contenant les informations du schéma relationnel
     * Nom du champs étranger
     */
    const MYSQL_INFORMATION_SCHEMA_KEY_COLUMN_USAGE_REFERENCED_COLUMN_NAME = "REFERENCED_COLUMN_NAME";

    /**
     * Nom de la variable contenant les informations du schéma relationnel
     * Nom de la table étrangère
     */
    const MYSQL_INFORMATION_SCHEMA_KEY_COLUMN_USAGE_REFERENCED_TABLE_NAME = "REFERENCED_TABLE_NAME";

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
         * Dans le cas où l'objet est sauvegardé dans la session, destruction de cet objet
         */
        if (isset($_SESSION[get_class()])) {
            unset($_SESSION[get_class()]);
        }

        /**
         * Récupération de la configuration de la base de données
         */
        self::setDatabaseName($paramDatabaseName);

        /**
         * Récupération des caractéristiques SQL de chaque champs de chaque table
         */
        self::buildSqlDescription();

        /**
         * Recherche de la documentation des champs
         */
        self::buildApplicationDocumentationDescription();

        /**
         * Récupération des relations des tables dans le schéma de la
         * base de données.
         */
        //self::buildSchemaRelationshipDescription();

        /**
         * Enregistrement du résultat final en session PHP $_SESSION
         */
        $_SESSION[get_class()] = self::$resultInSession;
    }

    public static function buildSqlDescription() {
        /**
         * Récupération des caractéristiques SQL de chaque champs de chaque table
         */
        ini_set('memory_limit', '-1');
        $array = DatabaseOperation::convertSqlStatementKeyAndOneFieldToArray('SHOW TABLES');
        foreach ($array as $rowsTables) {
            $tableName = $rowsTables[0];
            $tableDescription = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'DESC ' . DatabaseOperation::convertNameToSqlClause($tableName)
            );

            /**
             * Enregistrement des caractéristiques SQL de chaque champs
             * Parcours de chaque champs de la table en cours d'analyse.
             */
            foreach ($tableDescription as $rowsField) {

                if ($rowsField['Key'] == 'PRI') {
                    /**
                     * Enregistrement du l'information de la clef dans le résultat final:
                     */
                    self::$resultInSession[$tableName][self::ARRAY_NAME_KEY] = $rowsField['Field'];
                }

                /**
                 * Enregistrement du champs dans le résultat final: 
                 */
                self::$resultInSession[$tableName][self::ARRAY_NAME_FIELDS]
                        [$rowsField['Field']][self::ARRAY_NAME_SQL] = $rowsField;

                /**
                 * Est-ce que ce champ est une clef ?
                 * @todo Gestion de tables multi-clefs non implémentée
                 */
            }//Fin WHILE de parcours des champs
        }//Fin WHILE de parcours des tables
    }

    public static function buildApplicationDocumentationDescription() {
        /**
         * Recherche de la documentation des champs
         */
        $arrayDoc = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT table_name_intranet_column_info'
                        . ',column_name_intranet_column_info'
                        . ',label_intranet_column_info'
                        . ',explication_intranet_column_info'
                        . ',id_intranet_column_info'
                        . ',sql_request_content_intranet_column_info'
                        . ',size_of_html_object_intranet_column_info'
                        . ',type_of_html_object_intranet_column_info'
                        . ',type_of_storage'
                        . ',referenced_table_name'
                        . ',referenced_column_name'
                        . ',fields_to_display'
                        . ',fields_to_lock'
                        . ',fields_to_order'
                        . ',right_to_add'
                        . ',sql_condition_content_intranet_column_info'
                        . ' FROM `intranet_column_info` ');
        /**
         * Parcours du résultat de la recherche
         */
        foreach ($arrayDoc as $rowsDoc) {
            $tableName = $rowsDoc['table_name_intranet_column_info'];
            $columnName = $rowsDoc['column_name_intranet_column_info'];
            $label = $rowsDoc['label_intranet_column_info'];
            $help = $rowsDoc['explication_intranet_column_info'];
            $idDoc = $rowsDoc['id_intranet_column_info'];
            $contentSql = $rowsDoc['sql_request_content_intranet_column_info'];
            if ($contentSql) {
                $contentArray = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
                                $contentSql
                );
            } else {
                $contentArray = NULL;
            }
            $typeOfHtmlObject = $rowsDoc['type_of_html_object_intranet_column_info'];
            $sizeOfHtmlObject = $rowsDoc['size_of_html_object_intranet_column_info'];
            $typeOfStorage = $rowsDoc['type_of_storage'];
            $foreignTable = $rowsDoc['referenced_table_name'];
            $foreignKey = $rowsDoc['referenced_column_name'];
            $fieldsToDisplay = $rowsDoc['fields_to_display'];
            $fieldsToLock = $rowsDoc['fields_to_lock'];
            $fieldsToOrder = $rowsDoc['fields_to_order'];
            $rightToAdd = $rowsDoc['right_to_add'];
            $conditionSql = $rowsDoc['sql_condition_content_intranet_column_info'];


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
                self::ARRAY_NAME_DOC_SIZE_OF_HTML_OBJECT => $sizeOfHtmlObject,
                self::ARRAY_NAME_DOC_TYPE_OF_HTML_OBJECT => $typeOfHtmlObject,
                self::ARRAY_NAME_DOC_TYPE_OF_STORAGE => $typeOfStorage,
                self::ARRAY_NAME_DOC_FOREIGN_TABLE => $foreignTable,
                self::ARRAY_NAME_DOC_FOREIGN_KEY => $foreignKey,
                self::ARRAY_NAME_DOC_FIELDS_TO_DISPLAY => $fieldsToDisplay,
                self::ARRAY_NAME_DOC_FIELDS_TO_LOCK => $fieldsToLock,
                self::ARRAY_NAME_DOC_FIELDS_TO_ORDER => $fieldsToOrder,
                self::ARRAY_NAME_DOC_RIGHT_TO_ADD => $rightToAdd,
                self::ARRAY_NAME_DOC_CONDITION_SQL => $conditionSql
            );
        }
    }

//    public static function buildSchemaRelationshipDescription() {
//        /**
//         * Récupération des relations des tables
//         */
//        $tableRelationship = self::getArrayAllForeignKey();
//
//        foreach ($tableRelationship as $value) {
//
//            $paramTableName = $value[self::MYSQL_INFORMATION_SCHEMA_KEY_COLUMN_USAGE_TABLE_NAME];
//            $paramFieldName = $value[self::MYSQL_INFORMATION_SCHEMA_KEY_COLUMN_USAGE_COLUMN_NAME];
//            $paramForeignKey = $value[self::MYSQL_INFORMATION_SCHEMA_KEY_COLUMN_USAGE_REFERENCED_COLUMN_NAME];
//            $paramForeignTable = $value[self::MYSQL_INFORMATION_SCHEMA_KEY_COLUMN_USAGE_REFERENCED_TABLE_NAME];
//
//            self::$resultInSession[$paramTableName][self::ARRAY_NAME_FIELDS]
//                    [$paramFieldName][self::ARRAY_NAME_SCHEMA] = array(
//                self::ARRAY_NAME_DOC_FOREIGN_KEY => $paramForeignKey,
//                self::ARRAY_NAME_DOC_FOREIGN_TABLE => $paramForeignTable
//            );
//        }
//    }

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
     * Retourne la taille de l'objet HTML à utiliser pour représenter graphiquement
     * le champs
     * @param string $paramTableName Nom de la table
     * @param string $paramFieldName Nom du champs
     * @return string Type d'objet HTML
     */
    public static function getFieldDocSizeOfHtmlObject($paramTableName, $paramFieldName) {
        return $_SESSION[get_class()][$paramTableName][self::ARRAY_NAME_FIELDS]
                [$paramFieldName][self::ARRAY_NAME_DOC][self::ARRAY_NAME_DOC_SIZE_OF_HTML_OBJECT];
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
     * Retourne le type de stockage de la données en base de données.
     * @param string $paramTableName Nom de la table
     * @param string $paramFieldName Nom du champs
     * @return string Type de stockage
     */
    public static function getFieldDocTypeOfStorage($paramTableName, $paramFieldName) {
        return $_SESSION[get_class()][$paramTableName][self::ARRAY_NAME_FIELDS]
                [$paramFieldName][self::ARRAY_NAME_DOC][self::ARRAY_NAME_DOC_TYPE_OF_STORAGE];
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
     * Retourne la liste des champs à afficher
     * @param string $paramTableName Nom de la table
     * @param string $paramFieldName Nom du champs
     * @return string liste des champs à afficher
     */
    public static function getFieldsToDisplay($paramTableName, $paramFieldName) {
        return $_SESSION[get_class()][$paramTableName][self::ARRAY_NAME_FIELDS]
                [$paramFieldName][self::ARRAY_NAME_DOC][self::ARRAY_NAME_DOC_FIELDS_TO_DISPLAY];
    }

    /**
     * Retourne la liste des champs à verrouiller
     * @param string $paramTableName Nom de la table
     * @param string $paramFieldName Nom du champs
     * @return string liste des champs à verrouiller
     */
    public static function getFieldsToLock($paramTableName, $paramFieldName) {
        return $_SESSION[get_class()][$paramTableName][self::ARRAY_NAME_FIELDS]
                [$paramFieldName][self::ARRAY_NAME_DOC][self::ARRAY_NAME_DOC_FIELDS_TO_LOCK];
    }

    /**
     * Retourne la liste des champs à ordonner
     * @param string $paramTableName Nom de la table
     * @param string $paramFieldName Nom du champs
     * @return string liste des champs à ordonner
     */
    public static function getFieldsToOrder($paramTableName, $paramFieldName) {
        return $_SESSION[get_class()][$paramTableName][self::ARRAY_NAME_FIELDS]
                [$paramFieldName][self::ARRAY_NAME_DOC][self::ARRAY_NAME_DOC_FIELDS_TO_ORDER];
    }

    /**
     * Retourne le droit d'ajouter une nouvelle ligne dans une liste
     * @param string $paramTableName Nom de la table
     * @param string $paramFieldName Nom du champs
     * @return string droit d'ajouter une nouvelle ligne dans une liste
     */
    public static function getRightToAdd($paramTableName, $paramFieldName) {
        return $_SESSION[get_class()][$paramTableName][self::ARRAY_NAME_FIELDS]
                [$paramFieldName][self::ARRAY_NAME_DOC][self::ARRAY_NAME_DOC_RIGHT_TO_ADD];
    }

    /**
     * Retourne une condition d'une reqête sql  pour son éxécution
     * @param string $paramTableName Nom de la table
     * @param string $paramFieldName Nom du champs
     * @return string Retourne une condition d'une reqête sql  pour son éxécution
     */
    public static function getConditionSql($paramTableName, $paramFieldName) {
        return $_SESSION[get_class()][$paramTableName][self::ARRAY_NAME_FIELDS]
                [$paramFieldName][self::ARRAY_NAME_DOC][self::ARRAY_NAME_DOC_CONDITION_SQL];
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

    private static function getQueryForeignKey() {

        return 'SELECT k.TABLE_NAME, '
                . 'k.COLUMN_NAME, k.REFERENCED_TABLE_NAME, '
                . 'k.REFERENCED_COLUMN_NAME '
                . 'FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE AS k '
                . 'INNER JOIN INFORMATION_SCHEMA.TABLE_CONSTRAINTS AS c ON '
                . 'k.CONSTRAINT_SCHEMA = c.CONSTRAINT_SCHEMA '
                . 'AND k.CONSTRAINT_NAME = c.CONSTRAINT_NAME '
                . 'WHERE c.CONSTRAINT_TYPE =  \'FOREIGN KEY\' AND k.CONSTRAINT_SCHEMA = \'' . self::getDatabaseName() . '\''
        ;
    }

    public static function getArrayAllForeignKey() {
        $paramSql = self::getQueryForeignKey();
        return DatabaseOperation::convertSqlStatementWithoutKeyToArray($paramSql);
    }

    public static function getArrayAllTableRNForOneTableR1($paramTableR1) {
        $paramSql = self::getQueryForeignKey()
                . 'AND `REFERENCED_TABLE_NAME` = \'' . $paramTableR1 . '\''
        ;
        return DatabaseOperation::convertSqlStatementWithoutKeyToArray($paramSql);
    }

    public static function getFieldNameOfTableRelationR1NByTablesName($paramTableNameRN, $paramTableNameR1) {
        foreach ($_SESSION[get_class()][$paramTableNameR1][self::ARRAY_NAME_FIELDS] as $fieldOfTableR1) {

            if ($fieldOfTableR1[self::ARRAY_NAME_DOC][self::ARRAY_NAME_DOC_FOREIGN_TABLE] == $paramTableNameRN) {
                $foreignKeyName = $fieldOfTableR1[self::ARRAY_NAME_DOC][self::ARRAY_NAME_DOC_FOREIGN_KEY];
                $referencedKeyName = self::getTableKeyName($paramTableNameR1);
            }
        }
        return array($foreignKeyName => $referencedKeyName);
    }

}
