<?
/*
Module d'appartenance (valeur obligatoire)
Par défaut, le nom du module est le répertoire courant
*/
   $module=substr(strrchr(`pwd`, '/'), 1);
   $module=trim($module);


/*
Si la page peut être appelée depuis n'importe quel module,
décommentez la ligne suivante
*/

//   $module='';

//Inclusions

//Sélection du mode de visualisation de la page
switch($output)
{

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
        include ("../lib/session.php");         //Récupération des variables de sessions
        include ("../lib/debut_page.php");      //Construction d'une nouvelle
        if (isset($menu))                       //Si existant, utilisation du menu demandé
        {                                       //en variable
           include ("./$menu");
        }
        else
        {
           include ("./menu_principal.inc");    //Sinon, menu par défaut
        }

}//Fin de la sélection du mode d'affichage de la page



/* include ("../lib/session.php");
require_once ("../lib/functions.php");
include ("../lib/debut_page.php");
include ("./options.inc");
 */
/*------------------------------------
Présentation du planning de la semaine
------------------------------------*/

/*
Dictionnaire des variables:
---------------------------
$id_intranet_droits_acces: Numéro identifiant le droit d'accès sur lequel on va travailler
      Par exemple le droit de "Consultation" pour le module "planning_presence" est "1". Pour plus d'information,
      voir les tables intranet_actions_par_modules et intranet_droits_acces
$id_user:                  Numéro identifiant de l'utilisateur connecté dans l'intranet
$droit_consultation:       0=Interdit de consulter le module, 1=Autorisé à consulter le module
$droit_modification:       0=Interdit de consulter le module, 1=Autorisé à modifier le module
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
$selection_semaine_en_cours: Identification de la semaine sous la forme SS-AAAA ex: 02-2003
*/

/*
Si aucune information de selection de semaine en cours n'est récupérée, la
dernière semaine est selectionnée par défaut en temps que semaine en cours en
raison du tri effectué sur la requête "req_liste_semaine_visible" précédente.
En revanche, si "$selection_semaine_en_cours" existe, sa valeur est utilisée
pour définir la semaine en cours.
*/

/*
Récupération des informations sur la semaine en cours si elle existe
selection_semaine_en_cours est de la forme SS-AAAA (ex: 02-2003)
$semaine_en_cours est au format numérique (ex: 2)
*/
if (!isset($semaine_en_cours))
{
   $semaine_en_cours=recuperation_semaine_en_cours($selection_semaine_en_cours, $planning_presence_modification);
}

if (!isset($annee_en_cours))
{
$annee_en_cours=recuperation_annee_en_cours($selection_semaine_en_cours, $planning_presence_modification);
}

//Construction de la barre de recherche d'une semaine
echo "<form name=recherche_semaine method=post action=index.php>";
echo "<table class=titre border=0 width=100%>";
echo "<tr>";
echo "<td >";
echo "Planning des rendez-vous";
echo "</td>";

//Liste déroulante pour sélectionner la semaine en cours
echo "<td>";
echo "Semaine: ";
echo "</td>";
echo "<td>";
$selection_active=1; //Détermine si la liste renvoi directement sur la page: 0=Non et 1=Oui
echo selection_semaine_en_cours($semaine_en_cours, $annee_en_cours, $planning_presence_modification, $selection_active);
echo " ";

//Validation de la recherche de la semaine selectionnée
//echo "<input type=submit name=action value=Rechercher>";
echo "</td>";
echo "</form>";

//Lien premettant de définir si la semaine est visible ou non
//Droits d'accès
if ($planning_presence_modification==1)
{
   echo "<td>";
   $req1 = "SELECT * FROM planning_presence_semaine_visible ";
   $req1.= "WHERE id_planning_presence_semaine_visible=$semaine_en_cours ";
   $req1.= "AND annee_planning_presence_semaine_visible=$annee_en_cours";
   $result1=mysql_query($req1);
   if (mysql_num_rows($result1))
   {
      $semaine_visible=mysql_result($result1, 0 ,visible_planning_presence_semaine_visible);
      $txt1 = "Etat: ";
      if ($semaine_visible==1)
      {
         $txt1.= "Publié";
      }
      else
      {
         $txt1.= "En cours de modifications";
      }
      $lien1 = "<a href=action.php";
      $lien1.= "?action=etat_semaine_visible";
      $lien1.= "&etat_semaine_visible=$semaine_visible";
      $lien1.= "&semaine_en_cours=$semaine_en_cours";
      $lien1.= "&annee_en_cours=$annee_en_cours";
      $lien1.= ">";
      $lien1.= "$txt1";
      $lien1.= "</a>";
      echo "$lien1";
   }
   echo "</td>";
}

//Revenir à la semaine le plus récente
echo "<td>";
echo "<a href=index.php>Semaine en cours</a>";
echo "</td>";
echo "</tr>";

//Construction du planning
//Affichage des différents groupes
$req1 = "select * from geo WHERE id_site IS NOT NULL AND ordre_planning_presence_geo<>0 AND site_actif=1 order by ordre_planning_presence_geo asc";
$result1 = mysql_query($req1);
echo "<table class=contenu width=100% border=1>";
while ($rows1=mysql_fetch_array($result1))
{

    echo "<tr class=titre>";
    echo "<td>";
    echo stripslashes($rows1["geo"]);
    echo "</td>";

    //Affichage des jours de la semaine (entête de colonne)
    $req2 = "select * from annexe_jours_semaine where id_annexe_jours_semaine<=$maximum_jours order by id_annexe_jours_semaine asc";
    $result2 = mysql_query($req2);
    while ($rows2=mysql_fetch_array($result2))
    {
        echo "<td width=15%>";
        echo stripslashes($rows2[nom_annexe_jours_semaine]);
        echo "</td>";
    }
    //Affichage de la colonne des actions sur les utilisateurs

       echo "<td>";
       //Création du lien
       $lien1 = "<a href=ajout_salarie_semaine_en_cours.php";
       $lien1.= "?semaine_en_cours=$semaine_en_cours";
       $lien1.= "&annee_en_cours=$annee_en_cours";
       $lien1.= "&id_groupe=".$rows1["id_geo"];
       $lien1.= ">Ajouter</a>";

       //Droit d'accès
       if ($planning_presence_modification==1)
       {
          echo "$lien1";
       }
       echo "</td>";


    //Affichage des différents services
    //$req3 = "select * from services where id_groupe=$rows1[id_groupe] order by intitule_ser asc";
    $req3 = "SELECT `access_materiel_service`.`K_service`, `access_materiel_service`.`nom_service` "
          . "FROM `access_materiel_service`, `salaries`, `geo`, planning_presence_detail "
          . "WHERE ( `access_materiel_service`.`K_service` = `salaries`.`id_service` "
          . "AND `geo`.`id_geo` = `salaries`.`lieu_geo` ) "
          . "AND ( ( `geo`.`id_geo` = ".$rows1["id_geo"]." ) ) "
          . "AND salaries.id_user=planning_presence_detail.id_salaries "
          . "AND id_planning_presence_semaine_visible='".$semaine_en_cours."' "
          . "AND annee_planning_presence_semaine_visible='".$annee_en_cours."' "
          . "GROUP BY `access_materiel_service`.`K_service`, `access_materiel_service`.`nom_service`"
          ;
    $result3 = mysql_query($req3);
    while ($rows3=mysql_fetch_array($result3))
    {
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo "</td>";
        echo "</tr>";
        $result4=tableau_planning_selectionne($semaine_en_cours, $annee_en_cours, $rows3["K_service"], $rows1["id_geo"]);
        while ($rows4=mysql_fetch_array($result4))
        {
            echo "<tr>";
            echo "<td>";
            echo stripslashes($rows4[nom])." ".stripslashes($rows4[prenom]);
            echo "</td>";

            //Balayages des jours de la semaine
            $i=1;
            while ($i<=$maximum_jours)
            {
               //Détermination des lieux par journée
               $result5=tableau_planning_selectionne_jour($semaine_en_cours, $annee_en_cours, $rows4[id_salaries], $i);
               $count5=mysql_num_rows ($result5);
               $txt1 = "<a href=modification_lieu_salarie.php";
               $txt1.= "?id_salaries=$rows4[id_salaries]";
               $txt1.= "&id_jour=$i";
               $txt1.= "&id_semaine=$semaine_en_cours";
               $txt1.= "&annee=$annee_en_cours";
               $txt1.= ">";
               $txt3 = "</a>";
               if ($count5==0)
               {
                   $txt2 = "?";
               }
               else
               {
                   while ($rows5=mysql_fetch_array($result5))
                   {
                      $lieu_1_mysql=$rows5[lieu_1_planning_presence_detail];
                      $lieu_2_mysql=$rows5[lieu_2_planning_presence_detail];
                      $lieu_1=stripslashes($lieu_1_mysql);
                      $lieu_2=stripslashes($lieu_2_mysql);
                      if ($rows5[jour_type_planning_presence_detail]==0)
                      {
                           $txt2 = $lieu_1 ;
                      }
                      elseif ($rows5[jour_type_planning_presence_detail]==1)
                      {
                           $txt2 = $lieu_1;
                           $txt2.= " / ";
                           $txt2.= $lieu_2;
                      }
                   }
               }

//Affichage du lieu
//Droit d'accès sur la possibilité de pouvoir modifier le lieu défini
               echo "<td align=center>";
               if ($planning_presence_modification==0)
                   {
                      echo $txt2;
                   }
               if ($planning_presence_modification==1)
                   {
                      echo $txt1.$txt2.$txt3;
                   }
               echo "</td>";
               $i=$i+1;
            }

//Création du lien de suppression de chaque utilisateur pour la semaine en cours
//Droits d'accès
                if ($planning_presence_modification==1)
                {
                   echo "<td>";
                   $txt1 = "<a href=action.php";
                   $txt1.= "?action=suppression";
                   $txt1.= "&id_salaries=$rows4[id_salaries]";
                   $txt1.= "&semaine_en_cours=$semaine_en_cours";
                   $txt1.= "&annee_en_cours=$annee_en_cours";
                   $txt1.= ">Supprimer</a>";
                   echo "$txt1";
                   echo "</td>";
                   echo "</tr>";
                }
        }
    }
}
echo "</table>";
echo "<br>";
include ("../lib/fin_page.inc");
?>

