<?php
  require("../lib/session.php");
  include("../lib/functions.php");
    identification1("salaries", $login, $pass);
    UserModel::securadmin(2, $id_type);
  include("functions.php");


  /* Recuperation des variables de la page precedentes */

/*echo ("nivo_conf=$nivo_conf<br>");
echo ("nomliste=$nomliste<br>");
echo ("titre_art=$titre_art<br>");
echo ("sujet=$sujet<br>");
echo ("txt_1=$txt_1<br>");
echo ("img_1_alt=$img_1_alt<br>");
echo ("img_1_nom=$img_1_nom<br>");
echo ("img_1_nomr=$img_1_nomr<br>");
echo ("zone_1_type=$zone_1_type<br>");
echo ("zone_1_justif=$zone_1_justif<br>");
echo ("zone_1_lien=$zone_1_lien<br>");
echo ("zone_1_info=$zone_1_info<br>");
echo ("zone_1_infobulle=$zone_1_infobulle<br>");
echo ("zone_1_lienfile=$zone_1_lienfile<br>");
*/
/* Traitement des niveaux de confidentialite ou de la liste de diffusion*/
  if ($choixconf=='diff')
    $nivo_conf=0;
  else
    $nomliste=null;

  if ($img_1_nom != "none")
  {
/* On a rentrer une nouvelle image */
    $nomimg=$num_article."_1".substr($img_1_nom_name, -4);
    if (!copy ($img_1_nom, "../imgarticle/$nomimg"))
      echo ("probleme de copie de l'image\n");
/* Traitement de la taille de l'image */
      taille_image_7271("../imgarticle/$nomimg", "../imgarticle/$nomimg");
      $img_1_nom=$nomimg;
     $req="update articles set img_1_nom='$img_1_nom' where num_article='$num_article'";
     $result=DatabaseOperation::query($req);
  }
  if (($img_1_nom=="none")&&($img_1_nomr!=""))
  {
/* On a choisit une image predefinie */
    $img_1_nom=$img_1_nomr;
     $req="update articles set img_1_nom='$img_1_nom' where num_article='$num_article'";
     $result=DatabaseOperation::query($req);
  }
  else
  {
/* on recherche l'ancienne image */
   $req="select img_1_nom from articles where num_article='$num_article'";
   $result=DatabaseOperation::query($req);
   $img_1_nom=mysql_result($result, 0, img_1_nom);
  }

  if ($zone_1_type=='image')
  {
    if ($zone_1_lienfile!="none")
    {
/* Traitement de l'image de la nouvelle image */
      $nomimgz1=$num_article."_2".substr($zone_1_lienfile_name, -4);
       if (!copy ($zone_1_lienfile, "../imgarticle/$nomimgz1"))
         echo ("probleme de copie de l'image\n");
      $zone_1_lien=$nomimgz1;
      $zone_1_info=$zone_1_infobulle;
      taille_image_350Y("../imgarticle/$nomimgz1", "../imgarticle/$nomimgz1");
    }
    else
    {
/* On recupere l'ancienne image */
     $req="select zone_1_lien from articles where num_article='$num_article'";
     $result=DatabaseOperation::query($req);
     $zone_1_lien=mysql_result($result, 0, zone_1_lien);
/*echo ("req= $req<br>"); */
    }
  }
/* voir si les types == rien, alors on efface les elements */
  if ($zone_1_type=='rien')
  {
    $zone_1_lien=null;
    $zone_1_info=null;
  }

/* Gestion des caracteres */
    $nomliste=addslashes($nomliste);
    $titre_art=addslashes($titre_art);
    $sujet=addslashes($sujet);
    $txt_1=addslashes($txt_1);
    $zone_1_lien=addslashes($zone_1_lien);
    $zone_1_info=addslashes($zone_1_info);

    $req="update articles set nivo_conf='$nivo_conf', diffusion='$nomliste', titre_art='$titre_art',
    sujet='$sujet', img_1_nom='$img_1_nom', img_1_alt='$img_1_alt', zone_1_type='$zone_1_type',
    zone_1_justif='$zone_1_justif', zone_1_lien='$zone_1_lien', zone_1_info='$zone_1_info', txt_1='$txt_1'
    where num_article=$num_article";
    $result=DatabaseOperation::query($req);

    $req="delete from lu where id_art='$num_article'";
    $result=DatabaseOperation::query($req);

    $req="select * from articles where num_article='$num_article'";
    $result=DatabaseOperation::query($req);
    $publica=mysql_result($result, 0, publica);
    $titre_art=mysql_result($result, 0, titre_art);
    $date_crea=mysql_result($result, 0, date_crea);
    $date_modif=mysql_result($result, 0, date_modif);
    $nivo_conf=mysql_result($result, 0, nivo_conf);
    $nomliste=mysql_result($result, 0, diffusion);
    $zone_2_type=mysql_result($result, 0, zone_2_type);
    $zone_2_justif=mysql_result($result, 0, zone_2_justif);
    $zone_2_lien=mysql_result($result, 0, zone_2_lien);
    $zone_2_info=mysql_result($result, 0, zone_2_info);
    $zone_3_type=mysql_result($result, 0, zone_3_type);
    $zone_3_justif=mysql_result($result, 0, zone_3_justif);
    $zone_3_lien=mysql_result($result, 0, zone_3_lien);
    $zone_3_info=mysql_result($result, 0, zone_3_info);
    $txt_2=mysql_result($result, 0, txt_2);
    $img_2_nom=mysql_result($result, 0, img_2_nom);
    $img_2_alt=mysql_result($result, 0, img_2_alt);

/* Gestion des caracteres */
    $nomliste=stripslashes($nomliste);
    $titre_art=stripslashes($titre_art);
    $sujet=stripslashes($sujet);
    $txt_2=stripslashes($txt_2);
    $zone_2_lien=stripslashes($zone_2_lien);
    $zone_2_info=stripslashes($zone_2_info);
    $zone_3_lien=stripslashes($zone_3_lien);
    $zone_3_info=stripslashes($zone_3_info);
    $img_2_alt=stripslashes($img_2_alt);
?>
<html>
<head>
<title>news-long2</title>
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
<?php echo ("<form ENCTYPE=\"multipart/form-data\" method=\"post\" name=\"principal\" action=\"modetap3long.php\">\n");
   echo ("<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1000000\">");
?>

<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top">
      <table width="700" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="../images_pop/etape2.gif" width="119" height="62"></td>
          <td><img src="../images_pop/article_long.gif" width="553" height="62"></td>
          <td><a href="../aide.php#adminnew" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="4" cellpadding="0" bgcolor="FFE5B2">
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
                <td class="loginFFFFFFdroit" width="11%">Date d'origine</td>
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
          </td>
        </tr>
      </table>
      <table width="700" border="4" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" bordercolor="#FFCC66">
        <tr bgcolor="FFCC66">
          <td colspan="2">
            <table width="400" border="0" cellspacing="4" cellpadding="0" bordercolor="#FFCC66" align="center">
              <tr>
                <td class="loginFFFFFFdroit" valign="top" rowspan="2" align="center">
                  <div align="center"><img src=../lib/images/icone_confidentialite.gif width="20" height="41"></div>
                </td>
                <td class="loginFFFFFFdroit" valign="middle">
                  <div align="left">Niveau
<?php
  echo ("$nivo_conf");
?>
                  </div>
                </td>
                <td class="loginFFFFFF">
                  <div align="right"><span class="loginFFFFFFdroit">Titre
<?php
  echo ("$titre_art");
?>
                  </span>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="loginFFFFFFdroit">
                  <div align="left">Diffusion
<?php
  echo ("$nomliste");
?>
                   </div>
                </td>
                <td class="loginFFFFFF">
                  <div align="right"><span class="loginFFFFFFdroit">Sujet
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
                    <table width="363" border="1" cellspacing="4" cellpadding="0" name="tablo002" bgcolor="FFFFFF" align="center">
                    <tr>
                      <td class="txttablcenter">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>
                              <div align="center"><span class="logFFE5B2">Type</span>
                                <br>
<?php
  echo ("<select name=\"zone_2_type\">".makeSelectListChecked('agis', 'articles', 'zone_2_type', $zone_2_type)."</select>");
?>
                              </div>
                            </td>
                            <td>
                              <div align="center"><span class="logFFE5B2">Justification
                                </span><br>
<?php
  echo ("<select name=\"zone_2_justif\">".makeSelectListChecked('agis', 'articles', 'zone_2_justif', $zone_2_justif)."</select>");
?>
                              </div>
                            </td>
                            <td>
                              <div align="center"><span class="logFFE5B2">Lien</span><br>
                                <input type="text" name="zone_2_lien" size="20"
<?php
  echo ("value=\"$zone_2_lien\"");
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
                                  <textarea name="zone_2_info" cols="70" wrap="VIRTUAL" rows="4" class="txtfield">
<?php
  if ($zone_2_type!='image')
    echo ("$zone_2_info");
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
                <td bgcolor="FFCC66">
                  <table width="350" border="1" cellspacing="4" cellpadding="0" name="tablo002" bgcolor="FFFFFF" align="center">
                    <tr>
                      <td class="txttablcenter">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>
                              <div align="center"><span class="logFFE5B2">Type</span>
                                <br>
<?php
  echo ("<select name=\"zone_3_type\">".makeSelectListChecked('agis', 'articles', 'zone_3_type', $zone_3_type)."</select>");
?>
                              </div>
                            </td>
                            <td>
                              <div align="center"><span class="logFFE5B2">Justification
                                </span><br>
<?php
  echo ("<select name=\"zone_3_justif\">".makeSelectListChecked('agis', 'articles', 'zone_3_justif', $zone_3_justif)."</select>");
?>
                              </div>
                            </td>
                            <td>
                              <div align="center"><span class="logFFE5B2">Lien</span><br>
                                <input type="text" name="zone_3_lien" size="20"
<?php
  echo ("value=\"$zone_3_lien\"");
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
                                  <textarea name="zone_3_info" cols="70" wrap="VIRTUAL" rows="4" class="txtfield">
<?php
  if ($zone_3_type!='image')
    echo ("$zone_3_info");
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
                  <table width="350" border="1" cellspacing="4" cellpadding="0" bgcolor="#FFFFFF" align="center">
                    <tr bgcolor="ffe5b2">
                      <td class="loginFFFFFF" colspan="4"><img src=../lib/images/bouton_aide_point_interrogation.gif width="25" height="26">Pour
                        ins&eacute;rer vos propres images &agrave; partir de votre
                        disque au format .gif ou .jpg. La dimension disponible
                        sera ajust&eacute;e automatiquement</td>
                    </tr>
                    <tr bgcolor="ffe5b2">
                      <td valign="middle" colspan="3">
                        <div align="right">
                          <p class="logFFE5B2">
<?php
  echo ("L'image en cours est: $zone_2_lien<br>");
?>
                          <input type="file" name="zone_2_lienfile">
                          </p>
                        </div>
                      </td>
                      <td class="logFFE5B2">
                        <div align="center">Infobulle<br>
                          <input type="text" name="zone_2_infobulle" size="10"
<?php
  if ($zone_3_info=='image')
    echo ("$zone_3_info");
?>
                          >
                        </div>
                      </td>
                    </tr>
                    <tr bgcolor="ffe5b2">
                      <td bgcolor="ffe5b2" colspan="4" class="loginFFFFFF"><img src=../lib/images/bouton_aide_point_interrogation.gif width="25" height="26">Si
                        vous n'avez pas d'images sur mesure, choisissez une de
                        ces images g&eacute;n&eacute;riques</td>
                    </tr>
                    <tr bgcolor="ffe5b2">
                      <td bgcolor="ffe5b2" width="25%">
                        <div align="center">
                          <input type="radio" name="zone_2_lienr" value="photo1.jpg"
<?php
  if ($zone_2_lien=="photo1.jpg")
    echo ("checked");
?>
                          >
                          <br>
                          <img src=images/photo1.jpg width="72" height="71">
                        </div>
                      </td>
                      <td bgcolor="ffe5b2">
                        <div align="center">
                          <input type="radio" name="zone_2_lienr" value="photo2.jpg"
<?php
  if ($zone_2_lien=="photo2.jpg")
    echo ("checked");
?>
                          >
                          <br>
                          <img src="images/photo2.jpg" width="72" height="71"></div>
                      </td>
                      <td bgcolor="ffe5b2">
                        <div align="center">
                          <input type="radio" name="zone_2_lienr" value="photo3.jpg"
<?php
  if ($zone_2_lien=="photo3.jpg")
    echo ("checked");
?>
                          >
                          <br>
                          <img src="images/photo3.jpg" width="72" height="71"></div>
                      </td>
                      <td bgcolor="ffe5b2">
                        <div align="center">
                          <input type="radio" name="zone_2_lienr" value="photo4.jpg"
<?php
  if ($zone_2_lien=="photo4.jpg")
    echo ("checked");
?>
                          >
                          <br>
                          <img src="images/photo4.jpg" width="72" height="71">
                        </div>
                      </td>
                    </tr>
                    <tr bgcolor="ffe5b2">
                      <td bgcolor="ffe5b2">
                        <div align="center">
                          <input type="radio" name="zone_2_lienr" value="photo5.jpg"
<?php
  if ($zone_2_lien=="photo5.jpg")
    echo ("checked");
?>
                          >
                          <br>
                          <img src="images/photo5.jpg" width="72" height="71"></div>
                      </td>
                      <td bgcolor="ffe5b2" colspan="3">
                        <div align="center"> </div>
                      </td>
                    </tr>
                  </table>
                </td>
                <td>
                    <table width="350" border="1" cellspacing="4" cellpadding="0" bgcolor="#FFFFFF" align="center">
                    <tr bgcolor="ffe5b2">
                      <td class="loginFFFFFF" colspan="4"><img src=../lib/images/bouton_aide_point_interrogation.gif width="25" height="26">Pour
                        ins&eacute;rer vos propres images &agrave; partir de votre
                        disque au format .gif ou .jpg. La dimension disponible
                        sera ajust&eacute;e automatiquement</td>
                    </tr>
                    <tr bgcolor="ffe5b2">
                      <td valign="middle" colspan="3">
                        <div align="right">
                          <p class="logFFE5B2">
<?php
  echo ("L'image en cours est: $zone_3_lien<br>");
?>
                          <input type="file" name="zone_3_lienfile">
                          </p>
                        </div>
                      </td>
                      <td class="logFFE5B2">
                        <div align="center">Infobulle<br>
                          <input type="text" name="zone_3_infobulle" size="10"
<?php
  if ($zone_3_type=='image')
    echo ("value=\"$zone_1_info\"");
?>
                          >
                        </div>
                      </td>
                    </tr>
                    <tr bgcolor="ffe5b2">
                      <td bgcolor="ffe5b2" colspan="4" class="loginFFFFFF"><img src=../lib/images/bouton_aide_point_interrogation.gif width="25" height="26">Si
                        vous n'avez pas d'images sur mesure, choisissez une de
                        ces images g&eacute;n&eacute;riques</td>
                    </tr>
                    <tr bgcolor="ffe5b2">
                      <td bgcolor="ffe5b2">
                        <div align="center">
                          <input type="radio" name="zone_3_lienr" value="photo1.jpg"
<?php
  if ($zone_3_lien=="photo1.jpg")
    echo ("checked");
?>
                          >
                          <br>
                          <img src=images/photo1.jpg width="72" height="71">
                        </div>
                      </td>
                      <td bgcolor="ffe5b2">
                        <div align="center">
                          <input type="radio" name="zone_3_lienr" value="photo2.jpg"
<?php
  if ($zone_3_lien=="photo2.jpg")
    echo ("checked");
?>
                          >
                          <br>
                          <img src="images/photo2.jpg" width="72" height="71"></div>
                      </td>
                      <td bgcolor="ffe5b2">
                        <div align="center">
                          <input type="radio" name="zone_3_lienr" value="photo3.jpg"
<?php
  if ($zone_3_lien=="photo3.jpg")
    echo ("checked");
?>
                          >
                          <br>
                          <img src="images/photo3.jpg" width="72" height="71"></div>
                      </td>
                      <td bgcolor="ffe5b2">
                        <div align="center">
                          <input type="radio" name="zone_3_lienr" value="photo4.jpg"
<?php
  if ($zone_3_lien=="photo4.jpg")
    echo ("checked");
?>
                          >
                          <br>
                          <img src="images/photo4.jpg" width="72" height="71">
                        </div>
                      </td>
                    </tr>
                    <tr bgcolor="ffe5b2">
                      <td bgcolor="ffe5b2">
                        <div align="center">
                          <input type="radio" name="zone_3_lienr" value="photo5.jpg"
<?php
  if ($zone_3_lien=="photo5.jpg")
    echo ("checked");
?>
                          >
                          <br>
                          <img src="images/photo5.jpg" width="72" height="71"></div>
                      </td>
                      <td bgcolor="ffe5b2" colspan="3">
                        <div align="center"> </div>
                      </td>
                    </tr>
                  </table>
                  <img src=../lib/images/espaceur.gif width="10" height="1"></td>
              </tr>
            </table>
            <img src=../lib/images/espaceur.gif width="10" height="20">
            <table width="700" border="1" cellspacing="4" cellpadding="0" name="tablo005" align="center" bgcolor="FFFFFF">
              <tr>
                <td class="loginFFFFFF"><img src="../zimages/zefoto.gif" width="72" height="71"></td>
                <td class="txttabl">
                  <p>
                      <textarea name="txt_2" cols="150" wrap="VIRTUAL" rows="4" class="txtfield">
<?php
  echo ("$txt_2");
?>
                      </textarea>
                  </p>
                  </td>
              </tr>
            </table>
              <table width="700" border="1" cellspacing="4" cellpadding="0" bgcolor="#FFFFFF" align="center">
                <tr bgcolor="ffe5b2">
                  <td width="40%" class="loginFFFFFF">
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
                          <input type="file" name="img_2_nom"
                          >
                      </p>
                    </div>
                  </td>
                  <td class="logFFE5B2">
                    <div align="center">Infobulle<br>
                      <input type="text" name="img_2_alt" size="15"
<?php
  echo ("value=\"$img_2_alt\"");
?>
                      >
            </div>
                  </td>
                </tr>
                <tr bgcolor="ffe5b2">
                  <td width="290" class="loginFFFFFF">
                    <div class="logFFE5B2"> <img src=../lib/images/bouton_aide_point_interrogation.gif width="25" height="26"><br>
              Si vous n'avez pas d'images sur mesure, choisissez une de ces images
              g&eacute;n&eacute;riques</div>
                  </td>
                  <td bgcolor="ffe5b2" width="72" height="71">
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
                  <td bgcolor="ffe5b2" width="72" height="71">
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
                  <td bgcolor="ffe5b2" width="72" height="71">
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
                  <td bgcolor="ffe5b2" width="72" height="71">
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
                  <td bgcolor="ffe5b2" width="72" height="71">
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
              <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="ffcc66"> <img src=../lib/images/espaceur.gif width="10" height="20">
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
            <input type="image" border="0" src="../images_pop/suite.gif" width="130" height="20">
<?php
/* Passage des parametres*/
  echo ("<INPUT TYPE=\"hidden\"  name=\"sal_nom\" value=\"$sal_nom\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"sal_nom\" value=\"$sal_prenom\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"num_article\" value=\"$num_article\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"titre_art\" value=\"$titre_art\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"sujet\" value=\"$sujet\">\n");
  echo ("<INPUT TYPE=\"hidden\"  name=\"nivo_conf\" value=\"$nivo_conf\">\n");
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