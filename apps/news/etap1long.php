<?php
  require("../lib/session.php");
  include("../lib/functions.php");
  identification1("salaries", $login, $pass);
  include("functions.php");
  include ("functions.js");
?>
<html>
<head>
<title>Cr&eacute;ation d'article long - Etape 1</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href=../lib/css/admin_intra01.css type="text/css">
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
<?php echo ("<form ENCTYPE=\"multipart/form-data\" method=\"post\" name=\"principal\" action=\"etap2long.php\">\n");
   echo ("<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1000000\">");
?>
<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td bgcolor="#FFCC66">
      <table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td><img src="../images_pop/etape1.gif" width="119" height="62"></td>
          <td><img src="../images_pop/article_long.gif" width="553" height="62"></td>
          <td><a href="../aide.php#news" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="4" cellpadding="0" bgcolor="FFE5B2" align="center">
        <tr>
          <td class="loginFFFFFFdroit" width="5%">&nbsp;</td>
          <td class="loginFFFFFFdroit" width="17%">Auteur :</td>
          <td class="loginFFFFFF" width="30%">
<?php
// Nom user
  $req="select nom, prenom from salaries where id_user='$id_user'";
  $result=DatabaseOperation::query($req);
  if ($result!=false)
  {
    $sal_nom=mysql_result($result, 0, nom);
    $sal_prenom=mysql_result($result, 0, prenom);
    $sal_prenom=stripslashes($sal_prenom);
    $sal_nom=stripslashes($sal_nom);
    echo ("$sal_prenom $sal_nom");
  }
?>
          </td>
          <td class="loginFFFFFFdroit" width="15%">Publi&eacute; par :</td>
          <td class="loginFFFFFF" width="30%">-</td>
          <td class="loginFFFFFF" width="5%">&nbsp;</td>
        </tr>
        <tr>
          <td class="loginFFFFFFdroit">&nbsp;</td>
          <td class="loginFFFFFFdroit" width="17%">Date de cr&eacuteation :</td>
          <td class="loginFFFFFF" width="30%">
<?php
// Date du jour
  setlocale (LC_TIME, "french");
  $date=strftime ("%A %d  %B %Y");
  echo ("$date");

?>
          </td>
          <td class="loginFFFFFFdroit" width="15%">Derni&egrave;re modification :</td>
          <td class="loginFFFFFF">-</td>
          <td class="loginFFFFFF" width="5%">&nbsp;</td>
        </tr>
      </table>
      <table width="600" border="1" cellspacing="2" cellpadding="0" align="center" bgcolor="#FFCC66" bordercolor="#FFCC66">
        <tr>
          <td class="loginFFCC66" colspan="2">
            <table width="601" border="1" cellspacing="2" cellpadding="0" align="center">
              <tr>
                <td class="loginFFFFFFdroit" valign="middle" rowspan="3" align="center">
                  <div align="center"><img src=../lib/images/icone_confidentialite.gif width="20" height="41"></div>
                </td>
                <td class="loginFFFFFFCENTRE" valign="bottom" colspan="2">Confidentialit&eacute;
                  de l'article par</td>
                <td class="loginFFFFFFCENTRE">En-t&ecirc;tes de l'article</td>
              </tr>
              <tr>
                <td class="loginFFFFFFdroit" valign="middle">
                  <div align="center">
                    <input type="radio" name="choixconf" value="nivo" checked      >
                  </div>
                </td>
                <td class="loginFFFFFFdroit" valign="middle">
                  <div align="left">niveau
                    <input type="text" name="nivo_conf" size="2" maxlength="2" class="txtfield">
                  </div>
                </td>
                <td class="loginFFFFFF" valign="middle">
                  <div align="right"><span class="loginFFFFFFdroit">Titre </span>
                    <input type="text" name="titre_art" size="50" class="txtfield">
                  </div>
                </td>
              </tr>
              <tr>
                <td class="loginFFFFFFdroit" valign="middle">
                  <div align="center">
                    <input type="radio" name="choixconf" value="diff">
                  </div>
                </td>
                <td class="loginFFFFFFdroit" valign="middle">
                  <div align="left">diffusion
                    <?php
// Liste déroulante des listes de diffusion
    $req="select distinct nomliste from diffusion order by nomliste";
    $result=DatabaseOperation::query($req);
    if ($result!= false)
    {
      echo ("<select name=\"nomliste\">\n");
      while ($row=mysql_fetch_row($result))
      {
        echo ("<option value=\"$row[0]\">$row[0]</option>");
      }
      echo ("</select>\n");
    }
?>
                  </div>
                </td>
                <td class="loginFFFFFF" valign="middle">
                  <div align="right"><span class="loginFFFFFFdroit">Sujet</span>
                    <input type="text" name="sujet" size="50" class="txtfield">
                  </div>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table width="80%" border="0" cellspacing="4" cellpadding="0">
        <tr>
          <td bordercolor="#000000" class="loginFFCC66">PARTIE 1 : Image et texte
            n&deg; 1 - Haut d'article</td>
        </tr>
      </table>
      <table width="700" border="1" cellspacing="4" cellpadding="0" name="tablo001" bgcolor="#FFFFFF" align="center">
        <tr>
            <td class="loginFFFFFF" width="72" height="71"><img src=../lib/images/bouton_image.gif width="72" height="71"></td>
          <td class="txttabl">
            <p align="center">
                <textarea name="txt_1" cols="140" wrap="VIRTUAL" class="txtfield" rows="4"></textarea>
            </p>
          </td>
        </tr>
      </table>
      <table width="700" border="1" cellspacing="4" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr bgcolor="ffe5b2">
          <td width="25%" class="loginFFFFFF">
            <div align="left" class="logFFE5B2"><img src=../lib/images/bouton_aide_point_interrogation.gif width="25" height="26"><br>
              Pour ins&eacute;rer vos propres images &agrave; partir de votre
              disque au format .gif ou .jpg. La dimension disponible sera ajust&eacute;e
              automatiquement au format disponible.</div>
          </td>
          <td valign="middle" colspan="4">
            <div align="right">
              <p class="logFFE5B2"><br>
                 <input type="file" name="img_1_nom">
              </p>
            </div>
          </td>
          <td class="logFFE5B2">
            <div align="center">Infobulle<br>
                <input type="text" img_1_alt" size="10" maxlength="100">
            </div>
          </td>
        </tr>
        <tr bgcolor="ffe5b2">

          <td width="25%" class="loginFFFFFF">
            <div class="logFFE5B2"> <img src=../lib/images/bouton_aide_point_interrogation.gif width="25" height="26"><br>
              Si vous n'avez pas d'images sur mesure, choisissez une de ces images
              g&eacute;n&eacute;riques</div>
          </td>

          <td bgcolor="ffe5b2">
            <div align="center">
              <input type="radio" name="img_1_nomr" value="photo1.jpg">
              <br>
              <img src=images/photo1.jpg width="72" height="71"> </div>
          </td>

          <td bgcolor="ffe5b2">
            <div align="center">
              <input type="radio" name="img_1_nomr" value="photo2.jpg">
              <br>
              <img src="images/photo2.jpg" width="72" height="71"></div>
          </td>

          <td bgcolor="ffe5b2">
            <div align="center">
              <input type="radio" name="img_1_nomr" value="photo3.jpg">
              <br>
              <img src="images/photo3.jpg" width="72" height="71"></div>
          </td>

          <td bgcolor="ffe5b2">
            <div align="center">
              <input type="radio" name="img_1_nomr" value="photo4.jpg">
              <br>
              <img src="images/photo4.jpg" width="72" height="71"></div>
          </td>

          <td bgcolor="ffe5b2">
            <div align="center">
              <input type="radio" name="img_1_nomr" value="photo5.jpg">
              <br>
              <img src="images/photo5.jpg" width="72" height="71"></div>
          </td>
        </tr>
      </table>
      <table width="80%" border="0" cellspacing="4" cellpadding="0">
        <tr>
          <td bordercolor="#000000" class="loginFFCC66">PARTIE 2 : Zone libre
            n&deg; 1 - Pleine largeur de page</td>
        </tr>
      </table>
      <table width="700" border="1" cellspacing="4" cellpadding="0" name="tablo002" bgcolor="FFFFFF" align="center">
        <tr>
          <td class="txttablcenter">
            <table width="700" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>
                  <div align="center"><span class="logFFE5B2">Type</span> <br>
<?php
  echo ("<select name=\"zone_1_type\">".makeSelectList('agis', 'articles', 'zone_1_type')."</select>");
?>
                  </div>
                </td>
                <td>
                  <div align="center"><span class="logFFE5B2">Justification </span><br>
<?php
  echo ("<select name=\"zone_1_justif\">".makeSelectList('agis', 'articles', 'zone_1_justif')."</select>");
?>
                  </div>
                </td>
                <td>
                  <div align="center"><span class="logFFE5B2">Lien</span><br>
                    <input type="text" name="zone_1_lien" size="30">
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="3"><img src=../lib/images/espaceur.gif width="10" height="10"></td>
              </tr>
              <tr>
                <td colspan="3">
                    <div align="center">
                      <textarea name="zone_1_info" cols="160" wrap="VIRTUAL" rows="6" class="txtfield"></textarea>
                    </div>
                </td>
              </tr>
              <tr>
                <td colspan="3"><img src=../lib/images/espaceur.gif width="10" height="10"></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table width="100%" border="1" cellspacing="4" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr bgcolor="ffe5b2">
          <td width="30%" class="loginFFFFFF" bgcolor="ffe5b2">
            <div align="left" class="logFFE5B2"><img src=../lib/images/bouton_aide_point_interrogation.gif width="25" height="26"><br>
              Pour ins&eacute;rer vos propres images &agrave; partir de votre
              disque au format .gif ou .jpg. La dimension disponible sera ajust&eacute;e
              automatiquement au maximum de la largeur de la page. R&eacute;glez
              &eacute;galement la justification au centre, si vous le d&eacute;sirez.</div>
          </td>
          <td valign="middle" colspan="4">
            <div align="right">
              <p class="logFFE5B2"><br>
                 <input type="file" name=" zone_1_lienfile">
              </p>
            </div>
          </td>
            <td class="logFFE5B2">
              <div align="center">Infobulle<br>
                <input type="text" name="zone_1_infobulle" size="15">
            </div>
          </td>
        </tr>
      </table>
      <img src=../lib/images/espaceur.gif width="20" height="20">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=4,0,2,0" width="560" height="13">
              <param name=movie value=../lib/images/bandeau_frise.swf>
              <param name=quality value=high>
              <param name="BGCOLOR" value="#FFCC66">
              <param name="SCALE" value="exactfit">
              <embed src=../lib/images/bandeau_frise.swf quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" scale="exactfit" width="560" height="13" bgcolor="#FFCC66">
              </embed>
            </object></td>
          <td>
            <a href="#" onClick="oblig();"><img src="../images_pop/suite.gif" width="130" height="20" border="0" alt="Passer à l'étape 2"></a>
<?php
// Passage des parametres
  echo ("<INPUT TYPE=\"hidden\"  name=\"sal_nom\" value=\"$sal_nom\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"sal_nom\" value=\"$sal_prenom\">\n");

?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</form>
</body>
</html>