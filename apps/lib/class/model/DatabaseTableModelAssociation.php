<?php

/*
 * Copyright (C) 2015 bs4300280
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Description of DatabaseRepresentation
 * Cette classe permet de savoir quelle classe "Model" implémente une
 * table donnée.
 * 
 * @author bs4300280
 */
class DatabaseTableModelAssociation {

    /**
     * Tableau associatif PHP de type clé/valeur où:
     * - la clé    : Nom réelle de la table en base de données.
     * - la valeur : Nom de la classe implémentant la table.
     * @var array 
     */
    static private $arrayTableNameToModelName = array(
        //Classer la liste des clefs par ordre alphabétique.
        "fta" => "FtaModel",
        "fta_processus_delai" => "FtaProcessusDelaiModel"
    );

    static public function getModelName($paramTableName) {
        $return = self::getArrayTableNameToModelName();
        return $return[$paramTableName];
    }

    static public function getTableName($paramModelName) {
        $temp = self::getArrayTableNameToModelName();
        $return = array_flip($temps);
        return $return[$paramModelName];
    }

    static private function getArrayTableNameToModelName() {
        return self::$arrayTableNameToModelName;
    }

    static private function setArrayTableNameToModelName($arrayTableNameToModelName) {
        self::$arrayTableNameToModelName = $arrayTableNameToModelName;
    }

}
