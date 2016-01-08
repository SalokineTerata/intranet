#!/bin/bash
#
# Script de construction de la base de données Intranet V3
#
# Author: franckwastaken - 28/10/2015
# Modification:
#	25/11/2015 - bs4300280
#
#

# VARIABLES (garder l'ordre du script d'appel !
# ---------------------------------------------
DB_NAME_V3="$1"
DB_NAME_ORIG="$2"
DB_NAME_STRUCTURE="$3"
DB_ENVIRONNEMENT="$4"
MYSQL_SERVER_NAME_DEST="$5"
MYSQL_USER_NAME_DEST="$6"
MYSQL_USER_PASSWORD_DEST="$7"

# CORPS
# -----

echo "*** Requêtes SQL:"
php ./apps/upgrade/upgrade2_CoupeFe.php $DB_NAME_V3 $DB_NAME_ORIG $DB_NAME_STRUCTURE $MYSQL_SERVER_NAME_DEST $MYSQL_USER_NAME_DEST $MYSQL_USER_PASSWORD_DEST


