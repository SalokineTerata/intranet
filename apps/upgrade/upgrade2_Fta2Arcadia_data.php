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
echo "link = " . $linkFolder;
$folder = scandir($linkFolder, 1);
echo "NBfolder = " . count($folder);
for ($i = 0; $i < count($folder); $i++) {
    $file = $folder[$i];
    echo "file = " . $file;
    $xml = XMLReader::open($linkFolder . $file);
    $xml->setParserProperty(XMLReader::VALIDATE, true);
    $valide = $xml->isValid();
    if ($valide) {
        $parametres = simplexml_load_file($linkFolder . $file);
        $dom = new DomDocument;
        $dom->load($file);
        $Transaction = $dom->getElementsByTagName("Transaction");
        foreach ($Transaction as $value) {
            $idTransaction = $value->getAttribute("id");
        }
        $idFta = $parametres->xpath("IdFta");
        $codeReply = $parametres->xpath("CodeReply");
        $codeArticleArcadia = $parametres->xpath("IdArcadia");

        $sql_inter = "UPDATE " . $nameOfBDDTarget . "." . "fta2arcadia_transaction"
                . " SET " . "code_reply" . "=" . $codeReply
                . ", " . "code_article_ldc" . "=" . $codeArticleArcadia
                . " WHERE " . 'id_fta' . "=" . $idFta
                . " AND " . 'id_arcadia_transaction' . "=" . $idTransaction;
        echo "UPDATE " . $nameOfBDDTarget . "." . "fta2arcadia_transaction"
        . " SET " . "code_reply" . "=" . $codeReply
        . ", " . "code_article_ldc" . "=" . $codeArticleArcadia
        . " WHERE " . 'id_fta' . "=" . $idFta
        . " AND " . 'id_arcadia_transaction' . "=" . $idTransaction . " ...";
        if (mysql_query($sql_inter)) {
            echo "[OK]\n";
        } else {
            echo "[FAILED]\n";
        }
    }
}

while ($rowsFta = mysql_fetch_array($arrayFta)) {
    $arrayIdFtaClassfication = mysql_query(
            "SELECT DISTINCT id_fta_classification2 "
            . " FROM " . $nameOfBDDTarget . ".classification_fta, " . $nameOfBDDTarget . ".classification_fta2"
            . " WHERE " . $nameOfBDDTarget . ".classification_fta.id_classification_arborescence_article = " . $nameOfBDDTarget . ".classification_fta2.id_arborescence"
            . " AND " . $nameOfBDDTarget . ".classification_fta.id_fta = " . $rowsFta['id_fta']
    );
    if ($arrayIdFtaClassfication) {
        while ($value = mysql_fetch_array($arrayIdFtaClassfication)) {
            $sql_inter = "UPDATE " . $nameOfBDDTarget . "." . "fta"
                    . " SET " . "id_fta_classification2" . "=" . $value["id_fta_classification2"]
                    . " WHERE " . 'id_fta' . "=" . $rowsFta['id_fta'];
            echo "UPDATE " . $nameOfBDDTarget . "." . "fta." . 'id_fta' . "=" . $rowsFta['id_fta'] . " id_fta_classification2" . "=" . $value["id_fta_classification2"] . " ...";
            if (mysql_query($sql_inter)) {
                echo "[OK]\n";
            } else {
                echo "[FAILED]\n";
            }
        }
    }
}

$debut = date("H:i:s");

echo"Debut :" . $debut . " Fin :" . date("H:i:s") . "\n";
?>