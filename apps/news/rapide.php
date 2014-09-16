<?php
//include ("../lib/securite.php");
require_once ("../inc/main.php");
//require_once ("../lib/session.php");

//echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf8\">";
//header('Content-type: text/html; charset=utf-8');
//header('Content-type: text/html; charset=iso-8859-1');

$action = Lib::isDefined("action");
$id_user = Lib::isDefined("id_user");
$service = Lib::isDefined("service");
$compte = Lib::isDefined("compte");
$nva = Lib::isDefined("nva");


if ($action == "vitelu")
{
    $existe = DatabaseOperation::query("select * from lu where ((id_art='$ids[$i]') and (id_user='$id_user'))");
    $nb1 = mysql_numrows($existe);
    if (!$nb1)
    {
        for ($i=0;$i<count($ids);$i++)
        {
            if(isset(${$ids[$i]}))
            {
                DatabaseOperation::query("INSERT INTO lu(id_art ,id_user, date) VALUES ('$ids[$i]','$id_user', NOW())");
            }
        }
    }
    else
    {
        for ($i=0;$i<count($ids);$i++)
        {
            if(isset(${$ids[$i]}))
            {
                DatabaseOperation::query("update lu set date = now() where ((id_art='$ids[$i]') and (id_user='$id_user'))");
            }
        }
    }
}

?>
<html>
<head>
<title>Nouveaux articles en bref</title>
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

<body <?php if($id_user!= ""){$time=timeout($id_user); echo "onLoad=\"StartTimer($time)\"";} ?> onload=connexion.login.focus(); leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="#FFCC66">
<link rel="search" type="application/opensearchdescription+xml" title="Intranet Wiki" href="wiki-agis.xml">
<table width="780" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="157" bgcolor="#FFcc66" valign=top>
          <?php include ("../inc/connexion.php");?>
          <?php include ("../inc/navigue.php");?>
          <?php include ("../inc/rechercher.php");?>
          <?php include ("menu_principal.inc");?>

    <td width="619" valign="top">
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
      <table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr>
          <td><img src="../lib/images/bandeau_etape0.gif" width="104" height="61"></td>
          <td><img src="../images_pop/nouveau_art.gif" width="500" vspace="0" hspace="0"></td>
          <td><a href="../aide.php#news" target="_blank"><img src="../lib/images/bandeau_aide_point_interrogation.gif" width="28" height="62" border="0"></a></td>
        </tr>


      </table>
      <br>
      <b><font face="Arial, Helvetica, sans-serif" size="2">Un coup d'oeil rapide
      sur les nouveaux articles depuis votre derni&egrave;re session</font></b><br>
      <br>
<?php
//Si l'utilisateur est connecté
//if($id_user)
//{
//   //Message Express
//   echo "
//        <FONT class=alerte>
//        </FONT>
//        ";
//   diffusion($id_user,$service);
//}
echo "
</span>
      <br>
      <table width=\"100%\" border=\"0\" cellspacing=\"0\">
        <tr>
          <td  width=\"100\" class=\"rollmarron\">date</td>
          <td  width=\"300\" class=\"rollmarron\">titre</td>
          <td  width=\"80\" class=\"rollmarron\">auteur</td>
          <td  width=\"200\" class=\"rollmarron\">sujet</td>
          <td  width=\"40\" class=\"rollmarron\">conf.</td>
          <td  width=\"25\" class=\"rollmarron\">Lu</td>
        </tr>
      </table>
      <form action=rapide.php?action=vitelu method=post>
      <input type=\"hidden\" value=\"$service\" name=service >
";
        //$recuperation=DatabaseOperation::query("select * from access_materiel_service ");
        //$sernav = "$service";
      //while ($groupe1=mysql_fetch_array($recuperation)){
       //$total=rapide1($id_user, $groupe1["K_service"], $sernav);
       //$compte=$total+$compte;
       //}
       $total=rapide1($id_user, $service, $service);
       ?>
        <br>
        <table width=100% cellspacing=0 border=0>
          <tr>
            <td>
              <div align="left">
              <?php if ($nva!="article"){echo"<a href=\"#\" onClick=\"history.go(-1);return(false)\">";}
              else{echo"<a href=\"../news/groupe.php?service=$id_service\">";}
              echo "
              <img src=\"../zimages/retour-j.gif\" width=\"130\" height=\"20\" border=\"0\" alt=\"Retour &agrave; la page pr&eacute;c&eacute;dente\" /></a></div>
            </td>
          <td><div align=right>
                <input type=\"image\" src=\"../images-index/marquer.gif\" name=\"submit\" alt=\"Valide vos cases coch&eacute;es ci-dessus comme article(s) lu(s)\">
        </div>
        </td>
          </tr>
        </table>
        ";
    if($compte==0){echo"<br><div align=\"center\">Aucun article n'a été créé depuis votre dernière session</div>";} ?>
      </form>
    </td>
    <td width="11"></td>
  </tr>
</table>

<p></p>
<p>&nbsp;</p>
</body>
<?php
    include("../lib/fin_page.inc");
?>