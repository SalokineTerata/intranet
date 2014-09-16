<?php
  require ("../lib/session.php");
  require("../lib/functions.php");
  identification1("salaries", $login, $pass);

  require ("functions.php");
  require ("functions.js");
  if ($insertion=='insertion')
  {
// Recherche du plus grand numéro d'article dans la table afin de pouvoir
// differencier l'article que l'on vient d'inserer.*/
    $req="select max(num_article) from articles";
    $result=DatabaseOperation::query($req);
    if ($result != false)
      $max=mysql_result($result, 0, 0);

/* Insertion dans la table article */
   if ($lien_1_type=='rien')
   {
     $lien_1_cont=null;
     $lien_1_txt=null;
   }
   if ($lien_2_type=='rien')
   {
     $lien_2_cont=null;
     $lien_2_txt=null;
   }
   if ($lien_3_type=='rien')
   {
     $lien_3_cont=null;
     $lien_3_txt=null;
   }
/* Recherche du numéro du groupe avec le numéro de service en varible globale*/
   $num_groupe=substr ($id_service, 0, 1);

/* Traitement des niveaux de confidentialite ou de la liste de diffusion*/
    if ($choixconf=='diff')
      $nivo_conf=0;
    else
      $nomliste=null;

   $titre_art=nl2br($titre_art);
   $txt_1=nl2br($txt_1);
   $txt_2=nl2br($txt_2);
   $lien_1_cont=nl2br($lien_1_cont);
   $lien_1_txt=nl2br($lien_1_txt);
   $lien_2_cont=nl2br($lien_2_cont);
   $lien_2_txt=nl2br($lien_2_txt);
   $lien_3_cont=nl2br($lien_3_cont);
   $lien_3_txt=nl2br($lien_3_txt);
   $sujet=nl2br($sujet);


/* Gestion des caracteres */
   $titre_art=addslashes($titre_art);
   $txt_1=addslashes($txt_1);
   $txt_2=addslashes($txt_2);
   $lien_1_cont=addslashes($lien_1_cont);
   $lien_1_txt=addslashes($lien_1_txt);
   $lien_2_cont=addslashes($lien_2_cont);
   $lien_2_txt=addslashes($lien_2_txt);
   $lien_3_cont=addslashes($lien_3_cont);
   $lien_3_txt=addslashes($lien_3_txt);
   $sujet=addslashes($sujet);
   $req="insert into articles (taille, id_art_group, id_art_serv, auteur, titre_art,
   date_crea, nivo_conf, img_1_alt, img_2_alt, txt_1, txt_2,
   lien_1_type, lien_1_cont, lien_1_txt, lien_2_type, lien_2_cont, lien_2_txt,
   lien_3_type, lien_3_cont, lien_3_txt, diffusion, sujet)
   values ('1', '$num_groupe', '$id_service', '$id_user', '$titre_art', now(), '$nivo_conf',
   '$img_1_alt', '$img_2_alt', '$txt_1', '$txt_2', '$lien_1_type',
   '$lien_1_cont', '$lien_1_txt', '$lien_2_type', '$lien_2_cont', '$lien_2_txt', '$lien_3_type',
   '$lien_3_cont', '$lien_3_txt', '$nomliste', '$sujet')";

//   echo"01-requete insertion = $req<br>";
   $result=DatabaseOperation::query($req);

/* Recherche du numéro de l'article que l'on vient d'enregistrer pour les updates*/
    $req="select num_article from articles where taille='1' and id_art_group='$num_groupe'
    and id_art_serv='$id_service' and auteur='$id_user' and nivo_conf ='$nivo_conf' and num_article>'$max'";

//    echo"02-requete pour trouver numero article = $req<br>";

    $result=DatabaseOperation::query($req);
    if ($result != false)
      $num_article=mysql_result($result, 0, num_article);


/*
     Traitement de l'image n°1
*/
    $num_article;
    $num_image='1';
    insert_image($num_article, $num_image);

/*
     Traitement de l'image n°2
*/
    $num_article;
    $num_image='2';
    insert_image($num_article, $num_image);


/* Insertion des images */
   $req="update articles set img_1_nom='$img_1_nom', img_2_nom='$img_2_nom' where num_article='$num_article'";
//echo"03-requete inserion image = $req<br>";

   $result=DatabaseOperation::query($req);

/* Recuperation des elements pour affichage */
    $req="select * from articles, modes where num_article='$num_article'";
    $result=DatabaseOperation::query($req);
/*  Recuperation des elements */
    $taille=mysql_result($result, 0, taille);
    $auteur=mysql_result($result, 0, auteur);
    $publica=mysql_result($result, 0, publica);
    $titre_art=mysql_result($result, 0, titre_art);
    $date_crea=mysql_result($result, 0, date_crea);
    $date_modif=mysql_result($result, 0, date_modif);
    $nivo_conf=mysql_result($result, 0, nivo_conf);
    $img_1_alt=mysql_result($result, 0, img_1_alt);
    $img_1_nom=mysql_result($result, 0, img_1_nom);
    $img_2_alt=mysql_result($result, 0, img_2_alt);
    $img_2_nom=mysql_result($result, 0, img_2_nom);
    $txt_1=mysql_result($result, 0, txt_1);
    $txt_2=mysql_result($result, 0, txt_2);
    $lien_1_type=mysql_result($result, 0, lien_1_type);
    $lien_1_cont=mysql_result($result, 0, lien_1_cont);
    $lien_1_txt=mysql_result($result, 0, lien_1_txt);
    $lien_2_type=mysql_result($result, 0, lien_2_type);
    $lien_2_cont=mysql_result($result, 0, lien_2_cont);
    $lien_2_txt=mysql_result($result, 0, lien_2_txt);
    $lien_3_type=mysql_result($result, 0, lien_3_type);
    $lien_3_cont=mysql_result($result, 0, lien_3_cont);
    $lien_3_txt=mysql_result($result, 0, lien_3_txt);
    $diffusion=mysql_result($result, 0, diffusion);
    $sujet=mysql_result($result, 0, sujet);

/* Gestion des caracteres */
   $titre_art=stripslashes($titre_art);
   $txt_1=stripslashes($txt_1);
   $txt_2=stripslashes($txt_2);
   $lien_1_cont=stripslashes($lien_1_cont);
   $lien_1_txt=stripslashes($lien_1_txt);
   $lien_2_cont=stripslashes($lien_2_cont);
   $lien_2_txt=stripslashes($lien_2_txt);
   $lien_3_cont=stripslashes($lien_3_cont);
   $lien_3_txt=stripslashes($lien_3_txt);
   $sujet=stripslashes($sujet);

//echo"04-requete recuperation elements = $req<br>";   
   
  }


  if ($modification=='modification')
  {

/*
     Traitement de l'image n°1
*/
    $num_article;
    $num_image='1';
    insert_image($num_article, $num_image);

/*
     Traitement de l'image n°2
*/
    $num_article;
    $num_image='2';
    insert_image($num_article, $num_image);


/* Apres traitement des images, on fait un update dans la table article */
/* Traitement des niveaux de confidentialite ou de la liste de diffusion*/
    if ($choixconf=='diff')
      $nivo_conf=0;
    else
      $nomliste=null;
   if ($lien_1_type=='rien')
   {
     $lien_1_cont=null;
     $lien_1_txt=null;
   }
   if ($lien_2_type=='rien')
   {
     $lien_2_cont=null;
     $lien_2_txt=null;
   }
   if ($lien_3_type=='rien')
   {
     $lien_3_cont=null;
     $lien_3_txt=null;
   }

/* Gestion des caracteres */
   $titre_art=addslashes($titre_art);
   $txt_1=addslashes($txt_1);
   $txt_2=addslashes($txt_2);
   $lien_1_cont=addslashes($lien_1_cont);
   //$lien_1_txt=addslashes($lien_1_txt);
   $lien_2_cont=addslashes($lien_2_cont);
   //$lien_2_txt=addslashes($lien_2_txt);
   $lien_3_cont=addslashes($lien_3_cont);
   //$lien_3_txt=addslashes($lien_3_txt);
   $sujet=addslashes($sujet);
   
   $txt_1=nl2br($txt_1);
   $txt_2=nl2br($txt_2);
   
   $req="update articles set titre_art='$titre_art', nivo_conf=$nivo_conf, img_1_alt='$img_1_alt',
   img_2_alt='$img_2_alt', txt_1='$txt_1', txt_2='$txt_2', lien_1_type='$lien_1_type', lien_1_cont='$lien_1_cont',
   lien_1_txt='$lien_1_txt', lien_2_type='$lien_2_type', lien_2_cont='$lien_2_cont', lien_2_txt='$lien_2_txt',
   lien_3_type='$lien_3_type', lien_3_cont='$lien_3_cont', lien_3_txt='$lien_3_txt', img_1_nom='$img_1_nom',
   img_2_nom='$img_2_nom', sujet='$sujet' where num_article='$num_article'";

//echo"05-requete update = $req<br>";    

    $result=DatabaseOperation::query($req);
    $req="delete from lu where id_art='$num_article'";
    $result=DatabaseOperation::query($req);

/* Recuperation des elements pour affichage */
    $req="select * from articles, modes where num_article='$num_article'";
    $result=DatabaseOperation::query($req);
/*  Recuperation des elements */
    $taille=mysql_result($result, 0, taille);
    $auteur=mysql_result($result, 0, auteur);
    $publica=mysql_result($result, 0, publica);
    $titre_art=mysql_result($result, 0, titre_art);
    $date_crea=mysql_result($result, 0, date_crea);
    $date_modif=mysql_result($result, 0, date_modif);
    $nivo_conf=mysql_result($result, 0, nivo_conf);
    $img_1_alt=mysql_result($result, 0, img_1_alt);
    $img_1_nom=mysql_result($result, 0, img_1_nom);
    $img_2_alt=mysql_result($result, 0, img_2_alt);
    $img_2_nom=mysql_result($result, 0, img_2_nom);
    $txt_1=mysql_result($result, 0, txt_1);
    $txt_2=mysql_result($result, 0, txt_2);
    $lien_1_type=mysql_result($result, 0, lien_1_type);
    $lien_1_cont=mysql_result($result, 0, lien_1_cont);
    $lien_1_txt=mysql_result($result, 0, lien_1_txt);
    $lien_2_type=mysql_result($result, 0, lien_2_type);
    $lien_2_cont=mysql_result($result, 0, lien_2_cont);
    $lien_2_txt=mysql_result($result, 0, lien_2_txt);
    $lien_3_type=mysql_result($result, 0, lien_3_type);
    $lien_3_cont=mysql_result($result, 0, lien_3_cont);
    $lien_3_txt=mysql_result($result, 0, lien_3_txt);
    $diffusion=mysql_result($result, 0, diffusion);
    $sujet=mysql_result($result, 0, sujet);
/* Gestion des caracteres */
   $titre_art=stripslashes($titre_art);
   $txt_1=stripslashes($txt_1);
   $txt_2=stripslashes($txt_2);
   $lien_1_cont=stripslashes($lien_1_cont);
   $lien_1_txt=stripslashes($lien_1_txt);
   $lien_2_cont=stripslashes($lien_2_cont);
   $lien_2_txt=stripslashes($lien_2_txt);
   $lien_3_cont=stripslashes($lien_3_cont);
   $lien_3_txt=stripslashes($lien_3_txt);
   $sujet=stripslashes($sujet);
  }
  else
  {
/* verification des bons droits de l'utilisateur par rapport a l'article lu */
    $req="select * from $table, modes where $table.num_article='$num_article'";

//echo"06-requete recuperation elements2 = $req<br>"; 
    //echo"$req";

    $result=DatabaseOperation::query($req);
/*  Recuperation des elements */
    $taille=mysql_result($result, 0, taille);
    $auteur=mysql_result($result, 0, auteur);
    $publica=mysql_result($result, 0, publica);
    $titre_art=mysql_result($result, 0, titre_art);
    $date_crea=mysql_result($result, 0, date_crea);
    $date_modif=mysql_result($result, 0, date_modif);
    $nivo_conf=mysql_result($result, 0, nivo_conf);
    $img_1_alt=mysql_result($result, 0, img_1_alt);
    $img_1_nom=mysql_result($result, 0, img_1_nom);
    $img_2_alt=mysql_result($result, 0, img_2_alt);
    $img_2_nom=mysql_result($result, 0, img_2_nom);
    $txt_1=mysql_result($result, 0, txt_1);
    $txt_2=mysql_result($result, 0, txt_2);
    $lien_1_type=mysql_result($result, 0, lien_1_type);
    $lien_1_cont=mysql_result($result, 0, lien_1_cont);
    $lien_1_txt=mysql_result($result, 0, lien_1_txt);
    $lien_2_type=mysql_result($result, 0, lien_2_type);
    $lien_2_cont=mysql_result($result, 0, lien_2_cont);
    $lien_2_txt=mysql_result($result, 0, lien_2_txt);
    $lien_3_type=mysql_result($result, 0, lien_3_type);
    $lien_3_cont=mysql_result($result, 0, lien_3_cont);
    $lien_3_txt=mysql_result($result, 0, lien_3_txt);

    $diffusion=mysql_result($result, 0, diffusion);
    $sujet=mysql_result($result, 0, sujet);
/* Gestion des caracteres */
   $titre_art=stripslashes($titre_art);
   $txt_1=stripslashes($txt_1);
   $txt_2=stripslashes($txt_2);
   $lien_1_cont=stripslashes($lien_1_cont);
   $lien_1_txt=stripslashes($lien_1_txt);
   $lien_2_cont=stripslashes($lien_2_cont);
   $lien_2_txt=stripslashes($lien_2_txt);
   $lien_3_cont=stripslashes($lien_3_cont);
   $lien_3_txt=stripslashes($lien_3_txt);
   $sujet=stripslashes($sujet);

/*echo"ligne 392:taille=$taille, auteur=$auteur, publica=$publica, titre_art=$titre_art, date_crea=$date_crea,date_modif=$date_modif,
nivo_conf=$nivo_conf, img_1_alt=$img_1_alt, img_1_nom=$img_1_nom, img_2_alt=$img_2_alt, img_2_nom=$img_2_nom, txt_1=$txt_1, sujet=$sujet<br>";*/
   
  }
/* Recherche des noms auteur et publicateur */
    $req="select nom, prenom from salaries where id_user='$auteur'";

//echo"07-requete select = $req<br>"; 

    $result=DatabaseOperation::query($req);
    $nomaut=mysql_result($result, 0, nom);
    $prenomaut=mysql_result($result, 0, prenom);

    if ($publica!=null)
    {
      $req="select * from salaries where id_user='$publica'";
      $result=DatabaseOperation::query($req);
      $nompub=mysql_result($result, 0, nom);
      $prenompub=mysql_result($result, 0, prenom);
    
     }
?>
<html>
<head>
<title>News Agis</title>
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
<script language="JavaScript">
<!--
function Popup(page,options) {
  window.close() ;
}

//-->
</script>
<link rel="stylesheet" href=../lib/css/admin_intra01.css type="text/css">
<link rel="stylesheet" href="../lib/css/admin_newspopup.css" type="text/css">
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
<SCRIPT LANGUAGE="JavaScript">
function Popup(page,options) {
  document.location.href="../index.php?action=delog" ;
}
function StartTimer(delai) {
  // Déclenche le timer à la fin du chargement de la page (delai est en secondes)
  setTimeout("Popup()",delai*1000);
}
</SCRIPT>
<link rel="stylesheet" href=../lib/css/admin_intra01.css type="text/css">
<link rel="stylesheet" href="../lib/css/admin_news1.css" type="text/css">
</head>

<body onLoad="StartTimer(<?php $time=timeout($id_user); echo "$time"; ?>)" bgcolor="#FFCC66" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php  if ($insertion!='insertion'){
  //include ("../adminagis/cadrehautnews.php");
}
?>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
  <tr>
    <td align="center" valign="top">
      <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
        <tr>
          <td><img src="../zimages/tetnews.gif" width="600" height="40"></td>
        </tr>
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="4" cellpadding="0" bordercolor="#FFCC66">
              <tr>
                <td class="loginFFFFFFdroit" width="4%">&nbsp;</td>
                <td class="loginFFFFFFdroit" width="11%">Auteur</td>
                <td class="loginFFFFFF" width="30%">
                 <input type="text" name="auteur" size="22" class="txtfield" value='
<?php
  echo ("$prenomaut $nomaut");
?>
                  '>
                </td>
                <td class="loginFFFFFFdroit" width="15%">publi&eacute; par</td>
                <td class="loginFFFFFF" width="30%">
                <input type="text" name="Publicateur" size="22" class="txtfield" value='
<?php
  echo ("$prenompub $nompub");
?>
                  '>
                </td>

                                <td class="loginFFFFFF" width="5%" align="center">&nbsp</td>
              </tr>
              <tr>
                <td class="loginFFFFFFdroit"><img src="../lib/images/espaceur.gif" width="25" height="1"></td>
                <td class="loginFFFFFFdroit" width="11%">Date d'origine</td>
                <td class="loginFFFFFF" width="30&ugrave;">

                                <input type="text" name="datecrea" size="22" class="txtfield" value='
<?php
  $date_crea=affiche_date($date_crea);
  echo ("$date_crea");
?>
                  '>
                </td>
                <td class="loginFFFFFFdroit">Derni&egrave;re modification</td>
                <td class="loginFFFFFF" width="30%">

                                <input type="text" name="date_lastmodif" size="22" class="txtfield" value='
<?php
  if ($date_modif!=0)
  {
    $date_modif=affiche_date($date_modif);
    echo ("$date_modif");
  }
?>
'>
                </td>
                <td class="loginFFFFFF" width="5%">&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table width="600" border="4" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" bordercolor="#FFCC66">
        <tr>
          <td class="loginFFCC66">

<table width="100%" border="0" cellspacing="4" cellpadding="0" bordercolor="#FFCC66">

<tr>

<td class="loginFFFFFFdroit" width="4%"><img src="../zimages/verou.gif" width="25" height="26"></td>
<td class="loginFFFFFFdroit" width="11%" align="left">
<div align="left"><?php echo "Niveau $nivo_conf"; ?></div>
</td>
<td class="loginFFFFFF" width="80%">

titre&nbsp; :<input type="text" name="textfield323" size="65" class="loginFFFFFF" value="
<?php
$titre_art=stripslashes($titre_art);
  echo ("$titre_art");
?>
                  ">
sujet :<input type="text" name="textfield329" size="65" class="loginFFFFFF" value="
<?php
$sujett=stripslashes($sujet);
  echo ("$sujet");
?>
                  ">                  
                </td>
</tr>

</table>
          </td>
        </tr>
        <tr>
          <td>
            <table width="100%" border="1" cellspacing="4" cellpadding="0">
              <tr>
              <td class="txttabl" valign="top">
<?php
  $txt_1=stripslashes($txt_1);
  echo ("$txt_1");
?>
              </td>
              <td class="loginFFFFFF" width="72" align="center" valign="middle">
<?php

$nom_image="nomimg1";
$$nom_image=$num_article."_1.png";
afficher_image($nom_image);


?>
              </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>
            <table width="100%" border="1" cellspacing="4" cellpadding="0">
              <tr>
              <td class="txttabl" valign="top">
<?php
  $txt_2=stripslashes($txt_2);
  echo ("$txt_2");
?>
              </td>
              <td class="loginFFFFFF" width="72" align="center" valign="middle">
<?php

$nom_image="nomimg2";
$$nom_image=$num_article."_2.png";
afficher_image($nom_image);


?>
              </tr>
            </table>
        </td>
        </tr>
        <tr><td>
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
            <table width="100%" border="1" cellspacing="4" cellpadding="0">
              <?php 
              //echo"num article : $num_article";
              liens_court($num_article) ?>
            </table>
</td>
        </tr>
        <tr bgcolor="#FFCC66" align="center" valign="middle">
          <td colspan="2" class="loginFFCC66"><br>
<?php

  if (($pub=="pub") or ($pub=="gere")){
    $tyty="-1";
  }else{
    $tyty="-3";
 }
    echo ("<a href=index.php><img src=\"../zimages/retour-j.gif\" width=\"130\" height=\"20\" border=\"0\"></a>\n");
  if ($pub=="pub")
  {
    taillemod(1, $num_article, "articles");
    echo (" <img src=\"../lib/images/bouton_modification.gif\" border=\"0\"></a>\n");

    //echo"<div align=right>";
    echo"<form action=\"../adminagis/article_publier.php?publication=ok&num_article=$num_article\" method=\"post\">";
    /* echo"Position Homepage ";
    echo ("<select name=\"homepage\">\n");
    echo ("<option value=\"4\">en liste</option>");
        echo ("<option value=\"1\">central gauche</option>");
            echo ("<option value=\"2\">haut droite</option>");
                echo ("<option value=\"3\">bas droite</option>");
    echo ("</select>\n"); */
    echo"<input type=image src=\"../images_pop/publier.gif\" border=0>";
    echo"</form>";
    //echo"</div> ";

  }
  if (($insertion=='insertion')&&($modification=='modification'))
  {

  }
  else
    echo ("&nbsp;");
?>
          </td>
        </tr>


<?php
/* 
if (($modification!='modification')&&($insertion!='insertion')){

$req1="select id_art_serv from $table where num_article='$num_article'";
$recupser=DatabaseOperation::query($req1);
$sercicou=mysql_result($recupser, 0, id_art_serv);
$infohome=etatnivo($sercicou);

$reqser="select * from services where id_service='$sercicou'";
$resultser=DatabaseOperation::query($reqser);
$serviceintit=mysql_result($resultser, 0, intitule_ser);
}
?><br><br>

<?php  if (($modification!='modification')&&($insertion!='insertion')){
echo"$table Information sur la presence des news de confidentialité 1";
echo"<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#FFFFFF\">";
echo"  <tr>";
echo"    <td class=\"txtfield\">";
echo"    <div align=\"center\">Service \"$serviceintit\"</div>";
echo"    </td>";
echo"    <td class=\"txtfield\">";
echo"      <div align=\"center\">Gauche Centr&eacute;</div>";
echo"    </td>";
echo"    <td class=\"txtfield\">";
echo"      <div align=\"center\">Haut Droite</div>";
echo"    </td>";
echo"    <td class=\"txtfield\">";
echo"      <div align=\"center\">Bas Droite</div>";
echo"    </td>";
echo"    <td class=\"txtfield\">";
echo"      <div align=\"center\">En Liste</div>";
echo"    </td>";
echo"  </tr> ";
echo"  <tr>";
echo"    <td class=\"txtfield\">";
echo"      <div align=\"center\">Confidentialit&eacute; 1</div>";
echo"    </td>";
echo"    <td class=\"txtfield\">";
echo"      <div align=\"center\">$infohome[0]</div>";
echo"    </td>";
echo"    <td class=\"txtfield\"><div align=\"center\">$infohome[1]</div></td>";
echo"    <td class=\"txtfield\"><div align=\"center\">$infohome[2]</div></td>";
echo"    <td class=\"txtfield\"><div align=\"center\">$infohome[3]</div></td>";
echo"  </tr>";
echo"</table>";
}
 */
  if ($insertion=='insertion'){
echo"<div align=center>Votre article a été enregistré et sera activé par votre publicateur aprés vérification.
  Vous pouvez toujours corriger votre article - tant qu'il n'a pas été publié - en cliquant sur le bouton \"modification\" de votre page d'accueil</div>";

}
?>          </td>
        </tr>
     </table>
<?php  if ($insertion!='insertion'){
     include ("../adminagis/../adminagis/cadrebas.php");
}
?>
</body>
</html>