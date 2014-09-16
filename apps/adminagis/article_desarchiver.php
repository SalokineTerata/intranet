<?php
//  require ("../lib/session.php");
//  include("../lib/functions.php");
      require_once '../inc/main.php';

identification1("salaries", $login, $pass);
  securadmin(2, $id_type);

//  include("functions.php");
//  include("functions.js");

/* Desarchivage de l'article*/
  if ($desarchiver=='ok')
  {
/*// Pour chaque case a cochee on traite l'archivage*/
    $req="select num_article from archives, publicateur where publicateur.id_user='$id_user'
    and publicateur.id_service=archives.id_art_serv and date_modif<>0";
    $result=DatabaseOperation::query($req);
    $num=mysql_num_rows($result);
    if ($num!=0)
    {
      $i=0;
      while ($i<$num)
      {
        $num_article=mysql_result($result, $i, num_article);
/* Recuperation du numéro d'article et si c coche ou non*/
        $toto="num_article";
        $text= $$toto;
        $arch=$$text;
        if ($arch=='oui')
        {

/* Recuperation de toutes les variables de l'enregistrement et recopie dans*/
/* archives puis effacement dans articles*/
           $req2="select * from archives where num_article='$num_article'";
           $result2=DatabaseOperation::query($req2);
           $taille=mysql_result($result2, 0, taille);
           $id_art_group=mysql_result($result2, 0, id_art_group);
           $id_art_serv=mysql_result($result2, 0, id_art_serv);
           $auteur=mysql_result($result2, 0, auteur);
           $publica=mysql_result($result2, 0, publica);
           $titre_art=mysql_result($result2, 0, titre_art);
           $date_crea=mysql_result($result2, 0, date_crea);
           $date_modif=mysql_result($result2, 0, date_modif);
           $nivo_conf=mysql_result($result2, 0, nivo_conf);
           $img_1_alt=mysql_result($result2, 0, img_1_alt);
           $img_1_nom=mysql_result($result2, 0, img_1_nom);
           $img_2_nom=mysql_result($result2, 0, img_2_nom);
           $img_2_alt=mysql_result($result2, 0, img_2_alt);
           $txt_1=mysql_result($result2, 0, txt_1);
           $txt_2=mysql_result($result2, 0, txt_2);
           $zone_1_type=mysql_result($result2, 0, zone_1_type);
           $zone_1_info=mysql_result($result2, 0, zone_1_info);
           $zone_1_justif=mysql_result($result2, 0, zone_1_justif);
           $zone_1_lien=mysql_result($result2, 0, zone_1_lien);
           $zone_2_type=mysql_result($result2, 0, zone_2_type);
           $zone_2_info=mysql_result($result2, 0, zone_2_info);
           $zone_2_justif=mysql_result($result2, 0, zone_2_justif);
           $zone_2_lien=mysql_result($result2, 0, zone_2_lien);
           $zone_3_type=mysql_result($result2, 0, zone_3_type);
           $zone_3_info=mysql_result($result2, 0, zone_3_info);
           $zone_3_justif=mysql_result($result2, 0, zone_3_justif);
           $zone_3_lien=mysql_result($result2, 0, zone_3_lien);
           $zone_4_type=mysql_result($result2, 0, zone_4_type);
           $zone_4_info=mysql_result($result2, 0, zone_4_info);
           $zone_4_justif=mysql_result($result2, 0, zone_4_justif);
           $zone_4_lien=mysql_result($result2, 0, zone_4_lien);
           $lien_1_type=mysql_result($result2, 0, lien_1_type);
           $lien_1_cont=mysql_result($result2, 0, lien_1_cont);
           $lien_1_txt=mysql_result($result2, 0, lien_1_txt);
           $lien_2_type=mysql_result($result2, 0, lien_2_type);
           $lien_2_cont=mysql_result($result2, 0, lien_2_cont);
           $lien_2_txt=mysql_result($result2, 0, lien_2_txt);
           $lien_3_type=mysql_result($result2, 0, lien_3_type);
           $lien_3_cont=mysql_result($result2, 0, lien_3_cont);
           $lien_3_txt=mysql_result($result2, 0, lien_3_txt);
           $lien_4_type=mysql_result($result2, 0, lien_4_type);
           $lien_4_cont=mysql_result($result2, 0, lien_4_cont);
           $lien_4_txt=mysql_result($result2, 0, lien_4_txt);
           $lien_5_type=mysql_result($result2, 0, lien_5_type);
           $lien_5_cont=mysql_result($result2, 0, lien_5_cont);
           $lien_5_txt=mysql_result($result2, 0, lien_5_txt);
           $homepage=mysql_result($result2, 0, homepage);
           $archive=mysql_result($result2, 0, archive);
           $diffusion=mysql_result($result2, 0, diffusion);
           $sujet=mysql_result($result2, 0, sujet);
           
           $auteur=addslashes($auteur);
           $publica=addslashes($publica);
           $titre_art=addslashes($titre_art);
           $img_1_alt=addslashes($img_1_alt);
           $img_2_alt=addslashes($img_2_alt);
           $txt_1=addslashes($txt_1);
           $txt_2=addslashes($txt_2);
           $zone_1_info=addslashes($zone_1_info);
           $zone_1_lien=addslashes($zone_1_lien);
           $zone_2_info=addslashes($zone_2_info);
           $zone_2_justif=addslashes($zone_2_justif);
           $zone_2_lien=addslashes($zone_2_lien);
           $zone_3_info=addslashes($zone_3_info);
           $zone_3_justif=addslashes($zone_3_justif);
           $zone_3_lien=addslashes($zone_3_lien);
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
           $sujet=addslashes($sujet);           
           
/* + ajout de la date et de l'id_user qui a arvhive*/
           $req3="insert into articles
           (num_article, taille, id_art_group, id_art_serv, auteur, publica, titre_art, date_crea, date_modif, nivo_conf,
           img_1_alt, img_1_nom, img_2_nom, img_2_alt, txt_1, txt_2, zone_1_type, zone_1_info, zone_1_justif, zone_1_lien, zone_2_type, zone_2_info,
           zone_2_justif, zone_2_lien, zone_3_type, zone_3_info, zone_3_justif, zone_3_lien, zone_4_type, zone_4_info, zone_4_justif, zone_4_lien, lien_1_type,
           lien_1_cont, lien_1_txt, lien_2_type, lien_2_cont, lien_2_txt, lien_3_type, lien_3_cont, lien_3_txt, lien_4_type, lien_4_cont, lien_4_txt,
           lien_5_type, lien_5_cont, lien_5_txt, homepage, diffusion, archive, sujet)
           values ('$num_article', '$taille', '$id_art_group', '$id_art_serv', '$auteur', '$publica', '$titre_art', '$date_crea', '$date_modif', '$nivo_conf',
           '$img_1_alt', '$img_1_nom', '$img_2_nom', '$img_2_alt', '$txt_1', '$txt_2', '$zone_1_type', '$zone_1_info', '$zone_1_justif', '$zone_1_lien', '$zone_2_type', '$zone_2_info',
           '$zone_2_justif', '$zone_2_lien', '$zone_3_type', '$zone_3_info', '$zone_3_justif', '$zone_3_lien', '$zone_4_type', '$zone_4_info', '$zone_4_justif', '$zone_4_lien', '$lien_1_type',
           '$lien_1_cont', '$lien_1_txt', '$lien_2_type', '$lien_2_cont', '$lien_2_txt', '$lien_3_type', '$lien_3_cont', '$lien_3_txt', '$lien_4_type', '$lien_4_cont', '$lien_4_txt',
           '$lien_5_type', '$lien_5_cont', '$lien_5_txt', '$homepage', '$diffusion', '$archive', '$sujet')";
           $result3=DatabaseOperation::query($req3);
//echo"$req3";           
           if ($result3!=false)
           {
/* Suppression de cet article dans la table ARTICLES */
             $req4="delete from archives where num_article='$num_article'";
             $result4=DatabaseOperation::query($req4);
/* On desarchive les commentaires */
             $req4="select * from archcomment where id_art='$num_article'";
             $result4=DatabaseOperation::query($req4);
             $num4=mysql_num_rows($result4);
             if ($num4 != 0)
             {
               $k=0;
               while ($k<$num4)
               {
                 $user=mysql_result($result4, $k, id_user);
                 $commentaire==mysql_result($result4, $k, commentaire);
                 $date==mysql_result($result4, $k, date);
                 $id_comment==mysql_result($result4, $k, id_comment);
                 $req5="insert into comment values ('$num_article', '$user', '$commentaire', '$date', '$id_comment')";
                 $result5=DatabaseOperation::query($req5);
                 $k++;
               }
               $req4="delete from archcomment where id_art='$num_article'";
               $result4=DatabaseOperation::query($req4);
             }
/* on archive la table lu */
             $req4="select * from archlu where id_art='$num_article'";
             $result4=DatabaseOperation::query($req4);
             $num4=mysql_num_rows($result4);
             if ($num4 != 0)
             {
               $k=0;
               while ($k<$num4)
               {
                 $user=mysql_result($result4, $k, id_user);
                 $date=mysql_result($result4, $k, date);
                 $req5="insert into lu values ('$num_article', '$user', '$date')";
                 $result5=DatabaseOperation::query($req5);
                 $k++;
               }
               $req4="delete from archlu where id_art='$num_article'";
               $result4=DatabaseOperation::query($req4);
             }
           }
        }
        $i++;
      }
    }
  }

?>
<html>
<head>
<title>Article &agrave; desarchiver</title>
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
<?php  include ("../adminagis/cadrehautnews.php"); ?>
<?php
  echo ("<form method=\"post\" action=\"$PHP_SELF\">\n");
?>
<table width="620" border="0" cellspacing="0" cellpadding="0" align="left">
  <tr>
    <td>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/bandeau_etape0.gif height="62"></td>
          <td><img src="../images_pop/articles_desarch.gif" width="500" height="62"></td>
          <td><a href="../aide.php#adminnew" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
      <table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="20">
          </td>
        </tr>
      </table>
<br><table width="98%" border="1" cellspacing="0" cellpadding="3" align=center bgcolor="#FFE5B2">
        <tr>
          <td width="15%" class="LOGINFFFFFFCENTRE" bgcolor="#FFCC66">
            <div align="left">Date de cr&eacute;ation</div>
          </td>
          <td width="23%" class="LOGINFFFFFFCENTRE" bgcolor="#FFCC66">
            <div align="left">Auteur</div>
          </td>
          <td width="23%" class="LOGINFFFFFFCENTRE" bgcolor="#FFCC66">
            <div align="left">Titre</div>
          </td>
          <td width="23%" class="LOGINFFFFFFCENTRE" bgcolor="#FFCC66">
            <div align="left">Sujet</div>
          </td>
          <td width="11%" class="LOGINFFFFFFCENTRE" bgcolor="#FFCC66">Publier</td>
          <td width="5%" class="LOGINFFFFFFCENTRE" bgcolor="#FFCC66">D&eacute;sarchiver</td>
        </tr>
<?php

/* recherche des services auxquels a droit le publicateur
   C'est le publicateur qui desarchive ses articles */
  $req="select taille, num_article, date_crea, salaries.nom, salaries.prenom, titre_art, sujet
  from archives, publicateur, salaries where publicateur.id_user='$id_user'
  and publicateur.id_service=archives.id_art_serv and date_modif<>0 and archives.auteur=salaries.id_user order by date_modif";
  $result=DatabaseOperation::query($req);
  $num=mysql_num_rows($result);
  if ($num!=0)
  {
    $i=0;
    while ($i<$num)
    {
      $taille=mysql_result($result, $i, taille);
      $num_article=mysql_result($result, $i, num_article);
      $date_crea=mysql_result($result, $i, date_crea);
      $sal_nom=mysql_result($result, $i, nom);
      $sal_prenom=mysql_result($result, $i, prenom);
      $titre_art=mysql_result($result, $i, titre_art);
      $sujet=mysql_result($result, $i, sujet);
      
      $titre_art=stripslashes($titre_art);
      $sujet=stripslashes($sujet);      
      
      echo ("  <tr>\n");
      echo ("    <td class=\"loginFFFFFF\">\n");
      echo ("      <div align=\"left\">$date_crea</div>\n");
      echo ("    </td>\n");
      echo ("    <td class=\"loginFFFFFF\">\n");
      echo ("      <div align=\"left\">$sal_prenom $sal_nom </div>\n");
      echo ("    </td>\n");
      echo ("    <td class=\"loginFFFFFF\">\n");
      echo ("      <div align=\"left\">&nbsp;$titre_art</div>\n");
      echo ("    </td>\n");
      echo ("    <td class=\"loginFFFFFF\">\n");
      echo ("      <div align=\"left\">&nbsp;$sujet</div>\n");
      echo ("    </td>\n");
      echo ("    <td class=\"loginFFFFFF\" bgcolor=\"#FFCC66\">\n");
      echo ("      <center>\n");
      taille($taille, $num_article, "archives", '');
      echo ("      <img src=\"../images_pop/voir.gif\" width=\"61\" height=\"20\" border=\"0\"></a>\n");
      echo ("      </center>\n");
      echo ("    </td>\n");
      echo ("    <td class=\"loginFFFFFF\">\n");
      echo ("      <center>\n");
      echo ("        <INPUT TYPE=\"CHECKBOX\" name=\"$num_article\" value=\"oui\">\n");
      echo ("      </center>\n");
      echo ("    </td>\n");
      echo ("  </tr>\n");
      $i++;
    }
  }
?>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="20"></td>
        </tr>
        <tr>
          <td>
            <center>
              <INPUT TYPE="hidden"  name="desarchiver" value="ok">
              <input type="image" border="0" src="../images_pop/desarchiver.gif" width="130" height="20">
            </center>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php  include ("../adminagis/cadrebas.php"); ?>
</body>
</html>