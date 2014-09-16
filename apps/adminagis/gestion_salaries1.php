<?php
/*
Include Agis
*/
//  include ('../lib/session.php');
//  include("../lib/functions.php");
require_once '../inc/main.php';

$html_table = "table "                     //Permet d'harmoniser les tableaux
               . "border=1 "
               . "width=100% "
               . "class=loginFFFFFFdroit "
               ;
/*
Fin de préparation Agis
*/

  identification1("salaries", $login, $pass);
  securadmin(4, $id_type);
//  include("functions.php");
//  include("functions.js");

  if ($erreur=="oui")
  {
    echo ("<script language=\"JavaScript\">\n");
    echo ("alert(\"Ce salarié existe déjà\")");
    echo ("</script>\n");
  }
  
    if ($erreur=="pass")
  {
    echo ("<script language=\"JavaScript\">\n");
    echo ("alert(\"Erreur de mot de passe\")");
    echo ("</script>\n");
  }

// Gestion des updates dans la table MODES
  if ($modifier=='modifier')
  {
// Requete pour lire tous les champs text nommes avec le numero du service
    $req="select distinct id_service from services order by id_service";
    $result=DatabaseOperation::query($req);
    if ($result!=false)
    {
      $num=mysql_num_rows($result);
      $i=0;
      while ($i<$num)
      {
// Recuperation du service et du niveau a affecter
        $service=mysql_result($result, $i, id_service);
        $toto="service";
        $text= $$toto;
        $niveau=$$text;
// Update dans la table pour chaque service
        $req2="update modes set serv_conf=$niveau where id_user='$sal_user' and id_service='$service'";
        $result2=DatabaseOperation::query($req2);
        if ($result==false)
          echo ("Update impossible pour le service $service pour le salarie $sal_user");
        $i++;
      }
    }
  }


?>
<html>
<head>
<title>Gestion des salari&eacute;s</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../lib/css/admin_intra01.css" type="text/css">
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

  ?>
<form name="salarie" method="post" action="gestion_salaries2.php">
  <table width="320" border="0" cellspacing="0" cellpadding="0"class="loginFFFFFFdroit" >
    <tr>
      <td >
        <table border="0" cellspacing="0" cellpadding="0" width="600">
          <tr>
            <td><img src="../images_pop/etape1_salaries.gif"></td>
            <td><img src="../images_pop/gestion_salaries.gif" width="500" height="62"></td>
            <td><a href="../aide.php#entreprise" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
          </tr>
        </table>
        <table width="620" border="0" cellspacing="0" cellpadding="0" align="center">

          <tr>
            <td><img src=../lib/images/espaceur.gif width="10" height="30"></td>
          </tr>
          <tr>
            <td>
              <div align="center"><img src="../images_pop/inser_sal.gif" width="500" height="30"></div>
            </td>
          </tr>
        </table>
        <img src=../lib/images/espaceur.gif width="10" height="10">
        </td>
      </tr>

<?php
  //Initialisation du Bloc HTML
  $bloc = "<tr><td><$html_table> ";

  //Date de création de l'utlisateur
  $bloc .="<tr><td align=right>"
        . mysql_field_desc("salaries", "date_creation_salaries")
        . "</td><td align=left><input type=text name=date_creation_salaries size=15  value="
        . date("Y-m-d"). " />"
        . "</td></tr>"
        ;

  //Association à un groupe d'utilisateur
  $nom_liste="ascendant_id_salaries";
  $liste = "<tr><td <td align=right>".mysql_field_desc("salaries", "$nom_liste")." ";
  $req_liste = "SELECT id_user, login "
         . "FROM salaries "
         . "ORDER BY login "
         ;
  $id_defaut=$$nom_liste;
  $liste .= "</td><td align=left>".afficher_requete_en_liste_deroulante($req_liste, $id_defaut, $nom_liste);
  $liste.= "</td></tr>";
  $bloc .=$liste;

  //Affichage
  echo $bloc."</table></td></tr>";
?>
        <table width="500" border="0" cellspacing="4" cellpadding="0" align="center">
            <tr>
            <td class="loginFFFFFFdroit" width="25%">Nom :</td>
            <td class="loginFFFFFFdroit" width="25%">
              <input type="text" name="sal_nom" size="15" class="loginFFFFFFdroit">
            </td>
            <td class="loginFFFFFFdroit" width="35%">Login : </td>
            <td class="loginFFFFFFdroit" width="45%" valign="middle">
              <div align="left">
                <input type="text" name="sal_login" size="15" class="txtfield">
              </div>
            </td>
            <td width="25%" class="loginFFCC66">&nbsp;</td>
          </tr>
          <tr>
            <td class="loginFFFFFFdroit" width="25%">Pr&eacute;nom :</td>
            <td class="loginFFFFFFdroit" width="25%">
              <input type="text" name="sal_prenom" size="15" class="loginFFFFFFdroit">
            </td>
            <td class="loginFFFFFFdroit" width="35%">Mot de passe : </td>
            <td class="loginFFFFFFdroit" width="45%" valign="middle">
              <div align="left">
                <input type="password" name="sal_pass" class="txtfield" size="15">
              </div>
            </td>
            <td class="loginFFCC66" width="25%">&nbsp;</td>
          </tr>
          <tr>
            <td class="loginFFFFFFdroit" width="25%">
              <div align="right">Mail :</div>
            </td>
            <td class="loginFFFFFF" width="25%">
            <div align="right">
                <input type="text" name="sal_mail" class="txtfield" size="19">
              </div>
              
            </td>
            <td class="loginFFFFFFdroit" width="35%">Confirmation :</td>
            <td class="loginFFFFFFdroit" width="45%" valign="middle">
            <div align="left">
                <input type="password" name="sal_pass2" class="txtfield" size="15">
              </div> 
            </td>
            <td width="25%">&nbsp; </td>
          </tr>
        </table>
        <table width="500" border="0" cellspacing="4" cellpadding="0" align="center">
          <tr>
            <td  class="loginFFFFFFdroit">
              <center><br>
                <span class="loginFFFFFFdroit">CSP</span> <br>
                <?php


    echo ("<select name=\"catsopro\">\n");
/* Constitution de la liste déroulante des noms des groupes*/
    $req="select id_catsopro, intitule_cat from catsopro order by id_catsopro";
    $result=DatabaseOperation::query($req);
    if ($result!= false)
    {
       while ($row=mysql_fetch_row($result))
       {
        echo ("<option value=\"$row[0]\">$row[1]</option>");
        }
    }

    echo ("</select>\n");

?>
              </center>
            </td>
            <td  class="loginFFFFFFdroit" colspan="2">
              <center><br>
                Service <br>
              <?php
    echo ("<select name=\"service\">\n");
/* Constitution de la liste déroulante des noms des groupes*/
    $req="select id_service, intitule_ser from services order by intitule_ser";
    $result=DatabaseOperation::query($req);
    if ($result!= false)
    {
      while ($row=mysql_fetch_row($result))
      {
        echo ("<option value=\"$row[0]\">$row[1]</option>");
      }
    }
    echo ("</select>\n");
?>
              </center>
            </td>
            <td  class="loginFFFFFFdroit">
              <center><br>
                Type<br>
                <?php


    echo ("<select name=\"sal_type\">\n");
/* Constitution de la liste déroulante des noms des groupes*/
    $req="select * from types";
    $result=DatabaseOperation::query($req);
    if ($result!= false)
    {
      while ($row=mysql_fetch_row($result))
      {
        echo ("<option value=\"$row[0]\">$row[1]</option>");
      }
    }
    echo ("</select>\n");
?>
              </center>
            </td>
            <td  class="loginFFFFFFdroit" colspan="2">
              <center>
                Droit d'&eacute;criture <?php

    $ecriture='oui';
    //echo ("test database = $mysql_database");
    echo ("<select name=\"ecriture\">".makeSelectList($mysql_database, 'salaries','ecriture')."</select>");

?>
              </center>
            </td>
          </tr>
        </table><br>
        <table width="500" border="1" cellspacing="1" cellpadding="3" align="center">

          <tr>
            <td class="logFFE5B2" colspan="8">
              <center>
                Fiches techniques - Fiche Identié Produit (FIP)
              </center>
            </td>
          </tr>

          <tr>
            <td class="loginFFFFFFdroit" valign="top" width="172">
              <center>
                Ecriture<br>
<?php
    echo ("<select name=\"ecritureft\">".makeSelectList($mysql_database, 'droitft','ecritureft')."</select>");
?>
              <br>
              </center>
            </td>

            <td class="loginFFFFFFdroit" valign="top" width="153">
              <center>
                Création FT<br>
<?php
    echo ("<select name=\"creation_ft\">".makeSelectListChecked($mysql_database, 'droitft','creation_ft', 'non')."</select>");
?>
              <br>
              </center>
            </td>

            <td class="loginFFFFFFdroit" valign="top" width="153">
              <center>
                Création FIP<br>
<?php
    echo ("<select name=\"creation_fiche_produit\">".makeSelectListChecked($mysql_database, 'droitft','creation_fiche_produit', 'non')."</select>");
?>
              <br>
              </center>
            </td>


            <td class="loginFFFFFFdroit" valign="top" width="153">
              <center>
                Lecture<br>
<?php
    echo ("<select name=\"lectureft\">".makeSelectList($mysql_database, 'droitft','lectureft')."</select>");
?>
              <br>
              </center>
            </td>

            <td class="loginFFFFFFdroit" valign="top" colspan="4" width="159">
              <center>
                Validation<br>
<?php
    echo ("<select name=\"validft\">".makeSelectList($mysql_database, 'droitft','validft')."</select>");
?>

              </center>
            </td>
          </tr>
        </table>

        <br>

        <table width="500" border="1" cellspacing="1" cellpadding="3" align="center">
          <tr>
            <td class="logFFE5B2">
              <center>
                statistiques
              </center>
            </td>
          </tr>
          <tr>
            <td class="loginFFFFFFdroit" valign="top" align="center">
            <center>
                Droit d'acc&egrave;s au module statistiques<br>
<?php
    echo ("<select name=\"droitstat\">".makeSelectList($mysql_database, 'droitft','droitstat')."</select>");
?>
            </center>
            </td>
          </tr>
        </table>

        <br>

        <table width="500" border="1" cellspacing="1" cellpadding="3" align="center">
          <tr>
            <td class="logFFE5B2" colspan="3">
              <center>
                Divers
              </center>
            </td>
          </tr>
          <tr>
            <td class="loginFFFFFFdroit" valign="top" width="172">
              <center>
                Ecriture News d&eacute;filante<br>
<?php
    echo ("<select name=\"newsdefil\">".makeSelectList($mysql_database, 'salaries','newsdefil')."</select>");
?>
              <br>
              </center>
            </td>
            <td class="loginFFFFFFdroit" valign="top" width="154">
              <center>
                Membre CE<br>
<?php
    echo ("<select name=\"membre_ce\">".makeSelectList($mysql_database, 'salaries','membre_ce')."</select>");
?>
              </center>
            </td>
            <td class="loginFFFFFFdroit" valign="top" width="158">
              <center>
                Localisation<br>
                <?php
    echo ("<select name=\"lieu_geo\">\n");
    /* Constitution de la liste déroulante des noms des groupes*/
    $req="select * from geo where site_actif = 1 order by geo";
    $result=DatabaseOperation::query($req);
    if ($result!= false)
    {
      while ($row=mysql_fetch_row($result))
      {
        echo ("<option value=\"$row[0]\">$row[1]</option>");
      }
    }
    echo ("</select>\n");

/*****************************************************
Construction des droits d'accès pour tous les modules:
****************************Boris Sanègre 2003.03.25*/
require ('droits_acces.inc');

// Fin de la page

echo "<center>";
echo "<a href=# onClick=nonvide();><img src=../zimages/valider-j.gif width=130 height=20 border=0 alt=`Enregistrement d'un salarié`></a>";
echo "<input type=hidden name=valider value=valider>";
echo "</center>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "</table>";
echo "</form>";

include ("../adminagis/cadrebas.php");
echo "</body>";
echo "</html>";

include ("../inc/footer.php");