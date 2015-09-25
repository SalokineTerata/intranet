<?php
/* $Id: slovenian-win1250.inc.php,v 1.1.2.1 2002/08/04 12:58:15 rabus Exp $ */

/* By: uros kositer <urosh@agenda.si> */

$charset = 'windows-1250';
$text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = '.';
$number_decimal_separator = ',';
$byteUnits = array('Bytes', 'KB', 'MB', 'GB');

$day_of_week = array('Ned', 'Pon', 'Tor', 'Sre', 'Èet', 'Pet', 'Sob');
$month = array('Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Avg', 'Sep', 'Okt', 'Nov', 'Dec');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%d %B %Y ob %I:%M %p';


$strAccessDenied = 'Dostop zavrnjen';
$strAction = 'Akcija';
$strAddDeleteColumn = 'Dodaj/Odstrani stolpec \'Polje\'';
$strAddDeleteRow = 'Dodaj/Odstrani vrstico \'Kriterij\'';
$strAddNewField = 'Dodaj novo polje';
$strAddPriv = 'Dodaj nov privilegij';
$strAddPrivMessage = 'Dodali ste nov privilegij.';
$strAddSearchConditions = 'Dodaj iskalne pogoje (telo "where" stavka):';
$strAddToIndex = 'Dodaj indeksu &nbsp;%s&nbsp;stolpec(ce)';
$strAddUser = 'Dodaj novega uporabnika';
$strAddUserMessage = 'Dodali ste novega uporabnika.';
$strAffectedRows = 'Spremenjene vrstice:';
$strAfter = 'Po %s';
$strAfterInsertBack = 'Nazaj na prejnjo stran';
$strAfterInsertNewInsert = 'Vstavi e eno novo vrstico';
$strAll = 'Vse/Vsi';
$strAlterOrderBy = 'Spremeni vrstni red prikaza tabele za';
$strAnalyzeTable = 'Analiziraj tabelo';
$strAnd = 'In';
$strAnIndex = 'Na %s je dodan indeks';
$strAny = 'Katerikoli';
$strAnyColumn = 'Katerikoli stolpec';
$strAnyDatabase = 'Katerakoli podatkovna baza';
$strAnyHost = 'Katerikoli gostitelj';
$strAnyTable = 'Katerakoli tabela';
$strAnyUser = 'Katerikoli uporabnik';
$strAPrimaryKey = 'Na %s je dodan primarni kljuè';
$strAscending = 'Naraèajoèe';
$strAtBeginningOfTable = 'Na zaèetku tabele';
$strAtEndOfTable = 'Na koncu tabele';
$strAttr = 'Atributi';

$strBack = 'Nazaj';
$strBinary = 'Binarno';
$strBinaryDoNotEdit = 'Binarno - ne urejaj';
$strBookmarkDeleted = 'Zaznamek je odstranjen.';
$strBookmarkLabel = 'Nalepka';
$strBookmarkQuery = 'Oznaèena SQL-poizvedba';
$strBookmarkThis = 'Oznaèi to SQL-poizvedbo';
$strBookmarkView = 'Samo pogled';
$strBrowse = 'Prebrskaj';
$strBzip = '"bzipano"';

$strCantLoadMySQL = 'ni mogoèe naloiti MySQL ekstenzij,<br /> prosimo, preverite PHP konfiguracijo.';
$strCantRenameIdxToPrimary = 'Indeksa ni mogoèe preimenovati v PRIMARY!';
$strCardinality = 'Kardinalnost';
$strCarriage = 'Znak za pomik na zaèetek vrste (Carriage return): \\r';
$strChange = 'Spremeni';
$strChangePassword = 'Spremeni geslo';
$strCheckAll = 'Oznaèi vse';
$strCheckDbPriv = 'Preveri privilegije podatkovne baze';
$strCheckTable = 'Preveri tabelo';
$strColumn = 'Stolpec';
$strColumnNames = 'Imena stolpcev';
$strCompleteInserts = 'Popolne \'insert\' poizvedbe';
$strConfirm = 'Ali res elite to storiti?';
$strCookiesRequired = 'Èe elite e dalje uporabljati program, morate omogoèiti pikotke.';
$strCopyTable = 'Kopiraj tabelo v (podatkovna_baza<b>.</b>tabela):';
$strCopyTableOK = 'Tabela %s je skopirana v %s.';
$strCreate = 'Ustvari';
$strCreateIndex = 'Ustvari indeks na&nbsp;%s&nbsp;stolpcih';
$strCreateIndexTopic = 'Ustvari nov indeks';
$strCreateNewDatabase = 'Ustvari novo podatkovno bazo';
$strCreateNewTable = 'Ustvari novo tabelo v podatkovni bazi %s';
$strCriteria = 'Kriteriji';

$strData = 'Podatki';
$strDatabase = 'Podatkovna baza ';
$strDatabaseHasBeenDropped = 'Podatkovna baza %s je zavrena.';
$strDatabases = 'podatkovne baze';
$strDatabasesStats = 'Statistika podatkovnih baz';
$strDatabaseWildcard = 'Podatkovna baza (nadomestni znaki dovoljeni):';
$strDataOnly = 'Samo podatki';
$strDefault = 'Privzeto';
$strDelete = 'Izbrii';
$strDeleted = 'Vrstica je izbrisana';
$strDeletedRows = 'Izbrisane vrstice:';
$strDeleteFailed = 'Brisanje ni uspelo!';
$strDeleteUserMessage = 'Izbrisali ste uporabnika %s.';
$strDescending = 'Padajoèe';
$strDisplay = 'Prikai';
$strDisplayOrder = 'Vrstni red prikaza:';
$strDoAQuery = 'Izvedi "query by example" (nadomestni znak: "%")';
$strDocu = 'Dokumentacija';
$strDoYouReally = 'Ali res elite ';
$strDrop = 'Zavri';
$strDropDB = 'Zavri podatkovno bazo %s';
$strDropTable = 'Zavri tabelo';
$strDumpingData = 'Odloi podatke za tabelo';
$strDynamic = 'dinamièno';

$strEdit = 'Uredi';
$strEditPrivileges = 'Uredi privilegije';
$strEffective = 'Uèinkovito';
$strEmpty = 'Izprazni';
$strEmptyResultSet = 'MySQL je vrnil kot rezultat prazno mnoico (npr. niè vrstic).';
$strEnd = 'Konec';
$strEnglishPrivileges = ' Opomba: Imena MySQL privilegijev so zapisana v angleèini ';
$strError = 'Napaka';
$strExtendedInserts = 'Razirjene \'insert\' poizvedbe';
$strExtra = 'Dodatno';

$strField = 'Polje';
$strFieldHasBeenDropped = 'Polje %s je zavreno';
$strFields = 'Polja';
$strFieldsEmpty = ' tevec polj je prazen! ';
$strFieldsEnclosedBy = 'Polja obdana z';
$strFieldsEscapedBy = 'Polja izognjena z';
$strFieldsTerminatedBy = 'Polja zakljuèena z';
$strFixed = 'fiksno';
$strFlushTable = 'Poèisti tabelo ("FLUSH")';
$strFormat = 'Oblika';
$strFormEmpty = 'V obliki manjka vrednost !';
$strFullText = 'Polna besedila';
$strFunction = 'Funkcija';

$strGenTime = 'Èas nastanka';
$strGo = 'Izvedi';
$strGrants = 'Dovoljenja';
$strGzip = '"gzipano"';

$strHasBeenAltered = 'je bil spremenjen(a).';
$strHasBeenCreated = 'je bil ustvarjen(a).';
$strHome = 'Domov';
$strHomepageOfficial = 'Uradna domaèa stran phpMyAdmin';
$strHomepageSourceforge = 'Sourceforge phpMyAdmin Download Page';
$strHost = 'Gostitelj';
$strHostEmpty = 'Ime gostitelja je prazno!';

$strIdxFulltext = 'Polno besedilo';
$strIfYouWish = 'Èe bi radi naloili samo nekatere stolpce tabele, jih navedite v seznamu, kjer jih loèite z vejico.';
$strIgnore = 'Prezri';
$strIndex = 'Indeks';
$strIndexes = 'Indeksi';
$strIndexHasBeenDropped = 'Indeks %s je zavren';
$strIndexName = 'Ime indeksa&nbsp;:';
$strIndexType = 'Vrsta indeksa&nbsp;:';
$strInsert = 'Vstavi';
$strInsertAsNewRow = 'Vstavi kot novo vrstico';
$strInsertedRows = 'Vstavljene vrstice:';
$strInsertNewRow = 'Vstavi novo vrstico';
$strInsertTextfiles = 'V tabelo vstavi podatke iz datoteke z besedilom';
$strInstructions = 'Navodila';
$strInUse = 'v uporabi';
$strInvalidName = 'beseda "%s" je rezervirana, zato je ne morete uporabiti kot ime podatkovne baze/tabele/polja.';

$strKeepPass = 'Ne spreminjaj gesla';
$strKeyname = 'Ime kljuèa';
$strKill = 'Ubij proces';

$strLanguage = 'Jezik';
$strLength = 'Dolina';
$strLengthSet = 'Dolina/Vrednosti*';
$strLimitNumRows = 'tevilo vrstic na stran';
$strLineFeed = 'Pomik v novo vrsto (Linefeed): \\n';
$strLines = 'Vrstice';
$strLinesTerminatedBy = 'Vrstice zakljuèene z';
$strLocationTextfile = 'Lokacija datoteke z besedilom';
$strLogin = 'Prijava';
$strLogout = 'Odjava';
$strLogPassword = 'Geslo:';
$strLogUsername = 'Uporabniko ime:';

$strModifications = 'Spremembe so shranjene';
$strModify = 'Spremeni';
$strModifyIndexTopic = 'Spremeni indeks';
$strMoveTable = 'Premakni tabelo v (podatkovna_baza<b>.</b>tabela):';
$strMoveTableOK = 'Tabela %s je bila premaknjena v %s.';
$strMySQLReloaded = 'MySQL ponovno naloen.';
$strMySQLSaid = 'MySQL je vrnil: ';
$strMySQLServerProcess = 'MySQL %pma_s1% teèe na %pma_s2% kot %pma_s3%';
$strMySQLShowProcess = 'Pokai procese';
$strMySQLShowStatus = 'Pokai tekoèe informacije o MySQL';
$strMySQLShowVars = 'Pokai sistemske spremenljivke MySQL';

$strName = 'Ime';
$strNext = 'Naslednji';
$strNo = 'Ne';
$strNoDatabases = 'Brez podatkovnih baz';
$strNoDropDatabases = '"DROP DATABASE" poizvedbe so izkljuèene.';
$strNoFrames = 'phpMyAdmin je prijazneji z brskalnikom, ki podpira okvirje.';
$strNoIndex = 'Ni definiranega indeksa!';
$strNoIndexPartsDefined = 'Ni definiranega dela indeksa!';
$strNoModification = 'Brez sprememb';
$strNone = 'Brez';
$strNoPassword = 'Brez gesla';
$strNoPrivileges = 'Brez privilegijev';
$strNoQuery = 'Brez SQL poizvedbe!';
$strNoRights = 'Nimate dovolj pravic, da bi bili sedaj tukaj!';
$strNoTablesFound = 'V podatkovni bazi ni mogoèe najti tabel.';
$strNotNumber = 'To ni tevilo!';
$strNotValidNumber = ' ni veljavna tevilka vrstice!';
$strNoUsersFound = 'Ni mogoèe najti uporabnika(ov).';
$strNull = 'Null';

$strOftenQuotation = 'Pogosti narekovaji. OPCIJSKO pomeni, da so samo polja tipa \'char\' in \'varchar\' obdana s temi znaki.';
$strOptimizeTable = 'Optimiraj tabelo';
$strOptionalControls = 'Opcijsko. Narekuje naèin pisanja in branja posebnih znakov.';
$strOptionally = 'OPCIJSKO';
$strOr = 'Ali';
$strOverhead = 'Preseek';

$strPartialText = 'Delna besedila';
$strPassword = 'Geslo';
$strPasswordEmpty = 'Geslo je prazno!';
$strPasswordNotSame = 'Gesli se ne ujemata!';
$strPHPVersion = 'Razlièica PHP';
$strPmaDocumentation = 'phpMyAdmin dokumentacija';
$strPmaUriError = 'Ukaz <tt>$cfgPmaAbsoluteUri</tt> mora biti definiran v konfiguracijski datoteki!';
$strPos1 = 'Zaèetek';
$strPrevious = 'Prejnji';
$strPrimary = 'Primarni';
$strPrimaryKey = 'Primarni kljuè';
$strPrimaryKeyHasBeenDropped = 'Primarni kljuè je zavren';
$strPrimaryKeyName = 'Ime primarnega kljuèa mora biti... PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>mora</b> biti ime <b>samo</b> primarnega kljuèa!)';
$strPrintView = 'Pogled postavitve tiskanja';
$strPrivileges = 'Privilegiji';
$strProperties = 'Lastnosti';

$strQBE = 'Poizvedba';
$strQBEDel = 'Brii';
$strQBEIns = 'Vstavi';
$strQueryOnDb = 'SQL-poizvedba na podatkovni bazi <b>%s</b>:';

$strRecords = 'Zapisi';
$strReferentialIntegrity = 'Preveri referenèno integriteto:';
$strReloadFailed = 'Ponovno nalaganje MySQL ni uspelo.';
$strReloadMySQL = 'Ponovno naloi MySQL';
$strRememberReload = 'Ne pozabite ponovno naloiti strenika.';
$strRenameTable = 'Preimenuj tabelo v';
$strRenameTableOK = 'Tabela %s je preimenovana v %s';
$strRepairTable = 'Popravi tabelo';
$strReplace = 'Zamenjaj';
$strReplaceTable = 'Podatke v tabeli zamenjaj z datoteko';
$strReset = 'Ponastavi';
$strReType = 'Ponovno vnesi';
$strRevoke = 'Odvzemi';
$strRevokeGrant = 'Odvzemi dovoljenje';
$strRevokeGrantMessage = 'Odvzeli ste dovoljenje (Grant) za %s';
$strRevokeMessage = 'Odvzeli ste privilegije za %s';
$strRevokePriv = 'Odvzemi privilegije';
$strRowLength = 'Dolina vrstice';
$strRows = 'Vrstice';
$strRowsFrom = 'vrstice naprej od zapisa #';
$strRowSize = ' Velikost vrstice ';
$strRowsModeHorizontal = 'vodoravnem';
$strRowsModeOptions = 'v %s naèinu in ponovi glavo po %s celicah';
$strRowsModeVertical = 'navpiènem';
$strRowsStatistic = 'Statistika vrstic';
$strRunning = 'teèe na %s';
$strRunQuery = 'Izvedi poizvedbo';
$strRunSQLQuery = 'Izvedi SQL poizvedbo/poizvedbe na podatkovni bazi %s';

$strSave = 'Shrani';
$strSelect = 'Izberi';
$strSelectADb = 'Prosimo, izberite podatkovno bazo';
$strSelectAll = 'Izberi vse';
$strSelectFields = 'Izberite polja (vsaj eno):';
$strSelectNumRows = 'in poizvedba';
$strSend = 'Shrani kot datoteko';
$strServerChoice = 'Izbira strenika';
$strServerVersion = 'Razlièica strenika';
$strSetEnumVal = 'Èe je polje vrste "enum" ali "set", navedite vrednosti v obliki: \'a\',\'b\',\'c\'...<br /> Èe elite med vrednostmi uporabiti poevnico ("\") ali enojni narekovaj ("\'"), pred tem znakom vnesite poevnico (n.pr. \'\\\\xyz\' ali \'a\\\'b\').';
$strShow = 'Pokai';
$strShowAll = 'Pokai vse';
$strShowCols = 'Pokai stolpce';
$strShowingRecords = 'Prikazujem vrstice';
$strShowPHPInfo = 'Pokai podatke o PHP';
$strShowTables = 'Pokai tabele';
$strShowThisQuery = ' Ponovno pokai poizvedbo v tem oknu ';
$strSingly = '(posamezno)';
$strSize = 'Velikost';
$strSort = 'Sortiraj';
$strSpaceUsage = 'Poraba prostora';
$strSQLQuery = 'SQL-poizvedba';
$strStatement = 'Izjave';
$strStrucCSV = 'CSV podatki';
$strStrucData = 'Struktura in podatki';
$strStrucDrop = 'Dodaj \'drop table\' poizvedbo';
$strStrucExcelCSV = 'CSV podatki za Ms Excel';
$strStrucOnly = 'Samo struktura';
$strSubmit = 'Polji';
$strSuccess = 'SQL-poizvedba je bila uspeno izvedena';
$strSum = 'Vsota';

$strTable = 'tabela ';
$strTableComments = 'Komentar tabele';
$strTableEmpty = 'Ime tabele je prazno!';
$strTableHasBeenDropped = 'Tabela %s je zavrena';
$strTableHasBeenEmptied = 'Tabela %s je izpraznjena';
$strTableHasBeenFlushed = 'Tabela %s je osveena';
$strTableMaintenance = 'Vzdrevanje tabele';
$strTables = '%s tabel';
$strTableStructure = 'Struktura tabele';
$strTableType = 'Vrsta tabele';
$strTextAreaLength = ' Zaradi njegove doline<br /> polja ne bo mogoèe urejati ';
$strTheContent = 'Vsebina datoteke je vneena.';
$strTheContents = 'Vsebina datoteke zamenja vsebino izbrane tabele v vrsticah z identiènim primarnim ali unikatnim kljuèem.';
$strTheTerminator = 'Zakljuèni znak polj.';
$strTotal = 'skupaj';
$strType = 'Vrsta';

$strUncheckAll = 'Odznaèi vse';
$strUnique = 'Unikaten';
$strUnselectAll = 'Preklièi izbor vsega';
$strUpdatePrivMessage = 'Posodobili ste privilegije za %s.';
$strUpdateProfile = 'Posodobi profil:';
$strUpdateProfileMessage = 'Profil je posodobljen.';
$strUpdateQuery = 'Osvei poizvedbo';
$strUsage = 'Uporaba';
$strUseBackquotes = 'Obdaj imena tabel in polj z enojnimi poevnimi narekovaji';
$strUser = 'Uporabnik';
$strUserEmpty = 'Uporabniko ime je prazno!';
$strUserName = 'Uporabniko ime';
$strUsers = 'Uporabniki';
$strUseTables = 'Uporabi tabele';

$strValue = 'Vrednost';
$strViewDump = 'Preglej dump (shemo) tabele';
$strViewDumpDB = 'Preglej dump (shemo) podatkovne baze';

$strWelcome = 'Dobrodoli v %s';
$strWithChecked = 'Z oznaèenim:';
$strWrongUser = 'Napaèno uporabniko ime/geslo. Dostop zavrnjen.';

$strYes = 'Da';

$strZip = '"zipano"';

// To translate
$strNbRecords = 'Number of rows'; //to translate
$strStartingRecord = 'Starting row'; //to translate
?>
