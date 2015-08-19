<?php
  require("../lib/session.php");
  include("../lib/functions.php");
  identification1("salaries", $login, $pass);
  UserModel::securadmin(2, $id_type);
  include("functions.php");
  include("functions.js");



  if ($modifier=="mod")
  {
/* Recherche des elements de l'article */
    $req="select * from articles where num_article='$num_article'";
    $result=DatabaseOperation::query($req);
    if ($result!=false)
    {
      $auteur=mysql_result($result, 0, auteur);
      $publica=mysql_result($result, 0, publica);
      $titre_art=mysql_result($result, 0, titre_art);
      $date_crea=mysql_result($result, 0, date_crea);
      $date_modif=mysql_result($result, 0, date_modif);
      $nivo_conf=mysql_result($result, 0, nivo_conf);
      $img_1_alt=mysql_result($result, 0, img_1_alt);
//      $img_1_nom=mysql_result($result, 0, img_1_nom);
      $img_1_nom=$num_article."_1.png";

      $img_2_alt=mysql_result($result, 0, img_2_alt);
//      $img_2_nom=mysql_result($result, 0, img_2_nom);
      $img_2_nom=$num_article."_2.png";

      $txt_1=mysql_result($result, 0, txt_1);
      $txt_2=mysql_result($result, 0, txt_2);
      $lien_1_type=mysql_result($result, 0, lien_1_type);
      $lien_1_cont=mysql_result($result, 0, lien_1_cont);
      $lien_1_txt=mysql_result($result, 0, lien_1_txt);
      $lien_2_type=mysql_result($result, 0, lien_2_type);
      $lien_2_cont=mysql_result($result, 0, lien_2_cont);
      $lien_2_txt=mysql_result($result, 0, lien_2_txt);
      $lien_3_type=mysql_result($result, 0, lien_3_type);
      $lien_3_cont=mysql_result($result, 0, lien_3_cont);
      $lien_3_txt=mysql_result($result, 0, lien_3_txt);
      $nomliste=mysql_result($result, 0, diffusion);
      $sujet=mysql_result($result, 0, sujet);

      $txt_1=stripslashes($txt_1);
      $txt_2=stripslashes($txt_2);
      $sujet=stripslashes($sujet);
      $titre_art=stripslashes($titre_art);
      $publica=stripslashes($publica);
      $auteur=stripslashes($auteur);
      $lien_1_txt=stripslashes($lien_1_txt);
      $lien_2_txt=stripslashes($lien_2_txt);
      $lien_3_txt=stripslashes($lien_3_txt);
      

    }

/* Recherche des noms auteur et publicateur */
    if ($auteur != null)
    {
      $req="select nom, prenom from salaries where id_user='$auteur'";
      $result=DatabaseOperation::query($req);
      $nomaut=mysql_result($result, 0, nom);
      $prenomaut=mysql_result($result, 0, prenom);
    }
    if ($publica != null)
    {
      $req="select * from salaries where id_user='$publica'";
      $result=DatabaseOperation::query($req);
      $nompub=mysql_result($result, 0, nom);
      $prenompub=mysql_result($result, 0, prenom);
    }
  }
?>
<html>
<head>
<title>news-court</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../lib/css/admin_intra01.css" type="text/css">
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
<?php  include ("../adminagis/cadrehautnews.php"); ?>
<?php echo ("<form ENCTYPE=\"multipart/form-data\" method=\"post\" name=\"principal\" action=\"news_courte.php\">\n");
   echo ("<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1000000\">");
?>
<table width="620" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/bandeau_etape0.gif height="61"></td>
          <td><img src="../images_pop/article_court.gif" width="500"></td>
          <td><a href="../aide.php#adminnew" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <img src=../lib/images/espaceur.gif width="10" height="20">
      <table width="85%" border="0" cellspacing="4" cellpadding="0" bgcolor="FFE5B2" align="center">
        <tr>
          <td class="loginFFFFFFdroit" width="5%">&nbsp;</td>
          <td class="loginFFFFFFdroit" width="15%">Auteur</td>
          <td class="loginFFFFFF" width="30%">
<?php
// Nom user
  $req="select nom, prenom from salaries where id_user='$id_user'";
  $result=DatabaseOperation::query($req);
  if ($result!=false)
  {
    $sal_nom=mysql_result($result, 0, nom);
    $sal_prenom=mysql_result($result, 0, prenom);
    echo ("$sal_prenom $sal_nom");
  }
?>
            </td>
          <td class="loginFFFFFFdroit" width="15%">Publi&eacute; par</td>
          <td class="loginFFFFFF" width="30%">-</td>
          <td class="loginFFFFFF" width="5%">&nbsp;</td>
        </tr>
        <tr>
          <td class="loginFFFFFFdroit">&nbsp;</td>
          <td class="loginFFFFFFdroit" width="11%">Date d'origine</td>
          <td class="loginFFFFFF" width="30&ugrave;">
<?php
  $date_crea=affiche_date($date_crea);
  echo ("$date_crea");
?>
            </td>
          <td class="loginFFFFFFdroit">Derni&egrave;re modification</td>
          <td class="loginFFFFFF">
<?php
  if ($date_modif==0)
    echo ("-");
  else
  {
    $date_modif=affiche_date($date_modif);
    echo ("$date_modif");
  }
?>
            </td>
          <td class="loginFFFFFF" width="5%">&nbsp;</td>
        </tr>
      </table>
      <table width="85%" border="0" cellspacing="4" cellpadding="0" bordercolor="#FFCC66" align="center">
        <tr>
          <td class="loginFFFFFFdroit" valign="top" rowspan="2" align="center">
            <div align="center"><img src=../lib/images/icone_confidentialite.gif width="20" height="41"></div>
          </td>
          <td class="loginFFFFFFdroit" valign="bottom">
            <div align="center">
              <input type="radio" name="choixconf" value="nivo"
<?php
  if ($nivo_conf!='')
    echo ("checked");
?>
              >
            </div>
          </td>
          <td class="loginFFFFFFdroit" valign="middle">
            <div align="left">Niveau
              <input type="text" name="nivo_conf" size="2" class="txtfield" maxlength="2"
<?php
  echo ("value=\"$nivo_conf\"");
?>
              >
            </div>
          </td>
          <td class="loginFFFFFF">
            <div align="right"><span class="loginFFFFFFdroit">Titre </span>
              <input type="text" name="titre_art" size="40" class="txtfield"
<?php
  echo (" value =\"$titre_art\"");
?>
              >
            </div>
          </td>
        </tr>
        <tr>
          <td class="loginFFFFFFdroit" valign="bottom">
            <div align="center">
              <input type="radio" name="choixconf" value="diff"
<?php
  if ($nomliste!='')
    echo ("checked");
?>
              >
            </div>
          </td>
          <td class="loginFFFFFFdroit">
            <div align="left">Diffusion
<?php
// Liste déroulante des listes de diffusion
    $req="select distinct nomliste from diffusion order by nomliste";
    $result=DatabaseOperation::query($req);
    if ($result!= false)
    {
      echo ("<select name=\"nomliste\">\n");
      while ($row=mysql_fetch_row($result))
      {
        if ($nomliste==$row[0])
          echo ("<option value=\"$row[0]\" selected>$row[0]</option>");
        else
          echo ("<option value=\"$row[0]\">$row[0]</option>");
      }
      echo ("</select>\n");
    }
?>
            </div>
          </td>
          <td class="loginFFFFFF">
            <div align="right"><span class="loginFFFFFFdroit">Sujet</span>
              <input type="text" name="sujet" size="40" class="txtfield"
<?php
  echo (" value =\"$sujet\"");
?>
              >
            </div>
          </td>
        </tr>
      </table>
      <img src="../administration/images/espaceur.gif" width="1" height="10"><img src="../administration/images/espaceur.gif" width="1" height="10">

      
      <table width="100%" border="1" cellspacing="4" cellpadding="0" name="tablo008" align="center" bgcolor="FFFFFF">
        <tr>
          <td class="loginFFFFFF" width="72" height="71"><img src=../lib/images/bouton_image.gif width="72" height="71"></td>
          <td class="txttabl">
            <p align="center">
              <textarea name="txt_1" cols="60" rows="4" class="txtfield">
<?php
$txt_1 = eregi_replace("<br />", "", $txt_1);
$txt_1 = eregi_replace("<br>", "", $txt_1);
$txt_1 = eregi_replace("</br>", "", $txt_1);
  echo ("$txt_1");
?>
              </textarea>
            </p>
          </td>
        </tr>
      </table>      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      <table width="100%" border="1" cellspacing="4" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr bgcolor="ffe5b2">
          <td width="25%" class="loginFFFFFF">
            <div align="left" class="logFFE5B2"><img src=../lib/images/bouton_aide_point_interrogation.gif width="25" height="26"><br>
              Pour ins&eacute;rer vos propres images &agrave; partir de votre
              disque au format .gif ou .jpg. La dimension disponible sera ajust&eacute;e
              automatiquement</div>
          </td>
          <td valign="middle" colspan="4">
            <div align="right">
              <p class="logFFE5B2">
<?php
  echo ("L'image en cours est: $img_1_nom<br>");
?>
                <input type="file" name="img_1_nom">
              </p>
            </div>
          </td>
          <td class="logFFE5B2">
            <div align="center" width="25">Infobulle<br>
              <input type="text" name="img_1_alt" size="8"
<?php
  echo (" value =\"$img_1_alt\"");
?>
              >
            </div>
          </td>
        </tr>
        <tr bgcolor="ffe5b2">
          <td class="loginFFFFFF">
            <div class="logFFE5B2"> <img src=../lib/images/bouton_aide_point_interrogation.gif width="25" height="26"><br>
              Si vous n'avez pas d'images sur mesure, choisissez une de ces images
              g&eacute;n&eacute;riques</div>
          </td>
          <td bgcolor="ffe5b2">
            <div align="center">
              <input type="radio" name="img_1_nomr" value="photo1.jpg"
<?php
  if ($img_1_nom=="photo1.jpg")
    echo ("checked");
?>
              >
              <br>
              <img src=images/photo1.jpg width="72" height="71"> </div>
          </td>
          <td bgcolor="ffe5b2">
            <div align="center">
              <input type="radio" name="img_1_nomr" value="photo2.jpg"
<?php
  if ($img_1_nom=="photo2.jpg")
    echo ("checked");
?>
              >
              <br>
              <img src="images/photo2.jpg" width="72" height="71"></div>
          </td>
          <td bgcolor="ffe5b2">
            <div align="center">
              <input type="radio" name="img_1_nomr" value="photo3.jpg"
<?php
  if ($img_1_nom=="photo3.jpg")
    echo ("checked");
?>
              >

              <br>
              <img src="images/photo3.jpg" width="72" height="71"></div>
          </td>
          <td bgcolor="ffe5b2">
            <div align="center">
              <input type="radio" name="img_1_nomr" value="photo4.jpg"
<?php
  if ($img_1_nom=="photo4.jpg")
    echo ("checked");
?>
              >

              <br>
              <img src="images/photo4.jpg" width="72" height="71"></div>
          </td>
          <td bgcolor="ffe5b2">
            <div align="center">
              <input type="radio" name="img_1_nomr" value="photo5.jpg"
<?php
  if ($img_1_nom=="photo5.jpg")
    echo ("checked");
?>
              >

              <br>
              <img src="images/photo5.jpg" width="72" height="71"></div>
          </td>
        </tr>
      </table>
      <img src=../lib/images/espaceur.gif width="20" height="20">
      <table width="100%" border="1" cellspacing="4" cellpadding="0" name="tablo005" align="center" bgcolor="FFFFFF">
        <tr>
          <td class="loginFFFFFF" width="72" height="71"><img src=../lib/images/bouton_image.gif width="72" height="71"></td>
          <td class="txttabl">
            <p align="center">
              <textarea name="txt_2" cols="60" rows="4" class="txtfield">
<?php
$txt_2 = eregi_replace("<br />", "", $txt_2);
$txt_2 = eregi_replace("<br>", "", $txt_2);
$txt_2 = eregi_replace("</br>", "", $txt_2);
  echo ("$txt_2");
?>
              </textarea>
            </p>
          </td>
        </tr>
      </table>
      <table width="100%" border="1" cellspacing="4" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr bgcolor="ffe5b2">
          <td class="loginFFFFFF">
            <div align="left" class="logFFE5B2"><img src=../lib/images/bouton_aide_point_interrogation.gif width="25" height="26"><br>
              Pour ins&eacute;rer vos propres images &agrave; partir de votre
              disque au format .gif ou .jpg. La dimension disponible sera ajust&eacute;e
              automatiquement</div>
          </td>
          <td valign="middle" colspan="4">
            <div align="right">
              <p class="logFFE5B2">
<?php
  echo ("Le nom de l'image actuel est $img_2_nom");
?>
                <input type="file" name="img_2_nom">
                <br>
                </p>
            </div>
          </td>
          <td class="logFFE5B2" width="25">
            <div align="center">Infobulle<br>
              <input type="text" name="img_2_alt" size="8"
<?php
  echo ("value=\"$img_2_alt\"");
?>
              >
            </div>
          </td>
        </tr>
        <tr bgcolor="ffe5b2">
          <td class="loginFFFFFF">
            <div class="logFFE5B2"> <img src=../lib/images/bouton_aide_point_interrogation.gif width="25" height="26"><br>
              Si vous n'avez pas d'images sur mesure, choisissez une de ces images
              g&eacute;n&eacute;riques</div>
          </td>
          <td bgcolor="ffe5b2">
            <div align="center">
              <input type="radio" name="img_2_nomr" value="photo1.jpg"
<?php
  if ($img_2_nom=="photo1.jpg")
    echo ("checked");
?>
              >

              <br>
              <img src=images/photo1.jpg width="72" height="71"> </div>
          </td>
          <td bgcolor="ffe5b2">
            <div align="center">
              <input type="radio" name="img_2_nomr" value="photo2.jpg"
<?php
  if ($img_2_nom=="photo2.jpg")
    echo ("checked");
?>
              >

              <br>
              <img src="images/photo2.jpg" width="72" height="71"></div>
          </td>
          <td bgcolor="ffe5b2">
            <div align="center">
              <input type="radio" name="img_2_nomr" value="photo3.jpg"
<?php
  if ($img_2_nom=="photo3.jpg")
    echo ("checked");
?>
              >
              <br>
              <img src="images/photo3.jpg" width="72" height="71"></div>
          </td>
          <td bgcolor="ffe5b2">
            <div align="center">
              <input type="radio" name="img_2_nomr" value="photo4.jpg"
<?php
  if ($img_2_nom=="photo4.jpg")
    echo ("checked");
?>
              >
              <br>
              <img src="images/photo4.jpg" width="72" height="71"></div>
          </td>
          <td bgcolor="ffe5b2">
            <div align="center">
              <input type="radio" name="img_2_nomr" value="photo5.jpg"
<?php
  if ($img_2_nom=="photo5.jpg")
    echo ("checked");
?>
              >

              <br>
              <img src="images/photo5.jpg" width="72" height="71"></div>
          </td>
        </tr>
      </table>
      <img src=../lib/images/espaceur.gif width="10" height="20">
      <table width="80%" border="0" cellspacing="4" cellpadding="0">
        <tr>
          <td bordercolor="#000000" class="loginFFCC66">Quelques liens utiles</td>
        </tr>
      </table>
      <table width="100%" border="1" cellspacing="4" cellpadding="0" bgcolor="ffffff">
        <tr bgcolor="FFE5B2">
          <td class="logFFE5B2" bordercolor="#000000" bgcolor="FFE5B2">Type
<?php
  echo ("<select name=\"lien_1_type\">".makeSelectListChecked('agis', 'articles', 'lien_1_type', $lien_1_type)."</select>");
?>
          </td>
          <td class="logFFE5B2" bordercolor="#000000"> Lien
            <input type="text" name="lien_1_cont"
<?php
  echo ("value=\"$lien_1_cont\"");
?>
            >
          </td>
          <td valign="top" class="logFFE5B2">Texte
            <input type="text" name="lien_1_txt"
<?php
  echo ("value=\"$lien_1_txt\"");
?>
            >
          </td>
        </tr>
        <tr bgcolor="FFE5B2">
          <td class="logFFE5B2" bordercolor="#000000" height="14">Type
<?php
  echo ("<select name=\"lien_2_type\">".makeSelectListChecked('agis', 'articles', 'lien_2_type', $lien_2_type)."</select>");
?>
          </td>
          <td class="logFFE5B2" bordercolor="#000000"> Lien
            <input type="text" name="lien_2_cont"
<?php
  echo ("value=\"$lien_2_cont\"");
?>
            >
          </td>
          <td valign="top" class="logFFE5B2">Texte
            <input type="text" name="lien_2_txt"
<?php
  echo ("value=\"$lien_2_txt\"");
?>
            >
          </td>
        </tr>
        <tr bgcolor="FFE5B2">
          <td class="logFFE5B2" bordercolor="#000000">Type
<?php
  echo ("<select name=\"lien_3_type\">".makeSelectListChecked('agis', 'articles', 'lien_3_type', $lien_3_type)."</select>");
?>
          </td>
          <td class="logFFE5B2" bordercolor="#000000"> Lien
            <input type="text" name="lien_3_cont"
<?php
  echo ("value=\"$lien_3_cont\"");
?>
            >
          </td>
          <td valign="top" class="logFFE5B2">Texte
            <input type="text" name="lien_3_txt"
<?php
  echo ("value=\"$lien_3_txt\"");
?>
            >
          </td>
        </tr>
      </table>
      <img src=../lib/images/espaceur.gif width="10" height="20">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td>
            <center>
              </center>
          </td>
          <td>
            <div align="right">

            <a href="#" onClick="oblig();"><img src="../zimages/valider-j.gif" border="0" width="130" height="20"></a>
            </div>
            <INPUT TYPE="HIDDEN" NAME="modification" value="modification">
<?php
   echo ("<INPUT TYPE=\"HIDDEN\" NAME=\"num_article\" value=\"$num_article\">\n");
?>
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