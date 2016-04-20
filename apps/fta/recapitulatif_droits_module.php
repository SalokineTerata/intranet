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
$method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = "table "              //Permet d'harmoniser les tableaux
        . "border=1 "
        . "width=100% "
        . "class=contenu "
;

/*
  Récupération des données MySQL
 */

//echo $module;

$intranetModulesModel = new IntranetModulesModel(IntranetModulesModel::ID_MODULES_FTA);
$nom_usuel_intranet_modules = $intranetModulesModel->getDataField(IntranetModulesModel::FIELDNAME_NOM_USUEL_INTRANET_MODULES)->getFieldValue();
//Lister les actions possibles sur le module

$result_action = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT " . IntranetActionsModel::KEYNAME . "," . IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS
                . " FROM " . IntranetActionsModel::TABLENAME
                . " WHERE " . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS . " = '" . IntranetModulesModel::ID_MODULES_FTA . "' "
                . " ORDER BY " . IntranetActionsModel::FIELDNAME_NOM_INTRANET_ACTIONS
);
$bloc.= "<" . $html_table . "><th>"
        . "Utilisateurs"
        . "</th><th>"
        . "Accès général"
        . "</th><th>"
        . "Diffusion"
        . "</th><th>"
        . "Impression"
        . "</th><th>"
        . "Espace de travail"
        . "</th>";

//Pour chaque niveaux, lister les utilisateur concernés

$arrayUser = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                "SELECT DISTINCT " . UserModel::TABLENAME . "." . UserModel::KEYNAME
                . "," . UserModel::FIELDNAME_NOM
                . "," . UserModel::FIELDNAME_PRENOM
                . "," . UserModel::FIELDNAME_LIEU_GEO
                . " FROM " . IntranetDroitsAccesModel::TABLENAME . ", " . UserModel::TABLENAME
                . " WHERE " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_USER . " = " . UserModel::TABLENAME . "." . UserModel::KEYNAME                              //Liaison
                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES . " = '" . IntranetModulesModel::ID_MODULES_FTA . "' "   //liaison
                . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . " <>'" . IntranetNiveauAccesModel::NIVEAU_GENERIC_FALSE . "'"
                . " AND " . UserModel::TABLENAME . "." . UserModel::FIELDNAME_ACTIF . " = '" . UserModel::USER_ACTIF
                . "' ORDER BY " . UserModel::FIELDNAME_NOM . "," . UserModel::FIELDNAME_PRENOM
);

foreach ($arrayUser as $rowsUser) {
    $arrayAction = DatabaseOperation::convertSqlStatementWithoutKeyToArrayComplete(
                    "SELECT DISTINCT " . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS
                    . " FROM " . IntranetDroitsAccesModel::TABLENAME
                    . " WHERE " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_USER . " = " . $rowsUser[UserModel::KEYNAME]                             //Liaison
                    . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES . " = '" . IntranetModulesModel::ID_MODULES_FTA . "' "   //liaison
                    . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . " <>'" . IntranetNiveauAccesModel::NIVEAU_GENERIC_FALSE . "'"
    );
    $bloc.= "<tr class=titre_principal><td>"
            . $rowsUser[UserModel::FIELDNAME_PRENOM] . " " . $rowsUser[UserModel::FIELDNAME_NOM]
            . "</td>"
    ;
    $checkModification = in_array(IntranetNiveauAccesModel::NIVEAU_FTA_MODIFICATION, $arrayAction);
    $checkConsultation = in_array(IntranetNiveauAccesModel::NIVEAU_FTA_CONSULTATION, $arrayAction);
    $checkDiffusion = in_array(IntranetNiveauAccesModel::NIVEAU_FTA_DIFFUSION, $arrayAction);
    $checkImpression = in_array(IntranetNiveauAccesModel::NIVEAU_FTA_IMPRESSION, $arrayAction);

    if ($checkModification) {
        $accesGeneralValue = "Modification";
        $diffusion = "Voir espaces de Travail";
        $arrayIdIntranetParents = DatabaseOperation::convertSqlStatementWithoutKeyToArrayComplete(
                        " SELECT " . IntranetActionsModel::FIELDNAME_MODULE_INTRANET_ACTIONS . ", " . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS
                        . " FROM  " . IntranetActionsModel::TABLENAME
                        . " WHERE " . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS . " IS NOT NULL"
                        . " GROUP BY  " . IntranetActionsModel::FIELDNAME_PARENT_INTRANET_ACTIONS);
        $arrayIdActionWorkflow = array_intersect($arrayIdIntranetParents, $arrayAction);
        $lienWorkflow = array_intersect($arrayIdIntranetParents, $arrayAction);
    } elseif ($checkConsultation) {
        $accesGeneralValue = "Consultation";
        if ($checkDiffusion) {
            $diffusion = "Siege";
        } else {
            $diffusion = "Non";
        }
    } else {
        $accesGeneralValue = "Non";
        if ($checkDiffusion) {
            $geoModel = new GeoModel($rowsUser[UserModel::FIELDNAME_LIEU_GEO]);
            $diffusion = $geoModel->getDataField(GeoModel::FIELDNAME_GEO)->getFieldValue();
        } else {
            $diffusion = "Non";
        }
    }
    if ($checkImpression) {
        $impression = "Oui";
    } else {
        $impression = "Non";
    }
    $bloc.="<td>" . $accesGeneralValue . "</td>"
            . "<td>" . $diffusion . "</td>"
            . "<td>" . $impression . "</td>"
            . "<td>" . $lienWorkflow . "</td></tr>"
    ;
}
//foreach ($result_action as $rows_action) {
//    foreach ($result_user as $rows_user) {
//        $bloc .= "<tr><td>" . $rows_user[UserModel::FIELDNAME_PRENOM] . " " . $rows_user[UserModel::FIELDNAME_NOM] . "</td>";
//
//        if ($rows_user[IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES] <> 1) {
//            $bloc .= "<td>Niveau = " . $rows_user[IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES] . "</<td></tr>";
//        }
//    }
//}







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
             <form method=" . $method . " action=" . $page_action . ">
             <input type=hidden name=action value=" . $action . ">

             <" . $html_table . ">
             <tr class=titre_principal><td>

                 Liste des utilisateurs ayants accès au module " . $nom_usuel_intranet_modules . ".

             </td></tr>
             <tr><td>

                " . $bloc . "

</td></tr>
<tr><td>

<center>
<!input type = submit value = 'Enregistrer'>
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