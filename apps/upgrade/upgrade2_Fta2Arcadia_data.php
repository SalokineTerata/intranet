<?php

/* * *******
  Inclusions
 * ******* */

/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$nameOfBDDTarget = $argv[1];


//$hostname_connect = "dev-intranet.agis.fr"; //nom du serveur MySQL de connection � la base de donn�e
$hostname_connect = $argv[2]; //nom du serveur MySQL de connection � la base de donn�e
//$username_connect = "root"; //login de la base MySQL
$username_connect = $argv[3]; //login de la base MySQL
//$password_connect = "8ale!ne"; //mot de passe de la base MySQL
$password_connect = $argv[4];
//mot de passe de la base MySQL

$linkFolder = $argv[5];


$donnee = mysql_pconnect($hostname_connect, $username_connect, $password_connect);
mysql_select_db($nameOfBDDTarget);
mysql_query('SET NAMES utf8');

/**
 * Fichiers ordonné dans un ordre décroissant
 */
$folder = scandir($linkFolder, 1);

for ($i = 0; $i < count($folder); $i++) {
    /**
     * Nom du fichier
     */
    $file = $folder[$i];

    /**
     * Contenue du fichier
     */
    $fileContent = file_get_contents($linkFolder . $file);

    /**
     * Vérification que le fichier soit un XML
     */
    $xml = XMLReader::open($linkFolder . $file);
    $xml->setParserProperty(XMLReader::VALIDATE, true);
    $valide = $xml->isValid();
    if ($valide) {
        /**
         * Début du traitement d'actualisation des données de BDD
         */
        $dom = new DomDocument;
        /**
         * Intégration du fichier
         */
        if ($fileContent) {
            $dom->loadXML($fileContent);
            $Transaction = $dom->getElementsByTagName("Transaction");

            foreach ($Transaction as $value) {
                $idTransaction = $value->getAttribute("id");
            }

            $IdFta = $dom->getElementsByTagName("IdFta");

            foreach ($IdFta as $IdFtaValue) {
                $idFta = $IdFtaValue->nodeValue;
            }

            $CodeReply = $dom->getElementsByTagName("CodeReply");

            foreach ($CodeReply as $CodeReplyValue) {
                $codeReply = $CodeReplyValue->nodeValue;
            }

            $IdArcadia = $dom->getElementsByTagName("IdArcadia");

            foreach ($IdArcadia as $IdArcadiaValue) {
                $codeArticleArcadia = $IdArcadiaValue->nodeValue;
            }

            $sql_inter = "UPDATE " . $nameOfBDDTarget . "." . "fta2arcadia_transaction"
                    . " SET " . "code_reply" . "='" . $codeReply
                    . "', " . "code_article_ldc" . "='" . $codeArticleArcadia
                    . "', " . "date_retour" . "='" . date("Y-m-d H:i:s")
                    . "' WHERE " . 'id_fta' . "='" . $idFta
                    . "' AND " . 'id_arcadia_transaction' . "='" . $idTransaction . "'";
            if (mysql_query($sql_inter)) {
                echo "[OK] id_Trasaction" . $idTransaction . "\n";
                /**
                 * On vérifie si la transaction en cours est actif
                 */
                $arrayIdArcadiaTransaction = mysql_query(
                        "SELECT DISTINCT actif,notification_mail,id_user "
                        . " FROM " . $nameOfBDDTarget . ".fta2arcadia_transaction"
                        . " WHERE " . $nameOfBDDTarget . ".id_arcadia_transaction = '" . $idTransaction . "'"
                );
                if ($arrayIdArcadiaTransaction) {
                    while ($value = mysql_fetch_array($arrayIdArcadiaTransaction)) {
                        $actifTransaction = $value["actif"];
                        $notificationMailTransaction = $value["notification_mail"];
                        $idUserTransaction = $value["id_user"];
                    }
                }

                /**
                 * On actualise le code Article Arcadia de la Fta
                 */
                if ($actifTransaction) {

                    if ($codeReply == "0") {
                        $sql_fta = "UPDATE " . $nameOfBDDTarget . "." . "fta"
                                . " SET " . "code_article_ldc" . "='" . $codeArticleArcadia
                                . "' WHERE " . 'id_fta' . "='" . $idFta . "'";
                        mysql_query($sql_fta);

                        $corpsmail = " Tout s'est bien passé pour l'envoi d'informations vers Arcadia.";
                    }
                    if ($notificationMailTransaction) {
                        if ($codeReply <> "0") {
                            $corpsmail = " Une erreur s'est produite durant l'envoi d'informations vers Arcadia.";
                        }
                        $arrayIdUserTransaction = mysql_query(
                                "SELECT DISTINCT mail "
                                . " FROM " . $nameOfBDDTarget . ".salaries "
                                . " WHERE " . $nameOfBDDTarget . ".id_user = '" . $idUserTransaction ."'"
                        );
                        if ($arrayIdUserTransaction) {
                            while ($value = mysql_fetch_array($arrayIdUserTransaction)) {
                                $sujet = " Le fichier " . $file . " est revenu ";
                                $adrTo = $value["mail"];
                                $adrFrom = "Informatique.AGIS@agis-sa.fr";
                                envoismail($sujet, $corpsmail, $adrTo, $adrFrom);
                            }
                        }
                    }
                }
            } else {
                echo "[FAILED] id_Trasaction" . $idTransaction . "\n";
            }
        }
    }
}


$debut = date("H:i:s");

echo"Debut :" . $debut . " Fin :" . date("H:i:s") . "\n";
?>