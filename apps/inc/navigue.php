<?php

// INCLUDE permettant de naviguer au sein des modules
//***************************************************
$id_user = Lib::isDefined("id_user");
$nom_intranet_modules = Lib::isDefined("nom_intranet_modules");
$intranet_module_public = Lib::isDefined("intranet_module_public");
$globalConfig = new GlobalConfig();


echo "
<table width=\"150\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >
    <tr>
        <td><img src=\"../lib/images/bandeau_vague.png\" width=\"150\"></td>
    </tr>
    <tr>
        <td>
            <table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"0\" bgcolor=\"#FFE5B2\">
                <tr>
                    <td>
                    </td>
                    <td>
</td>
</tr>
";

/* * ****************************************************************
  Création des boutons permettant d'accéder aux modules de l'intranet
 * **************************************************************** */

//Variables spécifiques:
$limite_colonne = 3; //Nombre de bouton maximum par ligne
$i = 1;              //Compteur du positionnement du bouton



/* Modules Public
 * ************* */

$result1 = DatabaseOperation::convertSqlResultWithoutKeyToArray($intranet_module_public);
echo "<tr>";

//Création des boutons
foreach ($result1 as $rows1) {
    $nom_intranet_modules = $rows1["nom_intranet_modules"];
    $nom_usuel_intranet_modules = $rows1["nom_usuel_intranet_modules"];
    if ($i > $limite_colonne) {
        echo "</tr>";
        $i = 1;
    }
    echo "<td align=center>";
    echo "<a href=" . $globalConfig->getConf()->getUrlFullRoot() . "/$nom_intranet_modules target=_top>";
    echo "<img src=" . $globalConfig->getConf()->getUrlFullRoot() . "/$nom_intranet_modules/images/bouton_module.png width=34 height=34 border=0 alt=`$nom_usuel_intranet_modules`>";
    echo "</a>";
    echo "</td>";
    $i = $i + 1;
}

/* Modules sous droits d'accès utilisateur
 * ************************************** */
if ($id_user) {//Si l'utilisateur est connecté
    //Requête selectionnant les modules de l'intranet visible par l'utilisateur pouvant consulter le droit d'accès:
    $req1 = "SELECT * FROM intranet_modules, intranet_droits_acces "
            . "WHERE (intranet_modules.id_intranet_modules=intranet_droits_acces.id_intranet_modules "
            . "AND visible_intranet_modules='1' "
            . "AND id_intranet_actions='1' "
            . "AND intranet_droits_acces.id_user=" . $id_user . " "
            . "AND intranet_droits_acces.niveau_intranet_droits_acces='1') "
            . "ORDER BY classement_intranet_modules DESC"
    ;
    $result1 = DatabaseOperation::query($req1);

    while ($rows1 = mysql_fetch_array($result1)) {
        $nom_intranet_modules = $rows1["nom_intranet_modules"];
        $nom_usuel_intranet_modules = $rows1["nom_usuel_intranet_modules"];
        if ($i > $limite_colonne) {
            echo "</tr>";
            $i = 1;
        }
        //Personalisation Mediawiki en fonction du portail de l'utilisateur
        $portail_wiki_salaries = Lib::isDefined("portail_wiki_salaries");
        if ($portail_wiki_salaries and $nom_intranet_modules == "mediawiki") {
            $additional_ref = "/index.php/" . $portail_wiki_salaries;
        } else {
            $additional_ref = "";
        }
        echo "<td align=center>";
        echo "<a href="
        . $globalConfig->getConf()->getUrlFullRoot()
        . "/"
        . $nom_intranet_modules
        . "$additional_ref target=_top>";
        echo "<img src="
        . $globalConfig->getConf()->getUrlFullRoot()
        . "/"
        . $nom_intranet_modules
        . "/images/bouton_module.png width=34 height=34 border=0 alt=`$nom_usuel_intranet_modules`>";
        echo "</a>";
        echo "</td>";
        $i = $i + 1;
    }
}

echo "</tr>";
echo "</table>";
echo "</td>";
echo "</tr>";
echo "</table>";

//****** Rubrique de Debuggage
//echo $delay." secondes<br>";
//echo $_SESSION["id_user"];
//*******/
?>