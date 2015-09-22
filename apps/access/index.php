<?

/*
  Module d'appartenance (valeur obligatoire)
  Par défaut, le nom du module est le répetoire courant
 */
//   $module = substr(strrchr(`pwd`, '/'), 1);
//   $module = trim($module);

/*
  Si la page peut être appelée depuis n'importe quel module,
  décommentez la ligne suivante
 */

//   $module='';

/* * *******
  Inclusions
 * ******* */
switch ($output) {

    case 'visualiser':
    //Inclusions
//       include ("../lib/session.php");         //Récupération des variables de sessions
//       include ("../lib/functions.php");       //On inclus seulement les fonctions sans construire de page
//       include ("functions.php");              //Fonctions du module
//       echo "
//            <link rel=stylesheet type=text/css href=../lib/css/intra01.css />
//            <link rel=stylesheet type=text/css href=visualiser.css />
//       ";
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
//     
}//Fin de la sélection du mode d'affichage de la page
require_once '../inc/main.php';
print_page_begin($disable_full_page, $menu_file);
//print_page_begin($disable_full_page, $menu_file);
/* * ***********
  Début Code PHP
 * *********** */
$id_user = Lib::isDefined('id_user');
/*
  Initialisation des variables
 */
$action = '';                       //Action proposée à la page action.php
$method = 'method=post';             //Pour une url > 2000 caractères, utiliser POST
$html_table = "table "              //Permet d'harmoniser les tableaux
        . "border=1 "
        . "width=100% "
        . "class=contenu "
;

/*
  Récupération des données MySQL
 */


/*
  Création des objets HTML (listes déroulante, cases à cocher ...etc.)
 */

//Recherches des bases Access accessible par l'utilisateur

$req1 = "SELECT nom_intranet_actions,description_intranet_actions"
        . " FROM intranet_actions, intranet_droits_acces "
        . "WHERE intranet_actions.id_intranet_actions=intranet_droits_acces.id_intranet_actions "
        . "AND intranet_actions.module_intranet_actions=intranet_droits_acces.id_intranet_modules "
        . "AND intranet_droits_acces.id_intranet_modules=13 "
        . "AND intranet_droits_acces.niveau_intranet_droits_acces>=1 "
        . "AND intranet_droits_acces.id_user=$id_user "
        . "ORDER BY nom_intranet_actions ASC "
;

$result = DatabaseOperation::convertSqlStatementWithoutKeyToArray($req1);

if ($result) {


    if ($site_dev) {

        $extension = "mdb";
    } else {

        $extension = "agismde";
    }
    $extension_local = $extension;

    foreach ($result as $rows) {
        //Chemin

        $chemin = "base_" . $rows[nom_intranet_actions];


        //Fichier

        $file = $rows[nom_intranet_actions] . "." . $extension_local;



        $tableau .= "<tr><td>

                      <a href=" . $chemin . "/" . $file . ">
                         <img src=base_$rows[nom_intranet_actions]/bouton.png border=0 width=34 height=34 />
                         $rows[description_intranet_actions]
                         </a>

                   </td></tr>
                  ";
    }
}



/* * *********
  Fin Code PHP
 * ********* */


/* * ************
  Début Code HTML
 * ************ */
echo "
     <form " . $method . " action=action.php>
     <input type=hidden name=action value=" . $action . ">

     <" . $html_table . ">
     <tr class=titre_principal><td>

         Sommaire des applications Access disponibles <br>

     </td></tr>
     " . $tableau . "
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
?>

