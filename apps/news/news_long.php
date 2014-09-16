<?php
  require ("../lib/session.php");
  include("functions.php");
  include("../lib/functions.php");
  identification1("salaries", $login, $pass);
  include("functions.js");

  if ($mod=="mod")
  {
/* Modification de l'article */
/* Traitement de l'image car differente de la creation */
    if ($zone_4_type=='image')
    {
      if ($zone_4_lienfile!="")
      {
        if ($zone_4_lienfile!="none")
        {
/* Traitement de l'image de la nouvelle image */
        $nomimgz4=$num_article."_6".substr($zone_4_lienfile_name, -4);
         if (!copy ($zone_4_lienfile, "../imgarticle/$nomimgz4"))
           echo ("probleme de copie de l'image\n");
        $zone_4_lien=$nomimgz4;
        $zone_4_info=$zone_4_infobulle;
        taille_image_350Y("../imgarticle/$nomimgz4", "../imgarticle/$nomimgz4");
        }
      }
      else
      {
/* On recupere l'ancienne image */
       $req="select zone_4_lien from articles where num_article='$num_article'";
       $result=DatabaseOperation::query($req);
       $zone_4_lien=mysql_result($result, 0, zone_4_lien);
      }
    }
    else
       $zone_4_type='rien';
  }
  if ($ins=='ins')
  {
/* Fin de l'enregistrement d'un article */
    if ($zone_4_type=='image')
    {
      if ($zone_4_lienfile!="none")
      {
/* Traitement de l'image */
      $nomimgz4=$num_article."_6".substr($zone_4_lienfile_name, -4);
      if (!copy ($zone_4_lienfile, "../imgarticle/$nomimgz4"))
        echo ("probleme de copie de l'image\n");
      $zone_4_lien=$nomimgz4;
      $zone_4_info=$zone_4_infobulle;
      taille_image_350Y("../imgarticle/$nomimgz4", "../imgarticle/$nomimgz4");
     }
    else
       $zone_4_type='rien';
    }


    if ($zone_4_type=='rien')
    {
      $zone_4_lien=null;
      $zone_4_info=null;
    }

/* Gestion des caracteres */
    $zone_4_type=nl2br($zone_4_type);
    $zone_4_info=nl2br($zone_4_info);
    $zone_4_justif=nl2br($zone_4_justif);
    $zone_4_lien=nl2br($zone_4_lien);
    $lien_1_cont=nl2br($lien_1_cont);
    $lien_1_txt=nl2br($lien_1_txt);
    $lien_2_cont=nl2br($lien_2_cont);
    $lien_2_txt=nl2br($lien_2_txt);
    $lien_3_cont=nl2br($lien_3_cont);
    $lien_3_txt=nl2br($lien_3_txt);
    $lien_4_cont=nl2br($lien_4_cont);
    $lien_4_txt=nl2br($lien_4_txt);
    $lien_5_cont=nl2br($lien_5_cont);
    $lien_5_txt=nl2br($lien_5_txt);

/* Gestion des caracteres */
    $zone_4_type=addslashes($zone_4_type);
    $zone_4_info=addslashes($zone_4_info);
    $zone_4_justif=addslashes($zone_4_justif);
    $zone_4_lien=addslashes($zone_4_lien);
    $lien_1_cont=addslashes($lien_1_cont);
    $lien_1_txt=addslashes($lien_1_txt);
    $lien_2_cont=addslashes($lien_2_cont);
    $lien_2_txt=addslashes($lien_2_txt);
    $lien_3_cont=addslashes($lien_3_cont);
    $lien_3_txt=addslashes($lien_3_txt);
    $lien_4_cont=addslashes($lien_4_cont);
    $lien_4_txt=addslashes($lien_4_txt);
    $lien_5_cont=addslashes($lien_5_cont);
    $lien_5_txt=addslashes($lien_5_txt);

    $req="update articles set zone_4_type='$zone_4_type', zone_4_info='$zone_4_info', zone_2_justif='$zone_4_justif',
    zone_4_lien='$zone_4_lien', lien_1_type='$lien_1_type', lien_1_cont='$lien_1_cont', lien_1_txt='$lien_1_txt',
    lien_2_type='$lien_2_type', lien_2_cont='$lien_2_cont', lien_2_txt='$lien_2_txt',
    lien_3_type='$lien_3_type', lien_3_cont='$lien_3_cont', lien_3_txt='$lien_3_txt',
    lien_4_type='$lien_4_type', lien_4_cont='$lien_4_cont', lien_4_txt='$lien_4_txt',
    lien_5_type='$lien_5_type', lien_5_cont='$lien_5_cont', lien_5_txt='$lien_5_txt'
    where num_article='$num_article'";
    $result=DatabaseOperation::query($req);
    if ($result == false)
      echo ("Il y a un probl&eacuteme d'update dans la table ARTICLES");

/* Effacement dans la table lu */
    $req="delete from lu where id_art='$num_article'";
    $result=DatabaseOperation::query($req);
  }


  $req="select * from $table where $table.num_article='$num_article'";
  $result=DatabaseOperation::query($req);
/*  Recuperation des elements */
  $taille=mysql_result($result, 0, taille);
  $auteur=mysql_result($result, 0, auteur);
  $publica=mysql_result($result, 0, publica);
  $titre_art=mysql_result($result, 0, titre_art);
  $date_crea=mysql_result($result, 0, date_crea);
  $date_modif=mysql_result($result, 0, date_modif);
  $nivo_conf=mysql_result($result, 0, nivo_conf);
  $img_1_alt=mysql_result($result, 0, img_1_alt);
  $img_1_nom=mysql_result($result, 0, img_1_nom);
  $img_2_alt=mysql_result($result, 0, img_2_alt);
  $img_2_nom=mysql_result($result, 0, img_2_nom);
  $txt_1=mysql_result($result, 0, txt_1);
  $txt_2=mysql_result($result, 0, txt_2);
  $zone_1_type=mysql_result($result, 0, zone_1_type);
  $zone_1_info=mysql_result($result, 0, zone_1_info);
  $zone_1_justif=mysql_result($result, 0, zone_1_justif);
  $zone_1_lien=mysql_result($result, 0, zone_1_lien);
  $zone_2_type=mysql_result($result, 0, zone_2_type);
  $zone_2_info=mysql_result($result, 0, zone_2_info);
  $zone_2_justif=mysql_result($result, 0, zone_2_justif);
  $zone_2_lien=mysql_result($result, 0, zone_2_lien);
  $zone_3_type=mysql_result($result, 0, zone_3_type);
  $zone_3_info=mysql_result($result, 0, zone_3_info);
  $zone_3_justif=mysql_result($result, 0, zone_3_justif);
  $zone_3_lien=mysql_result($result, 0, zone_3_lien);
  $zone_4_type=mysql_result($result, 0, zone_4_type);
  $zone_4_info=mysql_result($result, 0, zone_4_info);
  $zone_4_justif=mysql_result($result, 0, zone_4_justif);
  $zone_4_lien=mysql_result($result, 0, zone_4_lien);
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
  $diffusion=mysql_result($result, 0, diffusion);
  $sujet=mysql_result($result, 0, sujet);

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
   $nomaut=stripslashes($nomaut);
   $prenomaut=stripslashes($prenomaut);
   $nompub=stripslashes($nompub);
   $prenompub=stripslashes($prenompub);
   $titre_art=stripslashes($titre_art);
   $img_1_alt=stripslashes($img_1_alt);
   $img_2_alt=stripslashes($img_2_alt);
   $txt_1=stripslashes($txt_1);
   $txt_2=stripslashes($txt_2);
   $zone_1_info=stripslashes($zone_1_info);
   $zone_1_lien=stripslashes($zone_1_lien);
   $zone_2_info=stripslashes($zone_2_info);
   $zone_2_lien=stripslashes($zone_2_lien);
   $zone_3_info=stripslashes($zone_3_info);
   $zone_3_lien=stripslashes($zone_3_lien);
   $zone_4_info=stripslashes($zone_4_info);
   $zone_4_lien=stripslashes($zone_4_lien);
   $lien_1_cont=stripslashes($lien_1_cont);
   $lien_1_txt=stripslashes($lien_1_txt);
   $lien_2_cont=stripslashes($lien_2_cont);
   $lien_2_txt=stripslashes($lien_2_txt);
   $lien_3_cont=stripslashes($lien_3_cont);
   $lien_3_txt=stripslashes($lien_3_txt);
   $lien_4_cont=stripslashes($lien_4_cont);
   $lien_4_txt=stripslashes($lien_4_txt);
   $lien_5_cont=stripslashes($lien_5_cont);
   $lien_5_txt=stripslashes($lien_5_txt);
   $diffusion=stripslashes($diffusion);
   $sujet=stripslashes($sujet);
?>
<html>
<head>
<title>news-long</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../lib/css/admin_intra01.css" type="text/css">
<link rel="stylesheet" href=../lib/css/admin_newspopup.css type="text/css">

<script language="JavaScript">
<!--
function Popup(page,options) {
  document.location.href="../index.php?action=delog" ;
}

function StartTimer(delai) {
  // Déclenche le timer à la fin du chargement de la page (delai est en secondes)
  setTimeout("Popup()",delai*1000);
}

function MM_openBrWindow(theURL,winName,features)
{ //v2.0
  window.open(theURL,winName,features);
}

function MM_goToURL()
{ //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

//-->
</script>
</head>

<body onLoad="StartTimer(<?php $time=timeout($id_user); echo ("$time"); ?>)" bgcolor="#FFCC66" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php
  if ($ins!='ins'){
  include ("../adminagis/cadrehautnews.php");
}
?>
<a name="haut"></a>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align=center>
  <tr>
    <td align="center" valign="top">
      <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
        <tr>
          <td><img src="../zimages/tetnews.gif" width="600" height="40"></td>
        </tr>
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="4" cellpadding="0" bordercolor="#FFCC66">
              <tr>
                <td class="loginFFFFFFdroit" width="4%">&nbsp;</td>
                <td class="loginFFFFFFdroit" width="11%">Auteur</td>
                <td class="loginFFFFFF" width="30%">
                  <input type="text" name="textfield32" size="22" class="loginFFFFFF"
<?php
  echo ("value=\"$prenomaut $nomaut\"");
?>
                                >
                </td>
                <td class="loginFFFFFFdroit" width="15%">publi&eacute; par</td>
                <td class="loginFFFFFF" width="30%">
                  <input type="text" name="textfield322" size="22" class="loginFFFFFF"
<?php
  echo ("value=\"$prenompub $nompub\"");
?>
                                >
                </td>
                <td class="loginFFFFFF" width="5%"><img src="../zimages/lu.gif" width="20" height="24"></td>
              </tr>
              <tr>
                <td class="loginFFFFFFdroit"><img src=../lib/images/espaceur.gif width="25" height="1"></td>
                <td class="loginFFFFFFdroit" width="11%">date d'origine</td>
                <td class="loginFFFFFF" width="30&ugrave;">
                  <input type="text" name="textfield322" size="22" class="loginFFFFFF"
<?php
  $date_crea=affiche_date($date_crea);
  echo ("value=\"$date_crea\"");
?>
                >
                </td>
                <td class="loginFFFFFFdroit">derni&egrave;re modification</td>
                <td class="loginFFFFFF" width="30%">
                  <input type="text" name="textfield322" size="22" class="loginFFFFFF"
<?php
  if ($date_modif!=0)
  {
    $date_modif=affiche_date($date_modif);
    echo ("value=\"$date_modif\"");
  }
?>
>
                </td>
                <td class="loginFFFFFF" width="5%">21/03/01</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table width="600" border="4" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" bordercolor="#FFCC66">
        <tr>
          <td class="loginFFCC66" colspan="2">
            <table width="100%" border="0" cellspacing="4" cellpadding="0" bordercolor="#FFCC66">
              <tr>
                <td class="loginFFFFFFdroit" width="4%"><img src="../zimages/verou.gif" width="25" height="26"></td>
                <td class="loginFFFFFFdroit" width="11%" align="left">
                <div align="left"><?php echo ("niveau $nivo_conf"); ?></div>
                </td>
                <td class="loginFFFFFF" width="80%">
titre&nbsp; :                  <input type="text" name="textfield323" size="60" class="loginFFFFFF"
<?php
  echo ("value=\"$titre_art\"");
?>
                  >
<br>sujet :                  <input type="text" name="textfield328" size="60" class="loginFFFFFF"
<?php
  echo ("value=\"$sujet\"");
?>
                  >                  
                </td>
                <td class="loginFFFFFF"><a href="#bas"><img src="../zimages/bas.gif" width="25" height="26" border="0" alt="bas de page"></a></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <table width="100%" border="1" cellspacing="4" cellpadding="0" name="tablo001">
              <tr>
                <td class="loginFFFFFF"><img src="../imgarticle/<?php echo ("$img_1_nom"); ?>" width="72" height="71" alt="<?php echo ("$img_1_alt"); ?>"></td>
                <td class="txttabl" width=90%>
                  <p>
<?php
  echo ("$txt_1");
?>
                  </p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td colspan="2">
          <?php zone($num_article, 1, $table); ?></tr>
          </td>
        </tr>
        <tr>
          <td width=50%>
          <?php zone($num_article, 2, $table); ?>
          </td>
          <td width=50%>
          <?php zone($num_article, 3, $table); ?>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <table width="100%" border="1" cellspacing="4" cellpadding="0" name="tablo005">
              <tr>
                <td class="loginFFFFFF" width="10"><img src="../imgarticle/<?php echo ("$img_2_nom"); ?>"  height="71" alt="<?php echo ("$img_2_alt") ?>"></td>
                <td class="txttabl">
                <p>
<?php
  echo ("$txt_2");
?>
                </p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="txt">
          <?php zone($num_article, 4, $table); ?>
          </td>
        </tr>
        <tr bgcolor="#FFCC66" align="center" valign="middle">
          <td class="loginFFCC66">&nbsp;</td>
          <td class="loginFFCC66">
<?php
  if ($pub=="pub")
  {
    taillemod($taille, $num_article, "articles");
    echo (" <img src=\"../images_pop/modification.gif\" border=\"0\"></a>\n");

/*--- retouche pierre pour decider du choix emplacement homepage ---*/
    echo"<div align=right>";
    echo"<form action=\"article_publier.php?publication=ok&num_article=$num_article\" method=\"post\">";
    echo"Position Homepage ";
    echo ("<select name=\"homepage\">\n");
    echo ("<option value=\"4\">en liste</option>");
        echo ("<option value=\"1\">central gauche</option>");
            echo ("<option value=\"2\">haut droite</option>");
                echo ("<option value=\"3\">bas droite</option>");
    echo ("</select>\n");
    echo"<br><br><input type=image src=\"../images_pop/publier.gif\" border=0>";
    echo"</form>";
    echo"</div> ";
/* old
    echo (" <a href=\"article_publier.php?publication=ok&num_article=$num_article\"><img src=\"../images_pop/publier.gif\" width=\"130\" height=\"20\" border=\"0\"></a>\n");
*/
  }
  else
    echo ("&nbsp;");
?> </td>
        </tr>

        <tr bgcolor="#FFCC66" align="center" valign="middle">
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr bgcolor="#FFCC66" align="center" valign="middle">
          <td colspan="2"><a name="bas"></a><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=4,0,2,0" width="596" height="13">
              <param name=movie value=../lib/images/bandeau_frise.swf>
              <param name=quality value=high>
              <param name="BGCOLOR" value="#FFCC66">
              <param name="SCALE" value="exactfit">
              <embed src=../lib/images/bandeau_frise.swf quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" scale="exactfit" width="596" height="13" bgcolor="#FFCC66">
              </embed>
            </object></td>
        </tr>
        <tr bgcolor="#FFCC66">
          <td colspan="2">
            <table width="100%" border="0" cellspacing="4" cellpadding="0">
              <tr>
                <td bordercolor="#000000" class="loginFFCC66">quelques liens utiles</td>
                <td align="right" valign="middle"><a href="#haut"><img src="../zimages/haut.gif" width="25" height="26" border="0" alt="haut de page"></a></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <table width="100%" border="1" cellspacing="4" cellpadding="0">
              <?php liens_long($num_article, $table) ?>
            </table>
          </td>
        </tr>
        <tr>
          <td class="loginFFCC66droit" colspan="2">
<?php
$recupser=DatabaseOperation::query("select id_art_serv from $table where num_article='$num_article'");
$sercicou=mysql_result($recupser, 0, id_art_serv);
$infohome=etatnivo("$sercicou");
?><br><br>

<?php  if ($ins!='ins'){
echo"Information sur la presence des news de confidentialité 1  ";
echo"<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#FFFFFF\"> ";
echo"  <tr>";
echo"    <td class=\"txtfield\">";
echo"    <div align=\"center\">Service $sercicou</div>";
echo"    </td>";
echo"    <td class=\"txtfield\">";
echo"      <div align=\"center\">Gauche Centr&eacute;</div>";
echo"    </td>";
echo"    <td class=\"txtfield\"> ";
echo"      <div align=\"center\">Haut Droite</div>";
echo"    </td>";
echo"    <td class=\"txtfield\">";
echo"      <div align=\"center\">Bas Droite</div>";
echo"    </td>";
echo"    <td class=\"txtfield\">";
echo"      <div align=\"center\">En Liste</div>";
echo"    </td>";
echo"  </tr>";
echo"  <tr>";
echo"    <td class=\"txtfield\">";
echo"      <div align=\"center\">Confidentialit&eacute; 1</div>";
echo"    </td>";
echo"    <td class=\"txtfield\"> ";
echo"      <div align=\"center\">$infohome[0]</div>";
echo"    </td>";
echo"    <td class=\"txtfield\"><div align=\"center\">$infohome[1]</div></td>";
echo"    <td class=\"txtfield\"><div align=\"center\">$infohome[2]</div></td>";
echo"    <td class=\"txtfield\"><div align=\"center\">$infohome[3]</div></td>";
echo"  </tr>";
echo"</table>";
}
?>
<?php
 if ($ins=='ins'){
echo ("<div align=\"left\"><a href=\"#\" onClick=\"history.go(-5);return(false)\"><img src=\"../zimages/retour-j.gif\" width=\"130\" height=\"20\" border=\"0\"></a></div>\n");
echo"<br><b><div align=center>Votre article a été enregistré et sera activé par votre publicateur aprés vérification.
  Vous pouvez toujours corriger votre article - tant qu'il n'a pas été publié - en cliquant sur le bouton \"modification\" de votre page d'accueil</div></b>";
}
?>
          </td>
        </tr>
      </table>
</td>
  </tr>
</table>
<?php  include ("../adminagis/cadrebas.php"); ?>
</body>
</html>