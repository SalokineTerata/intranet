<?php
/* $Id: indonesian.inc.php,v 1.3.2.1 2002/05/22 21:35:08 loic1 Exp $ */

$charset = 'iso-8859-1';
$text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = '.';
$number_decimal_separator = ',';
$byteUnits = array('Bytes', 'KB', 'MB', 'GB');

$day_of_week = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
$month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%d. %B %Y um %H:%M';


$strAccessDenied = 'Akses ditolak';
$strAction = 'Aksi';
$strAddDeleteColumn = 'Tambah/Hapus kolom';
$strAddDeleteRow = 'Tambah/Hapus baris';
$strAddNewField = 'Tambah field baru';
$strAddPriv = 'Tambah hak baru';
$strAddPrivMessage = 'Hak baru telah ditambah.';
$strAddSearchConditions = 'Tambah syarat pencarian (Argumen untuk WHERE-Statement):';
$strAddToIndex = 'Tambah &nbsp;%s&nbsp;kolom ke indeks';
$strAddUser = 'Tambah User baru';
$strAddUserMessage = 'User baru telah ditambah.';
$strAffectedRows = 'Baris yang bersangkutan:';
$strAfter = 'Sisipkan setelah %s';
$strAfterInsertBack = 'Kembali';
$strAfterInsertNewInsert = 'Tambah data baru';
$strAll = 'Seluruh';
$strAlterOrderBy = 'Sortir tabel berdasarkan';
$strAnalyzeTable = 'Analisa tabel';
$strAnd = 'dan';
$strAnIndex = 'Indeks telah ditambah ke %s';
$strAny = 'Setiap';
$strAnyColumn = 'Setiap kolom';
$strAnyDatabase = 'Setiap database';
$strAnyHost = 'Setiap host';
$strAnyTable = 'Setiap tabel';
$strAnyUser = 'Setiap user';
$strAPrimaryKey = 'Primary key telah ditambah di %s';
$strAscending = 'Urutan naik';
$strAtBeginningOfTable = 'di awal tabel';
$strAtEndOfTable = 'di akhir tabel';
$strAttr = 'Atribut';

$strBack = 'Kembali';
$strBinary = 'Binary';
$strBinaryDoNotEdit = 'Binary - jangan di-edit';
$strBookmarkDeleted = 'Bookmark telah dihapus.';
$strBookmarkLabel = 'Judul';
$strBookmarkQuery = 'SQL-query yang di-bookmark ';
$strBookmarkThis = 'Bookmark SQL-query ini';
$strBookmarkView = 'View only';
$strBrowse = 'Browse';
$strBzip = '"Dikompress dengan BZip"';

$strCantLoadMySQL = 'Gagal loading extension untuk MySQL,<br />mohon periksa kembali konfigurasi PHP.';
$strCantRenameIdxToPrimary = 'Gagal ubah nama Indeks ke PRIMARY!';
$strCardinality = 'Kardinalitas';
$strCarriage = 'Carriage return: \\r';
$strChange = 'Ubah';
$strChangePassword = 'Ubah Kata Sandi';
$strCheckAll = 'Pilih semua';
$strCheckDbPriv = 'Periksa Hak Akses dari Database';
$strCheckTable = 'Periksa tabel';
$strColumn = 'Kolom';
$strColumnNames = 'Nama kolom';
$strCompleteInserts = 'INSERT lengkap';
$strConfirm = 'Apakah Anda yakin?';
$strCookiesRequired = 'Mulai dari sini, fungsi Cookies harus aktif.';
$strCopyTable = 'Salin tabel ke (database<b>.</b>nama tabel):';
$strCopyTableOK = 'Tabel %s telah disalin ke %s.';
$strCreate = 'Buat';
$strCreateIndex = 'Buat indeks diatas&nbsp;%s&nbsp;kolom';
$strCreateIndexTopic = 'Bikin indeks baru';
$strCreateNewDatabase = 'Bangun database baru';
$strCreateNewTable = 'Buat tabel baru di database %s';
$strCriteria = 'Kriteria';

$strData = 'Data';
$strDatabase = 'Database ';
$strDatabaseHasBeenDropped = 'Database %s telah dihapus.';
$strDatabases = 'database';
$strDatabasesStats = 'Statistik dari seluruh Database';
$strDatabaseWildcard = 'Database (wildcards diperbolehkan):';
$strDataOnly = 'Data saja';
$strDefault = 'Default';
$strDelete = 'Hapus';
$strDeleted = 'Baris telah dihapus';
$strDeletedRows = 'Baris yang dihapus:';
$strDeleteFailed = 'Penghapusan gagal!';
$strDeleteUserMessage = 'User %s telah dihapus.';
$strDescending = 'Urutan turun';
$strDisplay = 'Tampilkan';
$strDisplayOrder = 'Urutan berdasarkan:';
$strDoAQuery = 'Cari dengan data contoh ("query by example") (wildcard: "%")';
$strDocu = 'Dokumentasi';
$strDoYouReally = 'Anda benar ingin ';
$strDrop = 'Hapus';
$strDropDB = 'Hapus database %s';
$strDropTable = 'Hapus tabel:';
$strDumpingData = 'Data untuk tabel';
$strDynamic = 'dinamis';

$strEdit = 'Ubah';
$strEditPrivileges = 'Ubah hak akses';
$strEffective = 'Efektif';
$strEmpty = 'Tutup';
$strEmptyResultSet = 'MySQL balikkan hasil kosong (a.k. data yang kosong).';
$strEnd = 'End';
$strEnglishPrivileges = ' Perhatian: Nama privilege MySQL dalam bahasa Ingris ';
$strError = 'Error';
$strExtendedInserts = 'INSERT yang leluas';
$strExtra = 'Extra';

$strField = 'Field';
$strFieldHasBeenDropped = 'Field %s telah dihapus';
$strFields = 'Fields';
$strFieldsEmpty = ' Jumlah field dalam tabel harus ditentukan! ';
$strFieldsEnclosedBy = 'Field yang dibatasi oleh';
$strFieldsEscapedBy = 'Field yang di-escape oleh';
$strFieldsTerminatedBy = 'Fields yang dipisah oleh';
$strFixed = 'fixed';
$strFlushTable = 'Tutup tabel ("FLUSH")';
$strFormat = 'Format';
$strFormEmpty = 'Kurang data dalam form !';
$strFullText = 'Full Text';
$strFunction = 'Fungsi';

$strGenTime = 'Tanggal pembuatan';
$strGo = 'Ok';
$strGrants = 'Hak (Grants)';
$strGzip = '"Dikompress dengan GZip"';

$strHasBeenAltered = 'telah dirubah.';
$strHasBeenCreated = 'telah dibuat.';
$strHome = 'Home';
$strHomepageOfficial = 'Homepage resmi phpMyAdmin';
$strHomepageSourceforge = 'Sourceforge phpMyAdmin Download Page';
$strHost = 'Host';
$strHostEmpty = 'Hostname harus diisi!';

$strIdxFulltext = 'Fulltext';
$strIfYouWish = 'Jika hanya kolom tertentu perlu diimpor, silakan ketik disini dengan tanda koma sebagai separator.';
$strIgnore = 'Mengabaikan';
$strIndex = 'Indeks';
$strIndexes = 'Indeks';
$strIndexHasBeenDropped = 'Indeks %s telah dihapus';
$strIndexName = 'Indeks name&nbsp;:';
$strIndexType = 'Indeks type&nbsp;:';
$strInsert = 'Tambah';
$strInsertAsNewRow = 'Tambah sebagai baris baru';
$strInsertedRows = 'Baris yang ditambah:';
$strInsertNewRow = 'Tambah baris baru';
$strInsertTextfiles = 'Tambah data baru dari textfile ke tabel';
$strInstructions = 'Instruksi';
$strInUse = 'dipakai';
$strInvalidName = '"%s" adalah kata khusus dan tidak dapat dipergunakan sebagai nama database,tabel atau field.';

$strKeepPass = 'Kata Sandi tidak dirubah';
$strKeyname = 'Keyname';
$strKill = 'Tutup';

$strLength = 'Ukuran';
$strLengthSet = 'Ukuran/Nilai*';
$strLimitNumRows = 'Garis per halaman';
$strLineFeed = 'Linefeed: \\n';
$strLines = 'Garis';
$strLinesTerminatedBy = 'Garis yang dipisah oleh';
$strLocationTextfile = 'Lokasi dari textfile';
$strLogin = 'Login';
$strLogout = 'Logout';
$strLogPassword = 'Kata Sandi:';
$strLogUsername = 'Nama User:';

$strModifications = 'Modifikasi telah disimpan';
$strModify = 'Ubah';
$strModifyIndexTopic = 'Ubah indeks';
$strMoveTable = 'Pindahkan tabel ke (database<b>.</b>tabel):';
$strMoveTableOK = 'Tabel %s telah dipindahkan ke %s.';
$strMySQLReloaded = 'MySQL telah di-reload.';
$strMySQLSaid = 'MySQL menyatakan: ';
$strMySQLServerProcess = 'MySQL %pma_s1% di %pma_s2% sebagai %pma_s3%';
$strMySQLShowProcess = 'Tampilkan Proses';
$strMySQLShowStatus = 'Tampilkan informasi runtime dari MySQL';
$strMySQLShowVars = 'Tampilkan system variables dari MySQL';

$strName = 'Nama';
$strNbRecords = 'Jumlah baris';
$strNext = 'Berikut';
$strNo = 'Tidak';
$strNoDatabases = 'Database tidak ditemukan';
$strNoDropDatabases = 'Perintah "DROP DATABASE" di-nonaktifkan.';
$strNoFrames = 'phpMyAdmin berfungsi lebih baik dengan tipe browser yang memiliki fungsi <b>frames-capable</b>.';
$strNoIndex = 'Indeks tidak ditentukan!';
$strNoIndexPartsDefined = 'Index parts tidak ditentukan!';
$strNoModification = 'Tidak ada perubahan';
$strNone = 'tanpa';
$strNoPassword = 'Tanpa Kata Sandi';
$strNoPrivileges = 'Tanpa Hak Akses';
$strNoQuery = 'Tidak ada SQL-query!';
$strNoRights = 'Hak Akses Anda untuk lanjut tidak cukup!';
$strNoTablesFound = 'Tidak ada tabel ditemukan dalam database.';
$strNotNumber = 'Ini bukan angka!';
$strNotValidNumber = ' bukan nomor baris yang berlaku!';
$strNoUsersFound = 'User tidak ditemukan.';
$strNull = 'Nol';

$strOftenQuotation = 'Banyak tanda kutip. OPTIONALLY berarti hanya field char dan varchar yang ditutup oleh karakter "enclosed by" tersebut.';
$strOptimizeTable = 'Optimasikan tabel';
$strOptionalControls = 'Pilihan. Mengontrol cara tulis dan baca karakter khusus.';
$strOptionally = 'OPTIONALLY';
$strOr = 'Atau';
$strOverhead = 'Kelebihan';

$strPartialText = 'Teks yang disingkat';
$strPassword = 'Kata Sandi';
$strPasswordEmpty = 'Kata Sandi tidak diisi!';
$strPasswordNotSame = 'Kata Sandi tidak sama!';
$strPHPVersion = 'Versi PHP';
$strPmaDocumentation = 'Dokumentasi phpMyAdmin';
$strPmaUriError = 'Directive <tt>$cfgPmaAbsoluteUri</tt> WAJIB untuk diset dalam file konfigurasi!';
$strPos1 = 'Awal';
$strPrevious = 'Sebelumnya';
$strPrimary = 'Primary';
$strPrimaryKey = 'Primary key';
$strPrimaryKeyHasBeenDropped = 'Primary key telah dihapus';
$strPrimaryKeyName = 'Nama primary key harus... PRIMARY!';
$strPrimaryKeyWarning = '(Tanda nama "PRIMARY" <b>wajib</b> sebagai nama pertama dan <b>hanya</b> sebagai primary key saja!)';
$strPrintView = 'Pandangan cetak';
$strPrivileges = 'Hak Akses';
$strProperties = 'Properties';

$strQBE = 'Cari dengan data contoh';
$strQBEDel = 'Del';
$strQBEIns = 'Ins';
$strQueryOnDb = 'SQL-query dalam database <b>%s</b>:';

$strRecords = 'Catatan';
$strReferentialIntegrity = 'Periksa integritas referensial:';
$strReloadFailed = 'Reloading MySQL gagal.';
$strReloadMySQL = 'Reload MySQL';
$strRememberReload = 'Jangan lupa reload server.';
$strRenameTable = 'Ubah nama tabel ke ';
$strRenameTableOK = 'Nama tabel %s telah diubah menjadi %s';
$strRepairTable = 'Perbaiki tabel';
$strReplace = 'Ganti';
$strReplaceTable = 'Timpah data tabel dengan data dari file';
$strReset = 'Reset';
$strReType = 'Ketik ulang';
$strRevoke = 'Cabut';
$strRevokeGrant = 'Cabut hak akses berstatus Grant';
$strRevokeGrantMessage = 'Hak akses berstatus Grant untuk %s telah dicabut';
$strRevokeMessage = 'Hak akses untuk %s telah dicabut';
$strRevokePriv = 'Cabut hak akses';
$strRowLength = 'Ukuran baris';
$strRows = 'Baris';
$strRowsFrom = 'data mulai dari';
$strRowSize = ' Ukuran baris ';
$strRowsModeHorizontal = 'horisontal';
$strRowsModeOptions = 'diatur dengan urutan %s dan header diulang setiap %s sel.';
$strRowsModeVertical = 'vertikal';
$strRowsStatistic = 'Statistik Baris';
$strRunning = 'di %s';
$strRunQuery = 'Jalankan perintah SQL';
$strRunSQLQuery = 'Jalankan perintah SQL dalam database %s';

$strSave = 'Simpan';
$strSelect = 'Pilih';
$strSelectADb = 'Silakan pilih database';
$strSelectAll = 'Pilih semua';
$strSelectFields = 'Pilih fields (min. satu):';
$strSelectNumRows = 'dalam susunan pemeriksaan';
$strSend = 'Kirim ke';
$strServerChoice = 'Pilih Server';
$strServerVersion = 'Versi Server';
$strSetEnumVal = 'Jika tipe field sama dengan "enum" atau "set", silakan isi nilai dengan format: \'a\',\'b\',\'c\'...<br />Jika sebuah backslash ("\") atau satu tanda kutip ("\'") diperlukan, tanda tersebut perlu ditutupi dengan tanda backslash (seb. contoh \'\\\\xyz\' atau \'a\\\'b\').';
$strShow = 'Tampilkan';
$strShowAll = 'Tampilkan semua';
$strShowCols = 'Tampilkan kolom';
$strShowingRecords = 'Tampilan baris';
$strShowPHPInfo = 'Tampilkan informasi tentang PHP';
$strShowTables = 'Tampilkan tabel';
$strShowThisQuery = ' Tampilkan ulang perintah SQL disini ';
$strSingly = '(unik)';
$strSize = 'Ukuran';
$strSort = 'Urutkan';
$strSpaceUsage = 'Pemakaian ruang';
$strSQLQuery = 'Perintah SQL';
$strStartingRecord = 'Baris awal';
$strStatement = 'Pernyataan';
$strStrucCSV = 'Data CSV';
$strStrucData = 'Struktur dan data';
$strStrucDrop = 'Tambah \'Hapus tabel\'';
$strStrucExcelCSV = 'CSV untuk data Ms Excel';
$strStrucOnly = 'Struktur saja';
$strSubmit = 'Kirim';
$strSuccess = 'Perintah SQL telah diproses dengan sukses';
$strSum = 'Jumlah';

$strTable = 'Tabel ';
$strTableComments = 'Komentar tabel';
$strTableEmpty = 'Nama tabel masih kosong!';
$strTableHasBeenDropped = 'Tabel %s telah dihapus';
$strTableHasBeenEmptied = 'Tabel %s telah dikosongkan';
$strTableHasBeenFlushed = 'Tabel %s telah ditutup dan data tersimpan';
$strTableMaintenance = 'Perawatan tabel';
$strTables = '%s tabel';
$strTableStructure = 'Struktur tabel dalam tabel';
$strTableType = 'Tipe tabel';
$strTextAreaLength = ' Sehubungan dengan ukuran yang sangat panjang,<br /> field ini tidak dapat di-edit ulang. ';
$strTheContent = 'Isi file telah ditambah.';
$strTheContents = 'Isi dari file yang dipilih akan menganti isi dari tabel untuk baris dengan primary atau unique key yang identik.';
$strTheTerminator = 'Pemisah antara fields.';
$strTotal = 'jumlah';
$strType = 'Tipe';

$strUncheckAll = 'Uncheck semua';
$strUnique = 'Unik';
$strUnselectAll = 'Unselect semua';
$strUpdatePrivMessage = 'Hak Akses untuk %s telah diubah.';
$strUpdateProfile = 'Update profil user:';
$strUpdateProfileMessage = 'Profil user telah di-update.';
$strUpdateQuery = 'Update proses pencarian';
$strUsage = 'Pemakaian';
$strUseBackquotes = 'Nama tabel dan nama field dengan tanda kutip biasa';
$strUser = 'User';
$strUserEmpty = 'Username masih kosong!';
$strUserName = 'Username';
$strUsers = 'User';
$strUseTables = 'Tabel yang dipakai';

$strValue = 'Nilai';
$strViewDump = 'Tampilkan Dump (Skema) dari tabel';
$strViewDumpDB = 'Tampilkan Dump (Skema) dari database';

$strWelcome = 'Selamat Datang di %s';
$strWithChecked = 'Yang ditanda:';
$strWrongUser = 'Username/Kata Sandi salah. Akses ditolak.';

$strYes = 'Ya';

$strZip = '"Dikompress dengan Zip"';

?>
