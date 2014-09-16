<?php
  require ("../lib/session.php");
  include("../lib/functions.php");
  identification1("salaries", $login, $pass);
  securce($id_user, $id_type);

  include("functions.php");

  include("functions.js");


  $retour=-2;
  if ($inserer=='inserer')
  {
/* Insertion dans la table ARTICLECE */
    $txtce=nl2br($txtce);
    $req="insert into articlece (titrece, txtce, placeinfoce, datecrea, id_userce, numserce)
    values ('$titrece', '$txtce', '$placeinfoce', now(), '$id_user', '$numserce')";
    $result=DatabaseOperation::query($req);
    if ($result==false)
      echo ("Impossible d'inserer dans ARTICLECE");

/* On recherche le numero de l'article que l'on vien d'inserer */
    $req="select max(numartce) from articlece";
    $result=DatabaseOperation::query($req);
    $numartce=mysql_result($result, 0, 0);

/* Par update on renomme et on insere l'image */
    if ($placeinfoce!='Info colonne')
    {
      if ($imgce=='none')
        $nomimg="photoce.gif";
      else
      {
        $nomimg=$numartce."ce".substr($imgce_name, -4);
        if (!copy ($imgce, "../imgarticlece/$nomimg"))
          echo ("probleme de copie de l'image\n");
/* Traitement de la taille de l'image */
        taille_image_300Y("../imgarticlece/$nomimg", "../imgarticlece/$nomimg");
      }
      $req="update articlece set imgce='$nomimg' where numartce='$numartce'";
      $result=DatabaseOperation::query($req);
      $imgce=$nomimg;
    }
    else
      $imgce=null;
  }

  if ($modifier=='modifier')
  {
    $req="update articlece set titrece='$titrece', txtce='$txtce', placeinfoce='$placeinfoce', numserce='$numserce'";

/* traitement de l'image */
    if ($placeinfoce!='Info colonne')
    {
      if ($imgce!='none')
      {
        $nomimg=$numartce."ce".substr($imgce, -4);
        if (!copy ($imgce, "../imgarticlece/$nomimg"))
          echo ("probleme de copie de l'image\n");
/* Traitement de la taille de l'image */
        taille_image_300Y("../imgarticlece/$nomimg", "../imgarticlece/$nomimg");
/* Modification dans la table ARTICLECE */
        $req= $req ." , imgce='$nomimg'";
        $imgce=$nomimg;
      }
      else
      {
        $imgce=$ancimgce;
      }
    }
    $req= $req ." where numartce='$numartce'";
    $result=DatabaseOperation::query($req);
    if ($result==false)
      echo ("Impossible de modifier dans ARTICLECE");
  }

  if ($voir=='voir')
  {
/* Visionnage simple d'un article */
    $req="select * from articlece where numartce='$numartce'";
    $result=DatabaseOperation::query($req);

    if ($result != false)
    {
      $imgce=mysql_result($result, 0, imgce);
      $titrece=mysql_result($result, 0, titrece);
      $txtce=mysql_result($result, 0, txtce);
      $placeinfoce=mysql_result($result, 0, placeinfoce);
      $datecrea=mysql_result($result, 0, datecrea);
      $numserce=mysql_result($result, 0, numserce);
      $retour=-1;

      $titrece=stripslashes($titrece);
      $txtce=stripslashes($txtce);

    }
  }

  if ($archive=='archive')
  {
/* Visionnage simple d'un article */
    $req="select * from archivece where numartce='$numartce'";
    $result=DatabaseOperation::query($req);
    if ($result != false)
    {
      $imgce=mysql_result($result, 0, imgce);
      $titrece=mysql_result($result, 0, titrece);
      $txtce=mysql_result($result, 0, txtce);
      $placeinfoce=mysql_result($result, 0, placeinfoce);
      $datecrea=mysql_result($result, 0, datecrea);
      $numserce=mysql_result($result, 0, numserce);

      $titrece=stripslashes($titrece);
      $txtce=stripslashes($txtce);

      $retour=-1;
    }
  }

/* recherche du libelle du CE */
echo  $req="select * from servicece where numserce='$numserce'";
  $result=DatabaseOperation::query($req);
  $descserce=mysql_result($result, 0, descserce);

?>
<html>
<head>
<title>Cr&eacute;ation d'article</title>
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
<?php include ("../news/cadrehautce.php"); ?>
<table width="600" border="0" cellspacing="0" cellpadding="0" align="left" >
  <tr>
    <td>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="90"><img src=../lib/images/bandeau_etape0.gif height="62"></td>
          <td width="500"><img src="../images_pop/articlece.gif" width="500" height="62"></td>
          <td width="28"><a href="../aide.php#admince" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td>
      <img src=../lib/images/espaceur.gif width="10" height="10">

        </tr>
      </table>
      <img src=../lib/images/espaceur.gif width="10" height="40">
      <table width="620" border="1" cellspacing="0" cellpadding="0">
          <tr>
            <td width="150">Destination</td>
            <td width="450">
<?php
  echo ("$descserce");
?>
            </td>
          </tr>
        <tr>
          <td align="center">&nbsp;
<?php
  if (($imgce!='') && ($imgce!='none')){
    echo ("<img src=\"../imgarticlece/$imgce\">\n");
}
?>
          </td>
          <td class="LOGINFFFFFFCENTRE" width="300"><font size="5">
<?php
      $titrece=stripslashes($titrece);

  echo ("$titrece");
?>
          </font></td>
        </tr>
        <tr>
          <td colspan="2"><img src=../lib/images/espaceur.gif width="100" height="30"></td>
        </tr>
        <tr>
          <td colspan="2">
<?php
      $txtce=stripslashes($txtce);

  echo ("$txtce");
?>
          </td>
        </tr>

      </table>
      <img src=../lib/images/espaceur.gif width="10" height="40">
      <table width="620" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <center>
<?php/*
  echo (" <a href=\"#\" onClick=\"history.go($retour);return(false)\"><img src=\"../zimages/retour-j.gif\" width=\"130\" height=\"20\" border=\"0\"></a>\n");
*/?>
            </center>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php  include ("../adminagis/cadrebas.php"); ?>
</body>
</html>