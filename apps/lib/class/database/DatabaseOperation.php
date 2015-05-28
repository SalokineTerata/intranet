<?php

/**
 * Cette classe regroupe les opérations bas niveau à executer dans la base de
 * données.
 * 
 * @author salokine.terata@gmail.com
 * @license see LICENSE.TXT at the root of this project
 * @version 1.0
 */
class DatabaseOperation {

    /**
     * Nombre de requête SQL exécutée
     * @var integer Nombre de requête SQL exécutée
     */
    protected static $queryCount = 0;

    /**
     * Liste des requêtes exécutées
     * @var string Liste des requêtes exécutées
     */
    protected static $queryRequest = "";

    /**
     * Tableau contenant une colonne "request", une colonne "time" et une colonne backtrace
     * @var array 
     */
    protected static $queriesInfo = array();

    /**
     * La fonction mysql_query retourne un résultat de type "resource"
     */
    const QUERY_RETURN_TYPE_RESOURCE = "RESOURCE";

    /**
     * La fonction mysql_query retourne un résultat de type "array"
     */
    const QUERY_RETURN_TYPE_ARRAY = "ARRAY";

    /**
     * Opérateur SQL AND
     */
    const SQL_OPERATOR_AND = "AND";

    /**
     * Séparateur SQL virgule
     */
    const SQL_SEPARATOR_LIST = ",";

    /**
     * Nom du la clef du tableau self::queriesInfo contenant la requête
     */
    const QUERIES_INFO_ARRAY_NAME_REQUEST = "request";

    /**
     * Nom du la clef du tableau self::queriesInfo contenant la horodatage
     */
    const QUERIES_INFO_ARRAY_NAME_TIME = "time";

    /**
     * Nom du la clef du tableau self::queriesInfo contenant les traces
     */
    const QUERIES_INFO_ARRAY_NAME_BACKTRACE = "backtrace";

    /**
     * Permet de convertir un tableau de donnée pour être intégré dans<br>
     * une clause SQL WHERE<br>
     * <br>
     * <b>Exemple:</b><br>
     * $table_name = "table1"<br>
     * $keys = array(champs1 => 1234 ,champs2 => 4321)<br>
     * <br>
     * <b>retourne:</b><br>
     * return " `table1.champs1` = '1234' AND `table1.champs2` = '4321' "<br>
     * @param string $paramTableName Nom de la table
     * @param array $paramValues tableau clef/donnee où clef est le champs et donnée sa valeur
     * @return string Partie prête à être insérée dans le WHERE d'une requête SQL
     */
    public static function convertArrayToSqlClauseWhere($paramTableName, $paramValues) {
        return self::convertArrayToSqlClause($paramTableName, $paramValues, self::SQL_OPERATOR_AND);
    }

    /**
     * Permet de convertir un tableau de donnée pour être intégré dans<br>
     * une clause SQL SET<br>
     * <br>
     * <b>Exemple:</b><br>
     * $table_name = "table1"<br>
     * $keys = array(champs1 => 1234 ,champs2 => 4321)<br>
     * <br>
     * <b>retourne:</b><br>
     * return " `table1.champs1` = '1234', `table1.champs2` = '4321' "<br>
     * @param string $paramTableName Nom de la table
     * @param array $paramValues tableau clef/donnee où clef est le champs et donnée sa valeur
     * @return string Partie prête à être insérée dans le WHERE d'une requête SQL
     */
    public static function convertArrayToSqlClauseSet($paramTableName, $paramValues) {
        return self::convertArrayToSqlClause($paramTableName, $paramValues, self::SQL_SEPARATOR_LIST);
    }

    /**
     * Permet de convertir un tableau de donnée pour être intégré dans<br>
     * une clause SQL<br>
     * @param string $paramTableName Nom de la table
     * @param array $paramValues tableau clef/donnee où clef est le champs et donnée sa valeur
     * @param string Opérateur ou séparateur SQL 
     * @return string Partie prête à être insérée dans le WHERE d'une requête SQL
     */
    protected static function convertArrayToSqlClause($paramTableName, $paramValues, $paramOperator) {
        $operator = " " . $paramOperator . " ";
        $currentOperator = "";
        $statement = "";

        foreach ($paramValues as $key => $value) {
            $statement .= $currentOperator;
            $statement .= self::convertNameToSqlClause($paramTableName) . "." . self::convertNameToSqlClause($key) . " = " . DatabaseOperation::convertDataForQuery($value) . " ";
            $currentOperator = $operator;
        }

        return $statement;
    }

    /**
     * Retourne le nombre de requête SQL exécutées
     * @return integer Nombre de requête SQL exécutées
     */
    public static function getQueryCount() {
        self::$queryCount;
    }

    /**
     * Augmente le compteur comptant le nombre de requête exécutée
     * @return integer Nombre de requête SQL exécutées
     */
    private static function IncrementQueryCount() {
        return self::$queryCount++;
    }

    /**
     * Tableau contenant une colonne "request", une colonne "time" et une colonne backtrace
     * @return array
     */
    public static function getQueriesInfo() {
        return self::$queriesInfo;
    }

    /**
     * Définit les informations relatives à l'exécution des requêtes.<br>
     * @param string $paramRequest requête SQL
     * @param type $paramTime Temps d'excution
     * @param type $paramQueryCount Ordre de la requête
     */
    public static function setQueriesInfo($paramRequest, $paramTime, $paramQueryCount) {
        self::$queriesInfo[$paramQueryCount][self::QUERIES_INFO_ARRAY_NAME_REQUEST] = $paramRequest;
        self::$queriesInfo[$paramQueryCount][self::QUERIES_INFO_ARRAY_NAME_TIME] = $paramTime;
        self::$queriesInfo[$paramQueryCount][self::QUERIES_INFO_ARRAY_NAME_BACKTRACE] = debug_backtrace();
    }

    /**
     * Retourne le jeu de résultat SQL suite à l'exécution de la requête SQL
     * transmise ($request)
     * @param string $request
     * @return resource
     */
    public static function query($paramRequest) {

        $firstTime = microtime(true);
        $result = mysql_query($paramRequest);
        $time = round(microtime(true) - $firstTime, 4);
        self::setQueriesInfo($paramRequest, $time, self::IncrementQueryCount());
        return $result;
    }

    /**
     * Convertie un résultat SQL (un seul enregistrement) en tableau PHP
     * @param resource $paramResult
     */
    public static function convertSqlResultFirstRowToArray($paramResult) {
        return mysql_fetch_assoc($paramResult);
    }

    /**
     * Convertie un résultat SQL en tableau PHP
     * La clef du tableau sera générée car asbente dans le résultat SQL
     * @param resource $paramResult
     * @return array Tableau
     */
    public static function convertSqlResultWithoutKeyToArray($paramResult) {
        $return = NULL;
        $i = 0;
        if ($paramResult <> NULL) {
            while ($rows = mysql_fetch_array($paramResult, MYSQL_ASSOC)) {
                $return[$i] = $rows;
                $i++;
            }
        }
        return $return;
    }

    /**
     * Convertie un résultat SQL en tableau PHP
     * La clef du tableau sera générée car asbente dans le résultat SQL
     * @param resource $paramResult
     * @return array Tableau
     */
    public static function convertSqlResultWithKeyAsFirstFieldToArray($paramResult) {
        $return = NULL;
        $i = 0;
        if ($paramResult <> NULL) {
            while ($rows = mysql_fetch_array($paramResult, MYSQL_ASSOC)) {
                $keys = array_keys($rows);
                $key_value = $rows[$keys[0]];

                //Suppression de la clef dans la liste des champs
                unset($rows[$keys[0]]);
                $return[$key_value] = $rows;
                $i++;
            }
        }
        return $return;
    }

    /**
     * Convertie un résultat SQL en tableau PHP
     * La clef du tableau sera celle de la première colonne du résultat SQL
     * @param resource $paramResult
     * @return array Tableau PHP
     */
    public static function convertSqlResultKeyAndOneFieldToArray($paramResult) {
        $return = NULL;
        if ($paramResult <> NULL) {
            while ($rows = mysql_fetch_array($paramResult, MYSQL_NUM)) {
                $return[$rows[0]] = $rows[1];
            }
            return $return;
        }
    }

    /**
     * Exécute, puis convertie un requête SQL en tableau PHP
     * La clef du tableau sera celle de la première colonne du résultat SQL
     * @param mixed $paramRequest
     * @return array Tableau PHP
     */
    public static function convertSqlQueryWithKeyAsFirstFieldToArray($paramRequest) {

        return DatabaseOperation::convertSqlResultKeyAndOneFieldToArray(
                        DatabaseOperation::query(
                                $paramRequest
                        )
        );
    }

    /**
     * Exécute, puis convertie un requête SQL en tableau PHP
     * La clef du tableau sera générée automatiquement par PHP
     * @param mixed $paramRequest
     * @return array Tableau PHP
     */
    public static function convertSqlQueryWithAutomaticKeyToArray($paramRequest) {

        return DatabaseOperation::convertSqlResultWithoutKeyToArray(
                        DatabaseOperation::query(
                                $paramRequest
                        )
        );
    }

    /**
     * Affiche les informations d'exécution des requêtes SQL dans une Popup
     * @return type
     */
    public static function showPopupForQueriesInfo() {
        $default_message = "";
        $special_page = "MYSQL_QUERIES";
        $title = "MySQL - " . count(DatabaseOperation::$queriesInfo) . " requêtes";
        return Html::popup("popup_queries_info", $default_message, $title, $special_page);
    }

    /**
     * Prépare une données PHP a être insérée dans une requête qui va être exécutée par le SGBD<br>
     * la donnée subit des transformation pour echaper les caractères pouvants<br>
     * poser soucis lors de l'interprétation de la requête par le SGBD<br>
     * @param string $data Donnée à protéger
     * @return string Donnée protégée
     */
    public static function convertDataForQuery($paramPhpData) {
        /**
         * Une valeur PHP "vide" est interprétée comme NULL en MySQL
         */
        $sqlData = "";
        if ($paramPhpData == "") {
            $sqlData = " NULL";
        } else {
            $sqlData = " '" . mysql_real_escape_string($paramPhpData) . "'";
        }
        return $sqlData;
    }

    /**
     * Prépare un nom (de champs ou de table) a être insérée dans une requête SQL<br>
     * la donnée subit des transformation pour echaper les caractères pouvant<br>
     * poser soucis lors de l'interprétation de la requête par le SGBD<br>
     * @param string $paramPhpField nom à protéger
     * @return string nom protégé
     */
    public static function convertNameToSqlClause($paramPhpName) {

        if ($paramPhpName != NULL) {
            return "`" . $paramPhpName . "`";
        }
    }

    /**
     * Retourne le nombre d'enregistrement dans un résultat SQL
     * @param mixed $paramSqlResult
     * @return integer
     */
    public static function getSqlNumRows($paramSqlResult) {
        $return = mysql_num_rows($paramSqlResult);
        return $return;
    }

    /**
     * Retourne l'enregistrement de la base de données.
     * Attention, ne gère que les tables "mono-clef"
     * @param string $paramTableName Nom de la table
     * @param mixed $paramKeyValue Valeur de la clef
     * @return resource Résultat SQL
     */
    public static function getSqlResultFromOneKeyValue($paramTableName, $paramKeyValue) {

        return DatabaseOperation::query(
                        DatabaseOperation::getSqlQueryFromOneKeyValue($paramTableName, $paramKeyValue)
        );
    }

    /**
     * Retourne la requete SQL à partir d'un crière sur la clef
     * Attention, ne gère que les tables "mono-clef"
     * @param string $paramTableName Nom de la table
     * @param mixed $paramKeyValue Valeur de la clef
     * @return mixed requête SQL
     */
    public static function getSqlQueryFromOneKeyValue($paramTableName, $paramKeyValue) {

        return DatabaseOperation::getSqlQueryFromOneField($paramTableName, DatabaseDescription::getTableKeyName($paramTableName), $paramKeyValue);
    }

    /**
     * Retourne la requete SQL à partir d'un crière sur un champs
     * Attention, ne gère que les tables "mono-clef"
     * @param mixed $paramTableName Nom de la table
     * @param mixed $paramFieldName Nom du champs
     * @param mixed $paramFieldValue Valeur du champs
     * @return mixed requête SQL
     */
    public static function getSqlQueryFromOneField($paramTableName, $paramFieldName, $paramFieldValue) {

        return "SELECT * FROM "
                . self::convertTableNameToSqlClause($paramTableName)
                . " WHERE ("
                . DatabaseOperation::convertArrayToSqlClauseWhere(
                        $paramTableName, array($paramFieldName => $paramFieldValue)
                )
                . ")"
        ;
    }

    /**
     * Retourne le nom de la table formatée pour des instructions SQL
     * @param string $paramTableName Nom de la table
     * @return string nom de la table au format SQL
     */
    public static function convertTableNameToSqlClause($paramTableName) {
        return self::convertNameToSqlClause($paramTableName);
    }

    /**
     * Réserve une clef dans la base de données<br>
     * Pour ce faire, un enregsitrement vide est créé.
     * @param string $paramTableName Nom de la table
     * @return mixed Valeur de la clef réservée
     */
    public static function reserveKeyDatabase($paramTableName) {
        $sqlReq = "INSERT $paramTableName VALUES()";
        $sqlResult = DatabaseOperation::query($sqlReq);
        $return = mysql_insert_id();
        return $return;
    }

    /**
     * Retourne un tableau de DatabaseRecord résultat de la recherche
     * @param string $paramTableName nom de la table
     * @param string $paramFieldName champs utilisé comme critère de recherche
     * @param mixed $paramFieldValue valeur à rechercher
     * @return array Tableau de DatabaseRecordset
     */
    public static function getArrayRecordsFromOneDataField(
    $paramTableName
    , $paramFieldName
    , $paramFieldValue
    ) {
        $keyName = DatabaseDescription::getTableKeyName($paramTableName);
        $whereClause = self::convertArrayToSqlClauseWhere($paramTableName, array($paramFieldName => $paramFieldValue));
        $result = DatabaseOperation::doSqlSelect($keyName, $paramTableName, $whereClause);
        $return = DatabaseOperation::convertSqlResultKeyAndOneFieldToArray($result);
        return $return;
    }

    /**
     * Retourne un tableau de DatabaseRecord résultat de la recherche
     * Le premier champs de la requête doit être la clef de la table
     * @param string $paramTableName nom de la table
     * @param mixed $paramSqlRequest requête SQL à exécuter
     * @return array Tableau de DatabaseRecordset
     */
    public static function getArrayRecordsFromSqlRequest($paramTableName, $paramSqlRequest) {

        $return = array();
        $keyName = DatabaseDescription::getTableKeyName($paramTableName);
        $request = $paramSqlRequest;
        $result = self::query($request);
        if ($result) {
            while ($rows = mysql_fetch_array($result)) {
                $keyValue = $rows[$keyName];
                $return[$keyValue] = new DatabaseRecord($paramTableName, $keyValue);
            }
        }
        return $return;
    }

    /**
     * Retourne les champs dont la valeur est différentes entre 2 enregistrement<br>
     * en base de données.
     * @param string $paramTableName1 nom de table de l'enregistrement N°1
     * @param string $paramKeyValueTable1 valeur de la clef de l'enregistrement N°1
     * @param string $paramKeyValueTable2 valeur de la clef de l'enregistrement N°2
     * @param string $paramTableName2 nom de table de l'enregistrement N°2 (optionnel)
     * @return array Tableau contenant la liste des noms des champs différents
     */
    public static function getArrayFieldsNameForDiffRecords($paramTableName1, $paramKeyValueTable1, $paramKeyValueTable2, $paramTableName2 = NULL) {

        if ($paramKeyValueTable2 == NULL) {
            return FALSE;
        }

        /**
         * Si la seconde table n'a pas été communiquée, on considère que les 
         * 2 clefs font référence à la même table, la première.
         */
        if ($paramTableName2 == NULL) {
            $paramTableName2 = $paramTableName1;
        }

        /**
         * Récupération de l'enregistrement n°1
         */
        $fieldsArray1 = self::convertSqlResultFirstRowToArray(
                        self::query(
                                "SELECT * FROM " . $paramTableName1
                                . " WHERE " . DatabaseDescription::getTableKeyName($paramTableName1) . "=" . $paramKeyValueTable1
                        )
        );

        /**
         * Récupération de l'enregistrement n°1
         */
        $fieldsArray2 = self::convertSqlResultFirstRowToArray(
                        self::query(
                                "SELECT * FROM " . $paramTableName2
                                . " WHERE " . DatabaseDescription::getTableKeyName($paramTableName2) . "=" . $paramKeyValueTable2
                        )
        );

        /**
         * Construction du tableau des différences
         */
        return DatabaseOperation::getArrayFieldsNameForDiffFieldsValue($fieldsArray1, $fieldsArray2);
    }

    /**
     * Retourne un tableau contenant les champs pour lesquels les valeurs<br>
     * sont différentes.
     * @param array $fieldsArray1 Tableau N°1 Champs/Valeur
     * @param array $fieldsArray2 Tableau N°2 Champs/Valeur à comparer
     * @return type
     */
    public static function getArrayFieldsNameForDiffFieldsValue($fieldsArray1, $fieldsArray2) {

        /**
         * Construction du tableau des différences
         */
        $arrayDiff = array_diff_assoc($fieldsArray1, $fieldsArray2);

        /*
         * On retourne le tableau en remplaçant les clef par les valeurs
         * et vice versa
         */
        $arrayDiffFilp = array_flip($arrayDiff);

        /**
         * On réindex les clefs du tableau
         */
        return array_values($arrayDiffFilp);
    }

    /**
     * Exécution d'une requête de mise à jour d'un enregistrement SQL
     * @param string $paramTableClause
     * @param string $paramSetClause
     * @param string $paramWhereClause
     * @return boolean TRUE si Ok, FALSE si erreur. 
     */
    public static function doSqlUpdate($paramTableClause, $paramSetClause, $paramWhereClause) {
        return DatabaseOperation::query(
                        "UPDATE " . $paramTableClause
                        . " SET " . $paramSetClause
                        . " WHERE (" . $paramWhereClause . " )"
        );
    }

    public static function doSqlUpdateFromOneField($paramTableName, $paramKeyName, $paramKeyValue, $paramFieldName, $paramFieldValue) {
        $TableClause = "`" . $paramTableName . "` ";
        $SetClause = "`" . $paramFieldName . "` =  " . self::convertDataForQuery($paramFieldValue);
        $WhereClause = "`" . $paramTableName . "`.`" . $paramKeyName . "` =  '" . $paramKeyValue . "'";

        DatabaseOperation::doSqlUpdate($TableClause, $SetClause, $WhereClause);
    }

    /**
     * Exécution d'une requête de suppression d'un enregistrement SQL
     * @param string $paramTableClause
     * @param string $paramWhereClause
     * @return boolean TRUE si Ok, FALSE si erreur. 
     */
    public static function doSqlDelete($paramTableClause, $paramWhereClause) {
        return DatabaseOperation::query(
                        "DELETE FROM " . $paramTableClause . " "
                        . $paramWhereClause
        );
    }

    /**
     * Exécution d'une requête de sélection SQL
     * @param mixed $paramSelectClause
     * @param mixed $paramTableClause
     * @param mixed $paramWhereClause
     * @return resource Résultat SQL
     */
    public static function doSqlSelect(
    $paramSelectClause
    , $paramTableClause
    , $paramWhereClause
    , $paramOrderClause = NULL
    ) {
        $orderClauseToAdd = NULL;
        if ($paramOrderClause != NULL) {
            $orderClauseToAdd = " ORDER BY " . $paramOrderClause;
        }

        return DatabaseOperation::query(
                        "SELECT " . $paramSelectClause
                        . " FROM " . $paramTableClause
                        . " WHERE " . $paramWhereClause
                        . $orderClauseToAdd
        );
    }

    /**
     * Retourne un tableau contenant la liste des enregsitrements que les deux
     * tables ont en relation.
     * Ces tables doivent être en relation N:1 et configuré dans la base
     * de données des informations des schémas:
     *   - Voir INFORMATION_SCHEMA > KEY_COLUMN_USAGE dans MySQL
     * 
     * La valeur de retour est un tableau associatif sous la forme
     * self::convertSqlResultWithKeyAsFirstFieldToArray()
     * 
     * En cas d'ambiguïté de nom de champs à sélectionner, préciser le nom
     * de la table.
     * Par exemple, si les table R1 et RN ont toutes les deux un champs nommé
     * "nom", alors préciser "R1.nom" ou "R2.nom" dans $arrayFieldsNameToDisplay
     *
     * @param string $tableNameRN Nom de la table de relation N
     * @param string $tableNameR1 Nom de la table de relation 1
     * @param mixed $foreignKeyValue Valeur la clef étrangère
     * @param array $arrayFieldsNameToDisplay Liste des champs à sélectionner.
     * @param array $arrayFieldsNameOrder Liste des champs à classer.
     * @return array de type self::convertSqlResultWithKeyAsFirstFieldToArray()
     */
    public static function getArrayFieldsNameFromForeignKeyRelationNtoOne(
    $tableNameRN
    , $tableNameR1
    , $foreignKeyValue
    , $arrayFieldsNameToDisplay
    , $arrayFieldsNameOrder = NULL
    ) {

        /**
         * Nom de la clef de la table N.
         */
        $tableDescriptionRN = new DatabaseDescriptionTable($tableNameRN);
        $keyNameRN = $tableDescriptionRN->getKeyName();


        /**
         * Détermination des noms des champs constituant la relation N:1
         */
        $arrayRelationshipKeyName = DatabaseDescription::getFieldNameOfTableRelationR1NByTablesName($tableNameRN, $tableNameR1);
        $foreignKeyNameRN = implode(array_keys($arrayRelationshipKeyName));
        $foreignKeyNameR1 = implode($arrayRelationshipKeyName);

        /**
         * Construction de la requête SQL
         */
        $paramSelectClause = $tableNameRN . "." . $keyNameRN . "," . implode(",", $arrayFieldsNameToDisplay);
        $paramTableClause = $tableNameRN . "," . $tableNameR1;
        $paramWhereClauseRelationship = $tableNameRN . "." . $foreignKeyNameRN . " = " . $tableNameR1 . "." . $foreignKeyNameR1;
        $paramWhereClause = $tableNameRN . "." . $foreignKeyNameRN . " = " . $foreignKeyValue . " AND " . $paramWhereClauseRelationship;
        if ($arrayFieldsNameOrder) {
            $paramOrderClause = implode(",", $arrayFieldsNameOrder);
        }

        return DatabaseOperation::convertSqlResultWithKeyAsFirstFieldToArray(
                        self::doSqlSelect($paramSelectClause, $paramTableClause, $paramWhereClause, $paramOrderClause)
        );
    }

    static public function createDatabaseConnection() {
        $ini_array = parse_ini_file("config_env_cod.ini");
        print_r($ini_array);
        //$pdo = new PDO($dsn, $username, $passwd, $options);
    }

}
