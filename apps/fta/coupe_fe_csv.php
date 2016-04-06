<?php

require_once '../inc/main.php';
print_page_begin($disable_full_page, $menu_file);
flush();

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
$method = 'method=post';                   //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = 'table '                     //Permet d'harmoniser les tableaux
        . 'border=0 '
        . 'width=100% '
        . 'class=titre '
;

$arrayData = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT DISTINCT " . FtaModel::FIELDNAME_LIBELLE . "," . FtaModel::FIELDNAME_EAN_UVC
                . "," . FtaModel::FIELDNAME_CODE_ARTICLE_LDC . "," . FtaModel::FIELDNAME_NOMBRE_UVC_PAR_CARTON
                . "," . FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION . "," . FtaModel::FIELDNAME_LISTE_ALLERGENE
                . "," . FtaModel::FIELDNAME_ORIGINE_MATIERE_PREMIERE . "," . FtaModel::FIELDNAME_DUREE_DE_VIE
                . "," . FtaModel::FIELDNAME_CONSEIL_DE_RECHAUFFAGE. "," . FtaComposantModel::FIELDNAME_VAL_NUT_KCAL
                . "," . FtaComposantModel::FIELDNAME_VAL_NUT_KJ. "," . FtaComposantModel::FIELDNAME_VAL_MAT_GRASSE
                . "," . FtaComposantModel::FIELDNAME_VAL_ACIDE_GRAS. "," . FtaComposantModel::FIELDNAME_VAL_GLUCIDE
                . "," . FtaComposantModel::FIELDNAME_VAL_SUCRE. "," . FtaComposantModel::FIELDNAME_VAL_PROTEINE
                . "," . FtaComposantModel::FIELDNAME_VAL_SEL
                
                . " FROM " . FtaComposantModel::TABLENAME . "," . FtaModel::TABLENAME
                . " WHERE " . FtaComposantModel::TABLENAME . "." . FtaComposantModel::FIELDNAME_ID_FTA
                . "=" . FtaModel::TABLENAME . "." . FtaModel::KEYNAME
                . " AND " . FtaModel::FIELDNAME_ID_FTA_ETAT . "=" . FtaEtatModel::ID_VALUE_VALIDE
                . " AND " . FtaModel::FIELDNAME_WORKFLOW . "=" . FtaWorkflowModel::ID_WORKFLOW_COUPE_FE
                . " ORDER BY " . FtaModel::FIELDNAME_CODE_ARTICLE_LDC
);
$titres = array(
    "NOM du produit",
    "GENCOD",
    "Code Article Arcadia",
    "PCB",
    "Listes des ingrédients",
    "Listes des allergènes",
    "Origines matières premières",
    "DLC",
    "Conseils de réchauffage",
    "Energie (kcal)",
    "Energie (kJ)",
    "Matières grasses (g)",
    "Acides gras saturés (g)",
    "Glucides (g)",
    "Sucres (g)",
    "Protéines (g)",
    "Sel (g)",
);

$fp = fopen('download/coupe_fe.csv', 'w');
$bom = ( chr(0xEF) . chr(0xBB) . chr(0xBF));
fputs($fp, $bom);

fputcsv($fp, $titres, ";");
foreach ($arrayData as $fields) {
    fputcsv($fp, $fields, ";");
}
fclose($fp);




echo "

  
             
             <form name=recherche_groupe method=" . $method . " action=" . $page_action . ">
             <input type=hidden name=action value=" . $action . ">

             <" . $html_table . ">
             <tr class=titre_principal><td>

                 <h1>Téléchargement des Fta validé de l'espace de travail CoupeFe sous le format excel</h1>

             </td></tr>
             <tr class=contenu><td>
                                             <h2> <a href=./download/coupe_fe.csv target=_top>Téléchargé ICI</a></h2> 
                 <h3>º Nous vous conseillons d'utiliser le logiciel Libre Office afin d'ouvrir le fichier correctement<br>
                 <br>
                 º Afin d'utiliser le fichier sous Microsoft Excel veuillez suivre la méthode suivante :</h3><br>

               </td>
               <tr class=contenu>
               <td>
               <p>º Ouvrir le fichier avec libre office</p>
               <img src= ./../lib/images/etape1.png width=350 height=325 />
               <p>º Laissez les paramètres par défaut</p>
               </td>
               </tr>
               <tr class=contenu>
               <td>
               <p>º Cliquez sur l'onglet Fichier </p>
               <img src= ./../lib/images/etape2.png width=350 height=325 />
               <p>º Enregistrez sous le fichier</p>
               </td>
               </tr>
               <tr class=contenu>
               <td>
               <p>º Choisissez Microsoft Excel 2007/2010 XML </p>
               <img src= ./../lib/images/etape3.png  />
               <p>º Enregistrez et poursuivez en confirmant l'utilisation du format Microsoft Excel 2007/2010 XML</p>
               <img src= ./../lib/images/etape4.png  />
               </td>
               </tr>
               <tr class=contenu>
               <td>
                <p>º Cependant, il se peut que le GenCod ne soit pas au bon format</p>
               <p>º Ouvrez le fichier sous Excel</p>
                <img src= ./../lib/images/etape5.png width=350 height=325 />
               <p>º Sélectionner la colonne GenCod et faire un clique droit sur cette même colonne
               et sélectionner \"Format de cellule\"  
                </p>
               <img src= ./../lib/images/etape6.png  />
               <p>º Sur la Catégorie Nombre saisir le nombre de décimales à 0</p>
               </td>
               </tr>
               
</tr>
             <tr><td>
            " . $bloc . "

             </td></tr>
                
        </table>

        </form>
        ";

/* * *********************
  Inclusion de fin de page
 * ********************* */
include ("../lib/fin_page.inc");
