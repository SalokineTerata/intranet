#!/bin/sh
#
# Script d'actualisation des données des Fta par Arcadia
#
# Author: franckwastaken - 07/07/2016
# MAJ franckwastaken - 11/07/2016
# MAJ franckwastaken - 21/07/2016

CHEMIN_OLD="$(dirname $0)"
CHEMIN="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/$(basename "${BASH_SOURCE[0]}")"
DIR_COD="/u1/DATA01/webldc/cod-intranet/v3/"
DIR_COD_ROOT=$DIR_COD"apps/fta2Arcadia/import_Arcadia2Fta.sh"
DIR_DEV="/u1/DATA01/webldc/dev-intranet/v3/"
DIR_DEV_ROOT=$DIR_DEV"apps/fta2Arcadia/import_Arcadia2Fta.sh"
DIR_PRD="/u1/DATA01/webldc/fta05401/v3/"
DIR_PRD_ROOT=$DIR_PRD"apps/fta2Arcadia/import_Arcadia2Fta.sh"
DIR_COP="/u1/DATA01/webldc/cop-fta05401/v3/"
DIR_COP_ROOT=$DIR_COP"apps/fta2Arcadia/import_Arcadia2Fta.sh"

case $CHEMIN in

  $DIR_COD_ROOT)
  bash -x $DIR_COD_ROOTDapps/fta2Arcadia/import_Arcadia2Fta_data_cod.sh $DIR_COD
 ;;
  $DIR_DEV_ROOT)
  bash -x $DIR_DEV_ROOTapps/fta2Arcadia/import_Arcadia2Fta_data_dev.sh $DIR_DEV
 ;;
  $DIR_PRD_ROOT)
 bash -x $DIR_PRD_ROOTapps/fta2Arcadia/import_Arcadia2Fta_data_prd.sh $DIR_PRD
 ;;
$DIR_COP_ROOT)
  bash -x $DIR_COP_ROOTapps/fta2Arcadia/import_Arcadia2Fta_data_cop.sh $DIR_COP
 ;;

esac