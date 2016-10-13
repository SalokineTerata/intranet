#!/bin/sh
#
# Fichier de configuration des script shell.
# Utilisez la commande "source" pour inclure ce fichier.
#    --> Exemple: source $(dirname $0)/../../config.sh
# Toutes les variables doivent être préfixées GC_ (pour Global Config)
# Author: Boris Sanère - 14/09/2016
#

# Système de fichier V3
GC_DIR_COD="/u1/DATA01/webldc/cod-fta05401/v3"
GC_DIR_DEV="/u1/DATA01/webldc/dev-fta05401/v3"
GC_DIR_PRD="/u1/DATA01/webldc/fta05401/v3"
GC_DIR_COP="/u1/DATA01/webldc/cop-fta05401/v3"

# Système de fichier EAI
GC_SUBDIR_EAI_EXPORT_DATA="eai/export/data"
GC_SUBDIR_EAI_EXPORT_OK="eai/export/ok"
GC_SUBDIR_EAI_IMPORT_DATA="eai/import/data"
GC_SUBDIR_EAI_IMPORT_OK="eai/import/ok"

#Environnement
GC_ENV_SHORTNAME_COD="cod"
GC_ENV_SHORTNAME_DEV="dev"
GC_ENV_SHORTNAME_PRD="prd"
GC_ENV_SHORTNAME_COP="cop"

#Base de données
GC_DBNAME_COD="cod-fta05401"
GC_DBNAME_DEV="dev-fta05401"
GC_DBNAME_PRD="intranet_v3_0_prd"
GC_DBNAME_COP="cop-fta05401"

#Serveur de base de données
GC_DBSRVNAME_COD="127.0.0.1"
GC_DBSRVNAME_DEV="127.0.0.1"
GC_DBSRVNAME_PRD="127.0.0.1"
GC_DBSRVNAME_COP="127.0.0.1"

#Utilisateur de base de données
GC_DBUSRNAME_COD="root"
GC_DBUSRNAME_DEV="dev-fta05401"
GC_DBUSRNAME_PRD="mysqladm"
GC_DBUSRNAME_COP="cop-fta05401"

#Mot de passe de base de données
GC_DBUSRPASS_COD=""
GC_DBUSRPASS_DEV="cbeH3qqb"
GC_DBUSRPASS_PRD="agis"
GC_DBUSRPASS_COP="tb57Febx"

