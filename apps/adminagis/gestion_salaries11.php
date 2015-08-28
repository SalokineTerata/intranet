<?php
//  require('../lib/session.php');
//  include('functions.php');
//  include('../lib/functions.php');
require_once '../inc/main.php';

$globalConfig = new GlobalConfig();
$id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();
$pass = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_PASSWORD)->getFieldValue();
$id_type = $globalConfig->getAuthenticatedUser()->getDataField(UserModel::FIELDNAME_ID_TYPE)->getFieldValue();

$idUser = Lib::getParameterFromRequest('sal_user');
/**
 * Initialisation
 */
$userModel = new UserModel($idUser);
$paramUserLogin = $userModel->getDataField(UserModel::FIELDNAME_LOGIN)->getFieldValue();
$paramUserNom = $userModel->getDataField(UserModel::FIELDNAME_NOM)->getFieldValue();
$paramUserPrenom = $userModel->getDataField(UserModel::FIELDNAME_PRENOM)->getFieldValue();
$paramUserCatsopro = $userModel->getDataField(UserModel::FIELDNAME_ID_CATSOPRO)->getFieldValue();
$paramUserService = $userModel->getDataField(UserModel::FIELDNAME_ID_SERVICE)->getFieldValue();
$paramDateCreationUser = $userModel->getDataField(UserModel::FIELDNAME_DATE_CREATION_SALARIES)->getFieldValue();
$paramAscendantIdSalaries = $userModel->getDataField(UserModel::FIELDNAME_ASENDANT_ID_SALARIES)->getFieldValue();
$paramNewsDefil = $userModel->getDataField(UserModel::FIELDNAME_NEWSDEFIL)->getFieldValue();
$paramNewLieuGeo = $userModel->getDataField(UserModel::FIELDNAME_LIEU_GEO)->getFieldValue();
$paramMembreCe = $userModel->getDataField(UserModel::FIELDNAME_MEMBRE_CE)->getFieldValue();
$paramEcriture = $userModel->getDataField(UserModel::FIELDNAME_ECRITURE)->getFieldValue();
$paramUserMail = $userModel->getDataField(UserModel::FIELDNAME_MAIL)->getFieldValue();
$paramModifier = Lib::getParameterFromRequest('modifier');
$paramLectureft = Lib::getParameterFromRequest('lectureft');
$paramValidft = Lib::getParameterFromRequest('validft');
$paramCreationft = Lib::getParameterFromRequest('creation_ft');
$paramEcritureft = Lib::getParameterFromRequest('ecritureft');
$paramCreationFicheProduit = Lib::getParameterFromRequest('creation_fiche_produit');
$paramDroitstat = Lib::getParameterFromRequest('droitstat');
identification1('salaries', $id_user, $pass);
UserModel::securadmin(4, $id_type);


/*
 *  Modification de l'utilisateur
 */
if ($paramModifier == 'modifier') {
    //*********************** SALARIES ***********************//
    $paramUserPrenom = addslashes($paramUserPrenom);
    $paramUserNom = strtoupper($paramUserNom);
    $req = 'UPDATE ' . UserModel::TABLENAME
            . ' SET ' . UserModel::FIELDNAME_NOM . '=\'' . $paramUserNom . '\''
            . ', ' . UserModel::FIELDNAME_PRENOM . '=\'' . $paramUserPrenom . '\''
            . ', ' . UserModel::FIELDNAME_ID_CATSOPRO . '=\'' . $paramUserCatsopro . '\''
            . ', ' . UserModel::FIELDNAME_ID_SERVICE . '=\'' . $paramUserService . '\''
            . ', ' . UserModel::FIELDNAME_ID_TYPE . '=\'' . $sal_type . '\''
            . ', ' . UserModel::FIELDNAME_LOGIN . '=\'' . $paramUserLogin . '\','
    ;
    if ($paramUserPass) {
        $req .= UserModel::FIELDNAME_PASSWORD . '=PASSWORD(\'' . $paramUserPass . '\'), ';
    }
    $req .= UserModel::FIELDNAME_MAIL . '=\'' . $paramUserMail . '\''
            . ', ' . UserModel::FIELDNAME_ECRITURE . '=\'' . $paramEcriture . '\''
            . ', ' . UserModel::FIELDNAME_MEMBRE_CE . '=\'' . $paramMembreCe . '\''
            . ', ' . UserModel::FIELDNAME_LIEU_GEO . '=\'' . $paramNewLieuGeo . '\''
            . ', ' . UserModel::FIELDNAME_NEWSDEFIL . '=\'' . $paramNewsDefil . '\''
            . ', ' . UserModel::FIELDNAME_ASENDANT_ID_SALARIES . '=\'' . $paramAscendantIdSalaries . '\''
            . ', ' . UserModel::FIELDNAME_DATE_CREATION_SALARIES . '=\'' . $paramDateCreationUser . '\''
            . ' WHERE ' . UserModel::KEYNAME . '=' . $idUser
    ;

    DatabaseOperation::execute($req);

    DatabaseOperation::execute(
            'UPDATE ' . DroitftModel::TABLENAME
            . ' SET ' . DroitftModel::FIELDNAME_ECRITUREFT . '=\'' . $paramEcritureft
            . '\', ' . DroitftModel::FIELDNAME_LECTUREFT . '=\'' . $paramLectureft
            . '\', ' . DroitftModel::FIELDNAME_CREATION_FT . '=\'' . $paramCreationft
            . '\', ' . DroitftModel::FIELDNAME_CREATION_FICHE_PRODUIT . '=\'' . $paramCreationFicheProduit
            . '\', ' . DroitftModel::FIELDNAME_VALIDFT . '=\'' . $paramValidft
            . '\', ' . DroitftModel::FIELDNAME_DROITSTAT . '=\'' . $paramDroitstat
            . '\' WHERE ' . DroitftModel::FIELDNAME_ID_USER . '=' . $idUser
    );

    //************************ MODES ************************//
    /*
     *  Requete pour lire tous les champs text nommes avec le numero du service
     */
    $arrayService = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                    'SELECT DISTINCT ' . ServicesModel::KEYNAME
                    . ' FROM ' . ServicesModel::TABLENAME
                    . ' ORDER BY ' . ServicesModel::KEYNAME
    );

    if ($arrayService) {

        foreach ($arrayService as $rowsService) {
            /*
             *  Recuperation du service et du niveau a affecter
             */
            $service = $rowsService[ServicesModel::KEYNAME];
            $toto = 'service';
            $text = $$toto;
            $niveau = $$text;
            /*
             *  Update dans la table pour chaque service
             */
            $result2 = DatabaseOperation::execute('UPDATE ' . ModesModel::TABLENAME
                            . ' SET ' . ModesModel::FIELDNAME_SERV_CONF . ' = \'' . $niveau . '\''
                            . ' WHERE ' . ModesModel::FIELDNAME_ID_USER . ' =' . $idUser
                            . ' AND ' . ModesModel::FIELDNAME_ID_SERVICE . ' =\'' . $service . '\''
            );
            if ($result2 == false) {
                echo ('Update impossible pour le service $service pour le salarie $idUser </br>');
            }
        }
    }

    /*     * ********************************************
      Mise à jour des droits d'accès de l'utilisateur
     * ********************Boris Sanègre 2003.03.28**
     * ********************Boris Sanègre 2007.01.09 */

    /*
     * Récupération des droits d'accès faisable dans l'Intranet
     */

    $arrayModule = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                    'SELECT ' . IntranetModulesModel::TABLENAME . '.*'
                    . ', ' . IntranetActionsModel::TABLENAME . '.*'
                    . ' FROM ' . IntranetActionsModel::TABLENAME . ', ' . IntranetModulesModel::TABLENAME
                    . ' WHERE (' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS
                    . '=' . IntranetModulesModel::TABLENAME . '.' . IntranetModulesModel::KEYNAME
                    . ' OR ' . IntranetActionsModel::TABLENAME . '.' . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS . '=0 )'
    );
    foreach ($arrayModule as $rowsModule) {

        /*
         * Déclaration du droits d'accès fourni par droits_acces.inc et récupération de son niveau d'accès
         */
        if ($rowsModule[IntranetModulesModel::KEYNAME] <> 19) {
            $nom_niveau_intranet_droits_acces = 'module' . $rowsModule[IntranetModulesModel::KEYNAME] . '_action' . $rowsModule[IntranetActionsModel::KEYNAME];
        } else {
            $nom_niveau_intranet_droits_acces = $rowsModule[IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS] . '_' . $rowsModule[IntranetActionsModel::KEYNAME];
        }
        $niveau_intranet_droits_acces = Lib::getParameterFromRequest($nom_niveau_intranet_droits_acces);

        /*
         * Enregistrement/Suppression du droit d'accès
         */
        $id_intranet_modules = $rowsModule[IntranetModulesModel::KEYNAME];
        $id_intranet_actions = $rowsModule[IntranetActionsModel::KEYNAME];
        /*
         * Suppression des anciens accès
         */
        DatabaseOperation::execute(
                'DELETE FROM ' . IntranetDroitsAccesModel::TABLENAME
                . ' WHERE ' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES . '=' . $id_intranet_modules
                . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $idUser
                . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . '=' . $id_intranet_actions
        );

        if ($niveau_intranet_droits_acces) {
            /*
             * Réécriture du droits d'accès
             */
            DatabaseOperation::execute(
                    'INSERT INTO ' . IntranetDroitsAccesModel::TABLENAME
                    . ' SET ' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES . '=' . $id_intranet_modules
                    . ', ' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $idUser
                    . ', ' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . '=' . $id_intranet_actions
                    . ', ' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . $niveau_intranet_droits_acces
            );
        }
    }
}


/*
 * Fin de if($modifier=='modifier')
 */
/*
 *  Suppression de l'utilisateur
 */
if ($paramModifier == 'supprimer') {
    UserModel::suppressionIntranetUtilisateur($idUser);
}
?>
<html>
    <head>
        <title>Gestion des salari&eacute;s</title>
        <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
        <script language='JavaScript'>
            <!--
            function MM_openBrWindow(theURL, winName, features) { //v2.0
                window.open(theURL, winName, features);
            }
            //-->
        </script>
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
    $time = timeout($id_user);
    echo $time;
    ?>)' bgcolor='#FFCC66' text='#000000' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
              <?php
              include ('cadrehautent.php');
              ?>
        <form name='rechnom' method='post' action='gestion_salaries22.php'>
            <table width='620' border='0' cellspacing='0' cellpadding='0'>
                <tr>
                    <td>
                        <table border='0' cellspacing='0' cellpadding='0' width='600'>
                            <tr>
                                <td><img src='../images_pop/etape1_salaries.gif' height='62'></td>
                                <td><img src='../images_pop/gestion_salaries.gif' width='500' height='62'></td>
                                <td><a href='../aide.php#entreprise' target='_blank'><img src=../lib/images/bandeau_aide_point_interrogation.gif width='28' height='62' border='0'></a></td>
                            </tr>
                        </table>
                        <table width='600' border='0' cellspacing='0' cellpadding='0' align='center'>
                            <tr>
                                <td><img src=../lib/images/espaceur.gif width='10' height='20'></td>
                            </tr>
                            <tr>
                                <td class='loginFFFFFF'>
                                    <div align='center'><img src='../images_pop/modif_sal.gif' width='500' height='30'></div>
                                </td>
                            </tr>
                            <tr>
                                <td class='loginFFFFFF'>
                                    <div align='center'>
                                        Nom du salari&eacute; &agrave; modifier
                                        <?php
                                        echo '</td>';
                                        echo '</tr>';
                                        echo '<tr>';
                                        echo '<td>';

                                        echo '<div align=center>';
                                        echo ('<select name=\'sal_user\' size=20>');
                                        /* Constitution de la liste déroulante des noms */
                                        $arrayIdUser = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                                        'SELECT ' . UserModel::KEYNAME
                                                        . ', ' . UserModel::FIELDNAME_NOM
                                                        . ', ' . UserModel::FIELDNAME_PRENOM
                                                        . ' FROM ' . UserModel::TABLENAME
                                                        . ' WHERE ' . UserModel::FIELDNAME_ACTIF . '=\'oui\''
                                                        . ' ORDER BY ' . UserModel::FIELDNAME_NOM
                                        );
                                        if ($arrayIdUser) {
                                            foreach ($arrayIdUser as $rowIdUser) {
                                                echo ('<option value=' . $rowIdUser[UserModel::KEYNAME] . '>' . $rowIdUser[UserModel::FIELDNAME_NOM] . ' ' . $rowIdUser[UserModel::FIELDNAME_PRENOM] . '</option>');
                                            }
                                        }
                                        echo ('</select></br>');
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><img src=../lib/images/espaceur.gif width='10' height='10'></td>
                            </tr>
                            <tr>
                                <td>
                                    <div align='center'><input type='image' src='../images_pop/chercher.gif' width='130' height='20'></div>
                                    <input type='hidden' name='rech' value='1'>
                                </td>
                            </tr>
                            <tr>
                                <td align='center' valign='top'><img src=../lib/images/espaceur.gif width='10' height='30'>
                                    <table width='80%' border='1' cellspacing='0' cellpadding='0' bordercolor='#FFE5B2'>
                                        <tr>
                                            <td colspan='3'><b>SUPER ADMINISTRATEUR</b></td>
                                        </tr>

                                        <?php
                                        /* Recherche des salaries qui sont super admin */
                                        /* echo  $req='select nom, prenom, intitule_cat, intitule_ser
                                          from services, salaries, catsopro
                                          where salaries.id_type=4 and
                                          salaries.id_service=services.id_service
                                          and salaries.id_catsopro=catsopro.id_catsopro
                                          and actif='oui' order by nom';
                                         */

                                        $type4 = 4;
                                        $arrayUserType4 = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                                        'SELECT ' . UserModel::FIELDNAME_NOM . ', ' . UserModel::FIELDNAME_PRENOM
                                                        . ', ' . CatsoproModel::FIELDNAME_INTITULE_CAT . ', ' . AccessMaterielServiceModel::FIELDNAME_NOM_SERVICE
                                                        . ' FROM ' . AccessMaterielServiceModel::TABLENAME . ',' . UserModel::TABLENAME
                                                        . ', ' . CatsoproModel::TABLENAME
                                                        . ' WHERE ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_ID_TYPE . '=' . $type4
                                                        . ' AND ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_ID_SERVICE . '=' . AccessMaterielServiceModel::TABLENAME . '.' . AccessMaterielServiceModel::FIELDNAME_K_SERVICE
                                                        . ' AND ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_ID_CATSOPRO . '=' . CatsoproModel::TABLENAME . '.' . CatsoproModel::KEYNAME
                                                        . ' AND ' . UserModel::FIELDNAME_ACTIF . '=\'oui\' ORDER BY ' . UserModel::FIELDNAME_NOM);
                                        if ($arrayUserType4) {

                                            foreach ($arrayUserType4 as $rowsUser) {
                                                $paramUserPrenom = $rowsUser[UserModel::FIELDNAME_PRENOM];
                                                $paramUserNom = $rowsUser[UserModel::FIELDNAME_NOM];
                                                $intitule_ser = $rowsUser[AccessMaterielServiceModel::FIELDNAME_NOM_SERVICE];
                                                $intitule_cat = $rowsUser[CatsoproModel::FIELDNAME_INTITULE_CAT];

                                                echo ('<tr>');
                                                echo ('<td class=\'loginFFFFFF\'>' . $paramUserPrenom . ' ' . $paramUserNom . '</td>');
                                                echo ('<td class=\'loginFFFFFF\'>' . $intitule_ser . '</td>');
                                                echo ('<td class=\'loginFFFFFF\'>' . $intitule_cat . '</td>');
                                                echo ('</tr>');
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td colspan='3'><b>ADMINISTRATEUR</b></td>
                                        </tr>
                                        <?php
                                        /* Recherche des salaries qui sont super admin */
                                        $type3 = 3;
                                        $arrayUserType3 = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                                        'SELECT ' . UserModel::FIELDNAME_NOM . ', ' . UserModel::FIELDNAME_PRENOM
                                                        . ', ' . CatsoproModel::FIELDNAME_INTITULE_CAT . ', ' . AccessMaterielServiceModel::FIELDNAME_NOM_SERVICE
                                                        . ' FROM ' . AccessMaterielServiceModel::TABLENAME . ',' . UserModel::TABLENAME
                                                        . ', ' . CatsoproModel::TABLENAME
                                                        . ' WHERE ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_ID_TYPE . '=' . $type3
                                                        . ' AND ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_ID_SERVICE . '=' . AccessMaterielServiceModel::TABLENAME . '.' . AccessMaterielServiceModel::FIELDNAME_K_SERVICE
                                                        . ' AND ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_ID_CATSOPRO . '=' . CatsoproModel::TABLENAME . '.' . CatsoproModel::KEYNAME
                                                        . ' AND ' . UserModel::FIELDNAME_ACTIF . '=\'oui\' ORDER BY ' . UserModel::FIELDNAME_NOM);
                                        if ($arrayUserType3) {

                                            foreach ($arrayUserType3 as $rowsUser) {
                                                $paramUserPrenom = $rowsUser[UserModel::FIELDNAME_PRENOM];
                                                $paramUserNom = $rowsUser[UserModel::FIELDNAME_NOM];
                                                $intitule_ser = $rowsUser[AccessMaterielServiceModel::FIELDNAME_NOM_SERVICE];
                                                $intitule_cat = $rowsUser[CatsoproModel::FIELDNAME_INTITULE_CAT];


                                                echo ('<tr>');
                                                echo ('<td class=\'loginFFFFFF\'>' . $paramUserPrenom . ' ' . $paramUserNom . '</td>');
                                                echo ('<td class=\'loginFFFFFF\'>' . $intitule_ser . '</td>');
                                                echo ('<td class=\'loginFFFFFF\'>' . $intitule_cat . '</td>');
                                                echo ('</tr>');
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td colspan='3'><b>PUBLICATEUR-MODIFICATEUR</b></td>
                                        </tr>
                                        <?php
                                        /* Recherche des salaries qui sont super admin */
                                        $type2 = 2;
                                        $arrayUserType2 = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                                        'SELECT ' . UserModel::FIELDNAME_NOM . ', ' . UserModel::FIELDNAME_PRENOM
                                                        . ', ' . CatsoproModel::FIELDNAME_INTITULE_CAT . ', ' . AccessMaterielServiceModel::FIELDNAME_NOM_SERVICE
                                                        . ' FROM ' . AccessMaterielServiceModel::TABLENAME . ',' . UserModel::TABLENAME
                                                        . ', ' . CatsoproModel::TABLENAME
                                                        . ' WHERE ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_ID_TYPE . '=' . $type2
                                                        . ' AND ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_ID_SERVICE . '=' . AccessMaterielServiceModel::TABLENAME . '.' . AccessMaterielServiceModel::FIELDNAME_K_SERVICE
                                                        . ' AND ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_ID_CATSOPRO . '=' . CatsoproModel::TABLENAME . '.' . CatsoproModel::KEYNAME
                                                        . ' AND ' . UserModel::FIELDNAME_ACTIF . '=\'oui\' ORDER BY ' . UserModel::FIELDNAME_NOM);
                                        if ($arrayUserType2) {

                                            foreach ($arrayUserType2 as $rowsUser) {
                                                $paramUserPrenom = $rowsUser[UserModel::FIELDNAME_PRENOM];
                                                $paramUserNom = $rowsUser[UserModel::FIELDNAME_NOM];
                                                $intitule_ser = $rowsUser[AccessMaterielServiceModel::FIELDNAME_NOM_SERVICE];
                                                $intitule_cat = $rowsUser[CatsoproModel::FIELDNAME_INTITULE_CAT];


                                                echo ('<tr>');
                                                echo ('<td class=\'loginFFFFFF\'>' . $paramUserPrenom . ' ' . $paramUserNom . '</td>');
                                                echo ('<td class=\'loginFFFFFF\'>' . $intitule_ser . '</td>');
                                                echo ('<td class=\'loginFFFFFF\'>' . $intitule_cat . '</td>');
                                                echo ('</tr>');
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td colspan='3'><b>LECTEUR</b></td>
                                        </tr>
                                        <?php
                                        /* Recherche des salaries qui sont super admin */
                                        $type1 = 1;
                                        $arrayUserType1 = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                                        'SELECT ' . UserModel::FIELDNAME_NOM . ', ' . UserModel::FIELDNAME_PRENOM
                                                        . ', ' . CatsoproModel::FIELDNAME_INTITULE_CAT . ', ' . AccessMaterielServiceModel::FIELDNAME_NOM_SERVICE
                                                        . ' FROM ' . AccessMaterielServiceModel::TABLENAME . ',' . UserModel::TABLENAME
                                                        . ', ' . CatsoproModel::TABLENAME
                                                        . ' WHERE ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_ID_TYPE . '=' . $type1
                                                        . ' AND ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_ID_SERVICE . '=' . AccessMaterielServiceModel::TABLENAME . '.' . AccessMaterielServiceModel::FIELDNAME_K_SERVICE
                                                        . ' AND ' . UserModel::TABLENAME . '.' . UserModel::FIELDNAME_ID_CATSOPRO . '=' . CatsoproModel::TABLENAME . '.' . CatsoproModel::KEYNAME
                                                        . ' AND ' . UserModel::FIELDNAME_ACTIF . '=\'oui\' ORDER BY ' . UserModel::FIELDNAME_NOM);
                                        if ($arrayUserType1) {

                                            foreach ($arrayUserType1 as $rowsUser) {
                                                $paramUserPrenom = $rowsUser[UserModel::FIELDNAME_PRENOM];
                                                $paramUserNom = $rowsUser[UserModel::FIELDNAME_NOM];
                                                $intitule_ser = $rowsUser[AccessMaterielServiceModel::FIELDNAME_NOM_SERVICE];
                                                $intitule_cat = $rowsUser[CatsoproModel::FIELDNAME_INTITULE_CAT];

                                                echo ('<tr>');
                                                echo ('<td class=\'loginFFFFFF\'>' . $paramUserPrenom . ' ' . $paramUserNom . '</td>');
                                                echo ('<td class=\'loginFFFFFF\'>' . $intitule_ser . '</td>');
                                                echo ('<td class=\'loginFFFFFF\'>' . $intitule_cat . '</td>');
                                                echo ('</tr>');
                                            }
                                        }
                                        ?>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div align='center'></div>
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
            </table>
            <?php include ('../adminagis/cadrebas.php'); ?>
    </body>
</html>