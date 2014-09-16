<?php
  require("../lib/session.php");
  include("../lib/functions.php");
  identification1("salaries", $login, $pass);
  include("functions.php");

/* Insertion dans article des premieres informations saisies.

// Recherche du plus grand numéro d'article dans la table afin de pouvoir
// differencier l'article que l'on vient d'inserer.*/
    $req="select max(num_article) from articles";
    $result=DatabaseOperation::query($req);
    if ($result != false)
      $max=mysql_result($result, 0, 0);

/* Recherche du numéro du groupe avec le numéro de service en varible globale*/
    $num_groupe=substr ($id_service, 0, 1);

/* Gestion des caracteres */
    $nomliste=nl2br($nomliste);
    $titre_art=nl2br($titre_art);
    $sujet=nl2br($sujet);
    $txt_1=nl2br($txt_1);


/* Gestion des caracteres */
    $nomliste=addslashes($nomliste);
    $titre_art=addslashes($titre_art);
    $sujet=addslashes($sujet);
    $txt_1=addslashes($txt_1);

/* Traitement des niveaux de confidentialite ou de la liste de diffusion*/
    if ($choixconf=='diff')
      $nivo_conf=0;
    else
      $nomliste=null;


    $req="insert into articles (taille, id_art_group, id_art_serv, auteur, date_crea, nivo_conf, diffusion, titre_art,
    sujet, txt_1) values ('2', '$num_groupe', '$id_service', '$id_user', now(), '$nivo_conf', '$nomliste', '$titre_art', '$sujet', '$txt_1')";
    $result=DatabaseOperation::query($req);
    if ($result == false)
      echo ("Il y a un probl&eacuteme d'insertion dans la table ARTICLES");

/* Recherche du numéro de l'article que l'on vient d'enregistrer pour les updates*/
    $req="select num_article from articles where taille='2' and id_art_group='$num_groupe'
    and id_art_serv='$id_service' and auteur='$id_user' and nivo_conf ='$nivo_conf' and num_article>'$max'";
    $result=DatabaseOperation::query($req);
    if ($result != false)
      $num_article=mysql_result($result, 0, num_article);

/* par update on traite les champs images*/

/*
     Traitement des images 1
*/
    if ($img_1_nom_name)
    {
        /* on copie l'image */
        $nomimg1=$num_article."_1".substr($img_1_nom_name, -4);
        copy("$img_1_nom", "data/$nomimg1");

        /* Traitement de la taille de l'image */
        //Conversion des images GIF en PNG
        $info=pathinfo($nomimg1);
        if ($info[extension]=="gif")
        {
           $t=`gif2png data/$nomimg1`;
           $t=`rm data/$nomimg1`;
           $nomimg1=substr_replace($nomimg1, "png", -3);
        }
          //taille_image_7271("data/$nomimg1", "data/$nomimg1");
          $img_1_nom=$nomimg1;

    }
    else
    {
    /* Si aucune image, on met par defaut la photo 1 */
      $img_1_nom='images/photo1.jpg';
    }


    if ($zone_1_type=='image')
    {
      if ($zone_1_lienfile!="none")
      {
/* Traitement de l'image */
        $nomimgz1=$num_article."_2".substr($zone_1_lienfile_name, -4);
       if (!copy ($zone_1_lienfile, "../imgarticle/$nomimgz1"))
         echo ("probleme de copie de l'image\n");
      $zone_1_lien=$nomimgz1;
      $zone_1_info=$zone_1_infobulle;
      taille_image_350Y("../imgarticle/$nomimgz1", "../imgarticle/$nomimgz1");
      }
      else
        $zone_1_type='rien';
    }


    $img_1_alt=addslashes($img_1_alt);
    $zone_1_lien=addslashes($zone_1_lien);
    $zone_1_info=addslashes($zone_1_info);

    $req="update articles set img_1_nom='$img_1_nom', img_1_alt='$img_1_alt', zone_1_type='$zone_1_type',
    zone_1_justif='$zone_1_justif', zone_1_lien='$zone_1_lien', zone_1_info='$zone_1_info'
    where num_article=$num_article";
    $result=DatabaseOperation::query($req);

    $nomliste=stripslashes($nomliste);
    $titre_art=stripslashes($titre_art);
    $sujet=stripslashes($sujet);
    $titre_art=stripslashes($titre_art);
    $sujet=stripslashes($sujet);

?>
<html>
<head>
<title>Cr&eacute;ation d'article long - Etape 2</title>
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
<?php echo ("<form ENCTYPE=\"multipart/form-data\" method=\"post\" name=\"principal\" action=\"etap3long.php\">\n");
   echo ("<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1000000\">");
?>
<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center" valign="top">
      <table width="700" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="../images_pop/etape2.gif" width="119" height="62"></td>
          <td><img src="../images_pop/article_long.gif" width="553" height="62"></td>
          <td><a href="../aide.php#news" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
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
            <table width="600" border="0" cellspacing="4" cellpadding="0" bgcolor="FFE5B2">
              <tr>
                <td class="loginFFFFFFdroit" width="5%">&nbsp;</td>
                <td class="loginFFFFFFdroit" width="17%">Auteur :</td>
                <td class="loginFFFFFF" width="30%">
<?php
  echo ("$sal_prenom $sal_nom\n");
?>
                </td>
                <td class="loginFFFFFFdroit" width="15%">Publi&eacute; par :</td>
                <td class="loginFFFFFF" width="30%"> - </td>
                <td class="loginFFFFFF" width="5%">&nbsp;</td>
              </tr>
              <tr>
                <td class="loginFFFFFFdroit">&nbsp;</td>
                <td class="loginFFFFFFdroit" width="17%">Date d'origine :</td>
                <td class="loginFFFFFF" width="30%">
<?php
/* Date du jour*/
  setlocale (LC_TIME, "french");
  $date=strftime ("%A %d  %B %Y");
  echo ("$date");

?>
                </td>
                <td class="loginFFFFFFdroit">Derni&egrave;re modification :</td>
                <td class="loginFFFFFF"> - </td>
                <td class="loginFFFFFF" width="5%">&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table width="700" border="4" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" bordercolor="#FFCC66">
        <tr bgcolor="FFCC66">
          <td colspan="2">
            <table width="600" border="0" cellspacing="4" cellpadding="0" bordercolor="#FFCC66" align="center">
              <tr>
                <td class="loginFFFFFFdroit" valign="top" rowspan="2" align="center" width="5%">
                  <div align="center"><img src=../lib/images/icone_confidentialite.gif width="20" height="41"></div>
                </td>
                <td class="loginFFFFFFdroit" valign="middle" width="25%">
                  <div align="left">Niveau :
                    <?php
  echo ("$nivo_conf");
?>
                  </div>
                </td>
                <td class="loginFFFFFFCENTRE" width="70%">
                  <div align="left"><span class="loginFFFFFFdroit">Titre :
                    <?php
                                                  echo ("$titre_art");
                                        ?>
                    </span> </div>
                </td>
              </tr>
              <tr>
                <td class="loginFFFFFFdroit" width="25%">
                  <div align="left">Diffusion :
                    <?php
  echo ("$nomliste");
?>
                  </div>
                </td>
                <td class="loginFFFFFF" width="70%">
                  <div align="left"><span class="loginFFFFFFdroit">Sujet :
                    <?php
                                                  echo ("$sujet");
                                        ?>
                    </span> </div>
                </td>
              </tr>
            </table>
            <br>
            <table width="80%" border="0" cellspacing="4" cellpadding="0">
              <tr>
                <td bordercolor="#000000" class="loginFFCC66">PARTIE 3 : Zones
                  libres n&deg; 2 &amp; 3 - Demi largeur de page chacune</td>
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
  echo ("<select name=\"zone_2_type\">".makeSelectList('agis', 'articles', 'zone_2_type')."</select>");
?>
                              </div>
                            </td>
                            <td>
                              <div align="center"><span class="logFFE5B2">Justification
                                </span><br>
<?php
  echo ("<select name=\"zone_2_justif\">".makeSelectList('agis', 'articles', 'zone_2_justif')."</select>");
?>
                              </div>
                            </td>
                            <td>
                              <div align="center"><span class="logFFE5B2">Lien</span><br>
                                <input type="text" name="zone_2_lien" size="20">
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="3"><img src=../lib/images/espaceur.gif width="10" height="10"></td>
                          </tr>
                          <tr>
                            <td colspan="3">
                              <div align="center">
                                  <textarea name="zone_2_info" cols="70" wrap="VIRTUAL" rows="4" class="txtfield"></textarea>
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
  echo ("<select name=\"zone_3_type\">".makeSelectList('agis', 'articles', 'zone_3_type')."</select>");
?>
                              </div>
                            </td>
                            <td>
                              <div align="center"><span class="logFFE5B2">Justification
                                </span><br>
<?php
  echo ("<select name=\"zone_3_justif\">".makeSelectList('agis', 'articles', 'zone_3_justif')."</select>");
?>
                              </div>
                            </td>
                            <td>
                              <div align="center"><span class="logFFE5B2">Lien</span><br>
                                <input type="text" name="zone_3_lien" size="20">
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="3"><img src=../lib/images/espaceur.gif width="10" height="10"></td>
                          </tr>
                          <tr>
                            <td colspan="3">
                              <div align="center">
                                  <textarea name="zone_3_info" cols="70" wrap="VIRTUAL" rows="4" class="txtfield"></textarea>
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
                        sera ajust&eacute;e automatiquement au maximum de la moiti&eacute;
                        de la largeur de la page. R&eacute;glez &eacute;galement
                        la justification comme vous le d&eacute;sirez.</td>
                    </tr>
                    <tr bgcolor="ffe5b2">
                      <td valign="middle" colspan="3">
                        <div align="right">
                          <p class="logFFE5B2"><br>
                          <input type="file" name="zone_2_lienfile">
                          </p>
                        </div>
                      </td>
                      <td class="logFFE5B2">
                        <div align="center">Infobulle<br>
                          <input type="text" name="zone_2_infobulle" size="10">
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
                          <input type="radio" name="zone_2_lienr" value="photo1.jpg">
                          <br>
                          <img src=images/photo1.jpg width="72" height="71">
                        </div>
                      </td>
                      <td bgcolor="ffe5b2">
                        <div align="center">
                          <input type="radio" name="zone_2_lienr" value="photo2.jpg">
                          <br>
                          <img src="images/photo2.jpg" width="72" height="71"></div>
                      </td>
                      <td bgcolor="ffe5b2">
                        <div align="center">
                          <input type="radio" name="zone_2_lienr" value="photo3.jpg">
                          <br>
                          <img src="images/photo3.jpg" width="72" height="71"></div>
                      </td>
                      <td bgcolor="ffe5b2">
                        <div align="center">
                          <input type="radio" name="zone_2_lienr" value="photo4.jpg">
                          <br>
                          <img src="images/photo4.jpg" width="72" height="71">
                        </div>
                      </td>
                    </tr>
                    <tr bgcolor="ffe5b2">
                      <td bgcolor="ffe5b2">
                        <div align="center">
                          <input type="radio" name="zone_2_lienr" value="photo5.jpg">
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
                        sera ajust&eacute;e automatiquement au maximum de la moiti&eacute;
                        de la largeur de la page. R&eacute;glez &eacute;galement
                        la justification comme vous le d&eacute;sirez.</td>
                    </tr>
                    <tr bgcolor="ffe5b2">
                      <td valign="middle" colspan="3">
                        <div align="right">
                          <p class="logFFE5B2"><br>
                          <input type="file" name="zone_3_lienfile">
                          </p>
                        </div>
                      </td>
                      <td class="logFFE5B2">
                        <div align="center">Infobulle<br>
                          <input type="text" name="zone_3_infobulle" size="10">
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
                          <input type="radio" name="zone_3_lienr" value="photo1.jpg">
                          <br>
                          <img src=images/photo1.jpg width="72" height="71">
                        </div>
                      </td>
                      <td bgcolor="ffe5b2">
                        <div align="center">
                          <input type="radio" name="zone_3_lienr" value="photo2.jpg">
                          <br>
                          <img src="images/photo2.jpg" width="72" height="71"></div>
                      </td>
                      <td bgcolor="ffe5b2">
                        <div align="center">
                          <input type="radio" name="zone_3_lienr" value="photo3.jpg">
                          <br>
                          <img src="images/photo3.jpg" width="72" height="71"></div>
                      </td>
                      <td bgcolor="ffe5b2">
                        <div align="center">
                          <input type="radio" name="zone_3_lienr" value="photo4.jpg">
                          <br>
                          <img src="images/photo4.jpg" width="72" height="71">
                        </div>
                      </td>
                    </tr>
                    <tr bgcolor="ffe5b2">
                      <td bgcolor="ffe5b2">
                        <div align="center">
                          <input type="radio" name="zone_3_lienr" value="photo5.jpg">
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
            <table width="80%" border="0" cellspacing="4" cellpadding="0">
              <tr>
                <td bordercolor="#000000" class="loginFFCC66">PARTIE 4 : Image
                  et texte n&deg; 2 - Milieu d'article</td>
              </tr>
            </table>
            <table width="700" border="1" cellspacing="4" cellpadding="0" name="tablo005" align="center" bgcolor="FFFFFF">
              <tr>
                <td class="loginFFFFFF"><img src=../lib/images/bouton_image.gif width="72" height="71"></td>
                <td class="txttabl">
                  <p>
                      <textarea name="txt_2" cols="150" wrap="VIRTUAL" rows="4" class="txtfield"></textarea>
                  </p>
                  </td>
              </tr>
            </table>

            <table width="700" border="1" cellspacing="4" cellpadding="0" bgcolor="#FFFFFF" align="center" height="229">
              <tr bgcolor="ffe5b2">

                <td width="25%" class="loginFFFFFF">
                  <div align="left" class="logFFE5B2"><img src=../lib/images/bouton_aide_point_interrogation.gif width="25" height="26"><br>
                    Pour ins&eacute;rer vos propres images &agrave; partir de
                    votre disque au format .gif ou .jpg. La dimension disponible
                    sera ajust&eacute;e automatiquement au format disponible.</div>
                  </td>
                  <td valign="middle" colspan="4">
                    <div align="right">
                      <p class="logFFE5B2"><br>
                          <input type="file" name="img_2_nom">              </p>
                    </div>
                  </td>
                  <td class="logFFE5B2">
                    <div align="center">Infobulle<br>
                      <input type="text" name="img_2_alt" size="15">
            </div>
                  </td>
                </tr>
                <tr bgcolor="ffe5b2">

                <td width="290" class="loginFFFFFF" height="107">
                  <div class="logFFE5B2"> <img src=../lib/images/bouton_aide_point_interrogation.gif width="25" height="26"><br>
                    Si vous n'avez pas d'images sur mesure, choisissez une de
                    ces images g&eacute;n&eacute;riques</div>
                  </td>

                <td bgcolor="ffe5b2" height="107">
                  <div align="center">
                      <input type="radio" name="img_2_nomr" value="photo1.jpg">
                    <br>
                                        <img src=images/photo1.jpg width="72" height="71"></div>
                  </td>

                <td bgcolor="ffe5b2" height="107">
                  <div align="center">
                      <input type="radio" name="img_2_nomr" value="photo2.jpg">
                    <br>
              <img src="images/photo2.jpg" width="72" height="71"></div>
                  </td>

                <td bgcolor="ffe5b2" height="107">
                  <div align="center">
                    <input type="radio" name="img_2_nomr" value="photo3.jpg">
              <br>
              <img src="images/photo3.jpg" width="72" height="71"></div>
                  </td>

                <td bgcolor="ffe5b2" height="107">
                  <div align="center">
                      <input type="radio" name="img_2_nomr" value="photo4.jpg">
                    <br>
              <img src="images/photo4.jpg" width="72" height="71"></div>
                  </td>

                <td bgcolor="ffe5b2" height="107">
                  <div align="center">
                    <input type="radio" name="img_2_nomr" value="photo5.jpg">
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
            <input type="image" border="0" src="../images_pop/suite.gif" width="130" height="20" alt="Passer à l'étape 3">
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
</body>
</html>