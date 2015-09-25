<?php
//Changement de répertoire courant vers le répertoire contenant cette page web
//Inutile via Interface Web
//chdir (dirname($argv[0]));

//Récupération des variables globales dans le cas d'une navigation
ini_set("session.use_cookies",0);
include("../session.php");

/*
  Initialisation des variables
*/
    //Informations d'autentification NDS
    $NDS_SERVER="10.143.4.1";
    $LOGIN=".cn=operateur.ou=cdg.o=agis98";

    //Recherche du mot de passe NIVEAU 1
    $req="SELECT valeur_intranet_password FROM intranet_password WHERE id_intranet_password=1";
    $result=DatabaseOperation::query($req);
    $PASSWORD=mysql_result($result, 0);

    //$NCPLOGIN="ncplogin -E -l -S $NDS_SERVER -U $LOGIN -P '$PASSWORD' -A $NDS_SERVER $RC";    //Verbeux
    $NCPLOGIN="ncplogin -l -S $NDS_SERVER -U $LOGIN -P \"$PASSWORD\" -A $NDS_SERVER";
    $CMD_MAP="";                           //Commande de montage des volumes Netware dans le système de fichier Linux
    $VOL="VOL1";                           //Volume de connection
    $MAP_ROOT="/mnt/ncp/knoppix/";         //racine du chemin d'accès
    //$NCPMAP="ncpmap -E -l -V $VOL";      //Verbeux
    $NCPMAP="ncpmap -l -V $VOL";
    $NCPUMOUNT = "ncpumount ".$MAP_ROOT."10.143.4.1/$VOL\n"
               //. "ncpumount ".$MAP_ROOT."10.2.1.5/$VOL\n"
               . "ncpumount ".$MAP_ROOT."10.3.1.5/$VOL\n"
               . "ncpumount ".$MAP_ROOT."10.4.1.5/$VOL\n"
               ;
    $NCPLOGOUT="ncplogout -a";

    //Informations Script Linux
    $SHELL="/bin/sh";
    $SCRIPTNAME="/data/etc/init.d/ncpmanager.sh";
    $SCRIPTCONTENT="";


/*
  Récupération des données MySQL
*/
    //Liste des serveurs concernés
    $req="SELECT nom_datasync_serveur,ip_datasync_serveur FROM datasync_serveur WHERE active_datasync_serveur=1";
    $result=DatabaseOperation::query($req);

    //Construction des chemins d'accès aux volumes des serveurs concernés
    while ($rows=mysql_fetch_array($result))
    {
           $MAP="MAP_".$rows["nom_datasync_serveur"];
           $$MAP=$MAP_ROOT.$rows["ip_datasync_serveur"]."/".$VOL."/";
           $CMD_MAP.=$NCPMAP
               . " -S " . $rows["ip_datasync_serveur"]
               . " -A " . $rows["ip_datasync_serveur"]
               . "\n";
    }

    //Liste de tout les serveurs
    //$req="SELECT * FROM datasync_serveur";
    //$result=DatabaseOperation::query($req);

//Lancement de la commande d'authentification NDS
//echo "test";
//echo `$NCPLOGIN`;







#Informations d'autentification NDS



//Génération du script de connexion
//echo "Mise à jour du script de connexion auprès de la NDS<br>";
//echo "<br>";


$SCRIPTCONTENT = "#!$SHELL\n"
               . "#Script permettant de controler la connexion avec les serveurs Netware\n"
               . "#Créé Par Boris 2004-03-03\n"
               . "#ATTENTION !! Ce script a été autogénéré via ncpmanager.php\n"
               . "#Ne le modifiez qu'à l'aide du fichier PHP de l'intranet Agis\n"
               . "sudo chmod +s /usr/bin/ncp*\n"
               . "case \$1 in\n"
               . "  start)\n"
               //. "    echo 'Starting Netware Connections:'\n"
               //. "    echo '  -> login to NDS...'\n"
               . "    $NCPLOGIN\n"
               //. "    echo '   OK'\n"
               . "    sleep 5\n"
               //. "    echo '  ->  mounting ncp-filesystem...'\n"
               . "$CMD_MAP"
               . "    sleep 5\n"
               //. "    echo '   OK'\n"
               . "    ;;\n"
               . "\n"
               . "  stop)\n"
               //. "    echo 'Stopping Netware Connections:'\n"
               //. "    echo '  -> unmounting ncp-filesystem...'\n"
               . "$NCPUMOUNT"
               //. "    echo '   OK'\n"
               . "    sleep 5\n"
               //. "    echo '  -> logout from NDS...'\n"
               . "    $NCPLOGOUT\n"
               //. "    echo '   OK'\n"
               . "    sleep 5\n"
               . "    ;;\n"
               . "\n"
               . "  restart)\n"
               . "    \$0 stop\n"
               . "    sleep 10\n"
               . "    \$0 start\n"
               . "    ;;\n"
               . "\n"
               . "  *)\n"
               . "    echo 'Usage: $SCRIPTNAME {start|stop|restart}'\n"
               . "    exit 1\n"
               . "    ;;\n"
               . "esac\n"
               ;

//Effacement et création d'un fichier vierge
//puis ouverture du fichier en écriture
$buffer=fopen($SCRIPTNAME,w);

//Ecriture des données
fwrite($buffer, $SCRIPTCONTENT);

//Activation du droit d'execution de ce script
`chmod +x $SCRIPTNAME`;

//echo "<br>";
//echo "<br>Script actualisé";

?>