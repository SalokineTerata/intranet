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

$id_fta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
$synthese_action = Lib::getParameterFromRequest('synthese_action');
$id_fta_chapitre_encours = Lib::getParameterFromRequest('id_fta_chapitre_encours', '1');
$comeback = Lib::getParameterFromRequest('comeback');
$idFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$abreviationFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::FIELDNAME_ABREVIATION);
$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);
$id_fta_chapitre = $id_fta_chapitre_encours;
$ftaModel = new FtaModel($id_fta);
/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER['PHP_SELF'], '/'), '1', '-4');
$page_action = 'modification_fiche.php';
$page_pdf = $page_default . '_pdf.php';
$action = 'valider';                       //Action proposée à la page _post.php
$method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = 'table '              //Permet d'harmoniser les tableaux
        . 'width=100% '
        . 'class=titre_principal '
;
$detail_id_fta;              //Identifiant de la fiche sur laquelle on souhaite un détail

/*
  Récupération des données MySQL
 */

Navigation::initNavigation($id_fta, $id_fta_chapitre, $synthese_action, $comeback, $idFtaEtat, $abreviationFtaEtat, $idFtaRole,FALSE);
$navigue = Navigation::getHtmlNavigationBar();
//Calcul du taux
$taux_temp = FtaSuiviProjetModel::getFtaTauxValidation($ftaModel, TRUE);
$details[$id_fta] = $taux_temp[1];

//Détail d'un FTA
if ($id_fta) {

    $bloc.= '
       <' . $html_table . '>
       <tr class=titre>
           <td>
           ' . DatabaseDescription::getFieldDocLabel(FtaRoleModel::TABLENAME, FtaRoleModel::FIELDNAME_DESCRIPTION_FTA_ROLE) . '
           </td>
           <td>
           ' . DatabaseDescription::getFieldDocLabel('fta_processus', 'nom_fta_processus') . '
           </td>
           <td>
           ' . DatabaseDescription::getFieldDocLabel(FtaChapitreModel::TABLENAME, FtaChapitreModel::FIELDNAME_NOM_CHAPITRE) . '
           </td>
           <td>
           Taux
           </td>
           <td>
           Etat
           </td>
           </td>


       </tr>
       ';
    /*   //$id_access_arti2; //Clef récupérée précédement
      $req = 'SELECT id_access_arti2 FROM access_arti2 WHERE id_fta=''.$id_fta.'' ';
      $result = DatabaseOperation::query($req);
      $id_access_arti2=mysql_result($result, 0, 'id_access_arti2');
      mysql_table_load('access_arti2'); */

    $tab = $details[$id_fta];
    if ($tab) {
        foreach ($tab as $id_fta_processus => $taux) {
            $champChapitre = "";
            //Chargement des données

            $ftaProcessusModel = new FtaProcessusModel($id_fta_processus);
            $date_echeance_fta = $ftaModel->getDataField(FtaModel::FIELDNAME_DATE_ECHEANCE_FTA)->getFieldValue();
            $idFtaWorkflow = $ftaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
            /**
             * 1 en attente 
             * 2 en cours
             * 3 validé
             */
            if ($taux == "0") {
                $idFtaProcessusEtat = "1";
                /**
                 * Vérification que tous les processus précédent soit validé si oui le processus est encours
                 */
                $taux_validation_processus = FtaProcessusModel::getFtaProcessusNonValidePrecedent($id_fta, $id_fta_processus, $idFtaWorkflow);
                if ($taux_validation_processus == "1" or $taux_validation_processus === NULL) {
                    $idFtaProcessusEtat = "2";
                }
            } elseif ($taux <> "0" and $taux <> "1") {
                $idFtaProcessusEtat = "2";
            } elseif ($taux == "1") {
                $idFtaProcessusEtat = "3";
            }

            $ftaProcessusEtatModel = new FtaProcessusEtatModel($idFtaProcessusEtat);
//            $idSite = $ftaModel->getDataField(FtaModel::FIELDNAME_SITE_ASSEMBLAGE)->getFieldValue();

            $arrayIdFtaChapitre = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                            'SELECT DISTINCT ' . FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE
                            . ' FROM ' . FtaWorkflowStructureModel::TABLENAME . ',' . FtaChapitreModel::TABLENAME
                            . ' WHERE ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_WORKFLOW . '=' . $idFtaWorkflow
                            . ' AND ' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_PROCESSUS . '=' . $id_fta_processus
                            . ' AND ' . FtaChapitreModel::TABLENAME . '.' . FtaChapitreModel::KEYNAME
                            . '=' . FtaWorkflowStructureModel::TABLENAME . '.' . FtaWorkflowStructureModel::FIELDNAME_ID_FTA_CHAPITRE
            );

            $nombreChapitre = count($arrayIdFtaChapitre);

            foreach ($arrayIdFtaChapitre as $rowsIdFtaChapitre) {
                $champChapitre .=$rowsIdFtaChapitre[FtaChapitreModel::FIELDNAME_NOM_USUEL_CHAPITRE] . '<br>';
            }
//            $geoModel = new GeoModel($idSite);
//            $nom_site = $geoModel->getDataField(GeoModel::FIELDNAME_GEO)->getFieldValue();
            $nom_fta_processus = $ftaProcessusModel->getDataField(FtaProcessusModel::FIELDNAME_NOM)->getFieldValue();
            $service_fta_processus = $ftaProcessusModel->getDataField(FtaProcessusModel::FIELDNAME_SERVICE)->getFieldValue();
            $couleur_fta_processus_etat = $ftaProcessusEtatModel->getDataField(FtaProcessusEtatModel::FIELDNAME_COULEUR_PROCESSUS_ETAT)->getFieldValue();
            $nom_fta_processus_etat = $ftaProcessusEtatModel->getDataField(FtaProcessusEtatModel::FIELDNAME_NOM_PROCESSUS_ETAT)->getFieldValue();

            //Ecriture du code HTML
            $bloc.= '
               <tr class=contenu >
                    <td >
                   &nbsp;' . $service_fta_processus . '
                   </td>
                   <td >
                   &nbsp;' . $nom_fta_processus . '
                   </td> <td>   
                   ' . $champChapitre . '
                  </td> <td >
                   &nbsp;' . round($taux * "100", "2") . '%
                   </td>
                   <td bgcolor=' . $couleur_fta_processus_etat . ' >
                   &nbsp;' . $nom_fta_processus_etat . '
                   </td>
                  
               </tr>
               ';
//         <td width=22% bgcolor=\'$couleur_fta_processus_delai\'>
//                   &nbsp;' . $HTML_echeance . '
//                   </td>
//                   <td width=22% bgcolor=\'$couleur_fta_processus_valide\'>
//                   &nbsp;' . $HTML_valide . '
//                   </td>
        }
    }
}

//Echéance de validation de la FTA
$annee_date_echeance_fta = substr($date_echeance_fta, 0, 4);
$mois_date_echeance_fta = substr($date_echeance_fta, 5, 2);
$jour_date_echeance_fta = substr($date_echeance_fta, 8, 2);

//$jour_restant = mktime(0,0,0,$mois_date_echeance_processus - date('m'), $jour_date_echeance_processus - date('d'), $annee_date_echeance_processus - date ('Y'));
$echeance_timestamp = mktime(0, 0, 0, $mois_date_echeance_fta, $jour_date_echeance_fta, $annee_date_echeance_fta);
$today_timestamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
$seconde_restante = $echeance_timestamp - $today_timestamp;
$jour_restant = round($seconde_restante / (3600 * 24), 2);


if ($jour_restant < 0) {
    $txt_echeance = 'échéance dépassée de';
    $jour_restant = abs($jour_restant);
} else {
    $txt_echeance = 'reste';
}

$HTML_echeance_fta = 'A valider avant le: ' . $date_echeance_fta . ' <i>(' . $txt_echeance . ' ' . $jour_restant . 'jours)</i>';

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

        echo '
             <form name=navigation method=' . $method . ' action=' . $page_action . '>
             <input type=hidden name=action value=' . $action . '>

             <' . $html_table . '>
             <tr class=titre_principal><td>

                ' . $navigue . '<br>
                 Etat d\'avancement de la Fiche Technique Article<br>
                 <br>
                 ' . $HTML_echeance_fta . '<br><br>
             
             </td></tr>
             <tr class=contenu><td>
             </td></tr>
             
               ' . $bloc . '


             <tr><td>

                 <!center>
                 <!input type=submit value=\'Enregistrer\'>
                 <!/center>

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