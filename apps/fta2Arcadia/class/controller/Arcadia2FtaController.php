<?php

/*
 * Copyright (C) 2016 fa4301632
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
 * Description of Arcadia2Fta
 * Class gérant l'actualisation des données de la BDD Arcaida 
 *  à partir du fichier de retour d'Arcadia
 * @author franckwastaken
 */
class Arcadia2FtaController {

    const MAIL_FROM = "Informatique.AGIS@agis-sa.fr";

    /**
     * Lien du dossier contenant le fichier XML.OK
     * @var string 
     */
    private $linkFolderOK;

    /**
     * Lien du dossier contenant le fichier XML
     * @var string 
     */
    private $linkFolder;

    /**
     * Nom de la BDD
     * @var string 
     */
    private $nameOfBDDTarget;

    /**
     * Tableau de la config.ini
     * @var array 
     */
    private $initFile;

    public function __construct($paramNameOfBDDTarget, $paramHostNameConnect, $paramUserNameConnect
    , $paramPasswordConnect, $paramLinkFolder, $paramInitFile, $paramLinkFolderOk) {
        /**
         * Connection à la BDD
         */
        mysql_pconnect($paramHostNameConnect, $paramUserNameConnect, $paramPasswordConnect);
        mysql_select_db($paramNameOfBDDTarget);
        mysql_query('SET NAMES utf8');
        /**
         * Initialisation
         */
        $this->setLinkFolder($paramLinkFolder);
        $this->setLinkFolderOK($paramLinkFolderOk);
        $this->setNameOfBDDTarget($paramNameOfBDDTarget);
        $this->setInitFile($paramInitFile);
    }

    function getLinkFolderOK() {
        return $this->linkFolderOK;
    }

    function setLinkFolderOK($linkFolderOK) {
        $this->linkFolderOK = $linkFolderOK;
    }

    function getInitFile() {
        return $this->initFile;
    }

    function setInitFile($initFile) {
        $this->initFile = $initFile;
    }

    function getNameOfBDDTarget() {
        return $this->nameOfBDDTarget;
    }

    function setNameOfBDDTarget($nameOfBDDTarget) {
        $this->nameOfBDDTarget = $nameOfBDDTarget;
    }

    function getLinkFolder() {
        return $this->linkFolder;
    }

    function setLinkFolder($linkFolder) {
        $this->linkFolder = $linkFolder;
    }

    /**
     * Actualisation des données Fta à partir du fichier de retour d'Arcadia
     */
    function updateBDDFtaFromArcadiaData() {
        $linkFolderOK = $this->getLinkFolderOK();
        $linkFolder = $this->getLinkFolder();
        $nameOfBDDTarget = $this->getNameOfBDDTarget();
        $initFile = $this->getInitFile();
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
                    /**
                     * Récupération des élements du fichier XML
                     */
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

                    /**
                     * Requete de MAJ de la table de transactions
                     */
                    $sql_inter = Fta2ArcadiaTransactionModel::getSQLUpdateFta2ArcadiaTransaction($nameOfBDDTarget, $codeReply, $codeArticleArcadia, $idFta, $idTransaction);

                    if (mysql_query($sql_inter)) {
                        echo "[OK] id_Trasaction " . $idTransaction . "\n";
                        /**
                         * On vérifie si la transaction en cours est actif
                         */
                        $sqlActif = Fta2ArcadiaTransactionModel::getSQLIdUserMailNotifFta2ArcadiaTransaction($nameOfBDDTarget, $idTransaction);

                        $arrayIdArcadiaTransaction = mysql_query($sqlActif);

                        if ($arrayIdArcadiaTransaction) {
                            while ($value = mysql_fetch_array($arrayIdArcadiaTransaction)) {
                                $actifTransaction = $value[Fta2ArcadiaTransactionModel::FIELDNAME_ACTIF];
                                $notificationMailTransaction = $value[Fta2ArcadiaTransactionModel::FIELDNAME_NOTIFICATION_MAIL];
                                $idUserTransaction = $value[Fta2ArcadiaTransactionModel::FIELDNAME_ID_USER];
                            }
                        } else {
                            echo UserInterfaceMessage::FR_ARCADIA_ERREUR_SCRIT_MESSAGE_TRANSACTION . $idTransaction;
                        }

                        /**
                         * On actualise le code Article Arcadia de la Fta
                         */
                        echo "Transaction " . $idTransaction . " " . Fta2ArcadiaTransactionModel::FIELDNAME_ACTIF
                        . " = " . $actifTransaction . "  Mail = " . $notificationMailTransaction . " user = " . $idUserTransaction;
                        if ($actifTransaction) {

                            if ($codeReply == "0") {
                                /**
                                 * Requète de MAJ de la table Fta
                                 */
                                $sql_fta = FtaModel::getSQLFta2ArcadiaTransactionUpdateFtaTable($nameOfBDDTarget, $idFta, $codeArticleArcadia);
                                mysql_query($sql_fta);

                                $corpsmail = UserInterfaceMessage::FR_ARCADIA_OK_SCRIT_MESSAGE;
                            }
                            if ($notificationMailTransaction) {
                                if ($codeReply <> "0") {
                                    $corpsmail = UserInterfaceMessage::FR_ARCADIA_ERREUR_SCRIT_MESSAGE_CODE_REPLY;
                                }
                                /**
                                 * Récupération du mail de l'utilisateur
                                 */
                                $sqlMail = UserModel::getSqlMailFromIdUserFta2ArcadiaTransaction($nameOfBDDTarget, $idUserTransaction);
                                $arrayIdUserTransaction = mysql_query($sqlMail);

                                if ($arrayIdUserTransaction) {
                                    while ($value = mysql_fetch_array($arrayIdUserTransaction)) {
                                        $sujet = " Le fichier " . $file . " est revenu ";
                                        $adrTo = $value[UserModel::FIELDNAME_MAIL];
                                        $adrFrom = self::MAIL_FROM;

                                        //Création du mail

                                        $smtp = $initFile[EnvironmentInit::SMTP_SERVER_NAME][EnvironmentConf::ENV_CLI];

                                        $result = $this->sendMail($sujet, $corpsmail, $adrTo, $adrFrom, $smtp);
                                        if ($result) {
                                            echo UserInterfaceMessage::FR_ARCADIA_OK_SCRIT_MESSAGE_MAIL;
                                        } else {
                                            echo UserInterfaceMessage::FR_ARCADIA_ERREUR_SCRIT_MESSAGE_MAIL_2 . $idTransaction;
                                        }
                                    }
                                } else {
                                    echo UserInterfaceMessage::FR_ARCADIA_ERREUR_SCRIT_MESSAGE_MAIL . $idTransaction;
                                }
                            }
                        }
                        /**
                         * Suppression des fichiers
                         */
                        unlink($linkFolder . $file);
                        unlink($linkFolderOK . $file . ".ok");
                    } else {
                        echo "[FAILED] id_Trasaction " . $idTransaction . "\n";
                    }
                }
            }
        }
    }

    /**
     * Envoie de mail sur l'evolution des données de la transactions depuis Arcadia
     * @param string $paramSujet
     * @param string $paramCorpMail
     * @param string $paramArdTto
     * @param string $paramArdFrom
     * @param string $paramUrlSmtp
     * @return string
     */
    function sendMail($paramSujet, $paramCorpMail, $paramArdTto, $paramArdFrom, $paramUrlSmtp) {
        //Création du mail
        $mail = new htmlMimeMail5();

//                               
        $mail->setSMTPParams($paramUrlSmtp);

        // Set the From and Reply-To headers
        $mail->setFrom($paramArdFrom);
        $mail->setReturnPath($paramArdFrom);

        // Set the Subject
        $mail->setSubject($paramSujet);

        /**
         * Encodement en utf-8
         */
        $mail->setTextCharset("UTF-8");
        $mail->setHTMLCharset("UTF-8");
        $mail->setHeadCharset("UTF-8");

        // Set the body       
        $mail->setHTML(nl2br($paramCorpMail));
        /**
         * L'envoi réel du mail n'est pas réalisé en environnement Codeur
         */
        $result = $mail->send(array($paramArdTto), 'smtp');

        return $result;
    }

}
