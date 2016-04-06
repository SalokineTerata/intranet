#!/bin/sh
# Script de synchronisation des données intranet
#
# Author: franckwastaken - 22/03/2016
#
TYPE="$1"


php ./apps/datasync/datasync_env.php $TYPE


