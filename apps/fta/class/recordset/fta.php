<?php


/**
 * Description of fta
 *
 * @author salokine
 */
class Fta {
    const TABLE_FTA = "fta";
    const KEY_FTA = "id_fta";
    const TABLE_ARTI = "access_arti2";
    const KEY_ARTI = "id_access_arti2";

    /**
     *
     * @var <DatabaseRecordSet>
     */
    protected $recordFta;
    /**
     *
     * @var <DatabaseRecordSet>
     */
    protected $recordArti;

    public function __construct($id) {
        $this->keyFta = $id;
        $keys_value = array(self::KEY_FTA => $this->keyFta);
        $this->recordFta = new RecordSet(self::TABLE_FTA, $keys_value);

        $this->keyArti = $recordFta[self::KEY_ARTI];
        $keys_value = array(self::KEY_ARTI => $this->keyArti);
        $this->recordArti = new RecordSet(self::TABLE_ARTI, $keys_value);
    }

    /**
     *
     * @return <DatabaseRecordSet>
     */
    public function getRecordSetFta() {
        return $this->getRecordSet(Fta::TABLE_FTA);
    }

    /**
     * Renvoi le recordset de la table access_arti2
     * @return <DatabaseRecordSet> 
     */
    public function getRecordSetArti() {
        return $this->getRecordSet(Fta::TABLE_ARTI);
    }

    /**
     *
     * @param <enum> self::TABLE_FTA ou self::TABLE_ARTI
     * @return <DatabaseRecordSet>
     */
    protected function getRecordSet($table) {
        $return = null;
        switch ($table) {
            case self::TABLE_FTA:
                $return = $this->recordFta;
                break;
            case self::TABLE_ARTI:
                $return = $this->recordArti;
                break;
        }
        return $this->recordFta;
    }

    /**
     * Vérifie que les champs obligatoires soient bien renseignés
     * comme défini dans la table fta_saisie_obligatoire
     *
     * @param <array> $fields Tableau associatif "nom du champ = valeur"
     */
    

    /**
     *
     * @param <type> $param
     */
    public static function checkRulesAll($param) {
        Fta::checkRulesPoidsNetColis($poids_net_colis);
    }

}

?>
