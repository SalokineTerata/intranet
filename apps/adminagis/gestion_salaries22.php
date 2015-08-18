<?php
//  require("../lib/session.php");
//  include("functions.php");
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
$globalConfig = new GlobalConfig();
$login = $globalConfig->getAuthenticatedUser()->getKeyValue();
$pass = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_PASSWORD)->getFieldValue();
$id_type = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_ID_TYPE)->getFieldValue();
$paramIdUser = Lib::getParameterFromRequest("sal_user");
$paramRech = Lib::getParameterFromRequest("rech");
$userModel = new UserModel($paramIdUser);
$userView = new UserView($userModel);
$userView->setIsEditable(TRUE);
identification1("salaries", $login, $pass);
securadmin(4, $id_type);
if ($paramRech == '1') {
    /* Recherche des infos sur le salarie */
    $arrayUserDetail = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                    "SELECT * FROM " . UserModel::TABLENAME
                    . " WHERE " . UserModel::KEYNAME . "='$paramIdUser'"
    );
    if (!$arrayUserDetail)
        echo ("La requete de recherche de l'ID salarie a echoue");
    else {
        foreach ($arrayUserDetail as $rowsUserDetail) {
            $userNom = $rowsUserDetail[UserModel::FIELDNAME_NOM];
            $userPrenom = $rowsUserDetail[UserModel::FIELDNAME_PRENOM];
            $userCatsopro = $rowsUserDetail[UserModel::FIELDNAME_ID_CATSOPRO];
            $userService = $rowsUserDetail[UserModel::FIELDNAME_ID_SERVICE];
            $sal_type = $rowsUserDetail[UserModel::FIELDNAME_ID_TYPE];
            $userLogin = $rowsUserDetail[UserModel::FIELDNAME_LOGIN];
            $userPass = $rowsUserDetail[UserModel::FIELDNAME_PASSWORD];

            $champ = "ascendant_id_salaries";
            ${"sal_" . $champ} = $rowsUserDetail[UserModel::FIELDNAME_ASENDANT_ID_SALARIES];
            $champ = "date_creation_salaries";
            ${"sal_" . $champ} = $rowsUserDetail[UserModel::FIELDNAME_DATE_CREATION_SALARIES];

            //$sal_pass=mysql_result($result, 0, pass);
            $userMail = $rowsUserDetail[UserModel::FIELDNAME_MAIL];
            $ecriture = $rowsUserDetail[UserModel::FIELDNAME_ECRITURE];
            $membreCe = $rowsUserDetail[UserModel::FIELDNAME_MEMBRE_CE];
            $lieu_geo = $rowsUserDetail[UserModel::FIELDNAME_LIEU_GEO];
            $newsDefil = $rowsUserDetail[UserModel::FIELDNAME_NEWSDEFIL];
        }
        $arrayDroitftDetail = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                        "SELECT " . DroitftModel::FIELDNAME_CREATION_FICHE_PRODUIT
                        . "," . DroitftModel::FIELDNAME_CREATION_FT
                        . "," . DroitftModel::FIELDNAME_DROITSTAT
                        . "," . DroitftModel::FIELDNAME_ECRITUREFT
                        . "," . DroitftModel::FIELDNAME_LECTUREFT
                        . "," . DroitftModel::FIELDNAME_VALIDFT
                        . " FROM " . DroitftModel::TABLENAME
                        . " WHERE " . DroitftModel::FIELDNAME_ID_USER . "='$paramIdUser'"
        );
        if ($arrayDroitftDetail) {
            foreach ($arrayDroitftDetail as $rowsDroitftDetail) {
                $validft = $rowsDroitftDetail[DroitftModel::FIELDNAME_VALIDFT];
                $ecritureft = $rowsDroitftDetail[DroitftModel::FIELDNAME_ECRITUREFT];
                $creation_ft = $rowsDroitftDetail[DroitftModel::FIELDNAME_CREATION_FT];
                $creation_fiche_produit = $rowsDroitftDetail[DroitftModel::FIELDNAME_CREATION_FICHE_PRODUIT];
                $lectureft = $rowsDroitftDetail[DroitftModel::FIELDNAME_LECTUREFT];
                $droitstat = $rowsDroitftDetail[DroitftModel::FIELDNAME_DROITSTAT];
                ;
            }
        }
        $userNom = stripslashes($userNom);
        $userPrenom = stripslashes($userPrenom);
    }
}
?>
<html>
    <head>
        <title>Gestion des salari&eacute;s</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <script language="JavaScript">
            <!--
            function MM_openBrWindow(theURL, winName, features) { //v2.0
                window.open(theURL, winName, features);
            }
            //-->
        </script>
        <SCRIPT LANGUAGE="JavaScript">
            function Popup(page, options) {
                document.location.href = "../index.php?action=delog";
            }
            function StartTimer(delai) {
                // Déclenche le timer à la fin du chargement de la page (delai est en secondes)
                setTimeout("Popup()", delai * 1000);
            }

            function confirmation()
            {
                if (confirm('vous etes sur le point de supprimer un utilisateur'))
                {
                    location.href = "gestion_salaries11.php?modifier=supprimer&sal_user=".$sal_user;
                }
                else {
                }
            }         
        </SCRIPT>

    </head>

    <body onLoad="StartTimer(<?php
    $time = timeout($paramIdUser);
    echo "$time";
    ?>)" bgcolor="#FFCC66" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
              <?php
              include ("cadrehautent.php");
              ?>
        <form name="salarie" method="post" action="gestion_salaries11.php">
            <table width="620" border="0" cellspacing="0" cellpadding="0" height="178">
                <tr>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0" width="600">
                            <tr>
                                <td><img src="../images_pop/etape2_salaries.gif" height="62"></td>
                                <td><img src="../images_pop/gestion_salaries.gif" width="500" height="62"></td>
                                <td><a href="../aide.php#entreprise" target="_blank"><img src=../lib/images/bandeau_aide_point_interrogation.gif width="28" height="62" border="0"></a></td>
                            </tr>
                        </table>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <?php
                            /*
                             * Initialisation du Bloc HTML
                             */
                            $bloc = "<tr><td><$html_table> ";


                            /*
                             * Date de création de l'utlisateur
                             */

                            $bloc .=$userView->getHtmlDataField(UserModel::FIELDNAME_DATE_CREATION_SALARIES);

                            /*
                             * Association à un groupe d'utilisateur
                             */
//                            $nom_liste = "ascendant_id_salaries";
//                            $liste = "<tr><td <td align=right>" . mysql_field_desc("salaries", "$nom_liste") . " ";
//                            $req_liste = "SELECT id_user, login "
//                                    . "FROM salaries "
//                                    . "ORDER BY login "
//                            ;
//                            if (${"sal_" . $nom_liste}) {
//                                $id_defaut = ${"sal_" . $nom_liste};
//                            } else {
//                                $id_defaut = $id_user;
//                            }
//
//                            $liste .= "</td><td align=left>" . afficher_requete_en_liste_deroulante($req_liste, $id_defaut, $nom_liste);
//                            $liste.= "</td></tr>";
//                            $bloc .=$liste;
                            $bloc .= $userView->getHtmlDataField(UserModel::FIELDNAME_ASENDANT_ID_SALARIES);

                            /*
                             * Identifiant
                             */
                            $bloc .="<tr><td align=right>"
                                    . DatabaseDescription::getFieldDocLabel(UserModel::TABLENAME
                                            , UserModel::KEYNAME)
                                    . "</td><td align=left>$paramIdUser"
                                    . "</td></tr>"
                            ;
                            /*
                             * Affichage
                             */
                            echo $bloc . "</table></td></tr>";
                            IntranetDroitsAccesModel::BuildHtmlDroitsAcces($paramIdUser);
                            ?>

                            <tr>
                                <td class="loginFFFFFF">
                                    <div align="center"><img src=../lib/images/espaceur.gif width="10" height="20">
                                        <table width="500" border="0" cellspacing="4" cellpadding="0" align="center">
                                            <tr>
                                                <td class="loginFFFFFFdroit" width="10%">Nom </td>
                                                <td class="loginFFFFFFdroit" width="22%">
                                                    <INPUT TYPE="TEXT"  name="sal_nom"
                                                    <?php
                                                    echo ("value=\"$userNom\"");
                                                    ?>
                                                           >
                                                </td>
                                                <td class="loginFFFFFFdroit" width="53%">Login
                                                    <INPUT TYPE="TEXT"  name="sal_login"
                                                    <?php
                                                    echo ("value=\"$userLogin\"");
                                                    ?>
                                                           >
                                                </td>
                                                <td width="15%" class="loginFFCC66">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td class="loginFFFFFFdroit" width="10%">Pr&eacute;nom </td>
                                                <td class="loginFFFFFFdroit" width="22%">
                                                    <INPUT TYPE="TEXT"  name="sal_prenom"
                                                    <?php
                                                    echo ("value=\"$userPrenom\"");
                                                    ?>
                                                           >

                                                </td>
                                                <td class="loginFFFFFFdroit" width="53%"> Nouveau mot de passe:
                                                    <INPUT TYPE="password"  name="sal_pass"
                                                    <?php
                                                    echo ("value=\"$sal_pass\"");
                                                    ?>
                                                           >
                                                </td>
                                                <td class="loginFFCC66" width="15%">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td class="loginFFFFFFdroit" width="10%">
                                                    <div align="center"></div>
                                                </td>
                                                <td class="loginFFFFFF" width="22%">
                                                    <div align="right"> </div>
                                                </td>
                                                <td class="loginFFFFFFdroit" width="53%">Mail
                                                    <INPUT TYPE="TEXT"  name="sal_mail"
                                                    <?php
                                                    echo ("value=\"$userMail\"");
                                                    ?>
                                                           >
                                                </td>
                                                <td width="15%">&nbsp; </td>
                                            </tr>
                                        </table>
                                        <table width="500" border="0" cellspacing="4" cellpadding="0" align="center">
                                            <tr>
                                                <td  class="loginFFFFFFdroit">
                                            <center><br>
                                                CSP <br>
                                                <?php
                                                echo ("<select name=\"sal_catsopro\">\n");
                                                /* Constitution de la liste déroulante des noms des csp */
                                                $arrayCatsopro = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                                                "SELECT " . CatsoproModel::KEYNAME . "," . CatsoproModel::FIELDNAME_INTITULE_CAT
                                                                . " FROM " . CatsoproModel::TABLENAME
                                                                . " ORDER BY " . CatsoproModel::FIELDNAME_INTITULE_CAT
                                                );
                                                if ($arrayCatsopro) {
                                                    foreach ($arrayCatsopro as $rowsCatsopro) {
                                                        echo ("<option value=\"" . $rowsCatsopro[CatsoproModel::KEYNAM] . "\"");
                                                        if ($rowsCatsopro[CatsoproModel::KEYNAM] == $userCatsopro)
                                                            echo ("selected");
                                                        echo (">" . $rowsCatsopro[CatsoproModel::FIELDNAME_INTITULE_CAT] . "</option>");
                                                    }
                                                }
                                                echo ("</select>\n");
                                                ?>
                                            </center>
                                            </td>

                                            <?php
                                            /*      echo "<td  class=loginFFFFFFdroit>
                                              <center><br>
                                              Service <br><select name=\"sal_service\">\n";
                                             */
                                            /* Constitution de la liste déroulante des noms des services */
                                            /*
                                              $req="select id_service, intitule_ser from services order by intitule_ser";
                                              $result=DatabaseOperation::query($req);
                                              if ($result!= false)
                                              {
                                              while ($row=mysql_fetch_row($result))
                                              {
                                              echo ("<option value=\"$row[0]\"");
                                              if ($row[0]==$sal_service)
                                              echo ("selected");
                                              echo (">$row[1]</option>");
                                              }
                                              }
                                              echo ("</select>\n");
                                             */

//Service de l'utilisateur
                                            $nom_liste = "sal_service";
                                            $liste = "<td align=right><center><br>" . mysql_field_desc("access_materiel_service", "nom_service") . " ";
                                            $req_liste = "SELECT K_service, nom_service "
                                                    . "FROM access_materiel_service "
                                                    . "ORDER BY nom_service "
                                            ;
                                            if (${$nom_liste}) {
                                                $id_defaut = ${$nom_liste};
                                            } else {
                                                $id_defaut = "";
                                            }

                                            $liste .= "<br>" . afficher_requete_en_liste_deroulante($req_liste, $id_defaut, $nom_liste);
                                            $liste.= "</td>";
                                            echo $liste;
                                            ?>
                                            </center>
                                            </td>
                                            <td  class="loginFFFFFFdroit">
                                            <center><br>
                                                Type<br>
                                                <?php
                                                echo ("<select name=\"sal_type\">\n");
                                                /* Constitution de la liste déroulante des noms des types */
                                                $arrayType = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                                                "SELECT " . TypesModel::KEYNAME
                                                                . ", " . TypesModel::FIELDNAME_INTITULE_TYP
                                                                . " FROM " . TypesModel::TABLENAME
                                                );
                                                if ($arrayType) {
                                                    foreach ($arrayType as $rowType) {
                                                        echo ("<option value=\"" . $rowType[TypesModel::KEYNAME] . "\">" . $rowType[TypesModel::FIELDNAME_INTITULE_TYP] . "</option>");
                                                    }
                                                }
                                                echo ("</select>\n");
                                                ?>
                                            </center>
                                            </td>
                                            <td  class="loginFFFFFFdroit">
                                            <center>
                                                Droit d'&eacute;criture
                                                <?php
                                                echo ("<select name=\"ecriture\">" . makeSelectListChecked($mysql_database, 'salaries', 'ecriture', $ecriture) . "</select>");
                                                ?>
                                            </center>
                                            </td>
                                            </tr>
                                        </table>


                                        <table width="500" border="1" cellspacing="1" cellpadding="3" align="center">

                                            <tr>
                                                <td class="logFFE5B2" colspan="8">
                                            <center>
                                                Fiches techniques - Fiche Identité Produit (FIP)
                                            </center>
                                            </td>
                                            </tr>

                                            <tr>
                                                <td class="loginFFFFFFdroit" valign="top" width="172">
                                            <center>
                                                Ecriture<br>
                                                <?php
// si rajout d'un droit dans la table droift => mettre à jour le fichier gestion_salarie11.php
                                                echo ("<select name=\"ecritureft\">" . makeSelectListChecked($mysql_database, 'droitft', 'ecritureft', $ecritureft) . "</select>");
                                                ?>
                                                <br>
                                            </center>
                                            </td>

                                            <td class="loginFFFFFFdroit" valign="top" width="153">
                                            <center>
                                                Creation<br>
                                                <?php
                                                echo ("<select name=\"creation_ft\">" . makeSelectListChecked($mysql_database, 'droitft', 'creation_ft', $creation_ft) . "</select>");
                                                ?>
                                                <br>
                                            </center>
                                            </td>


                                            <td class="loginFFFFFFdroit" valign="top" width="153">
                                            <center>
                                                Creation FIP<br>
                                                <?php
                                                echo ("<select name=\"creation_fiche_produit\">" . makeSelectListChecked($mysql_database, 'droitft', 'creation_fiche_produit', $creation_fiche_produit) . "</select>");
                                                ?>
                                                <br>
                                            </center>
                                            </td>

                                            <td class="loginFFFFFFdroit" valign="top" width="153">
                                            <center>
                                                Lecture<br>
                                                <?php
                                                echo ("<select name=\"lectureft\">" . makeSelectListChecked($mysql_database, 'droitft', 'lectureft', $lectureft) . "</select>");
                                                ?>
                                                <br>
                                            </center>
                                            </td>

                                            <td class="loginFFFFFFdroit" valign="top" colspan="4" width="159">
                                            <center>
                                                Validation<br>
                                                <?php
                                                echo ("<select name=\"validft\">" . makeSelectListChecked($mysql_database, 'droitft', 'validft', $validft) . "</select>");
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
                                                Statistiques
                                            </center>
                                            </td>
                                            </tr>
                                            <tr>
                                                <td class="loginFFFFFFdroit" valign="top" align="center">
                                            <center>
                                                Droit d'acc&egrave;s au module statistiques<br>
                                                <?php
                                                echo ("<select name=\"droitstat\">" . makeSelectListChecked($mysql_database, 'droitft', 'droitstat', $droitstat) . "</select>");
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
                                                echo ("<select name=\"newsdefil\">" . makeSelectListChecked($mysql_database, 'salaries', 'newsdefil', $newsDefil) . "</select>");
                                                ?>
                                                <br>
                                            </center>
                                            </td>
                                            <td class="loginFFFFFFdroit" valign="top" width="154">
                                            <center>
                                                Membre CE<br>
                                                <?php
                                                echo ("<select name=\"membre_ce\">" . makeSelectListChecked($mysql_database, 'salaries', 'membre_ce', $membreCe) . "</select>");
                                                ?>
                                            </center>
                                            </td>
                                            <td class="loginFFFFFFdroit" valign="top" width="158">
                                            <center>
                                                Localisation<br>
                                                <?php
                                                echo ("<select name=\"new_lieu_geo\">\n");
                                                /* Constitution de la liste déroulante des noms des groupes */
                                                $arrayGeo = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                                                "SELECT " . GeoModel::KEYNAME . "," . GeoModel::FIELDNAME_GEO
                                                                . " FROM " . GeoModel::TABLENAME
                                                                . " WHERE " . GeoModel::FIELDNAME_SITE_ACTIF . " = 1"
                                                                . " ORDER BY " . GeoModel::FIELDNAME_GEO
                                                );
                                                if ($arrayGeo) {
                                                    foreach ($arrayGeo as $rowsGeo) {
                                                        if ($rowsGeo[GeoModel::KEYNAME] == $lieu_geo) {
                                                            echo ("<option value=\"" . $rowsGeo[GeoModel::KEYNAME] . "\" selected>" . $rowsGeo[GeoModel::FIELDNAME_GEO] . "</option>");
                                                        } else {
                                                            echo ("<option value=\"" . $rowsGeo[GeoModel::KEYNAME] . "\">" . $rowsGeo[GeoModel::FIELDNAME_GEO] . "</option>");
                                                        }
                                                    }
                                                }
                                                echo ("</select>\n");


                                                /*                                                 * ***************************************************
                                                  Construction des droits d'accès pour tous les modules:
                                                 * ***************************Boris Sanègre 2003.03.25 */
                                                // require ('droits_acces.inc');                                              
                                                ?>

                                                <tr>
                                                    <td>
                                                        <div align="center"><img src="../images_pop/affectation_droits.gif" width="500" height="30"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><img src=../lib/images/espaceur.gif width="10" height="10"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table width="350" border="0" cellspacing="0" cellpadding="0" align="center">
                                                            <tr>
                                                                <td colspan="2">
                                                                    <div align="center"><input type="image" src="../zimages/modifier-j.gif" width="130" height="20">&nbsp;&nbsp;<a href="#" onClick="confirmation();"><img src="../images-index/supprimer.gif" border=0></a></div>

                                                                    <input type="hidden" name="modifier" value="modifier">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="LOGINFFFFFFCENTRE"><img src=../lib/images/espaceur.gif width="10" height="20"></td>
                                                                <?php
                                                                echo ("<input type=\"hidden\" name=\"modifier\" value=\"modifier\">\n");
                                                                echo ("<input type=\"hidden\" name=\"sal_user\" value=\"$paramIdUser\">\n");
                                                                ?>
                                                                <td class="LOGINFFFFFFCENTRE">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="LOGINFFFFFFCENTRE">
                                                                    <div align="center">Service</div>
                                                                </td>
                                                                <td class="LOGINFFFFFFCENTRE">
                                                                    <div align="center">Niveau</div>
                                                                </td>
                                                            </tr>

                                                            <?php
                                                            /* Lecture de la table MODES et affichage de l'intitule des services avec les niveaux */
                                                            $arrayService = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                                                            "SELECT " . ServicesModel::FIELDNAME_INTITULE_SER . "," . ServicesModel::KEYNAME
                                                                            . " FROM " . ServicesModel::TABLENAME
                                                                            . " ORDER BY " . ServicesModel::FIELDNAME_INTITULE_SER
                                                            );

                                                            if ($arrayService) {
                                                                foreach ($arrayService as $rowsService) {
                                                                    $intituleSer = $rowsService[ServicesModel::FIELDNAME_INTITULE_SER];
                                                                    $idService = $rowsService[ServicesModel::KEYNAME];
                                                                    $intituleSer = stripslashes($intituleSer);
                                                                    /* Pour chaque service on recherche dans la table mode */
                                                                    $arrayServiceConf = DatabaseOperation::convertSqlQueryWithAutomaticKeyToArray(
                                                                                    "SELECT " . ModesModel::FIELDNAME_SERV_CONF . " FROM " . ModesModel::TABLENAME
                                                                                    . " WHERE " . ModesModel::FIELDNAME_ID_USER . "=" . $paramIdUser
                                                                                    . " AND " . ModesModel::FIELDNAME_ID_SERVICE . "=" . $idService
                                                                    );

                                                                    if ($arrayServiceConf) {
                                                                        foreach ($arrayServiceConf as $rowsServiceConf) {
                                                                            $serv_conf = $rowsServiceConf[ModesModel::FIELDNAME_SERV_CONF];
                                                                        }
                                                                    } else {
                                                                        $serv_conf = 0;
                                                                    }
                                                                    echo ("<tr>\n");
                                                                    echo ("  <td class=\"loginFFCC66droit\" width=\"50%\"><img src=../lib/images/espaceur.png width=\"10\" height=\"10\"></td>\n");
                                                                    echo ("  <td width=\"50%\">&nbsp;</td>\n");
                                                                    echo ("</tr>\n");
                                                                    echo ("<tr>\n");
                                                                    echo ("<td>$intituleSer&nbsp;</td>\n");
                                                                    echo ("<td class=\"loginFFCC66droit\" width=\"50%\" align=\"center\">\n");
                                                                    echo ("<input type=\"text\" name=\"$idService\" value=\"$serv_conf\" maxlength=\"2\">\n");
                                                                    echo ("</td>\n");
                                                                    echo ("</tr>\n");
                                                                }
                                                            }
                                                            ?>
                                                        </table>
                                                    </td>
                                                </tr>
                                        </table>
                                </td>
                            </tr>
                        </table>
                        </form>
                        <?php include ("../adminagis/cadrebas.php"); ?>
                        </body>
                        </html>