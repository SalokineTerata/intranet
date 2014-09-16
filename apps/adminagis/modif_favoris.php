<?php
//include ("../lib/session.php");
//require ("../lib/functions.php");
      require_once '../inc/main.php';
      
//require ("../news/functions.php");
include ('../acces_internet/functions.php');


if ($action == "modif") {
if ($newpass != ""){
DatabaseOperation::query("update salaries set pass = '$newpass' where (id_user='$id_user')");
$pass = $newpass;
//$fp = `cp test.txt test.cp`;

//Synchronisation des logins
squid_login_sync();



//echo $exec;
//session_register( "pass" );
$_SESSION["pass"]=$pass;
}

$favoris1=webttp($favoris1);
$favoris2=webttp($favoris2);
$favoris3=webttp($favoris3);
$favoris4=webttp($favoris4);
$favoris5=webttp($favoris5);
$favoris6=webttp($favoris6);

$existe = DatabaseOperation::query("select * from perso where id_user='$id_user'");
$nb1 = mysql_num_rows($existe);
if (!$timeout){$timeout=15;}
if (!$nbligne){$nbligne=3;}
if (!$nb1){
DatabaseOperation::query("INSERT INTO perso(id_user ,web1 ,label1 ,web2 ,label2 ,web3 ,label3 ,web4 ,label4 ,web5 ,label5 ,web6, label6, lu, date, timeout, mailing, nbligne) VALUES ('$id_user','$favoris1','$label1','$favoris2','$label2','$favoris3','$label3','$favoris4','$label4','$favoris5','$label5','$favoris6','$label6','$visalu','$order','$timeout','$mailcom','$nbligne')");
}else{
DatabaseOperation::query("update perso set web1 = '$favoris1', label1 = '$label1', web2 = '$favoris2', label2 = '$label2', web3 = '$favoris3', label3 = '$label3', web4 = '$favoris4', label4 = '$label4', web5 = '$favoris5', label5 = '$label5', web6 = '$favoris6', label6 = '$label6', lu = '$visalu', date = '$order' ,timeout = '$timeout', mailing='$mailcom', nbligne='$nbligne'  where (id_user='$id_user')");
}
}
$affichage = DatabaseOperation::query("select * from perso where id_user='$id_user'");
$rows = mysql_fetch_array($affichage);
?>
<html>
<head>
<title>Modification des param&egrave;tres personnels</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../lib/css/intra01.css" type="text/css">
<script language="JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>

<script language="JavaScript">
<!--
function Popup(page,options) {
  window.close() ;
}

function StartTimer(delai) {
  // Déclenche le timer à la fin du chargement de la page (delai est en secondes)
  setTimeout("Popup()",delai*1000);
}
//-->
</script>
</head>

<body <?php if ($action == "modif"){echo"onLoad=\"window.close()\"";}  ?> onLoad="StartTimer(<?php $time=timeout($id_user); echo "$time"; ?>)" bgcolor="#FFCC66" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="480" border="0" cellspacing="0" cellpadding="0" align="center" height="100%">
  <tr> 
    <td align="center" valign="top"> 
      <form action="modif_favoris.php?action=modif" method=post>
        <div align="center"><span class="loginFFCC66">------------------- PARAMETRES 
          -------------------</span>
          <input type="hidden" value="modif" name="action">
          <table width="450" border="0" cellspacing="8" cellpadding="0" align="center">
            <tr> 
              <td> 
                <span class="loginFFCC66">Timer de d&eacute;connexion 
                  session</span>
              </td>
              <td> 
                <div align="left" class="loginFFCC66"> 
                  <input type="text" name="timeout" size="4" value=<?php if(!$rows[timeout]){echo "15";}else{echo"$rows[timeout]";} ?>>
                  (en minutes)</div>
              </td>
            </tr>
            <tr> 
              <td> 
                <div align="right" class="loginFFCC66">Changer votre mot de passe</div>
              </td>
              <td> 
                <div align="left" class="loginFFCC66"> 
                  <input type="password" name="newpass" size="15">
                </div>
              </td>
            </tr>
            <tr> 
              <td> 
                <div align="right" class="loginFFCC66">Nombre de lignes de news 
                  &agrave; afficher </div>
              </td>
              <td> 
                <div align="left" class="loginFFCC66"> 
                  <input type="text" name="nbligne" size="4" value=<?php if(!$rows[nbligne]){echo "3";}else{echo"$rows[nbligne]";} ?>>
                </div>
              </td>
            </tr>
            <tr> 
              <td  class="loginFFCC66" height="2">&nbsp;</td>
              <td  class="loginFFCC66" height="2">&nbsp;</td>
            </tr>
            <tr> 
              <td  class="loginFFCC66">Affichage des articles d&eacute;j&agrave; 
                lus</td>
              <td class="loginFFCC66"> 
                <input type="radio" name="visalu" value="1" <?php if($rows[lu]==1){echo"checked";} ?>>
                oui 
                <input type="radio" name="visalu" value="2" <?php if(!$rows[lu]){echo"checked";} if($rows[lu]==2){echo"checked";} ?>>
                non </td>
            </tr>
            <tr> 
              <td> 
                <div align="right" class="loginFFCC66">Notification mail pour 
                  vos commentaires </div>
              </td>
              <td class="loginFFCC66"> 
                <input type="radio" name="mailcom" value="1" <?php if($rows[mailing]==1){echo"checked";} ?>>
                oui 
                <input type="radio" name="mailcom" value="2" <?php if(!$rows[mailing]){echo"checked";}  if($rows[mailing]==2){echo"checked";} ?>>
                non </td>
            </tr>
            <tr> 
              <td> 
                <div align="right" class="loginFFCC66">Tri de l'affichage des 
                  articles par date</div>
              </td>
              <td class="loginFFCC66"> 
                <input type="radio" name="order" value="1" <?php if($rows[date]==1){echo"checked";} ?>>
                croissant 
                <input type="radio" name="order" value="2" <?php if(!$rows[date]){echo"checked";}  if($rows[date]==2){echo"checked";} ?>>
                d&eacute;croissant</td>
            </tr>
          </table>
          <br>
          <table width="450" border="0" cellspacing="4" cellpadding="0" align="center">
            <tr> 
              <td width="8">&nbsp;</td>
              <td width="185" class="loginFFCC66" align="center" valign="middle">Titre 
              </td>
              <td width="319" class="loginFFCC66">Adresse compl&egrave;te</td>
            </tr>
            <tr> 
              <td align="right" class="loginFFCC66" width="8">1</td>
              <td width="185" class="loginFFFFFF"> 
                <input type="text" name="label1" size="25" class="loginFFFFFF" value="<?php echo"$rows[label1]"; ?>">
              </td>
              <td width="319"> 
                <input type="text" name="favoris1" size="44" class="loginFFFFFF" value="<?php echo"$rows[web1]"; ?>">
              </td>
            </tr>
            <tr> 
              <td align="right" class="loginFFCC66" width="8">2</td>
              <td width="185" class="loginFFFFFF"> 
                <input type="text" name="label2" size="25" class="loginFFFFFF" value="<?php echo"$rows[label2]"; ?>">
              </td>
              <td width="319"> 
                <input type="text" name="favoris2" size="44" class="loginFFFFFF" value="<?php echo"$rows[web2]"; ?>">
              </td>
            </tr>
            <tr> 
              <td align="right" class="loginFFCC66" width="8">3</td>
              <td width="185" class="loginFFFFFF"> 
                <input type="text" name="label3" size="25" class="loginFFFFFF" value="<?php echo"$rows[label3]"; ?>">
              </td>
              <td width="319"> 
                <input type="text" name="favoris3" size="44" class="loginFFFFFF" value="<?php echo"$rows[web3]"; ?>">
              </td>
            </tr>
            <tr> 
              <td align="right" class="loginFFCC66" width="8">4</td>
              <td width="185" class="loginFFFFFF"> 
                <input type="text" name="label4" size="25" class="loginFFFFFF" value="<?php echo"$rows[label4]"; ?>">
              </td>
              <td width="319"> 
                <input type="text" name="favoris4" size="44" class="loginFFFFFF" value="<?php echo"$rows[web4]"; ?>">
              </td>
            </tr>
            <tr> 
              <td align="right" class="loginFFCC66" width="8">5</td>
              <td width="185" class="loginFFFFFF"> 
                <input type="text" name="label5" size="25" class="loginFFFFFF" value="<?php echo"$rows[label5]"; ?>">
              </td>
              <td width="319"> 
                <input type="text" name="favoris5" size="44" class="loginFFFFFF" value="<?php echo"$rows[web5]"; ?>">
              </td>
            </tr>
            <tr> 
              <td align="right" class="loginFFCC66" width="8">6</td>
              <td width="185" class="loginFFFFFF"> 
                <input type="text" name="label6" size="25" class="loginFFFFFF" value="<?php echo"$rows[label6]"; ?>">
              </td>
              <td width="319"> 
                <input type="text" name="favoris6" size="44" class="loginFFFFFF" value="<?php echo"$rows[web6]"; ?>">
              </td>
            </tr>
            <tr> 
              <td width="8" class="loginFFCC66">&nbsp;</td>
              <td colspan="2" class="loginFFCC66">&nbsp;</td>
            </tr>
            <tr> 
              <td colspan="3" class="loginFFCC66"> 
                <div align=center>Attention : Ces modifications seront prisent 
                  en compte lors de votre<br>
                  prochaine action de navigation (ou tapez F5) </div>
                <br>
                <table width="400" border="0" cellspacing="4" cellpadding="0">
                  <tr> 
                    <td> 
                      <div align="center"> 
                        <input type=image src="../zimages/valider-j.gif" border=0 name="Submit" alt="Valider et enregistrer vos modifications et fermer la fen&ecirc;tre">
                      </div>
                    </td>
                    <td></td>
                    <td align="center"><a href="javascript:;" onClick="window.close()"><img src="../zimages/annuler-j.gif" width="130" height="20" border="0" alt="Fermer la fen&ecirc;tre sans enregistrer vos modifications"></a></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </div>
      </form>
    </td>
  </tr>
</table>

</body>
</html>