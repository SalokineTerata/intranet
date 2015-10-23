<?php
/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répertoire courant
 */
//   $module=substr(strrchr(`pwd`, '/'), 1);
//   $module=trim($module);
require_once '../inc/main.php';
print_page_begin($disable_full_page, $menu_file);
flush();

$planning_presence_modification = Lib::isDefined('planning_presence_modification');
$id_groupe = Lib::isDefined('id_groupe');
$selection_semaine_en_cours = Lib::isDefined('selection_semaine_en_cours');
$semaine_en_cours = Lib::isDefined('semaine_en_cours');
$annee_en_cours = Lib::isDefined('annee_en_cours');
/*
  Si la page peut être appelée depuis n'importe quel module,
  décommentez la ligne suivante
 */

//   $module='';
//Inclusions
//Sélection du mode de visualisation de la page
//switch($output)
//{
//
//  case 'visualiser':
//       //Inclusions
//       include ("../lib/session.php");         //Récupération des variables de sessions
//       include ("../lib/functions.php");       //On inclus seulement les fonctions sans construire de page
//       include ("functions.php");              //Fonctions du module
//       echo "
//            <link rel=stylesheet type=text/css href=../lib/css/intra01.css />
//            <link rel=stylesheet type=text/css href=visualiser.css />
//       ";
//
//  //break;
//  case 'pdf':
//  break;
//
//  default:
//        //Inclusions
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
//}//Fin de la sélection du mode d'affichage de la page
//Autorisation de d'accéder à cette page:
if ($planning_presence_modification == 0) {
    header("Location: none.php");
}
?>
<html>

    <head>
        <title>Ajout d'un salarié - Planning des présences</title>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
        <meta name="generator" content="HAPedit 2.4">
    </head>
    <body bgcolor="#FFFFFF">
<?
/* -----------------------------------------
  Ajout d'un salarié dans la semaine en cours
  ----------------------------------------- */

//Construction du formulaire
echo "<form name=ajouter_salarie method=post action=action.php>";

//Utilisation des champs cachés pour faire
//passer des informations importantes pour la suite du traitement:
$txt1 = "<input type=hidden name=action value=ajout_salarie_semaine_en_cours>";
$txt1.= "<input type=hidden name=id_groupe value=" . $id_groupe . ">";
$txt1.= "<input type=hidden name=semaine_en_cours value=" . $semaine_en_cours . ">";
$txt1.= "<input type=hidden name=annee_en_cours value=" . $annee_en_cours . ">";
echo "$txt1";

//Requête de récupération de la liste des salariés
//pouvant être saisies dans le planning des présences
$req1 = "SELECT salaries.id_user, salaries.nom, salaries.prenom, geo.id_geo ";
$req1.= "FROM geo, salaries, access_materiel_service ";
$req1.= "WHERE (geo.id_geo=$id_groupe ";
$req1.= "AND salaries.id_service=access_materiel_service.K_service) ";
$req1.= "AND salaries.actif='oui' ";
//Restriction des comptes spéciaux
$req1.= "AND salaries.nom<>'SYSTEM' ";
//Restriction à partir des Cadres
$req1.= "AND salaries.id_catsopro>='5'";
$req1.= "ORDER BY nom ASC";
//echo $req1;
$result1 = mysql_query($req1);

//Création de la liste de sélection
$liste1 = "<select name=liste_id_user[] size=20 multiple>";
while ($rows1 = mysql_fetch_array($result1)) {
    $nom_user = stripslashes($rows1[nom]);
    $prenom_user = stripslashes($rows1[prenom]);
    $liste1.= "<option value=$rows1[id_user]>";
    $liste1.= $nom_user . " " . $prenom_user;
    $liste1.= "</option>";
}
$liste1.="</select>";

//Construction du Tableau
echo "<table align=center border=1>";
echo "<tr>";
echo "<td>";

echo "$liste1";

echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align=center>";
echo "<input type=submit value=Ajouter>";
echo "</td>";
echo "</tr>";

echo "</table>";
echo "</form>";
include ("../lib/fin_page.inc");
?>

