<?php
//Inclusions
include ("../lib/session.php");
include ("../lib/functions.php");

//Variables à recevoir
//$module='fiches_mp_achats';   //Nom du module
//$menu='menu_table_annexe.inc';
$nom_table;                    //Nom de la table
$consultation;                 //Si =1 la table ne sera qu'en mode consultation.
//global $application_courante;
//echo $GLOBALS['application_courante'];
$mysql_user;      //voir session.php
$bdpass;          //Mot de passe NIV I - voir session.php
$mysql_database;  //voir session.php

//Paramétrage de la page
$lang='fr';
$serverName=1;
$db=$_SESSION["globalConfig"]->mysql_database_name;
//$goto='tbl_properties.php';
$goto='sql.php';
$sql_query="SELECT * FROM $nom_table";
$pos=0;

//Test si la table est vide, message d'erreur
$result1=DatabaseOperation::query($sql_query);
$nb1=mysql_num_rows($result1);
if ($nb1)
{
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
}
else
{
    //Informer l'utiliasteur
    $titre="Aucune données dans la table $nom_table";
    $message="
              Intervention du service informatique requise.<br>
              Enregistrez au moins une donnée dans la table $nom_table de la base données MySQL $mysql_database<br>
              <br>
              Une copie de ce message à été envoyé
              ";
    afficher_message($titre, $message, $redirection);

    //Informer la maintenance
    $sujetmail="Intranet - $module";
    $text="Intervention du service informatique requise.\nEnregistrer au moins une donnée dans la table '$nom_table' de la base données MySQL $mysql_database.";
    $destinataire="postmaster@agis-sa.fr";
    $expediteur="knoppix@avi1203.agis.fr";
    envoismail($sujetmail,$text,$destinataire,$expediteur);
}

include ("../lib/fin_page.inc");
?>

