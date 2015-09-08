<?

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
$id_groupe = Lib::isDefined('id_groupe');

//Autorisation de d'accéder à cette page:
if ($planning_presence_modification == 0) {
    header("Location: none.php");
}


//Requête donnant la dernière semaine saisie
$req1 = "SELECT * FROM planning_presence_semaine_visible ";
$req1.= "ORDER BY annee_planning_presence_semaine_visible DESC ";
$req1.= ", id_planning_presence_semaine_visible DESC";
$result1 = mysql_query($req1);
if (mysql_num_rows($result1)) {
    $derniere_semaine = mysql_result($result1, 0, id_planning_presence_semaine_visible);
    $derniere_annee = mysql_result($result1, 0, annee_planning_presence_semaine_visible);
} else {
    $derniere_semaine = '0';
    $derniere_annee = '2003';
}

//Sélection de la semaine source servant à la copie
//Par défaut c'est la dernière semaine saisie
$semaine_en_cours = $derniere_semaine;
$annee_en_cours = $derniere_annee;


//Détermination de la nouvelle semaine_a_creer par défaut
if ($derniere_semaine >= 52) {
    $semaine_a_creer = 1;
    $annee_a_creer = $derniere_annee + 1;
} else {
    $semaine_a_creer = $derniere_semaine + 1;
    $annee_a_creer = $derniere_annee;
}

//Variable definissant s'il faut récuperer la liste des utilisateurs
//Valeur par défaut: 0=non et 1=oui
$recuperer_liste_utilisateur = 1;

//La case à cocher est cochée selon la valeur de "$recuperer_liste_utilisateur"
if ($recuperer_liste_utilisateur == 0) {
    $recuperer_liste_utilisateur_checked = "";
} else {
    $recuperer_liste_utilisateur_checked = "checked";
}

//Variable definissant s'il faut récuperer le planning des utilisateurs
//Valeur par défaut: 0=non et 1=oui
$recuperer_planning_utilisateur = 0;

//La case à cocher est cochée selon la valeur de "$recuperer_planning_utilisateur"
if ($recuperer_planning_utilisateur == 0) {
    $recuperer_planning_utilisateur_checked = "";
} else {
    $recuperer_planning_utilisateur_checked = "checked";
}

//Création du formulaire
echo "<form name=creation_semaine method=post action=action.php>";
echo "<input type=hidden name=action value=creer_semaine>";

//Tableau de la semaine à créer
echo "<table border=1 width=50% align=center>";
echo "<tr>";
echo "<td>";
echo "Créer la semaine: ";
echo "</td>";
echo "</tr>";
echo "<tr align=right>";
echo "<td>";
echo "Numéro de la semaine: ";
echo "<input type=text name=semaine_a_creer value=$semaine_a_creer >";
echo "<br>";
echo "Année: ";
echo "<input type=text name=annee_a_creer value=$annee_a_creer>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";

//Tableau de la semaine source de la copie
echo "<table border=1 width=50% align=center>";
echo "<tr>";
echo "<td>";
echo "Copier à partir de la semaine: ";
echo "</td>";
echo "</tr>";
echo "<tr align=right>";
echo "<td>";
echo "Selection de la semaine: ";
$selection_active = 0;
echo selection_semaine_en_cours($semaine_en_cours, $annee_en_cours, $planning_presence_modification, $selection_active);
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";

//Tableau des options
echo "<table border=1 width=50% align=center>";
echo "<tr>";
echo "<td>";
echo "Options: ";
echo "</td>";
echo "</tr>";
echo "<tr align=right>";
echo "<td>";
echo "Récupérer la liste des utilisateurs: ";
echo "<input type=checkbox name=recuperer_liste_utilisateur value=1 $recuperer_liste_utilisateur_checked>";
echo "<br>";
echo "Récupérer le planning des utilisateurs: ";
echo "<input type=checkbox name=recuperer_planning_utilisateur value=1 $recuperer_planning_utilisateur_checked>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";

//Tableau des options
echo "<table border=1 width=50% align=center>";
echo "<tr>";
echo "<td align=center>";
echo "<input type=submit value=`Lancer la création de la semaine`>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
echo "</form>";

include ("../lib/fin_page.inc");
?>

