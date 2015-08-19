<?php
//  require("../lib/session.php");
//  include("../lib/functions.php");
require_once '../inc/main.php';
$globalConfig = new GlobalConfig();
$login = $globalConfig->getAuthenticatedUser()->getKeyValue();
$id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();
$pass = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_PASSWORD)->getFieldValue();
$id_type = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_ID_TYPE)->getFieldValue();

identification1("salaries", $login, $pass);
  UserModel::securadmin(4, $id_type);

  if ($valider == 'services')
  {
    // Creation de l'id services
    $req="select id_service from services where id_service like '$id_groupe%' order by id_service";
    $result=DatabaseOperation::query($req);
    if ($result != false)
    {
      $num=mysql_num_rows($result)-1;
      $id=mysql_result($result, $num, id_service);
      $id=substr ($id, -1);
      $id++;
      if ($id=='')
        $id=1;
      $id_ser=$id_groupe."_".$id;
    }

// Par défaut dans la table modes on donne le niveau definit a tous les salaries present pour ce nouveau service
    $req="select distinct id_user from modes";
    $result=DatabaseOperation::query($req);
    if ($result != false)
    {
      $num=mysql_num_rows($result);
      $i=0;
      while ($i<$num)
      {
        $user=mysql_result($result, $i, id_user);
        $req2="insert into modes (id_user, id_service, serv_conf)
        values ('$user', '$id_ser', '$niveau')";
        $result2=DatabaseOperation::query($req2);
        if ($result2 == false)
          echo ("Les insertions en masse dans la tables modes non pas fonctionnées");
        $i++;
      }
    }
    if (($id_groupe!=null)&&($intitule_ser!=null)&&($id_groupe!=null))
    {
      // Insertion dans la table services
      $intitule_ser=addslashes($intitule_ser);
      $req="insert into services (id_service, intitule_ser, id_groupe) values('$id_ser', '$intitule_ser', '$id_groupe')";
      $result=DatabaseOperation::query($req);
      if ($result == false)
        echo ("Insertion dans la table SERVICES non reussie");
    }
  }


?>
<html>
<head>
<title>Gestion des services</title>
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
<?php
include ("cadrehautent.php");
  echo ("<form method=\"post\" action=\"$PHP_SELF\">\n");
?>
<table width="620" border="0" cellspacing="0" cellpadding="0" align="left" height="133">
  <tr>
    <td>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/bandeau_etape0.gif height="62"></td>
          <td><img src="../images_pop/gestion_services.gif" width="500" height="62"></td>
          <td><a href="../aide.php#entreprise" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
      <img src=../lib/images/espaceur.gif width="10" height="20">
      <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td class="LOGINFFFFFFCENTRE">&nbsp;</td>
          <td class="LOGINFFFFFFCENTRE">&nbsp;</td>
          <td class="LOGINFFFFFFCENTRE">&nbsp;</td>
        </tr>
        <tr>
          <td class="loginFFCC66centre" height="35" colspan="3">Ajouter un nouveau
            Service </td>
        </tr>
        <tr>
          <td class="LOGINFFFFFFCENTRE" height="20">Intitul&eacute; du nouveau
            service</td>
          <td class="LOGINFFFFFFCENTRE" height="20">Groupe d'appartenance</td>
          <td class="LOGINFFFFFFCENTRE" height="20">Niveau confidentialit&eacute;
            par d&eacute;faut</td>
        </tr>
        <tr>
          <td class="LOGINFFFFFFCENTRE">
            <input type="text" name="intitule_ser" class="txtfield">
          </td>
          <td class="LOGINFFFFFFCENTRE">
            <?php
  echo ("<select name=\"id_groupe\">\n");
// Constitution de la liste déroulante des noms des groupes
  $req="select * from groupes";
  $result=DatabaseOperation::query($req);
  if ($result!= false)
  {
    while ($row=mysql_fetch_row($result))
    {
      echo ("<option value=\"$row[0]\">$row[1]</option>");
    }
  }
  echo ("</select>\n");
?>
          </td>
          <td class="LOGINFFFFFFCENTRE">
            <input type="text" name="niveau" maxlength="3" size="5">
          </td>
        </tr>
        <tr>
          <td colspan="3"><img src=../lib/images/espaceur.gif width="10" height="10"></td>
        </tr>
        <tr>
          <td colspan="3" height="70">
            <div align="center">
              <input type="image" src="../zimages/valider-j.gif" width="130" height="20" alt="Valider et enregistrer le nouveau Service">
            </div>
            <input type="hidden" name="valider" value="services">
          </td>
        </tr>
      </table>
      <table width="600" border="1" cellspacing="2" cellpadding="0" align="center">
        <tr>
          <td colspan="3" class="loginFFCC66centre" height="35">Services existants
          </td>
        </tr>
        <tr>
          <td class="logFFE5B2" height="17">
            <center>
              Num&eacute;ro
            </center>
          </td>
          <td class="logFFE5B2" height="17">
            <center>
              Intitul&eacute;
            </center>
          </td>
          <td class="logFFE5B2" height="17">
            <center>
              Groupe
            </center>
          </td>
        </tr>
        <tr>
          <td class="loginFFFFFF" colspan="3"><img src=../lib/images/espaceur.gif width="10" height="10"></td>
        </tr>
        <?php

// Affichage du contenu de la table SERVICES
  $req="select * from services order by id_service";
  $result=DatabaseOperation::query($req);
  if ($result != false)
  {
    $num=mysql_num_rows($result);
    $i=0;
    while ($i<$num)
    {
      $id_ser=mysql_result($result, $i, id_service);
      $intitule_ser=mysql_result($result, $i, intitule_ser);
      $id_groupe=mysql_result($result, $i, id_groupe);
      $req2="select intitule_gr from groupes where id_groupe='$id_groupe'";
      $result2=DatabaseOperation::query($req2);
      if ($result2 == false)
      {
        echo ("Erreur de lecture de la table GROUPES");
      }
      else
      {
        $intitule_gr=mysql_result($result2, 0, intitule_gr);
      }
      $intitule_gr=stripslashes($intitule_gr);
      $intitule_ser=stripslashes($intitule_ser);
      echo ("<tr>\n");
      echo ("<td class=\"loginFFFFFF\" align=\"center\">$id_ser&nbsp;</td>\n");
      echo ("<td class=\"loginFFFFFF\" align=\"center\">$intitule_ser&nbsp;</td>\n");
      echo ("<td class=\"loginFFFFFF\" align=\"center\">$intitule_gr&nbsp;</td>\n");
      echo ("</tr>\n");
      $i++;
    }
  }

?>
      </table>
    </td>
  </tr>
</table>
</form>
<?php  include ("../adminagis/cadrebas.php"); ?>
</body>
</html>