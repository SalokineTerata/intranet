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
        flush();

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



$bloc=""; //Bloc de saisie

//Adaptation du formulaire en fonction des informations déjà saisie
switch($action) //Si aucun groupe d'emballage n'a était sélectionné
{
case FALSE: //Aucune étape n'a été validé

    $action="etape1";  //L'action sera de sélectionner un groupe d'emballage

    //Type d'emballage
    $nom_liste ="";
    $requete = "SELECT DISTINCT annexe_emballage_groupe.id_annexe_emballage_groupe, nom_annexe_emballage_groupe "
             . "FROM annexe_emballage_groupe, annexe_emballage "
             . "WHERE fta_annexe_emballage_groupe=3 "
             . "AND annexe_emballage_groupe.id_annexe_emballage_groupe=annexe_emballage.id_annexe_emballage_groupe "
             . "ORDER BY nom_annexe_emballage_groupe "
             ;
    $id_defaut ="";
    $nom_defaut ="";
    $liste_emballage_groupe = mysql_field_desc("annexe_emballage", "nom_annexe_emballage")
                  . "</td><td>"
                  . afficher_requete_en_liste_deroulante($requete, $id_defaut, $nom_defaut)
                  ;
    $bloc.=$liste_emballage_groupe;

break;

case "etape1": //L'étape 1 a été validé

    $action="etape2";  //L'action sera d'enregistrer l'emballage

                                 //L'utilisateur peut sélectionner l'emballage exact
    //Groupe d'emballage
    mysql_table_load("annexe_emballage_groupe");
    $champ="nom_annexe_emballage_groupe";
    $liste_emballage_groupe .="<tr><td>${'NOM_'.$champ}:</td><td>"
                            . "${$champ}</td></tr>"
                            ;
    $bloc .=$liste_emballage_groupe;

    //Liste des Emballages en fonction du groupe préalablement sélectionné
    $requete = "SELECT id_annexe_emballage, reference_fournisseur_annexe_emballage "
             . "FROM annexe_emballage "
             . "WHERE id_annexe_emballage_groupe=$id_annexe_emballage_groupe "
             . "ORDER BY reference_fournisseur_annexe_emballage "
             ;
    $id_defaut ="";
    $nom_defaut ="";
    $liste_emballage = "<tr><td>"
                  . mysql_field_desc("annexe_emballage", "reference_fournisseur_annexe_emballage")
                  . "</td><td>"
                  . afficher_requete_en_liste_deroulante($requete, $id_defaut, $nom_defaut)
                  . "</td></tr>"
                  ;
    $bloc .=$liste_emballage;

    //Nombre de couche dans l'emballage ascendant
    $champ="nombre_couche_fta_conditionnement";
    if(!${$champ})
    {//Valeur par défaut
        ${$champ}=1;
    }
    $label=mysql_field_desc("fta_conditionnement", $champ);
    $bloc .= "<tr><td>$label</td><td><input type=text name=$champ value=`"
              .${$champ}
              ."` size=20/></td></tr>"
              ;

    //Quantité par couche dans l'emballage ascendant
    $champ="quantite_par_couche_fta_conditionnement";
    if(!${$champ})
    {//Valeur par défaut
        ${$champ}=1;
    }
    $label=mysql_field_desc("fta_conditionnement", $champ);
    $bloc .= "<tr><td>$label</td><td><input type=text name=$champ value=`"
              .${$champ}
              ."` size=20/></td></tr>"
              ;

break;
case "etape2": //L'étape 2 a été validé

    $action="etape3";  //L'action sera d'enregistrer les dernières informations

    //Sauvegarde des valeurs
    $id_fta_sauvegarde=$id_fta;        //Sauvegarde de l'id_fta en cours

    mysql_table_load("fta_conditionnement");
    mysql_table_load("annexe_emballage");


    //Hauteur
    $champ="hauteur_emballage_fta_conditionnement";
    ${"NOM_".$champ}=mysql_field_desc("fta_conditionnement", $champ);;
    $bloc .="<tr><td>${'NOM_'.$champ}:</td><td>"
          . "<input type=radio name=".$champ." value=1 disabled>$longueur_annexe_emballage mm<hr>"
          . "<input type=radio name=".$champ." value=2 disabled>$largeur_annexe_emballage mm<hr>"
          . "<input type=radio name=".$champ." value=3 checked >$hauteur_annexe_emballage mm"
          ;

    //Sauvegarde des valeurs
    $id_fta=$id_fta_sauvegarde;        //Sauvegarde de l'id_fta en cours


break;


}//Fin de la création du bloc de saisie



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

                 Ajout d'un nouveau modèle de Palettisation

             </td></tr>
             </table>
             <$html_table>
             <tr><td>

                 $bloc

             </td></tr>
             </table>
             <$html_table>
             <tr><td>

                 <center>
                 <input type=submit value='Ajouter ce Modèle de Palettisation'>
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