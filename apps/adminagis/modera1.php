<?php
//include ("../lib/session.php");
//include ("../lib/functions.php");
      require_once '../inc/main.php';

identification1("salaries", $login, $pass);
UserModel::securadmin(2, $id_type);
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
<table width="620" border="0" cellspacing="0" cellpadding="0" align="left">
  <tr>
    <td align=center>
    <table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="FFE5B2">
        <tr>
          <td><img src=../lib/images/bandeau_etape0.gif height="62"></td>
          <td><img src="../images_pop/gestion_moderation.gif" width="500" height="62"></td>
          <td><a href="../aide.php#adminnew" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
<br><br><br><font class="loginFFFFFF">Sélectionner un auteur pour faire apparaître la liste des articles qu'il a rédigé.</font><br><br>
<input type="hidden" name="action" value="recherche">
<select name="auteurs" class="loginFFFFFF">
          <option value="non" selected>AUTEURS</option>
          <?php
/* on selectionne tous les auteurs en charge de la personne qui consulte */
if ($id_type=='2'){
$verif=DatabaseOperation::query("select distinct * from publicateur where id_user = $id_user");
 while ($row=mysql_fetch_array($verif)){
$requete=DatabaseOperation::query("select distinct * from articles, salaries where salaries.id_user=articles.auteur and salaries.id_service='$row[id_service]' order by nom");
  while ($rows= mysql_fetch_array($requete)){
   if ($rows[nom] != $unique){
echo "<option value=\"$rows[id_user]\">$rows[nom]</option>";
$unique = $rows[nom];
   }
  }
 }

}elseif ($id_type=='3'){
$requete=DatabaseOperation::query("select distinct * from articles, salaries where salaries.id_user=articles.auteur order by nom");
 while ($rows= mysql_fetch_array($requete)){
  if ($rows[nom] != $unique){
echo "<option value=\"$rows[id_user]\">$rows[nom]</option>";
$unique = $rows[nom];
  }
 }

}elseif ($id_type=='4'){
$requete=DatabaseOperation::query("select distinct * from articles, salaries where salaries.id_user=articles.auteur order by nom");
 while ($rows= mysql_fetch_array($requete)){
  if ($rows[nom] != $unique){
echo "<option value=\"$rows[id_user]\">$rows[nom]</option>";
$unique = $rows[nom];
  }
 }
}
?>
        </select><br><br>
        <input type="image" src="../zimages/valider-j.gif" width="130" height="20">
     </td>
    </tr>
    <tr>
    <td align=center>
    <br>
     </td>
   </tr>
    <tr>
    <td align=center >
<?php
    if (($action == "recherche") and ($auteurs != "non")){
    $result2 ="SELECT distinct * FROM modes, articles WHERE modes.id_user = $id_user and (articles.id_art_serv = modes.id_service) and (articles.nivo_conf <= modes.serv_conf) and auteur=$auteurs and (articles.publica!='') order by date_modif desc";
    $requete=DatabaseOperation::query("$result2");

   echo"<br><table width=\"90%\" border=\"1\" cellspacing=\"0\" cellpading=\"4\" bgcolor=\"FFE5B2\">";
$infos=0;
   while ($rows=mysql_fetch_array($requete)){

/* lien uniquement si commentaires */
$nbc = DatabaseOperation::query("select * from comment where id_art='$rows[num_article]'");
$nbc1 = mysql_num_rows($nbc);
if ($nbc1!=0){
/*-formatage date-*/
$date = $rows[date_crea];
$jour = substr($date, 8, 2);
$mois = substr($date, 5, 2);
$annee = substr($date, 0, 4);
$date= $jour."/".$mois."/".$annee;

$titreart=stripslashes($rows[titre_art]);

echo "<tr bgcolor=\"#FF3333\" class=\"logFFCC66\">";
echo"<td width=\"8\" bgcolor=\"FFE5B2\">$date</td>";
echo"<td width=\"250\" bgcolor=\"FFE5B2\">$titreart</td>";
echo"<td width=\"100\" bgcolor=\"FFE5B2\">";
$ab = DatabaseOperation::query("select * from salaries where id_user='$rows[auteur]'");
$ligne = mysql_fetch_array($ab);
echo "$ligne[nom] $ligne[prenom]</td>";
echo"<td width=\"100\" bgcolor=\"#FFE5B2\">";
echo "<a href=\"modera2.php?num=$rows[num_article]&auteur=$auteurs\">lien sur l'article</a></td>";
echo"<td width=\"10\" bgcolor=\"#FFE5B2\">";
echo"$nbc1</td>";
$infos=$infos + 1;
}
}
    if($infos==0){echo"L'auteur sélectionné n'a pas écrit d'article";}
    elseif($infos==1){echo"$infos article correspond à votre recherche<br>";}
    elseif($infos>1){echo"$infos articles correspondent à votre recherche<br>";}


if (($nbc1==0) and ($infos!=0)){echo"<div align=\"center\">aucun article de cette auteur ne possede de commentaires</div>";}

echo"</tr></table>";
}
?>

     </td>
   </tr>

  </table>
</form>

<br>
<?php
  include ("../adminagis/cadrebas.php");
?>
</html>