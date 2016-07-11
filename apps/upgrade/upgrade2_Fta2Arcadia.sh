#!/bin/sh
#
# Script d'actualisation des données des Fta par Arcadia
#
# Author: franckwastaken - 07/07/2016
#
#

CHEMIN="$(dirname $0)"
DIR_COD_ROOT="/u1/DATA01/webldc/cod-intranet/v3/apps/upgrade/"
DIR_DEV_ROOT="/u1/DATA01/webldc/dev-intranet/v3/apps/upgrade/"
DIR_PRD_ROOT="/u1/DATA01/webldc/fta05401/v3/apps/upgrade/"
DIR_COP_ROOT="/u1/DATA01/webldc/cop-fta05401/v3/apps/upgrade/"

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