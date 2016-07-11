#!/bin/sh
#
# Script d'actualisation des données des Fta par Arcadia
#
# Author: franckwastaken - 07/07/2016
# MAJ franckwastaken - 11/07/2016
#

CHEMIN_OLD="$(dirname $0)"
CHEMIN="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/$(basename "${BASH_SOURCE[0]}")"
DIR_COD_ROOT="/u1/DATA01/webldc/cod-intranet/v3/apps/upgrade/upgrade2_Fta2Arcadia.sh"
DIR_DEV_ROOT="/u1/DATA01/webldc/dev-intranet/v3/apps/upgrade/upgrade2_Fta2Arcadia.sh"
DIR_PRD_ROOT="/u1/DATA01/webldc/fta05401/v3/apps/upgrade/upgrade2_Fta2Arcadia.sh"
DIR_COP_ROOT="/u1/DATA01/webldc/cop-fta05401/v3/apps/upgrade/upgrade2_Fta2Arcadia.sh"

case $CHEMIN in

  $DIR_COD_ROOT)
  bash -x apps/upgrade/upgrade2_Fta2Arcadia_data_cod.sh
 ;;
  $DIR_DEV_ROOT)
  bash -x apps/upgrade/upgrade2_Fta2Arcadia_data_dev.sh
 ;;
  $DIR_PRD_ROOT)
 bash -x apps/upgrade/upgrade2_Fta2Arcadia_data_prd.sh
 ;;
$DIR_COP_ROOT)
  bash -x apps/upgrade/upgrade2_Fta2Arcadia_data_cop.sh
 ;;

esac