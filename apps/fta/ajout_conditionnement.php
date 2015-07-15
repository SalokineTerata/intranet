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
        //include ("../lib/debut_page.php");      //Construction d'une nouvelle
        require_once '../inc/main.php';
        print_page_begin($disable_full_page, $menu_file);
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
$page_query = $_SERVER["QUERY_STRING"];
$page_action = $page_default . "_post.php";
$page_pdf = $page_default . "_pdf.php";
$method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = "table "              //Permet d'harmoniser les tableaux
        . "border=0 "
        . "width=100% "
        . "class=contenu "
;

/*
  Récupération des données MySQL
 */
$id_annexe_emballage_groupe_type = $type_emballage_groupe;

//echo $id_annexe_emballage_groupe_type;

mysql_table_load("annexe_emballage_groupe_type");
mysql_table_load("fta");

$bloc = ""; //Bloc de saisie
//Adaptation du formulaire en fonction des informations déjà saisie
if (!$action) {                    //Si aucun groupe d'emballage n'a était sélectionné
    $action = "etape1";  //L'action sera de sélectionner un groupe d'emballage
}

switch ($action) {
    case "etape1": //Sélection du groupe d'emballage
        //$action="saisie_manuel";
        //Dans le cas d'emballage UVC, on peut avoir de l'emballage primaire
        if ($type_emballage_groupe == 2) {
            $op = "<=";
        } else {
            $op = "=";
        }

        //Type d'emballage
        $nom_liste = "id_annexe_emballage_groupe";
        $requete = "SELECT id_annexe_emballage_groupe, nom_annexe_emballage_groupe "
                . "FROM annexe_emballage_groupe "
                . "WHERE id_annexe_emballage_groupe_configuration" . $op . $type_emballage_groupe . " " //Emballage Primaire et UVC
                . "ORDER BY nom_annexe_emballage_groupe "
        ;
        //$id_defaut = $id_annexe_emballage_groupe;
        $id_defaut = "";
        $nom_defaut = "";
        $liste_emballage_groupe = mysql_field_desc("annexe_emballage_groupe", "nom_annexe_emballage_groupe")
                . "</td><td>"
                . afficher_requete_en_liste_deroulante($requete, $id_defaut, $nom_defaut)
        //. "&nbsp;<input type=\"checkbox\" name=\"modele\" value=\"1\" />"
        //. "Utiliser la liste des modèles&nbsp;&nbsp;<input type=submit value='>>'>"
        ;
        $bloc.=$liste_emballage_groupe . "</tr></table><$html_table><tr class=titre_principal><td width=\"50%\">";

        /*            <$html_table><tr class=titre_principal><td width=\"50%\">
          <$html_table>
          <tr class=titre_principal> <td width=\"40%\"> Valeur Personnalisées</td>
          </tr>";
         */

        break;

    case "etape3": //Personnalisation de la FTE

        $is_editable = true;
        $is_editable_false = false;

        $id_fta_conditionnement = Lib::getParameterFromRequest("id_fta_conditionnement");
        $id_fta = Lib::getParameterFromRequest("id_fta");




        if ($id_fta_conditionnement) {
            // //Cas d'une modification d'un conditionnement existant
            //mysql_table_load("fta_conditionnement");
            $recordConditionnement = new DatabaseRecord(
                            "fta_conditionnement",
                            $id_fta_conditionnement
            );
            $id_annexe_emballage = Lib::getParameterFromRequest(
                            "id_annexe_emballage", $recordConditionnement->getFieldValue("id_annexe_emballage")
            );
            $id_annexe_emballage_groupe_type = Lib::getParameterFromRequest(
                            "type_emballage_groupe", $recordConditionnement->getFieldValue("id_annexe_emballage_groupe_type")
            );
        } else {
            //Cas d'une création
            $id_annexe_emballage = Lib::getParameterFromRequest("id_annexe_emballage");
            $id_annexe_emballage_groupe_type = Lib::getParameterFromRequest("type_emballage_groupe");
        }

        //mysql_table_load("annexe_emballage");
        $recordEmballage = new DatabaseRecord(
                        "annexe_emballage",
                        $id_annexe_emballage
        );

        $id_annexe_emballage_groupe = Lib::getParameterFromRequest(
                        "id_annexe_emballage_groupe", $recordEmballage->getFieldValue("id_annexe_emballage_groupe")
        );
        //mysql_table_load("annexe_emballage_groupe");
        $recordEmballageGroupe = new DatabaseRecord(
                        "annexe_emballage_groupe",
                        "$id_annexe_emballage_groupe"
        );

        //mysql_table_load("annexe_emballage_groupe_type");
        $recordEmballageGroupeType = new DatabaseRecord(
                        "annexe_emballage_groupe_type",
                        $id_annexe_emballage_groupe_type
        );

        $objectFta = new ObjectFta($id_fta);

        //mysql_table_load("fta");
        //mysql_table_load("access_arti2");
        //Longueur de l'emballage
        //$champ = "longueur_fta_conditionnement";
        $field_name = "longueur_fta_conditionnement";
        $table_name = "fta_conditionnement";
        if ($id_fta_conditionnement) {
            $value = $recordConditionnement->getFieldValue($field_name);
        } else {
            $value = $recordEmballage->getFieldValue("longueur_annexe_emballage");
        }


        if ($recordEmballageGroupeType->getKeyValue() == 4) {
            // //Affectation par défaut pour les palettes
//            $bloc .= "<tr><td>" . mysql_field_desc("fta_conditionnement", $champ) . ":</td><td>";
//            $bloc .= "<input type=text name=" . $champ . " value=1200 size=20 readonly>";
//            $bloc.="</td></tr>";
            $htmlObject = new htmlInputText(
                            $field_name,
                            $table_name,
                            $value = "1200",
                            $is_editable_false,
                            $warning_update = ${"diff_" . $table_name}[$field_name]
            );
            $bloc.=$htmlObject->getHtmlResult();
        } else {
//            $bloc .= "<tr><td>" . mysql_field_desc("fta_conditionnement", $champ) . ":</td><td>";
//            $bloc .= "<input type=text name=" . $champ . " value=`" . $longueur_annexe_emballage . "` size=20/>";
//            $bloc.="</td></tr>";
            $htmlObject = new htmlInputText(
                            $field_name,
                            $table_name,
                            $value,
                            $is_editable,
                            $warning_update = ${"diff_" . $table_name}[$field_name]
            );
            $bloc.=$htmlObject->getHtmlResult();
        }

        //Largeur de l'emballage
        //$champ = "largeur_fta_conditionnement";
        $field_name = "largeur_fta_conditionnement";
        $table_name = "fta_conditionnement";
        if ($id_fta_conditionnement) {
            $value = $recordConditionnement->getFieldValue($field_name);
        } else {
            $value = $recordEmballage->getFieldValue("largeur_annexe_emballage");
        }

        if ($recordEmballageGroupeType->getKeyValue() == 4) { //Affectation par défaut pour les palettes
//            $bloc .= "<tr><td>" . mysql_field_desc("fta_conditionnement", $champ) . ":</td><td>";
//            $bloc .= "<input type=text name=" . $champ . " value=800 size=20 readonly>";
//            $bloc.="</td></tr>";
            $htmlObject = new htmlInputText(
                            $field_name,
                            $table_name,
                            $value = "800",
                            $is_editable_false,
                            $warning_update = ${"diff_" . $table_name}[$field_name]
            );
            $bloc.=$htmlObject->getHtmlResult();
        } else {
//            $bloc .= "<tr><td>" . mysql_field_desc("fta_conditionnement", $champ) . ":</td><td>";
//            $bloc .= "<input type=text name=" . $champ . " value=`" . $largeur_annexe_emballage . "` size=20/>";
//            $bloc.="</td></tr>";
            $htmlObject = new htmlInputText(
                            $field_name,
                            $table_name,
                            $value,
                            $is_editable,
                            $warning_update = ${"diff_" . $table_name}[$field_name]
            );
            $bloc.=$htmlObject->getHtmlResult();
        }
        //Hauteur de l'emballage
        $field_name = "hauteur_fta_conditionnement";
        $table_name = "fta_conditionnement";
        if ($id_fta_conditionnement) {
            $value = $recordConditionnement->getFieldValue($field_name);
        } else {
            $value = $recordEmballage->getFieldValue("hauteur_annexe_emballage");
        }
        if ($recordEmballageGroupeType->getKeyValue() == 4) {
            // //Affectation par défaut pour les palettes
//            $bloc .= "<tr><td>" . mysql_field_desc("fta_conditionnement", $champ) . ":</td><td>";
//            $bloc .= "<input type=text name=" . $champ . " value=150 size=20 readonly>";
//            $bloc.="</td></tr>";
            $htmlObject = new htmlInputText(
                            $field_name,
                            $table_name,
                            $value = "150",
                            $is_editable_false,
                            $warning_update = ${"diff_" . $table_name}[$field_name]
            );
            $bloc.=$htmlObject->getHtmlResult();
        } else {
            $htmlObject = new htmlInputText(
                            $field_name,
                            $table_name,
                            $value,
                            $is_editable,
                            $warning_update = ${"diff_" . $table_name}[$field_name]
            );
            $bloc.=$htmlObject->getHtmlResult();
//            $bloc .= "<tr><td>" . mysql_field_desc("fta_conditionnement", $champ) . ":</td><td>";
//            $bloc .= "<input type=text name=" . $champ . " value=`" . $hauteur_annexe_emballage . "` size=20/>";
//            $bloc.="</td></tr>";
        }

        //Poids de l'emballage
        //$champ = "poids_fta_conditionnement";
        $field_name = "poids_fta_conditionnement";
        $table_name = "fta_conditionnement";
        if ($id_fta_conditionnement) {
            $value = $recordConditionnement->getFieldValue($field_name);
        } else {
            $value = $recordEmballage->getFieldValue("poids_annexe_emballage");
        }
        if ($recordEmballageGroupeType->getKeyValue() == 4) {
            // //Affectation par défaut pour les palettes
//            $bloc .= "<tr><td>" . mysql_field_desc("fta_conditionnement", $champ) . ":</td><td>";
//            $bloc .= "<input type=text name=" . $champ . " value=23000 size=20 readonly>";
//            $bloc.="</td></tr>";
            $htmlObject = new htmlInputText(
                            $field_name,
                            $table_name,
                            $value = "23000",
                            $is_editable_false,
                            $warning_update = ${"diff_" . $table_name}[$field_name]
            );
            $bloc.=$htmlObject->getHtmlResult();
        } else {
//            $bloc .= "<tr><td>" . mysql_field_desc("fta_conditionnement", $champ) . ":</td><td>";
//            $bloc .= "<input type=text name=" . $champ . " value=`" . $poids_annexe_emballage . "` size=20/>";
//            $bloc.="</td></tr>";
            $htmlObject = new htmlInputText(
                            $field_name,
                            $table_name,
                            $value,
                            $is_editable,
                            $warning_update = ${"diff_" . $table_name}[$field_name]
            );
            $bloc.=$htmlObject->getHtmlResult();
        }
        //Cet emballage represente-il les dimensions de l'UVC ?
        /* if($type_emballage_groupe==2)
          {
          $dimension_uvc_fta_confitionnement=1;
          $champ="dimension_uvc_fta_confitionnement";
          $bloc .= "<tr><td>".mysql_field_desc("fta_conditionnement", $champ).":</td><td>"
          . "<input type=hidden name=dimension_uvc_fta_confitionnement value=1>"
          ;
          $bloc .= "<input type=\"checkbox\" checked disabled />";
          $bloc.="</td></tr>";
          } */


        //Nombre d'emballage présent
        if ($id_fta_conditionnement) {
            if (!$recordConditionnement->getFieldValue("quantite_par_couche_fta_conditionnement")) {
                $recordConditionnement->setFieldValue("quantite_par_couche_fta_conditionnement", $objectFta->getFieldValue(ObjectFta::TABLE_ARTI_NAME, "NB_UNIT_ELEM"));
            }
            if (!$recordConditionnement->getFieldValue("nombre_couche_fta_conditionnement")) {
                $recordConditionnement->setFieldValue("nombre_couche_fta_conditionnement", 1);
            }
            if (!$recordConditionnement->getFieldValue("pcb_fta_conditionnement")) {
                $recordConditionnement->setFieldValue("pcb_fta_conditionnement", 1);
            }
            $quantite_par_couche_fta_conditionnement = $recordConditionnement->getFieldValue("quantite_par_couche_fta_conditionnement");
            $nombre_couche_fta_conditionnement = $recordConditionnement->getFieldValue("nombre_couche_fta_conditionnement");
            $pcb_fta_conditionnement = $recordConditionnement->getFieldValue("pcb_fta_conditionnement");
            
        } else {
            $quantite_par_couche_fta_conditionnement = 1;
            $nombre_couche_fta_conditionnement = 1;
            $pcb_fta_conditionnement = 1;
        }
        
        switch ($recordEmballageGroupe->getFieldValue("id_annexe_emballage_groupe_configuration")) {
            case 1:
                $champ = "nombre_couche_fta_conditionnement";
                //$dimension_uvc_fta_confitionnement;
                if ($recordEmballageGroupeType->getKeyValue() == 2) {
                    $nb_emballage .="<tr><td>Quantité par Colis:</td><td>";
                } else {
                    $nb_emballage .= "<tr><td>Quantité par UVC:</td><td>";
                    $nombre_couche_fta_conditionnement = 1;
                }
                $nb_emballage .= "<input type=text name=quantite_par_couche_fta_conditionnement value=\"" . $quantite_par_couche_fta_conditionnement . "\" size=20/>";
                $nb_emballage .="</td></tr>";

                $nb_emballage .= "<input type=hidden name=nombre_couche_fta_conditionnement value=1 size=20/>";
                $nb_emballage .="</td></tr>";

                break;
            case 3:
                $champ = "quantite_par_couche_fta_conditionnement";
                $nb_emballage .= "<tr><td>" . DatabaseDescription::getColumnLabel("fta_conditionnement", "quantite_par_couche_fta_conditionnement") . ":</td><td>";
                $nb_emballage .= "<input type=text name=" . $champ . " value=`" . $quantite_par_couche_fta_conditionnement . "` size=20/>";
                $nb_emballage .="</td></tr>";

                $champ = "nombre_couche_fta_conditionnement";
                $nb_emballage .= "<tr><td>" . mysql_field_desc("fta_conditionnement", $champ) . ":</td><td>";
                $nb_emballage .= "<input type=text name=" . $champ . " value=`" . $nombre_couche_fta_conditionnement . "` size=20/>";
                $nb_emballage .="</td></tr>";
                
                $champ = "pcb_fta_conditionnement";
                $nb_emballage .= "<tr><td>" . mysql_field_desc("fta_conditionnement", $champ) . ":</td><td>";
                $nb_emballage .= "<input type=text name=" . $champ . " value=`" . ${$champ} . "` size=20/>";
                $nb_emballage .="</td></tr>";
                
                break;
            case 4:
                $nb_emballage .= "<input type=hidden name=quantite_par_couche_fta_conditionnement value=1 size=20/>";
                $nb_emballage .= "<input type=hidden name=nombre_couche_fta_conditionnement value=1 size=20/>";
                break;
        }
        break;

    case "etape2": //Sélection d'une FTE
        //Création de la liste prédéfini des Emballages
        /* $bloc .="</table></td><td>
          <table><tr><td width=\"100%\"> Liste des emballages:<br>
          "; */

        //Recherche du site de production de la fta actuelle
        $id_fta;
        mysql_table_load("access_arti2");

        //Construction des éléments de requêtes communs
        $common_select = "SELECT DISTINCT annexe_emballage.id_annexe_emballage, "
                . "CONCAT_WS('',nom_fte_fournisseur,' : ', reference_fournisseur_annexe_emballage, "
                . "' (', longueur_annexe_emballage,'x',largeur_annexe_emballage,'x',hauteur_annexe_emballage, ')' ) AS INTITULE "
        ;
        $common_from = "FROM annexe_emballage, fte_fournisseur";
        $common_where = "WHERE annexe_emballage.id_annexe_emballage_groupe ='" . $id_annexe_emballage_groupe . "' "
                . "AND annexe_emballage.id_fte_fournisseur=fte_fournisseur.id_fte_fournisseur "
        ;
        $common_order = "ORDER BY nom_fte_fournisseur, reference_fournisseur_annexe_emballage";

        //Selection Partielle ou totale ?
        switch ($page_reload) {
            case 1: //Voir toutes les FTE
                $title = "Liste des toutes les Fiches Techniques Emballages (FTE)";
                $req_liste_emballage = $common_select
                        . "$common_from "
                        . "$common_where "
                        . "$common_order "
                ;
                $checked = "checked";
                $page_reload = 0;
                break;

            case 0:
            default:
                $title = "Liste des Fiches Techniques Emballages (FTE) déjà utilisées dans des Fiches Techniques Articles validées pour le site";
                $req_liste_emballage = $common_select
                        . "$common_from, fta_conditionnement, access_arti2 "
                        . "$common_where "
                        . "AND annexe_emballage.id_annexe_emballage = fta_conditionnement.id_annexe_emballage "
                        . "AND access_arti2.id_fta = fta_conditionnement.id_fta "
                        . "AND access_arti2.CODE_ARTICLE IS NOT NULL "
                        . "AND Site_de_production =" . $Site_de_production . " "
                        . "$common_order "
                ;
                $checked = "";
                $page_reload = 1;
        }

        $nom_liste = "id_annexe_emballage";
        $id_defaut = $$nom_liste;
        $req_liste_emballage;
        $bloc .=$title
                . ": <br><br>"
                . afficher_requete_en_liste_deroulante($req_liste_emballage, $id_defaut, $nom_liste);
        $bloc .="</td><tr>";

        $bloc .="<tr><td>"
                . "<input type=\"checkbox\" onClick=\"js_page_reload()\" value=\"1\" $checked /> Voir toutes les Fiches Techniques Emballages (FTE)?"
                . "<input type=hidden name=page_reload value=$page_reload>"
                . "</td></tr>"
        ;

        break;
}//Fin de la selection de la saisie en fonction de l'action.



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
//echo $id_fta;
        echo "
             <form method=$method action=$page_action name=\"form_action\">
             <input type=hidden name=action value=$action>
             <input type=hidden name=current_page value=$page_default.php>
             <input type=hidden name=current_query value=$page_query>
             <input type=hidden name=id_fta value=$id_fta>
             <input type=hidden name=id_fta_conditionnement value=$id_fta_conditionnement>
             <input type=hidden name=id_fta_chapitre_encours value=$id_fta_chapitre_encours>
             <input type=hidden name=id_annexe_emballage_groupe_type value=$id_annexe_emballage_groupe_type>
             <input type=\"hidden\" name=\"synthese_action\" value=\"$synthese_action\" />
             <input type=\"hidden\" name=\"type_emballage_groupe\" value=\"$type_emballage_groupe\" />
             <input type=\"hidden\" name=\"id_annexe_emballage\" value=\"$id_annexe_emballage\" />
             <input type=\"hidden\" name=\"id_annexe_emballage_groupe\" value=\"$id_annexe_emballage_groupe\" />
             <input type=\"hidden\" name=\"dimension_uvc_fta_confitionnement\" value=\"$dimension_uvc_fta_conditionnement\" />

             <$html_table>
             <tr class=titre_principal><td>

                 " . $_SESSION["designation_commerciale_fta"] . " -  " . $_SESSION["id_dossier_fta"] . "v" . $_SESSION["id_version_dossier_fta"] . "
                 <br>
                 Ajout d'un nouvel $nom_annexe_emballage_groupe_type

             </td></tr>
             </table>
             <$html_table>
             <tr><td width=\"20%\">
                 $bloc
             </td></tr>
             </table>

             <$html_table>
             <tr><td width=\"20%\">
                 $nb_emballage
             </td></tr>
             </table>

             <$html_table>
             <tr><td>

                 <center>
                 <input type=submit value='Suivant'>
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