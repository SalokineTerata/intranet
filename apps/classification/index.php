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
        flush();
}//Fin de la sélection du mode d'affichage de la page


/* * ***********
  Début Code PHP
 * *********** */
$globalConfig = new GlobalConfig();

if ($globalConfig->getAuthenticatedUser()) {
    $idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
}
if ($idUser) {
    /*
      Initialisation des variables
     */
    $page_default = substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
    $page_action = $page_default . "_post.php";
    $page_pdf = $page_default . "_pdf.php";
    $action = 'valider';                       //Action proposée à la page _post.php
    $method = 'POST';                          //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
    $html_table = "table "                     //Permet d'harmoniser les tableaux
            . "border=1 "
            . "width=100% "
            . " "
    ;
    $selection_proprietaire1 = Lib::getParameterFromRequest('selection_proprietaire1');
    $selection_proprietaire2 = Lib::getParameterFromRequest('selection_proprietaire2');
    $selection_marque = Lib::getParameterFromRequest('selection_marque');
    $selection_activite = Lib::getParameterFromRequest('selection_activite');
    $selection_rayon = Lib::getParameterFromRequest('selection_rayon');
    $selection_environnement = Lib::getParameterFromRequest('selection_environnement');
    $selection_reseau = Lib::getParameterFromRequest('selection_reseau');
    $selection_saisonnalite = Lib::getParameterFromRequest('selection_saisonnalite');

    $classificationModifier = ClassificationFta2Model::getClassificationModification($idUser);

    $classificationConsultation = Acl::getValueAccesRights("classification_consultation");
    if ($classificationModifier) {
        $editable = TRUE;
    } elseif ($classificationConsultation) {
        $editable = FALSE;
    }
    $isEditable = TRUE;

    if (!$selection_proprietaire1) {
        $selection_proprietaire1 = 0;
    }
    ClassificationFta2Model::initClassification($selection_proprietaire1, $selection_proprietaire2, $selection_marque
            , $selection_activite, $selection_rayon, $selection_environnement, $selection_reseau, $selection_saisonnalite);
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
    $bloc.="<td>" . ClassificationFta2Model::getListeClassificationProprietaireGroupe($selection_proprietaire1, $isEditable) . "</td>";

    if ($selection_proprietaire1) {

        $bloc.= "<td>" . ClassificationFta2Model::getListeClassification($selection_proprietaire1, $selection_proprietaire2
                        , ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE
                        , ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE
                        , 'selection_proprietaire2'
                        , $isEditable
                        , $selection_marque2
                ) . "</td>";

        if ($selection_proprietaire2 <> NULL) {
            $bloc.="<td>" . ClassificationFta2Model::getListeClassification($selection_proprietaire2, $selection_marque
                            , ClassificationFta2Model::FIELDNAME_ID_MARQUE
                            , ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE
                            , 'selection_marque'
                            , $isEditable
                    ) . "</td>";
            if ($selection_marque) {
                $bloc.="<td>" . ClassificationFta2Model::getListeClassification($selection_marque, $selection_activite
                                , ClassificationFta2Model::FIELDNAME_ID_ACTIVITE
                                , ClassificationFta2Model::FIELDNAME_ID_MARQUE
                                , 'selection_activite'
                                , $isEditable
                        ) . "</td>";
                if ($selection_activite) {
                    $bloc.="<td>" . ClassificationFta2Model::getListeClassification($selection_activite, $selection_rayon
                                    , ClassificationFta2Model::FIELDNAME_ID_RAYON
                                    , ClassificationFta2Model::FIELDNAME_ID_ACTIVITE
                                    , 'selection_rayon'
                                    , $isEditable
                            ) . "</td>";
                    if ($selection_rayon) {
                        $bloc.="<td>" . ClassificationFta2Model::getListeClassification($selection_rayon, $selection_environnement
                                        , ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT
                                        , ClassificationFta2Model::FIELDNAME_ID_RAYON
                                        , 'selection_environnement'
                                        , $isEditable
                                ) . "</td>";
                        if ($selection_environnement) {
                            $bloc.="<td>" . ClassificationFta2Model::getListeClassification($selection_environnement, $selection_reseau
                                            , ClassificationFta2Model::FIELDNAME_ID_RESEAU
                                            , ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT
                                            , 'selection_reseau'
                                            , $isEditable
                                    ) . "</td>";
                            if ($selection_reseau) {
                                $bloc.="<td>" . ClassificationFta2Model::getListeClassification($selection_reseau, $selection_saisonnalite
                                                , ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE
                                                , ClassificationFta2Model::FIELDNAME_ID_RESEAU
                                                , 'selection_saisonnalite'
                                                , $isEditable
                                        ) . "</td>";
                            }
                        }
                    }
                }
            }
        }
    }


    $bloc .= "<" . $html_table . "><tr class=titre>";
    if ($classificationModifier) {
        $bloc .= "<td></td>";
    }
    $bloc .= "<td>Proprietaire (Groupe)</td>"
            . "<td>Proprietaire (Enseigne)</td>"
            . "<td>" . HtmlResult::MARQUE . "</td>"
            . "<td>" . HtmlResult::ACTIVITE . "</td>"
            . "<td>" . HtmlResult::RAYON . "</td>"
            . "<td>" . HtmlResult::ENVIRONNEMENT . "</td>"
            . "<td>" . HtmlResult::RESEAU . "</td>"
            . "<td>" . HtmlResult::SAISONALITE . "</td>"
            . "</tr>";


    $array = ClassificationFta2Model::getArrayListeClassification();

    foreach ($array as $value) {
        $key = $value[ClassificationFta2Model::KEYNAME];
        $bloc .="<tr class=\"contenu\" name=id_fta_classification2 value=" . $key . ">";
//Modifier

        $bloc.="<td><a href=classification_modifier.php?id_fta_classification2=" . $key . "&action=modifier&isEditable=$editable > "
                . "<img src=../lib/images/next.png alt=Modifier  width=24 height=24 border=0 />"
                . "</a>";
        if ($classificationModifier) {
            $bloc.="<a href=# onClick=confirmation_correction_classification" . $key . "() > "
                    . "<img src=../lib/images/supprimer.png alt=Supprimer cette Classification  width=24 height=24 border=0 />"
                    . "</a></td>";

            $javascript.='
                           <SCRIPT LANGUAGE=JavaScript>
                                   function confirmation_correction_classification' . $key . '()
                                   {
                                   if(confirm(\'Etes vous certain de vouloir supprimer cette classification ? \'))
                                   {
                                       location.href =\'classification_modifier_post.php?id_fta_classification2=' . $key . '&action=supprimer\'
                                   }
                                    else{}
                                   }
                           </SCRIPT>
                           ';
            $Ajout = " Ajout d'une classification:<a href=classification_modifier.php><img src=\"../lib/images/plus.png\"/\" alt=\"\" width=\"10\" height=\"10\" border=\"0\" /></a>";
        }

        $bloc.= "<td >" . ClassificationFta2Model::getNameClassification($value[ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE]) . "</td>"
                . "<td >" . ClassificationFta2Model::getNameClassification($value[ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE]) . "</td>"
                . "<td >" . ClassificationFta2Model::getNameClassification($value[ClassificationFta2Model::FIELDNAME_ID_MARQUE]) . "</td>"
                . "<td >" . ClassificationFta2Model::getNameClassification($value[ClassificationFta2Model::FIELDNAME_ID_ACTIVITE]) . "</td>"
                . "<td >" . ClassificationFta2Model::getNameClassification($value[ClassificationFta2Model::FIELDNAME_ID_RAYON]) . "</td>"
                . "<td >" . ClassificationFta2Model::getNameClassification($value[ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT]) . "</td>"
                . "<td >" . ClassificationFta2Model::getNameClassification($value[ClassificationFta2Model::FIELDNAME_ID_RESEAU]) . "</td>"
                . "<td >" . ClassificationFta2Model::getNameClassification($value[ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE]) . "</td>";

        $bloc .="</tr>";
    }
}
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
             <form name=recherche_groupe method=" . $method . " action=" . $page_action . ">
             <input type=hidden name=action value=" . $action . ">

             <" . $html_table . ">
             <tr class=titre_principal><td>

                 Module de classification Agis

             </td></tr>
             <tr><td>

                 Ce module permet de centraliser et d'harmoniser la classification des différents éléments suivants:<br>
                 <br>
               </td></tr>
             <tr><td>
            " . $Ajout . "
            " . $bloc . $javascript . "

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