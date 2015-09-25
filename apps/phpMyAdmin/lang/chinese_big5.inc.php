<?php
/* $Id: chinese_big5.inc.php,v 1.113.2.1 2002/06/18 21:33:05 rabus Exp $ */

/**
 * Last translation by: siusun <siusun@best-view.net>
 * Follow by the original translation of Taiyen Hung ¬x®õ¤¸<yen789@pchome.com.tw>
 */

$charset = 'big5';
$text_dir = 'ltr';
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'helvetica, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('Bytes', 'KB', 'MB', 'GB');

$day_of_week = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
$month = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%B %d, %Y at %I:%M %p';


$strAccessDenied = '©Úµ´¦s¨ú';
$strAction = '°õ¦æ';
$strAddDeleteColumn = '·s¼W/´î¤Ö ¿ï¾ÜÄæ';
$strAddDeleteRow = '·s¼W/´î¤Ö ¿z¿ï¦C';
$strAddNewField = '¼W¥[·sÄæ¦ì';
$strAddPriv = '¼W¥[·sÅv­­';
$strAddPrivMessage = '±z¤w¸g¬°¤U­±³o¦ì¨Ï¥ÎªÌ¼W¥[¤F·sÅv­­.';
$strAddSearchConditions = '¼W¥[ÀË¯Á±ø¥ó ("where" ¤l¥yªº¥DÅé)';
$strAddToIndex = '·s¼W &nbsp;%s&nbsp; ²Õ¯Á¤ÞÄæ';
$strAddUser = '·s¼W¨Ï¥ÎªÌ';
$strAddUserMessage = '±z¤w·s¼W¤F¤@­Ó·s¨Ï¥ÎªÌ.';
$strAffectedRows = '¼vÅT¦C¼Æ: ';
$strAfter = '¦b %s ¤§«á';
$strAfterInsertBack = 'ªð¦^';
$strAfterInsertNewInsert = '·s¼W¤@µ§°O¿ý';
$strAll = '¥þ³¡';
$strAlterOrderBy = '®Ú¾ÚÄæ¦ì¤º®e±Æ§Ç°O¿ý';
$strAnalyzeTable = '¤ÀªR¸ê®Æªí';
$strAnd = '»P';
$strAnIndex = '¯Á¤Þ¤w¸g·s¼W¨ì %s';
$strAny = '¥ô¦ó';
$strAnyColumn = '¥ô¦óÄæ¦ì';
$strAnyDatabase = '¥ô¦ó¸ê®Æ®w';
$strAnyHost = '¥ô¦ó¥D¾÷';
$strAnyTable = '¥ô¦ó¸ê®Æªí';
$strAnyUser = '¥ô¦ó¨Ï¥ÎªÌ';
$strAPrimaryKey = '¥DÁä¤w¸g·s¼W¨ì %s';
$strAscending = '»¼¼W';
$strAtBeginningOfTable = '©ó¸ê®Æªí¶}ÀY';
$strAtEndOfTable = '©ó¸ê®Æªí§ÀºÝ';
$strAttr = 'ÄÝ©Ê';

$strBack = '¦^¤W¤@­¶';
$strBinary = '¤G¶i¨î½X';
$strBinaryDoNotEdit = '¤G¶i¨î½X - ¤£¯à½s¿è';
$strBookmarkDeleted = '®ÑÅÒ¤w¸g§R°£.';
$strBookmarkLabel = '®ÑÅÒ¦WºÙ';
$strBookmarkQuery = 'SQL »yªk®ÑÅÒ';
$strBookmarkThis = '±N¦¹ SQL »yªk¥[¤J®ÑÅÒ';
$strBookmarkView = '¬d¬Ý';
$strBrowse = 'ÂsÄý';
$strBzip = '"bzipped"';

$strCantLoadMySQL = '¤£¯à¸ü¤J MySQL ¼Ò²Õ,<br />½ÐÀË¬d PHP ªº²ÕºA³]©w';
$strCantRenameIdxToPrimary = 'µLªk±N¯Á¤Þ§ó¦W¬° PRIMARY!';
$strCardinality = '²Õ§O';
$strCarriage = 'Âk¦ì: \\r';
$strChange = '­×§ï';
$strChangePassword = '§ó§ï±K½X';
$strCheckAll = '¥þ¿ï';
$strCheckDbPriv = 'ÀË¬d¸ê®Æ®wÅv­­';
$strCheckTable = 'ÀË¬d¸ê®Æªí';
$strColumn = 'Äæ¦ì';
$strColumnNames = 'Äæ¦ì¦WºÙ';
$strCompleteInserts = '¨Ï¥Î§¹¾ã·s¼W«ü¥O';
$strConfirm = '±z½T©w­n³o¼Ë°µ¡H';
$strCookiesRequired = 'Cookies ¥²¶·±Ò°Ê¤~¯àµn¤J.';
$strCopyTable = '½Æ»s¸ê®Æªí¨ì¡G (®æ¦¡¬° ¸ê®Æ®w¦WºÙ<b>.</b>¸ê®Æªí¦WºÙ):';
$strCopyTableOK = '¤w¸g±N¸ê®Æªí %s ½Æ»s¬° %s.';
$strCreate = '«Ø¥ß';
$strCreateIndex = '·s¼W &nbsp;%s&nbsp; ²Õ¯Á¤ÞÄæ';
$strCreateIndexTopic = '·s¼W¤@²Õ¯Á¤Þ';
$strCreateNewDatabase = '«Ø¥ß·s¸ê®Æ®w';
$strCreateNewTable = '«Ø¥ß·s¸ê®Æªí©ó¸ê®Æ®w %s';
$strCriteria = '¿z¿ï';

$strData = '¸ê®Æ';
$strDatabase = '¸ê®Æ®w';
$strDatabaseHasBeenDropped = '¸ê®Æ®w %s ¤w³Q§R°£';
$strDatabases = '¸ê®Æ®w';
$strDatabasesStats = '¸ê®Æ®w²Î­p';
$strDatabaseWildcard = '¸ê®Æ®w (¤¹³\¨Ï¥Î¸U¥Î¦r¤¸):';
$strDataOnly = '¥u¦³¸ê®Æ';
$strDefault = '¹w³]­È';
$strDelete = '§R°£';
$strDeleted = '°O¿ý¤w³Q§R°£';
$strDeletedRows = '¤w§R°£Äæ¼Æ:';
$strDeleteFailed = '§R°£¥¢±Ñ!';
$strDeleteUserMessage = '±z¤w¸g±N¥Î¤á %s §R°£.';
$strDescending = '»¼´î';
$strDisplay = 'Åã¥Ü';
$strDisplayOrder = 'Åã¥Ü¦¸§Ç';
$strDoAQuery = '¥H½d¨Ò¬d¸ß (¸U¥Î¦r¤¸ : "%")';
$strDocu = '»¡©ú¤å¥ó';
$strDoYouReally = '±z½T©w­n ';
$strDrop = '§R°£';
$strDropDB = '§R°£¸ê®Æ®w %s';
$strDropTable = '§R°£¸ê®Æªí';
$strDumpingData = '¦C¥X¥H¤U¸ê®Æ®wªº¼Æ¾Ú¡G';
$strDynamic = '°ÊºA';

$strEdit = '½s¿è';
$strEditPrivileges = '½s¿èÅv­­';
$strEffective = '¹ê»Ú';
$strEmpty = '²MªÅ';
$strEmptyResultSet = 'MySQL ¶Ç¦^ªº¬d¸ßµ²ªG¬°ªÅ (­ì¦]¥i¯à¬°¡G¨S¦³§ä¨ì²Å¦X±ø¥óªº°O¿ý)';
$strEnd = '³Ì«á¤@­¶';
$strEnglishPrivileges = 'ª`·N: MySQL Åv­­¦WºÙ·|¥H­^»yÅã¥Ü';
$strError = '¿ù»~';
$strExtendedInserts = '¦ù©µ·s¼W¼Ò¦¡';
$strExtra = 'ªþ¥[';

$strField = 'Äæ¦ì';
$strFieldHasBeenDropped = '¸ê®Æªí %s ¤w³Q§R°£';
$strFields = 'Äæ¦ì';
$strFieldsEmpty = ' Äæ¦ìÁ`¼Æ¬OªÅªº! ';
$strFieldsEnclosedBy = '¡uÄæ¦ì¡v¨Ï¥Î¦r¤¸¡G';
$strFieldsEscapedBy = '¡uESCAPE¡v¨Ï¥Î¦r¤¸¡G';
$strFieldsTerminatedBy = '¡uÄæ¦ì¤À¹j¡v¨Ï¥Î¦r¤¸¡G';
$strFixed = '©T©w';
$strFlushTable = '±j­¢Ãö³¬¸ê®Æªí ("FLUSH")';
$strFormat = '®æ¦¡';
$strFormEmpty = 'ªí®æ¤ºº|¶ñ¤@¨Ç¸ê®Æ!';
$strFullText = 'Åã¥Ü§¹¾ã¤å¦r';
$strFunction = '¨ç¼Æ';

$strGenTime = '«Ø¥ß¤é´Á';
$strGo = '°õ¦æ';
$strGrants = 'Grants'; //should expressed in English
$strGzip = '"gzipped"';

$strHasBeenAltered = '¤w¸g­×§ï';
$strHasBeenCreated = '¤w¸g«Ø¥ß';
$strHome = '¥D¥Ø¿ý';
$strHomepageOfficial = 'phpMyAdmin ©x¤èºô¯¸';
$strHomepageSourceforge = 'phpMyAdmin ¤U¸üºô­¶';
$strHost = '¥D¾÷';
$strHostEmpty = '½Ð¿é¤J¥D¾÷¦WºÙ!';

$strIdxFulltext = '¥þ¤åÀË¯Á';
$strIfYouWish = '¦pªG±z­n«ü©w¸ê®Æ¶×¤JªºÄæ¦ì¡A½Ð¿é¤J¥Î³r¸¹¹j¶}ªºÄæ¦ì¦WºÙ';
$strIgnore = '©¿²¤';
$strIndex = '¯Á¤Þ';
$strIndexes = '¯Á¤Þ';
$strIndexHasBeenDropped = '¯Á¤Þ %s ¤w³Q§R°£';
$strIndexName = '¯Á¤Þ¦WºÙ&nbsp;:';
$strIndexType = '¯Á¤ÞÃþ«¬&nbsp;:';
$strInsert = '·s¼W';
$strInsertAsNewRow = 'Àx¦s¬°·s°O¿ý';
$strInsertedRows = '·s¼W¦C¼Æ:';
$strInsertNewRow = '·s¼W¤@µ§°O¿ý';
$strInsertTextfiles = '±N¤å¦rÀÉ¸ê®Æ¶×¤J¸ê®Æªí';
$strInstructions = '«ü¥O';
$strInUse = '¨Ï¥Î¤¤';
$strInvalidName = '"%s" ¬O¤@­Ó«O¯d¦r,±z¤£¯à±N«O¯d¦r¨Ï¥Î¬° ¸ê®Æ®w/¸ê®Æªí/Äæ¦ì ¦WºÙ.';

$strKeepPass = '½Ð¤£­n§ó§ï±K½X';
$strKeyname = 'Áä¦W';
$strKill = 'Kill'; //should expressed in English

$strLength = 'ªø«×';
$strLengthSet = 'ªø«×/¶°¦X*';
$strLimitNumRows = 'µ§°O¿ý/¨C­¶';
$strLineFeed = '´«¦æ: \\n';
$strLines = '¦æ¼Æ';
$strLinesTerminatedBy = '¡u¤U¤@¦æ¡v¨Ï¥Î¦r¤¸¡G';
$strLocationTextfile = '¤å¦rÀÉ®×ªº¦ì¸m';
$strLogin = 'µn¤J';
$strLogout = 'µn¥X¨t²Î';
$strLogPassword = '±K½X:';
$strLogUsername = 'µn¤J¦WºÙ:';

$strModifications = '­×§ï¤wÀx¦s';
$strModify = '­×§ï';
$strModifyIndexTopic = '­×§ï¯Á¤Þ';
$strMoveTable = '²¾°Ê¸ê®Æªí¨ì¡G(®æ¦¡¬° ¸ê®Æ®w¦WºÙ<b>.</b>¸ê®Æªí¦WºÙ)';
$strMoveTableOK = '¸ê®Æªí %s ¤w¸g²¾°Ê¨ì %s.';
$strMySQLReloaded = 'MySQL ­«·s¸ü¤J§¹¦¨';
$strMySQLSaid = 'MySQL ¶Ç¦^¡G ';
$strMySQLServerProcess = 'MySQL ª©¥» %pma_s1% ¦b %pma_s2% °õ¦æ¡Aµn¤JªÌ¬° %pma_s3%';
$strMySQLShowProcess = 'Åã¥Üµ{§Ç (Process)';
$strMySQLShowStatus = 'Åã¥Ü MySQL °õ¦æª¬ºA';
$strMySQLShowVars = 'Åã¥Ü MySQL ¨t²ÎÅÜ¼Æ';

$strName = '¦WºÙ';
$strNbRecords = 'µ§¶}©l¡A¦C¥X°O¿ýµ§¼Æ';
$strNext = '¤U¤@­Ó';
$strNo = ' §_ ';
$strNoDatabases = '¨S¦³¸ê®Æ®w';
$strNoDropDatabases = '"DROP DATABASE" «ü¥O¤w¸g°±¥Î.';
$strNoFrames = 'phpMyAdmin ¸û¬°¾A¦X¨Ï¥Î¦b¤ä´©<b>­¶®Ø</b>ªºÂsÄý¾¹.';
$strNoIndexPartsDefined = '³¡¥÷¯Á¤Þ¸ê®ÆÁÙ¥¼©w¸q!';
$strNoIndex = '¨S¦³¤w©w¸qªº¯Á¤Þ!';
$strNoModification = '¨S¦³ÅÜ§ó';
$strNone = '¤£¾A¥Î';
$strNoPassword = '¤£¥Î±K½X';
$strNoPrivileges = '¨S¦³Åv­­';
$strNoQuery = '¨S¦³ SQL »yªk!';
$strNoRights = '±z²{¦b¨S¦³¨¬°÷ªºÅv­­!';
$strNoTablesFound = '¸ê®Æ®w¤¤¨S¦³¸ê®Æªí';
$strNotNumber = '³o¤£¬O¤@­Ó¼Æ¦r!';
$strNotValidNumber = '¤£¬O¦³®Äªº¦C¼Æ!';
$strNoUsersFound = '§ä¤£¨ì¨Ï¥ÎªÌ';
$strNull = 'Null'; //should expressed in English

$strOftenQuotation = '³Ì±`¥Îªº¬O¤Þ¸¹¡A¡u«D¥²¶·¡vªí¥Ü¥u¦³ char ©M varchar Äæ¦ì·|³Q¥]¬A°_¨Ó';
$strOptimizeTable = '³Ì¨Î¤Æ¸ê®Æªí';
$strOptionalControls = '«D¥²­n¿ï¶µ¡A¥Î¨ÓÅª¼g¯S®í¦r¤¸';
$strOptionally = '«D¥²¶·';
$strOr = '©Î';
$strOverhead = '¦h¾l';

$strPartialText = 'Åã¥Ü³¡¥÷¤å¦r';
$strPassword = '±K½X';
$strPasswordEmpty = '½Ð¿é¤J±K½X!';
$strPasswordNotSame = '²Ä¤G¦¸¿é¤Jªº±K½X¤£¦P!';
$strPHPVersion = 'PHP ª©¥»';
$strPmaDocumentation = 'phpMyAdmin »¡©ú¤å¥ó';
$strPmaUriError = ' ¥²¶·³]©w <tt>$cfgPmaAbsoluteUri</tt> ¦b³]©wÀÉ¤º!';
$strPos1 = '²Ä¤@­¶';
$strPrevious = '«e¤@­¶';
$strPrimary = '¥DÁä';
$strPrimaryKey = '¥DÁä';
$strPrimaryKeyHasBeenDropped = '¥DÁä¤w³Q§R°£';
$strPrimaryKeyName = '¥DÁäªº¦WºÙ¥²¶·ºÙ¬° PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>¥²¶·</b>¬O¥DÁäªº¦WºÙ¥H¤Î¬O<b>°ß¤@</b>¤@²Õ¥DÁä!)';
$strPrintView = '¦C¦LÀËµø';
$strPrivileges = 'Åv­­';
$strProperties = 'ÄÝ©Ê';

$strQBE = '¨Ì½d¨Ò¬d¸ß (QBE)';
$strQBEDel = '²¾°£';
$strQBEIns = '·s¼W';
$strQueryOnDb = '¦b¸ê®Æ®w <b>%s</b> °õ¦æ SQL »yªk:';

$strRecords = '°O¿ý';
$strReferentialIntegrity = 'ÀË¬d«ü¥Ü§¹¾ã©Ê:';
$strReloadFailed = '­«·s¸ü¤JMySQL¥¢±Ñ';
$strReloadMySQL = '­«·s¸ü¤J MySQL';
$strRememberReload = '½Ð°OµÛ­«·s±Ò°Ê¦øªA¾¹.';
$strRenameTable = '±N¸ê®Æªí§ï¦W¬°';
$strRenameTableOK = '¤w¸g±N¸ê®Æªí %s §ï¦W¦¨ %s';
$strRepairTable = '­×´_¸ê®Æªí';
$strReplace = '¨ú¥N';
$strReplaceTable = '¥HÀÉ®×¨ú¥N¸ê®Æªí¸ê®Æ';
$strReset = '­«¸m';
$strReType = '½T»{±K½X';
$strRevoke = '²¾°£';
$strRevokeGrant = '²¾°£ Grant Åv­­';
$strRevokeGrantMessage = '±z¤w²¾°£³o¦ì¨Ï¥ÎªÌªº Grant Åv­­: %s';
$strRevokeMessage = '±z¤w²¾°£³o¦ì¨Ï¥ÎªÌªºÅv­­: %s';
$strRevokePriv = '²¾°£Åv­­';
$strRowLength = '¸ê®Æ¦Cªø«×';
$strRows = '¸ê®Æ¦C¦C¼Æ';
$strRowsFrom = 'µ§°O¿ý¡A¶}©l¦C¼Æ:';
$strRowSize = '¸ê®Æ¦C¤j¤p';
$strRowsModeHorizontal = '¤ô¥­';
$strRowsModeOptions = 'Åã¥Ü¬° %s ¤è¦¡ ¤Î ¨C¹j %s ¦æÅã¥ÜÄæ¦W';
$strRowsModeVertical = '««ª½';
$strRowsStatistic = '¸ê®Æ¦C²Î­p¼Æ­È';
$strRunning = '¦b %s °õ¦æ';
$strRunQuery = '°õ¦æ»yªk';
$strRunSQLQuery = '¦b¸ê®Æ®w %s °õ¦æ¥H¤U«ü¥O';

$strSave = 'Àx¦s';
$strSelect = '¿ï¾Ü';
$strSelectADb = '½Ð¿ï¾Ü¸ê®Æ®w';
$strSelectAll = '¥þ¿ï';
$strSelectFields = '¿ï¾ÜÄæ¦ì (¦Ü¤Ö¤@­Ó)';
$strSelectNumRows = '¬d¸ß¤¤';
$strSend = '¤U¸üÀx¦s';
$strSequence = '§Ç¦C';
$strServerChoice = '¿ï¾Ü¦øªA¾¹';
$strServerVersion = '¦øªA¾¹ª©¥»';
$strSetEnumVal = '¦pÄæ¦ì®æ¦¡¬O "enum" ©Î "set", ½Ð¨Ï¥Î¥H¤Uªº®æ¦¡¿é¤J: \'a\',\'b\',\'c\'...<br />¦p¦b¼Æ­È¤W»Ý­n¿é¤J¤Ï±×½u (\) ©Î³æ¤Þ¸¹ (\') , ½Ð¦A¥[¤W¤Ï±×½u (¨Ò¦p \'\\\\xyz\' or \'a\\\'b\').';
$strShow = 'Åã¥Ü';
$strShowAll = 'Åã¥Ü¥þ³¡';
$strShowCols = 'Åã¥ÜÄæ';
$strShowingRecords = 'Åã¥Ü°O¿ý';
$strShowPHPInfo = 'Åã¥Ü PHP ¸ê°T';
$strShowTables = 'Åã¥Ü¸ê®Æªí';
$strShowThisQuery = '­«·sÅã¥Ü SQL »yªk ';
$strSingly = '(¥u·|±Æ§Ç²{®Éªº°O¿ý)';
$strSize = '¤j¤p';
$strSort = '±Æ§Ç';
$strSpaceUsage = '¤w¨Ï¥ÎªÅ¶¡';
$strSQLQuery = 'SQL »yªk';
$strStartingRecord = '¥Ñ°O¿ý';
$strStatement = '±Ô­z';
$strStrucCSV = 'CSV ¸ê®Æ';
$strStrucData = 'µ²ºc»P¸ê®Æ';
$strStrucDrop = '¼W¥[ \'drop table\'';
$strStrucExcelCSV = 'Ms Excel ªº CSV ®æ¦¡';
$strStrucOnly = '¥u¦³µ²ºc';
$strSubmit = '°e¥X';
$strSuccess = '±zªºSQL»yªk¤w¶¶§Q°õ¦æ';
$strSum = 'Á`­p';

$strTable = '¸ê®Æªí';
$strTableComments = '¸ê®Æªíµù¸Ñ¤å¦r';
$strTableEmpty = '½Ð¿é¤J¸ê®Æªí¦WºÙ!';
$strTableHasBeenDropped = '¸ê®Æªí %s ¤w³Q§R°£';
$strTableHasBeenEmptied = '¸ê®Æªí %s ¤w³Q²MªÅ';
$strTableHasBeenFlushed = '¸ê®Æªí %s ¤w³Q±j­¢Ãö³¬';
$strTableMaintenance = '¸ê®ÆªíºûÅ@';
$strTables = '%s ¸ê®Æªí';
$strTableStructure = '¸ê®Æªí®æ¦¡¡G';
$strTableType = '¸ê®ÆªíÃþ«¬';
$strTextAreaLength = ' ¥Ñ©óªø«×­­¨î<br /> ¦¹Äæ¦ì¤£¯à½s¿è ';
$strTheContent = 'ÀÉ®×¤º®e¤w¸g¶×¤J¸ê®Æªí';
$strTheContents = 'ÀÉ®×¤º®e±N·|¨ú¥N¿ï©wªº¸ê®Æªí¤¤¨ã¦³¬Û¦P¥DÁä©Î°ß¤@Áäªº°O¿ý';
$strTheTerminator = '¤À¹jÄæ¦ìªº¦r¤¸';
$strTotal = 'Á`­p';
$strType = '«¬ºA';

$strUncheckAll = '¥þ³¡¨ú®ø';
$strUnique = '°ß¤@';
$strUnselectAll = '¥þ³¡¨ú®ø';
$strUpdatePrivMessage = '±z¤w¸g§ó·s¤F %s ªºÅv­­.';
$strUpdateProfile = '§ó·s¸ê®Æ:';
$strUpdateProfileMessage = '¸ê®Æ¤v¸g§ó·s.';
$strUpdateQuery = '§ó·s»yªk';
$strUsage = '¨Ï¥Î';
$strUseBackquotes = '½Ð¦b¸ê®Æªí¤ÎÄæ¦ì¨Ï¥Î¤Þ¸¹';
$strUser = '¨Ï¥ÎªÌ';
$strUserEmpty = '½Ð¿é¤J¨Ï¥ÎªÌ¦WºÙ!';
$strUserName = '¨Ï¥ÎªÌ¦WºÙ';
$strUsers = '¨Ï¥ÎªÌ';
$strUseTables = '¨Ï¥Î¸ê®Æªí';

$strValue = '­È';
$strViewDump = 'ÀËµø¸ê®Æªíªº³Æ¥÷·§­n (dump schema)';
$strViewDumpDB = 'ÀËµø¸ê®Æ®wªº³Æ¥÷·§­n (dump schema)';

$strWelcome = 'Åwªï¨Ï¥Î %s';
$strWithChecked = '¿ï¾Üªº¸ê®Æªí¡G';
$strWrongUser = '¿ù»~ªº¨Ï¥ÎªÌ¦WºÙ©Î±K½X¡A©Úµ´¦s¨ú';

$strYes = ' ¬O ';

$strZip = '"zipped"';

?>
