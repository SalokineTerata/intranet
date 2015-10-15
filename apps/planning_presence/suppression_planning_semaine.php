<?php
/*
Module d'appartenance (valeur obligatoire)
Par défaut, le nom du module est le répertoire courant
*/
//   $module=substr(strrchr(`pwd`, '/'), 1);
//   $module=trim($module);


/*
Si la page peut être appelée depuis n'importe quel module,
décommentez la ligne suivante
*/

//   $module='';

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
$planning_presence_modification = Lib::isDefined('planning_presence_modification');
//Autorisation de d'accéder à cette page:
if ($planning_presence_modification==0)
{
   header ("Location: ../lib/acces_interdit.php");
}


?>
<html>

<head>
<title>Suppression d'une semaine</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<meta name="generator" content="HAPedit 2.4">
</head>
<body bgcolor="#FFFFFF">
<?php

//Requête donnant la dernière semaine saisie
$req1 = "SELECT * FROM planning_presence_semaine_visible ";
$req1.= "ORDER BY annee_planning_presence_semaine_visible DESC ";
$req1.= ", id_planning_presence_semaine_visible DESC";
$result1=mysql_query($req1);
if (mysql_num_rows($result1))
{
   $semaine_en_cours=mysql_result($result1, 0, id_planning_presence_semaine_visible);
   $annee_en_cours=mysql_result($result1, 0, annee_planning_presence_semaine_visible);

   //Création du formulaire
   echo "<form name=creation_semaine method=post action=action.php>";
   echo "<input type=hidden name=action value=supprimer_semaine>";

   //Tableau de la semaine à supprimer
   echo "<table border=1 width=50% align=center>";
   echo "<tr>";
   echo "<td>";
   echo "Semaine à supprimer: ";
   echo "</td>";
   echo "</tr>";
   echo "<tr align=right>";
   echo "<td>";
   echo "Selection de la semaine: ";
   $selection_active=0;
   echo selection_semaine_en_cours($semaine_en_cours, $annee_en_cours, $planning_presence_modification, $selection_active);
   echo "</td>";
   echo "</tr>";
   echo "</table>";
   echo "<br>";

   //Tableau des options
   echo "<table border=1 width=50% align=center>";
   echo "<tr>";
   echo "<td align=center>";
   echo "<input type=submit value=`Lancer la suppression de la semaine`>";
   echo "</td>";
   echo "</tr>";
   echo "</table>";
   echo "<br>";

   echo "</form>";
}
else
{
   echo "Aucune semaine diponible";
}

include ("../lib/fin_page.inc");
?>

