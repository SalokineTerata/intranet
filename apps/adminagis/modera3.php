<?php
//include ("../lib/session.php");
//include ("../lib/functions.php");
      require_once '../inc/main.php';

identification1("salaries", $login, $pass);
securadmin(2, $id_type);
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
<?php  include ("../adminagis/cadrehautnews.php"); ?>
<table width="620" border="0" cellspacing="0" cellpadding="0" align="left">
    <tr>
    <td align=center><table width="500" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/bandeau_etape0.gif height="62"></td>
          <td><img src="../images_pop/gestion_moderation.gif" width="500" height="62"></td>
          <td><a href="../aide.php#adminnew" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
    <br>
     </td>
   </tr>
    <tr>
    <form action="modera2.php" method=post>
    <input type=hidden name=action value=modif>
    <input type=hidden name=action value=modif>
    <td align=center ><br><br>
    <?php
echo"   <input type=hidden name=num value=$num>";
echo"   <input type=hidden name=numcom value=$numcom>";

    $result2 ="SELECT distinct * FROM comment WHERE id_comment='$numcom'";
    $requete=DatabaseOperation::query("$result2");
    echo"<table width=\"80%\" border=\"0\" cellspacing=\"4\"><tr>";
    $rows = mysql_fetch_array($requete);
    /*-formatage date-*/
$date = $rows[date];
$jour = substr($date, 8, 2);
$mois = substr($date, 5, 2);
$annee = substr($date, 0, 4);
$date= $jour."/".$mois."/".$annee;
echo "<tr bgcolor=\"#FF3333\" class=\"logFFCC66\">";
echo"<td class=\"titrtabl\" width=\"8\"  bgcolor=\"#FFE5B2\">$date</td>";
echo"<td class=\"titrtabl\" width=\"100\"  bgcolor=\"#FFE5B2\">";
$ab = DatabaseOperation::query("select * from salaries where id_user='$rows[id_user]'");
$ligne = mysql_fetch_array($ab);
echo "$ligne[nom] $ligne[prenom]</td>";

$commentr=stripslashes($rows[commentaire]);

echo"<td class=\"titrtabl\" width=\"250\"  bgcolor=\"#FFE5B2\"><textarea name=commentaire cols=\"30\">$commentr</textarea></td>";
echo"</tr></table><br>";

if (($action!="suppr") and ($action!="modif")){
echo "<a href=\"#\" onClick=\"history.go(-1);return(false)\"><img src=\"../zimages/retour-j.gif\" width=\"130\" height=\"20\" border=\"0\"></a>";
}
?>
<input type="image" border="0" src="../images_pop/modification.gif">
     </td>
     </form>
   </tr>

  </table>
<br>
<?php
  include ("../adminagis/cadrebas.php");
?>
</html>