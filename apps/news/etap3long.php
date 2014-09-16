<?php
  require("../lib/session.php");
  include("../lib/functions.php");
  identification1("salaries", $login, $pass);
  include("functions.php");


/*
     Traitement des images 2
*/
    if ($img_2_nom_name)
    {
        /* on copie l'image */
        $nomimg2=$num_article."_2".substr($img_2_nom_name, -4);
        copy("$img_2_nom", "data/$nomimg2");

        /* Traitement de la taille de l'image */
        //Conversion des images GIF en PNG
        $info=pathinfo($nomimg2);
        if ($info[extension]=="gif")
        {
           $t=`gif2png data/$nomimg2`;
           $t=`rm data/$nomimg2`;
           $nomimg2=substr_replace($nomimg2, "png", -3);
        }
          //taille_image_7271("data/$nomimg2", "data/$nomimg2");
          $img_2_nom=$nomimg2;

    }
    else
    {
    /* Si aucune image, on met par defaut la photo 1 */
      $img_2_nom='images/photo1.jpg';
    }

  if ($zone_2_type=='image')
  {
    if ($zone_2_lienfile!="none")
    {
/* Traitement de l'image */
      $nomimgz2=$num_article."_4".substr($zone_2_lienfile_name, -4);
     if (!copy ($zone_2_lienfile, "../imgarticle/$nomimgz2"))
       echo ("probleme de copie de l'image\n");
    $zone_2_lien=$nomimgz2;
    $zone_2_info=$zone_2_infobulle;
    taille_image_350Y("../imgarticle/$nomimgz2", "../imgarticle/$nomimgz2");
   }
  else
    $zone_2_type='rien';
  }


  if ($zone_3_type=='image')
  {
    if ($zone_3_lienfile!="none")
    {
/* Traitement de l'image */
      $nomimgz3=$num_article."_5".substr($zone_3_lienfile_name, -4);
      if (!copy ($zone_3_lienfile, "../imgarticle/$nomimgz3"))
        echo ("probleme de copie de l'image\n");
      $zone_3_lien=$nomimgz3;
      $zone_3_info=$zone_3_infobulle;
      taille_image_350Y("../imgarticle/$nomimgz3", "../imgarticle/$nomimgz3");
    }
  else
    $zone_3_type='rien';
  }

/* Gestion des caracteres */
  $txt_2=nl2br($txt_2);
  $img_2_nom=nl2br($img_2_nom);
  $img_2_alt=nl2br($img_2_alt);
  $zone_2_type=nl2br($zone_2_type);
  $zone_2_info=nl2br($zone_2_info);
  $zone_2_justif=nl2br($zone_2_justif);
  $zone_2_lien=nl2br($zone_2_lien);
  $zone_3_type=nl2br($zone_3_type);
  $zone_3_info=nl2br($zone_3_info);
  $zone_3_justif=nl2br($zone_3_justif);
  $zone_3_lien=nl2br($zone_3_lien);

/* Gestion des caracteres */
  $txt_2=addslashes($txt_2);
  $img_2_nom=addslashes($img_2_nom);
  $img_2_alt=addslashes($img_2_alt);
  $zone_2_type=addslashes($zone_2_type);
  $zone_2_info=addslashes($zone_2_info);
  $zone_2_justif=addslashes($zone_2_justif);
  $zone_2_lien=addslashes($zone_2_lien);
  $zone_3_type=addslashes($zone_3_type);
  $zone_3_info=addslashes($zone_3_info);
  $zone_3_justif=addslashes($zone_3_justif);
  $zone_3_lien=addslashes($zone_3_lien);

  $req="update articles set txt_2='$txt_2', zone_2_type='$zone_2_type', zone_2_info='$zone_2_info', zone_2_justif='$zone_2_justif',
  zone_2_lien='$zone_2_lien', zone_3_type='$zone_3_type', zone_3_info='$zone_3_info', zone_3_justif='$zone_3_justif',
  zone_3_lien='$zone_3_lien', img_2_nom='$img_2_nom', img_2_alt='$img_2_alt'
  where num_article='$num_article'";
  $result=DatabaseOperation::query($req);
  if ($result == false)
    echo ("Il y a un probl&eacuteme d'insertion dans la table ARTICLES");

  $titre_art=stripslashes($titre_art);
  $sujet=stripslashes($sujet);

?>
<html>
<head>
<title>news-long3</title>
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
<?php echo ("<form ENCTYPE=\"multipart/form-data\" method=\"post\" name=\"principal\" action=\"news_long.php\">\n");
   echo ("<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1000000\">");
?>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
      <table width="700" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="../images_pop/etape3.gif" width="119" height="62"></td>
          <td><img src="../images_pop/article_long.gif" width="553" height="62"></td>
          <td><a href="../aide.php#news" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <table width="700" border="4" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" bordercolor="#FFCC66">
        <tr bgcolor="FFCC66">
          <td colspan="2">
            <table width="85%" border="0" cellspacing="4" cellpadding="0" bgcolor="FFE5B2" align="center">
              <tr>
                <td class="loginFFFFFFdroit" width="5%">&nbsp;</td>
                <td class="loginFFFFFFdroit" width="15%">Auteur</td>
                <td class="loginFFFFFF" width="30%">
<?php
  echo ("$sal_prenom $sal_nom\n");
?>
                </td>
                <td class="loginFFFFFFdroit" width="15%">Publi&eacute; par</td>
                <td class="loginFFFFFF" width="30%"> - </td>
                <td class="loginFFFFFF" width="5%">&nbsp;</td>
              </tr>
              <tr>
                <td class="loginFFFFFFdroit">&nbsp;</td>
                <td class="loginFFFFFFdroit" width="11%"Date d'origine</td>
                <td class="loginFFFFFF" width="30%">
<?php
/* Date du jour*/
    setlocale (LC_TIME, "french");
    $date=strftime ("%A %d  %B %Y");
    echo ("$date");

?>
                </td>
                <td class="loginFFFFFFdroit">Derni&egrave;re modification</td>
                <td class="loginFFFFFF"> - </td>
                <td class="loginFFFFFF" width="5%">&nbsp;</td>
              </tr>
            </table>
            <table width="400" border="0" cellspacing="4" cellpadding="0" bordercolor="#FFCC66" align="center">
              <tr>
                <td class="loginFFFFFFdroit" valign="top" rowspan="2" align="center" width="10%">
                  <div align="center"><img src=../lib/images/icone_confidentialite.gif width="20" height="41"></div>
                </td>
                <td class="loginFFFFFFdroit" valign="middle" width="30%">
                  <div align="center">Niveau
<?php
  echo ("$nivo_conf");
?>
                  </div>
                </td>
                <td class="loginFFFFFF" width="60%">
                  <div align="center"><span class="loginFFFFFFdroit">Titre
<?php
  echo ("$titre_art");
?>
                   </span>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="loginFFFFFFdroit">
                  <div align="center">diffusion
<?php
  echo ("$diffusion");
?>
                   </div>
                </td>
                <td class="loginFFFFFF">
                  <div align="center"><span class="loginFFFFFFdroit">Sujet
<?php
  echo ("$sujet");
?>
                  </span>
                  </div>

                </td>
              </tr>
            </table>
      <table width="80%" border="0" cellspacing="4" cellpadding="0">
        <tr>
          <td bordercolor="#000000" class="loginFFCC66">PARTIE 5 : Zone libre
            n&deg; 4 - Pleine largeur de page</td>
        </tr>
      </table>
            <table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td bgcolor="FFCC66">
                  <table width="700" border="1" cellspacing="4" cellpadding="0" name="tablo002" bgcolor="FFFFFF">
                    <tr>
                      <td class="txttablcenter">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>
                              <div align="center"><span class="logFFE5B2">Type</span>
                                <br>
<?php
  echo ("<select name=\"zone_4_type\">".makeSelectList('agis', 'articles', 'zone_4_type')."</select>");
?>
                              </div>
                            </td>
                            <td>
                              <div align="center"><span class="logFFE5B2">Justification
                                </span><br>
<?php
  echo ("<select name=\"zone_4_justif\">".makeSelectList('agis', 'articles', 'zone_4_justif')."</select>");
?>
                              </div>
                            </td>
                            <td>
                              <div align="center"><span class="logFFE5B2">Lien</span><br>
                                <input type="text" name="zone_4_lien" size="30">
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="3"><img src=../lib/images/espaceur.gif width="10" height="10"></td>
                          </tr>
                          <tr>
                            <td colspan="3">
                              <div align="center">
                                <textarea name="zone_4_info" cols="150" wrap="VIRTUAL" rows="6" class="txtfield"></textarea>
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
                </td>
              </tr>
              <tr>
                <td>
                  <table width="700" border="1" cellspacing="4" cellpadding="0" bgcolor="#FFFFFF">
                    <tr bgcolor="ffe5b2">
                      <td width="40%" class="loginFFFFFF">
                        <div align="left" class="logFFE5B2"><img src=../lib/images/bouton_aide_point_interrogation.gif width="25" height="26"><br>
                          Pour ins&eacute;rer vos propres images &agrave; partir
                          de votre disque au format .gif ou .jpg. La dimension
                          disponible sera ajust&eacute;e automatiquement</div>
                      </td>
                      <td valign="middle" colspan="4">
                        <div align="right">
                          <p class="logFFE5B2"><br>
                          <input type="file" name="zone_4_lienfile">
                          </p>
                        </div>
                      </td>
                      <td class="logFFE5B2">
                        <div align="center">Infobulle<br>
                          <input type="text" name="zone_4_infobulle" size="15">
                        </div>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td>
                  <div align="center"><img src=../lib/images/espaceur.gif width="10" height="20"><img src=../lib/images/espaceur.gif width="10" height="20"></div>
                </td>
              </tr>
              <tr>
                <td>
                  <table width="100%" border="0" cellspacing="4" cellpadding="0">
                    <tr>
                      <td bordercolor="#000000" class="loginFFCC66">Quelques liens
                        utiles</td>
                      <td align="center" valign="middle">&nbsp;</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td>
                  <table width="100%" border="1" cellspacing="4" cellpadding="0" bgcolor="ffffff">
                    <tr bgcolor="FFE5B2">
                      <td class="logFFE5B2" width="15%" bordercolor="#000000" bgcolor="FFE5B2">Type
<?php
  echo ("<select name=\"lien_1_type\">".makeSelectList('agis', 'articles', 'lien_1_type')."</select>");
?>
                      </td>
                      <td class="logFFE5B2" bordercolor="#000000"> Lien
                        <input type="text" name="lien_1_cont">
                      </td>
                      <td valign="top" class="logFFE5B2">Texte
                        <input type="text" name="lien_1_txt">
                      </td>
                    </tr>
                    <tr bgcolor="FFE5B2">
                      <td class="logFFE5B2" bordercolor="#000000" height="14">Type
<?php
  echo ("<select name=\"lien_2_type\">".makeSelectList('agis', 'articles', 'lien_2_type')."</select>");
?>
                      </td>
                      <td class="logFFE5B2" bordercolor="#000000"> Lien
                        <input type="text" name="lien_2_cont">
                      </td>
                      <td valign="top" class="logFFE5B2">Texte
                        <input type="text" name="lien_2_txt">
                      </td>
                    </tr>
                    <tr bgcolor="FFE5B2">
                      <td class="logFFE5B2" bordercolor="#000000">Type
<?php
  echo ("<select name=\"lien_3_type\">".makeSelectList('agis', 'articles', 'lien_3_type')."</select>");
?>
                      </td>
                      <td class="logFFE5B2" bordercolor="#000000"> Lien
                        <input type="text" name="lien_3_cont">
                      </td>
                      <td valign="top" class="logFFE5B2">Texte
                        <input type="text" name="lien_3_txt">
                      </td>
                    </tr>
                    <tr bgcolor="FFE5B2">
                      <td class="logFFE5B2" bordercolor="#000000">Type
<?php
  echo ("<select name=\"lien_4_type\">".makeSelectList('agis', 'articles', 'lien_4_type')."</select>");
?>
                      </td>
                      <td class="logFFE5B2" bordercolor="#000000"> Lien
                        <input type="text" name="lien_4_cont">
                      </td>
                      <td valign="top" class="logFFE5B2">Texte
                        <input type="text" name="lien_4_txt">
                      </td>
                    </tr>
                    <tr bgcolor="FFE5B2">
                      <td class="logFFE5B2" bordercolor="#000000">Type
<?php
  echo ("<select name=\"lien_5_type\">".makeSelectList('agis', 'articles', 'lien_5_type')."</select>");
?>
                      </td>
                      <td class="logFFE5B2" bordercolor="#000000"> Lien
                        <input type="text" name="lien_5_cont">
                      </td>
                      <td valign="top" class="logFFE5B2">Texte
                        <input type="text" name="lien_5_txt">
                      </td>
                    </tr>
                  </table>
                  <img src=../lib/images/espaceur.gif width="30" height="20"></td>
              </tr>
            </table>

          </td>
        </tr>
        <tr bgcolor="#FFCC66" align="center" valign="middle">
          <td class="loginFFCC66">
            <div align="left"><br>
              <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=4,0,2,0" width="584" height="13">
                <param name=movie value=../lib/images/bandeau_frise.swf>
                <param name=quality value=high>
                <param name="BGCOLOR" value="#FFCC66">
                <param name="SCALE" value="exactfit">
                <embed src=../lib/images/bandeau_frise.swf quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" scale="exactfit" width="584" height="13" bgcolor="#FFCC66">
                </embed>
              </object></div>
          </td>
          <td class="loginFFCC66">
            <div align="right"><br>
            <input type="image" border="0" src="../zimages/valider.gif" width="130" height="20" alt="Terminer et enregistrer l'article">
<?php
/* Passage des parametres*/
  echo ("<INPUT TYPE=\"hidden\"  name=\"sal_nom\" value=\"$sal_nom\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"sal_nom\" value=\"$sal_prenom\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"num_article\" value=\"$num_article\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"titre_art\" value=\"$titre_art\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"sujet\" value=\"$sujet\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"nivo_conf\" value=\"$nivo_conf\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"diffusion\" value=\"$diffusion\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"table\" value=\"articles\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"ins\" value=\"ins\">\n");
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