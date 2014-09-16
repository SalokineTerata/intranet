<?php
include ("../lib/session.php");
require ("../lib/functions.php");
require ("functions.php");

$intitulemois=array("","Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");

?>
<html>
<head>
<title>Intranet Agis</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

//-->
</script>
<script language="JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function Popup(page,options) {
  document.location.href="../index.php?action=delog" ;
}

function StartTimer(delai) {
  // Déclenche le timer à la fin du chargement de la page (delai est en secondes)
  setTimeout("Popup()",delai*1000);
}
//-->
</script>
<link rel="stylesheet" href="../lib/css/intra01.css" type="text/css">
<script language="JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
// -->
</script>

</head>

<body <?php if($id_user!= ""){$time=timeout($id_user); echo "onLoad=\"StartTimer($time)\"";} ?>;MM_preloadImages('../images-index/entreprise_o_o.gif')" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<link rel="stylesheet" href="../news1.css" type="text/css">
<table width="780" border="0" cellspacing="0" cellpadding="0" height="502">
  <tr>
    <td width="157" bgcolor="#FFcc66" height="551" valign="top">
      <?php include("../inc/connexion.php"); ?>
      <?php include("../inc/navigue.php"); ?>
      <?php include("../inc/rechercher.php");?>
      </td>
    <td width="569" valign="top" height="551">
      <table cellspacing="0" border="0" cellpadding="0">
        <tr>
              <td width="125" height="48" valign="top" border="0" class="logFFCC66"><a href="../news/entreprise.php?service=1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav011','','../images-index/entreprise_o_o.gif',1)"><img name="nav011" border="0" src="../images-index/entreprise.gif" width="125" height="60" align="bottom"></a>
          </td>
          <td width="125" height="48"  valign="top" border="0" bgcolor="#FFCC66"><a href="../news/neutre.php?service=1_1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav021','','../images-index/production_o_o.gif',1)"><img name="nav021" border="0" src="../images-index/production.gif" width="125" height="60"></a>
          </td>
          <td width="125" height="48"  valign="top" border="0" bgcolor="#FFCC66"><a href="../news/neutre.php?service=2_1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav031','','../images-index/developpement_o_o.gif',1)"><img name="nav031" border="0" src="../images-index/developpement.gif" width="125" height="60"></a>
          </td>
          <td width="125" height="48"  valign="top" border="0" bgcolor="#FFCC66"><a href="../news/neutre.php?service=3_1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav041','','../images-index/general_o_o.gif',1)"><img name="nav041" border="0" src="../images-index/general.gif" width="125" height="60"></a>
          </td>
          <td width="125" height="48"  valign="top" border="0" bgcolor="#FFCC66"><a href="news/neutre.php?service=4_1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav051','','../images-index/commercial_o_o.gif',1)"><img name="nav051" border="0" src="../images-index/commercial.gif" width="125" height="60"></a>
          </td>
  </tr>
  </table>

<a name="haut"></a>
      <table width="100%" border="0" cellspacing="6" cellpadding="0">
        <tr>
          <td>


<form action="recherchefine.php" method=post>
<FIELDSET>
<LEGEND ALIGN="top">Recherche fine</LEGEND>
<input type="hidden" name="action" value="cherche">
  <table width="613" border="0" cellspacing="5" cellpadding="0" align="center">
    <tr>
                  <td width="155" class="loginFFFFFF">Groupe</td>
                  <td width="27">&nbsp;</td>
                  <td width="180" class="loginFFFFFF">Sujet</td>
                  <td width="260" class="loginFFFFFF">Date création</td>
    </tr>
    <tr>
                  <td width="155">
                    <select name="groupes" class="loginFFFFFF">
          <option value="non" selected>GROUPES</option>
<?php
$requete=DatabaseOperation::query("select * from groupes");
while ($rows= mysql_fetch_array($requete)){
echo "<option value=\"$rows[id_groupe]\"";
if ($groupes==$rows[id_groupe]){echo"selected";}
echo">$rows[intitule_gr]</option>";
}
?>
        </select>
      </td>
                  <td width="27">&nbsp; </td>
                  <td width="187">
                    <input type="text" name="mots" size="20" class="loginFFFFFF" value=".$mots.">
      </td>
                  <td width="260" class="loginFFFFFF">Après le </td>
    </tr>
    <tr>
                  <td width="155" class="loginFFFFFF">Service</td>
                  <td width="27">&nbsp;</td>
                  <td width="187">&nbsp;</td>
                  <td width="260">
                    <select name="jour1" class="loginFFFFFF">
         <option value="non">Jour</option>
<?php
$jour1b=1;
while ($jour1b<=31){
echo"          <option value=\"$jour1b\"";
  if ($jour1==$jour1b){
echo"selected";
  }
echo" >";
if ($jour1b<10){
echo"0";
}
echo"$jour1b</option>";
$jour1b++;
}
?>
        </select>
        <select name="mois1" class="loginFFFFFF">
        <option value="non">Mois</option>
<?php
$mois1b=1;
while ($mois1b<=12){
echo"          <option value=\"$mois1b\"";

  if ($mois1==$mois1b){ echo"selected"; }

echo">";
echo"$intitulemois[$mois1b]</option>";
$mois1b++;
}
?>
        </select>
        <select name="annee1" class="loginFFFFFF">
        <option value="non">Année</option>
<?php
$annee1b=2001;
while ($annee1b<=2020){
echo"          <option value=\"$annee1b\"";
  if ($annee1==$annee1b){
echo"selected";
  }
echo" >";
echo"$annee1b</option>";
$annee1b++;
}
?>
        </select>
      </td>
    </tr>
    <tr>
                  <td width="155">
                    <select name="services" class="loginFFFFFF">
          <option value="non" selected>SERVICES</option>
          <?php
$requete=DatabaseOperation::query("select * from services");
while ($rows= mysql_fetch_array($requete)){
echo "<option value=\"$rows[id_service]\"";
if ($services==$rows[id_service]){echo"selected";}
echo ">$rows[intitule_ser]</option>";
}
?>
        </select>
      </td>
                  <td width="27">&nbsp;</td>
                  <td width="187">&nbsp;</td>
                  <td width="260" class="loginFFFFFF">Avant le</td>
    </tr>
    <tr>
                  <td width="155" class="loginFFFFFF">Auteur</td>
                  <td width="27">&nbsp;</td>
                  <td width="187">&nbsp; </td>
                  <td width="260">
                    <select name="jour2" class="loginFFFFFF">
        <option value="non">Jour</option>
<?php
$jour2b=1;
while ($jour2b<=31){
echo"          <option value=\"$jour2b\"";
  if ($jour2==$jour2b){
echo"selected";
  }
echo" >";
if ($jour2b<10){
echo"0";
}
echo"$jour2b</option>";
$jour2b++;
}
?>

        </select>
        <select name="mois2" class="loginFFFFFF">
        <option value="non">Mois</option>
<?php
$mois2b=1;
while ($mois2b<=12){
echo"          <option value=\"$mois2b\"";

  if ($mois2==$mois2b){ echo"selected"; }

echo">";
echo"$intitulemois[$mois2b]</option>";
$mois2b++;
}
?>
        </select>
        <select name="annee2" class="loginFFFFFF">
        <option value="non">Année</option>
<?php
$annee2b=2001;
while ($annee2b<=2020){
echo"          <option value=\"$annee2b\"";
  if ($annee2==$annee2b){
echo"selected";
  }
echo" >";
echo"$annee2b</option>";
$annee2b++;
}
?>
        </select>
      </td>
    </tr>
    <tr>
                  <td width="155">
                    <select name="auteurs" class="loginFFFFFF">
          <option value="non" selected>AUTEURS</option>
<?php
$requete=DatabaseOperation::query("select distinct id_user, salaries.nom, salaries.prenom from articles, salaries where salaries.id_user=articles.auteur order by nom");
while ($rows= mysql_fetch_array($requete)){
//if ($rows[nom] != $unique){
echo "<option value=\"$rows[id_user]\"";
if ($auteurs==$rows[id_user]){echo"selected";}
echo">$rows[nom] $rows[prenom]</option>";
//$unique = $rows[nom];
//}
}
?>
        </select>
      </td>
                  <td width="27">&nbsp;</td>
                  <td width="187">
                    <div align="left">
                      <input type="submit" name="Submit" value="Rechercher" class="loginFFFFFF">
                    </div>
                  </td>
                  <td width="236">
                    <input type="checkbox" name="actifs" value="oui"
<?php
if ($action!="cherche"){ echo"checked"; }
if(($actifs=="oui") and ($action=="cherche")){ echo"checked"; }
?>
                    >
                    <span class="loginFFFFFF">actifs
                    <input type="checkbox" name="archives" value="oui"

<?php
if ($action!="cherche"){ echo"checked"; }
if (($archives=="oui") and ($action=="cherche")){ echo"checked"; } ?>
                    >
                    <span class="loginFFFFFF">archiv&eacute;s</span></span></td>
    </tr>
  </table>
  <div align="center"></div>
</fieldset>
</form>
<center>
  <br>


<?php
if ($action=="cherche"){


 $nbcar=3;
 $mot = preg_split( "[ -/+\\*\'\"]", $mots);

/* NOMBRE D'ELEMENTS DU TABLEAU $mots */
$long = count ($mot);

// Pour chaque mot, on le mesure,
// si <=3 alors, on decale le
// tableau vers la gauche = efface



  while ($i<$long)
  {
    // On mesure la longueur de la chaine
    $longcase= strlen ($mot[$i]);
    if ($longcase <=$nbcar)
    {
      // On efface le mot, on decale le tableau vers la gauche
      $j=$i;
      while ($j<=$long)
      {
        if ($j==$long)
        {  // C la derniere case du tableau
          $mots[$j]=null;
        }
        else
        {
          $mot[$j]=$mot[$j+1];
        }
        $j++;
      }
      $long--;
    }
    else
      $i++;
  }


/*****************************************************/
/* Recherche
/*****************************************************/
if($actifs=="oui"){


echo"<div align=\"left\"><img src=\"../images-index/articles_actif.gif\"> </div>";

echo"<div align=right><a href=\"#bas\"><img src=\"../zimages/bas.gif\" width=\"25\" height=\"26\" border=\"0\" alt=\"aller en bas de page\"></a>\n";
echo"</div>\n";

echo"<table width=\"100%\" border=\"0\" cellspacing=0 cellpadding=\"0\"><tr>";
/* On parcourt le tableau de mot
  Requete de recherche*/
  $req="select distinct salaries.nom, salaries.prenom, articles.nivo_conf, articles.titre_art, articles.sujet, articles.num_article, articles.taille, articles.date_crea from articles , salaries";
  if ($id_user != ""){$req=$req.", modes ";}
  $i=0;

  $i=0;


  $req=$req." where (articles.txt_1 like '%$mot[$i]%' or
  articles.txt_2 like '%$mot[$i]%' or
  articles.titre_art like '%$mot[$i]%' or
  articles.sujet like '%$mot[$i]%')";
  $i++;
  while ($i<$long)
  {
    $req=$req." $liaison (articles.txt_1 like '%$mot[$i]%' or
  articles.txt_2 like '%$mot[$i]%' or
  articles.titre_art like '%$mot[$i]%' or
  articles.sujet like '%$mot[$i]%')";
    $i++;
  }

/*formatages des deux dates avant et apres*/

$date1 = $annee1;
$date1 .="-";
$date1 .=$mois1;
$date1 .="-";
$date1 .=$jour1;

$date2 = $annee2;
$date2 .="-";
$date2 .=$mois2;
$date2 .="-";
$date2 .=$jour2;

/*criteres du moteurs de recherche en fonction des champs choisis */
  if ($date1 != 'non-non-non'){ $req .= " and (articles.date_crea >= '$date1')";}
  if ($date2 != 'non-non-non'){ $req .= " and (articles.date_crea <= '$date2')";}
  if ($auteurs != 'non'){ $req .= " and (articles.auteur = '$auteurs')";}
  if ($groupes != 'non'){ $req .= " and (articles.id_art_group = '$groupes')";}
  if ($services != 'non'){ $req .= " and (articles.id_art_serv = '$services')";}

  if (!$id_user){
  $req=$req."  and (publica != '') and (salaries.id_user = articles.auteur) and (articles.nivo_conf = 1) order by articles.date_crea desc";
  }
  else{
  $req=$req."  and (publica != '') and (salaries.id_user = articles.auteur) and (articles.nivo_conf <= modes.serv_conf) and (articles.id_art_serv = modes.id_service) and (modes.id_user = $id_user) order by articles.date_crea desc";
  }
  $result = mysql_query ($req);
  $num = mysql_num_rows($result);

  $comptres1=$num;

echo"<tr><td colspan=5 class=\"loginFFFFFF\">$comptres1 articles actifs correspondent à votre recherche<br><br></td></tr>";
      echo"<tr>";
      echo"          <td width=\"75\">date</td>";
      echo"          <td width=\"90\">titre</td>";
      echo"          <td width=\"100\">auteur</td>";
      echo"          <td width=\"200\">sujet / article</td>";
      echo"          <td width=\"30\">conf</td>";
      echo"</tr>";
echo"</table>";
echo"<table width=\"100%\" border=\"1\" cellspacing=0 cellpadding=\"3\"><tr>";

  if ($num != 0)
  {
    $i=0;
    while ($i<$num)
    {
      $auteur = mysql_result($result, $i, nom);
      $auteur2 = mysql_result($result, $i, prenom);
      $titre = mysql_result($result, $i, titre_art);
      $sujet= mysql_result($result, $i, sujet);
      $numa= mysql_result($result, $i, num_article);
      $taille= mysql_result($result, $i, taille);
      $date= mysql_result($result, $i, date_crea);
      $conf= mysql_result($result, $i, nivo_conf);
      echo "<tr bgcolor=\"#FF3333\" class=\"logFFCC66\">";

$jour = substr($date, 8, 2);
$mois = substr($date, 5, 2);
$annee = substr($date, 0, 4);
$date= $jour."/".$mois."/".$annee;

$titre=stripslashes($titre);
$sujet=stripslashes($sujet);

      echo"          <td class=\"txttabl\" width=\"20\" bgcolor=\"#FFFFCC\">$date</td>";
      echo"          <td class=\"txttabl\" width=\"80\" bgcolor=\"#FFFFCC\">&nbsp;$titre</td>";
      echo"          <td class=\"txttabl\" width=\"90\" bgcolor=\"#FFFFCC\">$auteur $auteur2</td>";
      echo"          <td class=\"txttabl\" width=\"200\" bgcolor=\"#FFFFCC\">&nbsp;$sujet";
      $ouou="recherchefine";
      taille2($taille,$numa,"",$ouou);
      echo "<br>détail de l'article</a></td>";
      echo"          <td class=\"txttabl\" width=\"20\" bgcolor=\"#FFFFCC\">$conf</td>";
      echo "</tr>";
      $i++;
     }
  }
  echo "<tr><td colspan=5 align=right><a href=\"#bas\"><img src=\"../zimages/bas.gif\" width=\"25\" height=\"26\" border=\"0\" alt=\"aller en bas de page\"></a><a href=\"#haut\"><img src=\"../zimages/haut.gif\" width=\"25\" height=\"26\" border=\"0\" alt=\"aller en haut de page\"></a></td></tr>";
  echo (" </table><br> \n");
?>

<?php } ?>
<?php if($archives=="oui"){ ?>

<div align="left"><img src="../images-index/articles_archiv.gif"></div>

<?php
echo"<table width=\"100%\" border=\"0\" cellspacing=0 cellpadding=\"0\"><tr>";
/* On parcourt le tableau de mot
  Requete de recherche*/
  $req="select distinct salaries.nom, salaries.prenom, archives.nivo_conf, archives.titre_art, archives.sujet, archives.num_article, archives.taille, archives.date_crea from archives , salaries";
  if ($id_user != ""){$req=$req.", modes ";}
  $i=0;



  $req=$req." where (archives.txt_1 like '%$mot[$i]%' or
  archives.txt_2 like '%$mot[$i]%' or
  archives.titre_art like '%$mot[$i]%' or
  archives.sujet like '%$mot[$i]%')";
  $i++;
  while ($i<$long)
  {
    $req=$req." $liaison (archives.txt_1 like '%$mot[$i]%' or
  archives.txt_2 like '%$mot[$i]%' or
  archives.titre_art like '%$mot[$i]%' or
  archives.sujet like '%$mot[$i]%')";
    $i++;
  }

/*formatages des deux dates avant et apres*/

$date1 = $annee1;
$date1 .="-";
$date1 .=$mois1;
$date1 .="-";
$date1 .=$jour1;

$date2 = $annee2;
$date2 .="-";
$date2 .=$mois2;
$date2 .="-";
$date2 .=$jour2;

/*criteres du moteurs de recherche en fonction des champs choisis */
  if ($date1 != 'non-non-non'){ $req .= " and (archives.date_crea >= '$date1')";}
  if ($date2 != 'non-non-non'){ $req .= " and (archives.date_crea <= '$date2')";}
  if ($auteurs != "non"){ $req .= " and (archives.auteur = '$auteurs')";}
  if ($groupes != "non"){ $req .= " and (archives.id_art_group = '$groupes')";}
  if ($services != "non"){ $req .= " and (archives.id_art_serv = '$services')";}
if (!$id_user){
  $req=$req."  and (publica != '') and (salaries.id_user = archives.auteur) and (archives.nivo_conf = 1) order by archives.date_crea desc";
  }
  else{
  $req=$req."  and (publica != '') and (salaries.id_user = archives.auteur) and (archives.nivo_conf <= modes.serv_conf) and (archives.id_art_serv = modes.id_service) and (modes.id_user = $id_user) order by archives.date_crea desc";
  }
  $result = mysql_query ($req);
  $num = mysql_num_rows($result);

  $comptres2=$num;

echo"<tr><td colspan=5 class=\"loginFFFFFF\">$comptres2 articles archivés correspondent à votre recherche<br><br></td></tr>";
      echo"<tr>";
      echo"          <td width=\"75\">date</td>";
      echo"          <td width=\"90\">titre</td>";
      echo"          <td width=\"100\">auteur</td>";
      echo"          <td width=\"200\">sujet / article</td>";
      echo"          <td width=\"30\">conf</td>";
      echo"</tr>";
echo"</table>";
echo"<table width=\"100%\" border=\"1\" cellspacing=0 cellpadding=\"3\"><tr>";

  if ($num != 0)
  {
    $i=0;
    while ($i<$num)
    {
      $auteur = mysql_result($result, $i, nom);
      $auteur2 = mysql_result($result, $i, prenom);
      $titre = mysql_result($result, $i, titre_art);
      $sujet= mysql_result($result, $i, sujet);
      $numa= mysql_result($result, $i, num_article);
      $taille= mysql_result($result, $i, taille);
      $date= mysql_result($result, $i, date_crea);
      $conf= mysql_result($result, $i, nivo_conf);



      echo "<tr bgcolor=\"#FF3333\" class=\"logFFCC66\">";

$jour = substr($date, 8, 2);
$mois = substr($date, 5, 2);
$annee = substr($date, 0, 4);
$date= $jour."/".$mois."/".$annee;

$titre=stripslashes($titre);
$sujet=stripslashes($sujet);

      echo"          <td class=\"txttabl\" width=\"20\" bgcolor=\"#FFFFCC\">$date</td>";
      echo"          <td class=\"txttabl\" width=\"80\" bgcolor=\"#FFFFCC\">&nbsp;$titre</td>";
      echo"          <td class=\"txttabl\" width=\"90\" bgcolor=\"#FFFFCC\">$auteur $auteur2</td>";
      echo"          <td class=\"txttabl\" width=\"200\" bgcolor=\"#FFFFCC\">&nbsp;$sujet";

      taille3($taille,$numa,"",$ouou);
      echo "<br>détail de l'article</a></td>";
      echo"          <td class=\"txttabl\" width=\"20\" bgcolor=\"#FFFFCC\">$conf</td>";
      echo "</tr>";
      $i++;
     }
  }

echo "<tr><td colspan=5 align=right><a href=\"#haut\"><img src=\"../zimages/haut.gif\" width=\"25\" height=\"26\" border=\"0\" alt=\"aller en haut de page\"></a></td></tr>";
echo (" </table><br><br> \n");
}
?>
<?php } ?>
          </td>
        </tr>
      </table>
    </td>
  <td width="12" height="551">&nbsp;</td>
  </tr>
</table>
<a name="bas"></a>
<p></p>
<p>&nbsp;</p>


</body>