<?php
//include ("../lib/session.php");
//include ("../lib/functions.php");
      require_once '../inc/main.php';
      
identification1("salaries", $login, $pass,FALSE);
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
  include ("cadrehaut.php");
  echo ("<form method=\"post\" action=\"$PHP_SELF\">\n");
  ?>
<table width="630" border="0" cellspacing="0" cellpadding="0" align="left">
  <tr>
    <td align=center>
    <table width="630" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/bandeau_etape0.gif width="90" height="62"></td>
          <td>&nbsp;</td>
          <td><a href="../aide.php#news" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
      <br>
      <table width="400" border="0" cellspacing="4" cellpadding="0">
        <tr>
          <td width="87" class="logFFE5B2">globales</td>
          <td width="107" bgcolor="FFE5B2" align=center><a href="stats2.php" class="logFFE5B2">articles</a></td>
          <td width="107" bgcolor="FFE5B2" align=center><a href="stats1.php" class="logFFE5B2">utilisateurs</a></td>
          <td width="61" class="logFFE5B2">&nbsp;</td>
          <td width="50" class="logFFE5B2">&nbsp;</td>
        </tr>
      </table>
      <br>
      <table width="400" border="0" cellspacing="4" cellpadding="0">
        <tr>
          <td class="loginFFCC66" width="89" height="18" valign="middle">Nom / login</td>
          <td width="129" height="18" valign="middle">
            <input type="text" name="mots">
          </td>
          <td width="166" height="18" valign="middle">
            <input type="submit" name="Submit" value="Submit">
          </td>
        </tr>
      </table>
      <br><br>
<?php
/*---------------------------------
            stats globales
---------------------------------*/






?>
<?php
/*-------------------------------
affichage moteur de recherche
--------------------------------*/
if ($action=="recherche"){

 $nbcar=3;
 $mot = preg_split( "[ -/+\\*\'\"]", $mots);

/* NOMBRE D'ELEMENTS DU TABLEAU $mots */
$long = count ($mot);

// Pour chaque mot, on le mesure,
// si <=3 alors, on decale le
// tableau vers la gauche = efface
  $i=0;
  while ($i<$long)
  {
    // On mesure la longueur de la chaine
    $longcase= strlen ($mot[$i]);
    if ($longcase <=$nbcar)
    {
      // On efface le mot, on decale le tableau vers la gauche
      $j=$i;
      while ($j<=$long)
      {
        if ($j==$long)
        {  // C la derniere case du tableau
          $mots[$j]=null;
        }
        else
        {
          $mot[$j]=$mot[$j+1];
        }
        $j++;
      }
      $long--;
    }
    else
      $i++;
  }


/*****************************************************/
/* Recherche
/*****************************************************/

echo" <table width=\"400\" border=\"0\" cellspacing=\"4\"><tr>";
      echo "<tr bgcolor=\"#FF3333\" class=\"logFFCC66\">";
      echo"          <td class=\"txttabl\" width=\"200\" bgcolor=\"#FFCC66\" align=center>UTILISATEUR</td>";
      echo"          <td class=\"txttabl\" width=\"20\" bgcolor=\"#FFCC66\" align=center>ID</td>";
      echo "<td class=\"txttabl\" width=\"150\" bgcolor=\"#FFCC66\"></td>";
      echo "</tr>";
      echo"</table>";
      echo"<table width=\"400\" border=\"0\" cellspacing=\"4\"><tr>";
/* On parcourt le tableau de mot
  Requete de recherche*/
  $req="select distinct * from salaries
  where";
  $i=0;
  $req=$req." (nom like '%$mot[$i]%' or login like '%$mot[$i]%') order by nom";
  $i++;
  $result = mysql_query ($req);
  $num = mysql_num_rows($result);
  if ($num != 0)
  {
    $i=0;
    while ($i<$num)
    {
      $auteur = mysql_result($result, $i, nom);
      $auteur2 = mysql_result($result, $i, prenom);
      $num_user = mysql_result($result, $i, id_user);
      echo "<tr bgcolor=\"#FF3333\" class=\"logFFCC66\">";
      echo"          <td class=\"txttabl\" width=\"200\" bgcolor=\"#FFFFCC\">$auteur $auteur2</td>";
      echo"          <td class=\"txttabl\" width=\"20\" bgcolor=\"#FFFFCC\">$num_user</td>";
      echo "<td width=\"150\" bgcolor=\"#FFFFCC\"><a href=\"$PHP_SELF?action=detail&numi=$num_user\" class=\"loginFFFFFF\">statistiques utilisateur</a></td>";
      echo "</tr>";
      $i++;
     }
  }
echo (" </table><br><br> \n");
}



if ($action=="detail"){

$qui=DatabaseOperation::query("select * from salaries where id_user=$numi");
$rowsa=mysql_fetch_array($qui);
echo" <table width=\"400\" border=\"0\" cellspacing=\"4\"><tr>";
      echo "<tr bgcolor=\"#FF3333\" class=\"logFFCC66\">";
      echo"          <td class=\"txttabl\" width=\"200\" bgcolor=\"#FFCC66\" align=center> $rowsa[nom] $rowsa[prenom]</td>";
      echo "</tr>";
      echo"</table>";
      echo"<table width=\"400\" border=\"0\" cellspacing=\"4\"><tr>";


$quoi=DatabaseOperation::query("select * from log where id_user=$numi order by date desc limit 0,25");

echo "<tr bgcolor=\"#FF3333\" class=\"logFFCC66\">";
      echo "<td class=\"txttabl\" width=\"150\" bgcolor=\"#FFFFCC\">date</td>";
      echo "<td class=\"txttabl\" width=\"150\" bgcolor=\"#FFFFCC\">articles lus</td>";
      echo "<td class=\"txttabl\" width=\"150\" bgcolor=\"#FFFFCC\">commentaires ecrits</td>";
      echo "</tr>";

while ($rowso=mysql_fetch_array($quoi)){
      echo "<tr bgcolor=\"#FF3333\" class=\"logFFCC66\">";

$date = $rowso[date];
$jour = substr($date, 8, 2);
$mois = substr($date, 5, 2);
$annee = substr($date, 0, 4);
$date= $jour."/".$mois."/".$annee;

      echo "<td class=\"txttabl\" width=\"150\" bgcolor=\"#FFFFCC\">$date</td>";
      echo "<td class=\"txttabl\" width=\"150\" bgcolor=\"#FFFFCC\">$rowso[lect_art]</td>";
      echo "<td class=\"txttabl\" width=\"150\" bgcolor=\"#FFFFCC\">$rowso[redac_com]</td>";
      echo "</tr>";
      }

echo (" </table><br> \n");

 /* on compte le nombre d'article ecrits dans table article et archives */
echo"<table width=\"400\" border=\"0\" cellspacing=\"4\"><tr>";
echo "<tr bgcolor=\"#FF3333\" class=\"logFFCC66\">";
echo "<td class=\"txttabl\" width=\"50%\" bgcolor=\"#FFFFCC\">articles ecrits</td>";
echo "<td class=\"txttabl\" width=\"50%\" bgcolor=\"#FFFFCC\">";
$doac1=DatabaseOperation::query("select * from articles where auteur = $numi");
$doac2=mysql_num_rows($doac1);

$doac3=DatabaseOperation::query("select * from articles where auteur = $numi");
$doac4=mysql_num_rows($doac3);

$titeuf=$doac2 + $doac4;
   echo"$titeuf";
   echo"</td>";
  echo "</tr>";
echo"</table>";
  }
 ?>
<input type="hidden" name="action" value="recherche">
      <br>
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