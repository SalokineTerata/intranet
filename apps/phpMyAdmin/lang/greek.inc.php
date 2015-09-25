<?php
/* $Id: greek.inc.php,v 1.47 2002/04/09 20:30:01 loic1 Exp $ */
/* Translated by Kyriakos Xagoraris <theremon at users.sourceforge.net> */

$charset = 'iso-8859-7';
$text_dir = 'ltr';
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'tahoma, verdana, helvetica, geneva, sans-serif';
$number_thousands_separator = '.';
$number_decimal_separator = ',';
$byteUnits = array('Bytes', 'KB', 'MB', 'GB');

$day_of_week = array('Êõñ', 'Äåõ', 'Ôñé', 'Ôåô', 'Ðåì', 'Ðáñ', 'Óáâ');
$month = array('Éáí', 'Öåâ', 'ÌÜñ', 'Áðñ', 'ÌÜé', 'Éïýí', 'Éïýë', 'Áõã', 'Óåð', 'Ïêô', 'Íïå', 'Äåê');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%d %B %Y, óôéò %I:%M %p';


$strAccessDenied = '\'Áñíçóç Ðñüóâáóçò';
$strAction = 'ÅíÝñãåéá';
$strAddDeleteColumn = 'ÐñïóèÞêç/Áöáßñåóç ÓôÞëçò Ðåäßïõ';
$strAddDeleteRow = 'ÐñïóèÞêç/Áöáßñåóç ÃñáììÞò Êñéôçñßùí';
$strAddNewField = 'ÐñïóèÞêç íÝïõ Ðåäßïõ';
$strAddPriv = 'ÐñïóèÞêç íÝïõ Ðñïíïìßïõ';
$strAddPrivMessage = 'ÐñïóèÝóáôå íÝï Ðñïíüìéï.';
$strAddSearchConditions = 'ÐñïóèÞêç íÝïõ üñïõ (óþìá ôçò "where" ðñüôáóçò):';
$strAddToIndex = 'ÐñïóèÞêç óôï åõñåôÞñéï &nbsp;%s&nbsp;êïëþíáò(ùí)';
$strAddUser = 'ÐñïóèÞêç íÝïõ ×ñÞóôç';
$strAddUserMessage = 'ÐñïóèÝóáôå Ýíá íÝï ÷ñÞóôç.';
$strAffectedRows = 'Åðçñåáæüìåíåò åããñáöÝò:';
$strAfter = 'ÌåôÜ ôï %s';
$strAfterInsertBack = 'ÅðéóôñïöÞ';
$strAfterInsertNewInsert = 'ÅéóáãùãÞ íÝáò åããñáöÞò';
$strAll = '¼ëá';
$strAlterOrderBy = 'ÁëëáãÞ ôáîéíüìçóçò Ðßíáêá êáôÜ';
$strAnalyzeTable = 'ÁíÜëõóç Ðßíáêá';
$strAnd = 'Êáé';
$strAnIndex = '¸íá åõñåôÞñéï ðñïóôÝèçêå óôï %s';
$strAny = 'ÏðïéïäÞðïôå';
$strAnyColumn = 'ÏðïéáäÞðïôå ÓôÞëç';
$strAnyDatabase = 'ÏðïéáäÞðïôå ÂÜóç';
$strAnyHost = 'ÏðïéïäÞðïôå Óýóôçìá';
$strAnyTable = 'ÏðïéïóäÞðïôå Ðßíáêáò';
$strAnyUser = 'ÏðïéïóäÞðïôå ×ñÞóôçò';
$strAPrimaryKey = '¸íá ðñùôåýïí êëåéäß ðñïóôÝèçêå óôï %s';
$strAscending = 'Áýîïõóá';
$strAtBeginningOfTable = 'Óôçí áñ÷Þ ôïõ Ðßíáêá';
$strAtEndOfTable = 'Óôï ôÝëïò ôïõ Ðßíáêá';
$strAttr = '×áñáêôçñéóôéêÜ';

$strBack = 'Ðßóù';
$strBinary = 'Äõáäéêü';
$strBinaryDoNotEdit = 'Äõáäéêü - ÷ùñßò äõíáôüôçôá åðåîåñãáóßáò';
$strBookmarkDeleted = 'Ç åôéêÝôá äéåãñÜöç.';
$strBookmarkLabel = 'ÅôéêÝôá';
$strBookmarkQuery = 'ÁðïèçêåõìÝíç åíôïëÞ SQL';
$strBookmarkThis = 'ÁðïèÞêåõóå áõôÞí ôçí åíôïëÞ SQL';
$strBookmarkView = 'Ìüíï áíÜãíùóç';
$strBrowse = 'ÐåñéÞãçóç';
$strBzip = 'óõìðßåóç «bzip»';

$strCantLoadMySQL = 'äåí ìðïñåß íá öïñôùèåß ç åðÝêôáóç MySQL,<br />ðáñáêáëþ åëÝãîôå ôçí ñýèìéóç ôçò PHP.';
$strCantRenameIdxToPrimary = 'Ç ìåôïíïìáóßá ôïõ åõñåôçñßïõ óå PRIMARY óå åßíáé åöéêôÞ!';
$strCardinality = 'Ìïíáäéêüôçôá';
$strCarriage = '×áñáêôÞñáò åðéóôñïöÞò: \\r';
$strChange = 'ÁëëáãÞ';
$strChangePassword = 'ÁëëáãÞ êùäéêïý ðñüóâáóçò';
$strCheckAll = '¸ëåã÷ïò üëùí';
$strCheckDbPriv = '¸ëåã÷ïò ðñïíïìßùí ÂÜóçò';
$strCheckTable = '¸ëåã÷ïò ðßíáêá';
$strColumn = 'ÓôÞëç';
$strColumnNames = 'Ïíüìáôá óôçëþí';
$strCompleteInserts = 'ÏëïêëçñùìÝíåò åéóáãùãÝò';
$strConfirm = 'ÐñáãìáôéêÜ èÝëåôå íá ôï åêôåëÝóåôå;';
$strCookiesRequired = 'Áðü áõôü ôï óçìåßï ðñÝðåé íá Ý÷åôå åíåñãïðïéçìÝíá cookies.';
$strCopyTable = 'ÁíôéãñáöÞ ðßíáêá óå (âÜóç<b>.</b>ðßíáêáò):';
$strCopyTableOK = 'Ï Ðßíáêáò %s áíôéãñÜöçêå óôï %s.';
$strCreate = 'Äçìéïõñãßá';
$strCreateIndex = 'Äçìéïõñãßá åõñåôçñßïõ óå &nbsp;%s&nbsp;ðåäßá';
$strCreateIndexTopic = 'Äçìéïõñãßá íÝïõ åõñåôçñßïõ';
$strCreateNewDatabase = 'Äçìéïõñãßá íÝáò âÜóçò';
$strCreateNewTable = 'Äçìéïõñãßá íÝïõ ðßíáêá óôç âÜóç %s';
$strCriteria = 'ÊñéôÞñéá';

$strData = 'ÄåäïìÝíá';
$strDatabase = 'ÂÜóç ';
$strDatabaseHasBeenDropped = 'Ç âÜóç äåäïìÝíùí %s äéåãñÜöç.';
$strDatabases = 'ÂÜóåéò';
$strDatabasesStats = 'ÓôáôéóôéêÜ âÜóçò';
$strDatabaseWildcard = 'ÂÜóç äåäïìÝíùí (åðéôñÝðïíôáé wildcards):';
$strDataOnly = 'Ìüíï äåäïìÝíá';
$strDefault = 'ÐñïêáèïñéóìÝíï';
$strDelete = 'ÄéáãñáöÞ';
$strDeleted = 'Ç ÅããñáöÞ Ý÷åé äéáãñáöåß';
$strDeletedRows = 'ÄéáãñáììÝíåò ÅããñáöÝò:';
$strDeleteFailed = 'Ç äéáãñáöÞ áðÝôõ÷å';
$strDeleteUserMessage = 'ÄéáãñÜøáôå ôïí ÷ñÞóôç %s.';
$strDescending = 'Öèßíïõóá';
$strDisplay = 'ÅìöÜíéóç';
$strDisplayOrder = 'ÓåéñÜ åìöÜíéóçò:';
$strDoAQuery = 'ÅêôÝëåóå ìßá «åíôïëÞ êáôÜ ðáñÜäåéãìá» (÷áñáêôÞñáò ìðáëáíôÝñ "%")';
$strDocu = 'Ôåêìçñßùóç';
$strDoYouReally = 'ÈÝëåôå ðñáãìáôéêÜ íá ';
$strDrop = 'ÄéáãñáöÞ';
$strDropDB = 'ÄéáãñáöÞ âÜóçò %s';
$strDropTable = 'ÄéáãñáöÞ ðßíáêá';
$strDumpingData = '\'Áäåéáóìá äåäïìÝíùí ôïõ ðßíáêá';
$strDynamic = 'äõíáìéêÜ';

$strEdit = 'Åðåîåñãáóßá';
$strEditPrivileges = 'Åðåîåñãáóßá Ðñïíïìßùí';
$strEffective = 'Áðïôåëåóìáôéêüò';
$strEmpty = '\'Áäåéáóìá';
$strEmptyResultSet = 'Ç MySQL åðÝóôñåøå Ýíá Üäåéï óýíïëï áðïôåëåóìÜôùí (ð.÷. êáììßá åããñáöÞ).';
$strEnd = 'ÔÝëïò';
$strEnglishPrivileges = ' Óçìåßùóç: Ôá ïíüìáôá ðñïíïìßùí ôçò MySQL åêöñÜæïíôáé óôá ÁããëéêÜ ';
$strError = 'ëÜèïò';
$strExtendedInserts = 'ÅêôåôáìÝíåò åéóáãùãÝò';
$strExtra = 'Ðñüóèåôá';

$strField = 'Ðåäßï';
$strFieldHasBeenDropped = 'Ôï ðåäßï %s äéåãñÜöç';
$strFields = 'Ðåäßá';
$strFieldsEmpty = ' Ç áðáñßèìçóç ôùí ðåäßùí åßíáé êåíÞ! ';
$strFieldsEnclosedBy = 'Ðåäßá ðïõ ðåñéêëåßïíôáé óå';
$strFieldsEscapedBy = 'Ôá ðåäßá ÷ñçóéìïðïéïýí ôï ÷áñáêôÞñá äéáöõãÞò ';
$strFieldsTerminatedBy = 'Ðåäßá ðïõ ôåëåéþíïõí óå';
$strFixed = 'ðñïêáèïñéóìÝíïõ ìÞêïõò';
$strFlushTable = 'ÅêêáèÜñéóç ("FLUSH") ðßíáêá';
$strFormat = 'Ìïñöïðïßçóç';
$strFormEmpty = 'ÅëëåéðÞò ôéìÞ óôï ðåäßï !';
$strFullText = 'ÐëÞñç êåßìåíá';
$strFunction = 'Ëåéôïõñãßá';

$strGenTime = '×ñüíïò äçìéïõñãßáò';
$strGo = 'ÅêôÝëåóç';
$strGrants = 'Ðáñá÷ùñåß';
$strGzip = 'óõìðßåóç «gzip»';

$strHasBeenAltered = 'Ý÷åé áëëá÷èåß.';
$strHasBeenCreated = 'Ý÷åé äçìéïõñãçèåß.';
$strHome = 'ÊåíôñéêÞ óåëßäá';
$strHomepageOfficial = 'Åðßóçìç óåëßäá ôïõ phpMyAdmin';
$strHomepageSourceforge = 'Óåëßäá ôïõ Sourceforge ãéá ôçí áðüêôçóç ôïõ phpMyAdmin';
$strHost = 'Óýóôçìá';
$strHostEmpty = 'Ôï üíïìá ôïõ ÓõóôÞìáôïò åßíáé êåíü!';

$strIdxFulltext = 'ÐëÞñåò êåßìåíï';
$strIfYouWish = 'Áí åíäéáöÝñåóôå íá öïñôþóåôå ìüíï ìåñéêÝò áðï ôéò óôÞëåò ôïõ ðßíáêá, êáèïñßóôå ìßá ëßóôá ðåäßùí äéá÷ùñéóìÝíá ìå êüììá.';
$strIgnore = 'ÐáñÜëçøç';
$strIndex = 'ÅõñåôÞñéï';
$strIndexes = 'ÅõñåôÞñéá';
$strIndexHasBeenDropped = 'Ôï åõñåôÞñéï %s äéåãñÜöç';
$strIndexName = '¼íïìá åõñåôçñßïõ&nbsp;:';
$strIndexType = 'Ôýðïò åõñåôçñßïõ&nbsp;:';
$strInsert = 'ÅéóáãùãÞ';
$strInsertAsNewRow = 'ÅéóáãùãÞ ùò íÝá åããñáöÝò';
$strInsertedRows = 'Åéóáãüìåíåò åããñáöÝò:';
$strInsertNewRow = 'ÅéóáãùãÞ íÝáò åããñáöÞò';
$strInsertTextfiles = 'ÅéóáãùãÞ áñ÷åßïõ êåéìÝíïõ óôïí ðßíáêá';
$strInstructions = 'Ïäçãßåò';
$strInUse = 'óå ÷ñÞóç';
$strInvalidName = 'Ç «%s» åßíáé äåóìåõìÝíç ëÝîç, äåí ìðïñåßôå íá ôçí ÷ñçóéìïðïéÞóåôå ùò üíïìá ãéá ÂÜóç, Ðßíáêá Þ Ðåäßï.';

$strKeepPass = 'ÄéáôÞñçóç êùäéêïý ðñüóâáóçò';
$strKeyname = '¼íïìá êëåéäéïý';
$strKill = 'ÔåñìÜôéóå';

$strLength = 'ÌÞêïò';
$strLengthSet = 'ÌÞêïò/ÔéìÝò*';
$strLimitNumRows = 'êáôá÷þñçóç áíÜ óåëßäá';
$strLineFeed = '×áñáêôÞñáò ðñïþèçóçò ãñáììÞò: \\n';
$strLines = 'ÃñáììÝò';
$strLinesTerminatedBy = 'ÃñáììÝò ðïõ ôåëåéþíïõí óå';
$strLocationTextfile = 'Ôïðïèåóßá ôïõ áñ÷åßïõ êåéìÝíïõ';
$strLogin = 'Óýíäåóç';
$strLogout = 'Áðïóýíäåóç';
$strLogPassword = 'Êùäéêüò ðñüóâáóçò:';
$strLogUsername = '¼íïìá ÷ñÞóôç:';

$strModifications = 'Ïé áëëáãÝò áðïèçêåýôçêáí';
$strModify = 'Ôñïðïðïßçóç';
$strModifyIndexTopic = 'ÁëëáãÞ åíüò åõñåôçñßïõ';
$strMoveTable = 'ÌåôáöïñÜ ðßíáêá óå (âÜóç<b>.</b>ðßíáêáò):';
$strMoveTableOK = 'Ï ðßíáêáò %s ìåôáöÝñèçêå óôï %s.';
$strMySQLReloaded = 'Ç MySQL åðáíáöïñôþèçêå.';
$strMySQLSaid = 'Ç MySQL åðÝóôñåøå ôï ìýíçìá: ';
$strMySQLServerProcess = 'Ç MySQL %pma_s1% åêôåëåßôáé óå %pma_s2% ùò %pma_s3%';
$strMySQLShowProcess = 'ÅìöÜíéóç äéåñãáóéþí';
$strMySQLShowStatus = 'ÅìöÜíéóç ðëçñïöïñþí åêôÝëåóçò ôçò MySQL';
$strMySQLShowVars = 'ÅìöÜíéóç ìåôáâëçôþí ôçò MySQL';

$strName = '¼íïìá';
$strNbRecords = 'Áñéèìüò Åããñáöþí';
$strNext = 'Åðüìåíï';
$strNo = '¼÷é';
$strNoDatabases = 'Äåí õðÜñ÷ïõí âÜóåéò äåäïìÝíùí';
$strNoDropDatabases = 'Ïé åíôïëÝò «DROP DATABASE» Ý÷ïõí áðåíåñãïðïéçèåß.';
$strNoFrames = 'Ôï phpMyAdmin åßíáé ðéï öéëéêü ìå Ýíáí browser <b>ðïõ õðïóôçñßæåé frames</b>.';
$strNoIndex = 'Äåí ïñßóôçêå åõñåôÞñéï!';
$strNoIndexPartsDefined = 'Äåí ïñßóôçêáí ôá óôïé÷åßá ôïõ åõñåôçñßïõ!';
$strNoModification = '×ùñßò áëëáãÞ';
$strNone = 'ÊáíÝíá';
$strNoPassword = '×ùñßò Êùäéêü Ðñüóâáóçò';
$strNoPrivileges = '×ùñßò Ðñïíüìéá';
$strNoQuery = 'Äåí õðÜñ÷åé åíôïëÞ SQL!';
$strNoRights = 'Äåí Ý÷åôå áñêåôÜ äéêáéþìáôá íá åßóáóôå åäþ ôþñá!';
$strNoTablesFound = 'Äåí âñÝèçêáí Ðßíáêåò óôç âÜóç.';
$strNotNumber = 'Áõôü äåí åßíáé áñéèìüò!';
$strNotValidNumber = ' äåí åßíáé õðáñêôüò áñéèìüò ÅããñáöÞò!';
$strNoUsersFound = 'Äåí âñÝèçêáí ÷ñÞóôåò.';
$strNull = 'Êåíü';

$strOftenQuotation = 'Óõ÷íÜ åéóáãùãéêÜ. Ôï OPTIONALLY óçìáßíåé üôé ìüíï ôá ðåäßá char êáé varchar åìðåñéÝ÷ïíôáé ìå ôïí ÷áñáêôÞñá «ðåñéóôïé÷ßæåôáé áðü».';
$strOptimizeTable = 'Âåëôéóôïðïßçóç Ðßíáêá';
$strOptionalControls = 'Ðñïåñáéôéêü. Ñõèìßæåé ðþò íá ãßíåôáé ç áíÜãíùóç êáé ç åããñáöÞ åéäéêþí ÷áñáêôÞñùí.';
$strOptionally = 'ÐÑÏÁÉÑÅÔÉÊÁ';
$strOr = '¹';
$strOverhead = 'ÅðéâÜñõíóç';

$strPartialText = 'ÅðéìÝñïõò êåßìåíá';
$strPassword = 'Êùäéêüò Ðñüóâáóçò';
$strPasswordEmpty = 'Ï Êùäéêüò Ðñüóâáóçò åßíáé êåíüò!';
$strPasswordNotSame = 'Ïé êùäéêïß ðñüóâáóçò äåí åßíáé ßäéïé!';
$strPHPVersion = '¸êäïóç PHP';
$strPmaDocumentation = 'Ôåêìçñßùóç phpMyAdmin';
$strPmaUriError = 'Ç åíôïëÞ <tt>$cfgPmaAbsoluteUri</tt> ÐÑÅÐÅÉ íá ïñéóôåß óôï áñ÷åßï ðñïåðéëïãþí!';
$strPos1 = 'Áñ÷Þ';
$strPrevious = 'Ðñïçãïýìåíï';
$strPrimary = 'Ðñùôåýïí';
$strPrimaryKey = 'Ðñùôåýïí êëåéäß';
$strPrimaryKeyHasBeenDropped = 'Ôï ðñùôåýïí êëåéäß äéåãñÜöç';
$strPrimaryKeyName = 'Ôï üíïìá ôïõ ðñùôåýïíôïò êëåéäéïý ðñÝðåé íá åßíáé... PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>ðñÝðåé</b> íá åßíáé ôï üíïìá ôïõ ðñùôåýïíôïò êëåéäéïý êáé <b>ìüíï áõôïý</b> !)';
$strPrintView = 'ÅìöÜíéóç ãéá åêôýðùóç';
$strPrivileges = 'Ðñïíüìéá';
$strProperties = 'Éäéüôçôåò';

$strQBE = 'ÅíôïëÞ êáôÜ ðáñÜäåéãìá';
$strQBEDel = 'ÄéáãñáöÞ';
$strQBEIns = 'ÅéóáãùãÞ';
$strQueryOnDb = 'ÅíôïëÞ SQL óôç âÜóç <b>%s</b>:';

$strRecords = 'ÅããñáöÝò';
$strReferentialIntegrity = '¸ëåã÷ïò áêåñáéüôçôáò ó÷Ýóåùí:';
$strReloadFailed = 'Ç åðáíåêßíçóç ôçò MySQL áðÝôõ÷å.';
$strReloadMySQL = 'Åðáíåêßíçóç ôçò MySQL';
$strRememberReload = 'Åíèýìéóç ôçò åðáíåêßíçóçò ôïõ äéáêïìéóôÞ.';
$strRenameTable = 'Ìåôïíïìáóßá ðßíáêá óå';
$strRenameTableOK = 'Ï Ðßíáêáò %s ìåôïíïìÜóèçêå óå %s';
$strRepairTable = 'Åðéäéüñèùóç ðßíáêá';
$strReplace = 'ÁíôéêáôÜóôáóç';
$strReplaceTable = 'ÁíôéêáôÜóôáóç äåäïìÝíùí Ðßíáêá ìå ôï áñ÷åßï';
$strReset = 'ÅðáíáöïñÜ';
$strReType = 'ÅðáíáåéóáãùãÞ';
$strRevoke = 'ÁíÜêëçóç';
$strRevokeGrant = 'ÁíÜêëçóç Ðáñá÷þñéóçò';
$strRevokeGrantMessage = 'ÁíáêáëÝóáôå ôá ðñïíüìéá Ðáñá÷þñéóçò ôïõ %s';
$strRevokeMessage = 'ÁíáêáëÝóáôå ôá ðñïíüìéá ãéá %s';
$strRevokePriv = 'ÁíÜêëçóç ðñïíïìïßùí';
$strRowLength = 'ÌÝãåèïò ÃñáììÞò';
$strRows = 'ÅããñáöÝò';
$strRowsFrom = 'ÅããñáöÝò ðïõ áñ÷ßæïõí áðü';
$strRowSize = ' ÌÝãåèïò ÅããñáöÞò ';
$strRowsModeHorizontal = 'ïñéæüíôéá';
$strRowsModeOptions = 'óå %s ìïñöÞ ìå åðáíÜëçøç åðéêåöáëßäùí áíÜ %s êåëéÜ';
$strRowsModeVertical = 'êÜèåôç';
$strRowsStatistic = 'ÓôáôéóôéêÜ Åããñáöþí';
$strRunning = 'ðïõ ôñÝ÷åé óôï %s';
$strRunQuery = 'ÕðïâïëÞ åðåñþôçóçò';
$strRunSQLQuery = '¸êôÝëåóç åíôïëÞò/åíôïëþí SQL óôç âÜóç äåäïìÝíùí %s';

$strSave = 'ÁðïèÞêåõóç';
$strSelect = 'ÅðéëïãÞ';
$strSelectADb = 'Ðáñáêáëþ åðéëÝîôå ìßá âÜóç äåäïìÝíùí';
$strSelectAll = 'ÅðéëïãÞ üëùí';
$strSelectFields = 'ÅðéëïãÞ ðåäßùí (ôïõëÜ÷éóôïí Ýíá):';
$strSelectNumRows = 'óôçí åíôïëÞ';
$strSend = 'ÁðïóôïëÞ';
$strServerChoice = 'ÅðéëïãÞ ÄéáêïìéóôÞ';
$strServerVersion = '¸êäïóç ÄéáêïìéóôÞ';
$strSetEnumVal = 'Áí ï ôýðïò ôïõ ðåäßïõ åßíáé «enum» Þ «set», ðáñáêáëþ åéóÜãåôå ôéò ôéìÝò ÷ñçóéìïðïéþíôáò ôçí åîÞò ìïñöïðïßçóç: \'á\',\'â\',\'ã\'...<br /> Áí ÷ñåéÜæåôáé íá åéóÜãåôå ôçí áíÜðïäç êÜèåôï ("\") Þ áðëÜ åéóáãùãéêÜ ("\'"), ðñïèÝóôå ôá ìå áíÜðïäç êÜèåôï óôçí áñ÷Þ (ãéá ðáñÜäåéãìá \'\\\\÷øù\' Þ \'á\\\'â\').';
$strShow = 'ÅìöÜíéóç';
$strShowAll = 'ÅìöÜíéóç üëùí';
$strShowCols = 'ÅìöÜíéóç óôçëþí';
$strShowingRecords = 'ÅìöÜíéóç åããñáöÞò ';
$strShowPHPInfo = 'ÅìöÜíéóç ðëçñïöïñßáò PHP';
$strShowTables = 'ÅìöÜíéóç ðéíÜêùí';
$strShowThisQuery = ' ÅìöÜíéóå åäþ îáíÜ áõôÞí ôçí åíôïëÞ ';
$strSingly = '(ìïíáäéêÜ)';
$strSize = 'ÌÝãåèïò';
$strSort = 'Ôáîéíüìéóç';
$strSpaceUsage = '×ñÞóç ÷þñïõ';
$strSQLQuery = 'ÅíôïëÞ SQL';
$strStartingRecord = 'Áñ÷éêÞ åããñáöÞ';
$strStatement = 'Äçëþóåéò';
$strStrucCSV = 'ÄåäïìÝíá CSV';
$strStrucData = 'ÄïìÞ êáé äåäïìÝíá';
$strStrucDrop = 'ÐñïóèÞêç «drop table»';
$strStrucExcelCSV = 'ÌïñöÞ CSV ãéá äåäïìÝíá Ms Excel';
$strStrucOnly = 'Ìüíï ç äïìÞ';
$strSubmit = 'ÁðïóôïëÞ';
$strSuccess = 'Ç SQL åíôïëÞ óáò åêôåëÝóèçêå åðéôõ÷þò';
$strSum = 'Óýíïëï';

$strTable = 'Ðßíáêáò ';
$strTableComments = 'Ó÷üëéá Ðßíáêá';
$strTableEmpty = 'Ôï üíïìá ôïõ Ðßíáêá åßíáé êåíü!';
$strTableHasBeenDropped = 'Ï Ðßíáêáò %s äéåãñÜöç';
$strTableHasBeenEmptied = 'Ï Ðßíáêáò %s Üäåéáóå';
$strTableHasBeenFlushed = 'Ï Ðßíáêáò %s åêêáèáñßóôéêå ("FLUSH")';
$strTableMaintenance = 'ÓõíôÞñçóç Ðßíáêá';
$strTables = '%s Ðßíáêáò/Ðßíáêåò';
$strTableStructure = 'ÄïìÞ Ðßíáêá ãéá ôïí Ðßíáêá';
$strTableType = 'Ôýðïò Ðßíáêá';
$strTextAreaLength = ' Åîáéôßáò ôïõ ìåãÝèïò ôïõ,<br /> áõôü ôï ðåäßï ìðïñåß íá ìç ìðïñåß íá äéïñèùèåß ';
$strTheContent = 'Ôá ðåñéå÷üìåíá ôïõ áñ÷åßïõ óáò Ý÷ïõí åéóáã÷èåß.';
$strTheContents = 'Ôá ðåñéå÷üìåíá ôïõ áñ÷åßïõ áíôéêáèéóôïýí ôá ðåñéå÷üìåíá ôïõ åðéëåãìÝíïõ ðßíáêá ãéá ÃñáììÝò ìå ßäéï ðñùôåýïí Þ ìïíáäéêü êëåéäß.';
$strTheTerminator = 'Ï ôåñìáôéêüò ÷áñáêôÞñáò ôùí ðåäßùí.';
$strTotal = 'óõíïëéêÜ';
$strType = 'Ôýðïò';

$strUncheckAll = 'ÁðåðéëïãÞ üëùí';
$strUnique = 'Ìïíáäéêü';
$strUnselectAll = 'ÁðåðéëïãÞ üëùí';
$strUpdatePrivMessage = 'Ôá ðñïíüìéá ôïõ ÷ñÞóôç %s åíçìåñþèçêáí.';
$strUpdateProfile = 'ÅíçìÝñùóç óôïé÷åßùí:';
$strUpdateProfileMessage = 'Ôá óôïé÷åßá áíáíåþèçêáí.';
$strUpdateQuery = 'ÅíçìÝñùóç ôçò åíôïëÞò';
$strUsage = '×ñÞóç';
$strUseBackquotes = '×ñçóéìïðïéÞóôå áíÜðïäá åéóáãùãéêÜ ìå ôá ïíüìáôá ôùí ÐéíÜêùí êáé ôùí Ðåäßùí';
$strUser = '×ñÞóôçò';
$strUserEmpty = 'Ôï üíïìá ôïõ ÷ñÞóôç åßíáé êåíü!';
$strUserName = '¼íïìá ÷ñÞóôç';
$strUsers = '×ñÞóôåò';
$strUseTables = '×ñÞóç ÐéíÜêùí';

$strValue = 'ÔéìÞ';
$strViewDump = 'ÅìöÜíéóç (schema) ôïõ ðßíáêá';
$strViewDumpDB = 'ÅìöÜíéóç (schema) ôçò âÜóçò';

$strWelcome = 'ÊáëùóÞñèáôå óôï %s';
$strWithChecked = 'Ìå åðéëïãÞ:';
$strWrongUser = 'ËáíèáóìÝíï üíïìá ÷ñÞóôç/êùäéêüò ðñüóâáóçò. \'Áñíçóç ðñüóâáóçò.';

$strYes = 'Íáé';

$strZip = 'óõìðßåóç «zip»';

// To translate
?>
