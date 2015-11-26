#!/bin/bash
#
# Script de construction de la base de données Intranet V3
#
# Author: franckwastaken - 28/10/2015
<<<<<<< HEAD
=======
# Modification:
#	25/11/2015 - bs4300280
>>>>>>> cc2b82b8d7481f9337cd6293b02a99992689a848
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
URL_SERVER_NAME="$8"

# CORPS
# -----

echo "*** Requêtes SQL:"
echo "  * Migration de l'intranet V2 vers V3 ayant comme BDD d'origine $DB_NAME_ORIG pour devenir DB_NAME_V3 grâce à $DB_NAME_STRUCTURE..."
php ./apps/upgrade/upgrade2.0to3.0_Part_1.php $DB_NAME_V3 $DB_NAME_ORIG $DB_NAME_STRUCTURE $MYSQL_SERVER_NAME_DEST $MYSQL_USER_NAME_DEST $MYSQL_USER_PASSWORD_DEST

lynx -dump -accept_all_cookies http://$URL_SERVER_NAME/v3/apps/fta/extraction_classification_$DB_ENVIRONNEMENT.php 

php ./apps/upgrade/upgrade2.0to3.0_Part_2.php $DB_NAME_V3 $DB_NAME_ORIG $DB_NAME_STRUCTURE $MYSQL_SERVER_NAME_DEST $MYSQL_USER_NAME_DEST $MYSQL_USER_PASSWORD_DEST
