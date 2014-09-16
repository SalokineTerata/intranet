<?php

// mis en commentaire par SM le 08/04/04 - A supprimer si après un certain temps la fonction ne sert à rien (????)
// en effet la fonction qui est opérationnelle (envoismail) est déclarée dans ../fonction_mail/
/*  function envoi_mail($corpsmail, $adrFrom, $adrTo, $sujet)

//   Fonction mail
//   Envoi de mail. En parametres:
//   $corpsmail: Le texte du mail redige en HTML
//   $adrFrom: adresse de l'expediteur
//   $adrTo: adresse du destinataire
//   $sujet: sujet du mail
  {
// Constition du corps du mail
//      $entetemail = "X-Mailer: $adrfrom\r\nMIME-Version: 1.0\r\nContent-Type: text/html; charset=ISO-8859-1\r\nContent-Transfer-Encoding: 8bit\n";
//      $entetemail .= "From: $adrfrom \n";
//     $entetemail .= "Reply-To: $adrfrom\n";
//      $rep= @mail($adrTo, $sujet, $corpsmail, $entetemail);
    
      $rep=envoismail($sujet,$corpsmail,$adrTo,$adrFrom);
  };
*/

// Fonction makeSelectListChecked
// Permet de créer une liste déroulante d'un champ de type
// enum.
function makeSelectList($nombase,$table,$field){
  $s="";

  //$rid=mysql_db_query($nombase,"SHOW COLUMNS FROM $table");
  $rid=DatabaseOperation::query("SHOW COLUMNS FROM $table");
  if($rid)
  {
    $nr=mysql_num_rows($rid);
      while(list($name, $type)=mysql_fetch_row($rid))
      {
        if($name==$field)
        {
          if(preg_match('/^enum\(.*\)$/',$type))
            $type=substr($type,6,-2);
          else
            if(preg_match ('/^set\(.*\)$/',$type))
              $type=substr($type,5,-2);
            else
              return("<option>ERROR");
          $opts=explode("','",$type);
          while(list($k,$v)=each($opts))
            $s.="<option>$v";
        }
      }
  }
  return($s);
};

// Fonction makeSelectListChecked
// Permet de créer une liste déroulante d'un champ de type
// enum en selectionnant un élément particulier.
function makeSelectListChecked($nombase,$table,$field, $val)
{
  $s="";
  // Boris 2003.03.28: $rid=mysql_db_query($nombase,"SHOW COLUMNS FROM $table");
  $rid=DatabaseOperation::query("SHOW COLUMNS FROM $table");
if ($rid)
    {

      $nr=mysql_num_rows($rid);

      while(list($name, $type)=mysql_fetch_row($rid))
      {
        if($name==$field)
        {
          if(preg_match('/^enum\(.*\)$/',$type))
            $type=substr($type,6,-2);
          else
            if(preg_match('/^set\(.*\)$/',$type))
              $type=substr($type,5,-2);
            else
              return("<option>ERROR");
          $opts=explode("','",$type);
          while(list($k,$v)=each($opts))
          {
            if ($val==$v)
              $s.="<option selected>$v";
            else
              $s.="<option>$v";
          }
        }
      }
    }
  return($s);
};

// Fonction affiche_date
// Permet de formater une date SQL en format JJ/MM/AAAA
function affiche_date($val)
{
  $toto=substr($val, 0, 10);
  $tata=substr($toto, -2)."/".substr($toto, 5,2)."/".substr($toto, 0,4);
  return ($tata);
};


// Fonction taille_image_7271
// Permet de redimensionner une image en 72x71.
function taille_image_7271($filesrc, $filedst)
{
// Recuperation du type d'image
  $taille=getimagesize ($filesrc);


  $new_w=72; // Taille en X de l'image de destination ( width )
  $new_h=71; // Taille en Y de l'image de destination ( height )


  $dst_img=imagecreatetruecolor($new_w,$new_h);
// définition de l'image source
  if ($taille[2]==1) //C'est un GIF
  {
  $src_img=ImageCreateFromGIF($filesrc);
  }
  if ($taille[2]==2) //C'est un JPEG
  {
  $src_img=ImageCreateFromJPEG($filesrc);
  }
  if ($taille[3]==2) //C'est un PNG
  {
  $src_img=ImageCreateFromPNG($filesrc);
  }

  ImageCopyResized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,ImageSX($src_img),ImageSY($src_img));
// Enregistrement de l'image transformée ( enlever $file si affichage uniquement )
// définition de l'image destination
  if ($taille[2]==1) //C'est un GIF
  {
    ImageGIF($dst_img,$filedst);
  }
  if ($taille[2]==2) //C'est un JPEG
  {
    ImageJPEG($dst_img,$filedst);
  }
  if ($taille[3]==2) //C'est un PNG
  {
    ImagePNG($dst_img,$filedst);
  }

};

// Fonction taille_image_350y
// Permet de retailler une image en gardant son ratio
// avec une largeur de 350 si l'image a une largeur
// superieure.
function taille_image_350Y($filesrc, $filedst)
{
  $taille=getimagesize ($filesrc);
  $largeur= $taille[0];
  if ($largeur>350)
  {
    $longueur=$taille[1];
    $rapport=$largeur / $longueur;

    $new_w=350; // Taille en X de l'image de destination ( width )
    $new_h=floor(350/$rapport); // Taille en Y de l'image de destination ( height )

    $dst_img=ImageCreate($new_w,$new_h);
// définition de l'image source
    if ($taille[2]==1) //C'est un GIF
    {
      $src_img=ImageCreateFromGIF($filesrc);
    }
    if ($taille[2]==2) //C'est un JPEG
    {
      $src_img=ImageCreateFromJPEG($filesrc);
    }
    if ($taille[3]==2) //C'est un PNG
    {
      $src_img=ImageCreateFromPNG($filesrc);
    }

  ImageCopyResized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,ImageSX($src_img),ImageSY($src_img));
// Enregistrement de l'image transformée ( enlever $file si affichage uniquement )
// définition de l'image destination
    if ($taille[2]==1) //C'est un GIF
    {
      ImageGIF($dst_img,$filedst);
    }
    if ($taille[2]==2) //C'est un JPEG
    {
      ImageJPEG($dst_img,$filedst);
    }
    if ($taille[3]==2) //C'est un PNG
    {
      ImagePNG($dst_img,$filedst);
    }
  }
};

// Fonction taille_image_300y
// Permet de retailler une image en gardant son ratio
// avec une largeur de 300 si l'image a une largeur
// superieure.
function taille_image_300Y($filesrc, $filedst)
{
  $taille=getimagesize ($filesrc);
  $largeur= $taille[0];
  if ($largeur>300)
  {
    $longueur=$taille[1];
    $rapport=$largeur / $longueur;

    $new_w=300; // Taille en X de l'image de destination ( width )
    $new_h=floor(300/$rapport); // Taille en Y de l'image de destination ( height )

    $dst_img=ImageCreate($new_w,$new_h);
// définition de l'image source
    if ($taille[2]==1) //C'est un GIF
    {
      $src_img=ImageCreateFromGIF($filesrc);
    }
    if ($taille[2]==2) //C'est un JPEG
    {
      $src_img=ImageCreateFromJPEG($filesrc);
    }
    if ($taille[3]==2) //C'est un PNG
    {
      $src_img=ImageCreateFromPNG($filesrc);
    }

  ImageCopyResized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,ImageSX($src_img),ImageSY($src_img));
// Enregistrement de l'image transformée ( enlever $file si affichage uniquement )
// définition de l'image destination
    if ($taille[2]==1) //C'est un GIF
    {
      ImageGIF($dst_img,$filedst);
    }
    if ($taille[2]==2) //C'est un JPEG
    {
      ImageJPEG($dst_img,$filedst);
    }
    if ($taille[3]==2) //C'est un PNG
    {
      ImagePNG($dst_img,$filedst);
    }
  }
};


/*----------------------------------------
  Ouverture d'un article
------------------------------------------*/
function taille($taille,$num_article, $table, $pub)
{
  if ($taille == 1)
  {
    echo"<a href=\"#\" onClick=\"MM_goToURL('parent','../news/news_courte.php?num_article=$num_article&table=$table&pub=$pub');return document.MM_returnValue\">";
  }
  else
  {
    echo"<a href=\"#\" onClick=\"MM_goToURL('parent','../news/news_long.php?num_article=$num_article&table=$table&pub=$pub');return document.MM_returnValue\">";
  }
};

/*----------------------------------------
  Ouverture d'un article en modification
------------------------------------------*/
function taillemod($taille,$num_article, $table)
{
  if ($taille == 1)
  {
    echo"<a href=../news/modcourt.php?num_article=$num_article&modifier=mod>";
  }
  else
  {
    echo"<a href=../news/modetap1long.php?num_article=$num_article&modifier=mod>";
  }
};

/*------------------------------------------------------
   la gestion des zones libres dans les news longues
-------------------------------------------------------*/
function zone($num_art, $num_zone, $table){
$zone1 = DatabaseOperation::query("select * from $table where num_article = $num_art");
$zonerow = mysql_fetch_array ($zone1);

$type = "zone_".$num_zone."_type";
$lien = "zone_".$num_zone."_lien";
$infos = "zone_".$num_zone."_info";
$justif = "zone_".$num_zone."_justif";

if ($zonerow[$type] == "rien"){
echo"<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" name=\"tablo004\">";
}
else{
echo"<table width=\"100%\" border=\"1\" cellspacing=\"4\" cellpadding=\"0\" name=\"tablo004\">";
}
echo"<tr>";
echo "<td align=";
if ($zonerow[$justif] == "gauche"){echo"left";}
else if ($zonerow[$justif] == "milieu"){echo"center";}
else if ($zonerow[$justif] == "droite"){echo"right";}
echo">";
/* si dans la base */
$tempo=stripslashes($zonerow[$infos]);

if ($zonerow[$type] == "lien"){
echo "<a href=\"http:\"//$zonerow[$lien]\">$tempo</a>";
}
if ($zonerow[$type] == "image"){
echo "<img src=\"../imgarticle/$zonerow[$lien]\" border=0 alt=\"$tempo\">";
}
if ($zonerow[$type] == "texte"){
echo "<font class=\"txt\">$tempo</font>";
}

echo "</td>";
echo"</tr>";
echo"</table>";
}


/*---------------------------------------------
   la gestion des liens dans les news_longues
---------------------------------------------*/
function liens_long($num, $table){
$liens1 = DatabaseOperation::query("select * from $table where num_article = $num");
$liensrow = mysql_fetch_array ($liens1);
/* alors les types sont les suivants :
1 - rien ; 2 - auteur (sans lien reprise article) ; 3 - auteur (mail) ; 4 - site net ; 5 - autre article */

echo"<tr>";
if  ($liensrow[lien_1_type] != "rien"){
echo"<td class=\"loginFFFFFF\" width=\"20%\" bordercolor=\"#000000\"> $liensrow[lien_1_type] </td>";
echo"<td class=\"loginFFFFFF\" width=\"80%\" bordercolor=\"#000000\">";
}
if ($liensrow[lien_1_type] == "auteur"){echo "$liensrow[lien_1_txt]";}
if ($liensrow[lien_1_type] == "mail"){echo "<a href=\"mailto:$liensrow[lien_1_cont]\">$liensrow[lien_1_txt]</a>";}
if ($liensrow[lien_1_type] == "site web"){echo "<a href=\"http://$liensrow[lien_1_cont]\" target=_blank>$liensrow[lien_1_txt]</a>";}
echo"</td>";
echo"</tr>";

echo"<tr>";
if  ($liensrow[lien_2_type] != "rien"){
echo"<td class=\"loginFFFFFF\" width=\"20%\" bordercolor=\"#000000\"> $liensrow[lien_2_type] </td>";
echo"<td class=\"loginFFFFFF\" width=\"80%\" bordercolor=\"#000000\" align=center>";
}
if ($liensrow[lien_2_type] == "auteur"){echo "$liensrow[lien_2_txt]";}
if ($liensrow[lien_2_type] == "mail"){echo "<a href=\"mailto:$liensrow[lien_2_cont]\">$liensrow[lien_2_txt]</a>";}
if ($liensrow[lien_2_type] == "site web"){echo "<a href=\"http://$liensrow[lien_2_cont]\" target=_blank>$liensrow[lien_1_txt]</a>";}
echo"</td>";
echo"</tr>";

echo"<tr>";
if  ($liensrow[lien_3_type] != "rien"){
echo"<td class=\"loginFFFFFF\" width=\"20%\" bordercolor=\"#000000\"> $liensrow[lien_3_type] </td>";
echo"<td class=\"loginFFFFFF\" width=\"80%\" bordercolor=\"#000000\">";
}
if ($liensrow[lien_3_type] == "auteur"){echo "$liensrow[lien_3_txt]";}
if ($liensrow[lien_3_type] == "mail"){echo "<a href=\"mailto:$liensrow[lien_3_cont]\">$liensrow[lien_3_txt]</a>";}
if ($liensrow[lien_3_type] == "site web"){echo "<a href=\"http://$liensrow[lien_3_cont]\" target=_blank>$liensrow[lien_3_txt]</a>";}
echo"</td>";
echo"</tr>";

echo"<tr>";
if  ($liensrow[lien_4_type] != "rien"){
echo"<td class=\"loginFFFFFF\" width=\"20%\" bordercolor=\"#000000\"> $liensrow[lien_4_type] </td>";
echo"<td class=\"loginFFFFFF\" width=\"80%\" bordercolor=\"#000000\">";
}
if ($liensrow[lien_4_type] == "auteur"){echo "$liensrow[lien_4_txt]";}
if ($liensrow[lien_4_type] == "mail"){echo "<a href=\"mailto:$liensrow[lien_4_cont]\">$liensrow[lien_4_txt]</a>";}
if ($liensrow[lien_4_type] == "site web"){echo "<a href=\"http://$liensrow[lien_4_cont]\" target=_blank>$liensrow[lien_4_txt]</a>";}
echo"</td>";
echo"</tr>";

echo"<tr>";
if  ($liensrow[lien_5_type] != "rien"){
echo"<td class=\"loginFFFFFF\" width=\"20%\" bordercolor=\"#000000\"> $liensrow[lien_5_type] </td>";
echo"<td class=\"loginFFFFFF\" width=\"80%\" bordercolor=\"#000000\">";
}
if ($liensrow[lien_5_type] == "auteur"){echo "$liensrow[lien_3_txt]";}
if ($liensrow[lien_5_type] == "mail"){echo "<a href=\"mailto:$liensrow[lien_5_cont]\">$liensrow[lien_5_txt]</a>";}
if ($liensrow[lien_5_type] == "site web"){echo "<a href=\"http://$liensrow[lien_5_cont]\" target=_blank>$liensrow[lien_5_txt]</a>";}
echo"</td>";
echo"</tr>";

}


/*---------------------------------------------
   la gestion des liens dans les news_courtes
---------------------------------------------*/
function liens_court($num){
$liens1 = DatabaseOperation::query("select * from articles where num_article = $num");
$nb=mysql_num_rows($liens1);

if(!$nb){
$liens1 = DatabaseOperation::query("select * from archives where num_article = $num");
}

//echo"select * from articles where num_article = $num";
/*$liensrow = mysql_fetch_array ($liens1);*/
$lien_1_type=mysql_result($liens1,0,lien_1_type);
$lien_1_txt=mysql_result($liens1,0,lien_1_txt);
$lien_1_cont=mysql_result($liens1,0,lien_1_cont);

$lien_2_type=mysql_result($liens1,0,lien_2_type);
$lien_2_txt=mysql_result($liens1,0,lien_2_txt);
$lien_2_cont=mysql_result($liens1,0,lien_2_cont);

$lien_3_type=mysql_result($liens1,0,lien_3_type);
$lien_3_txt=mysql_result($liens1,0,lien_3_txt);
$lien_3_cont=mysql_result($liens1,0,lien_3_cont);

/* alors les types sont les suivants :
1 - rien ; 2 - auteur (sans lien reprise article) ; 3 - auteur (mail) ; 4 - site net ; 5 - autre article */


if  ($lien_1_type != "rien"){
echo"<tr>";
echo"<td class=\"loginFFFFFF\" width=\"20%\" bordercolor=\"#000000\"> $lien_1_type </td>";
echo"<td class=\"loginFFFFFF\" width=\"80%\" bordercolor=\"#000000\">";
if ($lien_1_type == "auteur"){echo "$lien_1_txt";}
if ($lien_1_type == "mail"){echo "<a href=\"mailto:$lien_1_cont\">$lien_1_txt</a>";}
if ($lien_1_type == "site web"){echo "<a href=\"http://$lien_1_cont\" target=_blank>$lien_1_txt</a>";}
echo"</td>";
echo"</tr>";
}


if  ($lien_2_type != "rien"){
echo"<tr>";
echo"<td class=\"loginFFFFFF\" width=\"20%\" bordercolor=\"#000000\"> $lien_2_type </td>";
echo"<td class=\"loginFFFFFF\" width=\"80%\" bordercolor=\"#000000\" align=center>";
if ($lien_2_type == "auteur"){echo "$lien_2_txt";}
if ($lien_2_type == "mail"){echo "<a href=\"mailto:$lien_2_cont\">$lien_2_txt</a>";}
if ($lien_2_type == "site web"){echo "<a href=\"http://$lien_2_cont\" target=_blank>$lien_2_txt</a>";}
echo"</td>";
echo"</tr>";
}

if  ($lien_3_type != "rien"){
echo"<tr>";
echo"<td class=\"loginFFFFFF\" width=\"20%\" bordercolor=\"#000000\"> $lien_3_type </td>";
echo"<td class=\"loginFFFFFF\" width=\"80%\" bordercolor=\"#000000\" align=center>";
if ($lien_3_type == "auteur"){echo "$lien_3_txt";}
if ($lien_3_type == "mail"){echo "<a href=\"mailto:$lien_3_cont\">$lien_3_txt</a>";}
if ($lien_3_type == "site web"){echo "<a href=\"http://$lien_3_cont\" target=_blank>$lien_3_txt</a>";}
echo"</td>";
echo"</tr>";
}

}

/* Suppression d'un salarié de l'intranet */
function suppression_intranet_utilisateur($id_salaries)
{
  $req7="delete from modes where id_user='$id_salaries'";
  $result7=DatabaseOperation::query($req7);

  $req8="delete from lu where id_user='$id_salaries'";
  $result8=DatabaseOperation::query($req8);

  $req9="delete from droitft where id_user='$id_salaries'";
  $result9=DatabaseOperation::query($req9);

  $req10="delete from perso where id_user='$id_salaries'";
  $result10=DatabaseOperation::query($req10);

  $req11="delete from log where id_user='$id_salaries'";
  $result11=DatabaseOperation::query($req11);

  //$req12="update salaries set actif='non', login='nologin', pass='nopass' where id_user='$sal_user'";
  $req12="delete from salaries where id_user='$id_salaries'";
  $result12=DatabaseOperation::query($req12);

  $req13="delete from intranet_droits_acces where id_user='$id_salaries'";
  $result13=DatabaseOperation::query($req13);

  $req14="delete from planning_presence_detail where id_salaries='$id_salaries'";
  $result14=DatabaseOperation::query($req14);

}

?>