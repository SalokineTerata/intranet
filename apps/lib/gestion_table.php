<?php

//Inclusions
//Sélection du mode de visualisation de la page
switch ($output) {

    case 'visualiser':
        //Inclusions
        include ("../lib/session.php");         //Récupération des variables de sessions
        include ("../lib/functions.php");       //On inclus seulement les fonctions sans construire de page
        include ("functions.php");              //Fonctions du module
        echo "
            <link rel=stylesheet type=text/css href=../lib/css/intra01.css />
            <link rel=stylesheet type=text/css href=visualiser.css />
       ";

    //break;
    case 'pdf':
        break;

    default:
        //Inclusions
//        include ("../lib/session.php");         //Récupération des variables de sessions
//        include ("../lib/debut_page.php");      //Construction d'une nouvelle
//        if (isset($menu))                       //Si existant, utilisation du menu demandé
//        {                                       //en variable
//           include ("./$menu");
//        }
//        else
//        {
//           include ("./menu_principal.inc");    //Sinon, menu par défaut
//        }
        require_once '../inc/main.php';

        print_page_begin($disable_full_page, $menu_file);
}//Fin de la sélection du mode d'affichage de la page
$nom_table = Lib::getParameterFromRequest('nom_table');                    //Nom de la table
$menu = Lib::getParameterFromRequest('menu');                    //Nom de la table
$module = Lib::getParameterFromRequest('module');
//Variables à recevoir
//$module='fiches_mp_achats';   //Nom du module
//$menu='menu_table_annexe.inc';
//Nom de la table
$consultation;                 //Si =1 la table ne sera qu'en mode consultation.
//global $application_courante;
//echo $GLOBALS['application_courante'];
$mysql_user;      //voir session.php
$bdpass;          //Mot de passe NIV I - voir session.php
$mysql_database;  //voir session.php
//Paramétrage de la page
$lang = 'fr';
$serverName = 1;
$db = $_SESSION["globalConfig"]->mysql_database_name;
//$goto='tbl_properties.php';
$goto = 'sql.php';
$sql_query = "SELECT * FROM $nom_table";
$pos = 0;

//Test si la table est vide, message d'erreur
$result1 = DatabaseOperation::query($sql_query);
$nb1 = mysql_num_rows($result1);
if ($nb1) {
    //Création de la page
    echo
    "
    <frameset cols=166,* rows=* frameborder=no>
         <frame src='../lib/frame_gauche.php?module=$module&menu=$menu' noresize />
         <frame src='../phpMyAdmin/sql.php"
    . "?lang=$lang"
    . "&server=$serverName"
    . "&db=$db"
    . "&goto=$goto"
    . "&sql_query=$sql_query"
    . "&pos=$pos"
    . "&application_courante=$application_courante"
    . "&consultation=$consultation"
    . "&mysql_user=$mysql_user"
    . "&bdpass=$bdpass"
    . "&mysql_database=$mysql_database"
    . "' />

         <noframes>
               <body bgcolor=#FFFFFF>
               <p>L'utilisation de phpMyAdmin est plus aisée avec un navigateur <b>supportant les frames</b>.</p>
               </body>
         </noframes>
    </frameset>
   ";
} else {
    //Informer l'utiliasteur
    $titre = "Aucune données dans la table $nom_table";
    $message = "
              Intervention du service informatique requise.<br>
              Enregistrez au moins une donnée dans la table $nom_table de la base données MySQL $mysql_database<br>
              <br>
              Une copie de ce message à été envoyé
              ";
    afficher_message($titre, $message, $redirection);

    //Informer la maintenance
    $sujetmail = "Intranet - $module";
    $text = "Intervention du service informatique requise.\nEnregistrer au moins une donnée dans la table '$nom_table' de la base données MySQL $mysql_database.";
    $destinataire = "postmaster@agis-sa.fr";
    $expediteur = "knoppix@avi1203.agis.fr";
    envoismail($sujetmail, $text, $destinataire, $expediteur);
}

include ("../lib/fin_page.inc");
?>

