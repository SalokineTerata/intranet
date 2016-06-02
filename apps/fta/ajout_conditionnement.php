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
        print_page_begin($disable_full_page, $menu_file);
        flush();
}//Fin de la sélection du mode d'affichage de la page


/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER['PHP_SELF'], '/'), '1', '-4');
$page_query = $_SERVER['QUERY_STRING'];
$page_action = $page_default . '_post.php';
$page_pdf = $page_default . '_pdf.php';
$method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = 'table '              //Permet d'harmoniser les tableaux
        . 'border=0 '
        . 'width=100% '
        . 'class=contenu '
;
$idFta = Lib::getParameterFromRequest('id_fta');
$idAnnexeEmballageGroupeType = Lib::getParameterFromRequest(AnnexeEmballageGroupeTypeModel::KEYNAME);
$idAnnexeEmballageGroupe = Lib::getParameterFromRequest(AnnexeEmballageGroupeModel::KEYNAME);
$idAnnexeEmballage = Lib::getParameterFromRequest(AnnexeEmballageModel::KEYNAME);
$idFtaChapitreEncours = Lib::getParameterFromRequest(FtaChapitreModel::KEYNAME);
$syntheseAction = Lib::getParameterFromRequest('synthese_action');
$action = Lib::getParameterFromRequest('action');
$abreviationFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::FIELDNAME_ABREVIATION);
$idFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);
$comeback = Lib::getParameterFromRequest('comeback');
$page_reload = Lib::getParameterFromRequest('page_reload');

//Initialisation des modele
$ftaModel = new FtaModel($idFta);
$annexeEmballageGroupeTypeModel = new AnnexeEmballageGroupeTypeModel($idAnnexeEmballageGroupeType);
$annexeEmballageGroupeModel = new AnnexeEmballageGroupeModel($idAnnexeEmballageGroupe);
$annexeEmballageModel = new AnnexeEmballageModel($idAnnexeEmballage);


/*
  Récupération des données MySQL
 */
$id_annexe_emballage_groupe_type = $idAnnexeEmballageGroupeType;




$bloc = ''; //Bloc de saisie
//Adaptation du formulaire en fonction des informations déjà saisie
if (!$action) {                    //Si aucun groupe d'emballage n'a était sélectionné
    $action = 'etape1';  //L'action sera de sélectionner un groupe d'emballage
}

switch ($action) {
    case 'etape1': //Sélection du groupe d'emballage
        //Dans le cas d'emballage UVC, on peut avoir de l'emballage primaire
        if ($idAnnexeEmballageGroupeType == 2) {
            $op = '<=';
        } else {
            $op = '=';
        }

        //Type d'emballage
        $nom_liste = AnnexeEmballageGroupeModel::KEYNAME;
        $requete = 'SELECT ' . AnnexeEmballageGroupeModel::KEYNAME . ',' . AnnexeEmballageGroupeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE
                . ' FROM ' . AnnexeEmballageGroupeModel::TABLENAME
                . ' WHERE ' . AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION . $op . $idAnnexeEmballageGroupeType //Emballage Primaire et UVC
                . ' ORDER BY ' . AnnexeEmballageGroupeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE
        ;

        $id_defaut = '';
        $nom_defaut = AnnexeEmballageGroupeModel::KEYNAME;
        $liste_emballage_groupe = DatabaseDescription::getFieldDocLabel(AnnexeEmballageGroupeModel::TABLENAME, AnnexeEmballageGroupeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE)
                . '</td><td>'
                . AccueilFta::afficherRequeteEnListeDeroulante($requete, $id_defaut, $nom_defaut, TRUE);


        $bloc.=$liste_emballage_groupe . '</tr></table><' . $html_table . '><tr class=titre_principal><td width=\'50%\'>';

        break;

    case 'etape2': //Sélection d'une FTE
        //Création de la liste prédéfini des Emballages
        //Recherche du site de production de la fta actuelle
        //Construction des éléments de requêtes communs
        $common_select = 'SELECT DISTINCT ' . AnnexeEmballageModel::TABLENAME . '.' . AnnexeEmballageModel::KEYNAME
                . ', CONCAT_WS(\'\', ' . FteFournisseurModel::FIELDNAME_NOM_FTE_FOURNISSEUR . ', \' : \',' . AnnexeEmballageModel::FIELDNAME_REFERENCE_FOURNISSEUR_ANNEXE_EMBALLAGE
                . ',\' (\', ' . AnnexeEmballageModel::FIELDNAME_LONGUEUR_ANNEXE_EMBALLAGE
                . ', \'x\', ' . AnnexeEmballageModel::FIELDNAME_LARGEUR_ANNEXE_EMBALLAGE
                . ', \'x\', ' . AnnexeEmballageModel::FIELDNAME_HAUTEUR_ANNEXE_EMBALLAGE . ', \')\' ) AS INTITULE '
        ;
        $common_from = ' FROM ' . AnnexeEmballageModel::TABLENAME . ',' . FteFournisseurModel::TABLENAME;
        $common_where = ' WHERE ' . AnnexeEmballageModel::TABLENAME . '.' . AnnexeEmballageModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE
                . ' = \'' . $idAnnexeEmballageGroupe . '\' '
                . ' AND ' . AnnexeEmballageModel::TABLENAME . '.' . AnnexeEmballageModel::FIELDNAME_ID_FTE_FOURNISSEUR
                . '=' . FteFournisseurModel::TABLENAME . '.' . FteFournisseurModel::KEYNAME
        ;
        $common_order = ' ORDER BY ' . FteFournisseurModel::FIELDNAME_NOM_FTE_FOURNISSEUR . ',' . AnnexeEmballageModel::FIELDNAME_REFERENCE_FOURNISSEUR_ANNEXE_EMBALLAGE;

        //Selection Partielle ou totale ?
        switch ($page_reload) {
            case 1: //Voir toutes les FTE
                $title = 'Liste des toutes les Fiches Techniques Emballages (FTE)';
                $req_liste_emballage = $common_select
                        . $common_from
                        . $common_where
                        . $common_order
                ;
                $checked = 'checked';
                $page_reload = 0;
                break;

            case 0:
            default:
                $title = 'Liste des Fiches Techniques Emballages (FTE) déjà utilisées dans des Fiches Techniques Articles validées pour le site';
                $req_liste_emballage = $common_select
                        . $common_from . ',' . FtaConditionnementModel::TABLENAME . ', ' . FtaModel::TABLENAME
                        . $common_where
                        . ' AND ' . AnnexeEmballageModel::TABLENAME . '.' . AnnexeEmballageModel::KEYNAME
                        . '=' . FtaConditionnementModel::TABLENAME . '.' . FtaConditionnementModel::FIELDNAME_ID_ANNEXE_EMBALLAGE
                        . ' AND ' . FtaModel::TABLENAME . '.' . FtaModel::KEYNAME
                        . '=' . FtaConditionnementModel::TABLENAME . '.' . FtaConditionnementModel::FIELDNAME_ID_FTA
                        . $common_order
                ;
                $checked = '';
                $page_reload = 1;
        }

        $nom_liste = AnnexeEmballageModel::KEYNAME;
        $id_defaut = $nom_liste;
        $req_liste_emballage;
        $bloc .=$title
                . ': <br><br>'
                . AccueilFta::afficherRequeteEnListeDeroulante($req_liste_emballage, $id_defaut, $nom_liste, TRUE);
        $bloc .='</td><tr>';

        $bloc .='<tr><td>'
                . '<input type = \'checkbox\' onClick=\'js_page_reload()\' value=\'1\' ' . $checked . ' /> Voir toutes les Fiches Techniques Emballages (FTE)?'
                . '<input type=hidden name=page_reload value=' . $page_reload . '>'
                . '</td></tr>'
        ;

        break;

    case 'etape3': //Personnalisation de la FTE
        $is_editable = true;


        $annexeEmballageModel->setIsEditable($is_editable);


        //Longueur de l'emballage
        $bloc.=$annexeEmballageModel->getHtmlDataField(AnnexeEmballageModel::FIELDNAME_LONGUEUR_ANNEXE_EMBALLAGE);
        //Largeur de l'emballage
        $bloc.=$annexeEmballageModel->getHtmlDataField(AnnexeEmballageModel::FIELDNAME_LARGEUR_ANNEXE_EMBALLAGE);
        //Hauteur de l'emballage
        $bloc.=$annexeEmballageModel->getHtmlDataField(AnnexeEmballageModel::FIELDNAME_HAUTEUR_ANNEXE_EMBALLAGE);
        //Poids de l'emballage           
        $bloc.=$annexeEmballageModel->getHtmlDataField(AnnexeEmballageModel::FIELDNAME_POIDS_ANNEXE_EMBALLAGE);

        //Nombre d'emballage présent
        switch ($annexeEmballageGroupeModel->getDataField(AnnexeEmballageGroupeModel::FIELDNAME_ID_ANNEXE_EMBALLAGE_GROUPE_CONFIGURATION)->getFieldValue()) {
            case 1:
                $idAnnexeEmballageGroupeTypeTmp = $annexeEmballageGroupeTypeModel->getDataField(AnnexeEmballageGroupeTypeModel::KEYNAME)->getFieldValue();
                //Quantité par couche
                if ($idAnnexeEmballageGroupeTypeTmp == 2) {

                    $nbEmballage .='<tr><td>Quantité par Colis:</td><td>';
                    if (!$quantite_par_couche_fta_conditionnement) {
                        $quantite_par_couche_fta_conditionnement = $ftaModel->getDataField(FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON)->getFieldValue();
                        if (!$quantite_par_couche_fta_conditionnement) {
                            $quantite_par_couche_fta_conditionnement = 0;
                        }
                    }
                } else {
                    $nbEmballage .= '<tr><td>Quantité par UVC:</td><td>';
                    $quantite_par_couche_fta_conditionnement = 0;
                }

                $nbEmballage .= '<input type=text name= ' . FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT . ' value=\'' . $quantite_par_couche_fta_conditionnement . '\' size=20/ >';
                $nbEmballage .='</td></tr>';

                //Nombre de couche
                $nbEmballage .= '<input type=hidden name=' . FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT . ' value=1 size=20/>';
                $nbEmballage .='</td></tr>';
                break;
            case 3:
                //Quantité par couche
                $nbEmballage .= $annexeEmballageModel->getHtmlDataField(AnnexeEmballageModel::FIELDNAME_QUANTITE_PAR_COUCHE_ANNEXE_EMBALLAGE);
                //Nombre de couche
                $nbEmballage .= $annexeEmballageModel->getHtmlDataField(AnnexeEmballageModel::FIELDNAME_NOMBRE_COUCHE_ANNEXE_EMBALLAGE);
                break;

            case 4:
                //Quantité par couche
                $nbEmballage .= '<input type=hidden name=' . FtaConditionnementModel::FIELDNAME_QUANTITE_PAR_COUCHE_FTA_CONDITIONNEMENT . ' value=1 size=20/>';
                //Quantité par couche
                $nbEmballage .= '<input type=hidden name=' . FtaConditionnementModel::FIELDNAME_NOMBRE_COUCHE_FTA_CONDITIONNEMENT . ' value=1 size=20/>';
                break;
        }
}//Fin de la selection de la saisie en fonction de l'action.



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
             <input type=hidden name=current_query value=' . $page_query . ' >
             <input type=hidden name=id_fta value=' . $idFta . '>
             <input type=hidden name=id_fta_chapitre value=' . $idFtaChapitreEncours . ' >             
             <input type=hidden name=id_annexe_emballage value=' . $idAnnexeEmballage . ' >
             <input type=hidden name=id_annexe_emballage_groupe value=' . $idAnnexeEmballageGroupe . ' >
             <input type=hidden name=id_annexe_emballage_groupe_type value=' . $idAnnexeEmballageGroupeType . ' >
             <input type=hidden name=id_fta_role value=' . $idFtaRole . ' >
             <input type=hidden name=id_fta_etat value=' . $idFtaEtat . ' >
             <input type=\'hidden\' name=\'comeback\' value=\'' . $comeback . '\' />
             <input type=hidden name=abreviation_fta_etat value=' . $abreviationFtaEtat . ' >
             <input type=hidden name=synthese_action value=' . $syntheseAction . ' >

             <' . $html_table . '>
             <tr class=titre_principal><td>

                 ' . $ftaModel->getDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE)->getFieldValue()
        . ' - ' . $ftaModel->getDossierFta()
        . 'v' . $ftaModel->getDataField(FtaModel::FIELDNAME_VERSION_DOSSIER_FTA)->getFieldValue() . '
                 <br>
                 Ajout d\'un nouvel ' . $annexeEmballageGroupeTypeModel->getDataField(AnnexeEmballageGroupeTypeModel::FIELDNAME_NOM_ANNEXE_EMBALLAGE_GROUPE_TYPE)->getFieldValue()
        . ' </td></tr>
             </table>
             <' . $html_table . '>
             <tr><td width=\'20%\'>
                 ' . $bloc . '
             </td></tr>
             </table>

             <' . $html_table . '>
             <tr><td width=\'20%\'>
                ' . $nbEmballage . '
             </td></tr>
             </table>

             <' . $html_table . '>
             <tr><td>

                 <center>
                 <input type=submit value=\'Suivant\'>
                 </center>

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