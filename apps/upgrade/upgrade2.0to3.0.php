<?php
/* * *******
  Inclusions
 * ******* */
require_once './inculde2.0to3.0.php';

/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
*/

$hostname_connect = "dev-intranet.agis.fr"; //nom du serveur MySQL de connection � la base de donn�e
$database_connect = "intranet_v3_0_dev"; //nom de la base de donn�e sur votre serveur MySQL
$username_connect = "root"; //login de la base MySQL
$password_connect = "8ale!ne"; //mot de passe de la base MySQL

$donnee = mysql_pconnect($hostname_connect, $username_connect, $password_connect);
mysql_select_db($database_connect);
mysql_query('SET NAMES utf8');


/**
 * Création de la base de données
 */
echo "*** Requêtes SQL:\n";


//ini_set('memory_limit', '-1'); 
//{
//    DatabaseOperation::execute(
//            "DROP DATABASE intranet_v3_0_dev;"
//    );
//
//    DatabaseOperation::execute(
//            "CREATE DATABASE intranet_v3_0_dev CHARACTER SET utf8 COLLATE utf8_general_ci;"
//    );
//}
//
///* * *
// * Recuperations des données de la V2 avec la structure de la V3
// */ {
//

echo  date("H:i:s")."\n";

/**
Tables basiques
**/

if(FALSE){

echo "DROP intranet_v3_0_dev.classification_arborescence_article ...";
$sql = "DROP TABLE intranet_v3_0_dev.classification_arborescence_article";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.classification_arborescence_article ...";
$sql = "CREATE TABLE intranet_v3_0_dev.classification_arborescence_article LIKE intranet_v3_0_cod.classification_arborescence_article";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.classification_arborescence_article ...";
$sql = "INSERT INTO intranet_v3_0_dev.classification_arborescence_article SELECT * FROM intranet_v2_0_prod.classification_arborescence_article";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.classification_arborescence_article_categorie ...";
$sql = "DROP TABLE intranet_v3_0_dev.classification_arborescence_article_categorie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.classification_arborescence_article_categorie ...";
$sql = "CREATE TABLE intranet_v3_0_dev.classification_arborescence_article_categorie LIKE intranet_v3_0_cod.classification_arborescence_article_categorie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.classification_arborescence_article ...";
$sql = "INSERT INTO intranet_v3_0_dev.classification_arborescence_article_categorie SELECT * FROM intranet_v2_0_prod.classification_arborescence_article_categorie";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.classification_arborescence_article_categorie_contenu ...";
$sql = "DROP TABLE intranet_v3_0_dev.classification_arborescence_article_categorie_contenu";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.classification_arborescence_article_categorie_contenu ...";
$sql = "CREATE TABLE intranet_v3_0_dev.classification_arborescence_article_categorie_contenu LIKE intranet_v3_0_cod.classification_arborescence_article_categorie_contenu";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.classification_arborescence_article ...";
$sql = "INSERT INTO intranet_v3_0_dev.classification_arborescence_article_categorie_contenu SELECT * FROM intranet_v2_0_prod.classification_arborescence_article_categorie_contenu";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fte_fournisseur ...";
$sql = "DROP TABLE intranet_v3_0_dev.fte_fournisseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fte_fournisseur ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fte_fournisseur LIKE intranet_v3_0_cod.fte_fournisseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fte_fournisseur ...";
$sql = "INSERT INTO intranet_v3_0_dev.fte_fournisseur SELECT * FROM intranet_v2_0_prod.fte_fournisseur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.geo ...";
$sql = "DROP TABLE intranet_v3_0_dev.geo";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.geo ...";
$sql = "CREATE TABLE intranet_v3_0_dev.geo LIKE intranet_v3_0_cod.geo";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.geo ...";
$sql = "INSERT INTO intranet_v3_0_dev.geo SELECT * FROM intranet_v2_0_prod.geo";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.geo_codesoft ...";
$sql = "DROP TABLE intranet_v3_0_dev.geo_codesoft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.geo_codesoft ...";
$sql = "CREATE TABLE intranet_v3_0_dev.geo_codesoft LIKE intranet_v3_0_cod.geo_codesoft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.geo_codesoft ...";
$sql = "INSERT INTO intranet_v3_0_dev.geo_codesoft SELECT * FROM intranet_v2_0_prod.geo_codesoft";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.groupes ...";
$sql = "DROP TABLE intranet_v3_0_dev.groupes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.groupes ...";
$sql = "CREATE TABLE intranet_v3_0_dev.groupes LIKE intranet_v3_0_cod.groupes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.groupes ...";
$sql = "INSERT INTO intranet_v3_0_dev.groupes SELECT * FROM intranet_v2_0_prod.groupes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.planning_presence_semaine_visible ...";
$sql = "DROP TABLE intranet_v3_0_dev.planning_presence_semaine_visible";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.planning_presence_semaine_visible ...";
$sql = "CREATE TABLE intranet_v3_0_dev.planning_presence_semaine_visible LIKE intranet_v3_0_cod.planning_presence_semaine_visible";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.planning_presence_semaine_visible ...";
$sql = "INSERT INTO intranet_v3_0_dev.planning_presence_semaine_visible SELECT * FROM intranet_v2_0_prod.planning_presence_semaine_visible";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.annexe_agrologic_article_codification ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_agrologic_article_codification";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_agrologic_article_codification ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_agrologic_article_codification LIKE intranet_v3_0_cod.annexe_agrologic_article_codification";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.annexe_agrologic_article_codification ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_agrologic_article_codification SELECT * FROM intranet_v2_0_prod.annexe_agrologic_article_codification";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.annexe_jours_semaine ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_jours_semaine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_jours_semaine ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_jours_semaine LIKE intranet_v3_0_cod.annexe_jours_semaine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.annexe_jours_semaine ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_jours_semaine SELECT * FROM intranet_v2_0_prod.annexe_jours_semaine";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.annexe_allergene ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_allergene";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_allergene ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_allergene LIKE intranet_v3_0_cod.annexe_allergene";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.annexe_allergene ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_allergene SELECT * FROM intranet_v2_0_prod.annexe_allergene";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.annexe_additif ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_additif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_additif ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_additif LIKE intranet_v3_0_cod.annexe_additif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.annexe_additif ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_additif SELECT * FROM intranet_v2_0_prod.annexe_additif";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_service ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_service";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_service ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_service LIKE intranet_v3_0_cod.access_materiel_service";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_service ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_service SELECT * FROM intranet_v2_0_prod.access_materiel_service";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.annexe_additif_groupe ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_additif_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_additif_groupe ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_additif_groupe LIKE intranet_v3_0_cod.annexe_additif_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_service ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_additif_groupe SELECT * FROM intranet_v2_0_prod.annexe_additif_groupe";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.annexe_allergene_famille ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_allergene_famille";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_allergene_famille ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_allergene_famille LIKE intranet_v3_0_cod.annexe_allergene_famille";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.annexe_allergene_famille ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_allergene_famille SELECT * FROM intranet_v2_0_prod.annexe_allergene_famille";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.annexe_allergene_origine ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_allergene_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_allergene_origine ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_allergene_origine LIKE intranet_v3_0_cod.annexe_allergene_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.annexe_allergene_origine ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_allergene_origine SELECT * FROM intranet_v2_0_prod.annexe_allergene_origine";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.annexe_arome_categorie ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_arome_categorie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_arome_categorie ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_arome_categorie LIKE intranet_v3_0_cod.annexe_arome_categorie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.annexe_arome_categorie ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_arome_categorie SELECT * FROM intranet_v2_0_prod.annexe_arome_categorie";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.annexe_caracteristique_scientifique ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_caracteristique_scientifique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_caracteristique_scientifique ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_caracteristique_scientifique LIKE intranet_v3_0_cod.annexe_caracteristique_scientifique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.annexe_caracteristique_scientifique ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_caracteristique_scientifique SELECT * FROM intranet_v2_0_prod.annexe_caracteristique_scientifique";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.annexe_caracteristique_scientifique_groupe ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_caracteristique_scientifique_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_caracteristique_scientifique_groupe ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_caracteristique_scientifique_groupe LIKE intranet_v3_0_cod.annexe_caracteristique_scientifique_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.annexe_caracteristique_scientifique_groupe ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_caracteristique_scientifique_groupe SELECT * FROM intranet_v2_0_prod.annexe_caracteristique_scientifique_groupe";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.annexe_environnement_conservation ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_environnement_conservation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_environnement_conservation ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_environnement_conservation LIKE intranet_v3_0_cod.annexe_environnement_conservation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.annexe_environnement_conservation ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_environnement_conservation SELECT * FROM intranet_v2_0_prod.annexe_environnement_conservation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.annexe_environnement_conservation_groupe ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_environnement_conservation_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_environnement_conservation_groupe ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_environnement_conservation_groupe LIKE intranet_v3_0_cod.annexe_environnement_conservation_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.annexe_environnement_conservation_groupe ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_environnement_conservation_groupe SELECT * FROM intranet_v2_0_prod.annexe_environnement_conservation_groupe";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.annexe_pays ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_pays";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_pays ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_pays LIKE intranet_v3_0_cod.annexe_pays";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.annexe_pays ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_pays SELECT * FROM intranet_v2_0_prod.annexe_pays";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.annexe_unite ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_unite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_unite ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_unite LIKE intranet_v3_0_cod.annexe_unite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.annexe_unite ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_unite SELECT * FROM intranet_v2_0_prod.annexe_unite";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.archcomment ...";
$sql = "DROP TABLE intranet_v3_0_dev.archcomment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.archcomment ...";
$sql = "CREATE TABLE intranet_v3_0_dev.archcomment LIKE intranet_v3_0_cod.archcomment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.archcomment ...";
$sql = "INSERT INTO intranet_v3_0_dev.archcomment SELECT * FROM intranet_v2_0_prod.archcomment";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.archlu ...";
$sql = "DROP TABLE intranet_v3_0_dev.archlu";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.archlu ...";
$sql = "CREATE TABLE intranet_v3_0_dev.archlu LIKE intranet_v3_0_cod.archlu";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.archlu ...";
$sql = "INSERT INTO intranet_v3_0_dev.archlu SELECT * FROM intranet_v2_0_prod.archlu";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.articlece ...";
$sql = "DROP TABLE intranet_v3_0_dev.articlece";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.articlece ...";
$sql = "CREATE TABLE intranet_v3_0_dev.articlece LIKE intranet_v3_0_cod.articlece";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.articlece ...";
$sql = "INSERT INTO intranet_v3_0_dev.articlece SELECT * FROM intranet_v2_0_prod.articlece";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.articles ...";
$sql = "DROP TABLE intranet_v3_0_dev.articles";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.articles ...";
$sql = "CREATE TABLE intranet_v3_0_dev.articles LIKE intranet_v3_0_cod.articles";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.articles ...";
$sql = "INSERT INTO intranet_v3_0_dev.articles SELECT * FROM intranet_v2_0_prod.articles";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.artstat ...";
$sql = "DROP TABLE intranet_v3_0_dev.artstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.artstat ...";
$sql = "CREATE TABLE intranet_v3_0_dev.artstat LIKE intranet_v3_0_cod.artstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.artstat ...";
$sql = "INSERT INTO intranet_v3_0_dev.artstat SELECT * FROM intranet_v2_0_prod.artstat";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.catsopro ...";
$sql = "DROP TABLE intranet_v3_0_dev.catsopro";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.catsopro ...";
$sql = "CREATE TABLE intranet_v3_0_dev.catsopro LIKE intranet_v3_0_cod.catsopro";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.catsopro ...";
$sql = "INSERT INTO intranet_v3_0_dev.catsopro SELECT * FROM intranet_v2_0_prod.catsopro";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.classification_arborescence_client ...";
$sql = "DROP TABLE intranet_v3_0_dev.classification_arborescence_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.classification_arborescence_client ...";
$sql = "CREATE TABLE intranet_v3_0_dev.classification_arborescence_client LIKE intranet_v3_0_cod.classification_arborescence_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.classification_arborescence_client ...";
$sql = "INSERT INTO intranet_v3_0_dev.classification_arborescence_client SELECT * FROM intranet_v2_0_prod.classification_arborescence_client";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.classification_arborescence_client_groupe ...";
$sql = "DROP TABLE intranet_v3_0_dev.classification_arborescence_client_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.classification_arborescence_client_groupe ...";
$sql = "CREATE TABLE intranet_v3_0_dev.classification_arborescence_client_groupe LIKE intranet_v3_0_cod.classification_arborescence_client_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.classification_arborescence_client_groupe ...";
$sql = "INSERT INTO intranet_v3_0_dev.classification_arborescence_client_groupe SELECT * FROM intranet_v2_0_prod.classification_arborescence_client_groupe";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.classification_article ...";
$sql = "DROP TABLE intranet_v3_0_dev.classification_article";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.classification_article ...";
$sql = "CREATE TABLE intranet_v3_0_dev.classification_article LIKE intranet_v3_0_cod.classification_article";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.classification_article ...";
$sql = "INSERT INTO intranet_v3_0_dev.classification_article SELECT * FROM intranet_v2_0_prod.classification_article";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.classification_article_rayon ...";
$sql = "DROP TABLE intranet_v3_0_dev.classification_article_rayon";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.classification_article_rayon ...";
$sql = "CREATE TABLE intranet_v3_0_dev.classification_article_rayon LIKE intranet_v3_0_cod.classification_article_rayon";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.classification_article_rayon ...";
$sql = "INSERT INTO intranet_v3_0_dev.classification_article_rayon SELECT * FROM intranet_v2_0_prod.classification_article_rayon";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.codesoft_etiquettes ...";
$sql = "DROP TABLE intranet_v3_0_dev.codesoft_etiquettes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.codesoft_etiquettes ...";
$sql = "CREATE TABLE intranet_v3_0_dev.codesoft_etiquettes LIKE intranet_v2_0_prod.codesoft_etiquettes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.codesoft_etiquettes ...";
$sql = "INSERT INTO intranet_v3_0_dev.codesoft_etiquettes SELECT * FROM intranet_v2_0_prod.codesoft_etiquettes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.codesoft_etiquettes_logo ...";
$sql = "DROP TABLE intranet_v3_0_dev.codesoft_etiquettes_logo";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.codesoft_etiquettes_logo ...";
$sql = "CREATE TABLE intranet_v3_0_dev.codesoft_etiquettes_logo LIKE intranet_v3_0_cod.codesoft_etiquettes_logo";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.codesoft_etiquettes_logo ...";
$sql = "INSERT INTO intranet_v3_0_dev.codesoft_etiquettes_logo SELECT * FROM intranet_v2_0_prod.codesoft_etiquettes_logo";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.codesoft_historique_satel ...";
$sql = "DROP TABLE intranet_v3_0_dev.codesoft_historique_satel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.codesoft_historique_satel ...";
$sql = "CREATE TABLE intranet_v3_0_dev.codesoft_historique_satel LIKE intranet_v3_0_cod.codesoft_historique_satel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.codesoft_historique_satel ...";
$sql = "INSERT INTO intranet_v3_0_dev.codesoft_historique_satel SELECT * FROM intranet_v2_0_prod.codesoft_historique_satel";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.codesoft_imprimante ...";
$sql = "DROP TABLE intranet_v3_0_dev.codesoft_imprimante";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.codesoft_imprimante ...";
$sql = "CREATE TABLE intranet_v3_0_dev.codesoft_imprimante LIKE intranet_v3_0_cod.codesoft_imprimante";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.codesoft_imprimante ...";
$sql = "INSERT INTO intranet_v3_0_dev.codesoft_imprimante SELECT * FROM intranet_v2_0_prod.codesoft_imprimante";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.codesoft_style_paragraphe ...";
$sql = "DROP TABLE intranet_v3_0_dev.codesoft_style_paragraphe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.codesoft_style_paragraphe ...";
$sql = "CREATE TABLE intranet_v3_0_dev.codesoft_style_paragraphe LIKE intranet_v3_0_cod.codesoft_style_paragraphe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.codesoft_style_paragraphe ...";
$sql = "INSERT INTO intranet_v3_0_dev.codesoft_style_paragraphe SELECT * FROM intranet_v2_0_prod.codesoft_style_paragraphe";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.droitft ...";
$sql = "DROP TABLE intranet_v3_0_dev.droitft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.droitft ...";
$sql = "CREATE TABLE intranet_v3_0_dev.droitft LIKE intranet_v3_0_cod.droitft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.droitft ...";
$sql = "INSERT INTO intranet_v3_0_dev.droitft SELECT * FROM intranet_v2_0_prod.droitft";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.erp_datasync ...";
$sql = "DROP TABLE intranet_v3_0_dev.erp_datasync";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.erp_datasync ...";
$sql = "CREATE TABLE intranet_v3_0_dev.erp_datasync LIKE intranet_v3_0_cod.erp_datasync";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.erp_datasync ...";
$sql = "INSERT INTO intranet_v3_0_dev.erp_datasync SELECT * FROM intranet_v2_0_prod.erp_datasync";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fiches_mp_achats_moteur_de_recherche ...";
$sql = "DROP TABLE intranet_v3_0_dev.fiches_mp_achats_moteur_de_recherche";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fiches_mp_achats_moteur_de_recherche ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fiches_mp_achats_moteur_de_recherche LIKE intranet_v3_0_cod.fiches_mp_achats_moteur_de_recherche";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fiches_mp_achats_moteur_de_recherche ...";
$sql = "INSERT INTO intranet_v3_0_dev.fiches_mp_achats_moteur_de_recherche SELECT * FROM intranet_v2_0_prod.fiches_mp_achats_moteur_de_recherche";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_derogation_duree_vie ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_derogation_duree_vie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_derogation_duree_vie ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_derogation_duree_vie LIKE intranet_v3_0_cod.fta_derogation_duree_vie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_derogation_duree_vie ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_derogation_duree_vie SELECT * FROM intranet_v2_0_prod.fta_derogation_duree_vie";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_duree_vie ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_duree_vie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_duree_vie ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_duree_vie LIKE intranet_v3_0_cod.fta_duree_vie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_duree_vie ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_duree_vie SELECT * FROM intranet_v2_0_prod.fta_duree_vie";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_migration_import_articles_actifs ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_migration_import_articles_actifs";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_migration_import_articles_actifs ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_migration_import_articles_actifs LIKE intranet_v3_0_cod.fta_migration_import_articles_actifs";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_migration_import_articles_actifs ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_migration_import_articles_actifs SELECT * FROM intranet_v2_0_prod.fta_migration_import_articles_actifs";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_processus_delai ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_processus_delai";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_processus_delai ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_processus_delai LIKE intranet_v3_0_cod.fta_processus_delai";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_processus_delai ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_processus_delai SELECT * FROM intranet_v2_0_prod.fta_processus_delai";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_processus_etat ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_processus_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_processus_etat ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_processus_etat LIKE intranet_v3_0_cod.fta_processus_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_processus_etat ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_processus_etat SELECT * FROM intranet_v2_0_prod.fta_processus_etat";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_processus_multisite ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_processus_multisite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_processus_multisite ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_processus_multisite LIKE intranet_v3_0_cod.fta_processus_multisite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_processus_multisite ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_processus_multisite SELECT * FROM intranet_v2_0_prod.fta_processus_multisite";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_tarif ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_tarif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_tarif ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_tarif LIKE intranet_v3_0_cod.fta_tarif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_tarif ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_tarif SELECT * FROM intranet_v2_0_prod.fta_tarif";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

}

/**
 * Création de tables de la V2 vers V3
 */ 
if(FALSE){

echo "DROP intranet_v3_0_dev.access_base_degust_mois ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_base_degust_mois";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_base_degust_mois ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_base_degust_mois LIKE intranet_v2_0_prod.access_base_degust_mois";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_base_degust_mois ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_base_degust_mois SELECT * FROM intranet_v2_0_prod.access_base_degust_mois";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_base_degust_motifs ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_base_degust_motifs";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_base_degust_motifs ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_base_degust_motifs LIKE intranet_v2_0_prod.access_base_degust_motifs";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_base_degust_motifs ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_base_degust_motifs SELECT * FROM intranet_v2_0_prod.access_base_degust_motifs";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_base_degust_produits ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_base_degust_produits";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_base_degust_produits ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_base_degust_produits LIKE intranet_v2_0_prod.access_base_degust_produits";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_base_degust_produits ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_base_degust_produits SELECT * FROM intranet_v2_0_prod.access_base_degust_produits";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}


echo "DROP intranet_v3_0_dev.access_base_degust_resultat ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_base_degust_resultat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_base_degust_resultat ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_base_degust_resultat LIKE intranet_v2_0_prod.access_base_degust_resultat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_base_degust_resultat ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_base_degust_resultat SELECT * FROM intranet_v2_0_prod.access_base_degust_resultat";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_accomptes ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_accomptes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_accomptes ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_accomptes LIKE intranet_v2_0_prod.access_budget_marketing_accomptes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_accomptes ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_accomptes SELECT * FROM intranet_v2_0_prod.access_budget_marketing_accomptes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_budget ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_budget";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_budget ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_budget LIKE intranet_v2_0_prod.access_budget_marketing_budget";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_budget ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_budget SELECT * FROM intranet_v2_0_prod.access_budget_marketing_budget";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_facturation ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_facturation ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_facturation LIKE intranet_v2_0_prod.access_budget_marketing_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_facturation ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_facturation SELECT * FROM intranet_v2_0_prod.access_budget_marketing_facturation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_fournisseur ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_fournisseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_fournisseur ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_fournisseur LIKE intranet_v2_0_prod.access_budget_marketing_fournisseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_fournisseur ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_fournisseur SELECT * FROM intranet_v2_0_prod.access_budget_marketing_fournisseur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_datasharing_data_sharing ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_datasharing_data_sharing";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_datasharing_data_sharing ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_datasharing_data_sharing LIKE intranet_v2_0_prod.access_datasharing_data_sharing";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_datasharing_data_sharing ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_datasharing_data_sharing SELECT * FROM intranet_v2_0_prod.access_datasharing_data_sharing";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_mdd_accomptes ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_mdd_accomptes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_accomptes ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_accomptes LIKE intranet_v2_0_prod.access_budget_marketing_mdd_accomptes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_accomptes ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_accomptes SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_accomptes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_mdd_budget ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_mdd_budget";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_budget ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_budget LIKE intranet_v2_0_prod.access_budget_marketing_mdd_budget";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_budget ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_budget SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_budget";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_mdd_facturation ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_mdd_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_facturation ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_facturation LIKE intranet_v2_0_prod.access_budget_marketing_mdd_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_facturation ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_facturation SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_facturation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_mdd_fournisseur ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_mdd_fournisseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_fournisseur ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_fournisseur LIKE intranet_v2_0_prod.access_budget_marketing_mdd_fournisseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_fournisseur ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_fournisseur SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_fournisseur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_mdd_hierarchie_compta_analytique ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_mdd_hierarchie_compta_analytique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_hierarchie_compta_analytique ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_hierarchie_compta_analytique LIKE intranet_v2_0_prod.access_budget_marketing_mdd_hierarchie_compta_analytique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_hierarchie_compta_analytique ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_hierarchie_compta_analytique SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_hierarchie_compta_analytique";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_mdd_intitule_base ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_mdd_intitule_base";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_intitule_base ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_intitule_base LIKE intranet_v2_0_prod.access_budget_marketing_mdd_intitule_base";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_intitule_base ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_intitule_base SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_intitule_base";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_hierarchie_compta_analytique ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_hierarchie_compta_analytique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_hierarchie_compta_analytique ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_hierarchie_compta_analytique LIKE intranet_v2_0_prod.access_budget_marketing_hierarchie_compta_analytique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_hierarchie_compta_analytique ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_hierarchie_compta_analytique SELECT * FROM intranet_v2_0_prod.access_budget_marketing_hierarchie_compta_analytique";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_intitule_base ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_intitule_base";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_intitule_base ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_intitule_base LIKE intranet_v2_0_prod.access_budget_marketing_intitule_base";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_intitule_base ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_intitule_base SELECT * FROM intranet_v2_0_prod.access_budget_marketing_intitule_base";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_mdd_prestation ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_mdd_prestation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_prestation ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_prestation LIKE intranet_v2_0_prod.access_budget_marketing_mdd_prestation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_prestation ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_prestation SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_prestation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_mdd_provisions ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_mdd_provisions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_provisions ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_provisions LIKE intranet_v2_0_prod.access_budget_marketing_mdd_provisions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_provisions ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_provisions SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_provisions";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_mdd_reglement ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_mdd_reglement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_reglement ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_reglement LIKE intranet_v2_0_prod.access_budget_marketing_mdd_reglement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_reglement ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_reglement SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_reglement";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_mdd_rubrique_facturation ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_mdd_rubrique_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_rubrique_facturation ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_rubrique_facturation LIKE intranet_v2_0_prod.access_budget_marketing_mdd_rubrique_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_rubrique_facturation ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_rubrique_facturation SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_rubrique_facturation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_mdd_section ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_mdd_section";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_section ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_section LIKE intranet_v2_0_prod.access_budget_marketing_mdd_section";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_section ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_section SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_section";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.intranet_moteur_de_recherche_association_type_operateur ...";
$sql = "DROP TABLE intranet_v3_0_dev.intranet_moteur_de_recherche_association_type_operateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.intranet_moteur_de_recherche_association_type_operateur ...";
$sql = "CREATE TABLE intranet_v3_0_dev.intranet_moteur_de_recherche_association_type_operateur LIKE intranet_v2_0_prod.intranet_moteur_de_recherche_association_type_operateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.intranet_moteur_de_recherche_association_type_operateur ...";
$sql = "INSERT INTO intranet_v3_0_dev.intranet_moteur_de_recherche_association_type_operateur SELECT * FROM intranet_v2_0_prod.intranet_moteur_de_recherche_association_type_operateur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.intranet_moteur_de_recherche_operateur_sur_champ ...";
$sql = "DROP TABLE intranet_v3_0_dev.intranet_moteur_de_recherche_operateur_sur_champ";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.intranet_moteur_de_recherche_operateur_sur_champ ...";
$sql = "CREATE TABLE intranet_v3_0_dev.intranet_moteur_de_recherche_operateur_sur_champ LIKE intranet_v2_0_prod.intranet_moteur_de_recherche_operateur_sur_champ";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.intranet_moteur_de_recherche_operateur_sur_champ ...";
$sql = "INSERT INTO intranet_v3_0_dev.intranet_moteur_de_recherche_operateur_sur_champ SELECT * FROM intranet_v2_0_prod.intranet_moteur_de_recherche_operateur_sur_champ";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_mdd_sous_facturation ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_mdd_sous_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_sous_facturation ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_sous_facturation LIKE intranet_v2_0_prod.access_budget_marketing_mdd_sous_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_sous_facturation ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_sous_facturation SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_sous_facturation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_mdd_sous_section ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_mdd_sous_section";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_sous_section ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_sous_section LIKE intranet_v2_0_prod.access_budget_marketing_mdd_sous_section";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_sous_section ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_sous_section SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_sous_section";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_mdd_temp_facture_provionnee ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_mdd_temp_facture_provionnee";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_temp_facture_provionnee ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_mdd_temp_facture_provionnee LIKE intranet_v2_0_prod.access_budget_marketing_mdd_temp_facture_provionnee";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_temp_facture_provionnee ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_mdd_temp_facture_provionnee SELECT * FROM intranet_v2_0_prod.access_budget_marketing_mdd_temp_facture_provionnee";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_prestation ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_prestation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_prestation ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_prestation LIKE intranet_v2_0_prod.access_budget_marketing_prestation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_prestation ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_prestation SELECT * FROM intranet_v2_0_prod.access_budget_marketing_prestation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_provisions ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_provisions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_provisions ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_provisions LIKE intranet_v2_0_prod.access_budget_marketing_provisions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_provisions ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_provisions SELECT * FROM intranet_v2_0_prod.access_budget_marketing_provisions";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_reglement ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_reglement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_reglement ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_reglement LIKE intranet_v2_0_prod.access_budget_marketing_reglement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_reglement ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_reglement SELECT * FROM intranet_v2_0_prod.access_budget_marketing_reglement";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_rubrique_facturation ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_rubrique_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_rubrique_facturation ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_rubrique_facturation LIKE intranet_v2_0_prod.access_budget_marketing_rubrique_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_rubrique_facturation ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_rubrique_facturation SELECT * FROM intranet_v2_0_prod.access_budget_marketing_rubrique_facturation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_section ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_section";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_section ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_section LIKE intranet_v2_0_prod.access_budget_marketing_section";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_section ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_section SELECT * FROM intranet_v2_0_prod.access_budget_marketing_section";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_sous_facturation ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_sous_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_sous_facturation ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_sous_facturation LIKE intranet_v2_0_prod.access_budget_marketing_sous_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_sous_facturation ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_sous_facturation SELECT * FROM intranet_v2_0_prod.access_budget_marketing_sous_facturation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_sous_section ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_sous_section";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_sous_section ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_sous_section LIKE intranet_v2_0_prod.access_budget_marketing_sous_section";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_sous_section ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_sous_section SELECT * FROM intranet_v2_0_prod.access_budget_marketing_sous_section";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_marketing_temp_facture_provionnee ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_marketing_temp_facture_provionnee";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_temp_facture_provionnee ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_marketing_temp_facture_provionnee LIKE intranet_v2_0_prod.access_budget_marketing_temp_facture_provionnee";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_marketing_temp_facture_provionnee ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_marketing_temp_facture_provionnee SELECT * FROM intranet_v2_0_prod.access_budget_marketing_temp_facture_provionnee";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_ventes_14mois_Importation_Real_N_1 ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_ventes_14mois_Importation_Real_N_1";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_ventes_14mois_Importation_Real_N_1 ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_ventes_14mois_Importation_Real_N_1 LIKE intranet_v2_0_prod.access_budget_ventes_14mois_Importation_Real_N_1";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_ventes_14mois_Importation_Real_N_1 ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_ventes_14mois_Importation_Real_N_1 SELECT * FROM intranet_v2_0_prod.access_budget_ventes_14mois_Importation_Real_N_1";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_ventes_14mois_Importation_des_Realisations_N_1 ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_ventes_14mois_Importation_des_Realisations_N_1";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_ventes_14mois_Importation_des_Realisations_N_1 ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_ventes_14mois_Importation_des_Realisations_N_1 LIKE intranet_v2_0_prod.access_budget_ventes_14mois_Importation_des_Realisations_N_1";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_ventes_14mois_Importation_des_Realisations_N_1 ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_ventes_14mois_Importation_des_Realisations_N_1 SELECT * FROM intranet_v2_0_prod.access_budget_ventes_14mois_Importation_des_Realisations_N_1";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_ventes_Importation_des_Realisations_N_1 ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_ventes_Importation_des_Realisations_N_1";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_ventes_Importation_des_Realisations_N_1 ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_ventes_Importation_des_Realisations_N_1 LIKE intranet_v2_0_prod.access_budget_ventes_Importation_des_Realisations_N_1";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_ventes_Importation_des_Realisations_N_1 ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_ventes_Importation_des_Realisations_N_1 SELECT * FROM intranet_v2_0_prod.access_budget_ventes_Importation_des_Realisations_N_1";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_ventes_arti2_dev ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_ventes_arti2_dev";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_ventes_arti2_dev ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_ventes_arti2_dev LIKE intranet_v2_0_prod.access_budget_ventes_arti2_dev";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_ventes_arti2_dev ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_ventes_arti2_dev SELECT * FROM intranet_v2_0_prod.access_budget_ventes_arti2_dev";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_budget_ventes_reseau_commercial ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_budget_ventes_reseau_commercial";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_budget_ventes_reseau_commercial ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_budget_ventes_reseau_commercial LIKE intranet_v2_0_prod.access_budget_ventes_reseau_commercial";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_budget_ventes_reseau_commercial ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_budget_ventes_reseau_commercial SELECT * FROM intranet_v2_0_prod.access_budget_ventes_reseau_commercial";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_bugdet_ventes_14mois_table_animation ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_bugdet_ventes_14mois_table_animation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_14mois_table_animation ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_14mois_table_animation LIKE intranet_v2_0_prod.access_bugdet_ventes_14mois_table_animation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_14mois_table_animation ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_14mois_table_animation SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_14mois_table_animation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_bugdet_ventes_14mois_table_budget ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_bugdet_ventes_14mois_table_budget";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_14mois_table_budget ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_14mois_table_budget LIKE intranet_v2_0_prod.access_bugdet_ventes_14mois_table_budget";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_14mois_table_budget ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_14mois_table_budget SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_14mois_table_budget";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_bugdet_ventes_14mois_table_realises ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_bugdet_ventes_14mois_table_realises";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_14mois_table_realises ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_14mois_table_realises LIKE intranet_v2_0_prod.access_bugdet_ventes_14mois_table_realises";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_14mois_table_realises ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_14mois_table_realises SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_14mois_table_realises";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_bugdet_ventes_articles_cout ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_bugdet_ventes_articles_cout";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_articles_cout ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_articles_cout LIKE intranet_v2_0_prod.access_bugdet_ventes_articles_cout";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_articles_cout ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_articles_cout SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_articles_cout";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_bugdet_ventes_articles_totalite ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_bugdet_ventes_articles_totalite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_articles_totalite ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_articles_totalite LIKE intranet_v2_0_prod.access_bugdet_ventes_articles_totalite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_articles_totalite ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_articles_totalite SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_articles_totalite";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_bugdet_ventes_correspondance_famcli_fammktg ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_bugdet_ventes_correspondance_famcli_fammktg";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_correspondance_famcli_fammktg ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_correspondance_famcli_fammktg LIKE intranet_v2_0_prod.access_bugdet_ventes_correspondance_famcli_fammktg";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_correspondance_famcli_fammktg ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_correspondance_famcli_fammktg SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_correspondance_famcli_fammktg";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_bugdet_ventes_table_animation ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_bugdet_ventes_table_animation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_table_animation ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_table_animation LIKE intranet_v2_0_prod.access_bugdet_ventes_table_animation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_table_animation ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_table_animation SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_table_animation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_bugdet_ventes_table_budget ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_bugdet_ventes_table_budget";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_table_budget ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_table_budget LIKE intranet_v2_0_prod.access_bugdet_ventes_table_budget";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_table_budget ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_table_budget SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_table_budget";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_bugdet_ventes_table_bugdet_commentaire ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_bugdet_ventes_table_bugdet_commentaire";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_table_bugdet_commentaire ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_table_bugdet_commentaire LIKE intranet_v2_0_prod.access_bugdet_ventes_table_bugdet_commentaire";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_table_bugdet_commentaire ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_table_bugdet_commentaire SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_table_bugdet_commentaire";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_bugdet_ventes_table_realises ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_bugdet_ventes_table_realises";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_table_realises ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_bugdet_ventes_table_realises LIKE intranet_v2_0_prod.access_bugdet_ventes_table_realises";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_table_realises ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_bugdet_ventes_table_realises SELECT * FROM intranet_v2_0_prod.access_bugdet_ventes_table_realises";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_clients ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_clients";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_clients ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_clients LIKE intranet_v2_0_prod.access_clients";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_clients ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_clients SELECT * FROM intranet_v2_0_prod.access_clients";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_clients_rayon ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_clients_rayon";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_clients_rayon ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_clients_rayon LIKE intranet_v2_0_prod.access_clients_rayon";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_clients_rayon ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_clients_rayon SELECT * FROM intranet_v2_0_prod.access_clients_rayon";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_commerciaux ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_commerciaux";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_commerciaux ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_commerciaux LIKE intranet_v2_0_prod.access_commerciaux";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_commerciaux ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_commerciaux SELECT * FROM intranet_v2_0_prod.access_commerciaux";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_datasharing_Nb_magasin_entrepot ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_datasharing_Nb_magasin_entrepot";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_datasharing_Nb_magasin_entrepot ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_datasharing_Nb_magasin_entrepot LIKE intranet_v2_0_prod.access_datasharing_Nb_magasin_entrepot";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_datasharing_Nb_magasin_entrepot ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_datasharing_Nb_magasin_entrepot SELECT * FROM intranet_v2_0_prod.access_datasharing_Nb_magasin_entrepot";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_datasharing_Table_des_magasins ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_datasharing_Table_des_magasins";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_datasharing_Table_des_magasins ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_datasharing_Table_des_magasins LIKE intranet_v2_0_prod.access_datasharing_Table_des_magasins";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_datasharing_Table_des_magasins ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_datasharing_Table_des_magasins SELECT * FROM intranet_v2_0_prod.access_datasharing_Table_des_magasins";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_etat ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_etat ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_etat LIKE intranet_v2_0_prod.access_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_etat ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_etat SELECT * FROM intranet_v2_0_prod.access_etat";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_familles_articles ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_familles_articles";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_familles_articles ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_familles_articles LIKE intranet_v2_0_prod.access_familles_articles";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_familles_articles ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_familles_articles SELECT * FROM intranet_v2_0_prod.access_familles_articles";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_familles_clients ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_familles_clients";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_familles_clients ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_familles_clients LIKE intranet_v2_0_prod.access_familles_clients";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_familles_clients ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_familles_clients SELECT * FROM intranet_v2_0_prod.access_familles_clients";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_familles_gammes ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_familles_gammes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_familles_gammes ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_familles_gammes LIKE intranet_v2_0_prod.access_familles_gammes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_familles_gammes ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_familles_gammes SELECT * FROM intranet_v2_0_prod.access_familles_gammes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_familles_marketing ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_familles_marketing";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_familles_marketing ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_familles_marketing LIKE intranet_v2_0_prod.access_familles_marketing";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_familles_marketing ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_familles_marketing SELECT * FROM intranet_v2_0_prod.access_familles_marketing";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_formation_categories_socio_professionnelles ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_formation_categories_socio_professionnelles";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_formation_categories_socio_professionnelles ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_formation_categories_socio_professionnelles LIKE intranet_v2_0_prod.access_formation_categories_socio_professionnelles";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_formation_categories_socio_professionnelles ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_formation_categories_socio_professionnelles SELECT * FROM intranet_v2_0_prod.access_formation_categories_socio_professionnelles";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_formation_departements ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_formation_departements";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_formation_departements ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_formation_departements LIKE intranet_v2_0_prod.access_formation_departements";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_formation_departements ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_formation_departements SELECT * FROM intranet_v2_0_prod.access_formation_departements";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_formation_fonctions ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_formation_fonctions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_formation_fonctions ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_formation_fonctions LIKE intranet_v2_0_prod.access_formation_fonctions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_formation_fonctions ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_formation_fonctions SELECT * FROM intranet_v2_0_prod.access_formation_fonctions";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_formation_formation ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_formation_formation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_formation_formation ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_formation_formation LIKE intranet_v2_0_prod.access_formation_formation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_formation_formation ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_formation_formation SELECT * FROM intranet_v2_0_prod.access_formation_formation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_formation_regroupement_age ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_formation_regroupement_age";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_formation_regroupement_age ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_formation_regroupement_age LIKE intranet_v2_0_prod.access_formation_regroupement_age";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_formation_regroupement_age ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_formation_regroupement_age SELECT * FROM intranet_v2_0_prod.access_formation_regroupement_age";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_formation_salarie ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_formation_salarie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_formation_salarie ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_formation_salarie LIKE intranet_v2_0_prod.access_formation_salarie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_formation_salarie ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_formation_salarie SELECT * FROM intranet_v2_0_prod.access_formation_salarie";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_formation_services ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_formation_services";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_formation_services ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_formation_services LIKE intranet_v2_0_prod.access_formation_services";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_formation_services ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_formation_services SELECT * FROM intranet_v2_0_prod.access_formation_services";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_formation_stage_informations ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_formation_stage_informations";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_formation_stage_informations ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_formation_stage_informations LIKE intranet_v2_0_prod.access_formation_stage_informations";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_formation_stage_informations ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_formation_stage_informations SELECT * FROM intranet_v2_0_prod.access_formation_stage_informations";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_formation_stage_intitule_formation ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_formation_stage_intitule_formation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_formation_stage_intitule_formation ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_formation_stage_intitule_formation LIKE intranet_v2_0_prod.access_formation_stage_intitule_formation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_formation_stage_intitule_formation ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_formation_stage_intitule_formation SELECT * FROM intranet_v2_0_prod.access_formation_stage_intitule_formation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_formation_stage_table_des_domaines ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_formation_stage_table_des_domaines";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_formation_stage_table_des_domaines ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_formation_stage_table_des_domaines LIKE intranet_v2_0_prod.access_formation_stage_table_des_domaines";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_formation_stage_table_des_domaines ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_formation_stage_table_des_domaines SELECT * FROM intranet_v2_0_prod.access_formation_stage_table_des_domaines";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_formation_stage_table_des_intitules ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_formation_stage_table_des_intitules";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_formation_stage_table_des_intitules ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_formation_stage_table_des_intitules LIKE intranet_v2_0_prod.access_formation_stage_table_des_intitules";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_formation_stage_table_des_intitules ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_formation_stage_table_des_intitules SELECT * FROM intranet_v2_0_prod.access_formation_stage_table_des_intitules";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_formation_stage_table_des_organismes ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_formation_stage_table_des_organismes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_formation_stage_table_des_organismes ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_formation_stage_table_des_organismes LIKE intranet_v2_0_prod.access_formation_stage_table_des_organismes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_formation_stage_table_des_organismes ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_formation_stage_table_des_organismes SELECT * FROM intranet_v2_0_prod.access_formation_stage_table_des_organismes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_formation_table_des_Tx ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_formation_table_des_Tx";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_formation_table_des_Tx ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_formation_table_des_Tx LIKE intranet_v2_0_prod.access_formation_table_des_Tx";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_formation_table_des_Tx ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_formation_table_des_Tx SELECT * FROM intranet_v2_0_prod.access_formation_table_des_Tx";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_formation_table_des_donnees ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_formation_table_des_donnees";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_formation_table_des_donnees ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_formation_table_des_donnees LIKE intranet_v2_0_prod.access_formation_table_des_donnees";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_formation_table_des_donnees ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_formation_table_des_donnees SELECT * FROM intranet_v2_0_prod.access_formation_table_des_donnees";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_formation_table_des_postes_de_depenses ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_formation_table_des_postes_de_depenses";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_formation_table_des_postes_de_depenses ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_formation_table_des_postes_de_depenses LIKE intranet_v2_0_prod.access_formation_table_des_postes_de_depenses";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_formation_table_des_postes_de_depenses ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_formation_table_des_postes_de_depenses SELECT * FROM intranet_v2_0_prod.access_formation_table_des_postes_de_depenses";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_gammes ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_gammes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_gammes ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_gammes LIKE intranet_v2_0_prod.access_gammes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_gammes ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_gammes SELECT * FROM intranet_v2_0_prod.access_gammes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_indicateur_productivite_expedition_production ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_indicateur_productivite_expedition_production";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_indicateur_productivite_expedition_production ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_indicateur_productivite_expedition_production LIKE intranet_v2_0_prod.access_indicateur_productivite_expedition_production";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_indicateur_productivite_expedition_production ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_indicateur_productivite_expedition_production SELECT * FROM intranet_v2_0_prod.access_indicateur_productivite_expedition_production";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_indicateur_productivite_expedition_temps_travail ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_indicateur_productivite_expedition_temps_travail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_indicateur_productivite_expedition_temps_travail ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_indicateur_productivite_expedition_temps_travail LIKE intranet_v2_0_prod.access_indicateur_productivite_expedition_temps_travail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_indicateur_productivite_expedition_temps_travail ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_indicateur_productivite_expedition_temps_travail SELECT * FROM intranet_v2_0_prod.access_indicateur_productivite_expedition_temps_travail";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_carte_reseau ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_carte_reseau";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_carte_reseau ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_carte_reseau LIKE intranet_v2_0_prod.access_materiel_carte_reseau";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_carte_reseau ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_carte_reseau SELECT * FROM intranet_v2_0_prod.access_materiel_carte_reseau";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_categorie_logiciel ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_categorie_logiciel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_categorie_logiciel ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_categorie_logiciel LIKE intranet_v2_0_prod.access_materiel_categorie_logiciel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_categorie_logiciel ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_categorie_logiciel SELECT * FROM intranet_v2_0_prod.access_materiel_categorie_logiciel";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_connectique ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_connectique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_connectique ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_connectique LIKE intranet_v2_0_prod.access_materiel_connectique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_connectique ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_connectique SELECT * FROM intranet_v2_0_prod.access_materiel_connectique";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_contrat ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_contrat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_contrat ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_contrat LIKE intranet_v2_0_prod.access_materiel_contrat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_contrat ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_contrat SELECT * FROM intranet_v2_0_prod.access_materiel_contrat";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_ecran ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_ecran";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_ecran ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_ecran LIKE intranet_v2_0_prod.access_materiel_ecran";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_ecran ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_ecran SELECT * FROM intranet_v2_0_prod.access_materiel_ecran";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_etat_incident ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_etat_incident";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_etat_incident ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_etat_incident LIKE intranet_v2_0_prod.access_materiel_etat_incident";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_etat_incident ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_etat_incident SELECT * FROM intranet_v2_0_prod.access_materiel_etat_incident";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_etat_materiel_detail ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_etat_materiel_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_etat_materiel_detail ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_etat_materiel_detail LIKE intranet_v2_0_prod.access_materiel_etat_materiel_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_etat_materiel_detail ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_etat_materiel_detail SELECT * FROM intranet_v2_0_prod.access_materiel_etat_materiel_detail";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_fonction_prestataire ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_fonction_prestataire";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_fonction_prestataire ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_fonction_prestataire LIKE intranet_v2_0_prod.access_materiel_fonction_prestataire";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_fonction_prestataire ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_fonction_prestataire SELECT * FROM intranet_v2_0_prod.access_materiel_fonction_prestataire";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_gestion_incident ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_gestion_incident";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_gestion_incident ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_gestion_incident LIKE intranet_v2_0_prod.access_materiel_gestion_incident";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_gestion_incident ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_gestion_incident SELECT * FROM intranet_v2_0_prod.access_materiel_gestion_incident";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_gestion_incident_groupe ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_gestion_incident_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_gestion_incident_groupe ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_gestion_incident_groupe LIKE intranet_v2_0_prod.access_materiel_gestion_incident_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_gestion_incident_groupe ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_gestion_incident_groupe SELECT * FROM intranet_v2_0_prod.access_materiel_gestion_incident_groupe";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_horloge_processeur ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_horloge_processeur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_horloge_processeur ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_horloge_processeur LIKE intranet_v2_0_prod.access_materiel_horloge_processeur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_horloge_processeur ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_horloge_processeur SELECT * FROM intranet_v2_0_prod.access_materiel_horloge_processeur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_imprimante ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_imprimante";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_imprimante ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_imprimante LIKE intranet_v2_0_prod.access_materiel_imprimante";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_imprimante ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_imprimante SELECT * FROM intranet_v2_0_prod.access_materiel_imprimante";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_incident ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_incident";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_incident ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_incident LIKE intranet_v2_0_prod.access_materiel_incident";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_incident ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_incident SELECT * FROM intranet_v2_0_prod.access_materiel_incident";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_licence ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_licence";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_licence ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_licence LIKE intranet_v2_0_prod.access_materiel_licence";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_licence ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_licence SELECT * FROM intranet_v2_0_prod.access_materiel_licence";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_log ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_log";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_log ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_log LIKE intranet_v2_0_prod.access_materiel_log";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_log ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_log SELECT * FROM intranet_v2_0_prod.access_materiel_log";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_marque_materiel ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_marque_materiel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_marque_materiel ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_marque_materiel LIKE intranet_v2_0_prod.access_materiel_marque_materiel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_marque_materiel ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_marque_materiel SELECT * FROM intranet_v2_0_prod.access_materiel_marque_materiel";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_materiel_detail ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_materiel_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_materiel_detail ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_materiel_detail LIKE intranet_v2_0_prod.access_materiel_materiel_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_materiel_detail ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_materiel_detail SELECT * FROM intranet_v2_0_prod.access_materiel_materiel_detail";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_materiel_general ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_materiel_general";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_materiel_general ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_materiel_general LIKE intranet_v2_0_prod.access_materiel_materiel_general";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_materiel_general ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_materiel_general SELECT * FROM intranet_v2_0_prod.access_materiel_materiel_general";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_modem ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_modem";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_modem ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_modem LIKE intranet_v2_0_prod.access_materiel_modem";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_modem ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_modem SELECT * FROM intranet_v2_0_prod.access_materiel_modem";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_module ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_module";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_module ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_module LIKE intranet_v2_0_prod.access_materiel_module";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_module ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_module SELECT * FROM intranet_v2_0_prod.access_materiel_module";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_nature_action ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_nature_action";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_nature_action ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_nature_action LIKE intranet_v2_0_prod.access_materiel_nature_action";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_nature_action ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_nature_action SELECT * FROM intranet_v2_0_prod.access_materiel_nature_action";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_nature_incident ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_nature_incident";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_nature_incident ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_nature_incident LIKE intranet_v2_0_prod.access_materiel_nature_incident";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_nature_incident ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_nature_incident SELECT * FROM intranet_v2_0_prod.access_materiel_nature_incident";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_poste ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_poste";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_poste ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_poste LIKE intranet_v2_0_prod.access_materiel_poste";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_poste ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_poste SELECT * FROM intranet_v2_0_prod.access_materiel_poste";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_prestataire ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_prestataire";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_prestataire ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_prestataire LIKE intranet_v2_0_prod.access_materiel_prestataire";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_prestataire ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_prestataire SELECT * FROM intranet_v2_0_prod.access_materiel_prestataire";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_processeur ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_processeur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_processeur ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_processeur LIKE intranet_v2_0_prod.access_materiel_processeur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_processeur ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_processeur SELECT * FROM intranet_v2_0_prod.access_materiel_processeur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_reseaux ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_reseaux";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_reseaux ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_reseaux LIKE intranet_v2_0_prod.access_materiel_reseaux";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_reseaux ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_reseaux SELECT * FROM intranet_v2_0_prod.access_materiel_reseaux";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_reseaux_detail ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_reseaux_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_reseaux_detail ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_reseaux_detail LIKE intranet_v2_0_prod.access_materiel_reseaux_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_reseaux_detail ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_reseaux_detail SELECT * FROM intranet_v2_0_prod.access_materiel_reseaux_detail";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_section_analytique ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_section_analytique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_section_analytique ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_section_analytique LIKE intranet_v2_0_prod.access_materiel_section_analytique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_section_analytique ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_section_analytique SELECT * FROM intranet_v2_0_prod.access_materiel_section_analytique";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_serveur ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_serveur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_serveur ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_serveur LIKE intranet_v2_0_prod.access_materiel_serveur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_serveur ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_serveur SELECT * FROM intranet_v2_0_prod.access_materiel_serveur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_serveur_applicatif ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_serveur_applicatif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_serveur_applicatif ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_serveur_applicatif LIKE intranet_v2_0_prod.access_materiel_serveur_applicatif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_serveur_applicatif ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_serveur_applicatif SELECT * FROM intranet_v2_0_prod.access_materiel_serveur_applicatif";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_technologie_materiel ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_technologie_materiel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_technologie_materiel ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_technologie_materiel LIKE intranet_v2_0_prod.access_materiel_technologie_materiel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_technologie_materiel ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_technologie_materiel SELECT * FROM intranet_v2_0_prod.access_materiel_technologie_materiel";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_type_materiel_detail ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_type_materiel_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_type_materiel_detail ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_type_materiel_detail LIKE intranet_v2_0_prod.access_materiel_type_materiel_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_type_materiel_detail ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_type_materiel_detail SELECT * FROM intranet_v2_0_prod.access_materiel_type_materiel_detail";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_unite_centrale ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_unite_centrale";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_unite_centrale ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_unite_centrale LIKE intranet_v2_0_prod.access_materiel_unite_centrale";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_unite_centrale ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_unite_centrale SELECT * FROM intranet_v2_0_prod.access_materiel_unite_centrale";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_materiel_wintegrate ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_materiel_wintegrate";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_materiel_wintegrate ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_materiel_wintegrate LIKE intranet_v2_0_prod.access_materiel_wintegrate";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_materiel_wintegrate ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_materiel_wintegrate SELECT * FROM intranet_v2_0_prod.access_materiel_wintegrate";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_plan_qualite_action ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_plan_qualite_action";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_plan_qualite_action ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_plan_qualite_action LIKE intranet_v2_0_prod.access_plan_qualite_action";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_plan_qualite_action ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_plan_qualite_action SELECT * FROM intranet_v2_0_prod.access_plan_qualite_action";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_plan_qualite_genre ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_plan_qualite_genre";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_plan_qualite_genre ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_plan_qualite_genre LIKE intranet_v2_0_prod.access_plan_qualite_genre";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_plan_qualite_genre ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_plan_qualite_genre SELECT * FROM intranet_v2_0_prod.access_plan_qualite_genre";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_plan_qualite_nature ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_plan_qualite_nature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_plan_qualite_nature ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_plan_qualite_nature LIKE intranet_v2_0_prod.access_plan_qualite_nature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_plan_qualite_nature ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_plan_qualite_nature SELECT * FROM intranet_v2_0_prod.access_plan_qualite_nature";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_plan_qualite_origine ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_plan_qualite_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_plan_qualite_origine ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_plan_qualite_origine LIKE intranet_v2_0_prod.access_plan_qualite_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_plan_qualite_origine ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_plan_qualite_origine SELECT * FROM intranet_v2_0_prod.access_plan_qualite_origine";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_plan_qualite_plan ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_plan_qualite_plan";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_plan_qualite_plan ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_plan_qualite_plan LIKE intranet_v2_0_prod.access_plan_qualite_plan";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_plan_qualite_plan ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_plan_qualite_plan SELECT * FROM intranet_v2_0_prod.access_plan_qualite_plan";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_plan_qualite_processus ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_plan_qualite_processus";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_plan_qualite_processus ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_plan_qualite_processus LIKE intranet_v2_0_prod.access_plan_qualite_processus";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_plan_qualite_processus ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_plan_qualite_processus SELECT * FROM intranet_v2_0_prod.access_plan_qualite_processus";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_prise_coeur_frequences ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_prise_coeur_frequences";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_prise_coeur_frequences ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_prise_coeur_frequences LIKE intranet_v2_0_prod.access_prise_coeur_frequences";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_prise_coeur_frequences ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_prise_coeur_frequences SELECT * FROM intranet_v2_0_prod.access_prise_coeur_frequences";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_prise_coeur_produits ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_prise_coeur_produits";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_prise_coeur_produits ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_prise_coeur_produits LIKE intranet_v2_0_prod.access_prise_coeur_produits";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_prise_coeur_produits ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_prise_coeur_produits SELECT * FROM intranet_v2_0_prod.access_prise_coeur_produits";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_qualite_processus ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_qualite_processus";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_qualite_processus ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_qualite_processus LIKE intranet_v2_0_prod.access_qualite_processus";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_qualite_processus ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_qualite_processus SELECT * FROM intranet_v2_0_prod.access_qualite_processus";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_rcp_Correspondance_mois_exercice ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_rcp_Correspondance_mois_exercice";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_rcp_Correspondance_mois_exercice ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_rcp_Correspondance_mois_exercice LIKE intranet_v2_0_prod.access_rcp_Correspondance_mois_exercice";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_rcp_Correspondance_mois_exercice ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_rcp_Correspondance_mois_exercice SELECT * FROM intranet_v2_0_prod.access_rcp_Correspondance_mois_exercice";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_rcp_Couts_a_ventiler_Articles_Saisonniers ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_rcp_Couts_a_ventiler_Articles_Saisonniers";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_rcp_Couts_a_ventiler_Articles_Saisonniers ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_rcp_Couts_a_ventiler_Articles_Saisonniers LIKE intranet_v2_0_prod.access_rcp_Couts_a_ventiler_Articles_Saisonniers";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_rcp_Couts_a_ventiler_Articles_Saisonniers ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_rcp_Couts_a_ventiler_Articles_Saisonniers SELECT * FROM intranet_v2_0_prod.access_rcp_Couts_a_ventiler_Articles_Saisonniers";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_rcp_Donnees_CLIENTS_ARTICLES ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_rcp_Donnees_CLIENTS_ARTICLES";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_rcp_Donnees_CLIENTS_ARTICLES ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_rcp_Donnees_CLIENTS_ARTICLES LIKE intranet_v2_0_prod.access_rcp_Donnees_CLIENTS_ARTICLES";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_rcp_Donnees_CLIENTS_ARTICLES ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_rcp_Donnees_CLIENTS_ARTICLES SELECT * FROM intranet_v2_0_prod.access_rcp_Donnees_CLIENTS_ARTICLES";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_rcp_Liste_Diffusion ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_rcp_Liste_Diffusion";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_rcp_Liste_Diffusion ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_rcp_Liste_Diffusion LIKE intranet_v2_0_prod.access_rcp_Liste_Diffusion";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_rcp_Liste_Diffusion ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_rcp_Liste_Diffusion SELECT * FROM intranet_v2_0_prod.access_rcp_Liste_Diffusion";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_rcp_Mois ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_rcp_Mois";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_rcp_Mois ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_rcp_Mois LIKE intranet_v2_0_prod.access_rcp_Mois";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_rcp_Mois ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_rcp_Mois SELECT * FROM intranet_v2_0_prod.access_rcp_Mois";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_recettes_multi_composition ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_recettes_multi_composition";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_composition ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_composition LIKE intranet_v2_0_prod.access_recettes_multi_composition";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_recettes_multi_composition ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_recettes_multi_composition SELECT * FROM intranet_v2_0_prod.access_recettes_multi_composition";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_recettes_multi_cout_fab ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_recettes_multi_cout_fab";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_cout_fab ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_cout_fab LIKE intranet_v2_0_prod.access_recettes_multi_cout_fab";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_recettes_multi_cout_fab ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_recettes_multi_cout_fab SELECT * FROM intranet_v2_0_prod.access_recettes_multi_cout_fab";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_recettes_multi_frais_de_transport ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_recettes_multi_frais_de_transport";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_frais_de_transport ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_frais_de_transport LIKE intranet_v2_0_prod.access_recettes_multi_frais_de_transport";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_recettes_multi_frais_de_transport ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_recettes_multi_frais_de_transport SELECT * FROM intranet_v2_0_prod.access_recettes_multi_frais_de_transport";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_recettes_multi_gammes ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_recettes_multi_gammes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_gammes ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_gammes LIKE intranet_v2_0_prod.access_recettes_multi_gammes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_recettes_multi_gammes ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_recettes_multi_gammes SELECT * FROM intranet_v2_0_prod.access_recettes_multi_gammes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_recettes_multi_importation_matiere ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_recettes_multi_importation_matiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_importation_matiere ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_importation_matiere LIKE intranet_v2_0_prod.access_recettes_multi_importation_matiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_recettes_multi_importation_matiere ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_recettes_multi_importation_matiere SELECT * FROM intranet_v2_0_prod.access_recettes_multi_importation_matiere";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_recettes_multi_importation_tarif ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_recettes_multi_importation_tarif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_importation_tarif ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_importation_tarif LIKE intranet_v2_0_prod.access_recettes_multi_importation_tarif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_recettes_multi_importation_tarif ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_recettes_multi_importation_tarif SELECT * FROM intranet_v2_0_prod.access_recettes_multi_importation_tarif";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_recettes_multi_infologic_fournisseurs ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_recettes_multi_infologic_fournisseurs";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_infologic_fournisseurs ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_infologic_fournisseurs LIKE intranet_v2_0_prod.access_recettes_multi_infologic_fournisseurs";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_recettes_multi_infologic_fournisseurs ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_recettes_multi_infologic_fournisseurs SELECT * FROM intranet_v2_0_prod.access_recettes_multi_infologic_fournisseurs";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_recettes_multi_infologic_unite ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_recettes_multi_infologic_unite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_infologic_unite ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_infologic_unite LIKE intranet_v2_0_prod.access_recettes_multi_infologic_unite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_recettes_multi_infologic_unite ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_recettes_multi_infologic_unite SELECT * FROM intranet_v2_0_prod.access_recettes_multi_infologic_unite";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_recettes_multi_ingredients ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_recettes_multi_ingredients";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_ingredients ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_ingredients LIKE intranet_v2_0_prod.access_recettes_multi_ingredients";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_recettes_multi_ingredients ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_recettes_multi_ingredients SELECT * FROM intranet_v2_0_prod.access_recettes_multi_ingredients";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_recettes_multi_recette ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_recettes_multi_recette";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_recette ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_recette LIKE intranet_v2_0_prod.access_recettes_multi_recette";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_recettes_multi_recette ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_recettes_multi_recette SELECT * FROM intranet_v2_0_prod.access_recettes_multi_recette";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_recettes_multi_stades ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_recettes_multi_stades";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_stades ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_stades LIKE intranet_v2_0_prod.access_recettes_multi_stades";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_recettes_multi_stades ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_recettes_multi_stades SELECT * FROM intranet_v2_0_prod.access_recettes_multi_stades";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_recettes_multi_unites ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_recettes_multi_unites";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_unites ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_recettes_multi_unites LIKE intranet_v2_0_prod.access_recettes_multi_unites";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_recettes_multi_unites ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_recettes_multi_unites SELECT * FROM intranet_v2_0_prod.access_recettes_multi_unites";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_regroupements ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_regroupements";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_regroupements ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_regroupements LIKE intranet_v2_0_prod.access_regroupements";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_regroupements ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_regroupements SELECT * FROM intranet_v2_0_prod.access_regroupements";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_risq_pro_intranet_SITES ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_risq_pro_intranet_SITES";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_SITES ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_SITES LIKE intranet_v2_0_prod.access_risq_pro_intranet_SITES";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_SITES ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_SITES SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_SITES";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_risq_pro_intranet_etat_dossier ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_risq_pro_intranet_etat_dossier";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_etat_dossier ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_etat_dossier LIKE intranet_v2_0_prod.access_risq_pro_intranet_etat_dossier";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_etat_dossier ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_etat_dossier SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_etat_dossier";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_risq_pro_intranet_evaluation_risque ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_risq_pro_intranet_evaluation_risque";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_evaluation_risque ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_evaluation_risque LIKE intranet_v2_0_prod.access_risq_pro_intranet_evaluation_risque";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_evaluation_risque ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_evaluation_risque SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_evaluation_risque";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_risq_pro_intranet_gravites ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_risq_pro_intranet_gravites";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_gravites ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_gravites LIKE intranet_v2_0_prod.access_risq_pro_intranet_gravites";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_gravites ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_gravites SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_gravites";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_risq_pro_intranet_identification_codes_risque ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_risq_pro_intranet_identification_codes_risque";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_identification_codes_risque ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_identification_codes_risque LIKE intranet_v2_0_prod.access_risq_pro_intranet_identification_codes_risque";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_identification_codes_risque ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_identification_codes_risque SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_identification_codes_risque";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_risq_pro_intranet_matrice_risque ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_risq_pro_intranet_matrice_risque";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_matrice_risque ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_matrice_risque LIKE intranet_v2_0_prod.access_risq_pro_intranet_matrice_risque";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_matrice_risque ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_matrice_risque SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_matrice_risque";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_risq_pro_intranet_nature_risque ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_risq_pro_intranet_nature_risque";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_nature_risque ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_nature_risque LIKE intranet_v2_0_prod.access_risq_pro_intranet_nature_risque";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_nature_risque ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_nature_risque SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_nature_risque";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_risq_pro_intranet_probabilites ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_risq_pro_intranet_probabilites";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_probabilites ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_probabilites LIKE intranet_v2_0_prod.access_risq_pro_intranet_probabilites";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_probabilites ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_probabilites SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_probabilites";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_risq_pro_intranet_risques ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_risq_pro_intranet_risques";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_risques ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_risques LIKE intranet_v2_0_prod.access_risq_pro_intranet_risques";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_risques ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_risques SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_risques";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_risq_pro_intranet_secteurs ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_risq_pro_intranet_secteurs";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_secteurs ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_risq_pro_intranet_secteurs LIKE intranet_v2_0_prod.access_risq_pro_intranet_secteurs";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_secteurs ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_risq_pro_intranet_secteurs SELECT * FROM intranet_v2_0_prod.access_risq_pro_intranet_secteurs";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_ruptures_commandes ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_ruptures_commandes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_ruptures_commandes ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_ruptures_commandes LIKE intranet_v2_0_prod.access_ruptures_commandes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_ruptures_commandes ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_ruptures_commandes SELECT * FROM intranet_v2_0_prod.access_ruptures_commandes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_ruptures_donnees_CLIENTS_ARTICLES ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_ruptures_donnees_CLIENTS_ARTICLES";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_ruptures_donnees_CLIENTS_ARTICLES ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_ruptures_donnees_CLIENTS_ARTICLES LIKE intranet_v2_0_prod.access_ruptures_donnees_CLIENTS_ARTICLES";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_ruptures_donnees_CLIENTS_ARTICLES ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_ruptures_donnees_CLIENTS_ARTICLES SELECT * FROM intranet_v2_0_prod.access_ruptures_donnees_CLIENTS_ARTICLES";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_ruptures_commandes_details ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_ruptures_commandes_details";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_ruptures_commandes_details ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_ruptures_commandes_details LIKE intranet_v2_0_prod.access_ruptures_commandes_details";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_ruptures_commandes_details ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_ruptures_commandes_details SELECT * FROM intranet_v2_0_prod.access_ruptures_commandes_details";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif LIKE intranet_v2_0_prod.access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif SELECT * FROM intranet_v2_0_prod.access_ruptures_donnees_CLIENTS_ARTICLES_Ruptures_motif";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_ruptures_export_code_langue ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_ruptures_export_code_langue";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_ruptures_export_code_langue ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_ruptures_export_code_langue LIKE intranet_v2_0_prod.access_ruptures_export_code_langue";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_ruptures_export_code_langue ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_ruptures_export_code_langue SELECT * FROM intranet_v2_0_prod.access_ruptures_export_code_langue";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_ruptures_export_libelles_etrangers ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_ruptures_export_libelles_etrangers";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_ruptures_export_libelles_etrangers ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_ruptures_export_libelles_etrangers LIKE intranet_v2_0_prod.access_ruptures_export_libelles_etrangers";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_ruptures_export_libelles_etrangers ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_ruptures_export_libelles_etrangers SELECT * FROM intranet_v2_0_prod.access_ruptures_export_libelles_etrangers";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_ruptures_suivi ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_ruptures_suivi";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_ruptures_suivi ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_ruptures_suivi LIKE intranet_v2_0_prod.access_ruptures_suivi";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_ruptures_suivi ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_ruptures_suivi SELECT * FROM intranet_v2_0_prod.access_ruptures_suivi";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_ruptures_type_manquant ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_ruptures_type_manquant";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_ruptures_type_manquant ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_ruptures_type_manquant LIKE intranet_v2_0_prod.access_ruptures_type_manquant";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_ruptures_type_manquant ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_ruptures_type_manquant SELECT * FROM intranet_v2_0_prod.access_ruptures_type_manquant";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_service_consommateur_ciliviltes ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_service_consommateur_ciliviltes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_ciliviltes ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_ciliviltes LIKE intranet_v2_0_prod.access_service_consommateur_ciliviltes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_service_consommateur_ciliviltes ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_service_consommateur_ciliviltes SELECT * FROM intranet_v2_0_prod.access_service_consommateur_ciliviltes";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_service_consommateur_consommateur ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_service_consommateur_consommateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_consommateur ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_consommateur LIKE intranet_v2_0_prod.access_service_consommateur_consommateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_service_consommateur_consommateur ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_service_consommateur_consommateur SELECT * FROM intranet_v2_0_prod.access_service_consommateur_consommateur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_service_consommateur_lettres_types ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_service_consommateur_lettres_types";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_lettres_types ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_lettres_types LIKE intranet_v2_0_prod.access_service_consommateur_lettres_types";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_service_consommateur_lettres_types ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_service_consommateur_lettres_types SELECT * FROM intranet_v2_0_prod.access_service_consommateur_lettres_types";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_service_consommateur_liste_diffusion ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_service_consommateur_liste_diffusion";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_liste_diffusion ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_liste_diffusion LIKE intranet_v2_0_prod.access_service_consommateur_liste_diffusion";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_service_consommateur_liste_diffusion ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_service_consommateur_liste_diffusion SELECT * FROM intranet_v2_0_prod.access_service_consommateur_liste_diffusion";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_service_consommateur_mesure_corrective ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_service_consommateur_mesure_corrective";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_mesure_corrective ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_mesure_corrective LIKE intranet_v2_0_prod.access_service_consommateur_mesure_corrective";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_service_consommateur_mesure_corrective ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_service_consommateur_mesure_corrective SELECT * FROM intranet_v2_0_prod.access_service_consommateur_mesure_corrective";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_service_consommateur_niveau_gravite ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_service_consommateur_niveau_gravite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_niveau_gravite ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_niveau_gravite LIKE intranet_v2_0_prod.access_service_consommateur_niveau_gravite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_service_consommateur_niveau_gravite ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_service_consommateur_niveau_gravite SELECT * FROM intranet_v2_0_prod.access_service_consommateur_niveau_gravite";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_service_consommateur_reclamations ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_service_consommateur_reclamations";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_reclamations ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_reclamations LIKE intranet_v2_0_prod.access_service_consommateur_reclamations";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_service_consommateur_reclamations ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_service_consommateur_reclamations SELECT * FROM intranet_v2_0_prod.access_service_consommateur_reclamations";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_service_consommateur_statistiques_articles ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_service_consommateur_statistiques_articles";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_statistiques_articles ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_statistiques_articles LIKE intranet_v2_0_prod.access_service_consommateur_statistiques_articles";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_service_consommateur_statistiques_articles ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_service_consommateur_statistiques_articles SELECT * FROM intranet_v2_0_prod.access_service_consommateur_statistiques_articles";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_service_consommateur_typologies ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_service_consommateur_typologies";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_typologies ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_service_consommateur_typologies LIKE intranet_v2_0_prod.access_service_consommateur_typologies";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_service_consommateur_typologies ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_service_consommateur_typologies SELECT * FROM intranet_v2_0_prod.access_service_consommateur_typologies";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.access_type_de_facturation ...";
$sql = "DROP TABLE intranet_v3_0_dev.access_type_de_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.access_type_de_facturation ...";
$sql = "CREATE TABLE intranet_v3_0_dev.access_type_de_facturation LIKE intranet_v2_0_prod.access_type_de_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.access_type_de_facturation ...";
$sql = "INSERT INTO intranet_v3_0_dev.access_type_de_facturation SELECT * FROM intranet_v2_0_prod.access_type_de_facturation";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.actiavaris ...";
$sql = "DROP TABLE intranet_v3_0_dev.actiavaris";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.actiavaris ...";
$sql = "CREATE TABLE intranet_v3_0_dev.actiavaris LIKE intranet_v2_0_prod.actiavaris";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.actiavaris ...";
$sql = "INSERT INTO intranet_v3_0_dev.actiavaris SELECT * FROM intranet_v2_0_prod.actiavaris";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.actijour ...";
$sql = "DROP TABLE intranet_v3_0_dev.actijour";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.actijour ...";
$sql = "CREATE TABLE intranet_v3_0_dev.actijour LIKE intranet_v2_0_prod.actijour";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.actijour ...";
$sql = "INSERT INTO intranet_v3_0_dev.actijour SELECT * FROM intranet_v2_0_prod.actijour";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.actijour_arch ...";
$sql = "DROP TABLE intranet_v3_0_dev.actijour_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.actijour_arch ...";
$sql = "CREATE TABLE intranet_v3_0_dev.actijour_arch LIKE intranet_v2_0_prod.actijour_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.actijour_arch ...";
$sql = "INSERT INTO intranet_v3_0_dev.actijour_arch SELECT * FROM intranet_v2_0_prod.actijour_arch";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.actijour_site ...";
$sql = "DROP TABLE intranet_v3_0_dev.actijour_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.actijour_site ...";
$sql = "CREATE TABLE intranet_v3_0_dev.actijour_site LIKE intranet_v2_0_prod.actijour_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.actijour_site ...";
$sql = "INSERT INTO intranet_v3_0_dev.actijour_site SELECT * FROM intranet_v2_0_prod.actijour_site";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.actijour_site_arch ...";
$sql = "DROP TABLE intranet_v3_0_dev.actijour_site_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.actijour_site_arch ...";
$sql = "CREATE TABLE intranet_v3_0_dev.actijour_site_arch LIKE intranet_v2_0_prod.actijour_site_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.actijour_site_arch ...";
$sql = "INSERT INTO intranet_v3_0_dev.actijour_site_arch SELECT * FROM intranet_v2_0_prod.actijour_site_arch";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.actisem ...";
$sql = "DROP TABLE intranet_v3_0_dev.actisem";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.actisem ...";
$sql = "CREATE TABLE intranet_v3_0_dev.actisem LIKE intranet_v2_0_prod.actisem";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.actisem ...";
$sql = "INSERT INTO intranet_v3_0_dev.actisem SELECT * FROM intranet_v2_0_prod.actisem";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.actisem_site ...";
$sql = "DROP TABLE intranet_v3_0_dev.actisem_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.actisem_site ...";
$sql = "CREATE TABLE intranet_v3_0_dev.actisem_site LIKE intranet_v2_0_prod.actisem_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.actisem_site ...";
$sql = "INSERT INTO intranet_v3_0_dev.actisem_site SELECT * FROM intranet_v2_0_prod.actisem_site";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.actitempo ...";
$sql = "DROP TABLE intranet_v3_0_dev.actitempo";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.actitempo ...";
$sql = "CREATE TABLE intranet_v3_0_dev.actitempo LIKE intranet_v2_0_prod.actitempo";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.actitempo ...";
$sql = "INSERT INTO intranet_v3_0_dev.actitempo SELECT * FROM intranet_v2_0_prod.actitempo";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.activite ...";
$sql = "DROP TABLE intranet_v3_0_dev.activite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.activite ...";
$sql = "CREATE TABLE intranet_v3_0_dev.activite LIKE intranet_v2_0_prod.activite";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.activite ...";
$sql = "INSERT INTO intranet_v3_0_dev.activite SELECT * FROM intranet_v2_0_prod.activite";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.analyse_log_internet ...";
$sql = "DROP TABLE intranet_v3_0_dev.analyse_log_internet";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.analyse_log_internet ...";
$sql = "CREATE TABLE intranet_v3_0_dev.analyse_log_internet LIKE intranet_v2_0_prod.analyse_log_internet";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.analyse_log_internet ...";
$sql = "INSERT INTO intranet_v3_0_dev.analyse_log_internet SELECT * FROM intranet_v2_0_prod.analyse_log_internet";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.analyse_log_internet_arch ...";
$sql = "DROP TABLE intranet_v3_0_dev.analyse_log_internet_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.analyse_log_internet_arch ...";
$sql = "CREATE TABLE intranet_v3_0_dev.analyse_log_internet_arch LIKE intranet_v2_0_prod.analyse_log_internet_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.analyse_log_internet_arch ...";
$sql = "INSERT INTO intranet_v3_0_dev.analyse_log_internet_arch SELECT * FROM intranet_v2_0_prod.analyse_log_internet_arch";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.analyse_log_internet_duree ...";
$sql = "DROP TABLE intranet_v3_0_dev.analyse_log_internet_duree";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.analyse_log_internet_duree ...";
$sql = "CREATE TABLE intranet_v3_0_dev.analyse_log_internet_duree LIKE intranet_v2_0_prod.analyse_log_internet_duree";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.analyse_log_internet_duree ...";
$sql = "INSERT INTO intranet_v3_0_dev.analyse_log_internet_duree SELECT * FROM intranet_v2_0_prod.analyse_log_internet_duree";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.analyse_log_internet_duree_arch ...";
$sql = "DROP TABLE intranet_v3_0_dev.analyse_log_internet_duree_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.analyse_log_internet_duree_arch ...";
$sql = "CREATE TABLE intranet_v3_0_dev.analyse_log_internet_duree_arch LIKE intranet_v2_0_prod.analyse_log_internet_duree_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.analyse_log_internet_duree_arch ...";
$sql = "INSERT INTO intranet_v3_0_dev.analyse_log_internet_duree_arch SELECT * FROM intranet_v2_0_prod.analyse_log_internet_duree_arch";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.analyse_log_messagerie ...";
$sql = "DROP TABLE intranet_v3_0_dev.analyse_log_messagerie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.analyse_log_messagerie ...";
$sql = "CREATE TABLE intranet_v3_0_dev.analyse_log_messagerie LIKE intranet_v2_0_prod.analyse_log_messagerie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.analyse_log_messagerie ...";
$sql = "INSERT INTO intranet_v3_0_dev.analyse_log_messagerie SELECT * FROM intranet_v2_0_prod.analyse_log_messagerie";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.analyse_log_messagerie_arch ...";
$sql = "DROP TABLE intranet_v3_0_dev.analyse_log_messagerie_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.analyse_log_messagerie_arch ...";
$sql = "CREATE TABLE intranet_v3_0_dev.analyse_log_messagerie_arch LIKE intranet_v2_0_prod.analyse_log_messagerie_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.analyse_log_messagerie_arch ...";
$sql = "INSERT INTO intranet_v3_0_dev.analyse_log_messagerie_arch SELECT * FROM intranet_v2_0_prod.analyse_log_messagerie_arch";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.analyse_log_num_tel ...";
$sql = "DROP TABLE intranet_v3_0_dev.analyse_log_num_tel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.analyse_log_num_tel ...";
$sql = "CREATE TABLE intranet_v3_0_dev.analyse_log_num_tel LIKE intranet_v2_0_prod.analyse_log_num_tel";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.analyse_log_num_tel ...";
$sql = "INSERT INTO intranet_v3_0_dev.analyse_log_num_tel SELECT * FROM intranet_v2_0_prod.analyse_log_num_tel";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.analyse_log_telephonie ...";
$sql = "DROP TABLE intranet_v3_0_dev.analyse_log_telephonie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.analyse_log_telephonie ...";
$sql = "CREATE TABLE intranet_v3_0_dev.analyse_log_telephonie LIKE intranet_v2_0_prod.analyse_log_telephonie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.analyse_log_telephonie ...";
$sql = "INSERT INTO intranet_v3_0_dev.analyse_log_telephonie SELECT * FROM intranet_v2_0_prod.analyse_log_telephonie";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.analyse_log_telephonie_arch ...";
$sql = "DROP TABLE intranet_v3_0_dev.analyse_log_telephonie_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.analyse_log_telephonie_arch ...";
$sql = "CREATE TABLE intranet_v3_0_dev.analyse_log_telephonie_arch LIKE intranet_v2_0_prod.analyse_log_telephonie_arch";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.analyse_log_telephonie_arch ...";
$sql = "INSERT INTO intranet_v3_0_dev.analyse_log_telephonie_arch SELECT * FROM intranet_v2_0_prod.analyse_log_telephonie_arch";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.client ...";
$sql = "DROP TABLE intranet_v3_0_dev.client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.client ...";
$sql = "CREATE TABLE intranet_v3_0_dev.client LIKE intranet_v2_0_prod.client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.client ...";
$sql = "INSERT INTO intranet_v3_0_dev.client SELECT * FROM intranet_v2_0_prod.client";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.codesoft_superviseur ...";
$sql = "DROP TABLE intranet_v3_0_dev.codesoft_superviseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.codesoft_superviseur ...";
$sql = "CREATE TABLE intranet_v3_0_dev.codesoft_superviseur LIKE intranet_v2_0_prod.codesoft_superviseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.codesoft_superviseur ...";
$sql = "INSERT INTO intranet_v3_0_dev.codesoft_superviseur SELECT * FROM intranet_v2_0_prod.codesoft_superviseur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.comment ...";
$sql = "DROP TABLE intranet_v3_0_dev.comment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.comment ...";
$sql = "CREATE TABLE intranet_v3_0_dev.comment LIKE intranet_v2_0_prod.comment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.comment ...";
$sql = "INSERT INTO intranet_v3_0_dev.comment SELECT * FROM intranet_v2_0_prod.comment";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.compos ...";
$sql = "DROP TABLE intranet_v3_0_dev.compos";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.compos ...";
$sql = "CREATE TABLE intranet_v3_0_dev.compos LIKE intranet_v2_0_prod.compos";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.compos ...";
$sql = "INSERT INTO intranet_v3_0_dev.compos SELECT * FROM intranet_v2_0_prod.compos";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.composa ...";
$sql = "DROP TABLE intranet_v3_0_dev.composa";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.composa ...";
$sql = "CREATE TABLE intranet_v3_0_dev.composa LIKE intranet_v2_0_prod.composa";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.composa ...";
$sql = "INSERT INTO intranet_v3_0_dev.composa SELECT * FROM intranet_v2_0_prod.composa";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.composv ...";
$sql = "DROP TABLE intranet_v3_0_dev.composv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.composv ...";
$sql = "CREATE TABLE intranet_v3_0_dev.composv LIKE intranet_v2_0_prod.composv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.composv ...";
$sql = "INSERT INTO intranet_v3_0_dev.composv SELECT * FROM intranet_v2_0_prod.composv";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.conserv ...";
$sql = "DROP TABLE intranet_v3_0_dev.conserv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.conserv ...";
$sql = "CREATE TABLE intranet_v3_0_dev.conserv LIKE intranet_v2_0_prod.conserv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.conserv ...";
$sql = "INSERT INTO intranet_v3_0_dev.conserv SELECT * FROM intranet_v2_0_prod.conserv";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.conserva ...";
$sql = "DROP TABLE intranet_v3_0_dev.conserva";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.conserva ...";
$sql = "CREATE TABLE intranet_v3_0_dev.conserva LIKE intranet_v2_0_prod.conserva";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.conserva ...";
$sql = "INSERT INTO intranet_v3_0_dev.conserva SELECT * FROM intranet_v2_0_prod.conserva";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.conservv ...";
$sql = "DROP TABLE intranet_v3_0_dev.conservv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.conservv ...";
$sql = "CREATE TABLE intranet_v3_0_dev.conservv LIKE intranet_v2_0_prod.conservv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.conservv ...";
$sql = "INSERT INTO intranet_v3_0_dev.conservv SELECT * FROM intranet_v2_0_prod.conservv";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.datasync_serveur ...";
$sql = "DROP TABLE intranet_v3_0_dev.datasync_serveur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.datasync_serveur ...";
$sql = "CREATE TABLE intranet_v3_0_dev.datasync_serveur LIKE intranet_v2_0_prod.datasync_serveur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.datasync_serveur ...";
$sql = "INSERT INTO intranet_v3_0_dev.datasync_serveur SELECT * FROM intranet_v2_0_prod.datasync_serveur";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.datasync_transfert ...";
$sql = "DROP TABLE intranet_v3_0_dev.datasync_transfert";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.datasync_transfert ...";
$sql = "CREATE TABLE intranet_v3_0_dev.datasync_transfert LIKE intranet_v2_0_prod.datasync_transfert";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.datasync_transfert ...";
$sql = "INSERT INTO intranet_v3_0_dev.datasync_transfert SELECT * FROM intranet_v2_0_prod.datasync_transfert";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.diffusion ...";
$sql = "DROP TABLE intranet_v3_0_dev.diffusion";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.diffusion ...";
$sql = "CREATE TABLE intranet_v3_0_dev.diffusion LIKE intranet_v2_0_prod.diffusion";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.diffusion ...";
$sql = "INSERT INTO intranet_v3_0_dev.diffusion SELECT * FROM intranet_v2_0_prod.diffusion";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.divers ...";
$sql = "DROP TABLE intranet_v3_0_dev.divers";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.divers ...";
$sql = "CREATE TABLE intranet_v3_0_dev.divers LIKE intranet_v2_0_prod.divers";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.divers ...";
$sql = "INSERT INTO intranet_v3_0_dev.divers SELECT * FROM intranet_v2_0_prod.divers";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.diversa ...";
$sql = "DROP TABLE intranet_v3_0_dev.diversa";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.diversa ...";
$sql = "CREATE TABLE intranet_v3_0_dev.diversa LIKE intranet_v2_0_prod.diversa";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.diversa ...";
$sql = "INSERT INTO intranet_v3_0_dev.diversa SELECT * FROM intranet_v2_0_prod.diversa";
if(mysql_query($sql)) { echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.diversv ...";
$sql = "DROP TABLE intranet_v3_0_dev.diversv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.diversv ...";
$sql = "CREATE TABLE intranet_v3_0_dev.diversv LIKE intranet_v2_0_prod.diversv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.diversv ...";
$sql = "INSERT INTO intranet_v3_0_dev.diversv SELECT * FROM intranet_v2_0_prod.diversv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.enseigne ...";
$sql = "DROP TABLE intranet_v3_0_dev.enseigne";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.enseigne ...";
$sql = "CREATE TABLE intranet_v3_0_dev.enseigne LIKE intranet_v2_0_prod.enseigne";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.enseigne ...";
$sql = "INSERT INTO intranet_v3_0_dev.enseigne SELECT * FROM intranet_v2_0_prod.enseigne";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.famille ...";
$sql = "DROP TABLE intranet_v3_0_dev.famille";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.famille ...";
$sql = "CREATE TABLE intranet_v3_0_dev.famille LIKE intranet_v2_0_prod.famille";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.famille ...";
$sql = "INSERT INTO intranet_v3_0_dev.famille SELECT * FROM intranet_v2_0_prod.famille";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_palettisation ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_palettisation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_palettisation ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_palettisation LIKE intranet_v2_0_prod.fta_palettisation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_palettisation ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_palettisation SELECT * FROM intranet_v2_0_prod.fta_palettisation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.gamme ...";
$sql = "DROP TABLE intranet_v3_0_dev.gamme";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.gamme ...";
$sql = "CREATE TABLE intranet_v3_0_dev.gamme LIKE intranet_v2_0_prod.gamme";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.gamme ...";
$sql = "INSERT INTO intranet_v3_0_dev.gamme SELECT * FROM intranet_v2_0_prod.gamme";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.gamstat ...";
$sql = "DROP TABLE intranet_v3_0_dev.gamstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.gamstat ...";
$sql = "CREATE TABLE intranet_v3_0_dev.gamstat LIKE intranet_v2_0_prod.gamstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.gamstat ...";
$sql = "INSERT INTO intranet_v3_0_dev.gamstat SELECT * FROM intranet_v2_0_prod.gamstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.indicateur_productivite_unite_temps ...";
$sql = "DROP TABLE intranet_v3_0_dev.indicateur_productivite_unite_temps";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.indicateur_productivite_unite_temps ...";
$sql = "CREATE TABLE intranet_v3_0_dev.indicateur_productivite_unite_temps LIKE intranet_v2_0_prod.indicateur_productivite_unite_temps";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.indicateur_productivite_unite_temps ...";
$sql = "INSERT INTO intranet_v3_0_dev.indicateur_productivite_unite_temps SELECT * FROM intranet_v2_0_prod.indicateur_productivite_unite_temps";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.infog ...";
$sql = "DROP TABLE intranet_v3_0_dev.infog";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.infog ...";
$sql = "CREATE TABLE intranet_v3_0_dev.infog LIKE intranet_v2_0_prod.infog";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.infog ...";
$sql = "INSERT INTO intranet_v3_0_dev.infog SELECT * FROM intranet_v2_0_prod.infog";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.infoga ...";
$sql = "DROP TABLE intranet_v3_0_dev.infoga";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.infoga ...";
$sql = "CREATE TABLE intranet_v3_0_dev.infoga LIKE intranet_v2_0_prod.infoga";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.infoga ...";
$sql = "INSERT INTO intranet_v3_0_dev.infoga SELECT * FROM intranet_v2_0_prod.infoga";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.infogv ...";
$sql = "DROP TABLE intranet_v3_0_dev.infogv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.infogv ...";
$sql = "CREATE TABLE intranet_v3_0_dev.infogv LIKE intranet_v2_0_prod.infogv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.infogv ...";
$sql = "INSERT INTO intranet_v3_0_dev.infogv SELECT * FROM intranet_v2_0_prod.infogv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.intranet_niveau_acces ...";
$sql = "DROP TABLE intranet_v3_0_dev.intranet_niveau_acces";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.intranet_niveau_acces ...";
$sql = "CREATE TABLE intranet_v3_0_dev.intranet_niveau_acces LIKE intranet_v2_0_prod.intranet_niveau_acces";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.intranet_niveau_acces ...";
$sql = "INSERT INTO intranet_v3_0_dev.intranet_niveau_acces SELECT * FROM intranet_v2_0_prod.intranet_niveau_acces";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.intranet_password ...";
$sql = "DROP TABLE intranet_v3_0_dev.intranet_password";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.intranet_password ...";
$sql = "CREATE TABLE intranet_v3_0_dev.intranet_password LIKE intranet_v2_0_prod.intranet_password";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.intranet_password ...";
$sql = "INSERT INTO intranet_v3_0_dev.intranet_password SELECT * FROM intranet_v2_0_prod.intranet_password";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.logft ...";
$sql = "DROP TABLE intranet_v3_0_dev.logft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.logft ...";
$sql = "CREATE TABLE intranet_v3_0_dev.logft LIKE intranet_v2_0_prod.logft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.logft ...";
$sql = "INSERT INTO intranet_v3_0_dev.logft SELECT * FROM intranet_v2_0_prod.logft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.lustat ...";
$sql = "DROP TABLE intranet_v3_0_dev.lustat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.lustat ...";
$sql = "CREATE TABLE intranet_v3_0_dev.lustat LIKE intranet_v2_0_prod.lustat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.lustat ...";
$sql = "INSERT INTO intranet_v3_0_dev.lustat SELECT * FROM intranet_v2_0_prod.lustat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere LIKE intranet_v2_0_prod.matiere_premiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere SELECT * FROM intranet_v2_0_prod.matiere_premiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_caracteristique_scientifique ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_caracteristique_scientifique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_caracteristique_scientifique ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_caracteristique_scientifique LIKE intranet_v2_0_prod.matiere_premiere_caracteristique_scientifique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_caracteristique_scientifique ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_caracteristique_scientifique SELECT * FROM intranet_v2_0_prod.matiere_premiere_caracteristique_scientifique";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_caracteristique_scientifique_filiere ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_caracteristique_scientifique_filiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_caracteristique_scientifique_filiere ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_caracteristique_scientifique_filiere LIKE intranet_v2_0_prod.matiere_premiere_caracteristique_scientifique_filiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_caracteristique_scientifique_filiere ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_caracteristique_scientifique_filiere SELECT * FROM intranet_v2_0_prod.matiere_premiere_caracteristique_scientifique_filiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_client ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_client ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_client LIKE intranet_v2_0_prod.matiere_premiere_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_client ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_client SELECT * FROM intranet_v2_0_prod.matiere_premiere_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_client_regroupement ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_client_regroupement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_client_regroupement ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_client_regroupement LIKE intranet_v2_0_prod.matiere_premiere_client_regroupement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_client_regroupement ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_client_regroupement SELECT * FROM intranet_v2_0_prod.matiere_premiere_client_regroupement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_composant ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_composant";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant LIKE intranet_v2_0_prod.matiere_premiere_composant";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_composant ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_composant SELECT * FROM intranet_v2_0_prod.matiere_premiere_composant";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_composant_allergene ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_composant_allergene";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_allergene ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_allergene LIKE intranet_v2_0_prod.matiere_premiere_composant_allergene";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_allergene ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_allergene SELECT * FROM intranet_v2_0_prod.matiere_premiere_composant_allergene";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_composant_arome_categorie ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_composant_arome_categorie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_arome_categorie ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_arome_categorie LIKE intranet_v2_0_prod.matiere_premiere_composant_arome_categorie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_arome_categorie ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_arome_categorie SELECT * FROM intranet_v2_0_prod.matiere_premiere_composant_arome_categorie";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_composant_groupe ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_composant_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_groupe ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_groupe LIKE intranet_v2_0_prod.matiere_premiere_composant_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_groupe ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_groupe SELECT * FROM intranet_v2_0_prod.matiere_premiere_composant_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_composant_nature ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_composant_nature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_nature ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_nature LIKE intranet_v2_0_prod.matiere_premiere_composant_nature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_nature ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_nature SELECT * FROM intranet_v2_0_prod.matiere_premiere_composant_nature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_composant_origine ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_composant_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_origine ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_origine LIKE intranet_v2_0_prod.matiere_premiere_composant_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_origine ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_origine SELECT * FROM intranet_v2_0_prod.matiere_premiere_composant_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_composant_regroupement_advitium ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_composant_regroupement_advitium";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_regroupement_advitium ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_regroupement_advitium LIKE intranet_v2_0_prod.matiere_premiere_composant_regroupement_advitium";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_regroupement_advitium ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_regroupement_advitium SELECT * FROM intranet_v2_0_prod.matiere_premiere_composant_regroupement_advitium";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_composant_template ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_composant_template";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_template ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_composant_template LIKE intranet_v2_0_prod.matiere_premiere_composant_template";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_template ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_composant_template SELECT * FROM intranet_v2_0_prod.matiere_premiere_composant_template";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_conditionnement ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_conditionnement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_conditionnement ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_conditionnement LIKE intranet_v2_0_prod.matiere_premiere_conditionnement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_conditionnement ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_conditionnement SELECT * FROM intranet_v2_0_prod.matiere_premiere_conditionnement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_contaminant ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_contaminant";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_contaminant ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_contaminant LIKE intranet_v2_0_prod.matiere_premiere_contaminant";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_contaminant ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_contaminant SELECT * FROM intranet_v2_0_prod.matiere_premiere_contaminant";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_contaminant_association ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_contaminant_association";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_contaminant_association ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_contaminant_association LIKE intranet_v2_0_prod.matiere_premiere_contaminant_association";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_contaminant_association ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_contaminant_association SELECT * FROM intranet_v2_0_prod.matiere_premiere_contaminant_association";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_contamination_croisee ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_contamination_croisee";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_contamination_croisee ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_contamination_croisee LIKE intranet_v2_0_prod.matiere_premiere_contamination_croisee";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_contamination_croisee ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_contamination_croisee  SELECT * FROM intranet_v2_0_prod.matiere_premiere_contamination_croisee";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_etat ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_etat ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_etat LIKE intranet_v2_0_prod.matiere_premiere_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_etat ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_etat SELECT * FROM intranet_v2_0_prod.matiere_premiere_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_ethique_client ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_ethique_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_ethique_client ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_ethique_client LIKE intranet_v2_0_prod.matiere_premiere_ethique_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_ethique_client ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_ethique_client SELECT * FROM intranet_v2_0_prod.matiere_premiere_ethique_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_filiere ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_filiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_filiere ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_filiere LIKE intranet_v2_0_prod.matiere_premiere_filiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_filiere ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_filiere SELECT * FROM intranet_v2_0_prod.matiere_premiere_filiere";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_fournisseur ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_fournisseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_fournisseur ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_fournisseur LIKE intranet_v2_0_prod.matiere_premiere_fournisseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_fournisseur ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_fournisseur SELECT * FROM intranet_v2_0_prod.matiere_premiere_fournisseur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_nature ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_nature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_nature ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_nature LIKE intranet_v2_0_prod.matiere_premiere_nature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_nature ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_nature SELECT * FROM intranet_v2_0_prod.matiere_premiere_nature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_origine ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_origine ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_origine LIKE intranet_v2_0_prod.matiere_premiere_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_origine ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_origine SELECT * FROM intranet_v2_0_prod.matiere_premiere_origine";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_origine_cycle ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_origine_cycle";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_origine_cycle ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_origine_cycle LIKE intranet_v2_0_prod.matiere_premiere_origine_cycle";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_origine_cycle ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_origine_cycle SELECT * FROM intranet_v2_0_prod.matiere_premiere_origine_cycle";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_origine_peche ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_origine_peche";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_origine_peche ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_origine_peche LIKE intranet_v2_0_prod.matiere_premiere_origine_peche";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_origine_peche ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_origine_peche SELECT * FROM intranet_v2_0_prod.matiere_premiere_origine_peche";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_origine_speciale ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_origine_speciale";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_origine_speciale ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_origine_speciale LIKE intranet_v2_0_prod.matiere_premiere_origine_speciale";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_origine_speciale ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_origine_speciale SELECT * FROM intranet_v2_0_prod.matiere_premiere_origine_speciale";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_surgelation ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_surgelation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_surgelation ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_surgelation LIKE intranet_v2_0_prod.matiere_premiere_surgelation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_surgelation ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_surgelation SELECT * FROM intranet_v2_0_prod.matiere_premiere_surgelation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_transition ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_transition";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_transition ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_transition LIKE intranet_v2_0_prod.matiere_premiere_transition";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_transition ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_transition SELECT * FROM intranet_v2_0_prod.matiere_premiere_transition";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.matiere_premiere_zone_fao ...";
$sql = "DROP TABLE intranet_v3_0_dev.matiere_premiere_zone_fao";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.matiere_premiere_zone_fao ...";
$sql = "CREATE TABLE intranet_v3_0_dev.matiere_premiere_zone_fao LIKE intranet_v2_0_prod.matiere_premiere_zone_fao";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.matiere_premiere_zone_fao ...";
$sql = "INSERT INTO intranet_v3_0_dev.matiere_premiere_zone_fao SELECT * FROM intranet_v2_0_prod.matiere_premiere_zone_fao";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.navservavaris ...";
$sql = "DROP TABLE intranet_v3_0_dev.navservavaris";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.navservavaris ...";
$sql = "CREATE TABLE intranet_v3_0_dev.navservavaris LIKE intranet_v2_0_prod.navservavaris";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.navservavaris ...";
$sql = "INSERT INTO intranet_v3_0_dev.navservavaris SELECT * FROM intranet_v2_0_prod.navservavaris";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.navstat ...";
$sql = "DROP TABLE intranet_v3_0_dev.navstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.navstat ...";
$sql = "CREATE TABLE intranet_v3_0_dev.navstat LIKE intranet_v2_0_prod.navstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.navstat ...";
$sql = "INSERT INTO intranet_v3_0_dev.navstat SELECT * FROM intranet_v2_0_prod.navstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.navstatavaris ...";
$sql = "DROP TABLE intranet_v3_0_dev.navstatavaris";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.navstatavaris ...";
$sql = "CREATE TABLE intranet_v3_0_dev.navstatavaris LIKE intranet_v2_0_prod.navstatavaris";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.navstatavaris ...";
$sql = "INSERT INTO intranet_v3_0_dev.navstatavaris SELECT * FROM intranet_v2_0_prod.navstatavaris";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.netlog_log ...";
$sql = "DROP TABLE intranet_v3_0_dev.netlog_log";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.netlog_log ...";
$sql = "CREATE TABLE intranet_v3_0_dev.netlog_log LIKE intranet_v2_0_prod.netlog_log";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.netlog_log ...";
$sql = "INSERT INTO intranet_v3_0_dev.netlog_log SELECT * FROM intranet_v2_0_prod.netlog_log";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.newsdefil ...";
$sql = "DROP TABLE intranet_v3_0_dev.newsdefil";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.newsdefil ...";
$sql = "CREATE TABLE intranet_v3_0_dev.newsdefil LIKE intranet_v2_0_prod.newsdefil";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.newsdefil ...";
$sql = "INSERT INTO intranet_v3_0_dev.newsdefil SELECT * FROM intranet_v2_0_prod.newsdefil";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.palet ...";
$sql = "DROP TABLE intranet_v3_0_dev.palet";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.palet ...";
$sql = "CREATE TABLE intranet_v3_0_dev.palet LIKE intranet_v2_0_prod.palet";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.palet ...";
$sql = "INSERT INTO intranet_v3_0_dev.palet SELECT * FROM intranet_v2_0_prod.palet";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.paleta ...";
$sql = "DROP TABLE intranet_v3_0_dev.paleta";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.paleta ...";
$sql = "CREATE TABLE intranet_v3_0_dev.paleta LIKE intranet_v2_0_prod.paleta";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.paleta ...";
$sql = "INSERT INTO intranet_v3_0_dev.paleta SELECT * FROM intranet_v2_0_prod.paleta";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.paletv ...";
$sql = "DROP TABLE intranet_v3_0_dev.paletv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.paletv ...";
$sql = "CREATE TABLE intranet_v3_0_dev.paletv LIKE intranet_v2_0_prod.paletv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.paletv ...";
$sql = "INSERT INTO intranet_v3_0_dev.paletv SELECT * FROM intranet_v2_0_prod.paletv";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.perso ...";
$sql = "DROP TABLE intranet_v3_0_dev.perso";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.perso ...";
$sql = "CREATE TABLE intranet_v3_0_dev.perso LIKE intranet_v2_0_prod.perso";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.perso ...";
$sql = "INSERT INTO intranet_v3_0_dev.perso SELECT * FROM intranet_v2_0_prod.perso";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.publicateur ...";
$sql = "DROP TABLE intranet_v3_0_dev.publicateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.publicateur ...";
$sql = "CREATE TABLE intranet_v3_0_dev.publicateur LIKE intranet_v2_0_prod.publicateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.publicateur ...";
$sql = "INSERT INTO intranet_v3_0_dev.publicateur SELECT * FROM intranet_v2_0_prod.publicateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.save_client ...";
$sql = "DROP TABLE intranet_v3_0_dev.save_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.save_client ...";
$sql = "CREATE TABLE intranet_v3_0_dev.save_client LIKE intranet_v2_0_prod.save_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.save_client ...";
$sql = "INSERT INTO intranet_v3_0_dev.save_client SELECT * FROM intranet_v2_0_prod.save_client";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.segment ...";
$sql = "DROP TABLE intranet_v3_0_dev.segment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.segment ...";
$sql = "CREATE TABLE intranet_v3_0_dev.segment LIKE intranet_v2_0_prod.segment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.segment ...";
$sql = "INSERT INTO intranet_v3_0_dev.segment SELECT * FROM intranet_v2_0_prod.segment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.segstat ...";
$sql = "DROP TABLE intranet_v3_0_dev.segstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.segstat ...";
$sql = "CREATE TABLE intranet_v3_0_dev.segstat LIKE intranet_v2_0_prod.segstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.segstat ...";
$sql = "INSERT INTO intranet_v3_0_dev.segstat SELECT * FROM intranet_v2_0_prod.segstat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.servicece ...";
$sql = "DROP TABLE intranet_v3_0_dev.servicece";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.servicece ...";
$sql = "CREATE TABLE intranet_v3_0_dev.servicece LIKE intranet_v2_0_prod.servicece";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.servicece ...";
$sql = "INSERT INTO intranet_v3_0_dev.servicece SELECT * FROM intranet_v2_0_prod.servicece";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.services ...";
$sql = "DROP TABLE intranet_v3_0_dev.services";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.services ...";
$sql = "CREATE TABLE intranet_v3_0_dev.services LIKE intranet_v2_0_prod.services";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.services ...";
$sql = "INSERT INTO intranet_v3_0_dev.services SELECT * FROM intranet_v2_0_prod.services";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.societe ...";
$sql = "DROP TABLE intranet_v3_0_dev.societe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.societe ...";
$sql = "CREATE TABLE intranet_v3_0_dev.societe LIKE intranet_v2_0_prod.societe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.societe ...";
$sql = "INSERT INTO intranet_v3_0_dev.societe SELECT * FROM intranet_v2_0_prod.societe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.stat_segment_site ...";
$sql = "DROP TABLE intranet_v3_0_dev.stat_segment_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.stat_segment_site ...";
$sql = "CREATE TABLE intranet_v3_0_dev.stat_segment_site LIKE intranet_v2_0_prod.stat_segment_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.stat_segment_site ...";
$sql = "INSERT INTO intranet_v3_0_dev.stat_segment_site SELECT * FROM intranet_v2_0_prod.stat_segment_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.types ...";
$sql = "DROP TABLE intranet_v3_0_dev.types";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.types ...";
$sql = "CREATE TABLE intranet_v3_0_dev.types LIKE intranet_v2_0_prod.types";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.types ...";
$sql = "INSERT INTO intranet_v3_0_dev.types SELECT * FROM intranet_v2_0_prod.types";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.valft ...";
$sql = "DROP TABLE intranet_v3_0_dev.valft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.valft ...";
$sql = "CREATE TABLE intranet_v3_0_dev.valft LIKE intranet_v2_0_prod.valft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.valft ...";
$sql = "INSERT INTO intranet_v3_0_dev.valft SELECT * FROM intranet_v2_0_prod.valft";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.words ...";
$sql = "DROP TABLE intranet_v3_0_dev.words";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.words ...";
$sql = "CREATE TABLE intranet_v3_0_dev.words LIKE intranet_v2_0_prod.words";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.words ...";
$sql = "INSERT INTO intranet_v3_0_dev.words SELECT * FROM intranet_v2_0_prod.words";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

}

/**
 * Création de tables de la V3
 */ 
if(FALSE){
 
echo "DROP intranet_v3_0_dev.fta_saisie_obligatoire ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_saisie_obligatoire";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_saisie_obligatoire ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_saisie_obligatoire LIKE intranet_v3_0_cod.fta_saisie_obligatoire";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_saisie_obligatoire ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_saisie_obligatoire SELECT * FROM intranet_v3_0_cod.fta_saisie_obligatoire";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.intranet_actions ...";
$sql = "DROP TABLE intranet_v3_0_dev.intranet_actions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.intranet_actions ...";
$sql = "CREATE TABLE intranet_v3_0_dev.intranet_actions LIKE intranet_v3_0_cod.intranet_actions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.intranet_actions ...";
$sql = "INSERT INTO intranet_v3_0_dev.intranet_actions SELECT * FROM intranet_v3_0_cod.intranet_actions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.intranet_modules ...";
$sql = "DROP TABLE intranet_v3_0_dev.intranet_modules";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.intranet_modules ...";
$sql = "CREATE TABLE intranet_v3_0_dev.intranet_modules LIKE intranet_v3_0_cod.intranet_modules";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.intranet_modules ...";
$sql = "INSERT INTO intranet_v3_0_dev.intranet_modules SELECT * FROM intranet_v3_0_cod.intranet_modules";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.intranet_moteur_de_recherche_type_de_champ ...";
$sql = "DROP TABLE intranet_v3_0_dev.intranet_moteur_de_recherche_type_de_champ";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.intranet_moteur_de_recherche_type_de_champ ...";
$sql = "CREATE TABLE intranet_v3_0_dev.intranet_moteur_de_recherche_type_de_champ LIKE intranet_v3_0_cod.intranet_moteur_de_recherche_type_de_champ";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.intranet_moteur_de_recherche_type_de_champ ...";
$sql = "INSERT INTO intranet_v3_0_dev.intranet_moteur_de_recherche_type_de_champ SELECT * FROM intranet_v3_0_cod.intranet_moteur_de_recherche_type_de_champ";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_chapitre ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_chapitre";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_chapitre ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_chapitre LIKE intranet_v3_0_cod.fta_chapitre";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_chapitre ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_chapitre SELECT * FROM intranet_v3_0_cod.fta_chapitre";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_etat ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_etat ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_etat LIKE intranet_v3_0_cod.fta_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_etat ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_etat SELECT * FROM intranet_v3_0_cod.fta_etat";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_processus_cycle ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_processus_cycle";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_processus_cycle ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_processus_cycle LIKE intranet_v3_0_cod.fta_processus_cycle";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_processus_cycle ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_processus_cycle SELECT * FROM intranet_v3_0_cod.fta_processus_cycle";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_processus ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_processus";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_processus ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_processus LIKE intranet_v3_0_cod.fta_processus";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_processus ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_processus SELECT * FROM intranet_v3_0_cod.fta_processus";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_transition ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_transition";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_transition ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_transition LIKE intranet_v3_0_cod.fta_transition";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_transition ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_transition SELECT * FROM intranet_v3_0_cod.fta_transition";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.extranets_table_des_liens ...";
$sql = "DROP TABLE intranet_v3_0_dev.extranets_table_des_liens";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.extranets_table_des_liens ...";
$sql = "CREATE TABLE intranet_v3_0_dev.extranets_table_des_liens LIKE intranet_v3_0_cod.extranets_table_des_liens";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.extranets_table_des_liens ...";
$sql = "INSERT INTO intranet_v3_0_dev.extranets_table_des_liens SELECT * FROM intranet_v3_0_cod.extranets_table_des_liens";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_migration_nomenclature ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_migration_nomenclature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_migration_nomenclature ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_migration_nomenclature LIKE intranet_v3_0_cod.fta_migration_nomenclature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_migration_nomenclature ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_migration_nomenclature SELECT * FROM intranet_v3_0_cod.fta_migration_nomenclature";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_migration_produit ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_migration_produit";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_migration_produit ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_migration_produit LIKE intranet_v3_0_cod.fta_migration_produit";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_migration_produit ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_migration_produit SELECT * FROM intranet_v3_0_cod.fta_migration_produit";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_moteur_de_recherche ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_moteur_de_recherche";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_moteur_de_recherche ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_moteur_de_recherche LIKE intranet_v3_0_cod.fta_moteur_de_recherche";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_moteur_de_recherche ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_moteur_de_recherche SELECT * FROM intranet_v3_0_cod.fta_moteur_de_recherche";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.annexe_service_consommateur ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_service_consommateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_service_consommateur ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_service_consommateur LIKE intranet_v3_0_cod.annexe_service_consommateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.annexe_service_consommateur ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_service_consommateur SELECT * FROM intranet_v3_0_cod.annexe_service_consommateur";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.annexe_unite_facturation ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_unite_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_unite_facturation ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_unite_facturation LIKE intranet_v3_0_cod.annexe_unite_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.annexe_unite_facturation ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_unite_facturation SELECT * FROM intranet_v3_0_cod.annexe_unite_facturation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.arcadia_atelier ...";
$sql = "DROP TABLE intranet_v3_0_dev.arcadia_atelier";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.arcadia_atelier ...";
$sql = "CREATE TABLE intranet_v3_0_dev.arcadia_atelier LIKE intranet_v3_0_cod.arcadia_atelier";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.arcadia_atelier ...";
$sql = "INSERT INTO intranet_v3_0_dev.arcadia_atelier SELECT * FROM intranet_v3_0_cod.arcadia_atelier";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.arcadia_client_circuit ...";
$sql = "DROP TABLE intranet_v3_0_dev.arcadia_client_circuit";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.arcadia_client_circuit ...";
$sql = "CREATE TABLE intranet_v3_0_dev.arcadia_client_circuit LIKE intranet_v3_0_cod.arcadia_client_circuit";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.arcadia_client_circuit ...";
$sql = "INSERT INTO intranet_v3_0_dev.arcadia_client_circuit SELECT * FROM intranet_v3_0_cod.arcadia_client_circuit";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.arcadia_client_reseau ...";
$sql = "DROP TABLE intranet_v3_0_dev.arcadia_client_reseau";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.arcadia_client_reseau ...";
$sql = "CREATE TABLE intranet_v3_0_dev.arcadia_client_reseau LIKE intranet_v3_0_cod.arcadia_client_reseau";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.arcadia_client_reseau ...";
$sql = "INSERT INTO intranet_v3_0_dev.arcadia_client_reseau SELECT * FROM intranet_v3_0_cod.arcadia_client_reseau";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.arcadia_client_reseau_segment_association ...";
$sql = "DROP TABLE intranet_v3_0_dev.arcadia_client_reseau_segment_association";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.arcadia_client_reseau_segment_association ...";
$sql = "CREATE TABLE intranet_v3_0_dev.arcadia_client_reseau_segment_association LIKE intranet_v3_0_cod.arcadia_client_reseau_segment_association";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.arcadia_client_reseau_segment_association ...";
$sql = "INSERT INTO intranet_v3_0_dev.arcadia_client_reseau_segment_association SELECT * FROM intranet_v3_0_cod.arcadia_client_reseau_segment_association";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.arcadia_client_segment ...";
$sql = "DROP TABLE intranet_v3_0_dev.arcadia_client_segment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.arcadia_client_segment ...";
$sql = "CREATE TABLE intranet_v3_0_dev.arcadia_client_segment LIKE intranet_v3_0_cod.arcadia_client_segment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.arcadia_client_segment ...";
$sql = "INSERT INTO intranet_v3_0_dev.arcadia_client_segment SELECT * FROM intranet_v3_0_cod.arcadia_client_segment";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.arcadia_emballage_type ...";
$sql = "DROP TABLE intranet_v3_0_dev.arcadia_emballage_type";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.arcadia_emballage_type ...";
$sql = "CREATE TABLE intranet_v3_0_dev.arcadia_emballage_type LIKE intranet_v3_0_cod.arcadia_emballage_type";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.arcadia_emballage_type ...";
$sql = "INSERT INTO intranet_v3_0_dev.arcadia_emballage_type SELECT * FROM intranet_v3_0_cod.arcadia_emballage_type";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.arcadia_maquette_etiquette ...";
$sql = "DROP TABLE intranet_v3_0_dev.arcadia_maquette_etiquette";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.arcadia_maquette_etiquette ...";
$sql = "CREATE TABLE intranet_v3_0_dev.arcadia_maquette_etiquette LIKE intranet_v3_0_cod.arcadia_maquette_etiquette";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.arcadia_maquette_etiquette ...";
$sql = "INSERT INTO intranet_v3_0_dev.arcadia_maquette_etiquette SELECT * FROM intranet_v3_0_cod.arcadia_maquette_etiquette";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.arcadia_poste ...";
$sql = "DROP TABLE intranet_v3_0_dev.arcadia_poste";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.arcadia_poste ...";
$sql = "CREATE TABLE intranet_v3_0_dev.arcadia_poste LIKE intranet_v3_0_cod.arcadia_poste";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.arcadia_poste ...";
$sql = "INSERT INTO intranet_v3_0_dev.arcadia_poste SELECT * FROM intranet_v3_0_cod.arcadia_poste";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.arcadia_site_groupe_production ...";
$sql = "DROP TABLE intranet_v3_0_dev.arcadia_site_groupe_production";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.arcadia_site_groupe_production ...";
$sql = "CREATE TABLE intranet_v3_0_dev.arcadia_site_groupe_production LIKE intranet_v3_0_cod.arcadia_site_groupe_production";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.arcadia_site_groupe_production ...";
$sql = "INSERT INTO intranet_v3_0_dev.arcadia_site_groupe_production SELECT * FROM intranet_v3_0_cod.arcadia_site_groupe_production";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.arcadia_type_calibre ...";
$sql = "DROP TABLE intranet_v3_0_dev.arcadia_type_calibre";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.arcadia_type_calibre ...";
$sql = "CREATE TABLE intranet_v3_0_dev.arcadia_type_calibre LIKE intranet_v3_0_cod.arcadia_type_calibre";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.arcadia_type_calibre ...";
$sql = "INSERT INTO intranet_v3_0_dev.arcadia_type_calibre SELECT * FROM intranet_v3_0_cod.arcadia_type_calibre";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.arcadia_type_conservation ...";
$sql = "DROP TABLE intranet_v3_0_dev.arcadia_type_conservation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.arcadia_type_conservation ...";
$sql = "CREATE TABLE intranet_v3_0_dev.arcadia_type_conservation LIKE intranet_v3_0_cod.arcadia_type_conservation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.arcadia_type_conservation ...";
$sql = "INSERT INTO intranet_v3_0_dev.arcadia_type_conservation SELECT * FROM intranet_v3_0_cod.arcadia_type_conservation";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_action_role ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_action_role";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_action_role ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_action_role LIKE intranet_v3_0_cod.fta_action_role";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_action_role ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_action_role SELECT * FROM intranet_v3_0_cod.fta_action_role";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_action_site ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_action_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_action_site ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_action_site LIKE intranet_v3_0_cod.fta_action_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_action_site ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_action_site SELECT * FROM intranet_v3_0_cod.fta_action_site";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_role ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_role";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_role ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_role LIKE intranet_v3_0_cod.fta_role";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_role ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_role SELECT * FROM intranet_v3_0_cod.fta_role";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_workflow ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_workflow";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_workflow ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_workflow LIKE intranet_v3_0_cod.fta_workflow";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_workflow ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_workflow SELECT * FROM intranet_v3_0_cod.fta_workflow";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.fta_workflow_structure ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_workflow_structure";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_workflow_structure ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_workflow_structure LIKE intranet_v3_0_cod.fta_workflow_structure";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_workflow_structure ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_workflow_structure SELECT * FROM intranet_v3_0_cod.fta_workflow_structure";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.intranet_column_info ...";
$sql = "DROP TABLE intranet_v3_0_dev.intranet_column_info";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.intranet_column_info ...";
$sql = "CREATE TABLE intranet_v3_0_dev.intranet_column_info LIKE intranet_v3_0_cod.intranet_column_info";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.intranet_column_info ...";
$sql = "INSERT INTO intranet_v3_0_dev.intranet_column_info SELECT * FROM intranet_v3_0_cod.intranet_column_info";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.annexe_gestion_des_etiquettes ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_gestion_des_etiquettes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_gestion_des_etiquettes ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_gestion_des_etiquettes LIKE intranet_v3_0_cod.annexe_gestion_des_etiquettes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.annexe_gestion_des_etiquettes ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_gestion_des_etiquettes SELECT * FROM intranet_v3_0_cod.annexe_gestion_des_etiquettes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}


}
/**
 * Nouvelles données du jours de la prod
 */
/**
 * Création des tables dépendant de id_user
 */

if(FALSE){
echo "DROP intranet_v3_0_dev.salaries ...";
$sql = "DROP TABLE intranet_v3_0_dev.salaries";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.salaries ...";
$sql = "CREATE TABLE intranet_v3_0_dev.salaries LIKE intranet_v3_0_cod.salaries";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.salaries ...";
$sql = "INSERT INTO intranet_v3_0_dev.salaries SELECT * FROM intranet_v2_0_prod.salaries";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}


echo "UPDATE intranet_v3_0_dev.salaries ...";
$sql = "UPDATE intranet_v3_0_dev.salaries SET prenom='Non définie', login='non_definie'"
        . " WHERE id_user=-1;";       
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
echo "INSERT INTO intranet_v3_0_dev.salaries Utilisateur supprimé ...";
$sql = "INSERT INTO `intranet_v3_0_dev`.`salaries` "
        . "(`id_user`, `ascendant_id_salaries`, `nom`, `prenom`, `date_creation_salaries`,"
        . " `id_catsopro`, `id_service`, `id_type`, `actif`, `libre2`, `libre3`, `libre4`,"
        . " `libre5`, `libre6`, `login`, `pass`, `mail`, `ecriture`, `membre_ce`, `lieu_geo`,"
        . " `newsdefil`, `blocage`, `portail_wiki_salaries`) "
        . "VALUES ('-2', '0', 'SYSTEM', 'Utilisateur supprimé', '" . date("Y-m-d") . "', '0',"
        . " '0', '0', 'oui', NULL, NULL, NULL, NULL, NULL, 'utilisateur_supprime',"
        . " NULL, NULL, 'oui', 'non', '', 'non', 'non', NULL); ";       
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.log ...";
$sql = "DROP TABLE intranet_v3_0_dev.log";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.log ...";
$sql = "CREATE TABLE intranet_v3_0_dev.log LIKE intranet_v3_0_cod.log";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.log ...";
$sql = " INSERT INTO intranet_v3_0_dev.log SELECT intranet_v2_0_prod.log.* 
             FROM intranet_v2_0_prod.log, intranet_v3_0_dev.salaries
             WHERE intranet_v2_0_prod.log.id_user = intranet_v3_0_dev.salaries.id_user";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.lu ...";
$sql = "DROP TABLE intranet_v3_0_dev.lu";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.lu ...";
$sql = "CREATE TABLE intranet_v3_0_dev.lu LIKE intranet_v2_0_prod.lu";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.lu ...";
$sql = " INSERT INTO intranet_v3_0_dev.lu SELECT intranet_v2_0_prod.lu.* 
             FROM intranet_v2_0_prod.lu, intranet_v3_0_dev.salaries
             WHERE intranet_v2_0_prod.lu.id_user = intranet_v3_0_dev.salaries.id_user";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.modes ...";
$sql = "DROP TABLE intranet_v3_0_dev.modes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.modes ...";
$sql = "CREATE TABLE intranet_v3_0_dev.modes LIKE intranet_v3_0_cod.modes";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.modes ...";
$sql = " INSERT INTO intranet_v3_0_dev.modes SELECT intranet_v2_0_prod.modes.* 
            FROM intranet_v2_0_prod.modes, intranet_v3_0_dev.salaries
            WHERE intranet_v2_0_prod.modes.id_user = intranet_v3_0_dev.salaries.id_user";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.planning_presence_detail ...";
$sql = "DROP TABLE intranet_v3_0_dev.planning_presence_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.planning_presence_detail ...";
$sql = "CREATE TABLE intranet_v3_0_dev.planning_presence_detail LIKE intranet_v3_0_cod.planning_presence_detail";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.planning_presence_detail ...";
$sql = " INSERT INTO intranet_v3_0_dev.planning_presence_detail SELECT intranet_v2_0_prod.planning_presence_detail . * 
            FROM intranet_v2_0_prod.planning_presence_detail, intranet_v3_0_dev.salaries
            WHERE intranet_v2_0_prod.planning_presence_detail.id_salaries = intranet_v3_0_dev.salaries.id_user";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.intranet_droits_acces ...";
$sql = "DROP TABLE intranet_v3_0_dev.intranet_droits_acces";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.intranet_droits_acces ...";
$sql = "CREATE TABLE intranet_v3_0_dev.intranet_droits_acces LIKE intranet_v3_0_cod.intranet_droits_acces";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.intranet_droits_acces ...";
$sql = " INSERT INTO intranet_v3_0_dev.intranet_droits_acces SELECT intranet_v2_0_prod.intranet_droits_acces.*
                FROM intranet_v2_0_prod.intranet_droits_acces,intranet_v3_0_dev.salaries,intranet_v3_0_dev.intranet_modules,intranet_v3_0_dev.intranet_actions 
                WHERE intranet_v2_0_prod.intranet_droits_acces.id_user=intranet_v3_0_dev.salaries.id_user 
                AND intranet_v2_0_prod.intranet_droits_acces.id_intranet_modules=intranet_v3_0_dev.intranet_modules.id_intranet_modules 
                AND intranet_v2_0_prod.intranet_droits_acces.id_intranet_actions=intranet_v3_0_dev.intranet_actions.id_intranet_actions";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

/**
 * Création des tables dépendant de id_fta
 */
echo "DROP intranet_v3_0_dev.fta ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

$sql = "SELECT * FROM intranet_v2_0_prod.fta f JOIN intranet_v2_0_prod.access_arti2 a  ON a.id_access_arti2 = f.id_access_arti2  AND a.id_fta = f.id_fta";
$resultFta =mysql_query($sql);

echo "CREATE TABLE intranet_v3_0_dev.fta ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta LIKE  intranet_v3_0_cod.fta;";
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
    $Site_de_production = $value["Site_de_production"];
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
     * Champ non utlisé (renommer en intranet_v3_0_dev.nom_du_champ)
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






    $sql_inter = "INSERT INTO intranet_v3_0_dev.fta (
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
 nom_societe, id_fta_classification2)
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
            . ", \"\", NULL)";
         echo "UPDATE intranet_v3_0_dev." . "fta." . "id_fta .". $idFta ."id_fta_workflow" . "=" .$idFtaWorkflow." ...";
    mysql_query("SET NAMES 'utf8'");
    if(mysql_query($sql_inter)) {echo "[OK]\n";}else{echo "[FAILED]\n $idFta \n";}

//    $resultquery = mysql_query($sql_inter);
//    if (!$resultquery) {
//        $sqlFalse = $sql_inter;
//        $resultquery2 = DatabaseOperation::execute($sql_inter);
//    }
}
}
/**
 * Affiliation d'un id_user au createur supprimer
 */

if(FALSE){
  $sql ="SELECT DISTINCT fta.id_fta
         FROM intranet_v3_0_dev.fta
         WHERE Site_de_production NOT 
         IN (SELECT id_geo FROM geo) ";
  
$resultSiteDEProduction =mysql_query($sql);
if ($resultSiteDEProduction) {
    while ($rowsChangeIdSiteProduction=mysql_fetch_array($resultSiteDEProduction)) {
        $idFta = $rowsChangeIdSiteProduction['id_fta'];
        $sql_inter = "UPDATE intranet_v3_0_dev.fta
                 SET Site_de_production=1"
                . " WHERE id_fta=" . $idFta;
         echo "UPDATE intranet_v3_0_dev." . "fta." . "id_fta .". $idFta ."Site_de_production" . "=1" ." ...";
    if(mysql_query($sql_inter)) {echo "[OK]\n";}else{echo "[FAILED]\n $idFta \n";}
      
    }
}
             $sql = "SELECT DISTINCT fta.id_fta
                FROM intranet_v3_0_dev.fta, intranet_v3_0_dev.salaries
                WHERE createur_fta NOT 
                IN (
                SELECT DISTINCT fta.createur_fta
                FROM intranet_v3_0_dev.fta, intranet_v3_0_dev.salaries
                WHERE createur_fta = id_user
                )";
$resultChangeIdUse =mysql_query($sql);

if ($resultChangeIdUse) {
    while ($rowsChangeIdUser=mysql_fetch_array($resultChangeIdUse)) {
        $idFta = $rowsChangeIdUser['id_fta'];
        $sql_inter = "UPDATE intranet_v3_0_dev.fta
                 SET createur_fta=-2"
                . " WHERE id_fta=" . $idFta;
 echo "UPDATE intranet_v3_0_dev." . "fta." . "id_fta .". $idFta ."createur_fta" . "=-2" ." ...";
    if(mysql_query($sql_inter)) {echo "[OK]\n";}else{echo "[FAILED]\n $idFta \n";}
      
    }
} 
}
/**
 * Extraction Fta suivi de projet
 */
if(FALSE){
echo "DROP intranet_v3_0_dev.fta_suivi_projet ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_suivi_projet";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_suivi_projet ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_suivi_projet LIKE  intranet_v3_0_cod.fta_suivi_projet;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

$sql ="SELECT intranet_v2_0_prod.fta_suivi_projet.* "
        . " FROM intranet_v2_0_prod.fta_suivi_projet,intranet_v3_0_dev.fta"
        . " WHERE intranet_v2_0_prod.fta_suivi_projet.id_fta=intranet_v3_0_dev.fta.id_fta ";
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
                     FROM intranet_v3_0_dev.fta WHERE id_fta = " . $idFta
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

    $selectInsert = " INSERT INTO intranet_v3_0_dev.`fta_suivi_projet` "
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
   echo "INSERT INTO intranet_v3_0_dev." . "fta_suivi_projet." . "id_fta .". $idFta ."id_fta_chapitre" . "=" . $idFtaChapitre." ...";
    mysql_query("SET NAMES 'utf8'");
   if(mysql_query($selectInsert)) {echo "[OK] \n";}else{echo "[FAILED] $idFtaSuiviProjet \n ";}
   
}
}
/**
 * Second traitment fta suivie de projet
 */


if(TRUE){
    echo  date("H:i:s")."\n";

$arrayIdFtaSuiviProjet = mysql_query(
                "SELECT DISTINCT fta_suivi_projet.id_fta,id_fta_etat,createur_fta FROM intranet_v3_0_dev.fta_suivi_projet,intranet_v3_0_dev.fta "
        . " WHERE fta_suivi_projet.id_fta=fta.id_fta"
);
echo "SELECT DISTINCT fta_suivi_projet.id_fta,id_fta_etat,createur_fta FROM intranet_v3_0_dev.fta_suivi_projet ...";
   if($arrayIdFtaSuiviProjet) {echo "[OK] \n";}else{echo "[FAILED] \n ";}

while ( $rowsIdFtaSuiviProjet=  mysql_fetch_array($arrayIdFtaSuiviProjet)) {
    $idFta = $rowsIdFtaSuiviProjet['id_fta'];
    $idFtaEtat = $rowsIdFtaSuiviProjet['id_fta_etat'];
    $createurFta = $rowsIdFtaSuiviProjet['createur_fta'];

    $arrayIdFtaWorkflow = mysql_query(
                        "SELECT DISTINCT id_fta_workflow
                         FROM intranet_v3_0_dev.fta  WHERE id_fta = " . $idFta
        );
    
        while ($rowIdFtaWorkflow=  mysql_fetch_array($arrayIdFtaWorkflow)) {
            $idFtaWorkflow = $rowIdFtaWorkflow['id_fta_workflow'];
        }
        if ($idFtaWorkflow) {
            $arrayChapitre = mysql_query(
                            'SELECT id_fta_chapitre, id_fta_processus  FROM intranet_v3_0_dev.fta_workflow_structure WHERE id_fta_workflow =' . $idFtaWorkflow
            );


            while ($rowsChapitre=  mysql_fetch_array($arrayChapitre)) {
                $arrayCheckIdSuiviProjet = mysql_query(
                                'SELECT id_fta_suivi_projet' 
                                . ' FROM intranet_v3_0_dev.fta_suivi_projet' 
                                . ' WHERE id_fta' 
                                . '=' . $idFta
                                . ' AND id_fta_chapitre' 
                                . '=' . $rowsChapitre['id_fta_chapitre']                      
                );
                 while($rowsCheckIdSuiviProjet =  mysql_fetch_array($arrayCheckIdSuiviProjet)){
                 if($rowsCheckIdSuiviProjet['id_fta_suivi_projet']) {echo "[OK]$idFta \n";}else{echo "[FAILED] INSERT idFta: $idFta idFtaChapitre ".$rowsChapitre['id_fta_chapitre']."\n ";}
           
                if (!$rowsCheckIdSuiviProjet['id_fta_suivi_projet']) {
                    if ($rowsChapitre['id_fta_processus'] == 0) {
                         echo "INSERT INTO intranet_v3_0_dev." . "fta_suivi_projet." . "id_fta .". $idFta ."id_fta_chapitre" . "=" . $rowsChapitre['id_fta_chapitre']." ...";
                         if(mysql_query(
                                'INSERT INTO intranet_v3_0_dev.' . 'fta_suivi_projet'
                                . '(' . 'id_fta'
                                . ', ' . 'id_fta_chapitre'
                                . ', ' . 'signature_validation_suivi_projet'
                                . ') VALUES (' . $idFta
                                . ', ' . $rowsChapitre['id_fta_chapitre']
                                . ', 1 )'
                        ))
                                  {echo "[OK] \n";}else{echo "[FAILED] $idFta,$rowsChapitre \n ";}
                    } else {
                        switch ($idFtaEtat) {
                            case '1':
                             $modif =  mysql_query(
                                        'INSERT INTO intranet_v3_0_dev.' . 'fta_suivi_projet'
                                        . '(' . 'id_fta'
                                        . ', ' . 'id_fta_chapitre'
                                         . ', ' . 'signature_validation_suivi_projet'
                                        . ') VALUES (' . $idFta
                                        . ', ' . $rowsChapitre['id_fta_chapitre']
                                        . ', 0 )'
                                );
                            if($modif) {echo "[OK] \n";}else{echo "[FAILED] $idFta,$rowsChapitre \n ";}
                                break;
                            case '3':
                            case '5':
                            case '6':
                                 echo "INSERT INTO intranet_v3_0_dev." . "fta_suivi_projet." . "id_fta .". $idFta ."id_fta_chapitre" . "=" . $rowsChapitre['id_fta_chapitre']." ...";
                                $valid= mysql_query(
                                        'INSERT INTO intranet_v3_0_dev.' . 'fta_suivi_projet'
                                        . '(' . 'id_fta'
                                        . ', ' . 'id_fta_chapitre'
                                        . ', ' . 'signature_validation_suivi_projet'
                                        . ') VALUES (' . $idFta
                                        . ', ' . $rowsChapitre['id_fta_chapitre']
                                        . ', ' . $createurFta . ' )'                                        
                                );
                                 if($valid){echo "[OK] \n";}else{echo "[FAILED] $idFta,$rowsChapitre \n ";}
                                break;
                        }
                    }
                }
            }
            }
        }
}

}

/**
 * Composition
 */
 if(FALSE){
echo "DROP intranet_v3_0_dev.fta_composant ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_composant";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_composant ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_composant LIKE  intranet_v3_0_cod.fta_composant;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_composant ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_composant SELECT intranet_v2_0_prod.fta_composant.* FROM intranet_v2_0_prod.fta_composant,intranet_v3_0_dev.fta "
        . " WHERE intranet_v2_0_prod.fta_composant.id_fta=intranet_v3_0_dev.fta.id_fta";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

$sql ="SELECT intranet_v2_0_prod.fta_suivi_projet.* "
        . " FROM intranet_v2_0_prod.fta_suivi_projet,intranet_v3_0_dev.fta"
        . " WHERE intranet_v2_0_prod.fta_suivi_projet.id_fta=intranet_v3_0_dev.fta.id_fta ";
$resultFtaSuiviPrjet =mysql_query($sql);



$arrayFtaCompositionParagraphe = mysql_query(
                "SELECT id_fta_composant
FROM  intranet_v3_0_dev.fta_composant
WHERE  k_style_paragraphe_ingredient_fta_composition =0 "
);
if ($arrayFtaCompositionParagraphe) {
    while  ($rowsFtaCompositionParagraphe = mysql_fetch_array($arrayFtaCompositionParagraphe)) {
        $idFtaComposant = $rowsFtaCompositionParagraphe['id_fta_composant'];


        $sql_inter = "UPDATE intranet_v3_0_dev." . 'fta_composant'
                . " SET " . 'k_style_paragraphe_ingredient_fta_composition'. "=4"
                . " WHERE " . 'id_fta_composant' . "=" . $idFtaComposant;  
        echo "UPDATE intranet_v3_0_dev." . "fta_composant." . "k_style_paragraphe_ingredient_fta_composition id_fta_composant" . "=" . $idFtaComposant." ...";
      if(mysql_query($sql_inter)) {	echo "[OK]\n";}else{echo "[FAILED] $idFtaComposant \n";}
        
    }
}
$arrayFtaCompositionEtiquette = mysql_query(
                "SELECT DISTINCT id_fta_composant, k_etiquette_fta_composition
FROM intranet_v3_0_dev.fta_composant
WHERE k_etiquette_fta_composition NOT 
IN (

SELECT k_etiquette
FROM intranet_v2_0_prod.codesoft_etiquettes
)"
);
if ($arrayFtaCompositionEtiquette) {
    while ($rowsFtaCompositionEtiquette = mysql_fetch_array($arrayFtaCompositionEtiquette)) {
        $idFtaComposant = $rowsFtaCompositionEtiquette['id_fta_composant'];


        $sql_inter = "UPDATE intranet_v3_0_dev." . 'fta_composant'
                . " SET " . 'k_etiquette_fta_composition' . "=-1"
                . " WHERE " . 'id_fta_composant' . "=" . $idFtaComposant;
        echo "UPDATE intranet_v3_0_dev." . "fta_composant." . "k_etiquette_fta_composition id_fta_composant" . "=" . $idFtaComposant." ...";
        if(mysql_query($sql_inter)) {	echo "[OK]\n";}else{echo "[FAILED] $idFtaComposant \n";}
    }
}

/**
 * Seconde partie composition
 */
$arrayFtaCompositionIdGeo = mysql_query(
                "SELECT id_fta_composant, Site_de_production
FROM intranet_v3_0_dev.fta_composant, intranet_v3_0_dev.fta
WHERE id_fta_composant NOT 
IN (

SELECT id_fta_composant
FROM  `fta_composant` , geo
WHERE fta_composant.id_geo = geo.id_geo
)
AND fta.id_fta = fta_composant.id_fta
AND Site_de_production IS NOT NULL "
);
if ($arrayFtaCompositionIdGeo) {
    while ($rowsFtaCompositionIdGeo= mysql_fetch_array($arrayFtaCompositionIdGeo)) {
        $idFtaComposant = $rowsFtaCompositionIdGeo['id_fta_composant'];
        $idGeo = $rowsFtaCompositionIdGeo["Site_de_production"];


        $sql_inter = "UPDATE intranet_v3_0_dev." . 'fta_composant'
                . " SET " . 'id_geo' . "=" . $idGeo
                . " WHERE " .'id_fta_composant' . "=" . $idFtaComposant;
       echo "UPDATE intranet_v3_0_dev." . "fta_composant." . 'id_geo' . "=" . $idGeo. " id_fta_composant" . "=" . $idFtaComposant." ...";
       if(mysql_query($sql_inter)) {	echo "[OK]\n";}else{echo "[FAILED] $idFtaComposant \n";}
    }
}


}

/**
 * Extraction  annexe emballage
 */
 if(FALSE){
echo "DROP intranet_v3_0_dev.annexe_emballage_groupe_type ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_emballage_groupe_type";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_emballage_groupe_type ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_emballage_groupe_type LIKE  intranet_v3_0_cod.annexe_emballage_groupe_type;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.annexe_emballage_groupe_type ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_emballage_groupe_type SELECT * FROM intranet_v2_0_prod.annexe_emballage_groupe_type;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.annexe_emballage_groupe ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_emballage_groupe";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_emballage_groupe ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_emballage_groupe LIKE  intranet_v3_0_cod.annexe_emballage_groupe;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.annexe_emballage_groupe ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_emballage_groupe SELECT * FROM intranet_v2_0_prod.annexe_emballage_groupe;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "DROP intranet_v3_0_dev.annexe_emballage ...";
$sql = "DROP TABLE intranet_v3_0_dev.annexe_emballage";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.annexe_emballage ...";
$sql = "CREATE TABLE intranet_v3_0_dev.annexe_emballage LIKE  intranet_v3_0_cod.annexe_emballage;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.annexe_emballage ...";
$sql = "INSERT INTO intranet_v3_0_dev.annexe_emballage SELECT intranet_v2_0_prod.annexe_emballage.* FROM intranet_v2_0_prod.annexe_emballage,intranet_v3_0_dev.fte_fournisseur,intranet_v3_0_dev.annexe_emballage_groupe"
        . " WHERE intranet_v2_0_prod.annexe_emballage.id_fte_fournisseur=intranet_v3_0_dev.fte_fournisseur.id_fte_fournisseur"
        . " AND intranet_v2_0_prod.annexe_emballage.id_annexe_emballage_groupe=intranet_v3_0_dev.annexe_emballage_groupe.id_annexe_emballage_groupe;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}



/**
 * Extrationc fta_conditionnement 
 */

echo "DROP intranet_v3_0_dev.fta_conditionnement ...";
$sql = "DROP TABLE intranet_v3_0_dev.fta_conditionnement";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.fta_conditionnement ...";
$sql = "CREATE TABLE intranet_v3_0_dev.fta_conditionnement LIKE  intranet_v3_0_cod.fta_conditionnement;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_conditionnement ...";
$sql = "INSERT INTO intranet_v3_0_dev.fta_conditionnement SELECT intranet_v2_0_prod.fta_conditionnement.* FROM intranet_v2_0_prod.fta_conditionnement,intranet_v3_0_dev.fta,intranet_v3_0_dev.annexe_emballage"
        . " WHERE intranet_v2_0_prod.fta_conditionnement.id_fta=intranet_v3_0_dev.fta.id_fta"
        . " AND intranet_v2_0_prod.fta_conditionnement.id_annexe_emballage=intranet_v3_0_dev.annexe_emballage.id_annexe_emballage;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
}


/**
 * Insertion  de la nouvelle classification
 */
if(FALSE){
    echo "DROP intranet_v3_0_dev.classification_fta ...";
$sql = "DROP TABLE intranet_v3_0_dev.classification_fta";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "CREATE TABLE intranet_v3_0_dev.classification_fta ...";
$sql = "CREATE TABLE intranet_v3_0_dev.classification_fta LIKE  intranet_v3_0_cod.classification_fta;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo "INSERT INTO intranet_v3_0_dev.fta_conditionnement ...";
$sql = "INSERT INTO intranet_v3_0_dev.classification_fta SELECT intranet_v2_0_prod.classification_fta . * 
            FROM intranet_v2_0_prod.classification_fta, intranet_v3_0_dev.fta
            WHERE intranet_v2_0_prod.classification_fta.id_fta = intranet_v3_0_dev.fta.id_fta;";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

echo  date("H:i:s")."\n";

/**
 * Generation de la table classification_fta2*
 * excution depuis l'interface
 */
}
echo  date("H:i:s")."\n";

if(FALSE){
$arrayFta = mysql_query(
                "SELECT DISTINCT fta.id_fta FROM intranet_v3_0_dev.fta,intranet_v3_0_dev.classification_fta WHERE classification_fta.id_fta =fta.id_fta "
);

while ($rowsFta= mysql_fetch_array($arrayFta)) {
    $arrayIdFtaClassfication = mysql_query(
                    "SELECT DISTINCT id_fta_classification2 "
                    . " FROM intranet_v3_0_dev.classification_fta, intranet_v3_0_dev.classification_fta2"
                    . " WHERE intranet_v3_0_dev.classification_fta.id_classification_arborescence_article = intranet_v3_0_dev.classification_fta2.id_arborescence"
                    . " AND intranet_v3_0_dev.classification_fta.id_fta = " . $rowsFta['id_fta']
    );
    if ($arrayIdFtaClassfication) {
        while ($value= mysql_fetch_array($arrayIdFtaClassfication)) {
            $sql_inter = "UPDATE intranet_v3_0_dev." . "fta"
                    . " SET " . "id_fta_classification2" . "=" . $value["id_fta_classification2"]
                    . " WHERE " . 'id_fta' . "=" . $rowsFta['id_fta'];
            echo "UPDATE intranet_v3_0_dev." . "fta." . 'id_fta' . "=" . $rowsFta['id_fta']. " id_fta_classification2" . "=" . $value["id_fta_classification2"]." ...";
            if(mysql_query($sql_inter)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
        }
    }
}
echo "ALTER TABLE classification_fta2 DROP id_arborescence ...";
$sql = "ALTER TABLE classification_fta2
        DROP id_arborescence";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}

}
if(FALSE){

// Fta workflow structure    
    echo "ALTER TABLE intranet_v3_0_dev.fta_workflow_structure id_fta_workflow...";
 
   $sql = "ALTER TABLE intranet_v3_0_dev.fta_workflow_structure
        ADD CONSTRAINT  FOREIGN KEY (id_fta_workflow) REFERENCES intranet_v3_0_dev.fta_workflow(id_fta_workflow)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
      echo "ALTER TABLE intranet_v3_0_dev.fta_workflow_structure id_fta_role...";

   $sql = "ALTER TABLE intranet_v3_0_dev.fta_workflow_structure
        ADD CONSTRAINT  FOREIGN KEY (id_fta_role) REFERENCES intranet_v3_0_dev.fta_role(id_fta_role)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
      echo "ALTER TABLE intranet_v3_0_dev.fta_workflow_structure id_fta_processus...";

   $sql = "ALTER TABLE intranet_v3_0_dev.fta_workflow_structure
        ADD CONSTRAINT  FOREIGN KEY (id_fta_processus) REFERENCES intranet_v3_0_dev.fta_processus(id_fta_processus)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
   
      echo "ALTER TABLE intranet_v3_0_dev.fta_workflow_structure id_fta_chapitre...";

   $sql =  "ALTER TABLE intranet_v3_0_dev.fta_workflow_structure
        ADD CONSTRAINT  FOREIGN KEY (id_fta_chapitre) REFERENCES intranet_v3_0_dev.fta_chapitre(id_fta_chapitre)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
   
  

//annexe emballage  
  
      echo "ALTER TABLE intranet_v3_0_dev.annexe_emballage id_fte_fournisseur...";

   $sql =  "ALTER TABLE intranet_v3_0_dev.annexe_emballage
       ADD CONSTRAINT FOREIGN KEY (id_fte_fournisseur) REFERENCES intranet_v3_0_dev.fte_fournisseur(id_fte_fournisseur)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
      echo "ALTER TABLE intranet_v3_0_dev.annexe_emballage id_annexe_emballage_groupe...";

   $sql = "ALTER TABLE intranet_v3_0_dev.annexe_emballage
        ADD CONSTRAINT FOREIGN KEY (id_annexe_emballage_groupe) REFERENCES intranet_v3_0_dev.annexe_emballage_groupe(id_annexe_emballage_groupe)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  

//Fta
  
    echo "ALTER TABLE intranet_v3_0_dev.fta id_fta_workflow...";

   $sql =  "ALTER TABLE intranet_v3_0_dev.fta
       ADD CONSTRAINT FOREIGN KEY (id_fta_workflow) REFERENCES intranet_v3_0_dev.fta_workflow_structure(id_fta_workflow)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
     
    echo "ALTER TABLE intranet_v3_0_dev.fta id_fta_etat...";

   $sql =   "ALTER TABLE intranet_v3_0_dev.fta
        ADD CONSTRAINT FOREIGN KEY (id_fta_etat) REFERENCES intranet_v3_0_dev.fta_etat(id_fta_etat)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
    echo "ALTER TABLE intranet_v3_0_dev.fta createur_fta...";

   $sql =   "ALTER TABLE intranet_v3_0_dev.fta
        ADD CONSTRAINT FOREIGN KEY (createur_fta) REFERENCES intranet_v3_0_dev.salaries(id_user)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
    echo "ALTER TABLE intranet_v3_0_dev.fta Site_de_production...";

   $sql =    "ALTER TABLE intranet_v3_0_dev.fta
        ADD CONSTRAINT FOREIGN KEY (Site_de_production) REFERENCES intranet_v3_0_dev.geo(id_geo)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
    echo "ALTER TABLE intranet_v3_0_dev.fta id_fta_classification2...";

   $sql =     "ALTER TABLE intranet_v3_0_dev.fta
        ADD CONSTRAINT FOREIGN KEY (id_fta_classification2) REFERENCES intranet_v3_0_dev.classification_fta2(id_fta_classification2)
       ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
//Fta action role
  
 echo "ALTER TABLE intranet_v3_0_dev.fta_action_role id_fta_role...";

   $sql =      "ALTER TABLE intranet_v3_0_dev.fta_action_role
        ADD CONSTRAINT FOREIGN KEY (id_fta_role) REFERENCES intranet_v3_0_dev.fta_workflow_structure(id_fta_role)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
 echo "ALTER TABLE intranet_v3_0_dev.fta_action_role id_fta_workflow...";

   $sql =      "ALTER TABLE intranet_v3_0_dev.fta_action_role
        ADD CONSTRAINT  FOREIGN KEY (id_fta_workflow) REFERENCES intranet_v3_0_dev.fta_workflow_structure(id_fta_workflow)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
    
 echo "ALTER TABLE intranet_v3_0_dev.fta_action_role id_intranet_actions...";

   $sql =     "ALTER TABLE intranet_v3_0_dev.fta_action_role
        ADD CONSTRAINT  FOREIGN KEY (id_intranet_actions) REFERENCES intranet_v3_0_dev.intranet_actions(id_intranet_actions)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
//Fta action site
  
   
 echo "ALTER TABLE intranet_v3_0_dev.fta_action_site id_site...";

   $sql =       "ALTER TABLE intranet_v3_0_dev.fta_action_site
        ADD CONSTRAINT FOREIGN KEY (id_site) REFERENCES intranet_v3_0_dev.geo(id_geo)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
 echo "ALTER TABLE intranet_v3_0_dev.fta_action_site id_fta_workflow...";

   $sql =       "ALTER TABLE intranet_v3_0_dev.fta_action_site
       ADD CONSTRAINT  FOREIGN KEY (id_fta_workflow) REFERENCES intranet_v3_0_dev.fta_workflow_structure(id_fta_workflow)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
    
 echo "ALTER TABLE intranet_v3_0_dev.fta_action_site id_intranet_actions...";

   $sql =     "ALTER TABLE intranet_v3_0_dev.fta_action_site
        ADD CONSTRAINT  FOREIGN KEY (id_intranet_actions) REFERENCES intranet_v3_0_dev.intranet_actions(id_intranet_actions)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}


//Fta composant   
    
 echo "ALTER TABLE intranet_v3_0_dev.fta_composant id_fta...";

   $sql =      "ALTER TABLE intranet_v3_0_dev.fta_composant
        ADD CONSTRAINT  FOREIGN KEY (id_fta) REFERENCES intranet_v3_0_dev.fta(id_fta)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}  
    
 echo "ALTER TABLE intranet_v3_0_dev.fta_composant id_geo...";

   $sql =      "ALTER TABLE intranet_v3_0_dev.fta_composant
       ADD CONSTRAINT  FOREIGN KEY (id_geo) REFERENCES intranet_v3_0_dev.geo(id_geo)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
 echo "ALTER TABLE intranet_v3_0_dev.fta_composant k_style_paragraphe_ingredient_fta_composition...";

   $sql =     "ALTER TABLE intranet_v3_0_dev.fta_composant
        ADD CONSTRAINT  FOREIGN KEY (k_style_paragraphe_ingredient_fta_composition) REFERENCES intranet_v3_0_dev.codesoft_style_paragraphe(k_codesoft_style_paragraphe)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  
 echo "ALTER TABLE intranet_v3_0_dev.fta_composant k_etiquette_fta_composition...";

   $sql =      "ALTER TABLE intranet_v3_0_dev.fta_composant
        ADD CONSTRAINT  FOREIGN KEY (k_etiquette_fta_composition) REFERENCES intranet_v3_0_dev.codesoft_etiquettes(k_etiquette)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  


//Fta conditionnement
  
 echo "ALTER TABLE intranet_v3_0_dev.fta_conditionnement id_fta...";

   $sql =       "ALTER TABLE intranet_v3_0_dev.fta_conditionnement
        ADD CONSTRAINT  FOREIGN KEY (id_fta) REFERENCES intranet_v3_0_dev.fta(id_fta)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  
 echo "ALTER TABLE intranet_v3_0_dev.fta_conditionnement id_annexe_emballage_groupe...";

   $sql =       "ALTER TABLE intranet_v3_0_dev.fta_conditionnement
        ADD CONSTRAINT  FOREIGN KEY (id_annexe_emballage_groupe) REFERENCES intranet_v3_0_dev.annexe_emballage_groupe(id_annexe_emballage_groupe)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  
 echo "ALTER TABLE intranet_v3_0_dev.fta_conditionnement id_annexe_emballage_groupe_type...";

   $sql =       "ALTER TABLE intranet_v3_0_dev.fta_conditionnement
        ADD CONSTRAINT  FOREIGN KEY (id_annexe_emballage_groupe_type) REFERENCES intranet_v3_0_dev.annexe_emballage_groupe_type(id_annexe_emballage_groupe_type)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
 echo "ALTER TABLE intranet_v3_0_dev.fta_conditionnement id_annexe_emballage...";

   $sql =        "ALTER TABLE intranet_v3_0_dev.fta_conditionnement
        ADD CONSTRAINT  FOREIGN KEY (id_annexe_emballage) REFERENCES intranet_v3_0_dev.annexe_emballage(id_annexe_emballage)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
   


//Fta processus
  
 echo "ALTER TABLE intranet_v3_0_dev.fta_processus id_fta_role...";

   $sql =           "ALTER TABLE intranet_v3_0_dev.fta_processus
        ADD CONSTRAINT  FOREIGN KEY (id_fta_role) REFERENCES intranet_v3_0_dev.fta_workflow_structure(id_fta_role)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
   

// Fta processus cycle
  
  echo "ALTER TABLE intranet_v3_0_dev.fta_processus_cycle id_init_fta_processus...";

   $sql =          "ALTER TABLE intranet_v3_0_dev.fta_processus_cycle
       ADD CONSTRAINT  FOREIGN KEY (id_init_fta_processus) REFERENCES intranet_v3_0_dev.fta_processus(id_fta_processus)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  
  echo "ALTER TABLE intranet_v3_0_dev.fta_processus_cycle id_next_fta_processus...";

   $sql =        "ALTER TABLE intranet_v3_0_dev.fta_processus_cycle
        ADD CONSTRAINT  FOREIGN KEY (id_next_fta_processus) REFERENCES intranet_v3_0_dev.fta_processus(id_fta_processus)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  
  echo "ALTER TABLE intranet_v3_0_dev.fta_processus_cycle id_fta_workflow...";

   $sql =        "ALTER TABLE intranet_v3_0_dev.fta_processus_cycle
        ADD CONSTRAINT  FOREIGN KEY (id_fta_workflow) REFERENCES intranet_v3_0_dev.fta_workflow_structure(id_fta_workflow)
       ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  

// Fta suivie projet
  
  echo "ALTER TABLE intranet_v3_0_dev.fta_suivi_projet id_fta...";

   $sql =        "ALTER TABLE intranet_v3_0_dev.fta_suivi_projet
        ADD CONSTRAINT  FOREIGN KEY (id_fta) REFERENCES intranet_v3_0_dev.fta(id_fta)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  echo "ALTER TABLE intranet_v3_0_dev.fta_suivi_projet id_fta_chapitre...";

   $sql =         "ALTER TABLE intranet_v3_0_dev.fta_suivi_projet
        ADD CONSTRAINT  FOREIGN KEY (id_fta_chapitre) REFERENCES intranet_v3_0_dev.fta_chapitre(id_fta_chapitre)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  


// Intranet actions    
   
  echo "ALTER TABLE intranet_v3_0_dev.intranet_actions parent_intranet_actions...";

   $sql =          "ALTER TABLE intranet_v3_0_dev.intranet_actions
        ADD CONSTRAINT  FOREIGN KEY (parent_intranet_actions) REFERENCES intranet_v3_0_dev.fta_workflow(id_intranet_actions)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  
// Intranet droits acces
  
  echo "ALTER TABLE intranet_v3_0_dev.intranet_droits_acces id_intranet_modules...";

   $sql =           "ALTER TABLE intranet_v3_0_dev.intranet_droits_acces
        ADD CONSTRAINT  FOREIGN KEY (id_intranet_modules) REFERENCES intranet_v3_0_dev.intranet_modules(id_intranet_modules)
       ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  echo "ALTER TABLE intranet_v3_0_dev.intranet_droits_acces id_user...";

   $sql =             "ALTER TABLE intranet_v3_0_dev.intranet_droits_acces
       ADD CONSTRAINT  FOREIGN KEY (id_user) REFERENCES intranet_v3_0_dev.salaries(id_user)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  echo "ALTER TABLE intranet_v3_0_dev.intranet_droits_acces id_intranet_actions...";

   $sql =         "ALTER TABLE intranet_v3_0_dev.intranet_droits_acces
        ADD CONSTRAINT  FOREIGN KEY (id_intranet_actions) REFERENCES intranet_v3_0_dev.intranet_actions(id_intranet_actions)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  

// log
   echo "ALTER TABLE intranet_v3_0_dev.log id_user...";

   $sql =     "ALTER TABLE intranet_v3_0_dev.log
        ADD CONSTRAINT  FOREIGN KEY (id_user) REFERENCES intranet_v3_0_dev.salaries(id_user)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
 
// modes
    echo "ALTER TABLE intranet_v3_0_dev.modes id_user...";

   $sql =      "ALTER TABLE intranet_v3_0_dev.modes
        ADD CONSTRAINT  FOREIGN KEY (id_user) REFERENCES intranet_v3_0_dev.salaries(id_user)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
 
//  Planning presence detail
   echo "ALTER TABLE intranet_v3_0_dev.planning_presence_detail id_salaries...";

   $sql =         "ALTER TABLE intranet_v3_0_dev.planning_presence_detail
        ADD CONSTRAINT  FOREIGN KEY (id_salaries) REFERENCES intranet_v3_0_dev.salaries(id_user)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
    
// Lu
   echo "ALTER TABLE intranet_v3_0_dev.lu id_user...";

   $sql =          "ALTER TABLE intranet_v3_0_dev.lu
        ADD CONSTRAINT  FOREIGN KEY (id_user) REFERENCES intranet_v3_0_dev.salaries(id_user)
       ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
    
}
echo  date("H:i:s")."\n";

/*

mysql_close();

$bloc .="Vous avez bien envoyer les données dans la table";

*/


/**
 * Rendu HTML
 */
/*

echo "
$navigue
<form $method action = \"$page_action\" name=\"form_action\" method=\"post\">
     <input type=hidden name=action value=$action>
     <input type=hidden name=id_fta value=$id_fta>
     <input type=hidden name=abreviation_fta_etat value=$abreviationFtaEtat>
     <input type=hidden name=id_fta_chapitre_encours value=$id_fta_chapitre_encours>
     <input type=hidden name=id_fta_chapitre value=$id_fta_chapitre>
     <input type=hidden name=id_fta_suivi_projet value=$id_fta_suivi_projet>
     <input type=\"hidden\" name=\"synthese_action\" value=\"$synthese_action\" />
     <input type=\"hidden\" name=\"nom_fta_chapitre_encours\" value=\"$nom_fta_chapitre_encours\" />
     <input type=\"hidden\" name=\"comeback\" value=\"$comeback\" />

     $javascript
     <$html_table>
     <tr><td>

              $bloc

     </td></tr>
     </table>
     </form>

     ";
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
//include ("../lib/fin_page.inc");

//SELECT DISTINCT *
//                FROM intranet_v2_0_prod.access_arti2,intranet_v2_0_prod.fta
//            WHERE Site_de_production=0 AND fta.id_fta=access_arti2.id_fta AND access_arti2.id_access_arti2=fta.id_access_arti2   
//      18541  
//SELECT fta_composant . * 
//FROM  `fta_composant` 
//WHERE fta_composant.id_geo NOT 
//IN (
//
//SELECT geo.id_geo
//FROM geo
//)
//AND fta_composant.id_geo IS NOT NULL
//   27 532     
//        SELECT id_fta_composant, Site_de_production
//FROM fta_composant, fta
//WHERE id_fta_composant NOT 
//IN (
//
//SELECT id_fta_composant
//FROM  `fta_composant` , geo
//WHERE fta_composant.id_geo = geo.id_geo
//)
//AND fta.id_fta = fta_composant.id_fta
//AND Site_de_production IS NOT NULL 
//        
//        il manque les 375 
//        
//        
//        SELECT id_fta_composant, Site_de_production
//FROM fta_composant, fta
//WHERE id_fta_composant NOT 
//IN (
//
//SELECT id_fta_composant
//FROM  `fta_composant` , geo
//WHERE fta_composant.id_geo = geo.id_geo
//)
//AND fta.id_fta = fta_composant.id_fta
 
?>