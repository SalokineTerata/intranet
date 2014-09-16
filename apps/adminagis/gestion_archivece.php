<?php
//  require ("../lib/session.php");
//  include("../lib/functions.php");
      require_once '../inc/main.php';

identification1("salaries", $login, $pass);
  securce($id_user, $id_type);
//  include("functions.php");
//  include("functions.js");

  if ($archiver=='archiver')
  {
/* Recuperation du numéro d'article et si c coche ou non */
    $req="select * from archivece where numserce='$numser'";
    $result=DatabaseOperation::query($req);
    $num=mysql_num_rows($result);
    if ($num != 0)
    {
      $i=0;
      while ($i<$num)
      {
        $numart=mysql_result($result, $i, numartce);
        $toto="numart";
        $text= $$toto;
        $numartce=$$text;
        if ($numart==$numartce)
        {
/* Recopie de l'enregistrement dans ARTICLECE */
          $imgce=mysql_result($result, $i, imgce);
          $titrece=mysql_result($result, $i, titrece);
          $txtce=mysql_result($result, $i, txtce);
          $placeinfoce=mysql_result($result, $i, placeinfoce);
          $datecrea=mysql_result($result, $i, datecrea);
          $id_userce=mysql_result($result, $i, id_userce);

          $req2="insert into articlece (numartce, imgce, titrece, txtce,
          placeinfoce, datecrea, id_userce, numserce)
          values ('$numart', '$imgce', '$titrece', '$txtce', '$placeinfoce',
          '$datecrea', '$id_userce', '$numser')";
          $result2=DatabaseOperation::query($req2);
/* Effacement de l'enregistrement dans ARCHIVECE */
          $req2="delete from archivece where numartce='$numart'";
          $result2=DatabaseOperation::query($req2);
        }
        $i++;
      }
    }
    $numserce=$numser;
  }
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
<?php  include ("../news/cadrehautce.php"); ?><?php
  echo ("<form METHOD=\"post\" action=\"$PHP_SELF\">\n");
?>
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
      </table>
      <br><table width="98%" border="1" cellspacing="0" cellpadding="3" bgcolor="#FFE5B2" align=center>
        <tr>
          <td width="15%" class="loginFFCC66">
            <center>
              Date de cr&eacute;ation
            </center>
          </td>
          <td width="15%" class="loginFFCC66">
            <center>
              Date d'archivage
            </center>
          </td>
          <td width="23%" class="loginFFCC66">
            <center>
              Auteur
            </center>
          </td>
          <td width="23%" class="loginFFCC66">
            <center>
              Titre
            </center>
          </td>
          <td width="11%" class="loginFFCC66">
            <center>
              Voir
            </center>
          </td>
          <td width="5%" class="loginFFCC66">
            <center>
              Désarchiver
            </center>
          </td>
        </tr>

<?php
/* Creation du tableau */
  $req="select * from archivece where numserce='$numserce' order by datearchive";
  $result=DatabaseOperation::query($req);
  $num=mysql_num_rows($result);
  if ($num != 0)
  {
    $i=0;
    while ($i<$num)
    {
      $numartce=mysql_result($result, $i, numartce);
      $datecrea=mysql_result($result, $i, datecrea);
      $datearchive=mysql_result($result, $i, datearchive);
      $id_userce=mysql_result($result, $i, id_userce);
      $titrece=mysql_result($result, $i, titrece);
/* recherche du nom de l'auteur */
      $req2="select nom, prenom from salaries where id_user='$id_userce'";
      $result2=DatabaseOperation::query($req2);
      $sal_nom=mysql_result($result2, 0, nom);
      $sal_prenom=mysql_result($result2, 0, prenom);

      echo ("  <tr>\n");
      echo ("    <td class=\"loginFFFFFF\">\n");
      echo ("      <div align=\"left\">\n");
      $datecrea=affiche_date($datecrea);
      echo (" $datecrea</div> </td>\n");
      echo ("    <td class=\"loginFFFFFF\">\n");
      echo ("      <div align=\"left\">\n");
      $datearchive=affiche_date($datearchive);
      echo (" $datearchive</div> </td>\n");
      echo ("    <td class=\"loginFFFFFF\">\n");
      echo ("      <div align=\"left\"> $sal_prenom $sal_nom </div>\n");
      echo ("    </td>\n");
      echo ("    <td class=\"loginFFFFFF\">\n");
      echo ("      <div align=\"left\">$titrece </div>\n");
      echo ("    </td>\n");
      echo ("    <td class=\"loginFFFFFF\" bgcolor=FFCC66>\n");
      echo ("      <center>\n");
      echo ("    <a href=\"articlece.php?numartce=$numartce&archive=archive\"><img src=\"../images_pop/voir.gif\" width=\"61\" height=\"20\" border=\"0\"></a></td>\n");
      echo ("      </center>\n");
      echo ("    </td>\n");
      echo ("    <td class=\"loginFFFFFF\">\n");
      echo ("      <center>\n");
      echo ("        <input type=\"checkbox\" name=\"$numartce\" value=\"$numartce\">\n");
      echo ("      </center>\n");
      echo ("    </td>\n");
      echo ("  </tr>\n");
      $i++;
    }
  }
?>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="20"></td>
        </tr>
        <tr>
          <td>
            <center>
              <input type="image" src="../images_pop/desarchiver.gif" width="130" height="20" alt="Désarchiver un article">
              <INPUT TYPE="HIDDEN"  name="archiver" value="archiver">
<?php
  echo ("<INPUT TYPE=\"HIDDEN\"  name=\"numser\" value=\"$numserce\"> \n");
?>

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