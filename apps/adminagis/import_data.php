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


/*************
Début Code PHP
*************/

/*
    Initialisation des variables
*/
   $page_default=substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
   $page_action=$page_default."_post.php";
   $page_pdf=$page_default."_pdf.php";
   $action = 'valider';                       //Action proposée à la page _post.php
   $method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
   $html_table = "table "              //Permet d'harmoniser les tableaux
               . "border=1 "
               . "width=100% "
               . "class=contenu "
               ;
   $dir_incoming = "./import_incoming";
   $dir_archives = "./import_archives";
   $delimiter = ";";
   $prefixe_tablename="tmp_import_";
   $move_after_processing=1;
   $mod_auto=0;                        //Lance l'automation de recopie
/*
    Récupération des données MySQL
*/

//Récupération de la liste des fichiers à importer
$files_list = explode("\n", `ls $dir_incoming`);
$bloc = "";

//Parcours des fichiers
foreach  ($files_list as $current_file)
{
  //Traitement uniquement des fichiers avec un nom
  //(ce qui permet de ne pas récupérer la dernière ligne du tableau $files_list
  if ($current_file)
  {
    $bloc.= "Traitement de ".$current_file.":<ul>";

    //Création de la table
    //Récupération du nom du fichier
    $table_name = $prefixe_tablename.basename(strtolower($current_file),".csv");
    $req_create_table = "CREATE TABLE `$table_name`";

    //Gestion des enregistrements
    $records=file($dir_incoming."/".$current_file);
    $current_nb_line=count($records);
    //echo "<li>Nombre d'enregistrement à importer: $current_nb_line<br></li>";

    //Parcours des enregistrement
    $do_title=1;   //Traitement particulier lors du traitement de la première ligne qui contient les intitulés
    $req_insert_record="";
    $stop_current_table=0;
    $count_record_ok=1;

    foreach  ($records as $current_record)
    {
        if(!$stop_current_table)
        {
            //Découpage des champs dans un tableau
            $current_record=rtrim($current_record); //La commande file rajoute "\r\n" en fin d'enregistrement
            $tab_record = explode($delimiter, $current_record);
            
            //Dans le cas de la première ligne et si on diot créer les intitulés à partir du premier enregsitrement,
            //On prépare la partie corresopndante de la requête d'insertion
            if($do_title)
            {
               foreach ($tab_record as $key => $current_field)
               {

                   //Recherche de mot clef d'automation
                   //$mod_auto=0;
                   if(strstr ($current_field, "_AUTO_"))
                   {
                       ${"mod_auto_".$key}=1;
                       //echo "mod_auto_".$key.":".${"mod_auto_".$key}."<br>";
                   }

                   //Conversion des " en `
                   $current_field=str_replace('"', "`", $current_field);
                   $tab_field[$key] = $current_field." TEXT";
               }
               $req_field_name=implode(",", $tab_field);
               $req_create_table.="(".$req_field_name.")";
               if(!DatabaseOperation::query($req_create_table))
               {
                   $bloc.= "Attention: " . mysql_error()."<br>";
                   //$stop_current_table=1;
               }
               $do_title=0;
            }
            else //Traitement des autres enregistrements
            {
               $tab_data_last=$tab_data;
               $tab_data=array();
               foreach ($tab_record as $key => $current_field)
               {

                   if(!$current_field)
                   {
                       //echo "mod_auto_".$key.":".${"mod_auto_".$key}."<br>";
                       if(${"mod_auto_".$key})
                       {
                          $current_field=$tab_data_last[$key];
                       }
                       else
                       {
                           $current_field='""';
                       }

                   }
                   $tab_data[$key] = $current_field;
               }
               //echo print_r($tab_record);
               $req_insert_record="INSERT `$table_name` VALUES(".implode(",",$tab_data).")";
               //echo  $req_insert_record."<br>";
               if(DatabaseOperation::query($req_insert_record))
               {
                   $count_record_ok=$count_record_ok+1;
               }
            }
        }
        //print_r($tab_record);
        //echo count($tab_record);
        //Construction de la requête SQL d'insertion

    }
    $bloc.= "<li>Enregistrement traités: $count_record_ok/$current_nb_line<br></li>";
    //echo $req_field_name;


    //Déplacement du fichier d'importation
    $tmp_answer="Non";
    if($move_after_processing)
    {
      copy($dir_incoming."/".$current_file, $dir_archives."/".date("Y-m-d")."-".$current_file);
      unlink($dir_incoming."/".$current_file);
      $tmp_answer="Oui";
    }
    $bloc.= "<li>Source déplacée: $tmp_answer<br></li>";
    $bloc.= "</ul><br>";
  }
}



/* $nb_erreurs=0;
$fichierResult="../../../maj/maj_data.sql";
  $contenuResult=file($fichierResult);
  $nlignesResult=count($contenuResult);
echo "<p>$nlignesResult enregistrements à importer</p>\n";
  for($compt=0;$compt<$nlignesResult;$compt++)
  {if (trim($contenuResult[$compt])!="")  
    if (!DatabaseOperation::query($contenuResult[$compt]))
          { echo "<p>$compt) la requête ".$contenuResult[$compt]." n'a pas abouti</p>";
            $nb_erreurs++;
          }
  }
if ($nb_erreurs>0) echo "<p>$nb_erreurs erreurs rencontrées durant l'import</p>\n";
 */

/*
     Sélection du mode d'affichage
*/
switch ($output)
{

/*************
Début Code PDF
*************/
case "pdf":
         //Constructeur
         $pdf=new XFPDF();

         //Déclaration des variables de formatages
         $police_standard="Arial";
         $t1_police=$police_standard;
         $t1_style="B";
         $t1_size="12";

         $t2_police=$police_standard;
         $t2_style="B";
         $t2_size="11";

         $t3_police=$police_standard;
         $t3_style="BIU";
         $t3_size="10";

         $contenu_police=$police_standard;
         $contenu_style="";
         $contenu_size="8";

         $chapitre=0;
         $section=0;
         include($page_pdf);
         //$pdf->SetProtection(array("print", "copy"));
         $pdf->Output(); //Read the FPDF.org manual to know the other options

break;
/***********
Fin Code PDF
***********/


/*
    Création des objets HTML (listes déroulante, cases à cocher ...etc.)
*/




/**************
Début Code HTML
**************/
default:

        echo "
             <form method=$method action=$page_action>
             <input type=hidden name=action value=$action>

             <$html_table>
             <tr class=titre_principal><td>

                 Importation des Données

             </td></tr>
             <tr><td>

                 $bloc

             </td></tr>
             <tr><td>

                 <center>
                 <input type=submit value='Enregistrer'>
                 </center>

             </td></tr>
             </table>

             </form>
             ";



/***********************
Inclusion de fin de page
***********************/
include ("../lib/fin_page.inc");

/************
Fin Code HTML
************/

}//Fin du switch de sélection du mode d'affichage

?>