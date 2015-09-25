<?php
/* $Id: bulgarian-win1251.inc.php,v 1.114 2002/04/20 13:37:49 loic1 Exp $ */

/**
 * Translated by Georgi Georgiev <chutz at chubaka.homeip.net>
 */

$charset = 'windows-1251';
$text_dir = 'ltr';
$left_font_family = 'sans-serif';
$right_font_family = 'sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('áàéòà', 'KB', 'MB', 'GB');

$day_of_week = array('íåä', 'ïîí', 'âò', 'ñð', '÷åò', 'ïåò', 'ñúá');
$month = array('ÿíóàðè', 'ôåâðóàðè', 'ìàðò', 'àïðèë', 'ìàé', 'þíè', 'þëè', 'àâãóñò', 'ñåïòåìâðè', 'îêîìâðè', 'íîåìâðè', 'äåêåìâðè');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%e %B %Y â %H:%M';


$strAccessDenied = 'Îòêàçàí äîñòúï';
$strAction = 'Äåéñòâèå';
$strAddDeleteColumn = 'Äîáàâè/èçòðèé êîëîíà ïî êðèòåðèé';
$strAddDeleteRow = 'Äîáàâè/èçòðèé ðåä ïî êðèòåðèé';
$strAddNewField = 'Äîáàâè íîâî ïîëå';
$strAddPriv = 'Äîáàâÿíå íà íîâà ïðèâèëåãèÿ';
$strAddPrivMessage = 'Âèå äîáàâèõòå íîâà ïðèâèëåãèÿ.';
$strAddSearchConditions = 'Äîáàâè óñëîâèå çà òúðñåíå (òÿëî çà "where" óñëîâèå):';
$strAddToIndex = ' &nbsp;%s&nbsp;êîëîíà(è) áÿõà äîáàâåíè êúì èíäåêñà ';
$strAddUser = 'Äîáàâÿíå íà íîâ ïîòðåáèòåë.';
$strAddUserMessage = 'Âèå äîáàâèõòå íîâ ïîòðåáèòåë.';
$strAffectedRows = 'Çàñåãíàòè ðåäà:';
$strAfter = 'Ñëåä %s';
$strAfterInsertBack = 'ñå âúðíè';
$strAfterInsertNewInsert = 'âìúêíè íîâ çàïèñ';
$strAll = 'âñè÷êè';
$strAlterOrderBy = 'Ïîäðåäè òàáëèöàòà ïî';
$strAnalyzeTable = 'Àíàëèçèðàíå íà òàáëèöàòà';
$strAnd = 'è';
$strAnIndex = 'Áåøå äîáàâåí èíäåêñ íà %s';
$strAny = 'âñåêè';
$strAnyColumn = 'Âñÿêà êîëîíà';
$strAnyDatabase = 'Âñÿêà áàçà äàííè';
$strAnyHost = 'Âñåêè õîñò';
$strAnyTable = 'Âñÿêà òàáëèöà';
$strAnyUser = 'Âñåêè ïîòðåáèòåë';
$strAPrimaryKey = 'Áeøe äîáàâåí ãëàâåí êëþ÷ êúì ';
$strAscending = 'Âúçõîäÿùî';
$strAtBeginningOfTable = 'îò íà÷àëîòî íà òàáëèöàòà';
$strAtEndOfTable = 'îò êðàÿ íà òàáëèöàòà';
$strAttr = 'Àòðèáóòè';

$strBack = 'Íàçàä';
$strBinary = ' Äâîè÷íî ';
$strBinaryDoNotEdit = ' Äâîè÷íî - íå ñå ðåäàêòèðà ';
$strBookmarkDeleted = 'Bookmark áåøå èçòðèò.';
$strBookmarkLabel = 'Åòèêåò';
$strBookmarkQuery = 'Çàïàçâàìå íà SQL-çàïèòâàíå';
$strBookmarkThis = 'Çàïàçè òîâà SQL-çàïèòâàíå';
$strBookmarkView = 'Ñàìî ïîêàçâàíå';
$strBrowse = 'Ïðåëèñòè';
$strBzip = '"bzip-íàòî"';

$strCantLoadMySQL = 'Íå ìîãà äà çàðåäÿ MySQL ðàçøèðåíèÿòà,<br />ìîëÿ ïðîâåðåòå êîíôèãóðàöèÿòà íà PHP.';
$strCantRenameIdxToPrimary = 'Íå ìîãà äà ïðåèìåíóâàì èíäåêñà íà PRIMARY!';
$strCardinality = 'íàäåæäíîñò';
$strCarriage = 'Ñèìâîë çà êðàé íà ðåä: \\r';
$strChange = 'Ïðîìåíè';
$strChangePassword = 'Ñìÿíà íà ïàðîëàòà';
$strCheckAll = 'Ìàðêèðàé âñè÷êî';
$strCheckDbPriv = 'Ïðîâåðè ïðèâèëåãèèòå íà ÁÄ';
$strCheckTable = 'Ïðîâåðêà íà òàáëèöàòà';
$strColumn = 'Êîëîíà';
$strColumnNames = 'Èìå íà êîëîíà';
$strCompleteInserts = 'Ïúëíè INSERT-è';
$strConfirm = 'Äåéñòâèòåëíî ëè æåëàåòå äà ãî íàïðàâèòå?';
$strCookiesRequired = 'Îòòóê íàòàòúê ñà íåîáõîäèìè "Cookies".';
$strCopyTable = 'Êîïèðàíå íà òàáëèöà (áàçà îò äàííè<b>.</b>òàáëèöà):';
$strCopyTableOK = 'Òàáëèöà %s áåøå êîïèðàíà â %s.';
$strCreate = 'Ñúçäàé';
$strCreateIndex = 'Ñúçäàé èíäåêñ âúðõó &nbsp;%s&nbsp;êîëîíè';
$strCreateIndexTopic = 'Ñúçäàé íîâ èíäåêñ';
$strCreateNewDatabase = 'Ñúçäàé íîâà ÁÄ';
$strCreateNewTable = 'Ñúçäàé íîâà òàáëèöà â ÁÄ %s';
$strCriteria = 'Êðèòåðèé';

$strData = 'Äàííè';
$strDatabase = ' ÁÄ ';
$strDatabaseHasBeenDropped = 'Áàçàòà äàííè %s áåøå èçòðèòà.';
$strDatabases = 'Áàçè îò Äàííè';
$strDatabasesStats = ' Ñòàòèñòèêà çà áàçèòå äàííè';
$strDatabaseWildcard = 'Áàçà äàííè (ìîæå è ñ wildcard):';
$strDataOnly = 'Ñàìî äàííè';
$strDefault = 'Ïî ïîäðàçáèðàíå';
$strDelete = 'Èçòðèé';
$strDeleted = 'Ðåäúò áåøå èçòðèò';
$strDeletedRows = 'Èçòðèòè ðåäîâå:';
$strDeleteFailed = 'Íåóñïåøíî èçòðèâàíå!';
$strDeleteUserMessage = 'Âèå èçòðèõòå ïîòðåáèòåë %s.';
$strDescending = 'Íèçõîäÿùî';
$strDisplay = 'Ïîêàæè';
$strDisplayOrder = 'Ïîêàæè ïîäðåäáà:';
$strDoAQuery = 'Èçïúëíè "çàïèòâàíå ïî çàÿâêà" (ñèìâîë çà  çàìåñòâàíå: "%")';
$strDocu = 'Äîêóìåíòàöèÿ';
$strDoYouReally = 'Äåéñòâèòåëíî ëè æåëàåòå äà';
$strDrop = 'Óíèùîæè';
$strDropDB = 'Óíèùîæè ÁÄ %s';
$strDropTable = 'Èçòðèé òàáëèöàòà';
$strDumpingData = 'Äúìï (ñõåìà) íà äàííèòå â òàáëèöàòà';
$strDynamic = 'äèíàìè÷åí';

$strEdit = 'Ðåäàêòèðàíå';
$strEditPrivileges = 'Ðåäàêòèðàíå íà ïðèâèëåãèèòå';
$strEffective = 'Åôåêòèâíè';
$strEmpty = 'Èçïðàçíè';
$strEmptyResultSet = 'MySQL âúðíà ïðàçåí ðåçóëòàò (ò.å. íóëà ðåäîâå).';
$strEnd = 'Êðàé';
$strEnglishPrivileges = ' Çàáåëåæêà: Èìåíàòà íà ïðèâèëåãèèòå íà MySQL ñà ïîêàçàíè íà àíãëèéñêè. ';
$strError = 'Ãðåøêà';
$strExtendedInserts = 'Ðàçøèðåíè INSERT-è';
$strExtra = 'Äîïúëíèòåëíî';

$strField = 'Ïîëå';
$strFieldHasBeenDropped = 'Ïîëåòî %s áåøå èçòðèòî';
$strFields = 'Ïîëåòà';
$strFieldsEmpty = ' Áðîÿ÷à íà ïîëåòàòà å ïðàçåí! ';
$strFieldsEnclosedBy = 'Ïîëåòàòà ñà îãðàäåíè ñúñ';
$strFieldsEscapedBy = 'Ïðåäñòàâêà ïðåä ñïåöèàëíèòå ñèìâîëè';
$strFieldsTerminatedBy = 'Ïîëåòàòà çàâúðøâàò ñúñ';
$strFixed = 'Ôèêñèðàí';
$strFlushTable = 'Èçïðàçíè êåøà íà òàáëèöàòà ("FLUSH")';
$strFormat = 'Ôîðìàò';
$strFormEmpty = 'Ëèïñâà ñòîéíîñò âúâ ôîðìàòà!';
$strFullText = 'Ïúëíè òåêñòîâå';
$strFunction = 'Ôóíêöèÿ';

$strGenTime = 'Âðåìå íà ãåíåðèðàíå';
$strGo = 'Èçïúëíè';
$strGrants = 'Grant&nbsp;ïðèâ.';
$strGzip = '"gzip-íàòî"';

$strHasBeenAltered = 'áåøå ïðîìåíåíà.';
$strHasBeenCreated = 'áåøå ñúçäàäåíà.';
$strHome = 'Íà÷àëî';
$strHomepageOfficial = 'Îôèöèàëíà phpMyAdmin óåá ñòðàíèöà';
$strHomepageSourceforge = 'phpMyAdmin ñòðàíèöà íà Sourceforge';
$strHost = 'Õîñò';
$strHostEmpty = 'Èìåòî íà õîñòà å ïðàçíî!';

$strIdxFulltext = 'Ïúëíîòåêñòîâî';
$strIfYouWish = 'Àêî æåëàåòå äà çàðåäèòå ñàìî íÿêîè êîëîíè îò òàáëèöàòà, óêàæåòå ñïèñúê íà ïîëåòàòà ðàçäåëåíè ñúñ çàïåòàè.';
$strIgnore = 'Èãíîðèðàé';
$strIndex = 'Èíäåêñ';
$strIndexes = 'Èíäåêñè';
$strIndexHasBeenDropped = 'Èíäåêñà %s áåøå èçòðèò';
$strIndexName = 'Èìå íà èíäåêñà&nbsp;:';
$strIndexType = 'Òèï íà èíäåêñà&nbsp;:';
$strInsert = 'Âìúêíè';
$strInsertAsNewRow = 'Âìúêíè êàòî íîâ ðåä';
$strInsertedRows = 'Âìúêíàòè ðåäà:';
$strInsertNewRow = 'Âìúêíè íîâ ðåä';
$strInsertTextfiles = 'Âìúêíè òåêñòîâè ôàéëîâå â òàáëèöàòà';
$strInstructions = 'Èíñòðóêöèè';
$strInUse = 'Çàåòî';
$strInvalidName = '"%s" å çàïàçàíà äóìà è âèå íå ìîæåòå äà ÿ èçïîëçâàòå çà èìå íà áàçà îò äàííè,òàáëèöà èëè ïîëå. ';

$strKeepPass = 'Äà íå ñå ñìåíÿ ïàðîëàòà';
$strKeyname = 'Èìå íà êëþ÷à';
$strKill = 'ÑÒÎÏ';

$strLength = 'Äúëæèíà';
$strLengthSet = 'Äúëæèíà/Ñòîéíîñò*';
$strLimitNumRows = 'ðåäà íà ñòðàíèöà';
$strLineFeed = 'Ñèìâîë çà êðàé íà ðåä: \\n';
$strLines = 'Ðåäîâå';
$strLinesTerminatedBy = 'Ëèíèèòå çàâúðøâàò ñ';
$strLocationTextfile = 'Ìåñòîïîëîæåíèå íà òåêñòîâèÿ ôàéë';
$strLogin = 'Âõîä';
$strLogout = 'Èçõîä îò ñèñòåìàòà';
$strLogPassword = 'Ïàðîëà:';
$strLogUsername = 'Èìå:';

$strModifications = 'Ïðîìåíèòå áÿõà ñúõðàíåíè';
$strModify = 'Ïðîìåíè';
$strModifyIndexTopic = 'Ïðîìÿíà íà èíäåêñ';
$strMoveTable = 'Ïðåìåñòâàíå íà òàáëèöà êúì (áàçà îò äàííè<b>.</b>òàáëèöà):';
$strMoveTableOK = 'Òàáëèöàòà %s áåøå ïðåìåñòåíà êúì %s.';
$strMySQLReloaded = 'MySQL å ïðåçàðåäåí.';
$strMySQLSaid = 'MySQL îòãîâîðè: ';
$strMySQLServerProcess = 'MySQL %pma_s1% å ñòàðòèðàí íà %pma_s2% êàòî %pma_s3%';
$strMySQLShowProcess = 'Ïîêàæè ïðîöåñèòå';
$strMySQLShowStatus = 'Ïîêàæè ñúñòîÿíèåòî íà MySQL';
$strMySQLShowVars = 'Ïîêàæè ñèñòåìíèòå ïðîìåíëèâè íà MySQL';

$strName = 'Èìå';
$strNbRecords = 'Áðîé çàïèñè';
$strNext = 'Ñëåäâàù';
$strNo = 'íå';
$strNoDatabases = 'Íÿìà áàçè îò äàííè';
$strNoDropDatabases = '"DROP DATABASE" çÿâêàòà å çàáðàíåíà.';
$strNoFrames = 'phpMyAdmin å ïî äðóæåëþáåí àêî èçïîëçâàòå áðàóçúð, êîéòî ïîääúðæà <b>frames</b>.';
$strNoIndex = 'Íå å äåôèíèðàí èíäåêñ!';
$strNoIndexPartsDefined = 'Íå ñà äåôèíèðàíè ÷àñòè íà èíäåêñ!';
$strNoModification = 'Íÿìà ïðîìÿíà';
$strNone = 'Íèùî';
$strNoPassword = 'Íÿìà ïàðîëà';
$strNoPrivileges = 'Íÿìà ïðèâèëåãèè';
$strNoQuery = 'Íÿìà SQL çàÿâêà!';
$strNoRights = 'Â ìîìåíòà íå ðàçïîëàãàòå ñ äîñòàòú÷íî ïðàâà çà äà ñå íàìèðàòå òóê!';
$strNoTablesFound = 'Â áàçàòà äàííè íÿìà òàáëèöè.';
$strNotNumber = 'Òîâà íå å ÷èñëî!';
$strNotValidNumber = ' íå å âàëèäåí íîìåð íà ðåä!';
$strNoUsersFound = 'Íÿìà ïîòðåáèòåë(è).';
$strNull = 'Ïðàçíî';

$strOffSet = 'Îòìåñòâàíå';
$strOftenQuotation = 'Îáèêíîâåíî êàâè÷êè. ÏÎ ÈÇÁÎÐ îçíà÷àâà, ÷å ñàìî ïîëåòà char è varchar ñå çàãðàæäàò â êàâè÷êè.';
$strOptimizeTable = 'Îïòèìèçèðàíå íà òàáëèöàòà';
$strOptionalControls = 'Ïî èçáîð. Êîíòðîëèðà êàê äà ñå ÷åòàò èëè ïèøàò ñïåöèàëíè ñèìâîëè.';
$strOptionally = 'ÏÎ ÈÇÁÎÐ';
$strOr = 'èëè';
$strOverhead = 'Çàãóáåíî ìÿñòî';

$strPartialText = '×àñòè÷íè òåêñòîâå';
$strPassword = 'Ïàðîëà';
$strPasswordEmpty = 'Ïàðîëàòà å ïðàçíà!';
$strPasswordNotSame = 'Ïàðîëàòà íå å ñúùàòà!';
$strPHPVersion = 'Âåðñèÿ íà PHP ';
$strPmaDocumentation = 'phpMyAdmin äîêóìåíòàöèÿ';
$strPmaUriError = 'Íà <tt>$cfgPmaAbsoluteUri</tt> ÒÐßÁÂÀ äà ñå çàäàäå ñòîéíîñò â êîíôèãóðàöèîííèÿ ôàéë!';
$strPos1 = 'Íà÷àëî';
$strPrevious = 'Ïðåäèøåí';
$strPrimary = 'PRIMARY';
$strPrimaryKey = 'Ãëàâåí êëþ÷';
$strPrimaryKeyHasBeenDropped = ' Ãëàâíèÿ êëþ÷ áåøå èçòðèò.';
$strPrimaryKeyName = 'Èìåòî íà ãëàâíèÿ êëþ÷ òðÿáâà äà å... PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>òðÿáâà</b> äà å èìåòî íà <b>è åäèíñòâåíî íà</b> ãëàâíèÿ êëþ÷!)';
$strPrintView = 'Èçãëåä çà ïå÷àò';
$strPrivileges = 'Ïðèâèëåãèè';
$strProperties = 'Ñâîéñòâà';

$strQBE = 'Çàïèòâàíå ïî ïðèìåð';
$strQBEDel = 'Èçòðèé';
$strQBEIns = 'Âìúêíè';
$strQueryOnDb = 'SQL-çàÿâêà êúì áàçàòà îò äàííè <b>%s</b>:';

$strRecords = 'Çàïèñè';
$strReferentialIntegrity = 'Ïðîâåðêà íà èíòåãðèòåòà íà âðúçêèòå';
$strReloadFailed = 'Íåóñïåøåí îïèò çà ïðåçàðåæäàíå íà MySQL.';
$strReloadMySQL = 'Ïðåçàðåäè MySQL';
$strRememberReload = 'Íå çàáðàâÿéòå äà ïðåçàðåäèòå ñúðâúðà.';
$strRenameTable = 'Ïðåèìåíóâàé òàáëèöàòà íà';
$strRenameTableOK = 'Òàáëèöà %s áåøå ïðåèìåíóâàíà íà %s';
$strRepairTable = 'Ïîïðàâÿíå íà òàáëèöàòà';
$strReplace = 'Çàìåñòè';
$strReplaceTable = 'Çàìåñòè äàííèòå îò òàáëèöàòà ñ äàííèòå îò ôàéëà';
$strReset = 'Èç÷èñòè';
$strReType = 'Îòíîâî';
$strRevoke = 'Îòìåíè';
$strRevokeGrant = 'Îòíåìàíå íà Grant&nbsp;ïðèâ.';
$strRevokeGrantMessage = 'Âèå ïðåìàõíàõòå Grant ïðèâèëåãèèòå çà %s';
$strRevokeMessage = 'Âèå îòìåíèõòå ïðèâèëåãèèòå çà %s';
$strRevokePriv = 'Îòìÿíà íà ïðèâèëåãèè';
$strRowLength = 'Äúëæèíà íà ðåäà';
$strRows = 'Ðåäîâå';
$strRowsFrom = 'ðåäà çàïî÷âàéêè îò';
$strRowSize = ' Ðàçìåð íà ðåä ';
$strRowsModeHorizontal = 'õîðèçîíòàëåí';
$strRowsModeOptions = 'â %s âèä è ïîâòàðÿé èìåíàòà íà êîëîíèòå ïðåç âñåêè %s<br />';
$strRowsModeVertical = 'âåðòèêàëåí';
$strRowsStatistic = 'Ñòàòèñòèêà çà ðåäîâåòå';
$strRunning = 'ðàáîòè íà %s';
$strRunQuery = 'Èçïúëíè çàÿâêàòà';
$strRunSQLQuery = 'Ñòàðòèðàíå SQL çàÿâêà/çàÿâêè êúì áàçà îò äàííè %s';

$strSave = 'Çàïèøè';
$strSelect = 'Èçáåðè';
$strSelectADb = 'Ìîëÿ èçáåðåòå áàçà äàííè';
$strSelectAll = 'Ñåëåêòèðàé âñè÷êî';
$strSelectFields = 'Èçáåðè ïîëå (ìèíèìóì åäíî):';
$strSelectNumRows = 'â çàïèòâàíåòî';
$strSend = 'Èçïðàòè';
$strServerChoice = 'Èçáîð íà ñúðâúð';
$strServerVersion = 'Âåðñèÿ íà ñúðâúðà';
$strSetEnumVal = 'Àêî òèïà íà ïîëåòî å "enum" èëè "set", ìîëÿ âúâåäåòå ñòîéíîñòèòå èçïîëçâàéêè òîçè ôîðìàò: \'a\',\'b\',\'c\'...<br />Àêî å íåîáõîäèìî äà ñëîæèòå îáðàòíà ÷åðòà ("\") èëè àïîñòðîô ("\'") ìåæäó òåçè ñòîéíîñòè, ñëîæèòå îáðàòíà ÷åðòà ïðåä òÿõ (íàïðèìåð:  \'\\\\xyz\' èëè \'a\\\'b\').';
$strShow = 'Ïîêàæè';
$strShowAll = 'Ïîêàæè âñè÷êè';
$strShowCols = 'Ïîêàæè êîëîíèòå';
$strShowingRecords = 'Ïîêàçâà çàïèñè ';
$strShowPHPInfo = 'Ïîêàæè èíôîðìàöèÿ çà PHP ';
$strShowTables = 'Ïîêàæè òàáëèöèòå';
$strShowThisQuery = ' Ïîêàæè òàçè çàÿâêà îòíîâî ';
$strSingly = '(åäíîêðàòíî)';
$strSize = 'Ðàçìåð';
$strSort = 'Ñîðòèðàíå';
$strSpaceUsage = 'Èçïîëçâàíî ìÿñòî';
$strSQLQuery = 'SQL-çàïèòâàíå';
$strStartingRecord = 'Íà÷àëåí çàïèñ';
$strStatement = 'Çàÿâëåíèå';
$strStrucCSV = 'CSV äàííè';
$strStrucData = 'Ñòðóêòóðàòà è äàííèòå';
$strStrucDrop = 'Äîáàâè \'èçòðèé òàáëèöàòà\'';
$strStrucExcelCSV = 'CSV çà Ms Excel äàííè';
$strStrucOnly = 'Ñàìî ñòðóêòóðàòà';
$strSubmit = 'Èçïúëíè';
$strSuccess = 'Âàøåòî SQL-çàïèòâàíå áåøå èçïúëíåíî óñïåøíî';
$strSum = 'Ñóìà';

$strTable = 'Òàáëèöà ';
$strTableComments = 'Êîìåíòàðè êúì òàáëèöàòà';
$strTableEmpty = 'Èìåòî íà òàáëèöàòà å ïðàçíî!';
$strTableHasBeenDropped = 'Òàáëèöàòà %s áåøå èçòðèòà';
$strTableHasBeenEmptied = 'Òàáëèöàòà %s áåøå èçïðàçíåíà';
$strTableHasBeenFlushed = 'Êåøà íà òàáëèöà %s áåøå èçïðàçíåí';
$strTableMaintenance = 'Ïîääðúæêà íà òàáëèöàòà';
$strTables = '%s òàáëèöà(è)';
$strTableStructure = 'Ñòðóêòóðà íà òàáëèöà';
$strTableType = 'Òèï íà òàáëèöàòà';
$strTextAreaLength = ' Ïîðàäè äúëæèíàòà ñè,<br /> òîâà ïîëå ìîæå äà íå å ðåäàêòèðóåìî ';
$strTheContent = 'Ñúäúðæàíèåòî íà ôàéëà áåøå èìïîðòèðàíî.';
$strTheContents = 'Ñúäúðæàíèåòî íà ôàéëà çàìåñòâà ñúäúðæàíèåòî íà òàáëèöàòà çà ðåäîâå ñ èäåíòè÷íè ïúðâè÷íè èëè óíèêàëíè êëþ÷îâå.';
$strTheTerminator = 'Ñèìâîë çà êðàé íà ïîëå.';
$strTotal = 'Âñè÷êî';
$strType = 'Òèï';

$strUncheckAll = 'Ðàçìàðêèðàé âñè÷êî';
$strUnique = 'Óíèêàëíî';
$strUnselectAll = 'Äåñåëåêòèðàé âñè÷êî';
$strUpdatePrivMessage = 'Âèå ïðîìåíèõòå ïðèâèëåãèèòå çà %s.';
$strUpdateProfile = 'Îáíîâÿâàíå íà ïðîôèë:';
$strUpdateProfileMessage = 'Ïðîôèëà áåøå îáíîâåí.';
$strUpdateQuery = 'Äîïúëíè Çàïèòâàíåòî';
$strUsage = 'Èçïîëçâàíè';
$strUseBackquotes = 'Èçïîëçâàé îáðàòíè êàâè÷êè îêîëî èìåíà íà òàáëèöè è ïîëåòà';
$strUser = 'Ïîòðåáèòåë';
$strUserEmpty = 'Ïîòðåáèòåëñêîòî èìå å ïðàçíî!';
$strUserName = 'Ïîòðåáèòåëñêî èìå';
$strUsers = 'Ïîòðåáèòåëè';
$strUseTables = 'Èçïîëçâàé òàáëèöàòà';

$strValue = 'Ñòîéíîñò';
$strViewDump = 'Ïîêàæè äúìï (ñõåìà) íà òàáëèöàòà';
$strViewDumpDB = 'Ïîêàæè äúìï (ñõåìà) íà ÁÄ';

$strWelcome = 'Äîáðå äîøëè â %s';
$strWithChecked = 'Êîãàòî èìà îòìåòêà:';
$strWrongUser = 'Ãðåøíî èìå/ïàðîëà. Îòêàçàí äîñòúï.';

$strYes = 'äà';

$strZip = '"zip-íàòî"';

// To translate
?>
