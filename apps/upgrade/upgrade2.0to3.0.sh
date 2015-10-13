#!/bin/bash
#
# Script de construction de la base de données Intranet V3
#
# Author: bs4300280 - 05/10/2015
#
#

# VARIABLES
# ---------
DB_NAME_V3="intranet_v3_0_dev"
DB_USER_PRODV3="mysqladm"
DB_PASSWD_PRODV3="agis"

# CORPS
# -----

echo "*** Requêtes SQL:"
echo "  * CREATE TABLE intranet_v3_0_dev.classification_arborescence_article ..."

SQL_TXT="CREATE TABLE intranet_v3_0_dev.classification_arborescence_article LIKE intranet_v3_0_cod.classification_arborescence_article ;"
#echo $SQL_TXT | mysql --user=$DB_USER_PRODV3 --password=$DB_PASSWD_PRODV3 $DB_NAME_V3 


SQL_TXT="INSERT INTO intranet_v3_0_dev.classification_arborescence_article SELECT * FROM intranet_v2_0_prod.classification_arborescence_article ;"
echo $SQL_TXT | mysql --user=$DB_USER_PRODV3 --password=$DB_PASSWD_PRODV3 $DB_NAME_V3


