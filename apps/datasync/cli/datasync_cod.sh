#!/bin/sh
CHEMIN="$(dirname $0)"
MAILTO="InformatiqueSupport.Avignon@agis-sa.fr"
#MAIL=/tmp/save.mail.tmp
#LOG_ARCHIVE_FILE=/u1/Admin/Log/datasync`date +%m-%d`.log
LOG_ARCHIVE_DIR="/u1/DATA01/webldc/cod-intranet/v3/apps/datasync/data"
LOG_ARCHIVE_FILE="$LOG_ARCHIVE_DIR/datasync`date +%m-%d`.log"
MAIL="$LOG_ARCHIVE_DIR/mail.tmp.txt"
TYPE=$1
ENV=".cod"
DEBUG=1


#Génération du fichier de synchronisation dans l'environnment codeur


case $TYPE in
  -d | -w | -v )
	#LOG="/data/var/www/system/log/datasync$ENV.log"
	LOG="$LOG_ARCHIVE_DIR/datasync$ENV.log"
	>$LOG
	>$MAIL
	>$LOG_ARCHIVE_FILE
	
  	#Génération et mise à jour des scripts utilis�s
	echo -n "Démarrage : " >> $MAIL
	date >> $MAIL
	lynx -dump cod-intranet.agis.fr/v3/apps/datasync/index.php?mode=$TYPE&env=Codeur >> $LOG
	
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
	echo "  -v  database virus copy"
    ;;
esac

