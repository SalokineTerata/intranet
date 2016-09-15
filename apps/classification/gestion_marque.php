<?php

//Sélection du mode de visualisation de la page
switch ($output) {

    case 'visualiser':
        //Inclusions
        include ('../lib/session.php');         //Récupération des variables de sessions
        include ('../lib/functions.php');       //On inclus seulement les fonctions sans construire de page
        include ('functions.php');              //Fonctions du module
        echo '
            <link rel=stylesheet type=text/css href=../lib/css/intra01.css />
            <link rel=stylesheet type=text/css href=visualiser.css />
       ';

    //break;
    case 'pdf':
        break;

    default:
        //Inclusions
//        include ('../lib/session.php');         //Récupération des variables de sessions
        //include ('../lib/debut_page.php');      //Construction d'une nouvelle
        require_once '../inc/main.php';
}//Fin de la sélection du mode d'affichage de la page


/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
print_page_begin($disable_full_page, $menu_file);
flush();
$page_default = substr(strrchr($_SERVER['PHP_SELF'], '/'), '1', '-4');
$page_query = $_SERVER['QUERY_STRING'];
$page_action = $page_default . '.php';
$page_pdf = $page_default . '_pdf.php';
$method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = 'table '              //Permet d'harmoniser les tableaux
        . 'border=0 '
        . 'width=100% '
        . 'class=contenu '
;
$idClassifcationFta2Marque = Lib::getParameterFromRequest(ClassificationFta2Model::FIELDNAME_ID_MARQUE);

$listeDesMarque = ClassificationFta2Model::getListeDeroulanteMarque($idClassifcationFta2Marque, Chapitre::EDITABLE);

if ($idClassifcationFta2Marque) {
    $htmlTableClassificationMarqueArcadia = ClassificationMarqueArcadiaModel::getHtmlTableClassificationMarqueArcadia($idClassifcationFta2Marque);
    $htmlTableClassificationGammeFamilleBudget = ClassificationGammeFamilleBudgetArcadiaModel::getHtmlTableClassificationGammeFamilleBudgetArcadia($idClassifcationFta2Marque);
} {
    $message = UserInterfaceMessage::FR_CLASSIFICATION_MARQUE_MESSAGE;
}

$bloc .=$listeDesMarque . $htmlTableClassificationMarqueArcadia . $htmlTableClassificationGammeFamilleBudget;



/*
  Sélection du mode d'affichage
 */
switch ($output) {

    /*     * ***********
      Début Code PDF
     * *********** */
    case 'pdf':
//Constructeur
        $pdf = new XFPDF();

//Déclaration des variables de formatages
        $police_standard = 'Arial';
        $t1_police = $police_standard;
        $t1_style = 'B';
        $t1_size = '12';

        $t2_police = $police_standard;
        $t2_style = 'B';
        $t2_size = '11';

        $t3_police = $police_standard;
        $t3_style = 'BIU';
        $t3_size = '10';

        $contenu_police = $police_standard;
        $contenu_style = '';
        $contenu_size = '8';

        $chapitre = 0;
        $section = 0;
        include($page_pdf);
//$pdf->SetProtection(array('print', 'copy'));
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
//echo $id_fta;
        echo '
             <form method=' . $method . ' action=' . $page_action . ' name=\'form_action\'>
             <input type=hidden name=action value=' . $action . ' >
             <input type=hidden name=current_page value=' . $page_default . '.php >
        

             <' . $html_table . '>
             <tr class=titre_principal><td>

    
                 <br>
                ' . $message . ' </td></tr>
             </table>
             <' . $html_table . '>
             <tr><td width=\'20%\'>
                 ' . $bloc . '
             </td></tr>
             </table>          


             </form>
             ';



        /*         * *********************
          Inclusion de fin de page
         * ********************* */
        include ('../lib/fin_page.inc');

    /*     * **********
      Fin Code HTML
     * ********** */
}//Fin du switch de sélection du mode d'affichage