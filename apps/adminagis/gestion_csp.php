<?php
//  require ("../lib/session.php");
//  include("../lib/functions.php");
      require_once '../inc/main.php';
$globalConfig = new GlobalConfig();
$login = $globalConfig->getAuthenticatedUser()->getKeyValue();
$id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();
$pass = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_PASSWORD)->getFieldValue();
$id_type = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_ID_TYPE)->getFieldValue();

  identification1("salaries", $login, $pass,FALSE);
   

  include("functions.js");
  if ($valider == 'catsopro')
  {
    if (($intitule_cat!=null)&&($nivo_glo!=null)&&($nivo_pro))
    {
      /* Insertion dans la table catsopro*/
      $intitule_cat=addslashes($intitule_cat);
      $req="insert into catsopro (intitule_cat, nivo_pro, nivo_glo) values('$intitule_cat', '$nivo_pro', '$nivo_glo')";
      $result=DatabaseOperation::query($req);
      if ($result == false)
        echo ("Insertion dans la table $valider non reussie");
    }
  }

  if ($valider == '2')
  {
/* Insertion dans la table catsopro*/
    $req="update catsopro set intitule_cat='$intitule_cat', nivo_pro='$nivo_pro', nivo_glo='$nivo_glo' where id_catsopro='$catsopro'";
    $result=DatabaseOperation::query($req);
    if ($result == false)
      echo ("update dans la table catsopro non reussie");

/* Quand modification des niveaux dans la table modifications en cascade dans la table modes
// Recherche des salaries appartenant a cette CSP*/
    $req="select id_user, id_service from salaries where id_catsopro='$catsopro'";
    $result=DatabaseOperation::query($req);
    if ($result != false)
    {
/* Pour chacun des salaries, on modifie le niveau service et le niveau global*/
      $num=mysql_num_rows($result);
      $i=0;
      while ($i<$num)
      {
        $user=mysql_result($result, $i, id_user);
        $service=mysql_result($result, $i, id_service);
        $req2="update modes set serv_conf='$nivo_pro' where id_user='$user' and id_service='$service'";
        $result2=DatabaseOperation::query($req2);
        if ($result2 == false)
          echo ("Modification de l'utilisateur $user dans la table modes pour son service non reussie");
        $req2="update modes set serv_conf='$nivo_glo' where id_user='$user' and id_service<>'$service'";
        $result2=DatabaseOperation::query($req2);
        if ($result2 == false)
          echo ("Modifications de l'utilisateur $user dans la table modes pour les autres service non reussies");
        $i++;
      }
    }
    $intitule_cat=null;
    $nivo_glo=null;
    $nivo_pro=null;
  }

  if ($mod!=null)
  {
/* On fait apparaitre les elements deans les cases de saisies
// et on met valider a 2 si validation des modifs.
// Recherche des donnees*/
    $catsopro=$mod;
    $req="select * from catsopro where id_catsopro='$catsopro'";
    $result=DatabaseOperation::query($req);
    if ($result != false)
    {
      $intitule_cat=mysql_result($result, 0, intitule_cat);
      $nivo_glo=mysql_result($result, 0, nivo_glo);
      $nivo_pro=mysql_result($result, 0, nivo_pro);
    }
  }

?>
<html>
<head>
<title>Gestion des cat&eacute;gories socio-professionnelles</title>
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
<table width="620" border="0" cellspacing="0" cellpadding="0" height="240">
  <tr>
    <td>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/bandeau_etape0.gif height="62"></td>
          <td><img src="../images_pop/gestion_csp.gif" width="500" height="62"></td>
          <td><a href="../aide.php#entreprise" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="20">
          </td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td colspan="3" class="loginFFCC66centre" height="35"><img src=../lib/images/espaceur.gif width="10" height="20">Ajouter
            une nouvelle cat&eacute;gorie socio-professionnelle</td>
        </tr>
        <tr>
          <td class="LOGINFFFFFFCENTRE" height="20">Intitul&eacute; de la CSP</td>
          <td class="LOGINFFFFFFCENTRE" height="20">Niveau confidentialit&eacute;
            Service</td>
          <td class="LOGINFFFFFFCENTRE" height="20">Niveau confidentialit&eacute;
            Global</td>
        </tr>
        <tr>
          <td class="LOGINFFFFFFCENTRE">
            <?php
  echo ("<input type=\"text\" name=\"intitule_cat\" value=\"$intitule_cat\">\n");
?>
          </td>
          <td class="LOGINFFFFFFCENTRE">
            <?php
  echo ("<input type=\"text\" name=\"nivo_pro\" value=\"$nivo_pro\">\n");
?>
          </td>
          <td class="LOGINFFFFFFCENTRE">
            <?php
  echo ("<input type=\"text\" name=\"nivo_glo\" value=\"$nivo_glo\">\n");
?>
          </td>
        </tr>
        <tr>
          <td colspan="3"><img src=../lib/images/espaceur.gif width="10" height="10"></td>
        </tr>
        <tr>
          <td colspan="3" height="70">
            <div align="center">
              <input type="image" src="../zimages/valider-j.gif" width="130" height="20" alt="Valider et enregistrer la nouvelle CSP">
            </div>
            <?php
  if ($mod != null)
  {
     echo (" <input type=\"hidden\" name=\"catsopro\" value=\"$catsopro\">\n");
     echo (" <input type=\"hidden\" name=\"valider\" value=\"2\">\n");
  }
  else
  {
    echo (" <input type=\"hidden\" name=\"valider\" value=\"catsopro\">\n");
    echo (" <input type=\"hidden\" name=\"catsopro\" value=\"$catsopro\">\n");
  }
?>
          </td>
        </tr>
      </table>
      <table width="600" border="1" cellspacing="2" cellpadding="0" align="center">
        <tr>
          <td colspan="4" class="loginFFCC66centre" height="35">Cat&eacute;gories
            socio-professionnelles existantes </td>
        </tr>
        <tr>
          <td class="logFFE5B2" width="29%">Intitul&eacute;</td>
          <td class="logFFE5B2" width="18%">Niveau service</td>
          <td class="logFFE5B2" width="17%">Niveau global</td>
          <td class="logFFE5B2" width="36%">Modifications</td>
        </tr>
        <tr>
          <td class="loginFFFFFF" colspan="4"><img src=../lib/images/espaceur.gif width="10" height="10"></td>
        </tr>
        <?php

/*      echo ("<td><a href=\"catsopro.php\">Modification</a></td>\n");*/



/* Affichage du contenu de la table CATSOPRO*/
  $req="select * from catsopro";
  $result=DatabaseOperation::query($req);
  if ($result != false)
  {
    $num=mysql_num_rows($result);
    $i=0;
    while ($i<$num)
    {
      $catsopro=mysql_result($result, $i, id_catsopro);
      $intitule_cat=mysql_result($result, $i, intitule_cat);
      $nivo_pro=mysql_result($result, $i, nivo_pro);
      $nivo_glo=mysql_result($result, $i, nivo_glo);
      $intitule_cat=stripslashes($intitule_cat);
      echo ("<tr>\n");
      echo ("    <td class=\"loginFFFFFF\" width=\"29%\">\n");
      echo ("      <div align=\"center\">$intitule_cat</div>\n");
      echo ("    </td>\n");
      echo ("    <td class=\"loginFFFFFF\" width=\"18%\">\n");
      echo ("      <div align=\"center\">$nivo_pro</div>\n");
      echo ("    </td>\n");
      echo ("    <td class=\"loginFFFFFF\" width=\"17%\">\n");
      echo ("      <div align=\"center\">$nivo_glo</div>\n");
      echo ("    </td>\n");
      echo ("    <td class=\"loginFFFFFF\" width=\"36%\">\n");
      echo (" <a href=\"#\" onClick=\"MM_goToURL('parent','gestion_csp.php?mod=$catsopro&id_catsopro=$catsopro');return document.MM_returnValue\">");
      echo (" <div align=\"center\"><img src=\"../zimages/modifier-j.gif\" width=\"130\" height=\"20\" border=\"0\" alt=\"Modifier cette CSP\"</div>\n");
      echo (" </a>\n");
      echo ("    </td>\n");
      echo ("</tr>\n");
      $i++;
    }
  }
?>
      </table>
    </td>
  </tr>
</table>
<?php  include ("../adminagis/cadrebas.php"); ?>
</body>
</html>