<?php

// INCLUDE permettant de naviguer au sein des modules
//***************************************************
$id_user = Lib::isDefined('id_user');
$nom_intranet_modules = Lib::isDefined('nom_intranet_modules');
$intranet_module_public = Lib::isDefined('intranet_module_public');
$globalConfig = new GlobalConfig();


echo '
<table width=\'150\' border=\'0\' cellspacing=\'0\' cellpadding=\'0\' >
  <tr><td height=\'28\'width=\'150\' background=\'../lib/images/bandeau_vague.png\'></td></tr>
  <tr><td><table width=\'100%\' border=\'0\' cellspacing=\'2\' cellpadding=\'0\' bgcolor=\'#FFE5B2\'>
';

/* * ****************************************************************
  Création des boutons permettant d'accéder aux modules de l'intranet
 * **************************************************************** */

//Variables spécifiques:
$limite_colonne = 3; //Nombre de bouton maximum par ligne
$i = 1;              //Compteur du positionnement du bouton



/* Modules Public
 * ************* */
echo '<tr>';

//Création des boutons
if ($intranet_module_public) {
    foreach ($intranet_module_public as $rows1) {
        $nom_intranet_modules = $rows1['nom_intranet_modules'];
        $nom_usuel_intranet_modules = $rows1['nom_usuel_intranet_modules'];
        if ($i > $limite_colonne) {
            echo '</tr>';
            $i = 1;
        }
        echo '<td align=center>';
        echo '<a href=' . $globalConfig->getConf()->getUrlFullRoot() . '/' . $nom_intranet_modules . ' target=_top>';
	echo '<img src=' . $globalConfig->getConf()->getUrlFullRoot() . '/' . $nom_intranet_modules . '/images/bouton_module.png width=34 height=34 border=0 alt=`' . $nom_usuel_intranet_modules . '`>';
        echo '</a>';
        echo '</td>';
        $i = $i + 1;
    }
}

/* Modules sous droits d'accès utilisateur
 * ************************************** */
if ($id_user) {//Si l'utilisateur est connecté
    //Requête selectionnant les modules de l'intranet visible par l'utilisateur pouvant consulter le droit d'accès:
    $arrayModule = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                    ' SELECT ' . IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES . ',' . IntranetModulesModel::FIELDNAME_NOM_USUEL_INTRANET_MODULES
                    . ' FROM ' . IntranetModulesModel::TABLENAME . ', ' . IntranetDroitsAccesModel::TABLENAME
                    . ' WHERE (' . IntranetModulesModel::TABLENAME . '.' . IntranetModulesModel::KEYNAME
                    . '=' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES
                    . ' AND ' . IntranetModulesModel::FIELDNAME_VISIBLE_INTRANET_MODULES . '=' . '1'
                    . ' AND ' . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . '=' . '1'
                    . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_ID_USER . '=' . $id_user . ' '
                    . ' AND ' . IntranetDroitsAccesModel::TABLENAME . '.' . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . '=' . '1' . ') '
                    . ' ORDER BY ' . IntranetModulesModel::FIELDNAME_CLASSEMENT_INTRANET_MODULES . ' DESC'
    );

    foreach ($arrayModule as $rowsModule) {
        $nom_intranet_modules = $rowsModule[IntranetModulesModel::FIELDNAME_NOM_INTRANET_MODULES];
        $nom_usuel_intranet_modules = $rowsModule[IntranetModulesModel::FIELDNAME_NOM_USUEL_INTRANET_MODULES];
        if ($i > $limite_colonne) {
            echo '</tr>';
            $i = 1;
        }
        //Personalisation Mediawiki en fonction du portail de l'utilisateur
        $portail_wiki_salaries = Lib::isDefined('portail_wiki_salaries');
        if ($portail_wiki_salaries and $nom_intranet_modules == 'mediawiki') {
            $additional_ref = '/index.php/' . $portail_wiki_salaries;
        } else {
            $additional_ref = '';
        }
        echo '<td align=center>';
        echo '<a href='
        . $globalConfig->getConf()->getUrlFullRoot()
        . '/'
        . $nom_intranet_modules
        . '' . $additional_ref . ' target=_top>';
        echo '<img src='
        . $globalConfig->getConf()->getUrlFullRoot()
        . '/'
        . $nom_intranet_modules
        . '/images/bouton_module.png width=34 height=34 border=0 alt=' . $nom_usuel_intranet_modules . '>';
        echo '</a>';
        echo '</td>';
        $i = $i + 1;
    }
}

echo '</tr>';
echo '</table>';
echo '</td>';
echo '</tr>';
echo '</table>';

//****** Rubrique de Debuggage
//echo $delay.' secondes<br>';
//echo $_SESSION['id_user'];
//*******/
?>
