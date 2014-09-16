<?php
//  require("../lib/session.php");
//  include("../lib/functions.php");
require_once '../inc/main.php';
identification1("salaries", $login, $pass);
  securadmin(4, $id_type);

  if ($mod=="mod")
  {
// Pour la modification on efface toutes les lignes existantes
// dans la table DIFFUSION et on reinsere les nouvelles lignes

    $req="delete from publicateur where id_user='$sal_user'";
    $result=DatabaseOperation::query($req);

// traitement des valeurs recupérées
    $req="select K_service from access_materiel_service";
    $result=DatabaseOperation::query($req);
    if ($result != false)
    {
      $num=mysql_num_rows($result);
      $i=0;
      while ($i<$num)
      {
// Recuperation des numéros des services
          $id_servicete=mysql_result($result, $i, "K_service");
          $toto="id_servicete";
          $text= $$toto;
          $numser=$$text;
          if ($id_servicete==$numser)
          {
// Insertion dans la table PUBLICATEUR
            $req2="insert into publicateur values ('$sal_user', '$numser', '$admin')";
            $result2=DatabaseOperation::query($req2);
          }
      $i++;
      }
    }
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
<form method="post" action="gestion_public2.php">
<table width="620" border="0" cellspacing="0" cellpadding="0" align="left">
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
          <td class="loginFFFFFF">
            <div align="center">Liste des publicateurs
<?php
//    LISTE DEROULANTE
    $req="select distinct id_user, nom, prenom from salaries
    where id_type>=2 and actif='oui' order by nom";
    $result=DatabaseOperation::query($req);
    if ($result!= false)
    {
      echo ("<select name=\"sal_user\">\n");
      while ($row=mysql_fetch_row($result))
      {
        echo ("<option value=\"$row[0]\">$row[2] $row[1]</option>");
      }
      echo ("</select>\n");
    }
?>
            </div>
          </td>
        </tr>
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="30"></td>
        </tr>
        <tr>
          <td>
            <center>
              <input type="image" border="0" src="../zimages/valider-j.gif" width="130" height="20" alt="Valider et atteindre la fiche du Publicateur">
              <input type="hidden" name="valider" value="valider">
            </center>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</form>
<?php  include ("../adminagis/cadrebas.php"); ?>
</body>
</html>