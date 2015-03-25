<?php

$id_user = Lib::isDefined("id_user");
$repere = Lib::isDefined("repere");
$prenom = Lib::isDefined("prenom");
$lieu_geo = Lib::isDefined("lieu_geo");

$globalConfig = new GlobalConfig();
$message = $globalConfig->getConf()->getApplicationLogoMessage();
$logo = $globalConfig->getConf()->getApplicationLogo();

/**
 * @TODO A quoi sert cette partie ?
 */
if ($repere != "") {
    $position = $repere;
}

/**
 * Personnalisation selon la société de rattachement.
 */
if ($globalConfig->getConf()->getExecEnvironment() == EnvironmentConf::ENV_PRD) {
    switch ($lieu_geo) {
        case 11:
            $logo = "logo_exploitation_ati.png";
            break;
        case 12:
            $logo = "logo_exploitation_epc.png";
            break;
    }
}

//Pour les grandes occasions !!
if (0) {
    //Joyeux Noel
    $logo = "noel.gif width=80 ";
    echo "<BR><FONT SIZE=4>
        <marquee>Passez de bonnes fêtes !</marquee>
        </FONT></CENTER>
       ";
}
echo "

     <table border=0 cellspacing=0 cellpadding=0>
     <tr>
     <td width=150 colspan=2 align=center><a name=haut></a>
     <CENTER>
     <a href=../index.php><img src=../lib/images/$logo width=100  border=0></a>
";
//Pour les grandes occasions !!
if (0) {
    //Joyeux Noel  - Voeux
    echo "<BR><FONT SIZE=4>
        <marquee>Le service informatique vous souhaite une très bonne année 2007 !!!</marquee>
        </FONT></CENTER>
       ";
}
echo $message;
if ($globalConfig->exec_debug) {
    echo "<h4>Mode Debugger</h4>";
}
echo "
    </td>
  </tr>
  <tr>
    <td colspan=\"2\"><br>
    </td>
  </tr>

  <tr>
    <td height=30 colspan=\"2\" ><div align=\"center\">
";
if (!$id_user) {
    echo "Vous n'êtes pas connecté";
} else {
    echo "Bonjour $prenom<br> session active";
}
echo "</div>
    </td>
  </tr>
    </table>
  <table width=\"120\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <form name=\"connexion\" action=\"../lib/login.php\" method=post>
    <tr>
      <td colspan=\"2\">
";

if (!$id_user) {
    echo "
        nom d'utilisateur<br>
        <input type=text name=login size=15 maxlength=50 class=loginFFFFFF>
        ";
}

echo "
      </td>
    </tr>
    <tr>
      <td align=\"center\" valign=\"middle\" height=30 class=\"loginFFFFFF\" >
";
if ($id_user) {
    echo "&nbsp;&nbsp;<a href=\"../lib/login.php?session=logout\" target=_top><img src=\"../lib/images/bouton_deconnexion.png\" border=0></a>";
    echo"<br><br>&nbsp;&nbsp;";
    //if ($position=="22"){echo"<a href=\"../fichetech/indexft.php\" target=_top>";}
    //else{echo"<a href=\"../news/groupe.php?service=$id_service\" target=_top>";}
    echo"<a href=index.php target=_top>";
    echo"<img src=\"../lib/images/bouton_retour_accueil.png\" width=\"130\" height=\"20\" border=0></a>";
} else {
    echo"mot de passe<br><input type=\"password\" name=\"pass\" size=\"15\" maxlength=\"50\" class=\"loginFFFFFF\">";
    echo"</td><td align=\"left\"><input type=image src=\"../lib/images/go.png\" border=0 name=\"Submit\">";
}
echo "
      </td>
    </tr>
    </form></table>
    <table width=\"120\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
    <tr>
      <td align=\"center\" valign=\"middle\" >
      ";
if (!$id_user) {
    echo "<br><a href=\"#\" target=_top class=\"lelien\" onClick=\"MM_openBrWindow('../popup/oublipass.php','','scrollbars=no,width=400,height=300')\"><img src=\"../images-index/oubli_passe_bouton.gif\" border=0></a>";
}
echo "
      </td>
    </tr>
    <tr>
      <td align=\"center\" valign=\"middle\" colspan=\"2\">&nbsp;</td>
    </tr>

  <tr>
    <td  colspan=\"2\">&nbsp;</td>
  </tr>
</table>
";
?>
