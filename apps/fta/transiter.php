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

/*********
Inclusions
*********/
//include ("../lib/session.php");         //Récupération des variables de sessions
//include ("../lib/debut_page.php");      //Affichage des éléments commun à l'Intranet
      require_once '../inc/main.php';
      print_page_begin($disable_full_page, $menu_file);


//if (isset($menu))                       //Si existant, utilisation du menu demandé
//   {include ("./$menu");}               //en variable
//else
//   {include ("./menu_principal.inc");}  //Sinon, menu par défaut


/*************
Début Code PHP
*************/

/*
    Initialisation des variables
*/
   $page_action=substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4')."_post.php";
//   $action = '';                       //Action proposée à la page _post.php
   $method = 'method=POST';             //Pour une url > 2000 caractères, utiliser POST
   $html_table = "table "              //Permet d'harmoniser les tableaux
               . "border=1 "
               . "width=100% "
               . "class=contenu "
               ;

/*
    Récupération des données MySQL
*/

   $id_fta = $_GET["id_fta"];
   mysql_table_load("fta");
   mysql_table_load("access_arti2");
   mysql_table_load("fta_etat");

   //Information de la fiche sélectionnée
   $id_fta;                               //Identifiant de la fiche technique
   $id_dossier_fta;                       //Identifiant de toutes les fiches de cette matière
   $nom_fta_etat;                         //Etat actuel de la fiche
   $designation_commerciale_fta;          //Nom
   $nom_matiere_premiere_filiere;
   $commentaire_maj_fta;                  //Historiques des commentaire de mise à jour
   $LIBELLE;

/*
    Création des objets HTML (listes déroulante, cases à cocher ...etc.)
*/

    //Tableau des transitions disponibles pour cette fiches techniques
    $tableau_transition = "<select name=action onChange=lien_selection_chapitre()>"
                        ;

    $req = "SELECT * FROM fta_transition "
        . "WHERE abreviation_fta_etat='$abreviation_fta_etat' "
        ;
    if($demande_abreviation_fta_transition)
    {
         $req.= "AND abreviation_fta_transition ='$demande_abreviation_fta_transition' ";
    }
    $req .="ORDER BY abreviation_fta_transition DESC ";
    $result=DatabaseOperation::query($req);

    $flag_selection_chapitre=0;    //Peut-on sélectionner un chapitre à mettre à jour ?

    while($rows=mysql_fetch_array($result))
    {
         //Cette transition est-elle reservée à un processus ?
         if($rows["processus_proprietaire_fta_transition"])
         {
             $id_fta_processus = $rows["processus_proprietaire_fta_transition"];
             mysql_table_load("fta_processus");
             mysql_table_load("intranet_actions");

             //L'utilisateur a-t-il le droit d'affectuer cette transition ?
             if(${"fta_".$nom_intranet_actions})
             {
                 $transition_autorise = 1;
             }else{
                 $transition_autorise =0;
             }

         }else{
             //Sinon, elle est utilisable pour tous
             $transition_autorise = 1;
         }

         //Si l'utilisateur est autorisé à utiliser cette transition, alors affichage de l'option
         if($transition_autorise)
         {
             if($action == $rows["abreviation_fta_transition"])
             {
                 $selected=" selected";
             }
             else
             {
                 $selected="";
             }

             $tableau_transition .="<option value=\"".$rows["abreviation_fta_transition"]."\" $selected>"
                                 . $rows["nom_usuel_fta_transition"]."</option>"
                                 ;

             //Dans le cas de la possibilité d'activer la mise à jour,
             //l'option de selection des chapitres est aussi activé
             /* if ($rows["abreviation_fta_transition"]=="I")
             {
                 $flag_selection_chapitre=1;
             } */
         }
    }
    $tableau_transition.="</select>";

    //Tableau des chapitres
    if($action== "I")
    {
         $tableau_chapitre = "<$html_table>"
                           . "<tr class=titre><td>Liste des Chapitres pouvant être mis à jour</td></tr>"
                           . "<tr><td><$html_table>"
                           ;

         $req = "SELECT * FROM fta_chapitre ORDER BY nom_usuel_fta_chapitre";
         $result = DatabaseOperation::query($req);
         while($rows_chapitre=mysql_fetch_array($result))
         {
             $tableau_chapitre.= "<tr>"
                               . "<td><input type=checkbox name=nom_fta_chapitre-".$rows_chapitre["id_fta_chapitre"]." value=1 /></td>"
                               . "<td>".$rows_chapitre["nom_usuel_fta_chapitre"]."</td>"
                               . "</tr>"
                               ;
         }
         $tableau_chapitre.= "</table></td></tr>"
                           . "</table>"
                           ;
    }


    //Validation_matiere_premiere
    //Boris 2005-09-15: risque de mettre une date antérieure à la dernière date de mise à jour
    $nom_date="date_derniere_maj_fta";
    //$nom_date="date_dernier_changement_etat_new";
    $nom_liste="selection_".$nom_date;
    $date_defaut=date('Y-m-d');
    $$nom_liste=selection_date_pour_mysql($nom_date, $date_defaut);
    $selection_date_derniere_maj_fta;

/***********
Fin Code PHP
***********/
//echo fta_processus_validation($id_fta, "7");

/**************
Début Code HTML
**************/
echo "

     <form $method action=\"$page_action\" name=\"form_action\">
     <!input type=hidden name=action value=$action>
     <input type=hidden name=abreviation_fta_etat value=$abreviation_fta_etat>
     <input type=hidden name=id_fta value=$id_fta>
     <input type=hidden name=id_dossier_fta value=$id_dossier_fta>
     <input type=hidden name=commentaire_maj_fta value=`$commentaire_maj_fta`>
     <$html_table>
     <tr class=titre_principal><td>

         Transiter l'Etat d'une Fiche Technique Article

     </td></tr>
     <tr><td>

         <img src=../lib/images/transiter.png>
         &nbsp&nbsp&nbsp&nbsp
         La transition de l'état d'une fiche permet de changer son état tout en laissant le système contrôler la cohérence et la version de la fiche.<br>
         <br>
         Suivant l'état de votre fiche, seuls certains états sont accessibles. Vous pouvez considérer la transition de l'état d'une fiche comme un contrôle sur son cycle de vie.<br>
         <br>

     </td></tr>
     <tr class=titre_principal><td>

         Information de la fiche en cours de transition d'état

     </td></tr>
     <tr><td>

         <$html_table>
         <tr><td>

             Identifiant de la Fiche Technique Article: $id_fta<br>
             Identifiant du Dossier Technique: $id_dossier_fta-v$id_version_dossier_fta<br>
             Etat actuel de la fiche: $nom_fta_etat<br>
             Désignation Commerciale: $designation_commerciale_fta<br>
             Désignation Interne Normaliée (DIN): ".$LIBELLE."<br>

         </td></tr>
         </table>

     </td></tr>
     <tr class=titre_principal><td>

         Transition disponible

     </td></tr>
     <tr><td>

         <$html_table>
         <tr><td>

                 $tableau_transition

         </td><td>

                 $tableau_chapitre

         </tr>
         </table>

     </td></tr>
     <tr class=titre_principal><td>

         $NOM_commentaire_maj_fta

     </td></tr>
     <tr><td>

         <center>
         <textarea name=\"new_commentaire_maj_fta\" cols=\"50\" rows=\"5\" wrap=\"virtual\"></textarea>
         </center>

     </td></tr>
     <tr><td>

         <center>
         <input type=submit value='Enregistrer'>
         </center>

     </td></tr>
     <tr class=titre_principal><td>

         Historique

     </td></tr>
     <tr><td>

         ".html_view_txt($commentaire_maj_fta)."

     </td></tr>
     </table>

     </form>
     ";

/************
Fin Code HTML
************/

/***********************
Inclusion de fin de page
***********************/
include ("../lib/fin_page.inc");
?>

