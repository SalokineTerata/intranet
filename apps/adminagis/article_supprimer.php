<?php
//  require ("../lib/session.php");
//  include("../lib/functions.php");
      require_once '../inc/main.php';


identification1("salaries", $login, $pass);
  securadmin(4, $id_type);

//  include("functions.php");
//  include("functions.js");

/* suppression de l'article*/
  if ($supprimer=='ok')
  {

    $req="select num_article from archives where date_modif<>0";
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

/* suppression des articles */
        $req2="delete from archives where num_article='$num_article'";
        $result2=DatabaseOperation::query($req2);
                
        $req2="delete from archcomment where id_art='$num_article'";
        $result2=DatabaseOperation::query($req2);
        
        $req2="delete from archlu where id_art='$num_article'";
        $result2=DatabaseOperation::query($req2);        
        }
        $i++;
      }
    }
  }

?>
<html>
<head>
<title>Article &agrave; suppression</title>
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
          <td><img src="../images_pop/articles_archiv.gif" width="500" height="62"></td>
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
          <td width="5%" class="LOGINFFFFFFCENTRE" bgcolor="#FFCC66">Supprimer</td>
        </tr>
<?php

  $req="select taille, num_article, date_crea, salaries.nom, salaries.prenom, titre_art, sujet
  from archives, salaries where date_modif<>0 and archives.auteur=salaries.id_user order by date_modif";
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
              <INPUT TYPE="hidden"  name="supprimer" value="ok">
              <input type="image" border="0" src="../images_pop/supprimer.gif" width="130" height="20">
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