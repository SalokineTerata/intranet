<?php
/* * *******
  Inclusions
 * ******* */

/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
*/
 $nameOfBDDTarget = $argv[1];
 $nameOfBDDOrigin = $argv[2];
 $nameOfBDDStructure = $argv[3];

//$hostname_connect = "dev-intranet.agis.fr"; //nom du serveur MySQL de connection � la base de donn�e
$hostname_connect = $argv[4]; //nom du serveur MySQL de connection � la base de donn�e
$database_connect = $nameOfBDDTarget; //nom de la base de donn�e sur votre serveur MySQL
//$username_connect = "root"; //login de la base MySQL
$username_connect = $argv[5]; //login de la base MySQL
//$password_connect = "8ale!ne"; //mot de passe de la base MySQL
$password_connect = $argv[6];; //mot de passe de la base MySQL

$donnee = mysql_pconnect($hostname_connect, $username_connect, $password_connect);
mysql_select_db($database_connect);
mysql_query('SET NAMES utf8');


/**
 * Création de la base de données
 */
echo "*** Requêtes SQL Part 1:\n";


//ini_set('memory_limit', '-1'); 
//{
//    DatabaseOperation::execute(
//            "DROP DATABASE ".$nameOfBDDTarget.";"
//    );
//
//    DatabaseOperation::execute(
//            "CREATE DATABASE ".$nameOfBDDTarget." CHARACTER SET utf8 COLLATE utf8_general_ci;"
//    );
//}
//
///* * *
// * Recuperations des données de la V2 avec la structure de la V3
// */ {
//
$debut = date("H:i:s");
echo  date("H:i:s")."\n";
//SELECT * 
//FROM  `TABLE_CONSTRAINTS` 
//WHERE  `CONSTRAINT_SCHEMA` LIKE  'intranet_v3_0_cod'
//AND CONSTRAINT_NAME <>  "PRIMARY"
//AND CONSTRAINT_TYPE =  "FOREIGN KEY"
  echo "DROP DATABASE ".$nameOfBDDTarget." ...";
  $sql = "DROP DATABASE ".$nameOfBDDTarget;
  
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  echo "CREATE DATABASE ".$nameOfBDDTarget." ...";
  $sql = "CREATE DATABASE ".$nameOfBDDTarget;
  
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
   
/**
Tables basiques
**/
if(TRUE){
echo "DROP ".$nameOfBDDTarget.".classification_arborescence_article ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".classification_arborescence_article";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".classification_arborescence_article ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".classification_arborescence_article LIKE ".$nameOfBDDStructure.".classification_arborescence_article";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".classification_arborescence_article ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".classification_arborescence_article SELECT * FROM ".$nameOfBDDOrigin.".classification_arborescence_article";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".classification_arborescence_article_categorie ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".classification_arborescence_article_categorie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".classification_arborescence_article_categorie ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".classification_arborescence_article_categorie LIKE ".$nameOfBDDStructure.".classification_arborescence_article_categorie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".classification_arborescence_article ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".classification_arborescence_article_categorie SELECT * FROM ".$nameOfBDDOrigin.".classification_arborescence_article_categorie";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".classification_arborescence_article_categorie_contenu ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".classification_arborescence_article_categorie_contenu";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".classification_arborescence_article_categorie_contenu ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".classification_arborescence_article_categorie_contenu LIKE ".$nameOfBDDStructure.".classification_arborescence_article_categorie_contenu";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".classification_arborescence_article ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".classification_arborescence_article_categorie_contenu SELECT * FROM ".$nameOfBDDOrigin.".classification_arborescence_article_categorie_contenu";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fte_fournisseur ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fte_fournisseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fte_fournisseur ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fte_fournisseur LIKE ".$nameOfBDDStructure.".fte_fournisseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fte_fournisseur ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fte_fournisseur SELECT * FROM ".$nameOfBDDOrigin.".fte_fournisseur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".salaries Utilisateur supprimé ...";
$sql = "INSERT INTO `".$nameOfBDDTarget."`.`fte_fournisseur` "
        . "(`id_fte_fournisseur`, `nom_fte_fournisseur`) "
        . "VALUES ('-1', 'Fte supprimé'); ";       
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".geo ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".geo";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".geo ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".geo LIKE ".$nameOfBDDStructure.".geo";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".geo ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".geo SELECT * FROM ".$nameOfBDDOrigin.".geo";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".geo_codesoft ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".geo_codesoft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".geo_codesoft ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".geo_codesoft LIKE ".$nameOfBDDStructure.".geo_codesoft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".geo_codesoft ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".geo_codesoft SELECT * FROM ".$nameOfBDDOrigin.".geo_codesoft";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".groupes ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".groupes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".groupes ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".groupes LIKE ".$nameOfBDDStructure.".groupes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".groupes ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".groupes SELECT * FROM ".$nameOfBDDOrigin.".groupes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".planning_presence_semaine_visible ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".planning_presence_semaine_visible";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".planning_presence_semaine_visible ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".planning_presence_semaine_visible LIKE ".$nameOfBDDStructure.".planning_presence_semaine_visible";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".planning_presence_semaine_visible ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".planning_presence_semaine_visible SELECT * FROM ".$nameOfBDDOrigin.".planning_presence_semaine_visible";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".annexe_agrologic_article_codification ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_agrologic_article_codification";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_agrologic_article_codification ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_agrologic_article_codification LIKE ".$nameOfBDDStructure.".annexe_agrologic_article_codification";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_agrologic_article_codification ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_agrologic_article_codification SELECT * FROM ".$nameOfBDDOrigin.".annexe_agrologic_article_codification";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".annexe_jours_semaine ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_jours_semaine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_jours_semaine ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_jours_semaine LIKE ".$nameOfBDDStructure.".annexe_jours_semaine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_jours_semaine ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_jours_semaine SELECT * FROM ".$nameOfBDDOrigin.".annexe_jours_semaine";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".annexe_allergene ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_allergene";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_allergene ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_allergene LIKE ".$nameOfBDDStructure.".annexe_allergene";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_allergene ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_allergene SELECT * FROM ".$nameOfBDDOrigin.".annexe_allergene";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".annexe_additif ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_additif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_additif ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_additif LIKE ".$nameOfBDDStructure.".annexe_additif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_additif ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_additif SELECT * FROM ".$nameOfBDDOrigin.".annexe_additif";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_service ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_service";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_service ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_service LIKE ".$nameOfBDDStructure.".access_materiel_service";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_service ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_service SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_service";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".annexe_additif_groupe ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_additif_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_additif_groupe ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_additif_groupe LIKE ".$nameOfBDDStructure.".annexe_additif_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_service ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_additif_groupe SELECT * FROM ".$nameOfBDDOrigin.".annexe_additif_groupe";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".annexe_allergene_famille ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_allergene_famille";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_allergene_famille ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_allergene_famille LIKE ".$nameOfBDDStructure.".annexe_allergene_famille";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_allergene_famille ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_allergene_famille SELECT * FROM ".$nameOfBDDOrigin.".annexe_allergene_famille";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".annexe_allergene_origine ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_allergene_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_allergene_origine ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_allergene_origine LIKE ".$nameOfBDDStructure.".annexe_allergene_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_allergene_origine ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_allergene_origine SELECT * FROM ".$nameOfBDDOrigin.".annexe_allergene_origine";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".annexe_arome_categorie ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_arome_categorie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_arome_categorie ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_arome_categorie LIKE ".$nameOfBDDStructure.".annexe_arome_categorie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_arome_categorie ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_arome_categorie SELECT * FROM ".$nameOfBDDOrigin.".annexe_arome_categorie";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".annexe_caracteristique_scientifique ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_caracteristique_scientifique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_caracteristique_scientifique ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_caracteristique_scientifique LIKE ".$nameOfBDDStructure.".annexe_caracteristique_scientifique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_caracteristique_scientifique ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_caracteristique_scientifique SELECT * FROM ".$nameOfBDDOrigin.".annexe_caracteristique_scientifique";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".annexe_caracteristique_scientifique_groupe ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_caracteristique_scientifique_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_caracteristique_scientifique_groupe ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_caracteristique_scientifique_groupe LIKE ".$nameOfBDDStructure.".annexe_caracteristique_scientifique_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_caracteristique_scientifique_groupe ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_caracteristique_scientifique_groupe SELECT * FROM ".$nameOfBDDOrigin.".annexe_caracteristique_scientifique_groupe";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".annexe_environnement_conservation ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_environnement_conservation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_environnement_conservation ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_environnement_conservation LIKE ".$nameOfBDDStructure.".annexe_environnement_conservation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_environnement_conservation ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_environnement_conservation SELECT * FROM ".$nameOfBDDOrigin.".annexe_environnement_conservation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".annexe_environnement_conservation_groupe ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_environnement_conservation_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_environnement_conservation_groupe ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_environnement_conservation_groupe LIKE ".$nameOfBDDStructure.".annexe_environnement_conservation_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_environnement_conservation_groupe ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_environnement_conservation_groupe SELECT * FROM ".$nameOfBDDOrigin.".annexe_environnement_conservation_groupe";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".annexe_pays ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_pays";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_pays ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_pays LIKE ".$nameOfBDDStructure.".annexe_pays";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_pays ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_pays SELECT * FROM ".$nameOfBDDOrigin.".annexe_pays";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".annexe_unite ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_unite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_unite ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_unite LIKE ".$nameOfBDDStructure.".annexe_unite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_unite ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_unite SELECT * FROM ".$nameOfBDDOrigin.".annexe_unite";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".archcomment ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".archcomment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".archcomment ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".archcomment LIKE ".$nameOfBDDStructure.".archcomment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".archcomment ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".archcomment SELECT * FROM ".$nameOfBDDOrigin.".archcomment";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".archlu ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".archlu";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".archlu ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".archlu LIKE ".$nameOfBDDStructure.".archlu";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".archlu ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".archlu SELECT * FROM ".$nameOfBDDOrigin.".archlu";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".articlece ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".articlece";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".articlece ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".articlece LIKE ".$nameOfBDDStructure.".articlece";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".articlece ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".articlece SELECT * FROM ".$nameOfBDDOrigin.".articlece";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".articles ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".articles";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".articles ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".articles LIKE ".$nameOfBDDStructure.".articles";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".articles ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".articles SELECT * FROM ".$nameOfBDDOrigin.".articles";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".artstat ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".artstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".artstat ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".artstat LIKE ".$nameOfBDDStructure.".artstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".artstat ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".artstat SELECT * FROM ".$nameOfBDDOrigin.".artstat";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".catsopro ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".catsopro";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".catsopro ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".catsopro LIKE ".$nameOfBDDStructure.".catsopro";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".catsopro ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".catsopro SELECT * FROM ".$nameOfBDDOrigin.".catsopro";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".classification_arborescence_client ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".classification_arborescence_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".classification_arborescence_client ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".classification_arborescence_client LIKE ".$nameOfBDDStructure.".classification_arborescence_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".classification_arborescence_client ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".classification_arborescence_client SELECT * FROM ".$nameOfBDDOrigin.".classification_arborescence_client";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".classification_arborescence_client_groupe ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".classification_arborescence_client_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".classification_arborescence_client_groupe ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".classification_arborescence_client_groupe LIKE ".$nameOfBDDStructure.".classification_arborescence_client_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".classification_arborescence_client_groupe ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".classification_arborescence_client_groupe SELECT * FROM ".$nameOfBDDOrigin.".classification_arborescence_client_groupe";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".classification_article ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".classification_article";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".classification_article ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".classification_article LIKE ".$nameOfBDDStructure.".classification_article";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".classification_article ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".classification_article SELECT * FROM ".$nameOfBDDOrigin.".classification_article";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".classification_article_rayon ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".classification_article_rayon";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".classification_article_rayon ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".classification_article_rayon LIKE ".$nameOfBDDStructure.".classification_article_rayon";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".classification_article_rayon ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".classification_article_rayon SELECT * FROM ".$nameOfBDDOrigin.".classification_article_rayon";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".codesoft_etiquettes ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".codesoft_etiquettes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".codesoft_etiquettes ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".codesoft_etiquettes LIKE ".$nameOfBDDOrigin.".codesoft_etiquettes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".codesoft_etiquettes ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".codesoft_etiquettes SELECT * FROM ".$nameOfBDDOrigin.".codesoft_etiquettes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "ALTER TABLE  ".$nameOfBDDTarget.".codesoft_etiquettes ...";
$sql = "ALTER TABLE  ".$nameOfBDDTarget.".codesoft_etiquettes ENGINE = INNODB";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

$arrayCodesoftEtiquette = mysql_query(
                "SELECT DISTINCT k_etiquette, k_site
FROM ".$nameOfBDDTarget.".codesoft_etiquettes
"
);
if ($arrayCodesoftEtiquette) {
    while ($rowsCodesoftEtiquette = mysql_fetch_array($arrayCodesoftEtiquette)) {
        $Ketiquette = $rowsCodesoftEtiquette['k_etiquette'];
        $Site_de_productionTMP = $rowsCodesoftEtiquette["k_site"];
    switch ($Site_de_productionTMP){
        case "4":
            $Site_de_production = "6";
        break;
        case "10":
            $Site_de_production = "11";
        break;
    
        default:            
            $Site_de_production =$Site_de_productionTMP;
        break;
    }
        $sql_inter = "UPDATE ".$nameOfBDDTarget."." . 'codesoft_etiquettes'
                . " SET " . 'k_site' . "=". $Site_de_production
                . " WHERE " . 'k_etiquette' . "=" . $Ketiquette;
        echo "UPDATE ".$nameOfBDDTarget."." . "codesoft_etiquettes." . "k_site k_etiquette" . "=" . $Ketiquette." ...";
        if(mysql_query($sql_inter)) {	echo "[OK]\n";}else{echo "[FAILED] $Ketiquette \n";}
    }
}

echo "DROP ".$nameOfBDDTarget.".codesoft_etiquettes_logo ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".codesoft_etiquettes_logo";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".codesoft_etiquettes_logo ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".codesoft_etiquettes_logo LIKE ".$nameOfBDDStructure.".codesoft_etiquettes_logo";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".codesoft_etiquettes_logo ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".codesoft_etiquettes_logo SELECT * FROM ".$nameOfBDDOrigin.".codesoft_etiquettes_logo";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".codesoft_historique_satel ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".codesoft_historique_satel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".codesoft_historique_satel ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".codesoft_historique_satel LIKE ".$nameOfBDDStructure.".codesoft_historique_satel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".codesoft_historique_satel ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".codesoft_historique_satel SELECT * FROM ".$nameOfBDDOrigin.".codesoft_historique_satel";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".codesoft_imprimante ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".codesoft_imprimante";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".codesoft_imprimante ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".codesoft_imprimante LIKE ".$nameOfBDDStructure.".codesoft_imprimante";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".codesoft_imprimante ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".codesoft_imprimante SELECT * FROM ".$nameOfBDDOrigin.".codesoft_imprimante";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".codesoft_style_paragraphe ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".codesoft_style_paragraphe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".codesoft_style_paragraphe ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".codesoft_style_paragraphe LIKE ".$nameOfBDDStructure.".codesoft_style_paragraphe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".codesoft_style_paragraphe ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".codesoft_style_paragraphe SELECT * FROM ".$nameOfBDDOrigin.".codesoft_style_paragraphe";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".droitft ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".droitft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".droitft ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".droitft LIKE ".$nameOfBDDStructure.".droitft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".droitft ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".droitft SELECT * FROM ".$nameOfBDDOrigin.".droitft";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".erp_datasync ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".erp_datasync";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".erp_datasync ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".erp_datasync LIKE ".$nameOfBDDStructure.".erp_datasync";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".erp_datasync ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".erp_datasync SELECT * FROM ".$nameOfBDDOrigin.".erp_datasync";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fiches_mp_achats_moteur_de_recherche ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fiches_mp_achats_moteur_de_recherche";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fiches_mp_achats_moteur_de_recherche ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fiches_mp_achats_moteur_de_recherche LIKE ".$nameOfBDDStructure.".fiches_mp_achats_moteur_de_recherche";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fiches_mp_achats_moteur_de_recherche ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fiches_mp_achats_moteur_de_recherche SELECT * FROM ".$nameOfBDDOrigin.".fiches_mp_achats_moteur_de_recherche";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fta_derogation_duree_vie ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_derogation_duree_vie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_derogation_duree_vie ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_derogation_duree_vie LIKE ".$nameOfBDDStructure.".fta_derogation_duree_vie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_derogation_duree_vie ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_derogation_duree_vie SELECT * FROM ".$nameOfBDDOrigin.".fta_derogation_duree_vie";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fta_duree_vie ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_duree_vie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_duree_vie ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_duree_vie LIKE ".$nameOfBDDStructure.".fta_duree_vie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_duree_vie ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_duree_vie SELECT * FROM ".$nameOfBDDOrigin.".fta_duree_vie";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fta_migration_import_articles_actifs ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_migration_import_articles_actifs";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_migration_import_articles_actifs ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_migration_import_articles_actifs LIKE ".$nameOfBDDStructure.".fta_migration_import_articles_actifs";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_migration_import_articles_actifs ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_migration_import_articles_actifs SELECT * FROM ".$nameOfBDDOrigin.".fta_migration_import_articles_actifs";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fta_processus_delai ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_processus_delai";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_processus_delai ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_processus_delai LIKE ".$nameOfBDDStructure.".fta_processus_delai";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_processus_delai ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_processus_delai SELECT * FROM ".$nameOfBDDOrigin.".fta_processus_delai";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fta_processus_etat ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_processus_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_processus_etat ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_processus_etat LIKE ".$nameOfBDDStructure.".fta_processus_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_processus_etat ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_processus_etat SELECT * FROM ".$nameOfBDDOrigin.".fta_processus_etat";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fta_processus_multisite ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_processus_multisite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_processus_multisite ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_processus_multisite LIKE ".$nameOfBDDStructure.".fta_processus_multisite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_processus_multisite ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_processus_multisite SELECT * FROM ".$nameOfBDDOrigin.".fta_processus_multisite";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fta_tarif ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_tarif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_tarif ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_tarif LIKE ".$nameOfBDDStructure.".fta_tarif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_tarif ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_tarif SELECT * FROM ".$nameOfBDDOrigin.".fta_tarif";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}



/**
 * Création de tables de la V2 vers V3
 */ 

echo "DROP ".$nameOfBDDTarget.".access_base_degust_mois ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_base_degust_mois";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_base_degust_mois ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_base_degust_mois LIKE ".$nameOfBDDOrigin.".access_base_degust_mois";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_base_degust_mois ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_base_degust_mois SELECT * FROM ".$nameOfBDDOrigin.".access_base_degust_mois";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_base_degust_motifs ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_base_degust_motifs";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_base_degust_motifs ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_base_degust_motifs LIKE ".$nameOfBDDOrigin.".access_base_degust_motifs";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_base_degust_motifs ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_base_degust_motifs SELECT * FROM ".$nameOfBDDOrigin.".access_base_degust_motifs";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_base_degust_produits ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_base_degust_produits";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_base_degust_produits ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_base_degust_produits LIKE ".$nameOfBDDOrigin.".access_base_degust_produits";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_base_degust_produits ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_base_degust_produits SELECT * FROM ".$nameOfBDDOrigin.".access_base_degust_produits";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}


echo "DROP ".$nameOfBDDTarget.".access_base_degust_resultat ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_base_degust_resultat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_base_degust_resultat ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_base_degust_resultat LIKE ".$nameOfBDDOrigin.".access_base_degust_resultat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_base_degust_resultat ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_base_degust_resultat SELECT * FROM ".$nameOfBDDOrigin.".access_base_degust_resultat";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_accomptes ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_accomptes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_accomptes ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_accomptes LIKE ".$nameOfBDDOrigin.".access_budget_marketing_accomptes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_accomptes ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_accomptes SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_accomptes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_budget ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_budget";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_budget ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_budget LIKE ".$nameOfBDDOrigin.".access_budget_marketing_budget";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_budget ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_budget SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_budget";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_facturation ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_facturation ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_facturation LIKE ".$nameOfBDDOrigin.".access_budget_marketing_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_facturation ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_facturation SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_facturation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_fournisseur ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_fournisseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_fournisseur ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_fournisseur LIKE ".$nameOfBDDOrigin.".access_budget_marketing_fournisseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_fournisseur ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_fournisseur SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_fournisseur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_datasharing_data_sharing ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_datasharing_data_sharing";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_datasharing_data_sharing ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_datasharing_data_sharing LIKE ".$nameOfBDDOrigin.".access_datasharing_data_sharing";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_datasharing_data_sharing ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_datasharing_data_sharing SELECT * FROM ".$nameOfBDDOrigin.".access_datasharing_data_sharing";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_mdd_accomptes ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_accomptes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_accomptes ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_accomptes LIKE ".$nameOfBDDOrigin.".access_budget_marketing_mdd_accomptes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_accomptes ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_accomptes SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_mdd_accomptes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_mdd_budget ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_budget";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_budget ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_budget LIKE ".$nameOfBDDOrigin.".access_budget_marketing_mdd_budget";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_budget ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_budget SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_mdd_budget";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_mdd_facturation ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_facturation ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_facturation LIKE ".$nameOfBDDOrigin.".access_budget_marketing_mdd_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_facturation ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_facturation SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_mdd_facturation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_mdd_fournisseur ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_fournisseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_fournisseur ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_fournisseur LIKE ".$nameOfBDDOrigin.".access_budget_marketing_mdd_fournisseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_fournisseur ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_fournisseur SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_mdd_fournisseur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_mdd_hierarchie_compta_analytique ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_hierarchie_compta_analytique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_hierarchie_compta_analytique ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_hierarchie_compta_analytique LIKE ".$nameOfBDDOrigin.".access_budget_marketing_mdd_hierarchie_compta_analytique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_hierarchie_compta_analytique ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_hierarchie_compta_analytique SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_mdd_hierarchie_compta_analytique";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_mdd_intitule_base ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_intitule_base";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_intitule_base ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_intitule_base LIKE ".$nameOfBDDOrigin.".access_budget_marketing_mdd_intitule_base";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_intitule_base ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_intitule_base SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_mdd_intitule_base";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_hierarchie_compta_analytique ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_hierarchie_compta_analytique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_hierarchie_compta_analytique ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_hierarchie_compta_analytique LIKE ".$nameOfBDDOrigin.".access_budget_marketing_hierarchie_compta_analytique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_hierarchie_compta_analytique ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_hierarchie_compta_analytique SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_hierarchie_compta_analytique";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_intitule_base ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_intitule_base";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_intitule_base ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_intitule_base LIKE ".$nameOfBDDOrigin.".access_budget_marketing_intitule_base";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_intitule_base ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_intitule_base SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_intitule_base";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_mdd_prestation ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_prestation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_prestation ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_prestation LIKE ".$nameOfBDDOrigin.".access_budget_marketing_mdd_prestation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_prestation ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_prestation SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_mdd_prestation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_mdd_provisions ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_provisions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_provisions ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_provisions LIKE ".$nameOfBDDOrigin.".access_budget_marketing_mdd_provisions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_provisions ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_provisions SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_mdd_provisions";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_mdd_reglement ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_reglement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_reglement ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_reglement LIKE ".$nameOfBDDOrigin.".access_budget_marketing_mdd_reglement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_reglement ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_reglement SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_mdd_reglement";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_mdd_rubrique_facturation ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_rubrique_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_rubrique_facturation ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_rubrique_facturation LIKE ".$nameOfBDDOrigin.".access_budget_marketing_mdd_rubrique_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_rubrique_facturation ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_rubrique_facturation SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_mdd_rubrique_facturation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_mdd_section ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_section";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_section ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_section LIKE ".$nameOfBDDOrigin.".access_budget_marketing_mdd_section";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_section ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_section SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_mdd_section";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".intranet_moteur_de_recherche_association_type_operateur ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".intranet_moteur_de_recherche_association_type_operateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".intranet_moteur_de_recherche_association_type_operateur ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".intranet_moteur_de_recherche_association_type_operateur LIKE ".$nameOfBDDOrigin.".intranet_moteur_de_recherche_association_type_operateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".intranet_moteur_de_recherche_association_type_operateur ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".intranet_moteur_de_recherche_association_type_operateur SELECT * FROM ".$nameOfBDDOrigin.".intranet_moteur_de_recherche_association_type_operateur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".intranet_moteur_de_recherche_operateur_sur_champ ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".intranet_moteur_de_recherche_operateur_sur_champ";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".intranet_moteur_de_recherche_operateur_sur_champ ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".intranet_moteur_de_recherche_operateur_sur_champ LIKE ".$nameOfBDDOrigin.".intranet_moteur_de_recherche_operateur_sur_champ";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".intranet_moteur_de_recherche_operateur_sur_champ ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".intranet_moteur_de_recherche_operateur_sur_champ SELECT * FROM ".$nameOfBDDOrigin.".intranet_moteur_de_recherche_operateur_sur_champ";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_mdd_sous_facturation ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_sous_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_sous_facturation ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_sous_facturation LIKE ".$nameOfBDDOrigin.".access_budget_marketing_mdd_sous_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_sous_facturation ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_sous_facturation SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_mdd_sous_facturation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_mdd_sous_section ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_sous_section";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_sous_section ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_sous_section LIKE ".$nameOfBDDOrigin.".access_budget_marketing_mdd_sous_section";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_sous_section ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_sous_section SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_mdd_sous_section";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_mdd_temp_facture_provionnee ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_temp_facture_provionnee";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_temp_facture_provionnee ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_mdd_temp_facture_provionnee LIKE ".$nameOfBDDOrigin.".access_budget_marketing_mdd_temp_facture_provionnee";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_temp_facture_provionnee ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_mdd_temp_facture_provionnee SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_mdd_temp_facture_provionnee";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_prestation ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_prestation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_prestation ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_prestation LIKE ".$nameOfBDDOrigin.".access_budget_marketing_prestation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_prestation ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_prestation SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_prestation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_provisions ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_provisions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_provisions ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_provisions LIKE ".$nameOfBDDOrigin.".access_budget_marketing_provisions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_provisions ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_provisions SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_provisions";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_reglement ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_reglement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_reglement ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_reglement LIKE ".$nameOfBDDOrigin.".access_budget_marketing_reglement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_reglement ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_reglement SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_reglement";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_rubrique_facturation ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_rubrique_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_rubrique_facturation ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_rubrique_facturation LIKE ".$nameOfBDDOrigin.".access_budget_marketing_rubrique_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_rubrique_facturation ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_rubrique_facturation SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_rubrique_facturation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_section ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_section";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_section ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_section LIKE ".$nameOfBDDOrigin.".access_budget_marketing_section";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_section ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_section SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_section";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_sous_facturation ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_sous_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_sous_facturation ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_sous_facturation LIKE ".$nameOfBDDOrigin.".access_budget_marketing_sous_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_sous_facturation ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_sous_facturation SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_sous_facturation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_sous_section ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_sous_section";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_sous_section ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_sous_section LIKE ".$nameOfBDDOrigin.".access_budget_marketing_sous_section";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_sous_section ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_sous_section SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_sous_section";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_marketing_temp_facture_provionnee ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_marketing_temp_facture_provionnee";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_temp_facture_provionnee ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_marketing_temp_facture_provionnee LIKE ".$nameOfBDDOrigin.".access_budget_marketing_temp_facture_provionnee";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_temp_facture_provionnee ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_marketing_temp_facture_provionnee SELECT * FROM ".$nameOfBDDOrigin.".access_budget_marketing_temp_facture_provionnee";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_ventes_14mois_Importation_Real_N_1 ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_ventes_14mois_Importation_Real_N_1";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_ventes_14mois_Importation_Real_N_1 ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_ventes_14mois_Importation_Real_N_1 LIKE ".$nameOfBDDOrigin.".access_budget_ventes_14mois_Importation_Real_N_1";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_ventes_14mois_Importation_Real_N_1 ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_ventes_14mois_Importation_Real_N_1 SELECT * FROM ".$nameOfBDDOrigin.".access_budget_ventes_14mois_Importation_Real_N_1";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_ventes_14mois_Importation_des_Realisations_N_1 ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_ventes_14mois_Importation_des_Realisations_N_1";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_ventes_14mois_Importation_des_Realisations_N_1 ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_ventes_14mois_Importation_des_Realisations_N_1 LIKE ".$nameOfBDDOrigin.".access_budget_ventes_14mois_Importation_des_Realisations_N_1";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_ventes_14mois_Importation_des_Realisations_N_1 ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_ventes_14mois_Importation_des_Realisations_N_1 SELECT * FROM ".$nameOfBDDOrigin.".access_budget_ventes_14mois_Importation_des_Realisations_N_1";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_ventes_Importation_des_Realisations_N_1 ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_ventes_Importation_des_Realisations_N_1";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_ventes_Importation_des_Realisations_N_1 ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_ventes_Importation_des_Realisations_N_1 LIKE ".$nameOfBDDOrigin.".access_budget_ventes_Importation_des_Realisations_N_1";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_ventes_Importation_des_Realisations_N_1 ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_ventes_Importation_des_Realisations_N_1 SELECT * FROM ".$nameOfBDDOrigin.".access_budget_ventes_Importation_des_Realisations_N_1";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_ventes_arti2_dev ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_ventes_arti2_dev";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_ventes_arti2_dev ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_ventes_arti2_dev LIKE ".$nameOfBDDOrigin.".access_budget_ventes_arti2_dev";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_ventes_arti2_dev ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_ventes_arti2_dev SELECT * FROM ".$nameOfBDDOrigin.".access_budget_ventes_arti2_dev";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_budget_ventes_reseau_commercial ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_budget_ventes_reseau_commercial";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_budget_ventes_reseau_commercial ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_budget_ventes_reseau_commercial LIKE ".$nameOfBDDOrigin.".access_budget_ventes_reseau_commercial";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_budget_ventes_reseau_commercial ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_budget_ventes_reseau_commercial SELECT * FROM ".$nameOfBDDOrigin.".access_budget_ventes_reseau_commercial";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_bugdet_ventes_14mois_table_animation ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_14mois_table_animation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_14mois_table_animation ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_14mois_table_animation LIKE ".$nameOfBDDOrigin.".access_bugdet_ventes_14mois_table_animation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_14mois_table_animation ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_14mois_table_animation SELECT * FROM ".$nameOfBDDOrigin.".access_bugdet_ventes_14mois_table_animation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_bugdet_ventes_14mois_table_budget ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_14mois_table_budget";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_14mois_table_budget ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_14mois_table_budget LIKE ".$nameOfBDDOrigin.".access_bugdet_ventes_14mois_table_budget";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_14mois_table_budget ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_14mois_table_budget SELECT * FROM ".$nameOfBDDOrigin.".access_bugdet_ventes_14mois_table_budget";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_bugdet_ventes_14mois_table_realises ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_14mois_table_realises";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_14mois_table_realises ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_14mois_table_realises LIKE ".$nameOfBDDOrigin.".access_bugdet_ventes_14mois_table_realises";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_14mois_table_realises ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_14mois_table_realises SELECT * FROM ".$nameOfBDDOrigin.".access_bugdet_ventes_14mois_table_realises";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_bugdet_ventes_articles_cout ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_articles_cout";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_articles_cout ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_articles_cout LIKE ".$nameOfBDDOrigin.".access_bugdet_ventes_articles_cout";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_articles_cout ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_articles_cout SELECT * FROM ".$nameOfBDDOrigin.".access_bugdet_ventes_articles_cout";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_bugdet_ventes_articles_totalite ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_articles_totalite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_articles_totalite ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_articles_totalite LIKE ".$nameOfBDDOrigin.".access_bugdet_ventes_articles_totalite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_articles_totalite ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_articles_totalite SELECT * FROM ".$nameOfBDDOrigin.".access_bugdet_ventes_articles_totalite";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_bugdet_ventes_correspondance_famcli_fammktg ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_correspondance_famcli_fammktg";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_correspondance_famcli_fammktg ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_correspondance_famcli_fammktg LIKE ".$nameOfBDDOrigin.".access_bugdet_ventes_correspondance_famcli_fammktg";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_correspondance_famcli_fammktg ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_correspondance_famcli_fammktg SELECT * FROM ".$nameOfBDDOrigin.".access_bugdet_ventes_correspondance_famcli_fammktg";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_bugdet_ventes_table_animation ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_table_animation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_table_animation ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_table_animation LIKE ".$nameOfBDDOrigin.".access_bugdet_ventes_table_animation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_table_animation ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_table_animation SELECT * FROM ".$nameOfBDDOrigin.".access_bugdet_ventes_table_animation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_bugdet_ventes_table_budget ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_table_budget";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_table_budget ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_table_budget LIKE ".$nameOfBDDOrigin.".access_bugdet_ventes_table_budget";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_table_budget ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_table_budget SELECT * FROM ".$nameOfBDDOrigin.".access_bugdet_ventes_table_budget";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_bugdet_ventes_table_bugdet_commentaire ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_table_bugdet_commentaire";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_table_bugdet_commentaire ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_table_bugdet_commentaire LIKE ".$nameOfBDDOrigin.".access_bugdet_ventes_table_bugdet_commentaire";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_table_bugdet_commentaire ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_table_bugdet_commentaire SELECT * FROM ".$nameOfBDDOrigin.".access_bugdet_ventes_table_bugdet_commentaire";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_bugdet_ventes_table_realises ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_table_realises";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_table_realises ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_bugdet_ventes_table_realises LIKE ".$nameOfBDDOrigin.".access_bugdet_ventes_table_realises";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_table_realises ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_bugdet_ventes_table_realises SELECT * FROM ".$nameOfBDDOrigin.".access_bugdet_ventes_table_realises";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_clients ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_clients";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_clients ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_clients LIKE ".$nameOfBDDOrigin.".access_clients";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_clients ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_clients SELECT * FROM ".$nameOfBDDOrigin.".access_clients";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_clients_rayon ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_clients_rayon";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_clients_rayon ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_clients_rayon LIKE ".$nameOfBDDOrigin.".access_clients_rayon";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_clients_rayon ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_clients_rayon SELECT * FROM ".$nameOfBDDOrigin.".access_clients_rayon";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_commerciaux ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_commerciaux";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_commerciaux ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_commerciaux LIKE ".$nameOfBDDOrigin.".access_commerciaux";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_commerciaux ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_commerciaux SELECT * FROM ".$nameOfBDDOrigin.".access_commerciaux";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_datasharing_Nb_magasin_entrepot ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_datasharing_Nb_magasin_entrepot";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_datasharing_Nb_magasin_entrepot ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_datasharing_Nb_magasin_entrepot LIKE ".$nameOfBDDOrigin.".access_datasharing_Nb_magasin_entrepot";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_datasharing_Nb_magasin_entrepot ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_datasharing_Nb_magasin_entrepot SELECT * FROM ".$nameOfBDDOrigin.".access_datasharing_Nb_magasin_entrepot";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_datasharing_Table_des_magasins ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_datasharing_Table_des_magasins";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_datasharing_Table_des_magasins ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_datasharing_Table_des_magasins LIKE ".$nameOfBDDOrigin.".access_datasharing_Table_des_magasins";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_datasharing_Table_des_magasins ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_datasharing_Table_des_magasins SELECT * FROM ".$nameOfBDDOrigin.".access_datasharing_Table_des_magasins";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_etat ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_etat ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_etat LIKE ".$nameOfBDDOrigin.".access_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_etat ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_etat SELECT * FROM ".$nameOfBDDOrigin.".access_etat";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_familles_articles ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_familles_articles";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_familles_articles ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_familles_articles LIKE ".$nameOfBDDOrigin.".access_familles_articles";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_familles_articles ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_familles_articles SELECT * FROM ".$nameOfBDDOrigin.".access_familles_articles";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_familles_clients ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_familles_clients";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_familles_clients ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_familles_clients LIKE ".$nameOfBDDOrigin.".access_familles_clients";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_familles_clients ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_familles_clients SELECT * FROM ".$nameOfBDDOrigin.".access_familles_clients";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_familles_gammes ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_familles_gammes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_familles_gammes ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_familles_gammes LIKE ".$nameOfBDDOrigin.".access_familles_gammes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_familles_gammes ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_familles_gammes SELECT * FROM ".$nameOfBDDOrigin.".access_familles_gammes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_familles_marketing ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_familles_marketing";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_familles_marketing ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_familles_marketing LIKE ".$nameOfBDDOrigin.".access_familles_marketing";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_familles_marketing ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_familles_marketing SELECT * FROM ".$nameOfBDDOrigin.".access_familles_marketing";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_formation_categories_socio_professionnelles ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_formation_categories_socio_professionnelles";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_formation_categories_socio_professionnelles ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_formation_categories_socio_professionnelles LIKE ".$nameOfBDDOrigin.".access_formation_categories_socio_professionnelles";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_formation_categories_socio_professionnelles ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_formation_categories_socio_professionnelles SELECT * FROM ".$nameOfBDDOrigin.".access_formation_categories_socio_professionnelles";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_formation_departements ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_formation_departements";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_formation_departements ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_formation_departements LIKE ".$nameOfBDDOrigin.".access_formation_departements";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_formation_departements ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_formation_departements SELECT * FROM ".$nameOfBDDOrigin.".access_formation_departements";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_formation_fonctions ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_formation_fonctions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_formation_fonctions ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_formation_fonctions LIKE ".$nameOfBDDOrigin.".access_formation_fonctions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_formation_fonctions ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_formation_fonctions SELECT * FROM ".$nameOfBDDOrigin.".access_formation_fonctions";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_formation_formation ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_formation_formation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_formation_formation ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_formation_formation LIKE ".$nameOfBDDOrigin.".access_formation_formation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_formation_formation ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_formation_formation SELECT * FROM ".$nameOfBDDOrigin.".access_formation_formation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_formation_regroupement_age ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_formation_regroupement_age";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_formation_regroupement_age ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_formation_regroupement_age LIKE ".$nameOfBDDOrigin.".access_formation_regroupement_age";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_formation_regroupement_age ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_formation_regroupement_age SELECT * FROM ".$nameOfBDDOrigin.".access_formation_regroupement_age";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_formation_salarie ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_formation_salarie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_formation_salarie ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_formation_salarie LIKE ".$nameOfBDDOrigin.".access_formation_salarie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_formation_salarie ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_formation_salarie SELECT * FROM ".$nameOfBDDOrigin.".access_formation_salarie";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_formation_services ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_formation_services";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_formation_services ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_formation_services LIKE ".$nameOfBDDOrigin.".access_formation_services";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_formation_services ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_formation_services SELECT * FROM ".$nameOfBDDOrigin.".access_formation_services";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_formation_stage_informations ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_formation_stage_informations";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_formation_stage_informations ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_formation_stage_informations LIKE ".$nameOfBDDOrigin.".access_formation_stage_informations";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_formation_stage_informations ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_formation_stage_informations SELECT * FROM ".$nameOfBDDOrigin.".access_formation_stage_informations";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_formation_stage_intitule_formation ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_formation_stage_intitule_formation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_formation_stage_intitule_formation ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_formation_stage_intitule_formation LIKE ".$nameOfBDDOrigin.".access_formation_stage_intitule_formation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_formation_stage_intitule_formation ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_formation_stage_intitule_formation SELECT * FROM ".$nameOfBDDOrigin.".access_formation_stage_intitule_formation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_formation_stage_table_des_domaines ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_formation_stage_table_des_domaines";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_formation_stage_table_des_domaines ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_formation_stage_table_des_domaines LIKE ".$nameOfBDDOrigin.".access_formation_stage_table_des_domaines";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_formation_stage_table_des_domaines ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_formation_stage_table_des_domaines SELECT * FROM ".$nameOfBDDOrigin.".access_formation_stage_table_des_domaines";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_formation_stage_table_des_intitules ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_formation_stage_table_des_intitules";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_formation_stage_table_des_intitules ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_formation_stage_table_des_intitules LIKE ".$nameOfBDDOrigin.".access_formation_stage_table_des_intitules";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_formation_stage_table_des_intitules ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_formation_stage_table_des_intitules SELECT * FROM ".$nameOfBDDOrigin.".access_formation_stage_table_des_intitules";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_formation_stage_table_des_organismes ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_formation_stage_table_des_organismes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_formation_stage_table_des_organismes ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_formation_stage_table_des_organismes LIKE ".$nameOfBDDOrigin.".access_formation_stage_table_des_organismes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_formation_stage_table_des_organismes ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_formation_stage_table_des_organismes SELECT * FROM ".$nameOfBDDOrigin.".access_formation_stage_table_des_organismes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_formation_table_des_Tx ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_formation_table_des_Tx";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_formation_table_des_Tx ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_formation_table_des_Tx LIKE ".$nameOfBDDOrigin.".access_formation_table_des_Tx";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_formation_table_des_Tx ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_formation_table_des_Tx SELECT * FROM ".$nameOfBDDOrigin.".access_formation_table_des_Tx";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_formation_table_des_donnees ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_formation_table_des_donnees";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_formation_table_des_donnees ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_formation_table_des_donnees LIKE ".$nameOfBDDOrigin.".access_formation_table_des_donnees";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_formation_table_des_donnees ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_formation_table_des_donnees SELECT * FROM ".$nameOfBDDOrigin.".access_formation_table_des_donnees";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_formation_table_des_postes_de_depenses ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_formation_table_des_postes_de_depenses";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_formation_table_des_postes_de_depenses ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_formation_table_des_postes_de_depenses LIKE ".$nameOfBDDOrigin.".access_formation_table_des_postes_de_depenses";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_formation_table_des_postes_de_depenses ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_formation_table_des_postes_de_depenses SELECT * FROM ".$nameOfBDDOrigin.".access_formation_table_des_postes_de_depenses";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_gammes ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_gammes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_gammes ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_gammes LIKE ".$nameOfBDDOrigin.".access_gammes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_gammes ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_gammes SELECT * FROM ".$nameOfBDDOrigin.".access_gammes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_indicateur_productivite_expedition_production ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_indicateur_productivite_expedition_production";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_indicateur_productivite_expedition_production ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_indicateur_productivite_expedition_production LIKE ".$nameOfBDDOrigin.".access_indicateur_productivite_expedition_production";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_indicateur_productivite_expedition_production ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_indicateur_productivite_expedition_production SELECT * FROM ".$nameOfBDDOrigin.".access_indicateur_productivite_expedition_production";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_indicateur_productivite_expedition_temps_travail ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_indicateur_productivite_expedition_temps_travail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_indicateur_productivite_expedition_temps_travail ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_indicateur_productivite_expedition_temps_travail LIKE ".$nameOfBDDOrigin.".access_indicateur_productivite_expedition_temps_travail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_indicateur_productivite_expedition_temps_travail ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_indicateur_productivite_expedition_temps_travail SELECT * FROM ".$nameOfBDDOrigin.".access_indicateur_productivite_expedition_temps_travail";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_carte_reseau ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_carte_reseau";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_carte_reseau ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_carte_reseau LIKE ".$nameOfBDDOrigin.".access_materiel_carte_reseau";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_carte_reseau ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_carte_reseau SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_carte_reseau";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_categorie_logiciel ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_categorie_logiciel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_categorie_logiciel ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_categorie_logiciel LIKE ".$nameOfBDDOrigin.".access_materiel_categorie_logiciel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_categorie_logiciel ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_categorie_logiciel SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_categorie_logiciel";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_connectique ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_connectique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_connectique ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_connectique LIKE ".$nameOfBDDOrigin.".access_materiel_connectique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_connectique ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_connectique SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_connectique";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_contrat ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_contrat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_contrat ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_contrat LIKE ".$nameOfBDDOrigin.".access_materiel_contrat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_contrat ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_contrat SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_contrat";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_ecran ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_ecran";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_ecran ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_ecran LIKE ".$nameOfBDDOrigin.".access_materiel_ecran";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_ecran ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_ecran SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_ecran";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_etat_incident ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_etat_incident";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_etat_incident ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_etat_incident LIKE ".$nameOfBDDOrigin.".access_materiel_etat_incident";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_etat_incident ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_etat_incident SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_etat_incident";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_etat_materiel_detail ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_etat_materiel_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_etat_materiel_detail ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_etat_materiel_detail LIKE ".$nameOfBDDOrigin.".access_materiel_etat_materiel_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_etat_materiel_detail ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_etat_materiel_detail SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_etat_materiel_detail";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_fonction_prestataire ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_fonction_prestataire";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_fonction_prestataire ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_fonction_prestataire LIKE ".$nameOfBDDOrigin.".access_materiel_fonction_prestataire";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_fonction_prestataire ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_fonction_prestataire SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_fonction_prestataire";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_gestion_incident ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_gestion_incident";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_gestion_incident ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_gestion_incident LIKE ".$nameOfBDDOrigin.".access_materiel_gestion_incident";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_gestion_incident ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_gestion_incident SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_gestion_incident";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_gestion_incident_groupe ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_gestion_incident_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_gestion_incident_groupe ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_gestion_incident_groupe LIKE ".$nameOfBDDOrigin.".access_materiel_gestion_incident_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_gestion_incident_groupe ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_gestion_incident_groupe SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_gestion_incident_groupe";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_horloge_processeur ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_horloge_processeur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_horloge_processeur ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_horloge_processeur LIKE ".$nameOfBDDOrigin.".access_materiel_horloge_processeur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_horloge_processeur ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_horloge_processeur SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_horloge_processeur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_imprimante ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_imprimante";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_imprimante ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_imprimante LIKE ".$nameOfBDDOrigin.".access_materiel_imprimante";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_imprimante ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_imprimante SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_imprimante";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_incident ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_incident";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_incident ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_incident LIKE ".$nameOfBDDOrigin.".access_materiel_incident";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_incident ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_incident SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_incident";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_licence ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_licence";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_licence ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_licence LIKE ".$nameOfBDDOrigin.".access_materiel_licence";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_licence ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_licence SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_licence";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_log ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_log";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_log ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_log LIKE ".$nameOfBDDOrigin.".access_materiel_log";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_log ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_log SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_log";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_marque_materiel ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_marque_materiel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_marque_materiel ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_marque_materiel LIKE ".$nameOfBDDOrigin.".access_materiel_marque_materiel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_marque_materiel ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_marque_materiel SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_marque_materiel";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_materiel_detail ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_materiel_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_materiel_detail ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_materiel_detail LIKE ".$nameOfBDDOrigin.".access_materiel_materiel_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_materiel_detail ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_materiel_detail SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_materiel_detail";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_materiel_general ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_materiel_general";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_materiel_general ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_materiel_general LIKE ".$nameOfBDDOrigin.".access_materiel_materiel_general";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_materiel_general ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_materiel_general SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_materiel_general";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_modem ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_modem";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_modem ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_modem LIKE ".$nameOfBDDOrigin.".access_materiel_modem";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_modem ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_modem SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_modem";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_module ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_module";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_module ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_module LIKE ".$nameOfBDDOrigin.".access_materiel_module";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_module ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_module SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_module";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_nature_action ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_nature_action";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_nature_action ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_nature_action LIKE ".$nameOfBDDOrigin.".access_materiel_nature_action";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_nature_action ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_nature_action SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_nature_action";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_nature_incident ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_nature_incident";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_nature_incident ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_nature_incident LIKE ".$nameOfBDDOrigin.".access_materiel_nature_incident";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_nature_incident ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_nature_incident SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_nature_incident";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_poste ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_poste";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_poste ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_poste LIKE ".$nameOfBDDOrigin.".access_materiel_poste";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_poste ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_poste SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_poste";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_prestataire ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_prestataire";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_prestataire ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_prestataire LIKE ".$nameOfBDDOrigin.".access_materiel_prestataire";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_prestataire ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_prestataire SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_prestataire";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_processeur ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_processeur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_processeur ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_processeur LIKE ".$nameOfBDDOrigin.".access_materiel_processeur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_processeur ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_processeur SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_processeur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_reseaux ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_reseaux";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_reseaux ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_reseaux LIKE ".$nameOfBDDOrigin.".access_materiel_reseaux";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_reseaux ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_reseaux SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_reseaux";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_reseaux_detail ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_reseaux_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_reseaux_detail ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_reseaux_detail LIKE ".$nameOfBDDOrigin.".access_materiel_reseaux_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_reseaux_detail ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_reseaux_detail SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_reseaux_detail";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_section_analytique ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_section_analytique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_section_analytique ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_section_analytique LIKE ".$nameOfBDDOrigin.".access_materiel_section_analytique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_section_analytique ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_section_analytique SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_section_analytique";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_serveur ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_serveur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_serveur ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_serveur LIKE ".$nameOfBDDOrigin.".access_materiel_serveur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_serveur ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_serveur SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_serveur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_serveur_applicatif ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_serveur_applicatif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_serveur_applicatif ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_serveur_applicatif LIKE ".$nameOfBDDOrigin.".access_materiel_serveur_applicatif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_serveur_applicatif ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_serveur_applicatif SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_serveur_applicatif";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_technologie_materiel ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_technologie_materiel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_technologie_materiel ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_technologie_materiel LIKE ".$nameOfBDDOrigin.".access_materiel_technologie_materiel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_technologie_materiel ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_technologie_materiel SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_technologie_materiel";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_type_materiel_detail ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_type_materiel_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_type_materiel_detail ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_type_materiel_detail LIKE ".$nameOfBDDOrigin.".access_materiel_type_materiel_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_type_materiel_detail ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_type_materiel_detail SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_type_materiel_detail";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_unite_centrale ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_unite_centrale";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_unite_centrale ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_unite_centrale LIKE ".$nameOfBDDOrigin.".access_materiel_unite_centrale";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_unite_centrale ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_unite_centrale SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_unite_centrale";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_materiel_wintegrate ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_materiel_wintegrate";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_wintegrate ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_materiel_wintegrate LIKE ".$nameOfBDDOrigin.".access_materiel_wintegrate";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_materiel_wintegrate ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_materiel_wintegrate SELECT * FROM ".$nameOfBDDOrigin.".access_materiel_wintegrate";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_plan_qualite_action ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_plan_qualite_action";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_plan_qualite_action ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_plan_qualite_action LIKE ".$nameOfBDDOrigin.".access_plan_qualite_action";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_plan_qualite_action ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_plan_qualite_action SELECT * FROM ".$nameOfBDDOrigin.".access_plan_qualite_action";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_plan_qualite_genre ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_plan_qualite_genre";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_plan_qualite_genre ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_plan_qualite_genre LIKE ".$nameOfBDDOrigin.".access_plan_qualite_genre";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_plan_qualite_genre ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_plan_qualite_genre SELECT * FROM ".$nameOfBDDOrigin.".access_plan_qualite_genre";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_plan_qualite_nature ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_plan_qualite_nature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_plan_qualite_nature ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_plan_qualite_nature LIKE ".$nameOfBDDOrigin.".access_plan_qualite_nature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_plan_qualite_nature ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_plan_qualite_nature SELECT * FROM ".$nameOfBDDOrigin.".access_plan_qualite_nature";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_plan_qualite_origine ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_plan_qualite_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_plan_qualite_origine ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_plan_qualite_origine LIKE ".$nameOfBDDOrigin.".access_plan_qualite_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_plan_qualite_origine ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_plan_qualite_origine SELECT * FROM ".$nameOfBDDOrigin.".access_plan_qualite_origine";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_plan_qualite_plan ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_plan_qualite_plan";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_plan_qualite_plan ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_plan_qualite_plan LIKE ".$nameOfBDDOrigin.".access_plan_qualite_plan";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_plan_qualite_plan ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_plan_qualite_plan SELECT * FROM ".$nameOfBDDOrigin.".access_plan_qualite_plan";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_plan_qualite_processus ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_plan_qualite_processus";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_plan_qualite_processus ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_plan_qualite_processus LIKE ".$nameOfBDDOrigin.".access_plan_qualite_processus";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_plan_qualite_processus ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_plan_qualite_processus SELECT * FROM ".$nameOfBDDOrigin.".access_plan_qualite_processus";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_prise_coeur_frequences ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_prise_coeur_frequences";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_prise_coeur_frequences ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_prise_coeur_frequences LIKE ".$nameOfBDDOrigin.".access_prise_coeur_frequences";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_prise_coeur_frequences ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_prise_coeur_frequences SELECT * FROM ".$nameOfBDDOrigin.".access_prise_coeur_frequences";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_prise_coeur_produits ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_prise_coeur_produits";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_prise_coeur_produits ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_prise_coeur_produits LIKE ".$nameOfBDDOrigin.".access_prise_coeur_produits";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_prise_coeur_produits ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_prise_coeur_produits SELECT * FROM ".$nameOfBDDOrigin.".access_prise_coeur_produits";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_qualite_processus ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_qualite_processus";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_qualite_processus ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_qualite_processus LIKE ".$nameOfBDDOrigin.".access_qualite_processus";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_qualite_processus ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_qualite_processus SELECT * FROM ".$nameOfBDDOrigin.".access_qualite_processus";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_rcp_Correspondance_mois_exercice ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_rcp_Correspondance_mois_exercice";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_rcp_Correspondance_mois_exercice ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_rcp_Correspondance_mois_exercice LIKE ".$nameOfBDDOrigin.".access_rcp_Correspondance_mois_exercice";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_rcp_Correspondance_mois_exercice ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_rcp_Correspondance_mois_exercice SELECT * FROM ".$nameOfBDDOrigin.".access_rcp_Correspondance_mois_exercice";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_rcp_Couts_a_ventiler_Articles_Saisonniers ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_rcp_Couts_a_ventiler_Articles_Saisonniers";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_rcp_Couts_a_ventiler_Articles_Saisonniers ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_rcp_Couts_a_ventiler_Articles_Saisonniers LIKE ".$nameOfBDDOrigin.".access_rcp_Couts_a_ventiler_Articles_Saisonniers";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_rcp_Couts_a_ventiler_Articles_Saisonniers ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_rcp_Couts_a_ventiler_Articles_Saisonniers SELECT * FROM ".$nameOfBDDOrigin.".access_rcp_Couts_a_ventiler_Articles_Saisonniers";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_rcp_Donnees_CLIENTS_ARTICLES ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_rcp_Donnees_CLIENTS_ARTICLES";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_rcp_Donnees_CLIENTS_ARTICLES ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_rcp_Donnees_CLIENTS_ARTICLES LIKE ".$nameOfBDDOrigin.".access_rcp_Donnees_CLIENTS_ARTICLES";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_rcp_Donnees_CLIENTS_ARTICLES ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_rcp_Donnees_CLIENTS_ARTICLES SELECT * FROM ".$nameOfBDDOrigin.".access_rcp_Donnees_CLIENTS_ARTICLES";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_rcp_Liste_Diffusion ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_rcp_Liste_Diffusion";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_rcp_Liste_Diffusion ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_rcp_Liste_Diffusion LIKE ".$nameOfBDDOrigin.".access_rcp_Liste_Diffusion";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_rcp_Liste_Diffusion ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_rcp_Liste_Diffusion SELECT * FROM ".$nameOfBDDOrigin.".access_rcp_Liste_Diffusion";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_rcp_Mois ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_rcp_Mois";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_rcp_Mois ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_rcp_Mois LIKE ".$nameOfBDDOrigin.".access_rcp_Mois";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_rcp_Mois ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_rcp_Mois SELECT * FROM ".$nameOfBDDOrigin.".access_rcp_Mois";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_recettes_multi_composition ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_recettes_multi_composition";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_composition ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_composition LIKE ".$nameOfBDDOrigin.".access_recettes_multi_composition";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_composition ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_composition SELECT * FROM ".$nameOfBDDOrigin.".access_recettes_multi_composition";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_recettes_multi_cout_fab ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_recettes_multi_cout_fab";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_cout_fab ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_cout_fab LIKE ".$nameOfBDDOrigin.".access_recettes_multi_cout_fab";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_cout_fab ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_cout_fab SELECT * FROM ".$nameOfBDDOrigin.".access_recettes_multi_cout_fab";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_recettes_multi_frais_de_transport ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_recettes_multi_frais_de_transport";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_frais_de_transport ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_frais_de_transport LIKE ".$nameOfBDDOrigin.".access_recettes_multi_frais_de_transport";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_frais_de_transport ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_frais_de_transport SELECT * FROM ".$nameOfBDDOrigin.".access_recettes_multi_frais_de_transport";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_recettes_multi_gammes ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_recettes_multi_gammes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_gammes ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_gammes LIKE ".$nameOfBDDOrigin.".access_recettes_multi_gammes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_gammes ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_gammes SELECT * FROM ".$nameOfBDDOrigin.".access_recettes_multi_gammes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_recettes_multi_importation_matiere ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_recettes_multi_importation_matiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_importation_matiere ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_importation_matiere LIKE ".$nameOfBDDOrigin.".access_recettes_multi_importation_matiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_importation_matiere ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_importation_matiere SELECT * FROM ".$nameOfBDDOrigin.".access_recettes_multi_importation_matiere";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_recettes_multi_importation_tarif ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_recettes_multi_importation_tarif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_importation_tarif ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_importation_tarif LIKE ".$nameOfBDDOrigin.".access_recettes_multi_importation_tarif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_importation_tarif ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_importation_tarif SELECT * FROM ".$nameOfBDDOrigin.".access_recettes_multi_importation_tarif";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_recettes_multi_infologic_fournisseurs ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_recettes_multi_infologic_fournisseurs";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_infologic_fournisseurs ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_infologic_fournisseurs LIKE ".$nameOfBDDOrigin.".access_recettes_multi_infologic_fournisseurs";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_infologic_fournisseurs ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_infologic_fournisseurs SELECT * FROM ".$nameOfBDDOrigin.".access_recettes_multi_infologic_fournisseurs";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_recettes_multi_infologic_unite ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_recettes_multi_infologic_unite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_infologic_unite ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_infologic_unite LIKE ".$nameOfBDDOrigin.".access_recettes_multi_infologic_unite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_infologic_unite ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_infologic_unite SELECT * FROM ".$nameOfBDDOrigin.".access_recettes_multi_infologic_unite";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_recettes_multi_ingredients ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_recettes_multi_ingredients";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_ingredients ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_ingredients LIKE ".$nameOfBDDOrigin.".access_recettes_multi_ingredients";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_ingredients ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_ingredients SELECT * FROM ".$nameOfBDDOrigin.".access_recettes_multi_ingredients";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_recettes_multi_recette ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_recettes_multi_recette";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_recette ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_recette LIKE ".$nameOfBDDOrigin.".access_recettes_multi_recette";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_recette ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_recette SELECT * FROM ".$nameOfBDDOrigin.".access_recettes_multi_recette";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_recettes_multi_stades ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_recettes_multi_stades";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_stades ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_stades LIKE ".$nameOfBDDOrigin.".access_recettes_multi_stades";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_stades ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_stades SELECT * FROM ".$nameOfBDDOrigin.".access_recettes_multi_stades";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_recettes_multi_unites ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_recettes_multi_unites";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_unites ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_recettes_multi_unites LIKE ".$nameOfBDDOrigin.".access_recettes_multi_unites";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_unites ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_recettes_multi_unites SELECT * FROM ".$nameOfBDDOrigin.".access_recettes_multi_unites";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_regroupements ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_regroupements";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_regroupements ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_regroupements LIKE ".$nameOfBDDOrigin.".access_regroupements";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_regroupements ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_regroupements SELECT * FROM ".$nameOfBDDOrigin.".access_regroupements";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_risq_pro_intranet_SITES ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_SITES";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_SITES ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_SITES LIKE ".$nameOfBDDOrigin.".access_risq_pro_intranet_SITES";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_SITES ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_SITES SELECT * FROM ".$nameOfBDDOrigin.".access_risq_pro_intranet_SITES";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_risq_pro_intranet_etat_dossier ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_etat_dossier";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_etat_dossier ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_etat_dossier LIKE ".$nameOfBDDOrigin.".access_risq_pro_intranet_etat_dossier";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_etat_dossier ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_etat_dossier SELECT * FROM ".$nameOfBDDOrigin.".access_risq_pro_intranet_etat_dossier";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_risq_pro_intranet_evaluation_risque ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_evaluation_risque";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_evaluation_risque ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_evaluation_risque LIKE ".$nameOfBDDOrigin.".access_risq_pro_intranet_evaluation_risque";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_evaluation_risque ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_evaluation_risque SELECT * FROM ".$nameOfBDDOrigin.".access_risq_pro_intranet_evaluation_risque";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_risq_pro_intranet_gravites ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_gravites";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_gravites ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_gravites LIKE ".$nameOfBDDOrigin.".access_risq_pro_intranet_gravites";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_gravites ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_gravites SELECT * FROM ".$nameOfBDDOrigin.".access_risq_pro_intranet_gravites";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_risq_pro_intranet_identification_codes_risque ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_identification_codes_risque";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_identification_codes_risque ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_identification_codes_risque LIKE ".$nameOfBDDOrigin.".access_risq_pro_intranet_identification_codes_risque";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_identification_codes_risque ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_identification_codes_risque SELECT * FROM ".$nameOfBDDOrigin.".access_risq_pro_intranet_identification_codes_risque";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_risq_pro_intranet_matrice_risque ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_matrice_risque";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_matrice_risque ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_matrice_risque LIKE ".$nameOfBDDOrigin.".access_risq_pro_intranet_matrice_risque";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_matrice_risque ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_matrice_risque SELECT * FROM ".$nameOfBDDOrigin.".access_risq_pro_intranet_matrice_risque";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_risq_pro_intranet_nature_risque ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_nature_risque";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_nature_risque ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_nature_risque LIKE ".$nameOfBDDOrigin.".access_risq_pro_intranet_nature_risque";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_nature_risque ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_nature_risque SELECT * FROM ".$nameOfBDDOrigin.".access_risq_pro_intranet_nature_risque";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_risq_pro_intranet_probabilites ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_probabilites";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_probabilites ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_probabilites LIKE ".$nameOfBDDOrigin.".access_risq_pro_intranet_probabilites";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_probabilites ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_probabilites SELECT * FROM ".$nameOfBDDOrigin.".access_risq_pro_intranet_probabilites";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_risq_pro_intranet_risques ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_risques";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_risques ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_risques LIKE ".$nameOfBDDOrigin.".access_risq_pro_intranet_risques";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_risques ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_risques SELECT * FROM ".$nameOfBDDOrigin.".access_risq_pro_intranet_risques";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_risq_pro_intranet_secteurs ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_secteurs";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_secteurs ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_risq_pro_intranet_secteurs LIKE ".$nameOfBDDOrigin.".access_risq_pro_intranet_secteurs";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_secteurs ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_risq_pro_intranet_secteurs SELECT * FROM ".$nameOfBDDOrigin.".access_risq_pro_intranet_secteurs";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_ruptures_commandes ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_ruptures_commandes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_ruptures_commandes ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_ruptures_commandes LIKE ".$nameOfBDDOrigin.".access_ruptures_commandes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_ruptures_commandes ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_ruptures_commandes SELECT * FROM ".$nameOfBDDOrigin.".access_ruptures_commandes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_ruptures_donnees_CLIENTS_ARTICLES ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_ruptures_donnees_CLIENTS_ARTICLES";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_ruptures_donnees_CLIENTS_ARTICLES ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_ruptures_donnees_CLIENTS_ARTICLES LIKE ".$nameOfBDDOrigin.".access_ruptures_donnees_CLIENTS_ARTICLES";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_ruptures_donnees_CLIENTS_ARTICLES ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_ruptures_donnees_CLIENTS_ARTICLES SELECT * FROM ".$nameOfBDDOrigin.".access_ruptures_donnees_CLIENTS_ARTICLES";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_ruptures_commandes_details ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_ruptures_commandes_details";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_ruptures_commandes_details ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_ruptures_commandes_details LIKE ".$nameOfBDDOrigin.".access_ruptures_commandes_details";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_ruptures_commandes_details ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_ruptures_commandes_details SELECT * FROM ".$nameOfBDDOrigin.".access_ruptures_commandes_details";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif LIKE ".$nameOfBDDOrigin.".access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif SELECT * FROM ".$nameOfBDDOrigin.".access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_ruptures_export_code_langue ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_ruptures_export_code_langue";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_ruptures_export_code_langue ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_ruptures_export_code_langue LIKE ".$nameOfBDDOrigin.".access_ruptures_export_code_langue";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_ruptures_export_code_langue ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_ruptures_export_code_langue SELECT * FROM ".$nameOfBDDOrigin.".access_ruptures_export_code_langue";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_ruptures_export_libelles_etrangers ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_ruptures_export_libelles_etrangers";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_ruptures_export_libelles_etrangers ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_ruptures_export_libelles_etrangers LIKE ".$nameOfBDDOrigin.".access_ruptures_export_libelles_etrangers";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_ruptures_export_libelles_etrangers ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_ruptures_export_libelles_etrangers SELECT * FROM ".$nameOfBDDOrigin.".access_ruptures_export_libelles_etrangers";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_ruptures_suivi ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_ruptures_suivi";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_ruptures_suivi ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_ruptures_suivi LIKE ".$nameOfBDDOrigin.".access_ruptures_suivi";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_ruptures_suivi ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_ruptures_suivi SELECT * FROM ".$nameOfBDDOrigin.".access_ruptures_suivi";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_ruptures_type_manquant ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_ruptures_type_manquant";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_ruptures_type_manquant ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_ruptures_type_manquant LIKE ".$nameOfBDDOrigin.".access_ruptures_type_manquant";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_ruptures_type_manquant ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_ruptures_type_manquant SELECT * FROM ".$nameOfBDDOrigin.".access_ruptures_type_manquant";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_service_consommateur_ciliviltes ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_service_consommateur_ciliviltes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_service_consommateur_ciliviltes ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_service_consommateur_ciliviltes LIKE ".$nameOfBDDOrigin.".access_service_consommateur_ciliviltes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_service_consommateur_ciliviltes ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_service_consommateur_ciliviltes SELECT * FROM ".$nameOfBDDOrigin.".access_service_consommateur_ciliviltes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_service_consommateur_consommateur ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_service_consommateur_consommateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_service_consommateur_consommateur ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_service_consommateur_consommateur LIKE ".$nameOfBDDOrigin.".access_service_consommateur_consommateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_service_consommateur_consommateur ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_service_consommateur_consommateur SELECT * FROM ".$nameOfBDDOrigin.".access_service_consommateur_consommateur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_service_consommateur_lettres_types ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_service_consommateur_lettres_types";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_service_consommateur_lettres_types ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_service_consommateur_lettres_types LIKE ".$nameOfBDDOrigin.".access_service_consommateur_lettres_types";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_service_consommateur_lettres_types ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_service_consommateur_lettres_types SELECT * FROM ".$nameOfBDDOrigin.".access_service_consommateur_lettres_types";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_service_consommateur_liste_diffusion ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_service_consommateur_liste_diffusion";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_service_consommateur_liste_diffusion ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_service_consommateur_liste_diffusion LIKE ".$nameOfBDDOrigin.".access_service_consommateur_liste_diffusion";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_service_consommateur_liste_diffusion ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_service_consommateur_liste_diffusion SELECT * FROM ".$nameOfBDDOrigin.".access_service_consommateur_liste_diffusion";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_service_consommateur_mesure_corrective ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_service_consommateur_mesure_corrective";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_service_consommateur_mesure_corrective ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_service_consommateur_mesure_corrective LIKE ".$nameOfBDDOrigin.".access_service_consommateur_mesure_corrective";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_service_consommateur_mesure_corrective ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_service_consommateur_mesure_corrective SELECT * FROM ".$nameOfBDDOrigin.".access_service_consommateur_mesure_corrective";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_service_consommateur_niveau_gravite ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_service_consommateur_niveau_gravite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_service_consommateur_niveau_gravite ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_service_consommateur_niveau_gravite LIKE ".$nameOfBDDOrigin.".access_service_consommateur_niveau_gravite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_service_consommateur_niveau_gravite ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_service_consommateur_niveau_gravite SELECT * FROM ".$nameOfBDDOrigin.".access_service_consommateur_niveau_gravite";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_service_consommateur_reclamations ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_service_consommateur_reclamations";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_service_consommateur_reclamations ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_service_consommateur_reclamations LIKE ".$nameOfBDDOrigin.".access_service_consommateur_reclamations";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_service_consommateur_reclamations ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_service_consommateur_reclamations SELECT * FROM ".$nameOfBDDOrigin.".access_service_consommateur_reclamations";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_service_consommateur_statistiques_articles ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_service_consommateur_statistiques_articles";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_service_consommateur_statistiques_articles ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_service_consommateur_statistiques_articles LIKE ".$nameOfBDDOrigin.".access_service_consommateur_statistiques_articles";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_service_consommateur_statistiques_articles ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_service_consommateur_statistiques_articles SELECT * FROM ".$nameOfBDDOrigin.".access_service_consommateur_statistiques_articles";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_service_consommateur_typologies ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_service_consommateur_typologies";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_service_consommateur_typologies ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_service_consommateur_typologies LIKE ".$nameOfBDDOrigin.".access_service_consommateur_typologies";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_service_consommateur_typologies ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_service_consommateur_typologies SELECT * FROM ".$nameOfBDDOrigin.".access_service_consommateur_typologies";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".access_type_de_facturation ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".access_type_de_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".access_type_de_facturation ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".access_type_de_facturation LIKE ".$nameOfBDDOrigin.".access_type_de_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".access_type_de_facturation ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".access_type_de_facturation SELECT * FROM ".$nameOfBDDOrigin.".access_type_de_facturation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".actiavaris ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".actiavaris";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".actiavaris ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".actiavaris LIKE ".$nameOfBDDOrigin.".actiavaris";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".actiavaris ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".actiavaris SELECT * FROM ".$nameOfBDDOrigin.".actiavaris";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".actijour ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".actijour";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".actijour ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".actijour LIKE ".$nameOfBDDOrigin.".actijour";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".actijour ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".actijour SELECT * FROM ".$nameOfBDDOrigin.".actijour";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".actijour_arch ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".actijour_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".actijour_arch ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".actijour_arch LIKE ".$nameOfBDDOrigin.".actijour_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".actijour_arch ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".actijour_arch SELECT * FROM ".$nameOfBDDOrigin.".actijour_arch";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".actijour_site ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".actijour_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".actijour_site ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".actijour_site LIKE ".$nameOfBDDOrigin.".actijour_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".actijour_site ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".actijour_site SELECT * FROM ".$nameOfBDDOrigin.".actijour_site";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".actijour_site_arch ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".actijour_site_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".actijour_site_arch ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".actijour_site_arch LIKE ".$nameOfBDDOrigin.".actijour_site_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".actijour_site_arch ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".actijour_site_arch SELECT * FROM ".$nameOfBDDOrigin.".actijour_site_arch";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".actisem ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".actisem";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".actisem ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".actisem LIKE ".$nameOfBDDOrigin.".actisem";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".actisem ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".actisem SELECT * FROM ".$nameOfBDDOrigin.".actisem";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".actisem_site ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".actisem_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".actisem_site ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".actisem_site LIKE ".$nameOfBDDOrigin.".actisem_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".actisem_site ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".actisem_site SELECT * FROM ".$nameOfBDDOrigin.".actisem_site";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".actitempo ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".actitempo";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".actitempo ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".actitempo LIKE ".$nameOfBDDOrigin.".actitempo";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".actitempo ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".actitempo SELECT * FROM ".$nameOfBDDOrigin.".actitempo";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".activite ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".activite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".activite ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".activite LIKE ".$nameOfBDDOrigin.".activite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".activite ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".activite SELECT * FROM ".$nameOfBDDOrigin.".activite";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".analyse_log_internet ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".analyse_log_internet";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".analyse_log_internet ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".analyse_log_internet LIKE ".$nameOfBDDOrigin.".analyse_log_internet";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".analyse_log_internet ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".analyse_log_internet SELECT * FROM ".$nameOfBDDOrigin.".analyse_log_internet";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".analyse_log_internet_arch ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".analyse_log_internet_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".analyse_log_internet_arch ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".analyse_log_internet_arch LIKE ".$nameOfBDDOrigin.".analyse_log_internet_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".analyse_log_internet_arch ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".analyse_log_internet_arch SELECT * FROM ".$nameOfBDDOrigin.".analyse_log_internet_arch";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".analyse_log_internet_duree ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".analyse_log_internet_duree";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".analyse_log_internet_duree ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".analyse_log_internet_duree LIKE ".$nameOfBDDOrigin.".analyse_log_internet_duree";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".analyse_log_internet_duree ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".analyse_log_internet_duree SELECT * FROM ".$nameOfBDDOrigin.".analyse_log_internet_duree";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".analyse_log_internet_duree_arch ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".analyse_log_internet_duree_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".analyse_log_internet_duree_arch ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".analyse_log_internet_duree_arch LIKE ".$nameOfBDDOrigin.".analyse_log_internet_duree_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".analyse_log_internet_duree_arch ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".analyse_log_internet_duree_arch SELECT * FROM ".$nameOfBDDOrigin.".analyse_log_internet_duree_arch";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".analyse_log_messagerie ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".analyse_log_messagerie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".analyse_log_messagerie ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".analyse_log_messagerie LIKE ".$nameOfBDDOrigin.".analyse_log_messagerie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".analyse_log_messagerie ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".analyse_log_messagerie SELECT * FROM ".$nameOfBDDOrigin.".analyse_log_messagerie";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".analyse_log_messagerie_arch ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".analyse_log_messagerie_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".analyse_log_messagerie_arch ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".analyse_log_messagerie_arch LIKE ".$nameOfBDDOrigin.".analyse_log_messagerie_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".analyse_log_messagerie_arch ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".analyse_log_messagerie_arch SELECT * FROM ".$nameOfBDDOrigin.".analyse_log_messagerie_arch";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".analyse_log_num_tel ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".analyse_log_num_tel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".analyse_log_num_tel ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".analyse_log_num_tel LIKE ".$nameOfBDDOrigin.".analyse_log_num_tel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".analyse_log_num_tel ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".analyse_log_num_tel SELECT * FROM ".$nameOfBDDOrigin.".analyse_log_num_tel";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".analyse_log_telephonie ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".analyse_log_telephonie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".analyse_log_telephonie ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".analyse_log_telephonie LIKE ".$nameOfBDDOrigin.".analyse_log_telephonie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".analyse_log_telephonie ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".analyse_log_telephonie SELECT * FROM ".$nameOfBDDOrigin.".analyse_log_telephonie";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".analyse_log_telephonie_arch ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".analyse_log_telephonie_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".analyse_log_telephonie_arch ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".analyse_log_telephonie_arch LIKE ".$nameOfBDDOrigin.".analyse_log_telephonie_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".analyse_log_telephonie_arch ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".analyse_log_telephonie_arch SELECT * FROM ".$nameOfBDDOrigin.".analyse_log_telephonie_arch";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".client ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".client ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".client LIKE ".$nameOfBDDOrigin.".client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".client ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".client SELECT * FROM ".$nameOfBDDOrigin.".client";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".codesoft_superviseur ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".codesoft_superviseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".codesoft_superviseur ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".codesoft_superviseur LIKE ".$nameOfBDDOrigin.".codesoft_superviseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".codesoft_superviseur ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".codesoft_superviseur SELECT * FROM ".$nameOfBDDOrigin.".codesoft_superviseur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".comment ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".comment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".comment ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".comment LIKE ".$nameOfBDDOrigin.".comment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".comment ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".comment SELECT * FROM ".$nameOfBDDOrigin.".comment";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".compos ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".compos";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".compos ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".compos LIKE ".$nameOfBDDOrigin.".compos";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".compos ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".compos SELECT * FROM ".$nameOfBDDOrigin.".compos";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".composa ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".composa";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".composa ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".composa LIKE ".$nameOfBDDOrigin.".composa";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".composa ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".composa SELECT * FROM ".$nameOfBDDOrigin.".composa";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".composv ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".composv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".composv ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".composv LIKE ".$nameOfBDDOrigin.".composv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".composv ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".composv SELECT * FROM ".$nameOfBDDOrigin.".composv";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".conserv ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".conserv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".conserv ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".conserv LIKE ".$nameOfBDDOrigin.".conserv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".conserv ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".conserv SELECT * FROM ".$nameOfBDDOrigin.".conserv";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".conserva ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".conserva";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".conserva ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".conserva LIKE ".$nameOfBDDOrigin.".conserva";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".conserva ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".conserva SELECT * FROM ".$nameOfBDDOrigin.".conserva";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".conservv ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".conservv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".conservv ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".conservv LIKE ".$nameOfBDDOrigin.".conservv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".conservv ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".conservv SELECT * FROM ".$nameOfBDDOrigin.".conservv";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".datasync_serveur ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".datasync_serveur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".datasync_serveur ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".datasync_serveur LIKE ".$nameOfBDDOrigin.".datasync_serveur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".datasync_serveur ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".datasync_serveur SELECT * FROM ".$nameOfBDDOrigin.".datasync_serveur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".datasync_transfert ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".datasync_transfert";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".datasync_transfert ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".datasync_transfert LIKE ".$nameOfBDDOrigin.".datasync_transfert";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".datasync_transfert ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".datasync_transfert SELECT * FROM ".$nameOfBDDOrigin.".datasync_transfert";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".diffusion ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".diffusion";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".diffusion ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".diffusion LIKE ".$nameOfBDDOrigin.".diffusion";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".diffusion ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".diffusion SELECT * FROM ".$nameOfBDDOrigin.".diffusion";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".divers ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".divers";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".divers ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".divers LIKE ".$nameOfBDDOrigin.".divers";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".divers ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".divers SELECT * FROM ".$nameOfBDDOrigin.".divers";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".diversa ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".diversa";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".diversa ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".diversa LIKE ".$nameOfBDDOrigin.".diversa";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".diversa ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".diversa SELECT * FROM ".$nameOfBDDOrigin.".diversa";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".diversv ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".diversv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".diversv ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".diversv LIKE ".$nameOfBDDOrigin.".diversv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".diversv ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".diversv SELECT * FROM ".$nameOfBDDOrigin.".diversv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".enseigne ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".enseigne";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".enseigne ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".enseigne LIKE ".$nameOfBDDOrigin.".enseigne";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".enseigne ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".enseigne SELECT * FROM ".$nameOfBDDOrigin.".enseigne";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".famille ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".famille";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".famille ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".famille LIKE ".$nameOfBDDOrigin.".famille";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".famille ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".famille SELECT * FROM ".$nameOfBDDOrigin.".famille";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fta_palettisation ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_palettisation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_palettisation ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_palettisation LIKE ".$nameOfBDDOrigin.".fta_palettisation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_palettisation ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_palettisation SELECT * FROM ".$nameOfBDDOrigin.".fta_palettisation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".gamme ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".gamme";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".gamme ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".gamme LIKE ".$nameOfBDDOrigin.".gamme";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".gamme ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".gamme SELECT * FROM ".$nameOfBDDOrigin.".gamme";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".gamstat ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".gamstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".gamstat ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".gamstat LIKE ".$nameOfBDDOrigin.".gamstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".gamstat ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".gamstat SELECT * FROM ".$nameOfBDDOrigin.".gamstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".indicateur_productivite_unite_temps ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".indicateur_productivite_unite_temps";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".indicateur_productivite_unite_temps ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".indicateur_productivite_unite_temps LIKE ".$nameOfBDDOrigin.".indicateur_productivite_unite_temps";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".indicateur_productivite_unite_temps ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".indicateur_productivite_unite_temps SELECT * FROM ".$nameOfBDDOrigin.".indicateur_productivite_unite_temps";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".infog ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".infog";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".infog ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".infog LIKE ".$nameOfBDDOrigin.".infog";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".infog ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".infog SELECT * FROM ".$nameOfBDDOrigin.".infog";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".infoga ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".infoga";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".infoga ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".infoga LIKE ".$nameOfBDDOrigin.".infoga";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".infoga ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".infoga SELECT * FROM ".$nameOfBDDOrigin.".infoga";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".infogv ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".infogv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".infogv ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".infogv LIKE ".$nameOfBDDOrigin.".infogv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".infogv ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".infogv SELECT * FROM ".$nameOfBDDOrigin.".infogv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".intranet_niveau_acces ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".intranet_niveau_acces";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".intranet_niveau_acces ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".intranet_niveau_acces LIKE ".$nameOfBDDOrigin.".intranet_niveau_acces";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".intranet_niveau_acces ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".intranet_niveau_acces SELECT * FROM ".$nameOfBDDOrigin.".intranet_niveau_acces";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".intranet_password ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".intranet_password";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".intranet_password ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".intranet_password LIKE ".$nameOfBDDOrigin.".intranet_password";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".intranet_password ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".intranet_password SELECT * FROM ".$nameOfBDDOrigin.".intranet_password";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".logft ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".logft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".logft ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".logft LIKE ".$nameOfBDDOrigin.".logft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".logft ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".logft SELECT * FROM ".$nameOfBDDOrigin.".logft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".intranet_access_linked_table ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".intranet_access_linked_table";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".intranet_access_linked_table ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".intranet_access_linked_table LIKE ".$nameOfBDDStructure.".intranet_access_linked_table";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".intranet_access_linked_table ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".intranet_access_linked_table SELECT * FROM ".$nameOfBDDStructure.".intranet_access_linked_table";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".lustat ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".lustat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".lustat ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".lustat LIKE ".$nameOfBDDOrigin.".lustat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".lustat ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".lustat SELECT * FROM ".$nameOfBDDOrigin.".lustat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere LIKE ".$nameOfBDDOrigin.".matiere_premiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_caracteristique_scientifique ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_caracteristique_scientifique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_caracteristique_scientifique ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_caracteristique_scientifique LIKE ".$nameOfBDDOrigin.".matiere_premiere_caracteristique_scientifique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_caracteristique_scientifique ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_caracteristique_scientifique SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_caracteristique_scientifique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_caracteristique_scientifique_filiere ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_caracteristique_scientifique_filiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_caracteristique_scientifique_filiere ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_caracteristique_scientifique_filiere LIKE ".$nameOfBDDOrigin.".matiere_premiere_caracteristique_scientifique_filiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_caracteristique_scientifique_filiere ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_caracteristique_scientifique_filiere SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_caracteristique_scientifique_filiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_client ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_client ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_client LIKE ".$nameOfBDDOrigin.".matiere_premiere_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_client ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_client SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_client_regroupement ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_client_regroupement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_client_regroupement ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_client_regroupement LIKE ".$nameOfBDDOrigin.".matiere_premiere_client_regroupement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_client_regroupement ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_client_regroupement SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_client_regroupement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_composant ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_composant";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_composant ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_composant LIKE ".$nameOfBDDOrigin.".matiere_premiere_composant";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_composant ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_composant SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_composant";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_composant_allergene ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_allergene";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_allergene ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_allergene LIKE ".$nameOfBDDOrigin.".matiere_premiere_composant_allergene";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_composant_allergene ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_composant_allergene SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_composant_allergene";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_composant_arome_categorie ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_arome_categorie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_arome_categorie ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_arome_categorie LIKE ".$nameOfBDDOrigin.".matiere_premiere_composant_arome_categorie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_composant_arome_categorie ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_composant_arome_categorie SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_composant_arome_categorie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_composant_groupe ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_groupe ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_groupe LIKE ".$nameOfBDDOrigin.".matiere_premiere_composant_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_composant_groupe ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_composant_groupe SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_composant_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_composant_nature ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_nature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_nature ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_nature LIKE ".$nameOfBDDOrigin.".matiere_premiere_composant_nature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_composant_nature ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_composant_nature SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_composant_nature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_composant_origine ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_origine ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_origine LIKE ".$nameOfBDDOrigin.".matiere_premiere_composant_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_composant_origine ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_composant_origine SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_composant_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_composant_regroupement_advitium ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_regroupement_advitium";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_regroupement_advitium ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_regroupement_advitium LIKE ".$nameOfBDDOrigin.".matiere_premiere_composant_regroupement_advitium";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_composant_regroupement_advitium ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_composant_regroupement_advitium SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_composant_regroupement_advitium";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_composant_template ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_template";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_template ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_composant_template LIKE ".$nameOfBDDOrigin.".matiere_premiere_composant_template";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_composant_template ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_composant_template SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_composant_template";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_conditionnement ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_conditionnement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_conditionnement ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_conditionnement LIKE ".$nameOfBDDOrigin.".matiere_premiere_conditionnement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_conditionnement ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_conditionnement SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_conditionnement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_contaminant ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_contaminant";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_contaminant ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_contaminant LIKE ".$nameOfBDDOrigin.".matiere_premiere_contaminant";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_contaminant ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_contaminant SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_contaminant";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_contaminant_association ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_contaminant_association";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_contaminant_association ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_contaminant_association LIKE ".$nameOfBDDOrigin.".matiere_premiere_contaminant_association";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_contaminant_association ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_contaminant_association SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_contaminant_association";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_contamination_croisee ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_contamination_croisee";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_contamination_croisee ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_contamination_croisee LIKE ".$nameOfBDDOrigin.".matiere_premiere_contamination_croisee";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_contamination_croisee ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_contamination_croisee  SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_contamination_croisee";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_etat ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_etat ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_etat LIKE ".$nameOfBDDOrigin.".matiere_premiere_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_etat ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_etat SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_ethique_client ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_ethique_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_ethique_client ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_ethique_client LIKE ".$nameOfBDDOrigin.".matiere_premiere_ethique_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_ethique_client ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_ethique_client SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_ethique_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_filiere ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_filiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_filiere ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_filiere LIKE ".$nameOfBDDOrigin.".matiere_premiere_filiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_filiere ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_filiere SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_filiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_fournisseur ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_fournisseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_fournisseur ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_fournisseur LIKE ".$nameOfBDDOrigin.".matiere_premiere_fournisseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_fournisseur ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_fournisseur SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_fournisseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_nature ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_nature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_nature ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_nature LIKE ".$nameOfBDDOrigin.".matiere_premiere_nature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_nature ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_nature SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_nature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_origine ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_origine ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_origine LIKE ".$nameOfBDDOrigin.".matiere_premiere_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_origine ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_origine SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_origine_cycle ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_origine_cycle";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_origine_cycle ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_origine_cycle LIKE ".$nameOfBDDOrigin.".matiere_premiere_origine_cycle";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_origine_cycle ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_origine_cycle SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_origine_cycle";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_origine_peche ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_origine_peche";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_origine_peche ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_origine_peche LIKE ".$nameOfBDDOrigin.".matiere_premiere_origine_peche";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_origine_peche ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_origine_peche SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_origine_peche";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_origine_speciale ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_origine_speciale";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_origine_speciale ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_origine_speciale LIKE ".$nameOfBDDOrigin.".matiere_premiere_origine_speciale";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_origine_speciale ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_origine_speciale SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_origine_speciale";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_surgelation ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_surgelation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_surgelation ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_surgelation LIKE ".$nameOfBDDOrigin.".matiere_premiere_surgelation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_surgelation ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_surgelation SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_surgelation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_transition ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_transition";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_transition ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_transition LIKE ".$nameOfBDDOrigin.".matiere_premiere_transition";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_transition ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_transition SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_transition";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".matiere_premiere_zone_fao ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".matiere_premiere_zone_fao";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_zone_fao ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".matiere_premiere_zone_fao LIKE ".$nameOfBDDOrigin.".matiere_premiere_zone_fao";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_zone_fao ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".matiere_premiere_zone_fao SELECT * FROM ".$nameOfBDDOrigin.".matiere_premiere_zone_fao";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".navservavaris ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".navservavaris";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".navservavaris ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".navservavaris LIKE ".$nameOfBDDOrigin.".navservavaris";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".navservavaris ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".navservavaris SELECT * FROM ".$nameOfBDDOrigin.".navservavaris";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".navstat ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".navstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".navstat ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".navstat LIKE ".$nameOfBDDOrigin.".navstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".navstat ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".navstat SELECT * FROM ".$nameOfBDDOrigin.".navstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".navstatavaris ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".navstatavaris";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".navstatavaris ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".navstatavaris LIKE ".$nameOfBDDOrigin.".navstatavaris";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".navstatavaris ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".navstatavaris SELECT * FROM ".$nameOfBDDOrigin.".navstatavaris";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".netlog_log ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".netlog_log";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".netlog_log ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".netlog_log LIKE ".$nameOfBDDOrigin.".netlog_log";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".netlog_log ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".netlog_log SELECT * FROM ".$nameOfBDDOrigin.".netlog_log";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".newsdefil ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".newsdefil";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".newsdefil ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".newsdefil LIKE ".$nameOfBDDOrigin.".newsdefil";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".newsdefil ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".newsdefil SELECT * FROM ".$nameOfBDDOrigin.".newsdefil";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".palet ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".palet";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".palet ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".palet LIKE ".$nameOfBDDOrigin.".palet";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".palet ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".palet SELECT * FROM ".$nameOfBDDOrigin.".palet";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".paleta ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".paleta";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".paleta ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".paleta LIKE ".$nameOfBDDOrigin.".paleta";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".paleta ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".paleta SELECT * FROM ".$nameOfBDDOrigin.".paleta";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".paletv ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".paletv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".paletv ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".paletv LIKE ".$nameOfBDDOrigin.".paletv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".paletv ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".paletv SELECT * FROM ".$nameOfBDDOrigin.".paletv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".perso ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".perso";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".perso ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".perso LIKE ".$nameOfBDDOrigin.".perso";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".perso ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".perso SELECT * FROM ".$nameOfBDDOrigin.".perso";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".publicateur ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".publicateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".publicateur ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".publicateur LIKE ".$nameOfBDDOrigin.".publicateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".publicateur ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".publicateur SELECT * FROM ".$nameOfBDDOrigin.".publicateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".save_client ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".save_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".save_client ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".save_client LIKE ".$nameOfBDDOrigin.".save_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".save_client ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".save_client SELECT * FROM ".$nameOfBDDOrigin.".save_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".segment ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".segment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".segment ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".segment LIKE ".$nameOfBDDOrigin.".segment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".segment ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".segment SELECT * FROM ".$nameOfBDDOrigin.".segment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".segstat ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".segstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".segstat ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".segstat LIKE ".$nameOfBDDOrigin.".segstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".segstat ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".segstat SELECT * FROM ".$nameOfBDDOrigin.".segstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".servicece ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".servicece";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".servicece ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".servicece LIKE ".$nameOfBDDOrigin.".servicece";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".servicece ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".servicece SELECT * FROM ".$nameOfBDDOrigin.".servicece";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".services ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".services";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".services ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".services LIKE ".$nameOfBDDOrigin.".services";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".services ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".services SELECT * FROM ".$nameOfBDDOrigin.".services";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".societe ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".societe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".societe ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".societe LIKE ".$nameOfBDDOrigin.".societe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".societe ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".societe SELECT * FROM ".$nameOfBDDOrigin.".societe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".stat_segment_site ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".stat_segment_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".stat_segment_site ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".stat_segment_site LIKE ".$nameOfBDDOrigin.".stat_segment_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".stat_segment_site ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".stat_segment_site SELECT * FROM ".$nameOfBDDOrigin.".stat_segment_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".types ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".types";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".types ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".types LIKE ".$nameOfBDDOrigin.".types";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".types ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".types SELECT * FROM ".$nameOfBDDOrigin.".types";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".valft ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".valft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".valft ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".valft LIKE ".$nameOfBDDOrigin.".valft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".valft ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".valft SELECT * FROM ".$nameOfBDDOrigin.".valft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".words ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".words";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".words ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".words LIKE ".$nameOfBDDOrigin.".words";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".words ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".words SELECT * FROM ".$nameOfBDDOrigin.".words";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}



/**
 * Création de tables de la V3
 */ 
 
echo "DROP ".$nameOfBDDTarget.".fta_saisie_obligatoire ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_saisie_obligatoire";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_saisie_obligatoire ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_saisie_obligatoire LIKE ".$nameOfBDDStructure.".fta_saisie_obligatoire";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_saisie_obligatoire ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_saisie_obligatoire SELECT * FROM ".$nameOfBDDStructure.".fta_saisie_obligatoire";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".intranet_actions ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".intranet_actions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".intranet_actions ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".intranet_actions LIKE ".$nameOfBDDStructure.".intranet_actions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".intranet_actions ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".intranet_actions SELECT * FROM ".$nameOfBDDStructure.".intranet_actions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".intranet_modules ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".intranet_modules";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".intranet_modules ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".intranet_modules LIKE ".$nameOfBDDStructure.".intranet_modules";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".intranet_modules ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".intranet_modules SELECT * FROM ".$nameOfBDDStructure.".intranet_modules";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".intranet_moteur_de_recherche_type_de_champ ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".intranet_moteur_de_recherche_type_de_champ";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".intranet_moteur_de_recherche_type_de_champ ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".intranet_moteur_de_recherche_type_de_champ LIKE ".$nameOfBDDStructure.".intranet_moteur_de_recherche_type_de_champ";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".intranet_moteur_de_recherche_type_de_champ ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".intranet_moteur_de_recherche_type_de_champ SELECT * FROM ".$nameOfBDDStructure.".intranet_moteur_de_recherche_type_de_champ";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fta_chapitre ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_chapitre";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_chapitre ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_chapitre LIKE ".$nameOfBDDStructure.".fta_chapitre";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_chapitre ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_chapitre SELECT * FROM ".$nameOfBDDStructure.".fta_chapitre";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fta_etat ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_etat ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_etat LIKE ".$nameOfBDDStructure.".fta_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_etat ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_etat SELECT * FROM ".$nameOfBDDStructure.".fta_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fta_processus_cycle ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_processus_cycle";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_processus_cycle ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_processus_cycle LIKE ".$nameOfBDDStructure.".fta_processus_cycle";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_processus_cycle ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_processus_cycle SELECT * FROM ".$nameOfBDDStructure.".fta_processus_cycle";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fta_processus ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_processus";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_processus ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_processus LIKE ".$nameOfBDDStructure.".fta_processus";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_processus ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_processus SELECT * FROM ".$nameOfBDDStructure.".fta_processus";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fta_transition ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_transition";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_transition ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_transition LIKE ".$nameOfBDDStructure.".fta_transition";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_transition ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_transition SELECT * FROM ".$nameOfBDDStructure.".fta_transition";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".extranets_table_des_liens ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".extranets_table_des_liens";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".extranets_table_des_liens ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".extranets_table_des_liens LIKE ".$nameOfBDDStructure.".extranets_table_des_liens";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".extranets_table_des_liens ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".extranets_table_des_liens SELECT * FROM ".$nameOfBDDStructure.".extranets_table_des_liens";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fta_migration_nomenclature ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_migration_nomenclature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_migration_nomenclature ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_migration_nomenclature LIKE ".$nameOfBDDStructure.".fta_migration_nomenclature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_migration_nomenclature ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_migration_nomenclature SELECT * FROM ".$nameOfBDDStructure.".fta_migration_nomenclature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fta_migration_produit ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_migration_produit";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_migration_produit ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_migration_produit LIKE ".$nameOfBDDStructure.".fta_migration_produit";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_migration_produit ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_migration_produit SELECT * FROM ".$nameOfBDDStructure.".fta_migration_produit";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fta_moteur_de_recherche ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_moteur_de_recherche";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_moteur_de_recherche ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_moteur_de_recherche LIKE ".$nameOfBDDStructure.".fta_moteur_de_recherche";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_moteur_de_recherche ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_moteur_de_recherche SELECT * FROM ".$nameOfBDDStructure.".fta_moteur_de_recherche";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".annexe_service_consommateur ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_service_consommateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_service_consommateur ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_service_consommateur LIKE ".$nameOfBDDOrigin.".service_consommateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_service_consommateur ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_service_consommateur SELECT * FROM ".$nameOfBDDOrigin.".service_consommateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".annexe_unite_facturation ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_unite_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_unite_facturation ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_unite_facturation LIKE ".$nameOfBDDStructure.".annexe_unite_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_unite_facturation ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_unite_facturation SELECT * FROM ".$nameOfBDDStructure.".annexe_unite_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".arcadia_atelier ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".arcadia_atelier";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".arcadia_atelier ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".arcadia_atelier LIKE ".$nameOfBDDStructure.".arcadia_atelier";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".arcadia_atelier ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".arcadia_atelier SELECT * FROM ".$nameOfBDDStructure.".arcadia_atelier";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".arcadia_client_circuit ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".arcadia_client_circuit";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".arcadia_client_circuit ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".arcadia_client_circuit LIKE ".$nameOfBDDStructure.".arcadia_client_circuit";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".arcadia_client_circuit ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".arcadia_client_circuit SELECT * FROM ".$nameOfBDDStructure.".arcadia_client_circuit";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".arcadia_client_reseau ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".arcadia_client_reseau";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".arcadia_client_reseau ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".arcadia_client_reseau LIKE ".$nameOfBDDStructure.".arcadia_client_reseau";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".arcadia_client_reseau ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".arcadia_client_reseau SELECT * FROM ".$nameOfBDDStructure.".arcadia_client_reseau";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".arcadia_client_reseau_segment_association ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".arcadia_client_reseau_segment_association";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".arcadia_client_reseau_segment_association ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".arcadia_client_reseau_segment_association LIKE ".$nameOfBDDStructure.".arcadia_client_reseau_segment_association";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".arcadia_client_reseau_segment_association ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".arcadia_client_reseau_segment_association SELECT * FROM ".$nameOfBDDStructure.".arcadia_client_reseau_segment_association";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".arcadia_client_segment ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".arcadia_client_segment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".arcadia_client_segment ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".arcadia_client_segment LIKE ".$nameOfBDDStructure.".arcadia_client_segment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".arcadia_client_segment ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".arcadia_client_segment SELECT * FROM ".$nameOfBDDStructure.".arcadia_client_segment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".arcadia_emballage_type ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".arcadia_emballage_type";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".arcadia_emballage_type ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".arcadia_emballage_type LIKE ".$nameOfBDDStructure.".arcadia_emballage_type";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".arcadia_emballage_type ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".arcadia_emballage_type SELECT * FROM ".$nameOfBDDStructure.".arcadia_emballage_type";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".arcadia_maquette_etiquette ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".arcadia_maquette_etiquette";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".arcadia_maquette_etiquette ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".arcadia_maquette_etiquette LIKE ".$nameOfBDDStructure.".arcadia_maquette_etiquette";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".arcadia_maquette_etiquette ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".arcadia_maquette_etiquette SELECT * FROM ".$nameOfBDDStructure.".arcadia_maquette_etiquette";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".arcadia_poste ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".arcadia_poste";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".arcadia_poste ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".arcadia_poste LIKE ".$nameOfBDDStructure.".arcadia_poste";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".arcadia_poste ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".arcadia_poste SELECT * FROM ".$nameOfBDDStructure.".arcadia_poste";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".arcadia_site_groupe_production ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".arcadia_site_groupe_production";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".arcadia_site_groupe_production ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".arcadia_site_groupe_production LIKE ".$nameOfBDDStructure.".arcadia_site_groupe_production";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".arcadia_site_groupe_production ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".arcadia_site_groupe_production SELECT * FROM ".$nameOfBDDStructure.".arcadia_site_groupe_production";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".arcadia_type_calibre ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".arcadia_type_calibre";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".arcadia_type_calibre ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".arcadia_type_calibre LIKE ".$nameOfBDDStructure.".arcadia_type_calibre";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".arcadia_type_calibre ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".arcadia_type_calibre SELECT * FROM ".$nameOfBDDStructure.".arcadia_type_calibre";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".arcadia_type_conservation ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".arcadia_type_conservation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".arcadia_type_conservation ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".arcadia_type_conservation LIKE ".$nameOfBDDStructure.".arcadia_type_conservation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".arcadia_type_conservation ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".arcadia_type_conservation SELECT * FROM ".$nameOfBDDStructure.".arcadia_type_conservation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fta_action_role ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_action_role";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_action_role ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_action_role LIKE ".$nameOfBDDStructure.".fta_action_role";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_action_role ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_action_role SELECT * FROM ".$nameOfBDDStructure.".fta_action_role";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}


echo "DROP ".$nameOfBDDTarget.".fta_role ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_role";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_role ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_role LIKE ".$nameOfBDDStructure.".fta_role";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_role ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_role SELECT * FROM ".$nameOfBDDStructure.".fta_role";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fta_workflow ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_workflow";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_workflow ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_workflow LIKE ".$nameOfBDDStructure.".fta_workflow";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_workflow ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_workflow SELECT * FROM ".$nameOfBDDStructure.".fta_workflow";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".fta_workflow_structure ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_workflow_structure";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_workflow_structure ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_workflow_structure LIKE ".$nameOfBDDStructure.".fta_workflow_structure";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_workflow_structure ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_workflow_structure SELECT * FROM ".$nameOfBDDStructure.".fta_workflow_structure";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".intranet_column_info ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".intranet_column_info";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".intranet_column_info ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".intranet_column_info LIKE ".$nameOfBDDStructure.".intranet_column_info";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".intranet_column_info ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".intranet_column_info SELECT * FROM ".$nameOfBDDStructure.".intranet_column_info";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".annexe_gestion_des_etiquettes ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_gestion_des_etiquettes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_gestion_des_etiquettes ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_gestion_des_etiquettes LIKE ".$nameOfBDDStructure.".annexe_gestion_des_etiquettes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_gestion_des_etiquettes ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_gestion_des_etiquettes SELECT * FROM ".$nameOfBDDStructure.".annexe_gestion_des_etiquettes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}


/**
 * Nouvelles données du jours de la prod
 */
/**
 * Création des tables dépendant de id_user
 */

echo "DROP ".$nameOfBDDTarget.".salaries ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".salaries";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".salaries ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".salaries LIKE ".$nameOfBDDStructure.".salaries";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".salaries ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".salaries SELECT * FROM ".$nameOfBDDOrigin.".salaries";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}


echo "UPDATE ".$nameOfBDDTarget.".salaries ...";
$sql = "UPDATE ".$nameOfBDDTarget.".salaries SET prenom='Non définie', login='non_definie'"
        . " WHERE id_user=-1;";       
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
echo "INSERT INTO ".$nameOfBDDTarget.".salaries Utilisateur supprimé ...";
$sql = "INSERT INTO `".$nameOfBDDTarget."`.`salaries` "
        . "(`id_user`, `ascendant_id_salaries`, `nom`, `prenom`, `date_creation_salaries`,"
        . " `id_catsopro`, `id_service`, `id_type`, `actif`, `libre2`, `libre3`, `libre4`,"
        . " `libre5`, `libre6`, `login`, `pass`, `mail`, `ecriture`, `membre_ce`, `lieu_geo`,"
        . " `newsdefil`, `blocage`, `portail_wiki_salaries`) "
        . "VALUES ('-2', '0', 'SYSTEM', 'Utilisateur supprimé', '" . date("Y-m-d") . "', '0',"
        . " '0', '0', 'oui', NULL, NULL, NULL, NULL, NULL, 'utilisateur_supprime',"
        . " NULL, NULL, 'oui', 'non', '', 'non', 'non', NULL); ";       
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
echo "INSERT INTO ".$nameOfBDDTarget.".salaries Utilisateur migrationv2tov3 ...";
$sql = "INSERT INTO `".$nameOfBDDTarget."`.`salaries` "
        . "(`id_user`, `ascendant_id_salaries`, `nom`, `prenom`, `date_creation_salaries`,"
        . " `id_catsopro`, `id_service`, `id_type`, `actif`, `libre2`, `libre3`, `libre4`,"
        . " `libre5`, `libre6`, `login`, `pass`, `mail`, `ecriture`, `membre_ce`, `lieu_geo`,"
        . " `newsdefil`, `blocage`, `portail_wiki_salaries`) "
        . "VALUES ('-3', '0', 'SYSTEM', 'Utilisateur migrationv2tov3', '" . date("Y-m-d") . "', '0',"
        . " '0', '0', 'oui', NULL, NULL, NULL, NULL, NULL, 'utilisateur_migrationv2tov3',"
        . " NULL, NULL, 'oui', 'non', '', 'non', 'non', NULL); ";       
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".log ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".log";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".log ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".log LIKE ".$nameOfBDDStructure.".log";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".log ...";
$sql = " INSERT INTO ".$nameOfBDDTarget.".log SELECT ".$nameOfBDDOrigin.".log.* 
             FROM ".$nameOfBDDOrigin.".log, ".$nameOfBDDTarget.".salaries
             WHERE ".$nameOfBDDOrigin.".log.id_user = ".$nameOfBDDTarget.".salaries.id_user";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".lu ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".lu";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".lu ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".lu LIKE ".$nameOfBDDOrigin.".lu";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".lu ...";
$sql = " INSERT INTO ".$nameOfBDDTarget.".lu SELECT ".$nameOfBDDOrigin.".lu.* 
             FROM ".$nameOfBDDOrigin.".lu, ".$nameOfBDDTarget.".salaries
             WHERE ".$nameOfBDDOrigin.".lu.id_user = ".$nameOfBDDTarget.".salaries.id_user";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".modes ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".modes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".modes ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".modes LIKE ".$nameOfBDDStructure.".modes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".modes ...";
$sql = " INSERT INTO ".$nameOfBDDTarget.".modes SELECT ".$nameOfBDDOrigin.".modes.* 
            FROM ".$nameOfBDDOrigin.".modes, ".$nameOfBDDTarget.".salaries
            WHERE ".$nameOfBDDOrigin.".modes.id_user = ".$nameOfBDDTarget.".salaries.id_user";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".planning_presence_detail ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".planning_presence_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".planning_presence_detail ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".planning_presence_detail LIKE ".$nameOfBDDStructure.".planning_presence_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".planning_presence_detail ...";
$sql = " INSERT INTO ".$nameOfBDDTarget.".planning_presence_detail SELECT ".$nameOfBDDOrigin.".planning_presence_detail . * 
            FROM ".$nameOfBDDOrigin.".planning_presence_detail, ".$nameOfBDDTarget.".salaries
            WHERE ".$nameOfBDDOrigin.".planning_presence_detail.id_salaries = ".$nameOfBDDTarget.".salaries.id_user";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".intranet_droits_acces ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".intranet_droits_acces";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".intranet_droits_acces ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".intranet_droits_acces LIKE ".$nameOfBDDStructure.".intranet_droits_acces";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".intranet_droits_acces ...";
$sql = " INSERT INTO ".$nameOfBDDTarget.".intranet_droits_acces SELECT ".$nameOfBDDOrigin.".intranet_droits_acces.*
                FROM ".$nameOfBDDOrigin.".intranet_droits_acces,".$nameOfBDDTarget.".salaries,".$nameOfBDDTarget.".intranet_modules,".$nameOfBDDTarget.".intranet_actions 
                WHERE ".$nameOfBDDOrigin.".intranet_droits_acces.id_user=".$nameOfBDDTarget.".salaries.id_user 
                AND ".$nameOfBDDOrigin.".intranet_droits_acces.id_intranet_modules=".$nameOfBDDTarget.".intranet_modules.id_intranet_modules 
                AND ".$nameOfBDDOrigin.".intranet_droits_acces.id_intranet_actions=".$nameOfBDDTarget.".intranet_actions.id_intranet_actions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "ALTER TABLE ".$nameOfBDDTarget.".intranet_droits_acces ...";
$sql = "ALTER TABLE ".$nameOfBDDTarget.".intranet_droits_acces "
        . " ADD id_intranet_droits_acces INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";

if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

/**
 * Ajout dans la table fta_action_site des Site de la table geo ayant le tag Fta
 */

echo "DROP ".$nameOfBDDTarget.".fta_action_site ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_action_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_action_site ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_action_site LIKE ".$nameOfBDDStructure.".fta_action_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_action_site ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_action_site SELECT * FROM ".$nameOfBDDStructure.".fta_action_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

$sql ="SELECT id_geo,geo,libelle_site_agis FROM ".$nameOfBDDTarget.".geo WHERE tag_application_geo LIKE \"%fta%\" OR id_geo=5 ";
$isteIdGeo =mysql_query($sql);



while ($rowsListeIdGeo=mysql_fetch_array($isteIdGeo)) {
    $idGeo = $rowsListeIdGeo['id_geo'];  
    $Geo = $rowsListeIdGeo['geo'];  
    $libelleSiteAgis = $rowsListeIdGeo['libelle_site_agis'];  
        
    $sqlWorkflow = "SELECT id_fta_workflow,id_intranet_actions
                    FROM ".$nameOfBDDTarget.".fta_workflow";
                            
    $resultWorkflow =mysql_query($sqlWorkflow);
        
        while ($rowsWorkflow=mysql_fetch_array($resultWorkflow)) {
          
                     $sqlCheckIdIntranetAction = "SELECT id_intranet_actions FROM  ".$nameOfBDDTarget.".intranet_actions "
                                                    ." WHERE description_intranet_actions=\"".$Geo
                                                    ."\" AND module_intranet_actions=19"
                                                    ." AND parent_intranet_actions=".$rowsWorkflow['id_intranet_actions']
                                                    ." AND tag_intranet_actions=\"site\" ";
                $resultCheckIdIntranetAction =mysql_query($sqlCheckIdIntranetAction);

             $rowsCheckIdIntranetAction =  mysql_fetch_array($resultCheckIdIntranetAction,MYSQL_ASSOC);
                 
                  if (!$rowsCheckIdIntranetAction['id_intranet_actions']) {  
                      echo "INSERT INTO ".$nameOfBDDTarget."." . "intranet_actions." . "description_intranet_actions .". $Geo ." id_fta_workflow .". $rowsWorkflow['id_fta_workflow'] ." ...";
                         $sql ="INSERT INTO ".$nameOfBDDTarget.".intranet_actions"
                                . "(" . "nom_intranet_actions"
                                . ", " . "module_intranet_actions"
                                . ", " . "description_intranet_actions"
                                . ", " . "tag_intranet_actions"
                                . ", " . "parent_intranet_actions"
                                . ") VALUES (\"" .$libelleSiteAgis
                                . "\", " . "19"
                                . ", \"" . $Geo
                                . "\", " . "\"site\""
                                . ", " . $rowsWorkflow["id_intranet_actions"] 
                                . ")";
                     $result= mysql_query($sql);
                     $idIntranetActions  = mysql_insert_id(); 
                      if($result)
                                  {echo "[OK] \n";}else{echo "[FAILED] intranet_actions.". "description_intranet_actions .". $Geo ." id_fta_workflow .". $rowsWorkflow['id_fta_workflow'] ." \n ";}
                                 
                                
                  }else{
                       $idIntranetActions=  $rowsCheckIdIntranetAction['id_intranet_actions'] ;
                  }                  
                    
            $sqlCheckFtaActionSite = "SELECT id_fta_action_site FROM  ".$nameOfBDDTarget.".fta_action_site 
                     WHERE id_fta_workflow=".$rowsWorkflow['id_fta_workflow']
                    ." AND id_site=".$idGeo
                    ." AND id_intranet_actions=".$idIntranetActions
                    ;
            
            $resultCheckFtaActionSite =mysql_query($sqlCheckFtaActionSite);
            
             $rowsCheckFtaActionSite =  mysql_fetch_array($resultCheckFtaActionSite,MYSQL_ASSOC);
                 
                 
                 if($rowsCheckFtaActionSite['id_fta_action_site']) {echo "[OK]$idGeo \n";}else{echo "[FAILED] -> INSERT INTO fta_action_site id_site $idGeo id_fta_workflow: ".$rowsWorkflow['id_fta_workflow']."  \n ";}
           
                if (!$rowsCheckFtaActionSite['id_fta_action_site']) {
                      echo "INSERT INTO ".$nameOfBDDTarget."." . "id_fta_action_site." . "id_site .". $idGeo ." id_fta_workflow .". $rowsWorkflow['id_fta_workflow'] ." ...";
                         if(mysql_query(
                                "INSERT INTO ".$nameOfBDDTarget."." . "fta_action_site"
                                . "(" . "id_site"
                                . ", " . "id_intranet_actions"
                                . ", " . "id_fta_workflow"
                                . ") VALUES (" .$idGeo
                                . ", " . $idIntranetActions
                                . ", " . $rowsWorkflow["id_fta_workflow"] 
                                . ")"
                        ))
                                  {echo "[OK] \n";}else{echo "[FAILED] id_site.$idGeo, id_fta_workflow .". $rowsWorkflow['id_fta_workflow'] ." \n ";}
                }
        }

}












/**
 * Création des tables dépendant de id_fta
 */
echo "DROP ".$nameOfBDDTarget.".fta ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

$sql = "SELECT * FROM ".$nameOfBDDOrigin.".fta f JOIN ".$nameOfBDDOrigin.".access_arti2 a  ON a.id_access_arti2 = f.id_access_arti2  AND a.id_fta = f.id_fta";
$resultFta =mysql_query($sql);

echo "CREATE TABLE ".$nameOfBDDTarget.".fta ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta LIKE  ".$nameOfBDDStructure.".fta;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}



while ($value=mysql_fetch_array($resultFta)) {
    /**
     * Nouveau champs : 
     * commentaire
     * duree_vie_technique_fta est devenue DEPRECATED_duree_vie_technique_fta
     */
    $idFta = $value['id_fta'];
    $idAccessArti2 = $value['id_access_arti2'];



    $idDossierFta = $value["id_dossier_fta"];
    $idVersionDossierFta = $value["id_version_dossier_fta"];
    $idFtaEtatTMP = $value["id_fta_etat"];
    if ($idFtaEtatTMP == '8') {
        $idFtaEtat = '1';
    } else {
        $idFtaEtat = $idFtaEtatTMP;
    }
    $cretateurFta = $value["createur_fta"];
    if ($cretateurFta == '0') {
        $cretateurFta = '-1';
    }
    $dateDerniereMajFta = $value["date_derniere_maj_fta"];
    $commentaireMajFtatmp = $value["commentaire_maj_fta"];
    $commentaireMajFtatmp2 = str_replace('"', '', $commentaireMajFtatmp);
    $commentaireMajFta = stripslashes($commentaireMajFtatmp2);
    $dateEcheanceFta = $value["date_echeance_fta"];
    $codeDouneFta = $value["code_douane_fta"];
    $poidsEmballageUVC = $value["poids_emballages_uvc_fta"];
    $poidsBrutUVC = $value["poids_brut_uvc_fta"];
    $suffixeAgrologicFta = $value["suffixe_agrologic_fta"];
    $origineTransformationFta = $value["origine_transformation_fta"];
    $remarqueFtatmp = $value["remarque_fta"];
    $remarqueFtatmp2 = str_replace('"', '', $remarqueFtatmp);
    $remarqueFta = stripslashes($remarqueFtatmp2);
    $apresOuvertureFtatmp = $value["apres_ouverture_fta"];
    $apresOuvertureFtatmp2 = str_replace('"', '', $apresOuvertureFtatmp);
    $apresOuvertureFta = stripslashes($apresOuvertureFtatmp2);
    $conseilRechauffageValideFtatmp = $value["conseil_rechauffage_valide_fta"];
    $conseilRechauffageValideFtatmp2 = str_replace('"', '', $conseilRechauffageValideFtatmp);
    $conseilRechauffageValideFta = stripslashes($conseilRechauffageValideFtatmp2);
    $conseilReferenceExterneFtatmp = $value["reference_externe_fta"];
    $conseilReferenceExterneFtatmp2 = str_replace('"', '', $conseilReferenceExterneFtatmp);
    $conseilReferenceExterneFta = stripslashes($conseilReferenceExterneFtatmp2);
    $designationCommercialeFtatmp = $value["designation_commerciale_fta"];
    $designationCommercialeFtatmp2 = str_replace('"', '', $designationCommercialeFtatmp);
    $designationCommercialeFta = stripslashes($designationCommercialeFtatmp2);
    $siteExpeditionFta = $value["site_expedition_fta"];
    $conseilRechauffageExperimentaleFtatmp = $value["conseil_rechauffage_experimentale_fta"];
    $conseilRechauffageExperimentaleFtatmp2 = str_replace('"', '', $conseilRechauffageExperimentaleFtatmp);
    $conseilRechauffageExperimentaleFta = stripslashes($conseilRechauffageExperimentaleFtatmp2);
    $origineMatiereFtatmp = $value["origine_matiere_fta"];
    $origineMatiereFtatmp2 = str_replace('"', '', $origineMatiereFtatmp);
    $origineMatiereFta = stripslashes($origineMatiereFtatmp2);
    $idArticleAgrocologic = $value["id_article_agrologic"];
    $allergenesMatiereFtatmp = $value["allergenes_matiere_fta"];
    $allergenesMatiereFtatmp2 = str_replace('"', '', $allergenesMatiereFtatmp);
    $allergenesMatiereFta = stripslashes($allergenesMatiereFtatmp2);
    $descriptionEmballagetmp = $value["description_emballage"];
    $descriptionEmballagetmp2 = str_replace('"', '', $descriptionEmballagetmp);
    $descriptionEmballage = stripslashes($descriptionEmballagetmp2);
    $listeChapitreMajFta = $value["liste_chapitre_maj_fta"];
    $verrouillageLibelleEtiquetteFta = $value["verrouillage_libelle_etiquette_fta"];
    $nombrePortionFta = $value["nombre_portion_fta"];
    $imageEcoEmballage = $value["image_eco_emballage"];
    $idServiceConsommateur = $value["id_service_consommateur"];
    $dateCreation = $value["date_creation"];
    $CODE_ARTICLE = $value["CODE_ARTICLE"];
    $codeArticleClient = $value["code_article_client"];
    $libelleCodeArticleClient = $value["libelle_code_article_client"];
    $codeArticleLdc = $value["code_article_ldc"];
    $LIBELLEtmp = $value["LIBELLE"];
    $LIBELLEtmp2 = str_replace('"', '', $LIBELLEtmp);
    $LIBELLE = stripslashes($LIBELLEtmp2);
    $LIBELLE_CLIENTtmp = $value["LIBELLE_CLIENT"];
    $LIBELLE_CLIENTtmp2 = str_replace('"', '', $LIBELLE_CLIENTtmp);
    $LIBELLE_CLIENT = stripslashes($LIBELLE_CLIENTtmp2);
    $NB_UNIT_ELEM = $value["NB_UNIT_ELEM"];
    $Poids_ELEM = $value["Poids_ELEM"];
    $atmosphereProtectrice = $value["atmosphere_protectrice"];

    /**
     * Unité_Facturation devient id_annexe_unite_facturation
     */
    $Unite_Facturation = $value["Unité_Facturation"];
    $actif = $value["actif"];
    $Site_de_productionTMP = $value["Site_de_production"];
    switch ($Site_de_productionTMP){
        case "4":
            $Site_de_production = "6";
        break;
        case "10":
            $Site_de_production = "11";
        break;
    
        default:            
            $Site_de_production =$Site_de_productionTMP;
        break;
    }
    $DureeDeVie = $value["Durée_de_vie"];
    $DureeDeVieTechnique = $value["Durée_de_vie_technique"];
    $Composition = $value["Composition"];
    $Composition1 = $value["composition1"];
    $libelleMultilangue = $value["libelle_multilangue"];
    $K_etat = $value["K_etat"];
    $EAN_UVC = $value["EAN_UVC"];
    $EAN_COLIS = $value["EAN_COLIS"];
    $EAN_PALETTE = $value["EAN_PALETTE"];
    $activation_codesoft_arti2 = $value["activation_codesoft_arti2"];
    $id_etiquette_codesoft_arti2 = $value["id_etiquette_codesoft_arti2"];


    /**
     * Conditions de transfères
     */
    
     if ($idFtaEtatTMP <> '8') {
            if ($Site_de_production == '1' or $Site_de_production == '3'or $Site_de_production == '6' or $Site_de_production == '11' or $Site_de_production == '0') {
                switch ($cretateurFta) {
                    //identifiant de l'utilisateur 
                    case '-2':
                    case '-1':
                    case '43':
                    case '48':
                    case '58':
                    case '71':
                    case '207':
                    case '237':
                    case '292':
                    case '318':
                    case '426':
                    case '492':
                    case '493':
                    case '521':
                    case '534':
                    case '544':
                    case '556':
                    case '557':
                    case '558':
                    case '559':
                    case '560':
                    case '572':
                        $idFtaWorkflow = '6';
                        break;
                    case '196':
                    case '278':
                    case '371':
                    case '379':
                    case '445':
                    case '457':
                    case '473':
                    case '474':
                    case '484':
                    case '487':
                    case '501':
                    case '512':
                    case '562':
                    case '563':
                        $idFtaWorkflow = '2';
                        break;
                    case '262':
                    case '361':
                        $idFtaWorkflow = '3';
                        break;
                }
            } else {
                $idFtaWorkflow = '8';
            }
        }else {
            $idFtaWorkflow = '9';
        }






    /**
     * Champ non utlisé (renommer en ".$nameOfBDDTarget.".nom_du_champ)
     */
    $numft = $value['numft'];
    $TRASH_id_fta_palettisation = $value['TRASH_id_fta_palettisation'];
    $champ_maj_fta = $value['champ_maj_fta'];
    $duree_apres_dernier_processus_fta = $value['duree_apres_dernier_processus_fta'];
    $periodeCommercialisationFta = $value["periode_commercialisation_fta"];
    $code_douane_libelle_fta = $value['code_douane_libelle_fta'];
    $synoptique_valide_ftatmp = $value['synoptique_valide_fta'];
    $synoptique_valide_ftatmp2 = str_replace('"', '', $synoptique_valide_ftatmp);
    $synoptique_valide_fta = stripslashes($synoptique_valide_ftatmp2);
    $presentationFtatmp = $value["presentation_fta"];
    $presentationFtatmp2 = str_replace('"', '', $presentationFtatmp);
    $presentationFta = stripslashes($presentationFtatmp2);
    $nom_abrege_ftatmp = $value["nom_abrege_fta"];
    $nom_abrege_ftatmp2 = str_replace('"', '', $nom_abrege_ftatmp);
    $nom_abrege_fta = stripslashes($nom_abrege_ftatmp2);
    $synoptique_experimental_ftatmp = $value['synoptique_experimental_fta'];
    $synoptique_experimental_ftatmp2 = str_replace('"', '', $synoptique_experimental_ftatmp);
    $synoptique_experimental_fta = stripslashes($synoptique_experimental_ftatmp2);
    $unite_affichage_fta = $value["unite_affichage_fta"];
    $signature_validation_fta = $value['signature_validation_fta'];
    $old_gamdesc = $value['old_gamdesc'];
    $old_segdesc = $value['old_segdesc'];
    $old_condition = $value['old_condition'];
    $old_conservation = $value['old_conservation'];
    $id_annexe_environnement_conservation = $value['id_annexe_environnement_conservation'];
    $date_transfert_industriel = $value['date_transfert_industriel'];
    $NB_UV_PAR_US1 = $value['NB_UV_PAR_US1'];
    $REGROUPEMENT = $value['REGROUPEMENT'];
    $UL2 = $value['UL2'];
    $RGR2 = $value['RGR2'];
    $Rayon = $value['Rayon'];
    $code_barre_specifique = $value['code_barre_specifique'];
    $transfert_PF = $value['transfert_PF'];
    $Zone_picking = $value['Zone_picking'];
    $fiche_palette_specifique = $value['fiche_palette_specifique'];
    $TARIF = $value['TARIF'];
    $pvc_article = $value['pvc_article'];
    $pvc_article_kg = $value['pvc_article_kg'];
    $FAMILLE_BUDGET = $value['FAMILLE_BUDGET'];
    $FAMILLE_ARTICLE = $value['FAMILLE_ARTICLE'];
    $id_access_familles_gammes = $value['id_access_familles_gammes'];
    $Coût_Denrée = $value['Coût_Denrée'];
    $Coût_Emballage = $value['Coût_Emballage'];
    $Coût_Autre = $value['Coût_Autre'];
    $Coût_PF = $value['Coût_PF'];
    $FAMILLE_MKTG = $value['FAMILLE_MKTG'];
    $nouvel_article = $value['nouvel_article'];
    $k_gestion_lot = $value['k_gestion_lot'];
    $pourcentageAvancement ="";





    $sql_inter = "INSERT INTO ".$nameOfBDDTarget.".fta (
id_fta, id_access_arti2, OLD_numft, id_fta_workflow,
 commentaire, OLD_id_fta_palettisation, id_dossier_fta, id_version_dossier_fta,
 OLD_champ_maj_fta, id_fta_etat, createur_fta, date_derniere_maj_fta,
 commentaire_maj_fta, date_echeance_fta, OLD_duree_apres_dernier_processus_fta, OLD_periode_commercialisation_fta,
 code_douane_fta, OLD_code_douane_libelle_fta, poids_emballages_uvc_fta, poids_brut_uvc_fta,
 poids_net_uvc_fta, suffixe_agrologic_fta, OLD_synoptique_valide_fta, origine_transformation_fta,
 remarque_fta, OLD_presentation_fta, apres_ouverture_fta, conseil_rechauffage_valide_fta,
 reference_externe_fta, OLD_duree_vie_technique_fta, designation_commerciale_fta, OLD_nom_abrege_fta,
 site_expedition_fta, conseil_rechauffage_experimentale_fta, OLD_synoptique_experimental_fta, OLD_unite_affichage_fta,
 OLD_signature_validation_fta, OLD_old_gamdesc, OLD_old_segdesc, OLD_old_condition,
 OLD_old_conservation, id_article_agrologic, OLD_id_annexe_environnement_conservation, origine_matiere_fta,
 allergenes_matiere_fta, description_emballage, OLD_date_transfert_industriel, liste_chapitre_maj_fta,
 verrouillage_libelle_etiquette_fta, nombre_portion_fta, OLD_last_id_fta, OLD_id_arcadia_type_calibre,
 OLD_nom_client_demandeur, OLD_besoin_fiche_technique, OLD_echeance_demandeur, OLD_besoin_compostage_fta,
 OLD_calibre_defaut, OLD_id_arcadia_emballage_type, OLD_id_arcadia_client_segment, OLD_quantite_hebdomadaire_estime_commande,
 OLD_nom_machine_fta, OLD_frequence_hebdomadaire_estime_commande, OLD_tare_fta, OLD_perte_matiere_fta,
 OLD_besoin_fiche_rendement, OLD_nom_demandeur_fta, OLD_id_arcadia_atelier, OLD_id_arcadia_client_circuit,
 OLD_id_annexe_environnement_conservation_groupe, OLD_societe_demandeur_fta, OLD_type_marinade_fta, OLD_besoin_fiche_productivite_fta,
 OLD_id_arcadia_poste, OLD_date_demandeur_fta, id_annexe_unite_facturation, OLD_type_minerai,
 OLD_id_arcadia_client_reseau, OLD_id_arcadia_maquette_etiquette, OLD_etude_prix_fta, OLD_bon_fabrication_atelier,
 date_creation, CODE_ARTICLE, code_article_client, code_article_ldc,
 LIBELLE, LIBELLE_CLIENT, NB_UNIT_ELEM, OLD_NB_UV_PAR_US1,
 Poids_ELEM, OLD_REGROUPEMENT, OLD_UL2, OLD_RGR2,
 OLD_Unite_Facturation, Rayon, actif, Site_de_production,
 Duree_de_vie, Duree_de_vie_technique, OLD_code_barre_specifique, OLD_transfert_PF,
 OLD_Zone_picking, OLD_fiche_palette_specifique, OLD_TARIF, pvc_article,
 OLD_pvc_article_kg, OLD_FAMILLE_BUDGET, OLD_FAMILLE_ARTICLE, OLD_id_access_familles_gammes,
 OLD_Cout_Denree, OLD_Cout_Emballage, OLD_Cout_Autre, OLD_Cout_PF,
 OLD_FAMILLE_MKTG, Composition, composition1, libelle_multilangue,
 K_etat, EAN_UVC, EAN_COLIS, EAN_PALETTE,
 OLD_nouvel_article, OLD_k_gestion_lot, activation_codesoft_arti2, id_etiquette_codesoft_arti2,
 atmosphere_protectrice, image_eco_emballage, libelle_code_article_client, id_service_consommateur,
 nom_societe, id_fta_classification2, pourcentage_avancement, liste_id_fta_role)
VALUES ( \"$idFta\", \"$idAccessArti2\", \"$numft\", \"$idFtaWorkflow\" "
            . ", \"\", \"$TRASH_id_fta_palettisation\", \"$idDossierFta\", \"$idVersionDossierFta\" "
            . ", \"$champ_maj_fta\", \"$idFtaEtat\", \"$cretateurFta\", \"$dateDerniereMajFta\" "
            . ", \"$commentaireMajFta\", \"$dateEcheanceFta\", \"$duree_apres_dernier_processus_fta\", \"$periodeCommercialisationFta\" "
            . ", \"$codeDouneFta\", \"$code_douane_libelle_fta\", \"$poidsEmballageUVC\", \"$poidsBrutUVC\" "
            . ", \"\", \"$suffixeAgrologicFta\", \"$synoptique_valide_fta\", \"$origineTransformationFta\" "
            . ", \"$remarqueFta\", \"$presentationFta\", \"$apresOuvertureFta\", \"$conseilRechauffageValideFta\" "
            . ", \"\", \"$DureeDeVieTechnique\", \"$designationCommercialeFta\", \"$nom_abrege_fta\" "
            . ", \"$siteExpeditionFta\", \"$conseilRechauffageExperimentaleFta\", \"$synoptique_experimental_fta\", \"$unite_affichage_fta\" "
            . ", \"$signature_validation_fta\", \"$old_gamdesc\", \"$old_segdesc\", \"$old_condition\" "
            . ", \"$old_conservation\", \"$idArticleAgrocologic\", \"$id_annexe_environnement_conservation\", \"$origineMatiereFta\" "
            . ", \"$allergenesMatiereFta\", \"$descriptionEmballage\", \"$date_transfert_industriel\", \"$listeChapitreMajFta\" "
            . ", \"$verrouillageLibelleEtiquetteFta\", \"$nombrePortionFta\", \"\", \"\" "
            . ", \"\", \"\", \"\", \"\" "
            . ", \"\", \"\", \"\", \"\" "
            . ", \"\", \"\", \"\", \"\" "
            . ", \"\", \"\", \"\", \"\" "
            . ", \"\", \"\", \"\", \"\" "
            . ", \"\", \"\", \"$Unite_Facturation\", \"\" "
            . ", \"\", \"\", \"\", \"\" "
            . ", \"$dateCreation\", \"$CODE_ARTICLE\", \"$codeArticleClient\", \"$codeArticleLdc\" "
            . ", \"$LIBELLE\", \"$LIBELLE_CLIENT\", \"$NB_UNIT_ELEM\", \"$NB_UV_PAR_US1\" "
            . ", \"$Poids_ELEM\", \"$REGROUPEMENT\", \"$UL2\", \"$RGR2\" "
            . ", \"\", \"$Rayon\", \"$actif\", \"$Site_de_production\" "
            . ", \"$DureeDeVie\", \"$DureeDeVieTechnique\", \"$code_barre_specifique\", \"$transfert_PF\" "
            . ", \"$Zone_picking\", \"$fiche_palette_specifique\", \"$TARIF\", \"$pvc_article\" "
            . ", \"$pvc_article_kg\", \"$FAMILLE_BUDGET\", \"$FAMILLE_ARTICLE\", \"$id_access_familles_gammes\" "
            . ", \"$Coût_Denrée\", \"$Coût_Emballage\", \"$Coût_Autre\", \"$Coût_PF\" "
            . ", \"$FAMILLE_MKTG\", \"$Composition\", \"$Composition1\", \"$libelleMultilangue\" "
            . ", \"$K_etat\", \"$EAN_UVC\", \"$EAN_COLIS\", \"$EAN_PALETTE\" "
            . ", \"$nouvel_article\", \"$k_gestion_lot\", \"$activation_codesoft_arti2\", \"$id_etiquette_codesoft_arti2\" "
            . ", \"$atmosphereProtectrice\", \"$imageEcoEmballage\", \"$libelleCodeArticleClient\", \"$idServiceConsommateur\" "
            . ", \"\", NULL,\"$pourcentageAvancement\",\"\")";
         echo "INSERT INTO ".$nameOfBDDTarget."." . "fta." . "id_fta .". $idFta ." ...";
    mysql_query("SET NAMES 'utf8'");
    if(mysql_query($sql_inter)) {echo "[OK]\n";}else{echo "[FAILED]\n $idFta \n";}

//    $resultquery = mysql_query($sql_inter);
//    if (!$resultquery) {
//        $sqlFalse = $sql_inter;
//        $resultquery2 = DatabaseOperation::execute($sql_inter);
//    }
}

/**
 * Affiliation d'un id_user au createur supprimer
 */

  $sql ="SELECT DISTINCT fta.id_fta
         FROM ".$nameOfBDDTarget.".fta
         WHERE Site_de_production NOT 
         IN (SELECT id_geo FROM ".$nameOfBDDTarget.".geo) ";
  
$resultSiteDEProduction =mysql_query($sql);
if ($resultSiteDEProduction) {
    while ($rowsChangeIdSiteProduction=mysql_fetch_array($resultSiteDEProduction)) {
        $idFta = $rowsChangeIdSiteProduction['id_fta'];
        $sql_inter = "UPDATE ".$nameOfBDDTarget.".fta
                 SET Site_de_production=1"
                . " WHERE id_fta=" . $idFta;
         echo "UPDATE ".$nameOfBDDTarget."." . "fta." . "id_fta .". $idFta ."Site_de_production" . "=1" ." ...";
    if(mysql_query($sql_inter)) {echo "[OK]\n";}else{echo "[FAILED]\n $idFta \n";}
      
    }
}
             $sql = "SELECT DISTINCT fta.id_fta
                FROM ".$nameOfBDDTarget.".fta, ".$nameOfBDDTarget.".salaries
                WHERE createur_fta NOT 
                IN (
                SELECT DISTINCT fta.createur_fta
                FROM ".$nameOfBDDTarget.".fta, ".$nameOfBDDTarget.".salaries
                WHERE createur_fta = id_user
                )";
$resultChangeIdUse =mysql_query($sql);

if ($resultChangeIdUse) {
    while ($rowsChangeIdUser=mysql_fetch_array($resultChangeIdUse)) {
        $idFta = $rowsChangeIdUser['id_fta'];
        $sql_inter = "UPDATE ".$nameOfBDDTarget.".fta
                 SET createur_fta=-2"
                . " WHERE id_fta=" . $idFta;
 echo "UPDATE ".$nameOfBDDTarget."." . "fta." . "id_fta .". $idFta ."createur_fta" . "=-2" ." ...";
    if(mysql_query($sql_inter)) {echo "[OK]\n";}else{echo "[FAILED]\n $idFta \n";}
      
    }
} 
//   switch ($idFtaEtatTMP) {
//    case  '8':
//        $idFtaEtat = '1';
//        break;
//    case  '3':
//        $pourcentageAvancement = '100%'; 
//        $idFtaEtat = $idFtaEtatTMP;
//         break;
//  case  '1':
//  case  '5':
//  case  '6':
//        $idFtaEtat = $idFtaEtatTMP;
//        break;
//    }
/**
 * Extraction Fta suivi de projet
 */
echo "DROP ".$nameOfBDDTarget.".fta_suivi_projet ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_suivi_projet";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_suivi_projet ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_suivi_projet LIKE  ".$nameOfBDDStructure.".fta_suivi_projet;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

$sql ="SELECT ".$nameOfBDDOrigin.".fta_suivi_projet.* "
        . " FROM ".$nameOfBDDOrigin.".fta_suivi_projet,".$nameOfBDDTarget.".fta"
        . " WHERE ".$nameOfBDDOrigin.".fta_suivi_projet.id_fta=".$nameOfBDDTarget.".fta.id_fta ";
$resultFtaSuiviPrjet =mysql_query($sql);

while ($rowsTableFtaSuiviProjet=mysql_fetch_array($resultFtaSuiviPrjet)) {
    $idFtaSuiviProjet = $rowsTableFtaSuiviProjet["id_fta_suivi_projet"];
    $idFta = $rowsTableFtaSuiviProjet["id_fta"];
    $idFtaChapitreTMP = $rowsTableFtaSuiviProjet['id_fta_chapitre'];
    $commentaire_suivi_projettmp = $rowsTableFtaSuiviProjet['commentaire_suivi_projet'];
    $commentaire_suivi_projettmp2 = str_replace('"', '', $commentaire_suivi_projettmp);
    $commentaire_suivi_projet = stripslashes($commentaire_suivi_projettmp2);
    $date_validation_suivi_projet = $rowsTableFtaSuiviProjet['date_validation_suivi_projet'];
    $signature_validation_suivi_projet = $rowsTableFtaSuiviProjet['signature_validation_suivi_projet'];
    $date_demarrage_chapitre_fta_suivi_projet = $rowsTableFtaSuiviProjet['date_demarrage_chapitre_fta_suivi_projet'];
    $notification_fta_suivi_projet = $rowsTableFtaSuiviProjet['notification_fta_suivi_projet'];
    $correction_fta_suivi_projettmp = $rowsTableFtaSuiviProjet['correction_fta_suivi_projet'];
    $correction_fta_suivi_projettmp2 = str_replace('"', '', $correction_fta_suivi_projettmp);
    $correction_fta_suivi_projet = stripslashes($correction_fta_suivi_projettmp2);

    $arrayIdFtaWorkflow = mysql_query(
                    "SELECT DISTINCT id_fta_workflow
                     FROM ".$nameOfBDDTarget.".fta WHERE id_fta = " . $idFta
    );

    while ($rowIdFtaWorkflow=mysql_fetch_array($arrayIdFtaWorkflow)) {
        $idFtaWorkflow = $rowIdFtaWorkflow['id_fta_workflow'];
    }
    
    switch ($idFtaChapitreTMP) {
            case '20':
                $idFtaChapitre = '32';
                break;
            case '40' :
                $idFtaChapitre = '21';
                break;
            case '80' :
                $idFtaChapitre = '27';
                break;
            case '60' :
                $idFtaChapitre = '24';
                break;
            case '101' :
                switch ($idFtaWorkflow) {
                    case '3':
                    case '5':
                        $idFtaChapitre = '35';
                        break;
                    case '6':
                    case '7':
                        $idFtaChapitre = '38';
                        break;
                    default :
                        $idFtaChapitre = '29';
                        break;
                }
                break;
            case '100':
                switch ($idFtaWorkflow) {
                    case '3':
                    case '5':
                        $idFtaChapitre = '36';
                        break;
                    case '6':
                    case '7':
                        $idFtaChapitre = '39';
                        break;
                    default :
                        $idFtaChapitre = '30';
                        break;
                }

                break;
            case '111' :
                $idFtaChapitre = '33';
                break;
            case '70' :
                $idFtaChapitre = '17';
                break;
            case '112' :
            case '90' :
                $idFtaChapitre = '40';
                break;
                    default:
                      $idFtaChapitre=  $idFtaChapitreTMP;
                           break;
        }

    $selectInsert = " INSERT INTO ".$nameOfBDDTarget.".`fta_suivi_projet` "
            . "(`id_fta_suivi_projet`, "
            . "`id_fta`, "
            . "`id_fta_chapitre`,"
            . " `commentaire_suivi_projet`, "
            . "`date_validation_suivi_projet`, "
            . "`signature_validation_suivi_projet`,"
            . " `date_demarrage_chapitre_fta_suivi_projet`,"
            . " `notification_fta_suivi_projet`, "
            . "`correction_fta_suivi_projet`)"
            . "VALUES ("
            . " \"" . $idFtaSuiviProjet . "\","
            . " \"" . $idFta . "\","
            . " \"" . $idFtaChapitre . "\","
            . " \"" . $commentaire_suivi_projet . "\","
            . " \"" . $date_validation_suivi_projet . "\","
            . " \"" . $signature_validation_suivi_projet . "\","
            . " \"" . $date_demarrage_chapitre_fta_suivi_projet . "\","
            . " \"" . $notification_fta_suivi_projet . "\","
            . " \"" . $correction_fta_suivi_projet . "\")"
    ;
   echo "INSERT INTO ".$nameOfBDDTarget."." . "fta_suivi_projet." . "id_fta .". $idFta ."id_fta_chapitre" . "=" . $idFtaChapitre." ...";
    mysql_query("SET NAMES 'utf8'");
   if(mysql_query($selectInsert)) {echo "[OK] \n";}else{echo "[FAILED] $idFtaSuiviProjet \n ";}
   
}

/**
 * Second traitment fta suivie de projet
 */


    echo  date("H:i:s")."\n";

$arrayIdFtaSuiviProjet = mysql_query(
                "SELECT DISTINCT fta_suivi_projet.id_fta,id_fta_etat FROM ".$nameOfBDDTarget.".fta_suivi_projet,".$nameOfBDDTarget.".fta "
        . " WHERE fta_suivi_projet.id_fta=fta.id_fta"
);
echo "SELECT DISTINCT fta_suivi_projet.id_fta,id_fta_etat,createur_fta FROM ".$nameOfBDDTarget.".fta_suivi_projet ...";
   if($arrayIdFtaSuiviProjet) {echo "[OK] \n";}else{echo "[FAILED] \n ";}

while ( $rowsIdFtaSuiviProjet=  mysql_fetch_array($arrayIdFtaSuiviProjet)) {
    $idFta = $rowsIdFtaSuiviProjet['id_fta'];
    $idFtaEtat = $rowsIdFtaSuiviProjet['id_fta_etat'];

    $arrayIdFtaWorkflow = mysql_query(
                        "SELECT DISTINCT id_fta_workflow
                         FROM ".$nameOfBDDTarget.".fta  WHERE id_fta = " . $idFta
        );
    
        while ($rowIdFtaWorkflow=  mysql_fetch_array($arrayIdFtaWorkflow)) {
            $idFtaWorkflow = $rowIdFtaWorkflow['id_fta_workflow'];
        }
        if ($idFtaWorkflow) {
            $arrayChapitre = mysql_query(
                            "SELECT id_fta_chapitre, id_fta_processus  FROM ".$nameOfBDDTarget.".fta_workflow_structure WHERE id_fta_workflow =" . $idFtaWorkflow
            );


            while ($rowsChapitre=  mysql_fetch_array($arrayChapitre)) {
                $arrayCheckIdSuiviProjet = mysql_query(
                                "SELECT id_fta_suivi_projet" 
                                . " FROM ".$nameOfBDDTarget.".fta_suivi_projet" 
                                . " WHERE id_fta" 
                                . "=" . $idFta
                                . " AND id_fta_chapitre" 
                                . "=" . $rowsChapitre["id_fta_chapitre"]                      
                );
                 $rowsCheckIdSuiviProjet =  mysql_fetch_array($arrayCheckIdSuiviProjet,MYSQL_ASSOC);
                 
                 
                 if($rowsCheckIdSuiviProjet['id_fta_suivi_projet']) {echo "[OK]$idFta \n";}else{echo "[FAILED] INSERT idFta: $idFta idFtaChapitre ".$rowsChapitre['id_fta_chapitre']."\n ";}
           
                if (!$rowsCheckIdSuiviProjet['id_fta_suivi_projet']) {
                    if ($rowsChapitre['id_fta_processus'] == 0) {
                         echo "INSERT INTO ".$nameOfBDDTarget."." . "fta_suivi_projet." . "id_fta .". $idFta ."id_fta_chapitre" . "=" . $rowsChapitre['id_fta_chapitre']." ...";
                         if(mysql_query(
                                "INSERT INTO ".$nameOfBDDTarget."." . "fta_suivi_projet"
                                . "(" . "id_fta"
                                . ", " . "id_fta_chapitre"
                                . ", " . "signature_validation_suivi_projet"
                                . ") VALUES (" . $idFta
                                . ", " . $rowsChapitre["id_fta_chapitre"]
                                . ", 1 )"
                        ))
                                  {echo "[OK] \n";}else{echo "[FAILED] $idFta,$rowsChapitre \n ";}
                    } else {
                        switch ($idFtaEtat) {
                            case '1':
                             $modif =  mysql_query(
                                        "INSERT INTO ".$nameOfBDDTarget."." . "fta_suivi_projet"
                                        . "(" . "id_fta"
                                        . ", " . "id_fta_chapitre"
                                         . ", " . "signature_validation_suivi_projet"
                                        . ") VALUES (" . $idFta
                                        . ", " . $rowsChapitre['id_fta_chapitre']
                                        . ", 0 )"
                                );
                            if($modif) {echo "[OK] \n";}else{echo "[FAILED] $idFta,$rowsChapitre \n ";}
                                break;
                            case '3':
                            case '5':
                            case '6':
                                 echo "INSERT INTO ".$nameOfBDDTarget."." . "fta_suivi_projet." . "id_fta .". $idFta ."id_fta_chapitre" . "=" . $rowsChapitre['id_fta_chapitre']." ...";
                                $valid= mysql_query(
                                        "INSERT INTO ".$nameOfBDDTarget."." . "fta_suivi_projet"
                                        . "(" . "id_fta"
                                        . ", " . "id_fta_chapitre"
                                        . ", " . "signature_validation_suivi_projet"
                                        . ") VALUES (" . $idFta
                                        . ", " . $rowsChapitre["id_fta_chapitre"]
                                        . ", " . "-3" . " )"                                        
                                );
                                 if($valid){echo "[OK] \n";}else{echo "[FAILED] $idFta,$rowsChapitre \n ";}
                                break;
                        }
                    }
                }
            }
            
        }
}
/**
 * Correction d'une erreur de traitment fulcutant de 2006 à 2015 
 * Certainnes Fta ont leur chapitre commun Palettisation non validé malgré que ces Fta soit Validé
 */


$sql = "SELECT distinct id_fta_suivi_projet, createur_fta
                    FROM  ".$nameOfBDDTarget.".fta_suivi_projet, ".$nameOfBDDTarget.".fta
                    WHERE signature_validation_suivi_projet NOT 
                    IN (
                    SELECT id_user
                    FROM ".$nameOfBDDTarget.".salaries
                    )
AND  fta_suivi_projet.id_fta=fta.id_fta AND id_fta_etat<>1 AND id_fta_etat<>6 
AND signature_validation_suivi_projet=0
AND (id_fta_chapitre=17 or id_fta_chapitre=16)
AND id_fta_etat=3";

$resultCorrrectionFtaSuiviProjet =mysql_query($sql);


if ($resultCorrrectionFtaSuiviProjet) {
    while ($rowsCorrrectionFtaSuiviProjet=mysql_fetch_array($resultCorrrectionFtaSuiviProjet)) {
                $idFtaSuiviProjet = $rowsCorrrectionFtaSuiviProjet['id_fta_suivi_projet'];
                $createur_fta = $rowsCorrrectionFtaSuiviProjet['createur_fta'];
                $sql_inter = "UPDATE ".$nameOfBDDTarget.".fta_suivi_projet
                    SET signature_validation_suivi_projet=".$createur_fta
                    . " WHERE id_fta_suivi_projet=" . $idFtaSuiviProjet;
        
           
 echo "UPDATE ".$nameOfBDDTarget."." . "fta_suivi_projet." . "id_fta_suivi_projet .". $idFtaSuiviProjet ."signature_validation_suivi_projet" . $createur_fta ." ...";
    if(mysql_query($sql_inter)) {echo "[OK]\n";}else{echo "[FAILED]\n $idFtaSuiviProjet \n";}
      
    }
} 

/**
 * On retire tous Fta Validé dont un chapitre autre que le commun Palletisation 
 */

$sql = "SELECT distinct fta.id_fta
                    FROM  ".$nameOfBDDTarget.".fta_suivi_projet, ".$nameOfBDDTarget.".fta
                    WHERE signature_validation_suivi_projet NOT 
                    IN (
                    SELECT id_user
                    FROM ".$nameOfBDDTarget.".salaries
                    )
AND  fta_suivi_projet.id_fta=fta.id_fta AND id_fta_etat<>1 AND id_fta_etat<>6 
AND signature_validation_suivi_projet=0
AND id_fta_chapitre<>17 
AND id_fta_etat=3";

$resultCorrrectionFtaSuiviProjet2 =mysql_query($sql);


if ($resultCorrrectionFtaSuiviProjet2) {
    while ($rowsCorrrectionFtaSuiviProjet2=mysql_fetch_array($resultCorrrectionFtaSuiviProjet2)) {
                $idFta = $rowsCorrrectionFtaSuiviProjet2['id_fta'];
                $sql_inter = "UPDATE ".$nameOfBDDTarget.".fta
                    SET id_fta_etat=6"
                    . " WHERE id_fta=" . $idFta;
        
           
 echo "UPDATE ".$nameOfBDDTarget."." . "fta." . "id_fta .". $idFta ."id_fta_etat" . "3" ." ...";
    if(mysql_query($sql_inter)) {echo "[OK]\n";}else{echo "[FAILED]\n $idFta \n";}
      
    }
} 


/**
 * Les Id des utilisateur supprimée sont remplacé par -1 (utilisateur supprimer) 
 * dans la table fta_suivi_projet
 * Etat :
 * Validé 3: retirer.
 * Modification 1: ne pas traité 
 * Archivé 5: ne pas traité
 * Retirer 6: ne pas traité 
 */      
             $sql = "SELECT id_fta_suivi_projet, signature_validation_suivi_projet, fta.id_fta
                    FROM ".$nameOfBDDTarget.".fta_suivi_projet, ".$nameOfBDDTarget.".fta
                    WHERE signature_validation_suivi_projet NOT 
                    IN (
                    SELECT id_user
                    FROM ".$nameOfBDDTarget.".salaries
                    )
                    AND fta_suivi_projet.id_fta = fta.id_fta
                    AND id_fta_etat <>1
                    AND id_fta_etat <>5
                    AND id_fta_etat <>6";
$resultChangeFtaSuviProjetIdUse =mysql_query($sql);

if ($resultChangeFtaSuviProjetIdUse) {
    while ($rowsChangeFtaSuviProjetIdUse=mysql_fetch_array($resultChangeFtaSuviProjetIdUse)) {
        $idFtaSuiviProjet = $rowsChangeFtaSuviProjetIdUse['id_fta_suivi_projet'];
        $sql_inter = "UPDATE ".$nameOfBDDTarget.".fta_suivi_projet
                 SET signature_validation_suivi_projet=-2"
                . " WHERE id_fta_suivi_projet=" . $idFtaSuiviProjet;
        
           
 echo "UPDATE ".$nameOfBDDTarget."." . "fta_suivi_projet." . "id_fta_suivi_projet .". $idFtaSuiviProjet ."signature_validation_suivi_projet" . "=-2" ." ...";
    if(mysql_query($sql_inter)) {echo "[OK]\n";}else{echo "[FAILED]\n $idFtaSuiviProjet \n";}
      
    }
} 
}
/**
 * Attribution des droits accès aux utilisateur
 */
echo "DROP ".$nameOfBDDTarget.".intranet_droits_acces ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".intranet_droits_acces";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".intranet_droits_acces ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".intranet_droits_acces LIKE ".$nameOfBDDStructure.".intranet_droits_acces";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".intranet_droits_acces ...";
$sql = " INSERT INTO ".$nameOfBDDTarget.".intranet_droits_acces SELECT ".$nameOfBDDOrigin.".intranet_droits_acces.*
                FROM ".$nameOfBDDOrigin.".intranet_droits_acces,".$nameOfBDDTarget.".salaries,".$nameOfBDDTarget.".intranet_modules,".$nameOfBDDTarget.".intranet_actions 
                WHERE ".$nameOfBDDOrigin.".intranet_droits_acces.id_user=".$nameOfBDDTarget.".salaries.id_user 
                AND ".$nameOfBDDOrigin.".intranet_droits_acces.id_intranet_modules=".$nameOfBDDTarget.".intranet_modules.id_intranet_modules 
                AND ".$nameOfBDDOrigin.".intranet_droits_acces.id_intranet_actions=".$nameOfBDDTarget.".intranet_actions.id_intranet_actions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "ALTER TABLE ".$nameOfBDDTarget.".intranet_droits_acces ...";
$sql = "ALTER TABLE ".$nameOfBDDTarget.".intranet_droits_acces "
        . " ADD id_intranet_droits_acces INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";

if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}


/**
 * Liste des signataire de Fta valide pour les Workflow, les Site et les Rôles 
 */
$sql = "SELECT DISTINCT fta.id_fta,id_fta_chapitre,signature_validation_suivi_projet
        FROM ".$nameOfBDDTarget.".fta, ".$nameOfBDDTarget.".fta_suivi_projet
        WHERE id_fta_etat =3
        AND fta_suivi_projet.id_fta = fta.id_fta";
$resultListeUserValideFta =mysql_query($sql);

if ($resultListeUserValideFta) {
    while ($rowsListeUserValideFta=mysql_fetch_array($resultListeUserValideFta)) {
        $idUser = $rowsListeUserValideFta['signature_validation_suivi_projet'];
        $idFtaChapitre = $rowsListeUserValideFta['id_fta_chapitre'];
        $idFta = $rowsListeUserValideFta['id_fta'];
        $sql_CheckWorkflow = "SELECT id_intranet_actions
                    FROM ".$nameOfBDDTarget.".fta,".$nameOfBDDTarget.".fta_workflow
                    WHERE fta.id_fta_workflow=fta_workflow.id_fta_workflow
                    AND fta.id_fta=".$idFta;
        
        $resultCheckIdIntranetActionsWorkflow =mysql_query($sql_CheckWorkflow);

       if ($resultCheckIdIntranetActionsWorkflow) { 
           while ($rowsCheckIdIntranetActionsWorkflow=mysql_fetch_array($resultCheckIdIntranetActionsWorkflow)) {
           $arrayCheckIdIntranetDroitsAcces = mysql_query(
                                "SELECT id_intranet_droits_acces" 
                                . " FROM ".$nameOfBDDTarget.".intranet_droits_acces" 
                                . " WHERE id_user" 
                                . "=" . $idUser
                                . " AND id_intranet_modules=19" 
                                . " AND id_intranet_actions" 
                                . "=" . $rowsCheckIdIntranetActionsWorkflow["id_intranet_actions"]                      
                );
                 $rowsCheckIdIntranetDroitsAcces =  mysql_fetch_array($arrayCheckIdIntranetDroitsAcces,MYSQL_ASSOC);
                 
                 
                 if($rowsCheckIdIntranetDroitsAcces['id_intranet_droits_acces']) {echo "[OK]$idFta \n";}else{echo "[FAILED] INSERT idFta: $idFta Workflow \n ";}
           
                if (!$rowsCheckIdIntranetDroitsAcces['id_intranet_droits_acces']) {
                      echo "INSERT INTO ".$nameOfBDDTarget."." . "intranet_droits_acces." . "id_user .". $idUser ." ...";
                         if(mysql_query(
                                "INSERT INTO ".$nameOfBDDTarget."." . "intranet_droits_acces"
                                . "(" . "id_intranet_modules"
                                . ", " . "id_user"
                                . ", " . "id_intranet_actions"
                                . ", " . "niveau_intranet_droits_acces"
                                . ") VALUES (19" 
                                . ", " . $idUser
                                . ", " . $rowsCheckIdIntranetActionsWorkflow["id_intranet_actions"] 
                                . ", 1 )"
                        ))
                                  {echo "[OK] \n";}else{echo "[FAILED] $idUser,".$rowsCheckIdIntranetActionsWorkflow['id_intranet_actions'] ." \n ";}
                }
           }
           
       }  
        $sql_CheckSite = "SELECT id_intranet_actions
                    FROM ".$nameOfBDDTarget.".fta,".$nameOfBDDTarget.".fta_action_site
                    WHERE fta.id_fta_workflow=fta_action_site.id_fta_workflow
                    AND fta.id_fta=".$idFta." 
                    AND fta_action_site.id_site=fta.Site_de_production";
        
        $resultCheckIdIntranetActionsSite =mysql_query($sql_CheckSite);

       if ($resultCheckIdIntranetActionsSite) { 
           while ($rowsCheckIdIntranetActionsSite=mysql_fetch_array($resultCheckIdIntranetActionsSite)) {
               $sql =  "SELECT id_intranet_droits_acces" 
                                . " FROM ".$nameOfBDDTarget.".intranet_droits_acces" 
                                . " WHERE id_user=" . $idUser
                                . " AND id_intranet_modules=19" 
                                . " AND id_intranet_actions=" . $rowsCheckIdIntranetActionsSite["id_intranet_actions"];
           $arrayCheckIdDroitsAccesSite = mysql_query($sql);
                 $rowsCheckIdDroitsAccesSite =  mysql_fetch_array($arrayCheckIdDroitsAccesSite,MYSQL_ASSOC);
                 
                 
                 if($rowsCheckIdDroitsAccesSite['id_intranet_droits_acces']) {echo "[OK]$idFta  \n";}else{echo "[FAILED] INSERT id_user: $idUser id_intranet_actions ".$rowsCheckIdIntranetActionsSite['id_intranet_actions']."\n ";}
           
                if (!$rowsCheckIdDroitsAccesSite['id_intranet_droits_acces']) {
                      echo "INSERT INTO ".$nameOfBDDTarget."." . "intranet_droits_acces." . "id_user .". $idUser ." ...";
                         if(mysql_query(
                                "INSERT INTO ".$nameOfBDDTarget."." . "intranet_droits_acces"
                                . "(" . "id_intranet_modules"
                                . ", " . "id_user"
                                . ", " . "id_intranet_actions"
                                . ", " . "niveau_intranet_droits_acces"
                                . ") VALUES (19" 
                                . ", " . $idUser
                                . ", " . $rowsCheckIdIntranetActionsSite["id_intranet_actions"] 
                                . ", 1 )"
                        ))
                                  {echo "[OK] \n";}else{echo "[FAILED] $idUser,".$rowsCheckIdIntranetActionsSite['id_intranet_actions'] ." \n ";}
                }
           }
       }
        $sql_CheckRole = "SELECT id_intranet_actions
                    FROM ".$nameOfBDDTarget.".fta,".$nameOfBDDTarget.".fta_workflow_structure,".$nameOfBDDTarget.".fta_action_role
                    WHERE fta.id_fta_workflow=fta_workflow_structure.id_fta_workflow
                    AND fta_action_role.id_fta_workflow=fta_workflow_structure.id_fta_workflow
                    AND fta.id_fta=".$idFta." AND fta_workflow_structure.id_fta_chapitre=".$idFtaChapitre."
                    AND fta_action_role.id_fta_role=fta_workflow_structure.id_fta_role";
        
        $resultCheckIdIntranetActions =mysql_query($sql_CheckRole);

       if ($resultCheckIdIntranetActions) { 
           while ($rowsCheckIdIntranetActions=mysql_fetch_array($resultCheckIdIntranetActions)) {
           $arrayCheckIdSuiviProjet = mysql_query(
                                "SELECT id_intranet_droits_acces" 
                                . " FROM ".$nameOfBDDTarget.".intranet_droits_acces" 
                                . " WHERE id_user" 
                                . "=" . $idUser
                                . " AND id_intranet_modules=19" 
                                . " AND id_intranet_actions" 
                                . "=" . $rowsCheckIdIntranetActions["id_intranet_actions"]                      
                );
                 $rowsCheckIdSuiviProjet =  mysql_fetch_array($arrayCheckIdSuiviProjet,MYSQL_ASSOC);
                 
                 
                 if($rowsCheckIdSuiviProjet['id_intranet_droits_acces']) {echo "[OK]$idFta \n";}else{echo "[FAILED] INSERT id_user: $idUser id_intranet_actions ".$rowsCheckIdIntranetActionsSite['id_intranet_actions']."\n ";}
           
                if (!$rowsCheckIdSuiviProjet['id_intranet_droits_acces']) {
                      echo "INSERT INTO ".$nameOfBDDTarget."." . "intranet_droits_acces." . "id_user .". $idUser ." ...";
                         if(mysql_query(
                                "INSERT INTO ".$nameOfBDDTarget."." . "intranet_droits_acces"
                                . "(" . "id_intranet_modules"
                                . ", " . "id_user"
                                . ", " . "id_intranet_actions"
                                . ", " . "niveau_intranet_droits_acces"
                                . ") VALUES (19" 
                                . ", " . $idUser
                                . ", " . $rowsCheckIdIntranetActions["id_intranet_actions"] 
                                . ", 1 )"
                        ))
                                  {echo "[OK] \n";}else{echo "[FAILED] $idUser,".$rowsCheckIdIntranetActions['id_intranet_actions'] ." \n ";}
                }
           }
       }
     
    }
} 



/**
 * Composition
 */
echo "DROP ".$nameOfBDDTarget.".fta_composant ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_composant";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_composant ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_composant LIKE  ".$nameOfBDDStructure.".fta_composant;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_composant ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_composant SELECT ".$nameOfBDDOrigin.".fta_composant.* FROM ".$nameOfBDDOrigin.".fta_composant,".$nameOfBDDTarget.".fta "
        . " WHERE ".$nameOfBDDOrigin.".fta_composant.id_fta=".$nameOfBDDTarget.".fta.id_fta";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}


$arrayFtaCompositionParagraphe = mysql_query(
                "SELECT id_fta_composant
FROM  ".$nameOfBDDTarget.".fta_composant
WHERE  k_style_paragraphe_ingredient_fta_composition =0 "
);
if ($arrayFtaCompositionParagraphe) {
    while  ($rowsFtaCompositionParagraphe = mysql_fetch_array($arrayFtaCompositionParagraphe)) {
        $idFtaComposant = $rowsFtaCompositionParagraphe['id_fta_composant'];


        $sql_inter = "UPDATE ".$nameOfBDDTarget."." . 'fta_composant'
                . " SET " . 'k_style_paragraphe_ingredient_fta_composition'. "=4"
                . " WHERE " . 'id_fta_composant' . "=" . $idFtaComposant;  
        echo "UPDATE ".$nameOfBDDTarget."." . "fta_composant." . "k_style_paragraphe_ingredient_fta_composition id_fta_composant" . "=" . $idFtaComposant." ...";
      if(mysql_query($sql_inter)) {	echo "[OK]\n";}else{echo "[FAILED] $idFtaComposant \n";}
        
    }
}
$arrayFtaCompositionEtiquette = mysql_query(
                "SELECT DISTINCT id_fta_composant, k_etiquette_fta_composition
FROM ".$nameOfBDDTarget.".fta_composant
WHERE k_etiquette_fta_composition NOT 
IN (

SELECT k_etiquette
FROM ".$nameOfBDDOrigin.".codesoft_etiquettes
)"
);
if ($arrayFtaCompositionEtiquette) {
    while ($rowsFtaCompositionEtiquette = mysql_fetch_array($arrayFtaCompositionEtiquette)) {
        $idFtaComposant = $rowsFtaCompositionEtiquette['id_fta_composant'];


        $sql_inter = "UPDATE ".$nameOfBDDTarget."." . "fta_composant"
                . " SET " . "k_etiquette_fta_composition" . "=-1"
                . " WHERE " . "id_fta_composant" . "=" . $idFtaComposant;
        echo "UPDATE ".$nameOfBDDTarget."." . "fta_composant." . "k_etiquette_fta_composition id_fta_composant" . "=" . $idFtaComposant." ...";
        if(mysql_query($sql_inter)) {	echo "[OK]\n";}else{echo "[FAILED] $idFtaComposant \n";}
    }
}
$arrayFtaCompositionEtiquette2 = mysql_query(
                "SELECT DISTINCT id_fta_composant, k_etiquette_verso_fta_composition
FROM ".$nameOfBDDTarget.".fta_composant
WHERE k_etiquette_verso_fta_composition NOT 
IN (

SELECT k_etiquette
FROM ".$nameOfBDDOrigin.".codesoft_etiquettes
)"
);
if ($arrayFtaCompositionEtiquette2) {
    while ($rowsFtaCompositionEtiquette2 = mysql_fetch_array($arrayFtaCompositionEtiquette2)) {
        $idFtaComposant = $rowsFtaCompositionEtiquette2['id_fta_composant'];


        $sql_inter = "UPDATE ".$nameOfBDDTarget."." . "fta_composant"
                . " SET " . "k_etiquette_fta_composition" . "=-1"
                . " WHERE " . "id_fta_composant" . "=" . $idFtaComposant;
        echo "UPDATE ".$nameOfBDDTarget."." . "fta_composant." . "k_etiquette_fta_composition id_fta_composant" . "=" . $idFtaComposant." ...";
        if(mysql_query($sql_inter)) {	echo "[OK]\n";}else{echo "[FAILED] $idFtaComposant \n";}
    }
}


/**
 * Seconde partie composition
 */
$arrayFtaCompositionIdGeo = mysql_query(
                "SELECT id_fta_composant, Site_de_production
FROM ".$nameOfBDDTarget.".fta_composant, ".$nameOfBDDTarget.".fta
WHERE id_fta_composant NOT 
IN (

SELECT id_fta_composant
FROM  ".$nameOfBDDTarget.".fta_composant , ".$nameOfBDDTarget.".geo
WHERE fta_composant.id_geo = geo.id_geo
)
AND fta.id_fta = fta_composant.id_fta
AND Site_de_production IS NOT NULL "
);
if ($arrayFtaCompositionIdGeo) {
    while ($rowsFtaCompositionIdGeo= mysql_fetch_array($arrayFtaCompositionIdGeo)) {
        $idFtaComposant = $rowsFtaCompositionIdGeo['id_fta_composant'];
        $idGeo = $rowsFtaCompositionIdGeo["Site_de_production"];


        $sql_inter = "UPDATE ".$nameOfBDDTarget."." . 'fta_composant'
                . " SET " . 'id_geo' . "=" . $idGeo
                . " WHERE " .'id_fta_composant' . "=" . $idFtaComposant;
       echo "UPDATE ".$nameOfBDDTarget."." . "fta_composant." . 'id_geo' . "=" . $idGeo. " id_fta_composant" . "=" . $idFtaComposant." ...";
       if(mysql_query($sql_inter)) {	echo "[OK]\n";}else{echo "[FAILED] $idFtaComposant \n";}
    }
}


$arrayFtaComposantEti =  mysql_query(
                "SELECT id_fta_composant
FROM ".$nameOfBDDTarget.".fta_composant
WHERE mode_etiquette_fta_composition=0 AND (k_etiquette_verso_fta_composition<>0 OR k_etiquette_fta_composition<>0)"
);
if ($arrayFtaComposantEti) {
    while ($rowsFtaComposantEti= mysql_fetch_array($arrayFtaComposantEti)) {
        $idFtaComposant = $rowsFtaComposantEti['id_fta_composant'];
        $sql_inter = "UPDATE ".$nameOfBDDTarget."." . 'fta_composant'
                . " SET " . 'k_etiquette_verso_fta_composition' . "=-1 , k_etiquette_verso_fta_composition=-1" 
                . " WHERE " .'id_fta_composant' . "=" . $idFtaComposant;
       echo "UPDATE ".$nameOfBDDTarget."." . "fta_composant." . 'k_etiquette_verso_fta_composition' . "=" . "0" . " id_fta_composant" . "=" . $idFtaComposant." ...";
       if(mysql_query($sql_inter)) {	echo "[OK]\n";}else{echo "[FAILED] $idFtaComposant \n";}
    }
}


/**
 * Extraction  annexe emballage
 */
echo "DROP ".$nameOfBDDTarget.".annexe_emballage_groupe_type ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_emballage_groupe_type";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_emballage_groupe_type ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_emballage_groupe_type LIKE  ".$nameOfBDDStructure.".annexe_emballage_groupe_type;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_emballage_groupe_type ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_emballage_groupe_type SELECT * FROM ".$nameOfBDDOrigin.".annexe_emballage_groupe_type;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".annexe_emballage_groupe ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_emballage_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_emballage_groupe ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_emballage_groupe LIKE  ".$nameOfBDDStructure.".annexe_emballage_groupe;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_emballage_groupe ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_emballage_groupe SELECT * FROM ".$nameOfBDDOrigin.".annexe_emballage_groupe;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_emballage_groupe Emballage supprimé ...";
$sql = "INSERT INTO `".$nameOfBDDTarget."`.`annexe_emballage` "
        . "(`id_annexe_emballage_groupe`, `nom_annexe_emballage_groupe`"
        . ", `id_annexe_emballage_groupe_configuration`, `poids_variable_fta_emballage_groupe`) "
        . "VALUES ('-1', 'Emballage supprimé',NULL,NULL); ";       
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP ".$nameOfBDDTarget.".annexe_emballage ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".annexe_emballage";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".annexe_emballage ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".annexe_emballage LIKE  ".$nameOfBDDStructure.".annexe_emballage;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".annexe_emballage ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".annexe_emballage SELECT ".$nameOfBDDOrigin.".annexe_emballage.* FROM ".$nameOfBDDOrigin.".annexe_emballage,".$nameOfBDDTarget.".fte_fournisseur,".$nameOfBDDTarget.".annexe_emballage_groupe"
        . " WHERE ".$nameOfBDDOrigin.".annexe_emballage.id_fte_fournisseur=".$nameOfBDDTarget.".fte_fournisseur.id_fte_fournisseur"
        . " AND ".$nameOfBDDOrigin.".annexe_emballage.id_annexe_emballage_groupe=".$nameOfBDDTarget.".annexe_emballage_groupe.id_annexe_emballage_groupe;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}


echo "INSERT INTO ".$nameOfBDDTarget.".annexe_emballage Emballage supprimé ...";
$sql = "INSERT INTO `".$nameOfBDDTarget."`.`annexe_emballage` "
        . "(`id_annexe_emballage`, `id_fte_fournisseur`,`reference_fournisseur_annexe_emballage`) "
        . "VALUES ('-1','-1','Emballage supprimé'); ";       
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}



/**
 * Seconde partie composition
 */
$arrayFtaConditionnement = mysql_query(
                "SELECT DISTINCT id_fta_conditionnement
FROM ".$nameOfBDDTarget."fta_conditionnement
WHERE fta_conditionnement.id_annexe_emballage NOT 
IN (

SELECT annexe_emballage.id_annexe_emballage
FROM ".$nameOfBDDTarget."fta_conditionnement, ".$nameOfBDDTarget."annexe_emballage
WHERE annexe_emballage.id_annexe_emballage = fta_conditionnement.id_annexe_emballage
)");
if ($arrayFtaConditionnement) {
    while ($rowsFtaConditionnement= mysql_fetch_array($arrayFtaConditionnement)) {
        $id_fta_conditionnement = $rowsFtaConditionnement['id_fta_conditionnement'];


        $sql_inter = "UPDATE ".$nameOfBDDTarget."." . 'fta_conditionnement'
                . " SET " . 'id_annexe_emballage' . "=-1" 
                . " WHERE " .'id_fta_conditionnement' . "=" . $id_fta_conditionnement;
       echo "UPDATE ".$nameOfBDDTarget."." . "fta_conditionnement." . 'id_annexe_emballage' . "=-1 id_fta_conditionnement" . "=" . $id_fta_conditionnement." ...";
       if(mysql_query($sql_inter)) {	echo "[OK]\n";}else{echo "[FAILED] $idFtaComposant \n";}
    }
}
/**
 * Extrationc fta_conditionnement 
 */

echo "DROP ".$nameOfBDDTarget.".fta_conditionnement ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".fta_conditionnement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".fta_conditionnement ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".fta_conditionnement LIKE  ".$nameOfBDDStructure.".fta_conditionnement;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_conditionnement ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".fta_conditionnement SELECT ".$nameOfBDDOrigin.".fta_conditionnement.* FROM ".$nameOfBDDOrigin.".fta_conditionnement,".$nameOfBDDTarget.".fta,".$nameOfBDDTarget.".annexe_emballage"
        . " WHERE ".$nameOfBDDOrigin.".fta_conditionnement.id_fta=".$nameOfBDDTarget.".fta.id_fta"
        . " AND ".$nameOfBDDOrigin.".fta_conditionnement.id_annexe_emballage=".$nameOfBDDTarget.".annexe_emballage.id_annexe_emballage;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}



/**
 * Insertion  de la nouvelle classification
 */
    echo "DROP ".$nameOfBDDTarget.".classification_fta ...";
$sql = "DROP TABLE ".$nameOfBDDTarget.".classification_fta";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE ".$nameOfBDDTarget.".classification_fta ...";
$sql = "CREATE TABLE ".$nameOfBDDTarget.".classification_fta LIKE  ".$nameOfBDDStructure.".classification_fta;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO ".$nameOfBDDTarget.".fta_conditionnement ...";
$sql = "INSERT INTO ".$nameOfBDDTarget.".classification_fta SELECT ".$nameOfBDDOrigin.".classification_fta . * 
            FROM ".$nameOfBDDOrigin.".classification_fta, ".$nameOfBDDTarget.".fta
            WHERE ".$nameOfBDDOrigin.".classification_fta.id_fta = ".$nameOfBDDTarget.".fta.id_fta;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo"Debut :". $debut ." Fin :" .date("H:i:s")." Temps complet part 1 :". $debut-date("H:i:s") ."\n";


?>