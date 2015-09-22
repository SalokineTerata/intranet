<?php

/*
 * Copyright (C) 2015 tp4300001
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

class LoggerClass {

    private $depot; // Dossier où sont enregistrés les fichiers logs
    private $ready; // Le logger est prêt quand le dossier de dépôt des logs existe

    // Granularité

    const GRAN_VOID = 'VOID';  // Aucun archivage
    const GRAN_MONTH = 'MONTH'; // Archivage mensuel
    const GRAN_YEAR = 'YEAR';  // Archivage annuel

    public function __construct($path) {
        $this->ready = false;

        // Si le dépôt n'existe pas
        if (!is_dir($path)) {
            trigger_error('<code>' . $path . '</code> n\'existe pas', E_USER_WARNING);
            return false;
        }

        $this->depot = realpath($path);
        $this->ready = true;
        return true;
    }

    public function path($paramModule, $paramLogfileName, $granularity = self::GRAN_YEAR) {
        // On vérifie que le logger est prêt (et donc que le dossier de dépôt existe
        if (!$this->ready) {
            trigger_error('Logger is not ready', E_USER_WARNING);
            return false;
        }

        // Contrôle des arguments
        if (!isset($paramModule) || empty($paramLogfileName)) {
            trigger_error('Paramètres incorrects', E_USER_WARNING);
            return false;
        }

        // Si $type est vide, on enregistre le log directement à la racine du dépôt
        if (empty($paramModule)) {
            $type_path = $this->depot . '/';
        }
        // Création dossier du type
        else {
            $type_path = $this->depot . '/' . $paramModule . '/';
            if (!is_dir($type_path)) {
                mkdir($type_path);
            }
        }

        // Création du dossier granularity
        if ($granularity == self::GRAN_VOID) {
            $logfile = $type_path . $paramLogfileName . '.log';
        } elseif ($granularity == self::GRAN_MONTH) {
            $mois_courant = date('Ym');
            $paramModule_path_mois = $type_path . $mois_courant;
            if (!is_dir($paramModule_path_mois)) {
                mkdir($paramModule_path_mois);
            }
            $logfile = $paramModule_path_mois . '/' . $mois_courant . '_' . $paramLogfileName . '.log';
        } elseif ($granularity == self::GRAN_YEAR) {
            $current_year = date('Y');
            $paramModule_path_year = $type_path . $current_year;
            if (!is_dir($paramModule_path_year)) {
                mkdir($paramModule_path_year);
            }
            $logfile = $paramModule_path_year . '/' . $current_year . '_' . $paramLogfileName . '.log';
        } else {
            trigger_error('Granularité ' . $granularity . ' non prise en charge', E_USER_WARNING);
            return false;
        }

        return $logfile;
    }

    //date heure : $login : $module : $expediteur : $destinataire : $sujetmail
    public function log($paramModule, $paramText, $paramLogfileName, $paramExpediteur, $paramDestinataire, $paramSujetMail, $paramCheckText, $paramGranularity = self::GRAN_YEAR) {
        // Contrôle des arguments
        if (!isset($paramModule) || empty($paramText) || empty($paramExpediteur) || empty($paramDestinataire) || empty($paramSujetMail)) {
            trigger_error('Paramètres incorrects', E_USER_WARNING);
            return false;
        }

        $logfile = $this->path($paramModule, $paramLogfileName, $paramGranularity);

        if ($logfile === false) {
            trigger_error('Impossible d\'enregistrer le log', E_USER_WARNING);
            return false;
        }

        // Ajout de la date et de l'heure au début de la ligne
        $paramDate = date('d/m/Y H:i:s');


        // Ajout du retour chariot de fin de ligne si il n'y en a pas
        if (!preg_match('#\n$#', $paramDate)) {
            $paramDate .= '\n';
        }
        if ($paramCheckText == 1) {
            $this->writeWithText($logfile, $paramText, $paramDate, $paramExpediteur, $paramDestinataire, $paramSujetMail);
        } else {
            $this->writeWithoutText($logfile, $paramDate, $paramExpediteur, $paramDestinataire, $paramSujetMail);
        }
    }

    private function writeWithText($paramLogFile, $paramText, $date, $expediteur, $destinataire, $sujetmail) {
        if (!$this->ready) {
            return false;
        }

        if (empty($paramLogFile)) {
            trigger_error('<code>' . $paramLogFile . '</code> est vide', E_USER_WARNING);
            return false;
        }

        $fichier = fopen($paramLogFile, 'a+');

        $string = $date . $expediteur . ' : ' . $destinataire . ' : ' . $sujetmail . ' \n ' . $paramText . ' \n ';

        fputs($fichier, utf8_encode($string));
        fclose($fichier);
    }

    private function writeWithoutText($paramLogFile, $date, $expediteur, $destinataire, $sujetmail) {
        if (!$this->ready) {
            return false;
        }

        if (empty($paramLogFile)) {
            trigger_error('<code>' . $paramLogFile . '</code> est vide', E_USER_WARNING);
            return false;
        }

        $fichier = fopen($paramLogFile, 'a+');
        $string = $date . $expediteur . ' : ' . $destinataire . ' : ' . $sujetmail . ' \n ';
        fputs($fichier, utf8_encode($string));
        fclose($fichier);
    }

}
