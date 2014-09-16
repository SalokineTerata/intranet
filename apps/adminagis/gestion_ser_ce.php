<?php
//  require ("../lib/session.php");
//  include("../lib/functions.php");
require_once '../inc/main.php';
  identification1("salaries", $login, $pass);
  securce($id_user, $id_type);
//  include("functions.php");
//  include("functions.js");

  if ($insertion=='insertion')
  {
/* Insertion d'un nouveau C.E */
    $descserce=addslashes($descserce);
    $req="select * from servicece where descserce like '%$descserce%'";
    $result=DatabaseOperation::query($req);
    $num=mysql_num_rows($result);
    if ($num != 0)
      echo ("Enregistrement deja existant\n");
    else
    {
      $req="insert into servicece (descserce) values ('$descserce')";
      $result=DatabaseOperation::query($req);
      if ($result == false)
        echo ("Impossible d'inserer dans la table SERVICECE\n");
    }
  }

  if($supp=='yes'){
  $reqdel="delete from servicece where numserce='$num'";
  $resultdel=DatabaseOperation::query($reqdel);
  }


?>
<html>
<head>
<title>Gestion des Services CE</title>
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
<?php
  include ("../news/cadrehautce.php");
  echo ("<form method=<b></b>\"post\" action=\"$PHP_SELF\">\n");
?>
<table width="620" border="0" cellspacing="0" cellpadding="0" height="240">
  <tr>
    <td>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/bandeau_etape0.gif height="62"></td>
          <td><img src="../images_pop/gestion_ser_ce.gif" width="500" height="62"></td>
          <td><a href="../aide.php#entreprise" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="20">
          </td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="20"></td>
        </tr>
      <tr>
        <td class="LOGINFFFFFFCENTRE">Intitul&eacute; du Comit&eacute; d'Entreprise<br>
            <input type="text" name="descserce" class="txtfield">
          </td>
        </tr>
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="10"></td>
        </tr>
        <tr>
          <td>
            <div align="center">
              <input type="image" src="../zimages/valider-j.gif" width="130" height="20">
              <INPUT TYPE="HIDDEN"  name="insertion" value="insertion">
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <center><br><br>
        <table width="300" border="1" cellspacing="2" cellpadding="0" align="center">
          <tr>
            <td align="center" height=20 class="logFFE5B2">
              <p align="center">Liste des Comit&eacute;s d'Entreprise
              </p>
            </td>
            <td align="center" height=20 class="logFFE5B2">
            suppression
            </td>
          </tr>

<?php
  /* Affichage du tableau */
  $req="select * from servicece order by descserce";
  $result=DatabaseOperation::query($req);
  if ($result != false)
  {
    $num=mysql_num_rows($result);
    $i=0;
    while ($i<$num)
    {
      $descserce=mysql_result($result, $i, descserce);
      $idce=mysql_result($result, $i, numserce);
      $descserce=stripslashes($descserce);
      echo (" <tr> \n");
      echo ("   <td height=20>\n");
      echo ("     <center class=\"logFFCC66\">\n");
      echo ("     $descserce\n");
      echo ("      </center>\n");
      echo ("   </td>\n");
      echo ("   <td height=20>\n");
      echo ("     <center class=\"logFFCC66\">\n");
      echo (" <a href=\"gestion_ser_ce.php?supp=yes&num=$idce\">supprimer</a>\n");
      echo ("      </center>\n");
      echo ("   <td height=20>\n");
      echo (" </tr> \n");

      $i++;
    }
  }
?>
        </table>
        <p class="logFFCC66">&nbsp;</p>
      </center>
    </td>
  </tr>
</table>
</form>
<?php  include ("../adminagis/cadrebas.php"); ?>
</body>
</html>