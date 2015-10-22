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

 $nameOfBDDTarget = 'intranet_v3_0_cod';
 $nameOfBDDOrigin = 'intranet_v2_0_prod';
 $nameOfBDDStructure = 'intranet_v3_0_dev_2015_10_19';

$hostname_connect = "dev-intranet.agis.fr"; //nom du serveur MySQL de connection � la base de donn�e
$database_connect = $nameOfBDDTarget; //nom de la base de donn�e sur votre serveur MySQL
$username_connect = "root"; //login de la base MySQL
$password_connect = "8ale!ne"; //mot de passe de la base MySQL

$donnee = mysql_pconnect($hostname_connect, $username_connect, $password_connect);
mysql_select_db($database_connect);
mysql_query('SET NAMES utf8');


/**
 * Création de la base de données
 */
echo "*** Requêtes SQL Part2:\n";


/**
 * Generation de la table classification_fta2*
 * excution depuis l'interface
 */

echo  date("H:i:s")."\n";


$arrayFta = mysql_query(
                "SELECT DISTINCT fta.id_fta FROM ".$nameOfBDDTarget.".fta,".$nameOfBDDTarget.".classification_fta WHERE classification_fta.id_fta =fta.id_fta "
);

while ($rowsFta= mysql_fetch_array($arrayFta)) {
    $arrayIdFtaClassfication = mysql_query(
                    "SELECT DISTINCT id_fta_classification2 "
                    . " FROM ".$nameOfBDDTarget.".classification_fta, ".$nameOfBDDTarget.".classification_fta2"
                    . " WHERE ".$nameOfBDDTarget.".classification_fta.id_classification_arborescence_article = ".$nameOfBDDTarget.".classification_fta2.id_arborescence"
                    . " AND ".$nameOfBDDTarget.".classification_fta.id_fta = " . $rowsFta['id_fta']
    );
    if ($arrayIdFtaClassfication) {
        while ($value= mysql_fetch_array($arrayIdFtaClassfication)) {
            $sql_inter = "UPDATE ".$nameOfBDDTarget."." . "fta"
                    . " SET " . "id_fta_classification2" . "=" . $value["id_fta_classification2"]
                    . " WHERE " . 'id_fta' . "=" . $rowsFta['id_fta'];
            echo "UPDATE ".$nameOfBDDTarget."." . "fta." . 'id_fta' . "=" . $rowsFta['id_fta']. " id_fta_classification2" . "=" . $value["id_fta_classification2"]." ...";
            if(mysql_query($sql_inter)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
        }
    }
}
echo "ALTER TABLE classification_fta2 DROP id_arborescence ...";
$sql = "ALTER TABLE classification_fta2
        DROP id_arborescence";
if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}




// Fta workflow structure    
    echo "ALTER TABLE ".$nameOfBDDTarget.".fta_workflow_structure id_fta_workflow...";
 
   $sql = "ALTER TABLE ".$nameOfBDDTarget.".fta_workflow_structure
        ADD CONSTRAINT  FOREIGN KEY (id_fta_workflow) REFERENCES ".$nameOfBDDTarget.".fta_workflow(id_fta_workflow)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
      echo "ALTER TABLE ".$nameOfBDDTarget.".fta_workflow_structure id_fta_role...";

   $sql = "ALTER TABLE ".$nameOfBDDTarget.".fta_workflow_structure
        ADD CONSTRAINT  FOREIGN KEY (id_fta_role) REFERENCES ".$nameOfBDDTarget.".fta_role(id_fta_role)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
      echo "ALTER TABLE ".$nameOfBDDTarget.".fta_workflow_structure id_fta_processus...";

   $sql = "ALTER TABLE ".$nameOfBDDTarget.".fta_workflow_structure
        ADD CONSTRAINT  FOREIGN KEY (id_fta_processus) REFERENCES ".$nameOfBDDTarget.".fta_processus(id_fta_processus)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
   
      echo "ALTER TABLE ".$nameOfBDDTarget.".fta_workflow_structure id_fta_chapitre...";

   $sql =  "ALTER TABLE ".$nameOfBDDTarget.".fta_workflow_structure
        ADD CONSTRAINT  FOREIGN KEY (id_fta_chapitre) REFERENCES ".$nameOfBDDTarget.".fta_chapitre(id_fta_chapitre)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
   
  

//annexe emballage  
  
      echo "ALTER TABLE ".$nameOfBDDTarget.".annexe_emballage id_fte_fournisseur...";

   $sql =  "ALTER TABLE ".$nameOfBDDTarget.".annexe_emballage
       ADD CONSTRAINT FOREIGN KEY (id_fte_fournisseur) REFERENCES ".$nameOfBDDTarget.".fte_fournisseur(id_fte_fournisseur)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
      echo "ALTER TABLE ".$nameOfBDDTarget.".annexe_emballage id_annexe_emballage_groupe...";

   $sql = "ALTER TABLE ".$nameOfBDDTarget.".annexe_emballage
        ADD CONSTRAINT FOREIGN KEY (id_annexe_emballage_groupe) REFERENCES ".$nameOfBDDTarget.".annexe_emballage_groupe(id_annexe_emballage_groupe)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  

//Fta
  
    echo "ALTER TABLE ".$nameOfBDDTarget.".fta id_fta_workflow...";

   $sql =  "ALTER TABLE ".$nameOfBDDTarget.".fta
       ADD CONSTRAINT FOREIGN KEY (id_fta_workflow) REFERENCES ".$nameOfBDDTarget.".fta_workflow_structure(id_fta_workflow)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
     
    echo "ALTER TABLE ".$nameOfBDDTarget.".fta id_fta_etat...";

   $sql =   "ALTER TABLE ".$nameOfBDDTarget.".fta
        ADD CONSTRAINT FOREIGN KEY (id_fta_etat) REFERENCES ".$nameOfBDDTarget.".fta_etat(id_fta_etat)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
    echo "ALTER TABLE ".$nameOfBDDTarget.".fta createur_fta...";

   $sql =   "ALTER TABLE ".$nameOfBDDTarget.".fta
        ADD CONSTRAINT FOREIGN KEY (createur_fta) REFERENCES ".$nameOfBDDTarget.".salaries(id_user)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
    echo "ALTER TABLE ".$nameOfBDDTarget.".fta Site_de_production...";

   $sql =    "ALTER TABLE ".$nameOfBDDTarget.".fta
        ADD CONSTRAINT FOREIGN KEY (Site_de_production) REFERENCES ".$nameOfBDDTarget.".geo(id_geo)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
    echo "ALTER TABLE ".$nameOfBDDTarget.".fta id_fta_classification2...";

   $sql =     "ALTER TABLE ".$nameOfBDDTarget.".fta
        ADD CONSTRAINT FOREIGN KEY (id_fta_classification2) REFERENCES ".$nameOfBDDTarget.".classification_fta2(id_fta_classification2)
       ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
//Fta action role
  
 echo "ALTER TABLE ".$nameOfBDDTarget.".fta_action_role id_fta_role...";

   $sql =      "ALTER TABLE ".$nameOfBDDTarget.".fta_action_role
        ADD CONSTRAINT FOREIGN KEY (id_fta_role) REFERENCES ".$nameOfBDDTarget.".fta_workflow_structure(id_fta_role)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
 echo "ALTER TABLE ".$nameOfBDDTarget.".fta_action_role id_fta_workflow...";

   $sql =      "ALTER TABLE ".$nameOfBDDTarget.".fta_action_role
        ADD CONSTRAINT  FOREIGN KEY (id_fta_workflow) REFERENCES ".$nameOfBDDTarget.".fta_workflow_structure(id_fta_workflow)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
    
 echo "ALTER TABLE ".$nameOfBDDTarget.".fta_action_role id_intranet_actions...";

   $sql =     "ALTER TABLE ".$nameOfBDDTarget.".fta_action_role
        ADD CONSTRAINT  FOREIGN KEY (id_intranet_actions) REFERENCES ".$nameOfBDDTarget.".intranet_actions(id_intranet_actions)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
//Fta action site
  
   
 echo "ALTER TABLE ".$nameOfBDDTarget.".fta_action_site id_site...";

   $sql =       "ALTER TABLE ".$nameOfBDDTarget.".fta_action_site
        ADD CONSTRAINT FOREIGN KEY (id_site) REFERENCES ".$nameOfBDDTarget.".geo(id_geo)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
 echo "ALTER TABLE ".$nameOfBDDTarget.".fta_action_site id_fta_workflow...";

   $sql =       "ALTER TABLE ".$nameOfBDDTarget.".fta_action_site
       ADD CONSTRAINT  FOREIGN KEY (id_fta_workflow) REFERENCES ".$nameOfBDDTarget.".fta_workflow_structure(id_fta_workflow)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
    
 echo "ALTER TABLE ".$nameOfBDDTarget.".fta_action_site id_intranet_actions...";

   $sql =     "ALTER TABLE ".$nameOfBDDTarget.".fta_action_site
        ADD CONSTRAINT  FOREIGN KEY (id_intranet_actions) REFERENCES ".$nameOfBDDTarget.".intranet_actions(id_intranet_actions)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}


//Fta composant   
    
 echo "ALTER TABLE ".$nameOfBDDTarget.".fta_composant id_fta...";

   $sql =      "ALTER TABLE ".$nameOfBDDTarget.".fta_composant
        ADD CONSTRAINT  FOREIGN KEY (id_fta) REFERENCES ".$nameOfBDDTarget.".fta(id_fta)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}  
    
 echo "ALTER TABLE ".$nameOfBDDTarget.".fta_composant id_geo...";

   $sql =      "ALTER TABLE ".$nameOfBDDTarget.".fta_composant
       ADD CONSTRAINT  FOREIGN KEY (id_geo) REFERENCES ".$nameOfBDDTarget.".geo(id_geo)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
 echo "ALTER TABLE ".$nameOfBDDTarget.".fta_composant k_style_paragraphe_ingredient_fta_composition...";

   $sql =     "ALTER TABLE ".$nameOfBDDTarget.".fta_composant
        ADD CONSTRAINT  FOREIGN KEY (k_style_paragraphe_ingredient_fta_composition) REFERENCES ".$nameOfBDDTarget.".codesoft_style_paragraphe(k_codesoft_style_paragraphe)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  
 echo "ALTER TABLE ".$nameOfBDDTarget.".fta_composant k_etiquette_fta_composition...";

   $sql =      "ALTER TABLE ".$nameOfBDDTarget.".fta_composant
        ADD CONSTRAINT  FOREIGN KEY (k_etiquette_fta_composition) REFERENCES ".$nameOfBDDTarget.".codesoft_etiquettes(k_etiquette)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  


//Fta conditionnement
  
 echo "ALTER TABLE ".$nameOfBDDTarget.".fta_conditionnement id_fta...";

   $sql =       "ALTER TABLE ".$nameOfBDDTarget.".fta_conditionnement
        ADD CONSTRAINT  FOREIGN KEY (id_fta) REFERENCES ".$nameOfBDDTarget.".fta(id_fta)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  
 echo "ALTER TABLE ".$nameOfBDDTarget.".fta_conditionnement id_annexe_emballage_groupe...";

   $sql =       "ALTER TABLE ".$nameOfBDDTarget.".fta_conditionnement
        ADD CONSTRAINT  FOREIGN KEY (id_annexe_emballage_groupe) REFERENCES ".$nameOfBDDTarget.".annexe_emballage_groupe(id_annexe_emballage_groupe)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  
 echo "ALTER TABLE ".$nameOfBDDTarget.".fta_conditionnement id_annexe_emballage_groupe_type...";

   $sql =       "ALTER TABLE ".$nameOfBDDTarget.".fta_conditionnement
        ADD CONSTRAINT  FOREIGN KEY (id_annexe_emballage_groupe_type) REFERENCES ".$nameOfBDDTarget.".annexe_emballage_groupe_type(id_annexe_emballage_groupe_type)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
 echo "ALTER TABLE ".$nameOfBDDTarget.".fta_conditionnement id_annexe_emballage...";

   $sql =        "ALTER TABLE ".$nameOfBDDTarget.".fta_conditionnement
        ADD CONSTRAINT  FOREIGN KEY (id_annexe_emballage) REFERENCES ".$nameOfBDDTarget.".annexe_emballage(id_annexe_emballage)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
   


//Fta processus
  
 echo "ALTER TABLE ".$nameOfBDDTarget.".fta_processus id_fta_role...";

   $sql =           "ALTER TABLE ".$nameOfBDDTarget.".fta_processus
        ADD CONSTRAINT  FOREIGN KEY (id_fta_role) REFERENCES ".$nameOfBDDTarget.".fta_workflow_structure(id_fta_role)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
   

// Fta processus cycle
  
  echo "ALTER TABLE ".$nameOfBDDTarget.".fta_processus_cycle id_init_fta_processus...";

   $sql =          "ALTER TABLE ".$nameOfBDDTarget.".fta_processus_cycle
       ADD CONSTRAINT  FOREIGN KEY (id_init_fta_processus) REFERENCES ".$nameOfBDDTarget.".fta_processus(id_fta_processus)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  
  echo "ALTER TABLE ".$nameOfBDDTarget.".fta_processus_cycle id_next_fta_processus...";

   $sql =        "ALTER TABLE ".$nameOfBDDTarget.".fta_processus_cycle
        ADD CONSTRAINT  FOREIGN KEY (id_next_fta_processus) REFERENCES ".$nameOfBDDTarget.".fta_processus(id_fta_processus)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  
  echo "ALTER TABLE ".$nameOfBDDTarget.".fta_processus_cycle id_fta_workflow...";

   $sql =        "ALTER TABLE ".$nameOfBDDTarget.".fta_processus_cycle
        ADD CONSTRAINT  FOREIGN KEY (id_fta_workflow) REFERENCES ".$nameOfBDDTarget.".fta_workflow_structure(id_fta_workflow)
       ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  

// Fta suivie projet
  
  echo "ALTER TABLE ".$nameOfBDDTarget.".fta_suivi_projet id_fta...";

   $sql =        "ALTER TABLE ".$nameOfBDDTarget.".fta_suivi_projet
        ADD CONSTRAINT  FOREIGN KEY (id_fta) REFERENCES ".$nameOfBDDTarget.".fta(id_fta)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  echo "ALTER TABLE ".$nameOfBDDTarget.".fta_suivi_projet id_fta_chapitre...";

   $sql =         "ALTER TABLE ".$nameOfBDDTarget.".fta_suivi_projet
        ADD CONSTRAINT  FOREIGN KEY (id_fta_chapitre) REFERENCES ".$nameOfBDDTarget.".fta_chapitre(id_fta_chapitre)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  

// Intranet actions    
   
  echo "ALTER TABLE ".$nameOfBDDTarget.".intranet_actions parent_intranet_actions...";

   $sql =          "ALTER TABLE ".$nameOfBDDTarget.".intranet_actions
        ADD CONSTRAINT  FOREIGN KEY (parent_intranet_actions) REFERENCES ".$nameOfBDDTarget.".fta_workflow(id_intranet_actions)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  
// Intranet droits acces
  
  echo "ALTER TABLE ".$nameOfBDDTarget.".intranet_droits_acces id_intranet_modules...";

   $sql =           "ALTER TABLE ".$nameOfBDDTarget.".intranet_droits_acces
        ADD CONSTRAINT  FOREIGN KEY (id_intranet_modules) REFERENCES ".$nameOfBDDTarget.".intranet_modules(id_intranet_modules)
       ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  echo "ALTER TABLE ".$nameOfBDDTarget.".intranet_droits_acces id_user...";

   $sql =             "ALTER TABLE ".$nameOfBDDTarget.".intranet_droits_acces
       ADD CONSTRAINT  FOREIGN KEY (id_user) REFERENCES ".$nameOfBDDTarget.".salaries(id_user)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  
  echo "ALTER TABLE ".$nameOfBDDTarget.".intranet_droits_acces id_intranet_actions...";

   $sql =         "ALTER TABLE ".$nameOfBDDTarget.".intranet_droits_acces
        ADD CONSTRAINT  FOREIGN KEY (id_intranet_actions) REFERENCES ".$nameOfBDDTarget.".intranet_actions(id_intranet_actions)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
  

// log
   echo "ALTER TABLE ".$nameOfBDDTarget.".log id_user...";

   $sql =     "ALTER TABLE ".$nameOfBDDTarget.".log
        ADD CONSTRAINT  FOREIGN KEY (id_user) REFERENCES ".$nameOfBDDTarget.".salaries(id_user)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
 
// modes
    echo "ALTER TABLE ".$nameOfBDDTarget.".modes id_user...";

   $sql =      "ALTER TABLE ".$nameOfBDDTarget.".modes
        ADD CONSTRAINT  FOREIGN KEY (id_user) REFERENCES ".$nameOfBDDTarget.".salaries(id_user)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
 
//  Planning presence detail
   echo "ALTER TABLE ".$nameOfBDDTarget.".planning_presence_detail id_salaries...";

   $sql =         "ALTER TABLE ".$nameOfBDDTarget.".planning_presence_detail
        ADD CONSTRAINT  FOREIGN KEY (id_salaries) REFERENCES ".$nameOfBDDTarget.".salaries(id_user)
        ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
    
// Lu
   echo "ALTER TABLE ".$nameOfBDDTarget.".lu id_user...";

   $sql =          "ALTER TABLE ".$nameOfBDDTarget.".lu
        ADD CONSTRAINT  FOREIGN KEY (id_user) REFERENCES ".$nameOfBDDTarget.".salaries(id_user)
       ON DELETE  NO ACTION ON UPDATE CASCADE;"
    ;
    
  if(mysql_query($sql)) {	echo "[OK]\n";}else{echo "[FAILED]\n";}
    

echo  date("H:i:s")."\n";
 
?>