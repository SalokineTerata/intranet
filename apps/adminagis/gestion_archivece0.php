<?php
//  require ("../lib/session.php");
//  include("../lib/functions.php");
      require_once '../inc/main.php';

identification1("salaries", $login, $pass,FALSE);
  securce($id_user, $id_type);
//  include("functions.php");
//
//  include("functions.js");

?>
<html>
<head>
<title>Article &agrave; archiver</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../lib/css/admin_intra01.css" type="text/css">
<link rel="stylesheet" href="../lib/css/admin_newsentrep.css" type="text/css">
<link rel="stylesheet" href=../lib/css/admin_newsgeneral.css type="text/css">
<link rel="stylesheet" href=../lib/css/admin_newspopup.css type="text/css">
</head>
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
<?php  include ("../news/cadrehautce.php"); ?><FORM  method="POST" action="gestion_archivece.php">
<table width="620" border="0" cellspacing="0" cellpadding="0" align="left">
  <tr>
    <td>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="90"><img src=../lib/images/bandeau_etape0.gif height="62"></td>
          <td width="512"><img src="../images_pop/desarchive_articlece.gif" width="500" height="62"></td>
          <td width="28"><a href="../aide.php#entreprise" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="20">
          </td>
        </tr>
        <tr>
          <td class="LOGINFFFFFFCENTRE">Liste des comit&eacute;s d'entreprise<br>
<?php
    echo ("<select name=\"numserce\">\n");
/* Constitution de la liste déroulante des noms */
    $req="select numserce, descserce from servicece order by descserce";
    $result=DatabaseOperation::query($req);
    if ($result!= false)
    {
      while ($row=mysql_fetch_row($result))
      {
        $row[1]=stripslashes($row[1]);
        echo ("<option value=\"$row[0]\">$row[1]</option>");
      }
    }
    echo ("</select>\n");
?>
          </td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="20"></td>
        </tr>
        <tr>
          <td>
            <center>
              <input type="image" src="../zimages/valider-j.gif" width="130" height="20">
            </center>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php  include ("../adminagis/cadrebas.php"); ?>
</form>
</body>
</html>