<?php

//Redirection vers la page par défaut du module
//header ('Location: indexft.php');

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
//include ('../lib/session.php');         //Récupération des variables de sessions
//include ('../lib/debut_page.php');      //Affichage des éléments commun à l'Intranet
require_once '../inc/main.php';
print_page_begin($disable_full_page, $menu_file);

//if (isset($menu))                       //Si existant, utilisation du menu demandé
//   {include ('./$menu');}               //en variable
//else
//   {include ('./menu_principal.inc');}  //Sinon, menu par défaut


/* * ***********
  Début Code PHP
 * *********** */

/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER['PHP_SELF'], '/'), '1', '-4');
$page_action = $page_default . '_post.php';
$page_pdf = $page_default . '_pdf.php';
$action = 'valider';                       //Action proposée à la page _post.php
$method = 'POST';                          //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = 'table '                     //Permet d'harmoniser les tableaux
        . 'width=100% '
        . 'class=titre '
;
/*
  Récupération des données MySQL
 */


/*
  Création des objets HTML (listes déroulante, cases à cocher ...etc.)
 */
$id_fta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);
$globalConfig = new GlobalConfig();
$idUser = $globalConfig->getAuthenticatedUser()->getKeyValue();
$checked_vierge = '';
$checked_duplicate = '';
if ($id_fta) {
    $checked_duplicate = 'checked';
    $ftaModel = new FtaModel($id_fta);
    $idFtaWorkflow = $ftaModel->getDataField(FtaModel::FIELDNAME_WORKFLOW)->getFieldValue();
    $SiteDeProduction = $ftaModel->getDataField(FtaModel::FIELDNAME_SITE_ASSEMBLAGE)->getFieldValue();
    $designationCommercialeFta = $ftaModel->getDataField(FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE)->getFieldValue();
} else {
    $checked_vierge = 'checked';
}
$HtmlList = new HtmlListSelectTagName();

/*
 * Worflow de FTA
 */
$listeWorkflow = FtaWorkflowModel::ShowListeDeroulanteNomWorkflowByAcces($idUser, $HtmlList, TRUE, $idFtaWorkflow);



/*
 * Site de production FTA
 */

$listeSiteProduction = GeoModel::ShowListeDeroulanteSiteProdByAcces($idUser, $HtmlList, TRUE, $SiteDeProduction);



/* * *********
  Fin Code PHP
 * ********* */


/* * ************
  Début Code HTML
 * ************ */

echo '
     <form ' . $method . ' action=' . $page_action . '>
     <!input type=hidden name=action value=' . $action . '>
     <input type=hidden name=id_fta_role value=' . $idFtaRole . '>

     <' . $html_table . '>
     <tr class=titre_principal><td>

         Création d\'une Fiche Technique Article (FTA)

     </td></tr>
     <tr class=contenu><td>

         <input type=\'radio\' name=\'action\' value=\'1\' ' . $checked_vierge . ' /> Vierge

     </td></tr>
     <tr class=contenu><td>

         <input type=\'radio\' name=\'action\' value=\'2\'' . $checked_duplicate . '/> A Partir d\'une Fiche Technique Article existante
         <' . $html_table . '>
             <tr class=contenu><td align=\'right\' width=\'100\'>
                 ' . DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::KEYNAME) . ':
                 </td><td align=\'left\'>
                 <input type=\'text\' name=\'id_fta\' size=\'20\' value=\'' . $id_fta . '\' />
             </td></tr>
         </table>

     </td></tr>
     <tr><td>
     <br>
     </td></tr>
     <tr><td>

<div id="zone_de_rechargement">	
         <' . $html_table . '>           
             <tr class=contenu><td align=\'left\'>
                 ' . DatabaseDescription::getFieldDocLabel(FtaModel::TABLENAME, FtaModel::FIELDNAME_DESIGNATION_COMMERCIALE)
                    . ':</td><td><input type=\'text\' name=\'designation_commerciale_fta\' size=\'20\' value=\'' . $designationCommercialeFta . '\' />
             </td></tr>

                    ' . $listeWorkflow . '

                    ' . $listeSiteProduction . '

</table>
</div>

     </td></tr>
     <br>
     </td></tr>
     <tr><td>


         <' . $html_table . '>        
                 <input type=hidden name=\'abreviation_fta_etat\' value=\'I\' checked /> 
         </table>
         <center>
         <input type=submit value=\'Générer le nouveau dossier ...\'>
         </center>

     </td></tr>
     </table>

     </form>
     ';


/* * **********
  Fin Code HTML
 * ********** */

/* * *********************
  Inclusion de fin de page
 * ********************* */
include ('../lib/fin_page.inc');
?>

