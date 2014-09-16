<?php
//  require("../lib/session.php");
//  include("../lib/functions.php");
      require_once '../inc/main.php';

  identification1("salaries", $login, $pass);
  securadmin(3, $id_type);

  if ($mod1=='mod1')
  {
    $mod="toto";
    $req="update words set word='$wordmod', replacement='$replacementmod' where word_id='$word_idmod'";
    $result=DatabaseOperation::query($req);

  }

  if ($supp=='supp')
  {
    $req="delete from words where word_id='$word_id2'";
    $result=DatabaseOperation::query($req);

  }

  if ($ins=='ins')
  {
    $req="insert into words (word, replacement) values ('$wordins', '$replacementins')";
    $result=DatabaseOperation::query($req);

  }
?>
<html>
<head>
<title>Gestion des mots interdits</title>
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
<?php  include ("../adminagis/cadrehautnews.php"); ?>

<?php
  echo ("<form name=\"inserer\" method=\"post\" action=\"$PHP_SELF\">\n");
?>
   <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/bandeau_etape0.gif height="62"></td>
          <td><img src="../images_pop/gestion_mots.gif" width="500" height="62"></td>
          <td><a href="../aide.php#adminnew" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
   </table>
   <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="20">
          </td>
        </tr>
    </table>
 <br><br><table width="550" border="1" cellspacing="3" cellpadding="0" align="center" >
        <tr>
          <td height="33">
            <center>
              <span class="loginFFCC66">Mot interdit :</span>
                <input type="text" name="wordins">
            </center>
          </td>
          <td class="loginFFCC66" height="33">
            <center>
              Remplac&eacute; par :
              <input type="text" name="replacementins">
             </center>
          </td>
        </tr>                                                                                      
        <tr>
          <td colspan="2">
            <div align="center">
              <input type="image" src="../images_pop/inserer.gif" width="130" height="20" alt="Ins&eacute;rer le couple de mots dans le dictionnaire" name="image">
            </div>
            <input type="hidden" name="supp" value="toto">
            <input type="hidden" name="ins" value="ins">
            <input type="hidden" name="mod" value="toto">
          </td>
        </tr>
      </table>
    </form><br>
<?php
echo ("<form name=\"modifier\" method=\"post\" action=\"$PHP_SELF\">\n");

  if ($mod!='mod')
  {
    echo (" <table width=\"550\" border=\"1\" cellspacing=\"3\" cellpadding=\"0\" align=\"center\">\n");
    echo ("   <tr>\n");
    echo ("   <td align=\"center\"><span class=\"loginFFCC66\">Mot &agrave; modifier</span></td>\n");
    echo ("    <td align=\"left\">\n");
/* Liste deroulante pour les mots */
    $req="select word_id, word, replacement from words order by word";
    $result=DatabaseOperation::query($req);
    if ($result!= false)
    {
      echo ("<select name=\"word_id\">\n");
      while ($row=mysql_fetch_row($result))
      {
        echo ("<option value=\"$row[0]\">$row[1] / $row[2]</option>");
      }
      echo ("</select>");
   echo"</td><td align=center>";}
  }

  if ($mod=='mod')
  {

    $req="select * from words where word_id='$word_id'";
    $result=DatabaseOperation::query($req);
    $word=mysql_result($result, 0, word);
    $replacement=mysql_result($result, 0, replacement);
echo (" <table width=\"550\" border=\"1\" cellspacing=\"3\" cellpadding=\"0\" align=\"center\">\n");
    echo ("  <tr>\n");
    echo ("    <td class=\"LOGINFFFFFFCENTRE\">\n");
    echo ("        <b>Mots</b>\n");
    echo ("        <input type=\"text\" name=\"wordmod\" value=\"$word\">\n");
    echo ("    </td>\n");
    echo ("    <td class=\"LOGINFFFFFFCENTRE\">\n");
    echo ("        <b>Remplac&eacute; par</b>\n");
    echo ("        <input type=\"text\" name=\"replacementmod\" value=\"$replacement\">\n");
    echo ("    </td>\n");
    echo ("  </tr>\n");
    echo ("   <tr><td class=\"LOGINFFFFFFCENTRE\" colspan=2>\n");
    echo ("        <input type=\"hidden\" name=\"mod1\" value=\"mod1\">\n");
    echo ("        <input type=\"hidden\" name=\"word_idmod\" value=\"$word_id\" class=\"txtfield\">\n");
    echo ("        <input type=\"hidden\" name=\"supp\" value=\"toto\">\n"); }

  echo ("<input type=\"image\" src=\"../zimages/valider-j.gif\" width=\"130\" height=\"20\" alt=\"Valider la modification du couple de mots\">\n");
  echo ("        <input type=\"hidden\" name=\"mod\" value=\"mod\">\n");
  echo ("        <input type=\"hidden\" name=\"supp\" value=\"toto\">\n");
  echo ("      </td>\n");
  echo ("    </tr>\n");
  echo ("  </table>\n");
  echo ("</form>\n");

  echo ("<form name=\"supprimer\" method=\"post\" action=\"$PHP_SELF\">\n");
?>
      <br><table width="550" border="1" cellspacing="3" cellpadding="0" align="center">
        <tr>
          <td width="20%" align="center"><span class="loginFFCC66">Mot &agrave; supprimer</span>
          </td>
          <td width="30%">
<?php
/* Liste deroulante pour les mots*/
  $req="select * from words order by word";
  $result=DatabaseOperation::query($req);
  if ($result!=false)
  {
    echo ("<select name=\"word_id2\">\n");
    while ($row=mysql_fetch_row($result))
    {
      echo ("<option value=\"$row[0]\">$row[1] / $row[2]</option>");
    }
    echo ("</select>");
  }
?>
          </td>
          <td class="LOGINFFFFFFCENTRE" width="20%">
            <input type="image" src="../images_pop/supprimer.gif" width="130" height="20" alt="Supprimer le couple de mots du dictionnaire">
            <input type="hidden" name="ins" value="toto">
            <input type="hidden" name="mod" value="toto">
            <input type="hidden" name="supp" value="supp">
          </td>
        </tr>
      </table>
    </form> <br>
<table width="550" border="1" cellspacing="0" cellpadding="3" align="center" bgcolor="#FFE5B2">
        <tr>
          <td class="LOGINFFFFFFCENTRE">
            <div align="center">Mot interdit</div>
          </td>
          <td class="LOGINFFFFFFCENTRE">
            <div align="center">Remplac&eacute; par</div>
          </td>
        </tr>

<?php
  $req="select * from words order by word";
  $result=DatabaseOperation::query($req);

  $num=mysql_num_rows($result);
  if ($num!=0)
  {
    $i=0;
    while ($i<$num)
    {
      $word_id=mysql_result($result, $i, word_id);
      $word=mysql_result($result, $i, word);
      $replacement=mysql_result($result, $i, replacement);
      echo ("  <tr>\n");
      echo ("    <td class=\"loginFFFFFF\" align=\"center\">\n");
      echo ("      $word\n");
      echo ("    </td>\n");
      echo ("    <td class=\"loginFFFFFF\" align=\"center\">\n");
      echo ("      $replacement\n");
      echo ("    </td>\n");
      echo ("  </tr>\n");
      $i++;
    }
  }
?>
</table>
<?php  include ("../adminagis/cadrebas.php"); ?>
</body>
</html>