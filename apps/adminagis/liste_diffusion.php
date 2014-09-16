<?php
//  require("../lib/session.php");
//  include("../lib/functions.php");
      require_once '../inc/main.php';

  identification1("salaries", $login, $pass);
  securadmin(3, $id_type);

  if (($valider=="valider")&&($nomliste!=""))
  {
/* Affichage des valeurs recupérées*/
    $req="select id_user, nom, prenom from salaries order by nom";
    $result=DatabaseOperation::query($req);
    if ($result != false)
    {
      $num=mysql_num_rows($result);
      $i=0;
      while ($i<$num)
      {
/* Recuperation du numéro de salaries*/
          $sal_user=mysql_result($result, $i, id_user);
          $toto="sal_user";
          $text= $$toto;
          $numuser=$$text;
          if ($sal_user==$numuser)
          {
/* Insertion dans la table DIFFUSION*/
            $req2="insert into diffusion values ('$nomliste', '$numuser')";
            $result2=DatabaseOperation::query($req2);
          }

      $i++;
      }
    }
  }
?>
<html>
<head>
<title>Liste de diffusion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../lib/css/intra01.css" type="text/css">
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
<a name="haut"></a>
<?php  include ("../adminagis/cadrehautnews.php"); ?>
<?php
  echo ("<form method=\"post\" action=\"$PHP_SELF\">\n");
?>
<table width="620" border="0" cellspacing="0" cellpadding="0" height="266" align="left">
  <tr>
    <td colspan="2">
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
          <td class="loginFFFFFF" width="90%">
            <div align="center">Nom de la liste de diffusion
              <input type="text" name="nomliste">
            </div>
          </td>
          <td class="loginFFFFFF" width="10%"><a href="#bas"><img src="../zimages/bas.gif" width="25" height="26" border="0" alt="Atteindre le bas de page"></a></td>
        </tr>
        <tr>
          <td colspan="2"><img src=../lib/images/espaceur.gif width="10" height="30"></td>
        </tr>
      </table>
      <table width="568" border="0" cellspacing="4" cellpadding="0" align="center">
        <tr>
          <td width="19">
            <p align="center" class="LOGINFFFFFFCENTRE">&nbsp;</p>
          </td>
          <td class="loginFFCC66" width="425">Nom des salari&eacute;s<br>
            <br>
          </td>
          <td class="loginFFCC66" width="39">&nbsp;</td>
        </tr>
        <?php
/* Constitution de la liste des salaries*/
  $req="select id_user, nom, prenom from salaries where actif='oui' order by nom";
  $result=DatabaseOperation::query($req);
  if ($result != false)
  {
    $num=mysql_num_rows($result);
    $i=0;
    while ($i<$num)
    {
      $sal_user=mysql_result($result, $i, id_user);
      $sal_prenom=mysql_result($result, $i, prenom);
      $sal_nom=mysql_result($result, $i, nom);

      $sal_nom=stripslashes($sal_nom);
      $sal_prenom=stripslashes($sal_prenom);

      echo ("  <tr>\n");
      echo ("    <td class=\"loginFFFFFF\">\n");
      echo ("      <div align=\"right\">\n");
      echo ("          <input type=\"checkbox\" name=\"$sal_user\" value=\"$sal_user\">\n");
      echo ("    </div>\n");
      echo ("    </td>\n");
      echo ("    <td class=\"loginFFFFFF\">$sal_nom $sal_prenom </td>\n");
      echo ("  </tr>\n");
      $i++;
    }
  }
?>
        <tr>
          <td class="loginFFFFFF" colspan="2">
            <div align="center"><a name="bas"></a>
              <input type="image"src="../zimages/valider-j.gif" width="130" height="20" alt="Valider et enregistrer votre nouvelle liste de diffusion">
            </div>
            <input type="hidden" name="valider" value="valider">
          </td>
          <td class="loginFFFFFF" width="39">
            <div align="right"><a href="#haut"><img src="../zimages/haut.gif" width="25" height="26" border="0" alt="Atteindre le haut de page"></a></div>
          </td>
        </tr>
      </table>
      <div align="right"></div>
    </td>
  </tr>
</table>
<?php  include ("../adminagis/cadrebas.php"); ?>

</body>
</html>