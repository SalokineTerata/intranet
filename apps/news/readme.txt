Modèle de Module pour le site Intranet

Ce répertoire template contient la structure par défaut qu'il faut utiliser pour créer ou mettre à jour un module Intranet

Pour créer un nouveau module, recopier template en lui donnant le nom du module
Exemple depuis la ligne de commande du système:
cp -R /home/www/intranet.dev/template /home/www/intranet.dev/nouveau_module

Ensuite déclarez ce nouveau module au niveau de MySQL dans la table intranet_modules:
Pour un module du site intranet utilisez la base agis
Pour un module du site intranet.dev utilisez la base agis_dev
Enregistrez les informations du module dans la table intranet_module

Explication du contenu du répertoire:
archives/      Contient les vieux fichiers que vous souhaitez tout de même garder
cli/           Contient les fichiers dédiés à être exécuté en ligne de commande
data/          Données du module sous forme de fichiers (ex: .pdf, .txt, .cvs...)
doc/           Contient la documentation utilisateur du module
images/        banque d'images limitée au module

Explication des fichiers:
index.php           Page de démarrage du module
functions.php       Libraire de fonctions PHP propres au module
functions.js        Libraire de fonctions JavaScript propres au module. Le JavaScript doit être utiliser quand extrème recours
action.php          Page exécuté après chaque page PHP. Il exécute les actions demandées puis redirige
menu_principal.inc  Menu de liens apparaisant sur les pages PHP du module
php.map             Cartographie des relations entres les pages php du module
sql.map             Cartographie des relations entres les tables MySQL du module
readme.txt          Ce fichier !!!
release-x.x.txt     Description des modifications réalisées et restant à réaliser
online-x.x.txt      Historique des modifications techniques à réaliser lors de la migration vers le site d'exploitation
template.php        Doit être utilisé comme modèle pour créer d'autres pages PHP

