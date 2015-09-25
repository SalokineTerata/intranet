<?php
/* $Id: japanese-euc.inc.php,v 1.20.2.1 2002/06/18 21:33:05 rabus Exp $ */

/**
 * Translated by Yukihiro Kawada <luc at ceres.dti.ne.jp>
 */

$charset = 'euc-jp';
$text_dir = 'ltr';
$left_font_family = 'sans-serif';
$right_font_family = 'sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('¥Ð¥¤¥È', 'KB', 'MB', 'GB');

$day_of_week = array('Æü', '·î', '²Ð', '¿å', 'ÌÚ', '¶â', 'ÅÚ');
$month = array('1·î','2·î','3·î','4·î','5·î','6·î','7·î','8·î','9·î','10·î','11·î','12·î');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%YÇ¯%B%eÆü %H:%M';


$strAccessDenied = '¥¢¥¯¥»¥¹¤ÏµñÈÝ¤µ¤ì¤Þ¤·¤¿¡£';
$strAction = '¼Â¹Ô';
$strAddDeleteColumn = '¥Õ¥£¡¼¥ë¥ÉÎó¤Î¡ÖÄÉ²Ã¡¿ºï½ü¡×';
$strAddDeleteRow = '¾ò·ï¹Ô¤Î¡ÖÄÉ²Ã¡¿ºï½ü¡×';
$strAddNewField = '¥Õ¥£¡¼¥ë¥É¤ÎÄÉ²Ã';
$strAddPriv = '¿·¤·¤¤ÆÃ¸¢¤ÎÄÉ²Ã';
$strAddPrivMessage = '¿·¤·¤¤ÆÃ¸¢¤òÄÉ²Ã¤·¤Þ¤·¤¿¡£';
$strAddSearchConditions = '¸¡º÷¾ò·ïÊ¸¤òÄÉ²Ã¤·¤Æ¤¯¤À¤µ¤¤¡£("where"¤ÎÀáÊ¸):';
$strAddToIndex = ' &nbsp;%s&nbsp;¤ÎÎó¤ò¥¤¥ó¥Ç¥Ã¥¯¥¹¤ËÄÉ²Ã¤·¤Þ¤·¤¿';
$strAddUser = '¥æ¡¼¥¶¡¼¤ÎÄÉ²Ã';
$strAddUserMessage = '¥æ¡¼¥¶¡¼¤òÄÉ²Ã¤·¤Þ¤·¤¿¡£';
$strAffectedRows = '±Æ¶Á¤µ¤ì¤¿¹Ô¿ô:';
$strAfter = '¸å¤Ë %s';
$strAfterInsertBack = 'Ìá¤ë';
$strAfterInsertNewInsert = '¿·¥ì¥³¡¼¥É¤ÎÄÉ²Ã';
$strAll = 'Á´Éô';
$strAlterOrderBy = '¥Æ¡¼¥Ö¥ë½çÈÖ¤Î¾ò·ï';
$strAnalyzeTable = '¥Æ¡¼¥Ö¥ë¤òÊ¬ÀÏ¤·¤Þ¤¹¡£';
$strAnd = 'µÚ¤Ó';
$strAnIndex = '¥¤¥ó¥Ç¥Ã¥¯¥¹¤¬%s¤ËÄÉ²Ã¤µ¤ì¤Þ¤·¤¿¡£';
$strAny = 'Á´¤Æ';
$strAnyColumn = 'Á´¥³¥é¥à';
$strAnyDatabase = 'Á´¥Ç¡¼¥¿¥Ù¡¼¥¹';
$strAnyHost = 'Á´¤Æ¤Î¥Û¥¹¥È';
$strAnyTable = 'Á´¤Æ¤Î¥Æ¡¼¥Ö¥ë';
$strAnyUser = 'Á´¤Æ¤Î¥æ¡¼¥¶¡¼';
$strAPrimaryKey = '¼çÍ×¥­¡¼¤¬%s¤ËÄÉ²Ã¤µ¤ì¤Þ¤·¤¿¡£';
$strAscending = '¾º½ç';
$strAtBeginningOfTable = '¥Æ¡¼¥Ö¥ë¤ÎºÇ½é';
$strAtEndOfTable = '¥Æ¡¼¥Ö¥ë¤ÎºÇ¸å';
$strAttr = 'É½¼¨';

$strBack = 'Ìá¤ë';
$strBinary = ' ¥Ð¥¤¥Ê¥ê ';
$strBinaryDoNotEdit = ' ¥Ð¥¤¥Ê¥ê -  ½¤Àµ½ÐÍè¤Þ¤»¤ó';
$strBookmarkDeleted = '¥Ö¥Ã¥¯¥Þ¡¼¥¯¤òÀµ¾ï¤Ëºï½ü¤·¤Þ¤·¤¿¡£';
$strBookmarkLabel = '¥é¥Ù¥ë';
$strBookmarkQuery = '¥Ö¥Ã¥¯¥Þ¡¼¥¯¤µ¤ì¤Æ¤¤¤ëSQL¥¯¥¨¥ê¡¼';
$strBookmarkThis = 'SQL¥¯¥¨¥ê¡¼¤ò¥Ö¥Ã¥¯¥Þ¡¼¥¯¤¹¤ë';
$strBookmarkView = 'È¯É½¤À¤±';
$strBrowse = 'É½¼¨';
$strBzip = '"bzip¤µ¤ì¤ë"';

$strCantLoadMySQL = 'MySQL¤ò¼Â¹Ô¤Ç¤­¤Þ¤»¤ó¡£<br />PHP¤ÎÀßÄê¤ò³ÎÇ§¤·¤Æ²¼¤µ¤¤¡£';
$strCantRenameIdxToPrimary = '¥¤¥ó¥Ç¥Ã¥¯¥¹¤ÎÌ¾Á°¤òPRIMARY¤ËÊÑ¹¹¤Ç¤­¤Þ¤»¤ó¡£';
$strCardinality = '¥«¡¼¥Ç¥£¥Ê¥ê¥Æ¥£';
$strCarriage = '¥­¥ã¥ê¥Ã¥¸¥ê¥¿¡¼¥ó: \\r';
$strChange = 'ÊÑ¹¹';
$strChangePassword = '¥Ñ¥¹¥ï¡¼¥É¤ÎÊÑ¹¹';
$strCheckAll = 'Á´¤Æ¤ò¥Þ¡¼¥¯';
$strCheckDbPriv = '¥Ç¡¼¥¿¥Ù¡¼¥¹¤ÎÆÃ¸¢¤Î³ÎÇ§';
$strCheckTable = '¥Æ¡¼¥Ö¥ë¤ò¥Á¥§¥Ã¥¯¤·¤Þ¤¹¡£';
$strColumn = 'Îó';
$strColumnNames = 'Îó(¥³¥é¥à)Ì¾';
$strCompleteInserts = '´°Á´¤ÊINSERTÊ¸¤ÎºîÀ®';
$strConfirm = '¼Â¹Ô¤·¤Æ¤âÎÉ¤¤¤Ç¤¹¤«¡©';
$strCookiesRequired = '¤³¤³¤«¤éÀè¤Ï¥¯¥Ã¥­¡¼¤¬µö²Ä¤µ¤ì¤Æ¤¤¤ëÉ¬Í×¤¬¤¢¤ê¤Þ¤¹¡£';
$strCopyTable = '¥Æ¡¼¥Ö¥ë¤ò(database<b>.</b>table)¤Ë¥³¥Ô¡¼¤¹¤ë:';
$strCopyTableOK = '%s¥Æ¡¼¥Ö¥ë¤ò%s¤Ë¥³¥Ô¡¼¤·¤Þ¤·¤¿¡£';
$strCreate = 'ºîÀ®';
$strCreateIndex = '&nbsp;%s&nbsp;¤ÎÎó¤Î¥¤¥ó¥Ç¥Ã¥¯¥¹¤ÎºîÀ®';
$strCreateIndexTopic = '¿·¤·¤¤¥¤¥ó¥Ç¥Ã¥¯¥¹¤ÎºîÀ®';
$strCreateNewDatabase = '¿·¤·¤¤DB¤òºîÀ®¤·¤Þ¤¹¡£';
$strCreateNewTable = '¸½ºß¤ÎDB¤Ë¿·¤·¤¤¥Æ¡¼¥Ö¥ë¤òºîÀ®¤·¤Þ¤¹¡£ %s --> ';
$strCriteria = '´ð½à';

$strData = '¥Ç¡¼¥¿';
$strDatabase = '¥Ç¡¼¥¿¥Ù¡¼¥¹';
$strDatabaseHasBeenDropped = '¥Ç¡¼¥¿¥Ù¡¼¥¹%s¤òÀµ¾ï¤Ëºï½ü¤·¤Þ¤·¤¿¡£';
$strDatabases = '¥Ç¡¼¥¿¥Ù¡¼¥¹';
$strDatabasesStats = '¥Ç¡¼¥¿¥Ù¡¼¥¹¤ÎÅý·×';
$strDatabaseWildcard = '¥Ç¡¼¥¿¥Ù¡¼¥¹(¥ï¥¤¥ë¥É¥«¡¼¥É»ÈÍÑ²Ä):';
$strDataOnly = '¥Ç¡¼¥¿¤Î¤ß';
$strDefault = '´ðËÜÃÍ';
$strDelete = 'ºï½ü';
$strDeleted = 'ÁªÂò¤·¤¿Îó¤òºï½ü¤·¤Þ¤·¤¿¡£';
$strDeleteFailed = 'ºï½ü¤Ë¼ºÇÔ¤·¤Þ¤·¤¿';
$strDeleteUserMessage = '¥æ¡¼¥¶¡¼%s¤òºï½ü¤·¤Þ¤·¤¿¡£';
$strDeletedRows = 'ºï½ü¤µ¤ì¤¿¹Ô¿ô:';
$strDescending = '¹ß½ç';
$strDisplay = 'É½¼¨';
$strDisplayOrder = 'È¯É½½çÈÖ:';
$strDoAQuery = '"Îã¤ÎQUERY"¤ò¼Â¹Ô (wildcard: "%")';
$strDocu = '¥Ø¥ë¥×';
$strDoYouReally = 'ËÜÅö¤Ë¼Â¹Ô¤·¤Æ¤âÎÉ¤¤¤Ç¤¹¤«¡© --> ';
$strDrop = 'ºï½ü';
$strDropDB = '¥Ç¡¼¥¿¥Ù¡¼¥¹%s¤Îºï½ü ';
$strDropTable = '¥Æ¡¼¥Ö¥ë¤Îºï½ü';
$strDumpingData = '¥Æ¡¼¥Ö¥ë¤Î¥À¥ó¥×¥Ç¡¼¥¿';
$strDynamic = '¥À¥¤¥Ê¥ß¥Ã¥¯';

$strEdit = '½¤Àµ';
$strEditPrivileges = 'ÆÃ¸¢¤ò½¤Àµ';
$strEffective = '»ö¼Â¾å';
$strEmpty = '¶õ¤Ë¤¹¤ë';
$strEmptyResultSet = 'MySQL¤¬¶õ¤ÎÃÍ¤òÊÖ¤·¤Þ¤·¤¿¡£(i.e. zero rows).';
$strEnd = 'ºÇ¸å';
$strEnglishPrivileges = ' Ãí°Õ: MySQL¤ÎÆÃ¸¢¤ÎÌ¾Á°¤Ï±Ñ¸ì¤ÇÈ¯É½¤·¤Æ¤¤¤Þ¤¹¡£';
$strError = '¥¨¥é¡¼';
$strExtendedInserts = 'Ä¹¤¤INSERTÊ¸¤ÎºîÀ®';
$strExtra = 'ÄÉ²Ã';

$strField = '¥Õ¥£¡¼¥ë¥É';
$strFieldHasBeenDropped = '¥Õ¥£¡¼¥ë¥É%s¤¬Àµ¾ï¤Ëºï½ü¤µ¤ì¤Þ¤·¤¿';
$strFields = '¥Õ¥£¡¼¥ë¥É';
$strFieldsEmpty = ' ¥Õ¥£¡¼¥ë¥É¿ô¤Ï¶õ¤Ç¤¹¡£ ';
$strFieldsEnclosedBy = '¥Õ¥£¡¼¥ë¥É°Ï¤ßµ­¹æ';
$strFieldsEscapedBy = '¥Õ¥£¡¼¥ë¥É¤Î¥¨¥¹¥±¡¼¥×µ­¹æ';
$strFieldsTerminatedBy = '¥Õ¥£¡¼¥ë¥É¶èÀÚ¤êµ­¹æ';
$strFixed = '¸ÇÄê';
$strFlushTable = '¥Æ¡¼¥Ö¥ë¤Î¥­¥ã¥Ã¥·¥å¤ò¶õ¤Ë¤¹¤ë("FLUSH")';
$strFormat = '¥Õ¥©¡¼¥Þ¥Ã¥È';
$strFormEmpty = '¥Õ¥©¡¼¥à¤Ç¤ÏÃÍ¤¬¤¢¤ê¤Þ¤»¤ó¤Ç¤·¤¿¡£';
$strFullText = 'Á´Ê¸';
$strFunction = '´Ø¿ô';

$strGenTime = 'ºîÀ®¤Î»þ´Ö';
$strGo = '¼Â¹Ô';
$strGrants = 'ÉÕÍ¿';
$strGzip = '"gzip¤µ¤ì¤ë"';

$strHasBeenAltered = '¤òÊÑ¹¹¤·¤Þ¤·¤¿¡£';
$strHasBeenCreated = '¤òºîÀ®¤·¤Þ¤·¤¿¡£';
$strHome = '¥á¡¼¥ó¥Ú¡¼¥¸¤Ø';
$strHomepageOfficial = 'phpMyAdmin¥Û¡¼¥à';
$strHomepageSourceforge = 'Sourceforge¤ÎphpMyAdmin¥À¥¦¥ó¥í¡¼¥É¥Ú¡¼¥¸';
$strHost = '¥Û¥¹¥È';
$strHostEmpty = '¥Û¥¹¥ÈÌ¾¤Ï¶õ¤Ç¤¹!';

$strIdxFulltext = 'Á´Ê¸';
$strIfYouWish = '¥Æ¡¼¥Ö¥ë¤Î¥³¥é¥à(Îó)¤Ë¥Ç¡¼¥¿¤òÄÉ²Ã¤¹¤ë¾ì¹ç¤Ï¡¢¥Õ¥£¡¼¥ë¥É¥ê¥¹¥È¤ò¥«¥ó¥Þ¤Ç¶èÊ¬¤·¤Æ¤¯¤À¤µ¤¤¡£';
$strIgnore = 'Ìµ»ë';
$strIndex = '¥¤¥ó¥Ç¥Ã¥¯¥¹';
$strIndexes = '¥¤¥ó¥Ç¥Ã¥¯¥¹¿ô';
$strIndexHasBeenDropped = '¥¤¥ó¥Ç¥Ã¥¯¥¹%s¤¬ºï½ü¤µ¤ì¤Þ¤·¤¿';
$strIndexName = '¥¤¥ó¥Ç¥Ã¥¯¥¹Ì¾&nbsp;:';
$strIndexType = '¥¤¥ó¥Ç¥Ã¥¯¥¹¤Î¥¿¥¤¥×&nbsp;:';
$strInsert = 'ÄÉ²Ã';
$strInsertAsNewRow = '¿·¤·¤¤¹Ô¤È¤·¤Æ¤ÎÄÉ²Ã';
$strInsertedRows = 'ÄÉ²Ã¤µ¤ì¤¿¹Ô¿ô:';
$strInsertNewRow = '¿·¤·¤¤¹Ô¤ÎÄÉ²Ã';
$strInsertTextfiles = '¥Æ¡¼¥Ö¥ë¤Ë¥Æ¥­¥¹¥È¥Õ¥¡¥¤¥ë¤ÎÄÉ²Ã';
$strInstructions = '¶µ¼¨';
$strInUse = '»ÈÍÑÃæ';
$strInvalidName = '"%s"¤ÏÍ½Ìó¸ì¤Ç¤¹¤«¤é¡Ö¥Ç¡¼¥¿¥Ù¡¼¥¹¡¿¥Æ¡¼¥Ö¥ë¡¿¥Õ¥£¡¼¥ë¥É¡×Ì¾¤Ë¤Ï»È¤¨¤Þ¤»¤ó¡£';

$strKeepPass = '¥Ñ¥¹¥ï¡¼¥É¤òÊÑ¹¹¤·¤Ê¤¤';
$strKeyname = '¥­¡¼Ì¾';
$strKill = 'Ää»ß';

$strLength = 'Ä¹¤µ';
$strLengthSet = 'Ä¹¤µ/¥»¥Ã¥È*';
$strLimitNumRows = '¥Ú¡¼¥¸¤Î¥ì¥³¡¼¥É¿ô';
$strLineFeed = '²þ¹ÔÊ¸»ú: \\n';
$strLines = '¹Ô';
$strLinesTerminatedBy = '¹Ô¤Î½ªÃ¼µ­¹æ';
$strLocationTextfile = '¥Æ¥­¥¹¥È¥Õ¥¡¥¤¥ë¤Î¾ì½ê';
$strLogin = '¥í¥°¥¤¥ó';
$strLogout = '¥í¥°¥¢¥¦¥È';
$strLogPassword = '¥Ñ¥¹¥ï¡¼¥É:';
$strLogUsername = '¥æ¡¼¥¶¡¼Ì¾:';

$strModifications = '¤òÀµ¤·¤¯½¤Àµ¤·¤Þ¤·¤¿¡£';
$strModify = '½¤Àµ';
$strModifyIndexTopic = '¥¤¥ó¥Ç¥Ã¥¯¥¹¤ÎÊÑ¹¹';
$strMoveTable = '¥Æ¡¼¥Ö¥ë¤ò(database<b>.</b>table)¤Ë°ÜÆ°:';
$strMoveTableOK = '¥Æ¡¼¥Ö¥ë%s¤¬%s°ÜÆ°¤µ¤ì¤Þ¤·¤¿¡£';
$strMySQLReloaded = 'MySQL¤ò¿·¤·¤¯ÆÉ¤ß¹þ¤ß¤Þ¤·¤¿¡£';
$strMySQLSaid = 'MySQL¤Î¥á¥Ã¥»¡¼¥¸ --> ';
$strMySQLServerProcess = 'MySQL %pma_s1%¤Ï%pma_s2%¾å%pma_s3%¤È¤·¤Æ¼Â¹Ô¤·¤Æ¤¤¤Þ¤¹¡£';
$strMySQLShowProcess = 'MySQL¥×¥í¥»¥¹¤ÎÉ½¼¨';
$strMySQLShowStatus = 'MySQL¤Î¥é¥ó¥¿¥¤¥à¾ðÊó';
$strMySQLShowVars = 'MySQL¤Î¥·¥¹¥Æ¥àÊÑ¿ô';

$strName = 'Ì¾Á°';
$strNbRecords = '¥ì¥³¡¼¥É¿ô';
$strNext = '¼¡¤Ø';
$strNo = '¤¤¤¤¤¨';
$strNoDatabases = '¥Ç¡¼¥¿¥Ù¡¼¥¹¿ô';
$strNoDropDatabases = '"DROP DATABASE"¥¹¥Æ¡¼¥È¥á¥ó¥È¤Ï¶Ø»ß¤µ¤ì¤ë¡£';
$strNoFrames = '<b>¥Õ¥ì¡¼¥à</b>²ÄÇ½¤Ê¥Ö¥é¥¦¥¶¡¼¤ÎÊý¤¬phpMyAdmin¤Ï»È¤¤¤ä¤¹¤¤¤Ç¤¹¡£';
$strNoIndex = '¥¤¥ó¥Ç¥Ã¥¯¥¹¤ÏÀßÄê¤µ¤ì¤Æ¤¤¤Þ¤»¤ó¡£';
$strNoIndexPartsDefined = '¥¤¥ó¥Ç¥Ã¥¯¥¹¤ÎÉôÊ¬¤ÏÀßÄê¤µ¤ì¤Æ¤¤¤Þ¤»¤ó¡£';
$strNoModification = 'ÊÑ¹¹Ìµ';
$strNone = 'Ìµ';
$strNoPassword = '¥Ñ¥¹¥ï¡¼¥ÉÌµ¤·';
$strNoPrivileges = 'ÆÃ¸¢Ìµ¤·';
$strNoQuery = 'SQL¥¯¥¨¥ê¡¼Ìµ¤·';
$strNoRights = '¸½ºßÆÃ¸¢¤ò»ý¤Ã¤Æ¤Ê¤¤¤Î¤Ç¤³¤³¤ËÆþ¤ì¤Þ¤»¤ó¡£';
$strNoTablesFound = '¸½ºß¤ÎDB¤Ë¥Æ¡¼¥Ö¥ë¤Ï¤¢¤ê¤Þ¤»¤ó¡£';
$strNotNumber = '¤³¤ì¤ÏÈÖ¹æ¤Ç¤Ï¤¢¤ê¤Þ¤»¤ó¡£';
$strNotValidNumber = ' ¤Ï¹Ô¤ÎÀµ¤·¤¤ÈÖ¹æ¤Ç¤Ï¤¢¤ê¤Þ¤»¤ó ';
$strNoUsersFound = '¥æ¡¼¥¶¡¼¤Ï¸«¤Ä¤«¤ê¤Þ¤»¤ó¤Ç¤·¤¿¡£';
$strNull = '¶õ¤ÎÃÍ(Null)';

$strOftenQuotation = '°úÍÑÉä¹æ¤Ç¤¹¡£¥ª¥×¥·¥ç¥ó¤Ï¡¢char¤Þ¤¿¤Ïvarchar¥Õ¥£¡¼¥ë¥É¤Î¤ß" "¤Ç°Ï¤Þ¤ì¤Æ¤¤¤ë¤³¤È¤ò°ÕÌ£¤·¤Þ¤¹¡£';
$strOptimizeTable = '¥Æ¡¼¥Ö¥ë¤òºÇÅ¬²½¤·¤Þ¤¹¡£';
$strOptionalControls = 'ÆÃ¼ìÊ¸»ú¤ÎÆÉ¤ß¹þ¤ß/½ñ¤­¹þ¤ß¥ª¥×¥·¥ç¥ó';
$strOptionally = '¥ª¥×¥·¥ç¥ó¤Ç¤¹¡£';
$strOr = 'Ëô¤Ï';
$strOverhead = '¥ª¡¼¥Ð¡¼¥Ø¥Ã¥É';

$strPartialText = 'ÉôÊ¬Åª¤ÊÊ¸½ñ';
$strPassword = '¥Ñ¥¹¥ï¡¼¥É';
$strPasswordEmpty = '¥Ñ¥¹¥ï¡¼¥É¤Ï¶õ¤Ç¤¹¡£';
$strPasswordNotSame = '¥Ñ¥¹¥ï¡¼¥É¤Ï¶õ¤Ç¤¹¡£';
$strPHPVersion = 'PHP ¥Ð¡¼¥¸¥ç¥ó';
$strPmaDocumentation = 'phpMyAdmin¤Î¥É¥­¥å¥á¥ó¥È';
$strPmaUriError = '<tt>$cfgPmaAbsoluteUri</tt> ¤òÉ¬¤ºconfig¥Õ¥¡¥¤¥ë¤ÎÃæ¤ÇÀßÄê¤·¤Æ²¼¤µ¤¤!';
$strPos1 = 'ºÇ½é';
$strPrevious = '°ÊÁ°';
$strPrimary = '¼çÍ×';
$strPrimaryKey = '¼çÍ×¥­¡¼';
$strPrimaryKeyHasBeenDropped = '¼çÍ×¥­¡¼¤òºï½ü¤·¤Þ¤·¤¿¡£';
$strPrimaryKeyName = '¼çÍ×¥­¡¼¤ÎÌ¾Á°¤Ï... PRIMARY¤Ç¤Ï¤Ê¤±¤ì¤Ð¤¤¤±¤Þ¤»¤ó¡£';
$strPrimaryKeyWarning = '("PRIMARY"¤Ï¤Á¤ç¤¦¤É¼çÍ×¥­¡¼¤ÎÌ¾Á°¤Ç¤Ï¤Ê¤±¤ì¤Ð¤¤¤±¤Þ¤»¤ó¡£';
$strPrintView = '°õºþÍÑÉ½¼¨';
$strPrivileges = 'ÆÃ¸¢';
$strProperties = '¥×¥í¥Ñ¥Æ¥£';

$strQBE = 'Îã¤«¤é¥¯¥¨¥ê¡¼¼Â¹Ô';
$strQBEDel = 'ºï½ü';
$strQBEIns = 'ÁÞÆþ';
$strQueryOnDb = '¥Ç¡¼¥¿¥Ù¡¼¥¹¤ÎSQL¥¯¥¨¥ê¡¼ <b>%s</b>:';

$strRecords = '¥ì¥³¡¼¥É¿ô';
$strReferentialIntegrity = '·ë¹ç¹àÌÜ¤Î¥Á¥§¥Ã¥¯:';
$strReloadFailed = 'MySQL¤Î¥ê¥í¡¼¥É¤Ë¼ºÇÔ¤·¤Þ¤·¤¿¡£';
$strReloadMySQL = 'MySQL¤Î¥ê¥í¡¼¥É';
$strRememberReload = '¥µ¡¼¥Ð¡¼¤Î¥ê¥í¡¼¥É¤òËº¤ì¤Ê¤¤¤Ç²¼¤µ¤¤¡£';
$strRenameTable = '¥Æ¡¼¥Ö¥ëÌ¾¤ÎÊÑ¹¹';
$strRenameTableOK = '%s¤ò%s¤ËÌ¾Á°¤òÊÑ¹¹¤·¤Þ¤·¤¿¡£';
$strRepairTable = '¥Æ¡¼¥Ö¥ë¤òÉüµì¤·¤Þ¤¹¡£';
$strReplace = 'ÃÖ¤­´¹¤¨¤ë';
$strReplaceTable = '¥Õ¥¡¥¤¥ë¤Ç¥Æ¡¼¥Ö¥ë¤òÃÖ¤­´¹¤¨¤ë';
$strReset = '¥ê¥»¥Ã¥È';
$strReType = 'ºÆµ­Æþ';
$strRevoke = 'ÇÑ»ß';
$strRevokeGrant = ' ÉÕÍ¿¤Î¼è¾Ã';
$strRevokeGrantMessage = '%s¤ÎÉÕÍ¿ÆÃ¸¢¤ò¼è¾Ã¤·¤Þ¤·¤¿¡£';
$strRevokeMessage = '%s¤ÎÆÃ¸¢¤ò¼è¾Ã¤·¤Þ¤·¤¿';
$strRevokePriv = 'ÆÃ¸¢¤Î¼è¾Ã';
$strRowLength = '¹Ô¤ÎÄ¹¤µ';
$strRows = '¹Ô';
$strRowsFrom = '³«»Ï¹Ô';
$strRowSize = ' ¹Ô¤Î¥µ¥¤¥º ';
$strRowsModeHorizontal = '¿åÊ¿';
$strRowsModeOptions = 'Êý¸þ: %s : %s Îó¤º¤Ä¥Ø¥Ã¥À¡¼¤ò·«¤êÊÖ¤·È¯É½¤¹¤ë';
$strRowsModeVertical = '½ÅÄ¾';
$strRowsStatistic = '¹Ô¤ÎÅý·×';
$strRunning = '¤¬¼Â¹ÔÃæ¤Ç¤¹¡£ %s';
$strRunQuery = '¥¯¥¨¥ê¡¼¤Î¼Â¹Ô';
$strRunSQLQuery = '¥Ç¡¼¥¿¥Ù¡¼¥¹%s¤ËSQL¥¯¥¨¥ê¡¼¼Â¹Ô';

$strSave = 'ÊÝÂ¸';
$strSelect = 'ÁªÂò';
$strSelectADb = '¥Ç¡¼¥¿¥Ù¡¼¥¹¤òÁªÂò¤·¤Æ¤¯¤À¤µ¤¤';
$strSelectAll = 'Á´ÁªÂò';
$strSelectFields = '¥Õ¥£¡¼¥ë¥É¤ÎÁªÂò(°ì¤Ä°Ê¾å):';
$strSelectNumRows = '¥¯¥¨¥ê¡¼';
$strSend = '¥Õ¥¡¥¤¥ë¤ËÍî¤È¤¹';
$strServerChoice = '¥µ¡¼¥Ð¡¼¤ÎÁªÂò';
$strServerVersion = '¥µ¡¼¥Ð¡¼¤Î¥Ð¡¼¥¸¥ç¥ó';
$strSetEnumVal = '¥Õ¥£¡¼¥ë¥É¥¿¥¤¥×¤¬"enum"Ëô¤Ï"set"¤Î¾ì¹ç¤ÏÃÍ¤ò¤³¤Î¥Õ¥©¡¼¥Þ¥Ã¥È¤ò»È¤Ã¤ÆÆþÎÏ¤·¤Æ²¼¤µ¤¤: \'a\',\'b\',\'c\'...<br />¥Ð¥Ã¥¯¥¹¥é¥Ã¥·¥å¡Ö"\"¡×Ëô¤Ï¥¯¥ª¡¼¥È¡Ö"\'"¡×¤òÆþÎÏ¤·¤¿¤¤¤È¡¢Æ¬¤Ë¥Ð¥Ã¥¯¥¹¥é¥Ã¥·¥å¤òÉÕ¤±¤Æ²¼¤µ¤¤¡ÖÎã: \'\\\\xyz\' or \'a\\\'b\'¡×¡£';
$strShow = 'É½¼¨';
$strShowAll = 'Á´¤ÎÈ¯É½';
$strShowCols = 'Îó¤ÎÈ¯É½';
$strShowingRecords = '¥ì¥³¡¼¥ÉÉ½¼¨';
$strShowPHPInfo = 'PHP¾ðÊó';
$strShowTables = '¥Æ¡¼¥Ö¥ë¤ÎÈ¯É½';
$strShowThisQuery = ' ¼Â¹Ô¤·¤¿¥¯¥¨¥ê¡¼¤ò¤³¤³¤ËÉ½¼¨¤¹¤ë ';
$strSingly = '(°ì²ó)';
$strSize = '¥µ¥¤¥º';
$strSort = '¥½¡¼¥È';
$strSpaceUsage = '¥Ç¥£¥¹¥¯»ÈÍÑÎÌ';
$strSQLQuery = '¼Â¹Ô¤µ¤ì¤¿SQL¥¯¥¨¥ê¡¼';
$strStartingRecord = 'ºÇ½é¤Î¥ì¥³¡¼¥É';
$strStatement = '¥¹¥Æ¡¼¥È¥á¥ó¥È';
$strStrucCSV = 'CSV¥Ç¡¼¥¿';
$strStrucData = '¹½Â¤¤È¥Ç¡¼¥¿';
$strStrucDrop = '\'drop table\'¤òÄÉ²Ã';
$strStrucExcelCSV = 'Ms Excel¤Ø¤ÎCSV¥Ç¡¼¥¿';
$strStrucOnly = '¹½Â¤¤Î¤ß';
$strSubmit = '¼Â¹Ô';
$strSuccess = 'SQL¥¯¥¨¥ê¡¼¤¬Àµ¾ï¤Ë¼Â¹Ô¤µ¤ì¤Þ¤·¤¿¡£';
$strSum = '¹ç·×';

$strTable = '¥Æ¡¼¥Ö¥ë ';
$strTableComments = '¥Æ¡¼¥Ö¥ë¤ÎÀâÌÀ';
$strTableEmpty = '¥Æ¡¼¥Ö¥ëÌ¾¤Ï¶õ¤Ç¤¹¡£';
$strTableHasBeenDropped = '¥Æ¡¼¥Ö¥ë%s¤òºï½ü¤·¤Þ¤·¤¿¡£';
$strTableHasBeenEmptied = '¥Æ¡¼¥Ö¥ë%s¤ò¶õ¤Ë¤·¤Þ¤·¤¿¡£';
$strTableHasBeenFlushed = '¥Æ¡¼¥Ö¥ë%s¤Î¥­¥ã¥Ã¥·¥å¤ò¶õ¤Ë¤·¤Þ¤·¤¿¡£';
$strTableMaintenance = '¥Æ¡¼¥Ö¥ë´ÉÍý';
$strTables = '%s¥Æ¡¼¥Ö¥ë';
$strTableStructure = '¥Æ¡¼¥Ö¥ë¤Î¹½Â¤';
$strTableType = '¥Æ¡¼¥Ö¥ë¤Î¥¿¥¤¥×';
$strTextAreaLength = ' Ä¹¤µ¤Î½ê°Ù¤Ç¤³¤Î¥Õ¥£¡¼¥ë¥É¤ò<br /> ½¤Àµ½ÐÍè¤Ê¤¤²ÄÇ½À­¤¬¤¢¤ê¤Þ¤¹ ';
$strTheContent = '¥Õ¥¡¥¤¥ë¤Î¥Ç¡¼¥¿¤òÁÞÆþ¤·¤Þ¤·¤¿¡£';
$strTheContents = '¥Õ¥¡¥¤¥ë¤Î¥Ç¡¼¥¿¤Ç¡¢ÁªÂò¤·¤¿¥Æ¡¼¥Ö¥ë¤Î¼çÍ×¥­¡¼¤Þ¤¿¤ÏÍ£°ì¤Ê¥­¡¼¤Ë°ìÃ×¤¹¤ëÎó¤òÃÖ¤­´¹¤¨¤Þ¤¹¡£';
$strTheTerminator = '¥Õ¥£¡¼¥ë¥É¤Î½ªÃ¼µ­¹æ¤Ç¤¹¡£';
$strTotal = '¹ç·×';
$strType = '¥Õ¥£¡¼¥ë¥É¥¿¥¤¥×';

$strUncheckAll = 'Á´¤Æ¤Î¥Þ¡¼¥¯¤òºï½ü';
$strUnique = 'Í£°ì';
$strUnselectAll = 'Á´²òÊü';
$strUpdatePrivMessage = '%s¤ÎÆÃ¸¢¤ò¥¢¥Ã¥×¥Ç¡¼¥È¤·¤Þ¤·¤¿¡£';
$strUpdateProfile = '¥×¥í¥Õ¥¡¥¤¥ë¤Î¥¢¥Ã¥×¥Ç¡¼¥È:';
$strUpdateProfileMessage = '¥×¥í¥Õ¥¡¥¤¥ë¤ò¥¢¥Ã¥×¥Ç¡¼¥È¤·¤Þ¤·¤¿¡£';
$strUpdateQuery = '¥¯¥¨¥ê¡¼¤Î¥¢¥Ã¥×¥Ç¡¼¥È';
$strUsage = '»ÈÍÑÎÌ';
$strUseBackquotes = 'µÕ¥¯¥ª¡¼¥È¤Ç¥Æ¡¼¥Ö¥ëÌ¾¤ä¥Õ¥£¡¼¥ë¥ÉÌ¾¤ò°Ï¤à';
$strUser = '¥æ¡¼¥¶¡¼';
$strUserEmpty = '¥æ¡¼¥¶¡¼Ì¾¤Ï¶õ¤Ç¤¹¡£';
$strUserName = '¥æ¡¼¥¶¡¼Ì¾';
$strUsers = '¥æ¡¼¥¶¡¼';
$strUseTables = '»È¤¦¥Æ¡¼¥Ö¥ë';

$strValue = 'ÃÍ';
$strViewDump = '¥Æ¡¼¥Ö¥ë¤Î¥À¥ó¥×(¥¹¥­¡¼¥Þ)É½¼¨';
$strViewDumpDB = 'DB¤Î¥À¥ó¥×(¥¹¥­¡¼¥Þ)É½¼¨';

$strWelcome = '%s¤Ø¤è¤¦¤³¤½';
$strWithChecked = '¥Á¥§¥Ã¥¯¤·¤¿¤â¤Î¤ò:';
$strWrongUser = '¥æ¡¼¥¶Ì¾¤Þ¤¿¤Ï¥Ñ¥¹¥ï¡¼¥É¤¬Àµ¤·¤¯¤¢¤ê¤Þ¤»¤ó¡£<br />¥¢¥¯¥»¥¹¤ÏµñÈÝ¤µ¤ì¤Þ¤·¤¿¡£';

$strYes = '¤Ï¤¤';

$strZip = '"zip¤µ¤ì¤ë"';

// japanese only
$strEncto = '¥¨¥ó¥³¡¼¥Ç¥£¥ó¥°¤ØÊÑ´¹¤¹¤ë'; // encoding convert
$strKanjiEncodConvert = '´Á»ú¥³¡¼¥ÉÊÑ´¹'; // kanji code convert
$strXkana = 'Á´³Ñ¥«¥Ê¤ØÊÑ´¹¤¹¤ë'; // convert to X208-kana

// To translate
?>
