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

$id_fta_classification2 = Lib::getParameterFromRequest(ClassificationFta2Model::KEYNAME);
$action = Lib::getParameterFromRequest('action');

/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
$page_action = $page_default . "_post.php";
$page_pdf = $page_default . "_pdf.php";
//   $action = 'valider';                       //Action proposée à la page _post.php
$method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = "table "              //Permet d'harmoniser les tableaux
        . "border=1 "
        . "width=100% "
        . "class=contenu "
;

/*
  Récupération des données MySQL
 */


if ($id_fta_classification2) {

    $ClassificationFta2Model = new ClassificationFta2Model($id_fta_classification2);
    $idProprietaireGroupe = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE)->getFieldValue();
    $idProprietaireEnseigne = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE)->getFieldValue();
    $idMarque = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_MARQUE)->getFieldValue();
    $idActivite = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_ACTIVITE)->getFieldValue();
    $idRayon = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_RAYON)->getFieldValue();
    $idEnvironnement = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT)->getFieldValue();
    $idReseau = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_RESEAU)->getFieldValue();
    $idSaisonalite = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE)->getFieldValue();
}

if ($action == 'modifier') {
    $titre = "Modification de la classification  identifiant n°" . $id_fta_classification2;
}else {
    $titre = "Ajout d'une classification";
}
$bloc .= "<" . $html_table . "><tr class=titre>"
        . "<td>Proprietaire (Groupe)</td>"
        . "<td>Proprietaire (Enseigne)</td>"
        . "<td>" . HtmlResult::MARQUE . "</td>"
        . "<td>" . HtmlResult::ACTIVITE . "</td>"
        . "<td>" . HtmlResult::RAYON . "</td>"
        . "<td>" . HtmlResult::ENVIRONNEMENT . "</td>"
        . "<td>" . HtmlResult::RESEAU . "</td>"
        . "<td>" . HtmlResult::SAISONALITE . "</td>"
        . "</tr>";
$bloc.="<td>" . ClassificationFta2Model::getListeClassificationProprietaireGroupe($idProprietaireGroupe) . "</td>";


$bloc.= "<td>" . ClassificationFta2Model::getClassificationListeSansDependance($idProprietaireEnseigne, 1, ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE
        ) . "</td>";

$bloc.="<td>" . ClassificationFta2Model::getClassificationListeSansDependance($idMarque, 2
                , ClassificationFta2Model::FIELDNAME_ID_MARQUE
        ) . "</td>";
$bloc.="<td>" . ClassificationFta2Model::getClassificationListeSansDependance($idActivite, 3
                , ClassificationFta2Model::FIELDNAME_ID_ACTIVITE
        ) . "</td>";
$bloc.="<td>" . ClassificationFta2Model::getClassificationListeSansDependance($idRayon, 4
                , ClassificationFta2Model::FIELDNAME_ID_RAYON
        ) . "</td>";
$bloc.="<td>" . ClassificationFta2Model::getClassificationListeSansDependance($idEnvironnement, 51
                , ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT
        ) . "</td>";
$bloc.="<td>" . ClassificationFta2Model::getClassificationListeSansDependance($idReseau, 5
                , ClassificationFta2Model::FIELDNAME_ID_RESEAU
        ) . "</td>";
$bloc.="<td>" . ClassificationFta2Model::getClassificationListeSansDependance($idSaisonalite, 52
                , ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE
        ) . "</td>";


/*
  Sélection du mode d'affichage
 */
switch ($output) {

    /*     * ***********
      Début Code PDF
     * *********** */
    case "pdf":
        //Constructeur
        $pdf = new XFPDF();

        //Déclaration des variables de formatages
        $police_standard = "Arial";
        $t1_police = $police_standard;
        $t1_style = "B";
        $t1_size = "12";

        $t2_police = $police_standard;
        $t2_style = "B";
        $t2_size = "11";

        $t3_police = $police_standard;
        $t3_style = "BIU";
        $t3_size = "10";

        $contenu_police = $police_standard;
        $contenu_style = "";
        $contenu_size = "8";

        $chapitre = 0;
        $section = 0;
        include($page_pdf);
        //$pdf->SetProtection(array("print", "copy"));
        $pdf->Output(); //Read the FPDF.org manual to know the other options

        break;
    /*     * *********
      Fin Code PDF
     * ********* */


    /*
      Création des objets HTML (listes déroulante, cases à cocher ...etc.)
     */





    /*     * ************
      Début Code HTML
     * ************ */
    default:

        echo "
             <form  method=" . $method . " action=" . $page_action . ">
             <input type=hidden name=action value=" . $action . ">
             <input type=hidden name=id_fta_classification2 value=" . $id_fta_classification2 . ">
            

             <" . $html_table . ">
             <tr class=titre_principal><td>

                 $titre 

             </td></tr>
             <tr><td>

                " . $bloc . "            

             </td></tr>
             <tr><td>
                 <center>
                 <input type=submit value=Enregistrer>
                 </center>

             </td></tr>
             </table>

             </form>
             ";



        /*         * *********************
          Inclusion de fin de page
         * ********************* */
        include ("../lib/fin_page.inc");

    /*     * **********
      Fin Code HTML
     * ********** */
}//Fin du switch de sélection du mode d'affichage
?>