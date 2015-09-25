<?php
/* $Id: russian-koi8.inc.php,v 1.112 2002/04/22 14:38:34 rabus Exp $ */

/**
 * Translated by Gosha Sakovich <gt2 at users.sourceforge.net>
 *               Artyom Rabzonov <tyomych at gmx.net>
 */

$charset = 'koi8-r';
$text_dir = 'ltr';
$left_font_family = 'sans-serif';
$right_font_family = 'sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('âÁÊÔ', 'Ëâ', 'íâ', 'çâ');

$day_of_week = array('÷Ó', 'ðÎ', '÷Ô', 'óÒ', 'þÔ', 'ðÔ', 'óÂ');
$month = array('ñÎ×', 'æÅ×', 'íÁÒ', 'áÐÒ', 'íÁÊ', 'éÀÎ', 'éÀÌ', 'á×Ç', 'óÅÎ', 'ïËÔ', 'îÏÑ', 'äÅË');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%B %d %Y Ç., %H:%M';


$strAccessDenied = '÷ ÄÏÓÔÕÐÅ ÏÔËÁÚÁÎÏ';
$strAction = 'äÅÊÓÔ×ÉÅ';
$strAddDeleteColumn = 'äÏÂÁ×ÉÔØ/ÕÄÁÌÉÔØ ÓÔÏÌÂÅÃ ËÒÉÔÅÒÉÑ';
$strAddDeleteRow = 'äÏÂÁ×ÉÔØ/ÕÄÁÌÉÔØ ÒÑÄ ËÒÉÔÅÒÉÑ';
$strAddNewField = 'äÏÂÁ×ÉÔØ ÎÏ×ÏÅ ÐÏÌÅ';
$strAddPriv = 'äÏÂÁ×ÉÔØ ÎÏ×ÙÅ ÐÒÉ×ÉÌÅÇÉÉ';
$strAddPrivMessage = 'âÙÌÁ ÄÏÂÁ×ÌÅÎÁ ÎÏ×ÁÑ ÐÒÉ×ÉÌÅÇÉÑ';
$strAddSearchConditions = 'äÏÂÁ×ÉÔØ ÕÓÌÏ×ÉÑ ÐÏÉÓËÁ (ÔÅÌÏ ÄÌÑ ÕÓÌÏ×ÉÑ "where"):';
$strAddToIndex = 'äÏÂÁ×ÉÔØ Ë ÉÎÄÅËÓÕ&nbsp;%s&nbsp;ËÏÌÏÎÏËÕ(É)';
$strAddUser = 'äÏÂÁ×ÉÔØ ÎÏ×ÏÇÏ ÐÏÌØÚÏ×ÁÔÅÌÑ';
$strAddUserMessage = 'âÙÌÁ ÄÏÂÁ×ÌÅÎ ÎÏ×ÙÊ ÐÏÌØÚÏ×ÁÔÅÌØ.';
$strAffectedRows = 'úÁÔÒÏÎÕÔÙÅ ÒÑÄÙ:';
$strAfter = 'ðÏÓÌÅ %s';
$strAfterInsertBack = '÷ÏÚ×ÒÁÔ';
$strAfterInsertNewInsert = '÷ÓÔÁ×ÉÔØ ÎÏ×ÕÀ ÚÁÐÉÓØ';
$strAll = '÷ÓÅ';
$strAlterOrderBy = 'éÚÍÅÎÉÔØ ÐÏÒÑÄÏË ÔÁÂÌÉÃÙ';
$strAnalyzeTable = 'áÎÁÌÉÚ ÔÁÂÌÉÃÙ';
$strAnd = 'é';
$strAnIndex = 'âÙÌ ÄÏÂÁ×ÌÅÎ ÉÎÄÅËÓ ÄÌÑ %s';
$strAny = 'ìÀÂÏÊ';
$strAnyColumn = 'ìÀÂÁÑ ËÏÌÏÎËÁ';
$strAnyDatabase = 'ìÀÂÁÑ ÂÁÚÁ ÄÁÎÎÙÈ';
$strAnyHost = 'ìÀÂÏÊ ÈÏÓÔ';
$strAnyTable = 'ìÀÂÁÑ ÔÁÂÌÉÃÁ';
$strAnyUser = 'ìÀÂÏÊ ÐÏÌØÚÏ×ÁÔÅÌØ';
$strAPrimaryKey = 'âÙÌ ÄÏÂÁ×ÌÅÎ ÐÅÒ×ÉÞÎÙÊ ËÌÀÞ Ë %s';
$strAscending = '÷ÏÓÈÏÄÑÝÉÊ';
$strAtBeginningOfTable = '÷ ÎÁÞÁÌÏ ÔÁÂÌÉÃÙ';
$strAtEndOfTable = '÷ ËÏÎÅÃ ÔÁÂÌÉÃÙ';
$strAttr = 'áÔÒÉÂÕÔÙ';

$strBack = 'îÁÚÁÄ';
$strBinary = ' ä×ÏÉÞÎÙÊ ';
$strBinaryDoNotEdit = ' ä×ÏÉÞÎÙÅ ÄÁÎÎÙÅ - ÎÅ ÒÅÄÁËÔÉÒÕÀÔÓÑ ';
$strBookmarkDeleted = 'úÁËÌÁÄËÁ ÂÙÌÁ ÕÄÁÌÅÎÁ.';
$strBookmarkLabel = 'íÅÔËÁ';
$strBookmarkQuery = 'úÁËÌÁÄËÁ ÎÁ SQL-ÚÁÐÒÏÓ';
$strBookmarkThis = 'úÁËÌÁÄËÁ ÎÁ ÄÁÎÎÙÊ SQL-ÚÁÐÒÏÓ';
$strBookmarkView = 'ôÏÌØËÏ ÐÒÏÓÍÏÔÒ';
$strBrowse = 'ïÂÚÏÒ';
$strBzip = 'ÐÁËÏ×ÁÔØ × "bzip"';

$strCantLoadMySQL = 'ÒÁÓÛÉÒÅÎÉÅ MySQL ÎÅ ÚÁÇÒÕÖÅÎÎÏ,<br />ÐÒÏ×ÅÒØÔÅ ËÏÎÆÉÇÕÒÁÃÉÀ PHP.';
$strCantRenameIdxToPrimary = 'îÅ×ÏÚÍÏÚÍÏÖÎÏ ÐÅÒÅÉÍÅÎÏ×ÁÔØ ÉÎÄÅËÓ × PRIMARY!';
$strCarriage = '÷ÏÚ×ÒÁÔ ËÁÒÅÔËÉ: \\r';
$strCardinality = 'ëÏÌÉÞÅÓÔ×Ï ÜÌÅÍÅÎÔÏ×';
$strChange = 'éÚÍÅÎÉÔØ';
$strChangePassword = 'éÚÍÅÎÉÔØ ÐÁÒÏÌØ';
$strCheckAll = 'ïÔÍÅÔÉÔØ ×ÓÅ';
$strCheckDbPriv = 'ðÒÏ×ÅÒÉÔØ ðÒÉ×ÉÌÅÇÉÉ âÁÚÙ äÁÎÎÙÈ';
$strCheckTable = 'ðÒÏ×ÅÒÉÔØ ÔÁÂÌÉÃÕ';
$strColumn = 'ëÏÌÏÎËÁ';
$strColumnNames = 'îÁÚ×ÁÎÉÑ ËÏÌÏÎÏË';
$strCompleteInserts = 'ðÏÌÎÁÑ ×ÓÔÁ×ËÁ';
$strConfirm = '÷Ù ÄÅÊÓÔ×ÉÔÅÌØÎÏ ÈÏÔÉÔÅ ÓÄÅÌÁÔØ ÜÔÏ?';
$strCookiesRequired = 'Cookies ÄÏÌÖÎÙ ÂÙÔØ ×ËÌÀÞÅÎÙ ÐÏÓÌÅ ÜÔÏÇÏ ÍÅÓÔÁ.';
$strCopyTable = 'óËÏÐÉÒÏ×ÁÔØ ÔÁÂÌÉÃÕ × (ÂÁÚÁ ÄÁÎÎÙÈ<b>.</b>ÔÁÂÌÉÃÁ):';
$strCopyTableOK = 'ôÁÂÌÉÃÁ %s ÂÙÌÁ ÓËÏÐÉÒÏ×ÁÎÁ × %s.';
$strCreate = 'óÏÚÄÁÔØ';
$strCreateNewDatabase = 'óÏÚÄÁÔØ ÎÏ×ÕÀ âä';
$strCreateNewTable = 'óÏÚÄÁÔØ ÎÏ×ÕÀ ÔÁÂÌÉÃÕ × âä %s';
$strCreateIndex = 'óÏÚÄÁÔØ ÉÎÄÅËÓ ÎÁ&nbsp;%s&nbsp;ËÏÌÏÎËÁÈ';
$strCreateIndexTopic = 'óÏÚÄÁÔØ ÎÏ×ÙÊ ÉÎÄÅËÓ';
$strCriteria = 'ëÒÉÔÅÒÉÊ';

$strData = 'äÁÎÎÙÅ';
$strDatabase = 'âä ';
$strDatabaseHasBeenDropped = 'âÁÚÁ ÄÁÎÎÙÈ %s ÂÙÌÁ ÕÄÁÌÅÎÁ.';
$strDatabases = 'âÁÚÙ äÁÎÎÙÈ';
$strDatabasesStats = 'óÔÁÔÉÓÔÉËÁ ÂÁÚ ÄÁÎÎÙÈ';
$strDatabaseWildcard = 'âÁÚÁ ÄÁÎÎÙÈ (×ÏÚÍÏÖÎÏ ÉÓÐÏÌØÚÏ×ÁÎÉÅ  ÛÁÂÌÏÎÏ×):';
$strDataOnly = 'ôÏÌØËÏ ÄÁÎÎÙÅ';
$strDefault = 'ðÏ ÕÍÏÌÞÁÎÉÀ';
$strDelete = 'õÄÁÌÉÔØ';
$strDeleted = 'òÑÄ ÂÙÌ ÕÄÁÌÅÎ';
$strDeletedRows = 'óÌÅÄÕÀÝÉÅ ÒÑÄÙ ÂÙÌÉ ÕÄÁÌÅÎÙ:';
$strDeleteFailed = 'îÅÕÄÁÞÎÏÅ ÕÄÁÌÅÎÉÅ!';
$strDeleteUserMessage = 'âÙÌ ÕÄÁÌÅÎ ÐÏÌØÚÏ×ÁÔÅÌØ %s.';
$strDescending = 'îÉÓÈÏÄÑÝÉÊ';
$strDisplay = 'ðÏËÁÚÁÔØ';
$strDisplayOrder = 'ðÏÒÑÄÏË ÐÒÏÓÍÏÔÒÁ:';
$strDoAQuery = '÷ÙÐÏÌÎÉÔØ "ÚÁÐÒÏÓ ÐÏ ÐÒÉÍÅÒÕ" (ÓÉÍ×ÏÌ ÐÏÄÓÔÁ×ÎÏ×ËÉ: "%")';
$strDocu = 'äÏËÕÍÅÎÔÁÃÉÑ';
$strDoYouReally = '÷Ù ÄÅÊÓÔ×ÉÔÅÌØÎÏ ÖÅÌÁÅÔÅ ';
$strDrop = 'õÎÉÞÔÏÖÉÔØ';
$strDropDB = 'õÎÉÞÔÏÖÉÔØ âä %s';
$strDropTable = 'õÄÁÌÉÔØ ÔÁÂÌÉÃÕ';
$strDumpingData = 'äÁÍÐ ÄÁÎÎÙÈ ÔÁÂÌÉÃÙ';
$strDynamic = 'ÄÉÎÁÍÉÞÅÓËÉÊ';

$strEdit = 'ðÒÁ×ËÁ';
$strEditPrivileges = 'òÅÄÁËÔÉÒÏ×ÁÎÉÅ ÐÒÉ×ÉÌÅÇÉÊ';
$strEffective = 'üÆÆÅËÔÉ×ÎÏÓÔØ';
$strEmpty = 'ïÞÉÓÔÉÔØ';
$strEmptyResultSet = 'MySQL ×ÅÒÎÕÌÁ ÐÕÓÔÏÊ ÒÅÚÕÌØÔÁÔ (Ô.Å. ÎÏÌØ ÒÑÄÏ×).';
$strEnd = 'ëÏÎÅÃ';
$strEnglishPrivileges = ' ðÒÉÍÅÞÁÎÉÅ: ÐÒÉ×ÉÌÅÇÉÉ MySQL ÚÁÄÁÀÔÓÑ ÐÏ ÁÎÇÌÉÊÓËÉ ';
$strError = 'ïÛÉÂËÁ';
$strExtendedInserts = 'òÁÓÛÉÒÅÎÎÙÅ ×ÓÔÁ×ËÉ';
$strExtra = 'äÏÐÏÌÎÉÔÅÌØÎÏ';

$strField = 'ðÏÌÅ';
$strFieldHasBeenDropped = 'ðÏÌÅ %s ÂÙÌÏ ÕÄÁÌÅÎÏ';
$strFields = 'ðÏÌÑ';
$strFieldsEmpty = ' ðÕÓÔÏÊ ÓÞÅÔÞÉË ÐÏÌÅÊ! ';
$strFieldsEnclosedBy = 'ðÏÌÑ ÚÁËÌÀÞÅÎÙ ×';
$strFieldsEscapedBy = 'ðÏÌÑ ÜËÒÁÎÉÒÕÀÔÓÑ';
$strFieldsTerminatedBy = 'ðÏÌÑ ÒÁÚÄÅÌÅÎÙ';
$strFixed = 'ÆÉËÓÉÒÏ×ÁÎÎÙÊ';
$strFlushTable = 'óÂÒÏÓÉÔØ ËÜÛ ÔÁÂÌÉÃÙ ("FLUSH")';
$strFormat = 'æÏÒÍÁÔ';
$strFormEmpty = 'ôÒÅÂÕÅÔÓÑ ÚÎÁÞÅÎÉÅ ÄÌÑ ÆÏÒÍÙ!';
$strFullText = 'ðÏÌÎÙÅ ÔÅËÓÔÙ';
$strFunction = 'æÕÎËÃÉÑ';

$strGenTime = '÷ÒÅÍÑ ÓÏÚÄÁÎÉÑ';
$strGo = 'ðÏÛÅÌ';
$strGrants = 'ðÒÁ×Á';
$strGzip = 'ÐÁËÏ×ÁÔØ × "gzip"';

$strHasBeenAltered = 'ÂÙÌÁ ÉÚÍÅÎÅÎÁ.';
$strHasBeenCreated = 'ÂÙÌÁ ÓÏÚÄÁÎÁ.';
$strHome = 'ë ÎÁÞÁÌÕ';
$strHomepageOfficial = 'ïÆÉÃÉÁÌØÎÁÑ ÓÔÒÁÎÉÃÁ phpMyAdmin';
$strHomepageSourceforge = 'úÁÇÒÕÚËÁ phpMyAdmin ÎÁ Sourceforge';
$strHost = 'èÏÓÔ';
$strHostEmpty = 'ðÕÓÔÏÅ ÉÍÑ ÈÏÓÔÁ!';

$strIdxFulltext = 'ðÏÌÎôÅËÓÔ';
$strIfYouWish = 'åÓÌÉ ÷Ù ÖÅÌÁÅÔÅ ÚÁÇÒÕÚÉÔØ ÔÏÌØËÏ ÎÅËÏÔÏÒÙÅ ÓÔÏÌÂÃÙ ÔÁÂÌÉÃÙ, ÕËÁÖÉÔÅ ÒÁÚÄÅÌÅÎÎÙÊ ÚÁÐÑÔÙÍÉ ÓÐÉÓÏË ÐÏÌÅÊ.';
$strIgnore = 'éÇÎÏÒÉÒÏ×ÁÔØ';
$strIndex = 'éÎÄÅËÓ';
$strIndexes = 'éÎÄÅËÓÙ';
$strIndexHasBeenDropped = 'éÎÄÅËÓ %s ÂÙÌ ÕÄÁÌÅÎ';
$strIndexName = 'éÍÑ ÉÎÄÅËÓÁ&nbsp;:';
$strIndexType = 'ôÉÐ ÉÎÄÅËÓÁ&nbsp;:';
$strInsert = '÷ÓÔÁ×ÉÔØ';
$strInsertAsNewRow = '÷ÓÔÁ×ÉÔØ ÎÏ×ÙÊ ÒÑÄ';
$strInsertedRows = 'äÏÂÁ×ÌÅÎÎÙ ÒÑÄÙ:';
$strInsertNewRow = '÷ÓÔÁ×ÉÔØ ÎÏ×ÙÊ ÒÑÄ';
$strInsertTextfiles = '÷ÓÔÁ×ÉÔØ ÔÅËÓÔÏ×ÙÅ ÆÁÊÌÙ × ÔÁÂÌÉÃÕ';
$strInstructions = 'éÎÓÔÒÕËÃÉÉ';
$strInUse = 'ÉÓÐÏÌØÚÕÅÔÓÑ';
$strInvalidName = '"%s" - Ñ×ÌÑÅÔÓÑ ÚÁÒÅÚÅÒ×ÉÒÏ×ÁÎÎÙÍ ÓÌÏ×ÏÍ, ×Ù ÎÅ ÍÏÖÅÔÅ ÉÓÐÏÌØÚÏ×ÁÔØ ÅÇÏ × ËÁÞÅÓÔ×É ÉÍÅÎÉ ÂÁÚÙ ÄÁÎÎÙÈ/ÔÁÂÌÉÃÙ/ÐÏÌÑ.';

$strKeepPass = 'îÅ ÍÅÎÑÔØ ÐÁÒÏÌØ';
$strKeyname = 'éÍÑ ËÌÀÞÁ';
$strKill = 'õÂÉÔØ';

$strLength = 'äÌÉÎÎÁ';
$strLengthSet = 'äÌÉÎÙ/úÎÁÞÅÎÉÑ*';
$strLimitNumRows = 'ÚÁÐÉÓÅÊ ÎÁ ÓÔÒÁÎÉÃÕ';
$strLineFeed = 'óÉÍ×ÏÌ ÏËÏÎÞÁÎÉÑ ÌÉÎÉÉ: \\n';
$strLines = 'ìÉÎÉÉ';
$strLinesTerminatedBy = 'óÔÒÏËÉ ÒÁÚÄÅÌÅÎÙ';
$strLocationTextfile = 'íÅÓÔÏÒÁÓÐÏÌÏÖÅÎÉÅ ÔÅËÓÔÏ×ÏÇÏ ÆÁÊÌÁ';
$strLogin = '÷ÈÏÄ × ÓÉÓÔÅÍÕ';
$strLogout = '÷ÙÊÔÉ ÉÚ ÓÉÓÔÅÍÙ';
$strLogPassword = 'ðÁÒÏÌØ:';
$strLogUsername = 'ðÏÌØÚÏ×ÁÔÅÌØ:';

$strModifications = 'íÏÄÉÆÉËÁÃÉÉ ÂÙÌÉ ÓÏÈÒÁÎÅÎÙ';
$strModify = 'éÚÍÅÎÉÔØ';
$strModifyIndexTopic = 'éÚÍÅÎÉÔØ ÉÎÄÅËÓ';
$strMoveTable = 'ðÅÒÅÍÅÓÔÉÔØ ÔÁÂÌÉÃÙ × (ÂÁÚÁ ÄÁÎÎÙÈ<b>.</b>ÔÁÂÌÉÃÁ):';
$strMoveTableOK = 'ôÁÂÌÉÃÁ %s ÂÙÌÁ ÐÅÒÅÍÅÝÅÎÁ × %s.';
$strMySQLReloaded = 'MySQL ÐÅÒÅÚÁÇÒÕÖÅÎÁ.';
$strMySQLSaid = 'ïÔ×ÅÔ MySQL: ';
$strMySQLServerProcess = 'MySQL %pma_s1% ÎÁ %pma_s2% ËÁË %pma_s3%';
$strMySQLShowProcess = 'ðÏËÁÚÁÔØ ÐÒÏÃÅÓÓÙ';
$strMySQLShowStatus = 'ðÏËÁÚÁÔØ ÓÏÓÔÏÑÎÉÅ MySQL';
$strMySQLShowVars = 'ðÏËÁÚÁÔØ ÓÉÓÔÅÍÎÙÅ ÐÅÒÅÍÅÎÎÙÅ MySQL';

$strName = 'éÍÑ';
$strNbRecords = 'ÞÉÓÌÏ ÚÁÐÉÓÅÊ';
$strNext = 'äÁÌÅÅ';
$strNo = 'îÅÔ';
$strNoDatabases = 'âä ÏÔÓÕÔÓÔ×ÕÀÔ';
$strNoDropDatabases = 'ïÐÅÒÁÔÏÒÙ "DROP DATABASE" ÏÔËÌÀÞÅÎÙ.';
$strNoFrames = 'äÌÑ ÒÁÂÏÔÙ phpMyAdmin ÎÕÖÅÎ ÂÒÁÕÚÅÒ Ó ÐÏÄÄÅÒÖËÏÊ <b>ÆÒÅÊÍÏ×</b>.';
$strNoIndexPartsDefined = 'þÁÓÔÅÊ ÉÎÄÅËÓÁ ÎÅ ÏÐÒÅÄÅÌÅÎÏ!';
$strNoIndex = 'éÎÄÅËÓ ÎÅ ÏÐÒÅÄÅÌÅÎ!';
$strNoModification = 'îÅÔ ÉÚÍÅÎÅÎÉÊ';
$strNone = 'îÅÔ';
$strNoPassword = 'âÅÚ ÐÁÒÏÌÑ';
$strNoPrivileges = 'âÅÚ ÐÒÉ×ÉÌÅÇÉÊ';
$strNoQuery = 'îÅÔ SQL-ÚÁÐÒÏÓÁ!';
$strNoRights = '÷Ù ÎÅ ÉÍÅÅÔÅ ÄÏÓÔÁÔÏÞÎÏ ÐÒÁ× ÄÌÑ ÜÔÏÇÏ!';
$strNoTablesFound = '÷ âä ÎÅ ÏÂÎÁÒÕÖÅÎÏ ÔÁÂÌÉÃ.';
$strNotNumber = 'üÔÏ ÎÅ ÞÉÓÌÏ!';
$strNotValidNumber = ' ÎÅÄÏÐÕÓÔÉÍÏÅ ËÏÌÉÞÅÓÔ×Ï ÒÑÄÏ×!';
$strNoUsersFound = 'îÅ ÎÁÊÄÅÎ ÐÏÌØÚÏ×ÁÔÅÌØ.';
$strNull = 'îÏÌØ';

$strOftenQuotation = 'ïÂÙÞÎÏ ËÁ×ÙÞËÉ. ðï ÷ùâïòõ ÏÚÎÁÞÁÅÔ, ÞÔÏ ÔÏÌØËÏ ÐÏÌÑ char É varchar ÚÁËÌÀÞÁÀÔÓÑ × ËÁ×ÙÞËÉ.';
$strOptimizeTable = 'ïÐÔÉÍÉÚÉÒÏ×ÁÔØ ÔÁÂÌÉÃÕ';
$strOptionalControls = 'ðÏ ×ÙÂÏÒÕ. ëÏÎÔÒÏÌÉÒÕÅÔ ËÁË ÞÉÔÁÔØ ÉÌÉ ÐÉÓÁÔØ ÓÐÅÃÉÁÌØÎÙÅ ÓÉÍ×ÏÌÙ.';
$strOptionally = 'ðï ÷ùâïòõ';
$strOr = 'éÌÉ';
$strOverhead = 'îÁËÌÁÄÎÙÅ ÒÁÓÈÏÄÙ';

$strPartialText = 'þÁÓÔÉÞÎÙÅ ÔÅËÓÔÙ';
$strPassword = 'ðÁÒÏÌØ';
$strPasswordEmpty = 'ðÕÓÔÏÊ ÐÁÒÏÌØ!';
$strPasswordNotSame = 'ðÁÒÏÌÉ ÎÅ ÏÄÉÎÁËÏ×Ù!';
$strPHPVersion = '÷ÅÒÓÉÑ PHP';
$strPmaDocumentation = 'äÏËÕÍÅÎÔÁÃÉÑ ÐÏ phpMyAdmin';
$strPmaUriError = 'äÉÒÅËÔÉ×Á <tt>$cfgPmaAbsoluteUri</tt> ÄÏÌÖÎÁ ÂÙÔØ ÕÓÔÁÎÏ×ÌÅÎÁ × ÷ÁÛÅÍ ËÏÎÆÉÇÕÒÁÃÉÏÎÎÏÍ ÆÁÊÌÅ!';
$strPos1 = 'îÁÞÁÌÏ';
$strPrevious = 'îÁÚÁÄ';
$strPrimary = 'ðÅÒ×ÉÞÎÙÊ';
$strPrimaryKey = 'ðÅÒ×ÉÞÎÙÊ ËÌÀÞ';
$strPrimaryKeyName = 'éÍÑ ÐÅÒ×ÉÞÎÏÇÏ ËÌÀÞÁ ÄÏÌÖÎÏ ÂÙÔØ PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>ÄÏÌÖÎÏ</b> ÂÙÔØ ÉÍÅÎÅÍ <b>ÔÏÌØËÏ</b> ÐÅÒ×ÉÞÎÏÇÏ ËÌÀÞÁ!)';
$strPrimaryKeyHasBeenDropped = 'ðÅÒ×ÉÞÎÙÊ ËÌÀÞ ÂÙÌ ÕÄÁÌÅÎ';
$strPrintView = '÷ÅÒÓÉÑ ÄÌÑ ÐÅÞÁÔÉ';
$strPrivileges = 'ðÒÉ×ÉÌÅÇÉÉ';
$strProperties = 'ó×ÏÊÓÔ×Á';

$strQBE = 'úÁÐÒÏÓ ÐÏ ÐÒÉÍÅÒÕ';
$strQBEDel = 'õÄÁÌÉÔØ';
$strQBEIns = '÷ÓÔÁ×ÉÔØ';
$strQueryOnDb = 'SQL-ÚÁÐÒÏÓ âä <b>%s</b>:';

$strRecords = 'úÁÐÉÓÉ';
$strReferentialIntegrity = 'ðÒÏ×ÅÒÉÔØ ÃÅÌÏÓÔÎÏÓÔØ ÄÁÎÎÙÈ:';
$strReloadFailed = 'îÅ ÕÄÁÌÏÓØ ÐÅÒÅÚÁÇÒÕÚÉÔØ MySQL.';
$strReloadMySQL = 'ðÅÒÅÚÁÇÒÕÚÉÔØ MySQL';
$strRememberReload = 'îÅ ÚÁÂÕÄØÔÅ ÐÅÒÅÚÁÇÒÕÚÉÔØ ÓÅÒ×ÅÒ.';
$strRenameTable = 'ðÅÒÅÉÍÅÎÏ×ÁÔØ ÔÁÂÌÉÃÕ ×';
$strRenameTableOK = 'ôÁÂÌÉÃÁ %s ÂÙÌÁ ÐÅÒÅÉÍÅÎÏ×ÁÎÁ × %s';
$strRepairTable = 'ðÏÞÉÎÉÔØ ÔÁÂÌÉÃÕ';
$strReplace = 'úÁÍÅÓÔÉÔØ';
$strReplaceTable = 'úÁÍÅÓÔÉÔØ ÄÁÎÎÙÅ ÔÁÂÌÉÃÙ ÄÁÎÎÙÍÉ ÉÚ ÆÁÊÌÁ';
$strReset = 'ðÅÒÅÕÓÔÁÎÏ×ÉÔØ';
$strReType = 'ðÏÄÔ×ÅÒÖÄÅÎÉÅ';
$strRevoke = 'ïÔÍÅÎÉÔØ';
$strRevokeGrant = 'ïÔÍÅÎÉÔØ ÐÒÅÄÏÓÔÁ×ÌÅÎÉÅ ÐÒÁ×';
$strRevokeGrantMessage = 'âÙÌÏ ÏÔÍÅÎÅÎÏ ÐÒÅÄÏÓÔÁ×ÌÅÎÉÅ ÐÒÁ× ÄÌÑ %s';
$strRevokeMessage = '÷Ù ÉÚÍÅÎÉÌÉ ÐÒÉ×ÅÌÅÇÉÉ ÄÌÑ %s';
$strRevokePriv = 'ïÔÍÅÎÉÔØ ÐÒÉ×ÉÌÅÇÉÉ';
$strRowLength = 'äÌÉÎÁ ÒÑÄÁ';
$strRows = 'òÑÄÙ';
$strRowsFrom = 'ÒÑÄÏ× ÏÔ';
$strRowSize = ' òÁÚÍÅÒ ÒÑÄÁ ';
$strRowsModeHorizontal = 'ÇÏÒÉÚÏÎÔÁÌØÎÏÍ';
$strRowsModeOptions = '× %s ÒÅÖÉÍÅ, ÚÁÇÏÌÏ×ËÉ ÐÏÓÌÅ ËÁÖÄÙÈ %s ÑÞÅÅË';
$strRowsModeVertical = '×ÅÒÔÉËÁÌØÎÏÍ';
$strRowsStatistic = 'óÔÁÔÉÓÔÉËÁ ÒÑÄÁ';
$strRunning = 'ÎÁ %s';
$strRunQuery = '÷ÙÐÏÌÎÉÔØ úÁÐÒÏÓ';
$strRunSQLQuery = '÷ÙÐÏÌÎÉÔØ SQL ÚÁÐÒÏÓ(Ù) ÎÁ âä %Ù';

$strSave = 'óÏÈÒÁÎÉÔØ';
$strSelect = '÷ÙÂÒÁÔØ';
$strSelectADb = '÷ÙÂÅÒÉÔÅ âä';
$strSelectAll = 'ïÔÍÅÔÉÔØ ×ÓÅ';
$strSelectFields = '÷ÙÂÒÁÔØ ÐÏÌÑ (ÍÉÎÉÍÕÍ ÏÄÎÏ):';
$strSelectNumRows = 'ÐÏ ÚÁÐÒÏÓÕ';
$strSend = 'ÐÏÓÌÁÔØ';
$strServerChoice = '÷ÙÂÏÒ ÓÅÒ×ÅÒÁ';
$strServerVersion = '÷ÅÒÓÉÑ ÓÅÒ×ÅÒÁ';
$strSetEnumVal = 'äÌÑ ÔÉÐÏ× ÐÏÌÑ "enum" É "set", ××ÅÄÉÔÅ ÚÎÁÞÅÎÉÑ ÐÏ ÜÔÏÍÕ ÆÏÒÍÁÔÕ: \'a\',\'b\',\'c\'...<br />åÓÌÉ ×ÁÍ ÐÏÎÁÄÏÂÉÔØÓÑ ××ÅÓÔÉ ÏÂÒÁÔÎÕÀ ËÏÓÕÀ ÞÅÒÔÕ ("\"") ÉÌÉ ÏÄÉÎÏÞÎÕÀ ËÁ×ÙÞËÕ ("\'") ÓÒÅÄÉ ÜÔÉÈ ÚÎÁÞÅÎÉÊ, ÐÏÓÔÁ×ØÔÅ ÐÅÒÅÄ ÎÉÍÉ ÏÂÒÁÔÎÕÀ ËÏÓÕÀ ÞÅÒÔÕ (ÎÁÐÒÉÍÅÒ, \'\\\\xyz\' ÉÌÉ \'a\\\'b\').';
$strShow = 'ðÏËÁÚÁÔØ';
$strShowAll = 'ðÏËÁÚÁÔØ ×ÓÅ';
$strShowCols = 'ðÏËÁÚÁÔØ ËÏÌÏÎËÉ';
$strShowingRecords = 'ðÏËÁÚÙ×ÁÅÔ ÚÁÐÉÓÉ ';
$strShowPHPInfo = 'ðÏËÁÚÁÔØ ÉÎÆÏÒÍÁÃÉÀ Ï PHP';
$strShowTables = 'ðÏËÁÚÁÔØ ÔÁÂÌÉÃÙ';
$strShowThisQuery = ' ðÏËÁÚÁÔØ ÄÁÎÎÙÊ ÚÁÐÒÏÓ ÓÎÏ×Á ';
$strSingly = '(ÏÔÄÅÌØÎÏ)';
$strSize = 'òÁÚÍÅÒ';
$strSort = 'ïÔÓÏÒÔÉÒÏ×ÁÔØ';
$strSpaceUsage = 'éÓÐÏÌØÚÕÅÍÏÅ ÐÒÏÓÔÒÁÎÓÔ×Ï';
$strSQLQuery = 'SQL-ÚÁÐÒÏÓ';
$strStartingRecord = 'îÁÞÉÎÁÔØ Ó ÚÁÐÉÓÉ';
$strStatement = 'ðÁÒÁÍÅÔÒ'; // ???To translate
$strStrucCSV = 'CSV ÄÁÎÎÙÅ';
$strStrucData = 'óÔÒÕËÔÕÒÁ É ÄÁÎÎÙÅ';
$strStrucDrop = 'äÏÂÁ×ÉÔØ ÕÄÁÌÅÎÉÅ ÔÁÂÌÉÃÙ';
$strStrucExcelCSV = 'CSV ÄÌÑ ÄÁÎÎÙÈ Ms Excel';
$strStrucOnly = 'ôÏÌØËÏ ÓÔÒÕËÔÕÒÕ';
$strSubmit = '÷ÙÐÏÌÎÉÔØ';
$strSuccess = '÷ÁÛ SQL-ÚÁÐÒÏÓ ÂÙÌ ÕÓÐÅÛÎÏ ×ÙÐÏÌÎÅÎ';
$strSum = '÷ÓÅÇÏ';

$strTable = 'ÔÁÂÌÉÃÁ ';
$strTableComments = 'ëÏÍÍÅÎÔÁÒÉÊ Ë ÔÁÂÌÉÃÅ';
$strTableEmpty = 'ðÕÓÔÏÅ ÎÁÚ×ÁÎÉÅ ÔÁÂÌÉÃÙ!';
$strTableHasBeenDropped = 'ôÁÂÌÉÃÁ %s ÂÙÌÁ ÕÄÁÌÅÎÁ';
$strTableHasBeenEmptied = 'ôÁÂÌÉÃÁ %s ÂÙÌÁ ÏÐÕÓÔÏÛÅÎÁ';
$strTableHasBeenFlushed = 'âÙÌ ÓÂÒÏÛÅÎ ËÜÛ ÔÁÂÌÉÃÙ %s';
$strTableMaintenance = 'ïÂÓÌÕÖÉ×ÁÎÉÅ ÔÁÂÌÉÃÙ';
$strTables = '%s ÔÁÂÌÉÃ(Ù)';
$strTableStructure = 'óÔÒÕËÔÕÒÁ ÔÁÂÌÉÃÙ';
$strTableType = 'ôÉÐ ÔÁÂÌÉÃÙ';
$strTextAreaLength = ' éÚ-ÚÁ ÂÏÌØÛÏÊ ÄÌÉÎÙ,<br /> ÜÔÏ ÐÏÌÅ ÎÅ ÍÏÖÅÔ ÂÙÔØ ÏÔÒÅÄÁËÔÉÒÏ×ÁÎÎÏ ';
$strTheContent = 'óÏÄÅÒÖÉÍÏÅ ÆÁÊÌÁ ÂÙÌÏ ÉÍÐÏÒÔÉÒÏ×ÁÎÏ.';
$strTheContents = 'óÏÄÅÒÖÉÍÏÅ ÆÁÊÌÁ ÚÁÍÅÝÁÅÔ ÓÏÄÅÒÖÉÍÏÅ ÔÁÂÌÉÃÙ ÄÌÑ ÒÑÄÏ× Ó ÉÄÅÎÔÉÞÎÙÍÉ ÐÅÒ×ÉÞÎÙÍÉ ÉÌÉ ÕÎÉËÁÌØÎÙÍÉ ËÌÀÞÁÍÉ.';
$strTheTerminator = 'óÉÍ×ÏÌ ÏËÏÎÞÁÎÉÑ ÐÏÌÅÊ.';
$strTotal = '×ÓÅÇÏ';
$strType = 'ôÉÐ';

$strUncheckAll = 'óÎÑÔØ ÏÔÍÅÔËÕ ÓÏ ×ÓÅÈ';
$strUnique = 'õÎÉËÁÌØÎÏÅ';
$strUnselectAll = 'óÎÑÔØ ÏÔÍÅÔËÕ ÓÏ ×ÓÅÈ';
$strUpdatePrivMessage = 'âÙÌÉ ÉÚÍÅÎÅÎÙ ÐÒÉ×ÉÌÅÇÉÉ ÄÌÑ';
$strUpdateProfile = 'ïÂÎÏ×ÉÔØ ÐÒÏÆÉÌØ:';
$strUpdateProfileMessage = 'ðÒÏÆÉÌØ ÂÙÌ ÏÂÎÏ×ÌÅÎ.';
$strUpdateQuery = 'äÏÐÏÌÎÉÔØ úÁÐÒÏÓ';
$strUsage = 'éÓÐÏÌØÚÏ×ÁÎÉÅ';
$strUseBackquotes = 'ïÂÒÁÔÎÙÅ ËÁ×ÙÞËÉ × ÎÁÚ×ÁÎÉÑÈ ÔÁÂÌÉÃ É ÐÏÌÅÊ';
$strUser = 'ðÏÌØÚÏ×ÁÔÅÌØ';
$strUserEmpty = 'ðÕÓÔÏÅ ÉÍÑ ÐÏÌØÚÏ×ÁÔÅÌÑ!';
$strUserName = 'éÍÑ ÐÏÌØÚÏ×ÁÔÅÌÑ';
$strUsers = 'ðÏÌØÚÏ×ÁÔÅÌÉ';
$strUseTables = 'éÓÐÏÌØÚÏ×ÁÔØ ÔÁÂÌÉÃÙ';

$strValue = 'úÎÁÞÅÎÉÅ';
$strViewDump = 'ðÒÏÓÍÏÔÒÅÔØ ÄÁÍÐ (ÓÈÅÍÕ) ÔÁÂÌÉÃÙ';
$strViewDumpDB = 'ðÒÏÓÍÏÔÒÅÔØ ÄÁÍÐ (ÓÈÅÍÕ) âä';

$strWelcome = 'äÏÂÒÏ ÐÏÖÁÌÏ×ÁÔØ × %s';
$strWithChecked = 'ó ÏÔÍÅÞÅÎÎÙÍÉ:';
$strWrongUser = 'ïÛÉÂÏÞÎÙÊ ÌÏÇÉÎ/ÐÁÒÏÌØ. ÷ ÄÏÓÔÕÐÅ ÏÔËÁÚÁÎÏ.';

$strYes = 'äÁ';

$strZip = 'ÕÐÁËÏ×ÁÔØ × "zip"';

// To translate
?>
