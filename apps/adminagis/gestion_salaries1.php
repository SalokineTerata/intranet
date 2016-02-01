<?php
/*
  Include Agis
 */
//  include ('../lib/session.php');
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
$idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
$pass = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_PASSWORD)->getFieldValue();
$id_type = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_ID_TYPE)->getFieldValue();



$modifier = Lib::getParameterFromRequest('modifier');
$userModel = new UserModel($idUser);
$userView = new UserView($userModel);
$userView->setIsEditable(TRUE);
identification1('salaries', $idUser, $pass, FALSE);
//  include('functions.php');
//  include('functions.js');
//if ($erreur == 'oui') {
//    echo ('<script language=\'JavaScript\'>\n');
//    echo ('alert(\'Ce salarié existe déjà\')');
//    echo ('</script>\n');
//}
//if ($erreur == 'pass') {
//    echo ('<script language=\'JavaScript\'>\n');
//    echo ('alert(\'Erreur de mot de passe\')');
//    echo ('</script>\n');
//}

/*
 *  Gestion des updates dans la table MODES
 */
if ($modifier == 'modifier') {
    /*
     *  Requete pour lire tous les champs text nommes avec le numero du service
     */
    $arrayService = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                    'SELECT DISTINCT ' . ServicesModel::KEYNAME
                    . ',' . ServicesModel::FIELDNAME_INTITULE_SER
                    . ' FROM ' . ServicesModel::TABLENAME
                    . ' ORDER BY ' . ServicesModel::KEYNAME
    );
    if ($arrayService) {
        foreach ($arrayService as $rowsService) {
            /*
             *  Recuperation du service et du niveau a affecter
             */
            $service = $rowsService[ServicesModel::KEYNAME];
            $nomService = $rowsService[ServicesModel::FIELDNAME_INTITULE_SER];
            $toto = 'service';
            $text = $$toto;
            $niveau = $$text;
            /*
             *  Update dans la table pour chaque service
             */
            $resultUpdateService = DatabaseOperation::execute(
                            'UPDATE ' . ModesModel::TABLENAME
                            . ' SET ' . ModesModel::FIELDNAME_SERV_CONF . '=' . $niveau
                            . ' WHERE ' . ModesModel::FIELDNAME_ID_USER . '=\' ' . $idUser
                            . '\' AND ' . ModesModel::FIELDNAME_ID_SERVICE . '=\'' . $service . '\''
            );
            if ($resultUpdateService == false)
                echo ('Update impossible pour le service ' . $nomService . ' ( ' . $service . ' ) pour le salarie ' . $idUser);
            $i++;
        }
    }
}
?>
<html>
    <head>
        <title>Gestion des salari&eacute;s</title>
        <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>

        <SCRIPT LANGUAGE='JavaScript'>
            function Popup(page, options) {
                document.location.href = '../index.php?action=delog';
            }
            function StartTimer(delai) {
                // Déclenche le timer à la fin du chargement de la page (delai est en secondes)
                setTimeout('Popup()', delai * 1000);
            }
        </SCRIPT>
    </head>

    <body onLoad='StartTimer(<?php
    $time = timeout($idUser);
    echo $time;
    ?>)' bgcolor='#FFCC66' text='#000000' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
              <?php
              include ('cadrehautent.php');
              ?>
        <form name='salarie' method='post' action='gestion_salaries2.php'>
            <table width='320' border='0' cellspacing='0' cellpadding='0'class='loginFFFFFFdroit' >
                <tr>
                    <td >
                        <table border='0' cellspacing='0' cellpadding='0' width='600'>
                            <tr>
                                <td><img src='../images_pop/etape1_salaries.gif'></td>
                                <td><img src='../images_pop/gestion_salaries.gif' width='500' height='62'></td>
                                <td><a href='../aide.php#entreprise' target='_blank'><img src=../lib/images/bandeau_aide_point_interrogation.gif width='28' height='62' border='0'></a></td>
                            </tr>
                        </table>
                        <table width='620' border='0' cellspacing='0' cellpadding='0' align='center'>
                            <?php
                            /*
                             * Initialisation du Bloc HTML
                             */
                            $bloc = '<tr><td><' . $html_table . '> ';

                            /*
                             * Date de création de l'utlisateur
                             */
                            $bloc .='<tr><td align=right>'
                                    . DatabaseDescription::getFieldDocLabel(UserModel::TABLENAME, UserModel::FIELDNAME_DATE_CREATION_SALARIES)
                                    . '</td><td align=left><input type=text name=' . UserModel::FIELDNAME_DATE_CREATION_SALARIES . ' size=15  value='
                                    . date('d-m-Y') . ' />'
                                    . '</td></tr>'
                            ;

                            /*
                             * Association à un groupe d'utilisateur
                             */
//                $HtmlList = new HtmlListSelectTagName();
//                $arrayAscendant = DatabaseOperation::convertSqlStatementWithKeyAndOneFieldToArray(
//                                'SELECT ' . UserModel::KEYNAME . ', ' . UserModel::FIELDNAME_LOGIN
//                                . ' FROM ' . UserModel::TABLENAME
//                                . ' ORDER BY ' . UserModel::FIELDNAME_LOGIN
//                );
//                $HtmlList->setArrayListContent($arrayAscendant);
//                $HtmlList->getAttributes()->getName()->setValue(UserModel::FIELDNAME_ASENDANT_ID_SALARIES);
//                $HtmlList->setLabel(DatabaseDescription::getFieldDocLabel(UserModel::TABLENAME
//                                , UserModel::FIELDNAME_ASENDANT_ID_SALARIES));
//                $HtmlList->setIsEditable(TRUE);
//                $listeAscendant = $HtmlList->getHtmlResult();
//                $bloc .=$listeAscendant;
                            /*
                              $HtmlListBoolen = new HtmlListBoolean();
                              $HtmlListBoolen->getAttributes()->getName()->setValue(UserModel::FIELDNAME_ECRITURE);
                              $HtmlListBoolen->setLabel('Droit d'&eacute;criture');
                              $HtmlListBoolen->setIsEditable(TRUE);
                              $listeEcriture = $HtmlListBoolen->getHtmlResult();
                             * */

                            /*
                             * Affichage
                             */
                            echo $bloc . $listeEcriture . '</table></td></tr>';
                            ?>
                            <tr>
                                <td><img src=../lib/images/espaceur.gif width='10' height='30'></td>
                            </tr>
                            <tr>
                                <td>
                                    <div align='center'><img src='../images_pop/inser_sal.gif' width='500' height='30'></div>
                                </td>
                            </tr>
                        </table>
                        <img src=../lib/images/espaceur.gif width='10' height='10'>
                    </td>
                </tr>


                <table width='500' border='0' cellspacing='4' cellpadding='0' align='center'>
                    <tr>
                        <td class='loginFFFFFFdroit' width='25%'>Nom :</td>
                        <td class='loginFFFFFFdroit' width='25%'>
                            <input type='text' name='sal_nom' size='15' class='loginFFFFFFdroit'>
                        </td>
                        <td class='loginFFFFFFdroit' width='35%'>Login : </td>
                        <td class='loginFFFFFFdroit' width='45%' valign='middle'>
                            <div align='left'>
                                <input type='text' name='sal_login' size='15' class='txtfield'>
                            </div>
                        </td>
                        <td width='25%' class='loginFFCC66'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class='loginFFFFFFdroit' width='25%'>Pr&eacute;nom :</td>
                        <td class='loginFFFFFFdroit' width='25%'>
                            <input type='text' name='sal_prenom' size='15' class='loginFFFFFFdroit'>
                        </td>
                        <td class='loginFFFFFFdroit' width='35%'>Mot de passe : </td>
                        <td class='loginFFFFFFdroit' width='45%' valign='middle'>
                            <div align='left'>
                                <input type='password' name='sal_pass' class='txtfield' size='15'>
                            </div>
                        </td>
                        <td class='loginFFCC66' width='25%'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class='loginFFFFFFdroit' width='25%'>
                            <div align='right'>Mail :</div>
                        </td>
                        <td class='loginFFFFFF' width='25%'>
                            <div align='right'>
                                <input type='text' name='sal_mail' class='txtfield' size='19'>
                            </div>

                        </td>
                        <td class='loginFFFFFFdroit' width='35%'>Confirmation :</td>
                        <td class='loginFFFFFFdroit' width='45%' valign='middle'>
                            <div align='left'>
                                <input type='password' name='sal_pass2' class='txtfield' size='15'>
                            </div> 
                        </td>
                        <td width='25%'>&nbsp; </td>
                    </tr>
                </table>
                <table width='500' border='0' cellspacing='4' cellpadding='0' align='center'>
                    <tr>
                        <td  class='loginFFFFFFdroit'>
                    <center><br>
                        <span class='loginFFFFFFdroit'>CSP</span> <br>
                        <?php
                        echo ('<select name=\'catsopro\'>\n');
                        /*
                         *  Constitution de la liste déroulante des noms des groupes 
                         */
                        $arrayCatsopro = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                        'SELECT ' . CatsoproModel::KEYNAME
                                        . ', ' . CatsoproModel::FIELDNAME_INTITULE_CAT
                                        . ' FROM ' . CatsoproModel::TABLENAME
                                        . ' ORDER BY ' . CatsoproModel::KEYNAME
                        );
                        if ($arrayCatsopro) {
                            foreach ($arrayCatsopro as $rowsCatsopro) {
                                echo ('<option value=\'' . $rowsCatsopro[CatsoproModel::KEYNAME] . '\'>' . $rowsCatsopro[CatsoproModel::FIELDNAME_INTITULE_CAT] . '</option>');
                            }
                        }

                        echo ('</select>');
                        ?>
                    </center>
                    </td>
                    <td  class='loginFFFFFFdroit'>
                    <center><br>
                        <span class='loginFFFFFFdroit'>Lieu Geo</span> <br>
                        <?php
                        echo ('<select name=\'lieu_geo\'>\n');
                        /*
                         *  Constitution de la liste déroulante des lieu géogrphique 
                         */
                        $arrayLieuGeo = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                        "SELECT " . GeoModel::KEYNAME
                                        . ", " . GeoModel::FIELDNAME_GEO
                                        . " FROM " . GeoModel::TABLENAME
                                        . " WHERE " . GeoModel::FIELDNAME_SITE_ACTIF . "=1"
                                        . " ORDER BY " . GeoModel::KEYNAME
                        );
                        if ($arrayLieuGeo) {
                            foreach ($arrayLieuGeo as $rowsLieuGeo) {
                                echo ('<option value=\'' . $rowsLieuGeo[GeoModel::KEYNAME] . '\'>' . $rowsLieuGeo[GeoModel::FIELDNAME_GEO] . '</option>');
                            }
                        }

                        echo ('</select>');
                        ?>
                    </center>
                    </td>
                    </tr>
                </table><br>
                <?php
                /*
                 * Construction des droits d'accès pour tous les modules:
                 * Boris Sanègre 2003.03.25                
                 */
                IntranetDroitsAccesModel::BuildHtmlDroitsAcces();

// Fin de la page

                echo '<center>';
                echo '<a href=# onClick=nonvide();><img src=../zimages/valider-j.gif width=130 height=20 border=0 alt=`Enregistrement d\'un salarié`></a>';
                echo '<input type=hidden name=valider value=valider>';
                echo '</center>';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>&nbsp;</td>';
                echo '</tr>';
                echo '</table>';
                echo '</form>';

                include ('../adminagis/cadrebas.php');
                echo '</body>';
                echo '</html>';

                include ('../inc/footer.php');
                