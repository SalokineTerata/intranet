#!/bin/bash
#
# Script d'importation de la base de données Intranet V2 vers V3
#
# Author: bs4300280 - 05/10/2015
#
#

# VARIABLES
# ---------

ENV_DEST="$1"

DB_NAME="agis"
DB_USER_PRODV2="lecture_seule"
DB_PASSWD_PRODV2="agis"

DB_NAME_V3="intranet_v2_0_prod_$ENV_DEST"
DB_USER_PRODV3="mysqladm"
DB_PASSWD_PRODV3="agis"

SRV_PRODV2="intranet.agis.fr"
SRV_ARCH="admin.agis.fr"

ARCH_DIR="/u1/DATA01/archives/SAVE"
CHARSET_ORIG="WINDOWS-1252"
CHARSET_DEST="UTF-8"
EXPORT_FILE="export$DB_NAME"
EXPORT_FILE_CONV="$EXPORT_FILE-$CHARSET_DEST"

SERVER_DEST="$ENV_DEST-intranet.agis.fr"
DIR_DEST="/tmp"

# EXPORTATION
# -----------

echo "* Récupération du dump MySQL"
ssh -n $SRV_PRODV2 -- mysqldump -a --add-drop-table -v --quote-names --user=$DB_USER_PRODV2 --password=$DB_PASSWD_PRODV2 $DB_NAME > $DIR_DEST/$EXPORT_FILE.sql

echo "* Archivage du Dump brut"
rsync -Phavz $DIR_DEST/$EXPORT_FILE.sql $SRV_ARCH:$ARCH_DIR/$EXPORT_FILE.sql

echo "* Conversion charset"
iconv -f $CHARSET_ORIG -t $CHARSET_DEST $DIR_DEST/$EXPORT_FILE.sql -o $DIR_DEST/$EXPORT_FILE_CONV.sql

echo "* Correction Engine"
sed -i -e "s/TYPE=MyISAM/ENGINE=MyISAM/g" $DIR_DEST/$EXPORT_FILE_CONV.sql

echo "* Correction Timestamp"
sed -i -e "s/timestamp(14)/timestamp/g" $DIR_DEST/$EXPORT_FILE_CONV.sql

echo "* Importation des données dans le serveur de base de données local"
mysql --user=$DB_USER_PRODV3 --password=$DB_PASSWD_PRODV3 $DB_NAME_V3 < $DIR_DEST/$EXPORT_FILE_CONV.sql


