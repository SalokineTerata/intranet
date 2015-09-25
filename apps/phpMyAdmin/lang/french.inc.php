<?php
/* $Id: french.inc.php,v 1.138 2002/04/03 18:37:05 lem9 Exp $ */

$charset = 'iso-8859-1';
$text_dir = 'ltr';
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = ' ';
$number_decimal_separator = ',';
$byteUnits = array('Octets', 'Ko', 'Mo', 'Go');

$day_of_week = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
$month = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
// Voir http://www.php.net/manual/en/function.strftime.php pour la variable
// ci-dessous
$datefmt = '%A %d %B %Y à %H:%M';


$strAccessDenied = 'Accès refusé';
$strAction = 'Action';
$strAddDeleteColumn = 'Ajouter/effacer x colonne(s)';
$strAddDeleteRow = 'Ajouter/effacer x ligne(s)';
$strAddNewField = 'Ajouter un champ';
$strAddPriv = 'Ajouter un privilège';
$strAddPrivMessage = 'Vous avez ajouté un privilège';
$strAddSearchConditions = 'Critères de recherche (pour l\'énoncé "where"):';
$strAddToIndex = 'Ajouter à la clef&nbsp;%s&nbsp;colonne(s)';
$strAddUser = 'Ajouter un utilisateur';
$strAddUserMessage = 'Vous avez ajouté un utilisateur';
$strAffectedRows = 'Nombre d\'enregistrements affectés :';
$strAfter = 'Après %s';
$strAfterInsertBack = 'Retourner à la page précédente';
$strAfterInsertNewInsert = 'Insérer un nouvel enregistrement';
$strAll = 'Tout';
$strAlterOrderBy = '<b>Ordonner</b> la table par';
$strAnalyzeTable = 'Analyser la table';
$strAnd = 'et';
$strAnIndex = 'Un index a été ajouté sur %s';
$strAny = 'N\'importe quel';
$strAnyColumn = 'Toute colonne';
$strAnyDatabase = 'Toute base de données';
$strAnyHost = 'Tout serveur';
$strAnyTable = 'Toute table';
$strAnyUser = 'Tout utilisateur';
$strAPrimaryKey = 'Une clé primaire a été ajoutée sur %s';
$strAscending = 'Croissant';
$strAtBeginningOfTable = 'En début de Table';
$strAtEndOfTable = 'En fin de Table';
$strAttr = 'Attributs';

$strBack = 'Retour';
$strBinary = 'Binaire';
$strBinaryDoNotEdit = 'Binaire - ne pas éditer';
$strBookmarkDeleted = 'Le bookmark a été effacé.';
$strBookmarkLabel = 'Intitulé';
$strBookmarkQuery = 'Requêtes bookmarkées';
$strBookmarkThis = 'Bookmarker cette requête';
$strBookmarkView = 'Voir uniquement';
$strBrowse = 'Afficher';
$strBzip = '"bzippé"';

$strCantLoadMySQL = 'ne peux charger l\'extension MySQL,<br />vérifiez la configuration PHP';
$strCantRenameIdxToPrimary = 'La clef ne peut être renommée PRIMARY&nbsp;!';
$strCardinality = 'Cardinalité';
$strCarriage = 'Retour de chariot : \\r';
$strChange = 'Modifier';
$strChangePassword = 'Modifier le mot de passe';
$strCheckAll = 'Tout cocher';
$strCheckDbPriv = 'Afficher les privilèges sur';
$strCheckTable = 'Vérifier la table';
$strColumn = 'Colonne';
$strColumnNames = 'Nom des colonnes';
$strCompleteInserts = 'Insertions complètes';
$strConfirm = 'Veuillez confirmer';
$strCookiesRequired = 'Vous devez accepter les cookies pour poursuivre.';
$strCopyTable = '<b>Copier</b> la table vers (base<b>.</b>table)&nbsp;:';
$strCopyTableOK = 'La table %s a été copiée vers %s.';
$strCreate = 'Créer';
$strCreateIndex = 'Créer une clef sur&nbsp;%s&nbsp;colonne(s)';
$strCreateIndexTopic = 'Créer un nouvelle clef';
$strCreateNewDatabase = 'Créer une base de données';
$strCreateNewTable = 'Créer une nouvelle table sur la base %s';
$strCriteria = 'Critère';

$strData = 'Données';
$strDatabase = 'Base de données';
$strDatabaseHasBeenDropped = 'La base de données %s a été effacée.';
$strDatabases = 'bases de données';
$strDatabasesStats = 'Statistiques sur les bases de données';
$strDatabaseWildcard = 'Base de données (passepartout autorisé):';
$strDataOnly = 'Données seulement';
$strDefault = 'Défaut';
$strDelete = 'Effacer';
$strDeleted = 'L\'enregistrement a été effacé';
$strDeletedRows = 'Nombre d\'enregistrements effacés :';
$strDeleteFailed = 'L\'effacement a échoué';
$strDeleteUserMessage = 'Vous avez effacé l\'utilisateur %s.';
$strDescending = 'Décroissant';
$strDisplay = 'Montrer';
$strDisplayOrder = 'Ordre d\'affichage :';
$strDoAQuery = 'Recherche par valeur (passepartout: "%")';
$strDocu = 'Documentation';
$strDoYouReally = 'Voulez-vous vraiment effectuer ';
$strDrop = 'Supprimer';
$strDropDB = 'Supprimer la base %s';
$strDropTable = 'Supprimer la table';
$strDumpingData = 'Contenu de la table';
$strDynamic = 'dynamique';

$strEdit = 'Modifier';
$strEditPrivileges = 'Changer les privilèges';
$strEffective = 'effectif';
$strEmpty = 'Vider';
$strEmptyResultSet = 'MySQL n\'a retourné aucun enregistrement.';
$strEnd = 'Fin';
$strEnglishPrivileges = ' Veuillez noter que les noms de privilèges sont exprimés en anglais';
$strError = 'Erreur';
$strExtendedInserts = 'Insertions étendues';
$strExtra = 'Extra';

$strField = 'Champ';
$strFieldHasBeenDropped = 'Le champ %s a été effacé';
$strFields = 'Champs';
$strFieldsEmpty = 'Il faut indiquer le nombre de champs';
$strFieldsEnclosedBy = 'Champs entourés par';
$strFieldsEscapedBy = 'Caractère spécial';
$strFieldsTerminatedBy = 'Champs terminés par';
$strFixed = 'fixe';
$strFlushTable = 'Recharger la table ("FLUSH")';
$strFormat = 'format';
$strFormEmpty = 'Formulaire incomplet !';
$strFullText = 'Textes complets';
$strFunction = 'Fonction';

$strGenTime = 'Généré le ';
$strGo = 'Exécuter';
$strGrants = 'Autres privilèges';
$strGzip = '"gzippé"';

$strHasBeenAltered = 'a été modifié(e).';
$strHasBeenCreated = 'a été créé(e).';
$strHome = 'Accueil';
$strHomepageOfficial = 'Site officiel de phpMyAdmin';
$strHomepageSourceforge = 'Page de Téléchargement phpMyAdmin sur Sourceforge';
$strHost = 'Serveur';
$strHostEmpty = 'Le nom de serveur est vide';

$strIdxFulltext = 'Texte entier';
$strIfYouWish = 'Si vous désirez ne charger que certaines colonnes, indiquez leurs noms, séparés par des virgules.';
$strIgnore = 'Ignorer';
$strIndex = 'Index';
$strIndexes = 'Index';
$strIndexHasBeenDropped = 'L\'index %s a été effacé';
$strIndexName = 'Nom de la clef&nbsp;:';
$strIndexType = 'Type de clef&nbsp;:';
$strInsert = 'Insérer';
$strInsertAsNewRow = 'Insérer en tant que nouvel enregistrement';
$strInsertedRows = 'Nombre d\'enregistrements insérés :';
$strInsertNewRow = 'Insérer un nouvel enregistrement';
$strInsertTextfiles = 'Insérer des données provenant d\'un fichier texte dans la table';
$strInstructions = 'Instructions';
$strInUse = 'utilisé';
$strInvalidName = '"%s" est un mot réservé, il ne peut être utilisé comme nom de base/table/champ.';

$strKeepPass = 'Conserver le mot de passe';
$strKeyname = 'Nom de la clé';
$strKill = 'Supprimer';

$strLength = 'Long.';
$strLengthSet = 'Taille/Valeurs*';
$strLimitNumRows = 'Nombre d\'enregistrements par page';
$strLineFeed = 'Saut de ligne : \\n';
$strLines = 'Lignes';
$strLinesTerminatedBy = 'Lignes terminées par';
$strLocationTextfile = 'Emplacement du fichier texte';
$strLogin = 'Entrer';
$strLogout = 'Quitter';
$strLogUsername = 'Nom d\'utilisateur&nbsp;:';
$strLogPassword = 'Mot de passe&nbsp;:';

$strModifications = 'Les modifications ont été sauvegardées.';
$strModify = 'Modifier';
$strModifyIndexTopic = 'Modifier une clef';
$strMoveTable = '<b>Déplacer</b> la table vers (base<b>.</b>table)&nbsp;:';
$strMoveTableOK = 'La table %s a été déplacée vers %s.';
$strMySQLReloaded = 'MySQL rechargé.';
$strMySQLSaid = 'MySQL a répondu:';
$strMySQLServerProcess = 'MySQL %pma_s1% sur le serveur %pma_s2% - utilisateur&nbsp;: %pma_s3%';
$strMySQLShowProcess = 'Afficher les processus';
$strMySQLShowStatus = 'Afficher l\'état du serveur MySQL';
$strMySQLShowVars = 'Afficher les variables du serveur MySQL';

$strName = 'Nom';
$strNbRecords = 'nb. d\'enregistrements';
$strNext = 'Suivant';
$strNo = 'Non';
$strNoDropDatabases = 'La commande "DROP DATABASE" est désactivée.';
$strNoDatabases = 'Aucune base de données';
$strNoFrames = 'L\'utilisation de phpMyAdmin est plus aisée avec un navigateur <b>supportant les "frames"</b>.';
$strNoIndex = 'Aucune clef n\'est définie&nbsp;!';
$strNoIndexPartsDefined = 'Aucune colonne n\'a été définie pour cette clef&nbsp;!';
$strNoModification = 'Pas de modifications';
$strNone = 'Nulle';
$strNoPassword = 'aucun mot de passe';
$strNoPrivileges = 'aucun privilège';
$strNoQuery = 'Aucune requête SQL !';
$strNoRights = 'Vous n\'êtes pas autorisé à accéder à cette page';
$strNoTablesFound = 'Aucune table n\'a été trouvée dans cette base.';
$strNotNumber = 'Ce n\'est pas un nombre !';
$strNotValidNumber = ' n\'est pas un nombre valide !';
$strNoUsersFound = 'Il n\'y a aucun utilisateur';
$strNull = 'Null';

$strOftenQuotation = 'Souvent des guillemets. OPTIONNEL signifie que seuls les champs de type char et varchar sont entourés par ce caractère.';
$strOptimizeTable = 'Optimiser la table';
$strOptionalControls = 'Optionnel. Indique le caractère qui permet d\'enlever l\'effet des caractères spéciaux.';
$strOptionally = 'OPTIONNEL';
$strOr = 'Ou';
$strOverhead = 'Perte';

$strPartialText = 'Textes réduits';
$strPassword = 'Mot de passe';
$strPasswordEmpty = 'Le mot de passe est vide';
$strPasswordNotSame = 'Les mots de passe doivent être identiques';
$strPHPVersion = 'Version de PHP';
$strPmaDocumentation = 'Documentation de phpMyAdmin';
$strPmaUriError = 'Le paramètre <tt>$cfgPmaAbsoluteUri</tt> DOIT être renseigné dans votre fichier de configuration !';
$strPos1 = 'Début';
$strPrevious = 'Précédent';
$strPrimary = 'Primaire';
$strPrimaryKey = 'Clé primaire';
$strPrimaryKeyHasBeenDropped = 'La clé primaire a été effacée';
$strPrimaryKeyName = 'Le nom d\'une clef primaire doit être PRIMARY&nbsp;!';
$strPrimaryKeyWarning = '("PRIMARY" <b>doit et ne peut être</b> que le nom d\'une clef primaire&nbsp;!)';
$strPrintView = 'Version imprimable';
$strPrivileges = 'Privilèges';
$strProperties = 'Propriétés';

$strQBE = 'Requête par un exemple';
$strQBEDel = 'Effacer';
$strQBEIns = 'Ajouter';
$strQueryOnDb = 'Requête SQL sur la base <b>%s</b>&nbsp;:';

$strRecords = 'Enregistrements';
$strReferentialIntegrity = 'Vérifier l\'intégrité référentielle';
$strReloadFailed = 'MySQL n\'a pu être rechargé.';
$strReloadMySQL = 'Recharger MySQL';
$strRememberReload = 'N\'oubliez pas de recharger MySQL';
$strRenameTable = '<b>Changer le nom</b> de la table pour';
$strRenameTableOK = 'La table %s se nomme maintenant %s';
$strRepairTable = 'Réparer la table';
$strReplace = 'Remplacer';
$strReplaceTable = 'Remplacer les données de la table avec le fichier';
$strReset = 'Réinitialiser les valeurs';
$strReType = 'Entrer à nouveau';
$strRevoke = 'Révoquer';
$strRevokeGrant = 'Révoquer "grant option"';
$strRevokeGrantMessage = 'Vous avez révoqué "grant option" pour %s';
$strRevokeMessage = 'Vous avez révoqué les privilèges pour %s';
$strRevokePriv = 'Révoquer les privilèges';
$strRowLength = 'Longueur enr.';
$strRows = 'Enregistrements';
$strRowsFrom = 'lignes à partir de';
$strRowSize = ' Taille enr. ';
$strRowsModeHorizontal= 'horizontal';
$strRowsModeOptions= 'en mode %s et répéter les en-têtes à chaque groupe de %s';
$strRowsModeVertical= 'vertical';
$strRowsStatistic = 'Statistiques';
$strRunning = 'sur le serveur %s';
$strRunQuery = 'Exécuter la requête';
$strRunSQLQuery = 'Exécuter une ou des <b>requêtes</b> sur la base %s';

$strSave = 'Sauvegarder';
$strSelect = 'Sélectionner';
$strSelectADb = 'Choisissez une base de données';
$strSelectAll = 'Tout sélectionner';
$strSelectFields = 'Choisir les champs à afficher (au moins un)';
$strSelectNumRows = 'dans la requête';
$strSend = 'Transmettre';
$strServerChoice = 'Choix du serveur';
$strServerVersion = 'Version du serveur';
$strSetEnumVal = 'Les différentes valeurs des champs de type enum/set sont à spécifier sous la forme \'a\',\'b\',\'c\'...<br />Pour utiliser un caractère "\\" ou "\'" dans l\'une de ces valeurs, faites le précéder du caractère d\'échappement "\\" (par exemple \'\\\\xyz\' ou \'a\\\'b\').';
$strShow = 'Afficher';
$strShowAll = 'Tout afficher';
$strShowCols = 'Afficher les colonnes';
$strShowingRecords = 'Affichage des enregistrements';
$strShowPHPInfo = 'Afficher les informations relatives à PHP';
$strShowTables = 'Afficher les tables';
$strShowThisQuery = 'Réafficher la requête après exécution';
$strSingly = '(à refaire après insertions/destructions)';
$strSize = 'Taille';
$strSort = 'Tri';
$strSpaceUsage = 'Espace utilisé';
$strSQLQuery = 'requête SQL';
$strStartingRecord = 'Premier enregistrement';
$strStatement = 'Information';
$strStrucCSV = 'Données CSV';
$strStrucData = 'Structure et données';
$strStrucDrop = 'Ajouter des énoncés "drop table"';
$strStrucExcelCSV = 'Données CSV pour Ms Excel';
$strStrucOnly = 'Structure seule';
$strSubmit = 'Exécuter';
$strSuccess = 'Votre requête SQL a été exécutée avec succès';
$strSum = 'Somme';

$strTable = 'table ';
$strTableComments = 'Commentaires sur la table';
$strTableEmpty = 'Le nom de la table est vide';
$strTableHasBeenDropped = 'La table %s a été effacée';
$strTableHasBeenEmptied = 'La table %s a été vidée';
$strTableHasBeenFlushed = 'La table %s a été rechargée';
$strTableMaintenance = 'Maintenance de la table';
$strTables = '%s table(s)';
$strTableStructure = 'Structure de la table';
$strTableType = 'Table en format';
$strTextAreaLength = 'Il est possible que ce champ<br />ne soit pas éditable<br />en raison de sa longueur';
$strTheContent = 'Le contenu de votre fichier a été inséré.';
$strTheContents = 'Le contenu du fichier remplacera le contenu de la table pour les enregistrements ayant une valeur de clé primaire ou unique identique.';
$strTheTerminator = 'Le caractère qui sépare chacun des champs.';
$strTotal = 'total';
$strType = 'Type';

$strUncheckAll = 'Tout décocher';
$strUnique = 'Unique';
$strUnselectAll = 'Tout déselectionner';
$strUpdatePrivMessage = 'Vous avez modifié les privilèges pour %s.';
$strUpdateProfile = 'Modifier le profil :';
$strUpdateProfileMessage = 'Le profil a été modifié.';
$strUpdateQuery = 'Mise-à-jour de la requête';
$strUsage = 'Espace';
$strUseBackquotes = 'Protéger les noms des tables et des champs par des&nbsp;"`"';
$strUser = 'Utilisateur';
$strUserEmpty = 'Le nom d\'utilisateur est vide';
$strUserName = 'Nom d\'utilisateur';
$strUsers = 'Utilisateurs et privilèges';
$strUseTables = 'Utiliser les tables';

$strValue = 'Valeur';
$strViewDump = '<b>Afficher le schéma</b> de la table';
$strViewDumpDB = 'Afficher le schéma de la base ';

$strWelcome = 'Bienvenue à %s ';
$strWithChecked = 'Pour la sélection :';
$strWrongUser = 'Erreur d\'utilisateur/mot de passe. Accès refusé';

$strYes = 'Oui';

$strZip = '"zippé"';

?>
