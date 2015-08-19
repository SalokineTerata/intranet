<?php
//  require("../lib/session.php");
//  include("../lib/functions.php");
      require_once '../inc/main.php';
      
  identification1("salaries", $login, $pass);
  UserModel::securadmin(3, $id_type);

  if ($mod=="mod")
  {
/* Pour la modification on efface toutes les lignes existantes
 dans la table DIFFUSION et on reinsere les nouvelles lignes  */

    $req="delete from diffusion where nomliste='$nomliste'";
    $result=DatabaseOperation::query($req);

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
  else
  {
/* Recherche des valeurs a afficher*/
  $req="select * from diffusion where nomliste='$nomliste'";
  $result=DatabaseOperation::query($req);
  if ($result==false)
    echo ("il y a un probleme de lecture dans la table diffusion");


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
<?php  include ("../adminagis/cadrehautnews.php"); ?>
<?php
  echo ("<form method=\"post\" action=\"$PHP_SELF\">\n");
?>
<table width="620" border="0" cellspacing="0" cellpadding="0" height="266" align="left">
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
  echo ("$nomliste\n");
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
          <td>
            <p align="center" class="LOGINFFFFFFCENTRE">&nbsp;</p>
          </td>
          <td class="loginFFCC66">Nom des salari&eacute;s<br>
            <br>
          </td>
        </tr>
<?php
/* Constitution de la liste des salaries*/
  $req="select id_user, nom, prenom from salaries where actif='oui'order by nom";
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
      $req2="select * from diffusion where nomliste='$nomliste' and id_user='$sal_user'";
      $res2 = mysql_query ($req2);
      $num2=mysql_num_rows($res2);

      echo ("  <tr>\n");
      echo ("    <td class=\"loginFFFFFF\">\n");
      echo ("      <div align=\"right\">\n");
/* recherche pour savoir si la case doit etre cochee*/
      if ($num2 == 0)
        echo (" <input type=\"checkbox\" name=\"$sal_user\" value=\"$sal_user\">");
      else
        echo (" <input type=\"checkbox\" name=\"$sal_user\" value=\"$sal_user\"checked>\n");
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
            <div align="center"><input type="image" src="../zimages/valider-j.gif" width="130" height="20"></div>
          </td>
        </tr>
        <input type="hidden" name="mod" value="mod">
<?php
  echo ("<input type=\"hidden\" name=\"nomliste\" value=\"$nomliste\">");
?>
      </table>
    </td>
  </tr>
</table>
<?php  include ("../adminagis/cadrebas.php"); ?>
</body>
</html>