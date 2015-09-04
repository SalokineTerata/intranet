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

//Autorisation de d'accéder à cette page:
if ($planning_presence_modification==0)
{
   header ("Location: none.php");
}
?>
<html>

<head>
<title>Modification du planning</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<meta name="generator" content="HAPedit 2.4">
</head>
<body bgcolor="#FFFFFF">
<?

/*-------------------------------------------
Modification du lieu de présence d'un salarié
-------------------------------------------*/

/*
Dictionnaire des variables:
---------------------------
$prenom_salaries:          Prenom du salarié
$nom_salaries:             Nom du salarié
$semaine_en_cours:         Numéro de la semaine sur lequel la page va travailler (entre 1 et 52)
$id_semaine:               Numéro d'une semaine envoyée à la page
$annee_en_cours:           Année sur lequel travail la fonction
$annee:                    Année envoyée à la page
$id_salaries:              Numéro identifiant du salarié (cf table 'salaries' / champ 'id_user')
$id_jour:                  1=Lundi, 2=Mardi ...etc.
$jour_en_cours             Nom du jour
$jour_type:                0=Journée Complète et 1=Deux demi-journée
$lieu1:                    Lieu pour une journée complète ou lieu pour un matinée
$lieu2:                    Lieu pour un Après-midi
*/

//Détermination des informations du salarié dont le planning est en cours de modification
$req1 = "SELECT * FROM salaries ";
$req1.= "WHERE id_user=$id_salaries";
$result1=mysql_query($req1);
$prenom_salaries_slashes=mysql_result($result1, 0, prenom);
$nom_salaries_slashes=mysql_result($result1, 0, nom);
$prenom_salaries=stripslashes($prenom_salaries_slashes);
$nom_salaries=stripslashes($nom_salaries_slashes);

//Détermination du moment en cours de modification
//Formatage de la semaine
$taille1=strlen($id_semaine);
$test1=substr($id_semaine, 0, 1);
while ($test1==0)
{
      $id_semaine=substr($id_semaine,1-$taille);
      $taille1=strlen($id_semaine);
      $test1=substr($id_semaine, 0, 1);
}
$semaine_en_cours=$id_semaine;
$annee_en_cours=$annee;
$req1 = "SELECT * FROM annexe_jours_semaine ";
$req1.= "WHERE id_annexe_jours_semaine=$id_jour";
$result1=mysql_query($req1);
$jour_en_cours=mysql_result($result1, 0, nom_annexe_jours_semaine);

//Caratéristiques de la journée en cours de modifications
$req1 = "SELECT * FROM planning_presence_detail ";
$req1.= "WHERE id_salaries=$id_salaries ";
$req1.= "AND id_planning_presence_semaine_visible=$semaine_en_cours ";
$req1.= "AND annee_planning_presence_semaine_visible=$annee_en_cours ";
$req1.= "AND id_annexe_jours_semaine=$id_jour";
$result1=mysql_query($req1);
$jour_type=mysql_result($result1, 0, jour_type_planning_presence_detail);
$lieu_1_mysql=mysql_result($result1, 0, lieu_1_planning_presence_detail);
$lieu_2_mysql=mysql_result($result1, 0, lieu_2_planning_presence_detail);
$lieu_1=StripSlashes($lieu_1_mysql);
$lieu_2=StripSlashes($lieu_2_mysql);
//$lieu_1_html=htmlentities($lieu_1, ENT_QUOTES);
//$lieu_2_html=htmlentities($lieu_2, ENT_QUOTES);


//Sélection par défaut du bouton radio définissant si la journée est de type
//Complète ou Matin/Après-midi.
if ($jour_type==0)
{
   $check1 ="";
   $check2 ="checked";
}

if ($jour_type==1)
{
   $check1 ="checked";
   $check2 ="";
}

//Création du formulaire de saisie
echo "<form name=formulaire1 method=post action=action.php>";

// Utilisation des champs cachés pour faire
//passer des informations importantes pour la suite du traitement:
$txt1 = "<input type=hidden name=action value=validation_modification_lieu_salarie>";
$txt1.= "<input type=hidden name=id_salaries value=$id_salaries>";
$txt1.= "<input type=hidden name=id_jour value=$id_jour>";
$txt1.= "<input type=hidden name=semaine_en_cours value=$semaine_en_cours>";
$txt1.= "<input type=hidden name=annee_en_cours value=$annee_en_cours>";
echo "$txt1";

//Création du tableau
echo "<table border=1 width=50% align=center>";
echo "<tr>";
echo "<td>";
echo "<u>Informations Générales:</u>";
echo "<BR>";
echo "Salarié: ";
echo "$nom_salaries";
echo " ";
echo "$prenom_salaries";
echo "<BR>";
echo "Jour: ";
echo "$jour_en_cours";
echo "<br>";
echo "Semaine: ";
echo "$semaine_en_cours";
echo "<br>";
echo "Année: ";
echo "$annee_en_cours";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<input type=radio name=radio_type_jour value=0 $check2>Journée Complète";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align=right>";
echo "Lieu: ";
/*echo $lieu_1;
echo $lieu_1_html*/
echo "<input type=text name=lieu value=`$lieu_1` size=20>";
echo "</td>";
echo "</tr>";
//Saut de quelques lignes
echo "<tr>";
echo "<td>";
echo "<p>";
echo "</p>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<input type=radio name=radio_type_jour value=1 $check1>Matin / Après-Midi";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align=right>";
echo "Matin: ";
echo "<input type=text name=lieu1 value=`$lieu_1` size=20>";
echo "<br>";
echo "Après-midi: ";
echo "<input type=text name=lieu2 value=`$lieu_2` size=20>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align=left>";
echo "<input type=checkbox name=supprimer value=1> ";
echo "Supprimer le planning de cette journée.";
echo "<br>";
echo "<input type=checkbox name=toute_semaine value=1> ";
echo "Faire pareil pour toute la semaine.";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align=right>";
echo "<input type=submit value='Suivant >>'>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</form>";
echo "";

include ("../lib/fin_page.inc");
?>

