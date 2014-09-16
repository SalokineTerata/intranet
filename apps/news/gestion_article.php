<?php
  require("../lib/session.php");
  include("../lib/functions.php");
  identification1("salaries", $login, $pass);
  include("functions.php");
  include("functions.js");


// Validation des changements de la page
// Voir pour suppression d'un article
// Voir pour mettre bon pour archive (archive=oui)

  if ($valider=='valider')
  {
// Pour chaque article de l'auteur, traitement
    $req="select num_article from articles where auteur='$id_user'";
    $result=DatabaseOperation::query($req);
    $num=mysql_num_rows($result);
    if ($num!=0)
    {
      $i=0;
      while ($i<$num)
      {
        $num_article=mysql_result($result, $i, num_article);
// Recuperation du numéro d'article et si c coche ou non
        $toto="num_article";
        $text= $$toto;
        $toto=$text."supp";
        $tata=$text."arch";
        $supp=$$toto;
        $arch=$$tata;
        if ($supp=='supp')
        {
// suppression de l'article
          $req2="delete from articles where num_article='$num_article'";
          $result2=DatabaseOperation::query($req2);
        }
        if ($arch=='oui')
        {
// Mise a oui du tag archive, sinon rien
          $req2="update articles set archive='oui' where num_article='$num_article'";
          $result2=DatabaseOperation::query($req2);
        }
        else
        {
          $req2="update articles set archive='' where num_article='$num_article'";
          $result2=DatabaseOperation::query($req2);
        }
        $i++;
      }
    }
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
<?php
  echo ("<form method=\"post\" action=\"$PHP_SELF\">\n");
?>
<table width="620" border="0" cellspacing="0" cellpadding="0" align="left">
  <tr>
    <td>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/bandeau_etape0.gif height="62"></td>
          <td><img src="../images_pop/gestion_article.gif" width="500" height="62"></td>
          <td><a href="../aide.php#news" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></td>
        </tr>
      </table>
      <br><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="20">
          </td>
        </tr>
        <tr>
          <td>
            <center>
              <input type="image" src="../zimages/valider-j.gif" width="130" height="20">
              <INPUT TYPE="HIDDEN" name="valider" value="valider">
            </center>
          </td>
        </tr>
      </table>
      <br><table width="98%" border="1" cellspacing="0" cellpadding="4" bgcolor="#FFE5B2" align=center>
        <tr>
          <td width="10%" class="LOGINFFFFFFCENTRE" bgcolor=FFCC66>
            <div align="center">Date de cr&eacute;ation</div>
          </td>
          <td width="25%" class="LOGINFFFFFFCENTRE" bgcolor=FFCC66>
            <div align="center">Titre</div>
          </td>
          <td width="25%" class="LOGINFFFFFFCENTRE" bgcolor=FFCC66>
            <div align="center" bgcolor=FFCC66>Sujet</div>
          </td>
          <td width="10%" class="LOGINFFFFFFCENTRE" bgcolor=FFCC66>Publier</td>
          <td width="10%" class="LOGINFFFFFFCENTRE" bgcolor=FFCC66>Modifier</td>
          <td width="5" class="LOGINFFFFFFCENTRE" bgcolor=FFCC66>Suppr.</td>
          <td width="5" class="LOGINFFFFFFCENTRE" bgcolor=FFCC66>Archiv.</td>
        </tr>
<?php
// Affichage de tous les articles de l'auteur non archivés
  $req="select taille, num_article, publica, titre_art, date_crea,
  archive, sujet from articles where auteur='$id_user'
  order by date_crea";

  $result=DatabaseOperation::query($req);
  $num=mysql_num_rows($result);
  if ($num!=0)
  {
    $i=0;
    while ($i<$num)
    {
      $taille=mysql_result($result, $i, taille);
      $num_article=mysql_result($result, $i, num_article);
      $publica=mysql_result($result, $i, publica);
      $titre_art=mysql_result($result, $i, titre_art);
      $date_crea=mysql_result($result, $i, date_crea);
      $archive=mysql_result($result, $i, archive);
      $sujet=mysql_result($result, $i, sujet);

      $titre_art=stripslashes($titre_art);
      $sujet=stripslashes($sujet);

// Gestion de l'affichage des dates
      echo ("  <tr>\n");
      $toto=affiche_date($date_crea);
      echo ("<td class=\"loginFFFFFF\" align=\"center\" width=\"10%\">$toto</td>\n");
      echo ("    <td class=\"loginFFFFFF\" align=\"center\" width=\"25%\">\n");
      taille($taille, $num_article, "articles", "gere");
      echo ("    $titre_art&nbsp;</a></td>\n");
      echo ("    <td class=\"loginFFFFFF\" align=\"center\" width=\"25%\">$sujet&nbsp;</td>\n");
      if ($publica!='')
        echo ("    <td class=\"loginFFFFFF\" align=\"center\" width=\"10%\">Oui</td>\n");
      else
        echo ("    <td class=\"loginFFFFFF\" align=\"center\" width=\"10%\">&nbsp;</td>\n");
      echo ("    <td class=\"loginFFFFFF\" align=\"center\" width=\"10%\" bgcolor=FFCC66>\n");
      if ($publica==''){
      taillemod($taille,$num_article, "articles");
      echo ("    <img src=\"../images_pop/modification.gif\" border=\"0\"></a></td>\n");
      }else{echo"&nbsp;";}
      $tata=$num_article."supp";
      $toto=$num_article."arch";
      if ($publica=='')
        echo ("    <td class=\"loginFFFFFF\" align=\"center\" width=\"5\"><INPUT TYPE=\"CHECKBOX\" name=\"$tata\" value=\"supp\"></td>\n");
      else
        echo ("    <td width=\"5\">&nbsp;</td>\n");
      if ($archive=='oui')
        echo ("    <td class=\"loginFFFFFF\" align=\"center\" width=\"5\"><INPUT TYPE=\"CHECKBOX\" name=\"$toto\" value=\"oui\" checked></td>\n");
      else
        if ($publica=='')
          echo ("    <td width=\"10%\">&nbsp;</td>\n");
        else
          echo ("    <td class=\"loginFFFFFF\" align=\"center\" width=\"5\"><INPUT TYPE=\"CHECKBOX\" name=\"$toto\" value=\"oui\"></td>\n");
      echo ("  </tr>\n");
      $i++;
    }
  }
?>
      </table>
    </td>
  </tr>
</table>
<?php  include ("../adminagis/../adminagis/cadrebas.php"); ?>
</body>
</html>