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
$bloc = "";
foreach ($result_action as $rows_action) {
    $bloc.= "<" . $html_table . "><tr class=titre_principal><td>"
            . $rows_action[IntranetActionsModel::FIELDNAME_DESCRIPTION_INTRANET_ACTIONS]
            . "</td></tr>"
    ;

//Pour chaque niveaux, lister les utilisateur concernés

    $result_user = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                    "SELECT DISTINCT " . UserModel::FIELDNAME_NOM
                    . "," . UserModel::FIELDNAME_PRENOM
                    . "," . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES
                    . " FROM " . IntranetDroitsAccesModel::TABLENAME . ", " . UserModel::TABLENAME
                    . ", " . IntranetModulesModel::TABLENAME . " , " . IntranetActionsModel::TABLENAME
                    . " WHERE " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_USER . " = " . UserModel::TABLENAME . "." . UserModel::KEYNAME                              //Liaison
                    . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_MODULES . " = " . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME   //liaison
                    . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS . " = " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME  //liaison
                    . " AND " . IntranetActionsModel::TABLENAME . "." . IntranetActionsModel::KEYNAME . " = '" . $rows_action[IntranetDroitsAccesModel::FIELDNAME_ID_INTRANET_ACTIONS] . "' "
                    . " AND " . IntranetModulesModel::TABLENAME . "." . IntranetModulesModel::KEYNAME . " = '" . IntranetModulesModel::ID_MODULES_FTA . "' "
                    . " AND " . IntranetDroitsAccesModel::TABLENAME . "." . IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES . " <>'" . IntranetNiveauAccesModel::NIVEAU_GENERIC_FALSE
                    . "' ORDER BY niveau_intranet_droits_acces, login "
    );
    foreach ($result_user as $rows_user) {
        $bloc .= "<tr><td>" . $rows_user[UserModel::FIELDNAME_PRENOM] . " " . $rows_user[UserModel::FIELDNAME_NOM] . "</td>";

        if ($rows_user[IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES] <> 1) {
            $bloc .= "<td>Niveau = " . $rows_user[IntranetDroitsAccesModel::FIELDNAME_NIVEAU_INTRANET_DROITS_ACCES] . "</<td></tr>";
        }
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