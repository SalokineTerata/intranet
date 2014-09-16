<?php
  require("../lib/session.php");
  include("../lib/functions.php");
  identification1("salaries", $login, $pass);
  include("functions.php");
  include("functions.js");


?>
<html>
<head>
<title>news-court</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href=../lib/css/admin_intra01.css type="text/css">
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
<?php

echo "
     <form ENCTYPE=multipart/form-data method=post name=principal action=news_courte.php>
     <input type=hidden name=MAX_FILE_SIZE value=1000000>

     <table width=630 border=0 cellspacing=0 cellpadding=0 align=center>
     <tr>
     <td>
         <table width=600 border=0 cellspacing=0 cellpadding=0>
         <tr>
         <td width=90>
         <img src=../lib/images/bandeau_etape0.gif width=90 height=62>
         </td>
         <td width=512>
         <img src=images/bandeau_saisie_article_court2.gif width=512 height=62>
         </td>
         <td width=28>
         <a href=doc/aide.php#news target=_blank>
         <img src=../lib/images/bandeau_aide_point_interrogation.gif width=28 height=62 border=0>
         </a>
         </td>
         </tr>
         </table>

         <table width=85% border=0 cellspacing=4 cellpadding=0 bgcolor=FFE5B2 align=center>
         <tr>
         <td class=loginFFFFFFdroit width=5%>
         &nbsp;
         </td>
         <td class=loginFFFFFFdroit width=15%>
         Auteur :
         </td>
         <td class=loginFFFFFF width=30%>
     ";


// Nom user
  $req="select nom, prenom from salaries where id_user='$id_user'";
  $result=DatabaseOperation::query($req);
  if ($result!=false)
  {
    $sal_nom=mysql_result($result, 0, nom);
    $sal_prenom=mysql_result($result, 0, prenom);
    echo ("$sal_prenom $sal_nom");
  }

echo "
     </td>
     <td class=loginFFFFFFdroit width=15%>
     Publi&eacute; par :
     </td>
     <td class=loginFFFFFF width=30%>
     -
     </td>
     <td class=loginFFFFFF width=5%>
     &nbsp;
     </td>
     </tr>
     <tr>
     <td class=loginFFFFFFdroit>
     &nbsp;
     </td>
     <td class=loginFFFFFFdroit width=11%>
     Date d'origine :
     </td>
     <td class=loginFFFFFF width=30%>
     ";

// Date du jour
  setlocale (LC_TIME, "french");
  $date=strftime ("%A %d  %B %Y");
  echo ("$date");


echo "
     </td>
     <td class=loginFFFFFFdroit>
     Derni&egrave;re modification :
     </td>
     <td class=loginFFFFFF>
     -
     </td>
     <td class=loginFFFFFF width=5%>
     &nbsp;
     </td>
     </tr>
     </table>


     <table width=85% border=1 cellspacing=2 cellpadding=0 align=center>
     <tr>
     <td class=loginFFFFFFdroit valign=middle rowspan=3 align=center>
     <div align=center>
     <img src=../lib/images/icone_confidentialite.gif width=20 height=41>
     </div>
     </td>
     <td class=loginFFFFFFCENTRE valign=middle colspan=2>
     Confidentialit&eacute; de l'article par
     </td>
     <td class=loginFFFFFFCENTRE>
     En-t&ecirc;tes de l'article
     </td>
     </tr>
     <tr>
     <td class=loginFFFFFFdroit valign=middle>
     <div align=center>
     <input type=radio name=choixconf value=nivo checked>
     </div>
     </td>
     <td class=loginFFFFFFdroit valign=middle>
     <div align=left>
     Niveau
     <input type=text name=nivo_conf size=2 class=txtfield maxlength=2 value=1 />
     </div>
     </td>
     <td class=loginFFFFFF>
     <div align=right>
     <span class=loginFFFFFFdroit>
     Titre :
     </span>
     <input type=text name=titre_art size=40 class=txtfield>
     </div>
     </td>
     </tr>
     <tr>
     <td class=loginFFFFFFdroit valign=middle>


     <!-- Par Boris 2004/03/30, Arret de l'utilisation des listes de diffusion
     <div align=center>
     <input type=radio name=choixconf value=diff>
     </div>
     //-->

     </td>
     <td class=loginFFFFFFdroit>

     <!-- Par Boris 2004/03/30, Arret de l'utilisation des listes de diffusion
     <div align=left>
     Diffusion :
     ";

// Liste déroulante des listes de diffusion
    $req="select distinct nomliste from diffusion order by nomliste";
    $result=DatabaseOperation::query($req);
    if ($result!= false)
    {
      echo ("<select name=nomliste>\n");
      while ($row=mysql_fetch_row($result))
      {
        echo ("<option value=$row[0]>$row[0]</option>");
      }
      echo ("</select>\n");
    }

echo "
     </div>
     //-->

     </td>
     <td class=loginFFFFFF>
     <div align=right>
     <span class=loginFFFFFFdroit>
     Sujet :
     </span>
     <input type=text name=sujet size=40 class=txtfield>
     </div>
     </td>
     </tr>
     </table>


     <img src=../lib/images/espaceur.gif width=1 height=10>
     <img src=../lib/images/espaceur.gif width=1 height=10>


     <table width=80% border=0 cellspacing=4 cellpadding=0>
     <tr>
     <td bordercolor=#000000 class=loginFFCC66>
     PARTIE 1 : Image et texte n&deg; 1 - Haut d'article
     </td>
     </tr>
     </table>


     <table width=100% border=1 cellspacing=4 cellpadding=0 name=tablo001 bgcolor=#FFFFFF align=center>
     <tr>
     <td class=loginFFFFFF width=72 height=71>
     <img src=../lib/images/bouton_image.gif width=72 height=71>
     </td>
     <td class=txttabl>
     <p align=center>
     <textarea name=txt_1 cols=60 wrap=VIRTUAL class=txtfield rows=4>
     </textarea>
     </p>
     </td>
     </tr>
     </table>


     <table width=100% border=1 cellspacing=4 cellpadding=0 bgcolor=#FFFFFF align=center>
     <tr bgcolor=ffe5b2>
     <td width=25% class=loginFFFFFF>
     <div align=left class=logFFE5B2>
     <img src=../lib/images/bouton_aide_point_interrogation.gif width=25 height=26>
     <br>
     Utilisez des fichiers images aux formats .gif, .png ou .jpg.
     </div>
     </td>
     <td valign=middle colspan=4>
     <div align=right>
     <p class=logFFE5B2>
     <br>
     <input type=file name=img_1_nom>
     </p>
     </div>
     </td>
     <td class=logFFE5B2>
     <div align=center width=25>
     Infobulle
     <br>
     <input type=text name=img_1_alt size=8>
     </div>
     </td>
     </tr>
     <tr bgcolor=ffe5b2>
     <td class=loginFFFFFF>
     <div class=logFFE5B2>
     <img src=../lib/images/bouton_aide_point_interrogation.gif width=25 height=26>
     <br>
     OU... Si vous n'avez pas d'image sur mesure, choisissez une de ces images g&eacute;n&eacute;riques.
     </div>
     </td>
     <td bgcolor=ffe5b2>
     <div align=center>
     <input type=radio name=img_1_nomr value=photo1.jpg>
     <br>
     <img src=images/photo1.jpg width=72 height=71>
     </div>
     </td>
     <td bgcolor=ffe5b2>
     <div align=center>
     <input type=radio name=img_1_nomr value=photo2.jpg>
     <br>
     <img src=images/photo2.jpg width=72 height=71>
     </div>
     </td>
     <td bgcolor=ffe5b2>
     <div align=center>
     <input type=radio name=img_1_nomr value=photo3.jpg>
     <br>
     <img src=images/photo3.jpg width=72 height=71>
     </div>
     </td>
     <td bgcolor=ffe5b2>
     <div align=center>
     <input type=radio name=img_1_nomr value=photo4.jpg>
     <br>
     <img src=images/photo4.jpg width=72 height=71>
     </div>
     </td>
     <td bgcolor=ffe5b2>
     <div align=center>
     <input type=radio name=img_1_nomr value=photo5.jpg>
     <br>
     <img src=images/photo5.jpg width=72 height=71>
     </div>
     </td>
     </tr>
     </table>


     <table width=80% border=0 cellspacing=4 cellpadding=0>
     <tr>
     <td bordercolor=#000000 class=loginFFCC66>
     PARTIE 2 : Image et texte n&deg; 2 - Bas d'article
     </td>
     </tr>
     </table>


     <table width=100% border=1 cellspacing=4 cellpadding=0 name=tablo005 align=center bgcolor=FFFFFF>
     <tr>
     <td class=loginFFFFFF width=72 height=71>
     <img src=../lib/images/bouton_image.gif width=72 height=71>
     </td>
     <td class=txttabl>
     <p align=center>
     <textarea name=txt_2 cols=60 wrap=VIRTUAL rows=4 class=txtfield>
     </textarea>
     </p>
     </td>
     </tr>
     </table>


     <table width=100% border=1 cellspacing=4 cellpadding=0 bgcolor=#FFFFFF align=center>
     <tr bgcolor=ffe5b2>
     <td class=loginFFFFFF width=25%>
     <div align=left class=logFFE5B2>
     <img src=../lib/images/bouton_aide_point_interrogation.gif width=25 height=26>
     <br>
     Utilisez des fichiers images aux formats .gif, .png ou .jpg.
     </div>
     </td>
     <td valign=middle colspan=4>
     <div align=right>
     <p class=logFFE5B2>
     <input type=file name=img_2_nom>
     <br>
     </p>
     </div>
     </td>
     <td class=logFFE5B2 width=25>
     <div align=center>
     Infobulle
     <br>
     <input type=text name=img_2_alt size=8>
     </div>
     </td>
     </tr>
     <tr bgcolor=ffe5b2>
     <td class=loginFFFFFF width=25%>
     <div class=logFFE5B2>
     <img src=../lib/images/bouton_aide_point_interrogation.gif width=25 height=26>
     <br>
     OU... Si vous n'avez pas d'image sur mesure, choisissez une de ces images g&eacute;n&eacute;riques.
     </div>
     </td>
     <td bgcolor=ffe5b2>
     <div align=center>
     <input type=radio name=img_2_nomr value=photo1.jpg>
     <br>
     <img src=images/photo1.jpg width=72 height=71>
     </div>
     </td>
     <td bgcolor=ffe5b2>
     <div align=center>
     <input type=radio name=img_2_nomr value=photo2.jpg>
     <br>
     <img src=images/photo2.jpg width=72 height=71>
     </div>
     </td>
     <td bgcolor=ffe5b2>
     <div align=center>
     <input type=radio name=img_2_nomr value=photo3.jpg>
     <br>
     <img src=images/photo3.jpg width=72 height=71>
     </div>
     </td>
     <td bgcolor=ffe5b2>
     <div align=center>
     <input type=radio name=img_2_nomr value=photo4.jpg>
     <br>
     <img src=images/photo4.jpg width=72 height=71>
     </div>
     </td>
     <td bgcolor=ffe5b2>
     <div align=center>
     <input type=radio name=img_2_nomr value=photo5.jpg>
     <br>
     <img src=images/photo5.jpg width=72 height=71>
     </div>
     </td>
     </tr>
     </table>

     <table width=80% border=0 cellspacing=4 cellpadding=0>
     <tr>
     <td bordercolor=#000000 class=loginFFCC66>PARTIE 3 : Quelques liens utiles
     </td>
     </tr>
     </table>

     <table width=100% border=1 cellspacing=4 cellpadding=0 bgcolor=ffffff>
     <tr bgcolor=FFE5B2>
     <td class=logFFE5B2 bordercolor=#000000 bgcolor=FFE5B2>
     Type
     ";

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
      </table>
      <img src="../lib/images/espaceur.gif" width="10" height="20">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td>
            <center>
              </center>
          </td>
          <td>
<?php/*            <div align="right"><a href="#" onClick="oblig();"><img src="../zimages/valider-j.gif" border="0" width="130" height="20" alt="Valider et enregistrer le nouvel Article"></a></div>*/?>
            <div align="right"><input type="image" src="../zimages/valider-j.gif" border="0" width="130" height="20" alt="Valider et enregistrer le nouvel Article"></div>
            <INPUT TYPE="HIDDEN" NAME="table" value="articles">
            <INPUT TYPE="HIDDEN" NAME="insertion" value="insertion">
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</form>
</body>
</html>