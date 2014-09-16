<?php
//  require("../lib/session.php");
//  include("functions.php");
//  include("../lib/functions.php");
      require_once '../inc/main.php';

identification1("salaries", $login, $pass);

//echo"lettre old :$lettreold<br>";  
  
  
if ($inserer=='inserer')
{
/* Insertion dans la table geo */
    if ($geo!='')
    {
      $geo=addslashes($geo);
      $lettre=strtoupper($lettre);
      // verification existence lettre
      $req="select * from geo where lettre='$lettrenew'";
      $result=DatabaseOperation::query($req);
      $nb=mysql_num_rows($result);
      
      if(!$nb){
      $req="insert into geo (geo,lettre) values ('$geo','$lettrenew')";
      $result=DatabaseOperation::query($req);
      }
    }
  }

if ($modifier=='modifier')
{
/* Insertion dans la table geo */
    if ($geo!='')
    {
      $geo=addslashes($geo);
      $lettrenew=strtoupper($lettrenew);
      // verification existence lettre
      $req="select * from geo where lettre='$lettrenew' and geo!='$geo'";
      $result=DatabaseOperation::query($req);
      $nb=mysql_num_rows($result);
      
      if(!$nb){
      $req="update geo set geo='$geo' ,lettre='$lettrenew' where id_geo=$id_geo";
//echo"$req";
      $result=DatabaseOperation::query($req);

// mise a jour de toutes les fiches techniques concernées par l'ancienne lettre
// pour une table ... infog, ingogv X 17

//table infog------------------------    
    $req2="select * from infog where numft like '%%%%%%$lettreold%%'";
    //echo"$req2";
    $result2=DatabaseOperation::query($req2);
    $nb2=mysql_num_rows($result2);
    
    if($nb2){
      while($rows=mysql_fetch_array($result2)){
      $numftnew= eregi_replace("$lettreold", "$lettrenew", $rows[numft]);
      $req3="update infog set numft='$numftnew' where numft='$rows[numft]'";
      $result3=DatabaseOperation::query($req3);
      //echo"$req3";
      }
     }

//table infogv----------------------
    $req2="select * from infogv where numft like '%%%%%%$lettreold%%'";
    //echo"$req2";
    $result2=DatabaseOperation::query($req2);
    $nb2=mysql_num_rows($result2);
    
    if($nb2){
      while($rows=mysql_fetch_array($result2)){
      $numftnew= eregi_replace("$lettreold", "$lettrenew", $rows[numft]);
      $req3="update infogv set numft='$numftnew' where numft='$rows[numft]'";
      //echo"$req3";
      $result3=DatabaseOperation::query($req3);      
      }
    }

//table infoga------------------------    
    $req2="select * from infoga where numft like '%%%%%%$lettreold%%'";
    //echo"$req2";
    $result2=DatabaseOperation::query($req2);
    $nb2=mysql_num_rows($result2);
    
    if($nb2){
      while($rows=mysql_fetch_array($result2)){
      $numftnew= eregi_replace("$lettreold", "$lettrenew", $rows[numft]);
      $req3="update infoga set numft='$numftnew' where numft='$rows[numft]'";
      $result3=DatabaseOperation::query($req3);
      //echo"$req3";
      }
     }

//table compos----------------------
    $req2="select * from compos where numft like '%%%%%%$lettreold%%'";
    //echo"$req2";
    $result2=DatabaseOperation::query($req2);
    $nb2=mysql_num_rows($result2);
    
    if($nb2){
      while($rows=mysql_fetch_array($result2)){
      $numftnew= eregi_replace("$lettreold", "$lettrenew", $rows[numft]);
      $req3="update compos set numft='$numftnew' where numft='$rows[numft]'";
      //echo"$req3";
      $result3=DatabaseOperation::query($req3);
      }
    }    
    
//table composa------------------------    
    $req2="select * from composa where numft like '%%%%%%$lettreold%%'";
    //echo"$req2";
    $result2=DatabaseOperation::query($req2);
    $nb2=mysql_num_rows($result2);
    
    if($nb2){
      while($rows=mysql_fetch_array($result2)){
      $numftnew= eregi_replace("$lettreold", "$lettrenew", $rows[numft]);
      $req3="update composa set numft='$numftnew' where numft='$rows[numft]'";
      //echo"$req3";
      $result3=DatabaseOperation::query($req3);
      }
     }

//table composv----------------------
    $req2="select * from composv where numft like '%%%%%%$lettreold%%'";
    //echo"$req2";
    $result2=DatabaseOperation::query($req2);
    $nb2=mysql_num_rows($result2);
    
    if($nb2){
      while($rows=mysql_fetch_array($result2)){
      $numftnew= eregi_replace("$lettreold", "$lettrenew", $rows[numft]);
      $req3="update composv set numft='$numftnew' where numft='$rows[numft]'";
      //echo"$req3";
      $result3=DatabaseOperation::query($req3);
      }
    }

//table conserv------------------------    
    $req2="select * from conserv where numft like '%%%%%%$lettreold%%'";
    //echo"$req2";
    $result2=DatabaseOperation::query($req2);
    $nb2=mysql_num_rows($result2);
    
    if($nb2){
      while($rows=mysql_fetch_array($result2)){
      $numftnew= eregi_replace("$lettreold", "$lettrenew", $rows[numft]);
      $req3="update conserv set numft='$numftnew' where numft='$rows[numft]'";
      //echo"$req3";
      $result3=DatabaseOperation::query($req3);
      }
     }

//table conserva----------------------
    $req2="select * from conserva where numft like '%%%%%%$lettreold%%'";
    //echo"$req2";
    $result2=DatabaseOperation::query($req2);
    $nb2=mysql_num_rows($result2);
    
    if($nb2){
      while($rows=mysql_fetch_array($result2)){
      $numftnew= eregi_replace("$lettreold", "$lettrenew", $rows[numft]);
      $req3="update conserva set numft='$numftnew' where numft='$rows[numft]'";
      //echo"$req3";
      $result3=DatabaseOperation::query($req3);
      }
    }        
    
//table conservv------------------------    
    $req2="select * from conservv where numft like '%%%%%%$lettreold%%'";
    //echo"$req2";
    $result2=DatabaseOperation::query($req2);
    $nb2=mysql_num_rows($result2);
    
    if($nb2){
      while($rows=mysql_fetch_array($result2)){
      $numftnew= eregi_replace("$lettreold", "$lettrenew", $rows[numft]);
      $req3="update conservv set numft='$numftnew' where numft='$rows[numft]'";
      //echo"$req3";
      $result3=DatabaseOperation::query($req3);
      }
     }

//table divers----------------------
    $req2="select * from divers where numft like '%%%%%%$lettreold%%'";
    //echo"$req2";
    $result2=DatabaseOperation::query($req2);
    $nb2=mysql_num_rows($result2);
    
    if($nb2){
      while($rows=mysql_fetch_array($result2)){
      $numftnew= eregi_replace("$lettreold", "$lettrenew", $rows[numft]);
      $req3="update divers set numft='$numftnew' where numft='$rows[numft]'";
      //echo"$req3";
      $result3=DatabaseOperation::query($req3);
      }
    }

//table diversa------------------------    
    $req2="select * from diversa where numft like '%%%%%%$lettreold%%'";
    //echo"$req2";
    $result2=DatabaseOperation::query($req2);
    $nb2=mysql_num_rows($result2);
    
    if($nb2){
      while($rows=mysql_fetch_array($result2)){
      $numftnew= eregi_replace("$lettreold", "$lettrenew", $rows[numft]);
      $req3="update diversa set numft='$numftnew' where numft='$rows[numft]'";
      //echo"$req3";
      $result3=DatabaseOperation::query($req3);
      }
     }

//table diversv----------------------
    $req2="select * from diversv where numft like '%%%%%%$lettreold%%'";
    //echo"$req2";
    $result2=DatabaseOperation::query($req2);
    $nb2=mysql_num_rows($result2);
    
    if($nb2){
      while($rows=mysql_fetch_array($result2)){
      $numftnew= eregi_replace("$lettreold", "$lettrenew", $rows[numft]);
      $req3="update diversv set numft='$numftnew' where numft='$rows[numft]'";
      //echo"$req3";
      $result3=DatabaseOperation::query($req3);
      }
    }    
    
//table palet------------------------    
    $req2="select * from palet where numft like '%%%%%%$lettreold%%'";
    //echo"$req2";
    $result2=DatabaseOperation::query($req2);
    $nb2=mysql_num_rows($result2);
    
    if($nb2){
      while($rows=mysql_fetch_array($result2)){
      $numftnew= eregi_replace("$lettreold", "$lettrenew", $rows[numft]);
      $req3="update palet set numft='$numftnew' where numft='$rows[numft]'";
      //echo"$req3";
      $result3=DatabaseOperation::query($req3);
      }
     }

//table palet----------------------
    $req2="select * from paleta where numft like '%%%%%%$lettreold%%'";
    //echo"$req2";
    $result2=DatabaseOperation::query($req2);
    $nb2=mysql_num_rows($result2);
    
    if($nb2){
      while($rows=mysql_fetch_array($result2)){
      $numftnew= eregi_replace("$lettreold", "$lettrenew", $rows[numft]);
      $req3="update paleta set numft='$numftnew' where numft='$rows[numft]'";
      //echo"$req3";
      $result3=DatabaseOperation::query($req3);
      }
    }

//table paletv------------------------    
    $req2="select * from paletv where numft like '%%%%%%$lettreold%%'";
    //echo"$req2";
    $result2=DatabaseOperation::query($req2);
    $nb2=mysql_num_rows($result2);
    
    if($nb2){
      while($rows=mysql_fetch_array($result2)){
      $numftnew= eregi_replace("$lettreold", "$lettrenew", $rows[numft]);
      $req3="update paletv set numft='$numftnew' where numft='$rows[numft]'";
      //echo"$req3";
      $result3=DatabaseOperation::query($req3);
      }
     }

//table valft----------------------
    $req2="select * from valft where numft like '%%%%%%$lettreold%%'";
    //echo"$req2";
    $result2=DatabaseOperation::query($req2);
    $nb2=mysql_num_rows($result2);
    
    if($nb2){
      while($rows=mysql_fetch_array($result2)){
      $numftnew= eregi_replace("$lettreold", "$lettrenew", $rows[numft]);
      $req3="update valft set numft='$numftnew' where numft='$rows[numft]'";
      //echo"$req3";
      $result3=DatabaseOperation::query($req3);
      }
    }        
    
    

      }
    }
  }



?>
<html>
<head>
<title>Gestion des services</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../lib/css/admin_intra01.css" type="text/css">
<link rel="stylesheet" href="../lib/css/admin_newsentrep.css" type="text/css">
<link rel="stylesheet" href="admin_INTRANET_AGIS/newsgeneral.css" type="text/css">
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
<?php
  include ("cadrehautent.php");

  echo ("<form method=\"post\" action=\"$PHP_SELF\">\n");
?>
<table width="620" border="0" cellspacing="0" cellpadding="0" align="left" height="133">
  <tr>
    <td>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src=../lib/images/bandeau_etape0.gif width="90" height="62"></td>
          <td><img src="../images_pop/gestion_geo.gif" width="500" height="62"></td>
          <td><a href="../aide.php#entreprise" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
      <img src=../lib/images/espaceur.gif width="10" height="20">

<?php 
if(!$affichage){
?>
      <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td class="LOGINFFFFFFCENTRE">Situation g&eacute;ographique
            <input type="text" name="geo" class="txtfield">
          </td>
          </tr>
          <tr>
          <td class="LOGINFFFFFFCENTRE">Lettre pour fiches techniques
            <input type="text" name="lettre" class="txtfield" maxlength="2" size="2">
          </td>          
        </tr>
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="10"></td>
        </tr>
        <tr>
          <td>
            <div align="center"><input type="image" src="../zimages/valider-j.gif" width="130" height="20"></div>
            <INPUT TYPE="HIDDEN"  name="inserer" value="inserer">
          </td>
        </tr>
      </table>
<?php
}
?>
<?php 
if($affichage=="modification"){
?>
      <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td class="LOGINFFFFFFCENTRE">Situation g&eacute;ographique
            <input type="text" name="geo" class="txtfield" value="<?php $geo=stripslashes($geo);echo"$geo"; ?>">
          </td>
          </tr>
          <tr>
          <td class="LOGINFFFFFFCENTRE">Lettre pour fiches techniques
            <input type="text" name="lettrenew" class="txtfield" maxlength="2" size="2" value="<?php echo"$lettre"; ?>">
          </td>          
        </tr>
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="10"></td>
        </tr>
        <tr>
          <td>
            <div align="center"><input type="image" src="../zimages/valider-j.gif" width="130" height="20"></div>
            <INPUT TYPE="HIDDEN"  name="lettreold" value="<?php echo"$lettre"; ?>">
            <INPUT TYPE="HIDDEN"  name="id_geo" value="<?php echo"$id_geo"; ?>">
            <INPUT TYPE="HIDDEN"  name="modifier" value="modifier">
          </td>
        </tr>
      </table>
<?php
}
?>
     <br><br><table width="550" border="1" cellspacing="0" cellpadding="0" align="center" class="loginFFCC66">
        <tr>
          <td width="10%">
            <center>
              <img src=../lib/images/espaceur.gif width="10" height="10">Lieu g&eacute;ographique
            </center>
          </td>
          <td width="10%">
            <center>
              <img src=../lib/images/espaceur.gif width="10" height="10">Lettre
            </center>
          </td>        
          <td width="10%">
            <center>
              <img src=../lib/images/espaceur.gif width="10" height="10">action
            </center>
          </td>            
        </tr>
        <tr>
          <td width="10%">&nbsp;</td>
          <td width="10%">&nbsp;</td>
          <td width="10%">&nbsp;</td>        
        </tr>

<?php
/* Affichage du contenu de la table GEO */
  $req="select * from geo order by geo";
  $result=DatabaseOperation::query($req);
  $num=mysql_num_rows($result);
  if ($num!=0)
  {
    $i=0;
    while ($i<$num)
    {
      $id_geo=mysql_result($result, $i, id_geo);    
      $geo=mysql_result($result, $i, geo);
      $lettre=mysql_result($result, $i, lettre);      
      $geo=stripslashes($geo);
      echo ("  <tr>\n");
      echo ("    <td width=\"10%\">\n");
      echo ("      <center>\n");
      echo ("        &nbsp;$geo\n");
      echo ("      </center>\n");
      echo ("    </td>\n");
      echo ("    <td width=\"10%\">\n");
      echo ("      <center>\n");
      echo ("        &nbsp;$lettre\n");
      echo ("      </center>\n");
      echo ("    </td>\n");
      echo ("    <td width=\"10%\">\n");
      echo ("      <center>\n");
      echo ("        <a href=\"$PHP_SELF?affichage=modification&id_geo=$id_geo&geo=$geo&lettre=$lettre\">modifier</a>\n");
      echo ("      </center>\n");
      echo ("    </td>\n");      
      echo ("  </tr>\n");
      $i++;
    }
  }
?>
      </table>
    </td>
  </tr>
</table>
</form>
<?php  include ("../adminagis/cadrebas.php"); ?>
</body>
</html>