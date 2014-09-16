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
      require_once '../inc/main.php';
      print_page_begin($disable_full_page, $menu_file);

//        if (isset($menu))                       //Si existant, utilisation du menu demandé
//        {                                       //en variable
//           include ("./$menu");
//        }
//        else
//        {
//           include ("./menu_principal.inc");    //Sinon, menu par défaut
//        }

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
   $method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
   $html_table = "table "              //Permet d'harmoniser les tableaux
               . "border=1 "
               . "width=100% "
               . "class=contenu "
               ;

/*
    Récupération des données MySQL
*/

//Sauvegarde de l'ID FTA car il va être supprimé lors des différents algorythme suivants
$id_fta_sauvegarde=$id_fta;

$bloc=""; //Bloc de saisie

//Adaptation du formulaire en fonction des informations déjà saisie
switch($action)
{
case FALSE: //Aucune étape n'a été validé

    $action="etape1";  //L'action sera de sélectionner un modèle de palettisation

    //Sélection d'une autre palettisation
    $bloc.= "
            <tr><td>
            <a href=ajout_palettisation.php?id_fta=$id_fta&palettisation_emballage_groupe=1&id_fta_chapitre_encours=$id_fta_chapitre_encours>
            Ajouter la palettisation
            </a>
            </td></tr>
            ";

    //Tableau récapitulatif des palettisations utilisées
    $recap_palettisation = "<tr><td>
                        <$html_table>
                        <tr class=titre>
                            <td>

                            </td>
                            <td>
                            ".mysql_field_desc("annexe_emballage", "id_annexe_emballage")."
                            </td>
                            <td>
                            ".mysql_field_desc("annexe_emballage_groupe", "nom_annexe_emballage_groupe")."
                            </td>
                            <td>
                            ".mysql_field_desc("annexe_emballage", "reference_fournisseur_annexe_emballage")."
                            </td>
                            <td>
                            ".mysql_field_desc("annexe_emballage", "poids_annexe_emballage")."
                            </td>
                            <td>
                            ".mysql_field_desc("annexe_emballage", "longueur_annexe_emballage")."
                            </td>
                            <td>
                            ".mysql_field_desc("annexe_emballage", "largeur_annexe_emballage")."
                            </td>
                            <td>
                            ".mysql_field_desc("annexe_emballage", "hauteur_annexe_emballage")."
                            </td>
                            <td>
                            ".mysql_field_desc("fta_conditionnement", "nombre_couche_fta_conditionnement")."
                            </td>
                            <td>
                            ".mysql_field_desc("fta_conditionnement", "quantite_par_couche_fta_conditionnement")."
                            </td>
                        ";
         $recap_palettisation.="<td>Suppr.</td>";
         $recap_palettisation.="</tr>";

         //Récupération des palettisations déjà saisies
         $req = "SELECT id_fta_conditionnement "
              . "FROM fta_conditionnement, annexe_emballage, annexe_emballage_groupe "
              . "WHERE fta_annexe_emballage_groupe=3 " //Emballage Primaire et UVC
              . "AND id_fta=0 "
              . "AND fta_conditionnement.id_annexe_emballage=annexe_emballage.id_annexe_emballage "
              . "AND annexe_emballage.id_annexe_emballage_groupe=annexe_emballage_groupe.id_annexe_emballage_groupe "
              . "ORDER BY annexe_emballage_groupe.id_annexe_emballage_groupe, reference_fournisseur_annexe_emballage "
              ;
         $result=DatabaseOperation::query($req);
         while($rows=mysql_fetch_array($result))
         {
             $id_fta_conditionnement=$rows["id_fta_conditionnement"];
             mysql_table_load("fta_conditionnement");
             mysql_table_load("annexe_emballage");
             mysql_table_load("annexe_emballage_groupe");

             //Case à cocher pour sélection
             $champ="nom_annexe_emballage_groupe";
             $recap_palettisation .="<tr align=right bgcolor=$bgcolor><td>"
                                    . "<input type=radio name=id_selection value=$id_fta_conditionnement />"
                                    . "</td>";

             //Identifiant de la palettisation
             $champ="id_annexe_emballage";
             $recap_palettisation .= "<td>${$champ}</td>";

             //Groupe d'emballage
             $champ="nom_annexe_emballage_groupe";
             $recap_palettisation .= "<td>${$champ}</td>";

             //Emballage
             $champ="reference_fournisseur_annexe_emballage";
             $recap_palettisation .= "<td>${$champ}</td>";

             //Poids
             $champ="poids_annexe_emballage";
             $recap_palettisation .= "<td>${$champ}</td>";

             //Longeur
             $champ="longueur_annexe_emballage";
             $recap_palettisation .= "<td>${$champ}</td>";

             //Largeur
             $champ="largeur_annexe_emballage";
             $recap_palettisation .= "<td>${$champ}</td>";

             //Hauteur
             $champ="hauteur_annexe_emballage";
             $recap_palettisation .= "<td>${$champ}</td>";

             //Nombre de couche
             $champ="nombre_couche_fta_conditionnement";
             $recap_palettisation .= "<td>${$champ}</td>";

             //Quantité par couche
             $champ="quantite_par_couche_fta_conditionnement";
             $recap_palettisation .= "<td>${$champ}</td>";


             //Supprimer
             $recap_palettisation .= "<td>
                          <a href=selection_palettisation_post.php?id_fta=$id_fta_sauvegarde&id_fta_conditionnement=$id_fta_conditionnement&action=suppression_modele_palettisation>
                          <img src=../lib/images/supprimer.png width=15 height=15 border=0/>
                          </a></td>
                          ";
         }
         $recap_palettisation.="</tr></table>";
         $bloc.= $recap_palettisation;
break;




}//Fin de la création du bloc de saisie

//Restauration des valeurs initiales
$id_fta=$id_fta_sauvegarde;

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
//echo $id_fta;
        echo "
             <form method=$method action=$page_action>
             <input type=hidden name=action value=$action>
             <input type=hidden name=id_fta value=$id_fta>
             <input type=hidden name=id_fta_conditionnement value=$id_fta_conditionnement>
             <input type=hidden name=id_fta_chapitre_encours value=$id_fta_chapitre_encours>

             <$html_table>
             <tr class=titre_principal><td>

                 Liste des Modèles de Palettisation

             </td></tr>
             </table>
             <$html_table>

                 $bloc

             </table>
             <$html_table>
             <tr><td>

                 <center>
                 <input type=submit value='Sélectionner ce modèle'>
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