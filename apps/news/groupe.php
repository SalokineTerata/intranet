<?php
include ("../lib/session.php");
require ("../lib/functions.php");
require ("functions.php");
if(!$service)
{
   header ("Location: entreprise.php?service=1");
}
$groupe = substr($service, 0, 1);
?>
<html>
<head>
<title>Intranet Agis</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
<link rel="stylesheet" href="../lib/css/news<?php echo"$groupe"; ?>.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
function Popup(page,options) {
  document.location.href="../index.php?action=delog" ;
}
function StartTimer(delai) {
  // Déclenche le timer à la fin du chargement de la page (delai est en secondes)
  setTimeout("Popup()",delai*1000);
}

var pxleft=(screen.width-620)/2;
var pxtop=(screen.height-560)/2;
var feature='scrollbars=auto,width=620,height=560,left='+pxleft+' top='+pxtop

function MM_openBrWindow(theURL,winName)
                    {
                window.open(theURL,winName,feature);
            }
</SCRIPT>
</head>
<body bgcolor="#FFFFFF" text="#000000" onLoad="StartTimer(<?php $time=timeout($id_user); echo "$time"; ?>)" onLoad="MM_preloadImages('../images-index/entreprise_o_o.gif','../images-index/production_o_o.gif','../images-index/developpement_o_o.gif','../images-index/general_o_o.gif','../images-index/commercial_o_o.gif')" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="780" border="0" cellspacing="0" cellpadding="0" height="534">
  <tr>
    <td width="125" valign="top" bgcolor="#FFCC66" height="560">
      <?php include("../inc/connexion.php"); ?>
      <?php include("../inc/navigue.php"); ?>
      <?php include ("../inc/rechercher.php");?>
      <?php include ("menu_principal.inc");?>
      </td>
    <td valign="top" height="560">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="125" height="60" valign="top" border="0" bgcolor="#FFCC66">
            <a href="entreprise.php?service=1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav0111','','../images-index/entreprise_o_o.gif',1)"><img name="nav0111" border="0" src="../images-index/entreprise.gif" width="125" height="60"></a>
          </td>
          <td width="125" height="60"  valign="top" border="0" bgcolor="#FFCC66"><a href="neutre.php?service=1_1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav0211','','../images-index/production_o_o.gif',1)"><img name="nav0211" border="0" src="<?php if ($groupe == 1){echo "../images-index/production_c_c.gif"; }else{ echo "../images-index/production.gif";} ?>" width="125" height="60"></a>
          </td>
          <td width="125" height="60"  valign="top" border="0" bgcolor="#FFCC66"><a href="neutre.php?service=2_1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav031','','../images-index/developpement_o_o.gif',1)"><img name="nav031" border="0" src="<?php if ($groupe == 2){echo "../images-index/developpement_c_c.gif"; }else{ echo "../images-index/developpement.gif";} ?>" width="125" height="60"></a>
          </td>
          <td width="125" height="60"  valign="top" border="0" bgcolor="#FFCC66"><a href="neutre.php?service=3_1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav0411','','../images-index/general_o_o.gif',1)"><img name="nav0411" border="0" src="<?php if ($groupe == 3){echo "../images-index/general_c_c.gif"; }else{ echo "../images-index/general.gif";} ?>" width="125" height="60"></a>
          </td>
          <td width="125" height="60"  valign="top" border="0" bgcolor="#FFCC66"><a href="neutre.php?service=4_1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav0511','','../images-index/commercial_o_o.gif',1)"><img name="nav0511" border="0" src="<?php if ($groupe == 4){echo "../images-index/commercial_c_c.gif"; }else{ echo "../images-index/commercial.gif";} ?>" width="125" height="60"></a>
          </td>
          <td>&nbsp;</td>
        </tr>
      </table>

   <table width="625" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="125"><img src="../images-index/favoris.gif" width="130" height="52"></td>
    <td width="500" bgcolor="#FFCC66">
    <table width="100%" border="0" cellpadding="0">
        <?php favoris($id_user) ?>
        </table></td>
    <td width="125" class="txtentreprise" bgcolor="#FFCC66" align="center"><?php echo date("d/m/Y   G:i:s<br>  ", time());?></td>
  </td>
  </tr>
</table>

       <table width="100%" border="0" cellpadding="0">
        <tr>
          <td height="14">
            <?php defilante(); ?>
          </td>
        </tr>
        </table>
        <table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr>
          <td height="20"align="left"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="315" height="30">
              <param name="BGCOLOR" value="">
              <param name=movie value="images-news/groupe<?php echo"$groupe"; ?>.swf">
              <param name=quality value=high>
              <embed src="images-news/groupe<?php echo"$groupe"; ?>.swf" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="315" height="30">
              </embed>
            </object></td>
        </tr>
        <tr><td>
        <table width=620 >
        <tr>
          <?php services($service); ?>
        </tr>
        </table>
        </td></tr>
        <tr>
          <td height="10">&nbsp;<b><?php
          $reqser="select intitule_ser from services where id_service='$service'";
          $resultser=DatabaseOperation::query($reqser);
          $intservice=mysql_result($resultser,0,intitule_ser);
           echo"<li> $intservice</li>"; 
           ?></b>&nbsp;</td>
        </tr>
        <tr>
          <td height="328" valign="top">
          <!-- #BeginLibraryItem "/Library/news_developp.lbi" -->
<link rel="stylesheet" href="../news<?php echo"$groupe"; ?>.css" type="text/css">
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


<table width="620" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" width="100%">
      <table width="620" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top" width="100%">
            <table width="620" border="0" cellspacing="0" cellpadding="0" height="242">
              <tr>
                <td rowspan="2" valign="top" width="60%">
                  <table width="100%" border="0" cellspacing="7" name="tab01">
                    <tr>
                      <td rowspan="2" bgcolor="#FFCC66" width=71><img src="../news/data/<?php  $homepage=1; $titre1=homepage1($id_user, $service, $homepage); echo "$titre1[3]_1.png"; ?>" width="72" height="71"></td>
                      <td colspan="2" class="titr" width=80%><?php $titre0=stripslashes($titre1[0]); echo "$titre0"; ?></td>
                    </tr>
                    <tr>
                      <td colspan="2" class="txt"><?php $formate=stripslashes($titre1[1]); $formate = substr($formate,0,200); echo "$formate ..."; ?></td>
                    </tr>
                    <tr>
                      <td colspan="3" class="txt">
                        <p><?php $formate2=stripslashes($titre1[2]); $formate2 = substr($formate2,0,200); echo "$formate2 ..."; ?></p>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3" class="txt">
                        <table width="100%" border="0" cellspacing="2">
                          <tr>
                            <td width="45%"><a href="mailto:<?php echo"$titre1[5]" ?>" class="lelien">mailto</a></td>
                            <td width="50%">
                           <?php taille($titre1[4],$titre1[3]) ?>détail de l'article</a></td>
                            <td align="right" width="5%"><img src="../zimages/<?php $nom=imagelu($titre1[3], $id_user); echo"$nom"; ?>" width="20" height="24"></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
                <td width="40%" valign="top">
                  <table width="100%" border="0" cellspacing="7" name="tab02">
                    <tr>
                      <td class="titr" colspan="2"><?php  $homepage=2; $titre1=homepage1($id_user, $service, $homepage); $titre0=stripslashes($titre1[0]); echo "$titre0"; ?></td>
                    </tr>
                    <tr>
                      <td colspan="2" class="txt"><?php $formate=stripslashes($titre1[1]); $formate = substr($formate,0,150); echo "$formate ..."; ?></td>
                    </tr>
                    <tr>
                      <td width="90%" height="26"><?php taille($titre1[4],$titre1[3]) ?>détail de l'article</a></td>
                      <td width="26" valign="top" align="right"><img src="../zimages/<?php $nom=imagelu($titre1[3], $id_user); echo"$nom"; ?>" width="20" height="24"></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="40%">
                  <table width="100%" border="0" cellspacing="7" name="tab03">
                    <tr>
                      <td class="titr" colspan="2"><?php  $homepage=3; $titre1=homepage1($id_user, $service, $homepage); $titre0=stripslashes($titre1[0]); echo "$titre0"; ?></td>
                    </tr>
                    <tr>
                      <td colspan="2" class="txt"><?php $formate=stripslashes($titre1[1]); $formate = substr($formate,0,150); echo "$formate ..."; ?></td>
                    </tr>
                    <tr>
                      <td width="90%" height="26"><?php taille($titre1[4],$titre1[3]) ?>détail de l'article</a></td>
                      <td valign="top" width="20" align="right"><img src="../zimages/<?php $nom=imagelu($titre1[3], $id_user); echo"$nom"; ?>" width="20" height="24"></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td class="lelien" colspan="2">
                  <?php actifs($id_user); ?>
                  <table width="100%" border="0" cellspacing="4" name="tab04">
                    <tr>
                      <td class="titrtabl" width="24%">date de cr&eacute;ation</td>
                      <td class="titrtabl" width="24%">titre</td>
                      <td class="titrtabl" width="24%">auteur</td>
                      <td class="titrtabl" width="24%">sujet</td>
                     <td  width="24%"></td>
                     </tr>
                    <tr><?php listing($id_user, $service, $page); ?>
                    <td width="4%" valign="bottom" align="right" bgcolor="#FFFFFF"><!-- #BeginLibraryItem "/Library/haut.lbi" --><a href="#haut"><img src="../zimages/haut.gif" width="25" height="26" border="0"></a><!-- #EndLibraryItem --></td>
                    </tr>
                    </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table><!-- #EndLibraryItem -->

</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>