#!/bin/sh
CHEMIN="$(dirname $0)"
DIR_COD_ROOT="/u1/DATA01/webldc/cod-intranet/v3/"
DIR_COD_CLI=$DIR_COD_ROOT"apps/datasync/cli"
DIR_DEV_ROOT="/u1/DATA01/webldc/dev-intranet/v3/"
DIR_DEV_CLI=$DIR_DEV_ROOT"apps/datasync/cli"
DIR_PRD_ROOT="/u1/DATA01/webldc/fta05401/v3/"
DIR_PRD_CLI=$DIR_PRD_ROOT"apps/datasync/cli"
MAILTO="Informatique.AGIS@agis-sa.fr"
#MAIL=/tmp/save.mail.tmp
#LOG_ARCHIVE_FILE=/u1/Admin/Log/datasync`date +%m-%d`.log
TYPE=$1
DEBUG=1

case $CHEMIN in

  $DIR_COD_CLI)
    ENV="COD"
    LOG_ARCHIVE_DIR=$DIR_COD_ROOT"apps/datasync/data"
    DIR_ENV_DATASYNC = $DIR_COD_ROOT"/apps/datasync"
 ;;
  $DIR_DEV_CLI)
    ENV="DEV"
    LOG_ARCHIVE_DIR=$DIR_DEV_ROOT"apps/datasync/data"
    DIR_ENV_DATASYNC = $DIR_DEV_ROOT"/apps/datasync"
 ;;
  $DIR_PRD_CLI)
    ENV="PRD"
    LOG_ARCHIVE_DIR=$DIR_PRD_ROOT"apps/datasync/data"
    DIR_ENV_DATASYNC = $DIR_PRD_ROOT"/apps/datasync"
 ;;

esac

MAIL="$LOG_ARCHIVE_DIR/mail.tmp.txt"
LOG_ARCHIVE_FILE="$LOG_ARCHIVE_DIR/datasync`date +%m-%d`.log"

#Génération du fichier de synchronisation dans l'environnment codeur


case $TYPE in
  -d | -w )
	#LOG="/data/var/www/system/log/datasync.log"
	LOG="$LOG_ARCHIVE_DIR/datasync.log"
	>$LOG
	>$MAIL
	>$LOG_ARCHIVE_FILE
	
  	#Génération et mise à jour des scripts utilis�s
	echo -n "Démarrage : " >> $MAIL
	date >> $MAIL
	php $DIR_ENV_DATASYNC/index.php $TYPE $ENV  >> $LOG
	
#	if [ $DEBUG = 1 ] ; then
#	  $CHEMIN/netcopy.sh
#	else
#	  $CHEMIN/netcopy.sh >> $LOG
#	fi
#	echo -n "Arrét     : " >> $MAIL
#	date >> $MAIL

	# RAPPORT DE SAUVEGARDE
	# ---------------------
	cat $MAIL $LOG >> $LOG_ARCHIVE_FILE
	cat $LOG | uuencode rapport.log | tee -a $MAIL
	cat $MAIL | mail -s "[`hostname`]: Rapport Intranet/DataSync ($TYPE)" $MAILTO
    ;;


  *)
    	echo "Usage: $0 [OPTIONS]"
	echo "  OPTIONS LIST:"
	echo "  -d  daily network copy"
	echo "  -w  weekly network copy"
	
    ;;
esac



