<?php
//  require ("../lib/session.php");
//  include("../lib/functions.php");
      require_once '../inc/main.php';
$globalConfig = new GlobalConfig();
$login = $globalConfig->getAuthenticatedUser()->getKeyValue();
$id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();
$pass = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_PASSWORD)->getFieldValue();
$id_type = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_ID_TYPE)->getFieldValue();

identification1("salaries", $login, $pass);
  UserModel::securadmin(4, $id_type);

  if($action=="debloquer"){
  DatabaseOperation::query("update salaries set blocage='non' where (id_user='$quidonc')");
  }


?>
<html>
<head>
<title>Gestion des cat&eacute;gories socio-professionnelles</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../lib/css/admin_intra01.css" type="text/css">
<link rel="stylesheet" href="../lib/css/admin_newsentrep.css" type="text/css">
<link rel="stylesheet" href=../lib/css/admin_newsgeneral.css type="text/css">
<link rel="stylesheet" href=../lib/css/admin_newspopup.css type="text/css">
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
<?php
  include ("cadrehautent.php");
?>
<table width="620" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/bandeau_etape0.gif height="61"></td>
          <td><img src="../images_pop/deblocage.gif" width="500"></td>
          <td><a href="../aide.php#entreprise" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="20">
          </td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="2" cellpadding="0" align="center">
        <tr>
          <td colspan="4" class="loginFFCC66centre" height="35">Comptes bloqu&eacute;s :</td>
        </tr>
        <tr>
        <td class="loginFFFFFF" colspan="4"><img src=../lib/images/espaceur.gif width="10" height="10"></td>
        </tr><br>
        <table width="600" border="1" cellspacing="2" cellpadding="0" align="center">
  <?php

/* Affichage du contenu de la table CATSOPRO*/
  $req="select nom, prenom, id_user from salaries where blocage='oui'";
  $result=DatabaseOperation::query($req);
  while($rows=mysql_fetch_array($result)){
  echo"<tr><td align=\"center\" width=\"70%\">$rows[nom] $rows[prenom]</td>";
  echo"<td align=\"center\"><a href=\"$PHP_SELF?action=debloquer&quidonc=$rows[id_user]\">débloquer le compte</a></td></tr>";
  }
   ?>
      </table></table>
    </td>
  </tr>
</table>
<?php  include ("../adminagis/cadrebas.php"); ?>
</body>
</html>