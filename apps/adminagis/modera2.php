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

<body bgcolor="#FFCC66" onLoad="StartTimer(<?php $time=timeout($id_user); echo "$time"; ?>)" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php  include ("../adminagis/cadrehautnews.php"); ?>
<table width="620" border="0" cellspacing="0" cellpadding="0" align="left">
    <tr>
    <td align=center><table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/bandeau_etape0.gif height="62"></td>
          <td><img src="../images_pop/gestion_moderation.gif" width="500" height="62"></td>
          <td><a href="../aide.php#adminnew" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
    <br>
<?php if ($action=="suppr"){
DatabaseOperation::query("delete from comment where id_comment='$numcom'");
echo "commentaire supprimé";
}
?>
<?php if ($action=="modif"){
$commentaire=addslashes($commentaire);
DatabaseOperation::query("update comment set commentaire = '$commentaire' where id_comment='$numcom'");
echo "commentaire modifié";
}
?>
     </td>
   </tr>
    <tr>
    <td align=center>
    <br><br><font class="loginFFFFFF">Liste des commentaires associés à l'article</font><br><br>
<table width="90%" border=1 cellspacing=4 align=center>
<tr><td align=center>
<?php
$cuicui=DatabaseOperation::query("select * from articles where num_article='$num'");
$guigui=mysql_fetch_array($cuicui);

$guiguit=stripslashes($guigui[titre_art]);
$guiguis=stripslashes($guigui[sujet]);

echo"<font class=\"loginFFCC66droit\"> <b>Titre de l'article :</b> $guiguit <br><b>Sujet de l'article :</b> $guiguis</font>";
?></td></tr></table><br>

    <?php
    $result2 ="SELECT distinct * FROM comment WHERE id_art='$num' order by date desc";
    $requete=DatabaseOperation::query("$result2");
echo"<table width=\"90%\" border=\"1\" cellspacing=\"4\">\n";
echo"<tr bgcolor=\"#FF3333\" class=\"logFFCC66\">\n";
echo"<td class=\"titrtabl\" width=\"94\"  bgcolor=\"#FFE5B2\">date</td>\n";
echo"<td class=\"titrtabl\" width=\"140\" bgcolor=\"#FFE5B2\">auteur</td>\n";
echo"<td class=\"titrtabl\" width=\"350\" bgcolor=\"#FFE5B2\">commentaire</td>\n";
echo"<td class=\"titrtabl\" width=\"130\" bgcolor=\"#FFE5B2\">actions</td>\n";
echo"</tr>\n";
echo"</table>\n";
echo"<table width=\"90%\" border=\"1\" cellspacing=\"0\" cellpading=\"4\">\n";
while ($rows = mysql_fetch_array($requete)) {
/*-formatage date-*/
$date = $rows[date];
$jour = substr($date, 8, 2);
$mois = substr($date, 5, 2);
$annee = substr($date, 0, 4);
$date= $jour."/".$mois."/".$annee;
echo"<tr bgcolor=\"#FF3333\" class=\"logFFCC66\">\n";
echo"<td class=\"titrtabl\" width=\"84\" bgcolor=\"#FFE5B2\">$date</td>\n";
echo"<td class=\"titrtabl\" width=\"135\" bgcolor=\"#FFE5B2\">\n";
$ab = DatabaseOperation::query("select * from salaries where id_user='$rows[id_user]'");
$ligne = mysql_fetch_array($ab);
echo "$ligne[nom] $ligne[prenom]</td>\n";

$commentr=stripslashes($rows[commentaire]);

echo"<td class=\"titrtabl\" width=\"350\" bgcolor=\"#FFE5B2\">$commentr</td>\n";
echo"<td class=\"titrtabl\" width=\"130\" bgcolor=\"#FFE5B2\"><a href=\"$PHP_SELF?action=suppr&numcom=$rows[id_comment]&num=$num\">effacer</a></td>\n\n";
echo"</tr>";}
echo"</table>\n";

if (($action!="suppr") and ($action!="modif")){
echo "<br><a href=\"modera1.php?auteurs=$auteur&action=recherche\"><img src=\"../zimages/retour-j.gif\" width=\"130\" height=\"20\" border=\"0\"></a>";
}
?>

     </td>
   </tr>

  </table>
<br>
<?php
  include ("../adminagis/cadrebas.php");
?>
</html>