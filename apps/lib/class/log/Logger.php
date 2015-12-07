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

    const OUTPUT_TAB = "\t";
    const OUTPUT_CHR = "\n";
    //const OUTPUT_FILE = 'D:\\weblocal\\output.log';
    const OUTPUT_FILE = '../../log/output.log';
    const MSG_LEVEL_LOG = "LOG";
    const MSG_LEVEL_DEBUG = "DBG";

    static public function AddDebug($paramLog, $paramContext) {
        $globalConfig = new GlobalConfig();
        if ($globalConfig->getConf()->getExecDebugEnable()) {
            self::Add($paramLog, $paramContext, self::MSG_LEVEL_DEBUG);
        }
    }

    static public function AddLog($paramLog, $paramContext) {
        self::Add($paramLog, $paramContext, self::MSG_LEVEL_LOG);
    }

    static public function Add($paramLog, $paramContext, $paramMessageLevel) {
        // DECLARATION DES VARIABLES LOCALES
        $outputContent = NULL;
        $outputContentResource = fopen(self::OUTPUT_FILE, 'a+');
        $time = date("Y-m-d H:i:s");
        $remoteAddr = $serverNameReal = filter_input(INPUT_SERVER, 'REMOTE_ADDR');

        // Données à exporter
        $dataToExport = $paramLog;


        // Données contextuelle
        $outputContext = $time . " " . $paramMessageLevel . " " . $remoteAddr . " " . $paramContext . " : ";

        // Construction de la ligne de log
        $outputContent = $outputContext . $dataToExport . self::OUTPUT_CHR;


        // Enregistrement sous forme de fichier
        fputs($outputContentResource, $outputContent);
        fclose($outputContentResource);
    }

}
