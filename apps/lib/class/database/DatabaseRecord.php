<script language="php">

/**
 * Un objet record est un enregistrement dans le sens base de données.
 *
 * @author salokine
 * @license see LICENSE.TXT at the root of this project
 * @version 1.0
 */
class DatabaseRecord extends SessionSaveAndRestoreAbstract {

    /**
     * Table stockant l'enregistrement
     * @var DatabaseDescriptionTable
     */
    protected $tableDescription;

    /**
     * Valeur de la clef du record.
     * Veuillez noter que cet objet record ne gère que les tables mono-clef.
     * @var mixed
     */
    protected $keyValue;

    /**
     * Ce recordset existe-il dans la base de données ?
     * @var boolean Oui ou Non
     */
    protected $isExist;

    /**
     * Liste des champs et leur valeur actuellement en mémoire
     * Il s'agit d'un tableau clef/valeur où:
     * - clef = nom du champ
     * - valeur = valeur du champ
     * @var mixed
     */
    protected $arrayFieldNameFieldValueInMemory;

    /**
     * Liste des champs et leur valeur stocké en base de données
     * Il s'agit d'un tableau clef/valeur où:
     * - clef = nom du champ
     * - vleur = valeur du champ
     * @var mixed
     */
    protected $arrayFieldNameFieldValueInDatabase;

    /**
     * Enregistrement avec lequel comparer cet enregistrement.
     * @var DatabaseRecord
     */
    protected $databaseRecordToCompare;

    /**
     * Doit-on créer automatiquement l'enregistrement
     * en base de données si la clef n'existe pas ?
     * @var boolean
     */
    private $isCreateRecordInDatabaseIfKeyDoesntExist;

    /**
     * Par défaut, si la clef n'existe pas, doit-on créer l'enregistrement
     * en base de donnée ?
     */
    const DEFAULT_IS_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST = self::VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST;

    /**
     * Par défaut, si la clef n'existe pas, doit-on créer l'enregistrement
     * en base de donnée ?
     */
    const VALUE_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST = TRUE;

    /**
     * Par défaut, si la clef n'existe pas, doit-on créer l'enregistrement
     * en base de donnée ?
     */
    const VALUE_DONT_CREATE_RECORD_IN_DATABASE_IF_KEY_DOESNT_EXIST = FALSE;

    /**
     * Création d'un record
     * @param string $paramTableName
     * @param mixed $paramKeyValue
     * @param mixed $paramArrayFieldNameFieldValueToImport
     * @param DatabaseRecord $paramRecordToCompare
     */
    public function __construct($paramTableName, $paramKeyValue, $paramArrayFieldNameFieldValueToImport = NULL, DatabaseRecord $paramRecordToCompare = NULL, $paramIsCreateRecordInDatabaseIfKeyDoesntExist = TRUE) {

        /**
         * Initialisation de l'objet
         */
        $this->setTableDescription(new DatabaseDescriptionTable($paramTableName));
        $this->setKeyValue($paramKeyValue);
        $this->setIsCreateRecordInDatabaseIfKeyDoesntExist($paramIsCreateRecordInDatabaseIfKeyDoesntExist);

        /**
         * Si la clef communiquée est NULL et qu'il est autorisé de créer
         * l'enregistrement en base de données si inexistant,
         * alors on réserve la clef.
         */
        if ($this->getKeyValue() == NULL AND $this->getIsCreateRecordInDatabaseIfKeyDoesntExist()) {

            /**
             * Réservation d'une clef en base de données
             * Sauvegarde de la valeur de la nouvelle clef dans l'objet recordset
             */
            $this->setKeyValue(
                    DatabaseOperation::reserveKeyDatabase(
                            $this->getTableName()
                    )
            );
        }

        /**
         * Tentative de chargement de l'enregistrement à partir de la base de données
         */
        $sqlResultRecordFromDatabase = DatabaseOperation::getSqlResultFromOneKeyValue(
                        $this->getTableName(), $this->getKeyValue()
        );

        /**
         * L'enregistrement existe-il en base de données ?
         */
        switch (DatabaseOperation::getSqlNumRows($sqlResultRecordFromDatabase)) {

            case 0:
                /**
                 * Aucun enregistrement trouvé en base de données.
                 */
                /**
                 * On indique que l'enregistrement n'existe pas en base de données.
                 */
                $this->setIsExistToFalse();

                break;

            case 1:
                /**
                 * On indique que l'enregistrement existe en base de données.
                 */
                $this->setIsExistToTrue();

                /**
                 * Chargement de l'enregistrement de la base de données en mémoire
                 * dans le recordset
                 */
                /**
                 * Conversion du résultat SQL en simple tableau PHP:
                 * array("Nom du champ" => "valeur")
                 * Stockage de l'enregistrement en mémoire dans l'objet Recordset
                 */
                $this->setArrayFieldNameFieldValueInMemory(
                        DatabaseOperation::convertSqlStatementFirstRowToArray(
                                $sqlResultRecordFromDatabase
                        )
                );

                /**
                 * Sauvegarde du résultat de valeur initialement en base de données.
                 */
                $this->setArrayFieldNameFieldValueInDatabase(
                        $this->getArrayFieldNameFieldValueInMemory()
                );


                /**
                 * Options complémentaires 
                 */
                /**
                 * Mise à jour du records avec les valeurs importées
                 */
                $this->updateArrayFieldNameFieldValueInMemory($paramArrayFieldNameFieldValueToImport);

                /**
                 * Enregistrement du record avec lequel comparer l'actuel recordset
                 */
                $this->setRecordToCompare($paramRecordToCompare);

                break;

            default:
            /**
             * Exception
             */
        }
    }

    /**
     * 
     * @return boolean
     */
    public function getIsCreateRecordInDatabaseIfKeyDoesntExist() {
        return $this->isCreateRecordInDatabaseIfKeyDoesntExist;
    }

    /**
     * 
     * @param boolean $isCreateRecordInDatabaseIfKeyDoesntExist
     */
    public function setIsCreateRecordInDatabaseIfKeyDoesntExist($isCreateRecordInDatabaseIfKeyDoesntExist) {
        $this->isCreateRecordInDatabaseIfKeyDoesntExist = $isCreateRecordInDatabaseIfKeyDoesntExist;
    }

    /**
     * L'nregistrement existe-il en base de données ?
     * @return boolean
     */
    public function getIsExist() {
        return $this->isExist;
    }

    /**
     * Signaler que l'enregistrement existe en base de données
     */
    private function setIsExistToTrue() {
        $this->isExist = TRUE;
    }

    /**
     * Signaler que l'enregsitrement n'existe pas en base de données.
     */
    private function setIsExistToFalse() {
        $this->isExist = FALSE;
    }

    /**
     * Retourne le record avec lequel comparer l'enregistrement actuel
     * @return DatabaseRecord
     */
    public function getRecordToCompare() {
        return $this->databaseRecordToCompare;
    }

    /**
     * Retourne le contenu du record sous forme d'un tableau clef/valeur.
     * @return mixed
     */
    public function getArrayFieldNameFieldValueInMemory() {
        return $this->arrayFieldNameFieldValueInMemory;
    }

    /**
     * Retourne le contenu du record en mémoire sous forme
     * d'un tableau clef/valeur. La clef n'est pas retournée dans ce tableau.
     * @return array
     */
    public function getArrayFieldNameFieldValueInMemoryWithoutKey() {
        $arrayFieldNameFieldValueInMemoryWithoutKey = $this->getArrayFieldNameFieldValueInMemory();

        /**
         * Suppression de la clef primaire
         */
        unset($arrayFieldNameFieldValueInMemoryWithoutKey[$this->getKeyName()]);

        return $arrayFieldNameFieldValueInMemoryWithoutKey;
    }

    /**
     * Défini le contenu du recordset
     * @param mixed $arrayFieldNameFieldValueInMemory
     */
    private function setArrayFieldNameFieldValueInMemory($arrayFieldNameFieldValueInMemory) {
        $this->arrayFieldNameFieldValueInMemory = $arrayFieldNameFieldValueInMemory;
    }

    /**
     * Actualise le contenu du record à partir d'un tableau PHP
     * @param mixed $arrayFieldNameFieldValueToMerge
     */
    private function updateArrayFieldNameFieldValueInMemory($arrayFieldNameFieldValueToMerge) {

        /**
         * Si $arrayFieldNameFieldValueToMerge est un tableau PHP,
         * Alors possibilité de fusionner les valeurs importées
         */
        if (is_array($arrayFieldNameFieldValueToMerge)) {

            /**
             * Fusion des tableaux de valeurs
             * Attention, $arrayFieldNameFieldValueToMerge pourrait avoir plus de champs
             */
            $arrayMerged = array_merge($this->getArrayFieldNameFieldValueInMemory(), $arrayFieldNameFieldValueToMerge);

            /**
             * Récupération de l'intersection pour ne conserver que les champs autorisés
             */
            $this->setArrayFieldNameFieldValueInMemory(
                    array_intersect_key(
                            $arrayMerged, $this->getArrayFieldNameFieldValueInMemory()
                    )
            );
        }
    }

    /**
     * Retourne le contenu du record tel qu'il est stocké actuellement
     * en base de données.
     * @return mixed Tableau PHP
     */
    public function getArrayFieldNameFieldValueInDatabase() {
        return $this->arrayFieldNameFieldValueInDatabase;
    }

    /**
     * Retourne le contenu du record en mémoire sous forme
     * d'un tableau clef/valeur. La clef n'est pas retournée dans ce tableau.
     * @return array
     */
    public function getArrayFieldNameFieldValueInDatabaseWithoutKey() {
        $arrayFieldNameFieldValueInDatabaseWithoutKey = $this->getArrayFieldNameFieldValueInDatabase();

        /**
         * Suppression de la clef primaire
         */
        unset($arrayFieldNameFieldValueInDatabaseWithoutKey[$this->getKeyName()]);

        return $arrayFieldNameFieldValueInDatabaseWithoutKey;
    }

    /**
     * Défini le contenu du record tel qu'il est stocké actuellement
     * en base de données.
     * @param mixed $arrayFieldNameFieldValueInDatabase
     */
    private function setArrayFieldNameFieldValueInDatabase($arrayFieldNameFieldValueInDatabase) {
        $this->arrayFieldNameFieldValueInDatabase = $arrayFieldNameFieldValueInDatabase;
    }

    /**
     * Défini le record avec lequel comparer l'actuel record
     * @param DatabaseRecord $paramRecordToCompare
     */
    public function setRecordToCompare(DatabaseRecord $paramRecordToCompare = NULL) {
        $this->databaseRecordToCompare = $paramRecordToCompare;
    }

    /**
     * Défini la table sur laquelle est basée le record
     * @param DatabaseDescriptionTable $paramTableDescription
     */
    public function setTableDescription(DatabaseDescriptionTable $paramTableDescription) {
        $this->tableDescription = $paramTableDescription;
    }

    /**
     * Retourne la clef au format SQL, prête à être insérée dans une clause Where
     * Exemple:
     * `table1.champs1` = 'valeur'
     * @return string
     */
    public function getKeyToSqlStatement() {
        return DatabaseOperation::convertArrayToSqlClauseWhere(
                        $this->getTableName(), array($this->getKeyName() => $this->getKeyValue())
        );
    }

    /**
     * Met à jour le record en mémoire, puis le sauvegarde en base de données
     * @param mixed $arrayFieldNameFieldValueToImport Tableau PHP Champs/Valeur
     */
    public function updateAndSave($arrayFieldNameFieldValueToImport) {
        $this->updatePropertiesOnly($arrayFieldNameFieldValueToImport);
        $this->saveToDatabase();
    }

    /**
     * Retourne le nom de la table au format SQL 
     * @return string
     */
    public function getTableNameForSqlClause() {
        return $this->getTableDescription()->getTableNameForSqlClause();
    }

    /**
     * Sauvegarde le record en base de données
     */
    public function saveToDatabase() {
        /**
         * Mise à jour de la base de données 
         */
        DatabaseOperation::query(
                "UPDATE " . $this->getTableNameForSqlClause()
                . " SET " . $this->getFieldsToSqlClauseSet()
                . " WHERE " . $this->getKeyToSqlStatement() . " "
        );

        /**
         * Conservation dans l'objet PHP de l'état des valeurs telles
         * que présente en base de donnée à cet instant.
         */
        $this->setArrayFieldNameFieldValueInDatabase(
                $this->getArrayFieldNameFieldValueInMemory()
        );
    }

    /**
     * Retourne les champs et leurs valeurs au format SQL
     * @return type
     */
    public function getFieldsToSqlStatement() {

        return DatabaseOperation::convertArrayToSqlClauseWhere(
                        $this->getTableName(), $this->getArrayFieldNameFieldValueInMemory());
    }

    /**
     * Retourne les champs et leurs valeurs au format SQL pour la clause SET
     * La clef n'est pas transmise
     * @return type
     */
    public function getFieldsToSqlClauseSet() {

        return DatabaseOperation::convertArrayToSqlClauseSet(
                        $this->getTableName(), $this->getArrayFieldNameFieldValueInMemoryWithoutKey());
    }

    public function updatePropertiesOnly($arrayFieldNameFieldValueToImport) {

        /**
         * Mise à jour des valeurs
         */
        $this->updateArrayFieldNameFieldValueInMemory($arrayFieldNameFieldValueToImport);
    }

    /**
     * Actualise la valeur d'un champ dans le record
     * @param string $paramFieldName
     * @param mixed $paramFieldValue
     */
    public function updatePropertyOnly($paramFieldName, $paramFieldValue) {

        $array = $this->getArrayFieldNameFieldValueInMemory();
        $array[$paramFieldName] = $paramFieldValue;
        $this->setArrayFieldNameFieldValueInMemory($array);
    }

    /**
     * Supprime le record de la base de donnée
     */
    public function delete() {
        return DatabaseOperation::execute(
                        "DELETE FROM " . $this->getTableNameForSqlClause() . " " . $this->getKeyToSqlStatement()
        );
    }

    /**
     * Copie les valeurs du record sur un autre enregistrement.
     * Si la clef est NULL, un nouvel enregsitrement sera créé en base de donnée.
     * @param mixed $paramNewKeyValue
     * @return DatabaseRecord Nouveau record
     */
    public function copy($paramNewKeyValue = NULL) {
        return new DatabaseRecord($this->getTableName(), $paramNewKeyValue, $this->getFieldsArray());
    }

    /**
     * Réécrit l'enregistrement avec de nouvelles les clefs.
     * L'enregistrement précédent sera supprimé
     * @param mixed $paramNewKeyValue
     * @return DatabaseRecord Nouveau record
     */
    public function rewrite($paramNewKeyValue) {
        $this->delete();
        return $this->copy($paramNewKeyValue);
    }

    /**
     * Définit la clef du record actuel
     * @param mixed $paramKeyValue
     */
    public function setKeyValue($paramKeyValue) {
        $this->keyValue = $paramKeyValue;
    }

    /**
     * Met à jour et retourne le record à partir des champs trouvés
     * dans $_REQUEST (Variables de requête HTTP)
     * @todo Migrer vers une utilisation de "filter_input_array" (voir valeur ajoutée)
     */
    public function updateFromHttpRequest() {
        $this->updatePropertiesOnly($_REQUEST);
    }

    /**
     * Retourne la description d'un champs du record
     * @param mixed $paramFieldName Nom du champ.
     * @return DatabaseDescriptionField
     */
    public function getFieldDescriptionByName($paramFieldName) {
        return new DatabaseDescriptionField($this->getTableDescription(), $paramFieldName);
    }

    /**
     * Défini la valeur d'un champ du record
     * @param mixed $paramFieldName Nom du champ
     * @param mixed $paramFieldValue Nouvelle valeur
     */
    public function setFieldValue($paramFieldName, $paramFieldValue) {
        $this->updatePropertyOnly($paramFieldName, $paramFieldValue);
    }

    /**
     * Retourne les champs et leur valeur sous forme d'un tableau PHP clef/valeur
     * @return mixed Tableau PHP clef/valeur
     */
    public function getFieldsArray() {
        return $this->getArrayFieldNameFieldValueInMemory();
    }

    public function getFieldTypeOfStorage($paramFieldName) {
        return DatabaseDescription::getFieldDocTypeOfStorage($this->getTableName(), $paramFieldName);
    }

    /**
     * Retourne la valeur d'un champ
     * @param string $paramFieldName
     * @return mixed Valeur du champ dans le recordset
     */
    public function getFieldValue($paramFieldName) {
        $return = NULL;
        switch ($this->getFieldTypeOfStorage($paramFieldName)) {
            case DatabaseDescription::TYPE_OF_STORAGE_REAL:
                $array = $this->getArrayFieldNameFieldValueInMemory();
                $return = $array[$paramFieldName];
                break;

            case DatabaseDescription::TYPE_OF_STORAGE_VIRTUAL:
                $return = $this->getKeyValue();
                break;
            case DatabaseDescription::TYPE_OF_STORAGE_CALCULATE:
                //Not implemented
                break;

            default :
                $array = $this->getArrayFieldNameFieldValueInMemory();
                $return = $array[$paramFieldName];
        }
        return $return;
    }

    /**
     * Retourne la description de la table de l'enregistrement
     * @return DatabaseDescriptionTable
     */
    public function getTableDescription() {
        return $this->tableDescription;
    }

    /**
     * Retourne le nom de la table du record
     * @return string Nom de la table
     */
    public function getTableName() {
        return $this->getTableDescription()->getTableName();
    }

    /**
     * Retourne le nom du champ utilisé comme clef du record
     * @return string
     */
    public function getKeyName() {
        return $this->getTableDescription()->getKeyName();
    }

    /**
     * Reourne la valeur de la clef du record
     * @return mixed
     */
    public function getKeyValue() {
        return $this->keyValue;
    }

    /**
     * La valeur du champ est-elle différente entre le record actuel et
     * celui avec lequel comparer ?
     * @param string $paramFieldName Nom du champ
     * @return boolean TRUE=différence, FALSE=Aucune différence.
     */
    public function isFieldDiff($paramFieldName) {
        /**
         * $isDiff: A-t-on une différence ?
         */
        $isDiff = NULL;

        /**
         * Existe-il un records à comparer ?
         */
        if ($this->getRecordToCompare() instanceof DatabaseRecord) {
            /**
             * Comparaison des valeurs du même champ sur les deux records
             */
            if ($this->getRecordToCompare()->getFieldValue($paramFieldName) != $this->getFieldValue($paramFieldName)) {

                /**
                 * Il y a une différence
                 */
                $isDiff = TRUE;
            } else {

                /**
                 * Il n'y a pas de différence
                 */
                $isDiff = FALSE;
            }
        }
        /**
         * On signale si il y a une différence ou pas
         */
        return $isDiff;
    }

    public function isNeedUpdateRecordsetInDatabase($paramIsAutoSaving = FALSE) {
        /**
         * isNeedUpdateRecordInDatabase: Doit-on mettre à jour la base de données ?
         */
        $isNeedUpdateRecordInDatabase = NULL;

        /**
         * Comparaison des valeurs des du même champ sur les deux record
         */
        if (array_diff_assoc($this->getArrayFieldNameFieldValueInMemory(), $this->getArrayFieldNameFieldValueInDatabase()) == NULL) {

            /**
             * Il n'y a pas de différence, il n'est donc pas nécessaire de mettre à jour la base de donnée.
             */
            $isNeedUpdateRecordInDatabase = FALSE;
        } else {


            /**
             * Il y a une différence, il est donc nécessaire de mettre à jour la base de donnée.
             */
            $isNeedUpdateRecordInDatabase = TRUE;

            /**
             * Dans le cas où l'autosaving est activé, on chaine l'enregistrement en base de données.
             */
            if ($paramIsAutoSaving == TRUE) {
                $this->saveToDatabase();
            }
        }

        /**
         * On signale si il y a une différence ou pas
         */
        return $isNeedUpdateRecordInDatabase;
    }

    public function getDataFieldByFieldName($paramFieldName) {
        return new DatabaseDataField($paramFieldName, $this);
    }

}
</script>
