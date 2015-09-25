<?php
/* $Id: georgian.inc.php,v 1.2 2002/04/19 21:42:39 loic1 Exp $ */

/**
 * Translation by Lasha Altunashvili <lasha_al at hotmail.com>
 *
 * It requires some special font faces that can downloaded at
 * http://www.geo-win.com/
 */

$charset = 'x-user-defined';
$text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = '"Geo_Arial", "Geo_Times", sans-serif';
$right_font_family = '"Geo_Arial", "Geo_Times", sans-serif';
$number_thousands_separator = ' ';
$number_decimal_separator = ',';
$byteUnits = array('ÁÀÉÔÉ', 'KB', 'MB', 'GB');

$day_of_week = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
$month = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%B %d, %Y at %I:%M %p';


$strAccessDenied = 'ÀÊÒÞÀËÖËÉÀ';
$strAction = 'ÌÏØÌÄÃÄÁÀ';
$strAddNewField = 'ÀáÀËÉ ÅÄËÉÓ ÃÀÌÀÔÄÁÀ.';
$strAddPriv = 'ÀáÀËÉ ÐÒÉÅÉËÄÂÉÉÓ ÃÀÌÀÔÄÁÀ.';
$strAddPrivMessage = 'ÈØÅÄÍ ÃÀÀÌÀÔÄÈ ÀáÀËÉ ÐÒÉÅÉËÄÂÉÀ.';
$strAddSearchConditions = 'ÞÄÁÍÉÓ ÐÀÒÀÌÄÔÒÄÁÉÓ ÃÀÌÀÔÄÁÀ ("where" ÍÀßÉËÉÓ ÔÀÍÉ):';
$strAddUser = 'ÀáÀËÉ ÌÏÌáÌÀÒÄÁËÉÓ ÃÀÌÀÔÄÁÀ.';
$strAddUserMessage = 'ÈØÅÄÍ ÃÀÀÌÀÔÄÈ ÀáÀËÉ ÌÏÌáÌÀÒÄÁÄËÉ.';
$strAll = 'ÚÅÄËÀ';
$strAlterOrderBy = 'ÛÄÝÅËÉËÉ ÝáÒÉËÉ ÓÏÒÔÉÒÄÁÖËÉ';
$strAnalyzeTable = 'ÝáÒÉËÉÓ ÀÍÀËÉÆÉ';
$strAnd = 'ÃÀ';
$strAnIndex = 'ÉÍÃÄØÓÉ ÃÀÌÀÔÄÁÖËÉÀ ÅÄËÆÄ %s';
$strAny = 'ÍÄÁÉÓÌÉÄÒÉ.';
$strAnyColumn = 'ÍÄÁÉÓÌÉÄÒÉ ÓÅÄÔÉ';
$strAnyDatabase = 'ÍÄÁÉÓÌÉÄÒÉ ÌÏÍÀÝÄÌÈÀ ÁÀÆÀ';
$strAnyHost = 'ÍÄÁÉÓÌÉÄÒÉ äÏÓÔÉ';
$strAnyTable = 'ÍÄÁÉÓÌÉÄÒÉ ÝáÒÉËÉ';
$strAnyUser = 'ÍÄÁÉÓÌÉÄÒÉ ÌÏÌáÌÀÒÄÁÄËÉ';
$strAPrimaryKey = 'ÐÉÒÅÄËÀÃÉ ÂÀÓÀÙÄÁÉ ÃÀÌÀÔÄÁÖËÉÀ ÅÄËÆÄ %s';
$strAtBeginningOfTable = 'ÝáÒÉËÉÓ ÃÀÓÀßÚÉÓÛÉ';
$strAtEndOfTable = 'ÝáÒÉËÉÓ ÃÀÓÀÓÒÖËÛÉ';
$strAttr = 'ÀÔÒÉÁÖÔÄÁÉ';

$strBack = 'ÖÊÀÍ';
$strBookmarkLabel = 'àÃÄ';
$strBookmarkView = 'ÌáÏËÏÃ ÃÀÈÅÀËÉÄÒÄÁÀ';
$strBrowse = 'ÍÀáÅÀ';

$strCarriage = 'ÊÖÒÓÏÒÉÓ ÂÀÃÀÔÀÍÀ: \\r';
$strChange = 'ÛÄÝÅËÀ';
$strCheckAll = 'ÌÏÍÉÛÍÄ ÚÅÄËÀ';
$strCheckDbPriv = 'ÛÄÀÌÏßÌÄÈ ÌÏÍÀÝÄÌÈÀ ÁÀÆÉÓ ÐÒÉÅÉËÄÂÉÄÁÉ';
$strCheckTable = 'ÝáÒÉËÉÓ ÛÄÌÏßÌÄÁÀ';
$strColumn = 'ÓÅÄÔÉ';
$strColumnNames = 'ÓÅÄÔÉÓ ÓÀáÄËÄÁÉ';
$strConfirm = 'ÈØÅÄÍ ÃÀÒßÌÖÍÄÁÖËÉ áÀÒÈ ÒÏÌ ÂÉÍÃÀÈ ÀÌÉÓ ÂÀÊÄÈÄÁÀ?';
$strCopyTableOK = 'ÝáÒÉËÉ %s ÊÏÐÉÒÄÁÖËÉÀ %s ÝáÒÉËÛÉ.';
$strCreate = 'ÛÄØÌÍÀ';
$strCreateNewDatabase = 'ÀáÀËÉ ÌÏÍÀÝÄÌÈÀ ÁÀÆÉÓ ÛÄØÌÍÀ';
$strCreateNewTable = 'ÌÏÍÀÝÄÌÈÀ ÁÀÆÀÛÉ ÀáÀËÉ ÝáÒÉËÉÓ ÛÄØÌÍÀ %s';

$strData = 'ÌÏÍÀÝÄÌÄÁÉ';
$strDatabase = 'ÌÏÍÀÝÄÌÈÀ ÁÀÆÀ ';
$strDatabases = 'ÁÀÆÄÁÉ';
$strDataOnly = 'ÌáÏËÏÃ ÌÏÍÀÝÄÌÄÁÉ';
$strDefault = 'ÀÅÔÏ ÌÍÉÛÅÍÄËÏÁÀ';
$strDelete = 'ßÀÛËÀ';
$strDeleted = 'ÜÀÍÀßÄÒÉ ßÀÉÛÀËÀ';
$strDeleteFailed = 'ßÀÛËÉËÉ ÅÄËÉ!';
$strDeleteUserMessage = 'ÈØÅÄÍ ßÀÛÀËÄÈ ÌÏÌáÌÀÒÄÁÄËÉ %s.';
$strDisplay = 'ÀÜÅÄÍÄ';
$strDoAQuery = 'ÛÄÀÓÒÖËÄ "ÌÏÈáÏÅÍÀ ÌÀÂÀËÉÈÉÓ ÌÏáÄÃÅÉÈ" (ÍÄÁÉÓÌÉÄÒÉ ÓÉÌÁÏËÏÓ ÀÙÌÍÉÛÅÍÄËÉÀ: "%")';
$strDocu = 'ÃÏÊÖÌÄÍÔÀÝÉÀ';
$strDoYouReally = 'ÃÀÒßÌÖÍÄÁÖËÉ áÀÒÈ, ÒÏÌ ÂÉÍÃÀÈ ';
$strDrop = 'ßÀÛËÀ';
$strDropDB = 'ßÀÛÀËÄ ÌÏÍÀÝÄÌÈÀ ÁÀÆÀ %s';
$strDumpingData = 'ÌÏÍÀÝÄÌÄÁÉ ÝáÒÉËÉÃÀÍ ';
$strDynamic = 'ÃÉÍÀÌÉÖÒÉ';

$strEdit = 'ÛÄÓßÏÒÄÁÀ';
$strEditPrivileges = 'ÐÒÉÅÉËÄÂÉÄÁÉÓ ÒÄÃÀØÔÉÒÄÁÀ';
$strEffective = 'Effective';
$strEmpty = 'ÝÀÒÉÄËÉ';
$strEmptyResultSet = 'MySQL-ÉÓ ÌÉÄÒ ÃÀÀÁÒÖÍÄÁÖËÉ ÜÀÍÀßÄÒÄÁÉÓ ÒÀÏÃÄÍÏÁÀÀ 0.';
$strEnd = 'ÃÀÓÀÓÒÖËÉ';
$strError = 'ÛÄÝÃÏÌÀ';
$strExtra = 'ÓáÅÀ';

$strField = 'ÅÄËÉ';
$strFields = 'ÅÄËÄÁÉ';
$strFixed = 'ÂÀÌÀÒÈÖËÉÀ';
$strFormat = '×ÏÒÌÀÔÉ';
$strFunction = '×ÖÍØÝÉÀ';

$strGenTime = 'ÂÄÍÄÒÉÒÄÁÉÓ ÃÒÏ';
$strGo = 'ÛÄÓÒÖËÄÁÀ';

$strHasBeenAltered = 'ÛÄÉÝÅÀËÀ.';
$strHasBeenCreated = 'ÛÄÉØÌÍÀ.';
$strHome = 'ÃÀÓÀßÚÉÓÉ';
$strHost = 'äÏÓÔÉ';
$strHostEmpty = 'äÏÓÔÉÓ ÓÀáÄËÉ ÝÀÒÉÄËÉÀ!';

$strIfYouWish = 'ÈÖ ÈØÅÄÍ ÌáÏËÏÃ ÒÀÌÏÃÄÍÉÌÄ ÓÅÄÔÉÓ ÌÏÍÀÝÄÌÄÁÉÓ ÜÀÔÅÉÒÈÅÀ, ÌÉÖÈÉÈÄÈ ÌÞÉÌÄÄÁÉÈ ÂÀÌÏÚÏ×ÉËÉ ÅÄËÄÁÉÓ ÜÀÌÏÍÀÈÅÀËÉ.';
$strIndex = 'ÉÍÃÄØÓÉÒÄÁÀ';
$strIndexes = 'ÉÍÃÄØÓÄÁÉ';
$strInsert = 'ÃÀÌÀÔÄÁÀ';
$strInsertAsNewRow = 'ÃÀÌÀÔÄÁÀ ÀáÀË ÜÀÍÀßÄÒÀÃ';
$strInsertNewRow = 'ÃÀÀÌÀÔÄ ÀáÀËÉ ÜÀÍÀßÄÒÉ';

$strKeyname = 'Keyname';
$strKill = 'Kill';

$strLength = 'ÓÉÂÒÞÄ';
$strLineFeed = 'ÀáÀËÉ áÀÆÉ: \\n';
$strLines = 'ÓÔÒÉØÏÍÄÁÉ(ÜÀÍÀßÄÒÄÁÉ) ';
$strLocationTextfile = 'ÌÉÖÈÉÈÄÈ ÔÄØÓÔÖÒÉ ×ÀÉËÉÓ ÌÃÄÁÀÒÄÏÁÀ';

$strModifications = 'ÝÅËÉËÄÁÄÁÉ ÛÄÍÀáÖËÉÀ';
$strMySQLSaid = 'MySQL-ÌÀ ÈØÅÀ: ';
$strMySQLShowProcess = 'ÐÒÏÝÄÓÄÁÉÓ ÛÅÄÍÄÁÀ';
$strMySQLShowStatus = 'MySQL ÌÏÍÀÝÄÌÈÀ ÁÀÆÉÓ ÌÃÂÏÌÀÒÄÏÁÉÓ ÜÅÄÍÄÁÀ';
$strMySQLShowVars = 'MySQL ÌÏÍÀÝÄÌÈÀ ÁÀÆÉÓ ÓÉÓÔÄÌÖÒÉ ÝÅËÀÃÄÁÉ';

$strName = 'ÓÀáÄËÉ';
$strNext = 'ÛÄÌÃÄÂÉ';
$strNo = 'ÀÒÀ';
$strNoPassword = 'ÀÒ ÀÒÉÓ ÐÀÒÉËÉ';
$strNoPrivileges = 'ÀÒ ÀÒÉÓ ÐÒÉÅÉËÄÂÉÄÁÉ';
$strNoTablesFound = 'ÌÏÍÀÝÄÌÈÀ ÁÀÆÀ ÀÒ ÛÄÉÝÀÅÓ ÝáÒÉËÄÁÓ.';
$strNoUsersFound = 'ÌÏÌáÌÀÒÄÁÄËÉ ÀÒ ÀÒÉÓ ÍÀÐÏÅÍÉ.';
$strNull = 'ÍÖËÉ';

$strOftenQuotation = 'ÅÄËÄÁÉÓ ÌÍÉÛÅÍÄËÏÁÄÁÉ ÌÏÈÀÅÓÃÄÁÀ ÀÌ ÓÉÌÁÏËÏÄÁÛÉ OPTIONALLY ÍÉÛÍÀÅÓ ÒÏÌ ÌáÏËÏÃ char ÃÀ varchar ÔÉÐÉÓ ÅÄËÄÁÉÓ ÌÍÉÛÅÍÄËÏÁÄÁÉ ÌÏÈÀÅÓÃÄÁÀ ÌÉÈÉÈÄÁÖË ÓÉÌÁÏËÏÄÁÛÉ.';
$strOptimizeTable = 'ÝáÒÉËÉÓ ÏÐÔÉÌÉÆÀÝÉÀ';
$strOptionalControls = 'ÀÒÀÀÖÝÉËÄÁÄËÉÀ. ÂÀÍÓÀÆÙÅÒÀÅÓ ÒÏÂÏÒ ÖÍÃÀ ÉØÍÀÓ ÜÀßÄÒÉËÉ ÃÀ ßÀÊÉÈáÖËÉ ÓÐÄÝÉÀËÖÒÉ ÓÉÌÁÏËÏÄÁÉ.';
$strOr = 'ÀÍ';

$strPasswordEmpty = 'ÐÀÒÏËÉ ÝÀÒÉÄËÉÀ!';
$strPasswordNotSame = 'ÐÀÒÏËÄÁÉ ÂÀÍÓáÅÀÅÃÄÁÀ!';
$strPHPVersion = 'PHP ÅÄÒÓÉÀ';
$strPos1 = 'ÃÀÓÀßÚÉÓÉ';
$strPrevious = 'ßÉÍÀ';
$strPrimary = 'ÐÉÒÅÄËÀÃÉ';
$strPrimaryKey = 'ÐÉÒÅÄËÀÃÉ ÅÄËÉ';
$strPrintView = 'ÁÄàÃÅÉÓÈÅÉÓ';
$strProperties = 'ÈÅÉÓÄÁÄÁÉ';

$strQBE = 'ÀÌÏÒÜÄÅÀ ÌÀÂÀËÉÈÉÓ ÌÉáÄÃÅÉÈ';

$strRecords = 'ÜÀÍÀßÄÒÄÁÉ';
$strReloadFailed = 'MySQL reload failed.';
$strReloadMySQL = 'MySQL-ÉÓ ÂÀÃÀÔÅÉÒÈÅÀ';
$strRenameTable = 'ÓÀáÄËÉÓ ÛÄÝÅËÀ';
$strRepairTable = 'ÝáÒÉËÉÓ ÀÙÃÂÄÍÀ';
$strReplace = 'ÛÄÝÅËÀ';
$strReplaceTable = 'ÛÄÝÅÀËÄ ÝáÒÉËÉ ÌÏÍÀÝÄÌÄÁÉÈ ÛÄÌÃÄÂÉ ×ÀÉËÉÃÀÍ';
$strReset = 'ÓÀßÚÉÓÉ ÌÍÉÛÅÍÄËÏÁÄÁÉ';
$strRowLength = 'ÜÀÍÀßÄÒÉÓ ÓÉÂÒÞÄ ';
$strRowSize = ' ÜÀÍÀßÄÒÉÓ ÆÏÌÀ ';
$strRows = 'ÜÀÍÀßÄÒÄÁÉ';
$strRowsFrom = 'ÜÀÍÀßÄÒÉ. ÓÀßÚÉÓÉ ÜÀÍÀßÄÒÉ:';
$strRunning = 'ÂÀÛÅÄÁÖËÉÀ äÏÓÔÆÄ %s';
$strRunSQLQuery = 'ÛÄÀÓÒÖËÄ SQL ÌÏÈáÏÅÍÀ/ÌÏÈáÏÅÍÄÁÉ ÌÏÍÀÝÄÌÈÀ ÁÀÆÀÆÄ %s';

$strSave = 'ÛÄÍÀáÅÀ';
$strSelect = 'ÀÌÏÒÜÄÅÀ';
$strSelectFields = 'ÀÉÒÜÉÄÈ ÅÄËÄÁÉ (ÌÉÍÉÌÖÌ ÄÒÈÉ ÌÀÉÍÝ):';
$strSelectNumRows = 'ÌÏÈáÏÅÍÀÛÉ';
$strServerVersion = 'ÓÄÒÅÄÒÉÓ ÅÄÒÓÉÀ';
$strShow = 'ÂÀÌÏÉÔÀÍÄ';
$strShowingRecords = 'ÍÀÜÅÄÍÄÁÉÀ ÜÀÍÀßÄÒÄÁÉ ';
$strSize = 'ÆÏÌÀ';
$strSpaceUsage = 'ÂÀÌÏÚÄÍÄÁÖËÉ ÓÉÅÒÝÄ';
$strSQLQuery = 'SQL-ÀÌÏÒÜÄÅÀ';
$strStatement = 'ÀÙßÄÒÀ';
$strStrucCSV = 'CSV ÌÏÍÀÝÄÌÄÁÉ';
$strStrucData = 'ÓÔÒÖØÔÖÒÀ ÃÀ ÌÏÍÀÝÄÌÄÁÉ';
$strStrucDrop = 'ÀÒÓÄÁÖËÉÓ ßÀÛËÀ ÃÀ ÃÀÌÀÔÄÁÀ';
$strStrucOnly = 'ÌáÏËÏÃ ÓÔÒÖØÔÖÒÀ';
$strSubmit = 'ÈÀÍáÌÏÁÀ';
$strSuccess = 'ÈØÅÄÍÉ SQL ÌÏÈáÏÅÍÀ ßÀÒÌÀÔÄÁÉÈ ÛÄÓÒÖËÃÀ';
$strSum = 'ãÀÌÉ';

$strTable = 'ÝáÒÉËÉ ';
$strTableComments = 'ÊÏÌÄÍÔÀÒÉ ÝáÒÉËÆÄ';
$strTableEmpty = 'ÝáÒÉËÉÓ ÓÀáÄËÉ ÀÒÀ ÀÒÉÓ ÌÉÈÉÈÄÁÖËÉ!';
$strTableMaintenance = 'ÝáÒÉËÉÓ ÌÏÌÓÀáÖÒÄÁÀ';
$strTableStructure = 'ÝáÒÉËÉÓ ÓÔÒÖØÔÖÒÀ. ÝáÒÉËÉ:';
$strTableType = 'ÝáÒÉËÉÓ ÔÉÐÉ';
$strTextAreaLength = ' ÌÉÓÉ ÓÉÂÒÞÉÓ ÂÀÌÏ,<br /> ÄÓ ÅÄËÉ ÛÄÉÞËÄÁÀ ÀÒ ÀÒÉÓ ÒÄÃÀØÔÉÒÄÁÀÃÉ ';
$strTheContent = '×ÀÉËÉÓ ÛÄÌÝÅÄËÏÁÀ ÃÀÌÀÔÄÁÖË ÉØÍÀ.';
$strTheContents = 'ÝáÒÉËÉÓ ÉÓ ÜÀÍÀßÄÒÄÁÉ, ÒÏÌËÄÁÓÀÝ äØÏÍÃÀÈ ÉÃÄÍÔÖÒÉ ÐÉÒÅÄËÀÃÉ ÀÍ ÖÍÉÊÀËÖÒÉ ÂÀÓÀÙÄÁÉ ÛÄÝÅËÉËÉÀ ×ÀÉËÉÓ ÛÄÌÝÅÄËÏÁÉÈ.';
$strTheTerminator = 'ÅÄËÄÁÉÓ ÔÄÒÌÉÍÀÔÏÒÉ.';
$strTotal = 'ÓÖË ÝáÒÉËÛÉ';
$strType = 'ÔÉÐÉ';

$strUncheckAll = 'Uncheck All';
$strUnique = 'ÖÍÉÊÀËÖÒÉ';
$strUsage = 'ÌÏÝÖËÏÁÀ';
$strUser = 'ÌÏÌáÌÀÒÄÁÄËÉ';
$strUserEmpty = 'ÌÏÌáÌÀÒÄÁËÉÓ ÓÀáÄËÉ ÝÀÒÉÄËÉÀ!';
$strUsers = 'ÌÏÌáÌÀÒÄÁËÄÁÉ';

$strValue = 'ÌÍÉÛÅÍÄËÏÁÀ';
$strViewDump = 'ÝáÒÉËÉÓÉ ÓØÄÌÀ';
$strViewDumpDB = 'ÌÏÍÀÝÄÌÈÀ ÁÀÆÉÓ ÓØÄÌÀ';

$strWelcome = 'ÊÄÈÉËÉ ÉÚÏÓ ÈØÅÄÍÉ ÌÏÁÒÞÀÍÄÁÀ %s';
$strWrongUser = 'ÀÒÀÓßÏÒÉ username/password. ÌÉÌÀÒÈÅÀ ÁËÏÊÉÒÄÁÖËÉÀ';

$strYes = 'ÊÉ';


// To translate
$strAddDeleteColumn = 'Add/Delete Field Columns';
$strAddDeleteRow = 'Add/Delete Criteria Row';
$strAffectedRows = 'Affected rows:';
$strAfter = 'After %s';
$strAfterInsertBack = 'Go back to previous page';
$strAfterInsertNewInsert = 'Insert another new row';
$strAscending = 'Ascending';
$strBinary = 'Binary';
$strBinaryDoNotEdit = 'Binary - do not edit';
$strBookmarkDeleted = 'The bookmark has been deleted.';
$strBookmarkQuery = 'Bookmarked SQL-query';
$strBookmarkThis = 'Bookmark this SQL-query';
$strBzip = '"bzipped"';
$strCantLoadMySQL = 'cannot load MySQL extension,<br />please check PHP Configuration.';
$strChangePassword = 'Change password';
$strCompleteInserts = 'Complete inserts';
$strCookiesRequired = 'Cookies must be enabled past this point.';
$strCopyTable = 'Copy table to (database<b>.</b>table):';
$strCriteria = 'Criteria';
$strDatabaseHasBeenDropped = 'Database %s has been dropped.';
$strDatabasesStats = 'Databases statistics';
$strDatabaseWildcard = 'Database (wildcards allowed):';
$strDeletedRows = 'Deleted rows:';
$strDescending = 'Descending';
$strDisplayOrder = 'Display order:';
$strDropTable = 'Drop table';
$strEnglishPrivileges = ' Note: MySQL privilege names are expressed in English ';
$strExtendedInserts = 'Extended inserts';
$strFieldHasBeenDropped = 'Field %s has been dropped';
$strFieldsEmpty = ' The field count is empty! ';
$strFieldsEnclosedBy = 'Fields enclosed by';
$strFieldsEscapedBy = 'Fields escaped by';
$strFieldsTerminatedBy = 'Fields terminated by';
$strFlushTable = 'Flush the table ("FLUSH")';
$strFormEmpty = 'Missing value in the form !';
$strFullText = 'Full Texts';
$strGrants = 'Grants';
$strGzip = '"gzipped"';
$strHomepageOfficial = 'Official phpMyAdmin Homepage';
$strHomepageSourceforge = 'Sourceforge phpMyAdmin Download Page';
$strIgnore = 'Ignore';
$strInsertedRows = 'Inserted rows:';
$strInsertTextfiles = 'Insert data from a textfile into table';
$strInstructions = 'Instructions';
$strInUse = 'in use';
$strInvalidName = '"%s" is a reserved word, you can\'t use it as a database/table/field name.';
$strKeepPass = 'Do not change the password';
$strLengthSet = 'Length/Values*';
$strLimitNumRows = 'Number of rows per page';
$strLinesTerminatedBy = 'Lines terminated by';
$strLogin = 'Login';
$strLogout = 'Log out';
$strLogPassword = 'Password:';
$strLogUsername = 'Username:';
$strModify = 'Modify';
$strMoveTable = 'Move table to (database<b>.</b>table):';
$strMoveTableOK = 'Table %s has been moved to %s.';
$strMySQLReloaded = 'MySQL reloaded.';
$strMySQLServerProcess = 'MySQL %pma_s1% running on %pma_s2% as %pma_s3%';
$strNbRecords = 'Number of rows';
$strNoDatabases = 'No databases';
$strNoDropDatabases = '"DROP DATABASE" statements are disabled.';
$strNoFrames = 'phpMyAdmin is more friendly with a <b>frames-capable</b> browser.';
$strNoModification = 'No change';
$strNone = 'None';
$strNoQuery = 'No SQL query!';
$strNoRights = 'You don\'t have enough rights to be here right now!';
$strNotNumber = 'This is not a number!';
$strNotValidNumber = ' is not a valid row number!';
$strOptionally = 'OPTIONALLY';
$strOverhead = 'Overhead';
$strPartialText = 'Partial Texts';
$strPassword = 'Password';
$strPmaDocumentation = 'phpMyAdmin documentation';
$strPmaUriError = 'The <tt>$cfgPmaAbsoluteUri</tt> directive MUST be set in your configuration file!';
$strPrivileges = 'Privileges';
$strQBEDel = 'Del';
$strQBEIns = 'Ins';
$strQueryOnDb = 'SQL-query on database <b>%s</b>:';
$strReferentialIntegrity = 'Check referential integrity:';
$strRememberReload = 'Remember reload the server.';
$strRenameTableOK = 'Table %s has been renamed to %s';
$strReType = 'Re-type';
$strRevoke = 'Revoke';
$strRevokeGrant = 'Revoke Grant';
$strRevokeGrantMessage = 'You have revoked the Grant privilege for %s';
$strRevokeMessage = 'You have revoked the privileges for %s';
$strRevokePriv = 'Revoke Privileges';
$strRowsModeHorizontal = 'horizontal';
$strRowsModeOptions = 'in %s mode and repeat headers after %s cells';
$strRowsModeVertical = 'vertical';
$strRowsStatistic = 'Row Statistic';
$strRunQuery = 'Submit Query';
$strSelectADb = 'Please select a database';
$strSelectAll = 'Select All';
$strSend = 'Save as file';
$strServerChoice = 'Server Choice';
$strSetEnumVal = 'If field type is "enum" or "set", please enter the values using this format: \'a\',\'b\',\'c\'...<br />If you ever need to put a backslash ("\") or a single quote ("\'") amongst those values, backslashes it (for example \'\\\\xyz\' or \'a\\\'b\').';
$strShowAll = 'Show all';
$strShowCols = 'Show columns';
$strShowPHPInfo = 'Show PHP information';
$strShowTables = 'Show tables';
$strShowThisQuery = ' Show this query here again ';
$strSingly = '(singly)';
$strSort = 'Sort';
$strStartingRecord = 'Starting row';
$strStrucExcelCSV = 'CSV for Ms Excel data';
$strTableHasBeenDropped = 'Table %s has been dropped';
$strTableHasBeenEmptied = 'Table %s has been emptied';
$strTableHasBeenFlushed = 'Table %s has been flushed';
$strTables = '%s table(s)';
$strUnselectAll = 'Unselect All';
$strUpdatePrivMessage = 'You have updated the privileges for %s.';
$strUpdateProfile = 'Update profile:';
$strUpdateProfileMessage = 'The profile has been updated.';
$strUpdateQuery = 'Update Query';
$strUseBackquotes = 'Enclose table and field names with backquotes';
$strUserName = 'User name';
$strUseTables = 'Use Tables';
$strWithChecked = 'With selected:';
$strZip = '"zipped"';

// For indexes
$strAddToIndex = 'Add to index &nbsp;%s&nbsp;column(s)';
$strCantRenameIdxToPrimary = 'Can\'t rename index to PRIMARY!';
$strCardinality = 'Cardinality';
$strCreateIndex = 'Create an index on&nbsp;%s&nbsp;columns';
$strCreateIndexTopic = 'Create a new index';
$strIdxFulltext = 'Fulltext';
$strIndexHasBeenDropped = 'Index %s has been dropped';
$strIndexName = 'Index name&nbsp;:';
$strIndexType = 'Index type&nbsp;:';
$strModifyIndexTopic = 'Modify an index';
$strNoIndex = 'No index defined!';
$strNoIndexPartsDefined = 'No index parts defined!';
$strPrimaryKeyHasBeenDropped = 'The primary key has been dropped';
$strPrimaryKeyName = 'The name of the primary key must be... PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>must</b> be the name of and <b>only of</b> a primary key!)';
?>
