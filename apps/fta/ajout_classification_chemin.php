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

/* * *******
  Inclusions
 * ******* */
//include ("../lib/session.php");         //Récupération des variables de sessions
//include ("../lib/debut_page.php");      //Affichage des éléments commun à l'Intranet
require_once '../inc/main.php';
print_page_begin($disable_full_page, $menu_file);
flush();


//if (isset($menu))                       //Si existant, utilisation du menu demandé
//   {include ("./$menu");}               //en variable
//else
//   {include ("./menu_principal.inc");}  //Sinon, menu par défaut


/* * ***********
  Début Code PHP
 * *********** */

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
        . "class=contenu "
;
/*
  Récupération des données MySQL
 */
$idFta = Lib::getParameterFromRequest('id_fta');
$selection_proprietaire1 = Lib::getParameterFromRequest('selection_proprietaire1');
$selection_proprietaire2 = Lib::getParameterFromRequest('selection_proprietaire2');
$selection_marque = Lib::getParameterFromRequest('selection_marque');
$selection_activite = Lib::getParameterFromRequest('selection_activite');
$selection_rayon = Lib::getParameterFromRequest('selection_rayon');
$selection_environnement = Lib::getParameterFromRequest('selection_environnement');
$selection_reseau = Lib::getParameterFromRequest('selection_reseau');
$selection_saisonnalite = Lib::getParameterFromRequest('selection_saisonnalite');
$syntheseAction = Lib::getParameterFromRequest('synthese_action');
//$action = Lib::getParameterFromRequest('action');
$abreviationFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::FIELDNAME_ABREVIATION);
$idFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);
$comeback = Lib::getParameterFromRequest('comeback');
$id_fta_chapitre_encours = Lib::getParameterFromRequest('id_fta_chapitre_encours');
$idFtaClassification2 = Lib::getParameterFromRequest('id_fta_classification2');
$checkIdFtaClasssification = Lib::getParameterFromRequest('checkIdFtaClasssification');

$modificationGestionnaire = Lib::getParameterFromRequest('gestionnaire');



if ($idFtaClassification2 and ! $checkIdFtaClasssification) {
    $ClassificationFta2Model = new ClassificationFta2Model($idFtaClassification2);
    $selection_proprietaire1 = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_GROUPE)->getFieldValue();
    $selection_proprietaire2 = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_PROPRIETAIRE_ENSEIGNE)->getFieldValue();
    $selection_marque = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_MARQUE)->getFieldValue();
    $selection_activite = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_ACTIVITE)->getFieldValue();
    $selection_rayon = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_RAYON)->getFieldValue();
    $selection_environnement = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_ENVIRONNEMENT)->getFieldValue();
    $selection_reseau = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_RESEAU)->getFieldValue();
    $selection_saisonnalite = $ClassificationFta2Model->getDataField(ClassificationFta2Model::FIELDNAME_ID_SAISONNALITE)->getFieldValue();
}
ClassificationFta2Model::initClassification($selection_proprietaire1, $selection_proprietaire2, $selection_marque
        , $selection_activite, $selection_rayon, $selection_environnement, $selection_reseau, $selection_saisonnalite);


$ListeCLassification = ClassificationFta2Model::showListeDeroulanteClassification2(TRUE);

if ($selection_saisonnalite) {
    $bouton_submit = FtaView::getHtmlButtonSubmit();
}
if (!$modificationGestionnaire) {
    $bouton_retour_vers_fta = FtaView::getHtmlButtonReturnFta($idFta, $id_fta_chapitre_encours, $syntheseAction, $idFtaEtat, $abreviationFtaEtat, $idFtaRole);

    Navigation::initNavigation($idFta, $id_fta_chapitre_encours, $syntheseAction, $comeback, $idFtaEtat, $abreviationFtaEtat, $idFtaRole, FALSE);

    $navigue = Navigation::getHtmlNavigationBar();
}
switch ($modificationGestionnaire){
    case "1";
        $action = "gestionnaire";
        break;
    case "2";
        $action = "gestionnaire1";
        break;
    default :
        $action ="valider";
    break;
}



/* * *********
  Fin Code PHP
 * ********* */


/* * ************
  Début Code HTML
 * ************ */

echo
$navigue . "
     <form " . $method . " action=" . $page_action . " name=form_action>
     <input type=hidden name=action value=" . $action . ">
     <input type=hidden name=id_fta id=id_fta value=" . $idFta . ">
     <input type=\"hidden\" name=\"synthese_action\" id=\"synthese_action\" value=\"" . $syntheseAction . "\" />
     <input type=\"hidden\" name=\"abreviation_fta_etat\" id=\"abreviation_fta_etat\" value=\"" . $abreviationFtaEtat . "\" />
     <input type=\"hidden\" name=\"id_fta_etat\" id=\"id_fta_etat\" value=\"" . $idFtaEtat . "\" />
     <input type=\"hidden\" name=\"id_fta_role\" id=\"id_fta_role\" value=\"" . $idFtaRole . "\" />
     <input type=\"hidden\" name=\"gestionnaire\" id=\"gestionnaire\" value=\"" . $modificationGestionnaire . "\" />
     <input type=\"hidden\" name=\"comeback\" id=\"comeback\" value=\"" . $comeback . "\" />
     <input type=\"hidden\" name=\"id_fta_chapitre_encours\" id=\"id_fta_chapitre_encours\" value=\"" . $id_fta_chapitre_encours . "\" />

     <" . $html_table . ">
         
     <tr class=titre_principal><td>

         Classification de la Fiche Technique Article

     </td>
     </tr>
    

        $ListeCLassification

        
     </tr>
     <tr>
        $bouton_retour_vers_fta
         $bouton_submit
         
    </tr>       
       
     </table>

     </form>
     ";


/* * **********
  Fin Code HTML
 * ********** */

/* * *********************
  Inclusion de fin de page
 * ********************* */
include ("../lib/fin_page.inc");
?>

