<?php

/*
 * Copyright (C) 2014 salokine
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
 * Description of Logger
 *
 * @author salokine
 */
class Logger {

    const OUTPUT_TAB = '\t';
    const OUTPUT_CHR = '\n';
    const OUTPUT_FILE = '../../output.log';
    
    static public function Add($paramLog) {
        // DECLARATION DES VARIABLES LOCALES
        $outputContent = NULL;
        $outputContentResource = fopen(self::OUTPUT_FILE, 'a+');

        // Données à exporter
        $dataToExport = $paramLog;


        // Données contextuelle
        $outputContext = '\nLOG: ';

        // Construction de la ligne de log
        $outputContent = $outputContext . $dataToExport;


        // Enregistrement sous forme de fichier
        //ftruncate($outputContentResource, 0);
        fputs($outputContentResource, $outputContent);

        fclose($outputContentResource);
    }

}
