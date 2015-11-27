<?php

//Redirection vers la page par défaut du module
//header ("Location: indexft.php");

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */

//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);

/*
  Si la page peut être appelée depuis n'importe quel module,
  décommentez la ligne suivante
 */

//   $module='fta';

/* * *******
  Inclusions
 * ******* */
//include ("../lib/session.php");         //Récupération des variables de sessions
//include ("../lib/debut_page.php");      //Affichage des éléments commun à l'Intranet
//$html_image_modif = "&nbsp;<img src=../lib/images/exclamation.png alt=\"\" title=\"Information mise à jour\" width=\"20\" height=\"18\" border=\"0\" />";
//$html_color_modif = "bgcolor=#B0FFFE";
$version_modif = 1;                        //Activer la visualisation des modifications effectuées depuis la version précédente
$show_help = 1;                              //Activer l'aide en ligne Pop-up
$bloc = "";
$fieldProprietaire = "";
$fieldMarque = "";
$fieldActivite = "";
$fieldRayon = "";
$fieldReseau = "";
$fieldEnvironnement = "";
$fieldSaisonalite = "";
$fieldExport = "";
//require_once '../inc/main.php';
$nameOfBDDTarget = "intranet_v3_0_cod";
$nameOfBDDOrigin = "intranet_v2_0_prod_cod";
$nameOfBDDStructure = "intranet_v3_0_model";
require_once '../fta/extraction_classification.php';
//Barre de Navigation d'une Fiche Technique Article
//include ("./menu_navigation.inc");
//echo $synthese_action;
/* $comeback;
  echo $comeback=($_SERVER["QUERY_STRING"]);
  echo "<br>";
  echo htmlspecialchars($comeback);
 */

//$hostname_connect2 = "admin.agis.fr"; //nom du serveur MySQL de connection � la base de donn�e
//$database_connect2 = "agis"; //nom de la base de donn�e sur votre serveur MySQL
//$username_connect2 = "root"; //login de la base MySQL
//$tablename_connect2 = "salaries"; //table login de la base MySQL
//$password_connect2 = "8ale!ne"; //mot de passe de la base MySQL
//$donnee2 = mysql_pconnect($hostname_connect2, $username_connect2, $password_connect2) or die("connexion impossible");


UpgradeClassificationV2ToV3($nameOfBDDTarget, $nameOfBDDOrigin, $nameOfBDDStructure);

/**
 * Rendu HTML
 */
//$recordSetFta = new FtaModel($id_fta);
//$test = $recordSetFta->getFieldNomDemandeur();
//
//echo "<pre>";
//print_r ($_SESSION);
////print_r($recordSetFta);
//echo "</pre>";

/* * **********
  Fin Code HTML
 * ********** */

/* * *********************
  Inclusion de fin de page
 * ********************* */

