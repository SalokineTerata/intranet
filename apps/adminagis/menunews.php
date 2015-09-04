<TABLE WIDTH="150" BORDER="0" CELLPADDING="0" CELLSPACING="0" valign="top"  bgcolor="FFE5B2">
  <TR  bgcolor="FFCC66">
    <TD WIDTH="10" HEIGHT="1"  bgcolor="FFCC66"><img src=../lib/images/espaceur.gif width="1" height="1" >
    </TD>
    <TD WIDTH="29" HEIGHT="1"><img src=../lib/images/espaceur.gif width="1" height="1">
    </TD>
    <TD WIDTH="65" HEIGHT="1">&nbsp; </TD>
    <TD WIDTH="36" HEIGHT="1"><img src=../lib/images/espaceur.gif width="1" height="1">
    </TD>
    <TD WIDTH="11" HEIGHT="1"><img src=../lib/images/espaceur.gif width="1" height="1">
    </TD>
  </TR>
  <tr  bgcolor="FFCC66">
    <td width="10" height="1" bgcolor="FFCC66"><img src=../lib/images/espaceur.gif width="1" height="1">
    </td>
    <td width="29" height="1" bgcolor="FFCC66"><img src=../lib/images/espaceur.gif width="1" height="1">
    </td>
    <td width="65" height="1" bgcolor="FFCC66">&nbsp; </td>
    <td width="36" height="1" bgcolor="FFCC66"><img src=../lib/images/espaceur.gif width="1" height="1">
    </td>
    <td width="10" height="1" bgcolor="FFCC66"><img src=../lib/images/espaceur.gif width="1" height="1">
    </td>
  </tr>
  <TR bgcolor="FFCC66">
    <TD WIDTH="39" HEIGHT="83" COLSPAN="2" bgcolor="#FFCC66"> <IMG SRC="../lib/images/espaceur.gif"></TD>
    <TD> <IMG SRC="../adminagis/images/logo_agis.gif" WIDTH="65" HEIGHT="83"></TD>
    <TD WIDTH="46" HEIGHT="83" COLSPAN="2" bgcolor="#FFCC66"> <IMG SRC="../lib/images/espaceur.gif"></TD>
  </TR>
  <TR bgcolor="#FFCC66">
    <TD WIDTH="150" HEIGHT="13" COLSPAN="5"> <IMG SRC="../lib/images/espaceur.gif"></TD>
  </TR>
  <TR bgcolor="FFCC66">
    <TD WIDTH="10" HEIGHT="20" bgcolor="#FFCC66"> <IMG SRC="../lib/images/espaceur.gif" width="8" height="8"></TD>
    <TD COLSPAN="3" bgcolor="FFCC66"><a href="../index.php?action=delog"><img src="../lib/images/bouton_deconnexion.gif" width="130" height="20" border=0></a></TD>
    <TD WIDTH="10" HEIGHT="20" bgcolor="#FFCC66"> <IMG SRC="../lib/images/espaceur.gif"></TD>
  </TR>
  <TR bgcolor="FFCC66">
    <TD WIDTH="150" HEIGHT="6" COLSPAN="5"> <IMG SRC="../lib/images/espaceur.gif"></TD>
  </TR>
  <TR bgcolor="FFCC66">
    <TD WIDTH="10" HEIGHT="20" bgcolor="#FFCC66"> <IMG SRC="../lib/images/espaceur.gif"></TD>
    <TD COLSPAN="3"><a href=../index.php><img src="../lib/images/bouton_retour_accueil.gif" width="130" height="20" border=0></a></TD>
    <TD WIDTH="10" HEIGHT="20" bgcolor="#FFCC66"> <IMG SRC="../lib/images/espaceur.gif"></TD>
  </TR>
  <TR bgcolor="FFCC66">
    <TD COLSPAN=5> <IMG SRC="../lib/images/espaceur.gif" WIDTH=150 HEIGHT=8></TD>
  </TR>
  <TR>
    <TD COLSPAN=5><IMG SRC="../lib/images/bandeau_vague.gif" WIDTH=150 HEIGHT=29></TD>
  </TR>
  <TR>
    <TD COLSPAN=5 align=center>
<?php

//Mise en commentaire par Boris le 2004-04-01
//    include("../navchiffre.inc");

?>
    </TD>
  </TR>

  <?php 
echo"<TR>";
echo"<TD COLSPAN=5><img src=../lib/images/espaceur.png width=\"10\" height=\"27\">";
echo"</TD>";
echo"</TR>";
echo"<TD><IMG SRC=../lib/images/espaceur.png WIDTH=10 HEIGHT=20></TD>";
echo"<TD COLSPAN=3>";
echo"<a href=../adminagis/gestion_public1.php><IMG SRC=\"../images-index/publicateurs.gif\" WIDTH=\"130\" HEIGHT=\"20\" border=0></a></TD>";
echo"<TD><IMG SRC=../lib/images/espaceur.png WIDTH=10 HEIGHT=20></TD>";
echo"</TR>";
?>

<?php 
echo"<TR>";
echo"<TD COLSPAN=5><img src=../lib/images/espaceur.png width=\"10\" height=\"15\">";
echo"</TD>";
echo"</TR>";
echo"<TR>";
echo"<TD><IMG SRC=../lib/images/espaceur.png WIDTH=10 HEIGHT=20></TD>";
echo"<TD COLSPAN=3><a href=\"../adminagis/liste_diffusion.php\"><IMG SRC=\"../images-index/listes_diff.gif\" WIDTH=\"130\" HEIGHT=\"20\" border=\"0\"></a></TD>";
echo"<TD><IMG SRC=../lib/images/espaceur.png WIDTH=10 HEIGHT=20></TD>";
echo"</TR>";

 ?>

<?php 
echo"<TR>";
echo"<TD COLSPAN=5><img src=../lib/images/espaceur.png width=\"10\" height=\"15\">";
echo"</TD>";
echo"</TR>";
echo"<TR>";
echo"<TD><IMG SRC=../lib/images/espaceur.png WIDTH=10 HEIGHT=20></TD>";
echo"<TD COLSPAN=3><a href=\"../adminagis/mod_diffusion.php\"><IMG SRC=\"../images-index/listes_diff2.gif\" WIDTH=\"130\" HEIGHT=\"20\" border=\"0\"></a></TD>";
echo"<TD><IMG SRC=../lib/images/espaceur.png WIDTH=10 HEIGHT=20></TD>";
echo"</TR>";
 ?>

<?php 
echo"<TR>";
echo"<TD COLSPAN=5><img src=../lib/images/espaceur.png width=\"10\" height=\"15\">";
echo"</TD>";
echo"</TR>";
echo"<TR>";
echo"<TD><IMG SRC=../lib/images/espaceur.png WIDTH=10 HEIGHT=20></TD>";
echo"<TD COLSPAN=3><a href=\"../adminagis/gestion_mots_inter.php\"><IMG SRC=\"../images-index/censure.gif\" WIDTH=130 HEIGHT=20 border=0></a></TD>";
echo"<TD><IMG SRC=../lib/images/espaceur.png WIDTH=10 HEIGHT=20></TD>";
echo"</TR>";
 ?>

  <TR>
    <TD COLSPAN=5> <IMG SRC="../lib/images/espaceur.gif" WIDTH=150 HEIGHT=15></TD>
  </TR>
  <TR>
    <TD> <IMG SRC="../lib/images/espaceur.gif" WIDTH=10 HEIGHT=20></TD>
    <TD COLSPAN=3><a href="../adminagis/gestion_newsd.php">
    <?php /* gestion de l'affichage des boutons en fonction du type */
$titi=DatabaseOperation::query("select newsdefil from salaries where id_user = $id_user");
$toto=mysql_fetch_array($titi);
if ($toto[newsdefil] != "non"){
echo "<IMG SRC=\"../images-index/newsdefil.gif\" WIDTH=130 HEIGHT=20 border=0>";
}
?>
    </a></TD>
    <TD> <IMG SRC="../lib/images/espaceur.gif" WIDTH=10 HEIGHT=20></TD>
  </TR>
  <TR>
    <TD COLSPAN=5> <IMG SRC="../lib/images/espaceur.gif" WIDTH=150 HEIGHT=14></TD>
  </TR>
  <TR>
    <TD> <IMG SRC="../lib/images/espaceur.gif" WIDTH=10 HEIGHT=20></TD>
    <TD COLSPAN=3><a href=../adminagis/modera1.php><img src="../images-index/moderation.gif" width="130" height="20" border=0></a></TD>
    <TD> <IMG SRC="../lib/images/espaceur.gif" WIDTH=10 HEIGHT=20></TD>
  </TR>
   <?php
/* on affiche le nombre d'articles a publier */
$tilt = DatabaseOperation::query("select distinct * from articles, publicateur, modes where publicateur.id_user = $id_user and publicateur.id_service = articles.id_art_serv and articles.date_modif=0 and modes.id_user=$id_user and modes.id_service=articles.id_art_serv and modes.serv_conf >= articles.nivo_conf");
$tilt2 = mysql_num_rows($tilt);
if ($tilt2 != ''){

echo "<TR>\n";
echo "    <TD WIDTH=\"150\" HEIGHT=\"15\" COLSPAN=\"5\"> <IMG SRC=../lib/images/espaceur.png></TD>\n";
echo "  </TR>\n";
echo "<TR>\n";
echo "    <TD WIDTH=\"10\" HEIGHT=\"20\"><img src=../lib/images/espaceur.png width=\"1\" height=\"1\">\n";
echo "    </TD>\n";
echo "    <TD COLSPAN=\"3\"><a href=\"../adminagis/article_publier.php\"><img src=\"../images-index/publication.gif\" width=\"130\" height=\"20\" border=0></a></TD>\n";
echo "    <TD WIDTH=\"11\" HEIGHT=\"20\"><img src=../lib/images/espaceur.png width=\"1\" height=\"1\">\n";
echo "    </TD>\n";
echo "  </TR>\n";
echo "  <TR>\n";
echo "    <TD WIDTH=\"10\">\n";
echo "      <div align=\"center\"><img src=../lib/images/espaceur.png width=\"1\" height=\"1\"></div>\n";
echo "    </TD>\n";
echo "    <TD COLSPAN=\"3\" HEIGHT=\"15\">\n";
echo "      <div align=\"center\">\n";
echo "        <p class=\"LOGINFFFFFFCENTRE\"><br>\n";

if ($tilt2 == 1){echo "Vous avez $tilt2 article à publier";}
else {echo "Vous avez $tilt2 articles à publier";}

echo"<br><br></p>\n";
echo"      </div>\n";
echo"    </TD>\n";
echo"    <TD WIDTH=\"11\">&nbsp;</TD>\n";
echo"  </TR>\n";
}
?>
<?php
/* on affiche le nombre d'articles a archiver */
$tilt = DatabaseOperation::query("select distinct * from articles, publicateur, modes where publicateur.id_user = $id_user and publicateur.id_service = articles.id_art_serv and articles.archive = 'oui' and modes.id_user=$id_user and modes.id_service=articles.id_art_serv and modes.serv_conf >= articles.nivo_conf");
$tilt2 = mysql_num_rows($tilt);

echo "<TR>\n";
echo "    <TD WIDTH=\"150\" HEIGHT=\"15\" COLSPAN=\"5\"> <IMG SRC=../lib/images/espaceur.png></TD>\n";
echo "  </TR>\n";
echo "<TR>\n";
echo "    <TD WIDTH=\"10\" HEIGHT=\"20\"><img src=../lib/images/espaceur.png width=\"1\" height=\"1\">\n";
echo "    </TD>\n";
echo "    <TD COLSPAN=\"3\"><a href=\"../adminagis/article_archiver.php\"><img src=\"../images-index/archivage.gif\" width=\"130\" height=\"20\" border=0></a></TD>\n";
echo "    <TD WIDTH=\"11\" HEIGHT=\"20\"><img src=../lib/images/espaceur.png width=\"1\" height=\"1\">\n";
echo "    </TD>\n";
echo "  </TR>\n";
echo "  <TR>\n";
echo "    <TD WIDTH=\"10\">\n";
echo "      <div align=\"center\"><img src=../lib/images/espaceur.png width=\"1\" height=\"1\"></div>\n";
echo "    </TD>\n";
echo "    <TD COLSPAN=\"3\" HEIGHT=\"15\">\n";
echo "      <div align=\"center\">\n";
echo "        <p class=\"LOGINFFFFFFCENTRE\"><br>\n";
if ($tilt2 != ''){
if ($tilt2 == 1){echo "Vous avez $tilt2 article à archiver";}
else {echo "Vous avez $tilt2 articles à archiver";}
}
echo"<br><br></p>\n";
echo"      </div>\n";
echo"    </TD>\n";
echo"    <TD WIDTH=\"11\">&nbsp;</TD>\n";
echo"  </TR>\n";

?>

<?php 
echo"<TR>";
echo"<TD COLSPAN=5><img src=../lib/images/espaceur.png width=\"10\" height=\"20\">";
echo"</TD>";
echo"</TR>";
echo"<TR>";
echo"<TD><IMG SRC=../lib/images/espaceur.png WIDTH=10 HEIGHT=20></TD>";
echo"<TD COLSPAN=\"3\"><a href=\"../adminagis/article_desarchiver.php\"><IMG SRC=\"../images-index/gerer_archives.gif\" WIDTH=\"130\" HEIGHT=\"20\" border=0></a></TD>";
echo"<TD><IMG SRC=../lib/images/espaceur.png WIDTH=10 HEIGHT=20></TD>";
echo"</TR>";
 ?>

  <?php 
echo"<TR>";
echo"<TD COLSPAN=5><img src=../lib/images/espaceur.png width=\"10\" height=\"27\">";
echo"</TD>";
echo"</TR>";
echo"<TD><IMG SRC=../lib/images/espaceur.png WIDTH=10 HEIGHT=20></TD>";
echo"<TD COLSPAN=3>";
echo"<a href=\"../adminagis/article_supprimer.php\"><IMG SRC=\"../images-index/gestion_supp.gif\" WIDTH=\"130\" HEIGHT=\"20\" border=0></a></TD>";
echo"<TD><IMG SRC=../lib/images/espaceur.png WIDTH=10 HEIGHT=20></TD>";
echo"</TR>";
?>
  <TR>
    <TD COLSPAN=5> <IMG SRC="../lib/images/espaceur.gif" WIDTH=150 HEIGHT=15></TD>
  </TR>
<?php
/*  <TR>
    <TD> <IMG SRC="../lib/images/espaceur.gif" WIDTH=10 HEIGHT=20></TD>
    <TD COLSPAN=3> <IMG SRC="../images-index/stat.gif" WIDTH=130 HEIGHT=20></TD>
    <TD> <IMG SRC="../lib/images/espaceur.gif" WIDTH=10 HEIGHT=20></TD>
  </TR>
*/
?>  <TR>
    <TD COLSPAN=5> <IMG SRC="../lib/images/espaceur.gif" WIDTH=150 HEIGHT=15></TD>
  </TR>
</TABLE>