#!/bin/bash
#
# Script de construction de la base de données Intranet V3
#
# Author: franckwastaken - 28/10/2015
#
#

echo "* Migration vers l'environnement PRD"
./apps/upgrade/upgrade2.0to3.0.sh intranet_v3_0_prd intranet_v2_0_prod_prd intranet_v3_0_prd_SAVE prd



