<?php
//  require("../lib/session.php");
//  include("../lib/functions.php");
      require_once '../inc/main.php';

identification1("salaries", $login, $pass);
  securadmin(2, $id_type);
//  include("functions.php");
//  include("functions.js");

  if ($publication=='ok')
  {
/* On renseigne le champ publicateur et la date de modif */
    $req="update articles set publica='$id_user', date_modif=now() , homepage='$homepage' where num_article='$num_article'";
    $result=DatabaseOperation::query($req);

  }

/* Suppression de l'article*/
  if ($supp=='ok')
  {
    $req="delete from articles where num_article='$num_article'";
    $result=DatabaseOperation::query($req);
  }
?>
<html>
<head>
<title>Article &agrave; publier</title>
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
<table width="630" border="0" cellspacing="0" cellpadding="0" align="left">
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/bandeau_etape0.gif width="90" height="62"></td>
          <td><img src="../images_pop/articles_publier.gif" width="512" height="62"></td>
          <td><a href="../aide.php#news" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="20">
          </td>
        </tr>
      </table>
      <table width="98%" border="1" cellspacing="0" cellpadding="4" bgcolor="#FFE5B2" align=center>
        <tr>
          <td colspan="6" class="loginFFCC66Ccentre" height="35">V&eacute;rification
            - Activation des articles &agrave; publier</td>
        </tr>

        <?php
      echo ("  <tr>\n");
      echo ("    <td width=\"15%\" class=\"loginFFCC66\">\n");
      echo ("      <div align=\"left\">Date de cr&eacute;ation</div>\n");
      echo ("    </td>\n");
      echo ("    <td width=\"13%\" class=\"loginFFCC66\">\n");
      echo ("      <div align=\"left\">Auteur</div>\n");
      echo ("    </td>\n");
      echo ("    <td width=\"17%\" class=\"loginFFCC66\">\n");
      echo ("      <div align=\"left\">Titre</div>\n");
      echo ("    </td>\n");
      echo ("    <td width=\"17%\" class=\"loginFFCC66\">\n");
      echo ("      <div align=\"left\">Sujet</div>\n");
      echo ("    </td>\n");
      echo ("    <td width=\"19%\" class=\"loginFFCC66\">Publication</td>\n");
      echo ("    <td width=\"19%\" class=\"loginFFCC66\">Suppression</td>\n");
      echo ("  </tr>\n");

/* recherche des services auxquels a droit le publicateur*/
  $req="select distinct taille, num_article, date_crea, titre_art, sujet, auteur, nivo_conf, id_art_serv
  from articles, publicateur where publicateur.id_user='$id_user'
  and publicateur.id_service=articles.id_art_serv and articles.date_modif=0";
  $result=DatabaseOperation::query($req);
  $num=mysql_num_rows($result);
  if ($num!=0)
  {
    $i=0;
    while ($i<$num)
    {
      $taille=mysql_result($result, $i, taille);
      $nivo_conf=mysql_result($result, $i, nivo_conf);
      $id_art_serv=mysql_result($result, $i, id_art_serv);
      $num_article=mysql_result($result, $i, num_article);
      $date_crea=mysql_result($result, $i, date_crea);
      $titre_art=mysql_result($result, $i, titre_art);
      $sujet=mysql_result($result, $i, sujet);
      $auteur=mysql_result($result, $i, auteur);
      $req2="select nom, prenom from salaries where id_user='$auteur'";
      $result2=DatabaseOperation::query($req2);
      $sal_nom=mysql_result($result2, 0, nom);
      $sal_prenom=mysql_result($result2, 0, prenom);
/* Regarder si le niveau de confidentialite de la personne est superieur ou egal a celui de l'article*/
      $req2="select serv_conf from modes where id_user='$id_user' and id_service='$id_art_serv'";

      $result2=DatabaseOperation::query($req2);
      $conf=mysql_result($result2, 0, serv_conf);
      if ($conf >= $nivo_conf)
      {

      $titre_art=stripslashes($titre_art);
      $sujet=stripslashes($sujet);


        echo ("  <tr>\n");
        echo ("    <td class=\"loginFFFFFF\">\n");
        echo ("      <div align=\"left\">&nbsp;$date_crea</div>\n");
        echo ("    </td>\n");
        echo ("    <td class=\"loginFFFFFF\">\n");
        echo ("      <div align=\"left\">&nbsp;$sal_prenom $sal_nom </div>\n");
        echo ("    </td>\n");
        echo ("    <td class=\"loginFFFFFF\">\n");
        echo ("      <div align=\"left\">&nbsp;$titre_art </div>\n");
        echo ("    </td>\n");
        echo ("    <td class=\"loginFFFFFF\">\n");
        echo ("      <div align=\"left\"> &nbsp;$sujet</div>\n");
        echo ("    </td>\n");
        echo ("    <td class=\"loginFFFFFF\"  bgcolor=FFCC66>\n");
        taille($taille, $num_article, "articles", "pub");
        echo ("      <img src=\"../images_pop/publier.gif\" width=\"130\" height=\"20\" border=\"0\" alt=\"Vérifier l'article avant publication\"></a>\n");
        echo ("    </td>\n");
        echo ("    <td class=\"loginFFFFFF\" bgcolor=FFCC66><a href=\"article_publier.php?supp=ok&num_article=$num_article\"><img src=\"../images_pop/supprimer.gif\" border=\"0\" width=\"130\" height=\"20\" alt=\"Supprimer l'article. Pas de publication\"></a>\n");
        echo ("    </td>\n");
        echo ("  </tr>\n");
      }
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