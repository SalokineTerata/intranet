#!/bin/bash
#
# Script de construction de la base de données Intranet V3
#
# Author: franckwastaken - 28/10/2015
#
#

DB_NAME_TO_CREATE="intranet_v3_0_cod"
DB_NAME_V2_PRD="intranet_v2_0_prod_cod"
DB_NAME_MODEL="intranet_v3_0_model"
ENV_DEST="cod"
MYSQL_SERVER_NAME_DEST="cod-intranet.agis.fr"
MYSQL_USER_NAME_DEST="root"
MYSQL_USER_PASSWORD_DEST="8ale!ne"
ID_FTA_WORKFLOW="5"

echo "* Migration vers l'environnement COD"
./apps/upgrade/upgrade2_CoupeFE.sh $DB_NAME_TO_CREATE $DB_NAME_V2_PRD $DB_NAME_MODEL $ENV_DEST $MYSQL_SERVER_NAME_DEST $MYSQL_USER_NAME_DEST $MYSQL_USER_PASSWORD_DEST $ID_FTA_WORKFLOW



