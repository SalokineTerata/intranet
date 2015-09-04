<?
//Autorisation de consulter le module:
//En effet cette page est chargée par toutes les page de ce module
if ($planning_presence_consultation==0)
{
   header ("Location: none.php");
}
/*
Initialisation des variables globales du modules:
-----------------------------------------------*/
$maximum_jours = 5;            //Nombre de jours visibles dans la semaine

/*---------------------------------------------
 FONCTIONS GLOBALES DU MODULE PLANNING PRESENCE
---------------------------------------------*/


//Renvoi un tableau du planning pour une semaine, une année et un service précis
//******************************************************************************
function tableau_planning_selectionne($semaine_en_cours, $annee_en_cours, $service, $site)
/*
Dictionnaire des variables:
---------------------------
$semaine_en_cours:         Numéro de la semaine sur lequel la fonction va travailler (entre 1 et 52)
$annee_en_cours:           Année sur lequel travail la fonction
$service:                  Numéro du service du la table 'services'
*/
{
//construction de la requête SQL
         $req1 = "SELECT DISTINCT id_salaries,id_planning_presence_semaine_visible, annee_planning_presence_semaine_visible, prenom, nom ";
         $req1.= "FROM salaries, planning_presence_detail, annexe_jours_semaine, geo ";
         $req1.= "WHERE (salaries.id_user=planning_presence_detail.id_salaries) ";
         $req1.= "AND (geo.id_geo=salaries.lieu_geo) ";
         $req1.= "AND (planning_presence_detail.id_annexe_jours_semaine=annexe_jours_semaine.id_annexe_jours_semaine) ";
         $req1.= "AND (id_planning_presence_semaine_visible='$semaine_en_cours') ";
         $req1.= "AND (annee_planning_presence_semaine_visible='$annee_en_cours') ";
         $req1.= "AND (id_service='$service') ";
         $req1.= "AND (geo.id_geo='$site') ";
         $req1.= "ORDER BY nom ASC";

//echo $req1;
//Execution de la requête SQL
         $result1=mysql_query($req1);
         return $result1;
}

//Donne l'information du ou des lieux pour une personne et une journée précise
//****************************************************************************
function tableau_planning_selectionne_jour($semaine_en_cours, $annee_en_cours, $id_salaries, $jour)
{
//construction de la requête SQL
         $req1 = "SELECT planning_presence_detail.*, prenom, nom ";
         $req1.= "FROM salaries, planning_presence_detail ";
         $req1.= "WHERE (salaries.id_user=planning_presence_detail.id_salaries) ";
         $req1.= "AND (id_planning_presence_semaine_visible='$semaine_en_cours') ";
         $req1.= "AND (annee_planning_presence_semaine_visible='$annee_en_cours') ";
         $req1.= "AND (id_salaries='$id_salaries') ";
         $req1.= "AND (id_annexe_jours_semaine='$jour')";

//Execution de la requête SQL
         $result1=mysql_query($req1);
         return $result1;
}

//Supprime l'utilisateur de la semaine sélectionnée
//*************************************************
function suppression_utilisateur_semaine($semaine_en_cours, $annee_en_cours, $id_salaries)
/*
Dictionnaire des variables:
---------------------------
$semaine_en_cours:         Numéro de la semaine sur lequel la fonction va travailler (entre 1 et 52)
$annee_en_cours:           Année sur lequel travail la fonction
$id_salaries:              Numéro identifiant du salariés (cf table 'salaries' / champ 'id_user')
*/
{
//construction de la requête SQL
         $req1.= "DELETE FROM planning_presence_detail ";
         $req1.= "WHERE id_salaries=$id_salaries ";
         $req1.= "AND id_planning_presence_semaine_visible=$semaine_en_cours ";
         $req1.= "AND annee_planning_presence_semaine_visible=$annee_en_cours";

//Execution de la requête SQL
         $result1=mysql_query($req1);
         return $result1;
}
               
//Mise a jour de l'état de la semaine (visible ou non)
//****************************************************
function mise_a_jour_etat_semaine_visible($semaine_en_cours, $annee_en_cours, $etat_semaine_visible)
/*
Dictionnaire des variables:
---------------------------
$semaine_en_cours:         Numéro de la semaine sur lequel la fonction va travailler (entre 1 et 52)
$annee_en_cours:           Année sur lequel travail la fonction
$etat_semaine_visible:     0=Seul ceux qui peuvent modifier peuvent voir la semaine, 1=Visible par tout le monde
*/
{

//Basculement de l'état de visiblité de la semaine demandée
         if ($etat_semaine_visible==0)
         {
            $etat_semaine_visible=1;
         }
         elseif ($etat_semaine_visible==1)
         {
            $etat_semaine_visible=0;
         }

//Construction de la requête SQL
         $req1 = "UPDATE planning_presence_semaine_visible ";
         $req1.= "SET visible_planning_presence_semaine_visible=$etat_semaine_visible ";
         $req1.= "WHERE annee_planning_presence_semaine_visible=$annee_en_cours ";
         $req1.= "AND id_planning_presence_semaine_visible=$semaine_en_cours";

//Execution de la requete de mise à jour
         $result1=mysql_query($req1);
}

//Mise a jour du planning d'un salarié et renvoi la semaine en cours
//******************************************************************
function mise_a_jour_lieu_salarie($id_salaries, $id_jour, $semaine_en_cours, $annee_en_cours, $radio_type_jour, $lieu, $lieu1, $lieu2, $supprimer, $toute_semaine)
/*
Dictionnaire des variables:
---------------------------
$semaine_en_cours:         Numéro de la semaine sur lequel la fonction va travailler (entre 1 et 52)
$annee_en_cours:           Année sur lequel travail la fonction
$id_salaries:              Numéro identifiant du salariés (cf table 'salaries' / champ 'id_user')
$id_jour:                  1=Lundi, 2=Mardi ...etc.
$radio_type_jour:          0=Journée Complète et 1=Deux demi-journée
$lieu:                     Lieu pour une journée complète
$lieu1:                    Lieu pour un matinée
$lieu2:                    Lieu pour un Après-midi
$supprimer:                La journée sera initialisé avec tous les lieux à '?' et $radio_type_jour=0
$toute_semaine:            Effectue le traitement pour l'ensemble de la semaine
*/
{


//Définition de la condition WHERE
         $txt_where = " WHERE id_salaries=$id_salaries";
         $txt_where.= " AND id_planning_presence_semaine_visible=$semaine_en_cours";
         $txt_where.= " AND annee_planning_presence_semaine_visible=$annee_en_cours";

         //Notions de semaines ou journée
         if ($toute_semaine<>1)
         {
            $txt_where.= " AND id_annexe_jours_semaine=$id_jour";
         }

//Création de la requête
         //Requête d'initialisation
         if ($supprimer==1)
         {
            //Suppression des informations
            $req1 = "DELETE FROM planning_presence_detail";
            $req1.= "$txt_where";

            //echo "$req1"."<br>";
            $result1=mysql_query($req1);

            //initialisations des informations
            //Préparation du tronc commun de la requête
            $req1 = "INSERT INTO planning_presence_detail";
            $req1.= " ( id_salaries";
            $req1.= " , id_planning_presence_semaine_visible";
            $req1.= " , annee_planning_presence_semaine_visible";
            $req1.= " , jour_type_planning_presence_detail";
            $req1.= " , lieu_1_planning_presence_detail";
            $req1.= " , lieu_2_planning_presence_detail";
            $req1.= " , id_annexe_jours_semaine";
            $req1.= " ) VALUES";
            $req1.= " ( '$id_salaries'";
            $req1.= " , '$semaine_en_cours'";
            $req1.= " , '$annee_en_cours'";
            $req1.= " , '0'";
            //Mise en commentaire suite à la demande utilisateur - 2003.04.22
            //$req1.= " , '$lieu'";
            $req1.= " , '?'";
            $req1.= " , '?'";

            if ($toute_semaine==1)
            {
               $i = 1;
               while ($i <=7)
               {
                     $req_2 = $req1." , '$i')";
                     $i=$i+1;
                     $result1=mysql_query($req_2);
               }
            }
            else
            {
               $req1.= " , '$id_jour')";
               $result1=mysql_query($req1);
            }

         }
         //Requête de mise à jour
         else
         {
            //Contrôle des variables vides
            if ($lieu=="")
            {
               $lieu="?";
            }
            if ($lieu1=="")
            {
               $lieu1="?";
            }

            if ($lieu2=="")
            {
               $lieu2="?";
            }


            $req1 = "UPDATE planning_presence_detail";
            $req1.= " SET jour_type_planning_presence_detail='$radio_type_jour'";

            //Selection du type de journée (Complète ou Matin/Après-midi)
            if ($radio_type_jour==0)
            {
               $lieu_slashes=addslashes($lieu);
               $req1.= " , lieu_1_planning_presence_detail='$lieu_slashes'";
               $req1.= " , lieu_2_planning_presence_detail='?'";
            }
            if ($radio_type_jour==1)
            {
               $lieu1_slashes=addslashes($lieu1);
               $lieu2_slashes=addslashes($lieu2);
               $req1.= " , lieu_1_planning_presence_detail='$lieu1_slashes'";
               $req1.= " , lieu_2_planning_presence_detail='$lieu2_slashes'";
            }

            //Intégration de la clause WHERE (Conditions)
            $req1.= $txt_where;
            $result1=mysql_query($req1);
         }

//Formatage de la sélection de la semaine
         if ($semaine_en_cours<"10")
         {
            $selection_semaine_en_cours = "0"."$semaine_en_cours";
         }
         else
         {
            $selection_semaine_en_cours = "$semaine_en_cours";
         }
         $selection_semaine_en_cours.= $selection_semaine_en_cours."-".$annee_en_cours;

         return "selection_semaine_en_cours=$selection_semaine_en_cours&action=Rechercher";
}

/*Création de la liste des semaines du module
/*******************************************/
//$selection_active: si =0, alors aucune action, si =1 la liste envoi directement vers le lien
function selection_semaine_en_cours($semaine_en_cours, $annee_en_cours, $planning_presence_modification, $selection_active)
{
         //Construction du tableau
         $liste_semaine_visible=mysql_query(req_liste_semaine_visible($planning_presence_modification));

         //Construction du lien:
         if ($selection_active==1)
         {
              $lien="index.php?selection_semaine_en_cours=";
         }
         else
         {
              $lien="";
         }

         //Formatage de la semaine en cours
         if ($semaine_en_cours>=10)
         {
              $semaine_en_cours_format=$semaine_en_cours;
         }
         else
         {
              $semaine_en_cours_format="0".$semaine_en_cours;
         }

         //Création de la liste déroulante
         $liste_deroulante_semaine="<select name=selection_semaine_en_cours onChange=lien_selection_semaine_en_cours()>";
         while ($rows1=mysql_fetch_array($liste_semaine_visible))
         {
              //Formatage des semaines de la liste des semaines visibles
              $semaine_liste=$rows1[id_planning_presence_semaine_visible];
              $annee_liste=$rows1[annee_planning_presence_semaine_visible];
              if ($semaine_liste>=10)
              {
                   $semaine_liste_format=$semaine_liste;
              }
              else
              {
                   $semaine_liste_format="0".$semaine_liste;
              }
              $valeur=$semaine_liste_format."-".$annee_liste;

              $liste_deroulante_semaine.="<option value=".$lien.$valeur;

              //Selection de la semaine en cours
              if ($semaine_en_cours_format."-".$annee_en_cours==$valeur)
              {
                    $liste_deroulante_semaine.=" selected";
              }
              $liste_deroulante_semaine.=">$valeur</option>";
         }
         $liste_deroulante_semaine=$liste_deroulante_semaine."</select>";

         //Affichage de la liste déroulante
         return $liste_deroulante_semaine;
}

/*Requête selectionnant les semaines visibles par l'utilsateur
/************************************************************/
function req_liste_semaine_visible($planning_presence_modification)
{
   $req_liste_semaine_visible ="SELECT * FROM planning_presence_semaine_visible ";

   //Droit d'accès aux semaines en cours de modification

   if ($planning_presence_modification==0)
   {
      $req_liste_semaine_visible.="WHERE visible_planning_presence_semaine_visible=1 ";
   }
   $req_liste_semaine_visible.="ORDER BY annee_planning_presence_semaine_visible DESC, ";
   $req_liste_semaine_visible.="id_planning_presence_semaine_visible DESC";
   return $req_liste_semaine_visible;
}

/*Création d'une nouvelle semaine
/*******************************/
function creer_semaine($semaine_a_creer, $annee_a_creer, $selection_semaine_en_cours, $recuperer_liste_utilisateur, $recuperer_planning_utilisateur, $planning_presence_modification)
{
   //Récupération de la semaine source
   $semaine_source=recuperation_semaine_en_cours($selection_semaine_en_cours, $planning_presence_modification);
   $annee_source=recuperation_annee_en_cours($selection_semaine_en_cours, $planning_presence_modification);

   //Paramètres par défaut
   //Les semaines créées sont à l'état "En cours de modification"
   $visible_planning_presence_semaine_visible=0;

   //Création de la nouvelle semaine
   $req1 = "INSERT INTO planning_presence_semaine_visible (";
   $req1.= "id_planning_presence_semaine_visible, ";
   $req1.= "annee_planning_presence_semaine_visible, ";
   $req1.= "visible_planning_presence_semaine_visible) ";
   $req1.= "VALUES (";
   $req1.= "$semaine_a_creer, ";
   $req1.= "$annee_a_creer, ";
   $req1.= "$visible_planning_presence_semaine_visible)";
   $result1=mysql_query($req1);

   //Selection des planning des utilisateurs à récupérér
   if ($recuperer_liste_utilisateur)
   {
         $req1 = "SELECT * FROM planning_presence_detail, geo, salaries ";
         $req1.= "WHERE id_planning_presence_semaine_visible=$semaine_source ";
         $req1.= "AND salaries.id_user=planning_presence_detail.id_salaries ";
         $req1.= "AND salaries.lieu_geo=geo.id_geo ";
         $req1.= "AND annee_planning_presence_semaine_visible=$annee_source";
         $planning_utilisateur=mysql_query($req1);

         //Création du détail du planning avec la liste des utilisateurs
         while ($rows1=mysql_fetch_array($planning_utilisateur))
         {
               $req1 = "INSERT INTO planning_presence_detail (";
               $req1.= "id_salaries, ";
               $req1.= "id_planning_presence_semaine_visible, ";
               $req1.= "annee_planning_presence_semaine_visible, ";
               $req1.= "id_annexe_jours_semaine, ";
               $req1.= "jour_type_planning_presence_detail, ";
               $req1.= "lieu_1_planning_presence_detail, ";
               $req1.= "lieu_2_planning_presence_detail) ";
               $req1.= "VALUES (";
               $req1.= "$rows1[id_salaries],";
               $req1.= "$semaine_a_creer, ";
               $req1.= "$annee_a_creer, ";
               $req1.= "$rows1[id_annexe_jours_semaine], ";

               //Récupération du planning des la semaine copiée
               if ($recuperer_planning_utilisateur)
               {
                     $req1.= "$rows1[jour_type_planning_presence_detail] , ";
                     $req1.= "'$rows1[lieu_1_planning_presence_detail]' , ";
                     $req1.= "'$rows1[lieu_2_planning_presence_detail]') ";
               }
               //Sinon initialisation des journées du planning pour les utilisateurs copiés
               else
               {
                     $req1.= "0 , ";

                     //Mise en commentaire suite à une demande utilisateur - 2003.04.22
                     //$req1.= "'$rows1[geo]' , ";
                     $req1.= "'?' , ";
                     $req1.= "'?' ) ";
               }
               $result1=mysql_query($req1);
         }
   }
   return "semaine_en_cours=$semaine_a_creer&annee_en_cours=$annee_a_creer";
}

/*Récupératin de la semaine en cours à partir d'une selection d'une semaine
/*************************************************************************/
function recuperation_semaine_en_cours($selection_semaine_en_cours, $planning_presence_modification)
{
   if (isset ($selection_semaine_en_cours))
   {
         //Récupération du premier caractère de la selection de la semaine_en_cours
         $premier_caractere=substr($selection_semaine_en_cours, 0, 1);

         //Formatage et affectation de la semaine en cours
         if ($premier_caractere=="0")
         {
               $semaine_en_cours=substr($selection_semaine_en_cours, 1, 1);
         }
         else
         {
               $semaine_en_cours=substr($selection_semaine_en_cours, 0, 2);
         }

         //Affectation de l'année en cours
         //$annee_en_cours=substr($selection_semaine_en_cours, -4);
   }
   else
   {
         //Construction du tableau de la liste des semaines visibles par l'utilisateur
         $liste_semaine_visible=mysql_query(req_liste_semaine_visible($planning_presence_modification));

         //Affectation de la semaine en cours
         if (mysql_num_rows($liste_semaine_visible))
         {
            $semaine_en_cours=mysql_result($liste_semaine_visible, 0, id_planning_presence_semaine_visible);
         }
         else
         {
             $semaine_en_cours='0';
         }
   }
   return $semaine_en_cours;
}

/*Récupératin de l'année en cours à partir d'une selection d'une semaine
/**********************************************************************/
function recuperation_annee_en_cours($selection_semaine_en_cours, $planning_presence_modification)
{
   if (isset ($selection_semaine_en_cours))
   {
         //Affectation de l'année en cours
         $annee_en_cours=substr($selection_semaine_en_cours, -4);
   }
   else
   {
         //Construction du tableau de la liste des semaines visibles par l'utilisateur
         $liste_semaine_visible=mysql_query(req_liste_semaine_visible($planning_presence_modification));

         //Affectation de l'année en cours
         if (mysql_num_rows($liste_semaine_visible))
         {
             $annee_en_cours=mysql_result($liste_semaine_visible, 0, annee_planning_presence_semaine_visible);
         }
         else
         {
             $annee_en_cours='2003';
         }
   }
   return $annee_en_cours;
}

/*Suppression d'une semaine
/*************************/
function supprimer_semaine($selection_semaine_en_cours, $planning_presence_modification)
{

   //Récupération de la semaine source
   $semaine_en_cours=recuperation_semaine_en_cours($selection_semaine_en_cours, $planning_presence_modification);
   $annee_en_cours=recuperation_annee_en_cours($selection_semaine_en_cours, $planning_presence_modification);

   //Suppression de la semaine
   $req1 = "DELETE FROM planning_presence_semaine_visible ";
   $req1.= "WHERE id_planning_presence_semaine_visible=$semaine_en_cours ";
   $req1.= "AND annee_planning_presence_semaine_visible=$annee_en_cours";
   $result1=mysql_query($req1);

   //Suppression de la semaine
   $req1 = "DELETE FROM planning_presence_detail ";
   $req1.= "WHERE id_planning_presence_semaine_visible=$semaine_en_cours ";
   $req1.= "AND annee_planning_presence_semaine_visible=$annee_en_cours";
   $result1=mysql_query($req1);

}
?>