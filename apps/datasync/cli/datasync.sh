#!/bin/sh
CHEMIN="$(dirname $0)"
COD="/u1/DATA01/webldc/cod-intranet/v3/apps/datasync/cli"
DEV="/u1/DATA01/webldc/dev-intranet/v3/apps/datasync/cli"
PRD="/u1/DATA01/webldc/fta05401/v3/apps/datasync/cli"
MAILTO="Informatique.AGIS@agis-sa.fr"
#MAIL=/tmp/save.mail.tmp
#LOG_ARCHIVE_FILE=/u1/Admin/Log/datasync`date +%m-%d`.log
TYPE=$1
DEBUG=1

case $CHEMIN in

  $COD)
    ENV="COD"
    LOG_ARCHIVE_DIR="/u1/DATA01/webldc/cod-intranet/v3/apps/datasync/data"

 ;;
  $DEV)
    ENV="DEV"
    LOG_ARCHIVE_DIR="/u1/DATA01/webldc/dev-intranet/v3/apps/datasync/data"
 ;;
  $PRD)
    ENV="PRD"
    LOG_ARCHIVE_DIR="/u1/DATA01/webldc/fta05401/v3/apps/datasync/data"
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
	php ./apps/datasync/index.php $TYPE $ENV  >> $LOG
	
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



