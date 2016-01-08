<?php

$nameOfBDDTarget = $argv[1];
$nameOfBDDOrigin = $argv[2];
$nameOfBDDStructure = $argv[3];

$hostname_connect = $argv[4]; //nom du serveur MySQL de connection � la base de donn�e
$database_connect = $nameOfBDDTarget; //nom de la base de donn�e sur votre serveur MySQL
$username_connect = $argv[5]; //login de la base MySQL
$password_connect = $argv[6];
; //mot de passe de la base MySQL

$donnee = mysql_pconnect($hostname_connect, $username_connect, $password_connect);
mysql_select_db($database_connect);
mysql_query('SET NAMES utf8');

$debut = date("H:i:s");
echo date("H:i:s") . "\n";

$sql = "SELECT id_fta,id_fta_etat"
        . " FROM fta"
        . " WHERE id_fta_workflow=" . "6"
;
$arrayClassifIncomplete = mysql_query($sql);
if ($arrayClassifIncomplete) {
    while ($rowsClassifInComplete = mysql_fetch_array($arrayClassifIncomplete)) {
        $idFta = $rowsClassifInComplete["id_fta"];
        $IdFtaEtat = $rowsClassifInComplete["id_fta_etat"];

        /**
         * Initailisation du nouveau chapitre
         */
        $sql2 = 'SELECT id_fta_chapitre'
                . ', id_fta_processus'
                . ' FROM fta_workflow_structure'
                . ' WHERE id_fta_workflow'
                . '=' . "6"
        ;
        $arrayChapitre = mysql_query($sql2);

        while ($rowsChapitre = mysql_fetch_array($arrayChapitre)) {

            $sql3 = 'SELECT id_fta_suivi_projet'
                    . ' FROM fta_suivi_projet'
                    . ' WHERE id_fta'
                    . '=' . $idFta
                    . ' AND id_fta_chapitre'
                    . '=' . $rowsChapitre["id_fta_chapitre"]
            ;
            $resultCheckIdSuiviProjet = mysql_query($sql3);
            $arrayCheckIdSuiviProjet = mysql_fetch_array($resultCheckIdSuiviProjet, MYSQL_ASSOC);
            if (!$arrayCheckIdSuiviProjet['id_fta_suivi_projet']) {
                if ($rowsChapitre["id_fta_processus"] == 0) {
                    mysql_query(
                            'INSERT INTO fta_suivi_projet'
                            . '(id_fta'
                            . ', id_fta_chapitre'
                            . ', signature_validation_suivi_projet'
                            . ') VALUES (' . $idFta
                            . ', ' . $rowsChapitre["id_fta_chapitre"]
                            . ', 1 )'
                    );
                } else {
                    mysql_query(
                            'INSERT INTO fta_suivi_projet'
                            . '(id_fta'
                            . ', id_fta_chapitre'
                            . ', signature_validation_suivi_projet'
                            . ') VALUES (' . $idFta
                            . ', ' . $rowsChapitre["id_fta_chapitre"]
                            . ', 0 )'
                    );
                }
            }
        }

        /**
         * Validation des Fta autres que dans l'état de modification
         */
        if ($IdFtaEtat <> "1") {
            $validation = mysql_query(
                    "UPDATE fta_suivi_projet"
                    . " SET signature_validation_suivi_projet=-3"
                    . " WHERE id_fta=" . $idFta
                    . " AND id_fta_chapitre=" . "41"
            );
            if ($validation) {
                echo "id_fta=" . $idFta . " OK \n";
            } else {
                echo "id_fta=" . $idFta . " FAILDED \n";
            }
        } else {
            echo "Cette Id " . $idFta . " Fta n'est pas à validé \n";
        }
    }
    echo"Debut :" . $debut . " Fin :" . date("H:i:s") . " Temps complet part 1 :" . $debut - date("H:i:s") . "\n";
} else {
    echo "<br>Vous vennez d'executer un script interdit <br> CONTACTEZ IMMEDIATEMENT L'ADMINISTRATEUR DU SITE!!!!!!!!!!!!!<br>";
}
