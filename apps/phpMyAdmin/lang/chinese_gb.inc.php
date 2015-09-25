<?php
/* $Id: chinese_gb.inc.php,v 1.108.2.2 2002/06/18 21:33:05 rabus Exp $ */

/**
 * Last translation by: siusun <siusun@best-view.net>
 */

$charset = 'gb2312';
$text_dir = 'ltr';
$left_font_family = 'sans-serif';
$right_font_family = 'sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('Bytes', 'KB', 'MB', 'GB');

$day_of_week = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
$month = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%B %d, %Y at %I:%M %p';

$strAPrimaryKey = 'Ö÷¼üÒÑ¾­Ìí¼Óµ½ %s';
$strAccessDenied = '·ÃÎÊ±»¾Ü¾ø';
$strAction = 'Ö´ÐÐ²Ù×÷';
$strAddDeleteColumn = 'Ìí¼Ó/É¾³ý Ñ¡ÔñÀ¸';
$strAddDeleteRow = 'Ìí¼Ó/É¾³ý É¸Ñ¡ÁÐ';
$strAddNewField = 'Ìí¼ÓÐÂ×Ö¶Î';
$strAddPriv = 'Ìí¼ÓÐÂÈ¨ÏÞ';
$strAddPrivMessage = 'ÄúÒÑ¾­ÎªÏÂ´ËÊ¹ÓÃÕßÌí¼ÓÁËÐÂÈ¨ÏÞ.';
$strAddSearchConditions = 'Ìí¼Ó¼ìË÷Ìõ¼þ ("where" Óï¾äµÄÖ÷Ìå)£º';
$strAddToIndex = 'Ìí¼Ó &nbsp;%s&nbsp; ×éË÷ÒýÀ¸';
$strAddUser = 'ÌíÔöÊ¹ÓÃÕß';
$strAddUserMessage = 'ÄúÒÑÌíÔöÁËÒ»¸öÐÂÊ¹ÓÃÕß.';
$strAffectedRows = 'Ó°ÏìÁÐÊý:';
$strAfter = 'ÔÚ %s Ö®ºó';
$strAfterInsertBack = '·µ»Ø';
$strAfterInsertNewInsert = 'Ìí¼ÓÒ»±Ê¼ÇÂ¼';
$strAll = 'È«²¿';
$strAlterOrderBy = '¸ù¾ÝÀ¸Î»ÄÚÈÝÅÅÐò¼ÇÂ¼';
$strAnIndex = 'Ë÷ÒýÒÑ¾­Ìí¼Óµ½ %s';
$strAnalyzeTable = '·ÖÎöÊý¾Ý±í';
$strAnd = 'Óë';
$strAny = 'ÈÎºÎ';
$strAnyColumn = 'ÈÎºÎÀ¸Î»';
$strAnyDatabase = 'ÈÎºÎÊý¾Ý¿â';
$strAnyHost = 'ÈÎºÎÖ÷»ú';
$strAnyTable = 'ÈÎºÎÊý¾Ý±í';
$strAnyUser = 'ÈÎºÎÊ¹ÓÃÕß';
$strAscending = 'µÝÔö';
$strAtBeginningOfTable = 'ÓÚÊý¾Ý±í¿ªÍ·';
$strAtEndOfTable = 'ÓÚÊý¾Ý±íÎ²¶Ë';
$strAttr = 'ÊôÐÔ';

$strBack = '·µ»Ø';
$strBinary = ' ¶þ½øÖÆÂë ';
$strBinaryDoNotEdit = ' ¶þ½øÖÆÂë - ÎÞ·¨±à¼­ ';
$strBookmarkDeleted = '±êÇ©ÒÑ¾­É¾³ý.';
$strBookmarkLabel = '±êÇ©Ãû³Æ';
$strBookmarkQuery = 'SQL Óï·¨ÊéÇ©';
$strBookmarkThis = '¼ÓÈë´Ë SQL Óï·¨µ½ÊéÇ©';
$strBookmarkView = '²é¿´';
$strBrowse = 'ä¯ÀÀ';
$strBzip = '"bzipped"';

$strCantLoadMySQL = '²»ÄÜÔØÈë MySQL ¸½¼þ,<br />Çë¼ì²é PHP µÄ×éÌ¬Éè¶¨';
$strCantRenameIdxToPrimary = 'ÎÞ·¨½«Ë÷Òý¸üÃûÎª PRIMARY!';
$strCardinality = '×é±ð';
$strCarriage = '»Ø³µ: \\r';
$strChange = '¸Ä±ä';
$strChangePassword = '¸ü¸ÄÃÜÂë';
$strCheckAll = 'È«Ñ¡';
$strCheckDbPriv = '¼ì²éÊý¾Ý¿âÈ¨ÏÞ';
$strCheckTable = '¼ì²éÊý¾Ý±í';
$strColumn = 'À¸Î»';
$strColumnNames = '×Ö¶ÎÃû';
$strCompleteInserts = 'Ê¹ÓÃÍêÕûÌíÔöÖ¸Áî';
$strConfirm = 'ÄúÈ·¶¨ÒªÕâÑù×ö?';
$strCookiesRequired = 'Cookies ±ØÐëÆô¶¯²ÅÄÜµÇÈë.';
$strCopyTable = '¸´ÖÆÊý¾Ý±íµ½£º (¸ñÊ½Îª Êý¾Ý¿âÃû³Æ<b>.</b>Êý¾Ý±íÃû³Æ):';
$strCopyTableOK = 'Êý¾Ý±í %s ÒÑ¾­³É¹¦¸´ÖÆÎª %s¡£';
$strCreate = '½¨Á¢';
$strCreateIndex = 'ÐÂÔö &nbsp;%s&nbsp; ×éË÷ÒýÀ¸';
$strCreateIndexTopic = 'Ìí¼ÓÒ»×éË÷Òý';
$strCreateNewDatabase = '½¨Á¢Ò»¸öÐÂµÄÊý¾Ý¿â';
$strCreateNewTable = '½¨Á¢Ò»¸öÐÂµÄÊý¾Ý±íÓëÊý¾Ý¿â %s';
$strCriteria = '¹æ·¶';

$strData = 'Êý¾Ý';
$strDataOnly = 'Ö»ÓÐÊý¾Ý';
$strDatabase = 'Êý¾Ý¿â ';
$strDatabaseHasBeenDropped = 'Êý¾Ý¿â %s ÒÑ±»É¾³ý';
$strDatabaseWildcard = 'Êý¾Ý¿â (ÔÊÐíÊ¹ÓÃÍòÓÃ×Ö·û):';
$strDatabases = 'Êý¾Ý¿â';
$strDatabasesStats = 'Êý¾Ý¿âÍ³¼Æ';
$strDefault = 'È±Ê¡Öµ';
$strDelete = 'É¾³ý';
$strDeleteFailed = 'É¾³ýÊ§°Ü!';
$strDeleteUserMessage = 'ÄúÒÑ¾­½«ÓÃ»§ %s É¾³ý.';
$strDeleted = '¸Ã¼ÇÂ¼ÒÑ¾­±»É¾³ý¡£';
$strDeletedRows = 'ÒÑÉ¾³ýÀ¸Êý:';
$strDescending = 'µÝ¼õ';
$strDisplay = 'ÏÔÊ¾';
$strDisplayOrder = 'ÏÔÊ¾´ÎÐò';
$strDoAQuery = 'ÇëÖ´ÐÐ "²éÑ¯Ê¾Àý" (Í¨Åä·û: "%")';
$strDoYouReally = 'ÇëÈ·ÈÏÒª ';
$strDocu = 'ÎÄµµ';
$strDrop = '¶ªÆú';
$strDropDB = '¶ªÆúÊý¾Ý¿â %s';
$strDropTable = 'É¾³ýÊý¾Ý±í';
$strDumpingData = 'µ¼³öÏÂÃæµÄÊý¾Ý¿âÄÚÈÝ';
$strDynamic = '¶¯Ì¬';

$strEdit = '±à¼­';
$strEditPrivileges = '±à¼­È¨ÏÞ';
$strEffective = 'ÓÐÐ§';
$strEmpty = 'Çå¿Õ';
$strEmptyResultSet = 'MySQL ·µ»ØµÄ²éÑ¯½á¹ûÎª¿Õ¡£ (Ô­Òò¿ÉÄÜÎª£ºÃ»ÓÐÕÒµ½·ûºÏÌõ¼þµÄ¼ÇÂ¼¡£)';
$strEnd = '½áÊø';
$strEnglishPrivileges = ' ×¢Òâ: MySQL È¨ÏÞÃû³Æ»á±»½âÊÍ³ÉÓ¢ÎÄ ';
$strError = '´íÎó';
$strExtendedInserts = 'ÉìÑÓÌí¼ÓÄ£Ê½';
$strExtra = '¶îÍâ';

$strField = '×Ö¶Î';
$strFieldHasBeenDropped = 'Êý¾Ý±í %s ÒÑ±»É¾³ý';
$strFields = '×Ö¶Î';
$strFieldsEmpty = ' À¸Î»×ÜÊýÊÇ¿ÕµÄ! ';
$strFieldsEnclosedBy = '¡¸À¸Î»¡¹Ê¹ÓÃ×ÖÔª£º';
$strFieldsEscapedBy = '¡¸ESCAPE¡¹Ê¹ÓÃ×ÖÔª£º';
$strFieldsTerminatedBy = '¡¸À¸Î»·Ö¸ô¡¹Ê¹ÓÃ×ÖÔª£º';
$strFixed = '¹Ì¶¨';
$strFlushTable = 'Ç¿ÆÈ¹Ø±Õ×ÊÁÏ±í ("FLUSH")';
$strFormEmpty = '±í¸ñÄÚÈ±ÉÙÁËÒ»Ð©×ÊÁÏ!';
$strFormat = '¸ñÊ½';
$strFullText = 'ÏÔÊ¾ÍêÕûÎÄ×Ö';
$strFunction = '¹¦ÄÜ';

$strGenTime = '½¨Á¢ÈÕÆÚ';
$strGo = '¿ªÊ¼';
$strGrants = 'Grants'; // should expressed in English
$strGzip = '"gzipped"';

$strHasBeenAltered = 'ÒÑ¾­±»ÐÞ¸Ä¡£';
$strHasBeenCreated = 'ÒÑ¾­½¨Á¢¡£';
$strHome = 'Ö÷Ä¿Â¼';
$strHomepageOfficial = 'phpMyAdmin ¹Ù·½ÍøÕ¾';
$strHomepageSourceforge = 'phpMyAdmin ÏÂÔØÍøÒ³';
$strHost = 'Ö÷»ú';
$strHostEmpty = 'Ö÷»úÃû³ÆÊÇ¿ÕµÄ!';

$strIdxFulltext = 'È«ÎÄ¼ìË÷';
$strIfYouWish = 'Èç¹ûÄãÒªÖ¸¶¨µ÷ÈëµÄ×Ö¶Î£¬ÄÇÃ´Çë¸ø³öÓÃ¶ººÅ¸ô¿ªµÄ×Ö¶ÎÁÐ±í¡£';
$strIgnore = 'ºöÂÔ';
$strInUse = 'Ê¹ÓÃÖÐ';
$strIndex = 'Ë÷Òý';
$strIndexHasBeenDropped = 'Ë÷Òý %s ÒÑ±»É¾³ý';
$strIndexName = 'Ë÷ÒýÃû³Æ&nbsp;:';
$strIndexType = 'Ë÷ÒýÀàÐÍ&nbsp;:';
$strIndexes = 'Ë÷Òý';
$strInsert = '²åÈë';
$strInsertAsNewRow = 'Ìí¼ÓÒ»±Ê¼ÇÂ¼';
$strInsertNewRow = '²åÈëÐÂ¼ÇÂ¼';
$strInsertTextfiles = '´ÓÎÄ±¾ÎÄ¼þÖÐÌáÈ¡Êý¾Ý£¬²åÈëµ½Êý¾Ý±í£º';
$strInsertedRows = 'ÐÂÔöÁÐÊý:';
$strInstructions = 'Ö¸Ê¾';
$strInvalidName = '"%s" ÊÇÒ»¸ö±£Áô×Ö,Äú²»ÄÜ½«±£Áô×ÖÊ¹ÓÃÎª ×ÊÁÏ¿â/×ÊÁÏ±í/À¸Î» Ãû³Æ.';

$strKeepPass = 'Çë²»Òª¸ü¸ÄÃÜÂë';
$strKeyname = '¼üÃû';
$strKill = 'Kill'; //should expressed in English

$strLength = '³¤¶È';
$strLengthSet = '³¤¶È/¼¯ºÏ*';
$strLimitNumRows = '±Ê¼ÇÂ¼/Ã¿Ò³';
$strLineFeed = '»»ÐÐ£º\\n';
$strLines = 'ÐÐÊý ';
$strLinesTerminatedBy = '¡¸ÏÂÒ»ÐÐ¡¹Ê¹ÓÃ×Ö·û£º';
$strLocationTextfile = 'ÎÄ±¾ÎÄ¼þµÄÎ»ÖÃ';
$strLogPassword = 'ÃÜÂë:';
$strLogUsername = 'µÇÈëÃû³Æ:';
$strLogin = 'µÇÈë';
$strLogout = 'ÍË³öÏµÍ³';

$strModifications = 'ÐÞ¸ÄºóµÄÊý¾ÝÒÑ¾­´æÅÌ¡£';
$strModify = 'ÐÞ¸Ä';
$strModifyIndexTopic = 'ÐÞ¸ÄË÷Òý';
$strMoveTable = 'ÒÆ¶¯Êý¾Ý±íµ½£º(¸ñÊ½Îª Êý¾Ý¿âÃû³Æ<b>.</b>Êý¾Ý±íÃû³Æ)';
$strMoveTableOK = 'Êý¾Ý±í %s ÒÑ¾­ÒÆ¶¯µ½ %s.';
$strMySQLReloaded = 'MySQL ÖØÐÂÆô¶¯Íê³É¡£';
$strMySQLSaid = 'MySQL ·µ»Ø£º';
$strMySQLServerProcess = 'MySQL °æ±¾ %pma_s1% ÔÚ %pma_s2% Ö´ÐÐ£¬µÇÈëÕßÎª %pma_s3%';
$strMySQLShowProcess = 'ÏÔÊ¾½ø³Ì';
$strMySQLShowStatus = 'ÏÔÊ¾ MySQL µÄÔËÐÐÐÅÏ¢';
$strMySQLShowVars = 'ÏÔÊ¾ MySQL µÄÏµÍ³±äÁ¿';

$strName = 'Ãû×Ö';
$strNbRecords = '±Ê¿ªÊ¼£¬ÁÐ³ö¼ÇÂ¼±ÊÊý';
$strNext = 'ÏÂÒ»¸ö';
$strNo = '·ñ';
$strNoDatabases = 'Ã»ÓÐÊý¾Ý¿â';
$strNoDropDatabases = '"DROP DATABASE" Ö¸ÁîÒÑ¾­Í£ÓÃ.';
$strNoFrames = 'phpMyAdmin ½ÏÎªÊÊºÏÊ¹ÓÃÔÚÖ§³Ö<b>Ò³¿ò</b>µÄä¯ÀÀÆ÷.';
$strNoIndex = 'Ã»ÓÐÒÑ¶¨ÒåµÄË÷Òý!';
$strNoIndexPartsDefined = '²¿·ÝË÷Òý×ÊÁÏ»¹Î´¶¨Òå!';
$strNoModification = 'Ã»ÓÐ±ä¸ü';
$strNoPassword = '²»ÓÃÃÜÂë';
$strNoPrivileges = 'Ã»ÓÐÈ¨ÏÞ';
$strNoQuery = 'Ã»ÓÐ SQL Óï¾ä!';
$strNoRights = 'ÄúÏÖÔÚÃ»ÓÐ×ã¹»µÄÈ¨ÏÞ!';
$strNoTablesFound = 'Êý¾Ý¿âÖÐÃ»ÓÐÊý¾Ý±í¡£';
$strNoUsersFound = 'ÕÒ²»µ½Ê¹ÓÃÕß';
$strNone = '²»ÊÊÓÃ';
$strNotNumber = 'Õâ²»ÊÇÒ»¸öÊý×Ö!';
$strNotValidNumber = ' ²»ÊÇÓÐÐ§µÄÁÐÊý!';
$strNull = 'Null';

$strOftenQuotation = 'Í¨³£ÎªÒýºÅ¡£ £¢Ñ¡ÖÐ¡° ±íÊ¾Ê¹ÓÃÒýºÅ¡£ÒòÎªÖ»ÓÐ char ºÍ varchar ÀàÐÍµÄÊý¾ÝÐèÒªÓÃÒýºÅÀ¨ÆðÀ´¡£';
$strOptimizeTable = '×î¼Ñ»¯Êý¾Ý±í';
$strOptionalControls = '¿ÉÑ¡¡£ÓÃÓÚ¶ÁÈ¡»òÐ´ÈëÌØÊâµÄ×Ö·û¡£';
$strOptionally = 'ËæÒâ';
$strOr = '»ò';
$strOverhead = '¶àÓà';

$strPHPVersion = 'PHP °æ±¾';
$strPartialText = 'ÏÔÊ¾²¿·ÝÎÄ×Ö';
$strPassword = 'ÃÜÂë';
$strPasswordEmpty = 'ÃÜÂëÊÇ¿ÕµÄ!';
$strPasswordNotSame = 'ÃÜÂë²¢·ÇÏàÍ¬!';
$strPmaDocumentation = 'phpMyAdmin ËµÃ÷ÎÄ±¾';
$strPmaUriError = '±ØÐëÉè¶¨ <tt>$cfgPmaAbsoluteUri</tt> ÔÚÉè¶¨µµ°¸ÄÚ!';
$strPos1 = '¿ªÊ¼';
$strPrevious = 'Ç°Ò»¸ö';
$strPrimary = '¼üÃû';
$strPrimaryKey = 'Ö÷¼ü';
$strPrimaryKeyHasBeenDropped = 'Ö÷¼üÒÑ±»É¾³ý';
$strPrimaryKeyName = 'Ö÷¼üµÄÃû³Æ±ØÐë³ÆÎª PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>±ØÐë</b>ÊÇÖ÷¼üµÄÃû³ÆÒÔ¼°ÊÇ<b>Î¨Ò»</b>Ò»×éÖ÷¼ü!)';
$strPrintView = '´òÓ¡¼ìÊÓ';
$strPrivileges = 'È¨ÏÞ';
$strProperties = 'ÊôÐÔ';

$strQBE = '²éÑ¯Ä£°å';
$strQBEDel = 'É¾³ý';
$strQBEIns = 'Ìí¼Ó';
$strQueryOnDb = 'ÔÚ×ÊÁÏ¿â <b>%s</b> Ö´ÐÐ SQL Óï¾ä:';

$strReType = 'ÖØÐÂÊäÈë';
$strRecords = '¼ÇÂ¼';
$strReferentialIntegrity = '¼ì²éÖ¸Ê¾ÍêÕûÐÔ:';
$strReloadFailed = 'MySQL ÖØÆðÊ§°Ü¡£';
$strReloadMySQL = 'ÖØÆð MySQL';
$strRememberReload = 'ÇëÖØÐÂÆô¶¯.';
$strRenameTable = '½«Êý¾Ý±í¸ÄÃûÎª';
$strRenameTableOK = 'Êý¾Ý±í %s Ãû×ÖÒÑ¾­±»¸Ã³É %s¡£';
$strRepairTable = 'ÐÞ¸´Êý¾Ý±í';
$strReplace = 'Ìæ»»';
$strReplaceTable = '½«Êý¾Ý±íµÄÊý¾ÝÓÃÒÔÏÂÎÄ±¾ÎÄ¼þÌæ»»£º';
$strReset = 'ÖØÖÃ';
$strRevoke = '³·»Ø';
$strRevokeGrant = '³·»Ø Grant È¨ÏÞ';
$strRevokeGrantMessage = 'ÄúÒÑ³·»ØÒÔÏÂÕâÎ»Ê¹ÓÃÕßµÄ Grant È¨ÏÞ: %s';
$strRevokeMessage = 'ÄúÒÑ³·»ØÏÂÃæÕâÎ»Ê¹ÓÃÕßµÄÈ¨ÏÞ: %s';
$strRevokePriv = '³·»ØÈ¨ÏÞ';
$strRowLength = 'Êý¾ÝÁÐ³¤¶È';
$strRowSize = ' Êý¾ÝÁÐ´óÐ¡ ';
$strRows = 'Êý¾ÝÁÐÁÐÊý';
$strRowsFrom = '±Ê¼ÇÂ¼£¬¿ªÊ¼ÁÐÊý:';
$strRowsModeHorizontal = 'Ë®Æ½';
$strRowsModeOptions = 'ÏÔÊ¾Îª %s ·½Ê½ ¼° Ã¿¸ô %s ÐÐÏÔÊ¾À¸Ãû';
$strRowsModeVertical = '´¹Ö±';
$strRowsStatistic = 'Êý¾ÝÁÐÍ³¼ÆÊýÖµ';
$strRunQuery = 'Ö´ÐÐ²éÑ¯';
$strRunSQLQuery = 'ÔÚÊý¾Ý¿â %s Ö´ÐÐÒÔÏÂÖ¸Áî';
$strRunning = 'ÔËÐÐÓÚ %s';

$strSQLQuery = 'SQL Óï¾ä';
$strSave = '´æ´¢';
$strSelect = 'Ñ¡Ôñ';
$strSelectADb = 'ÇëÑ¡ÔñÊý¾Ý¿â';
$strSelectAll = 'È«Ñ¡';
$strSelectFields = 'ÖÁÉÙÑ¡ÔñÒ»¸ö×Ö¶Î£º';
$strSelectNumRows = '²éÑ¯ÖÐ';
$strSend = '·¢ËÍ';
$strServerChoice = 'Ñ¡ÔñËÅ·þ»ú';
$strServerVersion = 'ËÅ·þ»ú°æ±¾';
$strSetEnumVal = 'ÈçÀ¸Î»¸ñÊ½ÊÇ "enum" »ò "set", ÇëÊ¹ÓÃÒÔÏÂµÄ¸ñÊ½ÊäÈë: \'a\',\'b\',\'c\'...<br />ÈçÔÚÊýÖµÉÏÐèÒªÊäÈë·´Ð±Ïß (\) »òµ¥ÒýºÅ (\') , ÇëÔÙ¼ÓÉÏ·´Ð±Ïß (ÀýÈç \'\\\\xyz\' or \'a\\\'b\').';
$strShow = 'ÏÔÊ¾';
$strShowAll = 'ÏÔÊ¾È«²¿';
$strShowCols = 'ÏÔÊ¾À¸';
$strShowPHPInfo = 'ÏÔÊ¾ PHP ×ÊÑ¶';
$strShowTables = 'ÏÔÊ¾Êý¾Ý±í';
$strShowThisQuery = ' ÖØÐÂÏÔÊ¾ SQL Óï¾ä ';
$strShowingRecords = 'ÏÔÊ¾¼ÇÂ¼ ';
$strSingly = '(Ö»ÅÅÐòÏÖÊ±Ö®¼ÇÂ¼)';
$strSize = '´óÐ¡';
$strSort = 'ÅÅÐò';
$strSpaceUsage = 'ÒÑÊ¹ÓÃ¿Õ¼ä';
$strStartingRecord = 'ÓÉ¼ÇÂ¼';
$strStatement = 'ÐðÊö';
$strStrucCSV = 'CSV Êý¾Ý';
$strStrucData = '½á¹¹ºÍÊý¾Ý';
$strStrucDrop = 'Ìí¼Ó \'drop table\'';
$strStrucExcelCSV = 'Ms Excel µÄ CSV ¸ñÊ½';
$strStrucOnly = 'Ö»Ñ¡Ôñ½á¹¹';
$strSubmit = '·¢ËÍ';
$strSuccess = 'ÄãÔËÐÐµÄ SQL Óï¾äÒÑ¾­³É¹¦ÔËÐÐÁË¡£';
$strSum = '×Ü¼Æ';

$strTable = 'Êý¾Ý±í ';
$strTableComments = 'Êý¾Ý±í×¢½âÎÄ×Ö';
$strTableEmpty = 'Êý¾Ý±íÃû³ÆÊÇ¿ÕµÄ!';
$strTableHasBeenDropped = 'Êý¾Ý±í %s ÒÑ±»É¾³ý';
$strTableHasBeenEmptied = 'Êý¾Ý±í %s ÒÑ±»Çå¿Õ';
$strTableHasBeenFlushed = 'Êý¾Ý±í %s ÒÑ±»Ç¿ÆÈ¹Ø±Õ';
$strTableMaintenance = 'Êý¾Ý±íÎ¬»¤';
$strTableStructure = 'Êý¾Ý±íµÄ½á¹¹';
$strTableType = 'Êý¾Ý±íÀàÐÍ';
$strTables = '%s Êý¾Ý±í';
$strTextAreaLength = ' ÓÉÓÚ³¤¶ÈÏÞÖÆ<br /> ´ËÀ¸Î»²»ÄÜ±à¼­ ';
$strTheContent = 'ÎÄ¼þÖÐµÄÄÚÈÝÒÑ¾­²åÈëµ½Êý¾Ý±íÖÐ¡£';
$strTheContents = 'ÎÄ¼þÖÐµÄÄÚÈÝ½«»áÈ¡´ú ËùÑ¡¶¨µÄÊý¾Ý±íÖÐ¾ßÓÐ ÏàÍ¬µÄÖ÷¼ü»òÎ¨Ò»¼üµÄ ¼ÇÂ¼¡£';
$strTheTerminator = 'ÕâÐ©×Ö¶ÎµÄ½áÊø·û';
$strTotal = '×Ü¼Æ';
$strType = 'ÀàÐÍ';

$strUncheckAll = 'È«²¿È¡Ïû';
$strUnique = 'Î¨Ò»';
$strUnselectAll = 'È«²¿È¡Ïû';
$strUpdatePrivMessage = 'ÄúÒÑ¾­¸üÐÂÁË %s µÄÈ¨ÏÞ.';
$strUpdateProfile = '¸üÐÂ×ÊÁÏ:';
$strUpdateProfileMessage = '×ÊÁÏ¼º¾­¸üÐÂ.';
$strUpdateQuery = '¸üÐÂÓï¾ä';
$strUsage = 'Ê¹ÓÃ';
$strUseBackquotes = 'ÇëÔÚÊý¾Ý±í¼°À¸Î»Ê¹ÓÃÒýºÅ';
$strUseTables = 'Ê¹ÓÃÊý¾Ý±í';
$strUser = 'Ê¹ÓÃÕß';
$strUserEmpty = 'Ê¹ÓÃÕßÃû³ÆÊÇ¿ÕµÄ!';
$strUserName = 'Ê¹ÓÃÕßÃû³Æ';
$strUsers = 'Ê¹ÓÃÕß';

$strValue = 'Öµ';
$strViewDump = '²é¿´Êý¾Ý±íµÄ½á¹¹ºÍÕªÒªÐÅÏ¢¡£';
$strViewDumpDB = '²é¿´Êý¾Ý¿âµÄ½á¹¹ºÍÕªÒªÐÅÏ¢¡£';

$strWelcome = '»¶Ó­Ê¹ÓÃ %s';
$strWithChecked = 'Ñ¡ÔñµÄÊý¾Ý±í£º';
$strWrongUser = 'ÃÜÂë´íÎó£¬·ÃÎÊ±»¾Ü¾ø¡£';

$strYes = 'ÊÇ';

$strZip = '"zipped"';
?>
