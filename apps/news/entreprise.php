<?php
require_once '../inc/main.php';
$service = Lib::getParameterFromRequest('service');
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

<body  <?php if($id_user!= ""){$time=timeout($id_user); echo "onLoad=\"StartTimer($time)\"";} ?>;MM_preloadImages('../images-index/entreprise_o_o.gif')" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="780" border="0" cellspacing="0" cellpadding="0" height="502">
  <tr>
    <td width="150" bgcolor="#FFcc66" height="551" valign="top">
      <?php include ("../inc/connexion.php");?>
      <?php include ("../inc/navigue.php");?>
      <?php include ("../inc/rechercher.php");?>
      <?php include ("menu_principal.inc");?>
    </td>
    <td width="569" valign="top" height="551">
      <table cellspacing="0" border="0" cellpadding="0">
        <tr>
             <td width="371" height="68" valign="top" border="0" bgcolor="#FFCC66"> <a href="entreprise.php?service=1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav011','','../images-index/entreprise_o_o.gif',1)"><img name="nav011" border="0" src="../images-index/entreprise_c_c.gif" width="125" height="60"></a></td>
    <td width="125" height="68"  valign="top" border="0" bgcolor="#FFCC66"><a href="neutre.php?service=1_1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav021','','../images-index/production_o_o.gif',1)"><img name="nav021" border="0" src="<?php if ($groupe == 1){echo "../images-index/production_c_c.gif"; }else{ echo "../images-index/production.gif";} ?>" width="125" height="60"></a>
    </td>
    <td width="125" height="68"  valign="top" border="0" bgcolor="#FFCC66"><a href="neutre.php?service=2_1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav03','','../images-index/developpement_o_o.gif',1)"><img name="nav03" border="0" src="<?php if ($groupe == 2){echo "../images-index/developpement_c_c.gif"; }else{ echo "../images-index/developpement.gif";} ?>" width="125" height="60"></a>
    </td>
    <td width="125" height="68"  valign="top" border="0" bgcolor="#FFCC66"><a href="neutre.php?service=3_1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav041','','../images-index/general_o_o.gif',1)"><img name="nav041" border="0" src="<?php if ($groupe == 3){echo "../images-index/general_c_c.gif"; }else{ echo "../images-index/general.gif";} ?>" width="125" height="60"></a>
    </td>
    <td width="125" height="68"  valign="top" border="0" bgcolor="#FFCC66"><a href="neutre.php?service=4_1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav051','','../images-index/commercial_o_o.gif',1)"><img name="nav051" border="0" src="<?php if ($groupe == 4){echo "../images-index/commercial_c_c.gif"; }else{ echo "../images-index/commercial.gif";} ?>" width="125" height="60"></a>
    </td>
  </tr>
  </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><br>
            <br>
          </td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=4,0,2,0" width="156" height="29">
              <param name=movie value="images-news/tit-entreprise.swf">
              <param name=quality value=high>
              <param name="BGCOLOR" value="">
              <param name="SCALE" value="exactfit">
              <embed src="images-entreprise/tit-entreprise.swf" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" scale="exactfit" width="156" height="29" bgcolor="">
              </embed>
            </object></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="620" border="0" cellspacing="4" cellpadding="0" height="22">
              <tr>
              <br>
              <?php servicesce($service); ?>

              </tr>
            </table><br>
            <table width="100%" border="0" cellspacing="4" cellpadding="0">
              <tr>
                <td valign=top>
<?php /* article ce central */
centrece($service)
?>
                </td>
                <td valign=top>
<?php /* article ce colonne */
droitece($service)
?>
                </td>
              </tr>
            </table><br>
<table width="100%" border="0" cellspacing="4" cellpadding="0" align=center>
<tr><td align=center>
<?php
if($service)
{
    $requeto =DatabaseOperation::query("SELECT * FROM articlece where numserce=$service and placeinfoce='Info centrale'");
    $totalito = mysql_num_rows($requeto);
    if ($totalito > 3)
    {
       echo"<font size=1 color=#000000><a href=\"entreprise2.php?service=$service\">suite des articles ...</a></font>";
    }
}
?>
</td></tr></table>
          </td>
        </tr>
      </table>
      <link rel="stylesheet" href="../lib/css/news1.css" type="text/css">
    </td>
  <td width="12" height="551">&nbsp;</td>
  </tr>
</table>
<a name="bas"></a>
</body>