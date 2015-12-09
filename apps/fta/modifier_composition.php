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
//$action="valider";  //L'action sera de sélectionner un groupe d'emballage
$method = 'POST';             //Pour une url > 2000 caractères, ne pas utiliser utiliser GET
$html_table = "table "              //Permet d'harmoniser les tableaux
        . "border=1 "
        . "width=100% "
        . "class=contenu "
;



/*
  Récupération des données MySQL
 */

$id_fta = Lib::getParameterFromRequest(FtaModel::KEYNAME);
$id_fta_composant = Lib::getParameterFromRequest(FtaComposantModel::KEYNAME);
$id_fta_chapitre = Lib::getParameterFromRequest('id_fta_chapitre_encours');
$idFtaRole = Lib::getParameterFromRequest(FtaRoleModel::KEYNAME);
$idFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::KEYNAME);
$abreviationFtaEtat = Lib::getParameterFromRequest(FtaEtatModel::FIELDNAME_ABREVIATION);
$comeback = Lib::getParameterFromRequest('comeback');
$syntheseAction = Lib::getParameterFromRequest('synthese_action');
$globalConfig = new GlobalConfig();
UserModel::checkUserSessionExpired($globalConfig);

$id_user = $globalConfig->getAuthenticatedUser()->getKeyValue();
$proprietaire = Lib::getParameterFromRequest('proprietaire');
$checkCreation = Lib::isDefined('checkCreation');
//Bouton Valider
if ($proprietaire) {
    $editable = TRUE;
    $action = "valider";
    $bouton_valider = "
            <input type=\"checkbox\" name=\"valider_saisie\" value=1 />Valider et revenir sur la FTA<br>
            <input type=submit value='Enregistrer les modifications'>
            ";
} else {
    $editable = FALSE;
    $action = "consulter";
    $bouton_valider = "
            <input type=submit value='Revenir sur la FTA'>
            ";
}
//Mode Création/Modification d'une nomenclature
/*
  if ($id_fta_composition)
  {
  $creation = 0;
  mysql_table_load("fta_composition");

  //Existe-il une nomenclature associée ?
  if($id_fta_nomenclature)
  {
  //Dans ce cas, chargement des informations
  mysql_table_load("fta_nomenclature");
  mysql_table_load("annexe_agrologic_article_codification");
  }
  mysql_table_load("geo");
  }
  else
  {
  $creation = 1;
  }
 */

//echo $id_fta."<br>";

/* * *****************************************************************************
  Gestion du composant
 * ****************************************************************************** */

//Mode Création/Modification d'un composant
if ($id_fta_composant) {
    $creation = 0;
    $ftaComposantModel = new FtaComposantModel($id_fta_composant);
    $ftaComposantView = new FtaComposantView($ftaComposantModel);
    $ftaComposantView->setIsEditable($editable);
    $ftaComposantView2 = new FtaComposantView($ftaComposantModel);
    $nom_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION)->getFieldValue();
    $ingredient_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION)->getFieldValue();
    $ingredient_fta_composition1 = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION1)->getFieldValue();
    $duree_vie_technique_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_DUREE_VIE_TECHNIQUE_FTA_COMPOSITION)->getFieldValue();
    $poids_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION)->getFieldValue();
    $quantite_fta_composition_uvc = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION_UVC)->getFieldValue();
    $ordre_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ORDRE_FTA_COMPOSITION)->getFieldValue();
    $is_nomenclature_fta_composant = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_IS_NOMENCLATURE_FTA_COMPOSANT)->getFieldValue();
    $mode_etiquette_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION)->getFieldValue();
    $taille_police_ingredient_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_TAILLE_POLICE_INGREDIENT_FTA_COMPOSITION)->getFieldValue();
    $etiquette_libelle_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_FTA_COMPOSITION)->getFieldValue();
    $etiquette_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE)->getFieldValue();
    $etiquette_supplementaire_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_SUPPLEMENTAIRE_FTA_COMPOSIITON)->getFieldValue();
    $etiquette_poids_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_POIDS_FTA_COMPOSITION)->getFieldValue();
    $etiquette_quantite_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_QUANTITE_FTA_COMPOSITION)->getFieldValue();
    $etiquette_duree_vie_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_DUREE_VIE_FTA_COMPOSITION)->getFieldValue();
    $k_style_paragraphe_ingredient_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_K_STYLE_PARAGRAPHE_INGREDIENT_FTA_COMPOSITION)->getFieldValue();
    $k_etiquette_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION)->getFieldValue();
    $etiquette_id_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_ID_FTA_COMPOSITION)->getFieldValue();
    $id_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ID_FTA_COMPOSTION)->getFieldValue();
    $id_access_recette_recette = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ID_ACCESS_RECETTE_RECETTE)->getFieldValue();
    $val_nut_sel = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_SEL)->getFieldValue();
    $val_nut_proteine = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_PROTEINE)->getFieldValue();
    $val_nut_sucre = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_SUCRE)->getFieldValue();
    $val_nut_glucide = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_GLUCIDE)->getFieldValue();
    $val_nut_acide_gras = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_ACIDE_GRAS)->getFieldValue();
    $val_nut_mat_grasse = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_MAT_GRASSE)->getFieldValue();
    $val_nut_kj = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_NUT_KJ)->getFieldValue();
    $val_nut_kcal = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_VAL_NUT_KCAL)->getFieldValue();
    $k_etiquette_verso_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_K_ETIQUETTE_VERSO_FTA_COMPOSITION)->getFieldValue();
    $k_codesoft_etiquette_logo = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_K_CODESOFT_ETIQUETTE_LOGO)->getFieldValue();
    $etiquette_decomposition_poids_fta_composant = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_DECOMPOSITION_POIDS_FTA_COMPOSANT)->getFieldValue();
    $etiquette_information_complementaire_recto_fta_composant = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_INFORMATION_COMPLEMENTAIRE_RECTO_FTA_COMPOSANT)->getFieldValue();
    $etiquette_libelle_legal_fta_composition = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_LEGAL_FTA_COMPOSITION)->getFieldValue();
    $code_produit_agrologic_fta_nomenclature = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE)->getFieldValue();
    $id_prefixe_code_produit_agrologic_fta_nomenclature = $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ID_ANNEXE_AGRO_ART_CODIFICATION)->getFieldValue();
    if ($id_prefixe_code_produit_agrologic_fta_nomenclature) {
        $annexexAgrologicModel = new AnnexeAgrologicArticleCodificationModel($id_prefixe_code_produit_agrologic_fta_nomenclature);
        $prefixe_code_produit_agrologic_fta_nomenclature = $annexexAgrologicModel->getDataField(AnnexeAgrologicArticleCodificationModel::FIELDNAME_PREFIXE_ANNEXE_AGRO_ART_COD)->getFieldValue();
    }
} else {
    $checkCreation = 0;
    if (!$checkCreation) {
        $creation = 1;
        $id_fta_composant = FtaComposantModel::createNewRecordset(
                        array(FtaComposantModel::FIELDNAME_ID_FTA => $id_fta)
        );
        $ftaComposantModel = new FtaComposantModel($id_fta_composant);
        $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION_UVC)->setFieldValue(FtaComposantModel::DEFAULT_VALUE_QTE_UVC);
        $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_IS_COMPOSITION_FTA_COMPOSANT)->setFieldValue("1");
        $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_IS_NOMENCLATURE_FTA_COMPOSANT)->setFieldValue("0");
        $ftaComposantModel->saveToDatabase();
        $ftaComposantView = new FtaComposantView($ftaComposantModel);
        $ftaComposantView->setIsEditable($editable);
        $ftaComposantView2 = new FtaComposantView($ftaComposantModel);
        $_SESSION['checkCreation'] = $creation;
    } else {
        $titre = "Erreur ";
        $message = "Veuillez utiliser les boutons de navigation";
        afficher_message($titre, $message, $redirection);
    }

//Ce composant sera géré dans la composition
//$is_composition_fta_composant = 1;
//La création d'un composant dans la composition n'inclus pas ce composant dans la nomenclature
//$is_nomenclature_fta_nomenclature = 0;
}

//Chargement des données de la FTA
$ftaModel = new FtaModel($id_fta);

//mysql_table_load("fta");
//echo $id_fta."<br>";
$bloc = ""; //Bloc de saisie
//Désignation
//$bloc .= "<tr><td>" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION) . "</td><td>";
//if ($proprietaire) {
//    $bloc .= "<input type=text name=" . FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION . " value='" . $nom_fta_composition . "' size=50/>";
//} else {
$bloc .= $ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION);

//}
//$bloc.="</td></tr>";
//Code Produit Agrologic
$bloc .= "<tr><td>" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_CODE_PRODUIT_AGROLOGIC_FTA_NOMENCLATURE) . "</td><td>";

$bloc .=$prefixe_code_produit_agrologic_fta_nomenclature . $code_produit_agrologic_fta_nomenclature;

$bloc.="</td></tr>";


//Liste des ingrédients
//$bloc .= "<tr><td>" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION) . "</td><td>";
//if ($proprietaire) {
//    $bloc .= "<textarea name=" . FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION . " rows=15 cols=75>" . $ingredient_fta_composition . "</textarea>";
//} else {
//    $bloc .=$ingredient_fta_composition;
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION);
//}
//$bloc.="</td></tr>";
//Liste des ingrédients (extension supplémentaire)
//$bloc .= "<tr><td>" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION1) . "</td><td>";
//
//if ($proprietaire) {
//    $bloc .= "<textarea name=" . FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION1 . " rows=15 cols=75>" . $ingredient_fta_composition1 . "</textarea>";
//} else {
//    $bloc .=$ingredient_fta_composition1;
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_INGREDIENT_FTA_COMPOSITION1);

//}
$bloc.="</td></tr>";

//Site de Fabrication
$SiteDeProduction = $ftaModel->getDataField(FtaModel::FIELDNAME_SITE_PRODUCTION)->getFieldValue();


//Site de facbrication de la composition
$HtmlList = new HtmlListSelect();

$bloc .= FtaComposantModel::ShowListeDeroulanteSiteProdForComposant($HtmlList, $editable, $id_fta, $id_fta_composant, FtaComposantModel::FIELDNAME_ID_GEO);

//$bloc.="</td></tr>";
//echo $id_fta."<br>";
//Durée de Vie
//$bloc .= "<tr><td>" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_DUREE_VIE_TECHNIQUE_FTA_COMPOSITION) . "</td><td>";
//if ($proprietaire) {
//    $bloc .= "<input type=text name=" . FtaComposantModel::FIELDNAME_DUREE_VIE_TECHNIQUE_FTA_COMPOSITION . " value='" . $duree_vie_technique_fta_composition . "' size=50/>";
//} else {
//    $bloc .=$duree_vie_technique_fta_composition;
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_DUREE_VIE_TECHNIQUE_FTA_COMPOSITION);

//}
//$bloc.="</td></tr>";
//Poids
//$bloc .= "<tr><td>" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION) . "</td><td>";
//
//if ($proprietaire) {
//    $bloc .= "<input type=text name=" . FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION . " value='" . $poids_fta_composition . "' size=50/>";
//} else {
//    $bloc .=$poids_fta_composition;
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION);

//}
//$bloc.="</td></tr>";
//Quantité
//$bloc .= "<tr><td>" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION) . "</td><td>";
//if ($proprietaire) {
//    $bloc .= "<input type=text name=" . FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION . " value='" . $quantite_fta_composition . "' size=50/>";
//} else {
//    $bloc .=$quantite_fta_composition;
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION_UVC);

//}
//$bloc.="</td></tr>";
//Ordre dans le quel présenter les composants
//$bloc .= "<tr><td>" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_ORDRE_FTA_COMPOSITION) . "</td><td>";
//
//if ($proprietaire) {
//    $bloc .= "<input type=text name=" . FtaComposantModel::FIELDNAME_ORDRE_FTA_COMPOSITION . " value='" . $ordre_fta_composition . "' size=50/>";
//} else {
//    $bloc .=$ordre_fta_composition;
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_ORDRE_FTA_COMPOSITION);

//}
//$bloc.="</td></tr>";

/* * *****************************************************************************
  Gestion de l'étiquette associée à ce composant
 * ****************************************************************************** */

$bloc .= "</td></tr>
             </table>
             <" . $html_table . ">
             <tr class=titre_principal><td>

                 Etiquette
             </td></tr>
             </table>
             <" . $html_table . ">
            
        ";


//Mode de fonctionnement de l'Etiquette Composition
//Versionning
$color_modif = "";
$image_modif = "";
if (${"diff_" . FtaComposantModel::TABLENAME}[FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION]) {
    $image_modif = $html_image_modif;
    $color_modif = $html_color_modif;
}
$bloc .= "<tr class=contenu><td " . $color_modif . ">" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION) . "</td><td " . $color_modif . ">";
$checked6 = "";
$checked7 = "";
$checked8 = "";
if ($proprietaire) {
    $data_disabled_0 = "";

// Le champ $id_fta_nomenclature est obsolète
//if($id_fta_nomenclature)  //Sans code Agrologic, on ne peut pas étiqueter
//echo $is_nomenclature_fta_composant." ".$code_produit_agrologic_fta_nomenclature." " .$activation_codesoft_arti2;
//if($is_nomenclature_fta_composant and $code_produit_agrologic_fta_nomenclature and ($activation_codesoft_arti2==2
    $activation_codesoft_arti2 = $ftaModel->getDataField(FtaModel::FIELDNAME_ACTIVATION_CODESOFT)->getFieldValue();

    if ($activation_codesoft_arti2 == 2 or $activation_codesoft_arti2 == 3) {
        $data_disabled_1 = "";
        $data_disabled_4 = "";
    } else {
        $data_disabled_1 = "disabled";
        $data_disabled_4 = "disabled";
    }
} else {
    $data_disabled_0 = "disabled";
    $data_disabled_1 = "disabled";
    $data_disabled_4 = "disabled";
}
if (!$mode_etiquette_fta_composition and ( $activation_codesoft_arti2 == 2 or $activation_codesoft_arti2 == 3)) {
    $mode_etiquette_fta_composition = 0;
}
switch ($mode_etiquette_fta_composition) {

    case 0: //Pas d'étiquette composition
        $checked_0 = "checked";
//$etiquette_fta_composition=$etiquette_supplementaire_fta_composition="";

        break;
    case 1: //Contenu de l'etiquette identique à la liste des ingrédients
        $checked_1 = "checked";
//$etiquette_fta_composition=$ingredient_fta_composition;
//$etiquette_supplementaire_fta_composition=$ingredient_fta_composition1;

        break;
    /* OBSOLETE
      case 2: //Etiquette regroupant quelques composants
      $checked_2="checked";

      break;
     * */

    /* ONBSOLETE
      case 3: //L'étiquette est regroupée sur un autre composant
      $checked_3="checked";

      break;
     * */

    case 4: //Etiquette personnalisée
        $checked_4 = "checked";

        break;

    default:
//case 14:
        $checked_0 = "checked";
        break;
}
$bloc .= "<input type=radio name=" . FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION . " value=0 " . $checked_0 . " " . $data_disabled_0 . " > Pas d'étiquette pour ce composant " . $image_modif . "<br>";
$bloc .= "<input type=radio name=" . FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION . " value=1 " . $checked_1 . " " . $data_disabled_1 . " > Etiquette identique à ce composant " . $image_modif . "<br>";
//$bloc .= "<input type=radio name=".$champ." value=2 $checked_2 $data_disabled_2> Etiquette regroupant quelques composants $image_modif<br>";
//$bloc .= "<input type=radio name=".$champ." value=3 $checked_3 $data_disabled_3> L'étiquette est regroupée sur un autre composant $image_modif<br>";
$bloc .= "<input type=radio name=" . FtaComposantModel::FIELDNAME_MODE_ETIQUETTE_FTA_COMPOSITION . " value=4 " . $checked_4 . " " . $data_disabled_4 . " > Etiquette personnalisée " . $image_modif . "<br>";
$bloc .="</td></tr>";

//$etiquette_poids_fta_composition=$poids_fta_composition*$quantite_fta_composition;

/* * *********************************************************************
  Contenu de l'étiquette
 * ********************************************************************* */

//Données par défaut
$default_etiquette_libelle_fta_composition = $nom_fta_composition;
$default_etiquette_fta_composition = $ingredient_fta_composition;
$default_etiquette_supplementaire_fta_composition = $ingredient_fta_composition1;
$default_etiquette_poids_fta_composition = $poids_fta_composition / 1000;  //Conversion de g -> Kg
$default_etiquette_quantite_fta_composition = $quantite_fta_composition_uvc;
$default_etiquette_duree_vie_fta_composition = $duree_vie_technique_fta_composition;

//Initialisation des données
//echo "MODE: $mode_etiquette_fta_composition<br><br>";

switch ($mode_etiquette_fta_composition) {
    case 0:

        /*
         * Les données étiquettes sont purgées
         */
        $etiquette_libelle_fta_composition = "";
        $etiquette_fta_composition = "";
        $etiquette_supplementaire_fta_composition = "";
        $etiquette_poids_fta_composition = 0;
        $etiquette_quantite_fta_composition = 0;
        $etiquette_duree_vie_fta_composition = 0;

        break;

    case 1:
        /*
         * Etiquette identique à ce composant
         * Les données sont forcées avec les valeurs par défaut
         */

        $etiquette_libelle_fta_composition = $default_etiquette_libelle_fta_composition;
        $etiquette_fta_composition = $default_etiquette_fta_composition;
        $etiquette_supplementaire_fta_composition = $default_etiquette_supplementaire_fta_composition;
        $etiquette_poids_fta_composition = $default_etiquette_poids_fta_composition;
        $etiquette_quantite_fta_composition = $default_etiquette_quantite_fta_composition;
        $etiquette_duree_vie_fta_composition = $default_etiquette_duree_vie_fta_composition;

        break;
    case 4:

        /*
         * Les données sont initialisées si absente.
         */
        if ($etiquette_libelle_fta_composition == "") {
            $etiquette_libelle_fta_composition = $default_etiquette_libelle_fta_composition;
        }
        if ($etiquette_fta_composition == "") {
            $etiquette_fta_composition = $default_etiquette_fta_composition;
        }
        if ($etiquette_supplementaire_fta_composition == "") {
            $etiquette_supplementaire_fta_composition = $default_etiquette_supplementaire_fta_composition;
        }
        if ($etiquette_poids_fta_composition == "") {
            $etiquette_poids_fta_composition = $default_etiquette_poids_fta_composition;
        }
        if ($etiquette_quantite_fta_composition == "") {
            $etiquette_quantite_fta_composition = $default_etiquette_quantite_fta_composition;
        }
        if ($etiquette_duree_vie_fta_composition == "") {
            $etiquette_duree_vie_fta_composition = $default_etiquette_duree_vie_fta_composition;
        }
        break;
}

/* * *********************************************************************
  Interface utilisateur pour configurer de l'étiquette
 * ********************************************************************* */

//Pour modifier le contenu de l'étiquette  l'utilisateur doit être propriétaires et l'étquette doit être personnalisable
if ($proprietaire and $mode_etiquette_fta_composition == 4) {
    $edit_allow = true;
} else {
    $edit_allow = false;
}

$ftaComposantView2->setIsEditable($edit_allow);

//Libellé produit de l'étiquette
$champ = "etiquette_libelle_fta_composition";
$table = "fta_composant";
//Versionning
$color_modif = "";
$image_modif = "";
if (${"diff_" . $table}[$champ]) {
    $image_modif = $html_image_modif;
    $color_modif = $html_color_modif;
}
//$bloc .= "<tr><td " . $color_modif . " >" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_FTA_COMPOSITION) . "</td><td " . $color_modif . ">";
//
//if ($edit_allow) {
//    $bloc .= "<textarea name=" . FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_FTA_COMPOSITION . " rows=4 cols=75>" . $etiquette_libelle_fta_composition . "</textarea>";
$bloc .=$ftaComposantView2->getHtmlDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_FTA_COMPOSITION);

//} else {
//    $bloc .=$etiquette_libelle_fta_composition;
//    $bloc .= "<input type=hidden name=" . FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_FTA_COMPOSITION . " value='" . $etiquette_libelle_fta_composition . "'/>";
//
//}
//$bloc.=$image_modif . "</td></tr>";
//Désignation légale produit de l'étiquette
$champ = "etiquette_libelle_legal_fta_composition";
$table = "fta_composant";
//Versionning
$color_modif = "";
$image_modif = "";
if (${"diff_" . $table}[$champ]) {
    $image_modif = $html_image_modif;
    $color_modif = $html_color_modif;
}
//$bloc .= "<tr><td " . $color_modif . ">" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_LEGAL_FTA_COMPOSITION) . "</td><td " . $color_modif . ">";
//if ($edit_allow) {
//    $bloc .= "<textarea name=" . FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_LEGAL_FTA_COMPOSITION . " rows=4 cols=75>" . $etiquette_libelle_legal_fta_composition . "</textarea>";
//} else {
//    $bloc .=$etiquette_libelle_legal_fta_composition;
//    $bloc .= "<input type=hidden name=" . FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_LEGAL_FTA_COMPOSITION . " value='" . $etiquette_libelle_legal_fta_composition . "'/>";
$bloc .=$ftaComposantView2->getHtmlDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_LIBELLE_LEGAL_FTA_COMPOSITION);

//}
//$bloc.="$image_modif</td></tr>";
//Composition Etiquette
$champ = "etiquette_fta_composition";
$table = "fta_composant";
//Versionning
$color_modif = "";
$image_modif = "";
if (${"diff_" . $table}[$champ]) {
    $image_modif = $html_image_modif;
    $color_modif = $html_color_modif;
}
//$bloc .= "<tr><td " . $color_modif . ">" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_ETIQUETTE) . "</td><td " . $color_modif . ">";
//if ($edit_allow) {
//    $bloc .= "<textarea name=" . FtaComposantModel::FIELDNAME_ETIQUETTE . " rows=15 cols=75>" . $etiquette_fta_composition . "</textarea>";
////$bloc .= "<input type=text name=".$champ." value=`".${$champ}."` size=50/>";
//} else {
//    $bloc .=$etiquette_fta_composition;
//    $bloc .= "<input type=hidden name=" . FtaComposantModel::FIELDNAME_ETIQUETTE . " value='" . $etiquette_fta_composition . "'/>";
$bloc .=$ftaComposantView2->getHtmlDataField(FtaComposantModel::FIELDNAME_ETIQUETTE);

//}
//$bloc.=$image_modif . "</td></tr>";
//Composition Etiquette (extension supplémentaire)
$champ = "etiquette_supplementaire_fta_composition";
$table = "fta_composant";

//Versionning
$color_modif = "";
$image_modif = "";
if (${"diff_" . $table}[$champ]) {
    $image_modif = $html_image_modif;
    $color_modif = $html_color_modif;
}
//$bloc .= "<tr><td " . $color_modif . ">" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_ETIQUETTE_SUPPLEMENTAIRE_FTA_COMPOSIITON) . "</td><td " . $color_modif . ">";
//if ($edit_allow) {
//    $bloc .= "<textarea name=" . FtaComposantModel::FIELDNAME_ETIQUETTE_SUPPLEMENTAIRE_FTA_COMPOSIITON . " rows=15 cols=75>$etiquette_supplementaire_fta_composition</textarea>";
//} else {
//    $bloc .=$etiquette_supplementaire_fta_composition;
//    $bloc .= "<input type=hidden name=" . FtaComposantModel::FIELDNAME_ETIQUETTE_SUPPLEMENTAIRE_FTA_COMPOSIITON . " value='" . $etiquette_supplementaire_fta_composition . "'/>";
$bloc .=$ftaComposantView2->getHtmlDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_SUPPLEMENTAIRE_FTA_COMPOSIITON);

//}
//
//$bloc.="$image_modif</td></tr>";
//********************************* Informations complémentaires récto
$champ = "etiquette_information_complementaire_recto_fta_composant";
$table = "fta_composant";

//Versionning
$color_modif = "";
$image_modif = "";
if (${"diff_" . $table}[$champ]) {
    $image_modif = $html_image_modif;
    $color_modif = $html_color_modif;
}
//$bloc .= "<tr><td " . $color_modif . ">" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_ETIQUETTE_INFORMATION_COMPLEMENTAIRE_RECTO_FTA_COMPOSANT) . "</td><td" . $color_modif . ">";
//if ($edit_allow) {
//    $bloc .= "<textarea name=" . FtaComposantModel::FIELDNAME_ETIQUETTE_INFORMATION_COMPLEMENTAIRE_RECTO_FTA_COMPOSANT . " rows=3 cols=75>" . $etiquette_information_complementaire_recto_fta_composant . "</textarea>";
//} else {
//    $bloc .=$etiquette_information_complementaire_recto_fta_composant;
//    $bloc .= "<input type=hidden name=" . FtaComposantModel::FIELDNAME_ETIQUETTE_INFORMATION_COMPLEMENTAIRE_RECTO_FTA_COMPOSANT . " value='" . $etiquette_information_complementaire_recto_fta_composant . "'/>";
$bloc .=$ftaComposantView2->getHtmlDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_INFORMATION_COMPLEMENTAIRE_RECTO_FTA_COMPOSANT);
//}
//$bloc.="$image_modif</td></tr>";
//Durée de vie etiquetée
$champ = "etiquette_duree_vie_fta_composition";
$table = "fta_composant";

//Versionning
$color_modif = "";
$image_modif = "";
if (${"diff_" . $table}[$champ]) {
    $image_modif = $html_image_modif;
    $color_modif = $html_color_modif;
}
//$bloc .= "<tr><td " . $color_modif . ">" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_ETIQUETTE_DUREE_VIE_FTA_COMPOSITION) . "</td><td " . $color_modif . ">";
//if ($edit_allow) {
//    $bloc .= "<input type=text name=" . FtaComposantModel::FIELDNAME_ETIQUETTE_DUREE_VIE_FTA_COMPOSITION . " value='" . $etiquette_duree_vie_fta_composition . "' size=50/>";
//} else {
//    $bloc .=$etiquette_duree_vie_fta_composition;
//    $bloc .= "<input type=hidden name=" . FtaComposantModel::FIELDNAME_ETIQUETTE_DUREE_VIE_FTA_COMPOSITION . " value='" . $etiquette_duree_vie_fta_composition . "'/>";
$bloc .=$ftaComposantView2->getHtmlDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_DUREE_VIE_FTA_COMPOSITION);

//}
//Poids net etiqueté
$champ = "etiquette_poids_fta_composition";
$table = "fta_composant";

//Versionning
$color_modif = "";
$image_modif = "";
if (${"diff_" . $table}[$champ]) {
    $image_modif = $html_image_modif;
    $color_modif = $html_color_modif;
}
//$bloc .= "<tr><td " . $color_modif . ">" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_ETIQUETTE_POIDS_FTA_COMPOSITION) . "</td><td " . $color_modif . ">";
//if ($edit_allow) {
//    $bloc .= "<input type=text name=" . FtaComposantModel::FIELDNAME_ETIQUETTE_POIDS_FTA_COMPOSITION . " value='" . $etiquette_poids_fta_composition . "' size=50/>";
//} else {
//    $bloc .=$etiquette_poids_fta_composition;
//    $bloc .= "<input type=hidden name=" . FtaComposantModel::FIELDNAME_ETIQUETTE_POIDS_FTA_COMPOSITION . " value='" . $etiquette_poids_fta_composition . "'/>";
$bloc .=$ftaComposantView2->getHtmlDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_POIDS_FTA_COMPOSITION);

//}
//Décomposition du poids
$champ = "etiquette_decomposition_poids_fta_composant";
$table = "fta_composant";

//Versionning
$color_modif = "";
$image_modif = "";
if (${"diff_" . $table}[$champ]) {
    $image_modif = $html_image_modif;
    $color_modif = $html_color_modif;
}
//$bloc .= "<tr><td " . $color_modif . ">" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_ETIQUETTE_DECOMPOSITION_POIDS_FTA_COMPOSANT) . "</td><td " . $color_modif . ">";
//if ($edit_allow) {
//    $bloc .= "<input type=text name=" . FtaComposantModel::FIELDNAME_ETIQUETTE_DECOMPOSITION_POIDS_FTA_COMPOSANT . " value='" . $etiquette_decomposition_poids_fta_composant . "' size=50/>";
//} else {
//    $bloc .=$etiquette_decomposition_poids_fta_composant;
//    $bloc .= "<input type=hidden name=" . FtaComposantModel::FIELDNAME_ETIQUETTE_DECOMPOSITION_POIDS_FTA_COMPOSANT . " value='" . $etiquette_decomposition_poids_fta_composant . "'/>";
$bloc .=$ftaComposantView2->getHtmlDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_DECOMPOSITION_POIDS_FTA_COMPOSANT);

//}
//Liste des composants regroupés sur cette étiquette
if ($id_fta_composant) {
    $arrayComposition = DatabaseOperation::convertSqlStatementWithoutKeyToArray(
                    " SELECT " . FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION . "," . FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION . "," . FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION_UVC
                    . " FROM " . FtaComposantModel::TABLENAME
                    . " WHERE " . FtaComposantModel::FIELDNAME_ETIQUETTE_ID_FTA_COMPOSITION . "=" . $id_fta_composant
                    . " ORDER BY " . FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION
    );
}

if ($arrayComposition) {
    $liste_composant_associee = "";
    foreach ($arrayComposition as $rows) {
        $liste_composant_associee.=$rows[FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION] . "<br>";
        $etiquette_poids_fta_composition = $etiquette_poids_fta_composition + ($rows[FtaComposantModel::FIELDNAME_POIDS_FTA_COMPOSITION] * $rows[FtaComposantModel::FIELDNAME_QUANTITE_FTA_COMPOSITION_UVC]);
    }
    $bloc .="<tr><td>Liste des composants inclus sur cette étiquette</td>"
            . "<td>" . $liste_composant_associee . "</td></tr>";
}
//Configuration de l'étiquette
if ($mode_etiquette_fta_composition == 1 or $mode_etiquette_fta_composition == 2 or $mode_etiquette_fta_composition == 4) {


//Taile de la police de la liste d'ingrédient:
    $champ = "taille_police_ingredient_fta_composition";
    $table = "fta_composant";
//Versionning
    $color_modif = "";
    $image_modif = "";
    if (${"diff_" . $table}[$champ]) {
        $image_modif = $html_image_modif;
        $color_modif = $html_color_modif;
    }
    $bloc .= "<tr class=contenu><td " . $color_modif . ">" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_TAILLE_POLICE_INGREDIENT_FTA_COMPOSITION) . "</td><td " . $color_modif . ">";

//Remise à zéro des bouton radio
    $checked4 = $checked5 = $checked6 = $checked7 = $checked8 = "";

//Activation uniquement de celui correspondant à la taille de la police choisie
    switch ($taille_police_ingredient_fta_composition) {
        case '4':
            $checked4 = "checked";
            break;
        case '5':
            $checked5 = "checked";
            break;
        case '6':
            $checked6 = "checked";
            break;
        case '7':
            $checked7 = "checked";
            break;
        case '8':
            $checked8 = "checked";
            break;
        case "" :
            $checked6 = "checked";
            break;
    }
    if ($proprietaire) {
        $data_disabled = "";
    } else {
        $data_disabled = "disabled";
    }

    $bloc .= "<input type=radio name=" . FtaComposantModel::FIELDNAME_TAILLE_POLICE_INGREDIENT_FTA_COMPOSITION . " value=4 " . $checked4 . " " . $data_disabled . "> 4 " . $image_modif;
    $bloc .= "<input type=radio name=" . FtaComposantModel::FIELDNAME_TAILLE_POLICE_INGREDIENT_FTA_COMPOSITION . " value=5 " . $checked5 . " " . $data_disabled . "> 5 " . $image_modif;
    $bloc .= "<input type=radio name=" . FtaComposantModel::FIELDNAME_TAILLE_POLICE_INGREDIENT_FTA_COMPOSITION . " value=6 " . $checked6 . " " . $data_disabled . "> 6 " . $image_modif;
    $bloc .= "<input type=radio name=" . FtaComposantModel::FIELDNAME_TAILLE_POLICE_INGREDIENT_FTA_COMPOSITION . " value=7 " . $checked7 . " " . $data_disabled . "> 7 " . $image_modif;
    $bloc .= "<input type=radio name=" . FtaComposantModel::FIELDNAME_TAILLE_POLICE_INGREDIENT_FTA_COMPOSITION . " value=8 " . $checked8 . " " . $data_disabled . "> 8 " . $image_modif;
    $bloc .="</td></tr>";


//Alignement
    $champ = "k_style_paragraphe_ingredient_fta_composition";
    $table = "fta_composant";
//Versionning
    $color_modif = "";
    $image_modif = "";
    if (${"diff_" . $table}[$champ]) {
        $image_modif = $html_image_modif;
        $color_modif = $html_color_modif;
    }
//    $bloc.="<tr class=contenu><td " . $color_modif . ">";
//    $bloc.= DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_K_STYLE_PARAGRAPHE_INGREDIENT_FTA_COMPOSITION)
//            . "</td><td " . $color_modif . ">"
//    ;
//    if ($proprietaire) {
//        $requete = " SELECT " . CodesoftStyleParagrapheModel::KEYNAME . ", " . CodesoftStyleParagrapheModel::FIELDNAME_LIBELLE_CODESOFT_STYLE_PARAGRAPHE
//                . " FROM " . CodesoftStyleParagrapheModel::TABLENAME
//                . " ORDER BY " . CodesoftStyleParagrapheModel::FIELDNAME_LIBELLE_CODESOFT_STYLE_PARAGRAPHE
//        ;
//        $nom_defaut = FtaComposantModel::FIELDNAME_K_STYLE_PARAGRAPHE_INGREDIENT_FTA_COMPOSITION;
//        $id_defaut = $k_style_paragraphe_ingredient_fta_composition;
//        $liste_style .= AccueilFta::afficherRequeteEnListeDeroulante($requete, $id_defaut, $nom_defaut, $editable);
//        $bloc.= $liste_style;
//    } else {
//        if ($k_style_paragraphe_ingredient_fta_composition) {
//            $k_codesoft_style_paragraphe = $k_style_paragraphe_ingredient_fta_composition;
//            $codeSoftStyleParagrapheModel = new CodesoftStyleParagrapheModel($k_codesoft_style_paragraphe);
//            $bloc .=$codeSoftStyleParagrapheModel->getDataField(CodesoftStyleParagrapheModel::FIELDNAME_LIBELLE_CODESOFT_STYLE_PARAGRAPHE)->getFieldValue();
//        }
//    }
//    $bloc .=$image_modif . "</td></tr>";
    $bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_K_STYLE_PARAGRAPHE_INGREDIENT_FTA_COMPOSITION);


//echo $id_fta."<br>";
//Modèle d'etiquette par défaut
    $champ = "k_etiquette_fta_composition";
    $table = "fta_composant";
//Versionning
    $color_modif = "";
    $image_modif = "";
    if (${"diff_" . $table}[$champ]) {
        $image_modif = $html_image_modif;
        $color_modif = $html_color_modif;
    }
//    $liste_etiquette = DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION)
//            . "</td><td " . $color_modif . ">"
//    ;
//    $bloc.="<tr class=contenu><td " . $color_modif . ">" . $liste_etiquette;
//    if ($proprietaire) {
//        $requete = "SELECT " . CodesoftEtiquettesModel::KEYNAME . ", " . CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES
//                . " FROM " . CodesoftEtiquettesModel::TABLENAME
//                . " WHERE (" . CodesoftEtiquettesModel::FIELDNAME_K_TYPE_ETIQUETTE_CODESOFT_ETIQUETTES . "=2 "
//                . " OR " . CodesoftEtiquettesModel::FIELDNAME_K_TYPE_ETIQUETTE_CODESOFT_ETIQUETTES . "=0) "
//                . " ORDER BY " . CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES
//        ;
//        $nom_defaut = FtaComposantModel::FIELDNAME_K_ETIQUETTE_FTA_COMPOSITION;
//        $id_defaut = $k_etiquette_fta_composition;
//        $bloc.= AccueilFta::afficherRequeteEnListeDeroulante($requete, $id_defaut, $nom_defaut, $editable) . $image_modif;
//    } else {
//        if ($k_etiquette_fta_composition) {
//            $k_etiquette = $k_etiquette_fta_composition;
//            $codeEtiquetteModel = new CodesoftEtiquettesModel($k_etiquette);
//            $bloc .=$codeEtiquetteModel->getDataField(CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES)->getFieldValue();
//        }
//    }
//    $bloc.="</td></tr>";
    $bloc .=$ftaComposantView->ListeCodesoftEtiquettesRecto($id_fta, $editable);


    //Modèle d'etiquette verso
    $champ = "k_etiquette_verso_fta_composition";
    $table = "fta_composant";
    //Versionning
    $color_modif = "";
    $image_modif = "";
    if (${"diff_" . $table}[$champ]) {
        $image_modif = $html_image_modif;
        $color_modif = $html_color_modif;
    }
//    $liste_etiquette = DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_K_ETIQUETTE_VERSO_FTA_COMPOSITION)
//            . "</td><td " . $color_modif . ">"
//    ;
//    $bloc.="<tr class=contenu><td " . $color_modif . ">" . $liste_etiquette;
//    if ($proprietaire) {
//        ;
//        $requete = " SELECT " . CodesoftEtiquettesModel::KEYNAME . ", " . CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES
//                . " FROM " . CodesoftEtiquettesModel::TABLENAME
//                . " WHERE (" . CodesoftEtiquettesModel::FIELDNAME_K_TYPE_ETIQUETTE_CODESOFT_ETIQUETTES . "=3 "
//                . " OR " . CodesoftEtiquettesModel::FIELDNAME_K_TYPE_ETIQUETTE_CODESOFT_ETIQUETTES . "=0) "
//                . " ORDER BY " . CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES
//        ;
//        $nom_defaut = FtaComposantModel::FIELDNAME_K_ETIQUETTE_VERSO_FTA_COMPOSITION;
//        $id_defaut = $k_etiquette_verso_fta_composition;
//        $bloc.= AccueilFta::afficherRequeteEnListeDeroulante($requete, $id_defaut, $nom_defaut, $editable) . $image_modif;
//    } else {
//        if ($k_etiquette_verso_fta_composition) {
//            $k_etiquette = $k_etiquette_verso_fta_composition;
//            $codeEtiquetteModel = new CodesoftEtiquettesModel($k_etiquette);
//            $bloc .=$codeEtiquetteModel->getDataField(CodesoftEtiquettesModel::FIELDNAME_DESIGNATION_CODESOFT_ETIQUETTES)->getFieldValue();
//        }
//    }
//    $bloc.="</td></tr>";
    $bloc .=$ftaComposantView->ListeCodesoftEtiquettesVerso($id_fta, $editable);


    //Logo à imprimer sur le masque d'étiquette
    $champ = "k_codesoft_etiquette_logo";
    $table = "fta_composant";
    //Versionning
    $color_modif = "";
    $image_modif = "";
    if (${"diff_" . $table}[$champ]) {
        $image_modif = $html_image_modif;
        $color_modif = $html_color_modif;
    }
//    $liste_etiquette = DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_K_CODESOFT_ETIQUETTE_LOGO)
//            . "</td><td $color_modif>"
//    ;
//    $bloc.="<tr class=contenu><td " . $color_modif . ">" . $liste_etiquette;
//    if ($proprietaire) {
//        $requete = "SELECT " . CodesoftEtiquettesLogoModel::KEYNAME . "," . CodesoftEtiquettesLogoModel::FIELDNAME_LOGO_LABEL
//                . " FROM " . CodesoftEtiquettesLogoModel::TABLENAME
//                . " ORDER BY " . CodesoftEtiquettesLogoModel::FIELDNAME_LOGO_NAME;
//        $nom_defaut = FtaComposantModel::FIELDNAME_K_CODESOFT_ETIQUETTE_LOGO;
//        $id_defaut = $k_codesoft_etiquette_logo;
//        $bloc.= AccueilFta::afficherRequeteEnListeDeroulante($requete, $id_defaut, $nom_defaut, $editable) . $image_modif;
//    } else {
//        if ($k_codesoft_etiquette_logo) {
//            $id = $k_codesoft_etiquette_logo;
//            $codeEtiquetteLogoModel = new CodesoftEtiquettesLogoModel($id);
//            $bloc .=$codeEtiquetteLogoModel->getDataField(CodesoftEtiquettesLogoModel::FIELDNAME_LOGO_LABEL)->getFieldValue();
//        }
//    }
//    $bloc.="</td></tr>";
    $bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_K_CODESOFT_ETIQUETTE_LOGO);
}
//echo $mode_etiquette_fta_composition;

if ($mode_etiquette_fta_composition == 3) {

//Composant regroupant l'étiquette
    $champ = "etiquette_id_fta_composition";
    $table = "fta_composant";
//Versionning
    $color_modif = "";
    $image_modif = "";
    if (${"diff_" . $table}[$champ]) {
        $image_modif = $html_image_modif;
        $color_modif = $html_color_modif;
    }
//    $liste_etiquette = DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_ETIQUETTE_ID_FTA_COMPOSITION)
//            . "</td><td " . $color_modif . ">"
//    ;
//    $bloc.="<tr class=contenu><td " . $color_modif . ">" . $liste_etiquette;
//    /*    if($proprietaire)
//      { */
//    $requete = " SELECT " . FtaComposantModel::KEYNAME . ", " . FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION
//            . " FROM " . FtaComposantModel::TABLENAME
//            . " WHERE " . FtaComposantModel::TABLENAME . "." . FtaComposantModel::FIELDNAME_ID_FTA . "=" . $id_fta
//            . " AND " . FtaComposantModel::KEYNAME . "<>" . $id_fta_composant
//            . " AND " . FtaComposantModel::FIELDNAME_IS_NOMENCLATURE_FTA_COMPOSANT . "=1 "
//            . " ORDER BY " . FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION
//    ;
//
//    $nom_defaut = FtaComposantModel::FIELDNAME_ETIQUETTE_ID_FTA_COMPOSITION;
//    $id_defaut = $etiquette_id_fta_composition;
//    $bloc.= AccueilFta::afficherRequeteEnListeDeroulante($requete, $id_defaut, $nom_defaut, $editable) . $image_modif;

    $HtmlList = new HtmlListSelect();

    $HtmlList->setArrayListContent($requete);
    $HtmlTableName = FtaComposantModel::TABLENAME
            . '_'
            . FtaComposantModel::FIELDNAME_ETIQUETTE_ID_FTA_COMPOSITION
            . '_'
            . $id_fta_composant
    ;
    $HtmlList->getAttributes()->getName()->setValue(FtaComposantModel::FIELDNAME_ETIQUETTE_ID_FTA_COMPOSITION);
    $HtmlList->setLabel(DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_NOM_FTA_COMPOSITION));
    $HtmlList->setIsEditable($editable);
    $HtmlList->initAbstractHtmlSelect(
            $HtmlTableName, $paramObjetList->getLabel(), $ftaComposantModel->getDataField(FtaComposantModel::FIELDNAME_ETIQUETTE_ID_FTA_COMPOSITION)->getFieldValue(), NULL, $paramObjetList->getArrayListContent());
    $HtmlList->getEventsForm()->setOnChangeWithAjaxAutoSave(FtaComposantModel::TABLENAME, FtaComposantModel::KEYNAME, $id_fta_composant, FtaComposantModel::FIELDNAME_ETIQUETTE_ID_FTA_COMPOSITION);


    $bloc .= $HtmlList->getHtmlResult();
}
/* }else{
  $k_etiquette=$$champ;
  mysql_table_load("codesoft_etiquettes");
  $bloc .=html_view_txt($designation_codesoft_etiquettes);
  } */
$bloc.="</td></tr>";
/**
 * -----------------------------------------------------------------------------
 * Valeurs nutrionnelles
 * -----------------------------------------------------------------------------
 */
$bloc .= "</td></tr>
             </table>
             <" . $html_table . ">
             <tr class=titre_principal><td>
                 Valeurs nutritionnelles pour 100g
             </td></tr>
             </table>
             <" . $html_table . ">
             
        ";

/**
 * Energie en kcal
 */
//$bloc .= "<tr><td " . $color_modif . ">" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_VAL_NUT_KCAL) . "</td><td " . $color_modif . ">";
//if ($proprietaire) {
//    $bloc .= "<input type=text name=" . FtaComposantModel::FIELDNAME_VAL_NUT_KCAL . " value='" . $val_nut_kcal . "' size=50/>";
//} else {
//    $bloc .=$val_nut_kcal;
//    $bloc .= "<input type=hidden name=" . FtaComposantModel::FIELDNAME_VAL_NUT_KCAL . " value='" . $val_nut_kcal . "'/>";
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_VAL_NUT_KCAL);

//}
/**
 * Energie en kJ
 */
//$bloc .= "<tr><td " . $color_modif . ">" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_VAL_NUT_KJ) . "</td><td " . $color_modif . ">";
//if ($proprietaire) {
//    $bloc .= "<input type=text name=" . FtaComposantModel::FIELDNAME_VAL_NUT_KJ . " value='" . $val_nut_kj . "' size=50/>";
//} else {
//    $bloc .=$val_nut_kj;
//    $bloc .= "<input type=hidden name=" . FtaComposantModel::FIELDNAME_VAL_NUT_KJ . " value='" . $val_nut_kj . "'/>";
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_VAL_NUT_KJ);

//}

/**
 * Matières grasses
 */
//$bloc .= "<tr><td " . $color_modif . ">" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_VAL_MAT_GRASSE) . "</td><td " . $color_modif . ">";
//if ($proprietaire) {
//    $bloc .= "<input type=text name=" . FtaComposantModel::FIELDNAME_VAL_MAT_GRASSE . " value='" . $val_nut_mat_grasse . "' size=50/>";
//} else {
//    $bloc .=$val_nut_mat_grasse;
//    $bloc .= "<input type=hidden name=" . FtaComposantModel::FIELDNAME_VAL_MAT_GRASSE . " value='" . $val_nut_mat_grasse . "'/>";
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_VAL_MAT_GRASSE);

//}

/**
 * Acides gras
 */
//$bloc .= "<tr><td " . $color_modif . ">" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_VAL_ACIDE_GRAS) . "</td><td " . $color_modif . ">";
//if ($proprietaire) {
//    $bloc .= "<input type=text name=" . FtaComposantModel::FIELDNAME_VAL_ACIDE_GRAS . " value='" . $val_nut_acide_gras . "' size=50/>";
//} else {
//    $bloc .=$val_nut_acide_gras;
//    $bloc .= "<input type=hidden name=" . FtaComposantModel::FIELDNAME_VAL_ACIDE_GRAS . " value='" . $val_nut_acide_gras . "'/>";
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_VAL_ACIDE_GRAS);

//}

/**
 * Glucides
 */
//$bloc .= "<tr><td " . $color_modif . ">" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_VAL_GLUCIDE) . "</td><td " . $color_modif . ">";
//if ($proprietaire) {
//    $bloc .= "<input type=text name=" . FtaComposantModel::FIELDNAME_VAL_GLUCIDE . " value='" . $val_nut_glucide . "' size=50/>";
//} else {
//    $bloc .=$val_nut_glucide;
//    $bloc .= "<input type=hidden name=" . FtaComposantModel::FIELDNAME_VAL_GLUCIDE . " value='" . $val_nut_glucide . "'/>";
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_VAL_GLUCIDE);

//}

/**
 * Sucres
 */
//$bloc .= "<tr><td " . $color_modif . ">" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_VAL_SUCRE) . "</td><td " . $color_modif . ">";
//if ($proprietaire) {
//    $bloc .= "<input type=text name=" . FtaComposantModel::FIELDNAME_VAL_SUCRE . " value='" . $val_nut_sucre . "' size=50/>";
//} else {
//    $bloc .=$val_nut_sucre;
//    $bloc .= "<input type=hidden name=" . FtaComposantModel::FIELDNAME_VAL_SUCRE . " value='" . $val_nut_sucre . "'/>";
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_VAL_SUCRE);

//}

/**
 * Protéine
 */
//$bloc .= "<tr><td " . $color_modif . ">" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_VAL_PROTEINE) . "</td><td " . $color_modif . ">";
//if ($proprietaire) {
//    $bloc .= "<input type=text name=" . FtaComposantModel::FIELDNAME_VAL_PROTEINE . " value='" . $val_nut_proteine . "' size=50/>";
//} else {
//    $bloc .=$val_nut_proteine;
//    $bloc .= "<input type=hidden name=" . FtaComposantModel::FIELDNAME_VAL_PROTEINE . " value='" . $val_nut_proteine . "'/>";
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_VAL_PROTEINE);

//}

/**
 * Sel
 */
//$bloc .= "<tr><td " . $color_modif . ">" . DatabaseDescription::getFieldDocLabel(FtaComposantModel::TABLENAME, FtaComposantModel::FIELDNAME_VAL_SEL) . "</td><td " . $color_modif . ">";
//if ($proprietaire) {
//    $bloc .= "<input type=text name=" . FtaComposantModel::FIELDNAME_VAL_SEL . " value='" . $val_nut_sel . "' size=50/>";
//} else {
//    $bloc .=$val_nut_sel;
//    $bloc .= "<input type=hidden name=" . FtaComposantModel::FIELDNAME_VAL_SEL . " value='" . $val_nut_sel . "'/>";
$bloc .=$ftaComposantView->getHtmlDataField(FtaComposantModel::FIELDNAME_VAL_SEL);

//}




$bloc.="</td></tr>";



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
             <form method=" . $method . " action=" . $page_action . ">
             <input type=hidden name=action value=" . $action . ">
             <input type=hidden name=id_fta value=" . $id_fta . ">
             <input type=hidden name=id_fta_chapitre_encours value=" . $id_fta_chapitre . ">
             <input type=hidden name=id_access_recette_recette value=" . $id_access_recette_recette . ">
             <input type=hidden name=id_fta_composition value=" . $id_fta_composition . ">
             <input type=hidden name=id_fta_composant value=" . $id_fta_composant . ">
             <input type=hidden name=etiquette_poids_fta_composition value=" . $etiquette_poids_fta_composition . ">
             <input type=hidden name=creation value=" . $creation . ">
             <input type=hidden name=id_fta_role value=" . $idFtaRole . ">
             <input type=hidden name=abreviation_fta_etat value=" . $abreviationFtaEtat . ">
             <input type=hidden name=id_fta_etat value=" . $idFtaEtat . ">
             <input type=hidden name=comeback value=" . $comeback . ">
             <input type=\"hidden\" name=\"synthese_action\" value=\"" . $syntheseAction . "\" />
             <input type=hidden name=proprietaire value=" . $proprietaire . " />

             <" . $html_table . ">
             <tr class=titre_principal><td>

                 Modification d'un Composant

             </td></tr>
             </table>
             <" . $html_table . ">
             <tr></tr>

                 " . $bloc . "

             </td></tr>
             </table>
             <" . $html_table . ">
             <tr><td>

                 <center>
                 " . $bouton_valider . "
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
