<?php
  include("../lib/session.php");
  include("../lib/functions.php");
  include("functions.php");
  identification1("salaries", $login, $pass);
  include ("functions.js");

?>
<html>
<head>
<title>Cr&eacute;ation d'article</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../lib/css/admin_intra01.css" type="text/css">
<link rel="stylesheet" href="../lib/css/admin_newsentrep.css" type="text/css">
<link rel="stylesheet" href="../lib/css/admin_newsgeneral.css" type="text/css">
<link rel="stylesheet" href="../lib/css/admin_newspopup.css" type="text/css">
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
<table width="630" border="0" cellspacing="0" cellpadding="0" align="left" height="304">
  <tr>
    <td>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="90"><img src=../lib/images/bandeau_etape0.gif width="90" height="62"></td>
          <td width="512"><img src="../images_pop/crea_article.gif" width="512" height="62"></td>
          <td width="28"><a href="../aide.php#news" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="20">
          </td>
        </tr>
      </table>
      <table width="300" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td colspan="2" class="loginFFCC66Ccentre">Que voulez-vous cr&eacute;er
            ?<br>
            <br>
             </td>
        </tr>
        <tr>
          <td>
            <center>
&nbsp;
            </center>
          </td>
          <td>
            <center>
&nbsp;
            </center>
          </td>
        </tr>
      </table>
      <img src=../lib/images/espaceur.gif width="10" height="40">
      <table width="405" border="2" cellspacing="10" cellpadding="0" align="center">
        <tr>
          <td>
            <table width="400" border="0" cellspacing="5" cellpadding="0" align="center">
              <tr>
                <td valign="middle">
<?php
  echo ("<a href=\"#\" onClick=\"MM_goToURL('parent','creacourt.php');return document.MM_returnValue\">");
  echo ("<img src=\"../images_pop/art_court.gif\" width=\"130\" height=\"20\" border=\"0\" alt=\"Créer un article court\">\n");
  echo ("</a>\n");
?>
                </td>
                <td valign="top"><img src=../lib/images/espaceur.gif width="10" height="10"></td>
                <td class="login">Destin&eacute; &agrave; un sujet peu d&eacute;velopp&eacute;,
                  votre article de type &quot;court&quot; s'ouvrira dans une fen&ecirc;tre
                  ind&eacute;pendante pour le lecteur.<br>
                  La cr&eacute;ation d'un Article Court se r&eacute;alise en une
                  seule &eacute;tape.</td>
              </tr>
              <tr>
                <td valign="top"><img src=../lib/images/espaceur.gif width="10" height="10"></td>
                <td valign="top">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td valign="middle">
<?php
  echo ("<a href=\"#\" onClick=\"MM_goToURL('parent','etap1long.php');return document.MM_returnValue\">");
  echo ("<img src=\"../images_pop/art_long.gif\" width=\"130\" height=\"20\" border=\"0\" alt=\"Créer un article long\">\n");
  echo ("</a>\n");
?>
</td>
                <td valign="top">&nbsp;</td>
                <td>
                  <p class="login">Si vous d&eacute;veloppez votre sujet et que
                    vous avez besoin d'un espace relativement modulable, choisissez
                    Article &quot;long&quot;. Votre sujet couvrira tout l'espace
                    &eacute;cran et, si vous y incorporez vos propres images,
                    sa longueur pourra &ecirc;tre importante.<br>
                    La cr&eacute;ation d'un Article Long se r&eacute;alise en
                    trois &eacute;tapes successives.</p>
                </td>
              </tr>
            </table>

          </td>
        </tr>
      </table>
             <table width="400" border="0" cellspacing="5" cellpadding="0" align="center">
               <tr>

          <td valign="top"><br> <a href="#" onClick="history.go(-1);return(false)"><img src="../zimages/retour-j.gif" width="130" height="20" border="0" alt="Revenir à la page précédente"></a></td>
               </tr>
             </table>
     </td>
  </tr>
</table>

</body>
</html>