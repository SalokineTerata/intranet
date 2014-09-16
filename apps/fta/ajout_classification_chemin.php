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
   $page_default=substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
   $page_action=$page_default."_post.php";
   $page_pdf=$page_default."_pdf.php";
   $action = 'valider';                       //Action proposée à la page _post.php
   $method = 'POST';                          //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
   $html_table = "table "                     //Permet d'harmoniser les tableaux
               . "border=1 "
               . "width=100% "
               . "class=contenu "
               ;
/*
    Récupération des données MySQL
*/
    $id_fta;
    $id_classification_arborescence_article;

/*
    Création des objets HTML (listes déroulante, cases à cocher ...etc.)
*/

    //Chemin en cours
    if ($id_classification_arborescence_article)
    {

       $extension["lien"]=$page_default.".php?id_fta=$id_fta";
       $chemin_en_cours=affichage_classification_chemin($id_classification_arborescence_article, $extension);


       $bloc_chemin_actuel = "<a href=".$extension["lien"]."&id_classification_arborescence_article=1 />Chemin en cours: </td></tr><tr><td><$html_table>"
                           . $chemin_en_cours
                           . "</table>"
                           ;
       $search="=$id_classification_arborescence_article";
    }
    else
    {
       $bloc_chemin_actuel = "Aucun chemin";
       $search="IS NULL";
    }

    //Chemin disponible
    $req = "SELECT * "
         . "FROM classification_arborescence_article, classification_arborescence_article_categorie_contenu,classification_arborescence_article_categorie "
         . "WHERE classification_arborescence_article.id_classification_arborescence_article_categorie_contenu=classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie_contenu "
         . "AND classification_arborescence_article_categorie.id_classification_arborescence_article_categorie=classification_arborescence_article_categorie_contenu.id_classification_arborescence_article_categorie "
         . "AND ascendant_classification_arborescence_article_categorie_contenu $search "
         . "ORDER BY nom_classification_arborescence_article_categorie_contenu "
         ;
    $result=DatabaseOperation::query($req);
    $nb=mysql_num_rows($result);
    if($nb)
    {

       //Par défaut l'option est sélectionné s'il il n'y a qu'un élément possible
       if($nb==1){$checked="checked";}

       //Préparation du formulaire
       $bouton_submit="<input type=submit value='Suivant >>'>";
       $page_action=$page_default.".php";

       //Préparation de la liste de choix
       $id="id_classification_arborescence_article";
       $nom="nom_classification_arborescence_article_categorie_contenu";
       $categorie="nom_classification_arborescence_article_categorie";
       
       //$bloc_chemin_possible .= "<tr><td>";

           
       $temp_i=0;
       while($rows=mysql_fetch_array($result))
       {
           if (!$temp_i)
           {
              $bloc_chemin_possible.= "<tr class=titre><td>$rows[$categorie]</td></tr>"
                                    . "<tr><td><$html_table>"
                                    ;

           }
           $temp_i=1;
           //Liste des possibilité
           $bloc_chemin_possible.= "<tr><td align=right width=50%>"
                                 . "<input type=radio name=$id value=".$rows[$id]." $checked>"
                                 . "</td><td align=left>"
                                 . $rows[$nom]
                                 . "</td></tr>"
                                 ;
           $checked="";
       }
       $bloc_chemin_possible.="</table>";
    }
    else
    {//Le chemin peux être ajouté

          mysql_table_load("classification_arborescence_article");
          mysql_table_load("classification_arborescence_article_categorie_contenu");
          mysql_table_load("classification_arborescence_article_categorie");
          //echo $id_classification_arborescence_article_categorie."<br>";
          //echo $nom_classification_arborescence_article_categorie."<br>";
          //echo $suivant_classification_arborescence_article_categorie."<br>";

          //Vérification que l'arborescence est Terminée
          if($suivant_classification_arborescence_article_categorie)
          {
             $titre="Module Classification";
             $message="Il manque des informations, ce chemin n'est pas complet.";
             afficher_message($titre, $message, $redirection);
             $bouton_submit="";
          }else
          {
             $bouton_submit="<input type=submit value='Classer la Fiche Technique Article dans ce chemin'>";
             $page_action=$page_default."_post.php";

          }
       

    }






/***********
Fin Code PHP
***********/


/**************
Début Code HTML
**************/

echo "
     <form $method action=$page_action>
     <input type=hidden name=action value=$action>
     <input type=hidden name=id_fta value=$id_fta>
     <input type=hidden name=id_classification_arborescence_article value=$id_classification_arborescence_article>
     <input type=\"hidden\" name=\"synthese_action\" value=\"$synthese_action\" />

     <$html_table>
     <tr class=titre_principal><td>

         Classification de la Fiche Technique Article

     </td></tr>
     <tr><td>

         $bloc_chemin_actuel

     </td></tr>

         $bloc_chemin_possible

     </td></tr>
     <tr><td>

         <center>
         $bouton_submit
         </center>

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

