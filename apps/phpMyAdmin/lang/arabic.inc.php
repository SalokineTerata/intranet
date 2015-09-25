<?php
/* $Id: arabic.inc.php,v 1.22.2.1 2002/05/13 18:46:08 loic1 Exp $ */

/**
 * Original translation to Arabic by Fisal <fisal77 at hotmail.com>
 * Update by Tarik kallida <kallida at caramail.com>
 */


$charset = 'windows-1256';
$text_dir = 'rtl'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'Tahoma, verdana, arial, helvetica, sans-serif';
$right_font_family = '"Windows UI", Tahoma, verdana, arial, helvetica, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('ÈÇíÊ', 'ßíáæÈÇíÊ', 'ãíÌÇÈÇíÊ', 'ÛíÛÇÈÇíÊ');

$day_of_week = array('ÇáÃÍÏ', 'ÇáÅËäíä', 'ÇáËáÇËÇÁ', 'ÇáÃÑÈÚÇÁ', 'ÇáÎãíÓ', 'ÇáÌãÚÉ', 'ÇáÓÈÊ');
$month = array('íäÇíÑ', 'ÝÈÑÇíÑ', 'ãÇÑÓ', 'ÃÈÑíá', 'ãÇíæ', 'íæäíæ', 'íæáíæ', 'ÃÛÓØÓ', 'ÓÈÊãÈÑ', 'ÃßÊæÈÑ', 'äæÝãÈÑ', 'ÏíÓãÈÑ');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%d %B %Y ÇáÓÇÚÉ %H:%M';


$strAccessDenied = 'ÛíÑ ãÓãæÍ';
$strAction = 'ÇáÚãáíÉ';
$strAddDeleteColumn = 'ÅÖÇÝå/ÍÐÝ ÚãæÏ ÍÞá';
$strAddDeleteRow = 'ÅÖÇÝå/ÍÐÝ ÕÝ ÓÌá';
$strAddNewField = 'ÅÖÇÝÉ ÍÞá ÌÏíÏ';
$strAddPriv = 'ÅÖÇÝÉ ÅãÊíÇÒ ÌÏíÏ';
$strAddPrivMessage = 'áÞÏ ÃÖÝÊ ÅãÊíÇÒ ÌÏíÏ.';
$strAddSearchConditions = 'ÃÖÝ ÔÑæØ ÇáÈÍË (ÌÓã ãä ÇáÝÞÑå "where" clause):';
$strAddToIndex = 'ÅÖÇÝå ßÝåÑÓ &nbsp;%s&nbsp;ÕÝ(ÜæÝ)';
$strAddUser = 'ÃÖÝ ãÓÊÎÏã ÌÏíÏ';
$strAddUserMessage = 'áÞÏ ÃÖÝÊ ãÓÊÎÏã ÌÏíÏ.';
$strAffectedRows = 'ÕÝæÝ ãÄËÑå:';
$strAfter = 'ÈÚÏ %s';
$strAfterInsertBack = 'ÇáÑÌæÚ Åáì ÇáÕÝÍÉ ÇáÓÇÈÞÉ';
$strAfterInsertNewInsert = 'ÅÏÎÇá ÊÓÌíá ÌÏíÏ';
$strAll = 'Çáßá';
$strAlterOrderBy = 'ÊÚÏíá ÊÑÊíÈ ÇáÌÏæá ÈÜ';
$strAnalyzeTable = 'ÊÍáíá ÇáÌÏæá';
$strAnd = 'æ';
$strAnIndex = 'áÞÏ ÃõÖíÝ ÇáÝåÑÓ Ýí %s';
$strAny = 'Ãí';
$strAnyColumn = 'Ãí ÚãæÏ';
$strAnyDatabase = 'Ãí ÞÇÚÏÉ ÈíÇäÇÊ';
$strAnyHost = 'Ãí ãÒæÏ';
$strAnyTable = 'Ãí ÌÏæá';
$strAnyUser = 'Ãí ãÓÊÎÏã';
$strAPrimaryKey = 'áÞÏ ÃõÖíÝ ÇáãÝÊÇÍ ÇáÃÓÇÓí Ýí %s';
$strAscending = 'ÊÕÇÚÏíÇð';
$strAtBeginningOfTable = 'Ýí ÈÏÇíÉ ÇáÌÏæá';
$strAtEndOfTable = 'Ýí äåÇíÉ ÇáÌÏæá';
$strAttr = 'ÇáÎæÇÕ';

$strBack = 'ÑÌæÚ';
$strBinary = 'ËäÇÆí';
$strBinaryDoNotEdit = 'ËäÇÆí - áÇÊÍÑÑå';
$strBookmarkDeleted = 'áÞÏ ÍõÐÝÊ ÇáÚáÇãå ÇáãÑÌÚíå.';
$strBookmarkLabel = 'ÚáÇãå';
$strBookmarkQuery = 'ÚáÇãå ãÑÌÚíå SQL-ÅÓÊÚáÇã';
$strBookmarkThis = 'ÅÌÚá ÚáÇãå ãÑÌÚíå SQL-ÅÓÊÚáÇã';
$strBookmarkView = 'ÚÑÖ ÝÞØ';
$strBrowse = 'ÅÓÊÚÑÇÖ';
$strBzip = '"bzipped"';

$strCantLoadMySQL = 'áÇíãßä ÊÍãíá ÅãÊÏÇÏ MySQL,<br />ÇáÑÌÇÁ ÝÍÕ ÅÚÏÇÏÇÊ PHP.';
$strCantRenameIdxToPrimary = 'áÇíãßä ÊÛííÑ ÅÓã ÇáÝåÑÓ Åáì ÇáÃÓÇÓí!';
$strCarriage = 'ÅÑÌÇÚ ÇáÍãæáå: \\r';
$strChange = 'ÊÛííÑ';
$strChangePassword = 'ÊÛííÑ ßáãÉ ÇáÓÑ';
$strCheckAll = 'ÅÎÊÑ Çáßá';
$strCheckDbPriv = 'ÝÍÕ ÅãÊíÇÒ ÞÇÚÏÉ ÇáÈíÇäÇÊ';
$strCheckTable = 'ÇáÊÍÞÞ ãä ÇáÌÏæá';
$strColumn = 'ÚãæÏ';
$strColumnNames = 'ÅÓã ÇáÚãæÏ';
$strCompleteInserts = 'ÇáÅÏÎÇá áÞÏ ÅßÊãá';
$strConfirm = 'åá ÊÑíÏ ÍÞÇð Ãä ÊÝÚá Ðáß¿';
$strCookiesRequired = 'íÌÈ ÊÝÚíá ÏÚã ÇáßæßíÒ Ýí åÐå ÇáãÑÍáÉ.';
$strCopyTable = 'äÓÎ ÇáÌÏæá Åáì';
$strCopyTableOK = 'ÇáÌÏæá %s áÞÏ Êã äÓÎå Åáì %s.';
$strCreate = 'Êßæíä';
$strCreateIndex = 'ÊÕãíã ÝåÑÓå Úáì&nbsp;%s&nbsp;ÚãæÏ';
$strCreateIndexTopic = 'ÊÕãíã ÝåÑÓå ÌÏíÏå';
$strCreateNewDatabase = 'Êßæíä ÞÇÚÏÉ ÈíÇäÇÊ ÌÏíÏÉ';
$strCreateNewTable = 'Êßæíä ÌÏæá ÌÏíÏ Ýí ÞÇÚÏÉ ÇáÈíÇäÇÊ %s';
$strCriteria = 'ÇáãÚÇííÑ';

$strData = 'ÈíÇäÇÊ';
$strDatabase = 'ÞÇÚÏÉ ÇáÈíÇäÇÊ ';
$strDatabaseHasBeenDropped = 'ÞÇÚÏÉ ÈíÇäÇÊ %s ãÍÐæÝå.';
$strDatabases = 'ÞÇÚÏÉ ÈíÇäÇÊ';
$strDatabasesStats = 'ÅÍÕÇÆíÇÊ ÞæÇÚÏ ÇáÈíÇäÇÊ';
$strDatabaseWildcard = 'ÞÇÚÏÉ ÈíÇäÇÊ:';
$strDataOnly = 'ÈíÇäÇÊ ÝÞØ';
$strDefault = 'ÅÝÊÑÇÖí';
$strDelete = 'ÍÐÝ';
$strDeleted = 'áÞÏ Êã ÍÐÝ ÇáÕÝ';
$strDeletedRows = 'ÇáÕÝæÝ ÇáãÍÐæÝå:';
$strDeleteFailed = 'ÇáÍÐÝ ÎÇØÆ!';
$strDeleteUserMessage = 'áÞÏ ÍÐÝÊ ÇáãÓÊÎÏã %s.';
$strDescending = 'ÊäÇÒáíÇð';
$strDisplay = 'ÚÑÖ';
$strDisplayOrder = 'ÊÑÊíÈ ÇáÚÑÖ:';
$strDoAQuery = 'ÊÌÚá "ÅÓÊÚáÇã ÈæÇÓØÉ ÇáãËÇá" (wildcard: "%")';
$strDocu = 'ãÓÊäÏÇÊ æËÇÆÞíå';
$strDoYouReally = 'åá ÊÑíÏ ÍÞÇð ÊäÝíÐ';
$strDrop = 'ÍÐÝ';
$strDropDB = 'ÍÐÝ ÞÇÚÏÉ ÈíÇäÇÊ %s';
$strDropTable = 'ÍÐÝ ÌÏæá';
$strDumpingData = 'ÅÑÌÇÚ Ãæ ÅÓÊíÑÇÏ ÈíÇäÇÊ ÇáÌÏæá';
$strDynamic = 'ÏíäÇãíßí';

$strEdit = 'ÊÍÑíÑ';
$strEditPrivileges = 'ÊÍÑíÑ ÇáÅãÊíÇÒÇÊ';
$strEffective = 'ÝÚÇá';
$strEmpty = 'ÅÝÑÇÛ ãÍÊæì';
$strEmptyResultSet = 'MySQL ÞÇã ÈÅÑÌÇÚ äÊíÌÉ ÅÚÏÇÏ ÝÇÑÛå (ãËáÇð. ÕÝ ÕÝÑí).';
$strEnd = 'äåÇíå';
$strEnglishPrivileges = ' ãáÇÍÙå: ÅÓã ÇáÅãÊíÇÒ áÜMySQL íÙåÑ æíõÞÑÃ ÈÇááÛå ÇáÅäÌáíÒíå ÝÞØ ';
$strError = 'ÎØÃ';
$strExtendedInserts = 'ÅÏÎÇá ãõÏÏ';
$strExtra = 'ÅÖÇÝí';

$strField = 'ÇáÍÞá';
$strFieldHasBeenDropped = 'ÍÞá ãÍÐæÝ %s';
$strFields = ' ÚÏÏ ÇáÍÞæá';
$strFieldsEmpty = ' ÊÚÏÇÏ ÇáÍÞá ÝÇÑÛ! ';
$strFieldsEnclosedBy = 'ÍÞá ãÖãä ÈÜ';
$strFieldsEscapedBy = 'ÍÞá ãõÊÌÇåá ÈÜ';
$strFieldsTerminatedBy = 'ÍÞá ãÝÕæá ÈÜ';
$strFixed = 'ãËÈÊ';
$strFlushTable = 'ÅÚÇÏÉ ÊÍãíá ÇáÌÏæá ("FLUSH")';
$strFormat = 'ÕíÛå';
$strFormEmpty = 'íæÌÏ Þíãå ãÝÞæÏå ÈÇáäãæÐÌ !';
$strFullText = 'äÕæÕ ßÇãáå';
$strFunction = 'ÏÇáÉ';

$strGenTime = 'ÃäÔÆ Ýí';
$strGo = '&nbsp;ÊäÝíÜÜÐ&nbsp;';
$strGrants = 'Grants';
$strGzip = '"gzipped"';

$strHasBeenAltered = 'áÞÏ ÚõÏöá.';
$strHasBeenCreated = 'áÞÏ Êßæä.';
$strHome = 'ÇáÕÝÍÉ ÇáÑÆíÓíÉ';
$strHomepageOfficial = 'ÇáÕÝÍÉ ÇáÑÆíÓíÉ ÇáÑÓãíÉ áÜ phpMyAdmin';
$strHomepageSourceforge = 'Sourceforge phpMyAdmin ÕÝÍÉ ÇáÊäÒíá';
$strHost = 'ÇáãÒæÏ';
$strHostEmpty = 'ÅÓã ÇáãÓÊÖíÝ ÝÇÑÛ!';

$strIdxFulltext = 'ÇáäÕ ßÇãáÇð';
$strIfYouWish = 'ÅÐÇ ßäÊ ÊÑÛÈ Ýí Ãä ÊÍãá ÈÚÖ ÃÚãÏÉ ÇáÌÏæá ÝÞØ, ÍÏÏ ÈÇáÝÇÕáå ÇáÊí ÊÝÕá ÞÇÆãÉ ÇáÍÞá.';
$strIgnore = 'ÊÌÇåá';
$strIndex = 'ÝåÑÓÊ';
$strIndexHasBeenDropped = 'ÝåÑÓå ãÍÐæÝå %s';
$strIndexName = 'ÅÓã ÇáÝåÑÓ&nbsp;:';
$strIndexType = 'äæÚ ÇáÝåÑÓ&nbsp;:';
$strIndexes = 'ÝåÇÑÓ';
$strInsert = 'ÅÏÎÇá';
$strInsertAsNewRow = 'ÅÏÎÇá ßÊÓÌíá ÌÏíÏ';
$strInsertedRows = 'ÕÝæÝ ãÏÎáå:';
$strInsertNewRow = 'ÅÖÇÝÉ ÊÓÌíá ÌÏíÏ';
$strInsertTextfiles = 'ÅÏÎÇá ãáÝ äÕí Ýí ÇáÌÏæá';
$strInstructions = 'ÇáÃæÇãÑ';
$strInUse = 'ÞíÏ ÇáÅÓÊÚãÇá';
$strInvalidName = '"%s" ßáãå ãÍÌæÒå, áÇíãßäß ÅÓÊÎÏÇãåÇ ßÅÓã ÞÇÚÏÉ ÈíÇäÇÊ/ÌÏæá/ÍÞá.';

$strKeepPass = 'áÇÊÛíÑ ßáãÉ ÇáÓÑ';
$strKeyname = 'ÅÓã ÇáãÝÊÇÍ';
$strKill = 'ÅÈØÇá';

$strLength = 'ÇáØæá';
$strLengthSet = 'ÇáØæá/ÇáÞíãå*';
$strLimitNumRows = 'ÑÞã ÇáÓÌáÇÊ áßá ÕÝÍå';
$strLineFeed = 'ÎØæØ ãÚÑÝå: \\n';
$strLines = 'ÎØæØ';
$strLinesTerminatedBy = 'ÎØæØ ãÝÕæáå ÈÜ';
$strLocationTextfile = 'ãßÇä ãáÝ äÕí';
$strLogin = 'ÏÎæá';
$strLogout = 'ÊÓÌíá ÎÑæÌ';
$strLogPassword = 'ßáãÉ ÇáÓÑ:';
$strLogUsername = 'ÅÓã ÇáãõÓÊÎÏã:';

$strModifications = 'ÊãÊ ÇáÊÚÏíáÇÊ';
$strModify = 'ÊÚÏíá';
$strModifyIndexTopic = 'ÊÚÏíá ÇáÝåÑÓå';
$strMoveTable = 'äÞá ÌÏæá Åáì (ÞÇÚÏÉ ÈíÇäÇÊ<b>.</b>ÌÏæá):';
$strMoveTableOK = '%s ÌÏæá Êã äÞáå Åáì %s.';
$strMySQLReloaded = 'Êã ÅÚÇÏÉ ÊÍãíá MySQL ÈäÌÇÍ.';
$strMySQLSaid = 'MySQL ÞÇá: ';
$strMySQLServerProcess = 'MySQL %pma_s1%  Úáì ÇáãÒæÏ %pma_s2% -  ÇáãÓÊÎÏã : %pma_s3%';
$strMySQLShowProcess = 'ÚÑÖ ÇáÚãáíÇÊ';
$strMySQLShowStatus = 'ÚÑÖ ÍÇáÉ ÇáãÒæÏ MySQL';
$strMySQLShowVars ='ÚÑÖ ãÊÛíÑÇÊ ÇáãÒæÏ MySQL';

$strName = 'ÇáÅÓã';
$strNbRecords = 'ÚÏÏ ÇáÊÓÌíáÇÊ';
$strNext = 'ÇáÊÇáí';
$strNo = 'áÇ';
$strNoDatabases = 'áÇíæÌÏ ÞæÇÚÏ ÈíÇäÇÊ';
$strNoDropDatabases = 'ãÚØá "ÍÐÝ ÞÇÚÏÉ ÈíÇäÇÊ"ÇáÃãÑ ';
$strNoFrames = 'phpMyAdmin ÃßËÑ ÊÝåãÇð ãÚ ãÓÊÚÑÖ <b>ÇáÅØÇÑÇÊ</b>.';
$strNoIndex = 'ÝåÑÓ ÛíÑ ãÚÑÝ!';
$strNoIndexPartsDefined = 'ÅÌÒÇÁ ÇáÝåÑÓå ÛíÑ ãÚÑÝå!';
$strNoModification = 'áÇ ÊÛííÑÇÊ';
$strNone = 'áÇÔÆ';
$strNoPassword = 'áÇ ßáãÉ ÓÑ';
$strNoPrivileges = 'ÅãÊíÇÒ ÛíÑ ãæÌæÏ';
$strNoQuery = 'áíÓÊ ÅÓÊÚáÇã SQL!';
$strNoRights = 'áíÓ áÏíß ÇáÍÞæÞ ÇáßÇÝíå ÈÃä Êßæä åäÇ ÇáÂä!';
$strNoTablesFound = 'áÇíæÌÏ ÌÏÇæá ãÊæÝÑå Ýí ÞÇÚÏÉ ÇáÈíÇäÇÊ åÐå!.';
$strNotNumber = 'åÐÇ áíÓ ÑÞã!';
$strNotValidNumber = ' åÐÇ áíÓ ÚÏÏ ÕÝ ÕÍíÍ!';
$strNoUsersFound = 'ÇáãÓÊÎÏã(Üíä) áã íÊã ÅíÌÇÏåã.';
$strNull = 'ÎÇáí';

$strOftenQuotation = 'ÛÇáÈÇð ÚáÇãÇÊ ÇáÅÞÊÈÇÓ. ÅÎÊíÇÑí íÚäí ÈÃä ÇáÍÞæá  char æ varchar ÊÑÝÞ ÈÜ " ".';
$strOptimizeTable = 'ÖÛØ ÇáÌÏæá';
$strOptionalControls = 'ÅÎÊíÇÑí. ÇáÊÍßã Ýí ßíÝíÉ ßÊÇÈÉ Ãæ ÞÑÇÁÉ ÇáÃÍÑÝ Ãæ ÇáÌãá ÇáÎÇÕå.';
$strOptionally = 'ÅÎÊíÇÑí';
$strOr = 'Ãæ';
$strOverhead = 'ÇáÝæÞí';

$strPartialText = 'äÕæÕ ÌÒÆíå';
$strPassword = 'ßáãÉ ÇáÓÑ';
$strPasswordEmpty = 'ßáãÉ ÇáÓÑ ÝÇÑÛÉ !';
$strPasswordNotSame = 'ßáãÊÇ ÇáÓÑ ÛíÑ ãÊÔÇÈåÊÇä !';
$strPHPVersion = ' PHP ÅÕÏÇÑÉ';
$strPmaDocumentation = 'ãÓÊäÏÇÊ æËÇÆÞíå áÜ phpMyAdmin (ÈÇáÅäÌáíÒíÉ)';
$strPmaUriError = 'ÇáãÊÛíÑ <span dir="ltr"><tt>$cfgPmaAbsoluteUri</tt></span> íÌÈ ÊÚÏíáå Ýí ãáÝ ÇáßæÝíß !';
$strPos1 = 'ÈÏÇíÉ';
$strPrevious = 'ÓÇÈÞ';
$strPrimary = 'ÃÓÇÓí';
$strPrimaryKey = 'ãÝÊÇÍ ÃÓÇÓí';
$strPrimaryKeyHasBeenDropped = 'áÞÏ Êã ÍÐÝ ÇáãÝÊÇÍ ÇáÃÓÇÓí';
$strPrimaryKeyName = 'ÅÓã ÇáãÝÊÇÍ ÇáÃÓÇÓí íÌÈ Ãä íßæä ÃÓÇÓí... PRIMARY!';
$strPrimaryKeyWarning = '("ÇáÃÓÇÓí" <b>íÌÈ</b> íÌÈ Ãä íßæä ÇáÃÓã <b>æÃíÖÇð ÝÞØ</b> ÇáãÝÊÇÍ ÇáÃÓÇÓí!)';
$strPrintView = 'ÚÑÖ äÓÎÉ ááØÈÇÚÉ';
$strPrivileges = 'ÇáÅãÊíÇÒÇÊ';
$strProperties = 'ÎÕÇÆÕ';

$strQBE = 'ÅÓÊÚáÇã ÈæÇÓØÉ ãËÇá';
$strQBEDel = 'Del';
$strQBEIns = 'Ins';
$strQueryOnDb = 'Ýí ÞÇÚÏÉ ÇáÈíÇäÇÊ SQL-ÅÓÊÚáÇã <b>%s</b>:';

$strRecords = 'ÇáÊÓÌíáÇÊ';
$strReferentialIntegrity = 'ÊÍÏíÏ referential integrity:';
$strReloadFailed = ' ÅÚÇÏÉ ÊÍãíá ÎÇØÆåMySQL.';
$strReloadMySQL = 'ÅÚÇÏÉ ÊÍãíá MySQL';
$strRememberReload = 'ÊÐßíÑ áÅÚÇÏÉ ÊÍãíá ÇáÎÇÏã.';
$strRenameTable = 'ÊÛííÑ ÅÓã ÌÏæá Åáì';
$strRenameTableOK = 'Êã ÊÛííÑ ÅÓãåã Åáì %s  ÌÏæá%s';
$strRepairTable = 'ÅÕáÇÍ ÇáÌÏæá';
$strReplace = 'ÅÓÊÈÏÇá';
$strReplaceTable = 'ÅÓÊÈÏÇá ÈíÇäÇÊ ÇáÌÏæá ÈÇáãáÝ';
$strReset = 'ÅáÛÇÁ';
$strReType = 'ÃÚÏ ßÊÇÈå';
$strRevoke = 'ÅÈØÇá';
$strRevokeGrant = 'ÅÈØÇá Grant';
$strRevokeGrantMessage = 'áÞÏ ÃÈØáÊ ÅãÊíÇÒ Grant áÜ %s';
$strRevokeMessage = 'áÞÏ ÃÈØáÊ ÇáÃãÊíÇÒÇÊ áÜ %s';
$strRevokePriv = 'ÅÈØÇá ÅãÊíÇÒÇÊ';
$strRowLength = 'Øæá ÇáÕÝ';
$strRows = 'ÕÝæÝ';
$strRowsFrom = 'ÕÝæÝ ÊÈÏÃ ãä';
$strRowSize = ' ãÞÇÓ ÇáÕÝ ';
$strRowsModeHorizontal = 'ÃÝÞí';
$strRowsModeOptions = ' %s æ ÅÚÇÏÉ ÇáÑÄæÓ ÈÚÏ %s ÍÞá';
$strRowsModeVertical = 'ÚãæÏí';
$strRowsStatistic = 'ÅÍÕÇÆíÇÊ';
$strRunning = ' Úáì ÇáãÒæÏ %s';
$strRunQuery = 'ÅÑÓÇá ÇáÅÓÊÚáÇã';
$strRunSQLQuery = 'ÊäÝíÐ ÅÓÊÚáÇã/ÅÓÊÚáÇãÇÊ SQL Úáì ÞÇÚÏÉ ÈíÇäÇÊ %s';

$strSave = 'ÍÝÜÜÙ';
$strSelect = 'ÅÎÊíÇÑ';
$strSelectADb = 'ÅÎÊÑ ÞÇÚÏÉ ÈíÇäÇÊ ãä ÇáÞÇÆãÉ';
$strSelectAll = 'ÊÍÏíÏ Çáßá';
$strSelectFields = 'ÅÎÊíÇÑ ÍÞæá (Úáì ÇáÃÞá æÇÍÏ):';
$strSelectNumRows = 'Ýí ÇáÅÓÊÚáÇã';
$strSend = 'ÍÝÙ ßãáÝ';
$strServerChoice = 'ÅÎÊíÇÑ ÇáÎÇÏã';
$strServerVersion = 'ÅÕÏÇÑÉ ÇáãÒæÏ';
$strSetEnumVal = 'ÅÐÇ ßÇä äæÚ ÇáÍÞá åæ "enum" Ãæ "set", ÇáÑÌÇÁ ÅÏÎÇá ÇáÞíã ÈÅÓÊÎÏÇã åÐÇ ÇáÊäÓíÞ: \'a\',\'b\',\'c\'...<br />ÅÐÇ ßäÊ ÊÍÊÇÌ ÈÃä ÊÖÚ ÚáÇãÉ ÇáÔÑØå ÇáãÇÆáå ááíÓÇÑ ("\") Ãæ ÚáÇãÉ ÇáÅÞÊÈÇÓ ÇáÝÑÏíå ("\'") ÝíãÇ Èíä Êáß ÇáÞíã, ÅÌÚáåÇ ßÔÑØå ãÇÆáå ááíÓÇÑ (ãËáÇð \'\\\\xyz\' Ãæ \'a\\\'b\').';
$strShow = 'ÚÑÖ';
$strShowAll = 'ÔÇåÏ Çáßá';
$strShowCols = 'ÔÇåÏ ÇáÃÚãÏå';
$strShowingRecords = 'ãÔÇåÏÉ ÇáÓÌáÇÊ ';
$strShowPHPInfo = 'ÚÑÖ ÇáãÚáæãÇÊ ÇáãÊÚáÞÉ È  PHP';
$strShowTables = 'ÔÇåÏ ÇáÌÏæá';
$strShowThisQuery = ' ÚÑÖ åÐÇ ÇáÅÓÊÚáÇã åäÇ ãÑÉ ÃÎÑì ';
$strSingly = '(ÝÑÏí)';
$strSize = 'ÇáÍÌã';
$strSort = 'ÊÕäíÝ';
$strSpaceUsage = 'ÇáãÓÇÍÉ ÇáãÓÊÛáÉ';
$strSQLQuery = 'ÅÓÊÚáÇã-SQL';
$strStartingRecord = 'Ãæá ÊÓÌíá';
$strStatement = 'ÃæÇãÑ';
$strStrucCSV = 'ÈíÇäÇÊ CSV';
$strStrucData = 'ÇáÈäíÉ æÇáÈíÇäÇÊ';
$strStrucDrop = ' ÅÖÇÝÉ \'ÍÐÝ ÌÏæá ÅÐÇ ßÇä ãæÌæÏÇ\' Ýí ÇáÈÏÇíÉ';
$strStrucExcelCSV = 'ÈíÇäÇÊ CSV áÈÑäÇãÌ  Ms Excel';
$strStrucOnly = 'ÇáÈäíÉ ÝÞØ';
$strSubmit = 'ÅÑÓÇá';
$strSuccess = 'ÇáÎÇÕ Èß Êã ÊäÝíÐå ÈäÌÇÍ SQL-ÅÓÊÚáÇã';
$strSum = 'ÇáãÌãæÚ';

$strTable = 'ÇáÌÏæá ';
$strTableComments = 'ÊÚáíÞÇÊ Úáì ÇáÌÏæá';
$strTableEmpty = 'ÅÓã ÇáÌÏæá ÝÇÑÛ!';
$strTableHasBeenDropped = 'ÌÏæá %s ÍõÐÝÊ';
$strTableHasBeenEmptied = 'ÌÏæá %s ÃõÝÑÛÊ ãÍÊæíÇÊåÇ';
$strTableHasBeenFlushed = 'áÞÏ Êã ÅÚÇÏÉ ÊÍãíá ÇáÌÏæá %s  ÈäÌÇÍ';
$strTableMaintenance = 'ÕíÇäÉ ÇáÌÏæá';
$strTables = '%s  ÌÏæá (ÌÏÇæá)';
$strTableStructure = 'ÈäíÉ ÇáÌÏæá';
$strTableType = 'äæÚ ÇáÌÏæá';
$strTextAreaLength = ' ÈÓÈÈ Øæáå,<br /> Ýãä ÇáãÍÊãá Ãä åÐÇ ÇáÍÞá ÛíÑ ÞÇÈá ááÊÍÑíÑ ';
$strTheContent = 'áÞÏ Êã ÅÏÎÇá ãÍÊæíÇÊ ãáÝß.';
$strTheContents = 'áÞÏ Êã ÅÓÊÈÏÇá ãÍÊæíÇÊ ÇáÌÏæá ÇáãÍÏÏ ááÕÝæÝ ÈÇáãÝÊÇÍ ÇáããíÒ Ãæ ÇáÃÓÇÓí ÇáããÇËá áåãÇ ÈãÍÊæíÇÊ ÇáãáÝ.';
$strTheTerminator = 'ÝÇÕá ÇáÍÞæá.';
$strTotal = 'ÇáãÌãæÚ';
$strType = 'ÇáäæÚ';

$strUncheckAll = 'ÅáÛÇÁ ÊÍÏíÏ Çáßá';
$strUnique = 'ããíÒ';
$strUnselectAll = 'ÅáÛÇÁ ÊÍÏíÏ Çáßá';
$strUpdatePrivMessage = 'áÞÏ ÌÏÏÊ æÍÏËÊ ÇáÅãÊíÇÒÇÊ áÜ %s.';
$strUpdateProfile = 'ÊÌÏíÏ ÇáÚÑÖ ÇáÌÇäÈí:';
$strUpdateProfileMessage = 'áÞÏ Êã ÊÌÏíÏ ÇáÚÑÖ ÇáÌÇäÈí.';
$strUpdateQuery = 'ÊÌÏíÏ ÅÓÊÚáÇã';
$strUsage = 'ÇáãÓÇÍÉ';
$strUseBackquotes = 'ÍãÇíÉ ÃÓãÇÁ ÇáÌÏÇæá æ ÇáÍÞæá È "`" ';
$strUser = 'ÇáãÓÊÎÏã';
$strUserEmpty = 'ÅÓã ÇáãÓÊÎÏã ÝÇÑÛ!';
$strUserName = 'ÅÓã ÇáãÓÊÎÏã';
$strUsers = 'ÇáãÓÊÎÏãíä';
$strUseTables = 'ÅÓÊÎÏã ÇáÌÏæá';

$strValue = 'ÇáÞíãå';
$strViewDump = 'ÚÑÖ ÈäíÉ ÇáÌÏæá ';
$strViewDumpDB = 'ÚÑÖ ÈäíÉ ÞÇÚÏÉ ÇáÈíÇäÇÊ';

$strWelcome = 'ÃåáÇð Èß Ýí %s';
$strWithChecked = ': Úáì ÇáãÍÏÏ';
$strWrongUser = 'ÎØÃ ÅÓã ÇáãÓÊÎÏã/ßáãÉ ÇáÓÑ. ÇáÏÎæá ããäæÚ.';

$strYes = 'äÚã';

$strZip = '"zipped" "ãÖÛæØ"';

// To translate
$strCardinality = 'Cardinality';
?>