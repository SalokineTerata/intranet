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

//Initialisation des droits d'accès du module planning_presence
echo "<center>";
echo "Initialisation des droits d'accès par défaut<br><br>";
$req1 = "SELECT * FROM salaries ";
$req1.= "ORDER BY prenom ASC, nom ASC";
$result1 = mysql_query($req1);
while ($rows1=mysql_fetch_array($result1))
{
      //Initialisation des variables
      $id_salaries=$rows1[id_user];
      $prenom_salaries=$rows1[prenom];
      $nom_salaries=$rows1[nom];
      $niveau_intranet_droits_acces=1; //Niveau par défaut
      $id_intranet_modules=1;          //Droit par défaut
      $id_intranet_actions=1;          //Module concerné

      //Recherche de droits d'accès existants
      $req_recuperation_droits_acces = "SELECT * FROM intranet_droits_acces ";
      $req_recuperation_droits_acces.= "WHERE id_intranet_modules=$id_intranet_modules ";
      $req_recuperation_droits_acces.= "AND id_intranet_actions=$id_intranet_actions ";
      $req_recuperation_droits_acces.= "AND id_user=$id_salaries";
      $result_recuperation_droits_acces=mysql_query($req_recuperation_droits_acces);
      $compte_recuperation_droits_acces=mysql_num_rows($result_recuperation_droits_acces);


      //S'il n'y a pas de droits, alors insertions du droit par défaut
      if (!$compte_recuperation_droits_acces)
      {
         $req_droits_acces = "INSERT INTO intranet_droits_acces (";
         $req_droits_acces.= "niveau_intranet_droits_acces, ";
         $req_droits_acces.= "id_intranet_modules, ";
         $req_droits_acces.= "id_user, ";
         $req_droits_acces.= "id_intranet_actions)";
         $req_droits_acces.= " VALUES (";
         $req_droits_acces.= "$niveau_intranet_droits_acces, ";
         $req_droits_acces.= "$id_intranet_modules, ";
         $req_droits_acces.= "$id_salaries, ";
         $req_droits_acces.= "$id_intranet_actions)";
         $result_droits_acces=mysql_query($req_droits_acces);
         echo "Initialisation des droits d'accès de ";
      }
      echo $prenom_salaries." ".$nom_salaries;
      echo "... OK<br><br>";
}
echo "<br>Initialisation terminée.";
echo "</center>";
include ("../lib/fin_page.inc");
?>

