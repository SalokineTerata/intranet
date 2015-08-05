<?php
//  require("../lib/session.php");
//  include("../lib/functions.php");
require_once '../inc/main.php';
  identification1("salaries", $login, $pass);
  securadmin(4, $id_type);

/* Recherche des valeurs a afficher*/
    $req="select nom, prenom from salaries where id_user='$idUser'";
    $result=DatabaseOperation::query($req);
    if ($result==false)
      echo ("il y a un probleme de lecture dans la table publicateur");
    else
    {
      $sal_nom=mysql_result($result, 0, nom);
      $userPrenom=mysql_result($result, 0, prenom);
    }
?>
<html>
<head>
<title>Gestion des publicateurs</title>
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
<form method="post" action="gestion_public1.php">
<table width="620" border="0" cellspacing="0" cellpadding="0" height="319" align="left">
  <tr>
    <td>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/bandeau_etape0.gif height="62"></td>
          <td><img src="../images_pop/gestion_public.gif" width="500" height="62"></td>
          <td><a href="../aide.php#adminnew" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="10"></td>
        </tr>

        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="30"></td>
        </tr>
      </table>
      <table width="500" border="0" cellspacing="4" cellpadding="0" align="center">
        <tr>
          <td width="50%" class="loginFFFFFF">Nom du publicateur : </td>
          <td class="loginFFCC66">
            <?php
  echo ("$userPrenom $sal_nom\n");
?>
          </td>
        </tr>
        <tr>
          <td width="50%" class="loginFFFFFF">Nom de son administrateur :</td>
          <td class="loginFFCC66">
            <?php
/* LISTE DEROULANTE des administrateurs et super admin*/
    echo ("<select name=\"admin\">\n");
    $req="select distinct id_user, nom, prenom from salaries
    where id_type>2 order by nom";
    $result=DatabaseOperation::query($req);
/* Recherche du nom de l'administrateur de la personne */
    $req2="select * from publicateur where id_user='$idUser'";
    $result2=DatabaseOperation::query($req2);
    $num2=mysql_num_rows($result2);
    if ($num2==false)
    {
      $admin=null;
      echo ("<option></option>");
    }
    else
      $admin=mysql_result($result2, 0, admin);
    if ($result!= false)
    {
      while ($row=mysql_fetch_row($result))
      {
        if ($admin==$row[0])
          echo ("<option value=\"$row[0]\" selected>$row[2] $row[1]</option>");
        else
          echo ("<option value=\"$row[0]\">$row[2] $row[1]</option>");
      }
      echo ("</select>\n");
    }
?>
          </td>
        </tr>
        <tr>
          <td width="50%">&nbsp;</td>
          <td class="loginFFCC66">&nbsp; </td>
        </tr>
        <tr>
          <td colspan="2" class="loginFFCC66" height="70">
            <p align="center" class="loginFFCC66Ccentre">Services sous sa responsabilit&eacute;</p>
            </td>
        </tr>
        <?php
// Constitution de la liste des services
  //$req="select id_service, intitule_ser from services";
  $req="select K_service, nom_service FROM access_materiel_service ORDER BY nom_service";
  $result=DatabaseOperation::query($req);
  if ($result != false)
  {
    $num=mysql_num_rows($result);
    $i=0;
    while ($i<$num)
    {
      $intitule_ser=mysql_result($result, $i, "nom_service");
      $id_servicete=mysql_result($result, $i, "K_service");

      $intitule_ser=stripslashes($intitule_ser);
      $req2="select * from publicateur where id_user='$idUser' and id_service='$id_servicete'";
      $res2 = mysql_query ($req2);
      $num2=mysql_num_rows($res2);

      echo ("  <tr>\n");
      echo ("    <td  class=\"loginFFFFFF\">\n");
      echo ("      <div align=\"right\">\n");
// recherche pour savoir si la case doit etre cochee
      if ($num2 == 0)
        echo (" <input type=\"checkbox\" name=\"$id_servicete\" value=\"$id_servicete\">");
      else
        echo (" <input type=\"checkbox\" name=\"$id_servicete\" value=\"$id_servicete\"checked>\n");
      echo ("    </div>\n");
      echo ("    </td>\n");
      echo ("    <td class=\"loginFFFFFF\">$intitule_ser </td>\n");
      echo ("  </tr>\n");
      $i++;
    }
  }
?>
        <tr>
          <td class="loginFFFFFF" colspan="2">
            <div align="center">
              <input type="image" src="../zimages/modifier-j.gif" width="130" height="20" alt="Modifier et enregistrer les Services cochés">
            </div>
            <input type="hidden" name="mod" value="mod">
            <?php
  echo ("<input type=\"hidden\" name=\"sal_user\" value=\"$idUser\">");
?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php  include ("../adminagis/cadrebas.php"); ?>
</body>
</html>