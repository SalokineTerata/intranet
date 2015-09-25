<?php
/* $Id: spanish.inc.php,v 1.120 2002/04/12 17:05:35 lem9 Exp $ */

$charset = 'iso-8859-1';
$text_dir = 'ltr';
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
$byteUnits = array('Bytes', 'KB', 'MB', 'GB');

$day_of_week = array('Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab');
$month = array('Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');
// Ver http://www.php.net/manual/es/function.strftime.php para definir
// la variable siguiente
$datefmt = '%d-%m-%Y a les %H:%M:%S';

$strAccessDenied = 'Acceso denegado ';
$strAction = 'Acci&oacute;n';
$strAddDeleteColumn = 'A&ntilde;adir/borrar columna de criterio';
$strAddDeleteRow = 'A&ntilde;adir/borrar fila de criterio';
$strAddNewField = 'Insertar nuevo campo';
$strAddPriv = 'Agregar nuevo privilegio';
$strAddPrivMessage = 'Ud. ha a&ntilde;adido un nuevo privilegio.';
$strAddSearchConditions = 'Insertar condiciones de b&uacute;squeda (cuerpo de la clausula "where"):';
$strAddToIndex = 'A&ntilde;adido al indice &nbsp;%s&nbsp;columna(s)';
$strAddUser = 'Agregar nuevo usuario';
$strAddUserMessage = 'Ud. ha agregado un nuevo usuario.';
$strAffectedRows = 'Filas afectadas: ';
$strAfter = 'Despues de %s';
$strAfterInsertBack = 'Volver';
$strAfterInsertNewInsert = 'Insertar un nuevo registro';
$strAll = 'Todos/as';
$strAlterOrderBy = 'Modificar el Order By de la tabla';
$strAnalyzeTable = 'Analizar tabla';
$strAnd = 'Y';
$strAnIndex = 'Un indice ha sido a&ntilde;adido en %s';
$strAny = 'cualquiera';
$strAnyColumn = 'Cualquier columna';
$strAnyDatabase = 'Cualquier base de datos';
$strAnyHost = 'Cualquier servidor';
$strAnyTable = 'Cualquier tabla';
$strAnyUser = 'Cualquier usuario';
$strAPrimaryKey = 'Una clave primaria ha sido a&ntilde;adida en %s';
$strAscending = 'Ascendente';
$strAtBeginningOfTable = 'Al comienzo de la tabla';
$strAtEndOfTable = 'Al final de la tabla';
$strAttr = 'Atributos';

$strBack = 'Volver';
$strBinary = ' Binario ';
$strBinaryDoNotEdit = ' Binario - no editar! ';
$strBookmarkDeleted = 'El bookmark ha sido borrado.';
$strBookmarkLabel = 'Etiqueta';
$strBookmarkQuery = 'Consulta guardada en favoritos';
$strBookmarkThis = 'Guardar esta consulta en favoritos';
$strBookmarkView = 'Solamente ver';
$strBrowse = 'Examinar';
$strBzip = '"Comprimido con bzip"';

$strCantLoadMySQL = 'imposible cargar extension MySQL,<br />por favor revise la configuracion de PHP.';
$strCantRenameIdxToPrimary = 'No puedes renombrar el indice a PRIMARY!';
$strCardinality = 'Cardinalidad';
$strCarriage = 'Retorno de carro: \\r';
$strChange = 'Cambiar';
$strChangePassword = 'Cambio de contraseqa';
$strCheckAll = 'Revisar todos/as';
$strCheckDbPriv = 'Revisar privilegios de la base de datos';
$strCheckTable = 'Revisar tabla';
$strColumn = 'Columna';
$strColumnNames = 'Nombre de columnas';
$strCompleteInserts = 'Completar los Inserts';
$strConfirm = 'Realmente quieres hacerlo?';
$strCookiesRequired = 'Las Cookies deben ser habilitadas pasado este punto.';
$strCopyTable = 'Copia tabla a (Base de Datos<b>.</b>tabla):';
$strCopyTableOK = 'La tabla %s ha sido copiada a %s.';
$strCreate = 'Crear';
$strCreateIndex = 'Crear un indice en&nbsp;%s&nbsp;columnas';
$strCreateIndexTopic = 'Crear un nuevo indice';
$strCreateNewDatabase = 'Crear nueva base de datos';
$strCreateNewTable = 'Crear nueva tabla en base de datos %s';
$strCriteria = 'Criterio';

$strData = 'Datos';
$strDatabase = 'Base De Datos ';
$strDatabaseHasBeenDropped = 'La Base de datos %s ha sido eliminada.';
$strDatabases = 'Bases de datos';
$strDatabasesStats = 'Estadisticas de la base';
$strDatabaseWildcard = 'Bases de Datos (se permiten comodines):';
$strDataOnly = 'Solo datos';
$strDefault = 'Defecto';
$strDelete = 'Borrar';
$strDeleted = 'La fila se ha borrado';
$strDeletedRows = 'Filas Borradas: ';
$strDeleteFailed = 'La operacion de borrado ha fallado!';
$strDeleteUserMessage = 'Ud. ha borrado el usuario %s.';
$strDescending = 'Descendente';
$strDisplay = 'Mostrar';
$strDisplayOrder = 'Mostrar en este orden:';
$strDoAQuery = 'Realizar una "consulta de ejemplo" (wildcard: "%")';
$strDocu = 'Documentaci&oacute;n';
$strDoYouReally = 'Desea realmente hacer  ';
$strDrop = 'Eliminar';
$strDropDB = 'Eliminar base de datos %s';
$strDropTable = 'Borrar Tabla';
$strDumpingData = 'Volcar la base de datos para la tabla';
$strDynamic = 'dinamico/a';

$strEdit = 'Editar';
$strEditPrivileges = 'Editar Privilegios';
$strEffective = 'Efectivo/a';
$strEmpty = 'Vaciar';
$strEmptyResultSet = 'MySQL ha devuelto un valor vac&iacute;o (i.e. cero columnas).';
$strEnd = 'Fin';
$strEnglishPrivileges = ' Nota: Los nombres de privilegios de MySQL estan expresados en Ingles ';
$strError = 'Error';
$strExtendedInserts = 'Inserts Extendidos';
$strExtra = 'Extra';

$strField = 'Campo';
$strFieldHasBeenDropped = 'El campo %s ha sido eliminado';
$strFields = 'Campos';
$strFieldsEmpty = ' El numero de campos esta vacio! ';
$strFieldsEnclosedBy = 'Campos encerrados por';
$strFieldsEscapedBy = 'Campos escapados por';
$strFieldsTerminatedBy = 'Campos terminados en';
$strFixed = 'fijo';
$strFlushTable = 'Vaciar el caché de la tabla ("FLUSH")';
$strFormat = 'Formato';
$strFormEmpty = 'Falta un valor en el formulario !';
$strFullText = 'Textos completos';
$strFunction = 'Funci&oacute;n';

$strGenTime = 'Tiempo de Generacion';
$strGo = 'Sigue';
$strGrants = 'Permisos';
$strGzip = '"Comprimido con gzip"';

$strHasBeenAltered = 'se ha Modificado.';
$strHasBeenCreated = 'se ha creado.';
$strHome = 'Home';
$strHomepageOfficial = 'Pagina Oficial de phpMyAdmin';
$strHomepageSourceforge = 'Descargar phpMyAdmin de Sourceforge';
$strHost = 'servidor';
$strHostEmpty = 'El nombre del servidor esta vacio!!';

$strIdxFulltext = 'Texto completo';
$strIfYouWish = 'Si deseas cargar solo una de las columnas de la tabla, espedificar una coma separando los campos.';
$strIgnore = 'Ignorar';
$strIndex = 'Indice';
$strIndexes = 'Indices';
$strIndexHasBeenDropped = 'El indice %s ha sido eliminado';
$strIndexName = 'Nombre del Indice&nbsp;:';
$strIndexType = 'Tipo del Indice&nbsp;:';
$strInvalidName = '"%s" es una palabra reservada, no puedes usarla como nombre de /Base de datos/tabla/campo.';
$strInsert = 'Insertar';
$strInsertAsNewRow = 'Insertar como una nueva fila';
$strInsertedRows = 'Filas Insertadas:';
$strInsertNewRow = 'Insertar nueva fila';
$strInsertTextfiles = 'Insertar archivo de texto en la tabla';
$strInstructions = 'Instrucciones';
$strInUse = 'en uso';

$strKeepPass = 'No cambiar la contrase&ntilde;a';
$strKeyname = 'Nombre de la clave';
$strKill = 'Matar proceso';

$strLength = 'Longitud';
$strLengthSet = 'Longitud/Valores*';
$strLimitNumRows = 'registros por pagina';
$strLineFeed = 'Retorno de carro: \\n';
$strLines = 'Lineas';
$strLinesTerminatedBy = 'Linias terminadas en';
$strLocationTextfile = 'Localizaci&oacute;n del archivo de texto';
$strLogin = 'Identificacion';
$strLogout = 'Salir';
$strLogPassword = 'Contrase&ntilde;a:';
$strLogUsername = 'Usuario:';

$strModifications = 'Se han guardado las modificaciones';
$strModify = 'Modificar';
$strModifyIndexTopic = 'Modificar un indice';
$strMoveTable = 'Mover tabla a (Base de datos<b>.</b>tabla):';
$strMoveTableOK = 'La table %s ha sido movida a %s.';
$strMySQLReloaded = 'Reinicio de MySQL.';
$strMySQLSaid = 'MySQL ha dicho: ';
$strMySQLServerProcess = 'MySQL %pma_s1% ejecutandose en %pma_s2% como %pma_s3%';
$strMySQLShowProcess = 'Mostrar procesos';
$strMySQLShowStatus = 'Mostrar informaci&oacute;n de marcha de MySQL';
$strMySQLShowVars = 'Mostrar las variables del sistema MySQL';

$strName = 'Nombre';
$strNbRecords = 'Nº. de filas';
$strNext = 'Pr&oacute;xima';
$strNo = 'No';
$strNoDatabases = 'No hay bases de datos';
$strNoDropDatabases = '"DROP DATABASE" las sentencias estan deshabilitadas.';
$strNoFrames = 'phpMyAdmin es más fácil con un navegador que <b>soporte marcos (frames)</b>.';
$strNoIndex = 'No se ha definido el indice!';
$strNoIndexPartsDefined = 'No se han definido partes del indice!';
$strNoModification = 'Sin cambios';
$strNone = 'Ninguna';
$strNoPassword = 'Sin Contrase&ntilde;a';
$strNoPrivileges = 'Sin Privilegios';
$strNoRights = 'Ud. no tiene suficientes privilegios para estar aqui ahora!';
$strNoTablesFound = 'No se han encontrado tablas en la base de datos.';
$strNotNumber = 'Esto no es un numero!';
$strNotValidNumber = ' no es un numero de fila valido!';
$strNoUsersFound = 'Usuario(s) no encontrado(s).';
$strNull = 'Nulo';

$strOftenQuotation = 'A menudo comillas. OPCIONALMENTE signif&iacute;ca que &uacute;nicamente los campos char y varchar estan encerrados por el "enclosed by"-character.';
$strOptimizeTable = 'Optimizar tabla';
$strOptionalControls = 'Opcional. Controla como escribir o leer caracteres especiales.';
$strOptionally = 'OPCIONALMENTE';
$strOr = 'O';
$strOverhead = 'Overhead'; //to translate

$strPartialText = 'Textos parciales';
$strPassword = 'Contrase&ntilde;a';
$strPasswordEmpty = 'La Contrase&ntilde;a esta vacía!';
$strPasswordNotSame = 'Las contrase&ntilde;as no coinciden!';
$strPHPVersion = 'Version del PHP';
$strPmaDocumentation = 'Documentacion de phpMyAdmin';
$strPmaUriError = 'La directiva <tt>$cfgPmaAbsoluteUri</tt> DEBE constar en el fichero de configuraci&oacute;n!';
$strPos1 = 'Empezar';
$strPrevious = 'Previo';
$strPrimary = 'Primaria';
$strPrimaryKey = 'Clave Primaria';
$strPrimaryKeyHasBeenDropped = 'La clave primaria ha sido eliminada';
$strPrimaryKeyName = 'El nombre de la clave primaria debe ser... PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>debe</b> ser el nombre de y <b>solo de</b> una clave primaria!)';
$strPrintView = 'Vista de Impresion';
$strPrivileges = 'Privilegios';
$strProperties = 'Propiedades';

$strQBE = 'Consulta de ejemplo';
$strQBEDel = 'Borrar';
$strQBEIns = 'Inssertar';
$strQueryOnDb = 'Consulta en la Base de datos <b>%s</b>:';

$strRecords = 'Campos';
$strReferentialIntegrity = 'Comprueba la integridad referencial:';
$strReloadFailed = 'El reinicio de MySQL ha fallado.';
$strReloadMySQL = 'Reinicio de MySQL';
$strRememberReload = 'Recuerde recargar el servidor.';
$strRenameTable = 'Renombrar la tabla a';
$strRenameTableOK = 'Tabla %s se ha renombrado a %s';
$strRepairTable = 'Reparar Tabla';
$strReplace = 'Reemplazar';
$strReplaceTable = 'Reemplazar datos de tabla con archivo';
$strReset = 'Reset';
$strReType = 'Re-escriba';
$strRevoke = 'Revocar';
$strRevokeGrant = 'Revocar Grant';
$strRevokeGrantMessage = 'Ud. ha revocado el privilegio Grant para %s';
$strRevokeMessage = 'Ud. ha revocado los privilegios para %s';
$strRevokePriv = 'Revocar Privilegios';
$strRowLength = 'Logitud de la fila';
$strRows = 'Filas';
$strRowsFrom = 'filas empezando de';
$strRowSize = ' Tama&ntilde;o de la fila ';
$strRowsModeHorizontal = 'horizontal';
$strRowsModeOptions = 'en modo %s y repite encabezados cada %s celdas';
$strRowsModeVertical = 'vertical';
$strRowsStatistic = 'Estadisticas de la fila';
$strRunning = 'ejecutandose en %s';
$strRunQuery = 'Ejecutar Consulta';
$strRunSQLQuery = 'Ejecuta consulta/s SQL en la Base de Datos %s';

$strSave = 'Grabar';
$strSelect = 'Seleccionar';
$strSelectADb = 'Selecciona una Base de Datos';
$strSelectAll = 'Selecciona todo';
$strSelectFields = 'Seleccionar campos (al menos uno):';
$strSelectNumRows = 'en la consulta';
$strSend = 'enviar';
$strServerChoice = 'Eleccion de Servidor';
$strServerVersion = 'Version del Servidor';
$strSetEnumVal = 'Si el tipo de campo es "enum" o "set", por favor ingrese los valores usando este formato: \'a\',\'b\',\'c\'...<br />Si alguna vez necesita poner una barra invertida("\") o una comilla simple ("\'") entre esos valores, siempre ponga una barra invertida. (Por Ejemplo \'\\\\xyz\' or \'a\\\'b\').';
$strShow = 'Mostrar';
$strShowAll = 'Mostrar todo';
$strShowCols = 'Mostrar columnas';
$strShowingRecords = 'Mostrando campos ';
$strShowPHPInfo = 'Mostrar informacion de PHP';
$strShowTables = 'Mostrar tablas';
$strShowThisQuery = ' Mostrar esta consulta otra vez ';
$strSingly = '(solo)';
$strSize = 'Tama&ntilde;o';
$strSort = 'Ordenar';
$strSpaceUsage = 'Espacio utilizado';
$strSQLQuery = 'SQL-query';
$strStartingRecord = 'Empezando registro';
$strStatement = 'Sentencias';
$strStrucCSV = 'Datos CSV ';
$strStrucData = 'Estructura y datos';
$strStrucDrop = 'A&ntilde;adir \'drop table\'';
$strStrucExcelCSV = 'CSV para datos de Ms Excel';
$strStrucOnly = 'Unicamente estructura ';
$strSubmit = 'Enviar';
$strSuccess = 'Su consulta ha sido ejecutada con exito';
$strSum = 'Tama&ntilde;o de las tablas';

$strTable = 'tabla ';
$strTableComments = 'Comentarios de la Tabla';
$strTableEmpty = 'El nombre de la tabla esta vacio!';
$strTableHasBeenDropped = 'Se ha eliminado la tabla %s';
$strTableHasBeenEmptied = 'Se ha vaciado la tabla %s';
$strTableHasBeenFlushed = 'Se ha vaciado el caché de la tabla %s';
$strTableMaintenance = 'Mantenimiento de la tabla';
$strTables = '%s tabla(s)';
$strTableStructure = 'Estructura de tabla para tabla';
$strTableType = 'Tipo de tabla';
$strTextAreaLength = ' Debido a su longitud,<br /> este campo puede no ser editable ';
$strTheContent = 'El contenido de su archivo ha sido insertado.';
$strTheContents = 'El contenido del archivo reemplaza el contenido de la tabla seleccionada para las columnas identicas primarias o unicas.';
$strTheTerminator = 'El terminador de los campos.';
$strTotal = 'total';
$strType = 'Tipo';

$strUncheckAll = 'Desmarcar todos';
$strUnique = 'Unico';
$strUnselectAll = 'Deselecciona todo';
$strUpdatePrivMessage = 'Ud. a actualizado los privilegios para %s.';
$strUpdateProfile = 'Actualiza perfil:';
$strUpdateProfileMessage = 'Se ha actualizado el perfil.';
$strUpdateQuery = 'Modificar la Consulta';
$strUsage = 'Uso';
$strUseBackquotes = 'Usar backquotes con tablas y nombres de campo';
$strUser = 'Usuario';
$strUserEmpty = 'El nombre de usuario esta vacio!';
$strUserName = 'Nombre de Usuario';
$strUsers = 'Usuarios';
$strUseTables = 'Usar tablas';

$strValue = 'Valor';
$strViewDump = 'Mostrar volcado esquema de la tabla';
$strViewDumpDB = 'Ver volcado esquema de la base de datos';

$strWelcome = 'Bienvenido a %s';
$strWithChecked = 'Con marca:';
$strWrongUser = 'Usuario/contrase&ntilde;a equivocado. Accesso denegado.';

$strYes = 'Si';

$strZip = '"comprimido con zip"';

// To translate
?>
