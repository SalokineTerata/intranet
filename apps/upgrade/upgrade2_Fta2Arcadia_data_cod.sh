#!/bin/bash
#
#
# Author: franckwastaken - 07/07/2016
#
#

DB_NAME_TO_CREATE="intranet_v3_0_cod"
MYSQL_SERVER_NAME_DEST="cod-intranet.agis.fr"
MYSQL_USER_NAME_DEST="root"
MYSQL_USER_PASSWORD_DEST="8ale!ne"
DIR_EAI="../../eai/export"

./apps/upgrade/upgrade2_Fta2Arcadia_data.sh $DB_NAME_TO_CREATE  $MYSQL_SERVER_NAME_DEST $MYSQL_USER_NAME_DEST $MYSQL_USER_PASSWORD_DEST $URL_SERVER_NAME 



