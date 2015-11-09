#!/bin/bash
#
# Script d'importation de la base de données Intranet V2 vers V3
#
# Author: bs4300280 - 05/10/2015
#
#

echo "* Importation dans l'environnement COD"
cd /u1/DATA01/webldc/cod-intranet/v3/
./scripts/importDB-V2toV3.sh cod

