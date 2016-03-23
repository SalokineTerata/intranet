<?

/*
  Script PHP
  Ce Script effectue les transferts de flux de données entre les différents système de l'entreprise.
  Il permet ainsi une centralisation et cohérence des entrées/sorties des données.
  En raison du fort risque potentiel de ce script, les droits d'accès du compte "operateur" sont affectés de façon "sur-mesure" sur chaque système hote.

  Boris Sanègre 2003-11-10 (version 1)
  Boris Sanègre 2008-03-18 (version 2)

 */

//Récupération des variables globale dans le cas d'une navigation
ini_set("session.use_cookies", 0);

//Includes
require_once '../inc/main.php';

$mode = Lib::getParameterFromRequest("mode");
$env = Lib::getParameterFromRequest("env");

$globalConfig = new GlobalConfig();
//Dictionnaire des variables globales utilisées

$bdd = $globalConfig->getConf()->getMysqlDatabaseName(); //Base de données MySQL actuellement utilisée (cf. ../lib/session.php)
//Définition des variables locales
//Tout si le script est lancé via CGI ou CLI
if ($mode) {
    $argument_1 = $mode;              //Variable passée en URL
    $SHELL = "/bin/sh";               //Shell utilisé
    $SCRIPTNAME = "cli/netcopy.sh";   //Script généré
    $SCRIPTEXE = 1;                   //Exécuter le script shell après sa génération ?
} else {
    $argument_1 = $argv[1];           //Premier argument donné en ligne de commande
}
//$SYSLOG="/data/var/log/datasync.log";  //Fichier Log
$SYSLOG = "";  //Fichier Log désactivé

$LOGGING = "";                      //Variable tampon contenant le texte à mettre dans le fichier LOG
$CMD = "#!$SHELL\n"               //Liste des commandes envoyées au shell + Date de démarrage
        . "#Script permettant d'effectuer les copies Intersites\n"
        . "#ATTENTION !! Ce script a été autogénéré via datasync.sh\n"
        . "#Ne le modifiez qu'à l'aide du fichier PHP de l'intranet Agis\n"
        . "echo Base MySQL sélectionnée: " . $bdd . "\n"
//           . "/data/etc/init.d/ncpmanager.sh restart\n"
//           . "echo -n 'Démarrage de copie des données intersite à:'\n"
//           . "date\n"
;
//$CMD_FIN = "echo -n 'Fin de copie des données intersites à:'\n"
//$CMD_FIN = "/data/etc/init.d/ncpmanager.sh stop\n";//Fin du script

$CMD_MAP = "";                      //Commande de montage des volumes Netware dans le système de fichier Linux
$ENABLE_COPY = "";                  //la copie du fichier sera-t-elle réalisée ? (oui=1, non=0)
$DIR_BACKUP = "/.backup";           //Répertoire où sont stockées les sauvegarde des fichiers
$EXTENSION_BACKUP = "tar";          //Extension du type d'archive
$EXTENSION_COMPRESS = "bz2";        //Extension du type de compression
$EXTENSION_BACKUP_COMPRESS = "";    //Soit tar.bz ou .bz tout court
$VOL = "VOL1";                      //Volume de connection
$ENABLE_TAR = "";                   //Défini si l'archive doit subir l'excution du programme TAR
$FREQUENCE = "";                    //Frequence de synchronisation des données
$CMD_NCPUMOUNT = "";                //Commande de déconnexion explicite des Volume Netware du système de fichier Linux
//$RC="\ndate\n";                   //Formatage des retours charriots
$RC = "\n";                         //Formatage des retours charriots
$TMP = "";                          //Extension des fichiers temporaires
$REP_CONTENT = "";                  //Variable contenant (ou pas) la valeur "/*"
//$MAIL_TO="<informatiquesupport.avignon@agis-sa.fr>";
$MAIL_TO = "InformatiqueSupport.Avignon@agis-sa.fr";

#racine du chemin d'accès
$MAP_ROOT = "/mnt/ncp/ldcadm/";
//$MAP_ROOT_SMB="/u1/DATA01/Samba/";
$MAP_ROOT_SMB = "/u1/DATA01/users/";

#Personnalisation des commandes shell
//$RM="rm -Rfv";                //Verbeux
$RM = "rm -Rf";
//$CP="cp --reply=yes -vr";     //Verbeux
//$CP="cp --reply=yes -r";
$CP = "scp -r";
//$MV="mv --reply=yes -v";      //Verbeux
$MV = "mv --reply=yes";
//$TAR="tar -cvf ";             //Verbeux
$TAR = "tar -cf";
$BZIP2 = "bzip2 -f";
$RSYNC = "rsync -avzO --delete --no-p";
$SSH = "ssh -t";
$REMOTE_USER = "root";
/*
  Récupération des données MySQL
 */
/*
  //Liste des serveurs Netware concernés
  $req="SELECT * FROM datasync_serveur WHERE active_datasync_serveur=1 AND os_serveur_datasync_serveur='netware' ";
  $result=mysql_query($req);

  $CMD .="echo 'Nombre de serveur(s) Netware concerné(s): " . mysql_num_rows($result). "'\n";

  //Construction des chemins d'accès aux volumes des serveurs concernés    while ($rows=mysql_fetch_array($result))

  {
  $MAP="MAP_".$rows["nom_datasync_serveur"];
  $$MAP=$MAP_ROOT.$rows["ip_datasync_serveur"]."/".$VOL."/";
  }
 */

//Liste des serveurs Linux concernés

$req = "SELECT " . DataSyncServeurModel::FIELDNAME_NOM_DATASYNC_SERVEUR . "," . DataSyncServeurModel::KEYNAME
        . " FROM " . DataSyncServeurModel::TABLENAME . " WHERE " . DataSyncServeurModel::FIELDNAME_ACTIVE_DATASYNC_SERVEUR . "=" . DataSyncServeurModel::ACTIVE_DATASYNC_SERVEUR_TRUE
        . " AND " . DataSyncServeurModel::FIELDNAME_OS_SERVEUR_DATASYNC_SERVEUR . "='linux' ";
$array = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);

$sqlResult = DatabaseOperation::queryPDO($req);
$num = DatabaseOperation::getSqlNumRows($sqlResult);

$CMD .="echo 'Nombre de serveur(s) Linux concerné(s): " . $num . "'\n";
//Construction des chemins d'accès aux volumes des serveurs concernés
foreach ($array as $rows) {
    $MAP = "MAP_" . $rows[DataSyncServeurModel::FIELDNAME_NOM_DATASYNC_SERVEUR];
    //$$MAP="ldcadm@".$rows["ip_datasync_serveur"].":".$MAP_ROOT_SMB."/";
    $$MAP = $REMOTE_USER . "@" . $rows[DataSyncServeurModel::KEYNAME];
}

//Lancement du script
switch ($argument_1) {

    case "--majday":
    case "-d":
    case "1":
        //Frequence de 1 (Quotidienne)
        if (!$FREQUENCE) {
            ($FREQUENCE = 1);
        }

    case "--majweek":
    case "-w":
    case "2":
        //Frequence de 2 (Hebdomadaire)
        if (!$FREQUENCE) {
            ($FREQUENCE = 2);
        }

    case "--virus":
    case "-v":
    case "3":
        //Frequence de groupe 3 (Antivirus)
        if (!$FREQUENCE) {
            ($FREQUENCE = 3);
        }

//Montage des systèmes de fichier Netware (ncpfs)
//`/data/etc/init.d/ncpmanager.sh restart`;
//Activation du log ?
        if ($SYSLOG) {

            //Création du fichier log
            if ((!file_exists($SYSLOG)) or ( filesize($SYSLOG) > 10000000)) {

                //Si le fichier log n'existe pas, il est créé.
                echo "Le fichier $SYSLOG n'existe pas ou est trop gros,$RC il va être recréé ... ";
                echo "initialisation ... ";
                //`>$SYSLOG`;
                $buffer = fopen($SYSLOG, w);
                echo "OK.$RC";
            }

            //Activation du fichier log
            // Assurons nous que le fichier est accessible en ecriture
            if (is_writable($SYSLOG)) {

                // Dans notre exemple, nous ouvrons le fichier $filename en mode d'ajout
                // Le pointeur de fichier est plac&eacute; &agrave; la fin du fichier
                // c'est l&agrave; que $somecontent sera plac&eacute;
                if (!$LOGGING = fopen($SYSLOG, 'a')) {
                    print "Impossible d'écrire dans le fichier ($SYSLOG)";
                    exit;
                }
                $CMD .= "echo 'Logging activé dans $SYSLOG'\n";
            }
        } else {
//   $CMD .= "echo 'Logging désactivé'\n";
        }
        //Construction des commandes de copie
        //$req="SELECT * FROM sync_transfert WHERE frequence_synchronisation=$FREQUENCE";
        $req = "SELECT datasync_transfert . * , ORIGINE." . DataSyncServeurModel::FIELDNAME_NOM_DATASYNC_SERVEUR
                . " AS SERVEUR_ORIGINE, DEST." . DataSyncServeurModel::FIELDNAME_NOM_DATASYNC_SERVEUR . " AS SERVEUR_DEST"
                . " FROM " . DataSyncTransfertModel::TABLENAME . ", " . DataSyncServeurModel::TABLENAME . " AS ORIGINE, "
                . DataSyncServeurModel::TABLENAME . " AS DEST"
                . " WHERE " . DataSyncTransfertModel::FIELDNAME_FREQUENCE_SYNCHRONISATION . "=" . $FREQUENCE
                . " AND ORIGINE." . DataSyncServeurModel::FIELDNAME_NOM_DATASYNC_SERVEUR . " = " . DataSyncTransfertModel::FIELDNAME_NOM_DATASYNC_SERVEUR_ORIGINE
                . " AND DEST." . DataSyncServeurModel::FIELDNAME_NOM_DATASYNC_SERVEUR . " = " . DataSyncTransfertModel::FIELDNAME_NOM_DATASYNC_SERVEUR_DESTINATION
                . " AND ORIGINE." . DataSyncServeurModel::FIELDNAME_ACTIVE_DATASYNC_SERVEUR . " =" . DataSyncServeurModel::ACTIVE_DATASYNC_SERVEUR_TRUE
                . " AND DEST." . DataSyncServeurModel::FIELDNAME_ACTIVE_DATASYNC_SERVEUR . " =" . DataSyncServeurModel::ACTIVE_DATASYNC_SERVEUR_TRUE

        ;
        $sqlResult = DatabaseOperation::queryPDO($req);
        $num = DatabaseOperation::getSqlNumRows($sqlResult);

        $CMD .="echo 'Nombre de dossier(s) à mettre à jour: " . $num . "'\necho \n";

        $array = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req);

        foreach ($array as $rows1) {
            $MAP_ORIGINE = "MAP_" . $rows1["nom_datasync_serveur_origine"];
            $MAP_DESTINATION = "MAP_" . $rows1["nom_datasync_serveur_destination"];
            $COMPLETE_FILE = $rows1["nom_fichier"];
            $PATH = pathinfo($COMPLETE_FILE);
            $DIR = $PATH["dirname"];
            $EXTENSION = $PATH["extension"];
            $FILE = basename($PATH["basename"], $EXTENSION);
            $ENABLE_COPY = 1;
            $ENABLE_ARCHIVE = $rows1["copie_sauvegarde"];  //Non implémenté sur Samba
            //Pour les fichiers Access, il est necessaire de vérifier si les bases ne sont pas ouvertes
            if (strtoupper($EXTENSION) == "MDB") {

                //Test de l'existance d'un vérrou
                $FILE_LOCK = $$MAP_DESTINATION . $DIR . "/" . $FILE . "ldb";
                if (file_exists($FILE_LOCK)) {
                    $ENABLE_COPY = 0;
                    $mail_to = $MAIL_TO;
                    $mail_from = "<linux@agis.fr>";
                    $mail_subject = "Intranet Datasync";
                    $mail_message = "Impossible de mettre à jour le fichier:$RC"
                            . $$MAP_DESTINATION . $COMPLETE_FILE
                            . "$RC" . "Un verrou de type '.ldb' était présent lors de la tentative de copie à la date suivante:$RC"
                            . date("F j, Y, g:i a")
                            . "."
                    ;
                    //Envoi du mail
                    envoismail($mail_subject, $mail_message, $mail_to, $mail_from);

                    //Enregistrement dans le Log
                    $CMD .="echo [ERREUR]: Copie Annulée car le Fichier " . $$MAP_DESTINATION . $COMPLETE_FILE . " est Ouvert\n";
                }
            }
            if ($ENABLE_COPY) {
                //Suppression du fichier si ce n'est pas un répertoire
                if (!$EXTENSION) {
                    $TMP = ".tmp";
                    $REP_CONTENT = "/*";
                } else {

                    $TMP = "tmp";
                    $REP_CONTENT = "";
                }
                //$CMD.=$RM." ".$$MAP_DESTINATION.$COMPLETE_FILE.$REP_CONTENT."\n";
                //$CMD.= $CP." ".$$MAP_ORIGINE.$COMPLETE_FILE." ".$$MAP_DESTINATION.$DIR.$DIR_BACKUP."/".$FILE.$TMP.$RC;
                //$CMD.= $CP." ".$$MAP_ORIGINE.$COMPLETE_FILE.$REP_CONTENT." ".$$MAP_DESTINATION.$COMPLETE_FILE.$RC;
                //$CMD.= $MV." ".$$MAP_DESTINATION.$DIR.$DIR_BACKUP."/".$FILE.$TMP.$REP_CONTENT." ".$$MAP_DESTINATION.$COMPLETE_FILE."$RC";
                $CMD.= $SSH . " " . $$MAP_ORIGINE . " " . $RSYNC . " " . $MAP_ROOT_SMB . $COMPLETE_FILE . " " . $$MAP_DESTINATION . ":" . $MAP_ROOT_SMB . $DIR . $RC;

                //Utile si il reste des résidus
                //$CMD.= $RM." ".$$MAP_DESTINATION.$DIR.$DIR_BACKUP."/".$FILE.$TMP.$RC;
            }

            //Archivage distant de secours
            if ($ENABLE_ARCHIVE) {
                //Si l'élément à sauvegarde est un répertoire
                //if(is_dir($$MAP_ORIGINE.$COMPLETE_FILE)) (cette commande ne marche pas pour des fichiers distant
                if (!$EXTENSION) {
                    $EXTENSION_BACKUP_COMPRESS = $EXTENSION_BACKUP . "." . $EXTENSION_COMPRESS;
                    $ENABLE_TAR = 1;
                } else {  //Sinon
                    $EXTENSION_BACKUP_COMPRESS = $EXTENSION_COMPRESS;
                    $ENABLE_TAR = 0;
                }

                //Suppression de l'archives existante
                if (file_exists($$MAP_ORIGINE . $DIR . $DIR_BACKUP . "/" . $FILE . "." . $EXTENSION_BACKUP_COMPRESS)) {
                    $CMD.= $RM . " " . $$MAP_ORIGINE . $DIR . $DIR_BACKUP . $FILE . "." . $EXTENSION_BACKUP_COMPRESS . "$RC";
                }

                //Archivage du répetoire puis compression (et écrasement de l'ancienne version)
                if ($ENABLE_TAR) {
                    $CMD.=$TAR . $$MAP_ORIGINE . $DIR . $DIR_BACKUP . "/" . $FILE . "." . $EXTENSION_BACKUP
                            . " " . $$MAP_ORIGINE . $DIR . "/" . $FILE . $EXTENSION
                            . "$RC"
                    ;
                    $EXTENSION = "." . $EXTENSION_BACKUP;
                } else {
                    $CMD.=$CP . " " . $$MAP_ORIGINE . $DIR . "/" . $FILE . $EXTENSION . " " . $$MAP_ORIGINE . $DIR . $DIR_BACKUP . "$RC";
                }

                //Compression de l'archive
                $CMD.=$BZIP2 . $$MAP_ORIGINE . $DIR . $DIR_BACKUP . "/" . $FILE . $EXTENSION . "$RC";

                //Délocalisation de la sauvegarde
                $CMD.=$CP . " " . $$MAP_ORIGINE . $DIR . $DIR_BACKUP . "/" . $FILE . $EXTENSION . "." . $EXTENSION_COMPRESS
                        . " " . $$MAP_DESTINATION . $DIR . $DIR_BACKUP . "/" . $FILE . $EXTENSION . "." . $EXTENSION_COMPRESS
                        . "$RC"
                ;
            }//Fin de l'archivage
        }


        //Déconnexion des serveurs Netware
        $CMD .=$CMD_FIN;

        //Utile lorsqu'on lance le script depuis la console
        //echo $CMD;
        //Création du script ou excution direct des commandes shell
        if ($mode) {
            $buffer = fopen($SCRIPTNAME, w);
            fwrite($buffer, $CMD);
            `chmod +x $SCRIPTNAME`;
        } else {
            fwrite($LOGGING, `$CMD`);
        }

        //Fermeture du fichier log
        if ($LOGGING) {
            fclose($LOGGING);
        }


        //Démontage des systèmes de fichier Netware (ncpfs)
//`/data/etc/init.d/ncpmanager.sh stop`;

        break;

    case "--view-log":
    case "-v":

        echo `cat $SYSLOG`;

        break;

    case "--clear-log":
    case "-c":

        `>$SYSLOG`;
        echo "Le fichier log $SYSLOG est nettoyé.$RC";

        break;

    case "--help":
    default:
        echo "
 datasync v1.0.1 créé par Boris

 synthaxe: php datasync.php [COMMANDE]

 Liste des commandes:
 --------------------

 -d, --majday, 1    Lancement des synchronisations quotidiennes des données
 -w, --majweek, 2   Lancement des synchronisations hebdomadaires des données
 -v, --virus, 3     Synchronisation des bases d'information des Virus Clamav
 -h, --help         aide sur la synthaxe
 -v, --view-log     Visualitaion du log
 -c, --clear-log    Vide le fichier log

 NOTE: il est préférable que la commande soit lancé depuis l'utlisateur root.
 PRE-REQUIS: lancez /etc/init.d/ncplogin et /etc/init.d/ncpmount

 ";
}
?>
