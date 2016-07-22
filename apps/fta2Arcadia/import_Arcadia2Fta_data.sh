#!/bin/bash
#
# Script d'actualisation des données des Fta par Arcadia
#
# Author: franckwastaken - 07/07/2016
# MAJ franckwastaken - 21/07/2016
#

# VARIABLES (garder l'ordre du script d'appel !
# ---------------------------------------------
DB_NAME_V3="$1"
MYSQL_SERVER_NAME_DEST="$2"
MYSQL_USER_NAME_DEST="$3"
MYSQL_USER_PASSWORD_DEST="$4"
DIR_EAI="$5"
DIR_EAI_OK="$6"
DIR="$7"

# CORPS
# -----

echo "*** Requêtes SQL:"
echo "  * Actualisation des Fta de la base de données DB_NAME_V3 "
php $DIRapps/fta2Arcadia/import_Arcadia2Fta_data.php $DB_NAME_V3  $MYSQL_SERVER_NAME_DEST $MYSQL_USER_NAME_DEST $MYSQL_USER_PASSWORD_DEST $DIR_EAI $DIR_EAI_OK $DIR

