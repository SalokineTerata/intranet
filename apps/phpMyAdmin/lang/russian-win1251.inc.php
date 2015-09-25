<?php
/* $Id: russian-win1251.inc.php,v 1.111 2002/04/20 16:39:12 loic1 Exp $ */

/**
 * Translated by Gosha Sakovich <gt2 at users.sourceforge.net>
 *               Artyom Rabzonov <tyomych at gmx.net>
 */

$charset = 'windows-1251';
$text_dir = 'ltr';
$left_font_family = 'sans-serif';
$right_font_family = 'sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('Áàéò', 'êÁ', 'ÌÁ', 'ÃÁ');

$day_of_week = array('Âñ', 'Ïí', 'Âò', 'Ñð', '×ò', 'Ïò', 'Ñá');
$month = array('ßíâ', 'Ôåâ', 'Ìàð', 'Àïð', 'Ìàé', 'Èþí', 'Èþë', 'Àâã', 'Ñåí', 'Îêò', 'Íîÿ', 'Äåê');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%B %d %Y ã., %H:%M';


$strAccessDenied = 'Â äîñòóïå îòêàçàíî';
$strAction = 'Äåéñòâèå';
$strAddDeleteColumn = 'Äîáàâèòü/óäàëèòü ñòîëáåö êðèòåðèÿ';
$strAddDeleteRow = 'Äîáàâèòü/óäàëèòü ðÿä êðèòåðèÿ';
$strAddNewField = 'Äîáàâèòü íîâîå ïîëå';
$strAddPriv = 'Äîáàâèòü íîâûå ïðèâèëåãèè';
$strAddPrivMessage = 'Áûëà äîáàâëåíà íîâàÿ ïðèâèëåãèÿ';
$strAddSearchConditions = 'Äîáàâèòü óñëîâèÿ ïîèñêà (òåëî äëÿ óñëîâèÿ "where"):';
$strAddToIndex = 'Äîáàâèòü ê èíäåêñó&nbsp;%s&nbsp;êîëîíîêó(è)';
$strAddUser = 'Äîáàâèòü íîâîãî ïîëüçîâàòåëÿ';
$strAddUserMessage = 'Áûë äîáàâëåí íîâûé ïîëüçîâàòåëü.';
$strAffectedRows = 'Çàòðîíóòûå ðÿäû:';
$strAfter = 'Ïîñëå %s';
$strAfterInsertBack = 'Âîçâðàò';
$strAfterInsertNewInsert = 'Âñòàâèòü íîâóþ çàïèñü';
$strAll = 'Âñå';
$strAlterOrderBy = 'Èçìåíèòü ïîðÿäîê òàáëèöû';
$strAnalyzeTable = 'Àíàëèç òàáëèöû';
$strAnd = 'È';
$strAnIndex = 'Áûë äîáàâëåí èíäåêñ äëÿ %s';
$strAny = 'Ëþáîé';
$strAnyColumn = 'Ëþáàÿ êîëîíêà';
$strAnyDatabase = 'Ëþáàÿ áàçà äàííûõ';
$strAnyHost = 'Ëþáîé õîñò';
$strAnyTable = 'Ëþáàÿ òàáëèöà';
$strAnyUser = 'Ëþáîé ïîëüçîâàòåëü';
$strAPrimaryKey = 'Áûë äîáàâëåí ïåðâè÷íûé êëþ÷ ê %s';
$strAscending = 'Âîñõîäÿùèé';
$strAtBeginningOfTable = 'Â íà÷àëî òàáëèöû';
$strAtEndOfTable = 'Â êîíåö òàáëèöû';
$strAttr = 'Àòðèáóòû';

$strBack = 'Íàçàä';
$strBinary = ' Äâîè÷íûé ';
$strBinaryDoNotEdit = ' Äâîè÷íûå äàííûå - íå ðåäàêòèðóþòñÿ ';
$strBookmarkDeleted = 'Çàêëàäêà áûëà óäàëåíà.';
$strBookmarkLabel = 'Ìåòêà';
$strBookmarkQuery = 'Çàêëàäêà íà SQL-çàïðîñ';
$strBookmarkThis = 'Çàêëàäêà íà äàííûé SQL-çàïðîñ';
$strBookmarkView = 'Òîëüêî ïðîñìîòð';
$strBrowse = 'Îáçîð';
$strBzip = 'ïàêîâàòü â "bzip"';

$strCantLoadMySQL = 'ðàñøèðåíèå MySQL íå çàãðóæåíî,<br />ïðîâåðüòå êîíôèãóðàöèþ PHP.';
$strCantRenameIdxToPrimary = 'Íåâîçìîçìîæíî ïåðåèìåíîâàòü èíäåêñ â PRIMARY!';
$strCarriage = 'Âîçâðàò êàðåòêè: \\r';
$strCardinality = 'Êîëè÷åñòâî ýëåìåíòîâ';
$strChange = 'Èçìåíèòü';
$strChangePassword = 'Èçìåíèòü ïàðîëü';
$strCheckAll = 'Îòìåòèòü âñå';
$strCheckDbPriv = 'Ïðîâåðèòü Ïðèâèëåãèè Áàçû Äàííûõ';
$strCheckTable = 'Ïðîâåðèòü òàáëèöó';
$strColumn = 'Êîëîíêà';
$strColumnNames = 'Íàçâàíèÿ êîëîíîê';
$strCompleteInserts = 'Ïîëíàÿ âñòàâêà';
$strConfirm = 'Âû äåéñòâèòåëüíî õîòèòå ñäåëàòü ýòî?';
$strCookiesRequired = 'Cookies äîëæíû áûòü âêëþ÷åíû ïîñëå ýòîãî ìåñòà.';
$strCopyTable = 'Ñêîïèðîâàòü òàáëèöó â (áàçà äàííûõ<b>.</b>òàáëèöà):';
$strCopyTableOK = 'Òàáëèöà %s áûëà ñêîïèðîâàíà â %s.';
$strCreate = 'Ñîçäàòü';
$strCreateNewDatabase = 'Ñîçäàòü íîâóþ ÁÄ';
$strCreateNewTable = 'Ñîçäàòü íîâóþ òàáëèöó â ÁÄ %s';
$strCreateIndex = 'Ñîçäàòü èíäåêñ íà&nbsp;%s&nbsp;êîëîíêàõ';
$strCreateIndexTopic = 'Ñîçäàòü íîâûé èíäåêñ';
$strCriteria = 'Êðèòåðèé';

$strData = 'Äàííûå';
$strDatabase = 'ÁÄ ';
$strDatabaseHasBeenDropped = 'Áàçà äàííûõ %s áûëà óäàëåíà.';
$strDatabases = 'Áàçû Äàííûõ';
$strDatabasesStats = 'Ñòàòèñòèêà áàç äàííûõ';
$strDatabaseWildcard = 'Áàçà äàííûõ (øàáëîíû ðàçðåøåíû):';
$strDataOnly = 'Òîëüêî äàííûå';
$strDefault = 'Ïî óìîë÷àíèþ';
$strDelete = 'Óäàëèòü';
$strDeleted = 'Ðÿä áûë óäàëåí';
$strDeletedRows = 'Ñëåäóþùèå ðÿäû áûëè óäàëåíû:';
$strDeleteFailed = 'Íåóäà÷íîå óäàëåíèå!';
$strDeleteUserMessage = 'Áûë óäàëåí ïîëüçîâàòåëü %s.';
$strDescending = 'Íèñõîäÿùèé';
$strDisplay = 'Ïîêàçàòü';
$strDisplayOrder = 'Ïîðÿäîê ïðîñìîòðà:';
$strDoAQuery = 'Âûïîëíèòü "çàïðîñ ïî ïðèìåðó" (ñèìâîë ïîäñòàâíîâêè: "%")';
$strDocu = 'Äîêóìåíòàöèÿ';
$strDoYouReally = 'Âû äåéñòâèòåëüíî æåëàåòå ';
$strDrop = 'Óíè÷òîæèòü';
$strDropDB = 'Óíè÷òîæèòü ÁÄ %s';
$strDropTable = 'Óäàëèòü òàáëèöó';
$strDumpingData = 'Äàìï äàííûõ òàáëèöû';
$strDynamic = 'äèíàìè÷åñêèé';

$strEdit = 'Ïðàâêà';
$strEditPrivileges = 'Ðåäàêòèðîâàíèå ïðèâèëåãèé';
$strEffective = 'Ýôôåêòèâíîñòü';
$strEmpty = 'Î÷èñòèòü';
$strEmptyResultSet = 'MySQL âåðíóëà ïóñòîé ðåçóëüòàò (ò.å. íîëü ðÿäîâ).';
$strEnd = 'Êîíåö';
$strEnglishPrivileges = ' Ïðèìå÷àíèå: ïðèâèëåãèè MySQL çàäàþòñÿ ïî àíãëèéñêè ';
$strError = 'Îøèáêà';
$strExtendedInserts = 'Ðàñøèðåííûå âñòàâêè';
$strExtra = 'Äîïîëíèòåëüíî';

$strField = 'Ïîëå';
$strFieldHasBeenDropped = 'Ïîëå %s áûëî óäàëåíî';
$strFields = 'Ïîëÿ';
$strFieldsEmpty = ' Ïóñòîé ñ÷åò÷èê ïîëåé! ';
$strFieldsEnclosedBy = 'Ïîëÿ çàêëþ÷åíû â';
$strFieldsEscapedBy = 'Ïîëÿ ýêðàíèðóþòñÿ';
$strFieldsTerminatedBy = 'Ïîëÿ ðàçäåëåíû';
$strFixed = 'ôèêñèðîâàííûé';
$strFlushTable = 'Ñáðîñèòü êýø òàáëèöû ("FLUSH")';
$strFormat = 'Ôîðìàò';
$strFormEmpty = 'Òðåáóåòñÿ çíà÷åíèå äëÿ ôîðìû!';
$strFullText = 'Ïîëíûå òåêñòû';
$strFunction = 'Ôóíêöèÿ';

$strGenTime = 'Âðåìÿ ñîçäàíèÿ';
$strGo = 'Ïîøåë';
$strGrants = 'Ïðàâà';
$strGzip = 'ïàêîâàòü â "gzip"';

$strHasBeenAltered = 'áûëà èçìåíåíà.';
$strHasBeenCreated = 'áûëà ñîçäàíà.';
$strHome = 'Ê íà÷àëó';
$strHomepageOfficial = 'Îôèöèàëüíàÿ ñòðàíèöà phpMyAdmin';
$strHomepageSourceforge = 'Çàãðóçêà phpMyAdmin íà Sourceforge';
$strHost = 'Õîñò';
$strHostEmpty = 'Ïóñòîå èìÿ õîñòà!';

$strIdxFulltext = 'ÏîëíÒåêñò';
$strIfYouWish = 'Åñëè Âû æåëàåòå çàãðóçèòü òîëüêî íåêîòîðûå ñòîëáöû òàáëèöû, óêàæèòå ðàçäåëåííûé çàïÿòûìè ñïèñîê ïîëåé.';
$strIgnore = 'Èãíîðèðîâàòü';
$strIndex = 'Èíäåêñ';
$strIndexes = 'Èíäåêñû';
$strIndexHasBeenDropped = 'Èíäåêñ %s áûë óäàëåí';
$strIndexName = 'Èìÿ èíäåêñà&nbsp;:';
$strIndexType = 'Òèï èíäåêñà&nbsp;:';
$strInsert = 'Âñòàâèòü';
$strInsertAsNewRow = 'Âñòàâèòü íîâûé ðÿä';
$strInsertedRows = 'Äîáàâëåíû ðÿäû:';
$strInsertNewRow = 'Âñòàâèòü íîâûé ðÿä';
$strInsertTextfiles = 'Âñòàâèòü òåêñòîâûå ôàéëû â òàáëèöó';
$strInstructions = 'Èíñòðóêöèè';
$strInUse = 'èñïîëüçóåòñÿ';
$strInvalidName = '"%s" - ÿâëÿåòñÿ çàðåçåðâèðîâàííûì ñëîâîì, âû íå ìîæåòå èñïîëüçîâàòü åãî â êà÷åñòâå èìåíè áàçû äàííûõ/òàáëèöû/ïîëÿ.';

$strKeepPass = 'Íå ìåíÿòü ïàðîëü';
$strKeyname = 'Èìÿ êëþ÷à';
$strKill = 'Óáèòü';

$strLength = 'Äëèíà';
$strLengthSet = 'Äëèíû/Çíà÷åíèÿ*';
$strLimitNumRows = 'çàïèñåé íà ñòðàíèöó';
$strLineFeed = 'Ñèìâîë îêîí÷àíèÿ ëèíèè: \\n';
$strLines = 'Ëèíèè';
$strLinesTerminatedBy = 'Ñòðîêè ðàçäåëåíû';
$strLocationTextfile = 'Ìåñòîðàñïîëîæåíèå òåêñòîâîãî ôàéëà';
$strLogin = 'Âõîä â ñèñòåìó';
$strLogout = 'Âûéòè èç ñèñòåìû';
$strLogPassword = 'Ïàðîëü:';
$strLogUsername = 'Ïîëüçîâàòåëü:';

$strModifications = 'Ìîäèôèêàöèè áûëè ñîõðàíåíû';
$strModify = 'Èçìåíèòü';
$strModifyIndexTopic = 'Èçìåíèòü èíäåêñ';
$strMoveTable = 'Ïåðåìåñòèòü òàáëèöû â (áàçà äàííûõ<b>.</b>òàáëèöà):';
$strMoveTableOK = 'Òàáëèöà %s áûëà ïåðåìåùåíà â %s.';
$strMySQLReloaded = 'MySQL ïåðåçàãðóæåíà.';
$strMySQLSaid = 'Îòâåò MySQL: ';
$strMySQLServerProcess = 'MySQL %pma_s1% íà %pma_s2% êàê %pma_s3%';
$strMySQLShowProcess = 'Ïîêàçàòü ïðîöåññû';
$strMySQLShowStatus = 'Ïîêàçàòü ñîñòîÿíèå MySQL';
$strMySQLShowVars = 'Ïîêàçàòü ñèñòåìíûå ïåðåìåííûå MySQL';

$strName = 'Èìÿ';
$strNbRecords = '÷èñëî çàïèñåé';
$strNext = 'Äàëåå';
$strNo = 'Íåò';
$strNoDatabases = 'ÁÄ îòñóòñòâóþò';
$strNoDropDatabases = 'Îïåðàòîðû "DROP DATABASE" îòêëþ÷åíû.';
$strNoFrames = 'Äëÿ ðàáîòû phpMyAdmin íóæåí áðàóçåð ñ ïîääåðæêîé <b>ôðåéìîâ</b>.';
$strNoIndexPartsDefined = '×àñòåé èíäåêñà íå îïðåäåëåíî!';
$strNoIndex = 'Èíäåêñ íå îïðåäåëåí!';
$strNoModification = 'Íåò èçìåíåíèé';
$strNone = 'Íåò';
$strNoPassword = 'Áåç ïàðîëÿ';
$strNoPrivileges = 'Áåç ïðèâèëåãèé';
$strNoQuery = 'Íåò SQL-çàïðîñà!';
$strNoRights = 'Âû íå èìååòå äîñòàòî÷íî ïðàâ äëÿ ýòîãî!';
$strNoTablesFound = 'Â ÁÄ íå îáíàðóæåíî òàáëèö.';
$strNotNumber = 'Ýòî íå ÷èñëî!';
$strNotValidNumber = ' íåäîïóñòèìîå êîëè÷åñòâî ðÿäîâ!';
$strNoUsersFound = 'Íå íàéäåí ïîëüçîâàòåëü.';
$strNull = 'Íîëü';

$strOftenQuotation = 'Îáû÷íî êàâû÷êè. ÏÎ ÂÛÁÎÐÓ îçíà÷àåò, ÷òî òîëüêî ïîëÿ char è varchar çàêëþ÷àþòñÿ â êàâû÷êè.';
$strOptimizeTable = 'Îïòèìèçèðîâàòü òàáëèöó';
$strOptionalControls = 'Ïî âûáîðó. Êîíòðîëèðóåò êàê ÷èòàòü èëè ïèñàòü ñïåöèàëüíûå ñèìâîëû.';
$strOptionally = 'ÏÎ ÂÛÁÎÐÓ';
$strOr = 'Èëè';
$strOverhead = 'Íàêëàäíûå ðàñõîäû';

$strPartialText = '×àñòè÷íûå òåêñòû';
$strPassword = 'Ïàðîëü';
$strPasswordEmpty = 'Ïóñòîé ïàðîëü!';
$strPasswordNotSame = 'Ïàðîëè íå îäèíàêîâû!';
$strPHPVersion = 'Âåðñèÿ PHP';
$strPmaDocumentation = 'Äîêóìåíòàöèÿ ïî phpMyAdmin';
$strPmaUriError = 'Äèðåêòèâà <tt>$cfgPmaAbsoluteUri</tt> ÄÎËÆÍÀ áûòü óñòàíîâëåíà â êîíôèãóðàöèîííîì ôàéëå!';
$strPos1 = 'Íà÷àëî';
$strPrevious = 'Íàçàä';
$strPrimary = 'Ïåðâè÷íûé';
$strPrimaryKey = 'Ïåðâè÷íûé êëþ÷';
$strPrimaryKeyName = 'Èìÿ ïåðâè÷íîãî êëþ÷à äîëæíî áûòü PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>äîëæíî</b> áûòü èìåíåì <b>òîëüêî</b> ïåðâè÷íîãî êëþ÷à!)';
$strPrimaryKeyHasBeenDropped = 'Ïåðâè÷íûé êëþ÷ áûë óäàëåí';
$strPrintView = 'Âåðñèÿ äëÿ ïå÷àòè';
$strPrivileges = 'Ïðèâèëåãèè';
$strProperties = 'Ñâîéñòâà';

$strQBE = 'Çàïðîñ ïî ïðèìåðó';
$strQBEDel = 'Óäàëèòü';
$strQBEIns = 'Âñòàâèòü';
$strQueryOnDb = 'SQL-çàïðîñ ÁÄ <b>%s</b>:';

$strRecords = 'Çàïèñè';
$strReferentialIntegrity = 'Ïðîâåðèòü öåëîñòíîñòü äàííûõ:';
$strReloadFailed = 'Íå óäàëîñü ïåðåçàãðóçèòü MySQL.';
$strReloadMySQL = 'Ïåðåçàãðóçèòü MySQL';
$strRememberReload = 'Íå çàáóäüòå ïåðåçàãðóçèòü ñåðâåð.';
$strRenameTable = 'Ïåðåèìåíîâàòü òàáëèöó â';
$strRenameTableOK = 'Òàáëèöà %s áûëà ïåðåèìåíîâàíà â %s';
$strRepairTable = 'Ïî÷èíèòü òàáëèöó';
$strReplace = 'Çàìåñòèòü';
$strReplaceTable = 'Çàìåñòèòü äàííûå òàáëèöû äàííûìè èç ôàéëà';
$strReset = 'Ïåðåóñòàíîâèòü';
$strReType = 'Ïîäòâåðæäåíèå';
$strRevoke = 'Îòìåíèòü';
$strRevokeGrant = 'Îòìåíèòü ïðåäîñòàâëåíèå ïðàâ';
$strRevokeGrantMessage = 'Áûëî îòìåíåíî ïðåäîñòàâëåíèå ïðàâ äëÿ %s';
$strRevokeMessage = 'Âû èçìåíèëè ïðèâåëåãèè äëÿ %s';
$strRevokePriv = 'Îòìåíèòü ïðèâèëåãèè';
$strRowLength = 'Äëèíà ðÿäà';
$strRows = 'Ðÿäû';
$strRowsFrom = 'ðÿäîâ îò';
$strRowSize = ' Ðàçìåð ðÿäà ';
$strRowsModeHorizontal = 'ãîðèçîíòàëüíîì';
$strRowsModeOptions = 'â %s ðåæèìå, çàãîëîâêè ïîñëå êàæäûõ %s ÿ÷ååê';
$strRowsModeVertical = 'âåðòèêàëüíîì';
$strRowsStatistic = 'Ñòàòèñòèêà ðÿäà';
$strRunning = 'íà %s';
$strRunQuery = 'Âûïîëíèòü Çàïðîñ';
$strRunSQLQuery = 'Âûïîëíèòü SQL çàïðîñ(û) íà ÁÄ %û';

$strSave = 'Ñîõðàíèòü';
$strSelect = 'Âûáðàòü';
$strSelectADb = 'Âûáåðèòå ÁÄ';
$strSelectAll = 'Îòìåòèòü âñå';
$strSelectFields = 'Âûáðàòü ïîëÿ (ìèíèìóì îäíî):';
$strSelectNumRows = 'ïî çàïðîñó';
$strSend = 'ïîñëàòü';
$strServerChoice = 'Âûáîð ñåðâåðà';
$strServerVersion = 'Âåðñèÿ ñåðâåðà';
$strSetEnumVal = 'Äëÿ òèïîâ ïîëÿ "enum" è "set", ââåäèòå çíà÷åíèÿ ïî ýòîìó ôîðìàòó: \'a\',\'b\',\'c\'...<br />Åñëè âàì ïîíàäîáèòüñÿ ââåñòè îáðàòíóþ êîñóþ ÷åðòó ("\"") èëè îäèíî÷íóþ êàâû÷êó ("\'") ñðåäè ýòèõ çíà÷åíèé, ïîñòàâüòå ïåðåä íèìè îáðàòíóþ êîñóþ ÷åðòó (íàïðèìåð, \'\\\\xyz\' èëè \'a\\\'b\').';
$strShow = 'Ïîêàçàòü';
$strShowAll = 'Ïîêàçàòü âñå';
$strShowCols = 'Ïîêàçàòü êîëîíêè';
$strShowingRecords = 'Ïîêàçûâàåò çàïèñè ';
$strShowPHPInfo = 'Ïîêàçàòü èíôîðìàöèþ î PHP';
$strShowTables = 'Ïîêàçàòü òàáëèöû';
$strShowThisQuery = ' Ïîêàçàòü äàííûé çàïðîñ ñíîâà ';
$strSingly = '(îòäåëüíî)';
$strSize = 'Ðàçìåð';
$strSort = 'Îòñîðòèðîâàòü';
$strSpaceUsage = 'Èñïîëüçóåìîå ïðîñòðàíñòâî';
$strSQLQuery = 'SQL-çàïðîñ';
$strStartingRecord = 'Íà÷èíàòü ñ çàïèñè';
$strStatement = 'Ïàðàìåòð'; // ???To translate
$strStrucCSV = 'CSV äàííûå';
$strStrucData = 'Ñòðóêòóðà è äàííûå';
$strStrucDrop = 'Äîáàâèòü óäàëåíèå òàáëèöû';
$strStrucExcelCSV = 'CSV äëÿ äàííûõ Ms Excel';
$strStrucOnly = 'Òîëüêî ñòðóêòóðó';
$strSubmit = 'Âûïîëíèòü';
$strSuccess = 'Âàø SQL-çàïðîñ áûë óñïåøíî âûïîëíåí';
$strSum = 'Âñåãî';

$strTable = 'òàáëèöà ';
$strTableComments = 'Êîììåíòàðèé ê òàáëèöå';
$strTableEmpty = 'Ïóñòîå íàçâàíèå òàáëèöû!';
$strTableHasBeenDropped = 'Òàáëèöà %s áûëà óäàëåíà';
$strTableHasBeenEmptied = 'Òàáëèöà %s áûëà îïóñòîøåíà';
$strTableHasBeenFlushed = 'Áûë ñáðîøåí êýø òàáëèöû %s';
$strTableMaintenance = 'Îáñëóæèâàíèå òàáëèöû';
$strTables = '%s òàáëèö(û)';
$strTableStructure = 'Ñòðóêòóðà òàáëèöû';
$strTableType = 'Òèï òàáëèöû';
$strTextAreaLength = ' Èç-çà áîëüøîé äëèíû,<br /> ýòî ïîëå íå ìîæåò áûòü îòðåäàêòèðîâàíî ';
$strTheContent = 'Ñîäåðæèìîå ôàéëà áûëî èìïîðòèðîâàíî.';
$strTheContents = 'Ñîäåðæèìîå ôàéëà çàìåùàåò ñîäåðæèìîå òàáëèöû äëÿ ðÿäîâ ñ èäåíòè÷íûìè ïåðâè÷íûìè èëè óíèêàëüíûìè êëþ÷àìè.';
$strTheTerminator = 'Ñèìâîë îêîí÷àíèÿ ïîëåé.';
$strTotal = 'âñåãî';
$strType = 'Òèï';

$strUncheckAll = 'Ñíÿòü îòìåòêó ñî âñåõ';
$strUnique = 'Óíèêàëüíîå';
$strUnselectAll = 'Ñíÿòü îòìåòêó ñî âñåõ';
$strUpdatePrivMessage = 'Áûëè èçìåíåíû ïðèâèëåãèè äëÿ';
$strUpdateProfile = 'Îáíîâèòü ïðîôèëü:';
$strUpdateProfileMessage = 'Ïðîôèëü áûë îáíîâëåí.';
$strUpdateQuery = 'Äîïîëíèòü Çàïðîñ';
$strUsage = 'Èñïîëüçîâàíèå';
$strUseBackquotes = 'Îáðàòíûå êàâû÷êè â íàçâàíèÿõ òàáëèö è ïîëåé';
$strUser = 'Ïîëüçîâàòåëü';
$strUserEmpty = 'Ïóñòîå èìÿ ïîëüçîâàòåëÿ!';
$strUserName = 'Èìÿ ïîëüçîâàòåëÿ';
$strUsers = 'Ïîëüçîâàòåëè';
$strUseTables = 'Èñïîëüçîâàòü òàáëèöû';

$strValue = 'Çíà÷åíèå';
$strViewDump = 'Ïðîñìîòðåòü äàìï (ñõåìó) òàáëèöû';
$strViewDumpDB = 'Ïðîñìîòðåòü äàìï (ñõåìó) ÁÄ';

$strWelcome = 'Äîáðî ïîæàëîâàòü â %s';
$strWithChecked = 'Ñ îòìå÷åííûìè:';
$strWrongUser = 'Îøèáî÷íûé ëîãèí/ïàðîëü. Â äîñòóïå îòêàçàíî.';

$strYes = 'Äà';

$strZip = 'óïàêîâàòü â "zip"';

// To translate
?>
