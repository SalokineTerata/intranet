#!/bin/bash
#
# Script de construction de la base de données Intranet V3
#
# Author: franckwastaken - 28/10/2015
#
#

# VARIABLES
# ---------
DB_NAME_V3="$1"
DB_NAME_ORIG="$2"
DB_NAME_STRUCTURE="$3"
DB_ENVIRONNEMENT="$4"

# CORPS
# -----

echo "*** Requêtes SQL:"
echo "  * Migration de l'intranet V2 vers V3 ayant comme BDD d'origine $DB_NAME_ORIG pour devenir DB_NAME_V3 grâce à $DB_NAME_STRUCTURE..."
php ./apps/upgrade/upgrade2.0to3.0_Part_1.php $DB_NAME_V3 $DB_NAME_ORIG $DB_NAME_STRUCTURE

lynx $DB_ENVIRONNEMENT/v3/apps/fta/extraction_classification.php 


php ./apps/upgrade/upgrade2.0to3.0_Part_2.php $DB_NAME_V3 $DB_NAME_ORIG $DB_NAME_STRUCTURE
