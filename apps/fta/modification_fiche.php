<?php

//Redirection vers la page par défaut du module
//header ("Location: indexft.php");

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */

//$module=substr(strrchr(`pwd`, '/'), 1);
//$module=trim($module);

/*
  Si la page peut être appelée depuis n'importe quel module,
  décommentez la ligne suivante
 */

//   $module='fta';

/* * *******
  Inclusions
 * ******* */
//include ("../lib/session.php");         //Récupération des variables de sessions
//include ("../lib/debut_page.php");      //Affichage des éléments commun à l'Intranet
require_once '../inc/main.php';
print_page_begin($disable_full_page, $menu_file);




/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
$page_action = $page_default . "_post.php";
$page_pdf = $page_default . "_pdf.php";
$action = 'valider';                       //Action proposée à la page _post.php
$method = 'method=post';                   //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = "table "                     //Permet d'harmoniser les tableaux
        . "border=0 "
        . "width=100% "
        . "class=titre "
;
//$html_image_modif = "&nbsp;<img src=../lib/images/exclamation.png alt=\"\" title=\"Information mise à jour\" width=\"20\" height=\"18\" border=\"0\" />";
//$html_color_modif = "bgcolor=#B0FFFE";
$version_modif = 1;                        //Activer la visualisation des modifications effectuées depuis la version précédente
$show_help = 1;                              //Activer l'aide en ligne Pop-up
//Barre de Navigation d'une Fiche Technique Article
//include ("./menu_navigation.inc");
//echo $synthese_action;
/* $comeback;
  echo $comeback=($_SERVER["QUERY_STRING"]);
  echo "<br>";
  echo htmlspecialchars($comeback);
 */



//Paramètre d'URL
$idFta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
/*
 * Nous recuperons le chapitre auquel ultisateur verra par défaut selon ces droits d'accès 
 * lorsqu'il regarde la liste de ces fta 
 */
//$chapitreParDefaut = FtaChapitreModel::getChapitreDefautByWorkflow($id_fta);

$id_fta_chapitre_encours = Lib::getParameterFromRequest("id_fta_chapitre_encours",  AccueilFta::VALUE_1);
$synthese_action = Lib::getParameterFromRequest("synthese_action");
$comeback = Lib::getParameterFromRequest("comeback");
$idFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$abreviationFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::FIELDNAME_ABREVIATION);
$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);
$id_fta_chapitre = $id_fta_chapitre_encours;
$module_consultation = $_SESSION["module"] . "_consultation";

//Sécurisation du chapitre Tarif
if ($$module_consultation <> 1 and $nom_fta_chapitre_encours == "tarif") {
    include ("../lib/acces_interdit.php");
}

//$navigue = afficher_navigation($id_fta, $id_fta_chapitre_encours, $synthese_action, $comeback);


Navigation::initNavigation($idFta, $id_fta_chapitre_encours, $synthese_action, $comeback, $idFtaEtat,$abreviationFtaEtat,$idFtaRole);

$navigue= Navigation::getHtmlNavigationBar();

/*
  Création des Fonctions JavaScript
 */
//document.form_action.correction_fta_suivi_projet.value
//Etes vous certain de vouloir corriger ce chapitre ?
$javascript = "
<SCRIPT LANGUAGE=JavaScript>
        function confirmation_correction_fta()
        {
        i = document.form_action.correction_fta_suivi_projet.value
        if(confirm('Etes vous certain de vouloir corriger ce chapitre ?'))
        {
            location.href = \"modification_fiche_post.php?id_fta=" . $idFta . "&id_fta_chapitre_encours=" . $id_fta_chapitre_encours . "&synthese_action=" . $synthese_action . "&action=correction&new_correction_fta_suivi_projet=\" + i
             
        }
         else{}
        }
</SCRIPT>
";


Chapitre::initChapitre($idFta, $id_fta_chapitre, $synthese_action, $comeback, $idFtaEtat,$abreviationFtaEtat,$idFtaRole);

$bloc.= Chapitre::getHtmlChapitreAll();



echo "
     $navigue
     <form $method action=\"$page_action\" name=\"form_action\" method=\"post\">
     <input type=hidden name=action value=$action>
     <input type=hidden name=id_fta value=$idFta>
     <input type=hidden name=abreviation_fta_etat value=$abreviationFtaEtat>
     <input type=hidden name=id_fta_chapitre_encours value=$id_fta_chapitre_encours>
     <input type=hidden name=id_fta_chapitre value=$id_fta_chapitre>
     <input type=hidden name=id_fta_role value=$idFtaRole>
     <input type=hidden name=id_fta_etat value=$idFtaEtat>
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


/* * **********
  Fin Code HTML
 * ********** */

/* * *********************
  Inclusion de fin de page
 * ********************* */
include ("../lib/fin_page.inc");

