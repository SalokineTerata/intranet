#!/bin/bash
#
# Script de construction de la base de données Intranet V3
#
# Author: franckwastaken - 28/10/2015
#
#

DB_NAME_TO_CREATE="intranet_v3_0_dev"
DB_NAME_V2_PRD="intranet_v2_0_prod_dev"
DB_NAME_MODEL="intranet_v3_0_model"
ENV_DEST="dev"
MYSQL_SERVER_NAME_DEST="dev-intranet.agis.fr"
MYSQL_USER_NAME_DEST="root"
MYSQL_USER_PASSWORD_DEST="8ale!ne"
URL_SERVER_NAME="dev-intranet.agis.fr"

echo "* Migration vers l'environnement DEV"
./apps/upgrade/upgrade2.0to3.0.sh $DB_NAME_TO_CREATE $DB_NAME_V2_PRD $DB_NAME_MODEL $ENV_DEST $MYSQL_SERVER_NAME_DEST $MYSQL_USER_NAME_DEST $MYSQL_USER_PASSWORD_DEST $URL_SERVER_NAME > ./log/upgrade2.0to3.0.log



