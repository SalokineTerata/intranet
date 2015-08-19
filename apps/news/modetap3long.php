<?php
  require("../lib/session.php");
  include("../lib/functions.php");
    identification1("salaries", $login, $pass);
    UserModel::securadmin(2, $id_type);
  include("functions.php");



/* Traitement des images */
  if ($img_2_nom != "none")
  {
/* On a rentrer une nouvelle image */
    $nomimg=$num_article."_3".substr($img_2_nom_name, -4);
    if (!copy ($img_2_nom, "../imgarticle/$nomimg"))
      echo ("probleme de copie de l'image\n");
/* Traitement de la taille de l'image */
      taille_image_7271("../imgarticle/$nomimg", "../imgarticle/$nomimg");
      $img_2_nom=$nomimg;
     $req="update articles set img_2_nom='$img_2_nom' where num_article='$num_article'";
     $result=DatabaseOperation::query($req);
  }
  if (($img_2_nom=="none")&&($img_2_nomr!=""))
  {
/* On a choisit une image predefinie */
    $img_2_nom=$img_2_nomr;
     $req="update articles set img_2_nom='$img_2_nom' where num_article='$num_article'";
     $result=DatabaseOperation::query($req);
  }
  else
  {
/* on recherche l'ancienne image */
   $req="select img_2_nom from articles where num_article='$num_article'";
   $result=DatabaseOperation::query($req);
   $img_2_nom=mysql_result($result, 0, img_2_nom);
  }

  if ($zone_2_type=='image')
  {

echo"$zone_2_lien<br>";
echo"$zone_2_lienr<br>";
echo"$zone_2_lienfile";

    if ($zone_2_lienfile!="none")
    {
/* Traitement de l'image de la nouvelle image */


      $nomimgz2=$num_article."_4".substr($zone_2_lienfile_name, -4);
       if (!copy ($zone_2_lienfile, "../imgarticle/$nomimgz2"))
         echo ("probleme de copie de l'image\n");
      $zone_2_lien=$nomimgz2;
      $zone_2_info=$zone_2_infobulle;
      taille_image_350Y("../imgarticle/$nomimgz2", "../imgarticle/$nomimgz2");
  echo"$zone_2_lien";
  $req="update articles set zone_2_type='$zone_2_type', zone_2_info='$zone_2_info', zone_2_justif='$zone_2_justif',
  zone_2_lien='$zone_2_lien' where num_article='$num_article'";
  $result=DatabaseOperation::query($req);
    }
    if (($zone_2_lienfile=="none")&&($zone_2_lienr!=""))
    {
/* On a choisit une image predefinie */
      $zone_2_lien=$zone_2_lienr;

  $req="update articles set zone_2_type='$zone_2_type', zone_2_info='$zone_2_info', zone_2_justif='$zone_2_justif',
  zone_2_lien='$zone_2_lien' where num_article='$num_article'";
  $result=DatabaseOperation::query($req);
    }
    else
    {
/* On recupere l'ancienne image */
     $req="select zone_2_lien from articles where num_article='$num_article'";
     $result=DatabaseOperation::query($req);
     $zone_2_lien=mysql_result($result, 0, zone_2_lien);

    }
  }

  if ($zone_3_type=='image')
  {
    if ($zone_3_lienfile!="none")
    {
/* Traitement de l'image de la nouvelle image */
      $nomimgz3=$num_article."_5".substr($zone_3_lienfile_name, -4);
       if (!copy ($zone_3_lienfile, "../imgarticle/$nomimgz3"))
         echo ("probleme de copie de l'image\n");
      $zone_3_lien=$nomimgz3;
      $zone_3_info=$zone_3_infobulle;
      taille_image_350Y("../imgarticle/$nomimgz3", "../imgarticle/$nomimgz3");
  $req="update articles set zone_3_type='$zone_3_type', zone_3_info='$zone_3_info', zone_3_justif='$zone_3_justif',
  zone_3_lien='$zone_3_lien' where num_article='$num_article'";
  $result=DatabaseOperation::query($req);
    }
    if (($zone_3_lienfile=="none")&&($zone_3_lienr!=""))
    {
/* On a choisit une image predefinie */
      $zone_3_lien=$zone_3_lienr;
  $req="update articles set zone_3_type='$zone_3_type', zone_3_info='$zone_3_info', zone_3_justif='$zone_3_justif',
  zone_3_lien='$zone_3_lien' where num_article='$num_article'";
  $result=DatabaseOperation::query($req);

    }
    else
    {
/* On recupere l'ancienne image */
     $req="select zone_3_lien from articles where num_article='$num_article'";
     $result=DatabaseOperation::query($req);
     $zone_3_lien=mysql_result($result, 0, zone_3_lien);
    }
  }

/* voir si les types == rien, alors on efface les elements */
  if ($zone_2_type=='rien')
  {
    $zone_2_lien=null;
    $zone_2_info=null;
  }
  if ($zone_3_type=='rien')
  {
    $zone_3_lien=null;
    $zone_3_info=null;
  }

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


/* Modification de l'article, c'est a dire que l'on rempli les champs */
  $req="select * from articles where num_article='$num_article'";
  $result=DatabaseOperation::query($req);
  $publica=mysql_result($result, 0, publica);
  $titre_art=mysql_result($result, 0, titre_art);
  $date_crea=mysql_result($result, 0, date_crea);
  $date_modif=mysql_result($result, 0, date_modif);
  $nivo_conf=mysql_result($result, 0, nivo_conf);
  $zone_4_type=mysql_result($result, 0, zone_4_type);
  $zone_4_info=mysql_result($result, 0, zone_4_info);
  $zone_4_justif=mysql_result($result, 0, zone_4_justif);
  $zone_4_lien=mysql_result($result, 0, zone_4_lien);
  $nomliste=mysql_result($result, 0, diffusion);
  $lien_1_type=mysql_result($result, 0, lien_1_type);
  $lien_1_cont=mysql_result($result, 0, lien_1_cont);
  $lien_1_txt=mysql_result($result, 0, lien_1_txt);
  $lien_2_type=mysql_result($result, 0, lien_2_type);
  $lien_2_cont=mysql_result($result, 0, lien_2_cont);
  $lien_2_txt=mysql_result($result, 0, lien_2_txt);
  $lien_3_type=mysql_result($result, 0, lien_3_type);
  $lien_3_cont=mysql_result($result, 0, lien_3_cont);
  $lien_3_txt=mysql_result($result, 0, lien_3_txt);
  $lien_4_type=mysql_result($result, 0, lien_4_type);
  $lien_4_cont=mysql_result($result, 0, lien_4_cont);
  $lien_4_txt=mysql_result($result, 0, lien_4_txt);
  $lien_5_type=mysql_result($result, 0, lien_5_type);
  $lien_5_cont=mysql_result($result, 0, lien_5_cont);
  $lien_5_txt=mysql_result($result, 0, lien_5_txt);
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
<?php  include ("../adminagis/cadrehautnews.php"); ?>
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
          <td><a href="../aide.php#adminnew" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
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
$titre_art=stripslashes($titre_art);
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
  echo ("$nomliste");
?>
                   </div>
                </td>
                <td class="loginFFFFFF">
                  <div align="center"><span class="loginFFFFFFdroit">Sujet
<?php
$sujet=stripslashes($sujet);
  echo ("$sujet");
?>
                  </span>
                  </div>
                </td>
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
  echo ("<select name=\"zone_4_type\">".makeSelectListChecked('agis', 'articles', 'zone_4_type', $zone_4_type)."</select>");
?>
                              </div>
                            </td>
                            <td>
                              <div align="center"><span class="logFFE5B2">Justification
                                </span><br>
<?php
  echo ("<select name=\"zone_4_justif\">".makeSelectListChecked('agis', 'articles', 'zone_4_justif', $zone_4_justif)."</select>");
?>
                              </div>
                            </td>
                            <td>
                              <div align="center"><span class="logFFE5B2">Lien</span><br>
                                <input type="text" name="zone_4_lien" size="30"
<?php
  echo ("value=\"$zone_4_lien\"");
?>
                                >
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="3"><img src=../lib/images/espaceur.gif width="10" height="10"></td>
                          </tr>
                          <tr>
                            <td colspan="3">
                              <div align="center">
                                <textarea name="zone_4_info" cols="150" wrap="VIRTUAL" rows="6" class="txtfield">
<?php
  if ($zone_4_type!='image')
    echo ("$zone_4_info");
?>
                                </textarea>
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
                          <p class="logFFE5B2">
<?php
  echo ("L'image en cours est: $zone_4_lien<br>");
?>
                          <input type="file" name="zone_4_lienfile">
                          </p>
                        </div>
                      </td>
                      <td class="logFFE5B2">
                        <div align="center">Infobulle<br>
                          <input type="text" name="zone_4_infobulle" size="15"
<?php
  if ($zone_4_type=='image')
    echo ("value=\"$zone_4_info\"");
?>
                          >
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
                    <tr bgcolor="FFE5B2">
                      <td class="logFFE5B2" bordercolor="#000000">Type
<?php
  echo ("<select name=\"lien_4_type\">".makeSelectListChecked('agis', 'articles', 'lien_4_type', $lien_4_type)."</select>");
?>
                      </td>
                      <td class="logFFE5B2" bordercolor="#000000"> Lien
                        <input type="text" name="lien_4_cont"
<?php
  echo ("value=\"$lien_4_cont\"");
?>
                        >
                      </td>
                      <td valign="top" class="logFFE5B2">Texte
                        <input type="text" name="lien_4_txt"
<?php
  echo ("value=\"$lien_4_txt\"");
?>
                        >
                      </td>
                    </tr>
                    <tr bgcolor="FFE5B2">
                      <td class="logFFE5B2" bordercolor="#000000">Type
<?php
  echo ("<select name=\"lien_5_type\">".makeSelectListChecked('agis', 'articles', 'lien_5_type', $lien_5_type)."</select>");
?>
                      </td>
                      <td class="logFFE5B2" bordercolor="#000000"> Lien
                        <input type="text" name="lien_5_cont"
<?php
  echo ("value=\"$lien_5_cont\"");
?>
                        >
                      </td>
                      <td valign="top" class="logFFE5B2">Texte
                        <input type="text" name="lien_5_txt"
<?php
  echo ("value=\"$lien_5_txt\"");
?>
                        >
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
            <input type="image" border="0" src="../zimages/valider.gif" width="130" height="20">
<?php
/* Passage des parametres*/
  echo ("<INPUT TYPE=\"hidden\"  name=\"mod\" value=\"mod\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"ins\" value=\"ins\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"sal_nom\" value=\"$sal_nom\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"sal_nom\" value=\"$sal_prenom\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"num_article\" value=\"$num_article\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"titre_art\" value=\"$titre_art\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"sujet\" value=\"$sujet\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"nivo_conf\" value=\"$nivo_conf\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"table\" value=\"articles\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"nomliste\" value=\"$nomliste\">\n");
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