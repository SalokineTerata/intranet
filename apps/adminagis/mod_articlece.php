<?php
  require ("../lib/session.php");
  include("../lib/functions.php");
  identification1("salaries", $login, $pass);
  securce($id_user, $id_type);
  include("functions.php");

  include("functions.js");

/* Par defaut, une personne ne peut traiter que les articles
   qu'elle a cree */


/* En parametres, recuperation du numéro de l'article en cours */

  if ($numartce != '')
  {
/* Recherche des elements de cet article */
    $req="select * from articlece where numartce=$numartce";
    $result=DatabaseOperation::query($req);
    if ($result != false)
    {
      $ancimgce=mysql_result($result, 0, imgce);
      $titrece=mysql_result($result, 0, titrece);
      $txtce=mysql_result($result, 0, txtce);
      $placeinfoce=mysql_result($result, 0, placeinfoce);
      $datecrea=mysql_result($result, 0, datecrea);
      $id_userce=mysql_result($result, 0, id_userce);
    }
  }
?>
<html>
<head>
<title>Cr&eacute;ation d'article</title>
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
<?php  include ("../news/cadrehautce.php"); ?>
<?php echo ("<form ENCTYPE=\"multipart/form-data\" method=\"post\" name=\"principal\" action=\"articlece.php\">\n");
   echo ("<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1000000\">");
?>
<table width="630" border="0" cellspacing="0" cellpadding="0" align="left" height="304">
  <tr>
    <td>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="90"><img src=../lib/images/bandeau_etape0.gif width="90" height="62"></td>
          <td width="512"><img src="../images_pop/saisie_articlece.gif" width="512" height="62"></td>
          <td width="28"><a href="../aide.php#admince" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="20">
          </td>
        </tr>
      </table>
      <img src=../lib/images/espaceur.gif width="10" height="40">
      <table width="630" border="0" cellspacing="0" cellpadding="0" class="loginFFCC66">
          <tr>
            <td width="150">Destination de l'article </td>
            <td width="550">
<?php
/* Liste deroulznte des C.E */
    echo ("<select name=\"numserce\">\n");
/* Constitution de la liste déroulante des noms */
    $req="select * from servicece order by descserce";
    $result=DatabaseOperation::query($req);
    if ($result!= false)
    {
      while ($row=mysql_fetch_row($result))
      {
        if ($numserce== $row[0])
          echo ("<option value=\"$row[0]\" selected>$row[1]</option>");
        else
          echo ("<option value=\"$row[0]\">$row[1]</option>");
      }
    }
    echo ("</select>\n");
?>
            </td>
          </tr>

        <tr>
          <td width="150">
            <div align="right">Position de l'article </div>
          </td>
          <td width="550">
<?php
    echo ("<select name=\"placeinfoce\">".makeSelectListChecked('agis', 'articlece','placeinfoce', $placeinfoce)."</select>");
?>
          </td>
        </tr>
        <tr>
          <td width="150">
            <div align="right">Insertion de l'image </div>
          </td>
            <td width="550">

              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="50%"><span class="loginFFCC66">(non obligatoire)
                    </span><br>
                    <input type="file" name="imgce">
                  </td>
                  <td width="50%">
                    <center>
<?php
  if ($ancimgce!='')
  {
/* Traitement de l'image avant affichage */
    $size = GetImageSize("../imgarticlece/$ancimgce");
    $ratio= $size[0] / $size[1];
    $ratio= 130 / $ratio;
    echo ("<img src=\"../imgarticlece/$ancimgce\" width=\"130\" height=\"$ratio\"> \n");
  }
  else
    echo ("&nbsp\n");
?>
                    </center>
                  </td>
                </tr>
              </table>
            </td>
        </tr>
        <tr>
          <td width="150">
            <div align="right">Titre de l'article </div>
          </td>
          <td width="550">
            <input type="text" name="titrece" size="50" maxlength="150"
<?php
  echo ("value=\"$titrece\"");
?>
            >
          </td>
        </tr>
        <tr>
          <td width="150">
            <div align="right">Texte </div>
          </td>
          <td width="550">
            <textarea name="txtce" rows="5" cols="50">
<?php
  echo ("$txtce");
?>
            </textarea>
          </td>
        </tr>
      </table>

      <img src=../lib/images/espaceur.gif width="10" height="40">
      <table width="273" border="0" cellspacing="5" cellpadding="0" align="center">
               <tr>
                 <td valign="top">
              <input type="image" src="../zimages/modifier.gif" width="130" height="20">
                 <INPUT TYPE="HIDDEN"  name="modifier" value="modifier">
<?php
  echo (" <INPUT TYPE=\"HIDDEN\"  name=\"numartce\" value=\"$numartce\">\n");
  echo (" <INPUT TYPE=\"HIDDEN\"  name=\"ancimgce\" value=\"$ancimgce\">\n");
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