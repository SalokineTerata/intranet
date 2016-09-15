#!/bin/bash
#
# Script de construction de la base de données Intranet V3
#
# Author: franckwastaken - 28/10/2015
#
#
# VARIABLES (garder l'ordre du script d'appel !
# ---------------------------------------------
DB_NAME_TO_CREATE="intranet_v3_0_prd"
DB_NAME_V2_PRD="intranet_v2_0_prod_prd"
DB_NAME_MODEL="intranet_v3_0_model"
ENV_DEST="prd"
MYSQL_SERVER_NAME_DEST="127.0.0.1"
MYSQL_USER_NAME_DEST="mysqladm"
MYSQL_USER_PASSWORD_DEST="agis"
ID_FTA_WORKFLOW="8"


echo "* Migration vers l'environnement PRD"
./apps/upgrade/upgrade2_CoupeFE.sh $DB_NAME_TO_CREATE $DB_NAME_V2_PRD $DB_NAME_MODEL $ENV_DEST $MYSQL_SERVER_NAME_DEST $MYSQL_USER_NAME_DEST $MYSQL_USER_PASSWORD_DEST $ID_FTA_WORKFLOW

