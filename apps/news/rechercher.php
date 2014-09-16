<?php
include ("../lib/session.php");
require ("../lib/functions.php");
require ("functions.php");

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
<a name="haut"></a>
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
<link rel="stylesheet" href="../news1.css" type="text/css">

      <table width="620" border="0" cellspacing="10" cellpadding="0" align=right>
        <tr>
          <td class="txt">
<?php
if ($mots==""){
echo"Vous n'avez spécifié aucun critère de recherche.<br>Affichage de la liste complete des articles.";
}else{
echo"Liste des articles comportant  \"$mots\"";
}
?>
<br>

<br>
<img src="../images-index/articles_actif.gif">
<br>

<table width="90%" align=center>
  <tr>
   <td>
<div align=right><a href="#bas"><img src="../zimages/bas.gif" width="25" height="26" border="0" alt="aller en bas de page"></a>
</div>
   </td>
 </tr>
</table>
<?php
 $nbcar=3;
 $memoire=$mots;
 $mot = preg_split( "[ -/+\\*\'\"]", $mots);

/* NOMBRE D'ELEMENTS DU TABLEAU $mots */
$long = count ($mot);

// Pour chaque mot, on le mesure,
// si <=3 alors, on decale le
// tableau vers la gauche = efface
  $i=0;
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

echo"<table width=\"90%\" border=\"0\" cellpadding=\"0\" align=center>";
/* On parcourt le tableau de mot
  Requete de recherche*/
  $req="select distinct salaries.nom, salaries.prenom, articles.nivo_conf, articles.titre_art, articles.sujet, articles.num_article, articles.taille, articles.date_crea from articles , salaries";
  if ($id_user != ""){$req=$req.", modes ";}
  $i=0;
  $req=$req." where (articles.txt_1 like '%$mot[$i]%' or
  articles.txt_2 like '%$mot[$i]%' or
  articles.titre_art like '%$mot[$i]%' or
  articles.sujet like '%$mot[$i]%' or
  articles.auteur like '%$mot[$i]%' or
  salaries.nom like '%$mot[$i]%')";
  $i++;
  while ($i<$long)
  {
    $req=$req." $liaison (articles.txt_1 like '%$mot[$i]%' or
  articles.txt_2 like '%$mot[$i]%' or
  articles.titre_art like '%$mot[$i]%' or
  articles.sujet like '%$mot[$i]%' or
  articles.auteur like '%$mot[$i]%' or
  salaries.nom like '%$mot[$i]%')";;
    $i++;
  }
  if (!$id_user){
  $req=$req."  and (publica != '') and (salaries.id_user = articles.auteur) and (articles.nivo_conf = 1) order by articles.date_crea desc";
  }
  else{
  $req=$req."  and (publica != '') and (salaries.id_user = articles.auteur) and (articles.nivo_conf <= modes.serv_conf) and (articles.id_art_serv = modes.id_service) and (modes.id_user = $id_user) order by articles.date_crea desc";
  }
  $result = mysql_query ($req);
  $num = mysql_num_rows($result);
  if ($num != 0)
  {
    $i=0;
      echo"<tr>";
      echo"          <td width=\"75\">date</td>";
      echo"          <td width=\"90\">titre</td>";
      echo"          <td width=\"100\">auteur</td>";
      echo"          <td width=\"200\">sujet / article</td>";
      echo"          <td width=\"30\">conf</td>";
      echo"</tr>";
echo"</table>";
echo"<table width=\"90%\" border=\"1\" cellpadding=\"3\" align=center><tr>";
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
      $ouou="recherche";
      if($memoire!= ""){
      $titou=$memoire;}
      taille2($taille,$numa,$titou,$ouou);
      echo "<br>détail de l'article</a></td>";
      echo"          <td class=\"txttabl\" width=\"20\" bgcolor=\"#FFFFCC\">$conf</td>";
      echo "</tr>";
      $i++;
     }
  }

 echo "<tr><td colspan=5 align=right><a href=\"#bas\"><img src=\"../zimages/bas.gif\" width=\"25\" height=\"26\" border=\"0\" alt=\"aller en bas de page\"></a><a href=\"#haut\"><img src=\"../zimages/haut.gif\" width=\"25\" height=\"26\" border=\"0\" alt=\"aller en haut de page\"></a></td></tr>";
 echo (" </table><br><br> \n");
?>

<img src="../images-index/articles_archiv.gif">

<?php
echo"<table width=\"90%\" border=\"0\" cellpadding=\"0\" align=center>";
/* On parcourt le tableau de mot
  Requete de recherche*/
  $req="select distinct salaries.nom, salaries.prenom, archives.nivo_conf, archives.titre_art, archives.sujet, archives.num_article, archives.taille, archives.date_crea from archives , salaries";
  if ($id_user != ""){$req=$req.", modes ";}
  $i=0;
  $req=$req." where (archives.txt_1 like '%$mot[$i]%' or
  archives.txt_2 like '%$mot[$i]%' or
  archives.titre_art like '%$mot[$i]%' or
  archives.sujet like '%$mot[$i]%' or
  archives.auteur like '%$mot[$i]%' or
  salaries.nom like '%$mot[$i]%')";
  $i++;
  while ($i<$long)
  {
    $req=$req." $liaison (archives.txt_1 like '%$mot[$i]%' or
  archives.txt_2 like '%$mot[$i]%' or
  archives.titre_art like '%$mot[$i]%' or
  archives.sujet like '%$mot[$i]%' or
  archives.auteur like '%$mot[$i]%' or
  salaries.nom like '%$mot[$i]%')";;
    $i++;
  }
  if (!$id_user){
  $req=$req."  and (publica != '') and (salaries.id_user = archives.auteur) and (archives.nivo_conf = 1) order by archives.date_crea desc";
  }
  else{
  $req=$req."  and (publica != '') and (salaries.id_user = archives.auteur) and (archives.nivo_conf <= modes.serv_conf) and (archives.id_art_serv = modes.id_service) and (modes.id_user = $id_user) order by archives.date_crea desc";
  }
  $result = mysql_query ($req);
  $num = mysql_num_rows($result);
  if ($num != 0)
  {
    $i=0;
      echo"<tr>";
      echo"          <td width=\"75\">date</td>";
      echo"          <td width=\"90\">titre</td>";
      echo"          <td width=\"100\">auteur</td>";
      echo"          <td width=\"200\">sujet / article</td>";
      echo"          <td width=\"30\">conf</td>";
      echo"</tr>";
echo"</table>";
echo"<table width=\"90%\" border=\"1\" cellpadding=\"3\" align=center><tr>";
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

      taille3($taille,$numa,$titou,$ouou);
      echo "<br>détail de l'article</a></td>";
      echo"          <td class=\"txttabl\" width=\"20\" bgcolor=\"#FFFFCC\">$conf</td>";
      echo "</tr>";
      $i++;
     }
  }

  echo "<tr><td colspan=5 align=right><a href=\"#haut\"><img src=\"../zimages/haut.gif\" width=\"25\" height=\"26\" border=\"0\" alt=\"aller en haut de page\"></a></td></tr>";
  echo " </table><br><br> \n";
?>



          </td>
        </tr>
      </table>
    </td>
  <td width="12" height="551">&nbsp;</td>
  </tr>
</table>
<a name="bas"></a>
</body>