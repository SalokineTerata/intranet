<?php
/* $Id: thai.inc.php,v 1.107.2.2 2002/06/18 21:33:05 rabus Exp $ */

/**
 * Translated on 2002/04/29 by: Arthit Suriyawongkul & Warit Wanasathian
 * Revised on 2002/06/05 by: Arthit Suriyawongkul
 * Revised on 2002/06/14 by: Arthit Suriyawongkul
 */


// note: Thai has 2 standard encodings (tis-620, iso-8859-11)
// tis-620 is the only Thai encoding that registered with IANA,
// it used in MIME text/* media type.
$charset = 'tis-620';
$text_dir = 'ltr';
$left_font_family = 'sans-serif';
$right_font_family = 'sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('äºµì', '¡ÔâÅäºµì', 'àÁ¡¡Ðäºµì', '¡Ô¡Ðäºµì');

$day_of_week = array('ÍÒ.', '¨.', 'Í.', '¾.', '¾Ä.', 'È.', 'Ê.');
$month = array('Á.¤.', '¡.¾.', 'ÁÕ.¤.', 'àÁ.Â.', '¾.¤.', 'ÁÔ.Â.', '¡.¤.', 'Ê.¤.', '¡.Â.', 'µ.¤.', '¾.Â.', '¸.¤.');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%e %B %Y  %R¹.';


$strAccessDenied = 'äÁèÍ¹Ø­ÒµãËéãªé§Ò¹';
$strAction = '¡ÃÐ·Ó¡ÒÃ';
$strAddDeleteColumn = 'à¾ÔèÁ/Åº ¤ÍÅÑÁ¹ì (¿ÔÅ´ì)';
$strAddDeleteRow = 'à¾ÔèÁ/Åº á¶Ç';
$strAddNewField = 'à¾ÔèÁ¿ÔÅ´ìãËÁè';
$strAddPriv = 'à¾ÔèÁÊÔ·¸Ô';
$strAddPrivMessage = 'à¾ÔèÁÊÔ·¸ÔàÃÕÂºÃéÍÂáÅéÇ';
$strAddSearchConditions = 'à¾ÔèÁà§×èÍ¹ä¢ã¹¡ÒÃ¤é¹ËÒ :';
$strAddToIndex = 'à¾ÔèÁ´Ñª¹Õ¤ÍÅÑÁ¹ì %s';
$strAddUser = 'à¾ÔèÁ¼ÙéãªéãËÁè';
$strAddUserMessage = 'à¾ÔèÁ¼ÙéãªéãËÁèàÃÕÂºÃéÍÂáÅéÇ';
$strAffectedRows = 'á¶Ç·Õè¶Ù¡¡ÃÐ·º:';
$strAfter = 'ËÅÑ§ %s';
$strAfterInsertBack = 'Êè§¡ÅÑº';
$strAfterInsertNewInsert = 'á·Ã¡ÃÐàºÕÂ¹ãËÁè';
$strAll = '·Ñé§ËÁ´';
$strAlterOrderBy = 'àÃÕÂ§¤èÒã¹µÒÃÒ§µÒÁ';
$strAnalyzeTable = 'ÇÔà¤ÃÒÐËìµÒÃÒ§';
$strAnd = 'áÅÐ';
$strAnIndex = 'ä´éà¾ÔèÁ´Ñª¹ÕáÅéÇã¹ %s';
$strAny = 'ã´æ';
$strAnyColumn = '¤ÍÅÑÁ¹ìã´æ';
$strAnyDatabase = '°Ò¹¢éÍÁÙÅã´æ';
$strAnyHost = 'âÎÊµìã´æ';
$strAnyTable = 'µÒÃÒ§ã´æ';
$strAnyUser = '¼Ùéãªéã´æ';
$strAPrimaryKey = 'ä´éà¾ÔèÁ primary key áÅéÇã¹ %s';
$strAscending = '¹éÍÂä»ÁÒ¡';
$strAtBeginningOfTable = '·Õè¨Ø´àÃÔèÁµé¹¢Í§µÒÃÒ§';
$strAtEndOfTable = '·Õè¨Ø´ÊØ´·éÒÂ¢Í§µÒÃÒ§';
$strAttr = 'áÍµ·ÃÔºÔÇµì';

$strBack = 'ÂéÍ¹¡ÅÑº';
$strBinary = ' ¢éÍÁÙÅäº¹ÒÃÕ ';
$strBinaryDoNotEdit = ' ¢éÍÁÙÅäº¹ÒÃÕ - ËéÒÁá¡éä¢ ';
$strBookmarkDeleted = 'Åº¤Ó¤é¹·Õè¨´äÇéàÃÕÂºÃéÍÂáÅéÇ';
$strBookmarkLabel = '»éÒÂª×èÍ';
$strBookmarkQuery = '¤Ó¤é¹¹Õé¶Ù¡¨´äÇé';
$strBookmarkThis = '¨´¤Ó¤é¹¹ÕéäÇé';
$strBookmarkView = '´ÙÍÂèÒ§à´ÕÂÇ';
$strBrowse = 'à»Ô´´Ù';
$strBzip = '"bzipped"';

$strCantLoadMySQL = 'äÁèÊÒÁÒÃ¶àÃÕÂ¡ãªé MySQL extension,<br />¡ÃØ³ÒµÃÇ¨ÊÍº¡ÒÃµÑé§¤èÒ¢Í§ PHP';
$strCantRenameIdxToPrimary = 'à»ÅÕèÂ¹ª×èÍ´Ñª¹Õà»ç¹ PRIMARY äÁèä´é!';
$strCardinality = 'Cardinality';
$strCarriage = '»Ñ´á¤Ãè: \\r';
$strChange = 'à»ÅÕèÂ¹';
$strChangePassword = 'à»ÅÕèÂ¹ÃËÑÊ¼èÒ¹';
$strCheckAll = 'àÅ×Í¡·Ñé§ËÁ´';
$strCheckDbPriv = 'µÃÇ¨ÊÍºÊÔ·¸Ôã¹°Ò¹¢éÍÁÙÅ';
$strCheckTable = 'µÃÇ¨ÊÍºµÒÃÒ§';
$strColumn = '¤ÍÅÑÁ¹ì';
$strColumnNames = 'ª×èÍ¤ÍÅÑÁ¹ì';
$strCompleteInserts = '¤ÓÊÑè§ INSERT àµçÁÃÙ»áºº';
$strConfirm = '¤Ø³Â×¹ÂÑ¹·Õè¨Ð·ÓÊÔè§¹Õé?';
$strCookiesRequired = 'µéÍ§Í¹Ø­Òµãªéãªé \'¤Øê¡¡Õé\' àÊÕÂ¡èÍ¹ ¨Ö§¨Ð ¼èÒ¹¨Ø´¹Õéä»ä´é';
$strCopyTable = '¤Ñ´ÅÍ¡µÒÃÒ§ä»ÂÑ§ (database<b>.</b>table):';
$strCopyTableOK =  '¤Ñ´ÅÍ¡µÒÃÒ§ %s ä»à¡çºã¹ª×èÍ %s àÃÕÂº ÃéÍÂáÅéÇ.';
$strCreate = 'ÊÃéÒ§';
$strCreateIndex = 'ÊÃéÒ§´Ñª¹Õâ´Â¤ÍÅÑÁ¹ì %s';
$strCreateIndexTopic = 'ÊÃéÒ§´Ñª¹ÕãËÁè';
$strCreateNewDatabase = 'ÊÃéÒ§°Ò¹¢éÍÁÙÅãËÁè';
$strCreateNewTable = 'ÊÃéÒ§µÒÃÒ§ã¹°Ò¹¢éÍÁÙÅ¹Õé %s';
$strCriteria = 'à§×èÍ¹ä¢';

$strData = '¢éÍÁÙÅ';
$strDatabase = '°Ò¹¢éÍÁÙÅ ';
$strDatabaseHasBeenDropped = 'âÂ¹°Ò¹¢éÍÁÙÅ %s ·Ôé§ä»àÃÕÂº ÃéÍÂáÅéÇ';
$strDatabases = '°Ò¹¢éÍÁÙÅ';
$strDatabasesStats = 'Ê¶ÔµÔ°Ò¹¢éÍÁÙÅ';
$strDatabaseWildcard = '°Ò¹¢éÍÁÙÅ (ãªé wildcards ä´é):';
$strDataOnly = 'à©¾ÒÐ¢éÍÁÙÅ';
$strDefault = '¤èÒ»ÃÔÂÒÂ';
$strDelete = 'Åº';
$strDeleted = 'ÅºàÃÕÂºÃéÍÂáÅéÇ';
$strDeletedRows = 'á¶Ç·Õè¶Ù¡Åº:';
$strDeleteFailed = 'ÅºäÁèÊÓàÃç¨!';
$strDeleteUserMessage = '¤Ø³ä´éÅº¼Ùéãªé %s ä»áÅéÇ';
$strDescending = 'ÁÒ¡ä»¹éÍÂ';
$strDisplay = 'áÊ´§¼Å';
$strDisplayOrder = 'ÅÓ´Ñº¡ÒÃáÊ´§:';
$strDoAQuery = '·Ó "¤Ó¤é¹¨Ò¡µÑÇÍÂèÒ§" (wildcard: "%")';
$strDocu = 'àÍ¡ÊÒÃÍéÒ§ÍÔ§';
$strDoYouReally = 'µéÍ§¡ÒÃ¨Ð ';
$strDrop = 'âÂ¹·Ôé§';
$strDropDB = 'âÂ¹°Ò¹¢éÍÁÙÅ %s ·Ôé§';
$strDropTable = 'âÂ¹µÒÃÒ§·Ôé§';
$strDumpingData = 'dump µÒÃÒ§';
$strDynamic = 'äÁè¤§·Õè';

$strEdit = 'á¡éä¢';
$strEditPrivileges = 'á¡éä¢ÊÔ·¸Ô';
$strEffective = 'ÁÕ¼Å';
$strEmpty = 'Åº¢éÍÁÙÅ';
$strEmptyResultSet = 'MySQL ¤×¹¼ÅÅÑ¾¸ìÇèÒ§à»ÅèÒ (null) ¡ÅÑºÁÒ (0 á¶Ç).';
$strEnd = '·éÒÂÊØ´';
$strEnglishPrivileges = ' â»Ã´·ÃÒº: ª×èÍ¢Í§ÊÔ·¸Ôã¹ MySQL ¨Ð áÊ´§à»ç¹ÀÒÉÒÍÑ§¡ÄÉ ';
$strError = '¼Ô´¾ÅÒ´';
$strExtendedInserts = 'á·Ã¡ËÅÒÂÃÐàºÕÂ¹ã¹¤ÃÒÇà´ÕÂÇ';
$strExtra = 'à¾ÔèÁàµÔÁ';

$strField = '¿ÔÅ´ì';
$strFieldHasBeenDropped = 'âÂ¹¿ÔÅ´ì %s ·Ôé§ä»àÃÕÂºÃéÍÂáÅéÇ';
$strFields = '¨Ó¹Ç¹¿ÔÅ´ì';
$strFieldsEmpty = ' ¨Ó¹Ç¹¿ÔÅ´ì¤×Í ÇèÒ§à»ÅèÒ! ';
$strFieldsEnclosedBy = '¤ÃèÍÁ¿ÔÅ´ì´éÇÂ';
$strFieldsEscapedBy = 'à¤Ã×èÍ§ËÁÒÂÊÓËÃÑº escape char';
$strFieldsTerminatedBy = '¨º¿ÔÅ´ì´éÇÂ';
$strFixed = '¤§·Õè';
$strFlushTable = 'ÅéÒ§µÒÃÒ§ ("FLUSH")';
$strFormat = 'ÃÙ»áºº';
$strFormEmpty = '¤èÒã¹áºº¿ÍÃìÁËÒÂä» !';
$strFullText = '·Ñé§¢éÍ¤ÇÒÁ';
$strFunction = '¿Ñ§¡ìªÑè¹';

$strGenTime = 'àÇÅÒã¹¡ÒÃÊÃéÒ§';
$strGo = 'Å§Á×Í';
$strGrants = 'Í¹Ø­Òµ';
$strGzip = '"gzipped"';

$strHasBeenAltered = 'à»ÅÕèÂ¹àÊÃç¨áÅéÇ';
$strHasBeenCreated = 'ÊÃéÒ§àÊÃç¨áÅéÇ';
$strHome = 'Ë¹éÒºéÒ¹';
$strHomepageOfficial = 'âÎÁà¾¨ÍÂèÒ§à»ç¹·Ò§¡ÒÃ¢Í§ phpMyAdmin';
$strHomepageSourceforge = 'Ë¹éÒ´ÒÇ¹ìâËÅ´ phpMyAdmin ·Õè Sourceforge';
$strHost = 'âÎÊµì';
$strHostEmpty = 'ª×èÍâÎÊµìÂÑ§ÇèÒ§ÍÂÙè!';

$strIdxFulltext = 'Fulltext';
$strIfYouWish = '¶éÒµéÍ§¡ÒÃàÃÕÂ¡´Ùà©¾ÒÐºÒ§¤ÍÅÑÁ¹ì ãËéÃÐºØÃÒÂª×èÍ ¿ÔÅ´ìÁÒ´éÇÂ (¤Ñè¹áµèÅÐª×èÍ´éÇÂà¤Ã×èÍ§ËÁÒÂÅÙ¡¹éÓ)';
$strIgnore = 'äÁèÊ¹ã¨';
$strIndex = '´Ñª¹Õ';
$strIndexes = '´Ñª¹Õ';
$strIndexHasBeenDropped = 'âÂ¹´Ñª¹Õ %s ·Ôé§ä»àÃÕÂºÃéÍÂáÅéÇ';
$strIndexName = 'ª×èÍ´Ñª¹Õ :';
$strIndexType = 'ª¹Ô´¢Í§´Ñª¹Õ :';
$strInsert = 'á·Ã¡';
$strInsertAsNewRow = 'á·Ã¡à»ç¹á¶ÇãËÁè';
$strInsertedRows = 'á¶Ç·Õè¶Ù¡á·Ã¡:';
$strInsertNewRow = 'á·Ã¡á¶ÇãËÁè';
$strInsertTextfiles = 'á·Ã¡¢éÍÁÙÅ¨Ò¡ä¿Åì¢éÍ¤ÇÒÁà¢éÒä»ã¹ µÒÃÒ§';
$strInstructions = 'ÇÔ¸Õãªé';
$strInUse = 'ãªéÍÂÙè';
$strInvalidName = '"%s" à»ç¹¤ÓÊ§Ç¹ ¹ÓÁÒãªéµÑé§ª×èÍ °Ò¹¢éÍÁÙÅ/ µÒÃÒ§/¿ÔÅ´ì äÁèä´é';

$strKeepPass = '¡ÃØ³ÒÍÂèÒà»ÅÕèÂ¹ÃËÑÊ¼èÒ¹';
$strKeyname = 'ª×èÍ¤ÕÂì';
$strKill = '¦èÒ·Ôé§';

$strLength = '¤ÇÒÁÂÒÇ';
$strLengthSet = '¤ÇÒÁÂÒÇ/à«µ*';
$strLimitNumRows = 'ÃÐàºÕÂ¹µèÍË¹éÒ';
$strLineFeed = '¢Öé¹ºÃÃ·Ñ´ãËÁè: \\n';
$strLines = 'ºÃÃ·Ñ´';
$strLinesTerminatedBy = '¨ºá¶Ç´éÇÂ';
$strLocationTextfile = 'àÅ×Í¡ä¿Åì¢éÍ¤ÇÒÁ¨Ò¡';
$strLogin = 'à¢éÒÊÙèÃÐºº';
$strLogout = 'ÍÍ¡¨Ò¡ÃÐºº';
$strLogPassword = 'ÃËÑÊ¼èÒ¹:';
$strLogUsername = 'ª×èÍ¼Ùéãªé:';

$strModifications = 'ºÑ¹·Ö¡¡ÒÃá¡éä¢àÃÕÂºÃéÍÂáÅéÇ';
$strModify = 'á¡éä¢';
$strModifyIndexTopic = 'á¡éä¢´Ñª¹Õ';
$strMoveTable = 'ÂéÒÂµÒÃÒ§ä» (database<b>.</b>table):';
$strMoveTableOK = 'µÒÃÒ§ %s ¶Ù¡ÂéÒÂä» %s áÅéÇ';
$strMySQLReloaded = 'àÃÕÂ¡ MySQL ¢Öé¹ÁÒãËÁèáÅéÇ';
$strMySQLSaid = 'MySQL áÊ´§: ';
$strMySQLServerProcess = 'MySQL %pma_s1% ·Ó§Ò¹ÍÂÙèº¹ %pma_s2% ã¹ª×èÍ %pma_s3%';
$strMySQLShowProcess = 'áÊ´§§Ò¹·Õè·ÓÍÂÙè¢Í§ MySQL';
$strMySQLShowStatus = 'áÊ´§Ê¶Ò¹Ð¢Í§ MySQL';
$strMySQLShowVars = 'áÊ´§µÑÇá»ÃÃÐºº¢Í§ MySQL';

$strName = 'ª×èÍ';
$strNbRecords = '¨Ó¹Ç¹ÃÐàºÕÂ¹';
$strNext = 'µèÍä»';
$strNo = 'äÁè';
$strNoDatabases = 'äÁèÁÕ°Ò¹¢éÍÁÙÅ';
$strNoDropDatabases = '¤ÓÊÑè§ "DROP DATABASE" ¶Ù¡»Ô´äÇé';
$strNoFrames = 'àºÃÒà«ÍÃì·Õè<b>ãªéà¿ÃÁä´é</b> ¨ÐªèÇÂãËéãªé phpMyAdmin ä´é§èÒÂ¢Öé¹';
$strNoIndex = 'ÂÑ§äÁèä´é¡ÓË¹´´Ñª¹Õã´æ!';
$strNoIndexPartsDefined = 'äÁèä´é¡ÓË¹´ÊèÇ¹ã´æ ¢Í§´Ñª¹Õ!';
$strNoModification = 'äÁèÁÕ¡ÒÃà»ÅÕèÂ¹á»Å§';
$strNone = 'äÁèÁÕ';
$strNoPassword = 'äÁèÁÕÃËÑÊ¼èÒ¹';
$strNoPrivileges = 'äÁèÁÕÊÔ·¸Ô';
$strNoQuery = 'äÁèÁÕ¤Ó¤é¹ SQL!';
$strNoRights = '¤Ø³äÁèÁÕÊÔ·¸Ô·Õè¨Ðà¢éÒÁÒµÃ§¹Õé!';
$strNoTablesFound = 'äÁè¾ºµÒÃÒ§ã´ æ ã¹°Ò¹¢éÍÁÙÅ';
$strNotNumber = '¤èÒ¹ÕéäÁèãªèµÑÇàÅ¢!';
$strNotValidNumber = ' äÁèãªèËÁÒÂàÅ¢á¶Ç·Õè¶Ù¡µéÍ§!';
$strNoUsersFound = 'äÁè¾º¼Ùéãªéã´æ.';
$strNull = 'ÇèÒ§à»ÅèÒ (null)';

$strOftenQuotation = 'â´Â»¡µÔ¨Ðà»ç¹à¤Ã×èÍ§ËÁÒÂÍÑ­»ÃÐ¡ÒÈ (à¤Ã×èÍ§ËÁÒÂ¤Ó¾Ù´)<br />"à·èÒ·Õè¨Óà»ç¹" ËÁÒÂ¶Ö§ãËéãÊèà¤Ã×èÍ§ËÁÒÂ ¤ÃèÍÁà©¾ÒÐ¡Ñº¿ÔÅ´ìª¹Ô´ char áÅÐ varchar à·èÒ¹Ñé¹';
$strOptimizeTable = '»ÃÑºáµè§µÒÃÒ§';
$strOptionalControls = '¡ÓË¹´ÇèÒ¨Ðà¢ÕÂ¹ËÃ×ÍÍèÒ¹µÑÇÍÑ¡¢ÃÐ¾ÔàÈÉ ÍÂèÒ§äÃ';
$strOptionally = 'à·èÒ·Õè¨Óà»ç¹';
$strOr = 'ËÃ×Í';
$strOverhead = 'à¡Ô¹¤ÇÒÁ¨Óà»ç¹';

$strPartialText = '¢éÍ¤ÇÒÁºÒ§ÊèÇ¹';
$strPassword = 'ÃËÑÊ¼èÒ¹';
$strPasswordEmpty = 'ÃËÑÊ¼èÒ¹ÂÑ§ÇèÒ§ÍÂÙè!';
$strPasswordNotSame = 'ÃËÑÊ¼èÒ¹äÁèµÃ§¡Ñ¹!';
$strPHPVersion = 'ÃØè¹¢Í§ PHP';
$strPmaDocumentation = 'àÍ¡ÊÒÃ¡ÒÃãªé phpMyAdmin';
$strPmaUriError = '<b>µéÍ§</b>¡ÓË¹´¤èÒ <tt>$cfgPmaAbsoluteUri</tt> ã¹ä¿Åì¤Í¹¿Ô¡ÙàÃªÑè¹àÊÕÂ¡èÍ¹';
$strPos1 = '¨Ø´àÃÔèÁµé¹';
$strPrevious = '¡èÍ¹Ë¹éÒ';
$strPrimary = 'Primary';
$strPrimaryKey = 'Primary key';
$strPrimaryKeyHasBeenDropped = 'âÂ¹ primary key ·Ôé§ä»àÃÕÂº ÃéÍÂáÅéÇ';
$strPrimaryKeyName = 'ª×èÍ¢Í§ primary key ¨ÐµéÍ§à»ç¹... PRIMARY!';
$strPrimaryKeyWarning = '(ª×èÍ¢Í§ primary key <b>¨ÐµéÍ§à»ç¹ </b>"PRIMARY" à·èÒ¹Ñé¹!)';
$strPrintView = 'áÊ´§';
$strPrivileges = 'ÊÔ·¸Ô';
$strProperties = '¤Ø³ÊÁºÑµÔ';

$strQBE = '¤Ó¤é¹¨Ò¡µÑÇÍÂèÒ§';
$strQBEDel = 'Åº';
$strQBEIns = 'à¾ÔèÁ';
$strQueryOnDb = '¤Ó¤é¹º¹°Ò¹¢éÍÁÙÅ <b>%s</b>:';

$strRecords = 'ÃÐàºÕÂ¹';
$strReferentialIntegrity = 'µÃÇ¨ÊÍº¤ÇÒÁÊÁºÙÃ³ì¢Í§¡ÒÃÍéÒ§ ¶Ö§:';
$strReloadFailed = 'ÃÕâËÅ´ MySQL ãËÁèäÁèÊÓàÃç¨';
$strReloadMySQL = 'ÃÕâËÅ´ MySQL ãËÁè';
$strRememberReload = 'ÍÂèÒÅ×ÁÃÕâËÅ´à«ÔÃì¿àÇÍÃìãËÁèÍÕ¡¤ÃÑé§'; // can be better translated
$strRenameTable = 'à»ÅÕèÂ¹ª×èÍµÒÃÒ§à»ç¹';
$strRenameTableOK = 'µÒÃÒ§ %s ä´é¶Ù¡à»ÅÕèÂ¹ª×èÍà»ç¹ %s';
$strRepairTable = '«èÍÁá«ÁµÒÃÒ§';
$strReplace = 'à¢ÕÂ¹·Ñº';
$strReplaceTable = 'à¢ÕÂ¹·Ñº´éÇÂ¢éÍÁÙÅ¨Ò¡ä¿Åì';
$strReset = 'àÃÔèÁãËÁè';
$strReType = '¾ÔÁ¾ìãËÁè';
$strRevoke = 'à¾Ô¡¶Í¹';
$strRevokeGrant = 'à¾Ô¡¶Í¹¡ÒÃÍ¹Ø­Òµ';
$strRevokeGrantMessage = '¤Ø³ä´éà¾Ô¡¶Í¹¡ÒÃÍ¹Ø­Òµ¢Í§ %s';
$strRevokeMessage = '¤Ø³ä´éà¾Ô¡¶Í¹ÊÔ·¸Ô¢Í§ %s';
$strRevokePriv = 'à¾Ô¡¶Í¹ÊÔ·¸Ô';
$strRowLength = '¤ÇÒÁÂÒÇá¶Ç';
$strRows = 'á¶Ç';
$strRowsFrom = 'á¶Ç àÃÔèÁ¨Ò¡á¶Ç·Õè';
$strRowSize = ' ¢¹Ò´á¶Ç ';
$strRowsModeHorizontal = 'á¹Ç¹Í¹';
$strRowsModeOptions = 'ÍÂÙèã¹%s áÅÐ«éÓËÑÇá¶Ç·Ø¡æ %s à«ÅÅì';
$strRowsModeVertical = 'á¹ÇµÑé§';
$strRowsStatistic = 'Ê¶ÔµÔ¢Í§á¶Ç';
$strRunning = '·Ó§Ò¹ÍÂÙèº¹ %s';
$strRunQuery = 'Êè§¤Ó¤é¹';
$strRunSQLQuery = '·Ó¤Ó¤é¹º¹°Ò¹¢éÍÁÙÅ %s';

$strSave = 'ºÑ¹·Ö¡';
$strSelect = 'àÅ×Í¡';
$strSelectADb = 'â»Ã´àÅ×Í¡°Ò¹¢éÍÁÙÅ';
$strSelectAll = 'àÅ×Í¡·Ñé§ËÁ´';
$strSelectFields = 'àÅ×Í¡¿ÔÅ´ì (ÍÂèÒ§¹éÍÂË¹Öè§¿ÔÅ´ì):';
$strSelectNumRows = 'ã¹¤Ó¤é¹';
$strSend = 'Êè§ÁÒà»ç¹ä¿Åì';
$strServerChoice = 'µÑÇàÅ×Í¡à«ÔÃì¿àÇÍÃì';
$strServerVersion = 'ÃØè¹¢Í§à«ÔÃì¿àÇÍÃì';
$strSetEnumVal = '¶éÒª¹Ô´¢Í§¿ÔÅ´ìà»ç¹ "enum" ËÃ×Í "set" â»Ã´ ãÊè¤èÒµÒÁÃÙ»áºº: \'a\',\'b\',\'c\'...<br />¶éÒµéÍ§¡ÒÃãÊèà¤Ã×èÍ§ËÁÒÂ backslash ("\\") ËÃ×Í ÍÑ»ÃÐ¡ÒÈà´ÕèÂÇ ("\'") à¢éÒä»ã¹¤èÒàËÅèÒ¹Ñé¹ ãËéãÊèà¤Ã×èÍ§ËÁÒÂ backslash ¹ÓË¹éÒ (µÑÇÍÂèÒ§: \'\\\\xyz\' or \'a\\\'b\')';
$strShow = 'áÊ´§';
$strShowAll = 'áÊ´§·Ñé§ËÁ´';
$strShowCols = 'áÊ´§¤ÍÅÑÁ¹ì';
$strShowingRecords = 'áÊ´§ÃÐàºÕÂ¹·Õè ';
$strShowPHPInfo = 'áÊ´§¢éÍÁÙÅ¢Í§ PHP';
$strShowTables = 'áÊ´§µÒÃÒ§';
$strShowThisQuery = ' áÊ´§¤Ó¤é¹¹ÕéÍÕ¡·Õ ';
$strSingly = '(à´ÕèÂÇ)';
$strSize = '¢¹Ò´';
$strSort = 'àÃÕÂ§';
$strSpaceUsage = 'à¹×éÍ·Õè·Õèãªé';
$strSQLQuery = '¤Ó¤é¹ SQL';
$strStartingRecord = 'àÃÔèÁ·ÕèÃÐàºÕÂ¹';
$strStatement = '¤ÓÊÑè§';
$strStrucExcelCSV = '¢éÍÁÙÅ CSV ÊÓËÃÑºäÁâ¤Ã«Í¿µìàÍç¡à«Å';
$strStrucCSV = '¢éÍÁÙÅ CSV';
$strStrucData = '·Ñé§â¤Ã§ÊÃéÒ§áÅÐ¢éÍÁÙÅ';
$strStrucDrop = 'à¾ÔèÁ¤ÓÊÑè§ \'drop table\'';
$strStrucOnly = 'à©¾ÒÐâ¤Ã§ÊÃéÒ§';
$strSubmit = 'Êè§';
$strSuccess = '·Ó¤Ó¤é¹àÊÃç¨àÃÕÂºÃéÍÂáÅéÇ';
$strSum = '¼ÅÃÇÁ';

$strTable = 'µÒÃÒ§ ';
$strTableComments = 'ËÁÒÂàËµØ¢Í§µÒÃÒ§';
$strTableEmpty = 'ª×èÍµÒÃÒ§ÂÑ§ÇèÒ§ÍÂÙè!';
$strTableHasBeenDropped = 'âÂ¹µÒÃÒ§ %s ·Ôé§ä»àÃÕÂºÃéÍÂ áÅéÇ';
$strTableHasBeenEmptied = 'Åº¢éÍÁÙÅã¹µÒÃÒ§ %s àÃÕÂºÃéÍÂ áÅéÇ';
$strTableHasBeenFlushed = 'ÅéÒ§µÒÃÒ§ %s àÃÕÂºÃéÍÂáÅéÇ';
$strTableMaintenance = '¡ÒÃ´ÙáÅÃÑ¡ÉÒµÒÃÒ§';
$strTables = '%s µÒÃÒ§';
$strTableStructure = 'â¤Ã§ÊÃéÒ§µÒÃÒ§';
$strTableType = 'ª¹Ô´µÒÃÒ§';
$strTextAreaLength = ' à¹×èÍ§¨Ò¡¤ÇÒÁÂÒÇ¢Í§ÁÑ¹ <br />¿ÔÅ´ì¹Õé äÁèÍÒ¨á¡éä¢ä´é ';
$strTheContent = 'ä´éá·Ã¡¢éÍÁÙÅ¨Ò¡ä¿Åì¢Í§¤Ø³àÃÕÂºÃéÍÂáÅéÇ';
$strTheContents = 'ÊÓËÃÑºá¶Ç·ÕèÁÕ primary key ËÃ×Í unique key àËÁ×Í¹¡Ñ¹ à¹×éÍËÒ¨Ò¡ä¿Åì¨Ðá·¹·Õèà¹×éÍËÒà´ÔÁã¹µÒÃÒ§';
$strTheTerminator = '¨Ø´ÊÔé¹ÊØ´¢Í§¿ÔÅ´ì';
$strTotal = '·Ñé§ËÁ´';
$strType = 'ª¹Ô´';

$strUncheckAll = 'äÁèàÅ×Í¡àÅÂ';
$strUnique = 'àÍ¡ÅÑ¡É³ì';
$strUnselectAll = 'äÁèàÅ×Í¡àÅÂ';
$strUpdatePrivMessage = '¤Ø³ä´é»ÃÑº»ÃØ§ÊÔ·¸ÔÊÓËÃÑº %s áÅéÇ';
$strUpdateProfile = '»ÃÑº»ÃØ§â¾Ãä¿Åì:';
$strUpdateProfileMessage = '»ÃÑº»ÃØ§â¾Ãä¿ÅìàÃÕÂºÃéÍÂáÅéÇ';
$strUpdateQuery = '»ÃÑº»ÃØ§¤Ó¤é¹';
$strUsage = 'ãªé§Ò¹';
$strUseBackquotes = 'ãÊè \'backqoute\' ãËé¡Ñºª×èÍµÒÃÒ§áÅÐ¿ÔÅ´ì';
$strUser = '¼Ùéãªé';
$strUserEmpty = 'ª×èÍ¼ÙéãªéÂÑ§ÇèÒ§ÍÂÙè!';
$strUserName = 'ª×èÍ¼Ùéãªé';
$strUsers = '¼Ùéãªé';
$strUseTables = 'ãªéµÒÃÒ§';

$strValue = '¤èÒ';
$strViewDump = '´Ùâ¤Ã§ÊÃéÒ§¢Í§µÒÃÒ§';
$strViewDumpDB = '´Ùâ¤Ã§ÊÃéÒ§¢Í§°Ò¹¢éÍÁÙÅ';

$strWelcome = '%s ÂÔ¹´ÕµéÍ¹ÃÑº';
$strWithChecked = '·Ó¡Ñº·ÕèàÅ×Í¡:';
$strWrongUser = 'Í¹Ø­ÒµãËéà¢éÒãªéäÁèä´é ª×èÍ¼ÙéãªéËÃ×ÍÃËÑÊ¼èÒ¹¼Ô´';

$strYes = 'ãªè';

$strZip = '"zipped"';

// To translate
?>
