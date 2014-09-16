<?php

/**
 * Description of UserModel
 * Table des utilisateurs
 *
 * @author salokine
 */
class UserModel extends AbstractModel {

    const TABLENAME = "salaries";
    const KEYNAME = "id_user";
    const FIELDNAME_NOM = "nom";
    const FIELDNAME_PRENOM = "prenom";

    public function getPrenomNom() {
        $prenom = $this->getDataField(UserModel::FIELDNAME_PRENOM)->getFieldValue();
        $nom = $this->getDataField(UserModel::FIELDNAME_NOM)->getFieldValue();
        $value = $prenom . " " . strtoupper($nom);
        return $value;
    }

}

?>
