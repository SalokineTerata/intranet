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
//        include ('../lib/debut_page.php');      //Construction d'une nouvelle
        require_once '../inc/main.php';
        print_page_begin($disable_full_page, $menu_file);
        flush();


//        if (isset($menu))                       //Si existant, utilisation du menu demandé
//        {                                       //en variable
//           include ('./$menu');
//        }
//        else
//        {
//           include ('./menu_principal.inc');    //Sinon, menu par défaut
//        }
}//Fin de la sélection du mode d'affichage de la page


/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$page_default = "transiter";
$page_action = $page_default . '_post.php';
$page_pdf = $page_default . '_pdf.php';
$method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = 'table '              //Permet d'harmoniser les tableaux
        . 'border=1 '
        . 'width=100% '
        . 'class=contenu '
;

/*
  Récupération des données MySQL
 */
$action = Lib::getParameterFromRequest('action');
$idFta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);
$idFtaWorkflow = Lib::getParameterFromRequest(FtaWorkflowModel::KEYNAME);
$abreviation_fta_etat = Lib::getParameterFromRequest(FtaEtatModel::FIELDNAME_ABREVIATION);
$htmlResult = new HtmlResult2();
$idFtaProcessusEffectue = array();
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

    default:
        /*
          Création des objets HTML (listes déroulante, cases à cocher ...etc.)
         */

        $bloc = '';
        /**
         * On récupèer les Chapitres séléctionnés.
         */
        $arrayChapitre = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                        'SELECT ' . FtaChapitreModel::KEYNAME . ',' . FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE
                        . ' FROM ' . FtaChapitreModel::TABLENAME
                        . ' ORDER BY ' . FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE);
        foreach ($arrayChapitre as $rowsChapitre) {
            if (Lib::getParameterFromRequest(FtaChapitreModel::FIELDNAME_NOM_CHAPITRE . '_' . $rowsChapitre[FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE]) == 1) {
                $ListeDesChapitres[] = $rowsChapitre[FtaChapitreModel::KEYNAME];
            }
        }
        if ($ListeDesChapitres) {
            foreach ($ListeDesChapitres as $idChapitre) {
                $idFtaWorkflowStructure = FtaWorkflowStructureModel::getIdFtaWorkflowStructureByIdFtaAndIdChapitre(
                                $idFta, $idChapitre);
                $ftaWorkflowStructureModel = new FtaWorkflowStructureModel($idFtaWorkflowStructure, $idChapitre);
                $idFtaProcessus = $ftaWorkflowStructureModel->getDataField(FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS)->getFieldValue();
                $return = FtaProcessusModel::getProcessusNextFromIdFtaChapitres($idFta, $idFtaProcessus, $idFtaWorkflow, "I", $htmlResult, $idFtaProcessusEffectue);
                $ListeDesChapitresSuivant[] = FtaChapitreModel::getIdFtaChapitreByArrayProcessusAndWorkflow($return['processus'], $idFtaWorkflow);
                $redirectionSelectionne .= '&' . FtaChapitreModel::FIELDNAME_NOM_CHAPITRE . '_' . $idChapitre . '=1';
            }
            $ListeDesChapitresSuivant = array_unique($ListeDesChapitresSuivant);
            if ($ListeDesChapitresSuivant["0"]) {
                $arrayChapitreDescription = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                                'SELECT DISTINCT ' . FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE . ',' . FtaChapitreModel::KEYNAME
                                . ' FROM ' . FtaChapitreModel::TABLENAME
                                . ' WHERE ( 0' . FtaChapitreModel::addIdFtaChapitre($ListeDesChapitresSuivant["0"]) . ' )'
                );
                foreach ($arrayChapitreDescription as $rowsChapitreDescription) {
                    $bloc .= $rowsChapitreDescription[FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE] . ' / ';
                    $redirection .= '&' . FtaChapitreModel::FIELDNAME_NOM_CHAPITRE . '_' . $rowsChapitreDescription[FtaChapitreModel::KEYNAME] . '=2';
                }
            } else {
                $bloc = "<i>Les chapitres sélectionnés sont les seuls à être dévalidé </i>";
            }
        } else {
            //Averissement
            $titre = UserInterfaceMessage::FR_WARNING_CHAPITRES_TITLE;
            $message = UserInterfaceMessage::FR_WARNING_CHAPITRES;
            Lib::showMessage($titre, $message, $redirection);
        }


        $bouton_retour_vers_transiter = FtaView::getHtmlButtonReturnTransition($idFta, $action, $idFtaRole, "", "");
        $bouton_confirmation = FtaView::getHtmlButtonConfirmationTransition($idFta, $action, $idFtaRole, $redirectionSelectionne, $redirection);

        /*         * ************
          Début Code HTML
         * ************ */


        echo '
             <form method=' . $method . ' action=' . $page_action . '>
                <!input type=hidden name=action value=' . $action . '>
                <input type=hidden name=id_fta value=' . $idFta . '>
                <input type=hidden name=id_fta_role value=' . $idFtaRole . '>
                <input type=hidden name=id_fta_workflow value=' . $idFtaWorkflow . '>
                <input type=\'hidden\' name=\'abreviation_etat_destination\' value=\'' . $abreviationEtatDestination . '\' />
                <input type=hidden name=' . FtaModel::TABLENAME . '_' . FtaModel::FIELDNAME_COMMENTAIRE_MAJ_FTA . '_' . $idFta . ' value=`' . $commentaireMajFta . '`>
                <input type=hidden name=demande_abreviation_fta_transition value=' . $demande_abreviation_fta_transition . '>
                <input type=hidden name=synthese_action value=' . $syntheseAction . '>
                    <br><br><br><br><br><br><br><br><br><br><br>
             <' . $html_table . '>
                <tr class=titre_principal><td align=center>

                 &nbsp&nbsp&nbsp&nbsp
               <i> ' . UserInterfaceMessage::FR_WARNING_CHAPITRES_DE_FTA . '</i>
                 <br>
                     <' . $html_table . '>
                     <tr ><td align=center>
                                                 <br>
                         ' . $bloc . '

                     </td>
                     ' . $bouton_retour_vers_transiter . '
               ' . $bouton_confirmation . '
                     </tr>
                     </table>
                            
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
?>