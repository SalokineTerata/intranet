<?php
/* validation de la fin de saisie de l'article */

//  require("../lib/session.php");
//  include("functions.php");
      require_once '../inc/main.php';
      
$id_user=1;
$id_service="1_1";

  if ($mod=="mod")
  {
/* Modification de l'article */
/* Traitement de l'image car differente de la creation */
    if ($zone_4_type=='image')
    {
      if ($zone_4_lienfile!="")
      {
/* Traitement de l'image de la nouvelle image */
        $nomimgz4=$num_article."_6".substr($zone_4_lienfile, -4);
         if (!copy ($zone_4_lienfile, "../imgarticle/$nomimgz4"))
           echo ("probleme de copie de l'image\n");
        $zone_4_lien=$nomimgz4;
        $zone_4_info=$zone_4_infobulle;
        taille_image_350Y("../imgarticle/$nomimgz4", "../imgarticle/$nomimgz4");
      }
      else
      {
/* On recupere l'ancienne image */
       $req="select zone_4_lien from articles where num_article='$num_article'";
       $result=DatabaseOperation::query($req);
       $zone_4_lien=mysql_result($result, 0, zone_4_lien);
echo ("req update= $req<br>");
      }
    }
  }
  else
  {
/* Fin de l'enregistrement d'un article */
    if ($zone_4_type=='image')
    {
/* Traitement de l'image */
      $nomimgz4=$num_article."_6".substr($zone_4_lienfile, -4);
echo ("nomimgz4=$nomimgz4<br>");
      if (!copy ($zone_4_lienfile, "../imgarticle/$nomimgz4"))
        echo ("probleme de copie de l'image\n");
      $zone_4_lien=$nomimgz4;
      $zone_4_info=$zone_4_infobulle;
      taille_image_350Y("../imgarticle/$nomimgz4", "../imgarticle/$nomimgz4");
    }
  }

  if ($zone_4_type=='rien')
  {
    $zone_4_lien=null;
    $zone_4_info=null;
  }

/* Gestion des caracteres */
  $zone_4_type=addslashes($zone_4_type);
  $zone_4_info=addslashes($zone_4_info);
  $zone_4_justif=addslashes($zone_4_justif);
  $zone_4_lien=addslashes($zone_4_lien);
  $lien_1_cont=addslashes($lien_1_cont);
  $lien_1_txt=addslashes($lien_1_txt);
  $lien_2_cont=addslashes($lien_2_cont);
  $lien_2_txt=addslashes($lien_2_txt);
  $lien_3_cont=addslashes($lien_3_cont);
  $lien_3_txt=addslashes($lien_3_txt);
  $lien_4_cont=addslashes($lien_4_cont);
  $lien_4_txt=addslashes($lien_4_txt);
  $lien_5_cont=addslashes($lien_5_cont);
  $lien_5_txt=addslashes($lien_5_txt);

  $req="update articles set zone_4_type='$zone_4_type', zone_4_info='$zone_4_info', zone_2_justif='$zone_4_justif',
  zone_4_lien='$zone_4_lien', lien_1_type='$lien_1_type', lien_1_cont='$lien_1_cont', lien_1_txt='$lien_1_txt',
  lien_2_type='$lien_2_type', lien_2_cont='$lien_2_cont', lien_2_txt='$lien_2_txt',
  lien_3_type='$lien_3_type', lien_3_cont='$lien_3_cont', lien_3_txt='$lien_3_txt',
  lien_4_type='$lien_4_type', lien_4_cont='$lien_4_cont', lien_4_txt='$lien_4_txt',
  lien_5_type='$lien_5_type', lien_5_cont='$lien_5_cont', lien_5_txt='$lien_5_txt'
  where num_article='$num_article'";
echo ("req=$req<br>");
  $result=DatabaseOperation::query($req);
  if ($result == false)
    echo ("Il y a un probl&eacuteme d'update dans la table ARTICLES");

/* Effacement dans la table lu */
  $req="delete from lu where id_art='$num_article'";
  $result=DatabaseOperation::query($req);
?>

<html>
<body>
</body>
</html>