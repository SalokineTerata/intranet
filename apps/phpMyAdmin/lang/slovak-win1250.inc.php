<?php
/* $Id: slovak-win1250.inc.php,v 1.14.2.1 2002/04/28 10:01:00 loic1 Exp $ */

/**
 * Translated by: Peter Svec <petko at unitra.sk>
 */

$charset = 'windows-1250';
$text_dir = 'ltr';
$left_font_family = '"verdana ce", "arial ce", verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = '"verdana ce", "arial ce", arial, helvetica, geneva, sans-serif';
$number_thousands_separator = ' ';
$number_decimal_separator = ',';
$byteUnits = array('Bajtov', 'KB', 'MB', 'GB');

$day_of_week = array('Ne', 'Po', 'Út', 'St', 't', 'Pi', 'So');
$month = array('Jan', 'Feb', 'Mar', 'Apr', 'Máj', 'Jún', 'Júl', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%d.%B, %Y - %H:%M';


$strAccessDenied = 'Prístup zamietnutý';
$strAction = 'Akcia';
$strAddDeleteColumn = 'Prida/Odobra polia ståpcov';
$strAddDeleteRow = 'Prida/Odobra kritéria riadku';
$strAddNewField = 'Prida nové pole';
$strAddPriv = 'Prida nové privilégium';
$strAddPrivMessage = 'Privilégium bolo pridané.';
$strAddSearchConditions = 'Prida vyh¾adávacie parametre (obsah dotazu po "where" príkaze):';
$strAddToIndex = 'Prida do indexu &nbsp;%s&nbsp;ståpec';
$strAddUser = 'Prida nového pouívate¾a';
$strAddUserMessage = 'Pouívate¾ bol pridaný.';
$strAffectedRows = ' Ovplyvnené riadky: ';
$strAfter = 'Po %s';
$strAfterInsertBack = 'Spä';
$strAfterInsertNewInsert = 'Vloi nový záznam';
$strAll = 'Vetko';
$strAlterOrderBy = 'Zmeni poradie tabu¾ky pod¾a';
$strAnalyzeTable = 'Analyzova tabu¾ku';
$strAnd = 'a';
$strAnIndex = 'Bol pridaný index pre %s';
$strAny = 'Akýko¾vek';
$strAnyColumn = 'Akýko¾vek ståpec';
$strAnyDatabase = 'Akáko¾vek databáza';
$strAnyHost = 'Akýko¾vek hostite¾';
$strAnyTable = 'Akáko¾vek tabu¾ka';
$strAnyUser = 'Akýko¾vek pouívate¾';
$strAPrimaryKey = 'Bol pridaný primárny k¾úè pre %s';
$strAscending = 'Vzostupne';
$strAtBeginningOfTable = 'Na zaèiatku tabu¾ky';
$strAtEndOfTable = 'Na konci tabu¾ky';
$strAttr = 'Atribúty';

$strBack = 'Spä';
$strBinary = 'Binárny';
$strBinaryDoNotEdit = 'Binárny - neupravujte ';
$strBookmarkDeleted = 'Záznam z ob¾úbených bol zmazaný.';
$strBookmarkLabel = 'Názov';
$strBookmarkQuery = 'Ob¾úbený SQL dotaz';
$strBookmarkThis = 'Prida tento SQL dotaz do ob¾úbených';
$strBookmarkView = 'Iba prezrie';
$strBrowse = 'Prechádza';
$strBzip = '"bzipped"';

$strCantLoadMySQL = 'nie je moné nahra rozírenie pre MySQL,<br />prosím skontrolujte konfiguráciu PHP.';
$strCantRenameIdxToPrimary = 'Nie je moné premenova index na PRIMARY!';
$strCardinality = 'Mohutnos';
$strCarriage = 'Návrat vozíku (Carriage return): \\r';
$strChange = 'Zmeni';
$strChangePassword = 'Zmeni heslo';
$strCheckAll = 'Oznaèi vetko';
$strCheckDbPriv = 'Skontrolova privilégia databázy';
$strCheckTable = 'Skontrolova tabu¾ku';
$strColumn = 'Ståpec';
$strColumnNames = 'Názvy ståpcov';
$strCompleteInserts = 'Úplné vloenie';
$strConfirm = 'Skutoène si eláte toto vykona?';
$strCookiesRequired = 'Od tohto bodu musia by Cookies zapnuté.';
$strCopyTable = 'Skopírova tabu¾ku do (databáza<b>.</b>tabu¾ka):';
$strCopyTable = 'Skopírova tabu¾ku do';
$strCopyTableOK = 'Tabu¾ka %s bola skopírovaná do %s.';
$strCreate = 'Vytvori';
$strCreateIndex = 'Vytvori index na&nbsp;%s&nbsp;ståpcoch';
$strCreateIndexTopic = 'Vytvori nový index';
$strCreateNewDatabase = 'Vytvori novú databázu';
$strCreateNewTable = 'Vytvori novú tabu¾ku v databáze %s';
$strCriteria = 'Kritéria';

$strData = 'Dáta';
$strDatabase = 'Databáza ';
$strDatabaseHasBeenDropped = 'Databáza %s bola zmazaná.';
$strDatabaseWildcard = 'Databáza (divoké karty - wildcards povolené):';
$strDatabases = 'databáz(y)';
$strDatabasesStats = 'tatistiky databázy';
$strDataOnly = 'Iba dáta';
$strDefault = 'Predvolené';
$strDelete = 'Zmaza';
$strDeleted = 'Riadok bol zmazaný';
$strDeletedRows = 'Zmazané riadky:';
$strDeleteFailed = 'Mazanie bolo neúspené!';
$strDeleteUserMessage = 'Pouívate¾ %s bol zmazaný.';
$strDescending = 'Zostupne';
$strDisplay = 'Zobrazi';
$strDisplayOrder = 'Zobrazi zoradené:';
$strDoAQuery = 'Vykona "dotaz pod¾a príkladu" (divoká karta - wildcard: "%")';
$strDocu = 'Dokumentácia';
$strDoYouReally = 'Skutoène chcete vykona príkaz ';
$strDrop = 'Odstráni';
$strDropDB = 'Odstráni databázu %s';
$strDropTable = 'Zrui tabu¾ku';
$strDumpingData = 'Dampujem dáta pre tabu¾ku';
$strDynamic = 'dynamický';

$strEdit = 'Upravi';
$strEditPrivileges = 'Upravi privilégia';
$strEffective = 'Efektívny';
$strEmpty = 'Vyprázdni';
$strEmptyResultSet = 'MySQL vrátilo prázdny výsledok (tj. nulový poèet riadkov).';
$strEnd = 'Koniec';
$strEnglishPrivileges = ' Poznámka: názvy MySQL privilégií sú uvádzané v angliètine. ';
$strError = 'Chyba';
$strExtendedInserts = 'Rozírené vkladanie';
$strExtra = 'Extra';

$strField = 'Pole';
$strFieldHasBeenDropped = 'Pole %s bolo odstránené';
$strFields = 'Polia';
$strFieldsEmpty = ' Poèet polí je prázdny! ';
$strFieldsEnclosedBy = 'Polia uzatvorené';
$strFieldsEscapedBy = 'Polia uvedené pomocou';
$strFieldsTerminatedBy = 'Polia ukonèené';
$strFixed = 'pevný';
$strFlushTable = 'Vyprázdni tabu¾ku ("FLUSH")';
$strFormat = 'Formát';
$strFormEmpty = 'Chýbajúca poloka vo formulári !';
$strFullText = 'Plné texty';
$strFunction = 'Funkcia';

$strGenTime = 'Vygenerované:';
$strGo = 'Vykonaj';
$strGrants = 'Privilégia';
$strGzip = '"gzip-ované"';

$strHasBeenAltered = 'bola zmenená.';
$strHasBeenCreated = 'bola vytvorená.';
$strHome = 'Domov';
$strHomepageOfficial = 'Oficiálne stránky phpMyAdmin-a';
$strHomepageSourceforge = 'Download stránka phpMyAdmin-a (Sourceforge)';
$strHost = 'Hostite¾';
$strHostEmpty = 'Názov hostite¾a je prázdny!';

$strIdxFulltext = 'Celý text';
$strIfYouWish = 'Ak si eláte nahra iba urèité ståpce tabu¾ky, pecifikujte ich ako zoznam polí oddelených èiarkou.';
$strIgnore = 'Ignorova';
$strIndex = 'Index';
$strIndexes = 'Indexy';
$strIndexHasBeenDropped = 'Index pre %s bol odstránený';
$strIndexName = 'Meno indexu&nbsp;:';
$strIndexType = 'Typ indexu&nbsp;:';
$strInsert = 'Vloi';
$strInsertAsNewRow = 'Vloi ako nový riadok';
$strInsertedRows = 'Vloené riadky:';
$strInsertNewRow = 'Vloi nový riadok';
$strInsertTextfiles = 'Vloi textové súbory do tabu¾ky';
$strInstructions = 'Intrukcie';
$strInUse = 'práve sa pouíva';
$strInvalidName = '"%s" je rezervované slovo, nemôe by pouité ako názov databázy/tabu¾ky/po¾a.';

$strKeepPass = 'Nezmeni heslo';
$strKeyname = 'K¾úèový názov';
$strKill = 'Zabi';

$strLength = 'Dåka';
$strLengthSet = 'Dåka/Nastavi*';
$strLimitNumRows = 'záznamov na stránku';
$strLineFeed = 'Ukonèenie riadku (Linefeed): \\n';
$strLines = 'Riadky';
$strLinesTerminatedBy = 'Riadky ukonèené';
$strLocationTextfile = 'Lokácia textového súboru';
$strLogout = 'Odhlási sa';
$strLogin = 'Prihlásenie';
$strLogPassword = 'Heslo:';
$strLogUsername = 'Pouívate¾ské meno:';

$strModifications = 'Zmeny boli uloené';
$strModify = 'Zmeni';
$strModifyIndexTopic = 'Modifikova index';
$strMoveTable = 'Presunú tabu¾ku do (databáza<b>.</b>tabu¾ka):';
$strMoveTableOK = 'Tabu¾ka %s bola presunutá do %s.';
$strMySQLReloaded = 'MySQL znovu-naèítané.';
$strMySQLSaid = 'MySQL hlási: ';
$strMySQLServerProcess = 'MySQL %pma_s1% beí na %pma_s2% ako %pma_s3%';
$strMySQLShowProcess = 'Zobrazi procesy';
$strMySQLShowStatus = 'Zobrazi informácie o behu MySQL';
$strMySQLShowVars = 'Zobrazi systémové premenné MySQL';

$strName = 'Názov';
$strNbRecords = 'Poèet záznamov';
$strNext = 'Ïalí';
$strNo = 'Nie';
$strNoDatabases = 'iadne databázy';
$strNoDropDatabases = 'Monos "DROP DATABASE" vypnutá.';
$strNoFrames = 'phpMyAdmin funguje lepie s prehliadaèmi podporujúcimi <b>rámy</b>.';
$strNoIndex = 'Nebol definovaný iadny index!';
$strNoIndexPartsDefined = 'Èasti indexu neboli definované!';
$strNoModification = 'iadna zmena';
$strNone = 'iadny';
$strNoPassword = 'iadne heslo';
$strNoPrivileges = 'iadne privilégia';
$strNoQuery = 'iadny SQL dotaz!';
$strNoRights = 'Nemáte dostatoèné práva na vykonanie tejto akcie!';
$strNoTablesFound = 'Neboli nájdené iadne tabu¾ky v tejto datábaze.';
$strNotNumber = 'Toto nie je èíslo!';
$strNotValidNumber = ' nie je platné èíslo riadku!';
$strNoUsersFound = 'Nebol nájdený iadny pouívate¾.';
$strNull = 'Nulový';

$strOftenQuotation = 'Èasto uvodzujúce znaky. VOLITE¼NE znamená, e iba polia typu char a varchar sú uzatvorené do "uzatváracích" znakov.';
$strOptimizeTable = 'Optimalizova tabu¾ku';
$strOptionalControls = 'Volite¾ne. Urèuje ako zapisova alebo èíta peciálne znaky.';
$strOptionally = 'VOLITE¼NE';
$strOr = 'alebo';
$strOverhead = 'Naviac';

$strPartialText = 'Èiastoèné texty';
$strPassword = 'Heslo';
$strPasswordEmpty = 'Heslo je prázdne!';
$strPasswordNotSame = 'Heslá sa nezhodujú!';
$strPHPVersion = 'Verzia PHP';
$strPmaDocumentation = 'phpMyAdmin dokumentácia';
$strPmaUriError = '<tt>$cfgPmaAbsoluteUri</tt> direktíva MUSÍ by nastavená v konfiguraènom súbore!';
$strPos1 = 'Zaèiatok';
$strPrevious = 'Predchádzajúci';
$strPrimary = 'Primárny';
$strPrimaryKey = 'Primárny k¾úè';
$strPrimaryKeyHasBeenDropped = 'Primárny k¾úè bol zruený';
$strPrimaryKeyName = 'Názov primárneho k¾úèa musí by... PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>musí</b> by <b>iba</b> meno primárneho k¾úèa!)';
$strPrintView = 'Náh¾ad k tlaèi';
$strPrivileges = 'Privilégia';
$strProperties = 'Vlastnosti';

$strQBE = 'Dotaz pod¾a príkladu';
$strQBEDel = 'Zmaza';
$strQBEIns = 'Vloi';
$strQueryOnDb = ' SQL dotaz v databáze <b>%s</b>:';

$strRecords = 'Záznamov';
$strReferentialIntegrity = 'Skontroluj integritu odkazov:';
$strReloadFailed = 'Znovu-naèítanie MySQL bolo neúspené.';
$strReloadMySQL = 'Znovu-naèíta MySQL';
$strRememberReload = 'Nezabudnite znovu-naèíta MySQL server.';
$strRenameTable = 'Premenova tabu¾ku na';
$strRenameTableOK = 'Tabu¾ka %s bola premenovaná na %s';
$strRepairTable = 'Opravi tabu¾ku';
$strReplace = 'Nahradi';
$strReplaceTable = 'Nahradi dáta v tabu¾ke súborom';
$strReset = 'Pôvodné (Reset)';
$strReType = 'Napísa znova';
$strRevoke = 'Zrusi';
$strRevokeGrant = 'Zrui povolenie pridelova privilégia';
$strRevokeGrantMessage = 'Bolo zruené právo pridelova privilégia pre %s';
$strRevokeMessage = 'Boli zruené privilégia pre %s';
$strRevokePriv = 'Zrui privilégia';
$strRowLength = 'Dåka riadku';
$strRows = 'Riadkov';
$strRowsFrom = 'riadkov zaèínajúcich od';
$strRowsModeVertical=" vertikálnym ";  //to translate
$strRowsModeHorizontal=" horizontálnym ";  //to translate
$strRowsModeOptions=" %s smerom a opakova hlavièku po %s bunkách ";  //to translate
$strRowSize = ' Ve¾kos riadku ';
$strRowsStatistic = 'tatistika riadku';
$strRunning = 'beí na %s';
$strRunQuery = 'Odoli dotaz';
$strRunSQLQuery = 'Spusti SQL dotaz/dotazy na databázu %s';

$strSave = 'Uloi';
$strSelect = 'Vybra';
$strSelectFields = 'Zvoli pole (najmenej jedno):';
$strSelectNumRows = 'v dotaze';
$strSend = 'Poli';
$strServerChoice = 'Vo¾ba serveru';
$strServerVersion = 'Verzia serveru';
$strSetEnumVal = 'Ak je pole typu "enum" alebo "set", prosím zadávajte hodnoty v tvare: \'a\',\'b\',\'c\'...<br />Ak dokonca potrebujete zada spätné lomítko ("\") alebo apostrof ("\'") pri týchto hodnotách, zadajte ich napríklad takto \'\\\\xyz\' alebo \'a\\\'b\'.';
$strShow = 'Ukáza';
$strShowAll = 'Zobrazi vetko';
$strShowCols = 'Zobrazi ståpce';
$strShowingRecords = 'Ukáza záznamy ';
$strShowPHPInfo = 'Zobrazi informácie o PHP';
$strShowTables = 'Zobrazi tabu¾ky';
$strShowThisQuery = ' Zobrazi tento dotaz znovu ';
$strSingly = '(po jednom)';
$strSize = 'Ve¾kos';
$strSort = 'Triedi';
$strSpaceUsage = 'Zabrané miesto';
$strSQLQuery = 'SQL dotaz';
$strStartingRecord = 'Zaèiatok záznamu';
$strStatement = 'Údaj';
$strStrucCSV = 'CSV dáta';
$strStrucData = 'truktúru a dáta';
$strStrucDrop = 'Pridaj \'vyma tabu¾ku\'';
$strStrucExcelCSV = 'CSV dáta pre MS Excel';
$strStrucOnly = 'Iba truktúru';
$strSubmit = 'Odoli';
$strSuccess = 'SQL dotaz bol úspene vykonaný';
$strSum = 'Celkom';

$strTable = 'tabu¾ka ';
$strTableComments = 'Komentár k tabu¾ke';
$strTableEmpty = 'Tabu¾ka je prázdna!';
$strTableHasBeenDropped = 'Tabu¾ka %s bola odstránená';
$strTableHasBeenEmptied = 'Tabu¾ka %s bola vyprázdnená';
$strTableHasBeenFlushed = 'Tabu¾ka %s bola vyprázdnená';
$strTableMaintenance = 'Údrba tabu¾ky';
$strTables = '%s tabu¾ka(y)';
$strTableStructure = 'truktúra tabu¾ky pre tabu¾ku';
$strTableType = 'Typ tabu¾ky';
$strTextAreaLength = ' Toto mono nepojde upravi,<br /> kôli svojej dåke ';
$strTheContent = 'Obsah Váho súboru bol vloený.';
$strTheContents = 'Obsah súboru prepíe obsah vybranej tabu¾ky v riadkoch s identickým primárnym alebo unikátnym k¾úèom.';
$strTheTerminator = 'Ukonèenie polí.';
$strTotal = 'celkovo';
$strType = 'Typ';

$strUncheckAll = 'Odznaèi vetko';
$strUnique = 'Unikátny';
$strUpdatePrivMessage = 'Boli aktualizované privilégia pre %s.';
$strUpdateProfile = 'Aktualizova profil:';
$strUpdateProfileMessage = 'Profil bol aktualizovaný.';
$strUpdateQuery = 'Aktualizova dotaz';
$strUsage = 'Vyuitie';
$strUseBackquotes = ' Poui opaèný apostrof pri názvoch tabuliek a polí ';
$strUser = 'Pouívate¾';
$strUserEmpty = 'Meno pouívate¾a je prázdne!';
$strUserName = 'Meno pouívate¾a';
$strUsers = 'Pouívatelia';
$strUseTables = 'Poui tabu¾ky';

$strValue = 'Hodnota';
$strViewDump = 'Zobrazi dump (schému) tabu¾ky';
$strViewDumpDB = 'Zobrazi dump (schému) databázy';

$strWelcome = 'Vitajte v %s';
$strWithChecked = 'Výber:';
$strWrongUser = 'Zlé pouívate¾ské meno alebo heslo. Prístup zamietnutý.';

$strYes = 'Áno';

$strZip = '"zozipované"';


// To translate
?>
