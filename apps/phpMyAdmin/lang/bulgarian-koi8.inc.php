<?php
/* $Id: bulgarian-koi8.inc.php,v 1.23 2002/04/20 13:37:49 loic1 Exp $ */

/**
 * Translated by Georgi Georgiev <chutz at chubaka.homeip.net>
 */

$charset = 'koi8-r';
$text_dir = 'ltr';
$left_font_family = 'sans-serif';
$right_font_family = 'sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('ÂÁÊÔÁ', 'KB', 'MB', 'GB');

$day_of_week = array('ÎÅÄ', 'ÐÏÎ', '×Ô', 'ÓÒ', 'ÞÅÔ', 'ÐÅÔ', 'ÓßÂ');
$month = array('ÑÎÕÁÒÉ', 'ÆÅ×ÒÕÁÒÉ', 'ÍÁÒÔ', 'ÁÐÒÉÌ', 'ÍÁÊ', 'ÀÎÉ', 'ÀÌÉ', 'Á×ÇÕÓÔ', 'ÓÅÐÔÅÍ×ÒÉ', 'ÏËÏÍ×ÒÉ', 'ÎÏÅÍ×ÒÉ', 'ÄÅËÅÍ×ÒÉ');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%e %B %Y × %H:%M';


$strAccessDenied = 'ïÔËÁÚÁÎ ÄÏÓÔßÐ';
$strAction = 'äÅÊÓÔ×ÉÅ';
$strAddDeleteColumn = 'äÏÂÁ×É/ÉÚÔÒÉÊ ËÏÌÏÎÁ ÐÏ ËÒÉÔÅÒÉÊ';
$strAddDeleteRow = 'äÏÂÁ×É/ÉÚÔÒÉÊ ÒÅÄ ÐÏ ËÒÉÔÅÒÉÊ';
$strAddNewField = 'äÏÂÁ×É ÎÏ×Ï ÐÏÌÅ';
$strAddPriv = 'äÏÂÁ×ÑÎÅ ÎÁ ÎÏ×Á ÐÒÉ×ÉÌÅÇÉÑ';
$strAddPrivMessage = '÷ÉÅ ÄÏÂÁ×ÉÈÔÅ ÎÏ×Á ÐÒÉ×ÉÌÅÇÉÑ.';
$strAddSearchConditions = 'äÏÂÁ×É ÕÓÌÏ×ÉÅ ÚÁ ÔßÒÓÅÎÅ (ÔÑÌÏ ÚÁ "where" ÕÓÌÏ×ÉÅ):';
$strAddToIndex = ' &nbsp;%s&nbsp;ËÏÌÏÎÁ(É) ÂÑÈÁ ÄÏÂÁ×ÅÎÉ ËßÍ ÉÎÄÅËÓÁ ';
$strAddUser = 'äÏÂÁ×ÑÎÅ ÎÁ ÎÏ× ÐÏÔÒÅÂÉÔÅÌ.';
$strAddUserMessage = '÷ÉÅ ÄÏÂÁ×ÉÈÔÅ ÎÏ× ÐÏÔÒÅÂÉÔÅÌ.';
$strAffectedRows = 'úÁÓÅÇÎÁÔÉ ÒÅÄÁ:';
$strAfter = 'óÌÅÄ %s';
$strAfterInsertBack = 'ÓÅ ×ßÒÎÉ';
$strAfterInsertNewInsert = '×ÍßËÎÉ ÎÏ× ÚÁÐÉÓ';
$strAll = '×ÓÉÞËÉ';
$strAlterOrderBy = 'ðÏÄÒÅÄÉ ÔÁÂÌÉÃÁÔÁ ÐÏ';
$strAnalyzeTable = 'áÎÁÌÉÚÉÒÁÎÅ ÎÁ ÔÁÂÌÉÃÁÔÁ';
$strAnd = 'É';
$strAnIndex = 'âÅÛÅ ÄÏÂÁ×ÅÎ ÉÎÄÅËÓ ÎÁ %s';
$strAny = '×ÓÅËÉ';
$strAnyColumn = '÷ÓÑËÁ ËÏÌÏÎÁ';
$strAnyDatabase = '÷ÓÑËÁ ÂÁÚÁ ÄÁÎÎÉ';
$strAnyHost = '÷ÓÅËÉ ÈÏÓÔ';
$strAnyTable = '÷ÓÑËÁ ÔÁÂÌÉÃÁ';
$strAnyUser = '÷ÓÅËÉ ÐÏÔÒÅÂÉÔÅÌ';
$strAPrimaryKey = 'âeÛe ÄÏÂÁ×ÅÎ ÇÌÁ×ÅÎ ËÌÀÞ ËßÍ ';
$strAscending = '÷ßÚÈÏÄÑÝÏ';
$strAtBeginningOfTable = 'ÏÔ ÎÁÞÁÌÏÔÏ ÎÁ ÔÁÂÌÉÃÁÔÁ';
$strAtEndOfTable = 'ÏÔ ËÒÁÑ ÎÁ ÔÁÂÌÉÃÁÔÁ';
$strAttr = 'áÔÒÉÂÕÔÉ';

$strBack = 'îÁÚÁÄ';
$strBinary = ' ä×ÏÉÞÎÏ ';
$strBinaryDoNotEdit = ' ä×ÏÉÞÎÏ - ÎÅ ÓÅ ÒÅÄÁËÔÉÒÁ ';
$strBookmarkDeleted = 'Bookmark ÂÅÛÅ ÉÚÔÒÉÔ.';
$strBookmarkLabel = 'åÔÉËÅÔ';
$strBookmarkQuery = 'úÁÐÁÚ×ÁÍÅ ÎÁ SQL-ÚÁÐÉÔ×ÁÎÅ';
$strBookmarkThis = 'úÁÐÁÚÉ ÔÏ×Á SQL-ÚÁÐÉÔ×ÁÎÅ';
$strBookmarkView = 'óÁÍÏ ÐÏËÁÚ×ÁÎÅ';
$strBrowse = 'ðÒÅÌÉÓÔÉ';
$strBzip = '"bzip-ÎÁÔÏ"';

$strCantLoadMySQL = 'îÅ ÍÏÇÁ ÄÁ ÚÁÒÅÄÑ MySQL ÒÁÚÛÉÒÅÎÉÑÔÁ,<br />ÍÏÌÑ ÐÒÏ×ÅÒÅÔÅ ËÏÎÆÉÇÕÒÁÃÉÑÔÁ ÎÁ PHP.';
$strCantRenameIdxToPrimary = 'îÅ ÍÏÇÁ ÄÁ ÐÒÅÉÍÅÎÕ×ÁÍ ÉÎÄÅËÓÁ ÎÁ PRIMARY!';
$strCardinality = 'ÎÁÄÅÖÄÎÏÓÔ';
$strCarriage = 'óÉÍ×ÏÌ ÚÁ ËÒÁÊ ÎÁ ÒÅÄ: \\r';
$strChange = 'ðÒÏÍÅÎÉ';
$strChangePassword = 'óÍÑÎÁ ÎÁ ÐÁÒÏÌÁÔÁ';
$strCheckAll = 'íÁÒËÉÒÁÊ ×ÓÉÞËÏ';
$strCheckDbPriv = 'ðÒÏ×ÅÒÉ ÐÒÉ×ÉÌÅÇÉÉÔÅ ÎÁ âä';
$strCheckTable = 'ðÒÏ×ÅÒËÁ ÎÁ ÔÁÂÌÉÃÁÔÁ';
$strColumn = 'ëÏÌÏÎÁ';
$strColumnNames = 'éÍÅ ÎÁ ËÏÌÏÎÁ';
$strCompleteInserts = 'ðßÌÎÉ INSERT-É';
$strConfirm = 'äÅÊÓÔ×ÉÔÅÌÎÏ ÌÉ ÖÅÌÁÅÔÅ ÄÁ ÇÏ ÎÁÐÒÁ×ÉÔÅ?';
$strCookiesRequired = 'ïÔÔÕË ÎÁÔÁÔßË ÓÁ ÎÅÏÂÈÏÄÉÍÉ "Cookies".';
$strCopyTable = 'ëÏÐÉÒÁÎÅ ÎÁ ÔÁÂÌÉÃÁ (ÂÁÚÁ ÏÔ ÄÁÎÎÉ<b>.</b>ÔÁÂÌÉÃÁ):';
$strCopyTableOK = 'ôÁÂÌÉÃÁ %s ÂÅÛÅ ËÏÐÉÒÁÎÁ × %s.';
$strCreate = 'óßÚÄÁÊ';
$strCreateIndex = 'óßÚÄÁÊ ÉÎÄÅËÓ ×ßÒÈÕ &nbsp;%s&nbsp;ËÏÌÏÎÉ';
$strCreateIndexTopic = 'óßÚÄÁÊ ÎÏ× ÉÎÄÅËÓ';
$strCreateNewDatabase = 'óßÚÄÁÊ ÎÏ×Á âä';
$strCreateNewTable = 'óßÚÄÁÊ ÎÏ×Á ÔÁÂÌÉÃÁ × âä %s';
$strCriteria = 'ëÒÉÔÅÒÉÊ';

$strData = 'äÁÎÎÉ';
$strDatabase = ' âä ';
$strDatabaseHasBeenDropped = 'âÁÚÁÔÁ ÄÁÎÎÉ %s ÂÅÛÅ ÉÚÔÒÉÔÁ.';
$strDatabases = 'âÁÚÉ ÏÔ äÁÎÎÉ';
$strDatabasesStats = ' óÔÁÔÉÓÔÉËÁ ÚÁ ÂÁÚÉÔÅ ÄÁÎÎÉ';
$strDatabaseWildcard = 'âÁÚÁ ÄÁÎÎÉ (ÍÏÖÅ É Ó wildcard):';
$strDataOnly = 'óÁÍÏ ÄÁÎÎÉ';
$strDefault = 'ðÏ ÐÏÄÒÁÚÂÉÒÁÎÅ';
$strDelete = 'éÚÔÒÉÊ';
$strDeleted = 'òÅÄßÔ ÂÅÛÅ ÉÚÔÒÉÔ';
$strDeletedRows = 'éÚÔÒÉÔÉ ÒÅÄÏ×Å:';
$strDeleteFailed = 'îÅÕÓÐÅÛÎÏ ÉÚÔÒÉ×ÁÎÅ!';
$strDeleteUserMessage = '÷ÉÅ ÉÚÔÒÉÈÔÅ ÐÏÔÒÅÂÉÔÅÌ %s.';
$strDescending = 'îÉÚÈÏÄÑÝÏ';
$strDisplay = 'ðÏËÁÖÉ';
$strDisplayOrder = 'ðÏËÁÖÉ ÐÏÄÒÅÄÂÁ:';
$strDoAQuery = 'éÚÐßÌÎÉ "ÚÁÐÉÔ×ÁÎÅ ÐÏ ÚÁÑ×ËÁ" (ÓÉÍ×ÏÌ ÚÁ  ÚÁÍÅÓÔ×ÁÎÅ: "%")';
$strDocu = 'äÏËÕÍÅÎÔÁÃÉÑ';
$strDoYouReally = 'äÅÊÓÔ×ÉÔÅÌÎÏ ÌÉ ÖÅÌÁÅÔÅ ÄÁ';
$strDrop = 'õÎÉÝÏÖÉ';
$strDropDB = 'õÎÉÝÏÖÉ âä %s';
$strDropTable = 'éÚÔÒÉÊ ÔÁÂÌÉÃÁÔÁ';
$strDumpingData = 'äßÍÐ (ÓÈÅÍÁ) ÎÁ ÄÁÎÎÉÔÅ × ÔÁÂÌÉÃÁÔÁ';
$strDynamic = 'ÄÉÎÁÍÉÞÅÎ';

$strEdit = 'òÅÄÁËÔÉÒÁÎÅ';
$strEditPrivileges = 'òÅÄÁËÔÉÒÁÎÅ ÎÁ ÐÒÉ×ÉÌÅÇÉÉÔÅ';
$strEffective = 'åÆÅËÔÉ×ÎÉ';
$strEmpty = 'éÚÐÒÁÚÎÉ';
$strEmptyResultSet = 'MySQL ×ßÒÎÁ ÐÒÁÚÅÎ ÒÅÚÕÌÔÁÔ (Ô.Å. ÎÕÌÁ ÒÅÄÏ×Å).';
$strEnd = 'ëÒÁÊ';
$strEnglishPrivileges = ' úÁÂÅÌÅÖËÁ: éÍÅÎÁÔÁ ÎÁ ÐÒÉ×ÉÌÅÇÉÉÔÅ ÎÁ MySQL ÓÁ ÐÏËÁÚÁÎÉ ÎÁ ÁÎÇÌÉÊÓËÉ. ';
$strError = 'çÒÅÛËÁ';
$strExtendedInserts = 'òÁÚÛÉÒÅÎÉ INSERT-É';
$strExtra = 'äÏÐßÌÎÉÔÅÌÎÏ';

$strField = 'ðÏÌÅ';
$strFieldHasBeenDropped = 'ðÏÌÅÔÏ %s ÂÅÛÅ ÉÚÔÒÉÔÏ';
$strFields = 'ðÏÌÅÔÁ';
$strFieldsEmpty = ' âÒÏÑÞÁ ÎÁ ÐÏÌÅÔÁÔÁ Å ÐÒÁÚÅÎ! ';
$strFieldsEnclosedBy = 'ðÏÌÅÔÁÔÁ ÓÁ ÏÇÒÁÄÅÎÉ ÓßÓ';
$strFieldsEscapedBy = 'ðÒÅÄÓÔÁ×ËÁ ÐÒÅÄ ÓÐÅÃÉÁÌÎÉÔÅ ÓÉÍ×ÏÌÉ';
$strFieldsTerminatedBy = 'ðÏÌÅÔÁÔÁ ÚÁ×ßÒÛ×ÁÔ ÓßÓ';
$strFixed = 'æÉËÓÉÒÁÎ';
$strFlushTable = 'éÚÐÒÁÚÎÉ ËÅÛÁ ÎÁ ÔÁÂÌÉÃÁÔÁ ("FLUSH")';
$strFormat = 'æÏÒÍÁÔ';
$strFormEmpty = 'ìÉÐÓ×Á ÓÔÏÊÎÏÓÔ ×ß× ÆÏÒÍÁÔÁ!';
$strFullText = 'ðßÌÎÉ ÔÅËÓÔÏ×Å';
$strFunction = 'æÕÎËÃÉÑ';

$strGenTime = '÷ÒÅÍÅ ÎÁ ÇÅÎÅÒÉÒÁÎÅ';
$strGo = 'éÚÐßÌÎÉ';
$strGrants = 'Grant&nbsp;ÐÒÉ×.';
$strGzip = '"gzip-ÎÁÔÏ"';

$strHasBeenAltered = 'ÂÅÛÅ ÐÒÏÍÅÎÅÎÁ.';
$strHasBeenCreated = 'ÂÅÛÅ ÓßÚÄÁÄÅÎÁ.';
$strHome = 'îÁÞÁÌÏ';
$strHomepageOfficial = 'ïÆÉÃÉÁÌÎÁ phpMyAdmin ÕÅÂ ÓÔÒÁÎÉÃÁ';
$strHomepageSourceforge = 'phpMyAdmin ÓÔÒÁÎÉÃÁ ÎÁ Sourceforge';
$strHost = 'èÏÓÔ';
$strHostEmpty = 'éÍÅÔÏ ÎÁ ÈÏÓÔÁ Å ÐÒÁÚÎÏ!';

$strIdxFulltext = 'ðßÌÎÏÔÅËÓÔÏ×Ï';
$strIfYouWish = 'áËÏ ÖÅÌÁÅÔÅ ÄÁ ÚÁÒÅÄÉÔÅ ÓÁÍÏ ÎÑËÏÉ ËÏÌÏÎÉ ÏÔ ÔÁÂÌÉÃÁÔÁ, ÕËÁÖÅÔÅ ÓÐÉÓßË ÎÁ ÐÏÌÅÔÁÔÁ ÒÁÚÄÅÌÅÎÉ ÓßÓ ÚÁÐÅÔÁÉ.';
$strIgnore = 'éÇÎÏÒÉÒÁÊ';
$strIndex = 'éÎÄÅËÓ';
$strIndexes = 'éÎÄÅËÓÉ';
$strIndexHasBeenDropped = 'éÎÄÅËÓÁ %s ÂÅÛÅ ÉÚÔÒÉÔ';
$strIndexName = 'éÍÅ ÎÁ ÉÎÄÅËÓÁ&nbsp;:';
$strIndexType = 'ôÉÐ ÎÁ ÉÎÄÅËÓÁ&nbsp;:';
$strInsert = '÷ÍßËÎÉ';
$strInsertAsNewRow = '÷ÍßËÎÉ ËÁÔÏ ÎÏ× ÒÅÄ';
$strInsertedRows = '÷ÍßËÎÁÔÉ ÒÅÄÁ:';
$strInsertNewRow = '÷ÍßËÎÉ ÎÏ× ÒÅÄ';
$strInsertTextfiles = '÷ÍßËÎÉ ÔÅËÓÔÏ×É ÆÁÊÌÏ×Å × ÔÁÂÌÉÃÁÔÁ';
$strInstructions = 'éÎÓÔÒÕËÃÉÉ';
$strInUse = 'úÁÅÔÏ';
$strInvalidName = '"%s" Å ÚÁÐÁÚÁÎÁ ÄÕÍÁ É ×ÉÅ ÎÅ ÍÏÖÅÔÅ ÄÁ Ñ ÉÚÐÏÌÚ×ÁÔÅ ÚÁ ÉÍÅ ÎÁ ÂÁÚÁ ÏÔ ÄÁÎÎÉ,ÔÁÂÌÉÃÁ ÉÌÉ ÐÏÌÅ. ';

$strKeepPass = 'äÁ ÎÅ ÓÅ ÓÍÅÎÑ ÐÁÒÏÌÁÔÁ';
$strKeyname = 'éÍÅ ÎÁ ËÌÀÞÁ';
$strKill = 'óôïð';

$strLength = 'äßÌÖÉÎÁ';
$strLengthSet = 'äßÌÖÉÎÁ/óÔÏÊÎÏÓÔ*';
$strLimitNumRows = 'ÒÅÄÁ ÎÁ ÓÔÒÁÎÉÃÁ';
$strLineFeed = 'óÉÍ×ÏÌ ÚÁ ËÒÁÊ ÎÁ ÒÅÄ: \\n';
$strLines = 'òÅÄÏ×Å';
$strLinesTerminatedBy = 'ìÉÎÉÉÔÅ ÚÁ×ßÒÛ×ÁÔ Ó';
$strLocationTextfile = 'íÅÓÔÏÐÏÌÏÖÅÎÉÅ ÎÁ ÔÅËÓÔÏ×ÉÑ ÆÁÊÌ';
$strLogin = '÷ÈÏÄ';
$strLogout = 'éÚÈÏÄ ÏÔ ÓÉÓÔÅÍÁÔÁ';
$strLogPassword = 'ðÁÒÏÌÁ:';
$strLogUsername = 'éÍÅ:';

$strModifications = 'ðÒÏÍÅÎÉÔÅ ÂÑÈÁ ÓßÈÒÁÎÅÎÉ';
$strModify = 'ðÒÏÍÅÎÉ';
$strModifyIndexTopic = 'ðÒÏÍÑÎÁ ÎÁ ÉÎÄÅËÓ';
$strMoveTable = 'ðÒÅÍÅÓÔ×ÁÎÅ ÎÁ ÔÁÂÌÉÃÁ ËßÍ (ÂÁÚÁ ÏÔ ÄÁÎÎÉ<b>.</b>ÔÁÂÌÉÃÁ):';
$strMoveTableOK = 'ôÁÂÌÉÃÁÔÁ %s ÂÅÛÅ ÐÒÅÍÅÓÔÅÎÁ ËßÍ %s.';
$strMySQLReloaded = 'MySQL Å ÐÒÅÚÁÒÅÄÅÎ.';
$strMySQLSaid = 'MySQL ÏÔÇÏ×ÏÒÉ: ';
$strMySQLServerProcess = 'MySQL %pma_s1% Å ÓÔÁÒÔÉÒÁÎ ÎÁ %pma_s2% ËÁÔÏ %pma_s3%';
$strMySQLShowProcess = 'ðÏËÁÖÉ ÐÒÏÃÅÓÉÔÅ';
$strMySQLShowStatus = 'ðÏËÁÖÉ ÓßÓÔÏÑÎÉÅÔÏ ÎÁ MySQL';
$strMySQLShowVars = 'ðÏËÁÖÉ ÓÉÓÔÅÍÎÉÔÅ ÐÒÏÍÅÎÌÉ×É ÎÁ MySQL';

$strName = 'éÍÅ';
$strNbRecords = 'âÒÏÊ ÚÁÐÉÓÉ';
$strNext = 'óÌÅÄ×ÁÝ';
$strNo = 'ÎÅ';
$strNoDatabases = 'îÑÍÁ ÂÁÚÉ ÏÔ ÄÁÎÎÉ';
$strNoDropDatabases = '"DROP DATABASE" ÚÑ×ËÁÔÁ Å ÚÁÂÒÁÎÅÎÁ.';
$strNoFrames = 'phpMyAdmin Å ÐÏ ÄÒÕÖÅÌÀÂÅÎ ÁËÏ ÉÚÐÏÌÚ×ÁÔÅ ÂÒÁÕÚßÒ, ËÏÊÔÏ ÐÏÄÄßÒÖÁ <b>frames</b>.';
$strNoIndex = 'îÅ Å ÄÅÆÉÎÉÒÁÎ ÉÎÄÅËÓ!';
$strNoIndexPartsDefined = 'îÅ ÓÁ ÄÅÆÉÎÉÒÁÎÉ ÞÁÓÔÉ ÎÁ ÉÎÄÅËÓ!';
$strNoModification = 'îÑÍÁ ÐÒÏÍÑÎÁ';
$strNone = 'îÉÝÏ';
$strNoPassword = 'îÑÍÁ ÐÁÒÏÌÁ';
$strNoPrivileges = 'îÑÍÁ ÐÒÉ×ÉÌÅÇÉÉ';
$strNoQuery = 'îÑÍÁ SQL ÚÁÑ×ËÁ!';
$strNoRights = '÷ ÍÏÍÅÎÔÁ ÎÅ ÒÁÚÐÏÌÁÇÁÔÅ Ó ÄÏÓÔÁÔßÞÎÏ ÐÒÁ×Á ÚÁ ÄÁ ÓÅ ÎÁÍÉÒÁÔÅ ÔÕË!';
$strNoTablesFound = '÷ ÂÁÚÁÔÁ ÄÁÎÎÉ ÎÑÍÁ ÔÁÂÌÉÃÉ.';
$strNotNumber = 'ôÏ×Á ÎÅ Å ÞÉÓÌÏ!';
$strNotValidNumber = ' ÎÅ Å ×ÁÌÉÄÅÎ ÎÏÍÅÒ ÎÁ ÒÅÄ!';
$strNoUsersFound = 'îÑÍÁ ÐÏÔÒÅÂÉÔÅÌ(É).';
$strNull = 'ðÒÁÚÎÏ';

$strOffSet = 'ïÔÍÅÓÔ×ÁÎÅ';
$strOftenQuotation = 'ïÂÉËÎÏ×ÅÎÏ ËÁ×ÉÞËÉ. ðï éúâïò ÏÚÎÁÞÁ×Á, ÞÅ ÓÁÍÏ ÐÏÌÅÔÁ char É varchar ÓÅ ÚÁÇÒÁÖÄÁÔ × ËÁ×ÉÞËÉ.';
$strOptimizeTable = 'ïÐÔÉÍÉÚÉÒÁÎÅ ÎÁ ÔÁÂÌÉÃÁÔÁ';
$strOptionalControls = 'ðÏ ÉÚÂÏÒ. ëÏÎÔÒÏÌÉÒÁ ËÁË ÄÁ ÓÅ ÞÅÔÁÔ ÉÌÉ ÐÉÛÁÔ ÓÐÅÃÉÁÌÎÉ ÓÉÍ×ÏÌÉ.';
$strOptionally = 'ðï éúâïò';
$strOr = 'ÉÌÉ';
$strOverhead = 'úÁÇÕÂÅÎÏ ÍÑÓÔÏ';

$strPartialText = 'þÁÓÔÉÞÎÉ ÔÅËÓÔÏ×Å';
$strPassword = 'ðÁÒÏÌÁ';
$strPasswordEmpty = 'ðÁÒÏÌÁÔÁ Å ÐÒÁÚÎÁ!';
$strPasswordNotSame = 'ðÁÒÏÌÁÔÁ ÎÅ Å ÓßÝÁÔÁ!';
$strPHPVersion = '÷ÅÒÓÉÑ ÎÁ PHP ';
$strPmaDocumentation = 'phpMyAdmin ÄÏËÕÍÅÎÔÁÃÉÑ';
$strPmaUriError = 'îÁ <tt>$cfgPmaAbsoluteUri</tt> ôòñâ÷á ÄÁ ÓÅ ÚÁÄÁÄÅ ÓÔÏÊÎÏÓÔ × ËÏÎÆÉÇÕÒÁÃÉÏÎÎÉÑ ÆÁÊÌ!';
$strPos1 = 'îÁÞÁÌÏ';
$strPrevious = 'ðÒÅÄÉÛÅÎ';
$strPrimary = 'PRIMARY';
$strPrimaryKey = 'çÌÁ×ÅÎ ËÌÀÞ';
$strPrimaryKeyHasBeenDropped = ' çÌÁ×ÎÉÑ ËÌÀÞ ÂÅÛÅ ÉÚÔÒÉÔ.';
$strPrimaryKeyName = 'éÍÅÔÏ ÎÁ ÇÌÁ×ÎÉÑ ËÌÀÞ ÔÒÑÂ×Á ÄÁ Å... PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>ÔÒÑÂ×Á</b> ÄÁ Å ÉÍÅÔÏ ÎÁ <b>É ÅÄÉÎÓÔ×ÅÎÏ ÎÁ</b> ÇÌÁ×ÎÉÑ ËÌÀÞ!)';
$strPrintView = 'éÚÇÌÅÄ ÚÁ ÐÅÞÁÔ';
$strPrivileges = 'ðÒÉ×ÉÌÅÇÉÉ';
$strProperties = 'ó×ÏÊÓÔ×Á';

$strQBE = 'úÁÐÉÔ×ÁÎÅ ÐÏ ÐÒÉÍÅÒ';
$strQBEDel = 'éÚÔÒÉÊ';
$strQBEIns = '÷ÍßËÎÉ';
$strQueryOnDb = 'SQL-ÚÁÑ×ËÁ ËßÍ ÂÁÚÁÔÁ ÏÔ ÄÁÎÎÉ <b>%s</b>:';

$strRecords = 'úÁÐÉÓÉ';
$strReferentialIntegrity = 'ðÒÏ×ÅÒËÁ ÎÁ ÉÎÔÅÇÒÉÔÅÔÁ ÎÁ ×ÒßÚËÉÔÅ';
$strReloadFailed = 'îÅÕÓÐÅÛÅÎ ÏÐÉÔ ÚÁ ÐÒÅÚÁÒÅÖÄÁÎÅ ÎÁ MySQL.';
$strReloadMySQL = 'ðÒÅÚÁÒÅÄÉ MySQL';
$strRememberReload = 'îÅ ÚÁÂÒÁ×ÑÊÔÅ ÄÁ ÐÒÅÚÁÒÅÄÉÔÅ ÓßÒ×ßÒÁ.';
$strRenameTable = 'ðÒÅÉÍÅÎÕ×ÁÊ ÔÁÂÌÉÃÁÔÁ ÎÁ';
$strRenameTableOK = 'ôÁÂÌÉÃÁ %s ÂÅÛÅ ÐÒÅÉÍÅÎÕ×ÁÎÁ ÎÁ %s';
$strRepairTable = 'ðÏÐÒÁ×ÑÎÅ ÎÁ ÔÁÂÌÉÃÁÔÁ';
$strReplace = 'úÁÍÅÓÔÉ';
$strReplaceTable = 'úÁÍÅÓÔÉ ÄÁÎÎÉÔÅ ÏÔ ÔÁÂÌÉÃÁÔÁ Ó ÄÁÎÎÉÔÅ ÏÔ ÆÁÊÌÁ';
$strReset = 'éÚÞÉÓÔÉ';
$strReType = 'ïÔÎÏ×Ï';
$strRevoke = 'ïÔÍÅÎÉ';
$strRevokeGrant = 'ïÔÎÅÍÁÎÅ ÎÁ Grant&nbsp;ÐÒÉ×.';
$strRevokeGrantMessage = '÷ÉÅ ÐÒÅÍÁÈÎÁÈÔÅ Grant ÐÒÉ×ÉÌÅÇÉÉÔÅ ÚÁ %s';
$strRevokeMessage = '÷ÉÅ ÏÔÍÅÎÉÈÔÅ ÐÒÉ×ÉÌÅÇÉÉÔÅ ÚÁ %s';
$strRevokePriv = 'ïÔÍÑÎÁ ÎÁ ÐÒÉ×ÉÌÅÇÉÉ';
$strRowLength = 'äßÌÖÉÎÁ ÎÁ ÒÅÄÁ';
$strRows = 'òÅÄÏ×Å';
$strRowsFrom = 'ÒÅÄÁ ÚÁÐÏÞ×ÁÊËÉ ÏÔ';
$strRowSize = ' òÁÚÍÅÒ ÎÁ ÒÅÄ ';
$strRowsModeHorizontal = 'ÈÏÒÉÚÏÎÔÁÌÅÎ';
$strRowsModeOptions = '× %s ×ÉÄ É ÐÏ×ÔÁÒÑÊ ÉÍÅÎÁÔÁ ÎÁ ËÏÌÏÎÉÔÅ ÐÒÅÚ ×ÓÅËÉ %s<br />';
$strRowsModeVertical = '×ÅÒÔÉËÁÌÅÎ';
$strRowsStatistic = 'óÔÁÔÉÓÔÉËÁ ÚÁ ÒÅÄÏ×ÅÔÅ';
$strRunning = 'ÒÁÂÏÔÉ ÎÁ %s';
$strRunQuery = 'éÚÐßÌÎÉ ÚÁÑ×ËÁÔÁ';
$strRunSQLQuery = 'óÔÁÒÔÉÒÁÎÅ SQL ÚÁÑ×ËÁ/ÚÁÑ×ËÉ ËßÍ ÂÁÚÁ ÏÔ ÄÁÎÎÉ %s';

$strSave = 'úÁÐÉÛÉ';
$strSelect = 'éÚÂÅÒÉ';
$strSelectADb = 'íÏÌÑ ÉÚÂÅÒÅÔÅ ÂÁÚÁ ÄÁÎÎÉ';
$strSelectAll = 'óÅÌÅËÔÉÒÁÊ ×ÓÉÞËÏ';
$strSelectFields = 'éÚÂÅÒÉ ÐÏÌÅ (ÍÉÎÉÍÕÍ ÅÄÎÏ):';
$strSelectNumRows = '× ÚÁÐÉÔ×ÁÎÅÔÏ';
$strSend = 'éÚÐÒÁÔÉ';
$strServerChoice = 'éÚÂÏÒ ÎÁ ÓßÒ×ßÒ';
$strServerVersion = '÷ÅÒÓÉÑ ÎÁ ÓßÒ×ßÒÁ';
$strSetEnumVal = 'áËÏ ÔÉÐÁ ÎÁ ÐÏÌÅÔÏ Å "enum" ÉÌÉ "set", ÍÏÌÑ ×ß×ÅÄÅÔÅ ÓÔÏÊÎÏÓÔÉÔÅ ÉÚÐÏÌÚ×ÁÊËÉ ÔÏÚÉ ÆÏÒÍÁÔ: \'a\',\'b\',\'c\'...<br />áËÏ Å ÎÅÏÂÈÏÄÉÍÏ ÄÁ ÓÌÏÖÉÔÅ ÏÂÒÁÔÎÁ ÞÅÒÔÁ ("\") ÉÌÉ ÁÐÏÓÔÒÏÆ ("\'") ÍÅÖÄÕ ÔÅÚÉ ÓÔÏÊÎÏÓÔÉ, ÓÌÏÖÉÔÅ ÏÂÒÁÔÎÁ ÞÅÒÔÁ ÐÒÅÄ ÔÑÈ (ÎÁÐÒÉÍÅÒ:  \'\\\\xyz\' ÉÌÉ \'a\\\'b\').';
$strShow = 'ðÏËÁÖÉ';
$strShowAll = 'ðÏËÁÖÉ ×ÓÉÞËÉ';
$strShowCols = 'ðÏËÁÖÉ ËÏÌÏÎÉÔÅ';
$strShowingRecords = 'ðÏËÁÚ×Á ÚÁÐÉÓÉ ';
$strShowPHPInfo = 'ðÏËÁÖÉ ÉÎÆÏÒÍÁÃÉÑ ÚÁ PHP ';
$strShowTables = 'ðÏËÁÖÉ ÔÁÂÌÉÃÉÔÅ';
$strShowThisQuery = ' ðÏËÁÖÉ ÔÁÚÉ ÚÁÑ×ËÁ ÏÔÎÏ×Ï ';
$strSingly = '(ÅÄÎÏËÒÁÔÎÏ)';
$strSize = 'òÁÚÍÅÒ';
$strSort = 'óÏÒÔÉÒÁÎÅ';
$strSpaceUsage = 'éÚÐÏÌÚ×ÁÎÏ ÍÑÓÔÏ';
$strSQLQuery = 'SQL-ÚÁÐÉÔ×ÁÎÅ';
$strStartingRecord = 'îÁÞÁÌÅÎ ÚÁÐÉÓ';
$strStatement = 'úÁÑ×ÌÅÎÉÅ';
$strStrucCSV = 'CSV ÄÁÎÎÉ';
$strStrucData = 'óÔÒÕËÔÕÒÁÔÁ É ÄÁÎÎÉÔÅ';
$strStrucDrop = 'äÏÂÁ×É \'ÉÚÔÒÉÊ ÔÁÂÌÉÃÁÔÁ\'';
$strStrucExcelCSV = 'CSV ÚÁ Ms Excel ÄÁÎÎÉ';
$strStrucOnly = 'óÁÍÏ ÓÔÒÕËÔÕÒÁÔÁ';
$strSubmit = 'éÚÐßÌÎÉ';
$strSuccess = '÷ÁÛÅÔÏ SQL-ÚÁÐÉÔ×ÁÎÅ ÂÅÛÅ ÉÚÐßÌÎÅÎÏ ÕÓÐÅÛÎÏ';
$strSum = 'óÕÍÁ';

$strTable = 'ôÁÂÌÉÃÁ ';
$strTableComments = 'ëÏÍÅÎÔÁÒÉ ËßÍ ÔÁÂÌÉÃÁÔÁ';
$strTableEmpty = 'éÍÅÔÏ ÎÁ ÔÁÂÌÉÃÁÔÁ Å ÐÒÁÚÎÏ!';
$strTableHasBeenDropped = 'ôÁÂÌÉÃÁÔÁ %s ÂÅÛÅ ÉÚÔÒÉÔÁ';
$strTableHasBeenEmptied = 'ôÁÂÌÉÃÁÔÁ %s ÂÅÛÅ ÉÚÐÒÁÚÎÅÎÁ';
$strTableHasBeenFlushed = 'ëÅÛÁ ÎÁ ÔÁÂÌÉÃÁ %s ÂÅÛÅ ÉÚÐÒÁÚÎÅÎ';
$strTableMaintenance = 'ðÏÄÄÒßÖËÁ ÎÁ ÔÁÂÌÉÃÁÔÁ';
$strTables = '%s ÔÁÂÌÉÃÁ(É)';
$strTableStructure = 'óÔÒÕËÔÕÒÁ ÎÁ ÔÁÂÌÉÃÁ';
$strTableType = 'ôÉÐ ÎÁ ÔÁÂÌÉÃÁÔÁ';
$strTextAreaLength = ' ðÏÒÁÄÉ ÄßÌÖÉÎÁÔÁ ÓÉ,<br /> ÔÏ×Á ÐÏÌÅ ÍÏÖÅ ÄÁ ÎÅ Å ÒÅÄÁËÔÉÒÕÅÍÏ ';
$strTheContent = 'óßÄßÒÖÁÎÉÅÔÏ ÎÁ ÆÁÊÌÁ ÂÅÛÅ ÉÍÐÏÒÔÉÒÁÎÏ.';
$strTheContents = 'óßÄßÒÖÁÎÉÅÔÏ ÎÁ ÆÁÊÌÁ ÚÁÍÅÓÔ×Á ÓßÄßÒÖÁÎÉÅÔÏ ÎÁ ÔÁÂÌÉÃÁÔÁ ÚÁ ÒÅÄÏ×Å Ó ÉÄÅÎÔÉÞÎÉ ÐßÒ×ÉÞÎÉ ÉÌÉ ÕÎÉËÁÌÎÉ ËÌÀÞÏ×Å.';
$strTheTerminator = 'óÉÍ×ÏÌ ÚÁ ËÒÁÊ ÎÁ ÐÏÌÅ.';
$strTotal = '÷ÓÉÞËÏ';
$strType = 'ôÉÐ';

$strUncheckAll = 'òÁÚÍÁÒËÉÒÁÊ ×ÓÉÞËÏ';
$strUnique = 'õÎÉËÁÌÎÏ';
$strUnselectAll = 'äÅÓÅÌÅËÔÉÒÁÊ ×ÓÉÞËÏ';
$strUpdatePrivMessage = '÷ÉÅ ÐÒÏÍÅÎÉÈÔÅ ÐÒÉ×ÉÌÅÇÉÉÔÅ ÚÁ %s.';
$strUpdateProfile = 'ïÂÎÏ×Ñ×ÁÎÅ ÎÁ ÐÒÏÆÉÌ:';
$strUpdateProfileMessage = 'ðÒÏÆÉÌÁ ÂÅÛÅ ÏÂÎÏ×ÅÎ.';
$strUpdateQuery = 'äÏÐßÌÎÉ úÁÐÉÔ×ÁÎÅÔÏ';
$strUsage = 'éÚÐÏÌÚ×ÁÎÉ';
$strUseBackquotes = 'éÚÐÏÌÚ×ÁÊ ÏÂÒÁÔÎÉ ËÁ×ÉÞËÉ ÏËÏÌÏ ÉÍÅÎÁ ÎÁ ÔÁÂÌÉÃÉ É ÐÏÌÅÔÁ';
$strUser = 'ðÏÔÒÅÂÉÔÅÌ';
$strUserEmpty = 'ðÏÔÒÅÂÉÔÅÌÓËÏÔÏ ÉÍÅ Å ÐÒÁÚÎÏ!';
$strUserName = 'ðÏÔÒÅÂÉÔÅÌÓËÏ ÉÍÅ';
$strUsers = 'ðÏÔÒÅÂÉÔÅÌÉ';
$strUseTables = 'éÚÐÏÌÚ×ÁÊ ÔÁÂÌÉÃÁÔÁ';

$strValue = 'óÔÏÊÎÏÓÔ';
$strViewDump = 'ðÏËÁÖÉ ÄßÍÐ (ÓÈÅÍÁ) ÎÁ ÔÁÂÌÉÃÁÔÁ';
$strViewDumpDB = 'ðÏËÁÖÉ ÄßÍÐ (ÓÈÅÍÁ) ÎÁ âä';

$strWelcome = 'äÏÂÒÅ ÄÏÛÌÉ × %s';
$strWithChecked = 'ëÏÇÁÔÏ ÉÍÁ ÏÔÍÅÔËÁ:';
$strWrongUser = 'çÒÅÛÎÏ ÉÍÅ/ÐÁÒÏÌÁ. ïÔËÁÚÁÎ ÄÏÓÔßÐ.';

$strYes = 'ÄÁ';

$strZip = '"zip-ÎÁÔÏ"';

// To translate
?>
