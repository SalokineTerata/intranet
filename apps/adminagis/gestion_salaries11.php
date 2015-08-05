<?php
//  require("../lib/session.php");
//  include("functions.php");
//  include("../lib/functions.php");
require_once '../inc/main.php';

$globalConfig = new GlobalConfig();
$login = $globalConfig->getAuthenticatedUser()->getKeyValue();
$idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
$userLogin = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_LOGIN)->getFieldValue();
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


//echo $ascendant_id_salaries;

  if ($modifier=='modifier')
  {
    //*********************** SALARIES ***********************//
    $userNom=addslashes($userNom);
    $userPrenom=addslashes($userPrenom);
    $userNom=strtoupper($userNom);
    $req = "update salaries set "
         . "nom='$userNom', "
         . "prenom='$userPrenom', "
         . "id_catsopro='$userCatsopro', "
         . "id_service='$userService', "
         . "id_type='$sal_type', "
         . "login='$userLogin', "
         ;
    if($sal_pass)
    {
        $req .= "pass=PASSWORD('$sal_pass'), ";
    }
    $req .= "mail='$userMail', "
         . "ecriture='$ecriture', "
         . "membre_ce='$membreCe', "
         . "lieu_geo='$newLieuGeo', "
         . "newsdefil='$newsDefil', "
         . "ascendant_id_salaries='$ascendantIdSalaries', "
         . "date_creation_salaries='$dateCreationUser' "
         . "where id_user='$idUser' "
         ;
    //echo $req;
    $result=DatabaseOperation::query($req);

    $req="update droitft set ecritureft='$ecritureft', lectureft='$lectureft', creation_ft='$creation_ft',
    creation_fiche_produit='$creation_fiche_produit', validft='$validft', droitstat='$droitstat' where id_user='$idUser'";
    $result=DatabaseOperation::query($req);

    //************************ MODES ************************//
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
        $req2="update modes set serv_conf=$niveau where id_user='$idUser' and id_service='$service'";
        $result2=DatabaseOperation::query($req2);
        if ($result==false)
          echo ("Update impossible pour le service $service pour le salarie $idUser");
        $i++;
      }
    }

    /**********************************************
    Mise à jour des droits d'accès de l'utilisateur
    *********************Boris Sanègre 2003.03.28**
    *********************Boris Sanègre 2007.01.09*/

//Récupération des droits d'accès faisable dans l'Intranet
$req = "SELECT `intranet_modules`.*, `intranet_actions`.* "
     . "FROM `intranet_actions`, `intranet_modules` "
     . "WHERE ( "
     . "`intranet_actions`.`module_intranet_actions` = `intranet_modules`.`id_intranet_modules` "
     . "OR  `intranet_actions`.`module_intranet_actions` = 0 "
     . ")"
     ;
$result= DatabaseOperation::query($req);
while ($rows=mysql_fetch_array($result))
{

  //Déclaration du droits d'accès fourni par droits_acces.inc et récupération de son niveau d'accès
  $nom_niveau_intranet_droits_acces="module".$rows["id_intranet_modules"]."_action".$rows["id_intranet_actions"];
  $niveau_intranet_droits_acces=$$nom_niveau_intranet_droits_acces;

  //Enregistrement/Suppression du droit d'accès
  $id_user_recup = $id_user; //sauvegarde de votre "$id_user"
  //$id_user = $sal_user;
  $id_intranet_modules=$rows["id_intranet_modules"];
  $id_intranet_actions=$rows["id_intranet_actions"];
  //echo  $niveau_intranet_droits_acces;

  //Suppression des anciens accès
  $req = "DELETE FROM intranet_droits_acces "
       . "WHERE id_intranet_modules='$id_intranet_modules' "
       . "AND id_user='$idUser' "
       . "AND id_intranet_actions='$id_intranet_actions' "
       ;
  DatabaseOperation::query($req);

  if($niveau_intranet_droits_acces)
  {


     //Réécriture du droits d'accès
     $req = "INSERT INTO intranet_droits_acces "
          . "SET id_intranet_modules='$id_intranet_modules' "
          . ", id_user='$idUser' "
          . ", id_intranet_actions='$id_intranet_actions' "
          . ", niveau_intranet_droits_acces='$niveau_intranet_droits_acces' "
          ;
     DatabaseOperation::query($req);

     //mysql_table_operation('intranet_droits_acces', 'rewrite');
  }
/*
  else
  {
     //Suppression
     mysql_table_operation('intranet_droits_acces', 'delete');

  }
*/
  $id_user = $id_user_recup; //Récupération du votre "$id_user"

}

/*    $req_modules = "SELECT * FROM intranet_modules ";
    $req_modules.= "ORDER BY nom_usuel_intranet_modules ASC";
    $result_modules = DatabaseOperation::query($req_modules);
    while ($rows_modules=mysql_fetch_array($result_modules))
    {
          //Préparation des variables
          $nom_usuel_intranet_modules=$rows_modules[nom_usuel_intranet_modules];
          $id_intranet_modules=$rows_modules[id_intranet_modules];

          //Droits d'accès du module
          //Recherche des droits d'accès
          $req_actions = "SELECT DISTINCT * ";
          $req_actions.= "FROM intranet_modules, intranet_actions ";
          $req_actions.= "WHERE intranet_modules.id_intranet_modules=$id_intranet_modules";
          $result_actions=DatabaseOperation::query($req_actions);

          //Tableau de définitions des droits d'accès
          while ($rows_actions=mysql_fetch_array($result_actions))
          {
                //Préparation des variables
                $nom_intranet_actions=$rows_actions[nom_intranet_actions];
                $id_intranet_actions=$rows_actions[id_intranet_actions];

                //Création des variables necessaires
                $txt1="module".$id_intranet_modules."_action".$id_intranet_actions;
                $nom_niveau_intranet_droits_acces="$txt1";
                $niveau_intranet_droits_acces=$$nom_niveau_intranet_droits_acces;

                //Mise à jour des droit d'accès
                $id_user_recup = $id_user_recup; //sauvegarde de votre "$id_user"
                $id_user = $sal_user;
                mysql_table_operation('intranet_droits_acces', 'rewrite');
                $id_user = $id_user_recup; //Récupération du votre "$id_user"
*/

/*
                $req_droits_acces = "UPDATE intranet_droits_acces SET "
                                  . "niveau_intranet_droits_acces=$niveau_intranet_droits_acces "
                                  . "WHERE id_intranet_modules=$id_intranet_modules "
                                  . "AND id_user=$sal_user "
                                  . "AND id_intranet_actions=$id_intranet_actions"
                                  ;
                $result_droits_acces=DatabaseOperation::query($req_droits_acces);
*/
/*
          }
    }//Fin de la mise à jour des droit d'accès MySQL
*/
    //Mise à jour des droits d'accès Squid
    //include ('../acces_internet/functions.php');
    //squid_login_sync();


}//Fin de if($modifier=='modifier')

// Suppression de l'utilisateur
if($modifier=='supprimer')
{
   $f1=suppression_intranet_utilisateur($idUser);
}
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
<form name="rechnom" method="post" action="gestion_salaries22.php">
<table width="620" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
      <table border="0" cellspacing="0" cellpadding="0" width="600">
        <tr>
          <td><img src="../images_pop/etape1_salaries.gif" height="62"></td>
          <td><img src="../images_pop/gestion_salaries.gif" width="500" height="62"></td>
          <td><a href="../aide.php#entreprise" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
        </tr>
      </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="20"></td>
        </tr>
        <tr>
          <td class="loginFFFFFF">
            <div align="center"><img src="../images_pop/modif_sal.gif" width="500" height="30"></div>
          </td>
        </tr>
        <tr>
          <td class="loginFFFFFF">
            <div align="center"><br>
              Nom du salari&eacute; &agrave; modifier
<?php
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>";

    echo "<div align=center>";
    echo ("<select name=\"sal_user\" size=20>\n");
/* Constitution de la liste déroulante des noms */
    $req="select id_user, nom, prenom from salaries where actif='oui' order by nom";
    $result=DatabaseOperation::query($req);
    if ($result!= false)
    {
      while ($row=mysql_fetch_row($result))
      {
        echo ("<option value=\"$row[0]\">$row[1] $row[2]</option>");
      }
    }
    echo ("</select>\n");
?>
            </div>
          </td>
        </tr>
        <tr>
          <td><img src=../lib/images/espaceur.gif width="10" height="10"></td>
        </tr>
        <tr>
          <td>
            <div align="center"><input type="image" src="../images_pop/chercher.gif" width="130" height="20"></div>
            <input type="hidden" name="rech" value="1">
          </td>
        </tr>
        <tr>
          <td align="center" valign="top"><img src=../lib/images/espaceur.gif width="10" height="30">
            <table width="80%" border="1" cellspacing="0" cellpadding="0" bordercolor="#FFE5B2">
              <tr>
                <td colspan="3"><b>SUPER ADMINISTRATEUR</b></td>
              </tr>

<?php
/* Recherche des salaries qui sont super admin */
/* echo  $req="select nom, prenom, intitule_cat, intitule_ser
  from services, salaries, catsopro
  where salaries.id_type=4 and
  salaries.id_service=services.id_service
  and salaries.id_catsopro=catsopro.id_catsopro
  and actif='oui' order by nom";
 */

  $type=4;
  $req="select nom, prenom, intitule_cat, nom_service
  from access_materiel_service, salaries, catsopro
  where salaries.id_type=$type and
  salaries.id_service=access_materiel_service.K_service
  and salaries.id_catsopro=catsopro.id_catsopro
  and actif='oui' order by nom";
  $result=DatabaseOperation::query($req);
  $num=mysql_num_rows($result);
  if ($num!=0)
  {
    $i=0;
    while ($i<$num)
    {
      $userPrenom=mysql_result($result, $i, prenom);
      $userNom=mysql_result($result, $i, nom);
      $intitule_ser=mysql_result($result, $i, "nom_service");
      $intitule_cat=mysql_result($result, $i, intitule_cat);

      echo ("<tr>\n");
      echo ("<td class=\"loginFFFFFF\">$userPrenom $userNom</td>\n");
      echo ("<td class=\"loginFFFFFF\">$intitule_ser</td>\n");
      echo ("<td class=\"loginFFFFFF\">$intitule_cat</td>\n");
      echo ("</tr>\n");
      $i++;
    }
  }
?>
              <tr>
                <td colspan="3"><b>ADMINISTRATEUR</b></td>
              </tr>
<?php
/* Recherche des salaries qui sont super admin */
  $type=3;
  $req="select nom, prenom, intitule_cat, nom_service
  from access_materiel_service, salaries, catsopro
  where salaries.id_type=$type and
  salaries.id_service=access_materiel_service.K_service
  and salaries.id_catsopro=catsopro.id_catsopro
  and actif='oui' order by nom";
  $result=DatabaseOperation::query($req);
  $num=mysql_num_rows($result);
  if ($num!=0)
  {
    $i=0;
    while ($i<$num)
    {
      $userPrenom=mysql_result($result, $i, prenom);
      $userNom=mysql_result($result, $i, nom);
      $intitule_ser=mysql_result($result, $i, "nom_service");
      $intitule_cat=mysql_result($result, $i, intitule_cat);

      echo ("<tr>\n");
      echo ("<td class=\"loginFFFFFF\">$userPrenom $userNom</td>\n");
      echo ("<td class=\"loginFFFFFF\">$intitule_ser</td>\n");
      echo ("<td class=\"loginFFFFFF\">$intitule_cat</td>\n");
      echo ("</tr>\n");
      $i++;
    }
  }
?>
              <tr>
                <td colspan="3"><b>PUBLICATEUR-MODIFICATEUR</b></td>
              </tr>
<?php
/* Recherche des salaries qui sont super admin */
  $type=2;
  $req="select nom, prenom, intitule_cat, nom_service
  from access_materiel_service, salaries, catsopro
  where salaries.id_type=$type and
  salaries.id_service=access_materiel_service.K_service
  and salaries.id_catsopro=catsopro.id_catsopro
  and actif='oui' order by nom";
  $result=DatabaseOperation::query($req);
  $num=mysql_num_rows($result);
  if ($num!=0)
  {
    $i=0;
    while ($i<$num)
    {
      $userPrenom=mysql_result($result, $i, prenom);
      $userNom=mysql_result($result, $i, nom);
      $intitule_ser=mysql_result($result, $i, "nom_service");
      $intitule_cat=mysql_result($result, $i, intitule_cat);

      echo ("<tr>\n");
      echo ("<td class=\"loginFFFFFF\">$userPrenom $userNom</td>\n");
      echo ("<td class=\"loginFFFFFF\">$intitule_ser</td>\n");
      echo ("<td class=\"loginFFFFFF\">$intitule_cat</td>\n");
      echo ("</tr>\n");
      $i++;
    }
  }
?>
              <tr>
                <td colspan="3"><b>LECTEUR</b></td>
              </tr>
<?php
/* Recherche des salaries qui sont super admin */
  $type=1;
  $req="select nom, prenom, intitule_cat, nom_service
  from access_materiel_service, salaries, catsopro
  where salaries.id_type=$type and
  salaries.id_service=access_materiel_service.K_service
  and salaries.id_catsopro=catsopro.id_catsopro
  and actif='oui' order by nom";
  $result=DatabaseOperation::query($req);
  $num=mysql_num_rows($result);
  if ($num!=0)
  {
    $i=0;
    while ($i<$num)
    {
      $userPrenom=mysql_result($result, $i, prenom);
      $userNom=mysql_result($result, $i, nom);
      $intitule_ser=mysql_result($result, $i, "nom_service");
      $intitule_cat=mysql_result($result, $i, intitule_cat);

      echo ("<tr>\n");
      echo ("<td class=\"loginFFFFFF\">$userPrenom $userNom</td>\n");
      echo ("<td class=\"loginFFFFFF\">$intitule_ser</td>\n");
      echo ("<td class=\"loginFFFFFF\">$intitule_cat</td>\n");
      echo ("</tr>\n");
      $i++;
    }
  }
?>
            </table>
          </td>
        </tr>
        <tr>
          <td>
            <div align="center"></div>
          </td>
        </tr>
      </table>

    </td>
  </tr>
</table>
<?php  include ("../adminagis/cadrebas.php"); ?>
</body>
</html>