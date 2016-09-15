<?php
//  require('../lib/session.php');
//  include('functions.php');
//  include('../lib/functions.php');
require_once '../inc/main.php';
$globalConfig = new GlobalConfig();
$login = $globalConfig->getAuthenticatedUser()->getKeyValue();
$pass = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_PASSWORD)->getFieldValue();
$id_type = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_ID_TYPE)->getFieldValue();
$mail = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_MAIL)->getFieldValue();


$paramUserLogin = Lib::getParameterFromRequest('sal_login');
$paramUserNom = Lib::getParameterFromRequest('sal_nom');
$paramUserPrenom = Lib::getParameterFromRequest('sal_prenom');
$paramUserPass = Lib::getParameterFromRequest('sal_pass');
$paramUserPass2 = Lib::getParameterFromRequest('sal_pass2');
$paramUserCatsopro = Lib::getParameterFromRequest('catsopro');
$paramUserLieuGeo = Lib::getParameterFromRequest('lieu_geo');
$paramDateCreationUser = date('Y-m-d');
$paramNewsDefil = Lib::getParameterFromRequest('newsdefil');
$paramUserMail = Lib::getParameterFromRequest('sal_mail');
$paramModifier = Lib::getParameterFromRequest('modifier');
$paramValider = Lib::getParameterFromRequest('valider');
identification1('salaries', $login, $pass, FALSE);

if ($paramValider == 'valider') {

    if ($paramUserPass != $paramUserPass2) {
        header('location:gestion_salaries1.php?erreur=pass');
    }


    /* Insertion dans la table SALARIES */
    $paramUserNom = strtoupper($paramUserNom);
    $paramUserPrenom = addslashes($paramUserPrenom);

    $arrayIdUserExist = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                    'SELECT ' . UserModel::KEYNAME
                    . ' FROM ' . UserModel::TABLENAME
                    . ' WHERE ' . UserModel::FIELDNAME_NOM . '=\'' . $paramUserNom
                    . '\' AND ' . UserModel::FIELDNAME_PRENOM . '=\'' . $paramUserPrenom
                    . '\' AND ' . UserModel::FIELDNAME_MAIL . '=\'' . $paramUserMail
                    . '\' AND ' . UserModel::FIELDNAME_ACTIF . '=\'oui\''
    );
    if ($arrayIdUserExist) {
        header('location:gestion_salaries1.php?erreur=oui');
    } else {
        $resultInsertionUser = DatabaseOperation::execute(
                        'INSERT INTO ' . UserModel::TABLENAME
                        . ' (' . UserModel::FIELDNAME_NOM . ', ' . UserModel::FIELDNAME_PRENOM
                        . ', ' . UserModel::FIELDNAME_DATE_CREATION_SALARIES
                        . ', ' . UserModel::FIELDNAME_ID_CATSOPRO
                        . ', ' . UserModel::FIELDNAME_LIEU_GEO
                        . ', ' . UserModel::FIELDNAME_LOGIN . ', ' . UserModel::FIELDNAME_PASSWORD
                        . ', ' . UserModel::FIELDNAME_MAIL
                        . ') VALUES (\'' . $paramUserNom . '\', \'' . $paramUserPrenom
                        . '\', \'' . $paramDateCreationUser
                        . '\', \'' . $paramUserCatsopro
                        . '\', \'' . $paramUserLieuGeo
                        . '\', \'' . $paramUserLogin . '\',  PASSWORD(\'' . $paramUserPass
                        . '\'),\'' . $paramUserMail . '\')'
        );
        if (!$resultInsertionUser) {
            $titre = ' L\'insertion du salarié ' . $paramUserNom . ' ' . $paramUserPrenom;
            $message = 'L\'insertion dans la table SALARIES n\'a pas reussie';
            $redirection = '';
            Lib::showMessage($titre, $message, $redirection);
        }
        /*
         * Recherche de l'id du nouveau salarie
         */

        $arrayIdUser = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . UserModel::KEYNAME
                        . ' FROM ' . UserModel::TABLENAME
                        . ' WHERE ' . UserModel::FIELDNAME_LOGIN . '=\'' . $paramUserLogin . '\' ');

        if (!$arrayIdUser) {
            echo ('La requete de recherche de l\'ID salarie a echoue');
        } elseif (count($arrayIdUser) == "1") {
            foreach ($arrayIdUser as $rowsIdUser) {
                $idUser = $rowsIdUser[UserModel::KEYNAME];
            }
        } else {
            $titre = ' L\'insertion du salarié ' . $paramUserNom . ' ' . $paramUserPrenom;
            $message = 'L\'insertion dans la table SALARIES a reussie mais le login ' . $paramUserLogin . ' est utilisé'
                    . ' Ainsi les droits d\'accès n\'ont pas été tenu compte';
            $redirection = '';
            Lib::showMessage($titre, $message, $redirection);
        }

        /*         * ******************************************
          Insertion des droits d'accès de l'utilisateur
         * ******************Boris Sanègre 2003.03.28*

          //Recherche des modules de l'intranet
          $req_modules = 'SELECT * FROM intranet_modules';
          $result_modules = DatabaseOperation::query($req_modules);
          while ($rows_modules = mysql_fetch_array($result_modules))
          {
          //Création des variables necessaires
          $id_intranet_modules = $rows_modules[id_intranet_modules];

          //Recherche des actions de l'intranet
          $req_actions = 'SELECT * FROM intranet_actions';
          $result_actions = DatabaseOperation::query($req_actions);
          while ($rows_actions = mysql_fetch_array($result_actions))
          {
          //Création des variables necessaires
          $id_intranet_actions = $rows_actions[id_intranet_actions];
          $txt1 = 'module'.$id_intranet_modules.'_action'.$id_intranet_actions;
          $nom_niveau_intranet_droits_acces = '$txt1';
          $niveau_intranet_droits_acces = $$nom_niveau_intranet_droits_acces;

          //Insertion du droit d'accès
          $req_droits_acces = 'INSERT INTO intranet_droits_acces (';
          $req_droits_acces.= 'id_intranet_modules, ';
          $req_droits_acces.= 'id_user, ';
          $req_droits_acces.= 'id_intranet_actions, ';
          $req_droits_acces.= 'niveau_intranet_droits_acces) ';
          $req_droits_acces.= 'VALUES (';
          $req_droits_acces.= '$id_intranet_modules, ';
          $req_droits_acces.= '$sal_user, ';
          $req_droits_acces.= '$id_intranet_actions, ';
          $req_droits_acces.= '$niveau_intranet_droits_acces) ';
          $result_droits_acces = DatabaseOperation::query($req_droits_acces);
          }
          }
         */
    }
    /*
     * Recuperation des données pour affichage
     */
    $arrayUserDetail = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                    'SELECT ' . UserModel::FIELDNAME_ECRITURE
                    . ', ' . UserModel::FIELDNAME_ID_CATSOPRO
                    . ', ' . UserModel::FIELDNAME_LOGIN
                    . ', ' . UserModel::FIELDNAME_ID_SERVICE
                    . ', ' . UserModel::FIELDNAME_LIEU_GEO
                    . ', ' . UserModel::FIELDNAME_MAIL
                    . ', ' . UserModel::FIELDNAME_MEMBRE_CE
                    . ', ' . UserModel::FIELDNAME_NEWSDEFIL
                    . ', ' . UserModel::FIELDNAME_PASSWORD
                    . ' FROM ' . UserModel::TABLENAME
                    . ' WHERE ' . UserModel::KEYNAME . '=\'' . $idUser . '\''
    );
    if ($arrayUserDetail) {
        foreach ($arrayUserDetail as $rowsUserDetail) {
            $id_catsopro = $rowsUserDetail[UserModel::FIELDNAME_ID_CATSOPRO];
            $paramUserLogin = $rowsUserDetail[UserModel::FIELDNAME_LOGIN];
            $paramUserPass = $rowsUserDetail[UserModel::FIELDNAME_PASSWORD];
            $paramUserMail = $rowsUserDetail[UserModel::FIELDNAME_MAIL];
        }
        $paramUserNom = stripslashes($paramUserNom);
        $paramUserPrenom = stripslashes($paramUserPrenom);
    }

//    $req='select * from droitft where id_user='$sal_user'';
//    $result=DatabaseOperation::query($req);
//    if ($result== false)
//      echo ('La requete de recherche de l'ID salarie a echoue');
//    else
//    {
//      $ecritureft==mysql_result($result, 0, ecritureft);
//      $creation_ft==mysql_result($result, 0, creation_ft);
//      $creation_fiche_produit==mysql_result($result, 0, creation_fiche_produit);
//      $lectureft==mysql_result($result, 0, lectureft);
//      $validft==mysql_result($result, 0, validft);
//      $droitstat==mysql_result($result, 0, droitstat);
//    }


    /*
     * Recherche des niveaux de references dans la table CATSOPRO 
     */
    $arrayCatsopro = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                    'SELECT ' . CatsoproModel::FIELDNAME_NIVO_GLO
                    . ', ' . CatsoproModel::FIELDNAME_NIVO_PRO
                    . ' FROM ' . CatsoproModel::TABLENAME
                    . ' WHERE ' . CatsoproModel::KEYNAME . '=' . $paramUserCatsopro
    );
    if ($arrayCatsopro) {
        foreach ($arrayCatsopro as $rowsCatsopro) {
            $nivo_glo = $rowsCatsopro[CatsoproModel::FIELDNAME_NIVO_GLO];
            $nivo_pro = $rowsCatsopro[CatsoproModel::FIELDNAME_NIVO_PRO];
        }
    } else {
        $titre = '  Recherche des niveaux de references dans la table CATSOPRO pour l\'identifiant ' . $paramUserCatsopro;
        $message = 'La requete de recherche des niveaux de reference a échoué';
        $redirection = '';
        Lib::showMessage($titre, $message, $redirection);
    }

    /* Insertions dans la table MODES via la table de reference CATSOPRO */
//    $req='insert into modes (id_user, id_service, serv_conf)
//    values ('$sal_user', '$service', '$nivo_pro')';
//    $result=DatabaseOperation::query($req);
//
//    if ($result== false)
//      echo ('L'insertion dans la table MODES non reussie');

    /* Parcours de la table service (exclu le service du salarie) pour inserer les autres modes */
//    $req='select distinct id_service from services where id_service <> '$service'';
//    $result=DatabaseOperation::query($req);
//    if ($result != false)
//    {
//      $num=mysql_num_rows($result);
//      $i=0;
//      while ($i<$num)
//      {
//        /* Pour chaque service on insere dans la table*/
//        $service=mysql_result($result, $i, id_service);
//        $req2='insert into modes (id_user, id_service, serv_conf)
//        values ('$sal_user', '$service', '$nivo_glo')';
//        $result2=DatabaseOperation::query($req2);
//        $i++;
//      }
//    }
}
/*
 * Quand un salarie est cree, envoi d'un mail pour lui donner son profil
 */
$sujet = 'Inscription Intranet Agis';
$corpsmail = UserInterfaceMessage::FR_MAIIL_INSCRIPTION;
$typeMail = 'Inscription';
envoismail($sujet, $corpsmail, $paramUserMail, $mail, $typeMail);
?>
<html>
    <head>
        <title>Gestion des salari&eacute;s</title>
        <meta http-equiv='Content-Type' content='text / html;
              charset = iso-8859-1'>
        <link rel='stylesheet' href='../lib/css/intra01.css' type='text/css'>
        <script language='JavaScript'>
            <!--
        function MM_openBrWindow(theURL, winName, features) { //v2.0
                window.open(theURL, winName, features);
            }
            //-->
        </script>
        <SCRIPT LANGUAGE='JavaScript'>
            function Popup(page, options) {
                document.location.href = '../index.php?action = delog';
            }
            function StartTimer(delai) {
                // Déclenche le timer à la fin du chargement de la page (delai est en secondes)
                setTimeout('Popup()', delai * 1000);
            }
        </SCRIPT>
        <link rel='stylesheet' href='../lib/css/admin_intra01.css' type='text/css'>
        <link rel='stylesheet' href=../lib/css/admin_newspopup.css type='text/css'>
    </head>

    <body onLoad='StartTimer(<?php
    $time = timeout($login);
    echo '$time';
    ?>)' bgcolor='#FFCC66' text='#000000' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
              <?php
              include ('cadrehautent.php');
              ?>
        <form name='salarie' method='post' action='gestion_salaries1.php'>
            <input type=hidden name=sal_user value=<?php $idUser ?>>


            <table width='620' border='0' cellspacing='0' cellpadding='0' height='178'>
                <tr>
                    <td>
                        <table border='0' cellspacing='0' cellpadding='0' width='600'>
                            <tr>
                                <td><img src='../images_pop/etape2_salaries.gif' height='62'></td>
                                <td><img src='../images_pop/gestion_salaries.gif' height='62'></td>
                                <td><a href='../aide.php#entreprise' target='_blank'><img src=../lib/images/bandeau_aide_point_interrogation.gif width='28' height='62' border='0'></a></td>
                            </tr>
                        </table>
                        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                            <tr>
                                <td class='loginFFFFFF'>
                                    <div align='center'><img src=../lib/images/espaceur.gif width='10' height='20'>
                                        <table width='500' border='0' cellspacing='4' cellpadding='0' align='center'>
                                            <tr>
                                                <td class='loginFFCC66droit' width='20%'><b>Nom :</b></td>
                                                <td class='loginFFCC66' width='35%'>
                                                    <?php
                                                    echo ($paramUserNom);
                                                    ?>
                                                </td>
                                                <td class='loginFFCC66droit' width='33%'><b>Login :<b></td>
                                                            <td class='loginFFCC66' width='53%'>
                                                                <?php
                                                                echo $paramUserLogin;
                                                                ?>
                                                            </td>
                                                            <td width='15%' class='loginFFCC66'>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td class='loginFFCC66droit' width='20%'><b>Pr&eacute;nom :</b></td>
                                                                <td class='loginFFCC66' width='35%'>
                                                                    <?php
                                                                    echo ($paramUserPrenom);
                                                                    ?>
                                                                </td>
                                                                <td class='loginFFCC66droit' width='33%'><b>&nbsp;</b></td>
                                                                <td class='loginFFCC66' width='53%'>&nbsp;</td>
                                                                <td class='loginFFCC66' width='15%'>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td class='loginFFFFFFdroit' width='20%'>
                                                                    <div align='center'></div>
                                                                </td>
                                                                <td class='loginFFFFFF' width='35%'>
                                                                    <div align='right'> </div>
                                                                </td>
                                                                <td class='loginFFCC66droit' width='33%'><b>Mail :</b></td>
                                                                <td class='loginFFCC66' width='53%'>
                                                                    <?php
                                                                    echo $paramUserMail;
                                                                    ?>
                                                                </td>
                                                                <td width='15%'>&nbsp; </td>
                                                            </tr>
                                                            </table>
                                                            <table width='500' border='1' cellspacing='2' cellpadding='0' align='center'>
                                                                <tr>
                                                                    <td  class='loginFFFFFFCENTRE'><b>CSP</b> </td>
                                                                    <td  class='loginFFFFFFCENTRE'><b>Service</b> </td>
                                                                    <td  class='loginFFFFFFCENTRE'><b>Type</b></td>
                                                                    <td  class='loginFFFFFFCENTRE'><b>Droit d'&eacute;criture</b> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td  class='loginFFCC66' height='22'>
                                                                <center>
                                                                    <p>
                                                                        <?php
                                                                        /*
                                                                         * Affichage de l'intitule de la CSP
                                                                         */
                                                                        $arrayCatsopro = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                                                                        'SELECT ' . CatsoproModel::FIELDNAME_INTITULE_CAT
                                                                                        . ' FROM ' . CatsoproModel::TABLENAME
                                                                                        . ' WHERE ' . CatsoproModel::KEYNAME . '=' . $paramUserCatsopro
                                                                        );
                                                                        if ($arrayCatsopro) {
                                                                            foreach ($arrayCatsopro as $rowsCatsopro) {
                                                                                $intitule_cat = $rowsCatsopro[CatsoproModel::FIELDNAME_INTITULE_CAT];
                                                                            }
                                                                            $intitule_cat = stripslashes($intitule_cat);
                                                                            echo ($intitule_cat);
                                                                        }
                                                                        /*
                                                                         * Affichage de l'intitule de la CSP
                                                                         */
                                                                        $arrayLieuGeo = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                                                                        "SELECT " . GeoModel::FIELDNAME_GEO
                                                                                        . " FROM " . GeoModel::TABLENAME
                                                                                        . " WHERE " . GeoModel::FIELDNAME_SITE_ACTIF . "=1"
                                                                                        . " AND " . GeoModel::KEYNAME . "=" . $paramUserLieuGeo
                                                                        );
                                                                        if ($arrayLieuGeo) {
                                                                            foreach ($arrayLieuGeo as $rowsLieuGeo) {
                                                                                $lieu_geo = $rowsLieuGeo[GeoModel::FIELDNAME_GEO];
                                                                            }
                                                                            $lieu_geo = stripslashes($lieu_geo);
                                                                            echo ($lieu_geo);
                                                                        }
                                                                        ?>
                                                                    </p>
                                                                </center>
                                                                </td>                                                               
                                                                </tr>
                                                            </table>
                                                            <?php
                                                            /**
                                                             * Insertion des droits d'accès de l'utilisateur
                                                             * Boris Sanègre 2003.03.28
                                                             */
                                                            echo '<br>';
                                                            echo '</center>';
                                                            echo '</td>';
                                                            echo '</tr>';
                                                            echo '</table>';
                                                            echo '</div>';
                                                            echo '</td>';
                                                            echo '</tr>';
                                                            echo '<tr>';
                                                            echo '<td>';
                                                            echo '<br>';
                                                            echo '</td>';
                                                            echo '</tr>';


                                                            /**
                                                             * Drois d'accès au module Fta
                                                             */
                                                            IntranetDroitsAccesModel::manageAccesRightToFta($idUser);

                                                            //Droits d'accès du module
                                                            /*
                                                             * Récupération des droits d'accès de l'Intranet
                                                             */

                                                            IntranetDroitsAccesModel::manageAccesRightToIntranet($idUser,FALSE);
                                                            /**
                                                             * Post-traitement
                                                             * Vérification et correction des incohérences de droits d'accès.
                                                             */
                                                            Acl::checkHeritedRightsRemovedByUser($idUser);

                                                            echo '<br>';
                                                            ?>
                                                            </table>
                                                            </form>
                                                            <?php include ('../adminagis/cadrebas.php'); ?>
                                                            </body>
                                                            </html>