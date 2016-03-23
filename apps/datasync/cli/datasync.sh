#!/bin/sh
# Script de synchronisation des données intranet
#
# Author: franckwastaken - 22/03/2016
#
TYPE="$1"


php ./apps/upgrade/datasynch_env.php $TYPE


