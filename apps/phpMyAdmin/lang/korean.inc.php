<?php
/* $Id: korean.inc.php,v 1.96 2002/04/19 10:36:14 loic1 Exp $ */
/* Translated by WooSuhan <kjh@unews.co.kr> */

$charset = 'ks_c_5601-1987';
$text_dir = 'ltr';
$left_font_family = '"±¼¸²", sans-serif';
$right_font_family = '"±¼¸²", sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('¹ÙÀÌÆ®', 'KB', 'MB', 'GB');

$day_of_week = array('ÀÏ', '¿ù', 'È­', '¼ö', '¸ñ', '±Ý', 'Åä');
$month = array('ÇØ¿À¸§´Þ', '½Ã»ù´Þ', '¹°¿À¸§´Þ', 'ÀÙ»õ´Þ', 'Çª¸¥´Þ', '´©¸®´Þ', '°ß¿ìÁ÷³à´Þ', 'Å¸¿À¸§´Þ', '¿­¸Å´Þ', 'ÇÏ´Ã¿¬´Þ', '¹ÌÆ´´Þ', '¸Åµì´Þ');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%Y³â %B %dÀÏ %p %I:%M ';


$strAccessDenied = 'Á¢±ÙÀÌ °ÅºÎµÇ¾ú½À´Ï´Ù.';
$strAction = '½ÇÇà';
$strAddDeleteColumn = 'ÇÊµå Ä®·³ Ãß°¡/»èÁ¦';
$strAddDeleteRow = 'Criteria ¿­ Ãß°¡/»èÁ¦';
$strAddNewField = 'ÇÊµå Ãß°¡ÇÏ±â';
$strAddPriv = '±ÇÇÑ Ãß°¡ÇÏ±â';
$strAddPrivMessage = '»õ ±ÇÇÑÀ» Ãß°¡Çß½À´Ï´Ù';
$strAddSearchConditions = '°Ë»ö Á¶°Ç Ãß°¡ ("where" Á¶°ÇÀÇ ³»¿ë):';
$strAddToIndex = '%sÄ®·³¿¡ ÀÎµ¦½º Ãß°¡';
$strAddUser = '»õ »ç¿ëÀÚ Ãß°¡';
$strAddUserMessage = '»õ »ç¿ëÀÚ¸¦ Ãß°¡Çß½À´Ï´Ù.';
$strAffectedRows = 'Àû¿ëµÈ ¿­:';
$strAfter = '%s ´ÙÀ½¿¡';
$strAfterInsertBack = 'µÇµ¹¾Æ°¡±â';
$strAfterInsertNewInsert = '»õ ·¹ÄÚµå(¿­) »ðÀÔÇÏ±â';
$strAll = 'All'; // To translate
$strAlterOrderBy = '´ÙÀ½ ¼ø¼­´ë·Î Å×ÀÌºí Á¤·Ä(º¯°æ)';
$strAnalyzeTable = 'Å×ÀÌºí ºÐ¼®';
$strAnd = '±×¸®°í'; 
$strAnIndex = '%s ¿¡ ÀÎµ¦½º°¡ °É·È½À´Ï´Ù';
$strAny = 'Any'; // To translate
$strAnyColumn = '¾Æ¹« Ä®·³';
$strAnyDatabase = '¾Æ¹« µ¥ÀÌÅÍº£ÀÌ½º';
$strAnyHost = '¾Æ¹« È£½ºÆ®';
$strAnyTable = '¾Æ¹« Å×ÀÌºí';
$strAnyUser = '¾Æ¹« »ç¿ëÀÚ';
$strAPrimaryKey = ' %s¿¡ ±âº»(ÇÁ¶óÀÌ¸Ó¸®)Å°°¡ Ãß°¡µÇ¾ú½À´Ï´Ù';
$strAscending = '¿À¸§Â÷¼ø'; 
$strAtBeginningOfTable = 'Å×ÀÌºíÀÇ Ã³À½';
$strAtEndOfTable = 'Å×ÀÌºíÀÇ ¸¶Áö¸·';
$strAttr = 'º¸±â';

$strBack = 'µÚ·Î';
$strBinary = '¹ÙÀÌ³Ê¸®';
$strBinaryDoNotEdit = ' ¹ÙÀÌ³Ê¸® - ÆíÁý ±ÝÁö ';
$strBookmarkDeleted = 'ºÏ¸¶Å©¸¦ Á¦°ÅÇß½À´Ï´Ù.';
$strBookmarkLabel = 'Label'; // To translate
$strBookmarkQuery = 'ºÏ¸¶Å©µÈ SQL Äõ¸®';
$strBookmarkThis = 'ÀÌ SQL Äõ¸®¸¦ ºÏ¸¶Å©ÇÔ';
$strBookmarkView = 'View only'; // To translate
$strBrowse = 'º¸±â';
$strBzip = '"bz ¾ÐÃà"';

$strCantLoadMySQL = 'MySQL È®Àå¸ðµâÀ» ºÒ·¯¿Ã ¼ö ¾ø½À´Ï´Ù.<br />PHP ¼³Á¤À» °Ë»çÇÏ½Ê½Ã¿À..';
$strCantRenameIdxToPrimary = 'ÀÎµ¦½º ÀÌ¸§À» ±âº»(ÇÁ¶óÀÌ¸Ó¸®)Å°·Î ¹Ù²Ü ¼ö ¾ø½À´Ï´Ù!';
$strCardinality = 'Cardinality'; // To translate
$strCarriage = 'Ä³¸®Áö ¸®ÅÏ: \\r';
$strChange = 'º¯°æ';
$strChangePassword = '¾ÏÈ£ º¯°æ';
$strCheckAll = '¸ðµÎ Ã¼Å©';
$strCheckDbPriv = 'µ¥ÀÌÅÍº£ÀÌ½º ±ÇÇÑ °Ë»ç';
$strCheckTable = 'Å×ÀÌºí °Ë»ç';
$strColumn = 'Ä®·³';
$strColumnNames = 'Ä®·³(Çà) ÀÌ¸§';
$strCompleteInserts = '¿ÏÀüÇÑ INSERT¹® ÀÛ¼º';
$strConfirm = 'Á¤¸»·Î ÀÌ ÀÛ¾÷À» ÇÏ½Ã°Ú½À´Ï±î?';
$strCookiesRequired = 'ÄíÅ° »ç¿ëÀÌ °¡´ÉÇØ¾ß ÇÕ´Ï´Ù past this point.'; // To translate
$strCopyTable = 'Å×ÀÌºí º¹»çÇÏ±â (µ¥ÀÌÅÍº£ÀÌ½º¸í<b>.</b>Å×ÀÌºí¸í):';
$strCopyTableOK = '%s Å×ÀÌºíÀÌ %s À¸·Î º¹»çµÇ¾ú½À´Ï´Ù.';
$strCreate = ' ¸¸µé±â ';
$strCreateIndex = '%s Ä®·³¿¡ ÀÎµ¦½º ¸¸µé±â ';
$strCreateIndexTopic = '»õ ÀÎµ¦½º ¸¸µé±â';
$strCreateNewDatabase = 'Create new database'; // To translate
$strCreateNewTable = 'µ¥ÀÌÅÍº£ÀÌ½º %s¿¡ »õ·Î¿î Å×ÀÌºíÀ» ¸¸µì´Ï´Ù.';
$strCriteria = 'Criteria'; // To translate

$strData = 'µ¥ÀÌÅÍ';
$strDatabase = 'µ¥ÀÌÅÍº£ÀÌ½º ';
$strDatabaseHasBeenDropped = 'µ¥ÀÌÅÍº£ÀÌ½º %s ¸¦ Á¦°ÅÇß½À´Ï´Ù.';
$strDatabases = 'µ¥ÀÌÅÍº£ÀÌ½º ';
$strDatabasesStats = 'µ¥ÀÌÅÍº£ÀÌ½º »ç¿ë·® Åë°è';
$strDatabaseWildcard = 'µ¥ÀÌÅÍº£ÀÌ½º (¿ÍÀÏµåÄ«µå¹®ÀÚ »ç¿ë °¡´É):';
$strDataOnly = 'µ¥ÀÌÅÍ¸¸';
$strDefault = '±âº»°ª';
$strDelete = '»èÁ¦';
$strDeleted = '¼±ÅÃÇÑ ¿­À» »èÁ¦ ÇÏ¿´½À´Ï´Ù.';
$strDeletedRows = 'Áö¿öÁø ¿­:';
$strDeleteFailed = 'Deleted Failed!'; // To translate
$strDeleteUserMessage = '»ç¿ëÀÚ %s ¸¦ »èÁ¦Çß½À´Ï´Ù.';
$strDescending = '³»¸²Â÷¼ø(¿ª¼ø)';
$strDisplay = 'º¸±â';
$strDisplayOrder = 'Ãâ·Â ¼ø¼­:';
$strDoAQuery = '´ÙÀ½À¸·Î Äõ¸®¸¦ ¸¸µé±â (¿ÍÀÏµåÄ«µå: "%")';
$strDocu = 'µµ¿ò¸»';
$strDoYouReally = 'Á¤¸»·Î ´ÙÀ½À» ½ÇÇàÇÏ½Ã°Ú½À´Ï±î? ';
$strDrop = '»èÁ¦';
$strDropDB = 'µ¥ÀÌÅÍº£ÀÌ½º %s Á¦°Å';
$strDropTable = 'Å×ÀÌºí Á¦°Å';
$strDumpingData = 'Å×ÀÌºíÀÇ ´ýÇÁ µ¥ÀÌÅÍ';
$strDynamic = 'µ¿Àû(´ÙÀÌ³»¹Í)';

$strEdit = '¼öÁ¤';
$strEditPrivileges = '±ÇÇÑ ¼öÁ¤';
$strEffective = '½ÇÁ¦·®';
$strEmpty = 'ºñ¿ì±â';
$strEmptyResultSet = '°á°ú°ªÀÌ ¾ø½À´Ï´Ù. (ºó ¿­ ¸®ÅÏ.)';
$strEnd = '¸¶Áö¸·';
$strEnglishPrivileges = ' ÁÖÀÇ: MySQL ±ÇÇÑ ÀÌ¸§Àº ¿µ¾î·Î Ç¥±âµÇ¾î¾ß ÇÕ´Ï´Ù. ';
$strError = '¿À·ù';
$strExtendedInserts = 'È®ÀåµÈ inserts';
$strExtra = 'Ãß°¡';

$strField = 'ÇÊµå';
$strFieldHasBeenDropped = 'ÇÊµå %s ¸¦ Á¦°ÅÇß½À´Ï´Ù';
$strFields = 'ÇÊµå';
$strFieldsEmpty = ' ÇÊµå °¹¼ö°¡ ¾ø½À´Ï´Ù! ';
$strFieldsEnclosedBy = 'ÇÊµå °¨½Î±â';
$strFieldsEscapedBy = 'ÇÊµå Æ¯¼ö¹®ÀÚ(escape) Ã³¸®';
$strFieldsTerminatedBy = 'ÇÊµå ±¸ºÐÀÚ ';
$strFixed = 'fixed'; // To translate
$strFlushTable = 'Å×ÀÌºí ´Ý±â("FLUSH")';
$strFormat = 'Format'; // To translate
$strFormEmpty = 'Missing value in the form !'; // To translate
$strFullText = 'Full Texts'; // To translate
$strFunction = 'ÇÔ¼ö';

$strGenTime = 'Ã³¸®ÇÑ ½Ã°£';
$strGo = '½ÇÇà';
$strGrants = '½ÂÀÎ±ÇÇÑ';
$strGzip = 'gz ¾ÐÃà';

$strHasBeenAltered = 'À»(¸¦) º¯°æÇÏ¿´½À´Ï´Ù.';
$strHasBeenCreated = 'À»(¸¦) ÀÛ¼ºÇÏ¿´½À´Ï´Ù.';
$strHome = '½ÃÀÛÆäÀÌÁö';
$strHomepageOfficial = 'phpMyAdmin °ø½Ä È¨';
$strHomepageSourceforge = '¼Ò½ºÆ÷Áö phpMyAdmin ´Ù¿î·Îµå';
$strHost = 'È£½ºÆ®';
$strHostEmpty = 'È£½ºÆ®¸íÀÌ ¾ø½À´Ï´Ù!';

$strIdxFulltext = 'Fulltext'; // To translate
$strIfYouWish = 'Å×ÀÌºí ¿­(ÄÝ·³)¿¡ µ¥ÀÌÅÍ¸¦ Ãß°¡ÇÒ ¶§´Â ÇÊµå ¸®½ºÆ®¸¦ ÄÞ¸¶·Î ±¸ºÐÇØ ÁÖ½Ê½Ã¿ä. ';
$strIgnore = 'Ignore';
$strIndex = 'ÀÎµ¦½º';
$strIndexes = 'ÀÎµ¦½º';
$strIndexHasBeenDropped = 'ÀÎµ¦½º %s ¸¦ Á¦°ÅÇß½À´Ï´Ù';
$strIndexName = 'ÀÎµ¦½º ÀÌ¸§:';
$strIndexType = 'ÀÎµ¦½º Á¾·ù:';
$strInsert = 'Ãß°¡';
$strInsertAsNewRow = '»õ ¿­À» »ðÀÔÇÕ´Ï´Ù';
$strInsertedRows = '»ðÀÔµÈ ¿­:';
$strInsertNewRow = '»õ ¿­À» »ðÀÔ';
$strInsertTextfiles = 'ÅØ½ºÆ®ÆÄÀÏÀ» ÀÐ¾î¼­ Å×ÀÌºí¿¡ µ¥ÀÌÅÍ »ðÀÔ';
$strInstructions = '¼³¸í¼­';
$strInUse = '»ç¿ëÁß';
$strInvalidName = '"%s" ´Â ¿¹¾àµÈ ´Ü¾îÀÌ¹Ç·Î µ¥ÀÌÅÍº£ÀÌ½º, Å×ÀÌºí, ÇÊµå¸í¿¡ »ç¿ëÇÒ ¼ö ¾ø½À´Ï´Ù.';

$strKeepPass = '¾ÏÈ£¸¦ º¯°æÇÏÁö ¾ÊÀ½';
$strKeyname = 'Å° ÀÌ¸§';
$strKill = 'Kill';

$strLength = '±æÀÌ';
$strLengthSet = '±æÀÌ/°ª*';
$strLimitNumRows = 'ÆäÀÌÁö´ç ·¹ÄÚµå ¼ö';
$strLineFeed = 'ÁÙ¹Ù²Þ ¹®ÀÚ: \\n';
$strLines = 'ÁÙ(ú¼)';
$strLinesTerminatedBy = 'ÁÙ(¿­) ±¸ºÐÀÚ';
$strLocationTextfile = 'SQL ÅØ½ºÆ®ÆÄÀÏÀÇ À§Ä¡';
$strLogin = '·Î±×ÀÎ';
$strLogout = '·Î±×¾Æ¿ô';
$strLogPassword = '¾ÏÈ£:';
$strLogUsername = '»ç¿ëÀÚ¸í:';

$strModifications = '¼öÁ¤µÈ ³»¿ëÀÌ ÀúÀåµÇ¾ú½À´Ï´Ù.';
$strModify = '¼öÁ¤';
$strModifyIndexTopic = 'ÀÎµ¦½º ¼öÁ¤';
$strMoveTable = 'Å×ÀÌºí ¿Å±â±â (µ¥ÀÌÅÍº£ÀÌ½º¸í<b>.</b>Å×ÀÌºí¸í):';
$strMoveTableOK = 'Å×ÀÌºí %s À» %s ·Î ¿Å°å½À´Ï´Ù.';
$strMySQLReloaded = 'MySQLÀ» Àç½Ãµ¿Çß½À´Ï´Ù.';
$strMySQLSaid = 'MySQL ¸Þ½ÃÁö: ';
$strMySQLServerProcess = '%pma_s2% (MySQL %pma_s1%)¿¡ %pma_s3% °èÁ¤À¸·Î µé¾î¿Ô½À´Ï´Ù.';
$strMySQLShowProcess = 'MySQL ÇÁ·Î¼¼½º º¸±â';
$strMySQLShowStatus = 'MySQL ·±Å¸ÀÓ »óÅÂ º¸±â';
$strMySQLShowVars = 'MySQL ½Ã½ºÅÛ È¯°æº¯¼ö º¸±â';

$strName = 'ÀÌ¸§';
$strNbRecords = '¿­(·¹ÄÚµå) °¹¼ö';
$strNext = '´ÙÀ½';
$strNo = ' ¾Æ´Ï¿À ';
$strNoDatabases = 'No databases'; // To translate
$strNoDropDatabases = '"DROP DATABASE" ±¸¹®Àº Çã¶ôµÇÁö ¾Ê½À´Ï´Ù.';
$strNoFrames = 'phpMyAdmin Àº <b>ÇÁ·¹ÀÓÀ» ¾µ ¼ö ÀÖ´Â</b> ºê¶ó¿ìÀú¿¡¼­ Àß º¸ÀÔ´Ï´Ù.';
$strNoIndex = 'ÀÎµ¦½º°¡ ¼³Á¤µÇÁö ¾Ê¾Ò½À´Ï´Ù!';
$strNoIndexPartsDefined = 'No index parts defined!'; // To translate
$strNoModification = 'º¯È­ ¾øÀ½';
$strNone = 'None';
$strNoPassword = '¾ÏÈ£ ¾øÀ½';
$strNoPrivileges = '±ÇÇÑ ¾øÀ½';
$strNoQuery = 'SQL Äõ¸® ¾øÀ½!';
$strNoRights = '¾î¶»°Ô µé¾î¿À¼Ì¾î¿ä? Áö±Ý ¿©±â ÀÖÀ» ±ÇÇÑÀÌ ¾ø½À´Ï´Ù!';
$strNoTablesFound = 'µ¥ÀÌÅÍº£ÀÌ½º¿¡ Å×ÀÌºíÀÌ ¾ø½À´Ï´Ù.';
$strNotNumber = 'Àº ¼ýÀÚ(¹øÈ£)°¡ ¾Æ´Õ´Ï´Ù!';
$strNotValidNumber = 'Àº ¿Ã¹Ù¸¥ ¿­ ¹øÈ£°¡ ¾Æ´Õ´Ï´Ù!';
$strNoUsersFound = '»ç¿ëÀÚ°¡ ¾ø½À´Ï´Ù.';
$strNull = 'Null'; // To translate

$strOftenQuotation = 'Often quotation marks. ¿É¼Ç(OPTIONALLY)Àº char ¹× varchar ÇÊµå°¡ "enclosed by"-character·Î ´ÝÈù´Ù´Â °ÍÀ» ¶æÇÕ´Ï´Ù.';  // To translate
$strOptimizeTable = 'Å×ÀÌºí ÃÖÀûÈ­';
$strOptionalControls = 'Æ¯¼ö¹®ÀÚ ÀÐ±â/¾²±â ¿É¼Ç';
$strOptionally = '¿É¼ÇÀÔ´Ï´Ù.';
$strOr = '¶Ç´Â';
$strOverhead = 'ºÎ´ã';

$strPartialText = 'Partial Texts'; // To translate
$strPassword = '¾ÏÈ£';
$strPasswordEmpty = '¾ÏÈ£°¡ ºñ¾ú½À´Ï´Ù!';
$strPasswordNotSame = '¾ÏÈ£°¡ µ¿ÀÏÇÏÁö ¾Ê½À´Ï´Ù!';
$strPHPVersion = 'PHP ¹öÀü';
$strPmaDocumentation = 'phpMyAdmin ¼³¸í¼­';
$strPmaUriError = 'È¯°æ¼³Á¤ ÆÄÀÏ¿¡¼­ <tt>$cfgPmaAbsoluteUri</tt> ÁÖ¼Ò¸¦ ±âÀÔÇÏ½Ê½Ã¿À!';
$strPos1 = 'Ã³À½';
$strPrevious = 'ÀÌÀü';
$strPrimary = '±âº»';
$strPrimaryKey = '±âº»(ÇÁ¶óÀÌ¸Ó¸®) Å°';
$strPrimaryKeyHasBeenDropped = '±âº»(ÇÁ¶óÀÌ¸Ó¸®)Å°¸¦ Á¦°ÅÇß½À´Ï´Ù';
$strPrimaryKeyName = '±âº»(ÇÁ¶óÀÌ¸Ó¸®)Å°ÀÇ ÀÌ¸§Àº ¹Ýµå½Ã PRIMARY¿©¾ß ÇÕ´Ï´Ù!';
$strPrimaryKeyWarning = '("PRIMARY"´Â <b>¹Ýµå½Ã</b> ±âº»(ÇÁ¶óÀÌ¸Ó¸®)Å°ÀÇ <b>À¯ÀÏÇÑ</b> ÀÌ¸§ÀÌ¾î¾ß ÇÕ´Ï´Ù!)';
$strPrintView = 'ÀÎ¼â¿ë º¸±â';
$strPrivileges = '±ÇÇÑ';
$strProperties = '¼Ó¼º';

$strQBE = '¿¹(çÓ)¿¡¼­ Äõ¸® ½ÇÇà';
$strQBEDel = '»èÁ¦';
$strQBEIns = '»ðÀÔ';
$strQueryOnDb = 'µ¥ÀÌÅÍº£ÀÌ½º <b>%s</b>¿¡ SQL Äõ¸®:';

$strRecords = '·¹ÄÚµå¼ö';
$strReferentialIntegrity = 'referential integrity °Ë»ç:';
$strReloadFailed = 'MySQL Àç½Ãµ¿¿¡ ½ÇÆÐÇÏ¿´½À´Ï´Ù.';
$strReloadMySQL = 'MySQL Àç½Ãµ¿';
$strRememberReload = '¼­¹ö¸¦ Àç½Ãµ¿ÇÏ´Â °ÍÀ» ÀØÁö¸¶¼¼¿ä.';
$strRenameTable = 'Å×ÀÌºí ÀÌ¸§ º¯°æÇÏ±â';
$strRenameTableOK = 'Å×ÀÌºí %sÀ»(¸¦) %s(À¸)·Î º¯°æÇÏ¿´½À´Ï´Ù.';
$strRepairTable = 'Å×ÀÌºí º¹±¸';
$strReplace = '´ëÄ¡(Replace)';
$strReplaceTable = 'ÆÄÀÏ·Î Å×ÀÌºí ´ëÄ¡ÇÏ±â';
$strReset = '¸®¼¼Æ®';
$strReType = 'ÀçÀÔ·Â';
$strRevoke = 'Á¦°Å';
$strRevokeGrant = '½ÂÀÎ Á¦°Å';
$strRevokeGrantMessage = '%sÀÇ ½ÂÀÎ ±ÇÇÑÀ» Á¦°ÅÇß½À´Ï´Ù.';
$strRevokeMessage = '%sÀÇ ±ÇÇÑÀ» Á¦°ÅÇß½À´Ï´Ù.';
$strRevokePriv = '±ÇÇÑ Á¦°Å';
$strRowLength = '¿­ ±æÀÌ';
$strRows = '¿­';
$strRowsFrom = '¿­. ½ÃÀÛ(¿­)À§Ä¡';
$strRowSize = ' Row size ';
$strRowsModeHorizontal = '¼öÆò(°¡·Î)';
$strRowsModeOptions = ' %s Á¤·Ä (%s Ä­ÀÌ ³ÑÀ¸¸é Çì´õ ¹Ýº¹)';
$strRowsModeVertical = '¼öÁ÷(¼¼·Î)';
$strRowsStatistic = '¿­ Åë°è';
$strRunning = 'ÀÔ´Ï´Ù. (%s)';
$strRunQuery = 'Äõ¸® ½ÇÇà'; 
$strRunSQLQuery = 'µ¥ÀÌÅÍº£ÀÌ½º %s¿¡ SQL Äõ¸®¸¦ ½ÇÇà';

$strSave = 'º¸Á¸';
$strSelect = '¼±ÅÃ';
$strSelectADb = 'µ¥ÀÌÅÍº£ÀÌ½º¸¦ ¼±ÅÃÇÏ¼¼¿ä';
$strSelectAll = '¸ðµÎ ¼±ÅÃ';
$strSelectFields = 'ÇÊµå ¼±ÅÃ (ÇÏ³ª ÀÌ»ó):';
$strSelectNumRows = 'Äõ¸®(in query)';
$strSend = 'ÆÄÀÏ·Î ÀúÀå';
$strServerChoice = '¼­¹ö ¼±ÅÃ';
$strServerVersion = '¼­¹ö ¹öÀü';
$strSetEnumVal = 'ÇÊµå Á¾·ù°¡ "enum"ÀÌ³ª "set"ÀÌ¸é, ´ÙÀ½°ú °°Àº Çü½ÄÀ¸·Î °ªÀ» ÀÔ·ÂÇÏ½Ê½Ã¿À: \'a\',\'b\',\'c\'...<br />ÀÌ °ª¿¡ ¿ª½½·¡½Ã("\")³ª ÀÛÀºµû¿ÈÇ¥("\'")°¡ ³Ö¾î¾ß ÇÑ´Ù¸é, ¿ª½½·¡½Ã¸¦ »ç¿ëÇÏ½Ê½Ã¿À. (¿¹: \'\\\\xyz\' ¶Ç´Â \'a\\\'b\').';
$strShow = 'º¸±â';
$strShowAll = '¸ðµÎ º¸±â'; 
$strShowCols = 'Ä®·³(Çà) º¸±â';
$strShowingRecords = '·¹ÄÚµå(¿­) º¸±â';
$strShowPHPInfo = 'PHP Á¤º¸ º¸±â';
$strShowTables = 'Å×ÀÌºí º¸±â';
$strShowThisQuery = ' ÀÌ Äõ¸®¸¦ ´Ù½Ã º¸¿©ÁÜ ';
$strSingly = '(singly)';
$strSize = 'Å©±â';
$strSort = 'Sort'; // To translate
$strSpaceUsage = '°ø°£ »ç¿ë·®';
$strSQLQuery = 'SQL Äõ¸®';
$strStartingRecord = '½ÃÀÛ À§Ä¡(¿­)';
$strStatement = '¸í¼¼';
$strStrucCSV = 'CSV µ¥ÀÌÅÍ';
$strStrucData = '±¸Á¶¿Í µ¥ÀÌÅÍ';
$strStrucDrop = '\'DROP TABLE\'¹® Ãß°¡';
$strStrucExcelCSV = 'MS¿¢¼¿ CSV µ¥ÀÌÅÍ';
$strStrucOnly = '±¸Á¶¸¸';
$strSubmit = 'È®ÀÎ';
$strSuccess = 'SQL Äõ¸®°¡ ¹Ù¸£°Ô ½ÇÇàµÇ¾ú½À´Ï´Ù.';
$strSum = '°è';

$strTable = 'Å×ÀÌºí ';
$strTableComments = 'Å×ÀÌºí ¼³¸í';
$strTableEmpty = 'Å×ÀÌºí¸íÀÌ ¾ø½À´Ï´Ù!';
$strTableHasBeenDropped = 'Å×ÀÌºí %s À» Á¦°ÅÇß½À´Ï´Ù.';
$strTableHasBeenEmptied = 'Å×ÀÌºí %s À» ºñ¿ü½À´Ï´Ù';
$strTableHasBeenFlushed = 'Å×ÀÌºí %s À» ´Ý¾Ò½À´Ï´Ù(flushed)';
$strTableMaintenance = 'Å×ÀÌºí À¯Áöº¸¼ö';
$strTables = 'Å×ÀÌºí %s °³';
$strTableStructure = 'Å×ÀÌºí ±¸Á¶';
$strTableType = 'Å×ÀÌºí Á¾·ù';
$strTextAreaLength = ' ÇÊµåÀÇ ±æÀÌ ¶§¹®¿¡,<br />ÀÌ ÇÊµå¸¦ ÆíÁýÇÒ ¼ö ¾ø½À´Ï´Ù ';
$strTheContent = 'ÆÄÀÏ ³»¿ëÀ» »ðÀÔÇÏ¿´½À´Ï´Ù.';
$strTheContents = 'ÆÄÀÏ ³»¿ëÀÌ ¼±ÅÃÇÑ Å×ÀÌºíÀÇ ÇÁ¶óÀÌ¸Ó¸® È¤Àº °íÀ¯°ª Å°¿Í ÀÏÄ¡ÇÏ´Â ¿­À» ´ëÄ¡(ÓÛöÇ)½ÃÅ°°Ú½À´Ï´Ù.';
$strTheTerminator = 'ÇÊµå Á¾·á ±âÈ£.';
$strTotal = 'ÇÕ°è';
$strType = 'Á¾·ù';

$strUncheckAll = '¸ðµÎ Ã¼Å©¾ÈÇÔ';
$strUnique = '°íÀ¯°ª';
$strUnselectAll = '¸ðµÎ ¼±ÅÃ¾ÈÇÔ';
$strUpdatePrivMessage = '%s ÀÇ ±ÇÇÑÀ» ¾÷µ¥ÀÌÆ®Çß½À´Ï´Ù.';
$strUpdateProfile = 'ÇÁ·ÎÆÄÀÏ ¾÷µ¥ÀÌÆ®:';
$strUpdateProfileMessage = 'ÇÁ·ÎÆÄÀÏÀ» ¾÷µ¥ÀÌÆ®Çß½À´Ï´Ù.';
$strUpdateQuery = 'Äõ¸® ¾÷µ¥ÀÌÆ®';
$strUsage = '»ç¿ë¹ý(·®)';
$strUseBackquotes = 'Å×ÀÌºí, ÇÊµå¸í¿¡ ¹éÄõÅÍ(`) »ç¿ë';
$strUser = '»ç¿ëÀÚ';
$strUserEmpty = '»ç¿ëÀÚ¸íÀÌ ¾ø½À´Ï´Ù!';
$strUserName = '»ç¿ëÀÚ¸í';
$strUsers = '»ç¿ëÀÚµé';
$strUseTables = 'Use Tables';

$strValue = '°ª';
$strViewDump = 'Å×ÀÌºíÀÇ ´ýÇÁ(½ºÅ°¸¶) µ¥ÀÌÅÍ º¸±â';
$strViewDumpDB = 'µ¥ÀÌÅÍº£ÀÌ½ºÀÇ ´ýÇÁ(½ºÅ°¸¶) µ¥ÀÌÅÍ º¸±â';

$strWelcome = '%s¿¡ ¿À¼Ì½À´Ï´Ù';
$strWithChecked = '¼±ÅÃÇÑ °ÍÀ»:';
$strWrongUser = '»ç¿ëÀÚ¸í/¾ÏÈ£°¡ Æ²·È½À´Ï´Ù. Á¢±ÙÀÌ °ÅºÎµÇ¾ú½À´Ï´Ù.';

$strYes = ' ¿¹ ';

$strZip = 'zip ¾ÐÃà';

// To translate
?>
