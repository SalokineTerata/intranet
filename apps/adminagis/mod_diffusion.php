<?php
//  require("../lib/session.php");
//  include("../lib/functions.php");
      require_once '../inc/main.php';

  identification1("salaries", $login, $pass);
  securadmin(3, $id_type);
  ?>
<html>
<head>
<title>Liste de diffusion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../lib/css/admin_intra01.css" type="text/css">
<link rel="stylesheet" href="../lib/css/admin_intra01.css" type="text/css">
<script language="JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
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

<body onLoad="StartTimer(<?php $time=timeout($id_user); echo "$time"; ?>)" bgcolor="#FFCC66" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php  include ("../adminagis/cadrehautnews.php"); ?>
<form method="post" action="mod1_diffusion.php">
<table width="620" border="0" cellspacing="0" cellpadding="0" align="left">
  <tr>
    <td>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/bandeau_etape0.gif height="62"></td>
          <td><img src="../images_pop/liste_diffusion.gif" width="500" height="62"></td>
          <td><a href="../aide.php#adminnew" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
      <img src=../lib/images/espaceur.gif width="10" height="20">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="loginFFFFFF">
            <div align="center">Nom de la liste de diffusion
<?php
//    LISTE DEROULANTE
    $req="select distinct nomliste from diffusion order by nomliste";
    $result=DatabaseOperation::query($req);
    if ($result!= false)
    {
      echo ("<select name=\"nomliste\">\n");
      while ($row=mysql_fetch_row($result))
      {
        echo ("<option value=\"$row[0]\">$row[0]</option>");
      }
      echo ("</select>\n");
    }
?>
            </div>
          </td>
        </tr>
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="30"></td>
        </tr>
      </table>
      <table width="500" border="0" cellspacing="4" cellpadding="0" align="center">
        <tr>
          <td class="loginFFFFFF" colspan="2">
            <div align="center"><input type="image" src="../zimages/valider-j.gif" width="130" height="20"></div>
            <input type="hidden" name="modifier" value="modifier">
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php  include ("../adminagis/cadrebas.php"); ?>
</body>
</html>