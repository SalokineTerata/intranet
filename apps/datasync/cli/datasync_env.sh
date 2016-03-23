#!/bin/sh
CHEMIN="$(dirname $0)"
MAILTO="InformatiqueSupport.Avignon@agis-sa.fr"
#MAIL=/tmp/save.mail.tmp
#LOG_ARCHIVE_FILE=/u1/Admin/Log/datasync`date +%m-%d`.log
LOG_ARCHIVE_DIR="/u1/DATA01/www/intranet/datasync/data"
LOG_ARCHIVE_FILE="$LOG_ARCHIVE_DIR/datasync`date +%m-%d`.log"
MAIL="$LOG_ARCHIVE_DIR/mail.tmp.txt"
DEBUG=1


#Recherche pour savoir si on est dans "intranet" ou "intranet.dev"
case "$CHEMIN" in *intranet.dev*) SITE=".dev" ;; esac

case $1 in
  -d | -w | -v )
	#LOG="/data/var/www/system/log/datasync$SITE.log"
	LOG="$LOG_ARCHIVE_DIR/datasync$SITE.log"
	>$LOG
	>$MAIL
	>$LOG_ARCHIVE_FILE
	
  	#G�n�ration et mise � jour des scripts utilis�s
	echo -n "D�marrage : " >> $MAIL
	date >> $MAIL
	lynx -dump intranet$SITE.agis.fr/datasync/index.php?mode=$1 >> $LOG
	
	if [ $DEBUG = 1 ] ; then
	  $CHEMIN/netcopy.sh
	else
	  $CHEMIN/netcopy.sh >> $LOG
	fi
	echo -n "Arr�t     : " >> $MAIL
	date >> $MAIL

	# RAPPORT DE SAUVEGARDE
	# ---------------------
	cat $MAIL $LOG >> $LOG_ARCHIVE_FILE
	cat $LOG | uuencode rapport.log | tee -a $MAIL
	cat $MAIL | mail -s "[`hostname`]: Rapport Intranet/DataSync ($1)" $MAILTO
    ;;


  *)
    	echo "Usage: $0 [OPTIONS]"
	echo "  OPTIONS LIST:"
	echo "  -d  daily network copy"
	echo "  -w  weekly network copy"
	echo "  -v  database virus copy"
    ;;
esac

