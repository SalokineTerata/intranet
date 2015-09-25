<?php
/* $Id: japanese-sjis.inc.php,v 1.20.2.1 2002/06/18 21:33:05 rabus Exp $ */

/**
 * Translated by Yukihiro Kawada <luc at ceres.dti.ne.jp>
 */

$charset = 'SHIFT_JIS';
$text_dir = 'ltr';
$left_font_family = 'sans-serif';
$right_font_family = 'sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('oCg', 'KB', 'MB', 'GB');

$day_of_week = array('ú', '', 'Î', '', 'Ø', 'à', 'y');
$month = array('1','2','3','4','5','6','7','8','9','10','11','12');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%YN%B%eú %H:%M';


$strAccessDenied = 'ANZXÍÛ³êÜµ½B';
$strAction = 'Às';
$strAddDeleteColumn = 'tB[hñÌuÇÁ^ív';
$strAddDeleteRow = 'ðsÌuÇÁ^ív';
$strAddNewField = 'tB[hÌÇÁ';
$strAddPriv = 'Vµ¢Á ÌÇÁ';
$strAddPrivMessage = 'Vµ¢Á ðÇÁµÜµ½B';
$strAddSearchConditions = 'õð¶ðÇÁµÄ­¾³¢B("where"Ìß¶):';
$strAddToIndex = ' &nbsp;%s&nbsp;ÌñðCfbNXÉÇÁµÜµ½';
$strAddUser = '[U[ÌÇÁ';
$strAddUserMessage = '[U[ðÇÁµÜµ½B';
$strAffectedRows = 'e¿³ê½s:';
$strAfter = 'ãÉ %s';
$strAfterInsertBack = 'ßé';
$strAfterInsertNewInsert = 'VR[hÌÇÁ';
$strAll = 'S';
$strAlterOrderBy = 'e[uÔÌð';
$strAnalyzeTable = 'e[uðªÍµÜ·B';
$strAnd = 'yÑ';
$strAnIndex = 'CfbNXª%sÉÇÁ³êÜµ½B';
$strAny = 'SÄ';
$strAnyColumn = 'SR';
$strAnyDatabase = 'Sf[^x[X';
$strAnyHost = 'SÄÌzXg';
$strAnyTable = 'SÄÌe[u';
$strAnyUser = 'SÄÌ[U[';
$strAPrimaryKey = 'åvL[ª%sÉÇÁ³êÜµ½B';
$strAscending = '¸';
$strAtBeginningOfTable = 'e[uÌÅ';
$strAtEndOfTable = 'e[uÌÅã';
$strAttr = '\¦';

$strBack = 'ßé';
$strBinary = ' oCi ';
$strBinaryDoNotEdit = ' oCi -  C³oÜ¹ñ';
$strBookmarkDeleted = 'ubN}[Nð³íÉíµÜµ½B';
$strBookmarkLabel = 'x';
$strBookmarkQuery = 'ubN}[N³êÄ¢éSQLNG[';
$strBookmarkThis = 'SQLNG[ðubN}[N·é';
$strBookmarkView = '­\¾¯';
$strBrowse = '\¦';
$strBzip = '"bzip³êé"';

$strCantLoadMySQL = 'MySQLðÀsÅ«Ü¹ñB<br />PHPÌÝèðmFµÄº³¢B';
$strCantRenameIdxToPrimary = 'CfbNXÌ¼OðPRIMARYÉÏXÅ«Ü¹ñB';
$strCardinality = 'J[fBieB';
$strCarriage = 'LbW^[: \\r';
$strChange = 'ÏX';
$strChangePassword = 'pX[hÌÏX';
$strCheckAll = 'SÄð}[N';
$strCheckDbPriv = 'f[^x[XÌÁ ÌmF';
$strCheckTable = 'e[uð`FbNµÜ·B';
$strColumn = 'ñ';
$strColumnNames = 'ñ(R)¼';
$strCompleteInserts = '®SÈINSERT¶Ìì¬';
$strConfirm = 'ÀsµÄàÇ¢Å·©H';
$strCookiesRequired = '±±©çæÍNbL[ªÂ³êÄ¢éKvª èÜ·B';
$strCopyTable = 'e[uð(database<b>.</b>table)ÉRs[·é:';
$strCopyTableOK = '%se[uð%sÉRs[µÜµ½B';
$strCreate = 'ì¬';
$strCreateIndex = '&nbsp;%s&nbsp;ÌñÌCfbNXÌì¬';
$strCreateIndexTopic = 'Vµ¢CfbNXÌì¬';
$strCreateNewDatabase = 'Vµ¢DBðì¬µÜ·B';
$strCreateNewTable = '»ÝÌDBÉVµ¢e[uðì¬µÜ·B %s--> ';
$strCriteria = 'î';

$strData = 'f[^';
$strDatabase = 'f[^x[X';
$strDatabaseHasBeenDropped = 'f[^x[X%sð³íÉíµÜµ½B';
$strDatabases = 'f[^x[X';
$strDatabasesStats = 'f[^x[XÌv';
$strDatabaseWildcard = 'f[^x[X(ChJ[hgpÂ):';
$strDataOnly = 'f[^ÌÝ';
$strDefault = 'î{l';
$strDelete = 'í';
$strDeleted = 'Iðµ½ñðíµÜµ½B';
$strDeleteFailed = 'íÉ¸sµÜµ½';
$strDeleteUserMessage = '[U[%sðíµÜµ½B';
$strDeletedRows = 'í³ê½s:';
$strDescending = '~';
$strDisplay = '\¦';
$strDisplayOrder = '­\Ô:';
$strDoAQuery = '"áÌQUERY"ðÀs (wildcard: "%")';
$strDocu = 'wv';
$strDoYouReally = '{ÉÀsµÄàÇ¢Å·©H --> ';
$strDrop = 'í';
$strDropDB = 'f[^x[X%sÌí ';
$strDropTable = 'e[uÌí';
$strDumpingData = 'e[uÌ_vf[^';
$strDynamic = '_Ci~bN';

$strEdit = 'C³';
$strEditPrivileges = 'Á ðC³';
$strEffective = 'Àã';
$strEmpty = 'óÉ·é';
$strEmptyResultSet = 'MySQLªóÌlðÔµÜµ½B(i.e. zero rows).';
$strEnd = 'Åã';
$strEnglishPrivileges = ' Ó: MySQLÌÁ Ì¼OÍpêÅ­\µÄ¢Ü·B';
$strError = 'G[';
$strExtendedInserts = '·¢INSERT¶Ìì¬';
$strExtra = 'ÇÁ';

$strField = 'tB[h';
$strFieldHasBeenDropped = 'tB[h%sª³íÉí³êÜµ½';
$strFields = 'tB[h';
$strFieldsEmpty = ' tB[hÍóÅ·B ';
$strFieldsEnclosedBy = 'tB[hÍÝL';
$strFieldsEscapedBy = 'tB[hÌGXP[vL';
$strFieldsTerminatedBy = 'tB[hæØèL';
$strFixed = 'Åè';
$strFlushTable = 'e[uÌLbVðóÉ·é("FLUSH")';
$strFormat = 'tH[}bg';
$strFormEmpty = 'tH[ÅÍlª èÜ¹ñÅµ½B';
$strFullText = 'S¶';
$strFunction = 'Ö';

$strGenTime = 'ì¬ÌÔ';
$strGo = 'Às';
$strGrants = 't^';
$strGzip = '"gzip³êé"';

$strHasBeenAltered = 'ðÏXµÜµ½B';
$strHasBeenCreated = 'ðì¬µÜµ½B';
$strHome = '[y[WÖ';
$strHomepageOfficial = 'phpMyAdminz[';
$strHomepageSourceforge = 'SourceforgeÌphpMyAdmin_E[hy[W';
$strHost = 'zXg';
$strHostEmpty = 'zXg¼ÍóÅ·!';

$strIdxFulltext = 'S¶';
$strIfYouWish = 'e[uÌR(ñ)Éf[^ðÇÁ·éêÍAtB[hXgðJ}ÅæªµÄ­¾³¢B';
$strIgnore = '³';
$strIndex = 'CfbNX';
$strIndexes = 'CfbNX';
$strIndexHasBeenDropped = 'CfbNX%sªí³êÜµ½';
$strIndexName = 'CfbNX¼&nbsp;:';
$strIndexType = 'CfbNXÌ^Cv&nbsp;:';
$strInsert = 'ÇÁ';
$strInsertAsNewRow = 'Vµ¢sÆµÄÌÇÁ';
$strInsertedRows = 'ÇÁ³ê½s:';
$strInsertNewRow = 'Vµ¢sÌÇÁ';
$strInsertTextfiles = 'e[uÉeLXgt@CÌÇÁ';
$strInstructions = '³¦';
$strInUse = 'gp';
$strInvalidName = '"%s"Í\ñêÅ·©çuf[^x[X^e[u^tB[hv¼ÉÍg¦Ü¹ñB';

$strKeepPass = 'pX[hðÏXµÈ¢';
$strKeyname = 'L[¼';
$strKill = 'â~';

$strLength = '·³';
$strLengthSet = '·³/Zbg*';
$strLimitNumRows = 'y[WÌR[h';
$strLineFeed = 'üs¶: \\n';
$strLines = 's';
$strLinesTerminatedBy = 'sÌI[L';
$strLocationTextfile = 'eLXgt@CÌê';
$strLogin = 'OC';
$strLogout = 'OAEg';
$strLogPassword = 'pX[h:';
$strLogUsername = '[U[¼:';

$strModifications = 'ð³µ­C³µÜµ½B';
$strModify = 'C³';
$strModifyIndexTopic = 'CfbNXÌÏX';
$strMoveTable = 'e[uð(database<b>.</b>table)ÉÚ®:';
$strMoveTableOK = 'e[u%sª%sÚ®³êÜµ½B';
$strMySQLReloaded = 'MySQLðVµ­ÇÝÝÜµ½B';
$strMySQLSaid = 'MySQLÌbZ[W --> ';
$strMySQLServerProcess = 'MySQL %pma_s1%Í%pma_s2%ã%pma_s3%ÆµÄÀsµÄ¢Ü·B';
$strMySQLShowProcess = 'MySQLvZXÌ\¦';
$strMySQLShowStatus = 'MySQLÌ^Cîñ';
$strMySQLShowVars = 'MySQLÌVXeÏ';

$strName = '¼O';
$strNbRecords = 'R[h';
$strNext = 'Ö';
$strNo = '¢¢¦';
$strNoDatabases = 'f[^x[X';
$strNoDropDatabases = '"DROP DATABASE"Xe[ggÍÖ~³êéB';
$strNoFrames = '<b>t[</b>Â\ÈuEU[ÌûªphpMyAdminÍg¢â·¢Å·B';
$strNoIndex = 'CfbNXÍÝè³êÄ¢Ü¹ñB';
$strNoIndexPartsDefined = 'CfbNXÌªÍÝè³êÄ¢Ü¹ñB';
$strNoModification = 'ÏX³';
$strNone = '³';
$strNoPassword = 'pX[h³µ';
$strNoPrivileges = 'Á ³µ';
$strNoQuery = 'SQLNG[³µ';
$strNoRights = '»ÝÁ ðÁÄÈ¢ÌÅ±±ÉüêÜ¹ñB';
$strNoTablesFound = '»ÝÌDBÉe[uÍ èÜ¹ñB';
$strNotNumber = '±êÍÔÅÍ èÜ¹ñB';
$strNotValidNumber = ' ÍsÌ³µ¢ÔÅÍ èÜ¹ñ ';
$strNoUsersFound = '[U[Í©Â©èÜ¹ñÅµ½B';
$strNull = 'óÌl(Null)';

$strOftenQuotation = 'øpÅ·BIvVÍAcharÜ½ÍvarchartB[hÌÝ" "ÅÍÜêÄ¢é±ÆðÓ¡µÜ·B';
$strOptimizeTable = 'e[uðÅK»µÜ·B';
$strOptionalControls = 'Áê¶ÌÇÝÝ/«ÝIvV';
$strOptionally = 'IvVÅ·B';
$strOr = 'Í';
$strOverhead = 'I[o[wbh';

$strPartialText = 'ªIÈ¶';
$strPassword = 'pX[h';
$strPasswordEmpty = 'pX[hÍóÅ·B';
$strPasswordNotSame = 'pX[hÍóÅ·B';
$strPHPVersion = 'PHP o[W';
$strPmaDocumentation = 'phpMyAdminÌhLg';
$strPmaUriError = '<tt>$cfgPmaAbsoluteUri</tt> ðK¸configt@CÌÅÝèµÄº³¢!';
$strPos1 = 'Å';
$strPrevious = 'ÈO';
$strPrimary = 'åv';
$strPrimaryKey = 'åvL[';
$strPrimaryKeyHasBeenDropped = 'åvL[ðíµÜµ½B';
$strPrimaryKeyName = 'åvL[Ì¼OÍ... PRIMARYÅÍÈ¯êÎ¢¯Ü¹ñB';
$strPrimaryKeyWarning = '("PRIMARY"Í¿å¤ÇåvL[Ì¼OÅÍÈ¯êÎ¢¯Ü¹ñB';
$strPrintView = 'óüp\¦';
$strPrivileges = 'Á ';
$strProperties = 'vpeB';

$strQBE = 'á©çNG[Às';
$strQBEDel = 'í';
$strQBEIns = '}ü';
$strQueryOnDb = 'f[^x[XÌSQLNG[ <b>%s</b>:';

$strRecords = 'R[h';
$strReferentialIntegrity = 'ÚÌ`FbN:';
$strReloadFailed = 'MySQLÌ[hÉ¸sµÜµ½B';
$strReloadMySQL = 'MySQLÌ[h';
$strRememberReload = 'T[o[Ì[hðYêÈ¢Åº³¢B';
$strRenameTable = 'e[u¼ÌÏX';
$strRenameTableOK = '%sð%sÉ¼OðÏXµÜµ½B';
$strRepairTable = 'e[uðµÜ·B';
$strReplace = 'u«·¦é';
$strReplaceTable = 't@CÅe[uðu«·¦é';
$strReset = 'Zbg';
$strReType = 'ÄLü';
$strRevoke = 'p~';
$strRevokeGrant = ' t^ÌæÁ';
$strRevokeGrantMessage = '%sÌt^Á ðæÁµÜµ½B';
$strRevokeMessage = '%sÌÁ ðæÁµÜµ½';
$strRevokePriv = 'Á ÌæÁ';
$strRowLength = 'sÌ·³';
$strRows = 's';
$strRowsFrom = 'Jns';
$strRowSize = ' sÌTCY ';
$strRowsModeHorizontal = '½';
$strRowsModeOptions = 'ûü: %s : %s ñ¸Âwb_[ðJèÔµ­\·é';
$strRowsModeVertical = 'd¼';
$strRowsStatistic = 'sÌv';
$strRunning = 'ªÀsÅ·B %s';
$strRunQuery = 'NG[ÌÀs';
$strRunSQLQuery = 'f[^x[X%sÉSQLNG[Às';

$strSave = 'Û¶';
$strSelect = 'Ið';
$strSelectADb = 'f[^x[XðIðµÄ­¾³¢';
$strSelectAll = 'SIð';
$strSelectFields = 'tB[hÌIð(êÂÈã):';
$strSelectNumRows = 'NG[';
$strSend = 't@CÉÆ·';
$strServerChoice = 'T[o[ÌIð';
$strServerVersion = 'T[o[Ìo[W';
$strSetEnumVal = 'tB[h^Cvª"enum"Í"set"ÌêÍlð±ÌtH[}bgðgÁÄüÍµÄº³¢: \'a\',\'b\',\'c\'...<br />obNXbVu"\"vÍNI[gu"\'"vðüÍµ½¢ÆAªÉobNXbVðt¯Äº³¢uá: \'\\\\xyz\' or \'a\\\'b\'vB';
$strShow = '\¦';
$strShowAll = 'SÌ­' . "\x5c";
$strShowCols = 'ñÌ­' . "\x5c";
$strShowingRecords = 'R[h\¦';
$strShowPHPInfo = 'PHPîñ';
$strShowTables = 'e[uÌ­' . "\x5c";
$strShowThisQuery = ' Àsµ½NG[ð±±É\¦·é ';
$strSingly = '(êñ)';
$strSize = 'TCY';
$strSort = '\[g';
$strSpaceUsage = 'fBXNgpÊ';
$strSQLQuery = 'Às³ê½SQLNG[';
$strStartingRecord = 'ÅÌR[h';
$strStatement = 'Xe[gg';
$strStrucCSV = 'CSVf[^';
$strStrucData = '\¢Æf[^';
$strStrucDrop = '\'drop table\'ðÇÁ';
$strStrucExcelCSV = 'Ms ExcelÖÌCSVf[^';
$strStrucOnly = '\¢ÌÝ';
$strSubmit = 'Às';
$strSuccess = 'SQLNG[ª³íÉÀs³êÜµ½B';
$strSum = 'v';

$strTable = 'e[u ';
$strTableComments = 'e[uÌà¾';
$strTableEmpty = 'e[u¼ÍóÅ·B';
$strTableHasBeenDropped = 'e[u%sðíµÜµ½B';
$strTableHasBeenEmptied = 'e[u%sðóÉµÜµ½B';
$strTableHasBeenFlushed = 'e[u%sÌLbVðóÉµÜµ½B';
$strTableMaintenance = 'e[uÇ';
$strTables = '%se[u';
$strTableStructure = 'e[uÌ\¢';
$strTableType = 'e[uÌ^Cv';
$strTextAreaLength = ' ·³Ì×Å±ÌtB[hð<br /> C³oÈ¢Â\«ª èÜ· ';
$strTheContent = 't@CÌf[^ð}üµÜµ½B';
$strTheContents = 't@CÌf[^ÅAIðµ½e[uÌåvL[Ü½ÍBêÈL[Éêv·éñðu«·¦Ü·B';
$strTheTerminator = 'tB[hÌI[LÅ·B';
$strTotal = 'v';
$strType = 'tB[h^Cv';

$strUncheckAll = 'SÄÌ}[Nðí';
$strUnique = 'Bê';
$strUnselectAll = 'Sðú';
$strUpdatePrivMessage = '%sÌÁ ðAbvf[gµÜµ½B';
$strUpdateProfile = 'vt@CÌAbvf[g:';
$strUpdateProfileMessage = 'vt@CðAbvf[gµÜµ½B';
$strUpdateQuery = 'NG[ÌAbvf[g';
$strUsage = 'gpÊ';
$strUseBackquotes = 'tNI[gÅe[u¼âtB[h¼ðÍÞ';
$strUser = '[U[';
$strUserEmpty = '[U[¼ÍóÅ·B';
$strUserName = '[U[¼';
$strUsers = '[U[';
$strUseTables = 'g¤e[u';

$strValue = 'l';
$strViewDump = 'e[uÌ_v(XL[})\¦';
$strViewDumpDB = 'DBÌ_v(XL[})\¦';

$strWelcome = '%sÖæ¤±»';
$strWithChecked = '`FbNµ½àÌð:';
$strWrongUser = '[U¼Ü½ÍpX[hª³µ­ èÜ¹ñB<br />ANZXÍÛ³êÜµ½B';

$strYes = 'Í¢';

$strZip = '"zip³êé"';

// japanese only
$strEncto = 'GR[fBOÖÏ··é'; // encoding convert
$strKanjiEncodConvert = '¿R[hÏ·'; // kanji code convert
$strXkana = 'SpJiÖÏ··é'; // convert to X208-kana

// To translate
?>
