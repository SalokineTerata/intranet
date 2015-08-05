<?php
//  require("../lib/session.php");
//  include("functions.php");
//  include("../lib/functions.php");
require_once '../inc/main.php';
$globalConfig = new GlobalConfig();
$login = $globalConfig->getAuthenticatedUser()->getKeyValue();
$id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();
$idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
$userLogin = $globalConfig->getAuthenticatedUser()->getKeyValue();
$pass = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_PASSWORD)->getFieldValue();
$userNom = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_NOM)->getFieldValue();
$userPrenom = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_PRENOM)->getFieldValue();
$id_type = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_ID_TYPE)->getFieldValue();
$userCatsopro = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_ID_CATSOPRO)->getFieldValue();
$userService = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_ID_SERVICE)->getFieldValue();
$dateCreationUser = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_DATE_CREATION_SALARIES)->getFieldValue();
$ascendantIdSalaries = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_ASENDANT_ID_SALARIES)->getFieldValue();
$newsDefil = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_NEWSDEFIL)->getFieldValue();
$newLieuGeo = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_LIEU_GEO)->getFieldValue();
$membreCe = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_MEMBRE_CE)->getFieldValue();
$ecriture = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_ECRITURE)->getFieldValue();
$userMail = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_MAIL)->getFieldValue();
$modifier= Lib::getParameterFromRequest("modifier");
  identification1("salaries", $login, $pass);
  securadmin(4, $id_type);

  if ($valider == 'valider')
  {

    if ($sal_pass != $sal_pass2)
    {
      header("location:gestion_salaries1.php?erreur=pass");
      
    }


/* Insertion dans la table SALARIES*/
    $userNom=strtoupper($userNom);
    $userNom=addslashes($userNom);
    $userPrenom=addslashes($userPrenom);

    $req="select * from salaries where nom='$userNom' and prenom='$userPrenom'
    and mail='$userMail' and id_type='$sal_type' and actif='oui'";
    $result=DatabaseOperation::query($req);
    $num=mysql_num_rows($result);
    if ($num != 0)
    {
      header("location:gestion_salaries1.php?erreur=oui");
    }
    else
    {
//echo "$date_creation_salaries";
      $req="insert into salaries (nom, prenom, ascendant_id_salaries, date_creation_salaries, id_catsopro, id_service, id_type, login, pass, mail,
      ecriture, membre_ce, lieu_geo, newsdefil)
      values ('$userNom', '$userPrenom', '$ascendantIdSalaries', '$dateCreationUser', '$catsopro', '$service', '$sal_type', '$userLogin', PASSWORD('$sal_pass'),
      '$userMail', '$ecriture', '$membreCe', '$lieu_geo', '$newsDefil')";
//echo"$req";
      $result=DatabaseOperation::query($req);
      if ($result == false)
        echo ("L'insertion dans la table SALARIES n'a pas reussie");

/* Recherche de l'id du nouveau salarie*/
//      $req="select id_user from salaries where nom='$sal_nom' and prenom='$sal_prenom'
//      and login='$sal_login' and id_catsopro='$catsopro' and id_service='$service'
//      and id_type='$sal_type' and mail='$sal_mail'";
    $req="select id_user from salaries where login='$userLogin' ";

      $result=DatabaseOperation::query($req);
      if ($result== false)
        echo ("La requete de recherche de l'ID salarie a echoue");
      else
        $idUser=mysql_result($result, 0, id_user);

/********************************************
Insertion des droits d'accès de l'utilisateur
*******************Boris Sanègre 2003.03.28*

//Recherche des modules de l'intranet
$req_modules = "SELECT * FROM intranet_modules";
$result_modules=DatabaseOperation::query($req_modules);
while ($rows_modules=mysql_fetch_array($result_modules))
{
      //Création des variables necessaires
      $id_intranet_modules=$rows_modules[id_intranet_modules];

      //Recherche des actions de l'intranet
      $req_actions = "SELECT * FROM intranet_actions";
      $result_actions=DatabaseOperation::query($req_actions);
      while ($rows_actions=mysql_fetch_array($result_actions))
      {
            //Création des variables necessaires
            $id_intranet_actions=$rows_actions[id_intranet_actions];
            $txt1="module".$id_intranet_modules."_action".$id_intranet_actions;
            $nom_niveau_intranet_droits_acces="$txt1";
            $niveau_intranet_droits_acces=$$nom_niveau_intranet_droits_acces;

            //Insertion du droit d'accès
            $req_droits_acces = "INSERT INTO intranet_droits_acces (";
            $req_droits_acces.= "id_intranet_modules, ";
            $req_droits_acces.= "id_user, ";
            $req_droits_acces.= "id_intranet_actions, ";
            $req_droits_acces.= "niveau_intranet_droits_acces) ";
            $req_droits_acces.= "VALUES (";
            $req_droits_acces.= "$id_intranet_modules, ";
            $req_droits_acces.= "$sal_user, ";
            $req_droits_acces.= "$id_intranet_actions, ";
            $req_droits_acces.= "$niveau_intranet_droits_acces) ";
            $result_droits_acces=DatabaseOperation::query($req_droits_acces);
      }
}
*/



/* Insertion des droits pour les fiches techniques */
//      $req="insert into droitft (id_user, lectureft, ecritureft, creation_ft, creation_fiche_produit, validft, droitstat) values ('$sal_user', '$lectureft', '$ecritureft', '$creation_ft', '$creation_fiche_produit','$validft', '$droitstat')";
//      $result=DatabaseOperation::query($req);
//      if ($result == false)
//        echo ("L'insertion dans la table DROITFT n'a pas reussie");
    }
    /* Recuperation des données pour affichage */
    $req="select * from salaries where id_user='$idUser'";
    $result=DatabaseOperation::query($req);
    if ($result != false)
    {
      $userNom=mysql_result($result, 0, nom);
      $userPrenom=mysql_result($result, 0, prenom);
      $id_catsopro=mysql_result($result, 0, id_catsopro);
      $id_service=mysql_result($result, 0, id_service);
      $sal_type=mysql_result($result, 0, id_type);
      $userLogin=mysql_result($result, 0, login);
      $sal_pass=mysql_result($result, 0, pass);
      $userMail=mysql_result($result, 0, mail);
      $ecriture==mysql_result($result, 0, ecriture);
      $newsDefil==mysql_result($result, 0, newsdefil);
      $membreCe==mysql_result($result, 0, membre_ce);
      $lieu_geo==mysql_result($result, 0, lieu_geo);
      $userNom=stripslashes($userNom);
      $userPrenom=stripslashes($userPrenom);
    }

//    $req="select * from droitft where id_user='$sal_user'";
//    $result=DatabaseOperation::query($req);
//    if ($result== false)
//      echo ("La requete de recherche de l'ID salarie a echoue");
//    else
//    {
//      $ecritureft==mysql_result($result, 0, ecritureft);
//      $creation_ft==mysql_result($result, 0, creation_ft);
//      $creation_fiche_produit==mysql_result($result, 0, creation_fiche_produit);
//      $lectureft==mysql_result($result, 0, lectureft);
//      $validft==mysql_result($result, 0, validft);
//      $droitstat==mysql_result($result, 0, droitstat);
//    }


    /* recherche des niveaux de references dans la table CATSOPRO*/
    $req="select * from catsopro where id_catsopro='$id_catsopro'";
    $result=DatabaseOperation::query($req);
    if ($result== false)
      echo ("La requete de recherche des niveaux de reference a echoue");
    else
    {
      $nivo_glo=mysql_result($result, 0, nivo_glo);
      $nivo_pro=mysql_result($result, 0, nivo_pro);
    }

    /* Insertions dans la table MODES via la table de reference CATSOPRO*/
//    $req="insert into modes (id_user, id_service, serv_conf)
//    values ('$sal_user', '$service', '$nivo_pro')";
//    $result=DatabaseOperation::query($req);
//
//    if ($result== false)
//      echo ("L'insertion dans la table MODES non reussie");

    /* Parcours de la table service (exclu le service du salarie) pour inserer les autres modes*/
//    $req="select distinct id_service from services where id_service <> '$service'";
//    $result=DatabaseOperation::query($req);
//    if ($result != false)
//    {
//      $num=mysql_num_rows($result);
//      $i=0;
//      while ($i<$num)
//      {
//        /* Pour chaque service on insere dans la table*/
//        $service=mysql_result($result, $i, id_service);
//        $req2="insert into modes (id_user, id_service, serv_conf)
//        values ('$sal_user', '$service', '$nivo_glo')";
//        $result2=DatabaseOperation::query($req2);
//        $i++;
//      }
//    }
  }
    /* Quand un salarie est cree, envoi d'un mail pour lui donner son profil */
  $sujet="Inscription Intranet Agis";
  $corpsmail="Bonjour,\n";
  $corpsmail.="Votre profil vient d'être créé dans l'intranet AGIS.\n";
  $corpsmail.="Votre login est : $userLogin\n";
  //$corpsmail.="Votre mot de passe est : $sal_pass\n";
  $corpsmail.="\nL'administrateur Agis.\n";

  //envoi_mail($corpsmail, 'postmaster@agis-sa.fr', $sal_mail, $sujet);
  //envoismail($sujet, $corpsmail, 'postmaster@agis-sa.fr', $sal_mail);
  envoismail($sujet, $corpsmail, $userMail, 'postmaster@agis-sa.fr');
?>
<html>
<head>
<title>Gestion des salari&eacute;s</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../lib/css/intra01.css" type="text/css">
<script language="JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
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
<link rel="stylesheet" href="../lib/css/admin_intra01.css" type="text/css">
<link rel="stylesheet" href=../lib/css/admin_newspopup.css type="text/css">
</head>

<body onLoad="StartTimer(<?php $time=timeout($id_user); echo "$time"; ?>)" bgcolor="#FFCC66" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php
include ("cadrehautent.php");
  ?>
<form name="salarie" method="post" action="gestion_salaries1.php">
<table width="620" border="0" cellspacing="0" cellpadding="0" height="178">
  <tr>
    <td>
      <table border="0" cellspacing="0" cellpadding="0" width="600">
        <tr>
          <td><img src="../images_pop/etape2_salaries.gif" height="62"></td>
          <td><img src="../images_pop/gestion_salaries.gif" height="62"></td>
          <td><a href="../aide.php#entreprise" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="loginFFFFFF">
            <div align="center"><img src=../lib/images/espaceur.gif width="10" height="20">
                <table width="500" border="0" cellspacing="4" cellpadding="0" align="center">
                  <tr>
                    <td class="loginFFCC66droit" width="20%"><b>Nom :</b></td>
                    <td class="loginFFCC66" width="35%">
                      <?php
  echo ("$userNom");
?>
                    </td>
                    <td class="loginFFCC66droit" width="33%"><b>Login :<b></td>
                    <td class="loginFFCC66" width="53%">
                      <?php
  echo ("$userLogin");
?>
                    </td>
                    <td width="15%" class="loginFFCC66">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="loginFFCC66droit" width="20%"><b>Pr&eacute;nom :</b></td>
                    <td class="loginFFCC66" width="35%">
                      <?php
  echo ("$userPrenom");
?>
                    </td>
                    <td class="loginFFCC66droit" width="33%"><b>&nbsp;</b></td>
                    <td class="loginFFCC66" width="53%">&nbsp;</td>
                    <td class="loginFFCC66" width="15%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="loginFFFFFFdroit" width="20%">
                      <div align="center"></div>
                    </td>
                    <td class="loginFFFFFF" width="35%">
                      <div align="right"> </div>
                    </td>
                    <td class="loginFFCC66droit" width="33%"><b>Mail :</b></td>
                    <td class="loginFFCC66" width="53%">
                      <?php
  echo ("$userMail");
?>
                    </td>
                    <td width="15%">&nbsp; </td>
                  </tr>
                </table>
                <table width="500" border="1" cellspacing="2" cellpadding="0" align="center">
                  <tr>
                    <td  class="loginFFFFFFCENTRE"><b>CSP</b> </td>
                    <td  class="loginFFFFFFCENTRE"><b>Service</b> </td>
                    <td  class="loginFFFFFFCENTRE"><b>Type</b></td>
                    <td  class="loginFFFFFFCENTRE"><b>Droit d'&eacute;criture</b> </td>
                  </tr>
                  <tr>
                    <td  class="loginFFCC66" height="22">
                      <center>
                        <p>
                          <?php
/* affichage de l'intitule de la CSP */
    $req="select * from catsopro where id_catsopro='$id_catsopro'";
    $result=DatabaseOperation::query($req);
    if ($result!= false)
    {
      $intitule_cat=mysql_result($result, 0, intitule_cat);
      $intitule_cat=stripslashes($intitule_cat);
      echo ("$intitule_cat\n");
    }
?>
                        </p>
                      </center>
                    </td>
                    <td  class="loginFFCC66" height="22">
                      <center>
                        <p>
                          <?php
/* affichage de l'intitule du service */
    $req="select * from services where id_service='$id_service'";
    $result=DatabaseOperation::query($req);
    if ($result!= false)
    {
      $intitule_ser=mysql_result($result, 0, intitule_ser);
      $intitule_ser=stripslashes($intitule_ser);
      echo ("$intitule_ser\n");
    }
?>
                        </p>
                      </center>
                    </td>
                    <td  class="loginFFCC66" height="22">
                      <center>
                        <p>
                          <?php
/* affichage de l'intitule du service */
    $req="select * from types where id_type='$sal_type'";
    $result=DatabaseOperation::query($req);
    if ($result!= false)
    {
      $intitule_typ=mysql_result($result, 0, intitule_typ);
      $intitule_typ=stripslashes($intitule_typ);
      echo ("$intitule_typ\n");
    }
?>
                        </p>
                      </center>
                    </td>
                    <td  class="loginFFCC66" height="22">
                      <center>
                        <p>
                          <?php
  echo ("$ecriture");
?>
                        </p>
                      </center>
                    </td>
                  </tr>
                </table>
                <table width="500" border="1" cellspacing="2" cellpadding="0" align="center">

                  <tr>

                    <td class="loginFFFFFFdroit" colspan="6">

                      <center>
                Fiches techniques

                      </center>
                    </td>
                  </tr>

                  <tr>

                    <td class="loginFFFFFFdroit" valign="top" width="172">

                      <center>
                Ecriture<br>
<?php
    echo ("$ecritureft");
?>
              <br>

                      </center>
                    </td>
                    <td class="loginFFFFFFdroit" valign="top" width="153">

                      <center>
                Lecture<br>
<?php
    echo ("$lectureft");
?>
              <br>

                      </center>
                    </td>
                    <td class="loginFFFFFFdroit" valign="top" colspan="4" width="159">

                      <center>
                Validation<br>
<?php
    echo ("$validft");
?>

                      </center>
                    </td>
                  </tr>

                </table>
                <table width="500" border="1" cellspacing="2" cellpadding="0" align="center">


                  <tr>


                    <td class="loginFFFFFFdroit" colspan="3">


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
    echo ("$newsDefil");
?>
              <br>


                      </center>
                    </td>
                    <td class="loginFFFFFFdroit" valign="top" width="154">


                      <center>
                Membre CE<br>
<?php
    echo ("$membreCe");
?>



                      </center>
                    </td>
                    <td class="loginFFFFFFdroit" valign="top" width="158">


                      <center>
                Localisation<br>
<?php
  $req="select geo from geo where id_geo='$lieu_geo'";
  $result=DatabaseOperation::query($req);
  if ($result != false)
    $geo=mysql_result($result, 0, geo);
  echo ("$geo");



/********************************************
Insertion des droits d'accès de l'utilisateur
*******************Boris Sanègre 2003.03.28*/

echo "<br>";
echo "</center>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</div>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<br>";
echo "</td>";
echo "</tr>";

$req_modules = "SELECT * FROM intranet_modules ";
$req_modules.= "ORDER BY nom_usuel_intranet_modules ASC";
$result_modules = DatabaseOperation::query($req_modules);
while ($rows_modules=mysql_fetch_array($result_modules))
{
    //Préparation des variables
    $nom_usuel_intranet_modules=$rows_modules[nom_usuel_intranet_modules];
    $id_intranet_modules=$rows_modules[id_intranet_modules];


    //Construction du tableau
//    echo "<br>";
//    echo "<table width=500 border=1 cellspacing=1 cellpadding=3 align=center>";
//
//    // Nom du module
//    echo "<tr>";
//    echo "<td class=logFFE5B2 colspan=3>";
//    echo "<center>";
//    echo $nom_usuel_intranet_modules;
//    echo "</center>";
//    echo "</td>";
//    echo "</tr>";

    //Droits d'accès du module

    //Recherche des droits d'accès
    $req_actions = "SELECT DISTINCT * ";
    $req_actions.= "FROM intranet_modules, intranet_actions ";
    $req_actions.= "WHERE intranet_modules.id_intranet_modules=$id_intranet_modules";
    $result_actions=DatabaseOperation::query($req_actions);

    //Tableau de définitions des droits d'accès
    //echo "<tr>";
    while ($rows_actions=mysql_fetch_array($result_actions))
    {
        //Préparation des variables
        $nom_intranet_actions=$rows_actions[nom_intranet_actions];
        $id_intranet_actions=$rows_actions[id_intranet_actions];

        //Construction du tableau
//        echo "<td class=loginFFFFFFdroit valign=top width=172>";
//        echo "<center>";
//        echo "$nom_intranet_actions<br>";

        //Création des variables necessaires
        $txt1="module".$id_intranet_modules."_action".$id_intranet_actions;
        $nom_niveau_intranet_droits_acces="$txt1";
        $niveau_intranet_droits_acces=$$nom_niveau_intranet_droits_acces;

        //Insertion du droit d'accès
        $req_droits_acces = "INSERT INTO intranet_droits_acces (";
        $req_droits_acces.= "id_intranet_modules, ";
        $req_droits_acces.= "id_user, ";
        $req_droits_acces.= "id_intranet_actions, ";
        $req_droits_acces.= "niveau_intranet_droits_acces) ";
        $req_droits_acces.= "VALUES (";
        $req_droits_acces.= "$id_intranet_modules, ";
        $req_droits_acces.= "$idUser, ";
        $req_droits_acces.= "$id_intranet_actions, ";
        $req_droits_acces.= "$niveau_intranet_droits_acces) ";
        $result_droits_acces=DatabaseOperation::query($req_droits_acces);

        //Affichage du droit d'accès
        //Recherche de niveaux spécifiques
        $req_niveau_specifique = "SELECT * FROM intranet_niveau_acces, intranet_droits_acces ";
        $req_niveau_specifique.= "WHERE intranet_niveau_acces.id_intranet_modules=intranet_droits_acces.id_intranet_modules ";
        $req_niveau_specifique.= "AND intranet_niveau_acces.id_intranet_actions=intranet_droits_acces.id_intranet_actions ";
        $req_niveau_specifique.= "AND intranet_niveau_acces.id_intranet_niveau_acces=intranet_droits_acces.niveau_intranet_droits_acces ";
        $req_niveau_specifique.= "AND intranet_droits_acces.id_user=$idUser ";
        $req_niveau_specifique.= "AND intranet_droits_acces.id_intranet_modules=$id_intranet_modules ";
        $req_niveau_specifique.= "AND intranet_droits_acces.id_intranet_actions=$id_intranet_actions ";
        $req_niveau_specifique.= "AND intranet_droits_acces.niveau_intranet_droits_acces=$niveau_intranet_droits_acces";
        $result_niveau_specifique=DatabaseOperation::query($req_niveau_specifique);

        //S'il existe des niveaux personnalisés, alors ceux-ci sont utilisés
        if ($result_niveau_specifique)
        {
            $compte_niveau_specifique=mysql_num_rows($result_niveau_specifique);
            if ($compte_niveau_specifique)
            {

                $result_niveau=$result_niveau_specifique;
            }
        

            //Sinon on reprend ceux définit par défaut
            else
            {
                $req_niveau_defaut = "SELECT * FROM intranet_niveau_acces, intranet_droits_acces ";
                $req_niveau_defaut.= "WHERE intranet_niveau_acces.id_intranet_niveau_acces=intranet_droits_acces.niveau_intranet_droits_acces ";
                $req_niveau_defaut.= "AND intranet_niveau_acces.id_intranet_actions='0' ";
                $req_niveau_defaut.= "AND intranet_niveau_acces.id_intranet_modules='0' ";
                $req_niveau_defaut.= "AND intranet_droits_acces.id_user=$idUser ";
                $req_niveau_defaut.= "AND intranet_droits_acces.id_intranet_modules=$id_intranet_modules ";
                $req_niveau_defaut.= "AND intranet_droits_acces.id_intranet_actions=$id_intranet_actions ";
                $req_niveau_defaut.= "AND intranet_droits_acces.niveau_intranet_droits_acces=$niveau_intranet_droits_acces";
                $result_niveau_defaut=DatabaseOperation::query($req_niveau_defaut);
                $result_niveau=$result_niveau_defaut;
            }
        }
        //Affichage du droit d'accès
//        if($result_niveau){
//            while ($rows_niveau=mysql_fetch_array($result_niveau))
//            {
//                  $nom_intranet_niveau_acces=$rows_niveau[nom_intranet_niveau_acces];
//                  echo "$nom_intranet_niveau_acces";
//            }
//        }
//        echo "<br>";
//        echo "</center>";
//        echo "</td>";
    }
//    echo "</tr>";
//    echo "</table>";
}
echo "<br>";

?>
</table>
</form>
<?php  include ("../adminagis/cadrebas.php"); ?>
</body>
</html>