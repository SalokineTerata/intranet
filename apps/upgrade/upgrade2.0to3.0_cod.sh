#!/bin/bash
#
# Script de construction de la base de données Intranet V3
#
# Author: franckwastaken - 28/10/2015
#
#

echo "* Migration vers l'environnement COD"
./apps/upgrade/upgrade2.0to3.0.sh intranet_v3_0_cod intranet_v2_0_prod_cod intranet_v3_0_dev_model cod



