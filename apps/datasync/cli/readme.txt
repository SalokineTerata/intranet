Contient des scripts PHP autonome qui s'execute directement depuis le système en ligne de commande
CLI signifie Command Line Interface

Ce répertoire n'est pas accessible depuis le service HTTP (cf .htaccess)

[datasync.sh]

le fichier datasync.sh lance le fichier "../index.php" pour actualiser le script de recopie intersite "netcopy.sh"
puis exécute ce script "netcopy.sh"

il est lancé par le programmateur cron via le fichier /etc/crontab
