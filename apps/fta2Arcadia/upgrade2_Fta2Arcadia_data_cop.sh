#!/bin/bash
#
#
# Author: franckwastaken - 07/07/2016
# MAJ franckwastaken - 11/07/2016
#
# VARIABLES (garder l'ordre du script d'appel !
# ---------------------------------------------
DB_NAME_TO_CREATE="cop-fta05401"
MYSQL_SERVER_NAME_DEST="cop-fta05401"
MYSQL_USER_NAME_DEST="cop-fta05401"
MYSQL_USER_PASSWORD_DEST="tb57Febx"
DIR_EAI="./u1/DATA01/eai/intranet-cop/import/data/"


./apps/fta2Arcadia/upgrade2_Fta2Arcadia_data.sh $DB_NAME_TO_CREATE $MYSQL_SERVER_NAME_DEST $MYSQL_USER_NAME_DEST $MYSQL_USER_PASSWORD_DEST $DIR_EAI



