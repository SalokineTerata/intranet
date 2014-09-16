<?php
//include ("../lib/session.php");
//include ("../lib/functions.php");
      require_once '../inc/main.php';

identification1("salaries", $login, $pass);

if ($action=="modifier"){
$news1=addslashes($news1);
$news2=addslashes($news2);
$news3=addslashes($news3);
$news4=addslashes($news4);
$news5=addslashes($news5);

$champsa=DatabaseOperation::query("select * from newsdefil where num=1");
$nb=mysql_num_rows($champsa);
if(!$nb){
DatabaseOperation::query("INSERT INTO newsdefil(id_user, date, news1, news2, news3, news4, news5, num) values ('$id_user',now(),'$news1','$news2','$news3','$news4','$news5','1')");
}else{
DatabaseOperation::query("update newsdefil set id_user='$id_user', date=now(), news1='$news1', news2='$news2', news3='$news3', news4='$news4', news5='$news5' where num=1");
}
}
$champs=DatabaseOperation::query("select * from newsdefil where num=1");
$colonne=mysql_fetch_array($champs);
?>
<html>
<head>
<title>Gestion des commentaires</title>
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

<body onLoad="StartTimer(<?php $time=timeout($id_user); echo "$time"; ?>)" bgcolor="#FFCC66" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php
  include ("../adminagis/cadrehautnews.php");
  echo ("<form method=\"post\" action=\"$PHP_SELF\">\n");
  ?>
  <input type="hidden" name="action" value="modifier">
  <table width="620" border="0" cellspacing="0" cellpadding="0" align="left">
  <tr>
    <td align=center>
    <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/bandeau_etape0.gif height="61"></td>
          <td><img src="../images_pop/entete_news.gif" width="500"></td>
          <td><a href="../aide.php#adminnew" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
      <br>
      <br><br><br>
      <table width="500" border="0" cellspacing="4" cellpadding="0">
        <tr>
          <td  class="logFFE5B2">Gestion News</td>
        </tr>
        <tr>
          <td  class="loginFFCC66">date de derniere modification : <?php
/*------------
formatage date
-------------*/
$date = $colonne[date];
$jour = substr($date, 8, 2);
$mois = substr($date, 5, 2);
$annee = substr($date, 0, 4);
$date= $jour."/".$mois."/".$annee;
echo"$date";
?></td>

        </tr>
        <tr>
          <td  class="loginFFCC66">modificateur :
<?php
$champs2=DatabaseOperation::query("select * from salaries where id_user='$colonne[id_user]'");
$colonne2=mysql_fetch_array($champs2);
echo "$colonne2[nom] $colonne2[prenom]";
?></td>
        </tr>
      </table>
      <br>
      <table width="400" border="0" cellspacing="4" cellpadding="0">
        <tr>
          <td class="logFFE5B2">news 1</td>
        </tr>
        <tr>
          <td>
            <input type="text" name="news1" size="60" maxlength="74" value="<?php $news1=stripslashes($colonne[news1]);echo"$news1"; ?>">
          </td>
        </tr>
        <tr>
          <td class="logFFE5B2">news 2</td>
        </tr>
        <tr>
          <td>
            <input type="text" name="news2" size="60" maxlength="74" value="<?php $news2=stripslashes($colonne[news2]);echo"$news2"; ?>">
          </td>
        </tr>
        <tr>
          <td class="logFFE5B2">news 3</td>
        </tr>
        <tr>
          <td>
            <input type="text" name="news3" size="60" maxlength="74" value="<?php $news3=stripslashes($colonne[news3]);echo"$news3"; ?>">
          </td>
        </tr>
        <tr>
          <td class="logFFE5B2">news 4</td>
        </tr>
        <tr>
          <td>
            <input type="text" name="news4" size="60" maxlength="74" value="<?php $news4=stripslashes($colonne[news4]);echo"$news4"; ?>">
          </td>
        </tr>
        <tr>
          <td class="logFFE5B2">news 5</td>
        </tr>
        <tr>
          <td>
            <input type="text" name="news5" size="60" maxlength="74" value="<?php $news5=stripslashes($colonne[news5]);echo"$news5"; ?>">
          </td>
        </tr>
      </table>
      <br>
      <input type="image" src="../zimages/valider-j.gif" width="130" height="20"><br>
      <br>
    </td>
    </tr>
    <tr>
    <td align=center>
    <br>
     </td>
   </tr>
    <tr>
    <td align=center>


     </td>
   </tr>

  </table>
</form>
<br>
<?php
  include ("../adminagis/cadrebas.php");
?>
</html>