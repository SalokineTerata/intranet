<?php
/* $Id: dutch.inc.php,v 1.113.2.2 2002/06/18 21:33:05 rabus Exp $ */

/**
 * Updated by "CaliMonk" <calimonk at gmx.net> on 2002/06/06 9:20.
 */

$charset = 'iso-8859-1';
$text_dir = 'ltr';
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = '.';
$number_decimal_separator = ',';
$byteUnits = array('Bytes', 'KB', 'MB', 'GB');

$day_of_week = array('Zo', 'Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za');
$month = array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = ' %e %B %Y om %H:%M';

$strAPrimaryKey = 'Een primaire sleutel is toegevoegd aan %s';
$strAccessDenied = 'Toegang geweigerd ';
$strAction = 'Actie';
$strAddDeleteColumn = 'Toevoegen/Verwijderen Veld Kolommen';
$strAddDeleteRow = 'Toevoegen/Verwijderen Criteria Rij';
$strAddNewField = 'Nieuw veld toevoegen';
$strAddPriv = 'Voeg nieuwe rechten toe';
$strAddPrivMessage = 'U heeft nieuwe rechten toegevoegd.';
$strAddSearchConditions = 'Zoekcondities toevoegen (het "where" gedeelte van de query):';
$strAddToIndex = 'Voeg &nbsp;%s&nbsp; kolom(men) toe aan index';
$strAddUser = 'Voeg een nieuwe gebruiker toe';
$strAddUserMessage = 'U heeft een nieuwe gebruiker toegevoegd.';
$strAffectedRows = 'Getroffen rijen:';
$strAfter = 'Na %s';
$strAfterInsertBack = 'Terug';
$strAfterInsertNewInsert = 'Voeg een nieuw record toe';
$strAll = 'Alle';
$strAlterOrderBy = 'Wijzig de tabel order bij';
$strAnalyzeTable = 'Analyseer tabel';
$strAnd = 'En';
$strAnIndex = 'Een index is toegevoegd aan %s';
$strAny = 'Elke'; //! Willekeurige?
$strAnyColumn = 'Een willekeurige kolom';
$strAnyDatabase = 'Een willekeurige database';
$strAnyHost = 'Een willekeurige host';
$strAnyTable = 'Een willekeurige tabel';
$strAnyUser = 'Een willekeurige gebruiker';
$strAscending = 'Oplopend';
$strAtBeginningOfTable = 'Aan het begin van de tabel';
$strAtEndOfTable = 'Aan het eind van de tabel';
$strAttr = 'Attributen';

$strBack = 'Terug';
$strBinary = ' Binair ';
$strBinaryDoNotEdit = ' Binair - niet aanpassen ';
$strBookmarkDeleted = 'De boekenlegger is verwijderd.';
$strBookmarkLabel = 'Label';
$strBookmarkQuery = 'Opgeslagen SQL-query';
$strBookmarkThis = 'Sla deze SQL-query op';
$strBookmarkView = 'Alleen bekijken';
$strBrowse = 'Verkennen';
$strBzip = '"ge-bzipt"';

$strCantLoadMySQL = 'kan de MySQL extensie niet laden,<br />controleer de PHP configuratie.';
$strCantRenameIdxToPrimary = 'Kan index niet naar PRIMARY hernoemen';
$strCardinality = 'Kardinaliteit';
$strCarriage = 'Harde return: \\r';
$strChange = 'Veranderen';
$strChangePassword = 'Wijzig paswoord';
$strCheckAll = 'Selecteer alles';
$strCheckDbPriv = 'Controleer database rechten';
$strCheckTable = 'Controleer tabel';
$strColumn = 'Kolom';
$strColumnNames = 'Kolom namen';
$strCompleteInserts = 'Invoegen voltooid';
$strConfirm = 'Weet u zeker dat u dit wilt?';
$strCookiesRequired = 'Cookies moeten aan staan voorbij dit punt.';
$strCopyTable = 'Kopieer tabel naar (database<b>.</b>tabel):';
$strCopyTableOK = 'Tabel %s is gekopieerd naar %s.';
$strCreate = 'Aanmaken';
$strCreateIndex = 'Creëer een index op kolommen&nbsp;%s&nbsp;';
$strCreateIndexTopic = 'Creëer een nieuwe index';
$strCreateNewDatabase = 'Nieuwe database aanmaken';
$strCreateNewTable = 'Nieuwe tabel aanmaken in database %s';
$strCriteria = 'Criteria';

$strData = 'Data';
$strDataOnly = 'Alleen data';
$strDatabase = 'Database ';
$strDatabaseHasBeenDropped = 'Database %s is vervallen.';
$strDatabaseWildcard = 'Database (wildcards toegestaan):';
$strDatabases = 'databases';
$strDatabasesStats = 'Database statistieken';
$strDefault = 'Standaardwaarde';
$strDelete = 'Verwijderen';
$strDeleteFailed = 'Verwijderen mislukt!';
$strDeleteUserMessage = 'U heeft gebruiker %s verwijderd.';
$strDeleted = 'De rij is verwijderd';
$strDeletedRows = 'Verwijder rijen:';
$strDescending = 'Aflopend';
$strDisplay = 'Laat zien';
$strDisplayOrder = 'Weergave volgorde:';
$strDoAQuery = 'Voer een query op basis van een vergelijking uit (wildcard: "%")';
$strDoYouReally = 'Weet u zeker dat u dit wilt ';
$strDocu = 'Documentatie';
$strDrop = 'Verwijderen';
$strDropDB = 'Verwijder database %s';
$strDropTable = 'Verwijder tabel';
$strDumpingData = 'Gegevens worden uitgevoerd voor tabel';
$strDynamic = 'dynamisch';

$strEdit = 'Wijzigen';
$strEditPrivileges = 'Wijzig rechten';
$strEffective = 'Effectief';
$strEmpty = 'Legen';
$strEmptyResultSet = 'MySQL retourneerde een lege resultaat set (0 rijen).';
$strEnd = 'Einde';
$strEnglishPrivileges = ' Aantekening: de MySQL rechten namen zijn uitgelegd in het Engels ';
$strError = 'Fout';
$strExtendedInserts = 'Uitgebreide invoegingen';
$strExtra = 'Extra';

$strField = 'Veld';
$strFieldHasBeenDropped = 'Veld %s is vervallen';
$strFields = 'Velden';
$strFieldsEmpty = ' Het velden aantal is leeg! ';
$strFieldsEnclosedBy = 'Velden ingesloten door';
$strFieldsEscapedBy = 'Velden ontsnapt door';
$strFieldsTerminatedBy = 'Velden beëindigd door';
$strFixed = 'vast';
$strFormEmpty = 'Er mist een waarde in het formulier !';
$strFormat = 'Formatteren';
$strFullText = 'Volledige teksten';
$strFunction = 'Functie';

$strGenTime = 'Generatie Tijd';
$strGo = 'Start';
$strGrants = 'Toekennen';
$strGzip = '"ge-gzipt"';

$strHasBeenAltered = 'is veranderd.';
$strHasBeenCreated = 'is aangemaakt.';
$strHome = 'Home';
$strHomepageOfficial = 'Officiële phpMyAdmin Website';
$strHomepageSourceforge = 'Sourceforge phpMyAdmin Download Pagina';
$strHost = 'Host';
$strHostEmpty = 'De hostnaam is leeg!';

$strIdxFulltext = 'Voltekst';
$strIfYouWish = 'Indien u slechts enkele van de tabelkolommen wilt laden, voer dan een door komma\'s gescheiden veldlijst in.';
$strIgnore = 'Negeer';
$strInUse = 'in gebruik';
$strIndex = 'Index';
$strIndexHasBeenDropped = 'Index %s is vervallen';
$strIndexName = 'Index naam&nbsp;:';
$strIndexType = 'Index type&nbsp;:';
$strIndexes = 'Indices';
$strInsert = 'Invoegen';
$strInsertAsNewRow = 'Voeg toe als nieuwe rij';
$strInsertNewRow = 'Nieuwe rij invoegen';
$strInsertTextfiles = 'Invoegen tekstbestanden in tabel';
$strInsertedRows = 'Ingevoegde rijen:';
$strInstructions = 'Instructies';
$strInvalidName = '"%s" is een gereserveerd woord, je kunt het niet gebruiken voor een database/tabel/veld naam.';

$strKeepPass = 'Wijzig het paswoord niet';
$strKeyname = 'Sleutelnaam';
$strKill = 'stop proces';

$strLength = 'Lengte';
$strLengthSet = 'Lengte/Waardes*';
$strLimitNumRows = 'records per pagina';
$strLineFeed = 'Regelopschuiving: \\n';
$strLines = 'Regels';
$strLinesTerminatedBy = 'Regels beëindigd door';
$strLocationTextfile = 'Locatie van het tekstbestand';
$strLogPassword = 'Paswoord:';
$strLogUsername = 'Gebruikers naam:';
$strLogin = 'Inloggen';
$strLogout = 'Uitloggen';

$strModifications = 'Wijzigingen opgeslagen.';
$strModify = 'Pas aan';
$strModifyIndexTopic = 'Wijzig een index';
$strMoveTable = 'Verplaats tabel naar (database<b>.</b>tabel):';
$strMoveTableOK = 'Tabel %s is verplaatst naar %s.';
$strMySQLReloaded = 'MySQL opnieuw geladen.';
$strMySQLSaid = 'MySQL retourneerde: ';
$strMySQLServerProcess = 'MySQL %pma_s1% draait op %pma_s2% als %pma_s3%';
$strMySQLShowProcess = 'Laat processen zien';
$strMySQLShowStatus = 'MySQL runtime informatie';
$strMySQLShowVars = 'MySQL systeemvariabelen';

$strName = 'Naam';
$strNbRecords = 'aantal records';
$strNext = 'Volgende';
$strNo = 'Nee';
$strNoDatabases = 'Geen databases';
$strNoDropDatabases = '"DROP DATABASE" opdrachten zijn niet mogelijk.';
$strNoFrames = 'phpMyAdmin is vriendelijker met een browser die <b>frames</b> aan kan.';
$strNoIndex = 'Geen index gedefinieerd!';
$strNoIndexPartsDefined = 'Geen index delen gedefinieerd!';
$strNoModification = 'Geen verandering';
$strNoPassword = 'Geen wachtwoord';
$strNoPrivileges = 'Geen rechten';
$strNoQuery = 'Geen SQL query!';
$strNoRights = 'U heeft niet genoeg rechten om hier te zijn!';
$strNoTablesFound = 'Geen tabellen gevonden in de database.';
$strNoUsersFound = 'Geen gebruiker(s) gevonden.';
$strNone = 'Geen';
$strNotNumber = 'Dit is geen cijfer!';
$strNotValidNumber = ' geen geldig rijnummer!';
$strNull = 'Null';

$strOftenQuotation = 'Meestal aanhalingstekens. OPTIONEEL betekent dat alleen char en varchar velden omsloten worden met het "omsloten met"-karakter.';
$strOptimizeTable = 'Optimaliseer tabel';
$strOptionalControls = 'Optioneel. Geeft aan hoe speciale karakters geschreven of gelezen moeten worden.'; // 'Optional. Controls how to write or read special characters.';
$strOptionally = 'OPTIONEEL';
$strOr = 'Of';
$strOverhead = 'Overhead';

$strPartialText = 'Gedeeltelijke teksten';
$strPassword = 'Wachtwoord';
$strPasswordEmpty = 'Het wachtwoord is leeg!';
$strPasswordNotSame = 'De wachtwoorden zijn niet gelijk!';
$strPHPVersion = 'PHP Versie';
$strPmaDocumentation = 'phpMyAdmin Documentatie';
$strPmaUriError = 'De <tt>$cfgPmaAbsoluteUri</tt> richtlijn MOET gezet zijn in het configuratie bestand!';
$strPos1 = 'Begin';
$strPrevious = 'Vorige';
$strPrimary = 'Primaire sleutel';
$strPrimaryKey = 'Primaire sleutel';
$strPrimaryKeyHasBeenDropped = 'De primaire sleutel is vervallen';
$strPrimaryKeyName = 'De naam van de primaire sleutel moet PRIMARY zijn!';
$strPrimaryKeyWarning = '("PRIMARY" <b>moet</b> de naam van en <b>alleen van</b> een primaire sleutel zijn!)';
$strPrintView = 'Printopmaak';
$strPrivileges = 'Rechten';
$strProperties = 'Eigenschappen';

$strQBE = 'Query opbouwen';
$strQBEDel = 'Verwijder';
$strQBEIns = 'Toevoegen';
$strQueryOnDb = 'SQL-query op database <b>%s</b>:';

$strReType = 'Type opnieuw';
$strRecords = 'Records';
$strReferentialIntegrity = 'Controleer referentiële integriteit';
$strReloadFailed = 'Opnieuw laden van MySQL mislukt.';
$strReloadMySQL = 'MySQL opnieuw laden.';
$strRememberReload = 'Vergeet niet de server opnieuw te starten.';
$strRenameTable = 'Tabel hernoemen naar';
$strRenameTableOK = 'Tabel %s is hernoemt naar %s';
$strRepairTable = 'Repareer tabel';
$strReplace = 'Vervangen';
$strReplaceTable = 'Vervang tabelgegevens met bestand';
$strReset = 'Opnieuw';
$strRevoke = 'Ongedaan maken';
$strRevokeGrant = 'Trek Grant recht in';
$strRevokeGrantMessage = 'U heeft het Grant recht ingetrokken voor %s';
$strRevokeMessage = 'U heeft de rechten ingetrokken voor %s';
$strRevokePriv = 'Trek rechten in';
$strRowLength = 'Rij lengte';
$strRowSize = ' Rij grootte ';
$strRows = 'Rijen';
$strRowsFrom = 'rijen beginnend bij';
$strRowsModeHorizontal = 'horizontaal';
$strRowsModeOptions = 'in %s modus en herhaal kopregels na %s cellen';
$strRowsModeVertical = 'verticaal';
$strRowsStatistic = 'Rij statistiek';
$strRunQuery = 'Query uitvoeren';
$strRunSQLQuery = 'Draai SQL query/queries op database %s';
$strRunning = 'wordt uitgevoerd op %s';
$strSQLQuery = 'SQL-query';

$strSave = 'Opslaan';
$strSelect = 'Selecteren';
$strSelectADb = 'Selecteer A.U.B. een database';
$strSelectAll = 'Selecteer alles';
$strSelectFields = 'Selecteer velden (tenminste 1):';
$strSelectNumRows = 'in query';
$strSend = 'verzenden';
$strServerChoice = 'Server keuze';
$strServerVersion = 'Server versie';
$strSetEnumVal = 'Als het veldtype "enum" of "set" is, voer dan de waardes in volgens dit formaat: \'a\',\'b\',\'c\'...<br />Als u ooit een backslash moet plaatsen ("\") of een enkel aanhalingsteken ("\'") bij deze waardes, backslash het (voorbeeld \'\\\\xyz\' of \'a\\\'b\').';
$strShow = 'Toon';
$strShowAll = 'Toon alles';
$strShowCols = 'Toon kolommen';
$strShowPHPInfo = 'Laat PHP informatie zien';
$strShowTables = 'Toon tabellen';
$strShowThisQuery = ' Laat deze query hier weer zien ';
$strShowingRecords = 'Toon Records';
$strSingly = '(apart)';
$strSize = 'Grootte';
$strSort = 'Sorteren';
$strSpaceUsage = 'Ruimte gebruik';
$strStartingRecord = 'Start record';
$strStatement = 'Opdrachten';
$strStrucCSV = 'CSV gegevens';
$strStrucData = 'Structuur en gegevens';
$strStrucDrop = '\'drop table\' toevoegen';
$strStrucExcelCSV = 'CSV voor MS Excel data';
$strStrucOnly = 'Alleen structuur';
$strSubmit = 'Verzenden';
$strSuccess = 'Uw SQL-query is succesvol uitgevoerd.';
$strSum = 'Som';

$strTable = 'Schoon de tabel ("FLUSH")';
$strTable = 'Tabel ';
$strTableComments = 'Tabel opmerkingen';
$strTableEmpty = 'De tabel naam is leeg!';
$strTableHasBeenDropped = 'Tabel %s is vervallen';
$strTableHasBeenEmptied = 'Tabel %s is leeg gemaakt';
$strTableHasBeenFlushed = 'Tabel %s is geschoond';
$strTableMaintenance = 'Tabel onderhoud';
$strTableStructure = 'Tabel structuur voor tabel';
$strTableType = 'Tabel type';
$strTables = '%s tabel(len)';
$strTextAreaLength = ' Vanwege z\'n lengte,<br /> is dit veld misschien niet te wijzigen ';
$strTheContent = 'De inhoud van uw bestand is ingevoegd.';
$strTheContents = 'De inhoud van het bestand vervangt de inhoud van de geselecteerde tabel voor rijen met een identieke primaire of unieke sleutel.';
$strTheTerminator = 'De afsluiter van de velden.';
$strTotal = 'totaal';
$strType = 'Type';

$strUncheckAll = 'Deselecteer alles';
$strUnique = 'Unieke waarde';
$strUnselectAll = 'Deselecteer alles';
$strUpdatePrivMessage = 'U heeft de rechten aangepast voor %s.';
$strUpdateProfile = 'Pas profiel aan:';
$strUpdateProfileMessage = 'Het profiel is aangepast.';
$strUpdateQuery = 'Wijzig Query';
$strUsage = 'Gebruik';
$strUseBackquotes = 'Gebruik backquotes (`) bij tabellen en velden\' namen';
$strUseTables = 'Gebruik tabellen';
$strUser = 'Gebruiker';
$strUserEmpty = 'De gebruikersnaam is leeg!';
$strUserName = 'Gebruikersnaam';
$strUsers = 'Gebruikers';

$strValue = 'Waarde';
$strViewDump = 'Bekijk een dump (schema) van tabel';
$strViewDumpDB = 'Bekijk een dump (schema) van database';

$strWelcome = 'Welkom op %s';
$strWithChecked = 'Met geselecteerd:';
$strWrongUser = 'Verkeerde gebruikersnaam/wachtwoord. Toegang geweigerd.';

$strYes = 'Ja';

$strZip = '"Gezipt"';

// To translate
?>
