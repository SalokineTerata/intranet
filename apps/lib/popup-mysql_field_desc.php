<?php

/* * *******
  Inclusions
 * ******* */

require_once '../inc/main.php';
print_page_begin(TRUE, $menu_file);
/*
  Initialisation des variables
 */
$page_default = substr(strrchr($_SERVER["PHP_SELF"], '/'), '1', '-4');
$page_action = $page_default . "_post.php";
$page_pdf = $page_default . "_pdf.php";
$method = 'POST';
$html_table = "table "                     //Permet d'harmoniser les tableaux
        . "border=1 "
        . "width=100% "
        . "class=contenu ";

/*
  Récupération des données MySQL
 */
$idIntranetColumnInfo = Lib::getParameterFromRequest(IntranetColumnInfoModel::KEYNAME);    //Fourni par URL
$edit_mode = Lib::getParameterFromRequest('edit_mode');
$action = Lib::getParameterFromRequest('action');
//Récupération des droits d'accès necessaire
$fta_consultation = Acl::getValueAccesRights('fta_consultation');
$fta_modification = Acl::getValueAccesRights('fta_modification');
$owner = IntranetColumnInfoModel::getOwner();
$QUERY_STRING = $_SERVER['QUERY_STRING'];
/**
 * Initilisation
 */
$intranetColumInfoModel = new IntranetColumnInfoModel($idIntranetColumnInfo);
$explication_intranet_description = $intranetColumInfoModel->getDataField(IntranetColumnInfoModel::FIELDNAME_EXPLICATION_INTRANET_COLUMN_INFO)->getFieldValue();
$nom_table = $intranetColumInfoModel->getDataField(IntranetColumnInfoModel::FIELDNAME_TABLE_NAME_INTRANET_COLUMN_INFO)->getFieldValue();
$nom_variable = $intranetColumInfoModel->getDataField(IntranetColumnInfoModel::FIELDNAME_COLUMN_NAME_INTRANET_COLUMN_INFO)->getFieldValue();
$fichier = $intranetColumInfoModel->getDataField(IntranetColumnInfoModel::FIELDNAME_UPLOAD_NAME_FILE)->getFieldValue();
$title = DatabaseDescription::getFieldDocLabel($nom_table, $nom_variable);



//L'utilisateur a-t-il la permission de modifier le manuel ?
if ($edit_mode) {

    $action = 'record';
}

/**
 * Affichage de la description
 */
$htmlTexArea = new HtmlTextArea();
$htmlTexArea->setTextAreaContent($explication_intranet_description);
$htmlTexArea->setHtmlRenderToTable();
$content = $htmlTexArea->getHtmlResult();
if ($fichier) {
    $image_modif = " <$html_table>
               <tr class=titre_principal>
                <td>        
                <span > <a href=" . ModuleConfigLib::CHEMIN_ACCES_UPLOAD . $fichier . " onclick=\"window.open(this.href); return false;\" >" . $fichier . "</a></span>
                </tr> 
              </table>";
}
$bouton_record = "";

/**
 * Modification de la description
 */
if ($edit_mode) {
    $bouton_record = "<tr><td>
                   <center>
                   <input type=submit value='Enregistrer'>
                   </center>
                   ";
    $htmlTexArea->setIsEditable(TRUE);
    $htmlTexArea->initObject(IntranetColumnInfoModel::FIELDNAME_EXPLICATION_INTRANET_COLUMN_INFO, NULL
            , $htmlTexArea->getTextAreaContent(), NULL
            , NULL, NULL
    );
    $content = $htmlTexArea->getHtmlResult();

    $image_modif = "<form method=POST action=upload.php enctype=multipart/form-data>	
              <$html_table>
               <tr class=titre_principal>
                <td>        
                <span > <a href=" . ModuleConfigLib::CHEMIN_ACCES_UPLOAD . $fichier . " onclick=\"window.open(this.href); return false;\" >" . $fichier . "</a></span>
                </td>
                <td>
                <!-- On limite le fichier à 10Go -->
                <input type=hidden name=MAX_FILE_SIZE value=85899345920>
                <input type=hidden name=id_intranet_column_info value=$idIntranetColumnInfo>
                Fichier : <input type=file name=avatar >
                <input type=submit name=envoyer value=\"Envoyer le fichier\" >
             </td></tr> 
              </table>
            </form>";
    if ($fichier) {
        $image_supp = "<td>        
                <span > <a href=popup-mysql_field_desc_post.php?id_intranet_column_info=" . $idIntranetColumnInfo . "&action=supprimer >Supprimer le fichier</a></span>
                </tr> ";
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




    /*     * **************
      Début Code HTML
     * ************ */
    default:
        //Construction de la page des tables annexes

        echo "<$html_table>";
        echo "<tr class=\"contenu\">";

        /*
          Menu accessible pour les utilisateurs ayant les droits
          en modifications sur ce module
         */
        if ($fta_modification AND $owner) {
            //Exemple d'un menu
            echo "<td align=\"right\">";
            echo "<a href=popup-mysql_field_desc.php?$QUERY_STRING&edit_mode=1><img src=\"../lib/images/stylo.jpeg\" width=\"30\" height=\"45\" border=\"0\" alt=\"\" /><br>Editer</a>";
            echo "</td>";
        }
        echo "</tr></table>";

//Génération du cadre de droite contenant la page .php
        echo "<td width=100%>";

        echo "
             <form method=$method action=$page_action>
             <input type=hidden name=explication_intranet_description; value=$explication_intranet_description;>
             <input type=hidden name=table_intranet_description value=$table_intranet_description>
             <input type=hidden name=champ_intranet_description value=$nom_variable>
             <input type=hidden name=id_intranet_column_info value=$idIntranetColumnInfo>
             <input type=hidden name=module value=$module>
             <input type=hidden name=action value=$action>
             <!input type=hidden name=edit_mode value=$edit_mode>

             <$html_table>
             <tr class=titre_principal><td>

                 $title 

             </td></tr>
             <tr>
                 $content
                </tr>
            <tr><td align=right>

                <i><small>$nom_table.$nom_variable</small></i>

             </td></tr>

                 $bouton_record

             </td></tr>
             </table>

             </form>
              $image_modif
                  $image_supp
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