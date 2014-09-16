Attribute VB_Name = "NewMacros"
Sub Sauve_Document_Qualité()
Attribute Sauve_Document_Qualité.VB_Description = "Macro créée le 29/03/99 par Service Informatique"
Attribute Sauve_Document_Qualité.VB_ProcData.VB_Invoke_Func = "Normal.NewMacros.SaveAs"
'
' Sauve_Doc_Qualité Macro
' Macro créée le 29/03/99 par Service Informatique
'  enregistre le document nouvellement créé dans son répertoire de travail avec son nom
'  exemple : QD104A00
'   sera enregistré dans DOC_QUAL\ALBY\QD

    Dim Acc_En_Cours As Object
       
    On Error Resume Next    ' Retarde la récupération
                            ' d'erreur.

    Set Acc_En_Cours = GetObject(, "msaccess.Application")
    
    'If Err.Number <> 0 Then
    ''*** DEROULEMENT NORMAL DE LA FCT ENREG SOUS
    '    Dialogs(wdDialogFileSaveAs).Show
    'Else
        '*** EXTRACTION DU NOM DU FICHIER
        'MsgBox ("Début MACRO / sm")
        
        canal = DDEInitiate("MSACCESS", "QUALITE;QUERY DDE - Titre du doc")
        Nomfic$ = ""
        Nomfic$ = DDERequest(canal, "data")
        Titre$ = Mid$(Nomfic$, 1, 2) + Mid$(Nomfic$, 4, 4) + Mid$(Nomfic$, 9, 1) + Mid$(Nomfic$, 11, 2)
        Site$ = Mid$(Nomfic$, 9, 1)
        Extension$ = Mid$(Nomfic$, 14, 3)
        
        '*** CHANGEMENT DE REPERTOIRE
        If Mid$(Nomfic$, 1, 2) = "ma" Or Mid$(Nomfic$, 1, 2) = "MA" Then
            'Si les documents sont MAQ
            ChDir "M:\doc_qual" + "MAQ"
        Else
            Select Case Site$
                Case "A":
                    REPERT = "ALBY\"
                Case "G":
                    REPERT = "GADAGNE\"
                Case "L"
                    REPERT = "LAMBALLE\"
                Case "T"
                    REPERT = "TARARE\"
            End Select
            Options.DefaultFilePath(wdDocumentsPath) = "M:\doc_qual\" + REPERT + Mid$(Nomfic$, 1, 2)
        End If
        
        Set MesParam = Dialogs(wdDialogFileSaveAs)
        With MesParam
            .Name = Titre$ + "." + Extension$
        End With
        MesParam.Show
    'End If
        'ActiveDocument.SaveAs FileName:=Titre$ + "." + Extension$
        'dlg.Format = 0
        'x = Dialog dlg
        'If x < 0 Then 'autre bouton que l'annulation
        '    FichierEnregistrerSous dlg
        'End If
        'MsgBox ("Fin MACRO / sm")

FIN:

End Sub
