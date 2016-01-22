<?php
//  require('../lib/session.php');
//  include('functions.php');
//  include('../lib/functions.php');
require_once '../inc/main.php';

$html_table = 'table '                     //Permet d'harmoniser les tableaux
        . 'border=1 '
        . 'width=100% '
        . 'class=loginFFFFFFdroit '
;
/*
  Fin de préparation Agis
 */
$globalConfig = new GlobalConfig();
$login = $globalConfig->getAuthenticatedUser()->getKeyValue();
$pass = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_PASSWORD)->getFieldValue();
$id_type = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_ID_TYPE)->getFieldValue();
$paramIdUser = Lib::getParameterFromRequest('sal_user');
$paramRech = Lib::getParameterFromRequest('rech');
$userModel = new UserModel($paramIdUser);
$userView = new UserView($userModel);
$userView->setIsEditable(TRUE);
identification1('salaries', $login, $pass, FALSE);
if ($paramRech == '1') {
    /* Recherche des infos sur le salarie */
    $arrayUserDetail = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                    'SELECT ' . UserModel::FIELDNAME_NOM
                    . ',' . UserModel::FIELDNAME_PRENOM
                    . ',' . UserModel::FIELDNAME_ID_CATSOPRO
                    . ',' . UserModel::FIELDNAME_LIEU_GEO
                    . ',' . UserModel::FIELDNAME_LOGIN
                    . ',' . UserModel::FIELDNAME_PASSWORD
                    . ',' . UserModel::FIELDNAME_MAIL
                    . ',' . UserModel::FIELDNAME_DATE_CREATION_SALARIES
                    . ' FROM ' . UserModel::TABLENAME
                    . ' WHERE ' . UserModel::KEYNAME . '=' . $paramIdUser
    );
    if (!$arrayUserDetail) {
        echo ('La requete de recherche de l\'ID salarie a echoue');
    } else {
        foreach ($arrayUserDetail as $rowsUserDetail) {
            $userNom = $rowsUserDetail[UserModel::FIELDNAME_NOM];
            $userPrenom = $rowsUserDetail[UserModel::FIELDNAME_PRENOM];
            $userCatsopro = $rowsUserDetail[UserModel::FIELDNAME_ID_CATSOPRO];
            $userLieuGeo = $rowsUserDetail[UserModel::FIELDNAME_LIEU_GEO];
            $userLogin = $rowsUserDetail[UserModel::FIELDNAME_LOGIN];
            $userPass = $rowsUserDetail[UserModel::FIELDNAME_PASSWORD];


            $champ = 'date_creation_salaries';
            ${'sal_' . $champ} = $rowsUserDetail[UserModel::FIELDNAME_DATE_CREATION_SALARIES];

            //$sal_pass=mysql_result($result, 0, pass);
            $userMail = $rowsUserDetail[UserModel::FIELDNAME_MAIL];
        }
        $userNom = stripslashes($userNom);
        $userPrenom = stripslashes($userPrenom);
    }
}
?>
<html>
    <head>
        <title>Gestion des salari&eacute;s</title>
        <meta http-equiv='Content-Type' content='text / html;
              charset = iso-8859-1'>
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

    </head>

    <body onLoad='StartTimer(<?php
    $time = timeout($paramIdUser);
    echo $time;
    ?>)' bgcolor='#FFCC66' text='#000000' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
              <?php
              include ('cadrehautent.php');
              ?>
        <form name='salarie' method='post' action='gestion_salaries11.php'>
            <table width='620' border='0' cellspacing='0' cellpadding='0' height='178'>
                <tr>
                    <td>
                        <table border='0' cellspacing='0' cellpadding='0' width='600'>
                            <tr>
                                <td><img src='../images_pop/etape2_salaries.gif' height='62'></td>
                                <td><img src='../images_pop/gestion_salaries.gif' width='500' height='62'></td>
                                <td><a href='../aide.php#entreprise' target='_blank'><img src=../lib/images/bandeau_aide_point_interrogation.gif width='28' height='62' border='0'></a></td>
                            </tr>
                        </table>
                        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                            <?php
                            /*
                             * Initialisation du Bloc HTML
                             */
                            $bloc = '<tr><td><' . $html_table . '> ';


                            /*
                             * Date de création de l'utlisateur
                             */

                            $bloc .=$userView->getHtmlDataField(UserModel::FIELDNAME_DATE_CREATION_SALARIES);

                            /*
                             * Association à un groupe d'utilisateur
                             */

//                            $bloc .= $userView->getHtmlDataField(UserModel::FIELDNAME_ASENDANT_ID_SALARIES);

                            /*
                             * Identifiant
                             */
                            $bloc .='<tr><td align=right>'
                                    . DatabaseDescription::getFieldDocLabel(UserModel::TABLENAME
                                            , UserModel::KEYNAME)
                                    . '</td><td align=left>' . $paramIdUser
                                    . '</td></tr>'
                            ;
                            /*
                             * Affichage
                             */
                            echo $bloc . '</table></td></tr>';
                            ?>

                            <tr>
                                <td class='loginFFFFFF'>
                                    <div align='center'><img src=../lib/images/espaceur.gif width='10' height='20'>
                                        <table width='500' border='0' cellspacing='4' cellpadding='0' align='center'>
                                            <tr>
                                                <td class='loginFFFFFFdroit' width='10%'>Nom </td>
                                                <td class='loginFFFFFFdroit' width='22%'>
                                                    <INPUT TYPE='TEXT'  name='sal_nom'
                                                    <?php
                                                    echo ('value=\'' . $userNom . '\'');
                                                    ?>
                                                           >
                                                </td>
                                                <td class='loginFFFFFFdroit' width='53%'>Login
                                                    <INPUT TYPE='TEXT'  name='sal_login'
                                                    <?php
                                                    echo ('value=\'' . $userLogin . '\'');
                                                    ?>
                                                           >
                                                </td>
                                                <td width='15%' class='loginFFCC66'>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td class='loginFFFFFFdroit' width='10%'>Pr&eacute;nom </td>
                                                <td class='loginFFFFFFdroit' width='22%'>
                                                    <INPUT TYPE='TEXT'  name='sal_prenom'
                                                    <?php
                                                    echo ('value=\'' . $userPrenom . '\'');
                                                    ?>
                                                           >

                                                </td>
                                                <td class='loginFFFFFFdroit' width='53%'> Nouveau mot de passe:
                                                    <INPUT TYPE='password'  name='sal_pass'
                                                    <?php
                                                    echo ('value=\'' . $sal_pass . '\'');
                                                    ?>
                                                           >
                                                </td>
                                                <td class='loginFFCC66' width='15%'>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td class='loginFFFFFFdroit' width='10%'>
                                                    <div align='center'></div>
                                                </td>
                                                <td class='loginFFFFFF' width='22%'>
                                                    <div align='right'> </div>
                                                </td>
                                                <td class='loginFFFFFFdroit' width='53%'>Mail
                                                    <INPUT TYPE='TEXT'  name='sal_mail'
                                                    <?php
                                                    echo ('value=\'' . $userMail . '\'');
                                                    ?>
                                                           >
                                                </td>
                                                <td width='15%'>&nbsp; </td>
                                            </tr>
                                        </table>
                                        <table width='500' border='0' cellspacing='4' cellpadding='0' align='center'>
                                            <tr>
                                                <td  class='loginFFFFFFdroit'>
                                            <center><br>
                                                CSP <br>
                                                <?php
                                                echo ('<select name=\'sal_catsopro\'>');
                                                /* Constitution de la liste déroulante des noms des csp */
                                                $arrayCatsopro = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                                                'SELECT ' . CatsoproModel::KEYNAME . ',' . CatsoproModel::FIELDNAME_INTITULE_CAT
                                                                . ' FROM ' . CatsoproModel::TABLENAME
                                                                . ' ORDER BY ' . CatsoproModel::FIELDNAME_INTITULE_CAT
                                                );
                                                if ($arrayCatsopro) {
                                                    foreach ($arrayCatsopro as $rowsCatsopro) {
                                                        echo ('<option value=\'' . $rowsCatsopro[CatsoproModel::KEYNAME] . '\'');
                                                        if ($rowsCatsopro[CatsoproModel::KEYNAME] == $userCatsopro)
                                                            echo ('selected');
                                                        echo ('>' . $rowsCatsopro[CatsoproModel::FIELDNAME_INTITULE_CAT] . '</option>');
                                                    }
                                                }
                                                echo ('</select>');
                                                ?>
                                            </center>
                                            </td>
                                            <td  class='loginFFFFFFdroit'>
                                            <center><br>
                                                Lieu Geo <br>
                                                <?php
                                                echo ('<select name=\'sal_lieu_geo\'>');
                                                /* Constitution de la liste déroulante des noms des csp */
                                                $arrayLieuGeo = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                                                "SELECT " . GeoModel::KEYNAME . "," . GeoModel::FIELDNAME_GEO
                                                                . " FROM " . GeoModel::TABLENAME
                                                                . " WHERE " . GeoModel::FIELDNAME_SITE_ACTIF . "=1"
                                                                . " ORDER BY " . GeoModel::FIELDNAME_GEO
                                                );
                                                if ($arrayLieuGeo) {
                                                    foreach ($arrayLieuGeo as $rowsLieuGeo) {
                                                        echo ('<option value=\'' . $rowsLieuGeo[GeoModel::KEYNAME] . '\'');
                                                        if ($rowsLieuGeo[GeoModel::KEYNAME] == $userLieuGeo)
                                                            echo ('selected');
                                                        echo ('>' . $rowsLieuGeo[GeoModel::FIELDNAME_GEO] . '</option>');
                                                    }
                                                }
                                                echo ('</select>');
                                                ?>
                                            </center>
                                            </td>
                                        </table>  
                                        <br>                 
                                        <?php
                                        /*                                         * ***************************************************
                                          Construction des droits d'accès pour tous les modules:
                                         * ***************************Boris Sanègre  2003.03.25 
                                         * ***************************Franck Amofa 2015.08.07 */
                                        // require ('droits_acces.inc');  
                                        IntranetDroitsAccesModel::BuildHtmlDroitsAcces($paramIdUser);
                                        ?>
                                        <table width='500' border='0' cellspacing='4' cellpadding='0' align='center'>
                                            <tr>
                                                <td>
                                                    <div align='center'><img src='../images_pop/affectation_droits.gif' width='500' height='30'></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><img src=../lib/images/espaceur.gif width='10' height='10'></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width='350' border='0' cellspacing='0' cellpadding='0' align='center'>
                                                        <tr>
                                                            <td colspan='2'>
                                                                <div align='center'><input type='image' src='../zimages/modifier-j.gif' width='130' height='20'>&nbsp;&nbsp;<a href='#' onClick='confirmation(<?php echo $paramIdUser; ?>);'><img src='../images-index/supprimer.gif' border=0></a></div>

                                                                <input type='hidden' name='modifier' value='modifier'>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class='LOGINFFFFFFCENTRE'><img src=../lib/images/espaceur.gif width='10' height='20'></td>
                                                            <?php
                                                            echo ('<input type=\'hidden\' name=\'modifier\' value=\'modifier\'>');
                                                            echo ('<input type=\'hidden\' name=\'sal_user\' value=\'' . $paramIdUser . '\'>');
                                                            ?>
                                                            <td class='LOGINFFFFFFCENTRE'>&nbsp;</td>
                                                        </tr>                                                                                           
                                                    </table>
                                                </td>
                                            </tr>    
                                        </table>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
        <?php include ('../adminagis/cadrebas.php'); ?>
    </body>
</html>