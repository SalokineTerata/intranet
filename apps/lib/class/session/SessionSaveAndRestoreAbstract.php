<?php

/**
 * Cette classe abstraite permet d'ajouter la fonction 
 * de sauvegarde/restauration de données dans la session PHP de l'utilisateur
 * 
 * @author salokine.terata@gmail.com
 * @license see LICENSE.TXT at the root of this project
 * @version 1.0
 */
abstract class SessionSaveAndRestoreAbstract {

    /**
     * Identifiant de l'objet dans la session PHP
     * @var integer
     */
    protected $id_object_session;

    /**
     * Retourne l'objet précédement sauvegardé en session PHP
     * A noter qu'il n'y a pas de "copie", mais qu'il s'agit bien d'un pointeur
     * mémoire (référence vers la variable)
     * @param integer $id
     * @return object
     */
    public static function &getSession($id = 0) {
        return $_SESSION[get_class()][$id];
    }

    /**
     * Sauvegarde l'objet en session PHP
     * @param <int> $id
     */
    public function saveSession($id = 0) {
        $this->id_object_session = $id;
        $_SESSION[get_class()][$this->id_object_session] = $this;
    }

}

?>
