signification des noms (déduction SM)
------------------------------------
05 = COUPE
08 = LS
17 = COUPE FESTIVE

C = indépendant ???
H = hypermarche
S = supermarche
ES = entrepot Super
EH = entrepot Hyper


nom des fichiers reçus
----------------------
PPV_20060101_AGIS_29741-05_C.xls	= 	
PPV_20060101_AGIS_29741-08_H.xls	=
PPV_20060101_AGIS_29741-17_S.xls	=	
PPV_20060101_AGIS_29741_ES.xls	= l'onglet des fichiers est du type Agis_29741_mois_SS


IMPORTATION DES FICHIERS (utilisation du fichier excel agis_avignon.xla)
------------------------------------------------------------------------
- pour les fichiers 05 08 17 / C H S 	= utiliser le module 9

- pour les fichiers ES  		= utiliser le module 10

- pour les fichiers EH			= utiliser le module 11


CONTROLE DE COHERENCE DES CLIENTS
----------------------------------
pour l'importation des magasins Carrefour provenant des stat ENTREPOTS : utilisation du ficher xxx_EH (transfert dans la table des magasins)
	- récupération du nom de la région ex CELLULE AIX / N° de magasin (auquel il faut rajouter 4000000000000 pour recréer un pseudo ean13LFD)
	- renseignement du code agrologic + code postal (le code postal mis pour le magasin sera celui d'un département du chef de secteur en question)




EDITIONS DEMANDEES
------------------
[v] 1 - comparer le mois M avec M-1 pour ne ressortir que les références absentes par rapport à M-1
[v] 1bis - idem 1 mais avec une comparaison par rapport à la mercuriale (pour obtenir la mercuriale sortir une stat Agrologic Entrepot/Article Carrefour / Champion)
[v] 2 - Entrepot / Magasin / Article / CA / Qté
[v] 2bis - idem 2 sans notion d'article trier par CA décroissant : Entrepot / Magasin
[v] 3 - DN avoir par entrepot le nb de magasin commandant une référence donnée
		pour avoir une DN juste sur le libre service il faut renseigner le nb de mag qui sont concernés (table nombre_magasin_entrepot)
[v] 3bis - DN avoir par centrale le nb de magasin commandant une référence donnée

[v] faire une requete qui controle que tous les magasins présents dans la table data_sharing sont aussi dans la table table_des_magasins si déphasage il faut importer un nouveau fichier du portail