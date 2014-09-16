//<script language="JavaScript">


  function envoi(champ)
  {
    if(champ.value!=="")
       principal.action=principal.format.options[principal.format.selectedIndex].value, principal.submit();
    else
      alert("Il faut remplir le niveau de confidentialit�");
  }

  function vide(champ, defoval)
  {
    if(champ.value===defoval) champ.value="";
  }

  function envoi2(valeur)
  {
    if(valeur!=="")
      parent['frame2bas'].location.href='articleframe2.php?nomliste=valeur';
    else
      alert("Ca ne marche pas");
  }

function MM_openBrWindow(theURL,winName,features)
{ //v2.0
  window.open(theURL,winName,features);
}

function MM_goToURL()
{ //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}


  function oblig()
  {
    if(document.principal.nivo_conf.value==='')
    {
      principal.nivo_conf.focus();
      alert("Le champ du niveau de confidentialit� est obligatoire"); return;
    }
    if((document.principal.nivo_conf.value<1) || (document.principal.nivo_conf.value>10) || (isNaN(document.principal.nivo_conf.value)===1))
    {
      principal.nivo_conf.focus();
      alert("Le niveau de confidentialit� doit �tre un nombre compris entre 1 et 10"); return;
    }

    if(document.principal.titre_art.value==='')
    {
      principal.titre_art.focus();
      alert("Le champ de titre est obligatoire"); return;
    }
    if(principal.sujet.value==='')
    {
      principal.sujet.focus();
      alert("Le champ de sujet est obligatoire"); return;
    }
      document.principal.submit();
  }

  function nonvide()
  {
    if(salarie.sal_nom.value==='')
    {
      salarie.sal_nom.focus();
      alert("Le champ nom est obligatoire"); return;
    }
    if(salarie.sal_prenom.value==='')
    {
      salarie.sal_prenom.focus();
      alert("Le champ pr�nom est obligatoire"); return;
    }
    if(salarie.sal_login.value==='')
    {
      salarie.sal_login.focus();
      alert("Le champ login est obligatoire"); return;
    }
    if(salarie.sal_pass.value==='')
    {
      salarie.sal_pass.focus();
      alert("Le champ mot de passe est obligatoire"); return;
    }
    if(salarie.sal_mail.value==='')
    {
      salarie.sal_mail.focus();
      alert("Le champ mail est obligatoire"); return;
    }
      document.salarie.submit();
  }




//</script>