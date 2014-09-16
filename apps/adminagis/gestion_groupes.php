<?php
//  require ("../lib/session.php");
//  include("../lib/functions.php");
      require_once '../inc/main.php';

  identification1("salaries", $login, $pass);
  securadmin(4, $id_type);

  if ($valider == 'groupes')
  {
    if ($intitule_gr!=null)
    {
      // Insertion dans la table groupes
      $intitule_gr=addslashes($intitule_gr);
      $req="insert into groupes (intitule_gr) values('$intitule_gr')";
      $result=DatabaseOperation::query($req);
      if ($result == false)
        echo ("Insertion dans la table $valider non reussie");
    }
  }

?>
<html>
<head>
<title>Gestion des groupes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../lib/css/admin_intra01.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
function Popup(page,options) {
  document.location.href="../index.php?action=delog" ;
}
function StartTimer(delai) {
  // Déclenche le timer à la fin du chargement de la page (delai est en secondes)
  setTimeout("Popup()",delai*1000);
}
</SCRIPT>
</head>

<body  onLoad="StartTimer(<?php $time=timeout($id_user); echo "$time"; ?>)" bgcolor="#FFCC66" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<script language="JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features)
{ //v2.0
  window.open(theURL,winName,features);
}

function MM_goToURL()
{ //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>

<?php
include ("cadrehautent.php");
  echo ("<form method=\"post\" action=\"$PHP_SELF\">\n");
?>
<table width="630" border="0" cellspacing="0" cellpadding="0" align="left" height="232">
  <tr>
    <td>
      <table width="30" border="0" cellspacing="0" cellpadding="0" height="30">
        <tr>
          <td><img src=../lib/images/bandeau_etape0.gif width="90" height="62"></td>
          <td><img src="../images_pop/gestion_groupes.gif" width="512" height="62"></td>
          <td><a href="../aide.php#entreprise" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="10"></td>
        </tr>
        <tr>
          <td class="loginFFFFFF">
            <div align="center">Intitul&eacute; du groupe
              <input type="text" name="intitule_gr">
            </div>
          </td>
        </tr>
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="10"></td>
        </tr>
        <tr>
          <td>
            <div align="center"><input type="image" src="../zimages/valider-j.gif" width="130" height="20"></div>
<input type="hidden" name="valider" value="groupes">
          </td>
        </tr>
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="20"></td>
        </tr>
      </table>
      <table width="500" border="0" cellspacing="4" cellpadding="0" align="center">
        <tr>
          <td>
            <p align="center" class="LOGINFFFFFFCENTRE">Intitul&eacute;</p>
          </td>
        </tr>
<?php

// Affichage du contenu de la table GROUPE
  $req="select * from groupes";
//  $result=mysql_db_query("agis",$req);
  $result=DatabaseOperation::query($req);
  if ($result != false)
  {
    $num=mysql_num_rows($result);
    $i=0;
    while ($i<$num)
    {
      $id_groupe=mysql_result($result, $i, id_groupe);
      $intitule_gr=mysql_result($result, $i, intitule_gr);
      $intitule_gr=stripslashes($intitule_gr);
      echo ("<tr>\n");
      echo ("    <td class=\"loginFFFFFF\">\n");
      echo ("      <div align=\"center\">$intitule_gr</div>\n");
      echo ("    </td>\n");
      echo ("</tr>\n");
      $i++;
    }
  }
?>
</table>
</form>
<?php  include ("../adminagis/cadrebas.php"); ?>
</body>
</html>