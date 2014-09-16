<?php
/*
Module d'appartenance (valeur obligatoire)
Par défaut, le nom du module est le répetoire courant
*/

//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);


//Inclusions
//include ("../lib/session.php");
//include ("../lib/functions.php");
////include ("../lib/functions.php");
////include ("../lib/functions.js");
//include ("./functions.php");
//include ("./functions.js");
      require_once '../inc/main.php';
      


/*
-----------------
 ACTION A TRAITER
-----------------
-----------------------------------
 Détermination de l'action en cours
-----------------------------------

 Cette page est appelée pour effectuer un traitement particulier
 en fonction de la variable "$action". Ensuite elle redirige le
 résultat vers une autre page.

 Le plus souvent, le traitement est délocalisé sous forme de
 fonction située dans le fichier "functions.php"

*/

switch($action)
{
    case "2_4_0_doublon_emballage_UVC":

         $req = "SELECT DISTINCT fta_conditionnement_double.id_fta, LIBELLE
                FROM fta_conditionnement, fta_conditionnement AS fta_conditionnement_double, access_arti2
                WHERE access_arti2.id_fta = fta_conditionnement_double.id_fta
                AND fta_conditionnement.id_fta = fta_conditionnement_double.id_fta
                AND fta_conditionnement.id_annexe_emballage = fta_conditionnement_double.id_annexe_emballage
                AND fta_conditionnement.id_fta_conditionnement <> fta_conditionnement_double.id_fta_conditionnement
                AND fta_conditionnement.id_annexe_emballage <>0
                AND fta_conditionnement_double.quantite_par_couche_fta_conditionnement = access_arti2.NB_UNIT_ELEM"
                ;
         $result = DatabaseOperation::query($req);

         echo "<u>REQUETE UTILISEE:</u><br>$req<br><br><u>LISTE DES FTA A RISQUE</u><br>";

         while($rows=mysql_fetch_array($result))
         {
             //Lien
             $link="modification_fiche.php?id_fta=".$rows["id_fta"]."&id_fta_chapitre_encours=60&synthese_action=all";

             echo "<a href=$link />".$rows["id_fta"].";".$rows["LIBELLE"]."</a><br>";
         }



    break;
    case "2_3_0_recreation_din_nomenclature":    

       $req = "SELECT * FROM fta_nomenclature";
       $result = DatabaseOperation::query($req);
       while($rows=mysql_fetch_array($result))
       {
           $req = "UPDATE fta_nomenclature SET din_fta_nomenclature='".show_din_produit($rows["id_fta_nomenclature"])."' "
                . "WHERE id_fta_nomenclature=".$rows["id_fta_nomenclature"]." "
                ;
           DatabaseOperation::query($req);
       }



  break;

  case "2_3_0_composant_orphelin":
/*
  4. Correction des composants orphelins
  Rattachement d'un composant (Qualité) à son correspondant produit (Gestion)
  Seules les FTA Validées sont concernée (celle avec un code Agrologic dans access_arti2 et actives)
  SELECT `access_arti2`.`CODE_ARTICLE`, `access_arti2`.`LIBELLE`, `fta_composition`.`nom_fta_composition`, `access_arti2`.`actif` FROM `agis_dev`.`fta_composition` `fta_composition`, `agis_dev`.`access_arti2` `access_arti2`, `agis_dev`.`fta` `fta` WHERE ( `fta_composition`.`id_fta` = `access_arti2`.`id_fta` AND `fta`.`id_fta` = `access_arti2`.`id_fta` AND `fta`.`id_access_arti2` = `access_arti2`.`id_access_arti2` ) AND ( ( `access_arti2`.`CODE_ARTICLE` IS NOT NULL AND `access_arti2`.`actif` = - 1 ) )
*/

  header ("Location: composant_orphelin.php");

   

  break;
  case "2_3_0_archivage_fta":
/*
  Seul les FTA non classées sont concernées
 - renommage de tmp_import_articles_actifs_2006 en fta_migration_import_articles_actifs
 - Lancer l'archivage des articles n'étant pas dans cette liste.
*/

   //Variables
   $envoi_mail_detail=0;    //Permet d'envoi un mail en mode "détaillé"
   $abreviation_fta_transition="A";
   $commentaire_maj_fta = "Archivage réalisé par le service Informatique le 28/11/2006 dans le cadre de la mise à jour vers la version 2.3.0 du module Intranet.\n"
                        . "Pour toutes questions, merci de vous rappocher du Chef de Projet."
                        ;

   //Archivage des FTA Validées et Non-classées
   $req = "SELECT * "
        . ", `access_arti2`.`id_fta` "
        . ", `access_arti2`.`CODE_ARTICLE` "
        . ", `fta_migration_import_articles_actifs`.`code_agrologic` "
        . "FROM fta, fta_etat, `fta_migration_import_articles_actifs` RIGHT JOIN `access_arti2` "
        . "ON `fta_migration_import_articles_actifs`.`code_agrologic` = `access_arti2`.`CODE_ARTICLE` "
        . "WHERE (`fta_migration_import_articles_actifs`.`code_agrologic` IS NULL) "
        . "AND (`access_arti2`.`CODE_ARTICLE` IS NOT NULL) "
        . "AND (access_arti2.id_fta=fta.id_fta )"
        . "AND (fta.id_fta_etat=fta_etat.id_fta_etat ) "
        . "AND (abreviation_fta_etat='V' ) "
        ;
    $result=DatabaseOperation::query($req);
    echo "CODE_ARTICE;LIBELLE;id_fta;date_derniere_maj_fta<br>";
    while ($rows=mysql_fetch_array($result))
    {
      //Transition des FTA
      $id_fta=$rows["id_fta"];

      //Si l'article n'est pas classé, alors archivage
      $tab=affichage_classification_article($id_fta,$extension);    
      if(!$tab[0])   //Cet article n'est pas classé car il n'y a même pas un chemin de classification
      {
        //Message HTML
        echo $rows["CODE_ARTICLE"].";\"".$rows["LIBELLE"]."\";".$rows["id_fta"].";\"".$rows["date_derniere_maj_fta"]."\"";
        transition_fta(
                 $id_fta,
                 $abreviation_fta_transition,
                 $commentaire_maj_fta
                 );
        echo "<br>";
      }
    }
    break;

  case "2_3_0_epuration_nomenclature":
/*
   - Récupérer uniquement les versions de nomenclatures les plus récentes cf. 11801
               ---LISTE DES NOMENCLATURES POUR PRODUIT 0011801-----------------------        |
              ||1.0011801002 BEIGNET CREV 20G ITM LAIZE 461  applicable le 18/01/06 |-       |
              ||2.0011801003 BEIGNET CREV 20G ITM LAIZE 423  applicable le 17/01/06 ||       |
              ||3.0011801001 BEIGNET CREV 20G ITM X 16       applicable le 06/12/04 ||       |
              |----------------------------------------------------------------------|       |
              Se baser sur la date d'application !!

   - Sélectionner les nomenclatures les plus récentes dans un tableau: SELECT `_AUTO_NOMENCLATURE`, `_AUTO_PRODUIT`, MAX( `_AUTO_DATE` ) FROM `fta_migration_nomenclature` GROUP BY `_AUTO_PRODUIT`
   - Parcourir la table fta_migration_nomenclature
     - Si le Code _AUTO_NOMENCLATURE n'existe pas dans le tableau, alors suppression
*/

  //Récupération des Nomenclatures à conserver

  //Regroupement par produit avec la date la plus récente
  $req = "SELECT `_AUTO_PRODUIT`, MAX( `_AUTO_DATE` ) AS MAXDATE FROM `fta_migration_nomenclature` GROUP BY `_AUTO_PRODUIT`";
  $result=DatabaseOperation::query($req);
  while ($rows = mysql_fetch_array($result))
  {
      //Pour chaque produit, recherche de la nomenclature la plus récente
      $req = "SELECT `_AUTO_NOMENCLATURE` FROM `fta_migration_nomenclature` WHERE `_AUTO_PRODUIT`=".$rows["_AUTO_PRODUIT"]." AND `_AUTO_DATE`='".$rows["MAXDATE"]."' ";
      //echo $req."<br>";
      $result_nom=DatabaseOperation::query($req);
      while($rows_nom=mysql_fetch_array($result_nom))
      {
         $t_active_nomenclature[]=$rows_nom["_AUTO_NOMENCLATURE"];
         //echo ".";
      }

  }
  //print_r($t_active_nomenclature);

  //Test de chaque nomenclature pour savoir si elle est active (sinon, suppression)
  $req = "SELECT * FROM fta_migration_nomenclature";
  $result=DatabaseOperation::query($req);
  while ($rows=mysql_fetch_array($result))
  {
      //Si la nomenclature en cours n'existe pas alors suppression de celle-ci
      if (!in_array($rows["_AUTO_NOMENCLATURE"], $t_active_nomenclature))
      {
         //Suppression
         echo "Suppression de la nomenclature ".$rows["_AUTO_NOMENCLATURE"].": ";
         $req = "DELETE FROM fta_migration_nomenclature WHERE _AUTO_NOMENCLATURE=\"".$rows["_AUTO_NOMENCLATURE"]."\"" ;
         DatabaseOperation::query($req);
         echo "<br>";

      }//Fin de la suppression
  }//fin de parcours des nomenclatures

  break;

  case "2_3_0_maj_nomenclature":
/*
   - Parcours de tous les articles n'ayant aucune nomenclature
     et ayant un correspondant dans fta-migration-nomenclature._AUTO_PRODUIT
   - Récupérer la liste des semis-finis
   - Si nombre de caractère = 6, alors:
   - Création de la nomenclature dans fta_nomenclature à partir de la table fta-migration-produit
   - Appel récursif pour parcourir les sous-produits et les traiter de la même manière.
*/

   $record_version="2.3.0-patch";  //Numéro de version spécifique utilisée lors de la manipulatione des enregistrements

   //Fonction temporaires, liés uniquement à cette procédure
   function find_produit($code_produit, $id_fta, $record_version)
   {
      //Parcours de la nomenclature et créé les semi-fini dans la FTA
      $req = "SELECT * FROM "
           . "fta_migration_nomenclature, fta_migration_produit "
           . "WHERE _AUTO_PRODUIT=".$code_produit." "
           . "AND fta_migration_nomenclature._AUTO_PRODUIT=fta_migration_produit.CODE_PRODUIT "
           ;
      $result = DatabaseOperation::query($req);
      while ($rows_produit=mysql_fetch_array($result))
      {
          //Idenitification des semi-fini (sur 6 caractères)
          if(strlen($rows_produit["SOUS_PRODUIT"])==6)
          {
              //Chargement des données du sous-produit
              $req = "SELECT * FROM "
                   . "fta_migration_nomenclature, fta_migration_produit "
                   . "WHERE _AUTO_PRODUIT=".$rows_produit["SOUS_PRODUIT"]." "
                   . "AND fta_migration_nomenclature._AUTO_PRODUIT=fta_migration_produit.CODE_PRODUIT "
                   ;
              $result_1=DatabaseOperation::query($req);
              $rows=mysql_fetch_assoc($result_1);

              //Préparation des données
              //echo print_r($rows);

              //id_fta_nomenclature                                --> Incrémentation automatique

              //last_id_fta_nomenclature                           --> 0
              $last_id_fta_nomenclature=0;

              //OLD_id_fta_composition                             --> NULL
              $OLD_id_fta_composition=NULL;

              //id_annexe_agrologic_article_codification           --> Cf. Agro|10- CPRO Code produit 7R  |
              $tmp_codification_produit= substr($rows["_AUTO_PRODUIT"], 0, 1);
              $prefixe_annexe_agrologic_article_codification="0".$tmp_codification_produit;
              $req = "SELECT id_annexe_agrologic_article_codification "
                   . "FROM annexe_agrologic_article_codification "
                   . "WHERE prefixe_annexe_agrologic_article_codification=".$prefixe_annexe_agrologic_article_codification." "
                   ;
              $id_annexe_agrologic_article_codification=mysql_result(DatabaseOperation::query($req), 0, "id_annexe_agrologic_article_codification");

              //id_access_recette_recette                          --> 0
              $id_access_recette_recette=0;

              //id_fta                                             --> Cf. Agro.[PRODUIT].[No Produit](0) du code == "00]" + Agro.[NOMENCLATURE]
              $id_fta=$id_fta;

              //ascendant_fta_nomenclature                         --> NULL
              $ascendant_fta_nomenclature=NULL;

              //site_production_fta_nomenclature                   --> Cf. Agro.SE BASER SUR l'extraction du compte GG= ou GT=[MATIERE].[Fournisseurs](33) du code "000]" (voir PRIFOUR ?) + recouper avec la table geo (id_geo)
              $site_production_fta_nomenclature=$rows["SITE"];    //Pour l'instant, tout sur Avignon

              //poids_fta_nomenclature                             --> Cf. Agro. 6- 4               Quantité de lien du composant  MR4  9R  |   
              //id_annexe_unite                                    --> Cf. Agro.[PRODUIT].[champ 11] / [PRODUIT].[champ 12] / [PRODUIT].[champ 13]
              switch ($prefixe_annexe_agrologic_article_codification)
              {
                  case "01":
                  case "02":
                       $id_annexe_unite="kg";
                       $poids_fta_nomenclature=$rows["COEF_US1_VERS_US2"];
                  break;

                  case "05":
                       $id_annexe_unite="L";
                       $poids_fta_nomenclature="";
                  break;

                  case "06":
                  case "07":
                       $id_annexe_unite="kg";
                       $poids_fta_nomenclature="";
                  break;
              }

              //code_produit_agrologic_fta_nomenclature            --> Cf. Agro.[PRODUIT].[No Produit] du code <> "00"
              $code_produit_agrologic_fta_nomenclature=substr($rows["_AUTO_PRODUIT"], 1);

              //etat_fta_nomenclature                              --> Cf. Agro.[PRODUIT].[No Produit] du code == ( "0211]" ou "03]"
              $etat_fta_nomenclature=1;

              //nom_fta_nomenclature                               --> Cf. Agro.[PRODUIT].[Désignation]
              $nom_fta_nomenclature=$rows["DESCRIPTION"];

              //suffixe_agrologic_fta_nomenclature                 --> Cf. Agro.[PRODUIT].[No Produit] du code == "00]"
              $suffixe_agrologic_fta_nomenclature="";


              //Traitement particulier pour les "221]", "236]", "211]" cas des Surgelés
              $tmp=substr($rows["_AUTO_PRODUIT"], 0, 3);
              if (($tmp=="221") or ($tmp=="236") or ($tmp=="211"))
              {
                  $id_annexe_unite="kg";
                  $poids_fta_nomenclature="";
                  $quantite_piece_par_carton=$rows["COEF_US1_VERS_US2"];
                  //poids_total_carton_vrac_fta_nomenclature           --> Cf. Agro.[PRODUIT].[Nombre de KG  dans 1 CAR] du code == "0211]"
                  $etat_fta_nomenclature=2;
              }
   
              //Création de la requête
              $req_insert = "INSERT fta_nomenclature SET "
                          . " last_id_fta_nomenclature='$last_id_fta_nomenclature' "
                          . ", OLD_id_fta_composition='$OLD_id_fta_composition' "
                          . ", id_annexe_agrologic_article_codification='$id_annexe_agrologic_article_codification' "
                          //. ", prefixe_annexe_agrologic_article_codification='$prefixe_annexe_agrologic_article_codification' "
                          . ", id_access_recette_recette='$id_access_recette_recette' "
                          . ", id_fta='$id_fta' "
                          . ", ascendant_fta_nomenclature='$ascendant_fta_nomenclature' "
                          . ", site_production_fta_nomenclature='$site_production_fta_nomenclature' "
                          . ", poids_fta_nomenclature='$poids_fta_nomenclature' "
                          . ", id_annexe_unite='$id_annexe_unite' "
                          . ", quantite_piece_par_carton='$quantite_piece_par_carton' "
                          . ", poids_total_carton_vrac_fta_nomenclature='$poids_total_carton_vrac_fta_nomenclature' "
                          . ", code_produit_agrologic_fta_nomenclature='$code_produit_agrologic_fta_nomenclature' "
                          . ", etat_fta_nomenclature='$etat_fta_nomenclature' "
                          . ", nom_fta_nomenclature='$nom_fta_nomenclature' "
                          . ", suffixe_agrologic_fta_nomenclature='$suffixe_agrologic_fta_nomenclature' "
                          . ", _VERSION='$record_version' "
                          ;

              //Création de la nomenclature
              echo $rows["_AUTO_PRODUIT"]." - ".$nom_fta_nomenclature." créé: ";
              echo "<h5>".$req_insert."</h5>";
              echo "<br>";
              DatabaseOperation::query($req_insert);

              //Appel recursif pour traiter les sous-produits
              $code_produit=$rows["_AUTO_PRODUIT"];
              $id_fta=$id_fta;
              find_produit($code_produit, $id_fta, $record_version);

          }//Fin du traitement dans le cas d'un semi-fini

      }//Fin boucle
   }//Fin fonction

   //Suppression des fta_nomenclature de _VERSION 1
   $req = "DELETE FROM fta_nomenclature WHERE _VERSION='$record_version' ";
   DatabaseOperation::query($req);

   //Récupération des Articles Actifs et sans Nomenclature
   $req = "SELECT `access_arti2`.`CODE_ARTICLE` , access_arti2.id_fta as ID, `fta_nomenclature`.`id_fta` "
        . "FROM `access_arti2`"
        . "LEFT JOIN `fta_nomenclature` ON `access_arti2`.`id_fta` = `fta_nomenclature`.`id_fta`"
        . "WHERE ("
        . "`access_arti2`.`CODE_ARTICLE` IS NOT NULL "
        . "AND `access_arti2`.`id_fta` IS NOT NULL "
        . "AND `fta_nomenclature`.`id_fta` IS NULL "
        //. "AND _VERSION<1 "
        . ")"
        ;
   $result=DatabaseOperation::query($req);

   //Parcours des produits inclus dans cette nomenclature (1er niveau)
   while($rows=mysql_fetch_array($result))
   {
     echo "<br><h2>Traitement de l'Article: ".$rows["CODE_ARTICLE"]."</h2><br>";

     //Fonction récursive qui parcours une nomenclature et créée les semi-fini dans la FTA
     $code_produit = $rows["CODE_ARTICLE"];
     $id_fta = $rows["ID"];
     find_produit($code_produit, $id_fta, $record_version);
   }

  break;

  case "search_long_name":
       
       echo $req = "SELECT *  FROM fta WHERE CHAR_LENGTH(designation_commerciale_fta)>58 ";
       $result = DatabaseOperation::query($req);
       while ($rows=mysql_fetch_array($result))
       {
           echo "<br>".$rows["id_fta"]." ".$rows["id_article_agrologic"]." ".$rows["designation_commerciale_fta"];
       }
       echo "<br>";

  break;
  case "correction_cout_pf":

echo       $req = "SELECT * "
            . "FROM `access_arti2`, `annexe_environnement_conservation_groupe`, `fta` "
            . "WHERE ( `access_arti2`.`K_etat` = `annexe_environnement_conservation_groupe`.`id_annexe_environnement_conservation_groupe` "
            . "AND `access_arti2`.`id_fta` = `fta`.`id_fta` ) "
            . "AND ( ( `fta`.`site_expedition_fta` = 3 "
            . "AND `access_arti2`.`K_etat` = 1 ) )"
            ;
echo "<br>";
echo       $req = "UPDATE `access_arti2`, `annexe_environnement_conservation_groupe`, `fta` "
            . "SET fta.site_expedition_fta=4 "
            . "WHERE ( `access_arti2`.`K_etat` = `annexe_environnement_conservation_groupe`.`id_annexe_environnement_conservation_groupe` "
            . "AND `access_arti2`.`id_fta` = `fta`.`id_fta` ) "
            . "AND ( ( `fta`.`site_expedition_fta` = 3 "
            . "AND `access_arti2`.`K_etat` = 1 ) )"
            ;


  break;

/*
Génération automatique des FTA pour lesquels il n'existe qu'un enregistrement access_arti2 validé
*/

  case "regeneration":

  //Compteur
  $i=0;
  
  //Récupération des enregistrement access_arti2
  $req_arti2 = "SELECT * FROM `access_arti2` WHERE `id_fta` IS NULL AND `actif` = -1";
  //$req_arti2 = "SELECT * FROM `access_arti2` WHERE `id_fta` IS NULL AND `actif` = -1 AND id_access_arti2=3 ";
  $result_arti2 = DatabaseOperation::query($req_arti2);

  //Parcours de tous les enregistrement access_arti2
  while ($rows_arti2=mysql_fetch_array($result_arti2))
  {

     //Compteur
     $i=$i+1;

     //Création de l'enregistrement fta
     $id_fta="";
     mysql_table_operation("fta","insert");
     //echo $id_fta=$_SESSION["id_fta"];

     //Journal
     echo "Création la FTA n°".$id_fta.".<br>";

     //Initialisation des données à mettre à jour dans la FTA
     $id_access_arti2=$rows_arti2["id_access_arti2"];
     $id_dossier_fta=$id_fta;
     $id_fta_etat=3;
     $date_derniere_maj_fta="2006-06-09";
     $remarque_fta="FTA recréée automatiquement.";
     $designation_commerciale_fta=$rows_arti2["LIBELLE_CLIENT"];
     $id_article_agrologic=$rows_arti2["CODE_ARTICLE"];

     //Journal
     echo "&nbsp;- id_access_arti2: ".$id_access_arti2."<br>";
     echo "&nbsp;- désignation commerciale: ".$designation_commerciale_fta."<br>";
     echo "&nbsp;- code Agrologic: ".$id_article_agrologic."<br>";

     //Mise à jour de l'enregistrement fta
     mysql_table_operation("fta","update");

     //Journal
     echo "&nbsp;&nbsp; ... Mise à jour fta effectuée<br>";
     
     //Initialisation des données à mettre à jour dans la access_arti2
     $id_access_arti2; //Déjà initialisé
     $id_fta;          //Déjà initialisé

     //Mise à jour de l'enregistrement access_arti2
     mysql_table_operation("access_arti2","update");

     //Journal
     echo "&nbsp;&nbsp; ... Mise à jour access_arti2 effectuée<br>";

     //Création du suivi de projet
     //Récupération de tous chapitres
     $req_chapitre = "SELECT * FROM fta_chapitre";
     $result_chapitre = DatabaseOperation::query($req_chapitre);

     //Journal
     echo "&nbsp;- Création des suivi de projet.<br>";
     

     //Parcours de tous les chapitres
     while ($rows_chapitre=mysql_fetch_array($result_chapitre))
     {
         //Initialisation des données à insérer dans le suivi de projet
         $id_fta;     //Déjà initialisé
         $id_fta_chapitre=$rows_chapitre["id_fta_chapitre"];
         $commentaire_suivi_projet="FTA recréée automatiquement.";
         $date_validation_suivi_projet="2006-06-09";
         $signature_validation_suivi_projet=-1;
         $notification_fta_suivi_projet=1;

         //Journal
         echo "&nbsp;&nbsp; ... Chapitre $id_fta_chapitre:";

         //Insertion des données dans le suivi de projet
         mysql_table_operation("fta_suivi_projet", "insert");

         //Journal
         echo " créé.<br>";

     }//Fin de parcours de tous les chapitres
     echo "<hr /><br>";
  }//Fin du Parcours de tous les enregistrement access_arti2

  echo "Nombre total de fiches créées: $i";

  break;


}


/************
Fin de switch
************/


//include ("./action_bs.php");
//include ("./action_sm.php");
//echo "</pre>";
?>


