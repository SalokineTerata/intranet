'Script de démarrage sécurisé des Bases Access/Intranet
'
'Ce script permet de maintenir une version locale et à jour de la base de données
'Pour bénéficier de toutes les fonctionnalités de sécurisation,
'associez l'utilisation de ces scripts à l'utilisation de tables attachés avec l'option "snapshot"
'Boris Sanègre - 2006-08-31


'checkengine

'Déclaration des Variables
'-------------------------
Dim WSHShell
Dim strScheduledInstallTime
Dim strExtension
Dim strIntranet
Dim strServer
Dim strCheminSource
Dim strCheminCible
Dim strBaseAccess
Dim strProgramAccess
Dim strCommand
Dim ScriptFullName
Dim LogDebug


'Initialisation des Variables
'----------------------------
'Public const DEBUG_MESSAGE = true
Public const DEBUG_MESSAGE = false
Public const INFO_MESSAGE = true

if DEBUG_MESSAGE then  Wscript.echo WScript.ScriptFullName end if
ScriptFullName = WScript.ScriptFullName

'Base d'exploitation ou de développement ?
if (ScriptFullName = ("R:\intranet.dev\access\base_codesoft\" & WScript.ScriptName)) or ScriptFullName = ("D:\secure_start-dev.vbs") then
	'Deux possibilités:
	' - Soit le script est lancé depuis son emplacement réseau
	' - Soit il est copier sur le poste avec un emplacement et un nom imposé
	strStable=".dev"
	strExtension = "mdb"
	strServer="localsmb"
	if INFO_MESSAGE then  Wscript.echo "Base de développement (intranet.dev)" end if

else
	'Sinon, on s'oriente vers la base d'exploitation
	strStable =""
	strExtension = "agismde"
	strServer="localsmb"
end if

strIntranet="intranet" & strStable
strCheminSource="\\" & strServer & "\programmes\" & strIntranet & "\access\base_codesoft\"

'Chemin d'accès aux données locales
'BS 2008-10-30: Arrêt de l'utilisation du lecteur C
'strCheminCible="c:"
strCheminCible="d:"

'Nom de la base de données Access
strBaseAccess="codesoft" & "." & strExtension

'Lancement du Runtime MS Access
'strProgramAccess="C:\Access\Office\msaccess.exe"
'strProgramAccess="start msaccess"
strProgramAccess="msaccess"

'Dossier etiquette
'Directement lié à la fonction pilotage_cs(), 
'donc penser à mettre à jour la fonction en cas de modification du chemin d'accès !
strEtiquetteSource="r:\etiquettage" & strStable & "\modeles"
strEtiquetteDest=strCheminCible & "\cache.etiquettes"

'Partie Debug
'------------
if DEBUG_MESSAGE then 

Wscript.echo "strCheminSource=" & strCheminSource
	
end if

'Reconstruction du cache des Etiquettes
'--------------------------------------
'ExecCmd("del /S /Q " & strEtiquetteDest)
ExecCmd("deltree /Y " & strEtiquetteDest)
ExecCmd("xcopy " & strEtiquetteSource & " " & strEtiquetteDest & "\ /Y")
ExecCmd("ATTRIB -h " & strEtiquetteDest)

'Compactage et mise à jour de la base
'------------------------------------
'ExecCmd(strProgramAccess & " " & strCheminSource & strBaseAccess & " /compact " & strCheminCible & "\" & strBaseAccess)
strCommand = "xcopy " & strCheminSource & strBaseAccess & " " & strCheminCible & "\" & " /Y"
'Wscript.echo strCommand
ExecCmd(strCommand)

'Démarrage de la Base
'--------------------
'ExecCmd(strProgramAccess & " " & strCheminCible  & "\" & strBaseAccess)
'Wscript.echo strProgramAccess & " " & strCheminCible  & "\" & strBaseAccess
Return = WshShell.Run(strProgramAccess & " " & strCheminCible  & "\" & strBaseAccess, 3, true)

'Initialisation du Cache
'-----------------------
'strCommand = "del /S /Q " & strEtiquetteDest
'Wscript.echo strCommand
'Set WshShell = WScript.CreateObject("WScript.Shell")
'Return = WshShell.Run(strCommand , 3, true)
'Wscript.Sleep 1000
'strCommand = "del /S /Q " & strEtiquetteDest
'Wscript.echo strCommand
'Set WshShell = WScript.CreateObject("WScript.Shell")
'Return = WshShell.Run(strCommand , 3, true)
'Wscript.Sleep 1000

'Sub checkengine
  'pcengine = LCase(Mid(WScript.FullName, InstrRev(WScript.FullName,"\")+1))
  'if DEBUG_MESSAGE then Wscript.echo "pcengine: " & pcengine end if

  'If Not pcengine="cscript.exe" Then
'    Set WshShell = CreateObject("WScript.Shell")

'    WshShell.Run "CSCRIPT.EXE """ & WScript.ScriptFullName & """"
'    if DEBUG_MESSAGE then Wscript.echo "CSCRIPT.EXE """ & WScript.ScriptFullName & """" end if
  
    'WScript.Quit
  'End If
'End Sub

Function ExecCmd(strCommand)

	Set WshShell = WScript.CreateObject("WScript.Shell")

	' Récupération des variables d'environnement
	ENV_OS=WshShell.ExpandEnvironmentStrings("%OS%")
	if DEBUG_MESSAGE then Wscript.echo ENV_OS end if

	if ENV_OS = "Windows_NT" then
		CMD = "cmd /C"
	else
		CMD = "command /C"
	end if

	if DEBUG_MESSAGE then Wscript.echo strCommand end if
	Return = WshShell.Run(CMD & " " & strCommand , 3, true)
	'Return = WshShell.Run(strCommand , 3, true)
	Wscript.Sleep 2000

end Function


wscript.Quit(0)

'0 Hide the window and activate another window.
'1 Activate and display the window. (restore size and position) Specify this flag when displaying a window for the first time.
'2 Activate & minimize.
'3 Activate & maximize.
'4 Restore. The active window remains active.
'5 Activate & Restore.
'6 Minimize & activate the next top-level window in the Z order.
'7 Minimize. The active window remains active.
'8 Display the window in its current state. The active window remains active.
'9 Restore & Activate. Specify this flag when restoring a minimized window.
'10 Sets the show-state based on the state of the program that started the application

