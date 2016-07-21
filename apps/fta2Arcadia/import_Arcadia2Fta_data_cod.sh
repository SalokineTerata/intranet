#!/bin/bash
#
#
# Author: franckwastaken - 07/07/2016
# MAJ franckwastaken - 11/07/2016
# MAJ franckwastaken - 21/07/2016
# VARIABLES (garder l'ordre du script d'appel !
# ---------------------------------------------
DB_NAME_TO_CREATE="intranet_v3_0_cod"
MYSQL_SERVER_NAME_DEST="cod-intranet.agis.fr"
MYSQL_USER_NAME_DEST="root"
MYSQL_USER_PASSWORD_DEST="8ale!ne"
DIR_EAI="../../eai/import/data/"
DIR_EAI_OK="../../eai/import/ok/"


./apps/fta2Arcadia/import_Arcadia2Fta.sh $DB_NAME_TO_CREATE $MYSQL_SERVER_NAME_DEST $MYSQL_USER_NAME_DEST $MYSQL_USER_PASSWORD_DEST $DIR_EAI


